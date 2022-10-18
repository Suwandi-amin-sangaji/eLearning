<?= $this->extend('layout/auth/template'); ?>
<?= $this->section('content'); ?>
<?= session()->get('pesan'); ?>
<main>
    <section>
        <div class="container">
            <div class="row align-items-center justify-content-center min-vh-100">
                <div class="col-md-6 col-xl-5 p-40px-tb">
                    <div class="p-40px white-bg box-shadow border-radius-10">
                        <div class="p-20px-b text-center">
                            <h3 class="font-w-600 dark-color m-10px-b">Reset password</h3>
                            <p class="login-box-msg">Change Password for<br><?= $email; ?></p>
                        </div>
                        <form action="<?= base_url(); ?>/auth/forgotpasswordsiswa_" method="post">
                            <input type="hidden" value="<?= $email; ?>" name="email">
                            <input type="hidden" value="<?= $token; ?>" name="token">
                            <div class="form-group">
                                <input type="password" class="form-control <?= ($validation->hasError('password1')) ? 'is-invalid' : ''; ?>" name="password1" placeholder="Enter New Password" required>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password1'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control <?= ($validation->hasError('password2')) ? 'is-invalid' : ''; ?>" name="password2" placeholder="Repeat Password" required>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password2'); ?>
                                </div>
                            </div>
                            <div class="p-10px-t">
                                <button type="submit" class="m-btn m-btn-theme m-btn-radius w-100">Change password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?= $this->endSection(); ?>