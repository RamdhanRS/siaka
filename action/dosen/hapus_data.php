<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

$nidn = isset($_GET['nidn']) ? $_GET['nidn'] : null;

if ($nidn !== null) {
  $nidn_safe = mysqli_real_escape_string($conn, $nidn);

  try {
    // Hapus dari tabel dosen
    $queryDosen = "DELETE FROM dosen WHERE nidn = '$nidn_safe'";
    $sqlDosen = mysqli_query($conn, $queryDosen);

    // Hapus dari tabel users
    $queryUser = "DELETE FROM users WHERE username = '$nidn_safe'";
    $sqlUser = mysqli_query($conn, $queryUser);

    if ($sqlDosen && $sqlUser) {
      $_SESSION['alert'] = [
        'type' => 'success',
        'message' => 'Data dosen berhasil dihapus.'
      ];
    } else {
      throw new Exception(mysqli_error($conn));
    }
  } catch (Exception $e) {
    if (strpos($e->getMessage(), 'a foreign key constraint fails') !== false) {
      $_SESSION['alert'] = [
        'type' => 'error',
        'message' => 'Data dosen sedang digunakan dalam jadwal atau data lain dan tidak dapat dihapus.'
      ];
    } else {
      $_SESSION['alert'] = [
        'type' => 'error',
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
      ];
    }
  }

  header("Location: " . base_url("/page/user/data_dosen.php"));
  exit;
} else {
  $_SESSION['alert'] = [
    'type' => 'error',
    'message' => 'NIDN tidak ditemukan.'
  ];
  header("Location: " . base_url("/page/user/data_dosen.php"));
  exit;
}
