-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2016 at 06:53 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `places`
--

-- --------------------------------------------------------

--
-- Table structure for table `placestable`
--

CREATE TABLE `placestable` (
  `name` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `descript` varchar(150) NOT NULL,
  `lat` decimal(10,7) NOT NULL,
  `lng` decimal(10,7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `placestable`
--

INSERT INTO `placestable` (`name`, `address`, `descript`, `lat`, `lng`) VALUES
('Hancock Home', '500+W+Inaha+rd.+Sycamore+ga', 'merritt house', '31.6204287', '-83.6012539');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `placestable`
--
ALTER TABLE `placestable`
  ADD UNIQUE KEY `address` (`address`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
