-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2022 at 01:10 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lampa`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL COMMENT 'user number',
  `uid` varchar(32) COLLATE utf8_polish_ci NOT NULL COMMENT 'unique user hash',
  `name` varchar(64) COLLATE utf8_polish_ci DEFAULT NULL,
  `user_connected` varchar(64) COLLATE utf8_polish_ci DEFAULT NULL COMMENT 'user uid',
  `color` varchar(32) COLLATE utf8_polish_ci NOT NULL COMMENT 'lamp color (in rgba)',
  `in_group` varchar(64) COLLATE utf8_polish_ci DEFAULT NULL COMMENT 'a connected group wherre user can trigger other users lamp, default: null. Data is user uid',
  `turned_on` varchar(10) COLLATE utf8_polish_ci NOT NULL DEFAULT 'false' COMMENT 'if it turned on or not',
  `do_not_interrupt` varchar(10) COLLATE utf8_polish_ci NOT NULL DEFAULT 'false' COMMENT 'do user wants to get annoyed by lamp or not'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `uid`, `name`, `user_connected`, `color`, `in_group`, `turned_on`, `do_not_interrupt`) VALUES
(1, '82d864ed2517f873ac6d9e8a1afb89c4', 'kozak rpi', '', 'rgba(255,255,255,0)', NULL, 'true', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `uid` varchar(64) COLLATE utf8_polish_ci NOT NULL COMMENT 'owner uid',
  `user` varchar(64) COLLATE utf8_polish_ci NOT NULL COMMENT 'participator uid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(8, 'Dominik', '$2y$10$WMUCUDQV6jYS4lhrqsEWr.XmyWaSTgff6oUJMVixYduY1a6DUeBc2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`),
  ADD UNIQUE KEY `user_connected` (`user_connected`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'user number', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
