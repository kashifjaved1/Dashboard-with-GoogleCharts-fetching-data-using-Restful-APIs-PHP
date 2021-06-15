-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2020 at 08:26 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task`
--

-- --------------------------------------------------------

--
-- Table structure for table `asignees`
--

CREATE TABLE `asignees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asignees`
--

INSERT INTO `asignees` (`id`, `name`) VALUES
(1, 'Kashif Javed'),
(2, 'Naveed Ahmad'),
(3, 'Saeed Baig'),
(4, 'Ahsan Raza');

-- --------------------------------------------------------

--
-- Table structure for table `assign`
--

CREATE TABLE `assign` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `priority` varchar(255) NOT NULL,
  `assignee` varchar(255) NOT NULL,
  `reporter` varchar(255) NOT NULL,
  `est_time` varchar(255) NOT NULL,
  `attendees` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign`
--

INSERT INTO `assign` (`id`, `name`, `description`, `priority`, `assignee`, `reporter`, `est_time`, `attendees`) VALUES
(1, 'Restful API CRUD', 'PHP Restful API Crud Module Development', 'High', 'Kashif Javed', 'Kashif Javed', '2 Days', 'Rendream'),
(3, 'Backlinks', 'SEO Work', 'High', 'Kashif Javed', 'Saeed Baig', '1', 'a@gmail.com'),
(5, 'Copy Paste Work', 'a', 'Low', 'Saeed Baig', 'abc', '3 Days', 'c@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`id`, `name`, `email`) VALUES
(1, 'a', 'a@gmail.com'),
(2, 'b', 'b@gmail.com'),
(3, 'c', 'c@gmail.com'),
(4, 'd', 'd@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `taskassigned`
--

CREATE TABLE `taskassigned` (
  `id` int(11) NOT NULL,
  `assignee` varchar(255) NOT NULL,
  `task` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `taskassigned`
--

INSERT INTO `taskassigned` (`id`, `assignee`, `task`) VALUES
(1, 'Naveed Ahmad', 'Backlinks'),
(2, 'Kashif Javed', 'Restful API CRUD'),
(4, 'Saeed Baig', 'Copy Paste Work');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asignees`
--
ALTER TABLE `asignees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign`
--
ALTER TABLE `assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taskassigned`
--
ALTER TABLE `taskassigned`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asignees`
--
ALTER TABLE `asignees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assign`
--
ALTER TABLE `assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `taskassigned`
--
ALTER TABLE `taskassigned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
