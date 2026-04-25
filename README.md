# THEMENGIFT Code Structure

All files have been successfully created and linked based on your planning documents!

## 1. WordPress Child Theme (`themengift-child/`)
**How to use:** Upload this folder directly into `/wp-content/themes/` on your Hostinger WordPress installation. Then activate it via the WordPress Admin panel.

* **`style.css` & `functions.php`**: Theme configuration, including custom Gift Wrapping checkout logic.
* **`assets/css/brand.css`**: Your complete design system (Colors, Typography, Spacing).
* **`assets/js/custom.js`**: Ready for interactive elements.
* **`front-page.php`**: The Homepage template mapped to your 19 sections.
* **`template-parts/homepage/*`**: All 19 homepage sections fully coded.
* **`woocommerce/archive-product.php`**: Custom Shop page with a premium grid and sidebar.
* **`woocommerce/single-product.php`**: Custom Product details page layout.
* **`template-corporate.php`**: The dedicated Corporate Gifting Enquiry page template.

## 2. Smart Tag System (`smart-tag-system/`)
**How to use:** Upload this entire folder into `/public_html/my-tag/` on your Hostinger server.

* **`index.php`**: The router handling profile scans (e.g., `/my-tag/TMG-AB8X4K`).
* **`includes/config.php`**: Connects to the same MySQL database as WordPress.
* **`includes/functions.php`**: Core logic (IP Geolocation, Tag ID generation).
* **`templates/login.php`**: Custom login page including Google Login button structure.
* **`templates/setup.php`**: The 4-step wizard for owners to set up their tags.
* **`templates/profile-pet.php`**: Beautiful pet tag UI + Layer 2 silent GPS tracking logic.
* **`admin/index.php`**: Base dashboard for you to manage tags.

### Next Steps:
1. Upload these folders to your server.
2. In WordPress, go to Products -> Add New to start adding your 500+ items. 
3. Run the Smart Tag SQL queries (from Document 3) in your Hostinger phpMyAdmin to create the `tag_` tables.
