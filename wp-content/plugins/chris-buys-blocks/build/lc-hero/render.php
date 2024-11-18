<?php
$formId = isset($attributes['formId']) ? esc_html($attributes['formId']) : '1';
?>

<section class="lc-hero-wrapper" style="
    --background-image-small: url('<?php echo get_image_url('lc-hero/life-changes-hero-background', 768); ?>');
    --background-image-medium: url('<?php echo get_image_url('lc-hero/life-changes-hero-background', 1024); ?>');
    --background-image-large: url('<?php echo get_image_url('lc-hero/life-changes-hero-background', 2048); ?>');
    ">
    <div class="lc-hero">
        <div class=" lc-hero__content">
            <div class="lc-hero__reviews">
                <div class="lc-hero__reviews-stars-wrapper">
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-hero/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-hero/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-hero/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-hero/star', 'star'); ?></span>
                    <span class="lc-hero__star"><?php echo get_responsive_image('lc-hero/star', 'star'); ?></span>
                </div>
                <div class="lc-hero__reviews-text">
                    <p>Rated <strong>4.7/5</strong> | Based on <strong>100+</strong> reviews</p>
                </div>
            </div>
            <div class="lc-hero__titles">
                <h1>Have Your Life Circumstances Changed Recently?</br>
                    In A Hurry To Move On?</br>
                    Get A Cash Offer On Your Home in 7 Minutes
                </h1>
                <p>We specialize in fast cash offers and hassle-free home sales. Whatever changes you’re going through, we’re ready to help you.</p>
            </div>
            <ul class="lc-hero__bullet-points">
                <li class="lc-hero__bullet-point"><?php echo get_responsive_image('lc-hero/check-circle', 'checkmark'); ?>
                    <span>
                        We’ll purchase your home ‘as is’ -&nbsp;<strong>no cleaning or repairs needed</strong></span>
                </li>
                <li class="lc-hero__bullet-point"><?php echo get_responsive_image('lc-hero/check-circle', 'checkmark'); ?>
                    <span>Get a <strong>competitive cash offer</strong> in <strong>just 7 minutes</strong></span>
                </li>
                <li class="lc-hero__bullet-point"><?php echo get_responsive_image('lc-hero/check-circle', 'checkmark'); ?>
                    <span>We work to <strong>your timeline</strong>, you choose the closing date</span>
                </li>
            </ul>
        </div>
        <div id="lc-form" class="lc-hero__form">
            <?php echo $content; ?>
        </div>
    </div>
</section>