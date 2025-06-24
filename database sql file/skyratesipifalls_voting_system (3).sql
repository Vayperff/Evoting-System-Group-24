-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 24, 2025 at 08:13 AM
-- Server version: 10.6.22-MariaDB-log
-- PHP Version: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skyratesipifalls_voting_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_sign_up`
--

CREATE TABLE `admin_sign_up` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `reg_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` int(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(128) NOT NULL,
  `date_format` varchar(30) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `time` time DEFAULT current_timestamp(),
  `status` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_sign_up`
--

INSERT INTO `admin_sign_up` (`id`, `username`, `reg_name`, `email`, `phone`, `password`, `image`, `date_format`, `date_created`, `time`, `status`) VALUES
(1, 'KIDANDI JOSHUA', '001', 'mashatevyper@gmail.com', 743007052, '$2y$10$aYpJ01vnW4qLTL8ki656uunwFygVbNNjKTe7EFw./k4hdNrKHCDBC', '20250220_182758-1749295284.jpg', '07, Jun 2025', '2025-06-07 11:21:24', '11:21:24', 'active'),
(2, 'Morgan', '001', 'emmymorgan1278@gmail.com', 705015316, '$2y$10$mOcewJ6wR4KjI9FSNOGchO52n581Z9SwCQ8cDvQ09wZkaXNDZw0Xq', 'gsgfs9kwgae9mzz-1749300010.jpg', '07, Jun 2025', '2025-06-07 12:40:10', '12:40:10', 'active'),
(3, 'SSEMBATYA KENNETH', '001', 'ssembatyakenneth568@gmail.com', 700509466, '$2y$10$qDFP.t0auKGh9Eo7XapCUORAVYehLOK3ZDXWepo2qo1hoibXYgKpm', 'pic-1749300212.jpg', '07, Jun 2025', '2025-06-07 12:43:32', '12:43:32', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `candidate_name` varchar(255) NOT NULL,
  `candidate_role` varchar(255) DEFAULT NULL,
  `candidate_bio` text NOT NULL,
  `candidate_image` varchar(255) NOT NULL,
  `election_id` varchar(20) DEFAULT NULL,
  `election_name` varchar(20) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_format` varchar(30) NOT NULL,
  `time` time DEFAULT curtime(),
  `email` varchar(255) NOT NULL,
  `deleted` varchar(30) DEFAULT NULL,
  `election_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `candidate_name`, `candidate_role`, `candidate_bio`, `candidate_image`, `election_id`, `election_name`, `date_created`, `date_format`, `time`, `email`, `deleted`, `election_status`) VALUES
(1, 'mwesigwa philips', 'GUILD PRESIDENT', 'iudsduhwrh', 'oip2-1749300513.jpg', '2', NULL, '2025-06-07 12:48:33', '07, Jun 2025', '12:48:33', 'ssembatyakenneth511@gmail.com', 'active', 1),
(2, 'KIDANDI JOSHUA', 'GUILD PRESIDENT', 'dgf7weudsjcjueydhjdgtsds', 'admin 2-1749300953.jpg', '2', NULL, '2025-06-07 12:55:53', '07, Jun 2025', '12:55:53', 'mashatevyper@gmail.com', 'active', 1),
(3, 'test', 'GUILD PRESIDENT', 'test', 'gsgfs9kwgae9mzz-1749301425.jpg', '2', NULL, '2025-06-07 13:03:45', '07, Jun 2025', '13:03:45', 'emmymorgan1278@gmail.com', 'active', 1),
(4, 'Ngorok Emmanuel Morgan', 'GUILD PRESIDENT', 'test', 'download-1749362218.webp', '2', NULL, '2025-06-08 05:56:58', '08, Jun 2025', '05:56:58', 'ngorokemmymorgan@gmail.com', 'active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

CREATE TABLE `elections` (
  `id` int(11) NOT NULL,
  `election_name` varchar(255) NOT NULL,
  `election_description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `election_banner` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(128) NOT NULL,
  `deleted` varchar(30) NOT NULL,
  `email_sent` varchar(30) DEFAULT NULL,
  `is_ended` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `elections`
--

INSERT INTO `elections` (`id`, `election_name`, `election_description`, `start_date`, `end_date`, `election_banner`, `date_created`, `status`, `deleted`, `email_sent`, `is_ended`) VALUES
(1, 'GUILD PRESIDENT', 'HE IS CAPABLE TO RULE', '2025-06-07', '2025-06-23', NULL, '2025-06-07 11:33:18', 'NOT_COMPLETED', 'active', NULL, ''),
(2, 'GUILD PRESIDENT', 'HE IS CAPABLE TO RULE', '2025-06-07', '2025-06-08', 'gsgfs9kwgae9mzz-1749362883.jpg', '2025-06-07 11:35:30', 'COMPLETED', 'active', NULL, 'ended');

-- --------------------------------------------------------

--
-- Table structure for table `student_sign_up`
--

CREATE TABLE `student_sign_up` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `reg_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` int(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(128) NOT NULL,
  `date_format` varchar(30) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `time` time DEFAULT current_timestamp(),
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student_sign_up`
--

INSERT INTO `student_sign_up` (`id`, `username`, `reg_name`, `email`, `phone`, `password`, `image`, `date_format`, `date_created`, `time`, `deleted`) VALUES
(1, 'Ssembatya ', '2023/ITB/DAY', 'ssembatyakenneth568@gmail.com', 700509466, '$2y$10$yYtAlA.d6gxK9R0aaDqjpejs8UvIXRcalIf4544M4SpyKQE.cMxni', '20250606_003453-1749284913.jpg', '07, Jun 2025', '2025-06-07 08:28:33', '08:28:33', 0),
(2, 'KIDANDI JOSHUA', '2023/ITB/DAY/1056', 'mashatevyper@gmail.com', 707218553, '$2y$10$UFmMWgW1RMA/R43Nr5kIWOifDY26gEMk1XC5zTbkieyfLT1seDEa2', '20250220_182758-1749284926.jpg', '07, Jun 2025', '2025-06-07 08:28:46', '08:28:46', 0),
(3, 'NAYERA ESTHER', '2023/ITB/DAY/1281', 'esthernayera11@gmail.com', 741456170, '$2y$10$sPq67s.S/Ylw/6rIInD.COxZLdVv2iIH2cKzhwDAihvMXu0jjGe5K', 'win_20250606_06_26_02_pro-1749285113.jpg', '07, Jun 2025', '2025-06-07 08:31:53', '08:31:53', 0),
(4, 'Emmanuel Morgan', '2023/ITB/DAY/10292', 'emmymorgan1278@gmail.com', 705015316, '$2y$10$Bs2JpXYDKleZyYTZFRtvPe2v0adxLtxAxcDYpFrLPwsZj9ysT8Nty', 'download-1749285250.webp', '07, Jun 2025', '2025-06-07 08:34:10', '08:34:10', 0),
(5, 'Teacher', '2020/ITB/DAY/0772', 'test@gmail.com', 705015316, '$2y$10$p5t/cCUb/zNcxqV4D4shNu3Z0Vw2WzUlvkXk3iGbM5VySS8fSD6Me', 'download-1749285414.webp', '07, Jun 2025', '2025-06-07 08:36:54', '08:36:54', 0),
(6, 'KOMUCUNGUZI PRISCILLAH ', '2023/DAY/ITB/1712', 'priscillahkomucunguzi@gmail.com', 780498966, '$2y$10$bZMVxlRxKq.gi/g3k4Z1Au4s7fIgKTse9/WsT.9TWmTP6GR4y3lg.', 'img_0540-1749285659.jpeg', '07, Jun 2025', '2025-06-07 08:40:59', '08:40:59', 0),
(7, 'Agaba marion', '2023/ITB/DAY/1375', 'marionamber97@gmail.com', 709481853, '$2y$10$jLrxctkNHBzK1jBDscJ9xupd2TJ2hu/ay26D8nc5XEZVJYaT2i3ji', '075dbbf2-0e9c-41a5-8e84-569262d372d1-1749286023.jpeg', '07, Jun 2025', '2025-06-07 08:47:04', '08:47:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `reg_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` int(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(128) NOT NULL,
  `date_format` varchar(30) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `time` time DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`id`, `username`, `reg_name`, `email`, `phone`, `password`, `image`, `date_format`, `date_created`, `time`) VALUES
(1, 'SSEMBATYA KENNETH', '001', 'ssembatyakenneth568@gmail.com', 0, '$2y$10$GLZ1xNNExdMyns9jZ7iMN.hoAt52He9e/kosXlkRSyOVmrnwM1KqC', 'win_20250606_06_26_02_pro-1749286658.jpg', '07, Jun 2025', '2025-06-07 08:57:39', '08:57:39'),
(2, 'KIDANDI JOSHUA', '001', 'mashatevyper@gmail.com', 0, '$2y$10$G7tG8Tqqk/Z7GkPi1MgdmOo3pABoP0KtgPTKNAkCumriY22I/RJ3m', '20250220_182758-1749286741.jpg', '07, Jun 2025', '2025-06-07 08:59:01', '08:59:01'),
(3, 'Emmanuel Morgan', '001', 'emmymorgan1278@gmail.com', 0, '$2y$10$ZXOmn1z1u2UmqSpKcJc24.1Jlx462E3Eql12.KROjHLZbbvUZ5/xe', 'gsgfs9kwgae9mzz-1749299980.jpg', '07, Jun 2025', '2025-06-07 12:39:40', '12:39:40');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_format` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `candidate_name` varchar(30) NOT NULL,
  `candidate_role` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `voting_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `user_id`, `candidate_id`, `election_id`, `email`, `date_format`, `date_created`, `time`, `candidate_name`, `candidate_role`, `status`, `voting_status`) VALUES
(1, '1', 1, 2, 'ssembatyakenneth568@gmail.com', '07, Jun 2025', '2025-06-07 15:36:30', '15:36:30', 'mwesigwa philips', 'GUILD PRESIDENT', 'voted', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_sign_up`
--
ALTER TABLE `admin_sign_up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elections`
--
ALTER TABLE `elections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_sign_up`
--
ALTER TABLE `student_sign_up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_sign_up`
--
ALTER TABLE `admin_sign_up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `elections`
--
ALTER TABLE `elections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_sign_up`
--
ALTER TABLE `student_sign_up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
