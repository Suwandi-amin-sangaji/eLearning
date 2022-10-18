<?= $this->extend('layout/guru/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-dark">Buat Materi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/materi">Materi</a></li>
                        <li class="breadcrumb-item active">Buat Materi</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <?php if (session()->getFlashdata('error')) : ?>
        <script>
            Swal.fire(
                'Error',
                'Anda tidak dapat memposting materi pada kelas yg tidak ada siswa',
                'error'
            )
        </script>
    <?php endif; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-exclamation-triangle"></i> Petunjuk
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-1 pr-4 text-justify">
                            <ol>
                                <li>
                                    Anda hanya bisa mengakses kelas dan matapelajaran yang sudah di tetapkan oleh Administrator. Jika terdapat perubahan atau bug (eror) segera hubungi orang yang ditugaskan sebagai Administrator
                                </li>
                                <li>
                                    Anda hanya bisa memposting materi pada kelas yg sudah terdapat siswa
                                </li>
                                <li>
                                    Jika Gambar yang anda pilih tidak tampil di halaman, berarti gambar yang ingin anda masukkan tidak cocok dengan kriteria yang seharusnya. cobalah untuk memasukkan gambar yang memiliki ukuran yang kecil
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-white">
                            <i class="fas fa-book"></i> Buat Materi
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url(); ?>/materi/addmateri_" method="post">
                                <div class="form-group">
                                    <label for="nama_materi">Nama Materi</label>
                                    <input type="text" class="form-control" name="nama_materi" id="nama_materi" value="<?= old('nama_materi'); ?>" autocomplete="off" required>
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
                                    <label for="">Materi</label>
                                    <textarea class="summernote" name="bikin_manual"><?= old('bikin_manual'); ?></textarea>
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
<?= $this->endSection(); ?>