<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <main id="primary">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package THEMENGIFT
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Google Fonts are imported in brand.css -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    
    <!-- Top Announcement Bar -->
    <div class="tmg-announcement-bar" style="background-color: var(--color-primary); color: var(--color-background); text-align: center; padding: 8px 0; font-size: 0.85rem; font-weight: 500; letter-spacing: 0.5px;">
        FREE SHIPPING above ₹699
    </div>

    <!-- Main Header -->
    <header id="masthead" class="site-header" style="background: var(--color-background); border-bottom: 1px solid var(--color-border); position: sticky; top: 0; z-index: 1000; padding: var(--spacing-md) 0;">
        <div class="tmg-container" style="display: flex; justify-content: space-between; align-items: center;">
            
            <!-- Logo -->
            <div class="site-branding">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" style="display: flex; align-items: center; justify-content: center; width: 140px; height: 70px; overflow: hidden;">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" alt="THEMENGIFT" style="height: 120px; max-width: none; width: auto; display: block;" />
                </a>
            </div>

            <!-- Main Navigation -->
            <nav id="site-navigation" class="main-navigation" style="display: flex; gap: var(--spacing-lg);">
                <a href="/shop" style="font-weight: 500; font-size: 0.95rem;">Jewelry</a>
                <a href="/custom-gifts" style="font-weight: 500; font-size: 0.95rem;">Custom Gifts</a>
                <a href="/smart-tags" style="font-weight: 500; font-size: 0.95rem;">Smart Tags</a>
                <a href="/corporate-gifting" style="font-weight: 500; font-size: 0.95rem;">Corporate</a>
            </nav>

            <!-- Icons (Search, Account, Wishlist, Cart) -->
            <div class="header-icons" style="display: flex; gap: var(--spacing-md); align-items: center;">
                <a href="?s=" title="Search" style="font-size: 1.2rem;">🔍</a>
                <a href="/my-account" title="My Account" style="font-size: 1.2rem;">👤</a>
                <a href="/my-tag/login/" class="header-icon-btn" title="Manage My Smart Tag" style="display: flex; align-items: center; gap: 4px; text-decoration: none;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    <span class="header-icon-label" style="font-size: 0.85rem; font-weight: 600;">My Tag</span>
                </a>
                <a href="/cart" title="Cart" style="font-size: 1.2rem; position: relative;">
                    🛒
                    <span style="position: absolute; top: -5px; right: -8px; background: var(--color-secondary); color: var(--color-primary); font-size: 0.7rem; font-weight: bold; width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                        <?php echo WC()->cart ? WC()->cart->get_cart_contents_count() : '0'; ?>
                    </span>
                </a>
            </div>

        </div>
    </header><!-- #masthead -->
