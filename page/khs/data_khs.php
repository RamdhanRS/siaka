<?php $page = "Data Kelola KHS"; ?>
<?php include("../../layout/header.php"); ?>
<?php include("../../layout/topbar.php"); ?>
<?php include("../../layout/sidebar.php"); ?>
<?php include("../../config/db.php"); ?>

<section id="data-krs">
  <div class="row">
    <!-- <div class="col-md-12 mb-3">
      <a href="<?= base_url("/page/krs/tambah_krs.php") ?>" class="btn btn-info float-right">Tambah</a>
    </div> -->
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
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Mahasiswa</th>
            <th>Fakultas</th>
            <th>Tahun Akademik</th>
            <th>Total MK</th>
            <th>SKS <br> Semester</th>
            <th>IPS <br> Semester</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <?php
        $query = "SELECT
                    m.nim,
                    m.nama_lengkap as nama_mahasiswa,
                    f.nama_fakultas,
                    p.nama_prodi, p.jenjang,
                    krs.tahun_akademik,
                    krs.semester,
                    CASE 
                      WHEN krs.semester % 2 = 0 THEN 'Genap'
                      ELSE 'Ganjil'
                    END AS jenis_semester,
                    COUNT(DISTINCT mk.id) AS total_mk,
                    SUM(mk.sks) AS sks_semester,
                    ROUND(SUM(
                      CASE 
                        WHEN khs.nilai_angka >= 85 THEN 4.0 * mk.sks
                        WHEN khs.nilai_angka >= 75 THEN 3.0 * mk.sks
                        WHEN khs.nilai_angka >= 65 THEN 2.0 * mk.sks
                        WHEN khs.nilai_angka >= 50 THEN 1.0 * mk.sks
                        ELSE 0
                      END
                    ) / NULLIF(SUM(mk.sks), 0), 2) AS ips
                  FROM khs
                  JOIN krs ON khs.id_krs = krs.id
                  JOIN mahasiswa m ON krs.id_mahasiswa = m.id
                  JOIN prodi p ON m.id_prodi = p.id
                  JOIN fakultas f ON f.id = p.id_fakultas
                  JOIN jadwal j ON krs.id_jadwal = j.id
                  JOIN mata_kuliah mk ON j.id_mk = mk.id
                  WHERE krs.status = 'disetujui'
                  GROUP BY m.nim, m.nama_lengkap, p.nama_prodi, krs.tahun_akademik, krs.semester
                  ORDER BY
                    krs.tahun_akademik DESC,
                    (CASE WHEN krs.semester % 2 = 0 THEN 0 ELSE 1 END),  -- Genap first
                    krs.semester DESC, m.nama_lengkap ASC";
        $sql = mysqli_query($conn, $query);
        $count = mysqli_num_rows($sql);
        $no = 1;
        ?>
        <tbody id="krs-table-body">
          <?php if ($count > 0) { ?>
            <?php while ($data = mysqli_fetch_array($sql)) { ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $data["nim"] . " - " . $data["nama_mahasiswa"]; ?></td>
                <td>
                  <?= $data["nama_fakultas"]; ?> <br>
                  <?= $data["jenjang"]; ?> - <?= $data["nama_prodi"]; ?>
                </td>
                <td>
                  Semester <?= $data["jenis_semester"]; ?> <br>
                  Tahun <?= $data["tahun_akademik"] ?>
                </td>
                <td><?= $data["total_mk"] ?></td>
                <td><?= $data["sks_semester"] ?></td>
                <td><?= $data["ips"] ?></td>
                <td class="text-center">
                  <a href="<?= base_url("/page/khs/detail_khs.php") . "?nim=" . urlencode($data["nim"]) . "&tahun_akademik=" . urlencode($data["tahun_akademik"]) . "&semester=" . urlencode($data["semester"]) ?>" class="btn btn-info">
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" fill="currentColor" viewBox="0 0 576 512">
                      <path d="M572.52 241.4c-1.39-1.68-34.42-41.57-88.56-82.16C424.86 114.23 361.17 96 288 96S151.14 114.23 92.04 159.24C37.89 199.83 4.86 239.72 3.48 241.4c-4.64 5.6-4.64 13.6 0 19.2 1.39 1.68 34.42 41.57 88.56 82.16C151.14 397.77 214.83 416 288 416s136.86-18.23 195.96-63.24c54.14-40.59 87.17-80.48 88.56-82.16 4.64-5.6 4.64-13.6 0-19.2zM288 368c-44.11 0-80-35.89-80-80s35.89-80 80-80 80 35.89 80 80-35.89 80-80 80zm0-128c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48z" />
                    </svg>
                  </a>
                </td>
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