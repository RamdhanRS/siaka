<?php $page = "Edit Mata Kuliah"; ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>
<?php include("../../config/db.php"); ?>

<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;
$query = "SELECT * FROM mata_kuliah WHERE id = '$id'";
$sql = mysqli_query($conn, $query);
$data = mysqli_fetch_object($sql);

$q_prodi = "SELECT * FROM prodi";
$sql_prodi = mysqli_query($conn, $q_prodi);

$semester = [1, 2, 3, 4, 5, 6, 7, 8];
?>

<section id="edit-matakuliah">
  <div class="row">
    <div class="col-md-12">
      <form class="form-container" action="<?= base_url("/action/matakuliah/edit_data.php"); ?>" method="post">
        <div class="form-group">
          <label>Program Studi <sup class="text-danger">*</sup></label>
          <input type="hidden" id="id" name="id" value="<?= $data->id ?>" required>
          <select name="prodi" id="prodi" required>
            <option disabled selected>Pilih prodi</option>
            <?php while ($p = mysqli_fetch_array($sql_prodi)) { ?>
              <option value="<?= $p["id"]; ?>" <?= $data->id_prodi == $p["id"] ? "selected" : "" ?>><?= $p["jenjang"] . " - " . $p["nama_prodi"] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label>Kode Mata Kuliah <sup class="text-danger">*</sup></label>
          <input type="text" id="kode_mk" name="kode_mk" value="<?= $data->kode_mk ?>" required>
        </div>

        <div class="form-group">
          <label>Nama Mata Kuliah <sup class="text-danger">*</sup></label>
          <input type="text" id="nama_mk" name="nama_mk" value="<?= $data->nama_mk ?>" required>
        </div>

        <div class="form-group">
          <label>Semester <sup class="text-danger">*</sup></label>
          <select name="semester" id="semester">
            <option disabled selected>Pilih Semester</option>
            <?php foreach ($semester as $s) { ?>
              <option value="<?= $s ?>" <?= $data->semester == $s ? "selected" : "" ?>><?= $s ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label>Jumlah SKS <sup class="text-danger">*</sup></label>
          <input type="number" min="1" id="sks" name="sks" value="<?= $data->sks ?>" required>
        </div>

        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-success">Kirim</button>
            <button type="reset" class="btn btn-danger">Kosongkan</button>
          </div>
          <div class="col-md-6">
            <a href="<?= base_url("/page/matakuliah/data_mata_kuliah.php") ?>" class="btn btn-danger float-right">Kembali</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<?php include("../../layout/scripts.php"); ?>
<?php include("../../layout/footer.php"); ?>