-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 29, 2020 at 08:40 PM
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
  `field` varchar(100) NOT NULL DEFAULT 'Electronic & Telecommunication Engineering',
  `dateofbirth` varchar(10) NOT NULL,
  `requests` varchar(1000) NOT NULL,
  `applied` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `username`, `email`, `mobile`, `name`, `lastname`, `profileurl`, `address`, `gender`, `linkedin`, `gpa`, `personalweb`, `cvurl`, `descrip`, `field`, `dateofbirth`, `requests`, `applied`) VALUES
(4, 'Student', 'shamalchamara@gmail.com', '0712369217', 'Tharaka', 'Jayaweera', '../uploads/4.jpg', 'Kegalle, sri lanka', 'Male', 'https://www.linkedin.com/in/shamal-jayathilake', 3.7561, 'test.com', '../cvuploads/4.pdf', 'I am a person who is positive about every aspect of life. There are many things I like to do, to see, and to experience. I like to read, I like to write; I like to think, I like to dream; I like to talk, I like to listen. I like to see the sunrise in the morning, I like to see the moonlight at night; I like to feel the music flowing on my face, I like to smell the wind coming from the ocean. I like to look at the clouds in the sky with a blank mind, I like to do thought experiment when I cannot sleep in the middle of the night. I like flowers in spring, rain in summer, leaves in autumn, and snow in winter. I like to sleep early, I like to get up late; I like to be alone, I like to be surrounded by people. I like countryï¿½s peace, I like metropolisï¿½ noise; I like the beautiful west lake in Hangzhou, I like the flat cornfield in Champaign. I like delicious food and comfortable shoes; I like good books and romantic movies. I like the land and the nature, I like people. And, I like to laugh.', 'Electronic & Telecommunication Engineering', '2020-01-07', '', '5,5,12,17,12,12,5,5,5,');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
