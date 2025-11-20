-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 20, 2025 at 10:32 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblrequester`
--

DROP TABLE IF EXISTS `tblrequester`;
CREATE TABLE IF NOT EXISTS `tblrequester` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(20) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblrequester`
--

INSERT INTO `tblrequester` (`id`, `name`, `email`, `password`, `gender`, `phone`, `created_at`) VALUES
(1, 'abab', 'abab@gmail.com', '123', 'f', '9876543215', '2025-11-18 04:54:08'),
(2, 'bcbc', 'bcbc@gmail.com', '123', 'f', '9276543211', '2025-11-18 05:15:22'),
(3, 'cdcd', 'cdcd@gmail.com', '123', 'f', '9225432112', '2025-11-18 05:16:01'),
(4, 'dfdf', 'dfdf@gmail.com', '123', 'f', '9275543213', '2025-11-18 05:16:27'),
(5, 'fgfg', 'fgfg@gmail.com', '123', 'f', '9774543114', '2025-11-18 05:17:51'),
(6, 'hyhy', 'hyhy@gmail.com', '123', 'f', '9977543215', '2025-11-18 05:18:31'),
(7, 'vbvb', 'vbvb@gmail.com', '123', 'f', '9829543217', '2025-11-18 05:18:00'),
(11, 'xcv', 'xc@gmail.com', '123', 'f', '9672372345', '2025-11-20 07:36:31');

-- --------------------------------------------------------

--
-- Table structure for table `tblteam`
--

DROP TABLE IF EXISTS `tblteam`;
CREATE TABLE IF NOT EXISTS `tblteam` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblteam`
--

INSERT INTO `tblteam` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Server', '2025-11-16 06:13:15', '2025-11-19 06:15:15'),
(2, 'Devops', '2025-11-16 06:17:15', '2025-11-19 06:19:15'),
(3, 'aaaa ', '2025-01-16 06:22:36', '2025-11-23 06:25:36'),
(4, 'vbvbn', '2025-11-19 23:59:03', '2025-11-19 23:59:03'),
(5, 'rtrtrt', '2025-11-20 00:00:35', '2025-11-20 00:00:35'),
(6, 'technical', '2025-11-20 10:09:56', '2025-11-20 10:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `tblteam_member`
--

DROP TABLE IF EXISTS `tblteam_member`;
CREATE TABLE IF NOT EXISTS `tblteam_member` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` int NOT NULL,
  `team` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblteam_member`
--

INSERT INTO `tblteam_member` (`id`, `user`, `team`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2025-11-17 14:38:37', '2025-11-17 15:38:37'),
(2, 4, 2, '2025-11-17 15:15:10', '2025-11-17 16:15:10'),
(3, 5, 3, '2025-11-17 15:16:15', '2025-11-17 16:16:15'),
(4, 6, 3, '2025-11-17 15:17:53', '2025-11-17 16:17:53'),
(5, 7, 3, '2025-11-17 15:21:38', '2025-11-17 16:21:38'),
(6, 9, 1, '2025-01-17 15:05:45', '2025-01-17 16:05:45'),
(7, 9, 3, '2025-11-20 00:14:34', '2025-11-20 00:14:34'),
(9, 5, 4, '2025-11-20 04:27:45', '2025-11-20 04:27:45'),
(11, 7, 3, '2025-11-20 10:11:32', '2025-11-20 10:11:32'),
(12, 8, 6, '2025-11-20 10:12:38', '2025-11-20 10:12:38');

-- --------------------------------------------------------

--
-- Table structure for table `tblticket`
--

DROP TABLE IF EXISTS `tblticket`;
CREATE TABLE IF NOT EXISTS `tblticket` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `body` text NOT NULL,
  `requester` int NOT NULL,
  `team` int DEFAULT NULL,
  `team_member` varchar(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'inprogress',
  `attachment` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(50) DEFAULT NULL,
  `deleted_at` varchar(50) DEFAULT NULL,
  `completed_at` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblticket`
--

INSERT INTO `tblticket` (`id`, `title`, `body`, `requester`, `team`, `team_member`, `status`, `attachment`, `created_at`, `updated_at`, `deleted_at`, `completed_at`) VALUES
(1, 'subject', 'thi ', 1, 1, '1', 'onhold', NULL, '2025-11-16 08:18:31', NULL, NULL, NULL),
(2, 'test4', 'test44', 2, 3, '5', 'pending', NULL, '2025-11-16 08:18:37', NULL, NULL, NULL),
(3, 'test2', 'reerr', 1, 3, '5', 'onhold', NULL, '2025-11-16 11:48:25', NULL, NULL, NULL),
(4, 'test3333', 'sdddd', 3, 2, '4', 'pending', NULL, '2025-11-16 08:25:17', NULL, NULL, NULL),
(5, 'test3', 'test33', 3, 2, '2', 'pending', NULL, '2025-01-15 20:37:43', NULL, NULL, NULL),
(6, 'test5', 'test55', 5, 2, '2', 'completed', NULL, '2025-11-16 01:21:33', NULL, NULL, NULL),
(7, 'test6', 'test66', 3, 1, '2', 'pending', NULL, '2025-11-16 01:22:04', NULL, NULL, NULL),
(9, 'test3', 'test33', 4, 3, '2', 'pending', NULL, '2025-11-16 01:27:25', NULL, NULL, NULL),
(10, 'test7', 'test77', 2, 2, '2', 'pending', NULL, '2025-11-16 05:41:23', NULL, NULL, NULL),
(14, 'gdssdfg', 'sdgsd gsdg ssfgs', 2, 3, '4', 'completed', NULL, '2025-11-19 04:35:12', NULL, NULL, NULL),
(11, 'test10', 'sgsdf sg sdg sg', 1, NULL, NULL, 'inprogress', NULL, '2025-11-19 04:26:09', NULL, NULL, NULL),
(13, 'test11', 'sfg sfgsf  gfsd', 1, NULL, NULL, 'inprogress', NULL, '2025-11-19 04:27:32', NULL, NULL, NULL),
(15, 'test14', 'sdfgs s gdfsdfg sdfg sdfgsd ', 3, NULL, NULL, 'inprogress', NULL, '2025-11-19 06:17:08', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

DROP TABLE IF EXISTS `tbluser`;
CREATE TABLE IF NOT EXISTS `tbluser` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'member',
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `name`, `email`, `role`, `password`, `mobile`, `created_at`) VALUES
(3, 'safasdf', 'dgdfg@sgsfd.com', 'member', 'vbn', '9500788235', '2025-11-14 12:28:35'),
(4, 'sdfsd', 'rZFDzdf@xhdf.com', 'member', 'abc', '8978565634', '2025-11-14 12:43:43'),
(5, 'asdfdas', 'adsf@sdfsd.sdfzs', 'member', '1111', '1500788235', '2025-11-15 09:24:26'),
(6, 'sdddsd', 'admin@aaa.com', 'admin', '1234', '9121212121', '2025-11-15 09:30:40'),
(7, 'zxc', 'asd@dsfs.in', 'member', '123', '9001234567', '2025-11-16 14:56:45'),
(8, 'aaaa', 'aaaa@bbb.in', 'member', '1234', '9030788235', '2025-11-16 14:59:02'),
(9, 'cffgg', 'dsfd@sdf.vvv', 'member', 'asd', '9233333331', '2025-11-18 01:36:11'),
(10, 'Ranv', 'xcv.ratweehi@gmail.com', 'member', 'qwe', '9234788235', '2025-11-20 04:23:07'),
(11, 'wert', 'we@gm.com', 'member', '123', '9345612345', '2025-11-20 10:13:31'),
(12, 'nimasss', 'asd@sf.xc', 'member', '123', '9564389123', '2025-11-20 10:31:22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
