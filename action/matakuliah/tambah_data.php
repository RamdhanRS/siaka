<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $prodi = $_POST["prodi"];
  $kodeMk = $_POST["kode_mk"];
  $namaMk = $_POST["nama_mk"];
  $semester = $_POST["semester"];
  $sks = $_POST["sks"];

  $query = "INSERT INTO mata_kuliah (kode_mk, nama_mk, sks, semester, id_prodi) 
            VALUES ('$kodeMk', '$namaMk', '$sks', '$semester', '$prodi')";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Data mata kuliah berhasil ditambahkan.'
    ];
  } else {
    $_SESSION['alert'] = [
      'type' => 'error',
      'message' => 'Gagal menambahkan data: ' . mysqli_error($conn)
    ];
  }

  header("Location: " . base_url("/page/matakuliah/data_mata_kuliah.php"));
  exit;
}
