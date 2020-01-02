-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2019 at 03:04 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banisaleh`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `npm` varchar(15) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `npm`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'user', 'user'),
(3, '43a8700', '123456'),
(4, '43a87006150265', '123456'),
(5, '43a87006150', '123456'),
(6, '123456', '123456'),
(7, '12', '12'),
(8, '43a8700aaa', '123456'),
(9, '43A87006160109', '29121997'),
(12, '43a87', '123'),
(13, '43a87006160010', 'admin'),
(14, '43A87006160074', '123'),
(15, '123', '123'),
(16, '1234', '123'),
(17, '12345', '123'),
(18, '456', '456'),
(19, 'mn', 'mn123');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `npm` varchar(15) NOT NULL,
  `nama_mahasiswa` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(11) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `agama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`npm`, `nama_mahasiswa`, `jenis_kelamin`, `jurusan`, `no_hp`, `email`, `agama`) VALUES
('0003013', 'Nadira Nur', 'Rahasia', 'Teknik Informatika', '0852111111111', 'nny@gmail.com', 'Islam'),
('1233', 'ani', 'hijnn', 'jin', 'jijiih', 'uubhh', 'iii'),
('2', '', 'Pria', 'Sistem Komputerk', '081245658976', 'didikempot@gmail.com', 'islam'),
('237', 'Pandunath', 'laki', 'Ti', '082114832508', 'pandunatha636@gmail.com', 'Islam'),
('4', 'MNurul', 'Pria', 'Sistem Informasi', '097888', 'mnuty@gmail.com', 'Islam'),
('43a8700199', 'Babang tamfan', 'Pria', 'Management Informatika', '081241111', 'tamfan@gmal.com', 'islam'),
('43a87001990', 'Aming', 'Pria', 'Teknik Komputer', '08124111111', 'aming@gmail.com', 'islam'),
('43A870061', 'Nadira N', 'Rahasia', 'Teknik Informatika', '0852111111111', 'nny@gmail.com', 'Islam'),
('43A87006150265', 'Deni Supriyatna', 'Pria', 'Tehnik Informatika', '08988255871', 'denisupriyatna01@gmail.com', 'islam'),
('43a87006160010', 'Anisatun Soiba', 'P', 'Teknik Informatika', '089635506412', 'anis@gmail.com', 'islam'),
('43A87006160074', 'Ayudia', 'Prempuan ', 'Teknik Informatika', '0895107171', 'ayudia@gmail.com', 'Islam'),
('43A87006160078', 'Muhammad', 'Laki-laki', 'Teknik Informatika', '083811332244', 'fr62190@gmail.com', 'Islam'),
('43A87006160104', 'indahhhh', 'perempuan', 'TI', '0897', 'indah@gmail.com', 'islam'),
('43A87006160109', 'Urmih Karsani', 'Perempuan', 'Teknik Informatika', '081221754515', 'urmihkarsani97@gmailcom', 'Islam'),
('43A87006160112', 'Teddy Robianta', 'Adam', 'Teknik Informatika', '081295373120', 'robiantasitepu@gmail.com', 'Kristen'),
('43A87006160199', 'Nadira Nur Yunita', 'Perempuan', 'Teknik Informatika', '089500000000', 'nuryunitanadira@gmail.com', 'Islam'),
('88', 'ttttt', 'save edit', 'yy', '88', '88', '88');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`npm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
