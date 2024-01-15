-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2024 at 11:07 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cikarang-stok`
--

-- --------------------------------------------------------

--
-- Table structure for table `claim_xforce`
--

CREATE TABLE `claim_xforce` (
  `id_c_xforce` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `shift` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `line` int(11) NOT NULL,
  `nama_teknisi` varchar(20) NOT NULL,
  `no_rangka` varchar(30) NOT NULL,
  `tipe_mobil` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `kdp` int(11) NOT NULL,
  `kbg` int(11) NOT NULL,
  `kpkr` int(11) NOT NULL,
  `kpkn` int(11) NOT NULL,
  `kskr` int(11) NOT NULL,
  `kskn` int(11) NOT NULL,
  `kmkr` int(11) NOT NULL,
  `kmkn` int(11) NOT NULL,
  `alasan_kdp` varchar(255) DEFAULT NULL,
  `alasan_kbg` varchar(255) DEFAULT NULL,
  `alasan_kpkr` varchar(255) DEFAULT NULL,
  `alasan_kpkn` varchar(255) DEFAULT NULL,
  `alasan_kskr` varchar(255) DEFAULT NULL,
  `alasan_kskn` varchar(255) DEFAULT NULL,
  `alasan_kmkr` varchar(255) DEFAULT NULL,
  `alasan_kmkn` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `claim_xforce`
--

INSERT INTO `claim_xforce` (`id_c_xforce`, `tanggal`, `shift`, `keterangan`, `line`, `nama_teknisi`, `no_rangka`, `tipe_mobil`, `status`, `kdp`, `kbg`, `kpkr`, `kpkn`, `kskr`, `kskn`, `kmkr`, `kmkn`, `alasan_kdp`, `alasan_kbg`, `alasan_kpkr`, `alasan_kpkn`, `alasan_kskr`, `alasan_kskn`, `alasan_kmkr`, `alasan_kmkn`) VALUES
(5, '2024-01-12', 'Pagi', 'Stok Masuk', 1, 'irfan', 'awdawdawd', '', 'Claim', 1, 0, 0, 0, 0, 0, 0, 0, 'lecek', '', '', '', '', '', '', ''),
(6, '2024-01-12', 'Pagi', 'Stok Masuk', 1, 'irfan', 'asda123123', 'Xforce Exeed', 'Claim', 1, 0, 0, 0, 0, 0, 0, 0, 'lecek', '', '', '', '', '', '', ''),
(7, '2024-01-12', 'Pagi', 'Stok Masuk', 1, 'irfan', 'asda123123', 'Xforce Exceed', 'Claim', 1, 0, 0, 0, 0, 0, 0, 0, 'lecek', '', '', '', '', '', '', ''),
(8, '2024-01-12', 'Pagi', 'Stok Masuk', 1, 'irfan', 'asda123123', 'Xforce Ultimate', 'Claim', 1, 0, 0, 0, 0, 0, 0, 0, 'bintik', '', '', '', '', '', '', ''),
(9, '2024-01-12', 'Pagi', 'Stok Keluar', 1, 'irfan', 'adwawdawdawd', 'Xforce Ultimate', 'Claim', 1, 0, 0, 0, 0, 0, 0, 0, 'baret', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `claim_xpander`
--

CREATE TABLE `claim_xpander` (
  `id_c_xpander` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `shift` varchar(20) NOT NULL,
  `line` int(11) NOT NULL,
  `nama_teknisi` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `tipe_mobil` varchar(20) NOT NULL,
  `no_rangka` varchar(50) NOT NULL,
  `kdp` int(11) NOT NULL,
  `kbg` int(11) NOT NULL,
  `kpkr` int(11) NOT NULL,
  `kpkn` int(11) NOT NULL,
  `kskr` int(11) NOT NULL,
  `kskn` int(11) NOT NULL,
  `kmdkr` int(11) NOT NULL,
  `kmdkn` int(11) NOT NULL,
  `kmbkr` int(11) NOT NULL,
  `kmbkn` int(11) NOT NULL,
  `alasan_kdp` varchar(255) DEFAULT NULL,
  `alasan_kbg` varchar(255) DEFAULT NULL,
  `alasan_kpkr` varchar(255) DEFAULT NULL,
  `alasan_kpkn` varchar(255) DEFAULT NULL,
  `alasan_kskr` varchar(255) DEFAULT NULL,
  `alasan_kskn` varchar(255) DEFAULT NULL,
  `alasan_kmdkr` varchar(255) DEFAULT NULL,
  `alasan_kmdkn` varchar(255) DEFAULT NULL,
  `alasan_kmbkr` varchar(255) DEFAULT NULL,
  `alasan_kmbkn` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `claim_xpander`
--

INSERT INTO `claim_xpander` (`id_c_xpander`, `tanggal`, `shift`, `line`, `nama_teknisi`, `keterangan`, `status`, `tipe_mobil`, `no_rangka`, `kdp`, `kbg`, `kpkr`, `kpkn`, `kskr`, `kskn`, `kmdkr`, `kmdkn`, `kmbkr`, `kmbkn`, `alasan_kdp`, `alasan_kbg`, `alasan_kpkr`, `alasan_kpkn`, `alasan_kskr`, `alasan_kskn`, `alasan_kmdkr`, `alasan_kmdkn`, `alasan_kmbkr`, `alasan_kmbkn`) VALUES
(39, '2024-01-12', 'Pagi', 1, 'irfan', 'Stok Masuk', 'Claim', 'Xpander', 'asda123123', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'lecek', '', '', '', '', '', '', '', '', ''),
(40, '2024-01-12', 'Pagi', 1, 'irfan', 'Stok Masuk', 'Claim', 'Xpander', 'adsdasdasd', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', '', 'bintik', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ht_xforce`
--

CREATE TABLE `ht_xforce` (
  `id_htxf` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `shift` varchar(20) NOT NULL,
  `nama_teknisi` varchar(20) NOT NULL,
  `tdp` int(11) NOT NULL,
  `tbg` int(11) NOT NULL,
  `hdp` int(11) NOT NULL,
  `hbg` int(11) NOT NULL,
  `cdp` int(11) NOT NULL,
  `cbg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ht_xforce`
--

INSERT INTO `ht_xforce` (`id_htxf`, `tanggal`, `shift`, `nama_teknisi`, `tdp`, `tbg`, `hdp`, `hbg`, `cdp`, `cbg`) VALUES
(3, '2024-01-06', 'Malam', 'ujang', 123, 123, 122, 122, 1, 1),
(4, '2024-01-04', 'Pagi', 'fahri', 300, 300, 280, 280, 20, 20),
(5, '2024-01-10', 'Pagi', 'jasen', 90, 90, 87, 89, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ht_xpander`
--

CREATE TABLE `ht_xpander` (
  `id_htxp` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `shift` varchar(20) NOT NULL,
  `nama_teknisi` varchar(20) NOT NULL,
  `tdp` int(11) NOT NULL,
  `tbg` int(11) NOT NULL,
  `hdp` int(11) NOT NULL,
  `hbg` int(11) NOT NULL,
  `cdp` int(11) NOT NULL,
  `cbg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ht_xpander`
--

INSERT INTO `ht_xpander` (`id_htxp`, `tanggal`, `shift`, `nama_teknisi`, `tdp`, `tbg`, `hdp`, `hbg`, `cdp`, `cbg`) VALUES
(12, '2024-01-04', 'pagi', 'andika', 90, 91, 92, 93, 94, 95),
(13, '2024-01-03', 'malam', 'cesar', 123, 124, 125, 126, 127, 128),
(14, '2024-01-04', 'Pagi', 'vega', 120, 120, 110, 110, 10, 10),
(15, '2024-01-09', 'Pagi', 'jesen', 90, 90, 90, 90, 90, 90),
(17, '2024-01-12', 'Pagi', 'harno', 11, 11, 11, 11, 11, 11),
(18, '2024-01-24', 'Pagi', 'harno', 2, 2, 2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mt_xforce`
--

CREATE TABLE `mt_xforce` (
  `id_mtxf` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `deskripsi` text NOT NULL,
  `kdp` int(11) NOT NULL,
  `kbg` int(11) NOT NULL,
  `kpkr` int(11) NOT NULL,
  `kpkn` int(11) NOT NULL,
  `kskr` int(11) NOT NULL,
  `kskn` int(11) NOT NULL,
  `kmkr` int(11) NOT NULL,
  `kmkn` int(11) NOT NULL,
  `htdp` int(11) NOT NULL,
  `htbg` int(11) NOT NULL,
  `shift` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mt_xforce`
--

INSERT INTO `mt_xforce` (`id_mtxf`, `tanggal`, `keterangan`, `deskripsi`, `kdp`, `kbg`, `kpkr`, `kpkn`, `kskr`, `kskn`, `kmkr`, `kmkn`, `htdp`, `htbg`, `shift`) VALUES
(9, '2024-01-08', 'Stok Masuk', '', 240, 240, 240, 240, 240, 240, 240, 240, 240, 240, 'Pagi'),
(10, '2024-01-09', 'Stok Keluar', '', 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 'Pagi'),
(11, '2024-01-09', 'Stok Keluar', '', 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 'Malam'),
(12, '2024-01-12', 'Stok Masuk Dari Line', '', 11, 11, 11, 11, 11, 11, 11, 11, 11, 11, 'Pagi'),
(13, '2024-01-12', 'Stok Masuk', 'awdawdawdawdawdawdawdasdawdawd', 11, 11, 11, 11, 11, 11, 11, 111, 11, 11, 'Pagi');

-- --------------------------------------------------------

--
-- Table structure for table `mt_xpander`
--

CREATE TABLE `mt_xpander` (
  `id_mtxp` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `deskripsi` text NOT NULL,
  `kdp` int(11) NOT NULL,
  `kbg` int(11) NOT NULL,
  `kpkr` int(11) NOT NULL,
  `kpkn` int(11) NOT NULL,
  `kskr` int(11) NOT NULL,
  `kskn` int(11) NOT NULL,
  `kmdkr` int(11) NOT NULL,
  `kmdkn` int(11) NOT NULL,
  `kmbkr` int(11) NOT NULL,
  `kmbkn` int(11) NOT NULL,
  `shift` varchar(20) NOT NULL,
  `htdp` int(11) NOT NULL,
  `htbg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mt_xpander`
--

INSERT INTO `mt_xpander` (`id_mtxp`, `tanggal`, `keterangan`, `deskripsi`, `kdp`, `kbg`, `kpkr`, `kpkn`, `kskr`, `kskn`, `kmdkr`, `kmdkn`, `kmbkr`, `kmbkn`, `shift`, `htdp`, `htbg`) VALUES
(8, '2024-01-04', 'Stok Masuk', '', 800, 800, 800, 800, 800, 800, 800, 800, 800, 800, 'Pagi', 800, 800),
(9, '2024-01-04', 'Stok Keluar', '', 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 'Pagi', 90, 90),
(10, '2024-01-04', 'Stok Keluar', '', 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 'Malam', 150, 150),
(11, '2024-01-05', 'Stok Keluar', '', 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 'Pagi', 90, 90),
(12, '2024-01-05', 'Stok Keluar', '', 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 'Malam', 90, 90),
(14, '2024-01-08', 'Stok Masuk', '', 360, 360, 360, 360, 360, 360, 360, 360, 360, 360, 'Pagi', 360, 360),
(15, '2024-01-11', 'Stok Keluar', '', 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 'Pagi', 150, 150),
(16, '2024-01-11', 'Stok Keluar', '', 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 'Malam', 150, 150),
(17, '2024-01-12', 'Stok Keluar', '', 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 'Pagi', 150, 150),
(18, '2024-01-12', 'Stok Keluar', '', 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 'Malam', 150, 150),
(19, '2024-01-12', 'Stok Masuk', '', 120, 120, 120, 120, 120, 120, 120, 120, 120, 120, 'Pagi', 120, 120),
(20, '2024-01-12', 'Stok Masuk Dari Line', '', 11, 11, 11, 11, 11, 11, 11, 11, 11, 11, 'Pagi', 11, 11);

-- --------------------------------------------------------

--
-- Table structure for table `teknisi`
--

CREATE TABLE `teknisi` (
  `id_teknisi` int(5) NOT NULL,
  `nama_teknisi` varchar(20) NOT NULL,
  `heating` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teknisi`
--

INSERT INTO `teknisi` (`id_teknisi`, `nama_teknisi`, `heating`) VALUES
(1, 'irfan', ''),
(2, 'gema', ''),
(3, 'yudi', ''),
(4, 'muntoyo', ''),
(5, 'harno', 'YES'),
(6, 'fahri', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`) VALUES
(1, 'jasen', 'jasen', 'jasen123'),
(13, 'Vega Andriannata Atmadja', 'Vega', 'Vegaadul123'),
(14, 'Admin', 'Admin', 'Admin123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `claim_xforce`
--
ALTER TABLE `claim_xforce`
  ADD PRIMARY KEY (`id_c_xforce`);

--
-- Indexes for table `claim_xpander`
--
ALTER TABLE `claim_xpander`
  ADD PRIMARY KEY (`id_c_xpander`);

--
-- Indexes for table `ht_xforce`
--
ALTER TABLE `ht_xforce`
  ADD PRIMARY KEY (`id_htxf`);

--
-- Indexes for table `ht_xpander`
--
ALTER TABLE `ht_xpander`
  ADD PRIMARY KEY (`id_htxp`);

--
-- Indexes for table `mt_xforce`
--
ALTER TABLE `mt_xforce`
  ADD PRIMARY KEY (`id_mtxf`);

--
-- Indexes for table `mt_xpander`
--
ALTER TABLE `mt_xpander`
  ADD PRIMARY KEY (`id_mtxp`);

--
-- Indexes for table `teknisi`
--
ALTER TABLE `teknisi`
  ADD PRIMARY KEY (`id_teknisi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `claim_xforce`
--
ALTER TABLE `claim_xforce`
  MODIFY `id_c_xforce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `claim_xpander`
--
ALTER TABLE `claim_xpander`
  MODIFY `id_c_xpander` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `ht_xforce`
--
ALTER TABLE `ht_xforce`
  MODIFY `id_htxf` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ht_xpander`
--
ALTER TABLE `ht_xpander`
  MODIFY `id_htxp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `mt_xforce`
--
ALTER TABLE `mt_xforce`
  MODIFY `id_mtxf` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mt_xpander`
--
ALTER TABLE `mt_xpander`
  MODIFY `id_mtxp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `teknisi`
--
ALTER TABLE `teknisi`
  MODIFY `id_teknisi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
