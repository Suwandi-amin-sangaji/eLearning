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
                    <h1 class="text-dark">Tugas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/siswa">Siswa</a></li>
                        <li class="breadcrumb-item active">Tugas</li>
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
                                <i class="fas fa-tasks"></i> Data Tugas</i>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap table-striped table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Tugas</th>
                                        <th>Mapel</th>
                                        <th>Kelas</th>
                                        <th>Waktu Dibuat</th>
                                        <th>Due Date</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($tugas as $t) : ?>
                                        <tr class="text-center">
                                            <th scope="row"><?= $no++; ?></th>
                                            <td><?= $t->nama_tugas; ?></td>
                                            <td><?= $t->nama_mapel; ?></td>
                                            <td><?= $t->nama_kelas; ?></td>
                                            <td><?= date('Y-M-d H:i:s', $t->date_created); ?></td>
                                            <td> <?= $t->due_date; ?></td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <a href="<?= base_url(); ?>/siswa/lihattugas/<?= encrypt_url($t->id_tugas); ?>" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i></a>
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