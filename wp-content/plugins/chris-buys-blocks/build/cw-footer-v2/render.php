<?php
$logos = [
    "Kansas City" => plugins_url('src/cw-footer-v2/assets/kc-footer-logo.svg', dirname(__FILE__, 2)),
    "San Francisco Bay Area" => plugins_url('src/cw-footer-v2/assets/sf-footer-logo.svg', dirname(__FILE__, 2)),
    "St. Louis" => plugins_url('src/cw-footer-v2/assets/stl-footer-logo.svg', dirname(__FILE__, 2)),
    "Metro Detroit" => plugins_url('src/cw-footer-v2/assets/det-footer-logo.svg', dirname(__FILE__, 2)),
    "Cleveland" => plugins_url('src/cw-footer-v2/assets/cle-footer-logo.svg', dirname(__FILE__, 2)),
    "Indianapolis" => plugins_url('src/cw-footer-v2/assets/ind-footer-logo.svg', dirname(__FILE__, 2)),
];

$selectedMarket = isset($attributes['selectedMarket']) ? esc_html($attributes['selectedMarket']) : 'St. Louis';
$logoUrl = isset($logos[$selectedMarket]) ? esc_url($logos[$selectedMarket]) : esc_url($logos['St. Louis']);

// Automatically set the brand name based on the selected market
$brandName = $selectedMarket === "San Francisco Bay Area" ? "John Buys Bay Area Houses" : "Chris Buys Homes";
?>

<footer class="cw-footer-v2">
    <div class="cw-footer-v2__content">
        <div class="cw-footer-v2__logo">
            <img src="<?php echo $logoUrl; ?>" alt="Logo" />
        </div>
        <div class="cw-footer-v2__text">
            <p>We are a real estate solutions and investment firm that helps homeowners get rid of burdensome houses, fast. We can buy your house immediately with a fair cash offer and zero hassle.</p>
            <p>© 2024 <?php echo $brandName; ?> LLC</p>
        </div>
    </div>
</footer>