-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2023 at 02:08 PM
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
-- Database: `HCMUT_SSPS`
--

-- --------------------------------------------------------

--
-- Table structure for table `Accepted_File_Types`
--

CREATE TABLE `Accepted_File_Types` (
  `File_Type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Accepted_File_Types`
--

INSERT INTO `Accepted_File_Types` (`File_Type`) VALUES
('.jpeg'),
('.png');

-- --------------------------------------------------------

--
-- Table structure for table `BPP_Order`
--

CREATE TABLE `BPP_Order` (
  `Order_ID` int(11) NOT NULL,
  `Order_Creation_Date` datetime NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Payment_Status` tinyint(4) NOT NULL,
  `Owner_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `BPP_Order`
--

INSERT INTO `BPP_Order` (`Order_ID`, `Order_Creation_Date`, `Quantity`, `Payment_Status`, `Owner_ID`) VALUES
(44, '2023-11-09 13:57:32', 12, 1, 2110103),
(45, '2023-11-09 13:57:37', 42, 1, 2110103),
(63, '2023-11-19 20:22:33', 24, 1, 2110103),
(110, '2023-11-25 18:02:17', 6, 0, 2110103),
(111, '2023-11-25 18:03:52', 5, 0, 2110103);

-- --------------------------------------------------------

--
-- Table structure for table `Configuration`
--

CREATE TABLE `Configuration` (
  `ID` int(11) NOT NULL,
  `Default_Number_Of_Pages` int(11) NOT NULL,
  `Paper_Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Configuration`
--

INSERT INTO `Configuration` (`ID`, `Default_Number_Of_Pages`, `Paper_Price`) VALUES
(0, 100, 350);

-- --------------------------------------------------------

--
-- Table structure for table `Printer`
--

CREATE TABLE `Printer` (
  `Printer_ID` varchar(50) NOT NULL,
  `Model` text DEFAULT NULL,
  `Brand` text DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Position` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Printer`
--

INSERT INTO `Printer` (`Printer_ID`, `Model`, `Brand`, `Description`, `Position`) VALUES
('Printer1', NULL, NULL, NULL, NULL),
('Printer2', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Printing_Request`
--

CREATE TABLE `Printing_Request` (
  `Request_ID` int(11) NOT NULL,
  `Registration_Date` datetime NOT NULL,
  `Completion_Date` datetime DEFAULT NULL,
  `File_Name` text NOT NULL,
  `Pages_Per_Sheet` int(11) NOT NULL,
  `Number_Of_Copies` int(11) NOT NULL,
  `Printer_ID` varchar(50) NOT NULL,
  `Request_Status` varchar(50) DEFAULT NULL,
  `Owner_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Printing_Request`
--

INSERT INTO `Printing_Request` (`Request_ID`, `Registration_Date`, `Completion_Date`, `File_Name`, `Pages_Per_Sheet`, `Number_Of_Copies`, `Printer_ID`, `Request_Status`, `Owner_ID`) VALUES
(1, '2023-10-09 07:05:29', '2023-10-09 10:18:02', '03_Ch3 Introduction_2023.pdf', 1, 4, 'Printer1', 'Đã hoàn thành', 2110103),
(3, '2023-11-23 07:20:13', NULL, '02_Ch2 Introduction_2023.pdf', 4, 2, 'Printer2', 'Đã gửi', 2110103),
(9, '2023-11-25 11:39:43', NULL, '01_Ch1 Introduction_2023.pdf', 2, 1, 'Printer2', 'Đã lưu', 2110103),
(10, '2023-12-01 14:50:51', '2023-12-02 10:18:02', 'LAB 11.odt', 1, 2, 'Printer1', 'Đã hoàn thành', 2110234);

-- --------------------------------------------------------

--
-- Table structure for table `Refill_Dates`
--

CREATE TABLE `Refill_Dates` (
  `Refill_Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Refill_Dates`
--

INSERT INTO `Refill_Dates` (`Refill_Date`) VALUES
('2023-12-06 20:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `Requested_Page_Numbers`
--

CREATE TABLE `Requested_Page_Numbers` (
  `Request_ID` int(11) NOT NULL,
  `Start_Page_Number` int(11) NOT NULL,
  `End_Page_Number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Requested_Page_Numbers`
--

INSERT INTO `Requested_Page_Numbers` (`Request_ID`, `Start_Page_Number`, `End_Page_Number`) VALUES
(1, 30, 70),
(3, 1, 102),
(9, 3, 34),
(9, 66, 75),
(9, 80, 115),
(10, 1, 40),
(10, 55, 58);

-- --------------------------------------------------------

--
-- Table structure for table `Request_Status`
--

CREATE TABLE `Request_Status` (
  `Request_Status` varchar(50) NOT NULL DEFAULT 'Đã lưu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Request_Status`
--

INSERT INTO `Request_Status` (`Request_Status`) VALUES
('Đã gửi'),
('Đã hoàn thành'),
('Đã lưu');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `ID` int(11) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `Email` text DEFAULT NULL,
  `Role` varchar(50) NOT NULL DEFAULT 'Student',
  `Sex` tinyint(4) DEFAULT NULL,
  `Balance` int(11) NOT NULL DEFAULT 0,
  `DateOfBirth` date DEFAULT NULL,
  `Username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`ID`, `Fname`, `Lname`, `Email`, `Role`, `Sex`, `Balance`, `DateOfBirth`, `Username`) VALUES
(2110103, 'Dương', 'Hà Thuỳ', 'duong.hathuy@hcmut.edu.vn', 'Student', 0, 100, '2023-02-15', 'duong.hathuy'),
(2110234, 'Hoàng', 'Nguyễn Việt', 'hoang.nguyenviet@hcmut.edu.vn', 'Student', 1, 100, '2003-05-14', 'hoang.nguyenviet');

-- --------------------------------------------------------

--
-- Table structure for table `User_Addresses`
--

CREATE TABLE `User_Addresses` (
  `User_ID` int(11) NOT NULL,
  `Province` varchar(50) NOT NULL,
  `District` varchar(50) NOT NULL,
  `Commune` varchar(50) NOT NULL,
  `Street` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `User_Addresses`
--

INSERT INTO `User_Addresses` (`User_ID`, `Province`, `District`, `Commune`, `Street`) VALUES
(2110103, 'Thành Phố Hồ Chí Minh', 'Quận 3', 'Phường 7', '280 Điện Biên Phủ'),
(2110103, 'Thành Phố Hồ Chí Minh', 'Quận 3', 'Phường 7', '58 Bà Huyện Thanh Quan'),
(2110103, 'Tỉnh Long An', 'Huyện Cần Giuộc', 'Xã Thuận Thành', '88 Thuận Tây'),
(2110234, 'Thành Phố Hồ Chí Minh', 'Quận 7', 'Phường Bình Thuận', '3 Lâm Văn Bền');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Accepted_File_Types`
--
ALTER TABLE `Accepted_File_Types`
  ADD PRIMARY KEY (`File_Type`);

--
-- Indexes for table `BPP_Order`
--
ALTER TABLE `BPP_Order`
  ADD PRIMARY KEY (`Order_ID`),
  ADD KEY `Owner_ID` (`Owner_ID`);

--
-- Indexes for table `Configuration`
--
ALTER TABLE `Configuration`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Printer`
--
ALTER TABLE `Printer`
  ADD PRIMARY KEY (`Printer_ID`);

--
-- Indexes for table `Printing_Request`
--
ALTER TABLE `Printing_Request`
  ADD PRIMARY KEY (`Request_ID`),
  ADD KEY `Printer_ID` (`Printer_ID`),
  ADD KEY `Request_Status` (`Request_Status`),
  ADD KEY `Owner_ID` (`Owner_ID`);

--
-- Indexes for table `Refill_Dates`
--
ALTER TABLE `Refill_Dates`
  ADD PRIMARY KEY (`Refill_Date`);

--
-- Indexes for table `Requested_Page_Numbers`
--
ALTER TABLE `Requested_Page_Numbers`
  ADD PRIMARY KEY (`Request_ID`,`Start_Page_Number`,`End_Page_Number`);

--
-- Indexes for table `Request_Status`
--
ALTER TABLE `Request_Status`
  ADD PRIMARY KEY (`Request_Status`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `User_Addresses`
--
ALTER TABLE `User_Addresses`
  ADD PRIMARY KEY (`User_ID`,`Province`,`District`,`Commune`,`Street`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `BPP_Order`
--
ALTER TABLE `BPP_Order`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `Printing_Request`
--
ALTER TABLE `Printing_Request`
  MODIFY `Request_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2110235;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `BPP_Order`
--
ALTER TABLE `BPP_Order`
  ADD CONSTRAINT `bpp_order_ibfk_1` FOREIGN KEY (`Owner_ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `Printing_Request`
--
ALTER TABLE `Printing_Request`
  ADD CONSTRAINT `printing_request_ibfk_1` FOREIGN KEY (`Printer_ID`) REFERENCES `Printer` (`Printer_ID`),
  ADD CONSTRAINT `printing_request_ibfk_2` FOREIGN KEY (`Request_Status`) REFERENCES `Request_Status` (`Request_Status`),
  ADD CONSTRAINT `printing_request_ibfk_3` FOREIGN KEY (`Owner_ID`) REFERENCES `Student` (`ID`);

--
-- Constraints for table `User_Addresses`
--
ALTER TABLE `User_Addresses`
  ADD CONSTRAINT `user_addresses_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `Users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
