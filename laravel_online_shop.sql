-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2025 at 03:15 PM
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
-- Database: `laravel_online_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ComfortHome', 'comforthome', 1, '2025-08-13 20:05:21', '2025-08-13 20:05:21'),
(2, 'LuxeLiving', 'luxeliving', 1, '2025-08-13 20:05:21', '2025-08-13 20:05:21'),
(3, 'CozyNest', 'cozynest', 1, '2025-08-13 20:05:21', '2025-08-13 20:05:21'),
(4, 'SleepWell', 'sleepwell', 1, '2025-08-13 20:05:23', '2025-08-13 20:05:23'),
(5, 'DreamCraft', 'dreamcraft', 1, '2025-08-13 20:05:23', '2025-08-13 20:05:23'),
(6, 'RestEase', 'restease', 1, '2025-08-13 20:05:23', '2025-08-13 20:05:23'),
(7, 'ChefMaster', 'chefmaster', 1, '2025-08-13 20:05:24', '2025-08-13 20:05:24'),
(8, 'KitchenLux', 'kitchenlux', 1, '2025-08-13 20:05:25', '2025-08-13 20:05:25'),
(9, 'CookEase', 'cookease', 1, '2025-08-13 20:05:25', '2025-08-13 20:05:25'),
(10, 'GuestComfort', 'guestcomfort', 1, '2025-08-13 20:05:26', '2025-08-13 20:05:26'),
(11, 'Welcomia', 'welcomia', 1, '2025-08-13 20:05:26', '2025-08-13 20:05:26'),
(12, 'CozyGuest', 'cozyguest', 1, '2025-08-13 20:05:26', '2025-08-13 20:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `category_img` varchar(255) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `showHome` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `category_img`, `status`, `showHome`, `created_at`, `updated_at`) VALUES
(1, 'Living Room', 'living-room', '1-1755225749.jpg', '1', 'YES', '2025-08-13 20:05:20', '2025-08-14 20:42:29'),
(2, 'Bedroom', 'bedroom', '2-1755225795.jpg', '1', 'YES', '2025-08-13 20:05:22', '2025-08-14 20:43:15'),
(3, 'Kitchen', 'kitchen', '3-1755225828.jpg', '1', 'YES', '2025-08-13 20:05:24', '2025-08-14 20:43:48'),
(4, 'Guest Room', 'guest-room', '4-1755225881.jpg', '1', 'YES', '2025-08-13 20:05:26', '2025-08-14 20:44:41');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'United States', 'US', NULL, NULL),
(2, 'Canada', 'CA', NULL, NULL),
(3, 'Afghanistan', 'AF', NULL, NULL),
(4, 'Albania', 'AL', NULL, NULL),
(5, 'Algeria', 'DZ', NULL, NULL),
(6, 'American Samoa', 'AS', NULL, NULL),
(7, 'Andorra', 'AD', NULL, NULL),
(8, 'Angola', 'AO', NULL, NULL),
(9, 'Anguilla', 'AI', NULL, NULL),
(10, 'Antarctica', 'AQ', NULL, NULL),
(11, 'Antigua and/or Barbuda', 'AG', NULL, NULL),
(12, 'Argentina', 'AR', NULL, NULL),
(13, 'Armenia', 'AM', NULL, NULL),
(14, 'Aruba', 'AW', NULL, NULL),
(15, 'Australia', 'AU', NULL, NULL),
(16, 'Austria', 'AT', NULL, NULL),
(17, 'Azerbaijan', 'AZ', NULL, NULL),
(18, 'Bahamas', 'BS', NULL, NULL),
(19, 'Bahrain', 'BH', NULL, NULL),
(20, 'Bangladesh', 'BD', NULL, NULL),
(21, 'Barbados', 'BB', NULL, NULL),
(22, 'Belarus', 'BY', NULL, NULL),
(23, 'Belgium', 'BE', NULL, NULL),
(24, 'Belize', 'BZ', NULL, NULL),
(25, 'Benin', 'BJ', NULL, NULL),
(26, 'Bermuda', 'BM', NULL, NULL),
(27, 'Bhutan', 'BT', NULL, NULL),
(28, 'Bolivia', 'BO', NULL, NULL),
(29, 'Bosnia and Herzegovina', 'BA', NULL, NULL),
(30, 'Botswana', 'BW', NULL, NULL),
(31, 'Bouvet Island', 'BV', NULL, NULL),
(32, 'Brazil', 'BR', NULL, NULL),
(33, 'British lndian Ocean Territory', 'IO', NULL, NULL),
(34, 'Brunei Darussalam', 'BN', NULL, NULL),
(35, 'Bulgaria', 'BG', NULL, NULL),
(36, 'Burkina Faso', 'BF', NULL, NULL),
(37, 'Burundi', 'BI', NULL, NULL),
(38, 'Cambodia', 'KH', NULL, NULL),
(39, 'Cameroon', 'CM', NULL, NULL),
(40, 'Cape Verde', 'CV', NULL, NULL),
(41, 'Cayman Islands', 'KY', NULL, NULL),
(42, 'Central African Republic', 'CF', NULL, NULL),
(43, 'Chad', 'TD', NULL, NULL),
(44, 'Chile', 'CL', NULL, NULL),
(45, 'China', 'CN', NULL, NULL),
(46, 'Christmas Island', 'CX', NULL, NULL),
(47, 'Cocos (Keeling) Islands', 'CC', NULL, NULL),
(48, 'Colombia', 'CO', NULL, NULL),
(49, 'Comoros', 'KM', NULL, NULL),
(50, 'Congo', 'CG', NULL, NULL),
(51, 'Cook Islands', 'CK', NULL, NULL),
(52, 'Costa Rica', 'CR', NULL, NULL),
(53, 'Croatia (Hrvatska)', 'HR', NULL, NULL),
(54, 'Cuba', 'CU', NULL, NULL),
(55, 'Cyprus', 'CY', NULL, NULL),
(56, 'Czech Republic', 'CZ', NULL, NULL),
(57, 'Democratic Republic of Congo', 'CD', NULL, NULL),
(58, 'Denmark', 'DK', NULL, NULL),
(59, 'Djibouti', 'DJ', NULL, NULL),
(60, 'Dominica', 'DM', NULL, NULL),
(61, 'Dominican Republic', 'DO', NULL, NULL),
(62, 'East Timor', 'TP', NULL, NULL),
(63, 'Ecudaor', 'EC', NULL, NULL),
(64, 'Egypt', 'EG', NULL, NULL),
(65, 'El Salvador', 'SV', NULL, NULL),
(66, 'Equatorial Guinea', 'GQ', NULL, NULL),
(67, 'Eritrea', 'ER', NULL, NULL),
(68, 'Estonia', 'EE', NULL, NULL),
(69, 'Ethiopia', 'ET', NULL, NULL),
(70, 'Falkland Islands (Malvinas)', 'FK', NULL, NULL),
(71, 'Faroe Islands', 'FO', NULL, NULL),
(72, 'Fiji', 'FJ', NULL, NULL),
(73, 'Finland', 'FI', NULL, NULL),
(74, 'France', 'FR', NULL, NULL),
(75, 'France, Metropolitan', 'FX', NULL, NULL),
(76, 'French Guiana', 'GF', NULL, NULL),
(77, 'French Polynesia', 'PF', NULL, NULL),
(78, 'French Southern Territories', 'TF', NULL, NULL),
(79, 'Gabon', 'GA', NULL, NULL),
(80, 'Gambia', 'GM', NULL, NULL),
(81, 'Georgia', 'GE', NULL, NULL),
(82, 'Germany', 'DE', NULL, NULL),
(83, 'Ghana', 'GH', NULL, NULL),
(84, 'Gibraltar', 'GI', NULL, NULL),
(85, 'Greece', 'GR', NULL, NULL),
(86, 'Greenland', 'GL', NULL, NULL),
(87, 'Grenada', 'GD', NULL, NULL),
(88, 'Guadeloupe', 'GP', NULL, NULL),
(89, 'Guam', 'GU', NULL, NULL),
(90, 'Guatemala', 'GT', NULL, NULL),
(91, 'Guinea', 'GN', NULL, NULL),
(92, 'Guinea-Bissau', 'GW', NULL, NULL),
(93, 'Guyana', 'GY', NULL, NULL),
(94, 'Haiti', 'HT', NULL, NULL),
(95, 'Heard and Mc Donald Islands', 'HM', NULL, NULL),
(96, 'Honduras', 'HN', NULL, NULL),
(97, 'Hong Kong', 'HK', NULL, NULL),
(98, 'Hungary', 'HU', NULL, NULL),
(99, 'Iceland', 'IS', NULL, NULL),
(100, 'India', 'IN', NULL, NULL),
(101, 'Indonesia', 'ID', NULL, NULL),
(102, 'Iran (Islamic Republic of)', 'IR', NULL, NULL),
(103, 'Iraq', 'IQ', NULL, NULL),
(104, 'Ireland', 'IE', NULL, NULL),
(105, 'Israel', 'IL', NULL, NULL),
(106, 'Italy', 'IT', NULL, NULL),
(107, 'Ivory Coast', 'CI', NULL, NULL),
(108, 'Jamaica', 'JM', NULL, NULL),
(109, 'Japan', 'JP', NULL, NULL),
(110, 'Jordan', 'JO', NULL, NULL),
(111, 'Kazakhstan', 'KZ', NULL, NULL),
(112, 'Kenya', 'KE', NULL, NULL),
(113, 'Kiribati', 'KI', NULL, NULL),
(114, 'Korea, Democratic People\'s Republic of', 'KP', NULL, NULL),
(115, 'Korea, Republic of', 'KR', NULL, NULL),
(116, 'Kuwait', 'KW', NULL, NULL),
(117, 'Kyrgyzstan', 'KG', NULL, NULL),
(118, 'Lao People\'s Democratic Republic', 'LA', NULL, NULL),
(119, 'Latvia', 'LV', NULL, NULL),
(120, 'Lebanon', 'LB', NULL, NULL),
(121, 'Lesotho', 'LS', NULL, NULL),
(122, 'Liberia', 'LR', NULL, NULL),
(123, 'Libyan Arab Jamahiriya', 'LY', NULL, NULL),
(124, 'Liechtenstein', 'LI', NULL, NULL),
(125, 'Lithuania', 'LT', NULL, NULL),
(126, 'Luxembourg', 'LU', NULL, NULL),
(127, 'Macau', 'MO', NULL, NULL),
(128, 'Macedonia', 'MK', NULL, NULL),
(129, 'Madagascar', 'MG', NULL, NULL),
(130, 'Malawi', 'MW', NULL, NULL),
(131, 'Malaysia', 'MY', NULL, NULL),
(132, 'Maldives', 'MV', NULL, NULL),
(133, 'Mali', 'ML', NULL, NULL),
(134, 'Malta', 'MT', NULL, NULL),
(135, 'Marshall Islands', 'MH', NULL, NULL),
(136, 'Martinique', 'MQ', NULL, NULL),
(137, 'Mauritania', 'MR', NULL, NULL),
(138, 'Mauritius', 'MU', NULL, NULL),
(139, 'Mayotte', 'TY', NULL, NULL),
(140, 'Mexico', 'MX', NULL, NULL),
(141, 'Micronesia, Federated States of', 'FM', NULL, NULL),
(142, 'Moldova, Republic of', 'MD', NULL, NULL),
(143, 'Monaco', 'MC', NULL, NULL),
(144, 'Mongolia', 'MN', NULL, NULL),
(145, 'Montserrat', 'MS', NULL, NULL),
(146, 'Morocco', 'MA', NULL, NULL),
(147, 'Mozambique', 'MZ', NULL, NULL),
(148, 'Myanmar', 'MM', NULL, NULL),
(149, 'Namibia', 'NA', NULL, NULL),
(150, 'Nauru', 'NR', NULL, NULL),
(151, 'Nepal', 'NP', NULL, NULL),
(152, 'Netherlands', 'NL', NULL, NULL),
(153, 'Netherlands Antilles', 'AN', NULL, NULL),
(154, 'New Caledonia', 'NC', NULL, NULL),
(155, 'New Zealand', 'NZ', NULL, NULL),
(156, 'Nicaragua', 'NI', NULL, NULL),
(157, 'Niger', 'NE', NULL, NULL),
(158, 'Nigeria', 'NG', NULL, NULL),
(159, 'Niue', 'NU', NULL, NULL),
(160, 'Norfork Island', 'NF', NULL, NULL),
(161, 'Northern Mariana Islands', 'MP', NULL, NULL),
(162, 'Norway', 'NO', NULL, NULL),
(163, 'Oman', 'OM', NULL, NULL),
(164, 'Pakistan', 'PK', NULL, NULL),
(165, 'Palau', 'PW', NULL, NULL),
(166, 'Panama', 'PA', NULL, NULL),
(167, 'Papua New Guinea', 'PG', NULL, NULL),
(168, 'Paraguay', 'PY', NULL, NULL),
(169, 'Peru', 'PE', NULL, NULL),
(170, 'Philippines', 'PH', NULL, NULL),
(171, 'Pitcairn', 'PN', NULL, NULL),
(172, 'Poland', 'PL', NULL, NULL),
(173, 'Portugal', 'PT', NULL, NULL),
(174, 'Puerto Rico', 'PR', NULL, NULL),
(175, 'Qatar', 'QA', NULL, NULL),
(176, 'Republic of South Sudan', 'SS', NULL, NULL),
(177, 'Reunion', 'RE', NULL, NULL),
(178, 'Romania', 'RO', NULL, NULL),
(179, 'Russian Federation', 'RU', NULL, NULL),
(180, 'Rwanda', 'RW', NULL, NULL),
(181, 'Saint Kitts and Nevis', 'KN', NULL, NULL),
(182, 'Saint Lucia', 'LC', NULL, NULL),
(183, 'Saint Vincent and the Grenadines', 'VC', NULL, NULL),
(184, 'Samoa', 'WS', NULL, NULL),
(185, 'San Marino', 'SM', NULL, NULL),
(186, 'Sao Tome and Principe', 'ST', NULL, NULL),
(187, 'Saudi Arabia', 'SA', NULL, NULL),
(188, 'Senegal', 'SN', NULL, NULL),
(189, 'Serbia', 'RS', NULL, NULL),
(190, 'Seychelles', 'SC', NULL, NULL),
(191, 'Sierra Leone', 'SL', NULL, NULL),
(192, 'Singapore', 'SG', NULL, NULL),
(193, 'Slovakia', 'SK', NULL, NULL),
(194, 'Slovenia', 'SI', NULL, NULL),
(195, 'Solomon Islands', 'SB', NULL, NULL),
(196, 'Somalia', 'SO', NULL, NULL),
(197, 'South Africa', 'ZA', NULL, NULL),
(198, 'South Georgia South Sandwich Islands', 'GS', NULL, NULL),
(199, 'Spain', 'ES', NULL, NULL),
(200, 'Sri Lanka', 'LK', NULL, NULL),
(201, 'St. Helena', 'SH', NULL, NULL),
(202, 'St. Pierre and Miquelon', 'PM', NULL, NULL),
(203, 'Sudan', 'SD', NULL, NULL),
(204, 'Suriname', 'SR', NULL, NULL),
(205, 'Svalbarn and Jan Mayen Islands', 'SJ', NULL, NULL),
(206, 'Swaziland', 'SZ', NULL, NULL),
(207, 'Sweden', 'SE', NULL, NULL),
(208, 'Switzerland', 'CH', NULL, NULL),
(209, 'Syrian Arab Republic', 'SY', NULL, NULL),
(210, 'Taiwan', 'TW', NULL, NULL),
(211, 'Tajikistan', 'TJ', NULL, NULL),
(212, 'Tanzania, United Republic of', 'TZ', NULL, NULL),
(213, 'Thailand', 'TH', NULL, NULL),
(214, 'Togo', 'TG', NULL, NULL),
(215, 'Tokelau', 'TK', NULL, NULL),
(216, 'Tonga', 'TO', NULL, NULL),
(217, 'Trinidad and Tobago', 'TT', NULL, NULL),
(218, 'Tunisia', 'TN', NULL, NULL),
(219, 'Turkey', 'TR', NULL, NULL),
(220, 'Turkmenistan', 'TM', NULL, NULL),
(221, 'Turks and Caicos Islands', 'TC', NULL, NULL),
(222, 'Tuvalu', 'TV', NULL, NULL),
(223, 'Uganda', 'UG', NULL, NULL),
(224, 'Ukraine', 'UA', NULL, NULL),
(225, 'United Arab Emirates', 'AE', NULL, NULL),
(226, 'United Kingdom', 'GB', NULL, NULL),
(227, 'United States minor outlying islands', 'UM', NULL, NULL),
(228, 'Uruguay', 'UY', NULL, NULL),
(229, 'Uzbekistan', 'UZ', NULL, NULL),
(230, 'Vanuatu', 'VU', NULL, NULL),
(231, 'Vatican City State', 'VA', NULL, NULL),
(232, 'Venezuela', 'VE', NULL, NULL),
(233, 'Vietnam', 'VN', NULL, NULL),
(234, 'Virgin Islands (British)', 'VG', NULL, NULL),
(235, 'Virgin Islands (U.S.)', 'VI', NULL, NULL),
(236, 'Wallis and Futuna Islands', 'WF', NULL, NULL),
(237, 'Western Sahara', 'EH', NULL, NULL),
(238, 'Yemen', 'YE', NULL, NULL),
(239, 'Yugoslavia', 'YU', NULL, NULL),
(240, 'Zaire', 'ZR', NULL, NULL),
(241, 'Zambia', 'ZM', NULL, NULL),
(242, 'Zimbabwe', 'ZW', NULL, NULL),
(243, 'Rest of the world\r\n', 'ZY', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `user_id`, `first_name`, `last_name`, `email`, `mobile`, `country_id`, `address`, `apartment`, `city`, `state`, `zip`, `notes`, `created_at`, `updated_at`) VALUES
(2, 25, 'rony', 'Akter', 'shima2@gmail.com', '01965335790', 7, '83, muradpur kudrat ali bazzar', 'vbg', 'Dhaka', 'jurain', '1216', 'bnhg', '2024-10-27 22:24:12', '2024-10-30 05:05:57'),
(3, 28, 'sumona', 'Akter', 'sumona@gmail.com', '01965335790', 20, '83, muradpur kudrat ali bazzar', 'vbg', 'Dhaka', 'jurain', '1216', 'bnvghjklmuytrew', '2024-11-11 08:36:00', '2024-11-11 08:36:00'),
(4, 26, 'shima', 'Akter', 'sabina2@gmail.com', '01965335790', 8, '83, muradpur kudrat ali bazzar', 'vbg', 'Dhaka', 'jurain', '1216', NULL, '2024-11-13 06:26:32', '2024-11-18 08:46:00'),
(5, 27, 'rony', 'Akter', 'shima16@gmail.com', '01965335790', 7, '83, muradpur kudrat ali bazzar', 'vbg', 'Dhaka', 'jurain', '1216', NULL, '2024-12-02 07:21:34', '2024-12-08 00:32:14'),
(6, 34, 'sumitra', 'Akter', 'sumitra@gmail.com', '01965335790', 20, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2024-12-08 06:35:33', '2024-12-08 06:35:33'),
(7, 35, 'suchitra', 'Akter', 'suchitra@gmail.com', '01965335790', 14, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2024-12-08 06:51:38', '2024-12-08 06:51:38'),
(8, 36, 'jony', 'Akter', 'jony@gmail.com', '01965335790', 20, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2024-12-08 07:53:30', '2024-12-08 07:53:30'),
(9, 37, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2024-12-08 08:27:35', '2025-02-05 19:38:52'),
(10, 38, 'rubel', 'hossen', 'rubel@gmail.com', '01965335790', 240, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-01-01 10:31:47', '2025-01-01 10:31:47'),
(11, 39, 'sabiha', 'Akter', 'sabiha@gmail.com', '01965335790', 20, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-01-01 10:47:58', '2025-01-01 10:47:58'),
(12, 54, 'Shima', 'Akter', 'shimacse22@gmail.com', '01568923154', 4, '83,muradpur kudrat ali bazzar', NULL, 'dhaka', 'jurain', '1216', NULL, '2025-07-08 09:03:08', '2025-07-08 09:03:08'),
(13, 55, 'Shima', 'Akter', 'shimacse22@gmail.com', '01965335790', 5, 'fhgjmhmkj,m', NULL, 'dhaka', 'jurain', '1216', NULL, '2025-08-07 22:01:12', '2025-08-07 22:01:12');

-- --------------------------------------------------------

--
-- Table structure for table `discount_coupons`
--

CREATE TABLE `discount_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `max_uses` int(11) DEFAULT NULL,
  `max_uses_user` int(11) DEFAULT NULL,
  `type` enum('percent','fixed') NOT NULL DEFAULT 'fixed',
  `discount_amount` double DEFAULT NULL,
  `min_amount` double DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `starts_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discount_coupons`
--

INSERT INTO `discount_coupons` (`id`, `code`, `name`, `description`, `max_uses`, `max_uses_user`, `type`, `discount_amount`, `min_amount`, `status`, `starts_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(3, 'ghyt123', 'shima', NULL, NULL, NULL, 'percent', 30, NULL, 1, '2024-12-04 21:00:13', '2024-12-10 12:52:34', '2024-11-28 06:54:23', '2024-12-04 07:08:45'),
(4, 'bgfr45', NULL, NULL, 20, 10, 'percent', 10, 600, 1, '2024-12-19 03:00:05', '2024-12-20 12:56:09', '2024-11-28 06:56:13', '2024-12-18 07:08:28'),
(6, 'nmjh23', 'sabina coupon', NULL, 5, 2, 'percent', 30, 1000, 1, '2025-01-27 04:00:00', '2025-01-31 13:08:03', '2024-11-28 07:08:07', '2025-01-26 21:40:48');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '0001_01_01_000000_create_users_table', 1),
(6, '0001_01_01_000001_create_cache_table', 1),
(7, '0001_01_01_000002_create_jobs_table', 1),
(8, '2024_07_12_025128_create_categories_table', 2),
(9, '2024_07_13_032358_create_sub_categories_table', 3),
(10, '2024_07_13_033631_create_brands_table', 3),
(11, '2024_07_13_034457_create_products_table', 3),
(13, '2024_07_17_044420_create_subcategories_table', 4),
(14, '2024_07_18_033856_create_products_table', 5),
(15, '2024_07_18_034426_create_product_images_table', 6),
(16, '2024_07_18_100857_create_sub_categories_table', 6),
(17, '2024_07_18_103957_create_subcategories_table', 7),
(18, '2024_07_21_030236_create_pages_table', 8),
(19, '2024_07_28_062348_alter_categories_table', 9),
(20, '2024_07_28_063729_alter_subcategories_table', 10),
(21, '2024_07_28_070825_alter_subcategories_table', 11),
(22, '2024_07_31_090446_create_temp_images_table', 11),
(23, '2024_10_20_122938_alter_products_table', 12),
(24, '2024_10_27_042435_create_countries_table', 13),
(25, '2024_10_27_084627_create_orders_table', 14),
(26, '2024_10_27_084653_create_order_items_table', 15),
(27, '2024_10_27_084718_create_customer_addresses_table', 15),
(28, '2024_10_28_145710_create_shipping_charges_table', 16),
(29, '2024_10_30_130700_create_discount_coupons_table', 17),
(30, '2024_11_13_042036_alter_orders_table', 18),
(31, '2024_11_15_024837_alter_orders_table', 19),
(32, '2024_11_15_135108_create_wishlists_table', 20),
(33, '2024_11_19_032541_alter_users_table', 21),
(34, '2024_11_22_143135_create_product_ratings_table', 22),
(35, '2024_12_21_031142_alter_product_images_table', 23),
(36, '2025_02_08_133737_create_payment_gatway_table', 24),
(37, '2025_07_13_141731_create_admins_table', 25);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subtotal` double NOT NULL,
  `shipping` double NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_code_id` int(11) DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `grand_total` double NOT NULL,
  `payment_status` enum('paid','not paid') NOT NULL DEFAULT 'not paid',
  `status` enum('pending','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `shipped_date` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `subtotal`, `shipping`, `coupon_code`, `coupon_code_id`, `discount`, `grand_total`, `payment_status`, `status`, `shipped_date`, `first_name`, `last_name`, `email`, `mobile`, `country_id`, `address`, `apartment`, `city`, `state`, `zip`, `notes`, `created_at`, `updated_at`) VALUES
(2, 25, 3690, 0, NULL, 0, NULL, 3690, 'not paid', 'pending', NULL, 'rony', 'Akter', 'shima2@gmail.com', '01965335790', 20, '83, muradpur kudrat ali bazzar', 'vbg', 'Dhaka', 'jurain', '1216', 'bnhg', '2024-10-28 02:57:22', '2024-10-28 02:57:22'),
(3, 25, 3690, 0, NULL, 0, NULL, 3690, 'not paid', 'pending', NULL, 'rony', 'Akter', 'shima2@gmail.com', '01965335790', 20, '83, muradpur kudrat ali bazzar', 'vbg', 'Dhaka', 'jurain', '1216', 'bnhg', '2024-10-28 03:09:15', '2024-10-28 03:09:15'),
(4, 25, 3690, 0, NULL, 0, NULL, 3690, 'not paid', 'pending', NULL, 'rony', 'Akter', 'shima2@gmail.com', '01965335790', 2, '83, muradpur kudrat ali bazzar', 'vbg', 'Dhaka', 'jurain', '1216', 'bnhg', '2024-10-30 00:24:10', '2024-10-30 00:24:10'),
(5, 25, 0, 0, NULL, 0, NULL, 0, 'not paid', 'pending', NULL, 'rony', 'Akter', 'shima2@gmail.com', '01965335790', 2, '83, muradpur kudrat ali bazzar', 'vbg', 'Dhaka', 'jurain', '1216', 'bnhg', '2024-10-30 00:24:12', '2024-10-30 00:24:12'),
(6, 25, 1000, 40, NULL, 0, NULL, 1040, 'not paid', 'pending', NULL, 'rony', 'Akter', 'shima2@gmail.com', '01965335790', 7, '83, muradpur kudrat ali bazzar', 'vbg', 'Dhaka', 'jurain', '1216', 'bnhg', '2024-10-30 05:05:57', '2024-10-30 05:05:57'),
(7, 28, 2690, 50, NULL, 0, NULL, 2740, 'not paid', 'delivered', NULL, 'sumona', 'Akter', 'sumona@gmail.com', '01965335790', 20, '83, muradpur kudrat ali bazzar', 'vbg', 'Dhaka', 'jurain', '1216', 'bnvghjklmuytrew', '2024-11-11 08:36:00', '2024-11-11 08:36:00'),
(8, 26, 3690, 80, NULL, 0, NULL, 3770, 'not paid', 'pending', NULL, 'Shima', 'Akter', 'shima2@gmail.com', '01965335790', 7, '83, muradpur kudrat ali bazzar', 'vbg', 'Dhaka', 'jurain', '1216', 'nb hjghfghdsf', '2024-11-13 06:26:32', '2024-11-13 06:26:32'),
(9, 26, 5990, 50, NULL, 0, NULL, 6040, 'not paid', 'pending', NULL, 'sabina', 'Akter', 'sabina2@gmail.com', '01965335790', 13, '83, muradpur kudrat ali bazzar', 'vbg', 'Dhaka', 'jurain', '1216', 'nb hjghfghdsf', '2024-11-13 06:41:52', '2024-11-13 06:41:52'),
(10, 27, 3000, 250, NULL, 0, NULL, 3250, 'not paid', 'shipped', '2024-12-06 02:43:38', 'Shima', 'Akter', 'shima10@gmail.com', '01965335790', 15, '83, muradpur kudrat ali bazzar', 'vbg', 'Dhaka', 'jurain', '1216', 'jnhgkjhklklk', '2024-12-02 07:21:34', '2024-12-02 20:43:51'),
(11, 27, 20000, 200, NULL, 0, NULL, 20200, 'not paid', 'pending', NULL, 'rony', 'Akter', 'shima16@gmail.com', '01965335790', 4, '83, muradpur kudrat ali bazzar', 'vbg', 'Dhaka', 'jurain', '1216', NULL, '2024-12-02 07:38:11', '2024-12-02 07:38:11'),
(12, 27, 3500, 250, 'bgfr45', 4, 350, 3750, 'not paid', 'pending', NULL, 'rony', 'Akter', 'shima16@gmail.com', '01965335790', 7, '83, muradpur kudrat ali bazzar', 'vbg', 'Dhaka', 'jurain', '1216', NULL, '2024-12-08 00:32:14', '2024-12-08 00:32:14'),
(13, 27, 0, 0, 'bgfr45', 4, 0, 0, 'not paid', 'pending', NULL, 'rony', 'Akter', 'shima16@gmail.com', '01965335790', 7, '83, muradpur kudrat ali bazzar', 'vbg', 'Dhaka', 'jurain', '1216', NULL, '2024-12-08 00:32:15', '2024-12-08 00:32:15'),
(14, 34, 6696, 150, 'bgfr45', 4, 669.6, 6176.4, 'not paid', 'pending', NULL, 'sumitra', 'Akter', 'sumitra@gmail.com', '01965335790', 20, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2024-12-08 06:35:34', '2024-12-08 06:35:34'),
(15, 35, 21042, 150, 'bgfr45', 4, 2104.2, 19087.8, 'not paid', 'pending', NULL, 'suchitra', 'Akter', 'suchitra@gmail.com', '01965335790', 14, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2024-12-08 06:51:39', '2024-12-08 06:51:39'),
(16, 36, 2232, 50, 'bgfr45', 4, 223.2, 2058.8, 'not paid', 'delivered', '2024-12-13 01:55:29', 'jony', 'Akter', 'jony@gmail.com', '01965335790', 20, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2024-12-08 08:00:05', '2024-12-09 19:55:35'),
(17, 36, 0, 0, 'bgfr45', 4, 0, 0, 'not paid', 'pending', NULL, 'jony', 'Akter', 'jony@gmail.com', '01965335790', 20, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2024-12-08 08:00:06', '2024-12-08 08:00:06'),
(18, 37, 11490, 450, 'bgfr45', 4, 1149, 10791, 'not paid', 'cancelled', '2024-12-13 12:16:51', 'nayim', 'Akter', 'nayim@gmail.com', '01965335790', 3, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2024-12-08 08:27:35', '2024-12-09 06:17:00'),
(19, 37, 0, 0, 'bgfr45', 4, 0, 0, 'not paid', 'delivered', '2024-12-12 12:16:24', 'nayim', 'Akter', 'nayim@gmail.com', '01965335790', 3, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2024-12-08 08:27:36', '2024-12-09 06:16:32'),
(20, 37, 9540, 100, 'bgfr45', 4, 954, 8686, 'not paid', 'shipped', '2024-12-15 12:13:01', 'nayim', 'Akter', 'nayim@gmail.com', '01965335790', 4, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2024-12-08 08:33:29', '2024-12-09 06:13:10'),
(21, 37, 711, 300, 'bgfr45', 4, 71.1, 939.9, 'not paid', 'pending', NULL, 'nayim', 'Akter', 'nayim@gmail.com', '01965335790', 4, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2024-12-10 18:18:18', '2024-12-10 18:18:18'),
(22, 37, 3830, 100, 'bgfr45', 4, 383, 3547, 'not paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 4, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2024-12-10 18:31:14', '2024-12-10 18:31:14'),
(23, 37, 7461, 100, 'bgfr45', 4, 746.1, 6814.9, 'not paid', 'delivered', '2024-12-13 03:30:20', 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 4, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2024-12-10 18:36:01', '2024-12-10 21:40:31'),
(24, 37, 2232, 100, 'bgfr45', 4, 223.2, 2108.8, 'not paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 4, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2024-12-10 18:37:29', '2024-12-10 18:37:29'),
(25, 37, 3830, 100, 'bgfr45', 4, 383, 3547, 'not paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 4, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2024-12-10 18:41:24', '2024-12-10 18:41:24'),
(26, 37, 1500, 300, 'bgfr45', 4, 150, 1650, 'not paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 4, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2024-12-18 07:10:17', '2024-12-18 07:10:17'),
(27, 37, 2517, 150, '', NULL, 0, 2667, 'not paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 5, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-01-26 21:33:34', '2025-01-26 21:33:34'),
(28, 37, 1155, 250, 'nmjh23', 6, 346.5, 1058.5, 'not paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 5, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-01-26 21:43:40', '2025-01-26 21:43:40'),
(29, 37, 1518, 140, '', NULL, 0, 1658, 'not paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-05 19:38:52', '2025-02-05 19:38:52'),
(30, 37, 462, 70, '', NULL, 0, 532, 'not paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-19 22:28:16', '2025-02-19 22:28:16'),
(31, 37, 825, 70, '', NULL, 0, 895, 'not paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-19 22:37:58', '2025-02-19 22:37:58'),
(32, 37, 825, 70, '', NULL, 0, 895, 'not paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-19 23:18:15', '2025-02-19 23:18:15'),
(33, 37, 1381, 70, '', NULL, 0, 1451, 'not paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-19 23:46:46', '2025-02-19 23:46:46'),
(34, 37, 462, 70, '', NULL, 0, 532, 'not paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-21 07:25:33', '2025-02-21 07:25:33'),
(35, 37, 462, 70, '', NULL, 0, 532, 'not paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-21 07:25:35', '2025-02-21 07:25:35'),
(36, 37, 462, 70, '', NULL, 0, 532, 'not paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-21 07:28:54', '2025-02-21 07:28:54'),
(37, 37, 462, 70, '', NULL, 0, 532, 'paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-21 07:29:42', '2025-02-21 07:29:45'),
(38, 37, 1112, 70, '', NULL, 0, 1182, 'not paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-21 08:14:16', '2025-02-21 08:14:16'),
(39, 37, 1112, 70, '', NULL, 0, 1182, 'paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-21 08:14:27', '2025-02-21 08:14:29'),
(40, 37, 998, 70, '', NULL, 0, 1068, 'not paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-21 10:00:07', '2025-02-21 10:00:07'),
(41, 37, 998, 70, '', NULL, 0, 1068, 'paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-21 10:00:26', '2025-02-21 10:00:30'),
(42, 37, 1996, 70, '', NULL, 0, 2066, 'not paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-21 10:04:42', '2025-02-21 10:04:42'),
(43, 37, 1996, 70, '', NULL, 0, 2066, 'paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-21 10:04:56', '2025-02-21 10:04:59'),
(44, 37, 1524, 70, '', NULL, 0, 1594, 'paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-21 10:33:56', '2025-02-21 10:34:01'),
(45, 37, 1155, 70, '', NULL, 0, 1225, 'paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-21 10:37:31', '2025-02-21 10:37:35'),
(46, 37, 1112, 70, '', NULL, 0, 1182, 'paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-21 10:40:21', '2025-02-21 10:40:25'),
(47, 37, 1524, 70, '', NULL, 0, 1594, 'paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-21 10:45:40', '2025-02-21 10:45:42'),
(48, 37, 340, 140, '', NULL, 0, 480, 'paid', 'pending', NULL, 'nayim', 'Akter', 'nayimsingh@gmail.com', '01965335790', 9, '83, muradpur kudrat ali bazzar', NULL, 'Dhaka', 'jurain', '1216', NULL, '2025-02-22 09:55:41', '2025-02-22 09:56:22'),
(49, 54, 439, 200, '', NULL, 0, 639, 'not paid', 'pending', NULL, 'Shima', 'Akter', 'shimacse22@gmail.com', '01568923154', 4, '83,muradpur kudrat ali bazzar', NULL, 'dhaka', 'jurain', '1216', NULL, '2025-07-08 09:03:08', '2025-07-08 09:03:08'),
(50, 54, 416, 200, '', NULL, 0, 616, 'not paid', 'pending', NULL, 'Shima', 'Akter', 'shimacse22@gmail.com', '01568923154', 4, '83,muradpur kudrat ali bazzar', NULL, 'dhaka', 'jurain', '1216', NULL, '2025-07-15 08:25:51', '2025-07-15 08:25:51'),
(51, 54, 0, 0, '', NULL, 0, 0, 'not paid', 'pending', NULL, 'Shima', 'Akter', 'shimacse22@gmail.com', '01568923154', 4, '83,muradpur kudrat ali bazzar', NULL, 'dhaka', 'jurain', '1216', NULL, '2025-07-15 08:26:21', '2025-07-15 08:26:21'),
(52, 54, 924, 400, '', NULL, 0, 1324, 'not paid', 'pending', NULL, 'Shima', 'Akter', 'shimacse22@gmail.com', '01568923154', 4, '83,muradpur kudrat ali bazzar', NULL, 'dhaka', 'jurain', '1216', NULL, '2025-07-15 08:27:05', '2025-07-15 08:27:05'),
(53, 55, 1818, 100, NULL, NULL, 0, 1918, 'not paid', 'pending', NULL, 'Shima', 'Akter', 'shimacse22@gmail.com', '01965335790', 5, 'fhgjmhmkj,m', NULL, 'dhaka', 'jurain', '1216', NULL, '2025-08-07 22:31:12', '2025-08-07 22:31:12'),
(54, 55, 1702, 100, NULL, NULL, 0, 1802, 'not paid', 'pending', NULL, 'Shima', 'Akter', 'shimacse22@gmail.com', '01965335790', 5, 'fhgjmhmkj,m', NULL, 'dhaka', 'jurain', '1216', NULL, '2025-08-07 22:34:33', '2025-08-07 22:34:33'),
(55, 55, 1524, 100, '', NULL, 0, 1624, 'paid', 'pending', NULL, 'Shima', 'Akter', 'shimacse22@gmail.com', '01965335790', 5, 'fhgjmhmkj,m', NULL, 'dhaka', 'jurain', '1216', NULL, '2025-08-08 07:41:09', '2025-08-08 07:41:13');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `content`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Privacy Policy', 'Privacy-Policy2', '<p><span style=\"text-wrap-mode: nowrap; background-color: rgba(0, 0, 0, 0.075);\">Terms -and-conditions</span><span style=\"text-wrap-mode: nowrap;\">Terms -and-conditionsTerms -and-conditions</span></p>', 1, '2024-07-21 23:40:52', '2024-11-19 10:44:41'),
(11, 'Refund Policy', 'Refund-Policy', NULL, 1, '2024-11-19 07:42:21', '2024-11-19 07:42:21'),
(12, 'Terms & Conditions', 'Terms -and-conditions2', '<p>Terms -and-conditionsTerms -and-conditionsTerms -and-conditionsTerms -and-conditionsTerms -and-conditions</p>', 1, '2024-11-19 07:42:42', '2024-11-19 10:42:40'),
(13, 'About Us', 'about-us4', '<p>lorem&nbsp;<span style=\"font-size: 1rem;\">!lorem</span><span style=\"font-size: 1rem;\">!lorem</span><span style=\"font-size: 1rem;\">!lorem</span><span style=\"font-size: 1rem;\">!lorem</span><span style=\"font-size: 1rem;\">!lorem</span><span style=\"font-size: 1rem;\">!lorem</span><span style=\"font-size: 1rem;\">!lorem</span><span style=\"font-size: 1rem;\">!lorem</span><span style=\"font-size: 1rem;\">!lorem</span></p>', 1, '2024-11-19 07:43:03', '2024-11-28 21:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('johndo@gmail.com', 'z0sjVnwpxp22wG4FWMEH0rx83JDRjMd8GuCshJbuHSoXD8fKQwABCO6Z7vcf', '2024-12-12 09:06:46'),
('johndoe@gmail.com', 'p0ZNbxBinMgUpMQmUoFdqZcIfbAPiQuwlDBe1iKa3lteQUvzdjHDaMIlU46a', '2024-11-20 21:29:30');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `shipping_returns` text DEFAULT NULL,
  `related_products` text DEFAULT NULL,
  `price` double NOT NULL,
  `compare_price` double DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_featured` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `sku` varchar(255) NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `track_qty` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `qty` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `description`, `short_description`, `shipping_returns`, `related_products`, `price`, `compare_price`, `category_id`, `subcategory_id`, `brand_id`, `is_featured`, `sku`, `barcode`, `track_qty`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Black Sofa Set', 'black-sofa-set-fam8H', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '2,4,5', 245, NULL, 1, 3, 1, 'Yes', 'MWBABZZV', 'BC698319', 'Yes', 20, 1, '2025-08-13 20:05:21', '2025-08-13 20:19:51'),
(2, 'Minimal Sofa', 'minimal-sofa-oRViL', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '1,4,5', 503, NULL, 1, 1, 1, 'Yes', '55GEP5P8', 'BC221080', 'Yes', 16, 1, '2025-08-13 20:05:21', '2025-08-13 20:33:51'),
(3, 'Pattern Tea Table', 'pattern-tea-table-N4ZNy', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '1,2,4', 753, NULL, 1, 4, 1, 'Yes', 'SOWLMNC9', 'BC592130', 'Yes', 20, 1, '2025-08-13 20:05:21', '2025-08-13 20:38:41'),
(4, 'Modern TV Stand', 'modern-tv-stand-jAcuv', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '1,2,5', 412, NULL, 1, 1, 3, 'Yes', 'EKPJJ4OJ', 'BC331331', 'Yes', 48, 1, '2025-08-13 20:05:21', '2025-08-13 20:44:11'),
(5, 'Plush Area Rug', 'plush-area-rug-KjBKN', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '1,2,4', 449, NULL, 1, 3, 3, 'Yes', 'JBTRLJFB', 'BC775678', 'Yes', 11, 1, '2025-08-13 20:05:22', '2025-08-13 20:45:41'),
(6, 'Queen Size Wooden Bed', 'queen-size-wooden-bed-Qd5rS', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '7,8,9', 959, NULL, 2, 8, 5, 'Yes', 'CMHCSSI8', 'BC909145', 'Yes', 45, 1, '2025-08-13 20:05:23', '2025-08-13 20:51:00'),
(7, 'Sliding Door Wardrobe', 'sliding-door-wardrobe-bObwV', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '8,9,10', 509, NULL, 2, 10, 5, 'No', 'AHHNJLCU', 'BC482411', 'Yes', 28, 1, '2025-08-13 20:05:23', '2025-08-13 23:51:04'),
(8, '6-Drawer Dresser', '6-drawer-dresser-m8bWr', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '6,7,9', 784, NULL, 2, 10, 4, 'Yes', 'SWAT0DKZ', 'BC263751', 'Yes', 7, 1, '2025-08-13 20:05:23', '2025-08-13 20:55:33'),
(9, 'Classic Nightstand', 'classic-nightstand-zOFfy', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '6,7,10', 194, NULL, 2, 6, 4, 'Yes', 'LK3PF9MP', 'BC579656', 'Yes', 4, 1, '2025-08-13 20:05:23', '2025-08-13 20:57:43'),
(10, 'Premium Cotton Bedding', 'premium-cotton-bedding-1f0Ha', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '6,7,8', 753, NULL, 2, 7, 4, 'Yes', 'PGYLN2Z6', 'BC919017', 'Yes', 37, 1, '2025-08-13 20:05:24', '2025-08-13 20:59:52'),
(11, 'Circle Dining Table', 'circle-dining-table-YpgEy', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '12,13,15', 271, NULL, 3, 12, 8, 'Yes', 'G6CXB3VK', 'BC454213', 'Yes', 35, 1, '2025-08-13 20:05:25', '2025-08-13 23:30:06'),
(12, 'Bar Stool Set of 2', 'bar-stool-set-of-2-jwKm3', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '13,14,15', 547, NULL, 3, 15, 7, 'No', 'FI6LA0ZB', 'BC188973', 'Yes', 28, 1, '2025-08-13 20:05:25', '2025-08-13 23:33:09'),
(13, 'Modular Kitchen Cabinet', 'modular-kitchen-cabinet-Ki8rM', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '11,14,15', 233, NULL, 3, 12, 9, 'No', 'J9LNLSIQ', 'BC132222', 'Yes', 18, 1, '2025-08-13 20:05:25', '2025-08-13 23:35:09'),
(14, 'Stainless Steel Cookware Set', 'stainless-steel-cookware-set-TEVAf', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '11,13,15', 464, NULL, 3, 13, 8, 'No', 'LMQ5YVSD', 'BC375197', 'Yes', 5, 1, '2025-08-13 20:05:25', '2025-08-13 23:37:06'),
(15, 'Multi-Layer Kitchen Rack', 'multi-layer-kitchen-rack-681fa', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '12,13,14', 965, NULL, 3, 13, 7, 'No', 'DFVCLD0K', 'BC397080', 'Yes', 38, 1, '2025-08-13 20:05:25', '2025-08-13 23:39:18'),
(16, 'Convertible Sofa Bed', 'convertible-sofa-bed-PhSrh', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '17,18,20', 403, NULL, 4, 19, 10, 'No', 'RINBJC5H', 'BC897117', 'Yes', 17, 1, '2025-08-13 20:05:26', '2025-08-13 23:41:21'),
(17, 'Velvet Accent Chair', 'velvet-accent-chair-z3fpf', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '16,18,19', 582, NULL, 4, 20, 10, 'No', '9PBMGTMZ', 'BC577699', 'Yes', 24, 1, '2025-08-13 20:05:27', '2025-08-13 23:43:48'),
(18, 'Glass Top Side Table', 'glass-top-side-table-ThOnW', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '16,17,19', 505, NULL, 4, 18, 11, 'No', 'JZTCTDZD', 'BC249116', 'Yes', 30, 1, '2025-08-13 20:05:27', '2025-08-13 23:42:52'),
(19, 'Abstract Wall Art', 'abstract-wall-art-B04lH', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '16,17,18', 533, NULL, 4, 20, 10, 'Yes', 'TFO1X6UR', 'BC483506', 'Yes', 25, 1, '2025-08-13 20:05:27', '2025-08-13 23:47:14'),
(20, 'Standing Floor Lamp', 'standing-floor-lamp-Pyxf1', '- Crafted from premium materials for long-lasting durability.  \r\n                        - Timeless design suitable for modern and traditional interiors.  \r\n                        - Lightweight yet sturdy for easy movement.  \r\n                        - Smooth finish adds elegance to your space.  \r\n                        - Resistant to everyday wear and tear.  \r\n                        - Easy-to-clean surface, just wipe with a soft cloth.  \r\n                        - Perfect for homes, offices, and guest rooms.  \r\n                        - Combines aesthetic appeal with functional design.', '- Stylish & durable.  \r\n                        - Fits any decor.  \r\n                        - Easy to maintain.', '- Free nationwide delivery.  \r\n                        - Estimated delivery in 3–5 business days.  \r\n                        - 10-day hassle-free returns.  \r\n                        - Full refund if returned unused in original packaging.  \r\n                        - Secure packaging to prevent damage in transit.  \r\n                        - Customer support for order tracking & assistance.  \r\n                        - Returns processed within 48 hours of inspection.  \r\n                        - Replacement for damaged or defective products available.', '16,17,18', 837, NULL, 4, 20, 12, 'No', 'XHVKKU1J', 'BC540994', 'Yes', 10, 1, '2025-08-13 20:05:27', '2025-08-13 23:50:01');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `sort_order`, `created_at`, `updated_at`, `is_primary`) VALUES
(84, 1, '1-84-1755137931.jpg', NULL, '2025-08-13 20:18:50', '2025-08-13 20:18:51', 0),
(85, 1, '1-85-1755137944.jpg', NULL, '2025-08-13 20:19:04', '2025-08-13 20:19:04', 0),
(86, 1, '1-86-1755137950.jpg', NULL, '2025-08-13 20:19:10', '2025-08-13 20:19:10', 0),
(87, 2, '2-87-1755138740.jpg', NULL, '2025-08-13 20:32:20', '2025-08-13 20:32:20', 0),
(88, 2, '2-88-1755138777.jpg', NULL, '2025-08-13 20:32:57', '2025-08-13 20:32:57', 0),
(89, 2, '2-89-1755138787.jpg', NULL, '2025-08-13 20:33:07', '2025-08-13 20:33:07', 0),
(90, 3, '3-90-1755138966.jpg', NULL, '2025-08-13 20:36:06', '2025-08-13 20:36:06', 0),
(91, 3, '3-91-1755138977.jpg', NULL, '2025-08-13 20:36:16', '2025-08-13 20:36:17', 0),
(92, 3, '3-92-1755139111.jpg', NULL, '2025-08-13 20:38:31', '2025-08-13 20:38:31', 0),
(93, 4, '4-93-1755139438.png', NULL, '2025-08-13 20:43:58', '2025-08-13 20:43:58', 0),
(94, 4, '4-94-1755139444.jpg', NULL, '2025-08-13 20:44:03', '2025-08-13 20:44:04', 0),
(95, 4, '4-95-1755139445.jpg', NULL, '2025-08-13 20:44:05', '2025-08-13 20:44:05', 0),
(96, 5, '5-96-1755139533.jpg', NULL, '2025-08-13 20:45:33', '2025-08-13 20:45:33', 0),
(97, 5, '5-97-1755139534.jpg', NULL, '2025-08-13 20:45:34', '2025-08-13 20:45:34', 0),
(98, 5, '5-98-1755139535.jpg', NULL, '2025-08-13 20:45:35', '2025-08-13 20:45:35', 0),
(99, 6, '6-99-1755139826.jpg', NULL, '2025-08-13 20:50:26', '2025-08-13 20:50:26', 0),
(100, 6, '6-100-1755139828.jpg', NULL, '2025-08-13 20:50:28', '2025-08-13 20:50:28', 0),
(101, 6, '6-101-1755139856.jpg', NULL, '2025-08-13 20:50:56', '2025-08-13 20:50:56', 0),
(102, 7, '7-102-1755139990.jpg', NULL, '2025-08-13 20:53:10', '2025-08-13 20:53:10', 0),
(103, 7, '7-103-1755139991.jpg', NULL, '2025-08-13 20:53:11', '2025-08-13 20:53:11', 0),
(104, 7, '7-104-1755139993.jpg', NULL, '2025-08-13 20:53:12', '2025-08-13 20:53:13', 0),
(105, 8, '8-105-1755140123.jpg', NULL, '2025-08-13 20:55:23', '2025-08-13 20:55:23', 0),
(106, 8, '8-106-1755140125.jpg', NULL, '2025-08-13 20:55:25', '2025-08-13 20:55:25', 0),
(107, 8, '8-107-1755140127.jpg', NULL, '2025-08-13 20:55:27', '2025-08-13 20:55:27', 0),
(108, 8, '8-108-1755140128.jpg', NULL, '2025-08-13 20:55:28', '2025-08-13 20:55:28', 0),
(109, 9, '9-109-1755140254.jpg', NULL, '2025-08-13 20:57:34', '2025-08-13 20:57:34', 0),
(110, 9, '9-110-1755140255.jpg', NULL, '2025-08-13 20:57:35', '2025-08-13 20:57:35', 0),
(111, 9, '9-111-1755140258.jpg', NULL, '2025-08-13 20:57:38', '2025-08-13 20:57:38', 0),
(112, 9, '9-112-1755140259.jpg', NULL, '2025-08-13 20:57:39', '2025-08-13 20:57:39', 0),
(113, 10, '10-113-1755140385.jpg', NULL, '2025-08-13 20:59:44', '2025-08-13 20:59:45', 0),
(114, 10, '10-114-1755140386.jpg', NULL, '2025-08-13 20:59:45', '2025-08-13 20:59:46', 0),
(115, 10, '10-115-1755140387.jpg', NULL, '2025-08-13 20:59:46', '2025-08-13 20:59:47', 0),
(116, 11, '11-116-1755149383.jpg', NULL, '2025-08-13 23:29:42', '2025-08-13 23:29:43', 0),
(117, 11, '11-117-1755149390.jpg', NULL, '2025-08-13 23:29:50', '2025-08-13 23:29:50', 0),
(118, 11, '11-118-1755149394.jpg', NULL, '2025-08-13 23:29:53', '2025-08-13 23:29:54', 0),
(119, 11, '11-119-1755149397.jpg', NULL, '2025-08-13 23:29:56', '2025-08-13 23:29:57', 0),
(120, 12, '12-120-1755149579.jpg', NULL, '2025-08-13 23:32:58', '2025-08-13 23:32:59', 0),
(121, 12, '12-121-1755149583.jpg', NULL, '2025-08-13 23:33:03', '2025-08-13 23:33:03', 0),
(122, 12, '12-122-1755149585.jpg', NULL, '2025-08-13 23:33:05', '2025-08-13 23:33:05', 0),
(123, 13, '13-123-1755149701.jpg', NULL, '2025-08-13 23:35:01', '2025-08-13 23:35:01', 0),
(124, 13, '13-124-1755149703.jpg', NULL, '2025-08-13 23:35:03', '2025-08-13 23:35:03', 0),
(125, 13, '13-125-1755149706.jpg', NULL, '2025-08-13 23:35:06', '2025-08-13 23:35:06', 0),
(126, 14, '14-126-1755149816.jpg', NULL, '2025-08-13 23:36:56', '2025-08-13 23:36:56', 0),
(127, 14, '14-127-1755149824.jpg', NULL, '2025-08-13 23:37:03', '2025-08-13 23:37:04', 0),
(128, 14, '14-128-1755149828.jpg', NULL, '2025-08-13 23:37:08', '2025-08-13 23:37:08', 0),
(129, 15, '15-129-1755149949.jpg', NULL, '2025-08-13 23:39:09', '2025-08-13 23:39:09', 0),
(130, 15, '15-130-1755149951.jpg', NULL, '2025-08-13 23:39:11', '2025-08-13 23:39:11', 0),
(131, 15, '15-131-1755149952.jpg', NULL, '2025-08-13 23:39:12', '2025-08-13 23:39:12', 0),
(132, 16, '16-132-1755150074.jpg', NULL, '2025-08-13 23:41:14', '2025-08-13 23:41:14', 0),
(133, 16, '16-133-1755150077.jpg', NULL, '2025-08-13 23:41:16', '2025-08-13 23:41:17', 0),
(134, 16, '16-134-1755150078.jpg', NULL, '2025-08-13 23:41:18', '2025-08-13 23:41:18', 0),
(138, 17, '17-138-1755150213.jpg', NULL, '2025-08-13 23:43:33', '2025-08-13 23:43:33', 0),
(139, 17, '17-139-1755150214.jpg', NULL, '2025-08-13 23:43:34', '2025-08-13 23:43:34', 0),
(140, 17, '17-140-1755150216.jpg', NULL, '2025-08-13 23:43:36', '2025-08-13 23:43:36', 0),
(141, 17, '17-141-1755150218.jpg', NULL, '2025-08-13 23:43:38', '2025-08-13 23:43:38', 0),
(142, 18, '18-142-1755150325.jpg', NULL, '2025-08-13 23:45:25', '2025-08-13 23:45:25', 0),
(143, 18, '18-143-1755150327.jpg', NULL, '2025-08-13 23:45:26', '2025-08-13 23:45:27', 0),
(144, 18, '18-144-1755150330.jpg', NULL, '2025-08-13 23:45:29', '2025-08-13 23:45:30', 0),
(145, 19, '19-145-1755150422.jpg', NULL, '2025-08-13 23:47:02', '2025-08-13 23:47:02', 0),
(146, 19, '19-146-1755150424.jpg', NULL, '2025-08-13 23:47:04', '2025-08-13 23:47:04', 0),
(147, 19, '19-147-1755150427.jpg', NULL, '2025-08-13 23:47:07', '2025-08-13 23:47:07', 0),
(148, 20, '20-148-1755150513.jpg', NULL, '2025-08-13 23:48:33', '2025-08-13 23:48:33', 0),
(149, 20, '20-149-1755150514.jpg', NULL, '2025-08-13 23:48:34', '2025-08-13 23:48:34', 0),
(150, 20, '20-150-1755150516.jpg', NULL, '2025-08-13 23:48:36', '2025-08-13 23:48:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_ratings`
--

CREATE TABLE `product_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `ratings` double DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('xWh43UIfOtdRjVgGzVfUb0I9j0Rq1GyJ0FXald13', 54, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUmI5OXZockVsZm9nSGVVOXZIQ2Vpc2hPWDVNS1l1d1ZWSGdZWWg3MCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wcm9kdWN0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTQ7czo0OiJjYXJ0IjthOjE6e3M6NzoiZGVmYXVsdCI7TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6MTp7czozMjoiYjIyYWVjZGY2N2NiMjQ0OWRmMzRkYjMzMzZhMzg3ODIiO086MzI6Ikdsb3VkZW1hbnNcU2hvcHBpbmdjYXJ0XENhcnRJdGVtIjo5OntzOjU6InJvd0lkIjtzOjMyOiJiMjJhZWNkZjY3Y2IyNDQ5ZGYzNGRiMzMzNmEzODc4MiI7czoyOiJpZCI7aTozO3M6MzoicXR5IjtpOjE7czo0OiJuYW1lIjtzOjE3OiJQYXR0ZXJuIFRlYSBUYWJsZSI7czo1OiJwcmljZSI7ZDo3NTM7czo3OiJvcHRpb25zIjtPOjM5OiJHbG91ZGVtYW5zXFNob3BwaW5nY2FydFxDYXJ0SXRlbU9wdGlvbnMiOjI6e3M6ODoiACoAaXRlbXMiO2E6MTp7czoxMjoicHJvZHVjdEltYWdlIjtPOjI0OiJBcHBcTW9kZWxzXFByb2R1Y3RJbWFnZXMiOjMwOntzOjEzOiIAKgBjb25uZWN0aW9uIjtzOjU6Im15c3FsIjtzOjg6IgAqAHRhYmxlIjtzOjE0OiJwcm9kdWN0X2ltYWdlcyI7czoxMzoiACoAcHJpbWFyeUtleSI7czoyOiJpZCI7czoxMDoiACoAa2V5VHlwZSI7czozOiJpbnQiO3M6MTI6ImluY3JlbWVudGluZyI7YjoxO3M6NzoiACoAd2l0aCI7YTowOnt9czoxMjoiACoAd2l0aENvdW50IjthOjA6e31zOjE5OiJwcmV2ZW50c0xhenlMb2FkaW5nIjtiOjA7czoxMDoiACoAcGVyUGFnZSI7aToxNTtzOjY6ImV4aXN0cyI7YjoxO3M6MTg6Indhc1JlY2VudGx5Q3JlYXRlZCI7YjowO3M6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDtzOjEzOiIAKgBhdHRyaWJ1dGVzIjthOjc6e3M6MjoiaWQiO2k6OTA7czoxMDoicHJvZHVjdF9pZCI7aTozO3M6NToiaW1hZ2UiO3M6MTk6IjMtOTAtMTc1NTEzODk2Ni5qcGciO3M6MTA6InNvcnRfb3JkZXIiO047czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNS0wOC0xNCAwMjozNjowNiI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNS0wOC0xNCAwMjozNjowNiI7czoxMDoiaXNfcHJpbWFyeSI7aTowO31zOjExOiIAKgBvcmlnaW5hbCI7YTo3OntzOjI6ImlkIjtpOjkwO3M6MTA6InByb2R1Y3RfaWQiO2k6MztzOjU6ImltYWdlIjtzOjE5OiIzLTkwLTE3NTUxMzg5NjYuanBnIjtzOjEwOiJzb3J0X29yZGVyIjtOO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjUtMDgtMTQgMDI6MzY6MDYiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDgtMTQgMDI6MzY6MDYiO3M6MTA6ImlzX3ByaW1hcnkiO2k6MDt9czoxMDoiACoAY2hhbmdlcyI7YTowOnt9czo4OiIAKgBjYXN0cyI7YTowOnt9czoxNzoiACoAY2xhc3NDYXN0Q2FjaGUiO2E6MDp7fXM6MjE6IgAqAGF0dHJpYnV0ZUNhc3RDYWNoZSI7YTowOnt9czoxMzoiACoAZGF0ZUZvcm1hdCI7TjtzOjEwOiIAKgBhcHBlbmRzIjthOjA6e31zOjE5OiIAKgBkaXNwYXRjaGVzRXZlbnRzIjthOjA6e31zOjE0OiIAKgBvYnNlcnZhYmxlcyI7YTowOnt9czoxMjoiACoAcmVsYXRpb25zIjthOjA6e31zOjEwOiIAKgB0b3VjaGVzIjthOjA6e31zOjEwOiJ0aW1lc3RhbXBzIjtiOjE7czoxMzoidXNlc1VuaXF1ZUlkcyI7YjowO3M6OToiACoAaGlkZGVuIjthOjA6e31zOjEwOiIAKgB2aXNpYmxlIjthOjA6e31zOjExOiIAKgBmaWxsYWJsZSI7YTowOnt9czoxMDoiACoAZ3VhcmRlZCI7YToxOntpOjA7czoxOiIqIjt9fX1zOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7fXM6NDk6IgBHbG91ZGVtYW5zXFNob3BwaW5nY2FydFxDYXJ0SXRlbQBhc3NvY2lhdGVkTW9kZWwiO047czo0MToiAEdsb3VkZW1hbnNcU2hvcHBpbmdjYXJ0XENhcnRJdGVtAHRheFJhdGUiO2k6MjE7czo0MToiAEdsb3VkZW1hbnNcU2hvcHBpbmdjYXJ0XENhcnRJdGVtAGlzU2F2ZWQiO2I6MDt9fXM6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDt9fX0=', 1755226169);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `country_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, '3', 150, '2024-10-28 20:52:08', '2024-11-28 06:49:58'),
(3, 'rest_of_world', 50, '2024-10-28 21:49:32', '2024-10-28 21:49:32'),
(6, '4', 100, '2024-11-28 06:46:24', '2024-11-28 06:46:24'),
(7, '5', 50, '2025-01-26 21:15:05', '2025-01-26 21:15:05'),
(8, '7', 60, '2025-01-26 21:15:42', '2025-01-26 21:15:42'),
(9, '9', 70, '2025-01-26 21:15:56', '2025-01-26 21:15:56'),
(10, '8', 80, '2025-01-26 21:16:14', '2025-01-26 21:16:14'),
(11, '241', 90, '2025-01-26 21:16:37', '2025-01-26 21:16:37'),
(12, '10', 100, '2025-07-15 08:00:02', '2025-07-15 08:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` bigint(255) UNSIGNED NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `showHome` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `slug`, `category_id`, `status`, `showHome`, `created_at`, `updated_at`) VALUES
(1, 'Sofas & Couches', 'sofas-couches', 1, '1', 'YES', '2025-08-13 20:05:20', '2025-08-13 20:05:20'),
(2, 'Coffee Tables', 'coffee-tables', 1, '1', 'YES', '2025-08-13 20:05:20', '2025-08-13 20:05:20'),
(3, 'TV Stands', 'tv-stands', 1, '1', 'YES', '2025-08-13 20:05:20', '2025-08-13 20:05:20'),
(4, 'Recliners & Chairs', 'recliners-chairs', 1, '1', 'YES', '2025-08-13 20:05:20', '2025-08-13 20:05:20'),
(5, 'Rugs & Carpets', 'rugs-carpets', 1, '1', 'YES', '2025-08-13 20:05:20', '2025-08-13 20:05:20'),
(6, 'Beds', 'beds', 2, '1', 'YES', '2025-08-13 20:05:22', '2025-08-13 20:05:22'),
(7, 'Wardrobes', 'wardrobes', 2, '1', 'YES', '2025-08-13 20:05:22', '2025-08-13 20:05:22'),
(8, 'Dressers', 'dressers', 2, '1', 'YES', '2025-08-13 20:05:22', '2025-08-13 20:05:22'),
(9, 'Nightstands', 'nightstands', 2, '1', 'YES', '2025-08-13 20:05:22', '2025-08-13 20:05:22'),
(10, 'Bedding Sets', 'bedding-sets', 2, '1', 'YES', '2025-08-13 20:05:22', '2025-08-13 20:05:22'),
(11, 'Dining Tables', 'dining-tables', 3, '1', 'YES', '2025-08-13 20:05:24', '2025-08-13 20:05:24'),
(12, 'Chairs & Stools', 'chairs-stools', 3, '1', 'YES', '2025-08-13 20:05:24', '2025-08-13 20:05:24'),
(13, 'Kitchen Cabinets', 'kitchen-cabinets', 3, '1', 'YES', '2025-08-13 20:05:24', '2025-08-13 20:05:24'),
(14, 'Cookware Sets', 'cookware-sets', 3, '1', 'YES', '2025-08-13 20:05:24', '2025-08-13 20:05:24'),
(15, 'Storage & Organizers', 'storage-organizers', 3, '1', 'YES', '2025-08-13 20:05:24', '2025-08-13 20:05:24'),
(16, 'Sofa Beds', 'sofa-beds', 4, '1', 'YES', '2025-08-13 20:05:26', '2025-08-13 20:05:26'),
(17, 'Accent Chairs', 'accent-chairs', 4, '1', 'YES', '2025-08-13 20:05:26', '2025-08-13 20:05:26'),
(18, 'Side Tables', 'side-tables', 4, '1', 'YES', '2025-08-13 20:05:26', '2025-08-13 20:05:26'),
(19, 'Wall Decor', 'wall-decor', 4, '1', 'YES', '2025-08-13 20:05:26', '2025-08-13 20:05:26'),
(20, 'Lamps & Lighting', 'lamps-lighting', 4, '1', 'YES', '2025-08-13 20:05:26', '2025-08-13 20:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `temp_images`
--

CREATE TABLE `temp_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp_images`
--

INSERT INTO `temp_images` (`id`, `name`, `created_at`, `updated_at`) VALUES
(157, '1755225737.jpg', '2025-08-14 20:42:17', '2025-08-14 20:42:17'),
(158, '1755225791.jpg', '2025-08-14 20:43:11', '2025-08-14 20:43:11'),
(159, '1755225824.jpg', '2025-08-14 20:43:44', '2025-08-14 20:43:44'),
(160, '1755225878.jpg', '2025-08-14 20:44:38', '2025-08-14 20:44:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `status` int(11) NOT NULL DEFAULT 1,
  `img` text DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `status`, `img`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '', 'admin', 1, '', NULL, 'admin12345', NULL, '2024-07-11 09:06:16', '2024-07-11 09:06:16'),
(2, 'shima', 'shima@gmail.com', '', 'user', 1, '', NULL, '$2y$12$0oUBOUQelkLeIFQVY4u5bevvXTxRfx.JNbiGwl33BKm/.tUWyKNyO', NULL, '2024-07-11 09:08:22', '2024-07-11 09:08:22'),
(6, 'shima', 'shimaakter208@yahoo.com', '', '', 1, '', NULL, '', NULL, '2024-07-23 08:43:27', '2024-07-23 08:43:27'),
(13, 'sabina', 'sabina2@gmail.com', '', '', 1, '', NULL, '$2y$12$LWxgef6AFEn6MTdmQnbLm.re42b43y9Im2OH4xd1uBlbuA85bVl5K', NULL, '2024-07-23 21:40:01', '2024-07-23 21:40:01'),
(14, 'sabina', 'sabina@gmail.com', '', 'admin', 1, '', NULL, '$2y$12$M96bZ4s2TKDSWk7QSB5VMu6VxflWN6ZX2NYWRam/ao8X1yXyDWyVS', NULL, '2024-07-23 21:43:34', '2024-07-23 21:43:34'),
(15, 'rony', 'rony@gmail.com', '', 'user', 1, '', NULL, '$2y$12$b60lP7PP/hYcJtEydvFd9Opt2irQlVPDBIgp7oAY3lrnsA7bFkh.W', NULL, '2024-07-23 21:50:22', '2024-07-23 21:50:22'),
(16, 'sabina', 'sabina3@gmail.com', '', 'user', 1, '', NULL, '$2y$12$YJPDyvbtu898FtOrO7H7veQXwQaz42S6SGEH2vZJlIcEqEzhr9Lva', NULL, '2024-07-23 21:51:32', '2024-07-23 21:51:32'),
(17, 'shima2', 'shima2@gmail.com', '', 'user', 1, '', NULL, '$2y$12$0fSrVf2qCNKgQxUV/MxzGeiHB3.or83ttXnUBnRhSkiw.IzbxbPV.', NULL, '2024-07-23 22:07:42', '2024-07-23 22:07:42'),
(19, 'shima', 'shima3@gmail.com', '', 'user', 1, '', NULL, '$2y$12$762LoAUQuy7uTmX5ifD8mu8.ATV4dVTxBMEMlAmb.0e67A2m5myAq', NULL, '2024-09-28 22:48:41', '2024-09-28 22:48:41'),
(20, 'shima', 'shima4@gmail.com', '0198765432', 'admin', 1, '', NULL, '$2y$12$Qz8P5gLkGy9PJJdL8KNf7uOT6vz0NAyH7ClS/AQGJw7I2s9yBCCf.', NULL, '2024-09-29 07:24:57', '2024-09-29 07:24:57'),
(21, 'Shima Akter', 'shima6@gmail.com', '01965335790', 'user', 1, NULL, NULL, '$2y$12$fAnfpm/5.zDoemKymz8h4.stVMaAYECGhd7yKz4X5xjQ80dwBjb6i', NULL, '2024-10-08 09:04:13', '2024-10-08 09:04:13'),
(22, 'sabina', 'sabina5@gmail.com', '01965335792', 'user', 1, NULL, NULL, '$2y$12$QiyWk7I/d5uuNaveHZrAJOU9HNWEWhDEYcg9fBNapaz34kPte9fV2', NULL, '2024-10-09 09:20:31', '2024-10-09 09:20:31'),
(23, 'rony', 'rony2@gmail.com', '01964335790', 'admin', 1, NULL, NULL, '$2y$12$zouqWTIKsO78mhttndPV.Ovxmnn64fxqQ9/66OY7.jTWqohpnolbu', NULL, '2024-10-09 21:59:31', '2024-12-17 09:50:40'),
(24, 'shima', 'shima7@gmail.com', '01965334790', 'user', 1, NULL, NULL, '$2y$12$4HSCs/8ilzYQu5ZFaZSl8utGXyxpLexUMAm.piH97M/IOvaO5S6LS', NULL, '2024-10-09 22:14:42', '2024-10-09 22:14:42'),
(25, 'john doe', 'john@gmail.com', '01965335790', 'user', 1, NULL, NULL, '$2y$12$mPyXQIYuC6NspVPH.rsp6uHItDLmjakkKdunAhRwItwFweGJQCTDa', NULL, '2024-10-25 21:53:24', '2024-10-25 21:53:24'),
(26, 'john doe', 'johndoe@gmail.com', '01965335790', 'user', 1, NULL, NULL, '$2y$12$e7U9ihZrQRGBRMhdqbbFbO.zgKmfnZSOTqJjh1gPrp58staqFwrAS', NULL, '2024-10-25 21:58:26', '2024-11-20 21:30:56'),
(27, 'john doe', 'johndo@gmail.com', '01965335790', 'user', 1, NULL, NULL, '$2y$12$PFGpdCzwS57xurAarXLCw.ManWoo2PxL47ouKuMAfCFUvP..feeia', NULL, '2024-10-25 22:09:21', '2024-12-12 09:09:19'),
(28, 'shima', 'sumona@gmail.com', '01965335790', 'user', 1, NULL, NULL, '$2y$12$FMjBJcD0uy7HZTFITtiRO.O5jhgj2OCIst7ln6sw4xNKhX6/TZM82', NULL, '2024-11-11 08:31:57', '2024-11-11 08:31:57'),
(29, 'rumana', 'rumana@gmail.com', '01965335790', 'user', 1, NULL, NULL, NULL, NULL, '2024-11-18 22:09:38', '2024-11-18 22:09:38'),
(34, 'sumitra', 'sumitra@gmail.com', '01965335790', 'user', 1, NULL, NULL, '$2y$12$SQs/lRtf8jgSowehR4hrQOSMtZ7.hKfUWNP8uLKEJRzeleOZ/Y15.', NULL, '2024-12-08 06:28:22', '2024-12-08 06:28:22'),
(35, 'suchitra', 'suchitra@gmail.com', '01965335790', 'user', 1, NULL, NULL, '$2y$12$7Y/yq2xnhEj0Y9VooHevYOyxe6XxflUAi75cAsR58Hr5Kmi2aVPCe', NULL, '2024-12-08 06:42:36', '2024-12-08 06:42:36'),
(36, 'jony', 'jony@gmail.com', '01965335790', 'user', 1, NULL, NULL, '$2y$12$pnvg/B0waSLx9xPIsfOtQORUtTh6kqGQGjk6vzPo4WFtYYH3Nrkca', NULL, '2024-12-08 07:51:28', '2024-12-08 07:51:28'),
(37, 'nayim', 'nayim@gmail.com', '01965335790', 'user', 1, NULL, NULL, '$2y$12$MEYMuiLSAaHJr/GhHY7gouEznIK0x1thRfEKNp/PIwlfL.kBdCoh6', NULL, '2024-12-08 08:25:10', '2024-12-08 08:25:10'),
(38, 'rubel', 'rubel@gmail.com', '01965335796', 'user', 1, NULL, NULL, '$2y$12$d9fYYHqysR49AlLYmXOaq.Vs3izYELmOsl5jfILs9ZkVq82jxqudy', NULL, '2024-12-16 23:24:15', '2024-12-16 23:24:15'),
(39, 'sabiha', 'sabiha@gmail.com', '01965335795', '', 1, NULL, NULL, '$2y$12$Q/a1ZWp5MW4hPmH/df1HKOxaqTbnlzcFV1RTQQgwTbyYUd0pfTLyy', NULL, '2024-12-16 23:30:59', '2024-12-16 23:30:59'),
(41, 'sumi', 'sumi@gmail.com', '01975335790', 'user', 1, NULL, NULL, '$2y$12$1Jv8mkAn4Yx8PRcuEC99YuBfwbwl9xeHZ3uIHVRRDUSu6e1DXXUc6', NULL, '2024-12-17 20:28:44', '2024-12-17 20:28:44'),
(42, 'mohsin', 'mohsin@gmail.com', '01965435790', 'user', 1, NULL, NULL, '$2y$12$ejf1ImF2qYgQM.PJdCZyOeDmZQmoIH9bpKVkI.dQe85JmAnLI2J9a', NULL, '2024-12-17 21:02:19', '2024-12-17 21:02:19'),
(43, 'sushi', 'sushi@gmail.com', '01965385790', 'admin', 1, NULL, NULL, '$2y$12$QaSklsJRZYIWi4jYiyHFSuFNjJ5CJsx5hLKV6YPSnFAmMvObwl4ki', NULL, '2024-12-17 21:09:37', '2024-12-17 21:09:37'),
(44, 'cdefgs', 'cde@gmail.com', '01964335790', 'user', 1, NULL, NULL, '$2y$12$0vbaKCJFAzGzmdDi/JftV.59IbSE.Bzx255l1AQov.AEa9xXiAnzq', NULL, '2024-12-17 21:20:50', '2024-12-17 21:20:50'),
(45, 'cfdght', 'cdser@gmail.com', '01985335790', 'admin', 1, NULL, NULL, '$2y$12$aU0HJAPcH1fFLd8PGIyuV.Nk9mNDq8fWtU/7T3F/3lg6SvMF7keoK', NULL, '2024-12-17 21:33:04', '2024-12-17 21:33:04'),
(46, 'sabiha2', 'sabiha2@gmail.com', '01995335790', 'admin', 1, NULL, NULL, '$2y$12$h/WzQeQaHoYly2RMbDrE8enagOjFZbZpEt7nBNM1GIpEOQYO.YTa.', NULL, '2024-12-17 21:37:49', '2024-12-17 21:37:49'),
(47, 'xyzabc', 'xyz@gmail.com', '01975335790', 'user', 1, NULL, NULL, '$2y$12$KOLGzH.25iTtWizXDVtBXOK6aHz6GqNys5txbcfMH3ytOBvp2ywqW', NULL, '2024-12-17 21:53:26', '2024-12-17 21:53:26'),
(48, 'sumoni', 'sumoni@gmail.com', '01925335790', 'admin', 1, NULL, NULL, '$2y$12$tzHVfTqfdxNRMY16hjrzTe.0VFMfs/eHOwD.sE4WeyfwxxtwLvW9C', NULL, '2024-12-17 22:02:02', '2024-12-17 22:02:02'),
(49, 'efghij', 'efghij@gmail.com', '01963335790', 'user', 1, NULL, NULL, '$2y$12$pTOJJqo/MsLOOCyRbZyrzOs0wTOiWRsY5PuH5X3bL/Dw7ZyQZOfpa', NULL, '2024-12-18 00:16:26', '2024-12-18 00:16:26'),
(50, 'kurban', 'kurban@gmail.com', '01987654321', 'user', 1, NULL, NULL, '$2y$12$DY8RS2ysehaaW4i/nqWVsecW43sBAjIZTaIpaSuXpIaotLfY.Wzsm', NULL, '2024-12-18 10:56:43', '2024-12-18 10:56:43'),
(52, 'rakib', 'rakib@gmail.com', '01965635790', 'user', 1, NULL, NULL, '$2y$12$njmzhdP5cWJaGxU/FShbz.lk7MPq2Hzu1fkz/Cr6CaRgpSVP2qhcK', NULL, '2024-12-20 07:17:51', '2024-12-20 07:17:51'),
(53, 'rabbi', 'rabbi@gmail.com', '01965335760', 'admin', 1, NULL, NULL, '$2y$12$ykPkcpvZTpC3SeGlprrroe2wTD/hpeV0RgHQNnueF2tDEM/KrPLou', NULL, '2024-12-20 07:20:13', '2024-12-20 07:20:13'),
(54, 'jony', 'jony123@gmail.com', '01586932514', 'admin', 1, NULL, NULL, '$2y$12$VENg4wWmWTeM99ikYM4w8OZbiaOQootzNxTiDek4sZoZtMB4/0mli', NULL, '2025-07-08 08:57:18', '2025-07-08 08:57:18'),
(55, 'abcd', 'abc123@gmail.com', '01586932514', 'user', 1, NULL, NULL, '$2y$12$.wwpwkzw1/b1wGZQ/iBVRe9ozkrEZvuPS0BLGgCqPzsfhZTue6MHG', NULL, '2025-07-08 10:46:05', '2025-07-08 10:46:05'),
(56, 'admin', 'admin@demo.com', '01586932514', 'admin', 1, NULL, NULL, '$2y$12$z6QzVZ41BRHunMxuiQPfeusPOzlwdIjpfqf2LLean6mjeEgVV75NG', NULL, '2025-07-17 19:50:42', '2025-07-17 19:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_addresses_user_id_foreign` (`user_id`),
  ADD KEY `customer_addresses_country_id_foreign` (`country_id`);

--
-- Indexes for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_country_id_foreign` (`country_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_subcategory_id_foreign` (`subcategory_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ratings_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`);

--
-- Indexes for table `temp_images`
--
ALTER TABLE `temp_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `product_ratings`
--
ALTER TABLE `product_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `temp_images`
--
ALTER TABLE `temp_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD CONSTRAINT `customer_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD CONSTRAINT `product_ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
