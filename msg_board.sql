-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2015 at 09:06 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `msg_board`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_id` int(11) DEFAULT NULL,
  `from_id` int(11) DEFAULT NULL,
  `content` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `to_id`, `from_id`, `content`, `created`, `modified`) VALUES
(16, 4, 1, 'dagasdgah', '2015-06-29 15:27:06', '2015-06-29 15:27:06'),
(19, 4, 5, 'asffhgfe4t', '2015-06-29 15:51:39', '2015-06-29 15:51:39'),
(23, 1, 6, 'q3534qt', '2015-06-30 08:59:58', '2015-06-30 08:59:58'),
(24, 1, 6, 'fhfck,jcgl', '2015-06-30 18:00:02', '2015-06-30 09:00:06'),
(27, 5, 6, 'asdgaejae45q345', '2015-06-30 09:00:48', '2015-06-30 09:00:48'),
(45, 1, 2, 'agasfha', '2015-06-30 09:38:53', '2015-06-30 09:38:53'),
(56, 3, 2, 'asfdasgash', '2015-06-30 11:07:19', '2015-06-30 11:07:19'),
(57, 5, 2, 'sdf2353', '2015-06-30 11:08:34', '2015-06-30 11:08:34'),
(59, 1, 7, 'fdhafh', '2015-06-30 11:56:07', '2015-06-30 11:56:08'),
(62, 2, 7, 'asdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfgasdfg', '2015-06-30 12:00:32', '2015-06-30 12:00:32'),
(64, 6, 7, 'asdfgasdfgasdfgasdfgasdfgasdfg', '2015-06-30 12:01:23', '2015-06-30 12:01:23'),
(65, 1, 7, 'saff', '2015-06-30 12:02:58', '2015-06-30 12:02:58'),
(66, 1, 7, 'fgjsdgjkyk', '2015-06-30 12:04:38', '2015-06-30 12:04:38'),
(67, 1, 7, 'tgkjdfhkl', '2015-06-30 12:05:24', '2015-06-30 12:05:24'),
(68, 6, 7, 'djhgkdhk', '2015-06-30 12:05:30', '2015-06-30 12:05:30'),
(70, 3, 7, 'qtrqreyq', '2015-06-30 12:05:55', '2015-06-30 12:05:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `hobby` text,
  `last_login_time` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_ip` varchar(20) DEFAULT NULL,
  `modified_ip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `gender`, `birthdate`, `hobby`, `last_login_time`, `created`, `modified`, `created_ip`, `modified_ip`) VALUES
(1, '123/@#4', '123@123.123', '$2a$10$yKtEkasIvmri4P3PBENvxOCeaSvFaIinFR1.kdJ3LymYOwazsUXhy', 'test-fail-icon.png', '1', '2015-06-07', '', '2015-06-30 08:31:38', '2015-06-29 14:11:55', '2015-06-30 08:49:45', '127.0.0.1', '127.0.0.1'),
(2, 'qwerty', 'qwer@net.com', '$2a$10$aq376PiJd4tJELjGvDxR4e2dA51J2ZBhnsHmMJqRw/TRWMs0qaFyy', 'meh.png', '1', '1997-12-08', '', '2015-06-30 11:46:04', '2015-06-29 14:53:24', '2015-06-30 11:49:45', '127.0.0.1', '127.0.0.1'),
(3, 'asdfg', 'asd@13.123', '$2a$10$HlLKngD3V5WE/GSY3ul9s.sf/EC0OormDeElqSX5SVHUpdjQKLwXK', 'cake.icon.png', '1', '1995-06-14', '', '2015-06-30 09:05:00', '2015-06-29 14:53:45', '2015-06-30 09:05:00', '127.0.0.1', '127.0.0.1'),
(4, '12345', '12345@asdxz.123', '$2a$10$sXza2hJyQLeaQG.MdtVTVO9wky01pVg9mthgNgB4YDbO/.cX2KYpa', 'user-default.png', NULL, NULL, NULL, '2015-06-30 04:49:57', '2015-06-29 15:14:09', '2015-06-30 04:49:57', '127.0.0.1', '127.0.0.1'),
(5, 'zxcv123', 'zxcv@123.123', '$2a$10$DAA9ppiRzo9OJ6ugJhOwkeqs0VI5MeAT7GYVp59Vj61f.oNWa0.Ee', 'user-default.png', NULL, NULL, NULL, '2015-06-29 15:51:12', '2015-06-29 15:51:03', '2015-06-29 15:51:12', '127.0.0.1', '127.0.0.1'),
(6, '123134', '12412@1231', '$2a$10$HoRb1Fbp5tZytYECX0tIPOrnLS5Kd0boCO1L2KebElHsK3qTXhbDi', 'user-default.png', NULL, NULL, NULL, '2015-06-30 08:56:56', '2015-06-30 08:56:48', '2015-06-30 08:56:56', '127.0.0.1', '127.0.0.1'),
(7, 'asdfqwe', 'asdfqwe@123', '$2a$10$/7giTIVzUN.oj39l.TTwwO0WI0Ai5riyTgFXzuh.DWik2jOaGVNRm', 'meh.png', '2', '1997-12-02', '', '2015-06-30 11:54:52', '2015-06-30 11:54:38', '2015-06-30 11:59:03', '127.0.0.1', '127.0.0.1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
