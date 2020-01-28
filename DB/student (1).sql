-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 28, 2020 at 05:40 AM
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
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` varchar(20) NOT NULL DEFAULT '0123456789',
  `name` varchar(200) NOT NULL DEFAULT 'Please Update Your Profile',
  `lastname` varchar(100) NOT NULL DEFAULT 'Unknown',
  `profileurl` varchar(500) NOT NULL DEFAULT '../images/avatar-01.jpg',
  `address` varchar(500) NOT NULL DEFAULT 'Unknown',
  `gender` varchar(6) NOT NULL DEFAULT 'Male',
  `linkedin` varchar(500) NOT NULL DEFAULT '#',
  `gpa` float NOT NULL DEFAULT '4.2',
  `personalweb` varchar(500) NOT NULL DEFAULT '#',
  `cvurl` varchar(500) NOT NULL DEFAULT '#',
  `descrip` varchar(2000) NOT NULL DEFAULT 'No Description',
  `field` varchar(100) NOT NULL DEFAULT 'Electronic & Telecommunication Engineering',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `username`, `email`, `mobile`, `name`, `lastname`, `profileurl`, `address`, `gender`, `linkedin`, `gpa`, `personalweb`, `cvurl`, `descrip`, `field`) VALUES
(4, 'Student', 'shamalchamara@gmail.com', '11111111111', 'Isuru', 'Jayaweera', '../uploads/4.png', 'kegalle', 'Male', 'https://www.linkedin.com/in/shamal-jayathilake', 3.7561, 'test.com', '../cvuploads/4.pdf', 'test', 'Electrical Engineering');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
