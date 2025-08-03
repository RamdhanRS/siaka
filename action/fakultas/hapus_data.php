<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id !== null) {
  $id_safe = mysqli_real_escape_string($conn, $id);

  try {
    $query = "DELETE FROM fakultas WHERE id = '$id_safe'";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
      $_SESSION['alert'] = [
        'type' => 'success',
        'message' => 'Data fakultas berhasil dihapus.'
      ];
    } else {
      throw new Exception(mysqli_error($conn));
    }
  } catch (Exception $e) {
    if (strpos($e->getMessage(), 'foreign key constraint fails') !== false) {
      $_SESSION['alert'] = [
        'type' => 'error',
        'message' => 'Data fakultas ini sedang digunakan di tabel lain dan tidak dapat dihapus.'
      ];
    } else {
      $_SESSION['alert'] = [
        'type' => 'error',
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
      ];
    }
  }

  header("Location: " . base_url("/page/fakultas/data_fakultas.php"));
  exit;
} else {
  $_SESSION['alert'] = [
    'type' => 'error',
    'message' => 'Data tidak ditemukan.'
  ];
  header("Location: " . base_url("/page/fakultas/data_fakultas.php"));
  exit;
}
