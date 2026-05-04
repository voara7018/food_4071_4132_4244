<?php

namespace App\Models;
use CodeIgniter\Model;

class PlatsModel extends Model
{
    protected $table = 'plats';
    protected $primaryKey = 'id_plats';
    protected $allowedFields = ['nom', 'emoji', 'image', 'id_categorie', 'time', 'calorie', 'rating', 'description'];

}