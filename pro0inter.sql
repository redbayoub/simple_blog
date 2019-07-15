-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2018 at 01:12 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pro0inter`
--

-- --------------------------------------------------------

--
-- Table structure for table `pro0inter_fildes`
--

CREATE TABLE `pro0inter_fildes` (
  `filed_id` tinyint(4) UNSIGNED NOT NULL,
  `filed_name` varchar(20) NOT NULL,
  `position` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `pro0inter_fildes`
--

INSERT INTO `pro0inter_fildes` (`filed_id`, `filed_name`, `position`) VALUES
(22, 'Winowes', 3),
(23, 'Android', 2),
(24, 'Tech', 1),
(25, 'Linux', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pro0inter_subjects`
--

CREATE TABLE `pro0inter_subjects` (
  `subject_id` smallint(5) UNSIGNED NOT NULL,
  `subject_filed_id` tinyint(3) UNSIGNED NOT NULL,
  `subject_title` varchar(60) NOT NULL,
  `cover_img_path` varchar(100) NOT NULL,
  `subject_content` text NOT NULL,
  `subject_writer_id` smallint(3) DEFAULT NULL,
  `subject_writer` varchar(30) NOT NULL,
  `subject_date` datetime NOT NULL,
  `subject_viewes` tinyint(4) NOT NULL,
  `subject_rating` float(10,0) NOT NULL,
  `subject_aproved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `pro0inter_subjects`
--

INSERT INTO `pro0inter_subjects` (`subject_id`, `subject_filed_id`, `subject_title`, `cover_img_path`, `subject_content`, `subject_writer_id`, `subject_writer`, `subject_date`, `subject_viewes`, `subject_rating`, `subject_aproved`) VALUES
(1, 22, 'how to hack win', 'no image', 'hello my fellowers i hope you gonna like this subject <br />\r\ni\'m wating for your commnts', 5, 'Ayoub Red', '2018-04-13 12:04:03', 42, 0, 1),
(2, 23, 'how to hack android devices', '', 'Hello hacking android devices is so simple because :<br /><br /><br />\r\n<br /><br /><br />\r\n Low Security <br /><br /><br />\r\n A lot of available apps <br /><br /><br />\r\n The dumb of users <br /><br /><br />\r\n<br /><br /><br />\r\n', 6, 'Ayoub Red', '2018-04-13 19:04:06', 19, 0, 1),
(3, 23, 'hack andorid phone', 'no image', 'It\'s so fucking simple', 6, 'Ayoub Red', '2018-04-15 20:04:28', 13, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pro0inter_users`
--

CREATE TABLE `pro0inter_users` (
  `ID` smallint(3) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `account_type` char(1) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `gender` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pro0inter_users`
--

INSERT INTO `pro0inter_users` (`ID`, `username`, `password`, `email`, `account_type`, `approved`, `image`, `description`, `firstname`, `surname`, `gender`) VALUES
(3, 'naser98', 'acfe3baaadb72ebbbf02515408e6fdf0a1a7bc1a', 'naser1998@gmail.com', 'W', 1, '', 'I ma proggrmaer', 'naser din', 'doudi', 'M'),
(4, 'redayoub98', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'redayoub47@gmail.com', 'A', 0, '', ' I\'m a programmer studying computer science', 'Bayoub', 'Red', 'M'),
(5, 'redayoub47', '944d16018a1538797e4524f86ef083af6290fe87', 'redayoub47@gmail.com', 'A', 1, '', '    I\'m a programmer studying computer', 'Bayoub', 'Reddah', 'M'),
(6, 'redayoub48', '944d16018a1538797e4524f86ef083af6290fe87', 'redayoub48@gmail.com', 'W', 0, 'no image', 'I am working in google and facebook', 'Ayoub', 'Red', 'M'),
(7, 'user1', '7c222fb2927d828af22f592134e8932480637c0d', 'user1@gmail.com', 'A', 1, '', 'I\'m a programmer', 'userFirstname', 'userSurname', 'M');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pro0inter_fildes`
--
ALTER TABLE `pro0inter_fildes`
  ADD PRIMARY KEY (`filed_id`);

--
-- Indexes for table `pro0inter_subjects`
--
ALTER TABLE `pro0inter_subjects`
  ADD PRIMARY KEY (`subject_id`),
  ADD UNIQUE KEY `subject_title` (`subject_title`),
  ADD KEY `subject_filed_id` (`subject_filed_id`),
  ADD KEY `subject_writer_id` (`subject_writer_id`);

--
-- Indexes for table `pro0inter_users`
--
ALTER TABLE `pro0inter_users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pro0inter_fildes`
--
ALTER TABLE `pro0inter_fildes`
  MODIFY `filed_id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pro0inter_subjects`
--
ALTER TABLE `pro0inter_subjects`
  MODIFY `subject_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pro0inter_users`
--
ALTER TABLE `pro0inter_users`
  MODIFY `ID` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pro0inter_subjects`
--
ALTER TABLE `pro0inter_subjects`
  ADD CONSTRAINT `pro0inter_subjects_ibfk_1` FOREIGN KEY (`subject_filed_id`) REFERENCES `pro0inter_fildes` (`filed_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
