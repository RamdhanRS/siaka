<?php $page = "Data Prodi"; ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>
<?php include("../../config/db.php"); ?>

<section id="data-prodi">
  <div class="row">
    <div class="col-md-12 mb-3">
      <a href="<?= base_url("/page/prodi/tambah_prodi.php") ?>" class="btn btn-info float-right">Tambah</a>
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
            <th>Fakultas</th>
            <th>Program Studi</th>
            <th>Jenjang</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <?php
        $query = "SELECT p.*, f.nama_fakultas FROM prodi p JOIN fakultas f ON f.id = p.id_fakultas";
        $sql = mysqli_query($conn, $query);
        $count = mysqli_num_rows($sql);
        $no = 1;
        ?>
        <tbody id="prodi-table-body">
          <?php if ($count > 0) { ?>
            <?php while ($data = mysqli_fetch_array($sql)) { ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $data["nama_fakultas"]; ?></td>
                <td><?= $data["nama_prodi"]; ?></td>
                <td><?= $data["jenjang"]; ?></td>
                <td class="text-center">
                  <a href="<?= base_url("/page/prodi/edit_prodi.php") . "?id=" . $data["id"]; ?>" class="btn btn-warning">Edit</a>
                  <a href="<?= base_url("/action/prodi/hapus_data.php") . "?id=" . $data["id"]; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger">Hapus</a>
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