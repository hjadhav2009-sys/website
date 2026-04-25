<?php
/**
 * Template Name: Custom Gifts Page
 * THEMENGIFT — Premium Radiant UI Design
 */
get_header();
?>

<!-- HERO -->
<section style="background:linear-gradient(135deg,#0A2463 0%,#172A45 100%); color:#fff;">
    <div class="tmg-container" style="padding-top:56px; padding-bottom:56px;">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:center;" class="tmg-hero-grid">

            <!-- Left copy -->
            <div>
                <div style="display:flex; align-items:center; gap:6px; font-size:13px; color:rgba(255,255,255,0.65); margin-bottom:16px;">
                    <a href="/" style="color:rgba(255,255,255,0.65); text-decoration:none;">Home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    <span style="color:#fff;">Custom Gifts</span>
                </div>
                <h1 style="font-family:'Playfair Display',serif; font-size:clamp(2.2rem,5vw,3.5rem); font-weight:700; color:#fff; margin:0 0 16px; line-height:1.1;">
                    Gifts that mean <em style="font-style:italic;">something</em>
                </h1>
                <p style="color:rgba(255,255,255,0.8); font-size:1.1rem; max-width:440px; margin:0 0 28px; line-height:1.7;">
                    Engrave a name. Print a memory. Build a hamper. Every gift made to order in 24–48 hours, delivered with love.
                </p>
                <div style="display:flex; flex-wrap:wrap; gap:12px;">
                    <a href="#categories" style="display:inline-flex; align-items:center; gap:8px; background:#fff; color:#0A2463; font-weight:700; padding:14px 28px; border-radius:12px; text-decoration:none; transition:all 0.2s; box-shadow:0 8px 24px rgba(0,0,0,0.15);"
                        onmouseover="this.style.background='#FBFBFD'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#fff'; this.style.transform=''">
                        Browse Categories
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                    <a href="/contact" style="display:inline-flex; align-items:center; gap:8px; border:2px solid rgba(255,255,255,0.6); color:#fff; font-weight:700; padding:14px 28px; border-radius:12px; text-decoration:none; transition:all 0.2s;"
                        onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='transparent'">
                        Bulk Enquiry
                    </a>
                </div>
                <!-- Trust badges -->
                <div style="display:flex; flex-wrap:wrap; gap:16px; margin-top:24px; font-size:13px; color:rgba(255,255,255,0.75);">
                    <span>✓ Ready in 24–48 hrs</span>
                    <span>✓ Free gift wrapping</span>
                    <span>✓ Personalised note</span>
                </div>
            </div>

            <!-- Right — staggered image grid -->
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px;">
                <?php
                $hero_imgs = [
                    get_stylesheet_directory_uri().'/assets/images/gift-box.jpg',
                    get_stylesheet_directory_uri().'/assets/images/mug.jpg',
                    get_stylesheet_directory_uri().'/assets/images/frame.jpg',
                    get_stylesheet_directory_uri().'/assets/images/phone-case.jpg',
                ];
                foreach($hero_imgs as $idx => $src):
                ?>
                <div style="border-radius:16px; overflow:hidden; aspect-ratio:1; <?php echo $idx%2===1?'margin-top:24px':''; ?>">
                    <img src="<?php echo esc_url($src); ?>" alt="Custom gift" loading="<?php echo $idx===0?'eager':'lazy'; ?>"
                        style="width:100%; height:100%; object-fit:cover; transition:transform 0.5s;"
                        onmouseover="this.style.transform='scale(1.06)'" onmouseout="this.style.transform=''">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section style="background:#FBFBFD; padding:64px 0; border-bottom:1px solid #E5E5EA;">
    <div class="tmg-container">
        <div style="text-align:center; margin-bottom:48px;">
            <p style="font-size:11px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#86868B; margin:0 0 10px;">HOW IT WORKS</p>
            <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.8rem,3vw,2.4rem); color:#0A192F; margin:0;">Three steps. Endless meaning.</h2>
        </div>
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px;" class="tmg-steps-grid">
            <?php
            $steps = [
                ['🛍️','1. Pick a product',  'Browse 200+ customisable items across jewellery, lifestyle and tech accessories.'],
                ['✍️','2. Personalise it',   'Add a name, date, message or upload your photo. See a live preview while you design.'],
                ['🎁','3. We craft & ship',  'Hand-finished in our Mumbai workshop. Delivered in 3–5 days, free above ₹499.'],
            ];
            foreach($steps as $i => $s):
            ?>
            <div style="background:#fff; border-radius:20px; padding:28px; border:1.5px solid #E5E5EA; text-align:center; position:relative; overflow:hidden;">
                <!-- Number accent -->
                <div style="position:absolute; top:-10px; right:-10px; font-size:72px; font-weight:900; color:#FBFBFD; line-height:1; pointer-events:none; user-select:none;">
                    <?php echo $i+1; ?>
                </div>
                <div style="width:56px; height:56px; border-radius:16px; background:linear-gradient(135deg,#0A2463,#172A45); display:flex; align-items:center; justify-content:center; margin:0 auto 16px; font-size:24px;">
                    <?php echo $s[0]; ?>
                </div>
                <h3 style="font-family:'Playfair Display',serif; font-size:18px; color:#0A192F; margin:0 0 8px;"><?php echo esc_html($s[1]); ?></h3>
                <p style="font-size:14px; color:#86868B; margin:0; line-height:1.6;"><?php echo esc_html($s[2]); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CATEGORIES -->
<section id="categories" style="background:#fff; padding:64px 0;">
    <div class="tmg-container">
        <div style="margin-bottom:32px;">
            <p style="font-size:11px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#86868B; margin:0 0 10px;">CATEGORIES</p>
            <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.8rem,3vw,2.4rem); color:#0A192F; margin:0;">What would you like to personalise?</h2>
        </div>
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px;" class="tmg-cat-grid">
            <?php
            $cats = [
                ['Name Jewellery', get_stylesheet_directory_uri().'/assets/images/name-jewel.jpg',  '42 products', '/jewellery'],
                ['Photo Mugs',     get_stylesheet_directory_uri().'/assets/images/mug.jpg',          '28 products', '/shop?cat=mugs'],
                ['Engraved Frames',get_stylesheet_directory_uri().'/assets/images/frame.jpg',        '35 products', '/shop?cat=frames'],
                ['Phone Cases',    get_stylesheet_directory_uri().'/assets/images/phone-case.jpg',   '60 products', '/shop?cat=phone-cases'],
                ['Stationery',     get_stylesheet_directory_uri().'/assets/images/stationery.jpg',   '18 products', '/shop?cat=stationery'],
                ['Gift Hampers',   get_stylesheet_directory_uri().'/assets/images/hamper.jpg',       '22 products', '/shop?cat=hampers'],
                ['Home Décor',     get_stylesheet_directory_uri().'/assets/images/home-decor.jpg',   '24 products', '/shop?cat=decor'],
                ['Build Your Own', get_stylesheet_directory_uri().'/assets/images/gift-box.jpg',     null,          '/contact'],
            ];
            foreach($cats as $c):
            ?>
            <a href="<?php echo esc_url($c[3]); ?>" style="text-decoration:none; display:block;" class="tmg-cat-link"
                onmouseover="this.querySelector('h3').style.color='#0A2463'" onmouseout="this.querySelector('h3').style.color='#1D1D1F'">
                <div style="border-radius:16px; overflow:hidden; aspect-ratio:1; background:#FBFBFD; margin-bottom:12px; position:relative;">
                    <img src="<?php echo esc_url($c[1]); ?>" alt="<?php echo esc_attr($c[0]); ?>" loading="lazy"
                        style="width:100%; height:100%; object-fit:cover; transition:transform 0.6s ease;"
                        onmouseover="this.style.transform='scale(1.09)'" onmouseout="this.style.transform=''">
                    <?php if($c[0]==='Build Your Own'): ?>
                    <div style="position:absolute; inset:0; background:rgba(10,36,99,0.5); display:flex; align-items:center; justify-content:center;">
                        <span style="color:#fff; font-weight:700; font-size:15px; text-align:center; padding:10px;">✨ Build Your Own</span>
                    </div>
                    <?php endif; ?>
                </div>
                <h3 style="font-size:14px; font-weight:600; color:#1D1D1F; margin:0 0 4px; transition:color 0.2s;"><?php echo esc_html($c[0]); ?></h3>
                <?php if($c[2]): ?>
                <p style="font-size:12px; color:#86868B; margin:0;"><?php echo esc_html($c[2]); ?></p>
                <?php endif; ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- BEST SELLERS -->
<section style="background:#FBFBFD; padding:64px 0; border-top:1px solid #E5E5EA;">
    <div class="tmg-container">
        <div style="display:flex; align-items:end; justify-content:space-between; flex-wrap:wrap; gap:16px; margin-bottom:32px;">
            <div>
                <p style="font-size:11px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#86868B; margin:0 0 8px;">MOST GIFTED</p>
                <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.8rem,3vw,2.4rem); color:#0A192F; margin:0;">Best-selling personalised gifts</h2>
            </div>
            <a href="/shop" style="font-size:14px; font-weight:600; color:#0A2463; text-decoration:none; display:inline-flex; align-items:center; gap:4px;"
                onmouseover="this.style.gap='8px'" onmouseout="this.style.gap='4px'">
                View all
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
        </div>

        <!-- WooCommerce products -->
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px;" class="tmg-bs-grid">
            <?php
            $args = ['post_type'=>'product','posts_per_page'=>4,'post_status'=>'publish','meta_key'=>'total_sales','orderby'=>'meta_value_num','order'=>'DESC'];
            $loop = new WP_Query($args);
            if($loop->have_posts()):
                while($loop->have_posts()): $loop->the_post();
                    global $product;
                    $img  = get_the_post_thumbnail_url(get_the_ID(),'woocommerce_single') ?: wc_placeholder_img_src();
                    $sale = $product->is_on_sale();
                    $reg  = $product->get_regular_price();
                    $sal  = $product->get_sale_price();
                    $off  = ($sale && $reg > 0) ? round((($reg-$sal)/$reg)*100) : 0;
            ?>
            <div style="background:#fff; border-radius:16px; overflow:hidden; border:1.5px solid #E5E5EA; transition:all 0.3s;"
                onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.08)'"
                onmouseout="this.style.transform=''; this.style.boxShadow=''">
                <a href="<?php the_permalink(); ?>" style="text-decoration:none;">
                    <div style="position:relative; aspect-ratio:1; overflow:hidden; background:#FBFBFD;">
                        <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy"
                            style="width:100%; height:100%; object-fit:cover; transition:transform 0.5s;"
                            onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform=''">
                        <?php if($off>0): ?>
                        <span style="position:absolute; top:10px; left:10px; background:#E53E3E; color:#fff; font-size:11px; font-weight:700; padding:3px 10px; border-radius:999px;"><?php echo $off; ?>% OFF</span>
                        <?php endif; ?>
                    </div>
                    <div style="padding:14px 16px 8px;">
                        <h3 style="font-size:14px; font-weight:600; color:#1D1D1F; margin:0 0 8px; line-height:1.4;"><?php the_title(); ?></h3>
                        <span style="font-size:15px; font-weight:700; color:#0A2463;"><?php echo $product->get_price_html(); ?></span>
                    </div>
                </a>
                <div style="padding:0 16px 16px;">
                    <button onclick="location.href='<?php the_permalink(); ?>'"
                        style="width:100%; padding:9px; border-radius:10px; background:#0A2463; color:#fff; border:none; font-size:13px; font-weight:600; cursor:pointer; transition:background 0.2s;"
                        onmouseover="this.style.background='#172A45'" onmouseout="this.style.background='#0A2463'">
                        Personalise →
                    </button>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata();
            else: ?>
            <div style="grid-column:1/-1; text-align:center; padding:40px; color:#86868B;">No products found yet. <a href="/shop" style="color:#0A2463;">Browse all →</a></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- GIFTING PROMISE -->
<section style="background:linear-gradient(135deg,#EEF2FF,#F6F8FA); padding:64px 0; border-top:1px solid #E5E5EA;">
    <div class="tmg-container" style="text-align:center; max-width:640px; margin:0 auto;">
        <div style="font-size:40px; margin-bottom:16px;">💛</div>
        <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.8rem,3vw,2.4rem); color:#0A192F; margin:0 0 12px;">Our gifting promise</h2>
        <p style="color:#86868B; font-size:16px; line-height:1.8; margin:0 0 28px;">
            Every order is hand-checked, gift-wrapped and includes a personalised note for free.
            Not happy? Return within 30 days. We'll re-make it or refund — no questions asked.
        </p>
        <div style="display:flex; flex-wrap:wrap; gap:12px; justify-content:center;">
            <?php
            $badges = ['🎀 Free Gift Wrap','📝 Personal Note','🔄 30-Day Returns','✅ Made in India'];
            foreach($badges as $b):
            ?>
            <span style="background:#fff; border:1.5px solid #E5E5EA; border-radius:999px; padding:8px 18px; font-size:13px; font-weight:600; color:#1D1D1F;">
                <?php echo esc_html($b); ?>
            </span>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
@media(max-width:1024px){
    .tmg-hero-grid{grid-template-columns:1fr !important;}
    .tmg-cat-grid{grid-template-columns:repeat(3,1fr) !important;}
    .tmg-bs-grid{grid-template-columns:repeat(2,1fr) !important;}
    .tmg-steps-grid{grid-template-columns:1fr !important;}
}
@media(max-width:640px){
    .tmg-cat-grid{grid-template-columns:repeat(2,1fr) !important;}
    .tmg-bs-grid{grid-template-columns:repeat(2,1fr) !important;}
}
</style>

<?php get_footer(); ?>
