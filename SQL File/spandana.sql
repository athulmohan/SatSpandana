-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2025 at 05:15 PM
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
-- Database: `spandana`
--

-- --------------------------------------------------------

--
-- Table structure for table `accommodations`
--

CREATE TABLE `accommodations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `feature` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accommodations`
--

INSERT INTO `accommodations` (`id`, `name`, `caption`, `feature`, `description`, `images`, `creationDate`, `updationDate`) VALUES
(1, 'Madhavam Homestay', 'Madhavam Homestay â€“ Where Comfort Meets Culture', '<div><b>Comfortable Stay:</b> Spacious, well-furnished rooms with modern amenities.</div><div><b>Authentic Kerala Cuisine:</b> Savor freshly prepared traditional dishes.</div><div><b>Peaceful Atmosphere:</b> Nestled in a serene village, perfect for relaxation.</div><div><br></div><div>Book Your Stay at Madhavam Homestay</div>', 'Escape to the comfort and tranquility of Madhavam Homestay. Located near the historic Pirappancode Sreekrishna Temple, it is your ideal retreat to experience Kerala\'s vibrant culture, natural beauty, and warm hospitality.', '[\'stay_679107d52e7435.61122831.jpeg\',\'stay_679107d52f81f0.22787099.jpeg\',\'stay_679107d53013d4.92420754.jpeg\',\'stay_679107d53097f8.62709376.jpeg\',\'stay_679107d5311ed6.42576440.jpeg\',\'stay_679107d531a1d2.01510780.jpeg\']', '2025-01-19 19:16:02', NULL),
(5, 'Thanmaya Homestay', 'Thanmaya Homestay â€“ Your Tranquil Escape', '<div><b>Modern Comfort:</b> Well-equipped rooms with contemporary facilities.</div><div><b>Natureâ€™s Bliss:</b> Surrounded by lush greenery and scenic views.</div><div><b>Proximity to Ayurveda Center:</b> Conveniently located for a seamless experience.</div>', 'Discover the serenity of Thanmaya Homestay, where modern comfort meets the timeless charm of Kerala\'s countryside. Whether you\'re here for a rejuvenating Ayurveda treatment or a peaceful getaway, Thanmaya Homestay offers the perfect environment to unwind and recharge.', '[\'stay_679273d42cd056.64146077.jpeg\',\'stay_679273d42df389.02531901.jpeg\',\'stay_679273d42e9897.56709208.jpeg\',\'stay_679273d42f6d06.72461062.jpeg\',\'stay_679273d4300f37.17852896.jpeg\']', '2025-01-23 16:52:36', '2025-01-23 16:52:36');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `updationDate`) VALUES
(1, 'admin', 'admin@12345', '04-03-2024 11:42:05 AM');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `doctorSpecialization` varchar(255) DEFAULT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `consultancyFees` int(11) DEFAULT NULL,
  `appointmentDate` varchar(255) DEFAULT NULL,
  `appointmentTime` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `userStatus` int(11) DEFAULT NULL,
  `doctorStatus` int(11) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `doctorSpecialization`, `doctorId`, `userId`, `consultancyFees`, `appointmentDate`, `appointmentTime`, `postingDate`, `userStatus`, `doctorStatus`, `updationDate`) VALUES
(1, 'Physiotherapy', 1, 0, 600, '2025-01-30', '4:30 PM', '2024-07-27 11:06:47', 1, 1, '2025-01-29 19:04:57'),
(2, 'Ayurveda', 2, 0, 500, '2024-07-25', '5:00 PM', '2024-07-27 11:07:43', 1, 1, NULL),
(3, 'Ayurveda', 2, 0, 500, '2024-07-25', '5:00 PM', '2024-07-27 11:35:55', 1, 1, NULL),
(4, 'Ayurveda', 2, 25, 500, '2024-07-31', '1:00 AM', '2024-07-27 19:33:59', 1, 1, NULL),
(5, 'Physiotherapy', 1, 1, 600, '2024-07-31', '1:30 PM', '2024-07-27 19:41:30', 1, 0, '2025-01-28 19:20:28'),
(6, 'Ayurveda', 2, 2, 500, '2024-08-28', '5:00 PM', '2024-07-27 19:44:04', 1, 1, NULL),
(7, 'Physiotherapy', 1, 3, 600, '2024-09-17', '11:15 PM', '2024-09-01 17:42:02', 0, 1, '2024-09-01 17:57:34'),
(8, 'Physiotherapy', 1, 3, 600, '2024-09-17', '11:15 PM', '2024-09-01 17:44:07', 1, 1, NULL),
(9, 'Ayurveda', 2, 3, 500, '2024-09-16', '11:15 PM', '2024-09-01 17:44:41', 1, 1, NULL),
(10, 'Ayurveda', 2, 3, 500, '2024-09-16', '11:15 PM', '2024-09-01 17:49:19', 1, 1, NULL),
(11, 'Ayurveda', 2, 3, 500, '2024-09-16', '11:15 PM', '2024-09-01 17:50:14', 1, 1, NULL),
(12, 'Ayurveda', 2, 3, 500, '2024-09-16', '11:15 PM', '2024-09-01 17:50:35', 1, 1, NULL),
(13, 'Ayurveda', 2, 3, 500, '2024-09-16', '11:15 PM', '2024-09-01 17:51:44', 1, 1, NULL),
(14, 'Ayurveda', 2, 3, 500, '2024-09-16', '11:15 PM', '2024-09-01 17:51:49', 1, 1, NULL),
(15, 'Ayurveda', 2, 3, 500, '2024-09-16', '11:15 PM', '2024-09-01 17:52:01', 1, 1, NULL),
(16, 'Ayurveda', 2, 3, 500, '2024-09-16', '11:15 PM', '2024-09-01 17:52:51', 1, 1, NULL),
(17, 'Ayurveda', 2, 3, 500, '2024-09-16', '11:15 PM', '2024-09-01 17:52:53', 1, 1, NULL),
(18, 'Ayurveda', 2, 3, 500, '2024-09-16', '11:15 PM', '2024-09-01 17:52:57', 1, 1, NULL),
(19, 'Ayurveda', 2, 3, 500, '2024-09-16', '11:15 PM', '2024-09-01 17:52:59', 1, 1, NULL),
(20, 'Ayurveda', 2, 3, 500, '2024-09-16', '11:15 PM', '2024-09-01 17:53:01', 1, 1, NULL),
(21, 'Ayurveda', 2, 3, 500, '2024-09-16', '11:15 PM', '2024-09-01 17:53:23', 1, 1, NULL),
(22, 'Ayurveda', 2, 3, 500, '2024-09-30', '11:30 PM', '2024-09-01 17:54:58', 1, 1, NULL),
(23, 'Ayurveda', 2, 4, 500, '2024-09-13', '11:45 PM', '2024-09-01 18:06:17', 1, 1, NULL),
(24, 'Physiotherapy', 1, 5, 600, '2024-09-20', '11:45 PM', '2024-09-01 18:07:46', 1, 1, NULL),
(25, 'Physiotherapy', 1, 6, 600, '2025-01-30', '4:00 PM', '2025-01-28 16:23:20', 1, 1, '2025-01-28 19:22:10'),
(27, 'Physiotherapy', 1, 8, 600, '2025-01-30', '', '2025-01-28 19:25:44', 1, 1, NULL),
(28, 'Physiotherapy', 1, 11, 600, '2025-01-30', '10:00 AM', '2025-01-28 19:34:04', 1, 1, NULL),
(29, 'Physiotherapy', 1, 3, 600, '2025-01-30', '7:00 PM', '2025-01-28 19:42:54', 1, 1, NULL),
(30, 'Physiotherapy', 1, 3, 600, '2025-01-30', '7:00 PM', '2025-01-29 19:01:15', 1, 1, NULL),
(31, 'Physiotherapy', 1, 3, 600, '2025-01-30', '7:00 PM', '2025-01-29 19:04:14', 1, 1, NULL),
(32, 'Physiotherapy', 1, 3, 600, '2025-01-30', '7:00 PM', '2025-01-29 19:19:59', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `booking_slots`
--

CREATE TABLE `booking_slots` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `slot_time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `booking_slots`
--

INSERT INTO `booking_slots` (`id`, `doctor_id`, `booking_date`, `slot_time`) VALUES
(20, 0, '2025-02-03', '1:15 PM');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `doctorName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `docFees` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `docEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `about_doctor` text NOT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `specilization`, `role`, `doctorName`, `address`, `docFees`, `contactno`, `docEmail`, `password`, `profile_pic`, `about_doctor`, `creationDate`, `updationDate`) VALUES
(1, 'Physiotherapy', 'Head of Physiotherapy, Founder Director Sat Spandana', 'DR. SANJITH G S', 'Near Kaithara Devi Temple, Pirappancode P O, Tvm 695607', '600', 1234567890, 'doctor1@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Dr_Sanjith.jpeg', '<p style=\"line-height: 115%; margin: 12pt 0in 0pt; text-indent: 0in; direction: ltr; unicode-bidi: embed;\"><span style=\"font-size: 12pt; font-family: Montserrat; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; color: rgb(89, 89, 89);\">Specialized in musculoskeletal,\r\nneurological, and cardiorespiratory physiotherapy, Dr. Sanjith is an expert in\r\nsports injury rehabilitation, performance optimization, and fitness\r\nenhancement. Leveraging his in-depth knowledge of biomechanics and functional\r\nmovement, he designs personalized recovery strategies for athletes and fitness\r\nenthusiasts to achieve optimal performance.</span></p><p style=\"line-height: 115%; margin: 12pt 0in 0pt; text-indent: 0in; direction: ltr; unicode-bidi: embed;\">\r\n\r\n<span style=\"font-size: 12pt; font-family: Montserrat; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; color: rgb(89, 89, 89);\">A passionate advocate for healthy\r\nliving, Dr. Sanjith and his team actively lead wellness programs, fitness\r\nworkshops, yoga sessions, and nutrition &amp; weight management initiatives to\r\npromote holistic well-being and a balanced, healthy lifestyle.</span></p>', '2024-07-27 07:41:27', '2025-01-22 13:28:02'),
(2, 'Physiotherapy', 'Senior Physiotherapist, Practice Administrator Sat Spandana Wellness Retreat', 'DR. ABHIRAMI M S', 'Opposite to CHC, Kanyakulangara, Tvm, Kerala', '500', 1233211230, 'doctor2@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Dr_Abhirami.jpeg', '<p style=\"line-height: 115%; margin: 12pt 0in 0pt; text-indent: 0in; direction: ltr; unicode-bidi: embed;\"><span style=\"font-size: 12pt; font-family: Montserrat; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; color: rgb(89, 89, 89);\">Specialized in musculoskeletal,\r\nneurological, and cardiorespiratory physiotherapy, Dr. Sanjith is an expert in\r\nsports injury rehabilitation, performance optimization, and fitness\r\nenhancement. Leveraging his in-depth knowledge of biomechanics and functional\r\nmovement, he designs personalized recovery strategies for athletes and fitness\r\nenthusiasts to achieve optimal performance.</span></p><p style=\"line-height: 115%; margin: 12pt 0in 0pt; text-indent: 0in; direction: ltr; unicode-bidi: embed;\">\r\n\r\n<span style=\"font-size: 12pt; font-family: Montserrat; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; color: rgb(89, 89, 89);\">A passionate advocate for healthy\r\nliving, Dr. Sanjith and his team actively lead wellness programs, fitness\r\nworkshops, yoga sessions, and nutrition &amp; weight management initiatives to\r\npromote holistic well-being and a balanced, healthy lifestyle.</span></p>', '2024-07-27 07:45:06', '2025-01-19 12:35:35'),
(3, 'Physiotherapy', 'Consultant Physiotherapist', 'DR. HEBSIBA FLOWER M S', '<span style=\"font-size: 7pt; font-family: Montserrat; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; color: rgb(89, 89, 89);\">PALLIPURAM</span>', '500', 123456789, 'anu@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Dr_Hebsiba.jpg', '<p style=\"line-height: 115%; margin: 12pt 0in 0pt; text-indent: 0in; direction: ltr; unicode-bidi: embed;\"><span style=\"font-size: 12pt; font-family: Montserrat; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; color: rgb(89, 89, 89);\">Senior physiotherapist with over\r\nsix years of expertise in geriatric rehabilitation, post-operative care,\r\northopedic rehabilitation, and neurological conditions. She is skilled in\r\nmanual therapy, taping, electrotherapy, exercise therapy, and Basic Life Support\r\n(BLS), providing comprehensive care for her patients.</span></p><p style=\"line-height: 115%; margin: 12pt 0in 0pt; text-indent: 0in; direction: ltr; unicode-bidi: embed;\">\r\n\r\n<span style=\"font-size: 12pt; font-family: Montserrat; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; color: rgb(89, 89, 89);\">Committed to personalized\r\ntreatment, Dr. Hebsiba focuses on helping patients regain optimal physical\r\nfunction and overall well-being. Whether recovering from an injury, undergoing\r\nrehabilitation, or seeking preventive care, she offers compassionate, evidence-based\r\nguidance to support a healthier, more active lifestyle.</span></p>', '2025-01-19 09:21:33', '2025-01-19 12:35:46'),
(4, 'Physiotherapy', 'Consultant Physiotherapist', 'DR. AKHILA M R', '<span style=\"font-size: 7pt; font-family: Montserrat; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; color: rgb(89, 89, 89);\">KANYAKULANGARA</span>', '500', 789456123, 'akhila@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Dr_Akhila.jpg', '<p style=\"line-height: 115%; margin: 12pt 0in 0pt; text-indent: 0in; direction: ltr; unicode-bidi: embed;\"><span style=\"font-size: 12pt; font-family: Montserrat; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; color: rgb(89, 89, 89);\">Skilled and compassionate\r\nphysiotherapist with one year of professional experience at Satspandana\r\nPhysiotherapy Clinic.</span></p><p style=\"line-height: 115%; margin: 12pt 0in 0pt; text-indent: 0in; direction: ltr; unicode-bidi: embed;\">\r\n\r\n</p><p style=\"line-height: 115%; margin: 12pt 0in 0pt; text-indent: 0in; direction: ltr; unicode-bidi: embed;\"><span style=\"font-size: 12pt; font-family: Montserrat; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; color: rgb(89, 89, 89);\">She is committed to delivering\r\nhigh-quality care through a blend of evidence-based techniques, hands-on\r\ntherapy,patient education and empowering patients by creating personalized\r\nexercise plans and guiding lifestyle modifications, fostering a proactive approach\r\nto health and wellness. Her dedication ensures that every patient receives\r\ntailored solutions for their unique needs.</span></p>', '2025-01-19 11:08:59', '2025-01-19 12:35:54'),
(5, 'Physiotherapy', 'Physiotherapist', 'DR. MANORANJEN V P', '<span style=\"font-size: 7pt; font-family: Montserrat; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; color: rgb(89, 89, 89);\">PALLIPURAM</span>', '500', 159753456, 'manoranjan@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Dr_Manoranjan.jpeg', '<p style=\"line-height: 115%; margin: 12pt 0in 0pt; text-indent: 0in; direction: ltr; unicode-bidi: embed;\"><span style=\"font-size: 12pt; font-family: Montserrat; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; color: rgb(89, 89, 89);\">Dedicated physiotherapist with a\r\nfocus on restoring mobility, function, and overall well-being. He brings a\r\nresults-driven approach to patient care, emphasizing thorough assessments and\r\ntargeted interventions.</span></p><p style=\"line-height: 115%; margin: 12pt 0in 0pt; text-indent: 0in; direction: ltr; unicode-bidi: embed;\">\r\n\r\n<span style=\"font-size: 12pt; font-family: Montserrat; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; color: rgb(89, 89, 89);\">He is committed to addressing the\r\nroot causes of discomfort using advanced manual therapy techniques and\r\nprogressive rehabilitation protocols. His patient-centered approach emphasizes\r\ncontinuous learning and collaboration, ensuring that individuals not only\r\nrecover efficiently but also develop long-term resilience to prevent future\r\ninjuries.</span></p>', '2025-01-19 11:11:32', '2025-01-19 12:36:06');

-- --------------------------------------------------------

--
-- Table structure for table `doctorslog`
--

CREATE TABLE `doctorslog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctorslog`
--

INSERT INTO `doctorslog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, NULL, 'doctor1', 0x3a3a3100000000000000000000000000, '2024-07-27 19:44:31', NULL, 0),
(2, 1, 'doctor1@mail.com', 0x3a3a3100000000000000000000000000, '2024-07-27 19:48:16', '28-07-2024 01:24:39 AM', 1),
(3, 1, 'doctor1@mail.com', 0x3a3a3100000000000000000000000000, '2024-08-19 17:35:48', '19-08-2024 11:13:55 PM', 1),
(4, 1, 'doctor1@mail.com', 0x3a3a3100000000000000000000000000, '2024-09-28 15:33:05', '13-10-2024 08:52:27 PM', 1),
(5, 1, 'doctor1@mail.com', 0x3a3a3100000000000000000000000000, '2024-10-14 19:41:26', '15-10-2024 01:15:22 AM', 1),
(6, 1, 'doctor1@mail.com', 0x3a3a3100000000000000000000000000, '2025-01-26 06:18:14', '26-01-2025 12:05:35 PM', 1),
(7, 1, 'doctor1@mail.com', 0x3a3a3100000000000000000000000000, '2025-01-28 16:29:24', '28-01-2025 09:59:49 PM', 1),
(8, 1, 'doctor1@mail.com', 0x3a3a3100000000000000000000000000, '2025-01-28 19:36:39', '29-01-2025 01:07:17 AM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctorspecilization`
--

CREATE TABLE `doctorspecilization` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `programs` text DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctorspecilization`
--

INSERT INTO `doctorspecilization` (`id`, `specilization`, `programs`, `creationDate`, `updationDate`) VALUES
(1, 'Physiotherapy', '                                                                                                                                                                                                                                                                <span id=\"docs-internal-guid-96f40839-7fff-03e7-d861-5f3d78deef55\"><p dir=\"ltr\" style=\"line-height:1.38;margin-top:12pt;margin-bottom:12pt;\"><span style=\"background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space-collapse: preserve;\"><font style=\"\" color=\"#ffffcc\" face=\"comic sans ms\" size=\"4\">Achieve Better Health with Our Specialized Physiotherapy Program</font></span></p><p dir=\"ltr\" style=\"line-height:1.38;margin-top:12pt;margin-bottom:12pt;\"><span style=\"background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space-collapse: preserve;\"><font color=\"#ffffcc\" style=\"\" face=\"comic sans ms\" size=\"4\">Experience personalized and expert care with our Specialized Physiotherapy Program, designed to address a wide range of health concerns and enhance overall well-being. Our program offers customized treatments across various domains to cater to your specific needs, providing comprehensive support for recovery, rehabilitation, and long-term health.</font></span></p><p dir=\"ltr\" style=\"line-height:1.38;margin-top:12pt;margin-bottom:12pt;\"><span style=\"background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space-collapse: preserve;\"><font color=\"#ffffcc\" style=\"\" face=\"comic sans ms\" size=\"4\">Our program includes:</font></span></p><ul style=\"margin-bottom: 0px; padding-inline-start: 48px;\"><li dir=\"ltr\" style=\"list-style-type: disc; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space: pre;\" aria-level=\"1\"><p dir=\"ltr\" style=\"line-height:1.38;margin-top:12pt;margin-bottom:0pt;\" role=\"presentation\"><font color=\"#ffffcc\" face=\"comic sans ms\" size=\"4\"><span style=\"background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; text-wrap-mode: wrap;\">Orthopedic Physiotherapy:</span><span style=\"background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; text-wrap-mode: wrap;\"> Focuses on treating musculoskeletal issues such as joint pain, fractures, sprains, tendonitis, and sports injuries. Our approach includes manual therapy, therapeutic exercises, and modalities like ultrasound and electrical stimulation to restore mobility, strength, and function.</span></font></p></li></ul><div><font color=\"#ffffcc\" face=\"comic sans ms\" size=\"4\"><span style=\"white-space-collapse: preserve;\"><br></span></font></div><ul style=\"margin-bottom: 0px; padding-inline-start: 48px;\"><li dir=\"ltr\" style=\"list-style-type: disc; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space: pre;\" aria-level=\"1\"><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\" role=\"presentation\"><font color=\"#ffffcc\" face=\"comic sans ms\" size=\"4\"><span style=\"background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; text-wrap-mode: wrap;\">Neurological Physiotherapy:</span><span style=\"background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; text-wrap-mode: wrap;\"> Assists individuals with neurological conditions such as stroke, spinal cord injuries, multiple sclerosis, Parkinson\"s disease, and traumatic brain injuries. We provide exercises to improve motor control, coordination, balance, and mobility, along with specialized techniques like neurodevelopmental therapy to optimize rehabilitation.</span></font></p></li></ul><div><font color=\"#ffffcc\" face=\"comic sans ms\" size=\"4\"><span style=\"white-space-collapse: preserve;\"><br></span></font></div><ul style=\"margin-bottom: 0px; padding-inline-start: 48px;\"><li dir=\"ltr\" style=\"list-style-type: disc; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space: pre;\" aria-level=\"1\"><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\" role=\"presentation\"><font color=\"#ffffcc\" face=\"comic sans ms\" size=\"4\"><span style=\"background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; text-wrap-mode: wrap;\">Gynecological Physiotherapy:</span><span style=\"background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; text-wrap-mode: wrap;\"> Supports women\"s health by addressing pregnancy-related concerns, postpartum recovery, pelvic floor dysfunction, urinary incontinence, and menstrual disorders. Our treatments help alleviate pain, strengthen the pelvic muscles, and promote faster postpartum healing through personalized exercise programs and manual therapy.</span></font></p></li></ul><div><font color=\"#ffffcc\" face=\"comic sans ms\" size=\"4\"><span style=\"white-space-collapse: preserve;\"><br></span></font></div><ul style=\"margin-bottom: 0px; padding-inline-start: 48px;\"><li dir=\"ltr\" style=\"list-style-type: disc; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space: pre;\" aria-level=\"1\"><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\" role=\"presentation\"><font color=\"#ffffcc\" face=\"comic sans ms\" size=\"4\"><span style=\"background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; text-wrap-mode: wrap;\">Pediatric Physiotherapy:</span><span style=\"background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; text-wrap-mode: wrap;\"> Addresses developmental delays, congenital conditions, muscular dystrophy, cerebral palsy, and other mobility challenges in children. We focus on improving motor skills, coordination, and strength through child-friendly therapeutic activities, developmental exercises, and play-based treatments.</span></font></p></li></ul><div><font color=\"#ffffcc\" face=\"comic sans ms\" size=\"4\"><span style=\"white-space-collapse: preserve;\"><br></span></font></div><ul style=\"margin-bottom: 0px; padding-inline-start: 48px;\"><li dir=\"ltr\" style=\"list-style-type: disc; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space: pre;\" aria-level=\"1\"><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\" role=\"presentation\"><font color=\"#ffffcc\" face=\"comic sans ms\" size=\"4\"><span style=\"background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; text-wrap-mode: wrap;\">Geriatric Physiotherapy:</span><span style=\"background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; text-wrap-mode: wrap;\"> Tailored for older adults to manage age-related conditions like arthritis, osteoporosis, post-surgical recovery, and fall prevention. Our program includes exercises for improving balance, strength, and mobility to maintain independence and enhance the quality of life in the elderly.</span></font></p></li></ul><div><font color=\"#ffffcc\" face=\"comic sans ms\" size=\"4\"><span style=\"white-space-collapse: preserve;\"><br></span></font></div><ul style=\"margin-bottom: 0px; padding-inline-start: 48px;\"><li dir=\"ltr\" style=\"list-style-type: disc; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space: pre;\" aria-level=\"1\"><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\" role=\"presentation\"><font color=\"#ffffcc\" face=\"comic sans ms\" size=\"4\"><span style=\"background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; text-wrap-mode: wrap;\">Lifestyle Disorders:</span><span style=\"background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; text-wrap-mode: wrap;\"> Offers therapeutic interventions for conditions such as obesity, diabetes, hypertension, and chronic fatigue syndrome. Our physiotherapy treatments are designed to improve metabolic health, increase physical activity, and promote sustainable lifestyle changes through exercise, diet counseling, and stress management techniques.</span></font></p></li></ul><div><font color=\"#ffffcc\" face=\"comic sans ms\" size=\"4\"><span style=\"white-space-collapse: preserve;\"><br></span></font></div><ul style=\"margin-bottom: 0px; padding-inline-start: 48px;\"><li dir=\"ltr\" style=\"list-style-type: disc; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space: pre;\" aria-level=\"1\"><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\" role=\"presentation\"><font color=\"#ffffcc\" face=\"comic sans ms\" size=\"4\"><span style=\"background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; text-wrap-mode: wrap;\">Pain Management:</span><span style=\"background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; text-wrap-mode: wrap;\"> Provides targeted treatments for chronic pain conditions, including back pain, fibromyalgia, joint pain, and repetitive strain injuries. We use a combination of manual therapy, heat and cold therapy, acupuncture, and tailored exercise regimens to reduce pain and improve function.</span></font></p></li></ul><div><font color=\"#ffffcc\" face=\"comic sans ms\" size=\"4\"><span style=\"white-space-collapse: preserve;\"><br></span></font></div><ul style=\"margin-bottom: 0px; padding-inline-start: 48px;\"><li dir=\"ltr\" style=\"list-style-type: disc; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space: pre;\" aria-level=\"1\"><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\" role=\"presentation\"><font color=\"#ffffcc\" face=\"comic sans ms\" size=\"4\"><span style=\"background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; text-wrap-mode: wrap;\">Vertigo Treatment:</span><span style=\"background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; text-wrap-mode: wrap;\"> Addresses balance disorders, dizziness, and vestibular dysfunctions caused by conditions like benign paroxysmal positional vertigo (BPPV), Meniereâ€™s disease, and vestibular neuritis. Our specialized therapies include vestibular rehabilitation exercises, gaze stabilization techniques, and positional maneuvers to alleviate symptoms.</span></font></p></li></ul><div><font color=\"#ffffcc\" face=\"comic sans ms\" size=\"4\"><span style=\"white-space-collapse: preserve;\"><br></span></font></div><ul style=\"margin-bottom: 0px; padding-inline-start: 48px;\"><li dir=\"ltr\" style=\"list-style-type: disc; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space: pre;\" aria-level=\"1\"><p dir=\"ltr\" style=\"line-height: 1.38; margin-top: 0pt; margin-bottom: 12pt;\" role=\"presentation\"><font color=\"#ffffcc\" style=\"\" face=\"comic sans ms\" size=\"4\"><span style=\"background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; text-wrap-mode: wrap;\">Intervertebral Disc Solutions:</span><span style=\"background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; text-wrap-mode: wrap;\"> Manages spine-related conditions such as herniated discs, degenerative disc disease, sciatica, and spondylosis. Our approach combines spinal mobilization, core strengthening exercises, traction therapy, and posture correction to relieve pain, enhance mobility, and promote spine health.</span></font></p></li></ul><p dir=\"ltr\" style=\"line-height:1.38;margin-top:12pt;margin-bottom:12pt;\"><span style=\"background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space-collapse: preserve;\"><font color=\"#ffffcc\" face=\"comic sans ms\" size=\"4\">Take the first step towards improved health with our comprehensive Physiotherapy Program. Our expert team is committed to helping you achieve your wellness goals. Contact us today to begin your journey to better health and well-being!</font></span></p><div><span style=\"font-size: 10pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space-collapse: preserve;\"><br></span></div></span>																													                                                                                                                                                                                                                                                ', '2024-07-27 07:36:55', '2025-01-26 08:37:43'),
(2, 'Ayurveda', '', '2024-07-27 07:37:12', NULL),
(3, 'Fitness', '', '2024-07-27 07:37:20', NULL),
(4, 'Cosmetic Wellness', '', '2024-07-27 07:37:32', NULL),
(5, 'Corporate Wellness', '', '2024-07-27 07:37:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `packagedetails`
--

CREATE TABLE `packagedetails` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `packageName` varchar(255) NOT NULL,
  `days` int(11) NOT NULL,
  `without` varchar(255) NOT NULL,
  `singleOccupancy` varchar(255) NOT NULL,
  `doubleOccupancy` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `packagedetails`
--

INSERT INTO `packagedetails` (`id`, `package_id`, `packageName`, `days`, `without`, `singleOccupancy`, `doubleOccupancy`, `creationDate`, `updationDate`) VALUES
(12, 1, 'Level 1', 7, '$ 350 / â‚¬ 300', '$ 800 / â‚¬ 750', '$ 1300 / â‚¬ 1250', '2025-01-25 15:28:03', '2025-01-25 15:28:03'),
(13, 1, 'Level 2', 14, '$ 700 / â‚¬ 650', '$ 1600 / â‚¬ 1500', '$ 2600 / â‚¬ 2500', '2025-01-25 15:28:03', '2025-01-25 15:28:03'),
(14, 1, 'Level 3', 21, '$ 900 / â‚¬ 850', '$ 2300 / â‚¬ 2200', '$ 3600 / â‚¬ 3400', '2025-01-25 15:28:03', '2025-01-25 15:28:03'),
(15, 1, 'Level 4', 28, '$ 1200 / â‚¬ 1100', '$ 3000 / â‚¬ 2800', '$ 4800 / â‚¬ 4600', '2025-01-25 15:28:03', '2025-01-25 15:28:03'),
(16, 2, 'Level 1', 7, '$ 500 / â‚¬ 450', '$ 1000 / â‚¬ 950', '$ 1700 / â‚¬ 1600', '2025-01-25 15:33:17', '2025-01-25 15:33:17'),
(17, 2, 'Level 2', 14, '$ 800 / â‚¬ 750', '$ 1800 / â‚¬ 1700', '$ 3000 / â‚¬ 2800', '2025-01-25 15:33:17', '2025-01-25 15:33:17'),
(18, 2, 'Level 3', 21, '$ 1200 / â‚¬ 1100', '$ 2500 / â‚¬ 2400', '$ 4000 / â‚¬ 3800', '2025-01-25 15:33:17', '2025-01-25 15:33:17'),
(19, 2, 'Level 4', 28, '$ 1600 / â‚¬ 1500', '$ 3400 / â‚¬ 3200', '$ 5500 / â‚¬ 5300', '2025-01-25 15:33:17', '2025-01-25 15:33:17'),
(20, 3, 'Level 1', 7, '$ 225 / â‚¬ 200', '$ 800 / â‚¬ 750', '$ 1300 / â‚¬ 1250', '2025-01-25 15:40:06', '2025-01-25 15:40:06'),
(21, 3, 'Level 2', 14, '$ 450 / â‚¬ 400', '$ 1600 / â‚¬ 1500', '$ 2600 / â‚¬ 2500', '2025-01-25 15:40:06', '2025-01-25 15:40:06'),
(22, 3, 'Level 3', 21, '$ 650 / â‚¬ 600', '$ 2000 / â‚¬ 1900', '$ 3600 / â‚¬ 3500', '2025-01-25 15:40:06', '2025-01-25 15:40:06'),
(23, 3, 'Level 4', 28, '$ 800 / â‚¬ 750', '$ 2600 / â‚¬ 2500', '$ 4500 / â‚¬ 4300', '2025-01-25 15:40:06', '2025-01-25 15:40:06'),
(24, 4, 'Ojas', 3, '$ 135 / â‚¬ 125', '$ 350 / â‚¬ 325', '$ 575 / â‚¬ 550', '2025-01-25 19:19:11', '2025-01-25 19:19:11'),
(25, 4, 'Shakthi', 5, '$ 250 / â‚¬ 225', '$ 600 / â‚¬ 560', '$ 1000 / â‚¬ 950', '2025-01-25 19:19:11', '2025-01-25 19:19:11'),
(26, 4, 'Ananda', 7, '$ 350 / â‚¬ 300', '$ 750 / â‚¬ 700', '$ 1250 / â‚¬ 1200', '2025-01-25 19:19:11', '2025-01-25 19:19:11'),
(27, 4, 'Chaithanya', 14, '$ 650 / â‚¬ 600', '$ 1500 / â‚¬ 1400', '$ 2500 / â‚¬ 2300', '2025-01-25 19:19:11', '2025-01-25 19:19:11'),
(28, 5, 'Shukthi', 7, '', '$ 800 / â‚¬ 750', '$ 1300 / â‚¬ 1250', '2025-01-25 19:21:15', '2025-01-25 19:21:15'),
(29, 5, 'Pavithra', 14, '', '$ 1600 / â‚¬ 1500', '$ 2600 / â‚¬ 2500', '2025-01-25 19:21:15', '2025-01-25 19:21:15'),
(30, 5, 'Nirmala', 21, '', '$ 2200 / â‚¬ 2000', '$ 3500 / â‚¬ 3400', '2025-01-25 19:21:15', '2025-01-25 19:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `treatmentName` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `specialization`, `treatmentName`, `description`, `creationDate`, `updationDate`) VALUES
(1, 'Physiotherapy', 'Knee Clinic', 'Knee Clinic specializes in non-surgical solutions for knee health, addressing a range of complications from pain management to mobility improvement. Our expert team offers personalized care plans to help restore function, alleviate discomfort, and support your active lifestyle.', '2025-01-25 10:12:38', '2025-01-25 10:12:38'),
(2, 'Physiotherapy', 'Spinal Clinic', 'Spinal Clinic is dedicated to non-surgical treatments for spinal health, focusing on pain relief, posture correction, and mobility enhancement. Our comprehensive approach addresses various spinal conditions to improve quality of life and restore balance to your spine.', '2025-01-25 15:33:17', '2025-01-25 15:33:17'),
(3, 'Physiotherapy', 'Shoulder Clinic', 'Shoulder Clinic provides specialized, non-surgical care for shoulder pain, injuries, and mobility issues. Our expert team focuses on personalized treatment plans to restore strength, improve range of motion, and support your daily activities pain-free.', '2025-01-25 15:40:06', '2025-01-25 15:40:06'),
(4, 'Ayurveda', 'Rejuvenation Therapy', 'Discover the holistic benefits of our Rejuvenation Ayurvedic Therapy, designed to nourish your body, mind, and spirit. Immerse yourself in a range of transformative treatments, including Abhyanga (therapeutic oil massage), Shirodhara (a calming oil treatment for the forehead), and invigorating herbal steam baths. These therapies work together to enhance circulation, relieve stress, and restore balance, leaving you feeling rejuvenated and revitalized. Embrace a path to wellness with our expertly crafted Ayurvedic treatments.', '2025-01-25 19:19:11', '2025-01-25 19:19:11'),
(5, 'Ayurveda', 'Detox Package (Only with Accomodation)', 'Experience the rejuvenating power of our Detoxification Ayurveda Package, meticulously crafted to cleanse your body of toxins and restore balance. This comprehensive package includes personalized therapies such as Panchakarma, invigorating herbal steam baths, and essential treatments like Virechana (therapeutic purgation) and Abhyanga (therapeutic oil massage). Embrace a holistic approach to wellness and revitalize your body and mind with our expert Ayurvedic therapies.', '2025-01-25 19:21:15', '2025-01-25 19:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactus`
--

CREATE TABLE `tblcontactus` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(12) DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `LastupdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `IsRead` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcontactus`
--

INSERT INTO `tblcontactus` (`id`, `fullname`, `email`, `contactno`, `message`, `PostingDate`, `AdminRemark`, `LastupdationDate`, `IsRead`) VALUES
(1, 'Test', 'test@mail.com', 123456789, 'Message ...', '2024-07-27 08:07:36', NULL, NULL, NULL),
(2, 'Athul', 'athul.mhn@gmail.com', 8907821081, 'msg...', '2024-09-14 18:10:27', NULL, NULL, NULL),
(3, 'Athul', 'athul.mhn@gmail.com', 8527419632, 'Test message ...', '2025-01-26 06:28:39', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblmedicalhistory`
--

CREATE TABLE `tblmedicalhistory` (
  `ID` int(10) NOT NULL,
  `PatientID` int(10) DEFAULT NULL,
  `BloodPressure` varchar(200) DEFAULT NULL,
  `BloodSugar` varchar(200) NOT NULL,
  `Weight` varchar(100) DEFAULT NULL,
  `Temperature` varchar(200) DEFAULT NULL,
  `MedicalPres` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblmedicalhistory`
--

INSERT INTO `tblmedicalhistory` (`ID`, `PatientID`, `BloodPressure`, `BloodSugar`, `Weight`, `Temperature`, `MedicalPres`, `CreationDate`) VALUES
(1, 2, '80/120', '110', '85', '97', 'Dolo,\r\nLevocit 5mg', '2024-05-16 09:07:16'),
(2, 1, '120/80', '120mgdl', '58', '98.5', 'Not a good condition. But having no problems though.', '2024-07-27 19:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` varchar(200) DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT current_timestamp(),
  `OpenningTime` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`, `OpenningTime`) VALUES
(1, 'aboutus', 'About Us', '<ul style=\"padding: 0px; margin-right: 0px; margin-bottom: 1.313em; margin-left: 1.655em;\" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" center;=\"\" background-color:=\"\" rgb(255,=\"\" 246,=\"\" 246);\"=\"\"><li style=\"text-align: left;\"><font color=\"#000000\">Satspandana was founded in August 2014 as a sanctuary for those seeking holistic health through yoga. Our founder, Sanjith Satspandana, is a qualified physiotherapist and a registered international yoga teacher. With a vision to blend the ancient wisdom of yoga with modern physiotherapy techniques, Sanjith established Satspandana to help individuals achieve optimal health and well-being.</font></li>\r\n<li></li>\r\n<li></li>\r\n<li style=\"text-align: left;\"><font color=\"#000000\">At Satspandana, we are dedicated to fostering a holistic approach to health and wellness. By integrating yoga, physiotherapy, and now Ayurveda, we aim to provide personalized care that addresses the unique needs of each individual. Our goal is to empower our clients with the knowledge and tools needed to lead healthier, more balanced lives.&nbsp;</font></li></ul>', NULL, NULL, '2020-05-20 07:21:52', NULL),
(2, 'contactus', 'Branches & Contact Details', '<b>Satspandana Wellness Retreat, Pirappancode&nbsp;</b><div>Address: Satspandana Wellness Retreat, Near Kaithara Devi Temple, Pirappancode P O, Trivandrum, Kerala 695607</div><div><br></div><div><span style=\"font-weight: 700;\">Satspandana Physiotherapy Clinic, Kanyakulangara</span><div>Address: Satspandana&nbsp;Physiotherapy&nbsp;Clinic, Opposite to CHC,&nbsp;Kanyakulangara, Trivandrum, Kerala</div><div><br></div><div><span style=\"font-weight: 700;\">Satspandana Physiotherapy Clinic, Pallipuram</span><div>Address: Satspandana&nbsp;Physiotherapy&nbsp;Clinic, Near Thonnal Devi Temple, Pallipuram, Kazhakkoottam, Trivandrum, Kerala</div></div><div><br><div><br></div><div><br></div></div></div>', 'satspandanawellness@gmail.com', 8281604406, '2020-05-20 07:24:07', '9 am To 8 Pm');

-- --------------------------------------------------------

--
-- Table structure for table `tblpatient`
--

CREATE TABLE `tblpatient` (
  `ID` int(10) NOT NULL,
  `Docid` int(10) DEFAULT NULL,
  `PatientName` varchar(200) DEFAULT NULL,
  `PatientContno` bigint(10) DEFAULT NULL,
  `PatientEmail` varchar(200) DEFAULT NULL,
  `PatientGender` varchar(50) DEFAULT NULL,
  `PatientAdd` mediumtext DEFAULT NULL,
  `PatientAge` int(10) DEFAULT NULL,
  `PatientMedhis` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpatient`
--

INSERT INTO `tblpatient` (`ID`, `Docid`, `PatientName`, `PatientContno`, `PatientEmail`, `PatientGender`, `PatientAdd`, `PatientAge`, `PatientMedhis`, `CreationDate`, `UpdationDate`) VALUES
(1, 1, 'Patient 1', 452463210, 'patient1@gmail.com', 'Male', 'NA', 32, 'Back Pain', '2024-05-16 05:23:35', '2024-09-28 15:34:07'),
(2, 1, 'Patient 2', 4545454545, 'patient2@gmail.com', 'male', 'NA', 45, 'Cold, Cough and Neck Pain', '2024-05-16 09:01:26', NULL),
(3, 1, 'Patient 3', 8745213690, 'patient3@gmail.com', 'Female', 'Patient Address', 25, 'Medical History', '2024-07-27 19:52:02', '2024-07-27 19:52:21');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, 1, 'johndoe12@test.com', 0x3a3a3100000000000000000000000000, '2024-05-15 03:41:48', NULL, 1),
(2, 2, 'amitk@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-16 09:08:06', '16-05-2024 02:41:06 PM', 1),
(3, NULL, 'patient1@mail.com', 0x3a3a3100000000000000000000000000, '2024-07-27 08:43:45', NULL, 0),
(4, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-27 08:43:58', NULL, 0),
(5, 3, 'patient3@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-27 08:44:13', '27-07-2024 02:25:48 PM', 1),
(6, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-27 19:45:31', NULL, 0),
(7, 3, 'patient3@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-27 19:47:15', '28-07-2024 01:17:42 AM', 1),
(8, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 08:00:22', NULL, 0),
(9, 3, 'patient3@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 08:00:41', '31-08-2024 01:30:49 PM', 1),
(10, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 08:04:56', NULL, 0),
(11, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 08:22:29', NULL, 0),
(12, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 08:31:04', NULL, 0),
(13, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 08:31:27', NULL, 0),
(14, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 08:34:19', NULL, 0),
(15, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 08:34:26', NULL, 0),
(16, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 08:36:41', NULL, 0),
(17, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 08:38:07', NULL, 0),
(18, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 08:38:57', NULL, 0),
(19, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 08:39:53', NULL, 0),
(20, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 08:40:00', NULL, 0),
(21, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 08:40:30', NULL, 0),
(22, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 15:48:30', NULL, 0),
(23, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 15:48:46', NULL, 0),
(24, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 16:28:18', NULL, 0),
(25, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 16:42:27', NULL, 0),
(26, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 16:54:48', NULL, 0),
(27, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 16:56:09', NULL, 0),
(28, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 17:16:08', NULL, 0),
(29, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 17:20:48', NULL, 0),
(30, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 17:27:36', NULL, 0),
(31, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 17:29:43', NULL, 0),
(32, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 17:30:04', NULL, 0),
(33, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 18:02:35', NULL, 0),
(34, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 18:04:29', NULL, 0),
(35, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 18:09:36', NULL, 0),
(36, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 18:11:43', NULL, 0),
(37, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 18:12:14', NULL, 0),
(38, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 18:13:53', NULL, 0),
(39, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 18:15:14', NULL, 0),
(40, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 18:16:03', NULL, 0),
(41, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 18:40:14', NULL, 0),
(42, 3, 'patient3@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 18:40:37', NULL, 1),
(43, 3, 'patient3@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-31 18:41:01', '01-09-2024 11:29:58 PM', 1),
(44, 3, 'patient3@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-01 19:07:12', '02-09-2024 12:37:36 AM', 1),
(45, 3, 'patient3@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-28 15:32:03', '28-09-2024 09:02:39 PM', 1),
(46, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-13 15:23:03', NULL, 0),
(47, 3, 'patient3@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-13 15:23:21', '13-10-2024 08:53:51 PM', 1),
(48, 3, 'patient3@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-14 19:13:14', '15-10-2024 01:11:16 AM', 1),
(49, NULL, 'patient1@gmail.com', 0x3a3a3100000000000000000000000000, '2025-01-26 09:47:45', NULL, 0),
(50, NULL, 'patient3@gmail.com', 0x3a3a3100000000000000000000000000, '2025-01-26 09:48:39', NULL, 0),
(51, 3, 'patient3@gmail.com', 0x3a3a3100000000000000000000000000, '2025-01-26 09:49:19', '26-01-2025 03:19:46 PM', 1),
(52, 3, 'patient3@gmail.com', 0x3a3a3100000000000000000000000000, '2025-01-28 19:37:42', '30-01-2025 12:53:34 AM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `address`, `city`, `gender`, `email`, `password`, `regDate`, `updationDate`) VALUES
(1, 'Patient 1', 'Patient 1 Address', 'Patient City', 'female', 'patient1@gmail.com', NULL, '2024-07-27 19:41:30', NULL),
(2, 'Patient 2', 'Patient 2 Address', 'Patient 2 City', 'male', 'patient2@gmail.com', NULL, '2024-07-27 19:44:04', NULL),
(3, 'Patient 3', 'Patient 3 Address', 'Patient 3 City', 'male', 'patient3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2024-07-27 19:46:59', '2024-09-01 17:56:16'),
(4, 'Patient 7', 'Patient 7 Address', 'Klm', 'female', 'patient7@gmail.com', NULL, '2024-09-01 18:06:17', NULL),
(5, 'Patient 8', 'Patient 8 Address', 'Patient City', 'male', 'patient8@gmail.com', NULL, '2024-09-01 18:07:46', NULL),
(6, 'N Name', 'N-add', 'N-loc', 'male', 'n@mail.com', NULL, '2025-01-28 16:23:20', NULL),
(7, 'Test Time slot', 'Time Slot', 'Slot', 'male', 'time-slot@mail.com', NULL, '2025-01-28 19:23:15', NULL),
(8, 'Test Time slot 01', 'Time Slot', 'Slot', 'male', 'time-slot@mail.com', NULL, '2025-01-28 19:25:44', NULL),
(9, 'Test Time slot 01', 'Time Slot', 'Slot', 'male', 'time-slot@mail.com', NULL, '2025-01-28 19:30:17', NULL),
(10, 'Test Time slot 01', 'Test', 'Trivandrum', 'male', 'mail@mail.com', NULL, '2025-01-28 19:33:33', NULL),
(11, 'Test Time slot 01', 'Test', 'Trivandrum', 'male', 'mail@mail.com', NULL, '2025-01-28 19:34:04', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accommodations`
--
ALTER TABLE `accommodations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_slots`
--
ALTER TABLE `booking_slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorslog`
--
ALTER TABLE `doctorslog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packagedetails`
--
ALTER TABLE `packagedetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpatient`
--
ALTER TABLE `tblpatient`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accommodations`
--
ALTER TABLE `accommodations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `booking_slots`
--
ALTER TABLE `booking_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctorslog`
--
ALTER TABLE `doctorslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `packagedetails`
--
ALTER TABLE `packagedetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpatient`
--
ALTER TABLE `tblpatient`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
