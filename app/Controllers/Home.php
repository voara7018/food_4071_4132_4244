<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\PlatsModel;

class Home extends BaseController
{
    public function getPlats(){
        if (! session()->get('logged_in')) {
            return redirect()->to('/');
        }
        $model = new PlatsModel();
        $plats = $model->findAll();
        return view('home', ['plats' => $plats]);
    }

}