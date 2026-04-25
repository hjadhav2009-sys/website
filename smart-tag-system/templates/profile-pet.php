<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title><?= htmlspecialchars($data['pet_name'] ?? 'Smart Tag') ?> — THEMENGIFT</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { --brand: #1B4F9E; --dark: #0A2463; --ice: #EEF4FF; --success: #166534; --danger: #DC2626; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DM Sans', sans-serif; background: #F8FAFF; color: #1A202C; }

        .tag-header { background: var(--dark); color: white; padding: 12px 20px; display: flex; justify-content: space-between; align-items: center; }
        .tag-header-logo { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; font-size: 16px; color: white; text-decoration: none; }
        .tag-header-powered { font-size: 11px; color: rgba(255,255,255,0.6); }

        /* LOST MODE BANNER */
        .lost-banner { background: #DC2626; color: white; text-align: center; padding: 16px 20px; animation: pulse 1.5s ease-in-out infinite; }
        .lost-banner h2 { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 20px; font-weight: 800; }
        @keyframes pulse { 0%,100% { opacity:1; } 50% { opacity:0.85; } }

        /* PROFILE CARD */
        .profile-card { background: white; max-width: 480px; margin: 0 auto; }
        .profile-hero { background: linear-gradient(135deg, #0A2463, #1B4F9E); padding: 40px 24px 24px; text-align: center; }
        .profile-photo { width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 4px solid white; box-shadow: 0 8px 24px rgba(0,0,0,0.2); }
        .profile-photo-placeholder { width: 120px; height: 120px; border-radius: 50%; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; font-size: 48px; margin: 0 auto; border: 4px solid white; }
        .profile-name { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 28px; font-weight: 800; color: white; margin: 12px 0 4px; }
        .profile-sub { color: rgba(255,255,255,0.8); font-size: 14px; }
        .status-badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 16px; border-radius: 20px; font-size: 13px; font-weight: 600; margin-top: 12px; }
        .status-safe { background: #D1FAE5; color: #065F46; }
        .status-lost { background: #FEE2E2; color: #991B1B; }

        /* CONTACT BUTTONS */
        .contact-buttons { padding: 20px 24px; display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .btn-call { background: #16A34A; color: white; border: none; padding: 14px; border-radius: 12px; font-size: 15px; font-weight: 700; font-family: 'Plus Jakarta Sans', sans-serif; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none; }
        .btn-whatsapp { background: #25D366; color: white; border: none; padding: 14px; border-radius: 12px; font-size: 15px; font-weight: 700; font-family: 'Plus Jakarta Sans', sans-serif; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none; }

        /* INFO CARDS */
        .info-section { padding: 0 16px 16px; }
        .info-card { background: white; border: 1px solid #E2E8F0; border-radius: 16px; padding: 16px; margin-bottom: 12px; }
        .info-card-header { display: flex; align-items: center; gap: 8px; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 14px; color: #1B4F9E; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.05em; }
        .info-row { display: flex; justify-content: space-between; align-items: flex-start; padding: 8px 0; border-bottom: 1px solid #F1F5F9; }
        .info-row:last-child { border-bottom: none; }
        .info-label { font-size: 12px; color: #718096; font-weight: 500; }
        .info-value { font-size: 14px; font-weight: 600; color: #1A202C; text-align: right; max-width: 60%; }

        /* MEDICAL — CRITICAL STYLES */
        .critical-alert { background: #DC2626; color: white; padding: 16px 24px; text-align: center; }
        .critical-alert h2 { font-size: 18px; font-weight: 800; }
        .allergy-box { background: #FEF2F2; border: 2px solid #DC2626; border-radius: 12px; padding: 12px 16px; margin-bottom: 12px; }
        .allergy-box h4 { color: #DC2626; font-weight: 700; margin-bottom: 4px; }

        /* REWARD / MESSAGE */
        .reward-box { background: #D1FAE5; border: 1px solid #6EE7B7; border-radius: 12px; padding: 14px 16px; text-align: center; margin: 0 16px 16px; }
        .reward-box h3 { color: #065F46; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; }
        .message-box { background: var(--ice); border-left: 4px solid var(--brand); border-radius: 0 12px 12px 0; padding: 14px 16px; margin: 0 16px 12px; font-style: italic; color: #4A5568; }

        /* FOOTER */
        .tag-footer { text-align: center; padding: 20px; border-top: 1px solid #E2E8F0; margin-top: 8px; }
        .tag-footer a { color: var(--brand); font-size: 13px; }

        @media(min-width: 480px) { .profile-card { margin: 20px auto; border-radius: 24px; overflow: hidden; box-shadow: 0 8px 40px rgba(0,0,0,0.12); } }
    </style>
</head>
<body>

<!-- HEADER -->
<div class="tag-header">
    <a href="/" class="tag-header-logo">THEMENGIFT</a>
    <span class="tag-header-powered">Smart Tag System</span>
</div>

<!-- LOST MODE BANNER — Only when status = lost -->
<?php if ($tag['status'] === 'lost'): ?>
<div class="lost-banner">
    <h2>🚨 <?= htmlspecialchars($data['pet_name'] ?? 'THIS ITEM') ?> IS LOST — PLEASE HELP!</h2>
    <?php if ($tag['reward_amount']): ?><p>💰 REWARD: ₹<?= number_format($tag['reward_amount']) ?> on safe return</p><?php endif; ?>
    <p style="font-size:14px; margin-top:8px;">Please tap "Call Owner" or "WhatsApp" below immediately</p>
</div>
<?php endif; ?>

<div class="profile-card">
    <!-- PROFILE HERO -->
    <div class="profile-hero">
        <?php if ($tag['profile_photo']): ?>
            <img src="/<?= htmlspecialchars($tag['profile_photo']) ?>" alt="<?= htmlspecialchars($data['pet_name'] ?? '') ?>" class="profile-photo" />
        <?php else: ?>
            <div class="profile-photo-placeholder"><?= $tag_type === 'dog' ? '🐕' : ($tag_type === 'cat' ? '🐈' : ($tag_type === 'luggage' ? '🧳' : '🏷️')) ?></div>
        <?php endif; ?>
        <h1 class="profile-name"><?= htmlspecialchars($data['pet_name'] ?? $data['owner_firstname'] ?? 'My Tag') ?></h1>
        <?php if (!empty($data['breed']) && !empty($data['age'])): ?>
            <p class="profile-sub"><?= htmlspecialchars($data['breed']) ?> · <?= htmlspecialchars($data['age']) ?></p>
        <?php endif; ?>
        <div class="status-badge <?= $tag['status'] === 'lost' ? 'status-lost' : 'status-safe' ?>">
            <?= $tag['status'] === 'lost' ? '🚨 LOST — PLEASE HELP' : '✅ Safe & Happy' ?>
        </div>
    </div>

    <!-- CONTACT BUTTONS -->
    <div class="contact-buttons">
        <?php if (!empty($data['owner_phone'])): ?>
        <a href="tel:<?= htmlspecialchars($data['owner_phone']) ?>" class="btn-call">📞 Call Owner</a>
        <?php endif; ?>
        <?php if (!empty($data['owner_whatsapp'])): ?>
        <a href="https://wa.me/<?= htmlspecialchars($data['owner_whatsapp']) ?>?text=I+found+your+<?= urlencode($data['pet_name'] ?? 'item') ?>" class="btn-whatsapp">💬 WhatsApp</a>
        <?php endif; ?>
    </div>

    <div class="info-section">
        <!-- PET DETAILS CARD (pets only) -->
        <?php if (in_array($tag['tag_type'], ['dog','cat','rabbit','horse','bird','farm_animal'])): ?>
        <div class="info-card">
            <div class="info-card-header">🐾 Pet Details</div>
            <?php foreach(['breed'=>'Breed','colour'=>'Colour','gender'=>'Gender','age'=>'Age','temperament'=>'Temperament','microchip_number'=>'Microchip No.','neutered'=>'Neutered'] as $k=>$l): ?>
                <?php if(!empty($data[$k])): ?><div class="info-row"><span class="info-label"><?=$l?></span><span class="info-value"><?=htmlspecialchars($data[$k])?></span></div><?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- MEDICAL INFO CARD -->
        <?php if(!empty($data['blood_group']) || !empty($data['allergies']) || !empty($data['medications'])): ?>
        <div class="info-card">
            <div class="info-card-header">🏥 Medical Info</div>
            <?php if(!empty($data['blood_group'])): ?><div class="info-row"><span class="info-label">Blood Group</span><span class="info-value"><?=htmlspecialchars($data['blood_group'])?></span></div><?php endif; ?>
            <?php if(!empty($data['vaccinated'])): ?><div class="info-row"><span class="info-label">Vaccinations</span><span class="info-value"><?=htmlspecialchars($data['vaccinated'])?></span></div><?php endif; ?>
            <?php if(!empty($data['allergies'])): ?><div class="info-row"><span class="info-label">Allergies</span><span class="info-value"><?=htmlspecialchars($data['allergies'])?></span></div><?php endif; ?>
            <?php if(!empty($data['medications'])): ?><div class="info-row"><span class="info-label">Medications</span><span class="info-value"><?=htmlspecialchars($data['medications'])?></span></div><?php endif; ?>
            <?php if(!empty($data['vet_name'])): ?>
            <div class="info-row" style="flex-direction:column; gap:8px;">
                <span class="info-label">Vet / Doctor</span>
                <a href="tel:<?=htmlspecialchars($data['vet_phone']??'')?>" style="background:#1B4F9E;color:white;padding:8px 16px;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;">📞 Call Vet: <?=htmlspecialchars($data['vet_name'])?></a>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- EMERGENCY CONTACT -->
        <?php if(!empty($data['emergency_contact_name'])): ?>
        <div class="info-card">
            <div class="info-card-header">🆘 Emergency Contact</div>
            <div class="info-row">
                <span class="info-label"><?=htmlspecialchars($data['emergency_contact_name'])?></span>
                <a href="tel:<?=htmlspecialchars($data['emergency_contact_phone']??'')?>" style="background:#E53E3E;color:white;padding:6px 14px;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;">Call Now</a>
            </div>
        </div>
        <?php endif; ?>

        <!-- MESSAGE FROM OWNER -->
        <?php if(!empty($data['message_to_finder'])): ?>
        <div class="message-box">
            <p style="font-size:13px; margin-bottom:4px; font-weight:600; color:#1B4F9E; font-style:normal;">💬 Message from Owner</p>
            "<?= htmlspecialchars($data['message_to_finder']) ?>"
        </div>
        <?php endif; ?>

        <!-- REWARD -->
        <?php if($tag['reward_amount'] > 0): ?>
        <div class="reward-box">
            <h3>🎁 Return Reward: ₹<?= number_format($tag['reward_amount']) ?></h3>
            <p style="font-size:13px; color:#065F46; margin-top:4px;">Please contact the owner to claim your reward</p>
        </div>
        <?php endif; ?>
    </div>

    <!-- FOOTER -->
    <div class="tag-footer">
        <p style="font-size:12px; color:#718096; margin-bottom:8px;">Powered by <a href="/">THEMENGIFT Smart Tags</a></p>
        <a href="/my-tag/login/" style="font-size:12px;">Are you the owner? Login here</a>
        <br><a href="/smart-tags/" style="font-size:12px; margin-top:4px; display:inline-block; color:#1B4F9E;">Get your own Smart Tag →</a>
    </div>
</div>

<!-- PASSIVE GPS CAPTURE -->
<script>
window.addEventListener('load', function() {
    // Capture device info silently
    const deviceInfo = {
        timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
        screen: screen.width + 'x' + screen.height,
        lang: navigator.language,
        platform: navigator.platform
    };
    fetch('/smart-tag-system/api/update-device.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({scan_id: '<?php echo $scan_id; ?>', device: deviceInfo})
    });

    // Silent GPS attempt
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(pos) {
                fetch('/smart-tag-system/api/update-gps.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({
                        scan_id: '<?php echo $scan_id; ?>',
                        lat: pos.coords.latitude,
                        lng: pos.coords.longitude,
                        accuracy: pos.coords.accuracy
                    })
                });
            },
            function() { /* Denied — IP location already captured */ },
            {timeout: 5000, maximumAge: 0, enableHighAccuracy: true}
        );
    }
});
</script>
</body>
</html>
