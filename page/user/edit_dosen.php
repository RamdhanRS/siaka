<?php $page = "Edit Dosen"; ?>
<?php include("../../config/db.php"); ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>

<?php
$nidn = isset($_GET['nidn']) ? $_GET['nidn'] : null;
$query = "SELECT d.*, u.email FROM dosen d LEFT JOIN users u ON u.id = d.user_id WHERE nidn = '$nidn'";
$sql = mysqli_query($conn, $query);
$data = mysqli_fetch_object($sql);
?>

<section id="edit-dosen">
  <div class="row">
    <div class="col-md-12">
      <form class="form-container" action="<?= base_url("/action/dosen/edit_data.php"); ?>" method="post">
        <div class="form-group">
          <label>NIDN <sup class="text-danger">*</sup></label>
          <input type="hidden" id="id" name="id" value="<?= $data->id; ?>" readonly>
          <input type="hidden" id="user_id" name="user_id" value="<?= $data->user_id; ?>" readonly>
          <input type="text" id="nidn" name="nidn" value="<?= $data->nidn; ?>" readonly>
        </div>

        <div class="form-group">
          <label>Nama Lengkap <sup class="text-danger">*</sup></label>
          <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?= $data->nama_lengkap; ?>" required>
        </div>

        <div class="form-group">
          <label>Tanggal Lahir <sup class="text-danger">*</sup></label>
          <input type="date" id="tgl_lahir" name="tgl_lahir" value="<?= $data->tgl_lahir; ?>" required>
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
          <label>Alamat <sup class="text-danger">*</sup></label>
          <textarea id="alamat" name="alamat" required><?= htmlspecialchars(trim($data->alamat)) ?></textarea>
        </div>

        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-success">Perbarui</button>
          </div>
          <div class="col-md-6">
            <a href="<?= base_url("/page/user/data_dosen.php") ?>" class="btn btn-danger float-right">Kembali</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<?php include("../../layout/scripts.php"); ?>
<?php include("../../layout/footer.php"); ?>