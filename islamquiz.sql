-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2016 at 02:51 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `islamquiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `AID` int(11) NOT NULL,
  `Salt` double DEFAULT NULL,
  `Fjalekalimi` varchar(25) DEFAULT NULL,
  `Privilegji` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`AID`, `Salt`, `Fjalekalimi`, `Privilegji`) VALUES
(1, 281054, 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpyetja`
--

CREATE TABLE `tblpyetja` (
  `PID` int(11) NOT NULL,
  `txtPyetjes` varchar(500) NOT NULL,
  `alternativat` varchar(560) DEFAULT NULL,
  `pSakte` varchar(140) NOT NULL,
  `fotoLocation` varchar(150) DEFAULT NULL,
  `aktive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpyetja`
--

INSERT INTO `tblpyetja` (`PID`, `txtPyetjes`, `alternativat`, `pSakte`, `fotoLocation`, `aktive`) VALUES
(1, 'Besimi nÃ« melaike Ã«shtÃ« prej kushteve tÃ« besimit', 'PO, JO', 'PO', '', 1),
(2, 'Si quhet libri qÃ« i zbriti Muhamedit s.a.w.s nga Allahu?', '', 'Kuran', '', 1),
(3, 'AARMZNIA', '', 'RAMAZANI', '', 1),
(4, 'Kush prej kÃ«tyre Ã«shtÃ« emÃ«r i Allahut?', 'Er Rahman, Abdullah, Jezus, Muhammed', 'Er Rahman', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`AID`);

--
-- Indexes for table `tblpyetja`
--
ALTER TABLE `tblpyetja`
  ADD PRIMARY KEY (`PID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblpyetja`
--
ALTER TABLE `tblpyetja`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
