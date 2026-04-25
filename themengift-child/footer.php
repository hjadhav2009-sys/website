<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package THEMENGIFT
 */

?>

    <footer id="colophon" class="site-footer" style="background-color: var(--color-primary); color: var(--color-background); padding: var(--spacing-3xl) 0 var(--spacing-lg);">
        <div class="tmg-container">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--spacing-2xl); margin-bottom: var(--spacing-2xl); border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: var(--spacing-2xl);">
                
                <!-- Brand Info -->
                <div>
                    <h3 style="color: var(--color-secondary); font-family: var(--font-heading); font-size: 1.5rem; margin-bottom: var(--spacing-md);">THEMENGIFT</h3>
                    <p style="opacity: 0.8; font-size: 0.9rem; line-height: 1.6; margin-bottom: var(--spacing-md);">Premium jewelry, custom personalized gifts, and advanced smart tags. Crafted with precision in India.</p>
                    <div style="display: flex; gap: var(--spacing-sm);">
                        <a href="#" style="color: white; opacity: 0.8;">IG</a>
                        <a href="#" style="color: white; opacity: 0.8;">FB</a>
                        <a href="#" style="color: white; opacity: 0.8;">YT</a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 style="color: white; margin-bottom: var(--spacing-md);">Shop</h4>
                    <ul style="list-style: none; padding: 0; margin: 0; opacity: 0.8; line-height: 2;">
                        <li><a href="/shop/mens" style="color: white;">Men's Jewelry</a></li>
                        <li><a href="/shop/womens" style="color: white;">Women's Jewelry</a></li>
                        <li><a href="/custom-gifts" style="color: white;">Custom Gifts</a></li>
                        <li><a href="/smart-tags" style="color: white;">Smart Pet Tags</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 style="color: white; margin-bottom: var(--spacing-md);">Support</h4>
                    <ul style="list-style: none; padding: 0; margin: 0; opacity: 0.8; line-height: 2;">
                        <li><a href="/contact" style="color: white;">Contact Us</a></li>
                        <li><a href="/track-order" style="color: white;">Track Order</a></li>
                        <li><a href="/faqs" style="color: white;">FAQs</a></li>
                        <li><a href="/size-guide" style="color: white;">Size Guide</a></li>
                    </ul>
                </div>

                <!-- Policies -->
                <div>
                    <h4 style="color: white; margin-bottom: var(--spacing-md);">Policies</h4>
                    <ul style="list-style: none; padding: 0; margin: 0; opacity: 0.8; line-height: 2;">
                        <li><a href="/privacy-policy" style="color: white;">Privacy Policy</a></li>
                        <li><a href="/terms" style="color: white;">Terms of Service</a></li>
                        <li><a href="/shipping-policy" style="color: white;">Shipping Policy</a></li>
                        <li><a href="/refund-policy" style="color: white;">Return & Refund</a></li>
                    </ul>
                </div>

            </div>

            <div style="text-align: center; opacity: 0.6; font-size: 0.8rem;">
                <p>&copy; <?php echo date('Y'); ?> THEMENGIFT. All rights reserved.</p>
            </div>
        </div>
    </footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
