<?php
include '../../../../keamanan/koneksi.php';

// Terima ID cuti yang akan dihapus dari formulir HTML
$id_cuti = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_cuti)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data cuti berdasarkan ID
$query_delete_cuti = "DELETE FROM cuti WHERE id_cuti = '$id_cuti'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_cuti)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
