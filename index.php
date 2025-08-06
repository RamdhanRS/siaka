<?php
session_start();
include_once __DIR__ . '/config/config.php';
if (isset($_SESSION["role"]) && !empty($_SESSION["role"])) {
  switch ($_SESSION['role']) {
    case 'admin':
      header('Location: ' . base_url("/page/dashboard/dashboard_admin.php"));
      exit;
    case 'dosen':
      header('Location: ' . base_url("/page/dashboard/dashboard_dosen.php"));
      exit;
    case 'mahasiswa':
      header('Location: ' . base_url("/page/dashboard/dashboard_mahasiswa.php"));
      exit;
    default:
      exit;
  }
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SIAKA - Login</title>
  <link rel="stylesheet" href="<?= base_url("/style/login.css"); ?>" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
  <div class="login-container">
    <div class="login-box">
      <h1 class="title">SIAKA</h1>
      <p class="subtitle">Sistem Informasi Akademik</p>
      <h2 class="welcome">Welcome back!</h2>

      <form class="login-form" action="<?= base_url("/action/login/login.php") ?>" method="post">
        <label>Username</label>
        <input type="text" name="username" id="username" required />

        <label>Password</label>
        <div class="password-wrapper">
          <input type="password" name="password" id="password" required />
          <button type="button" class="toggle-password" onclick="togglePassword()">
            <!-- Eye SVG icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
              <circle cx="12" cy="12" r="3" />
            </svg>
          </button>
        </div>

        <?php if (isset($_SESSION['alert'])): ?>
          <div class="alert alert-<?= $_SESSION['alert']['type'] ?>">
            <?= $_SESSION['alert']['message'] ?>
            <button class="close-alert" onclick="this.parentElement.style.display='none'">&times;</button>
          </div>
          <?php unset($_SESSION['alert']); ?>
        <?php endif; ?>

        <button type="submit" class="login-button">LOG IN</button>
      </form>
    </div>
  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById("password");
      const type = passwordInput.type === "password" ? "text" : "password";
      passwordInput.type = type;
    }
  </script>
</body>

</html>