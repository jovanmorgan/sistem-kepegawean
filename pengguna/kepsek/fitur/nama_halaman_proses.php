<?php
// Dapatkan nama halaman dari URL saat ini tanpa ekstensi .php
$current_page_proses = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), ".php");

// Tentukan judul halaman berdasarkan nama file
switch ($current_page_proses) {
    case 'dashboard':
        $page_title_proses = 'dashboard';
        break;
    case 'cuti':
        $page_title_proses = 'cuti';
        break;
    case 'pegawai':
        $page_title_proses = 'pegawai';
        break;
    case 'kepsek':
        $page_title_proses = 'kepsek';
        break;
    case 'mutasi':
        $page_title_proses = 'mutasi';
        break;
    case 'gaji':
        $page_title_proses = 'gaji';
        break;
    case 'jabatan':
        $page_title_proses = 'jabatan';
        break;
    case 'pensiun':
        $page_title_proses = 'pensiun';
        break;
    case 'galeri':
        $page_title_proses = 'galeri';
        break;
    case 'lokasi':
        $page_title_proses = 'lokasi';
        break;
    case 'log_out':
        $page_title_proses = 'Log Out';
        break;
    default:
        $page_title_proses = 'Admin SMK 4 Atambua';
        break;
}
