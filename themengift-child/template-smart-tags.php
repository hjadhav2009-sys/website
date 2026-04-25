<?php
/**
 * Template Name: Smart Tags Page
 * THEMENGIFT — Premium Radiant UI Design
 */
get_header();

$hero_img = get_theme_mod('tmg_smart_tag_img', get_stylesheet_directory_uri().'/assets/images/smart-tag.jpg');
?>

<!-- HERO (full-bleed with image overlay) -->
<section style="position:relative; overflow:hidden; background:#0A2463; color:#fff; min-height:520px; display:flex; align-items:center;">
    <img src="<?php echo esc_url($hero_img); ?>" alt="Smart Tag"
        style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; opacity:0.22;">
    <div style="position:absolute; inset:0; background:linear-gradient(135deg,rgba(10,36,99,0.9),rgba(23,42,69,0.75));"></div>
    <div class="tmg-container" style="position:relative; padding-top:64px; padding-bottom:64px;">
        <!-- Breadcrumb -->
        <div style="display:flex; align-items:center; gap:6px; font-size:13px; color:rgba(255,255,255,0.6); margin-bottom:16px;">
            <a href="/" style="color:rgba(255,255,255,0.6); text-decoration:none;">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            <span style="color:#fff;">Smart Tags</span>
        </div>
        <!-- Badge -->
        <span style="display:inline-flex; align-items:center; gap:6px; background:rgba(255,255,255,0.12); backdrop-filter:blur(6px); border:1px solid rgba(255,255,255,0.2); color:#fff; font-size:11px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; padding:6px 14px; border-radius:999px; margin-bottom:20px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="5" height="5" x="3" y="3" rx="1"/><rect width="5" height="5" x="16" y="3" rx="1"/><rect width="5" height="5" x="3" y="16" rx="1"/><path d="M21 16h-3a2 2 0 0 0-2 2v3"/><path d="M21 21v.01"/><path d="M12 7v3a2 2 0 0 1-2 2H7"/><path d="M3 12h.01"/><path d="M12 3h.01"/><path d="M12 16v.01"/><path d="M16 12h1"/><path d="M21 12v.01"/><path d="M12 21v-1"/></svg>
            India's most advanced QR Tags
        </span>
        <h1 style="font-family:'Playfair Display',serif; font-size:clamp(2.2rem,5vw,3.8rem); font-weight:700; color:#fff; margin:0 0 16px; line-height:1.1; max-width:680px;">
            Smart Tags for everything <em style="font-style:italic;">you love</em>
        </h1>
        <p style="color:rgba(255,255,255,0.8); font-size:1.1rem; max-width:500px; margin:0 0 28px; line-height:1.7;">
            Engraved QR tags that link to a private, editable profile. When someone scans, you get an instant alert with their location.
        </p>
        <div style="display:flex; flex-wrap:wrap; gap:12px;">
            <a href="#types" style="display:inline-flex; align-items:center; gap:8px; background:#fff; color:#0A2463; font-weight:700; padding:14px 28px; border-radius:12px; text-decoration:none; box-shadow:0 8px 24px rgba(0,0,0,0.2); transition:all 0.2s;"
                onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform=''">
                Choose your tag
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
            <a href="#how" style="display:inline-flex; align-items:center; border:2px solid rgba(255,255,255,0.6); color:#fff; font-weight:700; padding:14px 28px; border-radius:12px; text-decoration:none; transition:all 0.2s;"
                onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='transparent'">
                How it works
            </a>
        </div>
        <!-- Stats bar -->
        <div style="display:flex; flex-wrap:wrap; gap:32px; margin-top:36px; font-size:13px; color:rgba(255,255,255,0.7);">
            <span><strong style="color:#D4AF37; font-size:20px; display:block;">50,000+</strong>Tags activated</span>
            <span><strong style="color:#D4AF37; font-size:20px; display:block;">6 types</strong>For every need</span>
            <span><strong style="color:#D4AF37; font-size:20px; display:block;">Lifetime</strong>Free profile updates</span>
            <span><strong style="color:#D4AF37; font-size:20px; display:block;">24 hrs</strong>Ships next day</span>
        </div>
    </div>
</section>

<!-- TAG TYPES -->
<section id="types" style="background:#fff; padding:64px 0;">
    <div class="tmg-container">
        <div style="margin-bottom:36px;">
            <p style="font-size:11px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#86868B; margin:0 0 10px;">TAG TYPES</p>
            <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.8rem,3vw,2.4rem); color:#0A192F; margin:0;">One platform. Six smart tags.</h2>
        </div>
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px;" class="tmg-tags-grid">
            <?php
            $tag_types = [
                ['🐾','Pet Tags',       'Engraved aluminium tags with QR + instant lost alerts.',  '₹599', get_stylesheet_directory_uri().'/assets/images/smart-tag.jpg'],
                ['✈️','Travel Tags',    'Luggage tags with secure traveller profile.',               '₹499', get_stylesheet_directory_uri().'/assets/images/travel-tag.jpg'],
                ['🚗','Vehicle Tags',   'Discreet QR sticker for cars, bikes & EVs.',               '₹449', get_stylesheet_directory_uri().'/assets/images/vehicle-tag.jpg'],
                ['👧','Kids Safety',    'Wristbands & clip-on tags for outings.',                   '₹549', get_stylesheet_directory_uri().'/assets/images/kids-tag.jpg'],
                ['🏥','Medical Tags',   'Allergies, blood group, emergency contact — always ready.','₹699', get_stylesheet_directory_uri().'/assets/images/medical-tag.jpg'],
                ['💼','Corporate',      'Branded tags for employee laptops, bags & assets.',        null,    get_stylesheet_directory_uri().'/assets/images/corp-1.jpg'],
            ];
            foreach($tag_types as $t):
            ?>
            <div style="background:#fff; border-radius:20px; border:1.5px solid #E5E5EA; overflow:hidden; transition:all 0.3s;"
                onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.08)'; this.style.borderColor='#0A2463'"
                onmouseout="this.style.transform=''; this.style.boxShadow=''; this.style.borderColor='#E5E5EA'">
                <div style="aspect-ratio:4/3; background:#FBFBFD; overflow:hidden;">
                    <img src="<?php echo esc_url($t[4]); ?>" alt="<?php echo esc_attr($t[1]); ?>" loading="lazy"
                        style="width:100%; height:100%; object-fit:cover; transition:transform 0.5s;"
                        onmouseover="this.style.transform='scale(1.06)'" onmouseout="this.style.transform=''">
                </div>
                <div style="padding:20px;">
                    <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px;">
                        <div style="width:38px; height:38px; border-radius:10px; background:#EEF2FF; display:flex; align-items:center; justify-content:center; font-size:18px;">
                            <?php echo $t[0]; ?>
                        </div>
                        <h3 style="font-family:'Playfair Display',serif; font-size:17px; color:#0A192F; margin:0;"><?php echo esc_html($t[1]); ?></h3>
                    </div>
                    <p style="font-size:13px; color:#86868B; margin:0 0 16px; line-height:1.5;"><?php echo esc_html($t[2]); ?></p>
                    <div style="display:flex; align-items:center; justify-content:space-between;">
                        <?php if($t[3]): ?>
                        <span style="font-size:17px; font-weight:700; color:#0A2463;">From <?php echo esc_html($t[3]); ?></span>
                        <?php else: ?>
                        <span style="font-size:14px; font-weight:600; color:#0A2463;">Custom pricing</span>
                        <?php endif; ?>
                        <a href="/shop" style="font-size:13px; font-weight:600; color:#0A2463; text-decoration:none; display:inline-flex; align-items:center; gap:4px; transition:gap 0.2s;"
                            onmouseover="this.style.gap='8px'" onmouseout="this.style.gap='4px'">
                            Buy
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section id="how" style="background:#FBFBFD; padding:64px 0; border-top:1px solid #E5E5EA;">
    <div class="tmg-container" style="display:grid; grid-template-columns:1fr 1fr; gap:56px; align-items:center;" class="tmg-how-grid">
        <!-- Left -->
        <div>
            <p style="font-size:11px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#86868B; margin:0 0 10px;">HOW IT WORKS</p>
            <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.8rem,3vw,2.4rem); color:#0A192F; margin:0 0 28px;">From order to peace of mind in 3 days</h2>
            <ol style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:20px;">
                <?php
                $steps = [
                    "Order your tag and we engrave the unique QR + your custom design.",
                    "Scan it once with your phone to claim and set up your private profile.",
                    "Anyone who finds your pet/luggage scans the tag — you're notified instantly with their GPS location.",
                ];
                foreach($steps as $i => $step):
                ?>
                <li style="display:flex; align-items:flex-start; gap:16px;">
                    <div style="width:36px; height:36px; border-radius:50%; background:linear-gradient(135deg,#0A2463,#172A45); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:14px; flex-shrink:0; margin-top:2px;">
                        <?php echo $i+1; ?>
                    </div>
                    <p style="font-size:15px; color:#1D1D1F; margin:0; line-height:1.6;"><?php echo esc_html($step); ?></p>
                </li>
                <?php endforeach; ?>
            </ol>
            <a href="#types" style="display:inline-flex; align-items:center; gap:8px; background:#0A2463; color:#fff; font-weight:700; padding:14px 28px; border-radius:12px; text-decoration:none; margin-top:28px; transition:all 0.2s;"
                onmouseover="this.style.background='#172A45'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#0A2463'; this.style.transform=''">
                Order now →
            </a>
        </div>
        <!-- Right: features grid -->
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px;">
            <?php
            $features = [
                ['📡','Unique QR per tag',  'Every tag has a one-of-a-kind code linked to a private profile.'],
                ['✏️','Edit anytime',       'Update phone or photo from your dashboard. Free, forever.'],
                ['🔔','Instant alerts',     'SMS + WhatsApp + email notification the moment your tag is scanned.'],
                ['📍','GPS-precise',        'Scan location is geo-stamped so you know exactly where to go.'],
                ['🔒','Privacy-first',      'Show only what you want — owner-only, finder-only or public.'],
                ['🔧','Re-engraving free',  'Need a change? We\'ll re-engrave once a year, on us.'],
            ];
            foreach($features as $f):
            ?>
            <div style="background:#fff; border-radius:16px; padding:18px; border:1.5px solid #E5E5EA;">
                <div style="font-size:22px; margin-bottom:8px;"><?php echo $f[0]; ?></div>
                <h4 style="font-size:13px; font-weight:700; color:#0A192F; margin:0 0 4px;"><?php echo esc_html($f[1]); ?></h4>
                <p style="font-size:12px; color:#86868B; margin:0; line-height:1.5;"><?php echo esc_html($f[2]); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- PRICING PLANS -->
<section style="background:#fff; padding:64px 0; border-top:1px solid #E5E5EA;">
    <div class="tmg-container">
        <div style="text-align:center; margin-bottom:48px;">
            <p style="font-size:11px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#86868B; margin:0 0 10px;">PLANS & PRICING</p>
            <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.8rem,3vw,2.4rem); color:#0A192F; margin:0;">Simple, lifetime plans</h2>
            <p style="color:#86868B; margin:8px 0 0; font-size:15px;">No subscriptions. No monthly fees. Pay once, own forever.</p>
        </div>
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px; max-width:900px; margin:0 auto;" class="tmg-plans-grid">
            <?php
            $plans = [
                ['Lite',   '₹499',  'Best for travel & vehicle', false, ['1 smart tag','Lifetime profile','Up to 100 scans/yr','Email alerts only']],
                ['Pro',    '₹999',  'Most popular — pets & kids', true,  ['1 smart tag','Lifetime profile','Unlimited scans','SMS + WhatsApp + email','GPS scan map']],
                ['Family', '₹1,999','For 4+ members & pets',     false, ['4 smart tags','Shared dashboard','Unlimited scans','Priority support','Free re-engraving']],
            ];
            foreach($plans as $p):
                $popular = $p[3];
            ?>
            <div style="border-radius:20px; padding:28px; border:<?php echo $popular?'2px solid #0A2463':'1.5px solid #E5E5EA'; ?>; background:<?php echo $popular?'#EEF2FF':'#fff'; ?>; position:relative; transition:all 0.3s;"
                onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.08)'"
                onmouseout="this.style.transform=''; this.style.boxShadow=''">
                <?php if($popular): ?>
                <span style="position:absolute; top:-13px; left:50%; transform:translateX(-50%); background:#0A2463; color:#fff; font-size:10px; font-weight:700; letter-spacing:0.15em; padding:4px 14px; border-radius:999px; white-space:nowrap;">
                    MOST POPULAR
                </span>
                <?php endif; ?>
                <h3 style="font-family:'Playfair Display',serif; font-size:22px; color:#0A192F; margin:0 0 4px;"><?php echo esc_html($p[0]); ?></h3>
                <p style="font-size:12px; color:#86868B; margin:0 0 16px;"><?php echo esc_html($p[2]); ?></p>
                <div style="margin-bottom:20px;">
                    <span style="font-family:'Playfair Display',serif; font-size:36px; font-weight:800; color:#0A2463;"><?php echo esc_html($p[1]); ?></span>
                    <span style="font-size:13px; color:#86868B;"> / one-time</span>
                </div>
                <ul style="list-style:none; padding:0; margin:0 0 24px; display:flex; flex-direction:column; gap:8px;">
                    <?php foreach($p[4] as $feat): ?>
                    <li style="display:flex; align-items:flex-start; gap:8px; font-size:14px; color:#1D1D1F;">
                        <div style="width:18px; height:18px; border-radius:50%; background:#0A2463; color:#fff; display:flex; align-items:center; justify-content:center; font-size:10px; font-weight:700; flex-shrink:0; margin-top:1px;">✓</div>
                        <?php echo esc_html($feat); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <a href="/shop" style="display:block; text-align:center; padding:12px; border-radius:10px; font-weight:700; font-size:14px; text-decoration:none; transition:all 0.2s;
                    <?php echo $popular ? 'background:#0A2463; color:#fff;' : 'border:2px solid #0A2463; color:#0A2463;'; ?>"
                    onmouseover="this.style.background='<?php echo $popular?'#172A45':'#0A2463'; ?>'; this.style.color='#fff';"
                    onmouseout="this.style.background='<?php echo $popular?'#0A2463':'transparent'; ?>'; this.style.color='<?php echo $popular?'#fff':'#0A2463'; ?>';">
                    Get <?php echo esc_html($p[0]); ?>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <p style="text-align:center; font-size:13px; color:#86868B; margin-top:24px;">
            Need more than 10 tags? <a href="/contact" style="color:#0A2463; font-weight:600;">Contact us for bulk corporate pricing →</a>
        </p>
    </div>
</section>

<!-- FAQ -->
<section style="background:#FBFBFD; padding:64px 0; border-top:1px solid #E5E5EA;">
    <div class="tmg-container" style="max-width:760px; margin:0 auto;">
        <div style="text-align:center; margin-bottom:40px;">
            <p style="font-size:11px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#86868B; margin:0 0 10px;">FAQ</p>
            <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.8rem,3vw,2.4rem); color:#0A192F; margin:0;">Got questions?</h2>
        </div>
        <?php
        $faqs = [
            ['Do I need an app to use Smart Tags?',   'No app needed! Anyone with a smartphone camera can scan your tag and see your profile instantly.'],
            ['Can I update my profile info later?',   'Yes — log in to your dashboard anytime and update your name, photo, phone number or pet details. Changes go live immediately.'],
            ['What if my tag gets scratched?',        'Our tags are made from anodised aluminium — highly scratch and water resistant. The QR code stays legible for years.'],
            ['How do lost-found alerts work?',        'When a finder scans your tag, you receive an instant SMS, WhatsApp message and email with their location and a link to connect.'],
            ['Can I use one account for multiple tags?', 'Yes — the Family plan supports up to 4 tags under one dashboard. Corporate plans support unlimited tags.'],
        ];
        foreach($faqs as $i => $faq):
        ?>
        <div style="background:#fff; border-radius:16px; border:1.5px solid #E5E5EA; margin-bottom:12px; overflow:hidden;">
            <button onclick="var a=this.nextElementSibling; a.style.display=a.style.display==='none'?'block':'none'; this.querySelector('span').textContent=a.style.display==='block'?'−':'+';"
                style="width:100%; text-align:left; padding:18px 20px; background:none; border:none; cursor:pointer; display:flex; align-items:center; justify-content:space-between; font-size:15px; font-weight:600; color:#1D1D1F;">
                <?php echo esc_html($faq[0]); ?>
                <span style="font-size:20px; color:#0A2463; font-weight:400; transition:transform 0.2s;">+</span>
            </button>
            <div style="display:none; padding:0 20px 18px; font-size:14px; color:#86868B; line-height:1.7;">
                <?php echo esc_html($faq[1]); ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- CTA BANNER -->
<section style="background:linear-gradient(135deg,#0A2463,#172A45); padding:64px 0; text-align:center; color:#fff;">
    <div class="tmg-container">
        <span style="font-size:40px; display:block; margin-bottom:16px;">📡</span>
        <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.8rem,3vw,2.8rem); color:#fff; margin:0 0 12px;">Keep what you love, safe</h2>
        <p style="color:rgba(255,255,255,0.75); font-size:16px; max-width:480px; margin:0 auto 28px; line-height:1.7;">
            Join 50,000+ pet owners, travellers and families who trust TheMenGift Smart Tags every day.
        </p>
        <a href="#types" style="display:inline-flex; align-items:center; gap:8px; background:#D4AF37; color:#0A2463; font-weight:700; padding:14px 32px; border-radius:12px; text-decoration:none; font-size:16px; transition:all 0.2s; box-shadow:0 8px 24px rgba(212,175,55,0.3);"
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 32px rgba(212,175,55,0.4)'"
            onmouseout="this.style.transform=''; this.style.boxShadow='0 8px 24px rgba(212,175,55,0.3)'">
            Order your Smart Tag
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        </a>
    </div>
</section>

<style>
@media(max-width:1024px){
    .tmg-tags-grid{grid-template-columns:repeat(2,1fr)!important;}
    .tmg-how-grid{grid-template-columns:1fr!important;}
    .tmg-plans-grid{grid-template-columns:1fr!important;}
}
@media(max-width:640px){
    .tmg-tags-grid{grid-template-columns:1fr!important;}
}
</style>

<?php get_footer(); ?>
