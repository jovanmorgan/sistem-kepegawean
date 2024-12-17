<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari form tambah
$tanggal_cuti = $_POST['tanggal_cuti'];
$jenis_cuti = $_POST['jenis_cuti'];
$lama_cuti = $_POST['lama_cuti'];
$id_pegawai = $_POST['id_pegawai'];

// Lakukan validasi data
if (empty($tanggal_cuti) || empty($jenis_cuti) || empty($lama_cuti) || empty($id_pegawai)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menambahkan data cuti ke dalam database
$query = "INSERT INTO cuti (tanggal_cuti, jenis_cuti, lama_cuti, id_pegawai) 
          VALUES ('$tanggal_cuti', '$jenis_cuti', '$lama_cuti', '$id_pegawai')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
