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

$background_image_url = esc_url(plugins_url('src/carrot-hero/assets/background-' . $selected_market . '.webp', dirname(__FILE__, 2)));
$carrot_hero_url = esc_url(plugins_url('src/carrot-hero/assets/carrot-hero.webp', dirname(__FILE__, 2)));
$bbb_url = esc_url(plugins_url('src/carrot-hero/assets/bbb.svg', dirname(__FILE__, 2)));
?>

<style>
    :root {
        --primary-color: <?php echo esc_attr($primary_color); ?>;
        --primary-dark-color: <?php echo esc_attr($primary_dark_color); ?>;
        --dark-color: #212529;
        --hero-gradient: <?php echo esc_attr($hero_gradient); ?>;
        --background-image: url('<?php echo $background_image_url; ?>');
    }
</style>

<section class="c-hero-wrapper">
    <svg class="hero-triangle top" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon points="0,0 100,0 0,100" />
    </svg>

    <div class="kc-hero main-page-hero">
        <div class="kc-hero__call-us">
            Call Us! <a href="tel:<?php echo $phoneNumber; ?>"><?php echo $phoneNumber; ?></a>
        </div>
        <div class="kc-hero__content">
            <img
                class="hero-headline-image"
                src="<?php echo esc_url($carrot_hero_url); ?>"
                alt="Sell Your Home Fast and Easy" />
            <img class="bbb-logo"
                src="<?php echo esc_url($bbb_url); ?>"
                alt="" />
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