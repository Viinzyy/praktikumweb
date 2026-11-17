-- Database: simrs
-- Tugas Dashboard Praktikum 4 - SIM RS (Sistem Informasi Manajemen Rumah Sakit)
-- Inventaris Data Alat Elektromedis

CREATE DATABASE IF NOT EXISTS `simrs`;
USE `simrs`;

-- Struktur Tabel `alat`
CREATE TABLE IF NOT EXISTS `alat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_alat` varchar(100) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `merek` varchar(50) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Awal / Dummy Sample
INSERT INTO `alat` (`nama_alat`, `tahun`, `merek`, `lokasi`) VALUES
('Patient Monitor Efficia CM12', '2023', 'Philips', 'Ruang ICU'),
('Elektrokardiograf (ECG) PageWriter TC20', '2022', 'Philips', 'Poli Jantung'),
('Defibrillator HeartStart XL+', '2024', 'Philips', 'Instalasi Gawat Darurat (IGD)'),
('Ventilator Mekanik Servo-Air', '2023', 'Getinge', 'Ruang ICU'),
('Ultrasonografi (USG) 4D DC-30', '2021', 'Mindray', 'Poli Kandungan'),
('Infusion Pump BeneFusion VP3', '2024', 'Mindray', 'Ruang Rawat Inap Melati'),
('Syringe Pump BeneFusion SP3', '2024', 'Mindray', 'Ruang PICU/NICU'),
('Mobile X-Ray Digital Optima XR220amx', '2022', 'GE Healthcare', 'Instalasi Radiologi'),
('Anesthesia Workstation Fabius Tiro', '2023', 'Draeger', 'Kamar Bedah Sentral (OK)'),
('Suction Pump Medela Dominant Flex', '2024', 'Medela', 'Ruang Tindakan IGD');
