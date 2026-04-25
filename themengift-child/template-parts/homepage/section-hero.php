<?php
/**
 * Hero Slider Section - Radiant UI Style with WP Customizer support
 */
$slides = [
    [
        'eyebrow'  => 'NEW COLLECTION',
        'title'    => 'Style That',
        'em'       => 'Defines',
        'title2'   => 'You',
        'body'     => 'Premium jewellery for every mood. Made in India. Loved across the country.',
        'cta1'     => ['label'=>'Shop Jewellery',       'href'=>'/jewellery'],
        'cta2'     => ['label'=>'Explore Collections',  'href'=>'/shop'],
        'img'      => get_theme_mod('tmg_hero_img_1', get_stylesheet_directory_uri().'/assets/images/hero-jewellery.jpg'),
    ],
    [
        'eyebrow'  => 'PERSONALISED GIFTING',
        'title'    => 'Give Something',
        'em'       => 'Unforgettable',
        'title2'   => '',
        'body'     => 'Engraved keepsakes, photo gifts and curated hampers — crafted just for them.',
        'cta1'     => ['label'=>'Shop Custom Gifts', 'href'=>'/custom-gifts'],
        'cta2'     => ['label'=>'Build a Gift Box',  'href'=>'/custom-gifts'],
        'img'      => get_theme_mod('tmg_hero_img_2', get_stylesheet_directory_uri().'/assets/images/hero-gifts.jpg'),
    ],
    [
        'eyebrow'  => "INDIA'S MOST ADVANCED",
        'title'    => 'Smart Tags for',
        'em'       => 'Everything',
        'title2'   => 'you love',
        'body'     => 'QR-engraved pet, travel & vehicle tags. Lifetime profile. Lost-found alerts.',
        'cta1'     => ['label'=>'Explore Smart Tags', 'href'=>'/smart-tags'],
        'cta2'     => ['label'=>'How It Works',       'href'=>'/smart-tags'],
        'img'      => get_theme_mod('tmg_hero_img_3', get_stylesheet_directory_uri().'/assets/images/hero-smart-tag.jpg'),
    ],
];
?>
<section class="relative" id="tmg-hero-slider">
    <div class="relative overflow-hidden" style="height:580px;">
        <?php foreach($slides as $idx => $s): ?>
        <div class="absolute inset-0 transition-opacity duration-1000 tmg-slide <?= $idx===0?'opacity-100':'opacity-0 pointer-events-none' ?>" data-slide="<?= $idx ?>">
            <img src="<?= esc_url($s['img']) ?>" alt="<?= esc_attr($s['eyebrow']) ?>" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0" style="background: linear-gradient(to right, rgba(10,36,99,0.95) 0%, rgba(10,36,99,0.7) 50%, transparent 100%);"></div>
        </div>
        <?php endforeach; ?>

        <!-- Content -->
        <div class="relative h-full tmg-container flex items-center">
            <?php foreach($slides as $idx => $s): ?>
            <div class="absolute max-w-xl text-white tmg-slide-content transition-opacity duration-700 <?= $idx===0?'opacity-100':'opacity-0 pointer-events-none' ?>" data-content="<?= $idx ?>">
                <span class="inline-block text-white text-[11px] font-bold tracking-widest px-3 py-1.5 rounded-full mb-5" style="background:rgba(255,255,255,0.15);backdrop-filter:blur(4px);">
                    <?= esc_html($s['eyebrow']) ?>
                </span>
                <h1 class="text-white mb-5" style="line-height:1.05;font-family:'Playfair Display',serif;font-size:clamp(2.5rem,5vw,4rem);">
                    <?= esc_html($s['title']) ?> <em style="font-style:italic;font-weight:800;"><?= esc_html($s['em']) ?></em> <?= esc_html($s['title2']) ?>
                </h1>
                <p style="color:rgba(255,255,255,0.8);font-size:1.1rem;max-width:28rem;margin-bottom:2rem;"><?= esc_html($s['body']) ?></p>
                <div class="flex flex-wrap gap-3">
                    <a href="<?= esc_url($s['cta1']['href']) ?>" class="inline-flex items-center gap-2 bg-white font-semibold px-7 py-3.5 rounded-lg transition shadow-lg" style="color:#0A2463;">
                        <?= esc_html($s['cta1']['label']) ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </a>
                    <a href="<?= esc_url($s['cta2']['href']) ?>" class="inline-flex items-center gap-2 font-semibold px-7 py-3.5 rounded-lg transition" style="border:2px solid rgba(255,255,255,0.8);color:#fff;">
                        <?= esc_html($s['cta2']['label']) ?>
                    </a>
                </div>
                <div class="mt-9 flex flex-wrap gap-x-6 gap-y-3 text-sm" style="color:rgba(255,255,255,0.85);">
                    <span class="flex items-center gap-2">⭐ 4.8/5 Rating</span>
                    <span class="flex items-center gap-2">🏅 Trademark Registered</span>
                    <span class="flex items-center gap-2">🚚 Free shipping ₹699+</span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Prev/Next Arrows -->
        <button id="tmg-prev" aria-label="Previous slide" class="hidden md:grid place-items-center absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full text-white transition" style="background:rgba(255,255,255,0.15);backdrop-filter:blur(4px);">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"></path></svg>
        </button>
        <button id="tmg-next" aria-label="Next slide" class="hidden md:grid place-items-center absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full text-white transition" style="background:rgba(255,255,255,0.15);backdrop-filter:blur(4px);">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"></path></svg>
        </button>

        <!-- Dots -->
        <div class="absolute flex gap-2" style="bottom:20px;left:50%;transform:translateX(-50%);">
            <?php foreach($slides as $idx => $s): ?>
            <button class="tmg-dot h-2 rounded-full transition-all <?= $idx===0?'w-8 bg-white':'w-2' ?> " aria-label="Go to slide <?= $idx+1 ?>" data-dot="<?= $idx ?>" style="<?= $idx!==0?'background:rgba(255,255,255,0.45)':'' ?>"></button>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
(function(){
    var slides = document.querySelectorAll('.tmg-slide');
    var contents = document.querySelectorAll('.tmg-slide-content');
    var dots = document.querySelectorAll('.tmg-dot');
    var cur = 0, total = slides.length, timer;

    function show(n){
        slides[cur].classList.replace('opacity-100','opacity-0');
        slides[cur].classList.add('pointer-events-none');
        contents[cur].classList.replace('opacity-100','opacity-0');
        contents[cur].classList.add('pointer-events-none');
        dots[cur].classList.remove('w-8','bg-white');
        dots[cur].classList.add('w-2');
        dots[cur].style.background='rgba(255,255,255,0.45)';

        cur = (n + total) % total;

        slides[cur].classList.replace('opacity-0','opacity-100');
        slides[cur].classList.remove('pointer-events-none');
        contents[cur].classList.replace('opacity-0','opacity-100');
        contents[cur].classList.remove('pointer-events-none');
        dots[cur].classList.add('w-8','bg-white');
        dots[cur].classList.remove('w-2');
        dots[cur].style.background='';
    }

    function auto(){ timer = setInterval(function(){ show(cur+1); }, 6000); }
    function reset(){ clearInterval(timer); auto(); }

    document.getElementById('tmg-next').addEventListener('click',function(){ show(cur+1); reset(); });
    document.getElementById('tmg-prev').addEventListener('click',function(){ show(cur-1); reset(); });
    dots.forEach(function(d){ d.addEventListener('click', function(){ show(+d.dataset.dot); reset(); }); });
    auto();
})();
</script>
