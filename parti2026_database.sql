-- MySQL Dump for PARTI 2026 Himatif UMS
-- Database: u324744819_PartiUms

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('SUPERADMIN','KESEKRETARIATAN') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'KESEKRETARIATAN',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `must_change_password` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_created_by_foreign` (`created_by`),
  CONSTRAINT `users_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Initial Superadmin Account
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `is_active`, `must_change_password`, `created_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', 'admin@parti2026.com', NOW(), '$2y$12$y6VGmCqwm3kkvGyKBtioJOMxL7uJkWkDukS8CpCpqGEw8IXO/XBSS', 'SUPERADMIN', 1, 0, NULL, NULL, NOW(), NOW());

-- -----------------------------------------------------
-- Table `password_reset_tokens`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `sessions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
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

-- -----------------------------------------------------
-- Table `cache`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `cache_locks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `jobs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `job_batches`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
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

-- -----------------------------------------------------
-- Table `failed_jobs`
-- -----------------------------------------------------
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

-- -----------------------------------------------------
-- Table `sub_events`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sub_events`;
CREATE TABLE `sub_events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `year` smallint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` enum('ONLINE','OFFLINE','HYBRID') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'OFFLINE',
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `pj_names` json DEFAULT NULL,
  `htm_tiers` json DEFAULT NULL,
  `poster_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gform_link` json DEFAULT NULL,
  `gform_updated_by` bigint unsigned DEFAULT NULL,
  `gform_updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('DRAFT','PUBLISHED','CLOSED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `order` int unsigned NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sub_events_year_slug_unique` (`year`,`slug`),
  KEY `sub_events_year_status_index` (`year`,`status`),
  KEY `sub_events_gform_updated_by_foreign` (`gform_updated_by`),
  CONSTRAINT `sub_events_gform_updated_by_foreign` FOREIGN KEY (`gform_updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `sponsors`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sponsors`;
CREATE TABLE `sponsors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `year` smallint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tier` enum('PLATINUM','GOLD','SILVER','BRONZE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'SILVER',
  `order` int unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sponsors_year_index` (`year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `sub_event_documents`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sub_event_documents`;
CREATE TABLE `sub_event_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sub_event_id` bigint unsigned NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size_bytes` int unsigned NOT NULL,
  `order` int unsigned NOT NULL DEFAULT '0',
  `uploaded_by` bigint unsigned NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sub_event_documents_sub_event_id_foreign` (`sub_event_id`),
  KEY `sub_event_documents_uploaded_by_foreign` (`uploaded_by`),
  CONSTRAINT `sub_event_documents_sub_event_id_foreign` FOREIGN KEY (`sub_event_id`) REFERENCES `sub_events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sub_event_documents_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `timeline_items`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `timeline_items`;
CREATE TABLE `timeline_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `year` smallint unsigned NOT NULL,
  `sub_event_id` bigint unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `timeline_items_year_index` (`year`),
  KEY `timeline_items_sub_event_id_foreign` (`sub_event_id`),
  CONSTRAINT `timeline_items_sub_event_id_foreign` FOREIGN KEY (`sub_event_id`) REFERENCES `sub_events` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `audit_logs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `audit_logs`;
CREATE TABLE `audit_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `action` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity_type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity_id` bigint unsigned NOT NULL,
  `field_changed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_value` text COLLATE utf8mb4_unicode_ci,
  `new_value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `audit_logs_user_id_foreign` (`user_id`),
  KEY `audit_logs_entity_type_entity_id_index` (`entity_type`,`entity_id`),
  KEY `audit_logs_created_at_index` (`created_at`),
  CONSTRAINT `audit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `settings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `faqs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `faqs`;
CREATE TABLE `faqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Umum',
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Initial FAQ Seed Data
INSERT INTO `faqs` (`id`, `question`, `answer`, `category`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Bagaimana cara mendaftar sub-acara / lomba di PARTI?', 'Anda dapat mendaftar melalui halaman detail sub-acara terkait pada website ini, kemudian mengklik tombol "Daftar Sekarang" untuk mengisi formulir pendaftaran resmi.', 'Pendaftaran', 1, 1, NOW(), NOW()),
(2, 'Apakah pendaftaran terbuka untuk umum atau khusus mahasiswa UMS?', 'Beberapa sub-acara terbuka untuk umum (pelajar/mahasiswa nasional), dan beberapa sub-acara khusus untuk internal mahasiswa UMS. Silakan cek syarat pada halaman masing-masing sub-acara.', 'Pendaftaran', 2, 1, NOW(), NOW()),
(3, 'Apakah ada biaya pendaftaran untuk mengikuti acara ini?', 'Informasi biaya pendaftaran berbeda-beda untuk setiap sub-acara. Sebagian acara bersifat gratis dan sebagian memiliki biaya pendaftaran terjangkau.', 'Pendaftaran', 3, 1, NOW(), NOW()),
(4, 'Apakah seluruh peserta akan mendapatkan e-sertifikat?', 'Ya, seluruh peserta yang terdaftar resmi dan mengikuti rangkaian acara hingga selesai akan mendapatkan e-sertifikat resmi dari HIMATIF UMS.', 'Pendaftaran', 4, 1, NOW(), NOW()),
(5, 'Apakah rangkaian acara PARTI dilaksanakan secara online atau offline?', 'Pelaksanaan acara bersifat hybrid (kombinasi online dan offline). Tahap penyisihan kompetisi umumnya online, sedangkan acara puncak dilaksanakan secara offline di kampus UMS.', 'Pelaksanaan Acara', 1, 1, NOW(), NOW()),
(6, 'Di mana lokasi pelaksanaan acara puncak PARTI?', 'Acara puncak akan dilaksanakan di Kompleks Kampus 2 / Kampus 3 Universitas Muhammadiyah Surakarta. Detail gedung dan ruangan akan diinformasikan menjelang hari H.', 'Pelaksanaan Acara', 2, 1, NOW(), NOW()),
(7, 'Di mana saya bisa mengunduh Rulebook / Buku Panduan Lomba?', 'Rulebook dapat diunduh langsung melalui tombol "Unduh Rulebook" pada halaman detail sub-acara yang Anda ikuti.', 'Kompetisi & Panduan', 1, 1, NOW(), NOW()),
(8, 'Apakah peserta boleh mendaftar lebih dari satu sub-acara?', 'Boleh, selama jadwal pelaksanaan antar sub-acara tidak bentrok dan peserta memenuhi persyaratan masing-masing perlombaan.', 'Kompetisi & Panduan', 2, 1, NOW(), NOW());

-- -----------------------------------------------------
-- Table `migrations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_07_12_070649_create_sub_events_table', 1),
(5, '2026_07_12_070705_create_sponsors_table', 1),
(6, '2026_07_12_070723_create_sub_event_documents_table', 1),
(7, '2026_07_12_070740_create_timeline_items_table', 1),
(8, '2026_07_12_070822_create_audit_logs_table', 1),
(9, '2026_07_12_214915_add_type_and_location_to_sub_events_table', 1),
(10, '2026_07_12_221047_change_action_column_in_audit_logs_table', 1),
(11, '2026_07_13_103200_add_poster_path_to_sub_events_table', 1),
(12, '2026_08_03_100000_create_settings_table', 1),
(13, '2026_08_24_140300_change_gform_link_to_json_in_sub_events_table', 1),
(14, '2026_08_24_143919_create_faqs_table', 1);

SET FOREIGN_KEY_CHECKS = 1;
