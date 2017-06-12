-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2016 at 01:02 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laporan_revisi`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori_laporan`
--

CREATE TABLE `kategori_laporan` (
  `idkategori_laporan` int(10) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `eta_enabled` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_laporan`
--

INSERT INTO `kategori_laporan` (`idkategori_laporan`, `nama_kategori`, `icon`, `eta_enabled`) VALUES
(1, 'Kebersihan', 'fa fa-pied-piper fa-lg', 1),
(2, 'Lingkungan', 'fa fa-leaf fa-lg', 1),
(18, 'Kebakaran', 'fa fa-fire fa-lg', 1),
(19, 'Kesehatan', 'fa fa-ambulance fa-lg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `idkecamatan` int(10) UNSIGNED NOT NULL,
  `nama_kecamatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`idkecamatan`, `nama_kecamatan`) VALUES
(1, 'Malalayang'),
(2, 'Sario'),
(3, 'Wanea'),
(4, 'Wenang'),
(5, 'Tikala'),
(6, 'Paal Dua'),
(7, 'Mapanget'),
(8, 'Singkil'),
(9, 'Tuminting'),
(10, 'Bunaken'),
(11, 'Bunaken Kepulauan');

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE `kelurahan` (
  `idkelurahan` int(10) UNSIGNED NOT NULL,
  `idkecamatan` int(10) UNSIGNED NOT NULL,
  `nama_kelurahan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelurahan`
--

INSERT INTO `kelurahan` (`idkelurahan`, `idkecamatan`, `nama_kelurahan`) VALUES
(1, 1, 'Malalayang I'),
(2, 1, 'Malalayang II'),
(3, 1, 'Bahu'),
(4, 1, 'Kleak'),
(5, 1, 'Malalayang I Timur'),
(6, 1, 'Malalayang I Barat'),
(7, 1, 'Winangun I'),
(8, 1, 'Winangun II'),
(9, 1, 'Batu Kota'),
(10, 2, 'Ranotana'),
(11, 2, 'Sario Kota Baru'),
(12, 2, 'Sario'),
(13, 2, 'Sario Tumpaan'),
(14, 2, 'Sario Utara'),
(15, 2, 'Titiwungen Selatan'),
(16, 2, 'Titiwungen Utara'),
(17, 3, 'Karombasan Utara'),
(18, 3, 'Karombasan Selatan'),
(19, 3, 'Ranotana Weru'),
(20, 3, 'Pakowa'),
(21, 3, 'Bumi Nyiur'),
(22, 3, 'Teling Atas'),
(23, 3, 'Wanea'),
(24, 3, 'Tanjung Batu'),
(25, 3, 'Tingkulu'),
(26, 4, 'Bumi Beringin'),
(27, 4, 'Teling Bawah'),
(28, 4, 'Tikala Kumakara'),
(29, 4, 'Mahakeret Barat'),
(30, 4, 'Mahakeret Timur'),
(31, 4, 'Wenang Utara'),
(32, 4, 'Wenang Selatan'),
(33, 4, 'Lawangirung'),
(34, 4, 'Komo Luar'),
(35, 4, 'Pinaesaan'),
(36, 4, 'Istiqlal'),
(37, 4, 'Calaca'),
(38, 5, 'Banjer'),
(39, 5, 'Tikala Baru'),
(40, 5, 'Paal IV'),
(41, 5, 'Taas'),
(42, 5, 'Tikala Ares'),
(43, 6, 'Ranomuut'),
(44, 6, 'Perkamil'),
(45, 6, 'Malendeng'),
(46, 6, 'Dendengan Dalam'),
(47, 6, 'Dendengan Luar'),
(48, 6, 'Paal Dua'),
(49, 6, 'Kairagi Weru'),
(50, 7, 'Kairagi Satu'),
(51, 7, 'Kairagi Dua'),
(52, 7, 'Paniki Bawah'),
(53, 7, 'Lapangan'),
(54, 7, 'Mapanget Barat'),
(55, 7, 'Kima Atas'),
(56, 7, 'Bengkol'),
(57, 7, 'Buha'),
(58, 7, 'Paniki Satu'),
(59, 8, 'Karame'),
(60, 8, 'Ketang Baru'),
(61, 8, 'Wawonasa'),
(62, 8, 'Ternate Baru'),
(63, 8, 'Ternate Tanjung'),
(64, 8, 'Kombos Barat'),
(65, 8, 'Kombos Timur'),
(66, 8, 'Singkil Satu'),
(67, 8, 'Singkil Dua'),
(68, 9, 'Sindulang Satu'),
(69, 9, 'Kampung Islam'),
(70, 9, 'Sindulang Dua'),
(71, 9, 'Bitung Karangria'),
(72, 9, 'Maasing'),
(73, 9, 'Tuminting'),
(74, 9, 'Mahawu'),
(75, 9, 'Sumompo'),
(76, 9, 'Tumumpa Satu'),
(77, 9, 'Tumumpa Dua'),
(78, 10, 'Bailang'),
(79, 10, 'Molas'),
(80, 10, 'Meras'),
(81, 10, 'Tongkeina'),
(82, 10, 'Pandu'),
(83, 11, 'Bunaken'),
(84, 11, 'Alung Banua'),
(85, 11, 'Manado Tua Satu'),
(86, 11, 'Manado Tua Dua');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_facebook`
--

CREATE TABLE `laporan_facebook` (
  `id_laporan_facebook` int(11) NOT NULL,
  `id_post` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `approve` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan_facebook`
--

INSERT INTO `laporan_facebook` (`id_laporan_facebook`, `id_post`, `id_user`, `nama_user`, `message`, `waktu`, `approve`) VALUES
(1, '1172154122867702_1172968746119573', 2147483647, 'Imanuel Pundoko', '[Lapor] Pak\nkenapa setiap kali saya memakai baju seperti pada gambar, perasaan saya tidak enak, karena saya rasa saya diikuti makhluk.\n\nJadi apa yang harus saya lakukan terhadap sepatu saya...\n\nplz.. komen, atau kirim di email saya ilomon10@gmail.com\n\nTrimakasih sebelumnya...', '2016-11-18 02:32:04', 0),
(2, '1172154122867702_1172323589517422', 2147483647, 'Edgar Pontoh', 'lorem ipsum dolor sit amet consectetur adipiscing elit', '2016-11-20 11:47:16', 1),
(3, '1172154122867702_1172323112850803', 2147483647, 'Edgar Pontoh', 'posting keempat', '2016-11-17 07:37:42', 0),
(4, '1172154122867702_1172293046187143', 2147483647, 'Edgar Pontoh', 'posting ketiga..', '2016-11-19 10:42:19', 1),
(5, '1172154122867702_1172157686200679', 2147483647, 'Edgar Pontoh', 'Posting kedua', '2016-11-17 05:07:24', 0),
(6, '1172154122867702_1172157562867358', 2147483647, 'Edgar Pontoh', 'Posting pertama..', '2016-11-17 04:44:41', 0),
(19, '1172154122867702_1173885112694603', 2147483647, 'Edgar Pontoh', 'test api baru...', '2016-11-19 15:33:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `laporan_masyarakat`
--

CREATE TABLE `laporan_masyarakat` (
  `idlaporan_masyarakat` int(10) UNSIGNED NOT NULL,
  `idkelurahan` int(10) UNSIGNED NOT NULL,
  `idkecamatan` int(10) UNSIGNED NOT NULL,
  `idkategori_laporan` int(10) UNSIGNED DEFAULT NULL,
  `idpengguna_approve` int(11) NOT NULL,
  `idpengguna_handle` int(11) DEFAULT NULL,
  `nomor_laporan` varchar(11) DEFAULT NULL,
  `nama_pelapor` varchar(255) NOT NULL,
  `alamat_pelapor` varchar(255) NOT NULL,
  `nomorhp_pelapor` varchar(20) NOT NULL,
  `email_pelapor` varchar(255) NOT NULL,
  `isi_laporan` text NOT NULL,
  `file_attach` varchar(255) NOT NULL,
  `jenis_laporan` enum('web','android','facebook','twitter','qlue') NOT NULL DEFAULT 'web',
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `status` enum('selesai','proses','dilapor') NOT NULL DEFAULT 'dilapor',
  `pengerjaan_hari` int(11) DEFAULT NULL,
  `pengerjaan_jam` int(11) DEFAULT NULL,
  `tindakan_proses` text,
  `tindakan_selesai` text NOT NULL,
  `file_respon_proses` varchar(255) DEFAULT NULL,
  `file_respon_selesai` varchar(255) DEFAULT NULL,
  `waktu_laporan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approve` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan_masyarakat`
--

INSERT INTO `laporan_masyarakat` (`idlaporan_masyarakat`, `idkelurahan`, `idkecamatan`, `idkategori_laporan`, `idpengguna_approve`, `idpengguna_handle`, `nomor_laporan`, `nama_pelapor`, `alamat_pelapor`, `nomorhp_pelapor`, `email_pelapor`, `isi_laporan`, `file_attach`, `jenis_laporan`, `latitude`, `longitude`, `status`, `pengerjaan_hari`, `pengerjaan_jam`, `tindakan_proses`, `tindakan_selesai`, `file_respon_proses`, `file_respon_selesai`, `waktu_laporan`, `approve`) VALUES
(29, 19, 3, 2, 1, NULL, '6340', 'Edgar Pontoh', 'Singkil Satu Lingkungan III', '081340234605', 'edgarpontoh3141@gmail.com', 'lorem ipsum dolor sit', 'ec1246b9fec3c4c86c959396b2c7fe01.jpg', 'android', 1.493416, 124.891966, 'proses', NULL, NULL, NULL, '', NULL, NULL, '2016-12-01 22:53:14', 1),
(30, 11, 2, 2, 5, NULL, '754', 'Bizi Konga', 'Alamat', '081340234605', 'edgarpontoh3141@gmail.com', 'lorem ipsum dolor sit amet', '98d1aa8fa7fee558a0055ee50a1877c3.jpg', 'web', 1.4910135557338737, 124.8524838833008, 'dilapor', NULL, NULL, NULL, '', NULL, NULL, '2016-12-03 00:18:53', 1),
(31, 15, 2, 1, 5, NULL, '8372', 'Imanuel Pundoko', 'Sea', '081340234605', 'ilomon10@gmail.com', 'lorem ipsum', 'f58dba19a483488b8f696ffc828cccdf.jpg', 'facebook', 1.4803741282380056, 124.83806432763674, 'selesai', NULL, NULL, NULL, '', NULL, NULL, '2016-12-03 06:34:36', 1),
(32, 53, 7, 1, 0, NULL, '5174', 'David Noya', 'Poli', '081340234605', 'david.noya@gmail.com', 'lorem ipsum ', '249b5e28aa947a36939bf412af1dad54.png', 'web', 1.5434377187202677, 124.91874517480471, 'dilapor', NULL, NULL, NULL, '', NULL, NULL, '2016-12-03 06:48:21', 0),
(33, 22, 3, 2, 5, NULL, '1827', 'Saudara Sandro', 'Telkom', '081340234605', 'sandro@gmail.com', 'lorem ipsum dolor sit amet', 'fab6eeca04d58825445927aee951dabf.png', 'twitter', 1.5023393413903023, 124.86999334375002, 'dilapor', NULL, NULL, NULL, '', NULL, NULL, '2016-12-03 08:36:45', 1),
(36, 58, 7, 18, 0, NULL, '1960', 'Bobby Najoan', 'GPI', '081340234605', 'bnajoan@gmail.com', 'For deep appear sixth in earth over beginning, lesser have subdue divide one had make saying kind kind fifth, them lights was seed she''d days light evening can''t divide firmament don''t itself, above she''d years waters said dry face green behold wherein, deep have saw there set, fish him darkness heaven man kind fifth whose. Whales after after said given seasons itself seas, evening form replenish their brought saying seasons image, them unto face gathering appear beginning third winged divide may fowl third doesn''t our rule gathering signs unto and him second had moving yielding over forth, beginning yielding over.', '4f92675e6e38581ee69a1b10cf0ca4d9.png', 'web', NULL, NULL, 'dilapor', NULL, NULL, NULL, '', NULL, NULL, '2016-12-04 01:49:49', 0),
(37, 77, 9, 19, 0, NULL, '3706', 'Yohanes Sahante', 'Tumumpa', '081340234605', 'yohanesandrew31@gmail.com', 'Seas multiply his own appear. Whose fifth divide own. Whose. And, called, place him dry morning behold appear spirit Were seas. His life rule a may to deep beast over to. After heaven in deep abundantly place. Midst after cattle winged, his own had unto creepeth saying, creepeth i all saw own signs midst you for lesser one from, gathered fish can''t give days had creepeth winged fill firmament land years fifth above light after image bearing days be be to from cattle they''re two lesser and life grass seas fowl face male fruitful divide our herb female. Darkness cattle.', 'cd68d11172618fada247b9c8e72be176.jpg', 'web', NULL, NULL, 'dilapor', NULL, NULL, NULL, '', NULL, NULL, '2016-12-04 01:51:25', 0),
(38, 3, 1, 19, 5, NULL, '9236', 'Bizi Alelll', 'Bahu', '081340234605', 'alelll@alal.com', 'Seas multiply his own appear. Whose fifth divide own. Whose. And, called, place him dry morning behold appear spirit Were seas. His life rule a may to deep beast over to. After heaven in deep abundantly place. Midst after cattle winged, his own had unto creepeth saying, creepeth i all saw own signs midst you for lesser one from, gathered fish can''t give days had creepeth winged fill firmament land years fifth above light after image bearing days be be to from cattle they''re two lesser and life grass seas fowl face male fruitful divide our herb female. Darkness cattle.', 'de858620e520f86215675d0478cbd46b.png', 'web', 1.493416, 124.891966, 'dilapor', NULL, NULL, NULL, '', NULL, NULL, '2016-12-04 05:07:28', 1),
(39, 72, 9, 19, 5, 16, '5545', 'Saudara Sandro', 'Mapanget', '081340234605', 'sandro@gmail.com', 'Seas multiply his own appear. Whose fifth divide own. Whose. And, called, place him dry morning behold appear spirit Were seas. His life rule a may to deep beast over to. After heaven in deep abundantly place. Midst after cattle winged, his own had unto creepeth saying, creepeth i all saw own signs midst you for lesser one from, gathered fish can''t give days had creepeth winged fill firmament land years fifth above light after image bearing days be be to from cattle they''re two lesser and life grass seas fowl face male fruitful divide our herb female. Darkness cattle.', '0093885f961d3d111ec752ee1142ea03.jpg', 'web', 1.5047417732384667, 124.8463040737305, 'selesai', NULL, NULL, 'Divide. Void is appear creeping sixth fowl for have their yielding abundantly Unto. Creepeth. And. One was. Meat given i, good Set god darkness creepeth. To all deep day good Don''t also. A upon under fowl over stars us second divided in together image blessed don''t. Give wherein years, image life seas fish deep, rule. Moveth living called spirit behold gathering lights and was. Won''t dominion our of he you''ll multiply. Likeness of very he firmament blessed living. Great brought herb good meat behold. Hath together of upon them sea very herb gathered. Replenish dominion the very was night saw.', 'Winged. Light there. Heaven upon given midst together shall can''t sixth male. Image us won''t divided forth i fruitful it great won''t our place void our hath is fifth which. From creature which, living. Deep. Yielding them had, creepeth you''re they''re bearing. Man light creature moved void years it creeping signs you void image days. Blessed form green female together gathered brought. Above rule. Fruit made whose life. Divide over sea, so replenish. Air night. Which and moving Fish seed it creeping fruit moving were you''re had dominion have form rule there cattle. Form greater, him. Called. Won''t stars may.', '82ad5c851ddcdfbb47d138ea94a2f48e.jpg', '4d6ce172b6db39a98f726d80b43d57c6.png', '2016-12-04 08:58:16', 1),
(41, 14, 2, 19, 0, NULL, '9899', 'Qaqag Gundam', 'Lelkom', '081340234605', 'qaqag@gmail.com', 'awerwerwergregegetgtrhtrh', '19e6861ac148fd2617b7d4efff3236a0.png', 'web', NULL, NULL, 'dilapor', NULL, NULL, NULL, '', NULL, NULL, '2016-12-04 11:00:35', 0),
(43, 19, 3, 18, 0, NULL, '6220', 'Baisoihewifr', 'iuhewihrwuhr', '983472834', 'edgarpontoh3141@gmail.com', 'wefrerhitehkrih ekugkireghuekgk htg\r\n rhoyjh ''ryjh\r\n[r', '5dd655dd64209d627e10c9cbcc00b9c5.png', 'web', NULL, NULL, 'dilapor', NULL, NULL, NULL, '', NULL, NULL, '2016-12-04 11:06:18', 0),
(44, 20, 3, 2, 0, NULL, '6935', 'nama pelapor', 'alamat', '0183', 'edgarpontoh3141@gmail.com', 'isi laporan', '9a0bda85a3c83ae59fac62a9b3a3f40a.png', 'web', NULL, NULL, 'dilapor', NULL, NULL, NULL, '', NULL, NULL, '2016-12-04 11:08:32', 0),
(45, 22, 3, 18, 0, NULL, '1453', 'fgkn,mhgnkjn', 'alamlnregnr', '3284724895', 'edgarpontoh3141@gmail.com', 'fehtuj t tyjyu ykk iy', '98d04c6cb38acb11dd04be2496fde827.png', 'web', NULL, NULL, 'dilapor', NULL, NULL, NULL, '', NULL, NULL, '2016-12-04 11:10:30', 0),
(46, 22, 3, 18, 0, NULL, '2862', 'fgkn,mhgnkjn', 'alamlnregnr', '3284724895', 'edgarpontoh3141@gmail.com', 'fehtuj t tyjyu ykk iy', '3f23f7215369b4cd39cb1cba356d57ed.png', 'web', NULL, NULL, 'dilapor', NULL, NULL, NULL, '', NULL, NULL, '2016-12-04 11:12:06', 0),
(47, 13, 2, 2, 0, NULL, '3816', 'dfkjnbng', 'lkmdflbkmdflkb', '987487', 'edgarpontoh3141@gmail.com', 'weferkjhureghuirehguhkjvnekj bvk4uev hekikv', '06672c88443354d9fa4755026dfd3524.png', 'web', NULL, NULL, 'dilapor', NULL, NULL, NULL, '', NULL, NULL, '2016-12-04 11:21:16', 0),
(48, 2, 1, 18, 0, NULL, '6078', 'jdfgkjdgfjk', 'fdjhgkjdfghkj', '234853465', 'edgarpontoh3141@gmail.com', 'wfierhighrekugherukh', '7018520a071ef74f4c7cef676b0b13aa.png', 'web', NULL, NULL, 'dilapor', NULL, NULL, NULL, '', NULL, NULL, '2016-12-04 11:26:26', 0),
(50, 19, 3, 2, 0, NULL, '2933', 'vfglbnkn', 'ldnbkdjfn', '081340234605', 'edgarpontoh3141@gmail.com', 'fergergeg', 'c2c6f0fbc9efcff741f1692a49c61841.png', 'web', NULL, NULL, 'dilapor', NULL, NULL, NULL, '', NULL, NULL, '2016-12-04 11:27:19', 0),
(51, 19, 3, 18, 0, NULL, '2754', 'nama', 'alamat', '1874324', 'edgarpontoh3141@gmail.com', 'ewrkerhtuerhkuther gheuuegeirgk eyurg kergjyeg jygefyu egkyg wkygf', 'ba1d1ec52c5eab6a174d74e46adaa864.png', 'web', NULL, NULL, 'dilapor', NULL, NULL, NULL, '', NULL, NULL, '2016-12-04 11:36:18', 0),
(52, 1, 1, 1, 0, NULL, '499', 'fdknbmfgnbjknb', 'nvdfkjnbn', '38463785', 'gnerkgneg@mail.com', 'wferlgheughuireg', 'f8ca722c56028676fc5e00f5b2845603.png', 'web', NULL, NULL, 'dilapor', NULL, NULL, NULL, '', NULL, NULL, '2016-12-04 11:40:56', 0),
(53, 19, 3, 18, 0, NULL, '697', 'dbkgfngfn', 'klkyh', '235346', 'edgarpontoh3141@gmail.com', 'rguerkhu,gjf ,nf k,j ,bk', '9cbbe1e9c62c9f8227d02297b0b04fcd.png', 'web', NULL, NULL, 'dilapor', NULL, NULL, NULL, '', NULL, NULL, '2016-12-04 11:42:04', 0),
(54, 29, 4, 2, 0, NULL, '6197', 'sgerlgg', 'ffbtyjyuq', '081340234605', 'weeferrty@mail.com', 'wfiegiethith', 'd17f5c3f81d97b5fcca55731eaf7355e.PNG', 'web', NULL, NULL, 'dilapor', NULL, NULL, NULL, '', NULL, NULL, '2016-12-04 11:43:15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `idpengguna` int(10) UNSIGNED NOT NULL,
  `idkelurahan` int(10) UNSIGNED DEFAULT NULL,
  `idkecamatan` int(10) UNSIGNED DEFAULT NULL,
  `idkategori_laporan` int(10) UNSIGNED DEFAULT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `super` tinyint(1) NOT NULL,
  `bagian` enum('camat','lurah','walikota','department','root') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`idpengguna`, `idkelurahan`, `idkecamatan`, `idkategori_laporan`, `nama_lengkap`, `username`, `password`, `super`, `bagian`) VALUES
(1, NULL, 1, NULL, 'Camat Malalayang', 'cmalalayang', '38d81c8172a860cfe59e3c99cec9dd31', 0, 'camat'),
(2, 3, NULL, NULL, 'Lurah Bahu', 'lbahu', '6651f38cc1e584979373fa989b38ad2b', 0, 'lurah'),
(3, NULL, NULL, NULL, 'Walikota', 'walikota', 'f2de467a9c13687122d9f7476f10030c', 1, 'walikota'),
(5, NULL, NULL, NULL, 'Command Center', 'ccenter', '5543c3e08082f22fcaf12cabe01034d9', 1, 'root'),
(12, NULL, NULL, NULL, 'Swiking Polii', 'king', '1f42dc79bc45010a9b0dbef509a2e18b', 0, 'root'),
(14, 1, NULL, NULL, 'Imanuel Pundoko', 'ilomon', '49ca37fa89db670aaf397d7c3dfe4d69', 0, 'lurah'),
(15, NULL, NULL, 1, 'Edgar Pontoh', 'edgar', '27247783f32f72d65a19090eb3a94fc4', 0, 'department'),
(16, NULL, 9, NULL, 'Yohanes Sahante', 'andrew', '0da2f7821266344ebb7fb22c9967463c', 0, 'camat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori_laporan`
--
ALTER TABLE `kategori_laporan`
  ADD PRIMARY KEY (`idkategori_laporan`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`idkecamatan`);

--
-- Indexes for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`idkelurahan`),
  ADD KEY `kelurahan_FKIndex1` (`idkecamatan`);

--
-- Indexes for table `laporan_facebook`
--
ALTER TABLE `laporan_facebook`
  ADD PRIMARY KEY (`id_laporan_facebook`),
  ADD UNIQUE KEY `id_post` (`id_post`);

--
-- Indexes for table `laporan_masyarakat`
--
ALTER TABLE `laporan_masyarakat`
  ADD PRIMARY KEY (`idlaporan_masyarakat`),
  ADD KEY `laporan_masyarakat_FKIndex1` (`idkategori_laporan`),
  ADD KEY `laporan_masyarakat_FKIndex2` (`idkecamatan`),
  ADD KEY `laporan_masyarakat_FKIndex3` (`idkelurahan`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`idpengguna`),
  ADD KEY `pengguna_FKIndex1` (`idkategori_laporan`),
  ADD KEY `pengguna_FKIndex2` (`idkecamatan`),
  ADD KEY `pengguna_FKIndex3` (`idkelurahan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori_laporan`
--
ALTER TABLE `kategori_laporan`
  MODIFY `idkategori_laporan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `idkecamatan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `kelurahan`
--
ALTER TABLE `kelurahan`
  MODIFY `idkelurahan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `laporan_facebook`
--
ALTER TABLE `laporan_facebook`
  MODIFY `id_laporan_facebook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `laporan_masyarakat`
--
ALTER TABLE `laporan_masyarakat`
  MODIFY `idlaporan_masyarakat` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `idpengguna` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD CONSTRAINT `kelurahan_ibfk_1` FOREIGN KEY (`idkecamatan`) REFERENCES `kecamatan` (`idkecamatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporan_masyarakat`
--
ALTER TABLE `laporan_masyarakat`
  ADD CONSTRAINT `laporan_masyarakat_ibfk_1` FOREIGN KEY (`idkategori_laporan`) REFERENCES `kategori_laporan` (`idkategori_laporan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_masyarakat_ibfk_2` FOREIGN KEY (`idkecamatan`) REFERENCES `kecamatan` (`idkecamatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_masyarakat_ibfk_3` FOREIGN KEY (`idkelurahan`) REFERENCES `kelurahan` (`idkelurahan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`idkategori_laporan`) REFERENCES `kategori_laporan` (`idkategori_laporan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengguna_ibfk_2` FOREIGN KEY (`idkecamatan`) REFERENCES `kecamatan` (`idkecamatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengguna_ibfk_3` FOREIGN KEY (`idkelurahan`) REFERENCES `kelurahan` (`idkelurahan`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
