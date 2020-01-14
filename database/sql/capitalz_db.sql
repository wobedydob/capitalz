-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 14, 2020 at 07:06 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capitalz_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

DROP TABLE IF EXISTS `job`;
CREATE TABLE IF NOT EXISTS `job` (
  `job_id` int(7) NOT NULL AUTO_INCREMENT,
  `company_id` int(7) NOT NULL,
  `title` varchar(75) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `work_hours` varchar(20) NOT NULL,
  `work_sal` varchar(20) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`job_id`,`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profile_co`
--

DROP TABLE IF EXISTS `profile_co`;
CREATE TABLE IF NOT EXISTS `profile_co` (
  `profile_id` int(7) NOT NULL,
  `user_id` int(7) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `country_loc` varchar(45) NOT NULL,
  `city_loc` varchar(45) NOT NULL,
  `about` text NOT NULL,
  `website` varbinary(271) NOT NULL,
  `kvk_nummer` varchar(20) NOT NULL,
  PRIMARY KEY (`profile_id`,`user_id`),
  UNIQUE KEY `kvk_nummer_UNIQUE` (`kvk_nummer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profile_se`
--

DROP TABLE IF EXISTS `profile_se`;
CREATE TABLE IF NOT EXISTS `profile_se` (
  `profile_id` int(7) NOT NULL AUTO_INCREMENT,
  `user_id` int(7) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `infix` varchar(15) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `gender` enum('m','f','o') NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `about` varchar(50) NOT NULL,
  `btw_nummer` varchar(20) NOT NULL,
  `cv_file` varbinary(271) DEFAULT NULL,
  PRIMARY KEY (`profile_id`,`user_id`),
  UNIQUE KEY `btw_nummer_UNIQUE` (`btw_nummer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(7) NOT NULL AUTO_INCREMENT,
  `email` varbinary(271) NOT NULL,
  `password` varchar(255) NOT NULL,
  `number` varchar(20) NOT NULL,
  `user_role` int(7) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `number_UNIQUE` (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` int(7) NOT NULL AUTO_INCREMENT,
  `role_title` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `role_title`) VALUES
(0, 'admin'),
(1, 'company'),
(2, 'selfemployed');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
