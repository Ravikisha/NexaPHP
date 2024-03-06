<?php

namespace app\core;

/**
 * Class Application
 * @author Ravi Kishan <@Ravikisha> <ravikishan63392@gmail.com>
 * @package core
 */

class Request
{
    /**
     * Get the current request path
     * @return string
     */
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    /**
     * Get the current request method
     * @return string
     */
    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}
