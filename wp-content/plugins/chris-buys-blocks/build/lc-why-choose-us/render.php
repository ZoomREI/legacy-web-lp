<?php
$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';
?>

<section class="lc-why-choose-us">
    <div class="lc-why-choose-us__container">
        <div class="lc-why-choose-us__heading">
            <h2 class="lc-why-choose-us__title">Why Choose Us?</h2>
            <p class="lc-why-choose-us__subtitle">We make every step as simple as possible – and we do the hard work for you.</p>
        </div>

        <div class="lc-why-choose-us__carousel">
            <div class="lc-why-choose-us__items">
                <div class="lc-why-choose-us__item">
                    <div class="lc-why-choose-us__content">
                        <h3>We Offer A Fast, Hassle-Free Solution For Homeowners Whose Life Circumstances Have Changed</h3>
                        <p>Sometimes in life, changes come out of the blue and a drawn-out property sale can feel overwhelming and complicated.</p>
                        <p>But with us, <strong>you won’t need to worry about paperwork, fees, extensive repairs, or volatile property chains.</strong></p>
                        <ul>
                            <li><?php echo get_responsive_image('lc-why-choose-us/check-circle', 'checkmark'); ?>
                                <span> Direct cash purchase &nbsp;-&nbsp;<strong>no property chains</strong></span>
                            </li>
                            <li><?php echo get_responsive_image('lc-why-choose-us/check-circle', 'checkmark'); ?><span><strong>No cleaning or repairs</strong>&nbsp;needed</span></li>
                            <li><?php echo get_responsive_image('lc-why-choose-us/check-circle', 'checkmark'); ?><span><strong>No paperwork</strong>&nbsp;or extra fees</span></li>
                        </ul>
                    </div>
                    <div class="lc-why-choose-us__image">
                        <?php echo get_responsive_image('lc-why-choose-us/hassle-free', 'Hassle-Free Solution'); ?>
                    </div>
                </div>
                <div class="lc-why-choose-us__item">
                    <div class="lc-why-choose-us__content">
                        <h3>We Specialize In Discreet, Efficient Sales For People Who Need To Sell Their Property Quickly</h3>
                        <p>Whatever your circumstances, <strong>we’ll make selling your property as simple as possible.</strong></p>
                        <blockquote>"I was going through something very difficult at the time health-wise and needed cash. I was dreading a long sales process, but John made it easy."</blockquote>
                        <div class="lc-why-choose-us__testimonial">
                            <?php echo get_responsive_image('lc-why-choose-us/testimonee', 'Leigh Williams', 'lc-why-choose-us__testimonee'); ?>
                            <div class="lc-why-choose-us__testimonial--content">
                                <div class="lc-hero__reviews-stars-wrapper">
                                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-why-choose-us/star', 'star'); ?></span>
                                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-why-choose-us/star', 'star'); ?></span>
                                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-why-choose-us/star', 'star'); ?></span>
                                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-why-choose-us/star', 'star'); ?></span>
                                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-why-choose-us/star', 'star'); ?></span>
                                </div>
                                <blockquote>
                                    <p>"The <strong>customer service experience with <?php echo esc_html($selectedName) ?> was outstanding.</strong> From beginning to end, the process of selling my home was exemplary."</p>
                                    <cite>
                                        Leigh Williams <?php echo get_responsive_image('lc-why-choose-us/verified-check-circle', 'checkmark'); ?> <span class="verified">Verified customer</span></cite>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="lc-why-choose-us__image">
                        <?php echo get_responsive_image('lc-why-choose-us/discreet-sale', 'Discreet Sales'); ?>
                    </div>
                </div>
                <div class="lc-why-choose-us__item">
                    <div class="lc-why-choose-us__content">
                        <h3>You Get An Immediate Cash Offer For Your Property</h3>
                        <p>We’re experts in closing fast home sales, but we pride ourselves on making sure you’re comfortable every step of the way. With us, you get to choose when the closing occurs.</p>
                        <ul>
                            <li><?php echo get_responsive_image('lc-why-choose-us/check-circle', 'checkmark'); ?><span> Get an <strong>instant, competitive cash offer</strong></span></li>
                            <li><?php echo get_responsive_image('lc-why-choose-us/check-circle', 'checkmark'); ?> <span>We buy properties in <strong>as-is condition with no repricing</strong></span></li>
                            <li><?php echo get_responsive_image('lc-why-choose-us/check-circle', 'checkmark'); ?> <span>We cover all typical closing costs</span></li>
                        </ul>
                    </div>
                    <div class="lc-why-choose-us__image">
                        <?php echo get_responsive_image('lc-why-choose-us/immediate-cash', 'Immediate Cash Offer'); ?>
                    </div>
                </div>
            </div>
            <div class="carousel-dots">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
        <div class="lc-why-choose-us__cta">
            <a class="lc-why-choose-us__cta--button cta-btn" href="#lc-form">GET MY CASH OFFER NOW  <?php echo get_responsive_image('lc-why-choose-us/cta-arrow', 'Arrow'); ?></a>
            <div class="lc-hero__reviews">
                <div class="lc-hero__reviews-stars-wrapper">
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-why-choose-us/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-why-choose-us/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-why-choose-us/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-why-choose-us/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-why-choose-us/star', 'star'); ?></span>
                </div>
                <div class="lc-hero__reviews-text">
                    <p>Rated <strong>4.7/5</strong> | Based on <strong>100+</strong> reviews</p>
                </div>
            </div>
        </div>
    </div>
</section>