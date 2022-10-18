<?= $this->extend('layout/siswa/template'); ?>

<?= $this->section('content'); ?>
<?php if (session()->getFlashdata('berhasil')) : ?>
    <script>
        Swal.fire(
            'Success',
            'Data Berhasil <?= session()->getFlashdata("berhasil"); ?>',
            'success'
        )
    </script>
<?php endif; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-dark">Materi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/siswa">Siswa</a></li>
                        <li class="breadcrumb-item active">Materi</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-book"></i> Data Materi</i>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Materi</th>
                                        <th>Mapel</th>
                                        <th>Kelas</th>
                                        <th>Waktu Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($materi as $m) : ?>
                                        <tr class="text-center">
                                            <th scope="row"><?= $no++; ?></th>
                                            <td><?= $m->nama_materi; ?></td>
                                            <td><?= $m->nama_mapel; ?></td>
                                            <td><?= $m->nama_kelas; ?></td>
                                            <td><?= date('Y-m-d H:i:s', $m->date_created); ?></td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <a href="<?= base_url(); ?>/siswa/lihatmateri/<?= encrypt_url($m->id_materi); ?>" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>