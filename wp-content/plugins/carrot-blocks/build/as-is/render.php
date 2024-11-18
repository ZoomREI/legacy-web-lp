<?php
$selected_market = esc_html($attributes['selectedMarket']);

$market_image_map = [
    'Kansas City' => 'circle-ks',
    'SF Bay Area' => '',
    'St. Louis' => 'circle-stl',
    'Metro Detroit' => 'circle-det',
    'Cleveland' => 'circle-cle',
    'Indianapolis' => 'circle-ind'
];

$before_after_map = [
    'SF Bay Area' => 'before-after-john',
    'Kansas City' => 'before-after-chris',
    'St. Louis' => 'before-after-chris',
    'Metro Detroit' => 'before-after-chris',
    'Cleveland' => 'before-after-chris',
    'Indianapolis' => 'before-after-chris'
];

$image_url = isset($market_image_map[$selected_market]) && $market_image_map[$selected_market] ? 'as-is/' . $market_image_map[$selected_market] : '';
$before_after_bg = isset($before_after_map[$selected_market]) ? 'as-is/' . $before_after_map[$selected_market] : '';

?>

<section class="full-width banner" style="
    --before-after-bg-small: url('<?php echo get_image_url($before_after_bg, 768); ?>');
    --before-after-bg-medium: url('<?php echo get_image_url($before_after_bg, 1024); ?>');
    --before-after-bg-large: url('<?php echo get_image_url($before_after_bg, 2048); ?>');
    ">
    <div class="as-is">
        <h2>Sell Your <?php echo $selected_market; ?> House As-Is, True As-Is</h2>
        <div class="as-is__image">
            <?php if ($image_url) : ?>
                <?php echo get_responsive_image($image_url, 'Logo representing '.$selected_market); ?>
            <?php endif; ?>
        </div>
        <p>
            When we say “We Buy Houses in <?php echo $selected_market; ?> As Is”, we do mean, As-Is,
            in ANY condition! Take what you want & leave the rest – We’ll either
            donate it or get rid of it for you!
        </p>
    </div>
</section>