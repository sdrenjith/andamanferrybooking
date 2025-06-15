-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2024 at 08:42 AM
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
-- Database: `asmitha_andaman`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text DEFAULT NULL,
  `subtitle` text DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `banner_image` varchar(555) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=default,1=inactive',
  `delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=default,1=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `subtitle`, `button_link`, `button_text`, `created_at`, `updated_at`, `banner_image`, `status`, `delete`) VALUES
(25, 'Test Title', 'Test Subtitle', NULL, NULL, '2024-07-17 01:29:49', '2024-07-17 01:29:49', '667d4ca51486f_banner9.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `banner_images`
--

CREATE TABLE `banner_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL COMMENT 'Banners table id',
  `path` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner_images`
--

INSERT INTO `banner_images` (`id`, `parent_id`, `path`, `size`) VALUES
(26, 24, 'uploads/home_banner/66965315b244c_banner.jpeg', '103244'),
(27, 23, 'uploads/home_banner/667d4ca51486f_banner9.jpg', '98579'),
(28, 25, 'uploads/home_banner/66976be155995_banner.jpeg', '103244');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text DEFAULT NULL,
  `subtitle` longtext DEFAULT NULL,
  `author_name` text DEFAULT NULL,
  `path` text DEFAULT NULL,
  `size` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=default,1=inactive',
  `delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=default,1=deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `subtitle`, `author_name`, `path`, `size`, `status`, `delete`, `created_at`, `updated_at`) VALUES
(1, 'The Andaman Islands: A Paradise for Adventure Seekers', 'test 1', 'Sumanta Ghosh', 'uploads/blog/658c0c8e091e2_wp8811180-water-wave-wallpapers.jpg', '185916', 0, 0, '2023-12-27 06:07:57', '2023-12-27 06:07:57'),
(2, 'Unveiling the Hidden Gems of the Andaman Islands: A Traveler\'s Tale', 'test 2', 'Sayan Debnath', 'uploads/blog/65a106f7320eb_images (2).jpg', '8469', 0, 1, '2024-01-12 04:01:37', '2024-01-12 04:03:37'),
(3, 'Escaping to the Andaman Islands: A Guide to Exploration and Relaxation', 'Test 3', 'Avijit Chakraborty', 'uploads/blog/65b0afd2e5c4b_6424474b13884183_volcano.jpg', '70181', 0, 0, '2024-01-24 01:06:04', '2024-01-24 01:06:04'),
(4, 'Andaman Islands: A Journey Through the Unspoiled Beauty of India', 'Test 4', 'Bapi Dey', 'uploads/blog/65b0afe60edec_bh1.jpg', '120471', 0, 0, '2024-01-24 01:06:23', '2024-01-24 01:06:23'),
(5, 'Andaman Islands: A Journey Through the Unspoiled Beauty of India', 'Test 5', 'Bapi Dey', 'uploads/blog/66225d4736082_image1.jpeg', '10132', 0, 0, '2024-01-24 01:06:23', '2024-04-19 06:32:16'),
(6, 'Andaman Islands: A Journey Through the Unspoiled Beauty of India', 'Test 6', 'Bapi Dey', 'uploads/blog/65b0afe60edec_bh1.jpg', '120471', 0, 0, '2024-01-24 01:06:23', '2024-01-24 01:06:23'),
(7, 'The Andaman Islands: A Paradise for Adventure Seekers', 'Test 7', 'Sumanta Ghosh', 'uploads/blog/66225dba87098_image1.jpeg', '10132', 0, 0, '2023-12-27 06:07:57', '2024-04-19 06:34:12'),
(8, 'The Andaman Islands: A Paradise for Adventure Seekers', 'Test 8', 'Sumanta Ghosh', 'uploads/blog/66225cffccc10_20220305025804_andaman_banner_ahr.jpeg', '424648', 0, 0, '2023-12-27 06:07:57', '2024-04-19 06:31:05'),
(9, 'The Andaman Islands: A Paradise for Adventure Seekers', 'Test 9', 'Sumanta Ghosh', 'uploads/blog/66225d97a1053_doll.jpg', '29954', 0, 0, '2023-12-27 06:07:57', '2024-04-19 06:33:37'),
(10, 'The Andaman Islands: A Paradise for Adventure Seekers', 'Test 10', 'Sumanta Ghosh', 'uploads/blog/66225cd3a9f04_image1.jpeg', '10132', 0, 0, '2023-12-27 06:07:57', '2024-04-19 06:30:23'),
(11, 'Unveiling the Hidden Gems of the Andaman Islands: A Traveler\'s Tale', 'Test 11', 'Sayan Debnath', 'uploads/blog/65a106f7320eb_images (2).jpg', '8469', 0, 0, '2024-01-12 04:01:37', '2024-01-12 04:03:37'),
(12, 'Unveiling the Hidden Gems of the Andaman Islands: A Traveler\'s Tale', 'Test 12', 'Sayan Debnath', 'uploads/blog/65a106f7320eb_images (2).jpg', '8469', 0, 0, '2024-01-12 04:01:37', '2024-01-12 04:03:37'),
(13, 'The Andaman Islands: A Paradise for Adventure Seekers', 'Test 13', 'Sumanta Ghosh', 'uploads/blog/66225d7ccba74_fantasy.jpg', '171840', 0, 0, '2023-12-27 06:07:57', '2024-04-19 06:33:10'),
(14, 'The Andaman Islands: A Paradise for Adventure Seekers', 'Test 14', 'Sumanta Ghosh', 'uploads/blog/65a106f7320eb_images (2).jpg', '185916', 0, 0, '2023-12-27 06:07:57', '2023-12-27 06:07:57');

-- --------------------------------------------------------

--
-- Table structure for table `boat_schedule`
--

CREATE TABLE `boat_schedule` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `is_chartered_boat` varchar(10) NOT NULL DEFAULT 'N',
  `status` enum('Y','N','D') NOT NULL DEFAULT 'Y',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `boat_schedule`
--

INSERT INTO `boat_schedule` (`id`, `title`, `image`, `from_date`, `to_date`, `price`, `is_chartered_boat`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Boat 1', '1718947401.jpg', '2024-06-22', '2028-06-28', 2000.00, 'Y', 'Y', '2024-06-20 23:53:21', '2024-06-21 00:33:39'),
(2, 'Boat 2', '1718947677.jpg', '2024-06-02', '2028-06-24', 5000.00, 'N', 'Y', '2024-06-20 23:57:57', '2024-06-20 23:57:57'),
(7, 'Boat 7', '1719552683.png', '2024-06-29', '2024-08-28', 1000.00, 'Y', 'Y', '2024-06-28 00:01:23', '2024-06-28 00:01:23');

-- --------------------------------------------------------

--
-- Table structure for table `boat_schedule_price`
--

CREATE TABLE `boat_schedule_price` (
  `id` int(11) NOT NULL,
  `boat_schedule_id` int(11) NOT NULL,
  `no_of_passenger` int(11) NOT NULL,
  `per_passenger_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `boat_schedule_price`
--

INSERT INTO `boat_schedule_price` (`id`, `boat_schedule_id`, `no_of_passenger`, `per_passenger_price`, `created_at`, `updated_at`) VALUES
(73, 1, 1, 10000.00, '2024-06-21 06:03:39', '2024-06-21 06:03:39'),
(74, 1, 2, 5000.00, '2024-06-21 06:03:39', '2024-06-21 06:03:39'),
(75, 1, 3, 3500.00, '2024-06-21 06:03:39', '2024-06-21 06:03:39'),
(76, 1, 4, 2500.00, '2024-06-21 06:03:39', '2024-06-21 06:03:39'),
(77, 1, 5, 2000.00, '2024-06-21 06:03:39', '2024-06-21 06:03:39'),
(78, 1, 6, 1600.00, '2024-06-21 06:03:39', '2024-06-21 06:03:39'),
(79, 1, 7, 1100.00, '2024-06-21 06:03:39', '2024-06-21 06:03:39'),
(80, 1, 8, 1050.00, '2024-06-21 06:03:39', '2024-06-21 06:03:39'),
(81, 7, 1, 100000.00, '2024-06-28 00:01:23', '2024-06-28 00:01:23'),
(82, 7, 2, 50000.00, '2024-06-28 00:01:23', '2024-06-28 00:01:23'),
(83, 7, 3, 35000.00, '2024-06-28 00:01:23', '2024-06-28 00:01:23'),
(84, 7, 4, 25000.00, '2024-06-28 00:01:23', '2024-06-28 00:01:23'),
(85, 7, 5, 20000.00, '2024-06-28 00:01:23', '2024-06-28 00:01:23'),
(86, 7, 6, 17000.00, '2024-06-28 00:01:23', '2024-06-28 00:01:23'),
(87, 7, 7, 15000.00, '2024-06-28 00:01:23', '2024-06-28 00:01:23'),
(88, 7, 8, 13000.00, '2024-06-28 00:01:23', '2024-06-28 00:01:23'),
(89, 2, 1, 100000.00, '2024-06-28 00:01:23', '2024-06-28 00:01:23'),
(90, 2, 2, 50000.00, '2024-06-28 00:01:23', '2024-06-28 00:01:23'),
(91, 2, 3, 35000.00, '2024-06-28 00:01:23', '2024-06-28 00:01:23'),
(92, 2, 4, 25000.00, '2024-06-28 00:01:23', '2024-06-28 00:01:23'),
(93, 2, 5, 20000.00, '2024-06-28 00:01:23', '2024-06-28 00:01:23'),
(94, 2, 6, 17000.00, '2024-06-28 00:01:23', '2024-06-28 00:01:23'),
(95, 2, 7, 15000.00, '2024-06-28 00:01:23', '2024-06-28 00:01:23'),
(96, 2, 8, 13000.00, '2024-06-28 00:01:23', '2024-06-28 00:01:23');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `schedule_id` varchar(255) NOT NULL,
  `type` enum('boat','ferry') NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_email` varchar(255) NOT NULL,
  `c_mobile` varchar(255) NOT NULL,
  `c_contact` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `payment_status` enum('pending','success','fail') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `ship_name` varchar(255) DEFAULT NULL,
  `no_of_passenger` varchar(255) NOT NULL,
  `date_of_jurney` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `from_location` text DEFAULT NULL,
  `to_location` text DEFAULT NULL,
  `trip_id` int(11) DEFAULT NULL,
  `vessel_id` int(11) DEFAULT NULL,
  `ferry_class` varchar(255) DEFAULT NULL,
  `nautika_class` varchar(255) DEFAULT NULL,
  `makruzz_class` varchar(255) DEFAULT NULL,
  `green_ocean_class` int(11) DEFAULT NULL,
  `trip_type` varchar(255) DEFAULT NULL,
  `request_for_cancel` enum('Y','N') DEFAULT 'N',
  `request_for_cancel_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `schedule_id`, `type`, `order_id`, `c_name`, `c_email`, `c_mobile`, `c_contact`, `user_id`, `departure_time`, `arrival_time`, `payment_status`, `amount`, `ship_name`, `no_of_passenger`, `date_of_jurney`, `return_date`, `from_location`, `to_location`, `trip_id`, `vessel_id`, `ferry_class`, `nautika_class`, `makruzz_class`, `green_ocean_class`, `trip_type`, `request_for_cancel`, `request_for_cancel_date`, `created_at`, `updated_at`, `status`) VALUES
(336, '667b33592d721d9ec56a7029', 'ferry', '9531306834', 'Sumanta Ghosh', 'test@gmail.com', '8825207634', NULL, 1, '07:30:00', '08:45:00', 'pending', 1750.00, 'Nautika', '1', '2024-07-24', NULL, 'Port Blair', 'Swaraj Dweep', 1721786400, 2, 'Premium', '1', NULL, NULL, 'single_trip', 'N', NULL, '2024-07-18 12:47:14', '2024-07-18 12:47:14', NULL),
(337, '619', 'ferry', '9531306834', 'Sumanta Ghosh', 'test@gmail.com', '8825207634', NULL, 1, '10:00:00', '12:45:00', 'pending', 2300.00, 'Makruzz', '1', '2024-07-24', '2024-07-26', 'Swaraj Dweep  (Havelock)', 'Port Blair', NULL, NULL, 'Deluxe', NULL, '15', NULL, 'return_trip', 'N', NULL, '2024-07-18 12:47:14', '2024-07-18 12:47:14', NULL),
(338, '667b33592d721d9ec56a7029', 'ferry', '9301306865', 'Sumanta Ghosh', 'test@gmail.com', '8825207634', NULL, 1, '07:30:00', '08:45:00', 'pending', 1750.00, 'Nautika', '1', '2024-07-24', NULL, 'Port Blair', 'Swaraj Dweep', 1721786400, 2, 'Premium', '1', NULL, NULL, 'single_trip', 'N', NULL, '2024-07-18 12:47:45', '2024-07-18 12:47:45', NULL),
(339, '619', 'ferry', '9301306865', 'Sumanta Ghosh', 'test@gmail.com', '8825207634', NULL, 1, '10:00:00', '12:45:00', 'pending', 2300.00, 'Makruzz', '1', '2024-07-24', '2024-07-26', 'Swaraj Dweep  (Havelock)', 'Port Blair', NULL, NULL, 'Deluxe', NULL, '15', NULL, 'return_trip', 'N', NULL, '2024-07-18 12:47:45', '2024-07-18 12:47:45', NULL),
(340, '667b33592d721d9ec56a7029', 'ferry', '5741306869', 'Sumanta Ghosh', 'test@gmail.com', '8825207634', NULL, 1, '07:30:00', '08:45:00', 'pending', 1750.00, 'Nautika', '1', '2024-07-24', NULL, 'Port Blair', 'Swaraj Dweep', 1721786400, 2, 'Premium', '1', NULL, NULL, 'single_trip', 'N', NULL, '2024-07-18 12:47:49', '2024-07-18 12:47:49', NULL),
(341, '619', 'ferry', '5741306869', 'Sumanta Ghosh', 'test@gmail.com', '8825207634', NULL, 1, '10:00:00', '12:45:00', 'pending', 2300.00, 'Makruzz', '1', '2024-07-24', '2024-07-26', 'Swaraj Dweep  (Havelock)', 'Port Blair', NULL, NULL, 'Deluxe', NULL, '15', NULL, 'return_trip', 'N', NULL, '2024-07-18 12:47:49', '2024-07-18 12:47:49', NULL),
(342, '667b33592d721d9ec56a7029', 'ferry', '3421307015', 'sayan Debnath', 'sumanat@gmail.com', '9856325695', NULL, 1, '07:30:00', '08:45:00', 'pending', 1750.00, 'Nautika', '1', '2024-07-24', NULL, 'Port Blair', 'Swaraj Dweep', 1721786400, 2, 'Premium', '1', NULL, NULL, 'single_trip', 'N', NULL, '2024-07-18 12:50:15', '2024-07-18 12:50:15', NULL),
(343, '619', 'ferry', '3421307015', 'sayan Debnath', 'sumanat@gmail.com', '9856325695', NULL, 1, '10:00:00', '12:45:00', 'pending', 2300.00, 'Makruzz', '1', '2024-07-24', '2024-07-26', 'Swaraj Dweep  (Havelock)', 'Port Blair', NULL, NULL, 'Deluxe', NULL, '15', NULL, 'return_trip', 'N', NULL, '2024-07-18 12:50:15', '2024-07-18 12:50:15', NULL),
(344, '667b33592d721d9ec56a7029', 'ferry', '7731307047', 'sayan Debnath', 'sumanat@gmail.com', '9856325695', NULL, 1, '07:30:00', '08:45:00', 'pending', 1750.00, 'Nautika', '1', '2024-07-24', NULL, 'Port Blair', 'Swaraj Dweep', 1721786400, 2, 'Premium', '1', NULL, NULL, 'single_trip', 'N', NULL, '2024-07-18 12:50:47', '2024-07-18 12:50:47', NULL),
(345, '619', 'ferry', '7731307047', 'sayan Debnath', 'sumanat@gmail.com', '9856325695', NULL, 1, '10:00:00', '12:45:00', 'pending', 2300.00, 'Makruzz', '1', '2024-07-24', '2024-07-26', 'Swaraj Dweep  (Havelock)', 'Port Blair', NULL, NULL, 'Deluxe', NULL, '15', NULL, 'return_trip', 'N', NULL, '2024-07-18 12:50:47', '2024-07-18 12:50:47', NULL),
(346, '667b334a2d721d9ec56a7011', 'ferry', '1701307137', 'SOMNATH DEY', 'test@gmail.com', '8825207634', NULL, 1, '07:30:00', '08:45:00', 'success', 1750.00, 'Nautika', '1', '2024-07-20', NULL, 'Port Blair', 'Swaraj Dweep', 1721440800, 2, 'Premium', '1', NULL, NULL, 'single_trip', 'N', NULL, '2024-07-18 12:52:32', '2024-07-18 12:52:17', NULL),
(347, '619', 'ferry', '1701307137', 'SOMNATH DEY', 'test@gmail.com', '8825207634', NULL, 1, '10:00:00', '12:45:00', 'success', 2300.00, 'Makruzz', '1', '2024-07-20', '2024-07-24', 'Swaraj Dweep  (Havelock)', 'Port Blair', NULL, NULL, 'Deluxe', NULL, '15', NULL, 'return_trip', 'N', NULL, '2024-07-18 12:52:32', '2024-07-18 12:52:17', NULL),
(348, '5', 'ferry', '4861310104', 'Sumanta Ghosh', 'joydev@xgenmedia.com', '8956325698', NULL, 1, '06:00:00', '08:30:00', 'success', 1100.00, 'Green Ocean', '1', '2024-07-19', NULL, 'Port Blair', 'Havelok', NULL, NULL, 'Premium', NULL, NULL, 1, 'single_trip', 'N', NULL, '2024-07-18 13:42:03', '2024-07-18 13:41:45', NULL),
(349, '5', 'ferry', '1281368313', 'anuradha padwal', 'anu@gmail.com', '8825207634', NULL, NULL, '06:00:00', '08:30:00', 'pending', 1100.00, 'Green Ocean', '1', '2024-07-20', NULL, 'Port Blair', 'Havelok', NULL, NULL, 'Premium', NULL, NULL, 1, 'single_trip', 'N', NULL, '2024-07-19 05:51:53', '2024-07-19 05:51:53', NULL),
(350, '619', 'ferry', '1281368313', 'anuradha padwal', 'anu@gmail.com', '8825207634', NULL, NULL, '10:00:00', '12:45:00', 'pending', 2300.00, 'Makruzz', '1', '2024-07-20', '2024-07-21', 'Swaraj Dweep  (Havelock)', 'Port Blair', NULL, NULL, 'Deluxe', NULL, '15', NULL, 'return_trip', 'N', NULL, '2024-07-19 05:51:53', '2024-07-19 05:51:53', NULL),
(351, '5', 'ferry', '7051651524', 'bapi mahato', 'sumanat@gmail.com', '9856325695', NULL, NULL, '06:00:00', '08:30:00', 'success', 1100.00, 'Green Ocean', '1', '2024-07-23', NULL, 'Port Blair', 'Havelok', NULL, NULL, 'Premium', NULL, NULL, 1, 'single_trip', 'N', NULL, '2024-07-22 12:32:22', '2024-07-22 12:32:04', NULL),
(352, '619', 'ferry', '7051651524', 'bapi mahato', 'sumanat@gmail.com', '9856325695', NULL, NULL, '10:00:00', '12:45:00', 'success', 1775.00, 'Makruzz', '1', '2024-07-23', '2024-07-24', 'Swaraj Dweep  (Havelock)', 'Port Blair', NULL, NULL, 'Premium', NULL, '14', NULL, 'return_trip', 'N', NULL, '2024-07-22 12:32:22', '2024-07-22 12:32:04', NULL),
(353, '5', 'ferry', '8321653514', 'sayan Debnath', 'bapi@gmail.com', '8961217535', NULL, NULL, '06:00:00', '08:30:00', 'success', 1100.00, 'Green Ocean', '1', '2024-07-23', NULL, 'Port Blair', 'Havelok', NULL, NULL, 'Premium', NULL, NULL, 1, 'single_trip', 'N', NULL, '2024-07-22 13:05:29', '2024-07-22 13:05:14', NULL),
(354, '619', 'ferry', '8321653514', 'sayan Debnath', 'bapi@gmail.com', '8961217535', NULL, NULL, '10:00:00', '12:45:00', 'success', 1775.00, 'Makruzz', '1', '2024-07-23', '2024-07-24', 'Swaraj Dweep  (Havelock)', 'Port Blair', NULL, NULL, 'Premium', NULL, '14', NULL, 'return_trip', 'N', NULL, '2024-07-22 13:05:29', '2024-07-22 13:05:14', NULL),
(355, '5', 'ferry', '6121653625', 'sayan Debnath', 'bapi@gmail.com', '8961217535', NULL, NULL, '06:00:00', '08:30:00', 'success', 1100.00, 'Green Ocean', '1', '2024-07-23', NULL, 'Port Blair', 'Havelok', NULL, NULL, 'Premium', NULL, NULL, 1, 'single_trip', 'N', NULL, '2024-07-22 13:07:19', '2024-07-22 13:07:05', NULL),
(356, '619', 'ferry', '6121653625', 'sayan Debnath', 'bapi@gmail.com', '8961217535', NULL, NULL, '10:00:00', '12:45:00', 'success', 1775.00, 'Makruzz', '1', '2024-07-23', '2024-07-24', 'Swaraj Dweep  (Havelock)', 'Port Blair', NULL, NULL, 'Premium', NULL, '14', NULL, 'return_trip', 'N', NULL, '2024-07-22 13:07:19', '2024-07-22 13:07:05', NULL),
(357, '5', 'ferry', '2311653840', 'Sumanta Ghosh', 'test@gmail.com', '8825207634', NULL, NULL, '06:00:00', '08:30:00', 'success', 1300.00, 'Green Ocean', '1', '2024-07-23', NULL, 'Port Blair', 'Havelok', NULL, NULL, 'Royal', NULL, NULL, 4, 'single_trip', 'N', NULL, '2024-07-22 13:10:53', '2024-07-22 13:10:40', NULL),
(358, '619', 'ferry', '2311653840', 'Sumanta Ghosh', 'test@gmail.com', '8825207634', NULL, NULL, '10:00:00', '12:45:00', 'success', 2300.00, 'Makruzz', '1', '2024-07-23', '2024-07-24', 'Swaraj Dweep  (Havelock)', 'Port Blair', NULL, NULL, 'Deluxe', NULL, '15', NULL, 'return_trip', 'N', NULL, '2024-07-22 13:10:53', '2024-07-22 13:10:40', NULL),
(359, '5', 'ferry', '1861653959', 'Narayan ghosh', 'bubay8001@gmail.com', '8825207634', NULL, NULL, '06:00:00', '08:30:00', 'success', 1100.00, 'Green Ocean', '1', '2024-07-23', NULL, 'Port Blair', 'Havelok', NULL, NULL, 'Premium', NULL, NULL, 1, 'single_trip', 'N', NULL, '2024-07-22 13:12:53', '2024-07-22 13:12:39', NULL),
(360, '619', 'ferry', '1861653959', 'Narayan ghosh', 'bubay8001@gmail.com', '8825207634', NULL, NULL, '10:00:00', '12:45:00', 'success', 1775.00, 'Makruzz', '1', '2024-07-23', '2024-07-24', 'Swaraj Dweep  (Havelock)', 'Port Blair', NULL, NULL, 'Premium', NULL, '14', NULL, 'return_trip', 'N', NULL, '2024-07-22 13:12:53', '2024-07-22 13:12:39', NULL),
(361, '5', 'ferry', '2221716745', 'sayan Debnath', 'sumanat@gmail.com', '9007081926', NULL, NULL, '06:00:00', '08:30:00', 'success', 1100.00, 'Green Ocean', '1', '2024-07-24', NULL, 'Port Blair', 'Havelok', NULL, NULL, 'Premium', NULL, NULL, 1, 'single_trip', 'N', NULL, '2024-07-23 06:39:20', '2024-07-23 06:39:05', NULL),
(362, '619', 'ferry', '2221716745', 'sayan Debnath', 'sumanat@gmail.com', '9007081926', NULL, NULL, '10:00:00', '12:45:00', 'success', 1775.00, 'Makruzz', '1', '2024-07-24', '2024-07-25', 'Swaraj Dweep  (Havelock)', 'Port Blair', NULL, NULL, 'Premium', NULL, '14', NULL, 'return_trip', 'N', NULL, '2024-07-23 06:39:20', '2024-07-23 06:39:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `booking_passenger_details`
--

CREATE TABLE `booking_passenger_details` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `dob` int(11) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `resident` enum('indian','foreigner') NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `passport_id` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `trip_type` varchar(255) DEFAULT NULL,
  `request_for_cancel` enum('Y','N') DEFAULT 'N',
  `is_canceled` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_passenger_details`
--

INSERT INTO `booking_passenger_details` (`id`, `booking_id`, `title`, `full_name`, `dob`, `gender`, `resident`, `country`, `passport_id`, `expiry_date`, `trip_type`, `request_for_cancel`, `is_canceled`) VALUES
(325, 346, 'Mr', 'Anup Sharma', 25, 'male', 'indian', NULL, NULL, NULL, 'single_trip', 'N', NULL),
(326, 346, 'INFANT', 'Bittu Das', 1, 'male', 'indian', NULL, NULL, NULL, 'single_trip', 'N', NULL),
(327, 347, 'Mr', 'Anup Sharma', 25, 'male', 'indian', NULL, NULL, NULL, 'return_trip', 'N', NULL),
(328, 347, 'INFANT', 'Bittu Das', 1, 'male', 'indian', NULL, NULL, NULL, 'return_trip', 'N', NULL),
(329, 348, 'Mr', 'Anirtban ghosh', 1, 'male', 'indian', NULL, NULL, NULL, 'single_trip', 'N', NULL),
(330, 348, 'INFANT', 'Puja Das', 1, 'male', 'indian', NULL, NULL, NULL, 'single_trip', 'N', NULL),
(331, 349, 'Mr', 'avijit chakraborty', 25, 'male', 'indian', NULL, NULL, NULL, 'single_trip', 'N', NULL),
(332, 349, 'INFANT', 'Joydev Paul', 1, 'male', 'indian', NULL, NULL, NULL, 'single_trip', 'N', NULL),
(333, 350, 'Mr', 'avijit chakraborty', 25, 'male', 'indian', NULL, NULL, NULL, 'return_trip', 'N', NULL),
(334, 350, 'INFANT', 'Joydev Paul', 1, 'male', 'indian', NULL, NULL, NULL, 'return_trip', 'N', NULL),
(335, 351, 'Mr', 'Newton Samaddar', 25, 'male', 'indian', NULL, NULL, NULL, 'single_trip', 'N', NULL),
(336, 352, 'Mr', 'Newton Samaddar', 25, 'male', 'indian', NULL, NULL, NULL, 'return_trip', 'N', NULL),
(337, 353, 'Mr', 'Anirtban ghosh', 25, 'male', 'indian', NULL, NULL, NULL, 'single_trip', 'N', NULL),
(338, 354, 'Mr', 'Anirtban ghosh', 25, 'male', 'indian', NULL, NULL, NULL, 'return_trip', 'N', NULL),
(339, 355, 'Mr', 'Anirtban ghosh', 25, 'male', 'indian', NULL, NULL, NULL, 'single_trip', 'N', NULL),
(340, 356, 'Mr', 'Anirtban ghosh', 25, 'male', 'indian', NULL, NULL, NULL, 'return_trip', 'N', NULL),
(341, 357, 'Mr', 'Anirtban ghosh', 28, 'male', 'indian', NULL, NULL, NULL, 'single_trip', 'N', NULL),
(342, 358, 'Mr', 'Anirtban ghosh', 28, 'male', 'indian', NULL, NULL, NULL, 'return_trip', 'N', NULL),
(343, 359, 'Mr', 'avijit chakraborty', 32, 'male', 'indian', NULL, NULL, NULL, 'single_trip', 'N', NULL),
(344, 360, 'Mr', 'avijit chakraborty', 32, 'male', 'indian', NULL, NULL, NULL, 'return_trip', 'N', NULL),
(345, 361, 'Mr', 'Newton Samaddar', 25, 'male', 'indian', NULL, NULL, NULL, 'single_trip', 'N', NULL),
(346, 362, 'Mr', 'Newton Samaddar', 25, 'male', 'indian', NULL, NULL, NULL, 'return_trip', 'N', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `booking_traveller_details`
--

CREATE TABLE `booking_traveller_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_booking_details_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `gender` enum('male','female','transgender') NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` varchar(55) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_traveller_details`
--

INSERT INTO `booking_traveller_details` (`id`, `user_id`, `package_booking_details_id`, `full_name`, `gender`, `age`, `email`, `mobile_no`, `created_at`, `status`) VALUES
(15, 42, 47, 'Avijit Chakraborty', 'male', 32, 'nextgen2@gmail.com', '8825207634', '2024-06-13 05:28:01', 0),
(16, 42, 47, 'Sayan Debnath', 'male', 25, 'nextgen2@gmail.com', '8825207634', '2024-06-13 05:28:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cancel_request_passerger`
--

CREATE TABLE `cancel_request_passerger` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `passenger_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'web user table id',
  `package_id` int(11) DEFAULT NULL COMMENT 'package table id',
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `mobile` text DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=default,1=inactive',
  `delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=default,1=deleted',
  `admin_responce_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `user_id`, `package_id`, `name`, `email`, `mobile`, `message`, `status`, `delete`, `admin_responce_at`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'asasdas', 'asasdas', 'asasdas', 'asasdas', 0, 0, NULL, '2024-01-29 00:59:56', '2024-01-29 00:59:56'),
(2, NULL, NULL, 'fggdg', 'admin1@xgenmedia.com', '8888888888', NULL, 0, 0, NULL, '2024-01-29 01:52:34', '2024-01-29 01:52:34'),
(3, NULL, NULL, 'sayan', 'admin1@xgenmedia.com', '8888888888', NULL, 0, 0, NULL, '2024-01-29 01:54:57', '2024-01-29 01:54:57'),
(4, NULL, NULL, 'retret', 'retertert@gmail.com', '8888888888', 'retretretertertertdgfhfghf', 0, 0, NULL, '2024-01-29 01:55:49', '2024-01-29 01:55:49'),
(5, NULL, NULL, 'retret', 'retertert@gmail.com', '8888888888', 'retretretertertertdgfhfghf', 0, 0, NULL, '2024-01-29 01:56:09', '2024-01-29 01:56:09'),
(6, NULL, NULL, 'fggdg', 'admin1@xgenmedia.com', '8888888888', NULL, 0, 0, NULL, '2024-01-29 01:58:04', '2024-01-29 01:58:04'),
(7, NULL, NULL, 'fggdg', 'admin1@xgenmedia.com', '8888888888', NULL, 0, 0, NULL, '2024-01-29 02:05:21', '2024-01-29 02:05:21'),
(8, NULL, NULL, 'asddasdasd', 'admin1@gmail.com', '5675675675', NULL, 0, 0, NULL, '2024-01-29 02:05:32', '2024-01-29 02:05:32'),
(9, NULL, NULL, 'sayan', 'admin1@xgenmedia.com', '8888888888', 'cdsfsdfsf', 0, 0, NULL, '2024-01-29 02:07:06', '2024-01-29 02:07:06'),
(10, NULL, NULL, 'fggdg', 'admin1@gmail.com', '6577777777', NULL, 0, 0, NULL, '2024-01-29 02:13:15', '2024-01-29 02:13:15'),
(11, NULL, NULL, 'i9ju', 'sumanta@xgenmedia.com', '8888888888', 'dsfsfds dsfs', 0, 0, NULL, '2024-01-29 03:06:12', '2024-01-29 03:06:12'),
(12, NULL, NULL, 'sayan', 'admin1@gmail.com', '6666666666', 'ewewr', 0, 0, NULL, '2024-01-29 03:07:49', '2024-01-29 03:07:49'),
(13, NULL, NULL, 'Avijit chakraborty', 'admin@gmail.com', '8825207634', 'Test message here', 0, 0, NULL, '2024-04-16 04:03:25', '2024-04-16 04:03:25'),
(14, NULL, NULL, 'chakraborty', 'bubay@gmail.com', '8825207634', 'sgfdsg', 0, 0, NULL, '2024-05-24 04:13:01', '2024-05-24 04:13:01'),
(15, NULL, NULL, 'chakraborty', 'bubay@gmail.com', '8825207634', 'cxzc', 0, 0, NULL, '2024-05-24 04:15:23', '2024-05-24 04:15:23'),
(16, NULL, NULL, 'chakraborty', 'nextgen@gmail.com', '8825207634', 'zcxzv', 0, 0, NULL, '2024-05-24 04:58:55', '2024-05-24 04:58:55'),
(17, NULL, NULL, 'chakraborty', 'admin@gmail.com', '8825207634', 'ascdasd', 0, 0, NULL, '2024-05-24 05:08:26', '2024-05-24 05:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(55) NOT NULL,
  `travel_month` varchar(255) DEFAULT NULL,
  `travel_duration` int(11) DEFAULT NULL,
  `travel_person` int(11) DEFAULT NULL,
  `travel_starting_price` float DEFAULT NULL,
  `travel_ending_price` float DEFAULT NULL,
  `comments` varchar(5000) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  `delete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `name`, `email`, `mobile`, `travel_month`, `travel_duration`, `travel_person`, `travel_starting_price`, `travel_ending_price`, `comments`, `created_at`, `updated_at`, `status`, `delete`) VALUES
(45, 'Avijit chakraborty', 'admin@gmail.com', '8825207634', 'May', 5, 2, 10000, 25000, 'suggest me any place for this price', '2024-06-13 05:28:02', '2024-06-13 05:28:02', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `questions` varchar(1200) NOT NULL,
  `answers` varchar(5000) NOT NULL,
  `faq_category` int(11) NOT NULL,
  `related_module` enum('activity','blogs','all') NOT NULL DEFAULT 'all',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `delete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `questions`, `answers`, `faq_category`, `related_module`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`, `delete`) VALUES
(1, 'How do I reach the Andaman Islands?', 'The Andaman and Nicobar Islands are a famed vacation destination known for their\r\n                                        scenic\r\n                                        beauty and beaches. The quickest way to get to Andaman is by flight. There are\r\n     ', 2, 'all', '2024-06-13 05:28:02', '2024-06-13 05:28:02', 1, NULL, 0, 0),
(2, 'When is the best time of year to visit the Andaman and Nicobar Islands?', 'The best time to visit the Andaman and Nicobar Islands is generally from November to April. During these months, the weather is typically pleasant with clear skies, calm seas, and minimal rainfall, making it ideal for outdoor activities such as swimming, snorkeling, and sightseeing. Additionally, the water visibility for diving is at its best during this period, offering excellent opportunities to explore the vibrant marine life of the region.', 1, 'activity', '2024-06-13 05:28:02', '2024-06-13 05:28:02', 0, NULL, 0, 0),
(3, ' Which are the most beautiful beaches to visit?', 'Radhanagar Beach (Havelock Island): Often hailed as one of Asia\'s best beaches, Radhanagar Beach mesmerizes visitors with its crystal-clear turquoise waters, powdery white sand, and lush greenery.', 3, 'all', '2024-06-13 05:28:02', '2024-06-13 05:28:02', 1, NULL, 0, 0),
(4, 'Where are the best spots for snorkeling and diving ?', 'Elephant Beach: Known for its vibrant coral reefs and clear waters, Elephant Beach is an excellent spot for snorkeling. Visitors can explore colorful corals, tropical fish, and other marine life just a short distance from the shore also.', 4, 'blogs', '2024-06-13 05:28:02', '2024-06-13 05:28:02', 0, NULL, 0, 0),
(8, 'When is the best time of year to visit the Andaman and Nicobar Islands?', 'The best time to visit the Andaman and Nicobar Islands is generally from November to April. During these months, the weather is typically pleasant with clear skies, calm seas, and minimal rainfall, making it ideal for outdoor activities such as swimming, snorkeling, and sightseeing. Additionally, the water visibility for diving is at its best during this period, offering excellent opportunities to explore the vibrant marine life of the region.', 2, 'activity', '2024-06-13 05:28:02', '2024-06-13 05:28:02', 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `faq_category`
--

CREATE TABLE `faq_category` (
  `id` int(11) NOT NULL,
  `category_title` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `delete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq_category`
--

INSERT INTO `faq_category` (`id`, `category_title`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`, `delete`) VALUES
(1, 'Payment', '2024-06-13 05:28:02', '2024-06-13 05:28:02', 1, NULL, 0, 0),
(2, 'Account', '2024-06-13 05:28:02', '2024-06-13 05:28:02', 1, NULL, 0, 0),
(3, 'Booking', '2024-06-13 05:28:02', '2024-06-13 05:28:02', 1, NULL, 0, 0),
(4, 'Hotels', '2024-06-13 05:28:02', '2024-06-13 05:28:02', 1, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ferry_locations`
--

CREATE TABLE `ferry_locations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `status` enum('Y','N','D') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ferry_locations`
--

INSERT INTO `ferry_locations` (`id`, `title`, `code`, `status`) VALUES
(1, 'Port Blair', 'PB', 'Y'),
(2, 'Havelok', 'HL', 'Y'),
(3, 'Neil', 'NL', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `ferry_schedule`
--

CREATE TABLE `ferry_schedule` (
  `id` int(11) NOT NULL,
  `from_location` int(11) NOT NULL,
  `to_location` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `arrival_time` time NOT NULL,
  `ship_id` int(11) NOT NULL,
  `status` enum('Y','N','D') NOT NULL DEFAULT 'Y',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ferry_schedule`
--

INSERT INTO `ferry_schedule` (`id`, `from_location`, `to_location`, `from_date`, `to_date`, `departure_time`, `arrival_time`, `ship_id`, `status`, `created_at`, `updated_at`) VALUES
(5, 1, 2, '2024-06-01', '2028-12-31', '06:00:00', '08:30:00', 3, 'Y', '2024-06-19 06:05:31', '2024-06-19 06:05:31'),
(6, 2, 3, '2024-06-01', '2025-12-31', '09:15:00', '10:30:00', 3, 'Y', '2024-06-19 06:07:35', '2024-06-19 06:07:35'),
(7, 3, 1, '2024-06-01', '2026-12-31', '11:00:00', '12:45:00', 3, 'Y', '2024-06-19 06:09:32', '2024-06-19 06:09:32'),
(8, 2, 1, '2024-07-10', '2024-09-25', '11:00:00', '12:30:00', 3, 'Y', '2024-06-28 05:24:24', '2024-06-28 05:24:24'),
(9, 1, 2, '2024-07-10', '2024-09-25', '11:00:00', '12:30:00', 3, 'Y', '2024-06-28 05:24:24', '2024-06-28 05:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `ferry_schedule_price`
--

CREATE TABLE `ferry_schedule_price` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ferry_schedule_price`
--

INSERT INTO `ferry_schedule_price` (`id`, `schedule_id`, `class_id`, `price`, `created_at`, `updated_at`) VALUES
(7, 15, 1, 1500.00, '2024-06-17 08:31:52', '2024-06-17 08:31:52'),
(8, 7, 2, 2000.00, '2024-06-17 08:31:52', '2024-06-17 08:31:52'),
(9, 1, 2, 6000.00, '2024-06-17 11:00:21', '2024-06-17 11:00:21'),
(10, 1, 1, 5000.00, '2024-06-17 11:00:21', '2024-06-17 11:00:21'),
(11, 1, 4, 12000.00, '2024-06-17 11:00:21', '2024-06-17 11:00:21'),
(12, 1, 3, 6000.00, '2024-06-17 11:00:21', '2024-06-17 11:00:21'),
(13, 9, 1, 1500.00, '2024-06-17 11:33:00', '2024-06-17 11:33:00'),
(14, 9, 2, 2000.00, '2024-06-17 11:33:00', '2024-06-17 11:33:00'),
(15, 4, 3, 5000.00, '2024-06-17 11:34:51', '2024-06-17 11:34:51'),
(16, 4, 4, 8000.00, '2024-06-17 11:34:51', '2024-06-17 11:34:51'),
(17, 5, 1, 1050.00, '2024-06-19 06:05:31', '2024-06-19 06:05:31'),
(18, 5, 4, 1250.00, '2024-06-19 06:05:31', '2024-06-19 06:05:31'),
(19, 6, 1, 1550.00, '2024-06-19 06:07:35', '2024-06-19 06:07:35'),
(20, 6, 4, 1750.00, '2024-06-19 06:07:35', '2024-06-19 06:07:35'),
(21, 7, 1, 1550.00, '2024-06-19 06:09:32', '2024-06-19 06:09:32'),
(22, 7, 4, 1750.00, '2024-06-19 06:09:32', '2024-06-19 06:09:32'),
(23, 8, 1, 1500.00, '2024-06-28 05:24:24', '2024-06-28 05:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `subtitle` text DEFAULT NULL,
  `path` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `size` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0=default,1=inactive',
  `delete` tinyint(4) DEFAULT 0 COMMENT '0=default,1=deleted',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `subtitle`, `path`, `description`, `size`, `status`, `delete`, `created_at`, `updated_at`) VALUES
(1, 'Port Blair', NULL, '1718703718.png', 'Port Blair', NULL, 1, 0, '2024-06-18 04:11:58', '2024-06-18 04:11:58'),
(2, 'Havelock', NULL, '1718702816.png', 'Havelock', NULL, 1, 0, '2024-06-18 03:56:56', '2024-06-18 03:56:56'),
(3, 'Neil Island', NULL, '1718702880.png', 'Neil Island', NULL, 1, 0, '2024-06-18 03:58:00', '2024-06-18 03:58:00'),
(4, 'Baratang', NULL, '1718702920.png', 'Baratand', NULL, 1, 0, '2024-06-18 03:58:40', '2024-06-18 03:58:40'),
(5, 'Diglipur', NULL, '1718702967.png', 'Diglipur', NULL, 1, 0, '2024-06-18 03:59:27', '2024-06-18 03:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `base_path` varchar(255) NOT NULL,
  `base_url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `title`, `base_path`, `base_url`, `created_at`, `updated_at`, `status`, `deleted`) VALUES
(1, 0, 'Users', 'user', 'user-list,user-create,user-edit,user-delete', NULL, NULL, 0, 0),
(2, 0, 'Roles', 'role', 'role-list,role-create,role-edit,role-delete', NULL, NULL, 0, 0),
(5, 0, 'Menus', 'menu', 'menu-list,menu-create', NULL, NULL, 0, 0),
(10, 0, 'Home Banner', 'banner', 'banner-list,banner-create,banner-edit,banner-delete', '2023-12-11 23:09:25', '2023-12-11 23:09:25', 0, 0),
(11, 0, 'Top Destination', 'destination', 'destination-list,destination-create,destination-edit,destination-delete', '2023-12-22 00:01:55', '2023-12-22 00:01:55', 0, 0),
(12, 0, 'Blog', 'blog', 'blog-list,blog-create,blog-edit,blog-delete', '2023-12-22 04:21:38', '2023-12-22 04:21:38', 0, 0),
(13, 0, 'Sight Seeing', 'sightseeing', 'sightseeing-list,sightseeing-create,sightseeing-edit,sightseeing-delete', '2023-12-27 23:56:09', '2023-12-27 23:56:09', 0, 0),
(14, 0, 'Testimonial', 'testimonial', 'testimonial-list,testimonial-create,testimonial-edit,testimonial-delete', '2023-12-28 04:46:03', '2023-12-28 04:46:03', 0, 0),
(15, 0, 'Achievements', 'achievement', 'achievement-list,achievement-create,achievement-edit,achievement-delete', '2023-12-28 05:16:40', '2023-12-28 05:16:40', 0, 0),
(16, 0, 'Actiivity', 'activity', 'activity-list,activity-create,activity-edit,activity-delete', '2023-12-28 22:46:29', '2023-12-28 22:46:29', 0, 0),
(17, 0, 'Hotel', 'hotel', 'hotel-list,hotel-create,hotel-edit,hotel-delete', '2023-12-29 01:04:09', '2023-12-29 01:04:09', 0, 0),
(18, 0, 'Cab', 'cab', 'cab-list,cab-create,cab-edit,cab-delete', '2024-01-03 03:57:05', '2024-01-03 03:57:05', 0, 0),
(19, 0, 'Package', 'package', 'package-list,package-create,package-edit,package-delete', '2024-01-04 01:45:00', '2024-01-04 01:45:00', 0, 0),
(20, 0, 'Contact us', 'contactus', 'contactus-list,contactus-create,contactus-edit,contactus-delete', '2024-01-28 23:38:55', '2024-01-28 23:38:55', 0, 0),
(21, 0, 'Our Partners', 'partners', 'partners-list,partners-create,partners-edit,partners-delete', '2024-04-11 01:51:16', '2024-04-11 01:51:16', 0, 0),
(22, 0, 'Faq', 'faq', 'faq-list,faq-create,faq-edit,faq-delete', '2024-04-16 00:39:44', '2024-04-16 00:39:44', 0, 0),
(23, 0, 'Cars', 'cars', 'cars-list,cars-create,cars-edit,cars-delete', '2024-04-26 01:38:58', '2024-04-26 01:38:58', 0, 0),
(24, 0, 'Sightseeing Places', 'sightseeing_location', 'SightseeingLocation-list,sightseeing_location-create,sightseeing_location-edit,sightseeing_location-delete', '2024-04-29 23:55:41', '2024-04-29 23:55:41', 0, 0),
(26, 0, 'Custom Packages', 'packages', 'packages-list,packages-create,packages-edit,packages-delete', '2024-05-23 02:30:32', '2024-05-23 02:30:32', 0, 0),
(27, 0, 'Hotel Category', 'hotel_category', 'hotel_category-list,hotel_category-create,hotel_category-edit,hotel_category-delete', '2024-05-28 07:00:43', '2024-05-28 07:00:43', 0, 0),
(28, 0, 'Schedule Management', 'ferryschedule', 'ferryschedule-list,ferryschedule-create,ferryschedule-edit,ferryschedule-delete', '2024-06-14 05:33:14', '2024-06-14 05:33:14', 0, 0),
(30, 0, 'Tourlocation Destination', 'tourlocation', 'tourlocation-list,tourlocation-create,tourlocation-edit,tourlocation-delete', '2024-06-18 01:23:31', '2024-06-18 01:23:31', 0, 0),
(31, 0, 'Boat Management', 'boatschedule', 'boatschedule-list,boatschedule-create,boatschedule-edit,boatschedule-delete,', '2024-06-19 23:43:39', '2024-06-19 23:43:39', 0, 0),
(32, 0, 'PNR Status', 'pnrstatus', 'pnrstatus-list,pnrstatus-create,pnrstatus-edit,pnrstatus-delete', '2024-07-01 06:13:52', '2024-07-01 06:13:52', 0, 0),
(33, 0, 'Ticket Cancellation', 'ticketcancellation', 'ticketcancellation-list,ticketcancellation-create,ticketcancellation-edit,ticketcancellation-delete', '2024-07-12 05:08:39', '2024-07-12 05:08:39', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_09_28_091336_create_permission_tables', 1),
(6, '2014_10_12_100000_create_password_resets_table', 2),
(7, '2023_09_28_092814_create_products_table', 2),
(10, '2023_10_13_103802_create_module_table', 3),
(11, '2023_10_13_104352_create_moduleid_topermission_tables', 3),
(13, '2023_10_16_053210_add_basepath_column_menus', 4),
(14, '2023_11_08_070736_create_user_has_permission_table', 5),
(15, '2023_12_12_045040_create_banners_table', 6),
(16, '2023_12_20_113413_remove_path_field_banners_table', 7),
(17, '2023_12_20_113808_add_banner_images_table', 8),
(18, '2023_12_21_102156_add_paid_to_banner_images_table', 9),
(21, '2023_12_22_054952_create_locations_table', 10),
(22, '2023_12_22_093929_create_blogs_table', 11),
(23, '2023_12_28_054922_create_sight_seeings_table', 12),
(24, '2023_12_28_072252_create_sight_seeing_images_table', 12),
(27, '2023_12_28_095943_create_testimonial_table', 13),
(28, '2023_12_28_104429_create_achievement_table', 14),
(30, '2023_12_29_042429_create_activity_images_table', 15),
(31, '2023_12_29_042332_create_activity_table', 16),
(32, '2023_12_29_060227_create_hotels_table', 17),
(34, '2023_12_29_060301_create_room_images_table', 17),
(35, '2023_12_29_060309_create_room_table', 17),
(37, '2024_01_03_093028_create_cab_images_table', 18),
(38, '2024_01_03_092954_create_cabs_table', 19),
(39, '2024_01_04_085549_create_package_styles_table', 20),
(40, '2024_01_04_085555_create_packages_table', 20),
(41, '2024_01_04_085612_create_package_features_table', 20),
(42, '2024_01_04_085650_create_package_images_table', 20),
(47, '2023_12_29_060251_create_hotel_images_table', 21),
(48, '2024_01_10_064915_create_itinerary_table', 21),
(49, '2024_01_10_065303_create_itinerary_images_table', 21),
(52, '2024_01_10_103846_create_policys_table', 22),
(54, '2024_01_11_060708_create_type_price_images_table', 23),
(55, '2024_01_11_060654_create_type_prices_table', 24),
(57, '2024_01_11_063408_create_package_types_table', 25),
(58, '2016_06_01_000001_create_oauth_auth_codes_table', 26),
(59, '2016_06_01_000002_create_oauth_access_tokens_table', 26),
(60, '2016_06_01_000003_create_oauth_refresh_tokens_table', 26),
(61, '2016_06_01_000004_create_oauth_clients_table', 26),
(62, '2016_06_01_000005_create_oauth_personal_access_clients_table', 26),
(63, '2024_01_12_060941_add_column_to_users_table', 27),
(64, '2024_01_16_060215_create_web_users_table', 27),
(65, '2024_01_29_051230_create_contactus_table', 28);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 6),
(1, 'App\\Models\\User', 11),
(1, 'App\\Models\\User', 17),
(4, 'App\\Models\\User', 10),
(5, 'App\\Models\\User', 11),
(6, 'App\\Models\\User', 7),
(6, 'App\\Models\\User', 11),
(8, 'App\\Models\\User', 12),
(8, 'App\\Models\\User', 14),
(8, 'App\\Models\\User', 16),
(10, 'App\\Models\\User', 20);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('296a77d2a427e101cdd9edd700253d7fd3866e51a60d70b835ea26d205940630f88d2e42c37b7527', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2024-01-16 04:20:51', '2024-01-16 04:20:51', '2025-01-16 09:50:51'),
('39932b990469bb64a7595bac128db317c0cbcfd6593ff9d89f1cb7193f5cd2c8e0c916fb9567df07', 19, 1, 'LaravelAuthApp', '[]', 0, '2024-01-16 03:46:25', '2024-01-16 03:46:25', '2025-01-16 09:16:25'),
('546940812554db991af01b05325d14e0baac75550b9287eeb70f26649043b593ea59782901ab4813', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2024-01-16 04:45:42', '2024-01-16 04:45:42', '2025-01-16 10:15:42'),
('93d5e5d843e696640c826426844ffd1f22fe673534edf0ceec13091734cc53bb133c36e24c10c878', 19, 1, 'Laravel Password Grant Client', '[]', 0, '2024-01-17 01:56:33', '2024-01-17 01:56:33', '2025-01-17 07:26:33'),
('b1f5b3591580c7ad9783a3da84e184302004f2b13d234eb59f7a166fc344958d91fed2d1f2656dc6', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2024-01-16 04:44:59', '2024-01-16 04:44:59', '2025-01-16 10:14:59'),
('e3b74c15ab5a53696164689139f7fac838cfbf372dc86230893ebe6323da0a57a97b0d7d43b1d93e', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2024-01-16 23:30:49', '2024-01-16 23:30:50', '2025-01-17 05:00:49'),
('e69d2b4c4aebb9a5763c4e3cc1cf680729d1b1c68d1712eb99e79e5a05b10f43ea445239f0aea371', 18, 1, 'LaravelAuthApp', '[]', 0, '2024-01-16 03:38:50', '2024-01-16 03:38:50', '2025-01-16 09:08:50'),
('e7089d7d6aff97ab2e262509e2223be14bee1837b5bdf61e53eec3427b9b83cc15392ce2888021d8', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2024-01-16 04:22:02', '2024-01-16 04:22:02', '2025-01-16 09:52:02');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'pristineandaman', 'IYgTjrcryDwpAgibNJQps27G0MgHKfdweB2ZaB64', NULL, 'http://localhost', 1, 0, 0, '2024-01-16 03:38:06', '2024-01-16 03:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-01-16 03:38:06', '2024-01-16 03:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_booking_details`
--

CREATE TABLE `package_booking_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `custom_package_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` varchar(55) NOT NULL,
  `journey_date` datetime NOT NULL,
  `payment_status` enum('pending','success','failed') NOT NULL DEFAULT 'pending',
  `order_id` varchar(255) DEFAULT NULL,
  `invoice_id` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `delete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_booking_details`
--

INSERT INTO `package_booking_details` (`id`, `user_id`, `custom_package_id`, `email`, `mobile_no`, `journey_date`, `payment_status`, `order_id`, `invoice_id`, `created_at`, `updated_at`, `status`, `delete`) VALUES
(47, 42, 311, 'test@gmail.com', '8825207634', '2024-05-29 11:27:40', 'pending', '124', '124', '2024-06-13 05:28:03', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `company_logo` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `is_deleted` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `company_name`, `address`, `company_logo`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`, `is_deleted`) VALUES
(1, 'TCS', 'tcs', 'uploads/partners/6617c1eea5563_TCS.jpg', 2024, 2024, '2024-06-13 05:28:04', '2024-06-13 05:28:04', 'Active', 'No'),
(2, 'Tata', 'tata', 'uploads/partners/6617c6d186376_images.png', 2024, 2024, '2024-06-13 05:28:04', '2024-06-13 05:28:04', 'Active', 'No'),
(3, 'Mahindra', 'mahindra', 'uploads/partners/6617c6c377305_mahindra.png', 2024, 2024, '2024-06-13 05:28:04', '2024-06-13 05:28:04', 'Active', 'No'),
(4, 'Infossis', 'infossis', 'uploads/partners/6617c6b3be2b7_Infosys_Consulting_Logo.png', 2024, 2024, '2024-06-13 05:28:04', '2024-06-13 05:28:04', 'Active', 'No'),
(6, 'Deloitte', 'Deloitte', 'uploads/partners/6617c6263d440_images (1).png', 2024, 2024, '2024-06-13 05:28:04', '2024-06-13 05:28:04', 'Active', 'No'),
(7, 'Wipro', 'wipro', 'uploads/partners/6617caed45166_wipro.png', 2024, 2024, '2024-06-13 05:28:04', '2024-06-13 05:28:04', 'Active', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `package_booking_details_id` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `card_type` varchar(255) DEFAULT NULL,
  `card_last4` int(11) DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `menu_id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 2, 'role-list', 'web', '2023-09-28 04:20:11', '2023-09-28 04:20:11'),
(2, 2, 'role-create', 'web', '2023-09-28 04:20:11', '2023-09-28 04:20:11'),
(3, 2, 'role-edit', 'web', '2023-09-28 04:20:11', '2023-09-28 04:20:11'),
(4, 2, 'role-delete', 'web', '2023-09-28 04:20:11', '2023-09-28 04:20:11'),
(9, 1, 'user-list', 'web', '2023-09-28 04:20:11', '2023-09-28 04:20:11'),
(10, 1, 'user-create', 'web', '2023-09-28 04:20:11', '2023-09-28 04:20:11'),
(11, 1, 'user-edit', 'web', '2023-09-28 04:20:11', '2023-09-28 04:20:11'),
(12, 1, 'user-delete', 'web', '2023-09-28 04:20:11', '2023-09-28 04:20:11'),
(13, 5, 'menu-list', 'web', '2023-09-28 04:20:11', '2023-09-28 04:20:11'),
(14, 5, 'menu-create', 'web', '2023-09-28 04:20:11', '2023-09-28 04:20:11'),
(32, 10, 'banner-list', 'web', '2023-12-11 23:09:25', '2023-12-11 23:09:25'),
(33, 10, 'banner-create', 'web', '2023-12-11 23:09:25', '2023-12-11 23:09:25'),
(34, 10, 'banner-edit', 'web', '2023-12-11 23:09:25', '2023-12-11 23:09:25'),
(35, 10, 'banner-delete', 'web', '2023-12-11 23:09:25', '2023-12-11 23:09:25'),
(36, 11, 'destination-list', 'web', '2023-12-22 00:01:55', '2023-12-22 00:01:55'),
(37, 11, 'destination-create', 'web', '2023-12-22 00:01:55', '2023-12-22 00:01:55'),
(38, 11, 'destination-edit', 'web', '2023-12-22 00:01:55', '2023-12-22 00:01:55'),
(39, 11, 'destination-delete', 'web', '2023-12-22 00:01:55', '2023-12-22 00:01:55'),
(40, 12, 'blog-list', 'web', '2023-12-22 04:21:38', '2023-12-22 04:21:38'),
(41, 12, 'blog-create', 'web', '2023-12-22 04:21:38', '2023-12-22 04:21:38'),
(42, 12, 'blog-edit', 'web', '2023-12-22 04:21:38', '2023-12-22 04:21:38'),
(43, 12, 'blog-delete', 'web', '2023-12-22 04:21:38', '2023-12-22 04:21:38'),
(44, 13, 'sightseeing-list', 'web', '2023-12-27 23:56:09', '2023-12-27 23:56:09'),
(45, 13, 'sightseeing-create', 'web', '2023-12-27 23:56:09', '2023-12-27 23:56:09'),
(46, 13, 'sightseeing-edit', 'web', '2023-12-27 23:56:09', '2023-12-27 23:56:09'),
(47, 13, 'sightseeing-delete', 'web', '2023-12-27 23:56:09', '2023-12-27 23:56:09'),
(48, 14, 'testimonial-list', 'web', '2023-12-28 04:46:03', '2023-12-28 04:46:03'),
(49, 14, 'testimonial-create', 'web', '2023-12-28 04:46:03', '2023-12-28 04:46:03'),
(50, 14, 'testimonial-edit', 'web', '2023-12-28 04:46:03', '2023-12-28 04:46:03'),
(51, 14, 'testimonial-delete', 'web', '2023-12-28 04:46:03', '2023-12-28 04:46:03'),
(52, 15, 'achievement-list', 'web', '2023-12-28 05:16:40', '2023-12-28 05:16:40'),
(53, 15, 'achievement-create', 'web', '2023-12-28 05:16:40', '2023-12-28 05:16:40'),
(54, 15, 'achievement-edit', 'web', '2023-12-28 05:16:40', '2023-12-28 05:16:40'),
(55, 15, 'achievement-delete', 'web', '2023-12-28 05:16:40', '2023-12-28 05:16:40'),
(56, 16, 'activity-list', 'web', '2023-12-28 22:46:29', '2023-12-28 22:46:29'),
(57, 16, 'activity-create', 'web', '2023-12-28 22:46:29', '2023-12-28 22:46:29'),
(58, 16, 'activity-edit', 'web', '2023-12-28 22:46:29', '2023-12-28 22:46:29'),
(59, 16, 'activity-delete', 'web', '2023-12-28 22:46:29', '2023-12-28 22:46:29'),
(60, 17, 'hotel-list', 'web', '2023-12-29 01:04:09', '2023-12-29 01:04:09'),
(61, 17, 'hotel-create', 'web', '2023-12-29 01:04:09', '2023-12-29 01:04:09'),
(62, 17, 'hotel-edit', 'web', '2023-12-29 01:04:09', '2023-12-29 01:04:09'),
(63, 17, 'hotel-delete', 'web', '2023-12-29 01:04:09', '2023-12-29 01:04:09'),
(64, 18, 'cab-list', 'web', '2024-01-03 03:57:05', '2024-01-03 03:57:05'),
(65, 18, 'cab-create', 'web', '2024-01-03 03:57:05', '2024-01-03 03:57:05'),
(66, 18, 'cab-edit', 'web', '2024-01-03 03:57:05', '2024-01-03 03:57:05'),
(67, 18, 'cab-delete', 'web', '2024-01-03 03:57:05', '2024-01-03 03:57:05'),
(68, 19, 'package-list', 'web', '2024-01-04 01:45:00', '2024-01-04 01:45:00'),
(69, 19, 'package-create', 'web', '2024-01-04 01:45:00', '2024-01-04 01:45:00'),
(70, 19, 'package-edit', 'web', '2024-01-04 01:45:00', '2024-01-04 01:45:00'),
(71, 19, 'package-delete', 'web', '2024-01-04 01:45:00', '2024-01-04 01:45:00'),
(72, 20, 'contactus-list', 'web', '2024-01-28 23:38:55', '2024-01-28 23:38:55'),
(73, 20, 'contactus-create', 'web', '2024-01-28 23:38:55', '2024-01-28 23:38:55'),
(74, 20, 'contactus-edit', 'web', '2024-01-28 23:38:55', '2024-01-28 23:38:55'),
(75, 20, 'contactus-delete', 'web', '2024-01-28 23:38:55', '2024-01-28 23:38:55'),
(76, 21, 'partners-list', 'web', '2024-04-11 01:51:16', '2024-04-11 01:51:16'),
(77, 21, 'partners-create', 'web', '2024-04-11 01:51:16', '2024-04-11 01:51:16'),
(78, 21, 'partners-edit', 'web', '2024-04-11 01:51:16', '2024-04-11 01:51:16'),
(79, 21, 'partners-delete', 'web', '2024-04-11 01:51:16', '2024-04-11 01:51:16'),
(80, 22, 'faq-list', 'web', '2024-04-16 00:39:44', '2024-04-16 00:39:44'),
(81, 22, 'faq-create', 'web', '2024-04-16 00:39:44', '2024-04-16 00:39:44'),
(82, 22, 'faq-edit', 'web', '2024-04-16 00:39:44', '2024-04-16 00:39:44'),
(83, 22, 'faq-delete', 'web', '2024-04-16 00:39:44', '2024-04-16 00:39:44'),
(84, 23, 'cars-list', 'web', '2024-04-26 01:38:58', '2024-04-26 01:38:58'),
(85, 23, 'cars-create', 'web', '2024-04-26 01:38:58', '2024-04-26 01:38:58'),
(86, 23, 'cars-edit', 'web', '2024-04-26 01:38:58', '2024-04-26 01:38:58'),
(87, 23, 'cars-delete', 'web', '2024-04-26 01:38:58', '2024-04-26 01:38:58'),
(88, 24, 'sightseeing_location-list', 'web', '2024-04-29 23:55:41', '2024-04-29 23:55:41'),
(89, 24, 'sightseeing_location-create', 'web', '2024-04-29 23:55:41', '2024-04-29 23:55:41'),
(90, 24, 'sightseeing_location-edit', 'web', '2024-04-29 23:55:41', '2024-04-29 23:55:41'),
(91, 24, 'sightseeing_location-delete', 'web', '2024-04-29 23:55:41', '2024-04-29 23:55:41'),
(96, 26, 'packages-list', 'web', '2024-05-23 02:30:32', '2024-05-23 02:30:32'),
(97, 26, 'packages-create', 'web', '2024-05-23 02:30:32', '2024-05-23 02:30:32'),
(98, 26, 'packages-edit', 'web', '2024-05-23 02:30:32', '2024-05-23 02:30:32'),
(99, 26, 'packages-delete', 'web', '2024-05-23 02:30:32', '2024-05-23 02:30:32'),
(100, 27, 'hotel_category-list', 'web', '2024-05-28 07:00:43', '2024-05-28 07:00:43'),
(101, 27, 'hotel_category-create', 'web', '2024-05-28 07:00:43', '2024-05-28 07:00:43'),
(102, 27, 'hotel_category-edit', 'web', '2024-05-28 07:00:43', '2024-05-28 07:00:43'),
(103, 27, 'hotel_category-delete', 'web', '2024-05-28 07:00:43', '2024-05-28 07:00:43'),
(104, 28, 'ferryschedule-list', 'web', '2024-06-14 05:33:14', '2024-06-14 05:33:14'),
(105, 28, 'ferryschedule-create', 'web', '2024-06-14 05:33:14', '2024-06-14 05:33:14'),
(106, 28, 'ferryschedule-edit', 'web', '2024-06-14 05:33:14', '2024-06-14 05:33:14'),
(107, 28, 'ferryschedule-delete', 'web', '2024-06-14 05:33:14', '2024-06-14 05:33:14'),
(112, 30, 'tourlocation-list', 'web', '2024-06-18 01:23:31', '2024-06-18 01:23:31'),
(113, 30, 'tourlocation-create', 'web', '2024-06-18 01:23:31', '2024-06-18 01:23:31'),
(114, 30, 'tourlocation-edit', 'web', '2024-06-18 01:23:31', '2024-06-18 01:23:31'),
(115, 30, 'tourlocation-delete', 'web', '2024-06-18 01:23:31', '2024-06-18 01:23:31'),
(116, 31, 'boatschedule-list', 'web', '2024-06-19 23:43:39', '2024-06-19 23:43:39'),
(117, 31, ' boatschedule-create', 'web', '2024-06-19 23:43:39', '2024-06-19 23:43:39'),
(118, 31, ' boatschedule-edit', 'web', '2024-06-19 23:43:39', '2024-06-19 23:43:39'),
(119, 31, '\r\n boatschedule-delete', 'web', '2024-06-19 23:43:39', '2024-06-19 23:43:39'),
(120, 31, '', 'web', '2024-06-19 23:43:39', '2024-06-19 23:43:39'),
(121, 32, 'pnrstatus-list', 'web', '2024-07-01 06:13:52', '2024-07-01 06:13:52'),
(122, 32, 'pnrstatus-create', 'web', '2024-07-01 06:13:52', '2024-07-01 06:13:52'),
(123, 32, 'pnrstatus-edit', 'web', '2024-07-01 06:13:52', '2024-07-01 06:13:52'),
(124, 32, 'pnrstatus-delete', 'web', '2024-07-01 06:13:52', '2024-07-01 06:13:52'),
(125, 33, 'ticketcancellation-list', 'web', '2024-07-12 05:08:39', '2024-07-12 05:08:39'),
(126, 33, 'ticketcancellation-create', 'web', '2024-07-12 05:08:39', '2024-07-12 05:08:39'),
(127, 33, 'ticketcancellation-edit', 'web', '2024-07-12 05:08:39', '2024-07-12 05:08:39'),
(128, 33, 'ticketcancellation-delete', 'web', '2024-07-12 05:08:39', '2024-07-12 05:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pnr_status`
--

CREATE TABLE `pnr_status` (
  `id` int(11) NOT NULL,
  `pnr_id` varchar(255) DEFAULT NULL,
  `booking_status` varchar(255) DEFAULT NULL,
  `booking_id` int(11) NOT NULL,
  `makruzz_booking_id` varchar(255) DEFAULT NULL,
  `razorpay_payment_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `seat_status` varchar(255) DEFAULT '0',
  `booking_vendor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pnr_status`
--

INSERT INTO `pnr_status` (`id`, `pnr_id`, `booking_status`, `booking_id`, `makruzz_booking_id`, `razorpay_payment_id`, `created_at`, `seat_status`, `booking_vendor`) VALUES
(143, '632D5350', 'Success', 346, NULL, 'pay_Oa6Mr9t7YSWh3u', '2024-07-18 18:22:32', '1', 'Nautika'),
(144, 'SYRGYW', NULL, 347, '3651', 'pay_Oa6Mr9t7YSWh3u', '2024-07-18 18:22:35', '1', 'Makruzz'),
(145, NULL, NULL, 348, NULL, 'pay_Oa7D9Ar0IkhjcA', '2024-07-18 19:12:03', '1', 'Green Ocean'),
(146, NULL, NULL, 351, NULL, 'pay_ObgA1ICJNdMHNr', '2024-07-22 18:02:22', '1', 'Green Ocean'),
(147, 'EKFJNJ', NULL, 352, '3724', 'pay_ObgA1ICJNdMHNr', '2024-07-22 18:02:24', '1', 'Makruzz'),
(148, NULL, NULL, 353, NULL, 'pay_Obgj0xaXHcolf3', '2024-07-22 18:35:29', '1', 'Green Ocean'),
(149, 'HVVJEN', NULL, 354, '3727', 'pay_Obgj0xaXHcolf3', '2024-07-22 18:35:32', '1', 'Makruzz'),
(150, NULL, NULL, 355, NULL, 'pay_Obgkx3kZmn8hZm', '2024-07-22 18:37:19', '1', 'Green Ocean'),
(151, 'NJDULH', NULL, 356, '3728', 'pay_Obgkx3kZmn8hZm', '2024-07-22 18:37:21', '1', 'Makruzz'),
(152, NULL, NULL, 357, NULL, 'pay_ObgojKkJfuhXsm', '2024-07-22 18:40:53', '1', 'Green Ocean'),
(153, 'WTHUPO', NULL, 358, '3731', 'pay_ObgojKkJfuhXsm', '2024-07-22 18:40:56', '1', 'Makruzz'),
(154, NULL, NULL, 359, NULL, 'pay_ObgqpkrvFS0Hp8', '2024-07-22 18:42:53', '1', 'Green Ocean'),
(155, 'NBBJWS', NULL, 360, '3732', 'pay_ObgqpkrvFS0Hp8', '2024-07-22 18:42:55', '1', 'Makruzz'),
(156, NULL, NULL, 361, NULL, 'pay_ObygI9uTtsdmq4', '2024-07-23 12:09:20', '1', 'Green Ocean'),
(157, 'REQXHS', NULL, 362, '3735', 'pay_ObygI9uTtsdmq4', '2024-07-23 12:09:22', '1', 'Makruzz');

-- --------------------------------------------------------

--
-- Table structure for table `policys`
--

CREATE TABLE `policys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` int(11) NOT NULL COMMENT 'package table id',
  `title` text DEFAULT NULL,
  `subtitle` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `policys`
--

INSERT INTO `policys` (`id`, `package_id`, `title`, `subtitle`) VALUES
(2, 3, 'dfgdfgdg 3333344444', 'dgdgdfdgg GGGGGGG'),
(3, 3, '231231', '21321321312'),
(4, 3, 'cccc', 'cccccccccc'),
(5, 9, 'rtyrty', 'tyrtyrtyrty'),
(6, 9, 'rtyrtysress', 'rtyrtyrtyrtyrtytr'),
(7, 8, 'dfgdg', 'dfgdfgdfg'),
(8, 8, 'dfgdfgdadqw4q4234423', 'gdfgdfgdgdgdfgdfgdfgdfg3242342423'),
(9, 20, 'test policy', 'test subtitle'),
(10, 32, 'test policy', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `razorpay_payment_details`
--

CREATE TABLE `razorpay_payment_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `amount` text DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `international` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `amount_refunded` varchar(255) DEFAULT NULL,
  `refund_status` varchar(255) DEFAULT NULL,
  `captured` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `card_id` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `wallet` varchar(255) DEFAULT NULL,
  `vpa` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `fee` varchar(255) DEFAULT NULL,
  `tax` varchar(255) DEFAULT NULL,
  `error_code` varchar(255) DEFAULT NULL,
  `error_description` varchar(255) DEFAULT NULL,
  `error_source` varchar(255) DEFAULT NULL,
  `error_step` varchar(255) DEFAULT NULL,
  `error_reason` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `razorpay_payment_details`
--

INSERT INTO `razorpay_payment_details` (`id`, `user_id`, `order_id`, `payment_id`, `amount`, `currency`, `status`, `invoice_id`, `international`, `method`, `amount_refunded`, `refund_status`, `captured`, `description`, `card_id`, `bank`, `wallet`, `vpa`, `email`, `contact`, `address`, `fee`, `tax`, `error_code`, `error_description`, `error_source`, `error_step`, `error_reason`, `created_at`) VALUES
(197, 20, 'order_OXFTvTrrmwNoQk', 'pay_OXFU3HNUUkn23F', '3550', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'avijit.bpie@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(198, 20, 'order_OXFimjG1q4MCGh', 'pay_OXFj6qAOKREOv6', '8100', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'avijit.bpie@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(199, 20, 'order_OXFr9nyh7vq7Wh', 'pay_OXFrafiNtj6sxo', '6908', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'avijit.bpie@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(200, 20, 'order_OXG1pgPzR3TVvo', 'pay_OXG1yELORRidMS', '10000', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'avijit.bpie@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(201, 20, 'order_OXHNkoCN8liAG0', 'pay_OXHNvcmW0dMdjZ', '10000', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'UTIB', NULL, NULL, 'bapi@gmail.com', '+918961217535', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(202, 20, 'order_OXHT6YQ9jYeit8', 'pay_OXHTMSAcGgi1PO', '10000', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'dev@gmail.com', '+919856325695', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(203, 20, 'order_OXHqFxOQq98OPt', 'pay_OXHqNrZOn8nPY3', '10000', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(204, 20, 'order_OXHqFxOQq98OPt', 'pay_OXHqNrZOn8nPY3', '10000', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(205, 20, 'order_OXHqFxOQq98OPt', 'pay_OXHqNrZOn8nPY3', '10000', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(206, 20, 'order_OXHqFxOQq98OPt', 'pay_OXHqNrZOn8nPY3', '10000', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(207, 20, 'order_OXHub9JTtdtaSd', 'pay_OXHuhwur0kS3nx', '10000', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(208, 20, 'order_OXHub9JTtdtaSd', 'pay_OXHuhwur0kS3nx', '10000', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(209, 20, 'order_OXHub9JTtdtaSd', 'pay_OXHuhwur0kS3nx', '10000', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(210, 20, 'order_OXI0Jkuj7okund', 'pay_OXI0UAidFB4ShF', '10000', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(211, 20, 'order_OXJdlQU6cGj9rx', 'pay_OXJdslZUqt8CvM', '1775', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918956325698', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(212, 20, 'order_OXJf9LbXPmD73L', 'pay_OXJfGtpQqqi96r', '3325', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'sumanat@gmail.com', '+918956325698', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(213, 20, 'order_OXKLETIWfkjMcd', 'pay_OXKLUyFkg4tKNj', '3400', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(214, 20, 'order_OXKMPYbIsoNW6W', 'pay_OXKMY8qllDHdM5', '1775', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'bapi@gmail.com', '+918956325698', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(215, 20, 'order_OXKPR3af3wdhI0', 'pay_OXKPYj43nHrtZM', '1775', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'dev@gmail.com', '+919007081926', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(216, 20, 'order_OXKPR3af3wdhI0', 'pay_OXKPYj43nHrtZM', '1775', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'dev@gmail.com', '+919007081926', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(217, 20, 'order_OXKYZye2KFAXww', 'pay_OXKYhrdJjR6xy6', '1775', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'bapi@gmail.com', '+919007081926', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(218, 20, 'order_OXKYZye2KFAXww', 'pay_OXKYhrdJjR6xy6', '1775', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'bapi@gmail.com', '+919007081926', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(219, 20, 'order_OXKdHDNPCG1z65', 'pay_OXKdPTThZzABCE', '1775', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'sumanat@gmail.com', '+919856325695', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(220, 20, 'order_OXKdHDNPCG1z65', 'pay_OXKdPTThZzABCE', '1775', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'sumanat@gmail.com', '+919856325695', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(221, 20, 'order_OXKetjSj5NlIdN', 'pay_OXKf1adfeB68Z7', '1100', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(222, 20, 'order_OXKsABJEcIGfTv', 'pay_OXKsI7FlZ669ax', '4925', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+919856325695', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(223, 20, 'order_OXKsABJEcIGfTv', 'pay_OXKsI7FlZ669ax', '4925', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+919856325695', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(224, 20, 'order_OXbiEpx8eJxg8A', 'pay_OXbiPnoZvuTEOX', '4075', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'dev@gmail.com', '+5698563256', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(225, 20, 'order_OXdNHdg6ZWFlme', 'pay_OXdNOTPcAlrRkt', '8150', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'sumanat@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(226, 20, 'order_OXdRKzt2O14Zrc', 'pay_OXdRSKzp5HwDEI', '4075', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'bapi@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(227, 20, 'order_OXdgMbtc5a6hHg', 'pay_OXdgTgTrGGyXby', '8150', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'dev@gmail.com', '+919007081926', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(228, 20, 'order_OXdibP0xI1FWb1', 'pay_OXdik71QYpmuDJ', '8150', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(229, 20, 'order_OXfqJjnxEIaECE', 'pay_OXfqRWl3BvhHss', '10000', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(230, 20, 'order_OXgYIzfKuZcL4p', 'pay_OXgYaH2EKeAZdu', '8625', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'sumanat@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(231, 20, 'order_OXhFLTJhW5Q7BT', 'pay_OXhFSXUNFnElcq', '3550', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'dev@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(232, 20, 'order_OYrEUwNg6D0Wzb', 'pay_OYrEkjmw3d4Ue9', '10000', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(233, 20, 'order_OYuANbFFXWnjl1', 'pay_OYuAUkRdRbqLHa', '10000', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(234, 20, 'order_OYuCUWieckbSjD', 'pay_OYuCbaTdBQfeYj', '5750', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(235, 20, 'order_OYuvpSbs1j6ag3', 'pay_OYuvw0JW1YHyTB', '2875', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'bapi@gmail.com', '+918956325698', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(236, 20, 'order_OZJhvdsaXPMDbV', 'pay_OZJi2sWuOcgs1a', '1950', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(237, NULL, 'order_OZbdAR6blAOVsk', 'pay_OZbdIP1qwvzEeb', '1775', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'dev@gmail.com', '+918961217535', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(238, NULL, 'order_OZc3VmNb4LeWpA', 'pay_OZc3dw1gu76mxK', '5000', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(239, NULL, 'order_OZfqCdsP3u0zZh', 'pay_OZfqKqvN0ep4Mk', '3800', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'bapi@gmail.com', '+919856325695', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(240, NULL, 'order_OZz5i7kV90zmxP', 'pay_OZz5pqdB00FNrH', '6800', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(241, NULL, 'order_OZzQeukhIt5khD', 'pay_OZzQpWvyusSIXL', '1100', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'bapi@gmail.com', '+919007081926', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(242, NULL, 'order_OZzT1lgxTj2zHp', 'pay_OZzTYmrMw9uTog', '3500', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'bapi@gmail.com', '+5698563256', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(243, NULL, 'order_OZzT1lgxTj2zHp', 'pay_OZzTYmrMw9uTog', '3500', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'bapi@gmail.com', '+5698563256', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(244, NULL, 'order_OZzT1lgxTj2zHp', 'pay_OZzTYmrMw9uTog', '3500', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'bapi@gmail.com', '+5698563256', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(245, NULL, 'order_OZzXI58TOwnk8O', 'pay_OZzXZa6QG430Fe', '1775', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'dev@gmail.com', '+919856325695', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(246, NULL, 'order_OZzXI58TOwnk8O', 'pay_OZzXZa6QG430Fe', '1775', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'dev@gmail.com', '+919856325695', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(247, NULL, 'order_OZzXI58TOwnk8O', 'pay_OZzXZa6QG430Fe', '1775', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'dev@gmail.com', '+919856325695', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(248, NULL, 'order_OZzaPB4i1c223K', 'pay_OZzaXDUZUEAXh9', '1750', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(249, NULL, 'order_Oa1RHaOprMnRvN', 'pay_Oa1RPYX1tuK25F', '8500', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(250, NULL, 'order_Oa1ceuJHRBvpPf', 'pay_Oa1cnb3tmCLExs', '3800', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'sumanat@gmail.com', '+918961217535', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(251, NULL, 'order_Oa1ceuJHRBvpPf', 'pay_Oa1cnb3tmCLExs', '3800', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'sumanat@gmail.com', '+918961217535', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(252, NULL, 'order_Oa2yVFZ0TURmXx', 'pay_Oa2yeO2AYVrlB6', '3800', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(253, NULL, 'order_Oa2yVFZ0TURmXx', 'pay_Oa2yeO2AYVrlB6', '3800', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(254, NULL, 'order_Oa32sJuYAAMrud', 'pay_Oa3309T7wBjafK', '1750', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'bapi@gmail.com', '+5698563256', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(255, NULL, 'order_Oa32sJuYAAMrud', 'pay_Oa3309T7wBjafK', '1750', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'bapi@gmail.com', '+5698563256', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(256, NULL, 'order_Oa3DzLcsFl6rqg', 'pay_Oa3EEthnB5PC2G', '10000', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(257, NULL, 'order_Oa3blUIFA5OocG', 'pay_Oa3bsPRo11QNpI', '1750', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(258, NULL, 'order_Oa5pBNavtyePTz', 'pay_Oa5pJEfePCAYU9', '4050', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'bapi@gmail.com', '+919007081926', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(259, NULL, 'order_Oa5rJgI6ofhqxL', 'pay_Oa5rR0p8DbuwCV', '4050', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(260, NULL, 'order_Oa5rJgI6ofhqxL', 'pay_Oa5rR0p8DbuwCV', '4050', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(261, NULL, 'order_Oa6MjXbCFhN3Sd', 'pay_Oa6Mr9t7YSWh3u', '4050', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(262, NULL, 'order_Oa7Cz5ewU87PIV', 'pay_Oa7D9Ar0IkhjcA', '1100', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'joydev@xgenmedia.com', '+918956325698', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(263, NULL, 'order_Obg9rDos0NdEiT', 'pay_ObgA1ICJNdMHNr', '2875', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'sumanat@gmail.com', '+919856325695', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(264, NULL, 'order_ObgitR79vBoHaB', 'pay_Obgj0xaXHcolf3', '2875', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'bapi@gmail.com', '+918961217535', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(265, NULL, 'order_ObgitR79vBoHaB', 'pay_Obgj0xaXHcolf3', '2875', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'bapi@gmail.com', '+918961217535', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(266, NULL, 'order_ObgkqFku90FSFn', 'pay_Obgkx3kZmn8hZm', '2875', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'bapi@gmail.com', '+918961217535', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(267, NULL, 'order_ObgockcyLEEYa9', 'pay_ObgojKkJfuhXsm', '3600', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'test@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(268, NULL, 'order_ObgqjChVbIWEyT', 'pay_ObgqpkrvFS0Hp8', '2875', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'bubay8001@gmail.com', '+918825207634', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00'),
(269, NULL, 'order_ObygAWUSbA9StA', 'pay_ObygI9uTtsdmq4', '2875', 'INR', 'captured', NULL, NULL, 'netbanking', NULL, NULL, '1', 'Test Transaction', NULL, 'SBIN', NULL, NULL, 'sumanat@gmail.com', '+919007081926', 'Razorpay Corporate Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=default,1=inactive',
  `delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=default,1=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `status`, `delete`) VALUES
(1, 'admin', 'web', '2023-09-29 00:17:54', '2023-09-29 00:17:54', 0, 0),
(4, 'Developer', 'web', '2023-09-29 05:29:59', '2023-09-29 05:29:59', 0, 0),
(5, 'Manager', 'web', '2023-09-29 05:39:38', '2023-09-29 05:39:38', 0, 0),
(6, 'Hr', 'web', '2023-09-29 05:45:08', '2023-09-29 05:45:08', 0, 0),
(7, 'Client', 'web', '2023-09-29 05:52:37', '2023-09-29 05:52:37', 0, 0),
(8, 'Customer', 'web', '2023-10-05 04:43:04', '2023-10-05 04:43:04', 0, 0),
(10, 'Sales Eecutive', 'web', '2024-06-13 01:47:01', '2024-06-13 01:47:01', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 4),
(1, 5),
(1, 7),
(1, 8),
(2, 1),
(2, 5),
(2, 7),
(3, 1),
(3, 5),
(3, 7),
(4, 1),
(4, 5),
(4, 7),
(9, 1),
(9, 7),
(10, 1),
(10, 7),
(11, 1),
(11, 7),
(12, 1),
(12, 7),
(13, 1),
(14, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(60, 7),
(61, 7),
(62, 7),
(63, 7),
(64, 7),
(65, 7),
(66, 7),
(67, 7),
(68, 7),
(69, 7),
(70, 7),
(71, 7),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(96, 10),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ship_classes`
--

CREATE TABLE `ship_classes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` enum('Y','N','D') NOT NULL DEFAULT 'Y',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ship_classes`
--

INSERT INTO `ship_classes` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Premium', 'Y', '2024-06-13 11:15:52', '2024-06-13 11:15:52'),
(2, 'Deluxe', 'Y', '2024-06-13 11:15:52', '2024-06-13 11:15:52'),
(3, 'Luxury', 'Y', '2024-06-13 11:16:44', '2024-06-13 11:16:44'),
(4, 'Royal', 'Y', '2024-06-13 11:16:44', '2024-06-13 11:16:44');

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

-- --------------------------------------------------------

--
-- Table structure for table `ship_master`
--

CREATE TABLE `ship_master` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `status` enum('Y','N','D') NOT NULL DEFAULT 'Y',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ship_master`
--

INSERT INTO `ship_master` (`id`, `title`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Makruzz', 'uploads/ship/makruzz.jpeg', 'Y', '2024-06-13 11:14:30', '2024-06-13 11:14:30'),
(2, 'Nautika', 'uploads/ship/nautika.jpeg', 'Y', '2024-06-13 11:14:30', '2024-06-13 11:14:30'),
(3, 'Green Ocean', 'uploads/ship/greenocean.jpeg', 'Y', '2024-06-13 11:14:59', '2024-06-13 11:14:59');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text DEFAULT NULL,
  `subtitle` longtext DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `path` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=default,1=inactive',
  `delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=default,1=deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `title`, `subtitle`, `designation`, `path`, `size`, `status`, `delete`, `created_at`, `updated_at`) VALUES
(6, 'Elsa Weimann', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Animi laudantium reiciendis eos tempora cum expedita qui dolore, quo ipsam repudiandae optio accusamus distinctio sit voluptatibus perspiciatis omnis. Excepturi, possimus ipsa!', 'Central Accounts Strategist', 'uploads/testimonial/667170f0d6c41_profile-demo.png', '36321', 0, 0, '2024-06-18 06:05:18', '2024-06-18 06:05:18'),
(7, 'Test creator', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Youtube Creator', 'uploads/testimonial/6698f130dca65_profile-pic-demo.png', '122268', 0, 0, '2024-07-18 05:10:52', '2024-07-18 05:10:52');

-- --------------------------------------------------------

--
-- Table structure for table `type_prices`
--

CREATE TABLE `type_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` int(11) NOT NULL COMMENT 'package table id',
  `type_id` int(11) NOT NULL COMMENT 'packagetype table id',
  `subtitle` longtext DEFAULT NULL,
  `cp_plan` decimal(9,2) NOT NULL,
  `map_with_dinner` decimal(9,2) NOT NULL,
  `actual_price` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_prices`
--

INSERT INTO `type_prices` (`id`, `package_id`, `type_id`, `subtitle`, `cp_plan`, `map_with_dinner`, `actual_price`) VALUES
(1, 8, 1, 'rtyrtyrty', 566666.00, 25.00, 1444.00),
(2, 8, 2, 'asdasdsadasdas', 4200.00, 5670.60, 2248.00),
(3, 8, 3, 'dfhdfh', 44444.12, 3453453.99, 6785656.20),
(4, 9, 2, 'dfgdfgdfg', 566666.00, 2465.00, 34444.00),
(5, 19, 1, 'test', 500.00, 500.00, 10000.00),
(6, 20, 1, 'test', 500.00, 500.00, 25000.00),
(7, 20, 2, 'test', 120.00, 700.00, 12000.00),
(8, 26, 2, 'asdsad', 500.00, 1200.00, 5000.00),
(9, 32, 1, 'economy subtile', 500.00, 500.00, 25000.00);

-- --------------------------------------------------------

--
-- Table structure for table `type_price_images`
--

CREATE TABLE `type_price_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL COMMENT 'itinerary table id',
  `path` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_price_images`
--

INSERT INTO `type_price_images` (`id`, `parent_id`, `path`, `size`) VALUES
(1, 1, 'uploads/package/typeprice/659fb72784494_andaman-nicobar.jpg', '123075'),
(2, 1, 'uploads/package/typeprice/659fb72784594_be7.jpg', '60065'),
(3, 1, 'uploads/package/typeprice/659fb83f4edbf_5fc7810b91e9f.jpg', '195994'),
(4, 2, 'uploads/package/typeprice/659fb84da019e_andaman-nicobar.jpg', '123075'),
(5, 2, 'uploads/package/typeprice/659fb84da2efb_cop4 (2).jpg', '25354'),
(6, 3, 'uploads/package/typeprice/659fc14a1f425_desti2.jpg', '24815'),
(7, 3, 'uploads/package/typeprice/659fc14a1f50b_desti3.jpg', '31035'),
(8, 3, 'uploads/package/typeprice/659fc14aba1d4_desti4.jpg', '32349'),
(9, 3, 'uploads/package/typeprice/659fc14abd8c5_download (1).jpg', '8510'),
(10, 3, 'uploads/package/typeprice/659fc14b50b20_download (2).jpg', '8556'),
(11, 3, 'uploads/package/typeprice/659fc14b55854_download (3).jpg', '8633'),
(12, 4, 'uploads/package/typeprice/659fc464892ca_desti4.jpg', '32349'),
(13, 4, 'uploads/package/typeprice/659fc4648dbd7_download (1).jpg', '8510'),
(14, 5, 'uploads/package/typeprice/6618c05190731_image1.jpeg', '10132'),
(15, 6, 'uploads/package/typeprice/6619042199964_image1.jpeg', '10132'),
(16, 7, 'uploads/package/typeprice/66190440e9a5c_20220305025804_andaman_banner_ahr.jpeg', '424648'),
(17, 8, 'uploads/package/typeprice/662656f0e008c_image1.jpeg', '10132'),
(18, 9, 'uploads/package/typeprice/6627546b8a75e_image1.jpeg', '10132');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=default,1=inactive',
  `delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=default,1=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`, `delete`) VALUES
(1, 'Admin User', 'admin@gmail.com', NULL, '$2y$10$NSVPawGFaOszNcVqHPyiIONb6h70UzQ7z8oCPpDQ.2M7/GlU01lIq', NULL, '2023-09-29 00:17:54', '2024-06-18 01:25:52', 0, 0),
(6, 'sourav', 'sourav@xgenmedia.com', NULL, '$2y$10$ZAORQUIp.0UmjbM3oMIdKOmIeplWL9jl8a.B4V112Qlko6PTtkKSe', NULL, '2023-09-29 04:41:03', '2023-09-29 04:41:03', 0, 0),
(7, 'sayan', 'sayan@xgenmedia.com', NULL, '$2y$10$9hZhVOkab1geHyyjkRlSMOA6Grb.Yh6Ij7AM/Rxt4vLHjlh.bPx9e', NULL, '2023-09-29 04:43:31', '2023-09-29 04:43:31', 0, 0),
(8, 'mayank', 'mayank@xgenmedia.com', NULL, '$2y$10$Ak8e8KZzGYpt.4PJE5yYy./K10bHwmHDiHRv0t34NEBf2JzkIcsHe', NULL, '2023-09-29 04:44:23', '2023-09-29 04:44:23', 0, 0),
(9, 'akash', 'akash@xgenmedia.com', NULL, '$2y$10$4AxSy.egkQt6murL/EQib.tilvwqAGofbQE2WNScJoxmUP8vibxj6', NULL, '2023-09-29 04:44:46', '2023-09-29 04:44:46', 0, 0),
(10, 'sudip', 'sudip@xgenmedia.com', NULL, '$2y$10$iMTRwIdRWQaN9YZrdBvOmeq8lR6nZCJb6UxR2JkZWL9fq0c.jSTvu', NULL, '2023-09-29 04:45:13', '2023-09-29 04:45:13', 0, 0),
(11, 'Anup Sharma', 'anup@xgenmedia.com', NULL, '$2y$10$nP1M3XU4bvuB4CXiVAuJEOzQBlSYLQhMop6YeakO9gD9qxp30EcXm', NULL, '2023-10-02 23:35:58', '2023-10-02 23:35:58', 0, 0),
(17, 'sayan', 'sumanta33453@xgenmedia.com', NULL, '$2y$10$ozZKLGLJ3R2RID4Fgtm2k.HdmhURbExqVg63vBgEmLJqTln4ySOi2', NULL, '2023-11-09 09:10:47', '2024-01-12 01:07:42', 0, 0),
(20, 'Narayan Sahu', 'sahunarayan802@gmail.com', NULL, '$2y$10$WgRqrQIsTPbLKHka8PncxO.zE3XfI5gp8.kak5fLDxw4THHP/QQXu', NULL, '2024-06-13 01:49:21', '2024-06-13 01:49:21', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_permission`
--

CREATE TABLE `user_has_permission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_has_permission`
--

INSERT INTO `user_has_permission` (`id`, `user_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(5, 18, 5, NULL, NULL),
(6, 18, 8, NULL, NULL),
(492, 17, 1, NULL, NULL),
(493, 17, 2, NULL, NULL),
(494, 17, 62, NULL, NULL),
(495, 17, 66, NULL, NULL),
(496, 17, 67, NULL, NULL),
(497, 17, 68, NULL, NULL),
(498, 17, 69, NULL, NULL),
(499, 17, 70, NULL, NULL),
(500, 17, 71, NULL, NULL),
(1285, 20, 96, NULL, NULL),
(2214, 1, 1, NULL, NULL),
(2215, 1, 2, NULL, NULL),
(2216, 1, 3, NULL, NULL),
(2217, 1, 4, NULL, NULL),
(2218, 1, 9, NULL, NULL),
(2219, 1, 10, NULL, NULL),
(2220, 1, 11, NULL, NULL),
(2221, 1, 12, NULL, NULL),
(2222, 1, 13, NULL, NULL),
(2223, 1, 14, NULL, NULL),
(2224, 1, 32, NULL, NULL),
(2225, 1, 33, NULL, NULL),
(2226, 1, 34, NULL, NULL),
(2227, 1, 35, NULL, NULL),
(2228, 1, 36, NULL, NULL),
(2229, 1, 37, NULL, NULL),
(2230, 1, 38, NULL, NULL),
(2231, 1, 39, NULL, NULL),
(2232, 1, 40, NULL, NULL),
(2233, 1, 41, NULL, NULL),
(2234, 1, 42, NULL, NULL),
(2235, 1, 43, NULL, NULL),
(2236, 1, 48, NULL, NULL),
(2237, 1, 49, NULL, NULL),
(2238, 1, 50, NULL, NULL),
(2239, 1, 51, NULL, NULL),
(2240, 1, 72, NULL, NULL),
(2241, 1, 73, NULL, NULL),
(2242, 1, 74, NULL, NULL),
(2243, 1, 75, NULL, NULL),
(2244, 1, 80, NULL, NULL),
(2245, 1, 81, NULL, NULL),
(2246, 1, 82, NULL, NULL),
(2247, 1, 83, NULL, NULL),
(2248, 1, 104, NULL, NULL),
(2249, 1, 105, NULL, NULL),
(2250, 1, 106, NULL, NULL),
(2251, 1, 107, NULL, NULL),
(2252, 1, 112, NULL, NULL),
(2253, 1, 113, NULL, NULL),
(2254, 1, 114, NULL, NULL),
(2255, 1, 115, NULL, NULL),
(2256, 1, 116, NULL, NULL),
(2257, 1, 117, NULL, NULL),
(2258, 1, 118, NULL, NULL),
(2259, 1, 119, NULL, NULL),
(2260, 1, 125, NULL, NULL),
(2261, 1, 126, NULL, NULL),
(2262, 1, 127, NULL, NULL),
(2263, 1, 128, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `web_users`
--

CREATE TABLE `web_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) NOT NULL,
  `otp` int(11) NOT NULL,
  `verified_otp` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=default,1=inactive',
  `delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=default,1=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_users`
--

INSERT INTO `web_users` (`id`, `name`, `phone_no`, `otp`, `verified_otp`, `created_at`, `updated_at`, `status`, `delete`) VALUES
(1, NULL, '9632147850', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(2, NULL, '9632104580', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(3, NULL, '6541239870', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(4, NULL, '7894561230', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(5, NULL, '9874563210', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(6, NULL, '9632145698', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(7, NULL, '9875632014', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(8, NULL, '123456', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(9, NULL, '9632587410', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(10, NULL, '9856325896', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(11, NULL, '9861608141', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(12, NULL, '9632147852', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(13, NULL, '8956236985', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(14, NULL, '9874563201', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(15, NULL, '1234564561', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(16, NULL, '963214569', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(17, NULL, '9636214578', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(18, NULL, '12345679890', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(19, NULL, '98745632105', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(20, NULL, '8825207634', 1234, NULL, '2024-07-05 13:50:44', '2024-07-05 02:07:23', 0, 0),
(21, NULL, '141', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(22, NULL, '8956325693', 123456, NULL, '2024-07-05 13:07:23', '2024-07-05 02:07:23', 0, 0),
(23, NULL, '9007081926', 1234, NULL, '2024-07-08 19:26:02', NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_images`
--
ALTER TABLE `banner_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boat_schedule`
--
ALTER TABLE `boat_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boat_schedule_price`
--
ALTER TABLE `boat_schedule_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_passenger_details`
--
ALTER TABLE `booking_passenger_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_traveller_details`
--
ALTER TABLE `booking_traveller_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancel_request_passerger`
--
ALTER TABLE `cancel_request_passerger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_category`
--
ALTER TABLE `faq_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ferry_locations`
--
ALTER TABLE `ferry_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ferry_schedule`
--
ALTER TABLE `ferry_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ferry_schedule_price`
--
ALTER TABLE `ferry_schedule_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `package_booking_details`
--
ALTER TABLE `package_booking_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pnr_status`
--
ALTER TABLE `pnr_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `policys`
--
ALTER TABLE `policys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `razorpay_payment_details`
--
ALTER TABLE `razorpay_payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `ship_classes`
--
ALTER TABLE `ship_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ship_images`
--
ALTER TABLE `ship_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ship_master`
--
ALTER TABLE `ship_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_prices`
--
ALTER TABLE `type_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_price_images`
--
ALTER TABLE `type_price_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_has_permission`
--
ALTER TABLE `user_has_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_users`
--
ALTER TABLE `web_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `banner_images`
--
ALTER TABLE `banner_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `boat_schedule`
--
ALTER TABLE `boat_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `boat_schedule_price`
--
ALTER TABLE `boat_schedule_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=363;

--
-- AUTO_INCREMENT for table `booking_passenger_details`
--
ALTER TABLE `booking_passenger_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;

--
-- AUTO_INCREMENT for table `booking_traveller_details`
--
ALTER TABLE `booking_traveller_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cancel_request_passerger`
--
ALTER TABLE `cancel_request_passerger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `faq_category`
--
ALTER TABLE `faq_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ferry_locations`
--
ALTER TABLE `ferry_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ferry_schedule`
--
ALTER TABLE `ferry_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ferry_schedule_price`
--
ALTER TABLE `ferry_schedule_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `package_booking_details`
--
ALTER TABLE `package_booking_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pnr_status`
--
ALTER TABLE `pnr_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `policys`
--
ALTER TABLE `policys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `razorpay_payment_details`
--
ALTER TABLE `razorpay_payment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ship_classes`
--
ALTER TABLE `ship_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ship_images`
--
ALTER TABLE `ship_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ship_master`
--
ALTER TABLE `ship_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `type_prices`
--
ALTER TABLE `type_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `type_price_images`
--
ALTER TABLE `type_price_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_has_permission`
--
ALTER TABLE `user_has_permission`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2264;

--
-- AUTO_INCREMENT for table `web_users`
--
ALTER TABLE `web_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
