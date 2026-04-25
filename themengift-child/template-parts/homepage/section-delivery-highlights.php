<!-- Delivery Highlights / Trust Strip - Radiant UI Style -->
<section class="py-10 bg-white border-y border-[#E5E5EA]">
    <div class="tmg-container">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            <?php
            $items = [
                ['icon' => '🚚', 'title' => 'Free Shipping',   'sub' => 'On orders ₹699+'],
                ['icon' => '🔒', 'title' => '100% Secure',     'sub' => 'SSL & UPI/Cards'],
                ['icon' => '✨', 'title' => 'Made in India',   'sub' => 'Hand-crafted'],
                ['icon' => '🔄', 'title' => '21-Day Returns',  'sub' => 'Easy & free'],
                ['icon' => '💛', 'title' => 'Lifetime Care',   'sub' => 'Re-engrave free'],
                ['icon' => '🎁', 'title' => 'Free Gift Box',   'sub' => 'On every order'],
            ];
            foreach($items as $it): ?>
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-xl shrink-0" style="background:#EEF2FF;">
                    <?= $it['icon'] ?>
                </div>
                <div>
                    <p class="font-bold text-sm text-[#1D1D1F] m-0"><?= esc_html($it['title']) ?></p>
                    <p class="text-xs text-[#86868B] m-0 mt-0.5"><?= esc_html($it['sub']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
