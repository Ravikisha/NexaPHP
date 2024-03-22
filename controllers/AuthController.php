<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Request;
use App\models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {
        $errors = [];
        $register = new User();
        if ($request->isPost()) {
            $register->loadData($request->getBody());
            if ($register->validate() && $register->register()) {
                return 'Success';
            }
            return $this->render('register', [
                'model' => $register
            ]);
        }

        $this->setLayout('auth');
        
        return $this->render('register', [
            'model' => $register
        ]);
    }
}