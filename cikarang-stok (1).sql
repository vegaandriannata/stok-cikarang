-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2024 at 09:53 AM
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
  `kdp` int(11) NOT NULL,
  `kbg` int(11) NOT NULL,
  `kpkr` int(11) NOT NULL,
  `kpkn` int(11) NOT NULL,
  `kskr` int(11) NOT NULL,
  `kskn` int(11) NOT NULL,
  `kmkr` int(11) NOT NULL,
  `kmkn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `claim_xforce`
--

INSERT INTO `claim_xforce` (`id_c_xforce`, `tanggal`, `shift`, `keterangan`, `kdp`, `kbg`, `kpkr`, `kpkn`, `kskr`, `kskn`, `kmkr`, `kmkn`) VALUES
(1, '2024-01-02', 'pagi', 'Stok Masuk', 345, 345, 345, 345, 345, 345, 345, 345),
(2, '2024-01-04', 'malam', 'Stok Keluar', 123, 123, 123, 123, 123, 123, 123, 123),
(3, '2024-01-08', 'Pagi', 'Stok Masuk', 240, 240, 240, 240, 240, 240, 240, 240);

-- --------------------------------------------------------

--
-- Table structure for table `claim_xpander`
--

CREATE TABLE `claim_xpander` (
  `id_c_xpander` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `shift` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `kdp` int(11) NOT NULL,
  `kbg` int(11) NOT NULL,
  `kpkr` int(11) NOT NULL,
  `kpkn` int(11) NOT NULL,
  `kskr` int(11) NOT NULL,
  `kskn` int(11) NOT NULL,
  `kmdkr` int(11) NOT NULL,
  `kmdkn` int(11) NOT NULL,
  `kmbkr` int(11) NOT NULL,
  `kmbkn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `claim_xpander`
--

INSERT INTO `claim_xpander` (`id_c_xpander`, `tanggal`, `shift`, `keterangan`, `kdp`, `kbg`, `kpkr`, `kpkn`, `kskr`, `kskn`, `kmdkr`, `kmdkn`, `kmbkr`, `kmbkn`) VALUES
(1, '2024-01-02', 'pagi', 'Stok Masuk', 123, 111, 111, 111, 111, 111, 111, 111, 111, 111),
(2, '2024-01-10', 'Pagi', 'Stok Masuk', 1, 2, 0, 0, 2, 1, 0, 0, 1, 2),
(3, '2024-01-10', 'Pagi', 'Stok Keluar', 3, 0, 0, 2, 2, 1, 0, 2, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ht_xforce`
--

CREATE TABLE `ht_xforce` (
  `id_htxf` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `shift` varchar(20) NOT NULL,
  `nama` varchar(20) NOT NULL,
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

INSERT INTO `ht_xforce` (`id_htxf`, `tanggal`, `shift`, `nama`, `tdp`, `tbg`, `hdp`, `hbg`, `cdp`, `cbg`) VALUES
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
  `nama` varchar(20) NOT NULL,
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

INSERT INTO `ht_xpander` (`id_htxp`, `tanggal`, `shift`, `nama`, `tdp`, `tbg`, `hdp`, `hbg`, `cdp`, `cbg`) VALUES
(12, '2024-01-04', 'pagi', 'andika', 90, 91, 92, 93, 94, 95),
(13, '2024-01-03', 'malam', 'cesar', 123, 124, 125, 126, 127, 128),
(14, '2024-01-04', 'Pagi', 'vega', 120, 120, 110, 110, 10, 10),
(15, '2024-01-09', 'Pagi', 'jesen', 90, 90, 90, 90, 90, 90);

-- --------------------------------------------------------

--
-- Table structure for table `mt_xforce`
--

CREATE TABLE `mt_xforce` (
  `id_mtxf` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
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

INSERT INTO `mt_xforce` (`id_mtxf`, `tanggal`, `keterangan`, `kdp`, `kbg`, `kpkr`, `kpkn`, `kskr`, `kskn`, `kmkr`, `kmkn`, `htdp`, `htbg`, `shift`) VALUES
(9, '2024-01-08', 'Stok Masuk', 240, 240, 240, 240, 240, 240, 240, 240, 240, 240, 'Pagi'),
(10, '2024-01-09', 'Stok Keluar', 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 'Pagi'),
(11, '2024-01-09', 'Stok Keluar', 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 'Malam');

-- --------------------------------------------------------

--
-- Table structure for table `mt_xpander`
--

CREATE TABLE `mt_xpander` (
  `id_mtxp` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
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

INSERT INTO `mt_xpander` (`id_mtxp`, `tanggal`, `keterangan`, `kdp`, `kbg`, `kpkr`, `kpkn`, `kskr`, `kskn`, `kmdkr`, `kmdkn`, `kmbkr`, `kmbkn`, `shift`, `htdp`, `htbg`) VALUES
(8, '2024-01-04', 'Stok Masuk', 800, 800, 800, 800, 800, 800, 800, 800, 800, 800, 'Pagi', 800, 800),
(9, '2024-01-04', 'Stok Keluar', 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 'Pagi', 90, 90),
(10, '2024-01-04', 'Stok Keluar', 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 'Malam', 150, 150),
(11, '2024-01-05', 'Stok Keluar', 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 'Pagi', 90, 90),
(12, '2024-01-05', 'Stok Keluar', 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 'Malam', 90, 90),
(13, '2024-01-10', 'Stok Masuk', 240, 240, 240, 240, 240, 240, 240, 240, 240, 240, 'Pagi', 240, 240),
(14, '2024-01-08', 'Stok Masuk', 360, 360, 360, 360, 360, 360, 360, 360, 360, 360, 'Pagi', 360, 360),
(15, '2024-01-11', 'Stok Keluar', 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 'Pagi', 150, 150),
(16, '2024-01-11', 'Stok Keluar', 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 'Malam', 150, 150),
(17, '2024-01-12', 'Stok Keluar', 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 'Pagi', 150, 150),
(18, '2024-01-12', 'Stok Keluar', 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 'Malam', 150, 150);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `claim_xforce`
--
ALTER TABLE `claim_xforce`
  MODIFY `id_c_xforce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `claim_xpander`
--
ALTER TABLE `claim_xpander`
  MODIFY `id_c_xpander` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ht_xforce`
--
ALTER TABLE `ht_xforce`
  MODIFY `id_htxf` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ht_xpander`
--
ALTER TABLE `ht_xpander`
  MODIFY `id_htxp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mt_xforce`
--
ALTER TABLE `mt_xforce`
  MODIFY `id_mtxf` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mt_xpander`
--
ALTER TABLE `mt_xpander`
  MODIFY `id_mtxp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
