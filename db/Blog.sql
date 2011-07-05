-- phpMyAdmin SQL Dump
-- version 3.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 05, 2011 at 12:04 PM
-- Server version: 5.1.54
-- PHP Version: 5.3.5-1ubuntu7.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE IF NOT EXISTS `Comments` (
  `PID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `CID` int(11) NOT NULL AUTO_INCREMENT,
  `Text` text NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PID`,`UID`,`CID`)
) ENGINE=MyISAM DEFAULT CHARSET=ascii AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`PID`, `UID`, `CID`, `Text`, `DateCreated`) VALUES
(17, 7, 1, 'Blah blah blah', '2011-07-01 22:34:36'),
(36, 7, 2, 'New Post: Comment', '2011-07-01 22:10:19'),
(31, 7, 1, 'sagasgasg', '2011-07-01 21:58:06'),
(33, 7, 1, 'gsagsgag', '2011-07-01 21:58:02'),
(36, 7, 1, 'agasgasga', '2011-07-01 21:57:58');

-- --------------------------------------------------------

--
-- Table structure for table `Post`
--

CREATE TABLE IF NOT EXISTS `Post` (
  `pid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `Title` tinytext NOT NULL,
  `Text` text NOT NULL,
  `Description` text NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateModified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=ascii AUTO_INCREMENT=39 ;

--
-- Dumping data for table `Post`
--

INSERT INTO `Post` (`pid`, `uid`, `Title`, `Text`, `Description`, `DateCreated`, `DateModified`) VALUES
(8, 7, 'First Post', 'This post is editted McGuillicuddy', 'This post is editted McGuillicuddy', '2011-06-24 16:35:09', '0000-00-00 00:00:00'),
(17, 8, 'Third Post.', 'This is the third post.', 'Third', '2011-06-26 22:26:13', '0000-00-00 00:00:00'),
(31, 7, 'New Title', 'Body Body Body', 'Body Body Body', '2011-06-28 06:13:46', '0000-00-00 00:00:00'),
(33, 7, 'Tieltelshjgasl;g', 'Body Body Body 1', 'Body Body Body 1', '2011-06-28 06:38:05', '0000-00-00 00:00:00'),
(36, 7, 'New Post', 'This is the body of the post', 'This is the body of the post', '2011-06-30 17:22:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `PostTag`
--

CREATE TABLE IF NOT EXISTS `PostTag` (
  `PID` int(11) NOT NULL,
  `TID` int(11) NOT NULL,
  PRIMARY KEY (`PID`,`TID`)
) ENGINE=MyISAM DEFAULT CHARSET=ascii;

--
-- Dumping data for table `PostTag`
--

INSERT INTO `PostTag` (`PID`, `TID`) VALUES
(8, 0),
(8, 1),
(8, 2),
(8, 13),
(17, 2),
(17, 13);

-- --------------------------------------------------------

--
-- Table structure for table `Tags`
--

CREATE TABLE IF NOT EXISTS `Tags` (
  `TID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  PRIMARY KEY (`TID`)
) ENGINE=MyISAM  DEFAULT CHARSET=ascii AUTO_INCREMENT=14 ;

--
-- Dumping data for table `Tags`
--

INSERT INTO `Tags` (`TID`, `Name`) VALUES
(1, 'cooking'),
(2, 'mysql'),
(13, 'one');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` tinytext NOT NULL,
  `lastname` tinytext NOT NULL,
  `username` tinytext NOT NULL,
  `password` text NOT NULL,
  `level` tinyint(4) NOT NULL DEFAULT '2',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=ascii AUTO_INCREMENT=13 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`uid`, `firstname`, `lastname`, `username`, `password`, `level`) VALUES
(8, 'Eric', 'Mantooth', 'erictooth', '123', 2),
(7, 'Sean', 'Willis', 'swillis11', '123', 2),
(10, '', '', 'admin', 'admin', 1),
(11, 'sean', 'willis', 'sewillis', '123', 2),
(12, 'Rob', 'bob', 'rob', '123', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
