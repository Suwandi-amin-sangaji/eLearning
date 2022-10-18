<?= $this->extend('layout/guru/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-dark">Buat Tugas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/tugas">Tugas</a></li>
                        <li class="breadcrumb-item active">Buat Tugas</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <?php if (session()->getFlashdata('error')) : ?>
        <script>
            Swal.fire(
                'Error',
                'Anda tidak dapat memposting tugas pada kelas yg tidak ada siswa',
                'error'
            )
        </script>
    <?php endif; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-white">
                            <i class="fas fa-tasks"></i> Buat Tugas
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url(); ?>/tugas/addtugas_" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nama_tugas">Nama Tugas</label>
                                    <input type="text" class="form-control" name="nama_tugas" id="nama_tugas" value="<?= old('nama_tugas'); ?>" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="mapel">Mata Pelajaran</label>
                                    <select class="form-control" name="mapel" id="mapel">
                                        <option value="">Pilih Mata Pelajaran</option>
                                        <?php foreach ($gurumapel as $m) : ?>
                                            <option value="<?= $m->mapel_id; ?>" <?= (old('mapel') == $m->mapel_id) ? 'selected' : ''; ?>><?= $m->mapel; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select class="form-control" name="kelas" id="kelas">
                                        <option value="">Pilih Kelas</option>
                                        <?php foreach ($gurukelas as $k) : ?>
                                            <option value="<?= $k->kelas_id; ?>" <?= (old('kelas') == $k->kelas_id) ? 'selected' : ''; ?>><?= $k->kelas; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Tugas Essay</label><br>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="is_essay" id="inlineRadio1" value="1" <?= (old('is_essay') == 1) ? 'checked' : ''; ?>>
                                        <label class="form-check-label ml-1" for="inlineRadio1"> Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="is_essay" id="inlineRadio2" value="0" <?= (old('is_essay') == 0) ? 'checked' : ''; ?>>
                                        <label class="form-check-label ml-1" for="inlineRadio2"> Upload File</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Pesan</label>
                                    <textarea class="summernote" name="pesan"><?= old('pesan'); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">File</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input nama_file" id="nama_file" name="nama_file">
                                        <label class="custom-file-label nama_file-label" for="nama_file">Choose file</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Batas Waktu</label>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <input type="date" class="form-control" name="tgl" id="tgl" value="<?= old('tgl'); ?>" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" class="form-control" name="jam" id="jam" value="<?= old('jam'); ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right mt-3">Tambah Data</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $('.nama_file').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.nama_file-label').addClass("selected").html(fileName);
    });
</script>
<?= $this->endSection(); ?>