-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2016 at 02:39 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `m_quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `bai_thi`
--

CREATE TABLE IF NOT EXISTS `bai_thi` (
  `id` int(10) unsigned NOT NULL,
  `mon_hoc_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `ten_bai_thi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_thi` datetime NOT NULL,
  `thoi_gian` tinyint(4) NOT NULL,
  `so_cau_hoi` int(11) NOT NULL,
  `khoa` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bai_thi`
--

INSERT INTO `bai_thi` (`id`, `mon_hoc_id`, `user_id`, `ten_bai_thi`, `ngay_thi`, `thoi_gian`, `so_cau_hoi`, `khoa`, `created_at`, `updated_at`) VALUES
(2, 13, 1, 'Thi giữa kỳ', '2016-07-20 18:00:00', 90, 9, 0, '2016-07-26 00:07:53', '2016-07-26 07:22:07'),
(3, 13, 1, 'Thi giữa kỳ', '2016-07-28 16:00:00', 90, 1, 0, '2016-07-26 03:20:01', '2016-07-26 07:24:40'),
(5, 13, 1, 'Bài cuối kỳ', '2016-07-27 04:00:00', 90, 1, 0, '2016-07-26 07:26:40', '2016-07-26 07:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `bai_thi_cau_hoi`
--

CREATE TABLE IF NOT EXISTS `bai_thi_cau_hoi` (
  `id` int(10) unsigned NOT NULL,
  `bai_thi_id` int(10) unsigned NOT NULL,
  `cau_hoi_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cau_hoi`
--

CREATE TABLE IF NOT EXISTS `cau_hoi` (
  `id` int(10) unsigned NOT NULL,
  `mon_hoc_id` int(10) unsigned NOT NULL,
  `noi_dung_cau_hoi` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cau_hoi`
--

INSERT INTO `cau_hoi` (`id`, `mon_hoc_id`, `noi_dung_cau_hoi`, `created_at`, `updated_at`) VALUES
(130, 3, 'Tại sao phải lập trình PHP?\r\n	        	\r\n	        	', '2016-07-22 05:57:19', '2016-07-22 05:57:31'),
(131, 3, 'Tại sao phải học HTML?\r\n	        	', '2016-07-22 05:59:43', '2016-07-22 06:00:05'),
(133, 3, 'Phiên bản mới nhất của PHP là bao nhiêu?', '2016-07-22 06:13:03', '2016-07-22 06:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `dap_an`
--

CREATE TABLE IF NOT EXISTS `dap_an` (
  `id` int(10) unsigned NOT NULL,
  `cau_hoi_id` int(10) unsigned NOT NULL,
  `noi_dung_dap_an` text COLLATE utf8_unicode_ci NOT NULL,
  `dung_sai` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dap_an`
--

INSERT INTO `dap_an` (`id`, `cau_hoi_id`, `noi_dung_dap_an`, `dung_sai`, `created_at`, `updated_at`) VALUES
(164, 130, 'Bởi vì nó dễ học.', 1, '2016-07-22 05:57:31', '2016-07-22 05:57:31'),
(165, 130, 'Bởi vì nó dễ kiếm tiền.', 1, '2016-07-22 05:57:31', '2016-07-22 05:57:31'),
(166, 130, 'Bởi vì nó ít thông dụng.', 0, '2016-07-22 05:57:31', '2016-07-22 05:57:31'),
(167, 131, 'Bởi vì nó điên.', 1, '2016-07-22 06:00:05', '2016-07-22 06:00:05'),
(168, 131, 'Bởi vì tao không biết', 0, '2016-07-22 06:00:05', '2016-07-22 06:00:05'),
(171, 133, '5.1', 0, '2016-07-22 06:13:03', '2016-07-22 06:13:03'),
(172, 133, '5.3', 0, '2016-07-22 06:13:03', '2016-07-22 06:13:03'),
(173, 133, '5.4', 0, '2016-07-22 06:13:03', '2016-07-22 06:13:03'),
(174, 133, '5.5', 1, '2016-07-22 06:13:03', '2016-07-22 06:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `hoc_vien_bai_thi`
--

CREATE TABLE IF NOT EXISTS `hoc_vien_bai_thi` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `bai_thi_id` int(10) unsigned NOT NULL,
  `mon_hoc_id` int(10) unsigned NOT NULL,
  `thoi_gian_bat_dau` datetime NOT NULL,
  `thoi_gian_ket_thuc` datetime NOT NULL,
  `ket_qua` text COLLATE utf8_unicode_ci NOT NULL,
  `ket_thuc` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_07_18_153443_create_bai_thi_table', 1),
('2016_07_18_153455_create_cau_hoi_table', 1),
('2016_07_18_153503_create_dap_an_table', 1),
('2016_07_18_153539_create_hoc_vien_bai_thi_table', 1),
('2016_07_18_153553_create_bai_thi_cau_hoi_table', 1),
('2016_07_18_155132_create_mon_hoc_table', 1),
('2016_07_19_164855_create_roles_table', 1),
('2016_07_19_170423_alter_bai_thi_add_foreign_key_table', 2),
('2016_07_19_170650_alter_cau_hoi_add_foreign_key_table', 2),
('2016_07_19_170815_alter_dap_an_add_foreign_key_table', 2),
('2016_07_19_171206_alter_bai_thi_cau_hoi_add_foreign_key_table', 3),
('2016_07_19_171352_create_role_user_table', 4),
('2016_07_19_174502_create_role_user_table', 5),
('2016_07_21_224347_add_ngay_thi_to_bai_thi', 6);

-- --------------------------------------------------------

--
-- Table structure for table `mon_hoc`
--

CREATE TABLE IF NOT EXISTS `mon_hoc` (
  `id` int(10) unsigned NOT NULL,
  `ten_mon_hoc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mon_hoc`
--

INSERT INTO `mon_hoc` (`id`, `ten_mon_hoc`, `created_at`, `updated_at`) VALUES
(3, 'Phát triển ứng dụng web', '2016-07-20 08:03:34', '2016-07-21 00:21:25'),
(11, 'Lập trình nâng cao', '2016-07-21 00:17:21', '2016-07-21 00:17:21'),
(12, 'Phân tích và thiết kế hướng đối tượng', '2016-07-21 00:26:48', '2016-07-21 00:26:48'),
(13, 'Thương mại điện tử', '2016-07-21 00:26:58', '2016-07-21 00:26:58'),
(14, 'Tin học cơ sở 4', '2016-07-21 00:27:02', '2016-07-21 00:27:02'),
(15, 'Đại số', '2016-07-22 07:19:53', '2016-07-22 07:19:53');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `slug`, `name`, `created_at`, `updated_at`) VALUES
(1, 'teacher', 'Teacher', NULL, NULL),
(2, 'student', 'Student', NULL, NULL),
(3, 'admin', 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Văn Thủy', 'thuyhyvg@gmail.com', '$2y$10$mvpVsUULOAPxNFzz.evA8uKXWDcxvvd8RZOY82iNIClD9c0M/.7ZW', 'fHSmHMLBgC9SDixDzdaPiRE3mnvsBvDpPS2tVI00VvTb6lA4ilobJrgGI40n', '2016-07-20 00:31:51', '2016-07-22 01:14:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bai_thi`
--
ALTER TABLE `bai_thi`
  ADD PRIMARY KEY (`id`), ADD KEY `bai_thi_mon_hoc_id_foreign` (`mon_hoc_id`), ADD KEY `bai_thi_user_id_foreign` (`user_id`);

--
-- Indexes for table `bai_thi_cau_hoi`
--
ALTER TABLE `bai_thi_cau_hoi`
  ADD PRIMARY KEY (`id`), ADD KEY `bai_thi_cau_hoi_cau_hoi_id_foreign` (`cau_hoi_id`), ADD KEY `bai_thi_cau_hoi_bai_thi_id_foreign` (`bai_thi_id`);

--
-- Indexes for table `cau_hoi`
--
ALTER TABLE `cau_hoi`
  ADD PRIMARY KEY (`id`), ADD KEY `cau_hoi_mon_hoc_id_foreign` (`mon_hoc_id`);

--
-- Indexes for table `dap_an`
--
ALTER TABLE `dap_an`
  ADD PRIMARY KEY (`id`), ADD KEY `dap_an_cau_hoi_id_foreign` (`cau_hoi_id`);

--
-- Indexes for table `hoc_vien_bai_thi`
--
ALTER TABLE `hoc_vien_bai_thi`
  ADD PRIMARY KEY (`id`), ADD KEY `hoc_vien_bai_thi_mon_hoc_id_foreign` (`mon_hoc_id`), ADD KEY `hoc_vien_bai_thi_user_id_foreign` (`user_id`);

--
-- Indexes for table `mon_hoc`
--
ALTER TABLE `mon_hoc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bai_thi`
--
ALTER TABLE `bai_thi`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `bai_thi_cau_hoi`
--
ALTER TABLE `bai_thi_cau_hoi`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `cau_hoi`
--
ALTER TABLE `cau_hoi`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT for table `dap_an`
--
ALTER TABLE `dap_an`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=207;
--
-- AUTO_INCREMENT for table `hoc_vien_bai_thi`
--
ALTER TABLE `hoc_vien_bai_thi`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mon_hoc`
--
ALTER TABLE `mon_hoc`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bai_thi`
--
ALTER TABLE `bai_thi`
ADD CONSTRAINT `bai_thi_mon_hoc_id_foreign` FOREIGN KEY (`mon_hoc_id`) REFERENCES `mon_hoc` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `bai_thi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bai_thi_cau_hoi`
--
ALTER TABLE `bai_thi_cau_hoi`
ADD CONSTRAINT `bai_thi_cau_hoi_bai_thi_id_foreign` FOREIGN KEY (`bai_thi_id`) REFERENCES `bai_thi` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `bai_thi_cau_hoi_cau_hoi_id_foreign` FOREIGN KEY (`cau_hoi_id`) REFERENCES `cau_hoi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cau_hoi`
--
ALTER TABLE `cau_hoi`
ADD CONSTRAINT `cau_hoi_mon_hoc_id_foreign` FOREIGN KEY (`mon_hoc_id`) REFERENCES `mon_hoc` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dap_an`
--
ALTER TABLE `dap_an`
ADD CONSTRAINT `dap_an_cau_hoi_id_foreign` FOREIGN KEY (`cau_hoi_id`) REFERENCES `cau_hoi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hoc_vien_bai_thi`
--
ALTER TABLE `hoc_vien_bai_thi`
ADD CONSTRAINT `hoc_vien_bai_thi_mon_hoc_id_foreign` FOREIGN KEY (`mon_hoc_id`) REFERENCES `mon_hoc` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `hoc_vien_bai_thi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
