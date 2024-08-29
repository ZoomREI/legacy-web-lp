<?php
$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';

$we_bay_url = plugins_url('src/cw-why-choose-us/assets/why-choose-foto--1.webp', dirname(__FILE__, 2));
$hassle_free_url = plugins_url('src/cw-why-choose-us/assets/why-choose-foto--2.webp', dirname(__FILE__, 2));
$pay_all_url = plugins_url('src/cw-why-choose-us/assets/why-choose-foto--3.webp', dirname(__FILE__, 2));

$testimonee_1_url = plugins_url('src/cw-why-choose-us/assets/why-choose-testimoniels-foto--1.webp', dirname(__FILE__, 2));
$testimonee_2_url = plugins_url('src/cw-why-choose-us/assets/why-choose-testimoniels-foto--2.webp', dirname(__FILE__, 2));
$testimonee_3_url = plugins_url('src/cw-why-choose-us/assets/why-choose-testimoniels-foto--3.webp', dirname(__FILE__, 2));

$star_icon_url = plugins_url('src/cw-why-choose-us/assets/star.svg', dirname(__FILE__, 2));
$arrow_icon_url = plugins_url('src/cw-why-choose-us/assets/cta-arrow.svg', dirname(__FILE__, 2));
$check_url = plugins_url('src/cw-why-choose-us/assets/check-circle.svg', dirname(__FILE__, 2));
$verified_check_url = plugins_url('src/cw-why-choose-us/assets/verified-check-circle.svg', dirname(__FILE__, 2));
?>

<section id='benefits' class="cw-why-choose-us">
    <div class="cw-why-choose-us__heading">
        <p class="cw-why-choose-us__prevtitle">benefits</p>
        <h2 class="cw-why-choose-us__title">Choosing Us Is A No-Brainer</h2>
        <p class="cw-why-choose-us__subtitle">We make selling your house in St. Louis insanely easy</p>
    </div>
    <div class="cw-why-choose-us__carousel">
        <div class="cw-why-choose-us__items">
            <div class="cw-why-choose-us__item">
                <div class="cw-why-choose-us__content">
                    <h3>We Buy Houses In All Price Ranges & Conditions</h3>
                    <p>We purchase homes at every point on the spectrum. Our cash offers stand firm whether your place is big or small, flashy or dated, move-in ready, or a total fixer-upper. We truly buy all types of houses at ALL price points.</p>
                    <ul>
                        <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"><span><strong>Any place, </strong>any size, anywhere</span></li>
                        <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"><span>Needs repairs/renovation? <strong>We still buy</strong></span></li>
                        <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"><span><strong>No cleaning </strong>or work required</span></li>
                    </ul>
                    <div class="cw-fresh-start__testimonial">
                          <img class="cw-fresh-start__testimonee" src="<?php echo esc_url($testimonee_1_url); ?>" alt="Darren Pilch">
                          <div class="cw-fresh-start__testimonial--content">
                              <blockquote>
                                  <p>“I am quite happy with the easy, fast, stress-free process of dealing with <?php echo esc_html($selectedName) ?>. I needed to rehab this property that sat vacant too long. They made a reasonable offer and the sale went quickly with prompt payment.”</p>
                                 <cite>
                                     <span>Darren Pilch</span>
                                     <div class="cw-hero__reviews-stars-wrapper">
                                          <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                          <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                          <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                          <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                          <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                      </div>
                                 </cite>
                              </blockquote>
                          </div>
                     </div>
                </div>
                <div class="cw-why-choose-us__image">
                    <img src="<?php echo esc_html($we_bay_url); ?>" alt="Buy Houses In All Price Ranges & Conditions">
                </div>
            </div>
            <div class="cw-why-choose-us__item">
                <div class="cw-why-choose-us__content">
                    <h3>No Realtors, Inspections, Or Any Kind Of Hassle</h3>
                    <p>Selling your home does not need to mean months of hassle and hurdles. Our quick and easy process means less headaches and hiccups between you and your cash payout. Move on to the next chapter, ASAP.</p>
                    <ul>
                        <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"><span><strong>Zero middlemen</strong>, costs, or commissions</span></li>
                        <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"><span>Skip tedious<strong> nitpicking inspections</strong></span></li>
                        <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"><span><strong>Cash offers </strong>with no financing risks</span></li>
                    </ul>
                    <div class="cw-fresh-start__testimonial">
                          <img class="cw-fresh-start__testimonee" src="<?php echo esc_url($testimonee_2_url); ?>" alt="Leigh Williams">
                          <div class="cw-fresh-start__testimonial--content">
                              <blockquote>
                                  <p> “Great experience working with <?php echo esc_html($selectedName) ?> and the team. They were incredibly professional and sold our home quickly for a price we were satisfied with."</p>
                                 <cite>
                                     <span>Shaked Elnatan</span>
                                     <div class="cw-hero__reviews-stars-wrapper">
                                          <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                          <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                          <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                          <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                          <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                      </div>
                                 </cite>
                              </blockquote>
                          </div>
                     </div>
                </div>
                <div class="cw-why-choose-us__image">
                    <img src="<?php echo esc_html($hassle_free_url); ?>" alt="Hassle-Free Solution">
                </div>
            </div>
            <div class="cw-why-choose-us__item">
                <div class="cw-why-choose-us__content">
                    <h3>We Don’t “Low Ball” You. And We Pay All Closing Costs</h3>
                    <p>Get a fair, competitive, all-cash offer that’s right for your property. What you see is what you get – with no hidden fees or financial surprises sprung on you down the track. For your added peace of mind, we take care of all closing costs ourselves.</p>
                    <ul>
                        <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"><span><strong>Reasonable valuations</strong>, no “low ball” tactics</span></li>
                        <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"><span><strong>As-is condition </strong>with no repricing games</span></li>
                        <li><img src="<?php echo esc_url($check_url); ?>" alt="checkmark"><span>All typical<strong> closing costs covered by us</strong></span></li>
                    </ul>
                    <div class="cw-fresh-start__testimonial">
                          <img class="cw-fresh-start__testimonee" src="<?php echo esc_url($testimonee_3_url); ?>" alt="Leigh Williams">
                          <div class="cw-fresh-start__testimonial--content">
                              <blockquote>
                                  <p>"We are very grateful for Chris and his team's work. They were always professional and reliable, <?php echo esc_html($selectedName) ?> answered my first call right away and kept me updated throughout the whole selling process.”</p>
                                 <cite>
                                     <span>Liv Skyler</span>
                                     <div class="cw-hero__reviews-stars-wrapper">
                                          <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                          <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                          <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                          <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                          <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                      </div>
                                 </cite>
                              </blockquote>
                          </div>
                     </div>
                </div>
                <div class="cw-why-choose-us__image">
                    <img src="<?php echo esc_html($pay_all_url); ?>" alt="Pay All Closing Costs">
                </div>
            </div>
        
        </div>
    </div>
</section>