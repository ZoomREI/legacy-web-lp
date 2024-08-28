<?php
$selected_market = esc_html($attributes['selectedMarket']);
$content = isset($attributes['content']) ? $attributes['content'] : '';

// Escape the content to avoid XSS attacks
$escaped_content = wp_kses_post($content);
?>

<section class="new-and-easy">
    <h2>
        The New & Easy Way of Selling Your House in <?php echo $selected_market; ?> Fast For Cash
    </h2>
    <p>
        <?php echo $escaped_content; ?>
    </p>
</section>