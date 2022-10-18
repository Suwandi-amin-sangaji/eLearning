<?= $this->extend('layout/guru/template'); ?>

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
                    <h1 class="text-dark">Tugas Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/tugas/lihattugas/<?= encrypt_url($tugas_siswa->tugas_id); ?>">Tugas</a></li>
                        <li class="breadcrumb-item active">Tugas Siswa</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <?php if ($tugas_siswa->file_siswa == null) : ?>
                <div class="row pb-3">
                    <div class="col-lg-12">
                        <!-- DIRECT DATA -->
                        <div class="card direct-chat direct-chat-primary">
                            <div class="card-header bg-white">
                                <?php //if ($tugas->dilihat == 1) : 
                                ?>
                                <h3 class="card-title">
                                    <i class="far fa-comment-dots"></i> Jawaban <?= $tugas_siswa->nama_siswa; ?></i>
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages" style="height: 340px">
                                    <table style="font-weight: bold">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Nama
                                                </td>
                                                <td>
                                                    : <?= $tugas_siswa->nama_siswa; ?> </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Kelas
                                                </td>
                                                <td>
                                                    : <?= $tugas_siswa->nama_kelas; ?> </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Mapel
                                                </td>
                                                <td>
                                                    : <?= $tugas_siswa->nama_mapel; ?> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <ul class="list-group mt-3">
                                                <li class="list-group-item active">Jawaban</li>
                                                <li class="list-group-item">
                                                    <?= $tugas_siswa->essay; ?>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6">
                                            <ul class="list-group mt-3">
                                                <li class="list-group-item active">Form Penilain</li>
                                                <li class="list-group-item">
                                                    <form action="<?= base_url(); ?>/tugas/nilai" method="post">
                                                        <div class="input-group mb-3">
                                                            <input type="hidden" class="form-control" name="id_tugas" value="<?= $tugas_siswa->tugas_id; ?>">
                                                            <input type="hidden" class="form-control" name="no_regis" value="<?= $tugas_siswa->no_regis_siswa; ?>">
                                                            <input type="number" class="form-control" name="nilai" placeholder="Nilai" autocomplete="off">
                                                            <div class="input-group-append">
                                                                <button type="submit" class="btn btn-outline-primary">Submit</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.direct-Data-panel -->
                            </div>
                        </div>
                        <!--/.direct-Data -->
                    </div>
                </div>
            <?php else : ?>
                <div class="row pb-3">
                    <div class="col-lg-12">
                        <!-- DIRECT DATA -->
                        <div class="card direct-chat direct-chat-primary">
                            <div class="card-header bg-white">
                                <h3 class="card-title">
                                    <i class="far fa-comment-dots"></i> Jawaban <?= $tugas_siswa->nama_siswa; ?></i>
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages" style="height: 340px">
                                    <table style="font-weight: bold">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Nama
                                                </td>
                                                <td>
                                                    : <?= $tugas_siswa->nama_siswa; ?> </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Kelas
                                                </td>
                                                <td>
                                                    : <?= $tugas_siswa->nama_kelas; ?> </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Mapel
                                                </td>
                                                <td>
                                                    : <?= $tugas_siswa->nama_mapel; ?> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <ul class="list-group mt-3">
                                                <li class="list-group-item active">Jawaban</li>
                                                <li class="list-group-item">
                                                    <div class="shadow p-3 bg-white rounded">
                                                        <div class="materi-body p-1">
                                                            <h6 class="materi-title">Here is Your File</h6>
                                                            <p class="materi-text"><?= $tugas_siswa->file; ?></p>
                                                            <a href="<?= base_url(); ?>/download/filesiswa/<?= $tugas_siswa->tugas_id; ?>" class="btn btn-primary"><i class="fas fa-download"></i> Download</a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6">
                                            <ul class="list-group mt-3">
                                                <li class="list-group-item active">Form Penilain</li>
                                                <li class="list-group-item">
                                                    <form action="<?= base_url(); ?>/tugas/nilai" method="post">
                                                        <div class="input-group mb-3">
                                                            <input type="hidden" class="form-control" name="id_tugas" value="<?= $tugas_siswa->tugas_id; ?>">
                                                            <input type="hidden" class="form-control" name="no_regis" value="<?= $tugas_siswa->no_regis_siswa; ?>">
                                                            <input type="number" class="form-control" name="nilai" placeholder="Nilai" autocomplete="off">
                                                            <div class="input-group-append">
                                                                <button type="submit" class="btn btn-outline-primary">Submit</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.direct-Data-panel -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!--/.direct-Data -->
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>