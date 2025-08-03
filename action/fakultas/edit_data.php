<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $id = $_POST["id"];
  $nama_fakultas = $_POST["nama_fakultas"];

  $query = "UPDATE fakultas SET nama_fakultas = '$nama_fakultas' WHERE id = '$id'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Data fakultas berhasil diperbarui.'
    ];
  } else {
    $_SESSION['alert'] = [
      'type' => 'error',
      'message' => 'Gagal memperbarui data fakultas: ' . mysqli_error($conn)
    ];
  }

  header("Location: " . base_url("/page/fakultas/data_fakultas.php"));
  exit;
}
