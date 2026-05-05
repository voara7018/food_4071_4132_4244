<?php

namespace App\Models;

use CodeIgniter\Model;

class PlatsModel extends Model
{
    protected $table            = 'plats';
    protected $primaryKey       = 'id'; // Corrigé selon ton SQL
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nom', 'emoji', 'image', 'id_category', 
        'time', 'calorie', 'rating', 'description'
    ];

    protected $useTimestamps = false; 
}