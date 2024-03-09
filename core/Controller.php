<?php

namespace App\core;

abstract class Controller
{
    /**
     * Set the layout for the view
     * @var string
     */
    public string $layout = 'main';
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * Render the view with the layout
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
}
