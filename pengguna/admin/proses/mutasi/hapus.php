<?php
include '../../../../keamanan/koneksi.php';

// Terima ID mutasi yang akan dihapus dari formulir HTML
$id_mutasi = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_mutasi)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data mutasi berdasarkan ID
$query_delete_mutasi = "DELETE FROM mutasi WHERE id_mutasi = '$id_mutasi'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_mutasi)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
