-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2018 at 01:07 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `no1exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `id` smallint(4) UNSIGNED NOT NULL,
  `state_name` varchar(30) NOT NULL,
  `category` varchar(10) NOT NULL COMMENT 'board, university',
  `name` varchar(75) NOT NULL,
  `status` varchar(8) NOT NULL COMMENT 'Active, Inactive',
  `sync` varchar(5) NOT NULL COMMENT 'True, False',
  `created_date` datetime NOT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`id`, `state_name`, `category`, `name`, `status`, `sync`, `created_date`, `last_modified_date`) VALUES
(1, 'Andhra Pradhesh', 'board', 'Andhra Pradhesh Board Of Intermediate Education', 'active', 'false', '2017-12-07 20:17:36', '2018-02-04 09:30:30'),
(2, 'Telangana', 'board', 'Telangana State Board Of Intermediate Education', 'active', 'false', '2017-12-07 20:17:36', '2018-02-04 09:30:06'),
(3, 'Tamilanadu', 'board', 'Tamil Nadu Higher Secondary Examination Board', 'active', 'false', '2017-12-07 20:17:36', '2018-02-04 08:57:00'),
(4, 'Kerala', 'board', 'Kerala Higher Secondary Examination Board', 'active', 'false', '2017-12-07 20:17:36', '2018-01-20 16:19:40'),
(5, 'Karnataka', 'board', 'Pre-University Examination Board', 'active', 'false', '2017-12-07 20:17:36', '2018-01-20 16:18:11'),
(6, 'Andhra Pradhesh', 'board', 'Intermediate Board', 'active', 'false', '2018-01-20 18:15:12', '2018-01-20 17:15:12'),
(7, 'Telangana', 'university', 'Example', 'active', 'false', '2018-02-04 10:31:59', '2018-02-04 09:31:59'),
(8, 'Telangana', 'university', 'Examples', 'active', 'false', '2018-02-04 10:32:22', '2018-02-04 09:32:22'),
(9, 'Karnataka', 'university', 'Pre Board', 'active', 'false', '2018-02-24 20:25:15', '2018-02-24 19:26:05'),
(10, 'Telangana', 'university', 'pavan', 'active', 'false', '2018-03-10 15:24:02', '2018-03-10 14:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `compitative_methods`
--

CREATE TABLE `compitative_methods` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `compitative_type_name` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `questions_count` tinyint(3) UNSIGNED DEFAULT NULL,
  `total_levels` tinyint(3) UNSIGNED DEFAULT NULL,
  `correct_answer_value` double(4,2) DEFAULT NULL,
  `negative_answer_value` double(4,2) DEFAULT NULL,
  `total_players` tinyint(2) UNSIGNED NOT NULL,
  `total_duration` double(5,2) DEFAULT NULL,
  `is_skip` varchar(3) DEFAULT NULL COMMENT 'Yes, No',
  `status` varchar(8) NOT NULL COMMENT 'Active, Inactive',
  `sync` varchar(5) NOT NULL COMMENT 'True, False',
  `created_date` datetime NOT NULL,
  `created_by` smallint(5) UNSIGNED NOT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_modified_by` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compitative_methods`
--

INSERT INTO `compitative_methods` (`id`, `compitative_type_name`, `name`, `questions_count`, `total_levels`, `correct_answer_value`, `negative_answer_value`, `total_players`, `total_duration`, `is_skip`, `status`, `sync`, `created_date`, `created_by`, `last_modified_date`, `last_modified_by`) VALUES
(1, 'Buzzers', 'uservsuser', 12, 11, 1.00, 2.00, 3, 100.00, 'yes', 'active', 'false', '2018-03-28 22:20:01', 1, '2018-04-01 14:10:40', 1),
(2, 'Buzzers', 'uservsmultiple', 30, 11, 1.00, 2.00, 3, 45.00, 'no', 'active', '', '2018-03-28 22:21:10', 1, '2018-04-03 20:50:22', 1),
(3, 'Buzzers', 'uservssystem', 11, NULL, NULL, NULL, 0, NULL, '', 'active', 'false', '2018-03-28 22:22:57', 1, '2018-04-02 19:04:19', 1),
(4, 'buzzerss', 'uservssystem', NULL, NULL, 22.00, NULL, 0, NULL, '', '', 'false', '2018-03-28 22:34:01', 1, '2018-04-03 18:33:45', 1),
(5, 'buzzerss', 'uservsmultiple', NULL, NULL, 2.00, NULL, 0, NULL, '', 'inactive', 'false', '2018-03-28 22:34:07', 1, '2018-04-03 18:38:18', 1),
(6, 'buzzerss', 'uservsuser', 25, 5, 1.00, 0.50, 2, 50.09, 'yes', 'active', 'false', '2018-03-28 22:34:12', 1, '2018-04-03 19:18:36', 1),
(7, 'ssssssssssssssssssssssssssssssssssssssssssssssssvv', 'uservsmultiple', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'active', 'false', '2018-03-28 22:44:48', 1, '2018-03-28 20:44:48', 1),
(8, 'ssssssssssssssssssssssssssssssssssssssssssssssssvv', 'uservssystem', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'active', 'false', '2018-03-28 22:45:14', 1, '2018-03-28 20:45:14', 1),
(9, 'home ohhh', 'uservsmultiple', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'active', 'false', '2018-03-28 23:03:11', 1, '2018-03-28 21:03:11', 1),
(10, 'One Or Moreeeeeeeeeeeeeeeeeeeeevvvvvvvvvvvvvvaaaaa', 'uservsuser', 1, 3, 3.00, 4.00, 4, 4.00, 'yes', 'active', '', '2018-03-28 23:19:04', 1, '2018-04-01 11:09:03', 1),
(11, 'One Or Moreeeeeeeeeeeeeeeeeeeeevvvvvvvvvvvvvvaaaaa', 'uservsmultiple', 11, 1, 1.00, 1.00, 1, 1.00, 'yes', 'active', '', '2018-03-28 23:19:06', 1, '2018-04-01 11:07:13', 1),
(12, 'One Or Moreeeeeeeeeeeeeeeeeeeeevvvvvvvvvvvvvvaaaaa', 'uservssystem', 1, 3, 3.00, 4.00, 4, 4.00, 'yes', 'active', '', '2018-03-28 23:19:08', 1, '2018-04-01 11:09:04', 1),
(13, 'Hello', 'uservssystem', 2, 2, 2.00, 2.00, 1, 2.00, 'no', 'inactive', 'false', '2018-03-28 23:19:50', 1, '2018-04-03 19:15:37', 1),
(14, 'Hellos', 'uservssystem', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'active', 'false', '2018-03-31 20:01:03', 1, '2018-03-31 18:01:04', 1),
(15, 'Hellos', 'uservsmultiple', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'active', 'false', '2018-03-31 20:01:05', 1, '2018-03-31 18:01:09', 1),
(16, 'Round Rabin', 'uservsmultiple', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'active', 'false', '2018-04-01 16:11:46', 1, '2018-04-01 14:11:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `compitative_types`
--

CREATE TABLE `compitative_types` (
  `id` tinyint(2) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'Buzzer, Tournament and Etc.',
  `status` varchar(8) NOT NULL COMMENT 'Active, Inactive',
  `sync` varchar(5) NOT NULL COMMENT 'True, False',
  `created_date` datetime NOT NULL,
  `created_by` smallint(5) UNSIGNED NOT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_modified_by` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compitative_types`
--

INSERT INTO `compitative_types` (`id`, `name`, `status`, `sync`, `created_date`, `created_by`, `last_modified_date`, `last_modified_by`) VALUES
(1, 'Buzzers', 'active', 'false', '2018-03-26 23:59:50', 1, '2018-03-26 19:26:43', 1),
(2, 'Round Rabin', 'active', 'false', '2018-03-26 23:59:50', 1, '2018-03-26 18:29:50', 0),
(3, 'One Or Moreeeeeeeeeeeeeeeeeeeeevvvvvvvvvvvvvvaaaaa', 'active', 'false', '2018-03-26 20:49:54', 1, '2018-03-26 18:49:54', 1),
(4, 'ssssssssssssssssssssssssssssssssssssssssssssssssvv', 'active', 'false', '2018-03-26 20:52:08', 1, '2018-03-26 18:52:08', 1),
(5, 'home ohhh', 'active', 'false', '2018-03-26 21:03:39', 1, '2018-03-26 19:03:39', 1),
(6, 'buzzerss', 'active', 'false', '2018-03-26 21:28:52', 1, '2018-03-26 19:28:52', 1),
(7, 'Hellos', 'active', 'false', '2018-03-28 23:19:39', 1, '2018-03-28 21:20:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(6) UNSIGNED NOT NULL,
  `stream_id` smallint(4) UNSIGNED NOT NULL,
  `name` varchar(75) NOT NULL,
  `short_name` varchar(7) NOT NULL,
  `status` varchar(8) NOT NULL COMMENT 'Active, Inactive',
  `sync` varchar(5) NOT NULL COMMENT 'True, False',
  `created_date` datetime NOT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `stream_id`, `name`, `short_name`, `status`, `sync`, `created_date`, `last_modified_date`) VALUES
(1, 1, 'Electrical And Communication Engineering', 'ECE', 'active', 'false', '2018-01-16 21:02:25', '2018-02-24 20:50:28'),
(2, 2, 'CIVIL Engineering', 'CIVIL', 'active', 'false', '2018-01-16 21:02:25', '2018-01-16 15:32:25'),
(3, 2, 'Information Technology', 'IT', 'active', 'false', '2018-01-16 21:28:27', '2018-01-16 15:58:27'),
(4, 2, 'Electrical And Electronics Engineering', 'EEE', 'active', 'false', '2018-01-16 21:28:27', '2018-01-16 15:58:27'),
(5, 2, 'Electrical And Communication Engineering', 'ECE', 'active', 'false', '2018-01-16 21:28:27', '2018-01-16 15:58:27'),
(6, 1, 'Computer Science And Engineerings', 'CSE', 'active', 'false', '0000-00-00 00:00:00', '2018-02-24 20:52:03'),
(8, 2, 'CIVIL Engineerings', 'CIVIL', 'active', 'false', '2018-01-17 08:26:06', '2018-01-17 07:26:06'),
(9, 6, 'vind', 'vnd', 'active', 'false', '2018-01-17 14:53:38', '2018-01-17 13:53:38'),
(10, 9, 'Biology Physics Chemistry', 'BIPC', 'active', 'false', '2018-02-24 20:51:58', '2018-02-24 19:51:58'),
(11, 6, 'xyaz', 'asdf', 'active', 'false', '2018-02-24 21:24:57', '2018-02-24 20:24:57'),
(12, 6, 'xyazs', 'sadfasf', 'active', 'false', '2018-02-24 21:56:41', '2018-02-24 20:59:14'),
(13, 19, 'xya', 'ssfssd', 'active', 'false', '2018-02-25 15:19:48', '2018-02-25 14:19:48'),
(14, 19, 'qqqqqqqqqq', 'wwwwwww', 'active', 'false', '2018-03-10 15:07:18', '2018-03-10 14:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `category_type` varchar(8) NOT NULL COMMENT 'State, District, Mandal, City, Village',
  `country_name` varchar(50) NOT NULL,
  `state_name` varchar(30) DEFAULT NULL,
  `district_name` varchar(55) DEFAULT NULL,
  `city_name` varchar(55) DEFAULT NULL,
  `mandal_name` varchar(55) DEFAULT NULL,
  `village_name` varchar(55) DEFAULT NULL,
  `latitude` double(15,11) DEFAULT NULL,
  `longitude` double(15,11) DEFAULT NULL,
  `status` varchar(8) NOT NULL COMMENT 'Active, Inactive',
  `sync` varchar(5) NOT NULL COMMENT 'True, False',
  `created_date` datetime NOT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='It containts States, Districts, Cities, Mandals and Villages Data';

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `category_type`, `country_name`, `state_name`, `district_name`, `city_name`, `mandal_name`, `village_name`, `latitude`, `longitude`, `status`, `sync`, `created_date`, `last_modified_date`) VALUES
(1, 'country', 'india', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', 'false', '2018-03-13 23:22:15', '2018-03-13 22:22:15'),
(2, 'state', 'india', 'telangana', NULL, NULL, NULL, NULL, NULL, NULL, 'active', 'false', '2018-03-13 23:22:15', '2018-03-13 22:22:15'),
(3, 'district', 'india', 'telangana', 'rangareddy', NULL, NULL, NULL, NULL, NULL, 'active', 'false', '2018-03-13 23:22:15', '2018-03-13 22:22:15'),
(4, 'city', 'india', 'telangana', 'rangareddy', 'hyderabad', NULL, NULL, NULL, NULL, 'active', 'false', '2018-03-13 23:22:15', '2018-03-13 22:22:15'),
(5, 'mandal', 'india', 'telangana', 'rangareddy', NULL, 'ghatkesar', NULL, NULL, NULL, 'active', 'false', '2018-03-13 23:22:15', '2018-03-13 22:22:15'),
(6, 'village', 'india', 'telangana', 'rangareddy', NULL, 'ghatkesar', 'miyapur', NULL, NULL, 'active', 'false', '2018-03-13 23:22:15', '2018-03-13 22:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `next_route`
--

CREATE TABLE `next_route` (
  `id` int(6) UNSIGNED NOT NULL,
  `parent_stream` smallint(4) UNSIGNED NOT NULL,
  `child_stream` smallint(4) UNSIGNED NOT NULL,
  `status` varchar(8) NOT NULL COMMENT 'Active, Inactive',
  `sync` varchar(5) NOT NULL COMMENT 'True, False',
  `created_date` datetime NOT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `next_route`
--

INSERT INTO `next_route` (`id`, `parent_stream`, `child_stream`, `status`, `sync`, `created_date`, `last_modified_date`) VALUES
(1, 5, 6, '1', '2', '2017-12-10 19:27:40', '2017-12-10 18:27:40'),
(2, 5, 1, '1', '2', '2017-12-10 19:27:40', '2017-12-10 18:27:40'),
(3, 1, 8, '1', '2', '2017-12-10 19:27:40', '2017-12-10 18:27:40');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` varchar(8) NOT NULL COMMENT 'Active, Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Here we are going to store permissions';

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `status`) VALUES
(1, 'users', 'active'),
(2, 'education', 'active'),
(3, 'settings', 'active'),
(4, 'x', 'active'),
(5, 'y', 'active'),
(6, 'z', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` tinyint(2) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` varchar(8) NOT NULL COMMENT 'Active, Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='here we are going to store roles';

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `status`) VALUES
(1, 'superadmin', 'active'),
(2, 'admin', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` smallint(4) UNSIGNED NOT NULL,
  `user_id` smallint(5) UNSIGNED DEFAULT NULL,
  `role` varchar(30) DEFAULT NULL,
  `is_primary` varchar(3) DEFAULT NULL,
  `permission` varchar(30) DEFAULT NULL,
  `status` varchar(8) NOT NULL COMMENT 'Active, Inactive',
  `created_date` datetime NOT NULL,
  `created_by` smallint(5) UNSIGNED NOT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_modified_by` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='here we are going to store role wise permissions';

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `user_id`, `role`, `is_primary`, `permission`, `status`, `created_date`, `created_by`, `last_modified_date`, `last_modified_by`) VALUES
(1, 1, 'superadmin', 'yes', '', 'active', '2018-03-11 18:04:02', 1, '2018-03-12 17:42:15', 1),
(7, 14, 'admin', 'yes', NULL, 'active', '2018-03-12 19:16:55', 1, '2018-03-12 18:16:56', 1),
(8, 18, 'admin', 'yes', NULL, 'active', '2018-03-12 21:20:08', 1, '2018-03-12 20:24:18', 1),
(9, 19, 'admin', 'yes', NULL, 'active', '2018-03-12 21:27:07', 1, '2018-03-12 20:27:09', 1),
(11, 0, 'admin', '', 'y', 'inactive', '2018-03-13 19:09:07', 1, '2018-03-13 18:49:57', 1),
(13, 0, 'admin', '', 'x', 'inactive', '2018-03-13 19:47:03', 1, '2018-03-13 18:49:55', 1),
(14, NULL, 'superadmin', NULL, 'education', 'active', '2018-03-13 19:48:40', 1, '2018-03-13 18:48:40', 1),
(15, NULL, 'superadmin', NULL, 'settings', 'active', '2018-03-13 19:48:40', 1, '2018-03-13 18:48:40', 1),
(16, NULL, 'superadmin', NULL, 'users', 'active', '2018-03-13 19:48:40', 1, '2018-03-13 18:48:40', 1),
(17, NULL, 'superadmin', NULL, 'x', 'active', '2018-03-13 19:48:40', 1, '2018-03-13 18:48:40', 1),
(18, NULL, 'superadmin', NULL, 'y', 'active', '2018-03-13 19:48:40', 1, '2018-03-13 18:48:40', 1),
(19, NULL, 'superadmin', NULL, 'z', 'active', '2018-03-13 19:48:40', 1, '2018-03-13 18:48:40', 1),
(20, 0, 'admin', '', 'users', 'active', '2018-03-13 19:49:48', 1, '2018-03-13 18:49:48', 1),
(21, 0, 'admin', '', 'education', 'active', '2018-03-13 19:49:50', 1, '2018-03-13 18:49:50', 1),
(22, 0, 'admin', '', 'settings', 'active', '2018-03-13 19:49:52', 1, '2018-03-13 18:49:52', 1),
(23, 0, 'admin', '', 'z', 'active', '2018-03-13 19:50:00', 1, '2018-03-13 18:50:00', 1),
(24, 20, 'admin', 'yes', NULL, 'active', '2018-04-04 00:50:21', 1, '2018-04-03 22:50:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `streams`
--

CREATE TABLE `streams` (
  `id` smallint(4) UNSIGNED NOT NULL,
  `category` varchar(40) NOT NULL COMMENT 'Post Graduation, Under Graduation and Etc.',
  `name` varchar(75) NOT NULL COMMENT 'Like Bachelor Of Enineering,Bachelor Of Technology',
  `short_name` varchar(7) NOT NULL,
  `status` varchar(8) NOT NULL COMMENT 'Active, Inactive',
  `sync` varchar(5) NOT NULL COMMENT 'True, False',
  `created_date` datetime NOT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `streams`
--

INSERT INTO `streams` (`id`, `category`, `name`, `short_name`, `status`, `sync`, `created_date`, `last_modified_date`) VALUES
(1, 'Under Graduation', 'Bachelor Of Engineering', 'BE', 'active', 'false', '2017-12-08 19:15:42', '2018-02-04 10:50:14'),
(2, 'Under Graduation', 'Bachelor Of Technology', 'BTECH', '1', '2', '2017-12-08 19:15:42', '2017-12-08 18:15:42'),
(3, 'Under Graduation', 'Bachelor In Computer Application', 'BCA', '1', '2', '2017-12-08 19:15:42', '2017-12-08 18:15:42'),
(4, 'Under Graduation', 'Bachelor Of Business Administration', 'BBA', '1', '2', '2017-12-08 19:15:42', '2017-12-08 18:15:42'),
(5, 'Under Graduation', 'Bachelor Of Commerce', 'BCOM', '1', '2', '2017-12-08 19:15:42', '2017-12-08 18:15:42'),
(6, 'Post Graduation', 'Master Of Computer Applications', 'MCA', 'active', 'false', '2017-12-08 19:15:42', '2018-02-04 10:52:50'),
(7, 'Post Graduation', 'Master Of Business Administration', 'MBA', 'active', 'false', '2017-12-08 19:15:42', '2018-02-04 10:50:28'),
(8, 'Post Graduation', 'Master Of Engineering', 'ME', 'active', 'false', '2017-12-08 19:15:42', '2018-02-04 10:54:31'),
(9, 'Secondary Education', 'Intermediate Education', 'INTER', '1', '1', '2017-12-11 03:21:28', '2017-12-10 21:51:28'),
(10, 'Under Graduation', 'Bachelor Of Engineeringsss', 'BE', 'active', '', '0000-00-00 00:00:00', '2018-01-16 18:39:12'),
(11, 'Under Graduation', 'Bachelor Of Engineerings', 'BE', 'active', '', '0000-00-00 00:00:00', '2018-01-16 18:41:41'),
(12, 'Under Graduation', 'Bachelor Of Engineeringssss', 'BE', 'active', '', '0000-00-00 00:00:00', '2018-01-16 18:44:06'),
(13, 'Under Graduation', 'Bachelor Of Engineeringv', 'BE', 'active', '', '0000-00-00 00:00:00', '2018-01-16 18:46:01'),
(14, 'Under Graduation', 'Bachelor Of Engineeringa', 'BE', 'active', '', '0000-00-00 00:00:00', '2018-01-16 18:48:56'),
(15, 'Under Graduation', 'Bachelor Of Engineeringp', 'BE', 'active', '', '0000-00-00 00:00:00', '2018-01-16 18:51:10'),
(16, 'Under Graduation', 'House Education', 'BEH', 'active', '', '0000-00-00 00:00:00', '2018-01-16 19:00:49'),
(17, 'Under Graduation', 'Bachelor Of Sciy', 'BSY', 'active', '', '0000-00-00 00:00:00', '2018-01-16 19:06:57'),
(18, 'Under Graduation', 'Abc Stream name', 'ASN', 'active', 'false', '2018-01-17 08:30:57', '2018-01-17 07:30:57'),
(19, 'Primary Education', 'Bachelor Of Engineering', 'SSC', 'active', 'false', '2018-02-24 20:33:17', '2018-02-24 19:33:52'),
(20, 'Primary Education', 'wewsg', 'sdfsf', 'active', 'false', '2018-02-25 15:19:08', '2018-02-25 14:19:08'),
(21, 'Primary Education', 'xyaza', 'ss', 'active', 'false', '2018-04-03 21:30:48', '2018-04-03 19:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `board_id` smallint(4) UNSIGNED NOT NULL,
  `group_id` mediumint(6) UNSIGNED NOT NULL,
  `year` tinyint(1) NOT NULL,
  `sem` varchar(15) NOT NULL,
  `name` varchar(75) NOT NULL,
  `status` varchar(8) NOT NULL COMMENT 'Active, Inactive',
  `sync` varchar(5) NOT NULL COMMENT 'True, False',
  `created_date` datetime NOT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `board_id`, `group_id`, `year`, `sem`, `name`, `status`, `sync`, `created_date`, `last_modified_date`) VALUES
(1, 1, 13, 1, 'semester-1', 'first subject', 'active', 'false', '2018-04-03 22:18:22', '2018-04-03 20:18:22'),
(2, 1, 13, 1, 'semester-1', 'second subject', 'active', 'false', '2018-04-03 22:18:22', '2018-04-03 20:18:22'),
(3, 7, 13, 1, 'semester-1', 'third subject', 'active', 'false', '2018-04-03 22:18:22', '2018-04-03 22:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `category_type` varchar(15) NOT NULL COMMENT 'forgotpassword',
  `user_id` smallint(5) UNSIGNED NOT NULL,
  `token` varchar(6) DEFAULT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `category_type`, `user_id`, `token`, `created_date`) VALUES
(1, 'forgotpassword', 4, '178812', '2018-03-11 10:45:33'),
(2, 'forgotpassword', 4, '280167', '2018-03-11 10:46:26'),
(3, 'forgotpassword', 4, '380443', '2018-03-11 10:46:43'),
(4, 'forgotpassword', 4, '166283', '2018-03-11 10:47:32'),
(5, 'forgotpassword', 4, '421752', '2018-03-11 10:51:23'),
(6, 'forgotpassword', 4, '475582', '2018-03-11 11:39:59'),
(7, 'forgotpassword', 4, '748014', '2018-03-11 11:41:49'),
(8, 'forgotpassword', 4, '011561', '2018-03-11 11:42:44'),
(9, 'forgotpassword', 4, '486651', '2018-03-11 11:49:14'),
(10, 'forgotpassword', 4, '741115', '2018-03-11 11:51:15'),
(11, 'forgotpassword', 4, '300348', '2018-03-11 11:52:48'),
(12, 'forgotpassword', 4, '846077', '2018-03-11 12:07:02'),
(13, 'forgotpassword', 4, '034372', '2018-03-11 12:10:55'),
(14, 'forgotpassword', 1, '061377', '2018-03-11 12:12:52'),
(15, 'forgotpassword', 4, '786837', '2018-03-11 12:21:59'),
(16, 'forgotpassword', 4, '871607', '2018-03-11 12:22:48'),
(17, 'forgotpassword', 4, '358228', '2018-03-11 12:24:42'),
(18, 'forgotpassword', 1, '572224', '2018-03-12 18:44:03'),
(19, 'forgotpassword', 1, '658012', '2018-03-13 23:31:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` varchar(10) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `status` varchar(8) NOT NULL COMMENT 'Active, Inactive',
  `sync` varchar(5) NOT NULL COMMENT 'True, False',
  `created_date` datetime NOT NULL,
  `created_by` smallint(5) UNSIGNED NOT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_modified_by` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `password`, `email`, `phone`, `image`, `status`, `sync`, `created_date`, `created_by`, `last_modified_date`, `last_modified_by`) VALUES
(1, 'Venkat', '$2y$13$Du0jlXBmkbRdcyOaQtcCXeKm/3yX8rBts09pC.YJnULqiBn/nRY7.', 'venkat@whtnxt.com', '1234567890', NULL, 'active', 'false', '2018-01-17 08:19:00', 1, '2018-03-13 22:32:19', NULL),
(18, 'Meda Naresh Kumar', '$2y$13$y7whxmqbCMt9PEJ8SPlSdOTqktxiybzmDLPxLxZbRbmM67YMKV9S.', 'naresh1@gmail.com', '1234567898', NULL, 'active', 'false', '2018-03-12 21:20:08', 1, '2018-03-12 20:24:18', NULL),
(19, 'Meda Naresh Kumar', '$2y$13$nI8FaxQrA4NlOpSpi6zGjuiFE6LuMaJWzZxhYHP3kcQiesmNPC.r.', 'naresh11@gmail.com', '1234557890', NULL, 'active', 'false', '2018-03-12 21:27:07', 1, '2018-03-12 20:27:08', NULL),
(20, 'xyzabac', '$2y$13$cJjkTh5RuzdYjy3BW9BswOmen9nWrAOZFEywiI9TZQ8KTa7vh4kCC', 'abc@abc.com', '9999999999', NULL, 'active', 'false', '2018-04-04 00:50:21', 1, '2018-04-03 22:50:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_locations`
--

CREATE TABLE `users_locations` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `user_id` smallint(5) UNSIGNED NOT NULL,
  `location_access_category` varchar(7) NOT NULL COMMENT 'country, state, city',
  `country_name` varchar(50) NOT NULL,
  `state_name` varchar(30) DEFAULT NULL,
  `city_name` varchar(55) DEFAULT NULL,
  `status` varchar(8) NOT NULL COMMENT 'Active, Inactive',
  `created_date` datetime NOT NULL,
  `created_by` smallint(5) UNSIGNED NOT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_modified_by` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_locations`
--

INSERT INTO `users_locations` (`id`, `user_id`, `location_access_category`, `country_name`, `state_name`, `city_name`, `status`, `created_date`, `created_by`, `last_modified_date`, `last_modified_by`) VALUES
(1, 4, 'city', 'India', 'Telangana', 'Warangal', 'active', '2018-02-26 20:50:55', 1, '2018-02-26 19:50:56', NULL),
(2, 5, 'country', 'India', '', '', 'active', '2018-02-26 21:03:45', 1, '2018-02-26 20:03:47', NULL),
(3, 6, 'state', 'India', 'Telangana', '', 'active', '2018-02-26 21:05:56', 1, '2018-02-26 20:06:53', NULL),
(4, 7, 'city', 'India', 'Telangana', 'Hyderabad', 'active', '2018-02-26 21:07:18', 1, '2018-02-26 20:07:20', NULL),
(5, 8, 'state', 'India', 'Telangana', '', 'active', '2018-02-26 21:08:56', 1, '2018-02-26 20:08:58', NULL),
(6, 9, 'city', 'India', 'Telangana', 'Hyderabad', 'active', '2018-03-10 15:04:53', 1, '2018-03-10 14:04:55', NULL),
(7, 14, 'city', 'India', 'Telangana', 'Hyderabad', 'active', '2018-03-12 19:16:55', 1, '2018-03-12 20:01:15', 1),
(8, 18, 'city', 'India', 'Telangana', 'Karimnagar', 'active', '2018-03-12 21:20:08', 1, '2018-03-12 20:24:18', 1),
(9, 19, 'country', 'India', '', '', 'active', '2018-03-12 21:27:07', 1, '2018-03-12 20:27:09', NULL),
(10, 20, 'city', 'india', 'telangana', 'hyderabad', 'active', '2018-04-04 00:50:21', 1, '2018-04-03 22:50:50', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compitative_methods`
--
ALTER TABLE `compitative_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compitative_types`
--
ALTER TABLE `compitative_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `next_route`
--
ALTER TABLE `next_route`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `streams`
--
ALTER TABLE `streams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_locations`
--
ALTER TABLE `users_locations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boards`
--
ALTER TABLE `boards`
  MODIFY `id` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `compitative_methods`
--
ALTER TABLE `compitative_methods`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `compitative_types`
--
ALTER TABLE `compitative_types`
  MODIFY `id` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `next_route`
--
ALTER TABLE `next_route`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `streams`
--
ALTER TABLE `streams`
  MODIFY `id` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users_locations`
--
ALTER TABLE `users_locations`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
