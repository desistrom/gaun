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
-- Table structure for table `tb_general_page`
--

CREATE TABLE `tb_general_page` (
  `id_general_page` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `page` int(11) NOT NULL,
  `link` varchar(100) NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_general_page`
--

INSERT INTO `tb_general_page` (`id_general_page`, `title`, `img`, `content`, `page`, `link`, `tgl_update`) VALUES
(1, 'ini adalah menu page', '1524802169.png', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eget ultrices quam. Praesent ac tempor massa. Praesent gravida dignissim enim vel cursus. Cras vel consectetur mauris, non elementum dolor. Phasellus pharetra lectus at erat vehicula, eu tincidunt est fringilla. Integer in convallis nibh. Vestibulum ullamcorper magna risus, in sollicitudin mauris gravida ac.</p>\r\n\r\n<p>Nullam quis scelerisque lacus. In congue hendrerit velit, a vestibulum urna rhoncus nec. Etiam velit nunc, iaculis molestie congue et, viverra ut magna. Duis quis massa at libero suscipit volutpat et non erat. Nunc non lorem urna. Vivamus sed placerat nibh, sed luctus lacus. Nullam suscipit dignissim justo, a vestibulum odio feugiat non. Maecenas ultrices condimentum ex. Nam id posuere nisl. Maecenas orci odio, molestie sed aliquam sed, egestas sit amet augue. Sed finibus faucibus malesuada. Ut facilisis, risus ac porttitor rutrum, nibh erat euismod nunc, eu mollis sapien arcu nec diam.</p>\r\n', 1, 'ini-adalah-menu-page', '2018-04-27 06:48:03'),
(2, 'contoh page lagi', '1524802360.png', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eget ultrices quam. Praesent ac tempor massa. Praesent gravida dignissim enim vel cursus. Cras vel consectetur mauris, non elementum dolor. Phasellus pharetra lectus at erat vehicula, eu tincidunt est fringilla. Integer in convallis nibh. Vestibulum ullamcorper magna risus, in sollicitudin mauris gravida ac.</p>\r\n\r\n<p>Nullam quis scelerisque lacus. In congue hendrerit velit, a vestibulum urna rhoncus nec. Etiam velit nunc, iaculis molestie congue et, viverra ut magna. Duis quis massa at libero suscipit volutpat et non erat. Nunc non lorem urna. Vivamus sed placerat nibh, sed luctus lacus. Nullam suscipit dignissim justo, a vestibulum odio feugiat non. Maecenas ultrices condimentum ex. Nam id posuere nisl. Maecenas orci odio, molestie sed aliquam sed, egestas sit amet augue. Sed finibus faucibus malesuada. Ut facilisis, risus ac porttitor rutrum, nibh erat euismod nunc, eu mollis sapien arcu nec diam.</p>\r\n', 1, 'contoh-menu-aktif', '2018-04-27 06:48:03'),
(4, 'Page Subscribe', '1524810560.png', '<p>Ini adalah content dari Page subscribe</p>\r\n', 1, 'subscribe', '2018-04-28 06:40:15'),
(5, 'Galery 1', 'dummy', '<p>@[\"set_album\":\"d83Vufe2\"];</p>\r\n\r\n<p>@[\"slideshow\":\"f83eufV2\"];</p>\r\n\r\n<p>@[\"set_album\":\"d83VufV2\"];</p>\r\n', 2, 'foto', '2018-04-29 12:25:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_general_page`
--
ALTER TABLE `tb_general_page`
  ADD PRIMARY KEY (`id_general_page`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_general_page`
--
ALTER TABLE `tb_general_page`
  MODIFY `id_general_page` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
