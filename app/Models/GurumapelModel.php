<?php

namespace App\Models;

use CodeIgniter\Model;

class GurumapelModel extends Model
{
    protected $table = 'guru-mapel';
    // protected $useTimestamps = true;
    protected $allowedFields = ['no_regis', 'mapel_id', 'mapel'];

    public function getAllbyGuru($no_regis)
    {
        return $this->db->table('guru-mapel')
            ->join('mapel', 'mapel.id=guru-mapel.mapel_id')
            ->where('guru-mapel.no_regis', $no_regis)
            ->get()->getResultObject();
    }
}
