<?php

// Enqueue Scripts and Styles
function chris_buys_homes_enqueue_assets()
{
    $style_version = filemtime(get_template_directory() . '/dist/style.css');

    wp_enqueue_style('chrisbuyshomes-styles', get_template_directory_uri() . '/dist/style.css', array(), $style_version);
    // wp_enqueue_script('scripts', get_template_directory_uri() . '/src/js/script.js', array(), true);
    wp_enqueue_script('gf-full-address', get_template_directory_uri() . '/src/js/full-address-field.js', array(), true);
    if (is_page(123)) {
        wp_enqueue_script('dynamic-headings', get_template_directory_uri() . '/src/js/dynamic-headings.js', array(), true);
    }
    // wp_enqueue_script('doctor-homes-menu', get_template_directory_uri() . '/src/js/menu.js', array(), null, true);
    // wp_enqueue_script('doctor-homes-mobile-menu', get_template_directory_uri() . '/src/js/mobile-menu.js', array(), null, true);

    // if (is_single()) {
    //     wp_enqueue_script('share-bar-js', get_template_directory_uri() . '/src/js/share-bar.js', array(), '1.0.0', true);
    // }

    // wp_localize_script('scripts', 'formConfig', array(
    //     'googleMapsApiKey' => GOOGLE_MAPS_API_KEY,
    //     'crmWebhookUrl' => CRM_WEBHOOK_URL,
    // ));
}
add_action('wp_enqueue_scripts', 'chris_buys_homes_enqueue_assets');

// Theme Support
function chris_buys_homes_theme_support()
{
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
    add_theme_support('editor-styles');
    add_theme_support('editor-color-palette');
    add_editor_style('dist/style.css');
    add_theme_support('custom-logo', array(
        'height' => 100,
        'width' => 400,
        'flex-height' => true,
        'flex-width' => true,
    ));
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'chris_buys_homes_theme_support');

// Register Menus
// function chris_buys_homes_register_menus()
// {
//     register_nav_menus(array(
//         'primary-menu' => __('Primary Menu'),
//         'footer-company-menu' => __('Footer Company Menu'),
//         'footer-locations-menu' => __('Footer Locations Menu'),
//         'footer-resources-menu' => __('Footer Resources Menu'),
//         'footer-legal-menu' => __('Footer Legal Menu'),
//     ));
// }
// add_action('init', 'chris_buys_homes_register_menus');

// Custom Mobile Navigation Walker
class Mobile_Walker_Nav_Menu extends Walker_Nav_Menu
{
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $polygon_icon_url = wp_get_attachment_url(406);
        $output .= '<li class="menu-item menu-item-' . $item->ID . '">';
        $output .= '<div class="menu-item-title"><a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
        if (in_array('menu-item-has-children', $item->classes)) {
            $output .= '<img class="polygon-icon" src="' . $polygon_icon_url . '"></div>';
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = array())
    {
        $output .= "</li>\n";
    }
}

// Template Part Loading Function
function chris_buys_homes_get_template_part($slug, $name = null)
{
    $templates = array();

    if (isset($name)) {
        $templates[] = "templates/{$slug}-{$name}.php";
    }
    $templates[] = "templates/{$slug}.php";
    $templates[] = "{$slug}.php";

    locate_template($templates, true, false);
}

// Custom Header and Footer Functions
function chris_buys_homes_get_header($name = null)
{
    $template = $name ? locate_template("templates/header-{$name}.php") : locate_template("templates/header.php");
    if ($template) {
        load_template($template);
    }
}

function chris_buys_homes_get_footer($name = null)
{
    $template = $name ? locate_template("templates/footer-{$name}.php") : locate_template("templates/footer.php");
    if ($template) {
        load_template($template);
    }
}

// Template Part Loading with Fallback
function chris_buys_homes_get_template_part_with_fallback($slug, $name = null)
{
    $templates = array();

    if (isset($name)) {
        $templates[] = "templates/{$slug}-{$name}.php";
    }
    $templates[] = "templates/{$slug}.php";
    $templates[] = "{$slug}.php";

    $found_template = locate_template($templates, true, false);

    if (!$found_template) {
        get_template_part($slug, $name);
    }
}

// Template Include Filter
function chris_buys_homes_template_include($template)
{
    // Get the base name of the current template file
    $template_name = basename($template);

    // Log the current template and custom template path
    error_log('Current template: ' . $template);

    // Specific checks for different template types
    if (is_single()) {
        $single_template = locate_template('templates/single.php');
        if ($single_template) {
            error_log('Single post template found: ' . $single_template);
            return $single_template;
        } else {
            error_log('Single post template not found');
        }
    }

    if (is_page()) {
        global $post;
        // Check if the page is the Privacy Policy or Terms of Use page
        if ($post->ID == 3 || $post->ID == 507) {
            $legal_template = locate_template('templates/legal.php');
            if ($legal_template) {
                error_log('Legal page template found: ' . $legal_template);
                return $legal_template;
            } else {
                error_log('Legal page template not found');
            }
        }

        // Check for other specific page templates
        $page_template = locate_template('templates/page.php');
        if ($page_template) {
            error_log('Page template found: ' . $page_template);
            return $page_template;
        } else {
            error_log('Page template not found');
        }
    }

    if (is_author()) {
        $author_template = locate_template('templates/author.php');
        if ($author_template) {
            error_log('Author template found: ' . $author_template);
            return $author_template;
        } else {
            error_log('Author template not found');
        }
    }

    if (is_category()) {
        $category_template = locate_template('templates/category.php');
        if ($category_template) {
            error_log('Category template found: ' . $category_template);
            return $category_template;
        } else {
            error_log('Category template not found');
        }
    }

    if (is_tag()) {
        $tag_template = locate_template('templates/tag.php');
        if ($tag_template) {
            error_log('Tag template found: ' . $tag_template);
            return $tag_template;
        } else {
            error_log('Tag template not found');
        }
    }

    if (is_archive()) {
        $archive_template = locate_template('templates/archive.php');
        if ($archive_template) {
            error_log('Archive template found: ' . $archive_template);
            return $archive_template;
        } else {
            error_log('Archive template not found');
        }
    }

    if (is_search()) {
        $search_template = locate_template('templates/search.php');
        if ($search_template) {
            error_log('Search template found: ' . $search_template);
            return $search_template;
        } else {
            error_log('Search template not found');
        }
    }

    if (is_404()) {
        $error_template = locate_template('templates/404.php');
        if ($error_template) {
            error_log('404 template found: ' . $error_template);
            return $error_template;
        } else {
            error_log('404 template not found');
        }
    }

    // Default custom template path
    $custom_template_path = 'templates/' . $template_name;
    $custom_template = locate_template($custom_template_path);

    // If a custom template is found, return it
    if ($custom_template) {
        error_log('Custom template found: ' . $custom_template);
        return $custom_template;
    }

    // Log if no custom template was found
    error_log('Custom template not found, using default: ' . $template);

    // Return the original template if no custom template is found
    return $template;
}
add_filter('template_include', 'chris_buys_homes_template_include');

// Add custom user fields
function add_custom_user_fields($user)
{
?>
    <h3>Extra Profile Information</h3>
    <table class="form-table">
        <tr>
            <th><label for="author_title">Author Title</label></th>
            <td>
                <input type="text" name="author_title" id="author_title" value="<?php echo esc_attr(get_the_author_meta('author_title', $user->ID)); ?>" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th><label for="full_bio">Full Bio</label></th>
            <td>
                <textarea name="full_bio" id="full_bio" rows="5" cols="30"><?php echo esc_textarea(get_the_author_meta('full_bio', $user->ID)); ?></textarea>
            </td>
        </tr>
    </table>
<?php
}
add_action('show_user_profile', 'add_custom_user_fields');
add_action('edit_user_profile', 'add_custom_user_fields');

// Save custom user fields
function save_custom_user_fields($user_id)
{
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    update_user_meta($user_id, 'author_title', $_POST['author_title']);
    update_user_meta($user_id, 'full_bio', $_POST['full_bio']);
}
add_action('personal_options_update', 'save_custom_user_fields');
add_action('edit_user_profile_update', 'save_custom_user_fields');

function get_breadcrumb()
{
    global $post;
    $breadcrumb = '<nav class="breadcrumb">';
    if (!is_home()) {
        $breadcrumb .= '<a href="' . home_url() . '">Home</a> > ';
        if (is_category() || is_single()) {
            $breadcrumb .= '<a href="' . get_permalink(get_option('page_for_posts')) . '">Blog</a> > ';
            if (is_single()) {
                $categories = get_the_category();
                if ($categories) {
                    $category = $categories[0];
                    $breadcrumb .= '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a> > ';
                }
                $breadcrumb .= '<span>' . get_the_title() . '</span>';
            }
        } elseif (is_page()) {
            if ($post->post_parent) {
                $parent_id  = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                    $parent_id  = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                foreach ($breadcrumbs as $crumb) $breadcrumb .= $crumb . ' > ';
            }
            $breadcrumb .= '<span>' . get_the_title() . '</span>';
        }
    }
    $breadcrumb .= '</nav>';
    return $breadcrumb;
}

function get_offer_button_link()
{
    if (is_front_page()) {
        return '#top';
    } else {
        return home_url('/#top');
    }
}

// Register the REST route
add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/submit-form', array(
        'methods' => 'POST',
        'callback' => 'handle_form_submission',
        'permission_callback' => '__return_true', // Allow public access
    ));
});

// Define the form submission handler
function handle_form_submission(WP_REST_Request $request)
{
    $form_data = $request->get_params();

    $response = wp_remote_post(CRM_WEBHOOK_URL, array(
        'body' => http_build_query($form_data),
        'headers' => array(
            'Content-Type' => 'application/x-www-form-urlencoded'
        ),
    ));

    if (is_wp_error($response)) {
        return new WP_REST_Response('Error sending data to webhook', 500);
    }

    return new WP_REST_Response('Form submitted successfully', 200);
}


// // Remove category base
// // Remove category base
// function custom_remove_category_base()
// {
//     // Remove the category base from permalinks
//     add_filter('category_rewrite_rules', 'custom_category_rewrite_rules');
//     add_filter('request', 'custom_category_request');
// }
// add_action('init', 'custom_remove_category_base');

// function custom_category_rewrite_rules($category_rewrite)
// {
//     $category_rewrite = array();
//     $categories = get_categories(array('hide_empty' => false));
//     foreach ($categories as $category) {
//         $category_nicename = $category->slug;
//         if ($category->parent == $category->cat_ID) {
//             $category->parent = 0;
//         } elseif ($category->parent != 0) {
//             $category_nicename = get_category_parents($category->parent, false, '/', true) . $category_nicename;
//         }
//         $category_rewrite['blog/' . $category_nicename . '/?$'] = 'index.php?category_name=' . $category->slug;
//         $category_rewrite['blog/' . $category_nicename . '/page/?([0-9]{1,})/?$'] = 'index.php?category_name=' . $category->slug . '&paged=$matches[1]';
//         $category_rewrite['blog/' . $category_nicename . '/(.*)$'] = 'index.php?category_name=' . $category->slug . '&attachment=$matches[1]';
//     }
//     return $category_rewrite;
// }

// function custom_category_request($request)
// {
//     if (isset($request['category_name'])) {
//         $category_name = explode('/', $request['category_name']);
//         if (isset($category_name[1])) {
//             $request['category_name'] = $category_name[1];
//         }
//     }
//     return $request;
// }

function add_custom_query_vars($vars)
{
    $vars[] = 'custom_path';  // Register custom_path as a valid query var
    return $vars;
}
add_filter('query_vars', 'add_custom_query_vars');


function dynamic_landing_page_rewrite_rules()
{
    // Capture any URL that starts with /lp/ and store everything after it as custom_path
    add_rewrite_rule('^lp/(.+)/?', 'index.php?custom_path=$matches[1]', 'top');
}
add_action('init', 'dynamic_landing_page_rewrite_rules');


function handle_dynamic_path_redirect()
{
    // Get the custom path from the URL
    $custom_path = get_query_var('custom_path');

    // Debugging: Log the custom_path to ensure it's being captured
    error_log('Custom Path: ' . ($custom_path ? $custom_path : 'No path'));

    // Check if the custom path is empty or if it's a request for a static asset
    if (empty($custom_path) || preg_match('/\.(?:css|js|png|jpg|jpeg|gif|ico|svg|map)$/', $custom_path)) {
        error_log('No custom path found or static file request');
        return;  // Exit early if no custom path is found or it's a static file request
    }

    // Query the database for a page with a matching custom URL slug
    $args = array(
        'post_type' => 'page',
        'meta_query' => array(
            array(
                'key' => 'custom_url_slugs',  // This is the ACF field name
                'value' => $custom_path,      // Match the custom path from the URL
                'compare' => 'LIKE'
            )
        )
    );

    // Run the query
    $query = new WP_Query($args);

    // Check if a page was found
    if ($query->have_posts()) {
        $page = $query->posts[0];  // Get the first matching page

        // Set up the post data to render the page
        global $wp_query;
        $wp_query->post = $page;
        $wp_query->queried_object = $page;
        $wp_query->is_page = true;
        $wp_query->is_singular = true;
        $wp_query->is_404 = false;

        // Ensure Gutenberg blocks are parsed correctly
        $parsed_content = parse_blocks($page->post_content);
        $rendered_content = '';
        foreach ($parsed_content as $block) {
            $rendered_content .= render_block($block);
        }

        // Output the header with meta tags before rendering content
        chris_buys_homes_get_header();

        // Output the rendered content
        echo $rendered_content;

        // Output the footer after the content
        chris_buys_homes_get_footer();

        exit;
    } else {
        // If no matching page is found, return a 404 error
        global $wp_query;
        $wp_query->is_404 = true;
        status_header(404);
        include(get_404_template());
        exit;
    }
}
add_action('template_redirect', 'handle_dynamic_path_redirect');
