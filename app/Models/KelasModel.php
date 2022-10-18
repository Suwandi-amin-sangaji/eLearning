<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 'kelas';
    // protected $useTimestamps = true;
    protected $allowedFields = ['nama_kelas', 'class_code', 'is_active'];

    public function getKelas($id)
    {
        return $this->where(['id' => $id])->asObject()->first();
    }
}
