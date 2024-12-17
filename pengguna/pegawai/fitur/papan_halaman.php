 <?php include 'nama_halaman.php'; ?>

 <div class="page-header">
     <h3 class="fw-bold mb-3"><?= $page_title ?> </h3>
     <ul class="breadcrumbs mb-3">
         <li class="nav-home">
             <a href="dashboard">
                 <i class="icon-home"></i>
             </a>
         </li>
         <li class="separator">
             <i class="icon-arrow-right"></i>
         </li>
         <?php if ($page_title == "Pegawai" || $page_title == "Kepala Sekolah"): ?>
         <li class="nav-item">
             <a href="#">Penggunah</a>
         </li>
         <li class="separator">
             <i class="icon-arrow-right"></i>
         </li>
         <?php endif; ?>
         <?php if ($page_title !== "Galeri" && $page_title !== "Pegawai" && $page_title !== "Kepala Sekolah" && $page_title !== "Profile Saya"): ?>
         <li class="nav-item">
             <a href="#">Sistem</a>
         </li>
         <li class="separator">
             <i class="icon-arrow-right"></i>
         </li>
         <?php endif; ?>

         <li class="nav-item">
             <a href="#"><?= $page_title ?> </a>
         </li>
     </ul>

 </div>