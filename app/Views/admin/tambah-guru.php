<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="container">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-dark">Tambah Data Guru</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/admin/controlpanel">Control Panel</a></li>
                            <li class="breadcrumb-item active">Tambah Data Guru</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card direct-chat direct-chat-primary">
                    <div class="card-header" style="background-color: #f7f7f7;">
                        <h3 class="card-title">Form Tambah Data Guru</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="<?= base_url(); ?>/admin/saveguru" method="post">
                        <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages">
                                <div class="form-group">
                                    <label for="nama_guru">Nama Guru</label>
                                    <input type="text" class="form-control" name="nama_guru" id="nama_guru" autocomplete="off" value="<?= old('nama_guru'); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="no_regis">No registrasi</label>
                                    <?php if ($row_akhir != null) : ?>
                                        <input type="text" class="form-control" name="no_regis" id="no_regis" value="<?= $row_akhir->no_regis + 1; ?>" readonly>
                                    <?php else : ?>
                                        <input type="text" class="form-control" name="no_regis" id="no_regis" value="19079100" readonly>
                                    <?php endif; ?>
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
                                        <input type="password" class="form-control" name="password" id="password" value="19079100" readonly>
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