-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2025 at 01:21 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `journalier`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_projet` varchar(255) NOT NULL,
  `duree_debut` date NOT NULL,
  `duree_fin` date NOT NULL,
  `description` text DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `nom_projet`, `duree_debut`, `duree_fin`, `description`, `date`, `created_at`, `updated_at`) VALUES
(2, 'zzsszz', '2025-12-12', '2025-12-12', 'nnnnn', '2025-01-12', '2025-03-10 12:18:33', '2025-03-10 12:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `causer_type` varchar(255) NOT NULL,
  `causer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journaliers`
--

CREATE TABLE `journaliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `projet` varchar(255) NOT NULL,
  `duree_debut` time NOT NULL,
  `duree_fin` time NOT NULL,
  `description` text DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journaliers`
--

INSERT INTO `journaliers` (`id`, `nom`, `projet`, `duree_debut`, `duree_fin`, `description`, `date`, `created_at`, `updated_at`) VALUES
(1, 'aaa', 'application web', '08:00:00', '15:00:00', 'nnnnnnnnnnnnnnn', '2025-03-10', '2025-03-10 11:57:19', '2025-03-10 11:57:19'),
(2, 'aaa', 'application web', '08:00:00', '15:00:00', 'nnnnnnnnnnnnnnn', '2025-03-10', '2025-03-10 11:58:52', '2025-03-10 11:58:52'),
(3, 'aaabbb', 'application web', '07:00:00', '17:00:00', 'nnnnnn,,nnnnnnnnn', '2025-03-10', '2025-03-10 11:59:52', '2025-03-10 12:45:35'),
(5, 'hi', 'application webee', '08:00:00', '15:00:00', 'nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn', '2025-03-10', '2025-03-10 12:03:48', '2025-03-10 12:03:48'),
(6, 'hi', 'zdz', '02:59:00', '17:00:00', 'qqqq', '2025-03-13', '2025-03-13 08:12:37', '2025-03-13 08:12:37');

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2025_03_08_235822_create_tasks_table', 1),
(3, '2025_03_09_095256_create_events_table', 1),
(4, '2025_03_10_095519_create_activities_table', 2),
(5, '2025_03_10_110732_create_projects_table', 2),
(6, '2025_03_10_113823_create_journaliers_table', 2),
(7, '2025_03_10_121950_create_workers_table', 3),
(8, '2025_03_11_073159_create_reports_table', 4),
(9, '2025_03_12_124622_add_project_id_to_tasks_table', 5),
(10, '2025_03_13_081545_add_user', 6),
(11, '2025_03_13_112222_add_hours_to_tasks_table', 7);

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
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref` varchar(255) NOT NULL,
  `nom_projet` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `ref`, `nom_projet`, `description`, `created_at`, `updated_at`) VALUES
(1, 'sss', 'qqee', 'qqqqqqqqqqqqqqqqqqnqqq', '2025-03-10 11:56:36', '2025-03-10 12:16:50'),
(2, 'wwww', 'zzzz', 'ccccccccc', '2025-03-12 12:00:47', '2025-03-12 12:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `module` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `name`, `description`, `module`, `created_at`, `updated_at`) VALUES
(1, 'bbbbbb', 'bbbbbbbbyy', 'Activite', '2025-03-11 06:54:49', '2025-03-11 07:01:53'),
(2, 'hassen', 'hbkkjhb', 'Projet', '2025-03-11 07:02:58', '2025-03-11 07:02:58');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `hours` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `worker_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `status`, `hours`, `created_at`, `updated_at`, `project_id`, `worker_id`) VALUES
(15, 'hh', 'vvvvv', 'pending', 3.00, '2025-03-13 10:42:31', '2025-03-13 10:42:31', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `poste` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`id`, `name`, `email`, `password`, `role`, `poste`, `created_at`, `updated_at`) VALUES
(1, 'hass', 'nahdihasseneevre34@gmail.com', '$2y$12$Bf9xvWMTKxywiHHXuJu8.O/hIRKXj9W8pSvWxJP/jIZYruvQ5Uism', 'admin', 'hhhhhhhhhhhhh bbhhhhhhhhhhhhh', '2025-03-10 11:50:57', '2025-03-11 12:12:41'),
(2, 'hassene', 'nahdihassene34@gmail.com', '$2y$12$01gXE5aQOzrparttb3/5IuwkNlLk96dMvIn7c64bSDWOt/qZ/HtRG', 'admin', 'hhhhhhhhhhhhhhhhhhhhhhhhhh', '2025-03-11 06:12:59', '2025-03-11 06:12:59'),
(4, 'aaa', 'admin@example.com', '$2y$12$GbURuiHYo05XmIxsz2EaceZXGNk6eKPQC9kLzKlPZGH5tCIaWiTuy', 'worker', 'aaaaaaa', '2025-03-13 09:41:06', '2025-03-13 09:41:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journaliers`
--
ALTER TABLE `journaliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_ref_unique` (`ref`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_project_id_foreign` (`project_id`),
  ADD KEY `tasks_worker_id_foreign` (`worker_id`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `workers_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journaliers`
--
ALTER TABLE `journaliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
