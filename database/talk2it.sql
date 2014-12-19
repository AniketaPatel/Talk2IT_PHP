-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 16, 2013 at 03:35 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `talk2it`
--

-- --------------------------------------------------------

--
-- Table structure for table `dicussion_tb`
--

CREATE TABLE `dicussion_tb` (
  `did` int(5) NOT NULL auto_increment,
  `tid` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `datetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY  (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dicussion_tb`
--


-- --------------------------------------------------------

--
-- Table structure for table `event_tb`
--

CREATE TABLE `event_tb` (
  `eid` int(5) NOT NULL auto_increment,
  `uid` int(5) NOT NULL,
  `ename` varchar(20) NOT NULL,
  `description` varchar(100) default NULL,
  `edate` date NOT NULL,
  `from_time` int(4) NOT NULL,
  `to_time` int(4) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY  (`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `event_tb`
--


-- --------------------------------------------------------

--
-- Table structure for table `friends_tb`
--

CREATE TABLE `friends_tb` (
  `fid` int(5) NOT NULL auto_increment,
  `uid` int(5) NOT NULL,
  `req_send` varchar(500) default NULL,
  `req_receive` varchar(500) default NULL,
  `flist` varchar(500) default NULL,
  PRIMARY KEY  (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `friends_tb`
--


-- --------------------------------------------------------

--
-- Table structure for table `message_tb`
--

CREATE TABLE `message_tb` (
  `mid` int(5) NOT NULL auto_increment,
  `uid` int(5) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `message` text,
  `sender_id` int(5) NOT NULL,
  `receiver_id` int(5) NOT NULL,
  `date_time` datetime NOT NULL,
  `delete_status` int(1) NOT NULL,
  `archive_status` int(1) NOT NULL,
  `trash_status` int(1) NOT NULL,
  `read_status` int(1) NOT NULL,
  PRIMARY KEY  (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `message_tb`
--


-- --------------------------------------------------------

--
-- Table structure for table `oraganization_db`
--

CREATE TABLE `oraganization_db` (
  `oid` int(5) NOT NULL,
  `oname` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `logo` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY  (`oid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oraganization_db`
--


-- --------------------------------------------------------

--
-- Table structure for table `post_tb`
--

CREATE TABLE `post_tb` (
  `pid` int(5) NOT NULL auto_increment,
  `uid` int(5) NOT NULL,
  `post` varchar(200) NOT NULL,
  `datetime` datetime NOT NULL,
  `delete_status` int(1) NOT NULL,
  PRIMARY KEY  (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `post_tb`
--


-- --------------------------------------------------------

--
-- Table structure for table `topics_tb`
--

CREATE TABLE `topics_tb` (
  `tid` int(5) NOT NULL auto_increment,
  `uid` int(5) NOT NULL,
  `topic` varchar(50) NOT NULL,
  `date_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `image` varchar(20) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY  (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `topics_tb`
--


-- --------------------------------------------------------

--
-- Table structure for table `users_tb`
--

CREATE TABLE `users_tb` (
  `uid` int(5) NOT NULL auto_increment,
  `oid` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `image` varchar(20) NOT NULL,
  `status` varchar(1) NOT NULL,
  `active_code` varchar(30) NOT NULL,
  `isActive` int(1) NOT NULL,
  `isBlock` int(1) NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users_tb`
--

