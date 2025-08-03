<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $id = $_POST["id"];
  $prodi = $_POST["prodi"];
  $kodeMk = $_POST["kode_mk"];
  $namaMk = $_POST["nama_mk"];
  $semester = $_POST["semester"];
  $sks = $_POST["sks"];

  $query = "UPDATE mata_kuliah SET
              id_prodi = '$prodi',
              kode_mk = '$kodeMk',
              nama_mk = '$namaMk',
              semester = '$semester',
              sks = '$sks'
            WHERE id = '$id'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Data mata kuliah berhasil diperbarui.'
    ];
  } else {
    $_SESSION['alert'] = [
      'type' => 'error',
      'message' => 'Gagal memperbarui data: ' . mysqli_error($conn)
    ];
  }

  header("Location: " . base_url("/page/matakuliah/data_mata_kuliah.php"));
  exit;
}
