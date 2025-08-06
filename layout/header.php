<?php include_once __DIR__ . '/../config/config.php'; ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  $_SESSION['alert'] = [
    'type' => 'error',
    'message' => 'Harap login dahulu!'
  ];
  header('Location: ' . base_url("/"));
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Data Dosen - SIAKA</title>
  <link rel="stylesheet" href="<?= base_url('/style/style.css') ?>">
</head>

<body>