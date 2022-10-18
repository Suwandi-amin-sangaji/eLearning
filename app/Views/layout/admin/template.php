<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $judul; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url(); ?>/assets/icons-logos.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- summernote -->
    <!-- Sweetalert -->
    <script src="<?= base_url(); ?>/assets/sweetalert/sweetalert2.all.min.js"></script>

    <link rel="stylesheet" href="<?= base_url(); ?>/assets/my-assets/mystyle.css">

    <!-- Data Tables -->
    <link rel=" stylesheet" href="<?= base_url(); ?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- jQuery -->
    <script src="<?= base_url(); ?>/assets/plugins/jquery/jquery-3.4.0.min.js"></script>
    <style>
        .btn-codeview {
            display: none;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <?= $this->include('layout/admin/sidebar'); ?>

        <?= $this->renderSection('content'); ?>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b id="load">Version</b> 2.0 <small>Page rendered in <strong>{elapsed_time}</strong> seconds.</small>
            </div>
            <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="">Rumah Baca Keik Tsinagi</a>.</strong> All
            rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url(); ?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <!-- overlayScrollbars -->
    <script src="<?= base_url(); ?>/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>/assets/dist/js/adminlte.js"></script>

    <!-- DataTables -->
    <script src="<?= base_url(); ?>/assets/plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?= base_url(); ?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

    <!-- myscript -->
    <!-- <script src="<?= base_url(); ?>/assets/my-assets/myscript.js"></script> -->
    <script>
        $(document).ready(function() {
            $('.btn-hapus').click(function(e) {
                const href = $(this).attr('href');
                e.preventDefault();

                Swal.fire({
                    title: 'Apakah anda Yakin?',
                    text: "Data tidak akan bisa kembali!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        document.location.href = href
                    }
                })
            });

            const tablesiswa = $('#tbl-siswa').DataTable({
                "lengthMenu": [
                    [-1, 5, 10, 25],
                    ["All", 5, 10, 25]
                ]
            });

            const tableGuru = $('#tbl-guru').DataTable({
                "lengthMenu": [
                    [-1, 5, 10, 25],
                    ["All", 5, 10, 25]
                ]
            });

            const tableMapel = $('#tbl-mapel').DataTable({
                "lengthMenu": [
                    [-1, 5, 10, 25],
                    ["All", 5, 10, 25]
                ]
            });

            const tableKelas = $('#tbl-kelas').DataTable({
                "lengthMenu": [
                    [-1, 5, 10, 25],
                    ["All", 5, 10, 25]
                ]
            });
        });
    </script>
</body>

</html>