-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2016 at 01:34 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hyperkonnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `searches`
--

CREATE TABLE IF NOT EXISTS `searches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(255) NOT NULL,
  `temp` varchar(255) NOT NULL,
  `sunrise` varchar(255) NOT NULL,
  `sunset` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `searches`
--

INSERT INTO `searches` (`id`, `city`, `temp`, `sunrise`, `sunset`, `date`) VALUES
(1, 'Bangalore, IN', '37', '2:35 am', '3:02 pm', '2016-04-18 09:55:49'),
(2, 'Minna, NG', '30', '7:21 am', '7:44 pm', '2016-04-18 09:56:20'),
(3, 'Ikeja, NG', '31', '7:37 am', '7:54 pm', '2016-04-18 09:56:43'),
(4, 'Jos, NG', '29', '7:12 am', '7:34 pm', '2016-04-18 09:57:11'),
(5, 'Jos, NG', '29', '7:12 am', '7:34 pm', '2016-04-18 10:08:30'),
(6, 'Delhi, IN', '41', '2:21 am', '3:19 pm', '2016-04-18 11:07:56'),
(8, 'London, GB', '9.64', '6:56 am', '9:03 pm', '2016-04-18 11:58:26'),
(9, 'Makurdi, NG', '33.95', '7:15 am', '7:34 pm', '2016-04-18 12:31:45');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
