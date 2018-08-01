-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 01, 2018 at 11:24 AM
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
('Salary', 1, 9, 'Income'),
('Income', 1, 10, 'Income'),
('Other', 1, 11, 'Income'),
('new super income category', 1, 14, 'Income'),
('Car', 2, 15, 'Expenses'),
('Entertainment', 2, 16, 'Expenses'),
('Food', 2, 17, 'Expenses'),
('Travel', 2, 18, 'Expenses'),
('Shopping', 2, 19, 'Expenses'),
('Household', 2, 20, 'Expenses'),
('Overhead', 2, 21, 'Expenses'),
('Other', 2, 22, 'Expenses'),
('Salary', 2, 23, 'Income'),
('Income', 2, 24, 'Income'),
('Other', 2, 25, 'Income'),
('Promet', 1, 26, 'Expenses'),
('piechart_test', 1, 27, 'Expenses'),
('Car', 3, 28, 'Expenses'),
('Entertainment', 3, 29, 'Expenses'),
('Food', 3, 30, 'Expenses'),
('Travel', 3, 31, 'Expenses'),
('Shopping', 3, 32, 'Expenses'),
('Household', 3, 33, 'Expenses'),
('Overhead', 3, 34, 'Expenses'),
('Other', 3, 35, 'Expenses'),
('Salary', 3, 36, 'Income'),
('Income', 3, 37, 'Income'),
('Other', 3, 38, 'Income'),
('Car', 4, 39, 'Expenses'),
('Entertainment', 4, 40, 'Expenses'),
('Food', 4, 41, 'Expenses'),
('Travel', 4, 42, 'Expenses'),
('Shopping', 4, 43, 'Expenses'),
('Household', 4, 44, 'Expenses'),
('Overhead', 4, 45, 'Expenses'),
('Other', 4, 46, 'Expenses'),
('Salary', 4, 47, 'Income'),
('Income', 4, 48, 'Income'),
('Other', 4, 49, 'Income');

-- --------------------------------------------------------

--
-- Table structure for table `grupe`
--

CREATE TABLE `grupe` (
  `id` int(50) NOT NULL,
  `admin_id` int(50) NOT NULL,
  `date_start` date NOT NULL,
  `ime` varchar(255) NOT NULL,
  `info` varchar(600) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grupe`
--

INSERT INTO `grupe` (`id`, `admin_id`, `date_start`, `ime`, `info`) VALUES
(2, 1, '2018-07-27', 'test', 'drugi test'),
(6, 3, '2018-07-29', 'test grupa multy', 'test za grupu sa više članova'),
(7, 4, '2018-07-29', 'grupa sa velikim nazivom', 'test za veliki naziv');

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
  `id_user` int(50) NOT NULL,
  `grupa_id` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `racun`
--

INSERT INTO `racun` (`iznos`, `valuta`, `id`, `datum`, `kategorija`, `opis`, `vrsta`, `id_user`, `grupa_id`) VALUES
(2525, 'EU', 1, '2018-07-07', 'Shopping', 'test', 'Expense', 1, NULL),
(999, 'EU', 2, '2018-07-08', 'Income', 'test_2', 'Income', 1, NULL),
(111, 'HRK', 3, '2018-07-07', 'Car', '', 'Expense', 1, NULL),
(2, 'HRK', 4, '2018-07-07', 'Income', '2', 'Income', 1, NULL),
(5, 'HRK', 5, '2018-07-06', 'Car', '5', 'Expense', 1, NULL),
(4, 'HRK', 6, '2018-07-02', 'test_expense', '4', 'Expense', 1, NULL),
(65, 'HRK', 7, '2018-07-10', 'Overhead', 'test_new', 'Expense', 1, NULL),
(3215, 'HRK', 8, '2018-07-02', 'new super income category', 'test income', 'Income', 1, NULL),
(25, 'HRK', 9, '2018-07-10', 'Other', 'test other after delete', 'Expense', 1, NULL),
(2365, 'HRK', 10, '2018-07-10', 'Overhead', 'test pagination, must be at the start', 'Expense', 1, NULL),
(5, 'HRK', 11, '2018-07-13', 'Car', 'promjena', 'Expense', 1, NULL),
(56, 'EU', 13, '2018-07-14', 'Salary', 'test plaća', 'Income', 1, NULL),
(150, 'USD', 14, '2018-07-20', 'Food', 'test piechart', 'Expense', 1, NULL),
(300, 'HRK', 15, '2018-07-20', 'piechart_test', 'piechart_test_2', 'Expense', 1, NULL),
(100, 'HRK', 16, '2018-07-26', 'Car', 'test new database', 'Expense', 1, NULL),
(200, 'HRK', 17, '2018-07-30', 'Car', 'test za grupni račun', 'Expense', 1, 7),
(25, 'HRK', 19, '2018-07-30', 'Food', 'test', 'Expense', 4, 7),
(60, 'HRK', 20, '2018-07-30', 'Other', 'test za novi payment', 'Expense', 4, 7),
(25, 'HRK', 21, '2018-08-01', 'Car', 'test sa grupom', 'Expense', 1, 7),
(25, 'HRK', 22, '2018-08-01', 'Car', 'test grupa', 'Expense', 1, 7),
(25, 'HRK', 23, '2018-08-01', 'Car', 'bez grupe', 'Expense', 1, NULL),
(25, 'HRK', 24, '2018-08-01', 'Car', 'test grupa izmjena', 'Expense', 1, 7);

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
('test', 'maikol@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
('bootstrap', 'maikol.hrvatin2604@gmail.com', '202cb962ac59075b964b07152d234b70', 2),
('test za grupe', 'test@gmail.com', '202cb962ac59075b964b07152d234b70', 3),
('test2', 'raian.jane@gmail.com', '202cb962ac59075b964b07152d234b70', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_grupe`
--

CREATE TABLE `user_grupe` (
  `id_user` int(50) NOT NULL,
  `id_grupa` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_grupe`
--

INSERT INTO `user_grupe` (`id_user`, `id_grupa`) VALUES
(2, 2),
(1, 7),
(4, 2);

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
-- Indexes for table `grupe`
--
ALTER TABLE `grupe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin` (`admin_id`);

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
-- Indexes for table `user_grupe`
--
ALTER TABLE `user_grupe`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kucanstvo` (`id_grupa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill_type`
--
ALTER TABLE `bill_type`
  MODIFY `id_type` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `grupe`
--
ALTER TABLE `grupe`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `racun`
--
ALTER TABLE `racun`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill_type`
--
ALTER TABLE `bill_type`
  ADD CONSTRAINT `bill_type_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `grupe`
--
ALTER TABLE `grupe`
  ADD CONSTRAINT `grupe_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `racun`
--
ALTER TABLE `racun`
  ADD CONSTRAINT `racun_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_grupe`
--
ALTER TABLE `user_grupe`
  ADD CONSTRAINT `user_grupe_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_grupe_ibfk_2` FOREIGN KEY (`id_grupa`) REFERENCES `grupe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
