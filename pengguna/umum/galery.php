<!DOCTYPE html>
<html lang="en">

<?php include 'fitur/head.php'; ?>

<body class="index-page">

    <?php include 'fitur/header.php'; ?>

    <main class="main">

        <?php include 'fitur/papan_halaman.php'; ?>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <!-- Search Form -->
                            <form method="GET" action="">
                                <div class="input-group mt-3">
                                    <input type="text" class="form-control" placeholder="Cari galeri..." name="search"
                                        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Portfolio Section -->
        <section id="portfolio" class="portfolio section">

            <div class="container">

                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                        <?php
                        include '../../keamanan/koneksi.php';

                        // Pagination variables
                        $limit = 6; // Jumlah item per halaman
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $offset = ($page - 1) * $limit;

                        // Searching
                        $search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';

                        // Query to count total records
                        $total_result = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM galeri WHERE nama LIKE '%$search%'");
                        $total_row = mysqli_fetch_assoc($total_result);
                        $total_items = $total_row['total'];
                        $total_pages = ceil($total_items / $limit);

                        // Query to fetch limited records with search
                        $result = mysqli_query($koneksi, "SELECT * FROM galeri WHERE nama LIKE '%$search%' LIMIT $limit OFFSET $offset");

                        if (mysqli_num_rows($result) > 0) {
                            // Looping data galeri
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id_galeri = $row['id_galeri'];
                                $nama = $row['nama'];
                                $waktu = $row['waktu'];
                                $deskripsi = $row['deskripsi'];
                                $gambar_galeri = $row['gambar_galeri'];
                        ?>
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                            <img src="../../assets/img/galeri/<?php echo $gambar_galeri; ?>" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4> <?php echo $nama; ?></h4>
                                <p><?php echo $deskripsi; ?></p>
                                <a href="../../assets/img/galeri/<?php echo $gambar_galeri; ?>"
                                    title="<?php echo $nama; ?>" data-gallery="portfolio-gallery-app"
                                    class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <?php
                            }
                        } else {
                            echo "<div class='col-12'><p class='text-center'>Tidak ada data galeri 😖.</p></div>";
                        }
                        ?>

                    </div><!-- End Portfolio Container -->

                </div>

            </div>

        </section><!-- /Portfolio Section -->

    </main>

    <?php include 'fitur/footer.php'; ?>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <?php include 'fitur/script.php'; ?>

</body>

</html>