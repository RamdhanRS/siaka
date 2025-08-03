<?php $page = "Edit Mahasiswa"; ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>
<?php include("../../config/db.php"); ?>

<?php
$nim = isset($_GET['nim']) ? $_GET['nim'] : null;
$query = "SELECT m.*, u.email FROM mahasiswa m LEFT JOIN users u ON u.id = m.user_id WHERE nim = '$nim'";
$sql = mysqli_query($conn, $query);
$data = mysqli_fetch_object($sql);

$query_prodi = "SELECT * FROM prodi";
$sql_prodi = mysqli_query($conn, $query_prodi);
?>

<section id="edit_mahasiswa">
  <div class="row">
    <div class="col-md-12">
      <form class="form-container" action="<?= base_url("/action/mahasiswa/edit_data.php"); ?>" method="post">
        <div class="form-group">
          <label>NIM <sup class="text-danger">*</sup></label>
          <input type="hidden" id="id" name="id" value="<?= $data->id; ?>" readonly>
          <input type="hidden" id="user_id" name="user_id" value="<?= $data->user_id; ?>" readonly>
          <input type="text" id="nim" name="nim" value="<?= $data->nim; ?>" readonly>
        </div>

        <div class="form-group">
          <label>Nama Lengkap <sup class="text-danger">*</sup></label>
          <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?= $data->nama_lengkap; ?>" required>
        </div>

        <div class="form-group">
          <label>Jenis Kelamin <sup class="text-danger">*</sup></label>
          <select name="jenis_kelamin" id="jenis_kelamin" required>
            <option value="L" <?= $data->jenis_kelamin == "L" ? "selected" : "" ?>>Laki - Laki</option>
            <option value="P" <?= $data->jenis_kelamin == "P" ? "selected" : "" ?>>Perempuan</option>
          </select>
        </div>

        <div class="form-group">
          <label>Tanggal Lahir <sup class="text-danger">*</sup></label>
          <input type="date" id="tgl_lahir" name="tgl_lahir" value="<?= $data->tanggal_lahir; ?>" required>
        </div>

        <div class="form-group">
          <label>Email <sup class="text-danger">*</sup></label>
          <input type="email" id="email" name="email" value="<?= $data->email; ?>" required>
        </div>

        <div class="form-group">
          <label>No Hp <sup class="text-danger">*</sup></label>
          <input type="number" id="no_telp" name="no_telp" value="<?= $data->no_telp; ?>" required>
        </div>

        <div class="form-group">
          <label>Program Studi <sup class="text-danger">*</sup></label>
          <select name="program_studi" id="program_studi" required>
            <?php while ($p = mysqli_fetch_array($sql_prodi)) { ?>
              <option value="<?= $p["id"]; ?>" <?= $p["id"] == $data->id_prodi ? "selected" : "" ?>><?= $p["nama_prodi"] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label>Angkatan <sup class="text-danger">*</sup></label>
          <?php $years = range(2020, date("Y")); ?>
          <select name="angkatan" id="angkatan" required>
            <option disabled selected>Pilih Tahun</option>
            <?php foreach ($years as $year) : ?>
              <option value="<?= $year; ?>" <?= $data->angkatan == $year ? "selected" : "" ?>><?= $year; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label>Alamat <sup class="text-danger">*</sup></label>
          <textarea id="alamat" name="alamat" required><?= htmlspecialchars(trim($data->alamat)) ?></textarea>
        </div>

        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-success">Kirim</button>
            <button type="reset" class="btn btn-danger">Kosongkan</button>
          </div>
          <div class="col-md-6">
            <a href="<?= base_url("/page/user/data_mahasiswa.php") ?>" class="btn btn-danger float-right">Kembali</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<?php include("../../layout/scripts.php"); ?>
<?php include("../../layout/footer.php"); ?>