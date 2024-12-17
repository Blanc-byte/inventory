-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 01:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `borrowed_at` datetime NOT NULL DEFAULT current_timestamp(),
  `returned_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`id`, `student_id`, `equipment_id`, `quantity`, `borrowed_at`, `returned_at`) VALUES
(1, 1, 1, 1, '2024-12-15 17:29:53', '2024-12-16 15:14:16'),
(2, 5, 4, 4, '2024-12-15 17:46:46', '2024-12-16 15:15:52'),
(3, 2, 1, 2, '2024-12-16 13:25:19', '2024-12-16 15:16:23'),
(4, 14, 1, 1, '2024-12-16 13:26:33', '2024-12-16 15:21:12'),
(5, 21, 2, 1, '2024-12-16 13:36:34', NULL),
(6, 28, 2, 1, '2024-12-16 13:37:03', NULL),
(7, 28, 3, 1, '2024-12-16 13:38:09', NULL),
(8, 29, 2, 1, '2024-12-16 13:39:38', NULL),
(9, 2, 4, 1, '2024-12-16 13:43:17', NULL),
(10, 3, 4, 1, '2024-12-16 13:44:26', NULL),
(11, 26, 1, 1, '2024-12-16 13:45:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `name` varchar(254) NOT NULL,
  `quantity` int(11) NOT NULL,
  `available` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `name`, `quantity`, `available`) VALUES
(1, 'Basketball', 20, 15),
(2, 'Volleyball', 15, 12),
(3, 'Soccer Ball', 10, 9),
(4, 'Badminton Racket', 30, 24),
(5, 'Skipping Rope', 25, 25),
(6, 'Microscope', 10, 10),
(7, 'Test Tubes', 100, 100),
(8, 'Bunsen Burner', 15, 15),
(9, 'Beaker (500ml)', 50, 50),
(10, 'Safety Goggles', 40, 40),
(11, 'Laptop', 15, 15),
(12, 'Projector', 5, 5),
(13, 'Printer', 3, 3),
(14, 'HDMI Cable', 20, 20),
(15, 'WiFi Router', 2, 2),
(16, 'Whiteboard Marker', 100, 100),
(17, 'Eraser', 50, 50),
(18, 'Ruler (30cm)', 40, 40),
(19, 'Stapler', 20, 20),
(20, 'Puncher', 10, 10);

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

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
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `fullname` varchar(254) NOT NULL,
  `year_and_section` varchar(254) NOT NULL,
  `department` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fullname`, `year_and_section`, `department`) VALUES
(1, 'John Smith', '3A', 'BSIT'),
(2, 'Jane Doe', '3B', 'BSA'),
(3, 'Michael Johnson', '3A', 'BSBA'),
(4, 'Emily Davis', '3B', 'BTLEd'),
(5, 'Chris Brown', '3A', 'BSIT'),
(6, 'Jessica Wilson', '3B', 'BSA'),
(7, 'Daniel Martinez', '3A', 'BSBA'),
(8, 'Sarah Miller', '3B', 'BTLEd'),
(9, 'Matthew Garcia', '3A', 'BSIT'),
(10, 'Ashley Rodriguez', '3B', 'BSA'),
(11, 'Joshua Lee', '3A', 'BSBA'),
(12, 'Olivia Walker', '3B', 'BTLEd'),
(13, 'Andrew Hall', '3A', 'BSIT'),
(14, 'Sophia Allen', '3B', 'BSA'),
(15, 'Ryan Young', '3A', 'BSBA'),
(16, 'Isabella King', '3B', 'BTLEd'),
(17, 'Brandon Hernandez', '3A', 'BSIT'),
(18, 'Emma Wright', '3B', 'BSA'),
(19, 'James Lopez', '3A', 'BSBA'),
(20, 'Ava Scott', '3B', 'BTLEd'),
(21, 'Elijah Hill', '3A', 'BSIT'),
(22, 'Mia Adams', '3B', 'BSA'),
(23, 'Lucas Nelson', '3A', 'BSBA'),
(24, 'Charlotte Baker', '3B', 'BTLEd'),
(25, 'Mason Carter', '3A', 'BSIT'),
(26, 'Amelia Perez', '3B', 'BSA'),
(27, 'Ethan Roberts', '3A', 'BSBA'),
(28, 'Harper Turner', '3B', 'BTLEd'),
(29, 'Alexander Phillips', '3A', 'BSIT'),
(30, 'Leo Neil Agner III', '3A', 'BSIT'),
(31, 'Leo Neil Agner II', '3A', 'BSIT');

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Davao Oriental State University (BEC)', 'dorsu@gmail.com', NULL, '$2y$10$hePjGWnah4nZUZr73JOp4OHrhnJiBkaQiz9kRMpYAYzjez4FePBq6', NULL, '2024-12-15 08:54:21', '2024-12-15 08:54:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
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
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
