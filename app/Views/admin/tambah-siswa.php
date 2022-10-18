<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="container">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-dark">Tambah Data Siswa</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/admin/controlpanel">Control Panel</a></li>
                            <li class="breadcrumb-item active">Tambah Data Siswa</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card direct-chat direct-chat-primary">
                    <div class="card-header" style="background-color: #f7f7f7;">
                        <h3 class="card-title">Form Tambah Data Siswa</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="<?= base_url(); ?>/admin/savesiswa" method="post">
                        <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages">
                                <div class="form-group">
                                    <label for="nama_siswa">Nama Siswa</label>
                                    <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" autocomplete="off" value="<?= old('nama_siswa'); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="no_regis">No registrasi</label>
                                    <?php if ($row_akhir != null) : ?>
                                        <input type="text" class="form-control" name="no_regis" id="no_regis" value="<?= $row_akhir->no_regis + 1; ?>" readonly>
                                    <?php else : ?>
                                        <input type="text" class="form-control" name="no_regis" id="no_regis" value="18078100" readonly>
                                    <?php endif; ?>
                                </div>

                                <label>Jenis Kelamin</label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="jenis_kelamin" value="Laki - Laki" class="custom-control-input" checked>
                                    <label class="custom-control-label font-weight-normal" for="customRadioInline1">Laki - Laki</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="jenis_kelamin" value="Perempuan" class="custom-control-input">
                                    <label class="custom-control-label font-weight-normal" for="customRadioInline2">Perempuan</label>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <label for="id_kelas">Kelas</label>
                                    <select class="form-control" name="id_kelas" id="id_kelas" required>
                                        <option value="">Pilih Kelas</option>
                                        <?php foreach ($kelas as $k) : ?>
                                            <option value="<?= $k->id; ?>"><?= $k->nama_kelas; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name=" email" id="email" autocomplete="off" value="<?= old('email'); ?>" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('email'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <?php if ($row_akhir != null) : ?>
                                        <input type="password" class="form-control" name="password" id="password" value="<?= $row_akhir->no_regis + 1; ?>" readonly>
                                    <?php else : ?>
                                        <input type="password" class="form-control" name="password" id="password" value="18078100" readonly>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Tambah Data</button>
                        </div>
                    </form>
                    <!-- /.card-footer-->
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>