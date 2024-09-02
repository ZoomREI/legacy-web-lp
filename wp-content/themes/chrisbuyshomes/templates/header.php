<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    // Map page IDs to market identifiers
    $market_map = array(
        'sf'  => array('page_ids' => array(26, 39, 74, 86), 'gtm_id' => 'GTM-NJ6LP74', 'favicon' => 'sf-favicon.svg'),
        'stl' => array('page_ids' => array(9, 14, 18, 21), 'gtm_id' => 'GTM-PQTW9BQ', 'favicon' => 'stl-favicon.svg'),
        'kc'  => array('page_ids' => array(27, 63, 75, 87), 'gtm_id' => 'GTM-K4Q5CKB', 'favicon' => 'kc-favicon.svg'),
        'det' => array('page_ids' => array(28, 60, 76, 88), 'gtm_id' => 'GTM-T75JTFR', 'favicon' => 'det-favicon.svg'),
        'cle' => array('page_ids' => array(29, 61, 77, 89), 'gtm_id' => 'GTM-MFXJR55', 'favicon' => 'cle-favicon.svg'),
        'ind' => array('page_ids' => array(30, 62, 78, 90), 'gtm_id' => 'GTM-MPG2VCR', 'favicon' => 'ind-favicon.svg'),
    );

    // Determine the current market
    $current_page_id = get_the_ID();
    $current_market = '';
    foreach ($market_map as $market => $data) {
        if (in_array($current_page_id, $data['page_ids'])) {
            $current_market = $market;
            break;
        }
    }

    // If no matching market is found, return early
    if (empty($current_market)) {
        wp_head();
        echo '</head><body ' . body_class() . '>';
        wp_body_open();
        echo '<!-- No GTM or Favicon for this page --></body></html>';
        return;
    }

    // Determine if the environment is production
    $is_production = (get_bloginfo('name') === 'Chris Buys Homes');

    // Favicon URL Construction
    $favicon_url = get_site_url() . '/wp-content/themes/chrisbuyshomes/src/assets/favicons/' . $market_map[$current_market]['favicon'];
    ?>

    <!-- Output the Favicon link in the <head> -->
    <link rel="icon" href="<?php echo $favicon_url; ?>" type="image/svg+xml">

    <?php
    // GTM Logic: Only load on production
    if ($is_production) {
        $gtm_id = $market_map[$current_market]['gtm_id'];
    ?>
        <!-- Google Tag Manager -->
        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', '<?php echo $gtm_id; ?>');
        </script>
        <!-- End Google Tag Manager -->
    <?php
    }
    ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <?php
    // Output the GTM noscript tag immediately after <body> if a GTM ID is set and environment is production
    if ($is_production && $gtm_id) :
    ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $gtm_id; ?>"
                height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    <?php endif; ?>
    <!--  -->