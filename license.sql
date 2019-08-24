-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 24, 2019 at 01:52 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `license`
--
CREATE Database `license`;
USE license;
-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `cid` int(4) NOT NULL,
  `cname` varchar(150) NOT NULL,
  `cmobile` bigint(10) NOT NULL,
  `cemail` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`cid`, `cname`, `cmobile`, `cemail`) VALUES
(1, 'Abc', 9999999999, 'a@a.a'),
(2, 'NM', 7777777777, 'c@c.c'),
(3, 'Etop', 9991234567, 'e@e.e');

-- --------------------------------------------------------

--
-- Table structure for table `licenses`
--

CREATE TABLE `licenses` (
  `lsr` varchar(20) NOT NULL,
  `ltyc` int(4) NOT NULL,
  `todate` date NOT NULL,
  `fromdate` date NOT NULL,
  `cid` int(4) NOT NULL,
  `software` varchar(50) NOT NULL,
  `lip` varchar(45) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `licenses`
--

INSERT INTO `licenses` (`lsr`, `ltyc`, `todate`, `fromdate`, `cid`, `software`, `lip`, `status`) VALUES
('1', 2, '2019-08-31', '2019-07-28', 2, 'qjsdh', '127.0.0.1:80', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ltype`
--

CREATE TABLE `ltype` (
  `ltyc` int(4) NOT NULL,
  `ltname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ltype`
--

INSERT INTO `ltype` (`ltyc`, `ltname`) VALUES
(1, 'Website'),
(2, 'Software');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `cmobile` (`cmobile`),
  ADD UNIQUE KEY `cemail` (`cemail`);

--
-- Indexes for table `licenses`
--
ALTER TABLE `licenses`
  ADD PRIMARY KEY (`lsr`),
  ADD UNIQUE KEY `ltyc` (`ltyc`,`todate`,`fromdate`,`cid`,`software`);

--
-- Indexes for table `ltype`
--
ALTER TABLE `ltype`
  ADD PRIMARY KEY (`ltyc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `cid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ltype`
--
ALTER TABLE `ltype`
  MODIFY `ltyc` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
