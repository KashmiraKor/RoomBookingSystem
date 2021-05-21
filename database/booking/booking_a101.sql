-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2021 at 05:00 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roombookingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_a101`
--

CREATE TABLE `booking_a101` (
  `Id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `emailid` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `event_name` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `timeslot` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_a101`
--

INSERT INTO `booking_a101` (`Id`, `name`, `username`, `emailid`, `department`, `event_name`, `date`, `timeslot`) VALUES
(1, 'Kashmira ', 'kashmirakor@vit.edu.in', 'kashmira.kor@vit.edu.in', 'ETRX', 'booking', '2021-05-21', '09:30AM - 10:00AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_a101`
--
ALTER TABLE `booking_a101`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_a101`
--
ALTER TABLE `booking_a101`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
