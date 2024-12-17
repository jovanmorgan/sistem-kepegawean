<?php
// Dapatkan nama halaman dari URL saat ini tanpa ekstensi .php
$current_page = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), ".php");

// Fungsi untuk mendapatkan ikon yang sesuai dengan halaman
function getIconForPage($page)
{
    switch ($page) {
        case 'dashboard':
            return 'fas fa-home';
        case 'pegawai':
            return 'fas fa-user-tie';
        case 'lokasi':
            return 'fas fa-map-marker-alt';
        case 'jabatan':
            return 'fas fa-briefcase';
        case 'gaji':
            return 'fas fa-money-bill-wave';
        case 'mutasi':
            return 'fas fa-exchange-alt';
        case 'cuti':
            return 'fas fa-plane';
        case 'pensiun':
            return 'fas fa-user-clock';
        case 'galeri':
            return 'fas fa-images';
        case 'profile':
            return 'fas fa-user';
        case 'log_out':
            return 'fas fa-sign-out-alt';
        default:
            return 'fas fa-file'; // Ikon default jika halaman tidak dikenal
    }
}
?>

<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="blue">
            <a href="dasboard" class="logo">
                <img src="../../assets/img/sma4/LOGO SMAN4.png" alt="navbar brand" class="navbar-brand" height="33px" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner" data-background-color="dark">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item <?php echo ($current_page == 'dashboard') ? 'active' : ''; ?>">
                    <a href="dashboard">
                        <i class="<?php echo getIconForPage('dashboard'); ?>"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Sistem</h4>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#charts">
                        <i class="far fa-chart-bar"></i>
                        <p>Data Kepegawaian</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?= in_array($current_page, ['lokasi', 'jabatan', 'gaji', 'mutasi', 'cuti', 'pensiun']) ? 'show' : ''; ?>"
                        id="charts">
                        <ul class="nav nav-collapse">
                            <li class="<?php echo ($current_page == 'lokasi') ? 'active' : ''; ?>">
                                <a href="lokasi">
                                    <span class="sub-item">Lokasi Kerja</span>
                                </a>
                            </li>
                            <li class="<?php echo ($current_page == 'jabatan') ? 'active' : ''; ?>">
                                <a href="jabatan">
                                    <span class="sub-item">Jabatan</span>
                                </a>
                            </li>
                            <li class="<?php echo ($current_page == 'gaji') ? 'active' : ''; ?>">
                                <a href="gaji">
                                    <span class="sub-item">Gaji</span>
                                </a>
                            </li>
                            <li class="<?php echo ($current_page == 'mutasi') ? 'active' : ''; ?>">
                                <a href="mutasi">
                                    <span class="sub-item">Mutasi</span>
                                </a>
                            </li>
                            <li class="<?php echo ($current_page == 'cuti') ? 'active' : ''; ?>">
                                <a href="cuti">
                                    <span class="sub-item">Cuti</span>
                                </a>
                            </li>
                            <li class="<?php echo ($current_page == 'pensiun') ? 'active' : ''; ?>">
                                <a href="pensiun">
                                    <span class="sub-item">Pensiun</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Profile</h4>
                </li>
                <li class="nav-item <?php echo ($current_page == 'profile') ? 'active' : ''; ?>">
                    <a href="profile">
                        <i class="<?php echo getIconForPage('profile'); ?>"></i>
                        <p>Profile Saya</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="log_out">
                        <i class="<?php echo getIconForPage('log_out'); ?>"></i>
                        <p>Log Out</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->