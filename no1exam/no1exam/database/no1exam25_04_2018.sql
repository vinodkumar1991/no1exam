-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2018 at 08:25 PM
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
(1, 'Buzzers', 'uservsuser', 12, 11, 1.00, 2.00, 3, 100.00, 'no', 'active', 'false', '2018-03-28 22:20:01', 1, '2018-04-04 03:14:31', 1),
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
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` tinyint(3) UNSIGNED NOT NULL,
  `template_code` varchar(5) NOT NULL,
  `from_email` varchar(40) NOT NULL,
  `params` mediumtext NOT NULL,
  `to_email` varchar(40) NOT NULL,
  `cc` varchar(160) DEFAULT NULL,
  `bcc` varchar(160) DEFAULT NULL,
  `status` varchar(9) NOT NULL COMMENT 'Sent , Not Sent',
  `confirmation_token` varchar(55) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` tinyint(3) UNSIGNED NOT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_modified_by` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_type` varchar(5) NOT NULL COMMENT 'Audio, Video, Text, Gif, Image',
  `question_level` varchar(7) NOT NULL COMMENT 'easy, medium, hard',
  `subject_id` mediumint(8) UNSIGNED NOT NULL,
  `question` mediumtext NOT NULL,
  `file_name` varchar(225) DEFAULT NULL,
  `status` varchar(8) NOT NULL COMMENT 'active, inactive',
  `created_date` datetime NOT NULL,
  `created_by` smallint(5) UNSIGNED NOT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_modified_by` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_type`, `question_level`, `subject_id`, `question`, `file_name`, `status`, `created_date`, `created_by`, `last_modified_date`, `last_modified_by`) VALUES
(1, 'text', 'easy', 1, 'Who is your favourite star?', '', 'active', '2018-04-22 13:36:12', 1, '2018-04-22 11:36:12', 1),
(2, 'text', 'easy', 1, 'Who is your favourite star?', '', 'active', '2018-04-22 13:36:27', 1, '2018-04-22 11:36:27', 1),
(3, 'text', 'easy', 1, 'Who is your favourite star?', '', 'active', '2018-04-22 13:37:35', 1, '2018-04-22 11:37:35', 1),
(4, 'text', 'easy', 1, 'Who is your favourite star?', '', 'active', '2018-04-22 13:37:55', 1, '2018-04-22 11:37:55', 1),
(5, 'text', 'easy', 1, 'Who is your favourite star?', '', 'active', '2018-04-22 13:38:09', 1, '2018-04-22 11:38:09', 1),
(6, 'text', 'medium', 1, 'Who is your best singer?', '', 'active', '2018-04-22 13:51:34', 1, '2018-04-22 11:51:35', 1),
(7, 'text', 'medium', 2, 'what is your age?', '', 'active', '2018-04-22 13:52:56', 1, '2018-04-22 11:52:56', 1),
(8, 'text', 'medium', 2, 'ssssssssssssssssssss', '', 'active', '2018-04-22 13:58:26', 1, '2018-04-22 11:58:26', 1),
(9, 'text', 'heard', 1, 'sourourororo', '', 'active', '2018-04-22 14:03:06', 1, '2018-04-22 12:03:06', 1),
(10, 'text', 'heard', 1, 'hard question', '', 'active', '2018-04-22 14:39:31', 1, '2018-04-22 12:39:31', 1),
(11, 'text', 'medium', 1, 'asdfasfasfd', '', 'active', '2018-04-22 14:40:25', 1, '2018-04-22 12:40:25', 1),
(12, 'text', 'easy', 1, 'asdfasdfasdf', '', 'active', '2018-04-22 15:06:10', 1, '2018-04-22 13:06:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_answers`
--

CREATE TABLE `question_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `answer` text NOT NULL,
  `status` varchar(8) NOT NULL COMMENT 'active, inactive',
  `is_correct_answer` varchar(5) NOT NULL COMMENT 'true, false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_answers`
--

INSERT INTO `question_answers` (`id`, `question_id`, `answer`, `status`, `is_correct_answer`) VALUES
(1, 5, 'one', 'active', 'false'),
(2, 5, 'two', 'active', 'false'),
(3, 5, 'three', 'active', 'false'),
(4, 5, 'four', 'active', 'false'),
(5, 6, 'haris', 'active', 'false'),
(6, 6, 'ar', 'active', 'true'),
(7, 6, 'gv', 'active', 'false'),
(8, 6, 'yuvan', 'active', 'false'),
(9, 7, '24', 'active', 'false'),
(10, 7, '26', 'active', 'false'),
(11, 7, '27', 'active', 'false'),
(12, 7, '30', 'active', 'false'),
(13, 8, 'ss', 'active', 'false'),
(14, 8, 'sss', 'active', 'true'),
(15, 8, 'sfour', 'active', 'false'),
(16, 8, 'sfive', 'active', 'true'),
(17, 9, 'sss', 'active', 'false'),
(18, 9, 'vvv', 'active', 'true'),
(19, 9, 'safsadfsvvvvvvv', 'active', 'true'),
(20, 9, 'safasdfsdf', 'active', 'true'),
(21, 10, 'sadf', 'active', 'false'),
(22, 10, 'adsf', 'active', 'false'),
(23, 10, 'sdaf', 'active', 'false'),
(24, 10, 'sdafasfd', 'active', 'false'),
(25, 11, 'asdfas', 'active', 'false'),
(26, 11, 'ssssss', 'active', 'false'),
(27, 11, 'vvvvvv', 'active', 'false'),
(28, 11, 'fffffffff', 'active', 'false'),
(29, 12, 'asfdasf', 'active', 'true'),
(30, 12, 'sadfsafsadf', 'active', 'false'),
(31, 12, 'sdfsadfsadfsads', 'active', 'true'),
(32, 12, 'sdfsdfdf', 'active', 'false');

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
-- Table structure for table `senderids`
--

CREATE TABLE `senderids` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `message_type` varchar(5) NOT NULL COMMENT 'Sms, Email',
  `category_type` varchar(13) NOT NULL COMMENT 'Transactional, Promotional',
  `subject` varchar(140) NOT NULL,
  `route` tinyint(2) DEFAULT NULL COMMENT 'message sending route numbers like 4 and 1 in MSG91',
  `status` varchar(8) NOT NULL COMMENT 'Active, Inactive',
  `sync` varchar(5) NOT NULL COMMENT 'True, False',
  `created_date` datetime NOT NULL,
  `created_by` tinyint(3) UNSIGNED NOT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_modified_by` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='here we are going to store only subjects of email or sms';

--
-- Dumping data for table `senderids`
--

INSERT INTO `senderids` (`id`, `message_type`, `category_type`, `subject`, `route`, `status`, `sync`, `created_date`, `created_by`, `last_modified_date`, `last_modified_by`) VALUES
(1, 'sms', 'transactional', 'LASFGP', 4, 'active', 'false', '2018-02-10 20:03:28', 1, '2018-02-10 19:03:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` tinyint(3) UNSIGNED NOT NULL,
  `template_code` varchar(5) NOT NULL,
  `mobile_number` varchar(55) NOT NULL,
  `params` varchar(500) NOT NULL,
  `status` varchar(9) NOT NULL COMMENT 'Sent, Not Sent',
  `confirmation_token` varchar(55) DEFAULT NULL,
  `created_by` tinyint(3) UNSIGNED NOT NULL,
  `created_date` datetime NOT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_modified_by` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms`
--

INSERT INTO `sms` (`id`, `user_id`, `template_code`, `mobile_number`, `params`, `status`, `confirmation_token`, `created_by`, `created_date`, `last_modified_date`, `last_modified_by`) VALUES
(1, 1, 'FGPWD', '9502038283', '{\"token\":\"604725\"}', 'sent', '38626c61796e393530393337', 1, '2018-02-11 10:54:10', '2018-02-11 19:55:16', NULL),
(2, 1, 'FGPWD', '9705999270', '{\"token\":\"221762\"}', 'sent', '38626c617774313730363637', 1, '2018-02-11 11:05:35', '2018-02-11 19:53:21', NULL),
(3, 1, 'FGPWD', '9705999270', '{\"token\":\"063332\"}', 'sent', '38626c617774373236363333', 1, '2018-02-11 11:11:48', '2018-02-11 19:53:22', NULL),
(4, 1, 'FGPWD', '9705999270', '{\"token\":\"743778\"}', 'sent', '38626c617774343636303834', 1, '2018-02-11 11:12:26', '2018-02-11 19:53:22', NULL),
(5, 1, 'FGPWD', '9705999270', '{\"token\":\"337181\"}', 'sent', '38626c617775313932363133', 1, '2018-02-11 11:42:09', '2018-02-11 19:53:22', NULL),
(6, 1, 'FGPWD', '9705999270', '{\"token\":\"136231\"}', 'sent', '38626c617775303336343838', 1, '2018-02-11 11:43:48', '2018-02-11 19:53:23', NULL),
(7, 1, 'FGPWD', '9705999270', '{\"token\":\"884244\"}', 'sent', '38626c617775343235393031', 1, '2018-02-11 11:50:02', '2018-02-11 19:53:23', NULL),
(8, 1, 'FGPWD', '9705999270', '{\"token\":\"183202\"}', 'sent', '38626c617776393130373739', 1, '2018-02-11 11:59:31', '2018-02-11 19:53:23', NULL),
(9, 1, 'FGPWD', '9705999270', '{\"token\":\"115142\"}', 'sent', '38626c617776333832363832', 1, '2018-02-11 13:05:23', '2018-02-11 19:53:24', NULL),
(10, 1, 'FGPWD', '9705999270', '{\"token\":\"600525\"}', 'sent', '38626c617776383433383130', 1, '2018-02-11 13:06:37', '2018-02-11 19:53:24', NULL),
(11, 1, 'FGPWD', '9705999270', '{\"token\":\"802077\"}', 'sent', '38626c617777383337363930', 1, '2018-02-11 13:09:00', '2018-02-11 19:53:24', NULL),
(12, 1, 'FGPWD', '9705999270', '{\"token\":\"113120\"}', 'sent', '38626c617777373737383930', 1, '2018-02-11 13:11:04', '2018-02-11 19:53:25', NULL),
(13, 1, 'FGPWD', '9705999270', '{\"token\":\"843461\"}', 'sent', '38626c617778383839323136', 1, '2018-02-11 13:11:22', '2018-02-11 19:53:25', NULL),
(14, 1, 'FGPWD', '9705999270', '{\"token\":\"847678\"}', 'sent', '38626c617778363938303738', 1, '2018-02-11 13:12:15', '2018-02-11 19:53:26', NULL),
(15, 1, 'FGPWD', '9705999270', '{\"token\":\"105342\"}', 'sent', '38626c617778323735313337', 1, '2018-02-11 13:12:49', '2018-02-11 19:53:26', NULL),
(16, 1, 'FGPWD', '9705999270', '{\"token\":\"856824\"}', 'sent', '38626c617779383630383336', 1, '2018-02-11 13:13:20', '2018-02-11 19:53:26', NULL),
(17, 1, 'FGPWD', '9705999270', '{\"token\":\"310556\"}', 'sent', '38626c617779393935363330', 1, '2018-02-11 13:14:45', '2018-02-11 19:53:27', NULL),
(18, 1, 'FGPWD', '9705999270', '{\"token\":\"665343\"}', 'sent', '38626c617779313732393736', 1, '2018-02-11 13:15:45', '2018-02-11 19:53:27', NULL),
(19, 1, 'FGPWD', '9705999270', '{\"token\":\"513384\"}', 'sent', '38626c61777a333639343738', 1, '2018-02-11 13:16:15', '2018-02-11 19:53:27', NULL),
(20, 1, 'FGPWD', '9705999270', '{\"token\":\"462450\"}', 'sent', '38626c61777a373137313635', 1, '2018-02-11 13:18:55', '2018-02-11 19:53:28', NULL),
(21, 1, 'FGPWD', '9705999270', '{\"token\":\"586215\"}', 'sent', '38626c61777a353838343532', 1, '2018-02-11 13:20:52', '2018-02-11 19:53:28', NULL),
(22, 1, 'FGPWD', '9705999270', '{\"token\":\"147085\"}', 'sent', '38626c617741303336303431', 1, '2018-02-11 13:21:29', '2018-02-11 19:53:28', NULL),
(23, 1, 'FGPWD', '9705999270', '{\"token\":\"030741\"}', 'sent', '38626c617741353530383039', 1, '2018-02-11 13:25:44', '2018-02-11 19:53:29', NULL),
(24, 1, 'FGPWD', '9705999270', '{\"token\":\"624011\"}', 'sent', '38626c617741333332323530', 1, '2018-02-11 18:22:28', '2018-02-11 19:53:29', NULL),
(25, 1, 'FGPWD', '9705999270', '{\"token\":\"618346\"}', 'sent', '38626c617742313739313137', 1, '2018-02-11 18:26:37', '2018-02-11 19:53:29', NULL),
(26, 1, 'FGPWD', '9705999270', '{\"token\":\"637014\"}', 'notsend', NULL, 1, '2018-02-11 21:02:30', '2018-02-11 20:02:30', NULL),
(27, 1, 'FGPWD', '9705999270', '{\"token\":\"421418\"}', 'notsend', NULL, 1, '2018-02-15 19:53:40', '2018-02-15 18:53:40', NULL),
(28, 1, 'FGPWD', '9705999270', '{\"token\":\"158445\"}', 'notsend', NULL, 1, '2018-02-15 20:02:10', '2018-02-15 19:02:10', NULL),
(29, 1, 'FGPWD', '9705999270', '{\"token\":\"058387\"}', 'notsend', NULL, 1, '2018-02-24 10:54:27', '2018-02-24 09:54:27', NULL);

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
(1, 1, 13, 1, 'semester-1', 'first subject', 'active', 'false', '2018-04-03 22:18:22', '2018-04-10 20:16:00'),
(2, 1, 13, 1, 'semester-1', 'second subject', 'active', 'false', '2018-04-03 22:18:22', '2018-04-10 20:15:57'),
(3, 7, 13, 1, 'semester-1', 'third subject', 'active', 'false', '2018-04-03 22:18:22', '2018-04-10 20:17:21'),
(4, 1, 13, 1, 'semester-1', 'fourth subject', 'active', 'false', '2018-04-10 21:51:22', '2018-04-10 20:16:41'),
(5, 1, 13, 1, 'semester-1', 'third subject', 'active', 'false', '2018-04-10 21:53:39', '2018-04-10 20:16:42');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `message_type` varchar(5) NOT NULL COMMENT 'Sms, Email',
  `from_email` varchar(40) DEFAULT NULL,
  `senderid_id` tinyint(3) NOT NULL,
  `code` varchar(5) NOT NULL,
  `name` varchar(30) NOT NULL COMMENT 'Customer Registration, Forgot Password and etc..',
  `template` mediumtext NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `status` varchar(8) NOT NULL COMMENT 'Active, Inactive',
  `sync` varchar(5) NOT NULL COMMENT 'True, False',
  `created_date` datetime NOT NULL,
  `created_by` tinyint(3) UNSIGNED NOT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_modified_by` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='here we are going to store body of the message';

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `message_type`, `from_email`, `senderid_id`, `code`, `name`, `template`, `description`, `status`, `sync`, `created_date`, `created_by`, `last_modified_date`, `last_modified_by`) VALUES
(1, 'sms', NULL, 1, 'FGPWD', 'Forgot Password', '{{token}} is your code for forgot password', 'Forgot password template.', 'active', 'false', '2018-02-10 20:04:32', 1, '2018-02-11 09:24:19', 1);

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
-- Indexes for table `email`
--
ALTER TABLE `email`
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
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_answers`
--
ALTER TABLE `question_answers`
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
-- Indexes for table `senderids`
--
ALTER TABLE `senderids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
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
-- Indexes for table `templates`
--
ALTER TABLE `templates`
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
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `question_answers`
--
ALTER TABLE `question_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
-- AUTO_INCREMENT for table `senderids`
--
ALTER TABLE `senderids`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `streams`
--
ALTER TABLE `streams`
  MODIFY `id` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
