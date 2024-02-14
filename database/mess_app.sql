-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 14, 2024 at 05:31 PM
-- Server version: 11.2.2-MariaDB
-- PHP Version: 8.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mess_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `collection_name` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `file_name` varchar(191) NOT NULL,
  `mime_type` varchar(191) DEFAULT NULL,
  `disk` varchar(191) NOT NULL,
  `conversions_disk` varchar(191) DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `media_order_column_index` (`order_column`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\MessOwner', 1, 'dfda8be9-2d61-4db0-afdd-4659ed06492d', 'MESS_LOGO_IMAGE', 'Mens', 'Mens.png', 'image/png', 'public', 'public', 65806, '[]', '[]', '[]', '[]', 1, '2024-02-13 13:33:24', '2024-02-13 13:33:24'),
(2, 'App\\Models\\MessOwner', 2, '8fac2ba5-7baa-42f0-b265-c6604b167e3e', 'MESS_LOGO_IMAGE', 'Mens', 'Mens.png', 'image/png', 'public', 'public', 65806, '[]', '[]', '[]', '[]', 1, '2024-02-13 13:34:09', '2024-02-13 13:34:09'),
(3, 'App\\Models\\MessOwner', 3, 'db7a59b1-6cba-45d6-aa7a-1657840fc21c', 'MESS_LOGO_IMAGE', 'Red2', 'Red2.jpg', 'image/jpeg', 'public', 'public', 19502, '[]', '[]', '[]', '[]', 1, '2024-02-13 13:36:18', '2024-02-13 13:36:18'),
(4, 'App\\Models\\MessOwner', 1, '1ad97db1-0588-492d-8f18-ad4e911c31c1', 'MESS_LOGO_IMAGE', 'Mens', 'Mens.png', 'image/png', 'public', 'public', 65806, '[]', '[]', '[]', '[]', 2, '2024-02-13 14:44:29', '2024-02-13 14:44:29'),
(5, 'App\\Models\\MessOwner', 1, '850175ae-7f15-4652-8719-6e2ceb3e6ccc', 'MESS_LOGO_IMAGE', 'Mens', 'Mens.png', 'image/png', 'public', 'public', 65806, '[]', '[]', '[]', '[]', 3, '2024-02-13 14:45:02', '2024-02-13 14:45:02'),
(6, 'App\\Models\\MessOwner', 1, 'af49196b-1bbd-41ac-9de2-c031da6cc8e0', 'MESS_LOGO_IMAGE', 'Mens', 'Mens.png', 'image/png', 'public', 'local', 65806, '[]', '[]', '[]', '[]', 4, '2024-02-13 14:46:00', '2024-02-13 14:46:00'),
(7, 'App\\Models\\MessOwner', 1, 'baadfe3a-5443-4721-9d43-cffd980e826c', 'MESS_LOGO_IMAGE', 'Mens', 'Mens.png', 'image/png', 'public', 'local', 65806, '[]', '[]', '[]', '[]', 5, '2024-02-13 14:46:59', '2024-02-13 14:46:59'),
(8, 'App\\Models\\MessOwner', 1, '13eeebf2-7881-45a2-b672-0201ad530c86', 'MESS_LOGO_IMAGE', 'Mens', 'Mens.png', 'image/png', 'public', 'local', 65806, '[]', '[]', '[]', '[]', 6, '2024-02-13 14:49:53', '2024-02-13 14:49:53'),
(13, 'App\\Models\\Settings', 1, '0d191ffa-74cf-49ea-95a0-aa5adcf99b50', 'SITE_LOGO', 'CompLap', 'CompLap.png', 'image/png', 'public', 'local', 167508, '[]', '[]', '[]', '[]', 1, '2024-02-14 11:58:45', '2024-02-14 11:58:45'),
(14, 'App\\Models\\Settings', 1, 'dd939cd0-9d50-449e-82c0-07923c732e5b', 'SITE_LOGO', 'CompLap', 'CompLap.png', 'image/png', 'public', 'local', 167508, '[]', '[]', '[]', '[]', 2, '2024-02-14 11:59:21', '2024-02-14 11:59:21');

-- --------------------------------------------------------

--
-- Table structure for table `mess_owner`
--

DROP TABLE IF EXISTS `mess_owner`;
CREATE TABLE IF NOT EXISTS `mess_owner` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `mess_name` varchar(191) NOT NULL,
  `mess_description` longtext DEFAULT NULL,
  `food_type` enum('veg','non_veg') NOT NULL,
  `non_veg_price` double(10,2) DEFAULT NULL,
  `veg_price` double(10,2) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mess_owner_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mess_owner`
--

INSERT INTO `mess_owner` (`id`, `user_id`, `mess_name`, `mess_description`, `food_type`, `non_veg_price`, `veg_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'Monu\'s Mess', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bono', 'veg', NULL, NULL, NULL, '2024-02-13 13:33:24', '2024-02-13 13:33:24'),
(2, 5, 'Monu\'s Mess', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bono', 'veg', NULL, NULL, NULL, '2024-02-13 13:34:09', '2024-02-13 13:34:09'),
(3, 6, 'Deepanshu\'s mess', 'dfsgdgdsfgdfgfdsgsfdgdfgdfg', 'veg', NULL, NULL, NULL, '2024-02-13 13:36:18', '2024-02-13 13:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_02_10_190510_site_settings', 1),
(7, '2024_02_10_191738_create_media_table', 1),
(8, '2024_02_12_173056_mess_owner_table', 1),
(9, '2024_02_12_201537_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`) USING HASH
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`) USING HASH
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', 'web', '2024-02-13 13:08:15', '2024-02-13 13:08:15'),
(2, 'MESS_OWNER', 'web', '2024-02-13 13:33:13', '2024-02-13 13:33:13'),
(3, 'CUSTOMER', 'web', '2024-02-13 13:33:13', '2024-02-13 13:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `meta_title` varchar(191) DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `mobile_no` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `gst` varchar(191) DEFAULT NULL,
  `about_us` longtext DEFAULT NULL,
  `terms_condition` longtext DEFAULT NULL,
  `privacy_policy` longtext DEFAULT NULL,
  `return_refund` longtext DEFAULT NULL,
  `analytics_code` longtext DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `title`, `description`, `meta_title`, `meta_description`, `mobile_no`, `email`, `address`, `gst`, `about_us`, `terms_condition`, `privacy_policy`, `return_refund`, `analytics_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'dfgsgdfgdfg', 'echo \"<pre>\";\r\n        echo \"<pre>\";\r\n        echo \"<pre>\";\r\n        echo \"<pre>\";\r\n        echo \"<pre>\";', 'echo \"<pre>\";         echo \"<pre>\";         echo \"<pre>\";         echo \"<pre>\";', 'echo \"<pre>\";\r\n        echo \"<pre>\";\r\n        echo \"<pre>\";\r\n        echo \"<pre>\";\r\n        echo \"<pre>\";', 'echo \"<pre>\";         echo \"<pre>\";         echo \"<pre>\";         echo \"<pre>\";', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-14 11:19:06', '2024-02-14 11:27:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '2024-02-13 13:08:50', '$2y$12$1YOffyX/iDTSFD0hUfgCCeULq6k6P4Tgph3N6dQRV26k1KJmbvsTK', '9MDpYc2m0iS4yHsEiuSl5g5BAkdVntFgc3hkhwaoOYAj3Y1PDnDtBL6UoruR', '2024-02-13 13:08:50', '2024-02-13 13:08:50'),
(2, 'Monu Mishra', 'monu@gmail.com', NULL, NULL, '$2y$12$VerRah41PlgzhHGv6apequOlWq5BqtfjQx3CG1XgsBNeA1gI2ufQK', NULL, '2024-02-13 13:31:57', '2024-02-13 13:31:57'),
(3, 'Monu Mishra', 'monu_mess@gmail.com', NULL, NULL, '$2y$12$wRThh2GLwOu2h.e2/GWKju7IcvqFuFYi4lV6KsVCasZr/7r1HW22.', NULL, '2024-02-13 13:32:45', '2024-02-13 13:32:45'),
(4, 'Monu Mishra', 'monu_mess1234@gmail.com', NULL, NULL, '$2y$12$cTLJDWe6x6DpO0.zljZnz.KUM6bIqyg9GAqooUi5dWxrBDSF92BkW', NULL, '2024-02-13 13:33:24', '2024-02-13 13:33:24'),
(5, 'Monu Mishra', 'monu_mess45677@gmail.com', NULL, NULL, '$2y$12$9sPDaaA9FhspVBZHHoQggObPJe4DXhBDrgNmwa2zjYWJ3ln9CshE2', NULL, '2024-02-13 13:34:09', '2024-02-13 13:34:09'),
(6, 'Deepanshu Mishra', 'deepanshu@gmail.com', NULL, NULL, '$2y$12$4uPHFmE4at2zw4LqGhnqbeX94HMLeVnJ.pYek3QCLXbZVtXJ5lxo6', NULL, '2024-02-13 13:36:18', '2024-02-13 13:36:18');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
