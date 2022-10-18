<?php

namespace App\Models;

use CodeIgniter\Model;

class TugasModel extends Model
{
    protected $table = 'tugas';
    protected $primaryKey = 'id_tugas';
    protected $allowedFields = ['nama_tugas', 'guru', 'kelas', 'mapel', 'pesan', 'file', 'is_essay', 'date_created', 'due_date'];

    public function getAllTugasByGuru($no_regis)
    {
        return $this->db->table('tugas')
            ->join('guru', 'guru.no_regis=tugas.guru')
            ->join('mapel', 'mapel.id=tugas.mapel')
            ->join('kelas', 'kelas.id=tugas.kelas')
            ->where('tugas.guru', $no_regis)
            ->orderBy('tugas.id_tugas', 'DESC')
            ->get()->getResultObject();
    }

    public function getAllTugasByIdKelas($idkelas)
    {
        return $this
            ->join('guru', 'guru.no_regis=tugas.guru')
            ->join('mapel', 'mapel.id=tugas.mapel')
            ->join('kelas', 'kelas.id=tugas.kelas')
            ->where('tugas.kelas', $idkelas)
            ->orderBy('tugas.id_tugas', 'DESC')
            ->get()->getResultObject();
    }

    public function getTugasById($id_tugas)
    {
        return $this->db->table('tugas')
            ->join('guru', 'guru.no_regis=tugas.guru')
            ->join('mapel', 'mapel.id=tugas.mapel')
            ->join('kelas', 'kelas.id=tugas.kelas')
            ->where('tugas.id_tugas', $id_tugas)
            ->get()->getRowObject();
    }
}
