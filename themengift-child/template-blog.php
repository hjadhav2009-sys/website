<?php
/**
 * Template Name: Blog Archive
 * THEMENGIFT — Premium Radiant UI Design
 * Also works as archive.php or home.php for blog posts
 */
get_header();

$categories = ['All', 'Gifting', 'Care', 'Stories', 'Smart Tags', 'Corporate', 'Design'];
?>

<!-- HERO -->
<section style="background:#FBFBFD; border-bottom:1px solid #E5E5EA;">
    <div class="tmg-container" style="padding-top:56px; padding-bottom:56px;">
        <div style="display:flex; align-items:center; gap:6px; font-size:13px; color:#86868B; margin-bottom:16px;">
            <a href="/" style="color:#86868B; text-decoration:none;">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            <span style="color:#1D1D1F;">Journal</span>
        </div>
        <div style="display:flex; align-items:end; justify-content:space-between; flex-wrap:wrap; gap:16px;">
            <div>
                <h1 style="font-family:'Playfair Display',serif; font-size:clamp(2rem,4vw,3rem); font-weight:700; color:#0A192F; margin:0 0 10px;">Stories, guides &amp; gifting inspiration</h1>
                <p style="color:#86868B; font-size:15px; max-width:520px; margin:0; line-height:1.7;">
                    Notes from the THEMENGIFT workshop — care guides, design philosophy and real customer stories.
                </p>
            </div>
            <!-- Category filter chips -->
            <div style="display:flex; flex-wrap:wrap; gap:8px;" id="tmg-blog-cats">
                <?php foreach($categories as $i => $cat): ?>
                <button data-cat="<?php echo esc_attr(strtolower($cat)); ?>"
                    onclick="filterCat(this)"
                    style="padding:7px 16px; border-radius:999px; font-size:13px; font-weight:600; cursor:pointer; border:1.5px solid; transition:all 0.2s;
                    <?php echo $i===0 ? 'background:#0A2463; color:#fff; border-color:#0A2463;' : 'background:#fff; color:#1D1D1F; border-color:#E5E5EA;'; ?>">
                    <?php echo esc_html($cat); ?>
                </button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- POSTS -->
<section style="background:#fff; padding:56px 0 80px;">
    <div class="tmg-container">
        <?php
        $paged = get_query_var('paged') ?: 1;
        $query = new WP_Query(['post_type'=>'post','posts_per_page'=>7,'paged'=>$paged,'post_status'=>'publish']);

        if($query->have_posts()):
            $first = true;
            while($query->have_posts()): $query->the_post();
                $img    = get_the_post_thumbnail_url(get_the_ID(),'large') ?: get_stylesheet_directory_uri().'/assets/images/blog-placeholder.jpg';
                $cats   = get_the_category();
                $cat_lbl= !empty($cats) ? $cats[0]->name : 'Gifting';
                $date   = get_the_date('M j, Y');

                if($first):
                    $first = false;
        ?>
        <!-- FEATURED POST (first one) -->
        <article style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:center; margin-bottom:64px; cursor:pointer;" class="tmg-featured-post"
            onclick="location.href='<?php the_permalink(); ?>'">
            <div style="border-radius:24px; overflow:hidden; aspect-ratio:4/3; box-shadow:0 20px 40px rgba(0,0,0,0.08);">
                <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute(); ?>"
                    style="width:100%; height:100%; object-fit:cover; transition:transform 0.6s;"
                    onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform=''">
            </div>
            <div>
                <span style="font-size:11px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#86868B;">
                    <?php echo esc_html($cat_lbl); ?> · <?php echo esc_html($date); ?>
                </span>
                <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.6rem,3vw,2.2rem); color:#0A192F; margin:12px 0 12px; line-height:1.2; transition:color 0.2s;"
                    onmouseover="this.style.color='#0A2463'" onmouseout="this.style.color='#0A192F'">
                    <?php the_title(); ?>
                </h2>
                <p style="color:#86868B; font-size:15px; line-height:1.7; margin:0 0 20px;">
                    <?php echo wp_trim_words(get_the_excerpt(), 28, '...'); ?>
                </p>
                <a href="<?php the_permalink(); ?>" style="display:inline-flex; align-items:center; gap:6px; font-weight:600; color:#0A2463; text-decoration:none; font-size:14px; transition:gap 0.2s;"
                    onmouseover="this.style.gap='10px'" onmouseout="this.style.gap='6px'">
                    Read article
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </article>

        <!-- Divider -->
        <div style="border-top:1px solid #E5E5EA; margin-bottom:48px;"></div>

        <!-- Grid of remaining posts -->
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:28px;" class="tmg-blog-grid" id="tmg-blog-list">

        <?php else: ?>
        <!-- GRID CARD -->
        <article data-cats="<?php echo esc_attr(strtolower($cat_lbl)); ?>"
            style="cursor:pointer;" class="tmg-blog-card"
            onclick="location.href='<?php the_permalink(); ?>'">
            <div style="border-radius:20px; overflow:hidden; aspect-ratio:4/3; margin-bottom:14px; background:#FBFBFD;">
                <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy"
                    style="width:100%; height:100%; object-fit:cover; transition:transform 0.6s;"
                    onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform=''">
            </div>
            <span style="font-size:11px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#86868B;">
                <?php echo esc_html($cat_lbl); ?> · <?php echo esc_html($date); ?>
            </span>
            <h3 style="font-family:'Playfair Display',serif; font-size:18px; color:#0A192F; margin:8px 0 8px; line-height:1.3; transition:color 0.2s;"
                onmouseover="this.style.color='#0A2463'" onmouseout="this.style.color='#0A192F'">
                <?php the_title(); ?>
            </h3>
            <p style="font-size:13px; color:#86868B; margin:0 0 14px; line-height:1.6; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                <?php echo wp_trim_words(get_the_excerpt(), 18, '...'); ?>
            </p>
            <a href="<?php the_permalink(); ?>" style="font-size:13px; font-weight:600; color:#0A2463; text-decoration:none;">Read →</a>
        </article>

        <?php endif; endwhile; ?>

        </div><!-- end grid -->

        <?php wp_reset_postdata(); ?>

        <!-- Pagination -->
        <?php if($query->max_num_pages > 1): ?>
        <div style="margin-top:56px; text-align:center;">
            <?php
            $big = 999999;
            echo paginate_links([
                'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format'    => '?paged=%#%',
                'current'   => max(1, get_query_var('paged')),
                'total'     => $query->max_num_pages,
                'prev_text' => '← Prev',
                'next_text' => 'Next →',
                'type'      => 'list',
            ]);
            ?>
        </div>
        <?php endif; ?>

        <?php else: ?>
        <!-- No posts yet -->
        <div style="text-align:center; padding:80px 0;">
            <div style="font-size:48px; margin-bottom:16px;">📝</div>
            <h2 style="font-family:'Playfair Display',serif; color:#0A192F; margin:0 0 10px;">No posts yet</h2>
            <p style="color:#86868B; margin:0 0 24px;">Our writers are crafting something beautiful. Check back soon!</p>
            <a href="/" style="display:inline-flex; align-items:center; gap:8px; background:#0A2463; color:#fff; font-weight:700; padding:14px 28px; border-radius:12px; text-decoration:none;">← Back to Home</a>
        </div>
        <?php endif; ?>

    </div>
</section>

<!-- NEWSLETTER -->
<section style="background:linear-gradient(135deg,#0A2463,#172A45); padding:56px 0; text-align:center; color:#fff;">
    <div class="tmg-container" style="max-width:560px; margin:0 auto;">
        <p style="font-size:11px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#D4AF37; margin:0 0 12px;">NEVER MISS A STORY</p>
        <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.8rem,3vw,2.4rem); color:#fff; margin:0 0 10px;">Get new posts by email</h2>
        <p style="color:rgba(255,255,255,0.75); margin:0 0 24px; font-size:15px;">Plus subscriber-only offers and early access to new collections.</p>
        <div style="display:flex; gap:10px; max-width:440px; margin:0 auto;">
            <div style="flex:1; background:#fff; border-radius:12px; padding:0 14px; display:flex; align-items:center; height:48px;">
                <input type="email" placeholder="your@email.com" style="flex:1; background:transparent; border:none; outline:none; font-size:14px; color:#1D1D1F;">
            </div>
            <button style="background:#D4AF37; color:#0A2463; font-weight:700; padding:0 24px; border-radius:12px; border:none; font-size:14px; cursor:pointer; height:48px; white-space:nowrap; transition:all 0.2s;"
                onmouseover="this.style.background='#C9A227'" onmouseout="this.style.background='#D4AF37'">
                Subscribe
            </button>
        </div>
    </div>
</section>

<style>
.tmg-blog-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 28px; }
@media(max-width:1024px){
    .tmg-featured-post{grid-template-columns:1fr!important;}
    .tmg-blog-grid{grid-template-columns:repeat(2,1fr)!important;}
}
@media(max-width:640px){
    .tmg-blog-grid{grid-template-columns:1fr!important;}
}
/* Pagination styling */
.page-numbers { display:inline-flex; align-items:center; justify-content:center; gap:6px; }
.page-numbers li { list-style:none; }
.page-numbers li a, .page-numbers li span {
    display:inline-flex; align-items:center; justify-content:center;
    min-width:36px; height:36px; border-radius:10px; font-size:14px; font-weight:600;
    text-decoration:none; border:1.5px solid #E5E5EA; color:#1D1D1F; transition:all 0.2s;
    padding:0 10px;
}
.page-numbers li .current { background:#0A2463; color:#fff; border-color:#0A2463; }
.page-numbers li a:hover { border-color:#0A2463; color:#0A2463; }
</style>

<script>
function filterCat(btn){
    var cat = btn.dataset.cat;
    // Update buttons
    document.querySelectorAll('#tmg-blog-cats button').forEach(function(b){
        b.style.background = '#fff';
        b.style.color = '#1D1D1F';
        b.style.borderColor = '#E5E5EA';
    });
    btn.style.background = '#0A2463';
    btn.style.color = '#fff';
    btn.style.borderColor = '#0A2463';
    // Filter cards (client-side by data-cat attribute)
    document.querySelectorAll('.tmg-blog-card').forEach(function(c){
        if(cat === 'all' || c.dataset.cats.includes(cat)){
            c.style.display = '';
        } else {
            c.style.display = 'none';
        }
    });
}
</script>

<?php get_footer(); ?>
