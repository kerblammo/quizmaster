-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 28, 2018 at 03:09 PM
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
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `QuestionText` varchar(1024) NOT NULL,
  `Description` varchar(1024) NOT NULL,
  `Choices` varchar(1024) NOT NULL,
  `Answer` varchar(1024) NOT NULL,
  `Tags` varchar(1024) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`Id`, `QuestionText`, `Description`, `Choices`, `Answer`, `Tags`) VALUES
(1, 'What is love?', 'Popular 80\'s ballad', 'Baby don\'t hurt me,Don\'t hurt me,No more', 'Baby don\'t hurt me', '80\'s,music,pop culture'),
(2, 'What is the airspeed velocity of an unladen swallow?', 'Utter nonsense', 'African or European,Lovely bunch of coconuts,Spam', 'African or European', 'Monty Python,comedy,movies'),
(3, 'What was the name of the Ethiopian Wolf before they knew it was related to wolves?', 'Scientific name of an animal question', 'Simien Jackel,Ethiopian Coyote,Amharic Fox,Canis Simiensis', 'Simien Jackel', 'scientific,animal'),
(4, 'What is the scientific name of the cheetah?', 'Scientific name of an animal question', 'Panthera onca,Acinonyx jubatus,Lynx rufus,Felis catus', 'Acinonyx', 'scientific,animal'),
(5, 'What is Grumpy Cat\'s real name?', 'Fictional animal question', 'Tardar Sauce,Sauce,Minnie,Broccoli', 'Tardar Sauce', 'fictional,animal'),
(6, 'What is the collective noun for a group of crows?', 'Scientific name of an animal question', 'Pack,Gaggle,Herd,Murder', 'Murder', 'scientific,animal'),
(7, 'What is the scientific name for the Polar Bear?', 'Scientific name of an animal question', 'Ursus Maritimus,Ursus Spelaeu,Ursus Arctos', 'Ursus maritimus', 'scientific,animal'),
(8, 'What does hippopotamus mean and in what langauge?', 'Language translation', 'River Horse \'(Latin)\',River Horse \'(Greek)\',Fat Pig \'(Greek)\',Fat Pig \'(Latin)\'', 'River Horse \'(Greek)\'', 'language,animal'),
(9, 'A carnivorous animal eats flesh, what does a nucivorous animal eat?', 'What animals eat question', 'Nothing,Fruit,Seaweed,Nuts', 'Nuts', 'food,animal'),
(10, 'What type of animal is a natterjack?', 'Scientific name of an animal question', 'Toad,Bird,Fish,Insect', 'Toad', 'scientific,animal'),
(11, 'What is the fastest land animal?', 'Easy animal question', 'Lion,Gazelle,Cheetah,Antelope', 'Cheetah', 'easy,fast,animal'),
(12, 'Which species of Brown Bear is not extinct?', 'Easy animal question', 'California Grizzly Bear,Atlas Bear,Mexican Grizzly Bear,Syrian Brown Bear', 'Syrian Brown Bear', 'extinct,animal'),
(13, 'When did Spanish Peninsular War start?', 'War history question', '1806,1808,1809,1810', '1808', 'history,war'),
(14, 'When did the Battle of the Somme begin?', 'War history question', 'July 1st, 1916,August 1st, 1916,July 2nd, 1916,June 30th, 1916', 'August 1st, 1916', 'history,war'),
(15, 'Which WWII tank ace is credited with having destroyed the most tanks?', 'War history question', 'Michael Wittmann,Walter Kniep,Otto Carius,Kurt Knispel', 'Otto Carius', 'history,war'),
(16, 'The Battle of Hastings was fought in which year?', 'War history question', '1066,911,1204,1420', '1066', 'history,war'),
(17, 'What year did the Vietnam War end?', 'War history question', '1978,1967,1975,1969', '1975', 'history,war'),
(18, 'King Henry VIII was the second monarch of which European royal house?', 'People in History', 'Stuart,Tudor,Lancaster,York', 'Tudor', 'king,people,history'),
(19, 'Who discovered Penicillin?', 'People in History', 'Alexander Flemming,Marie Curie,Alfred Nobel,Louis Pasteur', 'Alexander Flemming', 'people,medicin,history'),
(20, 'Which of his six wives was Henry VIII married to the longest?', 'People in History', 'Anne Boleyn,Jane Seymour,Catherine Parr,Catherine of Aragon', 'Catherine of Aragon', 'people,history'),
(21, 'What was Napoleon Bonaparte\'s name before he changed it?', 'People in History', 'Naapolion van Bonijpaart,Napoleone di Buonaparte,Napoleona de Buenoparte,Napoleona de Bueno', 'apoleone di Buonaparte', 'name,people,history'),
(22, 'Who was the President of the United States during the signing of the Gadsden Purchase?', 'People in History', 'Franklin Pierce,Andrew Johnson,Abraham Lincoln,James Polk', 'Franklin Pierce', 'president,people,history'),
(23, 'Which of the following countries does NOT border the Mediterranean Sea?', 'World geography question', 'Egypt, France, Jordan,Turkey', 'Jordan', 'world,geography'),
(24, 'Where is Mount Everest?', 'World geography question', 'Bangladesh,China,India,Nepal', 'Nepal', 'world,geography'),
(25, 'Which of the following is the name of an independent country?', 'Name of country question', 'Alaska,Albania,Alberta, Athabaska', 'Albania', 'country,name,geography'),
(26, 'Which of the following countries is NOT in South America?', 'South American Geography question', 'Argentina,Botswana,Colombia,Venezuela', 'Botswana', 'south america,country,geography'),
(27, 'Which of the Great Lakes is wholly contained in the USA?', 'North American Geography question', 'Lake Erie,Lake Huron,Lake Michigan,Lake Ontario', 'Lake Michigan', 'body of water,north america,geography'),
(28, 'Where is the Shwedagon Pagoda?', 'World geography question', 'Cambodia,Laos,Myanmar,Sri Lanka', 'Myanmar', 'world,geography'),
(29, 'What is the former name of Istanbul?', 'Name of country question', 'Campala,Carthage,Chicago,Constantinople', 'Constantinople', 'name,geography'),
(30, 'Which country\'s flag does NOT contain the colour red?', 'Name of country question', 'Pakistan,Philippines,Poland,Portugal', 'Pakistan', 'flag,geography'),
(31, 'The Great Barrier Reef is closest to which country?', 'World geography question', 'Australia,Indonesia,Japan,Peru', 'Australia', 'body of water,geography'),
(32, 'Which of the following rivers is the longest?', 'World geography question', 'The Danube River,The Saint Lawrence River,The Thames River,The Volga River', 'The Danube River', 'body of water,geography');

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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `PermissionId`, `Username`, `Password`, `Deactivated`) VALUES
(1, 1, 'PeterAdam', 'quizzmaster', 0),
(16, 2, 'foo', 'bar', 0),
(15, 2, 'steveinator', 'clothesbootsmotorcycle', 0),
(20, 2, 'bigjim', 'liljim', 0),
(21, 2, 'abc@gmail.com', 'myPassword', 0),
(22, 3, 'SallySmith', 'abc123', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
