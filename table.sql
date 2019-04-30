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
-- Table structure for table `form_orthorhb_patient_exam`
--

CREATE TABLE IF NOT EXISTS `form_orthorhb_patient_exam` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  date datetime default NULL,
  `pid` bigint(20) DEFAULT '0',
  `user` varchar(255) DEFAULT NULL,
  `groupname` varchar(255) DEFAULT NULL,
  `authorized` tinyint(4) DEFAULT NULL,
  `activity` tinyint(4) DEFAULT NULL,
  `encounter` bigint(20) DEFAULT NULL,
  `createuser` varchar(255) DEFAULT NULL,
  `createdate` BIGINT(10) DEFAULT NULL,
  `sensorid` int(11) NOT NULL,
  `sensorassigndate` BIGINT(10) DEFAULT NULL,
  `sensorreleasedate` BIGINT(10) DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1;
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
-- Table structure for table `form_orthorhb_sensor_data`
--

CREATE TABLE `form_orthorhb_sensor_data` (
  `id` bigint(20) NOT NULL,
  `sensorid` int(11) NOT NULL,
  `formid` bigint(20) DEFAULT NULL,
  `timerec` BIGINT(10) DEFAULT NULL,
  `datavalue` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_orthorhb_sensor_data`
--

INSERT INTO `form_orthorhb_sensor_data` (`id`, `sensorid`, `formid`, `timerec`, `datavalue`) VALUES
(1, 1, 13, 1554362199, '[{\"timestmp\":\"1554362250\",\"data\": {\"angle\":\"88\",\"temp\":\"36\",\"o2\":\"100\",\"volume\":null}}]'),
(5, 1, 13, 1554362592, '[{\"timestmp\":\"1554362600\",\"data\":{\"angle\":\"80\",\"temp\":\"37\",\"o2\":\"90\",\"volume\":\"15\"}}]'),
(6, 2, 14, 1556006950, '[{\"timestmp\":\"1556006999\",\"data\":{\"angle\":\"68\",\"temp\":\"34\",\"o2\":\"90\",\"volume\":\"20\"}}]'),
(8, 2, 14, 1556007013, '[{\"timestmp\":\"1556007053\",\"data\":{\"angle\":\"71\",\"temp\":\"35\",\"o2\":\"87\",\"volume\":\"21\"}}]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_orthorhb_sensors`
--
ALTER TABLE `form_orthorhb_sensors`
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
-- AUTO_INCREMENT for table `form_orthorhb_sensor_data`
--
ALTER TABLE `form_orthorhb_sensor_data`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
