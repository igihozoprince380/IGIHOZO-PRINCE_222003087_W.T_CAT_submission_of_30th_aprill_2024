-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 01:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petrol_sales`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `contact_number`, `email_address`) VALUES
(1, 'prince igihozo', '0785618328', 'igihozo@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price_per_unit` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `description`, `price_per_unit`) VALUES
(5, 'diesel', '10000l', 1300.00);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `quantity_sold` int(11) DEFAULT NULL,
  `price_per_liter` decimal(10,2) DEFAULT NULL,
  `sale_date_time` datetime DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `product_type` varchar(50) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `quantity_sold`, `price_per_liter`, `sale_date_time`, `payment_method`, `product_type`, `total_amount`) VALUES
(1, 1, 1775.00, '2024-04-29 14:14:00', 'momo', 'premium', 1775.00),
(2, 1, 1775.00, '2024-04-29 14:14:00', 'momo', 'premium', 1775.00),
(3, 1, 1775.00, '2024-04-29 14:14:00', 'momo', 'premium', 0.00),
(4, 1, 1775.00, '2024-04-29 14:14:00', 'momo', 'premium', 0.00),
(5, 1, 1775.00, '2024-04-29 14:14:00', 'momo', 'premium', 1775.00),
(6, 1, 1775.00, '2024-04-29 14:14:00', 'momo', 'premium', 0.00),
(7, 1, 1775.00, '2024-04-29 14:14:00', 'momo', 'premium', 0.00),
(8, 1, 1775.00, '2024-04-29 14:14:00', 'momo', 'premium', 0.00),
(9, 1, 1775.00, '2024-04-29 14:14:00', 'momo', 'premium', 1775.00),
(10, 30, 2900.00, '2024-04-29 15:16:00', 'cash', 'premium', 87000.00),
(11, 30, 2900.00, '2024-04-29 15:16:00', 'cash', 'premium', NULL),
(12, 30, 2900.00, '2024-04-29 15:16:00', 'cash', 'premium', NULL),
(13, 30, 2900.00, '2024-04-29 15:16:00', 'cash', 'premium', 87000.00),
(14, 30, NULL, '2024-04-29 15:16:00', 'cash', 'premium', 0.00),
(15, 122, NULL, '2024-04-29 15:21:00', 'momo', 'premium', 12200.00),
(16, 122, 0.00, '2024-04-29 15:21:00', 'momo', 'premium', 0.00),
(17, 10, 1300.00, '2024-04-29 15:26:00', 'momo', 'premium', 13000.00),
(18, 10, 1300.00, '2024-04-29 15:26:00', 'momo', 'premium', 13000.00),
(19, 10, 1300.00, '2024-04-29 15:26:00', 'momo', 'premium', 13000.00),
(20, 10, 1300.00, '2024-04-29 15:26:00', 'momo', 'premium', 13000.00),
(21, 100, 2855.00, '2024-04-29 15:49:00', 'momo', 'diesel', 285500.00),
(22, 100, 1000.00, '2024-04-29 18:57:00', 'momo', 'diesel', 100000.00),
(23, 10, 1000.00, '2024-04-29 19:58:00', 'momo', 'premium', 10000.00),
(24, 100, 1000.00, '2024-04-29 20:17:00', 'momo', 'premium', 100000.00),
(25, 100, 1000.00, '2024-04-29 22:53:00', 'card', 'premium', 100000.00),
(26, 100, 1000.00, '2024-04-30 12:10:00', 'momo', 'premium', 100000.00),
(27, 26, 1775.00, '2024-04-30 12:33:00', 'momo', 'premium', 46150.00);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `diesel_quantity_delivered` decimal(10,2) DEFAULT 0.00,
  `premium_quantity_delivered` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `contact_number`, `email_address`, `diesel_quantity_delivered`, `premium_quantity_delivered`) VALUES
(3, 'jack', '0785618328', 'igihozo@gmail.com', 677.00, 7888.00),
(4, 'jack', '0785618328', 'igihozo@gmail.com', 56.00, 12.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password_hash`, `role`, `full_name`, `email`, `contact_number`) VALUES
(17, 'kenzy', '$2y$10$OYWm.wcbx0leP1aenasoo.ARqgO/F0td/A3rVZDeaO0I0dwqO4atW', 'manager', 'kavukire og', 'kavukire@gmail.com', '1223'),
(18, 'kavukire', '$2y$10$Aph/PE3HwQyFZw3HVDKpOeDbKfzoWw1qIdmOtB3sBPYOKMKOh11SS', 'worker', 'kavukire og', 'kavukire@gmail.com', '123456789'),
(19, 'piok', '$2y$10$PQTQEZp1pKbz6ERPPRB8Ze30oPrsV3IloZJ2dPPPUwBshM9H4c14u', 'worker', 'kayihura prince', 'kayihura@gmail.com', '1234567'),
(20, 'uwayo', '$2y$10$AMQgijLuZSwStUh4.F9h1.ZDOWW6n1nUfIvs6ATrA6FwkMsmOEkqe', 'manager', 'uwayo ddd', 'uwayo@gmail.com', '123456'),
(21, 'pogba', '$2y$10$43x79.4TMJrCk8Pgnbq3KuA5v1SuJEdbpukPJbN9ub5Zev5aq4Rku', 'worker', 'kayihura prince', 'kayihura@gmail.com', '1234567'),
(23, 'KWISISA', '$2y$10$eQ3xj1e45i7.7jjkrocikOcgqvjg275gJ.F7UHO2yKY0uq150w8QK', 'manager', 'KWISISASA', 'igihozoprince380@gmail.com', '0780993254');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
