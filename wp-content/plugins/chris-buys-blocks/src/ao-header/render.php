<?php
$logos = [
    "Kansas City" => 'ao-header/kc-logo',
    "San Francisco Bay Area" => 'ao-header/sf-logo',
    "St. Louis" => 'ao-header/stl-logo',
    "Metro Detroit" => 'ao-header/det-logo',
    "Cleveland" => 'ao-header/cle-logo',
    "Indianapolis" => 'ao-header/ind-logo',
];

$selected_market = isset($attributes['selectedMarket']) ? esc_html($attributes['selectedMarket']) : 'St. Louis';
$logoUrl = isset($logos[$selected_market]) ? $logos[$selected_market] : $logos['St. Louis'];

$telephoneUrl = plugins_url('src/ao-header/assets/telephone.svg', dirname(__FILE__, 2));
$phoneNumber = isset($attributes['phoneNumber']) ? esc_html($attributes['phoneNumber']) : '';
?>

<header class="ao-header">
    <div class="ao-header__content">
        <div class="ao-header__logo">
            <?php echo get_responsive_image($logoUrl, 'Logo'); ?>
        </div>
        <a class="call-btn" href="tel:<?php echo $phoneNumber; ?>">
            <div class="ao-header__phone-number">
                <span class="ao-header__phone--icon"><?php echo get_responsive_image('ao-header/telephone', 'Phone Icon'); ?></span>
                <span class="ao-header__phone--text">Call Us On </span>
                <span class="ao-header__phone--number"><?php echo $phoneNumber; ?></span>
            </div>
        </a>
    </div>
</header>