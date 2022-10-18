<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Models\MapelModel;
use App\Models\KelasModel;
use App\Models\MateriModel;
use App\Models\TugasModel;
use App\Models\KomentarModel;
use App\Models\TugassiswaModel;
use App\Models\MaterisiswaModel;

class Siswa extends BaseController
{
    protected $AdminModel;
    protected $GuruModel;
    protected $SiswaModel;
    protected $MapelModel;
    protected $KelasModel;
    protected $MateriModel;
    protected $TugasModel;
    protected $KomentarModel;
    protected $MaterisiswaModel;

    public function __construct()
    {
        $this->AdminModel = new AdminModel();
        $this->GuruModel = new GuruModel();
        $this->SiswaModel = new SiswaModel();
        $this->MapelModel = new MapelModel();
        $this->KelasModel = new KelasModel();
        $this->MateriModel = new MateriModel();
        $this->TugasModel = new TugasModel();
        $this->KomentarModel = new KomentarModel();
        $this->TugassiswaModel = new TugassiswaModel();
        $this->MaterisiswaModel = new MaterisiswaModel();

        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        if (is_siswa() == false && is_logged_in() == false) {
            return redirect()->back();
        }
        // Judul Halaman
        $data['judul'] = 'Siswa | Profile';
        $data['menu'] = [
            'profile' => 'active',
            'edit_profile' => '',
            'edit_password' => '',
            'materi' => '',
            'tugas' => ''
        ];
        $data['siswa'] = $this->SiswaModel->getSiswa(session()->get('email'));
        $data['pemberitahuan_tugas'] = $this->TugassiswaModel->getPemberitahuanByNoRegis($data['siswa']->no_regis, 0);
        $data['pemberitahuan_materi'] = $this->MaterisiswaModel->getPemberitahuanByNoRegis($data['siswa']->no_regis);

        return view('siswa/profile', $data);
    }

    public function editprofile()
    {
        if (is_siswa() == false && is_logged_in() == false) {
            return redirect()->back();
        }
        // Judul Halaman
        $data['judul'] = 'Siswa | Edit Profile';
        $data['menu'] = [
            'profile' => '',
            'edit_profile' => 'active',
            'edit_password' => '',
            'materi' => '',
            'tugas' => ''
        ];
        $data['siswa'] = $this->SiswaModel->getSiswa(session()->get('email'));
        $data['validation'] = \Config\Services::validation();

        return view('siswa/edit-profile', $data);
    }

    public function editprofile_()
    {
        if (!$this->validate([
            'gambar' => [
                'rules' => 'max_size[gambar,2024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran tidak boleh melebihi 2MB',
                    'is_image' => 'file yang dipilih harus gambar',
                    'mime_in' => 'file yang dipilih harus gambar'
                ]
            ]
        ])) {
            return redirect()->to('/siswa/editprofile/')->withInput();
        }

        $fileGambar = $this->request->getFile('gambar');

        // Cek Gambar, Apakah Tetap Gambar lama
        if ($fileGambar->getError() == 4) {
            $nama_gambar = $this->request->getVar('gambar_lama');
        } else {
            // Generate nama file Random
            $nama_gambar = $fileGambar->getRandomName();
            // Upload Gambar
            $fileGambar->move('user-file/img', $nama_gambar);
            // hapus File Yang Lama
            if ($this->request->getVar('gambar_lama') != 'default.png') {
                unlink('user-file/img/' . $this->request->getVar('gambar_lama'));
            }
        }

        $this->SiswaModel
            ->where('email', $this->request->getVar('email'))
            ->set([
                'nama_siswa' => $this->request->getVar('nama'),
                'gambar' => $nama_gambar
            ])
            ->update();

        session()->setFlashdata('berhasil', 'Di Ubah');
        return redirect()->to('/siswa');
    }

    public function editpassword()
    {
        $data['judul'] = 'Siswa | Ubah password';
        $data['menu'] = [
            'profile' => '',
            'edit_profile' => '',
            'edit_password' => 'active',
            'materi' => '',
            'tugas' => ''
        ];
        $data['validation'] = \Config\Services::validation();
        return view('siswa/edit-password', $data);
    }

    public function editpassword_()
    {
        if (is_siswa() == false && is_logged_in() == false) {
            return redirect()->back();
        }

        if (!$this->validate([
            'new_password2' => [
                'rules' => 'matches[new_password1]',
                'errors' => [
                    'matches' => 'Password Tidak sama',
                ]
            ],
            'new_password1' => [
                'rules' => 'matches[new_password2]',
                'errors' => [
                    'matches' => 'Password Tidak sama',
                ]
            ],
        ])) {
            return redirect()->to('/siswa/editpassword/')->withInput();
        }
        $siswa = $this->SiswaModel->getSiswa(session()->get('email'));

        $current_password = $this->request->getVar('current_password');

        // Cek Apakah Password sekarang benar
        if (password_verify($current_password, $siswa->password)) {
            $this->SiswaModel
                ->where('email', $siswa->email)
                ->set([
                    'password' => password_hash($this->request->getVar('new_password1'), PASSWORD_DEFAULT),
                ])
                ->update();

            session()->setFlashdata('berhasil', 'Di Ubah');
            return redirect()->to('/siswa/editpassword');
        } else {
            session()->setFlashdata('password', 'Salah');
            return redirect()->to('/siswa/editpassword');
        }
    }

    public function materi()
    {
        if (is_siswa() == false && is_logged_in() == false) {
            return redirect()->back();
        }
        // Judul Halaman
        $data['judul'] = 'Siswa | Materi';
        $siswa = $this->SiswaModel->getSiswa(session()->get('email'));
        $data['menu'] = [
            'profile' => '',
            'edit_profile' => '',
            'edit_password' => '',
            'materi' => 'active',
            'tugas' => ''
        ];
        $data['materi'] = $this->MateriModel->getAllMateriByIdKelas($siswa->id_kelas);
        return view('siswa/materi', $data);
    }

    public function lihatmateri($id)
    {
        $id_materi = decrypt_url($id);
        $data['judul'] = 'Siswa | Lihat Materi';
        $data['menu'] = [
            'profile' => '',
            'edit_profile' => '',
            'edit_password' => '',
            'materi' => 'active',
            'tugas' => ''
        ];
        $data['siswa'] = $this->SiswaModel->getSiswa(session()->get('email'));

        $this->MaterisiswaModel
            ->where('no_regis_siswa', $data['siswa']->no_regis)
            ->where('materi_id', $id_materi)
            ->delete();

        $data['materi'] = $this->MateriModel->getMateriById($id_materi);
        return view('siswa/lihat-materi', $data);
    }

    public function tugas()
    {
        if (is_siswa() == false && is_logged_in() == false) {
            return redirect()->back();
        }
        // Judul Halaman
        $data['judul'] = 'Siswa | Tugas';
        $siswa = $this->SiswaModel->getSiswa(session()->get('email'));
        $data['menu'] = [
            'profile' => '',
            'edit_profile' => '',
            'edit_password' => '',
            'materi' => '',
            'tugas' => 'active'
        ];
        $data['tugas'] = $this->TugasModel->getAllTugasByIdKelas($siswa->id_kelas);
        return view('siswa/tugas', $data);
    }

    public function lihattugas($id)
    {
        $id_tugas = decrypt_url($id);
        if (is_siswa() == false && is_logged_in() == false) {
            return redirect()->back();
        }
        // Judul Halaman
        $data['judul'] = 'Siswa | Lihat Tugas';
        $data['siswa'] = $this->SiswaModel->getSiswa(session()->get('email'));
        $data['menu'] = [
            'profile' => '',
            'edit_profile' => '',
            'edit_password' => '',
            'materi' => '',
            'tugas' => 'active'
        ];
        $data['tugas'] = $this->TugassiswaModel->getByIdTugasNoRegisSiswa($id_tugas, $data['siswa']->no_regis);
        return view('siswa/lihat-tugas', $data);
    }

    public function essay()
    {
        date_default_timezone_set('Asia/Jakarta');

        $tugas = $this->TugassiswaModel->getByIdTugasNoRegisSiswa($this->request->getVar('tugas_id'), $this->request->getVar('no_regis_siswa'));
        if (strtotime(date('Y-m-d H:i', time())) > strtotime($tugas->due_date)) {
            $telat = 1;
        } else {
            $telat = 0;
        }

        $this->TugassiswaModel->save([
            'id_tugas_siswa' => $this->request->getVar('id_tugas_siswa'),
            'essay' => $this->request->getVar('essay'),
            'telat' => $telat,
            'date_send' => time(),
            'dikerjakan' => 1
        ]);

        session()->setFlashdata('berhasil', 'Di Simpan');
        return redirect()->to('/siswa/lihattugas/' . encrypt_url($tugas->tugas_id));
    }

    public function tugas_upload()
    {
        date_default_timezone_set('Asia/Jakarta');

        $tugas = $this->TugassiswaModel->getByIdTugasNoRegisSiswa($this->request->getVar('tugas_id'), $this->request->getVar('no_regis_siswa'));
        if (strtotime(date('Y-m-d H:i', time())) > strtotime($tugas->due_date)) {
            $telat = 1;
        } else {
            $telat = 0;
        }

        $file = $this->request->getFile('file');

        // Generate nama file Random
        $file_siswa = str_replace(' ', '_', $file->getName());
        $file->move('file-upload', $file_siswa);

        // Upload Gambar
        $this->TugassiswaModel->save([
            'id_tugas_siswa' => $this->request->getVar('id_tugas_siswa'),
            'file_siswa' => $file_siswa,
            'telat' => $telat,
            'date_send' => time(),
            'dikerjakan' => 1
        ]);
        session()->setFlashdata('berhasil', 'Di Simpan');
        return redirect()->to('/siswa/lihattugas/' . encrypt_url($tugas->tugas_id));
    }
}
