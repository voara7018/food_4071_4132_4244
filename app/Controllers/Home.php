<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class Home extends BaseController
{
    public function showhome()
    {
        return view('home');
    }

}