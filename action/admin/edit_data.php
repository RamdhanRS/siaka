<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $id = $_POST["id"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $current_passowrd = $_POST["current_password"];
  $password = isset($_POST['password']) ? password_hash($_POST["password"], PASSWORD_DEFAULT) : null;

  $password = $password != null ? $password : $current_passowrd;

  try {
    // select users by id
    $q_users = "SELECT * FROM users WHERE id = '$id'";
    $sql_users = mysqli_query($conn, $q_users);
    $detail = mysqli_fetch_object($sql_users);

    // Update tabel users
    $queryUser = "UPDATE users SET username = '$username', email = '$email', password = '$password' WHERE id = '$id'";
    $resultUser = mysqli_query($conn, $queryUser);

    if (!$resultUser) {
      throw new Exception("Gagal update users: " . mysqli_error($conn));
    }

    if ($_SESSION["username"] == $detail->username) {
      return header("Location: " . base_url("/action/login/logout.php"));
    }

    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Data admin berhasil diperbarui.'
    ];
  } catch (Exception $e) {
    $_SESSION['alert'] = [
      'type' => 'error',
      'message' => $e->getMessage()
    ];
  }

  header("Location: " . base_url("/page/user/data_admin.php"));
  exit;
}
