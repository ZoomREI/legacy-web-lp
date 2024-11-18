<?php
$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';
?>

<section class="ao-cta">
    <div class="ao-cta__inner">
        <div class="ao-cta__image">
            <?php echo get_responsive_image('ao-cta/lc-cta-img', 'Hassle-Free Solution'); ?>
        </div>
        <div class="ao-cta__content">
            <div class="ao-hero__reviews">
                <div class="ao-hero__reviews-stars-wrapper">
                    <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-cta/star', 'star'); ?>
                    </span>
                    <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-cta/star', 'star'); ?>
                    </span>
                    <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-cta/star', 'star'); ?>
                    </span>
                    <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-cta/star', 'star'); ?>
                    </span>
                    <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-cta/star', 'star'); ?>
                    </span>
                </div>
                <div class="ao-hero__reviews-text">
    
                    <p>Rated <strong>4.7/5</strong> | Based on <strong>100+</strong> reviews</p>
                </div>
            </div>
            <h3>Ready To Sell Your Property?</h3>
            <h2>Get A Cash Offer In Under 7 Minutes</h2>
            <p class="ao-cta__content--description">Fill out our form and we’ll get back to you in a few minutes.</p>
            <ul>
                <li><?php echo get_responsive_image('ao-cta/check-circle', 'checkmark'); ?>Get an instant <strong>competitive, cash offer</strong></li>
                <li><?php echo get_responsive_image('ao-cta/check-circle', 'checkmark'); ?>We’ll buy your house in&nbsp;<strong>any condition</strong></li>
                <li><?php echo get_responsive_image('ao-cta/check-circle', 'checkmark'); ?><strong>No agent fees,</strong>commissions, or hidden costs</li>
            </ul>
            <a class="cta-btn ao-cta__cta--button cta-btn" href="#ao-form">GET MY CASH OFFER NOW  <?php echo get_responsive_image('ao-cta/cta-arrow', 'Arrow'); ?></a>
        </div>
        <div class="ao-fresh-start__testimonial">
            <?php echo get_responsive_image('ao-fresh-start/testimonee', 'Leigh Williams', 'ao-fresh-start__testimonee'); ?>
            <div class="ao-fresh-start__testimonial--content">
                <div class="ao-hero__reviews-stars-wrapper">
                    <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-cta/star', 'star'); ?>
                    </span>
                    <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-cta/star', 'star'); ?>
                    </span>
                    <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-cta/star', 'star'); ?>
                    </span>
                    <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-cta/star', 'star'); ?>
                    </span>
                    <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-cta/star', 'star'); ?>
                    </span>
                </div>
                <blockquote>
                    <p>"The <strong>customer service experience with <?php echo esc_html($selectedName) ?> was outstanding.</strong> From beginning to end, the process of selling my home was exemplary."</p>
                    <cite>
                        Leigh Williams <?php echo get_responsive_image('ao-cta/verified-check-circle', 'checkmark'); ?> <span class="verified">Verified customer</span></cite>
                </blockquote>
            </div>
        </div>
    </div>
</section>