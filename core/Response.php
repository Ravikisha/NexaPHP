<?php

namespace App\core;

/**
 * Class Response
 * @author Ravi Kishan <@Ravikisha> <ravikishan63392@gmail.com>
 * @package core
 */

class Response
{
    /**
     * Set the response status code
     * @param int $code
     * @return void
     */
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    
}
