<?php
$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';

$testimonee_url = plugins_url('src/cw-fresh-start/assets/testimonee.webp', dirname(__FILE__, 2));

$star_icon_url = plugins_url('src/cw-fresh-start/assets/star.svg', dirname(__FILE__, 2));
$check_url = plugins_url('src/cw-fresh-start/assets/check-circle.svg', dirname(__FILE__, 2));

$arrow_icon_url = plugins_url('src/cw-fresh-start/assets/cta-arrow.svg', dirname(__FILE__, 2));

$emotional_url = plugins_url('src/cw-fresh-start/assets/emotial.svg', dirname(__FILE__, 2));
$time_url = plugins_url('src/cw-fresh-start/assets/time.svg', dirname(__FILE__, 2));
$select_url = plugins_url('src/cw-fresh-start/assets/select.svg', dirname(__FILE__, 2));
$home_url = plugins_url('src/cw-fresh-start/assets/home.svg', dirname(__FILE__, 2));
?>

<section class="cw-fresh-start">
    <div class="cw-fresh-start__inner">
       <div class="cw-fresh-start__intro">
           <h2>Recently Inherited A Property?</h2>
           <p class="cw-fresh-start__intro-p">Many people find it difficult and time-consuming to inherit a property.</p>
       </div>
       <div class="cw-fresh-start__reasons">
           <div class="cw-reason">
               <div class="cw-reason__icon">
                   <img src="<?php echo esc_url($emotional_url); ?>" alt="Emotional Burden">
               </div>
               <div class="cw-reason__content">
                   <h3>Emotional Burden</h3>
                   <p>Inheriting a property after the passing of a family member can be emotionally challenging and stressful and it may prevent you from moving on.</p>
               </div>
           </div>
           <div class="cw-reason">
               <div class="cw-reason__icon">
                   <img src="<?php echo esc_url($home_url); ?>" alt="Maintenance Challenges">
   
               </div>
               <div class="cw-reason__content">
                   <h3>Maintenance Challenges</h3>
                   <p>If the property isn’t local, it can be difficult and impractical for you to manage it from a distance.</p>
               </div>
           </div>
           <div class="cw-reason">
               <div class="cw-reason__icon">
                   <img src="<?php echo esc_url($select_url); ?>" alt="Financial Strain">
               </div>
               <div class="cw-reason__content">
                   <h3>Financial Strain</h3>
                   <p>There are numerous costs associated with owning and maintaining an extra property, including taxes, insurance, and repair costs. This can place an unwanted financial burden on you.</p>
               </div>
           </div>
           <div class="cw-reason">
               <div class="cw-reason__icon">
                   <img src="<?php echo esc_url($time_url); ?>" alt="Time Constraints">
               </div>
               <div class="cw-reason__content">
                   <h3>Time Constraints</h3>
                   <p>You may lack the time to deal with property management, tenant issues, or even preparing the property for sale.</p>
               </div>
           </div>
       </div>
   
       <a class="cw-fresh-start__cta cta-btn" href="#cw-form">Get Fast Cash OFFER<img src="<?php echo esc_url($arrow_icon_url); ?>" alt="Arrow"></a>
       <div class="cw-hero__reviews">
           <div class="cw-hero__reviews-stars-wrapper">
               <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
               <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
               <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
               <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
               <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
           </div>
           <div class="cw-hero__reviews-text">
               <p>Rated <strong>4.7/5</strong> | Based on <strong>100+</strong> reviews</p>
           </div>
       </div>
   
       <div class="cw-fresh-start__testimonial">
           <img class="cw-fresh-start__testimonee" src="<?php echo esc_url($testimonee_url); ?>" alt="Leigh Williams">
           <div class="cw-fresh-start__testimonial--content">
               <div class="cw-hero__reviews-stars-wrapper">
                   <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                   <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                   <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                   <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                   <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
               </div>
               <blockquote>
                   <p>"The <strong>customer service experience with <?php echo esc_html($selectedName) ?> was outstanding.</strong> From beginning to end, the process of selling my home was exemplary."</p>
                   <cite>
                       Leigh Williams <img src="<?php echo esc_url($check_url); ?>" alt="checkmark"> <span class="verified">Verified customer</span></cite>
               </blockquote>
           </div>
       </div>
    </div>
    
</section>