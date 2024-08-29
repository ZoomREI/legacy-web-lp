<?php
$step_arrow_url = plugins_url('src/cw-steps/assets/step-arrow.svg', dirname(__FILE__, 2));
$steps1_url = plugins_url('src/cw-steps/assets/st_1.svg', dirname(__FILE__, 2));
$steps2_url = plugins_url('src/cw-steps/assets/st_2.svg', dirname(__FILE__, 2));
$steps3_url = plugins_url('src/cw-steps/assets/st_3.svg', dirname(__FILE__, 2));
?>

<section class="cw-steps">
    <div class="cw-steps__text">
        <div class="cw-steps__text--prev">How it works</div>
        <h2>Selling Your House Really Is This Easy</h2>
        <p>As simple as 1, 2, 3…</p>
    </div>
    <div class="cw-steps__steps">
        <div class="cw-step">
            <div class="cw-step__img">
                <img src="<?php echo esc_url($steps1_url); ?>" alt="Sharing Details">
            </div>
            <div class="cw-step__content">
                <div class="cw-step__title">
                    <div class="cw-step__number">1
                        <img src="<?php echo esc_url($step_arrow_url); ?>" alt="" class="cw-step__number--arrow">
                    </div>
                    <h3>Get An Immediate Cash Offer</h3>
                </div>
                <p>Fill out the form for a callback, or phone us directly to get a cash offer in under 7 minutes.</p>
            </div>
        </div>
        <div class="cw-step">
            <div class="cw-step__img">
                <img src="<?php echo esc_url($steps2_url); ?>" alt="Get Cash Offer">
            </div>
            <div class="cw-step__content">
                <div class="cw-step__title">
                    <div class="cw-step__number">2
                       <img src="<?php echo esc_url($step_arrow_url); ?>" alt="" class="cw-step__number--arrow">
                    </div>
                    <h3>Let Us Do The Hard Work</h3>
                </div>
                <p>We deal with all the details - there’s zero paperwork and bureaucracy for you to stress about.</p>
            </div>
        </div>
        <div class="cw-step">
            <div class="cw-step__img">
                <img src="<?php echo esc_url($steps3_url); ?>" alt="Get Paid">
            </div>
            <div class="cw-step__content">
                <div class="cw-step__title">
                    <div class="cw-step__number">3</div>
                    <h3>Close And Get Paid</h3>
                </div>
                <p>Our clients successfully sell their house and get paid on a timescale that suits their needs.</p>
            </div>
        </div>
    </div>
</section>