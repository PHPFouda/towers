-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2019 at 06:14 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `towers`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Admin', '2', 1509202047),
('Client', '3', 1515275918),
('SuperAdmin', '1', 1509214420);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1509201678, 1509201678),
('/categories/*', 2, NULL, NULL, NULL, 1515275859, 1515275859),
('/categories/create', 2, NULL, NULL, NULL, 1515275859, 1515275859),
('/categories/delete', 2, NULL, NULL, NULL, 1515275859, 1515275859),
('/categories/index', 2, NULL, NULL, NULL, 1515275859, 1515275859),
('/categories/update', 2, NULL, NULL, NULL, 1515275859, 1515275859),
('/categories/view', 2, NULL, NULL, NULL, 1515275859, 1515275859),
('/debug/*', 2, NULL, NULL, NULL, 1509201698, 1509201698),
('/gii/*', 2, NULL, NULL, NULL, 1509201702, 1509201702),
('/items/*', 2, NULL, NULL, NULL, 1515275859, 1515275859),
('/items/create', 2, NULL, NULL, NULL, 1515275859, 1515275859),
('/items/delete', 2, NULL, NULL, NULL, 1515275859, 1515275859),
('/items/index', 2, NULL, NULL, NULL, 1515275859, 1515275859),
('/items/update', 2, NULL, NULL, NULL, 1515275859, 1515275859),
('/items/view', 2, NULL, NULL, NULL, 1515275859, 1515275859),
('/orders/*', 2, NULL, NULL, NULL, 1515275847, 1515275847),
('/orders/create', 2, NULL, NULL, NULL, 1515275847, 1515275847),
('/orders/delete', 2, NULL, NULL, NULL, 1515275847, 1515275847),
('/orders/index', 2, NULL, NULL, NULL, 1515275847, 1515275847),
('/orders/update', 2, NULL, NULL, NULL, 1515275847, 1515275847),
('/orders/view', 2, NULL, NULL, NULL, 1515275847, 1515275847),
('/site/*', 2, NULL, NULL, NULL, 1509201678, 1509201678),
('/site/error', 2, NULL, NULL, NULL, 1509201678, 1509201678),
('/site/index', 2, NULL, NULL, NULL, 1509201678, 1509201678),
('/site/login', 2, NULL, NULL, NULL, 1509201678, 1509201678),
('/site/logout', 2, NULL, NULL, NULL, 1509201678, 1509201678),
('/user/*', 2, NULL, NULL, NULL, 1515275836, 1515275836),
('/user/create', 2, NULL, NULL, NULL, 1515275836, 1515275836),
('/user/delete', 2, NULL, NULL, NULL, 1515275836, 1515275836),
('/user/index', 2, NULL, NULL, NULL, 1515275836, 1515275836),
('/user/update', 2, NULL, NULL, NULL, 1515275836, 1515275836),
('/user/view', 2, NULL, NULL, NULL, 1515275836, 1515275836),
('Admin', 1, 'Default role assigned to admin', NULL, NULL, 1509202017, 1509202017),
('admin_permission', 2, 'Routes allowed to administrators', NULL, NULL, 1509201929, 1509201929),
('Client', 1, NULL, NULL, NULL, 1515275792, 1515275792),
('client_permission', 2, NULL, NULL, NULL, 1515275775, 1515275775),
('SuperAdmin', 1, 'Default role assigned to super admin', NULL, NULL, 1509201796, 1509201796),
('SuperAdmin_permission', 2, 'Routes allowed to superAdmin', NULL, NULL, 1509201437, 1509201437);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('SuperAdmin_permission', '/*'),
('client_permission', '/orders/*'),
('admin_permission', '/site/*'),
('Admin', 'admin_permission'),
('Client', 'client_permission'),
('SuperAdmin', 'SuperAdmin_permission');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `parent_id` int(11) UNSIGNED DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `normalImage` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `in_main_page` tinyint(1) DEFAULT NULL,
  `order` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `normalImage`, `active`, `in_main_page`, `order`) VALUES
(1, NULL, 'مصاعد كهربائية', '', 1, NULL, 1),
(2, NULL, 'مصاعد هيدروليكية', '', 1, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `imageUrl` varchar(100) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `sale_count` int(11) DEFAULT NULL,
  `profitPercent` float DEFAULT NULL,
  `purchPrice` float NOT NULL,
  `weight` float NOT NULL,
  `freeShipping` tinyint(1) NOT NULL DEFAULT '0',
  `max_amount_in_order` smallint(6) DEFAULT NULL,
  `isFeatured` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `inStock` tinyint(1) NOT NULL,
  `price` float NOT NULL,
  `price_old` float DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `title`, `description`, `category_id`, `barcode`, `imageUrl`, `quantity`, `sale_count`, `profitPercent`, `purchPrice`, `weight`, `freeShipping`, `max_amount_in_order`, `isFeatured`, `active`, `inStock`, `price`, `price_old`, `tax`, `created`, `order`, `last_update`) VALUES
(1, 'نيكس واي ذو السرعة العالية', 'نيكس واي ذو السرعة العالية', 1, '1000sd', '1212', 1000, 0, 0, 5000, 50, 0, NULL, NULL, 1, 1, 7000, NULL, 0, '2018-01-07 23:07:22', 1, '2018-01-07 23:07:22'),
(2, 'مصعد كهربائى', 'مصعد كهربائى', 2, '62', '21', 200, 0, 0, 2000, 50, 0, 0, NULL, 1, 1, 5000, NULL, NULL, '2018-01-07 23:09:00', 2, '2018-01-07 23:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `alias` varchar(45) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `is_main` tinyint(1) DEFAULT '0',
  `active_admin` tinyint(1) DEFAULT '1',
  `is_main_admin` tinyint(1) DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`alias`, `title`, `image`, `active`, `is_main`, `active_admin`, `is_main_admin`, `created`) VALUES
('ar', 'Arabic', '', 1, 0, 1, 0, '2013-07-12 03:24:51'),
('en', 'English', '', 1, 1, 1, 1, '2013-07-12 03:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `is_backend` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `parent`, `route`, `order`, `data`, `active`, `is_backend`, `created`) VALUES
(1, 'Home', NULL, '/site/index', 1, '', 1, 1, '2017-10-28 19:55:46'),
(2, 'Home', NULL, '/site/index', 1, '', 1, 0, '2017-10-29 00:53:52'),
(3, 'About Us', NULL, '/site/about', 2, '', 1, 0, '2017-10-29 00:55:11'),
(4, 'Contact Us', NULL, '/site/contact', 3, '', 1, 0, '2017-10-29 00:55:57'),
(5, 'Orders', NULL, '/orders/index', 4, NULL, 1, 1, NULL),
(6, 'Orders Categories', NULL, '/categories/index', 5, NULL, 1, 1, NULL),
(7, 'Orders', NULL, '/orders/index', 7, NULL, 1, 0, NULL),
(8, 'Items', NULL, '/items/index', 8, NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_translations`
--

CREATE TABLE `menu_translations` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `language_alias` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_translations`
--

INSERT INTO `menu_translations` (`id`, `menu_id`, `language_alias`, `name`) VALUES
(1, 1, 'ar', 'الرئيسية'),
(2, 1, 'en', 'Home'),
(3, 2, 'ar', 'الرئيسية'),
(4, 2, 'en', 'Home'),
(5, 3, 'ar', 'من نحن'),
(6, 3, 'en', 'About Us'),
(7, 4, 'ar', 'اتصل بنا'),
(8, 4, 'en', 'Contact Us'),
(9, 5, 'ar', 'الطلبات'),
(10, 5, 'en', 'Orders'),
(11, 6, 'ar', 'الفئات'),
(12, 6, 'en', 'Categories'),
(13, 7, 'ar', 'الطلبات'),
(14, 7, 'en', 'Orders'),
(15, 8, 'ar', 'المنتجات'),
(16, 8, 'en', 'Items');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1509162565),
('m140506_102106_rbac_init', 1509163618),
('m140602_111327_create_menu_table', 1509162572),
('m160312_050000_create_user', 1509162572);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_status` int(3) NOT NULL,
  `shippingservice_id` int(11) DEFAULT NULL,
  `subtotal` float NOT NULL,
  `shipping` float NOT NULL,
  `tax` float NOT NULL,
  `total` double NOT NULL,
  `paid` double NOT NULL,
  `due` double NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `additional_info` text,
  `additional_fees` float NOT NULL,
  `cancel_reason` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_status`, `shippingservice_id`, `subtotal`, `shipping`, `tax`, `total`, `paid`, `due`, `created`, `additional_info`, `additional_fees`, `cancel_reason`) VALUES
(5, 3, 1, NULL, 7000, 0, 0, 7000, 0, 7000, '2018-01-07 21:11:54', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `purchPrice` float NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) UNSIGNED NOT NULL,
  `profitPercent` float NOT NULL,
  `tax` float NOT NULL,
  `combination_info` text COMMENT '{"lang_ar": "combination_title_ar", "lang_en": "combination_title_en"}'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `quantity`, `price`, `purchPrice`, `order_id`, `item_id`, `profitPercent`, `tax`, `combination_info`) VALUES
(1, 1, 7000, 5000, 5, 1, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` varchar(250) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `is_editable` tinyint(1) DEFAULT '1',
  `description` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `alias`, `setting_key`, `setting_value`, `title`, `is_editable`, `description`, `created`) VALUES
(1, 'General', 'site_name', 'مصاعد تاورز', 'Site Name', 1, 'The name Of the site', NULL),
(2, 'General', 'general_site_visited', '34119', 'Total Site Visited', 0, 'Total Site Visited', '2016-12-25 09:23:38');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'L3uU8QOxDSeNRqDFN9JufJWczkmgcVYN', '$2y$13$V5QgtlEDHkovTKhZxtv1feDICmFl7UoIiS8Ge/WWuHmyPHL/k32fu', 'DI2HxbkWoN8PuiznjeGzESQ3Aw8rr1S5_1509162792', 'admin@admin.com', 10, 1509162723, 1509162792);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Category_Parent` (`parent_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`alias`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Indexes for table `menu_translations`
--
ALTER TABLE `menu_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_menu_translations_menus1_idx` (`menu_id`),
  ADD KEY `fk_menu_translations_languages1_idx` (`language_alias`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_shippingservice1_idx` (`shippingservice_id`),
  ADD KEY `fk_orders_orderstatus1_idx` (`order_status`),
  ADD KEY `fk_orders_user1_idx` (`user_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_detail_orders1_idx` (`order_id`),
  ADD KEY `fk_order_detail_products1_idx` (`item_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `menu_translations`
--
ALTER TABLE `menu_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `menu_translations`
--
ALTER TABLE `menu_translations`
  ADD CONSTRAINT `menu_translations_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
