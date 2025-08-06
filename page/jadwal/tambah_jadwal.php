<?php $page = "Tambah Jadwal Perkuliahan"; ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>
<?php include("../../config/db.php"); ?>

<?php
$q_matakuliah = "SELECT * FROM mata_kuliah";
$sql_matakuliah = mysqli_query($conn, $q_matakuliah);

$q_dosen = "SELECT * FROM dosen";
$sql_dosen = mysqli_query($conn, $q_dosen);

$hari = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
?>

<section id="tambah-jadwal">
  <div class="row">
    <div class="col-md-12">
      <form class="form-container" action="<?= base_url("/action/jadwal/tambah_data.php"); ?>" method="post">
        <div class="form-group">
          <label>Mata Kuliah <sup class="text-danger">*</sup></label>
          <select name="mata_kuliah" id="mata_kuliah" required>
            <option disabled selected>Pilih mata kuliah</option>
            <?php while ($m = mysqli_fetch_array($sql_matakuliah)) { ?>
              <option value="<?= $m["id"]; ?>"><?= $m["kode_mk"] . " - " . $m["nama_mk"] . " (" . $m["sks"] . " SKS)" ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label>Dosen Pengampu <sup class="text-danger">*</sup></label>
          <select name="dosen" id="dosen" required>
            <option disabled selected>Pilih dosen</option>
            <?php while ($d = mysqli_fetch_array($sql_dosen)) { ?>
              <option value="<?= $d["id"]; ?>"><?= $d["nidn"] . " - " . $d["nama_lengkap"] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label>Ruang</label>
          <input type="text" id="ruang" name="ruang" required>
        </div>

        <div class="form-group">
          <label>Hari <sup class="text-danger">*</sup></label>
          <select name="hari" id="hari">
            <option disabled selected>Pilih hari</option>
            <?php foreach ($hari as $h) { ?>
              <option value="<?= $h ?>"><?= $h ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Jam Mulai</label>
              <input type="time" id="jam_mulai" name="jam_mulai" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Jam Selesai</label>
              <input type="time" id="jam_selesai" name="jam_selesai" required>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-success">Simpan</button>
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