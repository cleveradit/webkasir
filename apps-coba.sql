-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2023 at 09:05 PM
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
-- Database: `apps-coba`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `barang_id` int(11) NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`barang_id`, `kode`, `nama`, `satuan`, `harga`) VALUES
(1, 'SIDT', 'Sirtu', 'Dump Truck', 350000),
(2, 'SIBK', 'Sirtu', 'Bak Kayu', 400000),
(3, 'PADT', 'Pasir', 'Dump Truck', 1100000),
(4, 'PABK', 'Pasir', 'Bak Kayu', 1150000),
(5, 'SUDT', 'Sumbangan', 'Dump Truck', 0),
(6, 'SUBK', 'Sumbangan', 'Bak Kayu', 0);

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `id_konsumen` int(11) NOT NULL,
  `nama_konsumen` varchar(35) NOT NULL,
  `nopol` varchar(10) NOT NULL,
  `saldo` int(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`id_konsumen`, `nama_konsumen`, `nopol`, `saldo`, `created_at`) VALUES
(3, 'qweq', 'qeasd', 123, '2023-10-06 06:17:30'),
(4, 'abcabc', 'zzzzzz', 12312, '2023-10-06 06:18:00'),
(5, 'asdas', 'qwfq', 12341, '2023-10-06 05:25:31'),
(6, 'tes1', 'tes1', 1231, '2023-10-06 06:25:19'),
(7, 'qweq', 'qwerqwr', 342, '2023-10-11 20:57:21'),
(8, 'qweq', 'qweq', 123, '2023-10-11 20:57:38'),
(9, 'qweq', 'qweq', 1231, '2023-10-11 20:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `konsumen_id` int(11) DEFAULT NULL,
  `barang_id` varchar(50) DEFAULT NULL,
  `jumlah` varchar(50) DEFAULT NULL,
  `total_harga` bigint(20) DEFAULT NULL,
  `total_bayar` bigint(20) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `nota` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `konsumen_id`, `barang_id`, `jumlah`, `total_harga`, `total_bayar`, `tanggal`, `nota`) VALUES
(1, 3, '1,2', '1,1', 750000, 1000000, '2023-10-07 12:54:56', 'A1A1'),
(2, 4, '1,2', '1,1', 750000, 1000000, '2023-10-13 12:54:56', 'A1A1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barang_id`) USING BTREE;

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id_konsumen`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `id_konsumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `transaksi`
	ADD COLUMN `bonus` VARCHAR(50) NULL DEFAULT NULL AFTER `nota`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
