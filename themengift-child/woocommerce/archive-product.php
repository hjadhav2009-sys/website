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
        
        <header class="woocommerce-products-header text-center" style="margin-bottom: var(--spacing-2xl);">
            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                <h1 class="woocommerce-products-header__title page-title" style="font-size: 2.5rem; color: var(--color-primary);"><?php woocommerce_page_title(); ?></h1>
            <?php endif; ?>
            
            <?php do_action( 'woocommerce_archive_description' ); ?>
        </header>

        <div style="display: flex; gap: var(--spacing-2xl); flex-wrap: wrap;">
            
            <!-- Sidebar for Filters (Desktop: 250px, Mobile: 100%) -->
            <aside class="tmg-shop-sidebar" style="flex: 0 0 250px; background: var(--color-background); padding: var(--spacing-lg); border-radius: var(--radius-md); box-shadow: var(--shadow-sm); align-self: flex-start;">
                <h3 style="font-size: 1.2rem; border-bottom: 2px solid var(--color-border); padding-bottom: var(--spacing-xs); margin-bottom: var(--spacing-md);">Filter By</h3>
                
                <?php
                // WooCommerce widgets will populate here. 
                // Using standard action so Astra/WooCommerce sidebar widgets load.
                if ( is_active_sidebar( 'woocommerce-sidebar' ) ) {
                    dynamic_sidebar( 'woocommerce-sidebar' );
                } else {
                    echo '<p style="color:var(--color-text-muted); font-size: 0.9rem;">Price, Material, and Category filters will appear here once configured in WP Admin.</p>';
                }
                ?>
            </aside>

            <!-- Main Product Grid -->
            <main class="tmg-shop-main" style="flex: 1; min-width: 300px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-md); flex-wrap: wrap; gap: var(--spacing-sm);">
                    <div class="tmg-result-count" style="color: var(--color-text-muted);">
                        <?php do_action( 'woocommerce_before_shop_loop' ); ?>
                    </div>
                </div>

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
    .woocommerce ul.products { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: var(--spacing-lg); padding: 0; margin: 0; list-style: none; }
    .woocommerce ul.products li.product { width: 100% !important; margin: 0 !important; }
    .tmg-product-card:hover { box-shadow: var(--shadow-md); border-color: var(--color-secondary); }
    .woocommerce ul.products li.product .price { color: var(--color-primary); font-weight: bold; }
    .woocommerce ul.products li.product .button { background: var(--color-primary); color: white; border-radius: var(--radius-sm); width: 100%; text-align: center; display: block; margin-top: var(--spacing-sm); }
    .woocommerce ul.products li.product .button:hover { background: var(--color-secondary); color: var(--color-primary); }
</style>

<?php get_footer( 'shop' ); ?>
