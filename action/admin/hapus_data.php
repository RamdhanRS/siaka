<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id !== null) {
  $current_username = $_SESSION['username'];
  $id_safe = mysqli_real_escape_string($conn, $id);

  try {
    // select users by id
    $q_users = "SELECT * FROM users WHERE id = '$id_safe'";
    $sql_users = mysqli_query($conn, $q_users);
    $detail = mysqli_fetch_object($sql_users);

    // delete
    $query = "DELETE FROM users WHERE id = '$id_safe'";
    $sql = mysqli_query($conn, $query);

    if (!$sql) {
      throw new Exception(mysqli_error($conn));
    }

    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Data admin berhasil dihapus.'
    ];
  } catch (Exception $e) {
    $_SESSION['alert'] = [
      'type' => 'error',
      'message' => 'Terjadi kesalahan: ' . $e->getMessage()
    ];
  }

  if ($_SESSION["username"] == $detail->username) {
    return header("Location: " . base_url("/action/login/logout.php"));
  }

  header("Location: " . base_url("/page/user/data_admin.php"));
  exit;
} else {
  $_SESSION['alert'] = [
    'type' => 'error',
    'message' => 'Data tidak ditemukan.'
  ];
  header("Location: " . base_url("/page/user/data_admin.php"));
  exit;
}
