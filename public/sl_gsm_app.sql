-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2020 at 08:15 AM
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

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `scope`) VALUES
(1, 'Show users ', '/users/default'),
(2, 'Add users', '/users/add'),
(3, 'Edit users', '/users/edit'),
(4, 'Delete users', '/users/del'),
(5, 'Show permissions', '/permissions/default'),
(6, 'Add permissions', '/permissions/add'),
(7, 'Edit permissions', '/permissions/edit'),
(8, 'Delete permissions', '/permissions/del'),
(9, 'Show privileges', '/privileges/default'),
(10, 'Add privileges', '/privileges/add'),
(11, 'Edit privileges', '/privileges/edit'),
(12, 'Delete privileges', '/privileges/del'),
(17, 'Usersgroups', '/usersgroups/default'),
(18, 'upload image', '/permissions/image');

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`id`, `name`) VALUES
(2, 'Application manager '),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `privileges_groups`
--

CREATE TABLE `privileges_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `privilegesid` int(10) UNSIGNED NOT NULL,
  `permissionsid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privileges_groups`
--

INSERT INTO `privileges_groups` (`id`, `privilegesid`, `permissionsid`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4),
(5, 2, 5),
(6, 2, 6),
(7, 2, 7),
(8, 2, 8),
(9, 2, 9),
(10, 2, 10),
(11, 2, 11),
(12, 2, 12),
(13, 3, 1),
(14, 3, 5),
(22, 2, 17),
(23, 2, 18),
(24, 3, 18);

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `userid` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `countery` varchar(50) DEFAULT NULL,
  `sex` varchar(6) DEFAULT NULL,
  `dateofbirth` datetime DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `regdate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`userid`, `firstname`, `lastname`, `countery`, `sex`, `dateofbirth`, `picture`, `bio`, `regdate`) VALUES
(1, 'lakhdar', 'saied', NULL, NULL, NULL, NULL, NULL, '2020-02-19 23:19:31'),
(2, 'laoi', 'saied', NULL, NULL, NULL, NULL, NULL, '2020-02-20 00:10:41');

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `rule`, `phone`, `status`, `token`, `lastlogin`) VALUES
(1, 'saiedlakhdar', 'saied.lakhdar01@gmail.com', 'fe31023c46ace0974103aab52e3c39c0', 3, '+213697245950', 1, 'WrjpZy43CD1q6lRRHu1d24myLm6RKsPJvGiwENnUrLmTPB69WKiGII8mogO81vu5NTFtHAclYnUskpUCCj9gwQ==', '2020-02-20 22:26:16'),
(2, 'saiedloai', 'loai@gamil.com', 'fe31023c46ace0974103aab52e3c39c0', 2, '0697245950', 1, 'bza8dJumYjyJKx6f/SylMZf6eH6N+lCxQuhiLyBAcyl9bVDIkg1TrXvdimC4SnHyVH7V55rnYKCHnDz0Yy7fsg==', '2020-02-22 07:30:55');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `privileges_groups`
--
ALTER TABLE `privileges_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `userid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
