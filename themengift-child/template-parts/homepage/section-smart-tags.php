<?php
$img = get_theme_mod('tmg_smart_tag_img', get_stylesheet_directory_uri() . '/assets/images/smart-tag.jpg');
?>
<section class="py-16 bg-white">
    <div class="tmg-container grid lg:grid-cols-2 gap-12 items-center">
        <div class="relative">
            <img src="<?php echo esc_url($img); ?>" alt="Smart pet tag" loading="lazy" class="rounded-3xl shadow-lg aspect-[4/3] object-cover w-full" />
            <div class="absolute -bottom-6 -right-6 bg-white rounded-2xl shadow-md p-4 flex items-center gap-3 max-w-[260px] hidden md:flex">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-[#0A2463] to-[#172A45] grid place-items-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><rect width="5" height="5" x="3" y="3" rx="1"></rect><rect width="5" height="5" x="16" y="3" rx="1"></rect><rect width="5" height="5" x="3" y="16" rx="1"></rect><path d="M21 16h-3a2 2 0 0 0-2 2v3"></path><path d="M21 21v.01"></path><path d="M12 7v3a2 2 0 0 1-2 2H7"></path><path d="M3 12h.01"></path><path d="M12 3h.01"></path><path d="M12 16v.01"></path><path d="M16 12h1"></path><path d="M21 12v.01"></path><path d="M12 21v-1"></path></svg>
                </div>
                <div>
                    <p class="font-bold text-sm m-0">Lifetime QR profile</p>
                    <p class="text-xs text-[#86868B] m-0 mt-1">Update info anytime, free.</p>
                </div>
            </div>
        </div>
        <div>
            <p class="text-[11px] font-bold tracking-[0.2em] text-[#86868B] mb-3 uppercase">SMART TAGS</p>
            <h2 class="mb-4 font-display text-4xl m-0 text-[#0A192F]">India's most advanced QR tags</h2>
            <p class="text-[#86868B] max-w-md mb-6">
                Engraved aluminium tags with a unique QR code that links to a private profile.
                Anyone who finds your pet, luggage or vehicle can instantly contact you.
            </p>
            <ul class="space-y-3 mb-7 list-none p-0">
                <?php
                $features = [
                    "Lifetime profile &middot; update anytime, free",
                    "GPS-precise lost &amp; found alerts",
                    "Pet, travel, vehicle, kids safety, medical &amp; corporate",
                    "Made in India &middot; ships in 24 hours",
                ];
                foreach($features as $x): ?>
                <li class="flex items-start gap-3 text-sm text-[#1D1D1F]">
                    <div class="w-5 h-5 rounded-full bg-[#0A192F] text-white flex items-center justify-center text-[10px] font-bold mt-0.5 shrink-0">&check;</div>
                    <?php echo $x; ?>
                </li>
                <?php endforeach; ?>
            </ul>
            <a href="/smart-tags" class="inline-flex items-center gap-2 bg-[#0A192F] text-white font-semibold px-7 py-3.5 rounded-lg hover:bg-[#172A45] transition">
                Explore Smart Tags <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
            </a>
        </div>
    </div>
</section>
