<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'siswa';
    // protected $useTimestamps = true;
    protected $allowedFields = ['nama_siswa', 'no_regis', 'jenis_kelamin', 'id_kelas', 'email', 'password', 'gambar', 'role_id', 'is_active'];

    public function getSiswa($email)
    {
        return $this
            ->join('kelas', 'kelas.id=siswa.id_kelas')
            ->where('siswa.email', $email)
            ->get()->getRowObject();
    }

    public function getSiswaSaja($email)
    {
        return $this
            ->where('siswa.email', $email)
            ->get()->getRowObject();
    }

    public function getByNoregis($no_regis)
    {
        return $this->where(['no_regis' => $no_regis])->asObject()->first();
    }

    public function getAll()
    {
        return $this->db->table('siswa')
            ->join('kelas', 'kelas.id=siswa.id_kelas')
            ->orderBy('siswa.id', 'DESC')
            ->get()->getResultObject();
    }

    public function getAllByIdkelas($id)
    {
        return $this->db->table('siswa')
            ->join('kelas', 'kelas.id=siswa.id_kelas')
            ->where('siswa.id_kelas', $id)
            ->orderBy('siswa.id', 'DESC')
            ->get()->getResultObject();
    }
}
