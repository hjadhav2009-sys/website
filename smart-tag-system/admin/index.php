<?php
/**
 * THEMENGIFT Smart Tag System Admin Dashboard
 */

require_once dirname(__DIR__) . '/includes/config.php';

// Secure authentication check for admin
// Ensure the user is logged into WordPress and has admin privileges
$wp_load_path = dirname(__DIR__, 2) . '/wp-load.php';
if (file_exists($wp_load_path)) {
    require_once($wp_load_path);
    if (!current_user_can('manage_options')) {
        die("Access denied. You must be an administrator.");
    }
} else {
    die("WordPress configuration not found. Access denied.");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Tag Admin Dashboard</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .dashboard-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; }
        .card { padding: 20px; border: 1px solid #ddd; border-radius: 8px; background: #f9f9f9; }
    </style>
</head>
<body>
    <h1>Smart Tag System - Admin Dashboard</h1>
    
    <div class="dashboard-grid">
        <div class="card">
            <h3>Total Tags</h3>
            <p>1,234</p>
        </div>
        <div class="card">
            <h3>Recent Scans</h3>
            <p>45 Today</p>
        </div>
        <div class="card" style="border-left: 4px solid red;">
            <h3>Lost Tags</h3>
            <p>3</p>
        </div>
    </div>
    
    <h2>Quick Actions</h2>
    <button>Generate New Tag Credentials</button>
    <button>View All Tags</button>
    <button>Download QR Codes</button>
</body>
</html>
