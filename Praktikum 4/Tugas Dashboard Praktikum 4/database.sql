-- Database: simrs
-- Tugas Dashboard Praktikum 4 - SIM RS (Sistem Informasi Manajemen Rumah Sakit)
-- Inventaris Data Alat Elektromedis

CREATE DATABASE IF NOT EXISTS `simrs`;
USE `simrs`;

-- ========================================================
-- 1. Struktur Tabel `users` (Autentikasi Pengguna)
-- ========================================================
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_awal` varchar(50) NOT NULL,
  `nama_akhir` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL UNIQUE,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Akun Default Administrator (Password: admin123)
INSERT IGNORE INTO `users` (`id`, `nama_awal`, `nama_akhir`, `username`, `email`, `password`) VALUES
(1, 'Admin', 'Elektromedis', 'admin', 'admin@rs-elektro.id', '$2y$10$LJ7sHqa6aR8KQY3NK.tNQ..5rtDEC5wKBvhhREGIPOknlRqF70pPi');

-- ========================================================
-- 2. Struktur Tabel `alat` (Data Alat Elektromedis)
-- ========================================================
CREATE TABLE IF NOT EXISTS `alat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_alat` varchar(100) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `merek` varchar(50) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Awal / Dummy Sample
INSERT INTO `alat` (`id`, `nama_alat`, `tahun`, `merek`, `lokasi`) VALUES
(1, 'Patient Monitor Efficia CM12', '2023', 'Philips', 'Ruang ICU'),
(2, 'Elektrokardiograf (ECG) PageWriter TC20', '2022', 'Philips', 'Poli Jantung'),
(3, 'Defibrillator HeartStart XL+', '2024', 'Philips', 'Instalasi Gawat Darurat (IGD)'),
(4, 'Ventilator Mekanik Servo-Air', '2023', 'Getinge', 'Ruang ICU'),
(5, 'Ultrasonografi (USG) 4D DC-30', '2021', 'Mindray', 'Poli Kandungan'),
(6, 'Infusion Pump BeneFusion VP3', '2024', 'Mindray', 'Ruang Rawat Inap Melati'),
(7, 'Syringe Pump BeneFusion SP3', '2024', 'Mindray', 'Ruang PICU/NICU'),
(8, 'Mobile X-Ray Digital Optima XR220amx', '2022', 'GE Healthcare', 'Instalasi Radiologi'),
(9, 'Anesthesia Workstation Fabius Tiro', '2023', 'Draeger', 'Kamar Bedah Sentral (OK)'),
(10, 'Suction Pump Medela Dominant Flex', '2024', 'Medela', 'Ruang Tindakan IGD')
ON DUPLICATE KEY UPDATE `nama_alat`=VALUES(`nama_alat`);
