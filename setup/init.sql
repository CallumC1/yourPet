-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Sep 12, 2024 at 05:29 PM
-- Server version: 8.4.0
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yourpetdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `category_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_verification`
--

CREATE TABLE `email_verification` (
  `verification_id` int NOT NULL,
  `FK_user_id` varchar(36) DEFAULT NULL,
  `token` varchar(32) NOT NULL,
  `generated_at` datetime DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `email_verification`
--

INSERT INTO `email_verification` (`verification_id`, `FK_user_id`, `token`, `generated_at`, `expires_at`) VALUES
(119, 'f555a081-df67-49b0-ab6e-39ffabd5e2ef', 'a326c24a4792fc8ce16ca6e29acd83', '2024-09-08 20:22:58', '2024-09-08 20:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `FK_user_id` varchar(36) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `total_price` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int NOT NULL,
  `FK_order_id` int DEFAULT NULL,
  `FK_product_id` int DEFAULT NULL,
  `order_item_quantity` int DEFAULT NULL,
  `item_price` decimal(10,0) DEFAULT NULL,
  `subtotal` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `FK_order_id`, `FK_product_id`, `order_item_quantity`, `item_price`, `subtotal`) VALUES
(0, 0, 22, 4, 12, 48);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `product_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_price` decimal(10,0) NOT NULL,
  `product_stock` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_type`, `product_price`, `product_stock`) VALUES
(1, 'Premium Dog Food', '', 'Food', 0, 200),
(2, 'Squeaky Chew Toy', '', 'Toys', 0, 150),
(3, 'Cat Collar with Bell', '', 'Accessories', 0, 100),
(4, 'Pet Shampoo', '', 'Grooming', 0, 120),
(5, 'Natural Cat Treats', '', 'Treats', 0, 80),
(6, 'Small Animal Cage', '', 'Housing', 0, 50),
(7, 'Fish Antibiotics', '', 'Health', 0, 70),
(8, 'Dog Hoodie', '', 'Apparel', 0, 90),
(9, 'Puppy Training Pads', '', 'Training', 0, 180),
(10, 'Cozy Cat Bed', '', 'Bedding', 0, 110),
(11, 'Large Bird Cage', '', 'Housing', 0, 40),
(12, 'Rawhide Bones', '', 'Treats', 0, 160),
(13, 'Feather Teaser Wand', '', 'Toys', 0, 130),
(14, 'Pet Brush', '', 'Grooming', 0, 100),
(15, 'Pet Bandana', '', 'Apparel', 0, 120),
(16, 'Grain-Free Cat Food', '', 'Food', 0, 180),
(17, 'Reptile Terrarium', '', 'Housing', 0, 70),
(18, 'Flea and Tick Collar', '', 'Health', 0, 110),
(19, 'Pet ID Tag', '', 'Accessories', 0, 200),
(20, 'Interactive Dog Puzzle', '', 'Toys', 0, 90),
(21, 'Clicker Training Kit', '', 'Training', 0, 140),
(22, 'Fleece Pet Blanket', '', 'Bedding', 0, 100),
(23, 'Freeze-Dried Cat Treats', '', 'Food', 0, 120),
(24, 'Nail Clippers', '', 'Grooming', 0, 160),
(25, 'Arthritis Supplements', '', 'Health', 0, 80),
(26, 'Pet Carrier Backpack', '', 'Accessories', 0, 60),
(27, 'Dog Raincoat', '', 'Apparel', 0, 110),
(28, 'Plush Dog Toy Set', '', 'Toys', 0, 100),
(29, 'Puppy Clicker', '', 'Training', 0, 150),
(30, 'Heated Pet Mat', '', 'Bedding', 0, 70);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `FK_product_id` int DEFAULT NULL,
  `FK_category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `user_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_password_hash` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_roles` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `email_verified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password_hash`, `user_roles`, `email_verified`) VALUES
('f555a081-df67-49b0-ab6e-39ffabd5e2ef', 'Callum Conacher', 'rdskyra1234@gmail.com', '$2y$10$5mya4j4RKJWgcxtOIJYvJuwvtPdtZWRd7CXzbF6z3OI6jdWQ5LvQm', 'user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `email_verification`
--
ALTER TABLE `email_verification`
  ADD PRIMARY KEY (`verification_id`),
  ADD KEY `FK_user_id` (`FK_user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_user_id` (`FK_user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `FK_order_id` (`FK_order_id`),
  ADD KEY `FK_product_id` (`FK_product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD KEY `FK_product_id` (`FK_product_id`),
  ADD KEY `FK_category_id` (`FK_category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_verification`
--
ALTER TABLE `email_verification`
  MODIFY `verification_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`FK_order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`FK_product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_ibfk_1` FOREIGN KEY (`FK_product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `product_categories_ibfk_2` FOREIGN KEY (`FK_category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
