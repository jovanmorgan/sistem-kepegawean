<?php
include '../../../../keamanan/koneksi.php';

$gaji_pokok = $_POST['gaji_pokok'];
$tunjangan = $_POST['tunjangan'];
$potongan = $_POST['potongan'];
$id_pegawai = $_POST['id_pegawai'];

$total = $gaji_pokok + $tunjangan - $potongan;

// Validasi data
if (empty($gaji_pokok) || empty($tunjangan) || empty($potongan) || empty($id_pegawai)) {
    echo "data_tidak_lengkap";
    exit();
}

// Insert data ke tabel gaji
$query = "INSERT INTO gaji (gaji_pokok, tunjangan, potongan, total, id_pegawai) 
          VALUES ('$gaji_pokok', '$tunjangan', '$potongan', '$total', '$id_pegawai')";

if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

mysqli_close($koneksi);
