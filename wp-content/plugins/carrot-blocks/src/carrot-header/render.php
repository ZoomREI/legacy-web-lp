<?php
$logos = [
    "Kansas City" => 'carrot-header/kc-logo',
    "San Francisco Bay Area" => 'carrot-header/sf-logo',
    "St. Louis" => 'carrot-header/stl-logo',
    "Metro Detroit" => 'carrot-header/det-logo',
    "Cleveland" => 'carrot-header/cle-logo',
    "Indianapolis" => 'carrot-header/ind-logo'
];

$selected_market = isset($attributes['selectedMarket']) ? esc_html($attributes['selectedMarket']) : 'St. Louis';
$logoUrl = isset($logos[$selected_market]) ? $logos[$selected_market] : $logos['St. Louis'];

$video_markets = ["St. Louis", "Kansas City", "San Francisco Bay Area"];
$phoneNumber = isset($attributes['phoneNumber']) ? esc_html($attributes['phoneNumber']) : '';
?>

<header class="c-header">
    <div class="c-header__content">
        <div class="c-header__logo">
            <?php echo cb_get_responsive_image($logoUrl, 'Logo'); ?>
        </div>

        <div class="main-nav__container">
            <ul id="main-nav" class="navbar">
                <li class="nav-item"><a title="How It Works" href="#how-to" class="nav-link">How It Works</a></li>
                <li class="nav-item"><a title="The Conditions" href="#we-can-help" class="nav-link">The Conditions</a></li>
                <li class="nav-item"><a title="Reviews" href="#reviews" class="nav-link">Reviews</a></li>
                <?php if (in_array($selected_market, $video_markets)) : ?>
                    <li class="nav-item"><a title="Watch Our Video" href="#commercial" class="nav-link">Watch Our Video</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <?php if ($phoneNumber) : ?>
        <div class="fixed-tel">
            <span class="fixed-tel__text">Call Us!</span>
            <a href="tel:<?php echo $phoneNumber; ?>"><?php echo $phoneNumber; ?></a>
        </div>
    <?php endif; ?>
</header>