-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2023 at 04:03 AM
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
-- Table structure for table `bonus`
--

CREATE TABLE `bonus` (
  `bonus_id` int(11) NOT NULL,
  `barang` varchar(50) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `hari` int(11) DEFAULT NULL,
  `uang` bigint(20) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bonus`
--

INSERT INTO `bonus` (`bonus_id`, `barang`, `jumlah`, `hari`, `uang`, `status`) VALUES
(1, '3,4', 5, 4, 150000, 'aktif'),
(2, '3,4', 10, 7, 350000, 'aktif'),
(3, '3,4', 15, 7, 650000, 'aktif'),
(4, '3,4', 30, 10, 1500000, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `id_konsumen` int(11) NOT NULL,
  `nama_konsumen` varchar(35) NOT NULL,
  `nopol` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`id_konsumen`, `nama_konsumen`, `nopol`, `created_at`) VALUES
(3, 'gani', 'aa', '2023-10-20 20:37:27'),
(4, 'putro', 'bb', '2023-10-21 16:17:23'),
(5, 'yusuf', 'cc', '2023-10-20 20:37:32'),
(6, 'radit', 'dd', '2023-10-20 20:37:33');

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
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `nama_member` varchar(15) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `kuantitas` int(5) NOT NULL,
  `harga_satuan` int(15) NOT NULL,
  `harga_total` int(15) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `id_pengeluaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`nama_member`, `nama_barang`, `kuantitas`, `harga_satuan`, `harga_total`, `id_pengeluaran`) VALUES
('rusli', 'kecap', 1, 1000, 1000, 1, 2023-10-31 09:48:57),
('rusli', 'kecap', 1, 5000, 5000, 2, 2023-11-04 02:54:46),
('rusli', 'kecap', 3, 15000, 45000, 3, 2023-11-04 10:14:30);

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
  `nota` varchar(50) DEFAULT NULL,
  `bonus` varchar(50) DEFAULT NULL,
  `status_bonus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `konsumen_id`, `barang_id`, `jumlah`, `total_harga`, `total_bayar`, `tanggal`, `nota`, `bonus`, `status_bonus`) VALUES
(21, 3, '1', '1', 350000, 350000, '2023-10-31 12:03:58', 'C2HO6TI6A2X3AQN', 'Pasir(Dump Truck),Pasir(Bak Kayu): 0/5 (Rp.150000)', '0'),
(22, 3, '1', '-1', -350000, 350000, '2023-10-31 12:07:03', 'Z0DSPGZMJK8VO54', 'Pasir(Dump Truck),Pasir(Bak Kayu): 0/5 (Rp.150000)', '0'),
(23, 5, '2', '1', 400000, 400000, '2023-11-02 15:18:47', 'IW1HGK74ZWKYKRJ', 'Pasir(Dump Truck),Pasir(Bak Kayu): 0/5 (Rp.150000)', '0'),
(24, 3, '3', '1', 1100000, 1100000, '2023-11-02 15:20:34', 'CNONT3IWMFOCOD4', 'Pasir(Dump Truck),Pasir(Bak Kayu): 1/5 (Rp.150000)', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barang_id`) USING BTREE;

--
-- Indexes for table `bonus`
--
ALTER TABLE `bonus`
  ADD PRIMARY KEY (`bonus_id`);

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
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

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
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
