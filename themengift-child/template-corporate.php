<?php
/**
 * Template Name: Corporate Gifting
 * Description: Custom page template for Corporate & Bulk Gifting enquiry.
 */

// Handle Form Submission
$form_success = false;
$form_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['first_name']) && isset($_POST['email'])) {
        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name  = sanitize_text_field($_POST['last_name']);
        $email      = sanitize_email($_POST['email']);
        $phone      = sanitize_text_field($_POST['phone']);
        $company    = sanitize_text_field($_POST['company']);
        $quantity   = sanitize_text_field($_POST['quantity']);
        $occasion   = sanitize_text_field($_POST['occasion']);
        $details    = sanitize_textarea_field($_POST['details']);

        // Send Email to Admin
        $to = get_option('admin_email');
        $subject = 'New Corporate Gifting Enquiry from ' . $company;
        $message = "Name: $first_name $last_name\nEmail: $email\nPhone: $phone\nCompany: $company\nQuantity: $quantity\nOccasion: $occasion\nDetails: $details";
        
        if (wp_mail($to, $subject, $message)) {
            $form_success = true;
        } else {
            $form_error = "There was an issue sending your enquiry. Please try again.";
        }
    }
}

get_header(); ?>

<main id="primary" class="site-main" style="background-color: var(--color-surface); padding-top: var(--spacing-2xl); padding-bottom: var(--spacing-3xl);">
    <div class="tmg-container">
        
        <div style="text-align: center; margin-bottom: var(--spacing-3xl); max-width: 800px; margin-left: auto; margin-right: auto;">
            <h1 style="font-size: 3rem; color: var(--color-primary); margin-bottom: var(--spacing-md);">Corporate & Bulk Gifting</h1>
            <p style="font-size: 1.2rem; color: var(--color-text-muted); line-height: 1.6;">
                Elevate your brand with premium, custom-branded jewelry and smart tags. Perfect for client appreciation, employee onboarding, festivals, and event giveaways.
            </p>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: var(--spacing-3xl); background: var(--color-background); border-radius: var(--radius-lg); box-shadow: var(--shadow-lg); overflow: hidden;">
            
            <!-- Left Side: Features -->
            <div style="flex: 1; min-width: 300px; background: var(--color-primary); color: var(--color-background); padding: var(--spacing-3xl);">
                <h3 style="color: var(--color-secondary); font-size: 1.8rem; margin-bottom: var(--spacing-xl);">Why Choose THEMENGIFT?</h3>
                
                <div style="margin-bottom: var(--spacing-lg);">
                    <h4 style="color: white; font-size: 1.2rem; margin-bottom: var(--spacing-xs);">✨ Custom Engraving</h4>
                    <p style="opacity: 0.8; font-size: 0.95rem;">Add your company logo or employee names to any of our jewelry pieces or tags.</p>
                </div>
                
                <div style="margin-bottom: var(--spacing-lg);">
                    <h4 style="color: white; font-size: 1.2rem; margin-bottom: var(--spacing-xs);">🎁 Premium Packaging</h4>
                    <p style="opacity: 0.8; font-size: 0.95rem;">Every order comes in luxury, brand-ready boxes.</p>
                </div>

                <div style="margin-bottom: var(--spacing-lg);">
                    <h4 style="color: white; font-size: 1.2rem; margin-bottom: var(--spacing-xs);">📈 Bulk Pricing</h4>
                    <p style="opacity: 0.8; font-size: 0.95rem;">Exclusive tiered discounts for orders over 25 pieces.</p>
                </div>
                
                <div style="margin-bottom: var(--spacing-lg);">
                    <h4 style="color: white; font-size: 1.2rem; margin-bottom: var(--spacing-xs);">🏢 Dedicated Manager</h4>
                    <p style="opacity: 0.8; font-size: 0.95rem;">One point of contact to handle your order from design to delivery.</p>
                </div>
            </div>

            <!-- Right Side: Enquiry Form -->
            <div style="flex: 1.5; min-width: 300px; padding: var(--spacing-3xl);">
                <h3 style="font-size: 1.8rem; color: var(--color-text-main); margin-bottom: var(--spacing-lg);">Request a Quote</h3>
                
                <?php if ($form_success): ?>
                    <div style="background: var(--color-success); color: white; padding: var(--spacing-md); border-radius: var(--radius-sm); margin-bottom: var(--spacing-lg);">
                        Thank you! Your enquiry has been received. Our team will contact you shortly.
                    </div>
                <?php endif; ?>
                
                <?php if ($form_error): ?>
                    <div style="background: var(--color-danger); color: white; padding: var(--spacing-md); border-radius: var(--radius-sm); margin-bottom: var(--spacing-lg);">
                        <?php echo $form_error; ?>
                    </div>
                <?php endif; ?>
                
                <form class="tmg-corporate-form" action="" method="POST">
                    
                    <div style="display: flex; gap: var(--spacing-md); margin-bottom: var(--spacing-md);">
                        <div style="flex: 1;">
                            <label style="display: block; margin-bottom: var(--spacing-xs); color: var(--color-text-muted);">First Name *</label>
                            <input type="text" name="first_name" required style="width: 100%; padding: 12px; border: 1px solid var(--color-border); border-radius: var(--radius-sm);">
                        </div>
                        <div style="flex: 1;">
                            <label style="display: block; margin-bottom: var(--spacing-xs); color: var(--color-text-muted);">Last Name *</label>
                            <input type="text" name="last_name" required style="width: 100%; padding: 12px; border: 1px solid var(--color-border); border-radius: var(--radius-sm);">
                        </div>
                    </div>

                    <div style="display: flex; gap: var(--spacing-md); margin-bottom: var(--spacing-md);">
                        <div style="flex: 1;">
                            <label style="display: block; margin-bottom: var(--spacing-xs); color: var(--color-text-muted);">Work Email *</label>
                            <input type="email" name="email" required style="width: 100%; padding: 12px; border: 1px solid var(--color-border); border-radius: var(--radius-sm);">
                        </div>
                        <div style="flex: 1;">
                            <label style="display: block; margin-bottom: var(--spacing-xs); color: var(--color-text-muted);">Phone Number *</label>
                            <input type="tel" name="phone" required style="width: 100%; padding: 12px; border: 1px solid var(--color-border); border-radius: var(--radius-sm);">
                        </div>
                    </div>

                    <div style="margin-bottom: var(--spacing-md);">
                        <label style="display: block; margin-bottom: var(--spacing-xs); color: var(--color-text-muted);">Company Name *</label>
                        <input type="text" name="company" required style="width: 100%; padding: 12px; border: 1px solid var(--color-border); border-radius: var(--radius-sm);">
                    </div>

                    <div style="display: flex; gap: var(--spacing-md); margin-bottom: var(--spacing-md);">
                        <div style="flex: 1;">
                            <label style="display: block; margin-bottom: var(--spacing-xs); color: var(--color-text-muted);">Estimated Quantity *</label>
                            <select name="quantity" required style="width: 100%; padding: 12px; border: 1px solid var(--color-border); border-radius: var(--radius-sm); background: white;">
                                <option value="">Select quantity</option>
                                <option value="25-50">25 - 50</option>
                                <option value="51-100">51 - 100</option>
                                <option value="101-500">101 - 500</option>
                                <option value="500+">500+</option>
                            </select>
                        </div>
                        <div style="flex: 1;">
                            <label style="display: block; margin-bottom: var(--spacing-xs); color: var(--color-text-muted);">Occasion</label>
                            <select name="occasion" style="width: 100%; padding: 12px; border: 1px solid var(--color-border); border-radius: var(--radius-sm); background: white;">
                                <option value="">Select occasion</option>
                                <option value="diwali">Diwali / Festival</option>
                                <option value="onboarding">Employee Onboarding</option>
                                <option value="client">Client Appreciation</option>
                                <option value="event">Event / Conference</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div style="margin-bottom: var(--spacing-xl);">
                        <label style="display: block; margin-bottom: var(--spacing-xs); color: var(--color-text-muted);">Additional Details</label>
                        <textarea name="details" rows="4" style="width: 100%; padding: 12px; border: 1px solid var(--color-border); border-radius: var(--radius-sm); resize: vertical;"></textarea>
                    </div>

                    <button type="submit" class="tmg-btn tmg-btn-primary" style="width: 100%; font-size: 1.1rem; padding: 16px;">Submit Enquiry</button>
                    
                </form>

            </div>
        </div>

    </div>
</main>

<?php get_footer(); ?>
