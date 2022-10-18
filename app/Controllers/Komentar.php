<?php

namespace App\Controllers;

use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Models\KomentarModel;
use App\Models\KomentugasModel;

class Komentar extends BaseController
{

    public function __construct()
    {
        $this->SiswaModel = new SiswaModel();
        $this->GuruModel = new GuruModel();
        $this->KomentarModel = new KomentarModel();
        $this->KomentugasModel = new komentugasModel();
    }

    public function getAllkomenMateri()
    {
        $idMateri = $this->request->getVar('id_materi');
        $emailUser = $this->request->getVar('email_user');

        $komentar = $this->KomentarModel->asObject()->where(['id_materi' => $idMateri])->find();
        // dd($komentar);
        $isi_komentar = '';
        foreach ($komentar as $komen) {
            $siswa = $this->SiswaModel->asObject()->where(['email' => $komen->email])->first();
            $guru = $this->GuruModel->asObject()->where(['email' => $komen->email])->first();

            if ($siswa != null) {
                if ($siswa->email == $emailUser) {
                    $isi_komentar .= '
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-right">' . $siswa->nama_siswa . '</span>
                                <span class="direct-chat-timestamp float-left">' . $komen->date_send . '</span>
                            </div>
                            <img class="direct-chat-img" src="/user-file/img/' . $siswa->gambar . '">
                            <div class="direct-chat-text">
                            ' . $komen->pesan . '
                            </div>
                        </div>
                    ';
                } else {
                    $isi_komentar .= '
                        <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-left">' . $siswa->nama_siswa . '</span>
                                <span class="direct-chat-timestamp float-right">' . $komen->date_send . '</span>
                            </div>
                            <img class="direct-chat-img" src="/user-file/img/' . $siswa->gambar . '">
                            <div class="direct-chat-text">
                            ' . $komen->pesan . '
                            </div>
                        </div>
                    ';
                }
            }

            if ($guru != null) {
                if ($guru->email == $emailUser) {
                    $isi_komentar .= '
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-right">' . $guru->nama . '</span>
                                <span class="direct-chat-timestamp float-left">' . $komen->date_send . '</span>
                            </div>
                            <img class="direct-chat-img" src="/user-file/img/' . $guru->gambar . '">
                            <div class="direct-chat-text">
                            ' . $komen->pesan . '
                            </div>
                        </div>
                    ';
                } else {
                    $isi_komentar .= '
                        <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-left">' . $guru->nama . '</span>
                                <span class="direct-chat-timestamp float-right">' . $komen->date_send . '</span>
                            </div>
                            <img class="direct-chat-img" src="/user-file/img/' . $guru->gambar . '">
                            <div class="direct-chat-text">
                            ' . $komen->pesan . '
                            </div>
                        </div>
                    ';
                }
            }
        }

        echo $isi_komentar;
    }

    public function getAllkomenTugas()
    {
        $idTugas = $this->request->getVar('id_tugas');
        $emailUser = $this->request->getVar('email_user');

        $komentar = $this->KomentugasModel->asObject()->where(['id_tugas' => $idTugas])->find();
        // dd($komentar);
        $isi_komentar = '';
        foreach ($komentar as $komen) {
            $siswa = $this->SiswaModel->asObject()->where(['email' => $komen->email])->first();
            $guru = $this->GuruModel->asObject()->where(['email' => $komen->email])->first();

            if ($siswa != null) {
                if ($siswa->email == $emailUser) {
                    $isi_komentar .= '
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-right">' . $siswa->nama_siswa . '</span>
                                <span class="direct-chat-timestamp float-left">' . $komen->date_send . '</span>
                            </div>
                            <img class="direct-chat-img" src="/user-file/img/' . $siswa->gambar . '">
                            <div class="direct-chat-text">
                            ' . $komen->pesan . '
                            </div>
                        </div>
                    ';
                } else {
                    $isi_komentar .= '
                        <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-left">' . $siswa->nama_siswa . '</span>
                                <span class="direct-chat-timestamp float-right">' . $komen->date_send . '</span>
                            </div>
                            <img class="direct-chat-img" src="/user-file/img/' . $siswa->gambar . '">
                            <div class="direct-chat-text">
                            ' . $komen->pesan . '
                            </div>
                        </div>
                    ';
                }
            }

            if ($guru != null) {
                if ($guru->email == $emailUser) {
                    $isi_komentar .= '
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-right">' . $guru->nama . '</span>
                                <span class="direct-chat-timestamp float-left">' . $komen->date_send . '</span>
                            </div>
                            <img class="direct-chat-img" src="/user-file/img/' . $guru->gambar . '">
                            <div class="direct-chat-text">
                            ' . $komen->pesan . '
                            </div>
                        </div>
                    ';
                } else {
                    $isi_komentar .= '
                        <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-left">' . $guru->nama . '</span>
                                <span class="direct-chat-timestamp float-right">' . $komen->date_send . '</span>
                            </div>
                            <img class="direct-chat-img" src="/user-file/img/' . $guru->gambar . '">
                            <div class="direct-chat-text">
                            ' . $komen->pesan . '
                            </div>
                        </div>
                    ';
                }
            }
        }

        echo $isi_komentar;
    }

    public function materi()
    {
        $this->KomentarModel->save([
            'id_materi' => $this->request->getVar('id_materi'),
            'email' => $this->request->getVar('email'),
            'pesan' => $this->request->getVar('pesan'),
        ]);
        exit;
    }

    public function tugas()
    {
        $this->KomentugasModel->save([
            'id_tugas' => $this->request->getVar('id_tugas'),
            'email' => $this->request->getVar('email'),
            'pesan' => $this->request->getVar('pesan'),
        ]);
        exit;
    }
}
