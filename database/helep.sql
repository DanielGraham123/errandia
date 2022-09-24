-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2021 at 09:53 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helep`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyer_custom_order_requests`
--

CREATE TABLE `buyer_custom_order_requests` (
  `id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buyer_order_requests`
--

CREATE TABLE `buyer_order_requests` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `order_type` tinyint(4) NOT NULL DEFAULT 1,
  `unit_price` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cameroon', '1', '2021-02-26 19:31:45', '2021-02-26 19:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'XAF', '2021-03-09 23:08:39', '2021-03-09 23:08:39'),
(2, 'USD', '2021-03-09 23:08:59', '2021-03-09 23:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_12_07_200034_create_countries_table', 1),
(2, '2020_12_07_200057_create_regions_table', 1),
(3, '2020_12_07_200108_create_towns_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `slug` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `featured_image_path` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `summary`, `unit_price`, `discount`, `quantity`, `slug`, `status`, `featured_image_path`, `sub_category_id`, `currency_id`, `created_at`, `updated_at`, `shop_id`) VALUES
(1, 'Iphone 7s Plus USA', 'Top quality Iphone 7s Plus with good battery and strong wifi strength', 'Test Sumarry', 500000, 0, 2, 'oV0erxdzAiTMf4b1615375811kbFxv', 1, 'products/nZmI50Cn1du5ksz1618244095KaoxS_1618244095.png', 4, 1, '2021-03-10 11:30:11', '2021-04-12 16:14:56', 10),
(8, 'Blender with power socket', 'eleleh an tcudorp siht yas u llet i .yad emosewa eb ot gniog etirojam meunrepac rolod tis muspi merol noitoircsed tcudorP eleleh an tcudorp siht yas u llet i .yad emosewitpircsed tcudor', 'Test Summary for blender product', 2500, 0, 2, 'DTAgkCiWG1laL2Q1615741977MNdHLjj56', 1, 'products/bdhDJaeMH9TB4pb16182445664QIed_1618244566.png', 3, 1, '2021-03-14 17:12:57', '2021-04-12 16:22:46', 10);
INSERT INTO `products` (`id`, `name`, `description`, `summary`, `unit_price`, `discount`, `quantity`, `slug`, `status`, `featured_image_path`, `sub_category_id`, `currency_id`, `created_at`, `updated_at`, `shop_id`) VALUES
(9, 'Samsung Galaxy A02 - 3/64GB Memory, Triple Rear Camera, Dual SIM, 5,000Mah Battery', '<b style=\"color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">A lot less bezel, a lot more view</b><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">Expand your view to the 6.5-inch Infinity-V Display of Galaxy A02 and see how less screen delivers more view. Thanks to HD+ technology, your everyday content looks its best—sharp, crisp and clear.</p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"><br></p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"><b>Looks as good as it feels&nbsp;</b></p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">Galaxy A02 combines streamlined design aesthetics with classic colors. Refined curves make it comfortable to hold and provides easy screen navigation. A modern matte finish adds a gentle, shine-free surface texture and comes in Black, Red and Blue</p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"></p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"><b>Multiple ways to capture your world with Dual Camera</b></p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">Snap memorable moments in clear detail with the 13MP Main Camera. Customize focus with Depth Camera, or get closer to the details with Macro Camera.</p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"></p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">Macro Camera pays attention to the tiny details</p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">Get in close with the 2MP Macro Camera and discover details you may have missed otherwise. It applies natural Bokeh effect to your pictures, allowing your subject to stand out from the background.</p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"></p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">Bring the focus to the front with Depth Camera</p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">The 2MP Depth Camera lets you adjust the depth of field in your photos. With a simple touch, you can easily fine-tune the background blur behind your subject for high-quality portrait shots that truly stand out.</p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"></p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">Front Camera, share-worthy selfies</p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">With the Galaxy A02 5MP Front Camera and Live Focus, it\'s easy to snap stunning selfies that feature more you and less background.</p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"></p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"><b>Power that keeps you going</b></p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">Stay ahead of the day with a battery that won\'t slow you down. The 5,000mAh (typical) battery lets you keep doing what you do, for hours on end,&nbsp;</p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"></p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"><b>Give yourself more room to play</b></p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">Galaxy A02 combines Octa-core processing power with up to 3GB of RAM for fast and efficient performance for the task at hand. Enjoy 64GB of internal storage or add even more space with up to 1TB MicroSD card.</p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"></p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"><b>Made to focus with One UI Core</b></p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">One UI Core helps you focus on what matters to you. Hardware and software work together, with content and features at your fingertips so you can get to them faster. Use Dark Mode for a comfortable experience in the dark, and with clear and intuitive visuals using your phone is like second nature.</p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"><br></p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">An awesome Android™ experience, always</p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">Get the latest Google apps on Android OS, fully supported on your Galaxy A02.</p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"><br></p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"><img src=\"data:image/jpeg;base64,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\" data-filename=\"Nansana.jpg\" style=\"width: 595px;\"><br></p><p style=\"padding: 8px 0px; margin-right: 0px; margin-bottom: 0.0001pt; margin-left: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"><br></p>', 'More than i could image A lot less bezel, a lot more view\r\nExpand your view to the 6.5-inch Infinity-V Display of Galaxy A02 and see how less screen delivers more view. Thanks to HD+ technology, your everyday content looks its best—sharp, crisp and clear.', 3000, 0, 10, '05nS58Tdl4z6WGg1616084876aqTzz', 1, 'products/7ENPEyw8qhrU90m1616350367HkVF0_1616350367.png', 3, 1, '2021-03-18 16:27:57', '2021-03-21 18:12:47', 10);
INSERT INTO `products` (`id`, `name`, `description`, `summary`, `unit_price`, `discount`, `quantity`, `slug`, `status`, `featured_image_path`, `sub_category_id`, `currency_id`, `created_at`, `updated_at`, `shop_id`) VALUES
(10, 'FX Men’s Cotton Polo T-shirt | Short Sleeves Men’s Casual Wear | DopeStyle', '<div class=\"electro-description clearfix\" style=\"margin-bottom: 8.571em; color: rgb(66, 67, 68); font-family: Roboto, -apple-system, system-ui, &quot;Segoe UI&quot;, &quot;Helvetica Neue&quot;, Arial, sans-serif; font-size: 14px;\"><div id=\"descp\" class=\"mt5 fs16 color\"><table style=\"border-spacing: 0px; background-color: transparent; width: 1072px; max-width: 100%;\"><tbody style=\"margin-bottom: 0px;\"><tr><td class=\"tdwdt\" style=\"padding: 0.75rem; font-size: 0.9rem; line-height: 1.5; vertical-align: top; border-top: 1px solid rgb(236, 238, 239);\">Size</td><td class=\"tdwdt1 color6\" style=\"padding: 0.75rem; font-size: 0.9rem; line-height: 1.5; vertical-align: top; border-top: 1px solid rgb(236, 238, 239); margin-bottom: 0px;\">S,M,L,XL</td></tr><tr><td class=\"tdwdt\" style=\"padding: 0.75rem; font-size: 0.9rem; line-height: 1.5; vertical-align: top; border-top: 1px solid rgb(236, 238, 239);\">Sleeve Type</td><td class=\"tdwdt1 color6\" style=\"padding: 0.75rem; font-size: 0.9rem; line-height: 1.5; vertical-align: top; border-top: 1px solid rgb(236, 238, 239); margin-bottom: 0px;\">Half Sleeve</td></tr><tr><td class=\"tdwdt\" style=\"padding: 0.75rem; font-size: 0.9rem; line-height: 1.5; vertical-align: top; border-top: 1px solid rgb(236, 238, 239);\">Fabric</td><td class=\"tdwdt1 color6\" style=\"padding: 0.75rem; font-size: 0.9rem; line-height: 1.5; vertical-align: top; border-top: 1px solid rgb(236, 238, 239); margin-bottom: 0px;\">Cotton</td></tr><tr><td class=\"tdwdt\" style=\"padding: 0.75rem; font-size: 0.9rem; line-height: 1.5; vertical-align: top; border-top: 1px solid rgb(236, 238, 239);\">Neck Type</td><td class=\"tdwdt1 color6\" style=\"padding: 0.75rem; font-size: 0.9rem; line-height: 1.5; vertical-align: top; border-top: 1px solid rgb(236, 238, 239); margin-bottom: 0px;\">Polo Neck</td></tr><tr><td class=\"tdwdt\" style=\"padding: 0.75rem; font-size: 0.9rem; line-height: 1.5; vertical-align: top; border-top: 1px solid rgb(236, 238, 239);\">Wear Type</td><td class=\"tdwdt1 color6\" style=\"padding: 0.75rem; font-size: 0.9rem; line-height: 1.5; vertical-align: top; border-top: 1px solid rgb(236, 238, 239); margin-bottom: 0px;\">Casual Wear</td></tr><tr style=\"margin-bottom: 0px;\"><td class=\"tdwdt\" style=\"padding: 0.75rem; font-size: 0.9rem; line-height: 1.5; vertical-align: top; border-top: 1px solid rgb(236, 238, 239);\">Wash Care</td><td class=\"tdwdt1 color6\" style=\"padding: 0.75rem; font-size: 0.9rem; line-height: 1.5; vertical-align: top; border-top: 1px solid rgb(236, 238, 239); margin-bottom: 0px;\">Handwash</td></tr></tbody></table></div><div id=\"firstL\" class=\"fs13 clink pdinb mt10 vcd pcp\"></div><div style=\"margin-bottom: 0px;\">Polo t-shirts are quite popular for their stylish look and comfort and have recently become common fashion attire for men. Here at&nbsp;<a href=\"http://www.aleigro.com/\" style=\"color: rgb(2, 117, 216); cursor: pointer; transition-duration: 0.2s; transition-timing-function: ease-in-out; touch-action: manipulation;\">Aleigro.com</a>, you can browse a wide variety of&nbsp;<a href=\"https://www.aleigro.com/item-category/mens-fashion/genaral-mens-fashion/t-shirts-genaral-mens-fashion/?v=707354872d4e\" target=\"_blank\" rel=\"noopener\" style=\"color: rgb(2, 117, 216); cursor: pointer; transition-duration: 0.2s; transition-timing-function: ease-in-out; touch-action: manipulation; margin-bottom: 0px;\">Men”s Polos</a>&nbsp;for casual day outs and outdoor activities. You can choose from a vast range of half to full sleeves as well as sleeveless polos that meet your needs. If you are looking for something simple, explore our extensive range of solid polos in classic and bright colors. On the other hand, bright striped polos offer attention-catching look and they come in attractive color combinations to choose from. For those who want to stand out from the crowd, unique polos like colorblock and printed make the right choice. If you would like to adopt a sporty style, you can check out the collection of self colored polos with contrasting plackets that add a unique touch to the look. Men”s Polos at DHgate are available in a variety of sizes and materials to choose from. Whether you choose long sleeved casual polo in solid colors or a printed polo like camouflage, you will surely catch a lot of attention wherever you go. You can opt for cotton polos to beat the heat and stay cool in summer without having to compromise on fashion. You can also find polos in other fabrics like polyester and cotton blend. These are available in bright colors and are designed to be long lasting and comfortable. Polos from our sellers are made to fit perfectly as per the size selected and come in many size options. They come from high quality manufacturers and available at cheap prices. Elevate your style while staying cool and comfortable by shopping for Men”s Polos at Aleigro.com at affordable prices!</div></div><div class=\"product_meta\" style=\"margin-bottom: 0px; color: rgb(66, 67, 68); font-family: Roboto, -apple-system, system-ui, &quot;Segoe UI&quot;, &quot;Helvetica Neue&quot;, Arial, sans-serif; font-size: 14px;\"><span class=\"sku_wrapper\" style=\"font-weight: 700; color: rgb(104, 108, 111);\">SKU:&nbsp;<span class=\"sku\" style=\"margin-bottom: 0px;\">fx-mens-cotton-polo-t-shirt-short-sleeves-mens-casual-wear-dopestyle</span></span>&nbsp;<span class=\"posted_in\" style=\"font-weight: 700; color: rgb(104, 108, 111);\">Categories:&nbsp;<a href=\"https://www.aleigro.com/item-category/mens-fashion/genaral-mens-fashion/?v=707354872d4e\" rel=\"tag\" style=\"color: rgb(2, 117, 216); cursor: pointer; transition-duration: 0.2s; transition-timing-function: ease-in-out; touch-action: manipulation; font-weight: 400;\">Genaral Men\'s Fashion</a>,&nbsp;<a href=\"https://www.aleigro.com/item-category/mens-fashion/general-mens-wear/?v=707354872d4e\" rel=\"tag\" style=\"color: rgb(2, 117, 216); cursor: pointer; transition-duration: 0.2s; transition-timing-function: ease-in-out; touch-action: manipulation; font-weight: 400;\">Gen</a></span></div>', 'This is a test summary for all products', 5000, 0, 10, '6SbaSnqfP3Tz2hp1616431608uqMXm', 1, 'products/OL3AIDIkXq2hKz516164316085IUvc_1616431608.png', 3, 1, '2021-03-22 16:46:48', '2021-03-22 16:46:48', 10),
(11, 'Color Screen Smart Bracelet D13 Waterproof Bracelet', '\"If you think ourproducts are useful, please introduceyour friends to buy them\r\nYour 5-StarPositive Feedback is much appreciated!\r\nWelcome to Shopping Here!\"\r\nHow to Charge Remove the bands off the tracker host and you can see the built-in USB plug with metal pins, insert the USB plug into a USB charger(such as phone charger) for charging, no charging cable needed', 'Test Summary', 1000, 0, 10, '1tYRUsX1kwKmLpW161824424515yEL', 1, 'products/yTYvKQkpUsubsUB1618244245MKBvu_1618244245.png', 3, 1, '2021-04-12 16:17:25', '2021-04-12 16:17:25', 10),
(12, 'Samsung Galaxy S9', '&nbsp; Test Summary for Galaxy S9 product&nbsp;&nbsp; Test Summary for Galaxy S9 product&nbsp;&nbsp; Test Summary for Galaxy S9 product&nbsp;&nbsp; Test Summary for Galaxy S9 product&nbsp; Test Summary for Galaxy S9 product&nbsp;&nbsp; Test Summary for Galaxy S9 product', 'Test Summary for Galaxy S9 product', 20000, 0, 2, 'uTB51Yj0h9wNMIN1618244680PDPKi', 1, 'products/VHHo4jg5RcTZ9ra1618244680HVIM0_1618244680.png', 3, 1, '2021-04-12 16:24:40', '2021-04-12 16:24:40', 10),
(13, 'Samsung Galaxy A12(A125F/DS)- 6.5\" 48MP Camera, 4/64GB Memory, 5000maH Battery, Fingerprint, 4G LTE - BLACK', '<p><section class=\"-phs -pts -fs14\"><h2 class=\"-fs14 -m -upp -pvs -hr\">Promotions</h2><div class=\"-pvxs -hr _bet\"><a href=\"https://5y2z.adj.st?adjust_t=h8a8ubz_s9cmzb7&amp;adjust_adgroup=pdp-promotion&amp;adjust_deeplink=jumiaoneapp%3A%2F%2Fservices%2FAirtime\" class=\"-pvxs -df -i-ctr _more\"><svg viewBox=\"0 0 24 24\" class=\"ic -me-base -fsh0 -mrs\" width=\"24\" height=\"24\"><use xlink:href=\"https://www.jumia.com.ng/assets_he/images/i-global.14ce43dd.svg#jumia-pay\"></use></svg>Borrow loans up to N100,000 to make everyday life easier. No collateral, no paperwork via JumiaPay financial partners.</a><a href=\"https://www.jumia.com.ng/jumia-prime/\" class=\"-pvxs -df -i-ctr _more\"><svg viewBox=\"0 0 24 24\" class=\"ic -me-base -fsh0 -mrs\" width=\"24\" height=\"24\"><use xlink:href=\"https://www.jumia.com.ng/assets_he/images/i-global.14ce43dd.svg#jumia-star\"></use></svg>Jumia Prime : Enjoy Unlimited Free Delivery on Jumia Express Items.</a><a href=\"https://www.jumia.com.ng/sp-pickup-stations-app/\" class=\"-pvxs -df -i-ctr _more\"><svg viewBox=\"0 0 24 24\" class=\"ic -me-base -fsh0 -mrs\" width=\"24\" height=\"24\"><use xlink:href=\"https://www.jumia.com.ng/assets_he/images/i-global.14ce43dd.svg#jumia-star\"></use></svg>Enjoy cheaper shipping fees when you select a PickUp Station at checkout</a></div></section>                                </p>', 'Display - 6.5inch Infinity-O Display\r\n    Camera - Rear  (48MP / 8MP / 2MP/2MP) Front - 13MP\r\n    Memory - 4GB - 64GB, expandable \r\n    Battery - 5,000mAh 15W Fast charging\r\n    Processor - Octa 2.0 GHz\r\n    OS - Android', 10000, 0, 5, 'SFd4STtdHLmrHCD1618936985UY1TB', 1, 'products/nNO8SF6jdbFngDW1618936985ycpte_1618936985.png', 8, 1, '2021-04-20 16:43:07', '2021-04-20 16:43:07', 11);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(65) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `description`, `image_path`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Men\'s Shoes & Shirts', 'Elegant Top quality men shoes, classic and branded shoes and shirts', 'category/XPklyyDOPwCodbne8Lzxr8yaPq7GI5WS2oP2q31C.png', '2MhaB9YgFszAwBH1614028751mH3Ir', 1, '2021-02-22 21:19:11', '2021-02-25 21:04:57'),
(5, 'Female Fashion', 'Get the best female sexy fashion items: shoes, cloths, pants', 'category/v50fWVzXwrKLQCxh5YHDWE74lbF2W5jbG9cWUAOK.png', 'V8QNDf6AliA0A5X1614028815XanTW', 1, '2021-02-22 21:20:15', '2021-02-22 21:20:15'),
(6, 'Smart Phones & Accessories', 'Branded smart phones, accessories, tablets and gadgets', 'category/Gh1udMUZjjeA8KRMXMVt6G3fs9jOGtMs6cfwo7u3.png', 'LIMWUak39VI1Dmb1614028884oDDLM', 1, '2021-02-22 21:21:24', '2021-02-25 21:06:00'),
(7, 'Men\'s Fashion', 'Elegant Top quality men shoes, classic and branded shoes and shirts', 'category/XPklyyDOPwCodbne8Lzxr8yaPq7GI5WS2oP2q31C.png', '2MhaB9YgFszAwBH1614028751mH3Ir', 1, '2021-02-22 21:19:11', '2021-02-25 21:04:57'),
(8, 'Phone Mania', 'Elegant Top quality men shoes, classic and branded shoes and shirts', 'category/XPklyyDOPwCodbne8Lzxr8yaPq7GI5WS2oP2q31C.png', '2MhaB9YgFszAwBH1614028751mH3Ir', 1, '2021-02-22 21:19:11', '2021-02-25 21:04:57'),
(9, 'Electronics', 'Elegant Top quality men shoes, classic and branded shoes and shirts', 'category/XPklyyDOPwCodbne8Lzxr8yaPq7GI5WS2oP2q31C.png', '2MhaB9YgFszAwBH1614028751mH3Ir', 1, '2021-02-22 21:19:11', '2021-02-25 21:04:57'),
(10, 'Baby Producuts', 'Elegant Top quality men shoes, classic and branded shoes and shirts', 'category/XPklyyDOPwCodbne8Lzxr8yaPq7GI5WS2oP2q31C.png', '2MhaB9YgFszAwBH1614028751mH3Ir', 1, '2021-02-22 21:19:11', '2021-02-25 21:04:57'),
(11, 'Home & Office', 'Elegant Top quality men shoes, classic and branded shoes and shirts', 'category/XPklyyDOPwCodbne8Lzxr8yaPq7GI5WS2oP2q31C.png', '2MhaB9YgFszAwBH1614028751mH3Ir', 1, '2021-02-22 21:19:11', '2021-02-25 21:04:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'products/cJ2jOLxXA1XfcBzLHVXIPob6ibCyRbm9QfKIMQSZ.png', '2021-03-10 11:30:11', '2021-03-10 11:30:11'),
(2, 1, 'products/OK7cxwVELob8youEanD7lkAi8R4ylBuOddOWfhxd.png', '2021-03-10 11:30:11', '2021-03-10 11:30:11'),
(11, 9, 'products/GrAP7yfX0dQgLwV1616426356mycYD_1616426356.png', '2021-03-18 16:27:57', '2021-03-22 15:19:16'),
(12, 9, 'products/bGBWBq5P4QyVeAi1616351112GtxTO_1616351112.png', '2021-03-18 16:27:57', '2021-03-21 18:25:12'),
(13, 9, 'products/N09r0xLWkybLmlT1616426355J0WKg_1616426355.png', '2021-03-18 16:27:57', '2021-03-22 15:19:15'),
(14, 10, 'products/MowuKwPNDupWD9j1616431608Mk7yo_1616431608.png', '2021-03-22 16:46:48', '2021-03-22 16:46:48'),
(15, 10, 'products/AAlhnU2Gb2i2PBb1616431608xT6At_1616431608.png', '2021-03-22 16:46:48', '2021-03-22 16:46:48'),
(16, 11, 'products/pebL8DqUPkCjV671618244245qU9eT_1618244245.png', '2021-04-12 16:17:25', '2021-04-12 16:17:25'),
(17, 11, 'products/Dz0gzIKA7ESV58n1618244245Jtb6D_1618244245.png', '2021-04-12 16:17:25', '2021-04-12 16:17:25'),
(18, 12, 'products/fhjWpl9uWqAFo861618244680Vxpw7_1618244680.png', '2021-04-12 16:24:40', '2021-04-12 16:24:40'),
(19, 12, 'products/9t6t3XMnIrY7jdY1618244680RlxWp_1618244680.png', '2021-04-12 16:24:41', '2021-04-12 16:24:41'),
(20, 13, 'products/iBIyRRUSut50WXg1618936987Jo63E_1618936987.png', '2021-04-20 16:43:07', '2021-04-20 16:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(11) NOT NULL,
  `rating` varchar(65) COLLATE utf8mb4_unicode_ci NOT NULL,
  `review` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_sub_categories`
--

CREATE TABLE `product_sub_categories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(65) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sub_categories`
--

INSERT INTO `product_sub_categories` (`id`, `category_id`, `name`, `description`, `image_path`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(3, 6, 'Iphone Phones', 'Top branded iphone phones from US, clean', 'category/sub/dec1zLFKkJe8sxX8dWDi2pZxAoaZFgOpNgt7BJMn.png', 'gJW2Z0cMX30ByAW16143293933iyV3', 1, '2021-02-26 08:49:53', '2021-02-26 08:49:53'),
(4, 6, 'Phone accessories & Battery', 'Top Clean, class phone accessories for different brands', 'category/sub/KLOz04BxmnuYENfXtqnHVTcQ9S9vs8ZeuN5h9kHi.png', '9ny6bDlhxpR0hh21614329468Ykv0t', 1, '2021-02-26 08:51:08', '2021-02-26 10:32:47'),
(5, 6, 'Android Tablets', 'Top Clean, class phone accessories for different brands', 'category/sub/KLOz04BxmnuYENfXtqnHVTcQ9S9vs8ZeuN5h9kHi.png', '9ny6bDlhxpR0hh21614329468Ykv0t', 1, '2021-02-26 08:51:08', '2021-02-26 10:32:47'),
(6, 6, 'Battery Chargers', 'Top Clean, class phone accessories for different brands', 'category/sub/KLOz04BxmnuYENfXtqnHVTcQ9S9vs8ZeuN5h9kHi.png', '9ny6bDlhxpR0hh21614329468Ykv0t', 1, '2021-02-26 08:51:08', '2021-02-26 10:32:47'),
(7, 6, 'Smart Tv', 'Top Clean, class phone accessories for different brands', 'category/sub/KLOz04BxmnuYENfXtqnHVTcQ9S9vs8ZeuN5h9kHi.png', '9ny6bDlhxpR0hh21614329468Ykv0t', 1, '2021-02-26 08:51:08', '2021-02-26 10:32:47'),
(8, 7, 'Jewelry', 'Top Clean, class phone accessories for different brands', 'category/sub/KLOz04BxmnuYENfXtqnHVTcQ9S9vs8ZeuN5h9kHi.png', '9ny6bDlhxpR0hh21614329468Ykv0t', 1, '2021-02-26 08:51:08', '2021-02-26 10:32:47'),
(9, 7, 'Maternity', 'Top Clean, class phone accessories for different brands', 'category/sub/KLOz04BxmnuYENfXtqnHVTcQ9S9vs8ZeuN5h9kHi.png', '9ny6bDlhxpR0hh21614329468Ykv0t', 1, '2021-02-26 08:51:08', '2021-02-26 10:32:47');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `status`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'Adamawa -AD', '1', 1, '2021-02-26 19:38:29', '2021-02-26 19:38:29'),
(2, 'Centre -CE', '1', 1, '2021-02-26 19:38:52', '2021-02-26 19:38:52'),
(3, 'East -EST', '1', 1, '2021-02-26 19:39:18', '2021-02-26 19:39:18'),
(4, 'Far North -FN', '1', 1, '2021-02-26 19:39:38', '2021-02-26 19:39:38'),
(5, 'Littoral -LT', '1', 1, '2021-02-26 19:40:00', '2021-02-26 19:40:00'),
(6, 'North -NO', '1', 1, '2021-02-26 19:40:20', '2021-02-26 19:40:20'),
(7, 'North-West -NW', '1', 1, '2021-02-26 19:40:47', '2021-02-26 19:40:47'),
(8, 'South-West -SW', '1', 1, '2021-02-26 19:41:04', '2021-02-26 19:41:04'),
(9, 'South -SO', '1', 1, '2021-02-26 19:41:22', '2021-02-26 19:41:22'),
(10, 'West -WE', '1', 1, '2021-02-26 19:41:40', '2021-02-26 19:41:40');

-- --------------------------------------------------------

--
-- Table structure for table `return_policies`
--

CREATE TABLE `return_policies` (
  `id` int(11) NOT NULL,
  `return policy` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_policy` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `name`, `description`, `category_id`, `user_id`, `slug`, `image_path`, `status`, `created_at`, `updated_at`) VALUES
(10, 'Dengun Fashion', 'Lorem ipsum dolor sit amet, consectetur alter adipisicing elit. Facilis, natuse inse voluptates officia repudiandae beatae magni es magnam autem molestia', 4, 13, 'e0rw2wPcYCNI8Iv1614377620jfP9s', 'shops/HdR3S26puGq9qtr1616437088RmKsV_1616437088.png', 0, '2021-02-26 22:13:40', '2021-03-22 18:18:08'),
(11, 'HallMark Restaurant', 'Top quality restaurant with class, unique and classic environment', 6, 14, 'BcS2OTicMIzjNhy1616440800XT5az', 'shops/Ewg63u0g40rSE311616440800FUWu6_1616440800.png', 0, '2021-03-22 19:20:00', '2021-03-22 19:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `shop_business_page_slider`
--

CREATE TABLE `shop_business_page_slider` (
  `id` int(11) NOT NULL,
  `shop_business_profile_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_business_profile`
--

CREATE TABLE `shop_business_profile` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_color` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slogan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_contact_info`
--

CREATE TABLE `shop_contact_info` (
  `id` int(11) NOT NULL,
  `town_id` int(11) NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `instagram_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `website_link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop_contact_info`
--

INSERT INTO `shop_contact_info` (`id`, `town_id`, `address`, `tel`, `facebook_link`, `instagram_link`, `website_link`, `created_at`, `updated_at`, `shop_id`) VALUES
(1, 1, 'Mlaingo-Street, Buea, Fako', '681950128', 'https://facebook.com/dengun', 'https://instagram.com/dengun', 'https://go-groups.net', '2021-02-26 22:13:40', '2021-04-19 13:18:57', 10),
(2, 1, 'Malingo, Stree', '672070746', '', '', 'https://go-net.com', '2021-03-22 19:20:00', '2021-03-22 19:20:00', 11);

-- --------------------------------------------------------

--
-- Table structure for table `shop_registration_info`
--

CREATE TABLE `shop_registration_info` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `registration_numbers` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_date` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_payer_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_payer_doc_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `years_of_existence` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_subscribers`
--

CREATE TABLE `shop_subscribers` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_subscriptions`
--

CREATE TABLE `shop_subscriptions` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(10) NOT NULL,
  `duration` int(10) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `towns`
--

CREATE TABLE `towns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` bigint(20) UNSIGNED NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `towns`
--

INSERT INTO `towns` (`id`, `name`, `status`, `region_id`, `created_at`, `updated_at`) VALUES
(1, 'Buea', 1, 8, '2021-02-26 19:45:09', '2021-02-26 19:45:09'),
(2, 'Limbe', 1, 8, '2021-02-26 19:45:20', '2021-02-26 19:45:20'),
(3, 'Kumba', 1, 8, '2021-02-26 19:45:30', '2021-02-26 19:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `tel` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 for shop vendor, 1 for customer user and 10 for admin user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `status`, `tel`, `created_at`, `updated_at`, `user_type`) VALUES
(13, 'Dieudonne Modus', 'go-guru@outlook.com', '$2y$10$vAxjKKZFTt8Ez9A8iTpakeMKeAL6Cc0oEyccr/VWo8SsTbi7SIi7u', 1, 672070745, '2021-02-26 22:13:40', '2021-04-19 13:25:34', 0),
(14, 'Modus Ponens', 'modus@gmail.com', '$2y$10$Pk0mq0XaNzP66i1AMvwd.eiX225s4zWQdaheV3NVnqzPxRdYqUklC', 1, 672070746, '2021-03-22 19:20:00', '2021-04-18 17:22:01', 0),
(15, 'Test User', 'test@test.com', '$2y$10$7swwQRXRJZm1KUrpEVkUxOrnlkOCWK4jmlld/kjySOBIY/PaVlMLC', 1, 677777770, '2021-04-15 20:25:23', '2021-04-15 20:25:23', 0),
(16, 'Modus Admin', 'moduskanas@gmail.com', '$2y$10$z2YIOxVrc/8ZeV0J0863f.6dfIXrn/13QIDQvQmhELSwjojtZCPXi', 1, 673093490, '2021-04-15 20:34:00', '2021-04-20 22:30:15', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyer_custom_order_requests`
--
ALTER TABLE `buyer_custom_order_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `buyer_order_requests`
--
ALTER TABLE `buyer_order_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`buyer_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_category_id` (`sub_category_id`),
  ADD KEY `shop_id` (`shop_id`),
  ADD KEY `currency_id` (`currency_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `buyer_id` (`buyer_id`);

--
-- Indexes for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regions_country_id_foreign` (`country_id`);

--
-- Indexes for table `return_policies`
--
ALTER TABLE `return_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `shop_business_page_slider`
--
ALTER TABLE `shop_business_page_slider`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_business_profile_id` (`shop_business_profile_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `shop_business_profile`
--
ALTER TABLE `shop_business_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `shop_contact_info`
--
ALTER TABLE `shop_contact_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `town_id` (`town_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `shop_registration_info`
--
ALTER TABLE `shop_registration_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `shop_subscribers`
--
ALTER TABLE `shop_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `shop_subscriptions`
--
ALTER TABLE `shop_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscription_id` (`subscription_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `towns`
--
ALTER TABLE `towns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `towns_region_id_foreign` (`region_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buyer_custom_order_requests`
--
ALTER TABLE `buyer_custom_order_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buyer_order_requests`
--
ALTER TABLE `buyer_order_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `return_policies`
--
ALTER TABLE `return_policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `shop_business_page_slider`
--
ALTER TABLE `shop_business_page_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_business_profile`
--
ALTER TABLE `shop_business_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_contact_info`
--
ALTER TABLE `shop_contact_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shop_registration_info`
--
ALTER TABLE `shop_registration_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_subscribers`
--
ALTER TABLE `shop_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_subscriptions`
--
ALTER TABLE `shop_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `towns`
--
ALTER TABLE `towns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `towns`
--
ALTER TABLE `towns`
  ADD CONSTRAINT `towns_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
