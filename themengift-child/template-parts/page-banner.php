<?php
$page_banners = [
    'jewellery' => [
        'bg_image' => get_template_directory_uri() . '/assets/images/banners/jewellery-banner.jpg',
        'overlay' => 'rgba(10,36,99,0.55)',
        'eyebrow' => 'HANDCRAFTED IN INDIA',
        'heading' => 'Jewellery Made Just For You',
        'subtext' => 'Engraved necklaces, custom rings, bracelets and more — crafted with premium-grade materials.',
    ],
    'custom-gifts' => [
        'bg_image' => get_template_directory_uri() . '/assets/images/banners/gifts-banner.jpg',
        'overlay' => 'rgba(10,36,99,0.50)',
        'eyebrow' => 'PERSONALISED GIFTING',
        'heading' => 'Give Something Unforgettable',
        'subtext' => 'Every piece made to order. Your name, your photo, your story — engraved forever.',
    ],
    'smart-tags' => [
        'bg_image' => get_template_directory_uri() . '/assets/images/banners/tags-banner.jpg',
        'overlay' => 'rgba(10,36,99,0.60)',
        'eyebrow' => 'INDIA\'S MOST ADVANCED QR TAGS',
        'heading' => 'Never Lose What Matters',
        'subtext' => 'Smart QR + NFC tags for pets, luggage, kids and more. Scan. Connect. Reunite.',
    ],
    // Add banners for every page
];
?>
<section class="tmg-page-banner" style="background-image: url('<?= $bg_image ?>'); background-size: cover; background-position: center;">
    <div class="banner-overlay" style="background: <?= $overlay ?>;">
        <div class="container-tmg">
            <p class="eyebrow"><?= $eyebrow ?></p>
            <h1><?= $heading ?></h1>
            <p class="banner-sub"><?= $subtext ?></p>
        </div>
    </div>
</section>
