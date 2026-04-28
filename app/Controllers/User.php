<?php

namespace App\Controllers;
use App\Models\UsersModel;

class User extends BaseController
{
    public function showlogin()
    {
        return view('login');
    }

    public function showregister()
    {
        return view('register');
    }

    public function insertUser()
    {
        $model = new UsersModel();

        $data = [
            'username' => $this->request->getVar('username'),
            'email'    => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ];

        if ($model->insert($data)) {
            return redirect()->to('/home');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }

    public function loginUser()
    {
        $model = new UsersModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            return redirect()->to('/home');
        } else {
            return redirect()->back()->withInput()->with('error', 'Email ou mot de passe incorrect.');
        }
    }

}