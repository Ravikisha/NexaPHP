<?php

namespace App\controllers;

use App\core\Application;

class SiteController {
    public function handleContact() {
        return Application::$app->router->renderView('contact');
    }
}