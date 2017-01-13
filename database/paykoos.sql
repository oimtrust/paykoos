-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2017 at 08:49 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paykoos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(75) NOT NULL,
  `id_role` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class`
--

CREATE TABLE `tbl_class` (
  `id_class` int(11) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `price` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_class`
--

INSERT INTO `tbl_class` (`id_class`, `id_owner`, `class_name`, `price`) VALUES
(2, 1, 'Standard', 250000),
(3, 1, 'Mewah', 400000),
(5, 1, 'Super Mewah', 500000),
(9, 1, 'Medium', 300000),
(10, 1, 'VIP', 600000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_owner`
--

CREATE TABLE `tbl_owner` (
  `id_owner` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(85) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `address` varchar(255) NOT NULL,
  `id_role` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_owner`
--

INSERT INTO `tbl_owner` (`id_owner`, `username`, `password`, `email`, `fullname`, `gender`, `phone`, `address`, `id_role`) VALUES
(1, 'oimtrust', '$2y$10$AqrOuqX886stpjAV/qkI9.6/rpHUso8cwkch8qysSXB0CXgjWR/3C', 'trustoim@gmail.com', 'Fathur Rohim', 'Pria', '081333042104', 'Jl. Supriadi', 3),
(2, 'oim_trust', '$2y$10$EaTxHl57/A3ScP/cVVQWTOXuW.0HIgXnb7CIsSu680bj4tMoGq7w6', 'oimtrust@unikama.ac.id', 'Fathur Rohim, S.Kom, M.Kom', 'Pria', '081333042104', 'Jl. Supriadi RT:03, RW:04                                   \r\n                                ', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id_payment` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `id_renter` int(11) NOT NULL,
  `date_trans` date NOT NULL,
  `total_month` int(5) NOT NULL DEFAULT '0',
  `payment` int(10) NOT NULL DEFAULT '0',
  `total` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_renter`
--

CREATE TABLE `tbl_renter` (
  `id_renter` int(11) NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT 'paykoos',
  `password` varchar(255) NOT NULL DEFAULT 'paykoos',
  `fullname` varchar(75) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `father` varchar(75) NOT NULL,
  `mother` varchar(75) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `address` varchar(255) NOT NULL,
  `id_role` int(10) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `id_room` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_renter`
--

INSERT INTO `tbl_renter` (`id_renter`, `username`, `password`, `fullname`, `gender`, `father`, `mother`, `phone`, `address`, `id_role`, `id_owner`, `id_room`) VALUES
(2, 'paykoos', 'paykoos', 'Faris Jourdy', 'Pria', 'Budi Sulistyo', 'Sulistyowati', '081234567890', 'Tumpang', 3, 1, 2),
(3, 'paykoos', 'paykoos', 'Fathur Rohim', 'Pria', 'Budiono', 'Sulistyowati', '081234567890', 'Malang', 3, 1, 1),
(4, 'paykoos', 'paykoos', 'Faisal Amri', 'Pria', 'Agus', 'Sunariah', '0812345678', 'Bangil', 3, 1, 3),
(5, 'paykoos', 'paykoos', 'Faris Jourdy', 'Pria', 'Pamungkas', 'Ratu', '0898978868', 'Tumpang', 3, 1, 5),
(6, 'paykoos', 'paykoos', 'Fanani', 'Pria', 'Sutijo', 'Sri Ratu', '0989787868', 'Singaraja', 3, 1, 1),
(7, 'paykoos', 'paykoos', 'Ivan', 'Pria', 'Krisna', 'Jaggu', '08978867', 'Gorontalo', 3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id_role` int(10) NOT NULL,
  `name_role` varchar(50) NOT NULL,
  `display_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id_role`, `name_role`, `display_name`) VALUES
(1, 'admin', 'Admin'),
(2, 'owner', 'Owner'),
(3, 'renter', 'Renter');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rooms`
--

CREATE TABLE `tbl_rooms` (
  `id_room` int(10) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `room_name` varchar(50) NOT NULL,
  `id_class` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rooms`
--

INSERT INTO `tbl_rooms` (`id_room`, `id_owner`, `room_name`, `id_class`, `status`, `photo`) VALUES
(1, 1, 'Kamar 1', 3, 'Kosong', '765494.jpg'),
(2, 1, 'Kamar 2', 3, 'Kosong', '545590.jpg'),
(3, 1, 'Kamar 3', 1, 'Kosong', '703056.jpg'),
(5, 1, 'Kamar 4', 5, 'Kosong', '473245.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD PRIMARY KEY (`id_class`),
  ADD KEY `id_owner` (`id_owner`);

--
-- Indexes for table `tbl_owner`
--
ALTER TABLE `tbl_owner`
  ADD PRIMARY KEY (`id_owner`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id_payment`),
  ADD KEY `id_renter` (`id_renter`),
  ADD KEY `id_house` (`id_room`);

--
-- Indexes for table `tbl_renter`
--
ALTER TABLE `tbl_renter`
  ADD PRIMARY KEY (`id_renter`),
  ADD KEY `id_owner` (`id_owner`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_room` (`id_room`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  ADD PRIMARY KEY (`id_room`),
  ADD KEY `id_class` (`id_class`),
  ADD KEY `id_owner` (`id_owner`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_class`
--
ALTER TABLE `tbl_class`
  MODIFY `id_class` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_owner`
--
ALTER TABLE `tbl_owner`
  MODIFY `id_owner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_renter`
--
ALTER TABLE `tbl_renter`
  MODIFY `id_renter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id_role` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  MODIFY `id_room` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
