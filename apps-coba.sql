-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.11 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

<<<<<<< Updated upstream
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for apps-coba
CREATE DATABASE IF NOT EXISTS `apps-coba` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `apps-coba`;

-- Dumping structure for table apps-coba.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `barang_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `satuan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`barang_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table apps-coba.barang: ~6 rows (approximately)
REPLACE INTO `barang` (`barang_id`, `kode`, `nama`, `satuan`, `harga`) VALUES
	(1, 'SIDT', 'Sirtu', 'Dump Truck', 350000),
	(2, 'SIBK', 'Sirtu', 'Bak Kayu', 400000),
	(3, 'PADT', 'Pasir', 'Dump Truck', 1100000),
	(4, 'PABK', 'Pasir', 'Bak Kayu', 1150000),
	(5, 'SUDT', 'Sumbangan', 'Dump Truck', 0),
	(6, 'SUBK', 'Sumbangan', 'Bak Kayu', 0);

-- Dumping structure for table apps-coba.bonus
CREATE TABLE IF NOT EXISTS `bonus` (
  `bonus_id` int(11) NOT NULL AUTO_INCREMENT,
  `barang` varchar(50) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `hari` int(11) DEFAULT NULL,
  `uang` bigint(20) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`bonus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table apps-coba.bonus: ~4 rows (approximately)
REPLACE INTO `bonus` (`bonus_id`, `barang`, `jumlah`, `hari`, `uang`, `status`) VALUES
	(1, '3,4', 5, 4, 150000, 'aktif'),
	(2, '3,4', 10, 7, 350000, 'aktif'),
	(3, '3,4', 15, 7, 650000, 'aktif'),
	(4, '3,4', 30, 10, 1500000, 'aktif');

-- Dumping structure for table apps-coba.konsumen
CREATE TABLE IF NOT EXISTS `konsumen` (
  `id_konsumen` int(11) NOT NULL AUTO_INCREMENT,
  `nama_konsumen` varchar(35) NOT NULL,
  `nopol` varchar(10) NOT NULL,
  `bonus` int(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_konsumen`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table apps-coba.konsumen: ~4 rows (approximately)
REPLACE INTO `konsumen` (`id_konsumen`, `nama_konsumen`, `nopol`, `bonus`, `created_at`) VALUES
	(3, 'gani', 'aa', NULL, '2023-10-20 13:37:27'),
	(4, 'putro', 'bb', NULL, '2023-10-21 09:17:23'),
	(5, 'yusuf', 'cc', NULL, '2023-10-20 13:37:32'),
	(6, 'radit', 'dd', NULL, '2023-10-20 13:37:33');

-- Dumping structure for table apps-coba.login
CREATE TABLE IF NOT EXISTS `login` (
=======
--
-- Table structure for table `konsumen`
--
CREATE TABLE `konsumen` (
  `id_konsumen` int(11) NOT NULL,
  `nama_konsumen` varchar(35) NOT NULL,
  `nopol` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `konsumen` (`id_konsumen`, `nama_konsumen`, `nopol`, `created_at`) VALUES (3, 'gani', 'aa', '2023-10-20 20:37:27');
INSERT INTO `konsumen` (`id_konsumen`, `nama_konsumen`, `nopol`, `created_at`) VALUES (4, 'putro', 'bb', '2023-10-21 16:17:23');
INSERT INTO `konsumen` (`id_konsumen`, `nama_konsumen`, `nopol`, `created_at`) VALUES (5, 'yusuf', 'cc', '2023-10-20 20:37:32');
INSERT INTO `konsumen` (`id_konsumen`, `nama_konsumen`, `nopol`, `created_at`) VALUES (6, 'radit', 'dd', '2023-10-20 20:37:33');


-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
>>>>>>> Stashed changes
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table apps-coba.login: ~1 rows (approximately)
REPLACE INTO `login` (`username`, `password`) VALUES
	('admin', 'admin');

-- Dumping structure for table apps-coba.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `transaksi_id` int(11) NOT NULL AUTO_INCREMENT,
  `konsumen_id` int(11) DEFAULT NULL,
  `barang_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `jumlah` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `total_harga` bigint(20) DEFAULT NULL,
  `total_bayar` bigint(20) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
<<<<<<< Updated upstream
  `nota` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `bonus` varchar(50) DEFAULT NULL,
  `status_bonus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`transaksi_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

-- Dumping data for table apps-coba.transaksi: ~3 rows (approximately)
REPLACE INTO `transaksi` (`transaksi_id`, `konsumen_id`, `barang_id`, `jumlah`, `total_harga`, `total_bayar`, `tanggal`, `nota`, `bonus`, `status_bonus`) VALUES
	(49, 4, '3', '1', 1100000, 1100000, '2023-10-20 18:55:15', '6T0WDAWPAY9BDML', 'Pasir(Dump Truck),Pasir(Bak Kayu): 1/5 (Rp.150000)', '0'),
	(50, 4, '3', '1', 1100000, 1100000, '2023-10-20 19:05:42', 'WBBKWKZ8SPIH86D', 'Pasir(Dump Truck),Pasir(Bak Kayu): 2/5 (Rp.150000)', '0'),
	(51, 4, '3,4', '5,3', 9050000, 9050000, '2023-10-26 10:06:01', 'HLPCAPO96JO8UQ0', 'Pasir(Dump Truck),Pasir(Bak Kayu): 10/10 (Rp.35000', '1,1'),
	(64, 4, '4', '1', 1150000, 1150000, '2023-10-27 19:44:26', 'KO66MZ7506C3F5U', 'Pasir(Dump Truck),Pasir(Bak Kayu): 3/5 (Rp.150000)', '1'),
	(65, 4, '3', '2', 2200000, 2200000, '2023-10-27 19:45:14', 'VM7CWYMNJ07UXWW', 'Pasir(Dump Truck),Pasir(Bak Kayu): 5/5 (Rp.150000)', '1'),
	(66, 4, '3', '1', 1100000, 1100000, '2023-10-27 19:45:36', '12JWZNUOCBZKQ3W', 'Pasir(Dump Truck),Pasir(Bak Kayu): 6/5 (Rp.150000)', '1'),
	(73, 4, '3', '1', 1100000, 1100000, '2023-10-27 20:32:10', 'GFNJBRSB5WWUZSZ', 'Pasir(Dump Truck),Pasir(Bak Kayu): 13/10 (Rp.35000', '1'),
	(74, 4, '3', '1', 1100000, 1100000, '2023-10-27 20:33:40', 'YH7HO7LMK074DOU', 'Pasir(Dump Truck),Pasir(Bak Kayu): 14/10 (Rp.35000', '1'),
	(76, 4, '1,3', '1,1', 1450000, 1450000, '2023-10-27 20:56:23', 'ED6GM95MJDLISJX', 'Pasir(Dump Truck),Pasir(Bak Kayu): 1/5 (Rp.150000)', '0,1'),
	(77, 4, '2,4', '4,4', 6200000, 6200000, '2023-10-27 20:57:14', 'UX6CE7DTB1TE0U2', 'Pasir(Dump Truck),Pasir(Bak Kayu): 5/5 (Rp.150000)', '0,1'),
	(78, 4, '2', '1', 400000, 400000, '2023-10-27 20:57:48', 'JF7Z5HU2BAGJGSQ', 'Pasir(Dump Truck),Pasir(Bak Kayu): 0/5 (Rp.150000)', '0');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
=======
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

CREATE TABLE `bonus` (
  `bonus_id` int(11) NOT NULL,
  `barang` VARCHAR(50) NULL DEFAULT NULL,
	`jumlah` INT(11) NULL DEFAULT NULL,
	`hari` INT(11) NULL DEFAULT NULL,
	`uang` BIGINT(20) NULL DEFAULT NULL,
	`status` VARCHAR(50) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `bonus`
  ADD PRIMARY KEY (`bonus_id`);

INSERT INTO `bonus` (`bonus_id`, `barang`, `jumlah`, `hari`, `uang`, `status`) VALUES (1, '3,4', 5, 4, 150000, 'aktif');
INSERT INTO `bonus` (`bonus_id`, `barang`, `jumlah`, `hari`, `uang`, `status`) VALUES (2, '3,4', 10, 7, 350000, 'aktif');
INSERT INTO `bonus` (`bonus_id`, `barang`, `jumlah`, `hari`, `uang`, `status`) VALUES (3, '3,4', 15, 7, 650000, 'aktif');
INSERT INTO `bonus` (`bonus_id`, `barang`, `jumlah`, `hari`, `uang`, `status`) VALUES (4, '3,4', 30, 10, 1500000, 'aktif');

ALTER TABLE `transaksi`
	ADD COLUMN `status_bonus` VARCHAR(50) NULL DEFAULT NULL AFTER `bonus`;
>>>>>>> Stashed changes
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
