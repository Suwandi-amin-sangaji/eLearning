    <?= $this->extend('layout/auth/template'); ?>
    <?= $this->section('content'); ?>
    <!-- Preload -->
    <div id="loading">
        <div class="load-circle"><span class="one"></span></div>
    </div>
    <!-- End Preload -->
    <?= session()->getFlashdata('pesan');
    ?>
    <!-- Header -->
    <header class="header-nav header-white">
        <div class="fixed-header-bar">
            <div class="container container-large">
                <div class="navbar navbar-default navbar-expand-lg main-navbar">
                    <div class="navbar-brand ml-auto">
                        <a href="<?= base_url(); ?>" title="Mombo" class="logo">
                            <img src="<?= base_url(); ?>/assets/icons-logos.png" class="light-logo" title="" width="150px">
                            <img src="<?= base_url(); ?>/assets/icons-logos.png" class="dark-logo" title="" width="150px">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->
    <!-- Main -->
    <main>
        <!-- Home Banner -->
        <!-- theme-bg -->
        <section id="home" class="effect-section gray-bg">
            <div class="effect effect-skew"></div>
            <div class="particles-box" id="particles-box"></div>
            <div class="container">
                <div class="row full-screen align-items-center p-100px-tb">
                    <div class="col-12 col-lg-5 col-xl-4 p-50px-tb">
                        <h1 class="black-color h1 m-18px-b">Rumah Baca <b class="red-color ">Keik Tsinagi</b> </h1>
                        <p class="font-2 black-color-light m-20px-b">Rumah Baca Keik Tsinagi (Dalam bahasa Moi berarti Rumah Kasih) merupakan tempat Belajar online Pertama Di Papua Dan Papua Barat.</p>
                        <span class="font-small white-color"> <a href="#sigin" class="m-btn m-btn-radius btn-danger">Ayo belajar</a></span>
                    </div>
                    <div class="col-lg-7 col-xl-8">
                        <img style="margin-left:25%;" class="max-width-auto" src="<?= base_url(); ?>/assets/auth/img/bg2.svg" title="" alt="" width="70%">
                    </div>
                </div>
            </div>
        </section>
        <!-- End Home Banner -->
        <!-- Section -->
        <section id="about" class="section gray-bg">
            <div class="container">
                <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
                    <div class="col-lg-8">
                        <h3 class="h1 m-20px-b p-20px-b theme-after after-50px">UI & UX ?</h3>
                        <p class="m-0px font-2">Smart Students is a HTML5 Web Application based on Sass and Bootstrap 4 with modern and
                            creative design</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-3 m-15px-tb">
                        <div class="box-shadow hover-top hover-rotate white-bg border-radius-5 p-20px-lr p-40px-tb text-center">
                            <div class="ef-2 icon-80 hr-rotate-after theme-bg dots-icon border-radius-50 theme2nd-color d-inline-block m-20px-b">
                                <i class="fab fa-html5 white-color"></i>
                                <span class="dots"><i class="dot dot1"></i><i class="dot dot2"></i><i class="dot dot3"></i></span>
                            </div>
                            <h6>HTML 5</h6>
                            <p class="m-0px">Smart Students is a HTML5 Web Application.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 m-15px-tb">
                        <div class="box-shadow hover-top hover-rotate white-bg border-radius-5 p-20px-lr p-40px-tb text-center">
                            <div class="ef-2 icon-80 hr-rotate-after theme-bg dots-icon border-radius-50 theme2nd-color d-inline-block m-20px-b">
                                <i class="fab fa-css3 white-color"></i>
                                <span class="dots"><i class="dot dot1"></i><i class="dot dot2"></i><i class="dot dot3"></i></span>
                            </div>
                            <h6>CSS 3</h6>
                            <p class="m-0px">Suported in other browser, exept internet explorer</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 m-15px-tb">
                        <div class="box-shadow hover-top white-bg border-radius-5 theme-hover-bg p-20px-lr p-40px-tb text-center">
                            <div class="icon-80 gray-bg dots-icon border-radius-50 theme-color d-inline-block m-20px-b">
                                <i class="fab fa-bootstrap"></i>
                                <span class="dots"><i class="dot dot1"></i><i class="dot dot2"></i><i class="dot dot3"></i></span>
                            </div>
                            <h6>Bootstrap 4</h6>
                            <p class="m-0px">the most popular css framework are in here</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 m-15px-tb">
                        <div class="box-shadow hover-top white-bg border-radius-5 theme-hover-bg p-20px-lr p-40px-tb text-center">
                            <div class="icon-80 gray-bg dots-icon border-radius-50 theme-color d-inline-block m-20px-b">
                                <i class="fab fa-js"></i>
                                <span class="dots"><i class="dot dot1"></i><i class="dot dot2"></i><i class="dot dot3"></i></span>
                            </div>
                            <h6>Javascript</h6>
                            <p class="m-0px">javascript will make this app more dynamic</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Section -->
        <!-- Section -->
        <section id="login" class="section">
            <div class="container">
                <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
                    <div class="col-lg-7">
                        <h3 class="h1 m-20px-b p-20px-b theme-after after-50px">Here we go</h3>
                        <p class="m-0px font-2">Ayo Bergabung Dan Ikut Belajar Bersama Kami</p>
                    </div>
                </div>
                <div class="tab-style-3">
                    <ul class="nav nav-fill nav-tabs box-shadow-lg">
                        <li class="nav-item">
                            <a href="#tab3_sec1" data-toggle="tab" class="active">
                                <div class="icon"><i class="icon-tools"></i></div>
                                <span>Login</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab3_sec2" data-toggle="tab" class="">
                                <div class="icon"><i class="icon-megaphone"></i></div>
                                <span>Registration</span>
                            </a>
                        </li>
                    </ul>
                    </ul>
                    <div class="tab-content" id="sigin">
                        <!-- start tab content -->
                        <div id="tab3_sec1" class="tab-pane fade in active show">
                            <div class="row align-items-center p-25px-t md-p-15px-t">
                                <div class="col-lg-6 text-center">
                                    <img src="<?= base_url(); ?>/assets/auth/img/login1.svg" title="" alt="">
                                </div>
                                <div class="col-lg-6">
                                    <div class="p-70px-l lg-p-0px-l lg-m-30px-t">
                                        <h2 class="h1 m-25px-b"><u class="theme-color">Login</u> Form</h2>
                                        <?= session()->getFlashdata('pesan'); ?>
                                        <form action="<?= base_url(); ?>/auth/login" method="post">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" id="email" class="form-control" value="<?= old('email'); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password" class="form-control" required>
                                            </div>
                                            <div class="btn-bar p-15px-t">
                                                <button type="submit" class="m-btn m-btn-radius btn-danger">Sign In</button>
                                            </div>
                                        </form>
                                        <a href="auth/forgotpassword" class="text-primary float-right" style="margin-top: -42px; outline: none; border: none; background: transparent;">Forgot Password</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->
                        <!-- start tab content -->
                        <div id="tab3_sec2" class="tab-pane fade in">
                            <div class="row align-items-center p-25px-t md-p-15px-t">
                                <div class="col-lg-6">
                                    <div class="p-70px-r lg-p-0px-r lg-m-30px-t">
                                        <h2 class="h1 m-25px-b">Sign Up <u class="theme-color">Now!</u></h2>
                                        <form action="<?= base_url('auth/registration'); ?>" method="post">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name_regis" id="name" class="form-control" value="<?= old('name_regis'); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" id="lk" type="radio" name="jk" value="Laki - Laki" checked>
                                                    <label class="form-check-label" for="lk">Laki - Laki</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="pr" type="radio" name="jk" value="Perempuan">
                                                    <label class="form-check-label" for="pr">Perempuan</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" name="email_regis" id="email" class="form-control <?= ($validation->hasError('email_regis')) ? 'is-invalid' : ''; ?>" value="<?= old('email_regis'); ?>" required>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('email_regis'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password_regis" id="password" class="form-control <?= ($validation->hasError('password_regis')) ? 'is-invalid' : ''; ?>" required>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('password_regis'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password2">Repeat Password</label>
                                                <input type="password" name="password_regis2" id="password2" class="form-control <?= ($validation->hasError('password_regis2')) ? 'is-invalid' : ''; ?>" required>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('password_regis2'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input is_student" type="checkbox" name="is_student" value="1" id="is_student">
                                                    <label class="form-check-label" for="is_student">I am a Student</label>
                                                </div>
                                                <div id="class_code" class="mt-1">
                                                    <label for="kode_kelas">Class Code</label>
                                                    <input type="text" name="kode_kelas" id="kode_kelas" class="form-control" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="btn-bar p-15px-t">
                                                <button type="submit" class="m-btn m-btn-radius btn-danger">Sign Up</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6 order-lg-2 order-first text-center">
                                    <img src="<?= base_url(); ?>/assets/auth/img/login2.svg" title="" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- End Main -->
    <!-- Footer-->
    <footer class="dark-bg footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-12 m-15px-tb mr-auto">
                        <div class="m-20px-b">
                            <img src="<?= base_url(); ?>/assets/icons-logos.png" title="" alt="">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 m-15px-tb">
                        <h6 class="white-color">
                            And Thanks To
                        </h6>
                        <ul class="list-unstyled links-white footer-link-1">
                            <li>
                                <a href="https://www.codeigniter.com/" target="_blank">Codeigniter</a>
                            </li>
                            <li>
                                <a href="https://www.jquery.com/" target="_blank">Jquery</a>
                            </li>
                            <li>
                                <a href="https://www.getbootstrap.com/" target="_blank">Bootstrap</a>
                            </li>
                            <li>
                                <a href="https://www.adminlte.io/" target="_blank">Admin LTE</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-sm-6 m-15px-tb">
                        <h6 class="white-color">
                            Information
                        </h6>
                        <address>
                            <p class="white-color-light m-5px-b"><b> Kota Sorong</b><br /> Jl. Saton Km.12,5 Kec. Klaurung 98417, Klasaman, Sorong Timur, Sorong City, West Papua 98416</p>
                            <p class="m-5px-b"><a class="theme2nd-color border-bottom-1 border-color-theme2nd" href="mailto:suwandiaminsangaji@gmail.com">developersoq@gmail.com</a></p>
                            <p class="m-5px-b"><a class="theme2nd-color border-bottom-1 border-color-theme2nd" href="tel:082256330920">082256330920</a></p>
                        </address>
                        <div class="social-icon si-30 theme2nd nav">
                            <a href="#" target="_blank"><i class="fab fa-github"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-codepen"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom footer-border-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p class="m-0px font-small white-color-light">© 2021 copyright Rumah Baca Keik Tsinagi </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
    <?= $this->endSection(); ?>