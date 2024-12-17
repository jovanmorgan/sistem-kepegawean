<?php
include '../../../../keamanan/koneksi.php';

// Terima ID lokasi yang akan dihapus dari formulir HTML
$id_lokasi = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_lokasi)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data lokasi berdasarkan ID
$query_delete_lokasi = "DELETE FROM lokasi WHERE id_lokasi = '$id_lokasi'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_lokasi)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
