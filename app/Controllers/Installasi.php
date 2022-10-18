<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Installasi extends BaseController
{
    public function index()
    {
        if (sudah_install() == 1) {
            return redirect()->to('/auth');
        }
        $data['judul'] = "Installasi";
        $data['validation'] = \Config\Services::validation();
        return view('auth/install', $data);
    }

    public function save()
    {
        if (sudah_install() == 1) {
            return redirect()->to('/auth');
        }
        if (!$this->validate([
            'password' => [
                'rules' => 'required|matches[passconf]',
                'errors' => [
                    'required' => 'Password harus di isi',
                    'matches' => 'Password Tidak sama'
                ]
            ],
            'passconf' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Password harus di isi',
                    'matches' => 'Password Tidak sama'
                ]
            ],
        ])) {
            return redirect()->to('/Installasi')->withInput();
        }

        $data = [
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role_id' => 1
        ];

        $admin = new AdminModel();
        $admin->save($data);

        session()->setFlashdata(
            'pesan',
            '<script>
                Swal.fire(
                    "Berhasil",
                    "Installasi sudah selesai",
                    "success"
                )
            </script>'
        );
        return redirect()->to('/auth');
    }
}
