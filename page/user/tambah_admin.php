<?php $page = "Tambah Admin"; ?>
<?php include("../../config/db.php"); ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>

<section id="tambah-admin">
  <div class="row">
    <div class="col-md-12">
      <form class="form-container" action="<?= base_url("/action/admin/tambah_admin.php"); ?>" method="post">
        <div class="form-group">
          <label>Nama Lengkap <sup class="text-danger">*</sup></label>
          <input type="text" id="nama_lengkap" name="nama_lengkap" required>
        </div>

        <div class="form-group">
          <label>Username <sup class="text-danger">*</sup></label>
          <input type="text" id="username" name="username" required>
        </div>

        <div class="form-group">
          <label>Email <sup class="text-danger">*</sup></label>
          <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
          <label>No Hp <sup class="text-danger">*</sup></label>
          <input type="number" min="1" id="no_telp" name="no_telp" required>
        </div>

        <div class="form-group">
          <label>Password <sup class="text-danger">*</sup></label>
          <input type="password" id="password" name="password" required>
        </div>

        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="reset" class="btn btn-danger">Kosongkan</button>
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