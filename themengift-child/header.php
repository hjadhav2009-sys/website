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
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    
    <!-- Top Announcement Bar -->
    <div class="tmg-announcement-bar" style="background-color: var(--color-primary); color: var(--color-background); text-align: center; padding: 8px 0; font-size: 0.85rem; font-weight: 500; letter-spacing: 0.5px;">
        Free Shipping on all orders above ₹999 | COD Available
    </div>

    <!-- Main Header -->
    <header id="masthead" class="site-header" style="background: var(--color-background); border-bottom: 1px solid var(--color-border); position: sticky; top: 0; z-index: 1000; padding: var(--spacing-md) 0;">
        <div class="tmg-container" style="display: flex; justify-content: space-between; align-items: center;">
            
            <!-- Logo -->
            <div class="site-branding">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" style="font-family: var(--font-heading); font-size: 1.8rem; font-weight: 700; color: var(--color-primary); text-transform: uppercase; letter-spacing: 2px;">
                    THEMENGIFT
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
                <a href="/cart" title="Cart" style="font-size: 1.2rem; position: relative;">
                    🛒
                    <span style="position: absolute; top: -5px; right: -8px; background: var(--color-secondary); color: var(--color-primary); font-size: 0.7rem; font-weight: bold; width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                        <?php echo WC()->cart ? WC()->cart->get_cart_contents_count() : '0'; ?>
                    </span>
                </a>
            </div>

        </div>
    </header><!-- #masthead -->
