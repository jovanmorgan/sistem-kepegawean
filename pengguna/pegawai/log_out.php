<?php
session_start();

// Hapus sesi id_pegawai jika ada
if (isset($_SESSION['id_pegawai'])) {
    unset($_SESSION['id_pegawai']);
}

// Redirect pengguna kembali ke halaman login
header("Location: ../../berlangganan/login");
exit;
