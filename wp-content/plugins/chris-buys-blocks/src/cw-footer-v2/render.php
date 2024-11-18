<?php
$logos = [
    "Kansas City" => 'cw-footer-v2/kc-footer-logo',
    "San Francisco Bay Area" => 'cw-footer-v2/sf-footer-logo',
    "St. Louis" => 'cw-footer-v2/stl-footer-logo',
    "Metro Detroit" => 'cw-footer-v2/det-footer-logo',
    "Cleveland" => 'cw-footer-v2/cle-footer-logo',
    "Indianapolis" => 'cw-footer-v2/ind-footer-logo',
];

$selectedMarket = isset($attributes['selectedMarket']) ? esc_html($attributes['selectedMarket']) : 'St. Louis';
$logoUrl = isset($logos[$selectedMarket]) ? $logos[$selectedMarket] : $logos['St. Louis'];

// Automatically set the brand name based on the selected market
$brandName = $selectedMarket === "San Francisco Bay Area" ? "John Buys Bay Area Houses" : "Chris Buys Homes";
?>

<footer class="cw-footer-v2">
    <div class="cw-footer-v2__content">
        <div class="cw-footer-v2__logo">
            <?php echo get_responsive_image($logoUrl, 'Logo'); ?>
        </div>
        <div class="cw-footer-v2__text">
            <p>We are a real estate solutions and investment firm that helps homeowners get rid of burdensome houses, fast. We can buy your house immediately with a fair cash offer and zero hassle.</p>
            <p>© 2024 <?php echo $brandName; ?> LLC</p>
        </div>
    </div>
</footer>