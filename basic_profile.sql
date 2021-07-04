-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2021 at 12:55 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mysql`
--

-- --------------------------------------------------------

--
-- Table structure for table `basic_profile`
--

CREATE TABLE `basic_profile` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` int(50) NOT NULL,
  `education` varchar(50) NOT NULL,
  `education_level` varchar(50) NOT NULL,
  `industry` varchar(50) NOT NULL,
  `work_experience` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `basic_profile`
--

INSERT INTO `basic_profile` (`id`, `firstname`, `lastname`, `email`, `phone_number`, `education`, `education_level`, `industry`, `work_experience`) VALUES
(141, 'asdas', 'asdasd', 'lasibala24@gmail.com', 2147483647, 'software_engineering', 'diploma', 'qa_qutomation', '6_yrs'),
(172, 'dssad', 'adasd', 'asdad@gmail.com', 2147483647, 'computer_science', 'under_graduate', 'qa_qutomation', '5_yrs'),
(173, 'sadas', 'asdsad', 'thushabala1996@gmail.com', 2147483647, 'computer_science', 'post_graduate', 'qa_qutomation', '5_yrs');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basic_profile`
--
ALTER TABLE `basic_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_basic_profile` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basic_profile`
--
ALTER TABLE `basic_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
