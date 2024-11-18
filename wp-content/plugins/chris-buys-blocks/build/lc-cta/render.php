<?php
$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';
?>

<section class="lc-cta">
    <div class="lc-cta__container">
        <div class="lc-cta__image">
            <?php echo get_responsive_image('lc-cta/lc-cta-img', 'Hassle-Free Solution'); ?>
        </div>
        <div class="lc-cta__content">
            <div class="lc-hero__reviews">
                <div class="lc-hero__reviews-stars-wrapper">
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-cta/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-cta/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-cta/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-cta/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-cta/star', 'star'); ?></span>
                </div>
                <div class="lc-hero__reviews-text">

                    <p>Rated <strong>4.7/5</strong> | Based on <strong>100+</strong> reviews</p>
                </div>
            </div>
            <h3>Ready To Sell Your House?</h3>
            <h2>Get A Cash Offer In Under 7 Minutes</h2>
            <p class="lc-cta__content--description">Fill out our form and we’ll get back to you in a few minutes.</p>
            <ul>
                <li><?php echo get_responsive_image('lc-cta/check-circle', 'checkmark'); ?>Get an instant&nbsp;<strong>competitive, cash offer</strong></li>
                <li><?php echo get_responsive_image('lc-cta/check-circle', 'checkmark'); ?>We’ll buy your house in&nbsp;<strong>any condition</strong></li>
                <li><?php echo get_responsive_image('lc-cta/check-circle', 'checkmark'); ?><strong>No agent fees,</strong>&nbsp;commissions, or hidden costs</li>
            </ul>
            <a class="lc-cta__cta--button cta-btn" href="#lc-form">GET MY CASH OFFER NOW  <?php echo get_responsive_image('lc-cta/cta-arrow', 'Arrow'); ?></a>
        </div>
        <div class="lc-fresh-start__testimonial">
            <?php echo get_responsive_image('lc-fresh-start/testimonee', 'Leigh Williams', 'lc-fresh-start__testimonee'); ?>
            <div class="lc-fresh-start__testimonial--content">
                <div class="lc-hero__reviews-stars-wrapper">
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-cta/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-cta/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-cta/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-cta/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-cta/star', 'star'); ?></span>
                </div>
                <blockquote>
                    <p>"The <strong>customer service experience with <?php echo esc_html($selectedName) ?> was outstanding.</strong> From beginning to end, the process of selling my home was exemplary."</p>
                    <cite>
                        Leigh Williams <?php echo get_responsive_image('lc-cta/verified-check-circle', 'checkmark'); ?> <span class="verified">Verified customer</span></cite>
                </blockquote>
            </div>
        </div>
    </div>
</section>