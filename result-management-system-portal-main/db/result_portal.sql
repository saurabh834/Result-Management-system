-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2023 at 10:36 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `result_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `course_entry` tinyint(1) NOT NULL DEFAULT 1,
  `marks_entry` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`course_entry`, `marks_entry`) VALUES
(0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `fac_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject_chosen` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`fac_id`, `name`, `email`, `subject_chosen`) VALUES
('1', 'mayank', 'mayank@gmail.com', 0),
('2', 'ashish', 'ashish@gmail.com', 1),
('3', 'brajesh', 'brajesh@gmail.com', 1),
('4', 'saurabh', 'saurabh@gmail.com', 0),
('5', 'ravi', 'ravi@gmail.com', 1),
('6', 'ranvijay', 'ranvijay@gmail.com', 0),
('7', 'dinesh', 'dinesh@gmail.com', 0),
('8', 'anil', 'anil@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `marks_lab`
--

CREATE TABLE `marks_lab` (
  `subject_id` varchar(255) NOT NULL,
  `roll` varchar(255) NOT NULL,
  `sem` varchar(255) NOT NULL,
  `s1` varchar(255) NOT NULL,
  `s2` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `total` int(255) NOT NULL,
  `grade` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `marks_lab`
--

INSERT INTO `marks_lab` (`subject_id`, `roll`, `sem`, `s1`, `s2`, `score`, `total`, `grade`) VALUES
('cs-15201', '20205017', '5', '42', '16', 14, 20, 'B'),
('cs-15202', '20205017', '5', '19', '19', 8, 20, 'D'),
('cs-15203', '20205017', '5', '19', '19', 8, 20, 'D'),
('cs-15204', '20205017', '5', '19', '19', 8, 20, 'D'),
('CS-15202', '20208014', '6', '55', '12', 16, 20, 'B+');

-- --------------------------------------------------------

--
-- Table structure for table `marks_theory`
--

CREATE TABLE `marks_theory` (
  `subject_id` varchar(255) NOT NULL,
  `roll` varchar(255) NOT NULL,
  `sem` varchar(255) NOT NULL,
  `s1` varchar(255) NOT NULL,
  `s2` varchar(255) NOT NULL,
  `s3` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `total` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `marks_theory`
--

INSERT INTO `marks_theory` (`subject_id`, `roll`, `sem`, `s1`, `s2`, `s3`, `score`, `total`, `grade`) VALUES
('CS-13101', '20201566', '3', '19', '19', '19', 21, '30', 'B'),
('CS-13101', '20201567', '3', '16', '16', '16', 18, '30', 'C'),
('cs-15101', '20205017', '5', '42', '16', '13', 24, '30', 'B+'),
('cs-15102', '20205017', '5', '16', '19', '16', 24, '40', 'C'),
('cs-15103', '20205017', '5', '19', '20', '16', 28, '40', 'B'),
('cs-15104', '20205017', '5', '16', '19', '19', 18, '30', 'C'),
('cs-15105', '20205017', '5', '52', '16', '16', 36, '40', 'A'),
('cs-15106', '20205017', '5', '18', '19', '19', 21, '30', 'B'),
('CS-15102', '20208014', '6', '55', '12', '13', 36, '40', 'A'),
('cs-15104', '20208019', '5', '42', '16', '16', 24, '30', 'B+'),
('cs-13103', '20209122', '3', '45', '20', '16', 27, '30', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `roll` varchar(255) NOT NULL,
  `sem` int(11) NOT NULL,
  `spi` double NOT NULL,
  `credits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`roll`, `sem`, `spi`, `credits`) VALUES
('20205017', 5, 6.5172413793103, 29);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `name` varchar(255) NOT NULL,
  `roll` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `programme` varchar(255) NOT NULL,
  `sem` int(11) NOT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`name`, `roll`, `email`, `programme`, `sem`, `blocked`) VALUES
('dsd', '20201566', 's@gmail.com', 'btech', 3, 0),
('sdfs', '20201567', 'ef@gmail.com', 'btech', 3, 0),
('asdf', '20204236', 'asdf@gmail.com', 'mtech', 3, 0),
('sohan', '20205016', 'sohan@gmail.com', 'btech', 5, 0),
('daksh', '20205017', 'daksh@gmail.com', 'btech', 5, 0),
('suresh', '20205018', 'suresh@gmail.com', 'btech', 7, 0),
('Amar', '20208014', 'amar@gmail.com', 'btech', 7, 1),
('chetan', '20209122', 'chetan@gmail.com', 'mtech', 3, 0),
('xyz', '20209123', 'xyz@gmail.com', 'mtech', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` varchar(255) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `fac_id` varchar(255) DEFAULT NULL,
  `credits` int(11) NOT NULL,
  `type` enum('l','t') NOT NULL,
  `sem` tinyint(4) DEFAULT NULL,
  `marks_entered` tinyint(1) NOT NULL DEFAULT 0,
  `programme` enum('btech','mtech') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_id`, `s_name`, `fac_id`, `credits`, `type`, `sem`, `marks_entered`, `programme`) VALUES
('a1', 'qw', '6', 4, 't', 3, 0, 'mtech'),
('a2', 'er', '6', 4, 't', 3, 0, 'mtech'),
('a3', 'tt', '6', 4, 't', 3, 0, 'mtech'),
('a4', 'qw lab', '6', 4, 'l', 3, 0, 'mtech'),
('a5', 'er lab', '6', 4, 'l', 3, 0, 'mtech'),
('a6', 'tt lab', '6', 4, 'l', 3, 0, 'mtech'),
('CS-13101', 'dsa ', '1', 3, 't', 3, 0, 'btech'),
('CS-13102', 'oops', '1', 3, 't', 3, 0, 'btech'),
('CS-13103', 'moit', '2', 3, 't', 3, 0, 'btech'),
('CS-15101', 'microprocessor', '2', 3, 't', 5, 0, 'btech'),
('CS-15102', 'operating systems', '2', 4, 't', 5, 0, 'btech'),
('CS-15103', 'databse management systems', '2', 4, 't', 5, 0, 'btech'),
('CS-15104', 'operation reasearch', '2', 3, 't', 5, 0, 'btech'),
('CS-15105', 'ooms', '2', 4, 't', 5, 0, 'btech'),
('CS-15106', 'computer architecture', '2', 3, 't', 5, 0, 'btech'),
('CS-15201', 'programmning tools -ii ', '2', 2, 'l', 5, 0, 'btech'),
('CS-15202', 'microprocessor', '2', 2, 'l', 5, 0, 'btech'),
('CS-15203', 'operating systems', '2', 2, 'l', 5, 0, 'btech'),
('CS-15204', 'databse systems', '2', 2, 'l', 5, 0, 'btech'),
('CS-16101', 'Embedded sysyem', '7', 3, 't', 6, 0, 'btech'),
('CS-16102', 'compiler construction', '7', 3, 't', 6, 0, 'btech'),
('CS-16103', 'data mining ', '8', 3, 't', 6, 0, 'btech'),
('CS-16202', 'data mining lab', '7', 2, 'l', 6, 0, 'btech'),
('CS-16204', 'network lab', '8', 2, 'l', 6, 0, 'btech');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`fac_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `marks_lab`
--
ALTER TABLE `marks_lab`
  ADD UNIQUE KEY `roll` (`roll`,`subject_id`);

--
-- Indexes for table `marks_theory`
--
ALTER TABLE `marks_theory`
  ADD PRIMARY KEY (`roll`,`subject_id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`roll`,`sem`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`roll`),
  ADD UNIQUE KEY `roll` (`roll`,`email`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
