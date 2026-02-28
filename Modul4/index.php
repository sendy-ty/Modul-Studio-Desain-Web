<?php
session_start();

// Autoload class
spl_autoload_register(function($class_name) {
  include $class_name . '.php';
});

$view = new MyView();

// Inisialisasi data awal
if (!isset($_SESSION['mahasiswa'])) {
  $_SESSION['mahasiswa'] = [
    ['nim' => '101', 'nama' => 'Suli', 'jurusan' => 'Informatika'],
    ['nim' => '102', 'nama' => 'Zulkifli', 'jurusan' => 'Sistem Informasi'],
    ['nim' => '103', 'nama' => 'Sholeh', 'jurusan' => 'Teknik Komputer']
  ];
}

// Routing
$page = $_GET['page'] ?? 'home';

// Proses tambah data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $nim = trim($_POST['nim'] ?? '');
  $nama = trim($_POST['nama'] ?? '');
  $jurusan = trim($_POST['jurusan'] ?? '');

  if ($nim && $nama && $jurusan) {
    $_SESSION['mahasiswa'][] = [
      'nim' => $nim,
      'nama' => $nama,
      'jurusan' => $jurusan
    ];
    $_SESSION['message'] = "Data berhasil ditambahkan!";
  } else {
    $_SESSION['message'] = "Semua field wajib diisi!";
  }

  header("Location: ?page=mahasiswa");
  exit;
}

// Proses hapus data
if (isset($_GET['hapus'])) {
  $index = (int) $_GET['hapus'];

  if (isset($_SESSION['mahasiswa'][$index])) {
    unset($_SESSION['mahasiswa'][$index]);
    $_SESSION['mahasiswa'] = array_values($_SESSION['mahasiswa']);
    $_SESSION['message'] = "Data berhasil dihapus!";
  }

  header("Location: ?page=mahasiswa");
  exit;
}

// Routing halaman
switch ($page) {

  case 'mahasiswa':
    $view->mahasiswa = $_SESSION['mahasiswa'];
    $view->message = $_SESSION['message'] ?? null;
    unset($_SESSION['message']);
    $view->render('mahasiswa.php');
    break;

  case 'tambah':
    $view->render('tambah.php');
    break;

  default:
    $view->render('home.php');
}
