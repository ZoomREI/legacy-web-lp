<?php
$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';



$arrow_icon_url = plugins_url('src/ao-property-management/assets/cta-arrow.svg', dirname(__FILE__, 2));
?>

<section class="ao-property-management">
    <div class="ao-property-management__inner">
         <div class="ao-property-management__title">
             <h2>Exhausted Or Stressed Out By Property Management? We Can Help!</h2>
         </div>
         <div class="ao-property-management__image">
             <?php echo get_responsive_image('ao-property-management/lc-cta-img', 'Hassle-Free Solution'); ?>
         </div>
         <div class="ao-property-management__content">
             <h3 class="ao-property-management__content--subtitle">Most landlords struggle with one or more of the following:</h3>
             <ul>
                 <li><?php echo get_responsive_image('ao-property-management/icon-circle', 'checkmark'); ?>Late rent payments</li>
                 <li><?php echo get_responsive_image('ao-property-management/icon-circle', 'checkmark'); ?>Emergency repairs</li>
                 <li><?php echo get_responsive_image('ao-property-management/icon-circle', 'checkmark'); ?>Stress from managing multiple properties</li>
                 <li><?php echo get_responsive_image('ao-property-management/icon-circle', 'checkmark'); ?>Rising insurance costs</li>
                 <li><?php echo get_responsive_image('ao-property-management/icon-circle', 'checkmark'); ?>Taxes, utilities, and insurance payments</li>
                 <li><?php echo get_responsive_image('ao-property-management/icon-circle', 'checkmark'); ?>Finding the time to manage everything above!</li>
             </ul>
             <p class="ao-property-management__content--description">If you no longer want to deal with property management but are worried about the time, effort, and cost of a quick sale. We’ve got you.</p>
         </div>
         <div class="ao-fresh-start__testimonial">
             <?php echo get_responsive_image('ao-fresh-start/testimonee', 'Leigh Williams', 'ao-fresh-start__testimonee'); ?>
             <div class="ao-fresh-start__testimonial--content">
                 <div class="ao-hero__reviews-stars-wrapper">
                     <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-property-management/star', 'star'); ?>
                    </span>
                     <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-property-management/star', 'star'); ?>
                    </span>
                     <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-property-management/star', 'star'); ?>
                    </span>
                     <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-property-management/star', 'star'); ?>
                    </span>
                     <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-property-management/star', 'star'); ?>
                    </span>
                 </div>
                 <blockquote>
                     <p>"The <strong>customer service experience with <?php echo esc_html($selectedName) ?> was outstanding.</strong> From beginning to end, the process of selling my home was exemplary."</p>
                     <cite>
                         Leigh Williams <?php echo get_responsive_image('ao-property-management/verified-check-circle', 'checkmark'); ?> <span class="verified">Verified customer</span></cite>
                 </blockquote>
             </div>
         </div>
    </div>
</section>