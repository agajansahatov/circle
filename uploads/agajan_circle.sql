-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 22, 2018 at 01:44 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agajan_circle`
--

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

DROP TABLE IF EXISTS `chats`;
CREATE TABLE IF NOT EXISTS `chats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user1_id` int(11) DEFAULT NULL,
  `user2_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `user1_id`, `user2_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 10, 1),
(4, 11, 3),
(5, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `errors`
--

DROP TABLE IF EXISTS `errors`;
CREATE TABLE IF NOT EXISTS `errors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `error` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_mobilenumber` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user1_id` int(11) DEFAULT NULL,
  `user2_id` int(11) DEFAULT NULL,
  `user1_accepted` int(11) DEFAULT NULL,
  `user2_accepted` int(11) DEFAULT NULL,
  `time_accepted_1` varchar(50) DEFAULT NULL,
  `time_accepted_2` varchar(50) DEFAULT NULL,
  `user1_block` int(11) DEFAULT NULL,
  `user2_block` int(11) DEFAULT NULL,
  `time_blocked_1` varchar(50) DEFAULT NULL,
  `time_blocked_2` varchar(50) DEFAULT NULL,
  `user1_del` int(11) DEFAULT NULL,
  `user2_del` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user1_id`, `user2_id`, `user1_accepted`, `user2_accepted`, `time_accepted_1`, `time_accepted_2`, `user1_block`, `user2_block`, `time_blocked_1`, `time_blocked_2`, `user1_del`, `user2_del`) VALUES
(1, 1, 2, 1, 1, '16.06.2018', '22.03.2018', 0, 0, 'not set', '26.03.2018', 0, 0),
(2, 1, 3, 1, 1, '22.04.2018', '24.03.2018', 0, 0, 'not set', '24.03.2018', 0, 0),
(11, 1, 6, 1, 1, '28.04.2018', '24.03.2018', 0, 0, 'not set', '24.03.2018', 0, 0),
(4, 4, 1, 1, 1, '22.03.2018', '22.03.2018', 0, 0, 'not set', '22.04.2018', 0, 1),
(29, 3, 2, 1, 1, '24.03.2018', '29.03.2018', 0, 0, '28.03.2018', 'not set', 0, 0),
(70, 10, 1, 1, 1, '08.04.2018', '10.04.2018', 0, 0, 'not set', 'not set', 0, 0),
(69, 8, 1, 1, 1, '08.04.2018', '22.04.2018', 0, 0, 'not set', 'not set', 0, 0),
(10, 7, 1, 1, 1, '24.03.2018', '24.03.2018', 0, 0, 'not set', '29.03.2018', 0, 1),
(22, 3, 14, 1, 0, '24.03.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(23, 3, 9, 1, 0, '24.03.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(24, 3, 10, 1, 1, '24.03.2018', '08.04.2018', 0, 0, 'not set', 'not set', 0, 0),
(30, 3, 11, 1, 1, '24.03.2018', '20.06.2018', 0, 0, 'not set', 'not set', 0, 0),
(31, 3, 6, 1, 1, '24.03.2018', '24.03.2018', 0, 0, 'not set', '28.04.2018', 0, 0),
(32, 6, 2, 1, 1, '24.03.2018', '24.03.2018', 0, 0, 'not set', '26.03.2018', 0, 0),
(33, 6, 9, 1, 0, '24.03.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(34, 6, 10, 1, 1, '24.03.2018', '08.04.2018', 0, 0, 'not set', 'not set', 0, 0),
(35, 6, 11, 1, 1, '24.03.2018', '20.06.2018', 0, 0, 'not set', 'not set', 0, 0),
(36, 6, 8, 1, 1, '24.03.2018', '08.04.2018', 0, 0, 'not set', 'not set', 0, 0),
(37, 6, 14, 1, 0, '24.03.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(38, 6, 4, 1, 0, '24.03.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(39, 6, 7, 1, 0, '24.03.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(67, 2, 20, 1, 0, '29.03.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(52, 2, 9, 1, 0, '26.03.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(53, 2, 11, 1, 1, '26.03.2018', '20.06.2018', 0, 0, 'not set', 'not set', 0, 0),
(54, 2, 10, 1, 0, '26.03.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(56, 2, 8, 1, 0, '26.03.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(59, 21, 1, 1, 1, '28.03.2018', '22.04.2018', 0, 0, 'not set', 'not set', 0, 0),
(60, 21, 2, 1, 1, '28.03.2018', '29.03.2018', 0, 0, 'not set', 'not set', 0, 0),
(61, 21, 8, 1, 0, '28.03.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(62, 21, 14, 1, 0, '28.03.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(63, 21, 9, 1, 0, '28.03.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(64, 21, 10, 1, 0, '28.03.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(65, 21, 11, 1, 0, '28.03.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(66, 2, 4, 1, 0, '29.03.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(75, 1, 9, 1, 0, '22.04.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(71, 2, 7, 1, 0, '11.04.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(72, 1, 11, 1, 1, '12.04.2018', '20.06.2018', 0, 0, 'not set', 'not set', 0, 0),
(73, 22, 1, 1, 0, '22.04.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(74, 22, 2, 1, 0, '22.04.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(77, 1, 25, 1, 0, '11.05.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(76, 1, 14, 1, 0, '22.04.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(78, 10, 9, 1, 0, '17.06.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(79, 10, 11, 1, 0, '17.06.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(80, 10, 25, 1, 0, '17.06.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0),
(81, 10, 14, 1, 0, '17.06.2018', 'not set', 0, 0, 'not set', 'not set', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` text NOT NULL,
  `group_default_image` text NOT NULL,
  `group_status` text NOT NULL,
  `year` varchar(4) DEFAULT NULL,
  `month` varchar(2) DEFAULT NULL,
  `day` varchar(2) DEFAULT NULL,
  `day_name` varchar(30) DEFAULT NULL,
  `hour` varchar(2) DEFAULT NULL,
  `minute` varchar(2) DEFAULT NULL,
  `second` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `group_messages`
--

DROP TABLE IF EXISTS `group_messages`;
CREATE TABLE IF NOT EXISTS `group_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `readn` int(11) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  `month` varchar(2) DEFAULT NULL,
  `day` varchar(2) DEFAULT NULL,
  `day_name` varchar(30) DEFAULT NULL,
  `hour` varchar(2) DEFAULT NULL,
  `minute` varchar(2) DEFAULT NULL,
  `second` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `group_users`
--

DROP TABLE IF EXISTS `group_users`;
CREATE TABLE IF NOT EXISTS `group_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  `month` varchar(2) DEFAULT NULL,
  `day` varchar(2) DEFAULT NULL,
  `day_name` varchar(30) DEFAULT NULL,
  `hour` varchar(2) DEFAULT NULL,
  `minute` varchar(2) DEFAULT NULL,
  `second` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `chat_id` int(11) DEFAULT NULL,
  `user2_readn` int(11) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  `month` varchar(2) DEFAULT NULL,
  `day` varchar(2) DEFAULT NULL,
  `day_name` varchar(30) DEFAULT NULL,
  `hour` varchar(2) DEFAULT NULL,
  `minute` varchar(2) DEFAULT NULL,
  `second` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `user_id`, `chat_id`, `user2_readn`, `year`, `month`, `day`, `day_name`, `hour`, `minute`, `second`) VALUES
(1, 'Salam', 1, 1, 0, '2018', '06', '17', 'Sun', '17', '43', '56'),
(2, 'Goumy?', 1, 1, 0, '2018', '06', '17', 'Sun', '17', '45', '42'),
(3, 'Onatmy?', 1, 1, 0, '2018', '06', '17', 'Sun', '17', '49', '08'),
(4, 'Onatmy? Onatmy? Onatmy? Onatmy? Onatmy? Onatmy? Onatmy? Onatmy?', 1, 1, 0, '2018', '06', '17', 'Sun', '18', '17', '35'),
(5, '123', 1, 1, 0, '2018', '06', '17', 'Sun', '18', '30', '54'),
(6, 'aaa', 1, 1, 0, '2018', '06', '17', 'Sun', '18', '32', '23'),
(7, 'Hello', 1, 1, 0, '2018', '06', '17', 'Sun', '18', '42', '13'),
(8, 'Hello', 1, 1, 0, '2018', '06', '17', 'Sun', '18', '42', '58'),
(9, 'Hi', 1, 1, 0, '2018', '06', '17', 'Sun', '18', '44', '05'),
(10, '.', 1, 1, 0, '2018', '06', '17', 'Sun', '18', '44', '54'),
(11, 'Hi', 1, 1, 0, '2018', '06', '17', 'Sun', '18', '45', '59'),
(12, 'Hel;lo', 1, 1, 0, '2018', '06', '17', 'Sun', '18', '46', '10'),
(13, 'Hi', 1, 2, 1, '2018', '06', '17', 'Sun', '18', '46', '32'),
(14, 'Hi', 2, 1, 1, '2018', '06', '17', 'Sun', '18', '47', '49'),
(15, 'I am fine', 2, 1, 1, '2018', '06', '17', 'Sun', '18', '47', '57'),
(16, 'And you?', 2, 1, 1, '2018', '06', '17', 'Sun', '18', '48', '06'),
(17, 'How are you?', 1, 2, 1, '2018', '06', '17', 'Sun', '19', '11', '18'),
(18, '?', 1, 2, 1, '2018', '06', '17', 'Sun', '19', '12', '37'),
(19, '.', 1, 2, 1, '2018', '06', '17', 'Sun', '19', '13', '17'),
(20, 'Hi', 1, 2, 1, '2018', '06', '17', 'Sun', '19', '16', '04'),
(21, 'Hi, Elena', 10, 3, 1, '2018', '06', '20', 'Wed', '15', '23', '27'),
(22, 'How are you?', 10, 3, 1, '2018', '06', '20', 'Wed', '15', '23', '36'),
(23, 'Hi', 1, 3, 1, '2018', '06', '20', 'Wed', '15', '27', '09'),
(24, 'Hi', 1, 3, 1, '2018', '06', '20', 'Wed', '15', '28', '52'),
(25, 'I am fine and you?', 1, 3, 1, '2018', '06', '20', 'Wed', '15', '30', '04'),
(26, 'I am fine too', 1, 1, 0, '2018', '06', '20', 'Wed', '15', '31', '46'),
(27, 'Hi, Elena', 3, 2, 0, '2018', '06', '20', 'Wed', '15', '38', '59'),
(28, 'I am fine and you?', 3, 2, 0, '2018', '06', '20', 'Wed', '15', '39', '05'),
(29, 'Heeeey', 1, 3, 0, '2018', '06', '20', 'Wed', '19', '59', '01'),
(30, 'Heeeey', 1, 3, 0, '2018', '06', '20', 'Wed', '20', '00', '51'),
(31, 'Hi Agajan', 11, 4, 0, '2018', '06', '20', 'Wed', '20', '57', '17'),
(32, 'Hi Agajan', 11, 4, 0, '2018', '06', '20', 'Wed', '20', '57', '52'),
(33, 'Hi Elena', 11, 5, 0, '2018', '06', '20', 'Wed', '20', '58', '15'),
(34, 'How are you?', 11, 5, 0, '2018', '06', '20', 'Wed', '20', '58', '22'),
(35, 'Did you recognise me', 11, 5, 0, '2018', '06', '20', 'Wed', '20', '58', '32'),
(36, 'I am Stefan', 11, 5, 0, '2018', '06', '20', 'Wed', '20', '58', '38'),
(37, 'Heey', 3, 2, 0, '2018', '06', '21', 'Thu', '15', '21', '49'),
(38, 'Where did you go?', 3, 2, 0, '2018', '06', '21', 'Thu', '15', '21', '59'),
(39, '?', 3, 2, 0, '2018', '06', '21', 'Thu', '18', '45', '00'),
(40, 'Hi', 1, 1, 0, '2018', '06', '21', 'Thu', '18', '48', '10');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `app_language` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `user_id`, `app_language`) VALUES
(1, 1, 'english'),
(2, 2, 'english'),
(3, 3, 'english'),
(4, 4, 'english'),
(5, 5, 'english'),
(6, 6, 'english'),
(7, 7, 'english'),
(8, 8, 'english'),
(9, 9, 'english'),
(10, 10, 'english'),
(11, 11, 'english'),
(12, 12, 'english'),
(13, 13, 'english'),
(14, 14, 'english'),
(15, 15, 'english'),
(16, 16, 'english'),
(17, 17, 'english'),
(18, 18, 'english'),
(19, 19, 'english'),
(20, 20, 'english'),
(21, 21, 'english'),
(22, 22, 'türkmençe'),
(23, 23, 'english'),
(24, 24, 'english'),
(25, 25, 'english');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `birthday` varchar(100) NOT NULL,
  `birthmonth` varchar(100) NOT NULL,
  `birthyear` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `default_image` varchar(300) NOT NULL,
  `country` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `street_village` varchar(100) NOT NULL,
  `mobilenumber` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` text NOT NULL,
  `profession` varchar(200) NOT NULL,
  `education_place` varchar(200) NOT NULL,
  `languages` text NOT NULL,
  `hobby` text NOT NULL,
  `work_place` text NOT NULL,
  `registration_date` varchar(100) NOT NULL,
  `online` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `birthday`, `birthmonth`, `birthyear`, `gender`, `default_image`, `country`, `region`, `city`, `street_village`, `mobilenumber`, `email`, `password`, `status`, `profession`, `education_place`, `languages`, `hobby`, `work_place`, `registration_date`, `online`) VALUES
(1, 'Elena', 'Gilbert', '05', '04', '1998', 'Female', 'user_1_2018_21.jpg', 'Great Britain', 'England', 'London', 'not set', '+99363123456', 'ElenaGilbert@mail.com', '1234', 'Web Desing is an art', 'Web Designer', 'Cambridge university', 'English, Russian', 'Reading', 'Google\'s Office', '22.03.2018', 'not set'),
(2, 'Elena', 'Salvatore', 'not set', 'not set', 'not set', 'not set', 'user11.jpg', 'not set', 'not set', 'not set', 'not set', 'not set', 'ElenaSalvatore@mail.com', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '22.03.2018', 'not set'),
(3, 'Agajan', 'Sahatow', 'not set', 'not set', 'not set', 'not set', 'file645.jpg', 'not set', 'not set', 'not set', 'not set', 'not set', 'AgajanSahatow@mail.com', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '22.03.2018', 'not set'),
(4, 'Christian', 'Ronaldo', 'not set', 'not set', 'not set', 'not set', 'user12.jpg', 'not set', 'not set', 'not set', 'not set', 'not set', 'ChristianRonaldo@mail.com', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '22.03.2018', 'not set'),
(6, 'Oguljemal', 'Baýramgeldiýewa', 'not set', 'not set', 'not set', 'not set', 'user9.jpg', 'not set', 'not set', 'not set', 'not set', 'not set', 'OguljemalBayramgeldiyewa@mail.com', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '22.03.2018', 'not set'),
(7, 'Messi', 'Lionel', 'not set', 'not set', 'not set', 'not set', 'user8.jpg', 'not set', 'not set', 'not set', 'not set', 'not set', 'LionelMessi@mail.com', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '22.03.2018', 'not set'),
(8, 'Jeremy', 'Gilbert', 'not set', 'not set', 'not set', 'not set', 'user5.jpg', 'not set', 'not set', 'not set', 'not set', 'not set', 'JeremyGilbert@mail.com', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '22.03.2018', 'not set'),
(9, 'Jeremy', 'Salvatore', 'not set', 'not set', 'not set', 'not set', 'user6.jpg', 'not set', 'not set', 'not set', 'not set', 'not set', 'JeremySalvatore@mail.com', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '22.03.2018', 'not set'),
(10, 'Damon', 'Salvatore', 'not set', 'not set', 'not set', 'not set', 'user_10_2018_1.jpg', 'not set', 'not set', 'not set', 'not set', 'not set', 'DamonSalvatore@mail.com', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '22.03.2018', 'not set'),
(11, 'Stefan', 'Salvatore', 'not set', 'not set', 'not set', 'not set', 'user_11_2018_1.jpg', 'not set', 'not set', 'not set', 'not set', 'not set', 'StefanSalvatore@mail.com', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '22.03.2018', 'not set'),
(12, 'Bebe', 'Rexha', 'not set', 'not set', 'not set', 'not set', 'user10.jpg', 'not set', 'not set', 'not set', 'not set', 'not set', 'BebeRexha@mail.com', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '22.03.2018', 'not set'),
(13, 'Diana', 'Doe', 'not set', 'not set', 'not set', 'not set', 'user2.jpg', 'not set', 'not set', 'not set', 'not set', 'not set', 'DianaDoe@mail.com', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '22.03.2018', 'not set'),
(14, 'Caroline', 'Gilbert', 'not set', 'not set', 'not set', 'not set', 'user1.jpg', 'not set', 'not set', 'not set', 'not set', 'not set', 'CarolineGilbert@mail.com', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '22.03.2018', 'not set'),
(15, 'Merdanov', 'Kuvvat', 'not set', 'not set', 'not set', 'not set', 'no_image.png', 'not set', 'not set', 'not set', 'not set', 'not set', 'MerdanovKuvvat@mail.com', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '28.03.2018', 'not set'),
(16, 'Merdanow', 'Kuwwat', 'not set', 'not set', 'not set', 'not set', 'no_image.png', 'not set', 'not set', 'not set', 'not set', 'not set', 'MerdanowKuwwat@mail.com', 'a12345', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '28.03.2018', 'not set'),
(17, 'Merdanow', 'Kuwwat', 'not set', 'not set', 'not set', 'not set', 'no_image.png', 'not set', 'not set', 'not set', 'not set', 'not set', 'BurkazGuustanow@mail.com', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '28.03.2018', 'not set'),
(18, 'Merdanow', 'Kuwwat', 'not set', 'not set', 'not set', 'not set', 'no_image.png', 'not set', 'not set', 'not set', 'not set', 'not set', 'BurkazGulustanow@mail.com', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '28.03.2018', 'not set'),
(19, 'Wepa', 'Babaýew', 'not set', 'not set', 'not set', 'not set', 'no_image.png', 'not set', 'not set', 'not set', 'not set', 'not set', 'WepaBabayew@mail.com', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '28.03.2018', 'not set'),
(20, 'Жанна', 'Фриске', 'not set', 'not set', 'not set', 'not set', 'no_image.png', 'not set', 'not set', 'not set', 'not set', 'not set', 'DjannaFriske@mail.ru', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '28.03.2018', 'not set'),
(21, 'Ани', 'Лорак', 'not set', 'not set', 'not set', 'not set', 'no_image.png', 'not set', 'not set', 'not set', 'not set', 'not set', 'AniLorak@mail.ru', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '28.03.2018', 'not set'),
(22, 'merdan', 'garahanow', 'not set', 'not set', 'not set', 'not set', 'no_image.png', 'not set', 'not set', 'not set', 'not set', '+37525422112', 'not set', 'acyl', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '22.04.2018', 'not set'),
(23, 'Serdar', 'Annagulyýew', 'not set', 'not set', 'not set', 'not set', 'no_image.png', 'not set', 'not set', 'not set', 'not set', 'not set', 'Serdar@mail.com', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '27.04.2018', 'not set'),
(24, 'Alarick', 'James', 'not set', 'not set', 'not set', 'not set', 'no_image.png', 'not set', 'not set', 'not set', 'not set', 'not set', 'Alaric@mail.com', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '11.05.2018', 'not set'),
(25, 'Damon', 'Gilbert', 'not set', 'not set', 'not set', 'not set', 'no_image.png', 'not set', 'not set', 'not set', 'not set', 'not set', 'DamonGilbert@mail.com', '1234', 'not set', 'not set', 'not set', 'not set', 'not set', 'not set', '11.05.2018', 'not set');

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

DROP TABLE IF EXISTS `user_images`;
CREATE TABLE IF NOT EXISTS `user_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `folder` text NOT NULL,
  `description` text,
  `year` varchar(4) NOT NULL,
  `month` varchar(2) NOT NULL,
  `day` varchar(2) NOT NULL,
  `day_name` varchar(30) NOT NULL,
  `hour` varchar(2) NOT NULL,
  `minute` varchar(2) NOT NULL,
  `second` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_images`
--

INSERT INTO `user_images` (`id`, `user_id`, `image`, `folder`, `description`, `year`, `month`, `day`, `day_name`, `hour`, `minute`, `second`) VALUES
(1, 1, 'user0.jpg', 'not set', 'Web design is an art', '2017', '06', '01', '', '20', '01', '00'),
(6, 8, 'user5.jpg', 'not set', 'not set', '2018', '02', '06', '', '13', '06', '05'),
(7, 3, 'file645.jpg', 'not set', 'not set', '2018', '02', '07', '', '21', '07', '06'),
(8, 2, 'user11.jpg', 'not set', 'not set', '2018', '02', '08', '', '20', '08', '07'),
(110, 3, 'user_3_2018_1.jpg', 'not set', 'not set', '2018', '06', '21', 'Thu', '18', '41', '48'),
(63, 1, 'user_1_2018_15.jpg', 'not set', 'not set', '2018', '06', '07', 'Thu', '15', '46', '31'),
(29, 1, 'user_1_12.jpg', 'not set', 'not set', '2018', '04', '19', '', '21', '19', '18'),
(27, 1, 'user_1_10.jpg', 'not set', 'Heart', '2018', '04', '20', '', '20', '20', '19'),
(28, 1, 'user_1_11.jpg', 'not set', 'not set', '2018', '04', '21', '', '14', '21', '20'),
(34, 1, 'user_1_17.jpg', 'not set', 'Me and you', '2018', '04', '22', '', '15', '22', '21'),
(35, 1, 'user_1_18.jpg', 'not set', 'not set', '2018', '04', '23', '', '16', '23', '22'),
(36, 22, 'user_22_1.jpg', 'not set', 'not set', '2018', '04', '24', '', '17', '24', '23'),
(38, 1, 'user_1_20.jpg', 'not set', 'not set', '2018', '05', '26', 'Sat', '19', '26', '25'),
(39, 1, 'user_1_21.jpg', 'not set', 'not set', '2018', '05', '27', 'Sun', '20', '27', '26'),
(40, 6, 'user_6_1.jpg', 'not set', 'not set', '2018', '05', '28', 'Mon', '14', '28', '27'),
(41, 1, 'user_1_22.jpg', 'not set', 'Beautiful sky', '2018', '05', '28', 'Mon', '14', '29', '28'),
(60, 1, 'user_1_2018_12.jpg', 'not set', 'not set', '2018', '06', '07', 'Thu', '15', '45', '54'),
(46, 1, 'user_1_27.jpg', 'not set', 'not set', '2018', '05', '29', 'Tue', '17', '18', '28'),
(52, 1, 'user_1_2018_5.jpg', 'not set', 'not set', '2018', '06', '04', 'Mon', '08', '57', '45'),
(62, 1, 'user_1_2018_14.png', 'not set', 'Learn to draw eyes', '2018', '06', '07', 'Thu', '15', '46', '17'),
(68, 1, 'user_1_2018_20.png', 'not set', 'Globus\\', '2018', '06', '07', 'Thu', '15', '47', '15'),
(64, 1, 'user_1_2018_16.jpg', 'not set', 'not set', '2018', '06', '07', 'Thu', '15', '46', '48'),
(48, 1, 'user_1_2018_1.jpg', 'not set', 'not set', '2018', '06', '03', 'Sun', '17', '48', '57'),
(58, 10, 'user_10_2018_1.jpg', 'not set', 'I like this kind of city', '2018', '06', '06', 'Wed', '21', '18', '18'),
(65, 1, 'user_1_2018_17.jpg', 'not set', 'not set', '2018', '06', '07', 'Thu', '15', '46', '55'),
(69, 1, 'user_1_2018_21.jpg', 'not set', 'Technology', '2018', '06', '09', 'Sat', '13', '35', '14'),
(70, 1, 'user_1_2018_22.jpg', 'not set', 'not set', '2018', '06', '09', 'Sat', '13', '35', '48'),
(71, 1, 'user_1_2018_23.jpg', 'not set', 'Kind of home', '2018', '06', '09', 'Sat', '13', '36', '47'),
(72, 2, 'user_2_2018_1.jpg', 'not set', 'not set', '2018', '06', '17', 'Sun', '08', '52', '41'),
(103, 11, 'user_11_2018_2.jpg', 'not set', 'not set', '2018', '06', '21', 'Thu', '18', '28', '25'),
(102, 11, 'user_11_2018_1.jpg', 'not set', 'not set', '2018', '06', '21', 'Thu', '18', '28', '05'),
(77, 1, 'user_1_2018_24.jpg', 'not set', 'not set', '2018', '06', '20', 'Wed', '21', '00', '08'),
(78, 1, 'user_1_2018_25.jpg', 'not set', 'not set', '2018', '06', '20', 'Wed', '21', '00', '18'),
(112, 3, 'user_3_2018_3.jpg', 'not set', 'not set', '2018', '06', '21', 'Thu', '18', '42', '10'),
(113, 3, 'user_3_2018_4.jpg', 'not set', 'not set', '2018', '06', '21', 'Thu', '18', '42', '30'),
(114, 3, 'user_3_2018_5.jpg', 'not set', 'not set', '2018', '06', '21', 'Thu', '18', '42', '37'),
(115, 3, 'user_3_2018_6.jpg', 'not set', 'not set', '2018', '06', '21', 'Thu', '18', '42', '41'),
(116, 3, 'user_3_2018_7.jpg', 'not set', 'not set', '2018', '06', '21', 'Thu', '18', '42', '46'),
(109, 11, 'user_11_2018_8.jpg', 'not set', 'not set', '2018', '06', '21', 'Thu', '18', '29', '03'),
(108, 11, 'user_11_2018_7.jpg', 'not set', 'not set', '2018', '06', '21', 'Thu', '18', '28', '54'),
(107, 11, 'user_11_2018_6.jpg', 'not set', 'not set', '2018', '06', '21', 'Thu', '18', '28', '48'),
(104, 11, 'user_11_2018_3.jpg', 'not set', 'not set', '2018', '06', '21', 'Thu', '18', '28', '30'),
(105, 11, 'user_11_2018_4.jpg', 'not set', 'not set', '2018', '06', '21', 'Thu', '18', '28', '38'),
(106, 11, 'user_11_2018_5.jpg', 'not set', 'not set', '2018', '06', '21', 'Thu', '18', '28', '43');

-- --------------------------------------------------------

--
-- Table structure for table `user_images_sum`
--

DROP TABLE IF EXISTS `user_images_sum`;
CREATE TABLE IF NOT EXISTS `user_images_sum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  `images_sum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_images_sum`
--

INSERT INTO `user_images_sum` (`id`, `user_id`, `year`, `images_sum`) VALUES
(1, 1, '2018', 25),
(2, 10, '2018', 1),
(3, 2, '2018', 1),
(5, 11, '2018', 8),
(6, 3, '2018', 7);

-- --------------------------------------------------------

--
-- Table structure for table `user_image_comments`
--

DROP TABLE IF EXISTS `user_image_comments`;
CREATE TABLE IF NOT EXISTS `user_image_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `folder` text NOT NULL,
  `comment` text NOT NULL,
  `commented_user_id` int(11) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  `month` varchar(2) DEFAULT NULL,
  `day` varchar(2) DEFAULT NULL,
  `day_name` varchar(30) DEFAULT NULL,
  `hour` varchar(2) DEFAULT NULL,
  `minute` varchar(2) DEFAULT NULL,
  `second` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_image_comments`
--

INSERT INTO `user_image_comments` (`id`, `user_id`, `image`, `folder`, `comment`, `commented_user_id`, `year`, `month`, `day`, `day_name`, `hour`, `minute`, `second`) VALUES
(30, 1, 'user0.jpg', 'not set', '...', 1, '2018', '06', '04', 'Mon', '21', '15', '52'),
(29, 1, 'user_1_17.jpg', 'not set', '...', 1, '2018', '06', '04', 'Mon', '21', '13', '17'),
(27, 1, 'user_1_17.jpg', 'not set', 'Yes', 1, '2018', '06', '04', 'Mon', '21', '13', '03'),
(28, 1, 'user_1_17.jpg', 'not set', 'Yes, it has worked', 1, '2018', '06', '04', 'Mon', '21', '13', '07'),
(24, 1, 'user0.jpg', 'not set', '.', 1, '2018', '06', '04', 'Mon', '21', '11', '41'),
(26, 1, 'user_1_17.jpg', 'not set', 'A family?', 1, '2018', '06', '04', 'Mon', '21', '13', '00'),
(7, 1, 'user0.jpg', 'not set', 'Cool!', 1, '2018', '05', '27', 'Sun', '21', '04', '28'),
(8, 1, 'user0.jpg', 'not set', 'Yes, it is Wonderful!', 1, '2018', '05', '27', 'Sun', '21', '04', '44'),
(9, 1, 'user0.jpg', 'not set', 'Web design is an art', 1, '2018', '05', '27', 'Sun', '21', '04', '56'),
(25, 1, 'user0.jpg', 'not set', 'Yes, it has worked', 1, '2018', '06', '04', 'Mon', '21', '11', '50'),
(22, 1, 'user_1_22.jpg', 'not set', 'Hahhhaaaa', 1, '2018', '06', '04', 'Mon', '09', '19', '11'),
(23, 1, 'user_1_18.jpg', 'not set', 'Sweet baby...', 1, '2018', '06', '04', 'Mon', '20', '56', '48'),
(14, 1, 'user0.jpg', 'not set', 'Wow', 1, '2018', '05', '30', 'Wed', '16', '23', '59'),
(31, 1, 'user0.jpg', 'not set', 'Wow', 1, '2018', '06', '04', 'Mon', '21', '17', '22'),
(32, 1, 'user0.jpg', 'not set', 'Yes, it working', 1, '2018', '06', '04', 'Mon', '21', '17', '32'),
(33, 1, 'user0.jpg', 'not set', 'fg', 1, '2018', '06', '04', 'Mon', '21', '17', '42'),
(34, 1, 'user0.jpg', 'not set', 'Beautiful girl', 1, '2018', '06', '04', 'Mon', '21', '17', '58'),
(35, 1, 'user_1_17.jpg', 'not set', 'A family? Yes, and walking in the green planet is powerful.', 1, '2018', '06', '04', 'Mon', '21', '18', '53'),
(36, 1, 'user_1_17.jpg', 'not set', 'Very beautiful', 1, '2018', '06', '06', 'Wed', '15', '06', '36'),
(37, 1, 'file645.jpg', 'not set', 'Hello', 3, '2018', '06', '06', 'Wed', '21', '01', '20'),
(38, 1, 'user5.jpg', 'not set', 'Hello', 8, '2018', '06', '06', 'Wed', '21', '06', '39'),
(39, 1, 'user_1_17.jpg', 'not set', 'Hello', 1, '2018', '06', '06', 'Wed', '21', '08', '03'),
(40, 1, 'file645.jpg', 'not set', 'Hello', 3, '2018', '06', '06', 'Wed', '21', '08', '21'),
(41, 1, 'file645.jpg', 'not set', 'lll', 3, '2018', '06', '06', 'Wed', '21', '09', '47'),
(42, 1, 'user_1_18.jpg', 'not set', 'Hello', 1, '2018', '06', '06', 'Wed', '21', '10', '53'),
(43, 3, 'file645.jpg', 'not set', 'Hello', 1, '2018', '06', '06', 'Wed', '21', '12', '17'),
(44, 8, 'user5.jpg', 'not set', 'Hi', 1, '2018', '06', '06', 'Wed', '21', '12', '38'),
(45, 1, 'user_1_17.jpg', 'not set', 'Hello. I am Damon', 10, '2018', '06', '06', 'Wed', '21', '16', '56'),
(46, 1, 'user_1_17.jpg', 'not set', 'Elena, how are you?', 10, '2018', '06', '06', 'Wed', '21', '17', '18'),
(47, 3, 'file645.jpg', 'not set', 'Hello', 10, '2018', '06', '06', 'Wed', '21', '17', '40'),
(48, 3, 'file645.jpg', 'not set', 'Hello. I am Damon', 10, '2018', '06', '06', 'Wed', '21', '17', '45'),
(49, 3, 'file645.jpg', 'not set', 'How are you?', 10, '2018', '06', '06', 'Wed', '21', '17', '53'),
(50, 10, 'user_10_2018_1.jpg', 'not set', 'Hello everybody', 10, '2018', '06', '06', 'Wed', '21', '18', '59'),
(51, 10, 'user_10_2018_1.jpg', 'not set', 'Hi, Damon. How are you?', 1, '2018', '06', '06', 'Wed', '21', '20', '11'),
(52, 2, 'user11.jpg', 'not set', 'Hi, Salvatore', 1, '2018', '06', '06', 'Wed', '21', '21', '41'),
(53, 1, 'user_1_2018_20.png', 'not set', 'Globus', 1, '2018', '06', '08', 'Fri', '10', '42', '18'),
(54, 1, 'user_1_2018_14.png', 'not set', 'Learn to draw eyes', 1, '2018', '06', '08', 'Fri', '10', '43', '02'),
(55, 1, 'user_1_2018_23.jpg', 'not set', 'Yeah', 1, '2018', '06', '09', 'Sat', '13', '42', '16'),
(56, 1, 'user_1_2018_23.jpg', 'not set', 'OMG', 1, '2018', '06', '09', 'Sat', '13', '42', '32'),
(57, 1, 'user_1_2018_21.jpg', 'not set', 'Technology', 1, '2018', '06', '15', 'Fri', '15', '45', '32'),
(58, 1, 'user_1_2018_21.jpg', 'not set', 'Hi!', 1, '2018', '06', '15', 'Fri', '15', '45', '38'),
(59, 1, 'user_1_2018_21.jpg', 'not set', 'Hi, Elena', 11, '2018', '06', '21', 'Thu', '18', '38', '21'),
(60, 1, 'user_1_2018_21.jpg', 'not set', 'How are you?', 11, '2018', '06', '21', 'Thu', '18', '38', '32'),
(61, 3, 'file645.jpg', 'not set', 'Hi', 3, '2018', '06', '21', 'Thu', '18', '40', '50'),
(62, 3, 'file645.jpg', 'not set', 'I am fine', 3, '2018', '06', '21', 'Thu', '18', '40', '56'),
(63, 3, 'file645.jpg', 'not set', 'And you?', 3, '2018', '06', '21', 'Thu', '18', '41', '01'),
(64, 10, 'user_10_2018_1.jpg', 'not set', 'Hi, Damon. How are you?', 3, '2018', '06', '21', 'Thu', '18', '43', '39'),
(65, 2, 'user11.jpg', 'not set', 'Hi Elena', 3, '2018', '06', '21', 'Thu', '18', '44', '00'),
(66, 11, 'user_11_2018_1.jpg', 'not set', 'Stefan, is this you?', 3, '2018', '06', '21', 'Thu', '18', '44', '21');

-- --------------------------------------------------------

--
-- Table structure for table `user_image_likes`
--

DROP TABLE IF EXISTS `user_image_likes`;
CREATE TABLE IF NOT EXISTS `user_image_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `liked_user_id` int(11) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  `month` varchar(2) DEFAULT NULL,
  `day` varchar(2) DEFAULT NULL,
  `day_name` varchar(30) DEFAULT NULL,
  `hour` varchar(2) DEFAULT NULL,
  `minute` varchar(2) DEFAULT NULL,
  `second` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
