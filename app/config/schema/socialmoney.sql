-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 25, 2010 at 04:45 PM
-- Server version: 5.1.37
-- PHP Version: 5.2.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `socialmoney`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_user_id` int(11) NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `transactions` int(11) NOT NULL,
  `preference` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `friend_request_id` int(11) NOT NULL,
  `mirror_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` VALUES(10, 2, 3, 100.00, 2, 0, 1, 4, 11, '2010-10-25 01:17:41', '2010-10-25 01:17:41');
INSERT INTO `friends` VALUES(11, 3, 2, -100.00, 2, 0, 1, 4, 10, '2010-10-25 01:17:41', '2010-10-25 01:17:41');
INSERT INTO `friends` VALUES(14, 4, 6, 300.00, 1, 0, 1, 7, 15, '2010-10-25 07:36:33', '2010-10-25 07:36:33');
INSERT INTO `friends` VALUES(15, 6, 4, -300.00, 1, 0, 1, 7, 14, '2010-10-25 07:36:33', '2010-10-25 07:36:33');
INSERT INTO `friends` VALUES(12, 3, 4, -66.00, 4, 0, 1, 5, 13, '2010-10-25 03:30:24', '2010-10-25 03:30:24');
INSERT INTO `friends` VALUES(13, 4, 3, 66.00, 4, 0, 1, 5, 12, '2010-10-25 03:30:24', '2010-10-25 03:30:24');
INSERT INTO `friends` VALUES(16, 4, 5, 0.00, 0, 0, 1, 8, 17, '2010-10-25 07:44:43', '2010-10-25 07:44:43');
INSERT INTO `friends` VALUES(17, 5, 4, 0.00, 0, 0, 1, 8, 16, '2010-10-25 07:44:43', '2010-10-25 07:44:43');
INSERT INTO `friends` VALUES(18, 3, 5, 0.00, 0, 0, 1, 10, 19, '2010-10-25 07:48:50', '2010-10-25 07:48:50');
INSERT INTO `friends` VALUES(19, 5, 3, 0.00, 0, 0, 1, 10, 18, '2010-10-25 07:48:50', '2010-10-25 07:48:50');

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` VALUES(4, 2, 3, 2, '2010-10-25 01:14:41', '2010-10-25 01:17:41');
INSERT INTO `friend_requests` VALUES(5, 3, 4, 2, '2010-10-25 03:30:00', '2010-10-25 03:30:24');
INSERT INTO `friend_requests` VALUES(8, 4, 5, 2, '2010-10-25 07:44:28', '2010-10-25 07:44:28');
INSERT INTO `friend_requests` VALUES(7, 4, 6, 2, '2010-10-25 07:35:33', '2010-10-25 07:35:33');
INSERT INTO `friend_requests` VALUES(9, 5, 2, 1, '2010-10-25 07:48:03', '2010-10-25 07:48:03');
INSERT INTO `friend_requests` VALUES(10, 3, 5, 2, '2010-10-25 07:48:25', '2010-10-25 07:48:44');
INSERT INTO `friend_requests` VALUES(11, 2, 1, 1, '2010-10-25 08:43:33', '2010-10-25 08:43:33');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--


-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` VALUES(1, 'Administrator', '2010-10-23 16:49:46', '2010-10-23 16:49:46');
INSERT INTO `roles` VALUES(2, 'User', '2010-10-23 16:50:28', '2010-10-23 16:50:28');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` VALUES(1, 'Pending', '2010-10-24 16:08:42', '2010-10-24 16:08:57');
INSERT INTO `statuses` VALUES(2, 'Accepted', '2010-10-24 16:09:02', '2010-10-24 16:09:02');
INSERT INTO `statuses` VALUES(3, 'Rejected', '2010-10-24 16:09:11', '2010-10-24 16:09:11');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `transaction_request_id` int(11) NOT NULL,
  `mirror_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` VALUES(21, 2, 3, -200.00, 10, 22, '2010-10-25 01:19:32', '2010-10-25 01:19:32');
INSERT INTO `transactions` VALUES(22, 3, 2, 200.00, 10, 21, '2010-10-25 01:19:32', '2010-10-25 01:19:32');
INSERT INTO `transactions` VALUES(23, 3, 2, -300.00, 11, 24, '2010-10-25 01:24:26', '2010-10-25 01:24:26');
INSERT INTO `transactions` VALUES(24, 2, 3, 300.00, 11, 23, '2010-10-25 01:24:26', '2010-10-25 01:24:26');
INSERT INTO `transactions` VALUES(25, 3, 4, 30.00, 12, 26, '2010-10-25 03:34:39', '2010-10-25 03:34:39');
INSERT INTO `transactions` VALUES(26, 4, 3, -30.00, 12, 25, '2010-10-25 03:34:39', '2010-10-25 03:34:39');
INSERT INTO `transactions` VALUES(27, 4, 3, -60.00, 13, 28, '2010-10-25 06:14:59', '2010-10-25 06:14:59');
INSERT INTO `transactions` VALUES(28, 3, 4, 60.00, 13, 27, '2010-10-25 06:14:59', '2010-10-25 06:14:59');
INSERT INTO `transactions` VALUES(29, 4, 3, 600.00, 14, 30, '2010-10-25 06:28:20', '2010-10-25 06:28:20');
INSERT INTO `transactions` VALUES(30, 3, 4, -600.00, 14, 29, '2010-10-25 06:28:20', '2010-10-25 06:28:20');
INSERT INTO `transactions` VALUES(31, 3, 4, 444.00, 17, 32, '2010-10-25 07:31:27', '2010-10-25 07:31:27');
INSERT INTO `transactions` VALUES(32, 4, 3, -444.00, 17, 31, '2010-10-25 07:31:27', '2010-10-25 07:31:27');
INSERT INTO `transactions` VALUES(33, 6, 4, -300.00, 18, 34, '2010-10-25 07:37:29', '2010-10-25 07:37:29');
INSERT INTO `transactions` VALUES(34, 4, 6, 300.00, 18, 33, '2010-10-25 07:37:29', '2010-10-25 07:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_requests`
--

CREATE TABLE `transaction_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `transaction_requests`
--

INSERT INTO `transaction_requests` VALUES(13, 4, 3, -60.00, 2, '2010-10-25 05:50:54', '2010-10-25 06:13:46');
INSERT INTO `transaction_requests` VALUES(12, 3, 4, 30.00, 2, '2010-10-25 03:34:28', '2010-10-25 03:34:39');
INSERT INTO `transaction_requests` VALUES(11, 3, 2, -300.00, 2, '2010-10-25 01:24:12', '2010-10-25 01:24:26');
INSERT INTO `transaction_requests` VALUES(10, 2, 3, -200.00, 2, '2010-10-25 01:18:19', '2010-10-25 01:19:32');
INSERT INTO `transaction_requests` VALUES(14, 4, 3, 600.00, 2, '2010-10-25 06:20:18', '2010-10-25 06:20:18');
INSERT INTO `transaction_requests` VALUES(18, 6, 4, -300.00, 2, '2010-10-25 07:37:01', '2010-10-25 07:37:01');
INSERT INTO `transaction_requests` VALUES(17, 3, 4, 444.00, 2, '2010-10-25 07:30:16', '2010-10-25 07:30:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` char(40) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `total_transactions` int(11) NOT NULL DEFAULT '0',
  `total_balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 'admin', 'ca0c6ae5171cd9655949804a8007f2108367eb9b', 'Boss', 1, 0, 0.00, 1, '2010-10-23 16:01:58', '2010-10-25 01:11:05');
INSERT INTO `users` VALUES(2, 'joe', '5e4ea93ac57980d23f989657a003e5d97025dfd4', 'Joe', 2, 2, 100.00, 1, '2010-10-23 16:52:44', '2010-10-25 01:10:41');
INSERT INTO `users` VALUES(3, 'jane', 'a536422b569e5a6f3efcd33e20423f37e92c98e3', 'Jane', 2, 6, -166.00, 1, '2010-10-23 17:07:44', '2010-10-25 01:10:52');
INSERT INTO `users` VALUES(4, 'peter', '3d6e2083702a2695674786fcc9b81cc362ff3860', 'Peter', 2, 5, 366.00, 1, '2010-10-24 16:10:45', '2010-10-25 00:23:05');
INSERT INTO `users` VALUES(5, 'petra', '0f6cee2ddff11de166440fab589fb95a3e0ccaae', 'Petra', 2, 0, 0.00, 1, '2010-10-24 16:11:08', '2010-10-24 16:11:08');
INSERT INTO `users` VALUES(6, 'ann', 'df283d2fb3a76139b91f02887d509cb913c82335', 'Ann', 2, 1, -300.00, 0, '2010-10-24 16:11:31', '2010-10-25 03:18:18');
