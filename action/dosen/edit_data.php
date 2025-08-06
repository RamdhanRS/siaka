<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $id = $_POST["id"];
  $userId = $_POST["user_id"];
  $namaLengkap = $_POST["nama_lengkap"];
  $tglLahir = $_POST["tgl_lahir"];
  $noTelp = $_POST["no_telp"];
  $email = $_POST["email"];
  $alamat = $_POST["alamat"];

  try {
    // Update tabel users
    $queryUser = "UPDATE users SET email = '$email' WHERE id = '$userId'";
    $resultUser = mysqli_query($conn, $queryUser);

    if (!$resultUser) {
      throw new Exception("Gagal update users: " . mysqli_error($conn));
    }

    // Update tabel dosen
    $queryDosen = "UPDATE dosen SET 
                      nama_lengkap = '$namaLengkap', 
                      tgl_lahir = '$tglLahir', 
                      no_telp = '$noTelp', 
                      alamat = '$alamat' 
                      WHERE id = '$id'";
    $resultDosen = mysqli_query($conn, $queryDosen);

    if (!$resultDosen) {
      throw new Exception("Gagal update dosen: " . mysqli_error($conn));
    }

    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Data dosen berhasil diperbarui.'
    ];
  } catch (Exception $e) {
    $_SESSION['alert'] = [
      'type' => 'error',
      'message' => $e->getMessage()
    ];
  }

  header("Location: " . base_url("/page/user/data_dosen.php"));
  exit;
}
