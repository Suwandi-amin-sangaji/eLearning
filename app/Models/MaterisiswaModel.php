<?php

namespace App\Models;

use CodeIgniter\Model;

class MaterisiswaModel extends Model
{
    protected $table = 'materi_siswa';
    protected $primaryKey = 'id_materi_siswa';
    protected $allowedFields = ['no_regis_guru', 'no_regis_siswa', 'materi_id', 'kelas_id', 'mapel_id', 'date_send'];

    public function getPemberitahuanByNoRegis($no_regis)
    {
        return $this
            ->join('guru', 'guru.no_regis=materi_siswa.no_regis_guru')
            ->join('siswa', 'siswa.no_regis=materi_siswa.no_regis_siswa')
            ->join('materi', 'materi.id_materi=materi_siswa.materi_id')
            ->join('kelas', 'kelas.id=materi_siswa.kelas_id')
            ->join('mapel', 'mapel.id=materi_siswa.mapel_id')
            ->where('materi_siswa.no_regis_siswa', $no_regis)
            ->get()->getResultObject();
    }
}
