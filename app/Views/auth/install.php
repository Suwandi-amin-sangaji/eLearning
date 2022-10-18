<?= $this->extend('layout/auth/template'); ?>
<?= $this->section('content'); ?>
<?= session()->get('pesan'); ?>
<div class="container">
    <div class="row justify-content-center align-items-center mt-5">
        <div class="col-sm-8 col-lg-6 col-xl-5 order-lg-2">
            <div class="card box-shadow-lg">
                <div class="card-body">
                    <h3 class="font-w-600 dark-color text-center">Installation</h3>
                    <p>create administrator account</p>
                    <form action="<?= base_url(); ?>/installasi/save" method="POST">
                        <div class="form-group">
                            <label class="form-control-label small font-w-600 dark-color m-0px">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= old('email'); ?>" placeholder="name@example.com" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label small font-w-600 dark-color m-0px">Password</label>
                            <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="********" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label small font-w-600 dark-color m-0px">Confirm Password</label>
                            <input type="password" class="form-control <?= ($validation->hasError('passconf')) ? 'is-invalid' : ''; ?>" id="passconf" name="passconf" placeholder="********" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('passconf'); ?>
                            </div>
                        </div>
                        <div class="p-5px-t">
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="m-btn m-btn-radius m-btn-theme">Get Started</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    Swal.fire(
        'Installation',
        'Enter school or Administrator email<br>the email will use as Administrator in Smart Students<br><br>Please enter a valid email',
        'warning'
    )
</script>
<!-- End Footer -->
<?= $this->endSection(); ?>