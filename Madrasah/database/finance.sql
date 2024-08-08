-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2024 at 05:35 PM
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
-- Database: `finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountant`
--

CREATE TABLE `accountant` (
  `acc_id` int(11) NOT NULL,
  `acc_name` varchar(50) NOT NULL,
  `acc_phonenum` varchar(20) NOT NULL,
  `acc_email` varchar(50) NOT NULL,
  `acc_address` varchar(50) NOT NULL,
  `login_id` int(11) NOT NULL,
  `clerk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accountant`
--

INSERT INTO `accountant` (`acc_id`, `acc_name`, `acc_phonenum`, `acc_email`, `acc_address`, `login_id`, `clerk_id`) VALUES
(1, 'Sarah Yasmin', '7778889999', 'yasmin.accountant@example.com', 'Nilai', 3, 1),
(2, 'Aqil Sahar', '0001112222', 'aqil.accountant@example.com', 'Jln Bangsar', 4, 1),
(10, 'man', '1', 'man@gmail.com', '', 84, 1),
(11, 'man', '011', 'man@gmail.com', '', 85, 1),
(12, '123', '123', '123@gmail.com', '', 86, 1),
(13, 'ada', '12', '12@gmail.com', '', 87, 1),
(14, '2', '2', '2@gmail.com', '', 88, 1),
(15, 'a', '123', '123@mail.com', '', 89, 1),
(16, '12312', '12312', '13131!@rwarwarwa', '', 99, 1),
(17, 'dadawdawdaw', '123123231', 'man@gmail.com', '', 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `clerk`
--

CREATE TABLE `clerk` (
  `clerk_id` int(11) NOT NULL,
  `clerk_name` varchar(50) DEFAULT NULL,
  `clerk_phonenum` varchar(20) DEFAULT NULL,
  `clerk_email` varchar(50) DEFAULT NULL,
  `login_id` int(11) NOT NULL,
  `principal_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clerk`
--

INSERT INTO `clerk` (`clerk_id`, `clerk_name`, `clerk_phonenum`, `clerk_email`, `login_id`, `principal_id`) VALUES
(1, 'hajar siti', '0123456', 'hajar@gmail.com', 1, 1),
(68, 'amin', '1', '1@gmail.com', 90, 1),
(69, '', '', 'zim@gmail.com', 91, 1),
(70, 'sda', '423423', 'efd@dsadsa', 92, 1),
(71, '', '011', '1@gmail.com', 93, 1),
(72, 'rawr', '123312', 's@ds', 94, 1),
(73, 'dsa', '231', '231@dsa', 95, 1),
(74, 'sda', '23', '2d@dsa', 96, 1),
(75, 'dsa', '213', 'sd@dsa', 97, 1),
(76, 'sad', '123', 'asd@sad', 98, 1),
(77, 'testuser', '011123133213', 'amin@gmail.com', 101, 1),
(78, 'zamri', '11', 'zamri@gmail.com', 102, 1),
(79, 'joule', '1', 'j@gmail.com', 103, 1),
(80, 'jol ismal', '012', 'jol@gmail.com', 104, 1),
(81, '123', '123', '123@gmail.com', 105, 1);

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `ledger_id` int(11) NOT NULL,
  `sender_name` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `trans_medium` varchar(50) DEFAULT NULL,
  `amount` double(50,2) DEFAULT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`ledger_id`, `sender_name`, `date`, `trans_medium`, `amount`, `type_id`) VALUES
(8, 'Ijjat', '2024-07-22', 'e-Wallet', 50.00, 2),
(10, 'Malik Ambar', '2023-06-06', 'Cash', 500.25, 2),
(11, 'Mansa Musa', '2020-02-23', 'Cash', 10000.00, 2),
(12, 'Ahmed', '2020-03-05', 'Online Banking', 5000.50, 2),
(13, 'Elena', '2023-04-11', 'Cash', 100.00, 2),
(14, 'Fatima', '2023-12-05', 'e-Wallet', 450.90, 2),
(15, 'Ibrahim', '2018-08-30', 'e-Wallet', 1098.76, 2),
(16, 'Mariam', '2018-12-20', 'Online Banking', 2109.87, 2),
(17, 'Pia', '2022-04-14', 'Online Banking', 678.90, 2),
(18, 'Salim', '2018-07-26', 'Online Banking', 2345.67, 2),
(19, 'Vera', '2022-10-22', 'Online Banking', 5678.90, 2),
(20, 'Yusuf', '2018-01-30', 'Online Banking', 8901.23, 2),
(21, 'Barbara', '2023-04-20', 'Online Banking', 2345.67, 2),
(22, 'Ethan', '2019-07-14', 'Online Banking', 5678.90, 2),
(23, 'Hana', '2023-10-18', 'Online Banking', 8901.23, 2),
(24, 'Karim', '2019-01-30', 'Online Banking', 2345.67, 2),
(25, 'Nina', '2020-04-18', 'Online Banking', 5678.90, 2),
(26, 'Quincy', '2021-07-14', 'Online Banking', 8901.23, 2),
(27, 'Tina', '2018-10-30', 'Online Banking', 2345.67, 2),
(28, 'Wendy', '2023-01-14', 'Online Banking', 5678.90, 2),
(29, 'Zayn', '2019-04-30', 'Online Banking', 8901.23, 2),
(30, 'Aisha', '2020-01-20', 'Cash', 1250.50, 2),
(31, 'Bashir', '2019-06-18', 'e-Wallet', 890.75, 2),
(32, 'Carmen', '2021-11-22', 'Cash', 1450.00, 2),
(33, 'Dani', '2022-03-15', 'Online Banking', 3050.20, 2),
(34, 'Eli', '2023-09-05', 'e-Wallet', 199.90, 2),
(35, 'Fouad', '2018-02-18', 'Cash', 780.60, 2),
(36, 'Gina', '2019-04-19', 'Online Banking', 3450.40, 2),
(37, 'Hussein', '2021-08-28', 'e-Wallet', 2134.50, 2),
(38, 'Isha', '2022-12-19', 'Cash', 1345.25, 2),
(39, 'Jake', '2023-03-25', 'Online Banking', 234.76, 2),
(40, 'Katrina', '2020-05-30', 'e-Wallet', 1020.89, 2),
(41, 'Lina', '2018-11-18', 'Cash', 654.30, 2),
(42, 'Mika', '2019-07-10', 'Online Banking', 2301.45, 2),
(43, 'Nabil', '2021-12-05', 'e-Wallet', 4789.23, 2),
(44, 'Omar', '2022-08-20', 'Cash', 1298.76, 2),
(45, 'Perry', '2023-06-28', 'Online Banking', 987.56, 2),
(46, 'Rita', '2020-02-24', 'e-Wallet', 3000.50, 2),
(47, 'Sara', '2018-09-16', 'Cash', 785.90, 2),
(48, 'Tarek', '2019-11-21', 'Online Banking', 5400.65, 2),
(49, 'Usman', '2021-03-29', 'e-Wallet', 675.89, 2),
(50, 'Viola', '2022-07-31', 'Cash', 1200.40, 2),
(51, 'Waleed', '2023-02-25', 'Online Banking', 430.78, 2),
(52, 'Xena', '2020-06-12', 'e-Wallet', 1345.67, 2),
(53, 'Yara', '2018-04-15', 'Cash', 890.56, 2),
(54, 'Zane', '2019-12-20', 'Online Banking', 4500.20, 2),
(55, 'Alia', '2021-01-25', 'e-Wallet', 238.76, 2),
(56, 'Benny', '2022-11-22', 'Cash', 1678.34, 2),
(57, 'Celia', '2023-08-10', 'Online Banking', 560.40, 2),
(58, 'Derek', '2020-03-30', 'e-Wallet', 789.12, 2),
(59, 'Eva', '2018-05-17', 'Cash', 2390.87, 2),
(60, 'Frank', '2019-10-18', 'Online Banking', 690.50, 2);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `ledger_id` int(11) NOT NULL,
  `sender_name` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `trans_medium` varchar(50) DEFAULT NULL,
  `amount` double(50,2) DEFAULT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`ledger_id`, `sender_name`, `date`, `trans_medium`, `amount`, `type_id`) VALUES
(6, 'Memphis', '2018-06-06', 'Online Banking', 450.95, 3),
(9, 'Min Walid', '2024-07-08', 'Cash', 1000.50, 3),
(12, 'Midji', '2024-06-29', 'Online Banking', 275.40, 3),
(13, 'Bilal', '2019-07-14', 'e-Wallet', 750.00, 3),
(14, 'George', '2019-02-21', 'Online Banking', 2345.67, 3),
(15, 'Hana', '2021-07-19', 'Cash', 876.54, 3),
(16, 'Khalid', '2020-10-23', 'e-Wallet', 543.21, 3),
(17, 'Nabil', '2021-01-29', 'Online Banking', 1298.65, 3),
(18, 'Qasim', '2023-05-22', 'Cash', 8765.43, 3),
(19, 'Tariq', '2021-08-30', 'Online Banking', 3456.78, 3),
(20, 'Waleed', '2023-11-18', 'Cash', 6789.01, 3),
(21, 'Zara', '2019-02-23', 'e-Wallet', 9012.34, 3),
(22, 'Charlie', '2020-05-18', 'Online Banking', 3456.78, 3),
(23, 'Fiona', '2021-08-25', 'Cash', 6789.01, 3),
(24, 'Ian', '2020-11-21', 'Online Banking', 9012.34, 3),
(25, 'Lara', '2021-02-22', 'Cash', 3456.78, 3),
(26, 'Omar', '2018-05-25', 'e-Wallet', 6789.01, 3),
(27, 'Rita', '2023-08-22', 'Online Banking', 9012.34, 3),
(28, 'Ursula', '2019-11-21', 'Cash', 3456.78, 3),
(29, 'Xander', '2020-02-21', 'e-Wallet', 6789.01, 3);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `category` varchar(10) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `username`, `password`, `category`, `status_id`) VALUES
(1, 'hajar', 'hajar', 'Clerk', 1),
(2, 'faris', 'faris', 'Principal', 1),
(3, 'yasmin', 'yasmin', 'Accountant', 1),
(4, 'aqil', 'aqil', 'Accountant', 1),
(84, 'man', '123', 'Accountant', 1),
(85, 'man1', '123', 'Accountant', 1),
(86, 'j', 'j', 'Accountant', 1),
(87, 'adadad', 'adadad', 'Accountant', 1),
(88, '2', '2', 'Accountant', 1),
(89, 'a', '123', 'Accountant', 1),
(90, 'aminn', '123', 'Clerk', 2),
(91, 'zim', '123', 'Clerk', 1),
(92, 'sda', '32', 'Clerk', 1),
(93, 'zim1', '123', 'Clerk', 2),
(94, 'as', '123', 'Clerk', 1),
(95, 'das', '123', 'Clerk', 2),
(96, 'dsa', '2', 'Clerk', 1),
(97, 'dsadas', '321', 'Clerk', 1),
(98, 'dsadsadadasdas', '321', 'Clerk', 1),
(99, 'adaasasasddasadsasdas', 'dsadsadasdads', 'Accountant', 1),
(100, 'asdasdaadsad', '123', 'Accountant', 1),
(101, 'mantul', '123', 'Clerk', 1),
(102, 'zamri', '123', 'Clerk', 1),
(103, 'joule', '123', 'Clerk', 1),
(104, 'jol', '123', 'Clerk', 1),
(105, '!', '123', 'Clerk', 1);

-- --------------------------------------------------------

--
-- Table structure for table `principal`
--

CREATE TABLE `principal` (
  `principal_id` int(11) NOT NULL,
  `principal_name` varchar(50) NOT NULL,
  `principal_phonenum` varchar(20) NOT NULL,
  `principal_email` varchar(50) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `principal`
--

INSERT INTO `principal` (`principal_id`, `principal_name`, `principal_phonenum`, `principal_email`, `login_id`) VALUES
(1, 'Faris', '01234567', 'faris@example.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status`) VALUES
(1, 'active'),
(2, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `trans_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `trans_medium` varchar(50) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `sender_name` varchar(50) DEFAULT NULL,
  `amount` double(50,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`trans_id`, `date`, `trans_medium`, `type_id`, `sender_name`, `amount`) VALUES
(1, '2024-07-06', 'Online Banking', 2, 'Joey', 1233.00),
(2, '2024-07-18', 'Cash', 3, 'Sarah', 300.00),
(4, '2024-07-22', 'e-Wallet', 1, 'Aqil', 1000.00),
(5, '2021-01-22', 'Cash', 1, 'Faris', 200.00),
(6, '2018-06-06', 'Online Banking', 3, 'Memphis', 450.95),
(7, '2024-07-02', 'Cash', 1, 'Samir', 300.00),
(8, '2024-07-22', 'e-Wallet', 2, 'Ijjat', 50.00),
(9, '2024-07-08', 'Cash', 3, 'Min Walid', 1000.50),
(10, '2023-06-06', 'Cash', 2, 'Malik Ambar', 500.25),
(11, '2020-02-23', 'Cash', 2, 'Mansa Musa', 10000.00),
(12, '2024-06-29', 'Online Banking', 3, 'Midji', 275.40),
(13, '2022-02-01', 'Cash', 1, 'Adam Malek', 150.00),
(14, '2020-03-05', 'Online Banking', 2, 'Ahmed', 5000.50),
(15, '2019-07-14', 'Cash', 1, 'Bilal', 750.00),
(16, '2021-11-25', 'e-Wallet', 3, 'Cynthia', 300.75),
(17, '2022-01-30', 'Online Banking', 1, 'Daniel', 2000.20),
(18, '2023-04-11', 'Cash', 2, 'Elena', 100.00),
(19, '2023-12-05', 'e-Wallet', 2, 'Fatima', 450.90),
(20, '2019-02-21', 'Online Banking', 3, 'George', 2345.67),
(21, '2021-07-19', 'Cash', 1, 'Hana', 876.54),
(22, '2018-08-30', 'e-Wallet', 2, 'Ibrahim', 1098.76),
(23, '2023-09-18', 'Online Banking', 1, 'Jasmine', 765.43),
(24, '2020-10-23', 'Cash', 3, 'Khalid', 543.21),
(25, '2022-11-11', 'e-Wallet', 1, 'Layla', 4321.98),
(26, '2018-12-20', 'Online Banking', 2, 'Mariam', 2109.87),
(27, '2021-01-29', 'Cash', 3, 'Nabil', 1298.65),
(28, '2019-03-17', 'e-Wallet', 1, 'Omar', 9876.54),
(29, '2022-04-14', 'Online Banking', 2, 'Pia', 678.90),
(30, '2023-05-22', 'Cash', 3, 'Qasim', 8765.43),
(31, '2020-06-18', 'e-Wallet', 1, 'Rania', 1234.56),
(32, '2018-07-26', 'Online Banking', 2, 'Salim', 2345.67),
(33, '2021-08-30', 'Cash', 3, 'Tariq', 3456.78),
(34, '2019-09-14', 'e-Wallet', 1, 'Umar', 4567.89),
(35, '2022-10-22', 'Online Banking', 2, 'Vera', 5678.90),
(36, '2023-11-18', 'Cash', 3, 'Waleed', 6789.01),
(37, '2020-12-05', 'e-Wallet', 1, 'Xena', 7890.12),
(38, '2018-01-30', 'Online Banking', 2, 'Yusuf', 8901.23),
(39, '2019-02-23', 'Cash', 3, 'Zara', 9012.34),
(40, '2021-03-14', 'e-Wallet', 1, 'Ali', 1234.56),
(41, '2023-04-20', 'Online Banking', 2, 'Barbara', 2345.67),
(42, '2020-05-18', 'Cash', 3, 'Charlie', 3456.78),
(43, '2018-06-22', 'e-Wallet', 1, 'Dina', 4567.89),
(44, '2019-07-14', 'Online Banking', 2, 'Ethan', 5678.90),
(45, '2021-08-25', 'Cash', 3, 'Fiona', 6789.01),
(46, '2022-09-30', 'e-Wallet', 1, 'Gavin', 7890.12),
(47, '2023-10-18', 'Online Banking', 2, 'Hana', 8901.23),
(48, '2020-11-21', 'Cash', 3, 'Ian', 9012.34),
(49, '2018-12-25', 'e-Wallet', 1, 'Jasmine', 1234.56),
(50, '2019-01-30', 'Online Banking', 2, 'Karim', 2345.67),
(51, '2021-02-22', 'Cash', 3, 'Lara', 3456.78),
(52, '2023-03-14', 'e-Wallet', 1, 'Mina', 4567.89),
(53, '2020-04-18', 'Online Banking', 2, 'Nina', 5678.90),
(54, '2018-05-25', 'Cash', 3, 'Omar', 6789.01),
(55, '2019-06-30', 'e-Wallet', 1, 'Paul', 7890.12),
(56, '2021-07-14', 'Online Banking', 2, 'Quincy', 8901.23),
(57, '2023-08-22', 'Cash', 3, 'Rita', 9012.34),
(58, '2020-09-18', 'e-Wallet', 1, 'Sami', 1234.56),
(59, '2018-10-30', 'Online Banking', 2, 'Tina', 2345.67),
(60, '2019-11-21', 'Cash', 3, 'Ursula', 3456.78),
(61, '2021-12-18', 'e-Wallet', 1, 'Victor', 4567.89),
(62, '2023-01-14', 'Online Banking', 2, 'Wendy', 5678.90),
(63, '2020-02-21', 'Cash', 3, 'Xander', 6789.01),
(64, '2018-03-25', 'e-Wallet', 1, 'Yara', 7890.12),
(65, '2019-04-30', 'Online Banking', 2, 'Zayn', 8901.23);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `type_name`) VALUES
(1, 'Zakat'),
(2, 'Donation'),
(3, 'Fee');

-- --------------------------------------------------------

--
-- Table structure for table `zakat`
--

CREATE TABLE `zakat` (
  `ledger_id` int(11) NOT NULL,
  `sender_name` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `trans_medium` varchar(50) DEFAULT NULL,
  `amount` double(50,2) DEFAULT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zakat`
--

INSERT INTO `zakat` (`ledger_id`, `sender_name`, `date`, `trans_medium`, `amount`, `type_id`) VALUES
(5, 'Faris', '2021-01-22', 'Cash', 200.00, 1),
(7, 'Samir', '2024-07-02', 'Cash', 300.00, 1),
(13, 'Adam Malek', '2022-02-01', 'Cash', 150.00, 1),
(15, 'Bilal', '2019-07-14', 'Cash', 750.00, 1),
(17, 'Daniel', '2022-01-30', 'Online Banking', 2000.20, 1),
(21, 'Hana', '2021-07-19', 'Cash', 876.54, 1),
(23, 'Jasmine', '2023-09-18', 'Online Banking', 765.43, 1),
(25, 'Layla', '2022-11-11', 'e-Wallet', 4321.98, 1),
(28, 'Omar', '2019-03-17', 'e-Wallet', 9876.54, 1),
(31, 'Rania', '2020-06-18', 'e-Wallet', 1234.56, 1),
(34, 'Umar', '2019-09-14', 'e-Wallet', 4567.89, 1),
(37, 'Xena', '2020-12-05', 'e-Wallet', 7890.12, 1),
(40, 'Ali', '2021-03-14', 'e-Wallet', 1234.56, 1),
(43, 'Dina', '2018-06-22', 'e-Wallet', 4567.89, 1),
(46, 'Gavin', '2022-09-30', 'e-Wallet', 7890.12, 1),
(49, 'Jasmine', '2018-12-25', 'e-Wallet', 1234.56, 1),
(52, 'Mina', '2023-03-14', 'e-Wallet', 4567.89, 1),
(55, 'Paul', '2019-06-30', 'e-Wallet', 7890.12, 1),
(58, 'Sami', '2020-09-18', 'e-Wallet', 1234.56, 1),
(61, 'Victor', '2021-12-18', 'e-Wallet', 4567.89, 1),
(64, 'Yara', '2018-03-25', 'e-Wallet', 7890.12, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountant`
--
ALTER TABLE `accountant`
  ADD PRIMARY KEY (`acc_id`),
  ADD KEY `login_id` (`login_id`),
  ADD KEY `accountant_ibfk_2` (`clerk_id`);

--
-- Indexes for table `clerk`
--
ALTER TABLE `clerk`
  ADD PRIMARY KEY (`clerk_id`),
  ADD KEY `login_id` (`login_id`),
  ADD KEY `principal_id` (`principal_id`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`ledger_id`),
  ADD KEY `donation_ibfk_1` (`type_id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`ledger_id`),
  ADD KEY `fees_ibfk_1` (`type_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `principal`
--
ALTER TABLE `principal`
  ADD PRIMARY KEY (`principal_id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `zakat`
--
ALTER TABLE `zakat`
  ADD PRIMARY KEY (`ledger_id`),
  ADD KEY `zakat_ibfk_1` (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountant`
--
ALTER TABLE `accountant`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `clerk`
--
ALTER TABLE `clerk`
  MODIFY `clerk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `ledger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `ledger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `principal`
--
ALTER TABLE `principal`
  MODIFY `principal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `zakat`
--
ALTER TABLE `zakat`
  MODIFY `ledger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accountant`
--
ALTER TABLE `accountant`
  ADD CONSTRAINT `accountant_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`),
  ADD CONSTRAINT `accountant_ibfk_2` FOREIGN KEY (`clerk_id`) REFERENCES `clerk` (`clerk_id`);

--
-- Constraints for table `clerk`
--
ALTER TABLE `clerk`
  ADD CONSTRAINT `clerk_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`),
  ADD CONSTRAINT `clerk_ibfk_2` FOREIGN KEY (`principal_id`) REFERENCES `principal` (`principal_id`);

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `donation_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`);

--
-- Constraints for table `fees`
--
ALTER TABLE `fees`
  ADD CONSTRAINT `fees_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`);

--
-- Constraints for table `principal`
--
ALTER TABLE `principal`
  ADD CONSTRAINT `principal_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`);

--
-- Constraints for table `zakat`
--
ALTER TABLE `zakat`
  ADD CONSTRAINT `zakat_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
