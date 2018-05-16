-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 20, 2018 at 10:28 AM
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
-- Table structure for table `tb_about`
--

CREATE TABLE `tb_about` (
  `id_about` int(11) NOT NULL,
  `content` text NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_about`
--

INSERT INTO `tb_about` (`id_about`, `content`, `tgl_update`) VALUES
(1, '<p>Idren adalah usaha jasa pendidikan luar sekolah yang bergerak dibidang bimbingan belajar, didirikan tahun 1982, tepatnya pada tanggal 10 Maret 1982 di Yogyakarta. Program Bimbingan Belajar Primagama memiliki pasar sangat luas (siswa 3,4,5,6 SD – 7,8,9 SMP, dan 10,11,12 SMA IPA/IPS) dengan target pendidikan adalah meningkatkan prestasi akademik di sekolah, Ujian Akhir Sekolah, Ujian Nasional , dan Sukses Ujian Masuk Perguruan Tinggi Negeri/Favorit serta sekolah kedinasan (bagi SMA/SMK).</p>', '2018-04-14 07:48:08');

-- --------------------------------------------------------

--
-- Table structure for table `tb_album_galery`
--

CREATE TABLE `tb_album_galery` (
  `id_album` int(11) NOT NULL,
  `judul_album` varchar(100) NOT NULL,
  `tgl_kegiatan` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_album_galery`
--

INSERT INTO `tb_album_galery` (`id_album`, `judul_album`, `tgl_kegiatan`) VALUES
(1, 'Kegiatan Bakti Sosial', '2018-04-20');

-- --------------------------------------------------------

--
-- Table structure for table `tb_contact`
--

CREATE TABLE `tb_contact` (
  `id_contact` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_contact`
--

INSERT INTO `tb_contact` (`id_contact`, `nama`, `email`, `pesan`) VALUES
(1, 'junaedi', 'admin@gmail.com', 'aku kamu selamanya'),
(2, 'junaedi', 'admin@gmail.com', 'aku kamu selamanya'),
(3, ';lkqwe', 'askda', 'asjdlasdkljalsd'),
(4, 'rieskha', 'rieskha@gmail.com', 'bagaimana caranya untuk kampus swaasta bergabung dengan layanan idren'),
(5, 'aADA', 'DADAD', 'WDWDD'),
(6, 'aADA', 'DADAD', 'WDWDD'),
(7, 'aADA', 'DADAD', 'WDWDD'),
(8, 'asa', 'asa', 'sass'),
(9, 'asa', 'asa', 'sass'),
(10, 'asa', 'asa', 'sass'),
(11, 'asas', 'sas', 'asas');

-- --------------------------------------------------------

--
-- Table structure for table `tb_galery`
--

CREATE TABLE `tb_galery` (
  `id_galery` int(11) NOT NULL,
  `judul` varchar(45) NOT NULL,
  `file_name` varchar(45) NOT NULL,
  `tgl_upload` varchar(20) NOT NULL,
  `id_user_ref` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `type` varchar(5) NOT NULL,
  `id_album` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_galery`
--

INSERT INTO `tb_galery` (`id_galery`, `judul`, `file_name`, `tgl_upload`, `id_user_ref`, `deskripsi`, `status`, `type`, `id_album`) VALUES
(4, 'Sudah Album', '1523422298.png', '2018-04-16', 1, 'Sudah Album', 1, 'image', 1),
(5, 'ini judul gambar', '1522659757.png', '2018-04-17', 1, 'jangan main main', 1, 'image', 1),
(6, 'ini gambar', '1522661309.png', '2018-04-02', 1, 'ini deskripsi gambar', 1, 'image', NULL),
(9, 'qwe', 'https://www.youtube.com/embed/qnsBVFK0qC0', '2018-04-02', 1, 'qwe', 1, 'video', NULL),
(10, 'Develop', '1522664064.png', '2018-04-02', 1, 'Deskripsi Develop', 1, 'image', NULL),
(11, 'Develop Video', 'https://www.youtube.com/embed/SbK3nswyFe0\"', '2018-04-02', 1, 'Deskripsi Delop Video', 1, 'video', NULL),
(12, 'ini judul', '1523422627.png', '2018-04-11', 1, 'judul', 1, 'image', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_hero`
--

CREATE TABLE `tb_hero` (
  `id_hero` int(11) NOT NULL,
  `link_video` varchar(45) NOT NULL,
  `title` varchar(300) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_hero`
--

INSERT INTO `tb_hero` (`id_hero`, `link_video`, `title`, `content`) VALUES
(1, 'https://www.youtube.com/embed/rbvRXK9gMpc', 'Kolaborasi Mudah dengan Jaringan <span class=\"text-danger\">Privat</span>', '<p>Berbagi dan kolaborasi kini jadi lebih aman</p>\r\n\r\n<p>dengan akses jaringan privat.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tb_instansi`
--

CREATE TABLE `tb_instansi` (
  `id_instansi` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nm_instansi` varchar(45) NOT NULL,
  `alamat` text,
  `website` varchar(50) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `gambar` varchar(50) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_instansi`
--

INSERT INTO `tb_instansi` (`id_instansi`, `username`, `password`, `email`, `nm_instansi`, `alamat`, `website`, `phone`, `gambar`, `status`) VALUES
(1, '', '', '', 'SMKN 2 Bojonegoro', 'qwe', 'qwe', 'qwe', '15235188521.png', 2),
(2, '', '', '', 'UNESA', 'asdasdads', 'qeqeqeq', '098111111', '', 2),
(3, '', '', '', 'Akn Bojonegoro', 'jl. bojonegoro', 'www.aknbjn.ad.id', '03530990238', '15235138191.png', 1),
(4, '', '', '', 'UI', 'jl. aku ada', 'www.ui.ac.id', '08123992', '1523512503.png', 0),
(5, '', '', '', 'UNY', 'jl. jogja kembali', 'www.uny.ad.ic', '08233141231', '1523513759.png', 0),
(6, '', '', '', 'Universitas Trisakti', 'Jl. kyai sakti no 23 kebayoran baru jakarta selatan', 'www.trisakti.ac.id', '09123023323', '1523518388.jpg', 0),
(7, '', '', '', 'Universitas Nasional', 'Lorem ipsum dolor sit amet', 'www.unasional.ac.id', '0323138239', '1523518591.jpg', 0),
(8, '', '', '', 'Universitas Andalas', 'jl. untung suropati no.18 kota makasar', 'andalas.ac.id', '0549988839', '1523518657.png', 0),
(9, 'utmsakti', 'qwerty', '', 'Universitas Trunojoyo', 'kab. sampang madura', 'www.utm.ac.id', '082331472499', '1524121085.jpg', 0),
(10, 'jun', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'admin@gmail.com', 'qwerty', 'qwerty', 'qwerty', '9678', NULL, 1),
(11, 'desistrom1', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'admin@gmail.com', 'Universitas Negeri Jember', 'Kab. Jember', 'www.unej.ac.id', '0353993493', NULL, 1),
(12, 'desistrom2', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'desistrom1@gmail.com', 'Universitas Negeri Jember', 'Kab. Jember', 'www.unej.ac.id', '0353993493', NULL, 0),
(13, 'desistrom3', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'desistrom1@gmail.com', 'Universitas Negeri Jember', 'Kab. Jember', 'www.unej.ac.id', '0353993493', NULL, 0),
(14, 'desistrom4', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'desistrom1@gmail.com', 'Universitas Negeri Jember', 'Kab. Jember', 'www.unej.ac.id', '0353993493', NULL, 2),
(15, 'desistrom5', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'desistrom1@gmail.com', 'Universitas Negeri Jember', 'Kab. Jember', 'www.unej.ac.id', '0353993493', NULL, 2),
(16, 'SAS', '051d567f3f9f17983b9b883bd19437f8ef049f4b', 'dikapratana11@gmail.com', 'ASAS', 'SAS', 'ASAS', 'SASA', NULL, 1),
(17, 'sasa', 'cbcae5d009479f9a4c234695b5183ce1aac04bf0', 'asasas', 'asasaaa', 'asas', 'sasa', 'asasa', NULL, 0),
(18, 'asas', 'ac51d9723bafb0097b72e34fc8e2262c85337059', 'asas', 'ass', 'asas', 'asas', 'asasas', NULL, 0),
(19, 'asa', '24abfc38cdd9025044fb2c09a7e8e6e004d9da08', 'sas', 'asa', 'asasa', 'asa', 'asas', NULL, 0),
(20, 'dwdwd', '0c6f782cca5e78db2c87154616daee5069a03b5e', 'dada', 'as', 'dadada', 'wdw', 'dad', NULL, 0),
(21, 'iuhjih', '0e0a0056f319aba2d50020bb8333cf21d1ef3906', 'dikapratana11@gmail.com', 'akn', 'bjn', 'qhwquhw', '09888', NULL, 0),
(22, 'asasas', '584e55938afb772eba843666c6f5cd9bbfec8fd7', 'asasas', 'saaa', 'assas', 'asas', 'asasa', NULL, 0),
(23, 'K', '93a96017c4e654c039f985e374f9b10c741e5bc2', 'L', 'A', 'A', 'K', 'K', NULL, 0),
(24, 'A', 'bd605412133b28b10c5fa7a45fce29df67c18bd7', 'A', 'A', 'A', 'A', 'A', NULL, 0),
(25, 'telkom-university', 'a75dea5c8a5f229d83ad962ce244608aff0a4e51', 'admin@universitas-telkom.ac.id', 'universitas telkom', 'jl.anjasmara no.19 bandung', 'http://universitas-telkom.ac.id', '0229988723', NULL, 0),
(26, 'putra_rieskha', 'a75dea5c8a5f229d83ad962ce244608aff0a4e51', 'rieskha@gmail.com', 'putra university', 'bojonegoro', 'putra-university.id', '08135847834988', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_email`
--

CREATE TABLE `tb_kategori_email` (
  `id_kategori_email` int(11) NOT NULL,
  `nm_kategori` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori_email`
--

INSERT INTO `tb_kategori_email` (`id_kategori_email`, `nm_kategori`) VALUES
(1, 'registrasi'),
(2, 'belum di proses'),
(3, 'Sudah di Proses'),
(4, 'Newsleter');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_news`
--

CREATE TABLE `tb_kategori_news` (
  `id_kategori_news` int(11) NOT NULL,
  `nm_kategori` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori_news`
--

INSERT INTO `tb_kategori_news` (`id_kategori_news`, `nm_kategori`) VALUES
(1, 'sekolah'),
(2, 'kampus'),
(3, 'rss');

-- --------------------------------------------------------

--
-- Table structure for table `tb_layanan`
--

CREATE TABLE `tb_layanan` (
  `id_layanan` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `content` text NOT NULL,
  `gambar` varchar(45) NOT NULL,
  `kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_layanan`
--

INSERT INTO `tb_layanan` (`id_layanan`, `title`, `content`, `gambar`, `kategori`) VALUES
(1, 'Kemudahan Berbagi', '<p>Melalui jaringan privat, kolaborasi dan pengembangan kegiatan di perguruan tinggi semakin cepat dan nyaman</p>', '1523494367.jpg', 1),
(2, 'Cloud Federation', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tempor fermentum erat, vel dictum ex blandit at. Nulla scelerisque vehicula mauris, sed suscipit leo mollis sed. Proin at efficitur leo. Nulla facilisi. Phasellus felis mi, auctor id vestibulum a, convallis nec massa. Maecenas vehicula libero at odio suscipit porta. Donec et orci sem. Etiam tristique nisi nunc, in auctor libero volutpat quis. In odio augue, volutpat volutpat scelerisque nec, pretium a urna. Vivamus rhoncus, libero a finibus semper, metus nulla laoreet massa, a posuere turpis sem eu sem. Suspendisse potenti. Quisque eget tincidunt lacus. Etiam consectetur tristique libero a commodo.</p>\r\n\r\n<p>Pellentesque commodo, ipsum et volutpat tempor, lectus dui accumsan lacus, sit amet tincidunt nibh justo in massa. Nullam egestas arcu a pellentesque euismod. Aliquam ac elit ex. Nunc malesuada mi sed risus vulputate lacinia. Maecenas auctor neque at vehicula dictum. Nullam erat dolor, condimentum nec feugiat lacinia, ultricies id nunc. Phasellus et tortor ut arcu aliquam semper non ut tellus. Aliquam erat volutpat. Quisque at fermentum lorem.</p>', '1523691293.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_logo`
--

CREATE TABLE `tb_logo` (
  `id_logo` int(11) NOT NULL,
  `logo` varchar(45) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_logo`
--

INSERT INTO `tb_logo` (`id_logo`, `logo`, `status`) VALUES
(1, '1523759185.png', 1),
(2, '1523693460.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_news`
--

CREATE TABLE `tb_news` (
  `id_news` int(11) NOT NULL,
  `id_kategori_ref` int(11) NOT NULL,
  `Id_user_ref` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_aktif` int(1) NOT NULL DEFAULT '1',
  `kategori_rss` varchar(45) NOT NULL,
  `link` varchar(100) NOT NULL,
  `img` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_news`
--

INSERT INTO `tb_news` (`id_news`, `id_kategori_ref`, `Id_user_ref`, `judul`, `content`, `created`, `is_aktif`, `kategori_rss`, `link`, `img`) VALUES
(1, 1, 1, 'ini adalah judul berita', '<p>ini berita</p>', '2018-04-12 02:44:48', 1, '', 'ini-adalah-judul-berita', NULL),
(42, 2, 1, 'News 12 023123', '<p>ini adalah isi berita</p>', '2018-04-15 02:14:19', 1, '', 'news-12-023123', '1523462843.png'),
(43, 2, 1, 'Berita terbaru', '<p>ini adalah isi berita</p>', '2018-04-15 02:14:31', 1, '', 'berita-terbaru', '1523462843.png'),
(45, 2, 1, 'iniininiinini', '<p>qqqqqqqqqqqqqqqqqq</p>', '2018-04-14 04:46:47', 1, '', 'iniininiinini', '1523681207.jpg'),
(46, 3, 1, 'Antisipasi dinamika kawasan Arktik', '', '2018-04-12 02:00:43', 1, 'Analisis', 'http://analisis.kontan.co.id/news/antisipasi-dinamika-kawasan-arktik', 'http://photo.kontan.co.id/photo/2011/06/10/781428881t.jpg'),
(47, 3, 1, 'Target beda pemerintah dan pasar', ' <p></p> <p></p> ', '2018-04-12 02:00:50', 1, 'Analisis', 'http://analisis.kontan.co.id/news/target-beda-pemerintah-dan-pasar', 'http://photo.kontan.co.id/photo/2016/08/30/1429956166t.jpg'),
(48, 3, 1, 'Ekonomi dan olahraga', '', '2018-04-12 02:01:20', 1, 'Analisis', 'http://analisis.kontan.co.id/news/ekonomi-dan-olahraga', 'http://photo.kontan.co.id/photo/2016/01/26/1564395447t.jpg'),
(49, 3, 1, 'Mengadang kolonialisme data', ' <p>Sebelum dunia dihebohkan oleh skandal data Cambridge Analytica, Joseph Smith, pakar TI sekaligus Direktur Cloud Services pada pertengahan tahun silam mengingatkan bahwa: <em>Data is not the new oil. It is the new land that is being rapidly colonised by corporations with the means to exploit this new resource. The power currently sits with the few with means to navigate uncharted waters and territories of the new world.</em></p> <p>Data kini tengah dieksploitasi secara besar-besaran oleh&nbsp; para industri, perusahaan teknologi, dan bahkan partai politik. Dan malangnya, sangat sedikit dari kita yang menyadari hal itu.</p> <p>Kebanyakan dari kita menyerahkan detail informasi pribadi kepada platform media sosial, bermacam aplikasi dan lain sebagainya tanpa membaca betul <em>terms and conditions</em> (syarat dan ketentuan). Kita terlalu malas barangkali untuk membaca panjang lebar, dan secara tidak sadar telah melepaskan hak atas privasi diri.</p> <p>Lalu mau tak mau kita sudah berada di bawah kontrol dan permainan kolonialisme data. Tatkala sedang berkeluh-kesah, berdebat dengan orang lain yang berlainan paham, atau apapun status yang kita buat di media sosial, para pengontrol data tengah merencanakan pemasaran produk, strategi kampanye politik, dan merancang industri baru.</p> <p>Investigasi New York Times menggambarkan, Cambridge Analytica tak hanya mempermainkan penduduk Amerika, juga telah bereksperimen di luar negeri. Di negara-negara dengan aturan privasi lemah atau bahkan tidak ada. Sebelum dunia gempar dengan kasus permainan data Cambridge Analytica dalam kampanye politik Donald Trump, lembaga ini telah melakukan studi kasus di banyak negara di Afrika, Asia, Timur Tengah, Eropa, Amerika Utara, Amerika Latin dan Karibia.</p> <p>Facebook, Twitter, Google, dan perusahaan teknologi lainnya dapat dikatakan telah memperkuat pekerjaan perusahaan semacam Cambridge Analytica. Yang kemudian terlibat dalam meracuni demokrasi di seluruh dunia.</p> <p>Di Sri Lanka, Facebook telah dituduh mengipasi ujaran kebencian yang menyebabkan kerusuhan anti-Muslim. Memaksa negara itu untuk melarang media sosial setelah bentrokan yang menyebabkan sedikitnya dua orang tewas (The Guardian, 7/3/2018). Tim PBB yang menyelidiki genosida di Myanmar mengatakan, Facebook digunakan untuk menyebarkan vitriol terhadap Muslim Rohingya (The National, 17/3/2018).</p> <p>Pertempuran politik di Kamboja antara tokoh oposisi dan perdana menteri otoriter negara itu atas tuduhan likes palsu di halaman Facebook telah diajukan ke pengadilan AS (The New York Times, 9/2/2018). Kelompok teroris yang bermarkas di Somalia, Al-Shabab, menyiarkan serangannya di twitter terhadap Mal Westgate di Nairobi pada 2013 (Telegraph, 22/9/2013).</p> <p>Melihat hal tersebut, apakah menggunakan informasi yang telah diberikan itu salah? Terlepas ada atau lemahnya perlindungan data pribadi di suatu negara, kejadian semacam itu telah membawa dampak yang berbahaya dan buruk sekali.</p> <p>Persoalannya, jawaban para pengontrol data, yang merekayasa suatu hal sangat tak etis memberi jawaban, who&rsquo;s put that out? Sebagaimana ujaran Mark Turnbull, Direktur Pelaksana Cambridge Analytica, melontarkan pertanyaan balik ketika ditanya wartawan. Ini bukan sekedar soal telah diberikannya akses informasi terhadap data tersebut.</p> <p>Pertama, kasus seperti penargetan psikografis dalam bentuk gim di Facebook, yang kemudian mengantongi data pengguna, dan dimanfaatkan untuk kepentingan politik jelas telah melampaui syarat dan ketentuan penggunaan data tersebut. &nbsp;</p> <p>Kedua, perlu rasanya diterangkan kepada pengguna bahwa data mereka sangat berharga dan berhati-hatilah saat pemberian akses informasi. McKinsey Global Institute menyebutkan, nilai ekonomi data kini berada pada kisaran US$ 3 triliun. Angka yang tak sempat terbayangkan sebelumnya bagi kita saat mendapat layanan media sosial yang gratis itu.</p> <br> ', '2018-04-12 02:01:27', 1, 'Analisis', 'http://analisis.kontan.co.id/news/mengadang-kolonialisme-data', 'http://photo.kontan.co.id/photo/2016/02/04/201115483t.jpg'),
(50, 3, 1, 'Paling utama: trust', '', '2018-04-12 02:01:57', 1, 'Analisis', 'http://analisis.kontan.co.id/news/paling-utama-trust', 'http://photo.kontan.co.id/photo/2016/09/21/1118944892t.jpg'),
(51, 3, 1, 'Candaan pemimpin', ' <p>Ada kejadian menarik dalam beberapa pekan maupun dalam hari terakhir ini. Terakhir adalah candaan Elon Musk, chief executive officer (CEO) Tesla Inc, produsen mobil listrik nomor wahid di Amerika Serikat yang menyebutkan perusahaan yang ia pimpin, Tesla Inc. hendak bangkrut. </p> <p>Pernyataan Musk ini muncul dalam cuitan di akun Twitter-nya tepat 1 April 2018. Ia menyebut meskipun sudah ada upaya intensif untuk mengumpulkan uang, &quot;Termasuk penjualan massal Telur Paskah, kami sedih untuk melaporkan bahwa Tesla telah benar-benar dan benar-benar bangkrut,&quot; cuitan-nya. </p> <p>Sebenarnya di hari yang sama, Musk sudah memberikan klarifikasi an bahwa candaan ini dia lemparkan bagian April Mop. Tak kurang dari 25.000 komentar dan 130.000 like di cuitan Musk. Namun, sehari setelah cuitan candaan yang ternyata April Mop itu, saham Tesla sempat terjun bebas hingga 7%, meskipun akhirnya ditutup hanya terkoreksi 5% menjadi US$ 252.48 per saham. </p> <p>Enggak mau candaan itu berdampak pada sentimen negatif bagi perusahaan, pada 3 April 2018 Tesla membeberkan kinerja mereka sepanjang tiga bulan pertama 2018. Mereka menegaskan tak ada masalah di perusahaan ini. Total produksi pada kuartal I-2018 mencapai&nbsp; 34.494 unit kendaraan atau naik 40% dibandingkan dengan kuartal IV-2017. </p> <p>Pada periode yang sama sebanyak 29.980 kendaraan mereka kirimkan ke konsumen. Tapi dari sisi target produksi mereka mengklaim di bawah target 5.000 unit per pekan. </p> <p>Musk sebagai orang nomor satu di Tesla bertanggungjawab dengan cuitannya dan juga menegaskan tahun ini tak butuh lagi suntikan dana segar. Artinya mereka tak akan menambah utang maupun suntikan modal atawa ekuitas segar dari investor untuk tetap hidup dan sehat. </p> <p>Beda dengan di Amerika, di negeri kita, cuitan asal bukanlah hal tabu. Bahkan tidak perlu ada klarifikasi apakah cuitan-nya itu benar, salah ucap, sekadar gurauan, atau memang salah adanya. </p> <p>Pertama cuitan seorang ketua partai yang menyebut Indonesia bakal bubar 2030, atau tudingan elite politik korup. Tak perlu ada penjelasan, toh semua orang tahu pernyataan ini hanya retorika politik yang tidak perlu pertanggungjawaban di dunia. </p> <p>Kedua, cuitan politisi gaek yang menyebut bagi-bagi sertifikat sebagai penipuan dan hampir semua lahan dimiliki asing. Tidak perlu repot-repot ada penjelasan benar atau salah, yang penting pernyataannya bisa bikin heboh. &nbsp; </p> ', '2018-04-12 02:01:59', 1, 'Analisis', 'http://analisis.kontan.co.id/news/candaan-pemimpin', 'http://photo.kontan.co.id/photo/2016/01/19/1478173161t.jpg'),
(52, 3, 1, 'Menyoal tuntutan dari ojek daring', ' <p>Penggunaan sepeda motor sebagai sebuah layanan angkutan adalah sebuah disrupsi dalam masalah transportasi kita, apabila tidak ingin menyebutnya sebagai pelanggaran hukum. Dalam UU No. 22 Tahun 2009 tentang Lalu Lintas dan Angkutan Jalan, sudah jelas diartikan dalam Pasal 47 ayat (2) jo. ayat (3) bahwa sepeda motor bukanlah angkutan umum. Namun, apalah arti hukum di negara seperti Indonesia ini, bukan?</p> <p>Terlepas dari perdebatan apakah sepeda motor adalah angkutan umum, tak bisa dipungkiri banyak hidup yang kini bergantung kepadanya. Bahkan, ojek berbasis daring sempat dijadikan primadona. Malah, bisa jadi raksasa ekonomi baru akan muncul dari tangan para enterpreneur yang menekuni bidang ini.</p> <p>Jika dikelola tepat, pengembahan enterpreneurship yang sudah on-track selama ini akan berbuah manis ke depannya. William J. Baumol, dkk. (2007), dalam Good Capitalism, Bad Capitalism, and The Economics of Growth and Prosperity mengemukakan empat elemen dari suatu mesin pertumbuhan ekonomi untuk menciptakan the successful entrepreneurial economy, yaitu kemudahan untuk memulai usaha, penghargaan terhadap aktivitas enterpreneur yang sudah berjalan, pemerintah harus berfokus untuk memperbesar the economy pie ketimbang membagi-baginya, serta adanya insentif bagi dunia usaha untuk bisa bertumbuh dan berinovasi.</p> <p>Sayangnya, fenomena yang terjadi baru-baru ini menjadi pertanda bahwa elemen kedua sampai keempat yang digagas oleh Baumol, dkk. tersebut akan mendapat tantangan besar untuk diwujudkan di Indonesia. Apalagi, setelah pemerintah mengabulkan desakan dari pressure group yang menuntut adanya peningkatan tarif angkutan ojek berbasis daring dengan dalih agar kesejahteraan para pengemudi ojek tersebut meningkat. Saat ini, pemerintah memang relatif berhasil untuk memenuhi elemen pertama yaitu kemudahan dalam berusaha. Telah banyak enterpreneur baru tumbuh di Indonesia, terutama yang memanfaatkan teknologi sebagai basis berusaha.</p> <p>Namun, penghargaan terhadap aktivitas enterpreneur yang dimaksudkan oleh Baumol, dkk, bukanlah dalam bentuk bintang jasa. Melainkan adanya jaminan perlindungan hukum. Maka, hukum sebagai pranata sosial menjadi mutlak untuk menunjang keberhasilan ekonomi. Menegasikan hukum merupakan langkah awal untuk merubuhkan sendi-sendi pembangunan ekonomi itu sendiri.</p> <p>Dalam konteks inilah maka aksi para pengemudi ojek berbasis daring baru-baru ini menarik untuk dicermati dari kacamata legal formal. Mengingat dalam menyikapi semakin sulitnya perekonomian, terutama soal kesejahteraan, para pengemudi ojek berbasis daring tersebut menyuarakan kegetirannya pada pemerintah.</p> <p>Padahal, jika mengacu pada regulasi yang ada, apa yang disuarakan oleh para pengemudi tersebut seharusnya dapat diselesaikan lebih dahulu dengan penyedia platform. Bisa jadi, persoalan kesejahteraan ini adalah akibat tata kelola di dalam penyedia platform itu sendiri dalam membagi hasil keuntungannnya dengan para pengemudi. Maka, terlalu cepat untuk mengambil kesimpulan soal kesejahteraan yang dialami para pengemudi adalah akibat tarif murah. Namun, konklusi yang prematur ini justru diamini oleh pemerintah dengan mengabulkan permintaan para pengemudi.</p> <p>Tentunya tidak ada yang salah dengan respon cepat pemerintah. Tapi, fenomena ini memperlihatkan betapa reaktifnya kita dalam bernegara.</p> <p>Jika kita membandingkan dengan perspektif hubungan industrial yang sudah ada selama ini, terutama dalam UU No. 13 Tahun 2003 tentang Ketenagakerjaan, mekanisme penyelesaian perselisihan sudah sangat jelas yaitu melalui musyawarah mufakat atau jika tidak dapat diselesaikan maka dapat menempuh jalur legal melalui Pengadilan Hubungan Industrial. Apalagi, persoalan kesejahteraan pekerja masuk dalam ruang lingkup perselisihan hubungan industrial.</p> <p>Namun, persoalan angkutan daring ini menjadi anomali tersendiri. Mengingat tanpa pernah terdengar ada pembicaraan bipatride antara perwakilan pengemudi dengan perusahaan, tuntutan tiba-tiba ditujukan kepada pemerintah. Disadari atau tidak, pola penyelesaian perselisihan hubungan industrial yang kerap memakai tekanan massa dan memanfaatkan momentum politik telah menumpulkan hukum sebagai sarana penyelesaian sengketa.</p> <p>Jika tidak dicermati, apa yang terjadi di bisnis ojek berbasis daring ini akan menjadi preseden buruk ke depannya bagi pembangunan entrepreneurship bidang lain. Selama tekanan massa menjadi faktor utama menentukan kebijakan, pembangunan entrepreneurship yang sehat tidak akan terwujud.</p> <p>Semakin sering pemerintah melakukan by pass atas suatu perselisihan yang timbul di dunia usaha, rakyat akan semakin asing dengan cara penyelesaian yang rasional dan tidak mengandalkan kekuasaan semata. Pemerintah harus mulai belajar untuk meminimalisir intervensi dalam penyelesaian sengketa yang ada di masyarakat. Lain kali, biarkanlah kanal legal-formal bekerja.</p> <br> ', '2018-04-12 02:02:02', 1, 'Analisis', 'http://analisis.kontan.co.id/news/menyoal-tuntutan-dari-ojek-daring', 'http://photo.kontan.co.id/photo/2018/03/27/1253420014t.jpg'),
(53, 3, 1, 'SOFR lebih aman dan murah', ' <p>Bank sentral Amerika Serikat (AS) The Federal Reserve merilis acuan tarif pembiayaan semalam baru atawa Secured Overnight Financing Rate (SOFR). Niatnya, acuan baru ini bisa menjadi alternatif pengganti London Inter-bank Offered Rate (LIBOR). </p> <p>Penggunaan LIBOR di AS sebenarnya kerap disalahgunakan. Contoh, di 2005 dan 2008, pegawai Barclays berulangkali meminta bank-bank lain memasukkan tingkat suku bunga LIBOR yang menguntungkan posisi mereka. Selain itu ada kolusi perbankan untuk memanipulasi tingkat suku bunga LIBOR. </p> <p>Pada akhir 2007 dan awal 2009, Barclays juga mengajukan suku bunga LIBOR rendah. Padahal saat itu krisis moneter sedang mengguncang. Dengan cara ini, Barclays mencoba menyembunyikan likuiditas keuangannya yang sekarat. </p> <p>Bila mengajukan suku bunga LIBOR tinggi, Barclays khawatir akan menerima hukuman pasar karena investor akan berpendapat bank tersebut sedang tidak sehat. Akhirnya, di 2012, bank internasional yang terlibat didenda ratusan juta dollar AS. </p> <p>Saya menilai kemunculan SOFR merupakan langkah antisipasi dari Gubernur baru The Fed atas berkurangnya kredibilitas LIBOR menyusul skandal tersebut. Karena LIBOR juga mencakup tujuh kurs internasional, salah satunya dollar AS. </p> <p>Menurut saya, SOFR memiliki beberapa kelebihan yang juga bisa dirasakan oleh pasar finansial Indonesia. SOFR cenderung lebih aman karena di-back up oleh collateral. SOFR itu secured, LIBOR unsecured. </p> <p>Karena unsecured, bunga LIBOR akan lebih tinggi dibandingkan SOFR yang secured. Lantaran unsecured tadi, LIBOR memasukkan risk premium yang lebih tinggi daripada SOFR. Jadi, seharusnya SOFR memiliki tingkat bunga lebih rendah dibandingkan LIBOR. </p> <p>Oleh karena itu, pelaku pasar uang akan beralih ke SOFR yang memiliki rate lebih rendah dibandingkan LIBOR. SOFR juga memberikan cerminan kondisi pasar yang lebih riil. Saya melihat, SOFR secara bertahap akan mengambilalih popularitas LIBOR. </p> ', '2018-04-12 02:02:06', 1, 'Analisis', 'http://analisis.kontan.co.id/news/sofr-lebih-aman-dan-murah', 'http://photo.kontan.co.id/photo/2018/02/12/1780768787t.jpg'),
(54, 3, 1, 'Angkutan daring', ' <p>Masalah angkutan berbasis aplikasi enggak ada habisnya. Peraturan Menteri Perhubungan (Permenhub) Nomor 108 Tahun 2017 tentang Penyelenggaraan Angkutan Orang Dengan Kendaraan Bermotor Umum Tidak Dalam Trayek tidak bergigi. </p> <p>Contoh, masih banyak sopir taksi daring yang belum memenuhi persyaratan sesuai beleid tersebut. Misalnya, pengemudi harus memiliki surat izin mengemudi (SIM) umum, lalu melakukan uji KIR. Kementerian Perhubungan mencatat, di Jabodetabek, baru 20% pengemudi yang menjadi mitra perusahaan layanan transportasi berbasis aplikasi pemesanan (on-demand) yang sudah melengkapi semua ketentuan dalam Permenhub No. 108/2017. </p> <p>Tambah lagi, pertumbuhan jumlah sopir taksi online yang sangat pesat juga menyulut masalah. Alhasil, pertengahan Maret lalu pemerintah memerintahkan perusahaan layanan transportasi berbasis aplikasi pemesanan menghentikan sementara atawa moratorium rekrutmen mitra pengemudi. Kebijakan ini sekaligus menjadi cara pemerintah untuk melakukan penataan supir taksi daring sesuai aturan. </p> <p>Selain itu, Kementerian Perhubungan tengah merancang Permenhub yang bakal mewajibkan perusahaan layanan transportasi berubah status jadi perusahaan angkutan umum. Calon aturan tersebut menjadi jalan tengah pemerintah untuk mengatasi kisruh hubungan perusahaan layanan transportasi dengan para mitra pengemudi. </p> <p>Problemnya, pemerintah tidak bisa mengatur ojek daring yang jumlah pengemudinya juga tumbuh sangat pesat. Maklum, Undang-Undang No. 22/2009 tidak mengakui sepeda motor sebagai angkutan umum. Alhasil, pemerintah juga tidak bisa mengatur tarif ojek daring yang sempat menyulut demo besar dari mitra pengemudi. </p> <p>Tarif ojek daring yang saat ini berkisar Rp 1.500 sampai Rp 1.600 per km di mata pengemudi terlalu murah. Sejatinya, setelah pemerintah melakukan mediasi, perusahaan layanan transportasi sepakat mengerek tarif jadi Rp 2.000 per km yang berlaku mulai Senin (2/4) lalu. Tapi tampaknya, perusahaan layanan transportasi belum melaksanakan kesepakatan itu. Menurut Kementerian Perhubungan, mereka juga masih melanggar tarif batas bawah untuk taksi daring. </p> <p>Buat pengguna, kenaikan tarif angkutan daring jelas memberatkan. Di satu sisi mendongkrak daya beli pengemudi. Di sisi lain menggerus daya beli pengguna. Cuma, jumlah pengguna lebih banyak. </p> ', '2018-04-12 02:02:09', 1, 'Analisis', 'http://analisis.kontan.co.id/news/angkutan-daring', 'http://photo.kontan.co.id/photo/2016/01/19/520750571t.jpg'),
(55, 3, 1, 'Potensi pengembangan gas batubara', ' <p>Sejak akhir tahun 2017, ketika harga batubara terus menanjak, PT Perusahaan Listrik Negara (PLN) menjadi salah satu perusahaan yang paling terkena efek negatif. Sebanyak 57%-60% pembangkit listrik yang dimiliki PLN menggunakan batubara sebagai sumber energi.</p> <p>Dalam kontrak penjualan tenaga listrik antara PT PLN dan pembangkit listrik, pengadaan batubara sebagai bahan baku utama listrik merupakan tanggung jawab PLN. Akibatnya kenaikan harga batubara berarti meningkatkan biaya pokok produksi pembangkit listrik. Selama tahun 2017, beban PLN untuk batubara meningkat menjadi Rp 14 triliun lantaran rata-rata harga batubara pada saat itu meningkat menjadi US$ 80/ ton sementara di RKAP (Rencana Kerja dan Anggaran Perusahaan) PLN hanya US$ 63 per ton .</p> <p>Terbitnya Keputusan Menteri (Kepmen) ESDM Nomor 1395 K/30/MEM/2018 pada 9 Maret 2018 tentang Harga Batubara Untuk Penyediaan Tenaga Listrik Untuk Kepentingan Umum merupakan angin segar bagi PT PLN. Berdasarkan Kepmen tersebut maka pemerintah menetapkan batas atas bagi harga batubara yang dijual kepada PT PLN untuk pasokan listrik nasional.</p> <p>Terbitnya Keputusan Menteri (Kepmen) ESDM Nomor 1395 K/30/MEM/2018 pada 9 Maret 2018 tentang Harga Batubara Untuk Penyediaan Tenaga Listrik Untuk Kepentingan Umum merupakan angin segar bagi PT PLN. Berdasarkan Kepmen tersebut maka pemerintah menetapkan batas atas bagi harga batubara yang dijual kepada PT PLN untuk pasokan listrik nasional.</p> <p>Harga batubara dibatasi menjadi maksimal sebesar US$ 70 per ton untuk kalori 6.322 GAR atau mengikuti Harga Batubara Acuan (HBA) jika HBA berada di bawah US$ 70 per ton. Sementara untuk nilai kalori lainnya akan dikonversi sesuai dengan peraturan yang berlaku. Kebijakan pemerintah ini merupakan lanjutan dari kebijakan pemerintah sebelumnya pada bulan Januari 2018 yang menetapkan 25% sebagai persentase minimal batubara yang dijual untuk keperluan dalam negeri (DMO) berdasarkan Kepmen ESDM No. 23K/30/MEM/2018.</p> <p>Kebijakan pemerintah tersebut menunjukkan respon cepat dalam mengantisipasi harga batubara yang tinggi yang dapat merugikan PLN. Hal ini juga menunjukkan kesungguhan pemerintah dalam rangka mencapai elektrifikasi 100% bagi seluruh rakyat Indonesia. Selain itu komitmen pemerintah untuk tidak mengerek tarif dasar listrik hingga akhir tahun 2019 tetap dipertahankan. Keputusan ini disambut baik PT PLN, namun tentu saja ada juga dampak negatif yang terjadi.</p> <p>Kebijakan tentang harga khusus batubara menimbulkan dampak yang kurang baik bagi iklim investasi dan bisnis di sektor pertambangan batubara. Dengan adanya batas atas harga jual di dalam negeri maka potensi terjadinya peningkatan keuntungan bagi pengusaha pertambangan batubara menjadi terbatas atau berkurang. Reaksi kurang positif dari dunia bisnis dapat terlihat dari menurunnya harga saham emiten batubara di Bursa Efek Indonesia setelah kebijakan harga khusus batubara tersebut dikeluarkan.</p> <p>Sebenarnya bukan hanya pendapatan pengusaha yang berkurang, penerimaan negara juga. Direktur Jenderal Anggaran Kementerian Keuangan Askolani memperkirakan bahwa dari sektor PNBP akan terjadi penurunan pendapatan Rp 4-5 triliun, sementara dari sektor pajak akan menurun sekitar Rp 2&ndash;3 triliun (KONTAN, 19 Maret 2018).</p> <p>Dalam rangka memperkecil dampak negatif tersebut, pemerintah mengambil langkah antisipasi. Untuk pengusaha pertambangan batubara, pemerintah memberikan kompensasi dengan membolehkan pengusaha meningkatkan produksinya hingga 10% di atas ketentuan. Mengenai penurunan penerimaan negara, masih dapat terkompensasi dengan adanya peningkatan pendapatan sekitar Rp 14 triliun akibat tingginya harga batubara.</p> <br> ', '2018-04-12 02:02:12', 1, 'Analisis', 'http://analisis.kontan.co.id/news/potensi-pengembangan-gas-batubara', 'http://photo.kontan.co.id/photo/2017/11/08/1190550966t.jpg'),
(56, 1, 1, 'Pembangunan Rakyat', '<p>Ini adalah content berita</p>', '2018-04-12 02:25:57', 1, '', 'http://localhost/idren/pembangunan-rakyat', '1523499957.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notifikasi_email`
--

CREATE TABLE `tb_notifikasi_email` (
  `id_notifikasi_email` int(11) NOT NULL,
  `id_kategori_email_ref` int(11) NOT NULL,
  `subject` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_notifikasi_email`
--

INSERT INTO `tb_notifikasi_email` (`id_notifikasi_email`, `id_kategori_email_ref`, `subject`, `title`, `content`) VALUES
(1, 2, 'desistrom0@gmail.com', 'EWEWEWE', '<p>EEWEWEWEWEWE</p>'),
(2, 1, 'desistrom1@gmail.com', 'Register', '<p>Registrasi berhasil</p>\r\n\r\n<ul>\r\n <li>Nama : M. Puji Junaedi</li>\r\n <li>Kelas : 12 mi 2</li>\r\n <li>absen 2</li>\r\n</ul>'),
(3, 1, 'desistrom1@gmail.com', 'Registrasi', '<p>Registrasi berhasil</p>\r\n\r\n<ul>\r\n <li>Nama : M. Puji Junaedi</li>\r\n <li>Kelas : 12 mi 2</li>\r\n <li>absen 2</li>\r\n</ul>'),
(4, 2, 'desistrom1@gmail.com', 'Permintaan sedang di proses', '<p>aku adalah</p>\r\n\r\n<p>Contents</p>\r\n\r\n<p>  [hide] </p>\r\n\r\n<ul>\r\n <li>1Etymology</li>\r\n <li>2History\r\n <ul>\r\n  <li>2.1Pre-Internet</li>\r\n  <li>2.2History</li>\r\n </ul>\r\n </li>\r\n <li>3In different media\r\n <ul>\r\n  <li>3.1Email</li>\r\n  <li>3.2Instant messaging</li>\r\n  <li>3.3Newsgroup and forum</li>\r\n  <li>3.4Mobile phone</li>\r\n  <li>3.5Social networking spam</li>\r\n  <li>3.6Social spam</li>\r\n  <li>3.7Online game messaging</li>\r\n  <li>3.8Spam targeting search engines (spamdexing)</li>\r\n  <li>3.9Blog, wiki, and guestbook</li>\r\n  <li>3.10Spam targeting video sharing sites</li>\r\n  <li>3.11SPIT</li>\r\n  <li>3.12Academic search</li>\r\n  <li>3.13</li>\r\n </ul>\r\n </li>\r\n</ul>'),
(5, 1, 'desistrom1@gmail.com', 'Registrasi', '<p>Data Anda</p>\r\n\r\n<ul>\r\n <li>Nama : Junaedi</li>\r\n <li>Kelas : 4.1/22</li>\r\n <li>Alamat : Bojonegoro</li>\r\n</ul>'),
(6, 1, 'desistrom1@gmail.com', 'Registrasi Berhasil', '<ul>\r\n <li>Nama : Dika</li>\r\n <li>Alamat : Panjunan</li>\r\n <li>Asal : Bojonegoro</li>\r\n</ul>'),
(7, 1, 'desistrom1@gmail.com', 'Registrasi Berhasil', '<ul>\r\n <li>Nama : Dika</li>\r\n <li>Alamat : Panjunan</li>\r\n <li>Asal : Bojonegoro</li>\r\n</ul>'),
(8, 1, 'desistrom1@gmail.com', 'Makan Bang', '<p>Makan</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tb_setting_email`
--

CREATE TABLE `tb_setting_email` (
  `id_setting_email` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_setting_email`
--

INSERT INTO `tb_setting_email` (`id_setting_email`, `email`, `nama_user`) VALUES
(1, 'no-reply@idren.id', 'IDREN'),
(2, 'desistrom0@gmail.com', 'IDREN'),
(3, 'no-reply@idren.id', 'IDREN');

-- --------------------------------------------------------

--
-- Table structure for table `tb_setting_user`
--

CREATE TABLE `tb_setting_user` (
  `id_setting` int(11) NOT NULL,
  `profit` text NOT NULL,
  `cara` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_setting_user`
--

INSERT INTO `tb_setting_user` (`id_setting`, `profit`, `cara`) VALUES
(1, '<p>Keanggotan IdREN terbuka bagi institusi pendidikan dan penelitian di Indonesia.  Prosedur operasi baku untuk bergabung dalam jaringan IdREN bisa dilihat pada gambar 1. Memiliki IP address sendiri dan (<em>optional</em>) ASN merupakan syarat untuk bergabung.</p>\r\n\r\n<p>Untuk pendaftaran anggota baru, akan difasilitasi melalui form berikut ini.</p>\r\n\r\n<p>Terdapat 71  organisasi yang terhubung melalui IdREN. Konsolidasi dan optimisasi jaringan sedang dilakukan. Form pendaftaran akan <em>dibuka</em> ketika konsolidasi sudah selesai dilakukan.</p>', '<p>Pada 13/05/16 Ditjen Belmawa Kemenristekdikti menandatangani nota kesepahaman (MoU) tentang kerja sama penyediaan fasilitas telekomunikasi untuk Indonesian Research and Education Network (IdREN) dengan PT Telkom Indonesia (Persero) Tbk (Telkom). Penandatanganan dilakukan oleh Direktur Enterprise & Business Services Telkom, Muhammad Awaluddin dan Dirjen Belmawa Kemenristekdikti Prof Intan Ahmad di Gedung Ditjen Belmawa, Jakarta.</p>\r\n\r\n<p>Prof Intan Ahmad mengemukakan, IdREN merupakan bagian dari REN (Research and Education Networks) yang terkoneksi melalui TEIN (Trans Eurasia Information Networks). Di masa depan IdREN akan menjadi penghubung masyarakat pendidikan dan peneliti (Perguruan Tinggi maupun lembaga riset) yang beraktivitas dan berkolaborasi melalui jejaring IdREN.</p>\r\n\r\n<p>Keberadaan IdREN diharapkan dapat dimanfaatkan para pimpinan perguruan tinggi untuk meningkatkan kualitas pendidikan dan produktivitas riset perguruan tinggi, yang pada akhirnya dapat meningkatkan produktivitas bangsa.</p>\r\n\r\n<p>dREN diprakarsai tim AdHoc dari 5 Perguruan Tinggi di Indonesia (ITB, UGM, UI, ITS dan UB) dengan dukungan penuh oleh Telkom.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tb_template_email`
--

CREATE TABLE `tb_template_email` (
  `id_template_email` int(11) NOT NULL,
  `id_kategori_email_ref` int(11) NOT NULL,
  `source_code` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_template_email`
--

INSERT INTO `tb_template_email` (`id_template_email`, `id_kategori_email_ref`, `source_code`, `status`) VALUES
(1, 1, '<!DOCTYPE html>\r\n<html>\r\n\r\n<head>\r\n    <meta charset=\"UTF-8\" />\r\n        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n       <title>page-gabung</title>\r\n       <style type=\"text/css\">\r\n       body{\r\n        margin: 0;\r\n       }\r\n               .text-center{\r\n                text-align: center;\r\n               }\r\n           .header-top{\r\n            \r\n            background-color: #F2F2F2;\r\n            padding: 1em;\r\n           }\r\n           .header-top .filter-image{\r\n            display: inline-block;\r\n           }\r\n            .header-bottom .filter-image{\r\n            display: inline-block;\r\n            height: auto;\r\n            overflow: hidden;\r\n           }\r\n       .header-bottom .filter-image img{\r\n            width: 150px;\r\n           }\r\n           .header-bottom .circle{\r\n            \r\n           }\r\n           .line{\r\n            display: inline-block;\r\n            width: 150px;\r\n            height: 3px;\r\n            background-color: red;\r\n           }\r\n           .content-email{\r\n            margin-top: 1em;\r\n            padding:2em 1em;\r\n            color: white;\r\n            background-image: url(\'<?=base_url();?>assets/images/logo/bg-email.png\');\r\n           }\r\n           .content-email p{}\r\n           .content-email table{\r\n            margin-top: 1em;\r\n            display: inline-block;\r\n            text-align: left;\r\n           }\r\n         \r\n       </style>\r\n<body>\r\n    <header>\r\n        <div class=\"header-top text-center\" >\r\n            <div class=\"filter-image \">\r\n                <img src=\"<?=base_url();?>assets/images/logo/Asset_16@4x.png\" width=\"80px\">\r\n            </div>\r\n        </div>\r\n        <div class=\"header-bottom text-center\">\r\n            <h3>Hi Email_User</h3>\r\n            <div class=\"circle\">\r\n                <div class=\"filter-image\"> \r\n                    <img class=\"icon\" src=\"<?=base_url();?>assets/images/logo/trima.png\" width=\"\">\r\n                </div>\r\n            </div>\r\n            <div class=\"caption-notif\">\r\n              <h3 [removed] 7px;color: #BDBDBD;\">Registrasi Anda Berhasil </h3>\r\n              <div class=\"line\"></div>\r\n            </div>\r\n        </div>\r\n        <div class=\"content-email text-center\">\r\n          <p>Terimakasih telah melakukan registrasi pada IDREN. Berikut data diri yang terdaftar.</p>\r\n\r\n          <table line-spacing=\"0\" >\r\n            content_email\r\n          </table>\r\n\r\n          <div class=\"footer\">\r\n            <h4>Berhasil bergabung dengan IDREN platform</h4>\r\n\r\n             <h4>Selamat menikmati layanan yang kami tawarkan</h4>\r\n              <h4>IDREN Support</h4>\r\n          </div>\r\n        </div>\r\n        \r\n    </header>\r\n\r\n</body>\r\n\r\n</html>', 1),
(2, 2, '<!DOCTYPE html>\r\n<html>\r\n\r\n<head>\r\n    <meta charset=\"UTF-8\" />\r\n        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n       <title>page-gabung</title>\r\n       <style type=\"text/css\">\r\n       body{\r\n        margin: 0;\r\n       }\r\n               .text-center{\r\n                text-align: center;\r\n               }\r\n           .header-top{\r\n            \r\n            background-color: #F2F2F2;\r\n            padding: 1em;\r\n           }\r\n           .header-top .filter-image{\r\n            display: inline-block;\r\n           }\r\n            .header-bottom .filter-image{\r\n            display: inline-block;\r\n            height: auto;\r\n            overflow: hidden;\r\n           }\r\n       .header-bottom .filter-image img{\r\n            width: 150px;\r\n           }\r\n           .header-bottom .circle{\r\n            \r\n           }\r\n           .line{\r\n            display: inline-block;\r\n            width: 150px;\r\n            height: 3px;\r\n            background-color: red;\r\n           }\r\n           .content-email{\r\n            margin-top: 1em;\r\n            padding:2em 1em;\r\n            color: white;\r\n            background-image: url(\'<?=base_url();?>assets/images/logo/bg-email.png\');\r\n           }\r\n           .content-email p{}\r\n           .content-email table{\r\n            margin-top: 1em;\r\n            display: inline-block;\r\n            text-align: left;\r\n           }\r\n         \r\n       </style>\r\n<body>\r\n    <header>\r\n        <div class=\"header-top text-center\" >\r\n            <div class=\"filter-image \">\r\n                <img src=\"<?=base_url();?>assets/images/logo/Asset_16@4x.png\" width=\"80px\">\r\n            </div>\r\n        </div>\r\n        <div class=\"header-bottom text-center\">\r\n            <h3>Hi Email_User</h3>\r\n            <div class=\"circle\">\r\n                <div class=\"filter-image\"> \r\n                    <img class=\"icon\" src=\"<?=base_url();?>assets/images/logo/join.png\" width=\"\">\r\n                </div>\r\n            </div>\r\n            <div class=\"caption-notif\">\r\n              <h3 [removed] 7px;color: #BDBDBD;\">Permintaan join Anda sedamg diproses </h3>\r\n              <div class=\"line\"></div>\r\n            </div>\r\n        </div>\r\n        <div class=\"content-email text-center\">\r\n          <p>Terimakasih telah melakukan registrasi pada IDREN. Berikut data diri yang terdaftar.</p>\r\n\r\n          <table line-spacing=\"0\" >\r\n            content_email\r\n          </table>\r\n\r\n          <div class=\"footer\">\r\n            <h4>Berhasil bergabung dengan IDREN platform</h4>\r\n\r\n             <h4>Selamat menikmati layanan yang kami tawarkan</h4>\r\n              <h4>IDREN Support</h4>\r\n          </div>\r\n        </div>\r\n        \r\n    </header>\r\n\r\n</body>\r\n\r\n</html>', 1),
(3, 3, '<!DOCTYPE html>\r\n<html>\r\n\r\n<head>\r\n    <meta charset=\"UTF-8\" />\r\n        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n       <title>page-gabung</title>\r\n       <style type=\"text/css\">\r\n       body{\r\n        margin: 0;\r\n       }\r\n               .text-center{\r\n                text-align: center;\r\n               }\r\n           .header-top{\r\n            \r\n            background-color: #F2F2F2;\r\n            padding: 1em;\r\n           }\r\n           .header-top .filter-image{\r\n            display: inline-block;\r\n           }\r\n            .header-bottom .filter-image{\r\n            display: inline-block;\r\n            height: auto;\r\n            overflow: hidden;\r\n           }\r\n       .header-bottom .filter-image img{\r\n            width: 150px;\r\n           }\r\n           .header-bottom .circle{\r\n            \r\n           }\r\n           .line{\r\n            display: inline-block;\r\n            width: 150px;\r\n            height: 3px;\r\n            background-color: red;\r\n           }\r\n           .content-email{\r\n            margin-top: 1em;\r\n            padding:2em 1em;\r\n            color: white;\r\n            background-image: url(\'<?=base_url();?>assets/images/logo/bg-email.png\');\r\n           }\r\n           .content-email p{}\r\n           .content-email table{\r\n            margin-top: 1em;\r\n            display: inline-block;\r\n            text-align: left;\r\n           }\r\n         \r\n       </style>\r\n<body>\r\n    <header>\r\n        <div class=\"header-top text-center\" >\r\n            <div class=\"filter-image \">\r\n                <img src=\"<?=base_url();?>assets/images/logo/Asset_16@4x.png\" width=\"80px\">\r\n            </div>\r\n        </div>\r\n        <div class=\"header-bottom text-center\">\r\n            <h3>Hi Email_User</h3>\r\n            <div class=\"circle\">\r\n                <div class=\"filter-image\"> \r\n                    <img class=\"icon\" src=\"<?=base_url();?>assets/images/logo/proses.png\" width=\"\">\r\n                </div>\r\n            </div>\r\n            <div class=\"caption-notif\">\r\n              <h3 [removed] 7px;color: #BDBDBD;\">Permintaan join Anda sedamg diproses </h3>\r\n              <div class=\"line\"></div>\r\n            </div>\r\n        </div>\r\n        <div class=\"content-email text-center\">\r\n          <p>Terimakasih telah melakukan registrasi pada IDREN. Berikut data diri yang terdaftar.</p>\r\n\r\n          <table line-spacing=\"0\" >\r\n            content_email\r\n          </table>\r\n\r\n          <div class=\"footer\">\r\n            <h4>Berhasil bergabung dengan IDREN platform</h4>\r\n\r\n             <h4>Selamat menikmati layanan yang kami tawarkan</h4>\r\n              <h4>IDREN Support</h4>\r\n          </div>\r\n        </div>\r\n        \r\n    </header>\r\n\r\n</body>\r\n\r\n</html>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_testimoni`
--

CREATE TABLE `tb_testimoni` (
  `id_testimoni` int(11) NOT NULL,
  `nama_user` varchar(45) NOT NULL,
  `gambar` varchar(45) DEFAULT NULL,
  `content` text NOT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `is_aktif` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_testimoni`
--

INSERT INTO `tb_testimoni` (`id_testimoni`, `nama_user`, `gambar`, `content`, `jabatan`, `is_aktif`) VALUES
(1, 'Muhammad Nasir', '1523518647.jpg', '<p>IDren memiliki sistem jaringan privat yang aman serta ditunjang dengan akses yang mudah bagi akademisi yang ingin melakukan segala kebutuhan kampus seperti live streaming,riset, atau menambah resource baru. Mari berkolaborasi bersama-sama dan dapatkan update terbaru setiap hari di website ini</p>', 'Menteri Riset, Teknologi dan Pendidikan Tinggi Republik Indonesia', 1),
(2, 'qweqwe', '1523507729.png', '<p>ini adalah testimony</p>', 'qweqwe', 1),
(3, 'nggak ada', '1523517753.jpg', '<p>contoh testimoni edit</p>', 'iku', 0),
(4, 'Herlambang', '1523518044.jpg', '<p>ini adalah testimony</p>', 'Menteri Ke kinian', 0),
(5, 'Andi malarangeng', '1523505634.png', '<p>testimoni ini adalah testimoni</p>', 'Kepala Ketoprak', 0),
(6, 'rieskha hermawan putra', '1524193303.jpg', '<p>ideren adalah wujud telkom memberikan kontribusinya untuk kebutuhan dan kemajuan duni pendidikan indonesia. sangat membantu dan sangat inovatif</p>', 'vice president SkyRain Studio', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(62) NOT NULL,
  `email` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `gambar` varchar(45) DEFAULT NULL,
  `is_aktif` int(1) NOT NULL DEFAULT '1' COMMENT '0=untuk tidak aktif, 1=untuk tidak aktif',
  `id_role_ref` int(1) NOT NULL,
  `id_instansi_ref` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `email`, `name`, `phone`, `gambar`, `is_aktif`, `id_role_ref`, `id_instansi_ref`) VALUES
(1, 'admin', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'desistrom1@gmail.com', 'amdin', '082331472499', '15235187981.png', 1, 1, 1),
(2, 'dev', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'admin@gmail.com', 'junaedi', '9678', '1523450760.png', 1, 0, 2),
(4, 'jun', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'admin@gmail.com', 'junaedi', '9678', 'http://localhost/idren/media/1523338972.png', 1, 0, 0),
(5, 'dyah', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'desistrom1@gmail.com', 'gozali', '82331472499', '1523451028.png', 1, 0, 1),
(6, 'UNESA', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'unesa@gmail.com', 'UNESA', '091239012', '1523451134.png', 1, 0, 2),
(7, 'admininistrator', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'desistrom1@gmail.com', 'polinema', '82331472499', '1523451096.png', 1, 0, 3),
(8, 'eqqwe', 'f4542db9ba30f7958ae42c113dd87ad21fb2eddb', 'desistrom1@gmail.com', 'Mohamad Puji Junaedi', '82331472499', NULL, 1, 0, 1),
(9, 'qwe', '056eafe7cf52220de2df36845b8ed170c67e23e3', 'desistrom1@gmail.com', 'Mohamad Puji Junaedi', '82331472499', '1523451106.png', 1, 0, 2),
(10, '34567890', '22ea1c649c82946aa6e479e1ffd321e4a318b1b0', 'desistrom1@gmail.com', 'Mohamad Puji Junaedi', '82331472499', '1523342541.png', 1, 0, 1),
(11, 'aljdsajksd', '9c1c01dc3ac1445a500251fc34a15d3e75a849df', 'sodjflsjfdqf', 'kajdhka', 'sdlfsjfd', NULL, 1, 0, NULL),
(12, 'adsas', 'bb298b7a82890deedc0b4489dd37078e5f303f54', 'q', 'asdasd', 'q', NULL, 1, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_about`
--
ALTER TABLE `tb_about`
  ADD PRIMARY KEY (`id_about`);

--
-- Indexes for table `tb_album_galery`
--
ALTER TABLE `tb_album_galery`
  ADD PRIMARY KEY (`id_album`);

--
-- Indexes for table `tb_contact`
--
ALTER TABLE `tb_contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indexes for table `tb_galery`
--
ALTER TABLE `tb_galery`
  ADD PRIMARY KEY (`id_galery`);

--
-- Indexes for table `tb_hero`
--
ALTER TABLE `tb_hero`
  ADD PRIMARY KEY (`id_hero`);

--
-- Indexes for table `tb_instansi`
--
ALTER TABLE `tb_instansi`
  ADD PRIMARY KEY (`id_instansi`);

--
-- Indexes for table `tb_kategori_email`
--
ALTER TABLE `tb_kategori_email`
  ADD PRIMARY KEY (`id_kategori_email`);

--
-- Indexes for table `tb_kategori_news`
--
ALTER TABLE `tb_kategori_news`
  ADD PRIMARY KEY (`id_kategori_news`);

--
-- Indexes for table `tb_layanan`
--
ALTER TABLE `tb_layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `tb_logo`
--
ALTER TABLE `tb_logo`
  ADD PRIMARY KEY (`id_logo`);

--
-- Indexes for table `tb_news`
--
ALTER TABLE `tb_news`
  ADD PRIMARY KEY (`id_news`);

--
-- Indexes for table `tb_notifikasi_email`
--
ALTER TABLE `tb_notifikasi_email`
  ADD PRIMARY KEY (`id_notifikasi_email`);

--
-- Indexes for table `tb_setting_email`
--
ALTER TABLE `tb_setting_email`
  ADD PRIMARY KEY (`id_setting_email`);

--
-- Indexes for table `tb_setting_user`
--
ALTER TABLE `tb_setting_user`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `tb_template_email`
--
ALTER TABLE `tb_template_email`
  ADD PRIMARY KEY (`id_template_email`),
  ADD KEY `kateamils` (`id_kategori_email_ref`);

--
-- Indexes for table `tb_testimoni`
--
ALTER TABLE `tb_testimoni`
  ADD PRIMARY KEY (`id_testimoni`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_about`
--
ALTER TABLE `tb_about`
  MODIFY `id_about` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_album_galery`
--
ALTER TABLE `tb_album_galery`
  MODIFY `id_album` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_contact`
--
ALTER TABLE `tb_contact`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_galery`
--
ALTER TABLE `tb_galery`
  MODIFY `id_galery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_hero`
--
ALTER TABLE `tb_hero`
  MODIFY `id_hero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_instansi`
--
ALTER TABLE `tb_instansi`
  MODIFY `id_instansi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_kategori_email`
--
ALTER TABLE `tb_kategori_email`
  MODIFY `id_kategori_email` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_kategori_news`
--
ALTER TABLE `tb_kategori_news`
  MODIFY `id_kategori_news` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_layanan`
--
ALTER TABLE `tb_layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_logo`
--
ALTER TABLE `tb_logo`
  MODIFY `id_logo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_news`
--
ALTER TABLE `tb_news`
  MODIFY `id_news` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tb_notifikasi_email`
--
ALTER TABLE `tb_notifikasi_email`
  MODIFY `id_notifikasi_email` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_setting_email`
--
ALTER TABLE `tb_setting_email`
  MODIFY `id_setting_email` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_setting_user`
--
ALTER TABLE `tb_setting_user`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_template_email`
--
ALTER TABLE `tb_template_email`
  MODIFY `id_template_email` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_testimoni`
--
ALTER TABLE `tb_testimoni`
  MODIFY `id_testimoni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_template_email`
--
ALTER TABLE `tb_template_email`
  ADD CONSTRAINT `kateamils` FOREIGN KEY (`id_kategori_email_ref`) REFERENCES `tb_kategori_email` (`id_kategori_email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
