<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-graduation-cap"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Siswa</span>
                            <span class="info-box-number">
                                <?= $totalSiswa; ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-chalkboard-teacher"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Guru</span>
                            <span class="info-box-number"><?= $totalGuru; ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Mapel</span>
                            <span class="info-box-number"><?= count($mapel); ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-store-alt text-white"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Kelas</span>
                            <span class="info-box-number"><?= count($kelas); ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-6 connectedSortable">
                    <div class="card collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">Akun guru yang tidak aktif</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0" style="display: block;">
                            <ul class="nav nav-pills flex-column">
                                <?php foreach ($guruNotActive as $not) : ?>
                                    <?php if ($not != null) : ?>
                                        <li class="nav-item active">
                                            <a href="<?= base_url(); ?>/admin/ControlPanel" class="nav-link">
                                                <i class="fas fa-user-tie"></i> <?= $not->nama; ?>
                                            </a>
                                        </li>
                                    <?php else : ?>
                                        <li class="nav-item active">
                                            <a href="#" class="nav-link">
                                                Tidak Ada
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-6 connectedSortable">
                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->s
<?= $this->endSection(); ?>