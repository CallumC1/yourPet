-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2024 at 02:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yourpet`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_type` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `product_categories` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_type`, `product_name`, `product_stock`, `product_categories`) VALUES
(1, 'Toys', 'Chew Toy', 100, 'Toys, Chew Toys'),
(2, 'Food', 'Dry Dog Food', 200, 'Food, Dry Food'),
(3, 'Accessories', 'Dog Collar', 150, 'Accessories, Collars'),
(4, 'Grooming', 'Dog Shampoo', 75, 'Grooming, Shampoo'),
(5, 'Bedding', 'Dog Bed', 50, 'Bedding, Beds'),
(6, 'Treats', 'Dog Treats', 120, 'Treats, Treats'),
(7, 'Health & Wellness', 'Flea & Tick Treatment', 80, 'Health & Wellness, Flea & Tick'),
(8, 'Apparel', 'Dog Sweater', 30, 'Apparel, Sweaters'),
(9, 'Toys', 'Squeaky Toy', 90, 'Toys, Squeaky Toys'),
(10, 'Food', 'Wet Dog Food', 150, 'Food, Wet Food'),
(11, 'Accessories', 'Leash', 100, 'Accessories, Leashes'),
(12, 'Grooming', 'Brush', 60, 'Grooming, Brushes'),
(13, 'Bedding', 'Dog Blanket', 40, 'Bedding, Blankets'),
(14, 'Treats', 'Rawhide Bones', 110, 'Treats, Bones'),
(15, 'Health & Wellness', 'Dental Chews', 70, 'Health & Wellness, Dental Chews'),
(16, 'Apparel', 'Dog Raincoat', 20, 'Apparel, Raincoats'),
(17, 'Toys', 'Fetch Ball', 80, 'Toys, Fetch Toys'),
(18, 'Food', 'Grain-Free Dog Food', 180, 'Food, Grain-Free Food'),
(19, 'Accessories', 'Dog Harness', 120, 'Accessories, Harnesses'),
(20, 'Grooming', 'Nail Clippers', 50, 'Grooming, Nail Clippers'),
(21, 'Bedding', 'Orthopedic Dog Bed', 60, 'Bedding, Orthopedic Beds'),
(22, 'Treats', 'Peanut Butter Treats', 130, 'Treats, Peanut Butter'),
(23, 'Health & Wellness', 'Joint Supplements', 90, 'Health & Wellness, Supplements'),
(24, 'Apparel', 'Dog Hoodie', 25, 'Apparel, Hoodies'),
(25, 'Toys', 'Interactive Dog Toy', 70, 'Toys, Interactive Toys'),
(26, 'Food', 'Puppy Food', 160, 'Food, Puppy Food'),
(27, 'Accessories', 'Poop Bag Dispenser', 110, 'Accessories, Poop Bags'),
(28, 'Grooming', 'Ear Cleaner', 45, 'Grooming, Ear Cleaners'),
(29, 'Bedding', 'Heated Dog Bed', 35, 'Bedding, Heated Beds'),
(30, 'Treats', 'Jerky Treats', 100, 'Treats, Jerky'),
(31, 'Health & Wellness', 'Heartworm Prevention', 85, 'Health & Wellness, Heartworm'),
(32, 'Apparel', 'Dog Bandana', 40, 'Apparel, Bandanas'),
(33, 'Toys', 'Puzzle Toy', 60, 'Toys, Puzzle Toys'),
(34, 'Food', 'Senior Dog Food', 120, 'Food, Senior Food'),
(35, 'Accessories', 'Dog Backpack', 70, 'Accessories, Backpacks'),
(36, 'Grooming', 'Furminator', 55, 'Grooming, Furminators'),
(37, 'Bedding', 'Elevated Dog Bed', 45, 'Bedding, Elevated Beds'),
(38, 'Treats', 'Freeze-Dried Treats', 90, 'Treats, Freeze-Dried'),
(39, 'Health & Wellness', 'Allergy Relief', 80, 'Health & Wellness, Allergy Relief'),
(40, 'Apparel', 'Dog Boots', 30, 'Apparel, Boots'),
(41, 'Toys', 'Tug-of-War Rope', 50, 'Toys, Rope Toys'),
(42, 'Food', 'Vegetarian Dog Food', 110, 'Food, Vegetarian Food'),
(43, 'Accessories', 'Water Bottle', 65, 'Accessories, Water Bottles'),
(44, 'Grooming', 'Dog Cologne', 40, 'Grooming, Colognes'),
(45, 'Bedding', 'Memory Foam Dog Bed', 40, 'Bedding, Memory Foam Beds'),
(46, 'Treats', 'Dental Sticks', 80, 'Treats, Dental Sticks'),
(47, 'Health & Wellness', 'Digestive Enzymes', 70, 'Health & Wellness, Digestive Enzymes'),
(48, 'Apparel', 'Dog Sunglasses', 20, 'Apparel, Sunglasses'),
(49, 'Toys', 'Rubber Frisbee', 60, 'Toys, Frisbees'),
(50, 'Food', 'Limited Ingredient Dog Food', 130, 'Food, Limited Ingredient Food');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
