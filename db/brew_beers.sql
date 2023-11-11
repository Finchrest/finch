-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2023 at 06:27 AM
-- Server version: 8.0.35-0ubuntu0.20.04.1
-- PHP Version: 7.4.3-4ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brew_beers`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `host_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `host_name`) VALUES
(1, 'Neeraj Admin', 'admin@admin.com', '2021-10-10 11:24:41', '$2y$10$pPSGfoCTzm9SFBMR6RUeHusXyoV/ZFtmoo9F.hm9RMLaWn2VSRmsy', '6onIetftoSlda90W8D6Dwn9Elcj1RFv3rq8cj0csWLFJVjQoXug4pZQOicoj', '2021-10-10 11:24:41', '2022-02-18 09:28:46', 'Admin'),
(2, 'Test admin', 'testdata@gmail.com', '2023-03-14 01:23:37', '$2y$10$LIWgSqUvnRGJRhEwPrqj/O3BX1tTxggaTp0ZeG6pTW50IXrG0hlzS', '$2y$10$CHggOPQTJrG.H1.Nap81e.HwVX2p8bJxMBkSH7l2rOtb4C3VYs27K', '2023-03-14 13:23:37', '2023-03-14 13:23:37', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1="delete", 0="not"',
  `is_delete` int NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `add_by` varchar(255) NOT NULL,
  `add_by_id` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `updated_by_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `status`, `is_delete`, `created_at`, `updated_at`, `add_by`, `add_by_id`, `updated_by`, `updated_by_id`) VALUES
(10, 'DRAUGHT BEER', 1, 0, '2022-02-05 07:16:00', '2022-02-05 07:16:00', '', '', '', ''),
(11, 'BOTTLED BEER', 1, 0, '2022-02-05 07:17:00', '2022-02-05 07:17:00', '', '', '', ''),
(12, 'SPIRITS', 1, 0, '2022-02-05 07:18:00', '2022-02-05 07:18:00', '', '', '', ''),
(13, 'BREEZERS', 1, 0, '2022-02-05 07:19:00', '2022-02-05 07:19:00', '', '', '', ''),
(14, 'MIXOLOGY', 1, 0, '2022-02-05 07:20:00', '2022-02-05 07:20:00', '', '', '', ''),
(15, 'COCKTAILS', 1, 0, '2022-02-05 07:20:00', '2022-02-05 07:20:00', '', '', '', ''),
(16, 'Wines', 1, 0, '2022-03-28 06:22:00', '2022-03-28 06:43:00', '', '', '', ''),
(19, 'Mocktails', 1, 0, '2022-03-28 07:07:00', '2022-03-28 07:07:00', '', '', '', ''),
(20, 'Beverages', 0, 0, '2022-03-28 07:23:00', '2023-05-26 10:44:00', '', '', 'Admin', '1'),
(22, 'Beverages', 0, 0, '2022-03-28 07:23:00', '2023-05-26 10:44:00', '', '', 'Admin', '1'),
(23, 'Beverages', 1, 0, '2022-03-28 07:24:00', '2022-03-28 07:24:00', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_options`
--

CREATE TABLE `attribute_options` (
  `id` int NOT NULL,
  `attr_id` int NOT NULL,
  `is_delete` int NOT NULL COMMENT '1="delete", 0="not"',
  `option_name` text NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attribute_options`
--

INSERT INTO `attribute_options` (`id`, `attr_id`, `is_delete`, `option_name`, `created_at`, `updated_at`) VALUES
(8, 5, 0, 'Small', '2022-02-01 12:14:00', '2022-02-01 12:14:00'),
(16, 4, 0, 'Red', '2022-02-01 14:02:00', '2022-02-01 14:02:00'),
(17, 4, 0, 'Green', '2022-02-01 14:02:00', '2022-02-01 14:02:00'),
(18, 4, 0, 'Blue', '2022-02-01 14:02:00', '2022-02-01 14:02:00'),
(19, 4, 0, 'White', '2022-02-01 14:02:00', '2022-02-01 14:02:00'),
(20, 7, 0, 'Small', '2022-02-01 14:16:00', '2022-02-01 14:16:00'),
(21, 7, 0, 'Medium', '2022-02-01 14:16:00', '2022-02-01 14:16:00'),
(22, 7, 0, 'Large', '2022-02-01 14:16:00', '2022-02-01 14:16:00'),
(26, 8, 0, 'Red', '2022-02-01 14:17:00', '2022-02-01 14:17:00'),
(27, 8, 0, 'Blue', '2022-02-01 14:17:00', '2022-02-01 14:17:00'),
(28, 8, 0, 'White', '2022-02-01 14:17:00', '2022-02-01 14:17:00'),
(31, 9, 0, 'B', '2022-02-02 15:20:00', '2022-02-02 15:20:00'),
(32, 9, 0, 'C', '2022-02-02 15:20:00', '2022-02-02 15:20:00'),
(33, 10, 0, 'MUG', '2022-02-05 07:16:00', '2022-02-05 07:16:00'),
(34, 10, 0, '500ml Large', '2022-02-05 07:16:00', '2022-02-05 07:16:00'),
(35, 10, 0, '1 Liter Stein', '2022-02-05 07:16:00', '2022-02-05 07:16:00'),
(36, 10, 0, '5 Mugs Pitcher', '2022-02-05 07:16:00', '2022-02-05 07:16:00'),
(37, 10, 0, '8 Mugs Tower', '2022-02-05 07:16:00', '2022-02-05 07:16:00'),
(38, 11, 0, 'Pint', '2022-02-05 07:17:00', '2022-02-05 07:17:00'),
(39, 11, 0, 'Bucket of 4', '2022-02-05 07:17:00', '2022-02-05 07:17:00'),
(40, 12, 0, '30ml Single', '2022-02-05 07:18:00', '2022-02-05 07:18:00'),
(41, 12, 0, '60ml Double', '2022-02-05 07:18:00', '2022-02-05 07:18:00'),
(42, 12, 0, '90ml Patiala', '2022-02-05 07:18:00', '2022-02-05 07:18:00'),
(43, 12, 0, 'Bottle', '2022-02-05 07:18:00', '2022-02-05 07:18:00'),
(44, 13, 0, 'Pint', '2022-02-05 07:19:00', '2022-02-05 07:19:00'),
(45, 13, 0, 'Bucket of 4', '2022-02-05 07:19:00', '2022-02-05 07:19:00'),
(46, 14, 0, 'Glass', '2022-02-05 07:20:00', '2022-02-05 07:20:00'),
(47, 14, 0, '5 Glass Pitcher', '2022-02-05 07:20:00', '2022-02-05 07:20:00'),
(48, 15, 0, 'Glass', '2022-02-05 07:20:00', '2022-02-05 07:20:00'),
(49, 15, 0, '5 Glass Pitcher', '2022-02-05 07:20:00', '2022-02-05 07:20:00'),
(50, 16, 0, '185 Ml', '2022-03-28 06:43:00', '2022-03-28 06:43:00'),
(51, 16, 0, '375 Ml', '2022-03-28 06:43:00', '2022-03-28 06:43:00'),
(52, 16, 0, '750 Ml', '2022-03-28 06:43:00', '2022-03-28 06:43:00'),
(54, 18, 0, 'Glass', '2022-03-28 07:01:00', '2022-03-28 07:01:00'),
(55, 19, 0, 'Glass', '2022-03-28 07:07:00', '2022-03-28 07:07:00'),
(56, 23, 0, 'Glass', '2022-03-28 07:24:00', '2022-03-28 07:24:00'),
(57, 24, 0, 'werter', '2023-03-13 07:40:00', '2023-03-13 07:40:00'),
(58, 25, 0, 'rft', '2023-03-13 07:51:00', '2023-03-13 07:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_id` int NOT NULL DEFAULT '0',
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `add_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `add_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `name`, `file_id`, `status`, `created_at`, `updated_at`, `add_by`, `add_by_id`, `updated_by`, `updated_by_id`) VALUES
(1, 'finchbrewcafe', 1351, 0, '2021-10-20 07:01:14', '2023-08-24 18:32:29', '', '', 'Admin', '1'),
(2, 'finchbrewcafe', 873, 0, '2021-10-20 07:01:47', '2022-08-05 10:35:17', '', '', '', ''),
(3, 'finchbrewcafe', 1352, 0, '2021-10-20 07:02:28', '2022-08-05 10:35:22', '', '', '', ''),
(6, 'Banner 5th Aug', 1362, 1, '2022-08-05 10:34:12', '2022-08-05 10:34:12', '', '', '', ''),
(7, 'Banner 5th Aug', 1363, 1, '2022-08-05 10:34:30', '2022-08-05 10:34:30', '', '', '', ''),
(8, 'Banner 5th Aug', 1364, 1, '2022-08-05 10:34:44', '2022-08-05 10:34:44', '', '', '', ''),
(12, 'test', 1709, 1, '2023-09-05 15:45:04', '2023-09-05 15:45:04', 'Admin', '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `add_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `add_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`, `add_by`, `add_by_id`, `updated_by`, `updated_by_id`) VALUES
(1, 'Belgian Wit', 1, '2021-10-20 08:24:56', '2023-08-23 19:48:09', '', '', 'Admin', '1'),
(2, 'Apple Cider', 1, '2021-10-20 08:25:15', '2021-12-21 07:41:21', '', '', '', ''),
(3, 'Barbara Wiessand', 1, '2021-10-20 08:26:14', '2021-12-21 07:41:14', '', '', '', ''),
(4, 'Stout', 1, '2021-10-20 08:26:26', '2021-12-21 07:31:19', '', '', '', ''),
(5, 'Indian Pale Ale', 1, '2021-10-20 08:27:03', '2021-12-21 07:41:02', '', '', '', ''),
(6, 'Lager', 1, '2021-10-20 08:27:19', '2021-12-21 07:31:56', '', '', '', ''),
(7, 'Fried Rice', 1, '2021-10-20 10:16:42', '2021-12-21 07:40:46', '', '', '', ''),
(8, 'Veg Manchurian', 1, '2021-10-20 10:16:59', '2021-12-21 07:40:34', '', '', '', ''),
(9, 'Pizza', 1, '2021-10-20 10:17:32', '2021-12-21 07:32:51', '', '', '', ''),
(10, 'Paneer Makhani', 1, '2021-10-20 10:18:38', '2021-12-21 07:40:26', '', '', '', ''),
(11, 'Jeera Rice', 1, '2021-10-20 10:18:56', '2021-12-21 07:40:17', '', '', '', ''),
(12, 'Roasted Papad', 1, '2021-10-20 10:19:57', '2021-12-21 07:34:41', '', '', '', ''),
(13, 'Masala Onion', 1, '2021-10-20 10:20:26', '2021-12-21 07:40:08', '', '', '', ''),
(15, 'Nibbles - Vegetarian', 1, '2021-12-21 07:01:33', '2021-12-21 07:29:34', '', '', '', ''),
(16, 'Nibbles - Non-Vegetarian', 1, '2021-12-21 07:01:52', '2021-12-21 07:29:16', '', '', '', ''),
(17, 'Eggscellent', 1, '2021-12-21 07:18:16', '2021-12-21 07:28:51', '', '', '', ''),
(18, 'Starters - Vegetarian', 1, '2021-12-21 07:19:09', '2021-12-21 07:28:17', '', '', '', ''),
(19, 'Starters - Non-Vegetarian', 1, '2021-12-21 07:19:51', '2021-12-21 07:27:46', '', '', '', ''),
(20, 'Salad', 1, '2021-12-21 07:20:25', '2021-12-21 07:21:06', '', '', '', ''),
(21, 'Open Sandwiches, Sliders, Quesadilla & Pizza', 1, '2021-12-21 07:21:57', '2021-12-21 07:39:41', '', '', '', ''),
(22, 'Main-Course - Rice & Curry Bowls', 1, '2021-12-21 07:23:13', '2021-12-21 07:39:19', '', '', '', ''),
(23, 'Main-Course - Rice and Noodles', 1, '2021-12-21 07:24:24', '2021-12-21 07:38:58', '', '', '', ''),
(24, 'Main-Course - European Mains', 1, '2021-12-21 07:26:57', '2021-12-21 07:38:32', '', '', '', ''),
(25, 'Main-Course - Indian Mains', 1, '2021-12-21 07:43:57', '2021-12-21 07:43:57', '', '', '', ''),
(26, 'Dessert', 1, '2021-12-21 07:44:41', '2021-12-21 07:44:41', '', '', '', ''),
(27, 'Extra', 1, '2021-12-21 07:45:12', '2021-12-21 07:45:12', '', '', '', ''),
(28, 'All Day Eggs and Omelettes', 1, '2021-12-21 07:55:42', '2021-12-21 07:55:42', '', '', '', ''),
(29, 'Shareable Platters - Veg Shareable Platter', 1, '2021-12-21 07:56:55', '2021-12-21 07:56:55', '', '', '', ''),
(30, 'Shareable Platters - Non-Veg Shareable Platter', 1, '2021-12-21 07:57:39', '2021-12-21 07:57:39', '', '', '', ''),
(32, 'Sandwiches, Burgers & Quesadillas', 1, '2021-12-21 07:59:20', '2021-12-21 07:59:20', '', '', '', ''),
(33, 'Rice and Noodles', 1, '2021-12-21 08:00:55', '2021-12-21 08:00:55', '', '', '', ''),
(34, 'Biryani', 1, '2021-12-21 08:01:37', '2021-12-21 08:01:37', '', '', '', ''),
(36, 'Main-Course', 1, '2021-12-21 08:10:01', '2021-12-21 08:10:01', '', '', '', ''),
(37, 'Pizza (8’’)', 1, '2021-12-21 08:10:49', '2021-12-21 08:10:49', '', '', '', ''),
(38, 'Apple cider', 1, '2021-12-21 13:08:18', '2021-12-21 13:08:18', '', '', '', ''),
(39, 'Belgian wit', 1, '2021-12-21 13:09:05', '2021-12-21 13:09:05', '', '', '', ''),
(40, 'Hefeweizen', 1, '2021-12-21 13:09:23', '2021-12-21 13:09:23', '', '', '', ''),
(41, 'Stout', 1, '2021-12-21 13:09:53', '2021-12-21 13:09:53', '', '', '', ''),
(42, 'Indian pale ale', 1, '2021-12-21 13:10:14', '2021-12-21 13:10:14', '', '', '', ''),
(43, 'lager', 1, '2021-12-21 13:10:33', '2021-12-21 13:10:33', '', '', '', ''),
(44, 'Whiskey', 1, '2022-03-25 13:46:53', '2022-03-25 13:47:06', '', '', '', ''),
(45, 'Rum', 1, '2022-03-25 13:48:40', '2022-03-25 13:48:40', '', '', '', ''),
(46, 'Vodka', 1, '2022-03-25 13:48:49', '2022-03-25 13:48:49', '', '', '', ''),
(47, 'Gin', 1, '2022-03-25 13:48:55', '2022-03-25 13:48:55', '', '', '', ''),
(48, 'Shooters', 1, '2022-03-25 13:49:04', '2022-03-25 13:49:04', '', '', '', ''),
(49, 'Breezers', 1, '2022-03-25 13:49:17', '2022-03-25 13:49:17', '', '', '', ''),
(50, 'Wines', 1, '2022-03-25 13:49:31', '2022-03-25 13:49:31', '', '', '', ''),
(51, 'Draught Beer', 1, '2022-03-28 04:42:17', '2022-03-28 04:42:17', '', '', '', ''),
(52, 'Bottled Beer', 1, '2022-03-28 04:42:35', '2022-03-28 04:42:35', '', '', '', ''),
(53, 'Mixology', 1, '2022-03-28 06:25:37', '2022-03-28 06:25:37', '', '', '', ''),
(54, 'Cocktails', 1, '2022-03-28 06:25:47', '2022-03-28 06:25:47', '', '', '', ''),
(55, 'Mocktails', 1, '2022-03-28 06:25:59', '2022-03-28 06:25:59', '', '', '', ''),
(56, 'VALUE MEALS', 1, '2022-08-29 13:42:17', '2022-08-29 13:42:17', '', '', '', ''),
(57, 'SIDES', 1, '2022-08-29 13:51:56', '2022-08-29 13:51:56', '', '', '', ''),
(58, 'Family Meals', 1, '2022-08-30 10:11:37', '2022-08-30 10:11:37', '', '', '', ''),
(60, 'Small Plates', 1, '2023-04-21 10:17:22', '2023-04-21 10:17:22', 'Admin', '1', '', ''),
(61, 'Pizza', 1, '2023-04-21 10:17:47', '2023-04-21 10:17:47', 'Admin', '1', '', ''),
(62, 'Mains Indian', 1, '2023-04-21 10:18:05', '2023-04-21 10:18:05', 'Admin', '1', '', ''),
(63, 'Oriental Mains', 1, '2023-04-21 10:18:25', '2023-04-21 10:18:25', 'Admin', '1', '', ''),
(64, 'Biryani', 1, '2023-04-21 10:18:37', '2023-04-21 10:18:37', 'Admin', '1', '', ''),
(65, 'Mediterranean Bites', 1, '2023-04-21 10:18:58', '2023-04-21 10:18:58', 'Admin', '1', '', ''),
(66, 'Breads', 1, '2023-04-21 10:19:14', '2023-04-21 10:19:14', 'Admin', '1', '', ''),
(67, 'Dessert', 1, '2023-04-21 10:19:24', '2023-04-21 10:19:24', 'Admin', '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `discount_code` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `discount` int NOT NULL DEFAULT '0',
  `locations` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `add_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `add_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `discount_code`, `discount`, `locations`, `status`, `created_at`, `updated_at`, `add_by`, `add_by_id`, `updated_by`, `updated_by_id`) VALUES
(1, 'One plus2', 'DEC2021', 25, '1,2,3,7,8', 1, '2021-09-16 23:23:58', '2023-08-23 19:36:37', '', '', 'Admin', '1'),
(2, 'two plus+', 'OCT2021', 50, '3,6', 1, '2021-09-16 23:23:58', '2021-12-08 11:13:11', '', '', '', ''),
(5, 'auth', 'YEAR2021', 10, '1,3,6', 1, '2021-10-11 13:44:48', '2021-12-08 11:40:09', '', '', '', ''),
(6, 'sdfsdf df', 'WIN1000', 15, NULL, 1, '2021-10-26 09:16:33', '2021-10-26 09:17:16', '', '', '', ''),
(7, 'Test', 'bbb', 10, NULL, 1, '2021-11-16 10:33:01', '2021-11-16 10:33:19', '', '', '', ''),
(8, 'Buy 2 Get 1 FREE', 'B2G1', 33, '2', 1, '2022-03-14 05:38:09', '2022-03-14 05:39:33', '', '', '', ''),
(9, 'NEW User', 'NEW21', 21, '1,2,3,7,8,9,11,12', 1, '2022-05-05 05:13:25', '2023-08-04 17:22:07', '', '', 'Admin', '1'),
(10, 'test', 'KLFHAEL', 5, '2', 1, '2023-08-04 17:59:24', '2023-08-04 17:59:24', 'Admin', '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_redeemeds`
--

CREATE TABLE `coupon_redeemeds` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `coupon_redeemeds`
--

INSERT INTO `coupon_redeemeds` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Brunch coupon redeemed', '2023-03-03 13:33:05', '2023-03-03 13:33:05'),
(2, 'Wine Bottle redeemed', '2023-03-03 13:33:05', '2023-03-03 13:33:05'),
(3, 'Birthday cake', '2023-03-03 13:33:45', '2023-03-03 13:33:45');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int NOT NULL,
  `label` varchar(255) NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `add_by` varchar(255) NOT NULL,
  `add_by_id` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `updated_by_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `label`, `meta_key`, `meta_value`, `updated_at`, `add_by`, `add_by_id`, `updated_by`, `updated_by_id`) VALUES
(1, 'Site Title', 'site_title', 'Finch Brew Cafe - Official Website', '2023-08-24 11:48:29', '', '', '', ''),
(2, 'Site Logo', 'site_logo', '872', '2023-08-24 11:48:30', '', '', '', ''),
(3, 'Admin Email', 'admin_email', 'admin@admin.com', '2023-08-24 11:48:29', '', '', '', ''),
(4, 'Instagram Access Token', 'insta_access_token', 'EAADDjp0KELABAAFmkZAehmKSLYn257npO9ufR8n1hjZBdsPZA9DzaABKclA0JdNingLhYzFNotCK4Nl3hKZBQtTRWZBQZBk9iZCqsFYMDAxfJdbbQAOTeFSiZABl3omfIq7EhE35Hojw4RWCz9ia3B9ukWT6V5aFy58OAhau0VKDvc2zi7fWfCcBgZAMuMu1SYYBCr1e1txXYG61MlYJ2ExghwJogNiXeFjAZD', '2023-08-24 11:48:30', '', '', '', ''),
(5, 'Meta Keywords', 'meta_keywords', 'cafe, finch cafe, brew cafe', '2023-08-24 11:48:29', '', '', '', ''),
(6, 'Meta Description', 'meta_description', 'The Finch BrewCafe Uses Top-Quality Ingredients In Our Food And Beverages, As Well As A Variety Of Freshly Prepared Nutritious Items. Our Experts Strive To Provide One-On-One Services And Create A Welcoming Environment For Customers To Enjoy Their Socializing Experiences.', '2023-08-24 11:48:30', '', '', '', ''),
(7, 'Site Sound', 'site_sound', '1396', '2023-08-24 11:48:30', '', '', '', ''),
(8, 'Passport Minimum Amount', 'passport_minimum_amount', '3600', '2023-08-24 11:48:30', '', '', '', ''),
(10, 'Instagram Token', 'instagram_token', 'IGQVJWSW10WGozOGNlQ1hXTzBlNmJVcG83enI0NW1UVUZAWVlNfYUpJclR5OENvNGdmWENYcnBJSGhwV0FRTjBSRnNSRTRRaGVhX1lrWFdtYmJOUkZAWV19USmtMQm5wZAXBZAeXdjbGJwSU5JREprUTZAaYgZDZD', '2022-08-23 08:47:40', '', '', '', ''),
(11, 'Passport Top Up Benifit', 'top_up_benifit', '0', '2023-08-24 11:48:30', '', '', '', ''),
(12, 'Minimum Purchase Amount', 'minimum_purchase_amount', '600', '2023-08-24 11:48:30', '', '', '', ''),
(13, 'Delivery Charges', 'delivery_charges', '100', '2023-08-24 11:48:30', '', '', '', ''),
(14, 'delivery Tax', 'deliveryTax', '5', '2023-08-24 11:48:30', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `home_addresses`
--

CREATE TABLE `home_addresses` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pincode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `home_addresses`
--

INSERT INTO `home_addresses` (`id`, `user_id`, `title`, `city`, `phone`, `state`, `address`, `status`, `created_at`, `updated_at`, `pincode`) VALUES
(95, 834, 'Home', 'Mumbai', '9833478240', 'Maharashtra', 'T10-706, Emerald Isle, Saki Vihar Road, Powai', 1, '2023-11-07 15:11:48', '2023-11-07 15:11:48', '400072');

-- --------------------------------------------------------

--
-- Table structure for table `home_banners`
--

CREATE TABLE `home_banners` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_id` int NOT NULL DEFAULT '0',
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hops`
--

CREATE TABLE `hops` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `add_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `add_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hops`
--

INSERT INTO `hops` (`id`, `name`, `status`, `created_at`, `updated_at`, `add_by`, `add_by_id`, `updated_by`, `updated_by_id`) VALUES
(1, 'HALLERTAU', 1, '2021-10-20 08:06:37', '2021-10-20 08:06:37', '', '', '', ''),
(2, 'MITTELFRUH', 1, '2021-10-20 08:07:59', '2021-10-20 08:07:59', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `insta_feeds`
--

CREATE TABLE `insta_feeds` (
  `id` int NOT NULL,
  `feed_id` varchar(255) NOT NULL,
  `caption` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `media_type` varchar(255) NOT NULL,
  `permalink` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `media_url` text NOT NULL,
  `status` int NOT NULL,
  `post_time` datetime NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `insta_feeds`
--

INSERT INTO `insta_feeds` (`id`, `feed_id`, `caption`, `media_type`, `permalink`, `media_url`, `status`, `post_time`, `created_at`, `updated_at`) VALUES
(25, '17957075702401507', 'The perfect blend of breakfast and lunch our brunch is not to be missed.\n\nJoin us with your tribe for a delicious brunch experience every Sunday.\n\n𝐅𝐨𝐫 𝐑𝐞𝐬𝐞𝐫𝐯𝐚𝐭𝐢𝐨𝐧𝐬 𝐂𝐚𝐥𝐥: +𝟗𝟏 𝟗𝟖𝟕𝟏𝟕𝟑𝟎𝟕𝟑𝟏\n\n#thefinchmumbai #sundaybrunch #brunching #brunchtime #indiancuisine #multicuisine #italiancuisine #foodiesofindia #livemusic #livefoodcounters #foodforfoodies #mumbaifoodlovers', 'CAROUSEL_ALBUM', 'https://www.instagram.com/p/Csqq564Sby2/', 'https://scontent-bom1-2.cdninstagram.com/v/t51.29350-15/348722620_934120857707617_5303697629764595364_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=8ae9d6&_nc_ohc=0r04IH3pA6kAX8YHGh3&_nc_ht=scontent-bom1-2.cdninstagram.com&edm=ANo9K5cEAAAA&oh=00_AfC7okaPDMkZUf022hv8Q9UPgPbPKg5gbQG4LrHhDZs1FQ&oe=6475EC97', 1, '2023-05-25 12:49:49', '1685080048', '1685080048'),
(26, '17870605406859517', 'Let our exotic blends transport you to a world of flavor and delight!\n\n𝐅𝐨𝐫 𝐑𝐞𝐬𝐞𝐫𝐯𝐚𝐭𝐢𝐨𝐧𝐬 𝐂𝐚𝐥𝐥: +𝟗𝟏 𝟗𝟖𝟕𝟏𝟕𝟑𝟎𝟕𝟑𝟏\n\n#Thefinch #mumbai #drinkoftheday #freshmocktails #drinkstagram #drinkswithfriends #drinksallnight #mumbaidiaries #creatememories #partyhard #drinksphotography #drinksafterwork #mumbaifoodlovers #mumbaifoodbloggers', 'IMAGE', 'https://www.instagram.com/p/Csicw4oyJpW/', 'https://scontent-bom1-1.cdninstagram.com/v/t51.29350-15/348255579_964102401499406_4815829993839398359_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=8ae9d6&_nc_ohc=B8avHZzCC-cAX8XXmBF&_nc_ht=scontent-bom1-1.cdninstagram.com&edm=ANo9K5cEAAAA&oh=00_AfDbXtsRmA-GE1KJGkuccv8TgRxKYl4QKv2LZTOm7wx1Dw&oe=6474877B', 1, '2023-05-22 08:12:20', '1685080048', '1685080048'),
(27, '17891494511819566', 'We can\'t help it, because we are all about symmetry and imagination. Almost as if the nights at @thefinchmumbai were directed by Wes Anderson himself.\n\n𝐅𝐨𝐫 𝐑𝐞𝐬𝐞𝐫𝐯𝐚𝐭𝐢𝐨𝐧𝐬 𝐂𝐚𝐥𝐥: +𝟗𝟏 𝟗𝟖𝟕𝟏𝟕𝟑𝟎𝟕𝟑𝟏\n\n#Thefinch #mumbai #trendingreel #reelsviral #trendingaudio #explorenow #wesanderson #wesandersonstyle', 'VIDEO', 'https://www.instagram.com/reel/Csa2GketbkB/', 'https://scontent-bom1-2.cdninstagram.com/v/t51.36329-15/347357363_253262937253737_3351495922823310921_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=8ae9d6&_nc_ohc=z2uRCgWtaZIAX9FnKiR&_nc_ht=scontent-bom1-2.cdninstagram.com&edm=ANo9K5cEAAAA&oh=00_AfBcLz_FqGzuLy9QxWwExSqrxsv1Ix6BZ8pv041lasAZPQ&oe=6475D05E', 1, '2023-05-19 09:20:26', '1685080048', '1685080048'),
(28, '17914524659683645', 'Get ready for a phenomenal Thursday affair at @thefinchmumbai featuring the one and only blazing voice of @negiraman performing live from 8 PM onwards.\n\n𝐅𝐨𝐫 𝐑𝐞𝐬𝐞𝐫𝐯𝐚𝐭𝐢𝐨𝐧𝐬  𝐂𝐚𝐥𝐥: +𝟗𝟏 𝟗𝟖𝟕𝟏𝟕𝟑𝟎𝟕𝟑𝟏\n\n#TheFinch #finchmumbai #thursdaynight #ramannegi #performinglive #livemusic #musiclover #musicalnight #partywithfriends #mumbaidiaries #mumbainightlife #partypeople #mumbainightlife #partyallnight #nightout', 'VIDEO', 'https://www.instagram.com/reel/CsVle7DM9HK/', 'https://scontent-bom1-2.cdninstagram.com/v/t51.36329-15/346905537_2479584782190096_1818421832597241124_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=8ae9d6&_nc_ohc=FYr6C55Bg20AX96woF0&_nc_ht=scontent-bom1-2.cdninstagram.com&edm=ANo9K5cEAAAA&oh=00_AfAjU4gYHQYQsBMxsng2mH4ErdlOMxwHQYaXa8qz-dNDPA&oe=64757A58', 1, '2023-05-17 08:20:44', '1685080048', '1685080048'),
(29, '17972985512140698', 'Dimsums sounds perfect for tonight! \n\nPlunge into the sumptuous delight of @thefinchmumbai .\n\n𝐅𝐨𝐫 𝐑𝐞𝐬𝐞𝐫𝐯𝐚𝐭𝐢𝐨𝐧𝐬 𝐂𝐚𝐥𝐥: +𝟗𝟏 𝟗𝟖𝟕𝟏𝟕𝟑𝟎𝟕𝟑𝟏\n\n#Thefinch #mumbai #dimsums #tastethebest #foodies #foodlover #foodgasm #foodforfoodie #mumbaifoodies #mumbaidiaries #cravings #foodlove #exploremore', 'IMAGE', 'https://www.instagram.com/p/CsVlLAdSwf4/', 'https://scontent-bom1-1.cdninstagram.com/v/t51.29350-15/347077899_780182317031978_6194651859674420302_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=8ae9d6&_nc_ohc=uyP4JRiTG1oAX88XDwb&_nc_ht=scontent-bom1-1.cdninstagram.com&edm=ANo9K5cEAAAA&oh=00_AfBYyhPhtmlV9SVVa2J_x6if6niTXqFipcNqFsDiuV7Jhw&oe=64755CB6', 1, '2023-05-17 08:15:41', '1685080048', '1685080048'),
(30, '17965486124421879', 'The king of all beers has arrived and is now all set to mesmerize your tastebuds. \n\nRelish the flavours of mangi bliss only at @thefinchmumbai .\n\n𝐅𝐨𝐫 𝐑𝐞𝐬𝐞𝐫𝐯𝐚𝐭𝐢𝐨𝐧𝐬 𝐂𝐚𝐥𝐥: +𝟗𝟏 𝟗𝟖𝟕𝟏𝟕𝟑𝟎𝟕𝟑𝟏\n\n#Thefinch #mumbai #mangobeer #mangibliss #beattheheat #beerlovers #beerstagram #chilledbeer #beerlove #drinkstagram #beerparty #drinksallnight #mumbaidiaries #mumbaifoodlovers', 'VIDEO', 'https://www.instagram.com/reel/CsQwMLWA02X/', 'https://scontent-bom1-2.cdninstagram.com/v/t51.36329-15/346909283_143910045332105_10336143644773320_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=8ae9d6&_nc_ohc=MZNXGLPauY0AX_4FhVO&_nc_ht=scontent-bom1-2.cdninstagram.com&edm=ANo9K5cEAAAA&oh=00_AfDV6DBVGHEbqfiqmN2BhAgcoWmH-FuiK4v3hQuCCoT6wA&oe=64760EDF', 1, '2023-05-15 11:28:14', '1685080048', '1685080048'),
(31, '17979795743182147', 'Let\'s sprinkle the summer vibes into your quenchers at @thefinchmumbai .\n\n𝐅𝐨𝐫 𝐑𝐞𝐬𝐞𝐫𝐯𝐚𝐭𝐢𝐨𝐧𝐬 𝐂𝐚𝐥𝐥: +𝟗𝟏 𝟗𝟖𝟕𝟏𝟕𝟑𝟎𝟕𝟑𝟏\n\n#Thefinch #mumbai #weekendmood #cocktailparty #cocktailsandmixology #freshmocktails #drinkstagram #drinkswithfriends #drinksallnight #mumbaidiaries #creatememories #partyhard #drinksphotography #drinksafterwork #mumbaifoodlovers #mumbaifoodbloggers', 'IMAGE', 'https://www.instagram.com/p/CsI0fHySCFh/', 'https://scontent-bom1-2.cdninstagram.com/v/t51.29350-15/346017825_583082603624703_358829348296231560_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=8ae9d6&_nc_ohc=FeoTOWHNQPYAX-wX1wV&_nc_ht=scontent-bom1-2.cdninstagram.com&edm=ANo9K5cEAAAA&oh=00_AfDSn2tukrNM9FYXwbjBcrb1pIH8wfppLRkuF9RzvhREDw&oe=6475F251', 1, '2023-05-12 09:19:22', '1685080048', '1685080048'),
(32, '18010844347575123', 'Let’s sate your culinary cravings in the most sumptuous way at @thefinchmumbai .\n\n𝐅𝐨𝐫 𝐑𝐞𝐬𝐞𝐫𝐯𝐚𝐭𝐢𝐨𝐧𝐬 𝐂𝐚𝐥𝐥: +𝟗𝟏 𝟗𝟖𝟕𝟏𝟕𝟑𝟎𝟕𝟑𝟏\n\n#Thefinch #mumbai #tastethebest #foodies #foodlover #foodgasm #scrumptiousfood #foodforfoodie #mumbaifoodies #mumbaidiaries #cravings #foodlove #exploremore', 'VIDEO', 'https://www.instagram.com/reel/CsEIKH7NbV4/', 'https://scontent-bom1-2.cdninstagram.com/v/t51.36329-15/345990528_911345769930738_3730552176022091157_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=8ae9d6&_nc_ohc=wExLeAJKdSsAX-eS81s&_nc_ht=scontent-bom1-2.cdninstagram.com&edm=ANo9K5cEAAAA&oh=00_AfD1WJCQ3f21w-HteXEHvA0YQXKSddkvyILT9i0yu4U42w&oe=6475539C', 1, '2023-05-10 13:35:29', '1685080048', '1685080048'),
(33, '17965083224434201', 'Succulence in each bite! Indulge in the flavours you crave the most at @thefinchmumbai .\n\n𝐅𝐨𝐫 𝐑𝐞𝐬𝐞𝐫𝐯𝐚𝐭𝐢𝐨𝐧𝐬 𝐂𝐚𝐥𝐥: +𝟗𝟏 𝟗𝟖𝟕𝟏𝟕𝟑𝟎𝟕𝟑𝟏\n\n#Thefinch #mumbai #tastethebest #happymonday #foodies #foodlover #foodgasm #foodforfoodie #mumbaifoodies #mumbaidiaries #cravings #foodlove #exploremore', 'IMAGE', 'https://www.instagram.com/p/Cr-U2ILy4qC/', 'https://scontent-bom1-2.cdninstagram.com/v/t51.29350-15/344865838_243418718342121_2802811917923432794_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=8ae9d6&_nc_ohc=s2WJf1DPvJIAX-rfmBs&_nc_ht=scontent-bom1-2.cdninstagram.com&edm=ANo9K5cEAAAA&oh=00_AfDL_RXmZIPN8odngMK5K--_t2qgChDkMmNC32_ZgcbKIg&oe=647530FB', 1, '2023-05-08 07:30:29', '1685080048', '1685080048'),
(34, '18178494037281229', 'Succulence in each bite! Indulge in the flavours you crave the most at @thefinchmumbai .\n\n𝐅𝐨𝐫 𝐑𝐞𝐬𝐞𝐫𝐯𝐚𝐭𝐢𝐨𝐧𝐬 𝐂𝐚𝐥𝐥: +𝟗𝟏 𝟗𝟖𝟕𝟏𝟕𝟑𝟎𝟕𝟑𝟏\n\n#Thefinch #mumbai #cheerstotheweekend #desserts #finchdessert #trynow #foodlover #bestfood #dessertlover #foodforfoodie #mumbaifoodies #mumbaidiaries #cravings #weekendishere', 'VIDEO', 'https://www.instagram.com/reel/Cr2eM95LClG/', 'https://scontent-bom1-1.cdninstagram.com/v/t51.36329-15/344561502_749141660036512_328732547796023159_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=8ae9d6&_nc_ohc=oaspqJeR_aIAX9mBr-j&_nc_ht=scontent-bom1-1.cdninstagram.com&edm=ANo9K5cEAAAA&oh=00_AfAr3b6X42XnJsNaR_nGTGABZ4CghK2QV1DjpcI7YelYOQ&oe=647571BC', 1, '2023-05-05 06:18:31', '1685080048', '1685080048'),
(35, '17977372028191067', 'Let\'s fall in love with @thefinchmumbai vibes tonight. \n\nReserve your tables for an immaculate time.\n\n𝐅𝐨𝐫 𝐑𝐞𝐬𝐞𝐫𝐯𝐚𝐭𝐢𝐨𝐧𝐬 𝐂𝐚𝐥𝐥: +𝟗𝟏 𝟗𝟖𝟕𝟏𝟕𝟑𝟎𝟕𝟑𝟏\n\n#Thefinch #mumbai #bestpartyplace #classyinteriors #livemusic #foodies #cocktailsandmixology #drinkswithfriends #drinksallnight #mumbaidiaries #creatememories #nightclub #mumbaifoodbloggers', 'CAROUSEL_ALBUM', 'https://www.instagram.com/p/CryKeyLSQGD/', 'https://scontent-bom1-2.cdninstagram.com/v/t51.29350-15/344888998_1064783531042797_3475312251458608536_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=8ae9d6&_nc_ohc=nYeIRUu-8csAX_A_oyW&_nc_ht=scontent-bom1-2.cdninstagram.com&edm=ANo9K5cEAAAA&oh=00_AfBzdx00vjoW6dBqz6RMEgtggQsfqj2W_KDE5FYmpLfGkA&oe=6474AB44', 1, '2023-05-03 14:09:02', '1685080048', '1685080048'),
(36, '17965785731241526', 'Drink into the ecstatic experience like no other at @thefinchmumbai .\n\n𝐅𝐨𝐫 𝐑𝐞𝐬𝐞𝐫𝐯𝐚𝐭𝐢𝐨𝐧𝐬 𝐂𝐚𝐥𝐥: +𝟗𝟏 𝟗𝟖𝟕𝟏𝟕𝟑𝟎𝟕𝟑𝟏\n\n#Thefinch #mumbai #mondaymood #cocktailparty #cocktailsandmixology #freshmocktails #drinkstagram #drinkswithfriends #drinksallnight #mumbaidiaries #creatememories #partyhard #drinksphotography #drinksafterwork #mumbaifoodlovers #mumbaifoodbloggers', 'IMAGE', 'https://www.instagram.com/p/CrsaqHpStHb/', 'https://scontent-bom1-1.cdninstagram.com/v/t51.29350-15/343755771_819825092838860_1188830290275506559_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=8ae9d6&_nc_ohc=3hxwjmVnbw8AX_bzqIr&_nc_ht=scontent-bom1-1.cdninstagram.com&edm=ANo9K5cEAAAA&oh=00_AfCPX-Oxa_hrucM2HXyUWNrQiEVIgs2nwGWdKs4RRgOpng&oe=64762A89', 1, '2023-05-01 08:34:57', '1685080048', '1685080048');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` int NOT NULL,
  `price` float(10,2) NOT NULL,
  `is_cancelled` int NOT NULL DEFAULT '0' COMMENT '1=cancelled, 0=not',
  `sub_total` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `attr_id` int NOT NULL DEFAULT '0',
  `attr_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `option_id` int NOT NULL DEFAULT '0',
  `option_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `user_id`, `order_id`, `product_id`, `qty`, `price`, `is_cancelled`, `sub_total`, `created_at`, `updated_at`, `attr_id`, `attr_name`, `option_id`, `option_name`) VALUES
(871, 834, 692, 247, 4, 628.00, 0, 2512, '2023-11-07 15:11:49', '2023-11-07 15:11:49', 0, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_id` int NOT NULL DEFAULT '0',
  `status` int NOT NULL,
  `allow_pincode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `add_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `add_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_home_menu` int NOT NULL DEFAULT '0',
  `in_add_cart` int NOT NULL DEFAULT '0',
  `is_passport` int NOT NULL DEFAULT '0',
  `file_id_logo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `file_id`, `status`, `allow_pincode`, `updated_at`, `add_by`, `add_by_id`, `updated_by`, `updated_by_id`, `is_home_menu`, `in_add_cart`, `is_passport`, `file_id_logo`) VALUES
(1, 'Pune', 295, 0, '4554452,455001,85528,5555', '2023-08-23 19:41:03', '', '', 'Admin', '1', 0, 0, 0, 1634),
(2, 'Mumbai', 294, 1, '400072,400069,400073', '2023-08-22 13:32:45', '', '', 'Admin', '1', 1, 1, 1, 1665),
(3, 'Bangalore', 292, 0, '', '2021-12-22 12:14:07', '', '', '', '', 0, 0, 0, 0),
(7, 'Jalandhar', 90, 1, '144004,143102 ,144623,144003', '2023-06-02 13:24:43', '', '', 'Admin', '1', 0, 0, 1, 1668),
(8, 'Amritsar', 291, 1, '143001,143104,143008,143101', '2023-06-02 13:24:26', '', '', 'Admin', '1', 0, 0, 1, 1667),
(9, 'Chandigarh', 293, 0, '160009,160022,160015,160019,160022,160101,160014,160020,160023,160002,160030,160020,134114,160102', '2022-11-11 10:11:28', '', '', '', '', 0, 0, 1, 0),
(11, 'Bangkok', 1467, 0, '10110', '2023-09-18 11:15:05', '', '', 'Admin', '1', 0, 0, 0, 1669),
(12, 'Thane', 1630, 1, '400607,400601,400603  ,400604', '2023-04-29 11:03:37', '', '', 'Admin', '1', 0, 0, 0, 1636);

-- --------------------------------------------------------

--
-- Table structure for table `malts`
--

CREATE TABLE `malts` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `add_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `add_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `malts`
--

INSERT INTO `malts` (`id`, `name`, `status`, `created_at`, `updated_at`, `add_by`, `add_by_id`, `updated_by`, `updated_by_id`) VALUES
(1, 'WHEAT', 1, '2021-10-20 08:08:55', '2021-10-20 08:11:14', '', '', '', ''),
(2, 'PILSNER', 1, '2021-10-20 08:11:24', '2021-10-20 08:11:24', '', '', '', ''),
(3, 'OATS', 1, '2021-10-20 08:11:41', '2021-10-20 08:11:41', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_10_10_165045_create_admins_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_id` int NOT NULL DEFAULT '0',
  `locations` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `add_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `add_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `name`, `file_id`, `locations`, `status`, `updated_at`, `add_by`, `add_by_id`, `updated_by`, `updated_by_id`) VALUES
(18, 'Happy Hours', 1445, '2,7,8', 1, '2023-09-04 14:45:18', '', '', 'Admin', '1'),
(19, 'Corporate Discount', 1446, '2,7,8', 1, '2022-09-02 06:05:07', '', '', '', ''),
(20, 'Dining Offer', 1447, '2,7,8', 1, '2022-09-02 06:05:28', '', '', '', ''),
(21, '1 + 1 Pizza Offer', 1448, '2,7,8', 0, '2023-09-04 14:45:30', '', '', 'Admin', '1'),
(22, 'Growler Offer', 1449, '2', 1, '2022-09-02 06:27:27', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `place_id` int NOT NULL DEFAULT '0',
  `location` int NOT NULL DEFAULT '0',
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `order_for` int NOT NULL DEFAULT '0' COMMENT '0="delivery order",1="dine-in order",2="takeaway"',
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `qty` int NOT NULL,
  `sub_total` double(20,2) NOT NULL,
  `total` double(20,2) NOT NULL,
  `total_pay` double(20,2) NOT NULL DEFAULT '0.00',
  `status` int NOT NULL,
  `order_status` int NOT NULL DEFAULT '0' COMMENT '1=accepted 2=declined 0=Pending',
  `payment_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `pay_status` int NOT NULL DEFAULT '0' COMMENT '0->pending, 1->success, 2->failed',
  `pay_res` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `order_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `passport_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `passport_pay` int NOT NULL DEFAULT '0',
  `type` int NOT NULL DEFAULT '0',
  `is_custom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `coupon_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `coupon_percent` int NOT NULL DEFAULT '0',
  `pincode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `coupon_amount` int NOT NULL DEFAULT '0',
  `is_restaurant` int NOT NULL DEFAULT '0',
  `order_type` int DEFAULT NULL,
  `delivery_charge` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `delivery_tax` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `user_id`, `place_id`, `location`, `phone`, `address`, `order_for`, `state`, `city`, `qty`, `sub_total`, `total`, `total_pay`, `status`, `order_status`, `payment_id`, `payment_date`, `pay_status`, `pay_res`, `order_date`, `created_at`, `updated_at`, `passport_code`, `passport_pay`, `type`, `is_custom`, `coupon_code`, `coupon_percent`, `pincode`, `coupon_amount`, `is_restaurant`, `order_type`, `delivery_charge`, `delivery_tax`) VALUES
(692, 'Devesh Sati', 834, 7, 2, '9833478240', 'T10-706, Emerald Isle, Saki Vihar Road, Powai', 0, 'Maharashtra', 'Mumbai', 4, 2396.00, 2512.00, 2512.00, 1, 0, 'pay_MxXQySnA5AGLEZ', '2023-11-07', 1, '{\"id\":\"pay_MxXQySnA5AGLEZ\",\"entity\":\"payment\",\"amount\":251580,\"currency\":\"INR\",\"status\":\"authorized\",\"order_id\":null,\"invoice_id\":null,\"international\":false,\"method\":\"upi\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":false,\"description\":\"Passport Transaction\",\"card_id\":null,\"bank\":null,\"wallet\":null,\"vpa\":\"success@razorpay\",\"email\":\"theyvesh@gmail.com\",\"contact\":\"+919833478240\",\"notes\":{\"address\":\"Razorpay Corporate Office\"},\"fee\":null,\"tax\":null,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"rrn\":\"225886040341\",\"upi_transaction_id\":\"40B03F6BDAA3C9C755232B0C901DD933\"},\"created_at\":1699350115,\"upi\":{\"vpa\":\"success@razorpay\"}}', '2023-11-07', '2023-11-07 15:11:49', '2023-11-07 15:12:12', '', 0, 1, '0', '', 0, '400072', 0, 0, 0, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `passports`
--

CREATE TABLE `passports` (
  `id` int NOT NULL,
  `passport_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sub_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `location` int NOT NULL DEFAULT '0',
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL DEFAULT '0',
  `sub_total` float(10,2) NOT NULL,
  `tax` float(10,2) NOT NULL,
  `volume` int NOT NULL DEFAULT '0',
  `status` int NOT NULL,
  `file_id` int NOT NULL DEFAULT '0',
  `per_day_use` int NOT NULL DEFAULT '0',
  `is_old` int NOT NULL DEFAULT '0' COMMENT '0->old, 1->new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `add_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `add_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passports`
--

INSERT INTO `passports` (`id`, `passport_id`, `name`, `sub_description`, `description`, `location`, `slug`, `price`, `sub_total`, `tax`, `volume`, `status`, `file_id`, `per_day_use`, `is_old`, `created_at`, `updated_at`, `add_by`, `add_by_id`, `updated_by`, `updated_by_id`) VALUES
(10, '5470299', 'Mumbai Café Passport series-2021', 'Mumbai Café Passport series-2021', '<p>Mumbai Café Passport series-2021<br></p>', 2, 'mumbai-cafe-passport-series-2021', 9450, 9000.00, 5.00, 13000, 1, 602, 3600, 0, '2022-01-10 08:44:23', '2023-09-13 19:00:31', '', '', 'Admin', '1'),
(11, '55839763', 'Mumbai Finch Passport series-2021', 'Mumbai Finch Passport series-2021', '<p>Mumbai Finch Passport series-2021<br></p>', 2, 'mumbai-finch-passport-series-2021', 9450, 9000.00, 5.00, 13000, 1, 648, 3600, 1, '2022-01-11 09:59:41', '2023-11-03 19:06:48', '', '', 'Admin', '1'),
(12, '60804110', 'Finch BrewCafe Beer Passport Amritsar', 'Finch BrewCafe Beer Passport Amritsar', '<p>Finch BrewCafe Beer Passport Amritsar<br></p>', 8, 'finch-brewcafe-beer-passport-amritsar', 9450, 9000.00, 5.00, 13000, 0, 1451, 3600, 0, '2022-11-03 06:46:55', '2023-08-21 11:34:46', '', '', 'Admin', '1'),
(13, '32679345', 'Finch BrewCafe Beer Passport Jalandhar', 'Finch BrewCafe Beer Passport Jalandhar', '<p>&nbsp;Finch BrewCafe Beer Passport Jalandhar<br></p>', 7, 'finch-brewcafe-beer-passport-jalandhar', 9450, 9000.00, 5.00, 13000, 0, 1452, 3600, 0, '2022-11-03 06:48:39', '2023-08-21 11:35:36', '', '', 'Admin', '1'),
(14, '20097556', 'Finch BrewCafe Beer Passport Chandigarh', 'Finch BrewCafe Beer Passport Chandigarh', '<p>Finch BrewCafe Beer Passport Chandigarh<br></p>', 9, 'finch-brewcafe-beer-passport-chandigarh', 9450, 9000.00, 5.00, 13000, 0, 1454, 3600, 0, '2022-11-03 06:51:20', '2023-08-21 11:36:46', '', '', 'Admin', '1');

-- --------------------------------------------------------

--
-- Table structure for table `passport_free_item`
--

CREATE TABLE `passport_free_item` (
  `id` int NOT NULL,
  `passport_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passport_free_item`
--

INSERT INTO `passport_free_item` (`id`, `passport_id`, `product_id`, `status`, `created_at`, `updated_at`) VALUES
(21, 10, 804, 1, '2023-08-22 17:44:30', '2023-08-22 17:44:30'),
(22, 10, 805, 1, '2023-08-22 17:44:30', '2023-08-22 17:44:30'),
(24, 11, 804, 1, '2023-08-22 17:45:23', '2023-08-22 17:45:23'),
(25, 11, 805, 1, '2023-08-22 17:45:23', '2023-08-22 17:45:23'),
(27, 12, 804, 1, '2023-08-22 17:46:06', '2023-08-22 17:46:06'),
(28, 12, 805, 1, '2023-08-22 17:46:06', '2023-08-22 17:46:06'),
(30, 13, 804, 1, '2023-08-22 17:46:38', '2023-08-22 17:46:38'),
(31, 13, 805, 1, '2023-08-22 17:46:38', '2023-08-22 17:46:38'),
(33, 14, 804, 1, '2023-08-22 17:49:32', '2023-08-22 17:49:32'),
(34, 14, 805, 1, '2023-08-22 17:49:32', '2023-08-22 17:49:32'),
(39, NULL, NULL, 1, '2023-09-02 14:26:31', '2023-09-02 14:26:31'),
(40, 10, 807, 1, '2023-09-02 14:29:13', '2023-09-02 14:29:13');

-- --------------------------------------------------------

--
-- Table structure for table `passport_items`
--

CREATE TABLE `passport_items` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `order_id` int NOT NULL,
  `passport_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_id` int NOT NULL,
  `qty` int NOT NULL,
  `price` int NOT NULL,
  `sub_total` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `passport_orders`
--

CREATE TABLE `passport_orders` (
  `id` int NOT NULL,
  `passport_id` int NOT NULL,
  `passport_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `status` int NOT NULL,
  `volume_amount` int NOT NULL DEFAULT '0',
  `used_amount` int NOT NULL DEFAULT '0',
  `remaining_amount` int NOT NULL DEFAULT '0',
  `payment_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `pay_status` int DEFAULT '0' COMMENT '0->pending, 1->success, 2->failed',
  `pay_res` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `order_date` date NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `is_custom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `otp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `coupon_redeem_ids` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_approw` int NOT NULL DEFAULT '0',
  `is_free` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passport_orders`
--

INSERT INTO `passport_orders` (`id`, `passport_id`, `passport_code`, `name`, `user_id`, `phone`, `email`, `price`, `status`, `volume_amount`, `used_amount`, `remaining_amount`, `payment_id`, `payment_date`, `pay_status`, `pay_res`, `order_date`, `start_date`, `end_date`, `is_custom`, `created_at`, `updated_at`, `otp`, `coupon_redeem_ids`, `is_approw`, `is_free`) VALUES
(12, 11, '91749088', 'SUNITA GEORGE', 817, '9870003347', '999@GMAIL.COM', 9450, 1, 13000, 4165, 8835, NULL, NULL, 0, NULL, '2023-10-22', '2023-10-22', '2024-10-22', '1', '2023-11-02 19:23:48', '2023-11-02 19:29:42', NULL, '', 1, NULL),
(13, 11, '19311271', 'SANTOSH KUMAR', 818, '9937148144', '888@GMAIL.COM', 9450, 1, 13000, 3046, 9954, NULL, NULL, 0, NULL, '2023-09-22', '2023-09-22', '2024-09-22', '1', '2023-11-02 20:06:37', '2023-11-02 20:09:00', NULL, '', 1, NULL),
(14, 11, '90128127', 'SUNNY RAMCHANDRA', 820, '7738262078', '111@GMAIL.COM', 9450, 1, 13000, 5348, 7652, NULL, NULL, 0, NULL, '2023-06-30', '2023-06-30', '2024-06-30', '1', '2023-11-02 20:21:38', '2023-11-02 20:23:51', NULL, '', 1, NULL),
(15, 11, '54334583', 'GAURAV MEHTA', 821, '9967070780', '222@GMAIL.COM', 9450, 1, 13000, 4680, 8320, NULL, NULL, 0, NULL, '2023-08-12', '2023-08-12', '2024-08-12', '1', '2023-11-02 20:35:10', '2023-11-02 20:38:10', NULL, '', 1, NULL),
(16, 11, '72733987', 'MANISH R', 822, '9892733330', '000@GMAIL.COM', 9450, 1, 13000, 6570, 6430, NULL, NULL, 0, NULL, '2023-08-29', '2023-08-29', '2024-08-29', '1', '2023-11-02 20:40:08', '2023-11-02 20:44:59', NULL, '', 1, NULL),
(17, 11, '60172290', 'K.V IYER', 823, '9619906172', '333@GMAIL.COM', 9450, 1, 13000, 2886, 10114, NULL, NULL, 0, NULL, '2023-09-06', '2023-09-06', '2024-09-06', '1', '2023-11-02 20:49:04', '2023-11-02 20:52:35', NULL, '', 1, NULL),
(18, 11, '77212641', 'VINAY KUTUR', 824, '9820261355', '444@GMAIL.COM', 9450, 1, 13000, 0, 13000, NULL, NULL, 0, NULL, '2023-10-25', '2023-10-25', '2024-10-25', '1', '2023-11-02 20:54:24', '2023-11-02 20:58:18', NULL, '', 1, NULL),
(19, 11, '58882304', 'TANUJA DEVADIGA', 825, '9867212676', '555@GMAIL.COM', 9450, 1, 13000, 5868, 7132, NULL, NULL, 0, NULL, '2023-09-17', '2023-09-17', '2024-09-17', '1', '2023-11-02 21:01:55', '2023-11-02 21:04:52', NULL, '', 1, NULL),
(20, 11, '52647432', 'VAINEY SEHGAZ', 826, '7506587005', '666@GMAIL.COM', 9450, 1, 13000, 1321, 11679, NULL, NULL, 0, NULL, '2023-10-20', '2023-10-20', '2024-10-20', '1', '2023-11-02 21:10:12', '2023-11-02 21:13:23', NULL, '', 1, NULL),
(21, 11, '3476928', 'HIMANSHU OBEROI', 827, '9766998855', '777@GMAIL.COM', 9450, 1, 13000, 5362, 7638, NULL, NULL, 0, NULL, '2023-09-15', '2023-09-15', '2024-09-15', '1', '2023-11-02 21:39:22', '2023-11-02 22:13:50', NULL, '', 1, NULL),
(22, 11, '6457978', 'ANKIT GUPTA', 828, '7304467801', '1212@GMAIL.COM', 9450, 1, 13000, 700, 12300, NULL, NULL, 0, NULL, '2023-09-13', '2023-09-13', '2024-09-13', '1', '2023-11-02 23:04:32', '2023-11-02 23:07:05', NULL, '', 1, NULL),
(23, 11, '55829533', 'ARSHDEEP', 829, '7307079944', '1010@GMAIL.COM', 9450, 1, 13000, 4191, 8809, NULL, NULL, 0, NULL, '2023-09-01', '2023-09-01', '2024-09-01', '1', '2023-11-02 23:09:43', '2023-11-02 23:11:31', NULL, '', 1, NULL),
(24, 11, '34055823', 'ANUBHAV', 830, '9819651280', '0202@GMAIL.COM', 9450, 1, 13000, 0, 13000, NULL, NULL, 0, NULL, '2023-08-07', '2023-08-07', '2024-08-07', '1', '2023-11-02 23:14:05', '2023-11-02 23:16:28', NULL, '', 1, NULL),
(25, 11, '44414081', 'BIJU KUTTY', 831, '9930834527', 'BIJYKITTY@GMAIL.COM', 9450, 1, 13000, 4040, 8960, NULL, NULL, 0, NULL, '2023-08-19', '2023-08-19', '2024-08-19', '1', '2023-11-02 23:30:32', '2023-11-02 23:33:13', NULL, '', 1, NULL),
(26, 11, '7569974', 'MR.BHUPESH', 832, '9969544824', '6565@GMAIL.COM', 9450, 1, 13000, 4500, 8500, NULL, NULL, 0, NULL, '2023-08-24', '2023-08-24', '2024-08-24', '1', '2023-11-02 23:39:29', '2023-11-02 23:41:30', NULL, '', 1, NULL),
(27, 11, '94423416', 'ROHIT SULE', 833, '9820606840', '3131@GMAIL.COM', 8400, 1, 12000, 4403, 7597, NULL, NULL, 0, NULL, '2022-12-21', '2022-12-21', '2023-12-21', '1', '2023-11-03 18:57:30', '2023-11-03 19:02:38', NULL, '', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `passport_order_histories`
--

CREATE TABLE `passport_order_histories` (
  `id` int NOT NULL,
  `passport_id` int NOT NULL,
  `passport_order_id` int DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `status` int NOT NULL,
  `volume_amount` int NOT NULL DEFAULT '0',
  `used_amount` int NOT NULL DEFAULT '0',
  `remaining_amount` int NOT NULL DEFAULT '0',
  `payment_id` varchar(255) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `pay_status` int DEFAULT '0' COMMENT '0->pending, 1->success, 2->failed',
  `pay_res` text,
  `order_date` date NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `is_custom` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `add_by` varchar(255) NOT NULL,
  `add_by_id` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `updated_by_id` varchar(255) NOT NULL,
  `otp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `passport_order_histories`
--

INSERT INTO `passport_order_histories` (`id`, `passport_id`, `passport_order_id`, `name`, `user_id`, `phone`, `email`, `price`, `status`, `volume_amount`, `used_amount`, `remaining_amount`, `payment_id`, `payment_date`, `pay_status`, `pay_res`, `order_date`, `start_date`, `end_date`, `is_custom`, `created_at`, `updated_at`, `add_by`, `add_by_id`, `updated_by`, `updated_by_id`, `otp`) VALUES
(244, 11, 12, 'SUNITA GEORGE', 817, '9870003347', '999@GMAIL.COM', 9450, 1, 13000, 0, 13000, NULL, NULL, 0, NULL, '2023-10-22', '2023-10-22', '2024-10-22', '1', '2023-11-02 13:53:48', '2023-11-02 13:53:48', '', '', '', '', NULL),
(245, 11, 13, 'SANTOSH KUMAR', 818, '9937148144', '888@GMAIL.COM', 9450, 1, 13000, 0, 13000, NULL, NULL, 0, NULL, '2023-09-22', '2023-09-22', '2024-09-22', '1', '2023-11-02 14:36:37', '2023-11-02 14:36:37', '', '', '', '', NULL),
(246, 11, 14, 'SUNNY RAMCHANDRA', 820, '7738262078', '111@GMAIL.COM', 9450, 1, 13000, 0, 13000, NULL, NULL, 0, NULL, '2023-06-30', '2023-06-30', '2024-06-30', '1', '2023-11-02 14:51:38', '2023-11-02 14:51:38', '', '', '', '', NULL),
(247, 11, 15, 'GAURAV MEHTA', 821, '9967070780', '222@GMAIL.COM', 9450, 1, 13000, 0, 13000, NULL, NULL, 0, NULL, '2023-08-12', '2023-08-12', '2024-08-12', '1', '2023-11-02 15:05:10', '2023-11-02 15:05:10', '', '', '', '', NULL),
(248, 11, 16, 'MANISH R', 822, '9892733330', '000@GMAIL.COM', 9450, 1, 13000, 0, 13000, NULL, NULL, 0, NULL, '2023-08-29', '2023-08-29', '2024-08-29', '1', '2023-11-02 15:10:08', '2023-11-02 15:10:08', '', '', '', '', NULL),
(249, 11, 17, 'K.V IYER', 823, '9619906172', '333@GMAIL.COM', 9450, 1, 13000, 0, 13000, NULL, NULL, 0, NULL, '2023-09-06', '2023-09-06', '2024-09-06', '1', '2023-11-02 15:19:04', '2023-11-02 15:19:04', '', '', '', '', NULL),
(250, 11, 18, 'VINAY KUTUR', 824, '9820261355', '444@GMAIL.COM', 9450, 1, 13000, 0, 13000, NULL, NULL, 0, NULL, '2023-10-25', '2023-10-25', '2024-10-25', '1', '2023-11-02 15:24:24', '2023-11-02 15:24:24', '', '', '', '', NULL),
(251, 11, 19, 'TANUJA DEVADIGA', 825, '9867212676', '555@GMAIL.COM', 9450, 1, 13000, 0, 13000, NULL, NULL, 0, NULL, '2023-09-17', '2023-09-17', '2024-09-17', '1', '2023-11-02 15:31:55', '2023-11-02 15:31:55', '', '', '', '', NULL),
(252, 11, 20, 'VAINEY SEHGAZ', 826, '7506587005', '666@GMAIL.COM', 9450, 1, 13000, 0, 13000, NULL, NULL, 0, NULL, '2023-10-20', '2023-10-20', '2024-10-20', '1', '2023-11-02 15:40:12', '2023-11-02 15:40:12', '', '', '', '', NULL),
(253, 11, 21, 'HIMANSHU OBEROI', 827, '9766998855', '777@GMAIL.COM', 9450, 1, 13000, 0, 13000, NULL, NULL, 0, NULL, '2023-09-15', '2023-09-15', '2024-09-15', '1', '2023-11-02 16:09:22', '2023-11-02 16:09:22', '', '', '', '', NULL),
(254, 11, 22, 'ANKIT GUPTA', 828, '7304467801', '1212@GMAIL.COM', 9450, 1, 13000, 0, 13000, NULL, NULL, 0, NULL, '2023-09-13', '2023-09-13', '2024-09-13', '1', '2023-11-02 17:34:32', '2023-11-02 17:34:32', '', '', '', '', NULL),
(255, 11, 23, 'ARSHDEEP', 829, '7307079944', '1010@GMAIL.COM', 9450, 1, 13000, 0, 13000, NULL, NULL, 0, NULL, '2023-09-01', '2023-09-01', '2024-09-01', '1', '2023-11-02 17:39:43', '2023-11-02 17:39:43', '', '', '', '', NULL),
(256, 11, 24, 'ANUBHAV', 830, '9819651280', '0202@GMAIL.COM', 9450, 1, 13000, 0, 13000, NULL, NULL, 0, NULL, '2023-08-07', '2023-08-07', '2024-08-07', '1', '2023-11-02 17:44:05', '2023-11-02 17:44:05', '', '', '', '', NULL),
(257, 11, 25, 'BIJU KUTTY', 831, '9930834527', 'BIJYKITTY@GMAIL.COM', 9450, 1, 13000, 0, 13000, NULL, NULL, 0, NULL, '2023-08-19', '2023-08-19', '2024-08-19', '1', '2023-11-02 18:00:32', '2023-11-02 18:00:32', '', '', '', '', NULL),
(258, 11, 26, 'MR.BHUPESH', 832, '9969544824', '6565@GMAIL.COM', 9450, 1, 13000, 0, 13000, NULL, NULL, 0, NULL, '2023-08-24', '2023-08-24', '2024-08-24', '1', '2023-11-02 18:09:29', '2023-11-02 18:09:29', '', '', '', '', NULL),
(259, 11, 27, 'ROHIT SULE', 833, '9820606840', '3131@GMAIL.COM', 8400, 1, 12000, 0, 12000, NULL, NULL, 0, NULL, '2022-12-21', '2022-12-21', '2023-12-21', '1', '2023-11-03 13:27:30', '2023-11-03 13:27:30', '', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `passport_pages`
--

CREATE TABLE `passport_pages` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passport_pages`
--

INSERT INTO `passport_pages` (`id`, `name`, `slug`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Top Heading', 'top-heading', 'Finch Beer Travel passport @9000/- Unlimited Benefits\r\n• Beer worth Rs. 13,000/-\r\n• Complimentary bottle of House Wine (worth Rs. 3200/-)\r\n• Complimentary dessert on your Birthday/Anniversary (Big Bang worth Rs.1200/-)\r\n• One complimentary brunch coupon for 2 pax (worth Rs. 2300/-)\r\n• Complimentary invites for paid gigs at the Finch valid for 2 pax.\r\n• 15% discount on Food (Take away & Dine In)\r\n• Exclusive invites to the beer league event.\r\n• Exclusive invites for tasting session.\r\n• One free invite for Mixology/Food workshop (Bring a friend and avail 50% discount on the workshop)\r\n• Complimentary tour of our brewery.\r\n• Referral bonus of one 2 take away beer worth Rs. 1100/-', 1, '2021-09-16 23:23:58', '2023-08-21 11:42:14'),
(2, 'Terms Of User', 'terms-of-user', 'Terms & Conditions:\r\n• Valid at “The Finch” (Saki Vihar) / “Finch Brewhouse” (Thane)\r\n• Valid only on available craft beers at the above-mentioned locations.\r\n• 1 Year validity.\r\n• Min. consumption 500 Ml in one transaction.\r\n• Max. discount INR 3,600/- in 1 day.\r\n• This Beer passport offers cannot be clubbed with other\r\n   offers/discounts available at the outlets.\r\n• This passport in non-transferrable/non-refundable\r\n    and cannot be wholly or partly uncashed/refunded.\r\n• Strictly no take away on this passport.\r\n• Applicable only on Dine In.', 1, '2021-09-16 23:23:58', '2023-08-21 11:46:41'),
(3, 'See All Benefits', 'see-all-benefits', '• Beer worth Rs. 13,000/-\r\n• Complimentary bottle of House Wine (worth Rs. 3200/-)\r\n• Complimentary dessert on your Birthday/Anniversary (Big Bang worth Rs.1200/-)\r\n• One complimentary brunch coupon for 2 pax (worth Rs. 2300/-)\r\n• Complimentary invites for paid gigs at the Finch valid for 2 pax.\r\n• 15% discount on Food (Take away & Dine In)\r\n• Exclusive invites to the beer league event.\r\n• Exclusive invites for tasting session.\r\n• One free invite for Mixology/Food workshop (Bring a friend and avail 50% discount on the workshop)\r\n• Complimentary tour of our brewery.\r\n• Referral bonus of one 2 take away beer worth Rs. 1100/-', 1, '2021-09-16 23:23:58', '2023-08-21 11:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `passport_used_orders`
--

CREATE TABLE `passport_used_orders` (
  `id` int NOT NULL,
  `passport_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `amount` int NOT NULL DEFAULT '0',
  `order_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `order_type` int NOT NULL DEFAULT '0',
  `order_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passport_used_orders`
--

INSERT INTO `passport_used_orders` (`id`, `passport_code`, `user_id`, `amount`, `order_date`, `order_type`, `order_id`, `created_at`, `updated_at`) VALUES
(26, '91749088', 817, 4165, '2023-10-22', 2, 0, '2023-11-02 19:27:54', '2023-11-02 19:27:54'),
(27, '19311271', 818, 3046, '2023-09-22', 2, 0, '2023-11-02 20:08:44', '2023-11-02 20:08:44'),
(28, '90128127', 820, 5348, '2023-06-30', 2, 0, '2023-11-02 20:23:33', '2023-11-02 20:23:33'),
(29, '54334583', 821, 4680, '2023-08-12', 2, 0, '2023-11-02 20:37:48', '2023-11-02 20:37:48'),
(30, '72733987', 822, 6570, '2023-08-29', 2, 0, '2023-11-02 20:44:41', '2023-11-02 20:44:41'),
(31, '60172290', 823, 2886, '2023-09-06', 2, 0, '2023-11-02 20:52:14', '2023-11-02 20:52:14'),
(32, '77212641', 824, 0, '2023-10-25', 2, 0, '2023-11-02 20:57:37', '2023-11-02 20:57:37'),
(33, '58882304', 825, 5868, '2023-09-17', 2, 0, '2023-11-02 21:03:51', '2023-11-02 21:03:51'),
(34, '52647432', 826, 1321, '2023-10-20', 2, 0, '2023-11-02 21:12:01', '2023-11-02 21:12:01'),
(35, '3476928', 827, 5362, '2023-09-15', 2, 0, '2023-11-02 22:13:32', '2023-11-02 22:13:32'),
(36, '6457978', 828, 700, '2023-09-13', 2, 0, '2023-11-02 23:06:23', '2023-11-02 23:06:23'),
(37, '55829533', 829, 4191, '2023-09-01', 2, 0, '2023-11-02 23:11:02', '2023-11-02 23:11:02'),
(38, '34055823', 830, 0, '2023-08-07', 2, 0, '2023-11-02 23:16:02', '2023-11-02 23:16:02'),
(39, '44414081', 831, 4040, '2023-08-19', 2, 0, '2023-11-02 23:32:50', '2023-11-02 23:32:50'),
(40, '7569974', 832, 4500, '2023-08-24', 2, 0, '2023-11-02 23:41:14', '2023-11-02 23:41:14'),
(41, '94423416', 833, 4403, '2022-12-21', 2, 0, '2023-11-03 19:02:18', '2023-11-03 19:02:18');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sub_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `location` int NOT NULL DEFAULT '0',
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `slogan_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slogan_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_id` int NOT NULL DEFAULT '0',
  `file_ids` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `file_id_logo` int NOT NULL,
  `icon_id` int NOT NULL DEFAULT '0',
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `phone_1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_2` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `add_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `add_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `name`, `email`, `password`, `sub_description`, `description`, `location`, `slug`, `status`, `slogan_1`, `slogan_2`, `file_id`, `file_ids`, `file_id_logo`, `icon_id`, `remember_token`, `address`, `phone_1`, `phone_2`, `created_at`, `updated_at`, `add_by`, `add_by_id`, `updated_by`, `updated_by_id`) VALUES
(4, 'Finch Brewhouse', 'finch_4@gmail.com', '$2y$10$jCYTq0TPu8jhlEAcYg7E7./82ypdwXWs2EdmoJ6nN96szyIvoUVd6', 'A culinary experience with glamorous exclusivity in your glasses  senses', '𝐀 𝐜𝐮𝐥𝐢𝐧𝐚𝐫𝐲 𝐞𝐱𝐩𝐞𝐫𝐢𝐞𝐧𝐜𝐞 𝐰𝐢𝐭𝐡 𝐠𝐥𝐚𝐦𝐨𝐫𝐨𝐮𝐬 𝐞𝐱𝐜𝐥𝐮𝐬𝐢𝐯𝐢𝐭𝐲 𝐢𝐧 𝐲𝐨𝐮𝐫 𝐠𝐥𝐚𝐬𝐬𝐞𝐬 & 𝐬𝐞𝐧𝐬𝐞𝐬.', 12, 'the-finch-2', 1, NULL, NULL, 1509, '1515,1516,1517,1518', 1632, 1510, NULL, 'Lodha Amara, Kolshet Rd, Kolshet Industrial Area, Thane West, Thane, Maharashtra 400607', '9321944495', NULL, '2021-10-20 07:45:48', '2023-09-18 11:14:15', '', '', 'Admin', '1'),
(7, 'The Finch - Mumbai', 'andherifinch@gmail.com', '$2y$10$A0ZQ4JnOVfJ4vabIts6IMuWkLibt2cIuQun5ndrRZC3m5y1.PmRcO', 'The Finch is a distinctive destination for the best international cuisine and bestcrafted brews We celebrate extraordinaryflavours of our local and imported fresh ingredients in our kitchen', 'The Finch is a distinctive destination for the best international cuisine and best-crafted brews. We celebrate extraordinaryﬂavours of our local and imported fresh ingredients in our kitchen to be\r\nserved in a vibrant and contemporary setting. We serve a wide variety of freshly prepared delicious food and brews.', 2, 'pawai', 1, NULL, NULL, 1493, '1494,1495,1496,1497,1498,1499', 1633, 1492, 'h1w3NekaPC8mgzZwRAcWXF0tAz7T4kHxvXABBGjxIXc1vztpjux7ulhx6PBj', 'Shah Industrial Estate, Opposite to Huntsman Building, Saki Vihar Rd, next to John Baker, Andheri East, Mumbai, Maharashtra 400072', '9871730731', NULL, '2021-11-11 12:53:53', '2023-08-24 18:25:30', '', '', 'Admin', '1'),
(9, 'Finch BrewCafe - Amritsar', 'finch_amritsar@gmail.com', '$2y$10$nzbwmb7ng7biTmIT18.H1Ofnv6rjsOdEYAEARk9BnVB38w.2YXyRi', 'With fresh tap #beers, global bites, friendly service and cozy #vibes, this is simply a place where your day gets better!', 'With fresh tap #beers, global bites, friendly service and cozy #vibes, this is simply a place where your day gets better!', 8, 'finch-brewcafe', 1, NULL, NULL, 93, '348,349,350,351,352', 0, 657, NULL, 'S.C.O. No. 22, 97 Acre Scheme, Ranjit Avenue, Amritsar, Punjab 143001', '07428081018', NULL, '2021-12-20 10:04:51', '2022-03-17 08:39:23', '', '', '', ''),
(10, 'Finch BrewCafe - Jalandhar', 'finch_Jalandhar@gmail.com', '$2y$10$1CkX9IxAP1KsCZKsKOTNyuoUeHGCtqAVRMxhwNaaTWlRh8BNlHC0q', 'With fresh tap #beers, global bites, friendly service and cozy #vibes, this is simply a place where your day gets better!', 'With fresh tap #beers, global bites, friendly service and cozy #vibes, this is simply a place where your day gets better!', 7, 'finch-brewcafe-jalandhar', 1, NULL, NULL, 100, '353,354,355,356,357,358', 0, 1519, 'q4eW8qtvEUOMXQo2XtXXfHCkT66cdPHoKM2dzmlH20qhd0kjuN2gtOKcqmKA', 'Plot No. 199- A, Ground Floor, Model Town, Jalandhar, Punjab 144003', '07428081017', NULL, '2021-12-20 10:11:27', '2023-06-02 13:13:36', '', '', 'Admin', '1'),
(11, 'Finch BrewCafe, Golf city Khalapur', 'Khalapur@gmail.com', '$2y$10$6QC.b2mv/vRwiyZB3mgyE.G.xvOiK94ip2lvsBsKOk4lyl6iAmX4.', 'The Finch Brew Cafe Is A Distinctive Destination For The Best International Cuisine And Best Crafted Brews. We Celebrate Extraordinaryﬂavours Of Our Local And Imported Fresh Ingredients In Our Kitchen', 'The Finch Brew Cafe Is A Distinctive Destination For The Best International Cuisine And Best Crafted Brews. We Celebrate Extraordinaryﬂavours Of Our Local And Imported Fresh Ingredients In Our Kitchen To Be Served In A Vibrant And Contemporary Setting. We Serve A Wide Variety Of Freshly Prepared Deliciously Food And Brews .', 2, 'finch-brewcafe-golf-city-khalapur', 1, NULL, NULL, 1455, '1456,1457,1458,1459,1460,1461,1462,1463,1464,1465', 0, 1466, NULL, 'Finch BrewCafe, Golfcity, Khalapur Indiabulls Golf City, Savroli Village, Near Khalapur Toll Naka', '7304928954', NULL, '2023-02-02 15:46:12', '2023-03-21 07:27:35', '', '', 'Admin', '1'),
(12, 'Brew cafe Bangkok', 'bangkok@thefinchinternational.com', '$2y$10$BlKHnrxnqIYB/4AwwS/7R.Pv/rcmsBuYr9OSOxTUCVsa8/jkudMBe', 'Brew cafe Bangkok', 'Brew cafe Bangkok', 11, 'brew-cafe-bangkok', 0, NULL, NULL, 1469, '1470,1471,1472,1473,1474,1475,1476,1477,1478', 0, 1468, NULL, 'Ten Ekamai Residences 33/39 Ekamai soi 10, Sukhumvit 63, Road 33/55, Khong Ten Nuea. Watthana, Bangkok 10110', '123-456-7890', NULL, '2023-02-02 15:54:21', '2023-09-18 11:14:31', '', '', 'Admin', '1'),
(14, 'test restaurant', 'test@gmail.com', '$2y$10$TZu3UuRRwRPR2vfz9uFgSeWpr7sHOJjAkwH/iDqmhxEYbZo0goGRi', 'test', 'test', 14, 'test-restaurant', 1, 'efgt', 'rgth', 1591, '1593,1594,1595,1596,1597,1592', 1603, 1590, NULL, 'dewas test', '1231231231', NULL, '2023-04-22 06:43:24', '2023-04-22 07:04:12', 'Admin', '1', 'Admin', '1');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sub_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `location` int NOT NULL,
  `place` int NOT NULL DEFAULT '0',
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category` int NOT NULL,
  `sub_category` int DEFAULT NULL,
  `type` int NOT NULL,
  `file_id` int DEFAULT NULL,
  `badge_file` int DEFAULT NULL,
  `price` float(10,2) NOT NULL,
  `tax` float(10,2) NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `hops` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `malt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `quantity` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `percentage` float DEFAULT NULL,
  `color` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `orignal_gravity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `style` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `add_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `add_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_product_attr` int NOT NULL DEFAULT '0',
  `attribute_id` int NOT NULL DEFAULT '0',
  `option_id` int NOT NULL DEFAULT '0',
  `stock` int DEFAULT NULL,
  `is_home` int NOT NULL DEFAULT '0',
  `is_veg` int NOT NULL DEFAULT '0',
  `for_passport` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `sub_title`, `location`, `place`, `short_description`, `description`, `category`, `sub_category`, `type`, `file_id`, `badge_file`, `price`, `tax`, `total_price`, `hops`, `malt`, `quantity`, `percentage`, `color`, `orignal_gravity`, `style`, `status`, `updated_at`, `add_by`, `add_by_id`, `updated_by`, `updated_by_id`, `is_product_attr`, `attribute_id`, `option_id`, `stock`, `is_home`, `is_veg`, `for_passport`) VALUES
(243, 'Wizard of Wit', 'Belgian Wit', 2, 7, 'Witbier this masterful yeasty and enlivening quencher, was thankfully rebirthed from extinction\r\nby a milkman. Experience our incarnation of a pleasant malty-sweet grain flavor.', 'Witbier this masterful yeasty and enlivening quencher, was thankfully rebirthed from extinction\r\nby a milkman. Experience our incarnation of a pleasant malty-sweet grain flavor.', 1, NULL, 1, 276, 1058, 599.00, 5.00, 628.00, '', '', '1 ltr', 4.5, 'Green', '1', '1', 1, '2023-08-21 18:39:11', '', '', 'Admin', '1', 0, 0, 0, 1, 1, 0, 0),
(244, 'Pip ‘n’ peel', 'Apple Cider', 2, 7, 'Our labor of love finds its origins from the rich in depth and character apples grown in the hills of Himachal. Contains deliciously fermented apple juice with a taste of the wild yeast.', 'Our labor of love finds its origins from the rich in depth and character apples grown in the hills of Himachal. Contains deliciously fermented apple juice with a taste of the wild yeast.', 2, 1, 1, 277, 1060, 599.00, 5.00, 628.00, '', '', '1 ltr', 4.5, 'red', '1', '1', 1, '2023-07-28 17:37:29', '', '', 'Admin', '1', 0, 0, 0, 1, 1, 0, 0),
(245, 'Barbara Weissand', 'Hefeweizen', 2, 7, 'Traditionally loved by the royals of Bavaria, appreciate our cherished flavor on offer, first by the harmonized smell of fruit and spice in the form of banana and clove.', 'Traditionally loved by the royals of Bavaria, appreciate our cherished flavor on offer, first by the harmonized smell of fruit and spice in the form of banana and clove.', 40, NULL, 1, 278, 1057, 599.00, 5.00, 628.00, '', '', '1 ltr', 4.5, 'yellow', '1', '1', 1, '2023-07-28 17:37:23', '', '', 'Admin', '1', 0, 0, 0, 1, 1, 0, 0),
(246, 'Cloud Black', 'Stout', 2, 7, 'Historically, the full-bodied black nitrogen infused black beer, is a result of wisdom of a mathematician. Pronounced roasted flavor akin to coffee and dark chocolate with a malty complexity.', 'Historically, the full-bodied black nitrogen infused black beer, is a result of wisdom of a mathematician. Pronounced roasted flavor akin to coffee and dark chocolate with a malty complexity.', 4, NULL, 1, 279, 1059, 599.00, 5.00, 628.00, '', '', '1 ltr', 4.5, 'pink-yellow', '1', '1', 1, '2023-04-29 06:15:54', '', '', 'Admin', '1', 0, 0, 0, 1, 1, 0, 0),
(247, 'Bombay dock', 'Indian pale ale', 2, 7, 'A passage to India from London by ship of a specially brewed batch, loaded with just picked hops\r\nsaw the birth of the Indian Pale Ale.', 'A passage to India from London by ship of a specially brewed batch, loaded with just picked hops\r\nsaw the birth of the Indian Pale Ale.', 5, NULL, 1, 280, 1055, 599.00, 5.00, 628.00, '', '', '1 ltr', 4.5, 'blue', '1', '1', 1, '2023-04-29 06:17:02', '', '', 'Admin', '1', 0, 0, 0, 1, 1, 0, 0),
(248, 'Kolsch', 'lager', 2, 7, 'Straw gold in color with a lively citrus fragrant hops and malt aromas to tickle your nose.\r\nWhile your mouth savours smooth, fruity a and biscuit flavors with a gentle finish of a herbal hops.', 'Straw gold in color with a lively citrus fragrant hops and malt aromas to tickle your nose.\r\nWhile your mouth savours smooth, fruity a and biscuit flavors with a gentle finish of a herbal hops.', 6, NULL, 1, 282, 1054, 599.00, 5.00, 628.00, '', '', '1 ltr', 4.5, 'pink', '1', '1', 1, '2023-04-29 06:00:03', '', '', 'Admin', '1', 0, 0, 0, 1, 1, 0, 0),
(342, 'Kingfisher Lager', 'Kingfisher Lager', 8, 9, 'Kingfisher Lager', 'Kingfisher Lager', 6, NULL, 1, 1235, 1236, 245.00, 0.00, 245.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:45:15', '', '', 'Admin', '1', 1, 10, 34, 1, 0, 0, 0),
(343, 'Kingfisher Lager', 'Kingfisher Lager', 7, 10, 'Kingfisher Lager', 'Kingfisher Lager', 6, NULL, 1, 1235, 1236, 245.00, 0.00, 245.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:45:02', '', '', 'Admin', '1', 1, 10, 34, 1, 0, 0, 0),
(344, 'Kingfisher Strong', 'Kingfisher Strong', 8, 9, 'Kingfisher Strong', 'Kingfisher Strong', 6, NULL, 1, 1237, 1238, 295.00, 0.00, 295.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:44:47', '', '', 'Admin', '1', 1, 10, 34, 1, 0, 0, 0),
(345, 'Kingfisher Strong', 'Kingfisher Strong', 7, 10, 'Kingfisher Strong', 'Kingfisher Strong', 6, NULL, 1, 1237, 1238, 295.00, 0.00, 295.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:44:35', '', '', 'Admin', '1', 1, 10, 34, 1, 0, 0, 0),
(346, 'Belgian Wit Beer', 'Belgian Wit Beer', 8, 9, 'Belgian Wit Beer', 'Belgian Wit Beer', 1, NULL, 1, 1239, 1240, 295.00, 0.00, 295.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:44:04', '', '', 'Admin', '1', 1, 10, 34, 1, 0, 0, 0),
(347, 'Belgian Wit Beer', 'Belgian Wit Beer', 7, 10, 'Belgian Wit Beer', 'Belgian Wit Beer', 1, NULL, 1, 1239, 1240, 295.00, 0.00, 295.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:43:45', '', '', 'Admin', '1', 1, 10, 34, 1, 0, 0, 0),
(348, 'Cloud Black Beer', 'Cloud Black Beer', 8, 9, 'Cloud Black Beer', 'Cloud Black Beer', 4, NULL, 1, 1242, 1241, 295.00, 0.00, 295.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:43:36', '', '', 'Admin', '1', 1, 10, 34, 1, 0, 0, 0),
(349, 'Cloud Black Beer', 'Cloud Black Beer', 7, 10, 'Cloud Black Beer', 'Cloud Black Beer', 4, NULL, 1, 1242, 1241, 295.00, 0.00, 295.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:43:25', '', '', 'Admin', '1', 1, 10, 34, 1, 0, 0, 0),
(350, 'Kolsch Lager Beer', 'Kolsch Lager', 8, 9, 'Kolsch Lager Beer', 'Kolsch Lager Beer', 6, NULL, 1, 1243, 1244, 295.00, 0.00, 295.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:42:58', '', '', 'Admin', '1', 1, 10, 34, 1, 0, 0, 0),
(351, 'Kolsch Lager Beer', 'Kolsch Lager', 7, 10, 'Kolsch Lager Beer', 'Kolsch Lager Beer', 6, NULL, 1, 1243, 1244, 295.00, 0.00, 295.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:48:18', '', '', 'Admin', '1', 1, 10, 34, 1, 0, 0, 0),
(352, 'Kingfisher Premium', 'Kingfisher Premium', 8, 9, 'Kingfisher Premium', 'Kingfisher Premium', 6, NULL, 1, 1245, 1246, 195.00, 0.00, 195.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:48:05', '', '', 'Admin', '1', 1, 11, 38, 1, 0, 0, 0),
(353, 'Kingfisher Premium', 'Kingfisher Premium', 7, 10, 'Kingfisher Premium', 'Kingfisher Premium', 6, NULL, 1, 1245, 1246, 195.00, 0.00, 195.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:47:53', '', '', 'Admin', '1', 1, 11, 38, 1, 0, 0, 0),
(354, 'Kingfisher Strong', 'Kingfisher Strong', 8, 9, 'Kingfisher Strong', 'Kingfisher Strong', 6, NULL, 1, 1247, 1249, 225.00, 0.00, 225.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:47:39', '', '', 'Admin', '1', 1, 11, 38, 1, 0, 0, 0),
(355, 'Kingfisher Strong', 'Kingfisher Strong', 7, 10, 'Kingfisher Strong', 'Kingfisher Strong', 6, NULL, 1, 1247, 1249, 225.00, 0.00, 225.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:46:48', '', '', 'Admin', '1', 1, 11, 38, 1, 0, 0, 0),
(356, 'Kingfisher Ultra', 'Kingfisher Ultra', 8, 9, 'Kingfisher Ultra', 'Kingfisher Ultra', 6, NULL, 1, 1251, 1252, 275.00, 0.00, 275.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:46:37', '', '', 'Admin', '1', 1, 11, 38, 1, 0, 0, 0),
(357, 'Kingfisher Ultra', 'Kingfisher Ultra', 7, 10, 'Kingfisher Ultra', 'Kingfisher Ultra', 6, NULL, 1, 1251, 1252, 275.00, 0.00, 275.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:46:21', '', '', 'Admin', '1', 1, 11, 38, 1, 0, 0, 0),
(358, 'Blender’s Pride', 'Blender’s Pride', 8, 9, 'Blender’s Pride', 'Blender’s Pride', 44, NULL, 1, 1250, 1253, 295.00, 0.00, 295.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:46:06', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(359, 'Blender’s Pride', 'Blender’s Pride', 7, 10, 'Blender’s Pride', 'Blender’s Pride', 44, NULL, 1, 1250, 1253, 295.00, 0.00, 295.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:45:55', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(360, 'Budweiser', 'Budweiser', 8, 9, 'Budweiser', 'Budweiser', 6, NULL, 1, 1256, 1257, 295.00, 0.00, 295.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:45:40', '', '', 'Admin', '1', 1, 11, 38, 1, 0, 0, 0),
(361, 'Budweiser', 'Budweiser', 7, 10, 'Budweiser', 'Budweiser', 6, NULL, 1, 1256, 1257, 295.00, 0.00, 295.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:50:59', '', '', 'Admin', '1', 1, 11, 38, 1, 0, 0, 0),
(362, 'Black & White', 'Black & White', 8, 9, 'Black & White', 'Black & White', 44, NULL, 1, 1254, 1255, 325.00, 0.00, 325.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:50:48', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(363, 'Black & White', 'Black & White', 7, 10, 'Black & White', 'Black & White', 44, NULL, 1, 1254, 1255, 325.00, 0.00, 325.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:50:38', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(364, 'Heineken', 'Heineken', 8, 9, 'Heineken', 'Heineken', 6, NULL, 1, 1259, 1261, 295.00, 0.00, 295.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:50:10', '', '', 'Admin', '1', 1, 11, 38, 1, 0, 0, 0),
(365, 'Heineken', 'Heineken', 7, 10, 'Heineken', 'Heineken', 6, NULL, 1, 1259, 1261, 295.00, 0.00, 295.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:49:58', '', '', 'Admin', '1', 1, 11, 38, 1, 0, 0, 0),
(366, '100 Pipers', '100 Pipers', 8, 9, '100 Pipers', '100 Pipers', 44, NULL, 1, 1258, 1260, 325.00, 0.00, 325.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:49:43', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(367, '100 Pipers', '100 Pipers', 7, 10, '100 Pipers', '100 Pipers', 44, NULL, 1, 1258, 1260, 325.00, 0.00, 325.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:49:31', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(368, 'Blue Moon', 'Blue Moon', 8, 9, 'Blue Moon', 'Blue Moon', 6, NULL, 1, 1262, 1263, 325.00, 0.00, 325.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:49:22', '', '', 'Admin', '1', 1, 11, 38, 1, 0, 0, 0),
(369, 'Blue Moon', 'Blue Moon', 7, 10, 'Blue Moon', 'Blue Moon', 6, NULL, 1, 1262, 1263, 325.00, 0.00, 325.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:49:13', '', '', 'Admin', '1', 1, 11, 38, 1, 0, 0, 0),
(370, 'Bro Code', 'Bro Code', 8, 9, 'Bro Code', 'Bro Code', 6, NULL, 1, 1264, 1266, 425.00, 0.00, 425.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:49:03', '', '', 'Admin', '1', 1, 11, 38, 1, 0, 0, 0),
(371, 'Bro Code', 'Bro Code', 7, 10, 'Bro Code', 'Bro Code', 6, NULL, 1, 1264, 1266, 425.00, 0.00, 425.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:53:12', '', '', 'Admin', '1', 1, 11, 38, 1, 0, 0, 0),
(372, 'Corona', 'Corona', 8, 9, 'Corona', 'Corona', 6, NULL, 1, 1267, 1269, 445.00, 0.00, 445.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:53:00', '', '', 'Admin', '1', 1, 11, 38, 1, 0, 0, 0),
(373, 'Corona', 'Corona', 7, 10, 'Corona', 'Corona', 6, NULL, 1, 1267, 1269, 445.00, 0.00, 445.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:52:49', '', '', 'Admin', '1', 1, 11, 38, 1, 0, 0, 0),
(374, 'JW Red  Label', 'JW Red  Label', 8, 9, 'JW Red  Label', 'JW Red  Label', 44, NULL, 1, 1268, 1270, 395.00, 0.00, 395.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:52:39', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(375, 'JW Red  Label', 'JW Red  Label', 7, 10, 'JW Red  Label', 'JW Red  Label', 44, NULL, 1, 1268, 1270, 395.00, 0.00, 395.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:52:25', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(376, 'Hoegaarden', 'Hoegaarden', 8, 9, 'Hoegaarden', 'Hoegaarden', 6, NULL, 1, 1271, 1273, 445.00, 0.00, 445.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:52:10', '', '', 'Admin', '1', 1, 11, 38, 1, 0, 0, 0),
(377, 'Hoegaarden', 'Hoegaarden', 7, 10, 'Hoegaarden', 'Hoegaarden', 6, NULL, 1, 1271, 1273, 445.00, 0.00, 445.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:51:52', '', '', 'Admin', '1', 1, 11, 38, 1, 0, 0, 0),
(378, 'Jim Beam', 'Jim Beam', 8, 9, 'Jim Beam', 'Jim Beam', 44, NULL, 1, 1272, 1274, 445.00, 0.00, 445.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:51:39', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(379, 'Jim Beam', 'Jim Beam', 7, 10, 'Jim Beam', 'Jim Beam', 44, NULL, 1, 1272, 1274, 445.00, 0.00, 445.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:51:29', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(380, 'Ballantine\'s', 'Ballantine\'s', 8, 9, 'Ballantine', 'Ballantine', 44, NULL, 1, 1275, 1276, 445.00, 0.00, 445.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:51:19', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(381, 'Ballantine\'s', 'Ballantine\'s', 7, 10, 'Ballantine', 'Ballantine', 44, NULL, 1, 1275, 1276, 445.00, 0.00, 445.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:55:35', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(382, 'Old Monk', 'Old Monk', 8, 9, 'Old Monk', 'Old Monk', 45, NULL, 1, 1277, 1278, 195.00, 0.00, 195.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:55:20', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(383, 'Old Monk', 'Old Monk', 7, 10, 'Old Monk', 'Old Monk', 45, NULL, 1, 1277, 1278, 195.00, 0.00, 195.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:55:08', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(384, 'Black Dog Centenary', 'Black Dog Centenary', 8, 9, 'Black Dog Centenary', 'Black Dog Centenary', 44, NULL, 1, 1279, 1280, 445.00, 0.00, 445.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:54:55', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(385, 'Black Dog Centenary', 'Black Dog Centenary', 7, 10, 'Black Dog Centenary', 'Black Dog Centenary', 44, NULL, 1, 1279, 1280, 445.00, 0.00, 445.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:54:43', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(386, 'Teacher’s Highland Cream', 'Teacher’s Highland Cream', 8, 9, 'Teacher’s Highland Cream', 'Teacher’s Highland Cream', 44, NULL, 1, 1281, 1282, 445.00, 0.00, 445.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:54:29', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(387, 'Teacher’s Highland Cream', 'Teacher’s Highland Cream', 7, 10, 'Teacher’s Highland Cream', 'Teacher’s Highland Cream', 44, NULL, 1, 1281, 1282, 445.00, 0.00, 445.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:54:19', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(388, 'Teacher\'s 50', 'Teacher\'s 50', 8, 9, 'Teacher\'s 50', 'Teacher\'s 50', 44, NULL, 1, 1283, 1284, 465.00, 0.00, 465.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:54:07', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(389, 'Teacher\'s 50', 'Teacher\'s 50', 7, 10, 'Teacher\'s 50', 'Teacher\'s 50', 44, NULL, 1, 1283, 1284, 465.00, 0.00, 465.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:53:55', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(390, 'Jameson', 'Jameson', 8, 9, 'Jameson', 'Jameson', 44, NULL, 1, 1285, 1286, 495.00, 0.00, 495.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:53:44', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(391, 'Jameson', 'Jameson', 7, 10, 'Jameson', 'Jameson', 44, NULL, 1, 1285, 1286, 495.00, 0.00, 495.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:57:57', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(392, 'JW Black Label', 'JW Black Label', 8, 9, 'JW Black Label', 'JW Black Label', 44, NULL, 1, 1287, 1288, 645.00, 0.00, 645.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:57:45', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(393, 'JW Black Label', 'JW Black Label', 7, 10, 'JW Black Label', 'JW Black Label', 44, NULL, 1, 1287, 1288, 645.00, 0.00, 645.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:57:32', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(394, 'Bacardi Black', 'Bacardi Black', 8, 9, 'Bacardi Black', 'Bacardi Black', 45, NULL, 1, 1289, 1290, 275.00, 0.00, 275.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:57:21', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(395, 'Bacardi Black', 'Bacardi Black', 7, 10, 'Bacardi Black', 'Bacardi Black', 45, NULL, 1, 1289, 1290, 275.00, 0.00, 275.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:56:59', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(396, 'Chivas 12 Years', 'Chivas 12 Years', 8, 9, 'Chivas 12 Years', 'Chivas 12 Years', 44, NULL, 1, 1291, 1292, 695.00, 0.00, 695.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:56:47', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(397, 'Chivas 12 Years', 'Chivas 12 Years', 7, 10, 'Chivas 12 Years', 'Chivas 12 Years', 44, NULL, 1, 1291, 1292, 695.00, 0.00, 695.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:56:36', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(398, 'Bacardi White', 'Bacardi White', 8, 9, 'Bacardi White', 'Bacardi White', 45, NULL, 1, 1293, 1294, 275.00, 0.00, 275.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:56:25', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(399, 'Bacardi White', 'Bacardi White', 7, 10, 'Bacardi White', 'Bacardi White', 45, NULL, 1, 1293, 1294, 275.00, 0.00, 275.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:56:12', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(400, 'Jack Daniels', 'Jack Daniels', 8, 9, 'Jack Daniels', 'Jack Daniels', 44, NULL, 1, 1295, 1296, 695.00, 0.00, 695.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:55:59', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(401, 'Jack Daniels', 'Jack Daniels', 7, 10, 'Jack Daniels', 'Jack Daniels', 44, NULL, 1, 1295, 1296, 695.00, 0.00, 695.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:00:01', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(402, 'Glenlivet 12 Years', 'Glenlivet 12 Years', 8, 9, 'Glenlivet 12 Years', 'Glenlivet 12 Years', 44, NULL, 1, 1297, 1298, 845.00, 0.00, 845.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:59:51', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(403, 'Glenlivet 12 Years', 'Glenlivet 12 Years', 7, 10, 'Glenlivet 12 Years', 'Glenlivet 12 Years', 44, NULL, 1, 1297, 1298, 845.00, 0.00, 845.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:59:40', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(404, 'Smirnoff', 'Smirnoff', 8, 9, 'Smirnoff', 'Smirnoff', 46, NULL, 1, 1300, 1302, 275.00, 0.00, 275.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:59:29', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(405, 'Smirnoff', 'Smirnoff', 7, 10, 'Smirnoff', 'Smirnoff', 46, NULL, 1, 1300, 1302, 275.00, 0.00, 275.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:59:11', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(406, 'Beefeater', 'Beefeater', 8, 9, 'Beefeater', 'Beefeater', 47, NULL, 1, 1301, 1303, 465.00, 0.00, 465.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:58:59', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(407, 'Beefeater', 'Beefeater', 7, 10, 'Beefeater', 'Beefeater', 47, NULL, 1, 1301, 1303, 465.00, 0.00, 465.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:58:48', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(408, 'Bombay Sapphire', 'Bombay Sapphire', 8, 9, 'Bombay Sapphire', 'Bombay Sapphire', 47, NULL, 1, 1304, 1305, 525.00, 0.00, 525.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:58:40', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(409, 'Bombay Sapphire', 'Bombay Sapphire', 7, 10, 'Bombay Sapphire', 'Bombay Sapphire', 47, NULL, 1, 1304, 1305, 525.00, 0.00, 525.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 10:58:29', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(410, 'Camino silver', 'Camino silver', 8, 9, 'Camino silver', 'Camino silver', 48, NULL, 1, 1306, 1307, 595.00, 0.00, 595.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:01:09', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(411, 'Camino silver', 'Camino silver', 7, 10, 'Camino silver', 'Camino silver', 48, NULL, 1, 1306, 1307, 595.00, 0.00, 595.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:01:03', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(412, 'Absolut', 'Absolut', 8, 9, 'Absolut', 'Absolut', 46, NULL, 1, 1308, 1310, 445.00, 0.00, 445.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:01:39', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(413, 'Absolut', 'Absolut', 7, 10, 'Absolut', 'Absolut', 46, NULL, 1, 1308, 1310, 445.00, 0.00, 445.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:01:30', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(414, 'Jägermeister', 'Jägermeister', 8, 9, 'Jägermeister', 'Jägermeister', 48, NULL, 1, 1309, 1311, 645.00, 0.00, 645.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:02:15', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(415, 'Jägermeister', 'Jägermeister', 7, 10, 'Jägermeister', 'Jägermeister', 48, NULL, 1, 1309, 1311, 645.00, 0.00, 645.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:01:54', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(416, 'Grey Goose', 'Grey Goose', 8, 9, 'Grey Goose', 'Grey Goose', 46, NULL, 1, 1312, 1313, 645.00, 0.00, 645.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:04:29', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(417, 'Grey Goose', 'Grey Goose', 7, 10, 'Grey Goose', 'Grey Goose', 46, NULL, 1, 1312, 1313, 645.00, 0.00, 645.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:04:17', '', '', 'Admin', '1', 1, 12, 41, 1, 0, 0, 0),
(418, 'Breezer', 'Breezer', 8, 9, 'Breezer', 'Breezer', 49, NULL, 1, 1314, 1315, 295.00, 0.00, 295.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:05:05', '', '', 'Admin', '1', 1, 13, 44, 1, 0, 0, 0),
(419, 'Breezer', 'Breezer', 7, 10, 'Breezer', 'Breezer', 49, NULL, 1, 1314, 1315, 295.00, 0.00, 295.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:04:55', '', '', 'Admin', '1', 1, 13, 44, 1, 0, 0, 0),
(420, 'Cosmopolitan', 'Cosmopolitan', 8, 9, 'Cosmopolitan', 'Cosmopolitan', 54, NULL, 1, 1316, 1317, 345.00, 0.00, 345.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:05:47', '', '', 'Admin', '1', 1, 15, 48, 1, 0, 0, 0),
(421, 'Cosmopolitan', 'Cosmopolitan', 7, 10, 'Cosmopolitan', 'Cosmopolitan', 54, NULL, 1, 1316, 1317, 345.00, 0.00, 345.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:05:27', '', '', 'Admin', '1', 1, 15, 48, 1, 0, 0, 0),
(422, 'Mojito', 'Mojito', 8, 9, 'Mojito', 'Mojito', 54, NULL, 1, 1318, 1319, 345.00, 0.00, 345.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:06:18', '', '', 'Admin', '1', 1, 15, 48, 1, 0, 0, 0),
(423, 'Mojito', 'Mojito', 7, 10, 'Mojito', 'Mojito', 54, NULL, 1, 1318, 1319, 345.00, 0.00, 345.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:06:07', '', '', 'Admin', '1', 1, 15, 48, 1, 0, 0, 0),
(424, 'Classic Margarita', 'Classic Margarita', 8, 9, 'Classic Margarita', 'Classic Margarita', 54, NULL, 1, 1320, 1321, 375.00, 0.00, 375.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:06:53', '', '', 'Admin', '1', 1, 15, 48, 1, 0, 0, 0),
(425, 'Classic Margarita', 'Classic Margarita', 7, 10, 'Classic Margarita', 'Classic Margarita', 54, NULL, 1, 1320, 1321, 375.00, 0.00, 375.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:06:42', '', '', 'Admin', '1', 1, 15, 48, 1, 0, 0, 0),
(426, 'Bird Cage', 'Bird Cage', 8, 9, 'Bird Cage', 'Bird Cage', 53, NULL, 1, 1322, 1323, 425.00, 0.00, 425.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:07:19', '', '', 'Admin', '1', 1, 14, 46, 1, 0, 0, 0),
(427, 'Bird Cage', 'Bird Cage', 7, 10, 'Bird Cage', 'Bird Cage', 53, NULL, 1, 1322, 1323, 425.00, 0.00, 425.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:07:10', '', '', 'Admin', '1', 1, 14, 46, 1, 0, 0, 0),
(428, 'LIIT', 'LIIT', 8, 9, 'LIIT', 'LIIT', 54, NULL, 1, 1325, 1324, 445.00, 0.00, 445.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:07:45', '', '', 'Admin', '1', 1, 15, 48, 1, 0, 0, 0),
(429, 'LIIT', 'LIIT', 7, 10, 'LIIT', 'LIIT', 54, NULL, 1, 1325, 1324, 445.00, 0.00, 445.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:07:35', '', '', 'Admin', '1', 1, 15, 48, 1, 0, 0, 0),
(430, 'Jager Bomb', 'Jager Bomb', 8, 9, 'Jager Bomb', 'Jager Bomb', 54, NULL, 1, 1326, 1327, 495.00, 0.00, 495.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:03:11', '', '', 'Admin', '1', 1, 15, 48, 1, 0, 0, 0),
(431, 'Jager Bomb', 'Jager Bomb', 7, 10, 'Jager Bomb', 'Jager Bomb', 54, NULL, 1, 1326, 1327, 495.00, 0.00, 495.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:03:23', '', '', 'Admin', '1', 1, 15, 48, 1, 0, 0, 0),
(436, 'Grover Zampa', 'Grover Zampa', 8, 9, 'Grover Zampa', 'Grover Zampa', 50, NULL, 1, 1330, 1331, 0.00, 0.00, 0.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:08:14', '', '', 'Admin', '1', 1, 16, 50, 1, 0, 0, 0),
(437, 'Grover Zampa', 'Grover Zampa', 7, 10, 'Grover Zampa', 'Grover Zampa', 50, NULL, 1, 1330, 1331, 0.00, 0.00, 0.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:08:03', '', '', 'Admin', '1', 1, 16, 50, 1, 0, 0, 0),
(438, 'Jacob\'s Creek', 'Jacob\'s Creek', 8, 9, 'Jacob\'s Creek', 'Jacob\'s Creek', 50, NULL, 1, 1333, 1334, 795.00, 0.00, 795.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:08:38', '', '', 'Admin', '1', 1, 16, 50, 1, 0, 0, 0),
(439, 'Jacob\'s Creek', 'Jacob\'s Creek', 7, 10, 'Jacob\'s Creek', 'Jacob\'s Creek', 50, NULL, 1, 1333, 1334, 795.00, 0.00, 795.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:08:32', '', '', 'Admin', '1', 1, 16, 50, 1, 0, 0, 0),
(442, 'The Cure', 'The Cure', 8, 9, 'The Cure', 'The Cure', 53, NULL, 1, 1344, 1343, 425.00, 0.00, 425.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:09:02', '', '', 'Admin', '1', 1, 14, 46, 1, 0, 0, 0),
(443, 'The Cure', 'The Cure', 7, 10, 'The Cure', 'The Cure', 53, NULL, 1, 1344, 1343, 425.00, 0.00, 425.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:08:51', '', '', 'Admin', '1', 1, 14, 46, 1, 0, 0, 0),
(486, 'Farm Delight Pizza', 'Farm Delight Pizza', 2, 7, 'Tomato Sauce + Mushroom + Onion + Bell Peppers + Mozerella Cheese + Orange Cheddar + Herbs', 'Tomato Sauce + Mushroom + Onion + Bell Peppers + Mozerella Cheese + Orange Cheddar + Herbs', 37, NULL, 2, 1398, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 10:37:03', '', '', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(489, 'Smoked Chicken, Mozerella Bianca Pizza', 'Smoked Chicken, Mozerella Bianca Pizza', 2, 7, 'Smoked Chicken + Mozerella + Tomato + Herbs', 'Smoked Chicken + Mozerella + Tomato + Herbs', 21, NULL, 2, 1399, NULL, 445.00, 5.00, 467.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 10:39:22', '', '', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(498, 'TANDOORI PANEER PIZZA', 'TANDOORI PANEER PIZZA', 2, 7, 'COTTAGE CHEESE, MIXED PEPPERS, ONION, CORIANDER, AND MAKHANI SAUCE', 'COTTAGE CHEESE, MIXED PEPPERS, ONION, CORIANDER, AND MAKHANI SAUCE', 37, NULL, 2, 1406, NULL, 445.00, 5.00, 467.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 10:37:42', '', '', 'Admin', '1', 0, 0, 0, NULL, 0, 0, 0),
(507, 'DELHI 6 FAMOUS CHICKEN CURRY', 'DELHI 6 FAMOUS CHICKEN CURRY', 2, 7, 'Old Delhi Style Chicken Curry + Minty Yogurt Sauce + Onion Salad', 'Old Delhi Style Chicken Curry + Minty Yogurt Sauce + Onion Salad', 22, NULL, 2, 1408, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 10:40:30', '', '', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(510, 'SPICY TAWA MASALA CHICKEN', 'SPICY TAWA MASALA CHICKEN', 2, 7, 'Chicken Cooked In Tawa Masala Gravy', 'Chicken Cooked In Tawa Masala Gravy', 22, NULL, 2, 1409, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 10:40:54', '', '', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(516, 'VEGETABLE DUM BIRYANI', 'VEGETABLE DUM BIRYANI', 2, 7, 'Served With Mirch Baingan Ka Salan And Mix Veg Raita', 'Served With Mirch Baingan Ka Salan And Mix Veg Raita', 34, NULL, 2, 1411, NULL, 375.00, 5.00, 393.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 10:44:38', '', '', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(519, 'MURG DUM BIRYANI', 'MURG DUM BIRYANI', 2, 7, 'With Bone Chicken Cooked With Long Grain Fragrant Rice & Aromatic Spices In A Dum Pot Served With Mirch Baingan Ka Salan & Mix Veg Raita.', 'With Bone Chicken Cooked With Long Grain Fragrant Rice & Aromatic Spices In A Dum Pot Served With Mirch Baingan Ka Salan & Mix Veg Raita.', 34, NULL, 2, 1412, NULL, 425.00, 5.00, 446.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 10:44:54', '', '', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(522, 'EUROPEAN VALUE MEAL', 'EUROPEAN VALUE MEAL', 2, 7, '1 SMALL FARM DELIGHT PIZZA', '1 SMALL FARM DELIGHT PIZZA', 56, NULL, 2, 1414, NULL, 295.00, 5.00, 309.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 04:51:46', '', '', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(525, 'ASIAN VALUE MEAL', 'ASIAN VALUE MEAL', 2, 7, 'Red/Green Thai Curry Bowl With Steamed Rice', 'Red/Green Thai Curry Bowl With Steamed Rice', 56, NULL, 2, 1618, NULL, 295.00, 5.00, 309.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-26 11:21:28', '', '', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(528, 'INDIAN VALUE MEAL', 'INDIAN VALUE MEAL', 2, 7, 'VEG BIRYANI', 'VEG BIRYANI', 56, NULL, 2, 1616, NULL, 275.00, 5.00, 288.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-26 11:18:46', '', '', 'Admin', '1', 0, 0, 0, NULL, 0, 0, 0),
(534, 'Indian Value Meal', 'Indian Value Meal', 2, 7, 'Paneer Sirka Pyaaz + 4 Butter Roti', 'Paneer Sirka Pyaaz + 4 Butter Roti', 56, NULL, 2, 1418, NULL, 245.00, 5.00, 257.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-26 11:16:00', '', '', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(537, 'Indian Value Meal', 'Indian Value Meal', 2, 7, 'BUTTER CHICKEN + 4 BUTTER ROTI', 'BUTTER CHICKEN + 4 BUTTER ROTI', 56, NULL, 2, 1419, NULL, 295.00, 5.00, 309.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-26 11:15:09', '', '', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(541, 'Kingfisher Strong', 'Kingfisher Strong', 8, 9, 'Kingfisher Strong', 'Kingfisher Strong', 6, NULL, 1, 1237, 1238, 295.00, 0.00, 295.00, '', '', NULL, NULL, NULL, NULL, NULL, 0, '2023-09-18 11:12:03', '', '', 'Admin', '1', 1, 10, 34, 1, 0, 0, 0),
(557, 'EGG TAIWANESE FRIED RICE', 'EGG TAIWANESE FRIED RICE', 2, 7, 'Wok Tossed Rice + Onion + Scallion + Peas + Sesame Oil', 'Wok Tossed Rice + Onion + Scallion + Peas + Sesame Oil', 22, NULL, 2, 1426, NULL, 325.00, 5.00, 341.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-26 11:11:58', '', '', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(560, 'TOFU TAIWANESE FRIED RICE', 'TOFU TAIWANESE FRIED RICE', 2, 7, 'Wok Tossed Rice + Onion + Scallion + Peas + Sesame Oil', 'Wok Tossed Rice + Onion + Scallion + Peas + Sesame Oil', 22, NULL, 2, 1427, NULL, 355.00, 5.00, 372.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 04:54:23', '', '', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(563, 'CHICKEN TAIWANESE FRIED RICE', 'CHICKEN TAIWANESE FRIED RICE', 2, 7, 'Wok Tossed Rice + Onion + Scallion + Peas + Sesame Oil', 'Wok Tossed Rice + Onion + Scallion + Peas + Sesame Oil', 22, NULL, 2, 1428, NULL, 355.00, 5.00, 372.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-26 11:11:01', '', '', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(575, 'EUROPEAN FAMILY COMBO', 'EUROPEAN FAMILY COMBO', 2, 7, '2 Veg Pizza + 2 Soft Beverage', '2 Veg Pizza + 2 Soft Beverage', 58, NULL, 2, 1432, NULL, 675.00, 5.00, 708.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 04:51:13', '', '', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(578, 'EUROPEAN FAMILY COMBO', 'EUROPEAN FAMILY COMBO', 2, 7, '2 Chicken Pizza + 2 Soft Beverage', '2 Chicken Pizza + 2 Soft Beverage', 58, NULL, 2, 1433, NULL, 725.00, 5.00, 761.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 04:50:28', '', '', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(581, 'ASIAN FAMILY COMBO', 'ASIAN FAMILY COMBO', 2, 7, '1 Veg Red/Green Thai Curry Bowl With Steamed Rice + 1 Thai Chilli Noodle Chicken + 1 Soft Beverage', '1 Veg Red/Green Thai Curry Bowl With Steamed Rice + 1 Thai Chilli Noodle Chicken + 1 Soft Beverage', 58, NULL, 2, 1615, NULL, 545.00, 5.00, 572.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 04:56:52', '', '', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(584, 'ASIAN FAMILY COMBO', 'ASIAN FAMILY COMBO', 2, 7, '1 Chicken Red/Green Thai Curry Bowl With Steamed Rice + 1 Thai Chilli Noodle Chicken + 1 Soft Beverage', '1 Chicken Red/Green Thai Curry Bowl With Steamed Rice + 1 Thai Chilli Noodle Chicken + 1 Soft Beverage', 58, NULL, 2, 1614, NULL, 575.00, 5.00, 603.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 04:57:21', '', '', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(587, 'INDIAN FAMILY COMBO', 'INDIAN FAMILY COMBO', 2, 7, '1 Hyderabadi Vegetable Dum Biryani + 1 Paneer Sirka Pyaaz  + 6 Butter Roti', '1 Hyderabadi Vegetable Dum Biryani + 1 Paneer Sirka Pyaaz  + 6 Butter Roti', 58, NULL, 2, 1436, NULL, 675.00, 5.00, 708.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-26 10:58:25', '', '', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(590, 'INDIAN FAMILY COMBO', 'INDIAN FAMILY COMBO', 2, 7, '1 HYDERABADI MURG DUM BIRYANI + 1 BOMBASTIC BUTTER CHICKEN + 6 BUTTER ROTI', '1 HYDERABADI MURG DUM BIRYANI + 1 BOMBASTIC BUTTER CHICKEN + 6 BUTTER ROTI', 58, NULL, 2, 1437, NULL, 725.00, 5.00, 761.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-26 10:58:38', '', '', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(608, 'TANDOORI POTATO TIKKA', 'TANDOORI POTATO TIKKA', 12, 4, 'POTATO + TANDOORI SPICES + CURD + TANDOOR + MAST + DIFFERENT', 'POTATO + TANDOORI SPICES + CURD + TANDOOR + MAST + DIFFERENT', 60, NULL, 2, 1520, NULL, 295.00, 5.00, 309.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 10:31:03', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(609, 'HUMMUS & PITA BREAD', 'HUMMUS & PITA BREAD', 12, 4, 'BREAD + PICKLED VEGGIES + PERI-PERI HUMMUS + CLASSIC HUMMUS', 'BREAD + PICKLED VEGGIES + PERI-PERI HUMMUS + CLASSIC HUMMUS', 60, NULL, 2, 1521, NULL, 295.00, 5.00, 309.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 10:37:26', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(610, 'KURKURE PALAK PATTA CHAAT', 'KURKURE PALAK PATTA CHAAT', 12, 4, 'CRISPY PALAK PATTA + SONTH + MINT + DHANIYA + SEV + NAMKEEN', 'CRISPY PALAK PATTA + SONTH + MINT + DHANIYA + SEV + NAMKEEN', 60, NULL, 2, 1522, NULL, 295.00, 5.00, 309.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 10:39:48', 'Admin', '1', '', '', 0, 0, 0, NULL, 0, 0, 0),
(611, 'SZECHUAN VEGETABLE DIMSUM STEAMED', 'SZECHUAN VEGETABLE DIMSUM STEAMED', 12, 4, 'SZECHUAN VEGETABLE DIMSUM STEAMED', 'SZECHUAN VEGETABLE DIMSUM STEAMED', 60, NULL, 2, 1523, NULL, 295.00, 5.00, 309.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 10:42:12', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(612, 'CRISPY LOTUS STEM HONEY CHILLI', 'CRISPY LOTUS STEM HONEY CHILLI', 12, 4, 'KAMAL KAKDI + HONEY + CHILLI + CRISPY', 'KAMAL KAKDI + HONEY + CHILLI + CRISPY', 60, NULL, 2, 1524, NULL, 325.00, 5.00, 341.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 10:45:40', 'Admin', '1', '', '', 0, 0, 0, NULL, 0, 0, 0),
(613, 'CHILLY CHEESE CIGAR ROLLS', 'CHILLY CHEESE CIGAR ROLLS', 12, 4, 'HERB + TOSSED + VEGGIES + SPICED CREAM CHEESE', 'HERB + TOSSED + VEGGIES + SPICED CREAM CHEESE', 60, NULL, 2, 1525, NULL, 345.00, 5.00, 362.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 10:47:03', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(614, 'LOADED NACHOS', 'LOADED NACHOS', 12, 4, 'NACHO CHIPS + TOMATO SALSA + SOUR CREAM + REFRIED BEANS + IN HOUSE THREE CHEESE SAUCE', 'NACHO CHIPS + TOMATO SALSA + SOUR CREAM + REFRIED BEANS + IN HOUSE THREE CHEESE SAUCE', 60, NULL, 2, 1526, NULL, 375.00, 5.00, 393.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 10:48:09', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(615, 'HONG KONG CHILLI PANEER', 'HONG KONG CHILLI PANEER', 12, 4, 'PANEER + SWEET + SPICY + SOYA', 'PANEER + SWEET + SPICY + SOYA', 60, NULL, 2, 1527, NULL, 375.00, 5.00, 393.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 10:49:10', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(616, 'TEEKHA PANEER TIKKA  6PCS.', 'TEEKHA PANEER TIKKA  6PCS.', 12, 4, 'COTTAGE CHEESE + CURD + SPICY RED CHILLI + SPICES + GINGER + GARLIC', 'COTTAGE CHEESE + CURD + SPICY RED CHILLI + SPICES + GINGER + GARLIC', 60, NULL, 2, 1528, NULL, 245.00, 5.00, 257.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 10:50:43', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(617, 'TEEKHA PANEER TIKKA  12PCS.', 'TEEKHA PANEER TIKKA  12PCS.', 12, 4, 'COTTAGE CHEESE + CURD + SPICY RED CHILLI + SPICES + GINGER + GARLIC', 'COTTAGE CHEESE + CURD + SPICY RED CHILLI + SPICES + GINGER + GARLIC', 60, NULL, 2, 1529, NULL, 425.00, 5.00, 446.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 10:52:07', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(618, 'JUNGLI PANEER TIKKA  6PCS.', 'JUNGLI PANEER TIKKA  6PCS.', 12, 4, 'RUSTIC + SPICY + PANEER + TIKKA DONE BY GIVING A TWIST TO A TRIBAL RECIPE', 'RUSTIC + SPICY + PANEER + TIKKA DONE BY GIVING A TWIST TO A TRIBAL RECIPE', 60, NULL, 2, 1530, NULL, 245.00, 5.00, 257.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 10:53:34', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(619, 'JUNGLI PANEER TIKKA  12PCS.', 'JUNGLI PANEER TIKKA  12PCS.', 12, 4, 'RUSTIC + SPICY + PANEER + TIKKA DONE BY GIVING A TWIST TO A TRIBAL RECIPE', 'RUSTIC + SPICY + PANEER + TIKKA DONE BY GIVING A TWIST TO A TRIBAL RECIPE', 60, NULL, 2, 1531, NULL, 425.00, 5.00, 446.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 10:54:27', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(620, 'CHICKEN KOLI WADA', 'CHICKEN KOLI WADA', 12, 4, 'CHICKEN SLIVERS + CHAWAL KA ATTA + MIRCHI + CURRY PATTA + SARSON', 'CHICKEN SLIVERS + CHAWAL KA ATTA + MIRCHI + CURRY PATTA + SARSON', 60, NULL, 2, 1532, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 10:56:40', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(621, 'KALI MIRCH THREE CHEESE CHICKEN TIKKA', 'KALI MIRCH THREE CHEESE CHICKEN TIKKA', 12, 4, 'CHEESE + CREAM + CHICKEN + FRESHLY GROUND BLACK PEPPER + GARLIC', 'CHEESE + CREAM + CHICKEN + FRESHLY GROUND BLACK PEPPER + GARLIC', 60, NULL, 2, 1533, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 10:57:58', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(622, 'CHILLI TERIYAKI CHICKEN', 'CHILLI TERIYAKI CHICKEN', 12, 4, 'CHICKEN + ASIAN GREENS + SPICY TERIYAKI SAUCE + JAPANESE STYLE', 'CHICKEN + ASIAN GREENS + SPICY TERIYAKI SAUCE + JAPANESE STYLE', 60, NULL, 2, 1534, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:00:21', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(623, 'CHILLI GARLIC CHICKEN DIMSUM FRIED IN WASABI SAUCE', 'CHILLI GARLIC CHICKEN DIMSUM FRIED IN WASABI SAUCE', 12, 4, 'CHICKEN DIMSUM CRUMBED FRIED AND TOSSED IN WASABI CHEESE SAUCE IT’S YUMMY', 'CHICKEN DIMSUM CRUMBED FRIED AND TOSSED IN WASABI CHEESE SAUCE IT’S YUMMY', 60, NULL, 2, 1535, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:01:44', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(624, 'CHICKEN WINGS 65  6PCS.', 'CHICKEN WINGS 65  6PCS.', 12, 4, 'FRIED SKIN-ON CHICKEN WINGS + CHILLI + CURRY LEAVES + SPICES', 'FRIED SKIN-ON CHICKEN WINGS + CHILLI + CURRY LEAVES + SPICES', 60, NULL, 2, 1536, NULL, 245.00, 5.00, 257.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:03:04', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(625, 'CHICKEN WINGS 65   12PCS.', 'CHICKEN WINGS 65   12PCS.', 12, 4, 'FRIED SKIN-ON CHICKEN WINGS + CHILLI + CURRY LEAVES + SPICES', 'FRIED SKIN-ON CHICKEN WINGS + CHILLI + CURRY LEAVES + SPICES', 60, NULL, 2, 1537, NULL, 425.00, 5.00, 446.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:04:29', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(626, 'OLD MONK CHICKEN WINGS  6PCS.', 'OLD MONK CHICKEN WINGS  6PCS.', 12, 4, 'CHICKEN WINGS + OLD MONK + BATTER FRIED + SPICY BBQ SAUCE + FLAMBÉED.', 'CHICKEN WINGS + OLD MONK + BATTER FRIED + SPICY BBQ SAUCE + FLAMBÉED.', 60, NULL, 2, 1538, NULL, 245.00, 5.00, 257.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:05:32', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(627, 'OLD MONK CHICKEN WINGS   12PCS.', 'OLD MONK CHICKEN WINGS   12PCS.', 12, 4, 'CHICKEN WINGS + OLD MONK + BATTER FRIED + SPICY BBQ SAUCE + FLAMBÉED.', 'CHICKEN WINGS + OLD MONK + BATTER FRIED + SPICY BBQ SAUCE + FLAMBÉED.', 60, NULL, 2, 1539, NULL, 425.00, 5.00, 446.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:06:51', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(628, 'CHICKEN TIKKA OUR WAY', 'CHICKEN TIKKA OUR WAY', 12, 4, 'MARINATED CHICKEN + SPICY PERI-PERI CHILLI + CILANTRO PESTO + CLAY OVEN + YOGHURT DIP + MASALA ONION', 'MARINATED CHICKEN + SPICY PERI-PERI CHILLI + CILANTRO PESTO + CLAY OVEN + YOGHURT DIP + MASALA ONION', 60, NULL, 2, 1540, NULL, 425.00, 5.00, 446.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:08:18', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(629, 'OUR SIGNATURE SPICY ROCK CHICKEN FINGERS', 'OUR SIGNATURE SPICY ROCK CHICKEN FINGERS', 12, 4, 'SPICY MARINATED CRISPY FRIED CHICKEN + OUR SIGNATURE DIP', 'SPICY MARINATED CRISPY FRIED CHICKEN + OUR SIGNATURE DIP', 60, NULL, 2, 1541, NULL, 425.00, 5.00, 446.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:09:40', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(630, 'AMRITSARI FISH TIKKA', 'AMRITSARI FISH TIKKA', 12, 4, 'INDIAN BASA FISH TIKKA + SPICES, HUNG CURD & MUSTARD OIL MARINATED + CLAY OVEN + MASALA ONION + MINT CHUTNEY', 'INDIAN BASA FISH TIKKA + SPICES, HUNG CURD & MUSTARD OIL MARINATED + CLAY OVEN + MASALA ONION + MINT CHUTNEY', 60, NULL, 2, 1542, NULL, 525.00, 5.00, 551.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:12:05', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(631, 'FARM DELIGHT', 'FARM DELIGHT', 12, 4, 'TOMATOES + MUSHROOM + ONION + CAPSICUM + CHEESE', 'TOMATOES + MUSHROOM + ONION + CAPSICUM + CHEESE', 61, NULL, 2, 1543, NULL, 345.00, 5.00, 362.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:18:05', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(632, 'HAWAIIAN PIZZA', 'HAWAIIAN PIZZA', 12, 4, 'SMOKED SPICY PINEAPPLE + SMOKED BBQ SAUCE + ONION', 'SMOKED SPICY PINEAPPLE + SMOKED BBQ SAUCE + ONION', 61, NULL, 2, 1544, NULL, 345.00, 5.00, 362.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:19:53', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(633, 'TANDOORI PANEER PIZZA', 'TANDOORI PANEER PIZZA', 12, 4, 'COTTAGE CHEESE, MIXED PEPPERS, ONION, CORIANDER AND MAKHANI SAUCE', 'COTTAGE CHEESE, MIXED PEPPERS, ONION, CORIANDER AND MAKHANI SAUCE', 61, NULL, 2, 1545, NULL, 345.00, 5.00, 362.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:21:04', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(634, 'SMOKED CHICKEN, MOZZARELLA BIANCA', 'SMOKED CHICKEN, MOZZARELLA BIANCA', 12, 4, 'SMOKED CHICKEN + MOZZARELLA + TOMATO + HERBS', 'SMOKED CHICKEN + MOZZARELLA + TOMATO + HERBS', 61, NULL, 2, 1546, NULL, 375.00, 5.00, 393.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:25:42', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(635, 'GRILLED CHICKEN & PESTO PIZZA', 'GRILLED CHICKEN & PESTO PIZZA', 12, 4, 'GRILLED CHICKEN + BASIL PESTO + PEPPERS + CHEESE', 'GRILLED CHICKEN + BASIL PESTO + PEPPERS + CHEESE', 61, NULL, 2, 1547, NULL, 375.00, 5.00, 393.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:27:02', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(636, 'PANEER SIRKA PYAAZ', 'PANEER SIRKA PYAAZ', 12, 4, 'PANEER TIKKA + SWEET & SOUR TOMATO MASALA + SIRKA PYAAZ', 'PANEER TIKKA + SWEET & SOUR TOMATO MASALA + SIRKA PYAAZ', 62, NULL, 2, 1548, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:28:35', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(637, 'LAHSUNIYA PALAK PANEER', 'LAHSUNIYA PALAK PANEER', 12, 4, 'GARLIC + SPINACH + ONION + SPICES', 'GARLIC + SPINACH + ONION + SPICES', 62, NULL, 2, 1549, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:33:14', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(638, 'SPICY TAWA MASALA CHICKEN', 'SPICY TAWA MASALA CHICKEN', 12, 4, 'CHICKEN TIKKA + TAWA MASALA GRAVY', 'CHICKEN TIKKA + TAWA MASALA GRAVY', 62, NULL, 2, 1550, NULL, 425.00, 5.00, 446.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:34:47', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(639, 'CHICKEN GHEE ROAST', 'CHICKEN GHEE ROAST', 12, 4, 'CHICKEN + SLOW ROAST + BYADGI MIRCHI + LOTS OF GHEE', 'CHICKEN + SLOW ROAST + BYADGI MIRCHI + LOTS OF GHEE', 62, NULL, 2, 1551, NULL, 425.00, 5.00, 446.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:36:01', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(640, 'DELHI 6 FAMOUS CHICKEN CURRY', 'DELHI 6 FAMOUS CHICKEN CURRY', 12, 4, 'OLD DELHI STYLE CHICKEN CURRY + MINT CHUTNEY + MASALA ONION SALAD', 'OLD DELHI STYLE CHICKEN CURRY + MINT CHUTNEY + MASALA ONION SALAD', 62, NULL, 2, 1552, NULL, 425.00, 5.00, 446.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:37:28', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(641, 'GOAN PRAWN CURRY', 'GOAN PRAWN CURRY', 12, 4, 'SPICY GOAN STYLE PRAWN CURRY WITH TOMATO, ONION AND SPICES SERVED WITH STEAMED RICE', 'SPICY GOAN STYLE PRAWN CURRY WITH TOMATO, ONION AND SPICES SERVED WITH STEAMED RICE', 62, NULL, 2, 1553, NULL, 645.00, 5.00, 677.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:38:32', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(642, 'RED GREEN THAI CURRY BOWL  VEG', 'RED GREEN THAI CURRY BOWL  VEG', 12, 4, 'THAI SPICES + COCONUT MILK + KAFFIR LIME + GALANGAL + CHERRY TOMATO + STEAMED RICE', 'THAI SPICES + COCONUT MILK + KAFFIR LIME + GALANGAL + CHERRY TOMATO + STEAMED RICE', 63, NULL, 2, 1554, NULL, 325.00, 5.00, 341.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:44:19', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(643, 'RED GREEN THAI CURRY BOWL  CHICKEN', 'RED GREEN THAI CURRY BOWL  CHICKEN', 12, 4, 'THAI SPICES + COCONUT MILK + KAFFIR LIME + GALANGAL + CHERRY TOMATO + STEAMED RICE', 'THAI SPICES + COCONUT MILK + KAFFIR LIME + GALANGAL + CHERRY TOMATO + STEAMED RICE', 63, NULL, 2, 1555, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:45:53', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(644, 'RED GREEN THAI CURRY BOWL  SHRIMP', 'RED GREEN THAI CURRY BOWL  SHRIMP', 12, 4, 'THAI SPICES + COCONUT MILK + KAFFIR LIME + GALANGAL + CHERRY TOMATO + STEAMED RICE', 'THAI SPICES + COCONUT MILK + KAFFIR LIME + GALANGAL + CHERRY TOMATO + STEAMED RICE', 63, NULL, 2, 1556, NULL, 425.00, 5.00, 446.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:46:46', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(645, 'THAI BASIL TOFU', 'THAI BASIL TOFU', 12, 4, 'THAI HERBS + CHILLI + SOYA + STEAM RICE', 'THAI HERBS + CHILLI + SOYA + STEAM RICE', 63, NULL, 2, 1557, NULL, 325.00, 5.00, 341.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:48:11', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(646, 'THAI BASIL CHICKEN', 'THAI BASIL CHICKEN', 12, 4, 'THAI HERBS + CHILLI + SOYA + STEAM RICE', 'THAI HERBS + CHILLI + SOYA + STEAM RICE', 63, NULL, 2, 1558, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:50:08', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(647, 'PANEER IN SMOKED CHILLI SAUCE', 'PANEER IN SMOKED CHILLI SAUCE', 12, 4, 'PEPPERS + ONION + SCALLION + SMOKED CHILLI SAUCE+STEAMED RICE', 'PEPPERS + ONION + SCALLION + SMOKED CHILLI SAUCE+STEAMED RICE', 63, NULL, 2, 1559, NULL, 325.00, 5.00, 341.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:51:31', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(648, 'CHICKEN IN SMOKED CHILLI SAUCE', 'CHICKEN IN SMOKED CHILLI SAUCE', 12, 4, 'PEPPERS + ONION + SCALLION + SMOKED CHILLI SAUCE+STEAMED RICE', 'PEPPERS + ONION + SCALLION + SMOKED CHILLI SAUCE+STEAMED RICE', 63, NULL, 2, 1560, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:53:15', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(649, 'VEGETABLE DUM BIRYANI', 'VEGETABLE DUM BIRYANI', 12, 4, 'VEGETABLES + FRAGRANT BASMATI RICE + DUM + BURHANI RAITA + MIRCH KA SALAN', 'VEGETABLES + FRAGRANT BASMATI RICE + DUM + BURHANI RAITA + MIRCH KA SALAN', 64, NULL, 2, 1561, NULL, 375.00, 5.00, 393.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:54:38', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(650, 'MURG BIRYANI', 'MURG BIRYANI', 12, 4, 'CHICKEN WITH BONE + LONG GRAIN FRAGRANT RICE + AROMATIC SPICES + DUM IN POT + MIRCH KA SALAN + BURHANI RAITA.', 'CHICKEN WITH BONE + LONG GRAIN FRAGRANT RICE + AROMATIC SPICES + DUM IN POT + MIRCH KA SALAN + BURHANI RAITA.', 64, NULL, 2, 1562, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:56:49', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(651, 'PENNE ALFREDO VEG', 'PENNE ALFREDO VEG', 12, 4, 'PENNE PASTA + BÉCHAMEL + PARMESAN CHEESE', 'PENNE PASTA + BÉCHAMEL + PARMESAN CHEESE', 65, NULL, 2, 1563, NULL, 325.00, 5.00, 341.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:59:01', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(652, 'PENNE ALFREDO CHICKEN', 'PENNE ALFREDO CHICKEN', 12, 4, 'PENNE PASTA + BÉCHAMEL + PARMESAN CHEESE', 'PENNE PASTA + BÉCHAMEL + PARMESAN CHEESE', 65, NULL, 2, 1564, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 11:59:57', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(653, 'GRILLED CHICKEN BREAST WITH MIX MUSHROOM SAUCE', 'GRILLED CHICKEN BREAST WITH MIX MUSHROOM SAUCE', 12, 4, 'GRILLED CHICKEN BREAST + ROSEMARY POTATO + SAUTÉED VEGETABLES + MUSHROOM SAUCE', 'GRILLED CHICKEN BREAST + ROSEMARY POTATO + SAUTÉED VEGETABLES + MUSHROOM SAUCE', 65, NULL, 2, 1565, NULL, 525.00, 5.00, 551.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 12:01:15', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(654, 'STEAM RICE', 'STEAM RICE', 12, 4, 'STEAM RICE', 'STEAM RICE', 57, NULL, 2, 1566, NULL, 195.00, 5.00, 204.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 12:03:15', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0);
INSERT INTO `products` (`id`, `title`, `sub_title`, `location`, `place`, `short_description`, `description`, `category`, `sub_category`, `type`, `file_id`, `badge_file`, `price`, `tax`, `total_price`, `hops`, `malt`, `quantity`, `percentage`, `color`, `orignal_gravity`, `style`, `status`, `updated_at`, `add_by`, `add_by_id`, `updated_by`, `updated_by_id`, `is_product_attr`, `attribute_id`, `option_id`, `stock`, `is_home`, `is_veg`, `for_passport`) VALUES
(655, 'ROTI', 'ROTI', 12, 4, 'ROTI', 'ROTI', 66, NULL, 2, 1567, NULL, 75.00, 5.00, 78.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 12:04:18', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(656, 'NAAN', 'NAAN', 12, 4, 'NAAN', 'NAAN', 66, NULL, 2, 1568, NULL, 85.00, 5.00, 89.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 12:04:52', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(657, 'LACCHA PARATHA', 'LACCHA PARATHA', 12, 4, 'LACCHA PARATHA', 'LACCHA PARATHA', 66, NULL, 2, 1569, NULL, 85.00, 5.00, 89.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 12:05:32', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(658, 'HARI MIRCHI KA PARATHA', 'HARI MIRCHI KA PARATHA', 12, 4, 'HARI MIRCHI KA PARATHA', 'HARI MIRCHI KA PARATHA', 66, NULL, 2, 1570, NULL, 85.00, 5.00, 89.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 12:06:01', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(659, 'GARLIC NAAN', 'GARLIC NAAN', 12, 4, 'GARLIC NAAN', 'GARLIC NAAN', 66, NULL, 2, 1571, NULL, 95.00, 5.00, 99.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 12:06:36', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(660, 'CLASSIC CANNOLI WITH MASCARPONE CREAM', 'CLASSIC CANNOLI WITH MASCARPONE CREAM', 12, 4, 'SICILIAN CLASSICAL TUBE SHAPED SHELLS FILLED WITH MASCARPONE CREAM AND CHOCO', 'SICILIAN CLASSICAL TUBE SHAPED SHELLS FILLED WITH MASCARPONE CREAM AND CHOCO', 67, NULL, 2, 1572, NULL, 325.00, 5.00, 341.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 12:08:07', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(661, 'HONEY CHILLI CAULIFLOWER', 'HONEY CHILLI CAULIFLOWER', 12, 4, 'CAULIFLOWER + HONEY + CHILLI + SESAME + CRISPY', 'CAULIFLOWER + HONEY + CHILLI + SESAME + CRISPY', 60, NULL, 2, 1573, NULL, 325.00, 5.00, 341.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 13:08:39', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(662, 'VEGETABLE SALT AND PEPPER', 'VEGETABLE SALT AND PEPPER', 12, 4, 'CRISPY VEGETABLES WOK TOSSED IN SALT, CHILLI AND PEPPER', 'CRISPY VEGETABLES WOK TOSSED IN SALT, CHILLI AND PEPPER', 60, NULL, 2, 1574, NULL, 345.00, 5.00, 362.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 13:09:38', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(663, 'INDO CHINESE CHILLI PANEER', 'INDO CHINESE CHILLI PANEER', 12, 4, 'COTTAGE CHEESE CHUNKS + TOSSED + CHILLI + GINGER + PEPPERS + SPRING ONION + DESI STYLE', 'COTTAGE CHEESE CHUNKS + TOSSED + CHILLI + GINGER + PEPPERS + SPRING ONION + DESI STYLE', 60, NULL, 2, 1575, NULL, 375.00, 5.00, 393.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 13:10:36', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(664, 'CHICKEN POPCORN', 'CHICKEN POPCORN', 12, 4, 'CRISPY ON THE OUTSIDE AND JUICY CHICKEN INSIDE + SPRINKLED WITH A SECRET SPICE BLEND + SPICY MAYONNAISE', 'CRISPY ON THE OUTSIDE AND JUICY CHICKEN INSIDE + SPRINKLED WITH A SECRET SPICE BLEND + SPICY MAYONNAISE', 60, NULL, 2, 1576, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 13:11:32', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(665, 'INDO CHINESE CHILLI CHICKEN', 'INDO CHINESE CHILLI CHICKEN', 12, 4, 'CHICKEN CHUNKS + CHILI + GINGER + PEPPERS + SPRING ONION + DESI STYLE', 'CHICKEN CHUNKS + CHILI + GINGER + PEPPERS + SPRING ONION + DESI STYLE', 60, NULL, 2, 1577, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 13:12:15', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(666, 'CHILLI GARLIC CHICKEN DIMSUM STEAMED', 'CHILLI GARLIC CHICKEN DIMSUM STEAMED', 12, 4, 'CHILLI GARLIC CHICKEN DIMSUM STEAMED', 'CHILLI GARLIC CHICKEN DIMSUM STEAMED', 60, NULL, 2, 1578, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 13:13:33', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(667, 'SHRIMP POPCORN DUSTED WITH GUN POWDER', 'SHRIMP POPCORN DUSTED WITH GUN POWDER', 12, 4, 'SPICY MARINATED CRUMB FRIED SHRIMP + HOUSE MADE GUN POWDER + SPICY DIP + CRISPY SPINACH CHIFFONADE.', 'SPICY MARINATED CRUMB FRIED SHRIMP + HOUSE MADE GUN POWDER + SPICY DIP + CRISPY SPINACH CHIFFONADE.', 60, NULL, 2, 1579, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 13:14:26', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(668, 'AMRITSARI FISH FINGER', 'AMRITSARI FISH FINGER', 12, 4, 'INDIAN BASA FISH + MARINATED WITH CHILLI & SPICES + MUSTARD OIL + FRIED + MINT CHUTNEY', 'INDIAN BASA FISH + MARINATED WITH CHILLI & SPICES + MUSTARD OIL + FRIED + MINT CHUTNEY', 60, NULL, 2, 1580, NULL, 425.00, 5.00, 446.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 13:16:37', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(669, 'HOT CHILLI VEGETABLES', 'HOT CHILLI VEGETABLES', 12, 4, 'CORN + JALAPENO + FETA CHEESE + CHILLI FLAKES + ROASTED VEGETABLES', 'CORN + JALAPENO + FETA CHEESE + CHILLI FLAKES + ROASTED VEGETABLES', 61, NULL, 2, 1581, NULL, 345.00, 5.00, 362.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 13:17:45', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(670, 'CHICKEN TIKKA PIZZA', 'CHICKEN TIKKA PIZZA', 12, 4, 'ONION + GREEN CHILI + CORIANDER + MUSHROOM + CHICKEN TIKKA', 'ONION + GREEN CHILI + CORIANDER + MUSHROOM + CHICKEN TIKKA', 61, NULL, 2, 1582, NULL, 375.00, 5.00, 393.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 13:18:29', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(671, 'DAL MAKHANI', 'DAL MAKHANI', 12, 4, 'BLACK LENTIL + COOKED OVERNIGHT + BUTTER + CREAM + SPICES', 'BLACK LENTIL + COOKED OVERNIGHT + BUTTER + CREAM + SPICES', 62, NULL, 2, 1583, NULL, 325.00, 5.00, 341.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 13:19:30', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(672, 'DAL DHABA', 'DAL DHABA', 12, 4, 'YELLOW DAL + ONION + TOMATO + CORIANDER + GREEN CHILLI + SPICES', 'YELLOW DAL + ONION + TOMATO + CORIANDER + GREEN CHILLI + SPICES', 62, NULL, 2, 1584, NULL, 325.00, 5.00, 341.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 13:20:13', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(673, 'ANARDANE WALE AMRITSARI CHOLE', 'ANARDANE WALE AMRITSARI CHOLE', 12, 4, 'WHITE CHANA + AMRITSARI STYLE + ANARDANA + TANGY GRAVY', 'WHITE CHANA + AMRITSARI STYLE + ANARDANA + TANGY GRAVY', 62, NULL, 2, 1585, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-21 13:26:03', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(674, 'BIRBALI KOFTA', 'BIRBALI KOFTA', 12, 4, 'SPINACH + PANEER + MUSHROOM + SPINACH AND TOMATO GRAVY', 'SPINACH + PANEER + MUSHROOM + SPINACH AND TOMATO GRAVY', 62, NULL, 2, 1604, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-24 04:53:33', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(675, 'PUNJABI MATAR MUSHROOM MAKHANI', 'PUNJABI MATAR MUSHROOM MAKHANI', 12, 4, 'MUSHROOM + MATAR + SPICY TOMATO GRAVY', 'MUSHROOM + MATAR + SPICY TOMATO GRAVY', 62, NULL, 2, 1605, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-24 04:54:31', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(676, 'BIHARI STYLE FISH CURRY', 'BIHARI STYLE FISH CURRY', 12, 4, 'MUSTARD FLAVOURED FISH CURRY + SUCCULENT + MUSTARD OIL TEMPERED', 'MUSTARD FLAVOURED FISH CURRY + SUCCULENT + MUSTARD OIL TEMPERED', 62, NULL, 2, 1606, NULL, 545.00, 5.00, 572.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-24 04:55:51', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(677, 'PENNE MARINARA VEG', 'PENNE MARINARA VEG', 12, 4, 'PENNE PASTA + SPICY TOMATO SAUCE + PARMESAN', 'PENNE PASTA + SPICY TOMATO SAUCE + PARMESAN', 65, NULL, 2, 1607, NULL, 325.00, 5.00, 341.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-24 04:56:38', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(678, 'PENNE MARINARA CHICKEN', 'PENNE MARINARA CHICKEN', 12, 4, 'PENNE PASTA + SPICY TOMATO SAUCE + PARMESAN', 'PENNE PASTA + SPICY TOMATO SAUCE + PARMESAN', 65, NULL, 2, 1608, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-24 04:57:20', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(679, 'FRIES', 'FRIES', 12, 4, 'FRIES', 'FRIES', 57, NULL, 2, 1609, NULL, 145.00, 5.00, 152.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-24 05:00:02', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(680, 'PERI PERI FRIES', 'PERI PERI FRIES', 12, 4, 'PERI PERI FRIES', 'PERI PERI FRIES', 57, NULL, 2, 1610, NULL, 195.00, 5.00, 204.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-24 05:01:04', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(681, 'VEGETABLE RAITA', 'VEGETABLE RAITA', 12, 4, 'VEGETABLE RAITA', 'VEGETABLE RAITA', 57, NULL, 2, 1611, NULL, 145.00, 5.00, 152.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-24 05:01:36', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(682, 'SZECHUAN VEGETABLE DIMSUM  FRIED IN WASABI CHEESE SAUCE', 'SZECHUAN VEGETABLE DIMSUM  FRIED IN WASABI CHEESE SAUCE', 12, 4, 'VEG DIMSUM CRUMBED FRIED AND TOSSED IN WASABI CHEESE SAUCE IT’S DIFFERENT & YUMMY', 'VEG DIMSUM CRUMBED FRIED AND TOSSED IN WASABI CHEESE SAUCE IT’S DIFFERENT & YUMMY', 60, NULL, 2, 1612, NULL, 295.00, 5.00, 309.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-26 10:47:12', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(683, 'CHILLI GARLIC BUTTER POACHED PRAWNS', 'CHILLI GARLIC BUTTER POACHED PRAWNS', 12, 4, 'BUTTER POACHED PRAWNS + HOUSE SPECIALITY CHILLI GARLIC BUTTER = INDULGENCE', 'BUTTER POACHED PRAWNS + HOUSE SPECIALITY CHILLI GARLIC BUTTER = INDULGENCE', 60, NULL, 2, 1613, NULL, 425.00, 5.00, 446.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-26 10:48:18', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(684, 'ROTI/BUTTER ROTI', 'ROTI/BUTTER ROTI', 2, 7, 'ROTI/BUTTER ROTI', 'ROTI/BUTTER ROTI', 66, NULL, 2, 1567, NULL, 55.00, 5.00, 57.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-26 11:32:21', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(685, 'NAAN/BUTTER NAAN', 'NAAN/BUTTER NAAN', 12, 4, 'NAAN/BUTTER NAAN', 'NAAN/BUTTER NAAN', 66, NULL, 2, 1568, NULL, 75.00, 5.00, 78.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-26 11:33:03', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(686, 'LACCHA PARATHA/ HARI MIRCHI KA PARATHA', 'LACCHA PARATHA/ HARI MIRCHI KA PARATHA', 2, 7, 'LACCHA PARATHA/ HARI MIRCHI KA PARATHA', 'LACCHA PARATHA/ HARI MIRCHI KA PARATHA', 66, NULL, 2, 1569, NULL, 75.00, 5.00, 78.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 10:50:06', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(687, 'KOLKATA GOSHT BIRYANI', 'KOLKATA GOSHT BIRYANI', 2, 7, 'OUR VERSION OF KOLKATA BIRYANI SERVED WITH MIRCH BAINGAN KA SALAN & MIX VEG RAITA', 'OUR VERSION OF KOLKATA BIRYANI SERVED WITH MIRCH BAINGAN KA SALAN & MIX VEG RAITA', 64, NULL, 2, 1619, NULL, 495.00, 5.00, 519.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 04:58:16', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(688, 'JAPANESE CHILLI NOODLE - EGG', 'JAPANESE CHILLI NOODLE - EGG', 2, 7, 'JAPANESE STYLE NOODLES TOSSED WITH ZUCCHINI, SHITAKE IN HOT TOMATO SAUCE', 'JAPANESE STYLE NOODLES TOSSED WITH ZUCCHINI, SHITAKE IN HOT TOMATO SAUCE', 23, NULL, 2, 1620, NULL, 275.00, 5.00, 288.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-26 11:36:47', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(689, 'JAPANESE CHILLI NOODLE - TOFU', 'JAPANESE CHILLI NOODLE - TOFU', 2, 7, 'JAPANESE STYLE NOODLES TOSSED WITH ZUCCHINI, SHITAKE IN HOT TOMATO SAUCE', 'JAPANESE STYLE NOODLES TOSSED WITH ZUCCHINI, SHITAKE IN HOT TOMATO SAUCE', 23, NULL, 2, 1620, NULL, 275.00, 5.00, 288.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-26 11:37:25', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(690, 'JAPANESE CHILLI NOODLE - CHICKEN', 'JAPANESE CHILLI NOODLE - CHICKEN', 2, 7, 'JAPANESE STYLE NOODLES TOSSED WITH ZUCCHINI, SHITAKE IN HOT TOMATO SAUCE', 'JAPANESE STYLE NOODLES TOSSED WITH ZUCCHINI, SHITAKE IN HOT TOMATO SAUCE', 23, NULL, 2, 1620, NULL, 325.00, 5.00, 341.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 04:59:07', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(691, 'THAI BASIL TOFU', 'THAI BASIL TOFU', 2, 7, 'TOFU COOKED WITH THAI HERBS & CHILLI & SERVED WITH STEAM RICE', 'TOFU COOKED WITH THAI HERBS & CHILLI & SERVED WITH STEAM RICE', 22, NULL, 2, 1621, NULL, 375.00, 5.00, 393.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 05:00:15', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(692, 'THAI BASIL CHICKEN', 'THAI BASIL CHICKEN', 2, 7, 'CHICKEN COOKED WITH THAI HERBS & CHILLI & SERVED WITH STEAM RICE', 'CHICKEN COOKED WITH THAI HERBS & CHILLI & SERVED WITH STEAM RICE', 22, NULL, 2, 1622, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 05:00:42', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(693, 'RED/GREEN THAI CURRY BOWL VEG', 'RED/GREEN THAI CURRY BOWL VEG', 2, 7, 'THAI SPICES, COCONUT MILK, KAFFIR LIME, GALANGAL & CHERRY TOMATO SERVED WITH STEAMED RICE', 'THAI SPICES, COCONUT MILK, KAFFIR LIME, GALANGAL & CHERRY TOMATO SERVED WITH STEAMED RICE', 22, NULL, 2, 1623, NULL, 345.00, 5.00, 362.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 05:02:15', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(694, 'RED/GREEN THAI CURRY BOWL CHICKEN', 'RED/GREEN THAI CURRY BOWL CHICKEN', 2, 7, 'THAI SPICES, CHICKEN, COCONUT MILK, KAFFIR LIME, GALANGAL & CHERRY TOMATO SERVED WITH STEAMED RICE', 'THAI SPICES, CHICKEN, COCONUT MILK, KAFFIR LIME, GALANGAL & CHERRY TOMATO SERVED WITH STEAMED RICE', 22, NULL, 2, 1623, NULL, 375.00, 5.00, 393.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 05:01:55', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(695, 'PANEER SIRKA PYAAZ', 'PANEER SIRKA PYAAZ', 2, 7, 'TANDOORI PANEER COOKED IN SWEET & SOUR TOMATO MASALA & SIRKA PYAAZ', 'TANDOORI PANEER COOKED IN SWEET & SOUR TOMATO MASALA & SIRKA PYAAZ', 62, NULL, 2, 1548, NULL, 375.00, 5.00, 393.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-26 11:45:54', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(696, 'BIRBALI KOFTA', 'BIRBALI KOFTA', 2, 7, 'SPINACH & PANEER KOFTA STUFFED WITH MUSHROOM IN SPINACH & TOMATO GRAVY', 'SPINACH & PANEER KOFTA STUFFED WITH MUSHROOM IN SPINACH & TOMATO GRAVY', 62, NULL, 2, 1604, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 05:03:01', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(697, 'CHICKEN TIKKA PIZZA', 'CHICKEN TIKKA PIZZA', 2, 7, 'ONION + GREEN CHILI + CORIANDER + MUSHROOM + CHICKEN TIKKA', 'ONION + GREEN CHILI + CORIANDER + MUSHROOM + CHICKEN TIKKA', 61, NULL, 2, 1582, NULL, 445.00, 5.00, 467.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-26 11:47:35', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(698, 'FUNGHI SELVATICI', 'FUNGHI SELVATICI', 2, 7, 'SHITAKE, SHIMEJI, CREMINI MUSHROOM PIZZA WITH TRUFFLE OIL DRIZZLE', 'SHITAKE, SHIMEJI, CREMINI MUSHROOM PIZZA WITH TRUFFLE OIL DRIZZLE', 61, NULL, 2, 1624, NULL, 445.00, 5.00, 467.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-26 11:49:51', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(699, 'FINCH SPECIAL LATPAT CHICKEN', 'FINCH SPECIAL LATPAT CHICKEN', 2, 7, 'SUCCULENT CHICKEN CUBES COOKED IN FINCH SPECIAL BHUNA MASALA GRAVY PREPARED WITH SELECTED MASALA', 'SUCCULENT CHICKEN CUBES COOKED IN FINCH SPECIAL BHUNA MASALA GRAVY PREPARED WITH SELECTED MASALA', 62, NULL, 2, 1625, NULL, 445.00, 5.00, 467.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-26 11:53:40', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(700, 'MUTTON ROGAN JOSH', 'MUTTON ROGAN JOSH', 2, 7, 'SUCCULENT MUTTON COOKED WITH KASHMIRI SPICES', 'SUCCULENT MUTTON COOKED WITH KASHMIRI SPICES', 62, NULL, 2, 1626, NULL, 575.00, 5.00, 603.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-26 11:55:02', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(701, 'NAAN/BUTTER NAAN', 'NAAN/BUTTER NAAN', 2, 7, 'NAAN/BUTTER NAAN', 'NAAN/BUTTER NAAN', 66, NULL, 2, 1568, NULL, 75.00, 5.00, 78.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29 10:48:39', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(702, 'VOLCANO NACHOS', 'VOLCANO NACHOS', 8, 9, 'Baked Nachos Chips, Tomato Salsa, Sour Cream, Refried Beans, Jalapenos & 3 Cheese Sauce', 'Baked Nachos Chips, Tomato Salsa, Sour Cream, Refried Beans, Jalapenos & 3 Cheese Sauce', 18, NULL, 2, 1637, NULL, 295.00, 5.00, 309.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 06:47:02', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(703, 'VOLCANO NACHOS', 'VOLCANO NACHOS', 7, 10, 'Baked Nachos Chips, Tomato Salsa, Sour Cream, Refried Beans, Jalapenos & 3 Cheese Sauce', 'Baked Nachos Chips, Tomato Salsa, Sour Cream, Refried Beans, Jalapenos & 3 Cheese Sauce', 18, NULL, 2, 1637, NULL, 295.00, 5.00, 309.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 06:48:28', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(704, 'CHILLY CHEESE CIGAR ROLLS', 'CHILLY CHEESE CIGAR ROLLS', 8, 9, 'Herb Tossed Veggies & Spiced Cream Cheese Rolls', 'Herb Tossed Veggies & Spiced Cream Cheese Rolls', 18, NULL, 2, 1638, NULL, 295.00, 5.00, 309.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:09:56', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(705, 'CHILLY CHEESE CIGAR ROLLS', 'CHILLY CHEESE CIGAR ROLLS', 7, 10, 'Herb Tossed Veggies & Spiced Cream Cheese Rolls', 'Herb Tossed Veggies & Spiced Cream Cheese Rolls', 18, NULL, 2, 1638, NULL, 295.00, 5.00, 309.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:10:31', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(706, 'THAI VEG SPRING ROLL', 'THAI VEG SPRING ROLL', 8, 9, 'Spring Roll Sheet, Spicy Thai Herb Vegetables, Glass Noodle, Sweet Chilli Sauce', 'Spring Roll Sheet, Spicy Thai Herb Vegetables, Glass Noodle, Sweet Chilli Sauce', 18, NULL, 2, 1639, NULL, 275.00, 5.00, 288.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:13:34', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(707, 'THAI VEG SPRING ROLL', 'THAI VEG SPRING ROLL', 7, 10, 'Spring Roll Sheet, Spicy Thai Herb Vegetables, Glass Noodle, Sweet Chilli Sauce', 'Spring Roll Sheet, Spicy Thai Herb Vegetables, Glass Noodle, Sweet Chilli Sauce', 18, NULL, 2, 1639, NULL, 275.00, 5.00, 288.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:13:54', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(708, 'Z’ATAR SPICED CHICKEN CUTLET', 'Z’ATAR SPICED CHICKEN CUTLET', 8, 9, 'Crumbed Fried Pulled Chicken, Potato & Z\'atar Spice', 'Crumbed Fried Pulled Chicken, Potato & Z\'atar Spice', 19, NULL, 2, 1640, NULL, 325.00, 5.00, 341.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:17:34', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(709, 'Z’ATAR SPICED CHICKEN CUTLET', 'Z’ATAR SPICED CHICKEN CUTLET', 7, 10, 'Crumbed Fried Pulled Chicken, Potato & Z\'atar Spice', 'Crumbed Fried Pulled Chicken, Potato & Z\'atar Spice', 19, NULL, 2, 1640, NULL, 325.00, 5.00, 341.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:16:47', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(711, 'CRISPY CHICKEN KOLIWADA WITH GREEN APPLE CHUTNEY', 'CRISPY CHICKEN KOLIWADA WITH GREEN APPLE CHUTNEY', 8, 9, 'Chicken Slivers, Marinated with Spices, Chilli, Rice Flour, Deep Fried Served with Green Apple Chutney', 'Chicken Slivers, Marinated with Spices, Chilli, Rice Flour, Deep Fried Served with Green Apple Chutney', 19, NULL, 2, 1641, NULL, 345.00, 5.00, 362.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:19:31', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(712, 'CRISPY CHICKEN KOLIWADA WITH GREEN APPLE CHUTNEY', 'CRISPY CHICKEN KOLIWADA WITH GREEN APPLE CHUTNEY', 7, 10, 'Chicken Slivers, Marinated with Spices, Chilli, Rice Flour, Deep Fried Served with Green Apple Chutney', 'Chicken Slivers, Marinated with Spices, Chilli, Rice Flour, Deep Fried Served with Green Apple Chutney', 19, NULL, 2, 1641, NULL, 345.00, 5.00, 362.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:20:06', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(713, 'DRUNKEN CHICKEN WINGS BBQ', 'DRUNKEN CHICKEN WINGS BBQ', 8, 9, 'Chicken Wings Marinated with Spices & Old Monk, Batter Fried Toast in choice of Spicy BBQ & Flambeed with Old Monk', 'Chicken Wings Marinated with Spices & Old Monk, Batter Fried Toast in choice of Spicy BBQ & Flambeed with Old Monk', 19, NULL, 2, 1642, NULL, 345.00, 5.00, 362.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:25:32', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(714, 'DRUNKEN CHICKEN WINGS BBQ', 'DRUNKEN CHICKEN WINGS BBQ', 7, 10, 'Chicken Wings Marinated with Spices & Old Monk, Batter Fried Toast in choice of Spicy BBQ & Flambeed with Old Monk', 'Chicken Wings Marinated with Spices & Old Monk, Batter Fried Toast in choice of Spicy BBQ & Flambeed with Old Monk', 19, NULL, 2, 1642, NULL, 345.00, 5.00, 362.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:26:02', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(715, 'DRUNKEN CHICKEN WINGS HOT GARLIC', 'DRUNKEN CHICKEN WINGS HOT GARLIC', 8, 9, 'Chicken Wings Marinated with Spices & Old Monk, Batter Fried Toast in choice of Spicy Hot Garlic & Flambeed with Old Monk', 'Chicken Wings Marinated with Spices & Old Monk, Batter Fried Toast in choice of Spicy Hot Garlic & Flambeed with Old Monk', 19, NULL, 2, 1643, NULL, 345.00, 5.00, 362.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:29:14', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(716, 'DRUNKEN CHICKEN WINGS HOT GARLIC', 'DRUNKEN CHICKEN WINGS HOT GARLIC', 7, 10, 'Chicken Wings Marinated with Spices & Old Monk, Batter Fried Toast in choice of Spicy Hot Garlic & Flambeed with Old Monk', 'Chicken Wings Marinated with Spices & Old Monk, Batter Fried Toast in choice of Spicy Hot Garlic & Flambeed with Old Monk', 19, NULL, 2, 1643, NULL, 345.00, 5.00, 362.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:29:49', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(717, 'DRUNKEN CHICKEN WINGS PIRI-PIRI', 'DRUNKEN CHICKEN WINGS PIRI-PIRI', 8, 9, 'Chicken Wings Marinated with Spices & Old Monk, Batter Fried Toast in choice of Spicy Piri Piri Sauce & Flambeed with Old Monk', 'Chicken Wings Marinated with Spices & Old Monk, Batter Fried Toast in choice of Spicy Piri Piri Sauce & Flambeed with Old Monk', 19, NULL, 2, 1644, NULL, 345.00, 5.00, 362.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:32:25', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(718, 'DRUNKEN CHICKEN WINGS PIRI-PIRI', 'DRUNKEN CHICKEN WINGS PIRI-PIRI', 7, 10, 'Chicken Wings Marinated with Spices & Old Monk, Batter Fried Toast in choice of Spicy Piri Piri Sauce & Flambeed with Old Monk', 'Chicken Wings Marinated with Spices & Old Monk, Batter Fried Toast in choice of Spicy Piri Piri Sauce & Flambeed with Old Monk', 19, NULL, 2, 1644, NULL, 345.00, 5.00, 362.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:32:54', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(719, 'OUR SIGNATURE SPICY ROCK CHICKEN FINGERS', 'OUR SIGNATURE SPICY ROCK CHICKEN FINGERS', 8, 9, 'Spicy Marinated Crispy Fries Chicken Strips served with Chilli Garlic Dip', 'Spicy Marinated Crispy Fries Chicken Strips served with Chilli Garlic Dip', 19, NULL, 2, 1645, NULL, 375.00, 5.00, 393.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:35:25', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(720, 'OUR SIGNATURE SPICY ROCK CHICKEN FINGERS', 'OUR SIGNATURE SPICY ROCK CHICKEN FINGERS', 7, 10, 'Spicy Marinated Crispy Fries Chicken Strips served with Chilli Garlic Dip', 'Spicy Marinated Crispy Fries Chicken Strips served with Chilli Garlic Dip', 19, NULL, 2, 1645, NULL, 375.00, 5.00, 393.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:35:54', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(721, 'FINCH’S SPECIAL INDIAN MASALA OMELETTE', 'FINCH’S SPECIAL INDIAN MASALA OMELETTE', 8, 9, 'Baked Indian Masala Omelette made with a Twist Indian Spice, Tomato, Onion, Bell pepper & Cheese', 'Baked Indian Masala Omelette made with a Twist Indian Spice, Tomato, Onion, Bell pepper & Cheese', 17, NULL, 2, 1646, NULL, 225.00, 5.00, 236.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:40:42', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(722, 'FINCH’S SPECIAL INDIAN MASALA OMELETTE', 'FINCH’S SPECIAL INDIAN MASALA OMELETTE', 7, 10, 'Baked Indian Masala Omelette made with a Twist Indian Spice, Tomato, Onion, Bell pepper & Cheese', 'Baked Indian Masala Omelette made with a Twist Indian Spice, Tomato, Onion, Bell pepper & Cheese', 17, NULL, 2, 1646, NULL, 225.00, 5.00, 236.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:42:53', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(723, 'ENGLISH BREAKFAST', 'ENGLISH BREAKFAST', 8, 9, 'Sauté Mushroom, Baked Beans, Skin on Potato wedges, Sunny side up, Toasted bread, Grilled Sausage, Grilled Tomato & Bacon', 'Sauté Mushroom, Baked Beans, Skin on Potato wedges, Sunny side up, Toasted bread, Grilled Sausage, Grilled Tomato & Bacon', 17, NULL, 2, 1647, NULL, 295.00, 5.00, 309.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:47:58', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(724, 'ENGLISH BREAKFAST', 'ENGLISH BREAKFAST', 7, 10, 'Sauté Mushroom, Baked Beans, Skin on Potato wedges, Sunny side up, Toasted bread, Grilled Sausage, Grilled Tomato & Bacon', 'Sauté Mushroom, Baked Beans, Skin on Potato wedges, Sunny side up, Toasted bread, Grilled Sausage, Grilled Tomato & Bacon', 17, NULL, 2, 1647, NULL, 295.00, 5.00, 309.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 07:48:31', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(725, 'GRILLED CHICKEN IN MOJO ROJO SANDWICH', 'GRILLED CHICKEN IN MOJO ROJO SANDWICH', 8, 9, 'Pulled Chicken shreds laced with soft Spices & Orange juice served with Salsa Fresca', 'Pulled Chicken shreds laced with soft Spices & Orange juice served with Salsa Fresca', 32, NULL, 2, 1648, NULL, 325.00, 5.00, 341.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 08:12:23', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(726, 'GRILLED CHICKEN IN MOJO ROJO SANDWICH', 'GRILLED CHICKEN IN MOJO ROJO SANDWICH', 7, 10, 'Pulled Chicken shreds laced with soft Spices & Orange juice served with Salsa Fresca', 'Pulled Chicken shreds laced with soft Spices & Orange juice served with Salsa Fresca', 32, NULL, 2, 1648, NULL, 325.00, 5.00, 341.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 08:13:04', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(727, 'CLASSIC MARGHERITA', 'CLASSIC MARGHERITA', 8, 9, 'Pomodoro Sauce, Mozzarella, Cherry tomato & Basil', 'Pomodoro Sauce, Mozzarella, Cherry tomato & Basil', 9, NULL, 2, 1649, NULL, 325.00, 5.00, 341.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 09:01:54', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(728, 'CLASSIC MARGHERITA', 'CLASSIC MARGHERITA', 7, 10, 'Pomodoro Sauce, Mozzarella, Cherry tomato & Basil', 'Pomodoro Sauce, Mozzarella, Cherry tomato & Basil', 9, NULL, 2, 1649, NULL, 325.00, 5.00, 341.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 09:02:40', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(729, 'FARM DELIGHT PIZZA', 'FARM DELIGHT PIZZA', 8, 9, 'Tomato Sauce, Mushroom, Onion, Bell peppers, Mozzarella Cheese  & Herbs', 'Tomato Sauce, Mushroom, Onion, Bell peppers, Mozzarella Cheese  & Herbs', 9, NULL, 2, 1650, NULL, 345.00, 5.00, 362.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 09:04:27', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(730, 'FARM DELIGHT PIZZA', 'FARM DELIGHT PIZZA', 7, 10, 'Tomato Sauce, Mushroom, Onion, Bell peppers, Mozzarella Cheese  & Herbs', 'Tomato Sauce, Mushroom, Onion, Bell peppers, Mozzarella Cheese  & Herbs', 9, NULL, 2, 1650, NULL, 345.00, 5.00, 362.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 09:04:52', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(731, 'CHICKEN TIKKA PIZZA', 'CHICKEN TIKKA PIZZA', 8, 9, 'Thin Crust Pizza, Topped with Onion, Green chilli, Coriander, Mushroom, Chicken Tikka & Cheese', 'Thin Crust Pizza, Topped with Onion, Green chilli, Coriander, Mushroom, Chicken Tikka & Cheese', 9, NULL, 2, 1651, NULL, 365.00, 5.00, 383.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 09:06:17', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(732, 'CHICKEN TIKKA PIZZA', 'CHICKEN TIKKA PIZZA', 7, 10, 'Thin Crust Pizza, Topped with Onion, Green chilli, Coriander, Mushroom, Chicken Tikka & Cheese', 'Thin Crust Pizza, Topped with Onion, Green chilli, Coriander, Mushroom, Chicken Tikka & Cheese', 9, NULL, 2, 1651, NULL, 365.00, 5.00, 383.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 09:06:44', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(733, 'MEATBALL PIZZA', 'MEATBALL PIZZA', 8, 9, 'Chicken Meatball, Mozzarella, Tomato & Italian Herbs', 'Chicken Meatball, Mozzarella, Tomato & Italian Herbs', 9, NULL, 2, 1652, NULL, 375.00, 5.00, 393.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 09:08:13', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(734, 'MEATBALL PIZZA', 'MEATBALL PIZZA', 7, 10, 'Chicken Meatball, Mozzarella, Tomato & Italian Herbs', 'Chicken Meatball, Mozzarella, Tomato & Italian Herbs', 9, NULL, 2, 1652, NULL, 375.00, 5.00, 393.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 09:08:35', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(735, 'AMRITSARI FISH & CHIPS', 'AMRITSARI FISH & CHIPS', 8, 9, 'Amritsari Masala marinated sole fish fillet crumbed fried served with house salad, homemade fries & tartar sauce', 'Amritsari Masala marinated sole fish fillet crumbed fried served with house salad, homemade fries & tartar sauce', 36, NULL, 2, 1653, NULL, 495.00, 5.00, 519.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 09:18:12', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(736, 'AMRITSARI FISH & CHIPS', 'AMRITSARI FISH & CHIPS', 8, 9, 'Amritsari Masala marinated sole fish fillet crumbed fried served with house salad, homemade fries & tartar sauce', 'Amritsari Masala marinated sole fish fillet crumbed fried served with house salad, homemade fries & tartar sauce', 36, NULL, 2, 1653, NULL, 495.00, 5.00, 519.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 09:18:40', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(737, 'VEG PASTA BOWL', 'VEG PASTA BOWL', 8, 9, 'Your Pasta bowl has mix exotic  vegetables & bell peppers served with freshly toasted Garlic bread with arabiatta sauce', 'Your Pasta bowl has mix exotic  vegetables & bell peppers served with freshly toasted Garlic bread with arabiatta sauce', 36, NULL, 2, 1654, NULL, 345.00, 5.00, 362.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 09:37:44', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(738, 'VEG PASTA BOWL', 'VEG PASTA BOWL', 7, 10, 'Your Pasta bowl has mix exotic  vegetables & bell peppers served with freshly toasted Garlic bread with arabiatta sauce', 'Your Pasta bowl has mix exotic  vegetables & bell peppers served with freshly toasted Garlic bread with arabiatta sauce', 36, NULL, 2, 1654, NULL, 345.00, 5.00, 362.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 09:37:58', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(739, 'NON VEG PASTA BOWL', 'NON VEG PASTA BOWL', 8, 9, 'Your Pasta bowl has mix exotic  vegetables & bell peppers served with freshly toasted Garlic bread with arabiatta sauce', 'Your Pasta bowl has mix exotic  vegetables & bell peppers served with freshly toasted Garlic bread with arabiatta sauce', 36, NULL, 2, 1654, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 09:38:37', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(740, 'NON VEG PASTA BOWL', 'NON VEG PASTA BOWL', 7, 10, 'Your Pasta bowl has mix exotic  vegetables & bell peppers served with freshly toasted Garlic bread with arabiatta sauce', 'Your Pasta bowl has mix exotic  vegetables & bell peppers served with freshly toasted Garlic bread with arabiatta sauce', 36, NULL, 2, 1654, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 09:39:04', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(741, 'BOMBASTIC BUTTER CHICKEN PLATTER', 'BOMBASTIC BUTTER CHICKEN PLATTER', 8, 9, 'Succulent chicken cooked in silky & buttery tomato gravy served with house speciality masala onion, mint chutney & Tawa Laccha Paratha', 'Succulent chicken cooked in silky & buttery tomato gravy served with house speciality masala onion, mint chutney & Tawa Laccha Paratha', 36, NULL, 2, 1655, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 09:42:20', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(742, 'BOMBASTIC BUTTER CHICKEN PLATTER', 'BOMBASTIC BUTTER CHICKEN PLATTER', 7, 10, 'Succulent chicken cooked in silky & buttery tomato gravy served with house speciality masala onion, mint chutney & Tawa Laccha Paratha', 'Succulent chicken cooked in silky & buttery tomato gravy served with house speciality masala onion, mint chutney & Tawa Laccha Paratha', 36, NULL, 2, 1655, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 09:42:48', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(743, 'KILLER KADHAI PLATTER PANEER', 'KILLER KADHAI PLATTER PANEER', 8, 9, 'Paneer cooked with Kadhai spices in spicy gravy served  with onion salad, mint chutney & Tawa Laccha Paratha', 'Paneer cooked with Kadhai spices in spicy gravy served  with onion salad, mint chutney & Tawa Laccha Paratha', 36, NULL, 2, 1656, NULL, 375.00, 5.00, 393.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 10:04:53', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(744, 'KILLER KADHAI PLATTER PANEER', 'KILLER KADHAI PLATTER PANEER', 7, 10, 'Paneer cooked with Kadhai spices in spicy gravy served  with onion salad, mint chutney & Tawa Laccha Paratha', 'Paneer cooked with Kadhai spices in spicy gravy served  with onion salad, mint chutney & Tawa Laccha Paratha', 36, NULL, 2, 1656, NULL, 375.00, 5.00, 393.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-11 10:05:16', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(745, 'KILLER KADHAI PLATTER MUSHROOM', 'KILLER KADHAI PLATTER MUSHROOM', 8, 9, 'Mushroom cooked with Kadhai spices in spicy gravy served  with onion salad, mint chutney & Tawa Laccha Paratha', 'Mushroom cooked with Kadhai spices in spicy gravy served  with onion salad, mint chutney & Tawa Laccha Paratha', 36, NULL, 2, 1657, NULL, 375.00, 5.00, 393.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-12 13:35:37', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(746, 'KILLER KADHAI PLATTER MUSHROOM', 'KILLER KADHAI PLATTER MUSHROOM', 7, 10, 'Mushroom cooked with Kadhai spices in spicy gravy served  with onion salad, mint chutney & Tawa Laccha Paratha', 'Mushroom cooked with Kadhai spices in spicy gravy served  with onion salad, mint chutney & Tawa Laccha Paratha', 36, NULL, 2, 1657, NULL, 375.00, 5.00, 393.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-12 13:36:05', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(747, 'KILLER KADHAI PLATTER CHICKEN', 'KILLER KADHAI PLATTER CHICKEN', 8, 9, 'Chicken cooked with Kadhai spices in spicy gravy served  with onion salad, mint chutney & Tawa Laccha Paratha', 'Chicken cooked with Kadhai spices in spicy gravy served  with onion salad, mint chutney & Tawa Laccha Paratha', 36, NULL, 2, 1658, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-12 13:37:53', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(748, 'KILLER KADHAI PLATTER CHICKEN', 'KILLER KADHAI PLATTER CHICKEN', 7, 10, 'Chicken cooked with Kadhai spices in spicy gravy served  with onion salad, mint chutney & Tawa Laccha Paratha', 'Chicken cooked with Kadhai spices in spicy gravy served  with onion salad, mint chutney & Tawa Laccha Paratha', 36, NULL, 2, 1658, NULL, 395.00, 5.00, 414.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-12 13:38:15', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(749, 'THAI CHILLI NOODLE VEG', 'THAI CHILLI NOODLE VEG', 8, 9, 'Noodle cooked Thai style with Thai herbs, Fresh Red Chilli, Onion & Scallion', 'Noodle cooked Thai style with Thai herbs, Fresh Red Chilli, Onion & Scallion', 36, NULL, 2, 1659, NULL, 225.00, 5.00, 236.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-12 13:41:53', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(750, 'THAI CHILLI NOODLE VEG', 'THAI CHILLI NOODLE VEG', 7, 10, 'Noodle cooked Thai style with Thai herbs, Fresh Red Chilli, Onion & Scallion', 'Noodle cooked Thai style with Thai herbs, Fresh Red Chilli, Onion & Scallion', 36, NULL, 2, 1659, NULL, 225.00, 5.00, 236.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-12 13:43:16', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(751, 'THAI CHILLI NOODLE EGG', 'THAI CHILLI NOODLE EGG', 8, 9, 'Noodle cooked Thai style with Thai herbs, Fresh Red Chilli, Onion & Scallion', 'Noodle cooked Thai style with Thai herbs, Fresh Red Chilli, Onion & Scallion', 36, NULL, 2, 1660, NULL, 245.00, 5.00, 257.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-12 13:46:03', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(752, 'THAI CHILLI NOODLE EGG', 'THAI CHILLI NOODLE EGG', 7, 10, 'Noodle cooked Thai style with Thai herbs, Fresh Red Chilli, Onion & Scallion', 'Noodle cooked Thai style with Thai herbs, Fresh Red Chilli, Onion & Scallion', 36, NULL, 2, 1660, NULL, 245.00, 5.00, 257.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-12 13:46:30', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(753, 'THAI CHILLI NOODLE CHICKEN', 'THAI CHILLI NOODLE CHICKEN', 8, 9, 'Noodle cooked Thai style with Thai herbs, Fresh Red Chilli, Onion & Scallion', 'Noodle cooked Thai style with Thai herbs, Fresh Red Chilli, Onion & Scallion', 36, NULL, 2, 1661, NULL, 275.00, 5.00, 288.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-12 13:47:58', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 1, 0),
(754, 'THAI CHILLI NOODLE CHICKEN', 'THAI CHILLI NOODLE CHICKEN', 7, 10, 'Noodle cooked Thai style with Thai herbs, Fresh Red Chilli, Onion & Scallion', 'Noodle cooked Thai style with Thai herbs, Fresh Red Chilli, Onion & Scallion', 36, NULL, 2, 1661, NULL, 275.00, 5.00, 288.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-12 13:48:24', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 1, 0),
(755, 'GARLIC BREAD', 'GARLIC BREAD', 8, 9, 'Garlic Bread', 'Garlic Bread', 66, NULL, 2, 1662, NULL, 125.00, 5.00, 131.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-12 13:56:19', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(757, 'DAL MAKHANI FONDUE', 'DAL MAKHANI FONDUE', 8, 9, 'Black lentil simmered overnight with milk, butter & potli of spices served with popsicles of crispy Tawa Paratha', 'Black lentil simmered overnight with milk, butter & potli of spices served with popsicles of crispy Tawa Paratha', 57, NULL, 2, 1663, NULL, 275.00, 5.00, 288.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-12 13:59:15', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0),
(758, 'DAL MAKHANI FONDUE', 'DAL MAKHANI FONDUE', 7, 10, 'Black lentil simmered overnight with milk, butter & potli of spices served with popsicles of crispy Tawa Paratha', 'Black lentil simmered overnight with milk, butter & potli of spices served with popsicles of crispy Tawa Paratha', 57, NULL, 2, 1663, NULL, 275.00, 5.00, 288.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-05-12 13:59:36', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 0),
(761, 'Homemade French Fries', 'There is nothing better than a hot and fresh french fry—see how easy they are to make at home with', 0, 0, '', '', 0, NULL, 0, 1676, 1677, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-08-22 17:42:58', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 1),
(763, 'Brunch OLD', 'Brunch OLD', 0, 0, '', '', 0, NULL, 0, 1681, 1682, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-08-22 17:55:19', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 1),
(764, 'Wine OLD', 'Wine OLD', 0, 0, '', '', 0, NULL, 0, 1683, 1684, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-08-22 17:55:12', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 1),
(765, 'Dessert OLD', 'Dessert OLD', 0, 0, '', '', 0, NULL, 0, 1685, 1686, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-08-22 17:55:04', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 1),
(804, 'Brunch', 'Brunch', 0, 0, '', '', 0, NULL, 0, NULL, NULL, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-08-22 16:38:06', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 1),
(805, 'Birthday Dessert', 'Dessert', 0, 0, '', '', 0, NULL, 0, NULL, NULL, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-08-30 18:20:18', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 1),
(807, 'Complemantry Wine', 'Complemantry Wine', 0, 0, '', '', 0, NULL, 0, NULL, NULL, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-09-02 14:26:31', 'Admin', '1', 'Admin', '1', 0, 0, 0, 1, 0, 0, 1),
(810, 'GARLIC BREAD', 'GARLIC BREAD', 7, 10, 'Garlic Bread', 'Garlic Bread', 66, NULL, 2, 1662, NULL, 0.00, 0.00, 131.00, '', '', NULL, NULL, NULL, NULL, NULL, 1, '2023-11-04 17:30:58', 'Admin', '1', '', '', 0, 0, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_metas`
--

CREATE TABLE `product_metas` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `attribute_id` int NOT NULL,
  `option_id` int NOT NULL,
  `regular_price` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_metas`
--

INSERT INTO `product_metas` (`id`, `product_id`, `attribute_id`, `option_id`, `regular_price`, `tax`, `created_at`, `updated_at`) VALUES
(736, 350, 10, 34, '295.00', '0.00', '2023-09-18 10:42:00', '2023-09-18 10:42:00'),
(737, 350, 10, 35, '545.00', '0.00', '2023-09-18 10:42:00', '2023-09-18 10:42:00'),
(738, 350, 10, 36, '925.00', '0.00', '2023-09-18 10:42:00', '2023-09-18 10:42:00'),
(739, 350, 10, 37, '1295.00', '0.00', '2023-09-18 10:42:00', '2023-09-18 10:42:00'),
(740, 350, 10, 33, '255.00', '0.00', '2023-09-18 10:42:00', '2023-09-18 10:42:00'),
(741, 349, 10, 34, '295.00', '0.00', '2023-09-18 10:43:00', '2023-09-18 10:43:00'),
(742, 349, 10, 35, '545.00', '0.00', '2023-09-18 10:43:00', '2023-09-18 10:43:00'),
(743, 349, 10, 36, '925.00', '0.00', '2023-09-18 10:43:00', '2023-09-18 10:43:00'),
(744, 349, 10, 37, '1295.00', '0.00', '2023-09-18 10:43:00', '2023-09-18 10:43:00'),
(745, 349, 10, 33, '255.00', '0.00', '2023-09-18 10:43:00', '2023-09-18 10:43:00'),
(746, 348, 10, 34, '295.00', '0.00', '2023-09-18 10:43:00', '2023-09-18 10:43:00'),
(747, 348, 10, 35, '545.00', '0.00', '2023-09-18 10:43:00', '2023-09-18 10:43:00'),
(748, 348, 10, 36, '925.00', '0.00', '2023-09-18 10:43:00', '2023-09-18 10:43:00'),
(749, 348, 10, 37, '1295.00', '0.00', '2023-09-18 10:43:00', '2023-09-18 10:43:00'),
(750, 348, 10, 33, '255.00', '0.00', '2023-09-18 10:43:00', '2023-09-18 10:43:00'),
(751, 347, 10, 34, '295.00', '0.00', '2023-09-18 10:43:00', '2023-09-18 10:43:00'),
(752, 347, 10, 35, '545.00', '0.00', '2023-09-18 10:43:00', '2023-09-18 10:43:00'),
(753, 347, 10, 36, '925.00', '0.00', '2023-09-18 10:43:00', '2023-09-18 10:43:00'),
(754, 347, 10, 37, '1295.00', '0.00', '2023-09-18 10:43:00', '2023-09-18 10:43:00'),
(755, 347, 10, 33, '255.00', '0.00', '2023-09-18 10:43:00', '2023-09-18 10:43:00'),
(756, 346, 10, 34, '295.00', '0.00', '2023-09-18 10:44:00', '2023-09-18 10:44:00'),
(757, 346, 10, 35, '545.00', '0.00', '2023-09-18 10:44:00', '2023-09-18 10:44:00'),
(758, 346, 10, 36, '925.00', '0.00', '2023-09-18 10:44:00', '2023-09-18 10:44:00'),
(759, 346, 10, 37, '1295.00', '0.00', '2023-09-18 10:44:00', '2023-09-18 10:44:00'),
(760, 346, 10, 33, '255.00', '0.00', '2023-09-18 10:44:00', '2023-09-18 10:44:00'),
(766, 345, 10, 34, '295.00', '0.00', '2023-09-18 10:44:00', '2023-09-18 10:44:00'),
(767, 345, 10, 35, '545.00', '0.00', '2023-09-18 10:44:00', '2023-09-18 10:44:00'),
(768, 345, 10, 36, '925.00', '0.00', '2023-09-18 10:44:00', '2023-09-18 10:44:00'),
(769, 345, 10, 37, '1295.00', '0.00', '2023-09-18 10:44:00', '2023-09-18 10:44:00'),
(770, 345, 10, 33, '255.00', '0.00', '2023-09-18 10:44:00', '2023-09-18 10:44:00'),
(771, 344, 10, 34, '295.00', '0.00', '2023-09-18 10:44:00', '2023-09-18 10:44:00'),
(772, 344, 10, 35, '545.00', '0.00', '2023-09-18 10:44:00', '2023-09-18 10:44:00'),
(773, 344, 10, 36, '925.00', '0.00', '2023-09-18 10:44:00', '2023-09-18 10:44:00'),
(774, 344, 10, 37, '1295.00', '0.00', '2023-09-18 10:44:00', '2023-09-18 10:44:00'),
(775, 344, 10, 33, '255.00', '0.00', '2023-09-18 10:44:00', '2023-09-18 10:44:00'),
(776, 343, 10, 34, '245.00', '0.00', '2023-09-18 10:45:00', '2023-09-18 10:45:00'),
(777, 343, 10, 35, '495.00', '0.00', '2023-09-18 10:45:00', '2023-09-18 10:45:00'),
(778, 343, 10, 36, '825.00', '0.00', '2023-09-18 10:45:00', '2023-09-18 10:45:00'),
(779, 343, 10, 37, '1145.00', '0.00', '2023-09-18 10:45:00', '2023-09-18 10:45:00'),
(780, 343, 10, 33, '195.00', '0.00', '2023-09-18 10:45:00', '2023-09-18 10:45:00'),
(781, 342, 10, 34, '245.00', '0.00', '2023-09-18 10:45:00', '2023-09-18 10:45:00'),
(782, 342, 10, 35, '495.00', '0.00', '2023-09-18 10:45:00', '2023-09-18 10:45:00'),
(783, 342, 10, 36, '825.00', '0.00', '2023-09-18 10:45:00', '2023-09-18 10:45:00'),
(784, 342, 10, 37, '1145.00', '0.00', '2023-09-18 10:45:00', '2023-09-18 10:45:00'),
(785, 342, 10, 33, '195.00', '0.00', '2023-09-18 10:45:00', '2023-09-18 10:45:00'),
(786, 360, 11, 38, '295.00', '0.00', '2023-09-18 10:45:00', '2023-09-18 10:45:00'),
(787, 360, 11, 39, '1095.00', '0.00', '2023-09-18 10:45:00', '2023-09-18 10:45:00'),
(788, 359, 12, 41, '295.00', '0.00', '2023-09-18 10:45:00', '2023-09-18 10:45:00'),
(789, 359, 12, 43, '1799.00', '0.00', '2023-09-18 10:45:00', '2023-09-18 10:45:00'),
(790, 359, 12, 42, '395.00', '0.00', '2023-09-18 10:45:00', '2023-09-18 10:45:00'),
(791, 359, 12, 40, '165.00', '0.00', '2023-09-18 10:45:00', '2023-09-18 10:45:00'),
(792, 358, 12, 41, '295.00', '0.00', '2023-09-18 10:46:00', '2023-09-18 10:46:00'),
(793, 358, 12, 43, '1799.00', '0.00', '2023-09-18 10:46:00', '2023-09-18 10:46:00'),
(794, 358, 12, 42, '395.00', '0.00', '2023-09-18 10:46:00', '2023-09-18 10:46:00'),
(795, 358, 12, 40, '165.00', '0.00', '2023-09-18 10:46:00', '2023-09-18 10:46:00'),
(796, 357, 11, 38, '275.00', '0.00', '2023-09-18 10:46:00', '2023-09-18 10:46:00'),
(797, 357, 11, 39, '995.00', '0.00', '2023-09-18 10:46:00', '2023-09-18 10:46:00'),
(798, 356, 11, 38, '275.00', '0.00', '2023-09-18 10:46:00', '2023-09-18 10:46:00'),
(799, 356, 11, 39, '995.00', '0.00', '2023-09-18 10:46:00', '2023-09-18 10:46:00'),
(800, 355, 11, 38, '225.00', '0.00', '2023-09-18 10:46:00', '2023-09-18 10:46:00'),
(801, 355, 11, 39, '795.00', '0.00', '2023-09-18 10:46:00', '2023-09-18 10:46:00'),
(808, 354, 11, 38, '225.00', '0.00', '2023-09-18 10:47:00', '2023-09-18 10:47:00'),
(809, 354, 11, 39, '795.00', '0.00', '2023-09-18 10:47:00', '2023-09-18 10:47:00'),
(810, 353, 11, 38, '195.00', '0.00', '2023-09-18 10:47:00', '2023-09-18 10:47:00'),
(811, 353, 11, 39, '695.00', '0.00', '2023-09-18 10:47:00', '2023-09-18 10:47:00'),
(812, 352, 11, 38, '195.00', '0.00', '2023-09-18 10:48:00', '2023-09-18 10:48:00'),
(813, 352, 11, 39, '695.00', '0.00', '2023-09-18 10:48:00', '2023-09-18 10:48:00'),
(814, 351, 10, 34, '295.00', '0.00', '2023-09-18 10:48:00', '2023-09-18 10:48:00'),
(815, 351, 10, 35, '545.00', '0.00', '2023-09-18 10:48:00', '2023-09-18 10:48:00'),
(816, 351, 10, 36, '925.00', '0.00', '2023-09-18 10:48:00', '2023-09-18 10:48:00'),
(817, 351, 10, 37, '1295.00', '0.00', '2023-09-18 10:48:00', '2023-09-18 10:48:00'),
(818, 351, 10, 33, '255.00', '0.00', '2023-09-18 10:48:00', '2023-09-18 10:48:00'),
(819, 370, 11, 38, '425.00', '0.00', '2023-09-18 10:49:00', '2023-09-18 10:49:00'),
(820, 370, 11, 39, '1595.00', '0.00', '2023-09-18 10:49:00', '2023-09-18 10:49:00'),
(821, 369, 11, 38, '325.00', '0.00', '2023-09-18 10:49:00', '2023-09-18 10:49:00'),
(822, 369, 11, 39, '1195.00', '0.00', '2023-09-18 10:49:00', '2023-09-18 10:49:00'),
(823, 368, 11, 38, '325.00', '0.00', '2023-09-18 10:49:00', '2023-09-18 10:49:00'),
(824, 368, 11, 39, '1195.00', '0.00', '2023-09-18 10:49:00', '2023-09-18 10:49:00'),
(825, 367, 12, 41, '325.00', '0.00', '2023-09-18 10:49:00', '2023-09-18 10:49:00'),
(826, 367, 12, 43, '2799.00', '0.00', '2023-09-18 10:49:00', '2023-09-18 10:49:00'),
(827, 367, 12, 42, '475.00', '0.00', '2023-09-18 10:49:00', '2023-09-18 10:49:00'),
(828, 367, 12, 40, '185.00', '0.00', '2023-09-18 10:49:00', '2023-09-18 10:49:00'),
(829, 366, 12, 41, '325.00', '0.00', '2023-09-18 10:49:00', '2023-09-18 10:49:00'),
(830, 366, 12, 43, '2799.00', '0.00', '2023-09-18 10:49:00', '2023-09-18 10:49:00'),
(831, 366, 12, 42, '475.00', '0.00', '2023-09-18 10:49:00', '2023-09-18 10:49:00'),
(832, 366, 12, 40, '185.00', '0.00', '2023-09-18 10:49:00', '2023-09-18 10:49:00'),
(833, 365, 11, 38, '295.00', '0.00', '2023-09-18 10:49:00', '2023-09-18 10:49:00'),
(834, 365, 11, 39, '1095.00', '0.00', '2023-09-18 10:49:00', '2023-09-18 10:49:00'),
(835, 364, 11, 38, '295.00', '0.00', '2023-09-18 10:50:00', '2023-09-18 10:50:00'),
(836, 364, 11, 39, '1095.00', '0.00', '2023-09-18 10:50:00', '2023-09-18 10:50:00'),
(841, 363, 12, 41, '325.00', '0.00', '2023-09-18 10:50:00', '2023-09-18 10:50:00'),
(842, 363, 12, 43, '2799.00', '0.00', '2023-09-18 10:50:00', '2023-09-18 10:50:00'),
(843, 363, 12, 42, '475.00', '0.00', '2023-09-18 10:50:00', '2023-09-18 10:50:00'),
(844, 363, 12, 40, '185.00', '0.00', '2023-09-18 10:50:00', '2023-09-18 10:50:00'),
(845, 362, 12, 41, '325.00', '0.00', '2023-09-18 10:50:00', '2023-09-18 10:50:00'),
(846, 362, 12, 43, '2799.00', '0.00', '2023-09-18 10:50:00', '2023-09-18 10:50:00'),
(847, 362, 12, 42, '475.00', '0.00', '2023-09-18 10:50:00', '2023-09-18 10:50:00'),
(848, 362, 12, 40, '185.00', '0.00', '2023-09-18 10:50:00', '2023-09-18 10:50:00'),
(849, 361, 11, 38, '295.00', '0.00', '2023-09-18 10:50:00', '2023-09-18 10:50:00'),
(850, 361, 11, 39, '1095.00', '0.00', '2023-09-18 10:50:00', '2023-09-18 10:50:00'),
(851, 380, 12, 41, '445.00', '0.00', '2023-09-18 10:51:00', '2023-09-18 10:51:00'),
(852, 380, 12, 43, '2999.00', '0.00', '2023-09-18 10:51:00', '2023-09-18 10:51:00'),
(853, 380, 12, 42, '645.00', '0.00', '2023-09-18 10:51:00', '2023-09-18 10:51:00'),
(854, 380, 12, 40, '245.00', '0.00', '2023-09-18 10:51:00', '2023-09-18 10:51:00'),
(855, 379, 12, 41, '445.00', '0.00', '2023-09-18 10:51:00', '2023-09-18 10:51:00'),
(856, 379, 12, 43, '2999.00', '0.00', '2023-09-18 10:51:00', '2023-09-18 10:51:00'),
(857, 379, 12, 42, '645.00', '0.00', '2023-09-18 10:51:00', '2023-09-18 10:51:00'),
(858, 379, 12, 40, '245.00', '0.00', '2023-09-18 10:51:00', '2023-09-18 10:51:00'),
(859, 378, 12, 41, '445.00', '0.00', '2023-09-18 10:51:00', '2023-09-18 10:51:00'),
(860, 378, 12, 43, '2999.00', '0.00', '2023-09-18 10:51:00', '2023-09-18 10:51:00'),
(861, 378, 12, 42, '645.00', '0.00', '2023-09-18 10:51:00', '2023-09-18 10:51:00'),
(862, 378, 12, 40, '245.00', '0.00', '2023-09-18 10:51:00', '2023-09-18 10:51:00'),
(863, 377, 11, 38, '445.00', '0.00', '2023-09-18 10:51:00', '2023-09-18 10:51:00'),
(864, 377, 11, 39, '1695.00', '0.00', '2023-09-18 10:51:00', '2023-09-18 10:51:00'),
(865, 376, 11, 38, '445.00', '0.00', '2023-09-18 10:52:00', '2023-09-18 10:52:00'),
(866, 376, 11, 39, '1695.00', '0.00', '2023-09-18 10:52:00', '2023-09-18 10:52:00'),
(867, 375, 12, 41, '395.00', '0.00', '2023-09-18 10:52:00', '2023-09-18 10:52:00'),
(868, 375, 12, 43, '2899.00', '0.00', '2023-09-18 10:52:00', '2023-09-18 10:52:00'),
(869, 375, 12, 42, '575.00', '0.00', '2023-09-18 10:52:00', '2023-09-18 10:52:00'),
(870, 375, 12, 40, '225.00', '0.00', '2023-09-18 10:52:00', '2023-09-18 10:52:00'),
(871, 374, 12, 41, '395.00', '0.00', '2023-09-18 10:52:00', '2023-09-18 10:52:00'),
(872, 374, 12, 43, '2899.00', '0.00', '2023-09-18 10:52:00', '2023-09-18 10:52:00'),
(873, 374, 12, 42, '575.00', '0.00', '2023-09-18 10:52:00', '2023-09-18 10:52:00'),
(874, 374, 12, 40, '225.00', '0.00', '2023-09-18 10:52:00', '2023-09-18 10:52:00'),
(875, 373, 11, 38, '445.00', '0.00', '2023-09-18 10:52:00', '2023-09-18 10:52:00'),
(876, 373, 11, 39, '1695.00', '0.00', '2023-09-18 10:52:00', '2023-09-18 10:52:00'),
(877, 372, 11, 38, '445.00', '0.00', '2023-09-18 10:53:00', '2023-09-18 10:53:00'),
(878, 372, 11, 39, '1695.00', '0.00', '2023-09-18 10:53:00', '2023-09-18 10:53:00'),
(879, 371, 11, 38, '425.00', '0.00', '2023-09-18 10:53:00', '2023-09-18 10:53:00'),
(880, 371, 11, 39, '1595.00', '0.00', '2023-09-18 10:53:00', '2023-09-18 10:53:00'),
(881, 390, 12, 41, '495.00', '0.00', '2023-09-18 10:53:00', '2023-09-18 10:53:00'),
(882, 390, 12, 43, '3599.00', '0.00', '2023-09-18 10:53:00', '2023-09-18 10:53:00'),
(883, 390, 12, 42, '725.00', '0.00', '2023-09-18 10:53:00', '2023-09-18 10:53:00'),
(884, 390, 12, 40, '275.00', '0.00', '2023-09-18 10:53:00', '2023-09-18 10:53:00'),
(885, 389, 12, 41, '465.00', '0.00', '2023-09-18 10:53:00', '2023-09-18 10:53:00'),
(886, 389, 12, 43, '3299.00', '0.00', '2023-09-18 10:53:00', '2023-09-18 10:53:00'),
(887, 389, 12, 42, '675.00', '0.00', '2023-09-18 10:53:00', '2023-09-18 10:53:00'),
(888, 389, 12, 40, '255.00', '0.00', '2023-09-18 10:53:00', '2023-09-18 10:53:00'),
(889, 388, 12, 41, '465.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(890, 388, 12, 43, '3299.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(891, 388, 12, 42, '675.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(892, 388, 12, 40, '255.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(893, 387, 12, 41, '445.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(894, 387, 12, 43, '2999.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(895, 387, 12, 42, '645.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(896, 387, 12, 40, '245.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(897, 386, 12, 41, '445.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(898, 386, 12, 43, '2999.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(899, 386, 12, 42, '645.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(900, 386, 12, 40, '245.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(901, 385, 12, 41, '445.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(902, 385, 12, 43, '2999.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(903, 385, 12, 42, '645.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(904, 385, 12, 40, '245.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(905, 384, 12, 41, '445.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(906, 384, 12, 43, '2999.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(907, 384, 12, 42, '645.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(908, 384, 12, 40, '245.00', '0.00', '2023-09-18 10:54:00', '2023-09-18 10:54:00'),
(909, 383, 12, 41, '195.00', '0.00', '2023-09-18 10:55:00', '2023-09-18 10:55:00'),
(910, 383, 12, 43, '1299.00', '0.00', '2023-09-18 10:55:00', '2023-09-18 10:55:00'),
(911, 383, 12, 42, '275.00', '0.00', '2023-09-18 10:55:00', '2023-09-18 10:55:00'),
(912, 383, 12, 40, '155.00', '0.00', '2023-09-18 10:55:00', '2023-09-18 10:55:00'),
(913, 382, 12, 41, '195.00', '0.00', '2023-09-18 10:55:00', '2023-09-18 10:55:00'),
(914, 382, 12, 43, '1299.00', '0.00', '2023-09-18 10:55:00', '2023-09-18 10:55:00'),
(915, 382, 12, 42, '275.00', '0.00', '2023-09-18 10:55:00', '2023-09-18 10:55:00'),
(916, 382, 12, 40, '155.00', '0.00', '2023-09-18 10:55:00', '2023-09-18 10:55:00'),
(917, 381, 12, 41, '445.00', '0.00', '2023-09-18 10:55:00', '2023-09-18 10:55:00'),
(918, 381, 12, 43, '2999.00', '0.00', '2023-09-18 10:55:00', '2023-09-18 10:55:00'),
(919, 381, 12, 42, '645.00', '0.00', '2023-09-18 10:55:00', '2023-09-18 10:55:00'),
(920, 381, 12, 40, '245.00', '0.00', '2023-09-18 10:55:00', '2023-09-18 10:55:00'),
(921, 400, 12, 41, '695.00', '0.00', '2023-09-18 10:55:00', '2023-09-18 10:55:00'),
(922, 400, 12, 43, '5299.00', '0.00', '2023-09-18 10:55:00', '2023-09-18 10:55:00'),
(923, 400, 12, 42, '995.00', '0.00', '2023-09-18 10:55:00', '2023-09-18 10:55:00'),
(924, 400, 12, 40, '375.00', '0.00', '2023-09-18 10:55:00', '2023-09-18 10:55:00'),
(925, 399, 12, 41, '275.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(926, 399, 12, 43, '1799.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(927, 399, 12, 42, '395.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(928, 399, 12, 40, '155.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(929, 398, 12, 41, '275.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(930, 398, 12, 43, '1799.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(931, 398, 12, 42, '395.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(932, 398, 12, 40, '155.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(933, 397, 12, 41, '695.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(934, 397, 12, 43, '5299.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(935, 397, 12, 42, '995.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(936, 397, 12, 40, '375.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(937, 396, 12, 41, '695.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(938, 396, 12, 43, '5299.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(939, 396, 12, 42, '995.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(940, 396, 12, 40, '375.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(941, 395, 12, 41, '275.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(942, 395, 12, 43, '1799.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(943, 395, 12, 42, '395.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(944, 395, 12, 40, '155.00', '0.00', '2023-09-18 10:56:00', '2023-09-18 10:56:00'),
(949, 394, 12, 41, '275.00', '0.00', '2023-09-18 10:57:00', '2023-09-18 10:57:00'),
(950, 394, 12, 43, '1799.00', '0.00', '2023-09-18 10:57:00', '2023-09-18 10:57:00'),
(951, 394, 12, 42, '395.00', '0.00', '2023-09-18 10:57:00', '2023-09-18 10:57:00'),
(952, 394, 12, 40, '155.00', '0.00', '2023-09-18 10:57:00', '2023-09-18 10:57:00'),
(953, 393, 12, 41, '645.00', '0.00', '2023-09-18 10:57:00', '2023-09-18 10:57:00'),
(954, 393, 12, 43, '4999.00', '0.00', '2023-09-18 10:57:00', '2023-09-18 10:57:00'),
(955, 393, 12, 42, '925.00', '0.00', '2023-09-18 10:57:00', '2023-09-18 10:57:00'),
(956, 393, 12, 40, '345.00', '0.00', '2023-09-18 10:57:00', '2023-09-18 10:57:00'),
(957, 392, 12, 41, '645.00', '0.00', '2023-09-18 10:57:00', '2023-09-18 10:57:00'),
(958, 392, 12, 43, '4999.00', '0.00', '2023-09-18 10:57:00', '2023-09-18 10:57:00'),
(959, 392, 12, 42, '925.00', '0.00', '2023-09-18 10:57:00', '2023-09-18 10:57:00'),
(960, 392, 12, 40, '345.00', '0.00', '2023-09-18 10:57:00', '2023-09-18 10:57:00'),
(961, 391, 12, 41, '495.00', '0.00', '2023-09-18 10:57:00', '2023-09-18 10:57:00'),
(962, 391, 12, 43, '3599.00', '0.00', '2023-09-18 10:57:00', '2023-09-18 10:57:00'),
(963, 391, 12, 42, '725.00', '0.00', '2023-09-18 10:57:00', '2023-09-18 10:57:00'),
(964, 391, 12, 40, '275.00', '0.00', '2023-09-18 10:57:00', '2023-09-18 10:57:00'),
(969, 409, 12, 41, '525.00', '0.00', '2023-09-18 10:58:00', '2023-09-18 10:58:00'),
(970, 409, 12, 43, '3799.00', '0.00', '2023-09-18 10:58:00', '2023-09-18 10:58:00'),
(971, 409, 12, 42, '745.00', '0.00', '2023-09-18 10:58:00', '2023-09-18 10:58:00'),
(972, 409, 12, 40, '295.00', '0.00', '2023-09-18 10:58:00', '2023-09-18 10:58:00'),
(973, 408, 12, 41, '525.00', '0.00', '2023-09-18 10:58:00', '2023-09-18 10:58:00'),
(974, 408, 12, 43, '3799.00', '0.00', '2023-09-18 10:58:00', '2023-09-18 10:58:00'),
(975, 408, 12, 42, '745.00', '0.00', '2023-09-18 10:58:00', '2023-09-18 10:58:00'),
(976, 408, 12, 40, '295.00', '0.00', '2023-09-18 10:58:00', '2023-09-18 10:58:00'),
(977, 407, 12, 41, '465.00', '0.00', '2023-09-18 10:58:00', '2023-09-18 10:58:00'),
(978, 407, 12, 43, '3299.00', '0.00', '2023-09-18 10:58:00', '2023-09-18 10:58:00'),
(979, 407, 12, 42, '675.00', '0.00', '2023-09-18 10:58:00', '2023-09-18 10:58:00'),
(980, 407, 12, 40, '255.00', '0.00', '2023-09-18 10:58:00', '2023-09-18 10:58:00'),
(981, 406, 12, 41, '465.00', '0.00', '2023-09-18 10:58:00', '2023-09-18 10:58:00'),
(982, 406, 12, 43, '3299.00', '0.00', '2023-09-18 10:58:00', '2023-09-18 10:58:00'),
(983, 406, 12, 42, '675.00', '0.00', '2023-09-18 10:58:00', '2023-09-18 10:58:00'),
(984, 406, 12, 40, '255.00', '0.00', '2023-09-18 10:58:00', '2023-09-18 10:58:00'),
(985, 405, 12, 41, '275.00', '0.00', '2023-09-18 10:59:00', '2023-09-18 10:59:00'),
(986, 405, 12, 43, '1799.00', '0.00', '2023-09-18 10:59:00', '2023-09-18 10:59:00'),
(987, 405, 12, 42, '395.00', '0.00', '2023-09-18 10:59:00', '2023-09-18 10:59:00'),
(988, 405, 12, 40, '155.00', '0.00', '2023-09-18 10:59:00', '2023-09-18 10:59:00'),
(989, 404, 12, 41, '275.00', '0.00', '2023-09-18 10:59:00', '2023-09-18 10:59:00'),
(990, 404, 12, 43, '1799.00', '0.00', '2023-09-18 10:59:00', '2023-09-18 10:59:00'),
(991, 404, 12, 42, '395.00', '0.00', '2023-09-18 10:59:00', '2023-09-18 10:59:00'),
(992, 404, 12, 40, '155.00', '0.00', '2023-09-18 10:59:00', '2023-09-18 10:59:00'),
(993, 403, 12, 41, '845.00', '0.00', '2023-09-18 10:59:00', '2023-09-18 10:59:00'),
(994, 403, 12, 43, '6499.00', '0.00', '2023-09-18 10:59:00', '2023-09-18 10:59:00'),
(995, 403, 12, 42, '1195.00', '0.00', '2023-09-18 10:59:00', '2023-09-18 10:59:00'),
(996, 403, 12, 40, '445.00', '0.00', '2023-09-18 10:59:00', '2023-09-18 10:59:00'),
(997, 402, 12, 41, '845.00', '0.00', '2023-09-18 10:59:00', '2023-09-18 10:59:00'),
(998, 402, 12, 43, '6499.00', '0.00', '2023-09-18 10:59:00', '2023-09-18 10:59:00'),
(999, 402, 12, 42, '1195.00', '0.00', '2023-09-18 10:59:00', '2023-09-18 10:59:00'),
(1000, 402, 12, 40, '445.00', '0.00', '2023-09-18 10:59:00', '2023-09-18 10:59:00'),
(1001, 401, 12, 41, '695.00', '0.00', '2023-09-18 11:00:00', '2023-09-18 11:00:00'),
(1002, 401, 12, 43, '5299.00', '0.00', '2023-09-18 11:00:00', '2023-09-18 11:00:00'),
(1003, 401, 12, 42, '995.00', '0.00', '2023-09-18 11:00:00', '2023-09-18 11:00:00'),
(1004, 401, 12, 40, '375.00', '0.00', '2023-09-18 11:00:00', '2023-09-18 11:00:00'),
(1005, 411, 12, 41, '595.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1006, 411, 12, 43, '4699.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1007, 411, 12, 42, '875.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1008, 411, 12, 40, '325.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1009, 410, 12, 41, '595.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1010, 410, 12, 43, '4699.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1011, 410, 12, 42, '875.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1012, 410, 12, 40, '325.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1013, 413, 12, 41, '445.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1014, 413, 12, 43, '2999.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1015, 413, 12, 42, '645.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1016, 413, 12, 40, '245.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1017, 412, 12, 41, '445.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1018, 412, 12, 43, '2999.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1019, 412, 12, 42, '645.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1020, 412, 12, 40, '245.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1021, 415, 12, 41, '645.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1022, 415, 12, 43, '4999.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1023, 415, 12, 42, '925.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1024, 415, 12, 40, '345.00', '0.00', '2023-09-18 11:01:00', '2023-09-18 11:01:00'),
(1025, 414, 12, 41, '645.00', '0.00', '2023-09-18 11:02:00', '2023-09-18 11:02:00'),
(1026, 414, 12, 43, '4999.00', '0.00', '2023-09-18 11:02:00', '2023-09-18 11:02:00'),
(1027, 414, 12, 42, '925.00', '0.00', '2023-09-18 11:02:00', '2023-09-18 11:02:00'),
(1028, 414, 12, 40, '345.00', '0.00', '2023-09-18 11:02:00', '2023-09-18 11:02:00'),
(1031, 430, 15, 48, '495.00', '0.00', '2023-09-18 11:03:00', '2023-09-18 11:03:00'),
(1032, 430, 15, 49, '0.00', '0.00', '2023-09-18 11:03:00', '2023-09-18 11:03:00'),
(1033, 431, 15, 48, '495.00', '0.00', '2023-09-18 11:03:00', '2023-09-18 11:03:00'),
(1034, 431, 15, 49, '0.00', '0.00', '2023-09-18 11:03:00', '2023-09-18 11:03:00'),
(1035, 417, 12, 41, '645.00', '0.00', '2023-09-18 11:04:00', '2023-09-18 11:04:00'),
(1036, 417, 12, 43, '4999.00', '0.00', '2023-09-18 11:04:00', '2023-09-18 11:04:00'),
(1037, 417, 12, 42, '925.00', '0.00', '2023-09-18 11:04:00', '2023-09-18 11:04:00'),
(1038, 417, 12, 40, '345.00', '0.00', '2023-09-18 11:04:00', '2023-09-18 11:04:00'),
(1039, 416, 12, 41, '645.00', '0.00', '2023-09-18 11:04:00', '2023-09-18 11:04:00'),
(1040, 416, 12, 43, '4999.00', '0.00', '2023-09-18 11:04:00', '2023-09-18 11:04:00'),
(1041, 416, 12, 42, '925.00', '0.00', '2023-09-18 11:04:00', '2023-09-18 11:04:00'),
(1042, 416, 12, 40, '345.00', '0.00', '2023-09-18 11:04:00', '2023-09-18 11:04:00'),
(1043, 419, 13, 44, '295.00', '0.00', '2023-09-18 11:04:00', '2023-09-18 11:04:00'),
(1044, 419, 13, 45, '995.00', '0.00', '2023-09-18 11:04:00', '2023-09-18 11:04:00'),
(1045, 418, 13, 44, '295.00', '0.00', '2023-09-18 11:05:00', '2023-09-18 11:05:00'),
(1046, 418, 13, 45, '995.00', '0.00', '2023-09-18 11:05:00', '2023-09-18 11:05:00'),
(1047, 421, 15, 48, '345.00', '0.00', '2023-09-18 11:05:00', '2023-09-18 11:05:00'),
(1048, 421, 15, 49, '0.00', '0.00', '2023-09-18 11:05:00', '2023-09-18 11:05:00'),
(1049, 420, 15, 48, '345.00', '0.00', '2023-09-18 11:05:00', '2023-09-18 11:05:00'),
(1050, 420, 15, 49, '0.00', '0.00', '2023-09-18 11:05:00', '2023-09-18 11:05:00'),
(1051, 423, 15, 48, '345.00', '0.00', '2023-09-18 11:06:00', '2023-09-18 11:06:00'),
(1052, 423, 15, 49, '1295.00', '0.00', '2023-09-18 11:06:00', '2023-09-18 11:06:00'),
(1053, 422, 15, 48, '345.00', '0.00', '2023-09-18 11:06:00', '2023-09-18 11:06:00'),
(1054, 422, 15, 49, '1295.00', '0.00', '2023-09-18 11:06:00', '2023-09-18 11:06:00'),
(1055, 425, 15, 48, '375.00', '0.00', '2023-09-18 11:06:00', '2023-09-18 11:06:00'),
(1056, 425, 15, 49, '0.00', '0.00', '2023-09-18 11:06:00', '2023-09-18 11:06:00'),
(1057, 424, 15, 48, '375.00', '0.00', '2023-09-18 11:06:00', '2023-09-18 11:06:00'),
(1058, 424, 15, 49, '0.00', '0.00', '2023-09-18 11:06:00', '2023-09-18 11:06:00'),
(1059, 427, 14, 46, '425.00', '0.00', '2023-09-18 11:07:00', '2023-09-18 11:07:00'),
(1060, 427, 14, 47, '0.00', '0.00', '2023-09-18 11:07:00', '2023-09-18 11:07:00'),
(1061, 426, 14, 46, '425.00', '0.00', '2023-09-18 11:07:00', '2023-09-18 11:07:00'),
(1062, 426, 14, 47, '0.00', '0.00', '2023-09-18 11:07:00', '2023-09-18 11:07:00'),
(1063, 429, 15, 48, '445.00', '0.00', '2023-09-18 11:07:00', '2023-09-18 11:07:00'),
(1064, 429, 15, 49, '1695.00', '0.00', '2023-09-18 11:07:00', '2023-09-18 11:07:00'),
(1065, 428, 15, 48, '445.00', '0.00', '2023-09-18 11:07:00', '2023-09-18 11:07:00'),
(1066, 428, 15, 49, '1695.00', '0.00', '2023-09-18 11:07:00', '2023-09-18 11:07:00'),
(1067, 437, 16, 50, '0.00', '0.00', '2023-09-18 11:08:00', '2023-09-18 11:08:00'),
(1068, 437, 16, 51, '795.00', '0.00', '2023-09-18 11:08:00', '2023-09-18 11:08:00'),
(1069, 437, 16, 52, '0.00', '0.00', '2023-09-18 11:08:00', '2023-09-18 11:08:00'),
(1070, 436, 16, 50, '0.00', '0.00', '2023-09-18 11:08:00', '2023-09-18 11:08:00'),
(1071, 436, 16, 51, '795.00', '0.00', '2023-09-18 11:08:00', '2023-09-18 11:08:00'),
(1072, 436, 16, 52, '0.00', '0.00', '2023-09-18 11:08:00', '2023-09-18 11:08:00'),
(1073, 439, 16, 50, '795.00', '0.00', '2023-09-18 11:08:00', '2023-09-18 11:08:00'),
(1074, 439, 16, 51, '0.00', '0.00', '2023-09-18 11:08:00', '2023-09-18 11:08:00'),
(1075, 439, 16, 52, '2195.00', '0.00', '2023-09-18 11:08:00', '2023-09-18 11:08:00'),
(1076, 438, 16, 50, '795.00', '0.00', '2023-09-18 11:08:00', '2023-09-18 11:08:00'),
(1077, 438, 16, 51, '0.00', '0.00', '2023-09-18 11:08:00', '2023-09-18 11:08:00'),
(1078, 438, 16, 52, '2195.00', '0.00', '2023-09-18 11:08:00', '2023-09-18 11:08:00'),
(1079, 443, 14, 46, '425.00', '0.00', '2023-09-18 11:08:00', '2023-09-18 11:08:00'),
(1080, 443, 14, 47, '0.00', '0.00', '2023-09-18 11:08:00', '2023-09-18 11:08:00'),
(1081, 442, 14, 46, '425.00', '0.00', '2023-09-18 11:09:00', '2023-09-18 11:09:00'),
(1082, 442, 14, 47, '0.00', '0.00', '2023-09-18 11:09:00', '2023-09-18 11:09:00'),
(1083, 541, 10, 34, '295.00', '0.00', '2023-09-18 11:12:00', '2023-09-18 11:12:00'),
(1084, 541, 10, 35, '545.00', '0.00', '2023-09-18 11:12:00', '2023-09-18 11:12:00'),
(1085, 541, 10, 36, '925.00', '0.00', '2023-09-18 11:12:00', '2023-09-18 11:12:00'),
(1086, 541, 10, 37, '1295.00', '0.00', '2023-09-18 11:12:00', '2023-09-18 11:12:00'),
(1087, 541, 10, 33, '255.00', '0.00', '2023-09-18 11:12:00', '2023-09-18 11:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `ptypes`
--

CREATE TABLE `ptypes` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ptypes`
--

INSERT INTO `ptypes` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Drinks', 1, '2021-09-16 23:23:58', '2021-10-11 13:44:15'),
(2, 'Meals', 1, '2021-09-16 23:23:58', '2021-09-16 18:29:30');

-- --------------------------------------------------------

--
-- Table structure for table `public_notifications`
--

CREATE TABLE `public_notifications` (
  `id` int NOT NULL,
  `title` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `msg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `public_notifications`
--

INSERT INTO `public_notifications` (`id`, `title`, `msg`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test 123', '2023-06-22 19:52:07', '2023-06-22 19:52:07'),
(2, 'ddd', 'ddddd', '2023-06-22 19:55:24', '2023-06-22 19:55:24'),
(3, 'ddd', 'ddddd', '2023-06-22 19:56:08', '2023-06-22 19:56:08'),
(4, 'ddd', 'ddddd', '2023-06-22 19:56:14', '2023-06-22 19:56:14'),
(5, 'test', 'test', '2023-06-22 19:59:04', '2023-06-22 19:59:04');

-- --------------------------------------------------------

--
-- Table structure for table `refunds`
--

CREATE TABLE `refunds` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `refund_amount` varchar(255) NOT NULL,
  `product_id` int DEFAULT NULL,
  `status` varchar(25) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `updated_by` int NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_passport_user_order`
--

CREATE TABLE `restaurant_passport_user_order` (
  `id` int NOT NULL,
  `restaurant_id` int DEFAULT NULL,
  `passport_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `status` int NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `add_by` varchar(255) NOT NULL,
  `add_by_id` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `updated_by_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `category_id`, `status`, `created_at`, `updated_at`, `add_by`, `add_by_id`, `updated_by`, `updated_by_id`) VALUES
(1, 'test sub cat', 2, 1, '2021-12-21 15:36:01', '2021-12-21 15:36:17', '', '', '', ''),
(2, 'test sub category', 23, 1, '2021-12-22 10:05:50', '2021-12-22 10:05:50', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sub_public_notifications`
--

CREATE TABLE `sub_public_notifications` (
  `id` int NOT NULL,
  `public_notifictions_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `is_read` int DEFAULT '0',
  `is_send` int DEFAULT '0',
  `created_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `superadmins`
--

CREATE TABLE `superadmins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `superadmins`
--

INSERT INTO `superadmins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@admin.com', '2021-10-10 11:24:41', '$2y$10$rp8Sz8oQD5kvadYzAwrM8eHGHLEOn4mXFpRcMh5gfv.ODDFFeua8O', 'f4nILkLF7LcBQXsscKcScSJTAFZDessDlMNENEwPE5dtx0YHCzItm1gD2h2x', '2021-10-10 11:24:41', '2023-03-13 08:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `upload_images`
--

CREATE TABLE `upload_images` (
  `id` int NOT NULL,
  `file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `upload_images`
--

INSERT INTO `upload_images` (`id`, `file`, `created_at`, `updated_at`) VALUES
(1, 'upload/banners/1634713242_1.jpg', '2021-10-20 07:00:43', '2021-10-20 07:00:43'),
(2, 'upload/banners/1634713301_1.jpg', '2021-10-20 07:01:41', '2021-10-20 07:01:41'),
(3, 'upload/banners/1634713327_1.jpg', '2021-10-20 07:02:07', '2021-10-20 07:02:07'),
(4, 'upload/locations/1634713424_icon1.png', '2021-10-20 07:03:44', '2021-10-20 07:03:44'),
(5, 'upload/locations/1634713440_icon1.png', '2021-10-20 07:04:00', '2021-10-20 07:04:00'),
(6, 'upload/locations/1634713454_icon1.png', '2021-10-20 07:04:14', '2021-10-20 07:04:14'),
(7, 'upload/places/icons/1634714952_icon1.png', '2021-10-20 07:29:12', '2021-10-20 07:29:12'),
(8, 'upload/places/multiple/1634715005_2.webp', '2021-10-20 07:30:05', '2021-10-20 07:30:05'),
(9, 'upload/places/multiple/1634715317_2.webp', '2021-10-20 07:35:17', '2021-10-20 07:35:17'),
(10, 'upload/places/icons/1634715381_icon1.png', '2021-10-20 07:36:21', '2021-10-20 07:36:21'),
(11, 'upload/places/1634715408_icon1.png', '2021-10-20 07:36:48', '2021-10-20 07:36:48'),
(12, 'upload/places/icons/1634715513_icon1.png', '2021-10-20 07:38:33', '2021-10-20 07:38:33'),
(13, 'upload/places/1634715592_2.jpg', '2021-10-20 07:39:52', '2021-10-20 07:39:52'),
(14, 'upload/places/icons/1634715678_icon1.png', '2021-10-20 07:41:18', '2021-10-20 07:41:18'),
(15, 'upload/places/multiple/1634715697_2.webp', '2021-10-20 07:41:37', '2021-10-20 07:41:37'),
(16, 'upload/places/icons/1634715759_icon1.png', '2021-10-20 07:42:39', '2021-10-20 07:42:39'),
(17, 'upload/places/1634715765_2.jpg', '2021-10-20 07:42:45', '2021-10-20 07:42:45'),
(18, 'upload/places/multiple/1634715775_2.webp', '2021-10-20 07:42:55', '2021-10-20 07:42:55'),
(19, 'upload/places/icons/1634715806_icon1.png', '2021-10-20 07:43:26', '2021-10-20 07:43:26'),
(20, 'upload/places/1634715816_2.jpg', '2021-10-20 07:43:36', '2021-10-20 07:43:36'),
(21, 'upload/places/multiple/1634715825_2.webp', '2021-10-20 07:43:45', '2021-10-20 07:43:45'),
(22, 'upload/places/icons/1634715867_icon1.png', '2021-10-20 07:44:27', '2021-10-20 07:44:27'),
(23, 'upload/places/1634715872_2.jpg', '2021-10-20 07:44:32', '2021-10-20 07:44:32'),
(24, 'upload/places/multiple/1634715882_2.webp', '2021-10-20 07:44:42', '2021-10-20 07:44:42'),
(25, 'upload/places/icons/1634715930_icon1.png', '2021-10-20 07:45:30', '2021-10-20 07:45:30'),
(26, 'upload/places/1634715938_2.jpg', '2021-10-20 07:45:38', '2021-10-20 07:45:38'),
(27, 'upload/places/multiple/1634715943_2.webp', '2021-10-20 07:45:43', '2021-10-20 07:45:43'),
(28, 'upload/places/icons/1634715992_icon1.png', '2021-10-20 07:46:32', '2021-10-20 07:46:32'),
(29, 'upload/places/1634715999_2.jpg', '2021-10-20 07:46:39', '2021-10-20 07:46:39'),
(30, 'upload/places/multiple/1634716004_2.webp', '2021-10-20 07:46:44', '2021-10-20 07:46:44'),
(31, 'upload/places/icons/1634716048_icon1.png', '2021-10-20 07:47:28', '2021-10-20 07:47:28'),
(32, 'upload/places/1634716057_2.jpg', '2021-10-20 07:47:37', '2021-10-20 07:47:37'),
(33, 'upload/places/multiple/1634716061_2.webp', '2021-10-20 07:47:41', '2021-10-20 07:47:41'),
(34, 'upload/products/1634719014_layer2.png', '2021-10-20 08:36:54', '2021-10-20 08:36:54'),
(35, 'upload/products/1634719036_layer1.png', '2021-10-20 08:37:16', '2021-10-20 08:37:16'),
(36, 'upload/products/1634719326_layer1.png', '2021-10-20 08:42:06', '2021-10-20 08:42:06'),
(37, 'upload/products/1634719496_layer2.png', '2021-10-20 08:44:56', '2021-10-20 08:44:56'),
(38, 'upload/products/1634719657_layer3.png', '2021-10-20 08:47:37', '2021-10-20 08:47:37'),
(39, 'upload/products/1634719776_layer4.png', '2021-10-20 08:49:36', '2021-10-20 08:49:36'),
(40, 'upload/products/1634719909_layer5.png', '2021-10-20 08:51:49', '2021-10-20 08:51:49'),
(41, 'upload/products/1634720054_layer6.png', '2021-10-20 08:54:14', '2021-10-20 08:54:14'),
(42, 'upload/products/1634725417_img1.png', '2021-10-20 10:23:37', '2021-10-20 10:23:37'),
(43, 'upload/products/1634725523_img1.png', '2021-10-20 10:25:23', '2021-10-20 10:25:23'),
(44, 'upload/products/1634725593_img1.png', '2021-10-20 10:26:33', '2021-10-20 10:26:33'),
(45, 'upload/products/1634725757_img1.png', '2021-10-20 10:29:17', '2021-10-20 10:29:17'),
(46, 'upload/products/1634725810_img1.png', '2021-10-20 10:30:10', '2021-10-20 10:30:10'),
(47, 'upload/products/1634725871_img1.png', '2021-10-20 10:31:11', '2021-10-20 10:31:11'),
(48, 'upload/products/1634725924_img1.png', '2021-10-20 10:32:04', '2021-10-20 10:32:04'),
(49, 'upload/offers/1634796800_img2.png', '2021-10-21 06:13:20', '2021-10-21 06:13:20'),
(50, 'upload/offers/1634796999_2.jpg', '2021-10-21 06:16:39', '2021-10-21 06:16:39'),
(51, 'upload/offers/1634797035_2.jpg', '2021-10-21 06:17:15', '2021-10-21 06:17:15'),
(52, 'upload/offers/1634797097_2.jpg', '2021-10-21 06:18:17', '2021-10-21 06:18:17'),
(53, 'upload/offers/1634797133_2.jpg', '2021-10-21 06:18:53', '2021-10-21 06:18:53'),
(54, 'upload/offers/1634797341_2.jpg', '2021-10-21 06:22:21', '2021-10-21 06:22:21'),
(55, 'upload/passport/1634829284_img.jpg', '2021-10-21 15:14:44', '2021-10-21 15:14:44'),
(56, 'upload/passport/1634829326_img.jpg', '2021-10-21 15:15:26', '2021-10-21 15:15:26'),
(57, 'upload/passport/1634829361_img.jpg', '2021-10-21 15:16:01', '2021-10-21 15:16:01'),
(58, 'upload/places/icons/1636635220_nature-hd-for-pc-download-1920x1080-wallpaper-preview.jpg', '2021-11-11 12:53:40', '2021-11-11 12:53:40'),
(59, 'upload/places/1636635227_collage (1).jpg', '2021-11-11 12:53:47', '2021-11-11 12:53:47'),
(60, 'upload/places/multiple/1636635231_nature-hd-for-pc-download-1920x1080-wallpaper-preview.webp', '2021-11-11 12:53:51', '2021-11-11 12:53:51'),
(61, 'upload/places/multiple/1636635246_wp78987.webp', '2021-11-11 12:54:06', '2021-11-11 12:54:06'),
(62, 'upload/places/multiple/1636635246_6-66420_full-hd-1080p-wallpapers-desktop-backgrounds-hd.webp', '2021-11-11 12:54:06', '2021-11-11 12:54:06'),
(63, 'upload/products/1636635435_wp78987.jpg', '2021-11-11 12:57:15', '2021-11-11 12:57:15'),
(64, 'upload/offers/1636984183_Italian Menu-Family Meals.jpeg', '2021-11-15 13:49:43', '2021-11-15 13:49:43'),
(65, 'upload/banners/1636984255_passport (1).jpeg', '2021-11-15 13:50:55', '2021-11-15 13:50:55'),
(66, 'upload/locations/1636984315_passport (2).jpeg', '2021-11-15 13:51:55', '2021-11-15 13:51:55'),
(67, 'upload/places/icons/1636984416_Italian Menu-Family Meals.jpeg', '2021-11-15 13:53:36', '2021-11-15 13:53:36'),
(68, 'upload/places/1636984422_passport (2).jpeg', '2021-11-15 13:53:42', '2021-11-15 13:53:42'),
(69, 'upload/places/multiple/1636984426_WhatsApp Image 2021-05-29 at 1.50.48 PM (1).webp', '2021-11-15 13:53:46', '2021-11-15 13:53:46'),
(70, 'upload/products/1636984817_WhatsApp Image 2021-05-29 at 1.50.48 PM (1).jpeg', '2021-11-15 14:00:17', '2021-11-15 14:00:17'),
(71, 'upload/passport/1636984925_WhatsApp Image 2021-05-29 at 1.50.48 PM (1).jpeg', '2021-11-15 14:02:05', '2021-11-15 14:02:05'),
(72, 'upload/products/1637043693_favicon.png', '2021-11-16 06:21:33', '2021-11-16 06:21:33'),
(73, 'upload/locations/1637043739_favicon.png', '2021-11-16 06:22:19', '2021-11-16 06:22:19'),
(74, 'upload/locations/1637043770_favicon.png', '2021-11-16 06:22:50', '2021-11-16 06:22:50'),
(75, 'upload/passport/1637044424_favicon.png', '2021-11-16 06:33:44', '2021-11-16 06:33:44'),
(76, 'upload/products/1637058985_favicon.png', '2021-11-16 10:36:25', '2021-11-16 10:36:25'),
(77, 'upload/passport/1637059043_favicon.png', '2021-11-16 10:37:23', '2021-11-16 10:37:23'),
(78, 'upload/passport/1637062191_favicon.png', '2021-11-16 11:29:51', '2021-11-16 11:29:51'),
(79, 'upload/passport/1637062285_favicon.png', '2021-11-16 11:31:25', '2021-11-16 11:31:25'),
(80, 'upload/offers/1638015816_this week (1).jpeg', '2021-11-27 12:23:36', '2021-11-27 12:23:36'),
(81, 'upload/products/1638974439_dtModel03.jpg', '2021-12-08 14:40:39', '2021-12-08 14:40:39'),
(82, 'upload/passport/1639068694_E5woKdEWQAIqZET.jpg', '2021-12-09 16:51:34', '2021-12-09 16:51:34'),
(83, 'upload/passport/1639068704_nature-hd-for-pc-download-1920x1080-wallpaper-preview.jpg', '2021-12-09 16:51:44', '2021-12-09 16:51:44'),
(84, 'upload/banners/1639120220_nature-hd-for-pc-download-1920x1080-wallpaper-preview.jpg', '2021-12-10 07:10:20', '2021-12-10 07:10:20'),
(85, 'upload/banners/1639120235_wp78987.jpg', '2021-12-10 07:10:35', '2021-12-10 07:10:35'),
(86, 'upload/passport/1639122027_Shiva-Wallpaper-Golden-Morning.jpg', '2021-12-10 07:40:27', '2021-12-10 07:40:27'),
(87, 'upload/passport/1639124296_nature-hd-for-pc-download-1920x1080-wallpaper-preview.jpg', '2021-12-10 08:18:16', '2021-12-10 08:18:16'),
(88, 'upload/places/1639836964_Desert.jpg', '2021-12-18 14:16:04', '2021-12-18 14:16:04'),
(89, 'upload/places/1639837001_1634713242_1.jpg', '2021-12-18 14:16:41', '2021-12-18 14:16:41'),
(90, 'upload/locations/1639994279_1634713424_icon1.png', '2021-12-20 09:57:59', '2021-12-20 09:57:59'),
(91, 'upload/locations/1639994295_1634713424_icon1.png', '2021-12-20 09:58:15', '2021-12-20 09:58:15'),
(92, 'upload/places/icons/1639994645_1634716048_icon1.png', '2021-12-20 10:04:05', '2021-12-20 10:04:05'),
(93, 'upload/places/1639994677_0005.jpg', '2021-12-20 10:04:37', '2021-12-20 10:04:37'),
(94, 'upload/places/multiple/1639994687_0002.webp', '2021-12-20 10:04:47', '2021-12-20 10:04:47'),
(95, 'upload/places/multiple/1639994687_0003.webp', '2021-12-20 10:04:47', '2021-12-20 10:04:47'),
(96, 'upload/places/multiple/1639994687_0004.webp', '2021-12-20 10:04:47', '2021-12-20 10:04:47'),
(97, 'upload/places/multiple/1639994687_0005.webp', '2021-12-20 10:04:47', '2021-12-20 10:04:47'),
(98, 'upload/places/multiple/1639994687_0006.webp', '2021-12-20 10:04:47', '2021-12-20 10:04:47'),
(99, 'upload/places/icons/1639994970_1634716048_icon1.png', '2021-12-20 10:09:30', '2021-12-20 10:09:30'),
(100, 'upload/places/1639995075_0007.webp', '2021-12-20 10:11:15', '2021-12-20 10:11:15'),
(101, 'upload/places/multiple/1639995084_0001.webp', '2021-12-20 10:11:24', '2021-12-20 10:11:24'),
(102, 'upload/places/multiple/1639995084_0002.webp', '2021-12-20 10:11:24', '2021-12-20 10:11:24'),
(103, 'upload/places/multiple/1639995084_0003.webp', '2021-12-20 10:11:24', '2021-12-20 10:11:24'),
(104, 'upload/places/multiple/1639995084_0004.webp', '2021-12-20 10:11:24', '2021-12-20 10:11:24'),
(105, 'upload/places/multiple/1639995084_0005.webp', '2021-12-20 10:11:24', '2021-12-20 10:11:24'),
(106, 'upload/places/multiple/1639995084_0006.webp', '2021-12-20 10:11:24', '2021-12-20 10:11:24'),
(107, 'upload/places/multiple/1639997700_4X3A2720.webp', '2021-12-20 10:55:00', '2021-12-20 10:55:00'),
(108, 'upload/places/multiple/1639997721_4X3A2722.webp', '2021-12-20 10:55:21', '2021-12-20 10:55:21'),
(109, 'upload/places/multiple/1639997721_4X3A2715.webp', '2021-12-20 10:55:21', '2021-12-20 10:55:21'),
(110, 'upload/places/1640003482_1634716048_icon1.png', '2021-12-20 12:31:22', '2021-12-20 12:31:22'),
(111, 'upload/places/multiple/1640003591_4X3A2735.webp', '2021-12-20 12:33:11', '2021-12-20 12:33:11'),
(112, 'upload/places/multiple/1640003591_4X3A2733.webp', '2021-12-20 12:33:11', '2021-12-20 12:33:11'),
(113, 'upload/places/multiple/1640003591_4X3A2715.webp', '2021-12-20 12:33:11', '2021-12-20 12:33:11'),
(114, 'upload/places/multiple/1640003591_4X3A2722.webp', '2021-12-20 12:33:11', '2021-12-20 12:33:11'),
(115, 'upload/places/multiple/1640003591_4X3A2631.webp', '2021-12-20 12:33:11', '2021-12-20 12:33:11'),
(116, 'upload/places/multiple/1640003591_4X3A2633.webp', '2021-12-20 12:33:11', '2021-12-20 12:33:11'),
(117, 'upload/places/multiple/1640003591_4X3A2635.webp', '2021-12-20 12:33:11', '2021-12-20 12:33:11'),
(118, 'upload/places/multiple/1640003591_4X3A2692.webp', '2021-12-20 12:33:11', '2021-12-20 12:33:11'),
(119, 'upload/places/icons/1640003736_1634716048_icon1.png', '2021-12-20 12:35:36', '2021-12-20 12:35:36'),
(120, 'upload/places/icons/1640003943_4X3A26923.jpg', '2021-12-20 12:39:03', '2021-12-20 12:39:03'),
(121, 'upload/products/1640074439_1634725810_img1.png', '2021-12-21 08:13:59', '2021-12-21 08:13:59'),
(122, 'upload/products/1640074511_1634725810_img1.png', '2021-12-21 08:15:11', '2021-12-21 08:15:11'),
(123, 'upload/products/1640074576_1634725810_img1.png', '2021-12-21 08:16:16', '2021-12-21 08:16:16'),
(124, 'upload/products/1640074992_1634725810_img1.png', '2021-12-21 08:23:12', '2021-12-21 08:23:12'),
(125, 'upload/products/1640075108_1634725810_img1.png', '2021-12-21 08:25:08', '2021-12-21 08:25:08'),
(126, 'upload/products/1640075225_1634725810_img1.png', '2021-12-21 08:27:05', '2021-12-21 08:27:05'),
(127, 'upload/products/1640075268_1640074439_1634725810_img1.png', '2021-12-21 08:27:48', '2021-12-21 08:27:48'),
(128, 'upload/products/1640075402_1634725810_img1.png', '2021-12-21 08:30:02', '2021-12-21 08:30:02'),
(129, 'upload/products/1640075530_1640074439_1634725810_img1.png', '2021-12-21 08:32:10', '2021-12-21 08:32:10'),
(130, 'upload/products/1640075535_1634725810_img1.png', '2021-12-21 08:32:15', '2021-12-21 08:32:15'),
(131, 'upload/products/1640075598_1640074439_1634725810_img1.png', '2021-12-21 08:33:18', '2021-12-21 08:33:18'),
(132, 'upload/products/1640075647_1640074439_1634725810_img1.png', '2021-12-21 08:34:07', '2021-12-21 08:34:07'),
(133, 'upload/products/1640075650_1634725810_img1.png', '2021-12-21 08:34:10', '2021-12-21 08:34:10'),
(134, 'upload/products/1640075689_1640074439_1634725810_img1.png', '2021-12-21 08:34:49', '2021-12-21 08:34:49'),
(135, 'upload/products/1640075745_1640074439_1634725810_img1.png', '2021-12-21 08:35:45', '2021-12-21 08:35:45'),
(136, 'upload/products/1640075785_1634725810_img1.png', '2021-12-21 08:36:25', '2021-12-21 08:36:25'),
(137, 'upload/products/1640075864_1640074439_1634725810_img1.png', '2021-12-21 08:37:44', '2021-12-21 08:37:44'),
(138, 'upload/products/1640075919_1634725810_img1.png', '2021-12-21 08:38:39', '2021-12-21 08:38:39'),
(139, 'upload/products/1640076047_1634725810_img1.png', '2021-12-21 08:40:47', '2021-12-21 08:40:47'),
(140, 'upload/products/1640076053_1640074439_1634725810_img1.png', '2021-12-21 08:40:53', '2021-12-21 08:40:53'),
(141, 'upload/products/1640076097_1640074439_1634725810_img1.png', '2021-12-21 08:41:37', '2021-12-21 08:41:37'),
(142, 'upload/products/1640076168_1640074439_1634725810_img1.png', '2021-12-21 08:42:48', '2021-12-21 08:42:48'),
(143, 'upload/products/1640076190_1634725810_img1.png', '2021-12-21 08:43:10', '2021-12-21 08:43:10'),
(144, 'upload/products/1640076217_1640074439_1634725810_img1.png', '2021-12-21 08:43:37', '2021-12-21 08:43:37'),
(145, 'upload/products/1640076271_1640074439_1634725810_img1.png', '2021-12-21 08:44:31', '2021-12-21 08:44:31'),
(146, 'upload/products/1640076366_1640074439_1634725810_img1.png', '2021-12-21 08:46:06', '2021-12-21 08:46:06'),
(147, 'upload/products/1640076417_1640074439_1634725810_img1.png', '2021-12-21 08:46:57', '2021-12-21 08:46:57'),
(148, 'upload/products/1640076462_1640074439_1634725810_img1.png', '2021-12-21 08:47:42', '2021-12-21 08:47:42'),
(149, 'upload/products/1640076514_1640074439_1634725810_img1.png', '2021-12-21 08:48:34', '2021-12-21 08:48:34'),
(150, 'upload/products/1640076574_1640074439_1634725810_img1.png', '2021-12-21 08:49:34', '2021-12-21 08:49:34'),
(151, 'upload/products/1640076622_1640074439_1634725810_img1.png', '2021-12-21 08:50:22', '2021-12-21 08:50:22'),
(152, 'upload/products/1640076669_1640074439_1634725810_img1.png', '2021-12-21 08:51:09', '2021-12-21 08:51:09'),
(153, 'upload/products/1640076716_1640074439_1634725810_img1.png', '2021-12-21 08:51:56', '2021-12-21 08:51:56'),
(154, 'upload/products/1640076768_1640074439_1634725810_img1.png', '2021-12-21 08:52:48', '2021-12-21 08:52:48'),
(155, 'upload/products/1640076819_1640074439_1634725810_img1.png', '2021-12-21 08:53:39', '2021-12-21 08:53:39'),
(156, 'upload/products/1640076868_1640074439_1634725810_img1.png', '2021-12-21 08:54:28', '2021-12-21 08:54:28'),
(157, 'upload/products/1640076921_1640074439_1634725810_img1.png', '2021-12-21 08:55:21', '2021-12-21 08:55:21'),
(158, 'upload/products/1640076961_1640074439_1634725810_img1.png', '2021-12-21 08:56:01', '2021-12-21 08:56:01'),
(159, 'upload/products/1640077011_1640074439_1634725810_img1.png', '2021-12-21 08:56:51', '2021-12-21 08:56:51'),
(160, 'upload/products/1640077076_1640074439_1634725810_img1.png', '2021-12-21 08:57:56', '2021-12-21 08:57:56'),
(161, 'upload/products/1640077124_1640074439_1634725810_img1.png', '2021-12-21 08:58:44', '2021-12-21 08:58:44'),
(162, 'upload/products/1640077196_1640074439_1634725810_img1.png', '2021-12-21 08:59:56', '2021-12-21 08:59:56'),
(163, 'upload/products/1640077304_1640074439_1634725810_img1.png', '2021-12-21 09:01:44', '2021-12-21 09:01:44'),
(164, 'upload/products/1640077369_1640074439_1634725810_img1.png', '2021-12-21 09:02:49', '2021-12-21 09:02:49'),
(165, 'upload/products/1640077458_1640074439_1634725810_img1.png', '2021-12-21 09:04:18', '2021-12-21 09:04:18'),
(166, 'upload/products/1640077551_1634725810_img1.png', '2021-12-21 09:05:51', '2021-12-21 09:05:51'),
(167, 'upload/products/1640077554_1640074439_1634725810_img1.png', '2021-12-21 09:05:54', '2021-12-21 09:05:54'),
(168, 'upload/products/1640077628_1640074439_1634725810_img1.png', '2021-12-21 09:07:08', '2021-12-21 09:07:08'),
(169, 'upload/products/1640077673_1634725810_img1.png', '2021-12-21 09:07:53', '2021-12-21 09:07:53'),
(170, 'upload/products/1640077696_1640074439_1634725810_img1.png', '2021-12-21 09:08:16', '2021-12-21 09:08:16'),
(171, 'upload/products/1640077780_1640074439_1634725810_img1.png', '2021-12-21 09:09:40', '2021-12-21 09:09:40'),
(172, 'upload/products/1640077781_1634725810_img1.png', '2021-12-21 09:09:41', '2021-12-21 09:09:41'),
(173, 'upload/products/1640077837_1640074439_1634725810_img1.png', '2021-12-21 09:10:37', '2021-12-21 09:10:37'),
(174, 'upload/products/1640077881_1634725810_img1.png', '2021-12-21 09:11:21', '2021-12-21 09:11:21'),
(175, 'upload/products/1640077914_1640074439_1634725810_img1.png', '2021-12-21 09:11:54', '2021-12-21 09:11:54'),
(176, 'upload/products/1640077978_1634725810_img1.png', '2021-12-21 09:12:58', '2021-12-21 09:12:58'),
(177, 'upload/products/1640077983_1640074439_1634725810_img1.png', '2021-12-21 09:13:03', '2021-12-21 09:13:03'),
(178, 'upload/products/1640078077_1634725810_img1.png', '2021-12-21 09:14:37', '2021-12-21 09:14:37'),
(179, 'upload/products/1640078167_1640074439_1634725810_img1.png', '2021-12-21 09:16:07', '2021-12-21 09:16:07'),
(180, 'upload/products/1640078234_1640074439_1634725810_img1.png', '2021-12-21 09:17:14', '2021-12-21 09:17:14'),
(181, 'upload/products/1640078263_1634725810_img1.png', '2021-12-21 09:17:43', '2021-12-21 09:17:43'),
(182, 'upload/products/1640078330_1640074439_1634725810_img1.png', '2021-12-21 09:18:50', '2021-12-21 09:18:50'),
(183, 'upload/products/1640078374_1634725810_img1.png', '2021-12-21 09:19:34', '2021-12-21 09:19:34'),
(184, 'upload/products/1640078418_1640074439_1634725810_img1.png', '2021-12-21 09:20:18', '2021-12-21 09:20:18'),
(185, 'upload/products/1640078522_1634725810_img1.png', '2021-12-21 09:22:02', '2021-12-21 09:22:02'),
(186, 'upload/products/1640078529_1640074439_1634725810_img1.png', '2021-12-21 09:22:09', '2021-12-21 09:22:09'),
(187, 'upload/products/1640078648_1634725810_img1.png', '2021-12-21 09:24:08', '2021-12-21 09:24:08'),
(188, 'upload/products/1640078734_1640074439_1634725810_img1.png', '2021-12-21 09:25:34', '2021-12-21 09:25:34'),
(189, 'upload/products/1640078852_1634725810_img1.png', '2021-12-21 09:27:32', '2021-12-21 09:27:32'),
(190, 'upload/products/1640078892_1640074439_1634725810_img1.png', '2021-12-21 09:28:12', '2021-12-21 09:28:12'),
(191, 'upload/products/1640078944_1634725810_img1.png', '2021-12-21 09:29:04', '2021-12-21 09:29:04'),
(192, 'upload/products/1640078957_1640074439_1634725810_img1.png', '2021-12-21 09:29:17', '2021-12-21 09:29:17'),
(193, 'upload/products/1640079006_1640074439_1634725810_img1.png', '2021-12-21 09:30:06', '2021-12-21 09:30:06'),
(194, 'upload/products/1640079100_1640074439_1634725810_img1.png', '2021-12-21 09:31:40', '2021-12-21 09:31:40'),
(195, 'upload/products/1640079129_1634725810_img1.png', '2021-12-21 09:32:09', '2021-12-21 09:32:09'),
(196, 'upload/products/1640079173_1640074439_1634725810_img1.png', '2021-12-21 09:32:53', '2021-12-21 09:32:53'),
(197, 'upload/products/1640079252_1640074439_1634725810_img1.png', '2021-12-21 09:34:12', '2021-12-21 09:34:12'),
(198, 'upload/products/1640079308_1634725810_img1.png', '2021-12-21 09:35:08', '2021-12-21 09:35:08'),
(199, 'upload/products/1640079329_1640074439_1634725810_img1.png', '2021-12-21 09:35:29', '2021-12-21 09:35:29'),
(200, 'upload/products/1640079411_1640074439_1634725810_img1.png', '2021-12-21 09:36:51', '2021-12-21 09:36:51'),
(201, 'upload/products/1640079414_1634725810_img1.png', '2021-12-21 09:36:54', '2021-12-21 09:36:54'),
(202, 'upload/products/1640079505_1634725810_img1.png', '2021-12-21 09:38:25', '2021-12-21 09:38:25'),
(203, 'upload/products/1640079549_1640074439_1634725810_img1.png', '2021-12-21 09:39:09', '2021-12-21 09:39:09'),
(204, 'upload/products/1640079612_1634725810_img1.png', '2021-12-21 09:40:12', '2021-12-21 09:40:12'),
(205, 'upload/products/1640079645_1640074439_1634725810_img1.png', '2021-12-21 09:40:45', '2021-12-21 09:40:45'),
(206, 'upload/products/1640079716_1640074439_1634725810_img1.png', '2021-12-21 09:41:56', '2021-12-21 09:41:56'),
(207, 'upload/products/1640079747_1634725810_img1.png', '2021-12-21 09:42:27', '2021-12-21 09:42:27'),
(208, 'upload/products/1640079804_1640074439_1634725810_img1.png', '2021-12-21 09:43:24', '2021-12-21 09:43:24'),
(209, 'upload/products/1640079862_1640074439_1634725810_img1.png', '2021-12-21 09:44:22', '2021-12-21 09:44:22'),
(210, 'upload/products/1640079909_1640074439_1634725810_img1.png', '2021-12-21 09:45:09', '2021-12-21 09:45:09'),
(211, 'upload/products/1640079927_1634725810_img1.png', '2021-12-21 09:45:27', '2021-12-21 09:45:27'),
(212, 'upload/products/1640079977_1640074439_1634725810_img1.png', '2021-12-21 09:46:17', '2021-12-21 09:46:17'),
(213, 'upload/products/1640080055_1634725810_img1.png', '2021-12-21 09:47:35', '2021-12-21 09:47:35'),
(214, 'upload/products/1640080072_1640074439_1634725810_img1.png', '2021-12-21 09:47:52', '2021-12-21 09:47:52'),
(215, 'upload/products/1640080117_1640074439_1634725810_img1.png', '2021-12-21 09:48:37', '2021-12-21 09:48:37'),
(216, 'upload/products/1640080171_1640074439_1634725810_img1.png', '2021-12-21 09:49:31', '2021-12-21 09:49:31'),
(217, 'upload/products/1640080178_1634725810_img1.png', '2021-12-21 09:49:38', '2021-12-21 09:49:38'),
(218, 'upload/products/1640080226_1640074439_1634725810_img1.png', '2021-12-21 09:50:26', '2021-12-21 09:50:26'),
(219, 'upload/products/1640080262_1634725810_img1.png', '2021-12-21 09:51:02', '2021-12-21 09:51:02'),
(220, 'upload/products/1640080279_1640074439_1634725810_img1.png', '2021-12-21 09:51:19', '2021-12-21 09:51:19'),
(221, 'upload/products/1640080332_1640074439_1634725810_img1.png', '2021-12-21 09:52:12', '2021-12-21 09:52:12'),
(222, 'upload/products/1640080370_1634725810_img1.png', '2021-12-21 09:52:50', '2021-12-21 09:52:50'),
(223, 'upload/products/1640080399_1640074439_1634725810_img1.png', '2021-12-21 09:53:19', '2021-12-21 09:53:19'),
(224, 'upload/products/1640080462_1640074439_1634725810_img1.png', '2021-12-21 09:54:22', '2021-12-21 09:54:22'),
(225, 'upload/products/1640080474_1634725810_img1.png', '2021-12-21 09:54:34', '2021-12-21 09:54:34'),
(226, 'upload/products/1640080548_1640074439_1634725810_img1.png', '2021-12-21 09:55:48', '2021-12-21 09:55:48'),
(227, 'upload/products/1640080608_1640074439_1634725810_img1.png', '2021-12-21 09:56:48', '2021-12-21 09:56:48'),
(228, 'upload/products/1640080615_1634725810_img1.png', '2021-12-21 09:56:55', '2021-12-21 09:56:55'),
(229, 'upload/products/1640080676_1640074439_1634725810_img1.png', '2021-12-21 09:57:56', '2021-12-21 09:57:56'),
(230, 'upload/products/1640080726_1640074439_1634725810_img1.png', '2021-12-21 09:58:46', '2021-12-21 09:58:46'),
(231, 'upload/products/1640080727_1634725810_img1.png', '2021-12-21 09:58:47', '2021-12-21 09:58:47'),
(232, 'upload/products/1640080770_1640074439_1634725810_img1.png', '2021-12-21 09:59:30', '2021-12-21 09:59:30'),
(233, 'upload/products/1640080802_1640074439_1634725810_img1.png', '2021-12-21 10:00:02', '2021-12-21 10:00:02'),
(234, 'upload/products/1640080836_1640074439_1634725810_img1.png', '2021-12-21 10:00:36', '2021-12-21 10:00:36'),
(235, 'upload/products/1640080840_1634725810_img1.png', '2021-12-21 10:00:40', '2021-12-21 10:00:40'),
(236, 'upload/products/1640080870_1640074439_1634725810_img1.png', '2021-12-21 10:01:10', '2021-12-21 10:01:10'),
(237, 'upload/products/1640080964_1634725810_img1.png', '2021-12-21 10:02:44', '2021-12-21 10:02:44'),
(238, 'upload/products/1640081203_1634725810_img1.png', '2021-12-21 10:06:43', '2021-12-21 10:06:43'),
(239, 'upload/products/1640081289_1634725810_img1.png', '2021-12-21 10:08:09', '2021-12-21 10:08:09'),
(240, 'upload/products/1640081450_1634725810_img1.png', '2021-12-21 10:10:50', '2021-12-21 10:10:50'),
(241, 'upload/products/1640081547_1634725810_img1.png', '2021-12-21 10:12:27', '2021-12-21 10:12:27'),
(242, 'upload/products/1640081771_1634725810_img1.png', '2021-12-21 10:16:11', '2021-12-21 10:16:11'),
(243, 'upload/products/1640081859_1634725810_img1.png', '2021-12-21 10:17:39', '2021-12-21 10:17:39'),
(244, 'upload/products/1640081963_1634725810_img1.png', '2021-12-21 10:19:23', '2021-12-21 10:19:23'),
(245, 'upload/products/1640082048_1634725810_img1.png', '2021-12-21 10:20:48', '2021-12-21 10:20:48'),
(246, 'upload/products/1640082141_1634725810_img1.png', '2021-12-21 10:22:21', '2021-12-21 10:22:21'),
(247, 'upload/products/1640082433_1634725810_img1.png', '2021-12-21 10:27:13', '2021-12-21 10:27:13'),
(248, 'upload/products/1640082517_1634725810_img1.png', '2021-12-21 10:28:37', '2021-12-21 10:28:37'),
(249, 'upload/products/1640082639_1634725810_img1.png', '2021-12-21 10:30:39', '2021-12-21 10:30:39'),
(250, 'upload/products/1640083024_1634725810_img1.png', '2021-12-21 10:37:04', '2021-12-21 10:37:04'),
(251, 'upload/products/1640083247_1634725810_img1.png', '2021-12-21 10:40:47', '2021-12-21 10:40:47'),
(252, 'upload/products/1640083345_1634725810_img1.png', '2021-12-21 10:42:25', '2021-12-21 10:42:25'),
(253, 'upload/products/1640083427_1634725810_img1.png', '2021-12-21 10:43:47', '2021-12-21 10:43:47'),
(254, 'upload/products/1640083540_1634725810_img1.png', '2021-12-21 10:45:40', '2021-12-21 10:45:40'),
(255, 'upload/products/1640083658_1634725810_img1.png', '2021-12-21 10:47:38', '2021-12-21 10:47:38'),
(256, 'upload/products/1640083772_1634725810_img1.png', '2021-12-21 10:49:32', '2021-12-21 10:49:32'),
(257, 'upload/products/1640083875_1634725810_img1.png', '2021-12-21 10:51:15', '2021-12-21 10:51:15'),
(258, 'upload/products/1640083989_1634725810_img1.png', '2021-12-21 10:53:09', '2021-12-21 10:53:09'),
(259, 'upload/products/1640084125_1634725810_img1.png', '2021-12-21 10:55:25', '2021-12-21 10:55:25'),
(260, 'upload/products/1640084269_1634725810_img1.png', '2021-12-21 10:57:49', '2021-12-21 10:57:49'),
(261, 'upload/products/1640084676_1634725810_img1.png', '2021-12-21 11:04:36', '2021-12-21 11:04:36'),
(262, 'upload/products/1640084765_1634725810_img1.png', '2021-12-21 11:06:05', '2021-12-21 11:06:05'),
(263, 'upload/products/1640084840_1634725810_img1.png', '2021-12-21 11:07:20', '2021-12-21 11:07:20'),
(264, 'upload/products/1640084920_1634725810_img1.png', '2021-12-21 11:08:40', '2021-12-21 11:08:40'),
(265, 'upload/products/1640084985_1634725810_img1.png', '2021-12-21 11:09:45', '2021-12-21 11:09:45'),
(266, 'upload/products/1640085066_1634725810_img1.png', '2021-12-21 11:11:06', '2021-12-21 11:11:06'),
(267, 'upload/products/1640085123_1634725810_img1.png', '2021-12-21 11:12:03', '2021-12-21 11:12:03'),
(268, 'upload/products/1640085343_1634725810_img1.png', '2021-12-21 11:15:43', '2021-12-21 11:15:43'),
(269, 'upload/products/1640085446_1634725810_img1.png', '2021-12-21 11:17:26', '2021-12-21 11:17:26'),
(270, 'upload/products/1640085574_1634725810_img1.png', '2021-12-21 11:19:34', '2021-12-21 11:19:34'),
(271, 'upload/products/1640085758_1634725810_img1.png', '2021-12-21 11:22:38', '2021-12-21 11:22:38'),
(272, 'upload/products/1640086935_Killer_kadhai_paneer_bento_box_finch_2.jpg', '2021-12-21 11:42:15', '2021-12-21 11:42:15'),
(273, 'upload/products/1640088281_delhi_6_famous_chicken_curry_bento_box.jpg', '2021-12-21 12:04:41', '2021-12-21 12:04:41'),
(274, 'upload/products/1640092471_Apple Cider.png', '2021-12-21 13:14:31', '2021-12-21 13:14:31'),
(275, 'upload/products/1640092499_1634725810_img1.png', '2021-12-21 13:14:59', '2021-12-21 13:14:59'),
(276, 'upload/products/1640092774_Belgian wit.png', '2021-12-21 13:19:34', '2021-12-21 13:19:34'),
(277, 'upload/products/1640092887_Apple Cider.png', '2021-12-21 13:21:27', '2021-12-21 13:21:27'),
(278, 'upload/products/1640093150_Hefeweizen.png', '2021-12-21 13:25:50', '2021-12-21 13:25:50'),
(279, 'upload/products/1640093336_Cloud Black.png', '2021-12-21 13:28:56', '2021-12-21 13:28:56'),
(280, 'upload/products/1640093554_IPA.png', '2021-12-21 13:32:34', '2021-12-21 13:32:34'),
(281, 'upload/places/1640093597_1634715943_2.jpg', '2021-12-21 13:33:17', '2021-12-21 13:33:17'),
(282, 'upload/products/1640093721_Lager.png', '2021-12-21 13:35:21', '2021-12-21 13:35:21'),
(283, 'upload/products/1640162138_1.png', '2021-12-22 08:35:38', '2021-12-22 08:35:38'),
(284, 'upload/products/1640167337_4.png', '2021-12-22 10:02:17', '2021-12-22 10:02:17'),
(285, 'upload/places/icons/1640173801_1640003591_4X3A2692.jpg', '2021-12-22 11:50:01', '2021-12-22 11:50:01'),
(286, 'upload/places/1640173820_powai_rest.png', '2021-12-22 11:50:20', '2021-12-22 11:50:20'),
(287, 'upload/offers/1640174674_WhatsApp Image 2021-12-21 at 7.15.23 PM.jpeg', '2021-12-22 12:04:34', '2021-12-22 12:04:34'),
(288, 'upload/offers/1640174693_WhatsApp Image 2021-12-21 at 7.13.59 PM (1).jpeg', '2021-12-22 12:04:53', '2021-12-22 12:04:53'),
(289, 'upload/offers/1640174709_WhatsApp Image 2021-12-21 at 7.14.28 PM.jpeg', '2021-12-22 12:05:09', '2021-12-22 12:05:09'),
(290, 'upload/offers/1640174723_WhatsApp Image 2021-12-21 at 7.15.00 PM.jpeg', '2021-12-22 12:05:23', '2021-12-22 12:05:23'),
(291, 'upload/locations/1640175226_amritsar.png', '2021-12-22 12:13:46', '2021-12-22 12:13:46'),
(292, 'upload/locations/1640175246_banglore.png', '2021-12-22 12:14:06', '2021-12-22 12:14:06'),
(293, 'upload/locations/1640175316_chandigarh.png', '2021-12-22 12:15:16', '2021-12-22 12:15:16'),
(294, 'upload/locations/1640175341_mumbai.png', '2021-12-22 12:15:41', '2021-12-22 12:15:41'),
(295, 'upload/locations/1640175372_pune.png', '2021-12-22 12:16:12', '2021-12-22 12:16:12'),
(296, 'upload/products/1640175818_5.png', '2021-12-22 12:23:38', '2021-12-22 12:23:38'),
(297, 'upload/products/1640176147_4.png', '2021-12-22 12:29:07', '2021-12-22 12:29:07'),
(298, 'upload/products/1640176176_3.png', '2021-12-22 12:29:36', '2021-12-22 12:29:36'),
(299, 'upload/products/1640176363_6.png', '2021-12-22 12:32:43', '2021-12-22 12:32:43'),
(300, 'upload/products/1640176388_1.png', '2021-12-22 12:33:08', '2021-12-22 12:33:08'),
(301, 'upload/products/1640176411_2.png', '2021-12-22 12:33:31', '2021-12-22 12:33:31'),
(302, 'upload/products/1640176684_layer4-4.png', '2021-12-22 12:38:04', '2021-12-22 12:38:04'),
(303, 'upload/places/multiple/1640245218_5E0A7358.webp', '2021-12-23 07:40:18', '2021-12-23 07:40:18'),
(304, 'upload/places/multiple/1640245228_00000553.webp', '2021-12-23 07:40:28', '2021-12-23 07:40:28'),
(305, 'upload/places/multiple/1640245228_00000560.webp', '2021-12-23 07:40:28', '2021-12-23 07:40:28'),
(306, 'upload/places/multiple/1640245228_00000560-1.webp', '2021-12-23 07:40:28', '2021-12-23 07:40:28'),
(307, 'upload/places/multiple/1640245228_00000566.webp', '2021-12-23 07:40:28', '2021-12-23 07:40:28'),
(308, 'upload/places/multiple/1640245247_00000570.webp', '2021-12-23 07:40:47', '2021-12-23 07:40:47'),
(309, 'upload/places/multiple/1640245248_00000574.webp', '2021-12-23 07:40:48', '2021-12-23 07:40:48'),
(310, 'upload/places/multiple/1640245248_00000576.webp', '2021-12-23 07:40:48', '2021-12-23 07:40:48'),
(311, 'upload/places/multiple/1640245248_00000580.webp', '2021-12-23 07:40:48', '2021-12-23 07:40:48'),
(312, 'upload/places/multiple/1640245248_00000607.webp', '2021-12-23 07:40:48', '2021-12-23 07:40:48'),
(313, 'upload/places/multiple/1640245248_00000613.webp', '2021-12-23 07:40:48', '2021-12-23 07:40:48'),
(314, 'upload/places/multiple/1640245312_00000618.webp', '2021-12-23 07:41:52', '2021-12-23 07:41:52'),
(315, 'upload/places/multiple/1640245312_00000628.webp', '2021-12-23 07:41:52', '2021-12-23 07:41:52'),
(316, 'upload/places/multiple/1640245312_00000631.webp', '2021-12-23 07:41:52', '2021-12-23 07:41:52'),
(317, 'upload/places/multiple/1640245312_00000637.webp', '2021-12-23 07:41:52', '2021-12-23 07:41:52'),
(318, 'upload/places/multiple/1640245312_00000761.webp', '2021-12-23 07:41:52', '2021-12-23 07:41:52'),
(319, 'upload/places/multiple/1640245372_DSC_1820.webp', '2021-12-23 07:42:52', '2021-12-23 07:42:52'),
(320, 'upload/places/multiple/1640245372_DSC_1825.webp', '2021-12-23 07:42:52', '2021-12-23 07:42:52'),
(321, 'upload/places/multiple/1640245372_DSC_1828.webp', '2021-12-23 07:42:52', '2021-12-23 07:42:52'),
(322, 'upload/places/multiple/1640245372_DSC_1830.webp', '2021-12-23 07:42:52', '2021-12-23 07:42:52'),
(323, 'upload/places/multiple/1640245372_DSC_1832.webp', '2021-12-23 07:42:52', '2021-12-23 07:42:52'),
(324, 'upload/places/multiple/1640245372_DSC_1838.webp', '2021-12-23 07:42:52', '2021-12-23 07:42:52'),
(325, 'upload/places/multiple/1640245387_DSC_1843.webp', '2021-12-23 07:43:07', '2021-12-23 07:43:07'),
(326, 'upload/places/multiple/1640245387_DSC_1845.webp', '2021-12-23 07:43:07', '2021-12-23 07:43:07'),
(327, 'upload/places/multiple/1640245387_DSC_1852.webp', '2021-12-23 07:43:07', '2021-12-23 07:43:07'),
(328, 'upload/places/multiple/1640245387_DSC_1856.webp', '2021-12-23 07:43:07', '2021-12-23 07:43:07'),
(329, 'upload/places/multiple/1640245387_DSC_1857.webp', '2021-12-23 07:43:07', '2021-12-23 07:43:07'),
(330, 'upload/places/multiple/1640245387_DSC_1862.webp', '2021-12-23 07:43:07', '2021-12-23 07:43:07'),
(331, 'upload/places/multiple/1640245409_DSC_1863.webp', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(332, 'upload/places/multiple/1640245409_DSC_1867.webp', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(333, 'upload/places/multiple/1640245409_DSC_1868.webp', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(334, 'upload/places/multiple/1640245409_DSC_1875.webp', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(335, 'upload/places/multiple/1640245409_DSC_1878.webp', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(336, 'upload/places/multiple/1640245409_DSC_1882.webp', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(337, 'upload/places/multiple/1640245409_DSC_1884.webp', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(338, 'upload/places/multiple/1640245409_IMG_0016_3.webp', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(339, 'upload/places/multiple/1640245409_ZR2A4360.webp', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(340, 'upload/places/multiple/1640245409_ZR2A4404.webp', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(341, 'upload/places/multiple/1640245899_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0001.webp', '2021-12-23 07:51:39', '2021-12-23 07:51:39'),
(342, 'upload/places/multiple/1640245899_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0002.webp', '2021-12-23 07:51:39', '2021-12-23 07:51:39'),
(343, 'upload/places/multiple/1640245899_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0003.webp', '2021-12-23 07:51:39', '2021-12-23 07:51:39'),
(344, 'upload/places/multiple/1640245899_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0004.webp', '2021-12-23 07:51:39', '2021-12-23 07:51:39'),
(345, 'upload/places/multiple/1640245899_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0005.webp', '2021-12-23 07:51:39', '2021-12-23 07:51:39'),
(346, 'upload/places/multiple/1640245899_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0006.webp', '2021-12-23 07:51:39', '2021-12-23 07:51:39'),
(347, 'upload/places/multiple/1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0001.webp', '2021-12-23 07:53:07', '2021-12-23 07:53:07'),
(348, 'upload/places/multiple/1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0002.webp', '2021-12-23 07:53:07', '2021-12-23 07:53:07'),
(349, 'upload/places/multiple/1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0003.webp', '2021-12-23 07:53:07', '2021-12-23 07:53:07'),
(350, 'upload/places/multiple/1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0004.webp', '2021-12-23 07:53:07', '2021-12-23 07:53:07'),
(351, 'upload/places/multiple/1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0005.webp', '2021-12-23 07:53:07', '2021-12-23 07:53:07'),
(352, 'upload/places/multiple/1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0006.webp', '2021-12-23 07:53:07', '2021-12-23 07:53:07'),
(353, 'upload/places/multiple/1640246987_FINAL RENDERS (1)_page-0001.webp', '2021-12-23 08:09:47', '2021-12-23 08:09:47'),
(354, 'upload/places/multiple/1640246987_FINAL RENDERS (1)_page-0002.webp', '2021-12-23 08:09:47', '2021-12-23 08:09:47'),
(355, 'upload/places/multiple/1640246987_FINAL RENDERS (1)_page-0003.webp', '2021-12-23 08:09:47', '2021-12-23 08:09:47'),
(356, 'upload/places/multiple/1640246987_FINAL RENDERS (1)_page-0004.webp', '2021-12-23 08:09:47', '2021-12-23 08:09:47'),
(357, 'upload/places/multiple/1640246987_FINAL RENDERS (1)_page-0005.webp', '2021-12-23 08:09:47', '2021-12-23 08:09:47'),
(358, 'upload/places/multiple/1640246987_FINAL RENDERS (1)_page-0006.webp', '2021-12-23 08:09:47', '2021-12-23 08:09:47'),
(359, 'upload/places/multiple/1640246987_FINAL RENDERS (1)_page-0007.webp', '2021-12-23 08:09:47', '2021-12-23 08:09:47'),
(360, 'upload/products/1640253394_BALINESE CURRY BOWL .jpg', '2021-12-23 09:56:34', '2021-12-23 09:56:34'),
(361, 'upload/products/1640253413_BALINESE CURRY BOWL 1.jpg', '2021-12-23 09:56:53', '2021-12-23 09:56:53'),
(362, 'upload/products/1640253492_BACON MUSHROOM _ RICOTTA OMELETTE 3.jpg', '2021-12-23 09:58:12', '2021-12-23 09:58:12'),
(363, 'upload/products/1640253742_BEETROOT HALWA CANOLI WITH RABRI FOAM 1.jpg', '2021-12-23 10:02:22', '2021-12-23 10:02:22'),
(364, 'upload/products/1640253808_BEETROOT HALWA CANOLI WITH RABRI MOUSSE.jpg', '2021-12-23 10:03:28', '2021-12-23 10:03:28'),
(365, 'upload/products/1640253934_BEETROOT HALWA CANOLI WITH RABRI FOAM 1.jpg', '2021-12-23 10:05:34', '2021-12-23 10:05:34'),
(366, 'upload/products/1640254234_BULGOGI CHICKEN WINGS 1.jpg', '2021-12-23 10:10:34', '2021-12-23 10:10:34'),
(367, 'upload/products/1640254379_BALINESE CURRY BOWL .jpg', '2021-12-23 10:12:59', '2021-12-23 10:12:59'),
(368, 'upload/products/1640254404_BALINESE CURRY BOWL 1.jpg', '2021-12-23 10:13:24', '2021-12-23 10:13:24'),
(369, 'upload/products/1640254476_BALINESE CURRY BOWL .jpg', '2021-12-23 10:14:36', '2021-12-23 10:14:36'),
(370, 'upload/products/1640254500_BALINESE CURRY BOWL 1.jpg', '2021-12-23 10:15:00', '2021-12-23 10:15:00'),
(371, 'upload/products/1640254674_BALINESE CURRY BOWL .jpg', '2021-12-23 10:17:54', '2021-12-23 10:17:54'),
(372, 'upload/products/1640254845_BULLS EYE 1.jpg', '2021-12-23 10:20:45', '2021-12-23 10:20:45'),
(373, 'upload/products/1640254888_BULLS EYE.jpg', '2021-12-23 10:21:28', '2021-12-23 10:21:28'),
(374, 'upload/products/1640254937_BULLS EYE 1.jpg', '2021-12-23 10:22:17', '2021-12-23 10:22:17'),
(375, 'upload/products/1640255256_BUTTER CHICKEN COINS.jpg', '2021-12-23 10:27:36', '2021-12-23 10:27:36'),
(376, 'upload/products/1640255642_CHICKEN IN SMOKED CHILLI SAUCE 2.jpg', '2021-12-23 10:34:02', '2021-12-23 10:34:02'),
(377, 'upload/products/1640255701_CHICKEN IN SMOKED CHILLI SAUCE 3.jpg', '2021-12-23 10:35:01', '2021-12-23 10:35:01'),
(378, 'upload/products/1640255753_chicken in smoked chilli sauce.jpg', '2021-12-23 10:35:53', '2021-12-23 10:35:53'),
(379, 'upload/products/1640255918_CHILLI TERIYAKI CHICKEN.jpg', '2021-12-23 10:38:38', '2021-12-23 10:38:38'),
(380, 'upload/products/1640256320_Dilli 6 famous chicken curry.PNG', '2021-12-23 10:45:20', '2021-12-23 10:45:20'),
(381, 'upload/products/1640256470_Dum Biryani.PNG', '2021-12-23 10:47:50', '2021-12-23 10:47:50'),
(382, 'upload/products/1640256483_Dum Biryani.PNG', '2021-12-23 10:48:03', '2021-12-23 10:48:03'),
(383, 'upload/products/1640256614_EXOTIC VEG AND CHEESE SLIDER 2.jpg', '2021-12-23 10:50:14', '2021-12-23 10:50:14'),
(384, 'upload/products/1640256880_GRILLED CHICKEN WITH LEMON MUSTARD SAUCE 1.jpg', '2021-12-23 10:54:40', '2021-12-23 10:54:40'),
(385, 'upload/products/1640256923_GRILLED CHICKEN WITH LEMON MUSTARD SAUCE.jpg', '2021-12-23 10:55:23', '2021-12-23 10:55:23'),
(386, 'upload/products/1640256968_GRILLED CHICKEN WITH LEMON MUSTARD SAUCE.jpg', '2021-12-23 10:56:08', '2021-12-23 10:56:08'),
(387, 'upload/products/1640257077_HANDCUT FRIES TRUFFLE 1.jpg', '2021-12-23 10:57:57', '2021-12-23 10:57:57'),
(388, 'upload/products/1640257096_HANDCUT FRIES TRUFFLE.jpg', '2021-12-23 10:58:16', '2021-12-23 10:58:16'),
(389, 'upload/products/1640257149_HANDCUT FRIES TRUFFLE 1.jpg', '2021-12-23 10:59:09', '2021-12-23 10:59:09'),
(390, 'upload/products/1640257177_HANDCUT FRIES TRUFFLE.jpg', '2021-12-23 10:59:37', '2021-12-23 10:59:37'),
(391, 'upload/products/1640257242_HANDCUT FRIES TRUFFLE 1.jpg', '2021-12-23 11:00:42', '2021-12-23 11:00:42'),
(392, 'upload/products/1640257259_HANDCUT FRIES TRUFFLE.jpg', '2021-12-23 11:00:59', '2021-12-23 11:00:59'),
(393, 'upload/products/1640257275_HANDCUT FRIES TRUFFLE 1.jpg', '2021-12-23 11:01:15', '2021-12-23 11:01:15'),
(394, 'upload/products/1640257286_HANDCUT FRIES TRUFFLE.jpg', '2021-12-23 11:01:26', '2021-12-23 11:01:26'),
(395, 'upload/products/1640257306_HANDCUT FRIES TRUFFLE 1.jpg', '2021-12-23 11:01:46', '2021-12-23 11:01:46'),
(396, 'upload/products/1640257457_HIPSTER SALAD .jpg', '2021-12-23 11:04:17', '2021-12-23 11:04:17'),
(397, 'upload/products/1640257496_HIPSTER SALAD 1.jpg', '2021-12-23 11:04:56', '2021-12-23 11:04:56'),
(398, 'upload/products/1640257524_HIPSTER SALAD 1.jpg', '2021-12-23 11:05:24', '2021-12-23 11:05:24'),
(399, 'upload/products/1640257539_HIPSTER SALAD .jpg', '2021-12-23 11:05:39', '2021-12-23 11:05:39'),
(400, 'upload/products/1640257570_HIPSTER SALAD 1.jpg', '2021-12-23 11:06:10', '2021-12-23 11:06:10'),
(401, 'upload/products/1640257589_HIPSTER SALAD .jpg', '2021-12-23 11:06:29', '2021-12-23 11:06:29'),
(402, 'upload/products/1640257948_JALAPINOS _CHICKEN SLIDER 1.jpg', '2021-12-23 11:12:28', '2021-12-23 11:12:28'),
(403, 'upload/products/1640258008_Dilli 6 famous chicken curry.PNG', '2021-12-23 11:13:28', '2021-12-23 11:13:28'),
(404, 'upload/products/1640258038_Kadhai Paneer.jpg', '2021-12-23 11:13:58', '2021-12-23 11:13:58'),
(405, 'upload/products/1640258111_Kadhai Paneer.jpg', '2021-12-23 11:15:11', '2021-12-23 11:15:11'),
(406, 'upload/products/1640258233_Kadhai Paneer.jpg', '2021-12-23 11:17:13', '2021-12-23 11:17:13'),
(407, 'upload/products/1640258330_Dilli 6 famous chicken curry.PNG', '2021-12-23 11:18:50', '2021-12-23 11:18:50'),
(408, 'upload/products/1640258437_Penne Arabiatta.PNG', '2021-12-23 11:20:37', '2021-12-23 11:20:37'),
(409, 'upload/products/1640258469_Penne Arabiatta.PNG', '2021-12-23 11:21:09', '2021-12-23 11:21:09'),
(410, 'upload/products/1640258502_Penne Arabiatta.PNG', '2021-12-23 11:21:42', '2021-12-23 11:21:42'),
(411, 'upload/products/1640258599_Pita Hummus.PNG', '2021-12-23 11:23:19', '2021-12-23 11:23:19'),
(412, 'upload/products/1640258682_Pita Hummus.PNG', '2021-12-23 11:24:42', '2021-12-23 11:24:42'),
(413, 'upload/products/1640258706_Pita Hummus.PNG', '2021-12-23 11:25:06', '2021-12-23 11:25:06'),
(414, 'upload/products/1640258858_Pop Star Penne Alfredo.PNG', '2021-12-23 11:27:38', '2021-12-23 11:27:38'),
(415, 'upload/products/1640258894_Pop Star Penne Alfredo.PNG', '2021-12-23 11:28:14', '2021-12-23 11:28:14'),
(416, 'upload/products/1640258914_Pop Star Penne Alfredo.PNG', '2021-12-23 11:28:34', '2021-12-23 11:28:34'),
(417, 'upload/products/1640259150_Singapore Wok tossed chicken.PNG', '2021-12-23 11:32:30', '2021-12-23 11:32:30'),
(418, 'upload/products/1640259334_Thai Chilli Noodle.PNG', '2021-12-23 11:35:34', '2021-12-23 11:35:34'),
(419, 'upload/products/1640259351_Thai Chilli Noodle.PNG', '2021-12-23 11:35:51', '2021-12-23 11:35:51'),
(420, 'upload/products/1640259365_Thai Chilli Noodle.PNG', '2021-12-23 11:36:05', '2021-12-23 11:36:05'),
(421, 'upload/products/1640259388_Thai Chilli Noodle.PNG', '2021-12-23 11:36:28', '2021-12-23 11:36:28'),
(422, 'upload/products/1640259403_Thai Chilli Noodle.PNG', '2021-12-23 11:36:43', '2021-12-23 11:36:43'),
(423, 'upload/products/1640259419_Thai Chilli Noodle.PNG', '2021-12-23 11:36:59', '2021-12-23 11:36:59'),
(424, 'upload/products/1640259449_Thai Chilli Noodle.PNG', '2021-12-23 11:37:29', '2021-12-23 11:37:29'),
(425, 'upload/products/1640259465_Thai Chilli Noodle.PNG', '2021-12-23 11:37:45', '2021-12-23 11:37:45'),
(426, 'upload/products/1640259477_Thai Chilli Noodle.PNG', '2021-12-23 11:37:57', '2021-12-23 11:37:57'),
(427, 'upload/products/1640259690_Turkish Kebab.PNG', '2021-12-23 11:41:30', '2021-12-23 11:41:30'),
(428, 'upload/products/1640259708_Turkish Kebab.PNG', '2021-12-23 11:41:48', '2021-12-23 11:41:48'),
(429, 'upload/products/1640259750_Turkish Kebab.PNG', '2021-12-23 11:42:30', '2021-12-23 11:42:30'),
(430, 'upload/products/1640259828_Turkish Kebab.PNG', '2021-12-23 11:43:48', '2021-12-23 11:43:48'),
(431, 'upload/products/1640259840_Turkish Kebab.PNG', '2021-12-23 11:44:00', '2021-12-23 11:44:00'),
(432, 'upload/products/1640259877_Turkish Kebab.PNG', '2021-12-23 11:44:37', '2021-12-23 11:44:37'),
(433, 'upload/products/1640259969_Vegetable Dum Biryani.PNG', '2021-12-23 11:46:09', '2021-12-23 11:46:09'),
(434, 'upload/products/1640260106_Vegetable Dum Biryani.PNG', '2021-12-23 11:48:26', '2021-12-23 11:48:26'),
(435, 'upload/products/1640260254_Dum Biryani.PNG', '2021-12-23 11:50:54', '2021-12-23 11:50:54'),
(436, 'upload/products/1640260409_Volcano Nachos.PNG', '2021-12-23 11:53:29', '2021-12-23 11:53:29'),
(437, 'upload/products/1640260459_Volcano Nachos.PNG', '2021-12-23 11:54:19', '2021-12-23 11:54:19'),
(438, 'upload/products/1640260471_Volcano Nachos.PNG', '2021-12-23 11:54:31', '2021-12-23 11:54:31'),
(439, 'upload/products/1640260488_Volcano Nachos.PNG', '2021-12-23 11:54:48', '2021-12-23 11:54:48'),
(440, 'upload/products/1640261199_BURRATA  PESTO CROSTINI 1.jpg', '2021-12-23 12:06:39', '2021-12-23 12:06:39'),
(441, 'upload/products/1640261571_FINCH_S SPECIAL INDIAN MASALA 2.jpg', '2021-12-23 12:12:51', '2021-12-23 12:12:51'),
(442, 'upload/products/1640262066_seilankan fiery prawn and panko crusted tempura shrimp.jpg', '2021-12-23 12:21:06', '2021-12-23 12:21:06'),
(443, 'upload/products/1640325525_product.jpg', '2021-12-24 05:58:45', '2021-12-24 05:58:45'),
(444, 'upload/products/1640325554_product.jpg', '2021-12-24 05:59:14', '2021-12-24 05:59:14'),
(445, 'upload/products/1640325585_product.jpg', '2021-12-24 05:59:45', '2021-12-24 05:59:45'),
(446, 'upload/products/1640325598_product.jpg', '2021-12-24 05:59:58', '2021-12-24 05:59:58'),
(447, 'upload/products/1640325609_product.jpg', '2021-12-24 06:00:09', '2021-12-24 06:00:09'),
(448, 'upload/products/1640325620_product.jpg', '2021-12-24 06:00:20', '2021-12-24 06:00:20'),
(449, 'upload/products/1640325631_product.jpg', '2021-12-24 06:00:31', '2021-12-24 06:00:31'),
(450, 'upload/products/1640325645_product.jpg', '2021-12-24 06:00:45', '2021-12-24 06:00:45'),
(451, 'upload/products/1640325657_product.jpg', '2021-12-24 06:00:57', '2021-12-24 06:00:57'),
(452, 'upload/products/1640325673_product.jpg', '2021-12-24 06:01:13', '2021-12-24 06:01:13'),
(453, 'upload/products/1640325696_product.jpg', '2021-12-24 06:01:36', '2021-12-24 06:01:36'),
(454, 'upload/products/1640325711_product.jpg', '2021-12-24 06:01:51', '2021-12-24 06:01:51'),
(455, 'upload/products/1640325827_product.jpg', '2021-12-24 06:03:47', '2021-12-24 06:03:47'),
(456, 'upload/products/1640325839_product.jpg', '2021-12-24 06:03:59', '2021-12-24 06:03:59'),
(457, 'upload/products/1640325860_product.jpg', '2021-12-24 06:04:20', '2021-12-24 06:04:20'),
(458, 'upload/products/1640325884_product.jpg', '2021-12-24 06:04:44', '2021-12-24 06:04:44'),
(459, 'upload/products/1640325896_product.jpg', '2021-12-24 06:04:56', '2021-12-24 06:04:56'),
(460, 'upload/products/1640325906_product.jpg', '2021-12-24 06:05:06', '2021-12-24 06:05:06'),
(461, 'upload/products/1640325916_product.jpg', '2021-12-24 06:05:16', '2021-12-24 06:05:16'),
(462, 'upload/products/1640325931_product.jpg', '2021-12-24 06:05:31', '2021-12-24 06:05:31'),
(463, 'upload/products/1640325941_product.jpg', '2021-12-24 06:05:41', '2021-12-24 06:05:41'),
(464, 'upload/products/1640325953_product.jpg', '2021-12-24 06:05:53', '2021-12-24 06:05:53'),
(465, 'upload/products/1640325966_product.jpg', '2021-12-24 06:06:06', '2021-12-24 06:06:06'),
(466, 'upload/products/1640325977_product.jpg', '2021-12-24 06:06:17', '2021-12-24 06:06:17'),
(467, 'upload/products/1640326003_product.jpg', '2021-12-24 06:06:43', '2021-12-24 06:06:43'),
(468, 'upload/products/1640326013_product.jpg', '2021-12-24 06:06:53', '2021-12-24 06:06:53'),
(469, 'upload/products/1640326025_product.jpg', '2021-12-24 06:07:05', '2021-12-24 06:07:05'),
(470, 'upload/products/1640326035_product.jpg', '2021-12-24 06:07:15', '2021-12-24 06:07:15'),
(471, 'upload/products/1640326044_product.jpg', '2021-12-24 06:07:24', '2021-12-24 06:07:24'),
(472, 'upload/products/1640326055_product.jpg', '2021-12-24 06:07:35', '2021-12-24 06:07:35'),
(473, 'upload/products/1640326066_product.jpg', '2021-12-24 06:07:46', '2021-12-24 06:07:46'),
(474, 'upload/products/1640326075_product.jpg', '2021-12-24 06:07:55', '2021-12-24 06:07:55'),
(475, 'upload/products/1640326364_HIPSTER SALAD .jpg', '2021-12-24 06:12:44', '2021-12-24 06:12:44'),
(476, 'upload/products/1640326424_CHILLI TERIYAKI CHICKEN.jpg', '2021-12-24 06:13:44', '2021-12-24 06:13:44'),
(477, 'upload/products/1640326439_CHILLI TERIYAKI CHICKEN.jpg', '2021-12-24 06:13:59', '2021-12-24 06:13:59'),
(478, 'upload/products/1640332907_CHILLI TERIYAKI CHICKEN.jpg', '2021-12-24 08:01:47', '2021-12-24 08:01:47'),
(479, 'upload/products/1640332934_CHILLI TERIYAKI CHICKEN.jpg', '2021-12-24 08:02:14', '2021-12-24 08:02:14'),
(480, 'upload/products/1640332989_ANDA BHURJI WITH TIKONA PARATHA.jpg', '2021-12-24 08:03:09', '2021-12-24 08:03:09'),
(481, 'upload/products/1640333034_product.jpg', '2021-12-24 08:03:54', '2021-12-24 08:03:54');
INSERT INTO `upload_images` (`id`, `file`, `created_at`, `updated_at`) VALUES
(482, 'upload/products/1640333086_product.jpg', '2021-12-24 08:04:46', '2021-12-24 08:04:46'),
(483, 'upload/products/1640333099_product.jpg', '2021-12-24 08:04:59', '2021-12-24 08:04:59'),
(484, 'upload/products/1640333112_product.jpg', '2021-12-24 08:05:12', '2021-12-24 08:05:12'),
(485, 'upload/products/1640333122_product.jpg', '2021-12-24 08:05:22', '2021-12-24 08:05:22'),
(486, 'upload/products/1640333142_product.jpg', '2021-12-24 08:05:42', '2021-12-24 08:05:42'),
(487, 'upload/products/1640333149_product.jpg', '2021-12-24 08:05:49', '2021-12-24 08:05:49'),
(488, 'upload/products/1640333158_product.jpg', '2021-12-24 08:05:58', '2021-12-24 08:05:58'),
(489, 'upload/products/1640333171_product.jpg', '2021-12-24 08:06:11', '2021-12-24 08:06:11'),
(490, 'upload/products/1640333183_product.jpg', '2021-12-24 08:06:23', '2021-12-24 08:06:23'),
(491, 'upload/products/1640333192_product.jpg', '2021-12-24 08:06:32', '2021-12-24 08:06:32'),
(492, 'upload/products/1640333200_product.jpg', '2021-12-24 08:06:40', '2021-12-24 08:06:40'),
(493, 'upload/products/1640333210_product.jpg', '2021-12-24 08:06:50', '2021-12-24 08:06:50'),
(494, 'upload/products/1640333219_product.jpg', '2021-12-24 08:06:59', '2021-12-24 08:06:59'),
(495, 'upload/products/1640333228_product.jpg', '2021-12-24 08:07:08', '2021-12-24 08:07:08'),
(496, 'upload/products/1640333241_product.jpg', '2021-12-24 08:07:21', '2021-12-24 08:07:21'),
(497, 'upload/products/1640333261_product.jpg', '2021-12-24 08:07:41', '2021-12-24 08:07:41'),
(498, 'upload/products/1640333270_product.jpg', '2021-12-24 08:07:50', '2021-12-24 08:07:50'),
(499, 'upload/products/1640333281_product.jpg', '2021-12-24 08:08:01', '2021-12-24 08:08:01'),
(500, 'upload/products/1640333290_product.jpg', '2021-12-24 08:08:10', '2021-12-24 08:08:10'),
(501, 'upload/products/1640333298_product.jpg', '2021-12-24 08:08:18', '2021-12-24 08:08:18'),
(502, 'upload/products/1640333306_product.jpg', '2021-12-24 08:08:26', '2021-12-24 08:08:26'),
(503, 'upload/products/1640333317_product.jpg', '2021-12-24 08:08:37', '2021-12-24 08:08:37'),
(504, 'upload/products/1640333327_product.jpg', '2021-12-24 08:08:47', '2021-12-24 08:08:47'),
(505, 'upload/products/1640333341_product.jpg', '2021-12-24 08:09:01', '2021-12-24 08:09:01'),
(506, 'upload/products/1640333352_product.jpg', '2021-12-24 08:09:12', '2021-12-24 08:09:12'),
(507, 'upload/products/1640333365_product.jpg', '2021-12-24 08:09:25', '2021-12-24 08:09:25'),
(508, 'upload/products/1640333381_product.jpg', '2021-12-24 08:09:41', '2021-12-24 08:09:41'),
(509, 'upload/products/1640333389_product.jpg', '2021-12-24 08:09:49', '2021-12-24 08:09:49'),
(510, 'upload/products/1640333397_product.jpg', '2021-12-24 08:09:57', '2021-12-24 08:09:57'),
(511, 'upload/products/1640333406_product.jpg', '2021-12-24 08:10:06', '2021-12-24 08:10:06'),
(512, 'upload/products/1640333415_product.jpg', '2021-12-24 08:10:15', '2021-12-24 08:10:15'),
(513, 'upload/products/1640333423_product.jpg', '2021-12-24 08:10:23', '2021-12-24 08:10:23'),
(514, 'upload/products/1640333433_product.jpg', '2021-12-24 08:10:33', '2021-12-24 08:10:33'),
(515, 'upload/products/1640333440_product.jpg', '2021-12-24 08:10:40', '2021-12-24 08:10:40'),
(516, 'upload/products/1640333448_product.jpg', '2021-12-24 08:10:48', '2021-12-24 08:10:48'),
(517, 'upload/products/1640333463_product.jpg', '2021-12-24 08:11:03', '2021-12-24 08:11:03'),
(518, 'upload/products/1640333473_product.jpg', '2021-12-24 08:11:13', '2021-12-24 08:11:13'),
(519, 'upload/products/1640333484_product.jpg', '2021-12-24 08:11:24', '2021-12-24 08:11:24'),
(520, 'upload/products/1640333495_product.jpg', '2021-12-24 08:11:35', '2021-12-24 08:11:35'),
(521, 'upload/products/1640333505_product.jpg', '2021-12-24 08:11:45', '2021-12-24 08:11:45'),
(522, 'upload/products/1640333515_product.jpg', '2021-12-24 08:11:55', '2021-12-24 08:11:55'),
(523, 'upload/products/1640333525_product.jpg', '2021-12-24 08:12:05', '2021-12-24 08:12:05'),
(524, 'upload/products/1640333544_product.jpg', '2021-12-24 08:12:24', '2021-12-24 08:12:24'),
(525, 'upload/products/1640333556_product.jpg', '2021-12-24 08:12:36', '2021-12-24 08:12:36'),
(526, 'upload/products/1640333570_product.jpg', '2021-12-24 08:12:50', '2021-12-24 08:12:50'),
(527, 'upload/products/1640333593_CHILLI TERIYAKI CHICKEN.jpg', '2021-12-24 08:13:13', '2021-12-24 08:13:13'),
(528, 'upload/products/1640333621_CHILLI TERIYAKI CHICKEN.jpg', '2021-12-24 08:13:41', '2021-12-24 08:13:41'),
(529, 'upload/products/1640333658_product.jpg', '2021-12-24 08:14:18', '2021-12-24 08:14:18'),
(530, 'upload/products/1640333670_product.jpg', '2021-12-24 08:14:30', '2021-12-24 08:14:30'),
(531, 'upload/products/1640333686_product.jpg', '2021-12-24 08:14:46', '2021-12-24 08:14:46'),
(532, 'upload/products/1640333731_product.jpg', '2021-12-24 08:15:31', '2021-12-24 08:15:31'),
(533, 'upload/products/1640333743_product.jpg', '2021-12-24 08:15:43', '2021-12-24 08:15:43'),
(534, 'upload/products/1640333755_product.jpg', '2021-12-24 08:15:55', '2021-12-24 08:15:55'),
(535, 'upload/products/1640333763_product.jpg', '2021-12-24 08:16:03', '2021-12-24 08:16:03'),
(536, 'upload/products/1640333772_product.jpg', '2021-12-24 08:16:12', '2021-12-24 08:16:12'),
(537, 'upload/products/1640333780_product.jpg', '2021-12-24 08:16:20', '2021-12-24 08:16:20'),
(538, 'upload/products/1640333788_product.jpg', '2021-12-24 08:16:28', '2021-12-24 08:16:28'),
(539, 'upload/products/1640333796_product.jpg', '2021-12-24 08:16:36', '2021-12-24 08:16:36'),
(540, 'upload/products/1640333805_product.jpg', '2021-12-24 08:16:45', '2021-12-24 08:16:45'),
(541, 'upload/products/1640333812_product.jpg', '2021-12-24 08:16:52', '2021-12-24 08:16:52'),
(542, 'upload/products/1640333821_product.jpg', '2021-12-24 08:17:01', '2021-12-24 08:17:01'),
(543, 'upload/products/1640333828_product.jpg', '2021-12-24 08:17:08', '2021-12-24 08:17:08'),
(544, 'upload/products/1640333836_product.jpg', '2021-12-24 08:17:16', '2021-12-24 08:17:16'),
(545, 'upload/products/1640333846_product.jpg', '2021-12-24 08:17:26', '2021-12-24 08:17:26'),
(546, 'upload/products/1640333856_Belgian wit.png', '2021-12-24 08:17:36', '2021-12-24 08:17:36'),
(547, 'upload/products/1640333859_product.jpg', '2021-12-24 08:17:39', '2021-12-24 08:17:39'),
(548, 'upload/products/1640333867_product.jpg', '2021-12-24 08:17:47', '2021-12-24 08:17:47'),
(549, 'upload/products/1640333875_product.jpg', '2021-12-24 08:17:55', '2021-12-24 08:17:55'),
(550, 'upload/products/1640333883_product.jpg', '2021-12-24 08:18:03', '2021-12-24 08:18:03'),
(551, 'upload/products/1640333900_product.jpg', '2021-12-24 08:18:20', '2021-12-24 08:18:20'),
(552, 'upload/products/1640333908_product.jpg', '2021-12-24 08:18:28', '2021-12-24 08:18:28'),
(553, 'upload/products/1640333917_product.jpg', '2021-12-24 08:18:37', '2021-12-24 08:18:37'),
(554, 'upload/products/1640333928_product.jpg', '2021-12-24 08:18:48', '2021-12-24 08:18:48'),
(555, 'upload/products/1640333937_product.jpg', '2021-12-24 08:18:57', '2021-12-24 08:18:57'),
(556, 'upload/products/1640333948_product.jpg', '2021-12-24 08:19:08', '2021-12-24 08:19:08'),
(557, 'upload/products/1640333955_product.jpg', '2021-12-24 08:19:15', '2021-12-24 08:19:15'),
(558, 'upload/products/1640333963_product.jpg', '2021-12-24 08:19:23', '2021-12-24 08:19:23'),
(559, 'upload/products/1640333972_product.jpg', '2021-12-24 08:19:32', '2021-12-24 08:19:32'),
(560, 'upload/products/1640333980_product.jpg', '2021-12-24 08:19:40', '2021-12-24 08:19:40'),
(561, 'upload/products/1640333988_product.jpg', '2021-12-24 08:19:48', '2021-12-24 08:19:48'),
(562, 'upload/products/1640333996_product.jpg', '2021-12-24 08:19:56', '2021-12-24 08:19:56'),
(563, 'upload/products/1640334004_product.jpg', '2021-12-24 08:20:04', '2021-12-24 08:20:04'),
(564, 'upload/products/1640334012_product.jpg', '2021-12-24 08:20:12', '2021-12-24 08:20:12'),
(565, 'upload/products/1640334050_product.jpg', '2021-12-24 08:20:50', '2021-12-24 08:20:50'),
(566, 'upload/products/1640334061_product.jpg', '2021-12-24 08:21:01', '2021-12-24 08:21:01'),
(567, 'upload/products/1640334072_product.jpg', '2021-12-24 08:21:12', '2021-12-24 08:21:12'),
(568, 'upload/products/1640334083_product.jpg', '2021-12-24 08:21:23', '2021-12-24 08:21:23'),
(569, 'upload/products/1640334092_product.jpg', '2021-12-24 08:21:32', '2021-12-24 08:21:32'),
(570, 'upload/products/1640334102_product.jpg', '2021-12-24 08:21:42', '2021-12-24 08:21:42'),
(571, 'upload/products/1640334108_product.jpg', '2021-12-24 08:21:48', '2021-12-24 08:21:48'),
(572, 'upload/products/1640334118_product.jpg', '2021-12-24 08:21:58', '2021-12-24 08:21:58'),
(573, 'upload/products/1640334126_product.jpg', '2021-12-24 08:22:06', '2021-12-24 08:22:06'),
(574, 'upload/products/1640334136_product.jpg', '2021-12-24 08:22:16', '2021-12-24 08:22:16'),
(575, 'upload/products/1640334148_product.jpg', '2021-12-24 08:22:28', '2021-12-24 08:22:28'),
(576, 'upload/products/1640334158_product.jpg', '2021-12-24 08:22:38', '2021-12-24 08:22:38'),
(577, 'upload/products/1640334165_product.jpg', '2021-12-24 08:22:45', '2021-12-24 08:22:45'),
(578, 'upload/products/1640334172_product.jpg', '2021-12-24 08:22:52', '2021-12-24 08:22:52'),
(579, 'upload/products/1640334180_product.jpg', '2021-12-24 08:23:00', '2021-12-24 08:23:00'),
(580, 'upload/products/1640334187_product.jpg', '2021-12-24 08:23:07', '2021-12-24 08:23:07'),
(581, 'upload/products/1640334199_product.jpg', '2021-12-24 08:23:19', '2021-12-24 08:23:19'),
(582, 'upload/products/1640334206_product.jpg', '2021-12-24 08:23:26', '2021-12-24 08:23:26'),
(583, 'upload/products/1640334214_product.jpg', '2021-12-24 08:23:34', '2021-12-24 08:23:34'),
(584, 'upload/products/1640334221_product.jpg', '2021-12-24 08:23:41', '2021-12-24 08:23:41'),
(585, 'upload/products/1640334230_product.jpg', '2021-12-24 08:23:50', '2021-12-24 08:23:50'),
(586, 'upload/products/1640334238_product.jpg', '2021-12-24 08:23:58', '2021-12-24 08:23:58'),
(587, 'upload/products/1640334248_product.jpg', '2021-12-24 08:24:08', '2021-12-24 08:24:08'),
(588, 'upload/products/1640334261_product.jpg', '2021-12-24 08:24:21', '2021-12-24 08:24:21'),
(589, 'upload/products/1640334270_product.jpg', '2021-12-24 08:24:30', '2021-12-24 08:24:30'),
(590, 'upload/products/1640334281_product.jpg', '2021-12-24 08:24:41', '2021-12-24 08:24:41'),
(591, 'upload/places/multiple/1640869739_4X3A2631.webp', '2021-12-30 13:08:59', '2021-12-30 13:08:59'),
(592, 'upload/places/multiple/1640869739_4X3A2692.webp', '2021-12-30 13:08:59', '2021-12-30 13:08:59'),
(593, 'upload/places/multiple/1640869739_4X3A2713.webp', '2021-12-30 13:08:59', '2021-12-30 13:08:59'),
(594, 'upload/places/multiple/1640869739_4X3A2722.webp', '2021-12-30 13:08:59', '2021-12-30 13:08:59'),
(595, 'upload/places/multiple/1640869739_4X3A2725.webp', '2021-12-30 13:08:59', '2021-12-30 13:08:59'),
(596, 'upload/places/multiple/1640869739_4X3A2729.webp', '2021-12-30 13:08:59', '2021-12-30 13:08:59'),
(597, 'upload/places/multiple/1640869739_4X3A2733.webp', '2021-12-30 13:08:59', '2021-12-30 13:08:59'),
(598, 'upload/places/multiple/1640869739_4X3A2738.webp', '2021-12-30 13:08:59', '2021-12-30 13:08:59'),
(599, 'upload/places/multiple/1640869739_4X3A2741.webp', '2021-12-30 13:08:59', '2021-12-30 13:08:59'),
(600, 'upload/passport/1641661929_1640158685 (1).jpg', '2022-01-08 17:12:09', '2022-01-08 17:12:09'),
(601, 'upload/passport/1641662727_1640158685 (1).jpg', '2022-01-08 17:25:27', '2022-01-08 17:25:27'),
(602, 'upload/passport/1641804223_passport.jpg', '2022-01-10 08:43:43', '2022-01-10 08:43:43'),
(603, 'upload/products/1641819032_Tacos.jpg', '2022-01-10 12:50:32', '2022-01-10 12:50:32'),
(604, 'upload/products/1641819088_TAPAS BOX.jpg', '2022-01-10 12:51:29', '2022-01-10 12:51:29'),
(605, 'upload/products/1641819121_POLLO OLIVATTI .jpg', '2022-01-10 12:52:01', '2022-01-10 12:52:01'),
(606, 'upload/products/1641819149_STYLISH SALTIMBOCCA.jpg', '2022-01-10 12:52:29', '2022-01-10 12:52:29'),
(607, 'upload/products/1641819193_SCOTCH EGG 1.jpg', '2022-01-10 12:53:13', '2022-01-10 12:53:13'),
(608, 'upload/products/1641819226_FINCH_S SPECIAL INDIAN MASALA.jpg', '2022-01-10 12:53:46', '2022-01-10 12:53:46'),
(609, 'upload/products/1641819263_THAI SPRING ROLL (PAW PIA TOD).jpg', '2022-01-10 12:54:23', '2022-01-10 12:54:23'),
(610, 'upload/products/1641819292_VIETNAMESE STYLE CHILLY CELERY COTTAGE CHEESE 1.jpg', '2022-01-10 12:54:52', '2022-01-10 12:54:52'),
(611, 'upload/products/1641819326_KUNG PAO TOFU AND BROCCOLI.jpg', '2022-01-10 12:55:26', '2022-01-10 12:55:26'),
(612, 'upload/products/1641878216_VOLCANO NACHOS 2.jpg', '2022-01-11 05:16:56', '2022-01-11 05:16:56'),
(613, 'upload/products/1641878313_tapas.jpg', '2022-01-11 05:18:33', '2022-01-11 05:18:33'),
(614, 'upload/products/1641878381_SRILANKAN FIERY PRAWN.jpg', '2022-01-11 05:19:42', '2022-01-11 05:19:42'),
(615, 'upload/products/1641878454_THE FARMER SALAD .jpg', '2022-01-11 05:20:54', '2022-01-11 05:20:54'),
(616, 'upload/products/1641878491_POTATO, EGG AND BACON SALAD.jpg', '2022-01-11 05:21:31', '2022-01-11 05:21:31'),
(617, 'upload/products/1641878527_WILD MUSHROOM CROQUE MONSIEUR.jpg', '2022-01-11 05:22:07', '2022-01-11 05:22:07'),
(618, 'upload/products/1641887101_PANKO CRUSTED TEMPURA SHRIMPS 1.jpg', '2022-01-11 07:45:01', '2022-01-11 07:45:01'),
(619, 'upload/products/1641887166_SHARP CHEDDAR _ HAM CROQUE MONSIEUR.jpg', '2022-01-11 07:46:06', '2022-01-11 07:46:06'),
(620, 'upload/products/1641887202_QUESADILLA .jpg', '2022-01-11 07:46:42', '2022-01-11 07:46:42'),
(621, 'upload/products/1641887227_QUESADILLA 1.jpg', '2022-01-11 07:47:07', '2022-01-11 07:47:07'),
(622, 'upload/products/1641887379_SINGAPORE CURRY BOWL 3.jpg', '2022-01-11 07:49:39', '2022-01-11 07:49:39'),
(623, 'upload/products/1641887421_SINGAPORE CURRY BOWL 3.jpg', '2022-01-11 07:50:21', '2022-01-11 07:50:21'),
(624, 'upload/products/1641887451_SINGAPORE CURRY BOWL 3.jpg', '2022-01-11 07:50:51', '2022-01-11 07:50:51'),
(625, 'upload/products/1641887504_MALASIAN  CURRY BOWL .jpg', '2022-01-11 07:51:44', '2022-01-11 07:51:44'),
(626, 'upload/products/1641887571_MALASIAN  CURRY BOWL 1.jpg', '2022-01-11 07:52:51', '2022-01-11 07:52:51'),
(627, 'upload/products/1641887600_MALASIAN  CURRY BOWL 1.jpg', '2022-01-11 07:53:20', '2022-01-11 07:53:20'),
(628, 'upload/products/1641887715_RED THAI CURRY WITH STEAM RICE .jpg', '2022-01-11 07:55:15', '2022-01-11 07:55:15'),
(629, 'upload/products/1641887758_REDTHAI CURRY WITH STEAM RICE .jpg', '2022-01-11 07:55:58', '2022-01-11 07:55:58'),
(630, 'upload/products/1641887804_REDTHAI CURRY WITH STEAM RICE .jpg', '2022-01-11 07:56:44', '2022-01-11 07:56:44'),
(631, 'upload/products/1641888020_NASI GORENG .jpg', '2022-01-11 08:00:20', '2022-01-11 08:00:20'),
(632, 'upload/products/1641888089_NASI GORENG 1.jpg', '2022-01-11 08:01:29', '2022-01-11 08:01:29'),
(633, 'upload/products/1641888134_NASI GORENG .jpg', '2022-01-11 08:02:14', '2022-01-11 08:02:14'),
(634, 'upload/products/1641888258_MIE GOREN .jpg', '2022-01-11 08:04:18', '2022-01-11 08:04:18'),
(635, 'upload/products/1641888297_MIE GOREN 1.jpg', '2022-01-11 08:04:57', '2022-01-11 08:04:57'),
(636, 'upload/products/1641888358_MUMBAIYA KEEMA PAO 1.jpg', '2022-01-11 08:05:58', '2022-01-11 08:05:58'),
(637, 'upload/products/1641888408_SINGAPOREAN BURNT GARLIC FRIED RICE.jpg', '2022-01-11 08:06:48', '2022-01-11 08:06:48'),
(638, 'upload/products/1641888945_SINGAPOREAN BURNT GARLIC FRIED RICE 1.jpg', '2022-01-11 08:15:45', '2022-01-11 08:15:45'),
(639, 'upload/products/1641889060_SINGAPOREAN BURNT GARLIC FRIED RICE.jpg', '2022-01-11 08:17:40', '2022-01-11 08:17:40'),
(640, 'upload/products/1641889243_NASI GORENG .jpg', '2022-01-11 08:20:43', '2022-01-11 08:20:43'),
(641, 'upload/products/1641889251_SINGAPOREAN BURNT GARLIC FRIED RICE 1.jpg', '2022-01-11 08:20:51', '2022-01-11 08:20:51'),
(642, 'upload/products/1641889285_SISILIAN WHOLE ORANGE CAKE WITH CARAMEL SAUCE AND ICE CREAM 1.jpg', '2022-01-11 08:21:25', '2022-01-11 08:21:25'),
(643, 'upload/products/1641889448_LAMB STEW WITH LINGUINI .jpg', '2022-01-11 08:24:09', '2022-01-11 08:24:09'),
(644, 'upload/products/1641889460_LAMB STEW WITH LINGUINI 1.jpg', '2022-01-11 08:24:20', '2022-01-11 08:24:20'),
(645, 'upload/products/1641890057_GRILLED CHICKEN WITH LEMON MUSTARD SAUCE 1.jpg', '2022-01-11 08:34:17', '2022-01-11 08:34:17'),
(646, 'upload/products/1641890102_GRILLED CHICKEN WITH LEMON MUSTARD SAUCE 1.jpg', '2022-01-11 08:35:02', '2022-01-11 08:35:02'),
(647, 'upload/passport/1641895163_passport.jpg', '2022-01-11 09:59:23', '2022-01-11 09:59:23'),
(648, 'upload/passport/1641897104_IMG-20220111-WA0026.jpg', '2022-01-11 10:31:44', '2022-01-11 10:31:44'),
(649, 'upload/products/1641916607_1640158685 (1).jpg', '2022-01-11 15:56:47', '2022-01-11 15:56:47'),
(650, 'upload/products/1641973468_WhatsApp Image 2022-01-11 at 2.26.30 PM.jpeg', '2022-01-12 07:44:28', '2022-01-12 07:44:28'),
(651, 'upload/products/1641973582_WhatsApp Image 2022-01-11 at 2.27.18 PM.jpeg', '2022-01-12 07:46:22', '2022-01-12 07:46:22'),
(652, 'upload/products/1641973589_WhatsApp Image 2022-01-11 at 2.26.30 PM.jpeg', '2022-01-12 07:46:29', '2022-01-12 07:46:29'),
(653, 'upload/products/1641973620_WhatsApp Image 2022-01-11 at 2.29.57 PM.jpeg', '2022-01-12 07:47:00', '2022-01-12 07:47:00'),
(654, 'upload/products/1641973643_WhatsApp Image 2022-01-11 at 2.27.18 PM.jpeg', '2022-01-12 07:47:23', '2022-01-12 07:47:23'),
(655, 'upload/products/1641973664_WhatsApp Image 2022-01-11 at 2.39.04 PM.jpeg', '2022-01-12 07:47:44', '2022-01-12 07:47:44'),
(656, 'upload/places/icons/1642079635_1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0002.jpg', '2022-01-13 13:13:55', '2022-01-13 13:13:55'),
(657, 'upload/places/icons/1642079660_1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0004.jpg', '2022-01-13 13:14:20', '2022-01-13 13:14:20'),
(658, 'upload/products/1642175813_TAPAS BOX.jpg', '2022-01-14 15:56:53', '2022-01-14 15:56:53'),
(659, 'upload/products/1642175862_POLLO OLIVATTI .jpg', '2022-01-14 15:57:42', '2022-01-14 15:57:42'),
(660, 'upload/products/1642176019_QUESADILLA .jpg', '2022-01-14 16:00:19', '2022-01-14 16:00:19'),
(661, 'upload/products/1642320873_20220112_162632 (FILEminimizer).jpg', '2022-01-16 08:14:33', '2022-01-16 08:14:33'),
(662, 'upload/products/1642320889_20220112_162632 (FILEminimizer).jpg', '2022-01-16 08:14:49', '2022-01-16 08:14:49'),
(663, 'upload/products/1642320901_20220112_162632 (FILEminimizer).jpg', '2022-01-16 08:15:01', '2022-01-16 08:15:01'),
(664, 'upload/products/1642320956_MIE GOREN .jpg', '2022-01-16 08:15:56', '2022-01-16 08:15:56'),
(665, 'upload/products/1642320974_MIE GOREN 1.jpg', '2022-01-16 08:16:14', '2022-01-16 08:16:14'),
(666, 'upload/products/1642321008_MIE GOREN .jpg', '2022-01-16 08:16:48', '2022-01-16 08:16:48'),
(667, 'upload/products/1642321137_20220113_165227 (FILEminimizer).jpg', '2022-01-16 08:18:57', '2022-01-16 08:18:57'),
(668, 'upload/products/1642321195_20220113_165210 (FILEminimizer).jpg', '2022-01-16 08:19:55', '2022-01-16 08:19:55'),
(669, 'upload/products/1642321230_20220112_162221 (FILEminimizer).jpg', '2022-01-16 08:20:30', '2022-01-16 08:20:30'),
(670, 'upload/products/1642321245_20220112_162229 (FILEminimizer).jpg', '2022-01-16 08:20:45', '2022-01-16 08:20:45'),
(671, 'upload/products/1642321351_20220115_134800 (FILEminimizer).jpg', '2022-01-16 08:22:31', '2022-01-16 08:22:31'),
(672, 'upload/products/1642321371_20220115_133845 (FILEminimizer).jpg', '2022-01-16 08:22:51', '2022-01-16 08:22:51'),
(673, 'upload/products/1642321396_20220113_131032 (FILEminimizer).jpg', '2022-01-16 08:23:16', '2022-01-16 08:23:16'),
(674, 'upload/products/1642321441_20220115_155723 (FILEminimizer).jpg', '2022-01-16 08:24:01', '2022-01-16 08:24:01'),
(675, 'upload/products/1642321460_20220115_150553 (FILEminimizer).jpg', '2022-01-16 08:24:20', '2022-01-16 08:24:20'),
(676, 'upload/products/1642321482_20220113_150714 (FILEminimizer).jpg', '2022-01-16 08:24:42', '2022-01-16 08:24:42'),
(677, 'upload/products/1642321546_20220114_124654 (FILEminimizer).jpg', '2022-01-16 08:25:46', '2022-01-16 08:25:46'),
(678, 'upload/products/1642321566_20220114_130331 (FILEminimizer).jpg', '2022-01-16 08:26:06', '2022-01-16 08:26:06'),
(679, 'upload/products/1642321591_20220115_162713 (FILEminimizer).jpg', '2022-01-16 08:26:31', '2022-01-16 08:26:31'),
(680, 'upload/products/1642321693_20220114_130816 (FILEminimizer).jpg', '2022-01-16 08:28:13', '2022-01-16 08:28:13'),
(681, 'upload/products/1642321718_20220113_152937 (FILEminimizer).jpg', '2022-01-16 08:28:38', '2022-01-16 08:28:38'),
(682, 'upload/products/1642321761_20220115_125334 (FILEminimizer).jpg', '2022-01-16 08:29:21', '2022-01-16 08:29:21'),
(683, 'upload/products/1642321778_20220113_142915 (FILEminimizer).jpg', '2022-01-16 08:29:38', '2022-01-16 08:29:38'),
(684, 'upload/products/1642321827_FINCH_S SPECIAL INDIAN MASALA.jpg', '2022-01-16 08:30:27', '2022-01-16 08:30:27'),
(685, 'upload/products/1642321867_KUNG PAO TOFU AND BROCCOLI.jpg', '2022-01-16 08:31:07', '2022-01-16 08:31:07'),
(686, 'upload/products/1642321906_20220113_163506 (FILEminimizer).jpg', '2022-01-16 08:31:46', '2022-01-16 08:31:46'),
(687, 'upload/products/1642321986_20220115_174848 (FILEminimizer).jpg', '2022-01-16 08:33:06', '2022-01-16 08:33:06'),
(688, 'upload/products/1642322025_NASI GORENG .jpg', '2022-01-16 08:33:45', '2022-01-16 08:33:45'),
(689, 'upload/products/1642322056_NASI GORENG 1.jpg', '2022-01-16 08:34:16', '2022-01-16 08:34:16'),
(690, 'upload/products/1642322104_20220113_160156 (FILEminimizer).jpg', '2022-01-16 08:35:04', '2022-01-16 08:35:04'),
(691, 'upload/products/1642322123_20220115_164552 (FILEminimizer).jpg', '2022-01-16 08:35:23', '2022-01-16 08:35:23'),
(692, 'upload/products/1642322167_RED THAI CURRY WITH STEAM RICE .jpg', '2022-01-16 08:36:07', '2022-01-16 08:36:07'),
(693, 'upload/products/1642322191_REDTHAI CURRY WITH STEAM RICE .jpg', '2022-01-16 08:36:31', '2022-01-16 08:36:31'),
(694, 'upload/products/1642322206_REDTHAI CURRY WITH STEAM RICE .jpg', '2022-01-16 08:36:46', '2022-01-16 08:36:46'),
(695, 'upload/products/1642322338_QUESADILLA .jpg', '2022-01-16 08:38:58', '2022-01-16 08:38:58'),
(696, 'upload/products/1642323236_WhatsApp Image 2022-01-11 at 2.29.57 PM.jpeg', '2022-01-16 08:53:56', '2022-01-16 08:53:56'),
(697, 'upload/products/1642323363_WhatsApp Image 2022-01-11 at 2.25.37 PM.jpeg', '2022-01-16 08:56:03', '2022-01-16 08:56:03'),
(698, 'upload/places/icons/1642418038_WhatsApp Image 2022-01-17 at 4.30.01 PM.jpeg', '2022-01-17 11:13:58', '2022-01-17 11:13:58'),
(699, 'upload/products/1642596251_choc mudslide (FILEminimizer).jpg', '2022-01-19 12:44:11', '2022-01-19 12:44:11'),
(700, 'upload/products/1642596274_Dal Makhani (FILEminimizer).jpg', '2022-01-19 12:44:34', '2022-01-19 12:44:34'),
(701, 'upload/products/1642596288_egg bhurji (FILEminimizer).jpg', '2022-01-19 12:44:48', '2022-01-19 12:44:48'),
(702, 'upload/products/1642596307_chic burger (FILEminimizer).jpg', '2022-01-19 12:45:07', '2022-01-19 12:45:07'),
(703, 'upload/products/1642596384_CHICKEN MOJO ROJO PANINI (FILEminimizer).jpg', '2022-01-19 12:46:24', '2022-01-19 12:46:24'),
(704, 'upload/products/1642596395_chicken tikka pizza (FILEminimizer).jpg', '2022-01-19 12:46:35', '2022-01-19 12:46:35'),
(705, 'upload/products/1642596407_HOT CHILLI VEGETABLES 1 (FILEminimizer).jpg', '2022-01-19 12:46:47', '2022-01-19 12:46:47'),
(706, 'upload/products/1642596426_non veg platter (FILEminimizer).jpg', '2022-01-19 12:47:06', '2022-01-19 12:47:06'),
(707, 'upload/products/1642596479_veg platter (FILEminimizer).jpg', '2022-01-19 12:47:59', '2022-01-19 12:47:59'),
(708, 'upload/products/1642596491_fish tikka (FILEminimizer).jpg', '2022-01-19 12:48:11', '2022-01-19 12:48:11'),
(709, 'upload/products/1642596505_mushroom galouti (FILEminimizer).jpg', '2022-01-19 12:48:25', '2022-01-19 12:48:25'),
(710, 'upload/products/1642596526_Paneer Tikka (FILEminimizer).jpg', '2022-01-19 12:48:46', '2022-01-19 12:48:46'),
(711, 'upload/products/1642596602_Caesar Salad (FILEminimizer).jpg', '2022-01-19 12:50:02', '2022-01-19 12:50:02'),
(712, 'upload/products/1642596623_Paneer Tikka (FILEminimizer).jpg', '2022-01-19 12:50:23', '2022-01-19 12:50:23'),
(713, 'upload/products/1642596640_fish tikka (FILEminimizer).jpg', '2022-01-19 12:50:40', '2022-01-19 12:50:40'),
(714, 'upload/products/1642596660_mushroom galouti (FILEminimizer).jpg', '2022-01-19 12:51:00', '2022-01-19 12:51:00'),
(715, 'upload/products/1642596773_20211015_192216.jpg', '2022-01-19 12:52:53', '2022-01-19 12:52:53'),
(716, 'upload/products/1642596952_choc mudslide (FILEminimizer).jpg', '2022-01-19 12:55:52', '2022-01-19 12:55:52'),
(717, 'upload/products/1642596973_Dal Makhani (FILEminimizer).jpg', '2022-01-19 12:56:13', '2022-01-19 12:56:13'),
(718, 'upload/products/1642596985_egg bhurji (FILEminimizer).jpg', '2022-01-19 12:56:25', '2022-01-19 12:56:25'),
(719, 'upload/products/1642597014_chic burger (FILEminimizer).jpg', '2022-01-19 12:56:54', '2022-01-19 12:56:54'),
(720, 'upload/products/1642597030_CHICKEN MOJO ROJO PANINI (FILEminimizer).jpg', '2022-01-19 12:57:10', '2022-01-19 12:57:10'),
(721, 'upload/products/1642597041_chicken tikka pizza (FILEminimizer).jpg', '2022-01-19 12:57:21', '2022-01-19 12:57:21'),
(722, 'upload/products/1642597056_HOT CHILLI VEGETABLES 1 (FILEminimizer).jpg', '2022-01-19 12:57:36', '2022-01-19 12:57:36'),
(723, 'upload/products/1642597069_Caesar Salad (FILEminimizer).jpg', '2022-01-19 12:57:49', '2022-01-19 12:57:49'),
(724, 'upload/products/1642597090_non veg platter (FILEminimizer).jpg', '2022-01-19 12:58:10', '2022-01-19 12:58:10'),
(725, 'upload/products/1642597121_veg platter (FILEminimizer).jpg', '2022-01-19 12:58:41', '2022-01-19 12:58:41'),
(726, 'upload/products/1642597148_fish tikka (FILEminimizer).jpg', '2022-01-19 12:59:08', '2022-01-19 12:59:08'),
(727, 'upload/products/1642597167_mushroom galouti (FILEminimizer).jpg', '2022-01-19 12:59:27', '2022-01-19 12:59:27'),
(728, 'upload/products/1642597196_Paneer Tikka (FILEminimizer).jpg', '2022-01-19 12:59:56', '2022-01-19 12:59:56'),
(729, 'upload/products/1642597285_20220113_153016 (FILEminimizer).jpg', '2022-01-19 13:01:25', '2022-01-19 13:01:25'),
(730, 'upload/products/1642597309_20220113_165222 (FILEminimizer).jpg', '2022-01-19 13:01:49', '2022-01-19 13:01:49'),
(731, 'upload/products/1642597333_20220113_165205 (FILEminimizer).jpg', '2022-01-19 13:02:13', '2022-01-19 13:02:13'),
(732, 'upload/products/1642597456_20220115_134751 (FILEminimizer).jpg', '2022-01-19 13:04:16', '2022-01-19 13:04:16'),
(733, 'upload/products/1642597474_20220115_133845 (FILEminimizer).jpg', '2022-01-19 13:04:34', '2022-01-19 13:04:34'),
(734, 'upload/products/1642597495_20220113_131023 (FILEminimizer).jpg', '2022-01-19 13:04:55', '2022-01-19 13:04:55'),
(735, 'upload/products/1642597516_20220115_155721 (FILEminimizer).jpg', '2022-01-19 13:05:16', '2022-01-19 13:05:16'),
(736, 'upload/products/1642597534_20220115_150557 (FILEminimizer).jpg', '2022-01-19 13:05:34', '2022-01-19 13:05:34'),
(737, 'upload/products/1642597551_20220113_163448 (FILEminimizer).jpg', '2022-01-19 13:05:51', '2022-01-19 13:05:51'),
(738, 'upload/products/1642597624_20220114_130331 (FILEminimizer).jpg', '2022-01-19 13:07:04', '2022-01-19 13:07:04'),
(739, 'upload/products/1642597648_20220115_125336 (FILEminimizer).jpg', '2022-01-19 13:07:28', '2022-01-19 13:07:28'),
(740, 'upload/products/1642597667_20220113_142915 (FILEminimizer).jpg', '2022-01-19 13:07:47', '2022-01-19 13:07:47'),
(741, 'upload/products/1642597683_20220115_162731 (FILEminimizer).jpg', '2022-01-19 13:08:03', '2022-01-19 13:08:03'),
(742, 'upload/products/1642597711_20220113_152944 (FILEminimizer).jpg', '2022-01-19 13:08:31', '2022-01-19 13:08:31'),
(743, 'upload/products/1642597787_20220115_123817 (FILEminimizer).jpg', '2022-01-19 13:09:47', '2022-01-19 13:09:47'),
(744, 'upload/products/1642597807_20220114_124654 (FILEminimizer).jpg', '2022-01-19 13:10:07', '2022-01-19 13:10:07'),
(745, 'upload/products/1642597834_20220113_150713 (FILEminimizer).jpg', '2022-01-19 13:10:34', '2022-01-19 13:10:34'),
(746, 'upload/products/1642597874_20220112_162221 (FILEminimizer).jpg', '2022-01-19 13:11:14', '2022-01-19 13:11:14'),
(747, 'upload/products/1642597887_20220112_162229 (FILEminimizer).jpg', '2022-01-19 13:11:27', '2022-01-19 13:11:27'),
(748, 'upload/products/1642597929_20220112_162632 (FILEminimizer).jpg', '2022-01-19 13:12:09', '2022-01-19 13:12:09'),
(749, 'upload/products/1642597942_20220112_162632 (FILEminimizer).jpg', '2022-01-19 13:12:22', '2022-01-19 13:12:22'),
(750, 'upload/products/1642597975_20220115_174908 (FILEminimizer).jpg', '2022-01-19 13:12:55', '2022-01-19 13:12:55'),
(751, 'upload/products/1642598005_20220115_164552 (FILEminimizer).jpg', '2022-01-19 13:13:25', '2022-01-19 13:13:25'),
(752, 'upload/products/1642602098_MIE GOREN  (FILEminimizer).jpg', '2022-01-19 14:21:38', '2022-01-19 14:21:38'),
(753, 'upload/products/1642602111_MIE GOREN 1 (FILEminimizer).jpg', '2022-01-19 14:21:51', '2022-01-19 14:21:51'),
(754, 'upload/products/1642602130_MIE GOREN  (FILEminimizer).jpg', '2022-01-19 14:22:10', '2022-01-19 14:22:10'),
(755, 'upload/products/1642602141_NASI GORENG  (FILEminimizer).jpg', '2022-01-19 14:22:21', '2022-01-19 14:22:21'),
(756, 'upload/products/1642602158_NASI GORENG 1 (FILEminimizer).jpg', '2022-01-19 14:22:38', '2022-01-19 14:22:38'),
(757, 'upload/products/1642602194_RED THAI CURRY WITH STEAM RICE  (FILEminimizer).jpg', '2022-01-19 14:23:14', '2022-01-19 14:23:14'),
(758, 'upload/products/1642602215_REDTHAI CURRY WITH STEAM RICE  (FILEminimizer).jpg', '2022-01-19 14:23:35', '2022-01-19 14:23:35'),
(759, 'upload/products/1642602245_veg burger (FILEminimizer).jpg', '2022-01-19 14:24:05', '2022-01-19 14:24:05'),
(760, 'upload/products/1642602269_QUESADILLA  (FILEminimizer).jpg', '2022-01-19 14:24:29', '2022-01-19 14:24:29'),
(761, 'upload/products/1642602280_QUESADILLA 1 (FILEminimizer).jpg', '2022-01-19 14:24:40', '2022-01-19 14:24:40'),
(762, 'upload/products/1642602319_tapas (FILEminimizer).jpg', '2022-01-19 14:25:19', '2022-01-19 14:25:19'),
(763, 'upload/products/1642602431_KUNG PAO TOFU AND BROCCOLI.jpg', '2022-01-19 14:27:11', '2022-01-19 14:27:11'),
(764, 'upload/products/1642602463_WhatsApp Image 2022-01-11 at 2.25.37 PM.jpeg', '2022-01-19 14:27:43', '2022-01-19 14:27:43'),
(765, 'upload/products/1642602576_WhatsApp Image 2022-01-11 at 2.29.57 PM.jpeg', '2022-01-19 14:29:36', '2022-01-19 14:29:36'),
(766, 'upload/products/1642690684_MIE GOREN  (FILEminimizer).jpg', '2022-01-20 14:58:04', '2022-01-20 14:58:04'),
(767, 'upload/products/1642690724_MIE GOREN  (FILEminimizer).jpg', '2022-01-20 14:58:44', '2022-01-20 14:58:44'),
(768, 'upload/products/1642690740_MIE GOREN  (FILEminimizer).jpg', '2022-01-20 14:59:00', '2022-01-20 14:59:00'),
(769, 'upload/products/1642690757_MIE GOREN  (FILEminimizer).jpg', '2022-01-20 14:59:17', '2022-01-20 14:59:17'),
(770, 'upload/products/1642690771_MIE GOREN  (FILEminimizer).jpg', '2022-01-20 14:59:31', '2022-01-20 14:59:31'),
(771, 'upload/products/1642690790_MIE GOREN 1 (FILEminimizer).jpg', '2022-01-20 14:59:50', '2022-01-20 14:59:50'),
(772, 'upload/products/1642690806_MIE GOREN 1 (FILEminimizer).jpg', '2022-01-20 15:00:06', '2022-01-20 15:00:06'),
(773, 'upload/products/1642690822_MIE GOREN 1 (FILEminimizer).jpg', '2022-01-20 15:00:22', '2022-01-20 15:00:22'),
(774, 'upload/products/1642690879_NASI GORENG 1 (FILEminimizer).jpg', '2022-01-20 15:01:19', '2022-01-20 15:01:19'),
(775, 'upload/products/1642690894_NASI GORENG 1 (FILEminimizer).jpg', '2022-01-20 15:01:34', '2022-01-20 15:01:34'),
(776, 'upload/products/1642690907_NASI GORENG 1 (FILEminimizer).jpg', '2022-01-20 15:01:47', '2022-01-20 15:01:47'),
(777, 'upload/products/1642690920_NASI GORENG  (FILEminimizer).jpg', '2022-01-20 15:02:00', '2022-01-20 15:02:00'),
(778, 'upload/products/1642690931_NASI GORENG  (FILEminimizer).jpg', '2022-01-20 15:02:11', '2022-01-20 15:02:11'),
(779, 'upload/products/1642690943_NASI GORENG  (FILEminimizer).jpg', '2022-01-20 15:02:23', '2022-01-20 15:02:23'),
(780, 'upload/products/1642690954_NASI GORENG  (FILEminimizer).jpg', '2022-01-20 15:02:34', '2022-01-20 15:02:34'),
(781, 'upload/products/1642691030_QUESADILLA  (FILEminimizer).jpg', '2022-01-20 15:03:50', '2022-01-20 15:03:50'),
(782, 'upload/products/1642691042_QUESADILLA  (FILEminimizer).jpg', '2022-01-20 15:04:02', '2022-01-20 15:04:02'),
(783, 'upload/products/1642691054_QUESADILLA  (FILEminimizer).jpg', '2022-01-20 15:04:14', '2022-01-20 15:04:14'),
(784, 'upload/products/1642691065_QUESADILLA 1 (FILEminimizer).jpg', '2022-01-20 15:04:25', '2022-01-20 15:04:25'),
(785, 'upload/products/1642691075_QUESADILLA 1 (FILEminimizer).jpg', '2022-01-20 15:04:35', '2022-01-20 15:04:35'),
(786, 'upload/products/1642691085_QUESADILLA 1 (FILEminimizer).jpg', '2022-01-20 15:04:45', '2022-01-20 15:04:45'),
(787, 'upload/products/1642691187_RED THAI CURRY WITH STEAM RICE  (FILEminimizer).jpg', '2022-01-20 15:06:27', '2022-01-20 15:06:27'),
(788, 'upload/products/1642691198_RED THAI CURRY WITH STEAM RICE  (FILEminimizer).jpg', '2022-01-20 15:06:38', '2022-01-20 15:06:38'),
(789, 'upload/products/1642691209_RED THAI CURRY WITH STEAM RICE  (FILEminimizer).jpg', '2022-01-20 15:06:49', '2022-01-20 15:06:49'),
(790, 'upload/products/1642691224_REDTHAI CURRY WITH STEAM RICE  (FILEminimizer).jpg', '2022-01-20 15:07:04', '2022-01-20 15:07:04'),
(791, 'upload/products/1642691236_REDTHAI CURRY WITH STEAM RICE  (FILEminimizer).jpg', '2022-01-20 15:07:16', '2022-01-20 15:07:16'),
(792, 'upload/products/1642691249_REDTHAI CURRY WITH STEAM RICE  (FILEminimizer).jpg', '2022-01-20 15:07:29', '2022-01-20 15:07:29'),
(793, 'upload/products/1642691262_THAI CURRY WITH STEAM RICE 1 (FILEminimizer).jpg', '2022-01-20 15:07:42', '2022-01-20 15:07:42'),
(794, 'upload/products/1642691339_tapas (FILEminimizer).jpg', '2022-01-20 15:08:59', '2022-01-20 15:08:59'),
(795, 'upload/products/1642691354_tapas (FILEminimizer).jpg', '2022-01-20 15:09:14', '2022-01-20 15:09:14'),
(796, 'upload/products/1642691364_tapas (FILEminimizer).jpg', '2022-01-20 15:09:24', '2022-01-20 15:09:24'),
(797, 'upload/products/1642691419_20220113_163451 (FILEminimizer).jpg', '2022-01-20 15:10:19', '2022-01-20 15:10:19'),
(798, 'upload/products/1642691432_20220113_163506 (FILEminimizer).jpg', '2022-01-20 15:10:32', '2022-01-20 15:10:32'),
(799, 'upload/products/1642691441_20220113_163509 (FILEminimizer).jpg', '2022-01-20 15:10:41', '2022-01-20 15:10:41'),
(800, 'upload/products/1642691601_20220112_162632 (FILEminimizer).jpg', '2022-01-20 15:13:21', '2022-01-20 15:13:21'),
(801, 'upload/products/1642692338_THAI CHILLI NOODLE 1.jpg', '2022-01-20 15:25:38', '2022-01-20 15:25:38'),
(802, 'upload/products/1642692351_THAI CHILLI NOODLE 1.jpg', '2022-01-20 15:25:51', '2022-01-20 15:25:51'),
(803, 'upload/products/1642692366_THAI CHILLI NOODLE 1.jpg', '2022-01-20 15:26:06', '2022-01-20 15:26:06'),
(804, 'upload/products/1642692376_THAI CHILLI NOODLE 1.jpg', '2022-01-20 15:26:16', '2022-01-20 15:26:16'),
(805, 'upload/products/1642692470_20220113_160156 (FILEminimizer).jpg', '2022-01-20 15:27:50', '2022-01-20 15:27:50'),
(806, 'upload/products/1642692480_20220113_160156 (FILEminimizer).jpg', '2022-01-20 15:28:00', '2022-01-20 15:28:00'),
(807, 'upload/products/1642692489_20220113_160156 (FILEminimizer).jpg', '2022-01-20 15:28:09', '2022-01-20 15:28:09'),
(808, 'upload/products/1642692544_20220113_142916 (FILEminimizer).jpg', '2022-01-20 15:29:04', '2022-01-20 15:29:04'),
(809, 'upload/products/1642692553_20220113_142915 (FILEminimizer).jpg', '2022-01-20 15:29:13', '2022-01-20 15:29:13'),
(810, 'upload/products/1642692670_20220113_165230 (FILEminimizer).jpg', '2022-01-20 15:31:10', '2022-01-20 15:31:10'),
(811, 'upload/products/1642692708_20220113_152944 (FILEminimizer).jpg', '2022-01-20 15:31:48', '2022-01-20 15:31:48'),
(812, 'upload/products/1642692718_20220113_152944 (FILEminimizer).jpg', '2022-01-20 15:31:58', '2022-01-20 15:31:58'),
(813, 'upload/products/1642692726_20220113_152944 (FILEminimizer).jpg', '2022-01-20 15:32:06', '2022-01-20 15:32:06'),
(814, 'upload/products/1642692770_20220115_123815 (FILEminimizer).jpg', '2022-01-20 15:32:50', '2022-01-20 15:32:50'),
(815, 'upload/products/1642692779_20220115_123815 (FILEminimizer).jpg', '2022-01-20 15:32:59', '2022-01-20 15:32:59'),
(816, 'upload/products/1642692786_20220115_123815 (FILEminimizer).jpg', '2022-01-20 15:33:06', '2022-01-20 15:33:06'),
(817, 'upload/products/1642692848_20220115_174914 (FILEminimizer).jpg', '2022-01-20 15:34:08', '2022-01-20 15:34:08'),
(818, 'upload/products/1642692860_20220115_174914 (FILEminimizer).jpg', '2022-01-20 15:34:20', '2022-01-20 15:34:20'),
(819, 'upload/products/1642692870_20220115_174914 (FILEminimizer).jpg', '2022-01-20 15:34:30', '2022-01-20 15:34:30'),
(820, 'upload/products/1642692977_20220115_125338 (FILEminimizer).jpg', '2022-01-20 15:36:17', '2022-01-20 15:36:17'),
(821, 'upload/products/1642692985_20220115_125338 (FILEminimizer).jpg', '2022-01-20 15:36:25', '2022-01-20 15:36:25'),
(822, 'upload/products/1642692993_20220115_125338 (FILEminimizer).jpg', '2022-01-20 15:36:33', '2022-01-20 15:36:33'),
(823, 'upload/products/1642777427_KUNG PAO TOFU AND BROCCOLI (FILEminimizer).jpg', '2022-01-21 15:03:47', '2022-01-21 15:03:47'),
(824, 'upload/products/1642777436_KUNG PAO TOFU AND BROCCOLI (FILEminimizer).jpg', '2022-01-21 15:03:56', '2022-01-21 15:03:56'),
(825, 'upload/products/1642777447_KUNG PAO TOFU AND BROCCOLI (FILEminimizer).jpg', '2022-01-21 15:04:07', '2022-01-21 15:04:07'),
(826, 'upload/products/1642777464_LAMB STEW WITH LINGUINI 1 (FILEminimizer).jpg', '2022-01-21 15:04:24', '2022-01-21 15:04:24'),
(827, 'upload/products/1642777488_MALASIAN  CURRY BOWL  (FILEminimizer).jpg', '2022-01-21 15:04:48', '2022-01-21 15:04:48'),
(828, 'upload/products/1642777497_MALASIAN  CURRY BOWL  (FILEminimizer).jpg', '2022-01-21 15:04:57', '2022-01-21 15:04:57'),
(829, 'upload/products/1642777508_MALASIAN  CURRY BOWL 1 (FILEminimizer).jpg', '2022-01-21 15:05:08', '2022-01-21 15:05:08'),
(830, 'upload/products/1642777526_MUMBAIYA KEEMA PAO 1 (FILEminimizer).jpg', '2022-01-21 15:05:26', '2022-01-21 15:05:26'),
(831, 'upload/products/1642777542_PANKO CRUSTED TEMPURA SHRIMPS 1 (FILEminimizer).jpg', '2022-01-21 15:05:42', '2022-01-21 15:05:42'),
(832, 'upload/products/1642777561_POTATO, EGG AND BACON SALAD (FILEminimizer).jpg', '2022-01-21 15:06:01', '2022-01-21 15:06:01'),
(833, 'upload/products/1642777619_SINGAPORE WOK TOSSED CHICKEN 1 (FILEminimizer).jpg', '2022-01-21 15:06:59', '2022-01-21 15:06:59'),
(834, 'upload/products/1642777654_SINGAPORE CURRY BOWL 3 (FILEminimizer).jpg', '2022-01-21 15:07:34', '2022-01-21 15:07:34'),
(835, 'upload/products/1642777665_SINGAPORE CURRY BOWL 3 (FILEminimizer).jpg', '2022-01-21 15:07:45', '2022-01-21 15:07:45'),
(836, 'upload/products/1642777678_SINGAPORE CURRY BOWL 3 (FILEminimizer).jpg', '2022-01-21 15:07:58', '2022-01-21 15:07:58'),
(837, 'upload/products/1642777696_SINGAPOREAN BURNT GARLIC FRIED RICE 1 (FILEminimizer).jpg', '2022-01-21 15:08:16', '2022-01-21 15:08:16'),
(838, 'upload/products/1642777714_SINGAPOREAN BURNT GARLIC FRIED RICE 1 (FILEminimizer).jpg', '2022-01-21 15:08:34', '2022-01-21 15:08:34'),
(839, 'upload/products/1642777752_SRILANKAN FIERY PRAWN (FILEminimizer).jpg', '2022-01-21 15:09:12', '2022-01-21 15:09:12'),
(840, 'upload/products/1642777784_STYLISH SALTIMBOCCA (FILEminimizer).jpg', '2022-01-21 15:09:44', '2022-01-21 15:09:44'),
(841, 'upload/products/1642777804_VIETNAMESE STYLE CHILLY CELERY COTTAGE CHEESE 1 (FILEminimizer).jpg', '2022-01-21 15:10:04', '2022-01-21 15:10:04'),
(842, 'upload/products/1642777820_Tacos (FILEminimizer).jpg', '2022-01-21 15:10:20', '2022-01-21 15:10:20'),
(843, 'upload/products/1642777842_THE FARMER SALAD  (FILEminimizer).jpg', '2022-01-21 15:10:42', '2022-01-21 15:10:42'),
(844, 'upload/products/1642777882_VOLCANO NACHOS 2 (FILEminimizer).jpg', '2022-01-21 15:11:22', '2022-01-21 15:11:22'),
(845, 'upload/products/1642777897_VOLCANO NACHOS 2 (FILEminimizer).jpg', '2022-01-21 15:11:37', '2022-01-21 15:11:37'),
(846, 'upload/products/1642777910_VOLCANO NACHOS 2 (FILEminimizer).jpg', '2022-01-21 15:11:50', '2022-01-21 15:11:50'),
(847, 'upload/products/1642777938_WILD MUSHROOM CROQUE MONSIEUR 2 (FILEminimizer).jpg', '2022-01-21 15:12:18', '2022-01-21 15:12:18'),
(848, 'upload/products/1642785592_Butter Roti.jpg', '2022-01-21 17:19:52', '2022-01-21 17:19:52'),
(849, 'upload/products/1642785603_Butter Roti.jpg', '2022-01-21 17:20:03', '2022-01-21 17:20:03'),
(850, 'upload/products/1642785629_Lachha Paratha.jpg', '2022-01-21 17:20:29', '2022-01-21 17:20:29'),
(851, 'upload/products/1642785641_Lachha Paratha.jpg', '2022-01-21 17:20:41', '2022-01-21 17:20:41'),
(852, 'upload/products/1642785652_Hari Mirchi Ka Paratha.jpg', '2022-01-21 17:20:52', '2022-01-21 17:20:52'),
(853, 'upload/products/1642785662_Hari Mirchi Ka Paratha.jpg', '2022-01-21 17:21:02', '2022-01-21 17:21:02'),
(854, 'upload/products/1642785680_Butter Naan.jpg', '2022-01-21 17:21:20', '2022-01-21 17:21:20'),
(855, 'upload/products/1642785692_Butter Naan.jpg', '2022-01-21 17:21:32', '2022-01-21 17:21:32'),
(856, 'upload/products/1642785841_Chinese-Steamed-Rice-2.jpg', '2022-01-21 17:24:01', '2022-01-21 17:24:01'),
(857, 'upload/products/1642785851_Chinese-Steamed-Rice-2.jpg', '2022-01-21 17:24:11', '2022-01-21 17:24:11'),
(858, 'upload/products/1644778232_user.png', '2022-02-13 18:50:32', '2022-02-13 18:50:32'),
(859, 'upload/products/1644778239_1.jpeg', '2022-02-13 18:50:39', '2022-02-13 18:50:39'),
(860, 'upload/products/1644818134_1.jpeg', '2022-02-14 05:55:34', '2022-02-14 05:55:34'),
(861, 'upload/products/1644818139_ADYSB00019_MUL_FRT4_1800-2400_large.jpeg', '2022-02-14 05:55:39', '2022-02-14 05:55:39'),
(862, 'upload/products/1644818696_DawsonTrolley_Moss_Front_6cca3dc3-51d3-4205-a1e1-ed5d9a03e181_grande.jpeg', '2022-02-14 06:04:56', '2022-02-14 06:04:56'),
(863, 'upload/products/1644818699_DawsonTrolley_Moss_HandleOpen_14842a9b-7222-4ce2-9d17-4731d23454a7_grande.jpeg', '2022-02-14 06:04:59', '2022-02-14 06:04:59'),
(864, 'upload/products/1644838080_user.png', '2022-02-14 11:28:00', '2022-02-14 11:28:00'),
(865, 'upload/products/1644838088_500x500.jpg', '2022-02-14 11:28:08', '2022-02-14 11:28:08'),
(866, 'upload/products/1644838091_500x500.jpg', '2022-02-14 11:28:11', '2022-02-14 11:28:11'),
(867, 'upload/products/1644839003_500x500.jpg', '2022-02-14 11:43:23', '2022-02-14 11:43:23'),
(868, 'upload/products/1644839009_500x500.jpg', '2022-02-14 11:43:29', '2022-02-14 11:43:29'),
(869, 'upload/products/1644922474_1640093721_Lager (1).png', '2022-02-15 10:54:34', '2022-02-15 10:54:34'),
(870, 'upload/products/1644922492_1640176147_4.png', '2022-02-15 10:54:52', '2022-02-15 10:54:52'),
(871, '809_Resources-Pompeo-Group-Executive-Recruiters.png', '2022-02-18 08:45:35', '2022-02-18 08:45:35'),
(872, '642_logo.png', '2022-02-18 08:45:45', '2022-02-18 08:45:45'),
(873, 'upload/banners/1647524122_Beer (2).jpg', '2022-03-17 13:35:22', '2022-03-17 13:35:22'),
(874, 'upload/banners/1647524135_JALAPINOS _CHICKEN SLIDER 1.jpg', '2022-03-17 13:35:35', '2022-03-17 13:35:35'),
(875, 'upload/products/1647674683_WhatsApp Image 2022-03-19 at 12.18.24 PM.jpeg', '2022-03-19 07:24:43', '2022-03-19 07:24:43'),
(876, 'upload/products/1647674692_WhatsApp Image 2022-03-19 at 12.18.23 PM (1).jpeg', '2022-03-19 07:24:52', '2022-03-19 07:24:52'),
(877, 'upload/offers/1647941555_276075368_736582394388599_2073312490991559055_n.jpg', '2022-03-22 09:32:35', '2022-03-22 09:32:35'),
(878, 'upload/offers/1647941587_275853240_734674454579393_495570573301685567_n.png', '2022-03-22 09:33:07', '2022-03-22 09:33:07'),
(879, 'upload/offers/1647941616_275668099_731950571518448_4244311666229443482_n.jpg', '2022-03-22 09:33:36', '2022-03-22 09:33:36'),
(880, 'upload/offers/1647941655_275681466_731948521518653_7345390094988334790_n (1).jpg', '2022-03-22 09:34:15', '2022-03-22 09:34:15'),
(881, 'upload/offers/1647941697_275853240_734674454579393_495570573301685567_n.png', '2022-03-22 09:34:57', '2022-03-22 09:34:57'),
(882, 'upload/offers/1647941781_275853240_734674454579393_495570573301685567_n.png', '2022-03-22 09:36:21', '2022-03-22 09:36:21'),
(883, 'upload/offers/1647942233_276127030_138702981996182_4702241475681711246_n.jpg', '2022-03-22 09:43:53', '2022-03-22 09:43:53'),
(884, 'upload/offers/1647942277_276021035_23850086788060616_3804342210813405638_n.jpg', '2022-03-22 09:44:37', '2022-03-22 09:44:37'),
(885, 'upload/products/1648037439_HANDCUT FRIES TRUFFLE 1.jpg', '2022-03-23 12:10:39', '2022-03-23 12:10:39'),
(886, 'upload/products/1648037486_REDTHAI CURRY WITH STEAM RICE 3.jpg', '2022-03-23 12:11:26', '2022-03-23 12:11:26'),
(887, 'upload/products/1648037540_HANDCUT FRIES TRUFFLE 4.jpg', '2022-03-23 12:12:20', '2022-03-23 12:12:20'),
(888, 'upload/products/1648037586_REDTHAI CURRY WITH STEAM RICE 3.jpg', '2022-03-23 12:13:06', '2022-03-23 12:13:06'),
(889, 'upload/products/1648037675_HANDCUT FRIES TRUFFLE 4 (2).jpg', '2022-03-23 12:14:35', '2022-03-23 12:14:35'),
(890, 'upload/products/1648037675_HANDCUT FRIES TRUFFLE 1.jpg', '2022-03-23 12:14:35', '2022-03-23 12:14:35'),
(891, 'upload/products/1648037709_HANDCUT FRIES TRUFFLE 2.jpg', '2022-03-23 12:15:09', '2022-03-23 12:15:09'),
(892, 'upload/products/1648037755_HANDCUT FRIES TRUFFLE 1.jpg', '2022-03-23 12:15:55', '2022-03-23 12:15:55'),
(893, 'upload/products/1648037791_BEETROOT HALWA CANOLI WITH RABRI FOAM 1.jpg', '2022-03-23 12:16:31', '2022-03-23 12:16:31'),
(894, 'upload/products/1648037927_HANDCUT FRIES TRUFFLE 3 (2).jpg', '2022-03-23 12:18:47', '2022-03-23 12:18:47'),
(895, 'upload/products/1648037940_HANDCUT FRIES TRUFFLE 4.jpg', '2022-03-23 12:19:00', '2022-03-23 12:19:00'),
(896, 'upload/products/1648038017_THAI CHILLI NOODLE 1.jpg', '2022-03-23 12:20:17', '2022-03-23 12:20:17'),
(897, 'upload/products/1648038085_SISILIAN WHOLE ORANGE CAKE WITH CARAMEL SAUCE AND ICE CREAM.jpg', '2022-03-23 12:21:25', '2022-03-23 12:21:25'),
(898, 'upload/products/1648038148_BEETROOT HALWA CANOLI WITH RABRI FOAM 1.jpg', '2022-03-23 12:22:28', '2022-03-23 12:22:28'),
(899, 'upload/products/1648038164_THAI CHILLI NOODLE 2.jpg', '2022-03-23 12:22:44', '2022-03-23 12:22:44'),
(900, 'upload/products/1648038180_THAI CHILLI NOODLE 3.jpg', '2022-03-23 12:23:00', '2022-03-23 12:23:00'),
(901, 'upload/products/1648038236_MIE GOREN 1 (1).jpg', '2022-03-23 12:23:56', '2022-03-23 12:23:56'),
(902, 'upload/products/1648038242_THAI CHILLI NOODLE 1.jpg', '2022-03-23 12:24:02', '2022-03-23 12:24:02'),
(903, 'upload/products/1648038253_MIE GOREN 1.jpg', '2022-03-23 12:24:13', '2022-03-23 12:24:13'),
(904, 'upload/products/1648038265_BULGOGI CHICKEN WINGS .jpg', '2022-03-23 12:24:25', '2022-03-23 12:24:25'),
(905, 'upload/products/1648038271_MIE GOREN 1.jpg', '2022-03-23 12:24:31', '2022-03-23 12:24:31'),
(906, 'upload/products/1648038274_THAI CHILLI NOODLE 2.jpg', '2022-03-23 12:24:34', '2022-03-23 12:24:34'),
(907, 'upload/products/1648038292_MIE GOREN 1.jpg', '2022-03-23 12:24:52', '2022-03-23 12:24:52'),
(908, 'upload/products/1648038302_THAI CHILLI NOODLE 3.jpg', '2022-03-23 12:25:02', '2022-03-23 12:25:02'),
(909, 'upload/products/1648038353_NASI GORENG 1.jpg', '2022-03-23 12:25:53', '2022-03-23 12:25:53'),
(910, 'upload/products/1648038359_MIE GOREN 1 (1).jpg', '2022-03-23 12:25:59', '2022-03-23 12:25:59'),
(911, 'upload/products/1648038405_NASI GORENG 2.jpg', '2022-03-23 12:26:45', '2022-03-23 12:26:45'),
(912, 'upload/products/1648038415_MIE GOREN 1.jpg', '2022-03-23 12:26:55', '2022-03-23 12:26:55'),
(913, 'upload/products/1648038435_MIE GOREN 1 (1).jpg', '2022-03-23 12:27:15', '2022-03-23 12:27:15'),
(914, 'upload/products/1648038460_MIE GOREN 1.jpg', '2022-03-23 12:27:40', '2022-03-23 12:27:40'),
(915, 'upload/products/1648038486_NASI GORENG 1.jpg', '2022-03-23 12:28:06', '2022-03-23 12:28:06'),
(916, 'upload/products/1648038507_NASI GORENG 2.jpg', '2022-03-23 12:28:27', '2022-03-23 12:28:27'),
(917, 'upload/products/1648038569_KILLER KADHAI PANEER PLATTER.jpg', '2022-03-23 12:29:29', '2022-03-23 12:29:29'),
(918, 'upload/products/1648038587_MUMBAIYA KEEMA PAO.jpg', '2022-03-23 12:29:47', '2022-03-23 12:29:47'),
(919, 'upload/products/1648038637_GRILLED CHICKEN WITH LEMON MUSTARD SAUCE .jpg', '2022-03-23 12:30:37', '2022-03-23 12:30:37'),
(920, 'upload/products/1648038659_KILLER KADHAI PANEER PLATTER.jpg', '2022-03-23 12:30:59', '2022-03-23 12:30:59'),
(921, 'upload/products/1648038698_POP STAR PENNE ALFREDO.jpg', '2022-03-23 12:31:38', '2022-03-23 12:31:38'),
(922, 'upload/products/1648038701_GRILLED CHICKEN WITH LEMON MUSTARD SAUCE .jpg', '2022-03-23 12:31:41', '2022-03-23 12:31:41'),
(923, 'upload/products/1648038715_POPPY PENNE ARABIATTA.jpg', '2022-03-23 12:31:55', '2022-03-23 12:31:55'),
(924, 'upload/products/1648038738_POP STAR PENNE ALFREDO.jpg', '2022-03-23 12:32:18', '2022-03-23 12:32:18'),
(925, 'upload/products/1648038743_POPPY PENNE ARABIATTA.jpg', '2022-03-23 12:32:23', '2022-03-23 12:32:23'),
(926, 'upload/products/1648038770_POPPY PENNE ARABIATTA.jpg', '2022-03-23 12:32:50', '2022-03-23 12:32:50'),
(927, 'upload/products/1648038851_CHICKEN IN SMOKED CHILLI SAUCE .jpg', '2022-03-23 12:34:11', '2022-03-23 12:34:11'),
(928, 'upload/products/1648038864_CHICKEN IN SMOKED CHILLI SAUCE .jpg', '2022-03-23 12:34:24', '2022-03-23 12:34:24'),
(929, 'upload/products/1648038967_CHICKEN IN SMOKED CHILLI SAUCE .jpg', '2022-03-23 12:36:07', '2022-03-23 12:36:07'),
(930, 'upload/products/1648039024_REDTHAI CURRY WITH STEAM RICE 3.jpg', '2022-03-23 12:37:04', '2022-03-23 12:37:04'),
(931, 'upload/products/1648039097_BALINESE CURRY BOWL 1.jpg', '2022-03-23 12:38:17', '2022-03-23 12:38:17'),
(932, 'upload/products/1648039115_BALINESE CURRY BOWL 2.jpg', '2022-03-23 12:38:35', '2022-03-23 12:38:35'),
(933, 'upload/products/1648039121_REDTHAI CURRY WITH STEAM RICE 1.jpg', '2022-03-23 12:38:41', '2022-03-23 12:38:41'),
(934, 'upload/products/1648039145_REDTHAI CURRY WITH STEAM RICE 2.jpg', '2022-03-23 12:39:05', '2022-03-23 12:39:05'),
(935, 'upload/products/1648039158_BALINESE CURRY BOWL 1.jpg', '2022-03-23 12:39:18', '2022-03-23 12:39:18'),
(936, 'upload/products/1648039174_BEETROOT HALWA CANOLI WITH RABRI FOAM 1.jpg', '2022-03-23 12:39:34', '2022-03-23 12:39:34'),
(937, 'upload/products/1648039175_BALINESE CURRY BOWL 3.jpg', '2022-03-23 12:39:35', '2022-03-23 12:39:35'),
(938, 'upload/products/1648039210_KILLER KADHAI PANEER PLATTER.jpg', '2022-03-23 12:40:10', '2022-03-23 12:40:10'),
(939, 'upload/products/1648039230_QUESADILLA 2.jpg', '2022-03-23 12:40:30', '2022-03-23 12:40:30');
INSERT INTO `upload_images` (`id`, `file`, `created_at`, `updated_at`) VALUES
(940, 'upload/products/1648039236_KILLER KADHAI PANEER PLATTER.jpg', '2022-03-23 12:40:36', '2022-03-23 12:40:36'),
(941, 'upload/products/1648039257_QUESADILLA.jpg', '2022-03-23 12:40:57', '2022-03-23 12:40:57'),
(942, 'upload/products/1648039298_BUTTER CHICKEN COINS.jpg', '2022-03-23 12:41:38', '2022-03-23 12:41:38'),
(943, 'upload/products/1648039321_GRILLED CHICKEN WITH LEMON MUSTARD SAUCE .jpg', '2022-03-23 12:42:01', '2022-03-23 12:42:01'),
(944, 'upload/products/1648039356_LAMB STEW WITH LINGUINI .jpg', '2022-03-23 12:42:36', '2022-03-23 12:42:36'),
(945, 'upload/products/1648039357_QUESADILLA.jpg', '2022-03-23 12:42:37', '2022-03-23 12:42:37'),
(946, 'upload/products/1648039376_QUESADILLA 2.jpg', '2022-03-23 12:42:56', '2022-03-23 12:42:56'),
(947, 'upload/products/1648039377_POP STAR PENNE ALFREDO.jpg', '2022-03-23 12:42:57', '2022-03-23 12:42:57'),
(948, 'upload/products/1648039394_Smoked Chicken Pizza.jpg', '2022-03-23 12:43:14', '2022-03-23 12:43:14'),
(949, 'upload/products/1648039415_POPPY PENNE ARABIATTA.jpg', '2022-03-23 12:43:35', '2022-03-23 12:43:35'),
(950, 'upload/products/1648039460_Smoked Chicken Pizza.jpg', '2022-03-23 12:44:20', '2022-03-23 12:44:20'),
(951, 'upload/products/1648039466_Farm Delight Pizza.jpg', '2022-03-23 12:44:26', '2022-03-23 12:44:26'),
(952, 'upload/products/1648039472_THAI CHILLI NOODLE 1.jpg', '2022-03-23 12:44:32', '2022-03-23 12:44:32'),
(953, 'upload/products/1648039496_THAI CHILLI NOODLE 2.jpg', '2022-03-23 12:44:56', '2022-03-23 12:44:56'),
(954, 'upload/products/1648039554_Farm Delight Pizza.jpg', '2022-03-23 12:45:54', '2022-03-23 12:45:54'),
(955, 'upload/products/1648039562_Hipster Salad.jpg', '2022-03-23 12:46:02', '2022-03-23 12:46:02'),
(956, 'upload/products/1648039588_SINGAPOREAN BURNT GARLIC FRIED RICE 1.jpg', '2022-03-23 12:46:28', '2022-03-23 12:46:28'),
(957, 'upload/products/1648039601_SINGAPOREAN BURNT GARLIC FRIED RICE 2.jpg', '2022-03-23 12:46:41', '2022-03-23 12:46:41'),
(958, 'upload/products/1648039622_Hipster Salad.jpg', '2022-03-23 12:47:02', '2022-03-23 12:47:02'),
(959, 'upload/products/1648039706_MIE GOREN 1 (1).jpg', '2022-03-23 12:48:26', '2022-03-23 12:48:26'),
(960, 'upload/products/1648039735_NASI GORENG 1.jpg', '2022-03-23 12:48:55', '2022-03-23 12:48:55'),
(961, 'upload/products/1648039751_MIE GOREN 1 (1).jpg', '2022-03-23 12:49:11', '2022-03-23 12:49:11'),
(962, 'upload/products/1648039788_SINGAPOREAN BURNT GARLIC FRIED RICE 1.jpg', '2022-03-23 12:49:48', '2022-03-23 12:49:48'),
(963, 'upload/products/1648039805_NASI GORENG 2.jpg', '2022-03-23 12:50:05', '2022-03-23 12:50:05'),
(964, 'upload/products/1648039830_NASI GORENG 2.jpg', '2022-03-23 12:50:30', '2022-03-23 12:50:30'),
(965, 'upload/products/1648039846_NASI GORENG 3.jpg', '2022-03-23 12:50:46', '2022-03-23 12:50:46'),
(966, 'upload/products/1648039854_Nachos.jpg', '2022-03-23 12:50:54', '2022-03-23 12:50:54'),
(967, 'upload/products/1648039861_NASI GORENG 2.jpg', '2022-03-23 12:51:01', '2022-03-23 12:51:01'),
(968, 'upload/products/1648039881_Nachos.jpg', '2022-03-23 12:51:21', '2022-03-23 12:51:21'),
(969, 'upload/products/1648039909_KUNG PAO TOFU AND BROCCOLI.jpg', '2022-03-23 12:51:49', '2022-03-23 12:51:49'),
(970, 'upload/products/1648039926_NASI GORENG 1.jpg', '2022-03-23 12:52:06', '2022-03-23 12:52:06'),
(971, 'upload/products/1648039966_KUNG PAO TOFU AND BROCCOLI.jpg', '2022-03-23 12:52:46', '2022-03-23 12:52:46'),
(972, 'upload/products/1648040007_Finch special Indian Masala.jpg', '2022-03-23 12:53:27', '2022-03-23 12:53:27'),
(973, 'upload/products/1648040009_NASI GORENG 3.jpg', '2022-03-23 12:53:29', '2022-03-23 12:53:29'),
(974, 'upload/products/1648040030_NASI GORENG 1.jpg', '2022-03-23 12:53:50', '2022-03-23 12:53:50'),
(975, 'upload/products/1648040036_BULLS EYE.jpg', '2022-03-23 12:53:56', '2022-03-23 12:53:56'),
(976, 'upload/products/1648040067_Finch special Indian Masala.jpg', '2022-03-23 12:54:27', '2022-03-23 12:54:27'),
(977, 'upload/products/1648040092_NASI GORENG 1.jpg', '2022-03-23 12:54:52', '2022-03-23 12:54:52'),
(978, 'upload/products/1648040119_CHICKEN IN SMOKED CHILLI SAUCE .jpg', '2022-03-23 12:55:19', '2022-03-23 12:55:19'),
(979, 'upload/products/1648040141_Bacon Mushroom.jpg', '2022-03-23 12:55:41', '2022-03-23 12:55:41'),
(980, 'upload/products/1648040156_BULLS EYE.jpg', '2022-03-23 12:55:56', '2022-03-23 12:55:56'),
(981, 'upload/products/1648040159_REDTHAI CURRY WITH STEAM RICE 2.jpg', '2022-03-23 12:55:59', '2022-03-23 12:55:59'),
(982, 'upload/products/1648040171_REDTHAI CURRY WITH STEAM RICE 2.jpg', '2022-03-23 12:56:11', '2022-03-23 12:56:11'),
(983, 'upload/products/1648040191_REDTHAI CURRY WITH STEAM RICE 1.jpg', '2022-03-23 12:56:31', '2022-03-23 12:56:31'),
(984, 'upload/products/1648040204_Bacon Mushroom.jpg', '2022-03-23 12:56:44', '2022-03-23 12:56:44'),
(985, 'upload/products/1648040221_MALASIAN  CURRY BOWL 1.jpg', '2022-03-23 12:57:01', '2022-03-23 12:57:01'),
(986, 'upload/products/1648040224_Pollo Olivatti.jpg', '2022-03-23 12:57:04', '2022-03-23 12:57:04'),
(987, 'upload/products/1648040232_MALASIAN  CURRY BOWL 2.jpg', '2022-03-23 12:57:12', '2022-03-23 12:57:12'),
(988, 'upload/products/1648040242_Pollo Olivatti.jpg', '2022-03-23 12:57:22', '2022-03-23 12:57:22'),
(989, 'upload/products/1648040281_Tapas Box.jpg', '2022-03-23 12:58:01', '2022-03-23 12:58:01'),
(990, 'upload/products/1648040285_Tapas Box.jpg', '2022-03-23 12:58:05', '2022-03-23 12:58:05'),
(991, 'upload/products/1648040340_PITA HUMMUS TO WAY.jpg', '2022-03-23 12:59:00', '2022-03-23 12:59:00'),
(992, 'upload/products/1648040342_PITA HUMMUS TO WAY.jpg', '2022-03-23 12:59:02', '2022-03-23 12:59:02'),
(993, 'upload/products/1648040410_PITA HUMMUS TO WAY.jpg', '2022-03-23 13:00:10', '2022-03-23 13:00:10'),
(994, 'upload/products/1648040434_Tapas Box.jpg', '2022-03-23 13:00:34', '2022-03-23 13:00:34'),
(995, 'upload/products/1648040451_BURRATA  PESTO CROSTINI.jpg', '2022-03-23 13:00:51', '2022-03-23 13:00:51'),
(996, 'upload/products/1648040472_Tapas Box.jpg', '2022-03-23 13:01:12', '2022-03-23 13:01:12'),
(997, 'upload/products/1648040525_PANKO CRUSTED TEMPURA SHRIMPS.jpg', '2022-03-23 13:02:05', '2022-03-23 13:02:05'),
(998, 'upload/products/1648040540_Pollo Olivatti.jpg', '2022-03-23 13:02:20', '2022-03-23 13:02:20'),
(999, 'upload/products/1648040554_STYLISH SALTIMBOCCA.jpg', '2022-03-23 13:02:34', '2022-03-23 13:02:34'),
(1000, 'upload/products/1648040641_Bacon Mushroom.jpg', '2022-03-23 13:04:01', '2022-03-23 13:04:01'),
(1001, 'upload/products/1648040660_BULLS EYE.jpg', '2022-03-23 13:04:20', '2022-03-23 13:04:20'),
(1002, 'upload/products/1648040675_Finch special Indian Masala.jpg', '2022-03-23 13:04:35', '2022-03-23 13:04:35'),
(1003, 'upload/products/1648040696_KUNG PAO TOFU AND BROCCOLI.jpg', '2022-03-23 13:04:56', '2022-03-23 13:04:56'),
(1004, 'upload/products/1648040721_Nachos.jpg', '2022-03-23 13:05:21', '2022-03-23 13:05:21'),
(1005, 'upload/products/1648040780_SINGAPORE WOK TOSSED CHICKEN.jpg', '2022-03-23 13:06:20', '2022-03-23 13:06:20'),
(1006, 'upload/products/1648040786_Hipster Salad.jpg', '2022-03-23 13:06:26', '2022-03-23 13:06:26'),
(1007, 'upload/products/1648040802_VIETNAMESE STYLE CHILLY CELERY COTTAGE CHEESE.jpg', '2022-03-23 13:06:42', '2022-03-23 13:06:42'),
(1008, 'upload/products/1648040804_SRILANKAN FIERY PRAWN .jpg', '2022-03-23 13:06:44', '2022-03-23 13:06:44'),
(1009, 'upload/products/1648040835_CHILLI TERIYAKI CHICKEN.jpg', '2022-03-23 13:07:15', '2022-03-23 13:07:15'),
(1010, 'upload/products/1648040861_BULGOGI CHICKEN WINGS .jpg', '2022-03-23 13:07:41', '2022-03-23 13:07:41'),
(1011, 'upload/products/1648040900_MALASIAN  CURRY BOWL 1.jpg', '2022-03-23 13:08:20', '2022-03-23 13:08:20'),
(1012, 'upload/products/1648040908_THE FARMER SALAD.jpg', '2022-03-23 13:08:28', '2022-03-23 13:08:28'),
(1013, 'upload/products/1648040912_Classic Margherita.jpg', '2022-03-23 13:08:32', '2022-03-23 13:08:32'),
(1014, 'upload/products/1648040942_QUESADILLA.jpg', '2022-03-23 13:09:02', '2022-03-23 13:09:02'),
(1015, 'upload/products/1648040971_MALASIAN  CURRY BOWL 2.jpg', '2022-03-23 13:09:31', '2022-03-23 13:09:31'),
(1016, 'upload/products/1648040973_POTATO, EGG AND BACON SALAD.jpg', '2022-03-23 13:09:33', '2022-03-23 13:09:33'),
(1017, 'upload/products/1648040988_SINGAPORE CURRY BOWL 2.jpg', '2022-03-23 13:09:48', '2022-03-23 13:09:48'),
(1018, 'upload/products/1648040997_WILD MUSHROOM CROQUE MONSIEUR.jpg', '2022-03-23 13:09:57', '2022-03-23 13:09:57'),
(1019, 'upload/products/1648041040_Smoked Chicken Pizza.jpg', '2022-03-23 13:10:40', '2022-03-23 13:10:40'),
(1020, 'upload/products/1648041047_SHARP CHEDDAR _ HAM CROQUE MONSIEUR.jpg', '2022-03-23 13:10:47', '2022-03-23 13:10:47'),
(1021, 'upload/products/1648041110_JALAPINOS _CHICKEN SLIDER.jpg', '2022-03-23 13:11:50', '2022-03-23 13:11:50'),
(1022, 'upload/products/1648041129_EXOTIC VEG AND CHEESE SLIDER.jpg', '2022-03-23 13:12:09', '2022-03-23 13:12:09'),
(1023, 'upload/products/1648041145_EXOTIC VEG AND CHEESE SLIDER.jpg', '2022-03-23 13:12:25', '2022-03-23 13:12:25'),
(1024, 'upload/products/1648041171_QUESADILLA 2.jpg', '2022-03-23 13:12:51', '2022-03-23 13:12:51'),
(1025, 'upload/products/1648041243_Farm Delight Pizza.jpg', '2022-03-23 13:14:03', '2022-03-23 13:14:03'),
(1026, 'upload/products/1648041548_scoch egg.jpg', '2022-03-23 13:19:08', '2022-03-23 13:19:08'),
(1027, 'upload/products/1648041767_scoch egg.jpg', '2022-03-23 13:22:47', '2022-03-23 13:22:47'),
(1028, 'upload/products/1648099599_THAI SPRING ROLL.jpg', '2022-03-24 05:26:39', '2022-03-24 05:26:39'),
(1029, 'upload/products/1648104821_SBEER150_KINGFISHER-GLASS-removebg-preview.png', '2022-03-24 06:53:41', '2022-03-24 06:53:41'),
(1030, 'upload/products/1648104828_SBEER150_KINGFISHER-GLASS-removebg-preview.png', '2022-03-24 06:53:48', '2022-03-24 06:53:48'),
(1031, 'upload/products/1648105024_Beer.jpg', '2022-03-24 06:57:04', '2022-03-24 06:57:04'),
(1032, 'upload/products/1648105028_Beer.jpg', '2022-03-24 06:57:08', '2022-03-24 06:57:08'),
(1033, 'upload/products/1648105980_Beer 2.png', '2022-03-24 07:13:00', '2022-03-24 07:13:00'),
(1034, 'upload/products/1648105983_Beer 2.png', '2022-03-24 07:13:03', '2022-03-24 07:13:03'),
(1035, 'upload/products/1648106474_Beer 2.png', '2022-03-24 07:21:14', '2022-03-24 07:21:14'),
(1036, 'upload/products/1648106482_Beer 2.png', '2022-03-24 07:21:22', '2022-03-24 07:21:22'),
(1037, 'upload/products/1648109096_img640-x-360.jpg', '2022-03-24 08:04:56', '2022-03-24 08:04:56'),
(1038, 'upload/products/1648109101_img640-x-360.jpg', '2022-03-24 08:05:01', '2022-03-24 08:05:01'),
(1039, 'upload/products/1648116297_Beer 2.png', '2022-03-24 10:04:57', '2022-03-24 10:04:57'),
(1040, 'upload/products/1648116301_Beer 2.png', '2022-03-24 10:05:01', '2022-03-24 10:05:01'),
(1041, 'upload/products/1648116367_SBEER150_KINGFISHER-GLASS-removebg-preview.png', '2022-03-24 10:06:07', '2022-03-24 10:06:07'),
(1042, 'upload/products/1648116371_SBEER150_KINGFISHER-GLASS-removebg-preview.png', '2022-03-24 10:06:11', '2022-03-24 10:06:11'),
(1043, 'upload/products/1648116448_Beer 2.png', '2022-03-24 10:07:28', '2022-03-24 10:07:28'),
(1044, 'upload/products/1648116451_Beer 2.png', '2022-03-24 10:07:31', '2022-03-24 10:07:31'),
(1045, 'upload/products/1648116695_Beer 2.png', '2022-03-24 10:11:35', '2022-03-24 10:11:35'),
(1046, 'upload/products/1648116726_Kingfisher_beer_logo.png', '2022-03-24 10:12:06', '2022-03-24 10:12:06'),
(1047, 'upload/products/1648116747_SBEER150_KINGFISHER-GLASS-removebg-preview.png', '2022-03-24 10:12:27', '2022-03-24 10:12:27'),
(1048, 'upload/products/1648116755_SBEER150 KINGFISHER-GLASS.jpg', '2022-03-24 10:12:35', '2022-03-24 10:12:35'),
(1049, 'upload/products/1648116763_SBEER150 KINGFISHER-GLASS.jpg', '2022-03-24 10:12:43', '2022-03-24 10:12:43'),
(1050, 'upload/products/1648116765_Kingfisher_beer_logo.png', '2022-03-24 10:12:45', '2022-03-24 10:12:45'),
(1051, 'upload/products/1648116933_Beer 2.png', '2022-03-24 10:15:33', '2022-03-24 10:15:33'),
(1052, 'upload/products/1648117306_Beer 2.png', '2022-03-24 10:21:46', '2022-03-24 10:21:46'),
(1053, 'upload/products/1648117309_Kingfisher_beer_logo.png', '2022-03-24 10:21:49', '2022-03-24 10:21:49'),
(1054, 'upload/products/1648118630_Lager.png', '2022-03-24 10:43:50', '2022-03-24 10:43:50'),
(1055, 'upload/products/1648118640_IPA.png', '2022-03-24 10:44:00', '2022-03-24 10:44:00'),
(1056, 'upload/products/1648118658_Cloud Black.png', '2022-03-24 10:44:18', '2022-03-24 10:44:18'),
(1057, 'upload/products/1648118681_Hefeweizen.png', '2022-03-24 10:44:41', '2022-03-24 10:44:41'),
(1058, 'upload/products/1648118767_Belgian Wit.png', '2022-03-24 10:46:07', '2022-03-24 10:46:07'),
(1059, 'upload/products/1648118794_Cloud Black.png', '2022-03-24 10:46:34', '2022-03-24 10:46:34'),
(1060, 'upload/products/1648119583_Apple Cider.png', '2022-03-24 10:59:43', '2022-03-24 10:59:43'),
(1061, 'upload/products/1648123044_Tandoori Roti.jpg', '2022-03-24 11:57:24', '2022-03-24 11:57:24'),
(1062, 'upload/products/1648123103_mirch paratha.jpg', '2022-03-24 11:58:23', '2022-03-24 11:58:23'),
(1063, 'upload/products/1648123121_naan.jpg', '2022-03-24 11:58:41', '2022-03-24 11:58:41'),
(1064, 'upload/products/1648123144_laccha paratha.jpg', '2022-03-24 11:59:04', '2022-03-24 11:59:04'),
(1065, 'upload/products/1648123168_Steam Rice.jpg', '2022-03-24 11:59:28', '2022-03-24 11:59:28'),
(1066, 'upload/products/1648123283_Liquid Chocolate Muffin.jpg', '2022-03-24 12:01:23', '2022-03-24 12:01:23'),
(1067, 'upload/products/1648123413_Hyderabadi Murg Dum Biryani.jpg', '2022-03-24 12:03:33', '2022-03-24 12:03:33'),
(1068, 'upload/products/1648123436_Hyderabadi Murg Dum Biryani.jpg', '2022-03-24 12:03:56', '2022-03-24 12:03:56'),
(1069, 'upload/products/1648123777_Hyderabadi   Biryani veg.jpg', '2022-03-24 12:09:37', '2022-03-24 12:09:37'),
(1070, 'upload/products/1648123836_Dal Makhani.jpg', '2022-03-24 12:10:36', '2022-03-24 12:10:36'),
(1071, 'upload/products/1648123881_Dal Makhani.jpg', '2022-03-24 12:11:21', '2022-03-24 12:11:21'),
(1072, 'upload/products/1648123919_TAWA MASALA CHICKEN.jpg', '2022-03-24 12:11:59', '2022-03-24 12:11:59'),
(1073, 'upload/products/1648123954_Butter Chicken.jpg', '2022-03-24 12:12:34', '2022-03-24 12:12:34'),
(1074, 'upload/products/1648123978_Egg Bhurji.jpg', '2022-03-24 12:12:58', '2022-03-24 12:12:58'),
(1075, 'upload/products/1648124013_Delhi 6.jpg', '2022-03-24 12:13:33', '2022-03-24 12:13:33'),
(1076, 'upload/products/1648124039_Paneer Chilli.jpg', '2022-03-24 12:13:59', '2022-03-24 12:13:59'),
(1077, 'upload/products/1648124107_Burger Non Veg.jpg', '2022-03-24 12:15:07', '2022-03-24 12:15:07'),
(1078, 'upload/products/1648124123_Burger Veg.jpg', '2022-03-24 12:15:23', '2022-03-24 12:15:23'),
(1079, 'upload/products/1648124144_Pulled Chicken In Mojo Rojo Panino.jpg', '2022-03-24 12:15:44', '2022-03-24 12:15:44'),
(1080, 'upload/products/1648124186_Chicken Tikka Pizza.jpg', '2022-03-24 12:16:26', '2022-03-24 12:16:26'),
(1081, 'upload/products/1648124207_Hot Veggie Pizza.jpg', '2022-03-24 12:16:47', '2022-03-24 12:16:47'),
(1082, 'upload/products/1648124223_Caesar Salad.jpg', '2022-03-24 12:17:03', '2022-03-24 12:17:03'),
(1083, 'upload/products/1648124860_Smoked C Pizza.jpg', '2022-03-24 12:27:40', '2022-03-24 12:27:40'),
(1084, 'upload/products/1648124959_Farm Delight Pizza.jpg', '2022-03-24 12:29:19', '2022-03-24 12:29:19'),
(1085, 'upload/products/1648124969_Farm Delight Pizza.jpg', '2022-03-24 12:29:29', '2022-03-24 12:29:29'),
(1086, 'upload/products/1648124992_Non veg platter.jpg', '2022-03-24 12:29:52', '2022-03-24 12:29:52'),
(1087, 'upload/products/1648125035_BEETROOT HALWA CANOLI WITH RABRI FOAM 1.jpg', '2022-03-24 12:30:35', '2022-03-24 12:30:35'),
(1088, 'upload/products/1648125041_Non veg platter.jpg', '2022-03-24 12:30:41', '2022-03-24 12:30:41'),
(1089, 'upload/products/1648125056_Non sharebale paltter.jpg', '2022-03-24 12:30:56', '2022-03-24 12:30:56'),
(1090, 'upload/products/1648125077_Tandoori full  Half.jpg', '2022-03-24 12:31:17', '2022-03-24 12:31:17'),
(1091, 'upload/products/1648125104_Tandoori full  Half.jpg', '2022-03-24 12:31:44', '2022-03-24 12:31:44'),
(1092, 'upload/products/1648125191_Chocolate Mud Slide.jpeg', '2022-03-24 12:33:11', '2022-03-24 12:33:11'),
(1093, 'upload/products/1648125225_korean chciken wings.jpg', '2022-03-24 12:33:45', '2022-03-24 12:33:45'),
(1094, 'upload/products/1648125240_Amritsari fish tikka.jpg', '2022-03-24 12:34:00', '2022-03-24 12:34:00'),
(1095, 'upload/products/1648125256_Seekh o seelkh.jpg', '2022-03-24 12:34:16', '2022-03-24 12:34:16'),
(1096, 'upload/products/1648125277_Murg angara tikka.jpg', '2022-03-24 12:34:37', '2022-03-24 12:34:37'),
(1097, 'upload/products/1648125296_Spicky Rock Chicken Fingers.jpg', '2022-03-24 12:34:56', '2022-03-24 12:34:56'),
(1098, 'upload/products/1648125312_WOK TOSSED CHICKEN AND CHILLI.jpg', '2022-03-24 12:35:12', '2022-03-24 12:35:12'),
(1099, 'upload/products/1648125328_Smoke mushroom guloti.jpg', '2022-03-24 12:35:28', '2022-03-24 12:35:28'),
(1100, 'upload/products/1648125345_Jungli Paneer Tikka .jpg', '2022-03-24 12:35:45', '2022-03-24 12:35:45'),
(1101, 'upload/products/1648125377_GINGER PANEER CHILLI AND PEPPERS.jpg', '2022-03-24 12:36:17', '2022-03-24 12:36:17'),
(1102, 'upload/products/1648125397_Chilli Cheese Cigar Roll.jpg', '2022-03-24 12:36:37', '2022-03-24 12:36:37'),
(1103, 'upload/products/1648125431_Chicken Popcorn.jpg', '2022-03-24 12:37:11', '2022-03-24 12:37:11'),
(1104, 'upload/products/1648125515_Chicken Shami Kebab.jpg', '2022-03-24 12:38:35', '2022-03-24 12:38:35'),
(1105, 'upload/products/1648125544_Dahi ke kebab.jpg', '2022-03-24 12:39:04', '2022-03-24 12:39:04'),
(1106, 'upload/products/1648125563_Tandoori Roti.jpg', '2022-03-24 12:39:23', '2022-03-24 12:39:23'),
(1107, 'upload/products/1648125579_mirch paratha.jpg', '2022-03-24 12:39:39', '2022-03-24 12:39:39'),
(1108, 'upload/products/1648125661_naan.jpg', '2022-03-24 12:41:01', '2022-03-24 12:41:01'),
(1109, 'upload/products/1648125674_laccha paratha.jpg', '2022-03-24 12:41:14', '2022-03-24 12:41:14'),
(1110, 'upload/products/1648125690_Steam Rice.jpg', '2022-03-24 12:41:30', '2022-03-24 12:41:30'),
(1111, 'upload/products/1648125721_Chocolate Mud Slide.jpeg', '2022-03-24 12:42:01', '2022-03-24 12:42:01'),
(1112, 'upload/products/1648125752_Hyderabadi Murg Dum Biryani.jpg', '2022-03-24 12:42:32', '2022-03-24 12:42:32'),
(1113, 'upload/products/1648125775_Hyderabadi   Biryani veg.jpg', '2022-03-24 12:42:55', '2022-03-24 12:42:55'),
(1114, 'upload/products/1648125797_Dal Makhani.jpg', '2022-03-24 12:43:17', '2022-03-24 12:43:17'),
(1115, 'upload/products/1648125817_TAWA MASALA CHICKEN.jpg', '2022-03-24 12:43:37', '2022-03-24 12:43:37'),
(1116, 'upload/products/1648125834_Butter Chicken.jpg', '2022-03-24 12:43:54', '2022-03-24 12:43:54'),
(1117, 'upload/products/1648125847_Egg Bhurji.jpg', '2022-03-24 12:44:07', '2022-03-24 12:44:07'),
(1118, 'upload/products/1648125865_Delhi 6.jpg', '2022-03-24 12:44:25', '2022-03-24 12:44:25'),
(1119, 'upload/products/1648125907_Burger Non Veg.jpg', '2022-03-24 12:45:07', '2022-03-24 12:45:07'),
(1120, 'upload/products/1648125934_Burger Veg.jpg', '2022-03-24 12:45:34', '2022-03-24 12:45:34'),
(1121, 'upload/products/1648125950_Delhi 6.jpg', '2022-03-24 12:45:50', '2022-03-24 12:45:50'),
(1122, 'upload/products/1648125965_Pulled Chicken In Mojo Rojo Panino.jpg', '2022-03-24 12:46:05', '2022-03-24 12:46:05'),
(1123, 'upload/products/1648126019_Chicken Tikka Pizza.jpg', '2022-03-24 12:46:59', '2022-03-24 12:46:59'),
(1124, 'upload/products/1648126048_THAI CHILLI NOODLE 1.jpg', '2022-03-24 12:47:28', '2022-03-24 12:47:28'),
(1125, 'upload/products/1648126070_Hot Veggie Pizza.jpg', '2022-03-24 12:47:50', '2022-03-24 12:47:50'),
(1126, 'upload/products/1648126092_Smoked C Pizza.jpg', '2022-03-24 12:48:12', '2022-03-24 12:48:12'),
(1127, 'upload/products/1648126123_Farm Delight Pizza.jpg', '2022-03-24 12:48:43', '2022-03-24 12:48:43'),
(1128, 'upload/products/1648126156_Caesar Salad.jpg', '2022-03-24 12:49:16', '2022-03-24 12:49:16'),
(1129, 'upload/products/1648126181_SINGAPOREAN BURNT GARLIC FRIED RICE 1.jpg', '2022-03-24 12:49:41', '2022-03-24 12:49:41'),
(1130, 'upload/products/1648126204_Non veg platter.jpg', '2022-03-24 12:50:04', '2022-03-24 12:50:04'),
(1131, 'upload/products/1648126265_Non sharebale paltter.jpg', '2022-03-24 12:51:05', '2022-03-24 12:51:05'),
(1132, 'upload/products/1648126282_Tandoori full  Half.jpg', '2022-03-24 12:51:22', '2022-03-24 12:51:22'),
(1133, 'upload/products/1648126343_Tandoori full  Half.jpg', '2022-03-24 12:52:23', '2022-03-24 12:52:23'),
(1134, 'upload/products/1648126359_korean chciken wings.jpg', '2022-03-24 12:52:39', '2022-03-24 12:52:39'),
(1135, 'upload/products/1648126378_Amritsari fish tikka.jpg', '2022-03-24 12:52:58', '2022-03-24 12:52:58'),
(1136, 'upload/products/1648126394_Seekh o seelkh.jpg', '2022-03-24 12:53:14', '2022-03-24 12:53:14'),
(1137, 'upload/products/1648126410_MALASIAN  CURRY BOWL 1.jpg', '2022-03-24 12:53:30', '2022-03-24 12:53:30'),
(1138, 'upload/products/1648126426_Murg angara tikka.jpg', '2022-03-24 12:53:46', '2022-03-24 12:53:46'),
(1139, 'upload/products/1648126441_BALINESE CURRY BOWL 1.jpg', '2022-03-24 12:54:01', '2022-03-24 12:54:01'),
(1140, 'upload/products/1648126456_Spicky Rock Chicken Fingers.jpg', '2022-03-24 12:54:16', '2022-03-24 12:54:16'),
(1141, 'upload/products/1648126469_BALINESE CURRY BOWL 2.jpg', '2022-03-24 12:54:29', '2022-03-24 12:54:29'),
(1142, 'upload/products/1648126491_BALINESE CURRY BOWL 1.jpg', '2022-03-24 12:54:51', '2022-03-24 12:54:51'),
(1143, 'upload/products/1648126503_BALINESE CURRY BOWL 3.jpg', '2022-03-24 12:55:03', '2022-03-24 12:55:03'),
(1144, 'upload/products/1648126517_WOK TOSSED CHICKEN AND CHILLI.jpg', '2022-03-24 12:55:17', '2022-03-24 12:55:17'),
(1145, 'upload/products/1648126537_SINGAPORE CURRY BOWL 1.jpg', '2022-03-24 12:55:37', '2022-03-24 12:55:37'),
(1146, 'upload/products/1648126556_Smoke mushroom guloti.jpg', '2022-03-24 12:55:56', '2022-03-24 12:55:56'),
(1147, 'upload/products/1648126601_Smoked C Pizza.jpg', '2022-03-24 12:56:41', '2022-03-24 12:56:41'),
(1148, 'upload/products/1648126614_Farm Delight Pizza.jpg', '2022-03-24 12:56:54', '2022-03-24 12:56:54'),
(1149, 'upload/products/1648126643_SAILORS FAVOURITE FISH OYESTER CHILLI.jpg', '2022-03-24 12:57:23', '2022-03-24 12:57:23'),
(1150, 'upload/products/1648126668_Jungli Paneer Tikka .jpg', '2022-03-24 12:57:48', '2022-03-24 12:57:48'),
(1151, 'upload/products/1648126683_GINGER PANEER CHILLI AND PEPPERS.jpg', '2022-03-24 12:58:03', '2022-03-24 12:58:03'),
(1152, 'upload/products/1648126700_STYLISH SALTIMBOCCA.jpg', '2022-03-24 12:58:20', '2022-03-24 12:58:20'),
(1153, 'upload/products/1648126719_Chilli Cheese Cigar Roll.jpg', '2022-03-24 12:58:39', '2022-03-24 12:58:39'),
(1154, 'upload/products/1648126742_Chicken Popcorn.jpg', '2022-03-24 12:59:02', '2022-03-24 12:59:02'),
(1155, 'upload/products/1648126760_Chicken Shami Kebab.jpg', '2022-03-24 12:59:20', '2022-03-24 12:59:20'),
(1156, 'upload/products/1648126788_Dahi ke kebab.jpg', '2022-03-24 12:59:48', '2022-03-24 12:59:48'),
(1157, 'upload/products/1648210934_kingfisher lager.png', '2022-03-25 12:22:14', '2022-03-25 12:22:14'),
(1158, 'upload/products/1648211211_Blenders pride.png', '2022-03-25 12:26:51', '2022-03-25 12:26:51'),
(1159, 'upload/products/1648211373_kingfisher premium.png', '2022-03-25 12:29:33', '2022-03-25 12:29:33'),
(1160, 'upload/products/1648211418_kingfisher lager.png', '2022-03-25 12:30:18', '2022-03-25 12:30:18'),
(1161, 'upload/products/1648211494_blenders-pride logo.png', '2022-03-25 12:31:34', '2022-03-25 12:31:34'),
(1162, 'upload/products/1648211759_Blenders pride.png', '2022-03-25 12:35:59', '2022-03-25 12:35:59'),
(1163, 'upload/products/1648211764_blenders-pride logo.png', '2022-03-25 12:36:04', '2022-03-25 12:36:04'),
(1164, 'upload/products/1648211817_kingfisher strong.png', '2022-03-25 12:36:57', '2022-03-25 12:36:57'),
(1165, 'upload/products/1648211916_kingfisher logo.png', '2022-03-25 12:38:36', '2022-03-25 12:38:36'),
(1166, 'upload/products/1648211959_kingfisher logo.png', '2022-03-25 12:39:19', '2022-03-25 12:39:19'),
(1167, 'upload/products/1648212020_kingfisher logo.png', '2022-03-25 12:40:20', '2022-03-25 12:40:20'),
(1168, 'upload/products/1648212035_Black & white whisky.png', '2022-03-25 12:40:35', '2022-03-25 12:40:35'),
(1169, 'upload/products/1648212048_black white logo.png', '2022-03-25 12:40:48', '2022-03-25 12:40:48'),
(1170, 'upload/products/1648212076_kingfisher logo.png', '2022-03-25 12:41:16', '2022-03-25 12:41:16'),
(1171, 'upload/products/1648212111_kingfisher logo.png', '2022-03-25 12:41:51', '2022-03-25 12:41:51'),
(1172, 'upload/products/1648212151_kingfisher ultra.png', '2022-03-25 12:42:31', '2022-03-25 12:42:31'),
(1173, 'upload/products/1648212161_kingfisher logo.png', '2022-03-25 12:42:41', '2022-03-25 12:42:41'),
(1174, 'upload/products/1648212226_100 pipers.png', '2022-03-25 12:43:46', '2022-03-25 12:43:46'),
(1175, 'upload/products/1648212238_100 pipers logo.png', '2022-03-25 12:43:58', '2022-03-25 12:43:58'),
(1176, 'upload/products/1648212699_kingfisher strong.png', '2022-03-25 12:51:39', '2022-03-25 12:51:39'),
(1177, 'upload/products/1648212708_kingfisher logo.png', '2022-03-25 12:51:48', '2022-03-25 12:51:48'),
(1178, 'upload/products/1648212783_Jw red label.png', '2022-03-25 12:53:03', '2022-03-25 12:53:03'),
(1179, 'upload/products/1648212792_Jw red label logo.png', '2022-03-25 12:53:12', '2022-03-25 12:53:12'),
(1180, 'upload/products/1648212880_Jim beam.png', '2022-03-25 12:54:40', '2022-03-25 12:54:40'),
(1181, 'upload/products/1648212893_Jim Beam Logo.png', '2022-03-25 12:54:53', '2022-03-25 12:54:53'),
(1182, 'upload/products/1648212979_Ballantines.png', '2022-03-25 12:56:19', '2022-03-25 12:56:19'),
(1183, 'upload/products/1648212989_Ballantines logo.png', '2022-03-25 12:56:29', '2022-03-25 12:56:29'),
(1184, 'upload/products/1648213086_kingfisher premium.png', '2022-03-25 12:58:06', '2022-03-25 12:58:06'),
(1185, 'upload/products/1648213098_kingfisher logo.png', '2022-03-25 12:58:18', '2022-03-25 12:58:18'),
(1186, 'upload/products/1648213112_Black dog centenary.jpg.png', '2022-03-25 12:58:32', '2022-03-25 12:58:32'),
(1187, 'upload/products/1648213242_Black dog centenary logo.png', '2022-03-25 13:00:42', '2022-03-25 13:00:42'),
(1188, 'upload/products/1648213281_Budweiser.png', '2022-03-25 13:01:21', '2022-03-25 13:01:21'),
(1189, 'upload/products/1648213297_budweiser-logo.png', '2022-03-25 13:01:37', '2022-03-25 13:01:37'),
(1190, 'upload/products/1648213393_Teachers highland cream.png', '2022-03-25 13:03:13', '2022-03-25 13:03:13'),
(1191, 'upload/products/1648213431_Teachers Highland Cream_ Logo.png', '2022-03-25 13:03:51', '2022-03-25 13:03:51'),
(1192, 'upload/products/1648213485_Heineken.png', '2022-03-25 13:04:45', '2022-03-25 13:04:45'),
(1193, 'upload/products/1648213493_Heineken.png', '2022-03-25 13:04:53', '2022-03-25 13:04:53'),
(1194, 'upload/products/1648213506_Heineken Logo.png', '2022-03-25 13:05:06', '2022-03-25 13:05:06'),
(1195, 'upload/products/1648213523_teachers 50.png', '2022-03-25 13:05:23', '2022-03-25 13:05:23'),
(1196, 'upload/products/1648213528_teachers 50 logo.png', '2022-03-25 13:05:28', '2022-03-25 13:05:28'),
(1197, 'upload/products/1648213664_jameson.png', '2022-03-25 13:07:44', '2022-03-25 13:07:44'),
(1198, 'upload/products/1648213675_jameson logo.png', '2022-03-25 13:07:55', '2022-03-25 13:07:55'),
(1199, 'upload/products/1648213796_Blue moon.png', '2022-03-25 13:09:56', '2022-03-25 13:09:56'),
(1200, 'upload/products/1648213813_Blue moon logo.png', '2022-03-25 13:10:13', '2022-03-25 13:10:13'),
(1201, 'upload/products/1648213823_jw black label.png', '2022-03-25 13:10:23', '2022-03-25 13:10:23'),
(1202, 'upload/products/1648213838_Jw black label logo.png', '2022-03-25 13:10:38', '2022-03-25 13:10:38'),
(1203, 'upload/products/1648213954_chivas 12 years.png', '2022-03-25 13:12:34', '2022-03-25 13:12:34'),
(1204, 'upload/products/1648213971_chivas 12 years logo.png', '2022-03-25 13:12:51', '2022-03-25 13:12:51'),
(1205, 'upload/products/1648214001_Bro code.png', '2022-03-25 13:13:21', '2022-03-25 13:13:21'),
(1206, 'upload/products/1648214012_Brocode logo.png', '2022-03-25 13:13:32', '2022-03-25 13:13:32'),
(1207, 'upload/products/1648214099_Corona.png', '2022-03-25 13:14:59', '2022-03-25 13:14:59'),
(1208, 'upload/products/1648214099_jack daniels.png', '2022-03-25 13:14:59', '2022-03-25 13:14:59'),
(1209, 'upload/products/1648214111_jack daniels logo.png', '2022-03-25 13:15:11', '2022-03-25 13:15:11'),
(1210, 'upload/products/1648214124_Corona logo.png', '2022-03-25 13:15:24', '2022-03-25 13:15:24'),
(1211, 'upload/products/1648214258_glenlivet 12.png', '2022-03-25 13:17:38', '2022-03-25 13:17:38'),
(1212, 'upload/products/1648214268_glenlivet 12 logo.png', '2022-03-25 13:17:48', '2022-03-25 13:17:48'),
(1213, 'upload/products/1648214375_Hoegaarden.png', '2022-03-25 13:19:35', '2022-03-25 13:19:35'),
(1214, 'upload/products/1648214398_Hoegaarden logo.png', '2022-03-25 13:19:58', '2022-03-25 13:19:58'),
(1215, 'upload/products/1648214446_Old Monk.png', '2022-03-25 13:20:46', '2022-03-25 13:20:46'),
(1216, 'upload/products/1648214453_Old Monk logo.png', '2022-03-25 13:20:53', '2022-03-25 13:20:53'),
(1217, 'upload/products/1648214514_Bacardi black rum.png', '2022-03-25 13:21:54', '2022-03-25 13:21:54'),
(1218, 'upload/products/1648214542_Bacardi logo.png', '2022-03-25 13:22:22', '2022-03-25 13:22:22'),
(1219, 'upload/products/1648214636_Bacardi white rum.png', '2022-03-25 13:23:56', '2022-03-25 13:23:56'),
(1220, 'upload/products/1648214643_Bacardi logo.png', '2022-03-25 13:24:03', '2022-03-25 13:24:03'),
(1221, 'upload/products/1648214762_Smirnoff vodka.png', '2022-03-25 13:26:02', '2022-03-25 13:26:02'),
(1222, 'upload/products/1648214772_Smirnoff vodka logo.png', '2022-03-25 13:26:12', '2022-03-25 13:26:12'),
(1223, 'upload/products/1648214834_beefeater gin.png', '2022-03-25 13:27:14', '2022-03-25 13:27:14'),
(1224, 'upload/products/1648214843_beefeater london dry gin logo.png', '2022-03-25 13:27:23', '2022-03-25 13:27:23'),
(1225, 'upload/products/1648214947_bombay sapphire.png', '2022-03-25 13:29:07', '2022-03-25 13:29:07'),
(1226, 'upload/products/1648214954_Bombay Sapphire logo.png', '2022-03-25 13:29:14', '2022-03-25 13:29:14'),
(1227, 'upload/products/1648214974_Absolut.png', '2022-03-25 13:29:34', '2022-03-25 13:29:34'),
(1228, 'upload/products/1648214981_Absolut logo.png', '2022-03-25 13:29:41', '2022-03-25 13:29:41'),
(1229, 'upload/products/1648215150_camino silver.png', '2022-03-25 13:32:30', '2022-03-25 13:32:30'),
(1230, 'upload/products/1648215159_camino silver logo.png', '2022-03-25 13:32:39', '2022-03-25 13:32:39'),
(1231, 'upload/products/1648215280_jagermeister.png', '2022-03-25 13:34:40', '2022-03-25 13:34:40'),
(1232, 'upload/products/1648215309_Grey goose.png', '2022-03-25 13:35:09', '2022-03-25 13:35:09'),
(1233, 'upload/products/1648215320_Grey Goose Logo.png', '2022-03-25 13:35:20', '2022-03-25 13:35:20'),
(1234, 'upload/products/1648215390_jagermeister logo.png', '2022-03-25 13:36:30', '2022-03-25 13:36:30'),
(1235, 'upload/products/1648444250_Kingfisher Lager mug.png', '2022-03-28 05:10:50', '2022-03-28 05:10:50'),
(1236, 'upload/products/1648444261_kingfisher logo.png', '2022-03-28 05:11:01', '2022-03-28 05:11:01'),
(1237, 'upload/products/1648444429_kingfisher strong mug.png', '2022-03-28 05:13:49', '2022-03-28 05:13:49'),
(1238, 'upload/products/1648444436_kingfisher logo.png', '2022-03-28 05:13:56', '2022-03-28 05:13:56'),
(1239, 'upload/products/1648444588_Belgian Wit Beer.png', '2022-03-28 05:16:28', '2022-03-28 05:16:28'),
(1240, 'upload/products/1648444618_Belgian Wit.png', '2022-03-28 05:16:58', '2022-03-28 05:16:58'),
(1241, 'upload/products/1648445092_Cloud Black.png', '2022-03-28 05:24:52', '2022-03-28 05:24:52'),
(1242, 'upload/products/1648445106_Cloud Black.png', '2022-03-28 05:25:06', '2022-03-28 05:25:06'),
(1243, 'upload/products/1648445298_Kolsch Lager.png', '2022-03-28 05:28:18', '2022-03-28 05:28:18'),
(1244, 'upload/products/1648445337_Lager.png', '2022-03-28 05:28:57', '2022-03-28 05:28:57'),
(1245, 'upload/products/1648445489_kingfisher premium.png', '2022-03-28 05:31:29', '2022-03-28 05:31:29'),
(1246, 'upload/products/1648445518_kingfisher logo.png', '2022-03-28 05:31:58', '2022-03-28 05:31:58'),
(1247, 'upload/products/1648445718_kingfisher strong.png', '2022-03-28 05:35:18', '2022-03-28 05:35:18'),
(1248, 'upload/products/1648445726_Kingfisher Lager mug.png', '2022-03-28 05:35:26', '2022-03-28 05:35:26'),
(1249, 'upload/products/1648445736_kingfisher logo.png', '2022-03-28 05:35:36', '2022-03-28 05:35:36'),
(1250, 'upload/products/1648445825_Blenders pride.png', '2022-03-28 05:37:05', '2022-03-28 05:37:05'),
(1251, 'upload/products/1648445826_kingfisher ultra.png', '2022-03-28 05:37:06', '2022-03-28 05:37:06'),
(1252, 'upload/products/1648445834_kingfisher logo.png', '2022-03-28 05:37:14', '2022-03-28 05:37:14'),
(1253, 'upload/products/1648445839_blenders-pride logo.png', '2022-03-28 05:37:19', '2022-03-28 05:37:19'),
(1254, 'upload/products/1648445945_Black & white whisky.png', '2022-03-28 05:39:05', '2022-03-28 05:39:05'),
(1255, 'upload/products/1648445965_black white logo.png', '2022-03-28 05:39:25', '2022-03-28 05:39:25'),
(1256, 'upload/products/1648446004_Budweiser.png', '2022-03-28 05:40:04', '2022-03-28 05:40:04'),
(1257, 'upload/products/1648446018_budweiser-logo.png', '2022-03-28 05:40:18', '2022-03-28 05:40:18'),
(1258, 'upload/products/1648446075_100 pipers.png', '2022-03-28 05:41:15', '2022-03-28 05:41:15'),
(1259, 'upload/products/1648446085_Heineken.png', '2022-03-28 05:41:25', '2022-03-28 05:41:25'),
(1260, 'upload/products/1648446086_100 pipers logo.png', '2022-03-28 05:41:26', '2022-03-28 05:41:26'),
(1261, 'upload/products/1648446093_Heineken Logo.png', '2022-03-28 05:41:33', '2022-03-28 05:41:33'),
(1262, 'upload/products/1648446182_Blue moon.png', '2022-03-28 05:43:02', '2022-03-28 05:43:02'),
(1263, 'upload/products/1648446192_Blue moon logo.png', '2022-03-28 05:43:12', '2022-03-28 05:43:12'),
(1264, 'upload/products/1648446412_Bro code.png', '2022-03-28 05:46:52', '2022-03-28 05:46:52'),
(1265, 'upload/products/1648446425_Bro code logo.png', '2022-03-28 05:47:05', '2022-03-28 05:47:05'),
(1266, 'upload/products/1648446433_Brocode logo.png', '2022-03-28 05:47:13', '2022-03-28 05:47:13'),
(1267, 'upload/products/1648446498_Corona.png', '2022-03-28 05:48:18', '2022-03-28 05:48:18'),
(1268, 'upload/products/1648446502_Jw red label.png', '2022-03-28 05:48:22', '2022-03-28 05:48:22'),
(1269, 'upload/products/1648446509_Corona logo.png', '2022-03-28 05:48:29', '2022-03-28 05:48:29'),
(1270, 'upload/products/1648446527_Jw red label logo.png', '2022-03-28 05:48:47', '2022-03-28 05:48:47'),
(1271, 'upload/products/1648446583_Hoegaarden.png', '2022-03-28 05:49:43', '2022-03-28 05:49:43'),
(1272, 'upload/products/1648446586_Jim beam.png', '2022-03-28 05:49:46', '2022-03-28 05:49:46'),
(1273, 'upload/products/1648446590_Hoegaarden logo.png', '2022-03-28 05:49:50', '2022-03-28 05:49:50'),
(1274, 'upload/products/1648446593_Jim Beam Logo.png', '2022-03-28 05:49:53', '2022-03-28 05:49:53'),
(1275, 'upload/products/1648446664_Ballantines.png', '2022-03-28 05:51:04', '2022-03-28 05:51:04'),
(1276, 'upload/products/1648446672_Ballantines logo.png', '2022-03-28 05:51:12', '2022-03-28 05:51:12'),
(1277, 'upload/products/1648446767_Old Monk.png', '2022-03-28 05:52:47', '2022-03-28 05:52:47'),
(1278, 'upload/products/1648446776_Old Monk logo.png', '2022-03-28 05:52:56', '2022-03-28 05:52:56'),
(1279, 'upload/products/1648446902_Black dog centenary.jpg.png', '2022-03-28 05:55:02', '2022-03-28 05:55:02'),
(1280, 'upload/products/1648446910_Black dog centenary logo.png', '2022-03-28 05:55:10', '2022-03-28 05:55:10'),
(1281, 'upload/products/1648447024_Teachers highland cream.png', '2022-03-28 05:57:04', '2022-03-28 05:57:04'),
(1282, 'upload/products/1648447040_Teachers Highland Cream_ Logo.png', '2022-03-28 05:57:20', '2022-03-28 05:57:20'),
(1283, 'upload/products/1648447131_teachers 50.png', '2022-03-28 05:58:51', '2022-03-28 05:58:51'),
(1284, 'upload/products/1648447137_teachers 50 logo.png', '2022-03-28 05:58:57', '2022-03-28 05:58:57'),
(1285, 'upload/products/1648447212_jameson.png', '2022-03-28 06:00:12', '2022-03-28 06:00:12'),
(1286, 'upload/products/1648447218_jameson logo.png', '2022-03-28 06:00:18', '2022-03-28 06:00:18'),
(1287, 'upload/products/1648447306_jw black label.png', '2022-03-28 06:01:46', '2022-03-28 06:01:46'),
(1288, 'upload/products/1648447313_Jw black label logo.png', '2022-03-28 06:01:53', '2022-03-28 06:01:53'),
(1289, 'upload/products/1648447333_Bacardi black rum.png', '2022-03-28 06:02:13', '2022-03-28 06:02:13'),
(1290, 'upload/products/1648447339_Bacardi logo.png', '2022-03-28 06:02:19', '2022-03-28 06:02:19'),
(1291, 'upload/products/1648447395_chivas 12 years.png', '2022-03-28 06:03:15', '2022-03-28 06:03:15'),
(1292, 'upload/products/1648447403_chivas 12 years logo.png', '2022-03-28 06:03:23', '2022-03-28 06:03:23'),
(1293, 'upload/products/1648447542_Bacardi white rum.png', '2022-03-28 06:05:42', '2022-03-28 06:05:42'),
(1294, 'upload/products/1648447547_Bacardi logo.png', '2022-03-28 06:05:47', '2022-03-28 06:05:47'),
(1295, 'upload/products/1648447631_jack daniels.png', '2022-03-28 06:07:11', '2022-03-28 06:07:11'),
(1296, 'upload/products/1648447638_jack daniels logo.png', '2022-03-28 06:07:18', '2022-03-28 06:07:18'),
(1297, 'upload/products/1648447917_glenlivet 12.png', '2022-03-28 06:11:57', '2022-03-28 06:11:57'),
(1298, 'upload/products/1648447935_glenlivet 12 logo.png', '2022-03-28 06:12:15', '2022-03-28 06:12:15'),
(1299, 'upload/products/1648448000_beefeater london dry gin logo.png', '2022-03-28 06:13:20', '2022-03-28 06:13:20'),
(1300, 'upload/products/1648448002_Smirnoff vodka.png', '2022-03-28 06:13:22', '2022-03-28 06:13:22'),
(1301, 'upload/products/1648448009_beefeater gin.png', '2022-03-28 06:13:29', '2022-03-28 06:13:29'),
(1302, 'upload/products/1648448009_Smirnoff vodka logo.png', '2022-03-28 06:13:29', '2022-03-28 06:13:29'),
(1303, 'upload/products/1648448016_beefeater london dry gin logo.png', '2022-03-28 06:13:36', '2022-03-28 06:13:36'),
(1304, 'upload/products/1648448080_bombay sapphire.png', '2022-03-28 06:14:40', '2022-03-28 06:14:40'),
(1305, 'upload/products/1648448085_Bombay Sapphire logo.png', '2022-03-28 06:14:45', '2022-03-28 06:14:45'),
(1306, 'upload/products/1648448172_camino silver.png', '2022-03-28 06:16:12', '2022-03-28 06:16:12'),
(1307, 'upload/products/1648448176_camino silver logo.png', '2022-03-28 06:16:16', '2022-03-28 06:16:16'),
(1308, 'upload/products/1648448260_Absolut.png', '2022-03-28 06:17:40', '2022-03-28 06:17:40'),
(1309, 'upload/products/1648448263_jagermeister.png', '2022-03-28 06:17:43', '2022-03-28 06:17:43'),
(1310, 'upload/products/1648448266_Absolut logo.png', '2022-03-28 06:17:46', '2022-03-28 06:17:46'),
(1311, 'upload/products/1648448268_jagermeister logo.png', '2022-03-28 06:17:48', '2022-03-28 06:17:48'),
(1312, 'upload/products/1648448384_Grey goose.png', '2022-03-28 06:19:44', '2022-03-28 06:19:44'),
(1313, 'upload/products/1648448392_Grey Goose Logo.png', '2022-03-28 06:19:52', '2022-03-28 06:19:52'),
(1314, 'upload/products/1648448396_breezer.png', '2022-03-28 06:19:56', '2022-03-28 06:19:56'),
(1315, 'upload/products/1648448407_Bacardi logo.png', '2022-03-28 06:20:07', '2022-03-28 06:20:07'),
(1316, 'upload/products/1648448834_cosmopolitan.png', '2022-03-28 06:27:14', '2022-03-28 06:27:14'),
(1317, 'upload/products/1648449008_Brew Cafe_White Logo_Powai.png', '2022-03-28 06:30:08', '2022-03-28 06:30:08'),
(1318, 'upload/products/1648449153_mojito cocktail.png', '2022-03-28 06:32:33', '2022-03-28 06:32:33'),
(1319, 'upload/products/1648449163_Brew Cafe_White Logo_Powai.png', '2022-03-28 06:32:43', '2022-03-28 06:32:43'),
(1320, 'upload/products/1648449229_classic margarita.png', '2022-03-28 06:33:49', '2022-03-28 06:33:49'),
(1321, 'upload/products/1648449235_Brew Cafe_White Logo_Powai.png', '2022-03-28 06:33:55', '2022-03-28 06:33:55'),
(1322, 'upload/products/1648449243_Bird Cage.jpg', '2022-03-28 06:34:03', '2022-03-28 06:34:03'),
(1323, 'upload/products/1648449255_Brew Cafe_White Logo_Powai.png', '2022-03-28 06:34:15', '2022-03-28 06:34:15'),
(1324, 'upload/products/1648449508_Brew Cafe_White Logo_Powai.png', '2022-03-28 06:38:28', '2022-03-28 06:38:28'),
(1325, 'upload/products/1648449524_flavoured iced tea.png', '2022-03-28 06:38:44', '2022-03-28 06:38:44'),
(1326, 'upload/products/1648449613_jager bomb.png', '2022-03-28 06:40:13', '2022-03-28 06:40:13'),
(1327, 'upload/products/1648449627_Brew Cafe_White Logo_Powai.png', '2022-03-28 06:40:27', '2022-03-28 06:40:27'),
(1328, 'upload/products/1648449984_jacobs creek.png', '2022-03-28 06:46:24', '2022-03-28 06:46:24'),
(1329, 'upload/products/1648449991_Jacobs Creek logo.png', '2022-03-28 06:46:31', '2022-03-28 06:46:31'),
(1330, 'upload/products/1648450105_grover zampa.jpg', '2022-03-28 06:48:25', '2022-03-28 06:48:25'),
(1331, 'upload/products/1648450111_grover zampa logo.png', '2022-03-28 06:48:31', '2022-03-28 06:48:31'),
(1332, 'upload/products/1648450339_jacobs creek.png', '2022-03-28 06:52:19', '2022-03-28 06:52:19'),
(1333, 'upload/products/1648450457_jacobs creek.png', '2022-03-28 06:54:17', '2022-03-28 06:54:17'),
(1334, 'upload/products/1648450464_Jacobs Creek logo.png', '2022-03-28 06:54:24', '2022-03-28 06:54:24'),
(1335, 'upload/products/1648450560_teachers 50 logo.png', '2022-03-28 06:56:00', '2022-03-28 06:56:00'),
(1336, 'upload/products/1648450580_The Cure.jpg', '2022-03-28 06:56:20', '2022-03-28 06:56:20'),
(1337, 'upload/products/1648450603_Brew Cafe_White Logo_Powai.png', '2022-03-28 06:56:43', '2022-03-28 06:56:43'),
(1338, 'upload/products/1648450752_fresh lemon soda.png', '2022-03-28 06:59:12', '2022-03-28 06:59:12'),
(1339, 'upload/products/1648450754_Brew Cafe_White Logo_Powai.png', '2022-03-28 06:59:14', '2022-03-28 06:59:14'),
(1340, 'upload/products/1648450760_Brew Cafe_White Logo_Powai.png', '2022-03-28 06:59:20', '2022-03-28 06:59:20'),
(1341, 'upload/products/1648450817_fresh lemon soda.png', '2022-03-28 07:00:17', '2022-03-28 07:00:17'),
(1342, 'upload/products/1648450826_Brew Cafe_White Logo_Powai.png', '2022-03-28 07:00:26', '2022-03-28 07:00:26'),
(1343, 'upload/products/1648450830_Brew Cafe_White Logo_Powai.png', '2022-03-28 07:00:30', '2022-03-28 07:00:30'),
(1344, 'upload/products/1648450845_The Cure.jpg', '2022-03-28 07:00:45', '2022-03-28 07:00:45'),
(1345, 'upload/products/1648451157_fresh lemon soda.png', '2022-03-28 07:05:57', '2022-03-28 07:05:57'),
(1346, 'upload/products/1648451175_Brew Cafe_White Logo_Powai.png', '2022-03-28 07:06:15', '2022-03-28 07:06:15'),
(1347, 'upload/products/1648451609_fresh lemon soda.png', '2022-03-28 07:13:29', '2022-03-28 07:13:29'),
(1348, 'upload/products/1648451620_Brew Cafe_White Logo_Powai.png', '2022-03-28 07:13:40', '2022-03-28 07:13:40'),
(1349, 'upload/products/1648452367_packaged dinking water.jpg', '2022-03-28 07:26:07', '2022-03-28 07:26:07'),
(1350, 'upload/products/1648452376_Brew Cafe_White Logo_Powai.png', '2022-03-28 07:26:16', '2022-03-28 07:26:16'),
(1351, 'upload/banners/1648553165_Banner 1.jpg', '2022-03-29 11:26:05', '2022-03-29 11:26:05'),
(1352, 'upload/banners/1648553192_Banner 2.jpg', '2022-03-29 11:26:32', '2022-03-29 11:26:32'),
(1353, 'upload/banners/1648553199_Banner 3.jpg', '2022-03-29 11:26:39', '2022-03-29 11:26:39'),
(1354, 'upload/products/1649076140_download.jpg', '2022-04-04 12:42:20', '2022-04-04 12:42:20'),
(1355, 'upload/products/1649076148_343979-sepik_1920x1080.jpg', '2022-04-04 12:42:28', '2022-04-04 12:42:28'),
(1356, 'upload/products/1649076301_download.jpg', '2022-04-04 12:45:01', '2022-04-04 12:45:01'),
(1357, 'upload/products/1649076330_343979-sepik_1920x1080.jpg', '2022-04-04 12:45:30', '2022-04-04 12:45:30'),
(1358, 'upload/offers/1649401699_277534488_142621011604379_3008017114991287255_n.jpg', '2022-04-08 07:08:19', '2022-04-08 07:08:19'),
(1359, 'upload/offers/1649401733_277580266_141868348346312_4709004062229634068_n.jpg', '2022-04-08 07:08:53', '2022-04-08 07:08:53'),
(1360, 'upload/offers/1649401772_277534488_142621011604379_3008017114991287255_n.jpg', '2022-04-08 07:09:32', '2022-04-08 07:09:32'),
(1361, 'upload/offers/1649402207_277763433_141002601766472_3201669097988860336_n.jpg', '2022-04-08 07:16:47', '2022-04-08 07:16:47'),
(1362, 'upload/banners/1659695634_Website banner 3rd page (2).webp', '2022-08-05 10:33:54', '2022-08-05 10:33:54'),
(1363, 'upload/banners/1659695662_Website banner 1st page (2).webp', '2022-08-05 10:34:22', '2022-08-05 10:34:22'),
(1364, 'upload/banners/1659695679_Website banner 2nd page (2).webp', '2022-08-05 10:34:39', '2022-08-05 10:34:39'),
(1365, 'upload/products/1660046681_Mushroom chattinad pizza.jpg', '2022-08-09 12:04:41', '2022-08-09 12:04:41'),
(1366, 'upload/products/1660046795_Mushroom chattinad pizza.jpg', '2022-08-09 12:06:35', '2022-08-09 12:06:35'),
(1367, 'upload/products/1660046952_Mushroom chattinad pizza.jpg', '2022-08-09 12:09:12', '2022-08-09 12:09:12'),
(1368, 'upload/products/1660047006_Mushroom chattinad pizza.jpg', '2022-08-09 12:10:06', '2022-08-09 12:10:06'),
(1369, 'upload/products/1660047047_Farm Delight Pizza.jpg', '2022-08-09 12:10:47', '2022-08-09 12:10:47'),
(1370, 'upload/products/1660047111_Website banner 3rd page (2).jpg', '2022-08-09 12:11:51', '2022-08-09 12:11:51'),
(1371, 'upload/products/1660047193_WhatsApp Image 2022-08-09 at 5.42.46 PM.jpeg', '2022-08-09 12:13:13', '2022-08-09 12:13:13'),
(1372, 'upload/products/1660047200_WhatsApp Image 2022-08-09 at 5.42.46 PM.jpeg', '2022-08-09 12:13:20', '2022-08-09 12:13:20'),
(1373, 'upload/products/1660053005_WhatsApp Image 2022-08-09 at 5.42.46 PM.jpeg', '2022-08-09 13:50:05', '2022-08-09 13:50:05'),
(1374, 'upload/products/1660053012_WhatsApp Image 2022-08-09 at 5.42.46 PM.jpeg', '2022-08-09 13:50:12', '2022-08-09 13:50:12'),
(1375, 'upload/products/1660719661_Classic Margherita.png', '2022-08-17 07:01:01', '2022-08-17 07:01:01'),
(1376, 'upload/products/1660719787_Classic Margherita.png', '2022-08-17 07:03:07', '2022-08-17 07:03:07'),
(1377, 'upload/products/1660722722_642_logo.png', '2022-08-17 07:52:02', '2022-08-17 07:52:02'),
(1378, 'upload/products/1660724926_642_logo.png', '2022-08-17 08:28:46', '2022-08-17 08:28:46'),
(1379, 'upload/products/1660725084_642_logo.png', '2022-08-17 08:31:24', '2022-08-17 08:31:24'),
(1380, 'upload/products/1660725087_642_logo.png', '2022-08-17 08:31:27', '2022-08-17 08:31:27'),
(1381, 'upload/products/1660725480_Classic Margherita.png', '2022-08-17 08:38:00', '2022-08-17 08:38:00'),
(1382, 'upload/products/1660727533_Classic Margherita.png', '2022-08-17 09:12:13', '2022-08-17 09:12:13'),
(1383, 'upload/products/1660727538_Classic Margherita.png', '2022-08-17 09:12:18', '2022-08-17 09:12:18'),
(1384, 'upload/products/1660732334_Mushroom chattinad pizza.png', '2022-08-17 10:32:14', '2022-08-17 10:32:14'),
(1385, 'upload/products/1660732979_Tandoori Chicken Tikka Pizza.png', '2022-08-17 10:42:59', '2022-08-17 10:42:59'),
(1386, 'upload/products/1660732987_Tandoori Paneer Pizza.png', '2022-08-17 10:43:07', '2022-08-17 10:43:07'),
(1387, 'upload/products/1660732991_Tandoori Paneer Pizza.png', '2022-08-17 10:43:11', '2022-08-17 10:43:11'),
(1388, 'upload/products/1660733295_Farm Delight Pizza.png', '2022-08-17 10:48:15', '2022-08-17 10:48:15'),
(1389, 'upload/products/1660733498_Smoked Chicken Pizza.png', '2022-08-17 10:51:38', '2022-08-17 10:51:38'),
(1390, 'upload/products/1660735413_Tandoori Paneer Pizza.png', '2022-08-17 11:23:33', '2022-08-17 11:23:33'),
(1391, 'upload/products/1660735420_Tandoori Chicken Tikka Pizza.png', '2022-08-17 11:23:40', '2022-08-17 11:23:40'),
(1392, 'upload/products/1660736128_SINGAPORE CURRY BOWL.png', '2022-08-17 11:35:28', '2022-08-17 11:35:28'),
(1393, 'upload/products/1660736492_SINGAPORE CURRY BOWL.png', '2022-08-17 11:41:32', '2022-08-17 11:41:32'),
(1394, 'upload/products/1660737447_CHICKEN IN SMOKED CHILLI SAUCE.png', '2022-08-17 11:57:27', '2022-08-17 11:57:27'),
(1395, 'upload/products/1660738562_CHICKEN IN SMOKED CHILLI SAUCE.png', '2022-08-17 12:16:02', '2022-08-17 12:16:02'),
(1396, 'bell.mp3', NULL, NULL),
(1397, 'upload/products/1661778513_Wild Mushroom Chettinad Pizza.jpg', '2022-08-29 13:08:33', '2022-08-29 13:08:33'),
(1398, 'upload/products/1661778593_Farm Delight Pizza.jpg', '2022-08-29 13:09:53', '2022-08-29 13:09:53'),
(1399, 'upload/products/1661778751_Smoked Chicken, Mozerella Bianca Pizza.jpg', '2022-08-29 13:12:31', '2022-08-29 13:12:31'),
(1400, 'upload/products/1661778832_Tandoori Chicken Pizza.jpg', '2022-08-29 13:13:52', '2022-08-29 13:13:52'),
(1401, 'upload/products/1661779181_Margherita Pizza.jpg', '2022-08-29 13:19:41', '2022-08-29 13:19:41'),
(1402, 'upload/products/1661779243_Tandoori Paneer Pizza.jpg', '2022-08-29 13:20:43', '2022-08-29 13:20:43'),
(1403, 'upload/products/1661779732_Killar Kadhai paneer.jpg', '2022-08-29 13:28:52', '2022-08-29 13:28:52'),
(1404, 'upload/products/1661779767_Tandoori Paneer Pizza.jpg', '2022-08-29 13:29:27', '2022-08-29 13:29:27'),
(1405, 'upload/products/1661779778_Tandoori Paneer Pizza.jpg', '2022-08-29 13:29:38', '2022-08-29 13:29:38'),
(1406, 'upload/products/1661779790_Tandoori Paneer Pizza.jpg', '2022-08-29 13:29:50', '2022-08-29 13:29:50'),
(1407, 'upload/products/1661779850_Paneer Makhni.jpg', '2022-08-29 13:30:50', '2022-08-29 13:30:50'),
(1408, 'upload/products/1661779926_Delji 6 chicken curry.jpg', '2022-08-29 13:32:06', '2022-08-29 13:32:06'),
(1409, 'upload/products/1661779990_spicey tawa masala chicken.jpg', '2022-08-29 13:33:10', '2022-08-29 13:33:10'),
(1410, 'upload/products/1661780060_Butter chicken.jpg', '2022-08-29 13:34:20', '2022-08-29 13:34:20'),
(1411, 'upload/products/1661780121_Biryani Veg.jpg', '2022-08-29 13:35:21', '2022-08-29 13:35:21'),
(1412, 'upload/products/1661780178_Biryani Non-Veg.jpg', '2022-08-29 13:36:18', '2022-08-29 13:36:18'),
(1413, 'upload/products/1661780299_Europian Family Combo.jpg', '2022-08-29 13:38:19', '2022-08-29 13:38:19'),
(1414, 'upload/products/1661780431_1 SMALL FARM DELIGHT PIZZA.jpg', '2022-08-29 13:40:31', '2022-08-29 13:40:31'),
(1415, 'upload/products/1661780665_PANEER IN SMOKED CHILLI SAUCE WITH STEAMED RICE.jpg', '2022-08-29 13:44:25', '2022-08-29 13:44:25'),
(1416, 'upload/products/1661780743_VEG BIRYANI or MURG BIRYANI + 1 SOFT BEVERAG.jpg', '2022-08-29 13:45:43', '2022-08-29 13:45:43');
INSERT INTO `upload_images` (`id`, `file`, `created_at`, `updated_at`) VALUES
(1417, 'upload/products/1661780923_VEG BIRYANI or MURG BIRYANI + 1 SOFT BEVERAG.jpg', '2022-08-29 13:48:43', '2022-08-29 13:48:43'),
(1418, 'upload/products/1661781039_Kadhai Paneer + 4 Butter Roti.jpg', '2022-08-29 13:50:39', '2022-08-29 13:50:39'),
(1419, 'upload/products/1661781082_Butter chicken + 4 Butter Roti.jpg', '2022-08-29 13:51:22', '2022-08-29 13:51:22'),
(1420, 'upload/locations/1661847048_Lighthouse.jpg', '2022-08-30 08:10:48', '2022-08-30 08:10:48'),
(1421, 'upload/products/1661851804_SINGAPORE CURRY BOWl_VEG.jpg', '2022-08-30 09:30:04', '2022-08-30 09:30:04'),
(1422, 'upload/products/1661852122_SINGAPORE CURRY BOWl_NON VEG.jpg', '2022-08-30 09:35:22', '2022-08-30 09:35:22'),
(1423, 'upload/products/1661852287_Chicken in smoked chilly sauce with steamed rice.jpg', '2022-08-30 09:38:07', '2022-08-30 09:38:07'),
(1424, 'upload/products/1661852407_Paneer in smoked chilly sauce with steamed rice.jpg', '2022-08-30 09:40:07', '2022-08-30 09:40:07'),
(1425, 'upload/products/1661853269_Taiwanese Fried Rice Egg.jpg', '2022-08-30 09:54:29', '2022-08-30 09:54:29'),
(1426, 'upload/products/1661853674_Taiwanese Fried Rice Egg.jpg', '2022-08-30 10:01:14', '2022-08-30 10:01:14'),
(1427, 'upload/products/1661853785_Taiwanese Fried Rice Tofu.jpg', '2022-08-30 10:03:05', '2022-08-30 10:03:05'),
(1428, 'upload/products/1661853870_Taiwanese Fried Rice chicken.jpg', '2022-08-30 10:04:30', '2022-08-30 10:04:30'),
(1429, 'upload/products/1661853956_Thai Chilli Noodle Egg.jpg', '2022-08-30 10:05:56', '2022-08-30 10:05:56'),
(1430, 'upload/products/1661854020_Thai Chilli Noodle Tofu.jpg', '2022-08-30 10:07:00', '2022-08-30 10:07:00'),
(1431, 'upload/products/1661854098_Thai Chilli Noodle Chicken.jpg', '2022-08-30 10:08:18', '2022-08-30 10:08:18'),
(1432, 'upload/products/1661854407_2 Veg Pizza Or Chicken Pizza + 2 Soft Beverage.jpg', '2022-08-30 10:13:27', '2022-08-30 10:13:27'),
(1433, 'upload/products/1661854524_2 Veg Pizza Or Chicken Pizza + 2 Soft Beverage.jpg', '2022-08-30 10:15:24', '2022-08-30 10:15:24'),
(1434, 'upload/products/1661854773_1 CHICKEN IN SMOKED CHILLI SAUCE WITH STEAMED RICE + 1 THAI CHILLI NOODLE CHICKEN + 1 SOFT BEVERAGE.jpg', '2022-08-30 10:19:33', '2022-08-30 10:19:33'),
(1435, 'upload/products/1661854846_1 Paneer IN SMOKED CHILLI SAUCE WITH STEAMED RICE + 1 THAI CHILLI NOODLE CHICKEN + 1 SOFT BEVERAGE.jpg', '2022-08-30 10:20:46', '2022-08-30 10:20:46'),
(1436, 'upload/products/1661855078_1 HYDERABADI VEGETABLE DUM BIRYANI + 1 KILLER KADHAI PANEER + 6 BUTTER ROTI.jpg', '2022-08-30 10:24:38', '2022-08-30 10:24:38'),
(1437, 'upload/products/1661855135_1 HYDERABADI MURG DUM BIRYANI + 1 BOMBASTIC BUTTER CHICKEN + 6 BUTTER ROTI.jpg', '2022-08-30 10:25:35', '2022-08-30 10:25:35'),
(1438, 'upload/products/1661855242_Lachha paratha.jpg', '2022-08-30 10:27:22', '2022-08-30 10:27:22'),
(1439, 'upload/products/1661855322_Naan.jpg', '2022-08-30 10:28:42', '2022-08-30 10:28:42'),
(1440, 'upload/products/1661855361_Mirch paratha.jpg', '2022-08-30 10:29:21', '2022-08-30 10:29:21'),
(1441, 'upload/products/1661855421_Tandoor Roti.jpg', '2022-08-30 10:30:21', '2022-08-30 10:30:21'),
(1442, 'upload/products/1661855478_Butter Roti.jpg', '2022-08-30 10:31:18', '2022-08-30 10:31:18'),
(1443, 'upload/products/1661855529_Khasta paratha.jpg', '2022-08-30 10:32:09', '2022-08-30 10:32:09'),
(1444, 'upload/products/1661855571_Streem rice.jpg', '2022-08-30 10:32:51', '2022-08-30 10:32:51'),
(1445, 'upload/offers/1662098658_Happy Hours.jpg', '2022-09-02 06:04:18', '2022-09-02 06:04:18'),
(1446, 'upload/offers/1662098701_Corporate Discount.jpg', '2022-09-02 06:05:01', '2022-09-02 06:05:01'),
(1447, 'upload/offers/1662098727_Dining Offer.webp', '2022-09-02 06:05:27', '2022-09-02 06:05:27'),
(1448, 'upload/offers/1662098946_1 + 1 Pizza Offer (1).jpg', '2022-09-02 06:09:06', '2022-09-02 06:09:06'),
(1449, 'upload/offers/1662100043_Growler Offer (1).jpg', '2022-09-02 06:27:23', '2022-09-02 06:27:23'),
(1450, 'upload/passport/1667457909_mockup_5.png', '2022-11-03 06:45:09', '2022-11-03 06:45:09'),
(1451, 'upload/passport/1667457955_Beer Passport.jpg', '2022-11-03 06:45:55', '2022-11-03 06:45:55'),
(1452, 'upload/passport/1667458078_Beer Passport.jpg', '2022-11-03 06:47:58', '2022-11-03 06:47:58'),
(1453, 'upload/passport/1667458176_Beer Passport.jpg', '2022-11-03 06:49:36', '2022-11-03 06:49:36'),
(1454, 'upload/passport/1667458257_Beer Passport.jpg', '2022-11-03 06:50:57', '2022-11-03 06:50:57'),
(1455, 'upload/places/1675352668_IMG_5700.jpg', '2023-02-02 15:44:28', '2023-02-02 15:44:28'),
(1456, 'upload/places/multiple/1675352719_IMG_5690.webp', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1457, 'upload/places/multiple/1675352719_IMG_5691.webp', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1458, 'upload/places/multiple/1675352719_IMG_5692.webp', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1459, 'upload/places/multiple/1675352719_IMG_5694.webp', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1460, 'upload/places/multiple/1675352719_IMG_5695.webp', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1461, 'upload/places/multiple/1675352719_IMG_5696.webp', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1462, 'upload/places/multiple/1675352719_IMG_5697.webp', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1463, 'upload/places/multiple/1675352719_IMG_5698.webp', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1464, 'upload/places/multiple/1675352719_IMG_5699.webp', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1465, 'upload/places/multiple/1675352719_IMG_5700.webp', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1466, 'upload/places/icons/1675352769_IMG_5697.jpg', '2023-02-02 15:46:09', '2023-02-02 15:46:09'),
(1467, 'upload/locations/1675352954_1640175372_pune.png', '2023-02-02 15:49:14', '2023-02-02 15:49:14'),
(1468, 'upload/places/icons/1675353248_47524baa-f883-43ef-ba92-28589513d094-min-1024x683.jpg', '2023-02-02 15:54:08', '2023-02-02 15:54:08'),
(1469, 'upload/places/1675353250_39cdd6d0-b3b5-4370-93d8-0f978eca67fb-min-1024x683.jpg', '2023-02-02 15:54:10', '2023-02-02 15:54:10'),
(1470, 'upload/places/multiple/1675353259_bdc18319-14b6-4c31-b829-6e2c054263f2-min-1024x576.png', '2023-02-02 15:54:19', '2023-02-02 15:54:19'),
(1471, 'upload/places/multiple/1675353259_39cdd6d0-b3b5-4370-93d8-0f978eca67fb-min-1024x683.webp', '2023-02-02 15:54:19', '2023-02-02 15:54:19'),
(1472, 'upload/places/multiple/1675353259_47524baa-f883-43ef-ba92-28589513d094-min-1024x683.webp', '2023-02-02 15:54:19', '2023-02-02 15:54:19'),
(1473, 'upload/places/multiple/1675353259_759f331c-5b70-42e6-878b-89affb961415-min-1024x576.webp', '2023-02-02 15:54:19', '2023-02-02 15:54:19'),
(1474, 'upload/places/multiple/1675353259_27ff2b6a-cf9b-4067-a6a1-dcb895fc36f5-min-1024x683.webp', '2023-02-02 15:54:19', '2023-02-02 15:54:19'),
(1475, 'upload/places/multiple/1675353259_a7a885f6-d16e-4f55-8ea2-33df862d85e3-min.webp', '2023-02-02 15:54:19', '2023-02-02 15:54:19'),
(1476, 'upload/places/multiple/1675353259_3be1aac9-92ca-4e71-8ea8-3792a72e12b4_rw_1200-min.webp', '2023-02-02 15:54:19', '2023-02-02 15:54:19'),
(1477, 'upload/places/multiple/1675353259_275b89d2-40c2-4757-a4c6-791fad0bd1de-min.webp', '2023-02-02 15:54:19', '2023-02-02 15:54:19'),
(1478, 'upload/places/multiple/1675353259_8441651a-88ed-456c-a136-49153d6b0be5-min.webp', '2023-02-02 15:54:19', '2023-02-02 15:54:19'),
(1479, 'upload/locations/1677757427_WhatsApp Image 2023-03-02 at 5.06.39 PM.jpeg', '2023-03-02 11:43:47', '2023-03-02 11:43:47'),
(1480, 'upload/locations/1677758098_WhatsApp Image 2023-03-02 at 5.06.39 PM.jpeg', '2023-03-02 11:54:58', '2023-03-02 11:54:58'),
(1481, 'upload/places/icons/1677758215_WhatsApp Image 2023-03-02 at 5.06.39 PM.jpeg', '2023-03-02 11:56:55', '2023-03-02 11:56:55'),
(1482, 'upload/places/1677758482_WhatsApp Image 2023-03-02 at 5.06.39 PM.jpeg', '2023-03-02 12:01:22', '2023-03-02 12:01:22'),
(1483, 'upload/places/icons/1677758623_WhatsApp Image 2023-03-02 at 5.06.39 PM.jpeg', '2023-03-02 12:03:43', '2023-03-02 12:03:43'),
(1484, 'upload/places/icons/1677761622__DSC0233.jpg', '2023-03-02 12:53:42', '2023-03-02 12:53:42'),
(1485, 'upload/places/1677761629__DSC0342-min.jpg', '2023-03-02 12:53:49', '2023-03-02 12:53:49'),
(1486, 'upload/places/1678275110_Screenshot_28.jpg', '2023-03-08 11:31:50', '2023-03-08 11:31:50'),
(1487, 'upload/places/multiple/1678275133_IMG_5194.webp', '2023-03-08 11:32:13', '2023-03-08 11:32:13'),
(1488, 'upload/places/multiple/1678275133_Screenshot_30.webp', '2023-03-08 11:32:13', '2023-03-08 11:32:13'),
(1489, 'upload/places/multiple/1678275133_Screenshot_29.webp', '2023-03-08 11:32:13', '2023-03-08 11:32:13'),
(1490, 'upload/places/multiple/1678275133_Screenshot_28.webp', '2023-03-08 11:32:13', '2023-03-08 11:32:13'),
(1491, 'upload/places/multiple/1678348219_Screenshot (63).webp', '2023-03-09 07:50:19', '2023-03-09 07:50:19'),
(1492, 'upload/places/icons/1678348901_Screenshot (63).png', '2023-03-09 08:01:41', '2023-03-09 08:01:41'),
(1493, 'upload/places/1678348908_Screenshot (63).png', '2023-03-09 08:01:48', '2023-03-09 08:01:48'),
(1494, 'upload/places/multiple/1678453438_WhatsApp Image 2023-03-09 at 1.40.30 PM.webp', '2023-03-10 13:03:58', '2023-03-10 13:03:58'),
(1495, 'upload/places/multiple/1678453438_WhatsApp Image 2023-03-09 at 1.40.31 PM (1).webp', '2023-03-10 13:03:58', '2023-03-10 13:03:58'),
(1496, 'upload/places/multiple/1678453438_WhatsApp Image 2023-03-09 at 1.40.31 PM (2).webp', '2023-03-10 13:03:58', '2023-03-10 13:03:58'),
(1497, 'upload/places/multiple/1678453438_WhatsApp Image 2023-03-09 at 1.40.31 PM.webp', '2023-03-10 13:03:58', '2023-03-10 13:03:58'),
(1498, 'upload/places/multiple/1678453438_WhatsApp Image 2023-03-09 at 1.40.32 PM (1).webp', '2023-03-10 13:03:58', '2023-03-10 13:03:58'),
(1499, 'upload/places/multiple/1678453438_WhatsApp Image 2023-03-09 at 1.40.32 PM.webp', '2023-03-10 13:03:58', '2023-03-10 13:03:58'),
(1500, 'upload/places/icons/1678453458_WhatsApp Image 2023-03-09 at 1.40.32 PM (1).jpeg', '2023-03-10 13:04:18', '2023-03-10 13:04:18'),
(1501, 'upload/banners/1678693010_screencapture-localhost-phpmyadmin-index-php-2023-02-14-11_21_24.png', '2023-03-13 07:36:50', '2023-03-13 07:36:50'),
(1502, 'upload/banners/1678693018_9105_1676008355.jpg', '2023-03-13 07:36:58', '2023-03-13 07:36:58'),
(1503, 'upload/locations/1678693089_9105_1676008355.jpg', '2023-03-13 07:38:09', '2023-03-13 07:38:09'),
(1504, 'upload/places/icons/1678693141_screencapture-localhost-phpmyadmin-index-php-2023-02-14-11_21_24 (1).png', '2023-03-13 07:39:01', '2023-03-13 07:39:01'),
(1505, 'upload/places/1678693144_qrcode.png', '2023-03-13 07:39:04', '2023-03-13 07:39:04'),
(1506, 'upload/places/multiple/1678693148_9105_1676008355.webp', '2023-03-13 07:39:08', '2023-03-13 07:39:08'),
(1507, 'upload/products/1678694234_IMG-3765.jpg', '2023-03-13 07:57:14', '2023-03-13 07:57:14'),
(1508, 'upload/passport/1678694296_3120_1675163780.jpg', '2023-03-13 07:58:16', '2023-03-13 07:58:16'),
(1509, 'upload/places/1680507032__DSC0233.webp', '2023-04-03 07:30:32', '2023-04-03 07:30:32'),
(1510, 'upload/places/icons/1680507044__DSC0253.jpg', '2023-04-03 07:30:44', '2023-04-03 07:30:44'),
(1511, 'upload/places/multiple/1681387630__DSC0233.webp', '2023-04-13 12:07:10', '2023-04-13 12:07:10'),
(1512, 'upload/places/multiple/1681387667__DSC0391.webp', '2023-04-13 12:07:47', '2023-04-13 12:07:47'),
(1513, 'upload/places/multiple/1681387667__DSC0294.webp', '2023-04-13 12:07:47', '2023-04-13 12:07:47'),
(1514, 'upload/places/multiple/1681387667__DSC0342 (1).webp', '2023-04-13 12:07:47', '2023-04-13 12:07:47'),
(1515, 'upload/places/multiple/1681387725__DSC0391.webp', '2023-04-13 12:08:45', '2023-04-13 12:08:45'),
(1516, 'upload/places/multiple/1681387725__DSC0294.webp', '2023-04-13 12:08:45', '2023-04-13 12:08:45'),
(1517, 'upload/places/multiple/1681387725__DSC0342 (1).webp', '2023-04-13 12:08:45', '2023-04-13 12:08:45'),
(1518, 'upload/places/multiple/1681387725__DSC0233.webp', '2023-04-13 12:08:45', '2023-04-13 12:08:45'),
(1519, 'upload/places/icons/1681388876_1640246987_FINAL RENDERS (1)_page-0002.jpg', '2023-04-13 12:27:56', '2023-04-13 12:27:56'),
(1520, 'upload/products/1682072504_TANDOORI POTATO TIKKA.JPG', '2023-04-21 10:21:44', '2023-04-21 10:21:44'),
(1521, 'upload/products/1682073442_WhatsApp Image 2023-04-21 at 4.05.48 PM.jpeg', '2023-04-21 10:37:22', '2023-04-21 10:37:22'),
(1522, 'upload/products/1682073583_KURKURE PALAK PATTA CHAAT.jpg', '2023-04-21 10:39:43', '2023-04-21 10:39:43'),
(1523, 'upload/products/1682073725_SZECHUAN VEGETABLE DIMSUM STEAMED.JPG', '2023-04-21 10:42:05', '2023-04-21 10:42:05'),
(1524, 'upload/products/1682073936_CRISPY LOTUS STEM HONEY CHILLI.JPG', '2023-04-21 10:45:36', '2023-04-21 10:45:36'),
(1525, 'upload/products/1682074017_CHILLY CHEESE CIGAR ROLLS.JPG', '2023-04-21 10:46:57', '2023-04-21 10:46:57'),
(1526, 'upload/products/1682074086_LOADED NACHOS.jpg', '2023-04-21 10:48:06', '2023-04-21 10:48:06'),
(1527, 'upload/products/1682074145_HONG KONG CHILLI PANEER.jpg', '2023-04-21 10:49:05', '2023-04-21 10:49:05'),
(1528, 'upload/products/1682074237_TEEKHA PANEER TIKKA.JPG', '2023-04-21 10:50:37', '2023-04-21 10:50:37'),
(1529, 'upload/products/1682074323_TEEKHA PANEER TIKKA.JPG', '2023-04-21 10:52:03', '2023-04-21 10:52:03'),
(1530, 'upload/products/1682074412_JUNGLI PANEER TIKKA.jpg', '2023-04-21 10:53:32', '2023-04-21 10:53:32'),
(1531, 'upload/products/1682074462_JUNGLI PANEER TIKKA.jpg', '2023-04-21 10:54:22', '2023-04-21 10:54:22'),
(1532, 'upload/products/1682074532_CHICKEN KOLI WADA.JPG', '2023-04-21 10:55:32', '2023-04-21 10:55:32'),
(1533, 'upload/products/1682074675_KALI MIRCH THREE CHEESE CHICKEN TIKKA.JPG', '2023-04-21 10:57:55', '2023-04-21 10:57:55'),
(1534, 'upload/products/1682074812_CHILLI TERIYAKI CHICKEN.jpg', '2023-04-21 11:00:12', '2023-04-21 11:00:12'),
(1535, 'upload/products/1682074900_CHILLI GARLIC CHICKEN DIMSUM FRIED IN WASABI SAUCE.JPG', '2023-04-21 11:01:40', '2023-04-21 11:01:40'),
(1536, 'upload/products/1682074982_CHICKEN WINGS 65.JPG', '2023-04-21 11:03:02', '2023-04-21 11:03:02'),
(1537, 'upload/products/1682075058_CHICKEN WINGS 65.JPG', '2023-04-21 11:04:18', '2023-04-21 11:04:18'),
(1538, 'upload/products/1682075130_OLD MONK CHICKEN WINGS.JPG', '2023-04-21 11:05:30', '2023-04-21 11:05:30'),
(1539, 'upload/products/1682075198_OLD MONK CHICKEN WINGS.JPG', '2023-04-21 11:06:38', '2023-04-21 11:06:38'),
(1540, 'upload/products/1682075291_CHICKEN TIKKA OUR WAY.JPG', '2023-04-21 11:08:11', '2023-04-21 11:08:11'),
(1541, 'upload/products/1682075378_OUR SIGNATURE SPICY ROCK CHICKEN FINGERS.JPG', '2023-04-21 11:09:38', '2023-04-21 11:09:38'),
(1542, 'upload/products/1682075522_AMRITSARI FISH TIKKA.jpg', '2023-04-21 11:12:02', '2023-04-21 11:12:02'),
(1543, 'upload/products/1682075873_FARM DELIGHT.JPG', '2023-04-21 11:17:53', '2023-04-21 11:17:53'),
(1544, 'upload/products/1682075970_HAWAIIAN PIZZA.JPG', '2023-04-21 11:19:30', '2023-04-21 11:19:30'),
(1545, 'upload/products/1682076054_TANDOORI PANEER PIZZA.jpg', '2023-04-21 11:20:54', '2023-04-21 11:20:54'),
(1546, 'upload/products/1682076329_SMOKED CHICKEN, MOZZARELLA BIANCA.jpg', '2023-04-21 11:25:29', '2023-04-21 11:25:29'),
(1547, 'upload/products/1682076411_GRILLED CHICKEN & PESTO PIZZA.JPG', '2023-04-21 11:26:51', '2023-04-21 11:26:51'),
(1548, 'upload/products/1682076506_PANEER SIRKA PYAAZ.JPG', '2023-04-21 11:28:26', '2023-04-21 11:28:26'),
(1549, 'upload/products/1682076787_LAHSUNIYA PALAK PANEER.JPG', '2023-04-21 11:33:07', '2023-04-21 11:33:07'),
(1550, 'upload/products/1682076863_SPICY TAWA MASALA CHICKEN.JPG', '2023-04-21 11:34:23', '2023-04-21 11:34:23'),
(1551, 'upload/products/1682076958_CHICKEN GHEE ROAST.JPG', '2023-04-21 11:35:58', '2023-04-21 11:35:58'),
(1552, 'upload/products/1682077043_DELHI 6 FAMOUS CHICKEN CURRY.jpg', '2023-04-21 11:37:23', '2023-04-21 11:37:23'),
(1553, 'upload/products/1682077109_GOAN PRAWN CURRY.jpg', '2023-04-21 11:38:29', '2023-04-21 11:38:29'),
(1554, 'upload/products/1682077453_RED THAI CURRY BOWL.jpg', '2023-04-21 11:44:13', '2023-04-21 11:44:13'),
(1555, 'upload/products/1682077519_RED THAI CURRY BOWL.jpg', '2023-04-21 11:45:19', '2023-04-21 11:45:19'),
(1556, 'upload/products/1682077603_RED THAI CURRY BOWL.jpg', '2023-04-21 11:46:43', '2023-04-21 11:46:43'),
(1557, 'upload/products/1682077682_THAI BASIL TOFU.JPG', '2023-04-21 11:48:02', '2023-04-21 11:48:02'),
(1558, 'upload/products/1682077805_THAI BASIL TOFU.JPG', '2023-04-21 11:50:05', '2023-04-21 11:50:05'),
(1559, 'upload/products/1682077883_PANEER IN SMOKED CHILLI SAUCE.JPG', '2023-04-21 11:51:23', '2023-04-21 11:51:23'),
(1560, 'upload/products/1682077993_CHICKEN IN SMOKED CHILLI SAUCE.JPG', '2023-04-21 11:53:13', '2023-04-21 11:53:13'),
(1561, 'upload/products/1682078065_VEGETABLE DUM BIRYANI.jpg', '2023-04-21 11:54:25', '2023-04-21 11:54:25'),
(1562, 'upload/products/1682078196_MURG BIRYANI.jpg', '2023-04-21 11:56:36', '2023-04-21 11:56:36'),
(1563, 'upload/products/1682078337_PENNE ALFREDO.jpg', '2023-04-21 11:58:57', '2023-04-21 11:58:57'),
(1564, 'upload/products/1682078390_PENNE ALFREDO.jpg', '2023-04-21 11:59:50', '2023-04-21 11:59:50'),
(1565, 'upload/products/1682078470_GRILLED CHICKEN BREAST WITH MIX MUSHROOM SAUCE.JPG', '2023-04-21 12:01:10', '2023-04-21 12:01:10'),
(1566, 'upload/products/1682078592_STEAM RICE.jpg', '2023-04-21 12:03:12', '2023-04-21 12:03:12'),
(1567, 'upload/products/1682078651_ROTI.jpg', '2023-04-21 12:04:11', '2023-04-21 12:04:11'),
(1568, 'upload/products/1682078689_NAAN.jpg', '2023-04-21 12:04:49', '2023-04-21 12:04:49'),
(1569, 'upload/products/1682078728_LACCHA PARATHA.jpg', '2023-04-21 12:05:28', '2023-04-21 12:05:28'),
(1570, 'upload/products/1682078759_HARI MIRCHI KA PARATHA.jpg', '2023-04-21 12:05:59', '2023-04-21 12:05:59'),
(1571, 'upload/products/1682078793_NAAN.jpg', '2023-04-21 12:06:33', '2023-04-21 12:06:33'),
(1572, 'upload/products/1682078866_CLASSIC CANNOLI WITH MASCARPONE CREAM.JPG', '2023-04-21 12:07:46', '2023-04-21 12:07:46'),
(1573, 'upload/products/1682082517_HONEY CHILLI CAULIFLOWER.jpg', '2023-04-21 13:08:37', '2023-04-21 13:08:37'),
(1574, 'upload/products/1682082575_VEGETABLE SALT AND PEPPER.jpg', '2023-04-21 13:09:35', '2023-04-21 13:09:35'),
(1575, 'upload/products/1682082634_INDO CHINESE CHILLI PANEER.jpg', '2023-04-21 13:10:34', '2023-04-21 13:10:34'),
(1576, 'upload/products/1682082687_CHICKEN POPCORN.jpg', '2023-04-21 13:11:27', '2023-04-21 13:11:27'),
(1577, 'upload/products/1682082734_INDO CHINESE CHILLI CHICKEN.jpg', '2023-04-21 13:12:14', '2023-04-21 13:12:14'),
(1578, 'upload/products/1682082810_CHILLI GARLIC CHICKEN DIMSUM STEAMED.jpg', '2023-04-21 13:13:30', '2023-04-21 13:13:30'),
(1579, 'upload/products/1682082864_SHRIMP POPCORN DUSTED WITH GUN POWDER.jpg', '2023-04-21 13:14:24', '2023-04-21 13:14:24'),
(1580, 'upload/products/1682082994_AMRITSARI FISH FINGER.jpg', '2023-04-21 13:16:34', '2023-04-21 13:16:34'),
(1581, 'upload/products/1682083062_HOT CHILLI VEGETABLES.jpg', '2023-04-21 13:17:42', '2023-04-21 13:17:42'),
(1582, 'upload/products/1682083108_CHICKEN TIKKA PIZZA.jpg', '2023-04-21 13:18:28', '2023-04-21 13:18:28'),
(1583, 'upload/products/1682083164_DAL MAKHANI.jpg', '2023-04-21 13:19:24', '2023-04-21 13:19:24'),
(1584, 'upload/products/1682083210_DAL DHABA.jpg', '2023-04-21 13:20:10', '2023-04-21 13:20:10'),
(1585, 'upload/products/1682083478_ANARDANE WALE AMRITSARI CHOLE.jpg', '2023-04-21 13:24:38', '2023-04-21 13:24:38'),
(1586, 'upload/locations/1682144973_1678702170_img4.jpg', '2023-04-22 06:29:33', '2023-04-22 06:29:33'),
(1587, 'upload/locations/1682145389_1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0002.jpg', '2023-04-22 06:36:29', '2023-04-22 06:36:29'),
(1588, 'upload/places/1682145567_1640869739_4X3A2733.jpg', '2023-04-22 06:39:27', '2023-04-22 06:39:27'),
(1589, 'upload/locations/1682145571_1640869739_4X3A2733.jpg', '2023-04-22 06:39:31', '2023-04-22 06:39:31'),
(1590, 'upload/places/icons/1682145681_1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0002.jpg', '2023-04-22 06:41:21', '2023-04-22 06:41:21'),
(1591, 'upload/places/1682145686_iiec_fav.png', '2023-04-22 06:41:26', '2023-04-22 06:41:26'),
(1592, 'upload/places/multiple/1682145722_1634482586_img.webp', '2023-04-22 06:42:02', '2023-04-22 06:42:02'),
(1593, 'upload/places/multiple/1682145729_1634482586_img.webp', '2023-04-22 06:42:09', '2023-04-22 06:42:09'),
(1594, 'upload/places/multiple/1682145729_1634482687_img.webp', '2023-04-22 06:42:09', '2023-04-22 06:42:09'),
(1595, 'upload/places/multiple/1682145729_1634482696_img.webp', '2023-04-22 06:42:09', '2023-04-22 06:42:09'),
(1596, 'upload/places/multiple/1682145729_1634482707_img.webp', '2023-04-22 06:42:09', '2023-04-22 06:42:09'),
(1597, 'upload/places/multiple/1682145729_1634559424_August-2019-The-Astrological-eMagazine.webp', '2023-04-22 06:42:09', '2023-04-22 06:42:09'),
(1598, 'upload/places/1682145802_1678796088_img1.jpg', '2023-04-22 06:43:22', '2023-04-22 06:43:22'),
(1599, 'upload/places/1682146555_1634559424_August-2019-The-Astrological-eMagazine.jpg', '2023-04-22 06:55:55', '2023-04-22 06:55:55'),
(1600, 'upload/places/1682146575_1634559438_April-2020-The-Astrological-eMagazine.jpg', '2023-04-22 06:56:15', '2023-04-22 06:56:15'),
(1601, 'upload/places/1682146795_1634559424_August-2019-The-Astrological-eMagazine.jpg', '2023-04-22 06:59:55', '2023-04-22 06:59:55'),
(1602, 'upload/places/1682146934_1636984315_passport (2).jpg', '2023-04-22 07:02:14', '2023-04-22 07:02:14'),
(1603, 'upload/places/1682147050_1678796159_img1.jpg', '2023-04-22 07:04:10', '2023-04-22 07:04:10'),
(1604, 'upload/products/1682312009_BIRBALI KOFTA.jpg', '2023-04-24 04:53:29', '2023-04-24 04:53:29'),
(1605, 'upload/products/1682312068_PUNJABI MATAR MUSHROOM MAKHANI.jpg', '2023-04-24 04:54:28', '2023-04-24 04:54:28'),
(1606, 'upload/products/1682312148_BIHARI STYLE FISH CURRY.jpg', '2023-04-24 04:55:48', '2023-04-24 04:55:48'),
(1607, 'upload/products/1682312192_PENNE MARINARA VEG.jpg', '2023-04-24 04:56:32', '2023-04-24 04:56:32'),
(1608, 'upload/products/1682312236_PENNE MARINARA NONVEG.jpg', '2023-04-24 04:57:16', '2023-04-24 04:57:16'),
(1609, 'upload/products/1682312400_FRIES.jpg', '2023-04-24 05:00:00', '2023-04-24 05:00:00'),
(1610, 'upload/products/1682312456_PERI PERI FRIES.jpg', '2023-04-24 05:00:56', '2023-04-24 05:00:56'),
(1611, 'upload/products/1682312493_VEGETABLE RAITA.jpg', '2023-04-24 05:01:33', '2023-04-24 05:01:33'),
(1612, 'upload/products/1682506027_SZECHUAN VEGETABLE DIMSUM  FRIED IN WASABI CHEESE SAUCE.jpg', '2023-04-26 10:47:07', '2023-04-26 10:47:07'),
(1613, 'upload/products/1682506092_CHILLI GARLIC BUTTER POACHED PRAWNS.jpg', '2023-04-26 10:48:12', '2023-04-26 10:48:12'),
(1614, 'upload/products/1682506933_Red Or Green Thai Curry Bowl.jpg', '2023-04-26 11:02:13', '2023-04-26 11:02:13'),
(1615, 'upload/products/1682507022_Red Or Green Thai Curry Bowl.jpg', '2023-04-26 11:03:42', '2023-04-26 11:03:42'),
(1616, 'upload/products/1682507893_Veg Dum Biryani.jpg', '2023-04-26 11:18:13', '2023-04-26 11:18:13'),
(1617, 'upload/products/1682507937_Murg Dum Biryani.jpg', '2023-04-26 11:18:57', '2023-04-26 11:18:57'),
(1618, 'upload/products/1682508075_Red Or Green Thai Curry Bowl.jpg', '2023-04-26 11:21:15', '2023-04-26 11:21:15'),
(1619, 'upload/products/1682508894_Kolkata Gosht Biryani.jpg', '2023-04-26 11:34:54', '2023-04-26 11:34:54'),
(1620, 'upload/products/1682509001_Noodle Egg.jpg', '2023-04-26 11:36:41', '2023-04-26 11:36:41'),
(1621, 'upload/products/1682509186_THAI BASIL TOFU.JPG', '2023-04-26 11:39:46', '2023-04-26 11:39:46'),
(1622, 'upload/products/1682509320_Thai Basil Chicken.JPG', '2023-04-26 11:42:00', '2023-04-26 11:42:00'),
(1623, 'upload/products/1682509437_GREEN THAI CURRY BOWL.JPG', '2023-04-26 11:43:57', '2023-04-26 11:43:57'),
(1624, 'upload/products/1682509782_Funghi selvatici pizza.JPG', '2023-04-26 11:49:42', '2023-04-26 11:49:42'),
(1625, 'upload/products/1682510000_Finch Special Latpat Chicken.JPG', '2023-04-26 11:53:20', '2023-04-26 11:53:20'),
(1626, 'upload/products/1682510093_Mutton Rogun Josh.JPG', '2023-04-26 11:54:53', '2023-04-26 11:54:53'),
(1627, 'upload/locations/1682745557_WhatsApp Image 2023-04-29 at 10.36.10 AM.jpeg', '2023-04-29 05:19:17', '2023-04-29 05:19:17'),
(1628, 'upload/locations/1682745619_Thane Icon.png', '2023-04-29 05:20:19', '2023-04-29 05:20:19'),
(1629, 'upload/locations/1682746580_Thane Icon (1).png', '2023-04-29 05:36:20', '2023-04-29 05:36:20'),
(1630, 'upload/locations/1682747031_1640175341_mumbai.png', '2023-04-29 05:43:51', '2023-04-29 05:43:51'),
(1631, 'upload/places/1682749542_Brewhouse.png', '2023-04-29 06:25:42', '2023-04-29 06:25:42'),
(1632, 'upload/places/1682766097_Brewhouse.png', '2023-04-29 11:01:37', '2023-04-29 11:01:37'),
(1633, 'upload/places/1682766119_Finch.png', '2023-04-29 11:01:59', '2023-04-29 11:01:59'),
(1634, 'upload/places/1682766198_Finch.png', '2023-04-29 11:03:18', '2023-04-29 11:03:18'),
(1635, 'upload/places/1682766207_Brewhouse.png', '2023-04-29 11:03:27', '2023-04-29 11:03:27'),
(1636, 'upload/places/1682766215_Brewhouse.png', '2023-04-29 11:03:35', '2023-04-29 11:03:35'),
(1637, 'upload/products/1683787606_VALCANO NACHOS.jpg', '2023-05-11 06:46:46', '2023-05-11 06:46:46'),
(1638, 'upload/products/1683788982_CHILLY CHEESE CIGAR ROLLS.JPG', '2023-05-11 07:09:42', '2023-05-11 07:09:42'),
(1639, 'upload/products/1683789191_THAI VEG SPRING ROLL.jpg', '2023-05-11 07:13:11', '2023-05-11 07:13:11'),
(1640, 'upload/products/1683789342_Z’atar Spiced Chicken Cutlet.JPG', '2023-05-11 07:15:42', '2023-05-11 07:15:42'),
(1641, 'upload/products/1683789554_Crispy chicken koliwada with green apple chutney.JPG', '2023-05-11 07:19:14', '2023-05-11 07:19:14'),
(1642, 'upload/products/1683789803_Drunken Chicken Wings.JPG', '2023-05-11 07:23:23', '2023-05-11 07:23:23'),
(1643, 'upload/products/1683790131_Drunken Chicken Wings.JPG', '2023-05-11 07:28:51', '2023-05-11 07:28:51'),
(1644, 'upload/products/1683790327_Drunken Chicken Wings.JPG', '2023-05-11 07:32:07', '2023-05-11 07:32:07'),
(1645, 'upload/products/1683790492_Spicky Rock Chicken Fingers.jpg', '2023-05-11 07:34:52', '2023-05-11 07:34:52'),
(1646, 'upload/products/1683790804_FINCH_S SPECIAL INDIAN MASALA.jpg', '2023-05-11 07:40:04', '2023-05-11 07:40:04'),
(1647, 'upload/products/1683791256_English Breakfat.JPG', '2023-05-11 07:47:36', '2023-05-11 07:47:36'),
(1648, 'upload/products/1683792704_Grilled chicken in mojo rojo Sandwich.jpg', '2023-05-11 08:11:44', '2023-05-11 08:11:44'),
(1649, 'upload/products/1683795709_Classic Margherita Pizza.jpg', '2023-05-11 09:01:49', '2023-05-11 09:01:49'),
(1650, 'upload/products/1683795846_FARM DELIGHT PIZZA.jpg', '2023-05-11 09:04:06', '2023-05-11 09:04:06'),
(1651, 'upload/products/1683795975_CHICKEN TIKKA PIZZA.jpg', '2023-05-11 09:06:15', '2023-05-11 09:06:15'),
(1652, 'upload/products/1683796075_MeatBall Pizza.jpg', '2023-05-11 09:07:55', '2023-05-11 09:07:55'),
(1653, 'upload/products/1683796688_Amritsari fish n chips.jpg', '2023-05-11 09:18:08', '2023-05-11 09:18:08'),
(1654, 'upload/products/1683797736_Pasta Bowl.jpg', '2023-05-11 09:35:36', '2023-05-11 09:35:36'),
(1655, 'upload/products/1683798137_Bombastic Butter chicken platter.jpg', '2023-05-11 09:42:17', '2023-05-11 09:42:17'),
(1656, 'upload/products/1683798317_Killar Kadhai paneer.jpg', '2023-05-11 09:45:17', '2023-05-11 09:45:17'),
(1657, 'upload/products/1683898524_Killar Kadhai paneer.jpg', '2023-05-12 13:35:24', '2023-05-12 13:35:24'),
(1658, 'upload/products/1683898666_Killar Kadhai paneer.jpg', '2023-05-12 13:37:46', '2023-05-12 13:37:46'),
(1659, 'upload/products/1683898908_Thai chilli noodles.jpg', '2023-05-12 13:41:48', '2023-05-12 13:41:48'),
(1660, 'upload/products/1683899143_Thai chilli noodles.jpg', '2023-05-12 13:45:43', '2023-05-12 13:45:43'),
(1661, 'upload/products/1683899264_Thai chilli noodles.jpg', '2023-05-12 13:47:44', '2023-05-12 13:47:44'),
(1662, 'upload/products/1683899728_Garlic-bread.jpg', '2023-05-12 13:55:28', '2023-05-12 13:55:28'),
(1663, 'upload/products/1683899942_DAL MAKHANI.jpg', '2023-05-12 13:59:02', '2023-05-12 13:59:02'),
(1664, 'upload/offers/1685080379_1662098701_Corporate Discount.jpg', '2023-05-26 05:52:59', '2023-05-26 05:52:59'),
(1665, 'upload/places/1685711970_Finch.png', '2023-06-02 13:19:30', '2023-06-02 13:19:30'),
(1666, 'upload/places/1685712251_White Logo.png', '2023-06-02 13:24:11', '2023-06-02 13:24:11'),
(1667, 'upload/places/1685712263_White Logo.png', '2023-06-02 13:24:23', '2023-06-02 13:24:23'),
(1668, 'upload/places/1685712280_White Logo.png', '2023-06-02 13:24:40', '2023-06-02 13:24:40'),
(1669, 'upload/places/1685712333_Finch.png', '2023-06-02 13:25:33', '2023-06-02 13:25:33'),
(1670, 'upload/products/1690208959_login_back.jpeg', '2023-07-24 19:59:19', '2023-07-24 19:59:19'),
(1671, 'upload/products/1690209061_login_back.jpeg', '2023-07-24 20:01:01', '2023-07-24 20:01:01'),
(1672, 'upload/products/1690209064_login_back.jpeg', '2023-07-24 20:01:04', '2023-07-24 20:01:04'),
(1673, 'upload/products/1690549087_51uF0Hl2PvL.jpg', '2023-07-28 18:28:07', '2023-07-28 18:28:07'),
(1674, 'upload/products/1690549092_how-to-make-homemade-french-fries-2215971-hero-01-02f62a016f3e4aa4b41d0c27539885c3.jpg', '2023-07-28 18:28:12', '2023-07-28 18:28:12'),
(1675, 'upload/products/1690549095_how-to-make-homemade-french-fries-2215971-hero-01-02f62a016f3e4aa4b41d0c27539885c3.jpg', '2023-07-28 18:28:15', '2023-07-28 18:28:15'),
(1676, 'upload/products/1690552107_how-to-make-homemade-french-fries-2215971-hero-01-02f62a016f3e4aa4b41d0c27539885c3.jpg', '2023-07-28 19:18:27', '2023-07-28 19:18:27'),
(1677, 'upload/products/1690552112_how-to-make-homemade-french-fries-2215971-hero-01-02f62a016f3e4aa4b41d0c27539885c3.jpg', '2023-07-28 19:18:32', '2023-07-28 19:18:32'),
(1678, 'upload/products/1690552130_51uF0Hl2PvL.jpg', '2023-07-28 19:18:50', '2023-07-28 19:18:50'),
(1679, 'upload/products/1690552147_51uF0Hl2PvL.jpg', '2023-07-28 19:19:07', '2023-07-28 19:19:07'),
(1680, 'upload/products/1690552201_51uF0Hl2PvL.jpg', '2023-07-28 19:20:01', '2023-07-28 19:20:01'),
(1681, 'upload/products/1690552204_download (2).jpg', '2023-07-28 19:20:04', '2023-07-28 19:20:04'),
(1682, 'upload/products/1690552208_download (2).jpg', '2023-07-28 19:20:08', '2023-07-28 19:20:08'),
(1683, 'upload/products/1690552261_download (1).jpg', '2023-07-28 19:21:01', '2023-07-28 19:21:01'),
(1684, 'upload/products/1690552265_download (1).jpg', '2023-07-28 19:21:05', '2023-07-28 19:21:05'),
(1685, 'upload/products/1690552281_download.jpg', '2023-07-28 19:21:21', '2023-07-28 19:21:21'),
(1686, 'upload/products/1690552289_download.jpg', '2023-07-28 19:21:29', '2023-07-28 19:21:29'),
(1687, 'upload/products/1692620455_trading2.png', '2023-08-21 17:50:55', '2023-08-21 17:50:55'),
(1688, 'upload/products/1692620462_processed-490a8573-a618-4790-9f02-4710bb9b830a_dW5hsAAL.jpeg', '2023-08-21 17:51:02', '2023-08-21 17:51:02'),
(1689, 'upload/banners/1693821561_WhatsApp Image 2023-08-18 at 14.03.50.jpg', '2023-09-04 15:29:21', '2023-09-04 15:29:21'),
(1690, 'upload/banners/1693821602_WhatsApp Image 2023-08-18 at 14.03.50.jpg', '2023-09-04 15:30:02', '2023-09-04 15:30:02'),
(1691, 'upload/products/1693821801_WhatsApp Image 2023-08-18 at 14.03.50.jpg', '2023-09-04 15:33:21', '2023-09-04 15:33:21'),
(1692, 'upload/products/1693821877_unnamed (1).png', '2023-09-04 15:34:37', '2023-09-04 15:34:37'),
(1693, 'upload/banners/1693905483-.webp', '2023-09-05 14:48:04', '2023-09-05 14:48:04'),
(1694, 'upload/offers/1693905894-.webp', '2023-09-05 14:54:55', '2023-09-05 14:54:55'),
(1695, 'upload/offers/1693906064-.webp', '2023-09-05 14:57:45', '2023-09-05 14:57:45'),
(1696, 'upload/locations/1693906383-.webp', '2023-09-05 15:03:04', '2023-09-05 15:03:04'),
(1697, 'upload/places/1693906393-.webp', '2023-09-05 15:03:14', '2023-09-05 15:03:14'),
(1698, 'upload/places/multiple/1693907265_Frozen-Cold-Plunge-Background1.webp', '2023-09-05 15:17:45', '2023-09-05 15:17:45'),
(1699, 'upload/places/icons/1693907298-.webp', '2023-09-05 15:18:19', '2023-09-05 15:18:19'),
(1700, 'upload/places/1693907308-.webp', '2023-09-05 15:18:29', '2023-09-05 15:18:29'),
(1701, 'upload/places/1693907319-.webp', '2023-09-05 15:18:40', '2023-09-05 15:18:40'),
(1702, 'upload/products/1693907503-.webp', '2023-09-05 15:21:44', '2023-09-05 15:21:44'),
(1703, 'upload/products/1693907545-.webp', '2023-09-05 15:22:26', '2023-09-05 15:22:26'),
(1704, 'upload/products/1693907719-.webp', '2023-09-05 15:25:19', '2023-09-05 15:25:19'),
(1705, 'upload/products/1693908324-.webp', '2023-09-05 15:35:25', '2023-09-05 15:35:25'),
(1706, 'upload/products/1693908333-.webp', '2023-09-05 15:35:33', '2023-09-05 15:35:33'),
(1707, 'upload/banners/1693908351-.webp', '2023-09-05 15:35:52', '2023-09-05 15:35:52'),
(1708, 'upload/banners/1693908820-.webp', '2023-09-05 15:43:41', '2023-09-05 15:43:41'),
(1709, 'upload/banners/1693908900-.webp', '2023-09-05 15:45:01', '2023-09-05 15:45:01'),
(1710, 'upload/passport/1694535793-.webp', '2023-09-12 21:53:13', '2023-09-12 21:53:13'),
(1711, 'upload/passport/1694536480-.webp', '2023-09-12 22:04:40', '2023-09-12 22:04:40'),
(1712, 'upload/passport/1694536621-.webp', '2023-09-12 22:07:01', '2023-09-12 22:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `upload_images_old`
--

CREATE TABLE `upload_images_old` (
  `id` int NOT NULL,
  `file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `upload_images_old`
--

INSERT INTO `upload_images_old` (`id`, `file`, `created_at`, `updated_at`) VALUES
(1, 'upload/banners/1634713242_1.jpg', '2021-10-20 07:00:43', '2021-10-20 07:00:43'),
(2, 'upload/banners/1634713301_1.jpg', '2021-10-20 07:01:41', '2021-10-20 07:01:41'),
(3, 'upload/banners/1634713327_1.jpg', '2021-10-20 07:02:07', '2021-10-20 07:02:07'),
(4, 'upload/locations/1634713424_icon1.png', '2021-10-20 07:03:44', '2021-10-20 07:03:44'),
(5, 'upload/locations/1634713440_icon1.png', '2021-10-20 07:04:00', '2021-10-20 07:04:00'),
(6, 'upload/locations/1634713454_icon1.png', '2021-10-20 07:04:14', '2021-10-20 07:04:14'),
(7, 'upload/places/icons/1634714952_icon1.png', '2021-10-20 07:29:12', '2021-10-20 07:29:12'),
(8, 'upload/places/multiple/1634715005_2.JPG', '2021-10-20 07:30:05', '2021-10-20 07:30:05'),
(9, 'upload/places/multiple/1634715317_2.JPG', '2021-10-20 07:35:17', '2021-10-20 07:35:17'),
(10, 'upload/places/icons/1634715381_icon1.png', '2021-10-20 07:36:21', '2021-10-20 07:36:21'),
(11, 'upload/places/1634715408_icon1.png', '2021-10-20 07:36:48', '2021-10-20 07:36:48'),
(12, 'upload/places/icons/1634715513_icon1.png', '2021-10-20 07:38:33', '2021-10-20 07:38:33'),
(13, 'upload/places/1634715592_2.jpg', '2021-10-20 07:39:52', '2021-10-20 07:39:52'),
(14, 'upload/places/icons/1634715678_icon1.png', '2021-10-20 07:41:18', '2021-10-20 07:41:18'),
(15, 'upload/places/multiple/1634715697_2.JPG', '2021-10-20 07:41:37', '2021-10-20 07:41:37'),
(16, 'upload/places/icons/1634715759_icon1.png', '2021-10-20 07:42:39', '2021-10-20 07:42:39'),
(17, 'upload/places/1634715765_2.jpg', '2021-10-20 07:42:45', '2021-10-20 07:42:45'),
(18, 'upload/places/multiple/1634715775_2.JPG', '2021-10-20 07:42:55', '2021-10-20 07:42:55'),
(19, 'upload/places/icons/1634715806_icon1.png', '2021-10-20 07:43:26', '2021-10-20 07:43:26'),
(20, 'upload/places/1634715816_2.jpg', '2021-10-20 07:43:36', '2021-10-20 07:43:36'),
(21, 'upload/places/multiple/1634715825_2.JPG', '2021-10-20 07:43:45', '2021-10-20 07:43:45'),
(22, 'upload/places/icons/1634715867_icon1.png', '2021-10-20 07:44:27', '2021-10-20 07:44:27'),
(23, 'upload/places/1634715872_2.jpg', '2021-10-20 07:44:32', '2021-10-20 07:44:32'),
(24, 'upload/places/multiple/1634715882_2.JPG', '2021-10-20 07:44:42', '2021-10-20 07:44:42'),
(25, 'upload/places/icons/1634715930_icon1.png', '2021-10-20 07:45:30', '2021-10-20 07:45:30'),
(26, 'upload/places/1634715938_2.jpg', '2021-10-20 07:45:38', '2021-10-20 07:45:38'),
(27, 'upload/places/multiple/1634715943_2.jpg', '2021-10-20 07:45:43', '2021-10-20 07:45:43'),
(28, 'upload/places/icons/1634715992_icon1.png', '2021-10-20 07:46:32', '2021-10-20 07:46:32'),
(29, 'upload/places/1634715999_2.jpg', '2021-10-20 07:46:39', '2021-10-20 07:46:39'),
(30, 'upload/places/multiple/1634716004_2.jpg', '2021-10-20 07:46:44', '2021-10-20 07:46:44'),
(31, 'upload/places/icons/1634716048_icon1.png', '2021-10-20 07:47:28', '2021-10-20 07:47:28'),
(32, 'upload/places/1634716057_2.jpg', '2021-10-20 07:47:37', '2021-10-20 07:47:37'),
(33, 'upload/places/multiple/1634716061_2.jpg', '2021-10-20 07:47:41', '2021-10-20 07:47:41'),
(34, 'upload/products/1634719014_layer2.png', '2021-10-20 08:36:54', '2021-10-20 08:36:54'),
(35, 'upload/products/1634719036_layer1.png', '2021-10-20 08:37:16', '2021-10-20 08:37:16'),
(36, 'upload/products/1634719326_layer1.png', '2021-10-20 08:42:06', '2021-10-20 08:42:06'),
(37, 'upload/products/1634719496_layer2.png', '2021-10-20 08:44:56', '2021-10-20 08:44:56'),
(38, 'upload/products/1634719657_layer3.png', '2021-10-20 08:47:37', '2021-10-20 08:47:37'),
(39, 'upload/products/1634719776_layer4.png', '2021-10-20 08:49:36', '2021-10-20 08:49:36'),
(40, 'upload/products/1634719909_layer5.png', '2021-10-20 08:51:49', '2021-10-20 08:51:49'),
(41, 'upload/products/1634720054_layer6.png', '2021-10-20 08:54:14', '2021-10-20 08:54:14'),
(42, 'upload/products/1634725417_img1.png', '2021-10-20 10:23:37', '2021-10-20 10:23:37'),
(43, 'upload/products/1634725523_img1.png', '2021-10-20 10:25:23', '2021-10-20 10:25:23'),
(44, 'upload/products/1634725593_img1.png', '2021-10-20 10:26:33', '2021-10-20 10:26:33'),
(45, 'upload/products/1634725757_img1.png', '2021-10-20 10:29:17', '2021-10-20 10:29:17'),
(46, 'upload/products/1634725810_img1.png', '2021-10-20 10:30:10', '2021-10-20 10:30:10'),
(47, 'upload/products/1634725871_img1.png', '2021-10-20 10:31:11', '2021-10-20 10:31:11'),
(48, 'upload/products/1634725924_img1.png', '2021-10-20 10:32:04', '2021-10-20 10:32:04'),
(49, 'upload/offers/1634796800_img2.png', '2021-10-21 06:13:20', '2021-10-21 06:13:20'),
(50, 'upload/offers/1634796999_2.jpg', '2021-10-21 06:16:39', '2021-10-21 06:16:39'),
(51, 'upload/offers/1634797035_2.jpg', '2021-10-21 06:17:15', '2021-10-21 06:17:15'),
(52, 'upload/offers/1634797097_2.jpg', '2021-10-21 06:18:17', '2021-10-21 06:18:17'),
(53, 'upload/offers/1634797133_2.jpg', '2021-10-21 06:18:53', '2021-10-21 06:18:53'),
(54, 'upload/offers/1634797341_2.jpg', '2021-10-21 06:22:21', '2021-10-21 06:22:21'),
(55, 'upload/passport/1634829284_img.jpg', '2021-10-21 15:14:44', '2021-10-21 15:14:44'),
(56, 'upload/passport/1634829326_img.jpg', '2021-10-21 15:15:26', '2021-10-21 15:15:26'),
(57, 'upload/passport/1634829361_img.jpg', '2021-10-21 15:16:01', '2021-10-21 15:16:01'),
(58, 'upload/places/icons/1636635220_nature-hd-for-pc-download-1920x1080-wallpaper-preview.jpg', '2021-11-11 12:53:40', '2021-11-11 12:53:40'),
(59, 'upload/places/1636635227_collage (1).jpg', '2021-11-11 12:53:47', '2021-11-11 12:53:47'),
(60, 'upload/places/multiple/1636635231_nature-hd-for-pc-download-1920x1080-wallpaper-preview.jpg', '2021-11-11 12:53:51', '2021-11-11 12:53:51'),
(61, 'upload/places/multiple/1636635246_wp78987.jpg', '2021-11-11 12:54:06', '2021-11-11 12:54:06'),
(62, 'upload/places/multiple/1636635246_6-66420_full-hd-1080p-wallpapers-desktop-backgrounds-hd.jpg', '2021-11-11 12:54:06', '2021-11-11 12:54:06'),
(63, 'upload/products/1636635435_wp78987.jpg', '2021-11-11 12:57:15', '2021-11-11 12:57:15'),
(64, 'upload/offers/1636984183_Italian Menu-Family Meals.jpeg', '2021-11-15 13:49:43', '2021-11-15 13:49:43'),
(65, 'upload/banners/1636984255_passport (1).jpeg', '2021-11-15 13:50:55', '2021-11-15 13:50:55'),
(66, 'upload/locations/1636984315_passport (2).jpeg', '2021-11-15 13:51:55', '2021-11-15 13:51:55'),
(67, 'upload/places/icons/1636984416_Italian Menu-Family Meals.jpeg', '2021-11-15 13:53:36', '2021-11-15 13:53:36'),
(68, 'upload/places/1636984422_passport (2).jpeg', '2021-11-15 13:53:42', '2021-11-15 13:53:42'),
(69, 'upload/places/multiple/1636984426_WhatsApp Image 2021-05-29 at 1.50.48 PM (1).jpeg', '2021-11-15 13:53:46', '2021-11-15 13:53:46'),
(70, 'upload/products/1636984817_WhatsApp Image 2021-05-29 at 1.50.48 PM (1).jpeg', '2021-11-15 14:00:17', '2021-11-15 14:00:17'),
(71, 'upload/passport/1636984925_WhatsApp Image 2021-05-29 at 1.50.48 PM (1).jpeg', '2021-11-15 14:02:05', '2021-11-15 14:02:05'),
(72, 'upload/products/1637043693_favicon.png', '2021-11-16 06:21:33', '2021-11-16 06:21:33'),
(73, 'upload/locations/1637043739_favicon.png', '2021-11-16 06:22:19', '2021-11-16 06:22:19'),
(74, 'upload/locations/1637043770_favicon.png', '2021-11-16 06:22:50', '2021-11-16 06:22:50'),
(75, 'upload/passport/1637044424_favicon.png', '2021-11-16 06:33:44', '2021-11-16 06:33:44'),
(76, 'upload/products/1637058985_favicon.png', '2021-11-16 10:36:25', '2021-11-16 10:36:25'),
(77, 'upload/passport/1637059043_favicon.png', '2021-11-16 10:37:23', '2021-11-16 10:37:23'),
(78, 'upload/passport/1637062191_favicon.png', '2021-11-16 11:29:51', '2021-11-16 11:29:51'),
(79, 'upload/passport/1637062285_favicon.png', '2021-11-16 11:31:25', '2021-11-16 11:31:25'),
(80, 'upload/offers/1638015816_this week (1).jpeg', '2021-11-27 12:23:36', '2021-11-27 12:23:36'),
(81, 'upload/products/1638974439_dtModel03.jpg', '2021-12-08 14:40:39', '2021-12-08 14:40:39'),
(82, 'upload/passport/1639068694_E5woKdEWQAIqZET.jpg', '2021-12-09 16:51:34', '2021-12-09 16:51:34'),
(83, 'upload/passport/1639068704_nature-hd-for-pc-download-1920x1080-wallpaper-preview.jpg', '2021-12-09 16:51:44', '2021-12-09 16:51:44'),
(84, 'upload/banners/1639120220_nature-hd-for-pc-download-1920x1080-wallpaper-preview.jpg', '2021-12-10 07:10:20', '2021-12-10 07:10:20'),
(85, 'upload/banners/1639120235_wp78987.jpg', '2021-12-10 07:10:35', '2021-12-10 07:10:35'),
(86, 'upload/passport/1639122027_Shiva-Wallpaper-Golden-Morning.jpg', '2021-12-10 07:40:27', '2021-12-10 07:40:27'),
(87, 'upload/passport/1639124296_nature-hd-for-pc-download-1920x1080-wallpaper-preview.jpg', '2021-12-10 08:18:16', '2021-12-10 08:18:16'),
(88, 'upload/places/1639836964_Desert.jpg', '2021-12-18 14:16:04', '2021-12-18 14:16:04'),
(89, 'upload/places/1639837001_1634713242_1.jpg', '2021-12-18 14:16:41', '2021-12-18 14:16:41'),
(90, 'upload/locations/1639994279_1634713424_icon1.png', '2021-12-20 09:57:59', '2021-12-20 09:57:59'),
(91, 'upload/locations/1639994295_1634713424_icon1.png', '2021-12-20 09:58:15', '2021-12-20 09:58:15'),
(92, 'upload/places/icons/1639994645_1634716048_icon1.png', '2021-12-20 10:04:05', '2021-12-20 10:04:05'),
(93, 'upload/places/1639994677_0005.jpg', '2021-12-20 10:04:37', '2021-12-20 10:04:37'),
(94, 'upload/places/multiple/1639994687_0002.jpg', '2021-12-20 10:04:47', '2021-12-20 10:04:47'),
(95, 'upload/places/multiple/1639994687_0003.jpg', '2021-12-20 10:04:47', '2021-12-20 10:04:47'),
(96, 'upload/places/multiple/1639994687_0004.jpg', '2021-12-20 10:04:47', '2021-12-20 10:04:47'),
(97, 'upload/places/multiple/1639994687_0005.jpg', '2021-12-20 10:04:47', '2021-12-20 10:04:47'),
(98, 'upload/places/multiple/1639994687_0006.jpg', '2021-12-20 10:04:47', '2021-12-20 10:04:47'),
(99, 'upload/places/icons/1639994970_1634716048_icon1.png', '2021-12-20 10:09:30', '2021-12-20 10:09:30'),
(100, 'upload/places/1639995075_0007.webp', '2021-12-20 10:11:15', '2021-12-20 10:11:15'),
(101, 'upload/places/multiple/1639995084_0001.jpg', '2021-12-20 10:11:24', '2021-12-20 10:11:24'),
(102, 'upload/places/multiple/1639995084_0002.jpg', '2021-12-20 10:11:24', '2021-12-20 10:11:24'),
(103, 'upload/places/multiple/1639995084_0003.jpg', '2021-12-20 10:11:24', '2021-12-20 10:11:24'),
(104, 'upload/places/multiple/1639995084_0004.jpg', '2021-12-20 10:11:24', '2021-12-20 10:11:24'),
(105, 'upload/places/multiple/1639995084_0005.jpg', '2021-12-20 10:11:24', '2021-12-20 10:11:24'),
(106, 'upload/places/multiple/1639995084_0006.jpg', '2021-12-20 10:11:24', '2021-12-20 10:11:24'),
(107, 'upload/places/multiple/1639997700_4X3A2720.JPG', '2021-12-20 10:55:00', '2021-12-20 10:55:00'),
(108, 'upload/places/multiple/1639997721_4X3A2722.JPG', '2021-12-20 10:55:21', '2021-12-20 10:55:21'),
(109, 'upload/places/multiple/1639997721_4X3A2715.JPG', '2021-12-20 10:55:21', '2021-12-20 10:55:21'),
(110, 'upload/places/1640003482_1634716048_icon1.png', '2021-12-20 12:31:22', '2021-12-20 12:31:22'),
(111, 'upload/places/multiple/1640003591_4X3A2735.JPG', '2021-12-20 12:33:11', '2021-12-20 12:33:11'),
(112, 'upload/places/multiple/1640003591_4X3A2733.JPG', '2021-12-20 12:33:11', '2021-12-20 12:33:11'),
(113, 'upload/places/multiple/1640003591_4X3A2715.JPG', '2021-12-20 12:33:11', '2021-12-20 12:33:11'),
(114, 'upload/places/multiple/1640003591_4X3A2722.JPG', '2021-12-20 12:33:11', '2021-12-20 12:33:11'),
(115, 'upload/places/multiple/1640003591_4X3A2631.JPG', '2021-12-20 12:33:11', '2021-12-20 12:33:11'),
(116, 'upload/places/multiple/1640003591_4X3A2633.JPG', '2021-12-20 12:33:11', '2021-12-20 12:33:11'),
(117, 'upload/places/multiple/1640003591_4X3A2635.JPG', '2021-12-20 12:33:11', '2021-12-20 12:33:11'),
(118, 'upload/places/multiple/1640003591_4X3A2692.JPG', '2021-12-20 12:33:11', '2021-12-20 12:33:11'),
(119, 'upload/places/icons/1640003736_1634716048_icon1.png', '2021-12-20 12:35:36', '2021-12-20 12:35:36'),
(120, 'upload/places/icons/1640003943_4X3A26923.jpg', '2021-12-20 12:39:03', '2021-12-20 12:39:03'),
(121, 'upload/products/1640074439_1634725810_img1.png', '2021-12-21 08:13:59', '2021-12-21 08:13:59'),
(122, 'upload/products/1640074511_1634725810_img1.png', '2021-12-21 08:15:11', '2021-12-21 08:15:11'),
(123, 'upload/products/1640074576_1634725810_img1.png', '2021-12-21 08:16:16', '2021-12-21 08:16:16'),
(124, 'upload/products/1640074992_1634725810_img1.png', '2021-12-21 08:23:12', '2021-12-21 08:23:12'),
(125, 'upload/products/1640075108_1634725810_img1.png', '2021-12-21 08:25:08', '2021-12-21 08:25:08'),
(126, 'upload/products/1640075225_1634725810_img1.png', '2021-12-21 08:27:05', '2021-12-21 08:27:05'),
(127, 'upload/products/1640075268_1640074439_1634725810_img1.png', '2021-12-21 08:27:48', '2021-12-21 08:27:48'),
(128, 'upload/products/1640075402_1634725810_img1.png', '2021-12-21 08:30:02', '2021-12-21 08:30:02'),
(129, 'upload/products/1640075530_1640074439_1634725810_img1.png', '2021-12-21 08:32:10', '2021-12-21 08:32:10'),
(130, 'upload/products/1640075535_1634725810_img1.png', '2021-12-21 08:32:15', '2021-12-21 08:32:15'),
(131, 'upload/products/1640075598_1640074439_1634725810_img1.png', '2021-12-21 08:33:18', '2021-12-21 08:33:18'),
(132, 'upload/products/1640075647_1640074439_1634725810_img1.png', '2021-12-21 08:34:07', '2021-12-21 08:34:07'),
(133, 'upload/products/1640075650_1634725810_img1.png', '2021-12-21 08:34:10', '2021-12-21 08:34:10'),
(134, 'upload/products/1640075689_1640074439_1634725810_img1.png', '2021-12-21 08:34:49', '2021-12-21 08:34:49'),
(135, 'upload/products/1640075745_1640074439_1634725810_img1.png', '2021-12-21 08:35:45', '2021-12-21 08:35:45'),
(136, 'upload/products/1640075785_1634725810_img1.png', '2021-12-21 08:36:25', '2021-12-21 08:36:25'),
(137, 'upload/products/1640075864_1640074439_1634725810_img1.png', '2021-12-21 08:37:44', '2021-12-21 08:37:44'),
(138, 'upload/products/1640075919_1634725810_img1.png', '2021-12-21 08:38:39', '2021-12-21 08:38:39'),
(139, 'upload/products/1640076047_1634725810_img1.png', '2021-12-21 08:40:47', '2021-12-21 08:40:47'),
(140, 'upload/products/1640076053_1640074439_1634725810_img1.png', '2021-12-21 08:40:53', '2021-12-21 08:40:53'),
(141, 'upload/products/1640076097_1640074439_1634725810_img1.png', '2021-12-21 08:41:37', '2021-12-21 08:41:37'),
(142, 'upload/products/1640076168_1640074439_1634725810_img1.png', '2021-12-21 08:42:48', '2021-12-21 08:42:48'),
(143, 'upload/products/1640076190_1634725810_img1.png', '2021-12-21 08:43:10', '2021-12-21 08:43:10'),
(144, 'upload/products/1640076217_1640074439_1634725810_img1.png', '2021-12-21 08:43:37', '2021-12-21 08:43:37'),
(145, 'upload/products/1640076271_1640074439_1634725810_img1.png', '2021-12-21 08:44:31', '2021-12-21 08:44:31'),
(146, 'upload/products/1640076366_1640074439_1634725810_img1.png', '2021-12-21 08:46:06', '2021-12-21 08:46:06'),
(147, 'upload/products/1640076417_1640074439_1634725810_img1.png', '2021-12-21 08:46:57', '2021-12-21 08:46:57'),
(148, 'upload/products/1640076462_1640074439_1634725810_img1.png', '2021-12-21 08:47:42', '2021-12-21 08:47:42'),
(149, 'upload/products/1640076514_1640074439_1634725810_img1.png', '2021-12-21 08:48:34', '2021-12-21 08:48:34'),
(150, 'upload/products/1640076574_1640074439_1634725810_img1.png', '2021-12-21 08:49:34', '2021-12-21 08:49:34'),
(151, 'upload/products/1640076622_1640074439_1634725810_img1.png', '2021-12-21 08:50:22', '2021-12-21 08:50:22'),
(152, 'upload/products/1640076669_1640074439_1634725810_img1.png', '2021-12-21 08:51:09', '2021-12-21 08:51:09'),
(153, 'upload/products/1640076716_1640074439_1634725810_img1.png', '2021-12-21 08:51:56', '2021-12-21 08:51:56'),
(154, 'upload/products/1640076768_1640074439_1634725810_img1.png', '2021-12-21 08:52:48', '2021-12-21 08:52:48'),
(155, 'upload/products/1640076819_1640074439_1634725810_img1.png', '2021-12-21 08:53:39', '2021-12-21 08:53:39'),
(156, 'upload/products/1640076868_1640074439_1634725810_img1.png', '2021-12-21 08:54:28', '2021-12-21 08:54:28'),
(157, 'upload/products/1640076921_1640074439_1634725810_img1.png', '2021-12-21 08:55:21', '2021-12-21 08:55:21'),
(158, 'upload/products/1640076961_1640074439_1634725810_img1.png', '2021-12-21 08:56:01', '2021-12-21 08:56:01'),
(159, 'upload/products/1640077011_1640074439_1634725810_img1.png', '2021-12-21 08:56:51', '2021-12-21 08:56:51'),
(160, 'upload/products/1640077076_1640074439_1634725810_img1.png', '2021-12-21 08:57:56', '2021-12-21 08:57:56'),
(161, 'upload/products/1640077124_1640074439_1634725810_img1.png', '2021-12-21 08:58:44', '2021-12-21 08:58:44'),
(162, 'upload/products/1640077196_1640074439_1634725810_img1.png', '2021-12-21 08:59:56', '2021-12-21 08:59:56'),
(163, 'upload/products/1640077304_1640074439_1634725810_img1.png', '2021-12-21 09:01:44', '2021-12-21 09:01:44'),
(164, 'upload/products/1640077369_1640074439_1634725810_img1.png', '2021-12-21 09:02:49', '2021-12-21 09:02:49'),
(165, 'upload/products/1640077458_1640074439_1634725810_img1.png', '2021-12-21 09:04:18', '2021-12-21 09:04:18'),
(166, 'upload/products/1640077551_1634725810_img1.png', '2021-12-21 09:05:51', '2021-12-21 09:05:51'),
(167, 'upload/products/1640077554_1640074439_1634725810_img1.png', '2021-12-21 09:05:54', '2021-12-21 09:05:54'),
(168, 'upload/products/1640077628_1640074439_1634725810_img1.png', '2021-12-21 09:07:08', '2021-12-21 09:07:08'),
(169, 'upload/products/1640077673_1634725810_img1.png', '2021-12-21 09:07:53', '2021-12-21 09:07:53'),
(170, 'upload/products/1640077696_1640074439_1634725810_img1.png', '2021-12-21 09:08:16', '2021-12-21 09:08:16'),
(171, 'upload/products/1640077780_1640074439_1634725810_img1.png', '2021-12-21 09:09:40', '2021-12-21 09:09:40'),
(172, 'upload/products/1640077781_1634725810_img1.png', '2021-12-21 09:09:41', '2021-12-21 09:09:41'),
(173, 'upload/products/1640077837_1640074439_1634725810_img1.png', '2021-12-21 09:10:37', '2021-12-21 09:10:37'),
(174, 'upload/products/1640077881_1634725810_img1.png', '2021-12-21 09:11:21', '2021-12-21 09:11:21'),
(175, 'upload/products/1640077914_1640074439_1634725810_img1.png', '2021-12-21 09:11:54', '2021-12-21 09:11:54'),
(176, 'upload/products/1640077978_1634725810_img1.png', '2021-12-21 09:12:58', '2021-12-21 09:12:58'),
(177, 'upload/products/1640077983_1640074439_1634725810_img1.png', '2021-12-21 09:13:03', '2021-12-21 09:13:03'),
(178, 'upload/products/1640078077_1634725810_img1.png', '2021-12-21 09:14:37', '2021-12-21 09:14:37'),
(179, 'upload/products/1640078167_1640074439_1634725810_img1.png', '2021-12-21 09:16:07', '2021-12-21 09:16:07'),
(180, 'upload/products/1640078234_1640074439_1634725810_img1.png', '2021-12-21 09:17:14', '2021-12-21 09:17:14'),
(181, 'upload/products/1640078263_1634725810_img1.png', '2021-12-21 09:17:43', '2021-12-21 09:17:43'),
(182, 'upload/products/1640078330_1640074439_1634725810_img1.png', '2021-12-21 09:18:50', '2021-12-21 09:18:50'),
(183, 'upload/products/1640078374_1634725810_img1.png', '2021-12-21 09:19:34', '2021-12-21 09:19:34'),
(184, 'upload/products/1640078418_1640074439_1634725810_img1.png', '2021-12-21 09:20:18', '2021-12-21 09:20:18'),
(185, 'upload/products/1640078522_1634725810_img1.png', '2021-12-21 09:22:02', '2021-12-21 09:22:02'),
(186, 'upload/products/1640078529_1640074439_1634725810_img1.png', '2021-12-21 09:22:09', '2021-12-21 09:22:09'),
(187, 'upload/products/1640078648_1634725810_img1.png', '2021-12-21 09:24:08', '2021-12-21 09:24:08'),
(188, 'upload/products/1640078734_1640074439_1634725810_img1.png', '2021-12-21 09:25:34', '2021-12-21 09:25:34'),
(189, 'upload/products/1640078852_1634725810_img1.png', '2021-12-21 09:27:32', '2021-12-21 09:27:32'),
(190, 'upload/products/1640078892_1640074439_1634725810_img1.png', '2021-12-21 09:28:12', '2021-12-21 09:28:12'),
(191, 'upload/products/1640078944_1634725810_img1.png', '2021-12-21 09:29:04', '2021-12-21 09:29:04'),
(192, 'upload/products/1640078957_1640074439_1634725810_img1.png', '2021-12-21 09:29:17', '2021-12-21 09:29:17'),
(193, 'upload/products/1640079006_1640074439_1634725810_img1.png', '2021-12-21 09:30:06', '2021-12-21 09:30:06'),
(194, 'upload/products/1640079100_1640074439_1634725810_img1.png', '2021-12-21 09:31:40', '2021-12-21 09:31:40'),
(195, 'upload/products/1640079129_1634725810_img1.png', '2021-12-21 09:32:09', '2021-12-21 09:32:09'),
(196, 'upload/products/1640079173_1640074439_1634725810_img1.png', '2021-12-21 09:32:53', '2021-12-21 09:32:53'),
(197, 'upload/products/1640079252_1640074439_1634725810_img1.png', '2021-12-21 09:34:12', '2021-12-21 09:34:12'),
(198, 'upload/products/1640079308_1634725810_img1.png', '2021-12-21 09:35:08', '2021-12-21 09:35:08'),
(199, 'upload/products/1640079329_1640074439_1634725810_img1.png', '2021-12-21 09:35:29', '2021-12-21 09:35:29'),
(200, 'upload/products/1640079411_1640074439_1634725810_img1.png', '2021-12-21 09:36:51', '2021-12-21 09:36:51'),
(201, 'upload/products/1640079414_1634725810_img1.png', '2021-12-21 09:36:54', '2021-12-21 09:36:54'),
(202, 'upload/products/1640079505_1634725810_img1.png', '2021-12-21 09:38:25', '2021-12-21 09:38:25'),
(203, 'upload/products/1640079549_1640074439_1634725810_img1.png', '2021-12-21 09:39:09', '2021-12-21 09:39:09'),
(204, 'upload/products/1640079612_1634725810_img1.png', '2021-12-21 09:40:12', '2021-12-21 09:40:12'),
(205, 'upload/products/1640079645_1640074439_1634725810_img1.png', '2021-12-21 09:40:45', '2021-12-21 09:40:45'),
(206, 'upload/products/1640079716_1640074439_1634725810_img1.png', '2021-12-21 09:41:56', '2021-12-21 09:41:56'),
(207, 'upload/products/1640079747_1634725810_img1.png', '2021-12-21 09:42:27', '2021-12-21 09:42:27'),
(208, 'upload/products/1640079804_1640074439_1634725810_img1.png', '2021-12-21 09:43:24', '2021-12-21 09:43:24'),
(209, 'upload/products/1640079862_1640074439_1634725810_img1.png', '2021-12-21 09:44:22', '2021-12-21 09:44:22'),
(210, 'upload/products/1640079909_1640074439_1634725810_img1.png', '2021-12-21 09:45:09', '2021-12-21 09:45:09'),
(211, 'upload/products/1640079927_1634725810_img1.png', '2021-12-21 09:45:27', '2021-12-21 09:45:27'),
(212, 'upload/products/1640079977_1640074439_1634725810_img1.png', '2021-12-21 09:46:17', '2021-12-21 09:46:17'),
(213, 'upload/products/1640080055_1634725810_img1.png', '2021-12-21 09:47:35', '2021-12-21 09:47:35'),
(214, 'upload/products/1640080072_1640074439_1634725810_img1.png', '2021-12-21 09:47:52', '2021-12-21 09:47:52'),
(215, 'upload/products/1640080117_1640074439_1634725810_img1.png', '2021-12-21 09:48:37', '2021-12-21 09:48:37'),
(216, 'upload/products/1640080171_1640074439_1634725810_img1.png', '2021-12-21 09:49:31', '2021-12-21 09:49:31'),
(217, 'upload/products/1640080178_1634725810_img1.png', '2021-12-21 09:49:38', '2021-12-21 09:49:38'),
(218, 'upload/products/1640080226_1640074439_1634725810_img1.png', '2021-12-21 09:50:26', '2021-12-21 09:50:26'),
(219, 'upload/products/1640080262_1634725810_img1.png', '2021-12-21 09:51:02', '2021-12-21 09:51:02'),
(220, 'upload/products/1640080279_1640074439_1634725810_img1.png', '2021-12-21 09:51:19', '2021-12-21 09:51:19'),
(221, 'upload/products/1640080332_1640074439_1634725810_img1.png', '2021-12-21 09:52:12', '2021-12-21 09:52:12'),
(222, 'upload/products/1640080370_1634725810_img1.png', '2021-12-21 09:52:50', '2021-12-21 09:52:50'),
(223, 'upload/products/1640080399_1640074439_1634725810_img1.png', '2021-12-21 09:53:19', '2021-12-21 09:53:19'),
(224, 'upload/products/1640080462_1640074439_1634725810_img1.png', '2021-12-21 09:54:22', '2021-12-21 09:54:22'),
(225, 'upload/products/1640080474_1634725810_img1.png', '2021-12-21 09:54:34', '2021-12-21 09:54:34'),
(226, 'upload/products/1640080548_1640074439_1634725810_img1.png', '2021-12-21 09:55:48', '2021-12-21 09:55:48'),
(227, 'upload/products/1640080608_1640074439_1634725810_img1.png', '2021-12-21 09:56:48', '2021-12-21 09:56:48'),
(228, 'upload/products/1640080615_1634725810_img1.png', '2021-12-21 09:56:55', '2021-12-21 09:56:55'),
(229, 'upload/products/1640080676_1640074439_1634725810_img1.png', '2021-12-21 09:57:56', '2021-12-21 09:57:56'),
(230, 'upload/products/1640080726_1640074439_1634725810_img1.png', '2021-12-21 09:58:46', '2021-12-21 09:58:46'),
(231, 'upload/products/1640080727_1634725810_img1.png', '2021-12-21 09:58:47', '2021-12-21 09:58:47'),
(232, 'upload/products/1640080770_1640074439_1634725810_img1.png', '2021-12-21 09:59:30', '2021-12-21 09:59:30'),
(233, 'upload/products/1640080802_1640074439_1634725810_img1.png', '2021-12-21 10:00:02', '2021-12-21 10:00:02'),
(234, 'upload/products/1640080836_1640074439_1634725810_img1.png', '2021-12-21 10:00:36', '2021-12-21 10:00:36'),
(235, 'upload/products/1640080840_1634725810_img1.png', '2021-12-21 10:00:40', '2021-12-21 10:00:40'),
(236, 'upload/products/1640080870_1640074439_1634725810_img1.png', '2021-12-21 10:01:10', '2021-12-21 10:01:10'),
(237, 'upload/products/1640080964_1634725810_img1.png', '2021-12-21 10:02:44', '2021-12-21 10:02:44'),
(238, 'upload/products/1640081203_1634725810_img1.png', '2021-12-21 10:06:43', '2021-12-21 10:06:43'),
(239, 'upload/products/1640081289_1634725810_img1.png', '2021-12-21 10:08:09', '2021-12-21 10:08:09'),
(240, 'upload/products/1640081450_1634725810_img1.png', '2021-12-21 10:10:50', '2021-12-21 10:10:50'),
(241, 'upload/products/1640081547_1634725810_img1.png', '2021-12-21 10:12:27', '2021-12-21 10:12:27'),
(242, 'upload/products/1640081771_1634725810_img1.png', '2021-12-21 10:16:11', '2021-12-21 10:16:11'),
(243, 'upload/products/1640081859_1634725810_img1.png', '2021-12-21 10:17:39', '2021-12-21 10:17:39'),
(244, 'upload/products/1640081963_1634725810_img1.png', '2021-12-21 10:19:23', '2021-12-21 10:19:23'),
(245, 'upload/products/1640082048_1634725810_img1.png', '2021-12-21 10:20:48', '2021-12-21 10:20:48'),
(246, 'upload/products/1640082141_1634725810_img1.png', '2021-12-21 10:22:21', '2021-12-21 10:22:21'),
(247, 'upload/products/1640082433_1634725810_img1.png', '2021-12-21 10:27:13', '2021-12-21 10:27:13'),
(248, 'upload/products/1640082517_1634725810_img1.png', '2021-12-21 10:28:37', '2021-12-21 10:28:37'),
(249, 'upload/products/1640082639_1634725810_img1.png', '2021-12-21 10:30:39', '2021-12-21 10:30:39'),
(250, 'upload/products/1640083024_1634725810_img1.png', '2021-12-21 10:37:04', '2021-12-21 10:37:04'),
(251, 'upload/products/1640083247_1634725810_img1.png', '2021-12-21 10:40:47', '2021-12-21 10:40:47'),
(252, 'upload/products/1640083345_1634725810_img1.png', '2021-12-21 10:42:25', '2021-12-21 10:42:25'),
(253, 'upload/products/1640083427_1634725810_img1.png', '2021-12-21 10:43:47', '2021-12-21 10:43:47'),
(254, 'upload/products/1640083540_1634725810_img1.png', '2021-12-21 10:45:40', '2021-12-21 10:45:40'),
(255, 'upload/products/1640083658_1634725810_img1.png', '2021-12-21 10:47:38', '2021-12-21 10:47:38'),
(256, 'upload/products/1640083772_1634725810_img1.png', '2021-12-21 10:49:32', '2021-12-21 10:49:32'),
(257, 'upload/products/1640083875_1634725810_img1.png', '2021-12-21 10:51:15', '2021-12-21 10:51:15'),
(258, 'upload/products/1640083989_1634725810_img1.png', '2021-12-21 10:53:09', '2021-12-21 10:53:09'),
(259, 'upload/products/1640084125_1634725810_img1.png', '2021-12-21 10:55:25', '2021-12-21 10:55:25'),
(260, 'upload/products/1640084269_1634725810_img1.png', '2021-12-21 10:57:49', '2021-12-21 10:57:49'),
(261, 'upload/products/1640084676_1634725810_img1.png', '2021-12-21 11:04:36', '2021-12-21 11:04:36'),
(262, 'upload/products/1640084765_1634725810_img1.png', '2021-12-21 11:06:05', '2021-12-21 11:06:05'),
(263, 'upload/products/1640084840_1634725810_img1.png', '2021-12-21 11:07:20', '2021-12-21 11:07:20'),
(264, 'upload/products/1640084920_1634725810_img1.png', '2021-12-21 11:08:40', '2021-12-21 11:08:40'),
(265, 'upload/products/1640084985_1634725810_img1.png', '2021-12-21 11:09:45', '2021-12-21 11:09:45'),
(266, 'upload/products/1640085066_1634725810_img1.png', '2021-12-21 11:11:06', '2021-12-21 11:11:06'),
(267, 'upload/products/1640085123_1634725810_img1.png', '2021-12-21 11:12:03', '2021-12-21 11:12:03'),
(268, 'upload/products/1640085343_1634725810_img1.png', '2021-12-21 11:15:43', '2021-12-21 11:15:43'),
(269, 'upload/products/1640085446_1634725810_img1.png', '2021-12-21 11:17:26', '2021-12-21 11:17:26'),
(270, 'upload/products/1640085574_1634725810_img1.png', '2021-12-21 11:19:34', '2021-12-21 11:19:34'),
(271, 'upload/products/1640085758_1634725810_img1.png', '2021-12-21 11:22:38', '2021-12-21 11:22:38'),
(272, 'upload/products/1640086935_Killer_kadhai_paneer_bento_box_finch_2.jpg', '2021-12-21 11:42:15', '2021-12-21 11:42:15'),
(273, 'upload/products/1640088281_delhi_6_famous_chicken_curry_bento_box.jpg', '2021-12-21 12:04:41', '2021-12-21 12:04:41'),
(274, 'upload/products/1640092471_Apple Cider.png', '2021-12-21 13:14:31', '2021-12-21 13:14:31'),
(275, 'upload/products/1640092499_1634725810_img1.png', '2021-12-21 13:14:59', '2021-12-21 13:14:59'),
(276, 'upload/products/1640092774_Belgian wit.png', '2021-12-21 13:19:34', '2021-12-21 13:19:34'),
(277, 'upload/products/1640092887_Apple Cider.png', '2021-12-21 13:21:27', '2021-12-21 13:21:27'),
(278, 'upload/products/1640093150_Hefeweizen.png', '2021-12-21 13:25:50', '2021-12-21 13:25:50'),
(279, 'upload/products/1640093336_Cloud Black.png', '2021-12-21 13:28:56', '2021-12-21 13:28:56'),
(280, 'upload/products/1640093554_IPA.png', '2021-12-21 13:32:34', '2021-12-21 13:32:34'),
(281, 'upload/places/1640093597_1634715943_2.jpg', '2021-12-21 13:33:17', '2021-12-21 13:33:17'),
(282, 'upload/products/1640093721_Lager.png', '2021-12-21 13:35:21', '2021-12-21 13:35:21'),
(283, 'upload/products/1640162138_1.png', '2021-12-22 08:35:38', '2021-12-22 08:35:38'),
(284, 'upload/products/1640167337_4.png', '2021-12-22 10:02:17', '2021-12-22 10:02:17'),
(285, 'upload/places/icons/1640173801_1640003591_4X3A2692.jpg', '2021-12-22 11:50:01', '2021-12-22 11:50:01'),
(286, 'upload/places/1640173820_powai_rest.png', '2021-12-22 11:50:20', '2021-12-22 11:50:20'),
(287, 'upload/offers/1640174674_WhatsApp Image 2021-12-21 at 7.15.23 PM.jpeg', '2021-12-22 12:04:34', '2021-12-22 12:04:34'),
(288, 'upload/offers/1640174693_WhatsApp Image 2021-12-21 at 7.13.59 PM (1).jpeg', '2021-12-22 12:04:53', '2021-12-22 12:04:53'),
(289, 'upload/offers/1640174709_WhatsApp Image 2021-12-21 at 7.14.28 PM.jpeg', '2021-12-22 12:05:09', '2021-12-22 12:05:09'),
(290, 'upload/offers/1640174723_WhatsApp Image 2021-12-21 at 7.15.00 PM.jpeg', '2021-12-22 12:05:23', '2021-12-22 12:05:23'),
(291, 'upload/locations/1640175226_amritsar.png', '2021-12-22 12:13:46', '2021-12-22 12:13:46'),
(292, 'upload/locations/1640175246_banglore.png', '2021-12-22 12:14:06', '2021-12-22 12:14:06'),
(293, 'upload/locations/1640175316_chandigarh.png', '2021-12-22 12:15:16', '2021-12-22 12:15:16'),
(294, 'upload/locations/1640175341_mumbai.png', '2021-12-22 12:15:41', '2021-12-22 12:15:41'),
(295, 'upload/locations/1640175372_pune.png', '2021-12-22 12:16:12', '2021-12-22 12:16:12'),
(296, 'upload/products/1640175818_5.png', '2021-12-22 12:23:38', '2021-12-22 12:23:38'),
(297, 'upload/products/1640176147_4.png', '2021-12-22 12:29:07', '2021-12-22 12:29:07'),
(298, 'upload/products/1640176176_3.png', '2021-12-22 12:29:36', '2021-12-22 12:29:36'),
(299, 'upload/products/1640176363_6.png', '2021-12-22 12:32:43', '2021-12-22 12:32:43'),
(300, 'upload/products/1640176388_1.png', '2021-12-22 12:33:08', '2021-12-22 12:33:08'),
(301, 'upload/products/1640176411_2.png', '2021-12-22 12:33:31', '2021-12-22 12:33:31'),
(302, 'upload/products/1640176684_layer4-4.png', '2021-12-22 12:38:04', '2021-12-22 12:38:04'),
(303, 'upload/places/multiple/1640245218_5E0A7358.JPG', '2021-12-23 07:40:18', '2021-12-23 07:40:18'),
(304, 'upload/places/multiple/1640245228_00000553.jpg', '2021-12-23 07:40:28', '2021-12-23 07:40:28'),
(305, 'upload/places/multiple/1640245228_00000560.jpg', '2021-12-23 07:40:28', '2021-12-23 07:40:28'),
(306, 'upload/places/multiple/1640245228_00000560-1.jpg', '2021-12-23 07:40:28', '2021-12-23 07:40:28'),
(307, 'upload/places/multiple/1640245228_00000566.jpg', '2021-12-23 07:40:28', '2021-12-23 07:40:28'),
(308, 'upload/places/multiple/1640245247_00000570.jpg', '2021-12-23 07:40:47', '2021-12-23 07:40:47'),
(309, 'upload/places/multiple/1640245248_00000574.jpg', '2021-12-23 07:40:48', '2021-12-23 07:40:48'),
(310, 'upload/places/multiple/1640245248_00000576.jpg', '2021-12-23 07:40:48', '2021-12-23 07:40:48'),
(311, 'upload/places/multiple/1640245248_00000580.jpg', '2021-12-23 07:40:48', '2021-12-23 07:40:48'),
(312, 'upload/places/multiple/1640245248_00000607.jpg', '2021-12-23 07:40:48', '2021-12-23 07:40:48'),
(313, 'upload/places/multiple/1640245248_00000613.jpg', '2021-12-23 07:40:48', '2021-12-23 07:40:48'),
(314, 'upload/places/multiple/1640245312_00000618.jpg', '2021-12-23 07:41:52', '2021-12-23 07:41:52'),
(315, 'upload/places/multiple/1640245312_00000628.jpg', '2021-12-23 07:41:52', '2021-12-23 07:41:52'),
(316, 'upload/places/multiple/1640245312_00000631.jpg', '2021-12-23 07:41:52', '2021-12-23 07:41:52'),
(317, 'upload/places/multiple/1640245312_00000637.jpg', '2021-12-23 07:41:52', '2021-12-23 07:41:52'),
(318, 'upload/places/multiple/1640245312_00000761.jpg', '2021-12-23 07:41:52', '2021-12-23 07:41:52'),
(319, 'upload/places/multiple/1640245372_DSC_1820.jpg', '2021-12-23 07:42:52', '2021-12-23 07:42:52'),
(320, 'upload/places/multiple/1640245372_DSC_1825.jpg', '2021-12-23 07:42:52', '2021-12-23 07:42:52'),
(321, 'upload/places/multiple/1640245372_DSC_1828.jpg', '2021-12-23 07:42:52', '2021-12-23 07:42:52'),
(322, 'upload/places/multiple/1640245372_DSC_1830.jpg', '2021-12-23 07:42:52', '2021-12-23 07:42:52'),
(323, 'upload/places/multiple/1640245372_DSC_1832.jpg', '2021-12-23 07:42:52', '2021-12-23 07:42:52'),
(324, 'upload/places/multiple/1640245372_DSC_1838.jpg', '2021-12-23 07:42:52', '2021-12-23 07:42:52'),
(325, 'upload/places/multiple/1640245387_DSC_1843.jpg', '2021-12-23 07:43:07', '2021-12-23 07:43:07'),
(326, 'upload/places/multiple/1640245387_DSC_1845.jpg', '2021-12-23 07:43:07', '2021-12-23 07:43:07'),
(327, 'upload/places/multiple/1640245387_DSC_1852.jpg', '2021-12-23 07:43:07', '2021-12-23 07:43:07'),
(328, 'upload/places/multiple/1640245387_DSC_1856.jpg', '2021-12-23 07:43:07', '2021-12-23 07:43:07'),
(329, 'upload/places/multiple/1640245387_DSC_1857.jpg', '2021-12-23 07:43:07', '2021-12-23 07:43:07'),
(330, 'upload/places/multiple/1640245387_DSC_1862.jpg', '2021-12-23 07:43:07', '2021-12-23 07:43:07'),
(331, 'upload/places/multiple/1640245409_DSC_1863.jpg', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(332, 'upload/places/multiple/1640245409_DSC_1867.jpg', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(333, 'upload/places/multiple/1640245409_DSC_1868.jpg', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(334, 'upload/places/multiple/1640245409_DSC_1875.jpg', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(335, 'upload/places/multiple/1640245409_DSC_1878.jpg', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(336, 'upload/places/multiple/1640245409_DSC_1882.jpg', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(337, 'upload/places/multiple/1640245409_DSC_1884.jpg', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(338, 'upload/places/multiple/1640245409_IMG_0016_3.jpg', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(339, 'upload/places/multiple/1640245409_ZR2A4360.jpg', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(340, 'upload/places/multiple/1640245409_ZR2A4404.jpg', '2021-12-23 07:43:29', '2021-12-23 07:43:29'),
(341, 'upload/places/multiple/1640245899_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0001.jpg', '2021-12-23 07:51:39', '2021-12-23 07:51:39'),
(342, 'upload/places/multiple/1640245899_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0002.jpg', '2021-12-23 07:51:39', '2021-12-23 07:51:39'),
(343, 'upload/places/multiple/1640245899_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0003.jpg', '2021-12-23 07:51:39', '2021-12-23 07:51:39'),
(344, 'upload/places/multiple/1640245899_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0004.jpg', '2021-12-23 07:51:39', '2021-12-23 07:51:39'),
(345, 'upload/places/multiple/1640245899_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0005.jpg', '2021-12-23 07:51:39', '2021-12-23 07:51:39'),
(346, 'upload/places/multiple/1640245899_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0006.jpg', '2021-12-23 07:51:39', '2021-12-23 07:51:39'),
(347, 'upload/places/multiple/1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0001.webp', '2021-12-23 07:53:07', '2021-12-23 07:53:07'),
(348, 'upload/places/multiple/1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0002.jpg', '2021-12-23 07:53:07', '2021-12-23 07:53:07'),
(349, 'upload/places/multiple/1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0003.webp', '2021-12-23 07:53:07', '2021-12-23 07:53:07'),
(350, 'upload/places/multiple/1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0004.webp', '2021-12-23 07:53:07', '2021-12-23 07:53:07'),
(351, 'upload/places/multiple/1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0005.webp', '2021-12-23 07:53:07', '2021-12-23 07:53:07'),
(352, 'upload/places/multiple/1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0006.jpg', '2021-12-23 07:53:07', '2021-12-23 07:53:07'),
(353, 'upload/places/multiple/1640246987_FINAL RENDERS (1)_page-0001.webp', '2021-12-23 08:09:47', '2021-12-23 08:09:47'),
(354, 'upload/places/multiple/1640246987_FINAL RENDERS (1)_page-0002.jpg', '2021-12-23 08:09:47', '2021-12-23 08:09:47'),
(355, 'upload/places/multiple/1640246987_FINAL RENDERS (1)_page-0003.jpg', '2021-12-23 08:09:47', '2021-12-23 08:09:47'),
(356, 'upload/places/multiple/1640246987_FINAL RENDERS (1)_page-0004.jpg', '2021-12-23 08:09:47', '2021-12-23 08:09:47'),
(357, 'upload/places/multiple/1640246987_FINAL RENDERS (1)_page-0005.jpg', '2021-12-23 08:09:47', '2021-12-23 08:09:47'),
(358, 'upload/places/multiple/1640246987_FINAL RENDERS (1)_page-0006.jpg', '2021-12-23 08:09:47', '2021-12-23 08:09:47'),
(359, 'upload/places/multiple/1640246987_FINAL RENDERS (1)_page-0007.jpg', '2021-12-23 08:09:47', '2021-12-23 08:09:47'),
(360, 'upload/products/1640253394_BALINESE CURRY BOWL .jpg', '2021-12-23 09:56:34', '2021-12-23 09:56:34'),
(361, 'upload/products/1640253413_BALINESE CURRY BOWL 1.jpg', '2021-12-23 09:56:53', '2021-12-23 09:56:53'),
(362, 'upload/products/1640253492_BACON MUSHROOM _ RICOTTA OMELETTE 3.jpg', '2021-12-23 09:58:12', '2021-12-23 09:58:12'),
(363, 'upload/products/1640253742_BEETROOT HALWA CANOLI WITH RABRI FOAM 1.jpg', '2021-12-23 10:02:22', '2021-12-23 10:02:22'),
(364, 'upload/products/1640253808_BEETROOT HALWA CANOLI WITH RABRI MOUSSE.jpg', '2021-12-23 10:03:28', '2021-12-23 10:03:28'),
(365, 'upload/products/1640253934_BEETROOT HALWA CANOLI WITH RABRI FOAM 1.jpg', '2021-12-23 10:05:34', '2021-12-23 10:05:34'),
(366, 'upload/products/1640254234_BULGOGI CHICKEN WINGS 1.jpg', '2021-12-23 10:10:34', '2021-12-23 10:10:34'),
(367, 'upload/products/1640254379_BALINESE CURRY BOWL .jpg', '2021-12-23 10:12:59', '2021-12-23 10:12:59'),
(368, 'upload/products/1640254404_BALINESE CURRY BOWL 1.jpg', '2021-12-23 10:13:24', '2021-12-23 10:13:24'),
(369, 'upload/products/1640254476_BALINESE CURRY BOWL .jpg', '2021-12-23 10:14:36', '2021-12-23 10:14:36'),
(370, 'upload/products/1640254500_BALINESE CURRY BOWL 1.jpg', '2021-12-23 10:15:00', '2021-12-23 10:15:00'),
(371, 'upload/products/1640254674_BALINESE CURRY BOWL .jpg', '2021-12-23 10:17:54', '2021-12-23 10:17:54'),
(372, 'upload/products/1640254845_BULLS EYE 1.jpg', '2021-12-23 10:20:45', '2021-12-23 10:20:45'),
(373, 'upload/products/1640254888_BULLS EYE.jpg', '2021-12-23 10:21:28', '2021-12-23 10:21:28'),
(374, 'upload/products/1640254937_BULLS EYE 1.jpg', '2021-12-23 10:22:17', '2021-12-23 10:22:17'),
(375, 'upload/products/1640255256_BUTTER CHICKEN COINS.jpg', '2021-12-23 10:27:36', '2021-12-23 10:27:36'),
(376, 'upload/products/1640255642_CHICKEN IN SMOKED CHILLI SAUCE 2.jpg', '2021-12-23 10:34:02', '2021-12-23 10:34:02'),
(377, 'upload/products/1640255701_CHICKEN IN SMOKED CHILLI SAUCE 3.jpg', '2021-12-23 10:35:01', '2021-12-23 10:35:01'),
(378, 'upload/products/1640255753_chicken in smoked chilli sauce.jpg', '2021-12-23 10:35:53', '2021-12-23 10:35:53'),
(379, 'upload/products/1640255918_CHILLI TERIYAKI CHICKEN.jpg', '2021-12-23 10:38:38', '2021-12-23 10:38:38'),
(380, 'upload/products/1640256320_Dilli 6 famous chicken curry.PNG', '2021-12-23 10:45:20', '2021-12-23 10:45:20'),
(381, 'upload/products/1640256470_Dum Biryani.PNG', '2021-12-23 10:47:50', '2021-12-23 10:47:50'),
(382, 'upload/products/1640256483_Dum Biryani.PNG', '2021-12-23 10:48:03', '2021-12-23 10:48:03'),
(383, 'upload/products/1640256614_EXOTIC VEG AND CHEESE SLIDER 2.jpg', '2021-12-23 10:50:14', '2021-12-23 10:50:14'),
(384, 'upload/products/1640256880_GRILLED CHICKEN WITH LEMON MUSTARD SAUCE 1.jpg', '2021-12-23 10:54:40', '2021-12-23 10:54:40'),
(385, 'upload/products/1640256923_GRILLED CHICKEN WITH LEMON MUSTARD SAUCE.jpg', '2021-12-23 10:55:23', '2021-12-23 10:55:23'),
(386, 'upload/products/1640256968_GRILLED CHICKEN WITH LEMON MUSTARD SAUCE.jpg', '2021-12-23 10:56:08', '2021-12-23 10:56:08'),
(387, 'upload/products/1640257077_HANDCUT FRIES TRUFFLE 1.jpg', '2021-12-23 10:57:57', '2021-12-23 10:57:57'),
(388, 'upload/products/1640257096_HANDCUT FRIES TRUFFLE.jpg', '2021-12-23 10:58:16', '2021-12-23 10:58:16'),
(389, 'upload/products/1640257149_HANDCUT FRIES TRUFFLE 1.jpg', '2021-12-23 10:59:09', '2021-12-23 10:59:09'),
(390, 'upload/products/1640257177_HANDCUT FRIES TRUFFLE.jpg', '2021-12-23 10:59:37', '2021-12-23 10:59:37'),
(391, 'upload/products/1640257242_HANDCUT FRIES TRUFFLE 1.jpg', '2021-12-23 11:00:42', '2021-12-23 11:00:42'),
(392, 'upload/products/1640257259_HANDCUT FRIES TRUFFLE.jpg', '2021-12-23 11:00:59', '2021-12-23 11:00:59'),
(393, 'upload/products/1640257275_HANDCUT FRIES TRUFFLE 1.jpg', '2021-12-23 11:01:15', '2021-12-23 11:01:15'),
(394, 'upload/products/1640257286_HANDCUT FRIES TRUFFLE.jpg', '2021-12-23 11:01:26', '2021-12-23 11:01:26'),
(395, 'upload/products/1640257306_HANDCUT FRIES TRUFFLE 1.jpg', '2021-12-23 11:01:46', '2021-12-23 11:01:46'),
(396, 'upload/products/1640257457_HIPSTER SALAD .jpg', '2021-12-23 11:04:17', '2021-12-23 11:04:17'),
(397, 'upload/products/1640257496_HIPSTER SALAD 1.jpg', '2021-12-23 11:04:56', '2021-12-23 11:04:56'),
(398, 'upload/products/1640257524_HIPSTER SALAD 1.jpg', '2021-12-23 11:05:24', '2021-12-23 11:05:24'),
(399, 'upload/products/1640257539_HIPSTER SALAD .jpg', '2021-12-23 11:05:39', '2021-12-23 11:05:39'),
(400, 'upload/products/1640257570_HIPSTER SALAD 1.jpg', '2021-12-23 11:06:10', '2021-12-23 11:06:10'),
(401, 'upload/products/1640257589_HIPSTER SALAD .jpg', '2021-12-23 11:06:29', '2021-12-23 11:06:29'),
(402, 'upload/products/1640257948_JALAPINOS _CHICKEN SLIDER 1.jpg', '2021-12-23 11:12:28', '2021-12-23 11:12:28'),
(403, 'upload/products/1640258008_Dilli 6 famous chicken curry.PNG', '2021-12-23 11:13:28', '2021-12-23 11:13:28'),
(404, 'upload/products/1640258038_Kadhai Paneer.jpg', '2021-12-23 11:13:58', '2021-12-23 11:13:58'),
(405, 'upload/products/1640258111_Kadhai Paneer.jpg', '2021-12-23 11:15:11', '2021-12-23 11:15:11'),
(406, 'upload/products/1640258233_Kadhai Paneer.jpg', '2021-12-23 11:17:13', '2021-12-23 11:17:13'),
(407, 'upload/products/1640258330_Dilli 6 famous chicken curry.PNG', '2021-12-23 11:18:50', '2021-12-23 11:18:50'),
(408, 'upload/products/1640258437_Penne Arabiatta.PNG', '2021-12-23 11:20:37', '2021-12-23 11:20:37'),
(409, 'upload/products/1640258469_Penne Arabiatta.PNG', '2021-12-23 11:21:09', '2021-12-23 11:21:09'),
(410, 'upload/products/1640258502_Penne Arabiatta.PNG', '2021-12-23 11:21:42', '2021-12-23 11:21:42'),
(411, 'upload/products/1640258599_Pita Hummus.PNG', '2021-12-23 11:23:19', '2021-12-23 11:23:19'),
(412, 'upload/products/1640258682_Pita Hummus.PNG', '2021-12-23 11:24:42', '2021-12-23 11:24:42'),
(413, 'upload/products/1640258706_Pita Hummus.PNG', '2021-12-23 11:25:06', '2021-12-23 11:25:06'),
(414, 'upload/products/1640258858_Pop Star Penne Alfredo.PNG', '2021-12-23 11:27:38', '2021-12-23 11:27:38'),
(415, 'upload/products/1640258894_Pop Star Penne Alfredo.PNG', '2021-12-23 11:28:14', '2021-12-23 11:28:14'),
(416, 'upload/products/1640258914_Pop Star Penne Alfredo.PNG', '2021-12-23 11:28:34', '2021-12-23 11:28:34'),
(417, 'upload/products/1640259150_Singapore Wok tossed chicken.PNG', '2021-12-23 11:32:30', '2021-12-23 11:32:30'),
(418, 'upload/products/1640259334_Thai Chilli Noodle.PNG', '2021-12-23 11:35:34', '2021-12-23 11:35:34'),
(419, 'upload/products/1640259351_Thai Chilli Noodle.PNG', '2021-12-23 11:35:51', '2021-12-23 11:35:51'),
(420, 'upload/products/1640259365_Thai Chilli Noodle.PNG', '2021-12-23 11:36:05', '2021-12-23 11:36:05'),
(421, 'upload/products/1640259388_Thai Chilli Noodle.PNG', '2021-12-23 11:36:28', '2021-12-23 11:36:28'),
(422, 'upload/products/1640259403_Thai Chilli Noodle.PNG', '2021-12-23 11:36:43', '2021-12-23 11:36:43'),
(423, 'upload/products/1640259419_Thai Chilli Noodle.PNG', '2021-12-23 11:36:59', '2021-12-23 11:36:59'),
(424, 'upload/products/1640259449_Thai Chilli Noodle.PNG', '2021-12-23 11:37:29', '2021-12-23 11:37:29'),
(425, 'upload/products/1640259465_Thai Chilli Noodle.PNG', '2021-12-23 11:37:45', '2021-12-23 11:37:45'),
(426, 'upload/products/1640259477_Thai Chilli Noodle.PNG', '2021-12-23 11:37:57', '2021-12-23 11:37:57'),
(427, 'upload/products/1640259690_Turkish Kebab.PNG', '2021-12-23 11:41:30', '2021-12-23 11:41:30'),
(428, 'upload/products/1640259708_Turkish Kebab.PNG', '2021-12-23 11:41:48', '2021-12-23 11:41:48'),
(429, 'upload/products/1640259750_Turkish Kebab.PNG', '2021-12-23 11:42:30', '2021-12-23 11:42:30'),
(430, 'upload/products/1640259828_Turkish Kebab.PNG', '2021-12-23 11:43:48', '2021-12-23 11:43:48'),
(431, 'upload/products/1640259840_Turkish Kebab.PNG', '2021-12-23 11:44:00', '2021-12-23 11:44:00'),
(432, 'upload/products/1640259877_Turkish Kebab.PNG', '2021-12-23 11:44:37', '2021-12-23 11:44:37'),
(433, 'upload/products/1640259969_Vegetable Dum Biryani.PNG', '2021-12-23 11:46:09', '2021-12-23 11:46:09'),
(434, 'upload/products/1640260106_Vegetable Dum Biryani.PNG', '2021-12-23 11:48:26', '2021-12-23 11:48:26'),
(435, 'upload/products/1640260254_Dum Biryani.PNG', '2021-12-23 11:50:54', '2021-12-23 11:50:54'),
(436, 'upload/products/1640260409_Volcano Nachos.PNG', '2021-12-23 11:53:29', '2021-12-23 11:53:29'),
(437, 'upload/products/1640260459_Volcano Nachos.PNG', '2021-12-23 11:54:19', '2021-12-23 11:54:19'),
(438, 'upload/products/1640260471_Volcano Nachos.PNG', '2021-12-23 11:54:31', '2021-12-23 11:54:31'),
(439, 'upload/products/1640260488_Volcano Nachos.PNG', '2021-12-23 11:54:48', '2021-12-23 11:54:48'),
(440, 'upload/products/1640261199_BURRATA  PESTO CROSTINI 1.jpg', '2021-12-23 12:06:39', '2021-12-23 12:06:39'),
(441, 'upload/products/1640261571_FINCH_S SPECIAL INDIAN MASALA 2.jpg', '2021-12-23 12:12:51', '2021-12-23 12:12:51'),
(442, 'upload/products/1640262066_seilankan fiery prawn and panko crusted tempura shrimp.jpg', '2021-12-23 12:21:06', '2021-12-23 12:21:06'),
(443, 'upload/products/1640325525_product.jpg', '2021-12-24 05:58:45', '2021-12-24 05:58:45'),
(444, 'upload/products/1640325554_product.jpg', '2021-12-24 05:59:14', '2021-12-24 05:59:14'),
(445, 'upload/products/1640325585_product.jpg', '2021-12-24 05:59:45', '2021-12-24 05:59:45'),
(446, 'upload/products/1640325598_product.jpg', '2021-12-24 05:59:58', '2021-12-24 05:59:58'),
(447, 'upload/products/1640325609_product.jpg', '2021-12-24 06:00:09', '2021-12-24 06:00:09'),
(448, 'upload/products/1640325620_product.jpg', '2021-12-24 06:00:20', '2021-12-24 06:00:20'),
(449, 'upload/products/1640325631_product.jpg', '2021-12-24 06:00:31', '2021-12-24 06:00:31'),
(450, 'upload/products/1640325645_product.jpg', '2021-12-24 06:00:45', '2021-12-24 06:00:45'),
(451, 'upload/products/1640325657_product.jpg', '2021-12-24 06:00:57', '2021-12-24 06:00:57'),
(452, 'upload/products/1640325673_product.jpg', '2021-12-24 06:01:13', '2021-12-24 06:01:13'),
(453, 'upload/products/1640325696_product.jpg', '2021-12-24 06:01:36', '2021-12-24 06:01:36'),
(454, 'upload/products/1640325711_product.jpg', '2021-12-24 06:01:51', '2021-12-24 06:01:51'),
(455, 'upload/products/1640325827_product.jpg', '2021-12-24 06:03:47', '2021-12-24 06:03:47'),
(456, 'upload/products/1640325839_product.jpg', '2021-12-24 06:03:59', '2021-12-24 06:03:59'),
(457, 'upload/products/1640325860_product.jpg', '2021-12-24 06:04:20', '2021-12-24 06:04:20'),
(458, 'upload/products/1640325884_product.jpg', '2021-12-24 06:04:44', '2021-12-24 06:04:44'),
(459, 'upload/products/1640325896_product.jpg', '2021-12-24 06:04:56', '2021-12-24 06:04:56'),
(460, 'upload/products/1640325906_product.jpg', '2021-12-24 06:05:06', '2021-12-24 06:05:06'),
(461, 'upload/products/1640325916_product.jpg', '2021-12-24 06:05:16', '2021-12-24 06:05:16'),
(462, 'upload/products/1640325931_product.jpg', '2021-12-24 06:05:31', '2021-12-24 06:05:31'),
(463, 'upload/products/1640325941_product.jpg', '2021-12-24 06:05:41', '2021-12-24 06:05:41'),
(464, 'upload/products/1640325953_product.jpg', '2021-12-24 06:05:53', '2021-12-24 06:05:53'),
(465, 'upload/products/1640325966_product.jpg', '2021-12-24 06:06:06', '2021-12-24 06:06:06'),
(466, 'upload/products/1640325977_product.jpg', '2021-12-24 06:06:17', '2021-12-24 06:06:17'),
(467, 'upload/products/1640326003_product.jpg', '2021-12-24 06:06:43', '2021-12-24 06:06:43'),
(468, 'upload/products/1640326013_product.jpg', '2021-12-24 06:06:53', '2021-12-24 06:06:53'),
(469, 'upload/products/1640326025_product.jpg', '2021-12-24 06:07:05', '2021-12-24 06:07:05'),
(470, 'upload/products/1640326035_product.jpg', '2021-12-24 06:07:15', '2021-12-24 06:07:15'),
(471, 'upload/products/1640326044_product.jpg', '2021-12-24 06:07:24', '2021-12-24 06:07:24'),
(472, 'upload/products/1640326055_product.jpg', '2021-12-24 06:07:35', '2021-12-24 06:07:35'),
(473, 'upload/products/1640326066_product.jpg', '2021-12-24 06:07:46', '2021-12-24 06:07:46'),
(474, 'upload/products/1640326075_product.jpg', '2021-12-24 06:07:55', '2021-12-24 06:07:55'),
(475, 'upload/products/1640326364_HIPSTER SALAD .jpg', '2021-12-24 06:12:44', '2021-12-24 06:12:44'),
(476, 'upload/products/1640326424_CHILLI TERIYAKI CHICKEN.jpg', '2021-12-24 06:13:44', '2021-12-24 06:13:44'),
(477, 'upload/products/1640326439_CHILLI TERIYAKI CHICKEN.jpg', '2021-12-24 06:13:59', '2021-12-24 06:13:59'),
(478, 'upload/products/1640332907_CHILLI TERIYAKI CHICKEN.jpg', '2021-12-24 08:01:47', '2021-12-24 08:01:47'),
(479, 'upload/products/1640332934_CHILLI TERIYAKI CHICKEN.jpg', '2021-12-24 08:02:14', '2021-12-24 08:02:14'),
(480, 'upload/products/1640332989_ANDA BHURJI WITH TIKONA PARATHA.jpg', '2021-12-24 08:03:09', '2021-12-24 08:03:09'),
(481, 'upload/products/1640333034_product.jpg', '2021-12-24 08:03:54', '2021-12-24 08:03:54'),
(482, 'upload/products/1640333086_product.jpg', '2021-12-24 08:04:46', '2021-12-24 08:04:46');
INSERT INTO `upload_images_old` (`id`, `file`, `created_at`, `updated_at`) VALUES
(483, 'upload/products/1640333099_product.jpg', '2021-12-24 08:04:59', '2021-12-24 08:04:59'),
(484, 'upload/products/1640333112_product.jpg', '2021-12-24 08:05:12', '2021-12-24 08:05:12'),
(485, 'upload/products/1640333122_product.jpg', '2021-12-24 08:05:22', '2021-12-24 08:05:22'),
(486, 'upload/products/1640333142_product.jpg', '2021-12-24 08:05:42', '2021-12-24 08:05:42'),
(487, 'upload/products/1640333149_product.jpg', '2021-12-24 08:05:49', '2021-12-24 08:05:49'),
(488, 'upload/products/1640333158_product.jpg', '2021-12-24 08:05:58', '2021-12-24 08:05:58'),
(489, 'upload/products/1640333171_product.jpg', '2021-12-24 08:06:11', '2021-12-24 08:06:11'),
(490, 'upload/products/1640333183_product.jpg', '2021-12-24 08:06:23', '2021-12-24 08:06:23'),
(491, 'upload/products/1640333192_product.jpg', '2021-12-24 08:06:32', '2021-12-24 08:06:32'),
(492, 'upload/products/1640333200_product.jpg', '2021-12-24 08:06:40', '2021-12-24 08:06:40'),
(493, 'upload/products/1640333210_product.jpg', '2021-12-24 08:06:50', '2021-12-24 08:06:50'),
(494, 'upload/products/1640333219_product.jpg', '2021-12-24 08:06:59', '2021-12-24 08:06:59'),
(495, 'upload/products/1640333228_product.jpg', '2021-12-24 08:07:08', '2021-12-24 08:07:08'),
(496, 'upload/products/1640333241_product.jpg', '2021-12-24 08:07:21', '2021-12-24 08:07:21'),
(497, 'upload/products/1640333261_product.jpg', '2021-12-24 08:07:41', '2021-12-24 08:07:41'),
(498, 'upload/products/1640333270_product.jpg', '2021-12-24 08:07:50', '2021-12-24 08:07:50'),
(499, 'upload/products/1640333281_product.jpg', '2021-12-24 08:08:01', '2021-12-24 08:08:01'),
(500, 'upload/products/1640333290_product.jpg', '2021-12-24 08:08:10', '2021-12-24 08:08:10'),
(501, 'upload/products/1640333298_product.jpg', '2021-12-24 08:08:18', '2021-12-24 08:08:18'),
(502, 'upload/products/1640333306_product.jpg', '2021-12-24 08:08:26', '2021-12-24 08:08:26'),
(503, 'upload/products/1640333317_product.jpg', '2021-12-24 08:08:37', '2021-12-24 08:08:37'),
(504, 'upload/products/1640333327_product.jpg', '2021-12-24 08:08:47', '2021-12-24 08:08:47'),
(505, 'upload/products/1640333341_product.jpg', '2021-12-24 08:09:01', '2021-12-24 08:09:01'),
(506, 'upload/products/1640333352_product.jpg', '2021-12-24 08:09:12', '2021-12-24 08:09:12'),
(507, 'upload/products/1640333365_product.jpg', '2021-12-24 08:09:25', '2021-12-24 08:09:25'),
(508, 'upload/products/1640333381_product.jpg', '2021-12-24 08:09:41', '2021-12-24 08:09:41'),
(509, 'upload/products/1640333389_product.jpg', '2021-12-24 08:09:49', '2021-12-24 08:09:49'),
(510, 'upload/products/1640333397_product.jpg', '2021-12-24 08:09:57', '2021-12-24 08:09:57'),
(511, 'upload/products/1640333406_product.jpg', '2021-12-24 08:10:06', '2021-12-24 08:10:06'),
(512, 'upload/products/1640333415_product.jpg', '2021-12-24 08:10:15', '2021-12-24 08:10:15'),
(513, 'upload/products/1640333423_product.jpg', '2021-12-24 08:10:23', '2021-12-24 08:10:23'),
(514, 'upload/products/1640333433_product.jpg', '2021-12-24 08:10:33', '2021-12-24 08:10:33'),
(515, 'upload/products/1640333440_product.jpg', '2021-12-24 08:10:40', '2021-12-24 08:10:40'),
(516, 'upload/products/1640333448_product.jpg', '2021-12-24 08:10:48', '2021-12-24 08:10:48'),
(517, 'upload/products/1640333463_product.jpg', '2021-12-24 08:11:03', '2021-12-24 08:11:03'),
(518, 'upload/products/1640333473_product.jpg', '2021-12-24 08:11:13', '2021-12-24 08:11:13'),
(519, 'upload/products/1640333484_product.jpg', '2021-12-24 08:11:24', '2021-12-24 08:11:24'),
(520, 'upload/products/1640333495_product.jpg', '2021-12-24 08:11:35', '2021-12-24 08:11:35'),
(521, 'upload/products/1640333505_product.jpg', '2021-12-24 08:11:45', '2021-12-24 08:11:45'),
(522, 'upload/products/1640333515_product.jpg', '2021-12-24 08:11:55', '2021-12-24 08:11:55'),
(523, 'upload/products/1640333525_product.jpg', '2021-12-24 08:12:05', '2021-12-24 08:12:05'),
(524, 'upload/products/1640333544_product.jpg', '2021-12-24 08:12:24', '2021-12-24 08:12:24'),
(525, 'upload/products/1640333556_product.jpg', '2021-12-24 08:12:36', '2021-12-24 08:12:36'),
(526, 'upload/products/1640333570_product.jpg', '2021-12-24 08:12:50', '2021-12-24 08:12:50'),
(527, 'upload/products/1640333593_CHILLI TERIYAKI CHICKEN.jpg', '2021-12-24 08:13:13', '2021-12-24 08:13:13'),
(528, 'upload/products/1640333621_CHILLI TERIYAKI CHICKEN.jpg', '2021-12-24 08:13:41', '2021-12-24 08:13:41'),
(529, 'upload/products/1640333658_product.jpg', '2021-12-24 08:14:18', '2021-12-24 08:14:18'),
(530, 'upload/products/1640333670_product.jpg', '2021-12-24 08:14:30', '2021-12-24 08:14:30'),
(531, 'upload/products/1640333686_product.jpg', '2021-12-24 08:14:46', '2021-12-24 08:14:46'),
(532, 'upload/products/1640333731_product.jpg', '2021-12-24 08:15:31', '2021-12-24 08:15:31'),
(533, 'upload/products/1640333743_product.jpg', '2021-12-24 08:15:43', '2021-12-24 08:15:43'),
(534, 'upload/products/1640333755_product.jpg', '2021-12-24 08:15:55', '2021-12-24 08:15:55'),
(535, 'upload/products/1640333763_product.jpg', '2021-12-24 08:16:03', '2021-12-24 08:16:03'),
(536, 'upload/products/1640333772_product.jpg', '2021-12-24 08:16:12', '2021-12-24 08:16:12'),
(537, 'upload/products/1640333780_product.jpg', '2021-12-24 08:16:20', '2021-12-24 08:16:20'),
(538, 'upload/products/1640333788_product.jpg', '2021-12-24 08:16:28', '2021-12-24 08:16:28'),
(539, 'upload/products/1640333796_product.jpg', '2021-12-24 08:16:36', '2021-12-24 08:16:36'),
(540, 'upload/products/1640333805_product.jpg', '2021-12-24 08:16:45', '2021-12-24 08:16:45'),
(541, 'upload/products/1640333812_product.jpg', '2021-12-24 08:16:52', '2021-12-24 08:16:52'),
(542, 'upload/products/1640333821_product.jpg', '2021-12-24 08:17:01', '2021-12-24 08:17:01'),
(543, 'upload/products/1640333828_product.jpg', '2021-12-24 08:17:08', '2021-12-24 08:17:08'),
(544, 'upload/products/1640333836_product.jpg', '2021-12-24 08:17:16', '2021-12-24 08:17:16'),
(545, 'upload/products/1640333846_product.jpg', '2021-12-24 08:17:26', '2021-12-24 08:17:26'),
(546, 'upload/products/1640333856_Belgian wit.png', '2021-12-24 08:17:36', '2021-12-24 08:17:36'),
(547, 'upload/products/1640333859_product.jpg', '2021-12-24 08:17:39', '2021-12-24 08:17:39'),
(548, 'upload/products/1640333867_product.jpg', '2021-12-24 08:17:47', '2021-12-24 08:17:47'),
(549, 'upload/products/1640333875_product.jpg', '2021-12-24 08:17:55', '2021-12-24 08:17:55'),
(550, 'upload/products/1640333883_product.jpg', '2021-12-24 08:18:03', '2021-12-24 08:18:03'),
(551, 'upload/products/1640333900_product.jpg', '2021-12-24 08:18:20', '2021-12-24 08:18:20'),
(552, 'upload/products/1640333908_product.jpg', '2021-12-24 08:18:28', '2021-12-24 08:18:28'),
(553, 'upload/products/1640333917_product.jpg', '2021-12-24 08:18:37', '2021-12-24 08:18:37'),
(554, 'upload/products/1640333928_product.jpg', '2021-12-24 08:18:48', '2021-12-24 08:18:48'),
(555, 'upload/products/1640333937_product.jpg', '2021-12-24 08:18:57', '2021-12-24 08:18:57'),
(556, 'upload/products/1640333948_product.jpg', '2021-12-24 08:19:08', '2021-12-24 08:19:08'),
(557, 'upload/products/1640333955_product.jpg', '2021-12-24 08:19:15', '2021-12-24 08:19:15'),
(558, 'upload/products/1640333963_product.jpg', '2021-12-24 08:19:23', '2021-12-24 08:19:23'),
(559, 'upload/products/1640333972_product.jpg', '2021-12-24 08:19:32', '2021-12-24 08:19:32'),
(560, 'upload/products/1640333980_product.jpg', '2021-12-24 08:19:40', '2021-12-24 08:19:40'),
(561, 'upload/products/1640333988_product.jpg', '2021-12-24 08:19:48', '2021-12-24 08:19:48'),
(562, 'upload/products/1640333996_product.jpg', '2021-12-24 08:19:56', '2021-12-24 08:19:56'),
(563, 'upload/products/1640334004_product.jpg', '2021-12-24 08:20:04', '2021-12-24 08:20:04'),
(564, 'upload/products/1640334012_product.jpg', '2021-12-24 08:20:12', '2021-12-24 08:20:12'),
(565, 'upload/products/1640334050_product.jpg', '2021-12-24 08:20:50', '2021-12-24 08:20:50'),
(566, 'upload/products/1640334061_product.jpg', '2021-12-24 08:21:01', '2021-12-24 08:21:01'),
(567, 'upload/products/1640334072_product.jpg', '2021-12-24 08:21:12', '2021-12-24 08:21:12'),
(568, 'upload/products/1640334083_product.jpg', '2021-12-24 08:21:23', '2021-12-24 08:21:23'),
(569, 'upload/products/1640334092_product.jpg', '2021-12-24 08:21:32', '2021-12-24 08:21:32'),
(570, 'upload/products/1640334102_product.jpg', '2021-12-24 08:21:42', '2021-12-24 08:21:42'),
(571, 'upload/products/1640334108_product.jpg', '2021-12-24 08:21:48', '2021-12-24 08:21:48'),
(572, 'upload/products/1640334118_product.jpg', '2021-12-24 08:21:58', '2021-12-24 08:21:58'),
(573, 'upload/products/1640334126_product.jpg', '2021-12-24 08:22:06', '2021-12-24 08:22:06'),
(574, 'upload/products/1640334136_product.jpg', '2021-12-24 08:22:16', '2021-12-24 08:22:16'),
(575, 'upload/products/1640334148_product.jpg', '2021-12-24 08:22:28', '2021-12-24 08:22:28'),
(576, 'upload/products/1640334158_product.jpg', '2021-12-24 08:22:38', '2021-12-24 08:22:38'),
(577, 'upload/products/1640334165_product.jpg', '2021-12-24 08:22:45', '2021-12-24 08:22:45'),
(578, 'upload/products/1640334172_product.jpg', '2021-12-24 08:22:52', '2021-12-24 08:22:52'),
(579, 'upload/products/1640334180_product.jpg', '2021-12-24 08:23:00', '2021-12-24 08:23:00'),
(580, 'upload/products/1640334187_product.jpg', '2021-12-24 08:23:07', '2021-12-24 08:23:07'),
(581, 'upload/products/1640334199_product.jpg', '2021-12-24 08:23:19', '2021-12-24 08:23:19'),
(582, 'upload/products/1640334206_product.jpg', '2021-12-24 08:23:26', '2021-12-24 08:23:26'),
(583, 'upload/products/1640334214_product.jpg', '2021-12-24 08:23:34', '2021-12-24 08:23:34'),
(584, 'upload/products/1640334221_product.jpg', '2021-12-24 08:23:41', '2021-12-24 08:23:41'),
(585, 'upload/products/1640334230_product.jpg', '2021-12-24 08:23:50', '2021-12-24 08:23:50'),
(586, 'upload/products/1640334238_product.jpg', '2021-12-24 08:23:58', '2021-12-24 08:23:58'),
(587, 'upload/products/1640334248_product.jpg', '2021-12-24 08:24:08', '2021-12-24 08:24:08'),
(588, 'upload/products/1640334261_product.jpg', '2021-12-24 08:24:21', '2021-12-24 08:24:21'),
(589, 'upload/products/1640334270_product.jpg', '2021-12-24 08:24:30', '2021-12-24 08:24:30'),
(590, 'upload/products/1640334281_product.jpg', '2021-12-24 08:24:41', '2021-12-24 08:24:41'),
(591, 'upload/places/multiple/1640869739_4X3A2631.jpg', '2021-12-30 13:08:59', '2021-12-30 13:08:59'),
(592, 'upload/places/multiple/1640869739_4X3A2692.jpg', '2021-12-30 13:08:59', '2021-12-30 13:08:59'),
(593, 'upload/places/multiple/1640869739_4X3A2713.jpg', '2021-12-30 13:08:59', '2021-12-30 13:08:59'),
(594, 'upload/places/multiple/1640869739_4X3A2722.jpg', '2021-12-30 13:08:59', '2021-12-30 13:08:59'),
(595, 'upload/places/multiple/1640869739_4X3A2725.jpg', '2021-12-30 13:08:59', '2021-12-30 13:08:59'),
(596, 'upload/places/multiple/1640869739_4X3A2729.jpg', '2021-12-30 13:08:59', '2021-12-30 13:08:59'),
(597, 'upload/places/multiple/1640869739_4X3A2733.jpg', '2021-12-30 13:08:59', '2021-12-30 13:08:59'),
(598, 'upload/places/multiple/1640869739_4X3A2738.jpg', '2021-12-30 13:08:59', '2021-12-30 13:08:59'),
(599, 'upload/places/multiple/1640869739_4X3A2741.jpg', '2021-12-30 13:08:59', '2021-12-30 13:08:59'),
(600, 'upload/passport/1641661929_1640158685 (1).jpg', '2022-01-08 17:12:09', '2022-01-08 17:12:09'),
(601, 'upload/passport/1641662727_1640158685 (1).jpg', '2022-01-08 17:25:27', '2022-01-08 17:25:27'),
(602, 'upload/passport/1641804223_passport.jpg', '2022-01-10 08:43:43', '2022-01-10 08:43:43'),
(603, 'upload/products/1641819032_Tacos.jpg', '2022-01-10 12:50:32', '2022-01-10 12:50:32'),
(604, 'upload/products/1641819088_TAPAS BOX.jpg', '2022-01-10 12:51:29', '2022-01-10 12:51:29'),
(605, 'upload/products/1641819121_POLLO OLIVATTI .jpg', '2022-01-10 12:52:01', '2022-01-10 12:52:01'),
(606, 'upload/products/1641819149_STYLISH SALTIMBOCCA.jpg', '2022-01-10 12:52:29', '2022-01-10 12:52:29'),
(607, 'upload/products/1641819193_SCOTCH EGG 1.jpg', '2022-01-10 12:53:13', '2022-01-10 12:53:13'),
(608, 'upload/products/1641819226_FINCH_S SPECIAL INDIAN MASALA.jpg', '2022-01-10 12:53:46', '2022-01-10 12:53:46'),
(609, 'upload/products/1641819263_THAI SPRING ROLL (PAW PIA TOD).jpg', '2022-01-10 12:54:23', '2022-01-10 12:54:23'),
(610, 'upload/products/1641819292_VIETNAMESE STYLE CHILLY CELERY COTTAGE CHEESE 1.jpg', '2022-01-10 12:54:52', '2022-01-10 12:54:52'),
(611, 'upload/products/1641819326_KUNG PAO TOFU AND BROCCOLI.jpg', '2022-01-10 12:55:26', '2022-01-10 12:55:26'),
(612, 'upload/products/1641878216_VOLCANO NACHOS 2.jpg', '2022-01-11 05:16:56', '2022-01-11 05:16:56'),
(613, 'upload/products/1641878313_tapas.jpg', '2022-01-11 05:18:33', '2022-01-11 05:18:33'),
(614, 'upload/products/1641878381_SRILANKAN FIERY PRAWN.jpg', '2022-01-11 05:19:42', '2022-01-11 05:19:42'),
(615, 'upload/products/1641878454_THE FARMER SALAD .jpg', '2022-01-11 05:20:54', '2022-01-11 05:20:54'),
(616, 'upload/products/1641878491_POTATO, EGG AND BACON SALAD.jpg', '2022-01-11 05:21:31', '2022-01-11 05:21:31'),
(617, 'upload/products/1641878527_WILD MUSHROOM CROQUE MONSIEUR.jpg', '2022-01-11 05:22:07', '2022-01-11 05:22:07'),
(618, 'upload/products/1641887101_PANKO CRUSTED TEMPURA SHRIMPS 1.jpg', '2022-01-11 07:45:01', '2022-01-11 07:45:01'),
(619, 'upload/products/1641887166_SHARP CHEDDAR _ HAM CROQUE MONSIEUR.jpg', '2022-01-11 07:46:06', '2022-01-11 07:46:06'),
(620, 'upload/products/1641887202_QUESADILLA .jpg', '2022-01-11 07:46:42', '2022-01-11 07:46:42'),
(621, 'upload/products/1641887227_QUESADILLA 1.jpg', '2022-01-11 07:47:07', '2022-01-11 07:47:07'),
(622, 'upload/products/1641887379_SINGAPORE CURRY BOWL 3.jpg', '2022-01-11 07:49:39', '2022-01-11 07:49:39'),
(623, 'upload/products/1641887421_SINGAPORE CURRY BOWL 3.jpg', '2022-01-11 07:50:21', '2022-01-11 07:50:21'),
(624, 'upload/products/1641887451_SINGAPORE CURRY BOWL 3.jpg', '2022-01-11 07:50:51', '2022-01-11 07:50:51'),
(625, 'upload/products/1641887504_MALASIAN  CURRY BOWL .jpg', '2022-01-11 07:51:44', '2022-01-11 07:51:44'),
(626, 'upload/products/1641887571_MALASIAN  CURRY BOWL 1.jpg', '2022-01-11 07:52:51', '2022-01-11 07:52:51'),
(627, 'upload/products/1641887600_MALASIAN  CURRY BOWL 1.jpg', '2022-01-11 07:53:20', '2022-01-11 07:53:20'),
(628, 'upload/products/1641887715_RED THAI CURRY WITH STEAM RICE .jpg', '2022-01-11 07:55:15', '2022-01-11 07:55:15'),
(629, 'upload/products/1641887758_REDTHAI CURRY WITH STEAM RICE .jpg', '2022-01-11 07:55:58', '2022-01-11 07:55:58'),
(630, 'upload/products/1641887804_REDTHAI CURRY WITH STEAM RICE .jpg', '2022-01-11 07:56:44', '2022-01-11 07:56:44'),
(631, 'upload/products/1641888020_NASI GORENG .jpg', '2022-01-11 08:00:20', '2022-01-11 08:00:20'),
(632, 'upload/products/1641888089_NASI GORENG 1.jpg', '2022-01-11 08:01:29', '2022-01-11 08:01:29'),
(633, 'upload/products/1641888134_NASI GORENG .jpg', '2022-01-11 08:02:14', '2022-01-11 08:02:14'),
(634, 'upload/products/1641888258_MIE GOREN .jpg', '2022-01-11 08:04:18', '2022-01-11 08:04:18'),
(635, 'upload/products/1641888297_MIE GOREN 1.jpg', '2022-01-11 08:04:57', '2022-01-11 08:04:57'),
(636, 'upload/products/1641888358_MUMBAIYA KEEMA PAO 1.jpg', '2022-01-11 08:05:58', '2022-01-11 08:05:58'),
(637, 'upload/products/1641888408_SINGAPOREAN BURNT GARLIC FRIED RICE.jpg', '2022-01-11 08:06:48', '2022-01-11 08:06:48'),
(638, 'upload/products/1641888945_SINGAPOREAN BURNT GARLIC FRIED RICE 1.jpg', '2022-01-11 08:15:45', '2022-01-11 08:15:45'),
(639, 'upload/products/1641889060_SINGAPOREAN BURNT GARLIC FRIED RICE.jpg', '2022-01-11 08:17:40', '2022-01-11 08:17:40'),
(640, 'upload/products/1641889243_NASI GORENG .jpg', '2022-01-11 08:20:43', '2022-01-11 08:20:43'),
(641, 'upload/products/1641889251_SINGAPOREAN BURNT GARLIC FRIED RICE 1.jpg', '2022-01-11 08:20:51', '2022-01-11 08:20:51'),
(642, 'upload/products/1641889285_SISILIAN WHOLE ORANGE CAKE WITH CARAMEL SAUCE AND ICE CREAM 1.jpg', '2022-01-11 08:21:25', '2022-01-11 08:21:25'),
(643, 'upload/products/1641889448_LAMB STEW WITH LINGUINI .jpg', '2022-01-11 08:24:09', '2022-01-11 08:24:09'),
(644, 'upload/products/1641889460_LAMB STEW WITH LINGUINI 1.jpg', '2022-01-11 08:24:20', '2022-01-11 08:24:20'),
(645, 'upload/products/1641890057_GRILLED CHICKEN WITH LEMON MUSTARD SAUCE 1.jpg', '2022-01-11 08:34:17', '2022-01-11 08:34:17'),
(646, 'upload/products/1641890102_GRILLED CHICKEN WITH LEMON MUSTARD SAUCE 1.jpg', '2022-01-11 08:35:02', '2022-01-11 08:35:02'),
(647, 'upload/passport/1641895163_passport.jpg', '2022-01-11 09:59:23', '2022-01-11 09:59:23'),
(648, 'upload/passport/1641897104_IMG-20220111-WA0026.jpg', '2022-01-11 10:31:44', '2022-01-11 10:31:44'),
(649, 'upload/products/1641916607_1640158685 (1).jpg', '2022-01-11 15:56:47', '2022-01-11 15:56:47'),
(650, 'upload/products/1641973468_WhatsApp Image 2022-01-11 at 2.26.30 PM.jpeg', '2022-01-12 07:44:28', '2022-01-12 07:44:28'),
(651, 'upload/products/1641973582_WhatsApp Image 2022-01-11 at 2.27.18 PM.jpeg', '2022-01-12 07:46:22', '2022-01-12 07:46:22'),
(652, 'upload/products/1641973589_WhatsApp Image 2022-01-11 at 2.26.30 PM.jpeg', '2022-01-12 07:46:29', '2022-01-12 07:46:29'),
(653, 'upload/products/1641973620_WhatsApp Image 2022-01-11 at 2.29.57 PM.jpeg', '2022-01-12 07:47:00', '2022-01-12 07:47:00'),
(654, 'upload/products/1641973643_WhatsApp Image 2022-01-11 at 2.27.18 PM.jpeg', '2022-01-12 07:47:23', '2022-01-12 07:47:23'),
(655, 'upload/products/1641973664_WhatsApp Image 2022-01-11 at 2.39.04 PM.jpeg', '2022-01-12 07:47:44', '2022-01-12 07:47:44'),
(656, 'upload/places/icons/1642079635_1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0002.jpg', '2022-01-13 13:13:55', '2022-01-13 13:13:55'),
(657, 'upload/places/icons/1642079660_1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0004.jpg', '2022-01-13 13:14:20', '2022-01-13 13:14:20'),
(658, 'upload/products/1642175813_TAPAS BOX.jpg', '2022-01-14 15:56:53', '2022-01-14 15:56:53'),
(659, 'upload/products/1642175862_POLLO OLIVATTI .jpg', '2022-01-14 15:57:42', '2022-01-14 15:57:42'),
(660, 'upload/products/1642176019_QUESADILLA .jpg', '2022-01-14 16:00:19', '2022-01-14 16:00:19'),
(661, 'upload/products/1642320873_20220112_162632 (FILEminimizer).jpg', '2022-01-16 08:14:33', '2022-01-16 08:14:33'),
(662, 'upload/products/1642320889_20220112_162632 (FILEminimizer).jpg', '2022-01-16 08:14:49', '2022-01-16 08:14:49'),
(663, 'upload/products/1642320901_20220112_162632 (FILEminimizer).jpg', '2022-01-16 08:15:01', '2022-01-16 08:15:01'),
(664, 'upload/products/1642320956_MIE GOREN .jpg', '2022-01-16 08:15:56', '2022-01-16 08:15:56'),
(665, 'upload/products/1642320974_MIE GOREN 1.jpg', '2022-01-16 08:16:14', '2022-01-16 08:16:14'),
(666, 'upload/products/1642321008_MIE GOREN .jpg', '2022-01-16 08:16:48', '2022-01-16 08:16:48'),
(667, 'upload/products/1642321137_20220113_165227 (FILEminimizer).jpg', '2022-01-16 08:18:57', '2022-01-16 08:18:57'),
(668, 'upload/products/1642321195_20220113_165210 (FILEminimizer).jpg', '2022-01-16 08:19:55', '2022-01-16 08:19:55'),
(669, 'upload/products/1642321230_20220112_162221 (FILEminimizer).jpg', '2022-01-16 08:20:30', '2022-01-16 08:20:30'),
(670, 'upload/products/1642321245_20220112_162229 (FILEminimizer).jpg', '2022-01-16 08:20:45', '2022-01-16 08:20:45'),
(671, 'upload/products/1642321351_20220115_134800 (FILEminimizer).jpg', '2022-01-16 08:22:31', '2022-01-16 08:22:31'),
(672, 'upload/products/1642321371_20220115_133845 (FILEminimizer).jpg', '2022-01-16 08:22:51', '2022-01-16 08:22:51'),
(673, 'upload/products/1642321396_20220113_131032 (FILEminimizer).jpg', '2022-01-16 08:23:16', '2022-01-16 08:23:16'),
(674, 'upload/products/1642321441_20220115_155723 (FILEminimizer).jpg', '2022-01-16 08:24:01', '2022-01-16 08:24:01'),
(675, 'upload/products/1642321460_20220115_150553 (FILEminimizer).jpg', '2022-01-16 08:24:20', '2022-01-16 08:24:20'),
(676, 'upload/products/1642321482_20220113_150714 (FILEminimizer).jpg', '2022-01-16 08:24:42', '2022-01-16 08:24:42'),
(677, 'upload/products/1642321546_20220114_124654 (FILEminimizer).jpg', '2022-01-16 08:25:46', '2022-01-16 08:25:46'),
(678, 'upload/products/1642321566_20220114_130331 (FILEminimizer).jpg', '2022-01-16 08:26:06', '2022-01-16 08:26:06'),
(679, 'upload/products/1642321591_20220115_162713 (FILEminimizer).jpg', '2022-01-16 08:26:31', '2022-01-16 08:26:31'),
(680, 'upload/products/1642321693_20220114_130816 (FILEminimizer).jpg', '2022-01-16 08:28:13', '2022-01-16 08:28:13'),
(681, 'upload/products/1642321718_20220113_152937 (FILEminimizer).jpg', '2022-01-16 08:28:38', '2022-01-16 08:28:38'),
(682, 'upload/products/1642321761_20220115_125334 (FILEminimizer).jpg', '2022-01-16 08:29:21', '2022-01-16 08:29:21'),
(683, 'upload/products/1642321778_20220113_142915 (FILEminimizer).jpg', '2022-01-16 08:29:38', '2022-01-16 08:29:38'),
(684, 'upload/products/1642321827_FINCH_S SPECIAL INDIAN MASALA.jpg', '2022-01-16 08:30:27', '2022-01-16 08:30:27'),
(685, 'upload/products/1642321867_KUNG PAO TOFU AND BROCCOLI.jpg', '2022-01-16 08:31:07', '2022-01-16 08:31:07'),
(686, 'upload/products/1642321906_20220113_163506 (FILEminimizer).jpg', '2022-01-16 08:31:46', '2022-01-16 08:31:46'),
(687, 'upload/products/1642321986_20220115_174848 (FILEminimizer).jpg', '2022-01-16 08:33:06', '2022-01-16 08:33:06'),
(688, 'upload/products/1642322025_NASI GORENG .jpg', '2022-01-16 08:33:45', '2022-01-16 08:33:45'),
(689, 'upload/products/1642322056_NASI GORENG 1.jpg', '2022-01-16 08:34:16', '2022-01-16 08:34:16'),
(690, 'upload/products/1642322104_20220113_160156 (FILEminimizer).jpg', '2022-01-16 08:35:04', '2022-01-16 08:35:04'),
(691, 'upload/products/1642322123_20220115_164552 (FILEminimizer).jpg', '2022-01-16 08:35:23', '2022-01-16 08:35:23'),
(692, 'upload/products/1642322167_RED THAI CURRY WITH STEAM RICE .jpg', '2022-01-16 08:36:07', '2022-01-16 08:36:07'),
(693, 'upload/products/1642322191_REDTHAI CURRY WITH STEAM RICE .jpg', '2022-01-16 08:36:31', '2022-01-16 08:36:31'),
(694, 'upload/products/1642322206_REDTHAI CURRY WITH STEAM RICE .jpg', '2022-01-16 08:36:46', '2022-01-16 08:36:46'),
(695, 'upload/products/1642322338_QUESADILLA .jpg', '2022-01-16 08:38:58', '2022-01-16 08:38:58'),
(696, 'upload/products/1642323236_WhatsApp Image 2022-01-11 at 2.29.57 PM.jpeg', '2022-01-16 08:53:56', '2022-01-16 08:53:56'),
(697, 'upload/products/1642323363_WhatsApp Image 2022-01-11 at 2.25.37 PM.jpeg', '2022-01-16 08:56:03', '2022-01-16 08:56:03'),
(698, 'upload/places/icons/1642418038_WhatsApp Image 2022-01-17 at 4.30.01 PM.jpeg', '2022-01-17 11:13:58', '2022-01-17 11:13:58'),
(699, 'upload/products/1642596251_choc mudslide (FILEminimizer).jpg', '2022-01-19 12:44:11', '2022-01-19 12:44:11'),
(700, 'upload/products/1642596274_Dal Makhani (FILEminimizer).jpg', '2022-01-19 12:44:34', '2022-01-19 12:44:34'),
(701, 'upload/products/1642596288_egg bhurji (FILEminimizer).jpg', '2022-01-19 12:44:48', '2022-01-19 12:44:48'),
(702, 'upload/products/1642596307_chic burger (FILEminimizer).jpg', '2022-01-19 12:45:07', '2022-01-19 12:45:07'),
(703, 'upload/products/1642596384_CHICKEN MOJO ROJO PANINI (FILEminimizer).jpg', '2022-01-19 12:46:24', '2022-01-19 12:46:24'),
(704, 'upload/products/1642596395_chicken tikka pizza (FILEminimizer).jpg', '2022-01-19 12:46:35', '2022-01-19 12:46:35'),
(705, 'upload/products/1642596407_HOT CHILLI VEGETABLES 1 (FILEminimizer).jpg', '2022-01-19 12:46:47', '2022-01-19 12:46:47'),
(706, 'upload/products/1642596426_non veg platter (FILEminimizer).jpg', '2022-01-19 12:47:06', '2022-01-19 12:47:06'),
(707, 'upload/products/1642596479_veg platter (FILEminimizer).jpg', '2022-01-19 12:47:59', '2022-01-19 12:47:59'),
(708, 'upload/products/1642596491_fish tikka (FILEminimizer).jpg', '2022-01-19 12:48:11', '2022-01-19 12:48:11'),
(709, 'upload/products/1642596505_mushroom galouti (FILEminimizer).jpg', '2022-01-19 12:48:25', '2022-01-19 12:48:25'),
(710, 'upload/products/1642596526_Paneer Tikka (FILEminimizer).jpg', '2022-01-19 12:48:46', '2022-01-19 12:48:46'),
(711, 'upload/products/1642596602_Caesar Salad (FILEminimizer).jpg', '2022-01-19 12:50:02', '2022-01-19 12:50:02'),
(712, 'upload/products/1642596623_Paneer Tikka (FILEminimizer).jpg', '2022-01-19 12:50:23', '2022-01-19 12:50:23'),
(713, 'upload/products/1642596640_fish tikka (FILEminimizer).jpg', '2022-01-19 12:50:40', '2022-01-19 12:50:40'),
(714, 'upload/products/1642596660_mushroom galouti (FILEminimizer).jpg', '2022-01-19 12:51:00', '2022-01-19 12:51:00'),
(715, 'upload/products/1642596773_20211015_192216.jpg', '2022-01-19 12:52:53', '2022-01-19 12:52:53'),
(716, 'upload/products/1642596952_choc mudslide (FILEminimizer).jpg', '2022-01-19 12:55:52', '2022-01-19 12:55:52'),
(717, 'upload/products/1642596973_Dal Makhani (FILEminimizer).jpg', '2022-01-19 12:56:13', '2022-01-19 12:56:13'),
(718, 'upload/products/1642596985_egg bhurji (FILEminimizer).jpg', '2022-01-19 12:56:25', '2022-01-19 12:56:25'),
(719, 'upload/products/1642597014_chic burger (FILEminimizer).jpg', '2022-01-19 12:56:54', '2022-01-19 12:56:54'),
(720, 'upload/products/1642597030_CHICKEN MOJO ROJO PANINI (FILEminimizer).jpg', '2022-01-19 12:57:10', '2022-01-19 12:57:10'),
(721, 'upload/products/1642597041_chicken tikka pizza (FILEminimizer).jpg', '2022-01-19 12:57:21', '2022-01-19 12:57:21'),
(722, 'upload/products/1642597056_HOT CHILLI VEGETABLES 1 (FILEminimizer).jpg', '2022-01-19 12:57:36', '2022-01-19 12:57:36'),
(723, 'upload/products/1642597069_Caesar Salad (FILEminimizer).jpg', '2022-01-19 12:57:49', '2022-01-19 12:57:49'),
(724, 'upload/products/1642597090_non veg platter (FILEminimizer).jpg', '2022-01-19 12:58:10', '2022-01-19 12:58:10'),
(725, 'upload/products/1642597121_veg platter (FILEminimizer).jpg', '2022-01-19 12:58:41', '2022-01-19 12:58:41'),
(726, 'upload/products/1642597148_fish tikka (FILEminimizer).jpg', '2022-01-19 12:59:08', '2022-01-19 12:59:08'),
(727, 'upload/products/1642597167_mushroom galouti (FILEminimizer).jpg', '2022-01-19 12:59:27', '2022-01-19 12:59:27'),
(728, 'upload/products/1642597196_Paneer Tikka (FILEminimizer).jpg', '2022-01-19 12:59:56', '2022-01-19 12:59:56'),
(729, 'upload/products/1642597285_20220113_153016 (FILEminimizer).jpg', '2022-01-19 13:01:25', '2022-01-19 13:01:25'),
(730, 'upload/products/1642597309_20220113_165222 (FILEminimizer).jpg', '2022-01-19 13:01:49', '2022-01-19 13:01:49'),
(731, 'upload/products/1642597333_20220113_165205 (FILEminimizer).jpg', '2022-01-19 13:02:13', '2022-01-19 13:02:13'),
(732, 'upload/products/1642597456_20220115_134751 (FILEminimizer).jpg', '2022-01-19 13:04:16', '2022-01-19 13:04:16'),
(733, 'upload/products/1642597474_20220115_133845 (FILEminimizer).jpg', '2022-01-19 13:04:34', '2022-01-19 13:04:34'),
(734, 'upload/products/1642597495_20220113_131023 (FILEminimizer).jpg', '2022-01-19 13:04:55', '2022-01-19 13:04:55'),
(735, 'upload/products/1642597516_20220115_155721 (FILEminimizer).jpg', '2022-01-19 13:05:16', '2022-01-19 13:05:16'),
(736, 'upload/products/1642597534_20220115_150557 (FILEminimizer).jpg', '2022-01-19 13:05:34', '2022-01-19 13:05:34'),
(737, 'upload/products/1642597551_20220113_163448 (FILEminimizer).jpg', '2022-01-19 13:05:51', '2022-01-19 13:05:51'),
(738, 'upload/products/1642597624_20220114_130331 (FILEminimizer).jpg', '2022-01-19 13:07:04', '2022-01-19 13:07:04'),
(739, 'upload/products/1642597648_20220115_125336 (FILEminimizer).jpg', '2022-01-19 13:07:28', '2022-01-19 13:07:28'),
(740, 'upload/products/1642597667_20220113_142915 (FILEminimizer).jpg', '2022-01-19 13:07:47', '2022-01-19 13:07:47'),
(741, 'upload/products/1642597683_20220115_162731 (FILEminimizer).jpg', '2022-01-19 13:08:03', '2022-01-19 13:08:03'),
(742, 'upload/products/1642597711_20220113_152944 (FILEminimizer).jpg', '2022-01-19 13:08:31', '2022-01-19 13:08:31'),
(743, 'upload/products/1642597787_20220115_123817 (FILEminimizer).jpg', '2022-01-19 13:09:47', '2022-01-19 13:09:47'),
(744, 'upload/products/1642597807_20220114_124654 (FILEminimizer).jpg', '2022-01-19 13:10:07', '2022-01-19 13:10:07'),
(745, 'upload/products/1642597834_20220113_150713 (FILEminimizer).jpg', '2022-01-19 13:10:34', '2022-01-19 13:10:34'),
(746, 'upload/products/1642597874_20220112_162221 (FILEminimizer).jpg', '2022-01-19 13:11:14', '2022-01-19 13:11:14'),
(747, 'upload/products/1642597887_20220112_162229 (FILEminimizer).jpg', '2022-01-19 13:11:27', '2022-01-19 13:11:27'),
(748, 'upload/products/1642597929_20220112_162632 (FILEminimizer).jpg', '2022-01-19 13:12:09', '2022-01-19 13:12:09'),
(749, 'upload/products/1642597942_20220112_162632 (FILEminimizer).jpg', '2022-01-19 13:12:22', '2022-01-19 13:12:22'),
(750, 'upload/products/1642597975_20220115_174908 (FILEminimizer).jpg', '2022-01-19 13:12:55', '2022-01-19 13:12:55'),
(751, 'upload/products/1642598005_20220115_164552 (FILEminimizer).jpg', '2022-01-19 13:13:25', '2022-01-19 13:13:25'),
(752, 'upload/products/1642602098_MIE GOREN  (FILEminimizer).jpg', '2022-01-19 14:21:38', '2022-01-19 14:21:38'),
(753, 'upload/products/1642602111_MIE GOREN 1 (FILEminimizer).jpg', '2022-01-19 14:21:51', '2022-01-19 14:21:51'),
(754, 'upload/products/1642602130_MIE GOREN  (FILEminimizer).jpg', '2022-01-19 14:22:10', '2022-01-19 14:22:10'),
(755, 'upload/products/1642602141_NASI GORENG  (FILEminimizer).jpg', '2022-01-19 14:22:21', '2022-01-19 14:22:21'),
(756, 'upload/products/1642602158_NASI GORENG 1 (FILEminimizer).jpg', '2022-01-19 14:22:38', '2022-01-19 14:22:38'),
(757, 'upload/products/1642602194_RED THAI CURRY WITH STEAM RICE  (FILEminimizer).jpg', '2022-01-19 14:23:14', '2022-01-19 14:23:14'),
(758, 'upload/products/1642602215_REDTHAI CURRY WITH STEAM RICE  (FILEminimizer).jpg', '2022-01-19 14:23:35', '2022-01-19 14:23:35'),
(759, 'upload/products/1642602245_veg burger (FILEminimizer).jpg', '2022-01-19 14:24:05', '2022-01-19 14:24:05'),
(760, 'upload/products/1642602269_QUESADILLA  (FILEminimizer).jpg', '2022-01-19 14:24:29', '2022-01-19 14:24:29'),
(761, 'upload/products/1642602280_QUESADILLA 1 (FILEminimizer).jpg', '2022-01-19 14:24:40', '2022-01-19 14:24:40'),
(762, 'upload/products/1642602319_tapas (FILEminimizer).jpg', '2022-01-19 14:25:19', '2022-01-19 14:25:19'),
(763, 'upload/products/1642602431_KUNG PAO TOFU AND BROCCOLI.jpg', '2022-01-19 14:27:11', '2022-01-19 14:27:11'),
(764, 'upload/products/1642602463_WhatsApp Image 2022-01-11 at 2.25.37 PM.jpeg', '2022-01-19 14:27:43', '2022-01-19 14:27:43'),
(765, 'upload/products/1642602576_WhatsApp Image 2022-01-11 at 2.29.57 PM.jpeg', '2022-01-19 14:29:36', '2022-01-19 14:29:36'),
(766, 'upload/products/1642690684_MIE GOREN  (FILEminimizer).jpg', '2022-01-20 14:58:04', '2022-01-20 14:58:04'),
(767, 'upload/products/1642690724_MIE GOREN  (FILEminimizer).jpg', '2022-01-20 14:58:44', '2022-01-20 14:58:44'),
(768, 'upload/products/1642690740_MIE GOREN  (FILEminimizer).jpg', '2022-01-20 14:59:00', '2022-01-20 14:59:00'),
(769, 'upload/products/1642690757_MIE GOREN  (FILEminimizer).jpg', '2022-01-20 14:59:17', '2022-01-20 14:59:17'),
(770, 'upload/products/1642690771_MIE GOREN  (FILEminimizer).jpg', '2022-01-20 14:59:31', '2022-01-20 14:59:31'),
(771, 'upload/products/1642690790_MIE GOREN 1 (FILEminimizer).jpg', '2022-01-20 14:59:50', '2022-01-20 14:59:50'),
(772, 'upload/products/1642690806_MIE GOREN 1 (FILEminimizer).jpg', '2022-01-20 15:00:06', '2022-01-20 15:00:06'),
(773, 'upload/products/1642690822_MIE GOREN 1 (FILEminimizer).jpg', '2022-01-20 15:00:22', '2022-01-20 15:00:22'),
(774, 'upload/products/1642690879_NASI GORENG 1 (FILEminimizer).jpg', '2022-01-20 15:01:19', '2022-01-20 15:01:19'),
(775, 'upload/products/1642690894_NASI GORENG 1 (FILEminimizer).jpg', '2022-01-20 15:01:34', '2022-01-20 15:01:34'),
(776, 'upload/products/1642690907_NASI GORENG 1 (FILEminimizer).jpg', '2022-01-20 15:01:47', '2022-01-20 15:01:47'),
(777, 'upload/products/1642690920_NASI GORENG  (FILEminimizer).jpg', '2022-01-20 15:02:00', '2022-01-20 15:02:00'),
(778, 'upload/products/1642690931_NASI GORENG  (FILEminimizer).jpg', '2022-01-20 15:02:11', '2022-01-20 15:02:11'),
(779, 'upload/products/1642690943_NASI GORENG  (FILEminimizer).jpg', '2022-01-20 15:02:23', '2022-01-20 15:02:23'),
(780, 'upload/products/1642690954_NASI GORENG  (FILEminimizer).jpg', '2022-01-20 15:02:34', '2022-01-20 15:02:34'),
(781, 'upload/products/1642691030_QUESADILLA  (FILEminimizer).jpg', '2022-01-20 15:03:50', '2022-01-20 15:03:50'),
(782, 'upload/products/1642691042_QUESADILLA  (FILEminimizer).jpg', '2022-01-20 15:04:02', '2022-01-20 15:04:02'),
(783, 'upload/products/1642691054_QUESADILLA  (FILEminimizer).jpg', '2022-01-20 15:04:14', '2022-01-20 15:04:14'),
(784, 'upload/products/1642691065_QUESADILLA 1 (FILEminimizer).jpg', '2022-01-20 15:04:25', '2022-01-20 15:04:25'),
(785, 'upload/products/1642691075_QUESADILLA 1 (FILEminimizer).jpg', '2022-01-20 15:04:35', '2022-01-20 15:04:35'),
(786, 'upload/products/1642691085_QUESADILLA 1 (FILEminimizer).jpg', '2022-01-20 15:04:45', '2022-01-20 15:04:45'),
(787, 'upload/products/1642691187_RED THAI CURRY WITH STEAM RICE  (FILEminimizer).jpg', '2022-01-20 15:06:27', '2022-01-20 15:06:27'),
(788, 'upload/products/1642691198_RED THAI CURRY WITH STEAM RICE  (FILEminimizer).jpg', '2022-01-20 15:06:38', '2022-01-20 15:06:38'),
(789, 'upload/products/1642691209_RED THAI CURRY WITH STEAM RICE  (FILEminimizer).jpg', '2022-01-20 15:06:49', '2022-01-20 15:06:49'),
(790, 'upload/products/1642691224_REDTHAI CURRY WITH STEAM RICE  (FILEminimizer).jpg', '2022-01-20 15:07:04', '2022-01-20 15:07:04'),
(791, 'upload/products/1642691236_REDTHAI CURRY WITH STEAM RICE  (FILEminimizer).jpg', '2022-01-20 15:07:16', '2022-01-20 15:07:16'),
(792, 'upload/products/1642691249_REDTHAI CURRY WITH STEAM RICE  (FILEminimizer).jpg', '2022-01-20 15:07:29', '2022-01-20 15:07:29'),
(793, 'upload/products/1642691262_THAI CURRY WITH STEAM RICE 1 (FILEminimizer).jpg', '2022-01-20 15:07:42', '2022-01-20 15:07:42'),
(794, 'upload/products/1642691339_tapas (FILEminimizer).jpg', '2022-01-20 15:08:59', '2022-01-20 15:08:59'),
(795, 'upload/products/1642691354_tapas (FILEminimizer).jpg', '2022-01-20 15:09:14', '2022-01-20 15:09:14'),
(796, 'upload/products/1642691364_tapas (FILEminimizer).jpg', '2022-01-20 15:09:24', '2022-01-20 15:09:24'),
(797, 'upload/products/1642691419_20220113_163451 (FILEminimizer).jpg', '2022-01-20 15:10:19', '2022-01-20 15:10:19'),
(798, 'upload/products/1642691432_20220113_163506 (FILEminimizer).jpg', '2022-01-20 15:10:32', '2022-01-20 15:10:32'),
(799, 'upload/products/1642691441_20220113_163509 (FILEminimizer).jpg', '2022-01-20 15:10:41', '2022-01-20 15:10:41'),
(800, 'upload/products/1642691601_20220112_162632 (FILEminimizer).jpg', '2022-01-20 15:13:21', '2022-01-20 15:13:21'),
(801, 'upload/products/1642692338_THAI CHILLI NOODLE 1.jpg', '2022-01-20 15:25:38', '2022-01-20 15:25:38'),
(802, 'upload/products/1642692351_THAI CHILLI NOODLE 1.jpg', '2022-01-20 15:25:51', '2022-01-20 15:25:51'),
(803, 'upload/products/1642692366_THAI CHILLI NOODLE 1.jpg', '2022-01-20 15:26:06', '2022-01-20 15:26:06'),
(804, 'upload/products/1642692376_THAI CHILLI NOODLE 1.jpg', '2022-01-20 15:26:16', '2022-01-20 15:26:16'),
(805, 'upload/products/1642692470_20220113_160156 (FILEminimizer).jpg', '2022-01-20 15:27:50', '2022-01-20 15:27:50'),
(806, 'upload/products/1642692480_20220113_160156 (FILEminimizer).jpg', '2022-01-20 15:28:00', '2022-01-20 15:28:00'),
(807, 'upload/products/1642692489_20220113_160156 (FILEminimizer).jpg', '2022-01-20 15:28:09', '2022-01-20 15:28:09'),
(808, 'upload/products/1642692544_20220113_142916 (FILEminimizer).jpg', '2022-01-20 15:29:04', '2022-01-20 15:29:04'),
(809, 'upload/products/1642692553_20220113_142915 (FILEminimizer).jpg', '2022-01-20 15:29:13', '2022-01-20 15:29:13'),
(810, 'upload/products/1642692670_20220113_165230 (FILEminimizer).jpg', '2022-01-20 15:31:10', '2022-01-20 15:31:10'),
(811, 'upload/products/1642692708_20220113_152944 (FILEminimizer).jpg', '2022-01-20 15:31:48', '2022-01-20 15:31:48'),
(812, 'upload/products/1642692718_20220113_152944 (FILEminimizer).jpg', '2022-01-20 15:31:58', '2022-01-20 15:31:58'),
(813, 'upload/products/1642692726_20220113_152944 (FILEminimizer).jpg', '2022-01-20 15:32:06', '2022-01-20 15:32:06'),
(814, 'upload/products/1642692770_20220115_123815 (FILEminimizer).jpg', '2022-01-20 15:32:50', '2022-01-20 15:32:50'),
(815, 'upload/products/1642692779_20220115_123815 (FILEminimizer).jpg', '2022-01-20 15:32:59', '2022-01-20 15:32:59'),
(816, 'upload/products/1642692786_20220115_123815 (FILEminimizer).jpg', '2022-01-20 15:33:06', '2022-01-20 15:33:06'),
(817, 'upload/products/1642692848_20220115_174914 (FILEminimizer).jpg', '2022-01-20 15:34:08', '2022-01-20 15:34:08'),
(818, 'upload/products/1642692860_20220115_174914 (FILEminimizer).jpg', '2022-01-20 15:34:20', '2022-01-20 15:34:20'),
(819, 'upload/products/1642692870_20220115_174914 (FILEminimizer).jpg', '2022-01-20 15:34:30', '2022-01-20 15:34:30'),
(820, 'upload/products/1642692977_20220115_125338 (FILEminimizer).jpg', '2022-01-20 15:36:17', '2022-01-20 15:36:17'),
(821, 'upload/products/1642692985_20220115_125338 (FILEminimizer).jpg', '2022-01-20 15:36:25', '2022-01-20 15:36:25'),
(822, 'upload/products/1642692993_20220115_125338 (FILEminimizer).jpg', '2022-01-20 15:36:33', '2022-01-20 15:36:33'),
(823, 'upload/products/1642777427_KUNG PAO TOFU AND BROCCOLI (FILEminimizer).jpg', '2022-01-21 15:03:47', '2022-01-21 15:03:47'),
(824, 'upload/products/1642777436_KUNG PAO TOFU AND BROCCOLI (FILEminimizer).jpg', '2022-01-21 15:03:56', '2022-01-21 15:03:56'),
(825, 'upload/products/1642777447_KUNG PAO TOFU AND BROCCOLI (FILEminimizer).jpg', '2022-01-21 15:04:07', '2022-01-21 15:04:07'),
(826, 'upload/products/1642777464_LAMB STEW WITH LINGUINI 1 (FILEminimizer).jpg', '2022-01-21 15:04:24', '2022-01-21 15:04:24'),
(827, 'upload/products/1642777488_MALASIAN  CURRY BOWL  (FILEminimizer).jpg', '2022-01-21 15:04:48', '2022-01-21 15:04:48'),
(828, 'upload/products/1642777497_MALASIAN  CURRY BOWL  (FILEminimizer).jpg', '2022-01-21 15:04:57', '2022-01-21 15:04:57'),
(829, 'upload/products/1642777508_MALASIAN  CURRY BOWL 1 (FILEminimizer).jpg', '2022-01-21 15:05:08', '2022-01-21 15:05:08'),
(830, 'upload/products/1642777526_MUMBAIYA KEEMA PAO 1 (FILEminimizer).jpg', '2022-01-21 15:05:26', '2022-01-21 15:05:26'),
(831, 'upload/products/1642777542_PANKO CRUSTED TEMPURA SHRIMPS 1 (FILEminimizer).jpg', '2022-01-21 15:05:42', '2022-01-21 15:05:42'),
(832, 'upload/products/1642777561_POTATO, EGG AND BACON SALAD (FILEminimizer).jpg', '2022-01-21 15:06:01', '2022-01-21 15:06:01'),
(833, 'upload/products/1642777619_SINGAPORE WOK TOSSED CHICKEN 1 (FILEminimizer).jpg', '2022-01-21 15:06:59', '2022-01-21 15:06:59'),
(834, 'upload/products/1642777654_SINGAPORE CURRY BOWL 3 (FILEminimizer).jpg', '2022-01-21 15:07:34', '2022-01-21 15:07:34'),
(835, 'upload/products/1642777665_SINGAPORE CURRY BOWL 3 (FILEminimizer).jpg', '2022-01-21 15:07:45', '2022-01-21 15:07:45'),
(836, 'upload/products/1642777678_SINGAPORE CURRY BOWL 3 (FILEminimizer).jpg', '2022-01-21 15:07:58', '2022-01-21 15:07:58'),
(837, 'upload/products/1642777696_SINGAPOREAN BURNT GARLIC FRIED RICE 1 (FILEminimizer).jpg', '2022-01-21 15:08:16', '2022-01-21 15:08:16'),
(838, 'upload/products/1642777714_SINGAPOREAN BURNT GARLIC FRIED RICE 1 (FILEminimizer).jpg', '2022-01-21 15:08:34', '2022-01-21 15:08:34'),
(839, 'upload/products/1642777752_SRILANKAN FIERY PRAWN (FILEminimizer).jpg', '2022-01-21 15:09:12', '2022-01-21 15:09:12'),
(840, 'upload/products/1642777784_STYLISH SALTIMBOCCA (FILEminimizer).jpg', '2022-01-21 15:09:44', '2022-01-21 15:09:44'),
(841, 'upload/products/1642777804_VIETNAMESE STYLE CHILLY CELERY COTTAGE CHEESE 1 (FILEminimizer).jpg', '2022-01-21 15:10:04', '2022-01-21 15:10:04'),
(842, 'upload/products/1642777820_Tacos (FILEminimizer).jpg', '2022-01-21 15:10:20', '2022-01-21 15:10:20'),
(843, 'upload/products/1642777842_THE FARMER SALAD  (FILEminimizer).jpg', '2022-01-21 15:10:42', '2022-01-21 15:10:42'),
(844, 'upload/products/1642777882_VOLCANO NACHOS 2 (FILEminimizer).jpg', '2022-01-21 15:11:22', '2022-01-21 15:11:22'),
(845, 'upload/products/1642777897_VOLCANO NACHOS 2 (FILEminimizer).jpg', '2022-01-21 15:11:37', '2022-01-21 15:11:37'),
(846, 'upload/products/1642777910_VOLCANO NACHOS 2 (FILEminimizer).jpg', '2022-01-21 15:11:50', '2022-01-21 15:11:50'),
(847, 'upload/products/1642777938_WILD MUSHROOM CROQUE MONSIEUR 2 (FILEminimizer).jpg', '2022-01-21 15:12:18', '2022-01-21 15:12:18'),
(848, 'upload/products/1642785592_Butter Roti.jpg', '2022-01-21 17:19:52', '2022-01-21 17:19:52'),
(849, 'upload/products/1642785603_Butter Roti.jpg', '2022-01-21 17:20:03', '2022-01-21 17:20:03'),
(850, 'upload/products/1642785629_Lachha Paratha.jpg', '2022-01-21 17:20:29', '2022-01-21 17:20:29'),
(851, 'upload/products/1642785641_Lachha Paratha.jpg', '2022-01-21 17:20:41', '2022-01-21 17:20:41'),
(852, 'upload/products/1642785652_Hari Mirchi Ka Paratha.jpg', '2022-01-21 17:20:52', '2022-01-21 17:20:52'),
(853, 'upload/products/1642785662_Hari Mirchi Ka Paratha.jpg', '2022-01-21 17:21:02', '2022-01-21 17:21:02'),
(854, 'upload/products/1642785680_Butter Naan.jpg', '2022-01-21 17:21:20', '2022-01-21 17:21:20'),
(855, 'upload/products/1642785692_Butter Naan.jpg', '2022-01-21 17:21:32', '2022-01-21 17:21:32'),
(856, 'upload/products/1642785841_Chinese-Steamed-Rice-2.jpg', '2022-01-21 17:24:01', '2022-01-21 17:24:01'),
(857, 'upload/products/1642785851_Chinese-Steamed-Rice-2.jpg', '2022-01-21 17:24:11', '2022-01-21 17:24:11'),
(858, 'upload/products/1644778232_user.png', '2022-02-13 18:50:32', '2022-02-13 18:50:32'),
(859, 'upload/products/1644778239_1.jpeg', '2022-02-13 18:50:39', '2022-02-13 18:50:39'),
(860, 'upload/products/1644818134_1.jpeg', '2022-02-14 05:55:34', '2022-02-14 05:55:34'),
(861, 'upload/products/1644818139_ADYSB00019_MUL_FRT4_1800-2400_large.jpeg', '2022-02-14 05:55:39', '2022-02-14 05:55:39'),
(862, 'upload/products/1644818696_DawsonTrolley_Moss_Front_6cca3dc3-51d3-4205-a1e1-ed5d9a03e181_grande.jpeg', '2022-02-14 06:04:56', '2022-02-14 06:04:56'),
(863, 'upload/products/1644818699_DawsonTrolley_Moss_HandleOpen_14842a9b-7222-4ce2-9d17-4731d23454a7_grande.jpeg', '2022-02-14 06:04:59', '2022-02-14 06:04:59'),
(864, 'upload/products/1644838080_user.png', '2022-02-14 11:28:00', '2022-02-14 11:28:00'),
(865, 'upload/products/1644838088_500x500.jpg', '2022-02-14 11:28:08', '2022-02-14 11:28:08'),
(866, 'upload/products/1644838091_500x500.jpg', '2022-02-14 11:28:11', '2022-02-14 11:28:11'),
(867, 'upload/products/1644839003_500x500.jpg', '2022-02-14 11:43:23', '2022-02-14 11:43:23'),
(868, 'upload/products/1644839009_500x500.jpg', '2022-02-14 11:43:29', '2022-02-14 11:43:29'),
(869, 'upload/products/1644922474_1640093721_Lager (1).png', '2022-02-15 10:54:34', '2022-02-15 10:54:34'),
(870, 'upload/products/1644922492_1640176147_4.png', '2022-02-15 10:54:52', '2022-02-15 10:54:52'),
(871, '809_Resources-Pompeo-Group-Executive-Recruiters.png', '2022-02-18 08:45:35', '2022-02-18 08:45:35'),
(872, '642_logo.png', '2022-02-18 08:45:45', '2022-02-18 08:45:45'),
(873, 'upload/banners/1647524122_Beer (2).jpg', '2022-03-17 13:35:22', '2022-03-17 13:35:22'),
(874, 'upload/banners/1647524135_JALAPINOS _CHICKEN SLIDER 1.jpg', '2022-03-17 13:35:35', '2022-03-17 13:35:35'),
(875, 'upload/products/1647674683_WhatsApp Image 2022-03-19 at 12.18.24 PM.jpeg', '2022-03-19 07:24:43', '2022-03-19 07:24:43'),
(876, 'upload/products/1647674692_WhatsApp Image 2022-03-19 at 12.18.23 PM (1).jpeg', '2022-03-19 07:24:52', '2022-03-19 07:24:52'),
(877, 'upload/offers/1647941555_276075368_736582394388599_2073312490991559055_n.jpg', '2022-03-22 09:32:35', '2022-03-22 09:32:35'),
(878, 'upload/offers/1647941587_275853240_734674454579393_495570573301685567_n.png', '2022-03-22 09:33:07', '2022-03-22 09:33:07'),
(879, 'upload/offers/1647941616_275668099_731950571518448_4244311666229443482_n.jpg', '2022-03-22 09:33:36', '2022-03-22 09:33:36'),
(880, 'upload/offers/1647941655_275681466_731948521518653_7345390094988334790_n (1).jpg', '2022-03-22 09:34:15', '2022-03-22 09:34:15'),
(881, 'upload/offers/1647941697_275853240_734674454579393_495570573301685567_n.png', '2022-03-22 09:34:57', '2022-03-22 09:34:57'),
(882, 'upload/offers/1647941781_275853240_734674454579393_495570573301685567_n.png', '2022-03-22 09:36:21', '2022-03-22 09:36:21'),
(883, 'upload/offers/1647942233_276127030_138702981996182_4702241475681711246_n.jpg', '2022-03-22 09:43:53', '2022-03-22 09:43:53'),
(884, 'upload/offers/1647942277_276021035_23850086788060616_3804342210813405638_n.jpg', '2022-03-22 09:44:37', '2022-03-22 09:44:37'),
(885, 'upload/products/1648037439_HANDCUT FRIES TRUFFLE 1.jpg', '2022-03-23 12:10:39', '2022-03-23 12:10:39'),
(886, 'upload/products/1648037486_REDTHAI CURRY WITH STEAM RICE 3.jpg', '2022-03-23 12:11:26', '2022-03-23 12:11:26'),
(887, 'upload/products/1648037540_HANDCUT FRIES TRUFFLE 4.jpg', '2022-03-23 12:12:20', '2022-03-23 12:12:20'),
(888, 'upload/products/1648037586_REDTHAI CURRY WITH STEAM RICE 3.jpg', '2022-03-23 12:13:06', '2022-03-23 12:13:06'),
(889, 'upload/products/1648037675_HANDCUT FRIES TRUFFLE 4 (2).jpg', '2022-03-23 12:14:35', '2022-03-23 12:14:35'),
(890, 'upload/products/1648037675_HANDCUT FRIES TRUFFLE 1.jpg', '2022-03-23 12:14:35', '2022-03-23 12:14:35'),
(891, 'upload/products/1648037709_HANDCUT FRIES TRUFFLE 2.jpg', '2022-03-23 12:15:09', '2022-03-23 12:15:09'),
(892, 'upload/products/1648037755_HANDCUT FRIES TRUFFLE 1.jpg', '2022-03-23 12:15:55', '2022-03-23 12:15:55'),
(893, 'upload/products/1648037791_BEETROOT HALWA CANOLI WITH RABRI FOAM 1.jpg', '2022-03-23 12:16:31', '2022-03-23 12:16:31'),
(894, 'upload/products/1648037927_HANDCUT FRIES TRUFFLE 3 (2).jpg', '2022-03-23 12:18:47', '2022-03-23 12:18:47'),
(895, 'upload/products/1648037940_HANDCUT FRIES TRUFFLE 4.jpg', '2022-03-23 12:19:00', '2022-03-23 12:19:00'),
(896, 'upload/products/1648038017_THAI CHILLI NOODLE 1.jpg', '2022-03-23 12:20:17', '2022-03-23 12:20:17'),
(897, 'upload/products/1648038085_SISILIAN WHOLE ORANGE CAKE WITH CARAMEL SAUCE AND ICE CREAM.jpg', '2022-03-23 12:21:25', '2022-03-23 12:21:25'),
(898, 'upload/products/1648038148_BEETROOT HALWA CANOLI WITH RABRI FOAM 1.jpg', '2022-03-23 12:22:28', '2022-03-23 12:22:28'),
(899, 'upload/products/1648038164_THAI CHILLI NOODLE 2.jpg', '2022-03-23 12:22:44', '2022-03-23 12:22:44'),
(900, 'upload/products/1648038180_THAI CHILLI NOODLE 3.jpg', '2022-03-23 12:23:00', '2022-03-23 12:23:00'),
(901, 'upload/products/1648038236_MIE GOREN 1 (1).jpg', '2022-03-23 12:23:56', '2022-03-23 12:23:56'),
(902, 'upload/products/1648038242_THAI CHILLI NOODLE 1.jpg', '2022-03-23 12:24:02', '2022-03-23 12:24:02'),
(903, 'upload/products/1648038253_MIE GOREN 1.jpg', '2022-03-23 12:24:13', '2022-03-23 12:24:13'),
(904, 'upload/products/1648038265_BULGOGI CHICKEN WINGS .jpg', '2022-03-23 12:24:25', '2022-03-23 12:24:25'),
(905, 'upload/products/1648038271_MIE GOREN 1.jpg', '2022-03-23 12:24:31', '2022-03-23 12:24:31'),
(906, 'upload/products/1648038274_THAI CHILLI NOODLE 2.jpg', '2022-03-23 12:24:34', '2022-03-23 12:24:34'),
(907, 'upload/products/1648038292_MIE GOREN 1.jpg', '2022-03-23 12:24:52', '2022-03-23 12:24:52'),
(908, 'upload/products/1648038302_THAI CHILLI NOODLE 3.jpg', '2022-03-23 12:25:02', '2022-03-23 12:25:02'),
(909, 'upload/products/1648038353_NASI GORENG 1.jpg', '2022-03-23 12:25:53', '2022-03-23 12:25:53'),
(910, 'upload/products/1648038359_MIE GOREN 1 (1).jpg', '2022-03-23 12:25:59', '2022-03-23 12:25:59'),
(911, 'upload/products/1648038405_NASI GORENG 2.jpg', '2022-03-23 12:26:45', '2022-03-23 12:26:45'),
(912, 'upload/products/1648038415_MIE GOREN 1.jpg', '2022-03-23 12:26:55', '2022-03-23 12:26:55'),
(913, 'upload/products/1648038435_MIE GOREN 1 (1).jpg', '2022-03-23 12:27:15', '2022-03-23 12:27:15'),
(914, 'upload/products/1648038460_MIE GOREN 1.jpg', '2022-03-23 12:27:40', '2022-03-23 12:27:40'),
(915, 'upload/products/1648038486_NASI GORENG 1.jpg', '2022-03-23 12:28:06', '2022-03-23 12:28:06'),
(916, 'upload/products/1648038507_NASI GORENG 2.jpg', '2022-03-23 12:28:27', '2022-03-23 12:28:27'),
(917, 'upload/products/1648038569_KILLER KADHAI PANEER PLATTER.jpg', '2022-03-23 12:29:29', '2022-03-23 12:29:29'),
(918, 'upload/products/1648038587_MUMBAIYA KEEMA PAO.jpg', '2022-03-23 12:29:47', '2022-03-23 12:29:47'),
(919, 'upload/products/1648038637_GRILLED CHICKEN WITH LEMON MUSTARD SAUCE .jpg', '2022-03-23 12:30:37', '2022-03-23 12:30:37'),
(920, 'upload/products/1648038659_KILLER KADHAI PANEER PLATTER.jpg', '2022-03-23 12:30:59', '2022-03-23 12:30:59'),
(921, 'upload/products/1648038698_POP STAR PENNE ALFREDO.jpg', '2022-03-23 12:31:38', '2022-03-23 12:31:38'),
(922, 'upload/products/1648038701_GRILLED CHICKEN WITH LEMON MUSTARD SAUCE .jpg', '2022-03-23 12:31:41', '2022-03-23 12:31:41'),
(923, 'upload/products/1648038715_POPPY PENNE ARABIATTA.jpg', '2022-03-23 12:31:55', '2022-03-23 12:31:55'),
(924, 'upload/products/1648038738_POP STAR PENNE ALFREDO.jpg', '2022-03-23 12:32:18', '2022-03-23 12:32:18'),
(925, 'upload/products/1648038743_POPPY PENNE ARABIATTA.jpg', '2022-03-23 12:32:23', '2022-03-23 12:32:23'),
(926, 'upload/products/1648038770_POPPY PENNE ARABIATTA.jpg', '2022-03-23 12:32:50', '2022-03-23 12:32:50'),
(927, 'upload/products/1648038851_CHICKEN IN SMOKED CHILLI SAUCE .jpg', '2022-03-23 12:34:11', '2022-03-23 12:34:11'),
(928, 'upload/products/1648038864_CHICKEN IN SMOKED CHILLI SAUCE .jpg', '2022-03-23 12:34:24', '2022-03-23 12:34:24'),
(929, 'upload/products/1648038967_CHICKEN IN SMOKED CHILLI SAUCE .jpg', '2022-03-23 12:36:07', '2022-03-23 12:36:07'),
(930, 'upload/products/1648039024_REDTHAI CURRY WITH STEAM RICE 3.jpg', '2022-03-23 12:37:04', '2022-03-23 12:37:04'),
(931, 'upload/products/1648039097_BALINESE CURRY BOWL 1.jpg', '2022-03-23 12:38:17', '2022-03-23 12:38:17'),
(932, 'upload/products/1648039115_BALINESE CURRY BOWL 2.jpg', '2022-03-23 12:38:35', '2022-03-23 12:38:35'),
(933, 'upload/products/1648039121_REDTHAI CURRY WITH STEAM RICE 1.jpg', '2022-03-23 12:38:41', '2022-03-23 12:38:41'),
(934, 'upload/products/1648039145_REDTHAI CURRY WITH STEAM RICE 2.jpg', '2022-03-23 12:39:05', '2022-03-23 12:39:05'),
(935, 'upload/products/1648039158_BALINESE CURRY BOWL 1.jpg', '2022-03-23 12:39:18', '2022-03-23 12:39:18'),
(936, 'upload/products/1648039174_BEETROOT HALWA CANOLI WITH RABRI FOAM 1.jpg', '2022-03-23 12:39:34', '2022-03-23 12:39:34'),
(937, 'upload/products/1648039175_BALINESE CURRY BOWL 3.jpg', '2022-03-23 12:39:35', '2022-03-23 12:39:35'),
(938, 'upload/products/1648039210_KILLER KADHAI PANEER PLATTER.jpg', '2022-03-23 12:40:10', '2022-03-23 12:40:10'),
(939, 'upload/products/1648039230_QUESADILLA 2.jpg', '2022-03-23 12:40:30', '2022-03-23 12:40:30'),
(940, 'upload/products/1648039236_KILLER KADHAI PANEER PLATTER.jpg', '2022-03-23 12:40:36', '2022-03-23 12:40:36');
INSERT INTO `upload_images_old` (`id`, `file`, `created_at`, `updated_at`) VALUES
(941, 'upload/products/1648039257_QUESADILLA.jpg', '2022-03-23 12:40:57', '2022-03-23 12:40:57'),
(942, 'upload/products/1648039298_BUTTER CHICKEN COINS.jpg', '2022-03-23 12:41:38', '2022-03-23 12:41:38'),
(943, 'upload/products/1648039321_GRILLED CHICKEN WITH LEMON MUSTARD SAUCE .jpg', '2022-03-23 12:42:01', '2022-03-23 12:42:01'),
(944, 'upload/products/1648039356_LAMB STEW WITH LINGUINI .jpg', '2022-03-23 12:42:36', '2022-03-23 12:42:36'),
(945, 'upload/products/1648039357_QUESADILLA.jpg', '2022-03-23 12:42:37', '2022-03-23 12:42:37'),
(946, 'upload/products/1648039376_QUESADILLA 2.jpg', '2022-03-23 12:42:56', '2022-03-23 12:42:56'),
(947, 'upload/products/1648039377_POP STAR PENNE ALFREDO.jpg', '2022-03-23 12:42:57', '2022-03-23 12:42:57'),
(948, 'upload/products/1648039394_Smoked Chicken Pizza.jpg', '2022-03-23 12:43:14', '2022-03-23 12:43:14'),
(949, 'upload/products/1648039415_POPPY PENNE ARABIATTA.jpg', '2022-03-23 12:43:35', '2022-03-23 12:43:35'),
(950, 'upload/products/1648039460_Smoked Chicken Pizza.jpg', '2022-03-23 12:44:20', '2022-03-23 12:44:20'),
(951, 'upload/products/1648039466_Farm Delight Pizza.jpg', '2022-03-23 12:44:26', '2022-03-23 12:44:26'),
(952, 'upload/products/1648039472_THAI CHILLI NOODLE 1.jpg', '2022-03-23 12:44:32', '2022-03-23 12:44:32'),
(953, 'upload/products/1648039496_THAI CHILLI NOODLE 2.jpg', '2022-03-23 12:44:56', '2022-03-23 12:44:56'),
(954, 'upload/products/1648039554_Farm Delight Pizza.jpg', '2022-03-23 12:45:54', '2022-03-23 12:45:54'),
(955, 'upload/products/1648039562_Hipster Salad.jpg', '2022-03-23 12:46:02', '2022-03-23 12:46:02'),
(956, 'upload/products/1648039588_SINGAPOREAN BURNT GARLIC FRIED RICE 1.jpg', '2022-03-23 12:46:28', '2022-03-23 12:46:28'),
(957, 'upload/products/1648039601_SINGAPOREAN BURNT GARLIC FRIED RICE 2.jpg', '2022-03-23 12:46:41', '2022-03-23 12:46:41'),
(958, 'upload/products/1648039622_Hipster Salad.jpg', '2022-03-23 12:47:02', '2022-03-23 12:47:02'),
(959, 'upload/products/1648039706_MIE GOREN 1 (1).jpg', '2022-03-23 12:48:26', '2022-03-23 12:48:26'),
(960, 'upload/products/1648039735_NASI GORENG 1.jpg', '2022-03-23 12:48:55', '2022-03-23 12:48:55'),
(961, 'upload/products/1648039751_MIE GOREN 1 (1).jpg', '2022-03-23 12:49:11', '2022-03-23 12:49:11'),
(962, 'upload/products/1648039788_SINGAPOREAN BURNT GARLIC FRIED RICE 1.jpg', '2022-03-23 12:49:48', '2022-03-23 12:49:48'),
(963, 'upload/products/1648039805_NASI GORENG 2.jpg', '2022-03-23 12:50:05', '2022-03-23 12:50:05'),
(964, 'upload/products/1648039830_NASI GORENG 2.jpg', '2022-03-23 12:50:30', '2022-03-23 12:50:30'),
(965, 'upload/products/1648039846_NASI GORENG 3.jpg', '2022-03-23 12:50:46', '2022-03-23 12:50:46'),
(966, 'upload/products/1648039854_Nachos.jpg', '2022-03-23 12:50:54', '2022-03-23 12:50:54'),
(967, 'upload/products/1648039861_NASI GORENG 2.jpg', '2022-03-23 12:51:01', '2022-03-23 12:51:01'),
(968, 'upload/products/1648039881_Nachos.jpg', '2022-03-23 12:51:21', '2022-03-23 12:51:21'),
(969, 'upload/products/1648039909_KUNG PAO TOFU AND BROCCOLI.jpg', '2022-03-23 12:51:49', '2022-03-23 12:51:49'),
(970, 'upload/products/1648039926_NASI GORENG 1.jpg', '2022-03-23 12:52:06', '2022-03-23 12:52:06'),
(971, 'upload/products/1648039966_KUNG PAO TOFU AND BROCCOLI.jpg', '2022-03-23 12:52:46', '2022-03-23 12:52:46'),
(972, 'upload/products/1648040007_Finch special Indian Masala.jpg', '2022-03-23 12:53:27', '2022-03-23 12:53:27'),
(973, 'upload/products/1648040009_NASI GORENG 3.jpg', '2022-03-23 12:53:29', '2022-03-23 12:53:29'),
(974, 'upload/products/1648040030_NASI GORENG 1.jpg', '2022-03-23 12:53:50', '2022-03-23 12:53:50'),
(975, 'upload/products/1648040036_BULLS EYE.jpg', '2022-03-23 12:53:56', '2022-03-23 12:53:56'),
(976, 'upload/products/1648040067_Finch special Indian Masala.jpg', '2022-03-23 12:54:27', '2022-03-23 12:54:27'),
(977, 'upload/products/1648040092_NASI GORENG 1.jpg', '2022-03-23 12:54:52', '2022-03-23 12:54:52'),
(978, 'upload/products/1648040119_CHICKEN IN SMOKED CHILLI SAUCE .jpg', '2022-03-23 12:55:19', '2022-03-23 12:55:19'),
(979, 'upload/products/1648040141_Bacon Mushroom.jpg', '2022-03-23 12:55:41', '2022-03-23 12:55:41'),
(980, 'upload/products/1648040156_BULLS EYE.jpg', '2022-03-23 12:55:56', '2022-03-23 12:55:56'),
(981, 'upload/products/1648040159_REDTHAI CURRY WITH STEAM RICE 2.jpg', '2022-03-23 12:55:59', '2022-03-23 12:55:59'),
(982, 'upload/products/1648040171_REDTHAI CURRY WITH STEAM RICE 2.jpg', '2022-03-23 12:56:11', '2022-03-23 12:56:11'),
(983, 'upload/products/1648040191_REDTHAI CURRY WITH STEAM RICE 1.jpg', '2022-03-23 12:56:31', '2022-03-23 12:56:31'),
(984, 'upload/products/1648040204_Bacon Mushroom.jpg', '2022-03-23 12:56:44', '2022-03-23 12:56:44'),
(985, 'upload/products/1648040221_MALASIAN  CURRY BOWL 1.jpg', '2022-03-23 12:57:01', '2022-03-23 12:57:01'),
(986, 'upload/products/1648040224_Pollo Olivatti.jpg', '2022-03-23 12:57:04', '2022-03-23 12:57:04'),
(987, 'upload/products/1648040232_MALASIAN  CURRY BOWL 2.jpg', '2022-03-23 12:57:12', '2022-03-23 12:57:12'),
(988, 'upload/products/1648040242_Pollo Olivatti.jpg', '2022-03-23 12:57:22', '2022-03-23 12:57:22'),
(989, 'upload/products/1648040281_Tapas Box.jpg', '2022-03-23 12:58:01', '2022-03-23 12:58:01'),
(990, 'upload/products/1648040285_Tapas Box.jpg', '2022-03-23 12:58:05', '2022-03-23 12:58:05'),
(991, 'upload/products/1648040340_PITA HUMMUS TO WAY.jpg', '2022-03-23 12:59:00', '2022-03-23 12:59:00'),
(992, 'upload/products/1648040342_PITA HUMMUS TO WAY.jpg', '2022-03-23 12:59:02', '2022-03-23 12:59:02'),
(993, 'upload/products/1648040410_PITA HUMMUS TO WAY.jpg', '2022-03-23 13:00:10', '2022-03-23 13:00:10'),
(994, 'upload/products/1648040434_Tapas Box.jpg', '2022-03-23 13:00:34', '2022-03-23 13:00:34'),
(995, 'upload/products/1648040451_BURRATA  PESTO CROSTINI.jpg', '2022-03-23 13:00:51', '2022-03-23 13:00:51'),
(996, 'upload/products/1648040472_Tapas Box.jpg', '2022-03-23 13:01:12', '2022-03-23 13:01:12'),
(997, 'upload/products/1648040525_PANKO CRUSTED TEMPURA SHRIMPS.jpg', '2022-03-23 13:02:05', '2022-03-23 13:02:05'),
(998, 'upload/products/1648040540_Pollo Olivatti.jpg', '2022-03-23 13:02:20', '2022-03-23 13:02:20'),
(999, 'upload/products/1648040554_STYLISH SALTIMBOCCA.jpg', '2022-03-23 13:02:34', '2022-03-23 13:02:34'),
(1000, 'upload/products/1648040641_Bacon Mushroom.jpg', '2022-03-23 13:04:01', '2022-03-23 13:04:01'),
(1001, 'upload/products/1648040660_BULLS EYE.jpg', '2022-03-23 13:04:20', '2022-03-23 13:04:20'),
(1002, 'upload/products/1648040675_Finch special Indian Masala.jpg', '2022-03-23 13:04:35', '2022-03-23 13:04:35'),
(1003, 'upload/products/1648040696_KUNG PAO TOFU AND BROCCOLI.jpg', '2022-03-23 13:04:56', '2022-03-23 13:04:56'),
(1004, 'upload/products/1648040721_Nachos.jpg', '2022-03-23 13:05:21', '2022-03-23 13:05:21'),
(1005, 'upload/products/1648040780_SINGAPORE WOK TOSSED CHICKEN.jpg', '2022-03-23 13:06:20', '2022-03-23 13:06:20'),
(1006, 'upload/products/1648040786_Hipster Salad.jpg', '2022-03-23 13:06:26', '2022-03-23 13:06:26'),
(1007, 'upload/products/1648040802_VIETNAMESE STYLE CHILLY CELERY COTTAGE CHEESE.jpg', '2022-03-23 13:06:42', '2022-03-23 13:06:42'),
(1008, 'upload/products/1648040804_SRILANKAN FIERY PRAWN .jpg', '2022-03-23 13:06:44', '2022-03-23 13:06:44'),
(1009, 'upload/products/1648040835_CHILLI TERIYAKI CHICKEN.jpg', '2022-03-23 13:07:15', '2022-03-23 13:07:15'),
(1010, 'upload/products/1648040861_BULGOGI CHICKEN WINGS .jpg', '2022-03-23 13:07:41', '2022-03-23 13:07:41'),
(1011, 'upload/products/1648040900_MALASIAN  CURRY BOWL 1.jpg', '2022-03-23 13:08:20', '2022-03-23 13:08:20'),
(1012, 'upload/products/1648040908_THE FARMER SALAD.jpg', '2022-03-23 13:08:28', '2022-03-23 13:08:28'),
(1013, 'upload/products/1648040912_Classic Margherita.jpg', '2022-03-23 13:08:32', '2022-03-23 13:08:32'),
(1014, 'upload/products/1648040942_QUESADILLA.jpg', '2022-03-23 13:09:02', '2022-03-23 13:09:02'),
(1015, 'upload/products/1648040971_MALASIAN  CURRY BOWL 2.jpg', '2022-03-23 13:09:31', '2022-03-23 13:09:31'),
(1016, 'upload/products/1648040973_POTATO, EGG AND BACON SALAD.jpg', '2022-03-23 13:09:33', '2022-03-23 13:09:33'),
(1017, 'upload/products/1648040988_SINGAPORE CURRY BOWL 2.jpg', '2022-03-23 13:09:48', '2022-03-23 13:09:48'),
(1018, 'upload/products/1648040997_WILD MUSHROOM CROQUE MONSIEUR.jpg', '2022-03-23 13:09:57', '2022-03-23 13:09:57'),
(1019, 'upload/products/1648041040_Smoked Chicken Pizza.jpg', '2022-03-23 13:10:40', '2022-03-23 13:10:40'),
(1020, 'upload/products/1648041047_SHARP CHEDDAR _ HAM CROQUE MONSIEUR.jpg', '2022-03-23 13:10:47', '2022-03-23 13:10:47'),
(1021, 'upload/products/1648041110_JALAPINOS _CHICKEN SLIDER.jpg', '2022-03-23 13:11:50', '2022-03-23 13:11:50'),
(1022, 'upload/products/1648041129_EXOTIC VEG AND CHEESE SLIDER.jpg', '2022-03-23 13:12:09', '2022-03-23 13:12:09'),
(1023, 'upload/products/1648041145_EXOTIC VEG AND CHEESE SLIDER.jpg', '2022-03-23 13:12:25', '2022-03-23 13:12:25'),
(1024, 'upload/products/1648041171_QUESADILLA 2.jpg', '2022-03-23 13:12:51', '2022-03-23 13:12:51'),
(1025, 'upload/products/1648041243_Farm Delight Pizza.jpg', '2022-03-23 13:14:03', '2022-03-23 13:14:03'),
(1026, 'upload/products/1648041548_scoch egg.jpg', '2022-03-23 13:19:08', '2022-03-23 13:19:08'),
(1027, 'upload/products/1648041767_scoch egg.jpg', '2022-03-23 13:22:47', '2022-03-23 13:22:47'),
(1028, 'upload/products/1648099599_THAI SPRING ROLL.jpg', '2022-03-24 05:26:39', '2022-03-24 05:26:39'),
(1029, 'upload/products/1648104821_SBEER150_KINGFISHER-GLASS-removebg-preview.png', '2022-03-24 06:53:41', '2022-03-24 06:53:41'),
(1030, 'upload/products/1648104828_SBEER150_KINGFISHER-GLASS-removebg-preview.png', '2022-03-24 06:53:48', '2022-03-24 06:53:48'),
(1031, 'upload/products/1648105024_Beer.jpg', '2022-03-24 06:57:04', '2022-03-24 06:57:04'),
(1032, 'upload/products/1648105028_Beer.jpg', '2022-03-24 06:57:08', '2022-03-24 06:57:08'),
(1033, 'upload/products/1648105980_Beer 2.png', '2022-03-24 07:13:00', '2022-03-24 07:13:00'),
(1034, 'upload/products/1648105983_Beer 2.png', '2022-03-24 07:13:03', '2022-03-24 07:13:03'),
(1035, 'upload/products/1648106474_Beer 2.png', '2022-03-24 07:21:14', '2022-03-24 07:21:14'),
(1036, 'upload/products/1648106482_Beer 2.png', '2022-03-24 07:21:22', '2022-03-24 07:21:22'),
(1037, 'upload/products/1648109096_img640-x-360.jpg', '2022-03-24 08:04:56', '2022-03-24 08:04:56'),
(1038, 'upload/products/1648109101_img640-x-360.jpg', '2022-03-24 08:05:01', '2022-03-24 08:05:01'),
(1039, 'upload/products/1648116297_Beer 2.png', '2022-03-24 10:04:57', '2022-03-24 10:04:57'),
(1040, 'upload/products/1648116301_Beer 2.png', '2022-03-24 10:05:01', '2022-03-24 10:05:01'),
(1041, 'upload/products/1648116367_SBEER150_KINGFISHER-GLASS-removebg-preview.png', '2022-03-24 10:06:07', '2022-03-24 10:06:07'),
(1042, 'upload/products/1648116371_SBEER150_KINGFISHER-GLASS-removebg-preview.png', '2022-03-24 10:06:11', '2022-03-24 10:06:11'),
(1043, 'upload/products/1648116448_Beer 2.png', '2022-03-24 10:07:28', '2022-03-24 10:07:28'),
(1044, 'upload/products/1648116451_Beer 2.png', '2022-03-24 10:07:31', '2022-03-24 10:07:31'),
(1045, 'upload/products/1648116695_Beer 2.png', '2022-03-24 10:11:35', '2022-03-24 10:11:35'),
(1046, 'upload/products/1648116726_Kingfisher_beer_logo.png', '2022-03-24 10:12:06', '2022-03-24 10:12:06'),
(1047, 'upload/products/1648116747_SBEER150_KINGFISHER-GLASS-removebg-preview.png', '2022-03-24 10:12:27', '2022-03-24 10:12:27'),
(1048, 'upload/products/1648116755_SBEER150 KINGFISHER-GLASS.jpg', '2022-03-24 10:12:35', '2022-03-24 10:12:35'),
(1049, 'upload/products/1648116763_SBEER150 KINGFISHER-GLASS.jpg', '2022-03-24 10:12:43', '2022-03-24 10:12:43'),
(1050, 'upload/products/1648116765_Kingfisher_beer_logo.png', '2022-03-24 10:12:45', '2022-03-24 10:12:45'),
(1051, 'upload/products/1648116933_Beer 2.png', '2022-03-24 10:15:33', '2022-03-24 10:15:33'),
(1052, 'upload/products/1648117306_Beer 2.png', '2022-03-24 10:21:46', '2022-03-24 10:21:46'),
(1053, 'upload/products/1648117309_Kingfisher_beer_logo.png', '2022-03-24 10:21:49', '2022-03-24 10:21:49'),
(1054, 'upload/products/1648118630_Lager.png', '2022-03-24 10:43:50', '2022-03-24 10:43:50'),
(1055, 'upload/products/1648118640_IPA.png', '2022-03-24 10:44:00', '2022-03-24 10:44:00'),
(1056, 'upload/products/1648118658_Cloud Black.png', '2022-03-24 10:44:18', '2022-03-24 10:44:18'),
(1057, 'upload/products/1648118681_Hefeweizen.png', '2022-03-24 10:44:41', '2022-03-24 10:44:41'),
(1058, 'upload/products/1648118767_Belgian Wit.png', '2022-03-24 10:46:07', '2022-03-24 10:46:07'),
(1059, 'upload/products/1648118794_Cloud Black.png', '2022-03-24 10:46:34', '2022-03-24 10:46:34'),
(1060, 'upload/products/1648119583_Apple Cider.png', '2022-03-24 10:59:43', '2022-03-24 10:59:43'),
(1061, 'upload/products/1648123044_Tandoori Roti.jpg', '2022-03-24 11:57:24', '2022-03-24 11:57:24'),
(1062, 'upload/products/1648123103_mirch paratha.jpg', '2022-03-24 11:58:23', '2022-03-24 11:58:23'),
(1063, 'upload/products/1648123121_naan.jpg', '2022-03-24 11:58:41', '2022-03-24 11:58:41'),
(1064, 'upload/products/1648123144_laccha paratha.jpg', '2022-03-24 11:59:04', '2022-03-24 11:59:04'),
(1065, 'upload/products/1648123168_Steam Rice.jpg', '2022-03-24 11:59:28', '2022-03-24 11:59:28'),
(1066, 'upload/products/1648123283_Liquid Chocolate Muffin.jpg', '2022-03-24 12:01:23', '2022-03-24 12:01:23'),
(1067, 'upload/products/1648123413_Hyderabadi Murg Dum Biryani.jpg', '2022-03-24 12:03:33', '2022-03-24 12:03:33'),
(1068, 'upload/products/1648123436_Hyderabadi Murg Dum Biryani.jpg', '2022-03-24 12:03:56', '2022-03-24 12:03:56'),
(1069, 'upload/products/1648123777_Hyderabadi   Biryani veg.jpg', '2022-03-24 12:09:37', '2022-03-24 12:09:37'),
(1070, 'upload/products/1648123836_Dal Makhani.jpg', '2022-03-24 12:10:36', '2022-03-24 12:10:36'),
(1071, 'upload/products/1648123881_Dal Makhani.jpg', '2022-03-24 12:11:21', '2022-03-24 12:11:21'),
(1072, 'upload/products/1648123919_TAWA MASALA CHICKEN.jpg', '2022-03-24 12:11:59', '2022-03-24 12:11:59'),
(1073, 'upload/products/1648123954_Butter Chicken.jpg', '2022-03-24 12:12:34', '2022-03-24 12:12:34'),
(1074, 'upload/products/1648123978_Egg Bhurji.jpg', '2022-03-24 12:12:58', '2022-03-24 12:12:58'),
(1075, 'upload/products/1648124013_Delhi 6.jpg', '2022-03-24 12:13:33', '2022-03-24 12:13:33'),
(1076, 'upload/products/1648124039_Paneer Chilli.jpg', '2022-03-24 12:13:59', '2022-03-24 12:13:59'),
(1077, 'upload/products/1648124107_Burger Non Veg.jpg', '2022-03-24 12:15:07', '2022-03-24 12:15:07'),
(1078, 'upload/products/1648124123_Burger Veg.jpg', '2022-03-24 12:15:23', '2022-03-24 12:15:23'),
(1079, 'upload/products/1648124144_Pulled Chicken In Mojo Rojo Panino.jpg', '2022-03-24 12:15:44', '2022-03-24 12:15:44'),
(1080, 'upload/products/1648124186_Chicken Tikka Pizza.jpg', '2022-03-24 12:16:26', '2022-03-24 12:16:26'),
(1081, 'upload/products/1648124207_Hot Veggie Pizza.jpg', '2022-03-24 12:16:47', '2022-03-24 12:16:47'),
(1082, 'upload/products/1648124223_Caesar Salad.jpg', '2022-03-24 12:17:03', '2022-03-24 12:17:03'),
(1083, 'upload/products/1648124860_Smoked C Pizza.jpg', '2022-03-24 12:27:40', '2022-03-24 12:27:40'),
(1084, 'upload/products/1648124959_Farm Delight Pizza.jpg', '2022-03-24 12:29:19', '2022-03-24 12:29:19'),
(1085, 'upload/products/1648124969_Farm Delight Pizza.jpg', '2022-03-24 12:29:29', '2022-03-24 12:29:29'),
(1086, 'upload/products/1648124992_Non veg platter.jpg', '2022-03-24 12:29:52', '2022-03-24 12:29:52'),
(1087, 'upload/products/1648125035_BEETROOT HALWA CANOLI WITH RABRI FOAM 1.jpg', '2022-03-24 12:30:35', '2022-03-24 12:30:35'),
(1088, 'upload/products/1648125041_Non veg platter.jpg', '2022-03-24 12:30:41', '2022-03-24 12:30:41'),
(1089, 'upload/products/1648125056_Non sharebale paltter.jpg', '2022-03-24 12:30:56', '2022-03-24 12:30:56'),
(1090, 'upload/products/1648125077_Tandoori full  Half.jpg', '2022-03-24 12:31:17', '2022-03-24 12:31:17'),
(1091, 'upload/products/1648125104_Tandoori full  Half.jpg', '2022-03-24 12:31:44', '2022-03-24 12:31:44'),
(1092, 'upload/products/1648125191_Chocolate Mud Slide.jpeg', '2022-03-24 12:33:11', '2022-03-24 12:33:11'),
(1093, 'upload/products/1648125225_korean chciken wings.jpg', '2022-03-24 12:33:45', '2022-03-24 12:33:45'),
(1094, 'upload/products/1648125240_Amritsari fish tikka.jpg', '2022-03-24 12:34:00', '2022-03-24 12:34:00'),
(1095, 'upload/products/1648125256_Seekh o seelkh.jpg', '2022-03-24 12:34:16', '2022-03-24 12:34:16'),
(1096, 'upload/products/1648125277_Murg angara tikka.jpg', '2022-03-24 12:34:37', '2022-03-24 12:34:37'),
(1097, 'upload/products/1648125296_Spicky Rock Chicken Fingers.jpg', '2022-03-24 12:34:56', '2022-03-24 12:34:56'),
(1098, 'upload/products/1648125312_WOK TOSSED CHICKEN AND CHILLI.jpg', '2022-03-24 12:35:12', '2022-03-24 12:35:12'),
(1099, 'upload/products/1648125328_Smoke mushroom guloti.jpg', '2022-03-24 12:35:28', '2022-03-24 12:35:28'),
(1100, 'upload/products/1648125345_Jungli Paneer Tikka .jpg', '2022-03-24 12:35:45', '2022-03-24 12:35:45'),
(1101, 'upload/products/1648125377_GINGER PANEER CHILLI AND PEPPERS.jpg', '2022-03-24 12:36:17', '2022-03-24 12:36:17'),
(1102, 'upload/products/1648125397_Chilli Cheese Cigar Roll.jpg', '2022-03-24 12:36:37', '2022-03-24 12:36:37'),
(1103, 'upload/products/1648125431_Chicken Popcorn.jpg', '2022-03-24 12:37:11', '2022-03-24 12:37:11'),
(1104, 'upload/products/1648125515_Chicken Shami Kebab.jpg', '2022-03-24 12:38:35', '2022-03-24 12:38:35'),
(1105, 'upload/products/1648125544_Dahi ke kebab.jpg', '2022-03-24 12:39:04', '2022-03-24 12:39:04'),
(1106, 'upload/products/1648125563_Tandoori Roti.jpg', '2022-03-24 12:39:23', '2022-03-24 12:39:23'),
(1107, 'upload/products/1648125579_mirch paratha.jpg', '2022-03-24 12:39:39', '2022-03-24 12:39:39'),
(1108, 'upload/products/1648125661_naan.jpg', '2022-03-24 12:41:01', '2022-03-24 12:41:01'),
(1109, 'upload/products/1648125674_laccha paratha.jpg', '2022-03-24 12:41:14', '2022-03-24 12:41:14'),
(1110, 'upload/products/1648125690_Steam Rice.jpg', '2022-03-24 12:41:30', '2022-03-24 12:41:30'),
(1111, 'upload/products/1648125721_Chocolate Mud Slide.jpeg', '2022-03-24 12:42:01', '2022-03-24 12:42:01'),
(1112, 'upload/products/1648125752_Hyderabadi Murg Dum Biryani.jpg', '2022-03-24 12:42:32', '2022-03-24 12:42:32'),
(1113, 'upload/products/1648125775_Hyderabadi   Biryani veg.jpg', '2022-03-24 12:42:55', '2022-03-24 12:42:55'),
(1114, 'upload/products/1648125797_Dal Makhani.jpg', '2022-03-24 12:43:17', '2022-03-24 12:43:17'),
(1115, 'upload/products/1648125817_TAWA MASALA CHICKEN.jpg', '2022-03-24 12:43:37', '2022-03-24 12:43:37'),
(1116, 'upload/products/1648125834_Butter Chicken.jpg', '2022-03-24 12:43:54', '2022-03-24 12:43:54'),
(1117, 'upload/products/1648125847_Egg Bhurji.jpg', '2022-03-24 12:44:07', '2022-03-24 12:44:07'),
(1118, 'upload/products/1648125865_Delhi 6.jpg', '2022-03-24 12:44:25', '2022-03-24 12:44:25'),
(1119, 'upload/products/1648125907_Burger Non Veg.jpg', '2022-03-24 12:45:07', '2022-03-24 12:45:07'),
(1120, 'upload/products/1648125934_Burger Veg.jpg', '2022-03-24 12:45:34', '2022-03-24 12:45:34'),
(1121, 'upload/products/1648125950_Delhi 6.jpg', '2022-03-24 12:45:50', '2022-03-24 12:45:50'),
(1122, 'upload/products/1648125965_Pulled Chicken In Mojo Rojo Panino.jpg', '2022-03-24 12:46:05', '2022-03-24 12:46:05'),
(1123, 'upload/products/1648126019_Chicken Tikka Pizza.jpg', '2022-03-24 12:46:59', '2022-03-24 12:46:59'),
(1124, 'upload/products/1648126048_THAI CHILLI NOODLE 1.jpg', '2022-03-24 12:47:28', '2022-03-24 12:47:28'),
(1125, 'upload/products/1648126070_Hot Veggie Pizza.jpg', '2022-03-24 12:47:50', '2022-03-24 12:47:50'),
(1126, 'upload/products/1648126092_Smoked C Pizza.jpg', '2022-03-24 12:48:12', '2022-03-24 12:48:12'),
(1127, 'upload/products/1648126123_Farm Delight Pizza.jpg', '2022-03-24 12:48:43', '2022-03-24 12:48:43'),
(1128, 'upload/products/1648126156_Caesar Salad.jpg', '2022-03-24 12:49:16', '2022-03-24 12:49:16'),
(1129, 'upload/products/1648126181_SINGAPOREAN BURNT GARLIC FRIED RICE 1.jpg', '2022-03-24 12:49:41', '2022-03-24 12:49:41'),
(1130, 'upload/products/1648126204_Non veg platter.jpg', '2022-03-24 12:50:04', '2022-03-24 12:50:04'),
(1131, 'upload/products/1648126265_Non sharebale paltter.jpg', '2022-03-24 12:51:05', '2022-03-24 12:51:05'),
(1132, 'upload/products/1648126282_Tandoori full  Half.jpg', '2022-03-24 12:51:22', '2022-03-24 12:51:22'),
(1133, 'upload/products/1648126343_Tandoori full  Half.jpg', '2022-03-24 12:52:23', '2022-03-24 12:52:23'),
(1134, 'upload/products/1648126359_korean chciken wings.jpg', '2022-03-24 12:52:39', '2022-03-24 12:52:39'),
(1135, 'upload/products/1648126378_Amritsari fish tikka.jpg', '2022-03-24 12:52:58', '2022-03-24 12:52:58'),
(1136, 'upload/products/1648126394_Seekh o seelkh.jpg', '2022-03-24 12:53:14', '2022-03-24 12:53:14'),
(1137, 'upload/products/1648126410_MALASIAN  CURRY BOWL 1.jpg', '2022-03-24 12:53:30', '2022-03-24 12:53:30'),
(1138, 'upload/products/1648126426_Murg angara tikka.jpg', '2022-03-24 12:53:46', '2022-03-24 12:53:46'),
(1139, 'upload/products/1648126441_BALINESE CURRY BOWL 1.jpg', '2022-03-24 12:54:01', '2022-03-24 12:54:01'),
(1140, 'upload/products/1648126456_Spicky Rock Chicken Fingers.jpg', '2022-03-24 12:54:16', '2022-03-24 12:54:16'),
(1141, 'upload/products/1648126469_BALINESE CURRY BOWL 2.jpg', '2022-03-24 12:54:29', '2022-03-24 12:54:29'),
(1142, 'upload/products/1648126491_BALINESE CURRY BOWL 1.jpg', '2022-03-24 12:54:51', '2022-03-24 12:54:51'),
(1143, 'upload/products/1648126503_BALINESE CURRY BOWL 3.jpg', '2022-03-24 12:55:03', '2022-03-24 12:55:03'),
(1144, 'upload/products/1648126517_WOK TOSSED CHICKEN AND CHILLI.jpg', '2022-03-24 12:55:17', '2022-03-24 12:55:17'),
(1145, 'upload/products/1648126537_SINGAPORE CURRY BOWL 1.jpg', '2022-03-24 12:55:37', '2022-03-24 12:55:37'),
(1146, 'upload/products/1648126556_Smoke mushroom guloti.jpg', '2022-03-24 12:55:56', '2022-03-24 12:55:56'),
(1147, 'upload/products/1648126601_Smoked C Pizza.jpg', '2022-03-24 12:56:41', '2022-03-24 12:56:41'),
(1148, 'upload/products/1648126614_Farm Delight Pizza.jpg', '2022-03-24 12:56:54', '2022-03-24 12:56:54'),
(1149, 'upload/products/1648126643_SAILORS FAVOURITE FISH OYESTER CHILLI.jpg', '2022-03-24 12:57:23', '2022-03-24 12:57:23'),
(1150, 'upload/products/1648126668_Jungli Paneer Tikka .jpg', '2022-03-24 12:57:48', '2022-03-24 12:57:48'),
(1151, 'upload/products/1648126683_GINGER PANEER CHILLI AND PEPPERS.jpg', '2022-03-24 12:58:03', '2022-03-24 12:58:03'),
(1152, 'upload/products/1648126700_STYLISH SALTIMBOCCA.jpg', '2022-03-24 12:58:20', '2022-03-24 12:58:20'),
(1153, 'upload/products/1648126719_Chilli Cheese Cigar Roll.jpg', '2022-03-24 12:58:39', '2022-03-24 12:58:39'),
(1154, 'upload/products/1648126742_Chicken Popcorn.jpg', '2022-03-24 12:59:02', '2022-03-24 12:59:02'),
(1155, 'upload/products/1648126760_Chicken Shami Kebab.jpg', '2022-03-24 12:59:20', '2022-03-24 12:59:20'),
(1156, 'upload/products/1648126788_Dahi ke kebab.jpg', '2022-03-24 12:59:48', '2022-03-24 12:59:48'),
(1157, 'upload/products/1648210934_kingfisher lager.png', '2022-03-25 12:22:14', '2022-03-25 12:22:14'),
(1158, 'upload/products/1648211211_Blenders pride.png', '2022-03-25 12:26:51', '2022-03-25 12:26:51'),
(1159, 'upload/products/1648211373_kingfisher premium.png', '2022-03-25 12:29:33', '2022-03-25 12:29:33'),
(1160, 'upload/products/1648211418_kingfisher lager.png', '2022-03-25 12:30:18', '2022-03-25 12:30:18'),
(1161, 'upload/products/1648211494_blenders-pride logo.png', '2022-03-25 12:31:34', '2022-03-25 12:31:34'),
(1162, 'upload/products/1648211759_Blenders pride.png', '2022-03-25 12:35:59', '2022-03-25 12:35:59'),
(1163, 'upload/products/1648211764_blenders-pride logo.png', '2022-03-25 12:36:04', '2022-03-25 12:36:04'),
(1164, 'upload/products/1648211817_kingfisher strong.png', '2022-03-25 12:36:57', '2022-03-25 12:36:57'),
(1165, 'upload/products/1648211916_kingfisher logo.png', '2022-03-25 12:38:36', '2022-03-25 12:38:36'),
(1166, 'upload/products/1648211959_kingfisher logo.png', '2022-03-25 12:39:19', '2022-03-25 12:39:19'),
(1167, 'upload/products/1648212020_kingfisher logo.png', '2022-03-25 12:40:20', '2022-03-25 12:40:20'),
(1168, 'upload/products/1648212035_Black & white whisky.png', '2022-03-25 12:40:35', '2022-03-25 12:40:35'),
(1169, 'upload/products/1648212048_black white logo.png', '2022-03-25 12:40:48', '2022-03-25 12:40:48'),
(1170, 'upload/products/1648212076_kingfisher logo.png', '2022-03-25 12:41:16', '2022-03-25 12:41:16'),
(1171, 'upload/products/1648212111_kingfisher logo.png', '2022-03-25 12:41:51', '2022-03-25 12:41:51'),
(1172, 'upload/products/1648212151_kingfisher ultra.png', '2022-03-25 12:42:31', '2022-03-25 12:42:31'),
(1173, 'upload/products/1648212161_kingfisher logo.png', '2022-03-25 12:42:41', '2022-03-25 12:42:41'),
(1174, 'upload/products/1648212226_100 pipers.png', '2022-03-25 12:43:46', '2022-03-25 12:43:46'),
(1175, 'upload/products/1648212238_100 pipers logo.png', '2022-03-25 12:43:58', '2022-03-25 12:43:58'),
(1176, 'upload/products/1648212699_kingfisher strong.png', '2022-03-25 12:51:39', '2022-03-25 12:51:39'),
(1177, 'upload/products/1648212708_kingfisher logo.png', '2022-03-25 12:51:48', '2022-03-25 12:51:48'),
(1178, 'upload/products/1648212783_Jw red label.png', '2022-03-25 12:53:03', '2022-03-25 12:53:03'),
(1179, 'upload/products/1648212792_Jw red label logo.png', '2022-03-25 12:53:12', '2022-03-25 12:53:12'),
(1180, 'upload/products/1648212880_Jim beam.png', '2022-03-25 12:54:40', '2022-03-25 12:54:40'),
(1181, 'upload/products/1648212893_Jim Beam Logo.png', '2022-03-25 12:54:53', '2022-03-25 12:54:53'),
(1182, 'upload/products/1648212979_Ballantines.png', '2022-03-25 12:56:19', '2022-03-25 12:56:19'),
(1183, 'upload/products/1648212989_Ballantines logo.png', '2022-03-25 12:56:29', '2022-03-25 12:56:29'),
(1184, 'upload/products/1648213086_kingfisher premium.png', '2022-03-25 12:58:06', '2022-03-25 12:58:06'),
(1185, 'upload/products/1648213098_kingfisher logo.png', '2022-03-25 12:58:18', '2022-03-25 12:58:18'),
(1186, 'upload/products/1648213112_Black dog centenary.jpg.png', '2022-03-25 12:58:32', '2022-03-25 12:58:32'),
(1187, 'upload/products/1648213242_Black dog centenary logo.png', '2022-03-25 13:00:42', '2022-03-25 13:00:42'),
(1188, 'upload/products/1648213281_Budweiser.png', '2022-03-25 13:01:21', '2022-03-25 13:01:21'),
(1189, 'upload/products/1648213297_budweiser-logo.png', '2022-03-25 13:01:37', '2022-03-25 13:01:37'),
(1190, 'upload/products/1648213393_Teachers highland cream.png', '2022-03-25 13:03:13', '2022-03-25 13:03:13'),
(1191, 'upload/products/1648213431_Teachers Highland Cream_ Logo.png', '2022-03-25 13:03:51', '2022-03-25 13:03:51'),
(1192, 'upload/products/1648213485_Heineken.png', '2022-03-25 13:04:45', '2022-03-25 13:04:45'),
(1193, 'upload/products/1648213493_Heineken.png', '2022-03-25 13:04:53', '2022-03-25 13:04:53'),
(1194, 'upload/products/1648213506_Heineken Logo.png', '2022-03-25 13:05:06', '2022-03-25 13:05:06'),
(1195, 'upload/products/1648213523_teachers 50.png', '2022-03-25 13:05:23', '2022-03-25 13:05:23'),
(1196, 'upload/products/1648213528_teachers 50 logo.png', '2022-03-25 13:05:28', '2022-03-25 13:05:28'),
(1197, 'upload/products/1648213664_jameson.png', '2022-03-25 13:07:44', '2022-03-25 13:07:44'),
(1198, 'upload/products/1648213675_jameson logo.png', '2022-03-25 13:07:55', '2022-03-25 13:07:55'),
(1199, 'upload/products/1648213796_Blue moon.png', '2022-03-25 13:09:56', '2022-03-25 13:09:56'),
(1200, 'upload/products/1648213813_Blue moon logo.png', '2022-03-25 13:10:13', '2022-03-25 13:10:13'),
(1201, 'upload/products/1648213823_jw black label.png', '2022-03-25 13:10:23', '2022-03-25 13:10:23'),
(1202, 'upload/products/1648213838_Jw black label logo.png', '2022-03-25 13:10:38', '2022-03-25 13:10:38'),
(1203, 'upload/products/1648213954_chivas 12 years.png', '2022-03-25 13:12:34', '2022-03-25 13:12:34'),
(1204, 'upload/products/1648213971_chivas 12 years logo.png', '2022-03-25 13:12:51', '2022-03-25 13:12:51'),
(1205, 'upload/products/1648214001_Bro code.png', '2022-03-25 13:13:21', '2022-03-25 13:13:21'),
(1206, 'upload/products/1648214012_Brocode logo.png', '2022-03-25 13:13:32', '2022-03-25 13:13:32'),
(1207, 'upload/products/1648214099_Corona.png', '2022-03-25 13:14:59', '2022-03-25 13:14:59'),
(1208, 'upload/products/1648214099_jack daniels.png', '2022-03-25 13:14:59', '2022-03-25 13:14:59'),
(1209, 'upload/products/1648214111_jack daniels logo.png', '2022-03-25 13:15:11', '2022-03-25 13:15:11'),
(1210, 'upload/products/1648214124_Corona logo.png', '2022-03-25 13:15:24', '2022-03-25 13:15:24'),
(1211, 'upload/products/1648214258_glenlivet 12.png', '2022-03-25 13:17:38', '2022-03-25 13:17:38'),
(1212, 'upload/products/1648214268_glenlivet 12 logo.png', '2022-03-25 13:17:48', '2022-03-25 13:17:48'),
(1213, 'upload/products/1648214375_Hoegaarden.png', '2022-03-25 13:19:35', '2022-03-25 13:19:35'),
(1214, 'upload/products/1648214398_Hoegaarden logo.png', '2022-03-25 13:19:58', '2022-03-25 13:19:58'),
(1215, 'upload/products/1648214446_Old Monk.png', '2022-03-25 13:20:46', '2022-03-25 13:20:46'),
(1216, 'upload/products/1648214453_Old Monk logo.png', '2022-03-25 13:20:53', '2022-03-25 13:20:53'),
(1217, 'upload/products/1648214514_Bacardi black rum.png', '2022-03-25 13:21:54', '2022-03-25 13:21:54'),
(1218, 'upload/products/1648214542_Bacardi logo.png', '2022-03-25 13:22:22', '2022-03-25 13:22:22'),
(1219, 'upload/products/1648214636_Bacardi white rum.png', '2022-03-25 13:23:56', '2022-03-25 13:23:56'),
(1220, 'upload/products/1648214643_Bacardi logo.png', '2022-03-25 13:24:03', '2022-03-25 13:24:03'),
(1221, 'upload/products/1648214762_Smirnoff vodka.png', '2022-03-25 13:26:02', '2022-03-25 13:26:02'),
(1222, 'upload/products/1648214772_Smirnoff vodka logo.png', '2022-03-25 13:26:12', '2022-03-25 13:26:12'),
(1223, 'upload/products/1648214834_beefeater gin.png', '2022-03-25 13:27:14', '2022-03-25 13:27:14'),
(1224, 'upload/products/1648214843_beefeater london dry gin logo.png', '2022-03-25 13:27:23', '2022-03-25 13:27:23'),
(1225, 'upload/products/1648214947_bombay sapphire.png', '2022-03-25 13:29:07', '2022-03-25 13:29:07'),
(1226, 'upload/products/1648214954_Bombay Sapphire logo.png', '2022-03-25 13:29:14', '2022-03-25 13:29:14'),
(1227, 'upload/products/1648214974_Absolut.png', '2022-03-25 13:29:34', '2022-03-25 13:29:34'),
(1228, 'upload/products/1648214981_Absolut logo.png', '2022-03-25 13:29:41', '2022-03-25 13:29:41'),
(1229, 'upload/products/1648215150_camino silver.png', '2022-03-25 13:32:30', '2022-03-25 13:32:30'),
(1230, 'upload/products/1648215159_camino silver logo.png', '2022-03-25 13:32:39', '2022-03-25 13:32:39'),
(1231, 'upload/products/1648215280_jagermeister.png', '2022-03-25 13:34:40', '2022-03-25 13:34:40'),
(1232, 'upload/products/1648215309_Grey goose.png', '2022-03-25 13:35:09', '2022-03-25 13:35:09'),
(1233, 'upload/products/1648215320_Grey Goose Logo.png', '2022-03-25 13:35:20', '2022-03-25 13:35:20'),
(1234, 'upload/products/1648215390_jagermeister logo.png', '2022-03-25 13:36:30', '2022-03-25 13:36:30'),
(1235, 'upload/products/1648444250_Kingfisher Lager mug.png', '2022-03-28 05:10:50', '2022-03-28 05:10:50'),
(1236, 'upload/products/1648444261_kingfisher logo.png', '2022-03-28 05:11:01', '2022-03-28 05:11:01'),
(1237, 'upload/products/1648444429_kingfisher strong mug.png', '2022-03-28 05:13:49', '2022-03-28 05:13:49'),
(1238, 'upload/products/1648444436_kingfisher logo.png', '2022-03-28 05:13:56', '2022-03-28 05:13:56'),
(1239, 'upload/products/1648444588_Belgian Wit Beer.png', '2022-03-28 05:16:28', '2022-03-28 05:16:28'),
(1240, 'upload/products/1648444618_Belgian Wit.png', '2022-03-28 05:16:58', '2022-03-28 05:16:58'),
(1241, 'upload/products/1648445092_Cloud Black.png', '2022-03-28 05:24:52', '2022-03-28 05:24:52'),
(1242, 'upload/products/1648445106_Cloud Black.png', '2022-03-28 05:25:06', '2022-03-28 05:25:06'),
(1243, 'upload/products/1648445298_Kolsch Lager.png', '2022-03-28 05:28:18', '2022-03-28 05:28:18'),
(1244, 'upload/products/1648445337_Lager.png', '2022-03-28 05:28:57', '2022-03-28 05:28:57'),
(1245, 'upload/products/1648445489_kingfisher premium.png', '2022-03-28 05:31:29', '2022-03-28 05:31:29'),
(1246, 'upload/products/1648445518_kingfisher logo.png', '2022-03-28 05:31:58', '2022-03-28 05:31:58'),
(1247, 'upload/products/1648445718_kingfisher strong.png', '2022-03-28 05:35:18', '2022-03-28 05:35:18'),
(1248, 'upload/products/1648445726_Kingfisher Lager mug.png', '2022-03-28 05:35:26', '2022-03-28 05:35:26'),
(1249, 'upload/products/1648445736_kingfisher logo.png', '2022-03-28 05:35:36', '2022-03-28 05:35:36'),
(1250, 'upload/products/1648445825_Blenders pride.png', '2022-03-28 05:37:05', '2022-03-28 05:37:05'),
(1251, 'upload/products/1648445826_kingfisher ultra.png', '2022-03-28 05:37:06', '2022-03-28 05:37:06'),
(1252, 'upload/products/1648445834_kingfisher logo.png', '2022-03-28 05:37:14', '2022-03-28 05:37:14'),
(1253, 'upload/products/1648445839_blenders-pride logo.png', '2022-03-28 05:37:19', '2022-03-28 05:37:19'),
(1254, 'upload/products/1648445945_Black & white whisky.png', '2022-03-28 05:39:05', '2022-03-28 05:39:05'),
(1255, 'upload/products/1648445965_black white logo.png', '2022-03-28 05:39:25', '2022-03-28 05:39:25'),
(1256, 'upload/products/1648446004_Budweiser.png', '2022-03-28 05:40:04', '2022-03-28 05:40:04'),
(1257, 'upload/products/1648446018_budweiser-logo.png', '2022-03-28 05:40:18', '2022-03-28 05:40:18'),
(1258, 'upload/products/1648446075_100 pipers.png', '2022-03-28 05:41:15', '2022-03-28 05:41:15'),
(1259, 'upload/products/1648446085_Heineken.png', '2022-03-28 05:41:25', '2022-03-28 05:41:25'),
(1260, 'upload/products/1648446086_100 pipers logo.png', '2022-03-28 05:41:26', '2022-03-28 05:41:26'),
(1261, 'upload/products/1648446093_Heineken Logo.png', '2022-03-28 05:41:33', '2022-03-28 05:41:33'),
(1262, 'upload/products/1648446182_Blue moon.png', '2022-03-28 05:43:02', '2022-03-28 05:43:02'),
(1263, 'upload/products/1648446192_Blue moon logo.png', '2022-03-28 05:43:12', '2022-03-28 05:43:12'),
(1264, 'upload/products/1648446412_Bro code.png', '2022-03-28 05:46:52', '2022-03-28 05:46:52'),
(1265, 'upload/products/1648446425_Bro code logo.png', '2022-03-28 05:47:05', '2022-03-28 05:47:05'),
(1266, 'upload/products/1648446433_Brocode logo.png', '2022-03-28 05:47:13', '2022-03-28 05:47:13'),
(1267, 'upload/products/1648446498_Corona.png', '2022-03-28 05:48:18', '2022-03-28 05:48:18'),
(1268, 'upload/products/1648446502_Jw red label.png', '2022-03-28 05:48:22', '2022-03-28 05:48:22'),
(1269, 'upload/products/1648446509_Corona logo.png', '2022-03-28 05:48:29', '2022-03-28 05:48:29'),
(1270, 'upload/products/1648446527_Jw red label logo.png', '2022-03-28 05:48:47', '2022-03-28 05:48:47'),
(1271, 'upload/products/1648446583_Hoegaarden.png', '2022-03-28 05:49:43', '2022-03-28 05:49:43'),
(1272, 'upload/products/1648446586_Jim beam.png', '2022-03-28 05:49:46', '2022-03-28 05:49:46'),
(1273, 'upload/products/1648446590_Hoegaarden logo.png', '2022-03-28 05:49:50', '2022-03-28 05:49:50'),
(1274, 'upload/products/1648446593_Jim Beam Logo.png', '2022-03-28 05:49:53', '2022-03-28 05:49:53'),
(1275, 'upload/products/1648446664_Ballantines.png', '2022-03-28 05:51:04', '2022-03-28 05:51:04'),
(1276, 'upload/products/1648446672_Ballantines logo.png', '2022-03-28 05:51:12', '2022-03-28 05:51:12'),
(1277, 'upload/products/1648446767_Old Monk.png', '2022-03-28 05:52:47', '2022-03-28 05:52:47'),
(1278, 'upload/products/1648446776_Old Monk logo.png', '2022-03-28 05:52:56', '2022-03-28 05:52:56'),
(1279, 'upload/products/1648446902_Black dog centenary.jpg.png', '2022-03-28 05:55:02', '2022-03-28 05:55:02'),
(1280, 'upload/products/1648446910_Black dog centenary logo.png', '2022-03-28 05:55:10', '2022-03-28 05:55:10'),
(1281, 'upload/products/1648447024_Teachers highland cream.png', '2022-03-28 05:57:04', '2022-03-28 05:57:04'),
(1282, 'upload/products/1648447040_Teachers Highland Cream_ Logo.png', '2022-03-28 05:57:20', '2022-03-28 05:57:20'),
(1283, 'upload/products/1648447131_teachers 50.png', '2022-03-28 05:58:51', '2022-03-28 05:58:51'),
(1284, 'upload/products/1648447137_teachers 50 logo.png', '2022-03-28 05:58:57', '2022-03-28 05:58:57'),
(1285, 'upload/products/1648447212_jameson.png', '2022-03-28 06:00:12', '2022-03-28 06:00:12'),
(1286, 'upload/products/1648447218_jameson logo.png', '2022-03-28 06:00:18', '2022-03-28 06:00:18'),
(1287, 'upload/products/1648447306_jw black label.png', '2022-03-28 06:01:46', '2022-03-28 06:01:46'),
(1288, 'upload/products/1648447313_Jw black label logo.png', '2022-03-28 06:01:53', '2022-03-28 06:01:53'),
(1289, 'upload/products/1648447333_Bacardi black rum.png', '2022-03-28 06:02:13', '2022-03-28 06:02:13'),
(1290, 'upload/products/1648447339_Bacardi logo.png', '2022-03-28 06:02:19', '2022-03-28 06:02:19'),
(1291, 'upload/products/1648447395_chivas 12 years.png', '2022-03-28 06:03:15', '2022-03-28 06:03:15'),
(1292, 'upload/products/1648447403_chivas 12 years logo.png', '2022-03-28 06:03:23', '2022-03-28 06:03:23'),
(1293, 'upload/products/1648447542_Bacardi white rum.png', '2022-03-28 06:05:42', '2022-03-28 06:05:42'),
(1294, 'upload/products/1648447547_Bacardi logo.png', '2022-03-28 06:05:47', '2022-03-28 06:05:47'),
(1295, 'upload/products/1648447631_jack daniels.png', '2022-03-28 06:07:11', '2022-03-28 06:07:11'),
(1296, 'upload/products/1648447638_jack daniels logo.png', '2022-03-28 06:07:18', '2022-03-28 06:07:18'),
(1297, 'upload/products/1648447917_glenlivet 12.png', '2022-03-28 06:11:57', '2022-03-28 06:11:57'),
(1298, 'upload/products/1648447935_glenlivet 12 logo.png', '2022-03-28 06:12:15', '2022-03-28 06:12:15'),
(1299, 'upload/products/1648448000_beefeater london dry gin logo.png', '2022-03-28 06:13:20', '2022-03-28 06:13:20'),
(1300, 'upload/products/1648448002_Smirnoff vodka.png', '2022-03-28 06:13:22', '2022-03-28 06:13:22'),
(1301, 'upload/products/1648448009_beefeater gin.png', '2022-03-28 06:13:29', '2022-03-28 06:13:29'),
(1302, 'upload/products/1648448009_Smirnoff vodka logo.png', '2022-03-28 06:13:29', '2022-03-28 06:13:29'),
(1303, 'upload/products/1648448016_beefeater london dry gin logo.png', '2022-03-28 06:13:36', '2022-03-28 06:13:36'),
(1304, 'upload/products/1648448080_bombay sapphire.png', '2022-03-28 06:14:40', '2022-03-28 06:14:40'),
(1305, 'upload/products/1648448085_Bombay Sapphire logo.png', '2022-03-28 06:14:45', '2022-03-28 06:14:45'),
(1306, 'upload/products/1648448172_camino silver.png', '2022-03-28 06:16:12', '2022-03-28 06:16:12'),
(1307, 'upload/products/1648448176_camino silver logo.png', '2022-03-28 06:16:16', '2022-03-28 06:16:16'),
(1308, 'upload/products/1648448260_Absolut.png', '2022-03-28 06:17:40', '2022-03-28 06:17:40'),
(1309, 'upload/products/1648448263_jagermeister.png', '2022-03-28 06:17:43', '2022-03-28 06:17:43'),
(1310, 'upload/products/1648448266_Absolut logo.png', '2022-03-28 06:17:46', '2022-03-28 06:17:46'),
(1311, 'upload/products/1648448268_jagermeister logo.png', '2022-03-28 06:17:48', '2022-03-28 06:17:48'),
(1312, 'upload/products/1648448384_Grey goose.png', '2022-03-28 06:19:44', '2022-03-28 06:19:44'),
(1313, 'upload/products/1648448392_Grey Goose Logo.png', '2022-03-28 06:19:52', '2022-03-28 06:19:52'),
(1314, 'upload/products/1648448396_breezer.png', '2022-03-28 06:19:56', '2022-03-28 06:19:56'),
(1315, 'upload/products/1648448407_Bacardi logo.png', '2022-03-28 06:20:07', '2022-03-28 06:20:07'),
(1316, 'upload/products/1648448834_cosmopolitan.png', '2022-03-28 06:27:14', '2022-03-28 06:27:14'),
(1317, 'upload/products/1648449008_Brew Cafe_White Logo_Powai.png', '2022-03-28 06:30:08', '2022-03-28 06:30:08'),
(1318, 'upload/products/1648449153_mojito cocktail.png', '2022-03-28 06:32:33', '2022-03-28 06:32:33'),
(1319, 'upload/products/1648449163_Brew Cafe_White Logo_Powai.png', '2022-03-28 06:32:43', '2022-03-28 06:32:43'),
(1320, 'upload/products/1648449229_classic margarita.png', '2022-03-28 06:33:49', '2022-03-28 06:33:49'),
(1321, 'upload/products/1648449235_Brew Cafe_White Logo_Powai.png', '2022-03-28 06:33:55', '2022-03-28 06:33:55'),
(1322, 'upload/products/1648449243_Bird Cage.jpg', '2022-03-28 06:34:03', '2022-03-28 06:34:03'),
(1323, 'upload/products/1648449255_Brew Cafe_White Logo_Powai.png', '2022-03-28 06:34:15', '2022-03-28 06:34:15'),
(1324, 'upload/products/1648449508_Brew Cafe_White Logo_Powai.png', '2022-03-28 06:38:28', '2022-03-28 06:38:28'),
(1325, 'upload/products/1648449524_flavoured iced tea.png', '2022-03-28 06:38:44', '2022-03-28 06:38:44'),
(1326, 'upload/products/1648449613_jager bomb.png', '2022-03-28 06:40:13', '2022-03-28 06:40:13'),
(1327, 'upload/products/1648449627_Brew Cafe_White Logo_Powai.png', '2022-03-28 06:40:27', '2022-03-28 06:40:27'),
(1328, 'upload/products/1648449984_jacobs creek.png', '2022-03-28 06:46:24', '2022-03-28 06:46:24'),
(1329, 'upload/products/1648449991_Jacobs Creek logo.png', '2022-03-28 06:46:31', '2022-03-28 06:46:31'),
(1330, 'upload/products/1648450105_grover zampa.jpg', '2022-03-28 06:48:25', '2022-03-28 06:48:25'),
(1331, 'upload/products/1648450111_grover zampa logo.png', '2022-03-28 06:48:31', '2022-03-28 06:48:31'),
(1332, 'upload/products/1648450339_jacobs creek.png', '2022-03-28 06:52:19', '2022-03-28 06:52:19'),
(1333, 'upload/products/1648450457_jacobs creek.png', '2022-03-28 06:54:17', '2022-03-28 06:54:17'),
(1334, 'upload/products/1648450464_Jacobs Creek logo.png', '2022-03-28 06:54:24', '2022-03-28 06:54:24'),
(1335, 'upload/products/1648450560_teachers 50 logo.png', '2022-03-28 06:56:00', '2022-03-28 06:56:00'),
(1336, 'upload/products/1648450580_The Cure.jpg', '2022-03-28 06:56:20', '2022-03-28 06:56:20'),
(1337, 'upload/products/1648450603_Brew Cafe_White Logo_Powai.png', '2022-03-28 06:56:43', '2022-03-28 06:56:43'),
(1338, 'upload/products/1648450752_fresh lemon soda.png', '2022-03-28 06:59:12', '2022-03-28 06:59:12'),
(1339, 'upload/products/1648450754_Brew Cafe_White Logo_Powai.png', '2022-03-28 06:59:14', '2022-03-28 06:59:14'),
(1340, 'upload/products/1648450760_Brew Cafe_White Logo_Powai.png', '2022-03-28 06:59:20', '2022-03-28 06:59:20'),
(1341, 'upload/products/1648450817_fresh lemon soda.png', '2022-03-28 07:00:17', '2022-03-28 07:00:17'),
(1342, 'upload/products/1648450826_Brew Cafe_White Logo_Powai.png', '2022-03-28 07:00:26', '2022-03-28 07:00:26'),
(1343, 'upload/products/1648450830_Brew Cafe_White Logo_Powai.png', '2022-03-28 07:00:30', '2022-03-28 07:00:30'),
(1344, 'upload/products/1648450845_The Cure.jpg', '2022-03-28 07:00:45', '2022-03-28 07:00:45'),
(1345, 'upload/products/1648451157_fresh lemon soda.png', '2022-03-28 07:05:57', '2022-03-28 07:05:57'),
(1346, 'upload/products/1648451175_Brew Cafe_White Logo_Powai.png', '2022-03-28 07:06:15', '2022-03-28 07:06:15'),
(1347, 'upload/products/1648451609_fresh lemon soda.png', '2022-03-28 07:13:29', '2022-03-28 07:13:29'),
(1348, 'upload/products/1648451620_Brew Cafe_White Logo_Powai.png', '2022-03-28 07:13:40', '2022-03-28 07:13:40'),
(1349, 'upload/products/1648452367_packaged dinking water.jpg', '2022-03-28 07:26:07', '2022-03-28 07:26:07'),
(1350, 'upload/products/1648452376_Brew Cafe_White Logo_Powai.png', '2022-03-28 07:26:16', '2022-03-28 07:26:16'),
(1351, 'upload/banners/1648553165_Banner 1.jpg', '2022-03-29 11:26:05', '2022-03-29 11:26:05'),
(1352, 'upload/banners/1648553192_Banner 2.jpg', '2022-03-29 11:26:32', '2022-03-29 11:26:32'),
(1353, 'upload/banners/1648553199_Banner 3.jpg', '2022-03-29 11:26:39', '2022-03-29 11:26:39'),
(1354, 'upload/products/1649076140_download.jpg', '2022-04-04 12:42:20', '2022-04-04 12:42:20'),
(1355, 'upload/products/1649076148_343979-sepik_1920x1080.jpg', '2022-04-04 12:42:28', '2022-04-04 12:42:28'),
(1356, 'upload/products/1649076301_download.jpg', '2022-04-04 12:45:01', '2022-04-04 12:45:01'),
(1357, 'upload/products/1649076330_343979-sepik_1920x1080.jpg', '2022-04-04 12:45:30', '2022-04-04 12:45:30'),
(1358, 'upload/offers/1649401699_277534488_142621011604379_3008017114991287255_n.jpg', '2022-04-08 07:08:19', '2022-04-08 07:08:19'),
(1359, 'upload/offers/1649401733_277580266_141868348346312_4709004062229634068_n.jpg', '2022-04-08 07:08:53', '2022-04-08 07:08:53'),
(1360, 'upload/offers/1649401772_277534488_142621011604379_3008017114991287255_n.jpg', '2022-04-08 07:09:32', '2022-04-08 07:09:32'),
(1361, 'upload/offers/1649402207_277763433_141002601766472_3201669097988860336_n.jpg', '2022-04-08 07:16:47', '2022-04-08 07:16:47'),
(1362, 'upload/banners/1659695634_Website banner 3rd page (2).webp', '2022-08-05 10:33:54', '2022-08-05 10:33:54'),
(1363, 'upload/banners/1659695662_Website banner 1st page (2).webp', '2022-08-05 10:34:22', '2022-08-05 10:34:22'),
(1364, 'upload/banners/1659695679_Website banner 2nd page (2).webp', '2022-08-05 10:34:39', '2022-08-05 10:34:39'),
(1365, 'upload/products/1660046681_Mushroom chattinad pizza.jpg', '2022-08-09 12:04:41', '2022-08-09 12:04:41'),
(1366, 'upload/products/1660046795_Mushroom chattinad pizza.jpg', '2022-08-09 12:06:35', '2022-08-09 12:06:35'),
(1367, 'upload/products/1660046952_Mushroom chattinad pizza.jpg', '2022-08-09 12:09:12', '2022-08-09 12:09:12'),
(1368, 'upload/products/1660047006_Mushroom chattinad pizza.jpg', '2022-08-09 12:10:06', '2022-08-09 12:10:06'),
(1369, 'upload/products/1660047047_Farm Delight Pizza.jpg', '2022-08-09 12:10:47', '2022-08-09 12:10:47'),
(1370, 'upload/products/1660047111_Website banner 3rd page (2).jpg', '2022-08-09 12:11:51', '2022-08-09 12:11:51'),
(1371, 'upload/products/1660047193_WhatsApp Image 2022-08-09 at 5.42.46 PM.jpeg', '2022-08-09 12:13:13', '2022-08-09 12:13:13'),
(1372, 'upload/products/1660047200_WhatsApp Image 2022-08-09 at 5.42.46 PM.jpeg', '2022-08-09 12:13:20', '2022-08-09 12:13:20'),
(1373, 'upload/products/1660053005_WhatsApp Image 2022-08-09 at 5.42.46 PM.jpeg', '2022-08-09 13:50:05', '2022-08-09 13:50:05'),
(1374, 'upload/products/1660053012_WhatsApp Image 2022-08-09 at 5.42.46 PM.jpeg', '2022-08-09 13:50:12', '2022-08-09 13:50:12'),
(1375, 'upload/products/1660719661_Classic Margherita.png', '2022-08-17 07:01:01', '2022-08-17 07:01:01'),
(1376, 'upload/products/1660719787_Classic Margherita.png', '2022-08-17 07:03:07', '2022-08-17 07:03:07'),
(1377, 'upload/products/1660722722_642_logo.png', '2022-08-17 07:52:02', '2022-08-17 07:52:02'),
(1378, 'upload/products/1660724926_642_logo.png', '2022-08-17 08:28:46', '2022-08-17 08:28:46'),
(1379, 'upload/products/1660725084_642_logo.png', '2022-08-17 08:31:24', '2022-08-17 08:31:24'),
(1380, 'upload/products/1660725087_642_logo.png', '2022-08-17 08:31:27', '2022-08-17 08:31:27'),
(1381, 'upload/products/1660725480_Classic Margherita.png', '2022-08-17 08:38:00', '2022-08-17 08:38:00'),
(1382, 'upload/products/1660727533_Classic Margherita.png', '2022-08-17 09:12:13', '2022-08-17 09:12:13'),
(1383, 'upload/products/1660727538_Classic Margherita.png', '2022-08-17 09:12:18', '2022-08-17 09:12:18'),
(1384, 'upload/products/1660732334_Mushroom chattinad pizza.png', '2022-08-17 10:32:14', '2022-08-17 10:32:14'),
(1385, 'upload/products/1660732979_Tandoori Chicken Tikka Pizza.png', '2022-08-17 10:42:59', '2022-08-17 10:42:59'),
(1386, 'upload/products/1660732987_Tandoori Paneer Pizza.png', '2022-08-17 10:43:07', '2022-08-17 10:43:07'),
(1387, 'upload/products/1660732991_Tandoori Paneer Pizza.png', '2022-08-17 10:43:11', '2022-08-17 10:43:11'),
(1388, 'upload/products/1660733295_Farm Delight Pizza.png', '2022-08-17 10:48:15', '2022-08-17 10:48:15'),
(1389, 'upload/products/1660733498_Smoked Chicken Pizza.png', '2022-08-17 10:51:38', '2022-08-17 10:51:38'),
(1390, 'upload/products/1660735413_Tandoori Paneer Pizza.png', '2022-08-17 11:23:33', '2022-08-17 11:23:33'),
(1391, 'upload/products/1660735420_Tandoori Chicken Tikka Pizza.png', '2022-08-17 11:23:40', '2022-08-17 11:23:40'),
(1392, 'upload/products/1660736128_SINGAPORE CURRY BOWL.png', '2022-08-17 11:35:28', '2022-08-17 11:35:28'),
(1393, 'upload/products/1660736492_SINGAPORE CURRY BOWL.png', '2022-08-17 11:41:32', '2022-08-17 11:41:32'),
(1394, 'upload/products/1660737447_CHICKEN IN SMOKED CHILLI SAUCE.png', '2022-08-17 11:57:27', '2022-08-17 11:57:27'),
(1395, 'upload/products/1660738562_CHICKEN IN SMOKED CHILLI SAUCE.png', '2022-08-17 12:16:02', '2022-08-17 12:16:02'),
(1396, 'bell.mp3', NULL, NULL),
(1397, 'upload/products/1661778513_Wild Mushroom Chettinad Pizza.jpg', '2022-08-29 13:08:33', '2022-08-29 13:08:33'),
(1398, 'upload/products/1661778593_Farm Delight Pizza.jpg', '2022-08-29 13:09:53', '2022-08-29 13:09:53'),
(1399, 'upload/products/1661778751_Smoked Chicken, Mozerella Bianca Pizza.jpg', '2022-08-29 13:12:31', '2022-08-29 13:12:31'),
(1400, 'upload/products/1661778832_Tandoori Chicken Pizza.jpg', '2022-08-29 13:13:52', '2022-08-29 13:13:52'),
(1401, 'upload/products/1661779181_Margherita Pizza.jpg', '2022-08-29 13:19:41', '2022-08-29 13:19:41'),
(1402, 'upload/products/1661779243_Tandoori Paneer Pizza.jpg', '2022-08-29 13:20:43', '2022-08-29 13:20:43'),
(1403, 'upload/products/1661779732_Killar Kadhai paneer.jpg', '2022-08-29 13:28:52', '2022-08-29 13:28:52'),
(1404, 'upload/products/1661779767_Tandoori Paneer Pizza.jpg', '2022-08-29 13:29:27', '2022-08-29 13:29:27'),
(1405, 'upload/products/1661779778_Tandoori Paneer Pizza.jpg', '2022-08-29 13:29:38', '2022-08-29 13:29:38'),
(1406, 'upload/products/1661779790_Tandoori Paneer Pizza.jpg', '2022-08-29 13:29:50', '2022-08-29 13:29:50'),
(1407, 'upload/products/1661779850_Paneer Makhni.jpg', '2022-08-29 13:30:50', '2022-08-29 13:30:50'),
(1408, 'upload/products/1661779926_Delji 6 chicken curry.jpg', '2022-08-29 13:32:06', '2022-08-29 13:32:06'),
(1409, 'upload/products/1661779990_spicey tawa masala chicken.jpg', '2022-08-29 13:33:10', '2022-08-29 13:33:10'),
(1410, 'upload/products/1661780060_Butter chicken.jpg', '2022-08-29 13:34:20', '2022-08-29 13:34:20'),
(1411, 'upload/products/1661780121_Biryani Veg.jpg', '2022-08-29 13:35:21', '2022-08-29 13:35:21'),
(1412, 'upload/products/1661780178_Biryani Non-Veg.jpg', '2022-08-29 13:36:18', '2022-08-29 13:36:18'),
(1413, 'upload/products/1661780299_Europian Family Combo.jpg', '2022-08-29 13:38:19', '2022-08-29 13:38:19'),
(1414, 'upload/products/1661780431_1 SMALL FARM DELIGHT PIZZA.jpg', '2022-08-29 13:40:31', '2022-08-29 13:40:31'),
(1415, 'upload/products/1661780665_PANEER IN SMOKED CHILLI SAUCE WITH STEAMED RICE.jpg', '2022-08-29 13:44:25', '2022-08-29 13:44:25'),
(1416, 'upload/products/1661780743_VEG BIRYANI or MURG BIRYANI + 1 SOFT BEVERAG.jpg', '2022-08-29 13:45:43', '2022-08-29 13:45:43'),
(1417, 'upload/products/1661780923_VEG BIRYANI or MURG BIRYANI + 1 SOFT BEVERAG.jpg', '2022-08-29 13:48:43', '2022-08-29 13:48:43');
INSERT INTO `upload_images_old` (`id`, `file`, `created_at`, `updated_at`) VALUES
(1418, 'upload/products/1661781039_Kadhai Paneer + 4 Butter Roti.jpg', '2022-08-29 13:50:39', '2022-08-29 13:50:39'),
(1419, 'upload/products/1661781082_Butter chicken + 4 Butter Roti.jpg', '2022-08-29 13:51:22', '2022-08-29 13:51:22'),
(1420, 'upload/locations/1661847048_Lighthouse.jpg', '2022-08-30 08:10:48', '2022-08-30 08:10:48'),
(1421, 'upload/products/1661851804_SINGAPORE CURRY BOWl_VEG.jpg', '2022-08-30 09:30:04', '2022-08-30 09:30:04'),
(1422, 'upload/products/1661852122_SINGAPORE CURRY BOWl_NON VEG.jpg', '2022-08-30 09:35:22', '2022-08-30 09:35:22'),
(1423, 'upload/products/1661852287_Chicken in smoked chilly sauce with steamed rice.jpg', '2022-08-30 09:38:07', '2022-08-30 09:38:07'),
(1424, 'upload/products/1661852407_Paneer in smoked chilly sauce with steamed rice.jpg', '2022-08-30 09:40:07', '2022-08-30 09:40:07'),
(1425, 'upload/products/1661853269_Taiwanese Fried Rice Egg.jpg', '2022-08-30 09:54:29', '2022-08-30 09:54:29'),
(1426, 'upload/products/1661853674_Taiwanese Fried Rice Egg.jpg', '2022-08-30 10:01:14', '2022-08-30 10:01:14'),
(1427, 'upload/products/1661853785_Taiwanese Fried Rice Tofu.jpg', '2022-08-30 10:03:05', '2022-08-30 10:03:05'),
(1428, 'upload/products/1661853870_Taiwanese Fried Rice chicken.jpg', '2022-08-30 10:04:30', '2022-08-30 10:04:30'),
(1429, 'upload/products/1661853956_Thai Chilli Noodle Egg.jpg', '2022-08-30 10:05:56', '2022-08-30 10:05:56'),
(1430, 'upload/products/1661854020_Thai Chilli Noodle Tofu.jpg', '2022-08-30 10:07:00', '2022-08-30 10:07:00'),
(1431, 'upload/products/1661854098_Thai Chilli Noodle Chicken.jpg', '2022-08-30 10:08:18', '2022-08-30 10:08:18'),
(1432, 'upload/products/1661854407_2 Veg Pizza Or Chicken Pizza + 2 Soft Beverage.jpg', '2022-08-30 10:13:27', '2022-08-30 10:13:27'),
(1433, 'upload/products/1661854524_2 Veg Pizza Or Chicken Pizza + 2 Soft Beverage.jpg', '2022-08-30 10:15:24', '2022-08-30 10:15:24'),
(1434, 'upload/products/1661854773_1 CHICKEN IN SMOKED CHILLI SAUCE WITH STEAMED RICE + 1 THAI CHILLI NOODLE CHICKEN + 1 SOFT BEVERAGE.jpg', '2022-08-30 10:19:33', '2022-08-30 10:19:33'),
(1435, 'upload/products/1661854846_1 Paneer IN SMOKED CHILLI SAUCE WITH STEAMED RICE + 1 THAI CHILLI NOODLE CHICKEN + 1 SOFT BEVERAGE.jpg', '2022-08-30 10:20:46', '2022-08-30 10:20:46'),
(1436, 'upload/products/1661855078_1 HYDERABADI VEGETABLE DUM BIRYANI + 1 KILLER KADHAI PANEER + 6 BUTTER ROTI.jpg', '2022-08-30 10:24:38', '2022-08-30 10:24:38'),
(1437, 'upload/products/1661855135_1 HYDERABADI MURG DUM BIRYANI + 1 BOMBASTIC BUTTER CHICKEN + 6 BUTTER ROTI.jpg', '2022-08-30 10:25:35', '2022-08-30 10:25:35'),
(1438, 'upload/products/1661855242_Lachha paratha.jpg', '2022-08-30 10:27:22', '2022-08-30 10:27:22'),
(1439, 'upload/products/1661855322_Naan.jpg', '2022-08-30 10:28:42', '2022-08-30 10:28:42'),
(1440, 'upload/products/1661855361_Mirch paratha.jpg', '2022-08-30 10:29:21', '2022-08-30 10:29:21'),
(1441, 'upload/products/1661855421_Tandoor Roti.jpg', '2022-08-30 10:30:21', '2022-08-30 10:30:21'),
(1442, 'upload/products/1661855478_Butter Roti.jpg', '2022-08-30 10:31:18', '2022-08-30 10:31:18'),
(1443, 'upload/products/1661855529_Khasta paratha.jpg', '2022-08-30 10:32:09', '2022-08-30 10:32:09'),
(1444, 'upload/products/1661855571_Streem rice.jpg', '2022-08-30 10:32:51', '2022-08-30 10:32:51'),
(1445, 'upload/offers/1662098658_Happy Hours.jpg', '2022-09-02 06:04:18', '2022-09-02 06:04:18'),
(1446, 'upload/offers/1662098701_Corporate Discount.jpg', '2022-09-02 06:05:01', '2022-09-02 06:05:01'),
(1447, 'upload/offers/1662098727_Dining Offer.webp', '2022-09-02 06:05:27', '2022-09-02 06:05:27'),
(1448, 'upload/offers/1662098946_1 + 1 Pizza Offer (1).jpg', '2022-09-02 06:09:06', '2022-09-02 06:09:06'),
(1449, 'upload/offers/1662100043_Growler Offer (1).jpg', '2022-09-02 06:27:23', '2022-09-02 06:27:23'),
(1450, 'upload/passport/1667457909_mockup_5.png', '2022-11-03 06:45:09', '2022-11-03 06:45:09'),
(1451, 'upload/passport/1667457955_Beer Passport.jpg', '2022-11-03 06:45:55', '2022-11-03 06:45:55'),
(1452, 'upload/passport/1667458078_Beer Passport.jpg', '2022-11-03 06:47:58', '2022-11-03 06:47:58'),
(1453, 'upload/passport/1667458176_Beer Passport.jpg', '2022-11-03 06:49:36', '2022-11-03 06:49:36'),
(1454, 'upload/passport/1667458257_Beer Passport.jpg', '2022-11-03 06:50:57', '2022-11-03 06:50:57'),
(1455, 'upload/places/1675352668_IMG_5700.jpg', '2023-02-02 15:44:28', '2023-02-02 15:44:28'),
(1456, 'upload/places/multiple/1675352719_IMG_5690.jpg', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1457, 'upload/places/multiple/1675352719_IMG_5691.jpg', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1458, 'upload/places/multiple/1675352719_IMG_5692.jpg', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1459, 'upload/places/multiple/1675352719_IMG_5694.jpg', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1460, 'upload/places/multiple/1675352719_IMG_5695.jpg', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1461, 'upload/places/multiple/1675352719_IMG_5696.jpg', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1462, 'upload/places/multiple/1675352719_IMG_5697.jpg', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1463, 'upload/places/multiple/1675352719_IMG_5698.jpg', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1464, 'upload/places/multiple/1675352719_IMG_5699.jpg', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1465, 'upload/places/multiple/1675352719_IMG_5700.jpg', '2023-02-02 15:45:19', '2023-02-02 15:45:19'),
(1466, 'upload/places/icons/1675352769_IMG_5697.jpg', '2023-02-02 15:46:09', '2023-02-02 15:46:09'),
(1467, 'upload/locations/1675352954_1640175372_pune.png', '2023-02-02 15:49:14', '2023-02-02 15:49:14'),
(1468, 'upload/places/icons/1675353248_47524baa-f883-43ef-ba92-28589513d094-min-1024x683.jpg', '2023-02-02 15:54:08', '2023-02-02 15:54:08'),
(1469, 'upload/places/1675353250_39cdd6d0-b3b5-4370-93d8-0f978eca67fb-min-1024x683.jpg', '2023-02-02 15:54:10', '2023-02-02 15:54:10'),
(1470, 'upload/places/multiple/1675353259_bdc18319-14b6-4c31-b829-6e2c054263f2-min-1024x576.png', '2023-02-02 15:54:19', '2023-02-02 15:54:19'),
(1471, 'upload/places/multiple/1675353259_39cdd6d0-b3b5-4370-93d8-0f978eca67fb-min-1024x683.jpg', '2023-02-02 15:54:19', '2023-02-02 15:54:19'),
(1472, 'upload/places/multiple/1675353259_47524baa-f883-43ef-ba92-28589513d094-min-1024x683.jpg', '2023-02-02 15:54:19', '2023-02-02 15:54:19'),
(1473, 'upload/places/multiple/1675353259_759f331c-5b70-42e6-878b-89affb961415-min-1024x576.png', '2023-02-02 15:54:19', '2023-02-02 15:54:19'),
(1474, 'upload/places/multiple/1675353259_27ff2b6a-cf9b-4067-a6a1-dcb895fc36f5-min-1024x683.jpg', '2023-02-02 15:54:19', '2023-02-02 15:54:19'),
(1475, 'upload/places/multiple/1675353259_a7a885f6-d16e-4f55-8ea2-33df862d85e3-min.jpeg', '2023-02-02 15:54:19', '2023-02-02 15:54:19'),
(1476, 'upload/places/multiple/1675353259_3be1aac9-92ca-4e71-8ea8-3792a72e12b4_rw_1200-min.jpeg', '2023-02-02 15:54:19', '2023-02-02 15:54:19'),
(1477, 'upload/places/multiple/1675353259_275b89d2-40c2-4757-a4c6-791fad0bd1de-min.jpeg', '2023-02-02 15:54:19', '2023-02-02 15:54:19'),
(1478, 'upload/places/multiple/1675353259_8441651a-88ed-456c-a136-49153d6b0be5-min.jpeg', '2023-02-02 15:54:19', '2023-02-02 15:54:19'),
(1479, 'upload/locations/1677757427_WhatsApp Image 2023-03-02 at 5.06.39 PM.jpeg', '2023-03-02 11:43:47', '2023-03-02 11:43:47'),
(1480, 'upload/locations/1677758098_WhatsApp Image 2023-03-02 at 5.06.39 PM.jpeg', '2023-03-02 11:54:58', '2023-03-02 11:54:58'),
(1481, 'upload/places/icons/1677758215_WhatsApp Image 2023-03-02 at 5.06.39 PM.jpeg', '2023-03-02 11:56:55', '2023-03-02 11:56:55'),
(1482, 'upload/places/1677758482_WhatsApp Image 2023-03-02 at 5.06.39 PM.jpeg', '2023-03-02 12:01:22', '2023-03-02 12:01:22'),
(1483, 'upload/places/icons/1677758623_WhatsApp Image 2023-03-02 at 5.06.39 PM.jpeg', '2023-03-02 12:03:43', '2023-03-02 12:03:43'),
(1484, 'upload/places/icons/1677761622__DSC0233.jpg', '2023-03-02 12:53:42', '2023-03-02 12:53:42'),
(1485, 'upload/places/1677761629__DSC0342-min.jpg', '2023-03-02 12:53:49', '2023-03-02 12:53:49'),
(1486, 'upload/places/1678275110_Screenshot_28.jpg', '2023-03-08 11:31:50', '2023-03-08 11:31:50'),
(1487, 'upload/places/multiple/1678275133_IMG_5194.jpg', '2023-03-08 11:32:13', '2023-03-08 11:32:13'),
(1488, 'upload/places/multiple/1678275133_Screenshot_30.jpg', '2023-03-08 11:32:13', '2023-03-08 11:32:13'),
(1489, 'upload/places/multiple/1678275133_Screenshot_29.jpg', '2023-03-08 11:32:13', '2023-03-08 11:32:13'),
(1490, 'upload/places/multiple/1678275133_Screenshot_28.jpg', '2023-03-08 11:32:13', '2023-03-08 11:32:13'),
(1491, 'upload/places/multiple/1678348219_Screenshot (63).png', '2023-03-09 07:50:19', '2023-03-09 07:50:19'),
(1492, 'upload/places/icons/1678348901_Screenshot (63).png', '2023-03-09 08:01:41', '2023-03-09 08:01:41'),
(1493, 'upload/places/1678348908_Screenshot (63).png', '2023-03-09 08:01:48', '2023-03-09 08:01:48'),
(1494, 'upload/places/multiple/1678453438_WhatsApp Image 2023-03-09 at 1.40.30 PM.webp', '2023-03-10 13:03:58', '2023-03-10 13:03:58'),
(1495, 'upload/places/multiple/1678453438_WhatsApp Image 2023-03-09 at 1.40.31 PM (1).webp', '2023-03-10 13:03:58', '2023-03-10 13:03:58'),
(1496, 'upload/places/multiple/1678453438_WhatsApp Image 2023-03-09 at 1.40.31 PM (2).webp', '2023-03-10 13:03:58', '2023-03-10 13:03:58'),
(1497, 'upload/places/multiple/1678453438_WhatsApp Image 2023-03-09 at 1.40.31 PM.webp', '2023-03-10 13:03:58', '2023-03-10 13:03:58'),
(1498, 'upload/places/multiple/1678453438_WhatsApp Image 2023-03-09 at 1.40.32 PM (1).webp', '2023-03-10 13:03:58', '2023-03-10 13:03:58'),
(1499, 'upload/places/multiple/1678453438_WhatsApp Image 2023-03-09 at 1.40.32 PM.webp', '2023-03-10 13:03:58', '2023-03-10 13:03:58'),
(1500, 'upload/places/icons/1678453458_WhatsApp Image 2023-03-09 at 1.40.32 PM (1).jpeg', '2023-03-10 13:04:18', '2023-03-10 13:04:18'),
(1501, 'upload/banners/1678693010_screencapture-localhost-phpmyadmin-index-php-2023-02-14-11_21_24.png', '2023-03-13 07:36:50', '2023-03-13 07:36:50'),
(1502, 'upload/banners/1678693018_9105_1676008355.jpg', '2023-03-13 07:36:58', '2023-03-13 07:36:58'),
(1503, 'upload/locations/1678693089_9105_1676008355.jpg', '2023-03-13 07:38:09', '2023-03-13 07:38:09'),
(1504, 'upload/places/icons/1678693141_screencapture-localhost-phpmyadmin-index-php-2023-02-14-11_21_24 (1).png', '2023-03-13 07:39:01', '2023-03-13 07:39:01'),
(1505, 'upload/places/1678693144_qrcode.png', '2023-03-13 07:39:04', '2023-03-13 07:39:04'),
(1506, 'upload/places/multiple/1678693148_9105_1676008355.jpg', '2023-03-13 07:39:08', '2023-03-13 07:39:08'),
(1507, 'upload/products/1678694234_IMG-3765.jpg', '2023-03-13 07:57:14', '2023-03-13 07:57:14'),
(1508, 'upload/passport/1678694296_3120_1675163780.jpg', '2023-03-13 07:58:16', '2023-03-13 07:58:16'),
(1509, 'upload/places/1680507032__DSC0233.webp', '2023-04-03 07:30:32', '2023-04-03 07:30:32'),
(1510, 'upload/places/icons/1680507044__DSC0253.jpg', '2023-04-03 07:30:44', '2023-04-03 07:30:44'),
(1511, 'upload/places/multiple/1681387630__DSC0233.jpg', '2023-04-13 12:07:10', '2023-04-13 12:07:10'),
(1512, 'upload/places/multiple/1681387667__DSC0391.jpg', '2023-04-13 12:07:47', '2023-04-13 12:07:47'),
(1513, 'upload/places/multiple/1681387667__DSC0294.jpg', '2023-04-13 12:07:47', '2023-04-13 12:07:47'),
(1514, 'upload/places/multiple/1681387667__DSC0342 (1).jpg', '2023-04-13 12:07:47', '2023-04-13 12:07:47'),
(1515, 'upload/places/multiple/1681387725__DSC0391.webp', '2023-04-13 12:08:45', '2023-04-13 12:08:45'),
(1516, 'upload/places/multiple/1681387725__DSC0294.webp', '2023-04-13 12:08:45', '2023-04-13 12:08:45'),
(1517, 'upload/places/multiple/1681387725__DSC0342 (1).webp', '2023-04-13 12:08:45', '2023-04-13 12:08:45'),
(1518, 'upload/places/multiple/1681387725__DSC0233.webp', '2023-04-13 12:08:45', '2023-04-13 12:08:45'),
(1519, 'upload/places/icons/1681388876_1640246987_FINAL RENDERS (1)_page-0002.jpg', '2023-04-13 12:27:56', '2023-04-13 12:27:56'),
(1520, 'upload/products/1682072504_TANDOORI POTATO TIKKA.JPG', '2023-04-21 10:21:44', '2023-04-21 10:21:44'),
(1521, 'upload/products/1682073442_WhatsApp Image 2023-04-21 at 4.05.48 PM.jpeg', '2023-04-21 10:37:22', '2023-04-21 10:37:22'),
(1522, 'upload/products/1682073583_KURKURE PALAK PATTA CHAAT.jpg', '2023-04-21 10:39:43', '2023-04-21 10:39:43'),
(1523, 'upload/products/1682073725_SZECHUAN VEGETABLE DIMSUM STEAMED.JPG', '2023-04-21 10:42:05', '2023-04-21 10:42:05'),
(1524, 'upload/products/1682073936_CRISPY LOTUS STEM HONEY CHILLI.JPG', '2023-04-21 10:45:36', '2023-04-21 10:45:36'),
(1525, 'upload/products/1682074017_CHILLY CHEESE CIGAR ROLLS.JPG', '2023-04-21 10:46:57', '2023-04-21 10:46:57'),
(1526, 'upload/products/1682074086_LOADED NACHOS.jpg', '2023-04-21 10:48:06', '2023-04-21 10:48:06'),
(1527, 'upload/products/1682074145_HONG KONG CHILLI PANEER.jpg', '2023-04-21 10:49:05', '2023-04-21 10:49:05'),
(1528, 'upload/products/1682074237_TEEKHA PANEER TIKKA.JPG', '2023-04-21 10:50:37', '2023-04-21 10:50:37'),
(1529, 'upload/products/1682074323_TEEKHA PANEER TIKKA.JPG', '2023-04-21 10:52:03', '2023-04-21 10:52:03'),
(1530, 'upload/products/1682074412_JUNGLI PANEER TIKKA.jpg', '2023-04-21 10:53:32', '2023-04-21 10:53:32'),
(1531, 'upload/products/1682074462_JUNGLI PANEER TIKKA.jpg', '2023-04-21 10:54:22', '2023-04-21 10:54:22'),
(1532, 'upload/products/1682074532_CHICKEN KOLI WADA.JPG', '2023-04-21 10:55:32', '2023-04-21 10:55:32'),
(1533, 'upload/products/1682074675_KALI MIRCH THREE CHEESE CHICKEN TIKKA.JPG', '2023-04-21 10:57:55', '2023-04-21 10:57:55'),
(1534, 'upload/products/1682074812_CHILLI TERIYAKI CHICKEN.jpg', '2023-04-21 11:00:12', '2023-04-21 11:00:12'),
(1535, 'upload/products/1682074900_CHILLI GARLIC CHICKEN DIMSUM FRIED IN WASABI SAUCE.JPG', '2023-04-21 11:01:40', '2023-04-21 11:01:40'),
(1536, 'upload/products/1682074982_CHICKEN WINGS 65.JPG', '2023-04-21 11:03:02', '2023-04-21 11:03:02'),
(1537, 'upload/products/1682075058_CHICKEN WINGS 65.JPG', '2023-04-21 11:04:18', '2023-04-21 11:04:18'),
(1538, 'upload/products/1682075130_OLD MONK CHICKEN WINGS.JPG', '2023-04-21 11:05:30', '2023-04-21 11:05:30'),
(1539, 'upload/products/1682075198_OLD MONK CHICKEN WINGS.JPG', '2023-04-21 11:06:38', '2023-04-21 11:06:38'),
(1540, 'upload/products/1682075291_CHICKEN TIKKA OUR WAY.JPG', '2023-04-21 11:08:11', '2023-04-21 11:08:11'),
(1541, 'upload/products/1682075378_OUR SIGNATURE SPICY ROCK CHICKEN FINGERS.JPG', '2023-04-21 11:09:38', '2023-04-21 11:09:38'),
(1542, 'upload/products/1682075522_AMRITSARI FISH TIKKA.jpg', '2023-04-21 11:12:02', '2023-04-21 11:12:02'),
(1543, 'upload/products/1682075873_FARM DELIGHT.JPG', '2023-04-21 11:17:53', '2023-04-21 11:17:53'),
(1544, 'upload/products/1682075970_HAWAIIAN PIZZA.JPG', '2023-04-21 11:19:30', '2023-04-21 11:19:30'),
(1545, 'upload/products/1682076054_TANDOORI PANEER PIZZA.jpg', '2023-04-21 11:20:54', '2023-04-21 11:20:54'),
(1546, 'upload/products/1682076329_SMOKED CHICKEN, MOZZARELLA BIANCA.jpg', '2023-04-21 11:25:29', '2023-04-21 11:25:29'),
(1547, 'upload/products/1682076411_GRILLED CHICKEN & PESTO PIZZA.JPG', '2023-04-21 11:26:51', '2023-04-21 11:26:51'),
(1548, 'upload/products/1682076506_PANEER SIRKA PYAAZ.JPG', '2023-04-21 11:28:26', '2023-04-21 11:28:26'),
(1549, 'upload/products/1682076787_LAHSUNIYA PALAK PANEER.JPG', '2023-04-21 11:33:07', '2023-04-21 11:33:07'),
(1550, 'upload/products/1682076863_SPICY TAWA MASALA CHICKEN.JPG', '2023-04-21 11:34:23', '2023-04-21 11:34:23'),
(1551, 'upload/products/1682076958_CHICKEN GHEE ROAST.JPG', '2023-04-21 11:35:58', '2023-04-21 11:35:58'),
(1552, 'upload/products/1682077043_DELHI 6 FAMOUS CHICKEN CURRY.jpg', '2023-04-21 11:37:23', '2023-04-21 11:37:23'),
(1553, 'upload/products/1682077109_GOAN PRAWN CURRY.jpg', '2023-04-21 11:38:29', '2023-04-21 11:38:29'),
(1554, 'upload/products/1682077453_RED THAI CURRY BOWL.jpg', '2023-04-21 11:44:13', '2023-04-21 11:44:13'),
(1555, 'upload/products/1682077519_RED THAI CURRY BOWL.jpg', '2023-04-21 11:45:19', '2023-04-21 11:45:19'),
(1556, 'upload/products/1682077603_RED THAI CURRY BOWL.jpg', '2023-04-21 11:46:43', '2023-04-21 11:46:43'),
(1557, 'upload/products/1682077682_THAI BASIL TOFU.JPG', '2023-04-21 11:48:02', '2023-04-21 11:48:02'),
(1558, 'upload/products/1682077805_THAI BASIL TOFU.JPG', '2023-04-21 11:50:05', '2023-04-21 11:50:05'),
(1559, 'upload/products/1682077883_PANEER IN SMOKED CHILLI SAUCE.JPG', '2023-04-21 11:51:23', '2023-04-21 11:51:23'),
(1560, 'upload/products/1682077993_CHICKEN IN SMOKED CHILLI SAUCE.JPG', '2023-04-21 11:53:13', '2023-04-21 11:53:13'),
(1561, 'upload/products/1682078065_VEGETABLE DUM BIRYANI.jpg', '2023-04-21 11:54:25', '2023-04-21 11:54:25'),
(1562, 'upload/products/1682078196_MURG BIRYANI.jpg', '2023-04-21 11:56:36', '2023-04-21 11:56:36'),
(1563, 'upload/products/1682078337_PENNE ALFREDO.jpg', '2023-04-21 11:58:57', '2023-04-21 11:58:57'),
(1564, 'upload/products/1682078390_PENNE ALFREDO.jpg', '2023-04-21 11:59:50', '2023-04-21 11:59:50'),
(1565, 'upload/products/1682078470_GRILLED CHICKEN BREAST WITH MIX MUSHROOM SAUCE.JPG', '2023-04-21 12:01:10', '2023-04-21 12:01:10'),
(1566, 'upload/products/1682078592_STEAM RICE.jpg', '2023-04-21 12:03:12', '2023-04-21 12:03:12'),
(1567, 'upload/products/1682078651_ROTI.jpg', '2023-04-21 12:04:11', '2023-04-21 12:04:11'),
(1568, 'upload/products/1682078689_NAAN.jpg', '2023-04-21 12:04:49', '2023-04-21 12:04:49'),
(1569, 'upload/products/1682078728_LACCHA PARATHA.jpg', '2023-04-21 12:05:28', '2023-04-21 12:05:28'),
(1570, 'upload/products/1682078759_HARI MIRCHI KA PARATHA.jpg', '2023-04-21 12:05:59', '2023-04-21 12:05:59'),
(1571, 'upload/products/1682078793_NAAN.jpg', '2023-04-21 12:06:33', '2023-04-21 12:06:33'),
(1572, 'upload/products/1682078866_CLASSIC CANNOLI WITH MASCARPONE CREAM.JPG', '2023-04-21 12:07:46', '2023-04-21 12:07:46'),
(1573, 'upload/products/1682082517_HONEY CHILLI CAULIFLOWER.jpg', '2023-04-21 13:08:37', '2023-04-21 13:08:37'),
(1574, 'upload/products/1682082575_VEGETABLE SALT AND PEPPER.jpg', '2023-04-21 13:09:35', '2023-04-21 13:09:35'),
(1575, 'upload/products/1682082634_INDO CHINESE CHILLI PANEER.jpg', '2023-04-21 13:10:34', '2023-04-21 13:10:34'),
(1576, 'upload/products/1682082687_CHICKEN POPCORN.jpg', '2023-04-21 13:11:27', '2023-04-21 13:11:27'),
(1577, 'upload/products/1682082734_INDO CHINESE CHILLI CHICKEN.jpg', '2023-04-21 13:12:14', '2023-04-21 13:12:14'),
(1578, 'upload/products/1682082810_CHILLI GARLIC CHICKEN DIMSUM STEAMED.jpg', '2023-04-21 13:13:30', '2023-04-21 13:13:30'),
(1579, 'upload/products/1682082864_SHRIMP POPCORN DUSTED WITH GUN POWDER.jpg', '2023-04-21 13:14:24', '2023-04-21 13:14:24'),
(1580, 'upload/products/1682082994_AMRITSARI FISH FINGER.jpg', '2023-04-21 13:16:34', '2023-04-21 13:16:34'),
(1581, 'upload/products/1682083062_HOT CHILLI VEGETABLES.jpg', '2023-04-21 13:17:42', '2023-04-21 13:17:42'),
(1582, 'upload/products/1682083108_CHICKEN TIKKA PIZZA.jpg', '2023-04-21 13:18:28', '2023-04-21 13:18:28'),
(1583, 'upload/products/1682083164_DAL MAKHANI.jpg', '2023-04-21 13:19:24', '2023-04-21 13:19:24'),
(1584, 'upload/products/1682083210_DAL DHABA.jpg', '2023-04-21 13:20:10', '2023-04-21 13:20:10'),
(1585, 'upload/products/1682083478_ANARDANE WALE AMRITSARI CHOLE.jpg', '2023-04-21 13:24:38', '2023-04-21 13:24:38'),
(1586, 'upload/locations/1682144973_1678702170_img4.jpg', '2023-04-22 06:29:33', '2023-04-22 06:29:33'),
(1587, 'upload/locations/1682145389_1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0002.jpg', '2023-04-22 06:36:29', '2023-04-22 06:36:29'),
(1588, 'upload/places/1682145567_1640869739_4X3A2733.jpg', '2023-04-22 06:39:27', '2023-04-22 06:39:27'),
(1589, 'upload/locations/1682145571_1640869739_4X3A2733.jpg', '2023-04-22 06:39:31', '2023-04-22 06:39:31'),
(1590, 'upload/places/icons/1682145681_1640245987_EADS_FINCH-AMR_FINAL RENDERS_30.08.2021 (1)_page-0002.jpg', '2023-04-22 06:41:21', '2023-04-22 06:41:21'),
(1591, 'upload/places/1682145686_iiec_fav.png', '2023-04-22 06:41:26', '2023-04-22 06:41:26'),
(1592, 'upload/places/multiple/1682145722_1634482586_img.jpg', '2023-04-22 06:42:02', '2023-04-22 06:42:02'),
(1593, 'upload/places/multiple/1682145729_1634482586_img.jpg', '2023-04-22 06:42:09', '2023-04-22 06:42:09'),
(1594, 'upload/places/multiple/1682145729_1634482687_img.jpg', '2023-04-22 06:42:09', '2023-04-22 06:42:09'),
(1595, 'upload/places/multiple/1682145729_1634482696_img.jpg', '2023-04-22 06:42:09', '2023-04-22 06:42:09'),
(1596, 'upload/places/multiple/1682145729_1634482707_img.jpg', '2023-04-22 06:42:09', '2023-04-22 06:42:09'),
(1597, 'upload/places/multiple/1682145729_1634559424_August-2019-The-Astrological-eMagazine.jpg', '2023-04-22 06:42:09', '2023-04-22 06:42:09'),
(1598, 'upload/places/1682145802_1678796088_img1.jpg', '2023-04-22 06:43:22', '2023-04-22 06:43:22'),
(1599, 'upload/places/1682146555_1634559424_August-2019-The-Astrological-eMagazine.jpg', '2023-04-22 06:55:55', '2023-04-22 06:55:55'),
(1600, 'upload/places/1682146575_1634559438_April-2020-The-Astrological-eMagazine.jpg', '2023-04-22 06:56:15', '2023-04-22 06:56:15'),
(1601, 'upload/places/1682146795_1634559424_August-2019-The-Astrological-eMagazine.jpg', '2023-04-22 06:59:55', '2023-04-22 06:59:55'),
(1602, 'upload/places/1682146934_1636984315_passport (2).jpg', '2023-04-22 07:02:14', '2023-04-22 07:02:14'),
(1603, 'upload/places/1682147050_1678796159_img1.jpg', '2023-04-22 07:04:10', '2023-04-22 07:04:10'),
(1604, 'upload/products/1682312009_BIRBALI KOFTA.jpg', '2023-04-24 04:53:29', '2023-04-24 04:53:29'),
(1605, 'upload/products/1682312068_PUNJABI MATAR MUSHROOM MAKHANI.jpg', '2023-04-24 04:54:28', '2023-04-24 04:54:28'),
(1606, 'upload/products/1682312148_BIHARI STYLE FISH CURRY.jpg', '2023-04-24 04:55:48', '2023-04-24 04:55:48'),
(1607, 'upload/products/1682312192_PENNE MARINARA VEG.jpg', '2023-04-24 04:56:32', '2023-04-24 04:56:32'),
(1608, 'upload/products/1682312236_PENNE MARINARA NONVEG.jpg', '2023-04-24 04:57:16', '2023-04-24 04:57:16'),
(1609, 'upload/products/1682312400_FRIES.jpg', '2023-04-24 05:00:00', '2023-04-24 05:00:00'),
(1610, 'upload/products/1682312456_PERI PERI FRIES.jpg', '2023-04-24 05:00:56', '2023-04-24 05:00:56'),
(1611, 'upload/products/1682312493_VEGETABLE RAITA.jpg', '2023-04-24 05:01:33', '2023-04-24 05:01:33'),
(1612, 'upload/products/1682506027_SZECHUAN VEGETABLE DIMSUM  FRIED IN WASABI CHEESE SAUCE.jpg', '2023-04-26 10:47:07', '2023-04-26 10:47:07'),
(1613, 'upload/products/1682506092_CHILLI GARLIC BUTTER POACHED PRAWNS.jpg', '2023-04-26 10:48:12', '2023-04-26 10:48:12'),
(1614, 'upload/products/1682506933_Red Or Green Thai Curry Bowl.jpg', '2023-04-26 11:02:13', '2023-04-26 11:02:13'),
(1615, 'upload/products/1682507022_Red Or Green Thai Curry Bowl.jpg', '2023-04-26 11:03:42', '2023-04-26 11:03:42'),
(1616, 'upload/products/1682507893_Veg Dum Biryani.jpg', '2023-04-26 11:18:13', '2023-04-26 11:18:13'),
(1617, 'upload/products/1682507937_Murg Dum Biryani.jpg', '2023-04-26 11:18:57', '2023-04-26 11:18:57'),
(1618, 'upload/products/1682508075_Red Or Green Thai Curry Bowl.jpg', '2023-04-26 11:21:15', '2023-04-26 11:21:15'),
(1619, 'upload/products/1682508894_Kolkata Gosht Biryani.jpg', '2023-04-26 11:34:54', '2023-04-26 11:34:54'),
(1620, 'upload/products/1682509001_Noodle Egg.jpg', '2023-04-26 11:36:41', '2023-04-26 11:36:41'),
(1621, 'upload/products/1682509186_THAI BASIL TOFU.JPG', '2023-04-26 11:39:46', '2023-04-26 11:39:46'),
(1622, 'upload/products/1682509320_Thai Basil Chicken.JPG', '2023-04-26 11:42:00', '2023-04-26 11:42:00'),
(1623, 'upload/products/1682509437_GREEN THAI CURRY BOWL.JPG', '2023-04-26 11:43:57', '2023-04-26 11:43:57'),
(1624, 'upload/products/1682509782_Funghi selvatici pizza.JPG', '2023-04-26 11:49:42', '2023-04-26 11:49:42'),
(1625, 'upload/products/1682510000_Finch Special Latpat Chicken.JPG', '2023-04-26 11:53:20', '2023-04-26 11:53:20'),
(1626, 'upload/products/1682510093_Mutton Rogun Josh.JPG', '2023-04-26 11:54:53', '2023-04-26 11:54:53'),
(1627, 'upload/locations/1682745557_WhatsApp Image 2023-04-29 at 10.36.10 AM.jpeg', '2023-04-29 05:19:17', '2023-04-29 05:19:17'),
(1628, 'upload/locations/1682745619_Thane Icon.png', '2023-04-29 05:20:19', '2023-04-29 05:20:19'),
(1629, 'upload/locations/1682746580_Thane Icon (1).png', '2023-04-29 05:36:20', '2023-04-29 05:36:20'),
(1630, 'upload/locations/1682747031_1640175341_mumbai.png', '2023-04-29 05:43:51', '2023-04-29 05:43:51'),
(1631, 'upload/places/1682749542_Brewhouse.png', '2023-04-29 06:25:42', '2023-04-29 06:25:42'),
(1632, 'upload/places/1682766097_Brewhouse.png', '2023-04-29 11:01:37', '2023-04-29 11:01:37'),
(1633, 'upload/places/1682766119_Finch.png', '2023-04-29 11:01:59', '2023-04-29 11:01:59'),
(1634, 'upload/places/1682766198_Finch.png', '2023-04-29 11:03:18', '2023-04-29 11:03:18'),
(1635, 'upload/places/1682766207_Brewhouse.png', '2023-04-29 11:03:27', '2023-04-29 11:03:27'),
(1636, 'upload/places/1682766215_Brewhouse.png', '2023-04-29 11:03:35', '2023-04-29 11:03:35'),
(1637, 'upload/products/1683787606_VALCANO NACHOS.jpg', '2023-05-11 06:46:46', '2023-05-11 06:46:46'),
(1638, 'upload/products/1683788982_CHILLY CHEESE CIGAR ROLLS.JPG', '2023-05-11 07:09:42', '2023-05-11 07:09:42'),
(1639, 'upload/products/1683789191_THAI VEG SPRING ROLL.jpg', '2023-05-11 07:13:11', '2023-05-11 07:13:11'),
(1640, 'upload/products/1683789342_Z’atar Spiced Chicken Cutlet.JPG', '2023-05-11 07:15:42', '2023-05-11 07:15:42'),
(1641, 'upload/products/1683789554_Crispy chicken koliwada with green apple chutney.JPG', '2023-05-11 07:19:14', '2023-05-11 07:19:14'),
(1642, 'upload/products/1683789803_Drunken Chicken Wings.JPG', '2023-05-11 07:23:23', '2023-05-11 07:23:23'),
(1643, 'upload/products/1683790131_Drunken Chicken Wings.JPG', '2023-05-11 07:28:51', '2023-05-11 07:28:51'),
(1644, 'upload/products/1683790327_Drunken Chicken Wings.JPG', '2023-05-11 07:32:07', '2023-05-11 07:32:07'),
(1645, 'upload/products/1683790492_Spicky Rock Chicken Fingers.jpg', '2023-05-11 07:34:52', '2023-05-11 07:34:52'),
(1646, 'upload/products/1683790804_FINCH_S SPECIAL INDIAN MASALA.jpg', '2023-05-11 07:40:04', '2023-05-11 07:40:04'),
(1647, 'upload/products/1683791256_English Breakfat.JPG', '2023-05-11 07:47:36', '2023-05-11 07:47:36'),
(1648, 'upload/products/1683792704_Grilled chicken in mojo rojo Sandwich.jpg', '2023-05-11 08:11:44', '2023-05-11 08:11:44'),
(1649, 'upload/products/1683795709_Classic Margherita Pizza.jpg', '2023-05-11 09:01:49', '2023-05-11 09:01:49'),
(1650, 'upload/products/1683795846_FARM DELIGHT PIZZA.jpg', '2023-05-11 09:04:06', '2023-05-11 09:04:06'),
(1651, 'upload/products/1683795975_CHICKEN TIKKA PIZZA.jpg', '2023-05-11 09:06:15', '2023-05-11 09:06:15'),
(1652, 'upload/products/1683796075_MeatBall Pizza.jpg', '2023-05-11 09:07:55', '2023-05-11 09:07:55'),
(1653, 'upload/products/1683796688_Amritsari fish n chips.jpg', '2023-05-11 09:18:08', '2023-05-11 09:18:08'),
(1654, 'upload/products/1683797736_Pasta Bowl.jpg', '2023-05-11 09:35:36', '2023-05-11 09:35:36'),
(1655, 'upload/products/1683798137_Bombastic Butter chicken platter.jpg', '2023-05-11 09:42:17', '2023-05-11 09:42:17'),
(1656, 'upload/products/1683798317_Killar Kadhai paneer.jpg', '2023-05-11 09:45:17', '2023-05-11 09:45:17'),
(1657, 'upload/products/1683898524_Killar Kadhai paneer.jpg', '2023-05-12 13:35:24', '2023-05-12 13:35:24'),
(1658, 'upload/products/1683898666_Killar Kadhai paneer.jpg', '2023-05-12 13:37:46', '2023-05-12 13:37:46'),
(1659, 'upload/products/1683898908_Thai chilli noodles.jpg', '2023-05-12 13:41:48', '2023-05-12 13:41:48'),
(1660, 'upload/products/1683899143_Thai chilli noodles.jpg', '2023-05-12 13:45:43', '2023-05-12 13:45:43'),
(1661, 'upload/products/1683899264_Thai chilli noodles.jpg', '2023-05-12 13:47:44', '2023-05-12 13:47:44'),
(1662, 'upload/products/1683899728_Garlic-bread.jpg', '2023-05-12 13:55:28', '2023-05-12 13:55:28'),
(1663, 'upload/products/1683899942_DAL MAKHANI.jpg', '2023-05-12 13:59:02', '2023-05-12 13:59:02'),
(1664, 'upload/offers/1685080379_1662098701_Corporate Discount.jpg', '2023-05-26 05:52:59', '2023-05-26 05:52:59'),
(1665, 'upload/places/1685711970_Finch.png', '2023-06-02 13:19:30', '2023-06-02 13:19:30'),
(1666, 'upload/places/1685712251_White Logo.png', '2023-06-02 13:24:11', '2023-06-02 13:24:11'),
(1667, 'upload/places/1685712263_White Logo.png', '2023-06-02 13:24:23', '2023-06-02 13:24:23'),
(1668, 'upload/places/1685712280_White Logo.png', '2023-06-02 13:24:40', '2023-06-02 13:24:40'),
(1669, 'upload/places/1685712333_Finch.png', '2023-06-02 13:25:33', '2023-06-02 13:25:33'),
(1670, 'upload/products/1690208959_login_back.jpeg', '2023-07-24 19:59:19', '2023-07-24 19:59:19'),
(1671, 'upload/products/1690209061_login_back.jpeg', '2023-07-24 20:01:01', '2023-07-24 20:01:01'),
(1672, 'upload/products/1690209064_login_back.jpeg', '2023-07-24 20:01:04', '2023-07-24 20:01:04'),
(1673, 'upload/products/1690549087_51uF0Hl2PvL.jpg', '2023-07-28 18:28:07', '2023-07-28 18:28:07'),
(1674, 'upload/products/1690549092_how-to-make-homemade-french-fries-2215971-hero-01-02f62a016f3e4aa4b41d0c27539885c3.jpg', '2023-07-28 18:28:12', '2023-07-28 18:28:12'),
(1675, 'upload/products/1690549095_how-to-make-homemade-french-fries-2215971-hero-01-02f62a016f3e4aa4b41d0c27539885c3.jpg', '2023-07-28 18:28:15', '2023-07-28 18:28:15'),
(1676, 'upload/products/1690552107_how-to-make-homemade-french-fries-2215971-hero-01-02f62a016f3e4aa4b41d0c27539885c3.jpg', '2023-07-28 19:18:27', '2023-07-28 19:18:27'),
(1677, 'upload/products/1690552112_how-to-make-homemade-french-fries-2215971-hero-01-02f62a016f3e4aa4b41d0c27539885c3.jpg', '2023-07-28 19:18:32', '2023-07-28 19:18:32'),
(1678, 'upload/products/1690552130_51uF0Hl2PvL.jpg', '2023-07-28 19:18:50', '2023-07-28 19:18:50'),
(1679, 'upload/products/1690552147_51uF0Hl2PvL.jpg', '2023-07-28 19:19:07', '2023-07-28 19:19:07'),
(1680, 'upload/products/1690552201_51uF0Hl2PvL.jpg', '2023-07-28 19:20:01', '2023-07-28 19:20:01'),
(1681, 'upload/products/1690552204_download (2).jpg', '2023-07-28 19:20:04', '2023-07-28 19:20:04'),
(1682, 'upload/products/1690552208_download (2).jpg', '2023-07-28 19:20:08', '2023-07-28 19:20:08'),
(1683, 'upload/products/1690552261_download (1).jpg', '2023-07-28 19:21:01', '2023-07-28 19:21:01'),
(1684, 'upload/products/1690552265_download (1).jpg', '2023-07-28 19:21:05', '2023-07-28 19:21:05'),
(1685, 'upload/products/1690552281_download.jpg', '2023-07-28 19:21:21', '2023-07-28 19:21:21'),
(1686, 'upload/products/1690552289_download.jpg', '2023-07-28 19:21:29', '2023-07-28 19:21:29'),
(1687, 'upload/products/1692620455_trading2.png', '2023-08-21 17:50:55', '2023-08-21 17:50:55'),
(1688, 'upload/products/1692620462_processed-490a8573-a618-4790-9f02-4710bb9b830a_dW5hsAAL.jpeg', '2023-08-21 17:51:02', '2023-08-21 17:51:02'),
(1689, 'upload/banners/1693821561_WhatsApp Image 2023-08-18 at 14.03.50.jpg', '2023-09-04 15:29:21', '2023-09-04 15:29:21'),
(1690, 'upload/banners/1693821602_WhatsApp Image 2023-08-18 at 14.03.50.jpg', '2023-09-04 15:30:02', '2023-09-04 15:30:02'),
(1691, 'upload/products/1693821801_WhatsApp Image 2023-08-18 at 14.03.50.jpg', '2023-09-04 15:33:21', '2023-09-04 15:33:21'),
(1692, 'upload/products/1693821877_unnamed (1).png', '2023-09-04 15:34:37', '2023-09-04 15:34:37'),
(1693, 'upload/banners/1693905483-.webp', '2023-09-05 14:48:04', '2023-09-05 14:48:04'),
(1694, 'upload/offers/1693905894-.webp', '2023-09-05 14:54:55', '2023-09-05 14:54:55'),
(1695, 'upload/offers/1693906064-.webp', '2023-09-05 14:57:45', '2023-09-05 14:57:45'),
(1696, 'upload/locations/1693906383-.webp', '2023-09-05 15:03:04', '2023-09-05 15:03:04'),
(1697, 'upload/places/1693906393-.webp', '2023-09-05 15:03:14', '2023-09-05 15:03:14'),
(1698, 'upload/places/multiple/1693907265_Frozen-Cold-Plunge-Background1.png', '2023-09-05 15:17:45', '2023-09-05 15:17:45'),
(1699, 'upload/places/icons/1693907298-.webp', '2023-09-05 15:18:19', '2023-09-05 15:18:19'),
(1700, 'upload/places/1693907308-.webp', '2023-09-05 15:18:29', '2023-09-05 15:18:29'),
(1701, 'upload/places/1693907319-.webp', '2023-09-05 15:18:40', '2023-09-05 15:18:40'),
(1702, 'upload/products/1693907503-.webp', '2023-09-05 15:21:44', '2023-09-05 15:21:44'),
(1703, 'upload/products/1693907545-.webp', '2023-09-05 15:22:26', '2023-09-05 15:22:26'),
(1704, 'upload/products/1693907719-.webp', '2023-09-05 15:25:19', '2023-09-05 15:25:19'),
(1705, 'upload/products/1693908324-.webp', '2023-09-05 15:35:25', '2023-09-05 15:35:25'),
(1706, 'upload/products/1693908333-.webp', '2023-09-05 15:35:33', '2023-09-05 15:35:33'),
(1707, 'upload/banners/1693908351-.webp', '2023-09-05 15:35:52', '2023-09-05 15:35:52'),
(1708, 'upload/banners/1693908820-.webp', '2023-09-05 15:43:41', '2023-09-05 15:43:41'),
(1709, 'upload/banners/1693908900-.webp', '2023-09-05 15:45:01', '2023-09-05 15:45:01'),
(1710, 'upload/passport/1694535793-.webp', '2023-09-12 21:53:13', '2023-09-12 21:53:13'),
(1711, 'upload/passport/1694536480-.webp', '2023-09-12 22:04:40', '2023-09-12 22:04:40'),
(1712, 'upload/passport/1694536621-.webp', '2023-09-12 22:07:01', '2023-09-12 22:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `age` int DEFAULT NULL,
  `otp` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `add_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `add_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_new` int NOT NULL DEFAULT '0',
  `is_old` int NOT NULL DEFAULT '0' COMMENT '0->New, 1->Old',
  `login_pin` int NOT NULL,
  `type` int NOT NULL DEFAULT '0',
  `orderType` int NOT NULL DEFAULT '0' COMMENT '0="delivery order",1="dine-in order",2="takeaway"',
  `passport_order` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `age`, `otp`, `status`, `remember_token`, `created_at`, `updated_at`, `add_by`, `add_by_id`, `updated_by`, `updated_by_id`, `is_new`, `is_old`, `login_pin`, `type`, `orderType`, `passport_order`) VALUES
(817, 'SUNITA GEORGE', '999@GMAIL.COM', NULL, '$2y$10$fHvLEtgswVafkFyD8bE1/Oh.79e1Ec0ly.eXZ.U625Dzu7Gyajb5G', '9870003347', NULL, NULL, 1, NULL, '2023-11-02 19:22:56', '2023-11-02 19:22:56', 'Admin', '1', '', '', 0, 1, 1234, 0, 0, 0),
(818, 'SANTOSH KUMAR', '888@GMAIL.COM', NULL, '$2y$10$G53TxEx3gRkvpTalWHhPwuDLHMMBcIidUjtT1lv91HG.7uupBh/bq', '9937148144', NULL, NULL, 1, NULL, '2023-11-02 20:05:47', '2023-11-02 20:05:47', 'Admin', '1', '', '', 0, 1, 1234, 0, 0, 0),
(820, 'SUNNY RAMCHANDRA', '111@GMAIL.COM', NULL, '$2y$10$Atn5zBn3PbzuI1R2yUHkXe5K/1sBFvPt6N03edPmblkjEsl4nB9dy', '7738262078', NULL, NULL, 1, NULL, '2023-11-02 20:20:43', '2023-11-02 20:20:43', 'Admin', '1', '', '', 0, 1, 1234, 0, 0, 0),
(821, 'GAURAV MEHTA', '222@GMAIL.COM', NULL, '$2y$10$gzANVtCGv9goAe2l2K4ETuR2Ha2cqdqBTBXbS2Zi/VE1Pn13hyZhK', '9967070780', NULL, NULL, 1, NULL, '2023-11-02 20:34:26', '2023-11-02 20:34:26', 'Admin', '1', '', '', 0, 1, 1234, 0, 0, 0),
(822, 'MANISH R', '000@GMAIL.COM', NULL, '$2y$10$H7uaZxme2njyAUmNptUwHumkB8yFGejaOl6xkzf2tsM7nTexwVBda', '9892733330', NULL, NULL, 1, NULL, '2023-11-02 20:39:31', '2023-11-02 20:39:31', 'Admin', '1', '', '', 0, 1, 1234, 0, 0, 0),
(823, 'K.V IYER', '333@GMAIL.COM', NULL, '$2y$10$GNeYCkxQNlavR.avsPbNwOWmBX/X7QZlX9WmmWNOiSqnvqtiEzwtu', '9619906172', NULL, NULL, 1, NULL, '2023-11-02 20:48:10', '2023-11-02 20:48:10', 'Admin', '1', '', '', 0, 1, 1234, 0, 0, 0),
(824, 'VINAY KUTUR', '444@GMAIL.COM', NULL, '$2y$10$eKyE5eXkhtC5Q1aN5Bt2NOP5fyHi6HuY4LxmQRuYrgmx023b5MgX.', '9820261355', NULL, NULL, 1, NULL, '2023-11-02 20:53:43', '2023-11-02 20:53:43', 'Admin', '1', '', '', 0, 1, 1234, 0, 0, 0),
(825, 'TANUJA DEVADIGA', '555@GMAIL.COM', NULL, '$2y$10$Va0SxspxNfXxOb0rm0AmfuIBELaZNbsvQn7n9XxekH2y9Fz5lrVrC', '9867212676', NULL, NULL, 1, NULL, '2023-11-02 21:01:06', '2023-11-02 21:01:06', 'Admin', '1', '', '', 0, 1, 1234, 0, 0, 0),
(826, 'VAINEY SEHGAZ', '666@GMAIL.COM', NULL, '$2y$10$f0BtducrlW/Lv3s9BRjgx.Zl7RZ7Q3GXvsQniBFqsFcelaNUHT5S6', '7506587005', NULL, NULL, 1, NULL, '2023-11-02 21:09:35', '2023-11-02 21:09:35', 'Admin', '1', '', '', 0, 1, 1234, 0, 0, 0),
(827, 'HIMANSHU OBEROI', '777@GMAIL.COM', NULL, '$2y$10$5BRh3H.jgFnvkDriC8ZrsOpNfhju4eAWaOHxjW.0rh38/FW/.gzVW', '9766998855', NULL, NULL, 1, NULL, '2023-11-02 21:38:37', '2023-11-02 21:38:37', 'Admin', '1', '', '', 0, 1, 1234, 0, 0, 0),
(828, 'ANKIT GUPTA', '1212@GMAIL.COM', NULL, '$2y$10$8N.BJKcb4mKZFdze/ALvRe0TjDpX7LA5HC7tkZw87yveqOTOPZj8i', '7304467801', NULL, NULL, 1, NULL, '2023-11-02 23:03:52', '2023-11-02 23:03:52', 'Admin', '1', '', '', 0, 1, 1234, 0, 0, 0),
(829, 'ARSHDEEP', '1010@GMAIL.COM', NULL, '$2y$10$GyTj3HCGEESm.JQanNPEZeVrRhL839C047u./96duoEogjo5BCV0W', '7307079944', NULL, NULL, 1, NULL, '2023-11-02 23:08:02', '2023-11-02 23:08:02', 'Admin', '1', '', '', 0, 1, 1234, 0, 0, 0),
(830, 'ANUBHAV', '0202@GMAIL.COM', NULL, '$2y$10$963V6c5z9H1y0jGw0AuJiucG51Djsf5fa8QdORsbWY998rIAIbhiy', '9819651280', NULL, NULL, 1, NULL, '2023-11-02 23:13:23', '2023-11-02 23:13:23', 'Admin', '1', '', '', 0, 1, 1234, 0, 0, 0),
(831, 'BIJU KUTTY', 'BIJYKITTY@GMAIL.COM', NULL, '$2y$10$974oj0kBGDPaiwO8xuF7z.eQZMySCayObHCAexeS1JRwcwhKque4O', '9930834527', NULL, NULL, 1, NULL, '2023-11-02 23:29:48', '2023-11-02 23:29:48', 'Admin', '1', '', '', 0, 1, 1234, 0, 0, 0),
(832, 'MR.BHUPESH', '6565@GMAIL.COM', NULL, '$2y$10$Pb0ivI4luCLXDtqUJXDzXeF30bgkJcMi/CEAc/n.yMvMk9upnFwdq', '9969544824', NULL, NULL, 1, NULL, '2023-11-02 23:38:42', '2023-11-02 23:38:42', 'Admin', '1', '', '', 0, 1, 1234, 0, 0, 0),
(833, 'ROHIT SULE', '3131@GMAIL.COM', NULL, '$2y$10$a.m9ji.KF7QHbr7t4h4OAePIYHBoBDTmQBEmgUpAeIkGxsoC1rjNS', '9820606840', NULL, NULL, 1, NULL, '2023-11-03 18:56:21', '2023-11-03 18:56:21', 'Admin', '1', '', '', 0, 1, 1234, 0, 0, 0),
(834, 'Devesh Sati', 'theyvesh@gmail.com', NULL, NULL, '9833478240', 37, '5680', 1, NULL, '2023-11-07 12:42:35', '2023-11-07 15:09:12', '', '', '', '', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_enquiry`
--

CREATE TABLE `user_enquiry` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_enquiry`
--

INSERT INTO `user_enquiry` (`id`, `name`, `email`, `phone`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Neeraj 34', 'malakar.neeraj@gmail.com', '7485963210', 'hello', '1640100156', '1640100156'),
(2, 'Nikhil Tekwani', 'nikhil_tekwani@yahoo.in', '9890545222', 'Hello,\r\n\r\nMy name is Nikhil and I visited your cafe in Powai on 20th of November 2021. While doing the payment of 2067/- there was an error with the swipe machine and the first attempt didn\'t go through, but the 2nd attempt was successful. My account is debited with 2067/- twice and I have also contacted someone regarding the issue but got no response. I can share the account statement if you want for cross reference. I request you kindly transfer 2067/- to the accoun details mentioned below.\r\n\r\nUPI ID: 9890545222@sbi\r\nNikhil Ashok Tekwani\r\nState Bank Of India Ulhasnagar \r\nSavings A/c No. 38147178860\r\nIFSC Code. SBIN0001202\r\n\r\nRegards,\r\nNikhil Tekwani', '1641126728', '1641126728'),
(3, 'Rakesh Kumar', 'rakesh.ccdkumar@gmail.com', '9888939790', 'Hi i want contact no of concerned person of Finch Brew cafe for job apply.', '1641221282', '1641221282'),
(4, 'Sandya Ravi', 'sandyaravi85@gmail.com', '9703677326', 'I want open branch in my loction  kurnool andhra pradesh', '1641577869', '1641577869'),
(5, 'Pratik Dudani', 'pratikdudani@gmail.com', '8291187796', 'Hi team,\r\n\r\nI’m unable to contact you on any of your numbers and there is no response. I’ve placed an order on your website and have no update on the delivery. Please contact me ASAP', '1641631434', '1641631434'),
(6, 'Vamshi', 'vams.sparkle@gmail.com', '9966559109', 'Looking for Franchise details. Could you please call me', '1642060721', '1642060721'),
(7, 'Manoj', 'manojsws5@gmail.com', '8827589430', 'hey', '1642666862', '1642666862'),
(8, 'Abhishek', 'jain@gmail.com', '7400077778', 'Can you please stop sending promotional sms everyday to my number? I would not like to receive any future sms from you. Thanks! \r\n\r\nNumber - 7400077778', '1642669631', '1642669631'),
(9, 'Ravneet Kaur', 'nanah21@gmail.com', '9888498870', 'Need to book my kitty on 12th feb from 3.15 pm till 6 pm', '1643696815', '1643696815'),
(10, 'Mrs SHARMA', 'naveensarti@gmail.com', '7696030396', 'Want to book a table for 14th Feb in Jalandar Punjab', '1644411051', '1644411051'),
(11, 'QUAFF', 'hey@quaff.in', '8657661621', 'Hey there, \r\n\r\nWe love your space and the vibe, to which we would love to have our band SAAZ perform at your venue. We our bollywood set-list is loved at various spaces such as MH04 Thane and more. Waiting here from you and find a gig space. \r\n\r\nBest Regards, \r\nTeam QUAFF', '1646300721', '1646300721'),
(12, 'Susan Sobrinho', 'susan.sobrinho@ubisoft.com', '9607992871', 'Looking for package breakfast for 50 pax at Powai', '1649693272', '1649693272'),
(13, 'Jason S.', 'adi@ndmails.com', '8102440753', 'Just wanted to ask if you would be interested in getting external help with graphic design? We do all design work like banners, advertisements, photo edits, logos, flyers, etc. for a fixed monthly fee. \r\n\r\nWe don\'t charge for each task. What kind of work do you need on a regular basis? Let me know and I\'ll share my portfolio with you.', '1651563211', '1651563211'),
(14, 'Ashok Patra', 'withashok@gmail.com', '9702099674', 'I cannot see my beer passport details online.', '1651647880', '1651647880'),
(15, 'Manoj', 'manojsws5@gmail.com', '8827589430', 'test', '1651670666', '1651670666'),
(16, 'Manoj', 'manojsws5@gmail.com', '8827589430', 'test', '1651728727', '1651728727'),
(17, 'Ashutosh Kapoor', 'ashutoshkapoor.ak@gmail.com', '9780483636', 'I\'m interested in your company franchise. Kindly share your terms and conditions for association.', '1652174217', '1652174217'),
(18, 'Girish Aggarwal', 'Girish_aggarwal99@yahoo.com', '9872434000', 'We want to book', '1652859069', '1652859069'),
(19, 'Vijay Nair', 'kvijaynair@gmail.com', '9949982000', 'Team, what\'s the opening date of your Kolshet Road Thane location. We are eagerly waiting and will storm on the day of the opening with friends :)', '1657525882', '1657525882'),
(20, 'AJAY PAKTHA', 'AJAYPATHAKBHL@MAIL.COM', '8505028831', 'I WANT FRANCHISE ALL RAJASTHAN', '1657539085', '1657539085'),
(21, 'Gorish', 'gorishgupta94@gmail.com', '9501114376', 'About offers', '1659601905', '1659601905'),
(22, 'Anil Mahnori', 'mahnori@hotmail.com', '8424043567', 'I purchased two beers  1 lit *2 as a take away..but one bottle contained only 1 mug whereas the other was okay .\r\n\r\nThe quantity of the beer was very less in one of the two bottles \r\n\r\nThere seems to be a quality issue .can u pls ch ck and revert.\r\n\r\nThanks\r\nAnil', '1659629488', '1659629488'),
(23, 'Raghu', 'ragorama@yahoo.com', '9482519913', 'Dear Sir/Madam,\r\n\r\n I had bought a passport for Rs. 8,000 which ended a few weeks ago. I was supposed to get some wines and a brunch for two people. None of these are being made available to me and some nonsensical story is being given that there are no wines in the freezer. I have gone ahead and taken another passport on the belief that I would be given the benefits of the passport that is already used up. Not sure what the business model being used here is but this sounds a little too stupid. I will be hitting the social media soon writing about my experience. I have told a large number of friends about this already of course.\r\n\r\nI wonder if I will hear back from someone or if this will be conveniently ignored.', '1660232779', '1660232779'),
(24, 'Raghu', 'ragorama@yahoo.com', '9482519913', 'I sent a message yesterday. Is it a policy to not respond to customers?\r\n\r\nThanks.\r\nR', '1660308631', '1660308631'),
(25, 'RAghu', 'ragorama@yahoo.com', '9482519913', 'This is my 3rd message seeking a response to my first message. I am a Finch passport holder, so I am expecting a response.\r\n\r\nThank you. \r\nRaghu', '1660388603', '1660388603'),
(26, 'Gopal Krishan', 'singingvilla@gmail.com', '6239089985', 'Sir/Mam.......... I am a singer and I use to perform in different bars and cafe...... My band name is musafir and recently I have performed for your cafe...... The person who had booked me for the show is not providing my payment....... He said once that give us a week and now it\'s been more than a week and he is not even responding to my message....... So I request you to please look into this matter', '1660645182', '1660645182'),
(27, 'Yash Goyal', 'yashgoyal22446@gmail.com', '8755548494', 'I want your franchise for my city Jwalapur Haridwar Uttarakhand.', '1661250772', '1661250772'),
(28, 'Arjeet Kaushal', 'arjeetkaushal38@gmail.com', '8894933600', 'Urgent', '1662797230', '1662797230'),
(29, 'Gurinder Singh', 'gurinder_s@hotmail.com', '9779221669', 'Want to order for home delivery', '1664628828', '1664628828'),
(30, 'Mayank', 'mayankbhandari@yahoo.com', '9223349690', 'T', '1666428224', '1666428224'),
(31, 'Rolin Mendonca', 'rolinmendonca@gmail.com', '9820017804', 'We are given to understand that you are launching FINCH TAP CAFE at our gated Indiabulls Golf City, Savroli, Khopoli. Welcome ! Could you tell us more', '1668601146', '1668601146'),
(32, 'Manu Pathania', 'manupathania73642@gmail.com', '9357901770', 'I\'m writing to enquire about the possibility of Finch Brew Cafe leasing my site (real estate) in Jalandhar city, Punjab, India 144001 for their existing or new franchise. \r\n\r\nLocation: BSF Colony Market, Opposite HMV College, Jalandhar City, Punjab\r\nAdjacent Dominos Pizza\r\n\r\n1. Each floor area is 800 sq. ft.\r\n2. Market is on Main Road.\r\n3. Atleast 5-6 colleges and many small institutes in vicinity with access to many students and residents nearby.\r\n4. New Pizza hut and Dominos opened in this market recently.\r\n\r\nPlease feel free to write back to this email or call +91-9357901770 for more details.', '1672918505', '1672918505'),
(33, 'Pardeep Kumar', 'Vrmpardeep@gmail.com', '9876870674', 'HLo sir this side DjPardeep i got booked for 25 Christmas Amritsar and 31 Jalandhar Finchbrewcafe  by Amit one of your employe mobile no( +91 90047 53488 ) i performed there on 25 and now  I\'m waiting for my pending payment since that day your Manager is not attending my calls n not giving replies to my Messages . Secondly after booking he cancelled my 31 just a day before i have to suffer loss because of him .i request you to plz clear my amount ASAP or i will take legal action against your company employee.', '1674583944', '1674583944'),
(34, 'Darrel C.', 'pat@aneesho.com', '8102447053', 'Just wanted to ask if you would be interested in getting external help with graphic design? We do all design work like banners, advertisements, brochures, logos, flyers, etc. for a fixed monthly fee. \r\n\r\nWe don\'t charge for each task. What kind of work do you need on a regular basis? Let me know and I\'ll share my portfolio with you.', '1676885016', '1676885016'),
(35, 'Nikhil Amle', 'amle6nikhil@gmail.com', '8928221333', 'can\'t see menu online', '1678350892', '1678350892'),
(36, 'Nicholas K', 'rhea@hostingbond.com', '3128780396', 'Just wanted to ask if you\'re interested in getting a new website made or need some changes to your existing one? We have a large team of experienced website designers and developers who can help you.\r\n\r\nWe work with all platforms - Wordpress, Squarespace, Wix, Weebly etc and make all types of websites - informational, e-commerce etc. Would you like to see our portfolio?', '1679476540', '1679476540'),
(37, 'DHARMIK MUNI', 'ACCOUNTS.MANAGER@YELLOWMOUNTCAPITAL', '9820886707', 'TEST', '1685091407', '1685091407'),
(38, 'Dr.Arjun Jawahar', 'arjun.jawahar.sharma@gmail.com', '9910066721', 'Just coming back from Finch jalandhar , model town. I am a regular visitor and this is 15th time I am visiting your restaurant. Your manager Mr.Navneet (appointment 15 days back is a asshole) does not know how to respect women , was staring stocking on our dine table (bloody womenizer) . In end I have to confront him and got to know that his wife is abroad. Have to leave our dinner in between. Poor on your HR that you have recruited such a dump ass.\r\n\r\n Pizza fresh veggie was awful (as had tandoori mayonnaise n other tadka over it) which was our favorite every time we visited. Got to know that it\'s all managers taste buds flickering. \r\n\r\nYour staff \'Shivani\' had last day today,  who is a good sport & always served us well. \r\n\r\nReview to be noted. \r\n\r\nThanks', '1686764429', '1686764429'),
(39, 'Rajvir Singh', 'srajvir441@gmail.com', '7710667666', 'Your manager of Amritsar branch is very money minded. First they will call you and temp for offers, then they say there is no such offers here. They make you sound fool. There food qualityis so poor and stale. Chicken was non cooked and quantity was not worth of money. Also he took extra 15% if i wanted to pay through Paytm. I am never gonna suggest anyone this place', '1688380627', '1688380627'),
(40, 'Rajvir Singh', 'srajvir441@gmail.com', '7710667666', 'I\'m in Amritsar. your manager is very money minded . First they will call you and temp for offers, then they say there is no such offers here. They make you sound fool. There food qualityis so poor and stale. Chicken was non cooked and quantity was not worth of money. Also he took extra 15% to pay through Paytm. Never gonna suggest this place to anyone', '1688380827', '1688380827'),
(41, 'Ajaay', 'tanejaajay919@gmail.com', '9034425000', 'pl senf master franchisee t & c', '1691171373', '1691171373'),
(43, 'Manjinder Singh', 'Manjindersingh308@gmail.com', '8427467360', 'et', '1692795072', '1692795072'),
(44, 'Akshay Kate', 'akshaykate45@gmail.com', '9822299234', 'I’m looking forward to set up in Pune.', '1694976792', '1694976792');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_options`
--
ALTER TABLE `attribute_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_redeemeds`
--
ALTER TABLE `coupon_redeemeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_addresses`
--
ALTER TABLE `home_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `home_addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `home_banners`
--
ALTER TABLE `home_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hops`
--
ALTER TABLE `hops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insta_feeds`
--
ALTER TABLE `insta_feeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `tems_user_id_foreign` (`user_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `malts`
--
ALTER TABLE `malts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_id` (`place_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `passports`
--
ALTER TABLE `passports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passport_free_item`
--
ALTER TABLE `passport_free_item`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `passport_free_item_product_foreign` (`product_id`);

--
-- Indexes for table `passport_items`
--
ALTER TABLE `passport_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `passport_items_user_id_foreign` (`user_id`);

--
-- Indexes for table `passport_orders`
--
ALTER TABLE `passport_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `passport_id_foreign` (`passport_id`),
  ADD KEY `passport_orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `passport_order_histories`
--
ALTER TABLE `passport_order_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `passport_id` (`passport_id`),
  ADD KEY `passport_order_history_passportOrder_foreign` (`passport_order_id`),
  ADD KEY `passport_order_histories_user_id_foreign` (`user_id`);

--
-- Indexes for table `passport_pages`
--
ALTER TABLE `passport_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passport_used_orders`
--
ALTER TABLE `passport_used_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `passport_used_orders_Orders_foreign` (`order_id`),
  ADD KEY `passport_used_orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_metas`
--
ALTER TABLE `product_metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_metas_product_foreign` (`product_id`);

--
-- Indexes for table `ptypes`
--
ALTER TABLE `ptypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `public_notifications`
--
ALTER TABLE `public_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refunds_product_primary` (`product_id`),
  ADD KEY `order_id_foreign` (`order_id`),
  ADD KEY `refunds_user_id_foreign` (`user_id`);

--
-- Indexes for table `restaurant_passport_user_order`
--
ALTER TABLE `restaurant_passport_user_order`
  ADD KEY `id` (`id`),
  ADD KEY ` restaurant_passport_user_order_product_foreign` (`product_id`),
  ADD KEY `restaurant_passport_user_id_foreign` (`user_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_public_notifications`
--
ALTER TABLE `sub_public_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_public_notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `superadmins`
--
ALTER TABLE `superadmins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `upload_images`
--
ALTER TABLE `upload_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_images_old`
--
ALTER TABLE `upload_images_old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_enquiry`
--
ALTER TABLE `user_enquiry`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `attribute_options`
--
ALTER TABLE `attribute_options`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `coupon_redeemeds`
--
ALTER TABLE `coupon_redeemeds`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `home_addresses`
--
ALTER TABLE `home_addresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `home_banners`
--
ALTER TABLE `home_banners`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hops`
--
ALTER TABLE `hops`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `insta_feeds`
--
ALTER TABLE `insta_feeds`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=872;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `malts`
--
ALTER TABLE `malts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=693;

--
-- AUTO_INCREMENT for table `passports`
--
ALTER TABLE `passports`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `passport_free_item`
--
ALTER TABLE `passport_free_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `passport_items`
--
ALTER TABLE `passport_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `passport_orders`
--
ALTER TABLE `passport_orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `passport_order_histories`
--
ALTER TABLE `passport_order_histories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT for table `passport_pages`
--
ALTER TABLE `passport_pages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `passport_used_orders`
--
ALTER TABLE `passport_used_orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=811;

--
-- AUTO_INCREMENT for table `product_metas`
--
ALTER TABLE `product_metas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1088;

--
-- AUTO_INCREMENT for table `ptypes`
--
ALTER TABLE `ptypes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `public_notifications`
--
ALTER TABLE `public_notifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `refunds`
--
ALTER TABLE `refunds`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `restaurant_passport_user_order`
--
ALTER TABLE `restaurant_passport_user_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_public_notifications`
--
ALTER TABLE `sub_public_notifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `superadmins`
--
ALTER TABLE `superadmins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `upload_images`
--
ALTER TABLE `upload_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1713;

--
-- AUTO_INCREMENT for table `upload_images_old`
--
ALTER TABLE `upload_images_old`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1713;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=835;

--
-- AUTO_INCREMENT for table `user_enquiry`
--
ALTER TABLE `user_enquiry`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `home_addresses`
--
ALTER TABLE `home_addresses`
  ADD CONSTRAINT `home_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `item_product_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tems_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_places_foreign` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passport_free_item`
--
ALTER TABLE `passport_free_item`
  ADD CONSTRAINT `passport_free_item_product_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passport_items`
--
ALTER TABLE `passport_items`
  ADD CONSTRAINT `passport_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passport_orders`
--
ALTER TABLE `passport_orders`
  ADD CONSTRAINT `passport_id_foreign` FOREIGN KEY (`passport_id`) REFERENCES `passports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `passport_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passport_order_histories`
--
ALTER TABLE `passport_order_histories`
  ADD CONSTRAINT `passport_order_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `passport_order_history_passport_foreign` FOREIGN KEY (`passport_id`) REFERENCES `passports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `passport_order_history_passportOrder_foreign` FOREIGN KEY (`passport_order_id`) REFERENCES `passport_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passport_used_orders`
--
ALTER TABLE `passport_used_orders`
  ADD CONSTRAINT `passport_used_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_metas`
--
ALTER TABLE `product_metas`
  ADD CONSTRAINT `product_metas_product_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `refunds`
--
ALTER TABLE `refunds`
  ADD CONSTRAINT `order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `refunds_product_primary` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `refunds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `restaurant_passport_user_order`
--
ALTER TABLE `restaurant_passport_user_order`
  ADD CONSTRAINT ` restaurant_passport_user_order_product_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `restaurant_passport_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_public_notifications`
--
ALTER TABLE `sub_public_notifications`
  ADD CONSTRAINT `sub_public_notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
