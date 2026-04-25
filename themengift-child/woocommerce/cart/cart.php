<?php
/**
 * WooCommerce Cart Page Override - Radiant UI Design
 * File: woocommerce/cart/cart.php
 */
defined('ABSPATH') || exit;
?>

<section style="background:#FBFBFD; border-bottom:1px solid #E5E5EA;">
    <div class="tmg-container" style="padding-top:48px; padding-bottom:48px;">
        <!-- Breadcrumb -->
        <div style="display:flex; align-items:center; gap:6px; font-size:13px; color:#86868B; margin-bottom:16px;">
            <a href="/" style="color:#86868B; text-decoration:none;">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            <span style="color:#1D1D1F;">Your Cart</span>
        </div>
        <h1 style="font-family:'Playfair Display',serif; font-size:clamp(2rem,4vw,2.8rem); font-weight:700; color:#0A192F; margin:0 0 8px;">Your cart</h1>
        <p style="color:#86868B; font-size:14px; margin:0;"><?php echo WC()->cart->get_cart_contents_count(); ?> item(s) · ready to ship</p>
    </div>
</section>

<section style="background:#fff; padding:48px 0 80px;">
    <div class="tmg-container">
        <?php do_action('woocommerce_before_cart'); ?>

        <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
            <?php do_action('woocommerce_before_cart_table'); ?>

            <div style="display:grid; grid-template-columns:1fr 380px; gap:32px; align-items:start;" class="tmg-cart-layout">

                <!-- ===== CART ITEMS ===== -->
                <div>
                    <!-- Free shipping progress bar -->
                    <?php
                    $free_min = 699;
                    $cart_total = WC()->cart->subtotal;
                    $remain = max(0, $free_min - $cart_total);
                    $pct    = min(100, ($cart_total / $free_min) * 100);
                    ?>
                    <div style="background:#EEF2FF; border-radius:14px; padding:14px 18px; margin-bottom:20px; display:flex; align-items:center; gap:12px;">
                        <span style="font-size:18px;">🚚</span>
                        <div style="flex:1;">
                            <?php if($remain > 0): ?>
                            <p style="font-size:13px; font-weight:600; color:#1D1D1F; margin:0 0 6px;">Add <strong>₹<?php echo number_format($remain); ?></strong> more for FREE shipping!</p>
                            <?php else: ?>
                            <p style="font-size:13px; font-weight:600; color:#276749; margin:0 0 6px;">🎉 You've unlocked FREE shipping!</p>
                            <?php endif; ?>
                            <div style="height:6px; background:#C7D2FE; border-radius:999px; overflow:hidden;">
                                <div style="height:100%; width:<?php echo $pct; ?>%; background:#0A2463; border-radius:999px; transition:width 0.5s;"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Cart items list -->
                    <div style="border:1.5px solid #E5E5EA; border-radius:20px; overflow:hidden;">
                        <?php foreach(WC()->cart->get_cart() as $cart_item_key => $cart_item):
                            $_product    = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                            $product_id  = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                            if($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)):
                                $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                                $thumbnail         = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('woocommerce_thumbnail'), $cart_item, $cart_item_key);
                                $product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                                $product_subtotal  = apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key);
                        ?>
                        <div style="display:flex; gap:16px; padding:20px; border-bottom:1px solid #E5E5EA;" class="tmg-cart-item woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

                            <!-- Image -->
                            <div style="width:96px; height:112px; border-radius:14px; overflow:hidden; flex-shrink:0; background:#FBFBFD;">
                                <?php if(!$product_permalink): ?>
                                    <?php echo $thumbnail; ?>
                                <?php else: ?>
                                    <a href="<?php echo esc_url($product_permalink); ?>" style="display:block; width:100%; height:100%;">
                                        <?php echo str_replace('<img', '<img style="width:100%;height:100%;object-fit:cover;"', $thumbnail); ?>
                                    </a>
                                <?php endif; ?>
                            </div>

                            <!-- Info -->
                            <div style="flex:1; min-width:0;">
                                <p style="font-size:11px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#86868B; margin:0 0 4px;">
                                    <?php echo esc_html(wc_get_product_category_list($product_id, ', ')); ?>
                                </p>
                                <h3 style="font-size:15px; font-weight:600; color:#1D1D1F; margin:0 0 6px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                    <?php if(!$product_permalink): ?>
                                        <?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)); ?>
                                    <?php else: ?>
                                        <a href="<?php echo esc_url($product_permalink); ?>" style="color:#1D1D1F; text-decoration:none;"><?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)); ?></a>
                                    <?php endif; ?>
                                </h3>
                                <?php echo wc_get_formatted_cart_item_data($cart_item); ?>
                                <div style="display:flex; align-items:center; justify-content:space-between; margin-top:12px; flex-wrap:wrap; gap:10px;">
                                    <!-- Qty stepper -->
                                    <div style="display:flex; align-items:center; border:1.5px solid #E5E5EA; border-radius:10px; overflow:hidden;">
                                        <button type="button" onclick="stepQty(this,-1)" style="width:36px; height:36px; background:#FBFBFD; border:none; cursor:pointer; font-size:18px; color:#1D1D1F; transition:background 0.2s; display:flex; align-items:center; justify-content:center;"
                                            onmouseover="this.style.background='#E5E5EA'" onmouseout="this.style.background='#FBFBFD'">−</button>
                                        <?php
                                        if(array_key_exists('key', $cart_item)):
                                        ?>
                                        <input type="number" name="cart[<?php echo esc_attr($cart_item_key); ?>][qty]"
                                            value="<?php echo esc_attr($cart_item['quantity']); ?>" min="0" max="<?php echo esc_attr($_product->get_max_purchase_quantity()); ?>"
                                            step="1" autocomplete="off"
                                            style="width:44px; height:36px; text-align:center; border:none; font-size:14px; font-weight:600; color:#1D1D1F; background:#fff; outline:none; -moz-appearance:textfield;">
                                        <?php endif; ?>
                                        <button type="button" onclick="stepQty(this,1)" style="width:36px; height:36px; background:#FBFBFD; border:none; cursor:pointer; font-size:18px; color:#1D1D1F; transition:background 0.2s; display:flex; align-items:center; justify-content:center;"
                                            onmouseover="this.style.background='#E5E5EA'" onmouseout="this.style.background='#FBFBFD'">+</button>
                                    </div>
                                    <div style="text-align:right;">
                                        <div style="font-size:16px; font-weight:700; color:#0A2463;"><?php echo $product_subtotal; ?></div>
                                        <a href="<?php echo esc_url(wc_get_cart_remove_url($cart_item_key)); ?>"
                                            class="remove"
                                            aria-label="<?php echo esc_attr__('Remove this item', 'woocommerce'); ?>"
                                            data-product_id="<?php echo esc_attr($product_id); ?>"
                                            data-product_sku="<?php echo esc_attr($_product->get_sku()); ?>"
                                            style="display:inline-flex; align-items:center; gap:4px; font-size:12px; color:#86868B; text-decoration:none; margin-top:4px; transition:color 0.2s;"
                                            onmouseover="this.style.color='#E53E3E'" onmouseout="this.style.color='#86868B'">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="m19 6-.867 12.142A2 2 0 0 1 16.138 20H7.862a2 2 0 0 1-1.995-1.858L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                            Remove
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; endforeach; ?>
                    </div>

                    <!-- Update cart + Continue shopping -->
                    <div style="display:flex; align-items:center; justify-content:space-between; margin-top:16px; flex-wrap:wrap; gap:10px;">
                        <a href="/shop" style="font-size:13px; font-weight:600; color:#86868B; text-decoration:none; display:inline-flex; align-items:center; gap:4px;"
                            onmouseover="this.style.color='#0A2463'" onmouseout="this.style.color='#86868B'">
                            ← Continue shopping
                        </a>
                        <button type="submit" name="update_cart" value="Update cart"
                            style="padding:10px 20px; border-radius:10px; border:1.5px solid #E5E5EA; background:#fff; font-size:13px; font-weight:600; color:#1D1D1F; cursor:pointer; transition:all 0.2s;"
                            onmouseover="this.style.borderColor='#0A2463'; this.style.color='#0A2463'" onmouseout="this.style.borderColor='#E5E5EA'; this.style.color='#1D1D1F'">
                            Update cart
                        </button>
                    </div>

                    <?php do_action('woocommerce_cart_contents'); ?>
                    <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                </div>

                <!-- ===== ORDER SUMMARY SIDEBAR ===== -->
                <aside style="background:#FBFBFD; border:1.5px solid #E5E5EA; border-radius:20px; padding:28px; position:sticky; top:110px;">
                    <h3 style="font-family:'Playfair Display',serif; font-size:20px; color:#0A192F; margin:0 0 20px;">Order summary</h3>

                    <?php do_action('woocommerce_before_cart_totals'); ?>

                    <!-- Coupon -->
                    <?php if(wc_coupons_enabled()): ?>
                    <div style="margin-bottom:20px;">
                        <div style="display:flex; gap:8px;">
                            <input type="text" name="coupon_code" id="coupon_code" class="input-text" value="" placeholder="Promo code"
                                style="flex:1; padding:11px 14px; border:1.5px solid #E5E5EA; border-radius:10px; font-size:13px; outline:none; transition:border-color 0.2s;"
                                onfocus="this.style.borderColor='#0A2463'" onblur="this.style.borderColor='#E5E5EA'">
                            <button type="submit" name="apply_coupon" value="Apply coupon"
                                style="padding:11px 16px; background:#1D1D1F; color:#fff; border:none; border-radius:10px; font-size:13px; font-weight:600; cursor:pointer; transition:background 0.2s; white-space:nowrap;"
                                onmouseover="this.style.background='#0A2463'" onmouseout="this.style.background='#1D1D1F'">
                                Apply
                            </button>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Totals -->
                    <div style="display:flex; flex-direction:column; gap:12px; font-size:14px; padding-bottom:16px; border-bottom:1px solid #E5E5EA; margin-bottom:16px;">
                        <div style="display:flex; justify-content:space-between;">
                            <span style="color:#86868B;">Subtotal</span>
                            <span style="font-weight:600; color:#1D1D1F;"><?php wc_cart_totals_subtotal_html(); ?></span>
                        </div>
                        <?php foreach(WC()->cart->get_fees() as $fee): ?>
                        <div style="display:flex; justify-content:space-between;">
                            <span style="color:#86868B;"><?php echo esc_html($fee->name); ?></span>
                            <span style="font-weight:600;"><?php wc_cart_totals_fee_html($fee); ?></span>
                        </div>
                        <?php endforeach; ?>
                        <?php if(WC()->cart->needs_shipping() && WC()->cart->show_shipping()): ?>
                        <div style="display:flex; justify-content:space-between;">
                            <span style="color:#86868B;">Shipping</span>
                            <span style="font-weight:600; color:#276749;"><?php wc_cart_totals_shipping_html(); ?></span>
                        </div>
                        <?php endif; ?>
                        <div style="display:flex; justify-content:space-between;">
                            <span style="color:#86868B;">Personalisation</span>
                            <span style="font-weight:600; color:#276749;">Included ✓</span>
                        </div>
                        <?php wc_cart_totals_coupon_html(current(WC()->cart->get_coupons())); ?>
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:baseline; margin-bottom:20px;">
                        <span style="font-size:16px; font-weight:700; color:#1D1D1F;">Total</span>
                        <span style="font-family:'Playfair Display',serif; font-size:22px; font-weight:800; color:#0A2463;"><?php wc_cart_totals_order_total_html(); ?></span>
                    </div>

                    <a href="<?php echo esc_url(wc_get_checkout_url()); ?>"
                        style="display:flex; align-items:center; justify-content:center; gap:8px; background:#0A2463; color:#fff; font-weight:700; padding:15px; border-radius:12px; text-decoration:none; font-size:15px; transition:all 0.2s; letter-spacing:0.03em;"
                        onmouseover="this.style.background='#172A45'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 8px 20px rgba(10,36,99,0.25)'"
                        onmouseout="this.style.background='#0A2463'; this.style.transform=''; this.style.boxShadow=''">
                        Proceed to checkout →
                    </a>

                    <!-- Trust badges -->
                    <ul style="list-style:none; padding:0; margin:16px 0 0; display:flex; flex-direction:column; gap:8px;">
                        <li style="display:flex; align-items:center; gap:8px; font-size:12px; color:#86868B;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0A2463" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/></svg>
                            SSL secure · UPI / Cards / NetBanking
                        </li>
                        <li style="display:flex; align-items:center; gap:8px; font-size:12px; color:#86868B;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0A2463" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                            Free returns within 30 days
                        </li>
                        <li style="display:flex; align-items:center; gap:8px; font-size:12px; color:#86868B;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0A2463" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                            Gift wrap included free on every order
                        </li>
                    </ul>

                    <?php do_action('woocommerce_after_cart_totals'); ?>
                </aside>

            </div><!-- end cart layout grid -->

            <?php do_action('woocommerce_after_cart_table'); ?>
        </form>

        <?php do_action('woocommerce_after_cart'); ?>
    </div>
</section>

<!-- You might also like -->
<section style="background:#FBFBFD; padding:56px 0; border-top:1px solid #E5E5EA;">
    <div class="tmg-container">
        <div style="display:flex; align-items:end; justify-content:space-between; flex-wrap:wrap; gap:16px; margin-bottom:28px;">
            <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.6rem,3vw,2rem); color:#0A192F; margin:0;">You might also like</h2>
            <a href="/shop" style="font-size:14px; font-weight:600; color:#0A2463; text-decoration:none;">Browse all →</a>
        </div>
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px;" class="tmg-rec-grid">
            <?php
            $rec = new WP_Query(['post_type'=>'product','posts_per_page'=>4,'orderby'=>'rand','post_status'=>'publish']);
            while($rec->have_posts()): $rec->the_post();
                global $product;
                $img = get_the_post_thumbnail_url(get_the_ID(),'woocommerce_single') ?: wc_placeholder_img_src();
            ?>
            <a href="<?php the_permalink(); ?>" style="text-decoration:none; display:block; background:#fff; border-radius:16px; overflow:hidden; border:1.5px solid #E5E5EA; transition:all 0.3s;"
                onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 16px 32px rgba(0,0,0,0.08)'"
                onmouseout="this.style.transform=''; this.style.boxShadow=''">
                <div style="aspect-ratio:1; overflow:hidden; background:#FBFBFD;">
                    <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" style="width:100%; height:100%; object-fit:cover; transition:transform 0.5s;" onmouseover="this.style.transform='scale(1.06)'" onmouseout="this.style.transform=''">
                </div>
                <div style="padding:14px;">
                    <h3 style="font-size:13px; font-weight:600; color:#1D1D1F; margin:0 0 6px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?php the_title(); ?></h3>
                    <span style="font-size:15px; font-weight:700; color:#0A2463;"><?php echo $product->get_price_html(); ?></span>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>

<style>
@media(max-width:1024px){
    .tmg-cart-layout{grid-template-columns:1fr!important;}
    .tmg-rec-grid{grid-template-columns:repeat(2,1fr)!important;}
}
@media(max-width:640px){
    .tmg-rec-grid{grid-template-columns:repeat(2,1fr)!important;}
}
</style>

<script>
function stepQty(btn, dir){
    var input = btn.parentNode.querySelector('input[type="number"]');
    if(input){
        var v = parseInt(input.value) + dir;
        if(v >= 0) input.value = v;
    }
}
</script>
