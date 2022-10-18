<?php

namespace App\Models;

use CodeIgniter\Model;

class GurukelasModel extends Model
{
    protected $table = 'guru-kelas';
    // protected $useTimestamps = true;
    protected $allowedFields = ['no_regis', 'kelas_id', 'kelas'];

    public function getAllbyGuru($no_regis)
    {
        return $this->db->table('guru-kelas')
            ->join('kelas', 'kelas.id=guru-kelas.kelas_id')
            ->where('guru-kelas.no_regis', $no_regis)
            ->get()->getResultObject();
    }
}
