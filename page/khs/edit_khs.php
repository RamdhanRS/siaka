<?php $page = "Edit KHS"; ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>
<?php include("../../config/db.php"); ?>

<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;
$query = "SELECT khs.*, krs.tahun_akademik, krs.semester, m.nim, m.nama_lengkap as nama_mahasiswa, d.nidn, d.nama_lengkap as nama_dosen, mk.kode_mk, mk.nama_mk, mk.sks, p.jenjang, p.nama_prodi FROM khs LEFT JOIN krs ON krs.id = khs.id_krs LEFT JOIN mahasiswa m ON m.id = krs.id_mahasiswa LEFT JOIN jadwal j ON j.id = krs.id_jadwal LEFT JOIN dosen d ON d.id = j.id_dosen LEFT JOIN mata_kuliah mk ON mk.id = j.id_mk LEFT JOIN prodi p ON p.id = mk.id_prodi WHERE khs.id = '$id'";
$sql = mysqli_query($conn, $query);
$data = mysqli_fetch_object($sql);
?>

<section id="edit-matakuliah">
  <div class="row">
    <div class="col-md-12">
      <form class="form-container" action="<?= base_url("/action/khs/edit_nilai.php"); ?>" method="post">
        <div class="form-group">
          <label>Nama mahasiswa</label>
          <input type="hidden" id="id" name="id" value="<?= $data->id ?>" required>
          <input type="hidden" id="nim" name="nim" value="<?= $data->nim ?>" required>
          <input type="hidden" id="mahasiswa" name="mahasiswa" value="<?= $data->nama_mahasiswa ?>" required>
          <input type="hidden" id="tahun_akademik" name="tahun_akademik" value="<?= $data->tahun_akademik ?>" required>
          <input type="hidden" id="semester" name="semester" value="<?= $data->semester ?>" required>
          <input type="text" value="<?= $data->nim . " - " .  $data->nama_mahasiswa; ?>" readonly>
        </div>

        <div class="form-group">
          <label>Mata Kuliah</label>
          <input type="text" value="<?= $data->kode_mk . " - " . $data->nama_mk . " | " . $data->sks . " SKS" ?>" readonly>
        </div>

        <div class="form-group">
          <label>Dosen Pengampu</label>
          <input type="text" value="<?= $data->nidn . " - " . $data->nama_dosen ?>" readonly>
        </div>

        <div class="form-group">
          <label>Prodi</label>
          <input type="text" value="<?= $data->jenjang . " - " . $data->nama_prodi ?>" readonly>
        </div>

        <div class="form-group">
          <label>Nilai</label>
          <input type="number" min="1" id="nilai" name="nilai" value="<?= $data->nilai_angka ?>" required>
        </div>

        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-success">Perbarui</button>
          </div>
          <div class="col-md-6">
            <a href="<?= base_url("/page/khs/detail_khs.php") . "?nim=" . urlencode($data->nim) . "&tahun_akademik=" . urlencode($data->tahun_akademik) . "&semester=" . urlencode($data->semester) ?>" class="btn btn-danger float-right">Kembali</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<?php include("../../layout/scripts.php"); ?>
<?php include("../../layout/footer.php"); ?>