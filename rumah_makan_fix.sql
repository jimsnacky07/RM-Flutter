/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - rumah_makan_fix
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`rumah_makan_fix` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `rumah_makan_fix`;

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache` */

/*Table structure for table `cache_locks` */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache_locks` */

/*Table structure for table `detail_pesanans` */

DROP TABLE IF EXISTS `detail_pesanans`;

CREATE TABLE `detail_pesanans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pesanan_id` bigint(20) unsigned NOT NULL,
  `menu_id` bigint(20) unsigned NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_pesanans_pesanan_id_foreign` (`pesanan_id`),
  KEY `detail_pesanans_menu_id_foreign` (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=274 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `detail_pesanans` */

insert  into `detail_pesanans`(`id`,`pesanan_id`,`menu_id`,`jumlah`,`harga`,`subtotal`,`created_at`,`updated_at`) values 
(240,143,1,1,28000,28000.00,'2025-08-25 22:52:50','2025-08-25 22:52:50'),
(241,144,1,1,28000,28000.00,'2025-08-25 22:55:50','2025-08-25 22:55:50'),
(242,145,1,1,28000,28000.00,'2025-08-25 22:56:18','2025-08-25 22:56:18'),
(243,146,1,1,28000,28000.00,'2025-08-25 22:56:58','2025-08-25 22:56:58'),
(244,147,1,1,28000,28000.00,'2025-08-25 22:58:28','2025-08-25 22:58:28'),
(245,148,1,1,28000,28000.00,'2025-08-25 23:02:29','2025-08-25 23:02:29'),
(246,149,1,1,28000,28000.00,'2025-08-25 23:04:44','2025-08-25 23:04:44'),
(247,150,1,1,28000,28000.00,'2025-08-25 23:08:57','2025-08-25 23:08:57'),
(248,151,1,1,28000,28000.00,'2025-08-25 23:09:32','2025-08-25 23:09:32'),
(249,152,2,1,30000,30000.00,'2025-08-25 23:11:44','2025-08-25 23:11:44'),
(250,153,2,1,30000,30000.00,'2025-08-25 23:11:53','2025-08-25 23:11:53'),
(251,154,2,1,30000,30000.00,'2025-08-25 23:14:30','2025-08-25 23:14:30'),
(252,155,1,1,28000,28000.00,'2025-08-25 23:15:39','2025-08-25 23:15:39'),
(253,156,1,1,28000,28000.00,'2025-08-25 23:16:33','2025-08-25 23:16:33'),
(254,157,1,1,28000,28000.00,'2025-08-25 23:16:56','2025-08-25 23:16:56'),
(255,158,1,1,28000,28000.00,'2025-08-25 23:21:01','2025-08-25 23:21:01'),
(256,159,1,1,28000,28000.00,'2025-08-25 23:23:29','2025-08-25 23:23:29'),
(257,160,1,1,28000,28000.00,'2025-08-25 23:24:17','2025-08-25 23:24:17'),
(258,161,4,1,30000,30000.00,'2025-08-25 23:28:31','2025-08-25 23:28:31'),
(259,162,3,1,25000,25000.00,'2025-08-25 23:32:20','2025-08-25 23:32:20'),
(260,163,3,1,25000,25000.00,'2025-08-25 23:32:36','2025-08-25 23:32:36'),
(261,164,4,1,30000,30000.00,'2025-08-25 23:36:48','2025-08-25 23:36:48'),
(262,165,4,1,30000,30000.00,'2025-08-25 23:37:02','2025-08-25 23:37:02'),
(263,166,2,1,30000,30000.00,'2025-08-25 23:38:01','2025-08-25 23:38:01'),
(264,167,2,1,30000,30000.00,'2025-08-25 23:38:13','2025-08-25 23:38:13'),
(265,168,2,1,30000,30000.00,'2025-08-25 23:38:29','2025-08-25 23:38:29'),
(266,169,2,1,30000,30000.00,'2025-08-25 23:39:10','2025-08-25 23:39:10'),
(267,170,2,1,30000,30000.00,'2025-08-25 23:44:14','2025-08-25 23:44:14'),
(268,171,2,1,30000,30000.00,'2025-08-25 23:47:11','2025-08-25 23:47:11'),
(269,172,1,1,28000,28000.00,'2025-08-25 23:47:30','2025-08-25 23:47:30'),
(270,173,3,1,25000,25000.00,'2025-08-25 23:54:05','2025-08-25 23:54:05'),
(271,174,1,1,28000,28000.00,'2025-08-25 23:54:32','2025-08-25 23:54:32'),
(272,175,4,2,30000,60000.00,'2025-08-25 23:57:54','2025-08-25 23:57:54'),
(273,176,1,1,28000,28000.00,'2025-08-26 00:02:09','2025-08-26 00:02:09');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `job_batches` */

DROP TABLE IF EXISTS `job_batches`;

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
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `job_batches` */

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jobs` */

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_barcode_unique` (`barcode`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `menus` */

insert  into `menus`(`id`,`nama`,`deskripsi`,`harga`,`gambar`,`kategori`,`created_at`,`updated_at`,`barcode`) values 
(1,'Rendang','Rendang khas Padang',28000,'rendang.png','Makanan Berat','2025-08-18 07:14:45','2025-08-18 07:14:45','135861'),
(2,'Gulai Tunjang','Gulai tunjang pedas nikmat',30000,'gulai_tunjang.png','Makanan Berat','2025-08-18 07:14:45','2025-08-18 07:14:45','254242'),
(3,'Ayam Goreng','Ayam goreng renyah',25000,'ayam_goreng.png','Makanan Berat','2025-08-18 07:14:45','2025-08-18 07:14:45','363630'),
(4,'Dendeng Balado','Dendeng balado yang pedas dan lezat',30000,'dendeng_balado.png','Makanan Berat','2025-08-18 07:14:45','2025-08-18 07:14:45','455422'),
(5,'Gulai Tambusu','Gulai Tambusu yang lezat dan nikmat',25000,'gulai_tambusu.png','Makanan Berat','2025-08-18 07:14:45','2025-08-18 07:14:45','586222'),
(6,'Ikan Bakar','Ikan Bakar dengan bumbu khas minang',10000,'ikan_bakar.png','Makanan Berat','2025-08-18 07:14:45','2025-08-18 07:14:45','664842'),
(7,'Telur Barendo','Telur Barendo nan lamak',15000,'telur_barendo.png','Makanan Berat','2025-08-18 07:14:45','2025-08-18 07:14:45','765546'),
(8,'Kalio Jariang','Kalio jariang dengan kuah yang menggugah selera',18000,'kalio_jariang.png','Makanan Berat','2025-08-18 07:14:45','2025-08-18 07:14:45','833204'),
(9,'Udang Balado','Udang balado gurih dan pedas',15000,'udang_balado.png','Makanan Berat','2025-08-18 07:14:45','2025-08-18 07:14:45','969384'),
(10,'Jangek Siram','kerupuk kulit yang disiram dengan kuah',15000,'jangek_siram.png','Makanan Ringan','2025-08-18 07:14:45','2025-08-18 07:14:45','1047306'),
(11,'Telur Bulat Balado','sambel khas minang',13000,'telur_bulat_balado.png','Makanan Berat','2025-08-18 07:14:45','2025-08-18 07:14:45','1128379'),
(12,'Test Menu','Menu untuk testing',25000,NULL,'Makanan Berat','2025-08-24 16:30:43','2025-08-24 16:30:43','123456'),
(13,'Flow Test Menu','Menu untuk testing flow pembayaran',50000,NULL,'Makanan Berat','2025-08-24 16:30:58','2025-08-24 16:30:58','FLOW123');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'0001_01_01_000001_create_cache_table',1),
(2,'0001_01_01_000002_create_jobs_table',1),
(3,'2025_07_20_152648_create_menus_table',1),
(4,'2025_07_27_090542_create_sessions_table',1),
(5,'2025_07_30_140456_create_pembayarans_table',1),
(6,'2025_08_18_064457_create_users_table',2),
(7,'2025_08_18_074231_create_detail_pesanans_table',3),
(8,'2025_08_19_194038_add_barcode_to_menus_table',4),
(9,'2025_08_20_092902_create_personal_access_tokens_table',5),
(10,'2025_08_14_150910_create_orders_table',6),
(11,'2025_08_13_122524_create_transaksi_table',7),
(12,'2025_08_23_103037_create_pesanans_table',8);

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `order_id` varchar(255) NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `status` enum('pending','waiting_payment','paid','cancelled','failed') NOT NULL DEFAULT 'pending',
  `metode_pembayaran` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`items`)),
  `snap_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_id_unique` (`order_id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `orders` */

insert  into `orders`(`id`,`user_id`,`order_id`,`total_harga`,`status`,`metode_pembayaran`,`catatan`,`items`,`snap_token`,`created_at`,`updated_at`) values 
(23,31,'68acf19fbf1de',30000.00,'paid','gopay',NULL,NULL,NULL,'2025-08-25 23:28:31','2025-08-25 23:28:36'),
(24,31,'68acf28472dc0',25000.00,'paid','gopay',NULL,NULL,NULL,'2025-08-25 23:32:20','2025-08-25 23:32:28'),
(25,31,'68acf2941759f',25000.00,'paid','bank_transfer',NULL,NULL,NULL,'2025-08-25 23:32:36','2025-08-25 23:33:27'),
(26,31,'68acf390335f0',30000.00,'paid','gopay',NULL,NULL,NULL,'2025-08-25 23:36:48','2025-08-25 23:36:58'),
(27,31,'68acf39ee1534',30000.00,'paid','bank_transfer',NULL,NULL,NULL,'2025-08-25 23:37:02','2025-08-25 23:37:37'),
(28,31,'68acf3d99f9d4',30000.00,'paid','gopay',NULL,NULL,NULL,'2025-08-25 23:38:01','2025-08-25 23:38:11'),
(29,31,'68acf3e5e68ae',30000.00,'failed','qris',NULL,NULL,NULL,'2025-08-25 23:38:13','2025-08-25 23:54:21'),
(30,31,'68acf3f564e7d',30000.00,'paid','shopeepay',NULL,NULL,NULL,'2025-08-25 23:38:29','2025-08-25 23:38:50'),
(31,31,'68acf41e9a53a',30000.00,'paid','bank_transfer',NULL,NULL,NULL,'2025-08-25 23:39:10','2025-08-25 23:39:44'),
(32,31,'68acf54ee58ce',30000.00,'failed','gopay',NULL,NULL,NULL,'2025-08-25 23:44:14','2025-08-26 00:00:23'),
(33,31,'68acf5ff98e1e',30000.00,'failed','gopay',NULL,NULL,NULL,'2025-08-25 23:47:11','2025-08-26 00:03:18'),
(34,31,'68acf61279852',28000.00,'failed','shopeepay',NULL,NULL,NULL,'2025-08-25 23:47:30','2025-08-26 00:03:41'),
(35,31,'68acf79d7d590',25000.00,'failed','shopeepay',NULL,NULL,NULL,'2025-08-25 23:54:05','2025-08-26 00:12:21'),
(36,31,'68acf7b83f5e6',28000.00,'failed','shopeepay',NULL,NULL,NULL,'2025-08-25 23:54:32','2025-08-26 00:10:41'),
(37,31,'68acf882b52b7',60000.00,'paid','shopeepay',NULL,NULL,NULL,'2025-08-25 23:57:54','2025-08-25 23:58:07'),
(38,31,'68acf981ab60b',28000.00,'paid','shopeepay',NULL,NULL,NULL,'2025-08-26 00:02:09','2025-08-26 00:02:19');

/*Table structure for table `pembayarans` */

DROP TABLE IF EXISTS `pembayarans`;

CREATE TABLE `pembayarans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `total` int(11) NOT NULL,
  `metode` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pembayarans` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

insert  into `personal_access_tokens`(`id`,`tokenable_type`,`tokenable_id`,`name`,`token`,`abilities`,`last_used_at`,`expires_at`,`created_at`,`updated_at`) values 
(1,'App\\Models\\User',4,'API Token','856e4e3addc035e191790590de1e3053c78c870388f2fd7185316065b5aee391','[\"*\"]',NULL,NULL,'2025-08-20 09:35:57','2025-08-20 09:35:57'),
(2,'App\\Models\\User',5,'API Token','98e6cbcefee05b34ecaa8281e5873b5cfc1cba39a47aa0a146c52bb70a3cc8e9','[\"*\"]',NULL,NULL,'2025-08-20 13:26:44','2025-08-20 13:26:44'),
(3,'App\\Models\\User',4,'API Token','cf75c3e09519248a6c64ea78acd855e65539661d34256ed31cf1b98b8a7504fc','[\"*\"]',NULL,NULL,'2025-08-21 03:16:23','2025-08-21 03:16:23'),
(4,'App\\Models\\User',8,'API Token','f06cfb222ac0727e853cea7f61c879cd19ac62bb5dbd31f53fbe37570cd72f06','[\"*\"]',NULL,NULL,'2025-08-21 03:37:32','2025-08-21 03:37:32'),
(5,'App\\Models\\User',8,'API Token','8a968577024ddb04494c0d098600ee069c07cbb10f39db3ccb7e0916a1156e05','[\"*\"]',NULL,NULL,'2025-08-21 03:41:18','2025-08-21 03:41:18'),
(6,'App\\Models\\User',8,'API Token','f3a00c1328aa4ec348ca617a04c1c360b55501d5de5ac2b33ac1e16b7a34f7d8','[\"*\"]',NULL,NULL,'2025-08-21 03:43:00','2025-08-21 03:43:00'),
(7,'App\\Models\\User',8,'API Token','94ed5475b9fdd6741df0b299c542d8f8174075fd94693e865bac5f54bb0817c4','[\"*\"]',NULL,NULL,'2025-08-21 03:52:38','2025-08-21 03:52:38'),
(8,'App\\Models\\User',8,'API Token','c7503542b6072cbcebab02ebe2a277f0340ccd2c4c5388095c92fed3cee10378','[\"*\"]',NULL,NULL,'2025-08-21 03:58:48','2025-08-21 03:58:48'),
(9,'App\\Models\\User',5,'API Token','1cbdd7a3df3824dcc4991328794d026156de9d6bce46f78092ec8d08851730df','[\"*\"]',NULL,NULL,'2025-08-21 04:08:46','2025-08-21 04:08:46'),
(10,'App\\Models\\User',5,'API Token','98344d1ebbff9b58b12dbb26ccedc3581f3e1c1325e3f23689c88e6ff285ba7c','[\"*\"]',NULL,NULL,'2025-08-21 04:11:18','2025-08-21 04:11:18'),
(11,'App\\Models\\User',5,'API Token','e4b21ee172f3073ae357e0aa5d9c3e0619b8cd8e6bedf72aa1156c217a74ffe6','[\"*\"]',NULL,NULL,'2025-08-21 04:13:06','2025-08-21 04:13:06'),
(12,'App\\Models\\User',5,'API Token','7d81a708f34582582455ce680510ac8fa93cd465348a37b25b4839bf6a0b20dc','[\"*\"]',NULL,NULL,'2025-08-21 04:18:06','2025-08-21 04:18:06'),
(13,'App\\Models\\User',5,'API Token','2967a822c2ffd3654bfeda080b4c39b3f3d56028bcd186615e5de2deb02e2dd5','[\"*\"]',NULL,NULL,'2025-08-21 04:21:46','2025-08-21 04:21:46'),
(14,'App\\Models\\User',5,'API Token','d84512f0e5d3428513e4d11803d5529b73ff129c701a6244acbf4e53aceeece2','[\"*\"]',NULL,NULL,'2025-08-21 04:24:42','2025-08-21 04:24:42'),
(15,'App\\Models\\User',5,'API Token','bf9572d3377d0a16def529df0be09a6562499ce39b5ab7a926384f42a9ddc9ce','[\"*\"]',NULL,NULL,'2025-08-21 04:24:43','2025-08-21 04:24:43'),
(16,'App\\Models\\User',5,'API Token','da1daac7e41a7ddfc50c10471270b6183f97b2d55b30c0842817713d66f5bac0','[\"*\"]',NULL,NULL,'2025-08-21 04:31:45','2025-08-21 04:31:45'),
(17,'App\\Models\\User',5,'API Token','0bfb85b013283825d603663472f91391f20003b94c84ac2bff65d2f422375856','[\"*\"]',NULL,NULL,'2025-08-21 04:34:33','2025-08-21 04:34:33'),
(18,'App\\Models\\User',5,'API Token','86c88e1a445d9f3b37ffea812b367b279dcec8790e80fc8df622fc86881c905d','[\"*\"]',NULL,NULL,'2025-08-21 05:16:54','2025-08-21 05:16:54'),
(19,'App\\Models\\User',5,'API Token','0d18585b581faa1f80dc16ca5c4a91d3f0f301d3984629a4ad4440de4b8e3e5b','[\"*\"]',NULL,NULL,'2025-08-21 05:27:27','2025-08-21 05:27:27'),
(20,'App\\Models\\User',5,'API Token','845def65fb0e4c44e5e2755e18415ceb6e2a5286268fef8991d59bc395310f49','[\"*\"]',NULL,NULL,'2025-08-21 05:28:25','2025-08-21 05:28:25'),
(21,'App\\Models\\User',5,'API Token','ac446d8a71eb546129a18bec0c6797e22c34ed64bed9632b429cbdf1730b9ba7','[\"*\"]',NULL,NULL,'2025-08-21 05:32:35','2025-08-21 05:32:35'),
(22,'App\\Models\\User',5,'API Token','92bf46f242cf27f3ff3a817750c1084ddef9089665bc15c756d6e9aa6ff3da96','[\"*\"]',NULL,NULL,'2025-08-21 05:34:34','2025-08-21 05:34:34'),
(23,'App\\Models\\User',5,'API Token','74e2b240035ed5dec5c0d7c32ae8e71fd69f4f8c640a582b01b61493f8004055','[\"*\"]',NULL,NULL,'2025-08-21 05:36:13','2025-08-21 05:36:13'),
(24,'App\\Models\\User',6,'API Token','694e69b010a362eb918bbbe093f1e32843f4db8b00dd86cde0acb2daaa8af9b4','[\"*\"]',NULL,NULL,'2025-08-21 09:33:58','2025-08-21 09:33:58'),
(25,'App\\Models\\User',6,'API Token','f9e580b02068afe9147f426d4332dafa7462d2b9eb028836bd1674328f73d199','[\"*\"]',NULL,NULL,'2025-08-21 10:20:57','2025-08-21 10:20:57'),
(26,'App\\Models\\User',6,'API Token','c0ac61cbc21cdb877d54291dafe719d86f6b4bcfaace3aa988b0b78b3ebf3296','[\"*\"]',NULL,NULL,'2025-08-21 10:28:08','2025-08-21 10:28:08'),
(27,'App\\Models\\User',6,'API Token','cdec92043512a1845e4a45fcd4f9d953edc9a2cc8a5a4c324f905b2bd6078f9d','[\"*\"]',NULL,NULL,'2025-08-21 10:44:52','2025-08-21 10:44:52'),
(28,'App\\Models\\User',6,'API Token','f94c00c38bd4ef2f06538b425a9a18c0408bc34350959a85cad0eb5ac9db9a2a','[\"*\"]',NULL,NULL,'2025-08-21 11:21:50','2025-08-21 11:21:50'),
(29,'App\\Models\\User',6,'API Token','a9f18f2bb5b9884d887f9a053b5117788b912ebccdedaa08147a925118849668','[\"*\"]',NULL,NULL,'2025-08-21 11:26:49','2025-08-21 11:26:49'),
(30,'App\\Models\\User',6,'API Token','e4a431984242ddb002a38463e509f6d876194f63322b702e515dedd18b92f2a5','[\"*\"]',NULL,NULL,'2025-08-21 12:07:19','2025-08-21 12:07:19'),
(31,'App\\Models\\User',6,'API Token','acab6c9a71f4e115e98750830886dcf9c5c016c654a28c6f6ac79cfa1f924517','[\"*\"]',NULL,NULL,'2025-08-21 12:20:47','2025-08-21 12:20:47'),
(32,'App\\Models\\User',6,'API Token','5f4be4d6b35f0a2a8b5bb8542dc93f103bb8e25d5981065a12e5d8bf7f061233','[\"*\"]',NULL,NULL,'2025-08-21 12:34:21','2025-08-21 12:34:21'),
(33,'App\\Models\\User',7,'API Token','4589ad875ac44471201c74a6b8d72156d3cbe44896d44d84aeae0a514488f79c','[\"*\"]',NULL,NULL,'2025-08-21 12:58:07','2025-08-21 12:58:07'),
(34,'App\\Models\\User',7,'API Token','cc01b4b5a56f129148c4d86d0b68a21ecd2cb915818b56786cb7c61b438efa78','[\"*\"]',NULL,NULL,'2025-08-21 13:21:32','2025-08-21 13:21:32'),
(35,'App\\Models\\User',7,'API Token','e3e9fa6e5642aaae6339d50d659bbf8f276ed14d9cb4e6e29def8bcd16220f92','[\"*\"]',NULL,NULL,'2025-08-21 14:00:39','2025-08-21 14:00:39'),
(36,'App\\Models\\User',7,'API Token','329e6798458c66e7383eb9609fcce6ec4176be3504c89bcf6ad5717d7e5c942a','[\"*\"]',NULL,NULL,'2025-08-21 14:23:16','2025-08-21 14:23:16'),
(37,'App\\Models\\User',7,'API Token','782dee3f4a0289971597be797dd36f4b6c8ca5080ccdf24148011c294a3ddd6e','[\"*\"]',NULL,NULL,'2025-08-21 15:44:24','2025-08-21 15:44:24'),
(38,'App\\Models\\User',7,'API Token','025613cdd6b22c4a6f9b11017fa0a3e7c477397d94b6f3eff5abc6c12e2afab0','[\"*\"]',NULL,NULL,'2025-08-21 15:44:29','2025-08-21 15:44:29'),
(39,'App\\Models\\User',7,'API Token','3055c1e11d4bb3cee87db84ddab04085ef0983aea99e59fafa3b3b4285da817a','[\"*\"]',NULL,NULL,'2025-08-21 15:54:04','2025-08-21 15:54:04'),
(40,'App\\Models\\User',7,'API Token','55dc5ed4ff25ef474add37d9fa4fd708579ff2e08cc4e05f9e1e5d2982d63b90','[\"*\"]',NULL,NULL,'2025-08-21 15:56:49','2025-08-21 15:56:49'),
(41,'App\\Models\\User',7,'API Token','b87a9ff227ea465a42e010e3fade0b8cdc464834c1175556d186831411d18322','[\"*\"]',NULL,NULL,'2025-08-21 16:08:20','2025-08-21 16:08:20'),
(42,'App\\Models\\User',7,'API Token','6d303f74d6dd5c5ffaea92fb770d40c68aac8f31a006169d1d9b59d0737d7c3f','[\"*\"]',NULL,NULL,'2025-08-21 16:08:24','2025-08-21 16:08:24'),
(43,'App\\Models\\User',7,'API Token','ca85d9297a7a72dbc2a2bcaea1738d9295103b421ce4399be2407d0cd6f45e93','[\"*\"]',NULL,NULL,'2025-08-21 16:14:36','2025-08-21 16:14:36'),
(44,'App\\Models\\User',7,'API Token','4e2314476f4af532694694e670342a1446c15746b555a3d332064f9e448bca32','[\"*\"]',NULL,NULL,'2025-08-21 22:52:05','2025-08-21 22:52:05'),
(45,'App\\Models\\User',7,'API Token','3e37d3f3c6fa485c4e3275b492c1bdb1355b8246cec62a7ad99bb59a61949091','[\"*\"]',NULL,NULL,'2025-08-21 22:55:41','2025-08-21 22:55:41'),
(46,'App\\Models\\User',9,'API Token','40bb6c5d3e20bf54b106953b8714a8eea86f51b46ca93f7f5f7e3b578692a5d7','[\"*\"]',NULL,NULL,'2025-08-21 23:12:44','2025-08-21 23:12:44'),
(47,'App\\Models\\User',8,'API Token','30c717665c599984a7caaf49c2f2ef707f397eb43491f7eb8c20df97ba6461d2','[\"*\"]',NULL,NULL,'2025-08-22 01:40:24','2025-08-22 01:40:24'),
(48,'App\\Models\\User',8,'API Token','28b7e63949e0db056fb774645f72a68f0214cb9b1e6c521660fa71bd28f3d6f8','[\"*\"]',NULL,NULL,'2025-08-22 02:04:14','2025-08-22 02:04:14'),
(49,'App\\Models\\User',8,'API Token','e85fe4a0738f1796a464ca4cb0d553e38198e98b1726a5b8e61e63753e2290d1','[\"*\"]',NULL,NULL,'2025-08-22 02:17:45','2025-08-22 02:17:45'),
(50,'App\\Models\\User',8,'API Token','93bd8ccdb35eaffd3b6d8d12f6945855acf664c8bf4cc9f45532e5470cfac578','[\"*\"]',NULL,NULL,'2025-08-22 02:23:27','2025-08-22 02:23:27'),
(51,'App\\Models\\User',8,'API Token','08742f10a1d0d48ca32d2dbde4e2fb5ca3b55fff52e05b99bab0e0e2548bbab3','[\"*\"]',NULL,NULL,'2025-08-22 02:38:22','2025-08-22 02:38:22'),
(52,'App\\Models\\User',8,'API Token','c0e59119e2388268068a82d8485b136bde7e9682c2426a5921c309587804bd0e','[\"*\"]',NULL,NULL,'2025-08-22 02:42:50','2025-08-22 02:42:50'),
(53,'App\\Models\\User',8,'API Token','dee86b27a494b75abaaff4453ee31851663f89e3eded0a89622ecaf2cf40afbd','[\"*\"]',NULL,NULL,'2025-08-22 02:45:07','2025-08-22 02:45:07'),
(54,'App\\Models\\User',5,'API Token','64e33bcebb8cab0113cfd763639ccf9bc003256ebebc82a98d19ad2496944748','[\"*\"]',NULL,NULL,'2025-08-22 12:07:53','2025-08-22 12:07:53'),
(55,'App\\Models\\User',5,'API Token','bdc1ea76b356e9e2299d85dd440cc1dc36dd210a0de69b985b6359f0c6ca4ca4','[\"*\"]',NULL,NULL,'2025-08-22 12:33:38','2025-08-22 12:33:38'),
(56,'App\\Models\\User',5,'API Token','72583bb7d4cbc7ebc8e5e4fc3ce0ad782802e6340ee2bd6f5942d5071df350bb','[\"*\"]',NULL,NULL,'2025-08-22 12:52:04','2025-08-22 12:52:04'),
(57,'App\\Models\\User',5,'API Token','8acf6ce32db51bd11b9b8919c21aa9fb3b561d9ee1214d9eca7de2209e53e7bb','[\"*\"]',NULL,NULL,'2025-08-22 13:06:30','2025-08-22 13:06:30'),
(58,'App\\Models\\User',5,'API Token','a3460f1abd1e1eb74a504115a9e54ed52f9235a1c86e03fd71a60297a0943a1a','[\"*\"]',NULL,NULL,'2025-08-22 17:16:21','2025-08-22 17:16:21'),
(59,'App\\Models\\User',6,'API Token','3acc1722cd76cc7f693b933d6a5150231f8d10ca5abf8983a9944a9ba0f32e3e','[\"*\"]',NULL,NULL,'2025-08-22 17:39:19','2025-08-22 17:39:19'),
(60,'App\\Models\\User',6,'API Token','e4d183430faa739134a47ec8baa72a26379d26d8b182b4cb05750af25fb0980d','[\"*\"]',NULL,NULL,'2025-08-22 17:47:38','2025-08-22 17:47:38'),
(61,'App\\Models\\User',6,'API Token','bfcf98a60c6c5ab0ecbdd1a2c2cb1c89d4ed5c382b9f6fdb3b96f39f099b6ede','[\"*\"]',NULL,NULL,'2025-08-22 17:54:25','2025-08-22 17:54:25'),
(62,'App\\Models\\User',7,'API Token','3ef526de02baf473239e2243c6742cd5595692aa9ca2839f17410f0a44d17f28','[\"*\"]',NULL,NULL,'2025-08-23 04:05:07','2025-08-23 04:05:07'),
(63,'App\\Models\\User',6,'API Token','989b7c7ae60bed783bdd98d96a3bf0e2de32c97b67946bbbec127a7044c014ab','[\"*\"]',NULL,NULL,'2025-08-23 04:27:42','2025-08-23 04:27:42'),
(64,'App\\Models\\User',6,'API Token','776cfd12dab927a027623483a324287619023fc95c230e195ce8aedfa4120a43','[\"*\"]',NULL,NULL,'2025-08-23 04:34:02','2025-08-23 04:34:02'),
(65,'App\\Models\\User',6,'API Token','1238781d33a320b1e474adaee8ebee9f268f4edd04660d9117d68431fff57005','[\"*\"]',NULL,NULL,'2025-08-23 04:46:36','2025-08-23 04:46:36'),
(66,'App\\Models\\User',6,'API Token','f666aedf3602ffaf5e9c878bf3b4c62fb6627da0c48c3b12a6d79a217c2e54b7','[\"*\"]',NULL,NULL,'2025-08-23 05:01:24','2025-08-23 05:01:24'),
(67,'App\\Models\\User',6,'API Token','8c81d43e507ac884315f6bfecb52d512d9531288c3d1ca6280748e4ff3a46704','[\"*\"]',NULL,NULL,'2025-08-23 06:51:43','2025-08-23 06:51:43'),
(68,'App\\Models\\User',6,'API Token','04b2ab5e83dccf81027c8b53533dfa0a885fd773515139143f3df193275b48af','[\"*\"]',NULL,NULL,'2025-08-23 07:37:35','2025-08-23 07:37:35'),
(69,'App\\Models\\User',6,'API Token','ed4c08171cd52dea26697a6bd4ef08b058869bcb36e8246b1c4b49dcdf4bbb5c','[\"*\"]',NULL,NULL,'2025-08-23 08:15:26','2025-08-23 08:15:26'),
(70,'App\\Models\\User',6,'API Token','7243f8a6d94436fb63f09d77600d2fc31bc925fb608ef869d3fac5b21d8c5e0e','[\"*\"]',NULL,NULL,'2025-08-23 08:29:38','2025-08-23 08:29:38'),
(71,'App\\Models\\User',6,'API Token','f7a65c817b8410e7bd0b08af0da6e9573e636fd2ef441b6a38e03fb3f7d59002','[\"*\"]',NULL,NULL,'2025-08-23 08:47:24','2025-08-23 08:47:24'),
(72,'App\\Models\\User',6,'API Token','5a24f92cf5c1133d9781b39b96a85720d49fd9d31da585bf424b9ddfc3130961','[\"*\"]',NULL,NULL,'2025-08-23 08:54:33','2025-08-23 08:54:33'),
(73,'App\\Models\\User',6,'API Token','20e9df928b1f75a5a6c8c06017097093ce90f8c578dd590ac59fb03ae443dc5e','[\"*\"]',NULL,NULL,'2025-08-23 09:03:15','2025-08-23 09:03:15'),
(74,'App\\Models\\User',6,'API Token','52357b59bb64547eb91d0712618490ec9e4d41c6d34820d47d78780072f09d0d','[\"*\"]',NULL,NULL,'2025-08-23 09:17:46','2025-08-23 09:17:46'),
(75,'App\\Models\\User',6,'API Token','1fa2141ad7f9674e0495346d4bc763aa43b69ed3bd1fbbf47587605a083a8798','[\"*\"]',NULL,NULL,'2025-08-23 09:42:26','2025-08-23 09:42:26'),
(76,'App\\Models\\User',8,'API Token','d69b3b815e2acdd7596e51887d1f632093bac1906e08376e656b81af28c282fa','[\"*\"]',NULL,NULL,'2025-08-23 10:58:10','2025-08-23 10:58:10'),
(77,'App\\Models\\User',8,'API Token','27cc02d239770c94bd641b3bba399355047467042b558072a5e446e38ac151c5','[\"*\"]',NULL,NULL,'2025-08-23 11:30:59','2025-08-23 11:30:59'),
(78,'App\\Models\\User',8,'API Token','ec5ae5fb0bb5569afc3d82f798720f6188e75b9d523ec7f0a36e7b315e4e495a','[\"*\"]',NULL,NULL,'2025-08-23 11:36:37','2025-08-23 11:36:37'),
(79,'App\\Models\\User',6,'API Token','899258f06d25ec80c7e4179ad2032c31b3625c56a02b88356814f5a65758d21b','[\"*\"]',NULL,NULL,'2025-08-23 11:47:47','2025-08-23 11:47:47'),
(80,'App\\Models\\User',5,'API Token','3b9e2176ddc3e84b526b9b3ed84243f37940b88adca2bfdd759cd937a44a54bb','[\"*\"]',NULL,NULL,'2025-08-23 12:03:21','2025-08-23 12:03:21'),
(81,'App\\Models\\User',5,'API Token','5e6197f3bb21f188d1b3720acbe2eeb24f974fa646e7a17d2f913a779a12d247','[\"*\"]',NULL,NULL,'2025-08-23 12:05:47','2025-08-23 12:05:47'),
(82,'App\\Models\\User',5,'API Token','cf8106dbbc0748553989842af9cc8ed3fa45f0b7965ed62143da02335e08ff6a','[\"*\"]',NULL,NULL,'2025-08-23 12:17:42','2025-08-23 12:17:42'),
(83,'App\\Models\\User',5,'API Token','d98b0cb32ff7754d5eaaa1f98212a5255c4c0e4537679cb813ea16e1a4157f1d','[\"*\"]',NULL,NULL,'2025-08-23 12:23:42','2025-08-23 12:23:42'),
(84,'App\\Models\\User',5,'API Token','18c603ebaf2a3569787324825c48c372521c2a14e60afaf764bf66d6be2959b3','[\"*\"]',NULL,NULL,'2025-08-23 12:30:12','2025-08-23 12:30:12'),
(85,'App\\Models\\User',5,'API Token','87f1e94746c23260f3d122bf5a2c799f4d592c8b625183733c613b525f3d1e0b','[\"*\"]',NULL,NULL,'2025-08-23 12:33:46','2025-08-23 12:33:46'),
(86,'App\\Models\\User',5,'API Token','13575fb8a75f069ce4dd2edd027752561c8e1c888f3b54c328936763bcf728cc','[\"*\"]',NULL,NULL,'2025-08-23 12:40:11','2025-08-23 12:40:11'),
(87,'App\\Models\\User',5,'API Token','bcf148ef81bc51ffd124c02db3be0646f28ff5d405e0462895bb026848ef8904','[\"*\"]',NULL,NULL,'2025-08-23 12:45:02','2025-08-23 12:45:02'),
(88,'App\\Models\\User',5,'API Token','a79ae4060c6ac0c7a90d31074aae718fbc218b068ff6d554852bf9ecbb11d24f','[\"*\"]',NULL,NULL,'2025-08-23 12:51:24','2025-08-23 12:51:24'),
(89,'App\\Models\\User',5,'API Token','2b8f2064413127f6b94660c96b8f1fa019152003fad80907a0e966ac395af040','[\"*\"]',NULL,NULL,'2025-08-23 12:57:51','2025-08-23 12:57:51'),
(90,'App\\Models\\User',5,'API Token','86995187ff6cf23d23e809e2bd64021569dc2f9cb1950ce8147364962f1e52df','[\"*\"]',NULL,NULL,'2025-08-23 13:03:51','2025-08-23 13:03:51'),
(91,'App\\Models\\User',6,'API Token','e7d3f93b8bfeb598be2dfacd4c26b66fc619b67f850bd8fea78b0fc51b331f90','[\"*\"]',NULL,NULL,'2025-08-23 13:12:01','2025-08-23 13:12:01'),
(92,'App\\Models\\User',5,'API Token','9c646fb87b8fc34641f518af4f935e1c5603fa98baa5d7a70573656eb6716f50','[\"*\"]',NULL,NULL,'2025-08-23 13:18:48','2025-08-23 13:18:48'),
(93,'App\\Models\\User',4,'API Token','835d7bece1c5dcd19f326f4eb90412158e0a81e98c58769d80dbb2e02c9f503c','[\"*\"]',NULL,NULL,'2025-08-23 13:23:02','2025-08-23 13:23:02'),
(94,'App\\Models\\User',4,'API Token','336309fa52f84fa780361e29177c6846835ba6c942dcc734486f6863474de0ea','[\"*\"]',NULL,NULL,'2025-08-23 13:28:52','2025-08-23 13:28:52'),
(95,'App\\Models\\User',4,'API Token','97b31e5e67aadd06c207ac70c5a14a1e0e43ac1d2da5d90505ee9e5c395fd775','[\"*\"]',NULL,NULL,'2025-08-23 13:33:04','2025-08-23 13:33:04'),
(96,'App\\Models\\User',4,'API Token','c622ead165451e6b9f06173877c72d64abecc60fce1cbbf7734e6b2475eae5c3','[\"*\"]',NULL,NULL,'2025-08-23 13:35:15','2025-08-23 13:35:15'),
(97,'App\\Models\\User',4,'API Token','8f5fe39aef06a8a0407048cbb40ab5cd99ec0dc682ebaadeddc8466bfec53840','[\"*\"]',NULL,NULL,'2025-08-23 13:35:50','2025-08-23 13:35:50'),
(98,'App\\Models\\User',4,'API Token','1c5eaa4d761f115c2379abbb6fb454d5b14faa8682c36411858a03fb16650c65','[\"*\"]',NULL,NULL,'2025-08-23 13:42:23','2025-08-23 13:42:23'),
(99,'App\\Models\\User',4,'API Token','3ba1ff6fbbf05c37298b17b00397530bb13f6a39a2b1681b36540193d907aa58','[\"*\"]',NULL,NULL,'2025-08-23 13:45:49','2025-08-23 13:45:49'),
(100,'App\\Models\\User',4,'API Token','f8e9e53301b6bc2bb9fae8a15cf82a99865c04639c75c5a7459c57d7576b342e','[\"*\"]',NULL,NULL,'2025-08-23 13:52:52','2025-08-23 13:52:52'),
(101,'App\\Models\\User',5,'API Token','e3e33710fe63594a07dbd7dc708e927cb929f5bd24bb86b14600a0ab001d03d5','[\"*\"]',NULL,NULL,'2025-08-23 14:05:31','2025-08-23 14:05:31'),
(102,'App\\Models\\User',4,'API Token','ecfa2956ae79848b84bc4e2dc6c1f8cf948a873c7fc5a92573b537f658ce28a2','[\"*\"]',NULL,NULL,'2025-08-23 14:11:13','2025-08-23 14:11:13'),
(103,'App\\Models\\User',6,'API Token','f845090d7d1c066de7d26af10555ad86765adbd640cf6ca411f10046129803c7','[\"*\"]',NULL,NULL,'2025-08-23 14:21:34','2025-08-23 14:21:34'),
(104,'App\\Models\\User',6,'API Token','8be48057ca0dc14b375e5e72508ec06cbe337947e432534b4b00a1b43753e9b4','[\"*\"]',NULL,NULL,'2025-08-23 14:29:48','2025-08-23 14:29:48'),
(105,'App\\Models\\User',6,'API Token','d57698c6423a63047f7f0eadc21a1e4ff62b087bf018048f8f037267292881de','[\"*\"]',NULL,NULL,'2025-08-23 14:37:40','2025-08-23 14:37:40'),
(106,'App\\Models\\User',10,'API Token','5f984eb38fa17e3b1debde0217c3f2913dfb3502fdd09acebb797c5b29532cdb','[\"*\"]',NULL,NULL,'2025-08-23 16:20:30','2025-08-23 16:20:30'),
(107,'App\\Models\\User',9,'API Token','b3daf45e1cbca2e2ad074006cc1b01d14e8ebab7ed9dc09d0b7a77a6636e45ac','[\"*\"]',NULL,NULL,'2025-08-23 16:31:40','2025-08-23 16:31:40'),
(108,'App\\Models\\User',4,'API Token','b861937eb9ce6065c8c45d1457b7fea83ee6f6e9083526da497c9d064ce2ecb6','[\"*\"]',NULL,NULL,'2025-08-23 16:36:30','2025-08-23 16:36:30'),
(109,'App\\Models\\User',4,'API Token','b8422f3d702f0e9288b92cb6d82da797a1b2fa89572c66d94179e98bced7cbeb','[\"*\"]',NULL,NULL,'2025-08-23 16:42:20','2025-08-23 16:42:20'),
(110,'App\\Models\\User',4,'API Token','c978109bfeed089835ed4a0cce5ee5c3846eda5eb384cb4887c961f57f8c1e45','[\"*\"]',NULL,NULL,'2025-08-23 16:54:49','2025-08-23 16:54:49'),
(111,'App\\Models\\User',4,'API Token','c2996220e647f1fd4105b69c039c834abf09fb96f689e8555a0322491811d41a','[\"*\"]',NULL,NULL,'2025-08-23 17:00:16','2025-08-23 17:00:16'),
(112,'App\\Models\\User',4,'API Token','59527cf7bda3536b4c841654b860098d257e051c15aa22462f64c3aa0254459d','[\"*\"]',NULL,NULL,'2025-08-23 17:10:43','2025-08-23 17:10:43'),
(113,'App\\Models\\User',4,'API Token','b8f86c440ddcd3d60429df56e8faca1ad0de3efc1fc200e389477686d00530d6','[\"*\"]',NULL,NULL,'2025-08-23 17:14:56','2025-08-23 17:14:56'),
(114,'App\\Models\\User',4,'API Token','e20f70e5c78dc163d2181c478cf70a73844d2a596dede0355d34807f01ce628e','[\"*\"]',NULL,NULL,'2025-08-23 17:21:30','2025-08-23 17:21:30'),
(115,'App\\Models\\User',6,'API Token','bb3789fb02322ee38b6fce4f3cb8ab59ab5b8ea27cda21a1a1cf4f41f13e7bbf','[\"*\"]',NULL,NULL,'2025-08-23 17:49:31','2025-08-23 17:49:31'),
(116,'App\\Models\\User',6,'API Token','90d4b13392b5782d7c606bfd4ce18fb3c15d1d2b480e90d1b589d05b98774632','[\"*\"]',NULL,NULL,'2025-08-23 17:54:01','2025-08-23 17:54:01'),
(117,'App\\Models\\User',5,'API Token','cf917adbea5a663898ace5d2eac4ed1ead5672fe85a770dba4ad072cedd04a5e','[\"*\"]',NULL,NULL,'2025-08-23 18:04:32','2025-08-23 18:04:32'),
(118,'App\\Models\\User',5,'API Token','08a01f27496107331463e53b188349089d49c086b7f5ead332ecff29c6157c1e','[\"*\"]',NULL,NULL,'2025-08-23 18:15:33','2025-08-23 18:15:33'),
(119,'App\\Models\\User',6,'API Token','aae67033a14f7b4cc03c8f072214eb67e36e38c687f2bff2cacd66c17105c782','[\"*\"]',NULL,NULL,'2025-08-23 19:51:22','2025-08-23 19:51:22'),
(120,'App\\Models\\User',6,'API Token','a94d3c9c45cfb072e293d30f261c9da6dc1ee9ebe22abf88291dc705b0d3b714','[\"*\"]',NULL,NULL,'2025-08-23 20:03:58','2025-08-23 20:03:58'),
(121,'App\\Models\\User',6,'API Token','a784f62f6778d46a1486207a03e82dfa2ad2bf8fa9891744a3a99f9dbde045ac','[\"*\"]',NULL,NULL,'2025-08-23 20:07:07','2025-08-23 20:07:07'),
(122,'App\\Models\\User',6,'API Token','0b861eddfb8f9896a4dd66ee180f1f968955a12350cca59ed7b07a1c15f7f09e','[\"*\"]',NULL,NULL,'2025-08-23 20:11:16','2025-08-23 20:11:16'),
(123,'App\\Models\\User',6,'API Token','3611578e755050203cc3f48798decd50a13ee7dce2ac7f487c1d72539428c093','[\"*\"]',NULL,NULL,'2025-08-23 20:16:51','2025-08-23 20:16:51'),
(124,'App\\Models\\User',6,'API Token','1bc337e3db5c656ced558ce4fa8294d31079a728b27644896f269d0a7f531e6d','[\"*\"]',NULL,NULL,'2025-08-23 20:19:58','2025-08-23 20:19:58'),
(125,'App\\Models\\User',6,'API Token','34ec57f765a98b730a83e5856761c3e15c9ebce15dbc55a787f8a4bb36e162ed','[\"*\"]',NULL,NULL,'2025-08-23 20:25:29','2025-08-23 20:25:29'),
(126,'App\\Models\\User',6,'API Token','8be48501c942e4c1bc2c32ec542182ec79cfc0e00e248f3f52794366101e2345','[\"*\"]',NULL,NULL,'2025-08-23 20:29:49','2025-08-23 20:29:49'),
(127,'App\\Models\\User',6,'API Token','78fc58679c7aef46bf3a8585cbd919ce85bf849d4b43a27646848e4c68c13d2d','[\"*\"]',NULL,NULL,'2025-08-23 20:33:44','2025-08-23 20:33:44'),
(128,'App\\Models\\User',6,'API Token','e8aef82b999b4e307501697dc90f6b5ec11ca6ca5c20397f1bc7ac6d26641f36','[\"*\"]',NULL,NULL,'2025-08-24 04:16:16','2025-08-24 04:16:16'),
(129,'App\\Models\\User',4,'API Token','d3dc4f4b605f1aecc2098e02067001c1f7c9914cc5442c22fc7f9792aac92a7d','[\"*\"]',NULL,NULL,'2025-08-24 04:24:54','2025-08-24 04:24:54'),
(130,'App\\Models\\User',5,'API Token','7b6855d11a7f969e4dd5870fe8c39c9408c1c6ca0e06e6bb18f9df7f110d67c1','[\"*\"]',NULL,NULL,'2025-08-24 04:29:03','2025-08-24 04:29:03'),
(131,'App\\Models\\User',5,'API Token','faf2da1d2fe97b6ef812d72843d50fab2455d568678a7217f07dbe20638213ad','[\"*\"]',NULL,NULL,'2025-08-24 04:31:56','2025-08-24 04:31:56'),
(132,'App\\Models\\User',5,'API Token','4f65628e7f6bada3e59267d758c8b49f9cdca2c98b6aecd6f649faf1be3cb4e4','[\"*\"]',NULL,NULL,'2025-08-24 05:14:07','2025-08-24 05:14:07'),
(133,'App\\Models\\User',5,'API Token','389c21ed03f2e05a6f875d4a7943b2e54f3030a0b4b76bec1fd259eadeb75d6c','[\"*\"]',NULL,NULL,'2025-08-24 05:22:21','2025-08-24 05:22:21'),
(134,'App\\Models\\User',5,'API Token','fc02f2680cde9cca1f0b6180f5b4b3f70624a37c72b5d87aceb3fad86bc3201f','[\"*\"]',NULL,NULL,'2025-08-24 05:30:45','2025-08-24 05:30:45'),
(135,'App\\Models\\User',5,'API Token','99f247763a3a00c395eb7dd08161dfc1e499cb77d26defe019d659b55a6805bf','[\"*\"]',NULL,NULL,'2025-08-24 06:04:04','2025-08-24 06:04:04'),
(136,'App\\Models\\User',5,'API Token','60d72085ac05760cc7922fad0627b03ed66071f34284156573998d072802dc27','[\"*\"]',NULL,NULL,'2025-08-24 06:14:38','2025-08-24 06:14:38'),
(137,'App\\Models\\User',5,'API Token','7dbaa5b458fc2d229de79b5178b4741f2a1a47ce4d9e62ab5d653bdba64c58f9','[\"*\"]',NULL,NULL,'2025-08-24 06:16:51','2025-08-24 06:16:51'),
(138,'App\\Models\\User',5,'API Token','620b35a40ca2d76894ed7d6e316d8e06d6bf30385b27d7a47eb8d9d3d8a82bed','[\"*\"]',NULL,NULL,'2025-08-24 06:33:24','2025-08-24 06:33:24'),
(139,'App\\Models\\User',5,'API Token','523c31bfe6b4a3473dc21a272424c3085854f961bd03a5603856b3d58cf0c930','[\"*\"]',NULL,NULL,'2025-08-24 06:33:26','2025-08-24 06:33:26'),
(140,'App\\Models\\User',5,'API Token','b65fbf6a3b8fd9877e84d01d4d60a3d6a815c5243532009ceff7c41899365afe','[\"*\"]',NULL,NULL,'2025-08-24 06:36:40','2025-08-24 06:36:40'),
(141,'App\\Models\\User',5,'API Token','3bc9683aaba9af12b052ddfc48b8c094b7b2ec76cb8476e0370a9137bd295b64','[\"*\"]',NULL,NULL,'2025-08-24 06:49:17','2025-08-24 06:49:17'),
(142,'App\\Models\\User',5,'API Token','d634ba315fb50ee1503879a13b4003b25f11c609912c3c8e04cc9352a7109377','[\"*\"]',NULL,NULL,'2025-08-24 07:01:53','2025-08-24 07:01:53'),
(143,'App\\Models\\User',5,'API Token','9a2eaf61c5fefcef36f31398bd1636592572a7df33aecfa63fb31d8733707132','[\"*\"]',NULL,NULL,'2025-08-24 07:04:05','2025-08-24 07:04:05'),
(144,'App\\Models\\User',5,'API Token','ee03c09ae48ed5c404e9bb1c3cacd02b5283236c40d10e4db64aa73adea2cdc8','[\"*\"]',NULL,NULL,'2025-08-24 07:12:54','2025-08-24 07:12:54'),
(145,'App\\Models\\User',5,'API Token','383b06ce0261c8c41096cbc8e1257ab1d993a269f615ed1cdfbcae1abfe45d0e','[\"*\"]',NULL,NULL,'2025-08-24 07:26:24','2025-08-24 07:26:24'),
(146,'App\\Models\\User',5,'API Token','d2f9570c0c43526ca8feb79d343d22b2723247c6c6c6933576c4ad9cb7c94ede','[\"*\"]',NULL,NULL,'2025-08-24 07:33:59','2025-08-24 07:33:59'),
(147,'App\\Models\\User',5,'API Token','a58874c959a3363cf3c0266450c9499d27a4d1a66301e8e609b2b848a25e66ce','[\"*\"]',NULL,NULL,'2025-08-24 07:39:56','2025-08-24 07:39:56'),
(148,'App\\Models\\User',5,'API Token','b568521fd7145955f94e7b9e2ba82425f90d634d3e3bfab132ef89dd60fb32d7','[\"*\"]',NULL,NULL,'2025-08-24 07:50:13','2025-08-24 07:50:13'),
(149,'App\\Models\\User',5,'API Token','e4fbd3b0a3093b54a562f247eb52b490548ff09d0a24dbf77a2353c6696902df','[\"*\"]',NULL,NULL,'2025-08-24 07:54:00','2025-08-24 07:54:00'),
(150,'App\\Models\\User',5,'API Token','fd31dfb961d8af00a0011a918b97a62caa6e29c1e4d0f101a2b34bb8a35bf996','[\"*\"]',NULL,NULL,'2025-08-24 08:07:21','2025-08-24 08:07:21'),
(151,'App\\Models\\User',5,'API Token','518cfd4a62a91b277e6b546e77a5ac86361ec7e37840131ad34d4c0f41407d23','[\"*\"]',NULL,NULL,'2025-08-24 08:11:14','2025-08-24 08:11:14'),
(152,'App\\Models\\User',5,'API Token','a10cfcb479f942d455109c1ca10f5db50ac0c09e3424b897731a64dced5331bc','[\"*\"]',NULL,NULL,'2025-08-24 08:12:42','2025-08-24 08:12:42'),
(153,'App\\Models\\User',5,'API Token','dd12f5b7d6571fb34eca2cb0885303f46fb68696775b5d92baea953750691c35','[\"*\"]',NULL,NULL,'2025-08-24 08:16:49','2025-08-24 08:16:49'),
(154,'App\\Models\\User',5,'API Token','712a36f3b203428fb73e535cbe2b3c1e54577f8b784bc133677bf4b0dc8d3230','[\"*\"]',NULL,NULL,'2025-08-24 08:21:03','2025-08-24 08:21:03'),
(155,'App\\Models\\User',5,'API Token','4e0fdddca00de7be09cea7ec19e0244029ecbb818f7d3c70ef450514646aff02','[\"*\"]',NULL,NULL,'2025-08-24 08:24:27','2025-08-24 08:24:27'),
(156,'App\\Models\\User',5,'API Token','232112aa848693eb037f33e315bfd86d4f3cc4d2d8910b790cdaa6e4ef6a3b97','[\"*\"]',NULL,NULL,'2025-08-24 08:31:58','2025-08-24 08:31:58'),
(157,'App\\Models\\User',5,'API Token','7482f403d3c388d19e13bd7041a404fb68dfb0d62e54c11439cb835d72fb099b','[\"*\"]',NULL,NULL,'2025-08-24 08:40:43','2025-08-24 08:40:43'),
(158,'App\\Models\\User',5,'API Token','a14854e3de0d6191910a6961b258bc62381db9a411f5e9a6ab4be1581d192bde','[\"*\"]',NULL,NULL,'2025-08-24 08:50:26','2025-08-24 08:50:26'),
(159,'App\\Models\\User',5,'API Token','b7d3cbd68ef540139af4e84873a371ad8c627418f774bd6affaa4634be17791e','[\"*\"]',NULL,NULL,'2025-08-24 08:51:15','2025-08-24 08:51:15'),
(160,'App\\Models\\User',5,'API Token','349c81e2a1a2c9f9542f8015accbedefb1fbe2288ccbd70b7e7c86352eec50c9','[\"*\"]',NULL,NULL,'2025-08-24 08:51:46','2025-08-24 08:51:46'),
(161,'App\\Models\\User',5,'API Token','70103ced3993114e72ec8b3fc0e280a9bbfa84d596e5d394c1ba83a7861b6cc5','[\"*\"]',NULL,NULL,'2025-08-24 08:52:55','2025-08-24 08:52:55'),
(162,'App\\Models\\User',5,'API Token','e023aef61f428dc98ac9946b157966ae1a4ff921f99ae99324dd404ae6cef88d','[\"*\"]',NULL,NULL,'2025-08-24 09:04:38','2025-08-24 09:04:38'),
(163,'App\\Models\\User',5,'API Token','907039204881f88c98288fe4fa0d8fac2286eaaf7104ce5946d8de13563328bf','[\"*\"]',NULL,NULL,'2025-08-24 09:05:21','2025-08-24 09:05:21'),
(164,'App\\Models\\User',5,'API Token','32e52f2cd73f8484eb4c3b7b023528c110904ce9d76d9842af694138ba51e024','[\"*\"]',NULL,NULL,'2025-08-24 09:12:00','2025-08-24 09:12:00'),
(165,'App\\Models\\User',5,'API Token','a8c57f2b7f21d99c6592ceb304c1e103a5acf0b859366add7b946361f131ee12','[\"*\"]',NULL,NULL,'2025-08-24 09:23:27','2025-08-24 09:23:27'),
(166,'App\\Models\\User',5,'API Token','4d6435b0582b2cbe8de11cc7672678c7e4fa8fd5dbe55cced66adea9be9cec5e','[\"*\"]',NULL,NULL,'2025-08-24 09:33:07','2025-08-24 09:33:07'),
(167,'App\\Models\\User',5,'API Token','20760bff342344a5fbe01a625bd699e570714908afb8d4b901ad2d8e0f2b99fc','[\"*\"]',NULL,NULL,'2025-08-24 09:39:30','2025-08-24 09:39:30'),
(168,'App\\Models\\User',5,'API Token','eb32c03dc8b2c021145649e182fc5fefbf8570d3e9f4de292aaaa9b4ed620a31','[\"*\"]',NULL,NULL,'2025-08-24 09:46:31','2025-08-24 09:46:31'),
(169,'App\\Models\\User',6,'API Token','dad9a15811c2e95f85318ee5d52260bf485b2b3ef92085e9739f5eff8fca0999','[\"*\"]',NULL,NULL,'2025-08-24 10:07:03','2025-08-24 10:07:03'),
(170,'App\\Models\\User',6,'API Token','b9be8d21c118688e5aacb60e5a0e3a68861427bf7bf3a895e88e4edf6e538817','[\"*\"]',NULL,NULL,'2025-08-24 10:13:23','2025-08-24 10:13:23'),
(171,'App\\Models\\User',5,'API Token','0ab70cdda2b46ac6da46b3f54f015757b1f1cc1b161747a81a6a356d51642801','[\"*\"]',NULL,NULL,'2025-08-24 11:30:07','2025-08-24 11:30:07'),
(172,'App\\Models\\User',5,'API Token','fefd35769292725d369325f84ae98ebea7c7cce571a3b786eb78141646f707d1','[\"*\"]',NULL,NULL,'2025-08-24 12:11:02','2025-08-24 12:11:02'),
(173,'App\\Models\\User',31,'API Token','cf0b02f9d6c46724dda568fd94bb933271726c71fcb8a7c5580998b9ca2f119a','[\"*\"]','2025-08-25 14:01:19',NULL,'2025-08-25 12:16:44','2025-08-25 14:01:19'),
(174,'App\\Models\\User',31,'API Token','781182e1055e2a54e2193d4682925a7deb6c869a4651eb38a415e35ffcbbc199','[\"*\"]','2025-08-25 14:03:34',NULL,'2025-08-25 14:01:36','2025-08-25 14:03:34'),
(175,'App\\Models\\User',31,'API Token','b379f11f645ab9870b7d7e1d80485adb245be3c026fa68a9d2ac4687b893ae72','[\"*\"]','2025-08-25 14:06:55',NULL,'2025-08-25 14:05:22','2025-08-25 14:06:55'),
(176,'App\\Models\\User',31,'API Token','87c0327f1f14b9e254b37ebb712cc70f915ae9d0bd3e063a6ba91495528683c1','[\"*\"]','2025-08-25 14:07:38',NULL,'2025-08-25 14:07:31','2025-08-25 14:07:38'),
(177,'App\\Models\\User',31,'API Token','4b0e848a4d6dbfe43a78ee7dbf2dfa523dca1c66998133ae553fae7029b6656b','[\"*\"]','2025-08-25 15:31:29',NULL,'2025-08-25 14:10:52','2025-08-25 15:31:29'),
(178,'App\\Models\\User',31,'API Token','d26d252636e6a5d8f5bf341aeab870854a86aa0cce67a843b2a16cb8962a33cb','[\"*\"]','2025-08-25 18:10:35',NULL,'2025-08-25 15:31:42','2025-08-25 18:10:35'),
(179,'App\\Models\\User',31,'API Token','345675624ce7467b3949a2600f461b6103a3d19dce41cada08fc95f8935addca','[\"*\"]','2025-08-25 15:53:48',NULL,'2025-08-25 15:53:19','2025-08-25 15:53:48'),
(180,'App\\Models\\User',31,'API Token','5037b0cbce61e95c886749ab4ecd6755679410441e2b36a3fc0f0d59e81c7493','[\"*\"]','2025-08-25 18:19:56',NULL,'2025-08-25 18:10:52','2025-08-25 18:19:56'),
(181,'App\\Models\\User',31,'API Token','850f4b56153d370c29d855a0e93f9812b960429c96c955d3d956edaad6cd549e','[\"*\"]','2025-08-25 18:25:43',NULL,'2025-08-25 18:20:05','2025-08-25 18:25:43'),
(182,'App\\Models\\User',31,'API Token','d5e115848e41905fe3089fbd5d91500549a6ecd872e19d2dc4531ada7f0fe540','[\"*\"]','2025-08-25 18:30:14',NULL,'2025-08-25 18:26:06','2025-08-25 18:30:14'),
(183,'App\\Models\\User',31,'API Token','b68428ae97435a5765c42c775bd065ba5e20b4738eedbf8bd00043292cc068d4','[\"*\"]','2025-08-25 18:45:57',NULL,'2025-08-25 18:30:27','2025-08-25 18:45:57'),
(184,'App\\Models\\User',31,'API Token','f19995e8dab3a3b3b3a1e43f18a36d2933bcabc7ec6718e74e173297c7b3e7ff','[\"*\"]','2025-08-25 18:46:35',NULL,'2025-08-25 18:46:18','2025-08-25 18:46:35'),
(186,'App\\Models\\User',31,'auth_token','cee7fdd904982b4d5ee01bd3952ded293bcc98a371a685a30006c558af923a55','[\"*\"]',NULL,NULL,'2025-08-25 18:49:10','2025-08-25 18:49:10'),
(187,'App\\Models\\User',31,'auth_token','6a1ad6205ed5983d7c9160d81c5bbc6312b35301634240905efc6af977dc53c3','[\"*\"]',NULL,NULL,'2025-08-25 18:50:03','2025-08-25 18:50:03'),
(188,'App\\Models\\User',31,'auth_token','227e2a718c4e814e058f94811d105ac1638022d9cea1dee3a85e4a9342c7b541','[\"*\"]',NULL,NULL,'2025-08-25 18:50:13','2025-08-25 18:50:13'),
(189,'App\\Models\\User',31,'auth_token','b0de519f66826dfd522baf894f4ecd6cd73356f1ae7c2110535fbc427bba0451','[\"*\"]',NULL,NULL,'2025-08-25 18:50:27','2025-08-25 18:50:27'),
(193,'App\\Models\\User',31,'API Token','41c6090ffc8d17ecaa57602a01d69e2f980b0aab7ab2ee5ebb06f3f73a2e7937','[\"*\"]','2025-08-26 00:02:44',NULL,'2025-08-25 19:23:50','2025-08-26 00:02:44');

/*Table structure for table `pesanans` */

DROP TABLE IF EXISTS `pesanans`;

CREATE TABLE `pesanans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `status` enum('Menunggu Pembayaran','Diproses','Dikirim','Selesai','Dibatalkan') NOT NULL DEFAULT 'Menunggu Pembayaran',
  `metode` varchar(50) DEFAULT NULL,
  `total_harga` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `detail` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`detail`)),
  PRIMARY KEY (`id`),
  KEY `pesanans_user_id_foreign` (`user_id`),
  CONSTRAINT `pesanans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pesanans` */

insert  into `pesanans`(`id`,`order_id`,`user_id`,`nama_pelanggan`,`status`,`metode`,`total_harga`,`created_at`,`updated_at`,`detail`) values 
(164,'68acf390335f0',31,'Anton Sabu','Menunggu Pembayaran',NULL,30000.00,'2025-08-25 23:36:48','2025-08-25 23:36:48',NULL),
(165,'68acf39ee1534',31,'Anton Sabu','Menunggu Pembayaran',NULL,30000.00,'2025-08-25 23:37:02','2025-08-25 23:37:02',NULL),
(166,'68acf3d99f9d4',31,'Anton Sabu','Menunggu Pembayaran',NULL,30000.00,'2025-08-25 23:38:01','2025-08-25 23:38:01',NULL),
(167,'68acf3e5e68ae',31,'Anton Sabu','Menunggu Pembayaran',NULL,30000.00,'2025-08-25 23:38:13','2025-08-25 23:38:13',NULL),
(168,'68acf3f564e7d',31,'Anton Sabu','Menunggu Pembayaran',NULL,30000.00,'2025-08-25 23:38:29','2025-08-25 23:38:29',NULL),
(169,'68acf41e9a53a',31,'Anton Sabu','Menunggu Pembayaran',NULL,30000.00,'2025-08-25 23:39:10','2025-08-25 23:39:10',NULL),
(170,'68acf54ee58ce',31,'Anton Sabu','Menunggu Pembayaran',NULL,30000.00,'2025-08-25 23:44:14','2025-08-25 23:44:14',NULL),
(171,'68acf5ff98e1e',31,'Anton Sabu','Menunggu Pembayaran',NULL,30000.00,'2025-08-25 23:47:11','2025-08-25 23:47:11',NULL),
(172,'68acf61279852',31,'Anton Sabu','Menunggu Pembayaran',NULL,28000.00,'2025-08-25 23:47:30','2025-08-25 23:47:30',NULL),
(173,'68acf79d7d590',31,'Anton Sabu','Menunggu Pembayaran',NULL,25000.00,'2025-08-25 23:54:05','2025-08-25 23:54:05',NULL),
(174,'68acf7b83f5e6',31,'Anton Sabu','Menunggu Pembayaran',NULL,28000.00,'2025-08-25 23:54:32','2025-08-25 23:54:32',NULL),
(175,'68acf882b52b7',31,'Anton Sabu','Menunggu Pembayaran',NULL,60000.00,'2025-08-25 23:57:54','2025-08-25 23:57:54',NULL),
(176,'68acf981ab60b',31,'Anton Sabu','Menunggu Pembayaran',NULL,28000.00,'2025-08-26 00:02:09','2025-08-26 00:02:09',NULL);

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('LH6q2KR0OnyneUSa8AQEBHVGmXk730uqk76o34Kj',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidXI3ZHc3M0laVk5nZnhLWkdMSXdkcGdPaWgxTWRGdUVlTW96UmZHQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1756064069),
('MoDh6GEhAgS7W7l7dmaV3LNkl6KV0QdCGOmjh9xW',32,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYm9kZDBjUVU1Wm1aYndPcFJsUnhjd2ZHNkpaODJ0MHFJUlp2c3JZayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vcGVyYXRvci9tZW51cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjMyO30=',1756063369),
('QBqwyhwTPUO1QYStunAEbJsAUHtPIVThG5ut0keA',NULL,'192.168.1.16','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVjBOVnFGU1dxVk9XdmplTTMzNHROM0c2d0FWU2FXeGhocXJLMmVNZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly8xOTIuMTY4LjEuMTY6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1756137954),
('RSvxnvRQII7p55UtycooWucYw3RlAC4z1J6PIqoy',32,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTUVEM2tOb0FGNDBGVTliclRVR0IwVEtCUjBFODgyMHBQY3B2bzVscSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vcGVyYXRvci9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozMjt9',1756063859);

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transaksi_order_id_unique` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transaksi` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`nama`,`username`,`email`,`password`,`level`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Admin','admin','admin@example.com','$2y$12$/YtDBuoDHxNvtHHqgBgTJ..HR7YGT8AtoL.uMrERkrQ8yp/7ulKlO','admin',NULL,'2025-08-18 06:54:45','2025-08-18 06:54:45'),
(2,'Operator','operator','operator@example.com','$2y$12$C7/jGGwuo5spFk46jNZLOusrsqloOWbTQqSi6eTGX0Cx2nO6dsR8u','operator',NULL,'2025-08-18 06:54:45','2025-08-18 06:54:45'),
(3,'Pelanggan 1','pelanggan1','dian@example.com','$2y$12$mXLuOeYQZBfxoA95cc67euZh.tjwQJ0AAHKzfZZvapZBwun.5VZG6','pengguna',NULL,'2025-08-18 06:54:46','2025-08-18 07:12:43'),
(4,'Pelanggan 2','pelanggan2','pelanggan2@example.com','$2y$12$SI/qPXdS3B8Um5F.Fv3wWuLlEo.t3ME/AcvMBArUACih.bjX1KqOC','pelanggan',NULL,'2025-08-18 06:54:46','2025-08-18 06:54:46'),
(5,'Pelanggan 3','pelanggan3','pelanggan3@example.com','$2y$12$9YzOozwiS61RqpZn2yVGH.JYUDnXZQDDRC/gSJyGpqWjegAL1sK9S','pelanggan',NULL,'2025-08-18 06:54:46','2025-08-18 06:54:46'),
(6,'Pelanggan 4','pelanggan4','pelanggan4@example.com','$2y$12$4QGxIKYPWoTRBTCRVPTbFeBUIZ2em4qETWNRll9iP.SAfQ6qExOhq','pelanggan',NULL,'2025-08-18 06:54:46','2025-08-18 06:54:46'),
(7,'Pelanggan 5','pelanggan5','pelanggan5@example.com','$2y$12$1vjrczL5LWTODK4ycCXc8ev9gj1T6uUiHww0d3D90K9D/pLDE2oDa','pelanggan',NULL,'2025-08-18 06:54:47','2025-08-18 06:54:47'),
(8,'Pelanggan 6','pelanggan6','pelanggan6@example.com','$2y$12$mGPwkg9WTm7fNCecAUbEHuZarHBcvhd0mjGECcknqVG4m8FDDrpPu','pelanggan',NULL,'2025-08-18 06:54:47','2025-08-18 06:54:47'),
(9,'Pelanggan 7','pelanggan7','pelanggan7@example.com','$2y$12$X/xE0ztkahDFSFeIkmQlv.p/eellPK4SFljhf0XDMdouBfrCVlxQm','pelanggan',NULL,'2025-08-18 06:54:47','2025-08-18 06:54:47'),
(10,'Pelanggan 8','pelanggan8','pelanggan8@example.com','$2y$12$NX3BgApGr8eZMqkgL7e9Aux1xDhJixAPKk5W0bnPF4HINCbuUciNW','pelanggan',NULL,'2025-08-18 06:54:48','2025-08-18 06:54:48'),
(11,'Pelanggan 9','pelanggan9','pelanggan9@example.com','$2y$12$z6ir/Yo0YRlTvuiUNlyCxuVFCKMWr3trTCCQlIGkSxjRT3PIMYUH.','pelanggan',NULL,'2025-08-18 06:54:48','2025-08-18 06:54:48'),
(12,'Pelanggan 10','pelanggan10','pelanggan10@example.com','$2y$12$bSRedzkOjXiJfIvRns6RpeyJnzQ6LKAf5JhURg/VSBPvuTDzN4X2W','pelanggan',NULL,'2025-08-18 06:54:48','2025-08-18 06:54:48'),
(13,'Pelanggan 11','pelanggan11','pelanggan11@example.com','$2y$12$zRPuZXVSVzkDHhse/F/yxOqf73kgRJx4GlQ.T4obtOxZJGAj/aG6i','pelanggan',NULL,'2025-08-18 06:54:49','2025-08-18 06:54:49'),
(14,'Pelanggan 12','pelanggan12','pelanggan12@example.com','$2y$12$kEelV7fw/RMGj3qdcomwFe3V8sVwwp1KHLRdI.EkYxpYzlyVGU6rG','pelanggan',NULL,'2025-08-18 06:54:49','2025-08-18 06:54:49'),
(15,'Pelanggan 13','pelanggan13','pelanggan13@example.com','$2y$12$wrzt3/I3YXAcrAAxo8nzvu6nf3cWJZVnD91JyMK9GoCLfqR8BlliC','pelanggan',NULL,'2025-08-18 06:54:49','2025-08-18 06:54:49'),
(16,'Pelanggan 14','pelanggan14','pelanggan14@example.com','$2y$12$OsrPwc4O6Sn9pMDd7S8jQemBy8yzvMEilY62liC8dkiS4HlDMzEwe','pelanggan',NULL,'2025-08-18 06:54:49','2025-08-18 06:54:49'),
(17,'Pelanggan 15','pelanggan15','pelanggan15@example.com','$2y$12$9qzDEXOwrE3X88YFnnEKb.JvipDui5xtBAs72slvZ7R4shhgGfazm','pelanggan',NULL,'2025-08-18 06:54:50','2025-08-18 06:54:50'),
(18,'Pelanggan 16','pelanggan16','pelanggan16@example.com','$2y$12$oOovknxebjdEmlsY9zJzb.hcoyJA44U0vhtdqhQLLN/MRwTQbBeTC','pelanggan',NULL,'2025-08-18 06:54:50','2025-08-18 06:54:50'),
(19,'Pelanggan 17','pelanggan17','pelanggan17@example.com','$2y$12$HkoYmH1lzkZzm1ocDr2M4OCLkn6JJ/.s1KdurH.JwSOlAkAL34cr6','pelanggan',NULL,'2025-08-18 06:54:50','2025-08-18 06:54:50'),
(20,'Pelanggan 18','pelanggan18','pelanggan18@example.com','$2y$12$TjW.//Pr9QlG6Ezk/7zese7JFTmvPZAxcYijH/zO8ivY1R2yGIWhm','pelanggan',NULL,'2025-08-18 06:54:51','2025-08-18 06:54:51'),
(21,'Pelanggan 19','pelanggan19','pelanggan19@example.com','$2y$12$3dwopHISxn9NuqEKyqTF4uC6rla/I7L5M/27fwCOtTBFvxv9v.KmO','pelanggan',NULL,'2025-08-18 06:54:51','2025-08-18 06:54:51'),
(24,'dian','diputdi','dian@gmail.com','$2y$12$TmK08ScY2boZj57T6Phcb.9IWNX9K82zC4beRioHMuwJnlC5MpBce','pelanggan',NULL,'2025-08-20 01:37:24','2025-08-20 01:37:24'),
(25,'John Doe','john123','johndoe@example.com','$2y$12$9.tHL5D..BnVoRFuo5hx5uBHuKOx3oCLVAc8X.WlpO0M74aNjzOC.','pelanggan',NULL,'2025-08-20 01:37:40','2025-08-20 01:37:40'),
(26,'lala','lala123','lala@example.com','$2y$12$oktjpzh/Z5k4GsbA3feXhO//FSBdsw6yaHu7gSx7m6apg2XmvkGW.','pelanggan',NULL,'2025-08-20 02:08:42','2025-08-20 02:08:42'),
(27,'lisa','ncung','ncung@gmail.com','$2y$12$ZXJwSFWk1Ecag4h9KDGwVuOgG.JUyVUg70dCkcHXocrBxjp/zTSgy','pelanggan',NULL,'2025-08-20 02:40:27','2025-08-20 02:40:27'),
(28,'Test User','testuser','test@example.com','$2y$12$mnZKjv/RUD489N8hz8MnSeYILBrCuw/9sq4da0cxoZVV4jzQ5hWdC','pelanggan',NULL,'2025-08-24 16:30:42','2025-08-24 16:30:42'),
(30,'Yudha Bima Sakti','yudha','yudhabimasakti787@gmail.com','$2y$12$M4FFAw24ho917Gco0aueY.3siO29fMqaQmXugAoHzZ9N2F1481JBO','admin',NULL,'2025-08-24 17:03:04','2025-08-24 17:03:04'),
(31,'Anton Sabu','anton','anton@gmail.com','$2y$12$qzAO/rEbkcL7uUgWi5wCmOyd1l2FvCP5/ksQVgWM3FXiF8PRy0mAm','pelanggan',NULL,'2025-08-24 17:17:23','2025-08-24 17:20:20'),
(32,'Operator 2','operator1','op@gmail.com','$2y$12$S77pcp9LhZdgtt4JSig5eOtJ8kiOXI/zPe/d6YY2FJ1zCI21y6q6O','operator',NULL,'2025-08-24 18:39:21','2025-08-24 18:40:58');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
