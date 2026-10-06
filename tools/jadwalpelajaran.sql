-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 06, 2026 at 01:25 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jadwalpelajaran`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `idabsensi` int NOT NULL,
  `idjadwal` int NOT NULL,
  `status` varchar(20) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `idguru` int NOT NULL,
  `namaguru` varchar(50) NOT NULL,
  `nip` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`idguru`, `namaguru`, `nip`) VALUES
(1, 'Nurhalizah', '123456789'),
(2, 'Ahmadi', '123456790'),
(3, 'Siti', '123456791');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `idjadwal` int NOT NULL,
  `idguru` int NOT NULL,
  `idmapel` int NOT NULL,
  `idkelas` int NOT NULL,
  `idruang` int NOT NULL,
  `hari` varchar(15) NOT NULL,
  `jammulai` time NOT NULL,
  `jamselesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`idjadwal`, `idguru`, `idmapel`, `idkelas`, `idruang`, `hari`, `jammulai`, `jamselesai`) VALUES
(19, 1, 1, 1, 1, 'Senin', '07:30:00', '09:00:00'),
(20, 2, 2, 1, 2, 'Senin', '09:00:00', '10:30:00'),
(21, 3, 3, 2, 3, 'Selasa', '07:30:00', '09:00:00'),
(22, 1, 1, 1, 1, 'Senin', '07:30:00', '09:00:00'),
(23, 2, 2, 1, 2, 'Senin', '09:00:00', '10:30:00'),
(24, 3, 3, 2, 3, 'Selasa', '07:30:00', '09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `idkelas` int NOT NULL,
  `namakelas` varchar(30) NOT NULL,
  `tingkat` varchar(10) NOT NULL,
  `jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`idkelas`, `namakelas`, `tingkat`, `jurusan`) VALUES
(1, 'X RPL 1', 'X', 'RPL'),
(2, 'XI RPL 1', 'XI', 'RPL'),
(3, 'XII RPL 1', 'XII', 'RPL');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `idmapel` int NOT NULL,
  `namamapel` varchar(50) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`idmapel`, `namamapel`, `keterangan`) VALUES
(1, 'Bahasa Indonesia', 'Pelajaran Bahasa Indonesia'),
(2, 'Matematika', 'Pelajaran Matematika'),
(3, 'Bahasa Inggris', 'Pelajaran Bahasa Inggris');

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `idruang` int NOT NULL,
  `namaruang` varchar(30) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`idruang`, `namaruang`, `keterangan`) VALUES
(1, 'Lab Komputer 1', 'Laboratorium komputer'),
(2, 'Lab Komputer 2', 'Laboratorium komputer'),
(3, 'Ruang 1', 'Ruang kelas');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int NOT NULL,
  `namauser` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `namauser`, `username`, `password`, `level`) VALUES
(1, 'nurhalizah', 'nurhalizah', '12345', 'admin'),
(2, 'adinda', 'adinda', '12345', 'admin'),
(3, 'nabila', 'nabila', '12345', 'admin'),
(4, 'siti', 'siti', '12345', 'admin'),
(5, 'putri', 'putri', '12345', 'admin'),
(6, 'Nurhalizah Admin', 'nurhalizahadmin', '123', 'admin'),
(7, 'Nurhalizah Guru', 'nurhalizahguru', '123', 'guru'),
(8, 'Nurhalizah Siswa', 'nurhalizahsiswa', '123', 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`idabsensi`),
  ADD KEY `siswa_ibfk_1` (`idjadwal`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`idguru`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`idjadwal`),
  ADD KEY `idguru` (`idguru`),
  ADD KEY `idmapel` (`idmapel`),
  ADD KEY `idkelas` (`idkelas`),
  ADD KEY `idruang` (`idruang`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`idkelas`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`idmapel`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`idruang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `idabsensi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `idguru` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `idjadwal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `idkelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `idmapel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `idruang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`idjadwal`) REFERENCES `jadwal` (`idjadwal`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`idguru`) REFERENCES `guru` (`idguru`),
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`idmapel`) REFERENCES `mapel` (`idmapel`),
  ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`idkelas`) REFERENCES `kelas` (`idkelas`),
  ADD CONSTRAINT `jadwal_ibfk_4` FOREIGN KEY (`idruang`) REFERENCES `ruang` (`idruang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
