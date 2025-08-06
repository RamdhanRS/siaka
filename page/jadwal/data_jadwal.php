<?php $page = "Data Jadwal Perkuliahan"; ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>
<?php include("../../config/db.php"); ?>

<section id="data-jadwal">
  <div class="row">
    <div class="col-md-12 mb-3">
      <a href="<?= base_url("/page/jadwal/tambah_jadwal.php") ?>" class="btn btn-info float-right">Tambah</a>
    </div>
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
            <th>Mata Kuliah</th>
            <th>Dosen Pengampu</th>
            <th>Ruang</th>
            <th>Jadwal</th>
            <th>Program Studi</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <?php
        $query = "SELECT j.*, m.kode_mk, m.nama_mk, d.nidn, d.nama_lengkap as nama_dosen, p.nama_prodi, p.jenjang, f.nama_fakultas FROM jadwal j 
                    JOIN mata_kuliah m ON m.id = j.id_mk 
                    JOIN dosen d ON d.id = j.id_dosen 
                    JOIN prodi p ON m.id_prodi = p.id 
                    JOIN fakultas f ON f.id = p.id_fakultas";
        $sql = mysqli_query($conn, $query);
        $count = mysqli_num_rows($sql);
        $no = 1;
        ?>
        <tbody id="jadwal-table-body">
          <?php if ($count > 0) { ?>
            <?php while ($data = mysqli_fetch_array($sql)) { ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $data["kode_mk"] . " - " . $data["nama_mk"]; ?></td>
                <td><?= $data["nama_dosen"]; ?></td>
                <td><?= $data["ruang"]; ?></td>
                <td><?= $data["hari"] . ", " . $data["jam_mulai"] . " s/d " . $data["jam_selesai"]; ?></td>
                <td>
                  <?= $data["nama_fakultas"]; ?> <br>
                  <?= $data["jenjang"]; ?> - <?= $data["nama_prodi"]; ?>
                </td>
                <td class="text-center">
                  <a href="<?= base_url("/page/jadwal/edit_jadwal.php") . "?id=" . $data["id"]; ?>" class="btn btn-warning">Edit</a>
                  <a href="<?= base_url("/action/jadwal/hapus_data.php") . "?id=" . $data["id"]; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger">Hapus</a>
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
    </div>
  </div>
</section>

<?php include("../../layout/scripts.php"); ?>
<?php include("../../layout/footer.php"); ?>