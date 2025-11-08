-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2025 at 03:33 AM
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
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `author` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `publication_year` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `isbn` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `availability_status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `publication_year`, `isbn`, `category_id`, `availability_status`, `created_at`, `updated_at`) VALUES
(1, 'The Great Gatsby', 'F. Scott Fitzgerald', '1925', '9780743273565', 1, 1, '2025-10-16 17:19:06', NULL),
(2, 'A Brief History of Time', 'Stephen Hawking', '1988', '9780553380163', 3, 1, '2025-10-16 17:19:06', NULL),
(3, 'Clean Code', 'Robert C. Martin', '2008', '9780132350884', 4, 1, '2025-10-16 17:19:06', NULL),
(4, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', '2011', '9780062316097', 5, 1, '2025-10-16 17:19:06', NULL),
(5, 'The Art of War', 'Sun Tzu', '500 BC', '9781599869773', 5, 1, '2025-10-16 17:19:06', NULL),
(6, 'Calculus Made Easy', 'Silvanus P. Thompson', '1910', '9780312185480', 6, 1, '2025-10-16 17:19:06', NULL),
(7, 'The Story of Art', 'E.H. Gombrich', '1950', '9780714832470', 7, 0, '2025-10-16 17:19:06', '2025-10-16 17:30:10'),
(8, 'Steve Jobs', 'Walter Isaacson', '2011', '9781451648539', 8, 0, '2025-10-16 17:19:06', '2025-11-07 18:26:44'),
(9, 'The Avengers: Origins', 'Marvel Comics', '2012', '9780785153799', 9, 1, '2025-10-16 17:19:06', '2025-10-17 18:37:00'),
(11, 'Power of Money', 'Deepak', '2025', '186286', 10, 1, '2025-11-07 01:38:11', NULL),
(12, 'Atomic Habit', 'Atom Bhai', '2025', '8009', 10, 1, '2025-11-07 01:39:27', '2025-11-07 01:59:32');

-- --------------------------------------------------------

--
-- Table structure for table `books_loan`
--

CREATE TABLE `books_loan` (
  `id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `loan_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `is_return` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books_loan`
--

INSERT INTO `books_loan` (`id`, `book_id`, `student_id`, `loan_date`, `return_date`, `is_return`, `created_at`, `updated_at`) VALUES
(1, 2, 9, '2025-10-02', '2025-10-12', 1, '2025-10-16 17:19:06', '2025-10-17 01:27:46'),
(2, 2, 2, '2025-10-05', '2025-10-15', 1, '2025-10-16 17:19:06', '2025-10-16 17:46:14'),
(4, 4, 4, '2025-09-25', '2025-10-05', 1, '2025-10-16 17:19:06', '2025-10-17 16:20:23'),
(5, 5, 5, '2025-09-30', '2025-10-10', 1, '2025-10-16 17:19:06', NULL),
(6, 6, 6, '2025-10-03', '2025-10-13', 1, '2025-10-16 17:19:06', '2025-10-16 17:51:30'),
(7, 7, 7, '2025-10-02', '2025-10-12', 1, '2025-10-16 17:19:06', '2025-10-17 16:25:34'),
(8, 8, 8, '2025-10-04', '2025-10-14', 1, '2025-10-16 17:19:06', '2025-10-17 16:25:35'),
(12, 7, 10, '2025-10-24', '0121-02-21', 0, '2025-10-18 18:30:00', '2025-10-18 23:05:02'),
(15, 12, 1, '2025-11-08', '2025-11-10', 1, '2025-11-06 18:30:00', '2025-11-07 19:23:37'),
(16, 2, 9, '2025-11-08', '2025-11-11', 1, '2025-11-06 18:30:00', '2025-11-07 02:55:03'),
(17, 6, 2, '2025-11-08', '2025-11-12', 1, '2025-11-06 18:30:00', '2025-11-07 02:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Fiction', '2025-10-16 17:19:06', NULL),
(2, 'Non-Fiction', '2025-10-16 17:19:06', NULL),
(3, 'Science', '2025-10-16 17:19:06', NULL),
(4, 'Technology', '2025-10-16 17:19:06', NULL),
(5, 'History', '2025-10-16 17:19:06', NULL),
(6, 'Mathematics', '2025-10-16 17:19:06', NULL),
(7, 'Art', '2025-10-16 17:19:06', NULL),
(8, 'Biography', '2025-10-16 17:19:06', NULL),
(9, 'Comics', '2025-10-16 17:19:06', NULL),
(10, 'Education', '2025-10-16 17:19:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE `reset_password` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reset_code` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reset_password`
--

INSERT INTO `reset_password` (`id`, `user_id`, `reset_code`, `created_at`) VALUES
(1, 1, '1701', '2025-11-05 12:49:36'),
(2, 1, '9841', '2025-11-05 12:53:14'),
(3, 1, '6715', '2025-11-05 12:57:25'),
(4, 1, '3473', '2025-11-05 13:00:05'),
(5, 1, '5908', '2025-11-05 13:01:32'),
(6, 1, '4960', '2025-11-05 13:02:52'),
(7, 1, '1372', '2025-11-05 13:02:58'),
(8, 1, '8449', '2025-11-05 13:03:04'),
(9, 1, '5043', '2025-11-05 13:03:10'),
(11, 1, '5554', '2025-11-05 13:05:43'),
(12, 1, '5219', '2025-11-05 13:07:26'),
(13, 1, '8495', '2025-11-05 13:15:09'),
(14, 1, '6586', '2025-11-05 13:21:10'),
(15, 1, '1825', '2025-11-06 12:21:30'),
(19, 1, '3366', '2025-11-06 12:27:43'),
(20, 1, '1119', '2025-11-06 12:27:51'),
(21, 1, '1648', '2025-11-06 12:27:58'),
(22, 1, '2595', '2025-11-06 12:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `phone_no` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `phone_no`, `email`, `address`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Amit Sharma', '9876543210', 'amit.sharma@example.com', 'Mumbai, India', '2025-10-16 17:19:06', NULL, 1),
(2, 'Priya Patel', '9823456789', 'priya.patel@example.com', 'Surat, India', '2025-10-16 17:19:06', NULL, 1),
(3, 'Rohan Mehta', '9865321470', 'rohan.mehta@example.com', 'Pune, India', '2025-10-16 17:19:06', NULL, 1),
(4, 'Neha Singh', '9812345678', 'neha.singh@example.com', 'Delhi, India', '2025-10-16 17:19:06', NULL, 1),
(5, 'Karan Joshi', '9887654321', 'karan.joshi@example.com', 'Jaipur, India', '2025-10-16 17:19:06', NULL, 1),
(6, 'Pooja Nair', '9871203456', 'pooja.nair@example.com', 'Kochi, India', '2025-10-16 17:19:06', NULL, 1),
(7, 'Rahul Gupta', '9812233445', 'rahul.gupta@example.com', 'Lucknow, India', '2025-10-16 17:19:06', NULL, 1),
(8, 'Sneha Deshmukh', '9822334455', 'sneha.deshmukh@example.com', 'Nagpur, India', '2025-10-16 17:19:06', NULL, 1),
(9, 'Vikas Yadav', '9899988776', 'vikas.yadav@example.com', 'Noida, India', '2025-10-16 17:19:06', NULL, 1),
(10, 'Anjali Verma', '9811102233', 'anjali.verma@example.com', 'Bhopal, India', '2025-10-16 17:19:06', '2025-10-17 17:13:21', 0),
(12, 'shubham Prajapati Test', '8788093128', 'shubham@gmail.com', 'NSP e', '2025-11-07 02:03:01', '2025-11-07 02:28:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_date` timestamp NULL DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `student_id`, `plan_id`, `start_date`, `end_date`, `amount`, `created_at`, `updated_at`) VALUES
(11, 1, 12, '2025-10-19 15:25:51', '2026-01-19 15:25:51', 799.00, '2025-10-19 15:25:51', NULL),
(12, 5, 2, '2025-11-07 15:30:52', '2025-12-07 15:30:52', 349.00, '2025-11-07 15:30:52', NULL),
(13, 1, 2, '2025-11-07 15:32:12', '2025-12-07 15:32:12', 349.00, '2025-11-07 15:32:12', NULL),
(14, 5, 3, '2025-11-07 15:33:54', '2033-05-07 15:33:54', 499.00, '2025-11-07 15:33:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `duration` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription_plans`
--

INSERT INTO `subscription_plans` (`id`, `title`, `amount`, `duration`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Standard Plan', 349.00, 1, 1, '2025-10-16 17:19:06', '2025-10-18 19:45:07'),
(3, 'Premium Plan', 499.00, 90, 1, '2025-10-16 17:19:06', NULL),
(4, 'Student Plan', 149.00, 30, 1, '2025-10-16 17:19:06', NULL),
(5, 'Family Plan', 799.00, 11, 0, '2025-10-16 17:19:06', '2025-10-19 16:31:10'),
(6, 'Annual Plan', 999.00, 365, 0, '2025-10-16 17:19:06', '2025-10-18 19:27:45'),
(8, 'Gold Plan', 699.00, 180, 0, '2025-10-16 17:19:06', '2025-10-18 19:17:28'),
(11, 'Basic122223', 400.00, 16, 0, '2025-10-17 02:46:10', '2025-11-07 19:59:48'),
(12, 'Family Plan s', 7991.00, 15, 0, '2025-10-18 04:18:48', '2025-11-07 03:01:12'),
(17, '5678', 678.00, 14, 1, '2025-11-07 03:24:22', NULL),
(18, 'Student Plan	', 149.00, 30, 1, '2025-11-07 03:27:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_no`, `password`, `profile_pic`, `created_at`, `updated_at`) VALUES
(1, 'Deepak', 'prajapatideepak10943@gmail.com', '9373035177', '$2y$10$m9zQ9cmCFMebRdJWBFi1O.oovaeEELiuT0WNyyw23KN9vSzfJu8a2', '1762568189_OIP (1).jpg', '2025-10-21 20:02:31', '2025-11-07 21:46:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `books_loan`
--
ALTER TABLE `books_loan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `fk_plan_id` (`plan_id`);

--
-- Indexes for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
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
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `books_loan`
--
ALTER TABLE `books_loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `books_loan`
--
ALTER TABLE `books_loan`
  ADD CONSTRAINT `books_loan_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `books_loan_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `reset_password`
--
ALTER TABLE `reset_password`
  ADD CONSTRAINT `reset_password_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `fk_plan_id` FOREIGN KEY (`plan_id`) REFERENCES `subscription_plans` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
