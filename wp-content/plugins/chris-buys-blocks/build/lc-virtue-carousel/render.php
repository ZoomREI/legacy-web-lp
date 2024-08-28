<?php
$privacyUrl = plugins_url('src/lc-virtue-carousel/assets/privacy.svg', dirname(__FILE__, 2));
$selectUrl = plugins_url('src/lc-virtue-carousel/assets/select.svg', dirname(__FILE__, 2));
$happyUrl = plugins_url('src/lc-virtue-carousel/assets/happy.svg', dirname(__FILE__, 2));
?>

<div class="lc-virtue-carousel">
    <div class="carousel-track">
        <div class="carousel-item">
            <img src="<?php echo esc_html($privacyUrl); ?>" alt="Privacy Icon">
            <div class="carousel-item__content">
                <h3>100% Safe and Secure</h3>
                <p>We’ve processed thousands of sales, offering safe, secure solutions every time.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?php echo esc_html($selectUrl); ?>" alt="Select Icon">
            <div class="carousel-item__content">
                <h3>Immediate Cash Offer</h3>
                <p>We’ll contact you within 7 minutes, with a competitive offer.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?php echo esc_html($happyUrl); ?>" alt="Happy Icon">
            <div class="carousel-item__content">
                <h3>1500+ Happy Customers</h3>
                <p>We’ve helped thousands of people in need of a quick sale on their property.</p>
            </div>
        </div>
    </div>
    <div class="carousel-dots">
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>
</div>