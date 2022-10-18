<?php

namespace App\Controllers;

use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Models\MapelModel;
use App\Models\KelasModel;
use App\Models\GurumapelModel;
use App\Models\GurukelasModel;
use App\Models\MailsettingModel;

class Guru extends BaseController
{
    protected $AdminModel;
    protected $GuruModel;
    protected $SiswaModel;
    protected $MapelModel;
    protected $KelasModel;
    protected $MailsettingModel;
    protected $GurumapelModel;
    protected $GurukelasModel;

    public function __construct()
    {
        $this->GuruModel = new GuruModel();
        $this->SiswaModel = new SiswaModel();
        $this->MapelModel = new MapelModel();
        $this->KelasModel = new KelasModel();
        $this->MailsettingModel = new MailsettingModel();
        $this->GurukelasModel = new GurukelasModel();
        $this->GurumapelModel = new GurumapelModel();

        $this->email = \Config\Services::email();
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        if (is_guru() == false && is_logged_in() == false) {
            return redirect()->back();
        }

        $data['judul'] = "Guru | Profile";
        $data['menu'] = [
            'profile' => 'active',
            'edit_profile' => '',
            'edit_password' => '',
            'materi' => '',
            'tugas' => ''
        ];
        $data['guru'] = $this->GuruModel->getGuru(session()->get('email'));
        $data['gurukelas'] = $this->GurukelasModel->getAllbyGuru($data['guru']->no_regis);
        $data['gurumapel'] = $this->GurumapelModel->asObject()->where(['no_regis' => $data['guru']->no_regis])->find();

        return view('guru/profile', $data);
    }

    public function editprofile()
    {
        if (is_guru() == false && is_logged_in() == false) {
            return redirect()->back();
        }

        $data['judul'] = "Guru | Edit Profile";
        $data['menu'] = [
            'profile' => '',
            'edit_profile' => 'active',
            'edit_password' => '',
            'materi' => '',
            'tugas' => ''
        ];
        $data['guru'] = $this->GuruModel->getGuru(session()->get('email'));
        $data['validation'] = \Config\Services::validation();

        return view('guru/edit-profile', $data);
    }

    public function editprofile_()
    {
        if (is_guru() == false && is_logged_in() == false) {
            return redirect()->back();
        }


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
            return redirect()->to('/guru/editprofile/')->withInput();
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

        $this->GuruModel->save([
            'id' => $this->request->getVar('id'),
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'gambar' => $nama_gambar,
        ]);

        session()->setFlashdata('berhasil', 'Di Ubah');
        return redirect()->to('/guru');
    }

    public function changepassword()
    {
        if (is_guru() == false && is_logged_in() == false) {
            return redirect()->back();
        }

        $data['judul'] = "Guru | Edit Profile";
        $data['menu'] = [
            'profile' => '',
            'edit_profile' => '',
            'edit_password' => 'active',
            'materi' => '',
            'tugas' => ''
        ];
        $data['guru'] = $this->GuruModel->getGuru(session()->get('email'));

        $data['validation'] = \Config\Services::validation();

        return view('guru/edit-password', $data);
    }

    public function changepassword_()
    {
        if (is_guru() == false && is_logged_in() == false) {
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
            return redirect()->to('/guru/changepassword/')->withInput();
        }

        $guru = $this->GuruModel->getGuru(session()->get('email'));

        $current_password = $this->request->getVar('current_password');

        // Cek Apakah Password sekarang benar
        if (password_verify($current_password, $guru->password)) {
            $this->GuruModel->save([
                'id' => $guru->id,
                'password' => password_hash($this->request->getVar('new_password1'), PASSWORD_DEFAULT),
            ]);

            session()->setFlashdata('berhasil', 'Di Ubah');
            return redirect()->to('/guru/changepassword');
        } else {
            session()->setFlashdata('password', 'Salah');
            return redirect()->to('/guru/changepassword');
        }
    }
}
