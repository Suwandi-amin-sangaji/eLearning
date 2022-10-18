<?= $this->extend('layout/siswa/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-dark">Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <?php if (session()->getFlashdata('berhasil')) : ?>
        <script>
            Swal.fire(
                'Success',
                'Data Berhasil <?= session()->getFlashdata("berhasil"); ?>',
                'success'
            )
        </script>
    <?php endif; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-info card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url(); ?>/user-file/img/<?= $siswa->gambar; ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $siswa->nama_siswa; ?></h3>

                            <p class="text-muted text-center"><?= $siswa->email; ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>No Registrasi</b> <a class="float-right"><?= $siswa->no_regis; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Kelas</b> <a class="float-right"><?= $siswa->nama_kelas; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <?php if ($siswa->is_active == 1) : ?>
                                        <b>Status</b> <a class="float-right badge badge-info text-white">Active</a>
                                    <?php else : ?>
                                        <b>Status</b> <a class="float-right badge badge-danger text-white">De Active</a>
                                    <?php endif; ?>
                                </li>
                                <li class="list-group-item">
                                    <b>Role</b> <a class="float-right">Student</a>
                                </li>
                            </ul>

                            <a href="<?= base_url(); ?>/siswa/editprofile" class="btn btn-info btn-block"><b>Edit Profile</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-exclamation-triangle"></i>
                                Info
                            </h3>
                        </div>
                        <div class="card-body">
                            <?php if ($pemberitahuan_tugas != null || $pemberitahuan_materi != null) : ?>
                                <?php foreach ($pemberitahuan_tugas as $pt) : ?>
                                    <a href="<?= base_url(); ?>/siswa/lihattugas/<?= encrypt_url($pt->tugas_id); ?>">
                                        <div class="alert alert-info alert-dismissible">
                                            <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
                                            <h6><i class="icon fas fa-info"></i> New Assignment!</h6>
                                            <?= $pt->nama; ?><br>
                                            Post New assignment<br>
                                            <span style="font-style: italic">"<?= $pt->nama_tugas; ?>"</span><br>
                                            Due Date <?= $pt->due_date; ?>
                                        </div>
                                    </a>
                                <?php endforeach; ?>

                                <?php foreach ($pemberitahuan_materi as $pm) : ?>
                                    <a href="<?= base_url(); ?>/siswa/lihatmateri/<?= encrypt_url($pm->materi_id); ?>">
                                        <div class="alert alert-info alert-dismissible">
                                            <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
                                            <h6><i class="icon fas fa-info"></i> New Material!</h6>
                                            <?= $pm->nama; ?><br>
                                            Post New Material<br>
                                            <span style="font-style: italic">"<?= $pm->nama_materi; ?>"</span>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <h5>Tidak ada Pemberitahuan</h5>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>