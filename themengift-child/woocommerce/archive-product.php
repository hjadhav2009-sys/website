<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 * Overriding WooCommerce default to match THEMENGIFT premium branding.
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
?>

<div class="tmg-shop-container" style="background-color: var(--color-surface); padding-top: var(--spacing-xl);">
    <div class="tmg-container">
        
        <header class="woocommerce-products-header" style="background:#0A2463; color:#fff; border-radius:24px; padding:60px 40px; margin-bottom:40px; text-align:center; position:relative; overflow:hidden;">
            <?php
            $term = get_queried_object();
            $count = isset($term->count) ? $term->count : 0;
            ?>
            <h1 class="woocommerce-products-header__title page-title" style="font-family:'Playfair Display',serif; font-size:3rem; color:#fff; margin:0 0 10px; position:relative; z-index:2;"><?php woocommerce_page_title(); ?></h1>
            <p style="font-size:16px; color:rgba(255,255,255,0.8); margin:0; position:relative; z-index:2;"><?php echo $count; ?> Products</p>
        </header>

        <!-- HORIZONTAL FILTER BAR -->
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px; background:#fff; padding:16px 24px; border-radius:16px; border:1px solid #E5E5EA; margin-bottom:40px;">
            <div style="display:flex; gap:16px; flex-wrap:wrap; align-items:center;">
                <span style="font-size:13px; font-weight:700; color:#86868B; text-transform:uppercase; letter-spacing:0.1em;">Filter:</span>
                
                <select style="padding:10px 16px; border-radius:8px; border:1px solid #E5E5EA; outline:none; font-size:14px; color:#1D1D1F; background:#FBFBFD;">
                    <option value="">Material</option>
                    <option value="gold">Gold Plated</option>
                    <option value="silver">925 Silver</option>
                    <option value="steel">Stainless Steel</option>
                </select>
                
                <select style="padding:10px 16px; border-radius:8px; border:1px solid #E5E5EA; outline:none; font-size:14px; color:#1D1D1F; background:#FBFBFD;">
                    <option value="">Occasion</option>
                    <option value="wedding">Wedding</option>
                    <option value="festival">Festival</option>
                    <option value="daily">Daily Wear</option>
                </select>
                
                <select style="padding:10px 16px; border-radius:8px; border:1px solid #E5E5EA; outline:none; font-size:14px; color:#1D1D1F; background:#FBFBFD;">
                    <option value="">Price Range</option>
                    <option value="under500">Under ₹500</option>
                    <option value="500-1000">₹500 - ₹1000</option>
                    <option value="over1000">Over ₹1000</option>
                </select>
            </div>
            
            <div style="display:flex; align-items:center; gap:12px;">
                <span style="font-size:13px; font-weight:700; color:#86868B; text-transform:uppercase; letter-spacing:0.1em;">Sort:</span>
                <?php woocommerce_catalog_ordering(); ?>
            </div>
        </div>

        <div style="display: block;">
            
            <!-- Main Product Grid -->
            <main class="tmg-shop-main" style="width: 100%;">

                <?php
                if ( woocommerce_product_loop() ) {

                    woocommerce_product_loop_start();

                    if ( wc_get_loop_prop( 'total' ) ) {
                        while ( have_posts() ) {
                            the_post();
                            
                            // Custom Wrapper for Product Card
                            echo '<div class="tmg-product-card" style="border: 1px solid var(--color-border); border-radius: var(--radius-md); background: var(--color-background); overflow: hidden; transition: box-shadow 0.3s;">';
                            
                            do_action( 'woocommerce_shop_loop' );
                            wc_get_template_part( 'content', 'product' );
                            
                            echo '</div>';
                        }
                    }

                    woocommerce_product_loop_end();

                    // Pagination
                    echo '<div style="margin-top: var(--spacing-2xl); display: flex; justify-content: center;">';
                    do_action( 'woocommerce_after_shop_loop' );
                    echo '</div>';
                } else {
                    do_action( 'woocommerce_no_products_found' );
                }
                ?>
            </main>
            
        </div>
    </div>
</div>

<style>
    /* Styling WooCommerce default elements to match brand */
    .woocommerce ul.products { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; padding: 0; margin: 0; list-style: none; }
    @media (max-width: 1024px) { .woocommerce ul.products { grid-template-columns: repeat(3, 1fr); gap: 20px; } }
    @media (max-width: 768px) { .woocommerce ul.products { grid-template-columns: repeat(2, 1fr); gap: 16px; } }
    
    .woocommerce ul.products li.product { width: 100% !important; margin: 0 !important; }
    .tmg-product-card:hover { box-shadow: 0 12px 24px rgba(0,0,0,0.06); border-color: #0A2463; transform: translateY(-4px); }
    .woocommerce ul.products li.product .price { color: #0A2463; font-weight: bold; font-size: 16px; }
    .woocommerce ul.products li.product .button { background: #0A2463; color: white; border-radius: 8px; width: 100%; text-align: center; display: block; margin-top: 16px; padding: 12px; font-weight: 600; }
    .woocommerce ul.products li.product .button:hover { background: #1B4F9E; }
    .woocommerce-ordering select { padding: 10px 16px; border-radius: 8px; border: 1px solid #E5E5EA; outline: none; font-size: 14px; color: #1D1D1F; background: #FBFBFD; }
</style>

<?php get_footer( 'shop' ); ?>
