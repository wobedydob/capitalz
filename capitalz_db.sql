-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 14, 2020 at 10:47 AM
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
  `job_id` int(7) NOT NULL,
  `title` varchar(255) NOT NULL,
  `info` varchar(45) NOT NULL,
  `company_id` int(7) NOT NULL,
  `location` varchar(45) NOT NULL,
  `hours` datetime NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `salary` varchar(45) NOT NULL,
  PRIMARY KEY (`job_id`),
  KEY `job.company_id - user.user_id_idx` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(7) NOT NULL AUTO_INCREMENT,
  `email` varbinary(271) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userrole` int(2) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `user.user_role - user_role.role_id_idx` (`userrole`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `userrole`) VALUES
(12, 0x6a65737365406a65737365, '$2y$10$j87eKubKkjlKdRIWeEZqw.kROq0JqKTynjWWtESFRqy3TIHt5Hbdq', 2),
(13, 0x776f6240776f622e636f6d, '$2y$10$Ljc/aSLqT5OkBDwfLIa7y./PKugWEYyU9BMCbcQV0lQyBAT1cM7Bq', 2),
(14, 0x726f62696e40722e6e6c, '$2y$10$db30cpva1O2jpd33e9iPzO.Q.ELp1B8/GIVKq/dZWYmdgmZ5bxFwe', 2),
(15, 0x6d616d6140706170612e6e6c, '$2y$10$/QmJyaTWeKhl/BLziDy2B.1qFyPF0k83T63hC2hHdxam7yZNooyAu', 2),
(16, 0x72617940686f6c742e636f6d, '$2y$10$YjDkRdVGViZbG6auTrYgNet9BsFcv2pPSeMv8L601G8dhLuVjjN26', 2),
(17, 0x6e616d65406e616d652e6e6c, '$2y$10$JmBRSC9aYQ6uUaQg2ipetufVG9a51NKFj0Gyb1KS07h5jspyL0NWi', 2),
(18, 0x6977616e406977616e2e6e6c, '$2y$10$/qovpDmXMIBkwVCvaCNiZerXXYys0VPFj0lzCYaiO2EfpoC/pI3Zm', 2),
(19, 0x6977616e406e6c2e6e6c, '$2y$10$8k9XHHC6MIl6dnxKFCbhLO07Fz4eTpEzOm693UjXC7lq/FXuAv6nS', 2),
(20, 0x726f62626965407761742e636f6d, '$2y$10$xP1WU3XemEA5HSifGNmydu9GKbZxv86W8X7RvHtd1BRyra2HytcDy', 2),
(21, 0x526f62626965407761742e636f6d, '$2y$10$vb3gGbXjJQVAhJIhKVufr.ACP5mjnPbWLyeyz8fcCFA6lpy34NOE6', 2),
(22, 0x70656e40656c6c65626f6f672e6e6c, '$2y$10$u3TdNMoQSgJ6apweg7Bnbur/b8JLL0L.aG/B01aONHw3H4ME9YRcO', 2),
(23, 0x62656472696a664062656472696a662e6e6c, '$2y$10$.rzzbSBPU3JbbCjbMV0iH.wGx9HDF8YHwibJzhx0J/guYKkddY2mW', 1),
(24, 0x737469667440656c6c65626f6f672e6e6c, '$2y$10$tHIy6vA5VQkNdRF9i7ukoeDN1gmO.IdMyn0EJMSaODer8B4KvpRma', 2),
(25, 0x67616166656d61696c407375706572636f6f6c2e636f6d, '$2y$10$LLGaqI4tNPCYZ3GTgqcr4.jUf0qXtIle8cd049pUBcf9vRrksYj3.', 2),
(26, 0x6a61636b40696e6465626f782e636f6d, '$2y$10$ONJV32llyXUZkpmo4SqR2eEvL3JBM2qEW7tk0M2cya6BQ0VvCJdAm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `user_id` int(7) NOT NULL,
  `key` varchar(45) NOT NULL,
  `value` varchar(45) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `value_UNIQUE` (`value`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `key`, `value`) VALUES
(19, 'btw-nummer', '761827'),
(20, 'btw-nummer', '123123'),
(21, 'btw-nummer', '83789817'),
(22, 'btw-nummer', '12789138'),
(23, 'kvk-nummer', '12345678'),
(24, 'btw-nummer', 'NL-001234567-B34');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE IF NOT EXISTS `user_profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `gender` enum('m','f','o') NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `about` text NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_profile.user_id - user.user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`user_id`, `name`, `birthday`, `gender`, `nationality`, `about`) VALUES
(22, 'Pen Teller', '8237-12-07', 'o', 'Niederlandisch', 'Jajajaja ik ben fantastisch'),
(24, 'Jos de Dos', '2001-10-12', 'm', 'Netherlands', 'supr zzp\\x27er');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` int(2) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `title`) VALUES
(0, 'admin'),
(1, 'company'),
(2, 'selfemployed');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job.company_id - user.user_id` FOREIGN KEY (`company_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user.user_role - user_role.role_id` FOREIGN KEY (`userrole`) REFERENCES `user_role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user.user_id - user_info.user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `profile.user_id - user_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
