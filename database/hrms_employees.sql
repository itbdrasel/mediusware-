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
-- Table structure for table `hrms_employees`
--

CREATE TABLE `hrms_employees` (
  `employee_id` int(11) NOT NULL,
  `employee_id_no` varchar(255) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `employee_designation` int(11) NOT NULL,
  `employee_father_name` varchar(55) DEFAULT NULL,
  `employee_mother_name` varchar(55) DEFAULT NULL,
  `employee_birth_date` date DEFAULT NULL,
  `employee_join_date` date NOT NULL,
  `employee_release_date` date DEFAULT NULL,
  `employee_sex` varchar(55) NOT NULL,
  `employee_religion` int(11) NOT NULL,
  `employee_marital_state` tinyint(2) NOT NULL,
  `employee_mobile` varchar(55) NOT NULL,
  `employee_email` varchar(55) DEFAULT NULL,
  `employee_nid` varchar(55) DEFAULT NULL,
  `employee_tin` varchar(255) DEFAULT NULL,
  `employee_department` int(11) DEFAULT NULL,
  `employee_basic_salary` varchar(55) DEFAULT NULL,
  `employee_total_salary` varchar(55) DEFAULT NULL,
  `employee_present_address` text NOT NULL,
  `employee_permanent_address` text DEFAULT NULL,
  `employee_language` longtext DEFAULT NULL,
  `employee_education` longtext DEFAULT NULL,
  `employee_seniority` varchar(55) DEFAULT NULL,
  `blood_group` varchar(21) DEFAULT NULL,
  `identification_mark` varchar(55) DEFAULT NULL,
  `employee_height` varchar(55) DEFAULT NULL,
  `employee_picture` varchar(255) DEFAULT NULL,
  `increment_status` tinyint(2) NOT NULL DEFAULT 1,
  `employee_document` varchar(255) DEFAULT NULL,
  `salary_status` tinyint(2) DEFAULT NULL COMMENT '1 = Basic Salary, 2 = Total Salary',
  `employee_is_attendance` tinyint(2) NOT NULL DEFAULT 1,
  `employee_status` tinyint(2) DEFAULT NULL COMMENT '1= All, 2= Only Bank Sheet, 3= Only Salary Sheet',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hrms_employees`
--

INSERT INTO `hrms_employees` (`employee_id`, `employee_id_no`, `employee_name`, `employee_designation`, `employee_father_name`, `employee_mother_name`, `employee_birth_date`, `employee_join_date`, `employee_release_date`, `employee_sex`, `employee_religion`, `employee_marital_state`, `employee_mobile`, `employee_email`, `employee_nid`, `employee_tin`, `employee_department`, `employee_basic_salary`, `employee_total_salary`, `employee_present_address`, `employee_permanent_address`, `employee_language`, `employee_education`, `employee_seniority`, `blood_group`, `identification_mark`, `employee_height`, `employee_picture`, `increment_status`, `employee_document`, `salary_status`, `employee_is_attendance`, `employee_status`, `created_at`, `updated_at`) VALUES
(1, 'TOS081603', 'SHEHAB AHMED SABUJ', 6, NULL, NULL, NULL, '2016-04-01', NULL, 'Male', 1, 1, '01977771867', 'shehab@tos.com.bd', '7767341352', NULL, 4, '35000', '70000', 'Santinagar', 'Santinagar', '[]', '[]', '1', 'A+', NULL, NULL, NULL, 1, NULL, NULL, 2, 2, NULL, '2022-05-09 04:28:27'),
(2, 'TOS081604', 'MAINUL ISLAM', 5, NULL, NULL, NULL, '2016-04-02', NULL, 'Male', 1, 2, '01879133555', 'mainul@tos.com.bd', '1941811497', NULL, 1, '35000', '70000', 'Baitul Aman Housing', NULL, '[]', '[]', '1', 'A+', NULL, NULL, NULL, 1, NULL, NULL, 2, 2, NULL, '2022-05-09 04:28:14'),
(3, 'TOS081605', 'MST. SHARMIN HAQUE', 8, NULL, NULL, NULL, '2020-05-02', NULL, 'Female', 1, 2, '01626175253', 'sharmin@tos.com.bd', '155348256', NULL, NULL, '25000', '50000', 'Mugda', NULL, '[]', '[]', '1', 'B+', NULL, NULL, NULL, 1, NULL, NULL, 2, 2, NULL, '2022-05-09 04:28:02'),
(4, 'TOS081606', 'MD.HABIBUR RAHMAN', 4, NULL, NULL, NULL, '2016-08-01', NULL, 'Male', 1, 2, '01626177879', 'habib@tos.com.bd', '19958819458000048', NULL, NULL, '10000', '21000', 'Johuri Moholla', NULL, '[]', '[]', '1', 'B+', NULL, NULL, NULL, 1, NULL, NULL, 1, 1, NULL, '2022-04-28 00:25:34'),
(5, 'TOS081607', 'SHAHRIAR ISLAM', 3, NULL, NULL, NULL, '2017-04-01', NULL, 'Male', 1, 2, '01676404201', 'dipto@tos.com.bd', '19958819458000055', NULL, NULL, '9000', '18000', 'Mirpur', NULL, '[]', '[]', '1', 'B+', NULL, NULL, NULL, 1, NULL, NULL, 1, 1, NULL, '2022-05-09 05:16:24'),
(6, 'TOS081608', 'ATIQ MD. REZAUL HOQUE TURJO', 2, NULL, NULL, NULL, '2020-01-01', NULL, 'Male', 1, 1, '01977771866', 'turjo@tos.com.bd', '7767341353', NULL, 1, '35000', '70000', 'Motijheel', NULL, '[]', '[]', '1', 'O+', NULL, NULL, NULL, 1, NULL, NULL, 2, 2, NULL, '2022-05-16 02:29:14'),
(7, 'TOS081609', 'MD. RASEL', 2, NULL, NULL, '1994-04-04', '2020-01-01', NULL, 'Male', 1, 2, '01911054866', 'rasel@tos.com.bd', '19958819458000034', NULL, 1, '24000', '35000', 'PC Culture Housing', NULL, '[{\"lang_name\":\"English\",\"readLang\":\"Y\",\"writeLang\":\"\",\"speakLang\":\"\"},{\"lang_name\":\"Bengali\\/Bangla\",\"readLang\":\"Y\",\"writeLang\":\"Y\",\"speakLang\":\"Y\"}]', '[{\"ins_name\":\"SSC\",\"subject\":\"\",\"degree\":\"\",\"passing_year\":\"\",\"result\":\"\"}]', '1', 'AB+', NULL, NULL, 'uploads/hrms/7/profile/soUYuQ950Mbfg8Gsm5hWfIFtR475gWqxwQOOo2bg.jpg', 1, 'uploads/hrms/7/document/dMu5bqfdUBY7CVHS9t7nu7Mii6jS8d5eFhZQ0Uyf.pdf', NULL, 1, 1, NULL, '2022-05-18 02:17:28'),
(8, 'TOS081610', 'PIJUSH BHOWMIK', 1, NULL, NULL, NULL, '2021-03-01', NULL, 'Male', 2, 1, '01356787920', 'pijush@tos.com.bd', '7767341354', NULL, NULL, '24000', '30000', 'Shekhertek', NULL, '[]', '[]', '1', NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 1, NULL, '2022-05-09 04:52:37'),
(9, 'TOS081612', 'FARIHA ISLAM', 1, NULL, NULL, NULL, '2020-01-02', NULL, 'Female', 1, 1, '01755887040', 'fariha@tos.com.bd', '1941811406', NULL, NULL, '24000', '35000', 'Shekhertek', NULL, '[]', '[]', '1', NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, NULL, '2022-04-27 04:40:02'),
(10, 'TOS081613', 'NUR ALAM', 2, NULL, NULL, NULL, '2021-04-01', NULL, 'Male', 1, 1, '01968457617', 'nur@tos.com.bd', '19958819458000037', NULL, 1, '8000', '8000', 'Jigatola', NULL, '[]', '[]', '1', 'AB+', NULL, NULL, NULL, 1, NULL, NULL, 1, 1, NULL, '2022-05-16 02:29:03'),
(11, 'TOS081614', 'NADIM HAIDER', 3, NULL, NULL, NULL, '2021-04-01', NULL, 'Male', 1, 1, '01670121237', 'nadim@tos.com.bd', '7667341352', NULL, 3, '10000', '15000', 'Mohammadpur', NULL, '[]', '[]', '1', 'A-', NULL, NULL, NULL, 1, NULL, NULL, 1, 1, NULL, '2022-04-27 04:41:14'),
(12, 'TOS081615', 'SABIT HAQUE', 1, NULL, NULL, NULL, '2022-02-01', NULL, 'Male', 1, 1, '01706697966', 'sabit@tos.com.bd', '19948819458000048', NULL, 2, '10000', '20000', 'Shekhertek', NULL, '[]', '[]', '1', 'A+', NULL, NULL, NULL, 1, NULL, NULL, 1, 3, NULL, '2022-05-09 06:06:08'),
(13, 'TOS081616', 'MD. MIZAN', 9, NULL, NULL, NULL, '2021-01-02', NULL, 'Male', 1, 2, '01930570788', 'mizan@tos.com.bd', '19958819458000050', NULL, NULL, '8000', '8000', 'Bosila, Dhaka', 'Bosila, Dhaka', '[]', '[]', '1', 'A+', NULL, NULL, NULL, 1, NULL, NULL, 2, 3, NULL, '2022-05-16 02:14:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hrms_employees`
--
ALTER TABLE `hrms_employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employee_mobile` (`employee_mobile`,`employee_email`,`employee_nid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hrms_employees`
--
ALTER TABLE `hrms_employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
