<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<div class="container" id="container">
  <aside class="sidebar" id="sidebar">
    <ul class="menu">

      <!-- Dashboard -->
      <li class="menu-item <?= strpos($currentPage, 'dashboard') !== false ? 'active' : '' ?>">
        <a href="<?= base_url('/page/dashboard/dashboard_admin.php') ?>">Dashboard</a>
      </li>

      <!-- Kelola User -->
      <li class="menu-item has-submenu <?= preg_match('/data_(admin|dosen|mahasiswa)\.php$/', $currentPage) ? 'open' : '' ?>">
        Kelola User <span class="arrow"></span>
      </li>
      <ul class="submenu <?= preg_match('/data_(admin|dosen|mahasiswa)\.php$/', $currentPage) ? 'open' : '' ?>">
        <li class="<?= strpos($currentPage, 'data_admin') !== false ? 'active' : '' ?>">
          <a href="<?= base_url('/page/user/data_admin.php') ?>">Data Admin</a>
        </li>
        <li class="<?= strpos($currentPage, 'data_dosen') !== false || strpos($currentPage, 'tambah_dosen') !== false || strpos($currentPage, 'edit_dosen') !== false ? 'active' : '' ?>">
          <a href="<?= base_url('/page/user/data_dosen.php') ?>">Data Dosen</a>
        </li>
        <li class="<?= strpos($currentPage, 'data_mahasiswa') !== false || strpos($currentPage, 'tambah_mahasiswa') !== false || strpos($currentPage, 'edit_mahasiswa') !== false ? 'active' : '' ?>">
          <a href="<?= base_url('/page/user/data_mahasiswa.php') ?>">Data Mahasiswa</a>
        </li>
      </ul>

      <!-- Kelola Fakultas & Prodi -->
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

      <!-- Menu Lain -->
      <li class="menu-item <?= strpos($currentPage, 'mata_kuliah') !== false ? 'active' : '' ?>">
        <a href="<?= base_url('/page/matakuliah/data_mata_kuliah.php') ?>">Kelola Mata Kuliah</a>
      </li>
      <li class="menu-item <?= strpos($currentPage, 'jadwal') !== false ? 'active' : '' ?>">
        <a href="<?= base_url('/page/jadwal/data_jadwal.php') ?>">Kelola Jadwal Perkuliahan</a>
      </li>
      <li class="menu-item <?= strpos($currentPage, 'krs') !== false ? 'active' : '' ?>">
        <a href="<?= base_url('/page/krs/data_krs.php') ?>">Kelola KRS</a>
      </li>
      <li class="menu-item <?= strpos($currentPage, 'khs') !== false ? 'active' : '' ?>">
        <a href="<?= base_url('/page/khs/data_khs.php') ?>">Kelola KHS</a>
      </li>
    </ul>
  </aside>

  <main class="content" id="mainContent">
    <div class="page-title">
      <h2><?= $page; ?></h2>
    </div>