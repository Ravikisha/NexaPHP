<?php

namespace App\core;

/**
 * Class Response
 * @author Ravi Kishan <@Ravikisha> <ravikishan63392@gmail.com>
 * @package core
 */

class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    
}
