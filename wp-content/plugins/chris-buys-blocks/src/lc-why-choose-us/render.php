<?php
$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';

$hassle_free_url = plugins_url('src/lc-why-choose-us/assets/hassle-free.webp', dirname(__FILE__, 2));
$discreet_sale_url = plugins_url('src/lc-why-choose-us/assets/discreet-sale.webp', dirname(__FILE__, 2));
$immediate_cash_url = plugins_url('src/lc-why-choose-us/assets/immediate-cash.webp', dirname(__FILE__, 2));

$testimonee_url = plugins_url('src/lc-why-choose-us/assets/testimonee.webp', dirname(__FILE__, 2));

$star_icon_url = plugins_url('src/lc-why-choose-us/assets/star.svg', dirname(__FILE__, 2));
$arrow_icon_url = plugins_url('src/lc-why-choose-us/assets/cta-arrow.svg', dirname(__FILE__, 2));
$check_url = plugins_url('src/lc-why-choose-us/assets/check-circle.svg', dirname(__FILE__, 2));
$verified_check_url = plugins_url('src/lc-why-choose-us/assets/verified-check-circle.svg', dirname(__FILE__, 2));
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
                            <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark">
                                <span> Direct cash purchase &nbsp;-&nbsp;<strong>no property chains</strong></span>
                            </li>
                            <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"><span><strong>No cleaning or repairs</strong>&nbsp;needed</span></li>
                            <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"><span><strong>No paperwork</strong>&nbsp;or extra fees</span></li>
                        </ul>
                    </div>
                    <div class="lc-why-choose-us__image">
                        <img src="<?php echo esc_html($hassle_free_url); ?>" alt="Hassle-Free Solution">
                    </div>
                </div>
                <div class="lc-why-choose-us__item">
                    <div class="lc-why-choose-us__content">
                        <h3>We Specialize In Discreet, Efficient Sales For People Who Need To Sell Their Property Quickly</h3>
                        <p>Whatever your circumstances, <strong>we’ll make selling your property as simple as possible.</strong></p>
                        <blockquote>"I was going through something very difficult at the time health-wise and needed cash. I was dreading a long sales process, but John made it easy."</blockquote>
                        <div class="lc-why-choose-us__testimonial">
                            <img class="lc-why-choose-us__testimonee" src="<?php echo esc_url($testimonee_url); ?>" alt="Leigh Williams">
                            <div class="lc-why-choose-us__testimonial--content">
                                <div class="lc-hero__reviews-stars-wrapper">
                                    <span class="lc-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="lc-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="lc-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="lc-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="lc-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                </div>
                                <blockquote>
                                    <p>"The <strong>customer service experience with <?php echo esc_html($selectedName) ?> was outstanding.</strong> From beginning to end, the process of selling my home was exemplary."</p>
                                    <cite>
                                        Leigh Williams <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark"> <span class="verified">Verified customer</span></cite>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="lc-why-choose-us__image">
                        <img src="<?php echo esc_html($discreet_sale_url); ?>" alt="Discreet Sales">
                    </div>
                </div>
                <div class="lc-why-choose-us__item">
                    <div class="lc-why-choose-us__content">
                        <h3>You Get An Immediate Cash Offer For Your Property</h3>
                        <p>We’re experts in closing fast home sales, but we pride ourselves on making sure you’re comfortable every step of the way. With us, you get to choose when the closing occurs.</p>
                        <ul>
                            <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"><span> Get an <strong>instant, competitive cash offer</strong></span></li>
                            <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"> <span>We buy properties in <strong>as-is condition with no repricing</strong></span></li>
                            <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"> <span>We cover all typical closing costs</span></li>
                        </ul>
                    </div>
                    <div class="lc-why-choose-us__image">
                        <img src="<?php echo esc_html($immediate_cash_url); ?>" alt="Immediate Cash Offer">
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
            <a class="lc-why-choose-us__cta--button cta-btn" href="#lc-form">GET MY CASH OFFER NOW <img src="<?php echo esc_url($arrow_icon_url); ?>" alt="Arrow"></a>
            <div class="lc-hero__reviews">
                <div class="lc-hero__reviews-stars-wrapper">
                    <span class="lc-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="lc-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="lc-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="lc-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="lc-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                </div>
                <div class="lc-hero__reviews-text">
                    <p>Rated <strong>4.7/5</strong> | Based on <strong>100+</strong> reviews</p>
                </div>
            </div>
        </div>
    </div>
</section>