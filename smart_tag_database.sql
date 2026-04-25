SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ============================================================
-- TABLE 1: tag_customers
-- ============================================================
CREATE TABLE `tag_customers` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL UNIQUE COMMENT 'Format: TMG-XXXXX',
  `password_hash` varchar(255) NOT NULL COMMENT 'bcrypt — NEVER plain text',
  `email` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(15) NOT NULL COMMENT 'With country code: 919876543210',
  `google_id` varchar(255) DEFAULT NULL COMMENT 'Google OAuth ID if using Google login',
  `full_name` varchar(150) NOT NULL,
  `plan_type` enum('individual','family','corporate') DEFAULT 'individual',
  `plan_start` date DEFAULT NULL,
  `plan_expiry` date DEFAULT NULL COMMENT 'NULL for lifetime or never-expiring',
  `tags_allowed` int(3) DEFAULT 1 COMMENT '1 for individual, 4 for family, custom for corporate',
  `is_active` tinyint(1) DEFAULT 1,
  `reset_token` varchar(64) DEFAULT NULL,
  `reset_token_exp` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `idx_username` (`username`),
  INDEX `idx_whatsapp` (`whatsapp`),
  INDEX `idx_plan_expiry` (`plan_expiry`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE 2: tag_profiles
-- ============================================================
CREATE TABLE `tag_profiles` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `tag_uid` varchar(12) NOT NULL UNIQUE COMMENT 'Format: TMG-AB8X4K',
  `tag_type` enum(
    'dog','cat','rabbit','horse','farm_animal','bird',
    'luggage','backpack','laptop_bag','camera_bag','passport','wallet',
    'car_keys','bicycle','motorbike','scooter','helmet',
    'school_bag','kids_id_band','kids_shoe',
    'medical','emergency','allergy','blood_group',
    'electronics','instrument','toolbox','umbrella',
    'employee_id','asset','event_badge','couple','souvenir'
  ) NOT NULL,
  `status` enum('safe','lost','with_me') NOT NULL DEFAULT 'safe',
  `profile_data` JSON NOT NULL COMMENT 'All profile fields as JSON — structure varies by tag_type',
  `profile_photo` varchar(255) DEFAULT NULL COMMENT 'File path to main photo',
  `extra_photos` JSON DEFAULT NULL COMMENT 'Array of additional photo paths',
  `is_active` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=not activated, 1=live',
  `is_setup_done` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=wizard not completed',
  `reward_amount` decimal(8,2) DEFAULT NULL,
  `total_scans` int(11) UNSIGNED DEFAULT 0,
  `last_scanned_at` datetime DEFAULT NULL,
  `woo_order_id` bigint(20) DEFAULT NULL COMMENT 'Links to WooCommerce order',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `idx_tag_uid` (`tag_uid`),
  INDEX `idx_customer_id` (`customer_id`),
  INDEX `idx_tag_type` (`tag_type`),
  INDEX `idx_status` (`status`),
  FOREIGN KEY (`customer_id`) REFERENCES `tag_customers`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE 3: tag_scan_events
-- ============================================================
CREATE TABLE `tag_scan_events` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `scan_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(45) NOT NULL,
  `ip_city` varchar(100) DEFAULT NULL COMMENT 'PERMANENT — never deleted',
  `ip_region` varchar(100) DEFAULT NULL COMMENT 'PERMANENT',
  `ip_country` varchar(100) DEFAULT NULL COMMENT 'PERMANENT',
  `ip_isp` varchar(150) DEFAULT NULL,
  `ip_timezone` varchar(60) DEFAULT NULL,
  `ip_latitude` decimal(10,7) DEFAULT NULL COMMENT 'DELETED after 1 hour',
  `ip_longitude` decimal(10,7) DEFAULT NULL COMMENT 'DELETED after 1 hour',
  `gps_latitude` decimal(10,7) DEFAULT NULL COMMENT 'DELETED after 1 hour',
  `gps_longitude` decimal(10,7) DEFAULT NULL COMMENT 'DELETED after 1 hour',
  `gps_accuracy` decimal(8,2) DEFAULT NULL,
  `precision_type` enum('ip_only','ip_and_gps') DEFAULT 'ip_only',
  `device_type` varchar(20) DEFAULT NULL COMMENT 'mobile/desktop/tablet',
  `device_os` varchar(50) DEFAULT NULL,
  `browser_name` varchar(50) DEFAULT NULL,
  `screen_resolution` varchar(20) DEFAULT NULL,
  `timezone_js` varchar(60) DEFAULT NULL,
  `coordinates_expire` datetime NOT NULL COMMENT 'scan_time + 1 hour',
  `coordinates_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `whatsapp_sent` tinyint(1) NOT NULL DEFAULT 0,
  `whatsapp_sent_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_tag_id` (`tag_id`),
  INDEX `idx_scan_time` (`scan_time`),
  INDEX `idx_coordinates_expire` (`coordinates_expire`),
  FOREIGN KEY (`tag_id`) REFERENCES `tag_profiles`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`customer_id`) REFERENCES `tag_customers`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE 4: tag_subscriptions
-- ============================================================
CREATE TABLE `tag_subscriptions` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `plan_type` enum('individual','family','corporate') NOT NULL,
  `amount_paid` decimal(8,2) NOT NULL DEFAULT 0.00,
  `payment_method` enum('razorpay','manual','complimentary') NOT NULL,
  `razorpay_payment_id` varchar(100) DEFAULT NULL,
  `razorpay_order_id` varchar(100) DEFAULT NULL,
  `plan_start` date NOT NULL,
  `plan_end` date DEFAULT NULL,
  `is_lifetime` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','expired','cancelled','pending') DEFAULT 'active',
  `notes` text DEFAULT NULL COMMENT 'Admin notes for manual adjustments',
  `created_by` enum('customer','admin') NOT NULL DEFAULT 'customer',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_customer_id` (`customer_id`),
  INDEX `idx_plan_end` (`plan_end`),
  FOREIGN KEY (`customer_id`) REFERENCES `tag_customers`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE 5: tag_notifications
-- ============================================================
CREATE TABLE `tag_notifications` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `tag_id` int(11) UNSIGNED NOT NULL,
  `scan_event_id` int(11) UNSIGNED DEFAULT NULL,
  `notification_type` enum('scan_alert','lost_alert','plan_expiry','welcome','password_reset','otp') NOT NULL,
  `whatsapp_number` varchar(15) NOT NULL,
  `message_text` text NOT NULL,
  `sent_status` enum('sent','failed','pending') DEFAULT 'pending',
  `sent_at` datetime DEFAULT NULL,
  `error_message` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_customer_id` (`customer_id`),
  FOREIGN KEY (`customer_id`) REFERENCES `tag_customers`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE 6: tag_admin_sessions
-- ============================================================
CREATE TABLE `tag_admin_sessions` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `session_token` varchar(64) NOT NULL UNIQUE,
  `ip_address` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  INDEX `idx_session_token` (`session_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE 7: tag_qr_downloads
-- ============================================================
CREATE TABLE `tag_qr_downloads` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `file_format` enum('png','jpg','svg','pdf_a4','pdf_a6','dxf','eps','webp','zip') NOT NULL,
  `qr_size_mm` decimal(5,1) NOT NULL DEFAULT 30.0,
  `downloaded_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`tag_id`) REFERENCES `tag_profiles`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

COMMIT;
