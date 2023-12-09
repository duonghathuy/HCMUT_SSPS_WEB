-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2023 at 10:00 AM
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
-- Database: `hcmut_ssps`
--

-- --------------------------------------------------------

--
-- Table structure for table `accepted_file_types`
--

CREATE TABLE `accepted_file_types` (
  `File_Type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accepted_file_types`
--

INSERT INTO `accepted_file_types` (`File_Type`) VALUES
('.docx'),
('.jpg'),
('.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `bpp_order`
--

CREATE TABLE `bpp_order` (
  `Order_ID` int(11) NOT NULL,
  `Order_Creation_Date` datetime NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Payment_Status` tinyint(4) NOT NULL,
  `Owner_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bpp_order`
--

INSERT INTO `bpp_order` (`Order_ID`, `Order_Creation_Date`, `Quantity`, `Payment_Status`, `Owner_ID`) VALUES
(44, '2023-11-09 13:57:32', 12, 1, 2110103),
(45, '2023-11-09 13:57:37', 42, 1, 2110103),
(63, '2023-11-19 20:22:33', 24, 1, 2110103),
(110, '2023-11-25 18:02:17', 6, 0, 2110103),
(111, '2023-11-25 18:03:52', 5, 0, 2110103);

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `ID` int(11) NOT NULL,
  `Default_Number_Of_Pages` int(11) NOT NULL,
  `Paper_Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`ID`, `Default_Number_Of_Pages`, `Paper_Price`) VALUES
(0, 80, 330);

-- --------------------------------------------------------

--
-- Table structure for table `printer`
--

CREATE TABLE `printer` (
  `Printer_ID` varchar(50) NOT NULL,
  `Model` text DEFAULT NULL,
  `Brand` text DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Position` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `printer`
--

INSERT INTO `printer` (`Printer_ID`, `Model`, `Brand`, `Description`, `Position`) VALUES
('Printer1', NULL, NULL, NULL, NULL),
('Printer2', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `printing_request`
--

CREATE TABLE `printing_request` (
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
-- Dumping data for table `printing_request`
--

INSERT INTO `printing_request` (`Request_ID`, `Registration_Date`, `Completion_Date`, `File_Name`, `Pages_Per_Sheet`, `Number_Of_Copies`, `Printer_ID`, `Request_Status`, `Owner_ID`) VALUES
(1, '2023-10-09 07:05:29', '2023-10-09 10:18:02', '03_Ch3 Introduction_2023.pdf', 1, 4, 'Printer1', 'Đã hoàn thành', 2110103),
(3, '2023-11-23 07:20:13', NULL, '02_Ch2 Introduction_2023.pdf', 4, 2, 'Printer2', 'Đã gửi', 2110103),
(9, '2023-11-25 11:39:43', NULL, '01_Ch1 Introduction_2023.pdf', 2, 1, 'Printer2', 'Đã lưu', 2110103),
(10, '2023-12-01 14:50:51', '2023-12-02 10:18:02', 'LAB 11.odt', 1, 2, 'Printer1', 'Đã hoàn thành', 2110234);

-- --------------------------------------------------------

--
-- Table structure for table `refill_dates`
--

CREATE TABLE `refill_dates` (
  `date_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `refill_dates`
--

INSERT INTO `refill_dates` (`date_id`, `date`) VALUES
(3, '2023-12-06 20:08:00'),
(4, '2023-11-06 20:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `requested_page_numbers`
--

CREATE TABLE `requested_page_numbers` (
  `Request_ID` int(11) NOT NULL,
  `Start_Page_Number` int(11) NOT NULL,
  `End_Page_Number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requested_page_numbers`
--

INSERT INTO `requested_page_numbers` (`Request_ID`, `Start_Page_Number`, `End_Page_Number`) VALUES
(1, 30, 70),
(3, 1, 102),
(9, 3, 34),
(9, 66, 75),
(9, 80, 115),
(10, 1, 40),
(10, 55, 58);

-- --------------------------------------------------------

--
-- Table structure for table `request_status`
--

CREATE TABLE `request_status` (
  `Request_Status` varchar(50) NOT NULL DEFAULT 'Đã lưu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_status`
--

INSERT INTO `request_status` (`Request_Status`) VALUES
('Đã gửi'),
('Đã hoàn thành'),
('Đã lưu');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` text DEFAULT NULL,
  `Role` varchar(50) NOT NULL DEFAULT 'Student',
  `Sex` tinyint(4) DEFAULT NULL,
  `Balance` int(11) NOT NULL DEFAULT 0,
  `DateOfBirth` date DEFAULT NULL,
  `Username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Fname`, `Lname`, `Password`, `Email`, `Role`, `Sex`, `Balance`, `DateOfBirth`, `Username`) VALUES
(2110103, 'Dương', 'Hà Thuỳ', '$2y$10$.9QnFRwy8qmuKzJ6ZxToW.P1PPCXyrgU4Lqj67kMGB/iLykjEn7E2', 'duong.hathuy@hcmut.edu.vn', 'Student', 0, 100, '2023-02-15', 'duong.hathuy'),
(2110234, 'Hoàng', 'Nguyễn Việt', '$2y$10$.9QnFRwy8qmuKzJ6ZxToW.P1PPCXyrgU4Lqj67kMGB/iLykjEn7E2', 'hoang.nguyenviet@hcmut.edu.vn', 'Student', 1, 100, '2003-05-14', 'hoang.nguyenviet');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `User_ID` int(11) NOT NULL,
  `Province` varchar(50) NOT NULL,
  `District` varchar(50) NOT NULL,
  `Commune` varchar(50) NOT NULL,
  `Street` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`User_ID`, `Province`, `District`, `Commune`, `Street`) VALUES
(2110103, 'Thành Phố Hồ Chí Minh', 'Quận 3', 'Phường 7', '280 Điện Biên Phủ'),
(2110103, 'Thành Phố Hồ Chí Minh', 'Quận 3', 'Phường 7', '58 Bà Huyện Thanh Quan'),
(2110103, 'Tỉnh Long An', 'Huyện Cần Giuộc', 'Xã Thuận Thành', '88 Thuận Tây'),
(2110234, 'Thành Phố Hồ Chí Minh', 'Quận 7', 'Phường Bình Thuận', '3 Lâm Văn Bền');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accepted_file_types`
--
ALTER TABLE `accepted_file_types`
  ADD PRIMARY KEY (`File_Type`);

--
-- Indexes for table `bpp_order`
--
ALTER TABLE `bpp_order`
  ADD PRIMARY KEY (`Order_ID`),
  ADD KEY `Owner_ID` (`Owner_ID`);

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `printer`
--
ALTER TABLE `printer`
  ADD PRIMARY KEY (`Printer_ID`);

--
-- Indexes for table `printing_request`
--
ALTER TABLE `printing_request`
  ADD PRIMARY KEY (`Request_ID`),
  ADD KEY `Printer_ID` (`Printer_ID`),
  ADD KEY `Request_Status` (`Request_Status`),
  ADD KEY `Owner_ID` (`Owner_ID`);

--
-- Indexes for table `refill_dates`
--
ALTER TABLE `refill_dates`
  ADD PRIMARY KEY (`date_id`);

--
-- Indexes for table `requested_page_numbers`
--
ALTER TABLE `requested_page_numbers`
  ADD PRIMARY KEY (`Request_ID`,`Start_Page_Number`,`End_Page_Number`);

--
-- Indexes for table `request_status`
--
ALTER TABLE `request_status`
  ADD PRIMARY KEY (`Request_Status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`User_ID`,`Province`,`District`,`Commune`,`Street`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bpp_order`
--
ALTER TABLE `bpp_order`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `printing_request`
--
ALTER TABLE `printing_request`
  MODIFY `Request_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `refill_dates`
--
ALTER TABLE `refill_dates`
  MODIFY `date_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2110237;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bpp_order`
--
ALTER TABLE `bpp_order`
  ADD CONSTRAINT `bpp_order_ibfk_1` FOREIGN KEY (`Owner_ID`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
