<?php
$logos = [
    "Kansas City" => 'cw-header/kc-logo',
    "San Francisco Bay Area" => 'cw-header/sf-logo',
    "St. Louis" => 'cw-header/stl-logo',
    "Metro Detroit" => 'cw-header/det-logo',
    "Cleveland" => 'cw-header/cle-logo',
    "Indianapolis" => 'cw-header/ind-logo',
];

$selected_market = isset($attributes['selectedMarket']) ? esc_html($attributes['selectedMarket']) : 'St. Louis';
$logoUrl = isset($logos[$selected_market]) ? $logos[$selected_market] : $logos['St. Louis'];

$phoneNumber = isset($attributes['phoneNumber']) ? esc_html($attributes['phoneNumber']) : '';
?>

<header class="cw-header">
    <div class="cw-header__content">
        <div class="cw-header__logo">
            <?php echo get_responsive_image($logoUrl, 'Logo'); ?>
        </div>
        <div class="cw-header__menu">
            <a href="#how-it-works" class="cw-header__menu--link">How it works</a>
            <a href="#about" class="cw-header__menu--link">About</a>
            <a href="#benefits" class="cw-header__menu--link">Benefits</a>
            <a href="#compare" class="cw-header__menu--link">Compare</a>
            <a href="#reviews" class="cw-header__menu--link">Reviews</a>
            <a href="#faq" class="cw-header__menu--link">FAQ</a>
        </div>
        <a class="call-btn" href="tel:<?php echo $phoneNumber; ?>">
            <div class="cw-header__phone-number">
                <span class="cw-header__phone--icon"><?php echo get_responsive_image('cw-header/telephone_1', 'Phone Icon'); ?></span>
                <span class="cw-header__phone--text">Call Us On</span>
                <span class="cw-header__phone--number"><?php echo $phoneNumber; ?></span>
            </div>
        </a>
    </div>
</header>