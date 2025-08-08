<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$role = $_SESSION['role'] ?? null;
?>
<div class="container" id="container">
  <aside class="sidebar" id="sidebar">
    <ul class="menu">

      <!-- Menu Umum: Dashboard -->
      <li class="menu-item <?= strpos($currentPage, 'dashboard') !== false ? 'active' : '' ?>">
        <a href="<?= base_url('/page/dashboard/dashboard_' . $role . '.php') ?>">Dashboard</a>
      </li>

      <?php if ($role === 'admin'): ?>
        <!-- Kelola User -->
        <li class="menu-item has-submenu <?= preg_match('/(data|tambah|edit)_(admin|dosen|mahasiswa)\.php$/', $currentPage) ? 'open' : '' ?>">
          Kelola User <span class="arrow"></span>
        </li>
        <ul class="submenu <?= preg_match('/(data|tambah|edit)_(admin|dosen|mahasiswa)\.php$/', $currentPage) ? 'open' : '' ?>">
          <li class="<?= strpos($currentPage, 'data_admin') !== false ? 'active' : '' ?>">
            <a href="<?= base_url('/page/user/data_admin.php') ?>">Data Admin</a>
          </li>
          <li class="<?= strpos($currentPage, 'data_dosen') !== false ? 'active' : '' ?>">
            <a href="<?= base_url('/page/user/data_dosen.php') ?>">Data Dosen</a>
          </li>
          <li class="<?= strpos($currentPage, 'data_mahasiswa') !== false ? 'active' : '' ?>">
            <a href="<?= base_url('/page/user/data_mahasiswa.php') ?>">Data Mahasiswa</a>
          </li>
        </ul>

        <!-- Fakultas & Prodi -->
        <li class="menu-item has-submenu <?= preg_match('/_(fakultas|prodi)\.php$/', $currentPage) ? 'open' : '' ?>">
          Kelola Fakultas & Prodi <span class="arrow"></span>
        </li>
        <ul class="submenu <?= preg_match('/_(fakultas|prodi)\.php$/', $currentPage) ? 'open' : '' ?>">
          <li class="<?= strpos($currentPage, 'data_fakultas') !== false ? 'active' : '' ?>">
            <a href="<?= base_url('/page/fakultas/data_fakultas.php') ?>">Data Fakultas</a>
          </li>
          <li class="<?= strpos($currentPage, 'data_prodi') !== false ? 'active' : '' ?>">
            <a href="<?= base_url('/page/prodi/data_prodi.php') ?>">Data Program Studi</a>
          </li>
        </ul>

        <!-- Akademik -->
        <li class="menu-item <?= strpos($currentPage, 'mata_kuliah') !== false ? 'active' : '' ?>">
          <a href="<?= base_url('/page/matakuliah/data_mata_kuliah.php') ?>">Kelola Mata Kuliah</a>
        </li>
        <li class="menu-item <?= strpos($currentPage, 'jadwal') !== false ? 'active' : '' ?>">
          <a href="<?= base_url('/page/jadwal/data_jadwal.php') ?>">Kelola Jadwal</a>
        </li>
        <li class="menu-item <?= strpos($currentPage, 'krs') !== false ? 'active' : '' ?>">
          <a href="<?= base_url('/page/krs/data_krs.php') ?>">Kelola KRS</a>
        </li>
        <li class="menu-item <?= strpos($currentPage, 'khs') !== false ? 'active' : '' ?>">
          <a href="<?= base_url('/page/khs/data_khs.php') ?>">Kelola KHS</a>
        </li>

      <?php elseif ($role === 'dosen'): ?>
        <!-- Dosen -->
        <li class="menu-item <?= strpos($currentPage, 'jadwal') !== false ? 'active' : '' ?>">
          <a href="#">Jadwal Mengajar</a>
        </li>
        <li class="menu-item <?= strpos($currentPage, 'mata_kuliah') !== false ? 'active' : '' ?>">
          <a href="#">Mata Kuliah Diampu</a>
        </li>
        <li class="menu-item <?= strpos($currentPage, 'khs') !== false ? 'active' : '' ?>">
          <a href="#">Input Nilai Mahasiswa</a>
        </li>

      <?php elseif ($role === 'mahasiswa'): ?>
        <!-- Mahasiswa -->
        <li class="menu-item <?= strpos($currentPage, 'mata_kuliah') !== false ? 'active' : '' ?>">
          <a href="#">Daftar Mata Kuliah</a>
        </li>
        <li class="menu-item <?= strpos($currentPage, 'jadwal') !== false ? 'active' : '' ?>">
          <a href="#">Jadwal Kuliah</a>
        </li>
        <li class="menu-item <?= strpos($currentPage, 'krs') !== false ? 'active' : '' ?>">
          <a href="#">Isi KRS</a>
        </li>
        <li class="menu-item <?= strpos($currentPage, 'khs') !== false ? 'active' : '' ?>">
          <a href="#">Lihat KHS</a>
        </li>
      <?php endif; ?>
    </ul>
  </aside>

  <main class="content" id="mainContent">
    <div class="page-title">
      <h2><?= $page; ?></h2>
    </div>