<?php
$steps1_url = plugins_url('src/ao-steps/assets/steps1.webp', dirname(__FILE__, 2));
$steps2_url = plugins_url('src/ao-steps/assets/steps2.webp', dirname(__FILE__, 2));
$steps3_url = plugins_url('src/ao-steps/assets/steps3.webp', dirname(__FILE__, 2));
?>

<section class="ao-steps">
    <div class="ao-steps__text">
        <h2>House Sales Are Complicated, Right? <br>Not With Us - Just 3 Easy Steps</h2>
        <p>We’ll make a competitive cash offer on your property in under 7 minutes.</p>
    </div>

    <div class="ao-steps__steps">
        <div class="ao-step">
            <div class="ao-step__img">
                <img src="<?php echo esc_url($steps1_url); ?>" alt="Sharing Details">
            </div>
            <div class="ao-step__content">
                <div class="ao-step__title">
                    <span class="ao-step__number">1</span>
                    <h3>Share your details with us</h3>
                </div>
                <p>We only need your property address, name, and contact details to get started. Just fill in the form above.</p>
            </div>
        </div>
        <div class="ao-step">
            <div class="ao-step__img">
                <img src="<?php echo esc_url($steps2_url); ?>" alt="Get Cash Offer">
            </div>
            <div class="ao-step__content">
                <div class="ao-step__title">
                    <span class="ao-step__number">2</span>
                    <h3>Get an immediate cash offer</h3>
                </div>
                <p>We’ll call back with a cash offer in under 7 minutes.</p>
            </div>
        </div>
        <div class="ao-step">
            <div class="ao-step__img">
                <img src="<?php echo esc_url($steps3_url); ?>" alt="Get Paid">
            </div>
            <div class="ao-step__content">
                <div class="ao-step__title">
                    <span class="ao-step__number">3</span>
                    <h3>Close and get paid</h3>
                </div>
                <p>We’ll do the hard work for you. No paperwork is required and we’ll work to your timeline.</p>
            </div>
        </div>
    </div>
</section>