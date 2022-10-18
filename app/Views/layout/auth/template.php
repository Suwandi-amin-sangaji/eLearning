<!doctype html>
<html lang="en">

<head>
    <!-- metas -->
    <meta charset="utf-8">
    <meta name="author" content="Rumah baca" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Mombo - Creative Multi-Purpose Template" />
    <meta name="description" content="Mombo - Creative Multi-Purpose Template" />
    <!-- title -->
    <title>Rumah Baca | Keik Tsinagi</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url(); ?>/assets/icons-logos.png">
    <!-- plugin CSS -->
    <link href="<?= base_url(); ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <link href="<?= base_url(); ?>/assets/auth/et-line/style.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/auth/themify-icons/themify-icons.css" rel="stylesheet">
    <!-- Sweetalert -->
    <script src="<?= base_url(); ?>/assets/sweetalert/sweetalert2.all.min.js"></script>
    <!-- theme css -->
    <link href="<?= base_url(); ?>/assets/auth/master.css" rel="stylesheet">

    <!-- My css -->
    <link href="<?= base_url(); ?>/assets/my-assets/mystyle.css" rel="stylesheet">
</head>
<!-- Body Start -->

<body data-spy="scroll" data-target="#navbar-collapse-toggle" data-offset="98">

    <?= $this->renderSection('content'); ?>

    <!-- jquery -->
    <script src="<?= base_url(); ?>/assets/plugins/jquery/jquery.min.js"></script>
    <!-- end jquery -->
    <!--bootstrap-->
    <script src="<?= base_url(); ?>/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!--end bootstrap-->
    <!-- End -->
    <!-- Particle js -->
    <script src="<?= base_url(); ?>/assets/auth/particles/particles.min.js"></script>
    <script src="<?= base_url(); ?>/assets/auth/particles/particles-app.js"></script>
    <!-- end -->

    <!-- custom js -->
    <script src="<?= base_url(); ?>/assets/auth/custom.js"></script>

    <!-- Myscript -->
    <script src="<?= base_url(); ?>/assets/my-assets/myscript.js"></script>

    <script>
        $(document).ready(function() {
            const form = $('#myForm'),
                is_student = $('.is_student'),
                classCode = $('#class_code');

            classCode.hide();

            is_student.on('click', function() {
                if ($(this).is(':checked')) {
                    classCode.show();
                    classCode.find('input').attr('required', true);
                } else {
                    classCode.hide();
                    classCode.find('input').attr('required', false);
                }
            });
        });
    </script>

    <!-- end -->
</body>
<!-- end body -->

</html>