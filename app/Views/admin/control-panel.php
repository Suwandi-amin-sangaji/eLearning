<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Control Panel</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/admin">Dashboard</a></li>
                        <li class="breadcrumb-item active">Control Panel</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Alert -->
    <?php if (session()->getFlashdata('berhasil')) : ?>
        <script>
            Swal.fire(
                'Success',
                'Data Berhasil <?= session()->getFlashdata("berhasil"); ?>',
                'success'
            )
        </script>
    <?php endif; ?>
    <?php if (session()->getFlashdata('gagal')) : ?>
        <script>
            Swal.fire(
                'Oops..',
                'Somethings Wrong',
                'error'
            )
        </script>
    <?php endif; ?>
    <!-- End Alert -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Data SIswa -->
            <div class="row">
                <div class="col-lg">
                    <!-- DIRECT DATA -->
                    <div class="card direct-chat direct-chat-primary">
                        <div class="card-header bg-gradient-info">
                            <h3 class="card-title">
                                <i class="fas fa-graduation-cap pr-2"></i>Data Siswa
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages" style="height: 340px">
                                <a href="<?= base_url(); ?>/admin/addstudent" class="btn btn-outline-info btn-sm mb-2"><i class="fas fa-plus"></i> Tambah Data</a>
                                <a href="#" class="btn btn-outline-warning btn-sm mb-2 ml-2" data-toggle="modal" data-target="#PrintSiswaModal"><i class="fas fa-print"></i> Export PDF</a>
                                <table id="tbl-siswa" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle">No</th>
                                            <th style="vertical-align: middle">Informasi Siswa</th>
                                            <th style="vertical-align: middle; text-align: center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($siswa as $s) : ?>
                                            <tr>
                                                <th style="vertical-align: middle; text-align: center"><?= $no++; ?></th>
                                                <td>
                                                    <div style="float: left; padding-right: 10px;"><img src="<?= base_url(); ?>/user-file/img/<?= $s->gambar; ?>" width="55px" height="55px" style="box-shadow: 0 0 10px rgba(0,0,0,.5);border-radius: 50%;"></div>
                                                    <?= $s->nama_siswa; ?>
                                                    <span style="color: #696969">
                                                        (<?= $s->no_regis; ?>)<br>
                                                        Kelas <?= $s->nama_kelas; ?>,
                                                        <?= $s->jenis_kelamin; ?>
                                                    </span>
                                                </td>
                                                <td style="vertical-align: middle; text-align: center">
                                                    <a href="<?= base_url(); ?>/admin/updatesiswa/<?= encrypt_url($s->no_regis); ?>" class="btn btn-outline-primary btn-sm mr-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?= base_url(); ?>/admin/deletestudent/<?= encrypt_url($s->no_regis); ?>" class="btn btn-outline-danger btn-sm btn-hapus ml-1">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.direct-Data-pane -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">

                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!--/.direct-Data -->
                </div>
            </div>
            <!-- End Data Siswa -->
            <!-- Data Guru -->
            <div class="row pt-1">
                <div class="col-lg">
                    <!-- DIRECT Data -->
                    <div class="card direct-chat direct-chat-primary">
                        <div class="card-header bg-gradient-danger">
                            <h3 class="card-title"><i class="fas fa-chalkboard-teacher pr-2"></i>Data Guru</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages" style="height: 340px">
                                <a href="<?= base_url(); ?>/admin/addteacher/" class="btn btn-outline-info btn-sm mb-2"><i class="fas fa-plus"></i> Tambah Data</a>
                                <a href="<?= base_url(); ?>/MpdfAdmin/printguru/" class="btn btn-outline-warning btn-sm ml-2 mb-2" target="_blank"><i class="fas fa-print"></i> Export PDF</a>
                                <table id="tbl-guru" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle">No</th>
                                            <th style="vertical-align: middle">Informasi Guru</th>
                                            <th style="vertical-align: middle">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($guru as $g) : ?>
                                            <tr>
                                                <th><?= $no++; ?></th>
                                                <td>
                                                    <div style="float: left; padding-right: 10px;"><img src="<?= base_url(); ?>/user-file/img/<?= $g->gambar; ?>" width="55px" style="box-shadow: 0 0 10px rgba(0,0,0,.5);border-radius: 50%;"></div>
                                                    <?= $g->nama; ?>
                                                    <span style="color: #696969">
                                                        (<?= $g->no_regis; ?>)
                                                        <?php if ($g->is_active == 0) : ?>
                                                            <u class="text-danger">Tidak Aktif</u>
                                                        <?php endif; ?>
                                                        <br>
                                                        <?= $g->email; ?>
                                                    </span>
                                                </td>
                                                <td style="vertical-align: middle; text-align: center;">
                                                    <a href="<?= base_url(); ?>/admin/updateteacher/<?= encrypt_url($g->id); ?>" class="btn btn-outline-primary btn-sm mr-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?= base_url(); ?>/admin/deleteteacher/<?= encrypt_url($g->id); ?>" class="btn btn-outline-danger btn-sm ml-1 btn-hapus">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.direct-Data-pane -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">

                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!--/.direct-Data -->
                </div>
            </div>
            <!-- End Data Guru -->
            <!-- Data Mapel -->
            <div class="row pt-1">
                <div class="col-lg">
                    <!-- DIRECT Data -->
                    <div class="card direct-chat direct-chat-primary">
                        <div class="card-header bg-gradient-success">
                            <h3 class="card-title"><i class="fas fa-book pr-2"></i>Data Mata Pelajaran</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages" style="height: 340px">
                                <a href="<?= base_url(); ?>/admin/addmapel" class="btn btn-outline-info btn-sm mb-2"><i class="fas fa-plus"></i> Tambah Data</a>
                                <table id="tbl-mapel" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle">No</th>
                                            <th style="vertical-align: middle">Nama Mata Pelajaran</th>
                                            <th style="vertical-align: middle; text-align: center;">Aksi</th>
                                            <th style="vertical-align: middle; text-align: center;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($mapel as $mpl) : ?>
                                            <tr>
                                                <th><?= $no++; ?></th>
                                                <td>
                                                    <?= $mpl->nama_mapel; ?>
                                                </td>
                                                <td style="vertical-align: middle; text-align: center;">
                                                    <a href="<?= base_url(); ?>/admin/editmapel/<?= encrypt_url($mpl->id); ?>" class="btn btn-outline-primary btn-sm mr-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?= base_url(); ?>/admin/hapusmapel/<?= encrypt_url($mpl->id); ?>" class="btn btn-outline-danger btn-sm ml-1 btn-hapus">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                                <td style="vertical-align: middle; text-align: center;">
                                                    <?php if ($mpl->is_active == 1) : ?>
                                                        <a href="#" id="btn-active-mapel" class="btn-active-mapel badge badge-info ">active</a>
                                                    <?php else : ?>
                                                        <a href="#" id="btn-active-mapel" class="btn-active-mapel badge badge-danger ">deactive</a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.direct-Data-pane -->
                        </div>
                        <!-- /.card-body -->
                        <div class=" card-footer">

                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!--/.direct-Data -->
                </div>
            </div>
            <!-- End Data Mapel -->
            <!-- Data Kelas -->
            <div class="row pt-1">
                <div class="col-lg">
                    <!-- DIRECT Data -->
                    <div class="card direct-chat direct-chat-primary">
                        <div class="card-header bg-gradient-warning">
                            <h3 class="card-title text-white"><i class="fas fa-store-alt text-white"></i> Data Kelas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus text-white"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages" style="height: 340px">
                                <a href="<?= base_url(); ?>/admin/addclass" class="btn btn-outline-info btn-sm mb-2"><i class="fas fa-plus"></i> Tambah Data</a>
                                <table id="tbl-kelas" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle">No</th>
                                            <th style="vertical-align: middle">Nama Kelas</th>
                                            <th style="vertical-align: middle">Kode Kelas</th>
                                            <th style="vertical-align: middle; text-align: center;">Aksi</th>
                                            <th style="vertical-align: middle; text-align: center;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($kelas as $k) : ?>
                                            <tr>
                                                <th><?= $no++; ?></th>
                                                <td>
                                                    <?= $k->nama_kelas; ?>
                                                </td>
                                                <td><?= $k->class_code; ?></td>
                                                <td style="vertical-align: middle; text-align: center;">
                                                    <a href="<?= base_url(); ?>/admin/editkelas/<?= encrypt_url($k->id); ?>" class="btn btn-outline-primary btn-sm mr-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?= base_url(); ?>/admin/hapuskelas/<?= encrypt_url($k->id); ?>" class="btn btn-outline-danger btn-sm ml-1 btn-hapus">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                                <td style="vertical-align: middle; text-align: center;">
                                                    <?php if ($k->is_active == 1) : ?>
                                                        <a href="#" id="btn-active-mapel" class="btn-active-mapel badge badge-info ">active</a>
                                                    <?php else : ?>
                                                        <a href="#" id="btn-active-mapel" class="btn-active-mapel badge badge-danger ">deactive</a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.direct-Data-pane -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">

                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!--/.direct-Data -->
                </div>
            </div>
            <!-- End Data Kelas -->
            <!-- Mapel Guru / Kelas guru -->
            <div class="row pt-1">
                <div class="col-lg">
                    <!-- DIRECT Data -->
                    <div class="card direct-chat direct-chat-primary collapsed-card">
                        <div class="card-header bg-gradient-info">
                            <h3 class="card-title">
                                <i class="fas fa-chalkboard-teacher pr-2"></i><i class="fas fa-arrows-alt-h"></i> <i class="fas fa-book pr-2"></i>
                                Relasi Guru - Mata Pelajaran
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages" style="height: 340px">
                                <table id="tbl-mapel" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle">No</th>
                                            <th style="vertical-align: middle">Nama Guru</th>
                                            <th style="vertical-align: middle">Lihat Mapel</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($guru as $g) : ?>
                                            <tr>
                                                <th><?= $no++; ?></th>
                                                <td>
                                                    <?= $g->nama; ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url(); ?>/admin/gurumapel/<?= encrypt_url($g->no_regis); ?>" class="btn btn-outline-warning btn-sm mr-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.direct-Data-pane -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">

                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!--/.direct-Data -->
                </div>
                <div class="col-lg">
                    <!-- DIRECT Data -->
                    <div class="card direct-chat direct-chat-primary collapsed-card">
                        <div class="card-header bg-gradient-info">
                            <h3 class="card-title">
                                <i class="fas fa-chalkboard-teacher pr-2"></i><i class="fas fa-arrows-alt-h"></i> <i class="fas fa-store-alt"></i>
                                Relasi Guru - Kelas
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages" style="height: 340px">
                                <table id="tbl-mapel" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle">No</th>
                                            <th style="vertical-align: middle">Nama Guru</th>
                                            <th style="vertical-align: middle">Lihat Kelas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($guru as $g) : ?>
                                            <tr>
                                                <th><?= $no++; ?></th>
                                                <td>
                                                    <?= $g->nama; ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url(); ?>/admin/gurukelas/<?= encrypt_url($g->no_regis); ?>" class="btn btn-outline-warning btn-sm mr-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.direct-Data-pane -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">

                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!--/.direct-Data -->
                </div>
            </div>
            <!-- End Mapel Guru / Kelas Guru -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Print Siswa -->
<div class="modal fade" id="PrintSiswaModal" tabindex="-1" role="dialog" aria-labelledby="PrintSiswaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PrintSiswaModalLabel">Cetak Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="<?= base_url(); ?>/MpdfAdmin/printallsiswa" class="btn btn-outline-warning">Semua Kelas</a>
                    </li>
                    <?php
                    $no = 1;
                    foreach ($kelas as $k) : ?>
                        <li class="list-group-item">
                            <a href="<?= base_url(); ?>/MpdfAdmin/PrintByKelas/<?= $k->id; ?>" class="btn btn-outline-warning m-1 d-inline-block" target="_blank"><?= $k->nama_kelas; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Print Siswa -->
<?= $this->endSection(); ?>