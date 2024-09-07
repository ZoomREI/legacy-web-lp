<?php
$formId = isset($attributes['formId']) ? esc_html($attributes['formId']) : '1';
$selectedMarket = isset($attributes['selectedMarket']) ? esc_html($attributes['selectedMarket']) : 'St. Louis, Missouri';

// Determine the name based on the selected market
if ($selectedMarket === "the Bay Area") {
    $selectedName = "John";
} else {
    $selectedName = "Chris";
}

$background_image_url = plugins_url('src/cw-hero/assets/life-changes-hero-background.webp', dirname(__FILE__, 2));
$testimonee_url = plugins_url('src/cw-hero/assets/hero-testimoniels.webp', dirname(__FILE__, 2));
$star_icon_url = plugins_url('src/cw-hero/assets/star.svg', dirname(__FILE__, 2));
$checkmark_icon_url = plugins_url('src/cw-hero/assets/check-circle.svg', dirname(__FILE__, 2));
?>

<section class="cw-hero-wrapper" style="--background-image: url('<?php echo esc_url($background_image_url); ?>');">
    <div class="cw-hero">
        <div class="cw-hero__content">
            <div class="cw-hero__reviews">
                <div class="cw-hero__reviews-stars-wrapper">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <?php endfor; ?>
                </div>
                <div class="cw-hero__reviews-text">
                    <p>Rated <strong>4.7/5</strong> | Based on <strong>100+</strong> reviews</p>
                </div>
            </div>
            <div class="cw-hero__titles">
                <h1>We Buy ANY House In <span>ANY Condition, On YOUR Timeline</span></h1>
                <p>House to sell in <?php echo esc_html($selectedMarket); ?>? <strong>Get a cash offer in just 7 minutes</strong>, and get the sale closed as soon as you want to.</p>
            </div>
            <ul class="cw-hero__bullet-points">
                <li class="cw-hero__bullet-point"><img src="<?php echo esc_url($checkmark_icon_url); ?>" alt="checkmark">
                    <span><strong>No need for you to clean</strong> or make repairs</span>
                </li>
                <li class="cw-hero__bullet-point"><img src="<?php echo esc_url($checkmark_icon_url); ?>" alt="checkmark">
                    <span>No realtors, <strong>fees, banks, commissions,</strong> or inspectors</span>
                </li>
                <li class="cw-hero__bullet-point"><img src="<?php echo esc_url($checkmark_icon_url); ?>" alt="checkmark">
                    <span>We pay all closing costs - <strong>you pay nothing</strong></span>
                </li>
            </ul>
            <div class="cw-hero__content--footer">
                <div class="cw-fresh-start__testimonial">
                    <img class="cw-fresh-start__testimonee" src="<?php echo esc_url($testimonee_url); ?>" alt="Leigh Williams">
                    <div class="cw-fresh-start__testimonial--content">
                        <blockquote>
                            <p>"We are very grateful for <?php echo esc_html($selectedName); ?> and his team's work. They were always professional and reliable, <?php echo esc_html($selectedName); ?> answered my first call right away and kept me updated throughout the whole selling process.”</p>
                            <cite>
                                <span>Liv Skyler</span>
                                <div class="cw-hero__reviews-stars-wrapper">
                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                        <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <?php endfor; ?>
                                </div>
                            </cite>
                        </blockquote>
                    </div>
                </div>
                <ul class="cw-hero__statistic--list">
                    <li class="cw-hero__statistic--item">
                        <div class="cw-hero__statistic--amunt">36M+</div>
                        <div class="cw-hero__statistic--text">Saved <span>Fees</span></div>
                    </li>
                    <li class="cw-hero__statistic--item">
                        <div class="cw-hero__statistic--amunt">1,500+</div>
                        <div class="cw-hero__statistic--text">HOUSES <span>BOUGHT</span></div>
                    </li>
                    <li class="cw-hero__statistic--item">
                        <div class="cw-hero__statistic--amunt">96%</div>
                        <div class="cw-hero__statistic--text">SATISFIED <span>CUSTOMERS</span></div>
                    </li>
                </ul>
            </div>
        </div>
        <div id="cw-form" class="cw-hero__form">
            <?php echo do_shortcode('[gravityform id="' . esc_attr($formId) . '" title="false" ajax="true"]'); ?>
        </div>
    </div>
</section>
