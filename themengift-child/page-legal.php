<?php
/**
 * Template Name: Legal & Policy Page
 * Description: Template for all legal pages (Privacy, Terms, Refunds, etc.)
 */

get_header();
?>

<div class="tmg-legal-page" style="background:#FBFBFD; padding:60px 0; min-height:60vh;">
    <div class="tmg-container" style="max-width:800px; margin:0 auto; background:#fff; padding:40px; border-radius:24px; box-shadow:0 4px 20px rgba(0,0,0,0.03); border:1px solid #E5E5EA;">
        
        <?php while ( have_posts() ) : the_post(); ?>

            <header style="text-align:center; margin-bottom:40px; padding-bottom:30px; border-bottom:1px solid #E5E5EA;">
                <p style="font-size:12px; font-weight:700; letter-spacing:0.15em; color:#86868B; text-transform:uppercase; margin:0 0 10px;">Legal & Policies</p>
                <h1 style="font-family:'Playfair Display',serif; font-size:clamp(2rem,4vw,2.5rem); color:#0A192F; margin:0; line-height:1.2;">
                    <?php the_title(); ?>
                </h1>
                <p style="font-size:14px; color:#86868B; margin:15px 0 0;">Last updated: <?php echo get_the_modified_date('F j, Y'); ?></p>
            </header>

            <?php
            // Specific condition for Return and Refund Policy
            if ( is_page('refund-policy') || get_the_title() === 'Return and Refund Policy' ) :
            ?>
                <div style="background:#FFF5F5; border-left:4px solid #E53E3E; padding:20px; border-radius:0 12px 12px 0; margin-bottom:30px;">
                    <h3 style="color:#C53030; font-size:16px; font-weight:700; margin:0 0 8px; display:flex; align-items:center; gap:8px;">
                        ⚠️ Important Notice
                    </h3>
                    <p style="color:#C53030; font-size:14px; margin:0; line-height:1.5; font-weight:500;">
                        Custom, personalised and engraved products cannot be returned unless there is a manufacturing defect. Smart Tag subscription fees are non-refundable after tag activation.
                    </p>
                </div>
            <?php endif; ?>

            <?php
            // Specific condition for Privacy Policy
            if ( is_page('privacy-policy') || get_the_title() === 'Privacy Policy' ) :
            ?>
                <div style="background:#EEF4FF; border-left:4px solid #1B4F9E; padding:20px; border-radius:0 12px 12px 0; margin-bottom:30px;">
                    <h3 style="color:#1B4F9E; font-size:16px; font-weight:700; margin:0 0 8px; display:flex; align-items:center; gap:8px;">
                        📍 Smart Tag Location Data
                    </h3>
                    <p style="color:#1B4F9E; font-size:14px; margin:0; line-height:1.5;">
                        For the operation of the THEMENGIFT Smart Tag system, IP geolocation is captured when a tag is scanned to notify the owner. GPS location is only captured if browser permission is explicitly granted. Location data expires and is deleted from our servers within 24 hours.
                    </p>
                </div>
            <?php endif; ?>

            <div class="tmg-legal-content" style="color:#1D1D1F; font-size:16px; line-height:1.8;">
                <?php the_content(); ?>
            </div>

        <?php endwhile; ?>

    </div>
</div>

<style>
.tmg-legal-content h2 { font-family:'Playfair Display',serif; font-size:24px; color:#0A192F; margin:40px 0 16px; }
.tmg-legal-content h3 { font-size:18px; font-weight:700; color:#0A2463; margin:30px 0 12px; }
.tmg-legal-content p { margin:0 0 20px; }
.tmg-legal-content ul, .tmg-legal-content ol { margin:0 0 20px; padding-left:24px; }
.tmg-legal-content li { margin-bottom:10px; }
.tmg-legal-content a { color:#0A2463; text-decoration:underline; font-weight:600; }
.tmg-legal-content a:hover { color:#1B4F9E; }
</style>

<?php
get_footer();
