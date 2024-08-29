<?php
$logoUrl = plugins_url('src/ao-footer/assets/stl-footer-logo.svg', dirname(__FILE__, 2));

if (isset($attributes['logoUrl']) && !empty($attributes['logoUrl'])) {
    $logoUrl = esc_url($attributes['logoUrl']);
}

$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';
$brandName = ($selectedName == "Chris") ? "Chris Buys Homes" : "John Buys Bay Area Houses";
?>

<footer class="ao-footer">
    <div class="ao-footer__content">
        <div class="ao-footer__logo">
            <img src="<?php echo $logoUrl; ?>" alt="Logo" />
        </div>
        <div class="ao-footer__text">
            <p>We are a real estate solutions and investment firm that helps homeowners get rid of burdensome houses, fast. We can buy your house immediately with a fair cash offer and zero hassle</p>
            <p>© 2024 <?php echo $brandName; ?> LLC</p>
        </div>
    </div>
</footer>