<?php
session_start();
include_once __DIR__ . '/../../config/config.php';
include("../../config/db.php");

function konversiNilai($angka)
{
  if ($angka >= 85) return ['huruf' => 'A',  'ip' => 4.00];
  elseif ($angka >= 80) return ['huruf' => 'A−', 'ip' => 3.75];
  elseif ($angka >= 75) return ['huruf' => 'B+', 'ip' => 3.50];
  elseif ($angka >= 70) return ['huruf' => 'B',  'ip' => 3.00];
  elseif ($angka >= 65) return ['huruf' => 'B−', 'ip' => 2.75];
  elseif ($angka >= 60) return ['huruf' => 'C+', 'ip' => 2.50];
  elseif ($angka >= 55) return ['huruf' => 'C',  'ip' => 2.00];
  elseif ($angka >= 50) return ['huruf' => 'D',  'ip' => 1.00];
  else return ['huruf' => 'E', 'ip' => 0.00];
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $id = $_POST["id"];
  $nim = $_POST['nim'];
  $nama_mahasiswa = $_POST['mahasiswa'];
  $tahun_akademik = $_POST['tahun_akademik'];
  $semester = $_POST['semester'];
  $nilai_angka = $_POST['nilai'];
  $nilai_huruf = konversiNilai((float)$nilai_angka)["huruf"];

  $query = "UPDATE khs SET
              nilai_angka = '$nilai_angka',
              nilai_huruf = '$nilai_huruf'
            WHERE id = '$id'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Data KHS ' . $nama_mahasiswa . ', tahun ' . $tahun_akademik . ' berhasil diperbarui.'
    ];
  } else {
    $_SESSION['alert'] = [
      'type' => 'error',
      'message' => 'Gagal memperbarui data: ' . mysqli_error($conn)
    ];
  }

  header("Location: " . base_url("/page/khs/detail_khs.php") . "?nim=" . urlencode($nim) . "&tahun_akademik=" . urlencode($tahun_akademik) . "&semester=" . urlencode($semester));
  exit;
}
