<?php
$cbs_logo_url = plugins_url('src/ao-as-seen-on-carousel/assets/cbs.svg', dirname(__FILE__, 2));
$nbc_logo_url = plugins_url('src/ao-as-seen-on-carousel/assets/nbc.svg', dirname(__FILE__, 2));
$forbes_logo_url = plugins_url('src/ao-as-seen-on-carousel/assets/forbes.svg', dirname(__FILE__, 2));
$fox_logo_url = plugins_url('src/ao-as-seen-on-carousel/assets/fox.svg', dirname(__FILE__, 2));
?>
<section class="ao-as-seen-on-carousel-wrapper">
    <div class="ao-as-seen-on-carousel">
        <div class="ao-as-seen-on-carousel__container">
            <span class="ao-as-seen-on-carousel__text">As Seen On</span>
            <div class="ao-as-seen-on-carousel__logos-wrapper">
                <div class="ao-as-seen-on-carousel__logos">
                    <div class="ao-as-seen-on-carousel__logo"><img src="<?php echo esc_url($cbs_logo_url); ?>" alt="CBS"></div>
                    <div class="ao-as-seen-on-carousel__logo"><img src="<?php echo esc_url($nbc_logo_url); ?>" alt="NBC"></div>
                    <div class="ao-as-seen-on-carousel__logo"><img src="<?php echo esc_url($forbes_logo_url); ?>" alt="Forbes"></div>
                    <div class="ao-as-seen-on-carousel__logo"><img src="<?php echo esc_url($fox_logo_url); ?>" alt="FOX"></div>
                </div>
            </div>
        </div>
    </div>
</section>