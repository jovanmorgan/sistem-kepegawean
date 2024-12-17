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
                                 <button class="btn btn-outline-secondary" type="submit">Cari</button>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </section>

     <?php
        // Ambil data pegawai dari database
        include '../../../../keamanan/koneksi.php';

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