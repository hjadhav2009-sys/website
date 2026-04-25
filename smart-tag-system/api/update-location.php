<?php
/**
 * GPS Location Update Endpoint
 * Receives precise lat/lon from device GPS and updates the scan record.
 */
require_once dirname(__DIR__) . '/includes/config.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data['tag_id']) && !empty($data['lat']) && !empty($data['lon'])) {
    $tag_id = $data['tag_id'];
    $lat = (float) $data['lat'];
    $lon = (float) $data['lon'];
    $ip = $_SERVER['REMOTE_ADDR'];
    
    // Find the latest scan for this tag by IP (to update layer 1 with layer 2 data)
    // In production, we'd pass a specific scan_id, but this is a simple fallback
    $stmt = $pdo->prepare("
        UPDATE " . TAG_DB_PREFIX . "scans 
        SET lat = ?, lon = ? 
        WHERE tag_id = (SELECT id FROM " . TAG_DB_PREFIX . "tags WHERE unique_id = ?) 
        AND ip_address = ? 
        ORDER BY scanned_at DESC LIMIT 1
    ");
    
    if ($stmt->execute([$lat, $lon, $tag_id, $ip])) {
        echo json_encode(['status' => 'success']);
        exit;
    }
}

echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
