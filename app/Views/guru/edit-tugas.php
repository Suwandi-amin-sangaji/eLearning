<?= $this->extend('layout/guru/template'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-dark">Edit Tugas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/tugas">Tugas</a></li>
                        <li class=" breadcrumb-item active">Edit Tugas</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-white">
                            <i class="fas fa-book"></i> Edit Tugas
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url(); ?>/tugas/edittugas_" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nama_tugas">Nama Tugas</label>
                                    <input type="text" class="form-control" name="nama_tugas" value="<?= $tugas->nama_tugas; ?>" id="nama_tugas" autocomplete="off">
                                    <input type="hidden" name="id_tugas" value="<?= $tugas->id_tugas; ?>">
                                    <input type="hidden" name="file_lawas" value="<?= $tugas->file; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="mapel">Mata Pelajaran</label>
                                    <select class="form-control" name="mapel" id="mapel">
                                        <option value="">Pilih Mata Pelajaran</option>
                                        <?php foreach ($gurumapel as $gm) : ?>
                                            <option value="<?= $gm->mapel_id; ?>" <?= ($gm->mapel_id == $tugas->mapel) ? 'selected' : ''; ?>><?= $gm->mapel; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select class="form-control" name="kelas" id="kelas">
                                        <option value="">Pilih Kelas</option>
                                        <?php foreach ($gurukelas as $gk) : ?>
                                            <option value="<?= $gk->kelas_id; ?>" <?= ($gk->kelas_id == $tugas->kelas) ? 'selected' : ''; ?>><?= $gk->kelas; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Pesan / Catatan</label>
                                    <textarea class="summernote" name="pesan"><?= $tugas->pesan; ?></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">File</label><br>
                                            <label for="">Current file : <?= ($tugas->file != null) ? $tugas->file : 'Tidak Ada File'; ?></label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input nama_file" id="nama_file" name="nama_file">
                                                <label class="custom-file-label nama_file-label" for="nama_file">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Batas Waktu</label>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <input type="date" value="<?= substr($tugas->due_date, 0, 10); ?>" class="form-control" name="tgl" id="tgl">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" value="<?= substr($tugas->due_date, 11, 5); ?>" class="form-control" name="jam" id="jam">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary float-right mt-3">Update Data</button>
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