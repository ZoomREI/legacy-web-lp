<?php
$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';

$darren_pilch_url = plugins_url('src/lc-testimonials/assets/darren-pilch.webp', dirname(__FILE__, 2));
$gregory_marks_url = plugins_url('src/lc-testimonials/assets/gregory-marks.webp', dirname(__FILE__, 2));

?>

<section class="lc-testimonials">
    <div class="lc-testimonials__title">
        <h2>Check Out Our Customer Reviews</h2>
        <div class="lc-hero__reviews">
            <div class="lc-hero__reviews-stars-wrapper">
                <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
            </div>
            <div class="lc-hero__reviews-text">
                <p>Rated <strong>4.7/5</strong> | Based on <strong>100+</strong> reviews</p>
            </div>
        </div>
    </div>
    <div class="lc-testimonials-carousel">
        <div class="lc-testimonials__testimonials">
            <div class="lc-testimonials__testimonial">
                <div class="lc-testimonials__testimonial--content">
                    <div class="lc-hero__reviews-stars-wrapper">
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                    </div>
                    <blockquote>
                        <p>“In a day and age where professionals in the service industry never seem to answer their phones or return calls, <strong>Chris promptly responded to my initial call,</strong> and was always available during the entire selling process."</p>
                    </blockquote>
                </div>
                <div class="lc-testimonials__person">
                    <?php echo get_responsive_image('lc-testimonials/nataly-lebedev', 'Nataly Lebedev', 'lc-testimonials__testimonee'); ?>
                    <cite>
                        Nataly Lebedev <span class="verified"> <?php echo get_responsive_image('lc-testimonials/verified-check-circle', 'checkmark'); ?>Verified customer</span></cite>
                </div>
            </div>

            <div class="lc-testimonials__testimonial">
                <div class="lc-testimonials__testimonial--content">
                    <div class="lc-hero__reviews-stars-wrapper">
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                    </div>
                    <blockquote>
                        <p>“We are very grateful for Chris and his team's work. They were always professional and reliable. <br /><br /><strong>Chris answered my first call right away</strong> and kept me updated throughout the whole selling process.”</p>
                    </blockquote>
                </div>
                <div class="lc-testimonials__person">
                    <?php echo get_responsive_image('lc-testimonials/liv-skyler', 'Liv Skyler', 'lc-testimonials__testimonee'); ?>
                    <cite>
                        Liv Skyler <span class="verified"> <?php echo get_responsive_image('lc-testimonials/verified-check-circle', 'checkmark'); ?>Verified customer</span></cite>
                </div>
            </div>

            <div class="lc-testimonials__testimonial">
                <div class="lc-testimonials__testimonial--content">
                    <div class="lc-hero__reviews-stars-wrapper">
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                    </div>
                    <blockquote>
                        <p>“<strong>Great experience working</strong> with Chris and the team. They were incredibly professional and sold our home quickly for a price we were satisfied with.”</p>
                    </blockquote>
                </div>
                <div class="lc-testimonials__person">
                    <?php echo get_responsive_image('lc-testimonials/shaked-elnatan', 'Shaked Elnatan', 'lc-testimonials__testimonee'); ?>
                    <cite>
                        Shaked Elnatan <span class="verified"> <?php echo get_responsive_image('lc-testimonials/verified-check-circle', 'checkmark'); ?>Verified customer</span></cite>
                </div>
            </div>

            <div class="lc-testimonials__testimonial">
                <div class="lc-testimonials__testimonial--content">
                    <div class="lc-hero__reviews-stars-wrapper">
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                    </div>
                    <blockquote>
                        <p>“<strong>The customer service experience with Chris was outstanding.</strong> From beginning to end, the process of selling my home was exemplary.”</p>
                    </blockquote>
                </div>
                <div class="lc-testimonials__person">
                    <?php echo get_responsive_image('lc-testimonials/leigh-williams', 'Leigh Williams', 'lc-testimonials__testimonee'); ?>
                    <cite>
                        Leigh Williams <span class="verified"> <?php echo get_responsive_image('lc-testimonials/verified-check-circle', 'checkmark'); ?>Verified customer</span></cite>
                </div>
            </div>

            <div class="lc-testimonials__testimonial">
                <div class="lc-testimonials__testimonial--content">
                    <div class="lc-hero__reviews-stars-wrapper">
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                    </div>
                    <blockquote>
                        <p>“<strong>I am quite happy with the easy, fast, stress-free process of dealing with Chris.</strong> I needed to sell my home quickly due to medical health issues. <br /><br />He made a reasonable offer, and the sale went quickly with prompt payment.”</p>
                    </blockquote>
                </div>
                <div class="lc-testimonials__person">
                    <img class="lc-testimonials__testimonee" src="<?php echo esc_url($darren_pilch_url); ?>" alt="Darren Pilch">
                    <cite>
                        Darren Pilch <span class="verified"> <?php echo get_responsive_image('lc-testimonials/verified-check-circle', 'checkmark'); ?>Verified customer</span></cite>
                </div>
            </div>

            <div class="lc-testimonials__testimonial">
                <div class="lc-testimonials__testimonial--content">
                    <div class="lc-hero__reviews-stars-wrapper">
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                        <span class="lc-hero__star"><?php echo get_responsive_image('lc-testimonials/star', 'star'); ?></span>
                    </div>
                    <blockquote>
                        <p>“<strong>Chris and his team truly exceeded my expectations.</strong> After losing my spouse, I needed to downsize and sell my home quickly. <strong>Chris made the process straightforward</strong> and was always available to answer my questions. I'm incredibly thankful for their support during such a difficult time.”</p>
                    </blockquote>
                </div>
                <div class="lc-testimonials__person">
                    <img class="lc-testimonials__testimonee" src="<?php echo esc_url($gregory_marks_url); ?>" alt="Gregory Marks">
                    <cite>
                        Gregory Marks <span class="verified"> <?php echo get_responsive_image('lc-testimonials/verified-check-circle', 'checkmark'); ?>Verified customer</span></cite>
                </div>
            </div>
        </div>
        <div class="lc-testimonials__veil"></div>
        <button class="lc-testimonials__load-more">Load More Reviews</button>
        <div class="carousel-dots">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>
</section>