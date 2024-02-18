-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 18, 2024 at 08:27 PM
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
-- Table structure for table `customer_menus`
--

DROP TABLE IF EXISTS `customer_menus`;
CREATE TABLE IF NOT EXISTS `customer_menus` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `meal_type` enum('veg','non_veg') NOT NULL,
  `breakfast` tinyint(1) NOT NULL DEFAULT 0,
  `lunch` tinyint(1) NOT NULL DEFAULT 0,
  `dinner` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_menus_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_menus`
--

INSERT INTO `customer_menus` (`id`, `user_id`, `meal_type`, `breakfast`, `lunch`, `dinner`, `status`, `created_at`, `updated_at`) VALUES
(1, 14, 'veg', 1, 1, 1, '', '2024-02-18 12:28:56', '2024-02-18 12:28:56'),
(2, 15, 'veg', 1, 1, 1, '', '2024-02-18 12:29:59', '2024-02-18 12:29:59'),
(3, 17, 'non_veg', 1, 1, 1, '', '2024-02-18 13:35:10', '2024-02-18 14:22:00'),
(4, 18, 'veg', 1, 1, 1, '', '2024-02-18 14:36:54', '2024-02-18 14:36:54');

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
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(37, 'App\\Models\\MessOwner', 7, 'e43e27d4-ce67-4318-a5ff-cc79f549917f', 'MESS_BANNER', 'imags', 'imags.png', 'image/png', 'public', 'public', 100947, '[]', '[]', '[]', '[]', 2, '2024-02-18 13:34:11', '2024-02-18 13:34:11'),
(30, 'App\\Models\\MessOwner', 4, 'c8e04031-f500-4aa8-af4e-cda050625869', 'MESS_LOGO_IMAGE', 'doc-pic', 'doc-pic.png', 'image/png', 'public', 'public', 44885, '[]', '[]', '[]', '[]', 1, '2024-02-14 13:57:19', '2024-02-14 13:57:19'),
(3, 'App\\Models\\MessOwner', 3, 'db7a59b1-6cba-45d6-aa7a-1657840fc21c', 'MESS_LOGO_IMAGE', 'Red2', 'Red2.jpg', 'image/jpeg', 'public', 'public', 19502, '[]', '[]', '[]', '[]', 1, '2024-02-13 13:36:18', '2024-02-13 13:36:18'),
(36, 'App\\Models\\MessOwner', 7, '23840f38-abd4-47cf-bd89-38f708ae606b', 'MESS_LOGO_IMAGE', 'doc-pic', 'doc-pic.png', 'image/png', 'public', 'public', 44885, '[]', '[]', '[]', '[]', 1, '2024-02-18 13:34:11', '2024-02-18 13:34:11'),
(34, 'App\\Models\\Menu', 1, '28ac1a30-d985-4e99-803c-344c18fc59f4', 'MENU_TEMPLATE', 'doc-pic', 'doc-pic.png', 'image/png', 'public', 'local', 44885, '[]', '[]', '[]', '[]', 1, '2024-02-15 14:17:38', '2024-02-15 14:17:38'),
(32, 'App\\Models\\MessOwner', 5, '4018199a-7eff-463a-9820-faa3a36e6cdc', 'MESS_LOGO_IMAGE', 'doc-pic', 'doc-pic.png', 'image/png', 'public', 'public', 44885, '[]', '[]', '[]', '[]', 1, '2024-02-15 13:00:17', '2024-02-15 13:00:17'),
(35, 'App\\Models\\User', 15, '5d6ff617-af4b-41f4-bffa-4806435929f3', 'CUSTOMER_PHOTO', 'imags', 'imags.png', 'image/png', 'public', 'public', 100947, '[]', '[]', '[]', '[]', 1, '2024-02-18 12:29:59', '2024-02-18 12:29:59'),
(25, 'App\\Models\\Settings', 1, 'de284d8a-3d78-49be-b0f6-00600c009475', 'SITE_BANNER', 'imags', 'imags.png', 'image/png', 'public', 'local', 100947, '[]', '[]', '[]', '[]', 2, '2024-02-14 12:29:21', '2024-02-14 12:29:21'),
(29, 'App\\Models\\Settings', 1, 'f82e6ea6-ab9b-4f1d-95f3-196614d8be3b', 'SITE_LOGO', 'sucess-animation', 'sucess-animation.png', 'image/png', 'public', 'local', 36029, '[]', '[]', '[]', '[]', 4, '2024-02-14 12:58:40', '2024-02-14 12:58:40'),
(26, 'App\\Models\\Settings', 1, 'd831fcee-4466-42de-a08f-334f8668fe35', 'SITE_FAVICON', 'doc-pic', 'doc-pic.png', 'image/png', 'public', 'local', 44885, '[]', '[]', '[]', '[]', 3, '2024-02-14 12:29:21', '2024-02-14 12:29:21'),
(40, 'App\\Models\\Payment', 4, '6ef7fca1-2802-4727-a5e1-606a959128bb', 'PAYMENT_SCREENSHOT', 'imags', 'imags.png', 'image/png', 'public', 'public', 100947, '[]', '[]', '[]', '[]', 1, '2024-02-18 14:36:54', '2024-02-18 14:36:54');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `day` varchar(191) NOT NULL,
  `menu_type` varchar(191) NOT NULL,
  `mess_detail_breakfast` longtext DEFAULT NULL,
  `mess_detail_lunch` longtext DEFAULT NULL,
  `mess_detail_dinner` longtext DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_added_by_foreign` (`added_by`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `added_by`, `day`, `menu_type`, `mess_detail_breakfast`, `mess_detail_lunch`, `mess_detail_dinner`, `status`, `created_at`, `updated_at`) VALUES
(3, 6, 'Tue', 'dinner', '<p>Sbji Paratha</p>', '<p>Dal + Chawal + Sabzi + 4 Roti + Raita + Salad&nbsp;</p>', '<p>Dal + Chawal + Sabzi + 4 Roti + Raita + Salad + 1 Sweet</p>', NULL, '2024-02-16 14:25:00', '2024-02-16 14:25:00'),
(2, 6, 'Mon', 'dinner', '<p>Sbji Paratha</p>', '<p>Dal + Chawal + Sabzi + 4 Roti + Raita + Salad&nbsp;</p>', '<p>Dal + Chawal + Sabzi + 4 Roti + Raita + Salad + Sweet</p>', NULL, '2024-02-16 14:14:52', '2024-02-16 14:14:52'),
(4, 6, 'Wed', 'dinner', '<p>Egg Omlettessss</p>', '<p>Kadhai Paneer</p>', '<p>Veg paratha</p>', NULL, '2024-02-16 14:25:01', '2024-02-16 14:58:12'),
(6, 6, 'Thu', 'dinner', '<p>Aloo Sbji</p>', '<p>Dal Chawal</p>', '<p>Sbji Roti</p>', NULL, '2024-02-16 14:26:17', '2024-02-16 14:26:17'),
(7, 6, 'Fri', 'dinner', '<p>Bread Malai</p>', '<p>Sbji Paneer</p>', '<p>Dal Roti</p>', NULL, '2024-02-16 14:26:41', '2024-02-16 14:26:41'),
(8, 6, 'Sun', 'dinnner', '<p>Upma</p>', '<p>Dosa</p>', '<p>Paneer</p>', NULL, '2024-02-16 14:26:58', '2024-02-16 14:26:58'),
(9, 6, 'Sat', 'breakfast', '<p>Dal + Roti</p>', '<p>Dal + Rotisss</p>', '<p>Dal + Roti</p>', NULL, '2024-02-16 14:46:58', '2024-02-16 14:48:07'),
(10, 6, 'Tue', 'dinner', '<p>Sbji Paratha</p>', '<p>Dal + Chawal + Sabzi + 4 Roti + Raita + Salad&nbsp;</p>', '<p>Dal + Chawal + Sabzi + 4 Roti + Raita + Salad + 1 Sweet</p>', NULL, '2024-02-16 14:48:40', '2024-02-16 14:48:40');

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
  `food_type` enum('veg','non_veg','both') NOT NULL,
  `non_veg_price` double(10,2) DEFAULT NULL,
  `veg_breakfast_price` double(10,2) DEFAULT NULL,
  `veg_lunch_price` double(10,2) DEFAULT NULL,
  `veg_dinner_price` double(10,2) DEFAULT NULL,
  `non_veg_breakfast_price` double(10,2) DEFAULT NULL,
  `non_veg_lunch_price` double(10,2) DEFAULT NULL,
  `non_veg_dinner_price` double(10,2) DEFAULT NULL,
  `veg_price` double(10,2) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mess_owner_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mess_owner`
--

INSERT INTO `mess_owner` (`id`, `user_id`, `mess_name`, `mess_description`, `food_type`, `non_veg_price`, `veg_breakfast_price`, `veg_lunch_price`, `veg_dinner_price`, `non_veg_breakfast_price`, `non_veg_lunch_price`, `non_veg_dinner_price`, `veg_price`, `status`, `created_at`, `updated_at`) VALUES
(5, 10, 'My New Mess', 'fghdgfhgfhhfghh', 'non_veg', 345.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-15 12:13:44', '2024-02-15 13:00:08'),
(6, 11, 'Princess Mess', 'sdgfdgsdfgfdgfdgdfgfgfdgfdg', 'veg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 240.00, NULL, '2024-02-16 12:12:20', '2024-02-16 12:12:20'),
(4, 7, 'Annapurna Mess', '\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or', 'both', 350.00, NULL, NULL, NULL, NULL, NULL, NULL, 500.00, NULL, '2024-02-14 13:57:19', '2024-02-14 13:57:19'),
(3, 6, 'Deepanshu\'s mess', 'dfsgdgdsfgdfgfdsgsfdgdfgdfg', 'veg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-13 13:36:18', '2024-02-13 13:36:18'),
(7, 16, 'Anna Mess', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dicti', 'veg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-18 13:34:11', '2024-02-18 13:34:11');

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(9, '2024_02_12_201537_create_permission_tables', 1),
(10, '2024_02_15_190925_create_menus_table', 2),
(11, '2024_02_18_161708_create_customer_menus_table', 3),
(12, '2024_02_18_165200_create_payments_table', 4);

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
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 11),
(2, 'App\\Models\\User', 16),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 12),
(3, 'App\\Models\\User', 13),
(3, 'App\\Models\\User', 14),
(3, 'App\\Models\\User', 15),
(3, 'App\\Models\\User', 18);

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
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `mess_id` bigint(20) UNSIGNED NOT NULL,
  `payment_date` date NOT NULL,
  `expiry` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_user_id_foreign` (`user_id`),
  KEY `payments_mess_id_foreign` (`mess_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `mess_id`, `payment_date`, `expiry`, `status`, `created_at`, `updated_at`) VALUES
(1, 15, 6, '2024-02-19', '2024-03-20', 1, '2024-02-18 12:29:59', '2024-02-18 12:29:59'),
(2, 17, 6, '2024-04-30', '2024-02-11', 1, '2024-02-18 13:35:10', '2024-02-18 14:25:25'),
(3, 17, 6, '2024-06-30', '2024-07-30', 1, '2024-02-18 14:28:32', '2024-02-18 14:28:32'),
(4, 18, 6, '2024-02-19', '2024-03-20', 1, '2024-02-18 14:36:54', '2024-02-18 14:36:54');

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
(1, 'Mess App', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 'Section 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC', '\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tem', 'Section 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC', 'mess_app@gmail.com', 'Lucknow', 'ERFFEUEHRK356443', 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"\r\n\r\n1914 translation by H. Rackham\r\n\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\"', 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"\r\n\r\n1914 translation by H. Rackham\r\n\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\"', 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"\r\n\r\n1914 translation by H. Rackham\r\n\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\"', 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"\r\n\r\n1914 translation by H. Rackham\r\n\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\"', 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"\r\n\r\n1914 translation by H. Rackham\r\n\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\"', NULL, '2024-02-14 11:19:06', '2024-02-14 12:58:30');

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
  `mess_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `mess_id`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '44556677885', '2024-02-13 13:08:50', '$2y$12$1YOffyX/iDTSFD0hUfgCCeULq6k6P4Tgph3N6dQRV26k1KJmbvsTK', 'EA8SEKVghSAnZl9BA8RdPAle3pGlj1xDCVlgaVIh739MfPX6v2IRS0PhT5Nd', NULL, '2024-02-13 13:08:50', '2024-02-15 13:05:07'),
(2, 'Monu Mishra', 'monu@gmail.com', NULL, NULL, '$2y$12$VerRah41PlgzhHGv6apequOlWq5BqtfjQx3CG1XgsBNeA1gI2ufQK', NULL, NULL, '2024-02-13 13:31:57', '2024-02-13 13:31:57'),
(3, 'Monu Mishra', 'monu_mess@gmail.com', NULL, NULL, '$2y$12$wRThh2GLwOu2h.e2/GWKju7IcvqFuFYi4lV6KsVCasZr/7r1HW22.', NULL, NULL, '2024-02-13 13:32:45', '2024-02-13 13:32:45'),
(4, 'Monu Mishra', 'monu_mess1234@gmail.com', '7786931286', NULL, '$2y$12$cTLJDWe6x6DpO0.zljZnz.KUM6bIqyg9GAqooUi5dWxrBDSF92BkW', NULL, NULL, '2024-02-13 13:33:24', '2024-02-14 12:32:23'),
(7, 'Vishal Trivedi', 'annapurana@gmail.com', NULL, NULL, '$2y$12$c397OfC3touzXMwwGciGletEkA2YYoZxyPbiMBhwaGDQ9gawybzA2', NULL, NULL, '2024-02-14 13:57:19', '2024-02-14 13:57:19'),
(6, 'Deepanshu Mishra', 'deepanshu@gmail.com', NULL, NULL, '$2y$12$4uPHFmE4at2zw4LqGhnqbeX94HMLeVnJ.pYek3QCLXbZVtXJ5lxo6', NULL, NULL, '2024-02-13 13:36:18', '2024-02-13 13:36:18'),
(8, 'Deepanshu Mishra', 'deepanshu147852369@gmail.com', '7786931345', NULL, '$2y$12$RNVINMTaaKV.gYDwsHTV3eavLl.N7CDDn1a1gYpYeHKs5/4uoN3Vu', NULL, NULL, '2024-02-14 14:35:24', '2024-02-14 14:35:24'),
(9, 'Deepanshu Mishra', 'deepanshu1tetert2369@gmail.com', '77869314545', NULL, '$2y$12$pE3.T9.PFlNt/gV.7MfSe.2SWFLGho5IUa2v7l7yUXeDoiB/59aUy', NULL, NULL, '2024-02-14 14:37:08', '2024-02-14 14:37:08'),
(10, 'Deepanshu Mishrassss', 'new_mess@gmail.com', '774411002255', NULL, '$2y$12$h52.dZmwSZam01j7oXLgo..fCackOyOKdMyLz7z/qSDP/9FG5Lpk.', NULL, NULL, '2024-02-15 12:13:44', '2024-02-15 12:59:35'),
(11, 'Prince Rathore', 'prince@gmail.com', NULL, NULL, '$2y$12$/z3c8hyYyivGZrM2UHbq/utzZtFEoTKQsCNLxk4J/6R4zZstLTTy6', NULL, NULL, '2024-02-16 12:12:20', '2024-02-16 12:12:20'),
(12, 'Deepanshu Mishra Customer', 'deepanshu_mishra_customer@gmail.com', '7744110022', NULL, '$2y$12$/.MCXzAomaUyJozb90vsneGCMwTG8bDcLwA80ix7MxZummDxd9IZC', NULL, 6, '2024-02-18 12:25:32', '2024-02-18 12:25:32'),
(13, 'Deepanshu Mishra Customer', 'deepanshu_mishra_customer1234@gmail.com', '7744110034', NULL, '$2y$12$JeAiv0ww88qGYu6FakIsnuRr1eQt.5ozn88qWAcbQi4ABlYN4lRQy', NULL, 6, '2024-02-18 12:28:26', '2024-02-18 12:28:26'),
(14, 'Deepanshu Mishra Customer', 'deepanshu_mishra_custome456@gmail.com', '7744110032', NULL, '$2y$12$1uiRjjlph71PB0caiSeJHeNpjUXy.PQWWM7Hdg97yPLVHwFUbcTMm', NULL, 6, '2024-02-18 12:28:56', '2024-02-18 12:28:56'),
(15, 'Deepanshu Mishra Customer', 'deepanshu_mishraerttome456@gmail.com', '7744156756', NULL, '$2y$12$hUbIpiJqznMe0dscy6Qg3eWTC23XA3d/GobpO0o5zcI4phGcCVcS.', NULL, 6, '2024-02-18 12:29:59', '2024-02-18 12:29:59'),
(16, 'New Mess Owner', 'anna@gmail.com', NULL, NULL, '$2y$12$9RVuEZ/ralwsWorZksovYurjf0T22YBHdNRMJArz5XCLx1cODDN5e', NULL, NULL, '2024-02-18 13:34:11', '2024-02-18 13:34:11'),
(18, 'Rajul Dixit', 'rajul@mail.com', '7788996633', NULL, '$2y$12$u1Ai.4Ufp6IqNsPubmX11.cwmXdOiEov5Ycretw58cPLui/9NsNYy', NULL, 6, '2024-02-18 14:36:54', '2024-02-18 14:36:54');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
