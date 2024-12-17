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
                                          placeholder="Cari jabatan atau nomor rekening..." name="search"
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
            include '../../../../keamanan/koneksi.php';

            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 10;
            $offset = ($page - 1) * $limit;

            // Query untuk mendapatkan data gaji dan pegawai dengan pencarian dan pagination
            $query = "
    SELECT gaji.*, pegawai.nama_pegawai 
    FROM gaji 
    LEFT JOIN pegawai ON gaji.id_pegawai = pegawai.id_pegawai 
    WHERE gaji.gaji_pokok LIKE ? 
    OR gaji.tunjangan LIKE ? 
    OR gaji.total LIKE ? 
    OR gaji.potongan LIKE ? 
    LIMIT ?, ?";

            $stmt = $koneksi->prepare($query);
            $search_param = '%' . $search . '%';
            $stmt->bind_param("ssssii", $search_param, $search_param, $search_param, $search_param, $offset, $limit);
            $stmt->execute();
            $result = $stmt->get_result();

            // Hitung total halaman
            $total_query = "
    SELECT COUNT(*) as total 
    FROM gaji 
    LEFT JOIN pegawai ON gaji.id_pegawai = pegawai.id_pegawai 
    WHERE gaji.gaji_pokok LIKE ? 
    OR gaji.tunjangan LIKE ? 
    OR gaji.total LIKE ? 
    OR gaji.potongan LIKE ?";

            $stmt_total = $koneksi->prepare($total_query);
            $stmt_total->bind_param("ssss", $search_param, $search_param, $search_param, $search_param);
            $stmt_total->execute();
            $total_result = $stmt_total->get_result();
            $total_row = $total_result->fetch_assoc();
            $total_pages = ceil($total_row['total'] / $limit);
            ?>

          <!-- Tabel Data gaji -->
          <section class="section">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="card">
                          <div class="card-body" style="overflow-x: hidden;">
                              <div style="overflow-x: auto;">
                                  <?php if ($result->num_rows > 0): ?>
                                      <table class="table table-hover text-center mt-3"
                                          style="border-collapse: separate; border-spacing: 0;">
                                          <thead>
                                              <tr>
                                                  <th>Nomor</th>
                                                  <th>Gaji</th>
                                                  <th>Nama Pegawai</th> <!-- Tambahkan kolom Nama Pegawai -->
                                                  <th>Tunjangan</th>
                                                  <th>Potongan</th>
                                                  <th>Total</th>
                                                  <th>Aksi</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php
                                                $nomor = $offset + 1;
                                                while ($row = $result->fetch_assoc()) :
                                                ?>
                                                  <tr>
                                                      <td><?php echo $nomor++; ?></td>
                                                      <td><?php echo htmlspecialchars($row['gaji_pokok']); ?>
                                                      </td>
                                                      <td><?php echo htmlspecialchars($row['nama_pegawai']); ?>
                                                      </td> <!-- Menampilkan nama pegawai -->
                                                      <td><?php echo htmlspecialchars($row['tunjangan']); ?></td>
                                                      <td><?php echo htmlspecialchars($row['potongan']); ?></td>
                                                      <td><?php echo htmlspecialchars($row['total']); ?></td>
                                                      <td>
                                                          <button class="btn btn-warning btn-sm"
                                                              onclick="openEditModal('<?php echo $row['id_gaji']; ?>', '<?php echo $row['gaji_pokok']; ?>', '<?php echo $row['tunjangan']; ?>', '<?php echo $row['potongan']; ?>', '<?php echo $row['id_pegawai']; ?>')">Edit</button>
                                                          <button class="btn btn-danger btn-sm"
                                                              onclick="hapus('<?php echo $row['id_gaji']; ?>')">Hapus</button>
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