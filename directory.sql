-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 10, 2014 at 03:14 AM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `directory`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `managerId` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `department` varchar(45) NOT NULL,
  `officePhone` varchar(45) NOT NULL,
  `cellPhone` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `picture` varchar(250) NOT NULL,
  `twitterId` varchar(45) DEFAULT NULL,
  `blogURL` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `firstName`, `lastName`, `managerId`, `title`, `department`, `officePhone`, `cellPhone`, `email`, `city`, `picture`, `twitterId`, `blogURL`) VALUES
(12, 'Steven', 'Wells', 4, 'Software Architect', 'Engineering', '617-000-0012', '781-000-0012', 'swells@fakemail.com', 'Boston, MA', 'steven_wells.jpg', '@fakeswells', 'http://coenraets.org'),
(11, 'Amy', 'Jones', 5, 'Sales Representative', 'Sales', '617-000-0011', '781-000-0011', 'ajones@fakemail.com', 'Boston, MA', 'amy_jones.jpg', '@fakeajones', 'http://coenraets.org'),
(10, 'Kathleen', 'Byrne', 5, 'Sales Representative', 'Sales', '617-000-0010', '781-000-0010', 'kbyrne@fakemail.com', 'Boston, MA', 'kathleen_byrne.jpg', '@fakekbyrne', 'http://coenraets.org'),
(9, 'Gary', 'Donovan', 2, 'Marketing', 'Marketing', '617-000-0009', '781-000-0009', 'gdonovan@fakemail.com', 'Boston, MA', 'gary_donovan.jpg', '@fakegdonovan', 'http://coenraets.org'),
(8, 'Lisa', 'Wong', 2, 'Marketing Manager', 'Marketing', '617-000-0008', '781-000-0008', 'lwong@fakemail.com', 'Boston, MA', 'lisa_wong.jpg', '@fakelwong', 'http://coenraets.org'),
(7, 'Paula', 'Gates', 4, 'Software Architect', 'Engineering', '617-000-0007', '781-000-0007', 'pgates@fakemail.com', 'Boston, MA', 'paula_gates.jpg', '@fakepgates', 'http://coenraets.org'),
(5, 'Ray', 'Moore', 1, 'VP of Sales', 'Sales', '617-000-0005', '781-000-0005', 'rmoore@fakemail.com', 'Boston, MA', 'ray_moore.jpg', '@fakermoore', 'http://coenraets.org'),
(6, 'Paul', 'Jones', 4, 'QA Manager', 'Engineering', '617-000-0006', '781-000-0006', 'pjones@fakemail.com', 'Boston, MA', 'paul_jones.jpg', '@fakepjones', 'http://coenraets.org'),
(3, 'Eugene', 'Lee', 1, 'CFO', 'Accounting', '617-000-0003', '781-000-0003', 'elee@fakemail.com', 'Boston, MA', 'eugene_lee.jpg', '@fakeelee', 'http://coenraets.org'),
(4, 'John', 'Williams', 1, 'VP of Engineering', 'Engineering', '617-000-0004', '781-000-0004', 'jwilliams@fakemail.com', 'Boston, MA', 'john_williams.jpg', '@fakejwilliams', 'http://coenraets.org'),
(2, 'Julie', 'Taylor', 1, 'VP of Marketing', 'Marketing', '617-000-0002', '781-000-0002', 'jtaylor@fakemail.com', 'Boston, MA', 'julie_taylor.jpg', '@fakejtaylor', 'http://coenraets.org'),
(1, 'James', 'King', 0, 'President and CEO', 'Corporate', '617-000-0001', '781-000-0001', 'jking@fakemail.com', 'Boston, MA', 'james_king.jpg', '@fakejking', 'http://coenraets.org');
