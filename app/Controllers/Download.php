<?php

namespace App\Controllers;

use App\Models\MateriModel;
use App\Models\TugasModel;
use App\Models\TugassiswaModel;

class Download extends BaseController
{
    public function DownloadMateri($id)
    {
        $MateriModel = new MateriModel();
        $materi = $MateriModel->asObject()->find($id);

        return $this->response->download('file-upload/' . $materi->unggah_materi, null);
    }

    public function bahantugas($id)
    {
        $tugasModel = new TugasModel();
        $tugas = $tugasModel->asObject()->find($id);

        return $this->response->download('file-upload/' . $tugas->file, null);
    }

    public function tugassiswa($id, $no_regis)
    {
        $tugasModel = new TugassiswaModel();
        $tugas = $tugasModel->getByIdTugasNoRegisSiswa($id, $no_regis);

        return $this->response->download('file-upload/' . $tugas->file_siswa, null);
    }
}
