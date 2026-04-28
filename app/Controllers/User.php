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

        $data = $this->request->getPost();
        if(!$model->insert($data)){
            return view('register', ['validation' => $model->errors()]);
        }
        return view('login');

    }

    public function loginUser()
    {
        $model = new UsersModel();

        $data =$this->request->getPost();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            return redirect()->to('/home');
        } else {    
            return view('login', ['validation' => $model->errors()]);
        }
    }

}