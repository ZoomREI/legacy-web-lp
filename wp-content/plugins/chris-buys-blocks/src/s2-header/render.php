<?php
$logos = [
    "Kansas City" => 's2-header/kc-logo',
    "San Francisco Bay Area" => 's2-header/sf-logo',
    "St. Louis" => 's2-header/stl-logo',
    "Metro Detroit" => 's2-header/det-logo',
    "Cleveland" => 's2-header/cle-logo',
    "Indianapolis" => 's2-header/ind-logo',
];

$selected_market = isset($attributes['selectedMarket']) ? esc_html($attributes['selectedMarket']) : 'St. Louis';
$logoUrl = isset($logos[$selected_market]) ? $logos[$selected_market] : $logos['St. Louis'];
?>

<header class="s2-header s2-header--centered">
    <div class="s2-header__content">
        <div class="s2-header__logo">
            <?php echo get_responsive_image($logoUrl, 'Logo'); ?>
        </div>
    </div>
</header>