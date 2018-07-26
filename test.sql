-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2018 at 03:39 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `projectID` char(32) NOT NULL,
  `projectName` varchar(30) DEFAULT NULL,
  `userID` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `TagID` char(32) NOT NULL,
  `TagName` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`TagID`, `TagName`) VALUES
('97521240247369732', 'tag 1'),
('97521240247369733', 'tag 12');

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `todoID` char(32) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(30) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `status` set('ONGOING','OVERDUE','ABORTED','') NOT NULL,
  `dependeeTodoID` char(32) DEFAULT NULL,
  `projectID` char(32) NOT NULL,
  `userID` char(32) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `todos-tags`
--

CREATE TABLE `todos-tags` (
  `TodoID` char(32) NOT NULL,
  `TagID` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` char(32) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `status` set('active','deleted') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `name`, `username`, `password`, `status`) VALUES
('97521240247369728', 'adrian', 'admin', '81NXVM2P3itj', 'deleted'),
('97521240247369729', 'adrianuc', 'admin', '81NXVM2P3itj', 'deleted'),
('97539708371861504', 'sdfsdfsdfsdfsdf', 'admin', '81NXVM2P3itj', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`projectID`),
  ADD KEY `userconstraintid` (`userID`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`TagID`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`todoID`),
  ADD KEY `constrtProjectid` (`projectID`),
  ADD KEY `constrdependeeID` (`dependeeTodoID`),
  ADD KEY `constrtUserID` (`userID`);

--
-- Indexes for table `todos-tags`
--
ALTER TABLE `todos-tags`
  ADD KEY `todos-tags_ibfk_1` (`TagID`),
  ADD KEY `todos-tags_ibfk_2` (`TodoID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `userconstraintid` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `todos`
--
ALTER TABLE `todos`
  ADD CONSTRAINT `constrtProjectid` FOREIGN KEY (`projectID`) REFERENCES `projects` (`projectID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `constrtUserID` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `todos-tags`
--
ALTER TABLE `todos-tags`
  ADD CONSTRAINT `todos-tags_ibfk_1` FOREIGN KEY (`TagID`) REFERENCES `tags` (`TagID`) ON DELETE CASCADE,
  ADD CONSTRAINT `todos-tags_ibfk_2` FOREIGN KEY (`TodoID`) REFERENCES `todos` (`todoID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
