-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 07:01 PM
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

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `room_id`, `start_time`, `end_time`, `status`) VALUES
(12, 4, 10, '2024-12-10 08:43:00.000000', '2024-12-10 09:43:00.000000', '');

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
(3, 'ITIS-303', 20, 'TV Screen, Conference Table', 'ITIS', 1, 'unavailable', 'Lecture Room'),
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
  `phone_number` varchar(20) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Contact` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` enum('Admin','User') NOT NULL,
  `comments` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `phone_number`, `picture`, `email`, `Contact`, `password`, `account_type`, `comments`) VALUES
(1, 'try1', '', '/test/IMG-test.jpg', '202204567@stu.uob.edu.bh', '', '$2y$10$KluO0AzejvAsfmu1ximp7.kfrcVFvyQ1stviAYGLcJioNFIiF4zmW', 'User', ''),
(2, 'ahmed', '', '/uploads/IMG-test.jpg', '202207890@stu.uob.edu.bh', '', '$2y$10$juDLQtZtxR4UJ/60KrWrS.n6bGrvqis8.w/cb.vgChUF9Hac22mNS', 'User', ''),
(3, 'Mahmood', '34326492', 'uploads/IMG-67528879702244.32288376.jpg', '202209657@stu.uob.edu.bh', 'ggvbvh@gmail.com', '$2y$10$jKD/S.yzYasdfxN03.xlSuLemPYOfnUEk77cF64Nez4WnXOK5yesK', 'User', '1'),
(4, '1234', '', '', '202201234@stu.uob.edu.bh', '', '$2y$10$Di6HC2PU2K1GkaxRjirFr.1g1JhNgRlJBl2MK3Ldm8RbpmB/3zyIC', 'User', ''),
(5, '5678', '', '', '202205678@stu.uob.edu.bh', '', '$2y$10$9t49OA3dywIxTjpoT7kC7.oEkWcw2LEeT6U5wFrIV1ruSHlgb9vkm', 'User', ''),
(6, 'admin', '', '', '202209000@uob.edu.bh', '', '$2y$10$A9hDX39kJtlYIi7/Y0fz4.sA3hxPvqVMq.E0/aDWuPc3sAPMo5QyG', 'Admin', '');

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
  MODIFY `booking_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
