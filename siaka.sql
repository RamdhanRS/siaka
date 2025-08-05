-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Agu 2025 pada 03.54
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siaka`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `user_id`, `nama_lengkap`, `no_telp`) VALUES
(1, 1, 'Admin SIAKA 1', '081234567891'),
(2, 2, 'Admin SIAKA 2', '081234567892');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nidn` varchar(20) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`id`, `user_id`, `nidn`, `nama_lengkap`, `tgl_lahir`, `no_telp`, `alamat`) VALUES
(1, 3, '1234567890', 'Dr. Dosen A', NULL, '081234567893', 'Jl. Dosen A'),
(2, 4, '1234567891', 'Dr. Dosen B', NULL, '081234567894', 'Jl. Dosen B'),
(3, 5, '1234567892', 'Dr. Dosen C', NULL, '081234567895', 'Jl. Dosen C');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fakultas`
--

CREATE TABLE `fakultas` (
  `id` int(11) NOT NULL,
  `nama_fakultas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `fakultas`
--

INSERT INTO `fakultas` (`id`, `nama_fakultas`) VALUES
(1, 'Fakultas Teknik'),
(2, 'Fakultas Ilmu Komputer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `id_mk` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `ruang` varchar(50) DEFAULT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id`, `id_mk`, `id_dosen`, `ruang`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(1, 1, 1, 'Lab 1', 'Senin', '08:00:00', '10:00:00'),
(2, 2, 1, 'Lab 1', 'Rabu', '10:00:00', '12:00:00'),
(3, 3, 2, 'Lab 2', 'Selasa', '08:00:00', '10:00:00'),
(4, 4, 2, 'Lab 3', 'Kamis', '13:00:00', '15:00:00'),
(5, 5, 3, 'Lab 4', 'Jumat', '09:00:00', '11:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `khs`
--

CREATE TABLE `khs` (
  `id` int(11) NOT NULL,
  `id_krs` int(11) NOT NULL,
  `nilai_angka` decimal(4,2) DEFAULT NULL,
  `nilai_huruf` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `khs`
--

INSERT INTO `khs` (`id`, `id_krs`, `nilai_angka`, `nilai_huruf`) VALUES
(1, 1, 85.00, 'A'),
(2, 2, 78.00, 'B'),
(3, 3, 90.00, 'A'),
(4, 4, 72.00, 'B'),
(5, 5, NULL, NULL),
(6, 6, 88.00, 'A'),
(7, 7, 80.00, 'B'),
(8, 8, 75.00, 'B'),
(9, 9, 82.00, 'B'),
(10, 10, 95.00, 'A'),
(11, 11, 80.00, 'B'),
(12, 12, 90.00, 'A'),
(13, 13, 82.00, 'B'),
(14, 14, 85.00, 'A'),
(15, 15, 75.00, 'B'),
(16, 16, 78.00, 'B'),
(17, 17, 88.00, 'A'),
(18, 18, 70.00, 'B'),
(19, 19, 85.00, 'A'),
(20, 20, 80.00, 'B'),
(21, 21, 72.00, 'B'),
(22, 22, 77.00, 'B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `krs`
--

CREATE TABLE `krs` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `tahun_akademik` varchar(9) DEFAULT NULL,
  `status` enum('pending','disetujui','ditolak') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `krs`
--

INSERT INTO `krs` (`id`, `id_mahasiswa`, `id_jadwal`, `semester`, `tahun_akademik`, `status`) VALUES
(1, 1, 1, 1, '2025/2026', 'disetujui'),
(2, 1, 2, 1, '2025/2026', 'disetujui'),
(3, 2, 3, 1, '2025/2026', 'disetujui'),
(4, 2, 4, 1, '2025/2026', 'disetujui'),
(5, 3, 1, 1, '2025/2026', 'pending'),
(6, 3, 5, 1, '2025/2026', 'disetujui'),
(7, 4, 1, 1, '2025/2026', 'disetujui'),
(8, 5, 2, 1, '2025/2026', 'disetujui'),
(9, 4, 5, 1, '2025/2026', 'disetujui'),
(10, 5, 3, 1, '2025/2026', 'disetujui'),
(11, 1, 2, 2, '2025/2026', 'disetujui'),
(12, 1, 5, 2, '2025/2026', 'disetujui'),
(13, 2, 2, 2, '2025/2026', 'disetujui'),
(14, 2, 5, 2, '2025/2026', 'disetujui'),
(15, 3, 3, 2, '2025/2026', 'disetujui'),
(16, 3, 4, 2, '2025/2026', 'disetujui'),
(17, 1, 4, 3, '2026/2027', 'disetujui'),
(18, 1, 3, 3, '2026/2027', 'disetujui'),
(19, 2, 4, 3, '2026/2027', 'disetujui'),
(20, 2, 3, 3, '2026/2027', 'disetujui'),
(21, 3, 2, 3, '2026/2027', 'disetujui'),
(22, 3, 5, 3, '2026/2027', 'disetujui');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `id_prodi` int(11) DEFAULT NULL,
  `angkatan` year(4) DEFAULT NULL,
  `status_mahasiswa` enum('aktif','cuti','lulus','nonaktif','dropout','pindah','mengundurkan_diri') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `user_id`, `nim`, `nama_lengkap`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `no_telp`, `id_prodi`, `angkatan`, `status_mahasiswa`) VALUES
(1, 6, '2023001', 'Mahasiswa A', 'L', '2003-01-01', 'Jl. Mahasiswa A', '081234567896', 1, '2023', 'aktif'),
(2, 7, '2023002', 'Mahasiswa B', 'P', '2003-02-02', 'Jl. Mahasiswa B', '081234567897', 1, '2023', 'cuti'),
(3, 8, '2023003', 'Mahasiswa C', 'L', '2003-03-03', 'Jl. Mahasiswa C', '081234567898', 2, '2023', 'lulus'),
(4, 9, '2023004', 'Mahasiswa D', 'P', '2003-04-04', 'Jl. Mahasiswa D', '081234567899', 2, '2023', 'dropout'),
(5, 10, '2023005', 'Mahasiswa E', 'L', '2003-05-05', 'Jl. Mahasiswa E', '081234567800', 1, '2023', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id` int(11) NOT NULL,
  `kode_mk` varchar(20) NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `sks` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `id_prodi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id`, `kode_mk`, `nama_mk`, `sks`, `semester`, `id_prodi`) VALUES
(1, 'TI101', 'Pemrograman Dasar', 3, 1, 1),
(2, 'TI102', 'Struktur Data', 3, 2, 1),
(3, 'SI101', 'Sistem Basis Data', 3, 2, 2),
(4, 'SI102', 'Analisis Sistem', 3, 3, 2),
(5, 'TI103', 'Jaringan Komputer', 3, 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `nama_prodi` varchar(100) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `jenjang` enum('D3','S1','S2') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`id`, `nama_prodi`, `id_fakultas`, `jenjang`) VALUES
(1, 'Teknik Informatika', 1, 'S1'),
(2, 'Sistem Informasi', 1, 'S1'),
(3, 'Teknik Sipil', 1, 'S1'),
(4, 'Manajemen Informatika', 2, 'D3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` enum('admin','dosen','mahasiswa') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`) VALUES
(1, 'admin1', 'adminpass', 'admin1@example.com', 'admin', '2025-08-04 16:48:45'),
(2, 'admin2', 'adminpass', 'admin2@example.com', 'admin', '2025-08-04 16:48:45'),
(3, 'dosen1', 'dosenpass', 'dosen1@example.com', 'dosen', '2025-08-04 16:48:45'),
(4, 'dosen2', 'dosenpass', 'dosen2@example.com', 'dosen', '2025-08-04 16:48:45'),
(5, 'dosen3', 'dosenpass', 'dosen3@example.com', 'dosen', '2025-08-04 16:48:45'),
(6, 'mhs1', 'mhspass', 'mhs1@example.com', 'mahasiswa', '2025-08-04 16:48:45'),
(7, 'mhs2', 'mhspass', 'mhs2@example.com', 'mahasiswa', '2025-08-04 16:48:45'),
(8, 'mhs3', 'mhspass', 'mhs3@example.com', 'mahasiswa', '2025-08-04 16:48:45'),
(9, 'mhs4', 'mhspass', 'mhs4@example.com', 'mahasiswa', '2025-08-04 16:48:45'),
(10, 'mhs5', 'mhspass', 'mhs5@example.com', 'mahasiswa', '2025-08-04 16:48:45');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nidn` (`nidn`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mk` (`id_mk`),
  ADD KEY `id_dosen` (`id_dosen`);

--
-- Indeks untuk tabel `khs`
--
ALTER TABLE `khs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_krs` (`id_krs`);

--
-- Indeks untuk tabel `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_mk` (`kode_mk`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fakultas` (`id_fakultas`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `khs`
--
ALTER TABLE `khs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `krs`
--
ALTER TABLE `krs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_mk`) REFERENCES `mata_kuliah` (`id`),
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id`);

--
-- Ketidakleluasaan untuk tabel `khs`
--
ALTER TABLE `khs`
  ADD CONSTRAINT `khs_ibfk_1` FOREIGN KEY (`id_krs`) REFERENCES `krs` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `krs_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`),
  ADD CONSTRAINT `krs_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id`);

--
-- Ketidakleluasaan untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD CONSTRAINT `mata_kuliah_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id`);

--
-- Ketidakleluasaan untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD CONSTRAINT `prodi_ibfk_1` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
