-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2024 at 04:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sassolut_showroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `email_verified_at`, `password`, `profile_image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ad', 'ad@gmail.com', NULL, '1234567', 'storage/profile_image/2574.jpg', NULL, '2024-07-11 11:22:38', '2024-07-11 07:39:25');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `made_year` int(11) NOT NULL,
  `horse_power` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `number_plate` varchar(255) NOT NULL,
  `chassis_number` varchar(255) NOT NULL,
  `engine_number` varchar(255) NOT NULL,
  `cost` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `car_report_doc` varchar(255) DEFAULT NULL,
  `condition_description` varchar(255) NOT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `status` enum('sold','available') NOT NULL DEFAULT 'available',
  `qr_code_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `brand`, `model`, `made_year`, `horse_power`, `title`, `number_plate`, `chassis_number`, `engine_number`, `cost`, `price`, `car_report_doc`, `condition_description`, `images`, `features`, `status`, `qr_code_path`, `created_at`, `updated_at`) VALUES
(2, 'BMW', 'X5', 2020, '300', '2020 BMW X5', 'AB123CD', 'WBASD432X0DR12345', 'EN123456789', 45000, '50000', NULL, 'Excellent condition, well maintained, no accidents.', '[\"storage\\/images\\/3040.jpg\",\"storage\\/images\\/2264.jpg\",\"storage\\/images\\/2824.jpg\",\"storage\\/images\\/3313.jpg\",\"storage\\/images\\/1977.jpg\"]', NULL, 'available', NULL, '2024-07-15 07:49:17', '2024-07-15 07:49:17'),
(3, 'BMW', 'X5', 2020, '300', '2020 BMW X5', 'AB123CD', 'WBASD432X0DR12345', 'EN123456789', 45000, '50000', NULL, 'Excellent condition, well maintained, no accidents.', '[\"storage\\/images\\/3765.jpg\",\"storage\\/images\\/5831.jpg\",\"storage\\/images\\/3298.jpg\",\"storage\\/images\\/9500.jpg\",\"storage\\/images\\/5920.jpg\"]', NULL, 'available', NULL, '2024-07-15 07:52:41', '2024-07-15 07:52:41'),
(4, 'BMW', 'X5', 2020, '300', '2020 BMW X5', 'AB123CD', 'WBASD432X0DR12345', 'EN123456789', 45000, '50000', NULL, 'Excellent condition, well maintained, no accidents.', '[\"storage\\/images\\/483.jpg\",\"storage\\/images\\/926.jpg\",\"storage\\/images\\/9752.jpg\",\"storage\\/images\\/4876.jpg\",\"storage\\/images\\/5100.jpg\"]', NULL, 'available', NULL, '2024-07-15 07:53:28', '2024-07-15 07:53:28'),
(5, 'BMW', 'X5', 2020, '300', '2020 BMW X5', 'AB123CD', 'WBASD432X0DR12345', 'EN123456789', 45000, '50000', NULL, 'Excellent condition, well maintained, no accidents.', '[\"storage\\/images\\/7752.jpg\",\"storage\\/images\\/7586.jpg\",\"storage\\/images\\/3663.jpg\",\"storage\\/images\\/3271.jpg\",\"storage\\/images\\/9133.jpg\"]', NULL, 'available', 'storage/qrcodes/5.png', '2024-07-15 07:54:48', '2024-07-15 07:54:48'),
(6, 'BMW', 'X5', 2020, '300', '2020 BMW X5', 'AB123CD', 'WBASD432X0DR12345', 'EN123456789', 45000, '50000', NULL, 'Excellent condition, well maintained, no accidents.', '[\"storage\\/images\\/3744.jpg\",\"storage\\/images\\/2659.jpg\",\"storage\\/images\\/158.jpg\",\"storage\\/images\\/4726.jpg\",\"storage\\/images\\/6538.jpg\"]', NULL, 'available', 'storage/qrcodes/6.jpg', '2024-07-15 08:42:46', '2024-07-15 08:42:46'),
(7, 'BMW', 'X5', 2020, '300', '2020 BMW X5', 'AB123CD', 'WBASD432X0DR12345', 'EN123456789', 45000, '50000', NULL, 'Excellent condition, well maintained, no accidents.', '[\"storage\\/images\\/9538.jpg\",\"storage\\/images\\/3368.jpg\",\"storage\\/images\\/5455.jpg\",\"storage\\/images\\/4171.jpg\",\"storage\\/images\\/1022.jpg\"]', NULL, 'available', NULL, '2024-07-15 08:43:58', '2024-07-15 08:43:58'),
(8, 'BMW', 'X5', 2020, '300', '2020 BMW X5', 'AB123CD', 'WBASD432X0DR12345', 'EN123456789', 45000, '50000', NULL, 'Excellent condition, well maintained, no accidents.', '[\"storage\\/images\\/8645.jpg\",\"storage\\/images\\/4045.jpg\",\"storage\\/images\\/6780.jpg\",\"storage\\/images\\/3253.jpg\",\"storage\\/images\\/7922.jpg\"]', NULL, 'available', NULL, '2024-07-15 08:47:19', '2024-07-15 08:47:19'),
(9, 'BMW', 'X5', 2020, '300', '2020 BMW X5', 'AB123CD', 'WBASD432X0DR12345', 'EN123456789', 45000, '50000', NULL, 'Excellent condition, well maintained, no accidents.', '[\"storage\\/images\\/3331.jpg\",\"storage\\/images\\/216.jpg\",\"storage\\/images\\/6112.jpg\",\"storage\\/images\\/555.jpg\",\"storage\\/images\\/4621.jpg\"]', NULL, 'available', NULL, '2024-07-15 08:51:06', '2024-07-15 08:51:06'),
(10, 'BMW', 'X5', 2020, '300', '2020 BMW X5', 'AB123CD', 'WBASD432X0DR12345', 'EN123456789', 45000, '50000', NULL, 'Excellent condition, well maintained, no accidents.', '[\"storage\\/images\\/5287.jpg\",\"storage\\/images\\/4873.jpg\",\"storage\\/images\\/475.jpg\",\"storage\\/images\\/8509.jpg\",\"storage\\/images\\/9964.jpg\"]', NULL, 'available', '/storage/qrcodes/10.jpg', '2024-07-15 08:51:30', '2024-07-15 08:51:30'),
(11, 'BMW', 'X5', 2020, '300', '2020 BMW X5', 'AB123CD', 'WBASD432X0DR12345', 'EN123456789', 45000, '50000', NULL, 'Excellent condition, well maintained, no accidents.', '[\"storage\\/images\\/9875.jpg\",\"storage\\/images\\/3832.jpg\",\"storage\\/images\\/8161.jpg\",\"storage\\/images\\/6207.jpg\",\"storage\\/images\\/5228.jpg\"]', NULL, 'available', NULL, '2024-07-15 08:57:12', '2024-07-15 08:57:12'),
(12, 'BMW', 'X5', 2020, '300', '2020 BMW X5', 'AB123CD', 'WBASD432X0DR12345', 'EN123456789', 45000, '50000', NULL, 'Excellent condition, well maintained, no accidents.', '[\"storage\\/images\\/1026.jpg\",\"storage\\/images\\/2002.jpg\",\"storage\\/images\\/1239.jpg\",\"storage\\/images\\/1109.jpg\",\"storage\\/images\\/3808.jpg\"]', NULL, 'available', NULL, '2024-07-15 09:00:50', '2024-07-15 09:00:50'),
(13, 'BMW', 'X5', 2020, '300', '2020 BMW X5', 'AB123CD', 'WBASD432X0DR12345', 'EN123456789', 45000, '50000', NULL, 'Excellent condition, well maintained, no accidents.', '[\"storage\\/images\\/6280.jpg\",\"storage\\/images\\/952.jpg\",\"storage\\/images\\/7415.jpg\",\"storage\\/images\\/1324.jpg\",\"storage\\/images\\/5349.jpg\"]', NULL, 'available', '/storage/qrcodes/13.jpg', '2024-07-15 09:03:00', '2024-07-15 09:03:01'),
(14, 'BMW', 'X5', 2020, '300', '2020 BMW X5', 'AB123CD', 'WBASD432X0DR12345', 'EN123456789', 45000, '50000', NULL, 'Excellent condition, well maintained, no accidents.', '[\"storage\\/images\\/1529.jpg\",\"storage\\/images\\/2930.jpg\",\"storage\\/images\\/7491.jpg\",\"storage\\/images\\/7937.jpg\",\"storage\\/images\\/9106.jpg\"]', NULL, 'available', '/storage/qrcodes/14.jpg', '2024-07-15 09:05:57', '2024-07-15 09:05:57'),
(15, 'BMW', 'X5', 2020, '300', '2020 BMW X5', 'AB123CD', 'WBASD432X0DR12345', 'EN123456789', 45000, '50000', NULL, 'Excellent condition, well maintained, no accidents.', '[\"storage\\/images\\/1234.jpg\",\"storage\\/images\\/363.jpg\",\"storage\\/images\\/2697.jpg\",\"storage\\/images\\/3952.jpg\",\"storage\\/images\\/8410.jpg\"]', NULL, 'available', NULL, '2024-07-15 09:13:40', '2024-07-15 09:13:40');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `hourly_rate` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `phone`, `address`, `profile_image`, `password`, `hourly_rate`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Asharif', 'asharif@gmail.com', '03154518774', 'karachi', NULL, '12345678', 50, 'active', '2024-07-15 05:41:30', '2024-07-15 05:41:30');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2024_07_11_111922_create_admin_table', 1),
(13, '2024_07_15_095702_create_cars_table', 4),
(14, '2024_07_11_124930_create_sub_admins_table', 5),
(15, '2024_07_15_074959_create_employees_table', 5),
(16, '2024_07_15_100848_create_cars_table', 6);

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
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `sub_admins`
--

CREATE TABLE `sub_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_email_unique` (`email`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sub_admins`
--
ALTER TABLE `sub_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_admins_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_admins`
--
ALTER TABLE `sub_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
