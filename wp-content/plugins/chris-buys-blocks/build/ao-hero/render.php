<?php
$formId = isset($attributes['formId']) ? esc_html($attributes['formId']) : '1';

$background_image_url = plugins_url('src/ao-hero/assets/life-changes-hero-background.webp', dirname(__FILE__, 2));
$star_icon_url = plugins_url('src/ao-hero/assets/star.svg', dirname(__FILE__, 2));
$checkmark_icon_url = plugins_url('src/ao-hero/assets/check-circle.svg', dirname(__FILE__, 2));
?>

<section class="ao-hero-wrapper" style="--background-image: url('<?php echo esc_url($background_image_url); ?>');">
    <div class="ao-hero">
        <div class=" ao-hero__content">
            <div class="ao-hero__reviews">
                <div class="ao-hero__reviews-stars-wrapper">
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                </div>
                <div class="ao-hero__reviews-text">
                    <p>Rated <strong>4.7/5</strong> | Based on <strong>100+</strong> reviews</p>
                </div>
            </div>
            <div class="ao-hero__titles">
                <h1>Are You An Absentee
                    <br>Owner Or Landlord?
                    <br>Get A Cash Offer On Your
                    <br>Property in 7 Minutes
                </h1>
                <p>Looking for a stress-free property sale? Get an immediate cash offer on your property. No commissions and no repairs are needed.</p>
            </div>
            <ul class="ao-hero__bullet-points">
                <li class="ao-hero__bullet-point"><img src="<?php echo esc_url($checkmark_icon_url); ?>" alt="checkmark">
                    <span>We’ll purchase your home ‘as is’ - <strong>no cleaning or repairs needed</strong></span>
                </li>
                <li class="ao-hero__bullet-point"><img src="<?php echo esc_url($checkmark_icon_url); ?>" alt="checkmark">
                    <span>Get a <strong>competitive cash offer</strong> in <strong>just 7 minutes</strong></span>
                </li>
                <li class="ao-hero__bullet-point"><img src="<?php echo esc_url($checkmark_icon_url); ?>" alt="checkmark">
                    <span>We work to <strong>your timeline</strong>, you choose the closing date</span>
                </li>
            </ul>
        </div>
        <div id="ao-form" class="ao-hero__form">
            <?php echo $content; ?>
        </div>
    </div>
</section>