<?php
/**
 * THEMENGIFT Smart Tag System Router
 * Handles all requests to themengift.com/my-tag/
 */

require_once __DIR__ . '/includes/functions.php';

// Simple Router
$request_uri = $_SERVER['REQUEST_URI'];
$base_path = '/my-tag/'; // Change this if deployed elsewhere

$path = str_replace($base_path, '', $request_uri);
$path = strtok($path, '?');

// Route: Login/Setup
if ($path == 'login' || $path == 'setup') {
    require_once __DIR__ . '/templates/login.php';
    exit;
}

// Route: Public Tag Profile (e.g. /my-tag/TMG-AB8X4K)
if (preg_match('/^TMG-[A-Z0-9]{6}$/i', $path, $matches)) {
    $tag_id = strtoupper($matches[0]);
    
    // 1. Fetch Tag from DB
    $stmt = $pdo->prepare("SELECT * FROM " . TAG_DB_PREFIX . "tags WHERE unique_id = ?");
    $stmt->execute([$tag_id]);
    $tag = $stmt->fetch();
    
    if (!$tag) {
        die("Tag not found.");
    }
    
    // 2. Capture Location (Passive GPS)
    $ip = $_SERVER['REMOTE_ADDR'];
    $location = capture_ip_location($ip);
    
    if ($location) {
        $stmt = $pdo->prepare("INSERT INTO " . TAG_DB_PREFIX . "scans (tag_id, ip_address, city, state, country, lat, lon) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$tag['id'], $ip, $location['city'], $location['state'], $location['country'], $location['lat'], $location['lon']]);
        
        // If Premium/Corporate, send WhatsApp alert
        if ($tag['plan_id'] > 1 && $tag['owner_phone']) {
            $maps_url = "https://maps.google.com/?q={$location['lat']},{$location['lon']}";
            send_whatsapp_alert($tag['owner_phone'], "Your tag was scanned in {$location['city']}! View on map: $maps_url");
        }
    }
    
    // 3. Load appropriate template based on tag type
    $allowed_types = ['pet', 'travel', 'medical', 'kids', 'vehicle', 'corporate'];
    $type = in_array($tag['type'], $allowed_types) ? $tag['type'] : 'default';
    
    $template_file = __DIR__ . "/templates/profile-{$type}.php";
    
    if (file_exists($template_file)) {
        require_once $template_file;
    } else {
        require_once __DIR__ . "/templates/profile-default.php";
    }
    exit;
}

// Default Fallback
echo "Welcome to THEMENGIFT Smart Tag System.";
