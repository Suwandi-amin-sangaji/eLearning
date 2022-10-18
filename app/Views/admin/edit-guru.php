<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="container">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-dark">Edit Data Guru</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/admin/controlpanel">Control Panel</a></li>
                            <li class="breadcrumb-item active">Edit Data Guru</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card direct-chat direct-chat-primary">
                    <div class="card-header" style="background-color: #f7f7f7;">
                        <h3 class="card-title">Form Edit Data Guru</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="<?= base_url(); ?>/admin/editguru" method="post">
                        <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages">
                                <div class="form-group">
                                    <label for="nama_guru">Nama Guru</label>
                                    <input type="text" class="form-control" name="nama_guru" id="nama_guru" value="<?= $guru->nama; ?>" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="no_regis">No registrasi</label>
                                    <input type="text" class="form-control" name="no_regis" id="no_regis" value="<?= $guru->no_regis; ?>" readonly>
                                </div>
                                <label>Is Active</label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="is_active" value="1" class="custom-control-input" <?= ($guru->is_active == 1) ? 'checked' : ''; ?>>
                                    <label class="custom-control-label font-weight-normal" for="customRadioInline1">Yes</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="is_active" value="0" class="custom-control-input" <?= ($guru->is_active == 0) ? 'checked' : ''; ?>>
                                    <label class="custom-control-label font-weight-normal" for="customRadioInline2">No</label>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" id="email" value="<?= $guru->email; ?>" autocomplete="off">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('email'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Edit Data</button>
                        </div>
                    </form>
                    <!-- /.card-footer-->
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>