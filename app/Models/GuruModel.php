<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table = 'guru';
    // protected $useTimestamps = true;
    protected $allowedFields = ['no_regis', 'nama', 'email', 'password', 'gambar', 'role_id', 'is_active'];

    public function getGuru($email)
    {
        return $this->where(['email' => $email])->asObject()->first();
    }

    public function getGuruTidakAktif()
    {
        return $this->where(['is_active' => 0])->asObject()->findAll();
    }
}
