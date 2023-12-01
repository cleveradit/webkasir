-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for apps-kasir
CREATE DATABASE IF NOT EXISTS `apps-kasir` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `apps-kasir`;

-- Dumping structure for table apps-kasir.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `barang_id` int NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `satuan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `harga` bigint DEFAULT NULL,
  PRIMARY KEY (`barang_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table apps-kasir.barang: ~6 rows (approximately)
INSERT INTO `barang` (`barang_id`, `kode`, `nama`, `satuan`, `harga`) VALUES
	(10, 'SIDT', 'Sirtu', 'Dump Truck', 350000),
	(11, 'SIBK', 'Sirtu', 'Bak Kayu', 400000),
	(12, 'PADT', 'Pasir', 'Dump Truck', 1100000),
	(13, 'PABK', 'Pasir', 'Bak Kayu', 1150000),
	(14, 'SUDT', 'Sumbangan', 'Dump Truck', 0),
	(15, 'SUBK', 'Sumbangan', 'Bak Kayu', 0);

-- Dumping structure for table apps-kasir.bonus
CREATE TABLE IF NOT EXISTS `bonus` (
  `bonus_id` int NOT NULL AUTO_INCREMENT,
  `barang` varchar(50) DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `hari` int DEFAULT NULL,
  `uang` bigint DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`bonus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table apps-kasir.bonus: ~4 rows (approximately)
INSERT INTO `bonus` (`bonus_id`, `barang`, `jumlah`, `hari`, `uang`, `status`) VALUES
	(11, '12,13', 5, 4, 150000, 'aktif'),
	(12, '12,13', 10, 7, 350000, 'aktif'),
	(13, '12,13', 15, 7, 650000, 'aktif'),
	(14, '12,13', 30, 10, 1500000, 'aktif');

-- Dumping structure for table apps-kasir.konsumen
CREATE TABLE IF NOT EXISTS `konsumen` (
  `id_konsumen` int NOT NULL AUTO_INCREMENT,
  `nama_konsumen` varchar(35) NOT NULL,
  `nopol` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_konsumen`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table apps-kasir.konsumen: ~0 rows (approximately)

-- Dumping structure for table apps-kasir.login
CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table apps-kasir.login: ~1 rows (approximately)
INSERT INTO `login` (`username`, `password`) VALUES
	('admin', 'admin');

-- Dumping structure for table apps-kasir.pengeluaran
CREATE TABLE IF NOT EXISTS `pengeluaran` (
  `id_pengeluaran` int NOT NULL AUTO_INCREMENT,
  `nama_member` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `kuantitas` int DEFAULT NULL,
  `harga_satuan` int DEFAULT NULL,
  `harga_total` int DEFAULT NULL,
  `nota_pengeluaran` text,
  `tanggal` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pengeluaran`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table apps-kasir.pengeluaran: ~0 rows (approximately)

-- Dumping structure for table apps-kasir.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `transaksi_id` int NOT NULL AUTO_INCREMENT,
  `konsumen_id` int DEFAULT NULL,
  `barang_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `jumlah` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `total_harga` bigint DEFAULT NULL,
  `total_bayar` bigint DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `nota` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `bonus` varchar(50) DEFAULT NULL,
  `status_bonus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`transaksi_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=latin1;

-- Dumping data for table apps-kasir.transaksi: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
