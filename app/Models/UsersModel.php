<?php

namespace App\Models;
use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_users';
    protected $allowedFields = ['username', 'email', 'password'];

    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[50]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]',
    ];

    protected $validationMessages = [
        'username' => [
            'required' => 'Le nom d\'utilisateur est requis.',
            'min_length' => 'Le nom d\'utilisateur doit contenir au moins 3 caractères.',
            'max_length' => 'Le nom d\'utilisateur ne peut pas dépasser 50 caractères.',
        ],
        'email' => [
            'required' => 'L\'email est requis.',
            'valid_email' => 'Veuillez fournir une adresse email valide.',
            'is_unique' => 'Cet email est déjà utilisé.',
        ],
        'password' => [
            'required' => 'Le mot de passe est requis.',
            'min_length' => 'Le mot de passe doit contenir au moins 8 caractères.',
        ],
    ];

}