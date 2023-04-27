-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Database: `phpmotors`
--
--
-- Table structure for table `inventory`
--
DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `invId` int UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10, 0) NOT NULL,
  `invStock` smallint NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `inventory`
--
INSERT INTO `inventory` (
    `invId`,
    `invMake`,
    `invModel`,
    `invDescription`,
    `invImage`,
    `invThumbnail`,
    `invPrice`,
    `invStock`,
    `invColor`,
    `classificationId`
  )
VALUES (
    1,
    'Jeep ',
    'Wrangler',
    'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!',
    '/images/wrangler.jpg',
    '/images/wrangler-tn.jpg',
    '28045',
    4,
    'Orange',
    1
  ),
  (
    2,
    'Ford',
    'Model T',
    'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.',
    '/images/ford-modelt.jpg',
    '/images/ford-modelt-tn.jpg',
    '30000',
    2,
    'Black',
    2
  ),
  (
    3,
    'Lamborghini',
    'Adventador',
    'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.',
    '/images/lambo-Adve.jpg',
    '/images/lambo-Adve-tn.jpg',
    '417650',
    1,
    'Blue',
    3
  ),
  (
    4,
    'Monster',
    'Truck',
    'Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.',
    '/images/monster.jpg',
    '/images/monster-tn.jpg',
    '150000',
    3,
    'purple',
    4
  ),
  (
    5,
    'Mechanic',
    'Special',
    'Not sure where this car came from. However, with a little tender loving care it will run as good a new.',
    '/images/ms.jpg',
    '/images/ms-tn.jpg',
    '100',
    1,
    'Rust',
    5
  ),
  (
    6,
    'Batmobile',
    'Custom',
    'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.',
    '/images/bat.jpg',
    '/images/bat-tn.jpg',
    '65000',
    1,
    'Black',
    3
  ),
  (
    7,
    'Mystery',
    'Machine',
    'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.',
    '/images/mm.jpg',
    '/images/mm-tn.jpg',
    '10000',
    12,
    'Green',
    1
  ),
  (
    8,
    'Spartan',
    'Fire Truck',
    'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.',
    '/images/fire-truck.jpg',
    '/images/fire-truck-tn.jpg',
    '50000',
    1,
    'Red',
    4
  ),
  (
    9,
    'Ford',
    'Crown Victoria',
    'After the police force updated their fleet these cars are now available to the public! These cars come equipped with the siren which is convenient for college students running late to class.',
    '/images/crown-vic.jpg',
    '/images/crown-vic-tn.jpg',
    '10000',
    5,
    'White',
    5
  ),
  (
    10,
    'Chevy',
    'Camaro',
    'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!',
    '/images/camaro.jpg',
    '/images/camaro-tn.jpg',
    '25000',
    10,
    'Silver',
    3
  ),
  (
    11,
    'Cadillac',
    'Escalade',
    'This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.',
    '/images/escalade.jpg',
    '/images/escalade-tn.jpg',
    '75195',
    4,
    'Black',
    1
  ),
  (
    12,
    'GM',
    'Hummer',
    'Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.',
    '/images/hummer.jpg',
    '/images/hummer-tn.jpg',
    '58800',
    5,
    'Yellow',
    5
  ),
  (
    13,
    'Aerocar International',
    'Aerocar',
    'Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!',
    '/images/aerocar.jpg',
    '/images/aerocar-tn.jpg',
    '1000000',
    1,
    'Red',
    2
  ),
  (
    14,
    'FBI',
    'Surveillance Van',
    'Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month. ',
    '/images/fbi.jpg',
    '/images/fbi-tn.jpg',
    '20000',
    1,
    'Green',
    1
  ),
  (
    15,
    'Dog ',
    'Car',
    'Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.',
    '/images/dog.jpg',
    '/images/dog-tn.jpg',
    '35000',
    1,
    'Brown',
    2
  );
--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
MODIFY `invId` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 16;
--
-- Table structure for table `carclassification`
--
DROP TABLE IF EXISTS `carclassification`;
CREATE TABLE `carclassification` (
  `classificationId` int NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `carclassification`
--
INSERT INTO `carclassification` (`classificationId`, `classificationName`)
VALUES (1, 'SUV'),
  (2, 'Classic'),
  (3, 'Sports'),
  (4, 'Trucks'),
  (5, 'Used');
--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
ADD PRIMARY KEY (`classificationId`);
--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
MODIFY `classificationId` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 7;
--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);
COMMIT;
--
-- Table structure for table `clients`
--
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `clientId` int UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
MODIFY `clientId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;