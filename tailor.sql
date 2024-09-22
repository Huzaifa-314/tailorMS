-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2024 at 10:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tailor`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `order` int(8) NOT NULL,
  `title` varchar(160) NOT NULL,
  `description` text NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `allDay` varchar(5) NOT NULL,
  `color` varchar(7) NOT NULL,
  `url` varchar(255) NOT NULL,
  `category` varchar(200) NOT NULL,
  `repeat_type` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `repeat_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `order`, `title`, `description`, `start`, `end`, `allDay`, `color`, `url`, `category`, `repeat_type`, `user_id`, `repeat_id`) VALUES
(1, 0, ': laptop', 'laptop', '2024-03-27 00:00:00', '2024-03-28 00:00:00', 'true', '#00a014', '../orderedit.php?id=1', 'Orders', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `amount`) VALUES
(1, 'Panjabi/Kurta', 1499.00),
(2, 'Salwar Kameez', 800.00),
(4, 'Shirt & Pants', 1300.00),
(5, 'School Uniforms', 1000.00),
(6, 'Children\'s Wear', 500.00),
(7, 'Other', 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `sex` tinyint(2) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `fullname`, `phonenumber`, `address`, `sex`, `email`, `comment`, `city`) VALUES
(1, 'codingabel', '2393255637', 'kahia', 0, 'codingabel@gmail.com', 'ryye', 'kahia');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` int(8) NOT NULL,
  `customer` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expcat`
--

CREATE TABLE `expcat` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `expcat`
--

INSERT INTO `expcat` (`id`, `title`) VALUES
(1, 'Material Purchase'),
(2, 'Staff Salary'),
(3, 'Rent'),
(4, 'Staff Incentive'),
(5, 'Machine Purchase'),
(6, 'Machine Maintenance and Repair'),
(7, 'Electricity'),
(8, 'Generator Fuel'),
(9, 'Generator Maintenance'),
(10, 'Tax, Dues, Security, Waste'),
(11, 'Needle, Tread, Accessory Purchase');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `expcat` int(8) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `amount` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `expcat`, `description`, `date`, `amount`) VALUES
(1, 2, 'CA Salary', '2024-03-28', 10000),
(2, 2, 'payment', '2024-03-28', 1022);

-- --------------------------------------------------------

--
-- Table structure for table `general_setting`
--

CREATE TABLE `general_setting` (
  `id` int(11) NOT NULL,
  `sitename` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `currency` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sms` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `general_setting`
--

INSERT INTO `general_setting` (`id`, `sitename`, `email`, `mobile`, `currency`, `sms`) VALUES
(1, 'SARU TECH', 'agbonayeosaru@gmail.com', '07068242918', '$', ' http://sms.marketnaija.com//API/?action=compose&username=mamama&api_key=aaaaaa999999ddddd&sender=sarutech&to=[TO]&message=[MESSAGE] Just Fill Up the full text from your sms api service with replace message with[MESSAGE] and To-Phonenumber with [TO]');

-- --------------------------------------------------------

--
-- Table structure for table `inccat`
--

CREATE TABLE `inccat` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `inccat`
--

INSERT INTO `inccat` (`id`, `title`) VALUES
(1, 'Sew  New Cloth'),
(2, 'Repair Cloth'),
(4, 'Training and Tutor'),
(5, 'Machine Repair'),
(6, 'Mass Production');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `inccat` int(8) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `amount` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `inccat`, `description`, `date`, `amount`) VALUES
(1, 4, 'Payment for Order: 1', '2024-03-27', 100),
(2, 4, 'tutor', '2024-03-30', 200),
(3, 1, 'Payment for Order: 1', '2024-09-11', 200);

-- --------------------------------------------------------

--
-- Table structure for table `measurement`
--

CREATE TABLE `measurement` (
  `measurement_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `part_id` int(8) NOT NULL,
  `measurement` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `measurement`
--

INSERT INTO `measurement` (`measurement_id`, `customer_id`, `part_id`, `measurement`) VALUES
(1, 1, 14, '5'),
(2, 1, 15, '7'),
(3, 1, 16, '2'),
(4, 1, 17, '2'),
(5, 1, 18, '2'),
(6, 1, 19, '4'),
(7, 1, 20, '4'),
(8, 1, 21, '5'),
(9, 1, 38, '3'),
(10, 1, 39, '20'),
(11, 1, 40, '23'),
(12, 1, 41, '12'),
(13, 1, 42, '12'),
(14, 1, 43, '21'),
(15, 1, 44, '25'),
(16, 1, 45, '32'),
(17, 1, 47, '3'),
(18, 1, 48, '23'),
(19, 1, 49, '21'),
(20, 1, 50, '12'),
(21, 1, 51, '21'),
(22, 1, 52, '12'),
(23, 1, 53, '12'),
(24, 1, 54, '12');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(8) NOT NULL,
  `customer` int(8) NOT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fabric` varchar(255) NOT NULL DEFAULT 'No',
  `amount` decimal(11,2) NOT NULL,
  `paid` decimal(11,2) NOT NULL,
  `balance` decimal(11,2) NOT NULL,
  `received_by` int(11) NOT NULL,
  `date_received` date DEFAULT NULL,
  `completed` varchar(10) DEFAULT 'No',
  `date_collected` date DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `service_type` varchar(50) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `deadline` date DEFAULT NULL,
  `date_of_order` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `customer`, `description`, `fabric`, `amount`, `paid`, `balance`, `received_by`, `date_received`, `completed`, `date_collected`, `category_id`, `service_type`, `contact_number`, `deadline`, `date_of_order`) VALUES
(1, 0, 'laptop', 'No', 1000.00, 200.00, 0.00, 0, '2024-03-27', 'Yes', '2024-03-28', NULL, '', '', NULL, '2024-09-22'),
(2, 1, 'it needs to be longer', 'No', 1500.00, 1500.00, 0.00, 1, '2024-09-11', 'confirmed', '0000-00-00', 1, 'repair', '01813016898', '2024-09-12', '2024-09-22'),
(3, 3, 'black pant white shirt', 'No', 1300.00, 1300.00, 0.00, 1, '2024-09-11', 'confirmed', '0000-00-00', 4, 'custom', '01813016898', '2024-09-13', '2024-09-22'),
(4, 3, 'make for newborn baby', 'No', 500.00, 150.00, 0.00, 1, '2024-09-11', 'completed', '0000-00-00', 6, 'custom', '01813016898', '2024-10-02', '2024-09-22'),
(5, 1, 'For sports', 'No', 50.00, 0.00, 0.00, 1, '2024-09-18', 'pending', '0000-00-00', 7, 'repair', '01784455678', '2024-09-27', '2024-09-22'),
(6, 9, 'Repair My Pant', 'No', 650.00, 0.00, 0.00, 0, '2024-09-18', 'pending', NULL, 4, 'repair', '01813026898', '2024-09-20', '2024-09-22'),
(7, 9, 'make a pant', 'No', 1300.00, 0.00, 0.00, 0, '2024-09-18', 'pending', NULL, 4, 'custom', '01813026898', '2024-09-26', '2024-09-22'),
(8, 3, '', 'No', 800.00, 240.00, 0.00, 1, '2024-09-18', 'canceled', '0000-00-00', 2, 'custom', 'test', '2024-09-20', '2024-09-22');

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`id`, `title`, `type`, `description`, `image`) VALUES
(3, 'NECK', 7, '  Place two fingers between the tape measure and the neck as the pictures show, and make sure you can move the tape easily. Do not tighten the tape measure. Make sure that the tape is at the base of the neck where the neck and shoulders meet or at the height where the collar would be if you were wearing a shirt.', 'neck.jpg'),
(4, 'CHEST', 1, ' Stand up straight, relax and take deep breath with hands down at your side. The chest measurement should be taken around the chest under the armpits. Make sure the tape is parallel and you can move the tape easily. Do not tighten the tape measure. Avoid having thick clothes on when measuring.', 'chest.jpg'),
(5, 'WAIST', 1, ' Stand up in a relaxed posture, do not hold your breath or hold your stomach in. If you do not have beer belly, the waist measurement should be taken around the waist at the narrowest point. If you have beer belly, you should measure the widest point. Make sure you can move the tape easily. Do not tighten the tape measure.', 'waist.jpg'),
(6, 'HIPS', 1, ' Take out all of the stuff in the front and back pockets your trouser. The hip measurement should be taken around the hips at the widest point. Stand up in a relaxed posture, and keep the tape parallel. Do not tighten the tape measure. Make sure you can move the tape easily. ', 'hips.jpg'),
(7, 'SHOULDER', 1, ' Stand up in a relaxed posture. Measure across the top of the shoulder from one edge to the other. Ensure you take the curved contour over the top of the shoulders as shown. If you are wearing your best fitted shirt measure up to the shoulder seams', 'shoulder.jpg'),
(8, 'SLEEVE LENGTH', 1, ' The sleeve measurement should be taken from exactly the same point you used earlier for the \"Shoulder\" measurement. Measure from tip of shoulder to a point at the wrist where you want the sleeve to end. Do not bend your arms. If you want to match your dress shirt with a suit, you should measure the suit sleeve length you want, and then add one (1) centimeter .That will be the shirt\'s sleeve length.\n', 'sleeve-length.jpg'),
(9, 'SHORT SLEEVE LENGTH ', 1, ' Measure with arm at your side, from the tip of the shoulder to a point on the outside of the arm where you want the sleeve to end. ', 'short-sleeve-length.jpg'),
(10, 'WRIST/CUFF ', 1, ' Measure the actual wrist size around your wrist bone. You may also consider adding Â¼\" to Â½\" to your size if you wear medium to heavier watches. ', 'wrist-cuff.jpg'),
(11, 'BICEP ', 1, ' widest point. This is normally taken about 15cm to 18 cm from the tip of the shoulder seam. This is the sleeve width of the largest part of your arm. **Do not flex your bicep.** ', 'biceps.jpg'),
(12, 'SHIRT LENGTH ', 1, ' Stand up in a relaxed posture. Measure from the topmost point of the shoulder at a point near the nape at the collar seam, along the front of your body, to a point where you want the shirt to end. ', 'shirt-length.jpg'),
(13, ' ARMHOLE ', 1, ' Place the tape measure under your armpit and around the top of your arm. To ensure a comfortable fit, take the armhole measurement with one finger inside the tape measure. ', 'arm-hole.jpg'),
(14, 'WAIST', 3, ' Wearing trousers and a shirt put the measuring tape around your waist at the height were you would wear your pants and adjust to your designed snugness with room for a finger. Make sure the tape is snug and does not ride over the waistband but you should be able to put your index finger inside the tape.  ', 'touser-waist.jpg'),
(15, 'HIPS ', 3, ' Wearing trousers, measure around the fullest part of your hips, placing a finger between your body and the tape. Make sure the tape is straight at all times. Make sure your pockets are empty and the tape is not restrictive. As a guide, you should not make the tape too snug. You only just need to be able to feel the tape when measuring.', 'touser-hip.jpg'),
(16, 'CROTCH', 3, ' Measure from the top middle of the back pants waist (see point A) all along the crotch seam through your legs until the top of front waist (see point B)', 'touser-crotch.jpg'),
(17, 'THIGH WIDTH ', 3, ' Wearing trousers, empty your pockets then, start at the top of your inseam, measure around your thigh with room for a finger.', 'touser-thigh-width..jpg'),
(18, 'TROUSER LENGTH', 3, ' Measure from the top of pants waist all along the side pant seam until the bottom of your pants or roughly 1 inch from the ground', 'touser-length.jpg'),
(19, ' INSEAM ', 3, ' Measure from the lowest part of your crotch area to the floor.  Make sure the tape is tight along the inside of your leg, that you are standing straight, and then measure.  No shoes please! ', 'touser-inseam.jpg'),
(20, ' KNEE ', 3, ' Measure around your knee at its widest point.  You need only measure one knee', 'touser-knee.jpg'),
(21, 'HALF HEM ', 3, ' Measure the width you want for the bottom of your trousers. ', 'touser-crotch-half-hem.jpg'),
(22, 'SHIRT LENGTH ', 2, ' Take the measure from the highest part of your shoulder (next to the collar) to the longest part of the shirt. See image on the left. ', 'shirt-length.jpg'),
(23, 'SHOULDER WIDTH ', 2, ' Measure the distance from one shoulder to the other, the measuring tape has to start and finish one centimeter before the end of your shoulder. See picture on the left. ', 'shoulder-width.jpg'),
(24, 'NECK', 2, ' Measure around your neck. Adjust the measuring tape to your preferred looseness. It is very important to introduce a finger between your body and the tape. ', 'neck.jpg'),
(25, 'CHEST', 2, ' Measure around the widest part of your chest (put the measuring tape on both nipples). Let loose so that you can put a finger between your body and the tape. Make sure that the tape is at an even height all the way around. ', 'chest.jpg'),
(26, ' BICEP ', 2, ' Measure around the widest part of your bicep. Let loose so that you can put a finger between your body and the tape. ', 'bicep.jpg'),
(27, 'WRIST', 2, ' Measure around the wrist leaving one finger of space to take the measurement. ', 'wrist.jpg'),
(28, 'SLEEVE', 2, ' ', 'sleeve.jpg'),
(29, 'SHORT SLEEVE ', 2, ' ', 'short-sleeve.jpg'),
(30, 'Â¾ SLEEVE ', 2, ' ', '3-4-sleeve.jpg'),
(31, 'WAIST', 2, ' ', 'waist.jpg'),
(32, 'STOMACH ', 2, ' ', 'stomach.jpg'),
(33, ' HIPS ', 2, ' ', 'hips.jpg'),
(34, ' BREAST POINT ', 2, ' Measure from the highest point of your shoulder, to the breast point (the most outstanding part of your breast). ', 'breast.jpg'),
(35, 'WAIST POINT ', 2, ' ', 'waist-point.jpg'),
(36, 'SLEEVE HOLE ', 2, ' ', 'sleeve-hole.jpg'),
(37, 'BUST', 2, ' ', 'bust.jpg'),
(38, 'NECK', 6, ' ', 'neck.jpg'),
(39, 'CHEST', 6, ' ', 'chest.jpg'),
(40, 'STOMACH ', 6, ' ', 'stomach.jpg'),
(41, 'WAIST', 6, ' ', 'waist.jpg'),
(42, 'HIPS', 6, ' ', 'hips.jpg'),
(43, 'SHOULDER', 6, ' ', 'shoulder.jpg'),
(44, 'JACKET LENGTH', 6, ' ', 'jacket-lenght.jpg'),
(45, 'SLEEVE LENGTH', 6, ' ', 'sleeve-length.jpg'),
(46, 'BICEP ', 2, ' ', 'biceps.jpg'),
(47, 'WRIST', 6, ' ', 'wrist.jpg'),
(48, ' VEST LENGTH ', 6, ' ', 'vest-lenght.jpg'),
(49, 'CROTCH', 6, ' ', 'crotch.jpg'),
(50, 'THIGH WIDTH ', 6, ' ', 'thigh-width.jpg'),
(51, 'TROUSER LENGTH', 6, ' ', 'pant-length.jpg'),
(52, 'INSEAM', 6, ' ', 'inseam.jpg'),
(53, 'KNEE', 6, ' ', 'knee.jpg'),
(54, 'HALF HEM ', 6, ' ', 'half-hem.jpg'),
(55, 'WAIST', 4, '  ', 'skirtwaist.png'),
(56, 'WAIST TO HIP HEIGHT', 4, '   ', 'skirthip1.png'),
(57, 'LENGHT', 4, 'Women  Skirt Lenght', 'skirtlenght.png'),
(58, 'HALLOW TO HEM', 5, 'HALLOW TO HEM', 'gown.jpg'),
(59, 'HIP WIDTH', 4, '  ', 'skirthip2.png'),
(60, 'BURST', 5, ' ', 'gown.jpg'),
(61, 'WAIST', 5, ' ', 'gown.jpg'),
(62, 'HIP', 5, ' ', 'gown.jpg'),
(63, 'Hcig', 14, ' ', ''),
(64, '', 1, ' ', ''),
(65, 'Water', 1, ' jk.;l', ''),
(66, 'TROUSER', 3, ' TROUSER', 'avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `order_id`, `name`, `email`, `phone`, `amount`, `address`, `status`, `transaction_id`, `currency`) VALUES
(19, 2, 'cus1', 'contact.mdhuzaifa@gmail.com', '01813016898', 450, NULL, 'confirmed', 'SSLCZ_TEST_66e0ed9d7f1fa', 'BDT'),
(20, 2, 'cus1', 'contact.mdhuzaifa@gmail.com', '01813016898', 1050, NULL, 'confirmed', 'SSLCZ_TEST_66e0eecdcf939', 'BDT'),
(21, 3, 'cus1', 'contact.mdhuzaifa@gmail.com', '01813016898', 1300, NULL, 'confirmed', 'SSLCZ_TEST_66e0eee42b4bb', 'BDT'),
(22, 4, 'cus1', 'contact.mdhuzaifa@gmail.com', '01813016898', 150, NULL, 'confirmed', 'SSLCZ_TEST_66e9f347721c3', 'BDT'),
(23, 6, 'emp1', 'contact.mdhuzaifa@gmail.com', '01813026898', 195, NULL, 'Pending', 'SSLCZ_TEST_66ea1940797df', 'BDT'),
(24, 8, 'cus1', 'j@gmail.com', 'test', 240, NULL, 'confirmed', 'SSLCZ_TEST_66ea87537ca34', 'BDT');

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` int(8) NOT NULL,
  `customer` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(8) NOT NULL,
  `stafftype` int(8) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phonenumber` varchar(50) NOT NULL,
  `salary` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `stafftype`, `fullname`, `address`, `phonenumber`, `salary`) VALUES
(1, 4, 'CA', 'laoap', '046888463', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `stafftype`
--

CREATE TABLE `stafftype` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stafftype`
--

INSERT INTO `stafftype` (`id`, `title`) VALUES
(1, 'Tailor'),
(2, 'Counter'),
(3, 'Security'),
(4, 'Manager'),
(5, 'CA');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(8) NOT NULL,
  `title` varchar(255) NOT NULL,
  `msg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `title`, `msg`) VALUES
(1, 'Collect Your Clothes', 'Your Clothes are ready for collection. Thanks for your patronage');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(8) NOT NULL,
  `title` varchar(50) NOT NULL,
  `sex` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `title`, `sex`) VALUES
(1, 'SHIRT', 1),
(2, 'BLOUSE', 1),
(3, 'TROUSER', 0),
(4, 'SKIRT', 1),
(5, 'GOWN', 1),
(6, 'SUIT', 0),
(36, 'TROUSER 2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `email`, `phone`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '', ''),
(2, 'testuser', '8cb2237d0679ca88db6464eac60da96345513964', 'customer', '', ''),
(3, 'cus1', '81dc9bdb52d04dc20036dbd8313ed055', 'customer', '', ''),
(4, 'cus2', '81dc9bdb52d04dc20036dbd8313ed055', 'customer', '', ''),
(9, 'emp1', '81dc9bdb52d04dc20036dbd8313ed055', 'employee', 'contact.mdhuzaifa@gmail.com', '01543534611');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expcat`
--
ALTER TABLE `expcat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_setting`
--
ALTER TABLE `general_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inccat`
--
ALTER TABLE `inccat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `measurement`
--
ALTER TABLE `measurement`
  ADD PRIMARY KEY (`measurement_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_order` (`category_id`);

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_id_payment` (`order_id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stafftype`
--
ALTER TABLE `stafftype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expcat`
--
ALTER TABLE `expcat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `general_setting`
--
ALTER TABLE `general_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inccat`
--
ALTER TABLE `inccat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `measurement`
--
ALTER TABLE `measurement`
  MODIFY `measurement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `part`
--
ALTER TABLE `part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stafftype`
--
ALTER TABLE `stafftype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_category_order` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_order_id_payment` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
