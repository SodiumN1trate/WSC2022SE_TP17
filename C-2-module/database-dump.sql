-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Aug 06, 2024 at 07:53 AM
-- Server version: 8.0.32
-- PHP Version: 8.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `last_login_at`, `created_at`, `updated_at`) VALUES
(1, 'admin1', '$2y$12$Cx3jLfgplnDSXwu8rTsrue22aUbXwGpf43svqEsmz2C3zCg9X1J1i', NULL, '2024-08-06 07:22:46', '2024-08-06 07:22:46'),
(2, 'admin2', '$2y$12$tJHGgPtKvrZoFuk2GnpdYuTZZoa.avDGTxWfSddPYAQwstois9Y06', NULL, '2024-08-06 07:22:47', '2024-08-06 07:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `title`, `slug`, `thumbnail`, `description`, `deleted_at`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'Demo Game 1', 'demo-game-1', '/games/1/v2/thumbnail.png', 'This is demo game 1', NULL, 3, '2024-08-06 07:22:47', '2024-08-06 07:22:47'),
(2, 'Demo Game 2', 'demo-game-2', NULL, 'This is demo game 2', NULL, 4, '2024-08-06 07:22:47', '2024-08-06 07:22:47'),
(3, 'dev1 1 1', 'dev1-1-1', NULL, 'helloby11te1!', NULL, 3, '2024-08-06 07:38:05', '2024-08-06 07:52:31');

-- --------------------------------------------------------

--
-- Table structure for table `game_scores`
--

CREATE TABLE `game_scores` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `game_version_id` bigint UNSIGNED NOT NULL,
  `score` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `game_scores`
--

INSERT INTO `game_scores` (`id`, `user_id`, `game_version_id`, `score`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10, '2024-08-06 07:22:47', '2024-08-06 07:22:47'),
(2, 1, 1, 15, '2024-08-06 07:22:47', '2024-08-06 07:22:47'),
(3, 1, 2, 12, '2024-08-06 07:22:47', '2024-08-06 07:22:47'),
(4, 2, 2, 20, '2024-08-06 07:22:47', '2024-08-06 07:22:47'),
(5, 2, 3, 30, '2024-08-06 07:22:47', '2024-08-06 07:22:47'),
(6, 3, 2, 1000, '2024-08-06 07:22:47', '2024-08-06 07:22:47'),
(7, 3, 2, -300, '2024-08-06 07:22:47', '2024-08-06 07:22:47'),
(8, 4, 2, 5, '2024-08-06 07:22:47', '2024-08-06 07:22:47'),
(9, 4, 3, 200, '2024-08-06 07:22:47', '2024-08-06 07:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `game_versions`
--

CREATE TABLE `game_versions` (
  `id` bigint UNSIGNED NOT NULL,
  `game_id` bigint UNSIGNED NOT NULL,
  `version` datetime NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `game_versions`
--

INSERT INTO `game_versions` (`id`, `game_id`, `version`, `path`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-08-06 07:22:47', '/games/1/v1', '2024-08-06 07:22:47', '2024-08-06 07:22:47'),
(2, 1, '2024-08-06 07:22:47', '/games/1/v2', '2024-08-06 07:22:47', '2024-08-06 07:22:47'),
(3, 2, '2024-08-06 07:22:47', '/games/2/v1', '2024-08-06 07:22:47', '2024-08-06 07:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_08_06_045624_create_admin_users_table', 1),
(6, '2024_08_06_050138_create_games_table', 1),
(7, '2024_08_06_050321_create_game_versions_table', 1),
(8, '2024_08_06_050558_create_game_scores_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 3, 'login', 'ba79ecf20f5fe7311f23b31d9d3cb31d846939508e695d1e061d16d15bf7dcd6', '[\"*\"]', '2024-08-06 07:52:31', NULL, '2024-08-06 07:37:20', '2024-08-06 07:52:31'),
(2, 'App\\Models\\User', 4, 'login', 'a59f5bf98d5a7d8aa2b422faa7099de31521759c1bda6d5b0ffbabcb3d89794e', '[\"*\"]', '2024-08-06 07:53:22', NULL, '2024-08-06 07:53:15', '2024-08-06 07:53:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `block_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `block_reason`, `last_login_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'player1', '$2y$12$/8Rl5iDhXj2X3OUnoTS.Y.hQMjrPHO4vd3e53ZoS1/FDDBQLi/1a.', NULL, NULL, NULL, '2024-08-06 07:22:47', '2024-08-06 07:22:47'),
(2, 'player2', '$2y$12$4AcR0NKym9AWqAv6N0fMtuMNG4Bi/vZCgHL/Zf9EPIpMat2OaAzj6', NULL, NULL, NULL, '2024-08-06 07:22:47', '2024-08-06 07:22:47'),
(3, 'dev1', '$2y$12$p0LPMIHMLbHVvDvt2Lv36eRuzjwdggfIOwQ0roemYM3NUI379zkpy', NULL, NULL, NULL, '2024-08-06 07:22:47', '2024-08-06 07:22:47'),
(4, 'dev2', '$2y$12$rtKz/kwWjwcUkNFVZ6t0l.SFnNbuBZMa6VqnC4.c5obWOkuMtHya.', NULL, NULL, NULL, '2024-08-06 07:22:47', '2024-08-06 07:22:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `games_author_id_foreign` (`author_id`);

--
-- Indexes for table `game_scores`
--
ALTER TABLE `game_scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_scores_user_id_foreign` (`user_id`),
  ADD KEY `game_scores_game_version_id_foreign` (`game_version_id`);

--
-- Indexes for table `game_versions`
--
ALTER TABLE `game_versions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_versions_game_id_foreign` (`game_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `game_scores`
--
ALTER TABLE `game_scores`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `game_versions`
--
ALTER TABLE `game_versions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `game_scores`
--
ALTER TABLE `game_scores`
  ADD CONSTRAINT `game_scores_game_version_id_foreign` FOREIGN KEY (`game_version_id`) REFERENCES `game_versions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `game_scores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `game_versions`
--
ALTER TABLE `game_versions`
  ADD CONSTRAINT `game_versions_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
