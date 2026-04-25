<?php
require_once '../includes/config.php';
// Basic auth check
if (empty($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Fetch live stats from database
$total_tags = $db->query("SELECT COUNT(*) FROM tag_profiles WHERE is_active=1")->fetchColumn();
$scans_today = $db->query("SELECT COUNT(*) FROM tag_scan_events WHERE DATE(scan_time)=CURDATE()")->fetchColumn();
$lost_tags = $db->query("SELECT COUNT(*) FROM tag_profiles WHERE status='lost'")->fetchColumn();
$expiring_soon = $db->query("SELECT COUNT(*) FROM tag_customers WHERE plan_expiry BETWEEN CURDATE() AND DATE_ADD(CURDATE(),INTERVAL 30 DAY)")->fetchColumn();
$new_today = $db->query("SELECT COUNT(*) FROM tag_customers WHERE DATE(created_at)=CURDATE()")->fetchColumn();

// Fetch recent scans
$recent_scans = $db->query("SELECT s.*, p.tag_uid, p.tag_type, c.username FROM tag_scan_events s JOIN tag_profiles p ON s.tag_id = p.id JOIN tag_customers c ON s.customer_id = c.id ORDER BY s.scan_time DESC LIMIT 10")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Master Admin Dashboard | Smart Tags</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { --brand: #1B4F9E; --dark: #0A2463; --danger: #DC2626; --bg: #F8FAFF; }
        body { font-family: 'DM Sans', sans-serif; background: var(--bg); margin: 0; display: flex; color: #1A202C; }
        .sidebar { width: 260px; background: var(--dark); color: white; height: 100vh; position: fixed; padding: 20px 0; }
        .sidebar-logo { padding: 0 24px 24px; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; font-size: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px; }
        .sidebar a { display: block; color: rgba(255,255,255,0.8); text-decoration: none; padding: 12px 24px; transition: 0.2s; }
        .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.1); color: white; border-left: 4px solid var(--brand); }
        .main { margin-left: 260px; padding: 32px; flex: 1; }
        h1 { font-family: 'Plus Jakarta Sans', sans-serif; margin-bottom: 24px; }
        
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 32px; }
        .stat-card { background: white; padding: 24px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border: 1px solid #E2E8F0; }
        .stat-card.danger { background: #FEF2F2; border-color: #FECACA; }
        .stat-title { font-size: 13px; color: #4A5568; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; margin-bottom: 8px; }
        .stat-value { font-size: 32px; font-weight: 800; font-family: 'Plus Jakarta Sans', sans-serif; }
        .stat-card.danger .stat-value { color: var(--danger); }

        .quick-actions { display: flex; gap: 12px; margin-bottom: 32px; }
        .btn { padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none; cursor: pointer; border: none; font-family: 'DM Sans', sans-serif; }
        .btn-primary { background: var(--brand); color: white; }
        .btn-secondary { background: white; color: var(--brand); border: 1px solid var(--brand); }
        .btn-danger { background: var(--danger); color: white; }

        .panel { background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border: 1px solid #E2E8F0; padding: 24px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #E2E8F0; }
        th { font-size: 13px; color: #4A5568; text-transform: uppercase; font-weight: 600; }
        td { font-size: 14px; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-logo">Smart Tags Admin</div>
    <a href="index.php" class="active">Dashboard</a>
    <a href="customers.php">Customers</a>
    <a href="create-customer.php">Create Customer & QR</a>
    <a href="lost-tags.php">Lost Tags <span style="background:red;color:white;padding:2px 8px;border-radius:10px;font-size:12px;float:right;"><?= $lost_tags ?></span></a>
    <a href="scans.php">Scan History</a>
    <a href="plans.php">Subscriptions</a>
    <a href="generate-qr.php">Bulk QR Generator</a>
    <a href="logout.php" style="margin-top:auto; border-top:1px solid rgba(255,255,255,0.1);">Logout</a>
</div>

<div class="main">
    <h1>Master Dashboard</h1>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-title">Active Tags</div>
            <div class="stat-value"><?= number_format($total_tags) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-title">Scans Today</div>
            <div class="stat-value"><?= number_format($scans_today) ?></div>
        </div>
        <div class="stat-card danger">
            <div class="stat-title">Lost Tags</div>
            <div class="stat-value"><?= number_format($lost_tags) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-title">New Customers Today</div>
            <div class="stat-value"><?= number_format($new_today) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-title">Expiring Soon (30d)</div>
            <div class="stat-value"><?= number_format($expiring_soon) ?></div>
        </div>
    </div>

    <div class="quick-actions">
        <a href="create-customer.php" class="btn btn-primary">+ New Customer</a>
        <a href="generate-qr.php" class="btn btn-secondary">Generate QR Files</a>
        <a href="lost-tags.php" class="btn btn-danger">View Lost Tags</a>
    </div>

    <div class="panel">
        <h2 style="margin-top:0;font-size:18px;">Live Scan Feed</h2>
        <table>
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Tag UID</th>
                    <th>Type</th>
                    <th>Customer</th>
                    <th>Location</th>
                    <th>Device</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($recent_scans as $scan): ?>
                <tr>
                    <td><?= $scan['scan_time'] ?></td>
                    <td><strong><?= $scan['tag_uid'] ?></strong></td>
                    <td><?= ucfirst($scan['tag_type']) ?></td>
                    <td><?= $scan['username'] ?></td>
                    <td><?= $scan['ip_city'] ? $scan['ip_city'].', '.$scan['ip_country'] : 'Unknown' ?></td>
                    <td><?= $scan['device_os'] ?> / <?= $scan['browser_name'] ?></td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($recent_scans)): ?>
                <tr><td colspan="6">No recent scans found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
