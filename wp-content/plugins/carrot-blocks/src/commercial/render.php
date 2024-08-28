<?php
$selected_market = esc_html($attributes['selectedMarket']);

$market_video_map = [
    'Kansas City' => 'https://www.youtube.com/embed/wDJKxsB3v1I?si=yUMqBAgy0oOpcAfR',
    'San Francisco Bay Area' => 'https://www.youtube.com/embed/YmuDu5Z2XJc?si=xemnCeIS5g2YNzsb',
    'St. Louis' => 'https://www.youtube.com/embed/cpkjL51Qg1c?si=rXCuH0v6POkNKC1n',
];

// List of markets where the block should not render
$exclude_markets = ['Metro Detroit', 'Cleveland', 'Indianapolis'];

if (in_array($selected_market, $exclude_markets)) {
    // Do not render the block for excluded markets
    return;
}

$video_url = isset($market_video_map[$selected_market]) ? esc_url($market_video_map[$selected_market]) : '';

?>

<?php if ($video_url) : ?>
    <div id="commercial" class="commercial">
        <h2>Watch Our Commercial</h2>
        <div class="video-container">
            <iframe
                src="<?php echo $video_url; ?>"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
    </div>
<?php endif; ?>