<?php

use App\Models\GurumapelModel;
use App\Models\GurukelasModel;
use App\Models\AdminModel;

function is_logged_in()
{
    if (!session()->get('role_id')) {
        return false;
    } else {
        return true;
    }
}

function is_admin()
{
    if (session()->get('role_id') != 1) {
        return false;
    } else {
        return true;
    }
}

function is_guru()
{
    if (session()->get('role_id') != 2) {
        return false;
    } else {
        return true;
    }
}

function is_siswa()
{
    if (session()->get('role_id') != 3) {
        return false;
    } else {
        return true;
    }
}

function check_mapel($no_regis1, $id)
{
    $no_regis = decrypt_url($no_regis1);
    $guruMapel = new GurumapelModel();

    $result = $guruMapel
        ->where('no_regis', $no_regis)
        ->where('mapel_id', $id)
        ->get()->getResultObject();
    if (count($result) > 0) {
        return "checked='checked'";
    }
}

function check_kelas($no_regis1, $id)
{
    $no_regis = decrypt_url($no_regis1);
    $Gurukelas = new GurukelasModel();

    $result = $Gurukelas
        ->where('no_regis', $no_regis)
        ->where('kelas_id', $id)
        ->get()->getResultObject();
    if (count($result) > 0) {
        return "checked='checked'";
    }
}

function sudah_install()
{
    $admin = new AdminModel();

    $sudah_install = $admin->asObject()->first();
    if ($sudah_install == null) {
        return 0;
    } else {
        return 1;
    }
}
