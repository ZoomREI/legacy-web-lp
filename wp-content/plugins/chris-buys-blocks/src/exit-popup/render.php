<?php
$popupId = substr(wp_generate_uuid4(), 0, 8);;
?>

<div class="exit-popup" id="<?= $popupId ?>" style="--check-circle: url('<?php echo get_image_url('exit-popup/check-circle', 768); ?>');">
    <div class="exit-popup__img">
        <?php echo get_responsive_image('exit-popup/bg', 'Background image'); ?>
    </div>
    <div class="exit-popup__content">
        <div class="exit-popup__title">
            <span>Don’t leave without a cash offer!</span>
        </div>
        <div class="exit-popup__subtitle">
            <span>Why wait months to sell your home?</span>
        </div>
        <div class="exit-popup__text">
            <ul>
                <li>Get a no-obligation, fair cash offer today</li>
                <li>Close on your terms—no hidden fees or repairs</li>
            </ul>
        </div>
        <div class="exit-popup__form">
            <?php echo $content; ?>
        </div>
    </div>
</div>