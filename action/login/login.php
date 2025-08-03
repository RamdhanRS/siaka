<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
  $result = mysqli_query($conn, $query);

  if ($user = mysqli_fetch_assoc($result)) {
    if (password_verify($password, $user['password'])) {
      // Login sukses, buat session
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['role'] = $user['role'];

      // Redirect berdasarkan role
      switch ($user['role']) {
        case 'admin':
          header('Location: ' . base_url("/page/dashboard/dashboard_admin.php"));
          break;
        case 'dosen':
          header('Location: ' . base_url("/page/dashboard/dashboard_dosen.php"));
          break;
        case 'mahasiswa':
          header('Location: ' . base_url("/page/dashboard/dashboard_mahasiswa.php"));
          break;
        default:
          $_SESSION['alert'] = [
            'type' => 'error',
            'message' => 'Role tidak dikenali.'
          ];
          header('Location: ' . base_url("/index.php"));
      }
      exit;
    } else {
      $_SESSION['alert'] = [
        'type' => 'error',
        'message' => 'Password salah.'
      ];
      header('Location: ' . base_url("/index.php"));
      exit;
    }
  } else {
    $_SESSION['alert'] = [
      'type' => 'error',
      'message' => 'Username tidak ditemukan.'
    ];
    header('Location: ' . base_url("/index.php"));
    exit;
  }
}
