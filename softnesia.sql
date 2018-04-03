-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 13, 2018 at 03:29 AM
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
-- Database: `softnesia`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_order` varchar(30) NOT NULL,
  `tgl_order` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `picture_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_provider`, `oauth_uid`, `password`, `first_name`, `last_name`, `email`, `gender`, `locale`, `picture_url`, `profile_url`, `created`, `modified`) VALUES
(2, 'facebook', '1443802269082751', '', 'Junaedi', 'Junaedi', 'desistrom@gmail.com', 'male', 'id_ID', 'https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/18893148_1206127212850259_6897941813978399628_n.jpg?oh=06e1110f4d09aacc155fd1e177b4d6a2&oe=5B1F2925', 'https://www.facebook.com/1443802269082751', '2018-02-06 06:34:12', '2018-02-07 06:10:14'),
(3, 'google', '105424477594854536780', '', 'mohamad', 'junaedi', 'desistrom0@gmail.com', '', 'in', 'https://lh6.googleusercontent.com/-b0_jeHoz9XA/AAAAAAAAAAI/AAAAAAAAAGI/XDS35GnT8Lg/photo.jpg', 'https://plus.google.com/+mohamadjunaedicj', '2018-02-06 06:34:20', '2018-02-07 06:00:05'),
(5, '', 'junaedi', 'telkom', '', '', 'desakuu@gmail.com', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, '', 'junaedi', 'telkom', '', '', 'desakuu@gmail.com', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, '', 'junaedi', 'telkom', '', '', 'desakuu@gmail.com', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, '', 'junaedi', 'telkom', '', '', 'desakuu@gmail.com', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, '', 'admin', 'telkom', '', '', 'admin@gmail.com', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, '', 'admin', 'telkom', '', '', 'admin@gmail.com', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `user_index` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `user_index` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
