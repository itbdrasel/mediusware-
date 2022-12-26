-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2022 at 07:10 AM
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
-- Database: `rasel_erp_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `scms_parent`
--

CREATE TABLE `scms_parent` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profession` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_contact` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_profession` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_contact` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_profession` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `scms_parent`
--

INSERT INTO `scms_parent` (`id`, `name`, `phone`, `email`, `address`, `profession`, `password`, `father_name`, `father_contact`, `father_profession`, `mother_name`, `mother_contact`, `mother_profession`, `created_at`, `updated_at`) VALUES
(1, 'Sobahan Molla', '01911054866', '', '', '', NULL, 'Sobahan Molla', '', NULL, 'Shafia', '', NULL, '2022-12-25 07:07:34', '2022-12-26 05:57:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scms_parent`
--
ALTER TABLE `scms_parent`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scms_parent`
--
ALTER TABLE `scms_parent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
