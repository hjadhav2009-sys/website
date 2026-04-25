<?php
/**
 * Template Name: Contact Us
 * THEMENGIFT — Premium Radiant UI Design
 */
get_header();
?>

<!-- HERO -->
<section style="background:#FBFBFD; border-bottom:1px solid #E5E5EA;">
    <div class="tmg-container" style="padding-top:56px; padding-bottom:56px;">
        <div style="display:flex; align-items:center; gap:6px; font-size:13px; color:#86868B; margin-bottom:16px;">
            <a href="/" style="color:#86868B; text-decoration:none;">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            <span style="color:#1D1D1F;">Contact</span>
        </div>
        <h1 style="font-family:'Playfair Display',serif; font-size:clamp(2rem,4vw,3rem); font-weight:700; color:#0A192F; margin:0 0 12px;">We'd love to hear from you</h1>
        <p style="color:#86868B; font-size:16px; max-width:520px; margin:0; line-height:1.7;">
            Order help, custom commissions, corporate gifting — we usually reply within 2 business hours.
        </p>
    </div>
</section>

<!-- CONTACT CARDS -->
<section style="background:#fff; padding:56px 0;">
    <div class="tmg-container">

        <!-- 3 quick contact cards -->
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:48px;" class="tmg-contact-cards">
            <?php
            $contacts = [
                ['💬','WhatsApp',   '+91 98765 43210',       'Fastest reply · usually under 5 min', 'https://wa.me/919876543210?text=Hello+THEMENGIFT!', '#25D366'],
                ['📞','Call us',    '+91 98765 43210',       'Mon–Sat, 10am–7pm IST',               'tel:+919876543210',                                '#0A2463'],
                ['📧','Email us',   'hello@themengift.com',  'Reply in under 2 hours',              'mailto:hello@themengift.com',                       '#0A2463'],
            ];
            foreach($contacts as $c):
            ?>
            <a href="<?php echo esc_url($c[5]); ?>" style="display:block; background:#fff; border:1.5px solid #E5E5EA; border-radius:20px; padding:24px; text-decoration:none; transition:all 0.3s;"
                onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 16px 32px rgba(0,0,0,0.08)'; this.style.borderColor='<?php echo $c[5]; ?>'"
                onmouseout="this.style.transform=''; this.style.boxShadow=''; this.style.borderColor='#E5E5EA'">
                <div style="width:48px; height:48px; border-radius:14px; background:<?php echo esc_attr($c[5]); ?>; display:flex; align-items:center; justify-content:center; font-size:22px; margin-bottom:14px;">
                    <?php echo $c[0]; ?>
                </div>
                <p style="font-size:11px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#86868B; margin:0 0 4px;"><?php echo esc_html($c[1]); ?></p>
                <p style="font-family:'Playfair Display',serif; font-size:17px; font-weight:700; color:#1D1D1F; margin:0 0 4px;"><?php echo esc_html($c[2]); ?></p>
                <p style="font-size:12px; color:#86868B; margin:0;"><?php echo esc_html($c[3]); ?></p>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- Form + Info grid -->
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:start;" class="tmg-form-grid">

            <!-- CONTACT FORM -->
            <div style="background:#FBFBFD; border:1.5px solid #E5E5EA; border-radius:24px; padding:36px;">
                <h2 style="font-family:'Playfair Display',serif; font-size:1.8rem; color:#0A192F; margin:0 0 8px;">Send us a message</h2>
                <p style="font-size:14px; color:#86868B; margin:0 0 28px;">We'll get back to you on email + WhatsApp.</p>

                <?php
                // Use WP AJAX or CF7 here — this pure PHP form as fallback
                if(!empty($_POST['tmg_contact_sent']) && check_admin_referer('tmg_contact_form')):
                ?>
                <div style="background:#F0FFF4; border:1.5px solid #9AE6B4; border-radius:14px; padding:20px; text-align:center; margin-bottom:20px;">
                    <div style="font-size:32px; margin-bottom:8px;">✅</div>
                    <p style="font-weight:700; color:#276749; margin:0;">Message sent! We'll reply within 2 hours.</p>
                </div>
                <?php else: ?>

                <form method="POST" action="" id="tmg-contact-form">
                    <?php wp_nonce_field('tmg_contact_form'); ?>
                    <input type="hidden" name="tmg_contact_sent" value="1">

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px;">
                        <div>
                            <label style="display:block; font-size:11px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#86868B; margin-bottom:6px;">Your name *</label>
                            <input type="text" name="contact_name" required placeholder="Rahul Sharma"
                                style="width:100%; padding:12px 14px; border:1.5px solid #E5E5EA; border-radius:12px; font-size:14px; color:#1D1D1F; background:#fff; outline:none; box-sizing:border-box; transition:border-color 0.2s;"
                                onfocus="this.style.borderColor='#0A2463'; this.style.boxShadow='0 0 0 3px rgba(10,36,99,0.08)'"
                                onblur="this.style.borderColor='#E5E5EA'; this.style.boxShadow=''">
                        </div>
                        <div>
                            <label style="display:block; font-size:11px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#86868B; margin-bottom:6px;">Phone (WhatsApp) *</label>
                            <input type="tel" name="contact_phone" required placeholder="+91 98765 43210"
                                style="width:100%; padding:12px 14px; border:1.5px solid #E5E5EA; border-radius:12px; font-size:14px; color:#1D1D1F; background:#fff; outline:none; box-sizing:border-box; transition:border-color 0.2s;"
                                onfocus="this.style.borderColor='#0A2463'; this.style.boxShadow='0 0 0 3px rgba(10,36,99,0.08)'"
                                onblur="this.style.borderColor='#E5E5EA'; this.style.boxShadow=''">
                        </div>
                    </div>

                    <div style="margin-bottom:14px;">
                        <label style="display:block; font-size:11px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#86868B; margin-bottom:6px;">Email *</label>
                        <input type="email" name="contact_email" required placeholder="rahul@email.com"
                            style="width:100%; padding:12px 14px; border:1.5px solid #E5E5EA; border-radius:12px; font-size:14px; color:#1D1D1F; background:#fff; outline:none; box-sizing:border-box; transition:border-color 0.2s;"
                            onfocus="this.style.borderColor='#0A2463'; this.style.boxShadow='0 0 0 3px rgba(10,36,99,0.08)'"
                            onblur="this.style.borderColor='#E5E5EA'; this.style.boxShadow=''">
                    </div>

                    <div style="margin-bottom:14px;">
                        <label style="display:block; font-size:11px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#86868B; margin-bottom:6px;">What's this about?</label>
                        <select name="contact_subject"
                            style="width:100%; padding:12px 14px; border:1.5px solid #E5E5EA; border-radius:12px; font-size:14px; color:#1D1D1F; background:#fff; outline:none; cursor:pointer;">
                            <option value="">Select a topic...</option>
                            <option value="order">Order help</option>
                            <option value="custom">Custom commission</option>
                            <option value="corporate">Corporate gifting</option>
                            <option value="smart-tag">Smart Tag support</option>
                            <option value="press">Press / collab</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div style="margin-bottom:24px;">
                        <label style="display:block; font-size:11px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#86868B; margin-bottom:6px;">Your message *</label>
                        <textarea name="contact_message" required rows="5" placeholder="Tell us how we can help..."
                            style="width:100%; padding:12px 14px; border:1.5px solid #E5E5EA; border-radius:12px; font-size:14px; color:#1D1D1F; background:#fff; outline:none; resize:vertical; box-sizing:border-box; font-family:inherit; transition:border-color 0.2s;"
                            onfocus="this.style.borderColor='#0A2463'; this.style.boxShadow='0 0 0 3px rgba(10,36,99,0.08)'"
                            onblur="this.style.borderColor='#E5E5EA'; this.style.boxShadow=''"></textarea>
                    </div>

                    <button type="submit" id="tmg-contact-btn"
                        style="display:inline-flex; align-items:center; gap:8px; background:#0A2463; color:#fff; font-weight:700; padding:14px 28px; border-radius:12px; border:none; font-size:15px; cursor:pointer; transition:all 0.2s; letter-spacing:0.03em;"
                        onmouseover="this.style.background='#172A45'; this.style.transform='translateY(-1px)'" onmouseout="this.style.background='#0A2463'; this.style.transform=''">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" x2="11" y1="2" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        Send message
                    </button>
                </form>

                <?php endif; ?>
            </div>

            <!-- RIGHT: MAP + INFO -->
            <div>
                <!-- Google Maps embed placeholder -->
                <div style="border-radius:20px; overflow:hidden; aspect-ratio:4/3; margin-bottom:24px; border:1.5px solid #E5E5EA;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3769.9!2d72.87!3d19.11!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDA2JzM2LjAiTiA3MsKwNTInMTIuMCJF!5e0!3m2!1sen!2sin!4v1617000000000!5m2!1sen!2sin"
                        width="100%" height="100%" style="border:0; display:block;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>

                <!-- Address + Hours -->
                <div style="display:flex; flex-direction:column; gap:16px;">
                    <div style="display:flex; gap:14px; align-items:flex-start;">
                        <div style="width:40px; height:40px; border-radius:10px; background:#EEF2FF; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0;">📍</div>
                        <div>
                            <p style="font-weight:700; font-size:14px; color:#1D1D1F; margin:0 0 4px;">Workshop & HQ</p>
                            <p style="font-size:13px; color:#86868B; margin:0; line-height:1.6;">3rd Floor, Marol Industrial Estate,<br>Andheri East, Mumbai 400069, India</p>
                        </div>
                    </div>
                    <div style="display:flex; gap:14px; align-items:flex-start;">
                        <div style="width:40px; height:40px; border-radius:10px; background:#EEF2FF; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0;">🕐</div>
                        <div>
                            <p style="font-weight:700; font-size:14px; color:#1D1D1F; margin:0 0 4px;">Working Hours</p>
                            <p style="font-size:13px; color:#86868B; margin:0; line-height:1.6;">Mon–Sat, 10:00 AM – 7:00 PM IST<br>Closed on Sundays & national holidays</p>
                        </div>
                    </div>
                    <div style="display:flex; gap:14px; align-items:flex-start;">
                        <div style="width:40px; height:40px; border-radius:10px; background:#EEF2FF; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0;">🚀</div>
                        <div>
                            <p style="font-weight:700; font-size:14px; color:#1D1D1F; margin:0 0 4px;">Average Response</p>
                            <p style="font-size:13px; color:#86868B; margin:0; line-height:1.6;">WhatsApp: under 5 minutes<br>Email: under 2 hours</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- FAQ QUICK -->
<section style="background:#FBFBFD; padding:64px 0; border-top:1px solid #E5E5EA;">
    <div class="tmg-container" style="max-width:700px; margin:0 auto;">
        <div style="text-align:center; margin-bottom:36px;">
            <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.6rem,3vw,2.2rem); color:#0A192F; margin:0;">Quick answers</h2>
        </div>
        <?php
        $faqs = [
            ['How long does personalisation take?','Most personalised orders are ready in 24–48 hours. Delivery takes 2–5 business days depending on your location.'],
            ['Can I track my order?','Yes! You\'ll receive a tracking link via SMS and email as soon as your order ships.'],
            ['Do you accept bulk / corporate orders?','Absolutely. We handle orders from 50 to 50,000 pieces. Contact us with your requirements.'],
            ['What\'s your return policy?','We offer hassle-free returns within 30 days for non-personalised items. For engraved pieces, we\'ll remake them if there\'s a defect.'],
        ];
        foreach($faqs as $faq):
        ?>
        <div style="background:#fff; border-radius:16px; border:1.5px solid #E5E5EA; margin-bottom:10px; overflow:hidden;">
            <button onclick="var a=this.nextElementSibling; a.style.display=a.style.display==='none'?'block':'none'; this.querySelector('.tmg-faq-icon').textContent=a.style.display==='block'?'−':'+';"
                style="width:100%; text-align:left; padding:18px 20px; background:none; border:none; cursor:pointer; display:flex; align-items:center; justify-content:space-between; font-size:15px; font-weight:600; color:#1D1D1F;">
                <?php echo esc_html($faq[0]); ?>
                <span class="tmg-faq-icon" style="font-size:22px; color:#0A2463; font-weight:300; flex-shrink:0; margin-left:12px;">+</span>
            </button>
            <div style="display:none; padding:0 20px 18px; font-size:14px; color:#86868B; line-height:1.7;">
                <?php echo esc_html($faq[1]); ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<style>
@media(max-width:1024px){
    .tmg-form-grid{grid-template-columns:1fr!important;}
    .tmg-contact-cards{grid-template-columns:1fr!important;}
}
@media(max-width:640px){
    .tmg-contact-cards{grid-template-columns:1fr!important;}
}
</style>

<?php get_footer(); ?>
