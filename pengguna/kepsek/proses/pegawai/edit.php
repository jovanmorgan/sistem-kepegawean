<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_pegawai = $_POST['id_pegawai']; // Pastikan 'id_pegawai' sudah dikirim melalui form
$nip_pegawai = $_POST['nip_pegawai'];
$nama_pegawai = $_POST['nama_pegawai'];
$username = $_POST['username'];
$password = $_POST['password'];
$id_jabatan = $_POST['id_jabatan'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$status = $_POST['status'];
$golongan = $_POST['golongan'];
$tahun_golongan = $_POST['tahun_golongan'];
$jenjang_pendidikan = $_POST['jenjang_pendidikan'];
$tahun_lulus = $_POST['tahun_lulus'];

// Lakukan validasi data
if (empty($nip_pegawai) || empty($nama_pegawai) || empty($id_jabatan) || empty($jenis_kelamin) || empty($tempat_lahir) || empty($tanggal_lahir) || empty($status) || empty($golongan) || empty($tahun_golongan) || empty($jenjang_pendidikan) || empty($tahun_lulus)) {
    echo "data_tidak_lengkap";
    exit();
}

// Cek apakah username sudah ada di database
$check_query = "SELECT * FROM admin WHERE username = '$username'";
$result = mysqli_query($koneksi, $check_query);
if (mysqli_num_rows($result) > 0) {
    echo "data_sudah_ada"; // Kirim respon "data_sudah_ada" jika email sudah terdaftar
    exit();
}
// Cek apakah username sudah ada di database
$check_query_pegawai = "SELECT * FROM pegawai WHERE username = '$username' AND id_pegawai != '$id_pegawai'";
$result_pegawai = mysqli_query($koneksi, $check_query_pegawai);
if (mysqli_num_rows($result_pegawai) > 0) {
    echo "data_sudah_ada"; // Kirim respon "data_sudah_ada" jika email sudah terdaftar
    exit();
}
// Cek apakah username sudah ada di database
$check_query_kepsek = "SELECT * FROM kepsek WHERE username = '$username'";
$result_kepsek = mysqli_query($koneksi, $check_query_kepsek);
if (mysqli_num_rows($result_kepsek) > 0) {
    echo "data_sudah_ada"; // Kirim respon "data_sudah_ada" jika email sudah terdaftar
    exit();
}

if (strlen($password) < 8) {
    echo "error_password_length"; // Kirim respon "error_password_length" jika panjang password kurang dari 8 karakter
    exit();
}

// Tambahkan logika untuk memeriksa password
if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/", $password)) {
    echo "error_password_strength"; // Kirim respon "error_password_strength" jika password tidak memenuhi syarat
    exit();
}

// Buat query SQL untuk mengedit data pegawai yang sudah ada berdasarkan id_pegawai
$query = "UPDATE pegawai 
        SET nip_pegawai = '$nip_pegawai', 
            nama_pegawai = '$nama_pegawai', 
            username = '$username',
            password = '$password',
            id_jabatan = '$id_jabatan', 
            jenis_kelamin = '$jenis_kelamin', 
            tempat_lahir = '$tempat_lahir', 
            tanggal_lahir = '$tanggal_lahir', 
            status = '$status', 
            golongan = '$golongan', 
            tahun_golongan = '$tahun_golongan', 
            jenjang_pendidikan = '$jenjang_pendidikan', 
            tahun_lulus = '$tahun_lulus' 
        WHERE id_pegawai = '$id_pegawai'";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
