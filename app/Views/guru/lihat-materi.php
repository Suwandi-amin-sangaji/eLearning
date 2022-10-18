<?= $this->extend('layout/guru/template'); ?>

<?= $this->section('content'); ?><div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-dark">Detail</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/materi">Materi</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <?php if ($materi->bikin_manual == null) : ?>
                <div class="row pb-3">
                    <div class="col-lg-12">
                        <!-- DIRECT DATA -->
                        <div class="card direct-chat direct-chat-primary">
                            <div class="card-header bg-white">
                                <h3 class="card-title">
                                    <i class="fas fa-book"></i> <?= $materi->nama_materi . ' (' . $mapel->nama_mapel . ')'; ?></i> - <small><?= date('Y-m-d H:i:s', $materi->date_created); ?></small>
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages" style="height: 340px">
                                    <table style="font-weight: bold">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Penyaji
                                                </td>
                                                <td>
                                                    : <?= $guru->nama; ?> </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Untuk
                                                </td>
                                                <td>
                                                    : <?= $kelas->nama_kelas; ?> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <p>
                                        <?= $materi->catatan; ?>
                                    </p>
                                    <div class="row">
                                        <div class="col-lg-3 shadow p-3 ml-2 bg-white rounded">
                                            <div class="materi-body p-1">
                                                <h6 class="materi-title">Here is Your File</h6>
                                                <p class="materi-text"><?= $materi->unggah_materi; ?></p>
                                                <a href="<?= base_url(); ?>/Download/DownloadMateri/<?= $materi->id_materi; ?>" class="btn btn-primary" target="_blank"><i class="fas fa-download"></i> Download</a>
                                            </div>
                                        </div>
                                        <?php if ($materi->unggah_materi2 != null) : ?>
                                            <div class="col-lg-3 shadow p-3 ml-2 bg-white rounded">
                                                <div class="materi-body p-1">
                                                    <h6 class="materi-title">Here is Your File</h6>
                                                    <p class="materi-text"><?= $materi->unggah_materi2; ?></p>
                                                    <a href="<?= base_url(); ?>/Download/DownloadMateri/<?= $materi->id_materi; ?>" class="btn btn-primary" target="_blank"><i class="fas fa-download"></i> Download</a>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- /.direct-Data-panel -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">

                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!--/.direct-Data -->
                    </div>
                </div>
            <?php else : ?>
                <div class="row pb-3">
                    <div class="col-lg-12">
                        <!-- DIRECT DATA -->
                        <div class="card direct-chat direct-chat-primary">
                            <div class="card-header bg-white">
                                <h3 class="card-title">
                                    <i class="fas fa-book"></i> <?= $materi->nama_materi . ' (' . $mapel->nama_mapel . ')'; ?></i> - <small><?= date('Y-m-d H:i:s', $materi->date_created); ?></small>
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages" style="height: 340px">
                                    <table style="font-weight: bold">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Penyaji
                                                </td>
                                                <td>
                                                    : <?= $guru->nama; ?> </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Untuk
                                                </td>
                                                <td>
                                                    : <?= $kelas->nama_kelas; ?> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <?php
                                    $search = array(
                                        '&gt;',
                                        '&lt;',
                                        'width="640"'
                                    );

                                    $replace = array(
                                        '>',
                                        '<',
                                        'width="100%"'
                                    );
                                    ?>
                                    <?= str_replace($search, $replace, $materi->bikin_manual); ?>
                                </div>
                                <!-- /.direct-Data-panel -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">

                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!--/.direct-Data -->
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card direct-chat direct-chat-primary">
                        <div class="card-header">
                            <h3 class="card-title">Direct Chat</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div id="isi-chat-materi" class="direct-chat-messages">

                            </div>
                            <!--/.direct-chat-messages-->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" id="id_materi" name="id_materi" value="<?= $materi->id_materi; ?>">
                            <input type="hidden" name="email" value="<?= $guru->email; ?>">
                            <div class="input-group">
                                <textarea name="pesan" id="pesan-materi" placeholder="Type Message ..." class="form-control" autocomplete="off"></textarea>
                                <span class="input-group-append">
                                    <button type="button" id="btn-chat-m" class="btn btn-primary">Send</button>
                                </span>
                            </div>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    setInterval(() => {
        var emailSession = "<?= session()->get('email') ?>";
        var id_materi = "<?= $materi->id_materi ?>";
        $.ajax({
            type: 'POST',
            url: "<?= base_url('komentar/getAllkomenMateri') ?>",
            data: {
                id_materi: id_materi,
                email_user: emailSession
            },
            success: function(data) {
                $('#isi-chat-materi').html(data)
            }
        });
    }, 1000);

    $('#btn-chat-m').click(function() {
        var id_materi = $('input[name=id_materi]').val();
        var email = $('input[name=email]').val();
        var pesan = $('#pesan-materi').val();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('komentar/materi') ?>",
            data: {
                id_materi: id_materi,
                email: email,
                pesan: pesan
            },
            async: true,
            success: function(params) {
                $('#pesan-materi').val('')
            }
        });
    });
</script>
<?= $this->endSection(); ?>