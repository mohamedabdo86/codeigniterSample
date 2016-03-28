-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: mysql
-- Generation Time: Sep 02, 2015 at 09:41 AM
-- Server version: 5.1.73
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mynestle_com_eg`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `members_ID` int(10) NOT NULL AUTO_INCREMENT,
  `members_first_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `members_last_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `members_email` varchar(100) NOT NULL,
  `members_password` blob NOT NULL,
  `members_old_password` text NOT NULL,
  `members_salt` text NOT NULL,
  `members_birthdate` date DEFAULT NULL,
  `members_mobile` longtext CHARACTER SET latin1,
  `members_address` text NOT NULL,
  `members_city_id` int(11) NOT NULL,
  `members_relationship_id` int(11) NOT NULL,
  `members_addeddate` datetime NOT NULL,
  `members_children` smallint(5) DEFAULT NULL,
  `members_images` varchar(200) CHARACTER SET latin1 NOT NULL,
  `members_newsletter` smallint(5) DEFAULT NULL,
  `members_avatar_ID` int(10) DEFAULT NULL,
  `members_interested` smallint(5) DEFAULT NULL,
  `members_points` int(10) NOT NULL,
  `members_nickname` text NOT NULL,
  `members_lang` text NOT NULL,
  `members_fb_id` int(11) NOT NULL,
  `members_login_attempts` int(11) NOT NULL,
  `members_login_lock_time` int(11) NOT NULL,
  `members_access_token` text NOT NULL,
  `members_activated` text NOT NULL,
  `members_reset_password_requested` text NOT NULL,
  `members_reset_password_active` int(11) NOT NULL,
  PRIMARY KEY (`members_ID`),
  UNIQUE KEY `members_email` (`members_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11130 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
