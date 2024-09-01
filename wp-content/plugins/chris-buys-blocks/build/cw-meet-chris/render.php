<?php
$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';

$chris_url = plugins_url('src/cw-meet-chris/assets/meet-cris-foto.webp', dirname(__FILE__, 2));
$john_url = plugins_url('src/cw-meet-chris/assets/meet-john-foto.webp', dirname(__FILE__, 2));

$image_url_variable = strtolower($selectedName) . "_url";
$image_url = $$image_url_variable;

$fon_url = plugins_url('src/cw-meet-chris/assets/meet-cris-fon.webp', dirname(__FILE__, 2));
$star_icon_url = plugins_url('src/cw-meet-chris/assets/star.svg', dirname(__FILE__, 2));
$arrow_icon_url = plugins_url('src/cw-meet-chris/assets/cta-arrow.svg', dirname(__FILE__, 2));
?>

<section id='about' class="cw-meet-chris">
    <div class="cw-meet-chris__media">
        <img src="<?php echo esc_url($fon_url); ?>" alt="image fon" class="cw-meet-chris__media--fon">
         <div class="cw-meet-chris__foto">
           <img  src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($selectedName); ?>" class="">
        </div>
    </div>
    <div class="cw-meet-chris__container">
        <div class="cw-meet-chris__content"> 
            <div class="cw-meet-chris__text">
                <span class="cw-meet-chris__hi">Hi, I'm <?php echo esc_html($selectedName); ?>!</span>
                <h2 class="cw-meet-chris__title">Got A House You Need To Sell In St. Louis?</h2>
                <h3 class="cw-meet-chris__subtitle">Let me help! We are genuine homebuyers, and we buy ANY house!</h3>
                <div class="cw-meet-chris__description">
                    <p>It might be that you’ve inherited a house, are behind on payments, don’t want to spend money on repairs, or need to relocate in a hurry. Whatever your circumstance or whatever state your home is in – it doesn’t matter to us. <strong>We’ll buy it, and fast!</strong></p>
                    <p>All this, <strong>without the hassle.</strong> No real estate agents. No inspections. No repairs or cleaning. Plus, we always make you a fair offer and pay the closing costs ourselves.</p>
                </div>
                <h3 class="cw-meet-chris__cta-text">Ready to sell your house right now?</h3>
            </div>
            <div class="cw-meet-chris__footer-block">
               <a class="cw-meet-chris__cta" href="#cw-form">Get my offer<img src="<?php echo esc_url($arrow_icon_url); ?>" alt="Arrow"></a>
               <div class="cw-hero__reviews">
                   <div class="cw-hero__reviews-stars-wrapper">
                       <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                       <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                       <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                       <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                       <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                   </div>
                   <div class="cw-hero__reviews-text">
                       <p>Rated <strong>4.7/5</strong> Based on <strong>100+</strong> reviews</p>
                   </div>
               </div>
            </div>
        </div>
    </div>
</section>