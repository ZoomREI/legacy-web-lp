<?php
$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';

$lc_property_management_img_url = plugins_url('src/cw-property-management/assets/lc-cta-img.webp', dirname(__FILE__, 2));

$testimonee_url = plugins_url('src/cw-fresh-start/assets/testimonee.webp', dirname(__FILE__, 2));

$star_icon_url = plugins_url('src/cw-property-management/assets/star.svg', dirname(__FILE__, 2));
$arrow_icon_url = plugins_url('src/cw-property-management/assets/cta-arrow.svg', dirname(__FILE__, 2));
$circle_icon_url = plugins_url('src/cw-property-management/assets/icon-circle.svg', dirname(__FILE__, 2));
$verified_check_url = plugins_url('src/cw-property-management/assets/verified-check-circle.svg', dirname(__FILE__, 2));
?>

<section class="cw-property-management">
    <div class="cw-property-management__inner">
         <div class="cw-property-management__title">
             <h2>Exhausted Or Stressed Out By Property Management? We Can Help!</h2>
         </div>
         <div class="cw-property-management__image">
             <img src="<?php echo esc_html($lc_property_management_img_url); ?>" alt="Hassle-Free Solution">
         </div>
         <div class="cw-property-management__content">
             <h3 class="cw-property-management__content--subtitle">Most landlords struggle with one or more of the following:</h3>
             <ul>
                 <li><img src="<?php echo esc_url($circle_icon_url); ?>" alt="checkmark">Late rent payments</li>
                 <li><img src="<?php echo esc_url($circle_icon_url); ?>" alt="checkmark">Emergency repairs</li>
                 <li><img src="<?php echo esc_url($circle_icon_url); ?>" alt="checkmark">Stress from managing multiple properties</li>
                 <li><img src="<?php echo esc_url($circle_icon_url); ?>" alt="checkmark">Rising insurance costs</li>
                 <li><img src="<?php echo esc_url($circle_icon_url); ?>" alt="checkmark">Taxes, utilities, and insurance payments</li>
                 <li><img src="<?php echo esc_url($circle_icon_url); ?>" alt="checkmark">Finding the time to manage everything above!</li>
             </ul>
             <p class="cw-property-management__content--description">If you no longer want to deal with property management but are worried about the time, effort, and cost of a quick sale. We’ve got you.</p>
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
                         Leigh Williams <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark"> <span class="verified">Verified customer</span></cite>
                 </blockquote>
             </div>
         </div>
    </div>
</section>