<?php

namespace App\Models;
use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_users';
    protected $allowedFields = ['username', 'email', 'password'];

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[50]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]',
        'password_confirm' => 'required|matches[password]',
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
        'password_confirm' => [
            'matches' => 'La confirmation du mot de passe ne correspond pas.',
        ],
    ];

    protected function hashPassword(array $data): array
    {
        if (! isset($data['data']) || ! is_array($data['data'])) {
            return $data;
        }

        if (array_key_exists('password_confirm', $data['data'])) {
            unset($data['data']['password_confirm']);
        }

        if (isset($data['data']['password']) && $data['data']['password'] !== '') {
            $info = password_get_info($data['data']['password']);
            if (($info['algo'] ?? 0) === 0) {
                $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
            }
        }

        return $data;
    }

}