<?php
$recipients = [
    ['label' => 'For Her', 'default_img' => get_stylesheet_directory_uri() . '/assets/images/recipient-women.jpg', 'id' => '1'],
    ['label' => 'For Him', 'default_img' => get_stylesheet_directory_uri() . '/assets/images/recipient-men.jpg', 'id' => '2'],
    ['label' => 'For Couples', 'default_img' => get_stylesheet_directory_uri() . '/assets/images/recipient-couple.jpg', 'id' => '3'],
    ['label' => 'For Kids', 'default_img' => get_stylesheet_directory_uri() . '/assets/images/recipient-parents.jpg', 'id' => '4'],
];
?>
<section class="py-16 bg-white tmg-shop-recipient">
    <div class="tmg-container">
        <div class="flex items-end justify-between flex-wrap gap-4 mb-8">
            <div>
                <p class="text-[11px] font-bold tracking-[0.2em] text-[#86868B] mb-2 uppercase">Shop by Recipient</p>
                <h2 class="font-display m-0">Made for someone special</h2>
            </div>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
            <?php foreach($recipients as $r): 
                $img = get_theme_mod('tmg_recipient_img_'.$r['id'], $r['default_img']);
                $link = get_theme_mod('tmg_recipient_link_'.$r['id'], '#');
            ?>
            <a href="<?php echo esc_url($link); ?>" class="relative aspect-[3/4] rounded-2xl overflow-hidden group block">
                <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($r['label']); ?>" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
                <div class="absolute bottom-5 left-5 right-5 text-white">
                    <h3 class="text-white text-xl font-display m-0"><?php echo esc_html($r['label']); ?></h3>
                    <span class="text-sm inline-flex items-center gap-1 mt-1 opacity-90 group-hover:gap-2 transition-all">Shop now <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg></span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
