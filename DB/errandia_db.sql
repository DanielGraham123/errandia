-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2023 at 11:43 AM
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
-- Database: `errandia_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_fr` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `name_fr`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Manage Student', NULL, 'manage_student', NULL, NULL),
(2, 'Manage User', NULL, 'manage_user', NULL, NULL),
(3, 'Manage Subject', NULL, 'manage_subject', NULL, NULL),
(4, 'Manage Class', NULL, 'manage_class', NULL, NULL),
(5, 'Manage Fee', NULL, 'manage_fee', NULL, NULL),
(6, 'Manage Roles', NULL, 'manage_roles', NULL, NULL),
(7, 'Manage Result', NULL, 'manage_result', NULL, NULL),
(8, 'Manage Scholarship', NULL, 'manage_scholarship', NULL, NULL),
(9, 'Manage Incomes', NULL, 'manage_incomes', NULL, NULL),
(10, 'Manage Expenses', NULL, 'manage_expenses', NULL, NULL),
(11, 'Manage Setting', NULL, 'manage_setting', NULL, NULL),
(12, 'Promote s', NULL, 'promote_students', NULL, NULL),
(13, 'Approve promotion', NULL, 'approve_promotion', NULL, NULL),
(15, 'MANAGE STATISTICS', NULL, 'manage_statistics', NULL, NULL),
(16, 'Manage Notifications', NULL, 'manage_notifications', NULL, NULL),
(17, 'Manage FAQs', NULL, 'manage_faqs', NULL, NULL),
(18, 'Manage Importation', NULL, 'manage_importation', NULL, NULL),
(19, 'Manage Student Statistics', NULL, 'manage_student_statistics', '2022-11-22 09:58:08', '2022-11-22 09:58:08'),
(20, 'Manage Finance Statistics', NULL, 'manage_finance_statistics', '2022-11-22 09:59:49', '2022-11-22 09:59:49'),
(21, 'Manage Result Statistics', NULL, 'manage_result_statistics', '2022-11-22 10:00:45', '2022-11-22 10:00:45'),
(22, 'Manage Stock', NULL, 'manage_stock', '2022-11-29 10:10:32', '2022-11-29 10:10:32'),
(23, 'Demote Students', NULL, 'demote_students', '2022-12-02 10:11:19', '2022-12-02 10:11:19'),
(24, 'Bypass Result', NULL, 'bypass_result', '2022-12-09 13:31:01', NULL),
(25, 'Manage Transcripts/Results', NULL, 'manage_transcripts_and_results', NULL, NULL),
(26, 'Manage Transcripts', NULL, 'manage_transcripts', NULL, NULL),
(28, 'Configure Transcripts', NULL, 'configure_transcripts', NULL, NULL),
(29, 'Manage Resits', NULL, 'manage_resits', NULL, NULL),
(30, 'Manage Permissions', NULL, 'manage_permissions', '2023-03-15 13:00:57', '2023-03-15 13:00:57'),
(31, 'Manage Charges', NULL, 'manage_charges', '2023-03-17 11:13:43', '2023-03-17 11:13:43'),
(32, 'MANAGE ATTENDANCE', NULL, 'manage_attendance', '2023-04-01 12:40:02', '2023-04-01 12:40:02'),
(33, 'COURSE MANAGEMENT', NULL, 'course_management', '2023-04-01 12:40:02', '2023-04-01 12:40:02'),
(34, 'Basic Settings', NULL, 'basic_settings', '2023-05-24 13:49:17', '2023-05-24 13:49:17'),
(35, 'Manage Documentation', NULL, 'manage_documentation', '2023-05-30 13:38:57', '2023-05-30 13:38:57');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_fr` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `name_fr`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, 'admin', NULL, NULL),
(3, 'CAMPUS FINANCE CONTROLLER', NULL, 'bursar', '2022-08-14 19:04:21', '2022-10-22 17:45:21'),
(7, 'SECRETARY', NULL, 'secretary', '2022-08-17 15:16:56', '2022-08-17 15:16:56'),
(8, 'Campus Sub Admin', NULL, 'campus_sub_admin', '2022-11-14 13:31:38', '2022-11-14 13:31:38'),
(9, 'Registrar', NULL, 'registrar', '2022-11-19 18:05:42', '2022-11-19 18:05:42'),
(10, 'Dean of Studies', NULL, 'dean_of_studies', '2023-03-27 14:58:57', '2023-03-27 14:58:57'),
(11, 'General controller', NULL, 'general_controller', '2023-03-28 08:56:24', '2023-03-28 08:56:24');

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`id`, `role_id`, `permission_id`) VALUES
(12, 2, 1),
(14, 4, 1),
(15, 5, 5),
(16, 6, 13),
(24, 7, 1),
(25, 7, 3),
(26, 7, 11),
(149, 9, 1),
(150, 9, 2),
(151, 9, 3),
(152, 9, 4),
(153, 9, 11),
(154, 9, 16),
(155, 9, 17),
(156, 9, 18),
(327, 3, 1),
(328, 3, 2),
(329, 3, 3),
(330, 3, 5),
(331, 3, 8),
(332, 3, 9),
(333, 3, 10),
(334, 3, 11),
(335, 3, 15),
(336, 3, 17),
(337, 3, 18),
(338, 3, 19),
(339, 3, 20),
(340, 3, 24),
(341, 3, 29),
(353, 10, 1),
(354, 10, 7),
(355, 10, 11),
(356, 10, 12),
(357, 10, 15),
(358, 10, 16),
(359, 10, 18),
(360, 10, 19),
(361, 10, 20),
(362, 10, 24),
(363, 10, 29),
(376, 11, 1),
(377, 11, 5),
(378, 11, 8),
(379, 11, 9),
(380, 11, 10),
(381, 11, 11),
(382, 11, 15),
(383, 11, 19),
(384, 11, 20),
(385, 11, 22),
(386, 11, 24),
(387, 11, 28),
(388, 11, 29),
(389, 8, 1),
(390, 8, 2),
(391, 8, 8),
(392, 8, 10),
(393, 8, 11),
(394, 8, 15),
(395, 8, 16),
(396, 8, 17),
(397, 8, 18),
(398, 8, 20),
(399, 8, 22),
(400, 8, 24),
(401, 8, 29),
(442, 11, 36),
(443, 11, 36),
(444, 3, 1),
(445, 3, 2),
(446, 3, 11),
(447, 3, 15),
(448, 3, 24),
(449, 3, 36),
(450, 1, 1),
(451, 1, 2),
(452, 1, 3),
(453, 1, 4),
(454, 1, 5),
(455, 1, 6),
(456, 1, 7),
(457, 1, 8),
(458, 1, 9),
(459, 1, 10),
(460, 1, 11),
(461, 1, 12),
(462, 1, 15),
(463, 1, 16),
(464, 1, 17),
(465, 1, 18),
(466, 1, 19),
(467, 1, 20),
(468, 1, 21),
(469, 1, 22),
(470, 1, 23),
(471, 1, 24),
(472, 1, 26),
(473, 1, 28),
(474, 1, 29),
(475, 1, 30),
(476, 1, 31),
(477, 1, 34),
(478, 1, 35);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matric` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('admin','teacher') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'teacher',
  `campus_id` int(11) DEFAULT NULL,
  `gender` enum('female','male') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `matric`, `email`, `username`, `type`, `campus_id`, `gender`, `email_verified_at`, `password`, `phone`, `address`, `remember_token`, `password_reset`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, 'nishang', 'nishang', 'admin', 5, 'female', NULL, '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, NULL, 1, '2021-11-13 06:13:07', '2023-02-24 18:02:09'),
(294, 'Campus Sub Admin', NULL, 'subadmin@gracious', 'subadmin@gracious', 'admin', 5, 'male', NULL, '$2y$10$0gbeKPM3ZyqEo/iqTzqrX.Zt79u.DnhSXbXdvC1i2aiysGaDNiHwi', '679135426', 'Buea', NULL, 1, '2023-02-14 11:44:22', '2023-02-24 21:42:32'),
(295, 'Dr. Julius', NULL, 'dr.jatemafac@guedu.org', 'dr.jatemafac@guedu.org', 'admin', 5, 'male', NULL, '$2y$10$hVNLRKNczldtUGnxlIc6HOKO1ryV7S3QjTg/g447/sQULLGUIoc32', '.', NULL, NULL, 1, '2023-02-17 19:40:47', '2023-07-08 13:40:58'),
(296, 'Mr. Abendong', NULL, 'abendongk@gmail.com', 'abendongk@gmail.com', 'admin', 5, 'male', NULL, '$2y$10$rLXn5qEO/9T8WtRMTyDzfecI5tgOl2CNdNqwfnJvLVF7fXkPBHg46', '.', NULL, NULL, 0, '2023-02-17 19:42:09', '2023-02-17 19:42:09'),
(297, 'Mme Mercy', NULL, 'ladykoti@gmail.com', 'ladykoti@gmail.com', 'admin', 5, 'female', NULL, '$2y$10$u11hSbZ9eaZsai5oKfQybuhDkffmc9XKnp.ph9Az2FwzST8o0I51q', '.', 'muea', NULL, 1, '2023-02-21 12:07:03', '2023-02-24 21:35:52'),
(299, 'Mr. Mandy', NULL, 'derickfese4@gmail.com', 'derickfese4@gmail.com', 'admin', 5, 'male', NULL, '$2y$10$WvxGpJyrliCArRMwxc1k8urG8PWfmyaeNwq.Rq/2C.fg4C9dpthLm', '.', '.', NULL, 1, '2023-04-05 15:06:31', '2023-04-05 15:16:13'),
(300, 'TESTING', 'GRAUNI0040', 'admin@admin', 'admin@admin', 'admin', 5, 'male', NULL, '$2y$10$X1YbhglLsHXfxfIpMvdpEODYyZ0pFgmdPaaXYTfEp2W286x3yZ3Jq', '679135426', 'Buea', NULL, 0, '2023-04-08 16:19:59', '2023-04-08 16:19:59'),
(301, 'Mr Mandy', 'GRAUNI0041', 'ghostbullet86@gmail.com', 'ghostbullet86@gmail.com', 'admin', NULL, 'male', NULL, '$2y$10$3Ph24sRjjBB49yeujW2ZoeQI8anEuowN3sZ7s6seb0N5sdSqc/4la', '679135426', 'Buea', NULL, 1, '2023-04-08 16:34:02', '2023-04-08 18:20:35'),
(302, 'School admin', 'GRAUNI0042', 'bursar@gmail.com', 'bursar@gmail.com', 'admin', 5, 'male', NULL, '$2y$10$s5jE2dU0UBo0ko4lRroFU.9ObpADKXEx5ojRIvxH5fgbqeQu0yCq2', '.', 'G', NULL, 1, '2023-09-01 16:17:00', '2023-09-01 16:19:06'),
(303, 'Demo Admin', NULL, 'admin@gmail.com', 'admin@gmail.com', 'admin', NULL, 'male', NULL, '$2y$10$FGu/89EsjRlKjBgx8SAOKeFUdbn4jwcMBmDXSNvNSqTceKIGOVanK', '.', '.', NULL, 1, '2023-09-08 08:01:14', '2023-09-08 08:13:24');

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

CREATE TABLE `users_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_permissions`
--

INSERT INTO `users_permissions` (`id`, `user_id`, `permission_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE `users_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 31, 3, '2022-09-01 16:14:07.000000', '2022-09-01 16:14:07.000000'),
(3, 32, 7, '2022-09-28 14:16:51.000000', '2022-09-28 14:16:51.000000'),
(4, 35, 1, '2022-10-18 16:10:13.000000', '2022-10-18 16:10:13.000000'),
(5, 36, 3, '2022-10-18 16:12:03.000000', '2022-10-18 16:12:03.000000'),
(6, 37, 7, '2022-10-18 16:13:23.000000', '2022-10-18 16:13:23.000000'),
(7, 39, 3, '2022-10-19 12:21:42.000000', '2022-10-19 12:21:42.000000'),
(8, 40, 3, '2022-10-20 15:44:44.000000', '2022-10-20 15:44:44.000000'),
(9, 41, 3, '2022-10-22 17:46:29.000000', '2022-10-22 17:46:29.000000'),
(10, 42, 1, '2022-10-22 17:50:44.000000', '2022-10-22 17:50:44.000000'),
(11, 43, 3, '2022-10-24 13:30:28.000000', '2022-10-24 13:30:28.000000'),
(12, 44, 3, '2022-10-24 15:50:28.000000', '2022-10-24 15:50:28.000000'),
(13, 45, 3, '2022-10-27 06:48:22.000000', '2022-10-27 06:48:22.000000'),
(14, 60, 8, '2022-11-14 13:32:12.000000', '2022-11-14 13:32:12.000000'),
(15, 246, 1, '2022-11-19 18:02:08.000000', '2022-11-19 18:02:08.000000'),
(16, 247, 9, '2022-11-19 18:20:54.000000', '2022-11-19 18:20:54.000000'),
(17, 248, 3, '2022-11-23 21:17:00.000000', '2022-11-23 21:17:00.000000'),
(18, 249, 3, '2022-11-25 16:24:37.000000', '2022-11-25 16:24:37.000000'),
(19, 291, 1, '2023-01-11 14:39:49.000000', '2023-01-11 14:39:49.000000'),
(20, 294, 8, '2023-02-14 11:44:22.000000', '2023-02-14 11:44:22.000000'),
(21, 295, 9, '2023-02-17 19:40:47.000000', '2023-02-17 19:40:47.000000'),
(22, 296, 9, '2023-02-17 19:42:09.000000', '2023-02-17 19:42:09.000000'),
(23, 297, 10, '2023-02-21 12:07:03.000000', '2023-02-21 12:07:03.000000'),
(24, 298, 1, '2023-02-27 14:14:22.000000', '2023-02-27 14:14:22.000000'),
(25, 299, 11, '2023-04-05 15:06:31.000000', '2023-04-05 15:06:31.000000'),
(26, 300, 11, '2023-04-08 16:19:59.000000', '2023-04-08 16:19:59.000000'),
(27, 301, 1, '2023-04-08 16:34:02.000000', '2023-04-08 16:34:02.000000'),
(28, 302, 10, '2023-09-01 16:17:00.000000', '2023-09-01 16:17:00.000000'),
(29, 303, 1, '2023-09-08 08:01:14.000000', '2023-09-08 08:01:14.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=479;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;

--
-- AUTO_INCREMENT for table `users_permissions`
--
ALTER TABLE `users_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users_roles`
--
ALTER TABLE `users_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
