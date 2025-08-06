<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  $dateNow = date("Y-m-d H:i:s");
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Insert ke tabel users
  $queryUser = "INSERT INTO users (username, password, email, role, created_at) 
                VALUES ('$username', '$hashedPassword', '$email', 'admin', '$dateNow')";
  $resultUser = mysqli_query($conn, $queryUser);

  if ($resultUser) {
    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Data admin berhasil ditambahkan.'
    ];
  } else {
    $_SESSION['alert'] = [
      'type' => 'error',
      'message' => 'Gagal menambahkan user: ' . mysqli_error($conn)
    ];
  }

  header("Location: " . base_url("/page/user/data_admin.php"));
  exit;
}
