<?= $this->extend('layout/siswa/template'); ?>

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
                    <h1 class="text-dark">Edit Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Edit Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <form action="<?= base_url(); ?>/siswa/editprofile_" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="gambar_lama" value="<?= $siswa->gambar; ?>">
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="email" name="email" value="<?= $siswa->email; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" id="nama" class="form-control" value="<?= $siswa->nama_siswa; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">Picture</div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="<?= base_url(); ?>/user-file/img/<?= $siswa->gambar; ?>" class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="custom-file field-img-profile">
                                            <input type="file" class="custom-file-input file <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar" name="gambar" onchange="previewImg()">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('gambar'); ?>
                                            </div>
                                            <label class="custom-file-label file-label" for="gambar">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    function previewImg() {
        const gambar = document.querySelector('#gambar');
        const gambarLable = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-thumbnail');

        gambarLable.textContent = gambar.files[0].name;

        const filegambar = new FileReader();
        filegambar.readAsDataURL(gambar.files[0]);

        filegambar.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
<?= $this->endSection(); ?>