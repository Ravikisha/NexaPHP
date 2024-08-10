<?php

namespace App\core\middlewares;


abstract class BaseMiddleware
{
    abstract public function execute();
}