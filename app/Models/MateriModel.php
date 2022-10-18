<?php

namespace App\Models;

use CodeIgniter\Model;

class MateriModel extends Model
{
    protected $table = 'materi';
    protected $primaryKey = 'id_materi';
    protected $allowedFields = ['nama_materi', 'guru', 'mapel', 'kelas', 'catatan', 'unggah_materi', 'bikin_manual', 'unggah_materi2', 'date_created', 'dilihat'];

    public function getAllMateriByGuru($no_regis)
    {
        return $this->db->table('materi')
            ->join('guru', 'guru.no_regis=materi.guru')
            ->join('mapel', 'mapel.id=materi.mapel')
            ->join('kelas', 'kelas.id=materi.kelas')
            ->where('materi.guru', $no_regis)
            ->orderBy('materi.id_materi', 'DESC')
            ->get()->getResultObject();
    }

    public function getAllMateriByIdKelas($idKelas)
    {
        return $this
            ->join('mapel', 'mapel.id=materi.mapel')
            ->join('kelas', 'kelas.id=materi.kelas')
            ->where('materi.kelas', $idKelas)
            ->orderBy('materi.id_materi', 'DESC')
            ->get()->getResultObject();
    }

    public function getMateriById($id_materi)
    {
        return $this->db->table('materi')
            ->join('guru', 'guru.no_regis=materi.guru')
            ->join('mapel', 'mapel.id=materi.mapel')
            ->join('kelas', 'kelas.id=materi.kelas')
            ->where('materi.id_materi', $id_materi)
            ->get()->getRowObject();
    }
}
