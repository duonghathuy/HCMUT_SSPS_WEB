-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th12 09, 2023 lúc 08:34 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `HCMUT_SSPS`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Accepted_File_Types`
--

CREATE TABLE `Accepted_File_Types` (
  `File_Type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `Accepted_File_Types`
--

INSERT INTO `Accepted_File_Types` (`File_Type`) VALUES
('.jpeg'),
('.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `BPP_Order`
--

CREATE TABLE `BPP_Order` (
  `Order_ID` int(11) NOT NULL,
  `Order_Creation_Date` datetime NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Total_Price` int(11) NOT NULL DEFAULT 0,
  `Payment_Status` tinyint(4) NOT NULL,
  `Owner_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `BPP_Order`
--

INSERT INTO `BPP_Order` (`Order_ID`, `Order_Creation_Date`, `Quantity`, `Total_Price`, `Payment_Status`, `Owner_ID`) VALUES
(117, '2023-12-09 14:01:30', 12, 4200, 1, 2110234),
(118, '2023-12-09 14:01:43', 20, 7000, 0, 2110234),
(119, '2023-12-09 14:10:37', 1, 350, 0, 2110104);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Configuration`
--

CREATE TABLE `Configuration` (
  `ID` int(11) NOT NULL,
  `Default_Number_Of_Pages` int(11) NOT NULL,
  `Paper_Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `Configuration`
--

INSERT INTO `Configuration` (`ID`, `Default_Number_Of_Pages`, `Paper_Price`) VALUES
(0, 100, 350);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `campus_building`
--

CREATE TABLE `campus_building` (
	`printer_campusloc` CHAR(1) CHECK (printer_campusloc IN ('1' , '2')),
	`printer_buildingloc` CHAR(2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `campus_building`
--


INSERT INTO `campus_building` (`printer_campusloc`, `printer_buildingloc`) 
VALUES 
('1', 'A2'), 
('1', 'A3'), 
('1', 'B1'), 
('1', 'B2'), 
('1', 'B4'), 
('1', 'C4'), 
('1', 'C6'), 
('2', 'H1'), 
('2', 'H2'), 
('2', 'H3'), 
('2', 'H6');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Printer`
--

CREATE TABLE `Printer` (
  `Printer_ID` varchar(50) NOT NULL,
  `Printer_name` VARCHAR(20) NOT NULL,
	`Printer_desc` VARCHAR(100),
	`Printer_avai` CHAR(1) CHECK (`printer_avai` IN ('Y' , 'N')),
	`Printer_campusloc` CHAR(1),
	`Printer_buildingloc` CHAR(2),
	`Printer_room` VARCHAR(3)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `Printer`
--
insert into `printer_list` (`Printer_ID`, `Printer_name`, `Printer_desc`, `Printer_avai`, `Printer_campusloc`, `Printer_buildingloc`,  `Printer_room`)
VALUES 
('2H11031', 'Canon 1', 'Lorem Ipsum', 'Y', '2', 'H1', '103'),
('1A21011', 'Canon 1', 'Lorem Ipsum', 'Y', '1', 'A2', '101'),
('1A21012', 'Canon 2', 'Lorem Ipsum', 'N', '1', 'A2', '101'),
('1A33051', 'Canon 3', 'Lorem Ipsum', 'N', '1', 'A3', '305'),
('1A33052', 'Canon 3', 'Lorem Ipsum', 'N', '1', 'A3', '305'),
('1A33053', 'Canon 3', 'Lorem Ipsum', 'N', '1', 'A3', '305'),
('2H22021', 'Canon 2', 'Lorem Ipsum', 'N', '2', 'H2', '202'),
('2H62011', 'Canon 2', 'Lorem Ipsum', 'N', '2', 'H6', '201'),
('2H62012', 'Canon 2', 'Lorem Ipsum', 'N', '2', 'H6', '201'),
('2H62013', 'Canon 2', 'Lorem Ipsum', 'N', '2', 'H6', '201');


INSERT INTO `Printer` (`Printer_ID`, `Model`, `Brand`, `Description`, `Position`) VALUES
('Printer1', NULL, NULL, NULL, NULL),
('Printer2', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Printing_Request`
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
-- Đang đổ dữ liệu cho bảng `Printing_Request`
--

INSERT INTO `Printing_Request` (`Request_ID`, `Registration_Date`, `Completion_Date`, `File_Name`, `Pages_Per_Sheet`, `Number_Of_Copies`, `Printer_ID`, `Request_Status`, `Owner_ID`) VALUES
(1, '2023-10-09 07:05:29', '2023-10-09 10:18:02', '03_Ch3 Introduction_2023.pdf', 1, 4, 'Printer1', 'Đã hoàn thành', 2110104),
(3, '2023-11-23 07:20:13', NULL, '02_Ch2 Introduction_2023.pdf', 4, 2, 'Printer2', 'Đã gửi', 2110104),
(9, '2023-11-25 11:39:43', NULL, '01_Ch1 Introduction_2023.pdf', 2, 1, 'Printer2', 'Đã lưu', 2110104),
(10, '2023-12-01 14:50:51', '2023-12-02 10:18:02', 'LAB 11.odt', 1, 2, 'Printer1', 'Đã hoàn thành', 2110234);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Refill_Dates`
--

CREATE TABLE `Refill_Dates` (
  `Refill_Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `Refill_Dates`
--

INSERT INTO `Refill_Dates` (`Refill_Date`) VALUES
('2023-12-06 20:08:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Requested_Page_Numbers`
--

CREATE TABLE `Requested_Page_Numbers` (
  `Request_ID` int(11) NOT NULL,
  `Start_Page_Number` int(11) NOT NULL,
  `End_Page_Number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `Requested_Page_Numbers`
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
-- Cấu trúc bảng cho bảng `Request_Status`
--

CREATE TABLE `Request_Status` (
  `Request_Status` varchar(50) NOT NULL DEFAULT 'Đã lưu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `Request_Status`
--

INSERT INTO `Request_Status` (`Request_Status`) VALUES
('Đã gửi'),
('Đã hoàn thành'),
('Đã lưu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Users`
--

CREATE TABLE `Users` (
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
-- Đang đổ dữ liệu cho bảng `Users`
--

INSERT INTO `Users` (`ID`, `Fname`, `Lname`, `Password`, `Email`, `Role`, `Sex`, `Balance`, `DateOfBirth`, `Username`) VALUES
(2110104, 'Dương', 'Hà Thuỳ', '$2y$10$.9QnFRwy8qmuKzJ6ZxToW.P1PPCXyrgU4Lqj67kMGB/iLykjEn7E2', 'duong.hathuy@hcmut.edu.vn', 'SPSO', 0, 79, '2023-02-15', 'duong.hathuy'),
(2110234, 'Hoàng', 'Nguyễn Việt', '$2y$10$.9QnFRwy8qmuKzJ6ZxToW.P1PPCXyrgU4Lqj67kMGB/iLykjEn7E2', 'hoang.nguyenviet@hcmut.edu.vn', 'Student', 1, 124, '2003-05-14', 'hoang.nguyenviet');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `User_Addresses`
--

CREATE TABLE `User_Addresses` (
  `User_ID` int(11) NOT NULL,
  `Province` varchar(50) NOT NULL,
  `District` varchar(50) NOT NULL,
  `Commune` varchar(50) NOT NULL,
  `Street` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `User_Addresses`
--

INSERT INTO `User_Addresses` (`User_ID`, `Province`, `District`, `Commune`, `Street`) VALUES
(2110104, 'Thành Phố Hồ Chí Minh', 'Quận 3', 'Phường 7', '280 Điện Biên Phủ'),
(2110104, 'Thành Phố Hồ Chí Minh', 'Quận 3', 'Phường 7', '58 Bà Huyện Thanh Quan'),
(2110104, 'Tỉnh Long An', 'Huyện Cần Giuộc', 'Xã Thuận Thành', '88 Thuận Tây'),
(2110234, 'Thành Phố Hồ Chí Minh', 'Quận 7', 'Phường Bình Thuận', '3 Lâm Văn Bền');


-- --------------------------------------------------

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `Accepted_File_Types`
--
ALTER TABLE `Accepted_File_Types`
  ADD PRIMARY KEY (`File_Type`);

--
-- Chỉ mục cho bảng `BPP_Order`
--
ALTER TABLE `BPP_Order`
  ADD PRIMARY KEY (`Order_ID`),
  ADD KEY `Owner_ID` (`Owner_ID`);

--
-- Chỉ mục cho bảng `Configuration`
--
ALTER TABLE `Configuration`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `Printer`
--
ALTER TABLE `Printer`
  ADD PRIMARY KEY (`Printer_ID`);

--
-- Chỉ mục cho bảng `Printing_Request`
--
ALTER TABLE `Printing_Request`
  ADD PRIMARY KEY (`Request_ID`),
  ADD KEY `Printer_ID` (`Printer_ID`),
  ADD KEY `Request_Status` (`Request_Status`),
  ADD KEY `Owner_ID` (`Owner_ID`);

--
-- Chỉ mục cho bảng `Refill_Dates`
--
ALTER TABLE `Refill_Dates`
  ADD PRIMARY KEY (`Refill_Date`);

--
-- Chỉ mục cho bảng `Requested_Page_Numbers`
--
ALTER TABLE `Requested_Page_Numbers`
  ADD PRIMARY KEY (`Request_ID`,`Start_Page_Number`,`End_Page_Number`);

--
-- Chỉ mục cho bảng `Request_Status`
--
ALTER TABLE `Request_Status`
  ADD PRIMARY KEY (`Request_Status`);

--
-- Chỉ mục cho bảng `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `User_Addresses`
--
ALTER TABLE `User_Addresses`
  ADD PRIMARY KEY (`User_ID`,`Province`,`District`,`Commune`,`Street`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `BPP_Order`
--
ALTER TABLE `BPP_Order`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT cho bảng `Printing_Request`
--
ALTER TABLE `Printing_Request`
  MODIFY `Request_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `Users`
--
ALTER TABLE `Users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2110237;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `BPP_Order`
--
ALTER TABLE `BPP_Order`
  ADD CONSTRAINT `bpp_order_ibfk_1` FOREIGN KEY (`Owner_ID`) REFERENCES `Users` (`ID`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `Printing_Request`
--
ALTER TABLE `Printing_Request`
  ADD CONSTRAINT `printing_request_ibfk_1` FOREIGN KEY (`Printer_ID`) REFERENCES `Printer` (`Printer_ID`),
  ADD CONSTRAINT `printing_request_ibfk_2` FOREIGN KEY (`Request_Status`) REFERENCES `Request_Status` (`Request_Status`),
  ADD CONSTRAINT `printing_request_ibfk_3` FOREIGN KEY (`Owner_ID`) REFERENCES `Users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `User_Addresses`
--
ALTER TABLE `User_Addresses`
  ADD CONSTRAINT `user_addresses_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `Users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

ALTER TABLE `printer_list`  
  ADD CONSTRAINT `printer_list_campus_building_ibfk_1` FOREIGN KEY (`printer_campusloc`, `printer_buildingloc`) REFERENCES `campus_building`(`printer_campusloc`, `printer_buildingloc`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
