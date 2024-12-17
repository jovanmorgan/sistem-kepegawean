<?php
include 'koneksi.php';

function checkpenggunahType($username)
{
    global $koneksi;
    $query_admin = "SELECT * FROM admin WHERE username = '$username'";
    $query_pegawai = "SELECT * FROM pegawai WHERE username = '$username'";
    $query_kepsek = "SELECT * FROM kepsek WHERE username = '$username'";

    $result_admin = mysqli_query($koneksi, $query_admin);
    $result_pegawai = mysqli_query($koneksi, $query_pegawai);
    $result_kepsek = mysqli_query($koneksi, $query_kepsek);

    if (mysqli_num_rows($result_admin) > 0) {
        return "admin";
    } elseif (mysqli_num_rows($result_pegawai) > 0) {
        return "pegawai";
    } elseif (mysqli_num_rows($result_kepsek) > 0) {
        return "kepsek";
    } else {
        return "not_found";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan validasi data
    if (empty($username) && empty($password)) {
        echo "tidak_ada_data";
        exit();
    }
    if (empty($username)) {
        echo "username_tidak_ada";
        exit();
    }

    if (empty($password)) {
        echo "password_tidak_ada";
        exit();
    }


    $penggunahType = checkpenggunahType($username);
    if ($penggunahType !== "not_found") {
        $query_penggunah = "SELECT * FROM $penggunahType WHERE username = '$username'";
        $result_penggunah = mysqli_query($koneksi, $query_penggunah);

        if (mysqli_num_rows($result_penggunah) > 0) {
            $row = mysqli_fetch_assoc($result_penggunah);
            $hashed_password = $row['password'];

            if ($password === $hashed_password) {

                // Process login for other penggunah types
                session_start();
                $_SESSION['username'] = $username;

                switch ($penggunahType) {
                    case "admin":
                        $_SESSION['id_admin'] = $row['id_admin'];
                        break;
                    case "pegawai":
                        $_SESSION['id_pegawai'] = $row['id_pegawai'];
                        $id_pegawai = $row['id_pegawai'];
                        break;
                    case "kepsek":
                        $_SESSION['id_kepsek'] = $row['id_kepsek'];
                        break;
                    default:
                        break;
                }

                // Success response
                switch ($penggunahType) {
                    case "admin":
                        echo "success:" . $username . ":" . $penggunahType . ":" . "../pengguna/admin/";
                        break;
                    case "pegawai":
                        echo "success:" . $username . ":" . $penggunahType . ":" . "../pengguna/pegawai/";
                        break;
                    case "kepsek":
                        echo "success:" . $username . ":" . $penggunahType . ":" . "../pengguna/kepsek/";
                        break;
                    default:
                        echo "success:" . $username . ":" . $penggunahType . ":" . "../berlangganan/login";
                        break;
                }
            } else {
                echo "error_password";
            }
        } else {
            echo "error_username";
        }
    } else {
        echo "error_username";
    }
}
