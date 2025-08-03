<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id !== null) {
  $id_safe = mysqli_real_escape_string($conn, $id);

  try {
    $query = "DELETE FROM jadwal WHERE id = '$id_safe'";
    $sql = mysqli_query($conn, $query);

    if (!$sql) {
      throw new Exception(mysqli_error($conn));
    }

    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Data jadwal perkuliahan berhasil dihapus.'
    ];
  } catch (Exception $e) {
    if (strpos($e->getMessage(), 'a foreign key constraint fails') !== false) {
      $_SESSION['alert'] = [
        'type' => 'error',
        'message' => 'Data jadwal perkuliahan ini sedang digunakan (misalnya oleh krs) dan tidak dapat dihapus.'
      ];
    } else {
      $_SESSION['alert'] = [
        'type' => 'error',
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
      ];
    }
  }

  header("Location: " . base_url("/page/jadwal/data_jadwal.php"));
  exit;
} else {
  $_SESSION['alert'] = [
    'type' => 'error',
    'message' => 'Data tidak ditemukan.'
  ];
  header("Location: " . base_url("/page/jadwal/data_jadwal.php"));
  exit;
}
