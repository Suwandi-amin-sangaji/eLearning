<?php

namespace App\Controllers;

use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Models\MapelModel;
use App\Models\KelasModel;
use App\Models\GurumapelModel;
use App\Models\GurukelasModel;
use App\Models\MailsettingModel;
use App\Models\TugasModel;
use App\Models\komentugasModel;
use App\Models\TugassiswaModel;

class Tugas extends BaseController
{
    protected $AdminModel;
    protected $GuruModel;
    protected $SiswaModel;
    protected $MapelModel;
    protected $KelasModel;
    protected $MailsettingModel;
    protected $GurumapelModel;
    protected $GurukelasModel;
    protected $TugasModel;
    protected $komentugasModel;
    protected $TugassiswaModel;

    public function __construct()
    {
        $this->GuruModel = new GuruModel();
        $this->SiswaModel = new SiswaModel();
        $this->MapelModel = new MapelModel();
        $this->KelasModel = new KelasModel();
        $this->MailsettingModel = new MailsettingModel();
        $this->GurukelasModel = new GurukelasModel();
        $this->GurumapelModel = new GurumapelModel();
        $this->TugasModel = new TugasModel();
        $this->komentugasModel = new komentugasModel();
        $this->TugassiswaModel = new TugassiswaModel();

        $this->email = \Config\Services::email();
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        if (is_guru() == false && is_logged_in() == false) {
            return redirect()->back();
        }

        $data['judul'] = "Guru | Tugas";
        $data['menu'] = [
            'profile' => '',
            'edit_profile' => '',
            'edit_password' => '',
            'materi' => '',
            'tugas' => 'active'
        ];
        $guru = $this->GuruModel->asObject()->where(['email' => session()->get('email')])->first();
        $data['tugas'] = $this->TugasModel->getAllTugasByGuru($guru->no_regis);

        return view('guru/tugas', $data);
    }

    public function addTugas()
    {
        if (is_guru() == false && is_logged_in() == false) {
            return redirect()->back();
        }

        $data['judul'] = "Guru | Tambah Tugas";
        $data['menu'] = [
            'profile' => '',
            'edit_profile' => '',
            'edit_password' => '',
            'materi' => '',
            'tugas' => 'active'
        ];
        $guru = $this->GuruModel->asObject()->where(['email' => session()->get('email')])->first();
        $data['gurukelas'] = $this->GurukelasModel->getAllbyGuru($guru->no_regis);
        $data['gurumapel'] = $this->GurumapelModel->getAllbyGuru($guru->no_regis);
        $data['validation'] = $this->validation;

        return view('guru/tambah-tugas', $data);
    }
    public function addTugas_()
    {
        $guru = $this->GuruModel->asObject()->where(['email' => session()->get('email')])->first();
        $siswa = $this->SiswaModel->getAllByIdkelas($this->request->getVar('kelas'));

        if ($siswa == null) {
            session()->setFlashdata('error', 'Tidak Ada');
            return redirect()->to('/tugas/addtugas')->withInput();
        }
        $tugas_siswa = [];

        $mail = $this->MailsettingModel->asObject()->first();
        foreach ($siswa as $s) {
            $config['SMTPHost'] = $mail->smtp_host;
            $config['SMTPUser'] = $mail->smtp_user;
            $config['SMTPPass'] = $mail->smtp_password;
            $config['SMTPPort'] = $mail->smtp_port;
            $config['SMTPCrypto'] = $mail->smtp_crypto;

            $this->email->initialize($config);

            $this->email->setNewline("\r\n");

            $this->email->setFrom($mail->smtp_user, 'Smart Student E-Learning');
            $this->email->setTo($s->email);

            $this->email->setSubject('Tugas');
            $this->email->setMessage('
            <div class="kotak" style=" position: relative; padding: 15px; color: #fff; font-family: comic sans ms;">
                <div class="atas"
                style="width: 100%; height: 60px; line-height: 60px; font-size: 20px ; padding-left: 10px;  color: #fff; background-color: dodgerblue;">
                    Notification
                </div>
                <div class="isi" style="padding: 20px; position: relative; color:#000;">
                    <center>
                        <h1>Smart Students</h1>
                        <small style="color: #000;">version 2.0 by abduloh</small>
                    </center>
                    <p style="color: #000;">Hello ' . $s->nama_siswa . '</p>
                    <p style="color: #000;">' . $guru->nama . ' Post New Assignment for you</p>
                    <p style="color: #000;">' . $this->request->getVar('nama_tugas') . '</p>
                    <p style="color: #000;">Due Date ' . $this->request->getVar('tgl') . ' ' . $this->request->getVar('jam') . '</p>
                </div>
                <div class="bawah"
                    style=" width: 100%; background-color: dodgerblue; height: 60px; line-height: 60px; text-align: center;">
                    Copyright ©E-Learning by Abduloh 2020
                </div>
            </div>');
            if ($this->email->send()) {
                continue;
            } else {
                echo $this->email->printDebugger();
                die();
            }
        }

        $file = $this->request->getFile('nama_file');
        if ($file->getError() == 4) {
            $nama_file = null;
        } else {
            $nama_file = str_replace(' ', '_', $file->getName());
            $file->move('file-upload', $nama_file);
        }

        $this->TugasModel->save([
            'nama_tugas' => $this->request->getVar('nama_tugas'),
            'guru' => $guru->no_regis,
            'kelas' => $this->request->getVar('kelas'),
            'mapel' => $this->request->getVar('mapel'),
            'pesan' => $this->request->getVar('pesan'),
            'file' => $nama_file,
            'is_essay' => $this->request->getVar('is_essay'),
            'date_created' => time(),
            'due_date' => $this->request->getVar('tgl') . ' ' . $this->request->getVar('jam')
        ]);

        $tugas = $this->TugasModel->asObject()->orderBy('id_tugas', 'DESC')->first();
        foreach ($siswa as $s) {
            array_push($tugas_siswa, [
                'no_regis_guru' => $guru->no_regis,
                'no_regis_siswa' => $s->no_regis,
                'tugas_id' => $tugas->id_tugas,
                'kelas_id' => $s->id_kelas,
                'mapel_id' => $this->request->getVar('mapel'),
                'essay' => null,
                'file_siswa' => null,
                'nilai' => null,
                'telat' => null,
                'date_send' => null,
                'dikerjakan' => 0
            ]);
        }

        $this->TugassiswaModel->insertBatch($tugas_siswa);
        session()->setFlashdata('berhasil', 'Ditambahkan');
        return redirect()->to('/tugas');
    }

    public function lihattugas($id)
    {
        if (is_guru() == false && is_logged_in() == false) {
            return redirect()->back();
        }

        $id_tugas = decrypt_url($id);
        $data['judul'] = "Guru | Lihat Tugas";
        $data['menu'] = [
            'profile' => '',
            'edit_profile' => '',
            'edit_password' => '',
            'materi' => '',
            'tugas' => 'active'
        ];
        $data['tugas'] = $this->TugasModel->getTugasById($id_tugas);
        $data['tugas_siswa'] = $this->TugassiswaModel->getAllByIdTugas($id_tugas);
        // $data['guru'] = $this->GuruModel->getGuru(session()->get('email'));

        return view('guru/lihat-tugas', $data);
    }

    public function edittugas($id)
    {
        if (is_guru() == false && is_logged_in() == false) {
            return redirect()->back();
        }

        $id_tugas = decrypt_url($id);
        $data['judul'] = "Guru | Edit Tugas";
        $data['menu'] = [
            'profile' => '',
            'edit_profile' => '',
            'edit_password' => '',
            'materi' => '',
            'tugas' => 'active'
        ];
        $data['tugas'] = $this->TugasModel->getTugasById($id_tugas);
        $guru = $this->GuruModel->asObject()->where(['email' => session()->get('email')])->first();
        $data['gurukelas'] = $this->GurukelasModel->getAllbyGuru($guru->no_regis);
        $data['gurumapel'] = $this->GurumapelModel->getAllbyGuru($guru->no_regis);
        $data['validation'] = $this->validation;

        return view('guru/edit-tugas', $data);
    }

    public function edittugas_()
    {
        $guru = $this->GuruModel->asObject()->where(['email' => session()->get('email')])->first();
        $file = $this->request->getFile('nama_file');

        if ($file->getError() == 4) {
            $nama_file = $this->request->getVar('file_lawas');
        } else {
            $nama_file = str_replace(' ', '_', $file->getName());
            $file->move('file-upload', $nama_file);
            unlink('file-upload/' . $this->request->getVar('file_lawas'));
        }

        $this->TugasModel->save([
            'id_tugas' => $this->request->getVar('id_tugas'),
            'nama_tugas' => $this->request->getVar('nama_tugas'),
            'guru' => $guru->no_regis,
            'kelas' => $this->request->getVar('kelas'),
            'mapel' => $this->request->getVar('mapel'),
            'pesan' => $this->request->getVar('pesan'),
            'file' => $nama_file,
            'due_date' => $this->request->getVar('tgl') . ' ' . $this->request->getVar('jam')
        ]);

        session()->setFlashdata('berhasil', 'Di Ubah');
        return redirect()->to('/tugas');
    }

    public function hapustugas($id)
    {
        if (is_guru() == false && is_logged_in() == false) {
            return redirect()->back();
        }

        $id_tugas = decrypt_url($id);
        $this->TugassiswaModel->where(['tugas_id' => $id_tugas])->delete();
        $this->TugasModel->delete($id_tugas);

        session()->setFlashdata('berhasil', 'Di Hapus');
        return redirect()->to('/tugas');
    }

    public function tugas_siswa($no_regis, $id_tugas)
    {
        if (is_guru() == false && is_logged_in() == false) {
            return redirect()->back();
        }

        $data['judul'] = "Guru | Tugas Siswa";
        $data['menu'] = [
            'profile' => '',
            'edit_profile' => '',
            'edit_password' => '',
            'materi' => '',
            'tugas' => 'active'
        ];
        $data['tugas_siswa'] = $this->TugassiswaModel->getByIdTugasNoRegisSiswa(decrypt_url($id_tugas), decrypt_url($no_regis));

        return view('guru/tugas-siswa', $data);
    }

    public function nilai()
    {

        $this->TugassiswaModel
            ->where('no_regis_siswa', $this->request->getVar('no_regis'))
            ->where('tugas_id', $this->request->getVar('id_tugas'))
            ->set([
                'nilai' => $this->request->getVar('nilai')
            ])
            ->update();

        session()->setFlashdata('berhasil', 'Di Simpan');
        return redirect()->to('/tugas/lihattugas/' . encrypt_url($this->request->getVar('id_tugas')));
    }
}
