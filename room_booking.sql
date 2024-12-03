-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 09:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `room_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `room_id` int(255) NOT NULL,
  `start_time` datetime(6) NOT NULL,
  `end_time` datetime(6) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(10) UNSIGNED NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `capacity` int(10) UNSIGNED NOT NULL,
  `equipment` varchar(255) DEFAULT NULL,
  `room_department` varchar(255) NOT NULL,
  `room_floor` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `room_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`, `capacity`, `equipment`, `room_department`, `room_floor`, `status`, `room_type`) VALUES
(1, 'ITCS-101', 50, 'Projector, Whiteboard', 'ITCS', 1, 'available', 'Lecture Room'),
(2, 'ITCE-202', 30, 'Computers, Lab Equipment', 'ITCE', 2, 'occupied', 'Computer Lab'),
(3, 'ITIS-303', 20, 'TV Screen, Conference Table', 'ITIS', 3, 'unavailable', 'Meeting Room'),
(4, 'ITCS-104', 50, 'Projector, Whiteboard', 'ITCS', 1, 'occupied', 'Lecture Room'),
(5, 'ITCE-205', 30, 'Computers, Lab Equipment', 'ITCE', 2, 'available', 'Computer Lab'),
(6, 'ITIS-306', 20, 'TV Screen, Conference Table', 'ITIS', 3, 'occupied', 'Meeting Room'),
(7, 'ITCS-107', 50, 'Projector, Whiteboard', 'ITCS', 1, 'unavailable', 'Lecture Room'),
(8, 'ITCE-208', 30, 'Computers, Lab Equipment', 'ITCE', 2, 'occupied', 'Computer Lab'),
(9, 'ITIS-309', 20, 'TV Screen, Conference Table', 'ITIS', 3, 'available', 'Meeting Room'),
(10, 'ITCS-110', 50, 'Projector, Whiteboard', 'ITCS', 1, 'available', 'Lecture Room'),
(11, 'ITCE-211', 30, 'Computers, Lab Equipment', 'ITCE', 2, 'unavailable', 'Computer Lab'),
(12, 'ITIS-312', 20, 'TV Screen, Conference Table', 'ITIS', 3, 'occupied', 'Meeting Room'),
(13, 'ITCS-113', 50, 'Projector, Whiteboard', 'ITCS', 1, 'occupied', 'Lecture Room'),
(14, 'ITCE-214', 30, 'Computers, Lab Equipment', 'ITCE', 2, 'available', 'Computer Lab'),
(15, 'ITIS-315', 20, 'TV Screen, Conference Table', 'ITIS', 3, 'available', 'Meeting Room'),
(16, 'ITCS-116', 50, 'Projector, Whiteboard', 'ITCS', 1, 'unavailable', 'Lecture Room'),
(17, 'ITCE-217', 30, 'Computers, Lab Equipment', 'ITCE', 2, 'occupied', 'Computer Lab'),
(18, 'ITIS-318', 20, 'TV Screen, Conference Table', 'ITIS', 3, 'unavailable', 'Meeting Room'),
(19, 'ITCS-119', 50, 'Projector, Whiteboard', 'ITCS', 1, 'available', 'Lecture Room'),
(20, 'ITCE-220', 30, 'Computers, Lab Equipment', 'ITCE', 2, 'unavailable', 'Computer Lab');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` enum('Admin','User') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `account_type`) VALUES
(1, 'try1', '202204567@stu.uob.edu.bh', '$2y$10$KluO0AzejvAsfmu1ximp7.kfrcVFvyQ1stviAYGLcJioNFIiF4zmW', 'User'),
(2, 'ahmed', '202207890@stu.uob.edu.bh', '$2y$10$juDLQtZtxR4UJ/60KrWrS.n6bGrvqis8.w/cb.vgChUF9Hac22mNS', 'User'),
(3, '1234', '202201234@stu.uob.edu.bh', '$2y$10$7N8Ohyjuvpywx/p/rW9aMOdkp8Rw8oOR0ErkwatcCgSgU/R.ncx9q', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
