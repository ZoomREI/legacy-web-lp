<?php
$formId = isset($attributes['formId']) ? esc_html($attributes['formId']) : '1';
?>

<section class="ao-hero-wrapper" style="
    --background-image-small: url('<?php echo get_image_url('ao-hero/life-changes-hero-background', 768); ?>');
    --background-image-medium: url('<?php echo get_image_url('ao-hero/life-changes-hero-background', 1024); ?>');
    --background-image-large: url('<?php echo get_image_url('ao-hero/life-changes-hero-background', 2048); ?>');
    ">
    <div class="ao-hero">
        <div class=" ao-hero__content">
            <div class="ao-hero__reviews">
                <div class="ao-hero__reviews-stars-wrapper">
                    <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-hero/star', 'star'); ?>
                    </span>
                    <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-hero/star', 'star'); ?>
                    </span>
                    <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-hero/star', 'star'); ?>
                    </span>
                    <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-hero/star', 'star'); ?>
                    </span>
                    <span class="ao-hero__star">
                        <?php echo get_responsive_image('ao-hero/star', 'star'); ?>
                    </span>
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
                <li class="ao-hero__bullet-point"><?php echo get_responsive_image('ao-hero/check-circle', 'checkmark'); ?>
                    <span>We’ll purchase your home ‘as is’ - <strong>no cleaning or repairs needed</strong></span>
                </li>
                <li class="ao-hero__bullet-point"><?php echo get_responsive_image('ao-hero/check-circle', 'checkmark'); ?>
                    <span>Get a <strong>competitive cash offer</strong> in <strong>just 7 minutes</strong></span>
                </li>
                <li class="ao-hero__bullet-point"><?php echo get_responsive_image('ao-hero/check-circle', 'checkmark'); ?>
                    <span>We work to <strong>your timeline</strong>, you choose the closing date</span>
                </li>
            </ul>
        </div>
        <div id="ao-form" class="ao-hero__form">
            <?php echo $content; ?>
        </div>
    </div>
</section>