-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2016 at 01:41 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
  `id` int(10) unsigned NOT NULL,
  `branch_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `branch_address` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_name`, `branch_address`, `created_at`, `updated_at`) VALUES
(1, 'Main Branch', 'Shav Blvd', '2016-11-06 22:19:46', '2016-11-06 22:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) unsigned NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `address`, `email`, `contact`, `created_at`, `updated_at`) VALUES
(1, 'Denimar Fernandez', 'Valenzuela City 3S (Karuhatan Branch), Karuhatan, Philippines', 'fdenimar@hotmail.com', '09155899365', '2016-10-23 22:45:02', '2016-10-23 22:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_05_10_130540_create_permission_tables', 1),
(4, '2016_10_20_040329_create_services_table', 1),
(5, '2016_10_20_044822_create_servicetypes_table', 1),
(6, '2016_10_21_082539_create_branches_table', 1),
(7, '2016_10_21_140550_create_promos_table', 1),
(8, '2016_10_21_153704_create_customers_table', 1),
(9, '2016_10_27_024104_create_transactions_table', 2),
(10, '2016_10_27_025217_create_sales_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Manage Master Entries', '2016-12-04 02:43:06', '2016-12-04 02:43:06'),
(2, 'Transact Sales', '2016-12-04 02:43:40', '2016-12-04 02:43:40'),
(3, 'Generate Reports', '2016-12-04 02:43:48', '2016-12-04 02:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `permission_roles`
--

CREATE TABLE IF NOT EXISTS `permission_roles` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_roles`
--

INSERT INTO `permission_roles` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(2, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `permission_users`
--

CREATE TABLE IF NOT EXISTS `permission_users` (
  `user_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE IF NOT EXISTS `promos` (
  `id` int(10) unsigned NOT NULL,
  `promo_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `promo_rate` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2016-12-04 02:44:14', '2016-12-04 02:44:14'),
(2, 'Cashier', '2016-12-04 02:44:22', '2016-12-04 02:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE IF NOT EXISTS `role_users` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`role_id`, `user_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(10) unsigned NOT NULL,
  `service_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `promo_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `service_id`, `transaction_id`, `price`, `promo_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 60, NULL, '2016-12-03 18:35:29', '2016-12-03 18:35:29'),
(2, 72, 2, 300, NULL, '2016-12-04 02:35:15', '2016-12-04 02:35:15'),
(3, 28, 3, 350, NULL, '2016-12-04 03:26:46', '2016-12-04 03:26:46'),
(4, 26, 3, 200, NULL, '2016-12-04 03:26:46', '2016-12-04 03:26:46');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(10) unsigned NOT NULL,
  `service_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sub_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `service_type_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `sub_description`, `service_type_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 'GupitBabae', NULL, 1, 60, '2016-10-26 21:57:58', '2016-10-26 21:57:58'),
(2, 'GupitBabae with Hot Oil', NULL, 1, 150, '2016-10-26 21:59:21', '2016-10-26 21:59:21'),
(3, 'GupitBabae with Hair Spa', NULL, 1, 200, '2016-10-26 21:59:42', '2016-10-26 21:59:42'),
(4, 'GupitLalaki', NULL, 1, 60, '2016-10-26 21:59:49', '2016-10-26 21:59:49'),
(5, 'GupitLalaki with Scalp Treatment', NULL, 1, 150, '2016-10-26 22:00:05', '2016-10-26 22:00:05'),
(6, 'GupitPambata', 'Kiddie Cut', 1, 75, '2016-10-26 22:00:18', '2016-10-26 22:00:18'),
(7, 'Short Hair Blow Dry', NULL, 1, 100, '2016-10-26 22:00:36', '2016-10-26 22:00:36'),
(8, 'Long Hair Blow Dry', NULL, 1, 120, '2016-10-26 22:01:07', '2016-10-26 22:01:07'),
(9, 'Hair Iron', 'any length', 1, 200, '2016-10-26 22:01:25', '2016-10-26 22:01:25'),
(10, 'Rebond', 'Basic', 1, 850, '2016-10-26 22:01:40', '2016-10-26 22:01:40'),
(11, 'Rebond with Treatment', NULL, 1, 1000, '2016-10-26 22:02:02', '2016-10-26 22:02:02'),
(12, 'RebondLorea''l', 'X-tenso (with free treatment!)', 1, 2800, '2016-10-26 22:02:34', '2016-10-26 22:02:34'),
(13, 'Brazilian Keratin', NULL, 1, 1500, '2016-10-26 22:02:45', '2016-10-26 22:02:45'),
(14, 'Short (Regular)', 'Regular Salon Product', 2, 250, '2016-10-26 22:03:04', '2016-10-26 22:08:00'),
(15, 'Medium Short (Regular)', 'Regular Salon Product', 2, 350, '2016-10-26 22:03:13', '2016-10-26 22:08:13'),
(16, 'Long (Regular)', 'Regular Salon Product', 2, 600, '2016-10-26 22:03:24', '2016-10-26 22:08:23'),
(17, 'Extra Long (Regular)', 'Regular Salon Product', 2, 700, '2016-10-26 22:03:55', '2016-10-26 22:08:36'),
(18, 'Double Extra Long (Regular)', 'Regular Salon Product (with free treatment)', 2, 1000, '2016-10-26 22:04:19', '2016-10-26 22:08:48'),
(19, 'Re-roots Anti White-Hair', 'Natural Black only (3 inch. max)', 2, 250, '2016-10-26 22:07:09', '2016-10-26 22:07:09'),
(20, 'Short (Lorea''l/Matrix/Elgon)', NULL, 2, 1000, '2016-10-26 22:09:29', '2016-10-26 22:09:29'),
(21, 'Medium Short (Lorea''l/Matrix/Elgon)', NULL, 2, 1500, '2016-10-26 22:10:15', '2016-10-26 22:10:15'),
(22, 'Long (Lorea''l/Matrix/Elgon)', NULL, 2, 3000, '2016-10-26 22:10:40', '2016-10-26 22:10:40'),
(23, 'Extra Long (Lorea''l/Matrix/Elgon)', 'with free treatment', 2, 3500, '2016-10-26 22:11:36', '2016-10-26 22:11:36'),
(24, 'Double Extra Long (Lorea''l/Matrix/Elgon)', 'with free treatment', 2, 4000, '2016-10-26 22:11:59', '2016-10-26 22:11:59'),
(25, 'Hot Oil', NULL, 3, 150, '2016-10-26 22:12:10', '2016-10-26 22:12:10'),
(26, 'Hair Spa', NULL, 3, 200, '2016-10-26 22:12:21', '2016-10-26 22:12:21'),
(27, 'Keratin', NULL, 2, 300, '2016-10-26 22:12:36', '2016-10-26 22:12:36'),
(28, 'Cellophane', NULL, 3, 350, '2016-10-26 22:12:55', '2016-10-26 22:12:55'),
(29, 'Semi De Lino', NULL, 3, 450, '2016-10-26 22:13:13', '2016-10-26 22:13:13'),
(30, 'Power Dose', NULL, 3, 500, '2016-10-26 22:13:28', '2016-10-26 22:13:28'),
(31, 'Scalp Treatment (Men)', NULL, 3, 150, '2016-10-26 22:13:45', '2016-10-26 22:13:45'),
(32, 'Classic-Natural (Eyelash Extension)', NULL, 4, 450, '2016-10-26 22:14:18', '2016-10-26 22:14:18'),
(33, 'Charming-Doll (Eyelash Extension)', NULL, 4, 500, '2016-10-26 22:14:43', '2016-10-26 22:14:43'),
(34, 'Flirty-Doll (Eyelash Extension)', NULL, 4, 700, '2016-10-26 22:15:05', '2016-10-26 22:15:05'),
(35, 'Eyelash Retouch', NULL, 4, 250, '2016-10-26 22:16:45', '2016-10-26 22:16:45'),
(36, 'Eyelash Removal', NULL, 4, 150, '2016-10-26 22:16:57', '2016-10-26 22:16:57'),
(37, 'Manicure (Regular)', 'Regular Polish', 5, 65, '2016-10-26 22:17:20', '2016-10-26 22:17:20'),
(38, 'Pedicure (Regular)', 'Regular Polish', 5, 75, '2016-10-26 22:17:34', '2016-10-26 22:17:34'),
(39, 'Manicure (Orty)', NULL, 5, 100, '2016-10-26 22:18:48', '2016-10-26 22:18:48'),
(40, 'Pedicure (Orty)', NULL, 5, 120, '2016-10-26 22:19:12', '2016-10-26 22:19:12'),
(41, 'Manicure & Pedicure (Regular)', 'Regular Polish', 5, 130, '2016-10-26 22:19:32', '2016-10-26 22:19:32'),
(42, 'Manicure & Pedicure (Orty)', NULL, 5, 170, '2016-10-26 22:19:54', '2016-10-26 22:19:54'),
(43, 'Gel Polish Hand', NULL, 5, 350, '2016-10-26 22:20:03', '2016-10-26 22:20:03'),
(44, 'Gel Polish Foot', NULL, 5, 400, '2016-10-26 22:20:20', '2016-10-26 22:20:20'),
(45, 'Gel Hand and Foot', NULL, 5, 700, '2016-10-26 22:20:34', '2016-10-26 22:20:34'),
(46, 'Foot Reflex', NULL, 5, 250, '2016-10-26 22:20:49', '2016-10-26 22:20:49'),
(47, 'Foot Spa', NULL, 5, 200, '2016-10-26 22:20:59', '2016-10-26 22:20:59'),
(48, 'Underarm (Women)', NULL, 6, 150, '2016-10-26 22:21:23', '2016-10-26 22:21:23'),
(49, 'Underarm (Men)', NULL, 6, 170, '2016-10-26 22:21:33', '2016-10-26 22:21:33'),
(50, 'Bikini (Women)', NULL, 6, 300, '2016-10-26 22:21:46', '2016-10-26 22:21:46'),
(51, 'Bikini (Men)', NULL, 6, 350, '2016-10-26 22:21:57', '2016-10-26 22:21:57'),
(52, 'Brazilian (Women)', NULL, 6, 450, '2016-10-26 22:22:09', '2016-10-26 22:22:09'),
(53, 'Brazilian (Men)', NULL, 6, 600, '2016-10-26 22:22:45', '2016-10-26 22:22:45'),
(54, 'Eyebrow (Women)', NULL, 6, 150, '2016-10-26 22:23:40', '2016-10-26 22:23:40'),
(55, 'Eyebrow (Men)', NULL, 6, 170, '2016-10-26 22:23:51', '2016-10-26 22:23:51'),
(56, 'Beard', NULL, 6, 300, '2016-10-26 22:24:12', '2016-10-26 22:24:12'),
(57, 'Full Leg (Women)', NULL, 6, 400, '2016-10-26 22:24:26', '2016-10-26 22:24:26'),
(58, 'Full Leg (Men)', NULL, 6, 500, '2016-10-26 22:24:35', '2016-10-26 22:24:35'),
(59, 'Half Leg (Women)', NULL, 6, 200, '2016-10-26 22:24:48', '2016-10-26 22:24:48'),
(60, 'Half Leg (Men)', NULL, 6, 300, '2016-10-26 22:24:57', '2016-10-26 22:24:57'),
(61, 'Full Arm (Women)', NULL, 6, 300, '2016-10-26 22:25:11', '2016-10-26 22:26:32'),
(62, 'Full Arm (Men)', NULL, 6, 400, '2016-10-26 22:25:20', '2016-10-26 22:26:43'),
(63, 'Half Arm (Women)', NULL, 6, 150, '2016-10-26 22:25:59', '2016-10-26 22:25:59'),
(64, 'Half Arm (Men)', NULL, 6, 250, '2016-10-26 22:26:12', '2016-10-26 22:26:12'),
(65, 'Full Back (Women)', NULL, 6, 300, '2016-10-26 22:27:00', '2016-10-26 22:27:00'),
(66, 'Full Back (Men)', NULL, 6, 400, '2016-10-26 22:27:11', '2016-10-26 22:27:11'),
(67, 'Stomach (Women)', NULL, 6, 150, '2016-10-26 22:27:25', '2016-10-26 22:27:25'),
(68, 'Stomach (Men)', NULL, 6, 250, '2016-10-26 22:27:35', '2016-10-26 22:27:35'),
(69, 'Midriff (Women)', NULL, 6, 150, '2016-10-26 22:27:49', '2016-10-26 22:27:49'),
(70, 'Midriff (Men)', NULL, 6, 150, '2016-10-26 22:28:02', '2016-10-26 22:28:02'),
(71, 'Swedish', '1 hour', 7, 300, '2016-10-26 22:28:16', '2016-10-26 22:28:16'),
(72, 'Shiatsu', '1 hour', 7, 300, '2016-10-26 22:28:37', '2016-10-26 22:28:37'),
(73, 'Shiatsu (Home Service)', '1 hour', 7, 320, '2016-10-26 22:28:54', '2016-10-26 22:28:54'),
(74, 'Foot Reflex Massage', '1 hour', 7, 250, '2016-10-26 22:29:52', '2016-10-26 22:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `servicetypes`
--

CREATE TABLE IF NOT EXISTS `servicetypes` (
  `id` int(10) unsigned NOT NULL,
  `service_type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sub_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `servicetypes`
--

INSERT INTO `servicetypes` (`id`, `service_type_name`, `sub_description`, `created_at`, `updated_at`) VALUES
(1, 'Hair Care', NULL, '2016-10-26 21:56:49', '2016-10-26 21:56:49'),
(2, 'Hair Color', NULL, '2016-10-26 21:56:57', '2016-10-26 21:56:57'),
(3, 'Hair Treatment Booster', NULL, '2016-10-26 21:57:06', '2016-10-26 21:57:06'),
(4, 'Body Care', NULL, '2016-10-26 21:57:14', '2016-10-26 21:57:14'),
(5, 'Nails', NULL, '2016-10-26 21:57:20', '2016-10-26 21:57:20'),
(6, 'Waxing', NULL, '2016-10-26 21:57:26', '2016-10-26 21:57:26'),
(7, 'Massage', NULL, '2016-10-26 21:57:31', '2016-10-26 21:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(10) unsigned NOT NULL,
  `customer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `promo_id` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `customer`, `branch_id`, `promo_id`, `price`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Denimar', 1, NULL, 60, 1, '2016-12-03 18:35:29', '2016-12-03 18:35:29'),
(2, 'Denden', 1, NULL, 300, 1, '2016-12-04 02:35:15', '2016-12-04 02:35:15'),
(3, 'MM', 1, NULL, 550, 2, '2016-12-04 03:26:46', '2016-12-04 03:26:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `branch_id` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `branch_id`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Micah Castillo', 'castillo.mics@gmail.com', 1, '$2y$10$PC7c92UtUVd8l9c69ppdiuZPJPUBuF/UM6uius.eOm8SosSQJTfBK', 'WBDRpewQJavCcUzGE81dGx5MinfhfUYZ76DaLD9zgw7ACruOfKQxWcqJFzN2', '2016-10-23 10:19:50', '2016-12-04 03:24:47'),
(2, 'Juan Dela Cruz', 'jcdelacruz@gmail.com', 1, '$2y$10$IqRScIVQYxz4QjeNGS.jE.BZrJjTa7yX0ZUiwy7XSldGkOCt4iSfO', 'HchYGD7omL5pBZvq5wavuhYNaXJu9oWDi7EZOlAxESdHjaksrDadXNj5HiqN', '2016-12-04 03:06:01', '2016-12-04 04:29:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `branches_branch_name_unique` (`branch_name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_roles`
--
ALTER TABLE `permission_roles`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_roles_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_users`
--
ALTER TABLE `permission_users`
  ADD PRIMARY KEY (`user_id`,`permission_id`),
  ADD KEY `permission_users_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `promos_promo_name_unique` (`promo_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`role_id`,`user_id`),
  ADD KEY `role_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_service_name_unique` (`service_name`);

--
-- Indexes for table `servicetypes`
--
ALTER TABLE `servicetypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `servicetypes_service_type_name_unique` (`service_type_name`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `servicetypes`
--
ALTER TABLE `servicetypes`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_roles`
--
ALTER TABLE `permission_roles`
  ADD CONSTRAINT `permission_roles_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_users`
--
ALTER TABLE `permission_users`
  ADD CONSTRAINT `permission_users_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_users`
--
ALTER TABLE `role_users`
  ADD CONSTRAINT `role_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
