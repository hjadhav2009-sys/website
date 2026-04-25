<?php
/**
 * Testimonials Section - Radiant UI Style
 */
$testimonials = [
    [
        'name' => 'Priya S.',
        'city' => 'Mumbai',
        'text' => 'The engraving is so delicate and the gift box made my husband cry happy tears. Worth every rupee.',
        'initials' => 'PS',
        'color' => 'bg-[#0A2463]',
    ],
    [
        'name' => 'Rahul K.',
        'city' => 'Bangalore',
        'text' => 'Got a smart tag for my Lab. Someone scanned it within hours when he ran off — I had him back in 40 minutes.',
        'initials' => 'RK',
        'color' => 'bg-[#D4AF37]',
    ],
    [
        'name' => 'Anjali D.',
        'city' => 'Delhi',
        'text' => 'Ordered 200 corporate hampers — the team was super responsive, branded everything beautifully and delivered on time.',
        'initials' => 'AD',
        'color' => 'bg-[#2a6344]',
    ],
    [
        'name' => 'Vikram J.',
        'city' => 'Pune',
        'text' => 'Couple\'s promise rings — quality is on par with brands I\'ve paid 3x for. Will absolutely come back.',
        'initials' => 'VJ',
        'color' => 'bg-[#7B2D8B]',
    ],
];
?>
<section class="py-16 bg-white">
    <div class="tmg-container">
        <div class="flex items-end justify-between flex-wrap gap-4 mb-8">
            <div>
                <p class="text-[11px] font-bold tracking-[0.2em] text-[#86868B] mb-2 uppercase">Loved by 50,000+</p>
                <h2 class="font-display m-0 text-[#0A192F]">What our customers say</h2>
            </div>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-5">
            <?php foreach($testimonials as $t): ?>
            <div class="bg-[#FBFBFD] rounded-2xl p-6 border border-[#E5E5EA] hover:shadow-md transition-shadow duration-300">
                <!-- Quote Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#D4AF37" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mb-3"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"></path><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"></path></svg>
                <!-- Stars -->
                <div class="flex gap-0.5 mb-3">
                    <?php for($s=0;$s<5;$s++): ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#D4AF37" stroke="#D4AF37" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    <?php endfor; ?>
                </div>
                <p class="text-sm text-[#1D1D1F] leading-relaxed mb-5">"<?php echo esc_html($t['text']); ?>"</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full <?php echo $t['color']; ?> flex items-center justify-center text-white text-xs font-bold shrink-0">
                        <?php echo esc_html($t['initials']); ?>
                    </div>
                    <div>
                        <p class="text-sm font-bold m-0"><?php echo esc_html($t['name']); ?></p>
                        <p class="text-xs text-[#86868B] m-0 mt-0.5"><?php echo esc_html($t['city']); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
