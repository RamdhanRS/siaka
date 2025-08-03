<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $mata_kuliah = $_POST['mata_kuliah'];
  $dosen = $_POST['dosen'];
  $ruang = $_POST['ruang'];
  $hari = $_POST['hari'];
  $jam_mulai = $_POST['jam_mulai'];
  $jam_selesai = $_POST['jam_selesai'];

  $queryProdi = "INSERT INTO jadwal (id_mk, id_dosen, ruang, hari, jam_mulai, jam_selesai) 
                 VALUES ('$mata_kuliah', '$dosen', '$ruang', '$hari', '$jam_mulai', '$jam_selesai')";
  $resultProdi = mysqli_query($conn, $queryProdi);

  if ($resultProdi) {
    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Data jadwal perkuliahan berhasil ditambahkan.'
    ];
  } else {
    $_SESSION['alert'] = [
      'type' => 'error',
      'message' => 'Gagal menambahkan data jadwal perkuliahan: ' . mysqli_error($conn)
    ];
  }

  header("Location: " . base_url("/page/jadwal/data_jadwal.php"));
  exit;
}
