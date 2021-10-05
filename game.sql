-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2021 at 03:58 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `game`
--

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `league` varchar(255) NOT NULL,
  `willWin` varchar(255) NOT NULL,
  `byGoals` int(255) NOT NULL,
  `homeName` varchar(255) NOT NULL,
  `awayName` varchar(255) NOT NULL,
  `updated` int(1) DEFAULT NULL,
  `created` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `date`, `user`, `league`, `willWin`, `byGoals`, `homeName`, `awayName`, `updated`, `created`) VALUES
(43, '10-05-2021 06:00 PM', 'tanzil', 'Copa Paulista', 'Juventus', 2, 'Juventus', 'Portuguesa', 1, '2021-10-05 15:42:07'),
(44, '10-05-2021 06:00 PM', 'ahsan', 'Copa Paulista', 'Portuguesa', 2, 'Juventus', 'Portuguesa', 1, '2021-10-05 15:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `updatescore`
--

CREATE TABLE `updatescore` (
  `auto-id` int(255) NOT NULL,
  `homeName` varchar(255) NOT NULL,
  `awayName` varchar(255) NOT NULL,
  `willWin` varchar(255) NOT NULL,
  `byGoals` int(255) NOT NULL,
  `league` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `updatescore`
--

INSERT INTO `updatescore` (`auto-id`, `homeName`, `awayName`, `willWin`, `byGoals`, `league`, `date`) VALUES
(10, 'Juventus', 'Portuguesa', 'Portuguesa', 2, 'Copa Paulista', '10-05-2021 06:00 PM'),
(11, 'Juventus', 'Portuguesa', 'Juventus', 1, 'Copa Paulista', '10-05-2021 06:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `score` int(255) NOT NULL,
  `matches` int(255) NOT NULL,
  `created` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `score`, `matches`, `created`) VALUES
(29, '@Bcd1234', 'tanzil', 2, 0, '2021-10-01 15:37:38'),
(30, '@Bcd1234', 'ahsan', 2, 0, '2021-10-01 15:41:51'),
(31, '@Bcd1234', 'rakib', 0, 0, '2021-10-01 16:24:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `updatescore`
--
ALTER TABLE `updatescore`
  ADD PRIMARY KEY (`auto-id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `updatescore`
--
ALTER TABLE `updatescore`
  MODIFY `auto-id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
