<?php
$selectedMarket = isset($attributes['selectedMarket']) ? esc_html($attributes['selectedMarket']) : 'St. Louis';

$selectedName = ($selectedMarket === 'The Bay Area') ? 'John' : 'Chris';

$chris_url = plugins_url('src/ao-meet-chris/assets/chris-buys.webp', dirname(__FILE__, 2));
$john_url = plugins_url('src/ao-meet-chris/assets/john-buys.webp', dirname(__FILE__, 2));

$image_url = ($selectedName === 'John') ? $john_url : $chris_url;

$star_icon_url = plugins_url('src/ao-meet-chris/assets/star.svg', dirname(__FILE__, 2));
$arrow_icon_url = plugins_url('src/ao-meet-chris/assets/cta-arrow.svg', dirname(__FILE__, 2));
?>

<section class="ao-meet-chris">
    <div class="ao-meet-chris__container">
        <div class="ao-meet-chris__content">
            <div class="ao-meet-chris__text">
                <span class="ao-meet-chris__hi">Hi, I'm <?php echo esc_html($selectedName); ?>!</span>
                <h2 class="ao-meet-chris__title">Have A House You Need To Sell FAST In <?php echo esc_html($selectedMarket); ?>?</h2>
                <h3 class="ao-meet-chris__subtitle">Let me help! We are genuine homebuyers, and we buy ANY house!</h3>
                <div class="ao-meet-chris__description">
                    <p>Maybe you’ve inherited a house, don’t want to spend money on repairs, or are having trouble managing your tenants.</p>
                    <p>Whatever your circumstances and whatever state your home is in – it doesn’t matter to us. <br><strong>We’ll buy it, and fast!</strong></p>
                    <p>All this, <strong>without the hassle.</strong> No real estate agents. No repairs or cleaning. Plus, we always make you a fair offer.</p>
                </div>
                <h3 class="ao-meet-chris__cta-text">Ready to sell your house right now?</h3>
            </div>
            <a class="cta-btn ao-meet-chris__cta" href="#ao-form">Get Fast Cash OFFER<img src="<?php echo esc_url($arrow_icon_url); ?>" alt="Arrow"></a>
            <div class="ao-hero__reviews">
                <div class="ao-hero__reviews-stars-wrapper">
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                </div>
                <div class="ao-hero__reviews-text">
                    <p>Rated <strong>4.7/5</strong> | Based on <strong>100+</strong> reviews</p>
                </div>
            </div>
        </div>
        <div class="ao-meet-chris__img">
            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($selectedName); ?>">
        </div>
    </div>
</section>