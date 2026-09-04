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
-- Table structure for table `boardgame`
--

CREATE TABLE `boardgame` (
  `id_bg` int(11) NOT NULL,
  `nameboardgame` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `boardgame`
--

INSERT INTO `boardgame` (`id_bg`, `nameboardgame`) VALUES
(1, 'Werewolf'),
(2, 'The Haunted Glass'),
(3, 'Desperados'),
(4, 'Red November'),
(5, 'The Thing'),
(6, 'Ticket To Ride'),
(7, 'Raccoon Robbers'),
(8, 'Catan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boardgame`
--
ALTER TABLE `boardgame`
  ADD PRIMARY KEY (`id_bg`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
