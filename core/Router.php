<?php

/**
 * Class Application
 * @author Ravi Kishan <@Ravikisha> <ravikishan63392@gmail.com>
 * @package App\core
 * @property Request $request
 * @property Response $response
 * @property array $routes
 */

namespace App\core;

class Router
{

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
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }

        return call_user_func($callback, $this->request, $this->response);
    }

    /**
     * Render a view
     * @param string $view
     * @param array $params
     * @return string
     */
    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * Render content
     * @param string $viewContent
     * @return string
     */
    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * Layout content
     * @param string $layout
     * @return string
     */
    public function layoutContent($layout = null)
    {
        $layout = $layout ?? Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    /**
     * Render only view
     * @param string $view
     * @param array $params
     * @return string
     */
    public function renderOnlyView($view, $params)
    {

        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}
