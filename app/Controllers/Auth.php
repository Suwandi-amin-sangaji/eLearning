<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use App\Models\MailsettingModel;
use App\Models\UsertokenModel;

class Auth extends BaseController
{
    protected $AdminModel;
    protected $GuruModel;
    protected $SiswaModel;
    protected $KelasModel;
    protected $MailsettingModel;
    protected $UsertokenModel;
    public function __construct()
    {
        $this->AdminModel = new AdminModel();
        $this->GuruModel = new GuruModel();
        $this->SiswaModel = new SiswaModel();
        $this->KelasModel = new KelasModel();
        $this->MailsettingModel = new MailsettingModel();
        $this->UsertokenModel = new UsertokenModel();
        $this->validation = \Config\Services::validation();
        $this->email = \Config\Services::email();
    }

    public function index()
    {
        if (sudah_install() == 0) {
            return redirect()->to('/installasi');
        }
        $data['validation'] = $this->validation;
        return view('auth/index', $data);
    }

    public function login()
    {
        if (sudah_install() == 0) {
            redirect()->to('/installasi');
        }
        // dd($this->request->getVar());
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $admin = $this->AdminModel->getAdmin($email);

        // Jika yg login Admin
        if ($admin != null) {
            // Cek Password
            if (password_verify($password, $admin->password)) {
                session()->set([
                    'email' => $email,
                    'role_id' => 1 //Role Id 1 adalah Admin
                ]);
                // Jika Password Benar Arahkan Ke Halaman Admin
                return redirect()->to('/admin');
            } else {
                session()->setFlashdata(
                    'pesan',
                    '<script>
                        Swal.fire(
                            "Error",
                            "Password Salah",
                            "error"
                        )
                    </script>'
                );
                return redirect()->to('/auth')->withInput();
            }
        }

        // Jika yg Login Guru
        $guru = $this->GuruModel->getGuru($email);
        if ($guru != null) {
            // Cek Akun Aktif
            if ($guru->is_active == 0) {
                session()->setFlashdata(
                    'pesan',
                    '<script>
                        Swal.fire(
                            "Error",
                            "Status Akun tidak Aktif",
                            "error"
                        )
                    </script>'
                );

                return redirect()->to('/auth');
            }
            // Cek Password
            if (password_verify($password, $guru->password)) {
                session()->set([
                    'email' => $email,
                    'role_id' => 2 //Role Id 2 adalah guru
                ]);
                // Jika Password Benar Arahkan Ke Halaman Guru
                return redirect()->to('/guru');
            } else {
                session()->setFlashdata(
                    'pesan',
                    '<script>
                        Swal.fire(
                            "Error",
                            "Password Salah",
                            "error"
                        )
                    </script>'
                );
                return redirect()->to('/auth')->withInput();
            }
        }

        // Jika yg Login Siswa
        $siswa = $this->SiswaModel->getSiswaSaja($email);
        // dd($siswa->is_active);
        if ($siswa != null) {
            // Cek Akun Aktif
            if ($siswa->is_active != 1) {
                session()->setFlashdata(
                    'pesan',
                    '<script>
                        Swal.fire(
                            "Error",
                            "Status Akun tidak Aktif",
                            "error"
                        )
                    </script>'
                );
                return redirect()->to('/auth');
            }
            // Cek Password
            if (password_verify($password, $siswa->password)) {
                session()->set([
                    'email' => $email,
                    'role_id' => 3 //Role Id 2 adalah Siswa
                ]);
                // Jika Password Benar Arahkan Ke Halaman Siswa
                return redirect()->to('/siswa');
            } else {
                session()->setFlashdata(
                    'pesan',
                    '<script>
                        Swal.fire(
                            "Error",
                            "Password Salah",
                            "error"
                        )
                    </script>'
                );
                return redirect()->to('/auth')->withInput();
            }
        }

        session()->setFlashdata(
            'pesan',
            '<script>
                Swal.fire(
                    "Error",
                    "Akun tidak ditemukan",
                    "error"
                )
            </script>'
        );

        return redirect()->to('/auth');
    }

    public function registration()
    {
        if (sudah_install() == 0) {
            redirect()->to('/installasi');
        }
        if ($this->request->getVar('is_student') != null) {
            // SISWA
            if (!$this->validate([
                'email_regis' => [
                    'rules' => 'required|is_unique[siswa.email]',
                    'errors' => [
                        'required' => 'Email harus di isi',
                        'is_unique' => 'Email sudah Terdaftar'
                    ]
                ],
                'password_regis' => [
                    'rules' => 'required|matches[password_regis2]',
                    'errors' => [
                        'required' => 'Password harus di isi',
                        'matches' => 'Password Tidak sama'
                    ]
                ],
                'password_regis2' => [
                    'rules' => 'required|matches[password_regis]',
                    'errors' => [
                        'required' => 'Password harus di isi',
                        'matches' => 'Password Tidak sama'
                    ]
                ],
            ])) {
                return redirect()->to('/auth')->withInput();
            }
            $kelas = $this->KelasModel->asObject()->where(['class_code' => $this->request->getVar('kode_kelas')])->first();
            if ($kelas == null) {
                session()->setFlashdata(
                    'pesan',
                    '<script>
                        Swal.fire(
                            "Error",
                            "Kode kelas Salah",
                            "error"
                        )
                    </script>'
                );
                return redirect()->to('/auth')->withInput();
            }
            $siswa = $this->SiswaModel->asObject()->orderBy('id', 'DESC')->first();
            // SIAPKAN DATA SISWA
            $data_siswa = [
                'nama_siswa' => $this->request->getVar('name_regis'),
                'no_regis' => ($siswa->no_regis + 1),
                'jenis_kelamin' => $this->request->getVar('jk'),
                'id_kelas' => $kelas->id,
                'email' => $this->request->getVar('email_regis'),
                'password' => password_hash($this->request->getVar('password_regis'), PASSWORD_DEFAULT),
                'gambar' => "default.png",
                'role_id' => 3,
                'is_active' => 0
            ];
            // SIAPKAN DATA TOKEN
            $token = random_string('alnum', 36);
            $data_token = [
                'email' => $this->request->getVar('email_regis'),
                'token' => $token,
                'date_created' => time()
            ];

            // KIRIM VERIFIKASI VIA EMAIL
            $mail = $this->MailsettingModel->asObject()->first();

            $config['SMTPHost'] = $mail->smtp_host;
            $config['SMTPUser'] = $mail->smtp_user;
            $config['SMTPPass'] = $mail->smtp_password;
            $config['SMTPPort'] = $mail->smtp_port;
            $config['SMTPCrypto'] = $mail->smtp_crypto;

            $this->email->initialize($config);

            $this->email->setNewline("\r\n");

            $this->email->setFrom($mail->smtp_user, 'Smart Student E-Learning');
            $this->email->setTo($this->request->getVar('email_regis'));

            $this->email->setSubject('Aktivasi AKun Smart Student');
            $this->email->setMessage('
            <div class="kotak" style=" position: relative; padding: 15px; color: #fff; font-family: comic sans ms;">
                    <div class="atas"
                        style="width: 100%; height: 60px; line-height: 60px; font-size: 20px ; padding-left: 10px;  color: #fff; background-color: dodgerblue;">
                        Activate Your Account
                    </div>
                    <div class="isi" style="padding: 20px; position: relative; color: #000">
                        <center>
                            <h1>Smart Students</h1>
                                <small style="color: #000;">version 1.0 by abduloh</small>
                        </center>
                        <p style="color: #000;">Click the button to verify your account</p>
                        <a href="' . base_url() . '/auth/verify?email=' . $this->request->getVar('email_regis') . '&token=' . $token . '"
                            style="display: block; color:#fff; width: 200px;height: 50px; background-color: dodgerblue; border-radius: 30px; text-align: center; line-height: 50px; text-decoration: none; color: #fff; margin: 20px auto;">Activate</a>
                    </div>
                    <div class="bawah"
                        style="color: #fff; width: 100%; background-color: dodgerblue; height: 60px; line-height: 60px; text-align: center;">
                        Copyright ©E-Learning by Abduloh 2020
                    </div>
            </div>');

            if ($this->email->send()) {
                // INSERT DATA SISWA
                $this->SiswaModel->save($data_siswa);
                // INSERT DATA TOKEN
                $this->UsertokenModel->save($data_token);
                session()->setFlashdata(
                    'pesan',
                    '<script>
                        Swal.fire(
                            "Berhasil",
                            "Silahkan Lakukan Verifikasi Via Email",
                            "success"
                        )
                    </script>'
                );
                return redirect()->to('/auth');
            } else {
                echo $this->email->printDebugger();
                die();
            }
        } else {
            if (!$this->validate([
                'email_regis' => [
                    'rules' => 'required|is_unique[guru.email]',
                    'errors' => [
                        'required' => 'Email harus di isi',
                        'is_unique' => 'Email sudah Terdaftar'
                    ]
                ],
                'password_regis' => [
                    'rules' => 'required|matches[password_regis2]',
                    'errors' => [
                        'required' => 'Password harus di isi',
                        'matches' => 'Password Tidak sama'
                    ]
                ],
                'password_regis2' => [
                    'rules' => 'required|matches[password_regis]',
                    'errors' => [
                        'required' => 'Password harus di isi',
                        'matches' => 'Password Tidak sama'
                    ]
                ],
            ])) {
                return redirect()->to('/auth')->withInput();
            }

            $guru = $this->GuruModel->asObject()->orderBy('id', 'DESC')->first();
            // SIAPKAN DATA GURU
            $data_guru = [
                'no_regis' => ($guru->no_regis + 1),
                'nama' => $this->request->getVar('name_regis'),
                'email' => $this->request->getVar('email_regis'),
                'password' => password_hash($this->request->getVar('password_regis'), PASSWORD_DEFAULT),
                'gambar' => "default.png",
                'role_id' => 2,
                'is_active' => 0
            ];

            $this->GuruModel->save($data_guru);
            session()->setFlashdata(
                'pesan',
                '<script>
                    Swal.fire(
                        "Berhasil",
                        "Akun Disimpan, Silahkan Tunggu Sampai Admin Mengaktifkan Akun Anda",
                        "success"
                    )
                </script>'
            );
            return redirect()->to('/auth');
        }
    }

    public function verify()
    {
        if (sudah_install() == 0) {
            redirect()->to('/installasi');
        }
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');

        $siswa = $this->SiswaModel->getSiswa($email);

        if ($siswa != null) {
            $user_token = $this->UsertokenModel->getUserToken($email, $token);
            if ($user_token != null) {
                if (time() - $user_token->date_created < (60 * 60 * 24)) {
                    $this->SiswaModel
                        ->where('email', $email)
                        ->set('is_active', 1)
                        ->update();
                    $this->UsertokenModel->delete($user_token->id);
                    session()->setFlashdata(
                        'pesan',
                        '<script>
                            Swal.fire(
                                "Berhasil",
                                "Akun Sudah Aktif",
                                "success"
                            )
                        </script>'
                    );
                    return redirect()->to('/auth');
                } else {
                    $this->UsertokenModel->delete($user_token->id);
                    session()->setFlashdata(
                        'pesan',
                        '<script>
                            Swal.fire(
                                "Error",
                                "Token Expired",
                                "error"
                            )
                        </script>'
                    );
                    return redirect()->to('/auth');
                }
            } else {
                session()->setFlashdata(
                    'pesan',
                    '<script>
                        Swal.fire(
                            "Error",
                            "Token Salah",
                            "error"
                        )
                    </script>'
                );
                return redirect()->to('/auth');
            }
        } else {
            session()->setFlashdata(
                'pesan',
                '<script>
                    Swal.fire(
                        "Error",
                        "Email tidak ditemukan",
                        "error"
                    )
                </script>'
            );
            return redirect()->to('/auth');
        }
    }

    public function forgotpassword()
    {
        if (sudah_install() == 0) {
            redirect()->to('/installasi');
        }
        $data['judul'] = 'Smart Student | Forgot Password';
        $data['validation'] = $this->validation;
        return view('auth/lupa-password', $data);
    }

    public function forgotpassword_()
    {
        if (sudah_install() == 0) {
            redirect()->to('/installasi');
        }
        if (!$this->validate([
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email harus di isi'
                ]
            ]
        ])) {
            return redirect()->to('/auth/forgotpassword')->withInput();
        }

        $user = $this->SiswaModel->getSiswa($this->request->getVar('email'));
        if ($user == null) {
            $user = $this->GuruModel->getGuru($this->request->getVar('email'));
        }

        if ($user == null) {
            session()->setFlashdata(
                'pesan',
                '<script>
                    Swal.fire(
                        "Error",
                        "Email tidak ditemukan",
                        "error"
                    )
                </script>'
            );
            return redirect()->to('/auth/forgotpassword')->withInput();
        }

        // CEK AKUN. GURU ATAU SISWA?
        if ($user->role_id == 2) {
            $halaman = "forgotpasswordguru";
        } else {
            $halaman = "forgotpasswordsiswa";
        }

        $token = random_string('alnum', 36);
        $data_token = [
            'email' => $this->request->getVar('email'),
            'token' => $token,
            'date_created' => time()
        ];

        // KIRIM VERIFIKASI VIA EMAIL
        $mail = $this->MailsettingModel->asObject()->first();

        $config['SMTPHost'] = $mail->smtp_host;
        $config['SMTPUser'] = $mail->smtp_user;
        $config['SMTPPass'] = $mail->smtp_password;
        $config['SMTPPort'] = $mail->smtp_port;
        $config['SMTPCrypto'] = $mail->smtp_crypto;

        $this->email->initialize($config);

        $this->email->setNewline("\r\n");

        $this->email->setFrom($mail->smtp_user, 'Smart Student E-Learning');
        $this->email->setTo($this->request->getVar('email'));

        $this->email->setSubject('Lupa Password');
        $this->email->setMessage('
        <div class="kotak" style=" position: relative; padding: 15px; color: #fff; font-family: comic sans ms;">
                <div class="atas"
                    style="width: 100%; height: 60px; line-height: 60px; font-size: 20px ; padding-left: 10px;  color: #fff; background-color: dodgerblue;">
                    Lupa Password
                </div>
                <div class="isi" style="padding: 20px; position: relative; color: #000">
                    <center>
                        <h1>Smart Students</h1>
                            <small style="color: #000;">version 1.0 by abduloh</small>
                    </center>
                    <p style="color: #000;">Klik Tombol dibawah untuk mereset password</p>
                    <a href="' . base_url() . '/auth/' . $halaman . '?email=' . $this->request->getVar('email') . '&token=' . $token . '"
                        style="display: block; color:#fff; width: 200px;height: 50px; background-color: dodgerblue; border-radius: 30px; text-align: center; line-height: 50px; text-decoration: none; color: #fff; margin: 20px auto;">Reset Password</a>
                </div>
                <div class="bawah"
                    style="color: #fff; width: 100%; background-color: dodgerblue; height: 60px; line-height: 60px; text-align: center;">
                    Copyright ©E-Learning by Abduloh 2020
                </div>
        </div>');

        if ($this->email->send()) {
            // INSERT DATA TOKEN
            $this->UsertokenModel->save($data_token);
            session()->setFlashdata(
                'pesan',
                '<script>
                        Swal.fire(
                            "Berhasil",
                            "Formulir Reset password sudah dikirim ke email kamu",
                            "success"
                        )
                    </script>'
            );
            return redirect()->to('/auth');
        } else {
            echo $this->email->printDebugger();
            die();
        }
    }

    public function forgotpasswordguru()
    {
        if (sudah_install() == 0) {
            redirect()->to('/installasi');
        }
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');

        $user_token = $this->UsertokenModel->getUserToken($email, $token);

        if ($user_token == null) {
            session()->setFlashdata(
                'pesan',
                '<script>
                    Swal.fire(
                        "Error",
                        "Email / Token Salah",
                        "error"
                    )
                </script>'
            );
            return redirect()->to('/auth');
        }
        $data['email'] = $email;
        $data['token'] = $token;
        $data['validation'] = $this->validation;

        return view('auth/password-guru', $data);
    }

    public function forgotpasswordguru_()
    {
        if (sudah_install() == 0) {
            redirect()->to('/installasi');
        }
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');
        if (!$this->validate([
            'password1' => [
                'rules' => 'required|matches[password2]',
                'errors' => [
                    'required' => 'Password harus di isi',
                    'matches' => 'Password Tidak sama'
                ]
            ],
            'password2' => [
                'rules' => 'required|matches[password1]',
                'errors' => [
                    'required' => 'Password harus di isi',
                    'matches' => 'Password Tidak sama'
                ]
            ],
        ])) {
            return redirect()->to('/auth/forgotpasswordguru?email=' . $email . '&token=' . $token)->withInput();
        }

        $this->GuruModel
            ->where('email', $email)
            ->set('password', password_hash($this->request->getVar('password1'), PASSWORD_DEFAULT))
            ->update();

        $this->UsertokenModel
            ->where('email', $email)
            ->where('token', $token)
            ->delete();

        session()->setFlashdata(
            'pesan',
            '<script>
                Swal.fire(
                    "Berhasil",
                    "Password Telah Diubah",
                    "success"
                )
            </script>'
        );
        return redirect()->to('/auth');
    }

    public function forgotpasswordsiswa()
    {
        if (sudah_install() == 0) {
            redirect()->to('/installasi');
        }
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');

        $user_token = $this->UsertokenModel->getUserToken($email, $token);

        if ($user_token == null) {
            session()->setFlashdata(
                'pesan',
                '<script>
                    Swal.fire(
                        "Error",
                        "Email / Token Salah",
                        "error"
                    )
                </script>'
            );
            return redirect()->to('/auth');
        }
        $data['email'] = $email;
        $data['token'] = $token;
        $data['validation'] = $this->validation;
        return view('auth/password-siswa', $data);
    }

    public function forgotpasswordsiswa_()
    {
        if (sudah_install() == 0) {
            redirect()->to('/installasi');
        }
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');
        if (!$this->validate([
            'password1' => [
                'rules' => 'required|matches[password2]',
                'errors' => [
                    'required' => 'Password harus di isi',
                    'matches' => 'Password Tidak sama'
                ]
            ],
            'password2' => [
                'rules' => 'required|matches[password1]',
                'errors' => [
                    'required' => 'Password harus di isi',
                    'matches' => 'Password Tidak sama'
                ]
            ],
        ])) {
            return redirect()->to('/auth/forgotpasswordsiswa?email=' . $email . '&token=' . $token)->withInput();
        }

        $this->SiswaModel
            ->where('email', $email)
            ->set('password', password_hash($this->request->getVar('password1'), PASSWORD_DEFAULT))
            ->update();

        $this->UsertokenModel
            ->where('email', $email)
            ->where('token', $token)
            ->delete();

        session()->setFlashdata(
            'pesan',
            '<script>
                Swal.fire(
                    "Berhasil",
                    "Password Telah Diubah",
                    "success"
                )
            </script>'
        );
        return redirect()->to('/auth');
    }

    public function logout()
    {
        if (sudah_install() == 0) {
            redirect()->to('/installasi');
        }
        // session()->destroy();
        session()->setFlashdata(
            'pesan',
            '<script>
                Swal.fire(
                    "Berhasil",
                    "Anda sudah logout",
                    "success"
                )
            </script>'
        );
        session()->destroy();
        return redirect()->to('/auth');
    }
}
