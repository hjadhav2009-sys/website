<?php
/**
 * The front page template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package THEMENGIFT
 */

get_header(); ?>

<main id="primary" class="site-main">

    <?php
    // Include the 19 sections of the homepage
    
    // 1. Hero Section
    get_template_part( 'template-parts/homepage/section', 'hero' );
    
    // 2. Category Icons
    get_template_part( 'template-parts/homepage/section', 'category-icons' );
    
    // 3. Shop by Recipient
    get_template_part( 'template-parts/homepage/section', 'shop-by-recipient' );
    
    // 4. Shop by Emotion
    get_template_part( 'template-parts/homepage/section', 'shop-by-emotion' );
    
    // 5. Featured Product
    get_template_part( 'template-parts/homepage/section', 'featured-product' );
    
    // 6. Trending Products (Carousel placeholder)
    get_template_part( 'template-parts/homepage/section', 'trending' );
    
    // 7. Flash Sale
    get_template_part( 'template-parts/homepage/section', 'flash-sale' );
    
    // 8. Smart Tags Promo
    get_template_part( 'template-parts/homepage/section', 'smart-tags' );
    
    // 9. Corporate Gifting Banner
    get_template_part( 'template-parts/homepage/section', 'corporate' );
    
    // 10. Personalisation
    get_template_part( 'template-parts/homepage/section', 'personalisation' );
    
    // 11. By Material
    get_template_part( 'template-parts/homepage/section', 'by-material' );
    
    // 12. By Occasion
    get_template_part( 'template-parts/homepage/section', 'by-occasion' );
    
    // 13. Video/Reel Section
    get_template_part( 'template-parts/homepage/section', 'video' );
    
    // 14. Delivery Highlights
    get_template_part( 'template-parts/homepage/section', 'delivery-highlights' );
    
    // 15. Testimonials
    get_template_part( 'template-parts/homepage/section', 'testimonials' );
    
    // 16. Instagram/Social Proof
    get_template_part( 'template-parts/homepage/section', 'social-proof' );
    
    // 17. Newsletter
    get_template_part( 'template-parts/homepage/section', 'newsletter' );
    
    ?>

</main><!-- #main -->

<?php
get_footer();
