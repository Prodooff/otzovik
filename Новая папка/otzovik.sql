-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 30, 2021 at 03:18 AM
-- Server version: 5.6.47
-- PHP Version: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `otzovik`
--

-- --------------------------------------------------------

--
-- Table structure for table `otzivi`
--

CREATE TABLE `otzivi` (
  `id_otziv` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `stars` int(1) NOT NULL,
  `otziv` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT '0',
  `dislikes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `otzivi`
--

INSERT INTO `otzivi` (`id_otziv`, `id_user`, `stars`, `otziv`, `status`, `likes`, `dislikes`) VALUES
(2, 1, 4, 'ewqfEWAWEFDSFEFSEAFAWDAW FDS  F SD FS', 1, 15, 1),
(3, 1, 3, 'dasdadwadawd dawdadwa', 1, 0, 0),
(4, 5, 4, 'САЛО ЭТО КЛЕВО', 1, 0, 0),
(7, 5, 1, 'fgjdfjgdjfgd', 1, 0, 0),
(14, 5, 1, 'qwwqeqwrwqrwq', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(15) NOT NULL DEFAULT 'user',
  `accept` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `login`, `password`, `role`, `accept`) VALUES
(1, 'fff', 'b8d371756f63a8572258db2e20bf52e6', 'user', 1),
(2, 'ggg', '8569d13423b849f3c6e235cbcfcebb8c', 'user', 1),
(3, 'vvv', '6a957c54021de446251e4a4e3abeb5ee', 'user', 1),
(4, 'admin', 'c3284d0f94606de1fd2af172aba15bf3', 'admin', 1),
(5, 'user', '0d8d5cd06832b29560745fe4e1b941cf', 'user', 1),
(6, 'qwe', 'd9b1d7db4cd6e70935368a1efb10e377', 'user', 1),
(9, 'qwer', '4e40beaf133b47b8b0020881b20ad713', 'user', 1),
(10, 'www', '985bda1a6bf60cbb8960d0397c9b9d39', 'user', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `otzivi`
--
ALTER TABLE `otzivi`
  ADD PRIMARY KEY (`id_otziv`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `otzivi`
--
ALTER TABLE `otzivi`
  MODIFY `id_otziv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `otzivi`
--
ALTER TABLE `otzivi`
  ADD CONSTRAINT `otzivi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
