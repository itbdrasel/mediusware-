-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2023 at 07:34 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.2.0

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
(4, 4, 'UqgfG2qcr3MNtPNJ7V24YbVszqhlPrvM', 1, '2023-02-15 18:20:35', '2022-10-18 09:53:11', '2022-10-18 09:53:11');

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
(1, 'Web Developer', 2, 1, NULL, '2022-04-09 01:54:55', '2023-02-15 16:47:26'),
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
(10, 'Housemaid', 10, '2022-05-09 04:53:49', '2023-02-15 16:54:58');

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
(88, 1, 'YoDiouXC522RhkR21Pjalhtdw9lYEVY5', '2023-02-17 16:33:59', '2023-02-17 16:33:59'),
(89, 1, '8ZnzFiYdXSLGnI893uNsWppB0M6kMeHF', '2023-02-19 16:11:58', '2023-02-19 16:11:58'),
(90, 1, 'C4hpgzvR30aaVKPw5ltfiRzZTHkNmNq2', '2023-02-21 05:02:36', '2023-02-21 05:02:36'),
(91, 1, '6G5GA4gWk58iIIVIRW58QmXu1xh1aHFC', '2023-02-21 16:09:57', '2023-02-21 16:09:57'),
(92, 1, '2D72OGkBw7DkhLFRwE4Xui8NZSbHWjdE', '2023-02-22 17:08:35', '2023-02-22 17:08:35'),
(93, 1, 'GwrKzScOsQccQI8thRTZSsHgMW3sby02', '2023-02-24 12:11:03', '2023-02-24 12:11:03'),
(94, 1, 'RyMyWerRLsEIWcGp9zehUFOh7mBzEvZR', '2023-02-25 16:17:57', '2023-02-25 16:17:57'),
(95, 1, '2D45xpKl6KvrzFdGfbqTD8USILhjJRCA', '2023-02-26 16:18:45', '2023-02-26 16:18:45'),
(96, 1, 'S2xeI8G7lA9hcDojyKDdwXRnYxH775KC', '2023-02-28 17:09:20', '2023-02-28 17:09:20');

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
(1, 'administrator', 'Administrator', '{\"core.permissions.ajax_user_module\":true,\"core.role.create\":true,\"core.role.store\":true,\"core.role.edit\":true,\"core.user.create\":true,\"core.user.store\":true,\"core.user.edit\":true,\"core.user.update\":true,\"core.user.delete\":true,\"core.user.profile\":true,\"core.branch.create\":true,\"core.branch.store\":true,\"core.branch.edit\":true,\"core.branch.delete\":true,\"core.gender.edit\":true,\"core.gender.store\":true,\"core.gender.delete\":true,\"core.religion.edit\":true,\"core.religion.store\":true,\"core.religion.delete\":true,\"core.module\":true,\"core.module.delete\":true,\"core.module.edit\":true,\"core.module.store\":true,\"core.settings\":true,\"core.settings.store\":true,\"core.settings.logo\":true,\"core.dashboard\":true,\"core.permissions.create\":true,\"core.permissions.store\":true,\"core.permissions.edit\":true,\"core.permissions.update\":true,\"core.permissions.section_edit\":true,\"core.permissions.section_update\":true,\"core.permissions.ajax_add_remove\":true,\"core.permissions.ajax_route_remove\":true,\"core.permissions.ajax_get_sections\":true,\"core.branch\":true,\"core.gender\":true,\"core.permissions\":true,\"core.religion\":true,\"core.role\":true,\"core.user\":true,\"core.permissions.ajax_user_module_permission\":true,\"core.permissions.ajax_user_permission\":true,\"core.blood_group.edit\":true,\"core.blood_group.store\":true,\"core.blood_group.delete\":true,\"core.mediamanager.create\":true,\"core.mediamanager.rename\":true,\"core.mediamanager.delete \":true,\"core.mediamanager.upload\":true,\"core.mediamanager\":true,\"hrms.department.edit\":true,\"hrms.department.store\":true,\"hrms.department.delete\":true,\"hrms.designation.edit\":true,\"hrms.designation.store\":true,\"hrms.designation.delete\":true,\"core.blood_group\":true,\"hrms.dashboard\":true,\"hrms.department\":true,\"hrms.designation\":true,\"core.mediamanager.delete\":true,\"core.user.permission\":true,\"hrms.employee.create\":true,\"hrms.employee.edit\":true,\"hrms.employee.store\":true,\"hrms.employee.show\":true,\"hrms.employee.delete\":true,\"scms.group.edit\":true,\"scms.group.store\":true,\"scms.group.delete\":true,\"scms.shift.edit\":true,\"scms.shift.store\":true,\"scms.shift.delete\":true,\"scms.dashboard\":true,\"scms.group\":true,\"scms.shift\":true,\"scms.class.edit\":true,\"scms.class.store\":true,\"scms.class.delete\":true,\"scms.class\":true,\"hrms.employee\":true,\"scms.student.edit\":true,\"scms.student.store\":true,\"scms.student.delete\":true,\"scms.student\":true,\"scms.section.edit\":true,\"scms.section.store\":true,\"scms.section.delete\":true,\"scms.section\":true,\"scms.section.create\":true,\"scms.student.create\":true}', 'core/dashboard', 1, NULL, NULL, '2021-01-15 05:01:15', '2023-01-02 17:28:58'),
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
(4, 2, '2022-10-18 09:53:11', '2023-02-15 18:20:35');

-- --------------------------------------------------------

--
-- Table structure for table `scms_class`
--

CREATE TABLE `scms_class` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scms_class`
--

INSERT INTO `scms_class` (`id`, `name`, `teacher_id`, `order_by`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'Class Nursary', 4, 1, 1, '2022-10-05 07:17:11', '2023-02-14 18:41:20'),
(2, 'One', 4, 1, 1, '2022-11-11 14:09:15', '2022-11-12 06:34:44'),
(3, 'Class Two', 4, 2, 1, '2022-11-11 14:09:23', '2022-11-12 06:36:36'),
(4, 'Three', 4, 3, 1, '2023-02-21 07:20:12', '2023-02-21 07:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `scms_class_categories`
--

CREATE TABLE `scms_class_categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_year` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_year` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `vtype` tinyint(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scms_class_categories`
--

INSERT INTO `scms_class_categories` (`id`, `name`, `start_year`, `end_year`, `branch_id`, `vtype`, `created_at`, `updated_at`) VALUES
(1, 'Nursary - One', NULL, NULL, 1, 1, '2023-02-19 18:10:34', '2023-02-25 17:07:48'),
(2, 'Two - Three', NULL, NULL, 1, 1, '2023-02-25 17:07:28', '2023-02-25 17:07:28');

-- --------------------------------------------------------

--
-- Table structure for table `scms_class_group`
--

CREATE TABLE `scms_class_group` (
  `id` bigint(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scms_class_group`
--

INSERT INTO `scms_class_group` (`id`, `category_id`, `class_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2023-02-21 06:35:33', '2023-02-25 17:07:48'),
(5, 2, 3, 1, '2023-02-25 17:07:28', '2023-02-25 17:07:28'),
(6, 2, 4, 1, '2023-02-25 17:07:29', '2023-02-25 17:07:29'),
(7, 1, 4, 1, '2023-02-25 17:07:48', '2023-02-25 17:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `scms_class_group_rules`
--

CREATE TABLE `scms_class_group_rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_group_id` int(10) UNSIGNED NOT NULL,
  `exam_id` int(10) UNSIGNED NOT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `vtype` tinyint(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scms_class_group_rules`
--

INSERT INTO `scms_class_group_rules` (`id`, `class_group_id`, `exam_id`, `branch_id`, `vtype`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, 1, '2023-02-22 18:24:37', '2023-02-26 18:40:19');

-- --------------------------------------------------------

--
-- Table structure for table `scms_enroll`
--

CREATE TABLE `scms_enroll` (
  `id` bigint(20) UNSIGNED NOT NULL,
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

--
-- Dumping data for table `scms_enroll`
--

INSERT INTO `scms_enroll` (`id`, `student_id`, `class_id`, `section_id`, `group_id`, `shift`, `roll`, `year`, `vtype`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, 1, '1', '2021-2022', 1, '2022-12-25 07:07:34', '2022-12-30 12:00:35'),
(2, 2, 1, 1, 1, 2, '2', '2021-2022', 1, '2022-12-30 15:00:03', '2023-02-19 18:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `scms_exam`
--

CREATE TABLE `scms_exam` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prent_id` int(11) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1== Single Exam, 2== Multiple Exam',
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `vtype` tinyint(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scms_exam`
--

INSERT INTO `scms_exam` (`id`, `name`, `prent_id`, `type`, `comment`, `order_by`, `branch_id`, `vtype`, `created_at`, `updated_at`) VALUES
(1, 'Test', NULL, 1, NULL, 5, 1, 1, '2023-01-06 12:39:11', '2023-01-06 12:48:10'),
(2, 'Pre Test', NULL, 1, 'df', 4, 1, 1, '2023-01-06 12:44:15', '2023-01-06 12:48:28'),
(3, 'Half Yearly', 5, 1, NULL, 1, 1, 1, '2023-01-06 12:44:38', '2023-01-06 12:46:24'),
(4, 'Annual', 5, 1, NULL, 2, 1, 1, '2023-01-06 12:44:54', '2023-01-06 12:46:42'),
(5, 'Final', NULL, 2, NULL, 3, 1, 1, '2023-01-06 12:45:18', '2023-01-06 12:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `scms_exam_rules`
--

CREATE TABLE `scms_exam_rules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `vtype` tinyint(2) NOT NULL DEFAULT 1,
  `order_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scms_exam_rules`
--

INSERT INTO `scms_exam_rules` (`id`, `name`, `code`, `branch_id`, `vtype`, `order_by`, `created_at`, `updated_at`) VALUES
(1, 'Creative Question', 'CQ', 1, 1, 1, '2023-02-21 07:06:50', '2023-02-21 07:08:27'),
(2, 'Multipule Chosse Question', 'MCQ', 2, 1, 2, '2023-02-21 07:13:39', '2023-02-21 07:13:39'),
(3, 'Multipule Chosse Question', 'MCQ', 2, 1, 2, '2023-02-21 07:14:34', '2023-02-21 07:14:34'),
(4, 'Multipule Chosse Question', 'MCQ', 1, 1, 2, '2023-02-21 07:15:56', '2023-02-21 07:16:12');

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
(1, 'Humanities', 1, '2022-10-05 07:17:11', '2023-02-15 15:57:49'),
(2, 'Science', 2, '2022-11-11 14:09:15', '2023-02-15 16:00:16'),
(3, 'Business Studies', 3, '2022-11-11 14:09:23', '2022-11-11 14:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `scms_optional_subject`
--

CREATE TABLE `scms_optional_subject` (
  `id` bigint(20) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `student_id` bigint(20) DEFAULT NULL,
  `o_subjects` varbinary(255) DEFAULT NULL,
  `four_subject` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scms_optional_subject`
--

INSERT INTO `scms_optional_subject` (`id`, `class_id`, `student_id`, `o_subjects`, `four_subject`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0x7b2237223a2237227d, 5, '2023-01-03 19:05:20', '2023-01-04 17:24:15'),
(2, 1, 2, 0x7b2233223a2233222c2237223a2237227d, 6, '2023-01-03 19:05:20', '2023-01-04 17:56:32');

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
(1, 'Sobahan Molla', '01911054866', '', '', '', NULL, 'Sobahan Molla', '', NULL, 'Shafia', '', NULL, '2022-12-25 07:07:34', '2022-12-30 12:00:35'),
(2, 'Father', '5454', '', '', '', NULL, 'Father', '55', NULL, 'Mother', '45', NULL, '2022-12-30 15:00:02', '2023-02-19 18:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `scms_result_publish`
--

CREATE TABLE `scms_result_publish` (
  `id` bigint(20) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `year` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vtype` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scms_result_publish`
--

INSERT INTO `scms_result_publish` (`id`, `exam_id`, `year`, `vtype`, `created_at`, `updated_at`) VALUES
(1, 4, '2021-2022', 1, '2023-01-06 18:15:56', '2023-02-15 16:14:25'),
(2, 2, '2020-2021', 1, '2023-01-06 18:47:13', '2023-01-06 18:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `scms_rules_marks`
--

CREATE TABLE `scms_rules_marks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rules_marks_manage_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `full_mark` int(6) UNSIGNED NOT NULL,
  `rule_id` bigint(20) UNSIGNED NOT NULL,
  `pass_mark` int(6) UNSIGNED NOT NULL,
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scms_rules_marks_manage`
--

CREATE TABLE `scms_rules_marks_manage` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `start_year` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_year` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calculation_subject` tinyint(4) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `vtype` tinyint(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scms_rule_manage`
--

CREATE TABLE `scms_rule_manage` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_group_rule_id` bigint(20) UNSIGNED NOT NULL,
  `rule_id` int(11) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scms_rule_manage`
--

INSERT INTO `scms_rule_manage` (`id`, `class_group_rule_id`, `rule_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 1, '2023-02-25 18:25:58', '2023-02-26 18:40:19'),
(4, 1, 4, 1, '2023-02-26 18:40:19', '2023-02-26 18:40:19');

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
(1, 'A', 4, 'A', 1, 1, NULL, '2022-11-13 17:42:16', '2023-02-14 18:11:58'),
(2, 'B', NULL, 'B', 1, 2, NULL, '2022-11-13 17:45:33', '2023-02-13 18:46:08'),
(3, 'A', NULL, NULL, 2, NULL, NULL, '2022-11-13 17:48:01', '2022-11-13 17:49:43'),
(4, 'B', 4, 'B', 2, 1, NULL, '2023-02-06 16:30:47', '2023-02-06 18:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `scms_settings`
--

CREATE TABLE `scms_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scms_settings`
--

INSERT INTO `scms_settings` (`id`, `name`, `value`, `updated_at`) VALUES
(1, 'running_year', '2021-2022', '2022-11-26 18:25:42'),
(3, 'vtype', '1', '2022-11-27 17:51:55'),
(2, 'r_year_format', '1', '2023-02-26 16:55:15'),
(4, 'student_sms', '', NULL),
(5, 'student_email', '', NULL);

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
(2, 'Morning', 2, '2022-11-11 14:15:25', '2023-02-15 16:17:39');

-- --------------------------------------------------------

--
-- Table structure for table `scms_student`
--

CREATE TABLE `scms_student` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `religion_id` int(11) DEFAULT NULL,
  `blood_group_id` int(11) DEFAULT NULL,
  `address` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `dormitory_id` int(11) DEFAULT NULL,
  `transport_id` int(11) DEFAULT NULL,
  `agent_banking_no` varchar(42) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `scms_student`
--

INSERT INTO `scms_student` (`id`, `id_number`, `name`, `phone`, `email`, `password`, `birthday`, `gender_id`, `religion_id`, `blood_group_id`, `address`, `photo`, `parent_id`, `dormitory_id`, `transport_id`, `agent_banking_no`, `branch_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '123456', 'Rasel Hossain', '01911054866', NULL, NULL, '1994-12-04', 1, 1, 1, NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2022-12-25 07:07:34', '2022-12-30 12:00:35'),
(2, '123457', 'Sakib', '019545', NULL, NULL, '2022-12-30', 1, 1, 1, NULL, NULL, 2, NULL, NULL, NULL, 1, 1, '2022-12-30 15:00:02', '2023-02-19 18:08:22');

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
  `subject_type` int(11) DEFAULT NULL,
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
(3, 'Mathematics', '103', 1, NULL, NULL, NULL, NULL, 4, NULL, NULL, '100', 4, 2, 1, '2022-12-29 04:43:41', '2022-12-29 04:43:41'),
(4, 'General Science', '104', 1, NULL, NULL, NULL, NULL, 4, NULL, NULL, '100', 2, 4, 1, '2022-12-29 04:44:52', '2022-12-29 04:48:02'),
(5, 'Higher Mathematics', '105', 1, NULL, NULL, NULL, NULL, 4, NULL, NULL, '100', 3, 5, 1, '2022-12-29 04:46:34', '2022-12-29 04:46:34'),
(6, 'Home science', '106', 1, 1, NULL, NULL, NULL, 5, NULL, NULL, '100', 3, 6, 1, '2022-12-29 04:47:38', '2022-12-29 04:47:50'),
(7, 'Religion Islam', '107', 1, NULL, NULL, NULL, NULL, 4, NULL, NULL, '100', 4, 7, 1, '2022-12-29 04:49:30', '2022-12-30 11:33:30');

-- --------------------------------------------------------

--
-- Table structure for table `scms_subject_type`
--

CREATE TABLE `scms_subject_type` (
  `id` tinyint(2) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scms_subject_type`
--

INSERT INTO `scms_subject_type` (`id`, `name`) VALUES
(1, 'Compulsory Subject'),
(2, 'Elective Subject'),
(3, '4th Subject'),
(4, 'Optional Subject');

-- --------------------------------------------------------

--
-- Table structure for table `scms_versions`
--

CREATE TABLE `scms_versions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scms_versions`
--

INSERT INTO `scms_versions` (`id`, `name`) VALUES
(1, 'Bangla'),
(2, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `scms_version_type`
--

CREATE TABLE `scms_version_type` (
  `id` int(11) NOT NULL,
  `name` varchar(111) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scms_version_type`
--

INSERT INTO `scms_version_type` (`id`, `name`, `status`) VALUES
(1, 'বাংলা (Bangla)', 1),
(2, 'English', 1);

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
(1, 'AB', 1, '2022-04-09 01:54:55', '2023-02-15 17:19:23');

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
(3, 'Scms', 'scms', 1, '2022-11-11 14:10:42', '2023-02-15 18:21:03');

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
(1, 'Admin', NULL, NULL, 'admin@mail.com', '2023-02-28 17:09:20', NULL, NULL, NULL, NULL, '$2y$10$q/299XWGkxS0IqX7c.dwPO0C8.xmRm87IhbOrEQnfyeg6LypKI3M6', '', NULL, NULL, '2021-01-15 00:37:06', '2023-02-28 17:09:20'),
(2, 'Rasel', 'rasel', '01911054866', 'rasel@gmail.com', '2022-10-09 16:25:43', 1, NULL, '{\"core.blood_group\":true}', NULL, '$2y$10$GHiH2cpMTxJQoSITYzVZJefwBnqhaWFyJwkPmV9r9waThGVEwmmqC', NULL, NULL, NULL, '2022-10-09 16:22:04', '2022-10-28 19:05:57'),
(3, 'test', 'test@mail.com', '01911', 'test@gmail.com', NULL, 1, NULL, NULL, NULL, '$2y$10$sDMW30a2ML6q2H3/RkRLkuzVYOxtLe/nGSo3taJ1Pp/yLdq6dQAr.', NULL, NULL, NULL, '2022-10-18 09:47:31', '2022-10-18 09:47:31'),
(4, 'Ruble', 'ruble', '455', 'ruble@gmail.com', NULL, 1, NULL, NULL, NULL, '$2y$10$WyF/vbAD0w4xEbfGa8t8BuJursb6aPOXzLhPaCGqUa/roN/tF8/hK', '4-1666086791', NULL, NULL, '2022-10-18 09:53:10', '2023-02-15 18:20:35');

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
-- Indexes for table `scms_class_categories`
--
ALTER TABLE `scms_class_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_class_group`
--
ALTER TABLE `scms_class_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_class_group_rules`
--
ALTER TABLE `scms_class_group_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_enroll`
--
ALTER TABLE `scms_enroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_exam`
--
ALTER TABLE `scms_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_exam_rules`
--
ALTER TABLE `scms_exam_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_groups`
--
ALTER TABLE `scms_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_optional_subject`
--
ALTER TABLE `scms_optional_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_parent`
--
ALTER TABLE `scms_parent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_result_publish`
--
ALTER TABLE `scms_result_publish`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_rules_marks`
--
ALTER TABLE `scms_rules_marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_rules_marks_manage`
--
ALTER TABLE `scms_rules_marks_manage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_rule_manage`
--
ALTER TABLE `scms_rule_manage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_sections`
--
ALTER TABLE `scms_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_settings`
--
ALTER TABLE `scms_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `s_name` (`name`);

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
-- Indexes for table `scms_subject`
--
ALTER TABLE `scms_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_subject_type`
--
ALTER TABLE `scms_subject_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_versions`
--
ALTER TABLE `scms_versions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scms_version_type`
--
ALTER TABLE `scms_version_type`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `scms_class_categories`
--
ALTER TABLE `scms_class_categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scms_class_group`
--
ALTER TABLE `scms_class_group`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `scms_class_group_rules`
--
ALTER TABLE `scms_class_group_rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scms_enroll`
--
ALTER TABLE `scms_enroll`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scms_exam`
--
ALTER TABLE `scms_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `scms_exam_rules`
--
ALTER TABLE `scms_exam_rules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `scms_groups`
--
ALTER TABLE `scms_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `scms_optional_subject`
--
ALTER TABLE `scms_optional_subject`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scms_parent`
--
ALTER TABLE `scms_parent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scms_result_publish`
--
ALTER TABLE `scms_result_publish`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scms_rules_marks`
--
ALTER TABLE `scms_rules_marks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scms_rules_marks_manage`
--
ALTER TABLE `scms_rules_marks_manage`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scms_rule_manage`
--
ALTER TABLE `scms_rule_manage`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `scms_sections`
--
ALTER TABLE `scms_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `scms_settings`
--
ALTER TABLE `scms_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `scms_shift`
--
ALTER TABLE `scms_shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scms_student`
--
ALTER TABLE `scms_student`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scms_subject`
--
ALTER TABLE `scms_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `scms_subject_type`
--
ALTER TABLE `scms_subject_type`
  MODIFY `id` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `scms_versions`
--
ALTER TABLE `scms_versions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scms_version_type`
--
ALTER TABLE `scms_version_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
