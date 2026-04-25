<?php
/**
 * Default Tag Profile Template
 */
if (!isset($tag)) die('Access denied');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($tag['name'] ?? 'Smart Tag') ?> - THEMENGIFT</title>
    <style>
        :root { --primary: #1A365D; --surface: #F8FAFC; }
        body { font-family: 'Inter', sans-serif; margin: 0; padding: 20px; background: var(--surface); text-align: center; }
        .card { background: white; border-radius: 12px; padding: 30px; max-width: 400px; margin: 50px auto; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1 { margin-top: 0; color: var(--primary); }
        .btn { display: inline-block; padding: 12px 24px; background: var(--primary); color: white; text-decoration: none; border-radius: 8px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Tag Found: <?= htmlspecialchars($tag['unique_id']) ?></h1>
        <p>This tag belongs to:</p>
        <h2 style="margin-bottom: 20px;"><?= htmlspecialchars($tag['owner_name'] ?? 'A THEMENGIFT User') ?></h2>
        
        <?php if (!empty($tag['owner_phone'])): ?>
            <a href="tel:<?= htmlspecialchars($tag['owner_phone']) ?>" class="btn">📞 Contact Owner</a>
        <?php else: ?>
            <p style="color: #718096;">The owner has not provided public contact details yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>
