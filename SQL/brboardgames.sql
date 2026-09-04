-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 10:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prodatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `brboardgames`
--

CREATE TABLE `brboardgames` (
  `Id_order` int(11) NOT NULL,
  `Iduser` int(11) NOT NULL,
  `date_borrow` date DEFAULT NULL,
  `Boardgame` varchar(200) NOT NULL,
  `Idbg` int(11) DEFAULT NULL,
  `date_return` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brboardgames`
--

INSERT INTO `brboardgames` (`Id_order`, `Iduser`, `date_borrow`, `Boardgame`, `Idbg`, `date_return`) VALUES
(1, 6, '2024-11-19', 'Ticket To Ride', 6, '2024-11-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brboardgames`
--
ALTER TABLE `brboardgames`
  ADD PRIMARY KEY (`Id_order`),
  ADD KEY `Fk iduser` (`Iduser`),
  ADD KEY `Fk Idbg` (`Idbg`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brboardgames`
--
ALTER TABLE `brboardgames`
  MODIFY `Id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brboardgames`
--
ALTER TABLE `brboardgames`
  ADD CONSTRAINT `Fk Idbg` FOREIGN KEY (`Idbg`) REFERENCES `boardgame` (`id_bg`),
  ADD CONSTRAINT `Fk iduser` FOREIGN KEY (`Iduser`) REFERENCES `users` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
