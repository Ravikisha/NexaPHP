<?php

namespace App\Model;

class RegisterModel
{
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';

    public function register()
    {
        // Validate data
        // Create user
    }
}