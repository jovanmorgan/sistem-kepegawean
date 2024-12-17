<?php
include '../../../../keamanan/koneksi.php';

// Terima ID gaji yang akan dihapus dari formulir HTML
$id_gaji = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_gaji)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data gaji berdasarkan ID
$query_delete_gaji = "DELETE FROM gaji WHERE id_gaji = '$id_gaji'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_gaji)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
