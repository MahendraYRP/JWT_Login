-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2023 at 01:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `pin_code` varchar(10) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `phone_number`, `gender`, `address`, `city`, `state`, `pin_code`, `user_id`, `salary`) VALUES
(1, '0000', '00@gmail.com', '000000', 'Male', '123 Street', 'New York', 'NY', '12345', 5, NULL),
(2, '000011', '001@gmail.com', '0000001', 'Male', '123 Street', 'New York', 'NY', '12345', 8, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `empsalary`
--

CREATE TABLE `empsalary` (
  `id` int(11) NOT NULL,
  `Salary` int(11) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `empsalary`
--

INSERT INTO `empsalary` (`id`, `Salary`, `year`, `user_id`) VALUES
(1, 1000, 2050, 8),
(125, 1, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`id`, `name`, `email`, `phone`, `status`, `create_at`) VALUES
(3, 'ram', 'ram@gmail.com', '898687678', 0, '2023-05-29 06:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `name`, `email`, `password`, `create_at`) VALUES
(2, 'Vikas', 'vikas@gamil.com', '$2y$10$D0zmER4DBrCnxfjjon8kI.NIwtFASVIFgFM7AM7OP8gHLSEn/ljz6', '2023-05-30 04:09:39'),
(3, 'ram', 'ram@gamil.com', '$2y$10$dYVFA94gjQ.wRBn6Jt4AZeLMR7rNtj7texUPLOQv7UmixUpMUDVKa', '2023-05-30 04:44:04'),
(4, 'test', 'test@gamil.com', '$2y$10$5.8QNU7Iq1Mv8ttaJ6Vt8OtfD538s8y1AYO1lMmuGkw5YbJMmTGo2', '2023-05-30 05:55:37'),
(5, 'mahendra', 'mahe@gmail.com', '$2y$10$in4cR9mQt2w2gmzqSKatCO5yW0mX8zfntHfKNbBJl8g5uS2NPwKzu', '2023-06-01 03:50:45'),
(8, '1', '1@gmail.com', '$2y$10$bR3jeNMTUA/V2CPpRjCl1.2TdqU3FMpoyFsO5iQRWYU4o4dP.pAGS', '2023-06-02 05:12:09'),
(9, '12345', '12345@gmail.com', '$2y$10$ML7c.fh0rg4bLICoC/2E5ORve55DmckudC7LKxfMFrK/mK8Sf0NjO', '2023-06-05 09:59:01'),
(10, '1234', '1245@gmail.com', '$2y$10$TkV5s0ZNq6j.yfAHwX0ibOdTzVO.czLtE4JHnom7O2to4SuXu/Daa', '2023-06-05 09:59:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `empsalary`
--
ALTER TABLE `empsalary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empsalary_ibfk_1` (`user_id`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `empsalary`
--
ALTER TABLE `empsalary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`id`);

--
-- Constraints for table `empsalary`
--
ALTER TABLE `empsalary`
  ADD CONSTRAINT `empsalary_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
