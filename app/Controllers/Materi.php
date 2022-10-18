<?php

namespace App\Controllers;

use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Models\MapelModel;
use App\Models\KelasModel;
use App\Models\GurumapelModel;
use App\Models\GurukelasModel;
use App\Models\MailsettingModel;
use App\Models\MateriModel;
use App\Models\KomentarModel;
use App\Models\MaterisiswaModel;

class Materi extends BaseController
{
    protected $AdminModel;
    protected $GuruModel;
    protected $SiswaModel;
    protected $MapelModel;
    protected $KelasModel;
    protected $MailsettingModel;
    protected $GurumapelModel;
    protected $GurukelasModel;
    protected $MateriModel;
    protected $MaterisiswaModel;

    public function __construct()
    {
        $this->GuruModel = new GuruModel();
        $this->SiswaModel = new SiswaModel();
        $this->MapelModel = new MapelModel();
        $this->KelasModel = new KelasModel();
        $this->MailsettingModel = new MailsettingModel();
        $this->GurukelasModel = new GurukelasModel();
        $this->GurumapelModel = new GurumapelModel();
        $this->MateriModel = new MateriModel();
        $this->KomentarModel = new KomentarModel();
        $this->MaterisiswaModel = new MaterisiswaModel();


        $this->email = \Config\Services::email();
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        if (is_guru() == false && is_logged_in() == false) {
            return redirect()->back();
        }

        $data['judul'] = "Guru | Materi";
        $data['menu'] = [
            'profile' => '',
            'edit_profile' => '',
            'edit_password' => '',
            'materi' => 'active',
            'tugas' => ''
        ];
        $guru = $this->GuruModel->asObject()->where(['email' => session()->get('email')])->first();
        $data['materi'] = $this->MateriModel->getAllMateriByGuru($guru->no_regis);

        return view('guru/materi', $data);
    }

    public function addmateri()
    {
        if (is_guru() == false && is_logged_in() == false) {
            return redirect()->back();
        }

        $data['judul'] = "Guru | Materi";
        $data['menu'] = [
            'profile' => '',
            'edit_profile' => '',
            'edit_password' => '',
            'materi' => 'active',
            'tugas' => ''
        ];
        $guru = $this->GuruModel->asObject()->where(['email' => session()->get('email')])->first();
        $data['gurukelas'] = $this->GurukelasModel->getAllbyGuru($guru->no_regis);
        $data['gurumapel'] = $this->GurumapelModel->getAllbyGuru($guru->no_regis);
        $data['validation'] = $this->validation;
        return view('guru/tambah-materi', $data);
    }

    public function addmateri_()
    {
        $guru = $this->GuruModel->asObject()->where(['email' => session()->get('email')])->first();
        $siswa = $this->SiswaModel->getAllByIdkelas($this->request->getVar('kelas'));
        if ($siswa == null) {
            session()->setFlashdata('error', 'Tidak Ada');
            return redirect()->to('/materi/addmateri')->withInput();
        }
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

            $this->email->setSubject('Materi');
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
                    <p style="color: #000;">' . $guru->nama . ' Post New Material for you</p>
                    <p style="color: #000;">' . $this->request->getVar('nama_materi') . '</p>
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
        $this->MateriModel->save([
            'nama_materi' => $this->request->getVar('nama_materi'),
            'guru' => $guru->no_regis,
            'mapel' => $this->request->getVar('mapel'),
            'kelas' => $this->request->getVar('kelas'),
            'bikin_manual' => $this->request->getVar('bikin_manual'),
            'date_created' => time()
        ]);
        $materi = $this->MateriModel->asObject()->orderBy('id_materi', 'DESC')->first();
        $data = [];
        foreach ($siswa as $s) {
            array_push($data, [
                'no_regis_guru' => $guru->no_regis,
                'no_regis_siswa' => $s->no_regis,
                'materi_id' => $materi->id_materi,
                'kelas_id' => $s->id_kelas,
                'mapel_id' => $this->request->getVar('mapel'),
                'date_send' => time()
            ]);
        }
        $this->MaterisiswaModel->insertBatch($data);
        session()->setFlashdata('berhasil', 'Ditambahkan');
        return redirect()->to('/materi');
    }

    public function edit($id)
    {
        if (is_guru() == false && is_logged_in() == false) {
            return redirect()->back();
        }
        $id_materi = decrypt_url($id);

        $data['judul'] = "Guru | Edit Materi";
        $data['menu'] = [
            'profile' => '',
            'edit_profile' => '',
            'edit_password' => '',
            'materi' => 'active',
            'tugas' => ''
        ];
        $guru = $this->GuruModel->asObject()->where(['email' => session()->get('email')])->first();
        $data['gurukelas'] = $this->GurukelasModel->getAllbyGuru($guru->no_regis);
        $data['gurumapel'] = $this->GurumapelModel->getAllbyGuru($guru->no_regis);
        $data['validation'] = $this->validation;
        $data['materi'] = $this->MateriModel->asObject()->find($id_materi);

        return view('guru/edit-materi', $data);
    }

    public function edit_()
    {
        if (is_guru() == false && is_logged_in() == false) {
            return redirect()->back();
        }

        $guru = $this->GuruModel->asObject()->where(['email' => session()->get('email')])->first();

        $this->MateriModel->save([
            'id_materi' => $this->request->getVar('id_materi'),
            'nama_materi' => $this->request->getVar('nama_materi'),
            'guru' => $guru->no_regis,
            'mapel' => $this->request->getVar('mapel'),
            'kelas' => $this->request->getVar('kelas'),
            'bikin_manual' => $this->request->getVar('bikin_manual'),
        ]);

        session()->setFlashdata('berhasil', 'Di Ubah');
        return redirect()->to('/materi');
    }

    public function detail($id)
    {
        if (is_guru() == false && is_logged_in() == false) {
            return redirect()->back();
        }
        $id_materi = decrypt_url($id);

        $data['judul'] = "Guru | Detail Materi";
        $data['menu'] = [
            'profile' => '',
            'edit_profile' => '',
            'edit_password' => '',
            'materi' => 'active',
            'tugas' => ''
        ];
        $data['guru'] = $this->GuruModel->asObject()->where(['email' => session()->get('email')])->first();
        $data['materi'] = $this->MateriModel->asObject()->find($id_materi);
        $data['kelas'] = $this->KelasModel->asObject()->find($data['materi']->kelas);
        $data['mapel'] = $this->MapelModel->asObject()->find($data['materi']->mapel);

        // dd($data['mapel']->nama_mapel);

        return view('guru/lihat-materi', $data);
    }

    public function hapusmateri($id)
    {
        $id_materi = decrypt_url($id);
        $materi = $this->MateriModel->asObject()->find($id_materi);
        $komentar = $this->KomentarModel->asObject()->where(['id_materi' => $id_materi])->find();
        if ($komentar != null) {
            $this->KomentarModel->where(['id_materi' => $id_materi])->delete();
        }
        if ($materi->unggah_materi != null) {
            unlink('file-upload/' . $materi->unggah_materi);
        }
        $this->MateriModel->delete($id_materi);
        session()->setFlashdata('berhasil', 'Di Hapus');
        return redirect()->to('/materi');
    }

    public function uploadmateri()
    {
        if (is_guru() == false && is_logged_in() == false) {
            return redirect()->back();
        }

        $data['judul'] = "Guru | Upload Materi";
        $data['menu'] = [
            'profile' => '',
            'edit_profile' => '',
            'edit_password' => '',
            'materi' => 'active',
            'tugas' => ''
        ];
        $guru = $this->GuruModel->asObject()->where(['email' => session()->get('email')])->first();
        $data['gurukelas'] = $this->GurukelasModel->getAllbyGuru($guru->no_regis);
        $data['gurumapel'] = $this->GurumapelModel->getAllbyGuru($guru->no_regis);
        $data['validation'] = $this->validation;
        return view('guru/upload-materi', $data);
    }

    public function uploadmateri_()
    {
        if (is_guru() == false && is_logged_in() == false) {
            return redirect()->back();
        }

        $guru = $this->GuruModel->asObject()->where(['email' => session()->get('email')])->first();
        $siswa = $this->SiswaModel->getAllByIdkelas($this->request->getVar('kelas'));
        if ($siswa == null) {
            session()->setFlashdata('error', 'Tidak Ada');
            return redirect()->to('/materi/uploadmateri')->withInput();
        }
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

            $this->email->setSubject('Materi');
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
                    <p style="color: #000;">' . $guru->nama . ' Post New Material for you</p>
                    <p style="color: #000;">' . $this->request->getVar('nama_materi') . '</p>
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

        $file = $this->request->getFile('unggah_materi');
        $nama_file = $file->getName();
        $file->move('file-upload', str_replace(' ', '_', $nama_file));

        $this->MateriModel->save([
            'nama_materi' => $this->request->getVar('nama_materi'),
            'guru' => $guru->no_regis,
            'mapel' => $this->request->getVar('mapel'),
            'kelas' => $this->request->getVar('kelas'),
            'catatan' => $this->request->getVar('catatan'),
            'unggah_materi' => str_replace(' ', '_', $nama_file),
            'date_created' => time()
        ]);

        $materi = $this->MateriModel->asObject()->orderBy('id_materi', 'DESC')->first();
        $data = [];
        foreach ($siswa as $s) {
            array_push($data, [
                'no_regis_guru' => $guru->no_regis,
                'no_regis_siswa' => $s->no_regis,
                'materi_id' => $materi->id_materi,
                'kelas_id' => $s->id_kelas,
                'mapel_id' => $this->request->getVar('mapel'),
                'date_send' => time()
            ]);
        }
        $this->MaterisiswaModel->insertBatch($data);
        session()->setFlashdata('berhasil', 'Ditambahkan');
        return redirect()->to('/materi');
    }

    public function editupload_()
    {
        if (is_guru() == false && is_logged_in() == false) {
            return redirect()->back();
        }
        $id_materi = $this->request->getVar('id_materi');
        $materi = $this->MateriModel->asObject()->find($id_materi);
        $file = $this->request->getFile('unggah_materi');

        if ($file == null) {
            $unggah_materi = $materi->unggah_materi;
        } else {
            $file = $this->request->getFile('unggah_materi');
            $unggah_materi = str_replace(' ', '_', $file->getName());
            $file->move('file-upload', $unggah_materi);
            unlink('file-upload/' . $materi->unggah_materi);
        }

        $this->MateriModel->save([
            'id_materi' => $id_materi,
            'nama_materi' => $this->request->getVar('nama_materi'),
            'mapel' => $this->request->getVar('mapel'),
            'kelas' => $this->request->getVar('kelas'),
            'catatan' => $this->request->getVar('catatan'),
            'unggah_materi' => $unggah_materi
        ]);

        session()->setFlashdata('berhasil', 'Di Ubah');
        return redirect()->to('/materi');
    }

    // SUMMERNOTE
    public function upload_image()
    {
        if ($this->request->getFile('file')) {
            $data_file = $this->request->getFile('file');
            $data_name = $data_file->getRandomName();
            $data_file->move("user-file/uploads/", $data_name);

            echo base_url("user-file/uploads/$data_name");
        }
    }

    public function delete_image()
    {
        $src = $this->request->getVar('src');

        if ($src != null) {
            $file_name = str_replace(base_url() . "/", "", $src);
            if (unlink($file_name)) {
                echo "File Dihapus";
            }
        }
    }

    public function listGambar()
    {
        $files = array_filter(glob('user-file/uploads/*'), 'is_file');
        $response = [];

        foreach ($files as $file) {
            if (strpos($file, "index.html")) {
                continue;
            }
            $response[] = basename($file);
        }

        header("content-Type:aplication/json");
        echo json_encode($response);
        exit;
    }
    // END::SUMMERNOTE
}
