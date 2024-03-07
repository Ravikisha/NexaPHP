<?php

namespace App\controllers;

use App\core\Application;
use App\core\Controller;

class SiteController extends Controller{

    public function home() {
        $data = [
            'name' => "Ravi Kishan",
            'email' => "ravikishan63392@gmail.com"
        ];
        return $this->render('home', $data);
    }

    public function contact() {
        return Application::$app->router->renderView('contact');
    }

    public function handleContact() {
        return "Handling submitted data.";
    }
}