<?php

namespace App\Controllers;

use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Models\KelasModel;

class Mpdfadmin extends BaseController
{
    protected $GuruModel;
    protected $SiswaModel;
    protected $KelasModel;
    public function __construct()
    {
        $this->GuruModel = new GuruModel();
        $this->SiswaModel = new SiswaModel();
        $this->KelasModel = new KelasModel();
    }

    public function printbykelas($id)
    {
        $siswa = $this->SiswaModel->getAllByIdkelas($id);
        $kelas = $this->KelasModel->asObject()->find($id);
        $nama_file = "Data Siswa Kelas " . $kelas->nama_kelas;

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);

        $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Data Mahasiswa</title>
            <style>
                body{
                    font-family: sans-serif;
                }
                table{
                    border: 0.1px solid #708090;
                }
                tr:nth-child(event){
                    background-color: #ddd;
                }
                tr td{
                    text-align: center;
                    border: 0.1px solid #708090;
                    font-weight: 20;
                }
            </style>
        </head>
        <body>
            <h3 align="center">
            MADRASAH ALIYAH NEGERI 1 KARAWANG<br>
            <small>KANTOR KEMENTRIAN AGAMA KABUPATEN KARAWANG</small><br>
            <small>MADRASAH ALIYAH NEGERI 1 KARAWANG</small><br>
            <small>Jalan Lapang Karya Bhakti No. 05 Ds. Mekarmaya Kec Cilamaya Wetan Telp (0264) 24049</small><br>
            <hr>
        </h3>
        <p>Data Siswa Kelas <strong>' . $kelas->nama_kelas . '</strong></p>
            <table cellpadding="5" cellspacing="0" width="100%">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nomor Registrasi</th>
                            <th>Gender</th>
                        </tr>
                    </thead>
                    <tbody>';
        $i = 1;
        foreach ($siswa as $row) {
            $html .= '<tr align="center">
                            <td>' . $i++ . '</td>
                            <td>' . $row->nama_siswa . '</td>
                            <td>' . $row->no_regis . '</td>
                            <td>' . $row->jenis_kelamin . '</td>
                        </tr>';
        }
        $html .=    '</tbody>
                </table>
            </body>
            </html>
            ';

        $mpdf->WriteHTML($html);
        return $mpdf->Output("$nama_file.pdf", \Mpdf\Output\Destination::INLINE);
    }

    public function printallsiswa()
    {
        $siswa = $this->SiswaModel->asObject()->findAll();
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Data Mahasiswa</title>
            <style>
                body{
                    font-family: sans-serif;
                }
                table{
                    border: 0.1px solid #708090;
                }
                tr:nth-child(event){
                    background-color: #ddd;
                }
                tr td{
                    text-align: center;
                    border: 0.1px solid #708090;
                    font-weight: 20;
                }
            </style>
        </head>
        <body>
            <h3 align="center">
            MADRASAH ALIYAH NEGERI 1 KARAWANG<br>
            <small>KANTOR KEMENTRIAN AGAMA KABUPATEN KARAWANG</small><br>
            <small>MADRASAH ALIYAH NEGERI 1 KARAWANG</small><br>
            <small>Jalan Lapang Karya Bhakti No. 05 Ds. Mekarmaya Kec Cilamaya Wetan Telp (0264) 24049</small><br>
            <hr>
        </h3>
        <p>Data Siswa Semua Kelas</p>
            <table cellpadding="5" cellspacing="0" width="100%">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nomor Registrasi</th>
                            <th>Gender</th>
                        </tr>
                    </thead>
                    <tbody>';
        $i = 1;
        foreach ($siswa as $row) {
            $html .= '<tr align="center">
                            <td>' . $i++ . '</td>
                            <td>' . $row->nama_siswa . '</td>
                            <td>' . $row->no_regis . '</td>
                            <td>' . $row->jenis_kelamin . '</td>
                        </tr>';
        }
        $html .=    '</tbody>
                </table>
            </body>
            </html>
            ';

        $mpdf->WriteHTML($html);
        $mpdf->Output("data-siswa.pdf", \Mpdf\Output\Destination::INLINE);
    }

    public function printguru()
    {
        $guru = $this->GuruModel->asObject()->findAll();
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);

        $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Data Guru</title>
            <style>
                body{
                    font-family: sans-serif;
                }
                table{
                    border: 0.1px solid #708090;
                }
                tr:nth-child(event){
                    background-color: #ddd;
                }
                tr td{
                    text-align: center;
                    border: 0.1px solid #708090;
                    font-weight: 20;
                }
            </style>
        </head>
        <body>
            <h3 align="center">
            MADRASAH ALIYAH NEGERI 1 KARAWANG<br>
            <small>KANTOR KEMENTRIAN AGAMA KABUPATEN KARAWANG</small><br>
            <small>MADRASAH ALIYAH NEGERI 1 KARAWANG</small><br>
            <small>Jalan Lapang Karya Bhakti No. 05 Ds. Mekarmaya Kec Cilamaya Wetan Telp (0264) 24049</small><br>
            <hr>
        </h3>
        <p>Data Guru</p>
            <table cellpadding="5" cellspacing="0" width="100%">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nomor Registrasi</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>';
        $i = 1;
        foreach ($guru as $row) {
            $html .= '<tr align="center">
                            <td>' . $i++ . '</td>
                            <td>' . $row->nama . '</td>
                            <td>' . $row->no_regis . '</td>
                            <td>' . $row->email . '</td>
                        </tr>';
        }
        $html .=    '</tbody>
                </table>
            </body>
            </html>
            ';

        $mpdf->WriteHTML($html);
        $mpdf->Output("data-guru.pdf", \Mpdf\Output\Destination::INLINE);
    }
}
