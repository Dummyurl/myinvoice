-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 26, 2018 at 11:05 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myinvoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Firstname` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(100) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `GSTno` varchar(100) NOT NULL,
  `Status` varchar(10) NOT NULL DEFAULT 'A',
  `CreatedOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `AddressLine1` text,
  `AddressSuitUnit` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `State` varchar(255) DEFAULT 'CA',
  `ZipCode` varchar(50) DEFAULT NULL,
  `ProfileImage` text,
  `Type` varchar(255) DEFAULT NULL COMMENT 'SA=Super Admin,HA=Hospice Admin,NA=Nurse Admin',
  `Status` enum('A','I') DEFAULT 'A' COMMENT 'A=Active,I=Inactive',
  `reset_password_check` int(1) NOT NULL DEFAULT '0',
  `CreatedDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL DEFAULT '0',
  `CustomerName` varchar(255) DEFAULT NULL,
  `CustomerPhone` varchar(255) DEFAULT NULL,
  `CustomerAddress` varchar(255) DEFAULT NULL,
  `CustomerGSTNo` varchar(255) NOT NULL,
  `PlaceOfSuppy` varchar(255) NOT NULL,
  `NetAmount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `GST` int(11) NOT NULL,
  `invoice_name` varchar(255) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UpdatedOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_product`
--

CREATE TABLE `tbl_invoice_product` (
  `ID` int(11) NOT NULL,
  `Invoice_ID` int(11) NOT NULL DEFAULT '0',
  `ProductName` varchar(255) DEFAULT NULL,
  `ProductSize` varchar(255) DEFAULT NULL,
  `ProductQty` int(11) DEFAULT '0',
  `ProductHSN` varchar(255) DEFAULT NULL,
  `ProductRate` decimal(18,2) NOT NULL,
  `ProductAmount` decimal(18,2) NOT NULL,
  `Gst` decimal(18,2) NOT NULL,
  `Cgst` decimal(18,2) NOT NULL,
  `Sgst` decimal(18,2) NOT NULL,
  `NetAmount` decimal(18,2) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login_master`
--

CREATE TABLE `tbl_login_master` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CompanyLogo` varchar(100) NOT NULL,
  `CompanyName` varchar(255) DEFAULT NULL,
  `OwnerName` varchar(255) NOT NULL,
  `CompanyPhone` varchar(255) DEFAULT NULL,
  `CompanyMobile` varchar(250) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `PinCode` int(11) NOT NULL,
  `State` varchar(255) NOT NULL,
  `GSTPercentage` int(11) NOT NULL DEFAULT '0',
  `GSTNo` varchar(255) NOT NULL DEFAULT '0',
  `CurrencySymbol` varchar(255) CHARACTER SET utf8 NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UpdatedOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`ID`, `UserID`, `CompanyLogo`, `CompanyName`, `OwnerName`, `CompanyPhone`, `CompanyMobile`, `Address`, `City`, `PinCode`, `State`, `GSTPercentage`, `GSTNo`, `CurrencySymbol`, `CreatedOn`, `UpdatedOn`) VALUES
(2, 5, '5a6af22b237dd.png', 'invoice', 'admin', '0123456789', '0123456789', 'surat', 'surat', 534343, '', 10, '0', '₹', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Firstname` varchar(255) DEFAULT NULL,
  `Lastname` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Phone` varchar(100) DEFAULT NULL,
  `ProfileImage` text,
  `Status` enum('A','I') DEFAULT 'A' COMMENT 'A=Active,I=Inactive',
  `reset_password_check` int(1) NOT NULL DEFAULT '0',
  `CreatedDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`ID`, `Username`, `Password`, `Firstname`, `Lastname`, `Email`, `Phone`, `ProfileImage`, `Status`, `reset_password_check`, `CreatedDate`, `UpdatedDate`) VALUES
(5, 'piyush', 'b1475c86962de59729daa6e056d2256e', 'piyush', 'patel', 'piyushrabadiya1@gmail.com', '9876543210', '6.jpeg', 'A', 0, '2018-01-26 08:40:15', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `tbl_admin_users`
--
ALTER TABLE `tbl_admin_users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `tbl_invoice_product`
--
ALTER TABLE `tbl_invoice_product`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Invoice_ID` (`Invoice_ID`);

--
-- Indexes for table `tbl_login_master`
--
ALTER TABLE `tbl_login_master`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_admin_users`
--
ALTER TABLE `tbl_admin_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_invoice_product`
--
ALTER TABLE `tbl_invoice_product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_login_master`
--
ALTER TABLE `tbl_login_master`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `tbl_users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD CONSTRAINT `tbl_invoice_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `tbl_users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_invoice_product`
--
ALTER TABLE `tbl_invoice_product`
  ADD CONSTRAINT `tbl_invoice_product_ibfk_1` FOREIGN KEY (`Invoice_ID`) REFERENCES `tbl_invoice` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_login_master`
--
ALTER TABLE `tbl_login_master`
  ADD CONSTRAINT `tbl_login_master_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `tbl_users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD CONSTRAINT `tbl_setting_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `tbl_users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
