-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 25, 2018 at 02:25 PM
-- Server version: 10.2.12-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freedomadd_invoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID` int(11) NOT NULL,
  `Firstname` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(100) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `GSTno` varchar(100) NOT NULL,
  `Status` varchar(10) NOT NULL DEFAULT 'A',
  `CreatedOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID`, `Firstname`, `Lastname`, `Email`, `Phone`, `Address`, `GSTno`, `Status`, `CreatedOn`) VALUES
(1, 'Dilipbhai', 'Jitiya', 'dj@gmail.com', '1234567899', 'udaynagar 2,ved road', 'GST123456', 'A', '2017-08-06 09:37:42'),
(2, 'Nitin', 'Viras', 'nitinboricha91@gmail.com', '9033383570', 'surat', 'GST789', 'A', '2017-08-05 18:17:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_users`
--

CREATE TABLE `tbl_admin_users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Firstname` varchar(255) DEFAULT NULL,
  `Lastname` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Phone` varchar(100) DEFAULT NULL,
  `AddressLine1` text DEFAULT NULL,
  `AddressSuitUnit` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `State` varchar(255) DEFAULT 'CA',
  `ZipCode` varchar(50) DEFAULT NULL,
  `ProfileImage` text DEFAULT NULL,
  `Type` varchar(255) DEFAULT NULL COMMENT 'SA=Super Admin,HA=Hospice Admin,NA=Nurse Admin',
  `Status` int(11) DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `reset_password_check` int(1) NOT NULL DEFAULT 0,
  `CreatedDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin_users`
--

INSERT INTO `tbl_admin_users` (`ID`, `Username`, `Password`, `Firstname`, `Lastname`, `Email`, `Phone`, `AddressLine1`, `AddressSuitUnit`, `City`, `State`, `ZipCode`, `ProfileImage`, `Type`, `Status`, `reset_password_check`, `CreatedDate`, `UpdatedDate`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Nitin', 'Viras', 'nitinboricha91@gmail.com', '8185001234', '143 Triunfo Canyon Rd.', '103', 'Westlake Village', 'California', '44212', 'bk.jpeg', NULL, 1, 1, '2017-03-31 11:49:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `ID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL DEFAULT 0,
  `CustomerName` varchar(255) DEFAULT NULL,
  `CustomerPhone` varchar(255) DEFAULT NULL,
  `CustomerAddress` varchar(255) DEFAULT NULL,
  `CustomerGSTNo` varchar(255) NOT NULL,
  `PlaceOfSuppy` varchar(255) NOT NULL,
  `NetAmount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `GST` int(11) NOT NULL,
  `invoice_name` varchar(255) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UpdatedOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`ID`, `CustomerID`, `CustomerName`, `CustomerPhone`, `CustomerAddress`, `CustomerGSTNo`, `PlaceOfSuppy`, `NetAmount`, `GST`, `invoice_name`, `CreatedOn`, `UpdatedOn`) VALUES
(1, 1, 'Dilipbhai Jitiya', '1234567899', 'udaynagar 2,ved road', 'GST123456', 'surat', '1.18', 18, 'invoice_1.pdf', '2017-08-05 18:22:39', '2017-08-05 18:22:39'),
(2, 2, 'Nitin Viras', '9033383570', 'surat', 'GST789', 'rajkot', '359.90', 18, 'invoice_2.pdf', '2017-08-09 16:35:57', '2017-08-09 16:35:57'),
(3, 2, 'Nitin Viras', '9033383570', 'surat', 'GST789', 'ds', '590.00', 18, 'invoice_3.pdf', '2017-09-12 20:52:26', '2017-09-12 20:52:26'),
(4, 2, 'Nitin Viras', '9033383570', 'surat', 'GST789', 'Surat', '1416.00', 18, 'invoice_4.pdf', '2017-12-07 21:19:14', '2017-12-07 21:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_product`
--

CREATE TABLE `tbl_invoice_product` (
  `ID` int(11) NOT NULL,
  `Invoice_ID` varchar(255) NOT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `ProductSize` varchar(255) DEFAULT NULL,
  `ProductQty` int(11) DEFAULT 0,
  `ProductHSN` varchar(255) DEFAULT NULL,
  `ProductRate` decimal(18,2) NOT NULL,
  `ProductAmount` decimal(18,2) NOT NULL,
  `Gst` decimal(18,2) NOT NULL,
  `Cgst` decimal(18,2) NOT NULL,
  `Sgst` decimal(18,2) NOT NULL,
  `NetAmount` decimal(18,2) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice_product`
--

INSERT INTO `tbl_invoice_product` (`ID`, `Invoice_ID`, `ProductName`, `ProductSize`, `ProductQty`, `ProductHSN`, `ProductRate`, `ProductAmount`, `Gst`, `Cgst`, `Sgst`, `NetAmount`, `CreatedOn`) VALUES
(1, '1', 'one', NULL, 1, '1', '1.00', '1.00', '28.00', '0.14', '0.14', '1.28', '2017-08-04 16:32:44'),
(2, '1', 'two', NULL, 2, '2', '2.00', '4.00', '28.00', '0.56', '0.56', '5.12', '2017-08-04 16:32:44'),
(3, '1', 'three', NULL, 3, '3', '3.00', '9.00', '28.00', '1.26', '1.26', '11.52', '2017-08-04 16:32:44'),
(4, '1', 'four', NULL, 4, '4', '4.00', '16.00', '28.00', '2.24', '2.24', '20.48', '2017-08-04 16:32:44'),
(5, '1', 'five', NULL, 5, '5', '5.00', '25.00', '28.00', '3.50', '3.50', '32.00', '2017-08-04 16:32:44'),
(6, '2', '2', NULL, 2, '2', '2.00', '4.00', '28.00', '0.56', '0.56', '5.12', '2017-08-04 18:56:14'),
(7, '3', 'one', NULL, 10, 'hgh67', '2.00', '20.00', '28.00', '2.80', '2.80', '25.60', '2017-08-04 22:01:48'),
(8, '3', 'twi', NULL, 55, '76675', '5.00', '275.00', '28.00', '38.50', '38.50', '352.00', '2017-08-04 22:01:48'),
(9, '3', '7657', NULL, 77, '765', '7.00', '539.00', '28.00', '75.46', '75.46', '689.92', '2017-08-04 22:01:48'),
(10, '4', '1', NULL, 1, '1', '1.00', '1.00', '18.00', '0.09', '0.09', '1.18', '2017-08-04 22:19:23'),
(11, '4', '2', NULL, 2, '2', '2.00', '4.00', '18.00', '0.36', '0.36', '4.72', '2017-08-04 22:19:23'),
(12, '4', '3', NULL, 3, '3', '3.00', '9.00', '18.00', '0.81', '0.81', '10.62', '2017-08-04 22:19:23'),
(13, '4', '4', NULL, 4, '4', '4.00', '16.00', '18.00', '1.44', '1.44', '18.88', '2017-08-04 22:19:23'),
(14, '4', '5', NULL, 66, '5', '67.00', '4422.00', '18.00', '397.98', '397.98', '5217.96', '2017-08-04 22:19:23'),
(15, '5', '8', NULL, 8, '8', '8.00', '64.00', '18.00', '5.76', '5.76', '75.52', '2017-08-04 22:22:29'),
(16, '6', 'Gliarin', NULL, 1, '12', '50.00', '50.00', '18.00', '4.50', '4.50', '59.00', '2017-08-05 10:45:26'),
(17, '6', 'Vitabbb', NULL, 2, '13', '60.00', '120.00', '18.00', '10.80', '10.80', '141.60', '2017-08-05 10:45:26'),
(18, '7', 'Washing liquid', NULL, 1, '#24', '130.00', '130.00', '18.00', '11.70', '11.70', '153.40', '2017-08-05 11:38:07'),
(19, '7', 'Hand wash', NULL, 11, '#25', '90.00', '990.00', '18.00', '89.10', '89.10', '1168.20', '2017-08-05 11:38:07'),
(20, '1', '1', '1', 1, '1', '1.00', '1.00', '18.00', '0.09', '0.09', '1.18', '2017-08-05 18:22:39'),
(21, '2', 'test', '5', 6, '5', '5.00', '30.00', '18.00', '2.70', '2.70', '35.40', '2017-08-09 16:35:57'),
(22, '2', 'dsfsfds', '5', 5, '5', '55.00', '275.00', '18.00', '24.75', '24.75', '324.50', '2017-08-09 16:35:57'),
(23, '3', 'kjh', '15', 10, '51', '50.00', '500.00', '18.00', '45.00', '45.00', '590.00', '2017-09-12 20:52:26'),
(24, '4', 'Lace', '12', 10, '921897h', '120.00', '1200.00', '18.00', '108.00', '108.00', '1416.00', '2017-12-07 21:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `ID` int(11) NOT NULL,
  `CompanyName` varchar(255) DEFAULT NULL,
  `OwnerName` varchar(255) NOT NULL,
  `CompanyPhone` varchar(255) DEFAULT NULL,
  `CompanyMobile` varchar(250) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `PinCode` int(11) NOT NULL,
  `State` varchar(255) NOT NULL,
  `GSTPercentage` int(11) NOT NULL DEFAULT 0,
  `GSTNo` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`ID`, `CompanyName`, `OwnerName`, `CompanyPhone`, `CompanyMobile`, `Address`, `City`, `PinCode`, `State`, `GSTPercentage`, `GSTNo`) VALUES
(1, 'Megh Infotech', 'Nitin Viras', '01122 13213', '9033383570', '58 govindnagars society,near dabholi char rasta,ved road', 'Surat', 395004, '', 50, '1321321210');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_admin_users`
--
ALTER TABLE `tbl_admin_users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_invoice_product`
--
ALTER TABLE `tbl_invoice_product`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_admin_users`
--
ALTER TABLE `tbl_admin_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_invoice_product`
--
ALTER TABLE `tbl_invoice_product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
