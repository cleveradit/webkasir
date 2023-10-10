-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2023 at 12:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `id_konsumen` int(11) NOT NULL,
  `nama_konsumen` varchar(35) NOT NULL,
  `nopol` varchar(10) NOT NULL,
  `saldo` int(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`id_konsumen`, `nama_konsumen`, `nopol`, `saldo`, `created_at`) VALUES
(3, 'qweq', 'qeasd', 123, '2023-10-06 06:17:30'),
(4, 'abcabc', 'zzzzzz', 12312, '2023-10-06 06:18:00'),
(5, 'asdas', 'qwfq', 12341, '2023-10-06 05:25:31'),
(6, 'tes1', 'tes1', 1231, '2023-10-06 06:25:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id_konsumen`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `id_konsumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE TABLE `barang` (
	`barang_id` INT(11) NOT NULL AUTO_INCREMENT,
	`kode` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`nama` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`satuan` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`harga` BIGINT(20) NULL DEFAULT NULL,
	PRIMARY KEY (`barang_id`) USING BTREE
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=7
;

INSERT INTO `barang` (`barang_id`, `kode`, `nama`, `satuan`, `harga`) VALUES (1, 'SIDT', 'Sirtu', 'Dump Truck', 350000);
INSERT INTO `barang` (`barang_id`, `kode`, `nama`, `satuan`, `harga`) VALUES (2, 'SIBK', 'Sirtu', 'Bak Kayu', 400000);
INSERT INTO `barang` (`barang_id`, `kode`, `nama`, `satuan`, `harga`) VALUES (3, 'PADT', 'Pasir', 'Dump Truck', 1100000);
INSERT INTO `barang` (`barang_id`, `kode`, `nama`, `satuan`, `harga`) VALUES (4, 'PABK', 'Pasir', 'Bak Kayu', 1150000);
INSERT INTO `barang` (`barang_id`, `kode`, `nama`, `satuan`, `harga`) VALUES (5, 'SUDT', 'Sumbangan', 'Dump Truck', 0);
INSERT INTO `barang` (`barang_id`, `kode`, `nama`, `satuan`, `harga`) VALUES (6, 'SUBK', 'Sumbangan', 'Bak Kayu', 0);


CREATE TABLE `transaksi` (
	`transaksi_id` INT(11) NOT NULL AUTO_INCREMENT,
	`konsumen_id` INT(11) NULL DEFAULT NULL,
	`barang_id` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`jumlah` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`total_harga` BIGINT(20) NULL DEFAULT NULL,
	`total_bayar` BIGINT(20) NULL DEFAULT NULL,
	`tanggal` DATETIME NULL DEFAULT NULL,
	`nota` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	PRIMARY KEY (`transaksi_id`) USING BTREE
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=2
;

INSERT INTO `transaksi` (`transaksi_id`, `konsumen_id`, `barang_id`, `jumlah`, `total_harga`, `total_bayar`, `tanggal`, `nota`) VALUES (1, 1, '1,2', '1,1', 750000, 1000000, '2023-10-07 12:54:56', 'A1A1');
