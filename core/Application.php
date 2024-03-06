<?php

namespace app\core;

/**
 * Class Application
 * @author Ravi Kishan <@Ravikisha> <ravikishan63392@gmail.com>
 * @package core
 * @property Router $router
 */

class Application {

    public Router $router;
    public Request $request;
    
    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run()
    {
        $this->router->resolve();
    }
}