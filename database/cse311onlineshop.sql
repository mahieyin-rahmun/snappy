-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2018 at 07:15 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cse311onlineshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Watches'),
(2, 'Shirts'),
(3, 'Trousers'),
(4, 'Bags'),
(5, 'Shoes');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `customer_id` int(11) NOT NULL,
  `order_num` varchar(255) NOT NULL,
  `total_price` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `no_of_products` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_history`
--

INSERT INTO `payment_history` (`customer_id`, `order_num`, `total_price`, `purchase_date`, `delivery_date`, `no_of_products`) VALUES
(1, 'O-1-095206204180029', 32900, '2018-04-22', '2018-04-29', 4),
(1, 'O-1-192434001688874', 8689, '2018-04-21', '2018-04-28', 3),
(1, 'O-1-281529880085750', 13100, '2018-04-21', '2018-04-28', 4),
(1, 'O-1-920981610912351', 5998, '2018-04-28', '2018-05-05', 1),
(2, 'O-2-472103881259250', 6099, '2018-04-22', '2018-04-29', 3),
(2, 'O-2-491068874812095', 2700, '2018-04-21', '2018-04-28', 1),
(2, 'O-2-780209032244050', 42909, '2018-04-22', '2018-04-29', 7),
(3, 'O-3-021010240934876', 1090, '2018-04-29', '2018-05-06', 1),
(3, 'O-3-180888010260429', 10999, '2018-04-22', '2018-04-29', 4),
(3, 'O-3-212500309436510', 18500, '2018-04-29', '2018-05-06', 5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(10) DEFAULT NULL,
  `material` varchar(255) NOT NULL,
  `image_src` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `product_name`, `price`, `v_id`, `quantity`, `size`, `material`, `image_src`) VALUES
(1, 1, 'Rolex Watch E550', 2500, 1, 28, 'M', 'Leather', 'assets/watches/watch1.jpg'),
(2, 1, 'Hublot Watch C90', 5000, 2, 20, 'L', 'Leather', 'assets/watches/watch2.jpg'),
(3, 1, 'Rolex Watch E556', 2900, 1, 20, 'S', 'Leather', 'assets/watches/watch3.jpg'),
(4, 1, 'Rolex Watch F950', 4500, 1, 5, 'M', 'Leather', 'assets/watches/watch4.jpg'),
(5, 1, 'FastTrack Pro 90', 2999, 3, 15, 'L', 'Stainless Steel', 'assets/watches/watch5.jpg'),
(6, 2, 'Men\'s T-Shirt 1', 650, 6, 24, 'L', 'Cotton', 'assets/shirts/shirt1.jpg'),
(7, 2, 'Men\'s T-Shirt 2', 750, 7, 26, 'M', 'Cotton', 'assets/shirts/shirt2.jpg'),
(8, 2, 'Men\'s T-Shirt 3', 860, 6, 14, 'S', 'Cotton', 'assets/shirts/shirt3.jpg'),
(9, 2, 'Women\'s T-Shirt 1', 900, 6, 16, 'S', 'Cotton', 'assets/shirts/shirt4.jpg'),
(10, 2, 'Men\'s T-Shirt 4', 900, 7, 8, 'L', 'Cotton', 'assets/shirts/shirt5.jpg'),
(11, 3, 'Men\'s Trouser 1', 1090, 6, 42, 'L', 'Cotton', 'assets/trousers/trouser1.jpg'),
(12, 3, 'Women\'s Jeans 1', 1500, 11, 50, 'M', 'Jeans', 'assets/trousers/trouser2.jpg'),
(13, 3, 'Women\'s Jeans 1', 1650, 11, 50, 'L', 'Jeans', 'assets/trousers/trouser2.jpg'),
(14, 3, 'Men\'s Jeans 1', 2500, 6, 36, 'L', 'Jeans', 'assets/trousers/trouser3.jpg'),
(15, 3, 'Men\'s Trouser 2', 1200, 7, 33, 'M', 'Cotton', 'assets/trousers/trouser4.jpg'),
(16, 3, 'Men\'s Trouser 3', 1399, 6, 40, 'M', 'Cotton', 'assets/trousers/trouser5.jpg'),
(17, 4, 'Women\'s Bag 1', 2000, 9, 49, 'Standard', 'Leather', 'assets/bags/bag1.jpg'),
(18, 4, 'Women\'s Bag 2', 2500, 8, 60, 'Standard', 'Leather', 'assets/bags/bag2.jpg'),
(19, 4, 'Laptop Bag 1', 1050, 4, 50, 'Large', 'Leather', 'assets/bags/bag3.jpg'),
(20, 4, 'Laptop Bag 1', 1200, 9, 50, 'Standard', 'Leather', 'assets/bags/bag3.jpg'),
(21, 4, 'Women\'s Bag 3', 2999, 9, 44, 'Standard', 'Leather', 'assets/bags/bag4.jpg'),
(22, 5, 'Women\'s Shoe 1', 1100, 10, 29, 'L', 'Leather fabrics', 'assets/shoes/shoe5.jpg'),
(23, 4, 'College Bag 1', 2000, 4, 17, 'Standard', 'Leather', 'assets/bags/bag5.jpg'),
(24, 5, 'Men\'s Shoe 1', 1100, 5, 30, 'L', 'Cloth fabrics', 'assets/shoes/shoe1.jpg'),
(25, 5, 'Men\'s Shoe 2', 1100, 5, 28, 'L', 'Leather fabrics', 'assets/shoes/shoe2.jpg'),
(27, 5, 'Men\'s Shoe 3', 1500, 4, 29, 'L', 'Leather fabrics', 'assets/shoes/shoe3.jpg'),
(28, 5, 'Women\'s Shoe 2', 1600, 4, 60, 'L', 'Leather fabrics', 'assets/shoes/shoe4.jpg'),
(29, 5, 'Men\'s Shoe 2', 1050, 5, 32, 'S', 'Cotton fabrics', 'assets/shoes/shoe2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products_ordered`
--

CREATE TABLE `products_ordered` (
  `SL_no` int(11) NOT NULL,
  `order_num` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_ordered`
--

INSERT INTO `products_ordered` (`SL_no`, `order_num`, `product_id`, `quantity`) VALUES
(4, 'O-1-281529880085750', 1, 1),
(5, 'O-1-281529880085750', 2, 1),
(6, 'O-1-281529880085750', 3, 1),
(7, 'O-1-281529880085750', 10, 3),
(8, 'O-2-491068874812095', 9, 3),
(9, 'O-1-192434001688874', 5, 1),
(10, 'O-1-192434001688874', 7, 3),
(11, 'O-1-192434001688874', 8, 4),
(12, 'O-2-780209032244050', 1, 12),
(13, 'O-2-780209032244050', 9, 5),
(14, 'O-2-780209032244050', 7, 4),
(15, 'O-2-780209032244050', 8, 1),
(16, 'O-2-780209032244050', 6, 1),
(17, 'O-2-780209032244050', 10, 1),
(18, 'O-2-780209032244050', 5, 1),
(19, 'O-1-095206204180029', 1, 1),
(20, 'O-1-095206204180029', 2, 1),
(21, 'O-1-095206204180029', 3, 1),
(22, 'O-1-095206204180029', 4, 5),
(23, 'O-2-472103881259250', 22, 1),
(24, 'O-2-472103881259250', 17, 1),
(25, 'O-2-472103881259250', 21, 1),
(26, 'O-3-180888010260429', 14, 1),
(27, 'O-3-180888010260429', 5, 1),
(28, 'O-3-180888010260429', 27, 1),
(29, 'O-3-180888010260429', 23, 2),
(30, 'O-1-920981610912351', 5, 2),
(31, 'O-3-212500309436510', 2, 1),
(32, 'O-3-212500309436510', 10, 2),
(33, 'O-3-212500309436510', 14, 3),
(34, 'O-3-212500309436510', 23, 1),
(35, 'O-3-212500309436510', 25, 2),
(36, 'O-3-021010240934876', 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_rating`
--

CREATE TABLE `product_rating` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_rating`
--

INSERT INTO `product_rating` (`customer_id`, `product_id`, `rating`) VALUES
(1, 1, 3),
(1, 5, 3),
(1, 9, 3),
(1, 22, 5),
(2, 1, 4),
(2, 3, 5),
(2, 5, 5),
(2, 9, 3),
(2, 17, 5),
(2, 21, 4),
(2, 22, 4),
(3, 6, 3),
(3, 7, 4),
(3, 8, 3),
(3, 9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `housenum` varchar(10) NOT NULL,
  `roadnum` varchar(10) NOT NULL,
  `location` varchar(50) NOT NULL,
  `city` varchar(10) NOT NULL,
  `gender` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`customer_id`, `first_name`, `last_name`, `email`, `password`, `phone_number`, `housenum`, `roadnum`, `location`, `city`, `gender`) VALUES
(1, 'Mahieyin', 'Rahmun', 'mahieyin324@gmail.com', '$2y$10$KSg9duq66P4JE854prIfjegPfG/hNjkB7ahACji.nPiIhnU64rXR2', '01711103230', '181/B', '10', 'East Kafrul', 'Dhaka', 'Male'),
(2, 'Fatma', 'Harun', 'fatma.harun@northsouth.edu', '$2y$10$5YkY4RovHPkfWqNz5GgRZumnJTrpNCOalJ1Fllcp2wFVA4u8k9aHi', '01723452245', '225', '4-E', 'Gulshan', 'Dhaka', 'Female'),
(3, 'Shoeb', 'Ahmed', 'shoeb_ahmed@yahoo.com', '$2y$10$Q8TyoFjn4bsGB9Wo8q4WO.TJqXyO2wCPvpwXErn2ibl3RvnHg/MCS', '01723567225', '65', 'A-12', 'Banani', 'Dhaka', 'Male'),
(4, 'Habib', 'Zaman', 'habib_zaman@gmail.com', '$2y$10$F3eyFBfrTa1FFOqG7PWNHuehHXW6dzxcKpfBifFXfLy0pUijCN41m', '01711222402', '182', '10', 'Gulshan', 'Dhaka', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(11) NOT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `vendor_name`, `location`) VALUES
(1, 'Rolex', 'Gulshan'),
(2, 'Hublot', 'Banani'),
(3, 'FastTrack', 'Uttara'),
(4, 'Adidas', 'Banani'),
(5, 'Nike', 'Kakrail'),
(6, 'Yellow', 'Gulshan'),
(7, 'UniqLo', 'Banani'),
(8, 'Chanel', 'Banani'),
(9, 'Gucci', 'Gulshan'),
(10, 'Apex', 'Kakrail'),
(11, 'Chloe', 'Gulshan');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_rating`
--

CREATE TABLE `vendor_rating` (
  `c_id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_rating`
--

INSERT INTO `vendor_rating` (`c_id`, `v_id`, `rating`) VALUES
(1, 2, 4),
(1, 3, 4),
(1, 6, 3),
(1, 7, 4),
(2, 1, 4),
(2, 7, 4),
(2, 10, 5),
(3, 2, 4),
(3, 4, 5),
(3, 5, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`order_num`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `v_id` (`v_id`);

--
-- Indexes for table `products_ordered`
--
ALTER TABLE `products_ordered`
  ADD PRIMARY KEY (`SL_no`),
  ADD KEY `order_num` (`order_num`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_rating`
--
ALTER TABLE `product_rating`
  ADD PRIMARY KEY (`customer_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `vendor_rating`
--
ALTER TABLE `vendor_rating`
  ADD PRIMARY KEY (`c_id`,`v_id`),
  ADD KEY `v_id` (`v_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `products_ordered`
--
ALTER TABLE `products_ordered`
  MODIFY `SL_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD CONSTRAINT `payment_history_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`customer_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`v_id`) REFERENCES `vendors` (`vendor_id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `products_ibfk_4` FOREIGN KEY (`v_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `products_ordered`
--
ALTER TABLE `products_ordered`
  ADD CONSTRAINT `products_ordered_ibfk_1` FOREIGN KEY (`order_num`) REFERENCES `payment_history` (`order_num`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ordered_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `product_rating`
--
ALTER TABLE `product_rating`
  ADD CONSTRAINT `product_rating_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`customer_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `product_rating_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `vendor_rating`
--
ALTER TABLE `vendor_rating`
  ADD CONSTRAINT `vendor_rating_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `users` (`customer_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_rating_ibfk_2` FOREIGN KEY (`v_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
