-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 28, 2020 at 05:42 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logindata`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `comnum` int(20) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT 'Unknown',
  `profileurl` varchar(500) NOT NULL DEFAULT '../images/avatar-01.jpg',
  `mobile` varchar(20) NOT NULL DEFAULT 'Unknown',
  `address` varchar(500) NOT NULL DEFAULT 'Unknown',
  PRIMARY KEY (`comnum`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`comnum`, `id`, `username`, `email`, `name`, `profileurl`, `mobile`, `address`) VALUES
(1, 5, 'Company', 'internspaths@mil.lk', 'MIT', '../images/avatar-01.jpg', '0766573602', 'colombo 07'),
(2, 12, 'COM2', 'wew@dwa.rad', 'Unknown', '../images/avatar-01.jpg', 'Unknown', 'Unknown'),
(3, 17, 'Shamal12312', '122323@123123123.com', 'Unknown', '../images/avatar-01.jpg', 'Unknown', 'Unknown');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
