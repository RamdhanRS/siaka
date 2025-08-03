<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $namaFakultas = mysqli_real_escape_string($conn, $_POST["nama_fakultas"]);

  $queryFakultas = "INSERT INTO fakultas (nama_fakultas) VALUES ('$namaFakultas')";
  $resultFakultas = mysqli_query($conn, $queryFakultas);

  if ($resultFakultas) {
    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Data fakultas berhasil ditambahkan.'
    ];
  } else {
    $_SESSION['alert'] = [
      'type' => 'error',
      'message' => 'Gagal menambahkan data fakultas: ' . mysqli_error($conn)
    ];
  }

  header("Location: " . base_url("/page/fakultas/data_fakultas.php"));
  exit;
}
