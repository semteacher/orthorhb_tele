-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 07, 2019 at 07:32 PM
-- Server version: 5.7.23
-- PHP Version: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `openemr`
--

-- --------------------------------------------------------

--
-- Table structure for table `form_orthorhb_sensors`
--

CREATE TABLE `form_orthorhb_sensors` (
  `id` int(11) NOT NULL,
  `sensorname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'prototype',
  `sensordesc` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sensortoken` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_orthorhb_sensors`
--

INSERT INTO `form_orthorhb_sensors` (`id`, `sensorname`, `sensordesc`, `sensortoken`) VALUES
(1, 'prototype01', NULL, NULL),
(2, 'prototype02', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `form_orthorhb_sensor_assignment`
--

CREATE TABLE `form_orthorhb_sensor_assignment` (
  `id` bigint(20) NOT NULL,
  `formid` bigint(20) DEFAULT NULL,
  `patientid` bigint(20) NOT NULL,
  `encounterid` bigint(20) DEFAULT NULL,
  `sensorid` int(11) NOT NULL,
  `assigndate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_orthorhb_sensor_assignment`
--

INSERT INTO `form_orthorhb_sensor_assignment` (`id`, `formid`, `patientid`, `encounterid`, `sensorid`, `assigndate`) VALUES
(1, NULL, 1, 1, 1, '2019-03-31 14:58:39'),
(3, NULL, 2, 2, 2, '2019-03-31 15:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `form_orthorhb_sensor_data`
--

CREATE TABLE `form_orthorhb_sensor_data` (
  `id` bigint(20) NOT NULL,
  `sensorid` int(11) NOT NULL,
  `assignid` bigint(20) DEFAULT NULL,
  `timerec` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datavalue` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_orthorhb_sensor_data`
--

INSERT INTO `form_orthorhb_sensor_data` (`id`, `sensorid`, `assignid`, `timerec`, `datavalue`) VALUES
(1, 1, 1, '2019-04-07 16:12:48', '{\"angle\":\"88\",\"temp\":\"36\",\"o2\":\"100\",\"volume\":null}'),
(5, 1, 1, '2019-04-07 16:28:07', '{\"angle\":\"80\",\"temp\":\"37\",\"o2\":\"90\",\"volume\":\"15\"}'),
(6, 2, 3, '2019-04-07 16:30:00', '{\"angle\":\"68\",\"temp\":\"34\",\"o2\":\"90\",\"volume\":\"20\"}'),
(8, 2, 3, '2019-04-07 16:30:58', '{\"angle\":\"71\",\"temp\":\"35\",\"o2\":\"87\",\"volume\":\"21\"}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_orthorhb_sensors`
--
ALTER TABLE `form_orthorhb_sensors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_orthorhb_sensor_assignment`
--
ALTER TABLE `form_orthorhb_sensor_assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_orthorhb_sensor_data`
--
ALTER TABLE `form_orthorhb_sensor_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_orthorhb_sensors`
--
ALTER TABLE `form_orthorhb_sensors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `form_orthorhb_sensor_assignment`
--
ALTER TABLE `form_orthorhb_sensor_assignment`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `form_orthorhb_sensor_data`
--
ALTER TABLE `form_orthorhb_sensor_data`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
