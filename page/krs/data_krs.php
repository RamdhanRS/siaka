<?php $page = "Data Kelola KRS"; ?>
<?php include("../../config/db.php"); ?>
<?php include("../../helper/function.php"); ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>

<section id="data-krs">
  <div class="row">
    <!-- <div class="col-md-12 mb-3">
      <a href="<?= base_url("/page/krs/tambah_krs.php") ?>" class="btn btn-info float-right">Tambah</a>
    </div> -->
    <?php if (isset($_SESSION['alert'])): ?>
      <div class="col-md-12">
        <div class="alert alert-<?= $_SESSION['alert']['type'] ?>">
          <?= $_SESSION['alert']['message'] ?>
          <button class="close-alert" onclick="this.parentElement.style.display='none'">&times;</button>
        </div>
      </div>
      <?php unset($_SESSION['alert']); ?>
    <?php endif; ?>
    <div class="col-md-12">
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Mahasiswa/i</th>
            <th>Mata Kuliah</th>
            <th>Jadwal</th>
            <th>Fakultas</th>
            <th>Tahun Akademik</th>
            <th>Status</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <?php
        $per_page = 10;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $start = ($page - 1) * $per_page;
        $no = $start + 1;;

        // Hitung total data
        $total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM krs");
        $total_data = mysqli_fetch_assoc($total_query)['total'];
        $total_pages = ceil($total_data / $per_page);

        // Ambil data sesuai page
        $query = "SELECT k.id, m.nim, m.nama_lengkap as nama_mahasiswa, f.nama_fakultas,
                    p.nama_prodi, p.jenjang, j.ruang, j.hari, j.jam_mulai, j.jam_selesai,
                    mk.kode_mk, mk.nama_mk, mk.sks, mk.semester, d.nidn, d.nama_lengkap as nama_dosen,
                    k.status, k.semester as tahun_semester, k.tahun_akademik 
                  FROM krs k
                  LEFT JOIN mahasiswa m ON m.id = k.id_mahasiswa
                  LEFT JOIN jadwal j ON j.id = k.id_jadwal
                  LEFT JOIN mata_kuliah mk ON mk.id = j.id_mk
                  LEFT JOIN dosen d ON d.id = j.id_dosen
                  LEFT JOIN prodi p ON p.id = mk.id_prodi
                  LEFT JOIN fakultas f ON f.id = p.id_fakultas
                  LIMIT $start, $per_page";
        $sql = mysqli_query($conn, $query);
        ?>
        <tbody id="krs-table-body">
          <?php if ($total_data > 0) { ?>
            <?php while ($data = mysqli_fetch_array($sql)) { ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $data["nim"] . " - " . $data["nama_mahasiswa"]; ?></td>
                <td>
                  <?= $data["kode_mk"] . " - " . $data["nama_mk"]; ?> <br>
                  <?= "Semester " . $data["semester"] . " | " . $data["sks"] . " SKS" ?>
                </td>
                <td>
                  Ruang <?= $data["ruang"]; ?> <br>
                  <?= $data["hari"] . ", " . date("H:i", strtotime($data["jam_mulai"])) . " - " . date("H:i", strtotime($data["jam_selesai"])); ?> <br>
                  Dosen: <?= $data["nama_dosen"]; ?>
                </td>
                <td>
                  <?= $data["nama_fakultas"]; ?> <br>
                  <?= $data["jenjang"]; ?> - <?= $data["nama_prodi"]; ?>
                </td>
                <td>
                  Semester <?= $data["tahun_semester"] % 2 == 0 ? "Genap" : "Ganjil"; ?> <br>
                  Tahun <?= $data["tahun_akademik"] ?>
                </td>
                <td>
                  <?php
                  $statusText = ucwords($data["status"]);
                  $badgeClass = "";

                  if ($data["status"] == "aktif") {
                    $badgeClass = "badge-success";
                  } elseif ($data["status"] == "nonaktif" || $data["status"] == "ditolak") {
                    $badgeClass = "badge-danger";
                  } elseif ($data["status"] == "pending") {
                    $badgeClass = "badge-warning";
                  } elseif ($data["status"] == "diproses") {
                    $badgeClass = "badge-info";
                  } else {
                    $badgeClass = "badge-info"; // default
                  }
                  ?>

                  <span class="badge <?= $badgeClass ?>"><?= $statusText ?></span>
                </td>
                <td class="text-center">
                  <?php if ($data["status"] == "pending") { ?>
                    <a href="<?= base_url("/action/krs/status_krs.php") . "?id=" . $data["id"] . "&status=ditolak"; ?>" class="btn btn-danger">Tolak</a>
                    <a href="<?= base_url("/action/krs/status_krs.php") . "?id=" . $data["id"] . "&status=disetujui"; ?>" class="btn btn-success">Setujui</a>
                  <?php } else { ?>
                    <button style="pointer-events: none;" disabled class="btn btn-info">Sudah di proses</button>
                  <?php } ?>
                </td>
              </tr>
            <?php } ?>
          <?php } else { ?>
            <tr>
              <td colspan="6" style="text-align: center;">Tidak ada data</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <div class="pagination">
        <div class="pagination">
          <?= renderPagination($page, $total_pages); ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include("../../layout/scripts.php"); ?>
<?php include("../../layout/footer.php"); ?>