<?php
/**
 * WooCommerce Checkout Override — THEMENGIFT Radiant UI
 * File: woocommerce/checkout/form-checkout.php
 */
defined('ABSPATH') || exit;

// Stop checkout for empty cart
if(WC()->cart->is_empty()):
    wc_get_template('checkout/cart-empty.php');
    return;
endif;

do_action('woocommerce_before_checkout_form', $checkout);
?>

<!-- HEADER -->
<section style="background:#FBFBFD; border-bottom:1px solid #E5E5EA;">
    <div class="tmg-container" style="padding-top:36px; padding-bottom:36px;">
        <div style="display:flex; align-items:center; gap:6px; font-size:13px; color:#86868B; margin-bottom:14px;">
            <a href="/" style="color:#86868B; text-decoration:none;">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            <a href="/cart" style="color:#86868B; text-decoration:none;">Cart</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            <span style="color:#1D1D1F; font-weight:600;">Checkout</span>
        </div>

        <!-- Step progress -->
        <div style="display:flex; align-items:center; gap:0; max-width:480px;">
            <?php
            $steps = ['Cart','Checkout','Confirmation'];
            foreach($steps as $i => $step):
                $done = $i < 1; $active = $i === 1;
            ?>
            <div style="display:flex; align-items:center; gap:0; flex:1;">
                <div style="display:flex; flex-direction:column; align-items:center; gap:4px;">
                    <div style="width:28px; height:28px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:700; transition:all 0.2s;
                        <?php echo $done?'background:#38A169;color:#fff;':($active?'background:#0A2463;color:#fff;':'background:#E5E5EA;color:#86868B;'); ?>">
                        <?php echo $done ? '✓' : ($i+1); ?>
                    </div>
                    <span style="font-size:11px; font-weight:<?php echo $active?'700':'500'; ?>; color:<?php echo $active?'#0A2463':'#86868B'; ?>; white-space:nowrap;"><?php echo esc_html($step); ?></span>
                </div>
                <?php if($i < count($steps)-1): ?>
                <div style="flex:1; height:2px; background:<?php echo $done?'#38A169':'#E5E5EA'; ?>; margin:0 8px; margin-top:-14px;"></div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section style="background:#fff; padding:40px 0 80px;">
    <div class="tmg-container">
        <form name="checkout" method="post" class="checkout woocommerce-checkout"
            action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

            <div style="display:grid; grid-template-columns:1fr 380px; gap:32px; align-items:start;" class="tmg-checkout-layout">

                <!-- ===== LEFT: FORM FIELDS ===== -->
                <div>

                    <?php if($checkout->get_checkout_fields()): ?>

                    <!-- CONTACT INFO -->
                    <div style="background:#FBFBFD; border:1.5px solid #E5E5EA; border-radius:20px; padding:28px; margin-bottom:20px;">
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:20px;">
                            <div style="width:36px; height:36px; border-radius:10px; background:#0A2463; color:#fff; display:flex; align-items:center; justify-content:center; font-size:14px; font-weight:700; flex-shrink:0;">1</div>
                            <h2 style="font-family:'Playfair Display',serif; font-size:1.3rem; color:#0A192F; margin:0;">Contact &amp; Billing</h2>
                        </div>

                        <?php if(!is_user_logged_in() && $checkout->is_registration_required()): ?>
                        <div style="background:#EEF2FF; border-radius:12px; padding:14px 16px; margin-bottom:20px; font-size:13px; color:#0A2463;">
                            Already have an account?
                            <a href="<?php echo esc_url(wc_get_account_endpoint_url('dashboard')); ?>" style="font-weight:700; color:#0A2463;">Sign in →</a>
                        </div>
                        <?php endif; ?>

                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px;" class="tmg-billing-grid">
                            <?php
                            $billing_fields = $checkout->get_checkout_fields('billing');
                            foreach($billing_fields as $key => $field):
                                $full_width = in_array($key, ['billing_address_1','billing_address_2','billing_company','billing_email','billing_phone','billing_country','billing_state','billing_city']);
                            ?>
                            <div style="<?php echo $full_width ? 'grid-column:1/-1;' : ''; ?>">
                                <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- SHIPPING ADDRESS -->
                    <?php if(WC()->cart->needs_shipping_address()): ?>
                    <div style="background:#FBFBFD; border:1.5px solid #E5E5EA; border-radius:20px; padding:28px; margin-bottom:20px;">
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:20px;">
                            <div style="width:36px; height:36px; border-radius:10px; background:#0A2463; color:#fff; display:flex; align-items:center; justify-content:center; font-size:14px; font-weight:700; flex-shrink:0;">2</div>
                            <h2 style="font-family:'Playfair Display',serif; font-size:1.3rem; color:#0A192F; margin:0;">Shipping Address</h2>
                        </div>
                        <?php do_action('woocommerce_before_checkout_shipping_form', $checkout); ?>
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px;" class="tmg-shipping-grid">
                            <?php
                            $shipping_fields = $checkout->get_checkout_fields('shipping');
                            foreach($shipping_fields as $key => $field):
                                $full = in_array($key, ['shipping_address_1','shipping_address_2','shipping_country','shipping_state','shipping_city']);
                            ?>
                            <div style="<?php echo $full ? 'grid-column:1/-1;' : ''; ?>">
                                <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php do_action('woocommerce_after_checkout_shipping_form', $checkout); ?>
                    </div>
                    <?php endif; ?>

                    <!-- PERSONALISATION / GIFT MESSAGE -->
                    <div style="background:#EEF2FF; border:1.5px solid #C7D2FE; border-radius:20px; padding:24px; margin-bottom:20px;">
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:16px;">
                            <span style="font-size:22px;">🎁</span>
                            <div>
                                <p style="font-weight:700; font-size:14px; color:#0A192F; margin:0;">Personalisation & Gift Message</p>
                                <p style="font-size:12px; color:#86868B; margin:0;">Free on every order. Leave blank to skip.</p>
                            </div>
                        </div>
                        <div style="margin-bottom:12px;">
                            <label style="display:block; font-size:11px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#86868B; margin-bottom:6px;">Engraving Text (Name / Date / Message)</label>
                            <input type="text" name="tmg_engraving" placeholder="e.g. Priya & Rahul · 14.02.2024" maxlength="60"
                                style="width:100%; padding:12px 14px; border:1.5px solid #C7D2FE; border-radius:12px; font-size:14px; background:#fff; outline:none; box-sizing:border-box; transition:border-color 0.2s;"
                                onfocus="this.style.borderColor='#0A2463'" onblur="this.style.borderColor='#C7D2FE'">
                        </div>
                        <div>
                            <label style="display:block; font-size:11px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#86868B; margin-bottom:6px;">Gift Message (printed on the note card)</label>
                            <textarea name="tmg_gift_message" rows="3" placeholder="e.g. Happy Anniversary! Wishing you both a lifetime of love and laughter. — Mom &amp; Dad"
                                style="width:100%; padding:12px 14px; border:1.5px solid #C7D2FE; border-radius:12px; font-size:14px; background:#fff; outline:none; resize:none; font-family:inherit; box-sizing:border-box; transition:border-color 0.2s;"
                                onfocus="this.style.borderColor='#0A2463'" onblur="this.style.borderColor='#C7D2FE'"></textarea>
                        </div>
                    </div>

                    <!-- PAYMENT -->
                    <div style="background:#FBFBFD; border:1.5px solid #E5E5EA; border-radius:20px; padding:28px; margin-bottom:20px;">
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:20px;">
                            <div style="width:36px; height:36px; border-radius:10px; background:#0A2463; color:#fff; display:flex; align-items:center; justify-content:center; font-size:14px; font-weight:700; flex-shrink:0;">3</div>
                            <h2 style="font-family:'Playfair Display',serif; font-size:1.3rem; color:#0A192F; margin:0;">Payment Method</h2>
                        </div>
                        <?php do_action('woocommerce_checkout_payment'); ?>
                    </div>

                    <?php do_action('woocommerce_checkout_after_order_review'); ?>
                    <?php endif; ?>

                </div>

                <!-- ===== RIGHT: ORDER SUMMARY ===== -->
                <aside style="background:#FBFBFD; border:1.5px solid #E5E5EA; border-radius:20px; padding:28px; position:sticky; top:110px;">
                    <h3 style="font-family:'Playfair Display',serif; font-size:1.2rem; color:#0A192F; margin:0 0 20px;">Your order</h3>

                    <!-- Items -->
                    <div style="display:flex; flex-direction:column; gap:14px; padding-bottom:18px; border-bottom:1px solid #E5E5EA; margin-bottom:18px;">
                        <?php foreach(WC()->cart->get_cart() as $item_key => $item):
                            $_p = $item['data'];
                            $img = wp_get_attachment_url($_p->get_image_id()) ?: wc_placeholder_img_src();
                        ?>
                        <div style="display:flex; align-items:center; gap:12px;">
                            <div style="position:relative; flex-shrink:0;">
                                <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($_p->get_name()); ?>"
                                    style="width:52px; height:52px; border-radius:10px; object-fit:cover; border:1px solid #E5E5EA;">
                                <span style="position:absolute; top:-6px; right:-6px; width:18px; height:18px; background:#0A2463; color:#fff; border-radius:50%; font-size:10px; font-weight:700; display:flex; align-items:center; justify-content:center;"><?php echo esc_html($item['quantity']); ?></span>
                            </div>
                            <div style="flex:1; min-width:0;">
                                <p style="font-size:13px; font-weight:600; color:#1D1D1F; margin:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?php echo esc_html($_p->get_name()); ?></p>
                                <?php echo wc_get_formatted_cart_item_data($item); ?>
                            </div>
                            <span style="font-size:13px; font-weight:700; color:#0A2463; flex-shrink:0;"><?php echo WC()->cart->get_product_subtotal($_p, $item['quantity']); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Coupon -->
                    <?php if(wc_coupons_enabled()): ?>
                    <div style="display:flex; gap:8px; margin-bottom:18px; padding-bottom:18px; border-bottom:1px solid #E5E5EA;">
                        <input type="text" name="coupon_code" id="coupon_code" class="input-text" value="" placeholder="Promo code"
                            style="flex:1; padding:10px 14px; border:1.5px solid #E5E5EA; border-radius:10px; font-size:13px; outline:none;"
                            onfocus="this.style.borderColor='#0A2463'" onblur="this.style.borderColor='#E5E5EA'">
                        <button type="button" class="button" id="tmg-apply-coupon"
                            onclick="document.querySelector('[name=apply_coupon]')&&document.querySelector('[name=apply_coupon]').click();"
                            style="padding:10px 16px; background:#1D1D1F; color:#fff; border:none; border-radius:10px; font-size:13px; font-weight:700; cursor:pointer; white-space:nowrap;">Apply</button>
                    </div>
                    <?php endif; ?>

                    <!-- Totals -->
                    <?php do_action('woocommerce_checkout_order_review'); ?>

                    <!-- Trust badges -->
                    <div style="margin-top:16px; display:flex; flex-direction:column; gap:8px;">
                        <?php
                        $trust = [
                            ['🔒','SSL 256-bit encryption'],
                            ['💳','UPI · Cards · NetBanking · COD'],
                            ['📦','Free gift box on every order'],
                            ['🔄','30-day hassle-free returns'],
                        ];
                        foreach($trust as $t):
                        ?>
                        <div style="display:flex; align-items:center; gap:8px; font-size:12px; color:#86868B;">
                            <span><?php echo $t[0]; ?></span>
                            <?php echo esc_html($t[1]); ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </aside>

            </div><!-- end checkout layout -->

        </form>
        <?php do_action('woocommerce_after_checkout_form', $checkout); ?>
    </div>
</section>

<style>
/* ===== Checkout field overrides ===== */
.woocommerce-checkout .form-row { margin-bottom: 0 !important; }
.woocommerce-checkout .form-row label {
    display: block;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #86868B;
    margin-bottom: 6px;
}
.woocommerce-checkout .form-row input.input-text,
.woocommerce-checkout .form-row select,
.woocommerce-checkout .form-row textarea {
    width: 100%;
    padding: 12px 14px;
    border: 1.5px solid #E5E5EA;
    border-radius: 12px;
    font-size: 14px;
    font-family: inherit;
    color: #1D1D1F;
    background: #fff;
    outline: none;
    box-sizing: border-box;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.woocommerce-checkout .form-row input.input-text:focus,
.woocommerce-checkout .form-row select:focus,
.woocommerce-checkout .form-row textarea:focus {
    border-color: #0A2463;
    box-shadow: 0 0 0 3px rgba(10,36,99,0.08);
}
.woocommerce-checkout .form-row.woocommerce-invalid input { border-color: #E53E3E; }

/* Payment area */
#payment { background: transparent !important; border: none !important; border-radius: 0 !important; padding: 0 !important; }
#payment ul.payment_methods { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; }
#payment ul.payment_methods li { background: #fff; border: 1.5px solid #E5E5EA; border-radius: 14px; padding: 16px; transition: all 0.2s; }
#payment ul.payment_methods li:has(input:checked) { border-color: #0A2463; background: #EEF2FF; }
#payment ul.payment_methods li label { font-size: 14px; font-weight: 600; color: #1D1D1F; display: flex; align-items: center; gap: 8px; cursor: pointer; }
#payment .payment_box { background: #FBFBFD; border-radius: 10px; padding: 14px; margin-top: 10px; font-size: 13px; color: #86868B; }
#payment #place_order {
    width: 100%;
    padding: 16px;
    background: #0A2463;
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    letter-spacing: 0.03em;
    transition: all 0.25s;
    margin-top: 16px;
}
#payment #place_order:hover { background: #172A45; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(10,36,99,0.25); }
/* Order review table inside sidebar */
.woocommerce-checkout-review-order-table { width: 100%; border-collapse: collapse; font-size: 13px; margin-bottom: 16px; }
.woocommerce-checkout-review-order-table tr td, .woocommerce-checkout-review-order-table tr th { padding: 8px 0; border-bottom: 1px solid #E5E5EA; }
.woocommerce-checkout-review-order-table tr:last-child td, .woocommerce-checkout-review-order-table tr:last-child th { border-bottom: none; font-weight: 700; font-size: 15px; color: #0A2463; }
@media(max-width:1024px){
    .tmg-checkout-layout{grid-template-columns:1fr!important;}
    .tmg-billing-grid, .tmg-shipping-grid{grid-template-columns:1fr!important;}
}
</style>

<?php
// Save personalisation data to order meta
add_action('woocommerce_checkout_order_created', function($order){
    if(!empty($_POST['tmg_engraving']))
        $order->update_meta_data('_tmg_engraving', sanitize_text_field($_POST['tmg_engraving']));
    if(!empty($_POST['tmg_gift_message']))
        $order->update_meta_data('_tmg_gift_message', sanitize_textarea_field($_POST['tmg_gift_message']));
    $order->save();
});
?>
