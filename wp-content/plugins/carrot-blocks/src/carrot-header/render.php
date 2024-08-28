<?php
$logos = [
    "Kansas City" => plugins_url('src/carrot-header/assets/kc-logo.svg', dirname(__FILE__, 2)),
    "San Francisco Bay Area" => plugins_url('src/carrot-header/assets/sf-logo.svg', dirname(__FILE__, 2)),
    "St. Louis" => plugins_url('src/carrot-header/assets/stl-logo.svg', dirname(__FILE__, 2)),
    "Metro Detroit" => plugins_url('src/carrot-header/assets/det-logo.svg', dirname(__FILE__, 2)),
    "Cleveland" => plugins_url('src/carrot-header/assets/cle-logo.svg', dirname(__FILE__, 2)),
    "Indianapolis" => plugins_url('src/carrot-header/assets/ind-logo.svg', dirname(__FILE__, 2)),
];

$selected_market = isset($attributes['selectedMarket']) ? esc_html($attributes['selectedMarket']) : 'St. Louis';
$logoUrl = isset($logos[$selected_market]) ? esc_url($logos[$selected_market]) : esc_url($logos['St. Louis']);

$video_markets = ["St. Louis", "Kansas City", "San Francisco Bay Area"];
$phoneNumber = isset($attributes['phoneNumber']) ? esc_html($attributes['phoneNumber']) : '';
?>

<header class="c-header">
    <div class="c-header__content">
        <div class="c-header__logo">
            <img src="<?php echo $logoUrl; ?>" alt="Logo" />
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