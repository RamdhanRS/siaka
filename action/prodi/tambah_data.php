<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $idFakultas = $_POST["fakultas"];
  $namaProdi = $_POST["nama_prodi"];
  $jenjang = $_POST["jenjang"];

  $queryProdi = "INSERT INTO prodi (id_fakultas, nama_prodi, jenjang) 
                 VALUES ('$idFakultas', '$namaProdi', '$jenjang')";
  $resultProdi = mysqli_query($conn, $queryProdi);

  if ($resultProdi) {
    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Data program studi berhasil ditambahkan.'
    ];
  } else {
    $_SESSION['alert'] = [
      'type' => 'error',
      'message' => 'Gagal menambahkan data program studi: ' . mysqli_error($conn)
    ];
  }

  header("Location: " . base_url("/page/prodi/data_prodi.php"));
  exit;
}
