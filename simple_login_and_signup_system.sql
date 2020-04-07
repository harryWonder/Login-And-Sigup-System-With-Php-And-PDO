-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 07, 2020 at 08:53 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simple_login_and_signup_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` varchar(225) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `status`, `created_at`, `updated_at`, `password`) VALUES
(1, 'Stephen', 'Ilori', 'stephenilori458@gmail.com', 1, '2020-03-10 00:55:15', '2020-03-10 00:55:15', ''),
(2, 'Stephen', 'Ilori', 'stephenilori459@gmail.com', 1, '2020-03-15 14:05:18', '2020-03-15 14:05:18', '$2y$10$9WZFNf8FKmxlwW2ZkdQOReZKnZLTV8uDIy0sKA0hLK5tXKEgKq1LO'),
(3, 'Harry', 'Wonder', 'stephenilori448@gmail.com', 1, '2020-03-15 14:06:41', '2020-03-15 14:06:41', '$2y$10$cRq23QYY0krRFWfdzhtEquUdD3ujfDXu0u6Ed6ZvGI1tHihNfR3ae'),
(4, 'Max', 'Williams', 'stephenilori678@gmail.com', 1, '2020-03-15 14:07:19', '2020-03-15 14:07:19', '$2y$10$jNDWlIOgPdB46VnXDZfgIuafjbmVoF./TYQX.XwccYODoi5bSgiTO'),
(5, 'Mary', 'Jane', 'maryjane458@gmail.com', 1, '2020-04-07 19:53:03', '2020-04-07 19:53:03', '$2y$10$3R0K7US1qLSwdKzJ63HRYuWVJX5BO1OqdxlAt0xQIsRwVFqQ82m2G'),
(6, 'Simon', 'West', 'simonwest459@aol.com', 1, '2020-04-07 19:53:32', '2020-04-07 19:53:32', '$2y$10$rLXMCd2qxWIMQv3cybqGZeL72sCQS6DGrVxphGqL6QAr4NN0ZPt5i'),
(7, 'Jack', 'Bren', 'jackybrem458@aol.com', 1, '2020-04-07 19:54:11', '2020-04-07 19:54:11', '$2y$10$6QWmGT0HYAcK.igqkMGufu4KZa9ZbHkfFhYd8hTvuTNCSdsT.vRNC'),
(8, 'Nolan', 'Black', 'nolanblack458@aol.com', 1, '2020-04-07 19:56:04', '2020-04-07 19:56:04', '$2y$10$Y2Aoclsik9NFz7qrYmg7eu0QOeF6knm3275uDdi5qeNh7aJ/jMtUa'),
(9, 'Harrison', 'Wells', 'pixietechdevtest@aol.com', 1, '2020-04-07 20:00:03', '2020-04-07 20:00:03', '$2y$10$waqqOEsf2x30nEt5PWYvtu7KrdteS/9Xo9RtJ.P.bYYpbMNJk/C5i'),
(10, 'Harrison', 'Wells', 'ajsjsja@aol.com', 1, '2020-04-07 20:01:15', '2020-04-07 20:01:15', '$2y$10$8KRRIY59usZ.3RxV6dTN5Ot9eZxpBPBd.BaWKkqmWf82dCIOBPxty'),
(11, 'John', 'Ilori', 'jonilori458@gmail.com', 1, '2020-04-07 20:02:29', '2020-04-07 20:02:29', '$2y$10$oevj6bX4PTHLkcvjrX455OGm1w6RpRxvzVlqn0lM1YfJ2q31zZC2q');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
