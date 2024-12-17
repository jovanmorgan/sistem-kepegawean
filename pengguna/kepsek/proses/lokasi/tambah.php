<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari form tambah
$nama_lokasi = $_POST['nama_lokasi'];
$nomor_hp = $_POST['nomor_hp'];
$alamat = $_POST['alamat'];
$id_pegawai = $_POST['id_pegawai'];

// Lakukan validasi data
if (empty($nama_lokasi) || empty($nomor_hp) || empty($alamat) || empty($id_pegawai)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menambahkan data lokasi ke dalam database
$query = "INSERT INTO lokasi (nama_lokasi, nomor_hp, alamat, id_pegawai) 
          VALUES ('$nama_lokasi', '$nomor_hp', '$alamat', '$id_pegawai')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
