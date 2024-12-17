<?php
// Lakukan koneksi ke database
include '../../../../keamanan/koneksi.php';

// Cek apakah terdapat data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data yang dikirimkan melalui form
    $id_pegawai = $_POST['id_pegawai'];
    $nama_pegawai = $_POST['nama_pegawai'];
    $password = $_POST['password'];
    $username = $_POST['username'];

    // Lakukan validasi data
    if (empty($nama_pegawai) || empty($password)) {
        echo "data tidak lengkap";
        exit();
    }

    // Query SQL untuk update data foto profile
    $query = "UPDATE pegawai SET password='$password', nama_pegawai='$nama_pegawai', username='$username' WHERE id_pegawai='$id_pegawai'";

    // Lakukan proses update data foto profile di database
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        echo "success";
        exit();
    } else {
        // Jika terjadi kesalahan saat melakukan proses update, tampilkan pesan kesalahan
        echo "Gagal melakukan proses update data foto profile: " . mysqli_error($koneksi);
    }
} else {
    // Jika metode request bukan POST, berikan respons yang sesuai
    echo "Invalid request method";
    exit();
}

// Tutup koneksi ke database
mysqli_close($koneksi);
