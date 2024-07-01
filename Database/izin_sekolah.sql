-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 05:55 AM
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
-- Database: `izin_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `user_id`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(31, 28, 'sakit perut', 'approved', '2024-06-06 02:07:13', '2024-06-06 02:07:54'),
(32, 28, 'pergo ke rumah nenek', 'rejected', '2024-06-06 02:07:28', '2024-06-06 02:07:56'),
(33, 28, 'tIDAK masuk', 'pending', '2024-06-06 02:12:30', '2024-06-06 02:12:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `student_id` int(12) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `wali_kelas` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('siswa','guru','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `student_id`, `kelas`, `wali_kelas`, `username`, `password`, `role`) VALUES
(1, 0, '', '', 'admin', '$2y$10$AXdPm.pwNnsFofE1HxTdfe2LhsbDaDzN7SjAM5oujnSeaJEYu83yC', 'admin'),
(27, 10001, 'A1', 'ratna', 'reza', '$2y$10$nuOXxq3RJiVKD/.QRM6yvuLVEzs4M2LMoC/s.fOqeaInUdwEZHrqK', 'siswa'),
(28, 10002, 'A2', 'Ronaldo', 'jeki', '$2y$10$qZ5q40zPEBeKuAd4Yb1hEudw5uDBipuX48AkcNvgUPYrNHGhK9AO6', 'siswa'),
(29, 10003, 'A3', 'barca', 'messi', '$2y$10$pfGfPuZSKnDziLXnII3n9OU1YbOXN8avRJu5fVj1K5akPXuLNGcmm', 'siswa'),
(30, 10005, 'A1', 'hulk', 'bernar', '$2y$10$Z6qsCo/FJhytCq2UTW5oruDRPn03m66DFwG4aiDzp7Mwyob2qQCM.', 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
