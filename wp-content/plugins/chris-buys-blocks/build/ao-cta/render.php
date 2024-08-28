<?php
$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';

$lc_cta_img_url = plugins_url('src/ao-cta/assets/lc-cta-img.webp', dirname(__FILE__, 2));

$testimonee_url = plugins_url('src/ao-fresh-start/assets/testimonee.webp', dirname(__FILE__, 2));

$star_icon_url = plugins_url('src/ao-cta/assets/star.svg', dirname(__FILE__, 2));
$arrow_icon_url = plugins_url('src/ao-cta/assets/cta-arrow.svg', dirname(__FILE__, 2));
$check_url = plugins_url('src/ao-cta/assets/check-circle.svg', dirname(__FILE__, 2));
$verified_check_url = plugins_url('src/ao-cta/assets/verified-check-circle.svg', dirname(__FILE__, 2));
?>

<section class="ao-cta">
    <div class="ao-cta__inner">
        <div class="ao-cta__image">
            <img src="<?php echo esc_html($lc_cta_img_url); ?>" alt="Hassle-Free Solution">
        </div>
        <div class="ao-cta__content">
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
            <h3>Ready To Sell Your Property?</h3>
            <h2>Get A Cash Offer In Under 7 Minutes</h2>
            <p class="ao-cta__content--description">Fill out our form and we’ll get back to you in a few minutes.</p>
            <ul>
                <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark">Get an instant&nbsp;<strong>competitive, cash offer</strong></li>
                <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark">We’ll buy your house in&nbsp;<strong>any condition</strong></li>
                <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"><strong>No agent fees,</strong>&nbsp;commissions, or hidden costs</li>
            </ul>
            <a class="ao-cta__cta--button" href="#ao-form">GET MY CASH OFFER NOW <img src="<?php echo esc_url($arrow_icon_url); ?>" alt="Arrow"></a>
        </div>
        <div class="ao-fresh-start__testimonial">
            <img class="ao-fresh-start__testimonee" src="<?php echo esc_url($testimonee_url); ?>" alt="Leigh Williams">
            <div class="ao-fresh-start__testimonial--content">
                <div class="ao-hero__reviews-stars-wrapper">
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                </div>
                <blockquote>
                    <p>"The <strong>customer service experience with <?php echo esc_html($selectedName) ?> was outstanding.</strong> From beginning to end, the process of selling my home was exemplary."</p>
                    <cite>
                        Leigh Williams <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark"> <span class="verified">Verified customer</span></cite>
                </blockquote>
            </div>
        </div>
    </div>
</section>