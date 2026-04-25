<?php
/**
 * THEMENGIFT Smart Tag System Configuration
 */

// Inherit WordPress database connection if running on same server
$wp_config_path = dirname(__DIR__) . '/wp-config.php';
if (file_exists($wp_config_path)) {
    require_once($wp_config_path);
    define('TAG_DB_HOST', DB_HOST);
    define('TAG_DB_NAME', DB_NAME);
    define('TAG_DB_USER', DB_USER);
    define('TAG_DB_PASSWORD', DB_PASSWORD);
} else {
    // Fallback for local testing
    define('TAG_DB_HOST', 'localhost');
    define('TAG_DB_NAME', 'themengift_tags');
    define('TAG_DB_USER', 'root');
    define('TAG_DB_PASSWORD', '');
}

define('TAG_DB_PREFIX', 'tag_');
define('TAG_SITE_URL', 'https://themengift.com/my-tag');

// Connect to Database
try {
    $pdo = new PDO(
        "mysql:host=" . TAG_DB_HOST . ";dbname=" . TAG_DB_NAME . ";charset=utf8mb4",
        TAG_DB_USER,
        TAG_DB_PASSWORD,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed. Please contact support.");
}

// Start Session
session_start();
