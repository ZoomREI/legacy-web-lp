<?php
    $popupId = substr(wp_generate_uuid4(), 0, 8);;
?>

<div class="nhp-exit-popup" id="<?= $popupId ?>" style="display: none;">
    <div class="nhp-exit-popup__img">
        <?php echo get_responsive_image('nhp-exit-popup/bg', 'Background image'); ?>
    </div>
    <div class="nhp-exit-popup__content">
        <div class="nhp-exit-popup__title">
            <span>Limited-Time Offer Just for You!</span>
        </div>
        <div class="nhp-exit-popup__subtitle">
            <span>Sell your house in 7 days or less and walk away with <strong>EXTRA CASH</strong> in your pocket.</span>
        </div>
        
        <div class="nhp-exit-popup__form" data-form-name="popup-form-v1">
            <?php echo $content; ?>
        </div>
    </div>
</div>