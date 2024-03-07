<?php

/**
 * Class Application
 * @author Ravi Kishan <@Ravikisha> <ravikishan63392@gmail.com>
 * @package App\core
 * @property Request $request
 */

namespace App\core;

class Router {

    public Request $request;
    public Response $response;
    protected array $routes = [];

    /**
     * Router constructor
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
    /**
     * Define a get request
     * @param string $path
     * @param callable $callback || string $view
     * @return void
     */
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * Define a post request
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * Resolve the route
     * @return string
     */
    public function resolve()
    {

        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if($callback === false){
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }

        if(is_string($callback)){
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }

        return call_user_func($callback);
    }

    /**
     * Render a view
     * @param string $view
     * @return string
     */
    public function renderView($view){
        $layoutContent = $this->layoutContent('main');
        $viewContent = $this->renderOnlyView($view);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * Render content
     * @param string $viewContent
     * @return string
     */
    public function renderContent($viewContent){
        $layoutContent = $this->layoutContent('main');
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * Layout content
     * @param string $layout
     * @return string
     */
    public function layoutContent($layout){
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    /**
     * Render only view
     * @param string $view
     * @return string
     */
    public function renderOnlyView($view){
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}