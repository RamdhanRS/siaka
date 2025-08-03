/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `dosen`;
CREATE TABLE `dosen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nidn` varchar(20) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nidn` (`nidn`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `fakultas`;
CREATE TABLE `fakultas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_fakultas` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `jadwal`;
CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mk` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `ruang` varchar(50) DEFAULT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_mk` (`id_mk`),
  KEY `id_dosen` (`id_dosen`),
  CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_mk`) REFERENCES `mata_kuliah` (`id`),
  CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `khs`;
CREATE TABLE `khs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_krs` int(11) NOT NULL,
  `nilai_angka` decimal(4,2) DEFAULT NULL,
  `nilai_huruf` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_krs` (`id_krs`),
  CONSTRAINT `khs_ibfk_1` FOREIGN KEY (`id_krs`) REFERENCES `krs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `krs`;
CREATE TABLE `krs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `tahun_akademik` varchar(9) DEFAULT NULL,
  `status` enum('pending','disetujui','ditolak') DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `id_mahasiswa` (`id_mahasiswa`),
  KEY `id_jadwal` (`id_jadwal`),
  CONSTRAINT `krs_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`),
  CONSTRAINT `krs_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `id_prodi` int(11) DEFAULT NULL,
  `angkatan` year(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nim` (`nim`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `mata_kuliah`;
CREATE TABLE `mata_kuliah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_mk` varchar(20) NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `sks` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_mk` (`kode_mk`),
  KEY `id_prodi` (`id_prodi`),
  CONSTRAINT `mata_kuliah_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `prodi`;
CREATE TABLE `prodi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_prodi` varchar(100) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `jenjang` enum('D3','S1','S2') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_fakultas` (`id_fakultas`),
  CONSTRAINT `prodi_ibfk_1` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` enum('admin','dosen','mahasiswa') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admins` (`id`, `user_id`, `nama_lengkap`, `no_telp`) VALUES
(1, 1, 'Admin SIAKA 1', '081234567891');
INSERT INTO `admins` (`id`, `user_id`, `nama_lengkap`, `no_telp`) VALUES
(2, 2, 'Admin SIAKA 2', '081234567892');


INSERT INTO `dosen` (`id`, `user_id`, `nidn`, `nama_lengkap`, `tgl_lahir`, `no_telp`, `alamat`) VALUES
(1, 3, '1234567890', 'Dr. Dosen A', NULL, '081234567893', 'Jl. Dosen A');
INSERT INTO `dosen` (`id`, `user_id`, `nidn`, `nama_lengkap`, `tgl_lahir`, `no_telp`, `alamat`) VALUES
(2, 4, '1234567891', 'Dr. Dosen B', NULL, '081234567894', 'Jl. Dosen B');
INSERT INTO `dosen` (`id`, `user_id`, `nidn`, `nama_lengkap`, `tgl_lahir`, `no_telp`, `alamat`) VALUES
(3, 5, '1234567892', 'Dr. Dosen C', NULL, '081234567895', 'Jl. Dosen C');

INSERT INTO `fakultas` (`id`, `nama_fakultas`) VALUES
(1, 'Fakultas Teknik');
INSERT INTO `fakultas` (`id`, `nama_fakultas`) VALUES
(2, 'Fakultas Ilmu Komputer');


INSERT INTO `jadwal` (`id`, `id_mk`, `id_dosen`, `ruang`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(1, 1, 1, 'Lab 1', 'Senin', '08:00:00', '10:00:00');
INSERT INTO `jadwal` (`id`, `id_mk`, `id_dosen`, `ruang`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(2, 2, 1, 'Lab 1', 'Rabu', '10:00:00', '12:00:00');
INSERT INTO `jadwal` (`id`, `id_mk`, `id_dosen`, `ruang`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(3, 3, 2, 'Lab 2', 'Selasa', '08:00:00', '10:00:00');
INSERT INTO `jadwal` (`id`, `id_mk`, `id_dosen`, `ruang`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(4, 4, 2, 'Lab 3', 'Kamis', '13:00:00', '15:00:00'),
(5, 5, 3, 'Lab 4', 'Jumat', '09:00:00', '11:00:00');

INSERT INTO `khs` (`id`, `id_krs`, `nilai_angka`, `nilai_huruf`) VALUES
(1, 1, 85.00, 'A');
INSERT INTO `khs` (`id`, `id_krs`, `nilai_angka`, `nilai_huruf`) VALUES
(2, 2, 78.00, 'B');
INSERT INTO `khs` (`id`, `id_krs`, `nilai_angka`, `nilai_huruf`) VALUES
(3, 3, 90.00, 'A');
INSERT INTO `khs` (`id`, `id_krs`, `nilai_angka`, `nilai_huruf`) VALUES
(4, 4, 72.00, 'B'),
(5, 5, NULL, NULL),
(6, 6, 88.00, 'A'),
(7, 7, 80.00, 'B'),
(9, 9, 82.00, 'B');

INSERT INTO `krs` (`id`, `id_mahasiswa`, `id_jadwal`, `semester`, `tahun_akademik`, `status`) VALUES
(1, 1, 1, 1, '2025/2026', 'disetujui');
INSERT INTO `krs` (`id`, `id_mahasiswa`, `id_jadwal`, `semester`, `tahun_akademik`, `status`) VALUES
(2, 1, 2, 1, '2025/2026', 'disetujui');
INSERT INTO `krs` (`id`, `id_mahasiswa`, `id_jadwal`, `semester`, `tahun_akademik`, `status`) VALUES
(3, 2, 3, 1, '2025/2026', 'disetujui');
INSERT INTO `krs` (`id`, `id_mahasiswa`, `id_jadwal`, `semester`, `tahun_akademik`, `status`) VALUES
(4, 2, 4, 1, '2025/2026', 'disetujui'),
(5, 3, 1, 1, '2025/2026', 'pending'),
(6, 3, 5, 1, '2025/2026', 'disetujui'),
(7, 4, 1, 1, '2025/2026', 'disetujui'),
(9, 4, 5, 1, '2025/2026', 'disetujui');

INSERT INTO `mahasiswa` (`id`, `user_id`, `nim`, `nama_lengkap`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `no_telp`, `id_prodi`, `angkatan`) VALUES
(1, 6, '2023001', 'Mahasiswa A', 'L', '2003-01-01', 'Jl. Mahasiswa A', '081234567896', 1, '2023');
INSERT INTO `mahasiswa` (`id`, `user_id`, `nim`, `nama_lengkap`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `no_telp`, `id_prodi`, `angkatan`) VALUES
(2, 7, '2023002', 'Mahasiswa B', 'P', '2003-02-02', 'Jl. Mahasiswa B', '081234567897', 1, '2023');
INSERT INTO `mahasiswa` (`id`, `user_id`, `nim`, `nama_lengkap`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `no_telp`, `id_prodi`, `angkatan`) VALUES
(3, 8, '2023003', 'Mahasiswa C', 'L', '2003-03-03', 'Jl. Mahasiswa C', '081234567898', 2, '2023');
INSERT INTO `mahasiswa` (`id`, `user_id`, `nim`, `nama_lengkap`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `no_telp`, `id_prodi`, `angkatan`) VALUES
(4, 9, '2023004', 'Mahasiswa D', 'P', '2003-04-04', 'Jl. Mahasiswa D', '081234567899', 2, '2023');

INSERT INTO `mata_kuliah` (`id`, `kode_mk`, `nama_mk`, `sks`, `semester`, `id_prodi`) VALUES
(1, 'TI101', 'Pemrograman Dasar', 3, 1, 1);
INSERT INTO `mata_kuliah` (`id`, `kode_mk`, `nama_mk`, `sks`, `semester`, `id_prodi`) VALUES
(2, 'TI102', 'Struktur Data', 3, 2, 1);
INSERT INTO `mata_kuliah` (`id`, `kode_mk`, `nama_mk`, `sks`, `semester`, `id_prodi`) VALUES
(3, 'SI101', 'Sistem Basis Data', 3, 2, 2);
INSERT INTO `mata_kuliah` (`id`, `kode_mk`, `nama_mk`, `sks`, `semester`, `id_prodi`) VALUES
(4, 'SI102', 'Analisis Sistem', 3, 3, 2),
(5, 'TI103', 'Jaringan Komputer', 3, 3, 1);

INSERT INTO `prodi` (`id`, `nama_prodi`, `id_fakultas`, `jenjang`) VALUES
(1, 'Teknik Informatika', 1, 'S1');
INSERT INTO `prodi` (`id`, `nama_prodi`, `id_fakultas`, `jenjang`) VALUES
(2, 'Sistem Informasi', 1, 'S1');


INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$M9/tvFlrdTr44j66xrDGm.HTl1FbBitTY4cB1kNd7IbWaz7UXreqC', 'admin1@example.com', 'admin', '2025-08-03 10:07:19');
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`) VALUES
(2, 'admin2', 'adminpass', 'admin2@example.com', 'admin', '2025-08-03 10:07:19');
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`) VALUES
(3, 'dosen1', 'dosenpass', 'dosen1@example.com', 'dosen', '2025-08-03 10:07:19');
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`) VALUES
(4, 'dosen2', 'dosenpass', 'dosen2@example.com', 'dosen', '2025-08-03 10:07:19'),
(5, 'dosen3', 'dosenpass', 'dosen3@example.com', 'dosen', '2025-08-03 10:07:19'),
(6, 'mhs1', 'mhspass', 'mhs1@example.com', 'mahasiswa', '2025-08-03 10:07:19'),
(7, 'mhs2', 'mhspass', 'mhs2@example.com', 'mahasiswa', '2025-08-03 10:07:19'),
(8, 'mhs3', 'mhspass', 'mhs3@example.com', 'mahasiswa', '2025-08-03 10:07:19'),
(9, 'mhs4', 'mhspass', 'mhs4@example.com', 'mahasiswa', '2025-08-03 10:07:19'),
(10, 'mhs5', '$2y$10$AZKl014dwzfi1uaBd0Y3XuPvB4vf8rI0rAuMIlpjDIor6UtA4Aq4u', 'mhs5@example.com', 'mahasiswa', '2025-08-03 10:07:19');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;