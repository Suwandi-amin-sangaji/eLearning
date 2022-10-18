<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Models\MapelModel;
use App\Models\KelasModel;
use App\Models\GurumapelModel;
use App\Models\GurukelasModel;
use App\Models\MailsettingModel;

class Admin extends BaseController
{
    protected $AdminModel;
    protected $GuruModel;
    protected $SiswaModel;
    protected $MapelModel;
    protected $KelasModel;
    protected $MailsettingModel;
    public function __construct()
    {
        $this->AdminModel = new AdminModel();
        $this->GuruModel = new GuruModel();
        $this->SiswaModel = new SiswaModel();
        $this->MapelModel = new MapelModel();
        $this->KelasModel = new KelasModel();
        $this->MailsettingModel = new MailsettingModel();

        $this->email = \Config\Services::email();
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        if (is_admin() == false && is_logged_in() == false) {
            return redirect()->back();
        }

        $data['user'] = $this->AdminModel->getAdmin(session()->get('email'));

        // Judul Halaman
        $data['judul'] = 'Smart Student | Admin Dashboard';
        $data['menu'] = [
            'profile' => '',
            'dropdown' => '',
            'dashboard' => 'active',
            'control_panel' => ''
        ];

        // Mengambil Url Ke 1
        $data['url_ke'] = $this->request->uri->getSegment(2);

        // Jumlah Siswa & guru
        $data['totalSiswa'] = $this->SiswaModel->countAllResults();
        $data['totalGuru'] = $this->GuruModel->countAllResults();
        // Data Mapel
        $data['mapel'] = $this->MapelModel->asObject()->findAll();
        // Data Kelas
        $data['kelas'] = $this->KelasModel->asObject()->findAll();

        // Data Guru yang Akunnya tidak aktif
        $data['guruNotActive'] = $this->GuruModel->getGuruTidakAktif();

        return view('admin/index', $data);
    }

    public function profile()
    {
        $data['menu'] = [
            'profile' => 'active',
            'dropdown' => '',
            'dashboard' => '',
            'control_panel' => ''
        ];

        if (is_admin() == false && is_logged_in() == false) {
            return redirect()->back();
        }
        // Judul Halaman
        $data['judul'] = 'Smart Student | Profile';
        $data['admin'] = $this->AdminModel->getAdmin(session()->get('email'));


        $data['mail'] = $this->MailsettingModel->asObject()->first();

        return view('admin/profile', $data);
    }

    public function ControlPanel()
    {
        if (is_admin() == false && is_logged_in() == false) {
            return redirect()->back();
        }

        // Judul Halaman
        $data['judul'] = 'Smart Student | Admin Dashboard';
        $data['menu'] = [
            'profile' => '',
            'dropdown' => 'menu-open',
            'dashboard' => 'active',
            'control_panel' => 'active'
        ];
        // Mengambil Url ke 2
        $data['url_ke'] = $this->request->uri->getSegment(2);

        // Data siswa
        $data['siswa'] = $this->SiswaModel->getAll();
        // Data Guru
        $data['guru'] = $this->GuruModel->asObject()->findAll();

        // Data Mapel
        $data['mapel'] = $this->MapelModel->asObject()->findAll();
        // Data Kelas
        $data['kelas'] = $this->KelasModel->asObject()->findAll();

        return view('admin/control-panel', $data);
    }

    // START::FUNGSI KELOLA SISWA
    public function AddStudent()
    {
        if (is_admin() == false && is_logged_in() == false) {
            return redirect()->back();
        }

        // Judul Halaman
        $data['judul'] = "Smart Student | Tambah Siswa";
        $data['menu'] = [
            'profile' => '',
            'dropdown' => 'menu-open',
            'dashboard' => 'active',
            'control_panel' => 'active'
        ];

        // Mengambil Url Ke 2
        $data['url_ke'] = $this->request->uri->getSegment(1);
        $data['validation'] = $this->validation;

        // Data siswa
        $data['siswa'] = $this->SiswaModel->getAll();
        // Data Kelas
        $data['kelas'] = $this->KelasModel->asObject()->findAll();
        // Siswa Baris Paling Akhir
        $data['row_akhir'] = $this->SiswaModel->asObject()->orderBy('id', 'DESC')->first();

        return view('admin/tambah-siswa', $data);
    }

    public function saveSiswa()
    {
        if (is_admin() == false && is_logged_in() == false) {
            return redirect()->back();
        }

        if (!$this->validate([
            'email' => [
                'rules' => 'required|is_unique[siswa.email]',
                'errors' => [
                    'required' => '{field} Email harus di isi',
                    'is_unique' => '{field} sudah Terdaftar'
                ]
            ],
        ])) {
            return redirect()->to('/admin/addstudent')->withInput();
        }
        $kelas = $this->KelasModel->getKelas($this->request->getVar('id_kelas'));
        $mail = $this->MailsettingModel->asObject()->first();

        $config['SMTPHost'] = $mail->smtp_host;
        $config['SMTPUser'] = $mail->smtp_user;
        $config['SMTPPass'] = $mail->smtp_password;
        $config['SMTPPort'] = $mail->smtp_port;
        $config['SMTPCrypto'] = $mail->smtp_crypto;

        $this->email->initialize($config);

        $this->email->setNewline("\r\n");

        $this->email->setFrom($mail->smtp_user, 'Rumah Baca Keik Tsinagi');
        $this->email->setTo($this->request->getVar('email'));

        $this->email->setSubject('Akun Rumah Baca Keik Tsinagi');
        $this->email->setMessage('
        <div class="kotak" style=" position: relative; padding: 15px; color: #fff; font-family: comic sans ms;">
                <div class="atas"
                    style="width: 100%; height: 60px; line-height: 60px; font-size: 20px ; padding-left: 10px;  color: #fff; background-color: dodgerblue;">
                    Your Account
                </div>
                <div class="isi" style="padding: 20px; position: relative; color: #000">
                    <center>
                        <h1>Rumah Baca Keik Tsinagi</h1>
                            <small style="color: #000;"></small>
                    </center>
                    <p style="color: #000;">Hallo ' . $this->request->getVar('nama_siswa') . ' Here Is Your Account</p>
                    <ul>
                        <li>Name     : ' . $this->request->getVar('nama_siswa') . '</li>
                        <li>Email    : ' . $this->request->getVar('email') . '</li>
                        <li>Kelas    : ' . $kelas->nama_kelas . '</li>
                        <li>Password : ' . $this->request->getVar('no_regis') . '</li>
                    </ul>
                </div>
                <div class="bawah"
                    style="color: #fff; width: 100%; background-color: dodgerblue; height: 60px; line-height: 60px; text-align: center;">
                    Copyright ©<?php echo date(d/m/Y) Developer Sorong?>
</div>
</div>');

if ($this->email->send()) {
$this->SiswaModel->save([
'nama_siswa' => $this->request->getVar('nama_siswa'),
'no_regis' => $this->request->getVar('no_regis'),
'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
'id_kelas' => $this->request->getVar('id_kelas'),
'email' => $this->request->getVar('email'),
'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
'gambar' => 'default.png',
'role_id' => 3,
'is_active' => 1,
]);

session()->setFlashdata('berhasil', 'Ditambahkan');
return redirect()->to('/admin/controlpanel');
} else {
echo $this->email->printDebugger();
die();
}
}

public function deleteStudent($no_regis)
{
if (is_admin() == false && is_logged_in() == false) {
return redirect()->back();
}

// Cari Siswa Berdasarkan no_regis
$noRegis = decrypt_url($no_regis);
$siswa = $this->SiswaModel->getByNoregis($noRegis);
// dd($siswa);
// HAPUS GAMBAR
// Cek Jika File Gambarnya Default

if ($siswa->gambar != 'default.png') {
unlink('user-file/img/' . $siswa->gambar);
}
$this->SiswaModel->where(['no_regis' => $noRegis])->delete();
session()->setFlashdata('berhasil', 'Dihapus');
return redirect()->to('/admin/controlpanel');
}

public function updateSiswa($no_regis)
{
if (is_admin() == false && is_logged_in() == false) {
return redirect()->back();
}

$noRegis = decrypt_url($no_regis);

// Judul Halaman
$data['judul'] = "Rumah Baca Keik Tsinagi | Update Siswa";
$data['menu'] = [
'profile' => '',
'dropdown' => 'menu-open',
'dashboard' => 'active',
'control_panel' => 'active'
];

// Mengambil Url Ke 2
$data['url_ke'] = $this->request->uri->getSegment(1);
$data['validation'] = $this->validation;

// Data siswa
$data['siswa'] = $this->SiswaModel->getByNoregis($noRegis);
// Data Kelas
$data['kelas'] = $this->KelasModel->asObject()->findAll();

return view('admin/edit-siswa', $data);
}

public function editsiswa()
{
if (is_admin() == false && is_logged_in() == false) {
return redirect()->back();
}

if (!$this->validate([
'email' => [
'rules' => 'required',
'errors' => [
'required' => '{field} Email harus di isi'
]
],
])) {
return redirect()->to('/admin/updatesiswa/' . encrypt_url($this->request->getVar('no_regis')))->withInput();
}

$this->SiswaModel
->where('no_regis', $this->request->getVar('no_regis'))
->set([
'nama_siswa' => $this->request->getVar('nama_siswa'),
'no_regis' => $this->request->getVar('no_regis'),
'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
'id_kelas' => $this->request->getVar('id_kelas'),
'email' => $this->request->getVar('email'),
'is_active' => $this->request->getVar('is_active')
])
->update();

session()->setFlashdata('berhasil', 'Di Update');
return redirect()->to('/admin/controlpanel');
}
// END::FUNGSI KELOLA SISWA

// START::FUNGSI KELOLA GURU

public function addteacher()
{
if (is_admin() == false && is_logged_in() == false) {
return redirect()->back();
}

// Judul Halaman
$data['judul'] = "Rumah Baca Keik Tsinagi | Tambah Guru";
$data['menu'] = [
'profile' => '',
'dropdown' => 'menu-open',
'dashboard' => 'active',
'control_panel' => 'active'
];

// Mengambil Url Ke 2
$data['url_ke'] = $this->request->uri->getSegment(1);
$data['validation'] = $this->validation;

// Guru Baris Paling Akhir
$data['row_akhir'] = $this->GuruModel->asObject()->orderBy('id', 'DESC')->first();

// dd($data['row_akhir']);

return view('admin/tambah-guru', $data);
}

public function saveguru()
{
if (is_admin() == false && is_logged_in() == false) {
return redirect()->back();
}

if (!$this->validate([
'email' => [
'rules' => 'required|is_unique[guru.email]',
'errors' => [
'required' => '{field} Email harus di isi',
'is_unique' => '{field} sudah Terdaftar'
]
],
])) {
return redirect()->to('/admin/addteacher')->withInput();
}
$mail = $this->MailsettingModel->asObject()->first();

$config['SMTPHost'] = $mail->smtp_host;
$config['SMTPUser'] = $mail->smtp_user;
$config['SMTPPass'] = $mail->smtp_password;
$config['SMTPPort'] = $mail->smtp_port;
$config['SMTPCrypto'] = $mail->smtp_crypto;

$this->email->initialize($config);

$this->email->setNewline("\r\n");

$this->email->setFrom($mail->smtp_user, 'Rumah Baca Keik Tsinagi');
$this->email->setTo($this->request->getVar('email'));

$this->email->setSubject('Akun Pengajar Rumah Baca Keik Tsinagi');
$this->email->setMessage('
<div class="kotak" style=" position: relative; padding: 15px; color: #fff; font-family: comic sans ms;">
    <div class="atas"
        style="width: 100%; height: 60px; line-height: 60px; font-size: 20px ; padding-left: 10px;  color: #fff; background-color: dodgerblue;">
        Your Account
    </div>
    <div class="isi" style="padding: 20px; position: relative; color: #000">
        <center>
            <h1>Rumah Baca Keik Tsinagi</h1>
            <small style="color: #000;"></small>
        </center>
        <p style="color: #000;">Hallo ' . $this->request->getVar('nama_guru') . ' Here Is Your Account</p>
        <ul>
            <li>Name : ' . $this->request->getVar('nama_guru') . '</li>
            <li>Email : ' . $this->request->getVar('email') . '</li>
            <li>Password : ' . $this->request->getVar('no_regis') . '</li>
            <li>Role : Guru</li>
        </ul>
    </div>
    <div class="bawah"
        style="color: #fff; width: 100%; background-color: dodgerblue; height: 60px; line-height: 60px; text-align: center;">
        Copyright ©<?php echo date(d/m/Y) Developer Sorong?>
    </div>
</div>');

if ($this->email->send()) {
$this->GuruModel->save([
'no_regis' => $this->request->getVar('no_regis'),
'nama' => $this->request->getVar('nama_guru'),
'email' => $this->request->getVar('email'),
'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
'gambar' => 'default.png',
'role_id' => 2,
'is_active' => 1,
]);

session()->setFlashdata('berhasil', 'Ditambahkan');
return redirect()->to('/admin/controlpanel');
} else {
echo $this->email->printDebugger();
die();
}
}

public function deleteTeacher($id)
{
if (is_admin() == false && is_logged_in() == false) {
return redirect()->back();
}

$idGuru = decrypt_url($id);

// Cari Guru Berdasarkan id
$guru = $this->GuruModel->asObject()->find($idGuru);
// HAPUS GAMBAR
// Cek Jika File Gambarnya Default

if ($guru->gambar != 'default.png') {
unlink('user-file/img/' . $guru->gambar);
}
$this->GuruModel->delete($idGuru);
session()->setFlashdata('berhasil', 'Dihapus');
return redirect()->to('/admin/controlpanel');
}

public function updateteacher($id)
{
if (is_admin() == false && is_logged_in() == false) {
return redirect()->back();
}

$idGuru = decrypt_url($id);

$data['judul'] = "Smart Student | Update Guru";
$data['menu'] = [
'profile' => '',
'dropdown' => 'menu-open',
'dashboard' => 'active',
'control_panel' => 'active'
];

// Mengambil Url Ke 2
$data['url_ke'] = $this->request->uri->getSegment(1);
$data['validation'] = $this->validation;
$data['guru'] = $this->GuruModel->asObject()->find($idGuru);

return view('admin/edit-guru', $data);
}

public function editguru()
{
if (is_admin() == false && is_logged_in() == false) {
return redirect()->back();
}

if (!$this->validate([
'email' => [
'rules' => 'required',
'errors' => [
'required' => '{field} Email harus di isi'
]
],
])) {
return redirect()->to('/admin/updateguru/' . encrypt_url($this->request->getVar('no_regis')))->withInput();
}

$this->GuruModel
->where('no_regis', $this->request->getVar('no_regis'))
->set([
'no_regis' => $this->request->getVar('no_regis'),
'nama' => $this->request->getVar('nama_guru'),
'email' => $this->request->getVar('email'),
'is_active' => $this->request->getVar('is_active')
])
->update();

session()->setFlashdata('berhasil', 'Di Update');
return redirect()->to('/admin/controlpanel');
}
// END::FUNGSI KELOLA GURU

// START::FUNGSI KELOLA MAPEL
public function addMapel()
{
if (is_admin() == false && is_logged_in() == false) {
return redirect()->back();
}

$data['judul'] = "Smart Student | Tambah Mapel";
$data['menu'] = [
'profile' => '',
'dropdown' => 'menu-open',
'dashboard' => 'active',
'control_panel' => 'active'
];

// Mengambil Url Ke 2
$data['url_ke'] = $this->request->uri->getSegment(1);

return view('admin/tambah-mapel', $data);
}

public function savemapel()
{
if (is_admin() == false && is_logged_in() == false) {
return redirect()->back();
}

$this->MapelModel->save([
'nama_mapel' => $this->request->getVar('nama_mapel'),
'is_active' => 1,
]);

session()->setFlashdata('berhasil', 'Ditambahkan');
return redirect()->to('/admin/controlpanel');
}

public function editMapel($id)
{
if (is_admin() == false && is_logged_in() == false) {
return redirect()->back();
}

$idmapel = decrypt_url($id);

$data['judul'] = "Smart Student | Edit Mapel";
$data['menu'] = [
'profile' => '',
'dropdown' => 'menu-open',
'dashboard' => 'active',
'control_panel' => 'active'
];

$data['mapel'] = $this->MapelModel->asObject()->find($idmapel);

return view('admin/edit-mapel', $data);
}

public function updateMapel()
{
if (is_admin() == false && is_logged_in() == false) {
return redirect()->back();
}

$this->MapelModel
->where('id', $this->request->getVar('id'))
->set([
'nama_mapel' => $this->request->getVar('nama_mapel'),
'is_active' => $this->request->getVar('is_active'),
])
->update();

session()->setFlashdata('berhasil', 'Di Update');
return redirect()->to('/admin/controlpanel');
}

public function hapusmapel($id)
{
if (is_admin() == false && is_logged_in() == false) {
return redirect()->back();
}

$idMapel = decrypt_url($id);

$this->MapelModel->delete($idMapel);
session()->setFlashdata('berhasil', 'Dihapus');
return redirect()->to('/admin/controlpanel');
}
// END::FUNGSI KELOLA MAPEL

// START::FUNGSI KELOLA KELAS
public function addClass()
{
if (is_admin() == false && is_logged_in() == false) {
return redirect()->back();
}

$data['judul'] = "Smart Student | Tambah Kelas";
$data['menu'] = [
'profile' => '',
'dropdown' => 'menu-open',
'dashboard' => 'active',
'control_panel' => 'active'
];

// Mengambil Url Ke 2
$data['url_ke'] = $this->request->uri->getSegment(1);

return view('admin/tambah-kelas', $data);
}

public function savekelas()
{
if (is_admin() == false && is_logged_in() == false) {
return redirect()->back();
}

$this->KelasModel->save([
'nama_kelas' => $this->request->getVar('nama_kelas'),
'class_code' => $this->request->getVar('class_code'),
'is_active' => 1
]);

session()->setFlashdata('berhasil', 'Ditambahkan');
return redirect()->to('/admin/controlpanel');
}

public function hapusKelas($id)
{
if (is_admin() == false && is_logged_in() == false) {
return redirect()->back();
}

$idKelas = decrypt_url($id);
$this->KelasModel->delete($idKelas);

session()->setFlashdata('berhasil', 'Di Hapus');
return redirect()->to('/admin/controlpanel');
}

public function editKelas($id)
{
if (is_admin() == false && is_logged_in() == false) {
return redirect()->back();
}

$idKelas = decrypt_url($id);
$data['judul'] = "Smart Student | EDIT Kelas";
$data['menu'] = [
'profile' => '',
'dropdown' => 'menu-open',
'dashboard' => 'active',
'control_panel' => 'active'
];

// Mengambil Url Ke 2
$data['url_ke'] = $this->request->uri->getSegment(2);
$data['kelas'] = $this->KelasModel->asObject()->find($idKelas);

return view('admin/edit-kelas', $data);
}

public function updateKelas()
{
if (is_admin() == false && is_logged_in() == false) {
return redirect()->back();
}

$this->KelasModel
->where('id', $this->request->getVar('id'))
->set([
'nama_kelas' => $this->request->getVar('nama_kelas'),
'is_active' => $this->request->getVar('is_active'),
])
->update();

session()->setFlashdata('berhasil', 'Di Update');
return redirect()->to('/admin/controlpanel');
}
// END::FUNGSI KELOLA KELAS

// START::FUNGSI KELOLA RELASI GURU MAPEL
public function guruMapel($no_regis)
{
if (is_admin() == false && is_logged_in() == false) {
return redirect()->back();
}

$noRegis = decrypt_url($no_regis);
$data['judul'] = "Smart Student | Relasi Guru Mapel";
$data['menu'] = [
'profile' => '',
'dropdown' => 'menu-open',
'dashboard' => 'active',
'control_panel' => 'active'
];
$data['guru'] = $this->GuruModel->asObject()->where(['no_regis' => $noRegis])->first();
$data['mapel'] = $this->MapelModel->asObject()->findAll();

return view('admin/guru-mapel', $data);
}

public function relasiGuruMapel()
{
$guruMapel = new GurumapelModel();
$noRegis = decrypt_url($this->request->getVar('noRegis'));
$mapelID = $this->request->getVar('mapelId');

$result = $guruMapel
->where('no_regis', $noRegis)
->where('mapel_id', $mapelID)
->get()->getResultObject();

$mapel = $this->MapelModel->asObject()->find($mapelID);

if (count($result) < 1) { $guruMapel->save([
    'no_regis' => $noRegis,
    'mapel_id' => $mapelID,
    'mapel' => $mapel->nama_mapel
    ]);
    } else {
    $guruMapel->where(['no_regis' => $noRegis, 'mapel_id' => $mapelID])->delete();
    }

    session()->setFlashdata('berhasil', 'Di Update');
    }
    // END::FUNGSI KELOLA RELASI GURU MAPEL

    // START:: FUNGSI KELOLA RELASI GURU KELAS
    public function guruKelas($no_regis)
    {
    if (is_admin() == false && is_logged_in() == false) {
    return redirect()->back();
    }

    $noRegis = decrypt_url($no_regis);
    $data['judul'] = "Smart Student | Relasi Guru Kelas";
    $data['menu'] = [
    'profile' => '',
    'dropdown' => 'menu-open',
    'dashboard' => 'active',
    'control_panel' => 'active'
    ];
    $data['guru'] = $this->GuruModel->asObject()->where(['no_regis' => $noRegis])->first();
    $data['kelas'] = $this->KelasModel->asObject()->findAll();

    return view('admin/guru-kelas', $data);
    }

    public function relasiGuruKelas()
    {
    $guruKelas = new GurukelasModel();
    $noRegis = decrypt_url($this->request->getVar('noRegis'));
    $kelasID = $this->request->getVar('kelasId');

    $result = $guruKelas
    ->where('no_regis', $noRegis)
    ->where('kelas_id', $kelasID)
    ->get()->getResultObject();

    $kelas = $this->KelasModel->asObject()->find($kelasID);

    if (count($result) < 1) { $guruKelas->save([
        'no_regis' => $noRegis,
        'kelas_id' => $kelasID,
        'kelas' => $kelas->nama_kelas
        ]);
        } else {
        $guruKelas->where(['no_regis' => $noRegis, 'kelas_id' => $kelasID])->delete();
        }

        session()->setFlashdata('berhasil', 'Di Update');
        }
        // END:: FUNGSI KELOLA RELASI GURU KELAS

        public function settingemail()
        {

        $this->MailsettingModel->save([
        'id' => $this->request->getVar('id'),
        'smtp_host' => $this->request->getVar('smtp_host'),
        'smtp_user' => $this->request->getVar('smtp_user'),
        'smtp_password' => $this->request->getVar('smtp_password'),
        'smtp_port' => $this->request->getVar('smtp_port'),
        'smtp_crypto' => $this->request->getVar('smtp_crypto'),
        ]);

        session()->setFlashdata('berhasil', 'Di Update');
        return redirect()->to('/admin/profile');
        }
        }