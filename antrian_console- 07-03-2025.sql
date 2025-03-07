-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 07 Mar 2025 pada 08.57
-- Versi server: 8.2.0
-- Versi PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antrian_console`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `button_actor`
--

DROP TABLE IF EXISTS `button_actor`;
CREATE TABLE IF NOT EXISTS `button_actor` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_button_code` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `counter_number` int NOT NULL,
  `unit_service` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_queue_number` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_queue_called` datetime DEFAULT NULL,
  `originationcust_SeqDt` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `button_actor`
--

INSERT INTO `button_actor` (`id`, `name`, `user_button_code`, `counter_number`, `unit_service`, `last_queue_number`, `last_queue_called`, `originationcust_SeqDt`, `created_at`, `updated_at`) VALUES
(1, 'teller 1', 'A', 3, 'A', NULL, NULL, NULL, '2025-02-16 12:54:35', '2025-03-03 17:10:32'),
(2, 'cs1', 'W', 1, 'B', NULL, NULL, NULL, '2025-02-18 16:38:49', '2025-03-03 17:10:32'),
(5, 'cs2', 'U', 2, 'B', NULL, NULL, NULL, '2025-02-18 17:13:06', '2025-03-03 17:10:32'),
(4, 'teller 2', 'C', 2, 'A', NULL, NULL, NULL, '2025-02-18 16:40:00', '2025-03-03 17:10:32'),
(6, 'teller 3', 'B', 1, 'A', NULL, NULL, NULL, '2025-02-18 17:15:33', '2025-03-03 17:10:32'),
(7, 'teller 4', 'D', 4, 'A', NULL, NULL, NULL, '2025-02-18 17:15:56', '2025-03-03 17:10:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `codeservice`
--

DROP TABLE IF EXISTS `codeservice`;
CREATE TABLE IF NOT EXISTS `codeservice` (
  `Initial` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CurrentQNo` int NOT NULL DEFAULT '0',
  `last_queue` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_reset_counter` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `codeservice`
--

INSERT INTO `codeservice` (`Initial`, `Name`, `CurrentQNo`, `last_queue`, `created_at`, `updated_at`, `is_reset_counter`) VALUES
('A', 'Teller Umum', 0, 0, NULL, '2025-03-03 17:10:32', 0),
('B', 'CS Umum', 0, 0, NULL, '2025-03-03 17:10:32', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `currency`
--

DROP TABLE IF EXISTS `currency`;
CREATE TABLE IF NOT EXISTS `currency` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `flag_url` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jual_a` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `beli_a` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jual_b` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `beli_b` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `currency`
--

INSERT INTO `currency` (`id`, `flag_url`, `name`, `jual_a`, `beli_a`, `jual_b`, `beli_b`, `show`, `created_at`, `updated_at`) VALUES
(54, 'flag/USD.png', 'USD', '15.410,00', '15.740,00', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(55, 'flag/CAD.png', 'CAD', '11.302,67', '11.502,67', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(56, 'flag/AUD.png', 'AUD', '10.319,07', '10.519,07', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(57, 'flag/SGD.png', 'SGD', '11.708,75', '12.108,75', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(58, 'flag/HKD.png', 'HKD', '1.926,38', '2.076,38', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(59, 'flag/GBP.png', 'GBP', '20.087,27', '20.327,27', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(60, 'flag/CHF.png', 'CHF', '17.964,28', '18.164,28', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(61, 'flag/EUR.png', 'EUR', '17.113,95', '17.313,95', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(62, 'flag/SAR.png', 'SAR', '4.054,45', '4.404,45', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(63, 'flag/CNY.png', 'CNY', '2.101,79', '2.271,79', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(64, 'flag/MYR.png', 'MYR', '3.485,10', '3.610,10', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(65, 'flag/THB.png', 'THB', '413,17', '493,17', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(66, 'flag/JPY.png', 'JPY', '102,14', '111,11', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(67, 'flag/KRW.png', 'KRW', '6,70', '16,70', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(68, 'flag/PGK.png', 'PGK', '3.744,31', '3.884,31', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(69, 'flag/NZD.png', 'NZD', '9.373,53', '9.573,53', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(70, 'flag/BND.png', 'BND', '11.808,75', '12.008,75', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(71, 'flag/AED.png', 'AED', '4.159,08', '4.344,08', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(72, 'flag/INR.png', 'INR', '165,98', '205,98', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(73, 'flag/PHP.png', 'PHP', '225,06', '325,06', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(74, 'flag/VND.png', 'VND', '0,37', '0,92', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(75, 'flag/TWD.png', 'TWD', '337,26', '524,26', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(76, 'flag/NOK.png', 'NOK', '1.480,30', '1.489,63', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04'),
(77, 'flag/SEK.png', 'SEK', '1.511,42', '1.520,70', '0', '0', 1, '2025-03-04 08:30:29', '2025-03-04 12:32:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `font_colors`
--

DROP TABLE IF EXISTS `font_colors`;
CREATE TABLE IF NOT EXISTS `font_colors` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `font_colors`
--

INSERT INTO `font_colors` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'unit_name', NULL, NULL, NULL),
(2, 'current_queue', NULL, NULL, NULL),
(3, 'first_log', NULL, NULL, NULL),
(4, 'second_log', NULL, NULL, NULL),
(5, 'watch', NULL, NULL, NULL),
(6, 'footer_text', NULL, NULL, NULL),
(7, 'kios_footer_text_color', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `footer_texts`
--

DROP TABLE IF EXISTS `footer_texts`;
CREATE TABLE IF NOT EXISTS `footer_texts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `text` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show` tinyint(1) NOT NULL DEFAULT '0',
  `display_number` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'console',
  PRIMARY KEY (`id`),
  UNIQUE KEY `footer_texts_display_number_type_unique` (`display_number`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_products`
--

DROP TABLE IF EXISTS `master_products`;
CREATE TABLE IF NOT EXISTS `master_products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_number` int NOT NULL DEFAULT '0',
  `show` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `master_products_id_display_number_unique` (`id`,`display_number`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_products`
--

INSERT INTO `master_products` (`id`, `name`, `display_number`, `show`, `created_at`, `updated_at`) VALUES
(1, 'BRITAMA (RP)', 1, 1, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(2, 'BRITAMA (USD)', 2, 1, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(3, 'GIRO (RP)', 3, 1, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(4, 'SIMPEDES', 4, 1, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(5, 'DEPOSITO', 5, 1, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(6, 'TABUNGANKU', 6, 1, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(7, 'PENJAMINAN (RP)', 7, 1, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(8, 'PENJAMINAN (USD)', 8, 1, '2025-02-15 02:38:39', '2025-02-15 02:38:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_01_073021_create_master_product_table', 1),
(6, '2024_05_01_073843_create_product_detail_table', 1),
(7, '2024_05_02_132902_create_currency_table', 1),
(8, '2024_05_04_074614_create_properties_table', 1),
(9, '2024_05_10_205703_create_table_footer_text', 1),
(10, '2024_05_12_054249_add_footer_flow_to_properties', 1),
(11, '2024_05_18_160915_create_font_colors_table', 1),
(12, '2024_05_24_051625_add_type_to_footer_text', 1),
(13, '2024_05_24_052850_change_uniq_on_footer_text', 1),
(14, '2024_05_24_062731_add_kios_footer_f_low', 1),
(15, '2024_05_24_064452_add_printer_name_to_properties', 1),
(16, '2024_06_23_081529_create_temp_call_web_table', 1),
(17, '2024_06_23_082629_create_code_service_table', 1),
(18, '2024_06_23_083231_create_originationcust_table', 1),
(19, '2024_06_23_084035_create_transactioncust_table', 1),
(20, '2024_06_23_084557_create_trxparam_table', 1),
(21, '2024_06_23_085056_create_stat_console_table', 1),
(22, '2024_06_23_121755_create_button_actor_table', 1),
(23, '2024_09_03_233916_add_button_actor_to_temp_call_web', 1),
(24, '2025_02_08_151448_add_is_reset_properties', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `originationcust`
--

DROP TABLE IF EXISTS `originationcust`;
CREATE TABLE IF NOT EXISTS `originationcust` (
  `BaseDt` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SeqNumber` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UnitServe` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TimeTicket` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TimeCall` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origin_queue_number` int NOT NULL,
  `WaitDuration` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Flag` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SeqDt` int NOT NULL AUTO_INCREMENT,
  `DescTransaksi` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UnitCall` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_trx` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SLA_Trx` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00:00:00',
  `is_queue_online` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`SeqDt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_detail`
--

DROP TABLE IF EXISTS `product_detail`;
CREATE TABLE IF NOT EXISTS `product_detail` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `master_product_id` bigint UNSIGNED NOT NULL,
  `value` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suku_bunga` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_number` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_detail_display_number_master_product_id_unique` (`display_number`,`master_product_id`),
  KEY `product_detail_master_product_id_foreign` (`master_product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_detail`
--

INSERT INTO `product_detail` (`id`, `master_product_id`, `value`, `suku_bunga`, `display_number`, `created_at`, `updated_at`) VALUES
(1, 1, '500 RIBU - 5 JUTA', '3 %', 1, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(2, 1, '> 5 JUTA - 50 JUTA', '14 %', 2, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(3, 1, '> 50 JUTA - 100 JUTA', '15 %', 3, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(4, 1, '> 100 JUTA - 1 MILYAR', '24 %', 4, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(5, 1, '> 1 MILYAR', '30 %', 5, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(6, 2, '500 RIBU - 5 JUTA', '3 %', 1, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(7, 2, '> 5 JUTA - 50 JUTA', '14 %', 2, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(8, 2, '> 50 JUTA - 100 JUTA', '15 %', 3, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(9, 2, '> 100 JUTA - 1 MILYAR', '24 %', 4, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(10, 2, '> 1 MILYAR', '30 %', 5, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(11, 3, '500 RIBU - 5 JUTA', '3 %', 1, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(12, 3, '> 5 JUTA - 50 JUTA', '14 %', 2, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(13, 3, '> 50 JUTA - 100 JUTA', '15 %', 3, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(14, 3, '> 100 JUTA - 1 MILYAR', '24 %', 4, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(15, 3, '> 1 MILYAR', '30 %', 5, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(16, 4, '500 RIBU - 5 JUTA', '3 %', 1, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(17, 4, '> 5 JUTA - 50 JUTA', '14 %', 2, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(18, 4, '> 50 JUTA - 100 JUTA', '15 %', 3, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(19, 4, '> 100 JUTA - 1 MILYAR', '24 %', 4, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(20, 4, '> 1 MILYAR', '30 %', 5, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(21, 5, '500 RIBU - 5 JUTA', '3 %', 1, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(22, 5, '> 5 JUTA - 50 JUTA', '14 %', 2, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(23, 5, '> 50 JUTA - 100 JUTA', '15 %', 3, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(24, 5, '> 100 JUTA - 1 MILYAR', '24 %', 4, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(25, 5, '> 1 MILYAR', '30 %', 5, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(26, 6, '500 RIBU - 5 JUTA', '3 %', 1, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(27, 6, '> 5 JUTA - 50 JUTA', '14 %', 2, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(28, 6, '> 50 JUTA - 100 JUTA', '15 %', 3, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(29, 6, '> 100 JUTA - 1 MILYAR', '24 %', 4, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(30, 6, '> 1 MILYAR', '30 %', 5, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(31, 7, '500 RIBU - 5 JUTA', '3 %', 1, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(32, 7, '> 5 JUTA - 50 JUTA', '14 %', 2, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(33, 7, '> 50 JUTA - 100 JUTA', '15 %', 3, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(34, 7, '> 100 JUTA - 1 MILYAR', '24 %', 4, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(35, 7, '> 1 MILYAR', '30 %', 5, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(36, 8, '500 RIBU - 5 JUTA', '3 %', 1, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(37, 8, '> 5 JUTA - 50 JUTA', '14 %', 2, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(38, 8, '> 50 JUTA - 100 JUTA', '15 %', 3, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(39, 8, '> 100 JUTA - 1 MILYAR', '24 %', 4, '2025-02-15 02:38:39', '2025-02-15 02:38:39'),
(40, 8, '> 1 MILYAR', '30 %', 5, '2025-02-15 02:38:39', '2025-02-15 02:38:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `properties`
--

DROP TABLE IF EXISTS `properties`;
CREATE TABLE IF NOT EXISTS `properties` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_name` varchar(244) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_code` varchar(244) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_product` tinyint(1) NOT NULL DEFAULT '1',
  `show_currency` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `footer_flow` enum('left','right') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'right',
  `footer_flow_kios` enum('left','right') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'right',
  `printer_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `properties`
--

INSERT INTO `properties` (`id`, `company_name`, `company_code`, `show_product`, `show_currency`, `created_at`, `updated_at`, `footer_flow`, `footer_flow_kios`, `printer_name`) VALUES
(1, 'KCP Ciawi', '1437', 0, 1, '2025-02-15 08:01:38', '2025-03-04 12:42:20', 'left', 'left', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stat_console`
--

DROP TABLE IF EXISTS `stat_console`;
CREATE TABLE IF NOT EXISTS `stat_console` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tanggal` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ActiveDate` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stat_console`
--

INSERT INTO `stat_console` (`id`, `tanggal`, `Status`, `ActiveDate`, `created_at`, `updated_at`) VALUES
(1, '20250304', 'active', '20250304', '2025-02-15 08:01:38', '2025-03-03 17:10:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_call_web`
--

DROP TABLE IF EXISTS `temp_call_web`;
CREATE TABLE IF NOT EXISTS `temp_call_web` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Counter` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Unit` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SeqNumber` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tampil` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `button_actor_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactioncust`
--

DROP TABLE IF EXISTS `transactioncust`;
CREATE TABLE IF NOT EXISTS `transactioncust` (
  `BaseDt` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SeqNumber` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TrxDesc` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TimeTicket` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TimeCall` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CustWaitDuration` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UnitServe` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CounterNo` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Absent` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `UserId` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Flag` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TimeEnd` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tservice` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TWservice` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TSLAservice` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TOverSLA` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `synced` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `is_queue_online` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactioncust`
--

INSERT INTO `transactioncust` (`BaseDt`, `SeqNumber`, `TrxDesc`, `TimeTicket`, `TimeCall`, `CustWaitDuration`, `UnitServe`, `CounterNo`, `Absent`, `UserId`, `Flag`, `TimeEnd`, `Tservice`, `TWservice`, `TSLAservice`, `TOverSLA`, `synced`, `is_queue_online`, `created_at`, `updated_at`) VALUES
('20250219', 'A004', '1112', '00:29:03', '00:29:10', '00:00:04', 'A', '4', 'N', 'teller 4', 'N', '00:29:28', '00:00:18', '00:00:00', '00:05:00', '00:00:00', 'Y', 0, '2025-02-18 17:29:28', '2025-02-19 13:57:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trxparam`
--

DROP TABLE IF EXISTS `trxparam`;
CREATE TABLE IF NOT EXISTS `trxparam` (
  `TrxCode` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TrxName` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UnitService` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tservice` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00:00:00',
  `displayed` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`TrxCode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `trxparam`
--

INSERT INTO `trxparam` (`TrxCode`, `TrxName`, `UnitService`, `Tservice`, `displayed`, `created_at`, `updated_at`) VALUES
('1111', 'SETOR TELLER', 'A', '00:05:00', 1, NULL, NULL),
('1112', 'PENGAMBILAN TELLER', 'A', '00:05:00', 1, NULL, NULL),
('1113', 'KLIRING', 'A', '00:05:00', 1, NULL, NULL),
('1114', 'TRANSFER VIA TELLER', 'A', '00:05:00', 1, NULL, NULL),
('1115', 'LAIN LAIN', 'A', '00:05:00', 1, NULL, NULL),
('2226', 'KLOMPLAIN NASABAH', 'B', '00:05:00', 1, NULL, NULL),
('2225', 'BLOKIR REKENING', 'B', '00:05:00', 1, NULL, NULL),
('2224', 'GANTI ATM', 'B', '00:05:00', 1, NULL, NULL),
('2223', 'BUKA DEPOSITO', 'B', '00:05:00', 1, NULL, NULL),
('2222', 'BUKA INTERNET BANKING', 'B', '00:05:00', 1, NULL, NULL),
('2221', 'BUKA TABUNGAN', 'B', '00:05:00', 1, NULL, NULL),
('2220', 'LAIN-LAIN', 'B', '00:05:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@mail.com', NULL, '$2y$10$yeBoKVDmT2EpdhYKZKj/QutNaHvlkLbQgGROy8FySloo4rnxTQwCm', 'superadmin', NULL, '2025-02-15 02:38:39', '2025-02-15 02:38:39');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `product_detail`
--
ALTER TABLE `product_detail`
  ADD CONSTRAINT `product_detail_master_product_id_foreign` FOREIGN KEY (`master_product_id`) REFERENCES `master_products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
