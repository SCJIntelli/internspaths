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
-- Table structure for table `admindata`
--

DROP TABLE IF EXISTS `admindata`;
CREATE TABLE IF NOT EXISTS `admindata` (
  `adminnum` int(20) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT 'Please Update Your Profile',
  `mobile` varchar(20) NOT NULL DEFAULT '0000000000000',
  `profileurl` varchar(500) DEFAULT '../images/avatar-01.jpg',
  `occupation` varchar(100) NOT NULL DEFAULT 'Unknown',
  PRIMARY KEY (`adminnum`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admindata`
--

INSERT INTO `admindata` (`adminnum`, `id`, `username`, `email`, `name`, `mobile`, `profileurl`, `occupation`) VALUES
(1, 1, 'Shamal', 'shamalchamara@gmail.com', 'Shamal Jayathilake', '0766573601', '../uploads/1.jpeg', 'Network  Engineer'),
(2, 11, 'Shamal2', 'test2@TEST.SDFS', 'Please Update Your Profile', '0000000000000', '../images/avatar-01.jpg', 'Unknown');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
