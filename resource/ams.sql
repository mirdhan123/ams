-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 29, 2016 at 05:26 
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_disposisi`
--

CREATE TABLE IF NOT EXISTS `tbl_disposisi` (
`id_disposisi` int(7) NOT NULL,
  `id_surat` int(7) NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `isi` mediumtext NOT NULL,
  `sifat` enum('Penting, Segera, Khusus') NOT NULL,
  `batas_waktu` date NOT NULL,
  `catatatn` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_disposisi`
--

INSERT INTO `tbl_disposisi` (`id_disposisi`, `id_surat`, `tujuan`, `isi`, `sifat`, `batas_waktu`, `catatatn`) VALUES
(1, 2, 'Guru', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', 'Penting, Segera, Khusus', '2016-06-01', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_instansi`
--

CREATE TABLE IF NOT EXISTS `tbl_instansi` (
`id_instansi` tinyint(1) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `kepsek` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `website` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `logo` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_instansi`
--

INSERT INTO `tbl_instansi` (`id_instansi`, `nama`, `alamat`, `kepsek`, `nip`, `website`, `email`, `logo`) VALUES
(1, 'SMK AL - Husna Loceret Nganjuk', 'Jalan Raya Kediri Gg. Kwagean No. 04 Loceret Telp/Fax. (0358) 329806 Nganjuk 64471', 'Dedik Meiloyan', 'gg', 'http://www.smkalhusnaloceret.sch.id', 'info@smkalhusna.sch.id', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_keluar`
--

CREATE TABLE IF NOT EXISTS `tbl_surat_keluar` (
`id_surat` int(7) NOT NULL,
  `no_agenda` int(7) NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `isi` mediumtext NOT NULL,
  `kode` varchar(50) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_catat` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_surat_keluar`
--

INSERT INTO `tbl_surat_keluar` (`id_surat`, `no_agenda`, `tujuan`, `no_surat`, `isi`, `kode`, `tgl_surat`, `tgl_catat`, `file`, `keterangan`) VALUES
(1, 1, '1', '1', '1', '1', '2012-02-24', '2016-06-29', '1 (2).JPG', '1'),
(2, 2, '2', '2', '2', '2', '2016-06-29', '2016-06-29', 'IMG_20160611_103621.jpg', '2'),
(3, 65456, '654', '564', 'yutuy', '54', '2016-06-29', '2016-06-29', '', 'tyty'),
(4, 3535, '34534', '534534', '34534', '345', '2016-06-01', '2016-06-29', '', '34543'),
(5, 656, '56756', '7675675', 'ytuuy', '675675', '2016-06-29', '2016-06-29', '', 'ttyut'),
(6, 87767, '67867', '78678678', '545456', '86786786', '2016-06-29', '2016-06-29', '', 'r6665'),
(8, 64, '456456', '456456465', '6567567', '456456', '2016-06-29', '2016-06-29', 'IMG_20160611_103632.jpg', '56756757'),
(9, 667, '6786786', '786786', '78678678', '678678', '2016-06-29', '2016-06-29', 'IMG_20160611_103621.jpg', 'y786786'),
(10, 6778678, '687687', '876786', 'yutyutu', '7878', '2016-06-29', '2016-06-29', '', 'tuyt');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_masuk`
--

CREATE TABLE IF NOT EXISTS `tbl_surat_masuk` (
`id_surat` int(10) NOT NULL,
  `no_agenda` int(10) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `asal_surat` varchar(250) NOT NULL,
  `isi` mediumtext NOT NULL,
  `kode` varchar(50) NOT NULL,
  `indeks` varchar(100) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_diterima` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_surat_masuk`
--

INSERT INTO `tbl_surat_masuk` (`id_surat`, `no_agenda`, `no_surat`, `asal_surat`, `isi`, `kode`, `indeks`, `tgl_surat`, `tgl_diterima`, `file`, `keterangan`) VALUES
(1, 1, '1', '1', '1', '1', '1', '2012-09-14', '2016-06-29', 'IMG_20160611_103621.jpg', '1'),
(2, 2, '2', '2', '2', '2', '2', '2016-06-29', '2016-06-29', 'IMG_20160611_103623.jpg', '2'),
(3, 786786, '6786786', '78678', 'tt76', '76786', '678678', '2016-06-29', '2016-06-29', 'IMG_20160611_103636.jpg', '5jgyg'),
(4, 1, 'erert', 'e', 'gjg', '2', 'ert', '2016-06-29', '2016-06-29', '', 'hjghjg'),
(7, 76786, '786786', '678678', 'tyutyu', '678', '786', '2016-06-29', '2016-06-29', '', 'ytytuyy'),
(8, 7656, '756576', '75675', 'tyyutuy', '76756', '675675', '2016-06-29', '2016-06-29', '', 'tyutyu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
`id_user` tinyint(1) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nama`, `nip`, `admin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'M. Rudianto', '-', 1),
(2, 'disposisi', '13bb8b589473803f26a02e338f949b8c', 'Imam Al Husna', '-', 2),
(3, 'imam', 'eaccb8ea6090a40a98aa28c071810371', 'Imam Disposisi', '-', 1),
(4, 'demi', 'a64c9e98476ec57c83b6edcdc6f76f74', 'demi', '9898989', 2),
(5, 'tamu', 'f8829935a87192f3f9fab79856122c0f', 'User tamu', '-', 2),
(6, 'wytdwuyewfgy', '4890f789d51cf8a24e1e180f2549feda', 'hgghjgjhgh', '-', 1),
(7, 'staff', '1253208465b1efa876f982d8a9e73eef', 'staff', '19770404 200801 1 010', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
 ADD PRIMARY KEY (`id_disposisi`);

--
-- Indexes for table `tbl_instansi`
--
ALTER TABLE `tbl_instansi`
 ADD PRIMARY KEY (`id_instansi`);

--
-- Indexes for table `tbl_surat_keluar`
--
ALTER TABLE `tbl_surat_keluar`
 ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
 ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
MODIFY `id_disposisi` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_instansi`
--
ALTER TABLE `tbl_instansi`
MODIFY `id_instansi` tinyint(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_surat_keluar`
--
ALTER TABLE `tbl_surat_keluar`
MODIFY `id_surat` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
MODIFY `id_surat` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
MODIFY `id_user` tinyint(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
