<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="container">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-dark">Tambah Data Mapel</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/admin/controlpanel">Control Panel</a></li>
                            <li class="breadcrumb-item active">Tambah Data Mapel</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card direct-chat direct-chat-primary">
                    <div class="card-header" style="background-color: #f7f7f7;">
                        <h3 class="card-title">Form Tambah Data Mapel</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="<?= base_url(); ?>/admin/savemapel" method="post">
                        <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages">
                                <div class="form-group">
                                    <label for="nama_mapel">Nama Mata Pelajaran</label>
                                    <input type="text" class="form-control" name="nama_mapel" id="nama_mapel" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Tambah Data</button>
                        </div>
                    </form>
                    <!-- /.card-footer-->
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>