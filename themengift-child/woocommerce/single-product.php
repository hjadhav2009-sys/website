<?php
/**
 * Custom Single Product Page — THEMENGIFT Radiant UI
 */
defined('ABSPATH') || exit;
get_header();
?>

<div style="background:#FBFBFD; min-height:100vh;">
<?php while(have_posts()): the_post(); global $product; ?>

<!-- BREADCRUMB -->
<div class="tmg-container" style="padding-top:24px; padding-bottom:8px;">
    <div style="display:flex; align-items:center; gap:6px; font-size:13px; color:#86868B;">
        <a href="/" style="color:#86868B; text-decoration:none; transition:color .2s;" onmouseover="this.style.color='#0A2463'" onmouseout="this.style.color='#86868B'">Home</a>
        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        <a href="/shop" style="color:#86868B; text-decoration:none;" onmouseover="this.style.color='#0A2463'" onmouseout="this.style.color='#86868B'">Shop</a>
        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        <span style="color:#1D1D1F; font-weight:500;"><?php the_title(); ?></span>
    </div>
</div>

<!-- PRODUCT SECTION -->
<section style="padding:32px 0 64px;">
    <div class="tmg-container">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:start;" class="tmg-product-layout">

            <!-- ===== LEFT: IMAGE GALLERY ===== -->
            <div style="position:sticky; top:110px;">
                <?php
                $attachment_ids = $product->get_gallery_image_ids();
                $main_img = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: wc_placeholder_img_src('full');
                $all_imgs = array_merge([$main_img], array_map(fn($id) => wp_get_attachment_url($id), $attachment_ids));
                ?>
                <!-- Main image -->
                <div style="border-radius:24px; overflow:hidden; aspect-ratio:1; background:#fff; border:1.5px solid #E5E5EA; margin-bottom:14px; position:relative;" id="tmg-main-img-wrap">
                    <img id="tmg-main-img" src="<?php echo esc_url($all_imgs[0]); ?>" alt="<?php the_title_attribute(); ?>"
                        style="width:100%; height:100%; object-fit:cover; transition:opacity 0.3s;">
                    <?php if($product->is_on_sale()): 
                        $reg = (float)$product->get_regular_price();
                        $sal = (float)$product->get_sale_price();
                        $off = $reg > 0 ? round((($reg-$sal)/$reg)*100) : 0;
                    ?>
                    <span style="position:absolute; top:14px; left:14px; background:#E53E3E; color:#fff; font-size:12px; font-weight:700; padding:4px 12px; border-radius:999px;">
                        <?php echo $off; ?>% OFF
                    </span>
                    <?php endif; ?>
                    <!-- Zoom hint -->
                    <div style="position:absolute; top:14px; right:14px; background:rgba(255,255,255,0.9); border-radius:8px; padding:6px 10px; font-size:11px; font-weight:600; color:#86868B;">
                        🔍 Click to zoom
                    </div>
                </div>
                <!-- Thumbnails -->
                <?php if(count($all_imgs) > 1): ?>
                <div style="display:flex; gap:10px; flex-wrap:wrap;">
                    <?php foreach($all_imgs as $i => $src): ?>
                    <button onclick="document.getElementById('tmg-main-img').style.opacity='0'; setTimeout(()=>{ document.getElementById('tmg-main-img').src='<?php echo esc_js($src); ?>'; document.getElementById('tmg-main-img').style.opacity='1'; },200);"
                        style="width:72px; height:72px; border-radius:12px; overflow:hidden; border:<?php echo $i===0?'2px solid #0A2463':'1.5px solid #E5E5EA'; ?>; cursor:pointer; padding:0; background:none; transition:border-color 0.2s;"
                        onmouseover="this.style.borderColor='#0A2463'" onmouseout="">
                        <img src="<?php echo esc_url($src); ?>" alt="Thumbnail <?php echo $i+1; ?>" style="width:100%; height:100%; object-fit:cover;">
                    </button>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- ===== RIGHT: PRODUCT INFO ===== -->
            <div>
                <!-- Category + badge -->
                <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap; margin-bottom:12px;">
                    <?php foreach(wc_get_product_cat_ids(get_the_ID()) as $cat_id):
                        $cat = get_term($cat_id, 'product_cat');
                        if(!is_wp_error($cat)):
                    ?>
                    <a href="<?php echo esc_url(get_term_link($cat)); ?>"
                        style="font-size:11px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#0A2463; background:#EEF2FF; padding:4px 12px; border-radius:999px; text-decoration:none;">
                        <?php echo esc_html($cat->name); ?>
                    </a>
                    <?php endif; endforeach; ?>
                    <?php if($product->is_featured()): ?>
                    <span style="font-size:11px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#D4AF37; background:#FFF8E1; padding:4px 12px; border-radius:999px;">⭐ Bestseller</span>
                    <?php endif; ?>
                </div>

                <!-- Title -->
                <h1 style="font-family:'Playfair Display',serif; font-size:clamp(1.8rem,3vw,2.4rem); font-weight:700; color:#0A192F; margin:0 0 12px; line-height:1.2;">
                    <?php the_title(); ?>
                </h1>

                <!-- Rating -->
                <?php if($product->get_review_count() > 0): ?>
                <div style="display:flex; align-items:center; gap:8px; margin-bottom:14px;">
                    <div style="display:flex; gap:2px;">
                        <?php for($s=0;$s<5;$s++): ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="<?php echo $s < round($product->get_average_rating()) ? '#D4AF37' : '#E5E5EA'; ?>" stroke="<?php echo $s < round($product->get_average_rating()) ? '#D4AF37' : '#E5E5EA'; ?>" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        <?php endfor; ?>
                    </div>
                    <span style="font-size:13px; font-weight:600; color:#1D1D1F;"><?php echo number_format($product->get_average_rating(),1); ?></span>
                    <a href="#reviews" style="font-size:13px; color:#86868B; text-decoration:none;">(<?php echo $product->get_review_count(); ?> reviews)</a>
                </div>
                <?php endif; ?>

                <!-- Price -->
                <div style="margin-bottom:20px;">
                    <span style="font-family:'Playfair Display',serif; font-size:2rem; font-weight:800; color:#0A2463;">
                        <?php echo $product->get_price_html(); ?>
                    </span>
                    <?php if($product->is_on_sale() && !empty($reg)): ?>
                    <span style="font-size:15px; color:#86868B; text-decoration:line-through; margin-left:10px;">₹<?php echo number_format($reg); ?></span>
                    <span style="font-size:13px; font-weight:700; color:#E53E3E; margin-left:6px;">Save <?php echo $off; ?>%</span>
                    <?php endif; ?>
                </div>

                <!-- Short description -->
                <?php if($product->get_short_description()): ?>
                <div style="color:#86868B; font-size:15px; line-height:1.8; margin-bottom:24px; padding-bottom:24px; border-bottom:1px solid #E5E5EA;">
                    <?php echo wp_kses_post($product->get_short_description()); ?>
                </div>
                <?php endif; ?>

                <!-- ADD TO CART FORM -->
                <div style="background:#fff; border:1.5px solid #E5E5EA; border-radius:20px; padding:24px; margin-bottom:20px;">
                    <?php
                    // Remove default title/price from summary to avoid duplicates
                    remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
                    remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
                    remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20);
                    remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
                    do_action('woocommerce_single_product_summary');
                    ?>
                </div>

                <!-- PERSONALISATION NOTE BOX -->
                <div style="background:#EEF2FF; border-radius:16px; padding:18px; margin-bottom:20px; display:flex; gap:12px; align-items:flex-start;">
                    <div style="font-size:22px; flex-shrink:0; margin-top:2px;">✍️</div>
                    <div>
                        <p style="font-weight:700; font-size:14px; color:#0A192F; margin:0 0 4px;">Personalisation included</p>
                        <p style="font-size:13px; color:#86868B; margin:0; line-height:1.5;">Add a name, date or message at checkout — engraved at no extra charge. Preview before you order.</p>
                    </div>
                </div>

                <!-- USPs -->
                <ul style="list-style:none; padding:0; margin:0 0 24px; display:grid; grid-template-columns:1fr 1fr; gap:10px;">
                    <?php
                    $usps = [
                        ['🚚','Ships in 24 hrs'],
                        ['📦','Free gift box'],
                        ['🔒','Secure checkout'],
                        ['🔄','30-day returns'],
                        ['🏅','BIS hallmarked'],
                        ['🇮🇳','Made in India'],
                    ];
                    foreach($usps as $u):
                    ?>
                    <li style="display:flex; align-items:center; gap:8px; font-size:13px; color:#1D1D1F;">
                        <span><?php echo $u[0]; ?></span>
                        <?php echo esc_html($u[1]); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Share / Wishlist -->
                <div style="display:flex; gap:10px; flex-wrap:wrap;">
                    <?php if(function_exists('YITH_WCWL')): ?>
                    <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                    <?php else: ?>
                    <button style="display:inline-flex; align-items:center; gap:6px; padding:10px 18px; border:1.5px solid #E5E5EA; border-radius:10px; background:#fff; font-size:13px; font-weight:600; color:#1D1D1F; cursor:pointer; transition:all 0.2s;"
                        onmouseover="this.style.borderColor='#0A2463'; this.style.color='#0A2463'" onmouseout="this.style.borderColor='#E5E5EA'; this.style.color='#1D1D1F'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                        Save to Wishlist
                    </button>
                    <?php endif; ?>
                    <a href="https://wa.me/?text=Check+this+out:+<?php echo urlencode(get_permalink()); ?>"
                        style="display:inline-flex; align-items:center; gap:6px; padding:10px 18px; border:1.5px solid #E5E5EA; border-radius:10px; background:#fff; font-size:13px; font-weight:600; color:#1D1D1F; cursor:pointer; text-decoration:none; transition:all 0.2s;"
                        onmouseover="this.style.borderColor='#25D366'; this.style.color='#25D366'" onmouseout="this.style.borderColor='#E5E5EA'; this.style.color='#1D1D1F'" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        Share on WhatsApp
                    </a>
                </div>
            </div>
        </div><!-- end product grid -->

        <!-- ===== TABS: DESCRIPTION / REVIEWS ===== -->
        <div style="margin-top:64px;" id="reviews">
            <?php do_action('woocommerce_after_single_product_summary'); ?>
        </div>

        <!-- ===== RELATED PRODUCTS ===== -->
        <div style="margin-top:64px; padding-top:48px; border-top:1px solid #E5E5EA;">
            <div style="display:flex; align-items:end; justify-content:space-between; flex-wrap:wrap; gap:16px; margin-bottom:28px;">
                <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.6rem,3vw,2rem); color:#0A192F; margin:0;">You may also like</h2>
                <a href="/shop" style="font-size:14px; font-weight:600; color:#0A2463; text-decoration:none;">Browse all →</a>
            </div>
            <?php
            $related_ids = wc_get_related_products(get_the_ID(), 4);
            if(!empty($related_ids)):
                $related = wc_get_products(['include'=>$related_ids,'limit'=>4]);
            ?>
            <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px;" class="tmg-related-grid">
                <?php foreach($related as $rp): ?>
                <a href="<?php echo esc_url($rp->get_permalink()); ?>" style="text-decoration:none; display:block; background:#fff; border-radius:16px; overflow:hidden; border:1.5px solid #E5E5EA; transition:all 0.3s;"
                    onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 16px 32px rgba(0,0,0,0.08)'"
                    onmouseout="this.style.transform=''; this.style.boxShadow=''">
                    <div style="aspect-ratio:1; overflow:hidden; background:#FBFBFD;">
                        <img src="<?php echo esc_url(wp_get_attachment_url($rp->get_image_id()) ?: wc_placeholder_img_src()); ?>" alt="<?php echo esc_attr($rp->get_name()); ?>"
                            loading="lazy" style="width:100%; height:100%; object-fit:cover; transition:transform 0.5s;"
                            onmouseover="this.style.transform='scale(1.07)'" onmouseout="this.style.transform=''">
                    </div>
                    <div style="padding:14px;">
                        <h3 style="font-size:13px; font-weight:600; color:#1D1D1F; margin:0 0 6px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?php echo esc_html($rp->get_name()); ?></h3>
                        <span style="font-size:15px; font-weight:700; color:#0A2463;"><?php echo $rp->get_price_html(); ?></span>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>

    </div>
</section>

<?php endwhile; ?>
</div><!-- end bg wrapper -->

<style>
.tmg-product-layout .woocommerce-variation-add-to-cart,
.tmg-product-layout .cart { display:flex; flex-direction:column; gap:12px; }
.tmg-product-layout .quantity input { width:80px; padding:10px; border:1.5px solid #E5E5EA; border-radius:10px; font-size:15px; font-weight:600; text-align:center; outline:none; }
.tmg-product-layout .quantity input:focus { border-color:#0A2463; }
.tmg-product-layout .single_add_to_cart_button {
    width:100%; padding:15px; background:#0A2463; color:#fff; border:none;
    border-radius:12px; font-size:16px; font-weight:700; cursor:pointer;
    letter-spacing:0.03em; transition:all 0.25s;
}
.tmg-product-layout .single_add_to_cart_button:hover { background:#172A45; transform:translateY(-2px); box-shadow:0 8px 20px rgba(10,36,99,0.25); }
.tmg-product-layout .variations select { width:100%; padding:12px 14px; border:1.5px solid #E5E5EA; border-radius:12px; font-size:14px; color:#1D1D1F; background:#fff; outline:none; cursor:pointer; margin-top:6px; }
.tmg-product-layout .variations select:focus { border-color:#0A2463; }
.tmg-product-layout .variations label { font-size:12px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#86868B; }
.woocommerce-tabs ul.tabs { display:flex; gap:0; border-bottom:2px solid #E5E5EA; margin-bottom:24px; padding:0; list-style:none; }
.woocommerce-tabs ul.tabs li { margin:0; }
.woocommerce-tabs ul.tabs li a { display:block; padding:12px 20px; font-size:14px; font-weight:600; color:#86868B; text-decoration:none; border-bottom:2px solid transparent; margin-bottom:-2px; transition:all 0.2s; }
.woocommerce-tabs ul.tabs li.active a { color:#0A2463; border-bottom-color:#0A2463; }
@media(max-width:1024px){
    .tmg-product-layout{grid-template-columns:1fr!important;}
    .tmg-related-grid{grid-template-columns:repeat(2,1fr)!important;}
}
</style>

<?php get_footer(); ?>
