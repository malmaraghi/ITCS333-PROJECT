-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 04:50 PM
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
(1, 'ITCS-1001', 18, 'Projector, Whiteboard, Air Conditioner', 'ITCS', 1, 'Available', 'Meeting Room'),
(2, 'ITCS-1002', 50, 'Computers, Air Conditioner', 'ITCS', 1, 'Occupied', 'Computer Lab'),
(3, 'ITCS-1003', 22, 'Whiteboard, Speakers', 'ITCS', 1, 'Unavailable', 'Lecture Room'),
(4, 'ITCS-1004', 50, 'Projector, Computers', 'ITCS', 1, 'Available', 'Computer Lab'),
(5, 'ITCS-2001', 18, 'Whiteboard, Air Conditioner', 'ITCS', 2, 'Occupied', 'Meeting Room'),
(6, 'ITCS-2002', 50, 'Computers, Speakers', 'ITCS', 2, 'Available', 'Computer Lab'),
(7, 'ITCS-2003', 22, 'Projector, Air Conditioner', 'ITCS', 2, 'Unavailable', 'Lecture Room'),
(8, 'ITCS-2004', 18, 'Whiteboard, Projector', 'ITCS', 2, 'Occupied', 'Meeting Room'),
(9, 'ITCS-3001', 22, 'Speakers, Whiteboard', 'ITCS', 3, 'Available', 'Lecture Room'),
(10, 'ITCS-3002', 50, 'Computers, Air Conditioner', 'ITCS', 3, 'Unavailable', 'Computer Lab'),
(11, 'ITCS-3003', 18, 'Projector, Whiteboard', 'ITCS', 3, 'Occupied', 'Meeting Room'),
(12, 'ITCS-3004', 22, 'Whiteboard, Projector', 'ITCS', 3, 'Available', 'Lecture Room'),
(13, 'ITCS-1005', 50, 'Computers, Projector', 'ITCS', 1, 'Available', 'Computer Lab'),
(14, 'ITCS-1006', 22, 'Speakers, Air Conditioner', 'ITCS', 1, 'Unavailable', 'Lecture Room'),
(15, 'ITCS-1007', 18, 'Whiteboard, Air Conditioner', 'ITCS', 1, 'Occupied', 'Meeting Room'),
(16, 'ITCS-1008', 22, 'Projector, Whiteboard', 'ITCS', 1, 'Available', 'Lecture Room'),
(17, 'ITCS-2005', 50, 'Computers, Whiteboard', 'ITCS', 2, 'Available', 'Computer Lab'),
(18, 'ITCS-2006', 18, 'Whiteboard, Projector', 'ITCS', 2, 'Occupied', 'Meeting Room'),
(19, 'ITCS-2007', 50, 'Computers, Air Conditioner', 'ITCS', 2, 'Unavailable', 'Computer Lab'),
(20, 'ITCS-2008', 22, 'Projector, Speakers', 'ITCS', 2, 'Available', 'Lecture Room'),
(21, 'ITCS-3005', 22, 'Whiteboard, Air Conditioner', 'ITCS', 3, 'Occupied', 'Lecture Room'),
(22, 'ITCS-3006', 50, 'Computers, Projector', 'ITCS', 3, 'Available', 'Computer Lab'),
(23, 'ITCS-3007', 18, 'Projector, Whiteboard', 'ITCS', 3, 'Unavailable', 'Meeting Room'),
(24, 'ITCS-3008', 50, 'Computers, Speakers', 'ITCS', 3, 'Occupied', 'Computer Lab'),
(25, 'ITIS-1001', 18, 'Projector, Whiteboard, Air Conditioner', 'ITIS', 1, 'Available', 'Meeting Room'),
(26, 'ITIS-1002', 22, 'Whiteboard, Speakers', 'ITIS', 1, 'Occupied', 'Lecture Room'),
(27, 'ITIS-1003', 50, 'Computers, Air Conditioner', 'ITIS', 1, 'Unavailable', 'Computer Lab'),
(28, 'ITIS-1004', 22, 'Projector, Air Conditioner', 'ITIS', 1, 'Available', 'Lecture Room'),
(29, 'ITIS-2001', 18, 'Whiteboard, Projector', 'ITIS', 2, 'Occupied', 'Meeting Room'),
(30, 'ITIS-2002', 50, 'Computers, Speakers', 'ITIS', 2, 'Available', 'Computer Lab'),
(31, 'ITIS-2003', 22, 'Projector, Whiteboard', 'ITIS', 2, 'Unavailable', 'Lecture Room'),
(32, 'ITIS-2004', 50, 'Computers, Air Conditioner', 'ITIS', 2, 'Available', 'Computer Lab'),
(33, 'ITIS-3001', 22, 'Whiteboard, Projector', 'ITIS', 3, 'Occupied', 'Lecture Room'),
(34, 'ITIS-3002', 50, 'Computers, Whiteboard', 'ITIS', 3, 'Available', 'Computer Lab'),
(35, 'ITIS-3003', 18, 'Whiteboard, Air Conditioner', 'ITIS', 3, 'Unavailable', 'Meeting Room'),
(36, 'ITIS-3004', 22, 'Projector, Speakers', 'ITIS', 3, 'Occupied', 'Lecture Room'),
(37, 'ITIS-1005', 50, 'Computers, Projector', 'ITIS', 1, 'Available', 'Computer Lab'),
(38, 'ITIS-1006', 18, 'Projector, Whiteboard', 'ITIS', 1, 'Occupied', 'Meeting Room'),
(39, 'ITIS-1007', 22, 'Speakers, Whiteboard', 'ITIS', 1, 'Unavailable', 'Lecture Room'),
(40, 'ITIS-1008', 50, 'Computers, Air Conditioner', 'ITIS', 1, 'Available', 'Computer Lab'),
(41, 'ITIS-2005', 18, 'Whiteboard, Air Conditioner', 'ITIS', 2, 'Occupied', 'Meeting Room'),
(42, 'ITIS-2006', 50, 'Computers, Speakers', 'ITIS', 2, 'Unavailable', 'Computer Lab'),
(43, 'ITIS-2007', 22, 'Projector, Air Conditioner', 'ITIS', 2, 'Available', 'Lecture Room'),
(44, 'ITIS-2008', 50, 'Computers, Whiteboard', 'ITIS', 2, 'Occupied', 'Computer Lab'),
(45, 'ITIS-3005', 18, 'Projector, Whiteboard', 'ITIS', 3, 'Available', 'Meeting Room'),
(46, 'ITIS-3006', 50, 'Computers, Air Conditioner', 'ITIS', 3, 'Unavailable', 'Computer Lab'),
(47, 'ITIS-3007', 22, 'Whiteboard, Projector', 'ITIS', 3, 'Occupied', 'Lecture Room'),
(48, 'ITIS-3008', 50, 'Computers, Speakers', 'ITIS', 3, 'Available', 'Computer Lab'),
(49, 'ITCE-1001', 22, 'Projector, Whiteboard, Air Conditioner', 'ITCE', 1, 'Available', 'Lecture Room'),
(50, 'ITCE-1002', 50, 'Computers, Speakers', 'ITCE', 1, 'Unavailable', 'Computer Lab'),
(51, 'ITCE-1003', 18, 'Whiteboard, Air Conditioner', 'ITCE', 1, 'Occupied', 'Meeting Room'),
(52, 'ITCE-1004', 22, 'Whiteboard, Projector', 'ITCE', 1, 'Available', 'Lecture Room'),
(53, 'ITCE-2001', 50, 'Computers, Air Conditioner', 'ITCE', 2, 'Occupied', 'Computer Lab'),
(54, 'ITCE-2002', 22, 'Projector, Speakers', 'ITCE', 2, 'Available', 'Lecture Room'),
(55, 'ITCE-2003', 18, 'Whiteboard, Air Conditioner', 'ITCE', 2, 'Unavailable', 'Meeting Room'),
(56, 'ITCE-2004', 50, 'Computers, Whiteboard', 'ITCE', 2, 'Occupied', 'Computer Lab'),
(57, 'ITCE-3001', 22, 'Speakers, Projector', 'ITCE', 3, 'Available', 'Lecture Room'),
(58, 'ITCE-3002', 50, 'Computers, Whiteboard', 'ITCE', 3, 'Available', 'Computer Lab'),
(59, 'ITCE-3003', 18, 'Projector, Air Conditioner', 'ITCE', 3, 'Occupied', 'Meeting Room'),
(60, 'ITCE-3004', 50, 'Computers, Air Conditioner', 'ITCE', 3, 'Occupied', 'Computer Lab'),
(61, 'ITCE-1005', 18, 'Whiteboard, Projector', 'ITCE', 1, 'Available', 'Meeting Room'),
(62, 'ITCE-1006', 50, 'Computers, Projector', 'ITCE', 1, 'Unavailable', 'Computer Lab'),
(63, 'ITCE-1007', 22, 'Projector, Whiteboard', 'ITCE', 1, 'Occupied', 'Lecture Room'),
(64, 'ITCE-1008', 50, 'Computers, Air Conditioner', 'ITCE', 1, 'Available', 'Computer Lab'),
(65, 'ITCE-2005', 22, 'Whiteboard, Air Conditioner', 'ITCE', 2, 'Unavailable', 'Lecture Room'),
(66, 'ITCE-2006', 50, 'Computers, Projector', 'ITCE', 2, 'Occupied', 'Computer Lab'),
(67, 'ITCE-2007', 22, 'Whiteboard, Speakers', 'ITCE', 2, 'Available', 'Lecture Room'),
(68, 'ITCE-2008', 50, 'Computers, Air Conditioner', 'ITCE', 2, 'Available', 'Computer Lab'),
(69, 'ITCE-3005', 22, 'Projector, Whiteboard', 'ITCE', 3, 'Occupied', 'Lecture Room'),
(70, 'ITCE-3006', 50, 'Computers, Air Conditioner', 'ITCE', 3, 'Available', 'Computer Lab'),
(71, 'ITCE-3007', 18, 'Whiteboard, Projector', 'ITCE', 3, 'Unavailable', 'Meeting Room'),
(72, 'ITCE-3008', 50, 'Computers, Speakers', 'ITCE', 3, 'Occupied', 'Computer Lab');

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
  MODIFY `booking_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
