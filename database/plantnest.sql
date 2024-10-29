-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 29, 2024 at 04:46 AM
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
-- Database: `plantnest`
--

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
  `name` varchar(255) NOT NULL,
  `type` enum('plant','accessory') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Indoor Plants', 'plant', NULL, NULL),
(2, 'Outdoor Plants', 'plant', NULL, NULL),
(3, 'Flowering Plants', 'plant', NULL, NULL),
(5, 'Pruning and Trimming Tools', 'accessory', NULL, NULL),
(6, 'Grow Lights and Accessories', 'accessory', NULL, NULL),
(7, 'Garden Tools and Accessories', 'accessory', NULL, NULL),
(8, 'Plant Health and Pest Control', 'accessory', NULL, NULL),
(9, 'Bonsai Plants', 'plant', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `first_name`, `last_name`, `email`, `phone`, `street_address`, `city`, `state`, `country`, `postal_code`, `created_at`, `updated_at`) VALUES
(1, 3, 'Arham', 'Azeem', 'arhamazeem318@gmail.com', '+923182546510', '123 Street', 'Karachi', 'Sindh', 'Pakistan', '75000', '2024-09-13 14:17:59', '2024-09-13 14:17:59'),
(2, 2, 'Test', 'User', 'user@testmail.com', '+923182546510', '123 Street', 'Karachi', 'Sindh', 'Pakistan', '75000', '2024-09-14 06:55:17', '2024-09-14 06:55:17'),
(3, 4, 'Farrukh', 'Shahzad', 'fari@gmail.com', '+923182546510', '123 Street', 'Karachi', 'Sindh', 'Pakistan', '75000', '2024-09-14 09:19:55', '2024-09-14 09:19:55');

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
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
(4, 'Test User 2', 'testmail@hotmail.com', 'You Can\'t supply', '2024-09-11 20:21:31', '2024-09-11 20:21:31'),
(5, 'SAim', 'saim@test.com', 'HI', '2024-09-11 20:22:09', '2024-09-11 20:22:09'),
(6, 'ahmed', 'ahmed123@gmail.com', 'good website ui also very good made by ahmed', '2024-09-12 05:33:38', '2024-09-12 05:33:38'),
(7, 'Arham Azeem', 'arhamazeem@gmail.com', 'Hi This is my feedback', '2024-09-13 14:42:54', '2024-09-13 14:42:54');

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
(6, '0001_01_01_000000_create_users_table', 1),
(7, '0001_01_01_000001_create_cache_table', 1),
(8, '0001_01_01_000002_create_jobs_table', 1),
(9, '2024_08_24_130919_create_categories_table', 1),
(10, '2024_08_24_144640_create_products_table', 1),
(11, '2024_08_26_111050_create_feedback_table', 2),
(12, '2024_08_26_130613_create_customers_table', 3),
(13, '2024_08_26_130621_create_orders_table', 3),
(14, '2024_08_26_130638_create_order_items_table', 3),
(16, '2024_08_26_162148_create_review_table', 4),
(21, '2024_09_13_124207_create_review_table', 5),
(22, '2024_08_26_165006_create_customers_table', 6),
(24, '2024_09_13_130415_create_orders_table', 7),
(25, '2024_09_13_131335_create_order_items_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `delivery_status` varchar(255) NOT NULL,
  `payment_method` enum('cash on delivery','card payment') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `customer_id`, `user_id`, `amount`, `payment_status`, `delivery_status`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 'r05AImgfch', 1, 3, 11.00, 'unpaid', 'cancelled', 'cash on delivery', '2024-09-13 14:17:59', '2024-09-13 15:19:31'),
(2, 'tsmBUgxCb9', 2, 2, 60.00, 'paid', 'pending', 'card payment', '2024-09-14 06:55:17', '2024-09-14 06:55:17'),
(3, 'C5P8fMeNfP', 3, 4, 18.75, 'unpaid', 'pending', 'cash on delivery', '2024-09-14 09:19:55', '2024-09-14 09:34:32');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_name`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 'Spider Plant', 2, 11.00, '2024-09-13 14:17:59', '2024-09-13 14:17:59'),
(2, 2, 'Peace Lily', 10, 60.00, '2024-09-14 06:55:17', '2024-09-14 06:55:17'),
(3, 3, 'Marigold', 5, 18.75, '2024-09-14 09:19:55', '2024-09-14 09:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `species` varchar(255) DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `discount_percentage` decimal(5,2) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `species`, `price`, `discount_percentage`, `stock`, `category_id`, `description`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'Peace Lily', 'Spathiphyllum wallisii', 60.00, 15.00, 20, 1, 'Grow peace lily in a bright spot out of direct sunlight. Water regularly, keeping the compost moist but not wet. In spring and summer, feed fortnightly with a liquid house-plant food. Deadhead spent blooms and dust or wipe the leaves regularly to ensure they photosynthesise well.', 'products/M4Cfirx3JkUO1QJ9RsjFEF9JJd0lqieX5l2Ddplq.jpg', '2024-08-24 12:06:26', '2024-09-14 06:56:17'),
(4, 'Spider Plant', 'Chlorophytum comosum', 11.00, 9.97, 14, 1, 'Simple to grow and will tolerate a little neglect. Happy in both bright or low light indoors. Water regularly but don\'t let plants sit in soggy compost. Easy to make new plants from the plentiful \'spider babies\'. Repot every few years using peat-free multi-purpose compost.', 'products/YwlbgWNDCwvCL1lJd8ol833BFFOOYoMbGaXakR4O.jpg', '2024-08-24 12:47:22', '2024-09-13 14:17:59'),
(5, 'Hibiscus', 'Hibiscus syriacus', 55.00, 5.00, 9, 2, 'Hibiscus needs a warm position in full sun, preferably sheltered from strong and cold winds. It prefers a well-drained soil that remains moist during summer. Hibiscus are perfect for growing in large containers of John Innes No 3 compost in a warm and sunny position.', 'products/REz8RZGooybtCte9Y7v5KTDVl8YW9bW3rS7TsjJV.jpg', '2024-08-24 12:53:54', '2024-08-24 12:53:54'),
(6, 'Phalaenopsis orchid', 'Phalaenopsis amabilis', 79.90, 10.13, 17, 3, 'Never let the roots dry out completely and never let plants sit in water. Always let excess water drain away. Ideally use tepid water, preferably rainwater. When watering, take care not to splash the leaves or get water into the crown, although you can mist the plant lightly in summer to increase humidity.', 'products/7pei5U2cQXJlYSjm9aib06vwxtftPpmzje0y2GZh.jpg', '2024-08-24 12:58:20', '2024-08-24 12:58:20'),
(7, 'Marigold', 'Calendula officinalis', 18.75, 4.19, 13, 3, 'Caring for marigolds involves keeping soil moist, especially during prolonged dry periods, giving plants a thorough water once a week. Plants in containers will probably need watering every day or every other day during summer. To ensure reliable, long flowering they will need plenty of food.', 'products/GKWJ7Wv2jweNow33M2KadQqC5mG7vDYkqAnoND5r.jpg', '2024-08-24 13:04:27', '2024-09-14 09:19:55'),
(8, 'Chinese banyan', 'Ficus Microcarpa', 60.00, 10.00, 13, 9, 'A lot of light will help, but not direct sunlight during hotter hours. Indirect light is best. Microcarpa bonsai doesn\'t like being moved around, so once in a good spot, leave it there. Gusts of wind and drafts will lead to leaves falling off: keep it protected and out of corridors and hallways.', 'products/0cvXlEK5Wk3m15crgytuZoWedD3REWsFJfKGCSzN.jpg', '2024-08-24 13:12:36', '2024-08-24 13:12:36'),
(9, 'Japanese Maple Bonsai', 'Acer palmatum', 65.99, 7.77, 11, 9, 'This bonsai will require consistently moist soil at all times as maples do not tolerate drought. That being said, you must also keep it from being waterlogged or boggy to prevent root rot and inability to absorb nutrients from the soil.', 'products/H6TPxSjyo5Cfjyx0M0xidRJPfS0A9LrPSeP9pl4w.jpg', '2024-08-24 13:18:12', '2024-08-24 13:18:12'),
(10, 'Precision Pruning Shears', NULL, 19.99, 15.00, 32, 5, 'Ideal for precise trimming and pruning of small branches, flowers, and plants. The sharp, stainless-steel blades provide clean cuts, reducing plant stress and promoting healthy growth.', 'products/MKk9tdwiPyeJ7MN6JC3d6yo4oI9hOumaVWCAitEs.jpg', '2024-08-24 13:22:55', '2024-08-24 13:22:55'),
(11, 'Heavy-Duty Garden Lopper', NULL, 34.99, 27.00, 14, 5, 'Designed for cutting through thicker branches up to 2 inches in diameter, this lopper features a long handle for better leverage and non-slip grips for comfortable use.', 'products/SF6t0QEEpLjtjn3SqSkqQXyTEJmPl4pvrK6QVwCQ.jpg', '2024-08-24 13:27:58', '2024-08-24 13:27:58'),
(12, 'Full Spectrum LED Grow Light', NULL, 89.99, 3.97, 21, 6, 'Provides plants with the full spectrum of light needed for photosynthesis, ideal for indoor gardening or supplementing natural light. Suitable for all growth stages, from seedlings to flowering.', 'products/CQsRbvEi9Vzv1aUJkk5key5FoSkeMRdg20IDyJ5F.jpg', '2024-08-24 13:31:47', '2024-08-24 13:31:47'),
(13, 'Adjustable Grow Light Stand', NULL, 49.99, 6.47, 19, 6, 'A versatile stand that can be adjusted to different heights, perfect for supporting grow lights over plants. Allows for optimal light positioning to ensure even coverage and healthy growth.', 'products/q0Cy3vmW2sADmELb6cGpsgKZLSsGPtUBlv6pbiXS.jpg', '2024-08-24 13:34:03', '2024-08-24 13:34:03'),
(14, 'Organic Neem Oil Spray', NULL, 14.99, 3.68, 17, 8, 'A natural pest control solution effective against a wide range of insects and mites. Safe to use on vegetables, fruits, flowers, and houseplants without harming beneficial insects.', 'products/iXJpAtLkD2BRbbj1E3c3FKXozOi2V2BlNtKz6E9w.jpg', '2024-08-24 13:35:41', '2024-08-24 13:35:41'),
(15, 'Fungicide Powder for Plants', NULL, 9.99, 2.13, 53, 8, 'A powerful fungicide that helps prevent and treat fungal infections such as powdery mildew, black spot, and rust on various plants. Suitable for roses, vegetables, and ornamental plants.', 'products/kXwVWADbbUGLlBXky6X8Gt7Cspm6XrD10rgbPwe7.jpg', '2024-08-24 13:37:21', '2024-08-24 13:37:21'),
(16, '5-Piece Garden Tool Set', NULL, 29.99, 16.52, 18, 7, 'Includes a trowel, transplanter, weeder, hand rake, and pruner. Made with durable stainless steel and ergonomic handles for comfortable use in all gardening tasks, from planting to weeding.', 'products/Rq6ivt5xOYA1L2rcdlFRqaBWAWR2X1K1J77lgEJg.jpg', '2024-08-24 13:39:04', '2024-08-24 13:39:04'),
(17, 'Heavy-Duty Garden Hose with Nozzle', NULL, 39.99, 14.15, 19, 7, 'A 50-foot, kink-resistant garden hose made from durable, reinforced materials, designed for high-pressure water flow. Comes with an adjustable spray nozzle that offers multiple spray patterns, perfect for watering plants, cleaning tools, and general garden maintenance.', 'products/DYY5sgjgYr1amqZhTIGmeGwUwnxNdR1rCtwVkxU8.jpg', '2024-08-24 13:42:01', '2024-08-24 13:42:01');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `review` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `rating`, `review`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 3, 'Very Nice Product', '2024-09-13 13:21:05', '2024-09-13 13:21:05'),
(2, 5, 1, 4, 'Just testing', '2024-09-13 15:12:36', '2024-09-13 15:12:36');

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
('TpVAOAQeiKVwFVK8COTK0GSkWRfOKFBldSBRJH8z', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUjgxNGV6ZTI0cng1UzVRb2JOQWcwNkZmVHNQVmJyMmp5RDFjYXpVdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zaG9wL0luZG9vciUyMFBsYW50cy9wbGFudC9QZWFjZSUyMExpbHkiO319', 1726325021);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Arham Azeem', 'arhamazeem318@gmail.com', 1, NULL, '$2y$12$WeRiaw.qmbc5BPgwOruuIexqcXZQGSlvmeKpNP8fHYQmHTx.o.xaa', NULL, '2024-08-24 11:44:06', '2024-09-14 09:22:27'),
(2, 'TestUser', 'user@testmail.com', 0, NULL, '$2y$12$db4RALDnKGYaNDPzrrWkR.ar1Ot6gEc4Ea1nhie4Ytd06mRiA21Mi', NULL, '2024-08-25 14:50:17', '2024-08-25 14:50:17'),
(3, 'Saim Azeem', 'saimazeem@gmail.com', 0, NULL, '$2y$12$BP/jA4vSVsIhkoCyMrF8QOrLjAsTTNzfVUoZmWGjjzlr1zZA8OGe6', NULL, '2024-09-13 13:20:32', '2024-09-13 13:20:32'),
(4, 'FarrukhShahzad', 'fari@gmail.com', 0, NULL, '$2y$12$PLiE1hz8tkV8UbETzwmWZebIWcitiCJ4h6e95Y/QqeYZ3DCDV4V.W', NULL, '2024-09-14 09:17:34', '2024-09-14 09:17:34');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

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
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
