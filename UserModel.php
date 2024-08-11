<?php

namespace ravikisha\nextphp;

use ravikisha\nextphp\db\DBModel;

abstract class UserModel extends DBModel
{
    abstract public function getDisplayName(): string;
}