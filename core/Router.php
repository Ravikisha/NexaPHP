<?php

/**
 * Class Application
 * @author Ravi Kishan <@Ravikisha> <ravikishan63392@gmail.com>
 * @package app\core
 */

namespace app\core;

class Router {

    public Request $request;
    protected array $routes = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {

        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if($callback === false){
            echo "Not Found";
            exit;
        }
        echo call_user_func($callback);

        // $path = $_SERVER['REQUEST_URI'] ?? '/';
        // $method = $_SERVER['REQUEST_METHOD'];
        // $callback = $this->routes[$method][$path] ?? false;
        // if($callback === false){
        //     echo "Not Found";
        //     exit;
        // }
        // echo call_user_func($callback);
    }
}