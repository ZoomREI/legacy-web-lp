<?php
// Map the market names to their corresponding market codes
$market_codes = [
    "San Francisco Bay Area" => "sf",
    "St. Louis" => "stl",
    "Kansas City" => "ks",
    "Metro Detroit" => "det",
    "Cleveland" => "cle",
    "Indianapolis" => "ind",
];

// Get the selected market and find the corresponding market code
$selected_market = isset($attributes['selectedMarket']) ? esc_html($attributes['selectedMarket']) : 'St. Louis';
$market_code = isset($market_codes[$selected_market]) ? $market_codes[$selected_market] : 'stl';

// Construct the image URL based on the market code, pointing to the src folder
$imageUrl = 'never-lowball/circle-' . $market_code;

$brand_name = esc_html($attributes['brandName']);
$brand_area = esc_html($attributes['brandArea']);
?>

<section class="never-lowball">
    <div class="never-lowball__content">
        <?php echo get_responsive_image($imageUrl, $brand_name.' Logo'); ?>
        
        <p>
            <strong>We buy houses in <?php echo $brand_area; ?>.</strong>
            “<?php echo $brand_name; ?>” is a local home buying company in
            <?php echo $selected_market; ?> that buys homes for cash and provides homeowners with a
            true hassle-free process of selling their homes. Sell your home fast
            in <?php echo $selected_market; ?> with
            <strong>No Commissions, No Fees, No Hidden Costs, No Repairs, No
                Cleaning, No Inspections.</strong>
        </p>
    </div>
</section>
