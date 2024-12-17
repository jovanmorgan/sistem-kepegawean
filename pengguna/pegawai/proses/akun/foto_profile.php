<?php
session_start();

// Pastikan session 'id_pegawai' sudah ter-set
if (!isset($_SESSION['id_pegawai'])) {
    // Redirect atau berikan respons sesuai kebutuhan jika session tidak tersedia
    exit("Session 'id_pegawai' tidak tersedia.");
}

include '../../../../keamanan/koneksi.php';

// Folder tempat menyimpan gambar
$target_dir = "../../../../assets/img/fp_pengguna/pegawai/";

// Mendapatkan nama file gambar
$image = $_POST['imageBase64'];

// Menyimpan gambar ke folder data_fp
list($type, $image) = explode(';', $image);
list(, $image) = explode(',', $image);
$image = base64_decode($image);
$filename = uniqid() . '.png'; // Membuat nama unik untuk gambar
$file = $target_dir . $filename;
file_put_contents($file, $image);

// Mengambil nama foto profile sebelumnya
$id_pegawai = $_SESSION['id_pegawai'];
$select_query = "SELECT fp FROM pegawai WHERE id_pegawai = '$id_pegawai'";
$select_result = mysqli_query($koneksi, $select_query);

// Jika foto profile sebelumnya ditemukan, hapus file tersebut
if (mysqli_num_rows($select_result) > 0) {
    $row = mysqli_fetch_assoc($select_result);
    $previous_image = $row['fp'];
    $previous_file = $target_dir . $previous_image;
    if (file_exists($previous_file) && is_file($previous_file)) {
        unlink($previous_file); // Hapus file gambar sebelumnya jika ada dan merupakan file
    }
}

// Update nama gambar di tabel pegawai berdasarkan id_pegawai
$update_query = "UPDATE pegawai SET fp = '$filename' WHERE id_pegawai = '$id_pegawai'";
$update_result = mysqli_query($koneksi, $update_query);

if ($update_result) {
    // Berhasil menyimpan gambar dan update nama gambar di tabel pegawai
    echo "Gambar berhasil diupdate.";
} else {
    // Gagal melakukan update
    echo "Gagal mengupdate gambar.";
}

// Tutup koneksi database
mysqli_close($koneksi);
