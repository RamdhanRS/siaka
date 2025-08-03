<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $id = $_POST["id"];
  $userId = $_POST["user_id"];
  $nim = $_POST["nim"];
  $namaLengkap = $_POST["nama_lengkap"];
  $jenisKelamin = $_POST["jenis_kelamin"];
  $tanggalLahir = $_POST["tgl_lahir"];
  $email = $_POST["email"];
  $noTelp = $_POST["no_telp"];
  $programStudi = $_POST["program_studi"];
  $angkatan = $_POST["angkatan"];
  $alamat = $_POST["alamat"];

  // Update ke users
  $queryUser = "UPDATE users SET email = '$email' WHERE id = '$userId'";
  $resultUser = mysqli_query($conn, $queryUser);

  if ($resultUser) {
    // Update ke mahasiswa
    $queryMahasiswa = "UPDATE mahasiswa SET 
        nama_lengkap = '$namaLengkap', 
        jenis_kelamin = '$jenisKelamin', 
        tanggal_lahir = '$tanggalLahir', 
        no_telp = '$noTelp', 
        alamat = '$alamat',
        id_prodi = '$programStudi',
        angkatan = '$angkatan' 
        WHERE id = '$id'";
    $resultMahasiswa = mysqli_query($conn, $queryMahasiswa);

    if ($resultMahasiswa) {
      $_SESSION['alert'] = [
        'type' => 'success',
        'message' => 'Data mahasiswa berhasil diperbarui.'
      ];
    } else {
      $_SESSION['alert'] = [
        'type' => 'error',
        'message' => 'Gagal memperbarui data mahasiswa: ' . mysqli_error($conn)
      ];
    }
  } else {
    $_SESSION['alert'] = [
      'type' => 'error',
      'message' => 'Gagal memperbarui data user: ' . mysqli_error($conn)
    ];
  }

  header("Location: " . base_url("/page/user/data_mahasiswa.php"));
  exit;
}
