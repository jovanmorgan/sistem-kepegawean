<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="home" class="logo d-flex align-items-center">
            <h1 class="sitename">SMA 4 ATAMBUA</h1>
        </a>

        <nav id="navmenu" class="navmenu d-flex align-items-center">
            <ul>
                <li>
                    <a href="home"
                        class="<?php echo (basename($_SERVER['PHP_SELF']) == 'home.php') ? 'active' : ''; ?>">Home</a>
                </li>
                <li>
                    <a href="profile"
                        class="<?php echo (basename($_SERVER['PHP_SELF']) == 'profile.php') ? 'active' : ''; ?>">Profile</a>
                </li>
                <li class="dropdown">
                    <a href="#"
                        class="<?php echo (basename($_SERVER['PHP_SELF']) == 'informasi.php') ? 'active' : ''; ?>">
                        <span>Informasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>
                    <ul>
                        <li><a href="pegawai"
                                class="<?php echo (basename($_SERVER['PHP_SELF']) == 'pegawai.php') ? 'active' : ''; ?>">Pegawai
                                SMA</a></li>
                        <li><a href="lokasi"
                                class="<?php echo (basename($_SERVER['PHP_SELF']) == 'lokasi.php') ? 'active' : ''; ?>">Lokasi
                                SMA</a></li>
                        <li><a href="galery"
                                class="<?php echo (basename($_SERVER['PHP_SELF']) == 'galery.php') ? 'active' : ''; ?>">Galeri</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="kontak"
                        class="<?php echo (basename($_SERVER['PHP_SELF']) == 'kontak.php') ? 'active' : ''; ?>">Kontak</a>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

            <!-- Tombol Login -->
            <a href="../../berlangganan/login" class="btn btn-login bg-primary text-white text-center">Login</a>
        </nav>

    </div>
</header>

<style>
    .btn-login {
        /* Warna dasar tombol */
        color: white;
        height: 10px;
        /* Warna teks */
        padding: 5px 5px;
        /* Ukuran padding */
        border-radius: 30px;
        /* Membuat sudut membulat */
        font-weight: bold;
        /* Menebalkan teks */
        text-transform: uppercase;
        /* Membuat teks kapital semua */
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        /* Memberikan bayangan */
        transition: all 0.3s ease;
        /* Animasi transisi */
        border: 2px solid transparent;
        /* Border default transparan */
        text-decoration: none;
        /* Menghilangkan garis bawah */
        margin-left: 15px;
        /* Memberikan jarak dari menu */
        color: white;
    }

    .btn-login:hover {
        /* Warna tombol saat hover */
        color: white;
        /* Border saat hover */
        box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.2);
        /* Bayangan lebih besar saat hover */
        transform: translateY(-3px);
        /* Mengangkat tombol saat hover */
    }

    @media screen and (max-width: 768px) {
        .btn-login {
            /* Warna dasar tombol */
            height: 40px;
            width: 100px;
            margin-top: 20px;

        }

    }
</style>