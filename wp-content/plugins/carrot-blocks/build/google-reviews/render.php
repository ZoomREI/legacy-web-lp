<?php
$selected_market = esc_html($attributes['selectedMarket']);
$review_text = esc_html($attributes['reviewText']);
$reviewer_name = esc_html($attributes['reviewerName']);
?>

<section class="full-width banner">
    <div class="google-reviews">
        <?php echo get_responsive_image('google-reviews/google-5-star', 'Google 5 Star Reviews'); ?>
        <div class="google-reviews__review">
            <p>
                “<?php echo $review_text; ?>”
            </p>
            <div class="reviewer">
                <span><?php echo $reviewer_name; ?></span>
                <?php echo get_responsive_image('google-reviews/5-gold-stars', '5 Star Review'); ?>
            </div>
        </div>
    </div>
</section>