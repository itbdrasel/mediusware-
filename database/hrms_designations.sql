-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2022 at 10:48 AM
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
-- Database: `erp_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `hrms_designations`
--

CREATE TABLE `hrms_designations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrms_designations`
--

INSERT INTO `hrms_designations` (`id`, `name`, `order_by`, `created_at`, `updated_at`) VALUES
(1, 'Content Writer', 6, '2022-04-09 01:04:25', '2022-04-09 02:13:37'),
(2, 'Web Developer', 5, '2022-04-09 01:04:50', '2022-04-09 02:13:27'),
(3, 'Digital Marketer', 8, '2022-04-09 01:05:33', '2022-04-09 02:13:53'),
(4, 'IT Officer', 7, '2022-04-09 01:06:05', '2022-04-09 02:13:47'),
(5, 'Chairman', 1, '2022-04-09 01:06:26', '2022-04-09 02:11:19'),
(6, 'Managing Director', 2, '2022-04-09 01:06:41', '2022-04-09 02:11:30'),
(7, 'Server Administrator', 4, '2022-04-09 01:06:55', '2022-04-09 02:13:15'),
(8, 'Project Manager', 3, '2022-04-09 01:07:40', '2022-04-09 02:13:00'),
(9, 'Driver', 9, '2022-05-09 04:53:39', '2022-05-09 04:53:39'),
(10, 'Housemaid', 10, '2022-05-09 04:53:49', '2022-05-09 04:53:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hrms_designations`
--
ALTER TABLE `hrms_designations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hrms_designations`
--
ALTER TABLE `hrms_designations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
