-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.38 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for fairwaves
CREATE DATABASE IF NOT EXISTS `fairwaves` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `fairwaves`;

-- Dumping structure for table fairwaves.affiliate_links
CREATE TABLE IF NOT EXISTS `affiliate_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `raffle_ticket_id` bigint unsigned NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `affiliate_links_raffle_ticket_id_foreign` (`raffle_ticket_id`),
  CONSTRAINT `affiliate_links_raffle_ticket_id_foreign` FOREIGN KEY (`raffle_ticket_id`) REFERENCES `raffle_tickets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.affiliate_links: ~0 rows (approximately)

-- Dumping structure for table fairwaves.affiliate_product
CREATE TABLE IF NOT EXISTS `affiliate_product` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `affiliate_link_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `affiliate_product_product_id_foreign` (`product_id`),
  KEY `affiliate_product_affiliate_link_id_foreign` (`affiliate_link_id`),
  CONSTRAINT `affiliate_product_affiliate_link_id_foreign` FOREIGN KEY (`affiliate_link_id`) REFERENCES `affiliate_links` (`id`) ON DELETE CASCADE,
  CONSTRAINT `affiliate_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.affiliate_product: ~0 rows (approximately)

-- Dumping structure for table fairwaves.affiliate_referrals
CREATE TABLE IF NOT EXISTS `affiliate_referrals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `raffle_ticket_id` bigint unsigned NOT NULL,
  `product_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views_count` int NOT NULL DEFAULT '0',
  `referral_count` int NOT NULL DEFAULT '0',
  `product_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `affiliate_commission` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_affiliate_price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `affiliate_referrals_user_id_foreign` (`user_id`),
  KEY `affiliate_referrals_raffle_ticket_id_foreign` (`raffle_ticket_id`),
  CONSTRAINT `affiliate_referrals_raffle_ticket_id_foreign` FOREIGN KEY (`raffle_ticket_id`) REFERENCES `raffle_tickets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `affiliate_referrals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `affiliate_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.affiliate_referrals: ~0 rows (approximately)

-- Dumping structure for table fairwaves.affiliate_rules
CREATE TABLE IF NOT EXISTS `affiliate_rules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.affiliate_rules: ~0 rows (approximately)

-- Dumping structure for table fairwaves.affiliate_users
CREATE TABLE IF NOT EXISTS `affiliate_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DOB` date NOT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NIC` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactno` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promotion_method` json DEFAULT NULL,
  `instagram_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_website_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_whatsapp_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `affiliate_users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.affiliate_users: ~0 rows (approximately)

-- Dumping structure for table fairwaves.banners
CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.banners: ~0 rows (approximately)
INSERT IGNORE INTO `banners` (`id`, `image`, `created_at`, `updated_at`) VALUES
	(2, 'banners/pySXFZPbAOSNKlhLiGszBG0eQ4pR6SD5VTGCPbiW.jpg', '2025-05-05 10:31:36', '2025-05-05 10:31:36'),
	(3, 'banners/RtuR6WgcQU6Y1wjIdpW7ZR0yjo6QXoC29DePO8tF.jpg', '2025-05-05 10:31:51', '2025-05-05 10:31:51'),
	(6, 'banners/qBP8s0sWOiqqRHNujv6iqjZGtHHAbieJEZ2uqnQI.jpg', '2025-05-05 10:44:48', '2025-05-05 10:44:48');

-- Dumping structure for table fairwaves.brands
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_top_brand` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.brands: ~0 rows (approximately)
INSERT IGNORE INTO `brands` (`id`, `name`, `image`, `slug`, `is_top_brand`, `created_at`, `updated_at`) VALUES
	(1, 'LG', 'brands/Hqdu6dflxfeIavAGEGl8XFRZ7ZH7lGh4AEqBy9sE.svg', 'lg', 1, '2025-05-16 02:52:01', '2025-05-16 02:52:01'),
	(2, 'HP', 'brands/FOiWC5VFOi3SlA0bJKTyMDCO7Saqo8rDoGlxY5yj.png', 'hp', 1, '2025-05-16 03:01:47', '2025-05-16 03:01:47'),
	(3, 'HARMAS', 'brands/o3mZJcVC5A6oWYTywjGZNSJ3nNWHK6mm7mePj6KJ.png', 'harmas', 0, '2025-05-16 03:02:19', '2025-05-16 03:02:19'),
	(4, 'Apple', 'brands/94UhNezXAlKEp52hGpG0I6yDWvG1w7efiMyekpgS.png', 'apple', 1, '2025-05-16 03:04:00', '2025-05-16 03:04:00'),
	(5, 'Abans', 'brands/F6sPf6hiNCT5ol0loL6kr41MdFhUhP5gueFgSJM6.png', 'abans', 1, '2025-05-16 03:04:45', '2025-05-16 03:04:45');

-- Dumping structure for table fairwaves.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.cache: ~0 rows (approximately)

-- Dumping structure for table fairwaves.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.cache_locks: ~0 rows (approximately)

-- Dumping structure for table fairwaves.cart_items
CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_items_user_id_foreign` (`user_id`),
  KEY `cart_items_product_id_foreign` (`product_id`),
  CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.cart_items: ~1 rows (approximately)

-- Dumping structure for table fairwaves.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.categories: ~0 rows (approximately)
INSERT IGNORE INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(18, 'TV', '2025-05-08 11:48:59', '2025-05-08 11:48:59'),
	(19, 'Audio & Video', '2025-05-08 11:50:33', '2025-05-08 11:50:33'),
	(20, 'Home Appliances', '2025-05-08 11:52:19', '2025-05-08 11:52:19'),
	(21, 'Mobile Phones & Devices', '2025-05-14 12:19:24', '2025-05-14 12:19:24'),
	(22, 'Apple', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(23, 'Computers', '2025-05-14 12:38:58', '2025-05-14 12:38:58'),
	(24, 'Kitchen Appliances', '2025-05-14 12:52:49', '2025-05-14 12:52:49');

-- Dumping structure for table fairwaves.company_settings
CREATE TABLE IF NOT EXISTS `company_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.company_settings: ~1 rows (approximately)
INSERT IGNORE INTO `company_settings` (`id`, `title`, `address`, `email`, `contact`, `website`, `footer_text`, `logo`, `created_at`, `updated_at`) VALUES
	(1, 'FFair Waves', 'ABC', 'ABC@gmail.com', '07546854', '#', 'ABC', NULL, '2025-05-27 06:24:24', '2025-05-27 06:24:25');

-- Dumping structure for table fairwaves.customer_orders
CREATE TABLE IF NOT EXISTS `customer_orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `house_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apartment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `total_cost` decimal(15,2) NOT NULL,
  `status` enum('Pending','Accepted','Packed','Pickup Done','Ready to Ship','Shipped','In Transit','Customer Unavailable','Rescheduled','Delivered','Cancelled','Returned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `activity_logs` json DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_orders_order_code_unique` (`order_code`),
  KEY `customer_orders_user_id_foreign` (`user_id`),
  CONSTRAINT `customer_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.customer_orders: ~0 rows (approximately)
INSERT IGNORE INTO `customer_orders` (`id`, `order_code`, `user_id`, `customer_name`, `phone`, `email`, `house_no`, `apartment`, `city`, `postal_code`, `date`, `total_cost`, `status`, `activity_logs`, `payment_method`, `payment_status`, `created_at`, `updated_at`) VALUES
	(1, 'ORD-FJJS8ESZ', 2, 'asd asd', '0234234324', 'manula@gmail.com', '123/ colombo1212', 'fsd', 'fsdf', 'fsd', '2025-05-30', 4700.00, 'Pending', NULL, 'COD', 'Pending', '2025-05-30 02:49:45', '2025-05-30 02:50:00'),
	(2, 'ORD-X8ZBFJMR', 2, 'asd asd', '0234234324', 'manula@gmail.com', '123/ colombo1212', 'fsd', 'fsdf', 'fsd', '2025-05-30', 400.00, 'Pending', NULL, 'COD', 'Pending', '2025-05-30 02:50:54', '2025-05-30 02:51:07');

-- Dumping structure for table fairwaves.customer_order_items
CREATE TABLE IF NOT EXISTS `customer_order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` decimal(10,2) NOT NULL,
  `date` timestamp NOT NULL,
  `reviewed` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_order_items_id_unique` (`id`),
  KEY `customer_order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `customer_order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.customer_order_items: ~0 rows (approximately)
INSERT IGNORE INTO `customer_order_items` (`id`, `order_code`, `product_id`, `quantity`, `size`, `color`, `cost`, `date`, `reviewed`, `created_at`, `updated_at`) VALUES
	(1, 'ORD-FJJS8ESZ', 1, 4, 'xl', NULL, 400.00, '2025-05-29 18:30:00', 'no', '2025-05-30 02:49:45', '2025-05-30 02:49:45'),
	(2, 'ORD-FJJS8ESZ', 2, 2, 'xl', '#bd5151', 4000.00, '2025-05-29 18:30:00', 'no', '2025-05-30 02:49:45', '2025-05-30 02:49:45'),
	(3, 'ORD-X8ZBFJMR', 1, 1, NULL, NULL, 100.00, '2025-05-30 02:50:54', 'no', '2025-05-30 02:50:54', '2025-05-30 02:50:54');

-- Dumping structure for table fairwaves.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table fairwaves.inquiries
CREATE TABLE IF NOT EXISTS `inquiries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `reply` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not replied',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.inquiries: ~0 rows (approximately)

-- Dumping structure for table fairwaves.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.jobs: ~0 rows (approximately)

-- Dumping structure for table fairwaves.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.job_batches: ~0 rows (approximately)

-- Dumping structure for table fairwaves.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.migrations: ~36 rows (approximately)
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2024_10_25_044750_create_categories_table', 1),
	(5, '2024_10_25_044750_create_subcategories_table', 1),
	(6, '2024_10_25_045713_create_sub_subcategories_table', 1),
	(7, '2024_10_25_081517_create_products_table', 1),
	(8, '2024_10_25_081523_create_product_images_table', 1),
	(9, '2024_10_29_071017_create_system_users_table', 1),
	(10, '2024_10_30_063932_create_company_settings_table', 1),
	(11, '2024_10_30_081431_create_variations_table', 1),
	(12, '2024_11_06_081844_create_affiliate_users_table', 1),
	(13, '2024_11_06_084900_create_raffle_tickets_table', 1),
	(14, '2024_11_07_050041_create_cart_items_table', 1),
	(15, '2024_11_07_090702_create_customer_orders_table', 1),
	(16, '2024_11_07_090751_create_customer_order_items_table', 1),
	(17, '2024_11_10_003001_create_affiliate_links_table', 1),
	(18, '2024_11_10_010945_create_affiliate_referrals_table', 1),
	(19, '2024_11_10_011657_create_affiliate_product_table', 1),
	(20, '2024_11_10_040931_create_payment_requests_table', 1),
	(21, '2024_11_10_045623_create_affiliate_rules_table', 1),
	(22, '2024_11_12_054225_create_wishlists_table', 1),
	(23, '2024_11_18_051105_update_products_table', 1),
	(24, '2024_11_19_042214_create_vendors_table', 1),
	(25, '2024_11_19_061623_create_shops_table', 1),
	(26, '2024_11_19_072256_add_foreign_key_to_shop_id_in_products_table', 1),
	(27, '2024_11_20_103945_create_vendor_wallets_table', 1),
	(28, '2024_11_21_045740_create_vendor_payment_requests_table', 1),
	(29, '2024_11_21_055055_add_profile_and_bank_details_to_vendors_table', 1),
	(30, '2024_11_21_084729_create_reviews_table', 1),
	(31, '2024_11_21_095412_add_reviewer_id_to_reviews_table', 1),
	(32, '2024_11_21_161333_add_profile_image_to_users_table', 1),
	(33, '2024_11_22_102543_update_status_in_customer_orders_table', 1),
	(34, '2024_11_25_043842_add_activity_logs_to_customer_orders_table', 1),
	(35, '2025_02_14_042721_create_personal_access_tokens_table', 1),
	(36, '2025_03_10_071113_create_inquiries_table', 1),
	(37, '2024_05_15_063210_create_brands_table', 2),
	(38, '2025_05_05_150817_create_sliders_table', 2),
	(39, '2025_05_05_152806_create_banners_table', 2);

-- Dumping structure for table fairwaves.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table fairwaves.payment_requests
CREATE TABLE IF NOT EXISTS `payment_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `withdraw_amount` decimal(10,2) NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processing_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `paid_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `requested_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.payment_requests: ~0 rows (approximately)

-- Dumping structure for table fairwaves.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table fairwaves.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_id` bigint unsigned DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` text COLLATE utf8mb4_unicode_ci,
  `brand_id` bigint unsigned DEFAULT NULL,
  `category_id` bigint unsigned NOT NULL,
  `subcategory_id` bigint unsigned DEFAULT NULL,
  `sub_subcategory_id` bigint unsigned DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `normal_price` decimal(8,2) NOT NULL,
  `is_affiliate` tinyint(1) NOT NULL DEFAULT '0',
  `affiliate_price` decimal(8,2) DEFAULT NULL,
  `commission_percentage` decimal(5,2) DEFAULT NULL,
  `commission_price` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_product_id_unique` (`product_id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_subcategory_id_foreign` (`subcategory_id`),
  KEY `products_sub_subcategory_id_foreign` (`sub_subcategory_id`),
  KEY `products_shop_id_foreign` (`shop_id`),
  KEY `fk_products_brands1_idx` (`brand_id`),
  CONSTRAINT `fk_products_brands1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_sub_subcategory_id_foreign` FOREIGN KEY (`sub_subcategory_id`) REFERENCES `sub_subcategories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.products: ~2 rows (approximately)
INSERT IGNORE INTO `products` (`id`, `product_id`, `shop_id`, `product_name`, `product_description`, `brand_id`, `category_id`, `subcategory_id`, `sub_subcategory_id`, `quantity`, `tags`, `normal_price`, `is_affiliate`, `affiliate_price`, `commission_percentage`, `commission_price`, `created_at`, `updated_at`) VALUES
	(1, 'P-C884DB', NULL, 'Contrary to popular belief, Lorem Ipsum is not simply random text', 'Contrary to popular belief, Lorem Ipsum is not simply random text', 4, 19, 61, NULL, 95, 'Top Selling, Below', 100.00, 0, NULL, 0.00, NULL, '2025-05-30 01:45:08', '2025-05-30 02:50:54'),
	(2, 'P-26A698', NULL, 'JBL PartyBox Club 120 Speaker', 'JBL PartyBox Club 120 Speaker', 2, 19, 61, NULL, 198, 'Online Exclusive, Below', 2000.00, 0, NULL, 0.00, NULL, '2025-05-30 01:58:50', '2025-05-30 02:49:45');

-- Dumping structure for table fairwaves.product_images
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.product_images: ~0 rows (approximately)
INSERT IGNORE INTO `product_images` (`id`, `product_id`, `image_path`, `created_at`, `updated_at`) VALUES
	(1, 'P-C884DB', 'product_images/1748589308_1746810151_public (15) (1).png', '2025-05-30 01:45:09', '2025-05-30 01:45:09'),
	(2, 'P-26A698', 'product_images/1748590130_1746782490_public (1).png', '2025-05-30 01:58:50', '2025-05-30 01:58:50');

-- Dumping structure for table fairwaves.raffle_tickets
CREATE TABLE IF NOT EXISTS `raffle_tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Pending','Active','Used','Expired') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `raffle_tickets_token_unique` (`token`),
  KEY `raffle_tickets_user_id_foreign` (`user_id`),
  CONSTRAINT `raffle_tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `affiliate_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.raffle_tickets: ~0 rows (approximately)

-- Dumping structure for table fairwaves.reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `order_item_id` bigint unsigned NOT NULL,
  `rating` int unsigned NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci,
  `is_anonymous` tinyint(1) NOT NULL DEFAULT '0',
  `media` json DEFAULT NULL,
  `status` enum('Pending','Published','Rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reviewer_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_product_id_foreign` (`product_id`),
  KEY `reviews_order_item_id_foreign` (`order_item_id`),
  KEY `reviews_reviewer_id_foreign` (`reviewer_id`),
  CONSTRAINT `reviews_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `customer_order_items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.reviews: ~0 rows (approximately)

-- Dumping structure for table fairwaves.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.sessions: ~2 rows (approximately)
INSERT IGNORE INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('lmNrwxfMDrrEU0wXvBA2dwjqCrlDKE7TtEx1AaAM', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiRFpDZkZ2d01ubmlJeWtNb2lPRjlCcVRGQWpWZ1FtemYyc1ZXM1ZVQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0L2NvdW50Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjg6ImlzX2FkbWluIjtiOjE7czo0OiJuYW1lIjtzOjU6IkFkbWluIjtzOjU6ImVtYWlsIjtzOjE3OiJhZG1pbkBleGFtcGxlLmNvbSI7czo1OiJpbWFnZSI7Tjt9', 1748593352);

-- Dumping structure for table fairwaves.shops
CREATE TABLE IF NOT EXISTS `shops` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint unsigned NOT NULL,
  `shop_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_description` text COLLATE utf8mb4_unicode_ci,
  `shop_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shops_vendor_id_foreign` (`vendor_id`),
  CONSTRAINT `shops_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.shops: ~0 rows (approximately)

-- Dumping structure for table fairwaves.sliders
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.sliders: ~0 rows (approximately)
INSERT IGNORE INTO `sliders` (`id`, `image`, `created_at`, `updated_at`) VALUES
	(2, 'slider_images/ZXtyyDMuRjRlfRQ2h5MxFengSCgNPhv1Hi1wopD7.jpg', '2025-05-05 10:19:56', '2025-05-05 10:19:56'),
	(3, 'slider_images/nT6WvbkH6dbigZwRKVeF5MV65gRoqvNPlABnHUNd.jpg', '2025-05-05 10:20:08', '2025-05-05 10:20:08'),
	(4, 'slider_images/ghGjrulk3661VAhw3yoELXec72cdvjDvTqaGRiFT.jpg', '2025-05-05 10:43:39', '2025-05-05 10:43:39');

-- Dumping structure for table fairwaves.subcategories
CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subcategories_category_id_foreign` (`category_id`),
  CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.subcategories: ~0 rows (approximately)
INSERT IGNORE INTO `subcategories` (`id`, `category_id`, `name`, `created_at`, `updated_at`) VALUES
	(53, 18, 'JVC TV Special Offer', '2025-05-08 11:48:59', '2025-05-08 11:48:59'),
	(54, 18, 'LED TV', '2025-05-08 11:48:59', '2025-05-08 11:48:59'),
	(55, 18, 'Smart LED TV', '2025-05-08 11:48:59', '2025-05-08 11:48:59'),
	(56, 18, 'UHD TV', '2025-05-08 11:48:59', '2025-05-08 11:48:59'),
	(57, 18, 'OLED TV', '2025-05-08 11:48:59', '2025-05-08 11:48:59'),
	(58, 18, 'Commercial TV', '2025-05-08 11:48:59', '2025-05-08 11:48:59'),
	(59, 18, 'TV Accessories', '2025-05-08 11:48:59', '2025-05-08 11:48:59'),
	(60, 19, 'Speakers', '2025-05-08 11:50:33', '2025-05-08 11:50:33'),
	(61, 19, 'Earphones', '2025-05-08 11:50:33', '2025-05-08 11:50:33'),
	(62, 19, 'Headphones', '2025-05-08 11:50:33', '2025-05-08 11:50:33'),
	(63, 19, 'Home Theaters', '2025-05-08 11:50:33', '2025-05-08 11:50:33'),
	(64, 19, 'Sound Bars', '2025-05-08 11:50:33', '2025-05-08 11:50:33'),
	(65, 19, 'HiFi Systems', '2025-05-08 11:50:33', '2025-05-08 11:50:33'),
	(66, 20, 'Refrigerators', '2025-05-08 11:52:19', '2025-05-08 11:52:19'),
	(67, 20, 'Washing Machines', '2025-05-08 11:52:19', '2025-05-08 11:52:19'),
	(68, 20, 'Heaters & Geyser', '2025-05-08 11:52:20', '2025-05-08 11:52:20'),
	(69, 20, 'Fans', '2025-05-08 11:52:20', '2025-05-08 11:52:20'),
	(70, 20, 'Irons', '2025-05-08 11:52:20', '2025-05-08 11:52:20'),
	(71, 20, 'Air Conditioners', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(72, 20, 'Water Purifiers', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(73, 20, 'Home Improvement', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(74, 20, 'Home Utensils', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(75, 20, 'Sanitaryware', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(76, 20, 'Morphy Richards', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(77, 20, 'Floor Care', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(78, 21, 'Mobile Phones', '2025-05-14 12:19:24', '2025-05-14 12:19:24'),
	(79, 21, 'Tablets', '2025-05-14 12:19:24', '2025-05-14 12:19:24'),
	(80, 21, 'Smart Bands & Smart Watches', '2025-05-14 12:19:24', '2025-05-14 12:19:24'),
	(81, 21, 'Mobile Phone Accessories', '2025-05-14 12:19:24', '2025-05-14 12:19:24'),
	(82, 21, 'Smart Education', '2025-05-14 12:19:24', '2025-05-14 12:19:24'),
	(83, 22, 'IPhones', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(84, 22, 'IPads', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(85, 22, 'IMac', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(86, 22, 'MacBooks', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(87, 22, 'AirPods', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(88, 22, 'Apple Watch New Arrivals', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(89, 23, 'Laptops', '2025-05-14 12:38:58', '2025-05-14 12:38:58'),
	(90, 23, 'Desktops & Monitors', '2025-05-14 12:38:58', '2025-05-14 12:38:58'),
	(91, 23, 'Smart Boards & Kiosk', '2025-05-14 12:38:58', '2025-05-14 12:38:58'),
	(92, 23, 'Printers & IT Peripherals', '2025-05-14 12:38:58', '2025-05-14 12:38:58'),
	(93, 23, 'IT Accessories', '2025-05-14 12:38:58', '2025-05-14 12:38:58'),
	(94, 24, 'Blenders & Mixers', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(95, 24, 'Ovens', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(96, 24, 'Air Fryers', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(97, 24, 'Cookers', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(98, 24, 'Kitchen and Cookware', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(99, 24, 'Built-in Appliances & Ovens', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(100, 24, 'Small Appliances', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(101, 24, 'Kettles & Flasks', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(102, 24, 'Toasters & Grills', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(103, 24, 'Food Processors', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(104, 24, 'Dishwashers', '2025-05-14 12:52:49', '2025-05-14 12:52:49');

-- Dumping structure for table fairwaves.sub_subcategories
CREATE TABLE IF NOT EXISTS `sub_subcategories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subcategory_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_subcategories_subcategory_id_foreign` (`subcategory_id`),
  CONSTRAINT `sub_subcategories_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.sub_subcategories: ~0 rows (approximately)
INSERT IGNORE INTO `sub_subcategories` (`id`, `subcategory_id`, `name`, `created_at`, `updated_at`) VALUES
	(7, 66, 'Single Door', '2025-05-08 11:52:19', '2025-05-08 11:52:19'),
	(8, 66, 'Double Door', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(9, 66, 'Side by Side', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(10, 66, 'Bottom Freezer', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(11, 66, 'Mini Bars', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(12, 66, 'Freezers', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(13, 66, 'Bottle Coolers', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(14, 67, 'Top Loading', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(15, 67, 'Front Loading', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(16, 67, 'Washers & Dryers', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(17, 67, 'Semi Auto', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(18, 68, 'Heaters', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(19, 68, 'Geysers', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(20, 69, 'Ceiling Fans', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(21, 69, 'Pedestal Fans', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(22, 69, 'Wall Fans & Table Fans', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(23, 69, 'Industrial Fans', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(24, 69, 'Air Coolers', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(25, 69, 'Fan - New Arrivals', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(26, 70, 'Dry Irons', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(27, 70, 'Steam Irons', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(28, 71, 'Inverter AC', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(29, 71, 'Non-Inverter AC', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(30, 73, 'Generators', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(31, 73, 'Water Pumps', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(32, 73, 'Gardening Tools', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(33, 73, 'Power Tools', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(34, 73, 'Cleaning Durables', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(35, 73, 'DSI Plastic', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(36, 73, 'General Merchandising', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(37, 74, 'LED Bulb', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(38, 74, 'Medical Devices', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(39, 74, 'Torch', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(40, 74, 'Weighing Scale', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(41, 74, 'ECOCO Accessories', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(42, 74, 'Home Accessories', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(43, 77, 'Vacuum Cleaners', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(44, 77, 'Pressure Washers', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(45, 77, 'Robotic Cleaners', '2025-05-14 11:53:18', '2025-05-14 11:53:18'),
	(46, 78, 'Mobile Exclusive Deals', '2025-05-14 12:19:24', '2025-05-14 12:19:24'),
	(47, 78, 'Smart Mobile Phones', '2025-05-14 12:19:24', '2025-05-14 12:19:24'),
	(48, 78, 'Feature Phones', '2025-05-14 12:19:24', '2025-05-14 12:19:24'),
	(49, 80, 'Xiaomi Mibro Smart Watches', '2025-05-14 12:19:24', '2025-05-14 12:19:24'),
	(50, 83, 'iPhone 11', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(51, 83, 'iPhone 12', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(52, 83, 'iPhone 13', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(53, 83, 'iPhone 14', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(54, 83, 'iPhone 15', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(55, 83, 'iPhone 16', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(56, 84, 'iPad', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(57, 84, 'iPad Air', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(58, 84, 'iPad Pro', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(59, 84, 'iPad Mini', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(60, 86, 'MacBook Air', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(61, 86, 'MacBook Pro', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(62, 86, 'Mac Mini', '2025-05-14 12:32:35', '2025-05-14 12:32:35'),
	(63, 91, 'Smart Boards', '2025-05-14 12:38:58', '2025-05-14 12:38:58'),
	(64, 91, 'Signages & Kiosk', '2025-05-14 12:38:58', '2025-05-14 12:38:58'),
	(65, 94, 'Blenders & Grinders', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(66, 94, 'Mixers', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(67, 94, 'Juicers', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(68, 94, 'Coffee Machines', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(69, 94, 'Hand Blenders', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(70, 95, 'Microwave Ovens', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(71, 95, 'Electric Oven', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(72, 95, 'Cooking Ovens', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(73, 97, 'Pressure Cookers', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(74, 97, 'Rice Cookers', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(75, 97, 'Food Steamers', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(76, 97, 'Induction Cookers', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(77, 97, 'Hot Plates', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(78, 97, 'Gas Cookers', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(79, 97, 'Freestanding Cookers', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(80, 98, 'Coconut Scraper', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(81, 98, 'Kitchen Scale', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(82, 98, 'Gas Cylinders & Regulators', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(83, 98, 'Kitchen Accessories', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(84, 99, 'Hobs & Cookers With Safety', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(85, 99, 'Hobs', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(86, 99, 'Built-in Ovens', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(87, 99, 'Freestanding Cookers', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(88, 99, 'Cooker Hoods', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(89, 100, 'Saucepans New Arrivals', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(90, 100, 'Glassware & Mugs', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(91, 100, 'Food Storage & Accessories', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(92, 100, 'Saucepan', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(93, 100, 'Kitchen Utensils', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(94, 100, 'Home Accessories', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(95, 100, 'Storage Bins & Baskets', '2025-05-14 12:52:49', '2025-05-14 12:52:49'),
	(96, 100, 'Tea Sets & Dining Sets', '2025-05-14 12:52:49', '2025-05-14 12:52:49');

-- Dumping structure for table fairwaves.system_users
CREATE TABLE IF NOT EXISTS `system_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `system_users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.system_users: ~0 rows (approximately)
INSERT IGNORE INTO `system_users` (`id`, `name`, `email`, `contact`, `password`, `role`, `image`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin@example.com', NULL, '$2y$12$RBZax/KNjZjar6/t9MlCcO2F2PnHMU8k3bxW6XCO0yiNqxHDwEjWK', 'Admin', NULL, 'Active', '2025-05-30 06:56:47', '2025-05-30 06:56:48');

-- Dumping structure for table fairwaves.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `dob` date DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` blob,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.users: ~1 rows (approximately)
INSERT IGNORE INTO `users` (`id`, `name`, `email`, `address`, `dob`, `phone`, `gender`, `profile_image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Test User', 'test@example.com', NULL, NULL, NULL, NULL, NULL, '2025-05-27 00:52:49', '$2y$12$Yv65snnIpAydZEWiADSdpupoZqqBVmNNpM9.z4hveeUDxXIDwWQGW', 'm2kaDie52O', '2025-05-27 00:52:49', '2025-05-27 00:52:49'),
	(2, 'Admin', 'admin@example.com', 'admin@example.com', '2025-05-19', '0234234324', NULL, NULL, NULL, '$2y$12$RBZax/KNjZjar6/t9MlCcO2F2PnHMU8k3bxW6XCO0yiNqxHDwEjWK', NULL, '2025-05-30 01:26:05', '2025-05-30 01:26:05');

-- Dumping structure for table fairwaves.variations
CREATE TABLE IF NOT EXISTS `variations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hex_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `variations_product_id_foreign` (`product_id`),
  CONSTRAINT `variations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.variations: ~0 rows (approximately)
INSERT IGNORE INTO `variations` (`id`, `product_id`, `type`, `value`, `hex_value`, `quantity`, `created_at`, `updated_at`) VALUES
	(5, 'P-C884DB', 'size', 'xl', NULL, 10, '2025-05-30 02:09:28', '2025-05-30 02:09:28'),
	(6, 'P-26A698', 'color', NULL, '#bd5151', 10, '2025-05-30 02:09:56', '2025-05-30 02:09:56'),
	(7, 'P-26A698', 'size', 'xl', NULL, 20, '2025-05-30 02:09:56', '2025-05-30 02:09:56');

-- Dumping structure for table fairwaves.vendors
CREATE TABLE IF NOT EXISTS `vendors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vendors_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.vendors: ~0 rows (approximately)

-- Dumping structure for table fairwaves.vendor_payment_requests
CREATE TABLE IF NOT EXISTS `vendor_payment_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint unsigned NOT NULL,
  `request_amount` decimal(10,2) NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processing_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `paid_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `requested_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendor_payment_requests_vendor_id_foreign` (`vendor_id`),
  CONSTRAINT `vendor_payment_requests_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.vendor_payment_requests: ~0 rows (approximately)

-- Dumping structure for table fairwaves.vendor_wallets
CREATE TABLE IF NOT EXISTS `vendor_wallets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint unsigned NOT NULL,
  `balance` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_earnings` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendor_wallets_vendor_id_foreign` (`vendor_id`),
  CONSTRAINT `vendor_wallets_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.vendor_wallets: ~0 rows (approximately)

-- Dumping structure for table fairwaves.wishlists
CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  KEY `wishlists_product_id_foreign` (`product_id`),
  CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fairwaves.wishlists: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
