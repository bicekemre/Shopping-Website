-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2022 at 12:49 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electronicshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `UserID` int(10) UNSIGNED NOT NULL,
  `NameSurname` varchar(100) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `District` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `PhoneNumber` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='addresses';

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `AdminName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `NameSurname` varchar(150) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `UndeletingStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `AdminName`, `Password`, `NameSurname`, `Email`, `Phone`, `UndeletingStatus`) VALUES
(1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'admin', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bankaccounts`
--

CREATE TABLE `bankaccounts` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `BankLogo` varchar(255) NOT NULL,
  `BankName` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `AccountHolder` varchar(30) NOT NULL,
  `AccountNu` varchar(50) NOT NULL,
  `IBAN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `BannerArea` varchar(100) NOT NULL,
  `BannerName` varchar(100) NOT NULL,
  `BannerPicture` varchar(100) NOT NULL,
  `Views` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `id` int(10) UNSIGNED NOT NULL,
  `BasketNO` int(10) NOT NULL,
  `UserID` int(10) NOT NULL,
  `ItemID` int(10) NOT NULL,
  `AddressID` int(10) NOT NULL,
  `VariantID` int(10) NOT NULL,
  `ShippingID` tinyint(2) NOT NULL,
  `ItemAmount` tinyint(3) NOT NULL,
  `Payment` varchar(50) NOT NULL,
  `Installment` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cargocompanies`
--

CREATE TABLE `cargocompanies` (
  `id` int(10) UNSIGNED NOT NULL,
  `CargoLogo` varchar(100) NOT NULL,
  `CargoCompanyName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `ItemID` int(10) UNSIGNED NOT NULL,
  `UserID` int(10) UNSIGNED NOT NULL,
  `Rating` int(10) UNSIGNED NOT NULL,
  `CommentText` text NOT NULL,
  `CommentDate` int(10) NOT NULL,
  `CommentIPAddress` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contractsandtexts`
--

CREATE TABLE `contractsandtexts` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `Aboutus` text NOT NULL,
  `MembershipContracts` text NOT NULL,
  `TermsofUse` text NOT NULL,
  `ConfidentialityAgreement` text NOT NULL,
  `DistanceSalesAgreement` text NOT NULL,
  `DeliveryText` text NOT NULL,
  `ReturnsReplacements` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contractsandtexts`
--

INSERT INTO `contractsandtexts` (`id`, `Aboutus`, `MembershipContracts`, `TermsofUse`, `ConfidentialityAgreement`, `DistanceSalesAgreement`, `DeliveryText`, `ReturnsReplacements`) VALUES
(0, 'This is the About Us Text.\r\n\r\n\r\nThis is the About Us Text.\r\n\r\n\r\nThis is the About Us Text.\r\n\r\n\r\nThis is the About Us Text.', 'This is the Membership Agreement Text.\r\n\r\n\r\nThis is the Membership Agreement Text.\r\n\r\n\r\nThis is the Membership Agreement Text.', 'This is the Terms of Use Text.\r\n\r\n\r\nThis is the Terms of Use Text.\r\n\r\n\r\nThis is the Terms of Use Text.', 'This is the Text of the Confidentiality Agreement.\r\n\r\n\r\n\r\n\r\nThis is the Text of the Confidentiality Agreement.\r\n\r\n\r\n\r\n\r\nThis is the Text of the Confidentiality Agreement.', 'This is the Text of the Distance Sales Agreement\r\n\r\n\r\n\r\nThis is the Text of the Distance Sales Agreement\r\n\r\nThis is the Text of the Distance Sales Agreement', 'This is the Delivery Text.\r\n\r\n\r\n\r\nThis is the Delivery Text.\r\n\r\n\r\n\r\nThis is the Delivery Text.', 'This is the Cancellation Refund Exchange Text.\r\n\r\n\r\n\r\nThis is the Cancellation Refund Exchange Text.\r\n\r\n\r\nThis is the Cancellation Refund Exchange Text.');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(10) UNSIGNED NOT NULL,
  `ItemID` int(10) UNSIGNED NOT NULL,
  `UserID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `MenuID` int(10) UNSIGNED NOT NULL,
  `ItemType` varchar(100) NOT NULL,
  `ItemName` varchar(255) NOT NULL,
  `ItemPrice` double UNSIGNED NOT NULL,
  `Currency` char(3) NOT NULL,
  `ItemAbout` text NOT NULL,
  `ItemPicOne` varchar(50) NOT NULL,
  `ItemPicTwo` varchar(30) NOT NULL,
  `ItemPicThree` varchar(30) NOT NULL,
  `ItemPicFour` varchar(30) NOT NULL,
  `VariantTitle` varchar(100) NOT NULL,
  `ShippingPrice` double NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `SalesAmount` int(100) NOT NULL,
  `CommentNumber` tinyint(1) NOT NULL,
  `Rating` int(10) NOT NULL,
  `Views` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `itemsvariants`
--

CREATE TABLE `itemsvariants` (
  `id` int(10) UNSIGNED NOT NULL,
  `ItemID` int(10) NOT NULL,
  `VariantName` varchar(100) NOT NULL,
  `StockNumber` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `EmailAddress` varchar(255) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `NameSurname` varchar(150) NOT NULL,
  `PhoneNumber` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `DeletingStatus` tinyint(1) UNSIGNED NOT NULL,
  `RegisDate` int(10) NOT NULL,
  `RegisIPaddress` varchar(20) NOT NULL,
  `ActivationCode` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `ItemType` varchar(100) NOT NULL,
  `MenuName` varchar(100) NOT NULL,
  `ItemAmount` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `UserID` int(10) NOT NULL,
  `OrderNO` int(10) NOT NULL,
  `ItemID` int(10) NOT NULL,
  `ItemType` varchar(50) NOT NULL,
  `ItemName` varchar(255) NOT NULL,
  `ItemPrice` double NOT NULL,
  `ItemAmount` int(3) NOT NULL,
  `TotalItemPrice` double NOT NULL,
  `ShippingChoice` varchar(100) NOT NULL,
  `ShippingPrice` double NOT NULL,
  `ItemPicOne` varchar(30) NOT NULL,
  `VariantTitle` varchar(100) NOT NULL,
  `VariantChoice` varchar(100) NOT NULL,
  `AddressNameSurname` varchar(100) NOT NULL,
  `AddressDetail` varchar(255) NOT NULL,
  `AddressPhone` varchar(11) NOT NULL,
  `Payment` varchar(25) NOT NULL,
  `Installment` int(2) NOT NULL,
  `OrderDate` int(10) NOT NULL,
  `OrderIPaddress` varchar(20) NOT NULL,
  `OrderConfirmStatus` tinyint(1) NOT NULL,
  `ShippingStatus` tinyint(1) NOT NULL,
  `ShippingCode` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `answer`) VALUES
(2, 'QUESTION', 'ANSWER'),
(3, 'QUESTION', 'ANSWER');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` tinyint(1) UNSIGNED NOT NULL,
  `SiteName` varchar(100) NOT NULL,
  `SiteTitle` varchar(25) NOT NULL,
  `SiteDescription` varchar(150) NOT NULL,
  `SiteKeywords` varchar(255) NOT NULL,
  `SiteCopyright` varchar(255) NOT NULL,
  `SiteLogo` varchar(30) NOT NULL,
  `SiteLink` varchar(255) NOT NULL,
  `SiteEmailAdress` varchar(50) NOT NULL,
  `SiteEmailPassword` varchar(50) NOT NULL,
  `SiteHostAddress` varchar(100) NOT NULL,
  `Facebooklink` varchar(255) NOT NULL,
  `Twitterlink` varchar(255) NOT NULL,
  `Linkedlnlink` varchar(255) NOT NULL,
  `Instagramlink` varchar(255) NOT NULL,
  `Pinterestlink` varchar(255) NOT NULL,
  `YouTubelink` varchar(255) NOT NULL,
  `eurusd` double UNSIGNED NOT NULL,
  `FreeShipping` double UNSIGNED NOT NULL,
  `ClientID` varchar(100) NOT NULL,
  `StoreKey` varchar(100) NOT NULL,
  `ApiUser` varchar(150) NOT NULL,
  `ApiPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `SiteName`, `SiteTitle`, `SiteDescription`, `SiteKeywords`, `SiteCopyright`, `SiteLogo`, `SiteLink`, `SiteEmailAdress`, `SiteEmailPassword`, `SiteHostAddress`, `Facebooklink`, `Twitterlink`, `Linkedlnlink`, `Instagramlink`, `Pinterestlink`, `YouTubelink`, `eurusd`, `FreeShipping`, `ClientID`, `StoreKey`, `ApiUser`, `ApiPassword`) VALUES
(1, 'Electronic Shop', 'Electronic Shop', 'all about computers and phones', 'electronics,phone,phones,computer,pc', 'Copyright 2022 - Electronic Shop - All Rights Reserved', 'Logo.png', 'http://localhost/Basic%20E-Commerce%20Site', '', '', 'smtp.gmail.com', 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.linkedin.com/in/emre-bicek/', 'https://instagram.com', 'https://pinterest.com', 'https://youtube.com', 1.12, 0, '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`,`UserID`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bankaccounts`
--
ALTER TABLE `bankaccounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cargocompanies`
--
ALTER TABLE `cargocompanies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contractsandtexts`
--
ALTER TABLE `contractsandtexts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemsvariants`
--
ALTER TABLE `itemsvariants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `EmailAddress` (`EmailAddress`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bankaccounts`
--
ALTER TABLE `bankaccounts`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cargocompanies`
--
ALTER TABLE `cargocompanies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `itemsvariants`
--
ALTER TABLE `itemsvariants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
