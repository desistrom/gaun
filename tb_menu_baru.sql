-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 02, 2018 at 09:55 AM
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
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_menu`
--

INSERT INTO `tb_menu` (`id`, `label`, `link`, `parent`, `sort`, `type`) VALUES
(21, 'Subscribe', 'http://localhost/idren/page/subscribe', 0, 10, 2),
(22, 'Galery', 'http://localhost/idren/page/galery', 0, 4, 2),
(23, 'Home', 'http://localhost/idren/', 0, 0, 1),
(24, 'Layanan', '#', 0, 1, 1),
(25, 'Konektivitas', '#', 0, 2, 1),
(26, 'Keanggotaan', '#', 0, 3, 1),
(27, 'Berita', 'http://localhost/idren/web/news', 0, 5, 1),
(28, 'ID-TUBE', 'http://localhost/idren/web/layanan/id_tube', 24, NULL, 1),
(29, 'Topologi', 'http://localhost/idren/web/konektivitas', 25, NULL, 1),
(30, 'Pendaftaran', 'http://localhost/idren/web/keanggotaan/pendaftaran', 26, NULL, 1),
(31, 'Member', 'http://localhost/idren/web/keanggotaan', 26, NULL, 1),
(32, 'Benefit', 'http://localhost/idren/web/keanggotaan/benefit', 26, NULL, 1),
(33, 'Tentang', 'http://localhost/idren/web/tentang', 0, 6, 1),
(34, 'Video', 'http://localhost/idren/web/galery/video', 22, NULL, 1),
(35, 'Foto', 'http://localhost/idren/page/foto', 22, 0, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
