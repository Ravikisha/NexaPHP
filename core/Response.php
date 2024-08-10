<?php

namespace App\core;

/**
 * Class Response
 * @author Ravi Kishan <@Ravikisha> <ravikishan63392@gmail.com>
 * @package core
 */

 class Response
 {
     public function statusCode(int $code)
     {
         http_response_code($code);
     }
 
     public function redirect($url)
     {
         header("Location: $url");
     }
 }
