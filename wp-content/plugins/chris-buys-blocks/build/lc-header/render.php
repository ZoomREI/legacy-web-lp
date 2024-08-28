<?php
$logoUrl = plugins_url('src/lc-header/assets/stl-logo.svg', dirname(__FILE__, 2));
$telephoneUrl = plugins_url('src/lc-header/assets/telephone.svg', dirname(__FILE__, 2));

if (isset($attributes['logoUrl']) && !empty($attributes['logoUrl'])) {
    $logoUrl = esc_url($attributes['logoUrl']);
}

$phoneNumber = isset($attributes['phoneNumber']) ? esc_html($attributes['phoneNumber']) : '';
?>

<header class="lc-header">
    <div class="lc-header__content">
        <div class="lc-header__logo">
            <img src="<?php echo $logoUrl; ?>" alt="Logo" />
        </div>
        <div class="lc-header__phone-number">
            <span class="lc-header__phone-icon"><img src="<?php echo $telephoneUrl; ?>" alt=""></span>
            <span class="lc-header__phone-text">Call Us On
                <a href="tel:<?php echo $phoneNumber; ?>"><?php echo $phoneNumber; ?></a></span>
        </div>
    </div>
</header>