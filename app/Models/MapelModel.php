<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{
    protected $table = 'mapel';
    // protected $useTimestamps = true;
    protected $allowedFields = ['nama_mapel', 'is_active'];

    public function getMapel($id)
    {
        return $this->where(['id' => $id])->asObject()->first();
    }
}
