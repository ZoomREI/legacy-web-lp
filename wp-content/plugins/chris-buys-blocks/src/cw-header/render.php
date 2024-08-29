<?php
$logoUrl = plugins_url('src/cw-header/assets/logo_1.svg', dirname(__FILE__, 2));
$telephoneUrl = plugins_url('src/cw-header/assets/telephone_1.svg', dirname(__FILE__, 2));

if (isset($attributes['logoUrl']) && !empty($attributes['logoUrl'])) {
    $logoUrl = esc_url($attributes['logoUrl']);
}

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
        <div class="cw-header__phone-number">
            <span class="cw-header__phone-icon"><img src="<?php echo $telephoneUrl; ?>" alt=""></span>
            <span class="cw-header__phone-text">Call Us On
                <a href="tel:<?php echo $phoneNumber; ?>"><?php echo $phoneNumber; ?></a></span>
        </div>
    </div>
</header>