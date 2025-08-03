<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

$nim = isset($_GET['nim']) ? $_GET['nim'] : null;

if ($nim !== null) {
  $nimSafe = mysqli_real_escape_string($conn, $nim);

  // Ambil data mahasiswa dulu
  $query = "SELECT * FROM mahasiswa WHERE nim = '$nimSafe'";
  $sql = mysqli_query($conn, $query);
  $data = mysqli_fetch_object($sql);

  if (!$data) {
    $_SESSION['alert'] = [
      'type' => 'error',
      'message' => 'Data mahasiswa tidak ditemukan.'
    ];
    header("Location: " . base_url("/page/user/data_mahasiswa.php"));
    exit;
  }

  // Proses penghapusan
  $queryKrs = "DELETE FROM krs WHERE id_mahasiswa = '$data->id'";
  $queryMahasiswa = "DELETE FROM mahasiswa WHERE nim = '$nimSafe'";
  $queryUser = "DELETE FROM users WHERE username = '$nimSafe'";

  $sqlKrs = mysqli_query($conn, $queryKrs);
  $sqlMahasiswa = mysqli_query($conn, $queryMahasiswa);
  $sqlUser = mysqli_query($conn, $queryUser);

  if ($sqlKrs && $sqlMahasiswa && $sqlUser) {
    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Data mahasiswa berhasil dihapus.'
    ];
  } else {
    $_SESSION['alert'] = [
      'type' => 'error',
      'message' => 'Gagal menghapus data. Mungkin data masih digunakan di tempat lain. (' . mysqli_error($conn) . ')'
    ];
  }

  header("Location: " . base_url("/page/user/data_mahasiswa.php"));
  exit;
} else {
  $_SESSION['alert'] = [
    'type' => 'error',
    'message' => 'NIM tidak ditemukan.'
  ];
  header("Location: " . base_url("/page/user/data_mahasiswa.php"));
  exit;
}
