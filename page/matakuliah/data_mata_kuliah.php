<?php $page = "Data Matakuliah"; ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>
<?php include("../../config/db.php"); ?>

<section id="data-matakuliah">
  <div class="row">
    <div class="col-md-12 mb-3">
      <a href="<?= base_url("/page/matakuliah/tambah_mata_kuliah.php") ?>" class="btn btn-info float-right">Tambah</a>
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
            <th>Kode</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Semester</th>
            <th>Program Studi</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <?php
        $query = "SELECT m.*, p.nama_prodi, p.jenjang, f.nama_fakultas FROM mata_kuliah m JOIN prodi p ON p.id = m.id_prodi JOIN fakultas f ON f.id = p.id_fakultas";
        $sql = mysqli_query($conn, $query);
        $count = mysqli_num_rows($sql);
        $no = 1;
        ?>
        <tbody id="matakuliah-table-body">
          <?php if ($count > 0) { ?>
            <?php while ($data = mysqli_fetch_array($sql)) { ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $data["kode_mk"]; ?></td>
                <td><?= $data["nama_mk"]; ?></td>
                <td><?= $data["sks"]; ?></td>
                <td><?= $data["semester"]; ?></td>
                <td>
                  <?= $data["nama_fakultas"]; ?> <br>
                  <?= $data["jenjang"]; ?> - <?= $data["nama_prodi"]; ?>
                </td>
                <td class="text-center">
                  <a href="<?= base_url("/page/matakuliah/edit_mata_kuliah.php") . "?id=" . $data["id"]; ?>" class="btn btn-warning">Edit</a>
                  <a href="<?= base_url("/action/matakuliah/hapus_data.php") . "?id=" . $data["id"]; ?>" class="btn btn-danger">Hapus</a>
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