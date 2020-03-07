-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2020 at 11:19 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sl_gsm_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `devicehardware`
--

CREATE TABLE `devicehardware` (
  `id` int(11) UNSIGNED NOT NULL,
  `devicehwid` int(10) UNSIGNED NOT NULL,
  `hwpartname` int(10) UNSIGNED DEFAULT NULL,
  `hwpartimg` varchar(255) DEFAULT NULL,
  `hwpartdetail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `deviceos`
--

CREATE TABLE `deviceos` (
  `id` int(10) UNSIGNED NOT NULL,
  `deviceos` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `devicepictures`
--

CREATE TABLE `devicepictures` (
  `id` int(10) UNSIGNED NOT NULL,
  `picture` varchar(255) NOT NULL,
  `detail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `devicesoftware`
--

CREATE TABLE `devicesoftware` (
  `id` int(10) UNSIGNED NOT NULL,
  `devicesoftwareid` int(10) UNSIGNED NOT NULL,
  `softwarefiles` varchar(255) NOT NULL,
  `softwaredetail` text NOT NULL,
  `softwarenote` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `devicetype`
--

CREATE TABLE `devicetype` (
  `id` int(11) UNSIGNED NOT NULL,
  `devicetype` varchar(100) NOT NULL,
  `devicename` varchar(100) NOT NULL,
  `devicemodelname` varchar(255) NOT NULL,
  `devicepicturesid` int(10) UNSIGNED NOT NULL,
  `deviceosid` int(10) UNSIGNED NOT NULL,
  `devicesoftwareid` int(10) UNSIGNED NOT NULL,
  `devicehardwareid` int(10) UNSIGNED NOT NULL,
  `devicedetailid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` tinyint(4) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `list_countries`
--

CREATE TABLE `list_countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mobiledetails`
--

CREATE TABLE `mobiledetails` (
  `id` int(10) UNSIGNED NOT NULL,
  `funname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mobilesubdetails`
--

CREATE TABLE `mobilesubdetails` (
  `id` int(10) UNSIGNED NOT NULL,
  `funid` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `scope` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `privileges_groups`
--

CREATE TABLE `privileges_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `privilegesid` int(10) UNSIGNED NOT NULL,
  `permissionsid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `userid` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `sex` varchar(6) DEFAULT NULL,
  `dateofbirth` datetime DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `regdate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rule` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `token` varchar(255) NOT NULL,
  `lastlogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devicehardware`
--
ALTER TABLE `devicehardware`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hardwareid_1` (`devicehwid`);

--
-- Indexes for table `deviceos`
--
ALTER TABLE `deviceos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `deviceos` (`deviceos`);

--
-- Indexes for table `devicepictures`
--
ALTER TABLE `devicepictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devicesoftware`
--
ALTER TABLE `devicesoftware`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_softwareid_1` (`devicesoftwareid`);

--
-- Indexes for table `devicetype`
--
ALTER TABLE `devicetype`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `devicesoftwareid` (`devicesoftwareid`),
  ADD UNIQUE KEY `devicehardwareid` (`devicehardwareid`),
  ADD KEY `fk_pictureid_1` (`devicepicturesid`),
  ADD KEY `fk_osid_2` (`deviceosid`),
  ADD KEY `fk_detailid_3` (`devicedetailid`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_countries`
--
ALTER TABLE `list_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobiledetails`
--
ALTER TABLE `mobiledetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobilesubdetails`
--
ALTER TABLE `mobilesubdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_funcid_1` (`funid`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `scope` (`scope`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privileges_groups`
--
ALTER TABLE `privileges_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissionsid` (`permissionsid`),
  ADD KEY `privilegesid` (`privilegesid`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `usermail` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `devicehardware`
--
ALTER TABLE `devicehardware`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deviceos`
--
ALTER TABLE `deviceos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `devicepictures`
--
ALTER TABLE `devicepictures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `devicesoftware`
--
ALTER TABLE `devicesoftware`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `devicetype`
--
ALTER TABLE `devicetype`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `list_countries`
--
ALTER TABLE `list_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mobiledetails`
--
ALTER TABLE `mobiledetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mobilesubdetails`
--
ALTER TABLE `mobilesubdetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privileges_groups`
--
ALTER TABLE `privileges_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `userid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `devicehardware`
--
ALTER TABLE `devicehardware`
  ADD CONSTRAINT `fk_hardwareid_1` FOREIGN KEY (`devicehwid`) REFERENCES `devicetype` (`devicehardwareid`);

--
-- Constraints for table `devicesoftware`
--
ALTER TABLE `devicesoftware`
  ADD CONSTRAINT `fk_softwareid_1` FOREIGN KEY (`devicesoftwareid`) REFERENCES `devicetype` (`devicesoftwareid`);

--
-- Constraints for table `devicetype`
--
ALTER TABLE `devicetype`
  ADD CONSTRAINT `fk_detailid_3` FOREIGN KEY (`devicedetailid`) REFERENCES `mobiledetails` (`id`),
  ADD CONSTRAINT `fk_osid_2` FOREIGN KEY (`deviceosid`) REFERENCES `deviceos` (`id`),
  ADD CONSTRAINT `fk_pictureid_1` FOREIGN KEY (`devicepicturesid`) REFERENCES `devicepictures` (`id`);

--
-- Constraints for table `mobilesubdetails`
--
ALTER TABLE `mobilesubdetails`
  ADD CONSTRAINT `fk_funcid_1` FOREIGN KEY (`funid`) REFERENCES `mobiledetails` (`id`);

--
-- Constraints for table `privileges_groups`
--
ALTER TABLE `privileges_groups`
  ADD CONSTRAINT `privileges_groups_ibfk_1` FOREIGN KEY (`permissionsid`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `privileges_groups_ibfk_2` FOREIGN KEY (`privilegesid`) REFERENCES `privileges` (`id`);

--
-- Constraints for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD CONSTRAINT `userprofile_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
