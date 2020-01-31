-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 31, 2020 at 07:41 PM
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
  `description` varchar(3000) NOT NULL DEFAULT 'no description',
  `location` varchar(1000) DEFAULT NULL,
  `facebook` varchar(1000) DEFAULT NULL,
  `linkedin` varchar(1000) DEFAULT NULL,
  `twitter` varchar(1000) DEFAULT NULL,
  `fields` varchar(1000) NOT NULL DEFAULT '',
  `mission` varchar(5000) DEFAULT NULL,
  `vision` varchar(5000) DEFAULT NULL,
  `requests` varchar(1000) NOT NULL DEFAULT '',
  `applied` varchar(1000) NOT NULL DEFAULT '',
  `accepted` varchar(1000) NOT NULL DEFAULT '',
  PRIMARY KEY (`comnum`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`comnum`, `id`, `username`, `email`, `name`, `profileurl`, `mobile`, `address`, `description`, `location`, `facebook`, `linkedin`, `twitter`, `fields`, `mission`, `vision`, `requests`, `applied`, `accepted`) VALUES
(1, 5, 'Company', 'int@mil.lk', 'MIT', '../uploads/5.jpg', '0766573602', 'asdasdasdasd', 'The company summary in a business planï¿½also known as the company description or overviewï¿½is a high-level look at what you are as a company and how all the elements of the business fit together. An effective company summary should give readers, such as potential investors, a quick and easy way to understand your business, its products and services, its mission and goals, how it meets the needs of its target market, and how it stands out from competitors.\r\n\r\n\r\nBefore you begin writing your company summary, remember to stick to the big picture. Other sections of your business plan will provide the specific details of your business. The summary synthesizes all of that information into one page.', 'bla', 'facebook', '', '', 'java,css,machine learning,web designing,app developing', 'To provide superior quality healthcare services that: PATIENTS recommend to family and friends, PHYSICIANS prefer for their patients, PURCHASERS select for their clients, EMPLOYEES are proud of, and INVESTORS seek for long-term returns.', 'â€œTo become the worldâ€™s most loved, most flown, and most profitable airline.â€', '', '4,', '4,'),
(2, 12, 'COM2', 'wew@dwa.rad', 'Unknown', '../images/avatar-01.jpg', 'Unknown', 'Unknown', 'no description', '#', '#', '#', '#', '', NULL, '', '', '', ''),
(3, 17, 'Shamal12312', '122323@123123123.com', 'Unknown', '../images/avatar-01.jpg', 'Unknown', 'Unknown', 'no description', '#', '#', '#', '#', '', NULL, '', '', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
