<?php
/**
 * Template Name: My Account
 * THEMENGIFT — Radiant UI Premium Dashboard
 * Wraps WooCommerce My Account with premium styling
 */
get_header();
?>

<section style="background:#FBFBFD; border-bottom:1px solid #E5E5EA;">
    <div class="tmg-container" style="padding-top:48px; padding-bottom:40px;">
        <div style="display:flex; align-items:center; gap:6px; font-size:13px; color:#86868B; margin-bottom:16px;">
            <a href="/" style="color:#86868B; text-decoration:none;">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            <span style="color:#1D1D1F;">My Account</span>
        </div>
        <?php if(is_user_logged_in()):
            $user = wp_get_current_user();
            $first = $user->first_name ?: $user->display_name;
            $order_count = wc_get_customer_order_count($user->ID);
        ?>
        <div style="display:flex; align-items:center; gap:16px; flex-wrap:wrap;">
            <!-- Avatar -->
            <div style="width:64px; height:64px; border-radius:50%; background:linear-gradient(135deg,#0A2463,#172A45); display:flex; align-items:center; justify-content:center; color:#fff; font-family:'Playfair Display',serif; font-size:24px; font-weight:700; flex-shrink:0;">
                <?php echo strtoupper(substr($first,0,1)); ?>
            </div>
            <div>
                <h1 style="font-family:'Playfair Display',serif; font-size:clamp(1.6rem,3vw,2.2rem); font-weight:700; color:#0A192F; margin:0 0 4px;">
                    Welcome back, <?php echo esc_html($first); ?> 👋
                </h1>
                <p style="color:#86868B; font-size:14px; margin:0;">
                    <?php echo $order_count; ?> order<?php echo $order_count!==1?'s':''; ?> placed · Member since <?php echo date('M Y', strtotime($user->user_registered)); ?>
                </p>
            </div>
        </div>
        <?php else: ?>
        <h1 style="font-family:'Playfair Display',serif; font-size:clamp(1.8rem,3vw,2.4rem); font-weight:700; color:#0A192F; margin:0;">My Account</h1>
        <p style="color:#86868B; margin:8px 0 0;">Login or create an account to track orders and manage your profile.</p>
        <?php endif; ?>
    </div>
</section>

<section style="background:#fff; padding:40px 0 80px;">
    <div class="tmg-container">

        <?php if(is_user_logged_in()): ?>
        <!-- QUICK STAT CARDS -->
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:40px;" class="tmg-dash-stats">
            <?php
            $orders = wc_get_orders(['customer'=>get_current_user_id(),'limit'=>-1,'status'=>['wc-completed','wc-processing','wc-pending']]);
            $completed = array_filter($orders, fn($o)=>$o->get_status()==='completed');
            $total_spent = array_sum(array_map(fn($o)=>$o->get_total(), $orders));
            $stats = [
                ['📦', count($orders),      'Total Orders',    '/my-account/orders/'],
                ['✅', count($completed),   'Completed',       '/my-account/orders/?status=completed'],
                ['💰', '₹'.number_format($total_spent), 'Total Spent', '/my-account/orders/'],
                ['⭐', wc_get_customer_order_count(get_current_user_id()) > 0 ? 'Gold' : 'Silver', 'Member Tier', '/my-account/'],
            ];
            foreach($stats as $s):
            ?>
            <a href="<?php echo esc_url($s[3]); ?>" style="display:block; background:#FBFBFD; border:1.5px solid #E5E5EA; border-radius:16px; padding:20px; text-decoration:none; transition:all 0.3s;"
                onmouseover="this.style.borderColor='#0A2463'; this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='#E5E5EA'; this.style.transform=''">
                <div style="font-size:22px; margin-bottom:8px;"><?php echo $s[0]; ?></div>
                <div style="font-family:'Playfair Display',serif; font-size:22px; font-weight:800; color:#0A2463; margin-bottom:2px;"><?php echo esc_html($s[1]); ?></div>
                <div style="font-size:12px; color:#86868B;"><?php echo esc_html($s[2]); ?></div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- MAIN CONTENT: Nav + Content -->
        <div style="display:grid; grid-template-columns:260px 1fr; gap:32px; align-items:start;" class="tmg-account-layout">

            <!-- SIDEBAR NAV -->
            <nav style="position:sticky; top:110px;">
                <?php
                $nav_items = [
                    'dashboard'       => ['🏠','Dashboard'],
                    'orders'          => ['📦','My Orders'],
                    'downloads'       => ['⬇️','Downloads'],
                    'edit-address'    => ['📍','Addresses'],
                    'edit-account'    => ['👤','Account Details'],
                    'customer-logout' => ['🚪','Logout'],
                ];
                $current_ep = WC()->query->get_current_endpoint();
                foreach($nav_items as $ep => [$icon,$label]):
                    $url = $ep === 'customer-logout' ? wp_logout_url(home_url()) : wc_get_account_endpoint_url($ep);
                    $is_active = $current_ep === $ep || ($ep==='dashboard' && !$current_ep);
                ?>
                <a href="<?php echo esc_url($url); ?>"
                    style="display:flex; align-items:center; gap:10px; padding:12px 16px; border-radius:12px; margin-bottom:4px; font-size:14px; font-weight:600; text-decoration:none; transition:all 0.2s;
                    <?php echo $is_active ? 'background:#0A2463; color:#fff;' : 'color:#1D1D1F; background:transparent;'; ?>"
                    onmouseover="if(!this.classList.contains('active')){ this.style.background='#EEF2FF'; this.style.color='#0A2463'; }"
                    onmouseout="if(!this.classList.contains('active')){ this.style.background='transparent'; this.style.color='#1D1D1F'; }">
                    <span><?php echo $icon; ?></span>
                    <?php echo esc_html($label); ?>
                </a>
                <?php endforeach; ?>

                <!-- Smart Tag shortcut -->
                <div style="margin-top:20px; padding:16px; background:#EEF2FF; border-radius:14px; border:1.5px solid #C7D2FE;">
                    <p style="font-size:12px; font-weight:700; color:#0A2463; margin:0 0 6px;">🔖 Smart Tag Dashboard</p>
                    <p style="font-size:11px; color:#86868B; margin:0 0 10px; line-height:1.5;">Manage your QR tag profiles</p>
                    <a href="/my-tag" style="display:block; text-align:center; background:#0A2463; color:#fff; font-size:12px; font-weight:700; padding:8px; border-radius:8px; text-decoration:none;">Open Dashboard</a>
                </div>
            </nav>

            <!-- WooCommerce Account Content -->
            <div id="tmg-account-content">
                <div class="tmg-woo-account-wrap">
                    <?php
                    // Style the WooCommerce my account content area
                    woocommerce_output_content_wrapper();
                    do_action('woocommerce_account_content');
                    woocommerce_output_content_wrapper_end();
                    ?>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
/* --- Radiant-style WooCommerce My Account overrides --- */
.tmg-woo-account-wrap .woocommerce-MyAccount-content h2 {
    font-family: 'Playfair Display', serif;
    font-size: 1.6rem;
    color: #0A192F;
    margin: 0 0 20px;
}
.tmg-woo-account-wrap table.shop_table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}
.tmg-woo-account-wrap table.shop_table thead th {
    background: #FBFBFD;
    padding: 12px 16px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #86868B;
    border-bottom: 2px solid #E5E5EA;
    text-align: left;
}
.tmg-woo-account-wrap table.shop_table tbody tr td {
    padding: 14px 16px;
    border-bottom: 1px solid #E5E5EA;
    color: #1D1D1F;
    vertical-align: middle;
}
.tmg-woo-account-wrap table.shop_table tbody tr:hover { background: #FBFBFD; }
.tmg-woo-account-wrap .order-status {
    display: inline-flex;
    padding: 3px 10px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.05em;
}
.tmg-woo-account-wrap mark.order-status.status-completed { background: #F0FFF4; color: #276749; }
.tmg-woo-account-wrap mark.order-status.status-processing { background: #EEF2FF; color: #0A2463; }
.tmg-woo-account-wrap mark.order-status.status-pending { background: #FFF8E1; color: #92400E; }
.tmg-woo-account-wrap mark.order-status.status-cancelled { background: #FFF5F5; color: #C53030; }
.tmg-woo-account-wrap .button, .tmg-woo-account-wrap button[type="submit"] {
    background: #0A2463;
    color: #fff;
    border: none;
    padding: 11px 22px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
    letter-spacing: 0.03em;
}
.tmg-woo-account-wrap .button:hover, .tmg-woo-account-wrap button[type="submit"]:hover {
    background: #172A45;
    transform: translateY(-1px);
}
.tmg-woo-account-wrap .woocommerce-MyAccount-content input[type="text"],
.tmg-woo-account-wrap .woocommerce-MyAccount-content input[type="email"],
.tmg-woo-account-wrap .woocommerce-MyAccount-content input[type="password"],
.tmg-woo-account-wrap .woocommerce-MyAccount-content input[type="tel"],
.tmg-woo-account-wrap .woocommerce-MyAccount-content textarea,
.tmg-woo-account-wrap .woocommerce-MyAccount-content select {
    width: 100%;
    padding: 12px 14px;
    border: 1.5px solid #E5E5EA;
    border-radius: 12px;
    font-size: 14px;
    font-family: inherit;
    color: #1D1D1F;
    background: #fff;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    box-sizing: border-box;
}
.tmg-woo-account-wrap .woocommerce-MyAccount-content input:focus,
.tmg-woo-account-wrap .woocommerce-MyAccount-content textarea:focus,
.tmg-woo-account-wrap .woocommerce-MyAccount-content select:focus {
    border-color: #0A2463;
    box-shadow: 0 0 0 3px rgba(10,36,99,0.08);
}
.tmg-woo-account-wrap .woocommerce-MyAccount-content label {
    display: block;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #86868B;
    margin-bottom: 6px;
}
.tmg-woo-account-wrap .woocommerce-form-row { margin-bottom: 18px; }
.tmg-woo-account-wrap .woocommerce-Message,
.tmg-woo-account-wrap .woocommerce-info {
    background: #EEF2FF;
    border-left: 4px solid #0A2463;
    border-radius: 0 12px 12px 0;
    padding: 14px 18px;
    font-size: 14px;
    color: #0A192F;
    margin-bottom: 20px;
}
.tmg-woo-account-wrap .woocommerce-error {
    background: #FFF5F5;
    border-left: 4px solid #E53E3E;
    border-radius: 0 12px 12px 0;
    padding: 14px 18px;
    font-size: 14px;
    color: #C53030;
    margin-bottom: 20px;
    list-style: none;
}
/* Login form on account page */
.tmg-woo-account-wrap .woocommerce-form-login {
    background: #FBFBFD;
    border: 1.5px solid #E5E5EA;
    border-radius: 20px;
    padding: 32px;
    max-width: 480px;
}

@media(max-width:1024px){
    .tmg-account-layout{grid-template-columns:1fr!important;}
    .tmg-dash-stats{grid-template-columns:repeat(2,1fr)!important;}
}
@media(max-width:640px){
    .tmg-dash-stats{grid-template-columns:repeat(2,1fr)!important;}
}
</style>

<?php get_footer(); ?>
