<?= $this->extend('layout/guru/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-dark">Detail</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/tugas">Tugas</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <?php if (session()->getFlashdata('berhasil')) : ?>
        <script>
            Swal.fire(
                'Success',
                'Data Berhasil <?= session()->getFlashdata("berhasil"); ?>',
                'success'
            )
        </script>
    <?php endif; ?>
    <section class="content">
        <div class="container-fluid">
            <?php if ($tugas->is_essay == 0) : ?>
                <div class="row pb-3">
                    <div class="col-lg-12">
                        <!-- DIRECT DATA -->
                        <div class="card direct-chat direct-chat-primary">
                            <div class="card-header bg-white">
                                <h3 class="card-title">
                                    <i class="fas fa-tasks"></i> <?= $tugas->nama_tugas . ' (' . $tugas->nama_mapel . ')'; ?></i>
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
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
                                                    : <?= $tugas->nama; ?> </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Untuk
                                                </td>
                                                <td>
                                                    : <?= $tugas->nama_kelas; ?> </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Batas Waktu
                                                </td>
                                                <td>
                                                    : <?= $tugas->due_date; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <p>
                                        <?= $tugas->pesan; ?>
                                    </p>
                                    <?php if ($tugas->file) : ?>
                                        <div class="row">
                                            <div class="col-lg-3 shadow p-3 ml-2 bg-white rounded">
                                                <div class="tugas-body p-1">
                                                    <h6 class="tugas-title">Here is Your File</h6>
                                                    <p class="tugas-text"><?= $tugas->file; ?></p>
                                                    <a href="<?= base_url(); ?>/download/bahantugas/<?= $tugas->id_tugas; ?>" class="btn btn-primary"><i class="fas fa-download"></i> Download</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <!-- /.direct-Data-panel -->
                            </div>
                            <!-- /.card-body -->
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
                                    <i class="fas fa-tasks"></i> <?= $tugas->nama_tugas . ' (' . $tugas->nama_tugas . ')'; ?></i>
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
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
                                                    : <?= $tugas->nama; ?> </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Untuk
                                                </td>
                                                <td>
                                                    : <?= $tugas->nama_kelas; ?> </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Batas Waktu
                                                </td>
                                                <td>
                                                    : <?= $tugas->due_date; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <p>
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
                                        <?= str_replace($search, $replace, $tugas->pesan); ?>
                                    </p>
                                    <?php if ($tugas->file) : ?>
                                        <div class="row">
                                            <div class="col-lg-3 shadow p-3 ml-2 bg-white rounded">
                                                <div class="tugas-body p-1">
                                                    <h6 class="tugas-title">Here is Your File</h6>
                                                    <p class="tugas-text"><?= $tugas->file; ?></p>
                                                    <a href="<?= base_url(); ?>/download/bahantugas/<?= $tugas->id_tugas; ?>" class="btn btn-primary"><i class="fas fa-download"></i> Download</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <!-- /.direct-Data-panel -->
                            </div>
                        </div>
                        <!--/.direct-Data -->
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card direct-chat direct-chat-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tugas Siswa</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-2">
                            <!-- Conversations are loaded here -->
                            <div class="row mt-2">
                                <div class="col-lg-6">
                                    <ul class="list-group">
                                        <li class="list-group-item active">Siswa yang Tidak Mengerjakan</li>
                                        <?php foreach ($tugas_siswa as $ts) : ?>
                                            <?php if ($ts->dikerjakan == 0) : ?>
                                                <li class="list-group-item">
                                                    <a href="<?= base_url(); ?>/tugas/tugas_siswa/<?= encrypt_url($ts->no_regis_siswa) . '/' . encrypt_url($tugas->id_tugas); ?>">
                                                        <?= $ts->nama_siswa; ?>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <ul class="list-group nilai-siswa-telat" id="nilai-siswa-telat">
                                        <li class="list-group-item bg-success">Siswa yang Sudah Mengerjakan</li>
                                        <?php foreach ($tugas_siswa as $ts) : ?>
                                            <?php if ($ts->dikerjakan == 1) : ?>
                                                <li class="list-group-item">
                                                    <a href="<?= base_url(); ?>/tugas/tugas_siswa/<?= encrypt_url($ts->no_regis_siswa) . '/' . encrypt_url($tugas->id_tugas); ?>">
                                                        <?= $ts->nama_siswa; ?>
                                                        <span class="float-right badge badge-success"><?= $ts->nilai; ?> / 100</span>
                                                        <?php if ($ts->telat) : ?>
                                                            <span class="float-right badge badge-danger mr-2">Terlambat</span>
                                                        <?php endif; ?>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <!--/.direct-chat-messages-->
                        </div>
                    </div>
                </div>
            </div>

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
                            <div id="isi-komen-tugas" class="direct-chat-messages">

                            </div>
                            <!--/.direct-chat-messages-->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <form method="post">
                                <input type="hidden" id="email-tugas" name="email" value="<?= $tugas->email; ?>">
                                <div class="input-group">
                                    <textarea name="pesan" id="pesan-tugas" placeholder="Type Message ..." class="form-control" autocomplete="off"></textarea>
                                    <span class="input-group-append">
                                        <button type="button" id="btn-chat-tgs" class="btn btn-primary">Send</button>
                                    </span>
                                </div>
                            </form>
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
        var id_tugas = "<?= $tugas->id_tugas ?>";
        $.ajax({
            type: 'POST',
            url: "<?= base_url('komentar/getAllkomenTugas') ?>",
            data: {
                id_tugas: id_tugas,
                email_user: emailSession
            },
            success: function(data) {
                $('#isi-komen-tugas').html(data)
            }
        });
    }, 1000);

    $('#btn-chat-tgs').click(function() {
        var id_tugas = <?= $tugas->id_tugas; ?>;
        var email = $('input[name=email]').val();
        var pesan = $('#pesan-tugas').val();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('komentar/tugas') ?>",
            data: {
                id_tugas: id_tugas,
                email: email,
                pesan: pesan
            },
            async: true,
            success: function(params) {
                $('#pesan-tugas').val('')
            }
        });
    });
</script>
<?= $this->endSection(); ?>