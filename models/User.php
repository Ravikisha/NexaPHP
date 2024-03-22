<?php

namespace App\models;

use App\core\DBModel;

class User extends DBModel
{

    const STATUS = [
        'inactive' => 'inactive',
        'active' => 'active',
        'deleted' => 'deleted'
    ];

    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public string $status = self::STATUS['inactive'];
    public string $password = '';
    public string $passwordConfirm = '';

    public function rules(): array
    {
        return [
            'firstName' => [self::RULE_REQUIRED],
            'lastName' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class, 'attribute' => 'email']],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
            'passwordConfirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['firstName', 'lastName', 'email', 'password', 'status'];
    }

    public function primaryKey(): string
    {
        return 'id';
    }
    

    public function save()
    {
        $this->status = self::STATUS['inactive'];
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }
}