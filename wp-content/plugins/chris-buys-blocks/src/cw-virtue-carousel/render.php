<?php
$privacyUrl = plugins_url('src/cw-virtue-carousel/assets/privacy.svg', dirname(__FILE__, 2));
$selectUrl = plugins_url('src/cw-virtue-carousel/assets/select.svg', dirname(__FILE__, 2));
$happyUrl = plugins_url('src/cw-virtue-carousel/assets/happy.svg', dirname(__FILE__, 2));
$homeUrl = plugins_url('src/cw-virtue-carousel/assets/home.svg', dirname(__FILE__, 2));
$arrowLeftUrl = plugins_url('src/cw-virtue-carousel/assets/arrow-left.svg', dirname(__FILE__, 2));
$arrowRightUrl = plugins_url('src/cw-virtue-carousel/assets/arrow-right.svg', dirname(__FILE__, 2));
?>

<div class="cw-virtue-carousel">
    <div class="cw-carousel-wrapper">
        <div class="cw-carousel-track">
            <div class="cw-carousel-item">
                <img src="<?php echo esc_html($privacyUrl); ?>" alt="Privacy Icon">
                <div class="cw-carousel-item__content">
                    <h3>100% Safe and Secure</h3>
                </div>
            </div>
            <div class="cw-carousel-item">
                <img src="<?php echo esc_html($selectUrl); ?>" alt="Select Icon">
                <div class="cw-carousel-item__content">
                    <h3>Immediate Cash Offer</h3>
                </div>
            </div>
            <div class="cw-carousel-item">
                <img src="<?php echo esc_html($happyUrl); ?>" alt="Happy Icon">
                <div class="cw-carousel-item__content">
                    <h3>100+ Happy Customers</h3>
                </div>
            </div>
            <div class="cw-carousel-item">
                <img src="<?php echo esc_html($homeUrl); ?>" alt="Home Icon">
                <div class="cw-carousel-item__content">
                    <h3>Hassle-Free Sales</h3>
                </div>
            </div>
        </div>
        <div class="cw-carousel-nav">
            <span class="cw-carousel-nav__button cw-carousel-nav__button--prev">
               <img src="<?php echo esc_html($arrowLeftUrl); ?>" alt="Home Icon">
            </span>
            <span class="cw-carousel-nav__button cw-carousel-nav__button--next">
               <img src="<?php echo esc_html($arrowRightUrl); ?>" alt="Home Icon">
            </span>
        </div>
    </div>
    
</div>