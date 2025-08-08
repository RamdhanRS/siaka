<?php $page = "Dashboard"; ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>

<section id="Dahsboard">
  <div class="row">
    <div class="col-md-3 mb-4">
      <div class="dashboard-card card-blue">
        <div class="icon">
          <!-- Mahasiswa Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6" />
          </svg>
        </div>
        <div class="count">0</div>
        <div class="label">Total SKS</div>
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
        <div class="count">0</div>
        <div class="label">IP Semester Ini</div>
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
        <div class="count">0</div>
        <div class="label">IPK</div>
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
        <div class="count">0</div>
        <div class="label">Jadwal Hari Ini</div>
      </div>
    </div>
  </div>
</section>

<?php include("../../layout/scripts.php"); ?>
<?php include("../../layout/footer.php"); ?>