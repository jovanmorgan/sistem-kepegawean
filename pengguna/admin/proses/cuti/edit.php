<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari form edit
$id_cuti = $_POST['id_cuti'];
$tanggal_cuti = $_POST['tanggal_cuti'];
$jenis_cuti = $_POST['jenis_cuti'];
$lama_cuti = $_POST['lama_cuti'];
$id_pegawai = $_POST['id_pegawai'];

// Lakukan validasi data
if (empty($id_cuti) || empty($tanggal_cuti) || empty($jenis_cuti) || empty($lama_cuti) || empty($id_pegawai)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk mengupdate data cuti berdasarkan id_cuti
$query = "UPDATE cuti 
          SET tanggal_cuti = '$tanggal_cuti', jenis_cuti = '$jenis_cuti', lama_cuti = '$lama_cuti', id_pegawai = '$id_pegawai'
          WHERE id_cuti = '$id_cuti'";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
