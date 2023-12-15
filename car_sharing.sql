-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2023 at 12:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_sharing`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`) VALUES
(1, 'administrator123', '$2y$10$l.Ae3XDyCjtu4k2vxPWJDu82kEJJTbHZa4ubKQz11RRkudgloQT3G');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `year` year(4) NOT NULL,
  `color` varchar(30) NOT NULL,
  `price_per_day` decimal(10,2) NOT NULL,
  `transmission_type` enum('Automatic','Manual') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `make`, `model`, `year`, `color`, `price_per_day`, `transmission_type`) VALUES
(12, 'Honda', 'Civic', '2017', 'Grey', 55.00, 'Automatic'),
(13, 'Ford', 'Mustang', '2018', 'Red', 75.00, 'Automatic'),
(14, 'BMW', '3 Series', '2020', 'Blue', 85.00, 'Automatic'),
(15, 'Audi', 'A4', '2021', 'White', 90.00, 'Automatic'),
(16, 'Mercedes-Benz', 'C-Class', '2021', 'Black', 95.00, 'Automatic'),
(17, 'Chevrolet', 'Camaro', '2019', 'Yellow', 80.00, 'Manual'),
(18, 'Tesla', 'Model 3', '2022', 'Red', 100.00, 'Automatic'),
(19, 'Nissan', 'Altima', '2018', 'Grey', 40.00, 'Automatic'),
(20, 'Subaru', 'Outback', '2020', 'Green', 55.00, 'Manual'),
(21, 'Toyota', 'Camry', '2019', 'Blue', 50.00, 'Automatic'),
(22, 'Honda', 'Civic', '2020', 'White', 45.00, 'Manual'),
(23, 'Ford', 'Mustang', '2018', 'Black', 75.00, 'Automatic'),
(24, 'BMW', '3 Series', '2020', 'Black', 85.00, 'Automatic'),
(25, 'Audi', 'A4', '2021', 'Black', 90.00, 'Automatic'),
(26, 'Mercedes-Benz', 'C-Class', '2021', 'White', 95.00, 'Automatic'),
(27, 'Chevrolet', 'Camaro', '2019', 'Black', 80.00, 'Manual'),
(28, 'Tesla', 'Model 3', '2022', 'Black', 100.00, 'Automatic'),
(29, 'Nissan', 'Altima', '2018', 'Black', 40.00, 'Automatic'),
(30, 'Subaru', 'Outback', '2020', 'Black', 55.00, 'Manual'),
(31, 'Toyota', 'Camry', '2019', 'Blue', 50.00, 'Automatic'),
(32, 'Honda', 'Civic', '2020', 'Black', 45.00, 'Manual'),
(33, 'Ford', 'Mustang', '2018', 'White', 75.00, 'Automatic'),
(34, 'BMW', '3 Series', '2020', 'White', 85.00, 'Automatic'),
(35, 'Audi', 'A4', '2021', 'Grey', 90.00, 'Automatic'),
(36, 'Mercedes-Benz', 'C-Class', '2021', 'Grey', 95.00, 'Automatic'),
(37, 'Chevrolet', 'Camaro', '2019', 'White', 80.00, 'Manual'),
(38, 'Tesla', 'Model 3', '2022', 'White', 100.00, 'Automatic'),
(39, 'Nissan', 'Altima', '2018', 'White', 40.00, 'Automatic'),
(40, 'Subaru', 'Outback', '2020', 'White', 55.00, 'Manual'),
(55, 'Audi', 'A4', '2019', 'Red', 60.00, 'Manual');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'dragonwolf12', '$2y$10$qv5YAYTF65vhk1JulMNBGuw4atF52bgM/q8bq07Y9ZBT5wbdvOgq6', 'barnie123@bowling.com', '2023-12-10 00:14:54'),
(2, 'MrSteve', '$2y$10$p5.ujJ6sCxn8teC.4yQeKeZmgCdVr3kNmYKbI.qdVb4ElsClICM.y', 'Mrsteve@gmail.com', '2023-12-10 23:44:20'),
(3, 'johnjohnson', '$2y$10$MVF/NXehsNXuBM4V7.G0EOIBTTUIXeg.TBDjmFesMU4/bIotiYVxa', 'john@gmail.com', '2023-12-14 18:54:05'),
(4, 'JohnnyBonny', '$2y$10$lj1fbZ/b1.Sp2V5TdgKDLuXDn5uXhb.xQKHmv6E3FXnbWukLC8wxe', 'johnny@gmail.com', '2023-12-14 18:57:28'),
(5, 'JamesMaddison', '$2y$10$w289Z5xv.ajadKA882nqO.EJVv9OTF0FNKj/1xDuOYFEqCp8xN4qe', 'james@gmail.com', '2023-12-14 19:00:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
