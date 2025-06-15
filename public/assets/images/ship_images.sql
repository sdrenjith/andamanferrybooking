-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2024 at 06:58 AM
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
-- Database: `magical_andaman`
--

-- --------------------------------------------------------

--
-- Table structure for table `ship_images`
--

CREATE TABLE `ship_images` (
  `id` int(11) NOT NULL,
  `ship_id` int(11) DEFAULT NULL,
  `image_path` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ship_images`
--

INSERT INTO `ship_images` (`id`, `ship_id`, `image_path`) VALUES
(1, 3, 'images/green_ocean/go-2.jpeg'),
(2, 3, 'images/green_ocean/GO2-Premium-1.jpeg'),
(3, 3, 'images/green_ocean/GO2-Premium-plus-1.jpeg'),
(4, 1, 'images/makruzz/Makruzz-Deluxe-1.jpeg'),
(5, 1, 'images/makruzz/Makruzz-Premium-1.jpeg'),
(6, 1, 'images/makruzz/Makruzz-royal-1.jpeg'),
(7, 2, 'images/nautika/nautika-upper-deck-1.jpeg'),
(8, 2, 'images/nautika/nautika-2.jpeg'),
(9, 2, 'images/nautika/nautika-lower-deck-1.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ship_images`
--
ALTER TABLE `ship_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ship_images`
--
ALTER TABLE `ship_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
