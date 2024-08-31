<?php
$formId = isset($attributes['formId']) ? esc_html($attributes['formId']) : '1';

$background_image_url = plugins_url('src/lc-hero/assets/life-changes-hero-background.webp', dirname(__FILE__, 2));
$star_icon_url = plugins_url('src/lc-hero/assets/star.svg', dirname(__FILE__, 2));
$checkmark_icon_url = plugins_url('src/lc-hero/assets/check-circle.svg', dirname(__FILE__, 2));
?>

<section class="lc-hero-wrapper" style="--background-image: url('<?php echo esc_url($background_image_url); ?>');">
    <div class="lc-hero">
        <div class=" lc-hero__content">
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
            <div class="lc-hero__titles">
                <h1>Have Your Life Circumstances Changed Recently?</br>
                    In A Hurry To Move On?</br>
                    Get A Cash Offer On Your Home in 7 Minutes
                </h1>
                <p>We specialize in fast cash offers and hassle-free home sales. Whatever changes you’re going through, we’re ready to help you.</p>
            </div>
            <ul class="lc-hero__bullet-points">
                <li class="lc-hero__bullet-point"><img src="<?php echo esc_url($checkmark_icon_url); ?>" alt="checkmark">
                    <span>
                        We’ll purchase your home ‘as is’ -&nbsp;<strong>no cleaning or repairs needed</strong></span>
                </li>
                <li class="lc-hero__bullet-point"><img src="<?php echo esc_url($checkmark_icon_url); ?>" alt="checkmark">
                    <span>Get a <strong>competitive cash offer</strong> in <strong>just 7 minutes</strong></span>
                </li>
                <li class="lc-hero__bullet-point"><img src="<?php echo esc_url($checkmark_icon_url); ?>" alt="checkmark">
                    <span>We work to <strong>your timeline</strong>, you choose the closing date</span>
                </li>
            </ul>
        </div>
        <div id="lc-form" class="lc-hero__form">
            <?php echo do_shortcode('[gravityform id="' . $formId . '" title="false" ajax="false"]'); ?>
        </div>
    </div>
</section>