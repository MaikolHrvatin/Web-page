-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 07, 2018 at 02:55 PM
-- Server version: 5.7.20
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `financije`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_type`
--

CREATE TABLE `bill_type` (
  `ime` varchar(255) NOT NULL,
  `id_user` int(50) NOT NULL,
  `id_type` int(50) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill_type`
--

INSERT INTO `bill_type` (`ime`, `id_user`, `id_type`, `category`) VALUES
('Car', 1, 1, 'Expenses'),
('Entertainment', 1, 2, 'Expenses'),
('Food', 1, 3, 'Expenses'),
('Travel', 1, 4, 'Expenses'),
('Shopping', 1, 5, 'Expenses'),
('Household', 1, 6, 'Expenses'),
('Overhead', 1, 7, 'Expenses'),
('Other', 1, 8, 'Expenses'),
('Salary', 1, 9, 'Income'),
('Income', 1, 10, 'Income'),
('Other', 1, 11, 'Income');

-- --------------------------------------------------------

--
-- Table structure for table `kucanstvo`
--

CREATE TABLE `kucanstvo` (
  `id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `racun`
--

CREATE TABLE `racun` (
  `iznos` double NOT NULL,
  `valuta` varchar(50) NOT NULL,
  `id` int(50) NOT NULL,
  `datum` date NOT NULL,
  `kategorija` varchar(255) NOT NULL,
  `opis` varchar(600) DEFAULT NULL,
  `vrsta` varchar(255) NOT NULL,
  `id_user` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `racun`
--

INSERT INTO `racun` (`iznos`, `valuta`, `id`, `datum`, `kategorija`, `opis`, `vrsta`, `id_user`) VALUES
(25, 'HRK', 1, '2018-07-07', 'Car', 'test', 'Expense', 1),
(23, 'HRK', 2, '2018-07-07', 'Salary', 'konzum', 'Income', 1),
(1, 'HRK', 3, '2018-07-07', 'Car', '1', 'Expense', 1),
(2, 'HRK', 4, '2018-07-07', 'Income', '2', 'Income', 1),
(5, 'HRK', 5, '2018-07-06', 'Car', '5', 'Expense', 1),
(4, 'HRK', 6, '2018-07-02', 'Car', '4', 'Expense', 1),
(9, 'HRK', 7, '2018-07-03', 'Car', '9', 'Expense', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `password`, `id`) VALUES
('test', 'maikol@gmail.com', '202cb962ac59075b964b07152d234b70', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_kucanstvo`
--

CREATE TABLE `user_kucanstvo` (
  `id_user` int(50) NOT NULL,
  `id_kucanstvo` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_type`
--
ALTER TABLE `bill_type`
  ADD PRIMARY KEY (`id_type`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `kucanstvo`
--
ALTER TABLE `kucanstvo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `racun`
--
ALTER TABLE `racun`
  ADD PRIMARY KEY (`id`),
  ADD KEY `racun_ibfk_1` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_kucanstvo`
--
ALTER TABLE `user_kucanstvo`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kucanstvo` (`id_kucanstvo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill_type`
--
ALTER TABLE `bill_type`
  MODIFY `id_type` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `kucanstvo`
--
ALTER TABLE `kucanstvo`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `racun`
--
ALTER TABLE `racun`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill_type`
--
ALTER TABLE `bill_type`
  ADD CONSTRAINT `bill_type_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `racun`
--
ALTER TABLE `racun`
  ADD CONSTRAINT `racun_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_kucanstvo`
--
ALTER TABLE `user_kucanstvo`
  ADD CONSTRAINT `user_kucanstvo_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_kucanstvo_ibfk_2` FOREIGN KEY (`id_kucanstvo`) REFERENCES `kucanstvo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
