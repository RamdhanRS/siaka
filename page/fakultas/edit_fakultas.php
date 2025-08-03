<?php $page = "Edit Fakultas"; ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>
<?php include("../../config/db.php"); ?>

<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;
$query = "SELECT * FROM fakultas WHERE id = '$id'";
$sql = mysqli_query($conn, $query);
$data = mysqli_fetch_object($sql);
?>

<section id="edit-fakultas">
  <div class="row">
    <div class="col-md-12">
      <form class="form-container" action="<?= base_url("/action/fakultas/edit_data.php"); ?>" method="post">
        <div class="form-group">
          <label>Nama Fakultas <sup class="text-danger">*</sup></label>
          <input type="hidden" id="nama_fakultas" name="id" value="<?= $data->id; ?>" required>
          <input type="text" id="nama_fakultas" name="nama_fakultas" value="<?= $data->nama_fakultas; ?>" required>
        </div>

        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-success">Kirim</button>
            <button type="reset" class="btn btn-danger">Kosongkan</button>
          </div>
          <div class="col-md-6">
            <a href="<?= base_url("/page/fakultas/data_fakultas.php") ?>" class="btn btn-danger float-right">Kembali</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<?php include("../../layout/scripts.php"); ?>
<?php include("../../layout/footer.php"); ?>