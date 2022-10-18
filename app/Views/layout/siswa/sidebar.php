<?php

use App\Models\SiswaModel;

$this->SiswaModel = new SiswaModel();

use App\Models\TugassiswaModel;

$this->TugassiswaModel = new TugassiswaModel();

use App\Models\MaterisiswaModel;

$this->MaterisiswaModel = new MaterisiswaModel();
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-dark-primary">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="<?= base_url(); ?>/assets/icon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Rumah Baca Keik Tsinagi</span>
    </a>
    <?php
    $saya = $this->SiswaModel->getSiswa(session()->get('email'));
    $pemberitahuan_tugas = $this->TugassiswaModel->getPemberitahuanByNoRegis($saya->no_regis, 0);
    $pemberitahuan_materi = $this->MaterisiswaModel->getPemberitahuanByNoRegis($saya->no_regis);
    ?>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3">
            <div class="info text-center" style="width: 100%">
                <a href="<?= base_url(); ?>/siswa" class="d-block">STUDENT</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">USER</li>
                <li class="nav-item">
                    <a href="<?= base_url(); ?>/siswa" class="nav-link <?= $menu['profile']; ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="<?= base_url(); ?>/siswa/editprofile" class="nav-link <?= $menu['edit_profile']; ?>">
                        <i class="nav-icon fas fa-user-edit"></i>
                        <p>
                            Edit Profile
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url(); ?>/siswa/editpassword" class="nav-link <?= $menu['edit_password']; ?>">
                        <i class="nav-icon fas fa-key"></i>
                        <p>
                            Change Password
                        </p>
                    </a>
                </li>
                <li class="nav-header" style="padding: .5rem;">STUDENTS</li>
                <li class="nav-item">
                    <a href="<?= base_url(); ?>/siswa/materi" class="nav-link <?= $menu['materi']; ?>">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Materi
                            <?= ($pemberitahuan_materi != null) ? '<span class="badge badge-danger ml-auto">' . count($pemberitahuan_materi) . '</span>' : ""; ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url(); ?>/siswa/tugas" class="nav-link <?= $menu['tugas']; ?>">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Tugas
                            <?= ($pemberitahuan_tugas != null) ? '<span class="badge badge-danger ml-auto">' . count($pemberitahuan_tugas) . '</span>' : ""; ?>
                        </p>
                    </a>
                </li>
                <div class="mt-1" style="border-top: 1px solid rgba(255,255,255,0.2);"></div>
                <li class="nav-item mt-2">
                    <a href="<?= base_url(); ?>/auth/logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>