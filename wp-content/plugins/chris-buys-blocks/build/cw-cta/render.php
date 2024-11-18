<?php
$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';

$lc_cta_img_url = plugins_url('src/cw-cta/assets/lc-cta-img.webp', dirname(__FILE__, 2));
?>

<section class="cw-cta">
    <div class="cw-cta__inner">
        <div class="cw-cta__image">
            <?php echo get_responsive_image('cw-cta/lc-cta-img', 'Hassle-Free Solution'); ?>
        </div>
        <div class="cw-cta__content">
            <div class="cw-hero__reviews">
                <div class="cw-hero__reviews-stars-wrapper">
                    <span class="cw-hero__star"><?php echo get_responsive_image('cw-cta/star', 'star'); ?></span>
                    <span class="cw-hero__star"><?php echo get_responsive_image('cw-cta/star', 'star'); ?></span>
                    <span class="cw-hero__star"><?php echo get_responsive_image('cw-cta/star', 'star'); ?></span>
                    <span class="cw-hero__star"><?php echo get_responsive_image('cw-cta/star', 'star'); ?></span>
                    <span class="cw-hero__star"><?php echo get_responsive_image('cw-cta/star', 'star'); ?></span>
                </div>
                <div class="cw-hero__reviews-text">
    
                    <p>Rated <strong>4.7/5</strong> | Based on <strong>100+</strong> reviews</p>
                </div>
            </div>
            <h3>Ready To Sell Your Property?</h3>
            <h2>Get A Cash Offer In Under 7 Minutes</h2>
            <p class="cw-cta__content--description">Fill out our form and we’ll get back to you in a few minutes.</p>
            <ul>
                <li><?php echo get_responsive_image('cw-cta/check-circle', 'checkmark'); ?>Get an instant&nbsp;<strong>competitive, cash offer</strong></li>
                <li><?php echo get_responsive_image('cw-cta/check-circle', 'checkmark'); ?>We’ll buy your house in&nbsp;<strong>any condition</strong></li>
                <li><?php echo get_responsive_image('cw-cta/check-circle', 'checkmark'); ?><strong>No agent fees,</strong>&nbsp;commissions, or hidden costs</li>
            </ul>
            <a class="cw-cta__cta--button cta-btn" href="#cw-form">GET MY CASH OFFER NOW  <?php echo get_responsive_image('cw-cta/cta-arrow', 'Arrow'); ?></a>
        </div>
        <div class="cw-fresh-start__testimonial">
            <?php echo get_responsive_image('cw-fresh-start/testimonee', 'Leigh Williams', 'cw-fresh-start__testimonee'); ?>
            <div class="cw-fresh-start__testimonial--content">
                <div class="cw-hero__reviews-stars-wrapper">
                    <span class="cw-hero__star"><?php echo get_responsive_image('cw-cta/star', 'star'); ?></span>
                    <span class="cw-hero__star"><?php echo get_responsive_image('cw-cta/star', 'star'); ?></span>
                    <span class="cw-hero__star"><?php echo get_responsive_image('cw-cta/star', 'star'); ?></span>
                    <span class="cw-hero__star"><?php echo get_responsive_image('cw-cta/star', 'star'); ?></span>
                    <span class="cw-hero__star"><?php echo get_responsive_image('cw-cta/star', 'star'); ?></span>
                </div>
                <blockquote>
                    <p>"The <strong>customer service experience with <?php echo esc_html($selectedName) ?> was outstanding.</strong> From beginning to end, the process of selling my home was exemplary."</p>
                    <cite>
                        Leigh Williams <?php echo get_responsive_image('cw-cta/verified-check-circle', 'checkmark'); ?> <span class="verified">Verified customer</span></cite>
                </blockquote>
            </div>
        </div>
    </div>
</section>