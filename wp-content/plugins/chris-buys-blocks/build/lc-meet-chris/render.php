<?php
$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';
?>

<section class="lc-meet-chris">
    <div class="lc-meet-chris__container">
        <div class="lc-meet-chris__content">
            <div class="lc-meet-chris__text">
                <span class="lc-meet-chris__hi">Hi, I'm <?php echo esc_html($selectedName); ?></span>
                <h2 class="lc-meet-chris__title">Have your circumstances changed and you need to sell your home quickly?</h2>
                <h3 class="lc-meet-chris__subtitle">Let me help! We are genuine homebuyers, and we buy ANY house!</h3>
                <div class="lc-meet-chris__description">
                    <p>Sometimes the unexpected happens and our plans need to change. Maybe you’re working through a divorce, need to relocate for work, or are just looking for a fresh start.</p>
                    <p>Whatever your circumstances and whatever state your home is in – it doesn’t matter to us. <strong>We’ll buy it, quickly and discreetly.</strong></p>
                    <p>All this, <strong>without the hassle.</strong> No real estate agents. No repairs or cleaning. Plus, we always make you a fair offer.</p>
                </div>
                <h3 class="lc-meet-chris__cta-text">Ready to sell your house right now?</h3>
            </div>
            <a class="lc-meet-chris__cta cta-btn" href="#lc-form">GET MY CASH OFFER NOW  <?php echo get_responsive_image('lc-meet-chris/cta-arrow', 'Arrow'); ?></a>
            <div class="lc-hero__reviews">
                <div class="lc-hero__reviews-stars-wrapper">
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-meet-chris/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-meet-chris/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-meet-chris/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-meet-chris/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-meet-chris/star', 'star'); ?></span>
                </div>
                <div class="lc-hero__reviews-text">
                    <p>Rated <strong>4.7/5</strong> | Based on <strong>100+</strong> reviews</p>
                </div>
            </div>
        </div>
        <div class="lc-meet-chris__img">
            <?php echo get_responsive_image('lc-meet-chris/'.strtolower($selectedName), esc_attr($selectedName)); ?>
        </div>
    </div>


    <div class="lc-featured-in">
        <div class="lc-featured-in__container">
            <span class="lc-featured-in__text">AS SEEN ON:</span>
            <div class="lc-featured-in__logos-wrapper">
                <div class="lc-featured-in__logos">
                    <div class="lc-featured-in__logo"><?php echo get_responsive_image('lc-meet-chris/cbs', 'CBS'); ?></div>
                    <div class="lc-featured-in__logo"><?php echo get_responsive_image('lc-meet-chris/nbc', 'NBC'); ?></div>
                    <div class="lc-featured-in__logo"><?php echo get_responsive_image('lc-meet-chris/forbes', 'Forbes'); ?></div>
                    <div class="lc-featured-in__logo"><?php echo get_responsive_image('lc-meet-chris/fox', 'FOX'); ?></div>
                </div>
            </div>
        </div>
    </div>
</section>