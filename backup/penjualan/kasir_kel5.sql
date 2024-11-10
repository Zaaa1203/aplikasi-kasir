-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2024 at 03:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir_kel5`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `detail_id` int(11) NOT NULL,
  `kode_produk` varchar(15) DEFAULT NULL,
  `nama_produk` varchar(50) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `penjualan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`detail_id`, `kode_produk`, `nama_produk`, `harga`, `jumlah`, `penjualan_id`) VALUES
(80, 'M.001', 'Teh Pucuk', 3000, 2, 48),
(81, 'M.002', 'Cocacola', 4000, 1, 51),
(82, 'M.003', 'Sprit', 4000, 1, 51),
(83, 'M.001', 'Teh Pucuk', 3000, 2, 52),
(84, 'S.003', 'Chitato Lite', 2000, 2, 52),
(85, 'S.002', 'Beng Beng', 3000, 1, 52),
(86, 'M.001', 'Teh Pucuk', 3000, 1, 53),
(87, 'M.003', 'Sprit', 4000, 1, 54),
(88, 'S.002', 'Beng Beng', 3000, 1, 54),
(89, 'M.001', 'Teh Pucuk', 3000, 1, 54),
(91, 'S.002', 'Beng Beng', 3000, 4, 55),
(92, 'S.003', 'Chitato Lite', 2000, 6, 55),
(93, 'M.001', 'Teh Pucuk', 3000, 2, 57),
(94, 'M.003', 'Sprit', 4000, 5, 57),
(95, 'S.002', 'Beng Beng', 3000, 1, 59),
(96, 'S.003', 'Chitato Lite', 2000, 1, 60),
(97, 'S.001', 'Chiki Ring', 2000, 2, 61),
(98, 'M.003', 'Sprit', 4000, 2, 64),
(99, 'S.003', 'Chitato Lite', 2000, 4, 66),
(100, 'S.001', 'Chiki Ring', 2000, 1, 73),
(101, 'M.008', 'Aqua 600ml', 3000, 1, 79),
(102, 'S.002', 'Beng Beng', 3000, 1, 81),
(103, 'S.001', 'Chiki Ring', 2000, 1, 83),
(104, 'S.001', 'Chiki Ring', 2000, 3, 84),
(105, 'M.004', 'Ichi Ocha', 4000, 1, 84),
(106, 'S.001', 'Chiki Ring', 2000, 1, 86),
(107, 'M.007', 'Isoplus', 4000, 3, 87);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `kode_pelanggan` varchar(15) DEFAULT NULL,
  `nama_pelanggan` varchar(30) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `kode_pelanggan`, `nama_pelanggan`, `alamat`, `no_hp`) VALUES
(1, 'P.001', 'Alan Rusdiana', 'Jl. K.H. Abdul Halim No. 2000 Majalengka', '085111222333'),
(2, 'P.002', 'Asep Darmawan', 'Lingk. Dahlia No. 20 Majalengka', '085222333444');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`penjualan_id`, `tanggal`, `total_harga`, `bayar`, `id_pelanggan`, `id_petugas`, `nama_petugas`) VALUES
(48, '2024-11-05 16:01:26', 6000, 7000, 1, 5, 'Latif'),
(49, '2024-11-05 16:14:04', NULL, NULL, NULL, 0, NULL),
(50, '2024-11-05 16:22:20', NULL, NULL, NULL, 0, NULL),
(51, '2024-11-05 16:29:37', NULL, NULL, NULL, 0, NULL),
(52, '2024-11-05 16:36:34', 13000, 50000, 1, 5, 'Latif'),
(53, '2024-11-05 16:39:42', 3000, 30000, 1, 5, 'Latif'),
(54, '2024-11-05 17:13:44', 10000, 20000, 2, 9, 'Neng dian'),
(55, '2024-11-05 17:15:00', 24000, 50000, NULL, 9, 'Neng dian'),
(56, '2024-11-05 17:22:52', NULL, NULL, NULL, 0, NULL),
(57, '2024-11-05 17:27:38', 26000, 30000, NULL, 9, 'Neng dian'),
(58, '2024-11-05 17:31:42', NULL, NULL, 0, 0, NULL),
(59, '2024-11-06 14:19:18', 3000, 5000, NULL, 9, 'Neng dian'),
(60, '2024-11-06 14:35:35', 2000, 3000, 1, 9, 'Neng dian'),
(61, '2024-11-06 14:36:46', 4000, 5000, NULL, 9, 'Neng dian'),
(62, '2024-11-06 14:40:43', NULL, NULL, NULL, 0, NULL),
(63, '2024-11-06 14:47:00', NULL, NULL, NULL, 0, NULL),
(64, '2024-11-06 14:51:06', 8000, 10000, NULL, 9, 'Neng dian'),
(65, '2024-11-06 14:54:08', NULL, NULL, NULL, 0, NULL),
(66, '2024-11-06 14:56:22', 8000, 10000, NULL, 9, 'Neng dian'),
(67, '2024-11-06 15:02:26', NULL, NULL, NULL, 0, NULL),
(68, '2024-11-06 15:05:06', NULL, NULL, NULL, 0, NULL),
(69, '2024-11-06 15:07:39', NULL, NULL, NULL, 0, NULL),
(70, '2024-11-06 15:08:05', NULL, NULL, NULL, 0, NULL),
(71, '2024-11-06 15:29:47', NULL, NULL, NULL, 0, NULL),
(72, '2024-11-07 06:50:57', NULL, NULL, NULL, 0, NULL),
(73, '2024-11-07 07:28:10', 2000, 2000, NULL, 5, 'Latif'),
(74, '2024-11-07 07:37:39', NULL, NULL, NULL, 0, NULL),
(75, '2024-11-07 08:19:40', NULL, NULL, NULL, 0, NULL),
(76, '2024-11-07 08:20:23', NULL, NULL, NULL, 0, NULL),
(77, '2024-11-07 08:21:58', NULL, NULL, NULL, 0, NULL),
(78, '2024-11-07 08:22:26', NULL, NULL, NULL, 0, NULL),
(79, '2024-11-07 08:31:19', 3000, 5000, NULL, 11, 'petugas'),
(80, '2024-11-07 08:51:23', NULL, NULL, NULL, 0, NULL),
(81, '2024-11-07 08:52:09', NULL, NULL, NULL, 0, NULL),
(82, '2024-11-07 08:52:20', NULL, NULL, NULL, 0, NULL),
(83, '2024-11-07 08:52:35', 2000, 3000, NULL, 11, 'petugas'),
(84, '2024-11-07 08:56:50', 10000, 5000000, NULL, 11, 'petugas'),
(86, '2024-11-07 10:58:59', 2000, 3000, NULL, 5, 'Latif'),
(87, '2024-11-07 11:10:25', 12000, 20000, 1, 5, 'Latif'),
(92, '2024-11-10 21:20:03', NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `nama_petugas` varchar(35) DEFAULT NULL,
  `level` enum('admin','petugas') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `level`) VALUES
(1, 'Razza', 'admin', 'Razza', 'admin'),
(5, 'Latif', 'petugas', 'Latif', 'petugas'),
(6, 'Mahfud', 'petugas', 'Mahfud', 'petugas'),
(7, 'Hendra', 'petugas', 'Hendra', 'petugas'),
(9, 'Dian', 'petugas', 'Neng dian', 'petugas'),
(10, 'admin', 'admin', 'admin', 'admin'),
(11, 'petugas', 'petugas', 'petugas', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(15) DEFAULT NULL,
  `nama_produk` varchar(50) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `kode_produk`, `nama_produk`, `harga`, `stok`) VALUES
(1, 'M.001', 'Teh Pucuk', 3000, 25),
(2, 'M.002', 'Cocacola', 4000, 25),
(3, 'M.003', 'Sprit', 4000, 50),
(4, 'S.003', 'Chitato Lite', 2000, 25),
(6, 'S.001', 'Chiki Ring', 2000, 10),
(7, 'S.002', 'Beng Beng', 3000, 10),
(8, 'M.004', 'Ichi Ocha', 4000, 35),
(9, 'M.005', 'Mizone', 5000, 40),
(10, 'M.006', 'Frestea', 4000, 40),
(11, 'M.007', 'Isoplus', 4000, 55),
(12, 'M.008', 'Aqua 600ml', 3000, 35),
(13, 'M.009', 'Le Mineral 600ml', 3000, 43),
(14, 'M.010', 'Teh Kotak', 3000, 35),
(15, 'S.004', 'Lays', 2000, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tambah_stok`
--

CREATE TABLE `tambah_stok` (
  `tambah_id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `kode_produk` varchar(15) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tambah_stok`
--

INSERT INTO `tambah_stok` (`tambah_id`, `tanggal`, `kode_produk`, `jumlah`) VALUES
(1, '2024-01-31 08:39:02', 'M.001', 20),
(2, '2024-01-31 08:39:48', 'M.002', 10),
(3, '2024-01-31 08:41:23', 'M.003', 20),
(4, '2024-01-31 08:43:53', 'M.005', 10),
(5, '0000-00-00 00:00:00', 'M.001', 10),
(6, '0000-00-00 00:00:00', 'M.001', 50),
(7, '0000-00-00 00:00:00', 'D.002', 10),
(8, '2024-10-31 15:24:02', 'M.001', 1),
(9, '0000-00-00 00:00:00', 'M.002', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`penjualan_id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tambah_stok`
--
ALTER TABLE `tambah_stok`
  ADD PRIMARY KEY (`tambah_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tambah_stok`
--
ALTER TABLE `tambah_stok`
  MODIFY `tambah_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
