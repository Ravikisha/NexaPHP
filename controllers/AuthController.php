<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Request;
use App\Model\RegisterModel;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {
        $this->setLayout('auth');
        if ($request->isPost()) {
            $register = new RegisterModel();
            return "Handling submitted data.";
        }

        return $this->render('register');
    }
}