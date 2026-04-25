<?php
/**
 * Medical Emergency Tag Profile Template - Premium Radiant UI Design
 */
if (!isset($tag)) die('Access denied');
$name      = htmlspecialchars($tag['name'] ?? 'Unknown Patient');
$blood     = htmlspecialchars($tag['blood_group'] ?? '?');
$cond      = htmlspecialchars($tag['medical_conditions'] ?? 'None Listed');
$allergy   = htmlspecialchars($tag['allergies'] ?? 'None Known');
$meds      = nl2br(htmlspecialchars($tag['medications'] ?? 'None Listed'));
$phone     = htmlspecialchars($tag['owner_phone'] ?? '');
$phone2    = htmlspecialchars($tag['emergency_contact_2'] ?? '');
$doctor    = htmlspecialchars($tag['vet_name'] ?? 'Not listed');
$wa_phone  = preg_replace('/[^0-9]/', '', $phone);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>⚠️ MEDICAL ALERT — <?= $name ?></title>
    <meta name="robots" content="noindex">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: #FFF5F5;
            min-height: 100vh;
            color: #1D1D1F;
        }

        /* Emergency Banner */
        .alert-banner {
            background: #E53E3E;
            color: #fff;
            padding: 16px;
            text-align: center;
            font-weight: 800;
            font-size: 18px;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            animation: pulse-bg 2s infinite;
        }
        @keyframes pulse-bg {
            0%,100% { background: #E53E3E; }
            50% { background: #C53030; }
        }

        .container {
            max-width: 520px;
            margin: 0 auto;
            padding: 20px 16px 48px;
        }

        /* Profile Card */
        .profile-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(229,62,62,0.1);
            margin-bottom: 16px;
        }
        .profile-top {
            background: linear-gradient(135deg, #C53030, #E53E3E);
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .avatar {
            width: 80px; height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255,255,255,0.4);
            background: rgba(255,255,255,0.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 32px;
            shrink: 0;
            flex-shrink: 0;
        }
        .profile-name {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 700;
            color: #fff;
        }
        .blood-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.25);
            color: #fff;
            font-weight: 800;
            font-size: 16px;
            padding: 4px 14px;
            border-radius: 999px;
            margin-top: 8px;
        }

        /* Info Cards */
        .info-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            margin-bottom: 16px;
        }
        .info-card-header {
            padding: 14px 20px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            border-bottom: 1px solid #FED7D7;
        }
        .info-card-header.danger { background: #FFF5F5; color: #E53E3E; }
        .info-card-header.blue { background: #EBF8FF; color: #2B6CB0; }
        .info-card-body { padding: 20px; }
        .data-row {
            display: flex;
            flex-direction: column;
            gap: 3px;
            padding-bottom: 14px;
            margin-bottom: 14px;
            border-bottom: 1px solid #F7FAFC;
        }
        .data-row:last-child { border: none; padding-bottom: 0; margin-bottom: 0; }
        .data-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.12em;
            color: #86868B;
            text-transform: uppercase;
        }
        .data-value {
            font-size: 15px;
            font-weight: 600;
            color: #1D1D1F;
            line-height: 1.5;
        }
        .data-value.critical { color: #E53E3E; font-weight: 700; font-size: 16px; }

        /* Action Buttons */
        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.25s ease;
            margin-bottom: 10px;
        }
        .btn-emergency { background: #E53E3E; color: #fff; }
        .btn-emergency:hover { background: #C53030; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(229,62,62,0.35); }
        .btn-secondary { background: #fff; color: #E53E3E; border: 2px solid #E53E3E; }
        .btn-secondary:hover { background: #FFF5F5; transform: translateY(-2px); }
        .btn-call2 { background: #2B6CB0; color: #fff; }
        .btn-call2:hover { background: #1A365D; transform: translateY(-2px); }

        .powered-by {
            text-align: center;
            font-size: 12px;
            color: #86868B;
            margin-top: 20px;
        }
        .powered-by a { color: #0A2463; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
    <div class="alert-banner">⚠️ &nbsp;MEDICAL EMERGENCY&nbsp; ⚠️</div>

    <div class="container">

        <!-- Profile -->
        <div class="profile-card">
            <div class="profile-top">
                <?php if (!empty($tag['photo'])): ?>
                    <img src="<?= htmlspecialchars($tag['photo']) ?>" alt="Photo" class="avatar">
                <?php else: ?>
                    <div class="avatar">🏥</div>
                <?php endif; ?>
                <div>
                    <div class="profile-name"><?= $name ?></div>
                    <div class="blood-badge">🩸 <?= $blood ?></div>
                </div>
            </div>
        </div>

        <!-- Critical Conditions -->
        <div class="info-card">
            <div class="info-card-header danger">⚠ Critical Medical Information</div>
            <div class="info-card-body">
                <div class="data-row">
                    <span class="data-label">Primary Condition</span>
                    <span class="data-value critical"><?= $cond ?></span>
                </div>
                <div class="data-row">
                    <span class="data-label">Severe Allergies — DO NOT GIVE</span>
                    <span class="data-value critical"><?= $allergy ?></span>
                </div>
                <div class="data-row">
                    <span class="data-label">Current Medications</span>
                    <span class="data-value"><?= $meds ?></span>
                </div>
            </div>
        </div>

        <!-- Emergency Contacts -->
        <div class="info-card">
            <div class="info-card-header blue">📞 Emergency Contacts</div>
            <div class="info-card-body">
                <?php if($phone): ?>
                <a href="tel:<?= $phone ?>" class="btn btn-emergency">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.56 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    📞 Call Primary Contact
                </a>
                <?php endif; ?>
                <?php if($phone2): ?>
                <a href="tel:<?= $phone2 ?>" class="btn btn-call2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.56 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    📞 Call Secondary Contact
                </a>
                <?php endif; ?>
                <div class="data-row" style="margin-top:12px">
                    <span class="data-label">Personal Doctor</span>
                    <span class="data-value"><?= $doctor ?></span>
                </div>
            </div>
        </div>

    </div>

    <p class="powered-by">Powered by <a href="/">TheMenGift Smart Tags</a> · Made in India 🇮🇳</p>

    <script>
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(pos) {
            fetch('/my-tag/api/update-location.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({ tag_id: '<?= $tag_id ?>', lat: pos.coords.latitude, lon: pos.coords.longitude })
            }).catch(function(){});
        }, function(){});
    }
    </script>
</body>
</html>
