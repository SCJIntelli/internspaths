-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 31, 2020 at 07:40 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

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
  `gpa` float NOT NULL DEFAULT 4.2,
  `personalweb` varchar(500) NOT NULL DEFAULT '#',
  `cvurl` varchar(500) NOT NULL DEFAULT '#',
  `descrip` varchar(2000) NOT NULL DEFAULT 'No Description',
  `whatdo` varchar(1000) DEFAULT NULL,
  `interest` varchar(1000) DEFAULT NULL,
  `field` varchar(100) NOT NULL DEFAULT 'Electronic & Telecommunication Engineering',
  `dateofbirth` varchar(10) NOT NULL DEFAULT '',
  `requests` varchar(1000) NOT NULL DEFAULT '',
  `applied` varchar(1000) NOT NULL DEFAULT '',
  `accepted` varchar(1000) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `username`, `email`, `mobile`, `name`, `lastname`, `profileurl`, `address`, `gender`, `linkedin`, `gpa`, `personalweb`, `cvurl`, `descrip`, `whatdo`, `interest`, `field`, `dateofbirth`, `requests`, `applied`, `accepted`) VALUES
(4, 'Student', 'shamalchamara@gmail.com', '0712369217', 'isuru', 'Jayaweera', '../uploads/4.jpg', 'Kegalle, sri lanka', 'Male', 'https://www.linkedin.com/in/shamal-jayathilake', 3.7561, 'test.com', '../cvuploads/4.pdf', '', '', 'machine learning,java script', 'Civil Engineering', '2020-01-07', '', '5,12,', ''),
(24, '4321', '32ds1@1223.321', '0123456789', 'Please Update Your Profile', 'Unknown', '../uploads/24.png', 'Unknowndfv', 'Male', '#', 4.2, '#', '#', 'No Description', NULL, NULL, 'Electronic & Telecommunication Engineering', '2010-12-02', '', '', ''),
(25, '54321', 'bgd@fvd.jhyyd', '0123456789', 'Please Update Your Profile', 'Unknown', '../uploads/25.jpg', 'Unknown', 'Male', '#', 4.2, '#', '#', 'No Description', NULL, NULL, 'Electronic & Telecommunication Engineering', '', '', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
