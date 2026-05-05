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

    public function add()
    {
        $db = \Config\Database::connect();
        $data['categories'] = $db->table('categories')->get()->getResultArray();

        return view('add-food', $data);
    }

    public function store()
    {
        $model = new PlatsModel();

        $file = $this->request->getFile('image_file');
        $imageName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move(FCPATH . 'assets/images', $imageName);
        }

        $data = [
            'nom'         => $this->request->getPost('nom'),
            'emoji'       => $this->request->getPost('emoji'),
            'image'       => $imageName,
            'id_category' => $this->request->getPost('id_category'),
            'time'        => $this->request->getPost('time'),
            'calorie'     => $this->request->getPost('calorie'),
            'rating'      => $this->request->getPost('rating'),
            'description' => $this->request->getPost('description'),
        ];

        $model->insert($data);
        return redirect()->to('/home');
    }
}