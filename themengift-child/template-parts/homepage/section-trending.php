<section class="tmg-trending tmg-section" style="background-color: var(--color-background);">
    <div class="tmg-container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: var(--spacing-xl);">
            <h2 style="margin: 0;">Trending Now</h2>
            <a href="/shop" style="color: var(--color-text-muted); font-weight: 500;">View All →</a>
        </div>
        
        <div style="display: flex; gap: var(--spacing-md); overflow-x: auto; padding-bottom: var(--spacing-sm); scroll-snap-type: x mandatory;">
            <!-- Placeholder for WooCommerce Products shortcode or loop -->
            <div style="min-width: 280px; flex: 0 0 280px; scroll-snap-align: start; border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--spacing-md);">
                <div style="background: #f0f0f0; height: 200px; border-radius: var(--radius-sm); margin-bottom: var(--spacing-sm);"></div>
                <h3 style="font-size: 1.1rem; margin-bottom: var(--spacing-xs);">Men's Cuban Chain</h3>
                <p style="color: var(--color-secondary); font-weight: bold; margin-bottom: var(--spacing-sm);">₹899</p>
                <button class="tmg-btn tmg-btn-secondary" style="width: 100%; padding: 8px;">View Details</button>
            </div>
            
            <div style="min-width: 280px; flex: 0 0 280px; scroll-snap-align: start; border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--spacing-md);">
                <div style="background: #f0f0f0; height: 200px; border-radius: var(--radius-sm); margin-bottom: var(--spacing-sm);"></div>
                <h3 style="font-size: 1.1rem; margin-bottom: var(--spacing-xs);">Women's Pearl Necklace</h3>
                <p style="color: var(--color-secondary); font-weight: bold; margin-bottom: var(--spacing-sm);">₹1,299</p>
                <button class="tmg-btn tmg-btn-secondary" style="width: 100%; padding: 8px;">View Details</button>
            </div>

            <div style="min-width: 280px; flex: 0 0 280px; scroll-snap-align: start; border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--spacing-md);">
                <div style="background: #f0f0f0; height: 200px; border-radius: var(--radius-sm); margin-bottom: var(--spacing-sm);"></div>
                <h3 style="font-size: 1.1rem; margin-bottom: var(--spacing-xs);">Custom Name Bracelet</h3>
                <p style="color: var(--color-secondary); font-weight: bold; margin-bottom: var(--spacing-sm);">₹699</p>
                <button class="tmg-btn tmg-btn-secondary" style="width: 100%; padding: 8px;">View Details</button>
            </div>
            
            <div style="min-width: 280px; flex: 0 0 280px; scroll-snap-align: start; border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--spacing-md);">
                <div style="background: #f0f0f0; height: 200px; border-radius: var(--radius-sm); margin-bottom: var(--spacing-sm);"></div>
                <h3 style="font-size: 1.1rem; margin-bottom: var(--spacing-xs);">Smart Dog Tag - Premium</h3>
                <p style="color: var(--color-secondary); font-weight: bold; margin-bottom: var(--spacing-sm);">₹499</p>
                <button class="tmg-btn tmg-btn-secondary" style="width: 100%; padding: 8px;">View Details</button>
            </div>
        </div>
    </div>
</section>

<style>
    /* Hide scrollbar for cleaner look */
    .tmg-trending div::-webkit-scrollbar {
        display: none;
    }
    .tmg-trending div {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
