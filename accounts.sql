-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2021 at 05:56 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `activity` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `time_log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`activity`, `username`, `time_log`) VALUES
('Created an Account', 'ADMIN1', '2021-05-01 03:38:06'),
('Attempted Log in', 'ADMIN1', '2021-05-01 03:38:10'),
('Success Log in', 'ADMIN1', '2021-05-01 03:38:16'),
('Logged out', 'ADMIN1', '2021-05-01 03:38:18'),
('Created an Account', 'ADMIN', '2021-05-01 03:51:54'),
('Attempted Log in', 'ADMIN', '2021-05-01 03:52:02'),
('Success Log in', 'ADMIN', '2021-05-01 03:52:13'),
('Logged out', 'ADMIN', '2021-05-01 03:52:18'),
('Reset a Password', 'ADMIN', '2021-05-01 03:52:41'),
('Attempted Log in', 'ADMIN', '2021-05-01 03:52:47');

-- --------------------------------------------------------

--
-- Table structure for table `date_auth`
--

CREATE TABLE `date_auth` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `time_added` datetime DEFAULT NULL,
  `expiration` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `date_auth`
--

INSERT INTO `date_auth` (`id`, `user_id`, `code`, `time_added`, `expiration`) VALUES
(1, 1, 899887, '2021-05-01 11:38:10', '2021-05-01 11:43:10'),
(2, 2, 529456, '2021-05-01 11:52:02', '2021-05-01 11:57:02'),
(3, 2, 409394, '2021-05-01 11:52:47', '2021-05-01 11:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'ADMIN1', '$2y$10$nrDkD9alejIoGswh10jZ1.1unlTpRZ.ujvw/xHasHE.SHIDejtqEW', 'pichiepot@gmail.com'),
(2, 'ADMIN', '$2y$10$3wzY64Bt8eyqz3TIhgXHBeE2YDyim5cXqZggVOPevGknn61vNeTgm', 'pichiepot@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `date_auth`
--
ALTER TABLE `date_auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `date_auth`
--
ALTER TABLE `date_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
