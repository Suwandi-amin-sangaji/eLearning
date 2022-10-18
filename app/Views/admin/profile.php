<?= $this->extend('layout/admin/template'); ?>
<?= $this->section('content'); ?>
<style>
    input[type=text] {
        border: none;
        outline: none;
        width: 100%;
    }
</style>
<div class="content-wrapper">
    <div class="container">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-dark">Profile & Setting</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Profile & Setting</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header bg-light">
                        My Profile
                    </div>
                    <div class="card-body m-0 p-0">
                        <div class="table-responsive m-0">
                            <table class="table table-valign-middle table-sm m-0">
                                <tr>
                                    <td bgcolor="#f2f2f2" width="150">E-mail</td>
                                    <td><?= $admin->email; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td bgcolor="#f2f2f2">Password</td>
                                    <td>***************</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td bgcolor="#f2f2f2">Role User</td>
                                    <td>Admin</td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer" style="border-top: 2px solid rgba(0,0,0,0.1);">
                    </div>
                </div>
            </div>
            <?php if (session()->getFlashdata('berhasil')) : ?>
                <script>
                    Swal.fire(
                        'Success',
                        'Data Berhasil <?= session()->getFlashdata("berhasil"); ?>',
                        'success'
                    )
                </script>
            <?php endif; ?>
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header bg-light">
                        Mail Setting
                    </div>
                    <form action="<?= base_url(); ?>/admin/settingemail" method="POST">
                        <input type="hidden" name="id" value="<?= $mail->id; ?>">
                        <div class="card-body m-0 p-0">
                            <div class="table-responsive m-0">
                                <table class="table table-valign-middle table-sm m-0">
                                    <tr>
                                        <td bgcolor="#f2f2f2" width="150">SMTP HOST</td>
                                        <td><input type="text" name="smtp_host" value="<?= $mail->smtp_host; ?>" required></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#f2f2f2">SMTP USER</td>
                                        <td><input type="text" name="smtp_user" value="<?= $mail->smtp_user; ?>" required></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#f2f2f2">SMTP PASS</td>
                                        <td><input type="text" name="smtp_password" value="<?= $mail->smtp_password; ?>" required></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#f2f2f2">SMTP PORT</td>
                                        <td><input type="text" name="smtp_port" value="<?= $mail->smtp_port; ?>" required></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#f2f2f2">SMTP CRYPTO</td>
                                        <td><input type="text" name="smtp_crypto" value="<?= $mail->smtp_crypto; ?>" required></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer" style="border-top: 2px solid rgba(0,0,0,0.1);">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>