-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 25, 2019 at 07:29 PM
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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `usertype` varchar(20) NOT NULL DEFAULT 'Student',
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `usertype`, `email`) VALUES
(2, 'Shamal', '$2y$10$1swUky7y/FE7pXRlazoGYupDqDCdZsXw3YNcrNwlX63.g8L.ZEvBi', '2019-12-24 01:15:05', 'Student', ''),
(5, 'Shamal2', '$2y$10$lS0FoodvR2ADV5ndfB9A8..WwYkluGRT2pd2eLD6JBzLC5C9lY1J6', '2019-12-24 01:59:24', 'Admin', 'test@test.com'),
(6, 'admin', '$2y$10$gRixLbsa98vBVolvdjR2Ee4ljyIEmFFfKlKdLRjzuuraafK/nqtN2', '2019-12-24 11:56:24', 'Admin', 'divineavenger2@gmail.com'),
(41, 'Nirmali', '$2y$10$X10JP1l3/GHCWjdKyYxJSupBhsGZRvOW3V0WXNYzcr7nCRTtHZtYy', '2019-12-26 00:27:39', 'Admin', 'nirmalisiriwardhana@gmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
