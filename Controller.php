<?php

namespace ravikisha\nextphp;

/**
 * Controller class
 * @author Ravi Kishan <@Ravikisha> <ravikishan63392@gmail.com>
 * @package ravikisha\nextphp
 * @abstract
 * @property string $layout
 */

use ravikisha\nextphp\middlewares\BaseMiddleware;

abstract class Controller
{
    /**
     * Set the layout for the view
     * @var string
     */
    public string $layout = 'main';
    public string $action = '';

    /**
     * @var \ravikisha\nextphp\middlewares\BaseMiddleware[]
     */
    protected array $middlewares = [];

    /**
     * Set the layout
     * @param string $layout
     * @return void
     */
    public function setLayout($layout): void
    {
        $this->layout = $layout;
    }

    /**
     * Render the view with the layout
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render($view, $params = []): string
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * Get the middlewares
     * @return \ravikisha\nextphp\middlewares\BaseMiddleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}
