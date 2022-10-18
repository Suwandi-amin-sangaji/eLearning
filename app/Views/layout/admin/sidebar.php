<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-dark-primary">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="<?= base_url(); ?>/assets/icon-logi.jpeg" alt="Smart Students Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">KEIK TSINAGI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3">
            <div class="info text-center" style="width: 100%">
                <a href="<?= base_url(); ?>/admin" class="d-block">ADMIN</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview <?= $menu['dropdown']; ?>">
                    <a href="#" class="nav-link <?= $menu['dashboard']; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/admin/ControlPanel" class="nav-link <?= $menu['control_panel']; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Control Panel</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">USER</li>
                <li class="nav-item">
                    <a href="<?= base_url(); ?>/admin/profile" class="nav-link <?= $menu['profile']; ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profile & setting
                        </p>
                    </a>
                </li>
                <div class="mt-1" style="border-top: 1px solid rgba(255,255,255,0.2);"></div>
                <li class="nav-item mt-2">
                    <a href="<?= base_url(); ?>/auth/logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>