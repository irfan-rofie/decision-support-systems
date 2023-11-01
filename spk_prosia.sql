-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3307
-- Generation Time: Nov 01, 2023 at 03:14 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_prosia`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_alternatif`
--

CREATE TABLE `t_alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `periode` varchar(4) NOT NULL,
  `tgl_penilaian` date NOT NULL,
  `aktif` char(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_alternatif`
--

INSERT INTO `t_alternatif` (`id_alternatif`, `nik`, `periode`, `tgl_penilaian`, `aktif`) VALUES
(1, '201643570010', '2018', '2018-01-01', 'Y'),
(2, '0204121000', '2017', '2018-01-02', 'N'),
(3, '20163570011', '2015', '2018-01-01', 'Y'),
(4, '987', '2018', '2018-07-31', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `t_bobot`
--

CREATE TABLE `t_bobot` (
  `id_bobot` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_bobot`
--

INSERT INTO `t_bobot` (`id_bobot`, `id_kriteria`, `bobot`) VALUES
(1, 1, 35),
(2, 3, 20),
(3, 4, 15),
(4, 5, 15),
(5, 6, 5),
(6, 7, 10),
(7, 8, 5),
(8, 9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `t_karyawan`
--

CREATE TABLE `t_karyawan` (
  `nik` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `no_ktp` varchar(16) NOT NULL,
  `jk` int(1) NOT NULL,
  `tempat` varchar(25) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_tlp` varchar(12) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_karyawan`
--

INSERT INTO `t_karyawan` (`nik`, `nama`, `jabatan`, `tgl_masuk`, `no_ktp`, `jk`, `tempat`, `tgl_lahir`, `alamat`, `no_tlp`, `status`) VALUES
('0204121000', 'Rofie Irfan', 'Java Developer', '2015-06-01', '3206391510930003', 0, 'Tasmal', '1993-10-10', 'Alamat palsu', '085210039366', 'Y'),
('123456789', 'unindra', 'dosen', '2018-06-28', '', 0, '', '0000-00-00', '', '', 'N'),
('1234567891011', 'Moch Ramdani', 'Dev Java', '2018-06-28', '0009997771176544', 0, 'Bandung', '2018-08-09', 'Bandung Jabar', '089765776555', 'Y'),
('20163570011', 'Ia Kurnia', 'Developer', '2018-06-07', '12345', 0, 'JKT', '1999-11-27', 'test', '123', 'Y'),
('201643570010', 'Irfan Rofie', 'Developer', '2018-07-05', '9999999', 0, 'bdg', '1990-11-30', 'y', '678', 'Y'),
('987', 'Fulan', 'Developer', '2018-07-01', '090', 0, 'xyz', '1980-12-01', 'o', '10', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `t_kriteria`
--

CREATE TABLE `t_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `atribut` char(1) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_kriteria`
--

INSERT INTO `t_kriteria` (`id_kriteria`, `nama`, `atribut`, `status`) VALUES
(1, 'Progamming', 'B', 'Y'),
(2, 'wkwk', 'C', 'N'),
(3, 'Algortima', 'B', 'Y'),
(4, 'Kerjasama', 'B', 'Y'),
(5, 'Kreativitas', 'B', 'Y'),
(6, 'Pelanggaran K3LL', 'C', 'Y'),
(7, 'Error/Bugs', 'C', 'Y'),
(8, 'test', 'B', 'N'),
(9, 'wkwk', 'C', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `t_nilai`
--

CREATE TABLE `t_nilai` (
  `id_nilai` int(11) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_standar` int(11) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_nilai`
--

INSERT INTO `t_nilai` (`id_nilai`, `nik`, `id_kriteria`, `id_standar`, `status`) VALUES
(1, '201643570010', 1, 2, 'Y'),
(2, '201643570010', 3, 2, 'Y'),
(3, '201643570010', 4, 3, 'Y'),
(4, '201643570010', 5, 2, 'Y'),
(5, '201643570010', 6, 5, 'Y'),
(6, '201643570010', 7, 4, 'Y'),
(7, '20163570011', 1, 2, 'Y'),
(8, '20163570011', 3, 1, 'Y'),
(9, '20163570011', 4, 2, 'Y'),
(10, '20163570011', 5, 2, 'Y'),
(11, '20163570011', 6, 4, 'Y'),
(12, '20163570011', 7, 4, 'Y'),
(13, '0204121000', 1, 3, 'Y'),
(14, '0204121000', 3, 3, 'Y'),
(15, '0204121000', 4, 2, 'Y'),
(16, '0204121000', 5, 3, 'Y'),
(17, '0204121000', 6, 5, 'Y'),
(18, '0204121000', 7, 4, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `t_standar`
--

CREATE TABLE `t_standar` (
  `id_standar` int(11) NOT NULL,
  `standar` varchar(50) NOT NULL,
  `nilai` int(11) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_standar`
--

INSERT INTO `t_standar` (`id_standar`, `standar`, `nilai`, `status`) VALUES
(1, 'Memuaskan', 5, 'Y'),
(2, 'Baik', 4, 'Y'),
(3, 'Cukup', 3, 'Y'),
(4, 'Kurang', 2, 'Y'),
(5, 'Rendah', 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `aktif` char(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`user_id`, `username`, `password`, `level`, `aktif`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 'Y'),
(2, 'supervisor', '09348c20a019be0318387c08df7a783d', 1, 'Y'),
(3, 'manager', '1d0258c2440a8d19e716292b231e3190', 2, 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_alternatif`
--
ALTER TABLE `t_alternatif`
  ADD PRIMARY KEY (`id_alternatif`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `t_bobot`
--
ALTER TABLE `t_bobot`
  ADD PRIMARY KEY (`id_bobot`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `t_karyawan`
--
ALTER TABLE `t_karyawan`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `t_kriteria`
--
ALTER TABLE `t_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `t_nilai`
--
ALTER TABLE `t_nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_standar` (`id_standar`),
  ADD KEY `id_kriteria` (`id_kriteria`) USING BTREE,
  ADD KEY `nik` (`nik`) USING BTREE;

--
-- Indexes for table `t_standar`
--
ALTER TABLE `t_standar`
  ADD PRIMARY KEY (`id_standar`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_alternatif`
--
ALTER TABLE `t_alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `t_bobot`
--
ALTER TABLE `t_bobot`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `t_kriteria`
--
ALTER TABLE `t_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `t_nilai`
--
ALTER TABLE `t_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `t_standar`
--
ALTER TABLE `t_standar`
  MODIFY `id_standar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_alternatif`
--
ALTER TABLE `t_alternatif`
  ADD CONSTRAINT `t_alternatif_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `t_karyawan` (`nik`);

--
-- Constraints for table `t_bobot`
--
ALTER TABLE `t_bobot`
  ADD CONSTRAINT `t_bobot_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `t_kriteria` (`id_kriteria`);

--
-- Constraints for table `t_nilai`
--
ALTER TABLE `t_nilai`
  ADD CONSTRAINT `t_nilai_ibfk_2` FOREIGN KEY (`nik`) REFERENCES `t_karyawan` (`nik`),
  ADD CONSTRAINT `t_nilai_ibfk_3` FOREIGN KEY (`id_standar`) REFERENCES `t_standar` (`id_standar`),
  ADD CONSTRAINT `t_nilai_ibfk_4` FOREIGN KEY (`id_kriteria`) REFERENCES `t_kriteria` (`id_kriteria`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
