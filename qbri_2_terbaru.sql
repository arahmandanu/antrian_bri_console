-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 12 Bulan Mei 2024 pada 15.58
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
-- Database: `qbri_2_new`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `codeservice`
--

DROP TABLE IF EXISTS `codeservice`;
CREATE TABLE IF NOT EXISTS `codeservice` (
  `Name` varchar(20) DEFAULT NULL,
  `Initial` char(1) NOT NULL DEFAULT '',
  `CurrentQNo` smallint DEFAULT NULL,
  PRIMARY KEY (`Initial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409';

--
-- Dumping data untuk tabel `codeservice`
--

INSERT INTO `codeservice` (`Name`, `Initial`, `CurrentQNo`) VALUES
('TlUmum', 'A', 9),
('CSUmum', 'B', 0),
('QService', 'C', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `currency`
--

DROP TABLE IF EXISTS `currency`;
CREATE TABLE IF NOT EXISTS `currency` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `flag_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jual_a` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `beli_a` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jual_b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `beli_b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `deposito`
--

DROP TABLE IF EXISTS `deposito`;
CREATE TABLE IF NOT EXISTS `deposito` (
  `nomor` int UNSIGNED NOT NULL,
  `Tier` varchar(20) DEFAULT NULL,
  `Tenor1` varchar(5) DEFAULT NULL,
  `Tenor3` varchar(5) DEFAULT NULL,
  `Tenor6` varchar(5) DEFAULT NULL,
  `Tenor12` varchar(5) DEFAULT NULL,
  `Tenor24` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `deposito`
--

INSERT INTO `deposito` (`nomor`, `Tier`, `Tenor1`, `Tenor3`, `Tenor6`, `Tenor12`, `Tenor24`) VALUES
(1, '<50jt', '4.5', '4.5', '5.0', '5.25', '5.25'),
(2, '>=50 jt - <100jt', '4.5', '4.5', '5.0', '5.25', '5.25'),
(3, '>=100jt - <500jt', '4.5', '4.75', '5.25', '5.25', '5.25'),
(4, '>=500jt - <1M', '4.5', '4.75', '5.25', '5.5', '5.4'),
(5, '>=1M - <5M', '4.75', '5.0', '5.5', '5.5', '5.5'),
(6, '>=5M - <10M', '4.75', '5.0', '5.5', '5.5', '5.5'),
(7, '>=10M', '4.75', '5.0', '5.5', '5.5', '5.5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `exchange_rate`
--

DROP TABLE IF EXISTS `exchange_rate`;
CREATE TABLE IF NOT EXISTS `exchange_rate` (
  `Code` int UNSIGNED NOT NULL,
  `ShortName` char(3) DEFAULT NULL,
  `FullName` varchar(30) DEFAULT NULL,
  `Buy` float DEFAULT NULL,
  `Sell` float DEFAULT NULL,
  `TBuy` float DEFAULT NULL,
  `TSell` float DEFAULT NULL,
  `LastUpdate` varchar(20) DEFAULT NULL,
  `Flag` char(1) DEFAULT NULL,
  `Userid` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 102';

--
-- Dumping data untuk tabel `exchange_rate`
--

INSERT INTO `exchange_rate` (`Code`, `ShortName`, `FullName`, `Buy`, `Sell`, `TBuy`, `TSell`, `LastUpdate`, `Flag`, `Userid`) VALUES
(1, 'USD', 'Dollar Amerika', 9015, 9235, 9025, 9225, '2012-07-05 22:48:32', 'A', 'master'),
(2, 'SGD', 'Dollar Singapore', 7016, 7204, 7036, 7194, '2012-07-05 22:33:49', 'A', 'teller'),
(3, 'EUR', 'Euro', 12155, 12423, 12185, 12408, '2020-09-13 19:57:09', 'A', 'teller'),
(5, 'JPY', 'Japanese Yen', 115.07, 119.12, 116.02, 118.62, '2012-03-01 22:59:53', 'A', 'teller'),
(6, 'MYR', 'Ringgit Malaysia', 3100, 3200, 3500, 3600, '2012-11-16 21:33:38', 'A', 'teller');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `footer_texts_display_number_unique` (`display_number`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `footer_texts`
--

INSERT INTO `footer_texts` (`id`, `text`, `show`, `display_number`, `created_at`, `updated_at`) VALUES
(1, 'Selamat datang ke BRI', 1, 1, '2024-05-12 04:25:40', '2024-05-12 04:25:40'),
(2, 'Ini adalah aplikasi untuk antrian di BRI', 1, 2, '2024-05-12 04:25:53', '2024-05-12 04:25:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `grafik`
--

DROP TABLE IF EXISTS `grafik`;
CREATE TABLE IF NOT EXISTS `grafik` (
  `code` varchar(1) NOT NULL,
  `Desc` varchar(15) DEFAULT NULL,
  `jumlah` int UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `grafik`
--

INSERT INTO `grafik` (`code`, `Desc`, `jumlah`) VALUES
('0', 'Achieved', 23),
('1', 'Not Achieved', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `groupproduk`
--

DROP TABLE IF EXISTS `groupproduk`;
CREATE TABLE IF NOT EXISTS `groupproduk` (
  `IdGroup` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `DescGroup` varchar(17) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `updatetgl` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IdGroup`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `groupproduk`
--

INSERT INTO `groupproduk` (`IdGroup`, `DescGroup`, `status`, `updatetgl`) VALUES
(1, 'BRITAMA (RP)', 'A', '12-08-2018 00:17:23'),
(2, 'BRITAMA (USD)', 'N', '12-08-2018 00:17:23'),
(3, 'GIRO (RP)', 'N', '12-08-2018 00:17:23'),
(4, 'SIMPEDES', 'N', '12-08-2018 00:17:23'),
(5, 'DEPOSITO', 'N', '12-08-2018 00:17:23'),
(6, 'TABUNGANKU', 'N', '12-08-2018 00:17:23'),
(7, 'PENJAMINAN (RP)', 'N', '12-08-2018 00:17:23'),
(8, 'PENJAMINAN (USD)', 'N', '12-08-2018 00:17:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_products`
--

DROP TABLE IF EXISTS `master_products`;
CREATE TABLE IF NOT EXISTS `master_products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 'BRITAMA (RP)', 1, 1, '2024-05-12 01:09:00', '2024-05-12 01:09:00'),
(2, 'BRITAMA (USD)', 2, 1, '2024-05-12 01:09:00', '2024-05-12 01:09:00'),
(3, 'GIRO (RP)', 3, 1, '2024-05-12 01:09:00', '2024-05-12 01:09:00'),
(4, 'SIMPEDES', 4, 1, '2024-05-12 01:09:00', '2024-05-12 01:09:00'),
(5, 'DEPOSITO', 5, 1, '2024-05-12 01:09:00', '2024-05-12 01:09:00'),
(6, 'TABUNGANKU', 6, 1, '2024-05-12 01:09:00', '2024-05-12 01:09:00'),
(7, 'PENJAMINAN (RP)', 7, 1, '2024-05-12 01:09:00', '2024-05-12 01:09:00'),
(8, 'PENJAMINAN (USD)', 8, 1, '2024-05-12 01:09:00', '2024-05-12 01:09:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(10, '2024_05_12_054249_add_footer_flow_to_properties', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mmedia`
--

DROP TABLE IF EXISTS `mmedia`;
CREATE TABLE IF NOT EXISTS `mmedia` (
  `Seq` int NOT NULL,
  `FileName` char(40) DEFAULT NULL,
  `FileExt` char(3) DEFAULT NULL,
  `FileLocation` char(100) DEFAULT NULL,
  PRIMARY KEY (`Seq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 102';

--
-- Dumping data untuk tabel `mmedia`
--

INSERT INTO `mmedia` (`Seq`, `FileName`, `FileExt`, `FileLocation`) VALUES
(1, 'KPR', 'mpg', 'C:\\FilmQueing'),
(2, 'BII', 'mpg', 'C:\\FilmQueing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `originationcust`
--

DROP TABLE IF EXISTS `originationcust`;
CREATE TABLE IF NOT EXISTS `originationcust` (
  `BaseDt` char(8) NOT NULL,
  `SeqNumber` char(4) DEFAULT NULL,
  `UnitServe` varchar(1) DEFAULT NULL,
  `TimeTicket` char(8) DEFAULT NULL,
  `TimeCall` char(8) DEFAULT NULL,
  `WaitDuration` char(8) DEFAULT NULL,
  `Flag` varchar(1) DEFAULT NULL,
  `SeqDt` smallint NOT NULL AUTO_INCREMENT,
  `DescTransaksi` varchar(45) DEFAULT NULL,
  `UnitCall` varchar(1) DEFAULT NULL,
  `code_trx` varchar(4) DEFAULT NULL,
  `SLA_Trx` varchar(8) NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`SeqDt`,`BaseDt`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409';

--
-- Dumping data untuk tabel `originationcust`
--

INSERT INTO `originationcust` (`BaseDt`, `SeqNumber`, `UnitServe`, `TimeTicket`, `TimeCall`, `WaitDuration`, `Flag`, `SeqDt`, `DescTransaksi`, `UnitCall`, `code_trx`, `SLA_Trx`) VALUES
('20240512', 'A001', 'A', '15:13:07', '15:13:41', '00:00:34', 'N', 23, 'Antrian Teller', 'A', '1111', '00:05:00'),
('20240512', 'A002', 'A', '15:13:13', '15:13:51', '00:00:38', 'N', 24, 'Antrian Teller', 'A', '1111', '00:05:00'),
('20240512', 'A003', 'A', '15:13:16', '15:14:03', '00:00:47', 'N', 25, 'Antrian Teller', 'A', '1111', '00:05:00'),
('20240512', 'A004', 'A', '15:13:19', '18:13:31', '03:00:12', 'N', 26, 'Antrian Teller', 'A', '1111', '00:05:00'),
('20240512', 'A005', 'A', '15:13:22', '18:14:05', '03:00:43', 'N', 27, 'Antrian Teller', 'A', '1111', '00:05:00'),
('20240512', 'A006', 'A', '18:59:58', '19:00:33', '00:00:35', 'N', 28, 'Antrian Teller', 'A', '1111', '00:05:00'),
('20240512', 'A007', 'A', '19:00:05', '19:00:49', '00:00:44', 'N', 29, 'Antrian Teller', 'A', '1111', '00:05:00'),
('20240512', 'A008', 'A', '19:00:08', '19:01:03', '00:00:55', 'N', 30, 'Antrian Teller', 'A', '1111', '00:05:00'),
('20240512', 'A009', 'A', '19:00:11', NULL, NULL, 'P', 31, 'Antrian Teller', 'A', '1111', '00:05:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password`
--

DROP TABLE IF EXISTS `password`;
CREATE TABLE IF NOT EXISTS `password` (
  `branchcode` char(3) DEFAULT '150',
  `UserName` varchar(30) DEFAULT NULL,
  `UserID` varchar(10) NOT NULL,
  `UsrLevel` char(2) DEFAULT NULL,
  `Unit` char(2) DEFAULT NULL,
  `Status` char(1) DEFAULT 'N',
  `TRXCode` varchar(4) DEFAULT '0000',
  `TRXStart` varchar(8) DEFAULT '00:00:00',
  `SLAtrx` varchar(8) DEFAULT '00:00:00',
  `TRXEnd` varchar(8) DEFAULT '00:00:00',
  `pasword` varchar(80) DEFAULT NULL,
  `salah` int UNSIGNED NOT NULL DEFAULT '0',
  `locked` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 307';

--
-- Dumping data untuk tabel `password`
--

INSERT INTO `password` (`branchcode`, `UserName`, `UserID`, `UsrLevel`, `Unit`, `Status`, `TRXCode`, `TRXStart`, `SLAtrx`, `TRXEnd`, `pasword`, `salah`, `locked`) VALUES
('000', 'ADMINISTRATOR', 'ADMIN', 'AD', '00', 'N', '0000', '00:00:00', '00:00:00', '00:00:00', 'e10adc3949ba59abbe56e057f20f883e', 0, 'N'),
('000', 'CS1', 'CS1', 'OP', '02', 'N', '0000', '00:00:00', '00:00:00', '00:00:00', 'e10adc3949ba59abbe56e057f20f883e', 0, 'N'),
('000', 'CS2', 'CS2', 'OP', '02', 'N', '0000', '00:00:00', '00:00:00', '00:00:00', 'e10adc3949ba59abbe56e057f20f883e', 0, 'N'),
('000', 'CS3', 'CS3', 'OP', '02', 'N', '0000', '00:00:00', '00:00:00', '00:00:00', 'e10adc3949ba59abbe56e057f20f883e', 0, 'N'),
('000', 'MASTER', 'MASTER', 'AD', '00', 'N', '0000', '00:00:00', '00:00:00', '00:00:00', 'e10adc3949ba59abbe56e057f20f883e', 0, 'N'),
('000', 'QS1', 'QS1', 'OP', '03', 'N', '0000', '00:00:00', '00:00:00', '00:00:00', 'e10adc3949ba59abbe56e057f20f883e', 0, 'N'),
('000', 'QS2', 'QS2', 'OP', '03', 'N', '0000', '00:00:00', '00:00:00', '00:00:00', 'e10adc3949ba59abbe56e057f20f883e', 0, 'N'),
('000', 'QS3', 'QS3', 'OP', '03', 'N', '0000', '00:00:00', '00:00:00', '00:00:00', 'e10adc3949ba59abbe56e057f20f883e', 0, 'N'),
('000', 'TELLER1', 'TELLER1', 'OP', '01', 'N', '0000', '00:00:00', '00:00:00', '00:00:00', 'e10adc3949ba59abbe56e057f20f883e', 0, 'N'),
('000', 'TELLER2', 'TELLER2', 'OP', '01', 'N', '0000', '00:00:00', '00:00:00', '00:00:00', 'e10adc3949ba59abbe56e057f20f883e', 0, 'N'),
('000', 'TELLER3', 'TELLER3', 'OP', '01', 'N', '0000', '00:00:00', '00:00:00', '00:00:00', 'e10adc3949ba59abbe56e057f20f883e', 0, 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Struktur dari tabel `picture`
--

DROP TABLE IF EXISTS `picture`;
CREATE TABLE IF NOT EXISTS `picture` (
  `seq` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `FileName` varchar(45) DEFAULT NULL,
  `FileExt` varchar(3) DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `picture`
--

INSERT INTO `picture` (`seq`, `FileName`, `FileExt`, `Location`) VALUES
(1, 'Britama', 'jpg', 'D:\\My Proyek\\BRI\\QTombol\\Images'),
(2, 'Top Brand bri', 'jpg', 'D:\\My Proyek\\BRI\\QTombol\\Hanya gambar saja\\Images');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_detail`
--

DROP TABLE IF EXISTS `product_detail`;
CREATE TABLE IF NOT EXISTS `product_detail` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `master_product_id` bigint UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suku_bunga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_number` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_detail_display_number_master_product_id_unique` (`display_number`,`master_product_id`),
  KEY `product_detail_master_product_id_foreign` (`master_product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `GroupID` int UNSIGNED DEFAULT NULL,
  `nourut` int UNSIGNED DEFAULT NULL,
  `keterangan` varchar(25) DEFAULT NULL,
  `rate` varchar(5) DEFAULT NULL,
  `ID` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`GroupID`, `nourut`, `keterangan`, `rate`, `ID`) VALUES
(1, 1, '500 RIBU - 5 JUTA', '3', 1),
(1, 2, '> 5 JUTA - 50 JUTA', '14', 2),
(1, 3, '> 50 JUTA - 100 JUTA', '15', 3),
(1, 4, '> 100 JUTA - 1 MILYAR', '24', 4),
(1, 5, '> 1 MILYAR', '3', 5),
(2, 1, '> $50 - $1000', '3', 6),
(2, 2, '> $1000 - $10.000', '14', 7),
(2, 3, '> $10.000', '15', 8),
(3, 1, '0 - < 5 JUTA', '3', 11),
(3, 2, '5 JUTA - 25 JUTA', '14', 12),
(3, 3, '> 25 JUTA - 100 JUTA', '15', 13),
(3, 4, '> 100 JUTA - 1 MILYAR', '24', 14),
(3, 5, '> 1 MILYAR', '3', 15),
(4, 1, '0 - < 500 RIBU', '3', 16),
(4, 2, '500 RIBU - 5 JUTA', '14', 17),
(4, 3, '> 5 JUTA - 50 JUTA', '15', 18),
(4, 4, '> 50 JUTA - 100 JUTA', '24', 19),
(4, 5, '> 100 JUTA', '3', 20),
(5, 1, '1 BULAN', '3', 21),
(5, 2, '3 BULAN', '14', 22),
(5, 3, '6 BULAN', '15', 23),
(5, 4, '12 BULAN', '24', 24),
(5, 5, '24 BULAN', '3', 25),
(6, 1, '< 1 JUTA', '15', 26),
(6, 2, '>= 1 JUTA ', '24', 27),
(7, 1, 'L P S', '28', 28),
(8, 1, 'L P S', '28', 29),
(9, 1, 'TEST1', '12', 33);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `properties`
--

INSERT INTO `properties` (`id`, `company_name`, `company_code`, `show_product`, `show_currency`, `created_at`, `updated_at`, `footer_flow`) VALUES
(1, 'BRI UNIT COLOMADU', '12312313', 1, 1, '2024-05-12 04:26:22', '2024-05-12 04:29:54', 'left');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setupparam`
--

DROP TABLE IF EXISTS `setupparam`;
CREATE TABLE IF NOT EXISTS `setupparam` (
  `Code` char(2) NOT NULL,
  `BranchName` varchar(40) DEFAULT NULL,
  `SoundVolume` char(2) DEFAULT NULL,
  `ValasTime` varchar(2) DEFAULT NULL,
  `TvTime` varchar(2) DEFAULT NULL,
  `Timetext` varchar(6) DEFAULT NULL,
  `Speedtext` varchar(2) DEFAULT NULL,
  `StaticMedia` varchar(2) DEFAULT NULL,
  `MediaValas` varchar(2) DEFAULT NULL,
  `MediaProduk` varchar(2) DEFAULT NULL,
  `MediaTV` varchar(2) DEFAULT NULL,
  `MediaTarif` varchar(2) DEFAULT NULL,
  `TTarif` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409';

--
-- Dumping data untuk tabel `setupparam`
--

INSERT INTO `setupparam` (`Code`, `BranchName`, `SoundVolume`, `ValasTime`, `TvTime`, `Timetext`, `Speedtext`, `StaticMedia`, `MediaValas`, `MediaProduk`, `MediaTV`, `MediaTarif`, `TTarif`) VALUES
('01', 'Cabang Padang', '20', '5', '5', '1000', '1', 'N', 'Y', 'Y', 'N', 'Y', '10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stat_console`
--

DROP TABLE IF EXISTS `stat_console`;
CREATE TABLE IF NOT EXISTS `stat_console` (
  `tanggal` varchar(8) NOT NULL,
  `Status` varchar(1) NOT NULL,
  `ActiveDate` varchar(8) NOT NULL,
  PRIMARY KEY (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stat_console`
--

INSERT INTO `stat_console` (`tanggal`, `Status`, `ActiveDate`) VALUES
('20240512', 'A', '20240512');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stat_counter`
--

DROP TABLE IF EXISTS `stat_counter`;
CREATE TABLE IF NOT EXISTS `stat_counter` (
  `counter` varchar(2) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `flag` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_call`
--

DROP TABLE IF EXISTS `temp_call`;
CREATE TABLE IF NOT EXISTS `temp_call` (
  `Counter` varchar(2) NOT NULL,
  `Unit` varchar(2) NOT NULL,
  `SeqNumber` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_call_web`
--

DROP TABLE IF EXISTS `temp_call_web`;
CREATE TABLE IF NOT EXISTS `temp_call_web` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Counter` varchar(2) NOT NULL,
  `Unit` varchar(2) NOT NULL,
  `SeqNumber` varchar(4) NOT NULL,
  `Tampil` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'n',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `temp_call_web`
--

INSERT INTO `temp_call_web` (`id`, `Counter`, `Unit`, `SeqNumber`, `Tampil`) VALUES
(1, '02', 'B', 'B002', ''),
(2, '02', 'B', 'B003', ''),
(3, '02', 'B', 'B003', ''),
(4, '02', 'A', 'A001', 'y'),
(5, '02', 'A', 'A001', 'y'),
(6, '02', 'A', 'A002', 'y'),
(7, '02', 'A', 'A003', 'y'),
(8, '02', 'A', 'A004', 'y'),
(9, '02', 'A', 'A005', 'y'),
(10, '02', 'A', 'A005', 'y'),
(11, '02', 'A', 'A006', 'y'),
(12, '02', 'A', 'A007', 'y'),
(13, '02', 'A', 'A008', 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `textbanner`
--

DROP TABLE IF EXISTS `textbanner`;
CREATE TABLE IF NOT EXISTS `textbanner` (
  `Seq` int NOT NULL,
  `Msg` varchar(254) DEFAULT NULL,
  `Status` varchar(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`Seq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409';

--
-- Dumping data untuk tabel `textbanner`
--

INSERT INTO `textbanner` (`Seq`, `Msg`, `Status`) VALUES
(2, 'Hitung uang anda sebelum meninggalkan counter', 'A'),
(3, 'Terima kasih atas kunjungan anda', 'A'),
(5, 'Ini adalah text nomor 5', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactioncust`
--

DROP TABLE IF EXISTS `transactioncust`;
CREATE TABLE IF NOT EXISTS `transactioncust` (
  `BaseDt` char(8) DEFAULT NULL,
  `SeqNumber` char(4) DEFAULT NULL,
  `TrxDesc` varchar(10) DEFAULT NULL,
  `TimeTicket` char(8) DEFAULT NULL,
  `TimeCall` char(8) DEFAULT NULL,
  `CustWaitDuration` char(8) DEFAULT NULL,
  `UnitServe` char(1) DEFAULT NULL,
  `CounterNo` char(2) DEFAULT NULL,
  `Absent` char(1) DEFAULT 'N',
  `UserId` varchar(10) DEFAULT NULL,
  `Flag` char(1) DEFAULT NULL,
  `TimeEnd` char(8) DEFAULT NULL,
  `Tservice` varchar(8) DEFAULT NULL,
  `TWservice` varchar(8) DEFAULT NULL,
  `TSLAservice` varchar(8) DEFAULT NULL,
  `TOverSLA` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409';

--
-- Dumping data untuk tabel `transactioncust`
--

INSERT INTO `transactioncust` (`BaseDt`, `SeqNumber`, `TrxDesc`, `TimeTicket`, `TimeCall`, `CustWaitDuration`, `UnitServe`, `CounterNo`, `Absent`, `UserId`, `Flag`, `TimeEnd`, `Tservice`, `TWservice`, `TSLAservice`, `TOverSLA`) VALUES
('20210605', 'A001', '1111', '21:50:07', '22:22:28', '00:32:21', 'A', '02', 'N', 'teller1', 'N', '22:22:39', '00:00:03', '00:00:06', '00:05:00', '00:00:00'),
('20210605', 'A002', 'Antrian Te', '21:51:03', '22:28:20', '00:37:17', 'A', '02', 'N', 'teller1', 'N', '22:28:26', '00:00:04', NULL, NULL, NULL),
('20210605', 'A003', 'Antrian Te', '21:52:35', '22:29:01', '00:36:26', 'A', '02', 'N', 'teller1', 'N', '22:29:12', '00:00:02', NULL, NULL, NULL),
('20210607', 'A001', '1113', '23:43:41', '23:49:41', '00:06:00', 'A', '02', 'N', 'teller1', 'N', '23:49:52', '00:00:04', '00:00:06', '00:06:00', '00:00:00'),
('20210607', 'A002', '1115', '23:45:25', '23:50:32', '00:05:07', 'A', '02', 'N', 'teller1', 'N', '23:50:46', '00:00:04', '00:00:09', '00:10:00', '00:00:00'),
('20210608', 'A001', 'Antrian Te', '00:14:29', '00:15:19', '00:00:50', 'A', '02', 'N', 'teller1', 'N', '00:15:31', '00:00:00', NULL, NULL, NULL),
('20210608', 'A002', 'Antrian Te', '00:14:41', '00:15:47', '00:01:06', 'A', '02', 'N', 'teller1', 'N', '00:16:37', '00:00:37', NULL, NULL, NULL),
('20210829', 'B001', '2222', '20:39:24', '20:44:31', '00:05:07', 'B', '02', 'N', 'CS1', 'N', '20:44:47', '00:00:03', '00:00:12', '00:05:00', '00:00:00'),
('20210829', 'B002', '2222', '20:41:15', '20:45:08', '00:03:53', 'B', '02', 'N', 'CS1', 'R', '20:45:20', '00:00:01', '00:00:07', '00:05:00', '00:00:00'),
(NULL, NULL, '2222', NULL, '20:45:50', '00:04:35', 'B', '02', 'N', 'CS1', 'R', '20:45:59', '00:00:01', '00:00:02', '00:05:00', '00:00:00'),
('20210829', 'B003', '2222', '20:41:30', '20:46:53', '00:05:23', 'B', '02', 'N', 'CS1', 'N', '20:47:00', '00:00:04', '00:00:02', '00:05:00', '00:00:00'),
('20210829', 'B004', '2222', '20:41:33', '20:49:23', '00:07:50', 'B', '02', 'N', 'CS1', 'N', '20:49:33', '00:00:01', '00:00:07', '00:05:00', '00:00:00'),
('20240330', 'A001', '1111', '23:12:36', '23:13:55', '0:01:19', 'A', '02', 'N', 'teller1', 'N', '23:14:08', '00:00:01', '00:00:10', '00:05:00', '00:00:00'),
('20240330', 'A002', '1111', '23:12:49', '23:17:10', '0:04:21', 'A', '02', 'N', 'teller1', 'N', '23:17:21', '00:00:01', '00:00:09', '00:05:00', '00:00:00'),
(NULL, NULL, '2222', NULL, '23:25:14', '0:12:28', 'B', '02', 'N', 'cs1', 'R', '23:26:22', '00:00:48', '00:00:17', '00:05:00', '00:00:00'),
('20240330', 'B002', '2222', '23:12:50', '23:26:25', '0:13:35', 'B', '02', 'N', 'cs1', 'N', '23:26:36', '00:00:00', '00:00:10', '00:05:00', '00:00:00'),
('20240421', 'A001', '1111', '19:42:42', '19:45:24', '0:02:42', 'A', '02', 'N', 'TELLER1', 'N', '19:45:34', '00:00:01', '00:00:08', '00:05:00', '00:00:00'),
('20240421', 'A002', '1111', '19:42:46', '19:45:38', '0:02:52', 'A', '02', 'N', 'TELLER1', 'N', '19:45:46', '00:00:00', '00:00:07', '00:05:00', '00:00:00'),
('20240421', 'B001', '2222', '19:42:44', '19:49:03', '0:06:19', 'B', '02', 'N', 'CS1', 'N', '19:49:11', '00:00:01', '00:00:06', '00:05:00', '00:00:00'),
('20240421', 'B002', '2222', '19:42:48', '19:49:14', '0:06:26', 'B', '02', 'N', 'CS1', 'N', '19:54:23', '00:00:05', '00:05:02', '00:05:00', '00:00:00'),
('20240421', 'B003', '2222', '19:42:50', '19:54:33', '0:11:43', 'B', '02', 'N', 'CS1', 'N', '19:54:41', '00:00:00', '00:00:06', '00:05:00', '00:00:00'),
('20240421', 'B004', '2222', '19:42:52', '19:59:01', '0:16:09', 'B', '02', 'N', 'CS1', 'N', '20:05:44', '00:00:00', '00:06:41', '00:05:00', '00:00:00'),
('20240423', 'A001', '1111', '20:40:51', '20:41:25', '0:00:34', 'A', '02', 'N', 'Teller1', 'N', '20:41:42', '00:00:00', '00:00:14', '00:05:00', '00:00:00'),
('20240428', 'A001', '1111', '19:43:08', '19:57:28', '0:14:20', 'A', '02', 'N', 'TELLER1', 'N', '20:02:27', '00:00:01', '00:04:58', '00:05:00', '00:00:00'),
('20240428', 'A002', '1111', '19:43:12', '20:02:30', '0:19:18', 'A', '02', 'N', 'TELLER1', 'N', '20:02:40', '00:00:00', '00:00:09', '00:05:00', '00:00:00'),
('20240428', 'A003', '1111', '19:43:13', '20:06:52', '0:23:39', 'A', '02', 'N', 'TELLER1', 'N', '20:07:01', '00:00:01', '00:00:05', '00:05:00', '00:00:00'),
('20240428', 'A004', '1111', '19:43:15', '20:07:04', '0:23:49', 'A', '02', 'N', 'TELLER1', 'N', '20:08:38', '00:00:01', '00:01:32', '00:05:00', '00:00:00'),
('20240505', 'A001', '1111', '16:51:16', '16:51:36', '0:00:20', 'A', '02', 'N', 'teller1', 'N', '16:51:55', '00:00:01', '00:00:15', '00:05:00', '00:00:00'),
('20240505', 'A002', '1111', '16:51:20', '16:55:29', '0:04:09', 'A', '02', 'N', 'teller1', 'N', '16:55:37', '00:00:01', '00:00:05', '00:05:00', '00:00:00'),
('20240505', 'B001', '2222', '16:51:18', '21:24:39', '4:33:21', 'B', '02', 'N', 'cs1', 'N', '21:30:03', '00:05:21', '00:00:01', '00:05:00', '0:00:21'),
('20240505', 'B002', '2222', '16:51:19', '21:30:06', '4:38:47', 'B', '02', 'N', 'cs1', 'N', '21:30:10', '00:00:00', '00:00:02', '00:05:00', '00:00:00'),
('20240512', 'A001', '1111', '15:13:07', '15:13:41', '00:00:34', 'A', '02', 'N', 'teller1', 'N', '15:13:48', '00:00:00', '00:00:05', '00:05:00', '00:00:00'),
('20240512', 'A002', '1111', '15:13:13', '15:13:51', '00:00:38', 'A', '02', 'N', 'teller1', 'N', '15:14:00', '00:00:00', '00:00:07', '00:05:00', '00:00:00'),
('20240512', 'A003', '1111', '15:13:16', '15:14:03', '00:00:47', 'A', '02', 'N', 'teller1', 'N', '15:14:12', '00:00:07', '00:00:00', '00:05:00', '00:00:00'),
('20240512', 'A004', '1111', '15:13:19', '18:13:31', '03:00:12', 'A', '02', 'N', 'teller1', 'N', '18:13:43', '00:00:01', '00:00:09', '00:05:00', '00:00:00'),
('20240512', 'A005', '1111', '15:13:22', '18:14:05', '03:00:43', 'A', '02', 'N', 'teller1', 'N', '18:14:17', '00:00:01', '00:00:08', '00:05:00', '00:00:00'),
('20240512', 'A006', '1111', '18:59:58', '19:00:33', '00:00:35', 'A', '02', 'N', 'teller1', 'N', '19:00:47', '00:00:05', '00:00:07', '00:05:00', '00:00:00'),
('20240512', 'A007', '1111', '19:00:05', '19:00:49', '00:00:44', 'A', '02', 'N', 'teller1', 'N', '19:01:00', '00:00:10', '00:00:00', '00:05:00', '00:00:00'),
('20240512', 'A008', '1111', '19:00:08', '19:01:03', '00:00:55', 'A', '02', 'N', 'teller1', 'N', '19:01:17', '00:00:12', '00:00:01', '00:05:00', '00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trxparam`
--

DROP TABLE IF EXISTS `trxparam`;
CREATE TABLE IF NOT EXISTS `trxparam` (
  `TrxCode` char(4) NOT NULL,
  `TrxName` varchar(30) DEFAULT NULL,
  `UnitService` varchar(2) DEFAULT NULL,
  `Tservice` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`TrxCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `trxparam`
--

INSERT INTO `trxparam` (`TrxCode`, `TrxName`, `UnitService`, `Tservice`) VALUES
('1111', 'SETOR TELLER', '01', '00:05:00'),
('1112', 'PENGAMBILAN TELLER', '01', '00:05:00'),
('1113', 'KLIRING', '01', '00:06:00'),
('1114', 'TRANSFER VIA TELLER', '01', '00:07:00'),
('1115', 'LAIN LAIN', '01', '00:10:00'),
('2221', 'BUKA TABUNGAN', '02', '00:15:00'),
('2222', 'BUKA INTERNET BANKING', '02', '00:10:00'),
('2223', 'BUKA DEPOSITO', '02', '00:15:00'),
('2224', 'GANTI ATM', '02', '00:05:00'),
('2225', 'BLOKIR REKEKNING', '02', '00:08:00'),
('2226', 'KLOMPLAIN NASABAH', '02', '00:15:00'),
('3001', 'TARIK TUNAI', '03', '00:05:00'),
('3002', 'SETOR TUNAI', '03', '00:06:00'),
('3003', 'PINDAH BUKU', '03', '00:10:00'),
('3004', 'RTGS', '03', '00:10:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `userlog`
--

DROP TABLE IF EXISTS `userlog`;
CREATE TABLE IF NOT EXISTS `userlog` (
  `UserID` varchar(10) DEFAULT NULL,
  `BaseDT` date DEFAULT NULL,
  `TimeDT` varchar(8) DEFAULT NULL,
  `Activity` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `userlog`
--

INSERT INTO `userlog` (`UserID`, `BaseDT`, `TimeDT`, `Activity`) VALUES
('teller', '2021-06-05', '05:06:21', 'User Tdk Ada'),
('teller1', '2021-06-05', '05:06:08', 'Login berhasil'),
('teller1', '2021-06-05', '05:06:17', 'Login berhasil'),
('teller1', '2021-06-05', '05:06:25', 'Login berhasil'),
('teller', '2021-06-05', '05:06:14', 'Login gagal'),
('teller1', '2021-06-05', '05:06:17', 'Login berhasil'),
('teller1', '2021-06-05', '05:06:39', 'Login berhasil'),
('teller1', '2021-06-07', '07:06:33', 'Login berhasil'),
('teller1', '2021-06-08', '08:06:16', 'Login berhasil'),
('TELLER', '2021-08-29', '29:08:58', 'User Tdk Ada'),
('TLR', '2021-08-29', '29:08:09', 'User Tdk Ada'),
('CS', '2021-08-29', '29:08:15', 'User Tdk Ada'),
('CS1', '2021-08-29', '29:08:22', 'Login berhasil'),
('TLR1', '2021-08-29', '29:08:41', 'User Tdk Ada'),
('TL1', '2021-08-29', '29:08:46', 'User Tdk Ada'),
('CS1', '2021-08-29', '29:08:50', 'Login berhasil'),
('CS1', '2021-08-29', '29:08:07', 'Login berhasil'),
('teller', '2023-01-21', '21:01:30', 'User Tdk Ada'),
('teller1', '2023-01-21', '21:01:07', 'Login berhasil'),
('teller1', '2023-01-21', '21:01:11', 'Login berhasil'),
('teller1', '2023-01-21', '21:01:30', 'Login berhasil'),
('teller1', '2023-01-21', '21:01:05', 'Login berhasil'),
('teller1', '2023-01-21', '21:01:47', 'Login berhasil'),
('teller', '2024-03-30', '30:03:11', 'User Tdk Ada'),
('teller1', '2024-03-30', '30:03:48', 'Login berhasil'),
('teller1', '2024-03-30', '30:03:45', 'Login berhasil'),
('cs1', '2024-03-30', '30:03:08', 'Login berhasil'),
('admin', '2024-04-21', '21:04:27', 'Login Berhasil'),
('admin', '2024-04-21', '21:04:23', 'Login Berhasil'),
('ADMIN', '2024-04-21', '21:04:57', 'Login Berhasil'),
('TELLER1', '2024-04-21', '21:04:41', 'Login berhasil'),
('CS1', '2024-04-21', '21:04:02', 'Login berhasil'),
('Teller1', '2024-04-23', '23:04:22', 'Login berhasil'),
('master', '2024-04-28', '28:04:43', 'Login Berhasil'),
('TELLER1', '2024-04-28', '28:04:55', 'Login berhasil'),
('admin', '2024-04-28', '28:04:56', 'Login Berhasil'),
('teller1', '2024-05-05', '05:05:43', 'Login berhasil'),
('teller1', '2024-05-05', '05:05:37', 'Login berhasil'),
('teller2', '2024-05-05', '05:05:05', 'Login berhasil'),
('teller1', '2024-05-05', '05:05:23', 'Login berhasil'),
('teller1', '2024-05-05', '05:05:39', 'Login berhasil'),
('teller1', '2024-05-05', '05:05:44', 'Login berhasil'),
('teller1', '2024-05-05', '05:05:25', 'Login berhasil'),
('teller1', '2024-05-05', '05:05:32', 'Login berhasil'),
('teller1', '2024-05-05', '05:05:25', 'Login berhasil'),
('teller1', '2024-05-05', '05:05:52', 'Login berhasil'),
('teller1', '2024-05-05', '05:05:51', 'Login berhasil'),
('teller1', '2024-05-05', '05:05:14', 'Login berhasil'),
('cs1', '2024-05-05', '05:05:32', 'Login berhasil'),
('teller1', '2024-05-12', '12:05:46', 'Login berhasil'),
('teller1', '2024-05-12', '12:05:25', 'Login berhasil'),
('teller1', '2024-05-12', '12:05:26', 'Login berhasil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 'Super Admin', 'superadmin@mail.com', NULL, '$2y$10$N38IvtJiXT6hVpNk15UIi.c3EkSn3iks2xScBdITg30viLWYE9KEu', 'superadmin', NULL, '2024-05-12 01:09:00', '2024-05-12 01:09:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_off`
--

DROP TABLE IF EXISTS `user_off`;
CREATE TABLE IF NOT EXISTS `user_off` (
  `BaseDt` varchar(8) DEFAULT NULL,
  `UserId` varchar(10) DEFAULT NULL,
  `Time_Off` varchar(8) DEFAULT NULL,
  `Date_Off` varchar(8) DEFAULT NULL,
  `Time_End` varchar(8) DEFAULT NULL,
  `Date_End` varchar(8) DEFAULT NULL,
  `Unit_Code` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_off`
--

INSERT INTO `user_off` (`BaseDt`, `UserId`, `Time_Off`, `Date_Off`, `Time_End`, `Date_End`, `Unit_Code`) VALUES
('20120704', 'teller', '01:46:37', '20120704', '01:50:12', '20120704', '01'),
('20120704', 'teller', '01:48:11', '20120704', '01:50:12', '20120704', '01'),
('20120704', 'teller', '01:48:38', '20120704', '01:50:12', '20120704', '01'),
('20120704', 'teller', '01:49:46', '20120704', '01:50:12', '20120704', '01'),
('20120704', 'teller', '01:50:16', '20120704', '01:50:25', '20120704', '01'),
('20120704', 'teller', '01:51:37', '20120704', '01:51:40', '20120704', '01'),
('20120704', 'teller', '01:52:15', '20120704', '01:52:16', '20120704', '01'),
('20120704', 'teller', '01:52:19', '20120704', '01:52:20', '20120704', '01'),
('20120704', 'teller', '03:31:52', '20120704', '03:32:01', '20120704', '01'),
('20120704', 'teller', '03:40:11', '20120704', '03:40:34', '20120704', '01'),
('20120704', 'teller', '03:41:43', '20120704', '03:42:10', '20120704', '01'),
('20120704', 'teller', '03:44:02', '20120704', '03:44:14', '20120704', '01'),
('20120704', 'teller', '03:44:19', '20120704', '03:44:26', '20120704', '01'),
('20120704', 'teller', '03:46:31', '20120704', '03:46:38', '20120704', '01'),
('20120705', 'master', '21:52:01', '20120705', '21:52:09', '20120705', '01'),
('20120705', 'master', '22:51:13', '20120705', '22:51:19', '20120705', '01'),
('20121116', 'teller', '22:57:11', '20121116', '22:57:18', '20121116', '01'),
('20121117', 'teller', '01:24:00', '20121117', '01:24:08', '20121117', '01'),
('20121117', 'master', '01:24:49', '20121117', '01:29:39', '20121117', '01'),
('20121117', 'master', '01:29:30', '20121117', '01:29:39', '20121117', '01'),
('20121117', 'master', '01:30:05', '20121117', '01:30:11', '20121117', '01'),
('20121117', 'tellerp', '01:30:26', '20121117', '01:30:29', '20121117', '03'),
('20121117', 'teller', '01:44:47', '20121117', '01:44:51', '20121117', '01'),
('20121117', 'teller', '01:56:28', '20121117', '01:56:32', '20121117', '01'),
('20121120', 'TELLER', '19:45:44', '20121120', '19:46:12', '20121120', '01'),
('20130105', 'teller', '16:59:04', '20130105', '16:59:09', '20130105', '01'),
('20161104', 'cs', '23:59:21', '20161104', '23:59:28', '20161104', '02'),
('20170205', 'cs', '15:23:19', '20170205', '15:23:23', '20170205', '02'),
('20170917', 'teller', '08:06:57', '20170917', '08:07:02', '20170917', '01'),
('20180525', 'TELLER', '01:13:43', '20180525', '23:21:10', '20180526', '01'),
('20180526', 'teller', '23:21:06', '20180526', '23:21:10', '20180526', '01'),
('20200926', 'teller', '23:15:36', '20200926', '23:15:42', '20200926', '01'),
('20201110', 'QS3', '21:55:39', '20201110', '21:55:52', '20201110', '03'),
('20201110', 'QS3', '21:56:00', '20201110', '21:56:25', '20201110', '03'),
('20210215', 'cs1', '14:53:49', '20210215', '14:53:54', '20210215', '02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `work_time`
--

DROP TABLE IF EXISTS `work_time`;
CREATE TABLE IF NOT EXISTS `work_time` (
  `kode` int UNSIGNED NOT NULL,
  `dayname` varchar(10) DEFAULT NULL,
  `start_job` varchar(8) DEFAULT NULL,
  `start_rest` varchar(8) DEFAULT NULL,
  `end_rest` varchar(8) DEFAULT NULL,
  `end_job` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `work_time`
--

INSERT INTO `work_time` (`kode`, `dayname`, `start_job`, `start_rest`, `end_rest`, `end_job`) VALUES
(1, 'SENIN', '08:00:00', '12:00:00', '13:00:00', '15:00:00'),
(2, 'SELASA', '08:00:00', '12:00:00', '13:00:00', '15:00:00'),
(3, 'RABU', '08:00:00', '12:00:00', '13:00:00', '15:00:00'),
(4, 'KAMIS', '08:00:00', '12:00:00', '13:00:00', '15:00:00'),
(5, 'JUMAT', '08:00:00', '12:00:00', '13:00:00', '15:00:00'),
(6, 'SABTU', '08:00:00', '12:00:00', '13:00:00', '15:00:00'),
(7, 'MINGGU', '00:08:00', '12:00:00', '13:00:00', '15:00:00');

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
