<?php
$recipients = [
    ['label' => 'For Her', 'id' => 'women'],
    ['label' => 'For Him', 'id' => 'men'],
    ['label' => 'For Couples', 'id' => 'couple'],
];
?>
<section class="py-16 bg-white tmg-shop-recipient">
    <div class="tmg-container">
        <div class="section-heading">
            <p class="eyebrow">SHOP BY RECIPIENT</p>
            <h2>Made for someone special</h2>
        </div>
        <div class="flex gap-4 justify-center mb-8">
            <?php foreach($recipients as $idx => $r): ?>
                <button class="tmg-btn tmg-btn-secondary recipient-tab <?= $idx===0?'active':'' ?>" data-category="<?= $r['id'] ?>"><?= $r['label'] ?></button>
            <?php endforeach; ?>
        </div>
        <div id="tmg-recipient-products" class="grid grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- AJAX loaded products go here -->
        </div>
    </div>
    <script>
        document.querySelectorAll('.recipient-tab').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.recipient-tab').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const cat = this.dataset.category;
                // AJAX call to WooCommerce REST API
                fetch(`/wp-json/wc/v3/products?category=${cat}&consumer_key=YOUR_KEY&consumer_secret=YOUR_SECRET`)
                    .then(r => r.json())
                    .then(products => renderProductGrid(products));
            });
        });

        function renderProductGrid(products) {
            let html = '';
            products.forEach(p => { 
                html += `<div class="tmg-product-card" style="border: 1px solid #E2E8F0; border-radius: 16px; overflow: hidden;"><img src="${p.images[0]?.src}" style="width: 100%; aspect-ratio: 1; object-fit: cover;"><div style="padding: 16px;"><h3 style="font-size: 14px; margin-bottom: 8px;">${p.name}</h3><p style="font-weight: bold;">${p.price_html}</p></div></div>`; 
            });
            document.getElementById('tmg-recipient-products').innerHTML = html;
        }
    </script>
</section>
