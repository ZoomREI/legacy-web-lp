<?php
$logos = [
    "Kansas City" => plugins_url('src/cw-header/assets/kc-logo.svg', dirname(__FILE__, 2)),
    "San Francisco Bay Area" => plugins_url('src/cw-header/assets/sf-logo.svg', dirname(__FILE__, 2)),
    "St. Louis" => plugins_url('src/cw-header/assets/stl-logo.svg', dirname(__FILE__, 2)),
    "Metro Detroit" => plugins_url('src/cw-header/assets/det-logo.svg', dirname(__FILE__, 2)),
    "Cleveland" => plugins_url('src/cw-header/assets/cle-logo.svg', dirname(__FILE__, 2)),
    "Indianapolis" => plugins_url('src/cw-header/assets/ind-logo.svg', dirname(__FILE__, 2)),
];

$selected_market = isset($attributes['selectedMarket']) ? esc_html($attributes['selectedMarket']) : 'St. Louis';
$logoUrl = isset($logos[$selected_market]) ? esc_url($logos[$selected_market]) : esc_url($logos['St. Louis']);

$telephoneUrl = plugins_url('src/cw-header/assets/telephone_1.svg', dirname(__FILE__, 2));
$phoneNumber = isset($attributes['phoneNumber']) ? esc_html($attributes['phoneNumber']) : '';
?>

<header class="cw-header">
    <div class="cw-header__content">
        <div class="cw-header__logo">
            <img src="<?php echo $logoUrl; ?>" alt="Logo" />
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
                <span class="cw-header__phone--icon"><img src="<?php echo $telephoneUrl; ?>" alt=""></span>
                <span class="cw-header__phone--text">Call Us On</span>
                <span class="cw-header__phone--number"><?php echo $phoneNumber; ?></span>
            </div>
        </a>
    </div>
</header>