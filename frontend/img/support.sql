-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 06, 2016 at 01:44 PM
-- Server version: 5.5.47-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `support`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `ticket_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `body` text COLLATE utf8_persian_ci NOT NULL,
  `file` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `customer_view` tinyint(1) NOT NULL,
  `pattern_signature` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL COMMENT 'شماره پروژه',
  `telegram_id` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'آی دی تلگرام',
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'نام و نام خانوادگی',
  `email` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'ایمیل',
  `phone` int(11) NOT NULL COMMENT 'شماره همراه',
  `username` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'نام کاربری',
  `password` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'رمز عبور',
  `date` date NOT NULL COMMENT 'تاریخ',
  `type_project` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'نوع پروژه (شرکتی - تجاری - فروشگاهی و ...(',
  `note` text COLLATE utf8_persian_ci NOT NULL COMMENT 'توضیحات',
  `company` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'شرکت',
  `connector` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'طرف حساب یا رابط',
  `address` text COLLATE utf8_persian_ci NOT NULL COMMENT 'آدرس',
  `date_create` date NOT NULL COMMENT 'تاریخ ایجاد مشتری',
  `create_by` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'نام ایجاد  کننده مشتری'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `project_id`, `telegram_id`, `name`, `email`, `phone`, `username`, `password`, `date`, `type_project`, `note`, `company`, `connector`, `address`, `date_create`, `create_by`) VALUES
(4, 25, 'paraxWebTechnical@', 'میثم مقصودی', 'safir.1987@gmail.com', 2147483647, 'meysam1366', '0f570192c292bd835dc6a3dfbc6afbd7', '1395-03-05', 'شخصی 1', 'یادداشت', 'میلاد', 'میثم مقصودی', 'آدرس', '1395-03-05', 'آقای زارعی'),
(5, 27, '@test', 'مشتری تست', 'testtest@test.com', 2147483647, 'test', '098f6bcd4621d373cade4e832627b4f6', '1395-03-17', 'تجاری', 'adaksdakj', 'test', 'test', 'test lmsdlsdlm', '1395-03-17', 'آقای زارعی');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `project_name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `problem_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_persian_ci,
  `date_in` date NOT NULL,
  `date_out` date NOT NULL,
  `date_start_support` date NOT NULL,
  `price` bigint(20) DEFAULT NULL,
  `date_create` date NOT NULL,
  `create_by` varchar(255) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `domain_id`, `project_name`, `user_id`, `problem_id`, `description`, `date_in`, `date_out`, `date_start_support`, `price`, `date_create`, `create_by`) VALUES
(25, 5, 'گوگل', 3, 0, 'توضیحات پروژه', '1395-03-12', '1395-03-25', '1395-03-31', 500000, '1395-03-04', 'test'),
(26, 5, 'گوگل', 3, 0, 'Ss', '1395-03-04', '1395-03-04', '1395-03-04', 2000000, '1395-03-04', 'آقای زارعی'),
(27, 6, 'test', 6, NULL, 'test', '1395-03-18', '1395-03-24', '1395-03-31', 2938238, '1395-03-17', 'آقای زارعی');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `progress` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL,
  `file` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_project`
--

CREATE TABLE IF NOT EXISTS `ticket_project` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'نام و نام خانوادگی',
  `email` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'ایمیل شرکتی',
  `username` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'نام کاربری',
  `password` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'رمز عبور',
  `post` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'سمت',
  `idNumber` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'شماره پرسنلی',
  `role` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'سطح دسترسی'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `post`, `idNumber`, `role`) VALUES
(1, 'آقای زارعی', 'pz4430@gmail.com', 'pz4430@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'مدیر', '2444242', 'Admin'),
(2, 'میثم مقصودی', 'safir.1987@gmail.com', 'meysam1366', '61125cd3661f789a3d241dd4f9436862', 'فنی', '33424', 'Technical'),
(3, 'test', 'test@gmail.com', 'test', '098f6bcd4621d373cade4e832627b4f6', 'کارشناس فنی', '3237527', 'Expert'),
(4, 'عماد اختری', 'akhtari@gmail.com', 'emad', '8a94c4f2dd83b64ee9c2a79f54aba4ba', 'پشتیبانی', '737667', 'Supported'),
(5, 'احمد', 'احمدی', 'ahmad', '61243c7b9a4022cb3f8dc3106767ed12', 'گرافیست', '7877', 'Graphic'),
(6, 'محمد محمدی', 'mohammad@parax.com', 'mohammad', 'a219deb20f118754a4280a77f842bdbf', 'کارشناس فنی', '98898', 'Expert');

-- --------------------------------------------------------

--
-- Table structure for table `website`
--

CREATE TABLE IF NOT EXISTS `website` (
  `id` int(11) NOT NULL,
  `domain_name` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `domain_url` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `user_panel` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `pass_panel` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `domain_price` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `domain_date_start` date DEFAULT NULL,
  `domain_date_expired` date DEFAULT NULL,
  `host_price` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `host_date_start` date NOT NULL DEFAULT '0000-00-00',
  `host_date_expired` date NOT NULL DEFAULT '0000-00-00',
  `name_admin_site` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `phone_admin_site` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `email_admin_site` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `user_social_network` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `pass_social_network` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `user_weblog` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `pass_weblog` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `website`
--

INSERT INTO `website` (`id`, `domain_name`, `domain_url`, `user_panel`, `pass_panel`, `domain_price`, `domain_date_start`, `domain_date_expired`, `host_price`, `host_date_start`, `host_date_expired`, `name_admin_site`, `phone_admin_site`, `email_admin_site`, `user_social_network`, `pass_social_network`, `user_weblog`, `pass_weblog`) VALUES
(3, 'گیتی کالا 1', 'http://localhost/toptul/', 'admin', '77e2edcc9b40441200e31dc57dbb8829', '12000', '0773-12-27', '0774-12-28', '200000', '0773-12-12', '0774-12-13', 'test', '09206457898', 'test@gmail.com', 'test1', '0cd1aaae2fd9b84918ff731d313c6e4c', 'test', '0cd1aaae2fd9b84918ff731d313c6e4c'),
(4, 'تاپ تول', 'http://localhost/toptul/', 'meysam1366', '61125cd3661f789a3d241dd4f9436862', '12000', '1395-03-04', '1395-03-04', '200000', '1395-03-04', '1395-03-04', 'test', '09206457898', 'test@gmail.com', 'test1', '1aabac6d068eef6a7bad3fdf50a05cc8', 'test', '77963b7a931377ad4ab5ad6a9cd718aa'),
(5, 'گوگل', 'http://localhost/toptul/', 'admin', 'f17436d5aea8d9b9bfd6d96ff650e879', '10000', '0773-12-13', '0773-12-13', '100000', '0773-12-13', '0773-12-13', 'test', '09206457898', 'test@gmail.com', 'test1', '1e9d0af6aaa98dd3f6fa0cee9c403cb0', 'test', '985bda1a6bf60cbb8960d0397c9b9d39'),
(6, 'test', 'www.test.com', 'test', '098f6bcd4621d373cade4e832627b4f6', '90000', '1395-03-17', '1396-03-17', '9999999', '1395-03-17', '1396-03-17', 'test', '0909090090', 'test@test.com', 'test', '098f6bcd4621d373cade4e832627b4f6', 'test', '098f6bcd4621d373cade4e832627b4f6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `problem_id` (`problem_id`),
  ADD KEY `domain_id` (`domain_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ticket_project`
--
ALTER TABLE `ticket_project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website`
--
ALTER TABLE `website`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ticket_project`
--
ALTER TABLE `ticket_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `website`
--
ALTER TABLE `website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comment_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_commentId` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `fk_customer_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_project_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_project_website` FOREIGN KEY (`domain_id`) REFERENCES `website` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_ticket_userId` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ticket_project`
--
ALTER TABLE `ticket_project`
  ADD CONSTRAINT `fk_ticketId_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_projectId_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
