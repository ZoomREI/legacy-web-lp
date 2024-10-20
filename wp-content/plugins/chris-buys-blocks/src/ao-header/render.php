<?php
$logos = [
    "Kansas City" => plugins_url('src/ao-header/assets/kc-logo.svg', dirname(__FILE__, 2)),
    "San Francisco Bay Area" => plugins_url('src/ao-header/assets/sf-logo.svg', dirname(__FILE__, 2)),
    "St. Louis" => plugins_url('src/ao-header/assets/stl-logo.svg', dirname(__FILE__, 2)),
    "Metro Detroit" => plugins_url('src/ao-header/assets/det-logo.svg', dirname(__FILE__, 2)),
    "Cleveland" => plugins_url('src/ao-header/assets/cle-logo.svg', dirname(__FILE__, 2)),
    "Indianapolis" => plugins_url('src/ao-header/assets/ind-logo.svg', dirname(__FILE__, 2)),
];

$selected_market = isset($attributes['selectedMarket']) ? esc_html($attributes['selectedMarket']) : 'St. Louis';
$logoUrl = isset($logos[$selected_market]) ? esc_url($logos[$selected_market]) : esc_url($logos['St. Louis']);

$telephoneUrl = plugins_url('src/ao-header/assets/telephone.svg', dirname(__FILE__, 2));
$phoneNumber = isset($attributes['phoneNumber']) ? esc_html($attributes['phoneNumber']) : '';
?>

<header class="ao-header">
    <div class="ao-header__content">
        <div class="ao-header__logo">
            <img src="<?php echo $logoUrl; ?>" alt="Logo" />
        </div>
        <a class="call-btn" href="tel:<?php echo $phoneNumber; ?>">
            <div class="ao-header__phone-number">
                <span class="ao-header__phone--icon"><img src="<?php echo $telephoneUrl; ?>" alt="Phone Icon"></span>
                <span class="ao-header__phone--text">Call Us On </span>
                <span class="ao-header__phone--number"><?php echo $phoneNumber; ?></span>
            </div>
        </a>
    </div>
</header>