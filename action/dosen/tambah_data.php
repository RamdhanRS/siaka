<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $nidn = $_POST["nidn"];
  $namaLengkap = $_POST["nama_lengkap"];
  $tglLahir = $_POST["tgl_lahir"];
  $noTelp = $_POST["no_telp"];
  $email = $_POST["email"];
  $alamat = $_POST["alamat"];

  $dateNow = date("Y-m-d H:i:s");
  $hashedPassword = password_hash($nidn, PASSWORD_DEFAULT);

  // Insert ke tabel users
  $queryUser = "INSERT INTO users (username, password, email, role, created_at) 
                VALUES ('$nidn', '$hashedPassword', '$email', 'dosen', '$dateNow')";
  $resultUser = mysqli_query($conn, $queryUser);

  if ($resultUser) {
    $userId = mysqli_insert_id($conn);

    // Insert ke tabel dosen
    $queryDosen = "INSERT INTO dosen (user_id, nidn, nama_lengkap, tgl_lahir, no_telp, alamat) 
                   VALUES ('$userId', '$nidn', '$namaLengkap', '$tglLahir', '$noTelp', '$alamat')";
    $resultDosen = mysqli_query($conn, $queryDosen);

    if ($resultDosen) {
      $_SESSION['alert'] = [
        'type' => 'success',
        'message' => 'Data dosen berhasil ditambahkan.'
      ];
    } else {
      $_SESSION['alert'] = [
        'type' => 'error',
        'message' => 'Gagal menambahkan data dosen: ' . mysqli_error($conn)
      ];
    }
  } else {
    $_SESSION['alert'] = [
      'type' => 'error',
      'message' => 'Gagal menambahkan user: ' . mysqli_error($conn)
    ];
  }

  header("Location: " . base_url("/page/user/data_dosen.php"));
  exit;
}
