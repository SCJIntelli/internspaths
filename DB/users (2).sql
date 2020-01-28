-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 28, 2020 at 05:43 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `usertype`, `email`) VALUES
(1, 'Shamal', '$2y$10$I5ya/fc.uGql.78/wy1t9e5UzyBEELksTV.7X2evGghltOyBGZxXS', '2020-01-25 02:08:13', 'Admin', 'shamal@internspaths.ml'),
(5, 'Company', '$2y$10$PoWIV2wjhzVwTt4OjPMYRe4mNDQI5yH20ed82vMaUjnLQ4htVX052', '2020-01-25 12:07:13', 'Company', 'company@internspaths.ml'),
(4, 'Student', '$2y$10$1JGdm2kNWHm24AWGihS5eOQ4gDn0nwuTE.6D.vinnSqBUV1tIylyu', '2020-01-25 11:52:36', 'Student', 'student@internspaths.ml'),
(9, 'Student2', '$2y$10$TmD8ZasAflshA96VXI2ErujvaRJeAu1sIXY1qmfdgxR6fsFUWm5jK', '2020-01-28 00:09:18', 'Student', 'student2@internspaths.ml'),
(10, 'std', '$2y$10$7ZXKrA8SZelmX98nWsM3leRS600.M1Qhu5mVB88ue.KUrxmBDpFgu', '2020-01-28 00:10:03', 'Student', 'saw@waea.sda'),
(11, 'Shamal2', '$2y$10$njLcHkIueG1KvlSOsXti..kS8.S4mUag47f7H4xvTnPW9pfWZzM3G', '2020-01-28 00:24:47', 'Admin', 'test2@TEST.SDFS'),
(12, 'COM2', '$2y$10$lL633iIVz3aMbqnfiiGvl.MEwaV4zXUfHbZo4uprVm1pbvRZ5bTFW', '2020-01-28 00:25:20', 'Company', 'wew@dwa.rad'),
(13, 'stu2', '$2y$10$7.0CRoxsFI7cGxuWGx7OV.5dX5MIPSSJtLUnCIqjQ/DGkvOSOs3kC', '2020-01-28 00:25:41', 'Student', 'test@test.com'),
(14, 'testuser', '$2y$10$Xu3VRDpgFWtaGzAYxeEwT.SG/hsc1KccbAgWydkohNR.7kernR5Dq', '2020-01-28 00:58:35', 'Student', 'pjayathi@gmail.com'),
(15, 'etestst', '$2y$10$/bvgssTqhfTs7yFMDLcN7eeBpddyGa8LmLRcpkj/WhVLaI1mciibS', '2020-01-28 01:15:06', 'Student', '123123123@123.123'),
(16, 'Student123', '$2y$10$3fopfLaXAwrWHLu29Ntkf.riJejitKpOGibp/oDnNXAIXbjsTmR8.', '2020-01-28 01:21:31', 'Student', '123@123123123.com'),
(17, 'Shamal12312', '$2y$10$HS7JvnC9m8erP/wnYfyu4upQ.1MuGhNJTEz7ddK8FxWJ6S8wsavrS', '2020-01-28 01:25:45', 'Student', '122323@123123123.com'),
(18, 'Shamaltest', '$2y$10$Fy/bDQtiq32UOgFTuk6.a.y1wAitlSo7fA2Fbb9J1FlQDtgwelqGS', '2020-01-28 02:27:36', 'Student', '1221231323@123123123.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
