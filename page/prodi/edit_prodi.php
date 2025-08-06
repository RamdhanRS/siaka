<?php $page = "Edit Prodi"; ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>
<?php include("../../config/db.php"); ?>

<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;
$query = "SELECT * FROM prodi WHERE id = '$id'";
$sql = mysqli_query($conn, $query);
$data = mysqli_fetch_object($sql);

$q_fakultas = "SELECT * FROM fakultas";
$sql_fakultas = mysqli_query($conn, $q_fakultas);

$jenjang = ['D3', 'D4', 'S1', 'S2', 'S3'];
?>

<section id="edit-prodi">
  <div class="row">
    <div class="col-md-12">
      <form class="form-container" action="<?= base_url("/action/prodi/edit_data.php"); ?>" method="post">
        <div class="form-group">
          <label>Fakultas <sup class="text-danger">*</sup></label>
          <input type="hidden" id="id" name="id" value="<?= $data->id; ?>" required>
          <select name="fakultas" id="fakultas" required>
            <option disabled selected>Pilih Fakultas</option>
            <?php while ($f = mysqli_fetch_array($sql_fakultas)) { ?>
              <option value="<?= $f["id"]; ?>" <?= $data->id_fakultas == $f["id"] ? "selected" : "" ?>><?= $f["nama_fakultas"] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label>Nama prodi <sup class="text-danger">*</sup></label>
          <input type="text" id="nama_prodi" name="nama_prodi" value="<?= $data->nama_prodi; ?>" required>
        </div>

        <div class="form-group">
          <label>Jenjang <sup class="text-danger">*</sup></label>
          <select name="jenjang" id="jenjang">
            <option disabled selected>Pilih Jenjang</option>
            <?php foreach ($jenjang as $j) { ?>
              <option value="<?= $j ?>" <?= $data->jenjang == $j ? "selected" : "" ?>><?= $j ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-success">Perbarui</button>
          </div>
          <div class="col-md-6">
            <a href="<?= base_url("/page/prodi/data_prodi.php") ?>" class="btn btn-danger float-right">Kembali</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<?php include("../../layout/scripts.php"); ?>
<?php include("../../layout/footer.php"); ?>