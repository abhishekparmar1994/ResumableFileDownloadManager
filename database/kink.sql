-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 21, 2017 at 02:57 PM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.6.31-6+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kink`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) DEFAULT NULL,
  `url` varchar(2048) DEFAULT NULL,
  `filesize` int(11) DEFAULT NULL,
  `type` char(3) DEFAULT NULL,
  `ext` varchar(15) DEFAULT NULL,
  `complete` char(1) DEFAULT NULL,
  `resume` char(1) DEFAULT NULL,
  `avg_speed` varchar(20) DEFAULT NULL,
  `location_id` int(11) NOT NULL,
  `storage_path` varchar(255) NOT NULL,
  `last_try` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `added_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`file_id`),
  KEY `by_name` (`filename`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=310 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `filename`, `url`, `filesize`, `type`, `ext`, `complete`, `resume`, `avg_speed`, `location_id`, `storage_path`, `last_try`, `added_on`) VALUES
(309, 'wrar550.exe', 'https://www.win-rar.com/fileadmin/winrar-versions/winrar/wrar550.exe', 1987408, 'app', '.exe', 'y', 'y', '32.881 KBps', 1, '192.168.0.84/aaa/21.12.2017', '2017-12-21 09:22:12', '2017-12-21 09:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `file_list`
--

CREATE TABLE IF NOT EXISTS `file_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(455) NOT NULL,
  `status` varchar(5) NOT NULL DEFAULT 'n',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `file_list`
--

INSERT INTO `file_list` (`id`, `url`, `status`) VALUES
(1, 'http://ftp.opera.com/pub/opera/desktop/49.0.2725.39/win/Opera_49.0.2725.39_Setup.exe', 'y'),
(8, 'https://shop.aida64.co.uk/files/download/cache/aida64business595.zip', 'y'),
(9, 'http://download.cdn.viber.com/desktop/windows/ViberSetup.exe', 'y'),
(10, 'http://download.adlice.com/RogueKiller/setup.exe', 'y'),
(11, 'http://download.bullguard.com/BullGuard180BPP_171003.exe', 'y'),
(12, 'https://www.win-rar.com/fileadmin/winrar-versions/winrar/wrar550.exe', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `country_id`, `state_id`, `city_id`, `name`, `address`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Rajkot-0001', 'Rajkot kishanpara', NULL, '2017-11-10 23:49:16', '2017-11-10 23:56:56');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
