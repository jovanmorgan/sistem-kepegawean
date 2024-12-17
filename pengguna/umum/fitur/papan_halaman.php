 <?php
    // Mendapatkan nama file halaman saat ini
    $current_page = basename($_SERVER['PHP_SELF']);

    // Menentukan judul dan breadcrumb berdasarkan halaman
    $page_title = '';
    $breadcrumb = '';

    switch ($current_page) {
        case 'home.php':
            $page_title = 'Home';
            $breadcrumb = '<li><a href="home">Home</a></li>';
            break;
        case 'profile.php':
            $page_title = 'Profile';
            $breadcrumb = '<li><a href="home">Home</a></li><li class="current">Profile</li>';
            break;
        case 'pegawai.php':
            $page_title = 'Pegawai';
            $breadcrumb = '<li><a href="home">Home</a></li><li><a href="#">Informasi</a></li><li class="current">Pegawai</li>';
            break;
        case 'lokasi.php':
            $page_title = 'Lokasi';
            $breadcrumb = '<li><a href="home">Home</a></li><li><a href="#">Informasi</a></li><li class="current">Lokasi</li>';
            break;
        case 'galery.php':
            $page_title = 'Galeri';
            $breadcrumb = '<li><a href="home">Home</a></li><li><a href="#">Informasi</a></li><li class="current">Galeri</li>';
            break;
        case 'login.php':
            $page_title = 'Login';
            $breadcrumb = '<li><a href="home">Home</a></li><li class="current">Login</li>';
            break;
        case 'kontak.php':
            $page_title = 'Kontak';
            $breadcrumb = '<li><a href="home">Home</a></li><li class="current">Kontak</li>';
            break;
        default:
            $page_title = 'SMA 4 ATAMBUA';
            $breadcrumb = '<li class="current">Home</li>';
            break;
    }
    ?>
 <!-- Page Title -->
 <div class="page-title dark-background" data-aos="fade"
     style="background-image: url('../../assets/img/sma4/foto\ guru.jpg');">
     <div class="container">
         <h1><?php echo $page_title; ?></h1>
         <nav class="breadcrumbs">
             <ol>
                 <?php echo $breadcrumb; ?>
             </ol>
         </nav>
     </div>
 </div><!-- End Page Title -->