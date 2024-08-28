<?php
$selected_market = esc_html($attributes['selectedMarket']);
$review_text = esc_html($attributes['reviewText']);
$reviewer_name = esc_html($attributes['reviewerName']);

$google_url = esc_url(plugins_url('src/google-reviews/assets/google-5-star.webp', dirname(__FILE__, 2)));
$five_stars_url = esc_url(plugins_url('src/google-reviews/assets/5-gold-stars.webp', dirname(__FILE__, 2)));
?>

<section class="full-width banner">
    <div class="google-reviews">
        <img
            src="<?php echo $google_url; ?>"
            alt="Google 5 Star Reviews" />
        <div class="google-reviews__review">
            <p>
                “<?php echo $review_text; ?>”
            </p>
            <div class="reviewer">
                <span><?php echo $reviewer_name; ?></span>
                <img
                    src="<?php echo $five_stars_url; ?>"
                    alt="5 Star Review" />
            </div>
        </div>
    </div>
</section>