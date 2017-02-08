-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 17, 2014 at 08:12 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `a9360692_seds`
--
CREATE DATABASE IF NOT EXISTS `a9360692_seds` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `a9360692_seds`;

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE IF NOT EXISTS `list` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET armscii8 NOT NULL,
  `regno` int(10) NOT NULL,
  `branch` text NOT NULL,
  `workedfor` text NOT NULL,
  `roleinsinc` text NOT NULL,
  `roleinseds` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `regno` (`regno`),
  KEY `id` (`id`),
  FULLTEXT KEY `branch` (`branch`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `list`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
