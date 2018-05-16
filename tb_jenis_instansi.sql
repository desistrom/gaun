-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 07, 2018 at 02:31 AM
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
-- Table structure for table `tb_jenis_instansi`
--

CREATE TABLE `tb_jenis_instansi` (
  `id_jenis_instansi` int(11) NOT NULL,
  `nm_jenis_instansi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jenis_instansi`
--

INSERT INTO `tb_jenis_instansi` (`id_jenis_instansi`, `nm_jenis_instansi`) VALUES
(1, 'Economic'),
(2, 'Badan Hukum');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_jenis_instansi`
--
ALTER TABLE `tb_jenis_instansi`
  ADD PRIMARY KEY (`id_jenis_instansi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_jenis_instansi`
--
ALTER TABLE `tb_jenis_instansi`
  MODIFY `id_jenis_instansi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
