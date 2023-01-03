-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2023 at 06:31 AM
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
-- Table structure for table `scms_subject`
--

CREATE TABLE `scms_subject` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `subject_parent_id` int(11) DEFAULT NULL,
  `religion_id` int(11) DEFAULT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `syllabus_from_year` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `syllabus_to_year` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_marks` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_type` int(11) DEFAULT NULL COMMENT '1== Compulsory Subject, 2==  Elective Subject, 3==  4th Subject , 4==  Optional Subject   ',
  `order_by` int(11) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scms_subject`
--

INSERT INTO `scms_subject` (`id`, `name`, `subject_code`, `class_id`, `group_id`, `subject_parent_id`, `religion_id`, `gender_id`, `teacher_id`, `syllabus_from_year`, `syllabus_to_year`, `full_marks`, `subject_type`, `order_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'English', '101', 1, NULL, NULL, NULL, NULL, 4, NULL, NULL, '100', 1, 1, 1, '2022-12-29 04:39:15', '2022-12-29 04:40:21'),
(2, 'English 2nd', '102', 1, NULL, 1, NULL, NULL, 4, NULL, NULL, '100', 1, 2, 1, '2022-12-29 04:41:30', '2022-12-29 04:41:30'),
(3, 'Mathematics', '103', 1, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, 1, 2, 1, '2022-12-29 04:43:41', '2022-12-29 04:43:41'),
(4, 'General Science', '104', 1, NULL, NULL, NULL, NULL, 4, NULL, NULL, '100', 2, 4, 1, '2022-12-29 04:44:52', '2022-12-29 04:48:02'),
(5, 'Higher Mathematics', '105', 1, NULL, NULL, NULL, NULL, 4, NULL, NULL, '100', 3, 5, 1, '2022-12-29 04:46:34', '2022-12-29 04:46:34'),
(6, 'Home science', '106', 1, 1, NULL, NULL, NULL, 5, NULL, NULL, '100', 3, 6, 1, '2022-12-29 04:47:38', '2022-12-29 04:47:50'),
(7, 'Religion Islam', '107', 1, NULL, NULL, 1, NULL, 4, NULL, NULL, '100', 1, 7, 0, '2022-12-29 04:49:30', '2022-12-29 05:30:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scms_subject`
--
ALTER TABLE `scms_subject`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scms_subject`
--
ALTER TABLE `scms_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
