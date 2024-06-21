/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 8.2.0 : Database - qbri_2_new
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`qbri_2_new` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `qbri_2_new`;

/*Table structure for table `codeservice` */

DROP TABLE IF EXISTS `codeservice`;

CREATE TABLE `codeservice` (
  `Name` varchar(20) DEFAULT NULL,
  `Initial` char(1) NOT NULL DEFAULT '',
  `CurrentQNo` smallint DEFAULT NULL,
  `last_queue` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`Initial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409';

/*Data for the table `codeservice` */

insert  into `codeservice`(`Name`,`Initial`,`CurrentQNo`,`last_queue`) values 
('TlUmum','A',2,2),
('CSUmum','B',1,0),
('QService','C',0,0);

/*Table structure for table `currency` */

DROP TABLE IF EXISTS `currency`;

CREATE TABLE `currency` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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

/*Data for the table `currency` */

/*Table structure for table `deposito` */

DROP TABLE IF EXISTS `deposito`;

CREATE TABLE `deposito` (
  `nomor` int unsigned NOT NULL,
  `Tier` varchar(20) DEFAULT NULL,
  `Tenor1` varchar(5) DEFAULT NULL,
  `Tenor3` varchar(5) DEFAULT NULL,
  `Tenor6` varchar(5) DEFAULT NULL,
  `Tenor12` varchar(5) DEFAULT NULL,
  `Tenor24` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `deposito` */

insert  into `deposito`(`nomor`,`Tier`,`Tenor1`,`Tenor3`,`Tenor6`,`Tenor12`,`Tenor24`) values 
(1,'<50jt','4.5','4.5','5.0','5.25','5.25'),
(2,'>=50 jt - <100jt','4.5','4.5','5.0','5.25','5.25'),
(3,'>=100jt - <500jt','4.5','4.75','5.25','5.25','5.25'),
(4,'>=500jt - <1M','4.5','4.75','5.25','5.5','5.4'),
(5,'>=1M - <5M','4.75','5.0','5.5','5.5','5.5'),
(6,'>=5M - <10M','4.75','5.0','5.5','5.5','5.5'),
(7,'>=10M','4.75','5.0','5.5','5.5','5.5');

/*Table structure for table `exchange_rate` */

DROP TABLE IF EXISTS `exchange_rate`;

CREATE TABLE `exchange_rate` (
  `Code` int unsigned NOT NULL,
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

/*Data for the table `exchange_rate` */

insert  into `exchange_rate`(`Code`,`ShortName`,`FullName`,`Buy`,`Sell`,`TBuy`,`TSell`,`LastUpdate`,`Flag`,`Userid`) values 
(1,'USD','Dollar Amerika',9015,9235,9025,9225,'2012-07-05 22:48:32','A','master'),
(2,'SGD','Dollar Singapore',7016,7204,7036,7194,'2012-07-05 22:33:49','A','teller'),
(3,'EUR','Euro',12155,12423,12185,12408,'2020-09-13 19:57:09','A','teller'),
(5,'JPY','Japanese Yen',115.07,119.12,116.02,118.62,'2012-03-01 22:59:53','A','teller'),
(6,'MYR','Ringgit Malaysia',3100,3200,3500,3600,'2012-11-16 21:33:38','A','teller');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
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

/*Data for the table `failed_jobs` */

/*Table structure for table `font_colors` */

DROP TABLE IF EXISTS `font_colors`;

CREATE TABLE `font_colors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `font_colors` */

insert  into `font_colors`(`id`,`name`,`value`,`created_at`,`updated_at`) values 
(1,'unit_name',NULL,NULL,'2024-05-19 12:25:49'),
(2,'current_queue',NULL,NULL,'2024-05-19 12:25:48'),
(3,'first_log',NULL,NULL,'2024-05-19 12:25:47'),
(4,'second_log',NULL,NULL,'2024-05-19 12:25:46'),
(5,'watch',NULL,NULL,'2024-05-19 02:21:06'),
(6,'footer_text',NULL,NULL,'2024-05-19 12:25:44'),
(8,'kios_footer_text_color','#7deb0f','2024-05-24 06:20:48','2024-05-24 07:40:30');

/*Table structure for table `footer_texts` */

DROP TABLE IF EXISTS `footer_texts`;

CREATE TABLE `footer_texts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show` tinyint(1) NOT NULL DEFAULT '0',
  `display_number` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'console',
  PRIMARY KEY (`id`),
  UNIQUE KEY `footer_texts_display_number_type_unique` (`display_number`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `footer_texts` */

insert  into `footer_texts`(`id`,`text`,`show`,`display_number`,`created_at`,`updated_at`,`type`) values 
(1,'Selamat datang ke BRI',1,1,'2024-05-12 11:25:40','2024-05-12 11:25:40','console'),
(2,'Ini adalah aplikasi untuk antrian di BRI',1,2,'2024-05-12 11:25:53','2024-05-12 11:25:53','console'),
(4,'ini dari ke dua ya',0,1,'2024-05-24 05:58:28','2024-05-24 06:02:56','kios'),
(6,'Ditampilkan',1,4,'2024-05-24 06:03:05','2024-05-24 06:03:05','kios');

/*Table structure for table `grafik` */

DROP TABLE IF EXISTS `grafik`;

CREATE TABLE `grafik` (
  `code` varchar(1) NOT NULL,
  `Desc` varchar(15) DEFAULT NULL,
  `jumlah` int unsigned DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `grafik` */

insert  into `grafik`(`code`,`Desc`,`jumlah`) values 
('0','Achieved',23),
('1','Not Achieved',1);

/*Table structure for table `groupproduk` */

DROP TABLE IF EXISTS `groupproduk`;

CREATE TABLE `groupproduk` (
  `IdGroup` int unsigned NOT NULL AUTO_INCREMENT,
  `DescGroup` varchar(17) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `updatetgl` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IdGroup`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `groupproduk` */

insert  into `groupproduk`(`IdGroup`,`DescGroup`,`status`,`updatetgl`) values 
(1,'BRITAMA (RP)','A','12-08-2018 00:17:23'),
(2,'BRITAMA (USD)','N','12-08-2018 00:17:23'),
(3,'GIRO (RP)','N','12-08-2018 00:17:23'),
(4,'SIMPEDES','N','12-08-2018 00:17:23'),
(5,'DEPOSITO','N','12-08-2018 00:17:23'),
(6,'TABUNGANKU','N','12-08-2018 00:17:23'),
(7,'PENJAMINAN (RP)','N','12-08-2018 00:17:23'),
(8,'PENJAMINAN (USD)','N','12-08-2018 00:17:23');

/*Table structure for table `master_products` */

DROP TABLE IF EXISTS `master_products`;

CREATE TABLE `master_products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_number` int NOT NULL DEFAULT '0',
  `show` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `master_products_id_display_number_unique` (`id`,`display_number`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `master_products` */

insert  into `master_products`(`id`,`name`,`display_number`,`show`,`created_at`,`updated_at`) values 
(1,'BRITAMA (RP)',1,1,'2024-05-12 08:09:00','2024-05-12 08:09:00'),
(2,'BRITAMA (USD)',2,0,'2024-05-12 08:09:00','2024-05-12 16:08:52'),
(3,'GIRO (RP)',3,0,'2024-05-12 08:09:00','2024-05-12 16:08:56'),
(4,'SIMPEDES',4,0,'2024-05-12 08:09:00','2024-05-12 16:09:01'),
(5,'DEPOSITO',5,0,'2024-05-12 08:09:00','2024-05-12 16:09:07'),
(6,'TABUNGANKU',6,0,'2024-05-12 08:09:00','2024-05-12 16:09:11'),
(7,'PENJAMINAN (RP)',7,0,'2024-05-12 08:09:00','2024-05-12 16:09:18'),
(8,'PENJAMINAN (USD)',8,0,'2024-05-12 08:09:00','2024-05-12 16:09:23');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2024_05_01_073021_create_master_product_table',1),
(6,'2024_05_01_073843_create_product_detail_table',1),
(7,'2024_05_02_132902_create_currency_table',1),
(8,'2024_05_04_074614_create_properties_table',1),
(9,'2024_05_10_205703_create_table_footer_text',1),
(10,'2024_05_12_054249_add_footer_flow_to_properties',1),
(13,'2024_05_18_160915_create_font_colors_table',2),
(16,'2024_05_24_051625_add_type_to_footer_text',3),
(17,'2024_05_24_052850_change_uniq_on_footer_text',4),
(18,'2024_05_24_062731_add_kios_footer_f_low',5),
(19,'2024_05_24_064452_add_printer_name_to_properties',6);

/*Table structure for table `mmedia` */

DROP TABLE IF EXISTS `mmedia`;

CREATE TABLE `mmedia` (
  `Seq` int NOT NULL,
  `FileName` char(40) DEFAULT NULL,
  `FileExt` char(3) DEFAULT NULL,
  `FileLocation` char(100) DEFAULT NULL,
  PRIMARY KEY (`Seq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 102';

/*Data for the table `mmedia` */

insert  into `mmedia`(`Seq`,`FileName`,`FileExt`,`FileLocation`) values 
(1,'KPR','mpg','C:\\FilmQueing'),
(2,'BII','mpg','C:\\FilmQueing');

/*Table structure for table `originationcust` */

DROP TABLE IF EXISTS `originationcust`;

CREATE TABLE `originationcust` (
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
  `is_queue_online` int NOT NULL DEFAULT '0' COMMENT 'Online/Offline queue',
  PRIMARY KEY (`SeqDt`,`BaseDt`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409';

/*Data for the table `originationcust` */

insert  into `originationcust`(`BaseDt`,`SeqNumber`,`UnitServe`,`TimeTicket`,`TimeCall`,`WaitDuration`,`Flag`,`SeqDt`,`DescTransaksi`,`UnitCall`,`code_trx`,`SLA_Trx`,`is_queue_online`) values 
('20240621','A1','A','22:44:36','22:46:45','00:02:09','N',24,'Antrian Teller','A','1112','00:05:00',0),
('20240621','B1','B','22:45:05',NULL,NULL,'P',25,'Antrian CS','B','2226','00:59:00',0),
('20240621','A002','A','22:45:53','22:48:03','00:02:10','N',26,'Antrian Teller','A','1111','00:05:00',0),
('20240621','A002','A','22:46:04','22:48:03','00:02:10','N',27,'Antrian Teller','A','1112','00:05:00',0),
('20240621','A002','A','22:48:20',NULL,NULL,'N',28,'Antrian Teller','A','1111','00:05:00',0);

/*Table structure for table `password` */

DROP TABLE IF EXISTS `password`;

CREATE TABLE `password` (
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
  `salah` int unsigned NOT NULL DEFAULT '0',
  `locked` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 307';

/*Data for the table `password` */

insert  into `password`(`branchcode`,`UserName`,`UserID`,`UsrLevel`,`Unit`,`Status`,`TRXCode`,`TRXStart`,`SLAtrx`,`TRXEnd`,`pasword`,`salah`,`locked`) values 
('000','ADMINISTRATOR','ADMIN','AD','00','N','0000','00:00:00','00:00:00','00:00:00','e10adc3949ba59abbe56e057f20f883e',0,'N'),
('000','CS1','CS1','OP','02','N','0000','00:00:00','00:00:00','00:00:00','e10adc3949ba59abbe56e057f20f883e',0,'N'),
('000','CS2','CS2','OP','02','N','0000','00:00:00','00:00:00','00:00:00','e10adc3949ba59abbe56e057f20f883e',0,'N'),
('000','CS3','CS3','OP','02','N','0000','00:00:00','00:00:00','00:00:00','e10adc3949ba59abbe56e057f20f883e',0,'N'),
('000','MASTER','MASTER','AD','00','N','0000','00:00:00','00:00:00','00:00:00','e10adc3949ba59abbe56e057f20f883e',0,'N'),
('000','QS1','QS1','OP','03','N','0000','00:00:00','00:00:00','00:00:00','e10adc3949ba59abbe56e057f20f883e',0,'N'),
('000','QS2','QS2','OP','03','N','0000','00:00:00','00:00:00','00:00:00','e10adc3949ba59abbe56e057f20f883e',0,'N'),
('000','QS3','QS3','OP','03','N','0000','00:00:00','00:00:00','00:00:00','e10adc3949ba59abbe56e057f20f883e',0,'N'),
('000','TELLER1','TELLER1','OP','01','N','1111','22:48:33','00:05:00','22:53:33','e10adc3949ba59abbe56e057f20f883e',0,'N'),
('000','TELLER2','TELLER2','OP','01','N','0000','00:00:00','00:00:00','00:00:00','e10adc3949ba59abbe56e057f20f883e',0,'N'),
('000','TELLER3','TELLER3','OP','01','N','0000','00:00:00','00:00:00','00:00:00','e10adc3949ba59abbe56e057f20f883e',0,'N');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
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

/*Data for the table `personal_access_tokens` */

/*Table structure for table `picture` */

DROP TABLE IF EXISTS `picture`;

CREATE TABLE `picture` (
  `seq` int unsigned NOT NULL AUTO_INCREMENT,
  `FileName` varchar(45) DEFAULT NULL,
  `FileExt` varchar(3) DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `picture` */

insert  into `picture`(`seq`,`FileName`,`FileExt`,`Location`) values 
(1,'Britama','jpg','D:\\My Proyek\\BRI\\QTombol\\Images'),
(2,'Top Brand bri','jpg','D:\\My Proyek\\BRI\\QTombol\\Hanya gambar saja\\Images');

/*Table structure for table `product_detail` */

DROP TABLE IF EXISTS `product_detail`;

CREATE TABLE `product_detail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `master_product_id` bigint unsigned NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suku_bunga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_number` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_detail_display_number_master_product_id_unique` (`display_number`,`master_product_id`),
  KEY `product_detail_master_product_id_foreign` (`master_product_id`),
  CONSTRAINT `product_detail_master_product_id_foreign` FOREIGN KEY (`master_product_id`) REFERENCES `master_products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_detail` */

insert  into `product_detail`(`id`,`master_product_id`,`value`,`suku_bunga`,`display_number`,`created_at`,`updated_at`) values 
(1,1,'1','3 %',1,'2024-05-12 16:06:44','2024-05-12 16:06:44'),
(2,1,'500 ->2000','3 %',2,'2024-05-12 16:06:51','2024-05-12 16:06:51'),
(3,1,'3','1000 %',3,'2024-05-12 16:07:00','2024-05-12 16:07:00'),
(4,1,'seratus','3',4,'2024-05-12 16:07:12','2024-05-12 16:07:12'),
(5,1,'1111','1',5,'2024-05-12 16:07:21','2024-05-12 16:07:21'),
(6,1,'10101','34e4e4e',6,'2024-05-12 16:07:40','2024-05-12 16:07:40'),
(7,1,'23232','1111111',7,'2024-05-12 16:07:49','2024-05-12 16:07:49');

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `GroupID` int unsigned DEFAULT NULL,
  `nourut` int unsigned DEFAULT NULL,
  `keterangan` varchar(25) DEFAULT NULL,
  `rate` varchar(5) DEFAULT NULL,
  `ID` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Data for the table `produk` */

insert  into `produk`(`GroupID`,`nourut`,`keterangan`,`rate`,`ID`) values 
(1,1,'500 RIBU - 5 JUTA','3',1),
(1,2,'> 5 JUTA - 50 JUTA','14',2),
(1,3,'> 50 JUTA - 100 JUTA','15',3),
(1,4,'> 100 JUTA - 1 MILYAR','24',4),
(1,5,'> 1 MILYAR','3',5),
(2,1,'> $50 - $1000','3',6),
(2,2,'> $1000 - $10.000','14',7),
(2,3,'> $10.000','15',8),
(3,1,'0 - < 5 JUTA','3',11),
(3,2,'5 JUTA - 25 JUTA','14',12),
(3,3,'> 25 JUTA - 100 JUTA','15',13),
(3,4,'> 100 JUTA - 1 MILYAR','24',14),
(3,5,'> 1 MILYAR','3',15),
(4,1,'0 - < 500 RIBU','3',16),
(4,2,'500 RIBU - 5 JUTA','14',17),
(4,3,'> 5 JUTA - 50 JUTA','15',18),
(4,4,'> 50 JUTA - 100 JUTA','24',19),
(4,5,'> 100 JUTA','3',20),
(5,1,'1 BULAN','3',21),
(5,2,'3 BULAN','14',22),
(5,3,'6 BULAN','15',23),
(5,4,'12 BULAN','24',24),
(5,5,'24 BULAN','3',25),
(6,1,'< 1 JUTA','15',26),
(6,2,'>= 1 JUTA ','24',27),
(7,1,'L P S','28',28),
(8,1,'L P S','28',29),
(9,1,'TEST1','12',33);

/*Table structure for table `properties` */

DROP TABLE IF EXISTS `properties`;

CREATE TABLE `properties` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(244) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_code` varchar(244) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_product` tinyint(1) NOT NULL DEFAULT '1',
  `show_currency` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `footer_flow` enum('left','right') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'right',
  `footer_flow_kios` enum('left','right') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'right',
  `printer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `properties` */

insert  into `properties`(`id`,`company_name`,`company_code`,`show_product`,`show_currency`,`created_at`,`updated_at`,`footer_flow`,`footer_flow_kios`,`printer_name`) values 
(1,'BRI UNIT COLOMADU','01972',1,1,'2024-05-12 11:26:22','2024-05-24 11:13:31','left','left','POS-76C');

/*Table structure for table `setupparam` */

DROP TABLE IF EXISTS `setupparam`;

CREATE TABLE `setupparam` (
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

/*Data for the table `setupparam` */

insert  into `setupparam`(`Code`,`BranchName`,`SoundVolume`,`ValasTime`,`TvTime`,`Timetext`,`Speedtext`,`StaticMedia`,`MediaValas`,`MediaProduk`,`MediaTV`,`MediaTarif`,`TTarif`) values 
('01','Cabang Padang','20','5','5','1000','1','N','Y','Y','N','Y','10');

/*Table structure for table `stat_console` */

DROP TABLE IF EXISTS `stat_console`;

CREATE TABLE `stat_console` (
  `tanggal` varchar(8) NOT NULL,
  `Status` varchar(1) NOT NULL,
  `ActiveDate` varchar(8) NOT NULL,
  PRIMARY KEY (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `stat_console` */

insert  into `stat_console`(`tanggal`,`Status`,`ActiveDate`) values 
('20240621','A','20240621');

/*Table structure for table `stat_counter` */

DROP TABLE IF EXISTS `stat_counter`;

CREATE TABLE `stat_counter` (
  `counter` varchar(2) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `flag` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `stat_counter` */

/*Table structure for table `temp_call` */

DROP TABLE IF EXISTS `temp_call`;

CREATE TABLE `temp_call` (
  `Counter` varchar(2) NOT NULL,
  `Unit` varchar(2) NOT NULL,
  `SeqNumber` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_call` */

/*Table structure for table `temp_call_web` */

DROP TABLE IF EXISTS `temp_call_web`;

CREATE TABLE `temp_call_web` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Counter` varchar(2) NOT NULL,
  `Unit` varchar(2) NOT NULL,
  `SeqNumber` varchar(4) NOT NULL,
  `Tampil` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'n',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `temp_call_web` */

insert  into `temp_call_web`(`id`,`Counter`,`Unit`,`SeqNumber`,`Tampil`) values 
(1,'02','A','A004','y'),
(2,'02','A','A006','y'),
(3,'02','A','A007','y'),
(4,'02','A','A1','y'),
(5,'02','A','A002','y'),
(6,'02','A','A002','y');

/*Table structure for table `textbanner` */

DROP TABLE IF EXISTS `textbanner`;

CREATE TABLE `textbanner` (
  `Seq` int NOT NULL,
  `Msg` varchar(254) DEFAULT NULL,
  `Status` varchar(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`Seq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409';

/*Data for the table `textbanner` */

insert  into `textbanner`(`Seq`,`Msg`,`Status`) values 
(2,'Hitung uang anda sebelum meninggalkan counter','A'),
(3,'Terima kasih atas kunjungan anda','A'),
(5,'Ini adalah text nomor 5','A');

/*Table structure for table `transactioncust` */

DROP TABLE IF EXISTS `transactioncust`;

CREATE TABLE `transactioncust` (
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
  `TOverSLA` varchar(8) DEFAULT NULL,
  `synced` varchar(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409';

/*Data for the table `transactioncust` */

insert  into `transactioncust`(`BaseDt`,`SeqNumber`,`TrxDesc`,`TimeTicket`,`TimeCall`,`CustWaitDuration`,`UnitServe`,`CounterNo`,`Absent`,`UserId`,`Flag`,`TimeEnd`,`Tservice`,`TWservice`,`TSLAservice`,`TOverSLA`,`synced`) values 
('20240525','A006','1111','19:24:44','19:24:50','00:00:06','A','02','N','teller1','N','19:24:58','00:00:03','00:00:01','00:05:00','00:00:00','Y'),
('20240525','A007','1111','19:33:36','19:33:43','00:00:07','A','02','N','teller1','N','19:33:50','00:00:05','00:00:00','00:05:00','00:00:00','Y'),
('20240621','A1','1112','22:44:36','22:46:45','00:02:09','A','02','N','teller1','N','22:47:57','00:00:00','00:01:10','00:05:00','00:00:00','Y'),
('20240621','A002','1111','22:45:53','22:48:03','00:02:10','A','02','N','teller1','N','22:48:09','00:00:04','00:00:00','00:05:00','00:00:00','Y');

/*Table structure for table `trxparam` */

DROP TABLE IF EXISTS `trxparam`;

CREATE TABLE `trxparam` (
  `TrxCode` char(4) NOT NULL,
  `TrxName` varchar(30) DEFAULT NULL,
  `UnitService` varchar(2) DEFAULT NULL,
  `Tservice` varchar(8) DEFAULT NULL,
  `displayed` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`TrxCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `trxparam` */

insert  into `trxparam`(`TrxCode`,`TrxName`,`UnitService`,`Tservice`,`displayed`) values 
('1111','SETOR TELLER','01','00:05:00',1),
('1112','PENGAMBILAN TELLER','01','00:05:00',1),
('1113','KLIRING','01','00:06:00',1),
('1114','TRANSFER VIA TELLER','01','00:07:00',1),
('1115','LAIN LAIN','01','00:10:00',1),
('1234','apa aja','02','00:01:00',1),
('2221','BUKA TABUNGAN','02','00:15:00',1),
('2222','BUKA INTERNET BANKING','02','00:10:00',1),
('2223','BUKA DEPOSITO','02','00:15:00',1),
('2224','GANTI ATM','02','00:05:00',1),
('2225','BLOKIR REKENING','02','00:04:00',1),
('2226','KLOMPLAIN NASABAH','02','00:59:00',1),
('3001','TARIK TUNAI','03','00:05:00',1),
('3002','SETOR TUNAI','03','00:06:00',1),
('3003','PINDAH BUKU','03','00:10:00',1),
('3004','RTGS','03','00:10:01',1);

/*Table structure for table `user_off` */

DROP TABLE IF EXISTS `user_off`;

CREATE TABLE `user_off` (
  `BaseDt` varchar(8) DEFAULT NULL,
  `UserId` varchar(10) DEFAULT NULL,
  `Time_Off` varchar(8) DEFAULT NULL,
  `Date_Off` varchar(8) DEFAULT NULL,
  `Time_End` varchar(8) DEFAULT NULL,
  `Date_End` varchar(8) DEFAULT NULL,
  `Unit_Code` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_off` */

insert  into `user_off`(`BaseDt`,`UserId`,`Time_Off`,`Date_Off`,`Time_End`,`Date_End`,`Unit_Code`) values 
('20120704','teller','01:46:37','20120704','01:50:12','20120704','01'),
('20120704','teller','01:48:11','20120704','01:50:12','20120704','01'),
('20120704','teller','01:48:38','20120704','01:50:12','20120704','01'),
('20120704','teller','01:49:46','20120704','01:50:12','20120704','01'),
('20120704','teller','01:50:16','20120704','01:50:25','20120704','01'),
('20120704','teller','01:51:37','20120704','01:51:40','20120704','01'),
('20120704','teller','01:52:15','20120704','01:52:16','20120704','01'),
('20120704','teller','01:52:19','20120704','01:52:20','20120704','01'),
('20120704','teller','03:31:52','20120704','03:32:01','20120704','01'),
('20120704','teller','03:40:11','20120704','03:40:34','20120704','01'),
('20120704','teller','03:41:43','20120704','03:42:10','20120704','01'),
('20120704','teller','03:44:02','20120704','03:44:14','20120704','01'),
('20120704','teller','03:44:19','20120704','03:44:26','20120704','01'),
('20120704','teller','03:46:31','20120704','03:46:38','20120704','01'),
('20120705','master','21:52:01','20120705','21:52:09','20120705','01'),
('20120705','master','22:51:13','20120705','22:51:19','20120705','01'),
('20121116','teller','22:57:11','20121116','22:57:18','20121116','01'),
('20121117','teller','01:24:00','20121117','01:24:08','20121117','01'),
('20121117','master','01:24:49','20121117','01:29:39','20121117','01'),
('20121117','master','01:29:30','20121117','01:29:39','20121117','01'),
('20121117','master','01:30:05','20121117','01:30:11','20121117','01'),
('20121117','tellerp','01:30:26','20121117','01:30:29','20121117','03'),
('20121117','teller','01:44:47','20121117','01:44:51','20121117','01'),
('20121117','teller','01:56:28','20121117','01:56:32','20121117','01'),
('20121120','TELLER','19:45:44','20121120','19:46:12','20121120','01'),
('20130105','teller','16:59:04','20130105','16:59:09','20130105','01'),
('20161104','cs','23:59:21','20161104','23:59:28','20161104','02'),
('20170205','cs','15:23:19','20170205','15:23:23','20170205','02'),
('20170917','teller','08:06:57','20170917','08:07:02','20170917','01'),
('20180525','TELLER','01:13:43','20180525','23:21:10','20180526','01'),
('20180526','teller','23:21:06','20180526','23:21:10','20180526','01'),
('20200926','teller','23:15:36','20200926','23:15:42','20200926','01'),
('20201110','QS3','21:55:39','20201110','21:55:52','20201110','03'),
('20201110','QS3','21:56:00','20201110','21:56:25','20201110','03'),
('20210215','cs1','14:53:49','20210215','14:53:54','20210215','02');

/*Table structure for table `userlog` */

DROP TABLE IF EXISTS `userlog`;

CREATE TABLE `userlog` (
  `UserID` varchar(10) DEFAULT NULL,
  `BaseDT` date DEFAULT NULL,
  `TimeDT` varchar(8) DEFAULT NULL,
  `Activity` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `userlog` */

insert  into `userlog`(`UserID`,`BaseDT`,`TimeDT`,`Activity`) values 
('teller','2021-06-05','05:06:21','User Tdk Ada'),
('teller1','2021-06-05','05:06:08','Login berhasil'),
('teller1','2021-06-05','05:06:17','Login berhasil'),
('teller1','2021-06-05','05:06:25','Login berhasil'),
('teller','2021-06-05','05:06:14','Login gagal'),
('teller1','2021-06-05','05:06:17','Login berhasil'),
('teller1','2021-06-05','05:06:39','Login berhasil'),
('teller1','2021-06-07','07:06:33','Login berhasil'),
('teller1','2021-06-08','08:06:16','Login berhasil'),
('TELLER','2021-08-29','29:08:58','User Tdk Ada'),
('TLR','2021-08-29','29:08:09','User Tdk Ada'),
('CS','2021-08-29','29:08:15','User Tdk Ada'),
('CS1','2021-08-29','29:08:22','Login berhasil'),
('TLR1','2021-08-29','29:08:41','User Tdk Ada'),
('TL1','2021-08-29','29:08:46','User Tdk Ada'),
('CS1','2021-08-29','29:08:50','Login berhasil'),
('CS1','2021-08-29','29:08:07','Login berhasil'),
('teller','2023-01-21','21:01:30','User Tdk Ada'),
('teller1','2023-01-21','21:01:07','Login berhasil'),
('teller1','2023-01-21','21:01:11','Login berhasil'),
('teller1','2023-01-21','21:01:30','Login berhasil'),
('teller1','2023-01-21','21:01:05','Login berhasil'),
('teller1','2023-01-21','21:01:47','Login berhasil'),
('teller','2024-03-30','30:03:11','User Tdk Ada'),
('teller1','2024-03-30','30:03:48','Login berhasil'),
('teller1','2024-03-30','30:03:45','Login berhasil'),
('cs1','2024-03-30','30:03:08','Login berhasil'),
('admin','2024-04-21','21:04:27','Login Berhasil'),
('admin','2024-04-21','21:04:23','Login Berhasil'),
('ADMIN','2024-04-21','21:04:57','Login Berhasil'),
('TELLER1','2024-04-21','21:04:41','Login berhasil'),
('CS1','2024-04-21','21:04:02','Login berhasil'),
('Teller1','2024-04-23','23:04:22','Login berhasil'),
('master','2024-04-28','28:04:43','Login Berhasil'),
('TELLER1','2024-04-28','28:04:55','Login berhasil'),
('admin','2024-04-28','28:04:56','Login Berhasil'),
('teller1','2024-05-05','05:05:43','Login berhasil'),
('teller1','2024-05-05','05:05:37','Login berhasil'),
('teller2','2024-05-05','05:05:05','Login berhasil'),
('teller1','2024-05-05','05:05:23','Login berhasil'),
('teller1','2024-05-05','05:05:39','Login berhasil'),
('teller1','2024-05-05','05:05:44','Login berhasil'),
('teller1','2024-05-05','05:05:25','Login berhasil'),
('teller1','2024-05-05','05:05:32','Login berhasil'),
('teller1','2024-05-05','05:05:25','Login berhasil'),
('teller1','2024-05-05','05:05:52','Login berhasil'),
('teller1','2024-05-05','05:05:51','Login berhasil'),
('teller1','2024-05-05','05:05:14','Login berhasil'),
('cs1','2024-05-05','05:05:32','Login berhasil'),
('teller1','2024-05-12','12:05:46','Login berhasil'),
('teller1','2024-05-12','12:05:25','Login berhasil'),
('teller1','2024-05-12','12:05:26','Login berhasil'),
('teller01','2024-05-21','21:05:43','User Tdk Ada'),
('teller1','2024-05-21','21:05:46','Login berhasil'),
('teller1','2024-05-23','23:05:56','Login berhasil'),
('cs01','2024-05-24','24:05:24','User Tdk Ada'),
('cs1','2024-05-24','24:05:27','Login berhasil'),
('teller1','2024-05-24','24:05:45','Login berhasil'),
('teller1','2024-05-24','24:05:34','Login berhasil'),
('teller1','2024-05-25','25:05:10','Login berhasil'),
('teller1','2024-05-25','25:05:17','Login berhasil'),
('teller1','2024-05-25','25:05:04','Login berhasil'),
('teller01','2024-06-21','21:06:34','User Tdk Ada'),
('teller1','2024-06-21','21:06:37','Login berhasil');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`role`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Super Admin','superadmin@mail.com',NULL,'$2y$10$N38IvtJiXT6hVpNk15UIi.c3EkSn3iks2xScBdITg30viLWYE9KEu','superadmin',NULL,'2024-05-12 08:09:00','2024-05-12 08:09:00');

/*Table structure for table `work_time` */

DROP TABLE IF EXISTS `work_time`;

CREATE TABLE `work_time` (
  `kode` int unsigned NOT NULL,
  `dayname` varchar(10) DEFAULT NULL,
  `start_job` varchar(8) DEFAULT NULL,
  `start_rest` varchar(8) DEFAULT NULL,
  `end_rest` varchar(8) DEFAULT NULL,
  `end_job` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `work_time` */

insert  into `work_time`(`kode`,`dayname`,`start_job`,`start_rest`,`end_rest`,`end_job`) values 
(1,'SENIN','08:00:00','12:00:00','13:00:00','15:00:00'),
(2,'SELASA','08:00:00','12:00:00','13:00:00','15:00:00'),
(3,'RABU','08:00:00','12:00:00','13:00:00','15:00:00'),
(4,'KAMIS','08:00:00','12:00:00','13:00:00','15:00:00'),
(5,'JUMAT','08:00:00','12:00:00','13:00:00','15:00:00'),
(6,'SABTU','08:00:00','12:00:00','13:00:00','15:00:00'),
(7,'MINGGU','00:08:00','12:00:00','13:00:00','15:00:00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
