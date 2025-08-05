<?php $page = "Dashboard"; ?>
<?php include("../../config/db.php"); ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>

<?php if (isset($_SESSION['alert'])): ?>
  <div class="col-md-12">
    <div class="alert alert-<?= $_SESSION['alert']['type'] ?>">
      <?= $_SESSION['alert']['message'] ?>
      <button class="close-alert" onclick="this.parentElement.style.display='none'">&times;</button>
    </div>
  </div>
  <?php unset($_SESSION['alert']); ?>
<?php endif; ?>

<?php
$q_count = "SELECT (SELECT COUNT(*) FROM mahasiswa) AS total_mahasiswa, (SELECT COUNT(*) FROM dosen) AS total_dosen, (SELECT COUNT(*) FROM fakultas) AS total_fakultas, (SELECT COUNT(*) FROM prodi) AS total_prodi";
$sql = mysqli_query($conn, $q_count);
$data = mysqli_fetch_object($sql);
?>

<section id="dashboard">
  <div class="row">
    <div class="col-md-3 mb-4">
      <div class="dashboard-card card-blue">
        <div class="icon">
          <!-- Mahasiswa Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6" />
          </svg>
        </div>
        <div class="count"><?= $data->total_mahasiswa; ?></div>
        <div class="label">Mahasiswa</div>
      </div>
    </div>

    <div class="col-md-3 mb-4">
      <div class="dashboard-card card-green">
        <div class="icon">
          <!-- Dosen Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        </div>
        <div class="count"><?= $data->total_dosen; ?></div>
        <div class="label">Dosen</div>
      </div>
    </div>

    <div class="col-md-3 mb-4">
      <div class="dashboard-card card-orange">
        <div class="icon">
          <!-- Mata Kuliah Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8M8 12h8M8 8h8M4 6h16v12H4z" />
          </svg>
        </div>
        <div class="count"><?= $data->total_fakultas; ?></div>
        <div class="label">Fakultas</div>
      </div>
    </div>

    <div class="col-md-3 mb-4">
      <div class="dashboard-card card-red">
        <div class="icon">
          <!-- Kelas Aktif Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h4" />
          </svg>
        </div>
        <div class="count"><?= $data->total_prodi; ?></div>
        <div class="label">Prodi</div>
      </div>
    </div>
  </div>
</section>

<!-- <div class="tabs" role="tablist">
  <div class="tab active" data-tab="dosen" role="tab" tabindex="0" aria-selected="true" aria-controls="dosen-content" id="tab-dosen" title="Data Dosen">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
      <path fill="#888" d="M17 10h-1V6a5 5 0 1 0-10 0v4H5a3 3 0 0 0-3 3v3h18v-3a3 3 0 0 0-3-3ZM7 6a3 3 0 0 1 6 0v4H7Zm11 10H6v-2a2 2 0 0 1 4 0v2h4v-2a2 2 0 0 1 4 0Zm-6 5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
    </svg>
    Dosen
  </div>
  <div class="tab" data-tab="mahasiswa" role="tab" tabindex="-1" aria-selected="false" aria-controls="mahasiswa-content" id="tab-mahasiswa" title="Data Mahasiswa">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
      <path fill="#888" d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5Zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5Z" />
    </svg>
    Mahasiswa
  </div>
</div>

<section id="dosen-content">
  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 10px;">
    <strong>Data Dosen</strong>
    <div class="btn btn-info" id="btnTambahDosen">Tambah Data</div>
  </div>
  <table>
    <thead>
      <tr>
        <th>NO</th>
        <th>NAMA</th>
        <th>NIM</th>
        <th>PROGRAM STUDI</th>
        <th>AKSI</th>
      </tr>
    </thead>
    <tbody id="dosen-table-body">
      <tr>
        <td>1</td>
        <td>Paramitha K</td>
        <td>20230018</td>
        <td>Teknik Informatika</td>
        <td>
          <button class="btn btn-warning">Edit</button>
          <button class="btn btn-danger">Hapus</button>
        </td>
      </tr>
      <tr>
        <td>2</td>
        <td>Desi Ratna Sari</td>
        <td>20180022</td>
        <td>Teknik Informatika</td>
        <td>
          <button class="btn btn-warning">Edit</button>
          <button class="btn btn-danger">Hapus</button>
        </td>
      </tr>
    </tbody>
  </table>
</section>

<section id="mahasiswa-content" style="display:none;">
  <div><strong>Data Mahasiswa</strong></div>
  <p>Daftar mahasiswa akan ditampilkan di sini...</p>
</section> -->

<?php include("../../layout/scripts.php"); ?>
<?php include("../../layout/footer.php"); ?>