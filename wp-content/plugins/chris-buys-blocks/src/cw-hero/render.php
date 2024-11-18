<?php
// $formId = isset($attributes['formId']) ? esc_html($attributes['formId']) : '1';
$selectedMarket = isset($attributes['selectedMarket']) ? esc_html($attributes['selectedMarket']) : 'St. Louis, Missouri';

// Determine the name based on the selected market
if ($selectedMarket === "the Bay Area") {
    $selectedName = "John";
} else {
    $selectedName = "Chris";
}
?>

<section class="cw-hero-wrapper" style="
    --background-image-small: url('<?php echo get_image_url('cw-hero/life-changes-hero-background', 768); ?>');
    --background-image-medium: url('<?php echo get_image_url('cw-hero/life-changes-hero-background', 1024); ?>');
    --background-image-large: url('<?php echo get_image_url('cw-hero/life-changes-hero-background', 2048); ?>');
    ">
    <div class="cw-hero__content">
        <div class="cw-hero__reviews">
            <div class="cw-hero__reviews-stars-wrapper">
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <span class="cw-hero__star"><?php echo get_responsive_image('cw-hero/star', 'star'); ?></span>
                <?php endfor; ?>
            </div>
            <div class="cw-hero__reviews-text">
                <p>Rated <strong>4.7/5</strong> | Based on <strong>100+</strong> reviews</p>
            </div>
        </div>
        <h1 class="cw-hero__title">We Buy ANY House In <span>ANY Condition, On YOUR Timeline</span></h1>
        <div id="cw-form" class="cw-hero__form">
            <?php echo $content; ?>
        </div>
        <h3 class="cw-hero__subtitle">House to sell in <?php echo esc_html($selectedMarket); ?>? <strong>Get a cash offer in just 7 minutes</strong>, and get the sale closed as soon as you want to.</h3>
        <ul class="cw-hero__bullet-points">
            <li class="cw-hero__bullet-point"><?php echo get_responsive_image('cw-hero/check-circle', 'checkmark'); ?>
                <span><strong>No need for you to clean</strong> or make repairs</span>
            </li>
            <li class="cw-hero__bullet-point"><?php echo get_responsive_image('cw-hero/check-circle', 'checkmark'); ?>
                <span>No realtors, <strong>fees, banks, commissions,</strong> or inspectors</span>
            </li>
            <li class="cw-hero__bullet-point"><?php echo get_responsive_image('cw-hero/check-circle', 'checkmark'); ?>
                <span>We pay all closing costs - <strong>you pay nothing</strong></span>
            </li>
        </ul>
        <div class="cw-hero__content--footer">
            <div class="cw-fresh-start__testimonial">
                <?php echo get_responsive_image('cw-hero/hero-testimoniels', 'Leigh Williams', 'cw-fresh-start__testimonee'); ?>
                <div class="cw-fresh-start__testimonial--content">
                    <blockquote>
                        <p>"We are very grateful for <?php echo esc_html($selectedName); ?> and his team's work. They were always professional and reliable, <?php echo esc_html($selectedName); ?> answered my first call right away and kept me updated throughout the whole selling process.”</p>
                        <cite>
                            <span>Liv Skyler</span>
                            <div class="cw-hero__reviews-stars-wrapper">
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                    <span class="cw-hero__star"><?php echo get_responsive_image('cw-hero/star', 'star'); ?></span>
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
</section>