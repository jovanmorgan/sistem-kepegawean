<?php
include '../../../../keamanan/koneksi.php';

$id_gaji = $_POST['id_gaji'];
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

// Update data gaji
$query = "UPDATE gaji SET gaji_pokok='$gaji_pokok', tunjangan='$tunjangan', potongan='$potongan', total='$total', id_pegawai='$id_pegawai' 
          WHERE id_gaji='$id_gaji'";

if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

mysqli_close($koneksi);
