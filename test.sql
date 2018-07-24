-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2018 at 02:50 PM
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

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`projectID`, `projectName`, `userID`) VALUES
('97521240247369730', 'project 12', '97521240247369728'),
('97521240247369731', 'project 1', '97521240247369728');

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
  `tagID` char(32) DEFAULT NULL,
  `userID` char(32) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`todoID`, `title`, `description`, `startDate`, `endDate`, `status`, `dependeeTodoID`, `projectID`, `tagID`, `userID`, `deleted`) VALUES
('97521240247369735', 'title', 'description test', '2018-02-08 00:00:00', '2018-02-21 06:00:00', 'ONGOING', NULL, '97521240247369730', '97521240247369732', '97521240247369728', 1),
('97521240247369736', 'dtitle', 'description test', '2018-02-08 00:00:00', '2018-02-21 06:00:00', 'ONGOING', NULL, '97521240247369730', '97521240247369732', '97521240247369728', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `UserID` char(32) NOT NULL,
  `status` set('active','deleted') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `username`, `password`, `UserID`, `status`) VALUES
('adrian', 'adrian1', '12345', '97521240247369728', 'active'),
('adrian', 'adrian', '12345', '97521240247369729', 'active');

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
  ADD KEY `constrTagID` (`tagID`),
  ADD KEY `constrtUserID` (`userID`),
  ADD KEY `constrdependeeID` (`dependeeTodoID`);

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
  ADD CONSTRAINT `constrTagID` FOREIGN KEY (`tagID`) REFERENCES `tags` (`TagID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `constrdependeeID` FOREIGN KEY (`dependeeTodoID`) REFERENCES `todos` (`todoID`),
  ADD CONSTRAINT `constrtProjectid` FOREIGN KEY (`projectID`) REFERENCES `projects` (`projectID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `constrtUserID` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
