<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    // Check if we're on a custom path
    $custom_path = get_query_var('custom_path');

    if (!empty($custom_path)) {
        // Query the page based on the custom path logic
        $args = array(
            'post_type' => 'page',
            'meta_query' => array(
                array(
                    'key' => 'custom_url_slugs',  // ACF field name
                    'value' => $custom_path,
                    'compare' => 'LIKE'
                )
            )
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            $page = $query->posts[0];  // Get the page object
            $current_page_id = $page->ID;  // Get the page ID
        } else {
            // Handle 404 if no page found
            global $wp_query;
            $wp_query->is_404 = true;
            status_header(404);
            include(get_404_template());
            exit;
        }
    } else {
        // Fallback: get the normal page ID if no custom path is set
        $current_page_id = get_the_ID();
    }

    // Market-specific GTM configuration
    $market_map = array(
        'sf'  => array('page_ids' => array(26, 39, 74, 86, 123), 'gtm_id' => 'GTM-NJ6LP74', 'auth' => '7H1OBOUOmrByvYq6bdpadQ', 'preview' => 'env-189', 'favicon' => 'sf-favicon.svg'),
        'stl' => array('page_ids' => array(9, 14, 18, 21), 'gtm_id' => 'GTM-PQTW9BQ', 'auth' => 'LrQbrrYid_3p5-g4d9c6nA', 'preview' => 'env-180', 'favicon' => 'stl-favicon.svg'),
        'kc'  => array('page_ids' => array(27, 63, 75, 87), 'gtm_id' => 'GTM-K4Q5CKB', 'auth' => 'GxKUyRZJ3GvxiyIJXLv60A', 'preview' => 'env-125', 'favicon' => 'kc-favicon.svg'),
        'det' => array('page_ids' => array(28, 60, 76, 88), 'gtm_id' => 'GTM-T75JTFR', 'auth' => 'txHjXG--1VMuPmPwSOTuug', 'preview' => 'env-127', 'favicon' => 'det-favicon.svg'),
        'cle' => array('page_ids' => array(29, 61, 77, 89), 'gtm_id' => 'GTM-MFXJR55', 'auth' => 'RenHfCiizOd8kGCtWA2A_g', 'preview' => 'env-125', 'favicon' => 'cle-favicon.svg'),
        'ind' => array('page_ids' => array(30, 62, 78, 90), 'gtm_id' => 'GTM-MPG2VCR', 'auth' => 'YaUYwQOsU62aUAiCwNaaYg', 'preview' => 'env-130', 'favicon' => 'ind-favicon.svg'),
    );

    // Determine the current market
    $current_market = '';
    foreach ($market_map as $market => $data) {
        if (in_array($current_page_id, $data['page_ids'])) {
            $current_market = $market;
            $gtm_config = $data;
            break;
        }
    }

    // If no matching market is found, return early
    if (empty($current_market)) {
        wp_head();
        echo '</head><body ' . body_class() . '>';
        wp_body_open();
        echo '<!-- No GTM or Favicon for this page -->';
        return;
    }

    // Determine if the environment is production or staging
    $hostname = $_SERVER['HTTP_HOST'];
    $is_production = ($hostname === 'legacy.chrisbuyshomes.com');
    $is_staging = ($hostname === 'legacy-stg.chrisbuyshomes.com');

    // Favicon URL Construction
    $favicon_url = get_site_url() . '/wp-content/themes/chrisbuyshomes/src/assets/favicons/' . $gtm_config['favicon'];
    ?>

    <link rel="icon" href="<?php echo $favicon_url; ?>" type="image/svg+xml">

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
            j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl +
                '<?php if ($is_staging) {
                        echo "&gtm_auth={$gtm_config['auth']}&gtm_preview={$gtm_config['preview']}&gtm_cookies_win=x";
                    } ?>';
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', '<?php echo $gtm_config['gtm_id']; ?>');
    </script>
    <!-- End Google Tag Manager -->

    <title><?php wp_title(''); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $gtm_config['gtm_id']; ?><?php
                                                                                                        if ($is_staging) {
                                                                                                            echo "&gtm_auth={$gtm_config['auth']}&gtm_preview={$gtm_config['preview']}&gtm_cookies_win=x";
                                                                                                        }
                                                                                                        ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->