<?php
$selected_market = esc_html($attributes['selectedMarket']);

$chris_reviews = [
    'chris-review-1',
    'chris-review-2',
    'chris-review-3',
    'chris-review-4',
    'chris-review-5',
    'chris-review-6',
    'chris-review-7',
    'chris-review-8',
    'chris-review-9',
    'chris-review-10',
    'chris-review-11'
];

$john_reviews = [
    'john-review-1',
    'john-review-2',
    'john-review-3',
    'john-review-4',
    'john-review-5',
    'john-review-6',
    'john-review-7',
    'john-review-8'
];

$selected_reviews = in_array($selected_market, ['San Francisco Bay Area']) ? $john_reviews : $chris_reviews;

?>

<section id="reviews" class="reviews">
    <div class="reviews__header">
        <?php echo get_responsive_image('reviews/reviews-header', 'People Love Us, And So Will You'); ?>
    </div>
    <div class="reviews__wrapper">
        <hr />
        <?php foreach ($selected_reviews as $review) : ?>
            <div class="reviews__item">
                <?php echo get_responsive_image('reviews/'.$review, 'Review'); ?>
            </div>
            <hr />
        <?php endforeach; ?>
    </div>
</section>