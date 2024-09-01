<?php
$privacyUrl = plugins_url('src/ao-virtue-carousel/assets/privacy.svg', dirname(__FILE__, 2));
$selectUrl = plugins_url('src/ao-virtue-carousel/assets/select.svg', dirname(__FILE__, 2));
$happyUrl = plugins_url('src/ao-virtue-carousel/assets/happy.svg', dirname(__FILE__, 2));
$homeUrl = plugins_url('src/ao-virtue-carousel/assets/home.svg', dirname(__FILE__, 2));
$arrowLeftUrl = plugins_url('src/ao-virtue-carousel/assets/arrow-left.svg', dirname(__FILE__, 2));
$arrowRightUrl = plugins_url('src/ao-virtue-carousel/assets/arrow-right.svg', dirname(__FILE__, 2));
?>

<div class="ao-virtue-carousel">
    <div class="ao-carousel-wrapper">
        <div class="ao-carousel-track">
            <div class="ao-carousel-item">
                <img src="<?php echo esc_html($privacyUrl); ?>" alt="Privacy Icon">
                <div class="ao-carousel-item__content">
                    <h3>100% Safe and Secure</h3>
                </div>
            </div>
            <div class="ao-carousel-item">
                <img src="<?php echo esc_html($selectUrl); ?>" alt="Select Icon">
                <div class="ao-carousel-item__content">
                    <h3>Immediate Cash Offer</h3>
                </div>
            </div>
            <div class="ao-carousel-item">
                <img src="<?php echo esc_html($happyUrl); ?>" alt="Happy Icon">
                <div class="ao-carousel-item__content">
                    <h3>1,500+ Happy Customers</h3>
                </div>
            </div>
            <div class="ao-carousel-item">
                <img src="<?php echo esc_html($homeUrl); ?>" alt="Home Icon">
                <div class="ao-carousel-item__content">
                    <h3>Hassle-Free Sales</h3>
                </div>
            </div>
        </div>
        <div class="ao-carousel-nav">
            <span class="ao-carousel-nav__button ao-carousel-nav__button--prev">
               <img src="<?php echo esc_html($arrowLeftUrl); ?>" alt="Home Icon">
            </span>
            <span class="ao-carousel-nav__button ao-carousel-nav__button--next">
               <img src="<?php echo esc_html($arrowRightUrl); ?>" alt="Home Icon">
            </span>
        </div>
    </div>
    
</div>