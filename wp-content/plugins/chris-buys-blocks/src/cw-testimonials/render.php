<?php
$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';

$nataly_lebedev_url = plugins_url('src/cw-testimonials/assets/nataly-lebedev.webp', dirname(__FILE__, 2));
$darren_pilch_url = plugins_url('src/cw-testimonials/assets/darren-pilch.webp', dirname(__FILE__, 2));
$liv_skyler_url = plugins_url('src/cw-testimonials/assets/liv-skyler.webp', dirname(__FILE__, 2));
$shaked_elnatan_url = plugins_url('src/cw-testimonials/assets/shaked-elnatan.webp', dirname(__FILE__, 2));
$leigh_williams_url = plugins_url('src/cw-testimonials/assets/leigh-williams.webp', dirname(__FILE__, 2));
$gregory_marks_url = plugins_url('src/cw-testimonials/assets/gregory-marks.webp', dirname(__FILE__, 2));

$arrow_prev_url = plugins_url('src/cw-testimonials/assets/arrow-p.svg', dirname(__FILE__, 2));
$arrow_next_url = plugins_url('src/cw-testimonials/assets/arrow-n.svg', dirname(__FILE__, 2));
$star_icon_url = plugins_url('src/cw-testimonials/assets/star.svg', dirname(__FILE__, 2));
$verified_check_url = plugins_url('src/cw-testimonials/assets/verified-check-circle.svg', dirname(__FILE__, 2));
?>

<section id='reviews' class="cw-testimonials">
    <div class="cw-testimonials__prevtitle">client reviews</div>
    <div class="cw-testimonials__title">
        <h2>What People Are Saying</h2>
    </div>
    <p class="cw-testimonials__text">Fast sales, helpful & professional, zero hassle. 96% of sellers love our service - here’s what our clients have to say.</p>

    <!--   
    <div class="cw-testimonials__testimonials">
        <div class="cw-testimonials__testimonial">
            <div class="cw-testimonials__person">
                <img class="cw-testimonials__testimonee" src="<?php echo esc_url($testimonee_1_url); ?>" alt="Nataly Lebedev">
                <div class="cw-testimonials__person--about">
                     <div class="cw-hero__reviews-stars-wrapper">
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                     </div>
                     <cite>
                         Nataly Lebedev <span class="verified"> <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark">Verified customer</span>
                     </cite>
                </div>
            </div>
            <div class="cw-testimonials__testimonial--content">
                <blockquote>
                    <p>“In a day and age where professionals in the service industry never seem to answer their phones or return calls, <?php echo esc_html($selectedName) ?> promptly responded to my initial call, and was always available during the entire selling process."</p>
                </blockquote>
            </div>
        </div>
        <div class="cw-testimonials__testimonial">
            <div class="cw-testimonials__person">
                <img class="cw-testimonials__testimonee" src="<?php echo esc_url($testimonee_2_url); ?>" alt="Darren Pilch">
                <div class="cw-testimonials__person--about">
                     <div class="cw-hero__reviews-stars-wrapper">
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                     </div>
                     <cite>
                       Darren Pilch <span class="verified"> <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark">Verified customer</span>
                     </cite>
                </div>
            </div>
            <div class="cw-testimonials__testimonial--content">
                <blockquote>
                    <p>"I am quite happy with the easy, fast, stress-free process of dealing with <?php echo esc_html($selectedName) ?>. I needed to rehab this property that sat vacant too long. He made a reasonable offer and the sale went quickly with prompt payment."</p>
                </blockquote>
            </div>
        </div>
        <div class="cw-testimonials__testimonial">
            <div class="cw-testimonials__person">
                <img class="cw-testimonials__testimonee" src="<?php echo esc_url($testimonee_3_url); ?>" alt="Liv Skyler">
                <div class="cw-testimonials__person--about">
                     <div class="cw-hero__reviews-stars-wrapper">
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                     </div>
                     <cite>
                     Liv Skyler<span class="verified"> <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark">Verified customer</span>
                     </cite>
                </div>
            </div>
            <div class="cw-testimonials__testimonial--content">
                <blockquote>
                    <p>"We are very grateful for Chris and his team's work. They were always professional and reliable, <?php echo esc_html($selectedName) ?> answered my first call right away and kept me updated throughout the whole selling process.”</p>
                </blockquote>
            </div>
        </div>
        <div class="cw-testimonials__testimonial">
            <div class="cw-testimonials__person">
                <img class="cw-testimonials__testimonee" src="<?php echo esc_url($testimonee_1_url); ?>" alt="Nataly Lebedev">
                <div class="cw-testimonials__person--about">
                     <div class="cw-hero__reviews-stars-wrapper">
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                     </div>
                     <cite>
                         Nataly Lebedev <span class="verified"> <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark">Verified customer</span>
                     </cite>
                </div>
            </div>
            <div class="cw-testimonials__testimonial--content">
                <blockquote>
                    <p>“In a day and age where professionals in the service industry never seem to answer their phones or return calls, <?php echo esc_html($selectedName) ?> promptly responded to my initial call, and was always available during the entire selling process."</p>
                </blockquote>
            </div>
        </div>
        <div class="cw-testimonials__testimonial">
            <div class="cw-testimonials__person">
                <img class="cw-testimonials__testimonee" src="<?php echo esc_url($testimonee_2_url); ?>" alt="Darren Pilch">
                <div class="cw-testimonials__person--about">
                     <div class="cw-hero__reviews-stars-wrapper">
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                     </div>
                     <cite>
                       Darren Pilch <span class="verified"> <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark">Verified customer</span>
                     </cite>
                </div>
            </div>
            <div class="cw-testimonials__testimonial--content">
                <blockquote>
                    <p>"I am quite happy with the easy, fast, stress-free process of dealing with <?php echo esc_html($selectedName) ?>. I needed to rehab this property that sat vacant too long. He made a reasonable offer and the sale went quickly with prompt payment."</p>
                </blockquote>
            </div>
        </div>
        <div class="cw-testimonials__testimonial">
            <div class="cw-testimonials__person">
                <img class="cw-testimonials__testimonee" src="<?php echo esc_url($testimonee_3_url); ?>" alt="Liv Skyler">
                <div class="cw-testimonials__person--about">
                     <div class="cw-hero__reviews-stars-wrapper">
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                         <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                     </div>
                     <cite>
                     Liv Skyler<span class="verified"> <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark">Verified customer</span>
                     </cite>
                </div>
            </div>
            <div class="cw-testimonials__testimonial--content">
                <blockquote>
                    <p>"We are very grateful for Chris and his team's work. They were always professional and reliable, <?php echo esc_html($selectedName) ?> answered my first call right away and kept me updated throughout the whole selling process.”</p>
                </blockquote>
            </div>
        </div>

    </div>
    <div class="carousel-nav">
        <div class="carousel-btn-next">
           <img class="" src="<?php echo esc_url($arrow_next_url); ?>" alt="arrow">
        </div>
        <div class="carousel-btn-prev">
            <img class="" src="<?php echo esc_url($arrow_prev_url); ?>" alt="arrow">
        </div>
    </div>
    <div class="cw-carousel-dots">
            <span class="cw-dot"></span>
            <span class="cw-dot"></span>
            <span class="cw-dot"></span>
            <span class="cw-dot"></span>
            <span class="cw-dot"></span>
            <span class="cw-dot"></span>
     </div> -->


    <!-- ----------------------------------------------------------------------------- -->
    <div class='_carousel-wrapper'>

        <div class="_carousel-container">
            <div class="_carousel-inner">

                <div class="_carousel-slide">
                    <div class="cw-testimonials__testimonial">
                        <div class="cw-testimonials__person">
                            <img class="cw-testimonials__testimonee" src="<?php echo esc_url($nataly_lebedev_url); ?>" alt="Nataly Lebedev">
                            <div class="cw-testimonials__person--about">
                                <div class="cw-hero__reviews-stars-wrapper">
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                </div>
                                <cite>
                                    Nataly Lebedev <span class="verified"> <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark">Verified customer</span>
                                </cite>
                            </div>
                        </div>
                        <div class="cw-testimonials__testimonial--content">
                            <blockquote>
                                <p>“In a day and age where professionals in the service industry never seem to answer their phones or return calls, <strong><?php echo esc_html($selectedName) ?> promptly responded to my initial call, and was always available during the entire selling process."</strong></p>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="_carousel-slide ">
                    <div class="cw-testimonials__testimonial">
                        <div class="cw-testimonials__person">
                            <img class="cw-testimonials__testimonee" src="<?php echo esc_url($liv_skyler_url); ?>" alt="Liv Skyler">
                            <div class="cw-testimonials__person--about">
                                <div class="cw-hero__reviews-stars-wrapper">
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                </div>
                                <cite>
                                    Liv Skyler <span class="verified"> <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark">Verified customer</span>
                                </cite>
                            </div>
                        </div>
                        <div class="cw-testimonials__testimonial--content">
                            <blockquote>
                                <p>"We are very grateful for <?php echo esc_html($selectedName) ?> and his team's work. They were always professional and reliable, </br></br><strong><?php echo esc_html($selectedName) ?> answered my first call right away</strong> and kept me updated throughout the whole selling process.”</p>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="_carousel-slide">
                    <div class="cw-testimonials__testimonial">
                        <div class="cw-testimonials__person">
                            <img class="cw-testimonials__testimonee" src="<?php echo esc_url($darren_pilch_url); ?>" alt="Darren Pilch">
                            <div class="cw-testimonials__person--about">
                                <div class="cw-hero__reviews-stars-wrapper">
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                </div>
                                <cite>
                                    Darren Pilch<span class="verified"> <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark">Verified customer</span>
                                </cite>
                            </div>
                        </div>
                        <div class="cw-testimonials__testimonial--content">
                            <blockquote>
                                <p>"<strong>I am quite happy with the easy, fast, stress-free process of dealing with <?php echo esc_html($selectedName) ?>.</strong> I needed to rehab this property that sat vacant too long.</br></br> He made a reasonable offer and the sale went quickly with prompt payment."</p>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="_carousel-slide">
                    <div class="cw-testimonials__testimonial">
                        <div class="cw-testimonials__person">
                            <img class="cw-testimonials__testimonee" src="<?php echo esc_url($shaked_elnatan_url); ?>" alt="Shaked Elnatan">
                            <div class="cw-testimonials__person--about">
                                <div class="cw-hero__reviews-stars-wrapper">
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                </div>
                                <cite>
                                    Shaked Elnatan <span class="verified"> <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark">Verified customer</span>
                                </cite>
                            </div>
                        </div>
                        <div class="cw-testimonials__testimonial--content">
                            <blockquote>
                                <p>“<strong>Great experience working</strong> with <?php echo esc_html($selectedName) ?> and the team. They were incredibly professional and sold our home quickly for a price we were satisfied with."</p>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="_carousel-slide">
                    <div class="cw-testimonials__testimonial">
                        <div class="cw-testimonials__person">
                            <img class="cw-testimonials__testimonee" src="<?php echo esc_url($leigh_williams_url); ?>" alt="Leigh Williams">
                            <div class="cw-testimonials__person--about">
                                <div class="cw-hero__reviews-stars-wrapper">
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                    <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                                </div>
                                <cite>
                                    Leigh Williams<span class="verified"> <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark">Verified customer</span>
                                </cite>
                            </div>
                        </div>
                        <div class="cw-testimonials__testimonial--content">
                            <blockquote>
                                <p>"<strong>The customer service experience with <?php echo esc_html($selectedName) ?> was outstanding.</strong> From beginning to end, the process of selling my home was exemplary."</p>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="_carousel-slide ">
            <div class="cw-testimonials__testimonial">
                <div class="cw-testimonials__person">
                    <img class="cw-testimonials__testimonee" src="<?php echo esc_url($gregory_marks_url); ?>" alt="Gregory Marks">
                    <div class="cw-testimonials__person--about">
                        <div class="cw-hero__reviews-stars-wrapper">
                            <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                            <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                            <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                            <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                            <span class="cw-hero__star"><img src="<?php echo esc_url($star_icon_url); ?>" alt="star"></span>
                        </div>
                        <cite>
                            Gregory Marks <span class="verified"> <img src="<?php echo esc_url($verified_check_url); ?>" alt="checkmark">Verified customer</span>
                        </cite>
                    </div>
                </div>
                <div class="cw-testimonials__testimonial--content">
                    <blockquote>
                        <p>”Managing a property from out of state became too much, and I needed to sell quickly. <strong><?php echo esc_html($selectedName) ?> handled everything seamlessly</strong>, and I couldn't be happier with how smoothly the sale went. They truly made it effortless."</p>
                    </blockquote>
                </div>
            </div>
        </div>

        <div class="_carousel-controls">
            <button id="prevButton">
                <img class="" src="<?php echo esc_url($arrow_prev_url); ?>" alt="arrow">
            </button>
            <button id="nextButton">
                <img class="" src="<?php echo esc_url($arrow_next_url); ?>" alt="arrow">
            </button>
        </div>

        <div class="cw-carousel-dots">
            <span class="cw-dot"></span>
            <span class="cw-dot"></span>
            <span class="cw-dot"></span>
            <span class="cw-dot"></span>
            <span class="cw-dot"></span>
            <span class="cw-dot"></span>
        </div>

    </div>
    <!-- <div class="cw-dots"> -->
    <!-- ----------------------------------------------------------------------------- -->

    <!-- ---------------------------------------------------------0 -->
    <!-- ---------------------------------------------------------0 -->
    <!-- ---------------------------------------------------------0 -->
    <!-- ---------------------------------------------------------0 -->

    <!-- ---------------------------------------------------------0 -->
    <!-- ---------------------------------------------------------0 -->
</section>