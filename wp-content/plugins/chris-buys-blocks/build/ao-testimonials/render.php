<?php
$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';

$nataly_lebedev_url = plugins_url('src/ao-testimonials/assets/nataly-lebedev.webp', dirname(__FILE__, 2));
$darren_pilch_url = plugins_url('src/ao-testimonials/assets/darren-pilch.webp', dirname(__FILE__, 2));
$liv_skyler_url = plugins_url('src/ao-testimonials/assets/liv-skyler.webp', dirname(__FILE__, 2));
$shaked_elnatan_url = plugins_url('src/ao-testimonials/assets/shaked-elnatan.webp', dirname(__FILE__, 2));
$leigh_williams_url = plugins_url('src/ao-testimonials/assets/leigh-williams.webp', dirname(__FILE__, 2));
$gregory_marks_url = plugins_url('src/ao-testimonials/assets/gregory-marks.webp', dirname(__FILE__, 2));

$star_icon_url = plugins_url('src/ao-testimonials/assets/star.svg', dirname(__FILE__, 2));
$verified_check_url = plugins_url('src/ao-testimonials/assets/verified-check-circle.svg', dirname(__FILE__, 2));
?>

<section class="ao-testimonials">
    <div class="ao-testimonials__title">
        <h2>Check Out Our Customer Reviews</h2>
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
    </div>
    <div class="ao-testimonials__testimonials">
        <div class="ao-testimonials__testimonial">
            <div class="ao-testimonials__testimonial--content">
                <div class="ao-hero__reviews-stars-wrapper">
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                </div>
                <blockquote>
                    <p>“In a day and age where professionals in the service industry never seem to answer their phones or return calls, <strong><?php echo esc_html($selectedName) ?> promptly responded to my initial call, and was always available during the entire selling process."</strong></p>
                </blockquote>
            </div>
            <div class="ao-testimonials__person">
                <img class="ao-testimonials__testimonee" src="<?php echo esc_url($nataly_lebedev_url); ?>" alt="Nataly Lebedev">
                <cite>
                    Nataly Lebedev <span class="verified"> <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark">Verified customer</span></cite>
            </div>
        </div>

        <div class="ao-testimonials__testimonial">
            <div class="ao-testimonials__testimonial--content">
                <div class="ao-hero__reviews-stars-wrapper">
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                </div>
                <blockquote>
                    <p>"We are very grateful for Chris and his team's work. They were always professional and reliable, </br></br><strong><?php echo esc_html($selectedName) ?> answered my first call right away</strong> and kept me updated throughout the whole selling process.”</p>
                </blockquote>
            </div>
            <div class="ao-testimonials__person">
                <img class="ao-testimonials__testimonee" src="<?php echo esc_url($liv_skyler_url); ?>" alt="Liv Skyler">
                <cite>
                    Liv Skyler <span class="verified"> <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark">Verified customer</span></cite>
            </div>
        </div>

        <div class="ao-testimonials__testimonial">
            <div class="ao-testimonials__testimonial--content">
                <div class="ao-hero__reviews-stars-wrapper">
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                </div>
                <blockquote>
                    <p>"<strong>I am quite happy with the easy, fast, stress-free process of dealing with <?php echo esc_html($selectedName) ?>.</strong> I needed to rehab this property that sat vacant too long.</br></br> He made a reasonable offer and the sale went quickly with prompt payment."</p>
                </blockquote>
            </div>
            <div class="ao-testimonials__person">
                <img class="ao-testimonials__testimonee" src="<?php echo esc_url($darren_pilch_url); ?>" alt="Darren Pilch">
                <cite>
                    Darren Pilch <span class="verified"> <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark">Verified customer</span></cite>
            </div>
        </div>

        <div class="ao-testimonials__testimonial">
            <div class="ao-testimonials__testimonial--content">
                <div class="ao-hero__reviews-stars-wrapper">
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                </div>
                <blockquote>
                    <p>“<strong>Great experience working</strong> with <?php echo esc_html($selectedName) ?> and the team. They were incredibly professional and sold our home quickly for a price we were satisfied with."</p>
                </blockquote>
            </div>
            <div class="ao-testimonials__person">
                <img class="ao-testimonials__testimonee" src="<?php echo esc_url($shaked_elnatan_url); ?>" alt="Shaked Elnatan">
                <cite>
                    Shaked Elnatan <span class="verified"> <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark">Verified customer</span></cite>
            </div>
        </div>

        <div class="ao-testimonials__testimonial">
            <div class="ao-testimonials__testimonial--content">
                <div class="ao-hero__reviews-stars-wrapper">
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                </div>
                <blockquote>
                    <p>"<strong>The customer service experience with <?php echo esc_html($selectedName) ?> was outstanding.</strong> From beginning to end, the process of selling my home was exemplary."</p>
                </blockquote>
            </div>
            <div class="ao-testimonials__person">
                <img class="ao-testimonials__testimonee" src="<?php echo esc_url($leigh_williams_url); ?>" alt="Leigh Williams">
                <cite>
                    Leigh Williams <span class="verified"> <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark">Verified customer</span></cite>
            </div>
        </div>

        <div class="ao-testimonials__testimonial">
            <div class="ao-testimonials__testimonial--content">
                <div class="ao-hero__reviews-stars-wrapper">
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                    <span class="ao-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                </div>
                <blockquote>
                    <p>”Managing a property from out of state became too much, and I needed to sell quickly. <strong><?php echo esc_html($selectedName) ?> handled everything seamlessly</strong>, and I couldn't be happier with how smoothly the sale went. They truly made it effortless."</p>
                </blockquote>
            </div>
            <div class="ao-testimonials__person">
                <img class="ao-testimonials__testimonee" src="<?php echo esc_url($gregory_marks_url); ?>" alt="Gregory Marks">
                <cite>
                    Gregory Marks <span class="verified"> <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark">Verified customer</span></cite>
            </div>
        </div>
    </div>
    <div class="ao-testimonials__veil"></div>
    <button class="ao-testimonials__load-more">See More Reviews</button>
</section>