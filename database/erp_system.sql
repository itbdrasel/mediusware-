-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2022 at 07:08 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
-- Table structure for table `activations`
--

CREATE TABLE `activations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activations`
--

INSERT INTO `activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'sdu2wPd7oH9eEC1Aac5gGQgKksy3k2dv', 1, '2022-06-26 20:43:43', '2022-06-26 14:43:31', '2022-06-26 14:43:31'),
(2, 2, '9oAmrVNayCQDM6xVTYouVJN5yP5Ihtaz', 1, '2022-10-09 16:30:43', '2022-10-09 16:22:04', '2022-10-09 16:22:04'),
(3, 3, 'HvotI5hbRrrIkrPsoyFKCAQlGueSSlsg', 1, '2022-10-18 09:47:31', '2022-10-18 09:47:31', '2022-10-18 09:47:31'),
(4, 4, 'UqgfG2qcr3MNtPNJ7V24YbVszqhlPrvM', 1, '2022-10-18 09:53:11', '2022-10-18 09:53:11', '2022-10-18 09:53:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_departments`
--

CREATE TABLE `hrms_departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `is_teacher` tinyint(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrms_departments`
--

INSERT INTO `hrms_departments` (`id`, `name`, `role_id`, `order_by`, `is_teacher`, `created_at`, `updated_at`) VALUES
(1, 'Web Developer', 2, 1, NULL, '2022-04-09 01:54:55', '2022-10-29 17:28:02'),
(2, 'Content Writer', NULL, 2, NULL, '2022-04-09 01:55:08', '2022-04-09 01:55:08'),
(3, 'Digital Marketing', NULL, 3, NULL, '2022-04-09 01:55:18', '2022-04-09 01:55:18'),
(4, 'Networking', NULL, 4, NULL, '2022-04-09 01:55:35', '2022-10-26 05:52:12'),
(5, 'Teacher', 2, 5, 1, '2022-11-12 05:25:47', '2022-11-12 05:25:47');

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

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employees`
--

CREATE TABLE `hrms_employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `religion_id` int(11) DEFAULT NULL,
  `marital_state` tinyint(2) DEFAULT NULL,
  `mobile` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `nid` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `basic_salary` varchar(55) CHARACTER SET utf8 DEFAULT NULL,
  `total_salary` varchar(55) CHARACTER SET utf8 DEFAULT NULL,
  `present_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seniority` varchar(55) CHARACTER SET utf8 DEFAULT NULL,
  `blood_group_id` int(11) DEFAULT NULL,
  `picture` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `increment_status` tinyint(2) DEFAULT 1,
  `document` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `social_media` longtext CHARACTER SET utf8 DEFAULT NULL,
  `salary_status` tinyint(2) DEFAULT 1 COMMENT '1 = Basic Salary, 2 = Total Salary',
  `is_website` tinyint(2) DEFAULT 1,
  `status` tinyint(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrms_employees`
--

INSERT INTO `hrms_employees` (`id`, `id_number`, `name`, `department_id`, `designation_id`, `father_name`, `mother_name`, `birth_date`, `joining_date`, `release_date`, `gender_id`, `religion_id`, `marital_state`, `mobile`, `email`, `nid`, `tin`, `basic_salary`, `total_salary`, `present_address`, `permanent_address`, `seniority`, `blood_group_id`, `picture`, `increment_status`, `document`, `social_media`, `salary_status`, `is_website`, `status`, `created_at`, `updated_at`) VALUES
(1, '123456', 'Rasel Hossain', 1, NULL, NULL, NULL, '1994-04-04', NULL, NULL, 1, 1, NULL, '01911', 'rasel@gmail.com', NULL, NULL, '40000', '40000', NULL, NULL, NULL, 1, NULL, NULL, NULL, '[]', NULL, NULL, NULL, '2022-11-03 19:47:49', '2022-11-03 19:47:49'),
(2, '123456', 'Rasel Hossain', 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '01911', 'rasel@gmail.com', NULL, NULL, '40000', '40000', NULL, NULL, NULL, 1, NULL, 1, NULL, '[]', 1, 1, NULL, '2022-11-03 19:50:54', '2022-11-03 19:50:54'),
(3, '123456', 'Rasel Hossain', 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '01911', 'rasel@gmail.com', NULL, NULL, '40000', '40000', NULL, NULL, NULL, 1, NULL, 1, NULL, '[]', 1, 1, NULL, '2022-11-03 19:51:31', '2022-11-03 19:51:31'),
(4, '1234568', 'Rasel Hossain', 5, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '01911', 'rasel@gmail.com', NULL, NULL, '40000', '40000', NULL, NULL, NULL, 1, NULL, 1, NULL, '[{\"media_name\":\"facebook\",\"media_link\":null}]', 1, 1, NULL, '2022-11-03 19:56:38', '2022-11-12 05:28:06'),
(5, '1234567', 'Rasel Hossain', 5, 6, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '01911', 'rasel@gmail.com', NULL, NULL, '40000', '40000', NULL, NULL, NULL, 1, NULL, 1, NULL, '[{\"media_name\":\"facebook\",\"media_link\":null}]', 1, 1, NULL, '2022-11-03 19:56:53', '2022-11-12 05:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_09_10_070558_create_jobs_table', 1),
(6, '2022_09_10_070851_create_job_batches_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Admin',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `persistences`
--

CREATE TABLE `persistences` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `persistences`
--

INSERT INTO `persistences` (`id`, `user_id`, `code`, `created_at`, `updated_at`) VALUES
(34, 1, '4Fpw5p78l8PqFAFWjb4P2yT7GGZLPraQ', '2022-10-09 16:26:43', '2022-10-09 16:26:43'),
(35, 1, 'WQTQ8d9mXlhct9eH11qOtcF13EQgmCP2', '2022-10-09 18:31:15', '2022-10-09 18:31:15'),
(36, 1, 'AL31PiL5ulmftW5pGzKccWKyCCrvJ5hS', '2022-10-12 07:33:45', '2022-10-12 07:33:45'),
(37, 1, 'yfeSpPBmLs0OEhGnl25Ho1IN7n330FTY', '2022-10-15 04:47:09', '2022-10-15 04:47:09'),
(38, 1, 'FqZZjTZXurE0zxyCA7bfd8VebMX4Hhvq', '2022-10-16 06:21:30', '2022-10-16 06:21:30'),
(39, 1, 'RoOgfa4ZNBGWQRAvDqrj2zR1vskLJyRj', '2022-10-18 04:37:33', '2022-10-18 04:37:33'),
(40, 1, 'QV7mNFyAzXZeHSL6wtZelobo7KFibfsO', '2022-10-18 09:38:53', '2022-10-18 09:38:53'),
(41, 1, 'AjuTHsV0hCQ74ZcgdsXVJuOZYcxDBsiz', '2022-10-19 05:35:04', '2022-10-19 05:35:04'),
(42, 1, 'TccJ4xqrDuso6ui9SUchEokCLH2fze1C', '2022-10-26 05:40:44', '2022-10-26 05:40:44'),
(43, 1, 'slTvoMfta9pDGOb5noGrqFgCXOdMInnf', '2022-10-26 17:06:04', '2022-10-26 17:06:04'),
(44, 1, 'QSAjypXRrfL0BeiHDuw99OtnSdf5Fgkz', '2022-10-26 19:31:54', '2022-10-26 19:31:54'),
(45, 1, '7chFM3MCqLVLMsWERhVwpzCkHrlkbDXV', '2022-10-28 05:11:16', '2022-10-28 05:11:16'),
(46, 1, 'oDrYKpQZ6ijf9zod51SZXFUNTMIlkiJH', '2022-10-28 10:52:12', '2022-10-28 10:52:12'),
(47, 1, 'PV73IRDJkkGhdgXsrr3SisvnmS6VWWTl', '2022-10-28 16:24:19', '2022-10-28 16:24:19'),
(48, 1, 'w5PahbDLaR4O5Ti9zcoIn7W4daPJw7Wv', '2022-10-29 16:44:15', '2022-10-29 16:44:15'),
(49, 1, 'B05IOCjTftQwm5DPJKEGuJWM6VcwkW2a', '2022-11-03 17:49:10', '2022-11-03 17:49:10'),
(50, 1, 'HZxhXVDazrxEzss7wQaxl90ldgDO2rNa', '2022-11-09 16:07:20', '2022-11-09 16:07:20'),
(51, 1, 'mXJbjlXONi4m8QgJKBVFkjIMLvHBGevo', '2022-11-09 17:44:33', '2022-11-09 17:44:33'),
(52, 1, '0ospuFYBBozkCH6hzX93fIMseEcLoRMm', '2022-11-11 13:21:00', '2022-11-11 13:21:00'),
(53, 1, 'GvHykHqAtXwOoFWakyHnadBW8zeWwGJO', '2022-11-12 05:00:19', '2022-11-12 05:00:19'),
(54, 1, '3vJcXvmkDHTJyaRGeWvrKASMJORa8zIp', '2022-11-12 17:51:34', '2022-11-12 17:51:34'),
(55, 1, 'VcRw3c8Dbob4uuj42ZJ1PLm5vsCLZxie', '2022-11-13 17:00:34', '2022-11-13 17:00:34'),
(56, 1, 'rqo8BWha4zkjBXBVx6N47Py7ZAPZV7EV', '2022-11-14 15:37:53', '2022-11-14 15:37:53');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `active_directory` tinyint(2) DEFAULT NULL,
  `active_branch` tinyint(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `slug`, `name`, `permissions`, `redirect_url`, `order_by`, `active_directory`, `active_branch`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'Administrator', '{\"core.permissions.ajax_user_module\":true,\"core.role.create\":true,\"core.role.store\":true,\"core.role.edit\":true,\"core.user.create\":true,\"core.user.store\":true,\"core.user.edit\":true,\"core.user.update\":true,\"core.user.delete\":true,\"core.user.profile\":true,\"core.branch.create\":true,\"core.branch.store\":true,\"core.branch.edit\":true,\"core.branch.delete\":true,\"core.gender.edit\":true,\"core.gender.store\":true,\"core.gender.delete\":true,\"core.religion.edit\":true,\"core.religion.store\":true,\"core.religion.delete\":true,\"core.module\":true,\"core.module.delete\":true,\"core.module.edit\":true,\"core.module.store\":true,\"core.settings\":true,\"core.settings.store\":true,\"core.settings.logo\":true,\"core.dashboard\":true,\"core.permissions.create\":true,\"core.permissions.store\":true,\"core.permissions.edit\":true,\"core.permissions.update\":true,\"core.permissions.section_edit\":true,\"core.permissions.section_update\":true,\"core.permissions.ajax_add_remove\":true,\"core.permissions.ajax_route_remove\":true,\"core.permissions.ajax_get_sections\":true,\"core.branch\":true,\"core.gender\":true,\"core.permissions\":true,\"core.religion\":true,\"core.role\":true,\"core.user\":true,\"core.permissions.ajax_user_module_permission\":true,\"core.permissions.ajax_user_permission\":true,\"core.blood_group.edit\":true,\"core.blood_group.store\":true,\"core.blood_group.delete\":true,\"core.mediamanager.create\":true,\"core.mediamanager.rename\":true,\"core.mediamanager.delete \":true,\"core.mediamanager.upload\":true,\"core.mediamanager\":true,\"hrms.department.edit\":true,\"hrms.department.store\":true,\"hrms.department.delete\":true,\"hrms.designation.edit\":true,\"hrms.designation.store\":true,\"hrms.designation.delete\":true,\"core.blood_group\":true,\"hrms.dashboard\":true,\"hrms.department\":true,\"hrms.designation\":true,\"core.mediamanager.delete\":true,\"core.user.permission\":true,\"hrms.employee.create\":true,\"hrms.employee.edit\":true,\"hrms.employee.store\":true,\"hrms.employee.show\":true,\"hrms.employee.delete\":true,\"scms.group.edit\":true,\"scms.group.store\":true,\"scms.group.delete\":true,\"scms.shift.edit\":true,\"scms.shift.store\":true,\"scms.shift.delete\":true,\"scms.dashboard\":true,\"scms.group\":true,\"scms.shift\":true,\"scms.class.edit\":true,\"scms.class.store\":true,\"scms.class.delete\":true,\"scms.class\":true,\"hrms.employee\":true,\"scms.student.edit\":true,\"scms.student.store\":true,\"scms.student.delete\":true,\"scms.student\":true,\"scms.section.edit\":true,\"scms.section.store\":true,\"scms.section.delete\":true,\"scms.section\":true}', 'core/dashboard', 1, NULL, NULL, '2021-01-15 05:01:15', '2022-11-14 15:39:00'),
(2, 'admin', 'Admin', '{\"core.branch\":true,\"core.branch.create\":true,\"core.branch.store\":true,\"core.branch.edit\":true,\"core.branch.delete\":true,\"core.dashboard\":true,\"core.permissions.update\":true,\"core.gender.edit\":true,\"core.blood_group.store\":true,\"core.blood_group.delete\":true,\"core.blood_group\":false,\"core.blood_group.edit\":true}', 'core/dashboard', 2, 1, 1, '2022-10-09 06:28:52', '2022-10-28 19:34:08');

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-01-15 06:37:06', '2022-06-12 23:16:20'),
(2, 2, '2022-10-09 06:44:22', '2022-10-09 16:30:43'),
(3, 2, '2022-10-18 09:47:31', '2022-10-18 09:47:31'),
(4, 2, '2022-10-18 09:53:11', '2022-10-18 09:53:11');

-- --------------------------------------------------------

--
-- Table structure for table `scms_class`
--

CREATE TABLE `scms_class` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `order_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scms_class`
--

INSERT INTO `scms_class` (`id`, `name`, `teacher_id`, `order_by`, `created_at`, `updated_at`) VALUES
(1, 'Class Nursary', 4, '1', '2022-10-05 07:17:11', '2022-11-13 17:03:15'),
(2, 'One', 4, '1', '2022-11-11 14:09:15', '2022-11-12 06:34:44'),
(3, 'Class Two', 4, '2', '2022-11-11 14:09:23', '2022-11-12 06:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `scms_enroll`
--

CREATE TABLE `scms_enroll` (
  `enroll_id` bigint(20) NOT NULL,
  `student_id` bigint(20) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `shift` int(11) DEFAULT NULL,
  `roll` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vtype` tinyint(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scms_groups`
--

CREATE TABLE `scms_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scms_groups`
--

INSERT INTO `scms_groups` (`id`, `name`, `order_by`, `created_at`, `updated_at`) VALUES
(1, 'Humanities', 1, '2022-10-05 07:17:11', '2022-11-12 05:54:04'),
(2, 'Science', 2, '2022-11-11 14:09:15', '2022-11-11 14:09:15'),
(3, 'Business Studies', 3, '2022-11-11 14:09:23', '2022-11-11 14:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `scms_sections`
--

CREATE TABLE `scms_sections` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `nick_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scms_sections`
--

INSERT INTO `scms_sections` (`id`, `name`, `teacher_id`, `nick_name`, `class_id`, `shift_id`, `order_by`, `created_at`, `updated_at`) VALUES
(1, 'A', 4, 'A', 1, 1, NULL, '2022-11-13 17:42:16', '2022-11-13 17:49:25'),
(2, 'B', NULL, 'B', 1, NULL, NULL, '2022-11-13 17:45:33', '2022-11-13 17:45:33'),
(3, 'A', NULL, NULL, 2, NULL, NULL, '2022-11-13 17:48:01', '2022-11-13 17:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `scms_shift`
--

CREATE TABLE `scms_shift` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scms_shift`
--

INSERT INTO `scms_shift` (`id`, `name`, `order_by`, `created_at`, `updated_at`) VALUES
(1, 'Day', 1, '2022-10-05 07:17:11', '2022-11-11 14:14:52'),
(2, 'Morning', 2, '2022-11-11 14:15:25', '2022-11-11 14:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `scms_student`
--

CREATE TABLE `scms_student` (
  `id` bigint(20) NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vtype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `scms_student`
--

INSERT INTO `scms_student` (`id`, `phone`, `email`, `password`, `vtype`) VALUES
(1, '017452222222', NULL, NULL, 1),
(2, NULL, NULL, NULL, 1),
(4, NULL, NULL, NULL, 1),
(5, NULL, NULL, NULL, 1),
(6, '12456', NULL, NULL, 1),
(7, '01719448216', NULL, NULL, 1),
(8, '01721395631', NULL, NULL, 1),
(9, '01759066355', NULL, NULL, 1),
(10, '01792189549', NULL, NULL, 1),
(11, '01770582890', NULL, NULL, 1),
(12, '01782328303', NULL, NULL, 1),
(13, '', NULL, NULL, 1),
(14, '01724678278', NULL, NULL, 1),
(15, '01317994536', NULL, NULL, 1),
(16, '01746859944', NULL, NULL, 1),
(27, NULL, NULL, NULL, 1),
(28, '99999999999', NULL, NULL, 1),
(29, NULL, NULL, NULL, 1),
(30, NULL, NULL, NULL, 1),
(31, '01918757070', 'faruk_techuno@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 1),
(242, '1714915469', NULL, NULL, 1),
(243, '1760033296', NULL, NULL, 1),
(244, '1725583314', NULL, NULL, 1),
(245, '1723853322', NULL, NULL, 1),
(246, '1719895915', NULL, NULL, 1),
(247, '1752965129', NULL, NULL, 1),
(248, '1755373838', NULL, NULL, 1),
(249, '1716729851', NULL, NULL, 1),
(250, '1710185391', NULL, NULL, 1),
(251, '1717023193', NULL, NULL, 1),
(252, '1727581487', NULL, NULL, 1),
(253, '1735990865', NULL, NULL, 1),
(254, '1726561130', NULL, NULL, 1),
(255, '1760849436', NULL, NULL, 1),
(256, '1726745162', NULL, NULL, 1),
(257, '1771857240', NULL, NULL, 1),
(258, '1705693086', NULL, NULL, 1),
(259, '1727158698', NULL, NULL, 1),
(260, '1779088606', NULL, NULL, 1),
(261, '1713800105', NULL, NULL, 1),
(262, '1778960170', NULL, NULL, 1),
(263, '1754663366', NULL, NULL, 1),
(264, '1733769357', NULL, NULL, 1),
(265, '1785336069', NULL, NULL, 1),
(266, '1312732290', NULL, NULL, 1),
(267, '1713811348', NULL, NULL, 1),
(268, '1734525988', NULL, NULL, 1),
(269, '1780521810', NULL, NULL, 1),
(270, '1730460662', NULL, NULL, 1),
(271, '1713804176', NULL, NULL, 1),
(272, '1757278972', NULL, NULL, 1),
(273, '1712300467', NULL, NULL, 1),
(274, '1747293361', NULL, NULL, 1),
(275, '1747313872', NULL, NULL, 1),
(276, '1742972598', NULL, NULL, 1),
(277, '1743250849', NULL, NULL, 1),
(278, '1721038769', NULL, NULL, 1),
(279, '1784442249', NULL, NULL, 1),
(280, '1740157431', NULL, NULL, 1),
(281, '1724355540', NULL, NULL, 1),
(282, '1788566313', NULL, NULL, 1),
(283, '1714725220', NULL, NULL, 1),
(284, '1759237148', NULL, NULL, 1),
(285, '1601524914', NULL, NULL, 1),
(286, '1753116914', NULL, NULL, 1),
(287, '1770215659', NULL, NULL, 1),
(288, '1719189527', NULL, NULL, 1),
(289, '1305519477', NULL, NULL, 1),
(290, '1769323706', NULL, NULL, 1),
(291, '1727316009', NULL, NULL, 1),
(292, '1862322644', NULL, NULL, 1),
(293, '1734823753', NULL, NULL, 1),
(294, '1706188448', NULL, NULL, 1),
(295, '1712854511', NULL, NULL, 1),
(296, '1745879871', NULL, NULL, 1),
(298, '', NULL, NULL, 1),
(299, '', NULL, NULL, 1),
(300, '', NULL, NULL, 1),
(301, '', NULL, NULL, 1),
(302, '', NULL, NULL, 1),
(303, '', NULL, NULL, 1),
(304, '', NULL, NULL, 1),
(305, '', NULL, NULL, 1),
(306, '', NULL, NULL, 1),
(307, '', NULL, NULL, 1),
(308, '', NULL, NULL, 1),
(309, '', NULL, NULL, 1),
(310, '', NULL, NULL, 1),
(311, '', NULL, NULL, 1),
(312, '', NULL, NULL, 1),
(313, '', NULL, NULL, 1),
(314, '', NULL, NULL, 1),
(315, '', NULL, NULL, 1),
(316, '', NULL, NULL, 1),
(317, '', NULL, NULL, 1),
(318, '', NULL, NULL, 1),
(319, '', NULL, NULL, 1),
(320, '', NULL, NULL, 1),
(321, '', NULL, NULL, 1),
(322, '', NULL, NULL, 1),
(323, '', NULL, NULL, 1),
(324, '', NULL, NULL, 1),
(325, '', NULL, NULL, 1),
(326, '', NULL, NULL, 1),
(327, '', NULL, NULL, 1),
(328, '', NULL, NULL, 1),
(329, '', NULL, NULL, 1),
(330, '', NULL, NULL, 1),
(331, '', NULL, NULL, 1),
(332, '', NULL, NULL, 1),
(333, '', NULL, NULL, 1),
(334, '', NULL, NULL, 1),
(335, '', NULL, NULL, 1),
(336, '', NULL, NULL, 1),
(337, '', NULL, NULL, 1),
(338, '', NULL, NULL, 1),
(339, '', NULL, NULL, 1),
(340, '', NULL, NULL, 1),
(341, '', NULL, NULL, 1),
(342, '', NULL, NULL, 1),
(343, '', NULL, NULL, 1),
(344, '', NULL, NULL, 1),
(345, '', NULL, NULL, 1),
(346, '', NULL, NULL, 1),
(347, '', NULL, NULL, 1),
(348, '', NULL, NULL, 1),
(349, '', NULL, NULL, 1),
(350, '', NULL, NULL, 1),
(351, '', NULL, NULL, 1),
(352, '', NULL, NULL, 1),
(353, '', NULL, NULL, 1),
(354, '', NULL, NULL, 1),
(355, '', NULL, NULL, 1),
(356, '', NULL, NULL, 1),
(357, '', NULL, NULL, 1),
(358, '', NULL, NULL, 1),
(359, '', NULL, NULL, 1),
(360, '', NULL, NULL, 1),
(361, '', NULL, NULL, 1),
(362, '', NULL, NULL, 1),
(363, '', NULL, NULL, 1),
(364, '', NULL, NULL, 1),
(365, '', NULL, NULL, 1),
(366, '', NULL, NULL, 1),
(367, '', NULL, NULL, 1),
(368, '', NULL, NULL, 1),
(369, '', NULL, NULL, 1),
(370, '', NULL, NULL, 1),
(371, '', NULL, NULL, 1),
(372, '', NULL, NULL, 1),
(373, '', NULL, NULL, 1),
(374, '', NULL, NULL, 1),
(375, '', NULL, NULL, 1),
(376, '', NULL, NULL, 1),
(377, '', NULL, NULL, 1),
(378, '', NULL, NULL, 1),
(379, '', NULL, NULL, 1),
(380, '', NULL, NULL, 1),
(381, '', NULL, NULL, 1),
(382, '', NULL, NULL, 1),
(383, '', NULL, NULL, 1),
(384, '', NULL, NULL, 1),
(385, '', NULL, NULL, 1),
(386, '', NULL, NULL, 1),
(387, '', NULL, NULL, 1),
(388, '', NULL, NULL, 1),
(389, '', NULL, NULL, 1),
(390, '', NULL, NULL, 1),
(391, '', NULL, NULL, 1),
(392, '', NULL, NULL, 1),
(393, '', NULL, NULL, 1),
(394, '', NULL, NULL, 1),
(395, '', NULL, NULL, 1),
(396, '', NULL, NULL, 1),
(397, '', NULL, NULL, 1),
(398, '', NULL, NULL, 1),
(399, '', NULL, NULL, 1),
(400, '', NULL, NULL, 1),
(401, '', NULL, NULL, 1),
(402, '', NULL, NULL, 1),
(403, '', NULL, NULL, 1),
(404, '', NULL, NULL, 1),
(405, '', NULL, NULL, 1),
(406, '', NULL, NULL, 1),
(407, '', NULL, NULL, 1),
(408, '', NULL, NULL, 1),
(409, '', NULL, NULL, 1),
(410, '', NULL, NULL, 1),
(411, '', NULL, NULL, 1),
(412, '', NULL, NULL, 1),
(413, '', NULL, NULL, 1),
(414, '', NULL, NULL, 1),
(415, '', NULL, NULL, 1),
(416, '', NULL, NULL, 1),
(417, '', NULL, NULL, 1),
(418, '', NULL, NULL, 1),
(419, '', NULL, NULL, 1),
(420, '', NULL, NULL, 1),
(421, '', NULL, NULL, 1),
(422, '', NULL, NULL, 1),
(423, '', NULL, NULL, 1),
(424, '', NULL, NULL, 1),
(425, '', NULL, NULL, 1),
(426, '', NULL, NULL, 1),
(427, '', NULL, NULL, 1),
(428, '', NULL, NULL, 1),
(429, '', NULL, NULL, 1),
(430, '', NULL, NULL, 1),
(431, '', NULL, NULL, 1),
(432, '', NULL, NULL, 1),
(433, '', NULL, NULL, 1),
(434, '', NULL, NULL, 1),
(435, '', NULL, NULL, 1),
(436, '', NULL, NULL, 1),
(437, '', NULL, NULL, 1),
(438, '', NULL, NULL, 1),
(439, '', NULL, NULL, 1),
(440, '', NULL, NULL, 1),
(441, '', NULL, NULL, 1),
(442, '', NULL, NULL, 1),
(443, '', NULL, NULL, 1),
(444, '', NULL, NULL, 1),
(445, '', NULL, NULL, 1),
(446, '', NULL, NULL, 1),
(447, '', NULL, NULL, 1),
(448, '', NULL, NULL, 1),
(449, '', NULL, NULL, 1),
(450, '', NULL, NULL, 1),
(451, '', NULL, NULL, 1),
(452, '', NULL, NULL, 1),
(453, '', NULL, NULL, 1),
(454, '', NULL, NULL, 1),
(455, '', NULL, NULL, 1),
(456, '', NULL, NULL, 1),
(457, '', NULL, NULL, 1),
(458, '', NULL, NULL, 1),
(459, '', NULL, NULL, 1),
(460, '', NULL, NULL, 1),
(461, '', NULL, NULL, 1),
(462, '', NULL, NULL, 1),
(463, '', NULL, NULL, 1),
(464, '', NULL, NULL, 1),
(465, '', NULL, NULL, 1),
(466, '', NULL, NULL, 1),
(467, '', NULL, NULL, 1),
(468, '', NULL, NULL, 1),
(469, '', NULL, NULL, 1),
(470, '', NULL, NULL, 1),
(471, '', NULL, NULL, 1),
(472, '', NULL, NULL, 1),
(473, '', NULL, NULL, 1),
(474, '', NULL, NULL, 1),
(475, '', NULL, NULL, 1),
(476, '', NULL, NULL, 1),
(477, '', NULL, NULL, 1),
(478, '', NULL, NULL, 1),
(479, '', NULL, NULL, 1),
(480, '', NULL, NULL, 1),
(481, '', NULL, NULL, 1),
(482, '', NULL, NULL, 1),
(483, '', NULL, NULL, 1),
(484, '', NULL, NULL, 1),
(485, '', NULL, NULL, 1),
(486, '', NULL, NULL, 1),
(487, '', NULL, NULL, 1),
(488, '', NULL, NULL, 1),
(489, '', NULL, NULL, 1),
(490, '', NULL, NULL, 1),
(491, '', NULL, NULL, 1),
(492, '', NULL, NULL, 1),
(493, '', NULL, NULL, 1),
(494, '', NULL, NULL, 1),
(495, '', NULL, NULL, 1),
(496, '', NULL, NULL, 1),
(497, '', NULL, NULL, 1),
(498, '', NULL, NULL, 1),
(499, '', NULL, NULL, 1),
(500, '', NULL, NULL, 1),
(501, '', NULL, NULL, 1),
(502, '', NULL, NULL, 1),
(503, '', NULL, NULL, 1),
(504, '', NULL, NULL, 1),
(505, '', NULL, NULL, 1),
(506, '', NULL, NULL, 1),
(507, '', NULL, NULL, 1),
(508, '', NULL, NULL, 1),
(509, '', NULL, NULL, 1),
(510, '', NULL, NULL, 1),
(511, '', NULL, NULL, 1),
(512, '', NULL, NULL, 1),
(513, '', NULL, NULL, 1),
(514, '', NULL, NULL, 1),
(515, '', NULL, NULL, 1),
(516, '', NULL, NULL, 1),
(517, '', NULL, NULL, 1),
(518, '', NULL, NULL, 1),
(519, '', NULL, NULL, 1),
(520, '', NULL, NULL, 1),
(521, '', NULL, NULL, 1),
(522, '', NULL, NULL, 1),
(523, '', NULL, NULL, 1),
(524, '', NULL, NULL, 1),
(525, '', NULL, NULL, 1),
(526, '', NULL, NULL, 1),
(527, '', NULL, NULL, 1),
(528, '', NULL, NULL, 1),
(529, '', NULL, NULL, 1),
(530, '', NULL, NULL, 1),
(531, '', NULL, NULL, 1),
(532, '', NULL, NULL, 1),
(533, '', NULL, NULL, 1),
(534, '', NULL, NULL, 1),
(535, '', NULL, NULL, 1),
(536, '', NULL, NULL, 1),
(537, '', NULL, NULL, 1),
(538, '', NULL, NULL, 1),
(539, '', NULL, NULL, 1),
(540, '', NULL, NULL, 1),
(541, '', NULL, NULL, 1),
(542, '', NULL, NULL, 1),
(543, '', NULL, NULL, 1),
(544, '', NULL, NULL, 1),
(545, '', NULL, NULL, 1),
(546, '', NULL, NULL, 1),
(547, '', NULL, NULL, 1),
(548, '', NULL, NULL, 1),
(549, '', NULL, NULL, 1),
(550, '', NULL, NULL, 1),
(551, '', NULL, NULL, 1),
(552, '', NULL, NULL, 1),
(553, '', NULL, NULL, 1),
(554, '', NULL, NULL, 1),
(555, '', NULL, NULL, 1),
(556, '', NULL, NULL, 1),
(557, '', NULL, NULL, 1),
(558, '', NULL, NULL, 1),
(559, '', NULL, NULL, 1),
(560, '', NULL, NULL, 1),
(561, '', NULL, NULL, 1),
(562, '', NULL, NULL, 1),
(563, '', NULL, NULL, 1),
(564, '', NULL, NULL, 1),
(565, '', NULL, NULL, 1),
(566, '', NULL, NULL, 1),
(567, '', NULL, NULL, 1),
(568, '', NULL, NULL, 1),
(569, '', NULL, NULL, 1),
(570, '', NULL, NULL, 1),
(571, '', NULL, NULL, 1),
(572, '', NULL, NULL, 1),
(573, '', NULL, NULL, 1),
(574, '', NULL, NULL, 1),
(575, '', NULL, NULL, 1),
(576, '', NULL, NULL, 1),
(577, '', NULL, NULL, 1),
(578, '', NULL, NULL, 1),
(579, '', NULL, NULL, 1),
(580, '', NULL, NULL, 1),
(581, '', NULL, NULL, 1),
(582, '', NULL, NULL, 1),
(583, '', NULL, NULL, 1),
(584, '', NULL, NULL, 1),
(585, '', NULL, NULL, 1),
(586, '', NULL, NULL, 1),
(587, '', NULL, NULL, 1),
(588, '', NULL, NULL, 1),
(589, '', NULL, NULL, 1),
(590, '', NULL, NULL, 1),
(591, '', NULL, NULL, 1),
(592, '', NULL, NULL, 1),
(593, '', NULL, NULL, 1),
(594, '', NULL, NULL, 1),
(595, '', NULL, NULL, 1),
(596, '', NULL, NULL, 1),
(597, '', NULL, NULL, 1),
(598, '', NULL, NULL, 1),
(599, '', NULL, NULL, 1),
(600, '', NULL, NULL, 1),
(601, '', NULL, NULL, 1),
(602, '', NULL, NULL, 1),
(603, '', NULL, NULL, 1),
(604, '', NULL, NULL, 1),
(605, '', NULL, NULL, 1),
(606, '', NULL, NULL, 1),
(607, '', NULL, NULL, 1),
(608, '', NULL, NULL, 1),
(609, '', NULL, NULL, 1),
(610, '', NULL, NULL, 1),
(611, '', NULL, NULL, 1),
(612, '', NULL, NULL, 1),
(613, '', NULL, NULL, 1),
(614, '', NULL, NULL, 1),
(615, '', NULL, NULL, 1),
(616, '', NULL, NULL, 1),
(617, '', NULL, NULL, 1),
(618, '', NULL, NULL, 1),
(619, '', NULL, NULL, 1),
(620, '', NULL, NULL, 1),
(621, '', NULL, NULL, 1),
(622, '', NULL, NULL, 1),
(623, '', NULL, NULL, 1),
(624, '', NULL, NULL, 1),
(625, '', NULL, NULL, 1),
(626, '', NULL, NULL, 1),
(627, '', NULL, NULL, 1),
(628, '', NULL, NULL, 1),
(629, '', NULL, NULL, 1),
(630, '', NULL, NULL, 1),
(631, '', NULL, NULL, 1),
(632, '', NULL, NULL, 1),
(633, '', NULL, NULL, 1),
(634, NULL, NULL, NULL, 1),
(636, NULL, NULL, NULL, 1),
(637, NULL, NULL, NULL, 1),
(638, '', NULL, NULL, 1),
(639, '', NULL, NULL, 1),
(640, '', NULL, NULL, 1),
(641, '', NULL, NULL, 1),
(642, '', NULL, NULL, 1),
(643, '', NULL, NULL, 1),
(644, '', NULL, NULL, 1),
(645, '', NULL, NULL, 1),
(646, '', NULL, NULL, 1),
(647, '', NULL, NULL, 1),
(648, '', NULL, NULL, 1),
(649, '', NULL, NULL, 1),
(650, '', NULL, NULL, 1),
(651, '', NULL, NULL, 1),
(652, '', NULL, NULL, 1),
(653, '', NULL, NULL, 1),
(654, '', NULL, NULL, 1),
(655, '', NULL, NULL, 1),
(656, '', NULL, NULL, 1),
(657, '', NULL, NULL, 1),
(658, '', NULL, NULL, 1),
(659, '', NULL, NULL, 1),
(660, '', NULL, NULL, 1),
(661, '', NULL, NULL, 1),
(662, '', NULL, NULL, 1),
(663, '', NULL, NULL, 1),
(664, '', NULL, NULL, 1),
(665, '', NULL, NULL, 1),
(666, '', NULL, NULL, 1),
(667, '', NULL, NULL, 1),
(668, '', NULL, NULL, 1),
(669, '', NULL, NULL, 1),
(670, '', NULL, NULL, 1),
(671, '', NULL, NULL, 1),
(672, '', NULL, NULL, 1),
(673, '', NULL, NULL, 1),
(674, '', NULL, NULL, 1),
(675, '', NULL, NULL, 1),
(676, '', NULL, NULL, 1),
(677, '', NULL, NULL, 1),
(678, '', NULL, NULL, 1),
(679, '', NULL, NULL, 1),
(680, '', NULL, NULL, 1),
(681, '', NULL, NULL, 1),
(682, '', NULL, NULL, 1),
(683, '', NULL, NULL, 1),
(684, '', NULL, NULL, 1),
(685, '', NULL, NULL, 1),
(686, '', NULL, NULL, 1),
(687, '', NULL, NULL, 1),
(688, '', NULL, NULL, 1),
(689, '', NULL, NULL, 1),
(690, '', NULL, NULL, 1),
(691, '', NULL, NULL, 1),
(692, '', NULL, NULL, 1),
(693, '', NULL, NULL, 1),
(694, '', NULL, NULL, 1),
(695, '', NULL, NULL, 1),
(696, '', NULL, NULL, 1),
(697, '', NULL, NULL, 1),
(698, '', NULL, NULL, 1),
(699, '', NULL, NULL, 1),
(700, '', NULL, NULL, 1),
(701, '', NULL, NULL, 1),
(702, '', NULL, NULL, 1),
(703, '', NULL, NULL, 1),
(704, '', NULL, NULL, 1),
(705, '', NULL, NULL, 1),
(706, '', NULL, NULL, 1),
(707, '', NULL, NULL, 1),
(708, '', NULL, NULL, 1),
(709, '', NULL, NULL, 1),
(710, '', NULL, NULL, 1),
(711, '', NULL, NULL, 1),
(712, '', NULL, NULL, 1),
(713, '', NULL, NULL, 1),
(714, '', NULL, NULL, 1),
(715, '', NULL, NULL, 1),
(716, '', NULL, NULL, 1),
(717, '', NULL, NULL, 1),
(718, '', NULL, NULL, 1),
(719, '', NULL, NULL, 1),
(720, '', NULL, NULL, 1),
(721, '', NULL, NULL, 1),
(722, '', NULL, NULL, 1),
(723, '', NULL, NULL, 1),
(724, '', NULL, NULL, 1),
(725, '', NULL, NULL, 1),
(726, '', NULL, NULL, 1),
(727, '', NULL, NULL, 1),
(728, '', NULL, NULL, 1),
(729, '', NULL, NULL, 1),
(730, '', NULL, NULL, 1),
(731, '', NULL, NULL, 1),
(732, '', NULL, NULL, 1),
(733, '', NULL, NULL, 1),
(734, '', NULL, NULL, 1),
(735, '', NULL, NULL, 1),
(736, '', NULL, NULL, 1),
(737, '', NULL, NULL, 1),
(738, '', NULL, NULL, 1),
(739, '', NULL, NULL, 1),
(740, '', NULL, NULL, 1),
(741, '', NULL, NULL, 1),
(742, '', NULL, NULL, 1),
(743, '', NULL, NULL, 1),
(744, '', NULL, NULL, 1),
(745, '', NULL, NULL, 1),
(746, '', NULL, NULL, 1),
(747, '', NULL, NULL, 1),
(748, '', NULL, NULL, 1),
(749, '', NULL, NULL, 1),
(750, '', NULL, NULL, 1),
(751, '', NULL, NULL, 1),
(752, '', NULL, NULL, 1),
(753, '', NULL, NULL, 1),
(754, '', NULL, NULL, 1),
(755, '', NULL, NULL, 1),
(756, '', NULL, NULL, 1),
(757, '', NULL, NULL, 1),
(758, '', NULL, NULL, 1),
(759, '', NULL, NULL, 1),
(760, '', NULL, NULL, 1),
(761, '', NULL, NULL, 1),
(762, '', NULL, NULL, 1),
(763, '', NULL, NULL, 1),
(764, '', NULL, NULL, 1),
(765, '', NULL, NULL, 1),
(766, '', NULL, NULL, 1),
(767, '', NULL, NULL, 1),
(768, '', NULL, NULL, 1),
(769, '', NULL, NULL, 1),
(770, '', NULL, NULL, 1),
(771, '', NULL, NULL, 1),
(772, '', NULL, NULL, 1),
(773, '', NULL, NULL, 1),
(774, '', NULL, NULL, 1),
(775, '', NULL, NULL, 1),
(776, '', NULL, NULL, 1),
(777, '', NULL, NULL, 1),
(778, '', NULL, NULL, 1),
(779, '', NULL, NULL, 1),
(780, '', NULL, NULL, 1),
(781, '', NULL, NULL, 1),
(782, '', NULL, NULL, 1),
(783, '', NULL, NULL, 1),
(784, '', NULL, NULL, 1),
(785, '', NULL, NULL, 1),
(786, '', NULL, NULL, 1),
(787, '', NULL, NULL, 1),
(788, '', NULL, NULL, 1),
(789, '', NULL, NULL, 1),
(790, '', NULL, NULL, 1),
(791, '', NULL, NULL, 1),
(792, '', NULL, NULL, 1),
(793, '', NULL, NULL, 1),
(794, '', NULL, NULL, 1),
(795, '', NULL, NULL, 1),
(796, '', NULL, NULL, 1),
(797, '', NULL, NULL, 1),
(798, '', NULL, NULL, 1),
(799, '', NULL, NULL, 1),
(800, '', NULL, NULL, 1),
(801, '', NULL, NULL, 1),
(802, '', NULL, NULL, 1),
(803, '', NULL, NULL, 1),
(804, '', NULL, NULL, 1),
(805, '', NULL, NULL, 1),
(806, '', NULL, NULL, 1),
(807, '', NULL, NULL, 1),
(808, '', NULL, NULL, 1),
(809, '', NULL, NULL, 1),
(810, '', NULL, NULL, 1),
(811, '', NULL, NULL, 1),
(812, '', NULL, NULL, 1),
(813, '', NULL, NULL, 1),
(814, '', NULL, NULL, 1),
(815, '', NULL, NULL, 1),
(816, '', NULL, NULL, 1),
(817, '', NULL, NULL, 1),
(818, '', NULL, NULL, 1),
(819, '', NULL, NULL, 1),
(820, '', NULL, NULL, 1),
(821, '', NULL, NULL, 1),
(822, '', NULL, NULL, 1),
(823, '', NULL, NULL, 1),
(824, '', NULL, NULL, 1),
(825, '', NULL, NULL, 1),
(826, '', NULL, NULL, 1),
(827, '', NULL, NULL, 1),
(828, '', NULL, NULL, 1),
(829, '', NULL, NULL, 1),
(830, '', NULL, NULL, 1),
(831, '', NULL, NULL, 1),
(832, '', NULL, NULL, 1),
(833, '', NULL, NULL, 1),
(834, '', NULL, NULL, 1),
(835, '', NULL, NULL, 1),
(836, '', NULL, NULL, 1),
(837, '', NULL, NULL, 1),
(838, '', NULL, NULL, 1),
(839, '', NULL, NULL, 1),
(840, '', NULL, NULL, 1),
(841, '', NULL, NULL, 1),
(842, '', NULL, NULL, 1),
(843, '', NULL, NULL, 1),
(844, '', NULL, NULL, 1),
(845, '', NULL, NULL, 1),
(846, '', NULL, NULL, 1),
(847, '', NULL, NULL, 1),
(848, NULL, NULL, NULL, 1),
(849, '', NULL, NULL, 1),
(850, '', NULL, NULL, 1),
(851, '', NULL, NULL, 1),
(852, '', NULL, NULL, 1),
(853, '', NULL, NULL, 1),
(854, '', NULL, NULL, 1),
(855, '', NULL, NULL, 1),
(856, '', NULL, NULL, 1),
(857, '', NULL, NULL, 1),
(858, '', NULL, NULL, 1),
(859, '', NULL, NULL, 1),
(860, '', NULL, NULL, 1),
(861, '', NULL, NULL, 1),
(862, '', NULL, NULL, 1),
(863, '', NULL, NULL, 1),
(864, '', NULL, NULL, 1),
(865, '', NULL, NULL, 1),
(866, '', NULL, NULL, 1),
(867, '', NULL, NULL, 1),
(868, '', NULL, NULL, 1),
(869, '', NULL, NULL, 1),
(870, '', NULL, NULL, 1),
(871, '', NULL, NULL, 1),
(872, '', NULL, NULL, 1),
(873, '', NULL, NULL, 1),
(874, '', NULL, NULL, 1),
(875, '', NULL, NULL, 1),
(876, '', NULL, NULL, 1),
(877, '', NULL, NULL, 1),
(878, '', NULL, NULL, 1),
(879, '', NULL, NULL, 1),
(880, '', NULL, NULL, 1),
(881, '', NULL, NULL, 1),
(882, '', NULL, NULL, 1),
(883, '', NULL, NULL, 1),
(884, '', NULL, NULL, 1),
(885, '', NULL, NULL, 1),
(886, '', NULL, NULL, 1),
(887, '', NULL, NULL, 1),
(888, '', NULL, NULL, 1),
(889, '', NULL, NULL, 1),
(890, '', NULL, NULL, 1),
(891, '', NULL, NULL, 1),
(892, '', NULL, NULL, 1),
(893, '', NULL, NULL, 1),
(894, '', NULL, NULL, 1),
(895, '', NULL, NULL, 1),
(896, '', NULL, NULL, 1),
(897, '', NULL, NULL, 1),
(898, '', NULL, NULL, 1),
(899, '', NULL, NULL, 1),
(900, '', NULL, NULL, 1),
(901, '', NULL, NULL, 1),
(902, '', NULL, NULL, 1),
(903, '', NULL, NULL, 1),
(904, '', NULL, NULL, 1),
(905, '', NULL, NULL, 1),
(906, '', NULL, NULL, 1),
(907, '', NULL, NULL, 1),
(908, '', NULL, NULL, 1),
(909, '', NULL, NULL, 1),
(910, '', NULL, NULL, 1),
(911, '', NULL, NULL, 1),
(912, '', NULL, NULL, 1),
(913, '', NULL, NULL, 1),
(914, '', NULL, NULL, 1),
(915, '', NULL, NULL, 1),
(916, '', NULL, NULL, 1),
(917, '', NULL, NULL, 1),
(918, '', NULL, NULL, 1),
(919, '', NULL, NULL, 1),
(920, '', NULL, NULL, 1),
(921, '', NULL, NULL, 1),
(922, '', NULL, NULL, 1),
(923, '', NULL, NULL, 1),
(924, '', NULL, NULL, 1),
(925, '', NULL, NULL, 1),
(926, '', NULL, NULL, 1),
(927, '', NULL, NULL, 1),
(928, '', NULL, NULL, 1),
(929, '', NULL, NULL, 1),
(930, '', NULL, NULL, 1),
(931, '', NULL, NULL, 1),
(932, '', NULL, NULL, 1),
(933, '', NULL, NULL, 1),
(934, '', NULL, NULL, 1),
(935, '', NULL, NULL, 1),
(936, '', NULL, NULL, 1),
(937, '', NULL, NULL, 1),
(938, '', NULL, NULL, 1),
(939, '', NULL, NULL, 1),
(940, '', NULL, NULL, 1),
(941, '', NULL, NULL, 1),
(942, '', NULL, NULL, 1),
(943, '', NULL, NULL, 1),
(944, '', NULL, NULL, 1),
(945, '', NULL, NULL, 1),
(946, '', NULL, NULL, 1),
(947, '', NULL, NULL, 1),
(948, '', NULL, NULL, 1),
(949, '', NULL, NULL, 1),
(950, '', NULL, NULL, 1),
(951, '', NULL, NULL, 1),
(952, '', NULL, NULL, 1),
(953, '', NULL, NULL, 1),
(954, '', NULL, NULL, 1),
(955, '', NULL, NULL, 1),
(956, '', NULL, NULL, 1),
(957, '', NULL, NULL, 1),
(958, '', NULL, NULL, 1),
(959, '', NULL, NULL, 1),
(960, '', NULL, NULL, 1),
(961, '', NULL, NULL, 1),
(962, '', NULL, NULL, 1),
(963, '', NULL, NULL, 1),
(964, '', NULL, NULL, 1),
(965, '', NULL, NULL, 1),
(966, '', NULL, NULL, 1),
(967, '', NULL, NULL, 1),
(968, '', NULL, NULL, 1),
(969, '', NULL, NULL, 1),
(970, '', NULL, NULL, 1),
(971, '', NULL, NULL, 1),
(972, '', NULL, NULL, 1),
(973, '', NULL, NULL, 1),
(974, '', NULL, NULL, 1),
(975, '', NULL, NULL, 1),
(976, '', NULL, NULL, 1),
(977, '', NULL, NULL, 1),
(978, '', NULL, NULL, 1),
(979, '', NULL, NULL, 1),
(980, '', NULL, NULL, 1),
(981, '', NULL, NULL, 1),
(982, '', NULL, NULL, 1),
(983, '', NULL, NULL, 1),
(985, '', NULL, NULL, 1),
(986, '', NULL, NULL, 1),
(987, '', NULL, NULL, 1),
(988, '', NULL, NULL, 1),
(989, '', NULL, NULL, 1),
(990, '', NULL, NULL, 1),
(991, '', NULL, NULL, 1),
(992, '', NULL, NULL, 1),
(993, '', NULL, NULL, 1),
(994, '', NULL, NULL, 1),
(995, '', NULL, NULL, 1),
(996, '', NULL, NULL, 1),
(997, '', NULL, NULL, 1),
(998, '', NULL, NULL, 1),
(999, '', NULL, NULL, 1),
(1000, '', NULL, NULL, 1),
(1001, '', NULL, NULL, 1),
(1002, '', NULL, NULL, 1),
(1003, '', NULL, NULL, 1),
(1004, '', NULL, NULL, 1),
(1005, '', NULL, NULL, 1),
(1006, '', NULL, NULL, 1),
(1007, '', NULL, NULL, 1),
(1008, '', NULL, NULL, 1),
(1009, '', NULL, NULL, 1),
(1010, '', NULL, NULL, 1),
(1011, '', NULL, NULL, 1),
(1012, '', NULL, NULL, 1),
(1013, '', NULL, NULL, 1),
(1014, '', NULL, NULL, 1),
(1015, '', NULL, NULL, 1),
(1016, '', NULL, NULL, 1),
(1017, '', NULL, NULL, 1),
(1018, '', NULL, NULL, 1),
(1019, '', NULL, NULL, 1),
(1020, '', NULL, NULL, 1),
(1021, '', NULL, NULL, 1),
(1022, '', NULL, NULL, 1),
(1023, '', NULL, NULL, 1),
(1024, '', NULL, NULL, 1),
(1025, '', NULL, NULL, 1),
(1026, '', NULL, NULL, 1),
(1027, '', NULL, NULL, 1),
(1028, '', NULL, NULL, 1),
(1029, '', NULL, NULL, 1),
(1030, '', NULL, NULL, 1),
(1031, '', NULL, NULL, 1),
(1032, '', NULL, NULL, 1),
(1033, '', NULL, NULL, 1),
(1034, '', NULL, NULL, 1),
(1035, '', NULL, NULL, 1),
(1036, '', NULL, NULL, 1),
(1037, '', NULL, NULL, 1),
(1038, '', NULL, NULL, 1),
(1039, '', NULL, NULL, 1),
(1040, '', NULL, NULL, 1),
(1041, '', NULL, NULL, 1),
(1042, '', NULL, NULL, 1),
(1043, '', NULL, NULL, 1),
(1044, '', NULL, NULL, 1),
(1045, '', NULL, NULL, 1),
(1046, '', NULL, NULL, 1),
(1047, '', NULL, NULL, 1),
(1048, '', NULL, NULL, 1),
(1049, '', NULL, NULL, 1),
(1050, '', NULL, NULL, 1),
(1051, '', NULL, NULL, 1),
(1052, '', NULL, NULL, 1),
(1053, '', NULL, NULL, 1),
(1054, '', NULL, NULL, 1),
(1055, '', NULL, NULL, 1),
(1056, '', NULL, NULL, 1),
(1057, '', NULL, NULL, 1),
(1058, '', NULL, NULL, 1),
(1059, '', NULL, NULL, 1),
(1060, '', NULL, NULL, 1),
(1061, '', NULL, NULL, 1),
(1062, '', NULL, NULL, 1),
(1063, '', NULL, NULL, 1),
(1064, '', NULL, NULL, 1),
(1065, '', NULL, NULL, 1),
(1066, '', NULL, NULL, 1),
(1067, '', NULL, NULL, 1),
(1068, '', NULL, NULL, 1),
(1069, '', NULL, NULL, 1),
(1070, '', NULL, NULL, 1),
(1071, '', NULL, NULL, 1),
(1072, '', NULL, NULL, 1),
(1073, '', NULL, NULL, 1),
(1074, '', NULL, NULL, 1),
(1075, '', NULL, NULL, 1),
(1076, '', NULL, NULL, 1),
(1077, '', NULL, NULL, 1),
(1078, '', NULL, NULL, 1),
(1079, '', NULL, NULL, 1),
(1080, '', NULL, NULL, 1),
(1081, '', NULL, NULL, 1),
(1082, '', NULL, NULL, 1),
(1083, '', NULL, NULL, 1),
(1084, '', NULL, NULL, 1),
(1085, '', NULL, NULL, 1),
(1086, '', NULL, NULL, 1),
(1087, '', NULL, NULL, 1),
(1088, '', NULL, NULL, 1),
(1089, '', NULL, NULL, 1),
(1090, '', NULL, NULL, 1),
(1091, '', NULL, NULL, 1),
(1092, '', NULL, NULL, 1),
(1099, '', NULL, NULL, 1),
(1100, '', NULL, NULL, 1),
(1101, '', NULL, NULL, 1),
(1102, '', NULL, NULL, 1),
(1103, '', NULL, NULL, 1),
(1104, '', NULL, NULL, 1),
(1105, '', NULL, NULL, 1),
(1106, '', NULL, NULL, 1),
(1107, '', NULL, NULL, 1),
(1108, '', NULL, NULL, 1),
(1109, '', NULL, NULL, 1),
(1110, '', NULL, NULL, 1),
(1111, '', NULL, NULL, 1),
(1112, '', NULL, NULL, 1),
(1113, '', NULL, NULL, 1),
(1114, '', NULL, NULL, 1),
(1115, '', NULL, NULL, 1),
(1116, '', NULL, NULL, 1),
(1117, '', NULL, NULL, 1),
(1118, '', NULL, NULL, 1),
(1119, '', NULL, NULL, 1),
(1120, '', NULL, NULL, 1),
(1121, '', NULL, NULL, 1),
(1122, '', NULL, NULL, 1),
(1123, '', NULL, NULL, 1),
(1124, '', NULL, NULL, 1),
(1125, '', NULL, NULL, 1),
(1126, '', NULL, NULL, 1),
(1127, '', NULL, NULL, 1),
(1128, '', NULL, NULL, 1),
(1129, '', NULL, NULL, 1),
(1130, '', NULL, NULL, 1),
(1131, '', NULL, NULL, 1),
(1132, '', NULL, NULL, 1),
(1133, '', NULL, NULL, 1),
(1134, '', NULL, NULL, 1),
(1135, '', NULL, NULL, 1),
(1136, '', NULL, NULL, 1),
(1137, '', NULL, NULL, 1),
(1138, '', NULL, NULL, 1),
(1139, '', NULL, NULL, 1),
(1140, '', NULL, NULL, 1),
(1141, '', NULL, NULL, 1),
(1142, '', NULL, NULL, 1),
(1143, '', NULL, NULL, 1),
(1144, '', NULL, NULL, 1),
(1145, '', NULL, NULL, 1),
(1146, '', NULL, NULL, 1),
(1147, '', NULL, NULL, 1),
(1148, '', NULL, NULL, 1),
(1149, '', NULL, NULL, 1),
(1150, '', NULL, NULL, 1),
(1151, '', NULL, NULL, 1),
(1152, '', NULL, NULL, 1),
(1153, '', NULL, NULL, 1),
(1154, '', NULL, NULL, 1),
(1155, '', NULL, NULL, 1),
(1156, '', NULL, NULL, 1),
(1157, '', NULL, NULL, 1),
(1158, '', NULL, NULL, 1),
(1159, '', NULL, NULL, 1),
(1160, '', NULL, NULL, 1),
(1161, '', NULL, NULL, 1),
(1162, '', NULL, NULL, 1),
(1163, '', NULL, NULL, 1),
(1164, '', NULL, NULL, 1),
(1165, '', NULL, NULL, 1),
(1166, '', NULL, NULL, 1),
(1167, '', NULL, NULL, 1),
(1168, '', NULL, NULL, 1),
(1169, '', NULL, NULL, 1),
(1170, '', NULL, NULL, 1),
(1171, '', NULL, NULL, 1),
(1172, '', NULL, NULL, 1),
(1173, '', NULL, NULL, 1),
(1174, '', NULL, NULL, 1),
(1175, '', NULL, NULL, 1),
(1176, '', NULL, NULL, 1),
(1177, '', NULL, NULL, 1),
(1178, '', NULL, NULL, 1),
(1179, '', NULL, NULL, 1),
(1180, '', NULL, NULL, 1),
(1181, '', NULL, NULL, 1),
(1182, '', NULL, NULL, 1),
(1183, '', NULL, NULL, 1),
(1184, '', NULL, NULL, 1),
(1185, '', NULL, NULL, 1),
(1186, '', NULL, NULL, 1),
(1187, '', NULL, NULL, 1),
(1188, '', NULL, NULL, 1),
(1189, '', NULL, NULL, 1),
(1190, '', NULL, NULL, 1),
(1191, '', NULL, NULL, 1),
(1192, '', NULL, NULL, 1),
(1193, '', NULL, NULL, 1),
(1194, '', NULL, NULL, 1),
(1195, '', NULL, NULL, 1),
(1196, '', NULL, NULL, 1),
(1197, '', NULL, NULL, 1),
(1198, '', NULL, NULL, 1),
(1199, '', NULL, NULL, 1),
(1200, '', NULL, NULL, 1),
(1201, '', NULL, NULL, 1),
(1202, '', NULL, NULL, 1),
(1203, '', NULL, NULL, 1),
(1204, '', NULL, NULL, 1),
(1205, '', NULL, NULL, 1),
(1206, '', NULL, NULL, 1),
(1207, '', NULL, NULL, 1),
(1208, '', NULL, NULL, 1),
(1209, '', NULL, NULL, 1),
(1210, '', NULL, NULL, 1),
(1211, '', NULL, NULL, 1),
(1212, '', NULL, NULL, 1),
(1213, '', NULL, NULL, 1),
(1214, '', NULL, NULL, 1),
(1215, '', NULL, NULL, 1),
(1216, '', NULL, NULL, 1),
(1217, '', NULL, NULL, 1),
(1218, '', NULL, NULL, 1),
(1219, '', NULL, NULL, 1),
(1220, '', NULL, NULL, 1),
(1221, '', NULL, NULL, 1),
(1222, '', NULL, NULL, 1),
(1223, '', NULL, NULL, 1),
(1224, '', NULL, NULL, 1),
(1225, '', NULL, NULL, 1),
(1226, '', NULL, NULL, 1),
(1227, '', NULL, NULL, 1),
(1228, '', NULL, NULL, 1),
(1229, '', NULL, NULL, 1),
(1230, '', NULL, NULL, 1),
(1231, '', NULL, NULL, 1),
(1232, '', NULL, NULL, 1),
(1233, '', NULL, NULL, 1),
(1234, '', NULL, NULL, 1),
(1235, '', NULL, NULL, 1),
(1236, '', NULL, NULL, 1),
(1237, '', NULL, NULL, 1),
(1238, '', NULL, NULL, 1),
(1239, '', NULL, NULL, 1),
(1240, '', NULL, NULL, 1),
(1241, '', NULL, NULL, 1),
(1242, '', NULL, NULL, 1),
(1243, '', NULL, NULL, 1),
(1244, '', NULL, NULL, 1),
(1245, '', NULL, NULL, 1),
(1246, '', NULL, NULL, 1),
(1247, '', NULL, NULL, 1),
(1248, '', NULL, NULL, 1),
(1249, '', NULL, NULL, 1),
(1250, '', NULL, NULL, 1),
(1251, '', NULL, NULL, 1),
(1252, '', NULL, NULL, 1),
(1253, '', NULL, NULL, 1),
(1254, '', NULL, NULL, 1),
(1255, '', NULL, NULL, 1),
(1256, '', NULL, NULL, 1),
(1257, '', NULL, NULL, 1),
(1258, '', NULL, NULL, 1),
(1259, '', NULL, NULL, 1),
(1260, '', NULL, NULL, 1),
(1261, '', NULL, NULL, 1),
(1262, '', NULL, NULL, 1),
(1263, '', NULL, NULL, 1),
(1264, '', NULL, NULL, 1),
(1265, '', NULL, NULL, 1),
(1266, '', NULL, NULL, 1),
(1267, '', NULL, NULL, 1),
(1268, '', NULL, NULL, 1),
(1269, '', NULL, NULL, 1),
(1270, '', NULL, NULL, 1),
(1271, '', NULL, NULL, 1),
(1272, '', NULL, NULL, 1),
(1273, '', NULL, NULL, 1),
(1274, '', NULL, NULL, 1),
(1275, '', NULL, NULL, 1),
(1276, '', NULL, NULL, 1),
(1277, '', NULL, NULL, 1),
(1278, '', NULL, NULL, 1),
(1279, '', NULL, NULL, 1),
(1280, '', NULL, NULL, 1),
(1281, '', NULL, NULL, 1),
(1282, '', NULL, NULL, 1),
(1283, '', NULL, NULL, 1),
(1284, '', NULL, NULL, 1),
(1285, '', NULL, NULL, 1),
(1286, '', NULL, NULL, 1),
(1287, '', NULL, NULL, 1),
(1288, '', NULL, NULL, 1),
(1289, '', NULL, NULL, 1),
(1290, '', NULL, NULL, 1),
(1291, '', NULL, NULL, 1),
(1292, '', NULL, NULL, 1),
(1293, '', NULL, NULL, 1),
(1294, '', NULL, NULL, 1),
(1295, '', NULL, NULL, 1),
(1296, '', NULL, NULL, 1),
(1297, '', NULL, NULL, 1),
(1298, '', NULL, NULL, 1),
(1299, '', NULL, NULL, 1),
(1300, '', NULL, NULL, 1),
(1301, '', NULL, NULL, 1),
(1302, '', NULL, NULL, 1),
(1303, '', NULL, NULL, 1),
(1304, '', NULL, NULL, 1),
(1305, '', NULL, NULL, 1),
(1306, '', NULL, NULL, 1),
(1307, '', NULL, NULL, 1),
(1308, '', NULL, NULL, 1),
(1309, '', NULL, NULL, 1),
(1310, '', NULL, NULL, 1),
(1311, '', NULL, NULL, 1),
(1312, '', NULL, NULL, 1),
(1313, '', NULL, NULL, 1),
(1314, '', NULL, NULL, 1),
(1315, '', NULL, NULL, 1),
(1316, '', NULL, NULL, 1),
(1317, '', NULL, NULL, 1),
(1318, '', NULL, NULL, 1),
(1319, '', NULL, NULL, 1),
(1320, '', NULL, NULL, 1),
(1321, '', NULL, NULL, 1),
(1322, '', NULL, NULL, 1),
(1578, '', NULL, NULL, 1),
(1579, '', NULL, NULL, 1),
(1580, '', NULL, NULL, 1),
(1581, '', NULL, NULL, 1),
(1582, '', NULL, NULL, 1),
(1583, '', NULL, NULL, 1),
(1584, '', NULL, NULL, 1),
(1585, '', NULL, NULL, 1),
(1586, '', NULL, NULL, 1),
(1587, '', NULL, NULL, 1),
(1588, '', NULL, NULL, 1),
(1589, '', NULL, NULL, 1),
(1590, '', NULL, NULL, 1),
(1591, '', NULL, NULL, 1),
(1592, '', NULL, NULL, 1),
(1594, '', NULL, NULL, 1),
(1595, '', NULL, NULL, 1),
(1596, '', NULL, NULL, 1),
(1597, '', NULL, NULL, 1),
(1598, '', NULL, NULL, 1),
(1599, '', NULL, NULL, 1),
(1600, '', NULL, NULL, 1),
(1601, '', NULL, NULL, 1),
(1602, '', NULL, NULL, 1),
(1603, '', NULL, NULL, 1),
(1604, '', NULL, NULL, 1),
(1605, '', NULL, NULL, 1),
(1606, '', NULL, NULL, 1),
(1607, '', NULL, NULL, 1),
(1608, '', NULL, NULL, 1),
(1609, '', NULL, NULL, 1),
(1611, '', NULL, NULL, 1),
(1612, '', NULL, NULL, 1),
(1613, '', NULL, NULL, 1),
(1614, '', NULL, NULL, 1),
(1615, '', NULL, NULL, 1),
(1616, '', NULL, NULL, 1),
(1617, '', NULL, NULL, 1),
(1618, '', NULL, NULL, 1),
(1619, '', NULL, NULL, 1),
(1620, '', NULL, NULL, 1),
(1621, '', NULL, NULL, 1),
(1622, '', NULL, NULL, 1),
(1623, '', NULL, NULL, 1),
(1625, '', NULL, NULL, 1),
(1626, '', NULL, NULL, 1),
(1627, '', NULL, NULL, 1),
(1628, '', NULL, NULL, 1),
(1629, '', NULL, NULL, 1),
(1630, '', NULL, NULL, 1),
(1631, '', NULL, NULL, 1),
(1632, '', NULL, NULL, 1),
(1633, '', NULL, NULL, 1),
(1634, '', NULL, NULL, 1),
(1635, '', NULL, NULL, 1),
(1636, '', NULL, NULL, 1),
(1637, '', NULL, NULL, 1),
(1638, '', NULL, NULL, 1),
(1639, '', NULL, NULL, 1),
(1640, '', NULL, NULL, 1),
(1641, '', NULL, NULL, 1),
(1642, '', NULL, NULL, 1),
(1643, '', NULL, NULL, 1),
(1644, '', NULL, NULL, 1),
(1645, '', NULL, NULL, 1),
(1646, '', NULL, NULL, 1),
(1648, '', NULL, NULL, 1),
(1649, '', NULL, NULL, 1),
(1650, '', NULL, NULL, 1),
(1651, '', NULL, NULL, 1),
(1653, '', NULL, NULL, 1),
(1654, '', NULL, NULL, 1),
(1656, '', NULL, NULL, 1),
(1657, '', NULL, NULL, 1),
(1659, '', NULL, NULL, 1),
(1660, '', NULL, NULL, 1),
(1662, '', NULL, NULL, 1),
(1663, '', NULL, NULL, 1),
(1664, '', NULL, NULL, 1),
(1665, '', NULL, NULL, 1),
(1666, '', NULL, NULL, 1),
(1667, '', NULL, NULL, 1),
(1668, '', NULL, NULL, 1),
(1669, '', NULL, NULL, 1),
(1670, '', NULL, NULL, 1),
(1672, '', NULL, NULL, 1),
(1673, '', NULL, NULL, 1),
(1675, '', NULL, NULL, 1),
(1676, '', NULL, NULL, 1),
(1677, '', NULL, NULL, 1),
(1679, '', NULL, NULL, 1),
(1681, '', NULL, NULL, 1),
(1682, '', NULL, NULL, 1),
(1683, '', NULL, NULL, 1),
(1686, '', NULL, NULL, 1),
(1687, '', NULL, NULL, 1),
(1688, '', NULL, NULL, 1),
(1689, '', NULL, NULL, 1),
(1690, '', NULL, NULL, 1),
(1691, '', NULL, NULL, 1),
(1692, '', NULL, NULL, 1),
(1693, '', NULL, NULL, 1),
(1694, '', NULL, NULL, 1),
(1695, '', NULL, NULL, 1),
(1696, '', NULL, NULL, 1),
(1697, '', NULL, NULL, 1),
(1698, '', NULL, NULL, 1),
(1699, '', NULL, NULL, 1),
(1700, '', NULL, NULL, 1),
(1701, '', NULL, NULL, 1),
(1702, '', NULL, NULL, 1),
(1703, '', NULL, NULL, 1),
(1704, '', NULL, NULL, 1),
(1705, '', NULL, NULL, 1),
(1706, '', NULL, NULL, 1),
(1707, '', NULL, NULL, 1),
(1708, '', NULL, NULL, 1),
(1709, '', NULL, NULL, 1),
(1710, '', NULL, NULL, 1),
(1711, '', NULL, NULL, 1),
(1712, '', NULL, NULL, 1),
(1713, '', NULL, NULL, 1),
(1714, '', NULL, NULL, 1),
(1715, '', NULL, NULL, 1),
(1716, '', NULL, NULL, 1),
(1717, '', NULL, NULL, 1),
(1718, '', NULL, NULL, 1),
(1719, '', NULL, NULL, 1),
(1720, '', NULL, NULL, 1),
(1721, '', NULL, NULL, 1),
(1722, '', NULL, NULL, 1),
(1723, '', NULL, NULL, 1),
(1724, '', NULL, NULL, 1),
(1725, '', NULL, NULL, 1),
(1726, '', NULL, NULL, 1),
(1727, '', NULL, NULL, 1),
(1728, '', NULL, NULL, 1),
(1729, '', NULL, NULL, 1),
(1730, '', NULL, NULL, 1),
(1732, '', NULL, NULL, 1),
(1733, '', NULL, NULL, 1),
(1734, '', NULL, NULL, 1),
(1735, '', NULL, NULL, 1),
(1736, '', NULL, NULL, 1),
(1737, '', NULL, NULL, 1),
(1738, '', NULL, NULL, 1),
(1739, '', NULL, NULL, 1),
(1740, '', NULL, NULL, 1),
(1741, '', NULL, NULL, 1),
(1744, '', NULL, NULL, 1),
(1745, '', NULL, NULL, 1),
(1746, '', NULL, NULL, 1),
(1747, '', NULL, NULL, 1),
(1748, '', NULL, NULL, 1),
(1749, '', NULL, NULL, 1),
(1750, '', NULL, NULL, 1),
(1751, '', NULL, NULL, 1),
(1752, '', NULL, NULL, 1),
(1753, '', NULL, NULL, 1),
(1754, '', NULL, NULL, 1),
(1755, '', NULL, NULL, 1),
(1756, '', NULL, NULL, 1),
(1757, '', NULL, NULL, 1),
(1758, '', NULL, NULL, 1),
(1759, '', NULL, NULL, 1),
(1760, '', NULL, NULL, 1),
(1761, '', NULL, NULL, 1),
(1762, '', NULL, NULL, 1),
(1763, '', NULL, NULL, 1),
(1764, '', NULL, NULL, 1),
(1765, '', NULL, NULL, 1),
(1766, '', NULL, NULL, 1),
(1767, '', NULL, NULL, 1),
(1768, '', NULL, NULL, 1),
(1769, '', NULL, NULL, 1),
(1770, '', NULL, NULL, 1),
(1771, '', NULL, NULL, 1),
(1772, '', NULL, NULL, 1),
(1773, '', NULL, NULL, 1),
(1774, '', NULL, NULL, 1),
(1775, '', NULL, NULL, 1),
(1776, '', NULL, NULL, 1),
(1777, '', NULL, NULL, 1),
(1778, '', NULL, NULL, 1),
(1779, '', NULL, NULL, 1),
(1780, '', NULL, NULL, 1),
(1781, '', NULL, NULL, 1),
(1782, '', NULL, NULL, 1),
(1783, '', NULL, NULL, 1),
(1784, '', NULL, NULL, 1),
(1785, '', NULL, NULL, 1),
(1786, '', NULL, NULL, 1),
(1787, '', NULL, NULL, 1),
(1788, '', NULL, NULL, 1),
(1789, '', NULL, NULL, 1),
(1790, '', NULL, NULL, 1),
(1791, '', NULL, NULL, 1),
(1792, '', NULL, NULL, 1),
(1793, '', NULL, NULL, 1),
(1794, '', NULL, NULL, 1),
(1795, '', NULL, NULL, 1),
(1796, '', NULL, NULL, 1),
(1797, '', NULL, NULL, 1),
(1798, '', NULL, NULL, 1),
(1799, '', NULL, NULL, 1),
(1800, '', NULL, NULL, 1),
(1801, '', NULL, NULL, 1),
(1802, '', NULL, NULL, 1),
(1803, '', NULL, NULL, 1),
(1804, '', NULL, NULL, 1),
(1805, '', NULL, NULL, 1),
(1806, '', NULL, NULL, 1),
(1809, '', NULL, NULL, 1),
(1810, '', NULL, NULL, 1),
(1811, '', NULL, NULL, 1),
(1812, '', NULL, NULL, 1),
(1813, '', NULL, NULL, 1),
(1814, '', NULL, NULL, 1),
(1817, '', NULL, NULL, 1),
(1818, '', NULL, NULL, 1),
(1819, '', NULL, NULL, 1),
(1820, '', NULL, NULL, 1),
(1821, '', NULL, NULL, 1),
(1822, '', NULL, NULL, 1),
(1823, '', NULL, NULL, 1),
(1824, '', NULL, NULL, 1),
(1825, '', NULL, NULL, 1),
(1826, '', NULL, NULL, 1),
(1827, '', NULL, NULL, 1),
(1830, '', NULL, NULL, 1),
(1831, '', NULL, NULL, 1),
(1832, '', NULL, NULL, 1),
(1833, '', NULL, NULL, 1),
(1834, '', NULL, NULL, 1),
(1835, '', NULL, NULL, 1),
(1836, '', NULL, NULL, 1),
(1837, '', NULL, NULL, 1),
(1840, '', NULL, NULL, 1),
(1841, '', NULL, NULL, 1),
(1844, '', NULL, NULL, 1),
(1845, '', NULL, NULL, 1),
(1846, '', NULL, NULL, 1),
(1847, '', NULL, NULL, 1),
(1849, '', NULL, NULL, 1),
(1853, '', NULL, NULL, 1),
(1854, '', NULL, NULL, 1),
(1855, '', NULL, NULL, 1),
(1856, '', NULL, NULL, 1),
(1857, '', NULL, NULL, 1),
(1866, '', NULL, NULL, 1),
(1867, '', NULL, NULL, 1),
(1868, '', NULL, NULL, 1),
(1869, '01714915469', NULL, NULL, 1),
(1870, '01760033296', NULL, NULL, 1),
(1871, '01725583314', NULL, NULL, 1),
(1872, '01723853322', NULL, NULL, 1),
(1873, '01719895915', NULL, NULL, 1),
(1874, '01752965129', NULL, NULL, 1),
(1875, '01755373838', NULL, NULL, 1),
(1876, '01716729851', NULL, NULL, 1),
(1877, '01710185391', NULL, NULL, 1),
(1878, '01717023193', NULL, NULL, 1),
(1879, '01727581487', NULL, NULL, 1),
(1880, '01735990865', NULL, NULL, 1),
(1881, '01726561130', NULL, NULL, 1),
(1882, '01760849436', NULL, NULL, 1),
(1883, '01726745162', NULL, NULL, 1),
(1884, '01771857240', NULL, NULL, 1),
(1885, '01705693086', NULL, NULL, 1),
(1886, '01727158698', NULL, NULL, 1),
(1887, '01779088606', NULL, NULL, 1),
(1888, '01713800105', NULL, NULL, 1),
(1889, '01778960170', NULL, NULL, 1),
(1890, '01754663366', NULL, NULL, 1),
(1891, '01733769357', NULL, NULL, 1),
(1892, '01785336069', NULL, NULL, 1),
(1893, '01312732290', NULL, NULL, 1),
(1894, '01713811348', NULL, NULL, 1),
(1895, '01734525988', NULL, NULL, 1),
(1896, '01780521810', NULL, NULL, 1),
(1897, '01730460662', NULL, NULL, 1),
(1898, '01713804176', NULL, NULL, 1),
(1899, '01757278972', NULL, NULL, 1),
(1900, '01712300467', NULL, NULL, 1),
(1901, '01747293361', NULL, NULL, 1),
(1902, '01747313872', NULL, NULL, 1),
(1903, '01742972598', NULL, NULL, 1),
(1904, '01743250849', NULL, NULL, 1),
(1905, '01721038769', NULL, NULL, 1),
(1906, '01784442249', NULL, NULL, 1),
(1907, '01740157431', NULL, NULL, 1),
(1908, '01724355540', NULL, NULL, 1),
(1909, '01788566313', NULL, NULL, 1),
(1910, '01714725220', NULL, NULL, 1),
(1911, '01759237148', NULL, NULL, 1),
(1912, '01601524914', NULL, NULL, 1),
(1913, '01753116914', NULL, NULL, 1),
(1914, '01770215659', NULL, NULL, 1),
(1915, '01719189527', NULL, NULL, 1),
(1916, '01305519477', NULL, NULL, 1),
(1917, '01769323706', NULL, NULL, 1),
(1918, '01727316009', NULL, NULL, 1),
(1919, '01862322644', NULL, NULL, 1),
(1920, '01734823753', NULL, NULL, 1),
(1921, '01706188448', NULL, NULL, 1),
(1922, '01712854511', NULL, NULL, 1),
(1923, '01745879871', NULL, NULL, 1),
(1924, '01735928640', NULL, NULL, 1),
(1925, '', NULL, NULL, 1),
(1926, '', NULL, NULL, 1),
(1927, '', NULL, NULL, 1),
(1928, '', NULL, NULL, 1),
(1929, '', NULL, NULL, 1),
(1930, '', NULL, NULL, 1),
(1931, '', NULL, NULL, 1),
(1932, '', NULL, NULL, 1),
(1933, '', NULL, NULL, 1),
(1934, '', NULL, NULL, 1),
(1935, '', NULL, NULL, 1),
(1936, '', NULL, NULL, 1),
(1937, '', NULL, NULL, 1),
(1970, '', NULL, NULL, 1),
(1973, '', NULL, NULL, 1),
(2503, '', NULL, NULL, 1),
(2504, '', NULL, NULL, 1),
(2505, '', NULL, NULL, 1),
(2506, '', NULL, NULL, 1),
(2507, '', NULL, NULL, 1),
(2508, '', NULL, NULL, 1),
(2509, '', NULL, NULL, 1),
(2510, '', NULL, NULL, 1),
(2511, '', NULL, NULL, 1),
(2512, '', NULL, NULL, 1),
(2513, '', NULL, NULL, 1),
(2514, '', NULL, NULL, 1),
(2515, '', NULL, NULL, 1),
(2516, '', NULL, NULL, 1),
(2517, '', NULL, NULL, 1),
(2518, '', NULL, NULL, 1),
(2519, '', NULL, NULL, 1),
(2520, '', NULL, NULL, 1),
(2521, '', NULL, NULL, 1),
(2522, '', NULL, NULL, 1),
(2523, '', NULL, NULL, 1),
(2524, '', NULL, NULL, 1),
(2525, '', NULL, NULL, 1),
(2526, '', NULL, NULL, 1),
(2527, '', NULL, NULL, 1),
(2528, '', NULL, NULL, 1),
(2529, '', NULL, NULL, 1),
(2530, '', NULL, NULL, 1),
(2531, '', NULL, NULL, 1),
(2532, '', NULL, NULL, 1),
(2533, '', NULL, NULL, 1),
(2534, '', NULL, NULL, 1),
(2535, '', NULL, NULL, 1),
(2536, '', NULL, NULL, 1),
(2537, '', NULL, NULL, 1),
(2538, '', NULL, NULL, 1),
(2539, '', NULL, NULL, 1),
(2540, '', NULL, NULL, 1),
(2541, '', NULL, NULL, 1),
(2542, '', NULL, NULL, 1),
(2543, '', NULL, NULL, 1),
(2544, '', NULL, NULL, 1),
(2545, '', NULL, NULL, 1),
(2546, '', NULL, NULL, 1),
(2547, '', NULL, NULL, 1),
(2548, '', NULL, NULL, 1),
(2549, '', NULL, NULL, 1),
(2550, '', NULL, NULL, 1),
(2551, '', NULL, NULL, 1),
(2552, '', NULL, NULL, 1),
(2553, '', NULL, NULL, 1),
(2554, '', NULL, NULL, 1),
(2555, '', NULL, NULL, 1),
(2556, '', NULL, NULL, 1),
(2557, '', NULL, NULL, 1),
(2558, '', NULL, NULL, 1),
(2559, '', NULL, NULL, 1),
(2560, '', NULL, NULL, 1),
(2561, '', NULL, NULL, 1),
(2562, '', NULL, NULL, 1),
(2563, '', NULL, NULL, 1),
(2564, '', NULL, NULL, 1),
(2565, '', NULL, NULL, 1),
(2566, '', NULL, NULL, 1),
(2567, '', NULL, NULL, 1),
(2568, '', NULL, NULL, 1),
(2569, '', NULL, NULL, 1),
(2570, '', NULL, NULL, 1),
(2571, '', NULL, NULL, 1),
(2572, '', NULL, NULL, 1),
(2573, '', NULL, NULL, 1),
(2574, '', NULL, NULL, 1),
(2575, '', NULL, NULL, 1),
(2576, '', NULL, NULL, 1),
(2577, '', NULL, NULL, 1),
(2578, '', NULL, NULL, 1),
(2579, '', NULL, NULL, 1),
(2580, '', NULL, NULL, 1),
(2581, '', NULL, NULL, 1),
(2582, '', NULL, NULL, 1),
(2583, '', NULL, NULL, 1),
(2584, '', NULL, NULL, 1),
(2585, '', NULL, NULL, 1),
(2586, '', NULL, NULL, 1),
(2587, '', NULL, NULL, 1),
(2588, '', NULL, NULL, 1),
(2589, '', NULL, NULL, 1),
(2590, '', NULL, NULL, 1),
(2591, '', NULL, NULL, 1),
(2592, '', NULL, NULL, 1),
(2593, '', NULL, NULL, 1),
(2594, '', NULL, NULL, 1),
(2595, '', NULL, NULL, 1),
(2596, '', NULL, NULL, 1),
(2597, '', NULL, NULL, 1),
(2598, '', NULL, NULL, 1),
(2599, '', NULL, NULL, 1),
(2600, '', NULL, NULL, 1),
(2601, '', NULL, NULL, 1),
(2602, '', NULL, NULL, 1),
(2603, '', NULL, NULL, 1),
(2604, '', NULL, NULL, 1),
(2605, '', NULL, NULL, 1),
(2606, '', NULL, NULL, 1),
(2607, '', NULL, NULL, 1),
(2608, '', NULL, NULL, 1),
(2609, '', NULL, NULL, 1),
(2610, '', NULL, NULL, 1),
(2611, '', NULL, NULL, 1),
(2612, '', NULL, NULL, 1),
(2613, '', NULL, NULL, 1),
(2614, '', NULL, NULL, 1),
(2615, '', NULL, NULL, 1),
(2616, '', NULL, NULL, 1),
(2617, '', NULL, NULL, 1),
(2618, '', NULL, NULL, 1),
(2619, '', NULL, NULL, 1),
(2620, '', NULL, NULL, 1),
(2621, '', NULL, NULL, 1),
(2622, '', NULL, NULL, 1),
(2623, '', NULL, NULL, 1),
(2624, '', NULL, NULL, 1),
(2625, '', NULL, NULL, 1),
(2626, '', NULL, NULL, 1),
(2627, '', NULL, NULL, 1),
(2628, '', NULL, NULL, 1),
(2629, '', NULL, NULL, 1),
(2630, '', NULL, NULL, 1),
(2631, '', NULL, NULL, 1),
(2632, '', NULL, NULL, 1),
(2633, '', NULL, NULL, 1),
(2634, '', NULL, NULL, 1),
(2635, '', NULL, NULL, 1),
(2636, '', NULL, NULL, 1),
(2637, '', NULL, NULL, 1),
(2638, '', NULL, NULL, 1),
(2639, '', NULL, NULL, 1),
(2640, '', NULL, NULL, 1),
(2641, '', NULL, NULL, 1),
(2642, '', NULL, NULL, 1),
(2643, '', NULL, NULL, 1),
(2644, '', NULL, NULL, 1),
(2645, '', NULL, NULL, 1),
(2646, '', NULL, NULL, 1),
(2647, '', NULL, NULL, 1),
(2648, '', NULL, NULL, 1),
(2649, '', NULL, NULL, 1),
(2650, '', NULL, NULL, 1),
(2651, '', NULL, NULL, 1),
(2652, '', NULL, NULL, 1),
(2653, '', NULL, NULL, 1),
(2654, '', NULL, NULL, 1),
(2655, '', NULL, NULL, 1),
(2656, '', NULL, NULL, 1),
(2657, '', NULL, NULL, 1),
(2658, '', NULL, NULL, 1),
(2659, '', NULL, NULL, 1),
(2660, '', NULL, NULL, 1),
(2661, '', NULL, NULL, 1),
(2662, '', NULL, NULL, 1),
(2663, '', NULL, NULL, 1),
(2664, '', NULL, NULL, 1),
(2665, '', NULL, NULL, 1),
(2666, '', NULL, NULL, 1),
(2667, '', NULL, NULL, 1),
(2668, '', NULL, NULL, 1),
(2669, '', NULL, NULL, 1),
(2670, '', NULL, NULL, 1),
(2671, '', NULL, NULL, 1),
(2672, '', NULL, NULL, 1),
(2673, '', NULL, NULL, 1),
(2674, '', NULL, NULL, 1),
(2675, '', NULL, NULL, 1),
(2676, '', NULL, NULL, 1),
(2677, '', NULL, NULL, 1),
(2678, '', NULL, NULL, 1),
(2679, '', NULL, NULL, 1),
(2680, '', NULL, NULL, 1),
(2681, '', NULL, NULL, 1),
(2682, '', NULL, NULL, 1),
(2683, '', NULL, NULL, 1),
(2684, '', NULL, NULL, 1),
(2685, '', NULL, NULL, 1),
(2686, '', NULL, NULL, 1),
(2687, '', NULL, NULL, 1),
(2688, '', NULL, NULL, 1),
(2689, '', NULL, NULL, 1),
(2690, '', NULL, NULL, 1),
(2691, '', NULL, NULL, 1),
(2692, '', NULL, NULL, 1),
(2693, '', NULL, NULL, 1),
(2694, '', NULL, NULL, 1),
(2695, '', NULL, NULL, 1),
(2696, '', NULL, NULL, 1),
(2697, '', NULL, NULL, 1),
(2698, '', NULL, NULL, 1),
(2699, '', NULL, NULL, 1),
(2700, '', NULL, NULL, 1),
(2701, '', NULL, NULL, 1),
(2702, '', NULL, NULL, 1),
(2703, '', NULL, NULL, 1),
(2704, '', NULL, NULL, 1),
(2705, '', NULL, NULL, 1),
(2706, '', NULL, NULL, 1),
(2707, '', NULL, NULL, 1),
(2708, '', NULL, NULL, 1),
(2709, '', NULL, NULL, 1),
(2710, '', NULL, NULL, 1),
(2711, '', NULL, NULL, 1),
(2712, '', NULL, NULL, 1),
(2713, '', NULL, NULL, 1),
(2714, '', NULL, NULL, 1),
(2715, '', NULL, NULL, 1),
(2716, '', NULL, NULL, 1),
(2717, '', NULL, NULL, 1),
(2718, '', NULL, NULL, 1),
(2719, '', NULL, NULL, 1),
(2720, '', NULL, NULL, 1),
(2721, '', NULL, NULL, 1),
(2722, '', NULL, NULL, 1),
(2723, '', NULL, NULL, 1),
(2724, '', NULL, NULL, 1),
(2725, '', NULL, NULL, 1),
(2726, '', NULL, NULL, 1),
(2727, '', NULL, NULL, 1),
(2728, '', NULL, NULL, 1),
(2729, '', NULL, NULL, 1),
(2730, '', NULL, NULL, 1),
(2731, '', NULL, NULL, 1),
(2732, '', NULL, NULL, 1),
(2733, '', NULL, NULL, 1),
(2734, '', NULL, NULL, 1),
(2735, '', NULL, NULL, 1),
(2736, '', NULL, NULL, 1),
(2737, '', NULL, NULL, 1),
(2738, '', NULL, NULL, 1),
(2739, '', NULL, NULL, 1),
(2740, '', NULL, NULL, 1),
(2741, '', NULL, NULL, 1),
(2742, '', NULL, NULL, 1),
(2743, '', NULL, NULL, 1),
(2744, '', NULL, NULL, 1),
(2745, '', NULL, NULL, 1),
(2746, '', NULL, NULL, 1),
(2747, '', NULL, NULL, 1),
(2748, '', NULL, NULL, 1),
(2749, '', NULL, NULL, 1),
(2750, '', NULL, NULL, 1),
(2751, '', NULL, NULL, 1),
(2752, '', NULL, NULL, 1),
(2753, '', NULL, NULL, 1),
(2754, '', NULL, NULL, 1),
(2755, '', NULL, NULL, 1),
(2756, '', NULL, NULL, 1),
(2757, '', NULL, NULL, 1),
(2758, '', NULL, NULL, 1),
(2759, '', NULL, NULL, 1),
(2760, '', NULL, NULL, 1),
(2761, '', NULL, NULL, 1),
(2762, '', NULL, NULL, 1),
(2763, '', NULL, NULL, 1),
(2764, '', NULL, NULL, 1),
(2765, '', NULL, NULL, 1),
(2766, '', NULL, NULL, 1),
(2767, '', NULL, NULL, 1),
(2768, '', NULL, NULL, 1),
(2769, '', NULL, NULL, 1),
(2770, '', NULL, NULL, 1),
(2771, '', NULL, NULL, 1),
(2772, '', NULL, NULL, 1),
(2773, '', NULL, NULL, 1),
(2774, '', NULL, NULL, 1),
(2775, '', NULL, NULL, 1),
(2776, '', NULL, NULL, 1),
(2777, '', NULL, NULL, 1),
(2778, '', NULL, NULL, 1),
(2779, '', NULL, NULL, 1),
(2780, '', NULL, NULL, 1),
(2781, '', NULL, NULL, 1),
(2782, '', NULL, NULL, 1),
(2783, '01742668418', NULL, NULL, 1),
(2784, '01733732458', NULL, NULL, 1),
(2785, '01732532935', NULL, NULL, 1),
(2786, '01854797035', NULL, NULL, 1),
(2787, '01703284125', NULL, NULL, 1),
(2788, '01704767669', NULL, NULL, 1),
(2789, '01704655693', NULL, NULL, 1),
(2790, '01755385384', NULL, NULL, 1),
(2791, '01304282893', NULL, NULL, 1),
(2792, '01796480802', NULL, NULL, 1),
(2793, '01749850670', NULL, NULL, 1),
(2794, '01772423173', NULL, NULL, 1),
(2795, '01856288632', NULL, NULL, 1),
(2796, '01785064437', NULL, NULL, 1),
(2797, '01645617890', NULL, NULL, 1),
(2798, '01718978681', NULL, NULL, 1),
(2799, '01724972733', NULL, NULL, 1),
(2800, '01771697969', NULL, NULL, 1),
(2801, '01768635062', NULL, NULL, 1),
(2802, '01739019943', NULL, NULL, 1),
(2803, '01722382254', NULL, NULL, 1),
(2804, '01889451783', NULL, NULL, 1),
(2805, '01780137572', NULL, NULL, 1),
(2806, '01789170099', NULL, NULL, 1),
(2807, '01620365809', NULL, NULL, 1),
(2808, '01789790917', NULL, NULL, 1),
(2809, '01737847606', NULL, NULL, 1),
(2810, '1301762406', NULL, NULL, 1),
(2811, '01739808040', NULL, NULL, 1),
(2812, '01773183956', NULL, NULL, 1),
(2813, '01752402947', NULL, NULL, 1),
(2814, '01759452641', NULL, NULL, 1),
(2815, '01794244155', NULL, NULL, 1),
(2816, '01731334605', NULL, NULL, 1),
(2817, '01790388649', NULL, NULL, 1),
(2818, '01743179980', NULL, NULL, 1),
(2819, '01705562130', NULL, NULL, 1),
(2820, '01724243998', NULL, NULL, 1),
(2821, '01779208401', NULL, NULL, 1),
(2822, '01317436992', NULL, NULL, 1),
(2823, '01312124709', NULL, NULL, 1),
(2824, '1779421668', NULL, NULL, 1),
(2825, '01765217398', NULL, NULL, 1),
(2826, '01782807537', NULL, NULL, 1),
(2827, '01793931714', NULL, NULL, 1),
(2828, '01742795883', NULL, NULL, 1),
(2829, '01778962065', NULL, NULL, 1),
(2830, '01778962065', NULL, NULL, 1),
(2831, '01739970839', NULL, NULL, 1),
(2832, '01797862779', NULL, NULL, 1),
(2833, '01797862617', NULL, NULL, 1),
(2834, '01305368668', NULL, NULL, 1),
(2835, '01314417371', NULL, NULL, 1),
(2836, '01724760159', NULL, NULL, 1),
(2837, '01715235138', NULL, NULL, 1),
(2838, '01746861138', NULL, NULL, 1),
(2839, '01723190982', NULL, NULL, 1),
(2840, '01775947320', NULL, NULL, 1),
(2841, '01752136099', NULL, NULL, 1),
(2842, '01748195330', NULL, NULL, 1),
(2843, '01724759893', NULL, NULL, 1),
(2844, '01731423681', NULL, NULL, 1),
(2845, '01761507413', NULL, NULL, 1),
(2846, '01782331903', NULL, NULL, 1),
(2847, '01775768479', NULL, NULL, 1),
(2848, '01727581487', NULL, NULL, 1),
(2849, '01775975605', NULL, NULL, 1),
(2850, '01741612590', NULL, NULL, 1),
(2851, '01735020141', NULL, NULL, 1),
(2852, '01724689515', NULL, NULL, 1),
(2853, '01743402819', NULL, NULL, 1),
(2854, '01730622894', NULL, NULL, 1),
(2855, '01791289812', NULL, NULL, 1),
(2856, '01778537121', NULL, NULL, 1),
(2857, '01701370396', NULL, NULL, 1),
(2858, '01772539903', NULL, NULL, 1),
(2859, '01762054570', NULL, NULL, 1),
(2860, '01728548819', NULL, NULL, 1),
(2861, '01744143586', NULL, NULL, 1),
(2862, '01315808639', NULL, NULL, 1),
(2863, '01725868584', NULL, NULL, 1),
(2864, '0179930523', NULL, NULL, 1),
(2865, '', NULL, NULL, 1),
(2866, '01780204253', NULL, NULL, 1),
(2867, '01758428404', NULL, NULL, 1),
(2868, '01770577805', NULL, NULL, 1),
(2869, '01759665771', NULL, NULL, 1),
(2870, '01701788567', NULL, NULL, 1),
(2871, '', NULL, NULL, 1),
(2872, '', NULL, NULL, 1),
(2873, '', NULL, NULL, 1),
(2874, '', NULL, NULL, 1),
(2875, '', NULL, NULL, 1),
(2876, '', NULL, NULL, 1),
(2877, '', NULL, NULL, 1),
(2878, '', NULL, NULL, 1),
(2879, '', NULL, NULL, 1),
(2880, '', NULL, NULL, 1),
(2881, '', NULL, NULL, 1),
(2882, '', NULL, NULL, 1),
(2883, '', NULL, NULL, 1),
(2884, '', NULL, NULL, 1),
(2885, '', NULL, NULL, 1),
(2886, '', NULL, NULL, 1),
(2887, '', NULL, NULL, 1),
(3158, '', NULL, NULL, 1),
(3159, '', NULL, NULL, 1),
(3160, '', NULL, NULL, 1),
(3161, '', NULL, NULL, 1),
(3162, '', NULL, NULL, 1),
(3163, '', NULL, NULL, 1),
(3164, '', NULL, NULL, 1),
(3165, '', NULL, NULL, 1),
(3166, '', NULL, NULL, 1),
(3167, '', NULL, NULL, 1),
(3168, '', NULL, NULL, 1),
(3169, '', NULL, NULL, 1),
(3170, '', NULL, NULL, 1),
(3171, '', NULL, NULL, 1),
(3172, '', NULL, NULL, 1),
(3173, '', NULL, NULL, 1),
(3174, '', NULL, NULL, 1),
(3175, '', NULL, NULL, 1),
(3176, '', NULL, NULL, 1),
(3177, '', NULL, NULL, 1),
(3178, '', NULL, NULL, 1),
(3179, '', NULL, NULL, 1),
(3180, '', NULL, NULL, 1),
(3181, '', NULL, NULL, 1),
(3182, '', NULL, NULL, 1),
(3183, '', NULL, NULL, 1),
(3184, '', NULL, NULL, 1),
(3185, '', NULL, NULL, 1),
(3186, '', NULL, NULL, 1),
(3187, '', NULL, NULL, 1),
(3188, '', NULL, NULL, 1),
(3189, '', NULL, NULL, 1),
(3190, '', NULL, NULL, 1),
(3191, '', NULL, NULL, 1),
(3192, '', NULL, NULL, 1),
(3193, '', NULL, NULL, 1),
(3194, '', NULL, NULL, 1),
(3195, '', NULL, NULL, 1),
(3196, '', NULL, NULL, 1),
(3197, '', NULL, NULL, 1),
(3198, '', NULL, NULL, 1),
(3199, '', NULL, NULL, 1),
(3200, '', NULL, NULL, 1),
(3201, '', NULL, NULL, 1),
(3202, '', NULL, NULL, 1),
(3203, '', NULL, NULL, 1),
(3204, '', NULL, NULL, 1),
(3205, '', NULL, NULL, 1),
(3206, '', NULL, NULL, 1),
(3207, '', NULL, NULL, 1),
(3208, '', NULL, NULL, 1),
(3209, '', NULL, NULL, 1),
(3210, '', NULL, NULL, 1),
(3211, '', NULL, NULL, 1),
(3212, '', NULL, NULL, 1),
(3213, '', NULL, NULL, 1),
(3214, '', NULL, NULL, 1),
(3215, '', NULL, NULL, 1),
(3216, '', NULL, NULL, 1),
(3217, '', NULL, NULL, 1),
(3218, '', NULL, NULL, 1),
(3219, '', NULL, NULL, 1),
(3220, '', NULL, NULL, 1),
(3221, '', NULL, NULL, 1),
(3222, '', NULL, NULL, 1),
(3223, '', NULL, NULL, 1),
(3224, '', NULL, NULL, 1),
(3225, '', NULL, NULL, 1),
(3226, '', NULL, NULL, 1),
(3227, '', NULL, NULL, 1),
(3228, '', NULL, NULL, 1),
(3229, '', NULL, NULL, 1),
(3230, '', NULL, NULL, 1),
(3231, '', NULL, NULL, 1),
(3232, '', NULL, NULL, 1),
(3233, '', NULL, NULL, 1),
(3234, '', NULL, NULL, 1),
(3235, '', NULL, NULL, 1),
(3236, '', NULL, NULL, 1),
(3237, '', NULL, NULL, 1),
(3238, '', NULL, NULL, 1),
(3239, '', NULL, NULL, 1),
(3240, '', NULL, NULL, 1),
(3241, '', NULL, NULL, 1),
(3242, '', NULL, NULL, 1),
(3243, '', NULL, NULL, 1),
(3244, '', NULL, NULL, 1),
(3245, '', NULL, NULL, 1),
(3246, '', NULL, NULL, 1),
(3309, '', NULL, NULL, 1),
(3310, '', NULL, NULL, 1),
(3311, '', NULL, NULL, 1),
(3312, '', NULL, NULL, 1),
(3313, '', NULL, NULL, 1),
(3314, '', NULL, NULL, 1),
(3315, '', NULL, NULL, 1),
(3316, '', NULL, NULL, 1),
(3317, '', NULL, NULL, 1),
(3318, '', NULL, NULL, 1),
(3319, '', NULL, NULL, 1),
(3320, '', NULL, NULL, 1),
(3321, '', NULL, NULL, 1),
(3322, '', NULL, NULL, 1),
(3323, '', NULL, NULL, 1),
(3324, '', NULL, NULL, 1),
(3325, '', NULL, NULL, 1),
(3326, '', NULL, NULL, 1),
(3327, '', NULL, NULL, 1),
(3328, '', NULL, NULL, 1),
(3329, '', NULL, NULL, 1),
(3330, '', NULL, NULL, 1),
(3331, '', NULL, NULL, 1),
(3332, '', NULL, NULL, 1),
(3333, '', NULL, NULL, 1),
(3334, '', NULL, NULL, 1),
(3335, '', NULL, NULL, 1),
(3336, '', NULL, NULL, 1),
(3337, '', NULL, NULL, 1),
(3338, '', NULL, NULL, 1),
(3339, '', NULL, NULL, 1),
(3340, '', NULL, NULL, 1),
(3341, '', NULL, NULL, 1),
(3342, '', NULL, NULL, 1),
(3343, '', NULL, NULL, 1),
(3344, '', NULL, NULL, 1),
(3345, '', NULL, NULL, 1),
(3346, '', NULL, NULL, 1),
(3347, '', NULL, NULL, 1),
(3348, '', NULL, NULL, 1),
(3349, '', NULL, NULL, 1),
(3350, '', NULL, NULL, 1),
(3351, '', NULL, NULL, 1),
(3352, '', NULL, NULL, 1),
(3353, '', NULL, NULL, 1),
(3354, '', NULL, NULL, 1);
INSERT INTO `scms_student` (`id`, `phone`, `email`, `password`, `vtype`) VALUES
(3355, '', NULL, NULL, 1),
(3356, '', NULL, NULL, 1),
(3357, '', NULL, NULL, 1),
(3358, '', NULL, NULL, 1),
(3359, '', NULL, NULL, 1),
(3360, '', NULL, NULL, 1),
(3361, '', NULL, NULL, 1),
(3362, '', NULL, NULL, 1),
(3363, '', NULL, NULL, 1),
(3364, '', NULL, NULL, 1),
(3365, '', NULL, NULL, 1),
(3366, '', NULL, NULL, 1),
(3367, '', NULL, NULL, 1),
(3368, '', NULL, NULL, 1),
(3369, '', NULL, NULL, 1),
(3370, '', NULL, NULL, 1),
(3626, '', NULL, NULL, 1),
(3627, '', NULL, NULL, 1),
(3628, '', NULL, NULL, 1),
(3629, '', NULL, NULL, 1),
(3630, '', NULL, NULL, 1),
(3631, '', NULL, NULL, 1),
(3632, '', NULL, NULL, 1),
(3633, '', NULL, NULL, 1),
(3634, '', NULL, NULL, 1),
(3635, '', NULL, NULL, 1),
(3636, '', NULL, NULL, 1),
(3637, '', NULL, NULL, 1),
(3638, '', NULL, NULL, 1),
(3639, '', NULL, NULL, 1),
(3640, '', NULL, NULL, 1),
(3641, '', NULL, NULL, 1),
(3642, '', NULL, NULL, 1),
(3643, '', NULL, NULL, 1),
(3644, '', NULL, NULL, 1),
(3645, '', NULL, NULL, 1),
(3646, '', NULL, NULL, 1),
(3647, '', NULL, NULL, 1),
(3648, '', NULL, NULL, 1),
(3649, '', NULL, NULL, 1),
(3650, '', NULL, NULL, 1),
(3651, '', NULL, NULL, 1),
(3652, '', NULL, NULL, 1),
(3653, '', NULL, NULL, 1),
(3654, '', NULL, NULL, 1),
(3655, '', NULL, NULL, 1),
(3656, '', NULL, NULL, 1),
(3657, '', NULL, NULL, 1),
(3658, '', NULL, NULL, 1),
(3659, '', NULL, NULL, 1),
(3660, '', NULL, NULL, 1),
(3661, '', NULL, NULL, 1),
(3662, '', NULL, NULL, 1),
(3663, '', NULL, NULL, 1),
(3664, '', NULL, NULL, 1),
(3665, '', NULL, NULL, 1),
(3666, '', NULL, NULL, 1),
(3667, '', NULL, NULL, 1),
(3668, '', NULL, NULL, 1),
(3669, '', NULL, NULL, 1),
(3670, '', NULL, NULL, 1),
(3671, '', NULL, NULL, 1),
(3672, '', NULL, NULL, 1),
(3673, '', NULL, NULL, 1),
(3674, '', NULL, NULL, 1),
(3675, '', NULL, NULL, 1),
(3676, '', NULL, NULL, 1),
(3677, '', NULL, NULL, 1),
(3678, '', NULL, NULL, 1),
(3679, '', NULL, NULL, 1),
(3680, '', NULL, NULL, 1),
(3681, '', NULL, NULL, 1),
(3682, '', NULL, NULL, 1),
(3683, '', NULL, NULL, 1),
(3684, '', NULL, NULL, 1),
(3685, '', NULL, NULL, 1),
(3686, '', NULL, NULL, 1),
(3687, '', NULL, NULL, 1),
(3688, '', NULL, NULL, 1),
(3689, '', NULL, NULL, 1),
(3690, '', NULL, NULL, 1),
(3691, '', NULL, NULL, 1),
(3692, '', NULL, NULL, 1),
(3693, '', NULL, NULL, 1),
(3694, '', NULL, NULL, 1),
(3695, '', NULL, NULL, 1),
(3696, '', NULL, NULL, 1),
(3697, '', NULL, NULL, 1),
(3698, '', NULL, NULL, 1),
(3699, '', NULL, NULL, 1),
(3700, '', NULL, NULL, 1),
(3701, '', NULL, NULL, 1),
(3702, '', NULL, NULL, 1),
(3703, '', NULL, NULL, 1),
(3704, '', NULL, NULL, 1),
(3705, '', NULL, NULL, 1),
(3706, '', NULL, NULL, 1),
(3707, '', NULL, NULL, 1),
(3708, '', NULL, NULL, 1),
(3709, '', NULL, NULL, 1),
(3710, '', NULL, NULL, 1),
(3711, '', NULL, NULL, 1),
(3712, '', NULL, NULL, 1),
(3713, '', NULL, NULL, 1),
(3714, '', NULL, NULL, 1),
(3715, '', NULL, NULL, 1),
(3716, '', NULL, NULL, 1),
(3717, '', NULL, NULL, 1),
(3718, '', NULL, NULL, 1),
(3719, '', NULL, NULL, 1),
(3720, '', NULL, NULL, 1),
(3721, '', NULL, NULL, 1),
(3722, '', NULL, NULL, 1),
(3723, '', NULL, NULL, 1),
(3724, '', NULL, NULL, 1),
(3725, '', NULL, NULL, 1),
(3726, '', NULL, NULL, 1),
(3727, '', NULL, NULL, 1),
(3728, '', NULL, NULL, 1),
(3729, '', NULL, NULL, 1),
(3730, '', NULL, NULL, 1),
(3731, '', NULL, NULL, 1),
(3732, '', NULL, NULL, 1),
(3733, '', NULL, NULL, 1),
(3734, '', NULL, NULL, 1),
(3735, '', NULL, NULL, 1),
(3736, '', NULL, NULL, 1),
(3737, '', NULL, NULL, 1),
(3738, '', NULL, NULL, 1),
(3739, '', NULL, NULL, 1),
(3740, '', NULL, NULL, 1),
(3741, '', NULL, NULL, 1),
(3742, '', NULL, NULL, 1),
(3743, '', NULL, NULL, 1),
(3744, '', NULL, NULL, 1),
(3745, '', NULL, NULL, 1),
(3746, '', NULL, NULL, 1),
(3747, '', NULL, NULL, 1),
(3748, '', NULL, NULL, 1),
(3749, '', NULL, NULL, 1),
(3750, '', NULL, NULL, 1),
(3751, '', NULL, NULL, 1),
(3752, '', NULL, NULL, 1),
(3753, '', NULL, NULL, 1),
(3754, '', NULL, NULL, 1),
(3755, '', NULL, NULL, 1),
(3756, '', NULL, NULL, 1),
(3757, '', NULL, NULL, 1),
(3758, '', NULL, NULL, 1),
(3759, '', NULL, NULL, 1),
(3760, '', NULL, NULL, 1),
(3761, '', NULL, NULL, 1),
(3762, '', NULL, NULL, 1),
(3763, '', NULL, NULL, 1),
(3764, '', NULL, NULL, 1),
(3765, '', NULL, NULL, 1),
(3766, '', NULL, NULL, 1),
(3767, '', NULL, NULL, 1),
(3768, '', NULL, NULL, 1),
(3769, '', NULL, NULL, 1),
(3770, '', NULL, NULL, 1),
(3771, '', NULL, NULL, 1),
(3772, '', NULL, NULL, 1),
(3773, '', NULL, NULL, 1),
(3774, '', NULL, NULL, 1),
(3775, '', NULL, NULL, 1),
(3776, '', NULL, NULL, 1),
(3777, '', NULL, NULL, 1),
(3778, '', NULL, NULL, 1),
(3779, '', NULL, NULL, 1),
(3780, '', NULL, NULL, 1),
(3781, '', NULL, NULL, 1),
(3782, '', NULL, NULL, 1),
(3783, '', NULL, NULL, 1),
(3784, '', NULL, NULL, 1),
(3785, '', NULL, NULL, 1),
(3786, '', NULL, NULL, 1),
(3787, '', NULL, NULL, 1),
(3788, '', NULL, NULL, 1),
(3789, '', NULL, NULL, 1),
(3790, '', NULL, NULL, 1),
(3791, '', NULL, NULL, 1),
(3792, '', NULL, NULL, 1),
(3793, '', NULL, NULL, 1),
(3794, '', NULL, NULL, 1),
(3795, '', NULL, NULL, 1),
(3796, '', NULL, NULL, 1),
(3797, '', NULL, NULL, 1),
(3798, '', NULL, NULL, 1),
(3799, '', NULL, NULL, 1),
(3800, '', NULL, NULL, 1),
(3801, '', NULL, NULL, 1),
(3802, '', NULL, NULL, 1),
(3803, '', NULL, NULL, 1),
(3804, '', NULL, NULL, 1),
(3805, '', NULL, NULL, 1),
(3806, '', NULL, NULL, 1),
(3807, '', NULL, NULL, 1),
(3808, '', NULL, NULL, 1),
(3809, '', NULL, NULL, 1),
(3810, '', NULL, NULL, 1),
(3811, '', NULL, NULL, 1),
(3812, '', NULL, NULL, 1),
(3813, '', NULL, NULL, 1),
(3814, '', NULL, NULL, 1),
(3815, '', NULL, NULL, 1),
(3816, '', NULL, NULL, 1),
(3817, '', NULL, NULL, 1),
(3818, '', NULL, NULL, 1),
(3819, '', NULL, NULL, 1),
(3820, '', NULL, NULL, 1),
(3821, '', NULL, NULL, 1),
(3822, '', NULL, NULL, 1),
(3823, '', NULL, NULL, 1),
(3824, '', NULL, NULL, 1),
(3825, '', NULL, NULL, 1),
(3826, '', NULL, NULL, 1),
(3827, '', NULL, NULL, 1),
(3828, '', NULL, NULL, 1),
(3829, '', NULL, NULL, 1),
(3830, '', NULL, NULL, 1),
(3831, '', NULL, NULL, 1),
(3832, '', NULL, NULL, 1),
(3833, '', NULL, NULL, 1),
(3834, '', NULL, NULL, 1),
(3835, '', NULL, NULL, 1),
(3836, '', NULL, NULL, 1),
(3837, '', NULL, NULL, 1),
(3838, '', NULL, NULL, 1),
(3839, '', NULL, NULL, 1),
(3840, '', NULL, NULL, 1),
(3841, '', NULL, NULL, 1),
(3842, '', NULL, NULL, 1),
(3843, '', NULL, NULL, 1),
(3844, '', NULL, NULL, 1),
(3845, '', NULL, NULL, 1),
(3846, '', NULL, NULL, 1),
(3847, '', NULL, NULL, 1),
(3848, '', NULL, NULL, 1),
(3849, '', NULL, NULL, 1),
(3850, '', NULL, NULL, 1),
(3851, '', NULL, NULL, 1),
(3852, '', NULL, NULL, 1),
(3853, '', NULL, NULL, 1),
(3854, '', NULL, NULL, 1),
(3855, '', NULL, NULL, 1),
(3856, '', NULL, NULL, 1),
(3857, '', NULL, NULL, 1),
(3858, '', NULL, NULL, 1),
(3859, '', NULL, NULL, 1),
(3860, '', NULL, NULL, 1),
(3861, '', NULL, NULL, 1),
(3862, '', NULL, NULL, 1),
(3863, '', NULL, NULL, 1),
(3864, '', NULL, NULL, 1),
(3865, '', NULL, NULL, 1),
(3866, '', NULL, NULL, 1),
(3867, '', NULL, NULL, 1),
(3868, '', NULL, NULL, 1),
(3869, '', NULL, NULL, 1),
(3870, '', NULL, NULL, 1),
(3871, '', NULL, NULL, 1),
(3872, '', NULL, NULL, 1),
(3873, '', NULL, NULL, 1),
(3874, '', NULL, NULL, 1),
(3875, '', NULL, NULL, 1),
(3876, '', NULL, NULL, 1),
(3877, '', NULL, NULL, 1),
(3878, '', NULL, NULL, 1),
(3879, '', NULL, NULL, 1),
(3880, '', NULL, NULL, 1),
(3881, '', NULL, NULL, 1),
(3882, '', NULL, NULL, 1),
(3883, '', NULL, NULL, 1),
(3884, '', NULL, NULL, 1),
(3885, '', NULL, NULL, 1),
(3886, '', NULL, NULL, 1),
(3887, '', NULL, NULL, 1),
(3888, '', NULL, NULL, 1),
(3889, '', NULL, NULL, 1),
(3890, '', NULL, NULL, 1),
(3891, '', NULL, NULL, 1),
(3892, '', NULL, NULL, 1),
(3894, '', NULL, NULL, 1),
(3895, '', NULL, NULL, 1),
(3896, '', NULL, NULL, 1),
(3897, '', NULL, NULL, 1),
(3898, '', NULL, NULL, 1),
(3899, '', NULL, NULL, 1),
(3900, '', NULL, NULL, 1),
(3901, '', NULL, NULL, 1),
(3902, '', NULL, NULL, 1),
(3903, '', NULL, NULL, 1),
(3904, '', NULL, NULL, 1),
(3905, '', NULL, NULL, 1),
(3906, '', NULL, NULL, 1),
(3907, '', NULL, NULL, 1),
(3908, '', NULL, NULL, 1),
(3909, '', NULL, NULL, 1),
(3910, '', NULL, NULL, 1),
(3911, '', NULL, NULL, 1),
(3912, '', NULL, NULL, 1),
(3913, '', NULL, NULL, 1),
(3914, '', NULL, NULL, 1),
(3915, '', NULL, NULL, 1),
(3916, '', NULL, NULL, 1),
(3917, '', NULL, NULL, 1),
(3918, '', NULL, NULL, 1),
(3919, '', NULL, NULL, 1),
(3920, '', NULL, NULL, 1),
(3921, '', NULL, NULL, 1),
(3922, '', NULL, NULL, 1),
(3923, '', NULL, NULL, 1),
(3924, '', NULL, NULL, 1),
(3925, '', NULL, NULL, 1),
(3926, '', NULL, NULL, 1),
(3927, '', NULL, NULL, 1),
(3928, '', NULL, NULL, 1),
(3929, '', NULL, NULL, 1),
(3930, '', NULL, NULL, 1),
(3931, '', NULL, NULL, 1),
(3932, '', NULL, NULL, 1),
(3933, '', NULL, NULL, 1),
(3934, '', NULL, NULL, 1),
(3935, '', NULL, NULL, 1),
(3936, '', NULL, NULL, 1),
(3937, '', NULL, NULL, 1),
(3938, '', NULL, NULL, 1),
(3939, '', NULL, NULL, 1),
(3940, '', NULL, NULL, 1),
(3941, '', NULL, NULL, 1),
(3942, '', NULL, NULL, 1),
(3943, '', NULL, NULL, 1),
(3944, '', NULL, NULL, 1),
(3945, '', NULL, NULL, 1),
(3946, '', NULL, NULL, 1),
(3947, '', NULL, NULL, 1),
(3948, '', NULL, NULL, 1),
(3949, '', NULL, NULL, 1),
(3950, '', NULL, NULL, 1),
(3951, '', NULL, NULL, 1),
(3952, '', NULL, NULL, 1),
(3953, '', NULL, NULL, 1),
(3954, '', NULL, NULL, 1),
(3955, '', NULL, NULL, 1),
(3956, '', NULL, NULL, 1),
(3957, '', NULL, NULL, 1),
(3958, '', NULL, NULL, 1),
(3959, '', NULL, NULL, 1),
(3960, '', NULL, NULL, 1),
(3961, '', NULL, NULL, 1),
(3962, '', NULL, NULL, 1),
(3963, '', NULL, NULL, 1),
(3964, '', NULL, NULL, 1),
(3965, '', NULL, NULL, 1),
(3966, '', NULL, NULL, 1),
(3967, '', NULL, NULL, 1),
(3968, '', NULL, NULL, 1),
(3969, '', NULL, NULL, 1),
(3970, '', NULL, NULL, 1),
(3971, '', NULL, NULL, 1),
(3972, '', NULL, NULL, 1),
(3973, '', NULL, NULL, 1),
(3974, '', NULL, NULL, 1),
(3975, '', NULL, NULL, 1),
(3976, '', NULL, NULL, 1),
(3977, '', NULL, NULL, 1),
(3978, '', NULL, NULL, 1),
(3979, '', NULL, NULL, 1),
(3980, '', NULL, NULL, 1),
(3981, '', NULL, NULL, 1),
(3982, '', NULL, NULL, 1),
(3983, '', NULL, NULL, 1),
(3984, '', NULL, NULL, 1),
(3985, '', NULL, NULL, 1),
(3986, '', NULL, NULL, 1),
(3987, '', NULL, NULL, 1),
(3988, '', NULL, NULL, 1),
(3989, '', NULL, NULL, 1),
(3990, '', NULL, NULL, 1),
(3991, '', NULL, NULL, 1),
(3992, '', NULL, NULL, 1),
(3993, '', NULL, NULL, 1),
(3994, '', NULL, NULL, 1),
(3995, '', NULL, NULL, 1),
(3996, '', NULL, NULL, 1),
(3997, '', NULL, NULL, 1),
(3998, '', NULL, NULL, 1),
(3999, '', NULL, NULL, 1),
(4000, '', NULL, NULL, 1),
(4001, '', NULL, NULL, 1),
(4002, '', NULL, NULL, 1),
(4003, '', NULL, NULL, 1),
(4004, '', NULL, NULL, 1),
(4005, '', NULL, NULL, 1),
(4006, '', NULL, NULL, 1),
(4007, '', NULL, NULL, 1),
(4008, '', NULL, NULL, 1),
(4009, '', NULL, NULL, 1),
(4010, '', NULL, NULL, 1),
(4011, '', NULL, NULL, 1),
(4012, '', NULL, NULL, 1),
(4013, '', NULL, NULL, 1),
(4014, '', NULL, NULL, 1),
(4015, '', NULL, NULL, 1),
(4016, '', NULL, NULL, 1),
(4017, '', NULL, NULL, 1),
(4018, '', NULL, NULL, 1),
(4019, '', NULL, NULL, 1),
(4020, '', NULL, NULL, 1),
(4021, '', NULL, NULL, 1),
(4022, '', NULL, NULL, 1),
(4023, '', NULL, NULL, 1),
(4024, '', NULL, NULL, 1),
(4025, '', NULL, NULL, 1),
(4026, '', NULL, NULL, 1),
(4027, '', NULL, NULL, 1),
(4028, '', NULL, NULL, 1),
(4029, '', NULL, NULL, 1),
(4030, '', NULL, NULL, 1),
(4031, '', NULL, NULL, 1),
(4032, '', NULL, NULL, 1),
(4033, '', NULL, NULL, 1),
(4034, '', NULL, NULL, 1),
(4035, '', NULL, NULL, 1),
(4036, '', NULL, NULL, 1),
(4037, '', NULL, NULL, 1),
(4038, NULL, NULL, NULL, 1),
(4039, NULL, NULL, NULL, 1),
(4040, NULL, NULL, NULL, 1),
(4041, NULL, NULL, NULL, 1),
(4042, NULL, NULL, NULL, 1),
(4043, NULL, NULL, NULL, 1),
(4044, NULL, NULL, NULL, 1),
(4045, NULL, NULL, NULL, 1),
(4046, NULL, NULL, NULL, 1),
(4047, NULL, NULL, NULL, 1),
(4048, NULL, NULL, NULL, 1),
(4049, NULL, NULL, NULL, 1),
(4050, NULL, NULL, NULL, 1),
(4067, NULL, NULL, NULL, 1),
(4068, NULL, NULL, NULL, 1),
(4069, NULL, NULL, NULL, 1),
(4070, NULL, NULL, NULL, 1),
(4071, NULL, NULL, NULL, 1),
(4072, NULL, NULL, NULL, 1),
(4073, NULL, NULL, NULL, 1),
(4074, '', NULL, NULL, 1),
(4075, '', NULL, NULL, 1),
(4076, '', NULL, NULL, 1),
(4077, '', NULL, NULL, 1),
(4078, '', NULL, NULL, 1),
(4079, '', NULL, NULL, 1),
(4080, '', NULL, NULL, 1),
(4081, '', NULL, NULL, 1),
(4082, '', NULL, NULL, 1),
(4083, '', NULL, NULL, 1),
(4084, '', NULL, NULL, 1),
(4085, '', NULL, NULL, 1),
(4086, '', NULL, NULL, 1),
(4087, '', NULL, NULL, 1),
(4088, '', NULL, NULL, 1),
(4089, '', NULL, NULL, 1),
(4090, '', NULL, NULL, 1),
(4091, '', NULL, NULL, 1),
(4092, '', NULL, NULL, 1),
(4093, '', NULL, NULL, 1),
(4094, '', NULL, NULL, 1),
(4095, '', NULL, NULL, 1),
(4096, '', NULL, NULL, 1),
(4097, '', NULL, NULL, 1),
(4098, '', NULL, NULL, 1),
(4099, '', NULL, NULL, 1),
(4100, '', NULL, NULL, 1),
(4101, '', NULL, NULL, 1),
(4102, '', NULL, NULL, 1),
(4103, '', NULL, NULL, 1),
(4104, '', NULL, NULL, 1),
(4105, '', NULL, NULL, 1),
(4106, '', NULL, NULL, 1),
(4107, '', NULL, NULL, 1),
(4108, '', NULL, NULL, 1),
(4109, '', NULL, NULL, 1),
(4110, '', NULL, NULL, 1),
(4111, '', NULL, NULL, 1),
(4112, '', NULL, NULL, 1),
(4113, '', NULL, NULL, 1),
(4114, '', NULL, NULL, 1),
(4115, '', NULL, NULL, 1),
(4116, '', NULL, NULL, 1),
(4117, '', NULL, NULL, 1),
(4118, '', NULL, NULL, 1),
(4119, '', NULL, NULL, 1),
(4120, '', NULL, NULL, 1),
(4121, '', NULL, NULL, 1),
(4122, '', NULL, NULL, 1),
(4123, '', NULL, NULL, 1),
(4124, '', NULL, NULL, 1),
(4125, '', NULL, NULL, 1),
(4126, '', NULL, NULL, 1),
(4127, '', NULL, NULL, 1),
(4128, '', NULL, NULL, 1),
(4129, '', NULL, NULL, 1),
(4130, '', NULL, NULL, 1),
(4131, '', NULL, NULL, 1),
(4132, '', NULL, NULL, 1),
(4133, '', NULL, NULL, 1),
(4134, '', NULL, NULL, 1),
(4135, '', NULL, NULL, 1),
(4136, '', NULL, NULL, 1),
(4137, '', NULL, NULL, 1),
(4138, '', NULL, NULL, 1),
(4139, '', NULL, NULL, 1),
(4140, '', NULL, NULL, 1),
(4141, '', NULL, NULL, 1),
(4142, '', NULL, NULL, 1),
(4143, '', NULL, NULL, 1),
(4144, '', NULL, NULL, 1),
(4145, '', NULL, NULL, 1),
(4146, '', NULL, NULL, 1),
(4147, '', NULL, NULL, 1),
(4148, '', NULL, NULL, 1),
(4149, '', NULL, NULL, 1),
(4150, '', NULL, NULL, 1),
(4151, '', NULL, NULL, 1),
(4152, '', NULL, NULL, 1),
(4153, '', NULL, NULL, 1),
(4154, '', NULL, NULL, 1),
(4155, '', NULL, NULL, 1),
(4156, '', NULL, NULL, 1),
(4157, '', NULL, NULL, 1),
(4158, '', NULL, NULL, 1),
(4159, '', NULL, NULL, 1),
(4160, '', NULL, NULL, 1),
(4161, '', NULL, NULL, 1),
(4162, '', NULL, NULL, 1),
(4163, '', NULL, NULL, 1),
(4164, '', NULL, NULL, 1),
(4165, '', NULL, NULL, 1),
(4166, '', NULL, NULL, 1),
(4167, '', NULL, NULL, 1),
(4168, '', NULL, NULL, 1),
(4169, '', NULL, NULL, 1),
(4170, '', NULL, NULL, 1),
(4171, '', NULL, NULL, 1),
(4172, '', NULL, NULL, 1),
(4173, '', NULL, NULL, 1),
(4174, '', NULL, NULL, 1),
(4175, '', NULL, NULL, 1),
(4176, '', NULL, NULL, 1),
(4177, '', NULL, NULL, 1),
(4178, '', NULL, NULL, 1),
(4179, '', NULL, NULL, 1),
(4180, '', NULL, NULL, 1),
(4181, '', NULL, NULL, 1),
(4182, '', NULL, NULL, 1),
(4183, '', NULL, NULL, 1),
(4184, '', NULL, NULL, 1),
(4185, '', NULL, NULL, 1),
(4186, '', NULL, NULL, 1),
(4187, '', NULL, NULL, 1),
(4188, '', NULL, NULL, 1),
(4189, '', NULL, NULL, 1),
(4190, '', NULL, NULL, 1),
(4191, '', NULL, NULL, 1),
(4192, '', NULL, NULL, 1),
(4193, '', NULL, NULL, 1),
(4194, '', NULL, NULL, 1),
(4195, '', NULL, NULL, 1),
(4196, '', NULL, NULL, 1),
(4197, '', NULL, NULL, 1),
(4198, '', NULL, NULL, 1),
(4199, '', NULL, NULL, 1),
(4200, '', NULL, NULL, 1),
(4201, '', NULL, NULL, 1),
(4202, '', NULL, NULL, 1),
(4203, '', NULL, NULL, 1),
(4204, '', NULL, NULL, 1),
(4205, '', NULL, NULL, 1),
(4206, '', NULL, NULL, 1),
(4207, '', NULL, NULL, 1),
(4208, '', NULL, NULL, 1),
(4209, '', NULL, NULL, 1),
(4210, '', NULL, NULL, 1),
(4211, '', NULL, NULL, 1),
(4212, '', NULL, NULL, 1),
(4213, '', NULL, NULL, 1),
(4214, '', NULL, NULL, 1),
(4215, '', NULL, NULL, 1),
(4216, '', NULL, NULL, 1),
(4217, '', NULL, NULL, 1),
(4218, '', NULL, NULL, 1),
(4219, '', NULL, NULL, 1),
(4220, '', NULL, NULL, 1),
(4221, '', NULL, NULL, 1),
(4222, '', NULL, NULL, 1),
(4223, '', NULL, NULL, 1),
(4224, '', NULL, NULL, 1),
(4225, '', NULL, NULL, 1),
(4226, '', NULL, NULL, 1),
(4227, '', NULL, NULL, 1),
(4228, '', NULL, NULL, 1),
(4229, '', NULL, NULL, 1),
(4230, '', NULL, NULL, 1),
(4231, '', NULL, NULL, 1),
(4232, '', NULL, NULL, 1),
(4233, '', NULL, NULL, 1),
(4234, '', NULL, NULL, 1),
(4235, '', NULL, NULL, 1),
(4236, '', NULL, NULL, 1),
(4237, '', NULL, NULL, 1),
(4238, '', NULL, NULL, 1),
(4239, '', NULL, NULL, 1),
(4240, '', NULL, NULL, 1),
(4241, '', NULL, NULL, 1),
(4242, '', NULL, NULL, 1),
(4243, '', NULL, NULL, 1),
(4244, '', NULL, NULL, 1),
(4245, '', NULL, NULL, 1),
(4246, '', NULL, NULL, 1),
(4247, '', NULL, NULL, 1),
(4248, '', NULL, NULL, 1),
(4249, '', NULL, NULL, 1),
(4250, '', NULL, NULL, 1),
(4251, '', NULL, NULL, 1),
(4252, '', NULL, NULL, 1),
(4253, '', NULL, NULL, 1),
(4254, '', NULL, NULL, 1),
(4255, '', NULL, NULL, 1),
(4256, '', NULL, NULL, 1),
(4257, '', NULL, NULL, 1),
(4258, '', NULL, NULL, 1),
(4259, '', NULL, NULL, 1),
(4260, '', NULL, NULL, 1),
(4261, '', NULL, NULL, 1),
(4262, '', NULL, NULL, 1),
(4263, '', NULL, NULL, 1),
(4264, '', NULL, NULL, 1),
(4265, '', NULL, NULL, 1),
(4266, '', NULL, NULL, 1),
(4267, '', NULL, NULL, 1),
(4268, '', NULL, NULL, 1),
(4269, '', NULL, NULL, 1),
(4270, '', NULL, NULL, 1),
(4271, '', NULL, NULL, 1),
(4272, '', NULL, NULL, 1),
(4273, '', NULL, NULL, 1),
(4274, '', NULL, NULL, 1),
(4275, '', NULL, NULL, 1),
(4276, '', NULL, NULL, 1),
(4277, '', NULL, NULL, 1),
(4278, '', NULL, NULL, 1),
(4279, '', NULL, NULL, 1),
(4280, '', NULL, NULL, 1),
(4281, '', NULL, NULL, 1),
(4282, '', NULL, NULL, 1),
(4283, '', NULL, NULL, 1),
(4284, '', NULL, NULL, 1),
(4285, '', NULL, NULL, 1),
(4286, '', NULL, NULL, 1),
(4287, '', NULL, NULL, 1),
(4288, '', NULL, NULL, 1),
(4289, '', NULL, NULL, 1),
(4290, '', NULL, NULL, 1),
(4291, '', NULL, NULL, 1),
(4292, '', NULL, NULL, 1),
(4293, '', NULL, NULL, 1),
(4294, '', NULL, NULL, 1),
(4295, '', NULL, NULL, 1),
(4296, '', NULL, NULL, 1),
(4297, '', NULL, NULL, 1),
(4298, '', NULL, NULL, 1),
(4299, '', NULL, NULL, 1),
(4300, '', NULL, NULL, 1),
(4301, '', NULL, NULL, 1),
(4302, '', NULL, NULL, 1),
(4303, '', NULL, NULL, 1),
(4304, '', NULL, NULL, 1),
(4305, '', NULL, NULL, 1),
(4306, '', NULL, NULL, 1),
(4307, '', NULL, NULL, 1),
(4308, '', NULL, NULL, 1),
(4309, '', NULL, NULL, 1),
(4310, '', NULL, NULL, 1),
(4311, '', NULL, NULL, 1),
(4312, '', NULL, NULL, 1),
(4313, '', NULL, NULL, 1),
(4314, '', NULL, NULL, 1),
(4315, '', NULL, NULL, 1),
(4316, '', NULL, NULL, 1),
(4317, '', NULL, NULL, 1),
(4318, '', NULL, NULL, 1),
(4319, '', NULL, NULL, 1),
(4320, '', NULL, NULL, 1),
(4321, '', NULL, NULL, 1),
(4322, '', NULL, NULL, 1),
(4323, '', NULL, NULL, 1),
(4324, '', NULL, NULL, 1),
(4325, '', NULL, NULL, 1),
(4326, '', NULL, NULL, 1),
(4327, '', NULL, NULL, 1),
(4328, '', NULL, NULL, 1),
(4329, '', NULL, NULL, 1),
(4330, '', NULL, NULL, 1),
(4331, '', NULL, NULL, 1),
(4332, '', NULL, NULL, 1),
(4333, '', NULL, NULL, 1),
(4334, '', NULL, NULL, 1),
(4335, '', NULL, NULL, 1),
(4336, '', NULL, NULL, 1),
(4337, '', NULL, NULL, 1),
(4338, '', NULL, NULL, 1),
(4339, '', NULL, NULL, 1),
(4340, '', NULL, NULL, 1),
(4341, '', NULL, NULL, 1),
(4342, '', NULL, NULL, 1),
(4343, '', NULL, NULL, 1),
(4344, '', NULL, NULL, 1),
(4345, '', NULL, NULL, 1),
(4346, '', NULL, NULL, 1),
(4347, '', NULL, NULL, 1),
(4348, '', NULL, NULL, 1),
(4349, '', NULL, NULL, 1),
(4350, '', NULL, NULL, 1),
(4351, '', NULL, NULL, 1),
(4352, '', NULL, NULL, 1),
(4353, '', NULL, NULL, 1),
(4354, '', NULL, NULL, 1),
(4355, '', NULL, NULL, 1),
(4356, '', NULL, NULL, 1),
(4357, '', NULL, NULL, 1),
(4358, '', NULL, NULL, 1),
(4359, '', NULL, NULL, 1),
(4360, '', NULL, NULL, 1),
(4361, '', NULL, NULL, 1),
(4362, '', NULL, NULL, 1),
(4363, '', NULL, NULL, 1),
(4364, '', NULL, NULL, 1),
(4365, '', NULL, NULL, 1),
(4366, '', NULL, NULL, 1),
(4367, '', NULL, NULL, 1),
(4368, '', NULL, NULL, 1),
(4369, '', NULL, NULL, 1),
(4370, '', NULL, NULL, 1),
(4371, '', NULL, NULL, 1),
(4372, '', NULL, NULL, 1),
(4373, '', NULL, NULL, 1),
(4374, '', NULL, NULL, 1),
(4375, '', NULL, NULL, 1),
(4376, '', NULL, NULL, 1),
(4377, '', NULL, NULL, 1),
(4378, '', NULL, NULL, 1),
(4379, '', NULL, NULL, 1),
(4380, '', NULL, NULL, 1),
(4381, '', NULL, NULL, 1),
(4382, '', NULL, NULL, 1),
(4383, '', NULL, NULL, 1),
(4384, '', NULL, NULL, 1),
(4385, '', NULL, NULL, 1),
(4386, '', NULL, NULL, 1),
(4387, '', NULL, NULL, 1),
(4388, '', NULL, NULL, 1),
(4389, '', NULL, NULL, 1),
(4390, '', NULL, NULL, 1),
(4391, '', NULL, NULL, 1),
(4392, '', NULL, NULL, 1),
(4393, '', NULL, NULL, 1),
(4394, '', NULL, NULL, 1),
(4395, '', NULL, NULL, 1),
(4396, '', NULL, NULL, 1),
(4397, '', NULL, NULL, 1),
(4398, '', NULL, NULL, 1),
(4399, '', NULL, NULL, 1),
(4400, '', NULL, NULL, 1),
(4401, '', NULL, NULL, 1),
(4402, '', NULL, NULL, 1),
(4403, '', NULL, NULL, 1),
(4404, '', NULL, NULL, 1),
(4405, '', NULL, NULL, 1),
(4406, '', NULL, NULL, 1),
(4407, '', NULL, NULL, 1),
(4408, '', NULL, NULL, 1),
(4409, '', NULL, NULL, 1),
(4410, '', NULL, NULL, 1),
(4411, '', NULL, NULL, 1),
(4412, '', NULL, NULL, 1),
(4413, '', NULL, NULL, 1),
(4414, '', NULL, NULL, 1),
(4415, '', NULL, NULL, 1),
(4416, '', NULL, NULL, 1),
(4417, '', NULL, NULL, 1),
(4418, '', NULL, NULL, 1),
(4419, '', NULL, NULL, 1),
(4420, '', NULL, NULL, 1),
(4421, '', NULL, NULL, 1),
(4422, '', NULL, NULL, 1),
(4423, '', NULL, NULL, 1),
(4424, '', NULL, NULL, 1),
(4425, '', NULL, NULL, 1),
(4426, '', NULL, NULL, 1),
(4427, '', NULL, NULL, 1),
(4428, '', NULL, NULL, 1),
(4429, '', NULL, NULL, 1),
(4430, '', NULL, NULL, 1),
(4431, '', NULL, NULL, 1),
(4432, '', NULL, NULL, 1),
(4433, '', NULL, NULL, 1),
(4434, '', NULL, NULL, 1),
(4435, '', NULL, NULL, 1),
(4436, '', NULL, NULL, 1),
(4437, '', NULL, NULL, 1),
(4438, '', NULL, NULL, 1),
(4439, '', NULL, NULL, 1),
(4440, '', NULL, NULL, 1),
(4441, '', NULL, NULL, 1),
(4442, '', NULL, NULL, 1),
(4443, '', NULL, NULL, 1),
(4444, '', NULL, NULL, 1),
(4445, '', NULL, NULL, 1),
(4446, '', NULL, NULL, 1),
(4447, '', NULL, NULL, 1),
(4448, '', NULL, NULL, 1),
(4449, '', NULL, NULL, 1),
(4450, '', NULL, NULL, 1),
(4451, '', NULL, NULL, 1),
(4452, '', NULL, NULL, 1),
(4453, '', NULL, NULL, 1),
(4454, '', NULL, NULL, 1),
(4455, '', NULL, NULL, 1),
(4456, '', NULL, NULL, 1),
(4457, '', NULL, NULL, 1),
(4458, '', NULL, NULL, 1),
(4459, '', NULL, NULL, 1),
(4460, '', NULL, NULL, 1),
(4461, '', NULL, NULL, 1),
(4462, '', NULL, NULL, 1),
(4463, '', NULL, NULL, 1),
(4464, '', NULL, NULL, 1),
(4465, '', NULL, NULL, 1),
(4466, '', NULL, NULL, 1),
(4467, '', NULL, NULL, 1),
(4468, '', NULL, NULL, 1),
(4469, '', NULL, NULL, 1),
(4470, '', NULL, NULL, 1),
(4471, '', NULL, NULL, 1),
(4472, '', NULL, NULL, 1),
(4473, '', NULL, NULL, 1),
(4474, '', NULL, NULL, 1),
(4475, '', NULL, NULL, 1),
(4476, '', NULL, NULL, 1),
(4477, '', NULL, NULL, 1),
(4478, '', NULL, NULL, 1),
(4479, '', NULL, NULL, 1),
(4480, '', NULL, NULL, 1),
(4481, '', NULL, NULL, 1),
(4482, '', NULL, NULL, 1),
(4483, '', NULL, NULL, 1),
(4484, '', NULL, NULL, 1),
(4485, '', NULL, NULL, 1),
(4486, '', NULL, NULL, 1),
(4487, '', NULL, NULL, 1),
(4488, '', NULL, NULL, 1),
(4489, '', NULL, NULL, 1),
(4490, '', NULL, NULL, 1),
(4491, '', NULL, NULL, 1),
(4492, '', NULL, NULL, 1),
(4493, '', NULL, NULL, 1),
(4494, '', NULL, NULL, 1),
(4495, '', NULL, NULL, 1),
(4496, '', NULL, NULL, 1),
(4497, '', NULL, NULL, 1),
(4498, '', NULL, NULL, 1),
(4499, '', NULL, NULL, 1),
(4500, '', NULL, NULL, 1),
(4501, '', NULL, NULL, 1),
(4502, '', NULL, NULL, 1),
(4503, '', NULL, NULL, 1),
(4504, '', NULL, NULL, 1),
(4505, '', NULL, NULL, 1),
(4506, '', NULL, NULL, 1),
(4507, '', NULL, NULL, 1),
(4508, '', NULL, NULL, 1),
(4509, '', NULL, NULL, 1),
(4510, '', NULL, NULL, 1),
(4511, '', NULL, NULL, 1),
(4512, '', NULL, NULL, 1),
(4513, '', NULL, NULL, 1),
(4514, '', NULL, NULL, 1),
(4515, '', NULL, NULL, 1),
(4516, '', NULL, NULL, 1),
(4517, '', NULL, NULL, 1),
(4518, NULL, NULL, NULL, 1),
(4519, NULL, NULL, NULL, 1),
(4520, NULL, NULL, NULL, 1),
(4521, NULL, NULL, NULL, 1),
(4522, NULL, NULL, NULL, 1),
(4523, NULL, NULL, NULL, 1),
(4524, NULL, NULL, NULL, 1),
(4525, NULL, NULL, NULL, 1),
(4526, NULL, NULL, NULL, 1),
(4527, NULL, NULL, NULL, 1),
(4528, NULL, NULL, NULL, 1),
(4529, NULL, NULL, NULL, 1),
(4530, NULL, NULL, NULL, 1),
(4531, NULL, NULL, NULL, 1),
(4532, NULL, NULL, NULL, 1),
(4533, NULL, NULL, NULL, 1),
(4534, NULL, NULL, NULL, 1),
(4535, NULL, NULL, NULL, 1),
(4536, NULL, NULL, NULL, 1),
(4537, NULL, NULL, NULL, 1),
(4538, NULL, NULL, NULL, 1),
(4539, NULL, NULL, NULL, 1),
(4540, NULL, NULL, NULL, 1),
(4541, NULL, NULL, NULL, 1),
(4542, NULL, NULL, NULL, 1),
(4543, NULL, NULL, NULL, 1),
(4544, NULL, NULL, NULL, 1),
(4545, NULL, NULL, NULL, 1),
(4546, NULL, NULL, NULL, 1),
(4547, NULL, NULL, NULL, 1),
(4548, NULL, NULL, NULL, 1),
(4549, NULL, NULL, NULL, 1),
(4550, NULL, NULL, NULL, 1),
(4551, NULL, NULL, NULL, 1),
(4552, NULL, NULL, NULL, 1),
(4553, NULL, NULL, NULL, 1),
(4554, NULL, NULL, NULL, 1),
(4555, NULL, NULL, NULL, 1),
(4556, NULL, NULL, NULL, 1),
(4557, NULL, NULL, NULL, 1),
(4558, NULL, NULL, NULL, 1),
(4559, NULL, NULL, NULL, 1),
(4774, '', NULL, NULL, 1),
(4775, '', NULL, NULL, 1),
(4776, '', NULL, NULL, 1),
(4777, '', NULL, NULL, 1),
(4778, '', NULL, NULL, 1),
(4779, '', NULL, NULL, 1),
(4780, '', NULL, NULL, 1),
(4781, '', NULL, NULL, 1),
(4782, '', NULL, NULL, 1),
(4783, '', NULL, NULL, 1),
(4784, '', NULL, NULL, 1),
(4785, '', NULL, NULL, 1),
(4786, '', NULL, NULL, 1),
(4787, '', NULL, NULL, 1),
(4788, '', NULL, NULL, 1),
(4789, '', NULL, NULL, 1),
(4790, '', NULL, NULL, 1),
(4791, '', NULL, NULL, 1),
(4792, '', NULL, NULL, 1),
(4793, '', NULL, NULL, 1),
(4794, '', NULL, NULL, 1),
(4795, '', NULL, NULL, 1),
(4796, '', NULL, NULL, 1),
(4797, '', NULL, NULL, 1),
(4798, '', NULL, NULL, 1),
(4799, '', NULL, NULL, 1),
(4800, '', NULL, NULL, 1),
(4801, '', NULL, NULL, 1),
(4802, '', NULL, NULL, 1),
(4803, '', NULL, NULL, 1),
(4804, '', NULL, NULL, 1),
(4805, '', NULL, NULL, 1),
(4806, '', NULL, NULL, 1),
(4807, '', NULL, NULL, 1),
(4808, '', NULL, NULL, 1),
(4809, '', NULL, NULL, 1),
(4810, '', NULL, NULL, 1),
(4811, '', NULL, NULL, 1),
(4812, '', NULL, NULL, 1),
(4813, '', NULL, NULL, 1),
(4814, '', NULL, NULL, 1),
(4815, '', NULL, NULL, 1),
(4816, '', NULL, NULL, 1),
(4817, '', NULL, NULL, 1),
(4818, '', NULL, NULL, 1),
(4819, '', NULL, NULL, 1),
(4820, '', NULL, NULL, 1),
(4821, '', NULL, NULL, 1),
(4822, '', NULL, NULL, 1),
(4823, '', NULL, NULL, 1),
(4824, '', NULL, NULL, 1),
(4825, '', NULL, NULL, 1),
(4826, '', NULL, NULL, 1),
(4827, '', NULL, NULL, 1),
(4828, '', NULL, NULL, 1),
(4829, '', NULL, NULL, 1),
(4830, '', NULL, NULL, 1),
(4831, '', NULL, NULL, 1),
(4832, '', NULL, NULL, 1),
(4833, '', NULL, NULL, 1),
(4834, '', NULL, NULL, 1),
(4835, '', NULL, NULL, 1),
(4836, '', NULL, NULL, 1),
(4837, '', NULL, NULL, 1),
(4838, '', NULL, NULL, 1),
(4839, '', NULL, NULL, 1),
(4840, '', NULL, NULL, 1),
(4841, '', NULL, NULL, 1),
(4842, '', NULL, NULL, 1),
(4843, '', NULL, NULL, 1),
(4844, '', NULL, NULL, 1),
(4845, '', NULL, NULL, 1),
(4846, '', NULL, NULL, 1),
(4847, '', NULL, NULL, 1),
(4848, '', NULL, NULL, 1),
(4849, '', NULL, NULL, 1),
(4850, '', NULL, NULL, 1),
(4851, '', NULL, NULL, 1),
(4852, '', NULL, NULL, 1),
(4853, '', NULL, NULL, 1),
(4854, '', NULL, NULL, 1),
(4855, '', NULL, NULL, 1),
(4856, '', NULL, NULL, 1),
(4857, '', NULL, NULL, 1),
(4858, '', NULL, NULL, 1),
(4859, '', NULL, NULL, 1),
(4860, '', NULL, NULL, 1),
(4861, '', NULL, NULL, 1),
(4862, '', NULL, NULL, 1),
(4863, '', NULL, NULL, 1),
(4864, '', NULL, NULL, 1),
(4865, '', NULL, NULL, 1),
(4866, '', NULL, NULL, 1),
(4867, '', NULL, NULL, 1),
(4868, '', NULL, NULL, 1),
(4869, '', NULL, NULL, 1),
(4870, '', NULL, NULL, 1),
(4871, '', NULL, NULL, 1),
(4872, '', NULL, NULL, 1),
(4873, '', NULL, NULL, 1),
(4874, '', NULL, NULL, 1),
(4875, '', NULL, NULL, 1),
(4876, '', NULL, NULL, 1),
(4877, '', NULL, NULL, 1),
(4878, '', NULL, NULL, 1),
(4879, '', NULL, NULL, 1),
(4880, '', NULL, NULL, 1),
(4881, '', NULL, NULL, 1),
(4882, '', NULL, NULL, 1),
(4883, '', NULL, NULL, 1),
(4884, '', NULL, NULL, 1),
(4885, '', NULL, NULL, 1),
(4886, '', NULL, NULL, 1),
(4887, '', NULL, NULL, 1),
(4888, '', NULL, NULL, 1),
(4889, '', NULL, NULL, 1),
(4890, '', NULL, NULL, 1),
(4891, '', NULL, NULL, 1),
(4892, '', NULL, NULL, 1),
(4893, '', NULL, NULL, 1),
(4894, '', NULL, NULL, 1),
(4895, '', NULL, NULL, 1),
(4896, '', NULL, NULL, 1),
(4897, '', NULL, NULL, 1),
(4898, '', NULL, NULL, 1),
(4899, '', NULL, NULL, 1),
(4900, '', NULL, NULL, 1),
(4901, '', NULL, NULL, 1),
(4902, '', NULL, NULL, 1),
(4903, '', NULL, NULL, 1),
(4904, '', NULL, NULL, 1),
(4905, '', NULL, NULL, 1),
(4906, '', NULL, NULL, 1),
(4907, '', NULL, NULL, 1),
(4908, '', NULL, NULL, 1),
(4909, '', NULL, NULL, 1),
(4910, '', NULL, NULL, 1),
(4911, '', NULL, NULL, 1),
(4912, '', NULL, NULL, 1),
(4913, '', NULL, NULL, 1),
(4914, '', NULL, NULL, 1),
(4915, '', NULL, NULL, 1),
(4916, '', NULL, NULL, 1),
(4917, '', NULL, NULL, 1),
(4918, '', NULL, NULL, 1),
(4919, '', NULL, NULL, 1),
(4920, '', NULL, NULL, 1),
(4921, '', NULL, NULL, 1),
(4922, '', NULL, NULL, 1),
(4923, '', NULL, NULL, 1),
(4924, '', NULL, NULL, 1),
(4925, '', NULL, NULL, 1),
(4926, '', NULL, NULL, 1),
(4927, '', NULL, NULL, 1),
(4928, '', NULL, NULL, 1),
(4929, '', NULL, NULL, 1),
(4930, '', NULL, NULL, 1),
(4931, '', NULL, NULL, 1),
(4932, '', NULL, NULL, 1),
(4933, '', NULL, NULL, 1),
(4934, '', NULL, NULL, 1),
(4935, '', NULL, NULL, 1),
(4936, '', NULL, NULL, 1),
(4937, '', NULL, NULL, 1),
(4938, '', NULL, NULL, 1),
(4939, '', NULL, NULL, 1),
(4940, '', NULL, NULL, 1),
(4941, '', NULL, NULL, 1),
(4942, '', NULL, NULL, 1),
(4943, '', NULL, NULL, 1),
(4944, '', NULL, NULL, 1),
(4945, '', NULL, NULL, 1),
(4946, '', NULL, NULL, 1),
(4947, '', NULL, NULL, 1),
(4948, '', NULL, NULL, 1),
(4949, '', NULL, NULL, 1),
(4950, '', NULL, NULL, 1),
(4951, '', NULL, NULL, 1),
(4952, '', NULL, NULL, 1),
(4953, '', NULL, NULL, 1),
(4954, '', NULL, NULL, 1),
(4955, '', NULL, NULL, 1),
(4956, '', NULL, NULL, 1),
(4957, '', NULL, NULL, 1),
(4958, '', NULL, NULL, 1),
(4959, '', NULL, NULL, 1),
(4960, '', NULL, NULL, 1),
(4961, '', NULL, NULL, 1),
(4962, '', NULL, NULL, 1),
(4963, '', NULL, NULL, 1),
(4964, '', NULL, NULL, 1),
(4965, '', NULL, NULL, 1),
(4966, '', NULL, NULL, 1),
(4967, '', NULL, NULL, 1),
(4968, '', NULL, NULL, 1),
(4969, '', NULL, NULL, 1),
(4970, '', NULL, NULL, 1),
(4971, '', NULL, NULL, 1),
(4972, '', NULL, NULL, 1),
(4973, '', NULL, NULL, 1),
(4974, '', NULL, NULL, 1),
(4975, '', NULL, NULL, 1),
(4976, '', NULL, NULL, 1),
(4977, '', NULL, NULL, 1),
(4978, '', NULL, NULL, 1),
(4979, '', NULL, NULL, 1),
(4980, '', NULL, NULL, 1),
(4981, '', NULL, NULL, 1),
(4982, '', NULL, NULL, 1),
(4983, '', NULL, NULL, 1),
(4984, '', NULL, NULL, 1),
(4985, '', NULL, NULL, 1),
(4986, '', NULL, NULL, 1),
(4987, '', NULL, NULL, 1),
(4988, '', NULL, NULL, 1),
(4989, '', NULL, NULL, 1),
(4990, '', NULL, NULL, 1),
(4991, '', NULL, NULL, 1),
(4992, '', NULL, NULL, 1),
(4993, '', NULL, NULL, 1),
(4994, '', NULL, NULL, 1),
(4995, '', NULL, NULL, 1),
(4996, '', NULL, NULL, 1),
(4997, '', NULL, NULL, 1),
(4998, '', NULL, NULL, 1),
(4999, '', NULL, NULL, 1),
(5000, '', NULL, NULL, 1),
(5001, '', NULL, NULL, 1),
(5002, '', NULL, NULL, 1),
(5003, '', NULL, NULL, 1),
(5004, '', NULL, NULL, 1),
(5005, '', NULL, NULL, 1),
(5006, '', NULL, NULL, 1),
(5007, '', NULL, NULL, 1),
(5008, '', NULL, NULL, 1),
(5009, '', NULL, NULL, 1),
(5010, '', NULL, NULL, 1),
(5011, '', NULL, NULL, 1),
(5012, '', NULL, NULL, 1),
(5013, '', NULL, NULL, 1),
(5014, '', NULL, NULL, 1),
(5015, '', NULL, NULL, 1),
(5016, '', NULL, NULL, 1),
(5017, '', NULL, NULL, 1),
(5018, '', NULL, NULL, 1),
(5019, '', NULL, NULL, 1),
(5020, '', NULL, NULL, 1),
(5021, '', NULL, NULL, 1),
(5022, '', NULL, NULL, 1),
(5023, '', NULL, NULL, 1),
(5024, '', NULL, NULL, 1),
(5025, '', NULL, NULL, 1),
(5026, '', NULL, NULL, 1),
(5027, '', NULL, NULL, 1),
(5028, '', NULL, NULL, 1),
(5029, NULL, NULL, NULL, 1),
(5030, NULL, NULL, NULL, 1),
(5031, NULL, NULL, NULL, 1),
(5032, NULL, NULL, NULL, 1),
(5033, NULL, NULL, NULL, 1),
(5034, NULL, NULL, NULL, 1),
(5035, NULL, NULL, NULL, 1),
(5036, NULL, NULL, NULL, 1),
(5037, NULL, NULL, NULL, 1),
(5038, NULL, NULL, NULL, 1),
(5039, NULL, NULL, NULL, 1),
(5040, NULL, NULL, NULL, 1),
(5041, NULL, NULL, NULL, 1),
(5042, NULL, NULL, NULL, 1),
(5043, NULL, NULL, NULL, 1),
(5044, NULL, NULL, NULL, 1),
(5045, NULL, NULL, NULL, 1),
(5046, NULL, NULL, NULL, 1),
(5047, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `scms_student_profile`
--

CREATE TABLE `scms_student_profile` (
  `student_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `optional_subject_id` int(11) NOT NULL,
  `birthday` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `religion` int(11) DEFAULT 0 COMMENT '1= Islam, 2= Hinduism',
  `blood_group` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `dormitory_id` int(11) DEFAULT NULL,
  `transport_id` int(11) DEFAULT NULL,
  `agent_banking_no` varchar(42) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dormitory_room_number` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `authentication_key` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admission_date` date NOT NULL,
  `vtype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blood_groups`
--

CREATE TABLE `tbl_blood_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_blood_groups`
--

INSERT INTO `tbl_blood_groups` (`id`, `name`, `order_by`, `created_at`, `updated_at`) VALUES
(1, 'AB', 1, '2022-04-09 01:54:55', '2022-04-09 01:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_branch`
--

CREATE TABLE `tbl_branch` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `ssl_store_id` varchar(255) DEFAULT NULL,
  `ssl_password` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_branch`
--

INSERT INTO `tbl_branch` (`id`, `name`, `slug`, `phone`, `email`, `address`, `ssl_store_id`, `ssl_password`, `description`, `order_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Tast', NULL, '01911054866', 'fdf', 'fdf', NULL, NULL, NULL, 1, 1, '2022-10-05 06:20:48', '2022-10-07 10:40:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gender`
--

CREATE TABLE `tbl_gender` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_gender`
--

INSERT INTO `tbl_gender` (`id`, `name`, `order_by`, `created_at`, `updated_at`) VALUES
(1, 'Male', 1, '2022-10-05 07:01:20', '2022-10-05 07:01:20'),
(2, 'Female', 2, '2022-10-05 07:01:31', '2022-10-07 08:07:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_modules`
--

CREATE TABLE `tbl_modules` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_modules`
--

INSERT INTO `tbl_modules` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Core', 'core', 1, '2022-09-23 12:13:23', '2022-10-07 08:55:48'),
(2, 'Hrms', 'hrms', 1, '2022-10-26 05:56:38', '2022-10-26 05:56:38'),
(3, 'Scms', 'scms', 1, '2022-11-11 14:10:42', '2022-11-11 14:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_module_sections`
--

CREATE TABLE `tbl_module_sections` (
  `id` bigint(20) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `section_action_route` text DEFAULT NULL,
  `section_roles_permission` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_module_sections`
--

INSERT INTO `tbl_module_sections` (`id`, `section_name`, `module_id`, `section_action_route`, `section_roles_permission`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 2, '{\"core.role\":[\"1\"],\"core.role.create\":[\"1\"],\"core.role.store\":[\"1\"],\"core.role.edit\":[\"1\"],\"core.user.create\":[\"1\"],\"core.user.store\":[\"1\"],\"core.user.edit\":[\"1\"],\"core.user.update\":[\"1\"],\"core.user.delete\":[\"1\"],\"core.user.profile\":[\"1\"],\"core.user.permission\":[\"1\"],\"core.branch.create\":[\"1\"],\"core.branch.store\":[\"1\"],\"core.branch.edit\":[\"1\"],\"core.branch.delete\":[\"1\"],\"core.gender.edit\":[\"1\"],\"core.gender.store\":[\"1\"],\"core.gender.delete\":[\"1\"],\"core.religion.edit\":[\"1\"],\"core.religion.store\":[\"1\"],\"core.religion.delete\":[\"1\"],\"core.blood_group.edit\":[\"1\"],\"core.blood_group.store\":[\"1\"],\"core.blood_group.delete\":[\"1\"],\"core.mediamanager.create\":[\"1\"],\"core.mediamanager.rename\":[\"1\"],\"core.mediamanager.delete\":[\"1\"],\"core.mediamanager.upload\":[\"1\"],\"core.mediamanager\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:51', '2022-11-14 15:38:59'),
(2, 'Settings', 1, '{\"core.settings\":[\"1\"],\"core.settings.store\":[\"1\"],\"core.settings.logo\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:51', '2022-11-14 15:38:57'),
(3, 'Module', 1, '{\"core.module\":[\"1\"],\"core.module.edit\":[\"1\"],\"core.module.store\":[\"1\"],\"core.module.delete\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:51', '2022-11-14 15:38:57'),
(4, 'Permissions', 1, '{\"core.permissions\":[\"1\"],\"core.permissions.create\":[\"1\"],\"core.permissions.store\":[\"1\"],\"core.permissions.edit\":[\"1\"],\"core.permissions.update\":[\"1\"],\"core.permissions.section_edit\":[\"1\"],\"core.permissions.section_update\":[\"1\"],\"core.permissions.ajax_add_remove\":[\"1\"],\"core.permissions.ajax_route_remove\":[\"1\"],\"core.permissions.ajax_get_sections\":[\"1\"],\"core.permissions.ajax_user_module_permission\":[\"1\"],\"core.permissions.ajax_user_permission\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:51', '2022-11-14 15:38:58'),
(5, 'Role', 1, '{\"core.role\":[\"1\"],\"core.role.create\":[\"1\"],\"core.role.store\":[\"1\"],\"core.role.edit\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:52', '2022-11-14 15:38:58'),
(6, 'User', 1, '{\"core.role\":[\"1\"],\"core.role.create\":[\"1\"],\"core.role.store\":[\"1\"],\"core.role.edit\":[\"1\"],\"core.user.create\":[\"1\"],\"core.user.store\":[\"1\"],\"core.user.edit\":[\"1\"],\"core.user.update\":[\"1\"],\"core.user.delete\":[\"1\"],\"core.user.profile\":[\"1\"],\"core.user.permission\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:52', '2022-11-14 15:38:58'),
(7, 'Branch', 1, '{\"core.role\":[\"1\"],\"core.role.create\":[\"1\"],\"core.role.store\":[\"1\"],\"core.role.edit\":[\"1\"],\"core.user.create\":[\"1\"],\"core.user.store\":[\"1\"],\"core.user.edit\":[\"1\"],\"core.user.update\":[\"1\"],\"core.user.delete\":[\"1\"],\"core.user.profile\":[\"1\"],\"core.user.permission\":[\"1\"],\"core.branch.create\":[\"1\"],\"core.branch.store\":[\"1\"],\"core.branch.edit\":[\"1\"],\"core.branch.delete\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:52', '2022-11-14 15:38:58'),
(8, 'Gender', 1, '{\"core.role\":[\"1\"],\"core.role.create\":[\"1\"],\"core.role.store\":[\"1\"],\"core.role.edit\":[\"1\"],\"core.user.create\":[\"1\"],\"core.user.store\":[\"1\"],\"core.user.edit\":[\"1\"],\"core.user.update\":[\"1\"],\"core.user.delete\":[\"1\"],\"core.user.profile\":[\"1\"],\"core.user.permission\":[\"1\"],\"core.branch.create\":[\"1\"],\"core.branch.store\":[\"1\"],\"core.branch.edit\":[\"1\"],\"core.branch.delete\":[\"1\"],\"core.gender.edit\":[\"1\"],\"core.gender.store\":[\"1\"],\"core.gender.delete\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:52', '2022-11-14 15:38:59'),
(9, 'Religion', 1, '{\"core.role\":[\"1\"],\"core.role.create\":[\"1\"],\"core.role.store\":[\"1\"],\"core.role.edit\":[\"1\"],\"core.user.create\":[\"1\"],\"core.user.store\":[\"1\"],\"core.user.edit\":[\"1\"],\"core.user.update\":[\"1\"],\"core.user.delete\":[\"1\"],\"core.user.profile\":[\"1\"],\"core.user.permission\":[\"1\"],\"core.branch.create\":[\"1\"],\"core.branch.store\":[\"1\"],\"core.branch.edit\":[\"1\"],\"core.branch.delete\":[\"1\"],\"core.gender.edit\":[\"1\"],\"core.gender.store\":[\"1\"],\"core.gender.delete\":[\"1\"],\"core.religion.edit\":[\"1\"],\"core.religion.store\":[\"1\"],\"core.religion.delete\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:53', '2022-11-14 15:38:59'),
(10, 'Blood Group', 1, '{\"core.role\":[\"1\"],\"core.role.create\":[\"1\"],\"core.role.store\":[\"1\"],\"core.role.edit\":[\"1\"],\"core.user.create\":[\"1\"],\"core.user.store\":[\"1\"],\"core.user.edit\":[\"1\"],\"core.user.update\":[\"1\"],\"core.user.delete\":[\"1\"],\"core.user.profile\":[\"1\"],\"core.user.permission\":[\"1\"],\"core.branch.create\":[\"1\"],\"core.branch.store\":[\"1\"],\"core.branch.edit\":[\"1\"],\"core.branch.delete\":[\"1\"],\"core.gender.edit\":[\"1\"],\"core.gender.store\":[\"1\"],\"core.gender.delete\":[\"1\"],\"core.religion.edit\":[\"1\"],\"core.religion.store\":[\"1\"],\"core.religion.delete\":[\"1\"],\"core.blood_group.edit\":[\"1\"],\"core.blood_group.store\":[\"1\"],\"core.blood_group.delete\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:53', '2022-11-14 15:38:59'),
(11, 'Mediamanager', 1, '{\"core.role\":[\"1\"],\"core.role.create\":[\"1\"],\"core.role.store\":[\"1\"],\"core.role.edit\":[\"1\"],\"core.user.create\":[\"1\"],\"core.user.store\":[\"1\"],\"core.user.edit\":[\"1\"],\"core.user.update\":[\"1\"],\"core.user.delete\":[\"1\"],\"core.user.profile\":[\"1\"],\"core.user.permission\":[\"1\"],\"core.branch.create\":[\"1\"],\"core.branch.store\":[\"1\"],\"core.branch.edit\":[\"1\"],\"core.branch.delete\":[\"1\"],\"core.gender.edit\":[\"1\"],\"core.gender.store\":[\"1\"],\"core.gender.delete\":[\"1\"],\"core.religion.edit\":[\"1\"],\"core.religion.store\":[\"1\"],\"core.religion.delete\":[\"1\"],\"core.blood_group.edit\":[\"1\"],\"core.blood_group.store\":[\"1\"],\"core.blood_group.delete\":[\"1\"],\"core.mediamanager.create\":[\"1\"],\"core.mediamanager.rename\":[\"1\"],\"core.mediamanager.delete\":[\"1\"],\"core.mediamanager.upload\":[\"1\"],\"core.mediamanager\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:53', '2022-11-14 15:38:59'),
(12, 'Dashboard', 2, '{\"core.role\":[\"1\"],\"core.role.create\":[\"1\"],\"core.role.store\":[\"1\"],\"core.role.edit\":[\"1\"],\"core.user.create\":[\"1\"],\"core.user.store\":[\"1\"],\"core.user.edit\":[\"1\"],\"core.user.update\":[\"1\"],\"core.user.delete\":[\"1\"],\"core.user.profile\":[\"1\"],\"core.user.permission\":[\"1\"],\"core.branch.create\":[\"1\"],\"core.branch.store\":[\"1\"],\"core.branch.edit\":[\"1\"],\"core.branch.delete\":[\"1\"],\"core.gender.edit\":[\"1\"],\"core.gender.store\":[\"1\"],\"core.gender.delete\":[\"1\"],\"core.religion.edit\":[\"1\"],\"core.religion.store\":[\"1\"],\"core.religion.delete\":[\"1\"],\"core.blood_group.edit\":[\"1\"],\"core.blood_group.store\":[\"1\"],\"core.blood_group.delete\":[\"1\"],\"core.mediamanager.create\":[\"1\"],\"core.mediamanager.rename\":[\"1\"],\"core.mediamanager.delete\":[\"1\"],\"core.mediamanager.upload\":[\"1\"],\"core.mediamanager\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:53', '2022-11-14 15:38:59'),
(13, 'Department', 2, '{\"hrms.employee\":[\"1\"],\"hrms.employee.create\":[\"1\"],\"hrms.employee.edit\":[\"1\"],\"hrms.employee.store\":[\"1\"],\"hrms.employee.show\":[\"1\"],\"hrms.employee.delete\":[\"1\"],\"hrms.department.edit\":[\"1\"],\"hrms.department.store\":[\"1\"],\"hrms.department.delete\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:53', '2022-11-14 15:38:59'),
(14, 'Designation', 2, '{\"hrms.employee\":[\"1\"],\"hrms.employee.create\":[\"1\"],\"hrms.employee.edit\":[\"1\"],\"hrms.employee.store\":[\"1\"],\"hrms.employee.show\":[\"1\"],\"hrms.employee.delete\":[\"1\"],\"hrms.department.edit\":[\"1\"],\"hrms.department.store\":[\"1\"],\"hrms.department.delete\":[\"1\"],\"hrms.designation.edit\":[\"1\"],\"hrms.designation.store\":[\"1\"],\"hrms.designation.delete\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:53', '2022-11-14 15:38:59'),
(15, 'Employee', 2, '{\"hrms.employee\":[\"1\"],\"hrms.employee.create\":[\"1\"],\"hrms.employee.edit\":[\"1\"],\"hrms.employee.store\":[\"1\"],\"hrms.employee.show\":[\"1\"],\"hrms.employee.delete\":[\"1\"]}', '[\"1\"]', '2022-11-12 05:00:17', '2022-11-14 15:38:59'),
(16, 'Dashboard', 2, '{\"core.role\":[\"1\"],\"core.role.create\":[\"1\"],\"core.role.store\":[\"1\"],\"core.role.edit\":[\"1\"],\"core.user.create\":[\"1\"],\"core.user.store\":[\"1\"],\"core.user.edit\":[\"1\"],\"core.user.update\":[\"1\"],\"core.user.delete\":[\"1\"],\"core.user.profile\":[\"1\"],\"core.user.permission\":[\"1\"],\"core.branch.create\":[\"1\"],\"core.branch.store\":[\"1\"],\"core.branch.edit\":[\"1\"],\"core.branch.delete\":[\"1\"],\"core.gender.edit\":[\"1\"],\"core.gender.store\":[\"1\"],\"core.gender.delete\":[\"1\"],\"core.religion.edit\":[\"1\"],\"core.religion.store\":[\"1\"],\"core.religion.delete\":[\"1\"],\"core.blood_group.edit\":[\"1\"],\"core.blood_group.store\":[\"1\"],\"core.blood_group.delete\":[\"1\"],\"core.mediamanager.create\":[\"1\"],\"core.mediamanager.rename\":[\"1\"],\"core.mediamanager.delete\":[\"1\"],\"core.mediamanager.upload\":[\"1\"],\"core.mediamanager\":[\"1\"]}', '[\"1\"]', '2022-11-12 05:00:18', '2022-11-14 15:38:59'),
(17, 'Group', 3, '{\"scms.group\":[\"1\"],\"scms.group.edit\":[\"1\"],\"scms.group.store\":[\"1\"],\"scms.group.delete\":[\"1\"]}', '[\"1\"]', '2022-11-12 05:00:18', '2022-11-14 15:39:01'),
(18, 'Shift', 3, '{\"scms.shift\":[\"1\"],\"scms.shift.edit\":[\"1\"],\"scms.shift.store\":[\"1\"],\"scms.shift.delete\":[\"1\"]}', '[\"1\"]', '2022-11-12 05:00:18', '2022-11-14 15:39:01'),
(19, 'Dashboard', 2, '{\"core.role\":[\"1\"],\"core.role.create\":[\"1\"],\"core.role.store\":[\"1\"],\"core.role.edit\":[\"1\"],\"core.user.create\":[\"1\"],\"core.user.store\":[\"1\"],\"core.user.edit\":[\"1\"],\"core.user.update\":[\"1\"],\"core.user.delete\":[\"1\"],\"core.user.profile\":[\"1\"],\"core.user.permission\":[\"1\"],\"core.branch.create\":[\"1\"],\"core.branch.store\":[\"1\"],\"core.branch.edit\":[\"1\"],\"core.branch.delete\":[\"1\"],\"core.gender.edit\":[\"1\"],\"core.gender.store\":[\"1\"],\"core.gender.delete\":[\"1\"],\"core.religion.edit\":[\"1\"],\"core.religion.store\":[\"1\"],\"core.religion.delete\":[\"1\"],\"core.blood_group.edit\":[\"1\"],\"core.blood_group.store\":[\"1\"],\"core.blood_group.delete\":[\"1\"],\"core.mediamanager.create\":[\"1\"],\"core.mediamanager.rename\":[\"1\"],\"core.mediamanager.delete\":[\"1\"],\"core.mediamanager.upload\":[\"1\"],\"core.mediamanager\":[\"1\"]}', '[\"1\"]', '2022-11-12 06:49:05', '2022-11-14 15:38:59'),
(20, 'Dashboard', 2, '{\"core.role\":[\"1\"],\"core.role.create\":[\"1\"],\"core.role.store\":[\"1\"],\"core.role.edit\":[\"1\"],\"core.user.create\":[\"1\"],\"core.user.store\":[\"1\"],\"core.user.edit\":[\"1\"],\"core.user.update\":[\"1\"],\"core.user.delete\":[\"1\"],\"core.user.profile\":[\"1\"],\"core.user.permission\":[\"1\"],\"core.branch.create\":[\"1\"],\"core.branch.store\":[\"1\"],\"core.branch.edit\":[\"1\"],\"core.branch.delete\":[\"1\"],\"core.gender.edit\":[\"1\"],\"core.gender.store\":[\"1\"],\"core.gender.delete\":[\"1\"],\"core.religion.edit\":[\"1\"],\"core.religion.store\":[\"1\"],\"core.religion.delete\":[\"1\"],\"core.blood_group.edit\":[\"1\"],\"core.blood_group.store\":[\"1\"],\"core.blood_group.delete\":[\"1\"],\"core.mediamanager.create\":[\"1\"],\"core.mediamanager.rename\":[\"1\"],\"core.mediamanager.delete\":[\"1\"],\"core.mediamanager.upload\":[\"1\"],\"core.mediamanager\":[\"1\"]}', '[\"1\"]', '2022-11-12 06:49:07', '2022-11-14 15:38:59'),
(21, 'Class', 3, '{\"scms.student.create\":[\"1\"],\"scms.student.edit\":[\"1\"],\"scms.student.store\":[\"1\"],\"scms.student.delete\":[\"1\"],\"scms.student\":[\"1\"],\"scms.class.edit\":[\"1\"],\"scms.class.store\":[\"1\"],\"scms.class.delete\":[\"1\"]}', '[\"1\"]', '2022-11-12 06:49:07', '2022-11-14 15:39:00'),
(22, 'Dashboard', 2, '{\"core.role\":[\"1\"],\"core.role.create\":[\"1\"],\"core.role.store\":[\"1\"],\"core.role.edit\":[\"1\"],\"core.user.create\":[\"1\"],\"core.user.store\":[\"1\"],\"core.user.edit\":[\"1\"],\"core.user.update\":[\"1\"],\"core.user.delete\":[\"1\"],\"core.user.profile\":[\"1\"],\"core.user.permission\":[\"1\"],\"core.branch.create\":[\"1\"],\"core.branch.store\":[\"1\"],\"core.branch.edit\":[\"1\"],\"core.branch.delete\":[\"1\"],\"core.gender.edit\":[\"1\"],\"core.gender.store\":[\"1\"],\"core.gender.delete\":[\"1\"],\"core.religion.edit\":[\"1\"],\"core.religion.store\":[\"1\"],\"core.religion.delete\":[\"1\"],\"core.blood_group.edit\":[\"1\"],\"core.blood_group.store\":[\"1\"],\"core.blood_group.delete\":[\"1\"],\"core.mediamanager.create\":[\"1\"],\"core.mediamanager.rename\":[\"1\"],\"core.mediamanager.delete\":[\"1\"],\"core.mediamanager.upload\":[\"1\"],\"core.mediamanager\":[\"1\"]}', '[\"1\"]', '2022-11-14 15:38:57', '2022-11-14 15:38:59'),
(23, 'Dashboard', 3, '{\"scms.dashboard\":[\"1\"]}', '[\"1\"]', '2022-11-14 15:38:59', '2022-11-14 15:38:59'),
(24, 'Student', 3, '{\"scms.student.create\":[\"1\"],\"scms.student.edit\":[\"1\"],\"scms.student.store\":[\"1\"],\"scms.student.delete\":[\"1\"],\"scms.student\":[\"1\"]}', '[\"1\"]', '2022-11-14 15:39:00', '2022-11-14 15:39:00'),
(25, 'Section', 3, '{\"scms.section.create\":[\"1\"],\"scms.section.edit\":[\"1\"],\"scms.section.store\":[\"1\"],\"scms.section.delete\":[\"1\"],\"scms.section\":[\"1\"]}', '[\"1\"]', '2022-11-14 15:39:00', '2022-11-14 15:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_religion`
--

CREATE TABLE `tbl_religion` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_religion`
--

INSERT INTO `tbl_religion` (`id`, `name`, `order_by`, `created_at`, `updated_at`) VALUES
(1, 'Islam', 1, '2022-10-05 07:17:11', '2022-11-11 13:55:26'),
(2, 'Science', 2, '2022-11-11 13:53:19', '2022-11-11 13:53:19'),
(3, 'Christianity', 3, '2022-11-11 13:53:36', '2022-11-11 13:57:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `s_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`s_id`, `s_name`, `s_value`, `updated_at`) VALUES
(1, 'appName', 'erp system.', '2022-08-13 15:09:09'),
(2, 'appTitle', 'ERP System', '2022-08-13 15:09:09'),
(3, 'url', 'https://erp-system.com', '2022-08-13 15:09:09'),
(4, 'email', 'help@erp-system.bd', '2022-08-13 15:15:15'),
(5, 'appAddress', 'House #46, Road #09, PC Culture Housing Society, Mohammadpur, Dhaka 1207.', '2022-08-05 17:37:05'),
(6, 'contact', '+880 191 105 4866', '2022-08-05 17:37:05'),
(7, 'logo', '/uploads/core/settings/logo.png', '2022-04-22 16:05:57'),
(8, 'c_symbol', 'TK', '2022-08-05 17:37:05'),
(9, 'c_order', 'left', '2021-12-28 13:16:39'),
(10, 'date_format', 'd-m-Y', '2022-01-02 13:50:53'),
(11, 'usd_rate', '85', '2021-04-09 19:28:05'),
(12, 'default_tax', '5', '2022-01-02 15:57:55'),
(13, 'include_tax', '0', '2022-01-02 16:03:50'),
(14, 'only_default_tax', '0', '2022-01-02 16:05:34'),
(15, 'description', 'erp system.', '2022-09-03 03:07:47'),
(16, 'social', '[{\"network_name\":\"Facebook\",\"network_link\":null},{\"network_name\":\"LinkedIn\",\"network_link\":null}]', '2022-09-03 03:05:25'),
(17, 'comment', '0', NULL),
(18, 'analytics', '0000000', NULL),
(19, 'language', 'en', NULL),
(20, 'payment', '{\"paypal\":\"1\",\"stripe\":null,\"sslcommerz\":null}', '2022-08-22 23:30:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tax`
--

CREATE TABLE `tbl_tax` (
  `tax_id` int(11) NOT NULL,
  `tax_name` varchar(255) NOT NULL,
  `tax_percent` float DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_tax`
--

INSERT INTO `tbl_tax` (`tax_id`, `tax_name`, `tax_percent`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Tax1', 5, 1, NULL, '2022-10-28 08:01:20'),
(2, 'Tax2', 15, 1, NULL, '2022-10-28 08:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `throttle`
--

CREATE TABLE `throttle` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `type`, `ip`, `created_at`, `updated_at`) VALUES
(1, NULL, 'global', NULL, '2022-10-09 16:08:44', '2022-10-09 16:08:44'),
(2, NULL, 'ip', '127.0.0.1', '2022-10-09 16:08:44', '2022-10-09 16:08:44'),
(3, 2, 'user', NULL, '2022-10-09 16:08:44', '2022-10-09 16:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `permissions` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_permission` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `directory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `user_name`, `phone`, `email`, `last_login`, `branch_id`, `employee_id`, `permissions`, `m_permission`, `password`, `directory`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL, 'admin@mail.com', '2022-11-14 15:37:53', NULL, NULL, NULL, NULL, '$2y$10$q/299XWGkxS0IqX7c.dwPO0C8.xmRm87IhbOrEQnfyeg6LypKI3M6', '', NULL, NULL, '2021-01-15 00:37:06', '2022-11-14 15:37:53'),
(2, 'Rasel', 'rasel', '01911054866', 'rasel@gmail.com', '2022-10-09 16:25:43', 1, NULL, '{\"core.blood_group\":true}', NULL, '$2y$10$GHiH2cpMTxJQoSITYzVZJefwBnqhaWFyJwkPmV9r9waThGVEwmmqC', NULL, NULL, NULL, '2022-10-09 16:22:04', '2022-10-28 19:05:57'),
(3, 'test', 'test@mail.com', '01911', 'test@gmail.com', NULL, 1, NULL, NULL, NULL, '$2y$10$sDMW30a2ML6q2H3/RkRLkuzVYOxtLe/nGSo3taJ1Pp/yLdq6dQAr.', NULL, NULL, NULL, '2022-10-18 09:47:31', '2022-10-18 09:47:31'),
(4, 'ruble', 'ruble', '455', 'ruble@gmail.com', NULL, 1, NULL, NULL, NULL, '$2y$10$WyF/vbAD0w4xEbfGa8t8BuJursb6aPOXzLhPaCGqUa/roN/tF8/hK', '4-1666086791', NULL, NULL, '2022-10-18 09:53:10', '2022-10-18 09:53:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `pid` bigint(20) NOT NULL,
  `p_uid` bigint(20) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `picture` varchar(50) DEFAULT NULL,
  `directory` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`pid`, `p_uid`, `full_name`, `firstname`, `lastname`, `description`, `picture`, `directory`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', NULL, NULL, NULL, NULL, NULL, '2022-06-12 23:16:20', '2022-06-12 23:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `version_type`
--

CREATE TABLE `version_type` (
  `id` int(11) NOT NULL,
  `name` varchar(111) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `version_type`
--

INSERT INTO `version_type` (`id`, `name`, `status`) VALUES
(1, 'Bangla', 1),
(2, 'English', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activations`
--
ALTER TABLE `activations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hrms_departments`
--
ALTER TABLE `hrms_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrms_designations`
--
ALTER TABLE `hrms_designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrms_employees`
--
ALTER TABLE `hrms_employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `persistences`
--
ALTER TABLE `persistences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `persistences_code_unique` (`code`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `scms_class`
--
ALTER TABLE `scms_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_enroll`
--
ALTER TABLE `scms_enroll`
  ADD PRIMARY KEY (`enroll_id`);

--
-- Indexes for table `scms_groups`
--
ALTER TABLE `scms_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_sections`
--
ALTER TABLE `scms_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_shift`
--
ALTER TABLE `scms_shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_student`
--
ALTER TABLE `scms_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_student_profile`
--
ALTER TABLE `scms_student_profile`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tbl_blood_groups`
--
ALTER TABLE `tbl_blood_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_branch`
--
ALTER TABLE `tbl_branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_gender`
--
ALTER TABLE `tbl_gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_modules`
--
ALTER TABLE `tbl_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_module_sections`
--
ALTER TABLE `tbl_module_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_religion`
--
ALTER TABLE `tbl_religion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `s_name` (`s_name`);

--
-- Indexes for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `throttle`
--
ALTER TABLE `throttle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `throttle_user_id_index` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `p_uid` (`p_uid`);

--
-- Indexes for table `version_type`
--
ALTER TABLE `version_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activations`
--
ALTER TABLE `activations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_departments`
--
ALTER TABLE `hrms_departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hrms_designations`
--
ALTER TABLE `hrms_designations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hrms_employees`
--
ALTER TABLE `hrms_employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `persistences`
--
ALTER TABLE `persistences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scms_class`
--
ALTER TABLE `scms_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `scms_enroll`
--
ALTER TABLE `scms_enroll`
  MODIFY `enroll_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scms_groups`
--
ALTER TABLE `scms_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `scms_sections`
--
ALTER TABLE `scms_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `scms_shift`
--
ALTER TABLE `scms_shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scms_student`
--
ALTER TABLE `scms_student`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5048;

--
-- AUTO_INCREMENT for table `tbl_blood_groups`
--
ALTER TABLE `tbl_blood_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_branch`
--
ALTER TABLE `tbl_branch`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_gender`
--
ALTER TABLE `tbl_gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_modules`
--
ALTER TABLE `tbl_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_module_sections`
--
ALTER TABLE `tbl_module_sections`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_religion`
--
ALTER TABLE `tbl_religion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `throttle`
--
ALTER TABLE `throttle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `pid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `version_type`
--
ALTER TABLE `version_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
