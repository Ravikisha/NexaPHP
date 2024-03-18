<?php

namespace App\core;

/**
 * Class Application
 * @author Ravi Kishan <@Ravikisha> <ravikishan63392@gmail.com>
 * @package App\core
 * @property Router $router
 * @property Request $request
 * @property Response $response
 * @property Controller $controller
 * @property Application $app
 */

class Application {

    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;
    public Controller $controller;
    
    /**
     * Application constructor
     * @param string|null $rootPath
     * @return void
     */
    public function __construct($rootPath = null)
    {
        self::$ROOT_DIR = $rootPath ?? dirname(__DIR__);
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    /**
     * Run the application
     * @return void
     */
    public function run()
    {
        echo $this->router->resolve();
    }

    /**
     * Get the current controller
     * @return Controller
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set the current controller
     * @param Controller $controller
     * @return void
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }
}