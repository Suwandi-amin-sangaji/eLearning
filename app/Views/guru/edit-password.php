<?= $this->extend('layout/guru/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-dark">Change Password</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Change Password</li>
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
                <div class="col-lg-12">
                    <form action="<?= base_url(); ?>/guru/changepassword_" method="post">
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" class="form-control <?= (session()->getFlashdata('password')) ? 'is-invalid' : ''; ?>" id="current_password" name="current_password" required>
                            <div class="invalid-feedback">
                                Password sekarang salah
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new_password1">New Password</label>
                            <input type="password" class="form-control <?= ($validation->hasError('new_password1')) ? 'is-invalid' : ''; ?>" id="new_password1" name="new_password1" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('new_password1'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new_password2">Repeat Password</label>
                            <input type="password" class="form-control <?= ($validation->hasError('new_password2')) ? 'is-invalid' : ''; ?>" id="new_password2" name="new_password2" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('new_password2'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-key"></i> Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>