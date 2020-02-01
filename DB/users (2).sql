-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 01, 2020 at 05:04 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `usertype`, `email`) VALUES
(1, 'Shamal', '$2y$10$E.Q7DSntUagUx4HNekg4BuHOFYr8ZEj7Hfg8CFTtghBX9sAzeFuYy', '2020-01-25 02:08:13', 'Admin', 'shamalchamara@gmail.com'),
(5, 'Company', '$2y$10$PoWIV2wjhzVwTt4OjPMYRe4mNDQI5yH20ed82vMaUjnLQ4htVX052', '2020-01-25 12:07:13', 'Company', 'int@mit.lk'),
(4, 'Student', '$2y$10$jcnc6KC1s5fIXQD34D2KfuOWbnvbWG0SuzeTmV5bPqfcFDadmgnAu', '2020-01-25 11:52:36', 'Student', 'shamalchamaratest@gmail.com'),
(9, 'Student2', '$2y$10$TmD8ZasAflshA96VXI2ErujvaRJeAu1sIXY1qmfdgxR6fsFUWm5jK', '2020-01-28 00:09:18', 'Student', 'student2@internspaths.ml'),
(10, 'std', '$2y$10$7ZXKrA8SZelmX98nWsM3leRS600.M1Qhu5mVB88ue.KUrxmBDpFgu', '2020-01-28 00:10:03', 'Student', 'saw@waea.sda'),
(11, 'Shamal2', '$2y$10$njLcHkIueG1KvlSOsXti..kS8.S4mUag47f7H4xvTnPW9pfWZzM3G', '2020-01-28 00:24:47', 'Admin', 'test2@TEST.SDFS'),
(12, 'COM2', '$2y$10$IGT3aAiUNbvLDbqeGRE3/.DNfvRdH5UVze6wbVRaQSMLfMRHyfJoa', '2020-01-28 00:25:20', 'Company', 'wew@dwa.rad'),
(13, 'stu2', '$2y$10$7.0CRoxsFI7cGxuWGx7OV.5dX5MIPSSJtLUnCIqjQ/DGkvOSOs3kC', '2020-01-28 00:25:41', 'Student', 'test@test.com'),
(14, 'testuser', '$2y$10$Xu3VRDpgFWtaGzAYxeEwT.SG/hsc1KccbAgWydkohNR.7kernR5Dq', '2020-01-28 00:58:35', 'Student', 'pjayathi@gmail.com'),
(15, 'etestst', '$2y$10$/bvgssTqhfTs7yFMDLcN7eeBpddyGa8LmLRcpkj/WhVLaI1mciibS', '2020-01-28 01:15:06', 'Student', '123123123@123.123'),
(24, 'Studentqe', '$2y$10$Ia29hESS9cxI5Q2bW.J1iOAt5nWuO1tB2hc0thHmPX3DtBfG0DL9m', '2020-01-30 13:02:34', 'Student', 'pjayaqweqwethi@gmail.com'),
(25, 'Shamal2qwe', '$2y$10$aegsdXQpVdy7QFEVravrA.TS.zrvnFXCOLczf66.3l.JFo0sCgIce', '2020-01-30 13:03:22', 'Student', 'shamalchqweqweqamara@gmail.com'),
(18, 'Shamaltest', '$2y$10$Fy/bDQtiq32UOgFTuk6.a.y1wAitlSo7fA2Fbb9J1FlQDtgwelqGS', '2020-01-28 02:27:36', 'Student', '1221231323@123123123.com'),
(26, 'Shamal2123123', '$2y$10$C99u0998/0w5WF3UDvIvweS45QFo4FlHeN1166s.T9UX4AM1GC/qi', '2020-01-30 13:04:16', 'Student', 'pjaya1231231231thi@gmail.com'),
(23, '1213', '$2y$10$Hk7cCMidWeKI6So15xZ2QuxMxfVzBmmKflbEkHl3klTe0SavSYC5G', '2020-01-30 13:01:43', 'Student', 'pjaya231231thi@gmail.com'),
(27, 'ScjDev1231231', '$2y$10$VZgZJt0cjsT5H4plvwzje.HD5ozhEnqcz8CLuYt2Zof5WSAexint2', '2020-01-30 13:05:05', 'Student', 'pjayat123123hi@gmail.com'),
(28, 'Shamal21231231', '$2y$10$UQ8MrX1srRxrWB0z9a2DrOhuVwWesWP9n.FwgJWPgIRT3241N5qK.', '2020-01-30 13:06:32', 'Student', 'pjaya131232thi@gmail.com'),
(29, 'Shamal2123122331', '$2y$10$yLUJwR07eOm/eGL2mqTFrOFw1WaP510FqjIF93YCzTZUFbnXmFZPi', '2020-01-30 13:07:21', 'Student', 'pjaya131232123thi@gmail.com'),
(30, 'Shamal21231223313242', '$2y$10$AS.6RtKM76Gxkm78jmdG9.Ddqg9I0O4M1jOBTCaJYdtzJSrKdxMi6', '2020-01-30 13:08:42', 'Student', 'pjaya131232123thi32@gmail.com'),
(31, 'Shamal2123122331324wewe2', '$2y$10$24p9CWO5jgpysaIDYKuv/eE8lCodW4GPrOpdnPOpQZKPbdgOGUw2y', '2020-01-30 13:09:19', 'Student', 'pjaya131232123thi2332@gmail.com'),
(32, 'Shamal21231223wewe31324wewe2', '$2y$10$/YhwXmEDyU4K0Ldh3rpC6.F1t6OnRYtKVP/xiIgqaPspcLqavS2ly', '2020-01-30 13:09:59', 'Student', 'pjaya131232123th32i2332@gmail.com'),
(33, 'Shamal21231223wewe31324wewe2wew', '$2y$10$MjQDEAI2AIl15nT98Rd66.OuPpMRiOkWpP1nQ5Cg0SY33N8Ng/.8.', '2020-01-30 13:11:38', 'Student', 'pjaya1312232123th32i2332@gmail.com'),
(34, 'Shamal21231223wewe31324wewsdse2wew', '$2y$10$wCS8iFnxal/d/FVJUlzk2.WEcKoJfxeYPtKuasugfnAquMNqLNmqu', '2020-01-30 13:12:37', 'Student', 'pjaya1312232121233th32i2332@gmail.com'),
(35, 'stu1', '$2y$10$KIH4a30BXexgbRc7tmyyUeATbWYLLEbLjKWblmThcXitB8Iufze8.', '2020-01-31 18:51:56', 'Student', 'dfslgks@jkefkja.arn');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
