<?php
$logos = [
    "Kansas City" => plugins_url('src/s2-header/assets/kc-logo.svg', dirname(__FILE__, 2)),
    "San Francisco Bay Area" => plugins_url('src/s2-header/assets/sf-logo.svg', dirname(__FILE__, 2)),
    "St. Louis" => plugins_url('src/s2-header/assets/stl-logo.svg', dirname(__FILE__, 2)),
    "Metro Detroit" => plugins_url('src/s2-header/assets/det-logo.svg', dirname(__FILE__, 2)),
    "Cleveland" => plugins_url('src/s2-header/assets/cle-logo.svg', dirname(__FILE__, 2)),
    "Indianapolis" => plugins_url('src/s2-header/assets/ind-logo.svg', dirname(__FILE__, 2)),
];

$selected_market = isset($attributes['selectedMarket']) ? esc_html($attributes['selectedMarket']) : 'St. Louis';
$logoUrl = isset($logos[$selected_market]) ? esc_url($logos[$selected_market]) : esc_url($logos['St. Louis']);
?>

<header class="cw-header cw-header--centered">
    <div class="cw-header__content">
        <div class="cw-header__logo">
            <img src="<?php echo $logoUrl; ?>" alt="Logo" />
        </div>
    </div>
</header>