<?php

namespace ravikisha\nexaphp;

use ravikisha\nexaphp\db\DBModel;

abstract class UserModel extends DBModel
{
    abstract public function getDisplayName(): string;
}