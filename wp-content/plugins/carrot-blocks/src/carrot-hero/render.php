<?php
$primary_colors = [
    'sf'  => '#006cbf',
    'stl' => '#006cbf',
    'kc'  => '#ff651e',
    'det' => '#006cbf',
    'cle' => '#006cbf',
    'ind' => '#00768e',
];

$primary_dark_colors = [
    'sf'  => '#004173',
    'stl' => '#004173',
    'kc'  => '#d14200',
    'det' => '#004173',
    'cle' => '#004173',
    'ind' => '#003642',
];

$gradients = [
    'sf'  => 'linear-gradient(-90deg, rgba(13, 72, 118, 0.6), rgba(13, 29, 118, 0.6));',
    'stl' => 'linear-gradient(-90deg, rgba(13, 72, 118, 0.6), rgba(13, 29, 118, 0.6));',
    'kc'  => 'linear-gradient(-90deg, rgba(153, 68, 29, 0.6), rgba(153, 118, 29, 0.6));',
    'det' => 'linear-gradient(-90deg, rgba(13, 72, 118, 0.6), rgba(13, 29, 118, 0.6));',
    'cle' => 'linear-gradient(-90deg, rgba(13, 72, 118, 0.6), rgba(13, 29, 118, 0.6));',
    'ind' => 'linear-gradient(-90deg, rgba(13, 77, 91, 0.6), rgba(13, 45, 91, 0.6));',
];

$selected_market = esc_html($attributes['selectedMarket']);

$primary_color = $primary_colors[$selected_market] ?? '#FFFFFF';
$primary_dark_color = $primary_dark_colors[$selected_market] ?? '#000000';
$hero_gradient = $gradients[$selected_market] ?? 'linear-gradient(45deg, #FFFFFF, #EEEEEE)';
$phoneNumber = isset($attributes['phoneNumber']) ? esc_html($attributes['phoneNumber']) : '';

$formId = isset($attributes['formId']) ? esc_attr($attributes['formId']) : '1';

$background_image_url = 'carrot-hero/background-' . $selected_market;
?>

<style>
    :root {
        --primary-color: <?php echo esc_attr($primary_color); ?>;
        --primary-dark-color: <?php echo esc_attr($primary_dark_color); ?>;
        --dark-color: #212529;
        --hero-gradient: <?php echo esc_attr($hero_gradient); ?>;

        --background-image-small: url('<?php echo cb_get_image_url($background_image_url, 768); ?>');
        --background-image-medium: url('<?php echo cb_get_image_url($background_image_url, 1024); ?>');
        --background-image-large: url('<?php echo cb_get_image_url($background_image_url, 2048); ?>');
    }
</style>

<section class="c-hero-wrapper">
    <svg class="hero-triangle top" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon points="0,0 100,0 0,100" />
    </svg>

    <div class="kc-hero main-page-hero">
        <div class="kc-hero__call-us">
            Call Us! <a class="call-btn" href="tel:<?php echo $phoneNumber; ?>"><?php echo $phoneNumber; ?></a>
        </div>
        <div class="kc-hero__content">
            <?php echo cb_get_responsive_image('carrot-hero/carrot-hero', 'Sell Your Home Fast and Easy', 'hero-headline-image'); ?>
            <?php echo cb_get_responsive_image('carrot-hero/bbb', 'Logo', 'bbb-logo'); ?>
            <h3>
                We buy houses in any condition. No realtors, no fees, no commissions,
                no repairs & not even cleaning.
            </h3>
            <?php echo $content; ?>
        </div>
    </div>

    <svg class="hero-triangle bottom" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon points="0,100 100,100 100,0" />
    </svg>
</section>