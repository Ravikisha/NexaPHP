<?php

namespace ravikisha\nexaphp\exception;

class NotFoundException extends \Exception
{
    protected $message = 'Page not found';
    protected $code = 404;
}