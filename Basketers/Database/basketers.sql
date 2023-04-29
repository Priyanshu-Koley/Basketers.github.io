-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2022 at 08:16 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `basketers`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `pdt_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `client_id`, `pdt_id`, `quantity`, `price`) VALUES
(475, 4, 3, 1, 30000),
(476, 4, 2, 1, 25000);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `pdt_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `is_deliver` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `pdt_id`, `quantity`, `amount`, `order_date`, `is_deliver`) VALUES
(41, 6, 4, 1, 60000, '21st August , 2022 at 09:24 PM', 1),
(65, 4, 3, 7, 210000, '22nd August , 2022 at 01:58 AM', 1),
(66, 4, 2, 3, 75000, '22nd August , 2022 at 01:58 AM', 1),
(67, 4, 1, 1, 20000, '22nd August , 2022 at 02:21 AM', 1),
(68, 4, 2, 1, 25000, '22nd August , 2022 at 02:22 AM', 1),
(69, 4, 3, 1, 30000, '22nd August , 2022 at 02:22 AM', 1),
(81, 4, 4, 1, 60000, '23rd August , 2022 at 11:39 PM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` bigint(20) NOT NULL,
  `details` text NOT NULL,
  `imgpath` varchar(200) NOT NULL,
  `catagory` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `details`, `imgpath`, `catagory`) VALUES
(1, 'Realme 9 Pro', 20000, 'good phone 1', '../images/2022_08_09_01_45_53_1659989753051.jpg', 'Electronics'),
(2, 'Samsung', 25000, 'good phone 2', '../images/2022_08_09_01_46_53_1659989813018.jpg', 'Electronics'),
(3, 'One Plus', 30000, 'good phone 3', '../images/2022_08_09_01_47_16_1659989836993.jpg', 'Electronics'),
(4, 'Apple IPhone 13', 60000, 'Best Phone !!', '../images/2022_08_09_01_47_56_1659989876961.jpg', 'Electronics');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `phone`, `password`) VALUES
(4, 'Priyanshu Koley', 'priyanshu0@gmail.com', '52 Library Road', '9831730866', 'e10adc3949ba59abbe56e057f20f883e'),
(6, 'abc', 'abc@abc.abc', 'abcabc\r\nabc-711113', '1234567899', 'a906449d5769fa7361d7ecc6aa3f6d28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=477;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
