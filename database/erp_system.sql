-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2022 at 08:18 AM
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrms_departments`
--

INSERT INTO `hrms_departments` (`id`, `name`, `role_id`, `order_by`, `created_at`, `updated_at`) VALUES
(1, 'Web Developer', NULL, 1, '2022-04-09 01:54:55', '2022-04-09 01:54:55'),
(2, 'Content Writer', NULL, 2, '2022-04-09 01:55:08', '2022-04-09 01:55:08'),
(3, 'Digital Marketing', NULL, 3, '2022-04-09 01:55:18', '2022-04-09 01:55:18'),
(4, 'Networking', NULL, 4, '2022-04-09 01:55:35', '2022-10-26 05:52:12');

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
(42, 1, 'TccJ4xqrDuso6ui9SUchEokCLH2fze1C', '2022-10-26 05:40:44', '2022-10-26 05:40:44');

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
(1, 'administrator', 'Administrator', '{\"core.permissions.ajax_user_module\":true,\"core.role.create\":true,\"core.role.store\":true,\"core.role.edit\":true,\"core.user.create\":true,\"core.user.store\":true,\"core.user.edit\":true,\"core.user.update\":true,\"core.user.delete\":true,\"core.user.profile\":true,\"core.branch.create\":true,\"core.branch.store\":true,\"core.branch.edit\":true,\"core.branch.delete\":true,\"core.gender.edit\":true,\"core.gender.store\":true,\"core.gender.delete\":true,\"core.religion.edit\":true,\"core.religion.store\":true,\"core.religion.delete\":true,\"core.module\":true,\"core.module.delete\":true,\"core.module.edit\":true,\"core.module.store\":true,\"core.settings\":true,\"core.settings.store\":true,\"core.settings.logo\":true,\"core.dashboard\":true,\"core.permissions.create\":true,\"core.permissions.store\":true,\"core.permissions.edit\":true,\"core.permissions.update\":true,\"core.permissions.section_edit\":true,\"core.permissions.section_update\":true,\"core.permissions.ajax_add_remove\":true,\"core.permissions.ajax_route_remove\":true,\"core.permissions.ajax_get_sections\":true,\"core.branch\":true,\"core.gender\":true,\"core.permissions\":true,\"core.religion\":true,\"core.role\":true,\"core.user\":true,\"core.permissions.ajax_user_module_permission\":true,\"core.permissions.ajax_user_permission\":true,\"core.blood_group.edit\":true,\"core.blood_group.store\":true,\"core.blood_group.delete\":true,\"core.mediamanager.create\":true,\"core.mediamanager.rename\":true,\"core.mediamanager.delete \":true,\"core.mediamanager.upload\":true,\"core.mediamanager\":true,\"hrms.department.edit\":true,\"hrms.department.store\":true,\"hrms.department.delete\":true,\"hrms.designation.edit\":true,\"hrms.designation.store\":true,\"hrms.designation.delete\":true,\"core.blood_group\":true,\"hrms.dashboard\":true,\"hrms.department\":true,\"hrms.designation\":true}', 'core/dashboard', 1, NULL, NULL, '2021-01-15 05:01:15', '2022-10-26 05:56:17'),
(2, 'admin', 'Admin', '{\"core.branch\":true,\"core.branch.create\":true,\"core.branch.store\":true,\"core.branch.edit\":true,\"core.branch.delete\":true,\"core.dashboard\":true,\"core.permissions.update\":true,\"core.gender.edit\":true}', 'core/dashboard', 2, 1, 1, '2022-10-09 06:28:52', '2022-10-18 09:39:21');

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
  `name` varchar(150) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'Hrms', 'hrms', 1, '2022-10-26 05:56:38', '2022-10-26 05:56:38');

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
(1, 'Dashboard', 1, '{\"core.dashboard\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:51', '2022-10-26 05:55:51'),
(2, 'Settings', 1, '{\"core.settings\":[\"1\"],\"core.settings.store\":[\"1\"],\"core.settings.logo\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:51', '2022-10-26 05:55:51'),
(3, 'Module', 1, '{\"core.module\":[\"1\"],\"core.module.edit\":[\"1\"],\"core.module.store\":[\"1\"],\"core.module.delete\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:51', '2022-10-26 05:55:51'),
(4, 'Permissions', 1, '{\"core.permissions\":[\"1\"],\"core.permissions.create\":[\"1\"],\"core.permissions.store\":[\"1\"],\"core.permissions.edit\":[\"1\"],\"core.permissions.update\":[\"1\"],\"core.permissions.section_edit\":[\"1\"],\"core.permissions.section_update\":[\"1\"],\"core.permissions.ajax_add_remove\":[\"1\"],\"core.permissions.ajax_route_remove\":[\"1\"],\"core.permissions.ajax_get_sections\":[\"1\"],\"core.permissions.ajax_user_module_permission\":[\"1\"],\"core.permissions.ajax_user_permission\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:51', '2022-10-26 05:55:52'),
(5, 'Role', 1, '{\"core.role\":[\"1\"],\"core.role.create\":[\"1\"],\"core.role.store\":[\"1\"],\"core.role.edit\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:52', '2022-10-26 05:55:52'),
(6, 'User', 1, '{\"core.user\":[\"1\"],\"core.user.create\":[\"1\"],\"core.user.store\":[\"1\"],\"core.user.edit\":[\"1\"],\"core.user.update\":[\"1\"],\"core.user.delete\":[\"1\"],\"core.user.profile\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:52', '2022-10-26 05:55:52'),
(7, 'Branch', 1, '{\"core.branch\":[\"1\"],\"core.branch.create\":[\"1\"],\"core.branch.store\":[\"1\"],\"core.branch.edit\":[\"1\"],\"core.branch.delete\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:52', '2022-10-26 05:55:52'),
(8, 'Gender', 1, '{\"core.gender\":[\"1\"],\"core.gender.edit\":[\"1\"],\"core.gender.store\":[\"1\"],\"core.gender.delete\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:52', '2022-10-26 05:55:52'),
(9, 'Religion', 1, '{\"core.religion\":[\"1\"],\"core.religion.edit\":[\"1\"],\"core.religion.store\":[\"1\"],\"core.religion.delete\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:53', '2022-10-26 05:55:53'),
(10, 'Blood Group', 1, '{\"core.blood_group\":[\"1\"],\"core.blood_group.edit\":[\"1\"],\"core.blood_group.store\":[\"1\"],\"core.blood_group.delete\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:53', '2022-10-26 05:55:53'),
(11, 'Mediamanager', 1, '{\"core.mediamanager\":[\"1\"],\"core.mediamanager.create\":[\"1\"],\"core.mediamanager.rename\":[\"1\"],\"core.mediamanager.delete \":[\"1\"],\"core.mediamanager.upload\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:53', '2022-10-26 05:55:53'),
(12, 'Dashboard', 2, '{\"hrms.dashboard\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:53', '2022-10-26 05:55:53'),
(13, 'Department', 2, '{\"hrms.department\":[\"1\"],\"hrms.department.edit\":[\"1\"],\"hrms.department.store\":[\"1\"],\"hrms.department.delete\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:53', '2022-10-26 05:55:53'),
(14, 'Designation', 2, '{\"hrms.designation\":[\"1\"],\"hrms.designation.edit\":[\"1\"],\"hrms.designation.store\":[\"1\"],\"hrms.designation.delete\":[\"1\"]}', '[\"1\"]', '2022-10-26 05:55:53', '2022-10-26 05:55:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_religion`
--

CREATE TABLE `tbl_religion` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `order_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_religion`
--

INSERT INTO `tbl_religion` (`id`, `name`, `order_by`, `created_at`, `updated_at`) VALUES
(1, 'Islam', 1, '2022-10-05 07:17:11', '2022-10-07 08:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
(1, 'Tax1', 5, 1, NULL, '2022-10-05 12:00:01'),
(2, 'Tax2', 15, 1, NULL, '2022-10-05 12:00:01');

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

INSERT INTO `users` (`id`, `full_name`, `user_name`, `phone`, `email`, `last_login`, `branch_id`, `permissions`, `m_permission`, `password`, `directory`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL, 'admin@mail.com', '2022-10-26 05:40:44', NULL, NULL, NULL, '$2y$10$q/299XWGkxS0IqX7c.dwPO0C8.xmRm87IhbOrEQnfyeg6LypKI3M6', '', NULL, NULL, '2021-01-15 00:37:06', '2022-10-26 05:40:44'),
(2, 'Rasel', 'rasel', '01911054866', 'rasel@gmail.com', '2022-10-09 16:25:43', 1, NULL, NULL, '$2y$10$GHiH2cpMTxJQoSITYzVZJefwBnqhaWFyJwkPmV9r9waThGVEwmmqC', NULL, NULL, NULL, '2022-10-09 16:22:04', '2022-10-09 16:30:43'),
(3, 'test', 'test@mail.com', '01911', 'test@gmail.com', NULL, 1, NULL, NULL, '$2y$10$sDMW30a2ML6q2H3/RkRLkuzVYOxtLe/nGSo3taJ1Pp/yLdq6dQAr.', NULL, NULL, NULL, '2022-10-18 09:47:31', '2022-10-18 09:47:31'),
(4, 'ruble', 'ruble', '455', 'ruble@gmail.com', NULL, 1, NULL, NULL, '$2y$10$WyF/vbAD0w4xEbfGa8t8BuJursb6aPOXzLhPaCGqUa/roN/tF8/hK', '4-1666086791', NULL, NULL, '2022-10-18 09:53:10', '2022-10-18 09:53:11');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hrms_designations`
--
ALTER TABLE `hrms_designations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_module_sections`
--
ALTER TABLE `tbl_module_sections`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_religion`
--
ALTER TABLE `tbl_religion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
