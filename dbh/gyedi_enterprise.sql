-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2020 at 10:17 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gyedi_enterprise`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `other_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_pic` varchar(255) NOT NULL,
  `pass_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `first_name`, `last_name`, `other_name`, `username`, `password`, `email`, `user_pic`, `pass_code`) VALUES
(1, 'Admin', 'Name', '', 'admin', '$2y$10$oRZz3woCOY6l4d5ccTrXLOSdssJ/Fwky8Aw.B9b2dZ62ip7PXdykS', 'adminemail@gmail.com', '../../img/Admin_5e8235d6cecc80.33396105.png', 'thbruce1970');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `branch_phone` varchar(10) NOT NULL,
  `branch_position` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `branch_name`, `branch_phone`, `branch_position`) VALUES
(2, 'Kasoa', '0246112839', 'branch_1'),
(3, 'Navrongo', '0246112839', 'branch_2'),
(4, 'Suhum', '0545168515', 'branch_3');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `cart_item_id` int(11) NOT NULL,
  `cart_item_name` varchar(60) NOT NULL,
  `cart_item_price` decimal(10,2) NOT NULL,
  `cart_quantity` int(11) NOT NULL,
  `cart_amount` decimal(10,2) NOT NULL,
  `cashier` varchar(60) NOT NULL,
  `branch` varchar(60) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `checkout_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_phone` varchar(10) NOT NULL,
  `order_no` varchar(20) NOT NULL,
  `order_amount` decimal(10,2) NOT NULL,
  `checkout_date` varchar(50) NOT NULL,
  `checkout_time` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `branch_phone` varchar(10) NOT NULL,
  `attendant` varchar(50) NOT NULL,
  `attendant_id` int(11) NOT NULL,
  `cashier` varchar(60) NOT NULL,
  `cashier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`checkout_id`, `customer_name`, `customer_phone`, `order_no`, `order_amount`, `checkout_date`, `checkout_time`, `branch`, `branch_id`, `branch_phone`, `attendant`, `attendant_id`, `cashier`, `cashier_id`) VALUES
(1, '', '', 'MAY231946578', '6.00', '23-05-2019', '11:28 PM', 'Navrongo', 1, '0557758838', 'Godwin Afulani', 2, 'Ahmed Issah', 1),
(2, 'Chris', '', 'MAY231915241', '25.00', '23-05-2019', '11:42 PM', 'Navrongo', 1, '0557758838', 'Vivian Ashamatey', 3, 'Ahmed Issah', 1),
(3, 'Mallam', '0542555551', 'MAY291942348', '56.00', '29-05-2019', '8:52 PM', 'Navrongo', 1, '0557758838', 'Godwin Afulani', 2, 'Ahmed Issah', 1),
(4, 'Rahaman', '0548894875', 'JUN041941841', '6.00', '04-06-2019', '11:55 AM', 'Navrongo', 1, '0557758838', 'Vivian Ashamatey', 3, 'Ahmed Issah', 1),
(5, 'Abd', '', 'JUN041928974', '77.00', '04-06-2019', '12:02 PM', 'Navrongo', 1, '0557758838', 'Vivian Ashamatey', 3, 'Ahmed Issah', 1),
(6, '', '', 'JUN041930976', '1.50', '04-06-2019', '4:38 PM', 'Navrongo', 1, '0557758838', 'Godwin Afulani', 2, 'Ahmed Issah', 1),
(7, 'Abode', '0542555551', 'JUN231914389', '32.50', '23-06-2019', '11:04 PM', 'Navrongo', 1, '0557758838', 'Godwin Afulani', 2, 'Ahmed Issah', 1),
(8, 'Sdjh', '0245564848', 'JUN241924944', '5.00', '24-06-2019', '12:20 AM', 'Navrongo', 1, '0557758838', 'Godwin Afulani', 2, 'Ahmed Issah', 1),
(9, '', '', 'JUL241937351', '12.00', '24-07-2019', '9:12 AM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(10, 'Justine', '', 'JUL241925187', '13.80', '24-07-2019', '9:44 AM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(11, '', '', 'JUL241934961', '10.50', '24-07-2019', '11:15 AM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(12, '', '', 'JUL241911939', '8.00', '24-07-2019', '11:16 AM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(13, '', '', 'JUL241925570', '1.00', '24-07-2019', '11:17 AM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(14, '', '', 'JUL241938589', '26.00', '24-07-2019', '1:32 PM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(15, '', '', 'JUL241927530', '21.00', '24-07-2019', '1:33 PM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(16, '', '', 'JUL241916193', '20.00', '24-07-2019', '1:34 PM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(17, '', '', 'JUL241936961', '1.20', '24-07-2019', '2:05 PM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(18, '', '', 'JUL241926189', '23.00', '24-07-2019', '5:09 PM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(19, '', '', 'JUL241920804', '10.00', '24-07-2019', '5:13 PM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(20, '', '', 'AUG171928888', '3.00', '17-08-2019', '10:23 AM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(21, '', '', 'AUG171920775', '2.00', '17-08-2019', '10:25 AM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(22, '', '', 'AUG171940242', '5.00', '17-08-2019', '10:27 AM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(23, '', '', 'AUG171934038', '2.00', '17-08-2019', '11:19 AM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(24, '', '', 'AUG171932497', '8.00', '17-08-2019', '11:24 AM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(25, '', '', 'AUG171932410', '8.00', '17-08-2019', '11:26 AM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(26, '', '', 'AUG171934150', '3.00', '17-08-2019', '11:27 AM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(27, '', '', 'AUG171914314', '11.00', '17-08-2019', '11:28 AM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(28, '', '', 'AUG171920066', '2.00', '17-08-2019', '11:29 AM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(29, '', '', 'AUG171947269', '4.00', '17-08-2019', '12:15 PM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(30, '', '', 'AUG171936391', '5.00', '17-08-2019', '1:12 PM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(31, '', '', 'AUG171914456', '9.70', '17-08-2019', '2:13 PM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(32, '', '', 'AUG171934649', '4.00', '17-08-2019', '2:16 PM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(33, '', '', 'AUG171921043', '5.00', '17-08-2019', '2:17 PM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(34, '', '', 'AUG171936068', '2.30', '17-08-2019', '2:26 PM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(35, '', '', 'AUG171943530', '2.00', '17-08-2019', '2:27 PM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Ahmed Issah', 1, 'Elizabeth Surname', 2),
(36, '', '', 'SEP071924030', '3.00', '07-09-2019', '11:36 AM', 'Kasoa Odupongkpehe', 1, '0558756327', 'Emmanuel Nine', 3, 'Elizabeth Surname', 2),
(37, 'Moses', '0244556484', 'OCT241926955', '3.00', '24-10-2019', '9:27 PM', 'Kasoa', 2, '0246112839', 'Alex Adama', 2, 'Ahmed Issah', 3),
(38, '', '', 'OCT251911599', '6.00', '25-10-2019', '2:08 AM', 'Kasoa', 2, '0246112839', 'Alex Adama', 2, 'Ahmed Issah', 3),
(39, '', '', 'DEC281943016', '2.00', '28-12-2019', '8:58 AM', 'Kasoa', 2, '0246112839', 'Alex Adama', 2, 'Ahmed Issah', 3),
(40, 'Ahmed', '0543664554', 'JAN262016376', '14.00', '26-01-2020', '10:53 AM', 'Kasoa', 2, '0246112839', 'Alex Adama', 2, 'Ahmed Issah', 3),
(41, '', '', 'FEB102049958', '3.00', '10-02-2020', '5:52 PM', 'Kasoa', 2, '0246112839', 'Alex Adama', 2, 'Ahmed Issah', 3),
(42, 'Alimatu', '0543664554', 'MAY142025161', '69.00', '14-05-2020', '9:40 PM', 'Kasoa', 2, '0246112839', 'Alex Adama', 2, 'Ahmed Issah', 3),
(43, 'Ahmed', '0254587778', 'JUN172023906', '18.00', '17-06-2020', '8:16 PM', 'Kasoa', 2, '0246112839', 'Alex Adama', 2, 'Ahmed Issah', 3);

-- --------------------------------------------------------

--
-- Table structure for table `checkout_items`
--

CREATE TABLE `checkout_items` (
  `checkout_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `item_amount` decimal(10,2) NOT NULL,
  `order_no` varchar(60) NOT NULL,
  `cashier` varchar(60) NOT NULL,
  `branch` varchar(60) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `checkout_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkout_items`
--

INSERT INTO `checkout_items` (`checkout_id`, `item_id`, `item_name`, `item_price`, `item_quantity`, `item_amount`, `order_no`, `cashier`, `branch`, `branch_id`, `checkout_date`) VALUES
(1, 1, 'Photocopy', '0.50', 3, '1.50', 'MAY231943989', 'Thomas Bruce', 'Navrongo', 1, '23-05-2019'),
(2, 2, 'Printing', '1.00', 6, '6.00', 'MAY231943989', 'Thomas Bruce', 'Navrongo', 1, '23-05-2019'),
(3, 2, 'Printing', '1.00', 6, '6.00', 'MAY231946578', 'Ahmed Issah', 'Navrongo', 1, '23-05-2019'),
(4, 1, 'Photocopy', '0.50', 50, '25.00', 'MAY231915241', 'Ahmed Issah', 'Navrongo', 1, '23-05-2019'),
(5, 2, 'Printing', '1.00', 56, '56.00', 'MAY291942348', 'Ahmed Issah', 'Navrongo', 1, '29-05-2019'),
(6, 2, 'Printing', '1.00', 3, '3.00', 'JUN041941841', 'Ahmed Issah', 'Navrongo', 1, '04-06-2019'),
(7, 1, 'Photocopy', '0.50', 6, '3.00', 'JUN041941841', 'Ahmed Issah', 'Navrongo', 1, '04-06-2019'),
(8, 1, 'Photocopy', '0.50', 154, '77.00', 'JUN041928974', 'Ahmed Issah', 'Navrongo', 1, '04-06-2019'),
(9, 1, 'Photocopy', '0.50', 3, '1.50', 'JUN041930976', 'Ahmed Issah', 'Navrongo', 1, '04-06-2019'),
(10, 1, 'Photocopy', '0.50', 65, '32.50', 'JUN231914389', 'Ahmed Issah', 'Navrongo', 1, '23-06-2019'),
(11, 2, 'Printing', '1.00', 5, '5.00', 'JUN241924944', 'Ahmed Issah', 'Navrongo', 1, '24-06-2019'),
(12, 8, 'Printing (color)', '2.00', 5, '10.00', 'JUL241937351', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(13, 2, 'Printing (black)', '1.00', 1, '1.00', 'JUL241937351', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(14, 9, 'Envelope A4', '1.00', 1, '1.00', 'JUL241937351', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(15, 9, 'Envelope A4', '1.00', 1, '1.00', 'JUL241925187', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(16, 8, 'Printing (color)', '2.00', 5, '10.00', 'JUL241925187', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(17, 2, 'Printing (black)', '1.00', 1, '1.00', 'JUL241925187', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(18, 1, 'Photocopy Front', '0.30', 6, '1.80', 'JUL241925187', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(19, 5, 'Photocopy F&B', '0.50', 21, '10.50', 'JUL241934961', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(20, 8, 'Printing (color)', '2.00', 4, '8.00', 'JUL241911939', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(21, 2, 'Printing (black)', '1.00', 1, '1.00', 'JUL241925570', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(22, 4, 'Online Registration (long)', '20.00', 1, '20.00', 'JUL241938589', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(23, 6, 'Passport Picture', '6.00', 1, '6.00', 'JUL241938589', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(24, 4, 'Online Registration (long)', '20.00', 1, '20.00', 'JUL241927530', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(25, 2, 'Printing (black)', '1.00', 1, '1.00', 'JUL241927530', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(26, 4, 'Online Registration (long)', '20.00', 1, '20.00', 'JUL241916193', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(27, 1, 'Photocopy Front', '0.30', 4, '1.20', 'JUL241936961', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(28, 8, 'Printing (color)', '2.00', 10, '20.00', 'JUL241926189', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(29, 2, 'Printing (black)', '1.00', 3, '3.00', 'JUL241926189', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(30, 2, 'Printing (black)', '1.00', 1, '1.00', 'JUL241920804', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(31, 1, 'Photocopy Front', '0.30', 30, '9.00', 'JUL241920804', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '24-07-2019'),
(32, 10, 'Novdec Admission Notice', '3.00', 1, '3.00', 'AUG171928888', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(33, 2, 'Printing (black)', '1.00', 1, '1.00', 'AUG171920775', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(34, 9, 'Envelope A4', '1.00', 1, '1.00', 'AUG171920775', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(35, 2, 'Printing (black)', '1.00', 5, '5.00', 'AUG171940242', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(36, 2, 'Printing (black)', '1.00', 2, '2.00', 'AUG171934038', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(37, 11, 'Admission Letter (color)', '3.00', 1, '3.00', 'AUG171932497', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(38, 11, 'Admission Letter (color)', '3.00', 1, '3.00', 'AUG171932497', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(39, 2, 'Printing (black)', '1.00', 1, '1.00', 'AUG171932497', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(40, 9, 'Envelope A4', '1.00', 1, '1.00', 'AUG171932497', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(41, 2, 'Printing (black)', '1.00', 5, '5.00', 'AUG171932410', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(42, 8, 'Printing (color)', '2.00', 1, '2.00', 'AUG171932410', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(43, 9, 'Envelope A4', '1.00', 1, '1.00', 'AUG171932410', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(44, 10, 'Novdec Admission Notice', '3.00', 1, '3.00', 'AUG171934150', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(45, 2, 'Printing (black)', '1.00', 11, '11.00', 'AUG171914314', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(46, 8, 'Printing (color)', '2.00', 1, '2.00', 'AUG171920066', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(47, 11, 'Admission Letter (color)', '3.00', 1, '3.00', 'AUG171947269', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(48, 2, 'Printing (black)', '1.00', 1, '1.00', 'AUG171947269', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(49, 11, 'Admission Letter (color)', '3.00', 1, '3.00', 'AUG171936391', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(50, 2, 'Printing (black)', '1.00', 1, '1.00', 'AUG171936391', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(51, 9, 'Envelope A4', '1.00', 1, '1.00', 'AUG171936391', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(52, 11, 'Admission Letter (color)', '3.00', 1, '3.00', 'AUG171914456', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(53, 2, 'Printing (black)', '1.00', 1, '1.00', 'AUG171914456', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(54, 2, 'Printing (black)', '1.00', 1, '1.00', 'AUG171914456', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(55, 1, 'Photocopy Front', '0.30', 9, '2.70', 'AUG171914456', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(56, 8, 'Printing (color)', '2.00', 1, '2.00', 'AUG171914456', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(57, 11, 'Admission Letter (color)', '3.00', 1, '3.00', 'AUG171934649', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(58, 2, 'Printing (black)', '1.00', 1, '1.00', 'AUG171934649', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(59, 2, 'Printing (black)', '1.00', 1, '1.00', 'AUG171921043', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(60, 11, 'Admission Letter (color)', '3.00', 1, '3.00', 'AUG171921043', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(61, 9, 'Envelope A4', '1.00', 1, '1.00', 'AUG171921043', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(62, 13, 'Typing & Printing', '2.00', 1, '2.00', 'AUG171936068', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(63, 1, 'Photocopy Front', '0.30', 1, '0.30', 'AUG171936068', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(64, 8, 'Printing (color)', '2.00', 1, '2.00', 'AUG171943530', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '17-08-2019'),
(65, 2, 'Printing (black)', '1.00', 3, '3.00', 'SEP071924030', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, '07-09-2019'),
(66, 11, 'Admission Letter (color)', '3.00', 1, '3.00', 'OCT241926955', 'Ahmed Issah', 'Kasoa', 2, '24-10-2019'),
(67, 6, 'Passport Picture', '6.00', 1, '6.00', 'OCT251911599', 'Ahmed Issah', 'Kasoa', 2, '25-10-2019'),
(68, 2, 'Printing (black)', '1.00', 2, '2.00', 'DEC281943016', 'Ahmed Issah', 'Kasoa', 2, '28-12-2019'),
(69, 10, 'Novdec Admission Notice', '3.00', 1, '3.00', 'JAN262016376', 'Ahmed Issah', 'Kasoa', 2, '26-01-2020'),
(70, 2, 'Printing (black)', '1.00', 6, '6.00', 'JAN262016376', 'Ahmed Issah', 'Kasoa', 2, '26-01-2020'),
(71, 9, 'Envelope A4', '1.00', 5, '5.00', 'JAN262016376', 'Ahmed Issah', 'Kasoa', 2, '26-01-2020'),
(72, 10, 'Novdec Admission Notice', '3.00', 1, '3.00', 'FEB102049958', 'Ahmed Issah', 'Kasoa', 2, '10-02-2020'),
(73, 4, 'Online Registration (long)', '20.00', 3, '60.00', 'MAY142025161', 'Ahmed Issah', 'Kasoa', 2, '14-05-2020'),
(74, 10, 'Novdec Admission Notice', '3.00', 3, '9.00', 'MAY142025161', 'Ahmed Issah', 'Kasoa', 2, '14-05-2020'),
(75, 7, 'Lamination', '3.00', 6, '18.00', 'JUN172023906', 'Ahmed Issah', 'Kasoa', 2, '17-06-2020');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `address_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `company_name`, `address_1`, `address_2`, `address_3`) VALUES
(1, 'Company Name', 'Company Name', 'Postal Address', 'Town/city');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_id` int(11) NOT NULL,
  `expense_name` varchar(60) NOT NULL,
  `expense_amount` decimal(10,2) NOT NULL,
  `executed_by` varchar(60) NOT NULL,
  `executed_by_id` int(11) NOT NULL,
  `expense_date` varchar(20) NOT NULL,
  `expense_time` varchar(10) NOT NULL,
  `cashier` varchar(60) NOT NULL,
  `branch` varchar(60) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `approval` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `expense_name`, `expense_amount`, `executed_by`, `executed_by_id`, `expense_date`, `expense_time`, `cashier`, `branch`, `branch_id`, `approval`) VALUES
(1, 'Ppt', '16.00', 'Godwin Afulani', 2, '04-06-2019', '3:55 PM', 'Ahmed Issah', 'Navrongo', 1, 1),
(2, 'Petrol', '10.00', 'Vivian Ashamatey', 3, '04-06-2019', '4:28 PM', 'Ahmed Issah', 'Navrongo', 1, 1),
(3, 'Petrol', '110.00', 'Vivian Ashamatey', 3, '24-06-2019', '12:22 AM', 'Ahmed Issah', 'Navrongo', 1, 1),
(5, 'A4 Sheet', '40.00', 'Godwin Afulani', 2, '24-06-2019', '12:25 AM', 'Ahmed Issah', 'Navrongo', 1, 1),
(7, 'A4 Sheet', '24.00', 'Elizabeth Surname', 2, '24-07-2019', '9:20 AM', 'Elizabeth Surname', 'Kasoa Odupongkpehe', 1, 1),
(8, 'A4 Sheet', '25.00', 'Ahmed Issah', 3, '26-01-2020', '10:58 AM', 'Ahmed Issah', 'Kasoa', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `expense_cart`
--

CREATE TABLE `expense_cart` (
  `expense_id` int(11) NOT NULL,
  `expense_name` varchar(60) NOT NULL,
  `expense_amount` decimal(10,2) NOT NULL,
  `executed_by` varchar(60) NOT NULL,
  `executed_by_id` int(11) NOT NULL,
  `cashier` varchar(60) NOT NULL,
  `branch` varchar(60) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `expense_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_phone` varchar(10) NOT NULL,
  `order_no` varchar(20) NOT NULL,
  `order_date` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `attendant` varchar(50) NOT NULL,
  `attendant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_cart`
--

CREATE TABLE `order_cart` (
  `cart_id` int(11) NOT NULL,
  `cart_item_id` int(11) NOT NULL,
  `cart_item_name` varchar(50) NOT NULL,
  `cart_item_price` decimal(10,2) NOT NULL,
  `cart_quantity` int(11) NOT NULL,
  `cart_amount` decimal(10,2) NOT NULL,
  `order_no` varchar(60) NOT NULL,
  `cashier` varchar(60) NOT NULL,
  `branch` varchar(60) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `salary_id` int(11) NOT NULL,
  `salary_month` varchar(3) NOT NULL,
  `salary_year` varchar(5) NOT NULL,
  `salary_date` varchar(15) NOT NULL,
  `salary_due` decimal(10,2) NOT NULL,
  `salary_amount` decimal(10,2) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(60) NOT NULL,
  `service_unit_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `service_unit_price`) VALUES
(1, 'Photocopy Front', '0.30'),
(2, 'Printing (black)', '1.00'),
(4, 'Online Registration (long)', '20.00'),
(5, 'Photocopy F&B', '0.50'),
(6, 'Passport Picture', '6.00'),
(7, 'Lamination', '3.00'),
(8, 'Printing (color)', '2.00'),
(9, 'Envelope A4', '1.00'),
(10, 'Novdec Admission Notice', '3.00'),
(11, 'Admission Letter (color)', '3.00'),
(12, 'Admission Letter (black)', '2.00'),
(13, 'Typing & Printing', '2.00'),
(14, 'Photocopy A4 (color)', '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `other_name` varchar(50) NOT NULL,
  `DOB` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `residence` varchar(60) NOT NULL,
  `position` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `user_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `other_name`, `DOB`, `username`, `password`, `email`, `phone_no`, `gender`, `residence`, `position`, `branch`, `branch_id`, `salary`, `user_pic`) VALUES
(2, 'Alex', 'Adama', '', '1998-05-12', 'alexadama', '$2y$10$lU.tlfV9T4H.IN1xO8PpiuyUD0pQ7FOZ5fUkg12KLgkQiPvE644By', 'alex@yahoo.com', '0545864156', 'Male', 'Navrongo', 'Attendant', 'Kasoa', 2, '400.00', '../img/alexadama_5da6e6761d6e82.31458038.jpg'),
(3, 'Ahmed', 'Issah', 'Tahiru', '1998-10-12', 'ahmedissah', '$2y$10$/opfDGhJJsZ5vWQAkdIAU.2fNWCwHtuOyrc7Pm2ziWZ33M3ZwrKCO', 'issahahmed00@gmail.com', '0550267109', 'Male', 'Kasoa', 'Cashier', 'Kasoa', 2, '500.00', '../img/ahmedissah_5db215d062e7e4.61592048.jpg'),
(4, 'Tj', 'Hassan', '', '1920-01-25', 'tj', '$2y$10$N0bHs9tiBL3Xc2.gCRJBo.utiesgqqMPmw3PinsMFzbdLlt23s/Ce', 'tj@gmail.com', '0255856564', 'Male', 'Navrongo', 'Manager', 'Kasoa', 2, '800.00', '../img/tj_5e2d72a534a5c2.12429832.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`checkout_id`);

--
-- Indexes for table `checkout_items`
--
ALTER TABLE `checkout_items`
  ADD PRIMARY KEY (`checkout_id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `expense_cart`
--
ALTER TABLE `expense_cart`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_cart`
--
ALTER TABLE `order_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`salary_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `checkout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `checkout_items`
--
ALTER TABLE `checkout_items`
  MODIFY `checkout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `expense_cart`
--
ALTER TABLE `expense_cart`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_cart`
--
ALTER TABLE `order_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
