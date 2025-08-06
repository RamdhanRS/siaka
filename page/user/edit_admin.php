<?php $page = "Edit Admin"; ?>
<?php include("../../config/db.php"); ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>

<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;
$query = "SELECT id, username, email, password FROM users WHERE id = '$id'";
$sql = mysqli_query($conn, $query);
$data = mysqli_fetch_object($sql);
?>

<section id="edit-admin">
  <div class="row">
    <div class="col-md-12">
      <form class="form-container" action="<?= base_url("/action/admin/edit_data.php"); ?>" method="post">
        <div class="form-group">
          <label>Username <sup class="text-danger">*</sup></label>
          <input type="hidden" id="id" name="id" value="<?= $data->id; ?>" readonly>
          <input type="text" id="username" name="username" value="<?= $data->username; ?>" required>
        </div>

        <div class="form-group">
          <label>Email<sup class="text-danger">*</sup></label>
          <input type="email" id="email" name="email" value="<?= $data->email; ?>" required>
        </div>

        <div class="form-group">
          <label>Password</label>
          <input type="hidden" id="current_password" name="current_password" value="<?= $data->password; ?>">
          <input type="password" id="password" name="password">
        </div>

        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-success">Perbarui</button>
          </div>
          <div class="col-md-6">
            <a href="<?= base_url("/page/user/data_admin.php") ?>" class="btn btn-danger float-right">Kembali</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<?php include("../../layout/scripts.php"); ?>
<?php include("../../layout/footer.php"); ?>