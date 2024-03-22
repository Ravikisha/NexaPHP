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
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            if ($user->validate() && $user->save()) {
                return 'Success';
            }
            return $this->render('register', [
                'model' => $user
            ]);
        }

        $this->setLayout('auth');
        
        return $this->render('register', [
            'model' => $user
        ]);
    }
}