-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2020 at 04:41 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank-semar`
--

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nik_karyawan` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `hak_akses` tinyint(4) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `lama_bekerja` int(11) NOT NULL,
  `gaji` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nik_karyawan`, `password`, `nama_karyawan`, `jabatan`, `hak_akses`, `tanggal_masuk`, `lama_bekerja`, `gaji`, `uuid`, `updated_at`) VALUES
(3, '12171577', '$2y$10$Aazhwh3IOJph1SK/G/bTF.Qq8SVZrHD.cHwYtKzv/y1OHIiuYRobW', 'Deni Ambarwati', 'owner', 6, '2020-08-15', 10, 1000000, '57f36b67-de65-11ea-a4c0-4cedfb2aff5f', '2020-08-14 19:35:43'),
(4, '12171584', '$2y$10$qjA4cJi9BFmbucxLvCFUeu0JgVwGRo60v.g0pYHoC2KwTcir6NuEq', 'Fajar Santoso', 'karyawan', 1, '2020-08-15', 20, 1000000, '68b01d26-de70-11ea-a4c0-4cedfb2aff5f', '2020-08-14 20:54:56'),
(5, '12171581', '$2y$10$sRNcQd115g93e/oAQQcJN.35V6sNdGGgD072IWVR3EJEs1.qS/1OW', 'Antonius A', 'superadmin', 0, '2020-08-15', 20, 1000000, 'd16fead3-deab-11ea-af1f-4cedfb2aff5f', '2020-08-15 04:00:12');

--
-- Triggers `karyawan`
--
DELIMITER $$
CREATE TRIGGER `generate_uuid_karyawan` BEFORE INSERT ON `karyawan` FOR EACH ROW SET new.uuid = uuid()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `nama_member` varchar(100) NOT NULL,
  `kode_member` varchar(225) NOT NULL,
  `alamat_member` text NOT NULL,
  `nik_member` varchar(225) NOT NULL,
  `tanggal_bergabung` date NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `kode_supplier` varchar(225) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `uuid_kategori` varchar(225) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `alamat_supplier` text NOT NULL,
  `no_hp_supplier` varchar(12) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `kode_supplier`, `nama_supplier`, `uuid_kategori`, `nama_kategori`, `alamat_supplier`, `no_hp_supplier`, `uuid`, `updated_at`) VALUES
(1, '12171577', 'PT DENI A', '327846237462374623746247', 'Beras', 'Jln. Cempaka Baru R4, Condongcatur, Depok, Sleman', '08999239151', '1b53debb-de6f-11ea-a4c0-4cedfb2aff5f', '2020-08-14 20:46:29');

--
-- Triggers `supplier`
--
DELIMITER $$
CREATE TRIGGER `generate_uuid_supplier` BEFORE INSERT ON `supplier` FOR EACH ROW SET new.uuid = uuid()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `alamat_toko` text NOT NULL,
  `no_telpon_toko` varchar(12) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `alamat_toko`, `no_telpon_toko`, `uuid`, `updated_at`) VALUES
(1, 'Toko Semar - Selomerto', 'Jln. Cempaka Baru R4, Condongcatur, Depok, Sleman', '08999239159', '8f08bb21-de51-11ea-a8bd-4cedfb2aff5f', '2020-08-15 01:46:20'),
(5, 'Toko Semar', 'Jln. Cempaka Baru R4, Condongcatur, Sleman', '08999239154', 'e3b66db1-de5b-11ea-a4c0-4cedfb2aff5f', '2020-08-15 01:46:20');

--
-- Triggers `toko`
--
DELIMITER $$
CREATE TRIGGER `generate_uuid_toko` BEFORE INSERT ON `toko` FOR EACH ROW SET new.uuid = uuid()
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
