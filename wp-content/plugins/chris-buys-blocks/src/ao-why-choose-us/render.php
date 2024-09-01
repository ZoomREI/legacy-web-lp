<?php
$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';

$hassle_free_url = plugins_url('src/ao-why-choose-us/assets/hassle-free.webp', dirname(__FILE__, 2));
$discreet_sale_url = plugins_url('src/ao-why-choose-us/assets/discreet-sale.webp', dirname(__FILE__, 2));
$immediate_cash_url = plugins_url('src/ao-why-choose-us/assets/immediate-cash.webp', dirname(__FILE__, 2));

$testimonee_url = plugins_url('src/ao-why-choose-us/assets/testimonee.webp', dirname(__FILE__, 2));

$star_icon_url = plugins_url('src/ao-why-choose-us/assets/star.svg', dirname(__FILE__, 2));
$arrow_icon_url = plugins_url('src/ao-why-choose-us/assets/cta-arrow.svg', dirname(__FILE__, 2));
$check_url = plugins_url('src/ao-why-choose-us/assets/check-circle.svg', dirname(__FILE__, 2));
$verified_check_url = plugins_url('src/ao-why-choose-us/assets/verified-check-circle.svg', dirname(__FILE__, 2));
?>

<section class="ao-why-choose-us">
    <div class="ao-why-choose-us__heading">
        <h2 class="ao-why-choose-us__title">Why Choose Us?</h2>
        <p class="ao-why-choose-us__subtitle">We make every step as simple as possible - we do the hard work for you.</p>
    </div>

    <div class="ao-why-choose-us__carousel">
        <div class="ao-why-choose-us__items">
            <div class="ao-why-choose-us__item">
                <div class="ao-why-choose-us__content">
                    <h3>We Offer A Fast, Hassle-Free Solution For Tired Landlords And Absentee Owners</h3>
                    <p>The truth is, a lot of people in your position see a <strong>house sale as another source of stress and anxiety.</strong> Property sales can often be complex, drawn-out processes.</p>
                    <p>But with us, <strong>you won’t need to worry about paperwork, fees, extensive repairs, or volatile property chains.</strong></p>
                    <ul>
                        <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"><span>Direct cash purchase - <strong>no property chains</strong></span></li>
                        <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"><span><strong>No cleaning or repairs</strong> needed</span></li>
                        <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"><span><strong>No paperwork</strong> or extra fees</span></li>
                    </ul>
                </div>
                <div class="ao-why-choose-us__image">
                    <img src="<?php echo esc_html($hassle_free_url); ?>" alt="Hassle-Free Solution">
                </div>
            </div>
            <div class="ao-why-choose-us__item">
                <div class="ao-why-choose-us__content">
                    <h3>We’ll Make The Sale Fast And Efficient</h3>
                    <p>Because <strong>you’re dealing directly with us and only us</strong>, there’s nothing that can go wrong. <strong>We understand the legal aspects, paperwork, and bureaucracy</strong>, and we’ll handle it so you don’t have to.</p>
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
                <div class="ao-why-choose-us__image">
                    <img src="<?php echo esc_html($discreet_sale_url); ?>" alt="Discreet Sales">
                </div>
            </div>
            <div class="ao-why-choose-us__item">
                <div class="ao-why-choose-us__content">
                    <h3>You Get An Immediate Cash Offer For Your Property</h3>
                    <p>We’re <strong>experts in closing fast property sales</strong> but we pride ourselves on making fair, competitive offers.<strong> We won’t ‘low-ball’ you and we’ll even cover the closing costs.</strong></p>
                    <ul>
                        <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"><span>Get an <strong>instant, competitive cash offer</strong></span></li>
                        <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"><span>We buy properties in <strong>as-is condition </strong>with<strong> no repricing</strong></span></li>
                        <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"><span><strong>We cover all typical closing costs</strong></span></li>
                    </ul>
                </div>
                <div class="ao-why-choose-us__image">
                    <img src="<?php echo esc_html($immediate_cash_url); ?>" alt="Immediate Cash Offer">
                </div>
            </div>
        </div>
    </div>
</section>