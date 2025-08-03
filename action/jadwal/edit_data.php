<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $id = $_POST["id"];
  $mata_kuliah = $_POST['mata_kuliah'];
  $dosen = $_POST['dosen'];
  $ruang = $_POST['ruang'];
  $hari = $_POST['hari'];
  $jam_mulai = $_POST['jam_mulai'];
  $jam_selesai = $_POST['jam_selesai'];

  $query = "UPDATE jadwal SET
              id_mk = '$mata_kuliah',
              id_dosen = '$dosen',
              ruang = '$ruang',
              hari = '$hari',
              jam_mulai = '$jam_mulai',
              jam_selesai = '$jam_selesai'
            WHERE id = '$id'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Data jadwal perkuliahan berhasil diperbarui.'
    ];
  } else {
    $_SESSION['alert'] = [
      'type' => 'error',
      'message' => 'Gagal memperbarui data: ' . mysqli_error($conn)
    ];
  }

  header("Location: " . base_url("/page/jadwal/data_jadwal.php"));
  exit;
}
