-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8111
-- Generation Time: Mar 31, 2023 at 01:24 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(11) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(11, 'Fernando', 'Arias', 'new@gmail.com', '$2y$10$2fHTCiEwJ6kiadZdGuUbHukFUNzu58pPLz2GsHXPGMi5/7YdT.96W', '3', NULL),
(13, 'Fernando', 'Arias', 'elderarias2015@gmail.com', '$2y$10$KGscs548MsaHA1bc7QnRE.yTIFJQtOF9oRn20jEbyy5JJ.5uMXPyi', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(7, 1, 'wrangler.jpg', '/phpmotors/images/vehicles/wrangler.jpg', '2023-03-15 02:20:00', 1),
(8, 1, 'wrangler-tn.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '2023-03-15 02:20:00', 1),
(9, 2, 'ford-modelt.jpg', '/phpmotors/images/vehicles/ford-modelt.jpg', '2023-03-15 02:20:18', 1),
(10, 2, 'ford-modelt-tn.jpg', '/phpmotors/images/vehicles/ford-modelt-tn.jpg', '2023-03-15 02:20:18', 1),
(11, 3, 'lambo-Adve.jpg', '/phpmotors/images/vehicles/lambo-Adve.jpg', '2023-03-15 02:21:20', 1),
(12, 3, 'lambo-Adve-tn.jpg', '/phpmotors/images/vehicles/lambo-Adve-tn.jpg', '2023-03-15 02:21:20', 1),
(13, 4, 'monster.jpg', '/phpmotors/images/vehicles/monster.jpg', '2023-03-15 02:21:35', 1),
(14, 4, 'monster-tn.jpg', '/phpmotors/images/vehicles/monster-tn.jpg', '2023-03-15 02:21:36', 1),
(15, 5, 'ms.jpg', '/phpmotors/images/vehicles/ms.jpg', '2023-03-15 02:21:54', 1),
(16, 5, 'ms-tn.jpg', '/phpmotors/images/vehicles/ms-tn.jpg', '2023-03-15 02:21:54', 1),
(17, 6, 'bat.jpg', '/phpmotors/images/vehicles/bat.jpg', '2023-03-15 02:22:02', 1),
(18, 6, 'bat-tn.jpg', '/phpmotors/images/vehicles/bat-tn.jpg', '2023-03-15 02:22:02', 1),
(19, 7, 'mm.jpg', '/phpmotors/images/vehicles/mm.jpg', '2023-03-15 02:22:23', 1),
(20, 7, 'mm-tn.jpg', '/phpmotors/images/vehicles/mm-tn.jpg', '2023-03-15 02:22:23', 1),
(21, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2023-03-15 02:22:35', 1),
(22, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2023-03-15 02:22:35', 1),
(23, 9, 'crown-vic.jpg', '/phpmotors/images/vehicles/crown-vic.jpg', '2023-03-15 02:22:50', 1),
(24, 9, 'crown-vic-tn.jpg', '/phpmotors/images/vehicles/crown-vic-tn.jpg', '2023-03-15 02:22:50', 1),
(25, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2023-03-15 02:23:06', 1),
(26, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2023-03-15 02:23:06', 1),
(27, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2023-03-15 02:23:22', 1),
(28, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2023-03-15 02:23:22', 1),
(29, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2023-03-15 02:23:36', 1),
(30, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2023-03-15 02:23:36', 1),
(31, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2023-03-15 02:23:48', 1),
(32, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2023-03-15 02:23:48', 1),
(33, 14, 'fbi.jpg', '/phpmotors/images/vehicles/fbi.jpg', '2023-03-15 02:24:08', 1),
(34, 14, 'fbi-tn.jpg', '/phpmotors/images/vehicles/fbi-tn.jpg', '2023-03-15 02:24:08', 1),
(35, 15, 'dog.jpg', '/phpmotors/images/vehicles/dog.jpg', '2023-03-15 02:24:22', 1),
(36, 15, 'dog-tn.jpg', '/phpmotors/images/vehicles/dog-tn.jpg', '2023-03-15 02:24:22', 1),
(37, 30, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2023-03-15 02:32:51', 1),
(38, 30, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2023-03-15 02:32:51', 1),
(39, 4, 'monster-2.jpeg', '/phpmotors/images/vehicles/monster-2.jpeg', '2023-03-15 03:08:04', 0),
(40, 4, 'monster-2-tn.jpeg', '/phpmotors/images/vehicles/monster-2-tn.jpeg', '2023-03-15 03:08:04', 0),
(41, 12, 'hummer-2.jpg', '/phpmotors/images/vehicles/hummer-2.jpg', '2023-03-15 03:08:20', 0),
(42, 12, 'hummer-2-tn.jpg', '/phpmotors/images/vehicles/hummer-2-tn.jpg', '2023-03-15 03:08:20', 0),
(43, 9, 'crown-vic-2.jpeg', '/phpmotors/images/vehicles/crown-vic-2.jpeg', '2023-03-15 03:08:56', 0),
(44, 9, 'crown-vic-2-tn.jpeg', '/phpmotors/images/vehicles/crown-vic-2-tn.jpeg', '2023-03-15 03:08:56', 0),
(45, 8, 'fire-truck-1.jpg', '/phpmotors/images/vehicles/fire-truck-1.jpg', '2023-03-18 16:01:43', 0),
(46, 8, 'fire-truck-1-tn.jpg', '/phpmotors/images/vehicles/fire-truck-1-tn.jpg', '2023-03-18 16:01:43', 0),
(47, 8, 'fire-truck-2.jpeg', '/phpmotors/images/vehicles/fire-truck-2.jpeg', '2023-03-18 16:02:12', 0),
(48, 8, 'fire-truck-2-tn.jpeg', '/phpmotors/images/vehicles/fire-truck-2-tn.jpeg', '2023-03-18 16:02:12', 0),
(49, 8, 'fire-truck-3.jpeg', '/phpmotors/images/vehicles/fire-truck-3.jpeg', '2023-03-18 16:02:23', 0),
(50, 8, 'fire-truck-3-tn.jpeg', '/phpmotors/images/vehicles/fire-truck-3-tn.jpeg', '2023-03-18 16:02:23', 0),
(51, 4, 'monster-1.jpeg', '/phpmotors/images/vehicles/monster-1.jpeg', '2023-03-18 16:04:43', 0),
(52, 4, 'monster-1-tn.jpeg', '/phpmotors/images/vehicles/monster-1-tn.jpeg', '2023-03-18 16:04:43', 0),
(53, 4, 'monster-3.jpeg', '/phpmotors/images/vehicles/monster-3.jpeg', '2023-03-18 16:04:54', 0),
(54, 4, 'monster-3-tn.jpeg', '/phpmotors/images/vehicles/monster-3-tn.jpeg', '2023-03-18 16:04:54', 0),
(55, 12, 'hummer-1.jpg', '/phpmotors/images/vehicles/hummer-1.jpg', '2023-03-18 16:07:19', 0),
(56, 12, 'hummer-1-tn.jpg', '/phpmotors/images/vehicles/hummer-1-tn.jpg', '2023-03-18 16:07:19', 0),
(57, 12, 'hummer-3.jpeg', '/phpmotors/images/vehicles/hummer-3.jpeg', '2023-03-18 16:07:29', 0),
(58, 12, 'hummer-3-tn.jpeg', '/phpmotors/images/vehicles/hummer-3-tn.jpeg', '2023-03-18 16:07:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!', '/phpmotors/images/vehicles/wrangler.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '28045', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.', '/phpmotors/images/vehicles/ford-modelt.jpg', '/phpmotors/images/vehicles/ford-modelt-tn.jpg', '30000', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '/phpmotors/images/vehicles/lambo-Adve.jpg', '/phpmotors/images/vehicles/lambo-Adve-tn.jpg', '417650', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster.jpg', '/phpmotors/images/vehicles/monster-tn.jpg', '150000', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. However, with a little tender loving care it will run as good a new.', '/phpmotors/images/vehicles/ms.jpg', '/phpmotors/images/vehicles/ms-tn.jpg', '100', 1, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.', '/phpmotors/images/vehicles/bat.jpg', '/phpmotors/images/vehicles/bat-tn.jpg', '65000', 1, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mm.jpg', '/phpmotors/images/vehicles/mm-tn.jpg', '10000', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.', '/phpmotors/images/vehicles/fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '50000', 1, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equipped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crown-vic.jpg', '/phpmotors/images/vehicles/crown-vic-tn.jpg', '10000', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '25000', 10, 'Silver', 3),
(11, 'Cadillac', 'Escalade', 'This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '75195', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '58800', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!', '/phpmotors/images/vehicles/aerocar.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '1000000', 1, 'Red', 2),
(14, 'FBI', 'Surveillance Van', 'Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month.', '/phpmotors/images/vehicles/fbi.jpg', '/phpmotors/images/vehicles/fbi-tn.jpg', '20000', 1, 'Green', 1),
(15, 'Dog', 'Car', 'Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.', '/phpmotors/images/vehicles/dog.jpg', '/phpmotors/images/vehicles/dog-tn.jpg', '35000', 1, 'Brown', 2),
(30, 'DMC', 'Delorean', 'The DMC DeLorean is a sports car manufactured by the DeLorean Motor Company (DMC) between 1981 and 1982. It is known as the DeLorean, since this was the only model that the company made.', '/phpmotors/images/vehicles/delorean.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '4000', 1, 'Gray', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(21, 'This vehicle is awesome and I reccomend you to buy it.', '2023-03-30 00:19:24', 5, 13),
(22, 'A new review for the vehicle Ford Crown. This is an awesome vehicle.', '2023-03-30 00:24:46', 9, 13),
(27, 'A monster vehicle that is awesome. This review has been updated for some reasons.', '2023-03-30 22:33:13', 4, 13),
(28, 'A new review for the hummer vehicle.', '2023-03-30 22:42:04', 12, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `FK_inv_images` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_clients` (`clientId`),
  ADD KEY `FK_reviews_inventory` (`invId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
