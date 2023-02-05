-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2023 at 05:14 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uvi`
--

-- --------------------------------------------------------

--
-- Table structure for table `card_request`
--

CREATE TABLE `card_request` (
  `card_request_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `card_request`
--

INSERT INTO `card_request` (`card_request_id`, `user_id`, `status`) VALUES
(1, 1, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `api_id` varchar(50) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_pass` varchar(80) NOT NULL,
  `pack_name` varchar(50) NOT NULL,
  `pack_end_date` varchar(50) NOT NULL,
  `api_calls` bigint(20) NOT NULL,
  `api_call_succ` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `api_id`, `user_email`, `user_pass`, `pack_name`, `pack_end_date`, `api_calls`, `api_call_succ`) VALUES
(1, 'pA6G5WUD9X1O', 'numansfs@gmail.com', '9ec463228f6a1ebee46d9a5054acea9a', 'Stater', '11-11-2022', 6, 5),
(2, 'U3SdTCwHz28K', 'numansfss@gmail.com', '9ec463228f6a1ebee46d9a5054acea9a', 'Stater', '30-11-2022', 4, 3),
(3, 'cwoebYUzQS9g', 'numansds@gamil.com', '9ec463228f6a1ebee46d9a5054acea9a', 'Stater', '07-12-2022', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `uvi_card_user`
--

CREATE TABLE `uvi_card_user` (
  `card_user_id` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_number` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nfc_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uvi_card_user`
--

INSERT INTO `uvi_card_user` (`card_user_id`, `email`, `mobile_number`, `password`, `nfc_id`) VALUES
(1, 'numan@gmail.com', '7980987898', '26750e8556daa8eb7011744aefbd7310', '987654'),
(2, 'numans@gmail.com', '7980987898', '26750e8556daa8eb7011744aefbd7310', ''),
(3, 'numan32@gmail.com', '7980987898', '26750e8556daa8eb7011744aefbd7310', ''),
(4, 'pravin@gmail.com', '7980987898', 'daf465486047727f285b1a2d8d0f375b', '987456');

-- --------------------------------------------------------

--
-- Table structure for table `validator`
--

CREATE TABLE `validator` (
  `validator_id` bigint(20) NOT NULL,
  `api_id` varchar(50) NOT NULL,
  `nfc_id` varchar(50) NOT NULL,
  `from_date` varchar(50) NOT NULL,
  `to_date` varchar(50) NOT NULL,
  `validating_parameter` varchar(50) NOT NULL,
  `is_ticket` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `validator`
--

INSERT INTO `validator` (`validator_id`, `api_id`, `nfc_id`, `from_date`, `to_date`, `validating_parameter`, `is_ticket`) VALUES
(1, 'pA6G5WUD9X1O', '123456', '11-10-2022', '12-10-2022', 'Bus Ticket', 1),
(2, 'pA6G5WUD9X1O', '987456', '11-11-2022', '12-10-2022', 'Gym Membership', 0),
(3, 'U3SdTCwHz28K', '987456', '30-10-2022', '30-10-2022', 'Ticket', 1),
(4, 'U3SdTCwHz28K', '98745', '31-10-2022', '31-10-2022', 'Bus Ticket', 1),
(5, 'U3SdTCwHz28K', '987456', '24-01-2023', '24-02-2023', 'Bus Ticket', 1),
(6, 'U3SdTCwHz28K', '987456', '24-01-2023', '24-02-2023', 'Avatar Movie Ticket', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card_request`
--
ALTER TABLE `card_request`
  ADD PRIMARY KEY (`card_request_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `api_id` (`api_id`);

--
-- Indexes for table `uvi_card_user`
--
ALTER TABLE `uvi_card_user`
  ADD PRIMARY KEY (`card_user_id`);

--
-- Indexes for table `validator`
--
ALTER TABLE `validator`
  ADD PRIMARY KEY (`validator_id`),
  ADD KEY `api_id_constraint` (`api_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card_request`
--
ALTER TABLE `card_request`
  MODIFY `card_request_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uvi_card_user`
--
ALTER TABLE `uvi_card_user`
  MODIFY `card_user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `validator`
--
ALTER TABLE `validator`
  MODIFY `validator_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
