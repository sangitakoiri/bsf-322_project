-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2025 at 04:03 AM
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
-- Table structure for table `management`
--

CREATE TABLE `management` (
  `regt_no` int(11) NOT NULL,
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
-- Dumping data for table `management`
--

INSERT INTO `management` (`regt_no`, `rank`, `name`, `dob`, `age`, `doj`, `service`, `unit`, `ame_details`, `ame_date`, `category`, `lmc`, `lmc_date`, `duration`, `due_date`, `percentage_disability`, `category_after_lmc`, `diseases`) VALUES
(61542, 'HC/Otrp', 'Ram Ratan Yadav', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(102016, 'HC/VM', 'Shyamal  Sarkar', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1015115, 'HC/Fiter', 'N. Selva Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1460166, 'ASI/RO', 'Uttam Bardhan', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2115739, 'SI(RO)', 'Dulal Goyary', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8001759, 'CT', 'Namudra Nath', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-01-12', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', 'Upgraded to SHAPE-1 by BSF Medical Board on date 30/10/23'),
(10027112, 'ASI(RO)', 'Ashutosh Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10099331, 'HC/Dvr', 'Chandra Shekhar', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11005856, 'DC (G)', 'Sandeep Saurabh', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11323570, 'AC/OPS', 'Dipankar Deka', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12348220, 'AC(Elect)', 'Ramkesh Meena', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12348442, 'AC/Vet', 'Raman Yadav', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15553348, 'HC/GD', 'Samir Sonowal', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18660010, 'SI/RM', 'Ramesh Kumar', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-03-24', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(19147673, 'DIG', 'Ashutosh Sharma', '1967-03-29', '57 Years 10 Months 6 Days', '1991-12-09', '33 Years 1 Months 26 Days', 'SHQ DBR', 'Not Done', '2025-01-01', 'S,H,A,P,E,G', 'No', '0000-00-00', '0', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(19565996, 'Comdt', 'Shailesh Kumar Sinha', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19771892, 'Comdt/CMO', 'Dr.Rohit Kumar', '1970-05-01', '54 Years 9 Months 3 Days', '1997-10-15', '27 Years 3 Months 20 Days', 'SHQ DBR', 'Not Done', '2025-01-01', 'S,H,A,P,E,G', 'No', '0000-00-00', '0', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(19977003, '2IC (Comn)', 'Sanjay Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20052108, 'HC/VM', 'Mukesh Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21468050, 'CT/GD', 'Binu G', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-03-20', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(22545444, 'SI(STENO)', 'Pramod Kumar Chaturvedi', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24018078, 'CT', 'Rajiv Kumar', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-02-06', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(35441962, 'CT/BP DVR', 'Sanjoy Nath', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35442721, 'CT(Vig)', 'Hari Chnad Boro', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40899084, 'DC/MT', 'Gouri Shankar Bhardwaj', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41109380, 'DC(G)', 'Prem Singh Kandiyal', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41460366, 'CT', 'P.Ariavalagam', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-02-06', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(41465811, 'CT/Dvr', 'P Suresh', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41735848, 'AC (Works)', 'Subhash Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41980028, 'HC/WC', 'Bhola Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42347583, 'AC(Min)', 'Jai Kumar Thakan', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43653270, 'SI/Vig', 'Shene Kishore Ashok Rao', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49770529, 'HC(RO)', 'Maznu Parmanik', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50006018, 'HC/UPH', 'Bhagwan Ji', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50026436, 'ASI(RM)', 'Md Shamin Ahmed', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50065367, 'CT/ BP DVR', 'Dhurba Jyoti Baruah', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50085042, 'CT', 'Yazuddin Saikh', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-03-20', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(50087040, 'CT', 'Simanta Das', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-02-24', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(50091256, 'CT/VM', 'V. Jyoti Basu', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60065427, 'Inspr/G', 'Karna Kanta Majumdar', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60077848, 'SI(Min)', 'Om Prakash Dubey', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60093217, 'ASI/Min', 'Ragupathi M', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64444400, 'ASI(RO', 'Shailendra Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67220403, 'CT/GD', 'Jagannath Soren', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70090626, 'ASI/RO', 'Gwmsat Basumotary', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-03-01', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(70095250, 'HC/RM', 'Pankaj Medhi', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-03-20', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(71091288, 'CT/G', 'Nabendu Barua', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71281322, 'CT/GD', 'Kamal Baruah', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80090616, 'ASI(RO)', 'Ravinder Nath', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81830482, 'CT/BP DVR', 'Bhubaneswar Gupta', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86662673, 'CT/BP DVR', 'Niranjan Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86666192, 'CT/BP DVR', 'Malchand Sukariya', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90078109, 'ASI/Min', 'Mohd Siraj Ansari', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-03-01', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(90079083, 'ASI/Min', 'Ajay Kumar', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-02-07', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(91221498, 'CT/Otrp', 'Sunny Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94991093, 'HC/RO', 'Bhola Kumar', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-02-04', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', 'Advice to reduce body weight by 5 Kg by diet control and exercise'),
(100091799, 'Inspr(G)', 'Awanish Pandey', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(108090264, 'CT/GD', 'Sanjay Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(110411655, 'CT/WEL', 'Sijith L', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(110504663, 'HC/SKT', 'Pankaj Kumar Mishra', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-01-02', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(111280043, 'CT/Fitter', 'Shashi Ranjan', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(111360215, 'CT/GD', 'N Ranjit Singh', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(111410042, 'ASI/Min', 'Gurdeep Singh', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(111941038, 'HC/RO', 'Gobinda Majhi', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(113601824, 'ASI (RO)', 'Aron Kumar Brahma', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(114501637, 'CT/GD', 'K K Tripathi', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120300747, 'ASI/Steno', 'Asish Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120301117, 'CT/Uph', 'Chander Pal', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120406184, 'CT/Dvr', 'Sandeep Singh', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120513271, 'CT/BS', 'Raman Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120698280, 'CT', 'Gopal Lal Gurjar', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-03-21', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(120801839, 'CT', 'Suman Barman', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-02-06', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(120805543, 'CT/BP DVR', 'Israfill Shekh', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120915284, 'CT/AE', 'Pallab Paul', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(121109279, 'CT/BP DVR', 'Pulakesh Shaikiya', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(121109376, 'CT/G           ', 'Manas Jyoti Gogoi', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(121296450, 'CT/GD', 'Th Subhachandra Meitei', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(121302025, 'ASI(Min)', 'Sanjay Kumar Sharma', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(123203223, 'CT/GD', 'Kamlesh Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(123511487, 'INSPR(G)', 'Kathula Jayavardhan', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(124401293, 'HC/RO', 'Ram Pravesh Yadav', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-03-22', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(130406147, 'Inspr/JE(Civil)', 'Kishore Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(130819156, 'CT/GD', 'Manbendar Das', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(130850287, 'CT/GD', 'Arup Sikdar', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(133504273, 'Inspr(G)', 'Jitendra Kumar Gope', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(134203140, 'ASI(RM)', 'Pintu Lal Meena', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(134500548, 'CT/GD', 'Rajeev Kumar', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-03-20', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(140601778, 'INSPR/JE', 'Ravi Kumar', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-03-19', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(141504737, 'CT/GD', 'Michael Raj', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(143901749, 'M/CT', 'K. Reshma Jha', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(144507036, 'CT/GD', 'Pawan Kr Sharma', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(153505021, 'CT/GD', 'Fakeerappa DR', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(154200901, 'HC/RO', 'Biplab Mahato', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(170400079, 'HC/Tech', 'Vikash Kumar', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-03-21', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(170534464, 'ASI/VET', 'Anil Kumar Raigar', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(170812919, 'M/CT', 'Rakhi  Karjee', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(171002476, 'CT/G', 'Raushan Raaz', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(171300794, 'CT/GD', 'Santosh Kumar Jamatia', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(171622377, 'M/CT', 'Priyanka Hazarika', '1990-11-24', '34 years, 2 months, 11 days', '2017-05-15', '7 years, 8 months, 20 days', '31 BN BSF', 'Done', '2024-12-06', 'S1,H1,A3,P1,E1,G1', 'Yes', '2024-09-17', '24', '2025-03-04', 0, 'S1,H1,A3,P1,E1,G1', ''),
(183100850, 'SI/G', 'Hrishikesh Karjee', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-01-04', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(183104360, 'SI/G', 'Gautam', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(231603823, 'M/CT', 'Sangita Koiri', '1996-10-05', '28 years, 3 months, 30 days', '2022-12-21', '2 years, 1 months, 14 days', '66 BN BSF', 'Done', '2025-01-25', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '0', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(231603911, 'SI/VM', 'Sandeep Chaurasiya', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(231603920, 'CT', 'Manish Kumar', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-04-04', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(231603939, 'CT/VM', 'Patil Rahul Yuvraj', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(231603948, 'CT', 'Deepak Chaurasiya', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-04-04', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(231603957, 'CT/AE', 'Neki Ram Jat', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(231621485, 'CT/Painter', 'Ajay Yadav', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(231621494, 'CT(SKT)', 'Sangram Kumar Rajak', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(241600144, 'CT/GM', 'Mahindra Jandu', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(855660552, 'SI/GD', 'Nirmal Pradeep Surin', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(860004680, 'INSPR', 'Trilok Singh', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-03-24', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(860062569, 'HC/WAITER', 'Uday Singh', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(860650197, 'ASI/GD', 'Dharmendre Kr Nath', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-02-14', 'S1,H1,A2,P3,E1,G', 'Yes', '2024-02-14', NULL, '2026-02-14', 0, 'S1,H1,A2,P3,E1,G', ''),
(861217740, 'SI/GD', 'Naresh Chander Bhaira', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(867110652, 'Inspr(RO)', 'Rajesh Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(868660738, 'INSPR/Tech', 'Anil Kumar Baro', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-03-19', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(869000182, 'CT/WM', 'Taj Mohammad', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-03-21', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(870072273, 'ASI/Vig', 'Mukibur Rahman', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(870073014, 'ASI (G)', 'Upen Chand Boro', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(871108201, 'Inspr(RO)', 'Gokul Chandra Das', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(873322869, 'HC/COOK', 'Kamal Prasad', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(873329419, 'ASI(GD)', 'Rajendra Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(873651594, 'ASI/GD', 'Naresh Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(879330107, 'SI/VM', 'Tapan Ghosh', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(880068376, 'SI/RO', 'Ranjit Shit', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(880073165, 'ASI/GD', 'Siddhartha Shankar Mondal', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(880321424, 'ASI/VIg', 'Dharmpal Singh Negi', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(886110088, 'HC/WM', 'Budhi Bahadur', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(888006956, 'Inspr Tech)', 'Babul Lal', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(890070316, 'SI/AE', 'Tankeswar Choudhary', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-03-19', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(890074598, 'CT/GD', 'Dhayan lal Boro', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-02-10', 'S1,H1,A1,P3,E1,G', 'Yes', '2024-02-10', NULL, '2026-02-10', 0, 'S1,H1,A1,P3,E1,G', ''),
(891517683, 'ASI(G)', 'Ranjit Kumar Roy', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(891632016, 'ASI/GD', 'Nagender Singh Bisht', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(892432219, 'ASI(Vig)', 'Vidur Sharma', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(894013124, 'Inspr(RO)', 'Birendra Pradhan', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(895990316, 'ASI(RO)', 'Karthick Chandra Mondal', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(899440448, 'HC/Carpainter', 'Bimal Sutradhar', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(899880707, 'HC/WEL', 'Aishpal Singh', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(900028452, 'ASI/GD', 'Ashok Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(900048632, 'HC/Armr', 'Ashok Kumar', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-02-07', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(900088083, 'SI(RO)', 'Unnikrishan Nair KN', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(900095311, 'HC/AE ', 'V R Radhakrishna Pillai', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(901921314, 'Inspr/RM', 'Niren Chandra Das', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(910089018, 'Inspr(Min)', 'Rajinder Pal', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(920066247, 'ASI(RO)', 'Din Dayal Ghosh', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(920320057, 'SI(RO)', 'Biswajit Bhowmik', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(921210216, 'SI/SKT', 'Ramkrishna Biswas', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-03-20', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(921430111, 'ASI(RO)', 'Biplab Banerjee', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(924887666, 'HC/GD', 'H P Pillai', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(927330062, 'SI(RO)', 'Ranjit Kumar Baro', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(930060608, 'HC(GD)', 'Sachen Ch. Roy', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(931230006, 'HC', 'Amar Bahadur Bist', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-03-01', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(940067518, 'HC(G)', 'Babla Brahma', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(940067606, 'HC/G', 'Bablu Chandra Roy', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(942541494, 'HC/Vig', 'Satish Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(951064058, 'HC/G', 'Kishore Lal', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(951453739, 'HC/COOK', 'Soumendra Sinha', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(970026819, 'SI/Min', 'Ram Autar Singh', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(970027234, 'Inspr/Min)', 'Anil Kumar Tiwari', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(970090513, 'ASI/Min', 'Anilan Pachiriyan', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(971271993, 'HC', 'Santanu Das', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-03-21', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(971610031, 'ASi(RO)', 'Shashi Bhushan', NULL, NULL, NULL, NULL, 'SHQ DBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(971910056, 'SI/PH', 'Pallab Goswami', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(980052646, 'SI(Min)', 'Rajesh Kumar', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(980094068, 'HC', 'G Gerald Satish Paul', '0000-00-00', '', '0000-00-00', '', 'SHQ DBR', 'Done', '2024-04-05', 'S1,H1,A1,P1,E1,G', 'No', '0000-00-00', '', '0000-00-00', 0, 'S,H,A,P,E,G', ''),
(981110017, 'HC(COB)', 'Achay Kumar Ram', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(990076034, 'CT/Welder', 'Debasish Bera', NULL, NULL, NULL, NULL, 'SHQ DBR', 'Done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `management`
--
ALTER TABLE `management`
  ADD PRIMARY KEY (`regt_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
