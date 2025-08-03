<?php $page = "Tambah Dosen"; ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>
<?php include("../../config/db.php"); ?>

<section id="tambah-dosen">
  <div class="row">
    <div class="col-md-12">
      <form class="form-container" action="<?= base_url("/action/dosen/tambah_data.php"); ?>" method="post">
        <div class="form-group">
          <label>NIDN <sup class="text-danger">*</sup></label>
          <input type="text" id="nidn" name="nidn" required>
        </div>

        <div class="form-group">
          <label>Nama Lengkap <sup class="text-danger">*</sup></label>
          <input type="text" id="nama_lengkap" name="nama_lengkap" required>
        </div>

        <div class="form-group">
          <label>Tanggal Lahir <sup class="text-danger">*</sup></label>
          <input type="date" id="tgl_lahir" name="tgl_lahir" required>
        </div>

        <div class="form-group">
          <label>Email <sup class="text-danger">*</sup></label>
          <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
          <label>No Hp <sup class="text-danger">*</sup></label>
          <input type="number" id="no_telp" name="no_telp" required>
        </div>

        <div class="form-group">
          <label>Alamat <sup class="text-danger">*</sup></label>
          <textarea id="alamat" name="alamat" required></textarea>
        </div>

        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-success">Kirim</button>
            <button type="reset" class="btn btn-danger">Kosongkan</button>
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