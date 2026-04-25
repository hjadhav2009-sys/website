<?php
/**
 * THEMENGIFT Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package THEMENGIFT
 */

/**
 * Enqueue scripts and styles.
 */
function themengift_enqueue_styles() {
    // Enqueue Parent Theme Style
    wp_enqueue_style( 'astra-theme-css', get_template_directory_uri() . '/style.css' );
    
    // Enqueue Child Theme Style
    wp_enqueue_style( 'themengift-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'astra-theme-css' ),
        wp_get_theme()->get('Version')
    );

    // Enqueue Brand CSS (Design System)
    wp_enqueue_style( 'themengift-brand',
        get_stylesheet_directory_uri() . '/assets/css/brand.css',
        array(),
        wp_get_theme()->get('Version')
    );

    // Enqueue Radiant UI CSS (Tailwind)
    wp_enqueue_style( 'themengift-radiant-ui',
        get_stylesheet_directory_uri() . '/assets/css/radiant-ui.css',
        array(),
        wp_get_theme()->get('Version')
    );

    // Enqueue Custom JS
    wp_enqueue_script( 'themengift-custom-js',
        get_stylesheet_directory_uri() . '/assets/js/custom.js',
        array('jquery'),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'themengift_enqueue_styles', 15 );

// Allow SVG uploads
function themengift_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'themengift_mime_types');

// Remove WooCommerce Default Styles to use our Brand Styles
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * WooCommerce Specific Tweaks for THEMENGIFT
 */

// Remove default title and price from summary (we added them manually in single-product.php)
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

// -------------------------------------------------------------
// GIFT WRAPPING ADD-ON ON CHECKOUT
// -------------------------------------------------------------

// 1. Add Custom Field to Checkout
add_action( 'woocommerce_review_order_before_submit', 'themengift_gift_wrapping_checkout_field' );
function themengift_gift_wrapping_checkout_field() {
    echo '<div id="tmg_gift_wrapping_wrapper" style="background: var(--color-surface); padding: var(--spacing-md); border-radius: var(--radius-md); margin-bottom: var(--spacing-lg); border: 2px solid var(--color-border);">';
    echo '<h3 style="margin-top: 0; color: var(--color-primary);">🎁 Add Gift Wrapping (Optional)</h3>';
    
    woocommerce_form_field( 'tmg_gift_wrap_type', array(
        'type'          => 'radio',
        'class'         => array('tmg-gift-wrap-options'),
        'label'         => '',
        'options'       => array(
            'none'      => 'No thanks - standard packaging',
            'blue_box'  => 'Premium Blue Box (+₹49)',
            'lux_bag'   => 'Luxury Gift Bag (+₹79)',
            'red_box'   => 'Romantic Red Box (+₹99)'
        ),
        'default'       => 'none'
    ), WC()->checkout->get_value( 'tmg_gift_wrap_type' ));

    // Message field
    woocommerce_form_field( 'tmg_gift_message', array(
        'type'          => 'textarea',
        'class'         => array('tmg-gift-message-field'),
        'label'         => 'Gift Message (Optional)',
        'placeholder'   => 'Write a message for the recipient...'
    ), WC()->checkout->get_value( 'tmg_gift_message' ));

    echo '</div>';
}

// 2. Add Fee to Cart based on selection
add_action( 'woocommerce_cart_calculate_fees', 'themengift_add_gift_wrap_fee' );
function themengift_add_gift_wrap_fee( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;

    // This requires AJAX update on checkout radio change.
    // In actual WP, we capture POST data if available via AJAX refresh
    if( isset($_POST['post_data']) ) {
        parse_str($_POST['post_data'], $post_data);
        $wrap_type = isset($post_data['tmg_gift_wrap_type']) ? $post_data['tmg_gift_wrap_type'] : 'none';
    } else {
        $wrap_type = 'none'; // Default fallback
    }

    $fee = 0;
    $name = 'Gift Wrapping';

    switch($wrap_type) {
        case 'blue_box': $fee = 49; $name = 'Premium Blue Box'; break;
        case 'lux_bag':  $fee = 79; $name = 'Luxury Gift Bag'; break;
        case 'red_box':  $fee = 99; $name = 'Romantic Red Box'; break;
    }

    if ( $fee > 0 ) {
        $cart->add_fee( $name, $fee, true, 'standard' );
    }
}

// 3. Save selected gift wrap to order meta
add_action( 'woocommerce_checkout_create_order', 'themengift_save_gift_wrap_to_order', 10, 2 );
function themengift_save_gift_wrap_to_order( $order, $data ) {
    if ( isset( $_POST['tmg_gift_wrap_type'] ) && $_POST['tmg_gift_wrap_type'] !== 'none' ) {
        $order->update_meta_data( '_tmg_gift_wrap_type', sanitize_text_field( $_POST['tmg_gift_wrap_type'] ) );
    }
    if ( ! empty( $_POST['tmg_gift_message'] ) ) {
        $order->update_meta_data( 'Gift Message', sanitize_textarea_field( $_POST['tmg_gift_message'] ) );
    }
}

// 4. Trigger AJAX update when radio button changes
add_action( 'wp_footer', 'themengift_checkout_ajax_script' );
function themengift_checkout_ajax_script() {
    if ( is_checkout() && ! is_wc_endpoint_url() ) {
        ?>
        <script type="text/javascript">
            jQuery(function($){
                $('form.checkout').on('change', 'input[name="tmg_gift_wrap_type"]', function(){
                    $('body').trigger('update_checkout');
                });
            });
        </script>
        <?php
    }
}

// Include customizer settings for homepage
require get_stylesheet_directory() . '/customizer.php';

