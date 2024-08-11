<?php

namespace ravikisha\nexaphp\db;

use ravikisha\nexaphp\Application;

class Database {
    public \PDO $pdo;
    public function __construct(array $config) {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations() {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $files = scandir(Application::$ROOT_DIR.'/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        $newMigrations = [];
        foreach($toApplyMigrations as $migration) {
            if($migration === '.' || $migration === '..') {
                continue;
            }
            require_once Application::$ROOT_DIR.'/migrations/'.$migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied migration $migration");
            $newMigrations[] = $migration;
        }

        if(!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All migrations are applied");
        }
    }

    public function createMigrationsTable() {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    public function getAppliedMigrations() {
        $stmt = $this->pdo->prepare("SELECT migration FROM migrations");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations) {
        $str = implode(",", array_map(fn($m) => "('$m')", $migrations));
        $stmt = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $str");
        $stmt->execute();
    }

    protected function log($message) {
        echo '['.date('Y-m-d H:i:s').'] - '.$message.PHP_EOL;
    }

    public function prepare($sql) {
        return $this->pdo->prepare($sql);
    }

    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }

    public function applyMigration($className) {
        $this->createMigrationsTable();
        $this->log("Applying migration $className");
        $instance = new $className();
        $instance->up();
        $this->log("Applied migration $className");
        $this->saveMigration($className);
    }

    public function saveMigration($className) {
        $stmt = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES (:migration)");
        $stmt->bindValue(':migration', $className);
        $stmt->execute();
    }

    public function revertMigration($className) {
        $this->createMigrationsTable();
        $this->log("Reverting migration $className");
        $instance = new $className();
        $instance->down();
        $this->log("Reverted migration $className");
        $this->deleteMigration($className);
    }

    public function deleteMigration($className) {
        $stmt = $this->pdo->prepare("DELETE FROM migrations WHERE migration = :migration");
        $stmt->bindValue(':migration', $className);
        $stmt->execute();
    }
    
    public function getMigrations() {
        $files = scandir(Application::$ROOT_DIR.'/migrations');
        return array_diff($files, $this->getAppliedMigrations());
    }

}