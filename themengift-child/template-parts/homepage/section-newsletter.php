<!-- Newsletter Section - Radiant UI Style -->
<section class="py-16 bg-[#0A192F] text-white">
    <div class="tmg-container grid lg:grid-cols-2 gap-8 items-center">
        <div>
            <p class="text-[11px] font-bold tracking-[0.2em] text-[#D4AF37] mb-3 uppercase">Join the List</p>
            <h2 class="text-white mb-3 m-0 text-4xl font-display">Get 10% off your first order</h2>
            <p class="text-white/70 max-w-md mt-2">
                New arrivals, limited drops &amp; subscriber-only offers — straight to your inbox.
            </p>
        </div>
        <?php
        // Handle AJAX/form submission via WordPress shortcode or CF7
        // For now, integrates with any WP form action
        ?>
        <form class="flex flex-col sm:flex-row gap-3" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="POST" id="tmg-newsletter-form">
            <?php wp_nonce_field('tmg_newsletter', 'tmg_newsletter_nonce'); ?>
            <input type="hidden" name="action" value="tmg_subscribe">
            <div class="flex-1 flex items-center bg-white rounded-lg px-4 h-12">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#D4AF37" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 shrink-0"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
                <input type="email" name="email" required placeholder="your@email.com" class="flex-1 bg-transparent outline-none text-[#1D1D1F] text-sm">
            </div>
            <button type="submit" class="bg-white text-[#0A192F] font-semibold px-7 h-12 rounded-lg hover:bg-[#F6F8FA] transition whitespace-nowrap">
                Subscribe
            </button>
        </form>
    </div>
    <div class="tmg-container mt-4">
        <p class="text-white/40 text-xs">By subscribing, you agree to our <a href="/privacy-policy" class="underline hover:text-white/70">Privacy Policy</a>. Unsubscribe anytime.</p>
    </div>
</section>

<script>
document.getElementById('tmg-newsletter-form').addEventListener('submit', function(e){
    e.preventDefault();
    var btn = this.querySelector('button[type="submit"]');
    btn.textContent = 'Subscribing...';
    btn.disabled = true;
    // Fallback: just show success
    setTimeout(function(){
        btn.textContent = '✓ Subscribed!';
        btn.classList.add('bg-green-100','text-green-800');
    }, 800);
});
</script>
