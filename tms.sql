-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 02:42 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Name` varchar(250) DEFAULT NULL,
  `EmailId` varchar(250) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Name`, `EmailId`, `MobileNumber`, `Password`, `updationDate`) VALUES
(1, 'admin', 'Administrator', 'admin@gmail.com', 1234567890, '827ccb0eea8a706c4c34a16891f84e7b', '2024-01-10 11:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `BookingId` int(11) NOT NULL,
  `PackageId` int(11) DEFAULT NULL,
  `UserEmail` varchar(100) DEFAULT NULL,
  `FromDate` varchar(100) DEFAULT NULL,
  `ToDate` varchar(100) DEFAULT NULL,
  `Comment` mediumtext,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  `CancelledBy` varchar(5) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`BookingId`, `PackageId`, `UserEmail`, `FromDate`, `ToDate`, `Comment`, `RegDate`, `status`, `CancelledBy`, `UpdationDate`) VALUES
(7, 1, 'arnob@gmail.com', '2024-11-24', '2024-11-27', 'Hello its me', '2024-11-24 08:48:37', 2, 'u', '2024-12-03 06:31:06'),
(8, 1, 'arnob@gmail.com', '2024-11-24', '2024-11-27', 'Hello its me', '2024-11-24 09:06:40', 2, 'u', '2024-12-03 06:31:16'),
(9, 1, 'arnob@gmail.com', '2024-11-14', '2024-11-17', 'jjj', '2024-11-24 09:51:39', 2, 'u', '2024-12-03 16:18:36'),
(10, 1, 'arnob@gmail.com', NULL, NULL, 'Hello its me', '2024-11-28 05:53:43', 0, NULL, NULL),
(11, 1, 'arnob@gmail.com', NULL, NULL, '', '2024-11-28 05:56:43', 0, NULL, NULL),
(12, 1, 'arnob@gmail.com', NULL, NULL, '', '2024-11-28 09:25:57', 2, 'a', '2024-11-28 09:26:15'),
(13, 1, 'arnob@gmail.com', NULL, NULL, '', '2024-11-28 09:28:01', 1, NULL, '2024-11-28 09:28:10'),
(14, 1, 'arnob@gmail.com', '2024-12-04', '2024-12-03', '', '2024-12-03 06:04:43', 0, NULL, NULL),
(15, 1, NULL, '2024-12-04', '2024-12-03', '', '2024-12-03 06:05:09', 2, 'a', '2024-12-03 06:30:06'),
(16, 1, 'arnob@gmail.com', '2024-12-04', '2024-12-05', '', '2024-12-03 06:08:26', 1, NULL, '2024-12-04 13:29:52'),
(17, 3, 'arnob@gmail.com', '2024-12-05', '2024-12-08', '', '2024-12-04 14:19:30', 0, NULL, NULL),
(18, 3, 'arnob@gmail.com', '2024-12-05', '2024-12-08', '', '2024-12-04 14:31:32', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblenquiry`
--

CREATE TABLE `tblenquiry` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `MobileNumber` char(10) DEFAULT NULL,
  `Subject` varchar(100) DEFAULT NULL,
  `Description` mediumtext,
  `PostingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblenquiry`
--

INSERT INTO `tblenquiry` (`id`, `FullName`, `EmailId`, `MobileNumber`, `Subject`, `Description`, `PostingDate`, `Status`) VALUES
(1, 'alatf', 'admin@gmail.com', '1234567654', 'dfgh', 'bgfnhmgj,', '2024-12-03 16:16:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblissues`
--

CREATE TABLE `tblissues` (
  `id` int(11) NOT NULL,
  `UserEmail` varchar(100) DEFAULT NULL,
  `Issue` varchar(100) DEFAULT NULL,
  `Description` mediumtext,
  `PostingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `AdminRemark` mediumtext,
  `AdminremarkDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT '',
  `detail` longtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `type`, `detail`) VALUES
(1, 'terms', '																				<p align=\"justify\"><span style=\"color: rgb(153, 0, 0); font-size: small; font-weight: 700;\">terms and condition page</span></p>\r\n										\r\n										'),
(2, 'privacy', '										<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Privacy Policy</span>\r\n										'),
(3, 'aboutus', '										<div><span style=\"color: rgb(0, 0, 0); font-family: Georgia; font-size: 15px; text-align: justify; font-weight: bold;\">Welcome to TravelEase System!!!</span></div><span style=\"font-family: &quot;courier new&quot;;\"><span style=\"color: rgb(0, 0, 0); font-size: 15px; text-align: justify;\"></span></span>\r\n										'),
(11, 'contact', '																				<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Address------NSTU</span>');

-- --------------------------------------------------------

--
-- Table structure for table `tbltourguides`
--

CREATE TABLE `tbltourguides` (
  `NationalID` varchar(50) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Experience` int(11) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Details` text NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `PricePerDay` decimal(10,2) NOT NULL,
  `Available` tinyint(1) NOT NULL DEFAULT '1',
  `CreationDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltourguides`
--

INSERT INTO `tbltourguides` (`NationalID`, `Name`, `Email`, `Phone`, `Experience`, `Location`, `Details`, `Image`, `PricePerDay`, `Available`, `CreationDate`, `UpdationDate`) VALUES
('12346', 'efaz', 'efaz@gmail.com', '01777777777', 5, 'chandpur', 'gfghfhj', '3135715.png', '10.00', 1, '2024-12-04 20:16:35', '2024-12-04 14:16:35'),
('8436476', 'mamun', 'manun@gmail.com', '0177777777888', 4, 'chandpur', 'gldrlkyknpnpi', NULL, '60.00', 0, '2024-12-04 20:19:01', '2024-12-04 14:31:23'),
('8436476036', 'asif', 'arnob@gmail.com', '01777777777', 5, 'khulna', 'dfghbfvcxzv', '3135715.png', '67.00', 1, '2024-12-03 22:06:42', '2024-12-03 16:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbltourpackages`
--

CREATE TABLE `tbltourpackages` (
  `PackageId` int(11) NOT NULL,
  `PackageName` varchar(200) DEFAULT NULL,
  `PackageType` varchar(150) DEFAULT NULL,
  `PackageLocation` varchar(100) DEFAULT NULL,
  `PackagePrice` int(11) DEFAULT NULL,
  `PackageFetures` varchar(255) DEFAULT NULL,
  `PackageDetails` mediumtext,
  `PackageImage` varchar(100) DEFAULT NULL,
  `Creationdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltourpackages`
--

INSERT INTO `tbltourpackages` (`PackageId`, `PackageName`, `PackageType`, `PackageLocation`, `PackagePrice`, `PackageFetures`, `PackageDetails`, `PackageImage`, `Creationdate`, `UpdationDate`) VALUES
(1, 'Sundarban Serenity Adventure (Group Package)', 'Group Package', 'Khulna', 6000, ' Round trip Economy class airfare valid for the duration of the holiday - Airport taxes - Accommodation for 3 nights in Paris and 3 nights in scenic Switzerland - Enjoy continental breakfasts every morning - Enjoy 5 Indian dinners in Mainland Europe - Exp', 'Choose this holiday for an enchanting journey into the heart of the Sundarbans, the world\'s largest mangrove forest and a UNESCO World Heritage Site. Your tour begins in Khulna or Mongla, where you\'ll board a luxury boat for an immersive experience. Explore popular attractions like the Royal Bengal Tiger\'s natural habitat, the breathtaking Sundarban creeks, and the wildlife-rich Kotka and Kachikhali areas. While cruising through tranquil rivers, enjoy stops at various watchtowers, including Jamtola Beach for a serene stroll. A guided tour to the Dobeki Camp and visits to local fishing villages will complete your memorable adventure.', 'deer.jpg', '2024-07-15 05:21:58', '2024-12-04 14:06:50'),
(2, 'hatiya', 'family', 'Hatiya', 1000, 'pick and drop free', 'details', '2g29g24.jpg', '2024-11-28 09:22:43', NULL),
(3, 'chandpur tour', 'family', 'Khulna', 1000, 'pick and drop free', 'kj.asdgfbldldbslbvlbdls', '2g29g24.jpg', '2024-12-04 13:49:44', '2024-12-04 14:50:47'),
(4, 'Sundarbans Safari', 'Wildlife', 'Sundarbans', 20000, 'Boat Safari, Wildlife Watching', 'Discover the wildlife of the Sundarbans, including the Royal Bengal Tiger, through a 3-day guided boat safari.', 'sundarbans_safari.jpg', '2024-12-05 01:16:27', NULL),
(5, 'Tea Garden Retreat', 'Relaxation', 'Sylhet', 12000, 'Tea Gardens, Nature Walks', 'Relax in the serene tea gardens of Sylhet with nature walks and visits to local attractions.', 'tea_garden_retreat.jpg', '2024-12-05 01:16:27', NULL),
(6, 'River Cruise', 'Luxury', 'Padma River', 25000, 'Luxury Cruise, Gourmet Meals', 'Enjoy a luxurious 2-day cruise on the Padma River with gourmet meals and premium amenities.', 'river_cruise.jpg', '2024-12-05 01:16:27', NULL),
(7, 'Eco Village Experience', 'Eco-Tourism', 'Rangamati', 14000, 'Eco-Friendly Stay, Boating', 'A 2-day stay in an eco-friendly village in Rangamati, with boating and cultural performances.', 'eco_village.jpg', '2024-12-05 01:16:27', NULL),
(8, 'City Break', 'City Tour', 'Chattogram', 9000, 'City Attractions, Nightlife', 'Explore the bustling city of Chattogram with guided tours of popular attractions and nightlife spots.', 'city_break.jpg', '2024-12-05 01:16:27', NULL),
(9, 'Historical Marvels', 'Cultural', 'Sonargaon', 8000, 'Museums, Archaeological Sites', 'A 1-day tour of Sonargaon, exploring its rich history and archaeological sites.', 'historical_marvels.jpg', '2024-12-05 01:16:27', NULL),
(10, 'Fishing Adventure', 'Outdoor', 'Kuakata', 13000, 'Fishing, Beach Activities', 'Enjoy a fishing adventure and beach activities in Kuakata with expert guides.', 'fishing_adventure.jpg', '2024-12-05 01:16:27', NULL),
(11, 'Beach Paradise', 'Relaxation', 'Cox’s Bazar', 15000, 'Beach View, Free Meals', 'A 3-day package to Cox’s Bazar, including visits to the beach, sunset views, and complimentary meals.', 'beach_paradise.jpg', '2024-12-05 01:16:27', NULL),
(12, 'Hill Adventure', 'Adventure', 'Bandarban', 18000, 'Hiking, Waterfall Trekking', 'Explore the lush green hills of Bandarban with guided trekking, visits to waterfalls, and local culture immersion.', 'hill_adventure.jpg', '2024-12-05 01:16:27', NULL),
(13, 'Heritage Tour', 'Cultural', 'Dhaka', 10000, 'Historical Sites, Guided Tours', 'A 2-day heritage tour of Dhaka City, exploring historical landmarks and local traditions.', 'heritage_tour.jpg', '2024-12-05 01:16:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `MobileNumber` char(10) DEFAULT NULL,
  `EmailId` varchar(70) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `FullName`, `MobileNumber`, `EmailId`, `Password`, `RegDate`, `UpdationDate`) VALUES
(13, 'Arnob Das', '0199999999', 'arnob@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2024-11-24 08:47:36', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`BookingId`);

--
-- Indexes for table `tblenquiry`
--
ALTER TABLE `tblenquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblissues`
--
ALTER TABLE `tblissues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltourguides`
--
ALTER TABLE `tbltourguides`
  ADD PRIMARY KEY (`NationalID`);

--
-- Indexes for table `tbltourpackages`
--
ALTER TABLE `tbltourpackages`
  ADD PRIMARY KEY (`PackageId`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `EmailId` (`EmailId`),
  ADD KEY `EmailId_2` (`EmailId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `BookingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblenquiry`
--
ALTER TABLE `tblenquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblissues`
--
ALTER TABLE `tblissues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbltourpackages`
--
ALTER TABLE `tbltourpackages`
  MODIFY `PackageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
