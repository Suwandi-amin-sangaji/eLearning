<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="container">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-dark">Relasi Guru Kelas</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/admin/controlpanel">Control Panel</a></li>
                            <li class="breadcrumb-item active">Relasi Guru Kelas</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
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
        <div class="row">
            <div class="col-md-12">
                <h5>Kelas Pelajaran Untuk : <?= $guru->nama; ?></h5>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle">No</th>
                            <th style="vertical-align: middle">kelas</th>
                            <th style="vertical-align: middle">Akses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($kelas as $k) : ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td><?= $k->nama_kelas; ?></td>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" <?= check_kelas(encrypt_url($guru->no_regis), $k->id); ?> data-noregis="<?= encrypt_url($guru->no_regis); ?>" data-kelas="<?= $k->id; ?>">
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $('.form-check-input').on('click', function() {
        const noRegis = $(this).data('noregis');
        const kelasId = $(this).data('kelas');

        $.ajax({
            url: "<?= base_url('admin/relasiGuruKelas'); ?>",
            type: 'post',
            data: {
                noRegis: noRegis,
                kelasId: kelasId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/GuruKelas') ?>/" + noRegis
            }
        });
    });
</script>
<?= $this->endSection(); ?>