<?php $page = "Data Mahasiswa"; ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>
<?php include("../../config/db.php"); ?>

<section id="data-mahasiswa">
  <div class="row">
    <!-- <div class="col-md-12 mb-3">
      <a href="<?= base_url("/page/user/tambah_mahasiswa.php") ?>" class="btn btn-info float-right">Tambah</a>
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
            <th>NPM</th>
            <th>Nama</th>
            <th>No Hp</th>
            <th>Jenis Kelamin</th>
            <th>Program Studi</th>
            <th>Angkatan</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <?php
        $query = "SELECT m.*, p.nama_prodi, p.jenjang, f.nama_fakultas FROM mahasiswa m JOIN prodi p ON p.id = m.id_prodi JOIN fakultas f ON f.id = p.id_fakultas";
        $sql = mysqli_query($conn, $query);
        $count = mysqli_num_rows($sql);
        $no = 1;
        ?>
        <tbody id="mahasiswa-table-body">
          <?php if ($count > 0) { ?>
            <?php while ($data = mysqli_fetch_array($sql)) { ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $data["nim"]; ?></td>
                <td><?= $data["nama_lengkap"]; ?></td>
                <td><?= $data["no_telp"]; ?></td>
                <td><?= $data["jenis_kelamin"]; ?></td>
                <td>
                  <?= $data["nama_fakultas"]; ?> <br>
                  <?= $data["jenjang"]; ?> - <?= $data["nama_prodi"]; ?>
                </td>
                <td><?= $data["angkatan"]; ?></td>
                <td class="text-center">
                  <a href="<?= base_url("/page/user/edit_mahasiswa.php") . "?nim=" . $data["nim"]; ?>" class="btn btn-warning">Edit</a>
                  <a href="<?= base_url("/action/mahasiswa/hapus_data.php") . "?nim=" . $data["nim"]; ?>" class="btn btn-danger">Hapus</a>
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