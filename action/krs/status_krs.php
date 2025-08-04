<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

$id = isset($_GET['id']) ? $_GET['id'] : null;
$status = isset($_GET['status']) ? $_GET['status'] : null;

if ($id !== null && $status !== null) {
  $id_safe = mysqli_real_escape_string($conn, $id);
  $status_safe = mysqli_real_escape_string($conn, $status);

  try {
    $query = "UPDATE krs SET status = '$status_safe' WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
      $_SESSION['alert'] = [
        'type' => 'success',
        'message' => 'Data krs berhasil diperbarui.'
      ];
    } else {
      $_SESSION['alert'] = [
        'type' => 'error',
        'message' => 'Gagal memperbarui data: ' . mysqli_error($conn)
      ];
    }
  } catch (Exception $e) {
    $_SESSION['alert'] = [
      'type' => 'error',
      'message' => 'Terjadi kesalahan: ' . $e->getMessage()
    ];
  }

  header("Location: " . base_url("/page/krs/data_krs.php"));
  exit;
} else {
  $_SESSION['alert'] = [
    'type' => 'error',
    'message' => 'id atau status tidak ditemukan.'
  ];
  header("Location: " . base_url("/page/krs/data_krs.php"));
  exit;
}
