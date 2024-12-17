<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari form edit
$id_lokasi = $_POST['id_lokasi'];
$nama_lokasi = $_POST['nama_lokasi'];
$nomor_hp = $_POST['nomor_hp'];
$alamat = $_POST['alamat'];
$id_pegawai = $_POST['id_pegawai'];

// Lakukan validasi data
if (empty($id_lokasi) || empty($nama_lokasi) || empty($nomor_hp) || empty($alamat) || empty($id_pegawai)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk mengupdate data lokasi berdasarkan id_lokasi
$query = "UPDATE lokasi 
          SET nama_lokasi = '$nama_lokasi', nomor_hp = '$nomor_hp', alamat = '$alamat', id_pegawai = '$id_pegawai'
          WHERE id_lokasi = '$id_lokasi'";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
