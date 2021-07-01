-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2021 at 05:12 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `created_at`) VALUES
(0, 'admin', '$2y$10$FvOKoKjMPHOHbAW.pVNENee9qx.FDL6cw/sJeQBZ5ywF8xcFGZQnC', '2018-12-28 22:23:01'),
(0, 'newadmin', '$2y$10$4vVY2K4oexQBp1fH9mc95.h7XV3opnZQagxFdiyDEChlhybdh46sq', '2018-12-28 23:28:13'),
(0, 'newadmins', '$2y$10$J6RVQlthKmOsvpOvBTR5AeM09LMWxIOZf5lSS5dIa8OIMpOeTw22W', '2018-12-29 22:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `dao`
--

CREATE TABLE `dao` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `nic` varchar(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `nic` varchar(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`id`, `username`, `password`, `created_at`, `nic`, `name`) VALUES
(0, 'newfarmer1', '$2y$10$hSd/cS5mgesrTqhVTxhnUeBf4FxQumnDcBdwE0aabvorM5pKeDqtS', '2021-01-05 12:27:07', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `farmmsg`
--

CREATE TABLE `farmmsg` (
  `username` varchar(100) NOT NULL,
  `messagefarm` varchar(500) NOT NULL,
  `name` varchar(255) NOT NULL,
  `keelsuname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `keels`
--

CREATE TABLE `keels` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `nic` varchar(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keelsmsg`
--

CREATE TABLE `keelsmsg` (
  `username` varchar(100) NOT NULL,
  `messagekeels` varchar(500) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sendersuname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `description` varchar(200) NOT NULL,
  `location_status` tinyint(1) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `img` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `quantity` int(10) NOT NULL,
  `messageskeels` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
