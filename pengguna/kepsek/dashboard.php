<?php include 'fitur/penggunah.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'fitur/head.php'; ?>

<body>
    <div class="wrapper">
        <?php include 'fitur/sidebar.php'; ?>
        <div class="main-panel">
            <?php include 'fitur/navbar.php'; ?>
            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Dashboard</h3>
                            <h6 class="op-7 mb-2">Halaman Dasboard</h6>
                        </div>
                    </div>

                    <?php
                    include '../../keamanan/koneksi.php';

                    // Query untuk mendapatkan data pegawai terlaris berdasarkan jumlah cuti
                    $query_pegawai = "
        SELECT pegawai.nama_pegawai, COUNT(cuti.id_cuti) as total_cuti
        FROM cuti
        INNER JOIN pegawai ON cuti.id_pegawai = pegawai.id_pegawai
        GROUP BY pegawai.nama_pegawai
        ORDER BY total_cuti DESC
        LIMIT 7
    ";

                    $result_pegawai = mysqli_query($koneksi, $query_pegawai);

                    $pegawai_nama = [];
                    $total_cuti = [];

                    while ($row_pegawai = mysqli_fetch_assoc($result_pegawai)) {
                        $pegawai_nama[] = $row_pegawai['nama_pegawai'];
                        $total_cuti[] = $row_pegawai['total_cuti'];
                    }

                    mysqli_free_result($result_pegawai);

                    // Query untuk mendapatkan data pegawai terlaris berdasarkan jumlah mutasi
                    $query_pegawai = "
        SELECT pegawai.nama_pegawai, COUNT(mutasi.id_mutasi) as total_mutasi
        FROM mutasi
        INNER JOIN pegawai ON mutasi.id_pegawai = pegawai.id_pegawai
        GROUP BY pegawai.nama_pegawai
        ORDER BY total_mutasi DESC
        LIMIT 7
    ";
                    $result_pegawai_mutasi = mysqli_query($koneksi, $query_pegawai);

                    $pegawai_nama_mutasi = [];
                    $total_mutasi = [];

                    while ($row_pegawai_mutasi = mysqli_fetch_assoc($result_pegawai_mutasi)) {
                        $pegawai_nama_mutasi[] = $row_pegawai_mutasi['nama_pegawai'];
                        $total_mutasi[] = $row_pegawai_mutasi['total_mutasi'];
                    }

                    mysqli_free_result($result_pegawai_mutasi);

                    // Query untuk mendapatkan data pegawai terlaris berdasarkan jumlah pensiun
                    $query_pegawai = "
        SELECT pegawai.nama_pegawai, COUNT(pensiun.id_pensiun) as total_pensiun
        FROM pensiun
        INNER JOIN pegawai ON pensiun.id_pegawai = pegawai.id_pegawai
        GROUP BY pegawai.nama_pegawai
        ORDER BY total_pensiun DESC
        LIMIT 7
    ";
                    $result_pegawai_pensiun = mysqli_query($koneksi, $query_pegawai);

                    $pegawai_nama_pensiun = [];
                    $total_pensiun = [];

                    while ($row_pegawai_pensiun = mysqli_fetch_assoc($result_pegawai_pensiun)) {
                        $pegawai_nama_pensiun[] = $row_pegawai_pensiun['nama_pegawai'];
                        $total_pensiun[] = $row_pegawai_pensiun['total_pensiun'];
                    }

                    mysqli_free_result($result_pegawai_pensiun);

                    // Query untuk mendapatkan data pegawai terlaris berdasarkan jumlah gaji
                    $query_pegawai = "
        SELECT pegawai.nama_pegawai, COUNT(gaji.id_gaji) as total_gaji
        FROM gaji
        INNER JOIN pegawai ON gaji.id_pegawai = pegawai.id_pegawai
        GROUP BY pegawai.nama_pegawai
        ORDER BY total_gaji DESC
        LIMIT 7
    ";
                    $result_pegawai_gaji = mysqli_query($koneksi, $query_pegawai);

                    $pegawai_nama_gaji = [];
                    $total_gaji = [];

                    while ($row_pegawai_gaji = mysqli_fetch_assoc($result_pegawai_gaji)) {
                        $pegawai_nama_gaji[] = $row_pegawai_gaji['nama_pegawai'];
                        $total_gaji[] = $row_pegawai_gaji['total_gaji'];
                    }

                    mysqli_free_result($result_pegawai_gaji);

                    // Query untuk menghitung jumlah data pada setiap tabel
                    $tables = [
                        'cuti' => ['label' => 'Cuti', 'icon' => 'fas fa-procedures', 'color' => '#FFC107'], // Yellow
                        'gaji' => ['label' => 'Gaji', 'icon' => 'fas fa-hand-holding-usd', 'color' => '#DC3545'], // Red
                        'galeri' => ['label' => 'Galeri', 'icon' => 'fas fa-image', 'color' => '#0D6EFD'], //
                        'jabatan' => ['label' => 'Jabatan', 'icon' => 'fas fa-id-card-alt', 'color' => '#0332cf'], // Green
                        'lokasi' => ['label' => 'Lokasi Kerja', 'icon' => 'fas fa-map-marker-alt', 'color' => '#198754'], // Gray
                        'mutasi' => ['label' => 'Mutasi', 'icon' => 'fas fa-walking', 'color' => '#17A2B8'], // Teal
                        'pegawai' => ['label' => 'Pegawai', 'icon' => 'fas fa-id-card', 'color' => '#FFC107'], // Yellow
                        'pensiun' => ['label' => 'Pensiun', 'icon' => 'fas fa-wheelchair', 'color' => '#6C757D'], // Gray
                    ];

                    $counts = [];

                    foreach ($tables as $table => $details) {
                        $query = "SELECT COUNT(*) as count FROM $table";
                        $result = mysqli_query($koneksi, $query);
                        $row = mysqli_fetch_assoc($result);
                        $counts[$table] = $row['count'];
                        mysqli_free_result($result);
                    }

                    mysqli_close($koneksi);
                    ?>
                    <?php include 'fitur/nama_halaman.php'; ?>

                    <section class="section">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5 class="card-title" style="font-size: 30px;">Selamat Datang</h5>
                                        <p>
                                            Silakan lihat informsi yang kami sajikan pada website ini, Berikut adalah
                                            informasi data pada Halaman
                                            <?= $page_title ?>.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="section">
                        <div class="row">

                            <!-- grafik cuti -->
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Diagram Pegawai Yang Cuti</h5>
                                        <!-- Bar Chart -->
                                        <canvas id="barChart" style="max-height: 400px"></canvas>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", () => {
                                                new Chart(document.querySelector("#barChart"), {
                                                    type: "bar",
                                                    data: {
                                                        labels: <?= json_encode($pegawai_nama); ?>,
                                                        datasets: [{
                                                            label: "Jumlah Cuti",
                                                            data: <?= json_encode($total_cuti); ?>,
                                                            backgroundColor: [
                                                                "rgba(255, 99, 132, 0.2)",
                                                                "rgba(255, 159, 64, 0.2)",
                                                                "rgba(255, 205, 86, 0.2)",
                                                                "rgba(75, 192, 192, 0.2)",
                                                                "rgba(54, 162, 235, 0.2)",
                                                                "rgba(153, 102, 255, 0.2)",
                                                                "rgba(201, 203, 207, 0.2)",
                                                            ],
                                                            borderColor: [
                                                                "rgb(255, 99, 132)",
                                                                "rgb(255, 159, 64)",
                                                                "rgb(255, 205, 86)",
                                                                "rgb(75, 192, 192)",
                                                                "rgb(54, 162, 235)",
                                                                "rgb(153, 102, 255)",
                                                                "rgb(201, 203, 207)",
                                                            ],
                                                            borderWidth: 1,
                                                        }],
                                                    },
                                                    options: {
                                                        scales: {
                                                            y: {
                                                                beginAtZero: true,
                                                            },
                                                        },
                                                    },
                                                });
                                            });
                                        </script>
                                        <!-- End Bar Chart -->
                                    </div>
                                </div>
                            </div>

                            <!-- grafik mutasi -->
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Diagram Pegawai Yang Mutasi</h5>
                                        <!-- Bar Chart -->
                                        <canvas id="mutasiChart" style="max-height: 400px"></canvas>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", () => {
                                                new Chart(document.querySelector("#mutasiChart"), {
                                                    type: "bar",
                                                    data: {
                                                        labels: <?= json_encode($pegawai_nama_mutasi); ?>,
                                                        datasets: [{
                                                            label: "Jumlah Mutasi",
                                                            data: <?= json_encode($total_mutasi); ?>,
                                                            backgroundColor: [
                                                                "rgba(255, 99, 132, 0.2)",
                                                                "rgba(255, 159, 64, 0.2)",
                                                                "rgba(255, 205, 86, 0.2)",
                                                                "rgba(75, 192, 192, 0.2)",
                                                                "rgba(54, 162, 235, 0.2)",
                                                                "rgba(153, 102, 255, 0.2)",
                                                                "rgba(201, 203, 207, 0.2)",
                                                            ],
                                                            borderColor: [
                                                                "rgb(255, 99, 132)",
                                                                "rgb(255, 159, 64)",
                                                                "rgb(255, 205, 86)",
                                                                "rgb(75, 192, 192)",
                                                                "rgb(54, 162, 235)",
                                                                "rgb(153, 102, 255)",
                                                                "rgb(201, 203, 207)",
                                                            ],
                                                            borderWidth: 1,
                                                        }],
                                                    },
                                                    options: {
                                                        scales: {
                                                            y: {
                                                                beginAtZero: true,
                                                            },
                                                        },
                                                    },
                                                });
                                            });
                                        </script>
                                        <!-- End Bar Chart -->
                                    </div>
                                </div>
                            </div>

                            <!-- grafil pensiun -->
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Diagram Pegawai Yang Pensiun</h5>
                                        <!-- Bar Chart -->
                                        <canvas id="pensiunChart" style="max-height: 400px"></canvas>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", () => {
                                                new Chart(document.querySelector("#pensiunChart"), {
                                                    type: "bar",
                                                    data: {
                                                        labels: <?= json_encode($pegawai_nama_pensiun); ?>,
                                                        datasets: [{
                                                            label: "Jumlah pensiun",
                                                            data: <?= json_encode($total_pensiun); ?>,
                                                            backgroundColor: [
                                                                "rgba(255, 99, 132, 0.2)",
                                                                "rgba(255, 159, 64, 0.2)",
                                                                "rgba(255, 205, 86, 0.2)",
                                                                "rgba(75, 192, 192, 0.2)",
                                                                "rgba(54, 162, 235, 0.2)",
                                                                "rgba(153, 102, 255, 0.2)",
                                                                "rgba(201, 203, 207, 0.2)",
                                                            ],
                                                            borderColor: [
                                                                "rgb(255, 99, 132)",
                                                                "rgb(255, 159, 64)",
                                                                "rgb(255, 205, 86)",
                                                                "rgb(75, 192, 192)",
                                                                "rgb(54, 162, 235)",
                                                                "rgb(153, 102, 255)",
                                                                "rgb(201, 203, 207)",
                                                            ],
                                                            borderWidth: 1,
                                                        }],
                                                    },
                                                    options: {
                                                        scales: {
                                                            y: {
                                                                beginAtZero: true,
                                                            },
                                                        },
                                                    },
                                                });
                                            });
                                        </script>
                                        <!-- End Bar Chart -->
                                    </div>
                                </div>
                            </div>

                            <!-- pegawai yang sudah mendapatkan gaji -->
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Pegawai Yang Sudah Digaji</h5>
                                        <!-- Bar Chart -->
                                        <canvas id="gajiChart" style="max-height: 400px"></canvas>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", () => {
                                                new Chart(document.querySelector("#gajiChart"), {
                                                    type: "bar",
                                                    data: {
                                                        labels: <?= json_encode($pegawai_nama_gaji); ?>,
                                                        datasets: [{
                                                            label: "Jumlah digaji",
                                                            data: <?= json_encode($total_gaji); ?>,
                                                            backgroundColor: [
                                                                "rgba(255, 99, 132, 0.2)",
                                                                "rgba(255, 159, 64, 0.2)",
                                                                "rgba(255, 205, 86, 0.2)",
                                                                "rgba(75, 192, 192, 0.2)",
                                                                "rgba(54, 162, 235, 0.2)",
                                                                "rgba(153, 102, 255, 0.2)",
                                                                "rgba(201, 203, 207, 0.2)",
                                                            ],
                                                            borderColor: [
                                                                "rgb(255, 99, 132)",
                                                                "rgb(255, 159, 64)",
                                                                "rgb(255, 205, 86)",
                                                                "rgb(75, 192, 192)",
                                                                "rgb(54, 162, 235)",
                                                                "rgb(153, 102, 255)",
                                                                "rgb(201, 203, 207)",
                                                            ],
                                                            borderWidth: 1,
                                                        }],
                                                    },
                                                    options: {
                                                        scales: {
                                                            y: {
                                                                beginAtZero: true,
                                                            },
                                                        },
                                                    },
                                                });
                                            });
                                        </script>
                                        <!-- End Bar Chart -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
                    <div class="row">
                        <?php foreach ($tables as $table => $details): ?>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-secondary bubble-shadow-small"
                                                    style="background-color: <?= $details['color']; ?>;">
                                                    <i class="<?= $details['icon']; ?>"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category"><?= $details['label']; ?></p>
                                                    <h4 class="card-title"><?= $counts[$table]; ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <?php include 'fitur/footer.php'; ?>
        </div>

    </div>
    <?php include 'fitur/js.php'; ?>
</body>

</html>