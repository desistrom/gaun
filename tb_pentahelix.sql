-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 08, 2018 at 09:40 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idren`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_pentahelix`
--

CREATE TABLE `tb_pentahelix` (
  `id_pentahelix` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text,
  `jenis` int(11) NOT NULL,
  `sort` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pentahelix`
--

INSERT INTO `tb_pentahelix` (`id_pentahelix`, `judul`, `deskripsi`, `jenis`, `sort`) VALUES
(1, '0', '<p>IDREN merupakan bentuk implementasi dari konsep Pentahelix (institusi perguruan tinggi, dunia industri, pemerintah, lembaga riset/komunitas dan media).</p>\r\n', 1, NULL),
(2, 'Network', '<p>E-Learning, Id-Federation, GGC,Indonesian Instant Messaging, etc.</p>\r\n', 2, 0),
(3, 'Research', '<p>Id-Great, Open Research Data,Hibah Penelitian</p>\r\n', 3, 1),
(4, 'Educations', '<p>PDITT, PD Dikti, MOOC, CBT PTN, Sertifikasi, Journal, Tele Radiology, Tele Surgery, Temandev, (API Factory), CDN, Carrier Development</p>\r\n', 4, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_pentahelix`
--
ALTER TABLE `tb_pentahelix`
  ADD PRIMARY KEY (`id_pentahelix`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_pentahelix`
--
ALTER TABLE `tb_pentahelix`
  MODIFY `id_pentahelix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
