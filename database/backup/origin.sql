-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table db_sirelaku.audits
CREATE TABLE IF NOT EXISTS `audits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` bigint(20) unsigned NOT NULL,
  `old_values` text COLLATE utf8mb4_unicode_ci,
  `new_values` text COLLATE utf8mb4_unicode_ci,
  `url` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(1023) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  KEY `audits_user_id_user_type_index` (`user_id`,`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sirelaku.audits: ~49 rows (approximately)
INSERT INTO `audits` (`id`, `user_type`, `user_id`, `event`, `auditable_type`, `auditable_id`, `old_values`, `new_values`, `url`, `ip_address`, `user_agent`, `tags`, `created_at`, `updated_at`) VALUES
	(1, 'App\\Models\\User', 112277, 'created', 'App\\Models\\PermissionGroup', 38, '[]', '{"id":38,"name":"dwqd","desc":"wqdqw"}', 'http://127.0.0.1:8000/admin/permission-group', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-18 18:14:21', '2023-07-18 18:14:21'),
	(2, 'App\\Models\\User', 112277, 'deleted', 'App\\Models\\PermissionGroup', 38, '{"id":38,"desc":"wqdqw","name":"dwqd"}', '[]', 'http://127.0.0.1:8000/admin/permission-group/38', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-18 18:16:08', '2023-07-18 18:16:08'),
	(3, 'App\\Models\\User', 112277, 'created', 'App\\Models\\PermissionGroup', 39, '[]', '{"id":39,"name":"s","desc":"s"}', 'http://127.0.0.1:8000/admin/permission-group', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-18 18:19:21', '2023-07-18 18:19:21'),
	(4, 'App\\Models\\User', 112277, 'created', 'App\\Models\\PermissionGroup', 40, '[]', '{"id":40,"name":"dqw","desc":"dwqd"}', 'http://127.0.0.1:8000/admin/permission-group', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-18 18:22:45', '2023-07-18 18:22:45'),
	(5, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"last_login_at":"2023-07-18 21:24:43"}', '{"last_login_at":"2023-07-19 08:49:34"}', 'http://127.0.0.1:8000/login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-19 01:49:34', '2023-07-19 01:49:34'),
	(6, 'App\\Models\\User', 112277, 'deleted', 'App\\Models\\PermissionGroup', 40, '{"id":40,"desc":"dwqd","name":"dqw"}', '[]', 'http://127.0.0.1:8000/admin/permission-group/40', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-19 01:55:15', '2023-07-19 01:55:15'),
	(7, 'App\\Models\\User', 112277, 'deleted', 'App\\Models\\PermissionGroup', 39, '{"id":39,"desc":"s","name":"s"}', '[]', 'http://127.0.0.1:8000/admin/permission-group/39', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-19 01:58:35', '2023-07-19 01:58:35'),
	(8, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"last_login_at":"2023-07-19 08:49:34"}', '{"last_login_at":"2023-07-19 22:22:04"}', 'http://127.0.0.1:8000/login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-19 15:22:04', '2023-07-19 15:22:04'),
	(9, 'App\\Models\\User', 112277, 'created', 'App\\Models\\User', 112278, '[]', '{"id":112278,"username":"lwmqld","nama_lengkap":"lmdlqm","kontak":"21312","email":null,"password":"$2y$10$BryukqQ\\/CwoTrWdHW\\/K8veHRR971YQcI5AvDRd55w3rMhQ4p59IP6"}', 'http://127.0.0.1:8000/admin/master-user', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-19 15:35:00', '2023-07-19 15:35:00'),
	(10, 'App\\Models\\User', 112277, 'deleted', 'App\\Models\\User', 112278, '{"id":112278,"username":"lwmqld","nip":null,"bidang_id":null,"email":null,"nama_lengkap":"lmdlqm","kontak":"21312","alamat":null,"jenis_kelamin":null,"status":"AKTIF","password":"$2y$10$BryukqQ\\/CwoTrWdHW\\/K8veHRR971YQcI5AvDRd55w3rMhQ4p59IP6","remember_token":null,"gldepan":null,"nama":null,"glblk":null,"kunker":null,"nunker":null,"kjab":null,"njab":null,"foto":null,"keselon":null,"neselon":null,"kgolru":null,"ngolru":null,"pangkat":null,"last_login_at":null,"last_login_ip":null}', '[]', 'http://127.0.0.1:8000/admin/master-user/112278', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-19 15:35:10', '2023-07-19 15:35:10'),
	(11, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"last_login_at":"2023-07-19 22:22:04"}', '{"last_login_at":"2023-07-19 22:37:09"}', 'http://127.0.0.1:8000/login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-19 15:37:09', '2023-07-19 15:37:09'),
	(12, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"last_login_at":"2023-07-19 22:37:09"}', '{"last_login_at":"2023-07-19 22:41:59"}', 'http://laravel-starter.test:8080/login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-19 15:41:59', '2023-07-19 15:41:59'),
	(13, 'App\\Models\\User', 112277, 'created', 'App\\Models\\User', 112278, '[]', '{"id":112278,"username":"dq","nama_lengkap":"dqw","kontak":null,"email":"dq","password":"$2y$10$m4wVwdfIgNTwWgoRHIM8WuHrjvMox048eEOCZgAGTVzL6.x9nlwki"}', 'http://laravel-starter.test:8080/admin/master-user', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-19 15:52:33', '2023-07-19 15:52:33'),
	(14, 'App\\Models\\User', 112277, 'deleted', 'App\\Models\\User', 112278, '{"id":112278,"username":"dq","nip":null,"bidang_id":null,"email":"dq","nama_lengkap":"dqw","kontak":null,"alamat":null,"jenis_kelamin":null,"status":"AKTIF","password":"$2y$10$m4wVwdfIgNTwWgoRHIM8WuHrjvMox048eEOCZgAGTVzL6.x9nlwki","remember_token":null,"gldepan":null,"nama":null,"glblk":null,"kunker":null,"nunker":null,"kjab":null,"njab":null,"foto":null,"keselon":null,"neselon":null,"kgolru":null,"ngolru":null,"pangkat":null,"last_login_at":null,"last_login_ip":null}', '[]', 'http://laravel-starter.test:8080/admin/master-user/112278', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-19 15:52:43', '2023-07-19 15:52:43'),
	(15, 'App\\Models\\User', 112277, 'created', 'App\\Models\\User', 112279, '[]', '{"id":112279,"username":"q","nama_lengkap":"d","kontak":null,"email":null,"password":"$2y$10$bYRF1F8Po7ifbUHBp9Dxo.\\/sqkKn1tTrx7kjnfoQY8AgOP\\/7DHzwm"}', 'http://laravel-starter.test:8080/admin/master-user', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-19 15:57:08', '2023-07-19 15:57:08'),
	(16, 'App\\Models\\User', 112277, 'deleted', 'App\\Models\\User', 112279, '{"id":112279,"username":"q","nip":null,"bidang_id":null,"email":null,"nama_lengkap":"d","kontak":null,"alamat":null,"jenis_kelamin":null,"status":"AKTIF","password":"$2y$10$bYRF1F8Po7ifbUHBp9Dxo.\\/sqkKn1tTrx7kjnfoQY8AgOP\\/7DHzwm","remember_token":null,"gldepan":null,"nama":null,"glblk":null,"kunker":null,"nunker":null,"kjab":null,"njab":null,"foto":null,"keselon":null,"neselon":null,"kgolru":null,"ngolru":null,"pangkat":null,"last_login_at":null,"last_login_ip":null}', '[]', 'http://laravel-starter.test:8080/admin/master-user/112279', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-19 16:01:07', '2023-07-19 16:01:07'),
	(17, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"last_login_at":"2023-07-19 22:41:59"}', '{"last_login_at":"2023-07-19 23:03:38"}', 'http://laravel-starter.test:8080/login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-19 16:03:38', '2023-07-19 16:03:38'),
	(18, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"last_login_at":"2023-07-19 23:03:38"}', '{"last_login_at":"2023-07-20 06:23:06"}', 'http://laravel-starter.test:8080/login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-19 23:23:06', '2023-07-19 23:23:06'),
	(19, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"last_login_at":"2023-07-20 06:23:06"}', '{"last_login_at":"2023-07-20 09:04:47"}', 'http://laravel-starter.test:8080/login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 02:04:47', '2023-07-20 02:04:47'),
	(20, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 48, '{"nama_lengkap":"admin2","password":"$2y$10$AjP.Sn2TTBkVpDkAOnICTu\\/uHMqfpWnI6bZYtleg6GW\\/W\\/dueQbgu"}', '{"nama_lengkap":"admin22","password":"$2y$10$iIqFXRzSULAgIIDUunfOke15McZC8DmEfV0e6CKaKDnqIqnToNE9m"}', 'http://laravel-starter.test:8080/admin/master-user', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 02:25:41', '2023-07-20 02:25:41'),
	(21, 'App\\Models\\User', 112277, 'created', 'App\\Models\\User', 112278, '[]', '{"id":112278,"username":"dqwd","nama_lengkap":"wqd","kontak":"1212","email":null,"password":"$2y$10$BoNECQh3zZGVkb1k3K7xveGf0N1kscJBqUkh1bjNVFY5FdwMLbQla"}', 'http://laravel-starter.test:8080/admin/master-user', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 02:25:52', '2023-07-20 02:25:52'),
	(22, 'App\\Models\\User', 112277, 'deleted', 'App\\Models\\User', 112278, '{"id":112278,"username":"dqwd","nip":null,"bidang_id":null,"email":null,"nama_lengkap":"wqd","kontak":"1212","alamat":null,"jenis_kelamin":null,"status":"AKTIF","password":"$2y$10$BoNECQh3zZGVkb1k3K7xveGf0N1kscJBqUkh1bjNVFY5FdwMLbQla","remember_token":null,"gldepan":null,"nama":null,"glblk":null,"kunker":null,"nunker":null,"kjab":null,"njab":null,"foto":null,"keselon":null,"neselon":null,"kgolru":null,"ngolru":null,"pangkat":null,"last_login_at":null,"last_login_ip":null}', '[]', 'http://laravel-starter.test:8080/admin/master-user/112278', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 02:25:56', '2023-07-20 02:25:56'),
	(23, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"last_login_at":"2023-07-20 09:04:47"}', '{"last_login_at":"2023-07-20 19:13:42"}', 'http://laravel-starter.test:8080/login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 12:13:42', '2023-07-20 12:13:42'),
	(24, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 48, '{"kontak":null,"password":"$2y$10$iIqFXRzSULAgIIDUunfOke15McZC8DmEfV0e6CKaKDnqIqnToNE9m"}', '{"kontak":"089902103902","password":"$2y$10$Uei3iIW\\/IEFVcHZe7wa4L.G\\/K.neOgCMh0nX4yW4Evb85e1ZbZjp."}', 'http://laravel-starter.test:8080/admin/master-user', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 13:39:28', '2023-07-20 13:39:28'),
	(25, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 49, '{"kontak":null,"password":"$2y$10$hTxfMLhXUT9bOUrRSjpdauUsarOxEeRBuYd7TP9Ojv\\/l1Yrw.9qte"}', '{"kontak":"0323901923","password":"$2y$10$3ZnbvjOQwIy6NZRtOnpoGul6t3UcIY3KjwKuXIagoFMOQ3U3MqQa6"}', 'http://laravel-starter.test:8080/admin/master-user', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 13:39:42', '2023-07-20 13:39:42'),
	(26, 'App\\Models\\User', 112277, 'deleted', 'App\\Models\\User', 48, '{"id":48,"username":"200105072023021002","nip":"200105072023021002","bidang_id":null,"email":"admin2@gmail.com","nama_lengkap":"admin22","kontak":"089902103902","alamat":null,"jenis_kelamin":null,"status":"AKTIF","password":"$2y$10$Uei3iIW\\/IEFVcHZe7wa4L.G\\/K.neOgCMh0nX4yW4Evb85e1ZbZjp.","remember_token":null,"gldepan":null,"nama":"ADIB YUDA PRATAMA","glblk":"A.Md.Ak.","kunker":"4002000000","nunker":"INSPEKTORAT KOTA JAMBI","kjab":null,"njab":null,"foto":null,"keselon":null,"neselon":null,"kgolru":null,"ngolru":null,"pangkat":null,"last_login_at":null,"last_login_ip":null}', '[]', 'http://laravel-starter.test:8080/admin/master-user/48', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 13:39:54', '2023-07-20 13:39:54'),
	(27, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"last_login_at":"2023-07-20 19:13:42"}', '{"last_login_at":"2023-07-20 23:57:32"}', 'http://laravel-starter.test:8080/login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 16:57:32', '2023-07-20 16:57:32'),
	(28, 'App\\Models\\User', 112277, 'created', 'App\\Models\\User', 112278, '[]', '{"id":112278,"username":"d","nama_lengkap":"dq","kontak":"3213","email":null,"password":"$2y$10$4TPThJtFlKmQO2V6lFJR9O4rkB0Fu6VkemsMAj2Mko525\\/fcd8tYK"}', 'http://laravel-starter.test:8080/admin/master-user', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 16:57:51', '2023-07-20 16:57:51'),
	(29, 'App\\Models\\User', 112277, 'deleted', 'App\\Models\\User', 112278, '{"id":112278,"username":"d","nip":null,"bidang_id":null,"email":null,"nama_lengkap":"dq","kontak":"3213","alamat":null,"jenis_kelamin":null,"status":"AKTIF","password":"$2y$10$4TPThJtFlKmQO2V6lFJR9O4rkB0Fu6VkemsMAj2Mko525\\/fcd8tYK","remember_token":null,"gldepan":null,"nama":null,"glblk":null,"kunker":null,"nunker":null,"kjab":null,"njab":null,"foto":null,"keselon":null,"neselon":null,"kgolru":null,"ngolru":null,"pangkat":null,"last_login_at":null,"last_login_ip":null}', '[]', 'http://laravel-starter.test:8080/admin/master-user/112278', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 16:58:14', '2023-07-20 16:58:14'),
	(30, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"foto":null}', '{"foto":"a1699373-6ddb-42aa-bca1-160729e2c994"}', 'http://laravel-starter.test:8080/user/profile/photo/change', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 17:13:20', '2023-07-20 17:13:20'),
	(31, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"kontak":"082244261525"}', '{"kontak":"0822442615252"}', 'http://laravel-starter.test:8080/user/profile/112277', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 17:36:16', '2023-07-20 17:36:16'),
	(32, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"kontak":"0822442615252"}', '{"kontak":"082244261525"}', 'http://laravel-starter.test:8080/user/profile/112277', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 17:36:21', '2023-07-20 17:36:21'),
	(33, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"email":"lianmafutra@gmail.com","kontak":"082244261525"}', '{"email":"lianmafutra@gmail.com2","kontak":"0822442615252"}', 'http://laravel-starter.test:8080/user/profile/112277', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 17:36:48', '2023-07-20 17:36:48'),
	(34, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"email":"lianmafutra@gmail.com2","nama_lengkap":"Lian Mafutra Dev","kontak":"0822442615252"}', '{"email":"lianmafutra@gmail.com22","nama_lengkap":"Lian Mafutra Dev2","kontak":"08224426152522"}', 'http://laravel-starter.test:8080/user/profile/112277', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 17:37:04', '2023-07-20 17:37:04'),
	(35, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"email":"lianmafutra@gmail.com22","nama_lengkap":"Lian Mafutra Dev2","kontak":"08224426152522"}', '{"email":"lianmafutra@gmail.com","nama_lengkap":"Lian Mafutra Dev","kontak":"082244261525"}', 'http://laravel-starter.test:8080/user/profile/112277', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 17:37:11', '2023-07-20 17:37:11'),
	(36, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"alamat":null}', '{"alamat":"jl"}', 'http://laravel-starter.test:8080/user/profile/112277', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 17:38:07', '2023-07-20 17:38:07'),
	(37, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"alamat":"jl"}', '{"alamat":"Jl. Jawa No.99Kebun Handil, Kec. Jelutung, Kota Jambi, Jambi 36125"}', 'http://laravel-starter.test:8080/user/profile/112277', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 17:40:51', '2023-07-20 17:40:51'),
	(38, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"jenis_kelamin":null}', '{"jenis_kelamin":"L"}', 'http://laravel-starter.test:8080/user/profile/112277', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 17:45:12', '2023-07-20 17:45:12'),
	(39, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"jenis_kelamin":"L"}', '{"jenis_kelamin":"P"}', 'http://laravel-starter.test:8080/user/profile/112277', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 17:46:12', '2023-07-20 17:46:12'),
	(40, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"jenis_kelamin":"P"}', '{"jenis_kelamin":"L"}', 'http://laravel-starter.test:8080/user/profile/112277', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 17:46:17', '2023-07-20 17:46:17'),
	(41, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"last_login_at":"2023-07-20 23:57:32"}', '{"last_login_at":"2023-07-21 02:02:05"}', 'http://laravel-starter.test:8080/login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 19:02:05', '2023-07-20 19:02:05'),
	(42, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"last_login_at":"2023-07-21 02:02:05"}', '{"last_login_at":"2023-07-21 02:04:40"}', 'http://laravel-starter.test:8080/login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-20 19:04:40', '2023-07-20 19:04:40'),
	(43, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"last_login_at":"2023-07-21 02:04:40"}', '{"last_login_at":"2023-07-21 08:36:29"}', 'http://laravel-starter.test:8080/login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-21 01:36:29', '2023-07-21 01:36:29'),
	(44, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 49, '{"password":"$2y$10$3ZnbvjOQwIy6NZRtOnpoGul6t3UcIY3KjwKuXIagoFMOQ3U3MqQa6"}', '{"password":"$2y$10$uZSdsqJzPyUXfedJpMMJ9eFGTuTnh4uZQlUgVk6h31q8Ttj\\/HYcDK"}', 'http://laravel-starter.test:8080/admin/master-user', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-21 02:30:08', '2023-07-21 02:30:08'),
	(45, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 192, '{"password":"$2y$10$2wLaswl9FTPeSvgcLgdCl.VyxNLafluR.unhmuLqyz8\\/ixyl9G.mi"}', '{"password":"$2y$10$fcSX59FP\\/0WKNUPQgV41WOZuGwXli\\/xajGPbfEgmlhKiBtam9q\\/8S"}', 'http://laravel-starter.test:8080/admin/master-user', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-21 02:30:16', '2023-07-21 02:30:16'),
	(46, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 192, '{"password":"$2y$10$fcSX59FP\\/0WKNUPQgV41WOZuGwXli\\/xajGPbfEgmlhKiBtam9q\\/8S"}', '{"password":"$2y$10$iTIA4LGNVzrczxNdScEBEexn4k9ml7HAZLzkQgwcb0nHV8zq.yRwm"}', 'http://laravel-starter.test:8080/admin/master-user', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-21 02:30:25', '2023-07-21 02:30:25'),
	(47, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 112277, '{"password":"$2y$10$chRjlp8KIegoD6wsyAwMi.Vm9no0A\\/SjWyDC9ivLiWsTRUUStANga"}', '{"password":"$2y$10$0NB6gLigZ4UxuZ0nnjaQxuSqr2Nk8L7KQTn6NK3DJq9uF418UOIL6"}', 'http://laravel-starter.test:8080/admin/master-user', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-21 02:33:47', '2023-07-21 02:33:47'),
	(48, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 49, '{"email":null,"password":"$2y$10$uZSdsqJzPyUXfedJpMMJ9eFGTuTnh4uZQlUgVk6h31q8Ttj\\/HYcDK"}', '{"email":"ok@gmail.com","password":"$2y$10$2alaM\\/qTDj2dsNLml4WrHeNznfGcvuMCwoxpKNA8\\/1xTOG9.wNO86"}', 'http://laravel-starter.test:8080/admin/master-user', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-21 02:34:03', '2023-07-21 02:34:03'),
	(49, 'App\\Models\\User', 112277, 'updated', 'App\\Models\\User', 192, '{"email":null,"kontak":null,"password":"$2y$10$iTIA4LGNVzrczxNdScEBEexn4k9ml7HAZLzkQgwcb0nHV8zq.yRwm"}', '{"email":"bb@gmail.com","kontak":"0829389273","password":"$2y$10$SdutgiYNd3dG.HiAYT6h0u2J7IVLVOCNeF1OjuMy.w18\\/BC0J.i12"}', 'http://laravel-starter.test:8080/admin/master-user', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.82', NULL, '2023-07-21 02:34:19', '2023-07-21 02:34:19');

-- Dumping structure for table db_sirelaku.deploy_log
CREATE TABLE IF NOT EXISTS `deploy_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commit_message` text,
  `status` enum('success','error') DEFAULT NULL,
  `log` text,
  `deploy_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_sirelaku.deploy_log: ~0 rows (approximately)

-- Dumping structure for table db_sirelaku.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sirelaku.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table db_sirelaku.file
CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` varchar(500) DEFAULT NULL,
  `model_id` int(11) NOT NULL,
  `name_origin` text NOT NULL,
  `name_hash` varchar(200) NOT NULL,
  `path` varchar(500) NOT NULL,
  `mime` varchar(500) NOT NULL,
  `extension` varchar(500) DEFAULT NULL,
  `size` varchar(500) DEFAULT NULL,
  `desc` text,
  `order` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_hash` (`name_hash`),
  KEY `FK_file_users` (`created_by`),
  KEY `FK_file_kanban` (`model_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1392 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sirelaku.file: ~0 rows (approximately)

-- Dumping structure for table db_sirelaku.fileponds
CREATE TABLE IF NOT EXISTS `fileponds` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filepath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mimetypes` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL DEFAULT '0',
  `disk` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1316 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sirelaku.fileponds: ~0 rows (approximately)

-- Dumping structure for table db_sirelaku.komentar
CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `pesan` varchar(500) NOT NULL DEFAULT '',
  `created_by` int(11) NOT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_sirelaku.komentar: ~0 rows (approximately)

-- Dumping structure for table db_sirelaku.laporan_calk
CREATE TABLE IF NOT EXISTS `laporan_calk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(500) NOT NULL DEFAULT '',
  `file_laporan` varchar(500) NOT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_sirelaku.laporan_calk: ~0 rows (approximately)

-- Dumping structure for table db_sirelaku.laporan_dana_samsat
CREATE TABLE IF NOT EXISTS `laporan_dana_samsat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(500) NOT NULL DEFAULT '',
  `file_laporan` varchar(500) NOT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_sirelaku.laporan_dana_samsat: ~0 rows (approximately)

-- Dumping structure for table db_sirelaku.laporan_keuangan
CREATE TABLE IF NOT EXISTS `laporan_keuangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(500) NOT NULL DEFAULT '',
  `file_laporan` varchar(500) NOT NULL,
  `laporan_keuangan_jenis_id` int(11) DEFAULT NULL,
  `tinjuk_chr_id` int(11) DEFAULT NULL,
  `pelaporan_chr_id` int(11) DEFAULT NULL,
  `status` enum('selesai','perbaikan','proses','menunggu_persetujuan') NOT NULL DEFAULT 'proses',
  `uuid` varchar(200) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_laporan_keuangan_laporan_keuangan_jenis` (`laporan_keuangan_jenis_id`),
  KEY `FK_laporan_keuangan_tinjuk_chr` (`tinjuk_chr_id`),
  CONSTRAINT `FK_laporan_keuangan_laporan_keuangan_jenis` FOREIGN KEY (`laporan_keuangan_jenis_id`) REFERENCES `laporan_keuangan_jenis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_laporan_keuangan_tinjuk_chr` FOREIGN KEY (`tinjuk_chr_id`) REFERENCES `tinjuk_chr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_sirelaku.laporan_keuangan: ~0 rows (approximately)

-- Dumping structure for table db_sirelaku.laporan_keuangan_jenis
CREATE TABLE IF NOT EXISTS `laporan_keuangan_jenis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(500) NOT NULL DEFAULT '',
  `kode` varchar(500) NOT NULL DEFAULT '',
  `uuid` varchar(200) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_sirelaku.laporan_keuangan_jenis: ~7 rows (approximately)
INSERT INTO `laporan_keuangan_jenis` (`id`, `nama`, `kode`, `uuid`, `created_by`, `created_at`, `updated_at`) VALUES
	(1, 'Neraca Percobaan', 'neraca-percobaan', 'QgZEoqdvx9PwYN7KEzepJmkXy60Glr', NULL, '2023-08-26 15:32:18', '2023-08-26 15:32:18'),
	(2, 'Laporan Realisasi Anggaran', 'realisasi-anggaran', 'QgZEoqdvx9PwYN7KEzepJmkXy60Glr', NULL, '2023-08-26 15:32:18', '2023-08-26 15:32:18'),
	(3, 'Laporan Operasional', 'operasional', 'QgZEoqdvx9PwYN7KEzepJmkXy60Glr', NULL, '2023-08-26 15:32:18', '2023-08-26 15:32:18'),
	(4, 'Laporan Perubahan Ekuitas', 'perubahan-ekuitas', 'QgZEoqdvx9PwYN7KEzepJmkXy60Glr', NULL, '2023-08-26 15:32:18', '2023-08-26 15:32:18'),
	(5, 'Laporan Neraca', 'neraca', 'QgZEoqdvx9PwYN7KEzepJmkXy60Glr', NULL, '2023-08-26 15:32:18', '2023-08-26 15:32:18'),
	(6, 'Laporan Catatan Atas Laporan Keuangan (Calk)', 'calk', 'QgZEoqdvx9PwYN7KEzepJmkXy60Glr', NULL, '2023-08-26 15:32:18', '2023-08-26 15:32:18'),
	(7, 'Dana Samsat', 'dana-samsat', 'QgZEoqdvx9PwYN7KEzepJmkXy60Glr', NULL, '2023-08-26 15:32:18', '2023-08-26 15:32:18');

-- Dumping structure for table db_sirelaku.laporan_neraca
CREATE TABLE IF NOT EXISTS `laporan_neraca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(500) NOT NULL DEFAULT '',
  `file_laporan` varchar(500) NOT NULL,
  `jenis` int(11) DEFAULT '0',
  `status` varchar(500) NOT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_sirelaku.laporan_neraca: ~0 rows (approximately)

-- Dumping structure for table db_sirelaku.laporan_neraca_percobaan
CREATE TABLE IF NOT EXISTS `laporan_neraca_percobaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(500) NOT NULL DEFAULT '',
  `file_laporan` varchar(500) NOT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_sirelaku.laporan_neraca_percobaan: ~0 rows (approximately)

-- Dumping structure for table db_sirelaku.laporan_operasional
CREATE TABLE IF NOT EXISTS `laporan_operasional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(500) NOT NULL DEFAULT '',
  `file_laporan` varchar(500) NOT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_sirelaku.laporan_operasional: ~1 rows (approximately)
INSERT INTO `laporan_operasional` (`id`, `deskripsi`, `file_laporan`, `uuid`, `created_at`, `updated_at`) VALUES
	(19, 'data operasional 20276', '898a2c36-c1b4-4aee-808d-50a60764fa00', 'eRgyrWqYw8KnGVzVKDBpPQ3oZlEJd4', '2023-08-19 04:09:36', '2023-08-19 04:10:08');

-- Dumping structure for table db_sirelaku.laporan_perubahan_ekuitas
CREATE TABLE IF NOT EXISTS `laporan_perubahan_ekuitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(500) NOT NULL DEFAULT '',
  `file_laporan` varchar(500) NOT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_sirelaku.laporan_perubahan_ekuitas: ~2 rows (approximately)
INSERT INTO `laporan_perubahan_ekuitas` (`id`, `deskripsi`, `file_laporan`, `uuid`, `created_at`, `updated_at`) VALUES
	(19, 'Data Perubahan Ekuitas 20292', '66151e75-dcf5-4e72-b7e1-7e823958e886', 'eRgyrWqYw8KnGVzVKDBpPQ3oZlEJd4', '2023-08-19 04:18:30', '2023-08-19 04:35:51');

-- Dumping structure for table db_sirelaku.laporan_realisasi_anggaran
CREATE TABLE IF NOT EXISTS `laporan_realisasi_anggaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(500) NOT NULL DEFAULT '',
  `file_laporan` varchar(500) NOT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_sirelaku.laporan_realisasi_anggaran: ~3 rows (approximately)
INSERT INTO `laporan_realisasi_anggaran` (`id`, `deskripsi`, `file_laporan`, `uuid`, `created_at`, `updated_at`) VALUES
	(20, 'data realisasi anggaran 2029', '4237f9b3-5874-46b4-b5d1-a689d3543dca', 'QgZEoqdvx9PwYN7KEzepJmkXy60Glr', '2023-08-19 03:34:50', '2023-08-19 03:34:50'),
	(21, 'realisasi anggaran 2020', '008a0d23-85ae-4ef4-ba63-f4bdb9f52bf5', '6JoqV2XgE3G9dLjoJ7KZY8NmvwWpx0', '2023-08-19 03:44:50', '2023-08-19 03:44:50'),
	(22, 'tes input', '7efd8d02-f584-45a7-ab40-1fa17ba2b655', 'QPpyw6keMNELV97Aq734AmKRnqXBG0', '2023-08-26 13:09:32', '2023-08-26 13:09:33');

-- Dumping structure for table db_sirelaku.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sirelaku.migrations: ~13 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2022_03_19_102456_create_permission_tables', 1),
	(6, '2022_03_29_105225_create_settings_table', 1),
	(7, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
	(8, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
	(9, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
	(10, '2016_06_01_000004_create_oauth_clients_table', 2),
	(11, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
	(12, '2023_07_19_011148_create_audits_table', 3),
	(13, '2023_08_04_000000_create_fileponds_table', 4);

-- Dumping structure for table db_sirelaku.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sirelaku.model_has_permissions: ~0 rows (approximately)

-- Dumping structure for table db_sirelaku.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sirelaku.model_has_roles: ~5 rows (approximately)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 112277),
	(14, 'App\\Models\\User', 112278),
	(16, 'App\\Models\\User', 112279),
	(15, 'App\\Models\\User', 112280),
	(17, 'App\\Models\\User', 112281);

-- Dumping structure for table db_sirelaku.oauth_access_tokens
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sirelaku.oauth_access_tokens: ~51 rows (approximately)
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
	('07195761e4ed2667474d5b202c0c97a3955bb3e2987d2c1163b5449117c29752621fc94592a248cc', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:48:00', '2023-02-10 02:48:00', '2024-02-10 09:48:00'),
	('0cacde07e93c6d9eafdef75044c47795fc94ff2ac233eb9f1c603b426135eb6d5b9843c6f175d5a3', 1, 3, 'travel_app', '[]', 0, '2023-02-10 03:50:06', '2023-02-10 03:50:06', '2024-02-10 10:50:06'),
	('34054cbb2d1a5cc5731652c5821b0c93b9eef5d4df15d7fb2bd9546b592829b5008c4747fb31eb53', 1, 3, 'travel_app', '[]', 0, '2023-02-14 04:14:20', '2023-02-14 04:14:20', '2024-02-14 11:14:20'),
	('3576c6b0526b1ae5e3454868cb3f13a534a0df1cbb980f1cd4d5f1c1d7956e6277da708ba363f24d', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:48:03', '2023-02-10 02:48:04', '2024-02-10 09:48:03'),
	('3ee726fee0c27ec5d33e5c1c227a2ec70e1a3743fedfe4de0bd0083df22b9ada5496b16dc64c161d', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:47:58', '2023-02-10 02:47:58', '2024-02-10 09:47:58'),
	('40928a7755933429a164d12723b70b4a7305880debdb4d7fc030627584fdec58b80630a4d39e2056', 1, 3, 'travel_app', '[]', 0, '2023-02-16 07:49:24', '2023-02-16 07:49:24', '2024-02-16 14:49:24'),
	('42605287b5f335d6e42e62aabe6829d351562e927e60f6714532e1b9e4b87442ab9b46c8e47092f7', 1, 3, 'travel_app', '[]', 0, '2023-02-10 03:06:53', '2023-02-10 03:06:53', '2024-02-10 10:06:53'),
	('42d94451cfa677a2782cd07d1dc6e34573223fecb5bd048b85acf017ba107a3d08063992bc29676c', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:55:11', '2023-02-10 02:55:11', '2024-02-10 09:55:11'),
	('4624418fdf90aaff4be39e48c70e5e62f3e97d84c868006e33a459f6eddea4c86332d35a88a83fa4', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:45:38', '2023-02-10 02:45:38', '2024-02-10 09:45:38'),
	('46cc8c07f5ee151fef04fac3cd547f25a41952c1455b91ed1208e145eb284dbb0145d69b55d4d896', 1, 3, 'travel_app', '[]', 0, '2023-02-16 07:49:36', '2023-02-16 07:49:36', '2024-02-16 14:49:36'),
	('496cbc87ec405170856ff0dfb0d14dde8fab1704142e9e3d355fe043933244efde631d06597742d9', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:48:01', '2023-02-10 02:48:01', '2024-02-10 09:48:01'),
	('4e04f79ca4db950533b69e31dddf5e8c4847c632e4c5e3e6dd76cf9e78bb467293762ebd6058ee19', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:45:33', '2023-02-10 02:45:33', '2024-02-10 09:45:33'),
	('51d044e81a090e9eb68d43e04a50e3057e603807bd10f985710c28118bcf8baecbe8417700d9aa2e', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:57:00', '2023-02-10 02:57:00', '2024-02-10 09:57:00'),
	('5726eb11138b5c01a79ad754e396c3e06f3af8490628ccb79f89c9b9285a83fedfd3be2737f63caa', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:57:50', '2023-02-10 02:57:50', '2024-02-10 09:57:50'),
	('586d56c63c8b46ef293738b9bfbcbe74879233ccf35e9aaf5f3807c0babd9cbde837154f6796d7f7', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:48:50', '2023-02-10 02:48:50', '2024-02-10 09:48:50'),
	('5b0e011a90d78964b14436e2a232a8a91cd576698dcb4aaa8abda0369fe03f092b249f94404eb792', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:48:04', '2023-02-10 02:48:04', '2024-02-10 09:48:04'),
	('6102e759812668631eca97be12ba78a3136499f751760ae541f34c82ae7e36647b234beb5ad4559a', 1, 3, 'travel_app', '[]', 0, '2023-02-10 03:01:43', '2023-02-10 03:01:43', '2024-02-10 10:01:43'),
	('67a872175f784ffd70a5b517d212986e786e5f55254b1255bcb2a904c65d5dd2c25b13cc5af78397', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:48:01', '2023-02-10 02:48:01', '2024-02-10 09:48:01'),
	('684bf7b2acd10b665831b60a6ec345ae428ca6b012faf1d7e83f7aa3563475a93fecf7bef97c203d', 1, 3, 'travel_app', '[]', 0, '2023-02-10 03:06:39', '2023-02-10 03:06:39', '2024-02-10 10:06:39'),
	('712683828de8b9a3ca5a6269171d88d9c2031a096922dad3421533efe7143c7ab3071c17dff57855', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:47:59', '2023-02-10 02:47:59', '2024-02-10 09:47:59'),
	('72aa8a12af40740c9151b1729c7caa19bbcf421ae4f6589ac2b7f0157eea443126a8659d1d85d6b6', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:43:09', '2023-02-10 02:43:09', '2024-02-10 09:43:09'),
	('73d4654d09902cc2adfd428a5c33277819a190f81cf53f7faef2a04c43f9f80f10bcc90e461166b8', 1, 3, 'travel_app', '[]', 0, '2023-02-10 03:49:55', '2023-02-10 03:49:55', '2024-02-10 10:49:55'),
	('7e8dd4f375f605e43ae0100f9c12f14d9949ff8fd1c186e013778a4568cca9a00cd5d48ae217fc68', 1, 3, 'travel_app', '[]', 0, '2023-02-10 03:49:42', '2023-02-10 03:49:42', '2024-02-10 10:49:42'),
	('81b83b003226cb344cd1571f9888c6617c2ecf417add0e943d7ade64fcc3abaea2454a424969cb5e', 1, 3, 'travel_app', '[]', 0, '2023-02-10 04:00:23', '2023-02-10 04:00:23', '2024-02-10 11:00:23'),
	('845f648de84d5d561a5216e8bda5ef86fd76a0eb93062e13aa6bce8482404a46b840b07799018107', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:49:47', '2023-02-10 02:49:47', '2024-02-10 09:49:47'),
	('88add6a6e08bf506d5ff89b34cce7c817315f594f5c366891c7688862e247ce18eb16a55a3d1810b', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:43:51', '2023-02-10 02:43:51', '2024-02-10 09:43:51'),
	('8c7ef32cb3046726582c7c33fa68829a9e5a62cd1a27f314ce296ee51c19c787f0520aafb420029f', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:46:51', '2023-02-10 02:46:51', '2024-02-10 09:46:51'),
	('94ca1d354083b9b0cfd6293e17f782e6f8fc82f23d88e53d76f6cc5509bb4158bb15fa1e91865660', 1, 3, 'travel_app', '[]', 0, '2023-02-10 03:00:52', '2023-02-10 03:00:52', '2024-02-10 10:00:52'),
	('99c86b2fd234a3c067fd9de2cba0b5b9548a9c03969537660344253950ba90f3d4ea03e86210fb9f', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:47:47', '2023-02-10 02:47:47', '2024-02-10 09:47:47'),
	('a50b8d7dadcd839424e17b87ff3ea0ed4a89c40c0f8685e0c9d6d196572c969dc5af9a282d5fdab2', 1, 3, 'travel_app', '[]', 0, '2023-02-10 03:50:44', '2023-02-10 03:50:44', '2024-02-10 10:50:44'),
	('a52aee9f34056e60dfecf34d6892e840725d9f9ff3982b69b065cb6bcfa68269cdc6ebe16f00a877', 1, 3, 'travel_app', '[]', 0, '2023-02-10 04:00:36', '2023-02-10 04:00:36', '2024-02-10 11:00:36'),
	('a5aeb225c40946778bf0cab82b4832e26913eae0b44e50e132a1261d76e343b76a1462ab605aab87', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:39:26', '2023-02-10 02:39:26', '2024-02-10 09:39:26'),
	('b0838337b3b206f22c762f1cb4f5b5229050188a06b1c2de2316f89539a1bb93b08d610f85a5be4e', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:48:28', '2023-02-10 02:48:28', '2024-02-10 09:48:28'),
	('b1150f06f0cf87e797ad45e3ca3099cfb9ed4e5c3271256db15a8b0ca8672a93aab3dd4c96606441', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:53:20', '2023-02-10 02:53:20', '2024-02-10 09:53:20'),
	('b702afff924ea5cb7f346a6d4f091f0b90f91cf99840f7522daeb6e9e21e361dc28f8ca3f26027fa', 1, 3, 'travel_app', '[]', 0, '2023-02-10 03:00:19', '2023-02-10 03:00:19', '2024-02-10 10:00:19'),
	('b75d04a1179639f7baa49aa1b8642aca64b16c07809b112ee78b57c21513964a73208132504b91ad', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:47:31', '2023-02-10 02:47:31', '2024-02-10 09:47:31'),
	('ba8dbbf3f767c0463e9c10f9c469ca25e7da7bf1ce44f86e4a61e035b5352ac8bbbe427c06f1ccd4', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:52:01', '2023-02-10 02:52:01', '2024-02-10 09:52:01'),
	('bc95985efc86e8c7f66c6183203132927489dd8388dc6be8fbf2f8d5ee77b0a72ce55b796959ad85', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:47:57', '2023-02-10 02:47:57', '2024-02-10 09:47:57'),
	('bd8783422a8fbb45cc055ba32e8c2eeef2920adf0ac407aa4396d65e8c4ac6f98096d90d03ebc268', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:52:40', '2023-02-10 02:52:40', '2024-02-10 09:52:40'),
	('beb7e55bdb2d6c832a3ab74c579083f15689aae02af9edb473d8c81e90886755b6b44e7247f44fd6', 1, 3, 'travel_app', '[]', 0, '2023-02-10 03:07:16', '2023-02-10 03:07:16', '2024-02-10 10:07:16'),
	('c54c013ff16cb8a8485972788ca9259fb971204356dca47a64d34806ca2e3ce54145ee74d62bf091', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:58:35', '2023-02-10 02:58:35', '2024-02-10 09:58:35'),
	('cb34f517ff11a4baf329ec0c1f882a557190c2b36cfd3836d647ea1ceaa871eba662ac19b14eae4a', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:48:02', '2023-02-10 02:48:02', '2024-02-10 09:48:02'),
	('cbb63530b733ae65dca1e64e01cba36404d10f19b22c1be10bc20e58238ba20a49045fd716a426eb', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:54:16', '2023-02-10 02:54:16', '2024-02-10 09:54:16'),
	('d4d42649ceaf47d124a286e8c8757153bfd927f7d83e9b5124b1f313ab2fd9b27e791e4de0dbb21c', 1, 3, 'travel_app', '[]', 0, '2023-02-10 03:03:13', '2023-02-10 03:03:13', '2024-02-10 10:03:13'),
	('d6476035308ff01e7ec6c7bfeb2bce749210bd266d62810a054f3bf20980de86148823d7a0f5a880', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:51:11', '2023-02-10 02:51:11', '2024-02-10 09:51:11'),
	('dcf481ec1031f5b01c5e38d5190618c47beae529770be2d5d9fad5ca634b70fe4610d98077e30f80', 1, 3, 'travel_app', '[]', 0, '2023-02-10 03:01:19', '2023-02-10 03:01:19', '2024-02-10 10:01:19'),
	('e85064d42efc83a34387f4f16197e552769ea9d9453d27794cf652ea23afd614c30703c6ece13dd5', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:48:06', '2023-02-10 02:48:06', '2024-02-10 09:48:06'),
	('f1047583c0155a8dd21987e78ae6e1987bd1506f7043cc619f9b2970c675c22e2dc8a8f91afa710d', 1, 3, 'travel_app', '[]', 0, '2023-02-10 03:50:22', '2023-02-10 03:50:22', '2024-02-10 10:50:22'),
	('f4c42877c8dc81562eb85db28a0e4f4c085f09f6c9ebb000b8b4ae7dc6cb998d67a1ab91c4d953ff', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:44:21', '2023-02-10 02:44:21', '2024-02-10 09:44:21'),
	('f59300ff7707dffbfe8ca91d3fc6788146e5f70f7dae61c0f71c955a0e8ba0822e59aaed512e8e13', 1, 3, 'travel_app', '[]', 0, '2023-02-10 02:44:11', '2023-02-10 02:44:11', '2024-02-10 09:44:11'),
	('f7ca225f38a0941b3f7efd72e441f4fcc863336fb5664428d55f8072ad29c964fdd7dd0c20062512', 1, 3, 'travel_app', '[]', 0, '2023-02-14 03:54:31', '2023-02-14 03:54:31', '2024-02-14 10:54:31');

-- Dumping structure for table db_sirelaku.oauth_auth_codes
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sirelaku.oauth_auth_codes: ~0 rows (approximately)

-- Dumping structure for table db_sirelaku.oauth_clients
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sirelaku.oauth_clients: ~4 rows (approximately)
INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
	(1, NULL, ' Personal Access Client', 'PgQEmkEv4ekJ0jYaVzlniQordOoNDUamae5XPU7J', NULL, 'http://localhost', 1, 0, 0, '2023-02-07 23:30:23', '2023-02-07 23:30:23'),
	(2, NULL, ' Password Grant Client', 'k5zn28UVAZQ6GWjTBSH8k7dRE0eSbo01ICoyyBbD', 'users', 'http://localhost', 0, 1, 0, '2023-02-07 23:30:23', '2023-02-07 23:30:23'),
	(3, NULL, ' Personal Access Client', 'KroPQIOvfRradoA220rgupPwaYmfzYh1TEpkF4ve', NULL, 'http://localhost', 1, 0, 0, '2023-02-09 08:29:33', '2023-02-09 08:29:33'),
	(4, NULL, ' Password Grant Client', '9EYzJJr2R1cMEd2yLtR9YqzrGeuVouEuD6IEPPrA', 'users', 'http://localhost', 0, 1, 0, '2023-02-09 08:29:33', '2023-02-09 08:29:33');

-- Dumping structure for table db_sirelaku.oauth_personal_access_clients
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sirelaku.oauth_personal_access_clients: ~2 rows (approximately)
INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2023-02-07 23:30:23', '2023-02-07 23:30:23'),
	(2, 3, '2023-02-09 08:29:33', '2023-02-09 08:29:33');

-- Dumping structure for table db_sirelaku.oauth_refresh_tokens
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sirelaku.oauth_refresh_tokens: ~0 rows (approximately)

-- Dumping structure for table db_sirelaku.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sirelaku.password_resets: ~0 rows (approximately)

-- Dumping structure for table db_sirelaku.pelaporan_chr
CREATE TABLE IF NOT EXISTS `pelaporan_chr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kementrian` text,
  `UAPA` varchar(500) DEFAULT NULL,
  `UAPPA_E1` varchar(500) DEFAULT NULL,
  `UAPPA_W` varchar(500) DEFAULT NULL,
  `penyelenggaraan_akuntansi` text,
  `penyajian_lk` text,
  `koreksi` text,
  `tgl_review` datetime DEFAULT NULL,
  `penandatangan_id` varchar(500) DEFAULT NULL,
  `direviu_oleh` varchar(500) DEFAULT NULL,
  `disusun_oleh` varchar(500) DEFAULT NULL,
  `disetujui_oleh` varchar(500) DEFAULT NULL,
  `file_chr` varchar(500) DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `uuid` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_pelaporan_chr_users` (`created_by`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_sirelaku.pelaporan_chr: ~0 rows (approximately)

-- Dumping structure for table db_sirelaku.pelaporan_ihr
CREATE TABLE IF NOT EXISTS `pelaporan_ihr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(500) NOT NULL DEFAULT '',
  `file_ihr` varchar(500) NOT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_sirelaku.pelaporan_ihr: ~0 rows (approximately)

-- Dumping structure for table db_sirelaku.pelaporan_pernyataan
CREATE TABLE IF NOT EXISTS `pelaporan_pernyataan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(500) NOT NULL DEFAULT '',
  `file_pernyataan` varchar(500) NOT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_sirelaku.pelaporan_pernyataan: ~0 rows (approximately)

-- Dumping structure for table db_sirelaku.penandatangan
CREATE TABLE IF NOT EXISTS `penandatangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(500) NOT NULL DEFAULT '',
  `nip` varchar(500) NOT NULL,
  `jabatan` varchar(500) NOT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_sirelaku.penandatangan: ~3 rows (approximately)
INSERT INTO `penandatangan` (`id`, `nama`, `nip`, `jabatan`, `uuid`, `created_at`, `updated_at`) VALUES
	(20, 'J. Makson', '1093019330192323', 'Pengendali Teknis', 'QgZEoqdvx9PwYN7KEzepJmkXy60Glr', '2023-08-19 05:45:21', '2023-08-19 09:13:45'),
	(21, 'Lian Mafutra, S.Kom', '0193013991823028103', 'Pengendali Air Sumur', '6JoqV2XgE3G9dLjoJ7KZY8NmvwWpx0', '2023-08-19 09:10:33', '2023-08-19 09:10:33'),
	(22, 'Joko', '029130938291839810', 'Kepala Badan Integrasi', 'QPpyw6keMNELV97Aq734AmKRnqXBG0', '2023-08-19 09:11:23', '2023-08-19 09:11:23');

-- Dumping structure for table db_sirelaku.peraturan
CREATE TABLE IF NOT EXISTS `peraturan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(500) DEFAULT NULL,
  `file_peraturan` varchar(500) NOT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_sirelaku.peraturan: ~1 rows (approximately)
INSERT INTO `peraturan` (`id`, `deskripsi`, `file_peraturan`, `uuid`, `created_at`, `updated_at`) VALUES
	(27, 'contoh file peraturan', 'de1f171f-e60f-4a8c-b6fc-67c38878d119', 'EQMyVpk5Bnv8O3j5QjXKdxeqZ0r26Y', '2023-08-29 13:57:34', '2023-08-29 13:57:35');

-- Dumping structure for table db_sirelaku.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_group_id` int(11) NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`),
  KEY `FK_permissions_permission_group` (`permission_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=216 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sirelaku.permissions: ~50 rows (approximately)
INSERT INTO `permissions` (`id`, `name`, `permission_group_id`, `desc`, `guard_name`, `created_at`, `updated_at`) VALUES
	(156, 'settings', 34, 'settings app style logo, icon, color, etc', 'web', '2023-08-20 17:39:09', '2023-08-24 12:12:32'),
	(157, 'role_permissions', 34, 'menu role permission khusus superadmin', 'web', '2023-08-20 17:39:09', '2023-08-24 12:12:39'),
	(158, 'sample_data', 34, 'sample data untuk crud', 'web', '2023-08-20 17:39:09', '2023-08-24 12:12:25'),
	(160, 'review_perencanaan', 29, 'upload pdf', 'web', '2023-08-20 17:42:55', '2023-08-20 17:45:33'),
	(161, 'review_pelaksanaan', 29, 'upload pdf', 'web', '2023-08-20 17:42:55', '2023-08-20 17:45:30'),
	(163, 'laporan_keuangan', 29, 'laporan keuangan input pdf oleh audity', 'web', '2023-08-20 17:49:08', '2023-08-20 17:49:08'),
	(164, 'tinjuk_chr', 29, 'tinjuk chr untuk pengiriman laporan ke audit', 'web', '2023-08-20 17:50:19', '2023-08-20 17:50:19'),
	(165, 'penandatangan-create', 31, NULL, 'web', '2023-08-23 08:29:27', '2023-08-23 08:29:27'),
	(166, 'penandatangan-list', 31, NULL, 'web', '2023-08-23 08:29:27', '2023-08-23 08:29:27'),
	(167, 'penandatangan-edit', 31, NULL, 'web', '2023-08-23 08:29:28', '2023-08-23 08:29:28'),
	(168, 'penandatangan-delete', 31, NULL, 'web', '2023-08-23 08:29:28', '2023-08-23 08:29:28'),
	(169, 'peraturan-create', 32, NULL, 'web', '2023-08-23 10:18:03', '2023-08-23 10:18:03'),
	(170, 'peraturan-edit', 32, NULL, 'web', '2023-08-23 10:18:03', '2023-08-23 10:18:03'),
	(171, 'peraturan-delete', 32, NULL, 'web', '2023-08-23 10:18:03', '2023-08-23 10:18:03'),
	(172, 'peraturan-list', 32, NULL, 'web', '2023-08-23 10:18:03', '2023-08-23 10:18:03'),
	(173, 'peraturan-manage', 32, 'no action datatable', 'web', '2023-08-23 14:46:40', '2023-08-25 11:04:14'),
	(174, 'penandatangan-manage', 31, 'hide action datatable', 'web', '2023-08-23 14:56:01', '2023-08-25 11:04:07'),
	(175, 'reviu-perencanaan-manage', 33, 'reviu-perencanaan', 'web', '2023-08-23 15:03:09', '2023-08-25 11:04:20'),
	(178, 'master-user-delete', 35, NULL, 'web', '2023-08-24 21:31:36', '2023-08-24 21:31:36'),
	(179, 'master-user-create', 35, NULL, 'web', '2023-08-24 21:32:03', '2023-08-24 21:32:03'),
	(180, 'master-user-edit', 35, NULL, 'web', '2023-08-24 21:32:03', '2023-08-24 21:32:03'),
	(181, 'master-user-forcelogin', 35, 'force login using id', 'web', '2023-08-24 21:32:03', '2023-08-24 21:32:21'),
	(182, 'master-user-list', 35, NULL, 'web', '2023-08-24 21:38:53', '2023-08-24 21:38:53'),
	(183, 'reviu-perencanaan-edit', 33, NULL, 'web', '2023-08-25 11:14:16', '2023-08-25 11:14:16'),
	(184, 'reviu-perencanaan-create', 33, NULL, 'web', '2023-08-25 11:14:16', '2023-08-25 11:14:16'),
	(185, 'reviu-perencanaan-delete', 33, NULL, 'web', '2023-08-25 11:14:16', '2023-08-25 11:14:16'),
	(186, 'dashboard-app', 34, 'dashboard for superadmin dev', 'web', '2023-08-25 14:03:27', '2023-08-25 14:03:39'),
	(191, 'pelaporan-pernyataan-list', 38, NULL, 'web', '2023-08-27 10:11:47', '2023-08-27 10:25:55'),
	(192, 'pelaporan-pernyataan-delete', 38, NULL, 'web', '2023-08-27 10:11:47', '2023-08-27 10:25:45'),
	(193, 'pelaporan-pernyataan-create', 38, NULL, 'web', '2023-08-27 10:11:47', '2023-08-27 10:25:40'),
	(194, 'pelaporan-pernyataan-edit', 38, NULL, 'web', '2023-08-27 10:11:47', '2023-08-27 10:25:51'),
	(196, 'pelaporan-pernyataan-manage', 38, NULL, 'web', '2023-08-27 10:16:10', '2023-08-27 10:26:05'),
	(197, 'pelaporan-ihr-create', 37, NULL, 'web', '2023-08-27 10:21:21', '2023-08-27 10:21:21'),
	(198, 'pelaporan-ihr-delete', 37, NULL, 'web', '2023-08-27 10:21:21', '2023-08-27 10:21:21'),
	(199, 'pelaporan-ihr-edit', 37, NULL, 'web', '2023-08-27 10:21:21', '2023-08-27 10:21:21'),
	(200, 'pelaporan-ihr-manage', 37, NULL, 'web', '2023-08-27 10:21:21', '2023-08-27 10:21:21'),
	(201, 'pelaporan-ihr-list', 37, NULL, 'web', '2023-08-27 10:21:55', '2023-08-27 10:21:55'),
	(202, 'pelaporan-chr-list', 39, NULL, 'web', '2023-08-27 10:48:21', '2023-08-27 10:48:21'),
	(203, 'pelaporan-chr-create', 39, NULL, 'web', '2023-08-27 10:48:21', '2023-08-27 10:48:21'),
	(204, 'pelaporan-chr-edit', 39, NULL, 'web', '2023-08-27 10:48:21', '2023-08-27 10:48:21'),
	(205, 'pelaporan-chr-delete', 39, NULL, 'web', '2023-08-27 10:48:21', '2023-08-27 10:48:21'),
	(206, 'pelaporan-chr-manage', 39, NULL, 'web', '2023-08-27 10:48:21', '2023-08-27 10:48:21'),
	(208, 'pelaporan-chr-input-reviu', 39, NULL, 'web', '2023-08-27 16:25:11', '2023-08-27 16:25:11'),
	(209, 'laporan-keuangan-reviu', 40, NULL, 'web', '2023-08-27 17:05:13', '2023-08-27 17:05:13'),
	(210, 'laporan-keuangan-create', 40, NULL, 'web', '2023-08-27 17:13:49', '2023-08-27 17:13:49'),
	(211, 'laporan-keuangan-show', 40, NULL, 'web', '2023-08-27 17:13:49', '2023-08-27 17:13:49'),
	(212, 'laporan-keuangan-edit', 40, NULL, 'web', '2023-08-27 17:13:49', '2023-08-27 17:13:49'),
	(213, 'laporan-keuangan-delete', 40, NULL, 'web', '2023-08-27 17:13:49', '2023-08-27 17:13:49'),
	(214, 'laporan-keuangan-list', 40, NULL, 'web', '2023-08-27 17:13:49', '2023-08-27 17:13:49'),
	(215, 'laporan-keuangan-manage', 40, NULL, 'web', '2023-08-27 17:13:49', '2023-08-27 17:13:49');

-- Dumping structure for table db_sirelaku.permission_group
CREATE TABLE IF NOT EXISTS `permission_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` text,
  `name` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sirelaku.permission_group: ~10 rows (approximately)
INSERT INTO `permission_group` (`id`, `desc`, `name`, `created_at`, `updated_at`) VALUES
	(29, 'Permission dont without group', 'ungroup', '2023-07-18 08:10:51', '2023-07-18 08:10:51'),
	(31, 'manajemen user penanda tangan untuk cetak surat CHR', 'penandatangan', '2023-08-23 08:28:46', '2023-08-23 08:31:48'),
	(32, 'peraturan file pdf', 'Peraturan', '2023-08-23 10:16:47', '2023-08-23 10:16:47'),
	(33, 'Reviu Perencanaan', 'Reviu Perencanaan', '2023-08-23 15:02:52', '2023-08-23 15:02:52'),
	(34, 'Sistem App', 'Sistem App', '2023-08-24 12:12:12', '2023-08-24 12:12:12'),
	(35, 'Manage User for superadmin dev', 'Master User Dev', '2023-08-24 21:28:53', '2023-08-24 21:33:09'),
	(37, 'Pelaporan Reviu IHR', 'Pelaporan Reviu IHR', '2023-08-27 10:10:42', '2023-08-27 10:10:42'),
	(38, 'Pelaporan Surat Pernyataan', 'Pelaporan Surat Pernyataan', '2023-08-27 10:10:52', '2023-08-27 10:10:52'),
	(39, NULL, 'Pelaporan CHR', '2023-08-27 10:47:58', '2023-08-27 10:47:58'),
	(40, 'untuk semua jenis laporan neraca, ekuitas, realisasi dll', 'laporan keuangan (semua jenis)', '2023-08-27 17:04:06', '2023-08-27 17:04:44');

-- Dumping structure for table db_sirelaku.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
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

-- Dumping data for table db_sirelaku.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table db_sirelaku.reviu_pelaksanaan
CREATE TABLE IF NOT EXISTS `reviu_pelaksanaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_surat_kerja` varchar(50) NOT NULL,
  `file_surat_kerja` varchar(500) NOT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_sirelaku.reviu_pelaksanaan: ~2 rows (approximately)
INSERT INTO `reviu_pelaksanaan` (`id`, `no_surat_kerja`, `file_surat_kerja`, `uuid`, `created_at`, `updated_at`) VALUES
	(16, 'd1213123ddddd', 'c0a48c9b-43a1-4671-aa2f-0fe75b0a3c46', 'reviupelak_mRZQx5GOergE8nDnw7v4MlW9VK0ABd', '2023-08-17 11:09:18', '2023-08-17 11:09:18'),
	(17, 'dwqdqwdddddd', '7c0d480f-d78d-47ba-baef-6744b0c5f087', 'reviupelak_dPKM4xB8yGAl2ZzLGj0qgYV6JmLpQW', '2023-08-17 11:10:15', '2023-08-17 11:10:15');

-- Dumping structure for table db_sirelaku.reviu_perencanaan
CREATE TABLE IF NOT EXISTS `reviu_perencanaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_surat_perintah` varchar(50) NOT NULL,
  `file_surat_perintah` varchar(500) NOT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_sirelaku.reviu_perencanaan: ~6 rows (approximately)
INSERT INTO `reviu_perencanaan` (`id`, `no_surat_perintah`, `file_surat_perintah`, `uuid`, `created_at`, `updated_at`) VALUES
	(6, '11/23232/21212', '3ad26b42-a571-432b-ae7c-f5a348b353cc', 'reviuperen_0xWBZqA9rgd5OP7M2jyeQX8pnlvoN6', '2023-08-17 02:01:09', '2023-08-17 02:01:09'),
	(8, 'dwqdwqdwqdwqdwqd', '5ff9adbd-9f21-43df-9388-ea6d59904f61', 'reviuperen_X4pqR0YOL3EyvwDrQz8nxWgP5kdJeM', '2023-08-17 02:24:07', '2023-08-17 02:24:07'),
	(11, 'dwqdqwdqwdwqdqdqdc', '99ab83ce-8f3f-40e8-b383-90ee04ddaca4', 'reviuperen_xNdg4o56pOVvRP7pODrnG0WLJM3eYk', '2023-08-17 02:28:23', '2023-08-17 02:28:23'),
	(12, 'dwqdqwdcccxccxccxc', 'f443ea7b-d373-4ecb-a299-a1c63bebcfed', 'reviuperen_RvVe6WGXp0xJBPjxYzAyYLm5klNdQO', '2023-08-17 02:32:21', '2023-08-17 02:32:21'),
	(13, 'nomor sudha updates', 'f82c0669-9203-4e2d-8d08-3ea2f96b26d1', 'reviuperen_6KA9okBReO3rLxjOn7YqWNpQV5M0yw', '2023-08-17 02:39:25', '2023-08-17 10:03:06');

-- Dumping structure for table db_sirelaku.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sirelaku.roles: ~5 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `guard_name`, `desc`, `created_at`, `updated_at`) VALUES
	(1, 'superadmin', 'web', 'Super Admin App', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(14, 'audity', 'web', 'User/sektor yang mengirim Data Laporan', '2023-08-20 17:00:48', '2023-08-20 17:00:48'),
	(15, 'audit', 'web', 'user/admin yang mereview laporan audity', '2023-08-20 17:02:11', '2023-08-20 17:02:11'),
	(16, 'pimpinan', 'web', 'hanya melihat laporan dan menyetujui hasil akhir revisi CHR', '2023-08-20 17:03:29', '2023-08-26 15:37:49'),
	(17, 'staff', 'web', 'admin yang menginput data', '2023-08-26 15:36:01', '2023-08-26 15:36:01');

-- Dumping structure for table db_sirelaku.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sirelaku.role_has_permissions: ~78 rows (approximately)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(163, 14),
	(164, 14),
	(172, 14),
	(191, 14),
	(201, 14),
	(210, 14),
	(212, 14),
	(213, 14),
	(214, 14),
	(215, 14),
	(160, 15),
	(161, 15),
	(163, 15),
	(164, 15),
	(165, 15),
	(166, 15),
	(167, 15),
	(168, 15),
	(169, 15),
	(170, 15),
	(171, 15),
	(172, 15),
	(173, 15),
	(174, 15),
	(175, 15),
	(178, 15),
	(179, 15),
	(180, 15),
	(182, 15),
	(183, 15),
	(184, 15),
	(185, 15),
	(191, 15),
	(192, 15),
	(193, 15),
	(194, 15),
	(196, 15),
	(197, 15),
	(198, 15),
	(199, 15),
	(200, 15),
	(201, 15),
	(202, 15),
	(203, 15),
	(204, 15),
	(205, 15),
	(206, 15),
	(208, 15),
	(209, 15),
	(213, 15),
	(160, 16),
	(161, 16),
	(163, 16),
	(166, 16),
	(172, 16),
	(191, 16),
	(192, 16),
	(193, 16),
	(194, 16),
	(197, 16),
	(198, 16),
	(199, 16),
	(201, 16),
	(202, 16),
	(203, 16),
	(204, 16),
	(206, 16),
	(160, 17),
	(161, 17),
	(169, 17),
	(170, 17),
	(171, 17),
	(172, 17),
	(173, 17),
	(175, 17),
	(183, 17),
	(184, 17),
	(185, 17);

-- Dumping structure for table db_sirelaku.sample
CREATE TABLE IF NOT EXISTS `sample` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `desc` text NOT NULL,
  `category_id` varchar(200) NOT NULL,
  `category_multi_id` varchar(200) NOT NULL,
  `days` varchar(200) NOT NULL,
  `month` varchar(200) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `date_publisher` datetime NOT NULL,
  `date_range_start` datetime NOT NULL,
  `date_range_end` datetime NOT NULL,
  `time` time NOT NULL,
  `price` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `password` varchar(50) NOT NULL,
  `contact` char(13) NOT NULL,
  `check` char(13) NOT NULL,
  `radio` char(13) NOT NULL,
  `file_cover` varchar(200) DEFAULT NULL,
  `file_cover_multi` varchar(200) DEFAULT NULL,
  `file_pdf` varchar(200) DEFAULT NULL,
  `summernote` text NOT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=409 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sirelaku.sample: ~31 rows (approximately)
INSERT INTO `sample` (`id`, `title`, `desc`, `category_id`, `category_multi_id`, `days`, `month`, `start_date`, `end_date`, `date_publisher`, `date_range_start`, `date_range_end`, `time`, `price`, `password`, `contact`, `check`, `radio`, `file_cover`, `file_cover_multi`, `file_pdf`, `summernote`, `uuid`, `created_at`, `updated_at`) VALUES
	(323, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 293029323.000000, '123456', '928392183', 'on', 'on', '172efa83-5a85-4938-836b-66f89a52896d', '4239ddf4-c0f0-4f56-b224-833991c2f7f0', 'bf4077ee-ce78-4c0c-bd80-b6d1aa4f392b', '<p><b>ok ini text editor</b></p>', 'samplecrud_v3Z4KJB59V0yljqgQDPX8GdmoQxnYe', '2023-08-10 23:09:12', '2023-08-10 23:09:12'),
	(324, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 293029323.000000, '123456', '928392183', 'on', 'on', NULL, 'fa9650a0-dfd6-4a80-a980-2471624eef33', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_oReLqBO8n5xdPjlmAzQkp9Zmy2vgYV', '2023-08-10 23:10:25', '2023-08-10 23:10:25'),
	(325, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 293029323.000000, '123456', '928392183', 'on', 'on', NULL, '5185e0d7-badb-4ff8-8ad9-b981dc538780', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_PrNW4v0ByMlRZ7NBv7Y32d6pQw5Km8', '2023-08-10 23:11:05', '2023-08-10 23:11:05'),
	(333, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 293029323.000000, '123456', '928392183', 'on', 'on', NULL, 'fe56c1b7-95db-4351-bcf5-bc649c5ff51f', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_wL2xGA9M5dQXJjkkWjBrey3gRE40lk', '2023-08-10 23:17:17', '2023-08-10 23:17:17'),
	(335, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 293029323.000000, '123456', '928392183', 'on', 'on', NULL, 'f6b65bc5-f248-4440-b57d-25b00f087c29', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_E8BRn6QOq5Pd2Dg4d7veJ90Xk4KNwZ', '2023-08-10 23:18:13', '2023-08-10 23:18:13'),
	(336, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 293029323.000000, '123456', '928392183', 'on', 'on', NULL, '759a8a4e-cc8a-404c-910f-bf826e5042e8', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_5P2ElqLwvNAeX73vvDRgZdB9rn3KJY', '2023-08-10 23:18:33', '2023-08-10 23:18:33'),
	(345, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 293029323.000000, '123456', '928392183', 'on', 'on', NULL, '773ae080-edb1-49d0-8402-af95674dcfd9', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_Jp8dGYoyqZwEND9oQjLvVQXRPM6kmO', '2023-08-10 23:22:24', '2023-08-10 23:22:24'),
	(346, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 293029323.000000, '123456', '928392183', 'on', 'on', NULL, 'a6b1fec5-1bb1-48c2-ba1c-e1abc6970f51', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_XwkLrPexlW94MjvAM7mpdN2Zq38oAO', '2023-08-10 23:22:35', '2023-08-10 23:22:35'),
	(347, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 1.000000, '123456', '928392183', 'on', 'on', NULL, '74ca7b64-3877-4845-8b95-62f55db6e1a9', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_xWBZqA9rgd5OPjM3yDyeQX8pnlvoN6', '2023-08-10 23:23:12', '2023-08-10 23:23:12'),
	(348, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 1.000000, '123456', '928392183', 'on', 'on', NULL, 'af888b59-06f9-4e6a-bbd5-fba9398eb0b0', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_6ERQXOwPv85dBzY8lj4qnp2LyZlrKA', '2023-08-10 23:23:17', '2023-08-10 23:23:17'),
	(349, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 1.000000, '123456', '928392183', 'on', 'on', NULL, '1c302992-b06f-4091-a747-5d36223137d5', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_4pqR0YOL3Eyvw7rQkD8nxWgP5kdJeM', '2023-08-10 23:23:49', '2023-08-10 23:23:49'),
	(353, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 1.000000, '123456', '928392183', 'on', 'on', NULL, '750df43b-3a32-4003-a44e-ff24550ee796', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_vVe6WGXp0xJBPzx5dDAyYLm5klNdQO', '2023-08-10 23:27:13', '2023-08-10 23:27:13'),
	(354, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 1.000000, '123456', '928392183', 'on', 'on', NULL, 'c9667289-7f5c-4ebc-81ac-2438f2bc3b66', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_KA9okBReO3rLxzOEB7YqWNpQV5M0yw', '2023-08-10 23:27:33', '2023-08-10 23:27:33'),
	(355, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 1.000000, '123456', '928392183', 'on', 'on', NULL, '9bb8a637-f3ae-43a0-812d-993a391d3831', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_vmEgM9Vo3Z45AjEVGzOXye2BqWQnlK', '2023-08-10 23:29:13', '2023-08-10 23:29:13'),
	(362, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 1.000000, '123456', '928392183', 'on', 'on', NULL, '73bca5cb-b1d1-446f-bad7-95987c3e6c16', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_JoqV2XgE3G9dLzoxvDKZY8NmvwWpx0', '2023-08-10 23:31:21', '2023-08-10 23:31:21'),
	(363, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 1.000000, '123456', '928392183', 'on', 'on', NULL, '61068334-5e67-4f89-9b93-57825912ea75', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_Ppyw6keMNELV9jAV4z34AmKRnqXBG0', '2023-08-10 23:31:32', '2023-08-10 23:31:32'),
	(364, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 1.000000, '123456', '928392183', 'on', 'on', NULL, '3fa6158d-e5fa-4840-a166-b2963e573909', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_v3Z4KJB59V0ylzqkQ7PX8GdmoQxnYe', '2023-08-10 23:31:46', '2023-08-10 23:31:46'),
	(365, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 1.000000, '123456', '928392183', 'on', 'on', NULL, 'be3a7b2c-d4a3-4dd6-8ce5-0610e177b2e7', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_oReLqBO8n5xdPzlkAjQkp9Zmy2vgYV', '2023-08-11 02:22:36', '2023-08-11 02:22:36'),
	(368, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 3233.000000, '123456', '928392183', 'on', 'on', NULL, '3f4cc8b3-b140-4fcf-b5d2-409b8d431bde', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_QMyVpk5Bnv8O3z5YGzXKdxeqZ0r26Y', '2023-08-11 02:42:33', '2023-08-11 02:42:33'),
	(381, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 210000.000000, '123456', '928392183', 'on', 'on', NULL, '5532d73e-2449-4bbe-891a-9b729f6c0e61', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_eXJOZG9WxABQl7J32jk2Kg4qnMVom3', '2023-08-11 02:49:19', '2023-08-11 02:49:19'),
	(382, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 23213.000000, '123456', '928392183', 'on', 'on', 'aee20d72-89e6-40c0-8977-0f9dad392bc0', '7fa7c351-74bf-4987-bb86-9dc33d9e1727', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_xoBXrLvPlW820jRPnDVmQ6NEn5wyMO', '2023-08-11 02:50:01', '2023-08-11 02:50:01'),
	(387, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 23213.000000, '123456', '928392183', 'on', 'on', '46c138a6-43e6-437e-b8bc-971cafbac188', '966ff223-982f-4b89-8852-28e0a35fe51c', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_XwkLrPexlW94MzvVMzmpdN2Zq38oAO', '2023-08-11 02:52:08', '2023-08-11 02:52:08'),
	(388, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 321312.000000, '123456', '928392183', 'on', 'on', 'ca17ad5f-1557-4349-a3b4-76aa4b2ca669', '242b0004-488c-4785-984e-f45bb15bd2a2', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_xWBZqA9rgd5OPzMky7yeQX8pnlvoN6', '2023-08-11 02:52:47', '2023-08-11 02:52:48'),
	(389, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 3213213.000000, '123456', '928392183', 'on', 'on', 'd1610e2b-e593-40c4-9df6-eabe134f61e9', 'fea8b4a9-0961-4e64-8abe-d3bd7bfcf511', NULL, '<p><b>ok ini text editor</b></p>', 'samplecrud_6ERQXOwPv85dBDY9lD4qnp2LyZlrKA', '2023-08-11 02:54:19', '2023-08-11 02:54:19'),
	(390, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '23:00:00', 3233.000000, '123456', '928392183', 'on', 'on', '1e7c4ef9-2f44-451e-8ab1-aeaa7dda066f', '91e1e0ba-57e3-4a60-8ef8-48fb2723923d', '87a45f7c-b4ca-4b2f-b21c-6283ea3ff32a', '<p><b>ok ini text editor</b></p>', 'samplecrud_4pqR0YOL3Eyvwjrokz8nxWgP5kdJeM', '2023-08-11 02:55:45', '2023-08-11 06:07:49'),
	(401, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 3123123.000000, '123456', '928392183', 'on', 'on', NULL, NULL, '9fffb284-7498-4173-91b4-f3d1ae1c8bb7', '<p><b>ok ini text editor</b></p>', 'samplecrud_3KpWkqYZeLgoNjwKNjE0MBX2APQv6R', '2023-08-11 06:14:41', '2023-08-11 06:14:41'),
	(403, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '03:00:00', 211.000000, '123456', '928392183', 'on', 'on', '1dce6efc-9cb9-43d8-bab6-4b02f4a03f87', '77354263-7efc-4908-ace6-4758f0956891', '17012d78-22c8-439f-901f-7f684ac28d32', '<p><b>ok ini text editor</b></p>', 'samplecrud_LP9Ox5B8MqNmdDWZgzQk4Av3RXwpWl', '2023-08-11 06:16:12', '2023-08-11 06:16:13'),
	(404, 'Story Of Huda Ganteng12312313', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '23:00:00', 8989.000000, '123456', '928392183', 'on', 'on', 'fc9a416d-69e8-46f3-899a-322e19b0702b', 'f0e720f9-2f73-4a35-b535-8ba6aceabad8', '6c1b394e-93e6-4e13-9e27-45f4a567ef06', '<p><b>ok ini text editor</b></p>', 'samplecrud_Jp8dGYoyqZwENz98KjLvVQXRPM6kmO', '2023-08-11 06:18:34', '2023-08-11 06:25:14'),
	(405, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 9090000.000000, '123456', '928392183', 'on', 'on', 'ca6b6b1a-297a-41cf-9e76-12007d4914ef', '3fa41d38-2994-4be4-8ea6-291425f0f94d', '2e2243d7-6aa7-4278-8a3e-a7c65e3950bb', '<p><b>ok ini text editor</b></p>', 'samplecrud_XwkLrPexlW94M7vVB7mpdN2Zq38oAO', '2023-08-11 09:40:10', '2023-08-11 09:40:12'),
	(407, 'Story Of Huda Ganteng 6666', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '23:00:00', 910390131.000000, '123456', '928392183', 'on', 'on', 'd1d3f276-f228-4c38-ba9d-615bb078b177', '2b4c8294-00f2-4c1c-9b76-b57cf4e2069c', '19a1f81b-48ae-46c6-a544-83ef5e7465b1', '<p><b>ok ini text editor</b></p>', 'samplecrud_6ERQXOwPv85dBjY9nj4qnp2LyZlrKA', '2023-08-11 09:42:14', '2023-08-12 03:41:56'),
	(408, 'Story Of Huda Ganteng', 'Lorem Ipsum kkaldka', 'fiction', '["fiction","biography"]', 'rabu', '3', '2023-08-05 00:00:00', '2023-08-06 00:00:00', '2023-08-27 00:00:00', '2023-08-03 00:00:00', '2023-08-26 00:00:00', '23:00:00', 22313123.000000, '123456', '928392183', 'on', 'on', '041b6871-1679-48f7-a151-fdc2d884a0e4', 'e67b2cb6-0802-4c1d-a85a-8f3fa2932c41', '6a987b57-0f55-4cdf-ac95-fb0c84771c0a', '<p><b>ok ini text editor</b></p>', 'samplecrud_4pqR0YOL3EyvwDroM78nxWgP5kdJeM', '2023-08-16 02:23:24', '2023-08-16 02:23:25');

-- Dumping structure for table db_sirelaku.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ext` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` enum('information','contact','payment','email','api') COLLATE utf8mb4_unicode_ci DEFAULT 'information',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sirelaku.settings: ~6 rows (approximately)
INSERT INTO `settings` (`id`, `key`, `value`, `name`, `type`, `ext`, `category`, `created_at`, `updated_at`) VALUES
	(1, 'app_name', '', 'Application Short Name', 'text', NULL, 'information', '2022-11-18 03:50:20', '2023-02-16 01:24:47'),
	(2, 'app_short_name', '', 'Application Name', 'text', NULL, 'information', '2022-11-18 03:50:20', '2023-02-16 01:24:47'),
	(3, 'app_logo', '', 'Application Logo', 'file', 'png', 'information', '2022-11-18 03:50:20', '2023-02-16 01:24:47'),
	(4, 'app_favicon', '', 'Application Favicon', 'file', 'png', 'information', '2022-11-18 03:50:20', '2023-02-16 01:24:47'),
	(5, 'app_loading_gif', '', 'Application Loading Image', 'file', 'gif', 'information', '2022-11-18 03:50:20', '2023-02-16 01:24:47'),
	(6, 'app_map_loaction', 'none', 'Application Map Location', 'textarea', NULL, 'contact', '2022-11-18 03:50:20', '2023-01-18 03:51:15');

-- Dumping structure for table db_sirelaku.styles
CREATE TABLE IF NOT EXISTS `styles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `value` varchar(50) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sirelaku.styles: ~3 rows (approximately)
INSERT INTO `styles` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
	(1, 'sidebar_color', '#673de6', '2023-07-18 16:05:24', '2023-07-18 16:05:25'),
	(2, 'sidebar_bg_color', '#ffffff', '2023-07-18 16:05:24', '2023-07-18 16:05:25'),
	(3, 'sidebar_header_bg', '#ffffff', '2023-07-18 16:05:24', '2023-07-18 16:05:25');

-- Dumping structure for table db_sirelaku.tinjuk_chr
CREATE TABLE IF NOT EXISTS `tinjuk_chr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pelaporan_chr_id` int(11) DEFAULT NULL,
  `deskripsi` varchar(500) NOT NULL DEFAULT '',
  `file_laporan` varchar(500) NOT NULL,
  `uuid` varchar(200) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_tinjuk_chr_pelaporan_chr` (`pelaporan_chr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_sirelaku.tinjuk_chr: ~0 rows (approximately)

-- Dumping structure for table db_sirelaku.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nama_lengkap` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontak` char(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `bio` text,
  `jenis_kelamin` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('AKTIF','NONAKTIF') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'AKTIF',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(33) DEFAULT NULL,
  `foto` varchar(500) DEFAULT NULL,
  `uuid` varchar(500) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=112282 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sirelaku.users: ~5 rows (approximately)
INSERT INTO `users` (`id`, `username`, `email`, `nama_lengkap`, `kontak`, `alamat`, `bio`, `jenis_kelamin`, `status`, `password`, `remember_token`, `nama`, `foto`, `uuid`, `last_login_at`, `last_login_ip`, `created_at`, `updated_at`) VALUES
	(112277, 'superadmin', 'lianmafutra@gmail.com', 'Lian Mafutra Dev', '082244261525', 'Jl. Jawa No.99Kebun Handil, Kec. Jelutung, Kota Jambi, Jambi 36125', NULL, 'L', 'AKTIF', '$2y$10$eqI2Y1rNVr1mWtPTF9txfO.XdkU1wyAw.I7lu.ChAGlB1JNsmwa8C', 'IyCWfAMiqEFo9ZeAT5PD7LzjM798BA5w4DomImnKXnfOQUsBAZqgLLxceQLt', NULL, 'adb830fe-a863-481b-849e-eba8715da241', 'user_0xWBZqA9rgd5OP7M2jyeQX8pnlvoN6', '2023-08-29 14:07:36', '127.0.0.1', '2023-07-06 04:28:03', '2023-08-29 14:07:36'),
	(112278, 'audity', 'bagus@gmail.com', 'bagus', '0899347282732', NULL, NULL, 'L', 'AKTIF', '$2y$10$Y7JfXasJdph4B5ENBl33b.WeFolGMj/kWKwKPVhgrNkOylOGiXb1W', 'R47WtHytvmkRR5RXSmoLy5jHFiOPaYdtSw3jDXCKSmxjBWSLx3QQAhr0dsp2', NULL, '03ae68df-59f0-4785-9bae-d80367c6c963', 'qwdqwd', '2023-08-29 13:54:55', '127.0.0.1', '2023-08-20 17:09:42', '2023-08-29 13:54:55'),
	(112279, 'pimpinan', NULL, 'Budiman', '083467568922', NULL, NULL, 'L', 'AKTIF', '$2y$10$jGCfIYuum/jo8EEOgI/NeumvGjiAkJfmW00LbvPpGUHHN97iZTl/y', 'hivH8tOQQAGCHgtLV6gWQLmhgKfq5W21lxzKpeJAgsqhCOKfkMYXqV8H9CFa', NULL, '446a6318-2cd5-419c-bc5d-3334802cf38f', 'dqddqwdwqdqwdqwd', '2023-08-29 13:55:11', '127.0.0.1', '2023-08-20 17:10:27', '2023-08-29 13:55:11'),
	(112280, 'auditor', NULL, 'Joko Anwar', '0892839283972', NULL, NULL, 'L', 'AKTIF', '$2y$10$VKXLGAkCaDyMfmFCcW4uCeIOaLnvRKVMKK9P9bffnr0HYXAyXZ/se', 'XF4ykTII0It1edz1nWjndCEnYWLhXipNXY91U896lGPzjsvUmfCi1ERWELBz', NULL, '674ecc24-54f0-4874-9c25-0d63a66fe3a9', 'frevtrhtr', '2023-08-29 13:55:08', '127.0.0.1', '2023-08-25 11:12:09', '2023-08-29 13:55:08'),
	(112281, 'staff', NULL, 'budiman staff', '0816726732134', NULL, NULL, NULL, 'AKTIF', '$2y$10$gf8LGJ/3kOr/EduKlffOHefMTdYjBXBo5r6t4HfLuZFhQdt6R/rWu', NULL, NULL, NULL, NULL, '2023-08-28 03:53:28', '127.0.0.1', '2023-08-26 13:26:52', '2023-08-28 03:53:28');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
