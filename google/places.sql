-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 12, 2016 at 03:33 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

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
('Old Fort Jackson', '1+Fort+Jackson+Rd%2C+Savannah%2C+GA+31404', 'an old fort in Savannah I want to go to', '32.0812292', '-81.0366154'),
('Gym', '1657+Carpenter+Rd+S%2C+Tifton%2C+GA+31793', 'Tiftarea YMCA', '31.4464970', '-83.5467867'),
('Oatland Island Wildlife Center of Savannah', '711+Sandtown+Rd%2C+Savannah%2C+GA+31410', 'Compact, zoo-like preserve with dozens of species in natural habitats, plus education programs.', '32.0491590', '-81.0244997'),
('cool estate in Savannah', '7601+Skidaway+Rd%2C+Savannah%2C+GA+31406', 'Historic site featuring the ruins of a Colonial estate, gardens, trails & an oak-lined driveway', '31.9801627', '-81.0692671'),
('Statue of Liberty', 'Liberty+Island++New+York%2C+NY+10004', 'That green lady with the torch', '40.6897580', '-74.0451380');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `placestable`
--
ALTER TABLE `placestable`
  ADD UNIQUE KEY `address` (`address`),
  ADD UNIQUE KEY `address_2` (`address`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
