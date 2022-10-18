<?php

namespace App\Models;

use CodeIgniter\Model;

class TugassiswaModel extends Model
{
    protected $table = 'tugas_siswa';
    protected $primaryKey = 'id_tugas_siswa';
    protected $allowedFields = ['no_regis_guru', 'no_regis_siswa', 'tugas_id', 'kelas_id', 'mapel_id', 'essay', 'file_siswa', 'nilai', 'telat', 'date_send', 'dikerjakan'];

    public function getAllByIdTugas($id)
    {
        return $this
            ->join('guru', 'guru.no_regis=tugas_siswa.no_regis_guru')
            ->join('siswa', 'siswa.no_regis=tugas_siswa.no_regis_siswa')
            ->join('tugas', 'tugas.id_tugas=tugas_siswa.tugas_id')
            ->join('kelas', 'kelas.id=tugas_siswa.kelas_id')
            ->join('mapel', 'mapel.id=tugas_siswa.mapel_id')
            ->where('tugas_siswa.tugas_id', $id)
            ->get()->getResultObject();
    }

    public function getPemberitahuanByNoRegis($no_regis, $dikerjakan)
    {
        return $this
            ->join('guru', 'guru.no_regis=tugas_siswa.no_regis_guru')
            ->join('siswa', 'siswa.no_regis=tugas_siswa.no_regis_siswa')
            ->join('tugas', 'tugas.id_tugas=tugas_siswa.tugas_id')
            ->join('kelas', 'kelas.id=tugas_siswa.kelas_id')
            ->join('mapel', 'mapel.id=tugas_siswa.mapel_id')
            ->where('tugas_siswa.no_regis_siswa', $no_regis)
            ->where('tugas_siswa.dikerjakan', $dikerjakan)
            ->get()->getResultObject();
    }

    public function getByIdTugasNoRegisSiswa($id, $no_regis)
    {
        return $this
            ->join('guru', 'guru.no_regis=tugas_siswa.no_regis_guru')
            ->join('siswa', 'siswa.no_regis=tugas_siswa.no_regis_siswa')
            ->join('tugas', 'tugas.id_tugas=tugas_siswa.tugas_id')
            ->join('kelas', 'kelas.id=tugas_siswa.kelas_id')
            ->join('mapel', 'mapel.id=tugas_siswa.mapel_id')
            ->where('tugas_siswa.no_regis_siswa', $no_regis)
            ->where('tugas_siswa.tugas_id', $id)
            ->get()->getRowObject();
    }
}
