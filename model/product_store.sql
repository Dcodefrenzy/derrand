-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2017 at 09:06 AM
-- Server version: 5.5.55-0ubuntu0.14.04.1
-- PHP Version: 7.0.21-1~ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `online_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hash` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `email`, `hash`) VALUES
(1, 'banji', 'olubanji', 'banjimayowa02@gmail.com', '$2y$10$.grMNkVzzdel5Swazxv6TuHOXSoUSwR.BfeibQDrbFbjb7etrqZnC'),
(2, 'bah', 'bab', 'banjimayowa02@g,ail..com', '$2y$10$bk3BnSAEsNXwSiT2Ih0YHeOLT/IKaZj6l9Q4R6ewb9aAxyXnqN0tm'),
(3, 'Mayowa', 'Banji', 'banjimayowa@gmail.com', '$2y$10$esHejN/5QWiXW1XhhuVyPu5LVTmEslni1PEXDhwR7lVIMjn8mnxBK'),
(4, 'banji', 'mayowa', 'banjimayowa3@gmail.com', '$2y$10$iZr2RizwxeQnGxh9ViE2xOSgWJ3O7FmlzZSfDcmKOEwjRT3XlIROG');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `maker` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `sub_category` varchar(255) NOT NULL,
  `availability` int(10) NOT NULL,
  `promo_status` int(10) NOT NULL,
  `price` varchar(255) NOT NULL,
  `old_price` varchar(255) NULL,
  `hash_id` varchar(255) NOT NULL,
  `year` char(4) NOT NULL,
  `file_path` varchar(200) NOT NULL,
  `flag` varchar(100) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `book`
--


-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL,
  `hash_id` varchar(255) NOT NULL,
  `user_id` char(32) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cart`
--



-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(255)NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `category`
--



-- --------------------------------------------------------


--
-- Table structure for table `sub_category`
--

CREATE TABLE IF NOT EXISTS `sub_category` (
  `sub_category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` varchar(50) NOT NULL,
  `sub_category_name` varchar(50) NOT NULL,
  `hash_id` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`sub_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `category`
--



-- --------------------------------------------------------

--
-- Table structure for table `recently_viewed`
--

CREATE TABLE IF NOT EXISTS `recently_viewed` (
  `view_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `hash_id` varchar(255) NOT NULL,
  `user_id` char(32) NOT NULL,
  PRIMARY KEY (`view_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `recently_viewed`
--



-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `hash_id` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--



-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hash` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users`
--



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
