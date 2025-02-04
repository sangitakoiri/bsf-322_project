-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2025 at 04:02 AM
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
-- Database: `employee1`
--

-- --------------------------------------------------------

--
-- Table structure for table `emprecord`
--

CREATE TABLE `emprecord` (
  `regt_no` varchar(9) NOT NULL,
  `rank` varchar(15) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` text DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `service` text DEFAULT NULL,
  `unit` varchar(15) DEFAULT NULL,
  `ame_details` varchar(15) DEFAULT NULL,
  `ame_date` date DEFAULT NULL,
  `category` varchar(20) DEFAULT NULL,
  `lmc` varchar(10) DEFAULT NULL,
  `lmc_date` date DEFAULT NULL,
  `duration` varchar(20) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `percentage_disability` float DEFAULT NULL,
  `category_after_lmc` varchar(20) DEFAULT NULL,
  `diseases` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emprecord`
--

INSERT INTO `emprecord` (`regt_no`, `rank`, `name`, `dob`, `age`, `doj`, `service`, `unit`, `ame_details`, `ame_date`, `category`, `lmc`, `lmc_date`, `duration`, `due_date`, `percentage_disability`, `category_after_lmc`, `diseases`) VALUES
('231603823', 'M/CT', 'Sangita Koiri', '1996-10-05', '28 years, 3 months, 30 days', '2022-12-21', '2 years, 1 months, 14 days', '66 BN BSF', 'Done', '2024-10-29', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '0', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
('19147673', 'DIG', 'Ashutosh Sharma', '1967-03-29', '57 years, 10 months, 6 days', '1991-12-09', '33 years, 1 months, 26 days', 'SHQ DBR', 'Done', '2024-05-01', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
('19771892', 'CMO(SG)', 'Dr.Rohit Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
