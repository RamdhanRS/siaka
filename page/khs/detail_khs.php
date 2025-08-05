<?php $page = "Detail KHS"; ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>
<?php include("../../config/db.php"); ?>

<?php
$no = 1;
$nim = isset($_GET['nim']) ? $_GET['nim'] : null;
$tahun_akademik = isset($_GET['tahun_akademik']) ? $_GET['tahun_akademik'] : null;
$semester = isset($_GET['semester']) ? $_GET['semester'] : null;

if ($nim && $tahun_akademik && $semester) {
  $nim_safe = mysqli_real_escape_string($conn, $nim);
  $tahun_safe = mysqli_real_escape_string($conn, $tahun_akademik);
  $semester_safe = mysqli_real_escape_string($conn, $semester);

  $query = "SELECT khs.id, mk.kode_mk, mk.nama_mk, mk.sks, khs.nilai_angka, khs.nilai_huruf, d.nama_lengkap AS dosen FROM khs JOIN krs ON khs.id_krs = krs.id JOIN mahasiswa m ON krs.id_mahasiswa = m.id JOIN jadwal j ON krs.id_jadwal = j.id JOIN mata_kuliah mk ON j.id_mk = mk.id JOIN dosen d ON j.id_dosen = d.id WHERE krs.status = 'disetujui' AND m.nim = '$nim_safe' AND krs.tahun_akademik = '$tahun_akademik' AND krs.semester = '$semester_safe' ORDER BY mk.nama_mk";
  $result = mysqli_query($conn, $query);
  $count = mysqli_num_rows($result);

  $query_count = "SELECT m.nim, m.nama_lengkap, p.nama_prodi,( SELECT ROUND(SUM( CASE WHEN khs2.nilai_angka >= 85 THEN 4.0 * mk2.sks WHEN khs2.nilai_angka >= 75 THEN 3.0 * mk2.sks WHEN khs2.nilai_angka >= 65 THEN 2.0 * mk2.sks WHEN khs2.nilai_angka >= 50 THEN 1.0 * mk2.sks ELSE 0 END) / NULLIF(SUM(mk2.sks), 0), 2) FROM khs khs2 JOIN krs krs2 ON khs2.id_krs = krs2.id JOIN jadwal j2 ON krs2.id_jadwal = j2.id JOIN mata_kuliah mk2 ON j2.id_mk = mk2.id WHERE krs2.status = 'disetujui' AND krs2.id_mahasiswa = m.id AND krs2.tahun_akademik = '$tahun_safe' AND krs2.semester = '$semester' ) AS ips_semester, SUM(mk.sks) AS total_sks, ROUND(SUM( CASE WHEN khs.nilai_angka >= 85 THEN 4.0 * mk.sks WHEN khs.nilai_angka >= 75 THEN 3.0 * mk.sks WHEN khs.nilai_angka >= 65 THEN 2.0 * mk.sks WHEN khs.nilai_angka >= 50 THEN 1.0 * mk.sks ELSE 0 END ) / NULLIF(SUM(mk.sks), 0), 2) AS ipk_total FROM khs JOIN krs ON khs.id_krs = krs.id JOIN mahasiswa m ON krs.id_mahasiswa = m.id JOIN prodi p ON m.id_prodi = p.id JOIN jadwal j ON krs.id_jadwal = j.id JOIN mata_kuliah mk ON j.id_mk = mk.id WHERE krs.status = 'disetujui' AND m.nim = '$nim_safe' GROUP BY m.nim, m.nama_lengkap, p.nama_prodi";
  $sql_count = mysqli_query($conn, $query_count);
  $data_count = mysqli_fetch_object($sql_count);

  $query_detail = "SELECT m.nim, m.nama_lengkap as nama_mahasiswa, m.jenis_kelamin, m.tanggal_lahir, m.angkatan, m.no_telp, m.status_mahasiswa as status, f.nama_fakultas, p.nama_prodi, p.jenjang, mk.kode_mk, mk.nama_mk, mk.sks, khs.nilai_angka, khs.nilai_huruf, d.nama_lengkap AS dosen FROM khs JOIN krs ON khs.id_krs = krs.id JOIN mahasiswa m ON krs.id_mahasiswa = m.id JOIN jadwal j ON krs.id_jadwal = j.id JOIN mata_kuliah mk ON j.id_mk = mk.id JOIN prodi p ON p.id = mk.id_prodi JOIN fakultas f ON f.id = p.id_fakultas JOIN dosen d ON j.id_dosen = d.id WHERE krs.status = 'disetujui' AND m.nim = '$nim' AND krs.tahun_akademik = '$tahun_safe' AND krs.semester = '$semester' ORDER BY mk.nama_mk";
  $sql_detail = mysqli_query($conn, $query_detail);
  $detail = mysqli_fetch_object($sql_detail);
} else {
  echo "<p style='color:red;'>Data tidak valid.</p>";
}
?>

<section id="detail-khs">
  <div class="row">
    <?php if (isset($_SESSION['alert'])): ?>
      <div class="col-md-12">
        <div class="alert alert-<?= $_SESSION['alert']['type'] ?>">
          <?= $_SESSION['alert']['message'] ?>
          <button class="close-alert" onclick="this.parentElement.style.display='none'">&times;</button>
        </div>
      </div>
      <?php unset($_SESSION['alert']); ?>
    <?php endif; ?>
    <div class="col-md-12">
      <div class="card-detail">
        <h3 class="card-title">Detail Mahasiswa</h3>
        <div class="grid-detail">
          <div class="detail-block">
            <span class="label">NIM</span>
            <div class="value"><?= $detail->nim; ?></div>
          </div>
          <div class="detail-block">
            <span class="label">Nama Lengkap</span>
            <div class="value"><?= $detail->nama_mahasiswa; ?></div>
          </div>
          <div class="detail-block">
            <span class="label">Program Studi</span>
            <div class="value"><?= $detail->jenjang . " - " . $detail->nama_prodi; ?></div>
          </div>
          <div class="detail-block">
            <span class="label">Jenis Kelamin</span>
            <div class="value"><?= $detail->jenis_kelamin == "L" ? "Laki - Laki" : "Perempuan"; ?></div>
          </div>
          <div class="detail-block">
            <span class="label">Tanggal Lahir</span>
            <div class="value"><?= date("d F Y", strtotime($detail->tanggal_lahir)); ?></div>
          </div>
          <div class="detail-block">
            <span class="label">Angkatan</span>
            <div class="value"><?= $detail->angkatan; ?></div>
          </div>
          <div class="detail-block">
            <span class="label">Telepon</span>
            <div class="value"><?= $detail->no_telp; ?></div>
          </div>
          <div class="detail-block">
            <span class="label">Status</span>
            <div class="value">
              <?php
              function getBadgeClass($status)
              {
                switch ($status) {
                  case 'aktif':
                    return 'badge-success';
                  case 'cuti':
                    return 'badge-warning';
                  case 'lulus':
                    return 'badge-info';
                  case 'nonaktif':
                  case 'dropout':
                  case 'mengundurkan_diri':
                    return 'badge-danger';
                  case 'pindah':
                    return 'badge-info';
                  default:
                    return 'badge-info';
                }
              }
              ?>
              <div class="value">
                <span class="badge <?= getBadgeClass($detail->status); ?>">
                  <?= ucwords(str_replace('_', ' ', $detail->status)); ?>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 mb-4">
      <div class="statistik-box">
        <div class="statistik-item">
          <div class="label">SKS Semester</div>
          <div class="value"><?= $data_count->total_sks; ?></div>
        </div>
        <div class="divider"></div>
        <div class="statistik-item">
          <div class="label">IP Semester</div>
          <div class="value"><?= $data_count->ips_semester; ?></div>
        </div>
        <div class="divider"></div>
        <div class="statistik-item">
          <div class="label">IP Total</div>
          <div class="value"><?= $data_count->ipk_total; ?></div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Nilai Angka</th>
            <th>Nilai Huruf</th>
            <th>Dosen</th>
            <?php if ($detail->status == "aktif") { ?>
              <th class="text-center">Aksi</th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>
          <?php if ($count > 0) { ?>
            <?php while ($data = mysqli_fetch_array($result)) { ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $data["kode_mk"]; ?></td>
                <td><?= $data["nama_mk"]; ?></td>
                <td><?= $data["sks"]; ?></td>
                <td><?= $data["nilai_angka"]; ?></td>
                <td><?= $data["nilai_huruf"]; ?></td>
                <td><?= $data["dosen"] ?></td>
                <?php if ($detail->status == "aktif") { ?>
                  <td class="text-center">
                    <a href="<?= base_url("/page/khs/edit_khs.php") . "?id=" . $data["id"] ?>" class="btn btn-warning">Edit</a>
                  </td>
                <?php } ?>
              </tr>
            <?php } ?>
          <?php } else { ?>
            <tr>
              <td colspan="6" style="text-align: center;">Tidak ada data</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<?php include("../../layout/scripts.php"); ?>
<?php include("../../layout/footer.php"); ?>