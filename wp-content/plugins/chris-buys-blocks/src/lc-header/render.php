<?php
$logos = [
    "Kansas City" => 'lc-header/kc-logo',
    "San Francisco Bay Area" => 'lc-header/sf-logo',
    "St. Louis" => 'lc-header/stl-logo',
    "Metro Detroit" => 'lc-header/det-logo',
    "Cleveland" => 'lc-header/cle-logo',
    "Indianapolis" => 'lc-header/ind-logo',
];

$selected_market = isset($attributes['selectedMarket']) ? esc_html($attributes['selectedMarket']) : 'St. Louis';
$logoUrl = isset($logos[$selected_market]) ? $logos[$selected_market] : $logos['St. Louis'];

$phoneNumber = isset($attributes['phoneNumber']) ? esc_html($attributes['phoneNumber']) : '';
?>

<header class="lc-header">
    <div class="lc-header__content">
        <div class="lc-header__logo">
            <?php echo get_responsive_image($logoUrl, 'Logo'); ?>
        </div>
        <a class="call-btn" href="tel:<?php echo $phoneNumber; ?>">
            <div class="lc-header__phone-number">
                <span class="lc-header__phone--icon"><?php echo get_responsive_image('lc-header/telephone', 'Phone Icon'); ?></span>
                <span class="lc-header__phone--text">Call Us On</span>
                <span class="lc-header__phone--number"><?php echo $phoneNumber; ?></span>
            </div>
        </a>
    </div>
</header>