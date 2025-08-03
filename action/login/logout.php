<?php
include_once __DIR__ . '/../../config/config.php';

session_start();
session_unset();
session_destroy();

$_SESSION['alert'] = [
  'type' => 'success',
  'message' => 'Anda telah berhasil logout.'
];

header('Location: ' . base_url("/index.php"));
exit;
