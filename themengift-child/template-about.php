<?php
/**
 * Template Name: About Us
 * THEMENGIFT — Premium Radiant UI Design
 */
get_header();
$team_img     = get_stylesheet_directory_uri().'/assets/images/team.jpg';
$workshop_img = get_stylesheet_directory_uri().'/assets/images/workshop.jpg';
?>

<!-- HERO -->
<section style="background:linear-gradient(135deg,#0A2463 0%,#172A45 100%); color:#fff;">
    <div class="tmg-container" style="padding-top:64px; padding-bottom:64px; max-width:820px;">
        <div style="display:flex; align-items:center; gap:6px; font-size:13px; color:rgba(255,255,255,0.6); margin-bottom:16px;">
            <a href="/" style="color:rgba(255,255,255,0.6); text-decoration:none;">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            <span style="color:#fff;">About</span>
        </div>
        <h1 style="font-family:'Playfair Display',serif; font-size:clamp(2.2rem,5vw,3.8rem); font-weight:700; color:#fff; margin:0 0 20px; line-height:1.1;">
            We craft objects that <em style="font-style:italic;">remember</em> for you
        </h1>
        <p style="color:rgba(255,255,255,0.8); font-size:1.15rem; max-width:640px; margin:0; line-height:1.8;">
            THEMENGIFT was born from a simple belief — that the best gifts aren't the most expensive ones, they're the ones with a story behind them. Every piece we make is designed to hold a memory, a name, a moment.
        </p>
    </div>
</section>

<!-- STATS STRIP -->
<section style="background:#fff; border-bottom:1px solid #E5E5EA; padding:36px 0;">
    <div class="tmg-container">
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:24px; text-align:center;" class="tmg-stats-grid">
            <?php
            $stats = [
                ['1.2M+',  'Gifts shipped'],
                ['30+',    'Cities served'],
                ['50,000+','Happy customers'],
                ['500+',   'Brand partners'],
            ];
            foreach($stats as $s):
            ?>
            <div>
                <div style="font-family:'Playfair Display',serif; font-size:2rem; font-weight:800; color:#0A2463; margin-bottom:4px;"><?php echo esc_html($s[0]); ?></div>
                <div style="font-size:13px; color:#86868B;"><?php echo esc_html($s[1]); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- OUR STORY -->
<section style="background:#fff; padding:72px 0;">
    <div class="tmg-container" style="display:grid; grid-template-columns:1fr 1fr; gap:56px; align-items:center;" class="tmg-story-grid">
        <div style="border-radius:24px; overflow:hidden; aspect-ratio:4/3; box-shadow:0 24px 48px rgba(0,0,0,0.1);">
            <img src="<?php echo esc_url($team_img); ?>" alt="Our team" style="width:100%; height:100%; object-fit:cover;">
        </div>
        <div>
            <p style="font-size:11px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#86868B; margin:0 0 12px;">OUR STORY</p>
            <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.8rem,3vw,2.4rem); color:#0A192F; margin:0 0 20px;">From a tiny Mumbai studio to 30+ cities</h2>
            <p style="color:#86868B; line-height:1.8; margin:0 0 16px; font-size:15px;">
                Founded in 2021 by two siblings who couldn't find a good engraved gift for their parents' 30th anniversary, we set out to build the gifting brand we wished existed — premium, affordable, and deeply personal.
            </p>
            <p style="color:#86868B; line-height:1.8; margin:0 0 28px; font-size:15px;">
                Today we've shipped over 1.2 million gifts to 30+ cities, expanded into smart tags, and partnered with 500+ brands for corporate gifting. Every piece is still made by hand in our Mumbai workshop.
            </p>
            <div style="display:flex; flex-wrap:wrap; gap:10px;">
                <?php foreach(['Founded 2021','Mumbai-based','Made in India','BIS Hallmarked'] as $badge): ?>
                <span style="background:#EEF2FF; color:#0A2463; font-size:13px; font-weight:600; padding:6px 14px; border-radius:999px;"><?php echo esc_html($badge); ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- OUR PROMISES -->
<section style="background:#FBFBFD; padding:72px 0; border-top:1px solid #E5E5EA;">
    <div class="tmg-container">
        <div style="text-align:center; margin-bottom:48px;">
            <p style="font-size:11px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#86868B; margin:0 0 10px;">WHAT WE STAND FOR</p>
            <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.8rem,3vw,2.4rem); color:#0A192F; margin:0;">Our promises</h2>
        </div>
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px;" class="tmg-promises-grid">
            <?php
            $promises = [
                ['💛','Made with care',   'Every piece hand-finished. No mass production, ever.'],
                ['✨','Built to last',    'Tarnish-free finishes. Lifetime re-engraving included.'],
                ['💰','Honest pricing',  'Direct-to-you. No middlemen, no surprise markups.'],
                ['🇮🇳','Made in India',  'Local artisans, fair wages, sustainable packaging.'],
            ];
            foreach($promises as $p):
            ?>
            <div style="background:#fff; border-radius:20px; padding:28px; border:1.5px solid #E5E5EA; transition:all 0.3s;"
                onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 16px 32px rgba(0,0,0,0.07)'"
                onmouseout="this.style.transform=''; this.style.boxShadow=''">
                <div style="width:48px; height:48px; border-radius:14px; background:linear-gradient(135deg,#0A2463,#172A45); display:flex; align-items:center; justify-content:center; font-size:22px; margin-bottom:16px;">
                    <?php echo $p[0]; ?>
                </div>
                <h3 style="font-family:'Playfair Display',serif; font-size:17px; color:#0A192F; margin:0 0 8px;"><?php echo esc_html($p[1]); ?></h3>
                <p style="font-size:13px; color:#86868B; margin:0; line-height:1.6;"><?php echo esc_html($p[2]); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- THE WORKSHOP -->
<section style="background:#fff; padding:72px 0; border-top:1px solid #E5E5EA;">
    <div class="tmg-container" style="display:grid; grid-template-columns:1fr 1fr; gap:56px; align-items:center;" class="tmg-workshop-grid">
        <div>
            <p style="font-size:11px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#86868B; margin:0 0 12px;">THE WORKSHOP</p>
            <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.8rem,3vw,2.4rem); color:#0A192F; margin:0 0 16px;">Hand-crafted, every single day</h2>
            <p style="color:#86868B; line-height:1.8; margin:0 0 24px; font-size:15px;">
                Our 40-person team in Andheri, Mumbai — jewellers, engravers, packaging artists and customer support — make every order to spec. Most pieces ship within 24–48 hours.
            </p>
            <ul style="list-style:none; padding:0; margin:0 0 28px; display:flex; flex-direction:column; gap:10px;">
                <?php
                $feats = ['Laser & diamond-tip engraving','BIS-hallmarked silver & gold plating','100% in-house quality control','Sustainable, recycled packaging'];
                foreach($feats as $f):
                ?>
                <li style="display:flex; align-items:flex-start; gap:10px; font-size:14px; color:#1D1D1F;">
                    <div style="width:20px; height:20px; border-radius:50%; background:#0A2463; color:#fff; display:flex; align-items:center; justify-content:center; font-size:10px; font-weight:700; flex-shrink:0; margin-top:1px;">✓</div>
                    <?php echo esc_html($f); ?>
                </li>
                <?php endforeach; ?>
            </ul>
            <a href="/contact" style="display:inline-flex; align-items:center; gap:8px; background:#0A2463; color:#fff; font-weight:700; padding:14px 28px; border-radius:12px; text-decoration:none; transition:all 0.2s;"
                onmouseover="this.style.background='#172A45'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#0A2463'; this.style.transform=''">
                Contact us →
            </a>
        </div>
        <div style="border-radius:24px; overflow:hidden; aspect-ratio:4/3; box-shadow:0 24px 48px rgba(0,0,0,0.1);">
            <img src="<?php echo esc_url($workshop_img); ?>" alt="Workshop" style="width:100%; height:100%; object-fit:cover;">
        </div>
    </div>
</section>

<!-- TEAM -->
<section style="background:#FBFBFD; padding:72px 0; border-top:1px solid #E5E5EA;">
    <div class="tmg-container">
        <div style="text-align:center; margin-bottom:48px;">
            <p style="font-size:11px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#86868B; margin:0 0 10px;">THE TEAM</p>
            <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.8rem,3vw,2.4rem); color:#0A192F; margin:0;">The people behind every gift</h2>
        </div>
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:24px;" class="tmg-team-grid">
            <?php
            $team = [
                ['Harish Jadhav',  'Founder & CEO',            '#0A2463', 'HJ'],
                ['Meera Jadhav',   'Co-Founder & Design Head', '#7B2D8B', 'MJ'],
                ['Arjun Mehta',    'Head of Production',       '#2a6344', 'AM'],
                ['Priya Sharma',   'Customer Happiness',       '#D4AF37', 'PS'],
            ];
            foreach($team as $t):
            ?>
            <div style="background:#fff; border-radius:20px; padding:24px; border:1.5px solid #E5E5EA; text-align:center; transition:all 0.3s;"
                onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 16px 32px rgba(0,0,0,0.07)'"
                onmouseout="this.style.transform=''; this.style.boxShadow=''">
                <div style="width:72px; height:72px; border-radius:50%; background:<?php echo esc_attr($t[2]); ?>; color:#fff; display:flex; align-items:center; justify-content:center; font-size:22px; font-weight:700; margin:0 auto 14px; letter-spacing:1px;">
                    <?php echo esc_html($t[3]); ?>
                </div>
                <p style="font-weight:700; font-size:15px; color:#1D1D1F; margin:0 0 4px;"><?php echo esc_html($t[0]); ?></p>
                <p style="font-size:12px; color:#86868B; margin:0;"><?php echo esc_html($t[1]); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section style="background:linear-gradient(135deg,#0A2463,#172A45); padding:72px 0; text-align:center; color:#fff;">
    <div class="tmg-container">
        <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.8rem,3vw,2.8rem); color:#fff; margin:0 0 14px;">Want to gift something unforgettable?</h2>
        <p style="color:rgba(255,255,255,0.75); font-size:16px; max-width:480px; margin:0 auto 28px; line-height:1.7;">Browse our collection or get in touch for a custom commission.</p>
        <div style="display:flex; flex-wrap:wrap; gap:14px; justify-content:center;">
            <a href="/shop" style="display:inline-flex; align-items:center; background:#fff; color:#0A2463; font-weight:700; padding:14px 32px; border-radius:12px; text-decoration:none; transition:all 0.2s;"
                onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform=''">Shop now</a>
            <a href="/contact" style="display:inline-flex; align-items:center; border:2px solid rgba(255,255,255,0.6); color:#fff; font-weight:700; padding:14px 32px; border-radius:12px; text-decoration:none; transition:all 0.2s;"
                onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='transparent'">Contact us</a>
        </div>
    </div>
</section>

<style>
@media(max-width:1024px){
    .tmg-story-grid,.tmg-workshop-grid{grid-template-columns:1fr!important;}
    .tmg-promises-grid,.tmg-team-grid{grid-template-columns:repeat(2,1fr)!important;}
    .tmg-stats-grid{grid-template-columns:repeat(2,1fr)!important;}
}
@media(max-width:640px){
    .tmg-promises-grid,.tmg-team-grid,.tmg-stats-grid{grid-template-columns:repeat(2,1fr)!important;}
}
</style>

<?php get_footer(); ?>
