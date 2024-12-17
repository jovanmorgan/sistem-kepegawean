<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Title Dinamis Berdasarkan Halaman -->
    <title>
        <?php
        // Tentukan judul halaman berdasarkan halaman yang sedang dibuka
        $current_page = basename($_SERVER['PHP_SELF']);
        switch ($current_page) {
            case 'home.php':
                echo 'Home - SMA 4 ATAMBUA';
                break;
            case 'profile.php':
                echo 'Profile - SMA 4 ATAMBUA';
                break;
            case 'pegawai.php':
                echo 'Pegawai - SMA 4 ATAMBUA';
                break;
            case 'lokasi.php':
                echo 'Lokasi - SMA 4 ATAMBUA';
                break;
            case 'galery.php':
                echo 'Galeri - SMA 4 ATAMBUA';
                break;
            case 'login.php':
                echo 'Login - SMA 4 ATAMBUA';
                break;
            default:
                echo 'SMA 4 ATAMBUA';
                break;
        }
        ?>
    </title>

    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="../../assets/img/sma4/logo2.jpg" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css?v=<?= time(); ?>" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css?v=<?= time(); ?>" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css?v=<?= time(); ?>" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css?v=<?= time(); ?>" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css?v=<?= time(); ?>" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
</head>