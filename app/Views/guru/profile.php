<?= $this->extend('layout/guru/template'); ?>

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
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url(); ?>/user-file/img/<?= $guru->gambar; ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $guru->nama; ?></h3>

                            <p class="text-muted text-center"><?= $guru->email; ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>No Registrasi</b> <a class="float-right"><?= $guru->no_regis; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <?php if ($guru->is_active == 1) : ?>
                                        <b>Status</b> <a class="float-right badge badge-info text-white">Active</a>
                                    <?php else : ?>
                                        <b>Status</b> <a class="float-right badge badge-danger text-white">De Active</a>
                                    <?php endif; ?>
                                </li>
                                <li class="list-group-item">
                                    <b>Role</b> <a class="float-right">Teacher</a>
                                </li>
                            </ul>

                            <a href="<?= base_url(); ?>/guru/editprofile" class="btn btn-info btn-block"><b>Edit Profile</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-bullhorn"></i>
                                Your Classes
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php foreach ($gurukelas as $gk) : ?>
                                <div class="callout callout-info">
                                    <h5><?= $gk->kelas; ?></h5>
                                    <p>Class Code : <br><?= $gk->class_code; ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-lg-4">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-book"></i>
                                Your Lessons
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php foreach ($gurumapel as $gm) : ?>
                                <div class="callout callout-info">
                                    <h5><?= $gm->mapel; ?></h5>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>