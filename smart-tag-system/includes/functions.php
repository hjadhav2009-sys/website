<?php
/**
 * THEMENGIFT Smart Tag System Core Functions
 */

require_once __DIR__ . '/config.php';

/**
 * Generate a unique Tag ID (e.g. TMG-AB8X4K)
 */
function generate_tag_id() {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $random_string = '';
    for ($i = 0; $i < 6; $i++) {
        $random_string .= $chars[rand(0, strlen($chars) - 1)];
    }
    return 'TMG-' . $random_string;
}

/**
 * Capture IP Location (Passive GPS Layer 1)
 */
function capture_ip_location($ip) {
    // In production, use ip-api.com or similar
    $url = "http://ip-api.com/json/{$ip}";
    
    // Add simple caching/error handling here for production
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    $response = curl_exec($ch);
    curl_close($ch);
    
    if ($response) {
        $data = json_decode($response, true);
        if ($data && $data['status'] == 'success') {
            return [
                'city' => $data['city'],
                'state' => $data['regionName'],
                'country' => $data['country'],
                'lat' => $data['lat'],
                'lon' => $data['lon']
            ];
        }
    }
    return null;
}

/**
 * Send WhatsApp Notification (e.g. via WATI or Twilio)
 */
function send_whatsapp_alert($phone, $message) {
    // API config (move to config.php in production)
    $api_url = "https://api.wati.io/api/v1/sendSessionMessage/" . urlencode($phone);
    $access_token = "YOUR_WATI_ACCESS_TOKEN"; // Replace with real token
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url . "?messageText=" . urlencode($message));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer {$access_token}"
    ]);
    curl_setopt($ch, CURLOPT_POST, 1);
    
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return ($httpcode == 200);
}
