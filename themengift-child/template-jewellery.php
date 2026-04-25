<?php
/**
 * Template Name: Jewellery Shop Page
 * THEMENGIFT — Premium Radiant UI Design
 */
get_header();
?>

<!-- PAGE HERO -->
<section style="background: linear-gradient(135deg, #0A2463 0%, #172A45 100%); color: #fff;">
    <div class="tmg-container" style="padding-top: 56px; padding-bottom: 56px;">
        <!-- Breadcrumb -->
        <div style="display:flex; align-items:center; gap:6px; font-size:13px; color:rgba(255,255,255,0.65); margin-bottom:16px;">
            <a href="/" style="color:rgba(255,255,255,0.65); text-decoration:none; transition:color 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.65)'">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            <span style="color:#fff;">Jewellery</span>
        </div>
        <h1 style="font-family:'Playfair Display',serif; font-size:clamp(2.2rem,5vw,3.5rem); font-weight:700; color:#fff; margin:0 0 16px; line-height:1.1; max-width:600px;">
            Jewellery, <em style="font-style:italic;">made just for you</em>
        </h1>
        <p style="color:rgba(255,255,255,0.8); font-size:1.1rem; max-width:520px; margin:0 0 28px; line-height:1.7;">
            Engraved necklaces, custom rings, bracelets and more — crafted in India with premium-grade materials. Built to last, made to be remembered.
        </p>
        <!-- Quick filter chips -->
        <div style="display:flex; flex-wrap:wrap; gap:10px;">
            <?php
            $chips = ['All','Necklaces','Rings','Bracelets','Earrings','For Her','For Him','Couple'];
            foreach($chips as $i => $chip):
            ?>
            <a href="<?php echo esc_url(wc_get_page_permalink('shop') . ($chip==='All' ? '' : '?filter_cat='.sanitize_title($chip))); ?>"
               class="tmg-chip-<?php echo $i; ?>"
               style="padding:8px 18px; border-radius:999px; font-size:13px; font-weight:600; text-decoration:none; transition:all 0.2s;
                      <?php echo $i===0 ? 'background:#fff; color:#0A2463;' : 'background:rgba(255,255,255,0.12); color:#fff; border:1px solid rgba(255,255,255,0.25);' ?>">
                <?php echo esc_html($chip); ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- FILTER BAR + PRODUCTS -->
<section style="background:#fff; padding:48px 0 64px;">
    <div class="tmg-container">
        <div style="display:grid; grid-template-columns:260px 1fr; gap:40px; align-items:start;" class="tmg-shop-grid">

            <!-- ===== SIDEBAR FILTERS ===== -->
            <aside class="tmg-sidebar" style="position:sticky; top:120px;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:20px;">
                    <h3 style="font-family:'Playfair Display',serif; font-size:18px; color:#0A192F; margin:0;">Filters</h3>
                    <a href="?" style="font-size:12px; color:#86868B; text-decoration:underline;">Clear all</a>
                </div>

                <?php
                $filter_groups = [
                    'Material' => ['Gold Plated','925 Silver','Stainless Steel','Rose Gold','Oxidised'],
                    'Category' => ['Necklaces','Rings','Bracelets','Earrings','Pendants','Chains'],
                    'For'      => ['Women','Men','Couples','Kids'],
                    'Price'    => ['Under ₹500','₹500 – ₹1,500','₹1,500 – ₹3,000','₹3,000+'],
                ];
                foreach($filter_groups as $group => $opts):
                ?>
                <div style="margin-bottom:24px; padding-bottom:24px; border-bottom:1px solid #E5E5EA;">
                    <p style="font-size:12px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#86868B; margin:0 0 12px;"><?php echo esc_html($group); ?></p>
                    <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:8px;">
                        <?php foreach($opts as $opt): ?>
                        <li>
                            <label style="display:flex; align-items:center; gap:8px; font-size:14px; color:#1D1D1F; cursor:pointer;">
                                <input type="checkbox" name="filter_<?php echo sanitize_title($group); ?>[]" value="<?php echo esc_attr($opt); ?>"
                                    style="width:16px; height:16px; accent-color:#0A2463; cursor:pointer;">
                                <?php echo esc_html($opt); ?>
                            </label>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endforeach; ?>
            </aside>

            <!-- ===== PRODUCT GRID ===== -->
            <div>
                <!-- Toolbar -->
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; flex-wrap:wrap; gap:12px;">
                    <p style="font-size:14px; color:#86868B; margin:0;">
                        <?php
                        $total = wc_get_loop_prop('total');
                        echo ($total ? $total : '0') . ' products';
                        ?>
                    </p>
                    <div style="display:flex; align-items:center; gap:10px;">
                        <!-- Mobile filter toggle -->
                        <button id="tmg-filter-toggle" style="display:none; align-items:center; gap:6px; padding:8px 14px; border:1.5px solid #E5E5EA; border-radius:10px; background:#fff; font-size:13px; font-weight:600; cursor:pointer; color:#1D1D1F;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="4" y1="21" y2="14"/><line x1="4" x2="4" y1="10" y2="3"/><line x1="12" x2="12" y1="21" y2="16"/><line x1="12" x2="12" y1="12" y2="3"/><line x1="20" x2="20" y1="21" y2="18"/><line x1="20" x2="20" y1="14" y2="3"/><line x1="1" x2="7" y1="14" y2="14"/><line x1="9" x2="15" y1="16" y2="16"/><line x1="17" x2="23" y1="18" y2="18"/></svg>
                            Filter
                        </button>
                        <select style="padding:8px 14px; border:1.5px solid #E5E5EA; border-radius:10px; font-size:13px; font-weight:500; background:#fff; color:#1D1D1F; cursor:pointer; outline:none;">
                            <option>Sort: Featured</option>
                            <option>Newest</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Best Selling</option>
                        </select>
                    </div>
                </div>

                <!-- Mobile Filter Drawer (hidden by default) -->
                <div id="tmg-mobile-filters" style="display:none; background:#FBFBFD; border:1.5px solid #E5E5EA; border-radius:16px; padding:20px; margin-bottom:24px;">
                    <div style="display:flex; flex-wrap:wrap; gap:16px;">
                        <?php foreach($filter_groups as $group => $opts): ?>
                        <div style="flex:1; min-width:140px;">
                            <p style="font-size:11px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#86868B; margin:0 0 8px;"><?php echo esc_html($group); ?></p>
                            <div style="display:flex; flex-wrap:wrap; gap:6px;">
                                <?php foreach($opts as $opt): ?>
                                <span style="font-size:12px; padding:5px 12px; border-radius:999px; background:#fff; border:1.5px solid #E5E5EA; cursor:pointer; transition:all 0.2s;"
                                    onmouseover="this.style.borderColor='#0A2463'" onmouseout="this.style.borderColor='#E5E5EA'">
                                    <?php echo esc_html($opt); ?>
                                </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- WooCommerce Products -->
                <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:20px;" class="tmg-product-grid">
                    <?php
                    $args = [
                        'post_type'      => 'product',
                        'posts_per_page' => 12,
                        'post_status'    => 'publish',
                        'tax_query'      => [['taxonomy'=>'product_cat','field'=>'slug','terms'=>['jewellery','necklaces','rings','bracelets','earrings'],'operator'=>'IN']],
                    ];
                    $loop = new WP_Query($args);
                    if($loop->have_posts()):
                        while($loop->have_posts()): $loop->the_post();
                            global $product;
                            $img   = get_the_post_thumbnail_url(get_the_ID(),'woocommerce_single') ?: wc_placeholder_img_src();
                            $price = $product->get_price_html();
                            $rating = $product->get_average_rating();
                            $rcount = $product->get_review_count();
                            $sale   = $product->is_on_sale();
                            $reg    = $product->get_regular_price();
                            $sal    = $product->get_sale_price();
                            $off    = ($sale && $reg > 0) ? round((($reg-$sal)/$reg)*100) : 0;
                    ?>
                    <div class="tmg-product-card" style="background:#fff; border-radius:16px; overflow:hidden; border:1.5px solid #E5E5EA; transition:all 0.3s; cursor:pointer;"
                        onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.08)'; this.style.borderColor='#0A2463';"
                        onmouseout="this.style.transform=''; this.style.boxShadow=''; this.style.borderColor='#E5E5EA';">
                        <a href="<?php the_permalink(); ?>" style="text-decoration:none;">
                            <div style="position:relative; aspect-ratio:1; overflow:hidden; background:#FBFBFD;">
                                <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute(); ?>"
                                    loading="lazy"
                                    style="width:100%; height:100%; object-fit:cover; transition:transform 0.5s ease;"
                                    onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform=''">
                                <?php if($sale && $off > 0): ?>
                                <span style="position:absolute; top:10px; left:10px; background:#E53E3E; color:#fff; font-size:11px; font-weight:700; padding:3px 10px; border-radius:999px;">
                                    <?php echo $off; ?>% OFF
                                </span>
                                <?php endif; ?>
                                <!-- Wishlist -->
                                <button style="position:absolute; top:10px; right:10px; width:32px; height:32px; border-radius:50%; background:rgba(255,255,255,0.9); border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all 0.2s;"
                                    onmouseover="this.style.background='#fff'; this.style.transform='scale(1.1)'" onmouseout="this.style.background='rgba(255,255,255,0.9)'; this.style.transform=''">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#0A2463" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                                </button>
                            </div>
                            <div style="padding:14px 16px 16px;">
                                <p style="font-size:11px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#86868B; margin:0 0 4px;">
                                    <?php echo esc_html(wp_strip_all_tags(wc_get_product_category_list(get_the_ID(), ', '))); ?>
                                </p>
                                <h3 style="font-size:14px; font-weight:600; color:#1D1D1F; margin:0 0 8px; line-height:1.4; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                    <?php the_title(); ?>
                                </h3>
                                <?php if($rating > 0): ?>
                                <div style="display:flex; align-items:center; gap:4px; margin-bottom:8px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="#D4AF37" stroke="#D4AF37" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                    <span style="font-size:12px; font-weight:600; color:#1D1D1F;"><?php echo number_format($rating,1); ?></span>
                                    <span style="font-size:12px; color:#86868B;">(<?php echo $rcount; ?>)</span>
                                </div>
                                <?php endif; ?>
                                <div style="display:flex; align-items:baseline; gap:8px; flex-wrap:wrap;">
                                    <span style="font-size:16px; font-weight:700; color:#0A2463;"><?php echo $product->get_price_html(); ?></span>
                                    <?php if($sale): ?>
                                    <span style="font-size:13px; color:#86868B; text-decoration:line-through;">₹<?php echo number_format($reg); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                        <div style="padding:0 16px 16px;">
                            <button onclick="location.href='<?php the_permalink(); ?>'"
                                style="width:100%; padding:10px; border-radius:10px; background:#0A2463; color:#fff; border:none; font-size:13px; font-weight:600; cursor:pointer; transition:all 0.2s; letter-spacing:0.03em;"
                                onmouseover="this.style.background='#172A45'; this.style.transform='translateY(-1px)'"
                                onmouseout="this.style.background='#0A2463'; this.style.transform=''">
                                View & Personalise
                            </button>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else:
                    ?>
                    <!-- Fallback: show WooCommerce shortcode -->
                    <div style="grid-column:1/-1; padding:60px 0; text-align:center; color:#86868B;">
                        <p style="font-size:1.1rem; margin-bottom:16px;">No products found in this category yet.</p>
                        <a href="/shop" style="color:#0A2463; font-weight:600; text-decoration:underline;">Browse all products →</a>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Load More -->
                <div style="margin-top:48px; text-align:center;">
                    <button style="background:#0A2463; color:#fff; font-weight:700; padding:14px 40px; border-radius:12px; border:none; font-size:15px; cursor:pointer; transition:all 0.25s; letter-spacing:0.03em;"
                        onmouseover="this.style.background='#172A45'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 24px rgba(10,36,99,0.25)'"
                        onmouseout="this.style.background='#0A2463'; this.style.transform=''; this.style.boxShadow=''">
                        Load more products
                    </button>
                    <p style="font-size:13px; color:#86868B; margin-top:12px;">Showing 12 of <?php echo wp_count_posts('product')->publish; ?>+ products</p>
                </div>
            </div>

        </div><!-- end grid -->
    </div>
</section>

<!-- MATERIAL SHOWCASE STRIP -->
<section style="background:#FBFBFD; padding:64px 0; border-top:1px solid #E5E5EA;">
    <div class="tmg-container">
        <div style="display:flex; align-items:end; justify-content:space-between; flex-wrap:wrap; gap:16px; margin-bottom:32px;">
            <div>
                <p style="font-size:11px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#86868B; margin:0 0 8px;">By Material</p>
                <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.8rem,3vw,2.4rem); color:#0A192F; margin:0;">Choose your finish</h2>
            </div>
        </div>
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px;" class="tmg-material-grid">
            <?php
            $materials = [
                ['Gold Plated',    '#0A2463', get_stylesheet_directory_uri().'/assets/images/mat-gold.jpg'],
                ['925 Silver',     '#1D1D1F', get_stylesheet_directory_uri().'/assets/images/mat-silver.jpg'],
                ['Stainless Steel','#2a6344', get_stylesheet_directory_uri().'/assets/images/mat-steel.jpg'],
                ['Rose Gold',      '#7B2D8B', get_stylesheet_directory_uri().'/assets/images/mat-rose.jpg'],
            ];
            foreach($materials as $m):
            ?>
            <a href="<?php echo esc_url(wc_get_page_permalink('shop').'?filter_material='.sanitize_title($m[0])); ?>"
                style="position:relative; border-radius:16px; overflow:hidden; aspect-ratio:1; display:block; background:<?php echo $m[1]; ?>; text-decoration:none;"
                class="tmg-mat-card">
                <img src="<?php echo esc_url($m[2]); ?>" alt="<?php echo esc_attr($m[0]); ?>" loading="lazy"
                    style="width:100%; height:100%; object-fit:cover; transition:transform 0.6s ease; display:block;"
                    onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform=''">
                <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.65) 0%, transparent 60%);"></div>
                <h3 style="position:absolute; bottom:14px; left:16px; color:#fff; font-family:'Playfair Display',serif; font-size:16px; margin:0;"><?php echo esc_html($m[0]); ?></h3>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- USP STRIP -->
<section style="background:#fff; padding:40px 0; border-top:1px solid #E5E5EA;">
    <div class="tmg-container">
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:24px; text-align:center;" class="tmg-usp-strip">
            <?php
            $usps = [
                ['🏅','Hallmark Certified','All metals tested & certified'],
                ['✍️','Free Engraving','Name, date or message'],
                ['📦','Gift-Wrapped','Premium box on every order'],
                ['🔄','30-Day Returns','No questions asked'],
            ];
            foreach($usps as $u):
            ?>
            <div style="display:flex; flex-direction:column; align-items:center; gap:10px;">
                <div style="font-size:26px;"><?php echo $u[0]; ?></div>
                <div>
                    <p style="font-weight:700; font-size:14px; color:#1D1D1F; margin:0;"><?php echo esc_html($u[1]); ?></p>
                    <p style="font-size:12px; color:#86868B; margin:4px 0 0;"><?php echo esc_html($u[2]); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- RESPONSIVE + MOBILE FILTER JS -->
<style>
@media (max-width: 1024px) {
    .tmg-shop-grid { grid-template-columns: 1fr !important; }
    .tmg-sidebar { display: none !important; }
    #tmg-filter-toggle { display: inline-flex !important; }
    .tmg-product-grid { grid-template-columns: repeat(2, 1fr) !important; }
}
@media (max-width: 640px) {
    .tmg-product-grid { grid-template-columns: repeat(2, 1fr) !important; gap:12px !important; }
    .tmg-material-grid { grid-template-columns: repeat(2, 1fr) !important; }
    .tmg-usp-strip { grid-template-columns: repeat(2, 1fr) !important; }
}
</style>
<script>
document.getElementById('tmg-filter-toggle').addEventListener('click', function(){
    var f = document.getElementById('tmg-mobile-filters');
    f.style.display = f.style.display === 'none' ? 'block' : 'none';
});
</script>

<?php get_footer(); ?>
