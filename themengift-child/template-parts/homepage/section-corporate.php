<?php
$bg_img = get_theme_mod('tmg_corporate_bg_img', get_stylesheet_directory_uri() . '/assets/images/corp-hero.jpg');
$grid_images = [
    get_stylesheet_directory_uri() . '/assets/images/corp-1.jpg',
    get_stylesheet_directory_uri() . '/assets/images/corp-2.jpg',
    get_stylesheet_directory_uri() . '/assets/images/corp-3.jpg',
    get_stylesheet_directory_uri() . '/assets/images/corp-4.jpg',
    get_stylesheet_directory_uri() . '/assets/images/corp-5.jpg',
    get_stylesheet_directory_uri() . '/assets/images/corp-6.jpg',
];
?>
<section class="py-16 bg-[#F6F8FA]">
    <div class="tmg-container">
        <div class="relative rounded-3xl overflow-hidden bg-[#0A2463] text-white p-8 md:p-12 grid lg:grid-cols-2 gap-8 items-center">
            <div class="absolute inset-0 opacity-30">
                <img src="<?php echo esc_url($bg_img); ?>" alt="Corporate Background" class="w-full h-full object-cover" />
            </div>
            <div class="relative">
                <span class="inline-flex items-center gap-2 bg-white/15 text-white text-[11px] font-bold tracking-[0.2em] uppercase px-3 py-1.5 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg> Corporate Gifting
                </span>
                <h2 class="text-white mb-3 text-4xl m-0 font-display">Bulk gifting, beautifully done</h2>
                <p class="text-white/80 max-w-md mb-6">
                    Curated hampers, branded jewellery, custom phone cases & smart corporate
                    tags &mdash; for 50 to 50,000 employees, with logo branding and pan-India delivery.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="/corporate" class="inline-flex items-center gap-2 bg-white text-[#0A2463] font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition shadow-md">
                        Get a quote <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </a>
                    <a href="/corporate" class="inline-flex items-center gap-2 border-2 border-white/80 text-white font-semibold px-6 py-3 rounded-lg hover:bg-white hover:text-[#0A2463] transition">
                        Download Catalogue
                    </a>
                </div>
            </div>
            <div class="relative grid grid-cols-3 gap-3">
                <?php foreach($grid_images as $idx => $src): ?>
                <img src="<?php echo esc_url($src); ?>" alt="Corporate Product" loading="lazy" class="aspect-square object-cover rounded-xl w-full h-full" />
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
