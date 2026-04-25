<?php
/**
 * Pet Tag Profile Template - Premium Radiant UI Design
 */
if (!isset($tag)) die('Access denied');
$name      = htmlspecialchars($tag['name'] ?? 'Unknown Pet');
$breed     = htmlspecialchars($tag['breed'] ?? '');
$phone     = htmlspecialchars($tag['owner_phone'] ?? '');
$wa_phone  = preg_replace('/[^0-9]/', '', $phone);
$is_lost   = ($tag['status'] ?? '') === 'lost';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $name ?> — THEMENGIFT Smart Tag</title>
    <meta name="description" content="Smart pet profile for <?= $name ?>. Scan to contact the owner.">
    <meta name="robots" content="noindex">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: #FBFBFD;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 24px 16px 48px;
            color: #1D1D1F;
        }
        .card {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 24px 48px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 420px;
            overflow: hidden;
        }
        .card-top {
            background: linear-gradient(135deg, #0A2463, #172A45);
            padding: 32px 24px 64px;
            text-align: center;
            position: relative;
        }
        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.2em;
            color: rgba(255,255,255,0.6);
            text-transform: uppercase;
            margin-bottom: 20px;
            display: block;
        }
        .avatar {
            width: 120px; height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid rgba(255,255,255,0.3);
            background: rgba(255,255,255,0.1);
            margin: 0 auto 16px;
            display: block;
        }
        .avatar-placeholder {
            width: 120px; height: 120px;
            border-radius: 50%;
            border: 4px solid rgba(255,255,255,0.3);
            background: rgba(255,255,255,0.1);
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
        }
        .pet-name {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 6px;
        }
        .pet-breed {
            font-size: 14px;
            color: rgba(255,255,255,0.7);
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 16px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.1em;
            margin-top: 14px;
        }
        .badge-lost { background: #E53E3E; color: #fff; }
        .badge-safe { background: rgba(255,255,255,0.2); color: #fff; }
        .card-body {
            padding: 24px;
            margin-top: -32px;
        }
        .info-box {
            background: #FBFBFD;
            border: 1px solid #E5E5EA;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 12px;
        }
        .info-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.15em;
            color: #86868B;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .info-value {
            font-size: 15px;
            font-weight: 600;
            color: #1D1D1F;
        }
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
            transition: all 0.25s ease;
            margin-bottom: 10px;
            border: none;
            cursor: pointer;
        }
        .btn-call { background: #0A2463; color: #fff; }
        .btn-call:hover { background: #172A45; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(10,36,99,0.25); }
        .btn-whatsapp { background: #25D366; color: #fff; }
        .btn-whatsapp:hover { background: #1da851; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(37,211,102,0.3); }
        .powered-by {
            text-align: center;
            font-size: 12px;
            color: #86868B;
            margin-top: 24px;
        }
        .powered-by a { color: #0A2463; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-top">
            <span class="brand">TheMenGift Smart Tag</span>

            <?php if (!empty($tag['photo'])): ?>
                <img src="<?= htmlspecialchars($tag['photo']) ?>" alt="<?= $name ?>" class="avatar">
            <?php else: ?>
                <div class="avatar-placeholder">🐾</div>
            <?php endif; ?>

            <div class="pet-name"><?= $name ?></div>
            <?php if($breed): ?><div class="pet-breed"><?= $breed ?></div><?php endif; ?>

            <span class="status-badge <?= $is_lost ? 'badge-lost' : 'badge-safe' ?>">
                <?= $is_lost ? '🚨 LOST PET — Please Help!' : '✓ Safe & Happy' ?>
            </span>
        </div>

        <div class="card-body">
            <?php if(!empty($tag['description'])): ?>
            <div class="info-box">
                <div class="info-label">About <?= $name ?></div>
                <div class="info-value" style="font-weight:400; font-size:14px; line-height:1.6"><?= htmlspecialchars($tag['description']) ?></div>
            </div>
            <?php endif; ?>

            <?php if($phone): ?>
            <a href="tel:<?= $phone ?>" class="btn btn-call">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.56 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                📞 Call Owner
            </a>
            <?php if($wa_phone): ?>
            <a href="https://wa.me/<?= $wa_phone ?>?text=Hi%2C+I+found+<?= urlencode($name) ?>+and+scanned+their+THEMENGIFT+tag.+Please+contact+me!" class="btn btn-whatsapp">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                WhatsApp Owner
            </a>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <p class="powered-by">Powered by <a href="/">TheMenGift Smart Tags</a> · Made in India 🇮🇳</p>

    <script>
    // Silent GPS tracking
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
