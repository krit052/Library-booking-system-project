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
-- Table structure for table `brbooks`
--

CREATE TABLE `brbooks` (
  `Id_order` int(11) NOT NULL,
  `Idb` int(11) DEFAULT NULL,
  `Book` varchar(100) NOT NULL,
  `date_borrow` date DEFAULT NULL,
  `Iduser` int(11) DEFAULT NULL,
  `date_return` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brbooks`
--

INSERT INTO `brbooks` (`Id_order`, `Idb`, `Book`, `date_borrow`, `Iduser`, `date_return`) VALUES
(1, 3, 'Sherlock Holmes', '2024-11-12', 6, '2024-11-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brbooks`
--
ALTER TABLE `brbooks`
  ADD PRIMARY KEY (`Id_order`),
  ADD KEY `Fk user` (`Iduser`),
  ADD KEY `Fk Idbook` (`Idb`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brbooks`
--
ALTER TABLE `brbooks`
  MODIFY `Id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brbooks`
--
ALTER TABLE `brbooks`
  ADD CONSTRAINT `Fk Idbook` FOREIGN KEY (`Idb`) REFERENCES `book` (`id_book`),
  ADD CONSTRAINT `Fk user` FOREIGN KEY (`Iduser`) REFERENCES `users` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
