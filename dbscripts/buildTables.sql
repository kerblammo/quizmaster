-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 27, 2018 at 08:33 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizmaster`
--

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`Id`, `Name`) VALUES
(1, 'Super'),
(2, 'Admin'),
(3, 'User'),
(4, 'Guest');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questiontext` varchar(1024) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `choices` varchar(1024) NOT NULL,
  `answer` varchar(1024) NOT NULL,
  `tags` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `AuthorId` int(11) NOT NULL,
  `Title` varchar(128) NOT NULL,
  `Description` varchar(1024) NOT NULL,
  `Tags` varchar(1024) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_quiz_users_id` (`AuthorId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`Id`, `AuthorId`, `Title`, `Description`, `Tags`) VALUES
(2, 1, 'Never Gonna Give You Up', 'From dreams to memes', '80\'s, pop culture, music');

-- --------------------------------------------------------

--
-- Table structure for table `quizquestion`
--

DROP TABLE IF EXISTS `quizquestion`;
CREATE TABLE IF NOT EXISTS `quizquestion` (
  `QuizId` int(11) NOT NULL,
  `QuestionId` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`QuizId`,`QuestionId`),
  KEY `QuestionId` (`QuestionId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quizresult`
--

DROP TABLE IF EXISTS `quizresult`;
CREATE TABLE IF NOT EXISTS `quizresult` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `QuizId` int(11) NOT NULL,
  `StartTime` datetime NOT NULL,
  `EndTime` datetime NOT NULL,
  `Answers` varchar(1024) NOT NULL,
  `Score` decimal(10,2) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `QuizId` (`QuizId`),
  KEY `UserId` (`UserId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `PermissionId` int(11) NOT NULL,
  `Username` varchar(64) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `Deactivated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Username` (`Username`),
  KEY `fk_users_permission_id` (`PermissionId`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `PermissionId`, `Username`, `Password`, `Deactivated`) VALUES
(1, 1, 'PeterAdam', 'quizzmaster', 0),
(16, 2, 'foo', 'bar', 0),
(15, 2, 'steveinator', 'clothesbootsmotorcycle', 0),
(20, 2, 'bigjim', 'liljim', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
