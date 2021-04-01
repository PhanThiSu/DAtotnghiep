-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 26, 2020 at 02:23 AM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.28-3+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: ``
--

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `event` text NOT NULL,
  `status` int(11) NOT NULL,
  `ip` text NOT NULL,
  `location` text NOT NULL,
  `browser` text NOT NULL,
  `os` text NOT NULL,
  `agent` text NOT NULL,
  `latitude` text NOT NULL,
  `longitude` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) NOT NULL,
  `description` text,
  `status` varchar(225) NOT NULL,
  `start_day` date DEFAULT NULL,
  `end_day` date DEFAULT NULL,
  `user_created_id` int(11) NOT NULL,
  `leader_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `status`, `start_day`, `end_day`, `user_created_id`, `leader_id`, `created`, `updated`) VALUES
(1, 'Unknow group', '  ', '1', '2018-06-03', '2018-06-30', 102, NULL, '2018-06-02 02:24:48', '2018-06-05 04:33:55');

-- --------------------------------------------------------

--
-- Table structure for table `groups_users`
--

DROP TABLE IF EXISTS `groups_users`;
CREATE TABLE IF NOT EXISTS `groups_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date_report` date NOT NULL,
  `job` text NOT NULL,
  `group_id` int(11) NOT NULL,
  `time_start` datetime DEFAULT NULL,
  `work_time` float NOT NULL,
  `time_end` datetime NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `notes` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `datetime_start` datetime NOT NULL,
  `datetime_end` datetime NOT NULL,
  `reason` text NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avata` varchar(255) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `tocken` varchar(225) DEFAULT NULL,
  `remember_me_identify` text,
  `remember_me_token` text,
  `datebirth` date NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '2',
  `status` tinyint(1) NOT NULL DEFAULT '2',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `avata`, `firstname`, `lastname`, `phone`, `address`, `tocken`, `remember_me_identify`, `remember_me_token`, `datebirth`, `role`, `status`, `created`, `updated`) VALUES
(1, 'softdevelopinc@gmail.com', '4df6d131d249ac12f52ca505740946a9', '152796338753418.jpeg', 'Linh', 'Duong', '01233400555', '171 Tran Quy Khoach - Da Nang', '', '&#36;2y&#36;10&#36;ROOXbjHggFuNO4/JmDp75Q&#61;&#61;', '&#36;2y&#36;10&#36;ROOXbjHggFuNO4/JmDp75OHuiFhJyhF4KYCfMYbGL/SAxw5TOhuyu', '1989-09-23', 1, 1, '2017-09-16 11:34:12', '2019-12-03 02:37:06'),
(2, 'haiduongdana@gmail.com', 'c12b008dc0ee8a77331b0b362cf10489', '152818732214121.jpeg', 'Test123', 'PSCD', '098 1357579', '61 Le Van Si - Hoa Minh -Lien Chieu', NULL, '$2y$10$0XtGAZ6/EPk4w5AD2RSKLg==', '$2y$10$0XtGAZ6/EPk4w5AD2RSKLeexyRNBevmf12tHDUZZWdmu.ZpGD4olS', '2018-05-27', 3, 1, '2018-06-03 11:38:52', '2019-07-02 02:34:44'),
(3, 'pacificsoftdev@gmail.com', '77ee5cfd4de5e348ac74888913fada7b', '157352277085581.png', 'PSCD', 'Admin', '0933856155', '121 Dang Huy Tru', NULL, '&#36;2y&#36;10&#36;umlYbyVOFyXg3SyRizuMxg&#61;&#61;', '&#36;2y&#36;10&#36;umlYbyVOFyXg3SyRizuMxeudTAtn0BjwHqYZXZRINRLjEPHskRlHK', '2012-05-14', 1, 1, '2019-11-12 08:39:30', '2020-02-21 11:25:24');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
