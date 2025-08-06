<?php $page = "Tambah Prodi"; ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>
<?php include("../../config/db.php"); ?>

<?php
$q_fakultas = "SELECT * FROM fakultas";
$sql_fakultas = mysqli_query($conn, $q_fakultas);

$jenjang = ['D3', 'D4', 'S1', 'S2', 'S3'];
?>

<section id="tambah-prodi">
  <div class="row">
    <div class="col-md-12">
      <form class="form-container" action="<?= base_url("/action/prodi/tambah_data.php"); ?>" method="post">
        <div class="form-group">
          <label>Fakultas <sup class="text-danger">*</sup></label>
          <select name="fakultas" id="fakultas" required>
            <option disabled selected>Pilih Fakultas</option>
            <?php while ($f = mysqli_fetch_array($sql_fakultas)) { ?>
              <option value="<?= $f["id"]; ?>"><?= $f["nama_fakultas"] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label>Nama prodi <sup class="text-danger">*</sup></label>
          <input type="text" id="nama_prodi" name="nama_prodi" required>
        </div>
        <div class="form-group">
          <label>Jenjang <sup class="text-danger">*</sup></label>
          <select name="jenjang" id="jenjang">
            <option disabled selected>Pilih Jenjang</option>
            <?php foreach ($jenjang as $j) { ?>
              <option value="<?= $j ?>"><?= $j ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="reset" class="btn btn-danger">Kosongkan</button>
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