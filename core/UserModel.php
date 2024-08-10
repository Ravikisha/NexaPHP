<?php

namespace App\core;

use App\core\db\DBModel;

abstract class UserModel extends DBModel
{
    abstract public function getDisplayName(): string;
}