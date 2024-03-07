<?php

namespace App\controllers;

use App\core\Application;

class SiteController {

    public function home() {
        $data = [
            'name' => "Ravi Kishan",
            'email' => "ravikishan63392@gmail.com"
        ];
        return Application::$app->router->renderView('home', $data);
    }

    public function contact() {
        return Application::$app->router->renderView('contact');
    }

    public function handleContact() {
        return "Handling submitted data.";
    }
}