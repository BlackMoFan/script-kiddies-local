-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 12, 2022 at 05:35 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_sample_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `user_id`, `message`, `date`) VALUES
(1, 94023124469158, 'First Message', '2022-06-06 02:41:26'),
(2, 94023124469158, 'Second Message', '2022-06-06 03:44:04'),
(3, 6685071828765, 'Hello', '2022-06-06 04:03:03'),
(4, 1788092099, 'Hello guys', '2022-06-06 04:35:06'),
(5, 1788092099, 'Why is it not working', '2022-06-06 04:36:21'),
(6, 1788092099, 'I dont know as well', '2022-06-06 04:36:28'),
(7, 1788092099, 'dgfbv cb', '2022-06-06 04:39:03'),
(8, 94023124469158, 'Is it working now', '2022-06-06 06:00:45'),
(9, 950749346670492585, 'Uhm hi', '2022-06-06 06:01:11'),
(10, 4111512833, 'Hellooo', '2022-06-06 06:01:42'),
(11, 4111512833, 'Nice to meet you', '2022-06-06 06:03:58'),
(12, 6685071828765, 'Nice to meet you too', '2022-06-06 06:04:54'),
(13, 94023124469158, 'Hello everyone. We have a new employee today', '2022-06-06 06:05:23'),
(14, 5044551638782290611, 'Nice to meet you everyone', '2022-06-06 06:06:45'),
(15, 6685071828765, 'Hello', '2022-06-06 06:30:10'),
(16, 94023124469158, 'It\\\'s all set', '2022-06-07 08:14:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `birthday` varchar(50) NOT NULL,
  `role` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `employment_status` varchar(100) NOT NULL,
  `salary` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `full_name`, `gender`, `user_name`, `birthday`, `role`, `email`, `password`, `date`, `update_date`, `employment_status`, `salary`) VALUES
(1, 94023124469158, 'The Administrator', 'Male', 'Admin', '2022-01-07', 'Administrator', 'admin@gmail.com', '$2y$10$Wr0smorL7kJ0n4QOklpNCOmFwo7sr/OgSPP4Bs3c79Y0sF1vqz1wW', '2022-06-03 13:04:05', '2022-06-07 06:36:41', 'Employed', 0),
(46, 6685071828765, 'Black Mo Fan', 'Male', 'blackmofan', '2001-02-07', 'Full-Stack Developer', 'blackmofan@gmail.com', '$2y$10$jvL1Q4HMoqcXUTD364z7wu2d5tHaTa7ZUQpNBn3HWwwAqPeXfzOeO', '2022-06-05 21:34:15', '2022-06-07 08:17:03', 'On leave', 30000),
(62, 950749346670492585, 'Rod Moreno', 'Male', 'rodmoreno', '2003-03-07', 'Back-end Developer', 'rodmoreno@gmail.com', '$2y$10$easgGoNfpC2nBBetlsLPn.ulA/Nu3D9/Bod8gybWvUFL1LWmfxMmG', '2022-06-06 04:43:18', '2022-06-07 08:16:49', 'Resigned', 60000),
(63, 1788092099, 'John Doe', 'Male', 'johndoe', '2003-04-07', 'Full-Stack Developer', 'johndoe@gmail.com', '$2y$10$99Pdz1FAWpv7wTXM6jvbc.DjpqAt.dZkKcmwb5j2KeTARBcURIFoC', '2022-06-06 12:34:44', '2022-06-07 08:16:39', 'Employed', 120000),
(66, 4111512833, 'Example Female', 'Female', 'examplefemale', '2003-05-07', 'UI/UX Designer', 'examplefemale@gmail.com', '$2y$10$yivV6Ca5kSITx6PQV.0JoOTlW4b1q4vK.n0GTViSBgtMdrmd0RuzK', '2022-06-06 13:54:58', '2022-06-07 08:16:28', 'On leave', 60000),
(67, 5044551638782290611, 'Male Example', 'Male', 'maleexample', '2003-08-07', 'Android Developer', 'maleexample@gmail.com', '$2y$10$Q5PGCFHkAKhBHdMcy/vfUONQDh2Kex4MgCUvDtbJXIG4L0Mh18Wuu', '2022-06-06 14:06:12', '2022-06-07 08:16:10', 'Employed', 70000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `date` (`date`),
  ADD KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
