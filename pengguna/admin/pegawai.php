<?php include 'fitur/penggunah.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'fitur/head.php'; ?>
<?php include 'fitur/nama_halaman.php'; ?>
<?php include 'fitur/nama_halaman_proses.php'; ?>

<body>
    <div class="wrapper">
        <?php include 'fitur/sidebar.php'; ?>
        <div class="main-panel">
            <?php include 'fitur/navbar.php'; ?>
            <div class="container">
                <div class="page-inner">
                    <?php include 'fitur/papan_halaman.php'; ?>

                    <div id="load_data">
                        <section class="section">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <!-- Search Form -->
                                            <form method="GET" action="">
                                                <div class="input-group mt-3">
                                                    <input type="text" class="form-control"
                                                        placeholder="Cari pegawai atau nomor rekening..." name="search"
                                                        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                                    <button class="btn btn-outline-secondary"
                                                        type="submit">Cari</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <?php
                        // Ambil data pegawai dari database
                        include '../../keamanan/koneksi.php';

                        $search = isset($_GET['search']) ? $_GET['search'] : '';
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $limit = 10;
                        $offset = ($page - 1) * $limit;

                        // Query untuk mendapatkan data pegawai dan nama jabatan dengan pencarian dan pagination
                        $query = "
                            SELECT p.*, j.jabatan 
                            FROM pegawai p
                            JOIN jabatan j ON p.id_jabatan = j.id_jabatan
                            WHERE p.nama_pegawai LIKE ? OR p.nip_pegawai LIKE ?
                            LIMIT ?, ?";

                        $stmt = $koneksi->prepare($query);
                        $search_param = '%' . $search . '%';
                        $stmt->bind_param("ssii", $search_param, $search_param, $offset, $limit);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Query total untuk pagination
                        $total_query = "
                                            SELECT COUNT(*) as total
                                            FROM pegawai p
                                            JOIN jabatan j ON p.id_jabatan = j.id_jabatan
                                            WHERE p.nama_pegawai LIKE ? OR p.nip_pegawai LIKE ?";
                        $stmt_total = $koneksi->prepare($total_query);
                        $stmt_total->bind_param("ss", $search_param, $search_param);
                        $stmt_total->execute();
                        $total_result = $stmt_total->get_result();
                        $total_row = $total_result->fetch_assoc();
                        $total_pages = ceil($total_row['total'] / $limit);

                        ?>

                        <!-- Tabel Data pegawai -->
                        <section class="section">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body" style="overflow-x: hidden;">
                                            <!-- Overflow-x diatur untuk menyembunyikan scrollbar -->
                                            <div style="overflow-x: auto;">
                                                <?php if ($result->num_rows > 0): ?>
                                                    <table class="table table-hover text-center mt-3"
                                                        style="border-collapse: separate; border-spacing: 0;">
                                                        <thead>
                                                            <tr>
                                                                <th style="white-space: nowrap;">Nomor</th>
                                                                <th style="white-space: nowrap;">Nama Pegawai</th>
                                                                <th style="white-space: nowrap;">NIP Pegawai</th>
                                                                <th style="white-space: nowrap;">Username</th>
                                                                <th style="white-space: nowrap;">Password</th>
                                                                <th style="white-space: nowrap;">Jabatan</th>
                                                                <th style="white-space: nowrap;">Jenis Kelamin</th>
                                                                <th style="white-space: nowrap;">Tempat Lahir</th>
                                                                <th style="white-space: nowrap;">Tanggal Lahir</th>
                                                                <th style="white-space: nowrap;">Status</th>
                                                                <th style="white-space: nowrap;">Golongan</th>
                                                                <th style="white-space: nowrap;">Tahun Golongan</th>
                                                                <th style="white-space: nowrap;">Jenjang Pendidikan</th>
                                                                <th style="white-space: nowrap;">Tahun Lulus</th>
                                                                <th style="white-space: nowrap;">Edit</th>
                                                                <th style="white-space: nowrap;">Hapus</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php
                                                            $nomor = $offset + 1; // Mulai nomor urut dari $offset + 1
                                                            while ($row = $result->fetch_assoc()) :
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $nomor++; ?></td>
                                                                    <td><?php echo htmlspecialchars($row['nama_pegawai']); ?>
                                                                    </td>
                                                                    <td><?php echo htmlspecialchars($row['nip_pegawai']); ?>
                                                                    </td>
                                                                    <td><?php echo htmlspecialchars($row['username']); ?>
                                                                    </td>
                                                                    <td><?php echo htmlspecialchars($row['password']); ?>
                                                                    </td>
                                                                    <td><?php echo htmlspecialchars($row['jabatan']); ?>
                                                                    </td>
                                                                    <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?>
                                                                    </td>
                                                                    <td><?php echo htmlspecialchars($row['tempat_lahir']); ?>
                                                                    </td>
                                                                    <td><?php echo htmlspecialchars($row['tanggal_lahir']); ?>
                                                                    </td>
                                                                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                                                                    <td><?php echo htmlspecialchars($row['golongan']); ?></td>
                                                                    <td><?php echo htmlspecialchars($row['tahun_golongan']); ?>
                                                                    </td>
                                                                    <td><?php echo htmlspecialchars($row['jenjang_pendidikan']); ?>
                                                                    </td>
                                                                    <td><?php echo htmlspecialchars($row['tahun_lulus']); ?>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-warning btn-sm" onclick="openEditModal(
            '<?php echo $row['id_pegawai']; ?>',
            '<?php echo $row['nip_pegawai']; ?>',
            '<?php echo $row['nama_pegawai']; ?>',
            '<?php echo $row['username']; ?>',
            '<?php echo $row['password']; ?>',
            '<?php echo $row['id_jabatan']; ?>',
            '<?php echo $row['jenis_kelamin']; ?>',
            '<?php echo $row['tempat_lahir']; ?>',
            '<?php echo $row['tanggal_lahir']; ?>',
            '<?php echo $row['status']; ?>',
            '<?php echo $row['golongan']; ?>',
            '<?php echo $row['tahun_golongan']; ?>',
            '<?php echo $row['jenjang_pendidikan']; ?>',
            '<?php echo $row['tahun_lulus']; ?>'
        )">
                                                                            Edit
                                                                        </button>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-danger btn-sm"
                                                                            onclick="hapus('<?php echo $row['id_pegawai']; ?>')">Hapus</button>
                                                                    </td>

                                                                </tr>
                                                            <?php endwhile; ?>
                                                        </tbody>
                                                    </table>

                                                <?php else: ?>
                                                    <p class="text-center mt-4">Data tidak ditemukan.</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Pagination Section -->
                        <section class="section">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <!-- Pagination with icons -->
                                            <nav aria-label="Pagxample" style="margin-top: 2.2rem;">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item <?php if ($page <= 1) {
                                                                                echo 'disabled';
                                                                            } ?>">
                                                        <a class="page-link" href="<?php if ($page > 1) {
                                                                                        echo "?page=" . ($page - 1) . "&search=" . $search;
                                                                                    } ?>" aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                        </a>
                                                    </li>
                                                    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                                        <li class="page-item <?php if ($i == $page) {
                                                                                    echo 'active';
                                                                                } ?>">
                                                            <a class="page-link"
                                                                href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>"><?php echo $i; ?></a>
                                                        </li>
                                                    <?php } ?>
                                                    <li class="page-item <?php if ($page >= $total_pages) {
                                                                                echo 'disabled';
                                                                            } ?>">
                                                        <a class="page-link" href="<?php if ($page < $total_pages) {
                                                                                        echo "?page=" . ($page + 1) . "&search=" . $search;
                                                                                    } ?>" aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                            <!-- End Pagination with icons -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

            <!-- bagian pop up edit dan tambah -->

            <?php include 'fitur/nama_halaman.php'; ?>

            <!-- Modal -->
            <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahDataModalLabel">Tambah <?= $page_title ?></h5>
                            <button type="button" class="btn-close" id="closeTambahModal" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="tambahForm" method="POST" action="proses/<?= $page_title_proses ?>/tambah.php"
                                enctype="multipart/form-data">

                                <!-- NIP Pegawai -->
                                <div class="mb-3">
                                    <label for="nip_pegawai" class="form-label">NIP Pegawai</label>
                                    <input type="number" id="nip_pegawai" name="nip_pegawai" class="form-control"
                                        required>
                                </div>

                                <!-- Nama Pegawai -->
                                <div class="mb-3">
                                    <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                                    <input type="text" id="nama_pegawai" name="nama_pegawai" class="form-control"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" id="username" name="username" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" id="password" name="password" class="form-control" required>
                                </div>

                                <!-- Jabatan -->
                                <div class="mb-3">
                                    <label for="id_jabatan" class="form-label">Jabatan</label>
                                    <select id="id_jabatan" name="id_jabatan" class="form-select" required>
                                        <option value="">Pilih Jabatan</option>
                                        <?php
                                        // Ambil data jabatan dari tabel jabatan
                                        include '../../keamanan/koneksi.php';
                                        $query = "SELECT id_jabatan, jabatan FROM jabatan";
                                        $result = mysqli_query($koneksi, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='{$row['id_jabatan']}'>{$row['jabatan']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Jenis Kelamin -->
                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                                        <option value="" selected>Silakan Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>

                                <!-- Tempat Lahir -->
                                <div class="mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control"
                                        required>
                                </div>

                                <!-- Tanggal Lahir -->
                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control"
                                        required>
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select id="status" name="status" class="form-control" required>
                                        <option value="" disabled selected>Pilih Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                    </select>
                                </div>

                                <!-- Golongan -->
                                <div class="mb-3">
                                    <label for="golongan" class="form-label">Golongan</label>
                                    <input type="text" id="golongan" name="golongan" class="form-control" required>
                                </div>

                                <!-- Tahun Golongan -->
                                <div class="mb-3">
                                    <label for="tahun_golongan" class="form-label">Tahun Golongan</label>
                                    <input type="text" id="tahun_golongan" name="tahun_golongan" class="form-control"
                                        required>
                                </div>

                                <!-- Jenjang Pendidikan -->
                                <div class="mb-3">
                                    <label for="jenjang_pendidikan" class="form-label">Jenjang Pendidikan</label>
                                    <select id="jenjang_pendidikan" name="jenjang_pendidikan" class="form-control"
                                        required>
                                        <option value="" disabled selected>Pilih Jenjang Pendidikan</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA">SMA</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="Sarjana">Sarjana</option>
                                        <option value="Magister">Magister</option>
                                        <option value="Doktor">Doktor</option>
                                    </select>
                                </div>

                                <!-- Tahun Lulus -->
                                <div class="mb-3">
                                    <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                                    <input type="text" id="tahun_lulus" name="tahun_lulus" class="form-control"
                                        required>
                                </div>

                                <!-- Wrapper for the submit button to align it to the right -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editDataModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editDataModalLabel">Edit <?= $page_title ?></h5>
                            <button type="button" class="btn-close" id="closeEditModal" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editForm" method="POST" action="proses/<?= $page_title_proses ?>/edit.php"
                                enctype="multipart/form-data">
                                <input type="hidden" id="edit_id" name="id_pegawai">

                                <!-- NIP Pegawai -->
                                <div class="mb-3">
                                    <label for="edit_nip_pegawai" class="form-label">NIP Pegawai</label>
                                    <input type="number" id="edit_nip_pegawai" name="nip_pegawai" class="form-control"
                                        required>
                                </div>

                                <!-- Nama Pegawai -->
                                <div class="mb-3">
                                    <label for="edit_nama_pegawai" class="form-label">Nama Pegawai</label>
                                    <input type="text" id="edit_nama_pegawai" name="nama_pegawai" class="form-control"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="edit_username" class="form-label">Username</label>
                                    <input type="text" id="edit_username" name="username" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="edit_password" class="form-label">Password</label>
                                    <input type="text" id="edit_password" name="password" class="form-control" required>
                                </div>

                                <!-- Jabatan -->
                                <div class="mb-3">
                                    <label for="edit_id_jabatan" class="form-label">Jabatan</label>
                                    <select id="edit_id_jabatan" name="id_jabatan" class="form-select" required>
                                        <option value="">Pilih Jabatan</option>
                                        <?php
                                        include '../../keamanan/koneksi.php';
                                        // Ambil data jabatan untuk form edit
                                        $query = "SELECT id_jabatan, jabatan FROM jabatan";
                                        $result = mysqli_query($koneksi, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='{$row['id_jabatan']}'>{$row['jabatan']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Jenis Kelamin -->
                                <div class="mb-3">
                                    <label for="edit_jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select id="edit_jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                                        <option value="" selected>Silakan Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>

                                <!-- Tempat Lahir -->
                                <div class="mb-3">
                                    <label for="edit_tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" id="edit_tempat_lahir" name="tempat_lahir" class="form-control"
                                        required>
                                </div>

                                <!-- Tanggal Lahir -->
                                <div class="mb-3">
                                    <label for="edit_tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" id="edit_tanggal_lahir" name="tanggal_lahir" class="form-control"
                                        required>
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label for="statusedit_status" class="form-label">Status</label>
                                    <select id="edit_status" name="status" class="form-control" required>
                                        <option value="" disabled selected>Pilih Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                    </select>
                                </div>

                                <!-- Golongan -->
                                <div class="mb-3">
                                    <label for="edit_golongan" class="form-label">Golongan</label>
                                    <input type="text" id="edit_golongan" name="golongan" class="form-control" required>
                                </div>

                                <!-- Tahun Golongan -->
                                <div class="mb-3">
                                    <label for="edit_tahun_golongan" class="form-label">Tahun Golongan</label>
                                    <input type="text" id="edit_tahun_golongan" name="tahun_golongan"
                                        class="form-control" required>
                                </div>

                                <!-- Jenjang Pendidikan -->
                                <div class="mb-3">
                                    <label for="edit_jenjang_pendidikan" class="form-label">Jenjang Pendidikan</label>
                                    <select id="edit_jenjang_pendidikan" name="jenjang_pendidikan" class="form-control"
                                        required>
                                        <option value="" disabled selected>Pilih Jenjang Pendidikan</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA">SMA</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="Sarjana">Sarjana</option>
                                        <option value="Magister">Magister</option>
                                        <option value="Doktor">Doktor</option>
                                    </select>
                                </div>

                                <!-- Tahun Lulus -->
                                <div class="mb-3">
                                    <label for="edit_tahun_lulus" class="form-label">Tahun Lulus</label>
                                    <input type="text" id="edit_tahun_lulus" name="tahun_lulus" class="form-control"
                                        required>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'fitur/footer.php'; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('tambahForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Menghentikan aksi default form submit

                var form = this;
                var formData = new FormData(form);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'proses/<?= $page_title_proses ?>/tambah.php', true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = xhr.responseText.trim();
                        console.log(response); // Debugging

                        if (response === 'success') {
                            form.reset();
                            document.getElementById('closeTambahModal').click();
                            loadTable(); // reload table data

                            Swal.fire({
                                title: "Berhasil!",
                                text: "Data berhasil ditambahkan",
                                icon: "success",
                                timer: 1200, // 1,2 detik
                                showConfirmButton: false, // Tidak menampilkan tombol OK
                            });
                        } else if (response === 'error_password_length') {
                            Swal.fire({
                                title: "Error",
                                text: "Password harus terdiri dari minimal 8 karakter.",
                                icon: "info",
                                timer: 2000, // 2 detik
                                showConfirmButton: false,
                            });
                        } else if (response === 'error_password_strength') {
                            Swal.fire({
                                title: "Error",
                                text: "Password harus mengandung huruf besar, huruf kecil, dan angka.",
                                icon: "info",
                                timer: 2000, // 2 detik
                                showConfirmButton: false,
                            });
                        } else if (response === 'data_sudah_ada') {
                            Swal.fire({
                                title: "Error",
                                text: "Data username sudah ada, silakan masukan data username lainnya",
                                icon: "info",
                                timer: 2000, // 2 detik
                                showConfirmButton: false,
                            });
                        } else if (response === 'data_tidak_lengkap') {
                            Swal.fire({
                                title: "Error",
                                text: "Data yang anda masukan belum lengkap",
                                icon: "info",
                                timer: 2000, // 2 detik
                                showConfirmButton: false,
                            });
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: "Gagal menambahkan data",
                                icon: "error",
                                timer: 2000, // 2 detik
                                showConfirmButton: false,
                            });
                        }
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Terjadi kesalahan saat mengirim data",
                            icon: "error",
                            timer: 2000, // 2 detik
                            showConfirmButton: false,
                        });
                    }
                };
                xhr.send(formData);
            });
        });

        function openEditModal(id_pegawai, nip_pegawai, nama_pegawai, username, password, id_jabatan, jenis_kelamin,
            tempat_lahir,
            tanggal_lahir, status,
            golongan, tahun_golongan, jenjang_pendidikan, tahun_lulus) {
            // Set nilai di setiap input pada modal
            document.getElementById('edit_id').value = id_pegawai;
            document.getElementById('edit_nip_pegawai').value = nip_pegawai;
            document.getElementById('edit_nama_pegawai').value = nama_pegawai;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_password').value = password;
            document.getElementById('edit_id_jabatan').value = id_jabatan;
            document.getElementById('edit_jenis_kelamin').value = jenis_kelamin;
            document.getElementById('edit_tempat_lahir').value = tempat_lahir;
            document.getElementById('edit_tanggal_lahir').value = tanggal_lahir;
            document.getElementById('edit_status').value = status;
            document.getElementById('edit_golongan').value = golongan;
            document.getElementById('edit_tahun_golongan').value = tahun_golongan;
            document.getElementById('edit_jenjang_pendidikan').value = jenjang_pendidikan;
            document.getElementById('edit_tahun_lulus').value = tahun_lulus;

            // Tampilkan modal
            var modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.show();
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('editForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Menghentikan aksi default form submit

                var form = this;
                var formData = new FormData(form);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'proses/<?= $page_title_proses ?>/edit.php', true);
                xhr.onload = function() {

                    if (xhr.status === 200) {
                        var response = xhr.responseText.trim();
                        console.log(response); // Debugging

                        if (response === 'success') {
                            form.reset();
                            document.getElementById('closeEditModal').click();
                            loadTable(); // reload table data

                            Swal.fire({
                                title: "Berhasil!",
                                text: "Data berhasil diperbarui",
                                icon: "success",
                                timer: 1200, // 1,2 detik
                                showConfirmButton: false, // Tidak menampilkan tombol OK
                            });
                        } else if (response === 'data_sudah_ada') {
                            Swal.fire({
                                title: "Error",
                                text: "Data username sudah ada, silakan masukan data username lainnya",
                                icon: "info",
                                timer: 2000, // 2 detik
                                showConfirmButton: false,
                            });
                        } else if (response === 'error_password_length') {
                            Swal.fire({
                                title: "Error",
                                text: "Password harus terdiri dari minimal 8 karakter.",
                                icon: "info",
                                timer: 2000, // 2 detik
                                showConfirmButton: false,
                            });
                        } else if (response === 'error_password_strength') {
                            Swal.fire({
                                title: "Error",
                                text: "Password harus mengandung huruf besar, huruf kecil, dan angka.",
                                icon: "info",
                                timer: 2000, // 2 detik
                                showConfirmButton: false,
                            });
                        } else if (response === 'data_tidak_lengkap') {
                            Swal.fire({
                                title: "Error",
                                text: "Data yang anda masukan belum lengkap",
                                icon: "info",
                                timer: 2000, // 2 detik
                                showConfirmButton: false,
                            });
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: "Gagal memperbarui data",
                                icon: "error",
                                timer: 2000, // 2 detik
                                showConfirmButton: false,
                            });
                        }
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Terjadi kesalahan saat mengirim data",
                            icon: "error",
                            timer: 2000, // 2 detik
                            showConfirmButton: false,
                        });
                    }
                };
                xhr.send(formData);
            });
        });

        function hapus(id) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengonfirmasi untuk menghapus
                    var xhr = new XMLHttpRequest();

                    xhr.open('POST', 'proses/<?= $page_title_proses ?>/hapus.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {

                        if (xhr.status === 200) {
                            var response = xhr.responseText.trim();
                            if (response === 'success') {
                                loadTable();
                                Swal.fire({
                                    title: 'Sukses!',
                                    text: 'Data berhasil dihapus.',
                                    icon: 'success',
                                    timer: 1200, // 1,2 detik
                                    showConfirmButton: false // Menghilangkan tombol OK
                                }).then(() => {
                                    location.reload()
                                })
                            } else if (response === 'error') {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Gagal menghapus Data.',
                                    icon: 'error',
                                    timer: 2000, // 2 detik
                                    showConfirmButton: false // Menghilangkan tombol OK
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Terjadi kesalahan saat mengirim data.',
                                    icon: 'error',
                                    timer: 2000, // 2 detik
                                    showConfirmButton: false // Menghilangkan tombol OK
                                });
                            }
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: 'Terjadi kesalahan saat mengirim data.',
                                icon: 'error',
                                timer: 2000, // 2 detik
                                showConfirmButton: false // Menghilangkan tombol OK
                            });
                        }
                    };
                    xhr.send("id=" + id);
                } else {
                    // Jika pengguna membatalkan penghapusan
                    Swal.fire({
                        title: 'Penghapusan dibatalkan',
                        icon: 'info',
                        timer: 1500, // 1,5 detik
                        showConfirmButton: false // Menghilangkan tombol OK
                    });
                }
            });
        }

        function loadTable() {
            // Get current page and search query from URL
            var currentPage = new URLSearchParams(window.location.search).get('page') || 1;
            var searchQuery = new URLSearchParams(window.location.search).get('search') || '';

            var xhrTable = new XMLHttpRequest();
            xhrTable.onreadystatechange = function() {
                if (xhrTable.readyState == 4 && xhrTable.status == 200) {
                    document.getElementById('load_data').innerHTML = xhrTable.responseText;
                }
            };

            // Send request with current page and search query
            xhrTable.open('GET', 'proses/<?= $page_title_proses ?>/load_data.php?page=' + currentPage + '&search=' +
                encodeURIComponent(
                    searchQuery), true);
            xhrTable.send();
        }
    </script>
    <?php include 'fitur/js.php'; ?>
</body>

</html>
<?php include 'fitur/js.php'; ?>
</body>

</html>