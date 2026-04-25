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

// Disable COD payment method
add_filter('woocommerce_available_payment_gateways', function($gateways) {
    unset($gateways['cod']);
    return $gateways;
});


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
    echo '<div id="tmg_gift_wrapping_wrapper" style="background: #FBFBFD; padding: 20px; border-radius: 16px; margin-bottom: 24px; border: 1.5px solid #E5E5EA;">';
    echo '<h3 style="margin-top: 0; color: #0A192F; font-size:16px; display:flex; align-items:center; gap:8px;">🎁 Add Gift Wrapping <span style="font-size:12px; font-weight:normal; color:#86868B;">(Optional)</span></h3>';
    
    $wrap_val = WC()->session->get('tmg_gift_wrap_type') ? WC()->session->get('tmg_gift_wrap_type') : 'none';
    
    woocommerce_form_field( 'tmg_gift_wrap_type', array(
        'type'          => 'radio',
        'class'         => array('tmg-gift-wrap-options'),
        'label'         => '',
        'options'       => array(
            'none'     => 'No wrapping — standard protective packaging — ₹0',
            'blue'     => 'Premium Blue Gift Box — rigid box with ribbon — ₹49',
            'bag'      => 'Luxury Gift Bag — premium paper bag with tissue — ₹79',
            'red'      => 'Romantic Red Box — velvet finish with bow — ₹99',
            'festival' => 'Festival Box — Diwali and Holi special design — ₹89'
        ),
        'default'       => $wrap_val
    ), $wrap_val);

    // Conditional fields revealed via JS
    echo '<div id="tmg_gift_wrap_extras" style="display:none; margin-top:16px; padding-top:16px; border-top:1px solid #E5E5EA;">';
    
    woocommerce_form_field( 'tmg_gift_name_tag', array(
        'type'          => 'text',
        'class'         => array('tmg-gift-name-field'),
        'label'         => 'Recipient Name for Name Tag (Free)',
        'maxlength'     => 25,
        'placeholder'   => 'E.g. For Priya'
    ), WC()->session->get('tmg_gift_name_tag'));

    $msg_check = WC()->session->get('tmg_gift_msg_check') ? WC()->session->get('tmg_gift_msg_check') : 0;
    woocommerce_form_field( 'tmg_gift_msg_check', array(
        'type'          => 'checkbox',
        'class'         => array('tmg-gift-msg-check-field'),
        'label'         => 'Add Gift Message Card (₹29)',
    ), $msg_check);
    
    echo '<div id="tmg_gift_message_wrap" style="display:none; margin-top:10px;">';
    woocommerce_form_field( 'tmg_gift_message', array(
        'type'          => 'textarea',
        'class'         => array('tmg-gift-message-field'),
        'label'         => '',
        'maxlength'     => 100,
        'placeholder'   => 'Write a message for the recipient (Max 100 chars)...'
    ), WC()->session->get('tmg_gift_message'));
    echo '</div>';
    
    echo '</div>'; // end extras
    echo '</div>'; // end wrapper
}

// 2. AJAX handlers to save session so fees can apply
add_action('wp_ajax_tmg_update_gift_wrap_session', 'tmg_update_gift_wrap_session');
add_action('wp_ajax_nopriv_tmg_update_gift_wrap_session', 'tmg_update_gift_wrap_session');
function tmg_update_gift_wrap_session() {
    if(isset($_POST['wrap_type'])) WC()->session->set('tmg_gift_wrap_type', sanitize_text_field($_POST['wrap_type']));
    if(isset($_POST['msg_check'])) WC()->session->set('tmg_gift_msg_check', intval($_POST['msg_check']));
    if(isset($_POST['name_tag'])) WC()->session->set('tmg_gift_name_tag', sanitize_text_field($_POST['name_tag']));
    if(isset($_POST['message'])) WC()->session->set('tmg_gift_message', sanitize_text_field($_POST['message']));
    wp_send_json_success();
}

// 3. Add Fee to Cart based on selection
add_action( 'woocommerce_cart_calculate_fees', 'themengift_add_gift_wrap_fee' );
function themengift_add_gift_wrap_fee( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;
    
    $wrap_type = WC()->session->get('tmg_gift_wrap_type');
    $msg_check = WC()->session->get('tmg_gift_msg_check');
    
    $wrap_fees = [
        'blue' => ['name' => 'Premium Blue Gift Box', 'fee' => 49],
        'bag'  => ['name' => 'Luxury Gift Bag', 'fee' => 79],
        'red'  => ['name' => 'Romantic Red Box', 'fee' => 99],
        'festival' => ['name' => 'Festival Box', 'fee' => 89]
    ];
    
    if (array_key_exists($wrap_type, $wrap_fees)) {
        $cart->add_fee( 'Gift Wrapping: ' . $wrap_fees[$wrap_type]['name'], $wrap_fees[$wrap_type]['fee'], true, '' );
        
        if ($msg_check == 1) {
            $cart->add_fee( 'Gift Message Card', 29, true, '' );
        }
    }
}

// 4. Save selected gift wrap to order meta
add_action( 'woocommerce_checkout_create_order', 'themengift_save_gift_wrap_to_order', 10, 2 );
function themengift_save_gift_wrap_to_order( $order, $data ) {
    $wrap_type = WC()->session->get('tmg_gift_wrap_type');
    if ( $wrap_type && $wrap_type !== 'none' ) {
        $order->update_meta_data( 'Gift Wrap Type', sanitize_text_field( $wrap_type ) );
        
        $name_tag = WC()->session->get('tmg_gift_name_tag');
        if(!empty($name_tag)) $order->update_meta_data( 'Recipient Name Tag', sanitize_text_field( $name_tag ) );
        
        if (WC()->session->get('tmg_gift_msg_check') == 1) {
            $msg = WC()->session->get('tmg_gift_message');
            if(!empty($msg)) $order->update_meta_data( 'Gift Message', sanitize_textarea_field( $msg ) );
        }
    }
}

// 5. Trigger AJAX update and UI toggles
add_action( 'wp_footer', 'themengift_checkout_ajax_script' );
function themengift_checkout_ajax_script() {
    if ( is_checkout() && ! is_wc_endpoint_url() ) {
        ?>
        <script type="text/javascript">
            jQuery(function($){
                function toggleWrapExtras() {
                    var wrapType = $('input[name="tmg_gift_wrap_type"]:checked').val();
                    if(wrapType !== 'none' && wrapType !== undefined) {
                        $('#tmg_gift_wrap_extras').slideDown(300);
                    } else {
                        $('#tmg_gift_wrap_extras').slideUp(300);
                    }
                    
                    if($('#tmg_gift_msg_check').is(':checked')) {
                        $('#tmg_gift_message_wrap').slideDown(300);
                    } else {
                        $('#tmg_gift_message_wrap').slideUp(300);
                    }
                }
                
                $(document).on('change', 'input[name="tmg_gift_wrap_type"], input[name="tmg_gift_msg_check"]', function(){
                    toggleWrapExtras();
                    var data = {
                        action: 'tmg_update_gift_wrap_session',
                        wrap_type: $('input[name="tmg_gift_wrap_type"]:checked').val(),
                        msg_check: $('#tmg_gift_msg_check').is(':checked') ? 1 : 0,
                        name_tag: $('#tmg_gift_name_tag').val(),
                        message: $('#tmg_gift_message').val()
                    };
                    $.post(wc_checkout_params.ajax_url, data, function(res){
                        $('body').trigger('update_checkout');
                    });
                });
                
                $(document).on('blur', '#tmg_gift_name_tag, #tmg_gift_message', function(){
                    var data = {
                        action: 'tmg_update_gift_wrap_session',
                        wrap_type: $('input[name="tmg_gift_wrap_type"]:checked').val(),
                        msg_check: $('#tmg_gift_msg_check').is(':checked') ? 1 : 0,
                        name_tag: $('#tmg_gift_name_tag').val(),
                        message: $('#tmg_gift_message').val()
                    };
                    $.post(wc_checkout_params.ajax_url, data);
                });
                
                toggleWrapExtras();
            });
        </script>
        <?php
    }
}

// Include customizer settings for homepage
require get_stylesheet_directory() . '/customizer.php';

// FIX 6: AJAX Filter Products
add_action('wp_ajax_tmg_filter_products', 'tmg_filter_products');
add_action('wp_ajax_nopriv_tmg_filter_products', 'tmg_filter_products');
function tmg_filter_products() {
    $args = [
        'post_type' => 'product',
        'posts_per_page' => 24,
        'paged' => intval($_POST['page'] ?? 1),
    ];
    // Price filter
    if (!empty($_POST['min_price']) || !empty($_POST['max_price'])) {
        $args['meta_query'][] = [
            'key' => '_price',
            'value' => [floatval($_POST['min_price'] ?? 0), floatval($_POST['max_price'] ?? 9999)],
            'type' => 'NUMERIC',
            'compare' => 'BETWEEN',
        ];
    }
    // Material filter (product attribute pa_material)
    if (!empty($_POST['materials'])) {
        $args['tax_query'][] = [
            'taxonomy' => 'pa_material',
            'field' => 'slug',
            'terms' => (array)$_POST['materials'],
        ];
    }
    // Occasion filter
    if (!empty($_POST['occasions'])) {
        $args['tax_query'][] = [
            'taxonomy' => 'pa_occasion',
            'field' => 'slug',
            'terms' => (array)$_POST['occasions'],
        ];
    }
    // Sort
    switch ($_POST['sort'] ?? 'newest') {
        case 'price_asc':  $args['orderby'] = 'meta_value_num'; $args['meta_key'] = '_price'; $args['order'] = 'ASC'; break;
        case 'price_desc': $args['orderby'] = 'meta_value_num'; $args['meta_key'] = '_price'; $args['order'] = 'DESC'; break;
        case 'popular':    $args['orderby'] = 'meta_value_num'; $args['meta_key'] = 'total_sales'; $args['order'] = 'DESC'; break;
        case 'rating':     $args['orderby'] = 'meta_value_num'; $args['meta_key'] = '_wc_average_rating'; $args['order'] = 'DESC'; break;
        default:           $args['orderby'] = 'date'; $args['order'] = 'DESC';
    }
    $query = new WP_Query($args);
    ob_start();
    foreach ($query->posts as $post) {
        setup_postdata($post);
        get_template_part('template-parts/product', 'card');
    }
    $html = ob_get_clean();
    wp_send_json_success([
        'html' => $html,
        'total' => $query->found_posts,
        'pages' => $query->max_num_pages,
    ]);
}

// FIX 8: No Return Notice and Personalisation Box for Custom Products
add_action('woocommerce_before_add_to_cart_button', function() {
    global $product;
    if (get_post_meta($product->get_id(), 'tmg_is_custom', true) === 'yes' || has_term('custom-gifts', 'product_cat', $product->get_id())) {
        ?>
        <div style="background:#EEF4FF; border-radius:16px; border:1.5px solid #1B4F9E; padding:20px; margin-bottom:20px; text-align:left;">
            <div style="display:flex; align-items:center; gap:8px; margin-bottom:12px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1B4F9E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                <h3 style="margin:0; font-size:16px; font-weight:700; color:#1B4F9E;">Personalise Your Product</h3>
            </div>
            
            <div style="margin-bottom:16px;">
                <label style="display:flex; justify-content:space-between; font-size:13px; font-weight:600; color:#0A192F; margin-bottom:6px;">
                    Engraving Text <span id="char_count" style="color:#86868B; font-weight:400;">0 of 20 characters</span>
                </label>
                <input type="text" name="tmg_custom_text" id="tmg_custom_text" maxlength="20" placeholder="E.g. ARJUN or 14.02.2024" style="width:100%; padding:12px; border:1px solid #E2E8F0; border-radius:8px; font-size:14px; outline:none;" onkeyup="document.getElementById('char_count').innerText = this.value.length + ' of 20 characters'">
                <p style="font-size:11px; color:#86868B; margin:6px 0 0;">Your text will appear exactly as typed. Use CAPITALS for engraving.</p>
            </div>
            
            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:13px; font-weight:600; color:#0A192F; margin-bottom:6px;">Photo Upload (Optional)</label>
                <input type="file" name="tmg_custom_photo" accept=".jpg,.jpeg,.png" style="width:100%; font-size:13px; padding:8px; border:1px dashed #A0AEC0; border-radius:8px; background:#fff;">
                <p style="font-size:11px; color:#86868B; margin:6px 0 0;">JPG or PNG, Max 5MB. For photo gifts only.</p>
            </div>
            
            <div style="font-size:13px; color:#0A192F; margin-bottom:4px;">
                <strong>Prefer to discuss?</strong> <a href="https://wa.me/919999999999?text=Hi+I+need+help+with+THEMENGIFT" target="_blank" style="color:#166534; font-weight:700; text-decoration:none;">Chat with us</a>
            </div>
            <div style="font-size:12px; color:#4A5568;">
                🚚 Custom products ship in 3 to 5 working days.
            </div>
        </div>
        <?php
    }
}, 15);

add_action('woocommerce_after_add_to_cart_button', function() {
    global $product;
    if (get_post_meta($product->get_id(), 'tmg_is_custom', true) === 'yes' || has_term('custom-gifts', 'product_cat', $product->get_id())) {
        echo '<div style="margin-top:16px; padding:12px; border-left:4px solid #E53E3E; background:#FFF5F5; color:#C53030; font-size:12px; font-weight:500; border-radius:4px;">⚠️ All custom and personalised products are NON-RETURNABLE unless there is a manufacturing defect.</div>';
    }
}, 25);

// Ensure multipart form data for file uploads
add_action('woocommerce_before_add_to_cart_form', function() {
    echo '<!-- TMG Enctype hook --><script>document.addEventListener("DOMContentLoaded", function(){var f=document.querySelector("form.cart");if(f){f.setAttribute("enctype","multipart/form-data");}});</script>';
});

// FIX 17: Order Tracking
add_action('add_meta_boxes', function() {
    add_meta_box('tmg_tracking', 'Shipping Tracking', function($post) {
        $tracking_id = get_post_meta($post->ID, '_tmg_tracking_id', true);
        $courier = get_post_meta($post->ID, '_tmg_courier', true);
        echo '<label>Courier Partner:</label>';
        echo '<select name="_tmg_courier"><option value="">Select...</option><option value="shiprocket" '.selected($courier,'shiprocket',false).'>Shiprocket</option><option value="delhivery" '.selected($courier,'delhivery',false).'>Delhivery</option></select>';
        echo '<br><label>Tracking ID:</label>';
        echo '<input type="text" name="_tmg_tracking_id" value="'.esc_attr($tracking_id).'" />';
        echo '<p style="color:#666; font-size:12px;">After saving, tracking ID is auto-sent to customer WhatsApp</p>';
    }, 'shop_order', 'side');
});

add_action('save_post_shop_order', function($order_id) {
    if (isset($_POST['_tmg_tracking_id']) && !empty($_POST['_tmg_tracking_id'])) {
        $old = get_post_meta($order_id, '_tmg_tracking_id', true);
        $new = sanitize_text_field($_POST['_tmg_tracking_id']);
        if ($old !== $new) {
            update_post_meta($order_id, '_tmg_tracking_id', $new);
            update_post_meta($order_id, '_tmg_courier', sanitize_text_field($_POST['_tmg_courier']));
            // Send WhatsApp notification to customer
            tmg_send_tracking_whatsapp($order_id, $new, $_POST['_tmg_courier']);
        }
    }
});

function tmg_send_tracking_whatsapp($order_id, $tracking_id, $courier) {
    $order = wc_get_order($order_id);
    $phone = $order->get_billing_phone();
    $name = $order->get_billing_first_name();
    $message = "Hi {$name}! 🎉\n\nYour THEMENGIFT order #{$order_id} has been shipped!\n\n📦 Courier: " . strtoupper($courier) . "\n🔢 Tracking ID: {$tracking_id}\n\n🔗 Track here: https://shiprocket.co/tracking/{$tracking_id}\n\nThank you for shopping with THEMENGIFT! 🙏";
    // Send via UltraMsg or Twilio API
    // TODO: Add your WhatsApp API credentials
}
