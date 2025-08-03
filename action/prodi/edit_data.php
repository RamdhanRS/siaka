<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $id = $_POST["id"];
  $idFakultas = $_POST["fakultas"];
  $namaProdi = $_POST["nama_prodi"];
  $jenjang = $_POST["jenjang"];

  $query = "UPDATE prodi SET
              id_fakultas = '$idFakultas',
              nama_prodi = '$namaProdi',
              jenjang = '$jenjang'
            WHERE id = '$id'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Data program studi berhasil diperbarui.'
    ];
  } else {
    $_SESSION['alert'] = [
      'type' => 'error',
      'message' => 'Gagal memperbarui data: ' . mysqli_error($conn)
    ];
  }

  header("Location: " . base_url("/page/prodi/data_prodi.php"));
  exit;
}
