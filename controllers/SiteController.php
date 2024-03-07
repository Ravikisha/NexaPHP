<?php

namespace App\controllers;

use App\core\Application;
use App\core\Controller;
use App\core\Request;

class SiteController extends Controller{

    public function home() {
        $data = [
            'name' => "Ravi Kishan",
            'email' => "ravikishan63392@gmail.com"
        ];
        return $this->render('home', $data);
    }

    public function contact() {
        return $this->render('contact');
    }

    public function handleContact(Request $request) {
        $body = $request->getBody();
        return "Handling submitted data.";
    }
}