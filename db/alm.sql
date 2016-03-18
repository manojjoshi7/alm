-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2016 at 08:16 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `alm`
--
CREATE DATABASE IF NOT EXISTS `alm` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `alm`;

-- --------------------------------------------------------

--
-- Table structure for table `boutique_info`
--

CREATE TABLE IF NOT EXISTS `boutique_info` (
  `boutique_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `email_address` varchar(500) NOT NULL,
  `phone_numeber` varchar(50) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`boutique_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `boutique_info`
--

INSERT INTO `boutique_info` (`boutique_id`, `name`, `sex`, `email_address`, `phone_numeber`, `address`) VALUES
(1, 'deepash ', 'Female', 'deepash@gmail.com', '897654321906', 'dhsgdsdghsdghsd');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `descreption` text NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `name`, `descreption`) VALUES
(1, 'dummy', 'this is dummy.....'),
(2, 'dummy two', 'tesrtibgfvc');

-- --------------------------------------------------------

--
-- Table structure for table `design_images`
--

CREATE TABLE IF NOT EXISTS `design_images` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `design_id` int(11) NOT NULL,
  `img_name` varchar(200) NOT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `design_images`
--

INSERT INTO `design_images` (`img_id`, `design_id`, `img_name`) VALUES
(3, 1, 'image1.jpg'),
(4, 1, 'image2.jpg'),
(5, 1, 'image4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `our_design`
--

CREATE TABLE IF NOT EXISTS `our_design` (
  `design_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `design_info` text NOT NULL,
  `images_name` varchar(1000) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `size` varchar(200) NOT NULL,
  PRIMARY KEY (`design_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `our_design`
--

INSERT INTO `our_design` (`design_id`, `cat_id`, `name`, `design_info`, `images_name`, `price`, `size`) VALUES
(1, 1, 'design one', ' dummy test dummy test dummy test dummy test dummy test dummy test dummy test dummy test dummy test dummy test', 'image3.jpg', '123.78', '');

-- --------------------------------------------------------

--
-- Table structure for table `task_for_employ`
--

CREATE TABLE IF NOT EXISTS `task_for_employ` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `task_status` enum('pending','done') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `task_message`
--

CREATE TABLE IF NOT EXISTS `task_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `receive_message` text NOT NULL,
  `send_message` text NOT NULL,
  `message_sand_date` date NOT NULL,
  `message_receive_date` date NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE IF NOT EXISTS `user_login` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(1000) NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `password` text NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email_id` varchar(1000) NOT NULL,
  `user_type` enum('admin','customer','employ') NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`user_id`, `user_name`, `sex`, `password`, `phone_number`, `address`, `email_id`, `user_type`, `active`) VALUES
(1, 'manoj joshi', 'Male', '12345678', '9876543218', 'Mani mazra near IT park chandigarh', 'manojjoshi574@yahoo.in', 'admin', 1),
(2, 'shdsjhdshjd', 'Male', 'admin@123', '1234578908', 'sdsdsdjshjdhjsd', 'gfh@we.com', 'customer', 0),
(3, 'dummy123', 'Male', '12345678', '1234567987', 'vhhghghghgg', 'dummy@w.com', 'employ', 1),
(5, 'new employee', 'Female', '1234567890', '777777777777', 'dfdfdfdfdf', 'manoj@gmail.com', 'employ', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
