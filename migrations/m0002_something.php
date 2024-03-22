<?php

class m002_something {
    public function up() {
        $db = \App\core\Application::$app->db;
        $SQL = "CREATE TABLE something (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down() {
        $db = \App\core\Application::$app->db;
        $SQL = "DROP TABLE something;";
        $db->pdo->exec($SQL);
    }
}