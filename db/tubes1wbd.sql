-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2020 at 10:23 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tubes1wbd`
--

-- --------------------------------------------------------

--
-- Table structure for table `cookie_data`
--

CREATE TABLE `cookie_data` (
  `login_string` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cookie_data`
--

INSERT INTO `cookie_data` (`login_string`, `username`) VALUES
('663cf1657dc63e7a374ab6231fe5366f', 'taufiq'),
('86d09a51e17af26f3c435e84dd0ad0c8', 'ibnu');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `sold` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `photo` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `sold`, `amount`, `Description`, `photo`) VALUES
(1, 'Chocolate 2', 3000, 12, 14, 'Coklat ini merupakan coklat yang dipanggang hingga meleleh, setelah itu dibentuk lalu dibekukan kami juga kurang mengerti mengapa kami melakukan itu', 'contoh.png');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `chocolate_name` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `address` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`chocolate_name`, `amount`, `total_price`, `date`, `time`, `address`, `username`) VALUES
('chocolate 1', 12, 12000, '2020-10-08', '07:12:05', 'jalan blablabla', 'taufiq'),
('chocolate 1', 12, 12000, '2020-10-08', '07:12:05', 'jalan blablabla', 'taufiq'),
('Chocolate 2', 3, 9000, '2020-10-23', '09:55:24', 'aaaaa', 'ibnu'),
('Chocolate 2', 3, 9000, '2020-10-23', '09:58:33', 'aaaaa', 'ibnu'),
('Chocolate 2', 3, 9000, '2020-10-23', '09:59:17', 'aaaa', 'ibnu'),
('Chocolate 2', 3, 9000, '2020-10-23', '10:01:37', 'jalanananananan', 'ibnu'),
('Chocolate 2', 6, 18000, '2020-10-23', '10:03:14', 'aaaa', 'ibnu');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `password`, `role`) VALUES
('ibnu', 'ibnu@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'user'),
('taufiq', 't@gmail.com', 'f4eff635e6dfe584a1a536dbc7718f3d', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cookie_data`
--
ALTER TABLE `cookie_data`
  ADD PRIMARY KEY (`login_string`),
  ADD UNIQUE KEY `login_string` (`login_string`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `index_id` (`id`) USING BTREE,
  ADD KEY `secondary_atribute` (`name`,`price`,`sold`,`amount`,`Description`) USING HASH;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
