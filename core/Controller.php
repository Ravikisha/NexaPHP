<?php

namespace App\core;

/**
 * Controller class
 * @author Ravi Kishan <@Ravikisha> <ravikishan63392@gmail.com>
 * @package App\core
 * @abstract
 * @property string $layout
 */

abstract class Controller
{
    /**
     * Set the layout for the view
     * @var string
     */
    public string $layout = 'main';

    /**
     * Set the layout
     * @param string $layout
     * @return void
     */
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
