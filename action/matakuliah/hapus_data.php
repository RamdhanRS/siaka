<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id !== null) {
  $idSafe = mysqli_real_escape_string($conn, $id);

  try {
    $query = "DELETE FROM mata_kuliah WHERE id = '$idSafe'";
    $result = mysqli_query($conn, $query);

    if ($result) {
      $_SESSION['alert'] = [
        'type' => 'success',
        'message' => 'Data mata kuliah berhasil dihapus.'
      ];
    } else {
      throw new Exception(mysqli_error($conn));
    }
  } catch (Exception $e) {
    if (strpos($e->getMessage(), 'a foreign key constraint fails') !== false) {
      $_SESSION['alert'] = [
        'type' => 'error',
        'message' => 'Data mata kuliah sedang digunakan dalam jadwal dan tidak dapat dihapus.'
      ];
    } else {
      $_SESSION['alerwt'] = [
        'type' => 'error',
        'message' => 'Terjadi kesalahan saat menghapus: ' . $e->getMessage()
      ];
    }
  }
} else {
  $_SESSION['alert'] = [
    'type' => 'error',
    'message' => 'Data tidak ditemukan.'
  ];
}

header("Location: " . base_url("/page/matakuliah/data_mata_kuliah.php"));
exit;
