<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    // Array to store page IDs and their corresponding GTM Container IDs
    $gtm_containers = array(
        'sf' => array('page_ids' => array(26, 39, 74, 86), 'gtm_id' => 'GTM-NJ6LP74'),
        'stl' => array('page_ids' => array(9, 14, 18, 21), 'gtm_id' => 'GTM-PQTW9BQ'),
        'kc' => array('page_ids' => array(27, 63, 75, 87), 'gtm_id' => 'GTM-K4Q5CKB'),
        'det' => array('page_ids' => array(28, 60, 76, 88), 'gtm_id' => 'GTM-T75JTFR'),
        'cle' => array('page_ids' => array(29, 61, 77, 89), 'gtm_id' => 'GTM-MFXJR55'),
        'ind' => array('page_ids' => array(30, 62, 78, 90), 'gtm_id' => 'GTM-MPG2VCR'),
    );

    // Get the current page ID
    $current_page_id = get_the_ID();

    // Initialize a variable for the GTM ID
    $gtm_id = '';

    // Loop through the array to find the matching GTM ID
    foreach ($gtm_containers as $market => $data) {
        if (in_array($current_page_id, $data['page_ids'])) {
            $gtm_id = $data['gtm_id'];
            break; // Stop the loop once the correct GTM ID is found
        }
    }

    // Output the GTM script in the <head> if a GTM ID is found
    if ($gtm_id) :
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
    <?php endif; ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <?php
    // Output the GTM noscript tag immediately after <body> if a GTM ID is found
    if ($gtm_id) :
    ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $gtm_id; ?>"
                height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    <?php endif; ?>
    <!--  -->