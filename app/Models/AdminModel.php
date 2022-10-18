<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    // protected $useTimestamps = true;
    protected $allowedFields = ['email', 'password', 'role_id'];

    public function getAdmin($email)
    {
        return $this->where(['email' => $email])->asObject()->first();
    }
}
