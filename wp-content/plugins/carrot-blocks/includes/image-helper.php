<?php

/**
 * Image Helper Functions
 *
 * Provides functions to generate responsive images and image URLs
 * for use in templates.
 *
 * @package YourPluginName
 */

/**
 * Generates a responsive <img> tag for an image or serves an SVG if it exists.
 *
 * @param string $image_name   The base name of the image, including subdirectories relative to the optimized-assets folder.
 * @param string $alt          The alt text for the image.
 * @param string $class        The class attribute for the <img> tag.
 * @param string $sizes_attr   The sizes attribute for the <img> tag.
 * @param string $extension    The image file extension (default 'webp').
 * @param int    $default_size The default image size for the src attribute.
 * @return string              The HTML <img> tag.
 */
function cb_get_responsive_image($image_name, $alt = '', $class = '', $sizes_attr = '', $extension = 'webp', $default_size = 300)
{
    static $file_cache = []; // Cache to store file existence checks and image dimensions
    
    $base_url = plugin_dir_url(__DIR__) . 'optimized-assets/';
    $base_dir = plugin_dir_path(__DIR__) . 'optimized-assets/';
    $sizes = [150, 300, 768, 1024, 1536, 2048];
    
    // Sanitize inputs
    $image_parts = explode('/', $image_name);
    $image_parts = array_map('sanitize_file_name', $image_parts);
    $image_name_sanitized = implode('/', $image_parts);
    
    $alt = esc_attr($alt);
    $class = esc_attr($class);
    
    // Check if the SVG version exists, and cache the result
    $svg_path = "{$base_dir}{$image_name_sanitized}.svg";
    if (!isset($file_cache[$svg_path])) {
        $file_cache[$svg_path] = file_exists($svg_path);
    }
    
    // If SVG exists, serve it directly without responsive attributes
    if ($file_cache[$svg_path]) {
        $src = esc_url("{$base_url}{$image_name_sanitized}.svg");
        return "<img src='{$src}' alt='{$alt}' class='{$class}'>";
    }
    
    // Generate srcset for responsive images
    $srcset = [];
    foreach ($sizes as $size) {
        $image_file = "{$base_dir}{$image_name_sanitized}-{$size}.{$extension}";
        if (!isset($file_cache[$image_file])) {
            $file_cache[$image_file] = file_exists($image_file);
            if ($file_cache[$image_file]) {
                // Get actual image dimensions
                $image_info = getimagesize($image_file);
                $actual_width = $image_info[0];
                $file_cache[$image_file . '_width'] = $actual_width;
            }
        }
        if ($file_cache[$image_file]) {
            $actual_width = $file_cache[$image_file . '_width'];
            $srcset[] = esc_url("{$base_url}{$image_name_sanitized}-{$size}.{$extension}") . " {$actual_width}w";
        }
    }
    
    // If no images are found, return an empty string or a placeholder
    if (empty($srcset)) {
        return ''; // Or return a placeholder image if desired
    }
    
    $srcset_attr = implode(', ', $srcset);
    
    // Set default sizes attribute if not provided
    if (empty($sizes_attr)) {
        $sizes_attr = '100vw';
    } else {
        $sizes_attr = esc_attr($sizes_attr);
    }
    
    // Use the default size for the src attribute
    $default_image_file = "{$base_dir}{$image_name_sanitized}-{$default_size}.{$extension}";
    if (!isset($file_cache[$default_image_file])) {
        $file_cache[$default_image_file] = file_exists($default_image_file);
    }
    
    if ($file_cache[$default_image_file]) {
        $src = esc_url("{$base_url}{$image_name_sanitized}-{$default_size}.{$extension}");
    } else {
        // Find first available size
        foreach ($sizes as $size) {
            $image_file = "{$base_dir}{$image_name_sanitized}-{$size}.{$extension}";
            if ($file_cache[$image_file]) {
                $src = esc_url("{$base_url}{$image_name_sanitized}-{$size}.{$extension}");
                break;
            }
        }
        if (!isset($src)) {
            return '';
        }
    }
    
    return "<img src='{$src}' alt='{$alt}' class='{$class}' srcset='{$srcset_attr}' sizes='{$sizes_attr}'>";
}

/**
 * Generates the URL for an image file of a specific size, with support for SVG fallback.
 *
 * @param string   $image_name The base name of the image, including subdirectories relative to the optimized-assets folder.
 * @param int|null $size       The desired image size (e.g., 2048). If null, attempts to use the largest available size.
 * @param string   $extension  The primary image file extension (default 'webp').
 * @return string              The URL to the image file.
 */
function cb_get_image_url($image_name, $size = null, $extension = 'webp')
{
    $base_url = plugin_dir_url(__DIR__) . 'optimized-assets/';
    $base_dir = plugin_dir_path(__DIR__) . 'optimized-assets/';
    $sizes = [2048, 1536, 1024, 768, 300, 150]; // Sizes in descending order for fallback
    
    // Split the image name into parts and sanitize each one
    $image_parts = explode('/', $image_name);
    $image_parts = array_map('sanitize_file_name', $image_parts);
    $image_name_sanitized = implode('/', $image_parts);
    
    static $file_cache = []; // Cache to store file existence checks
    
    // List of extensions to try, starting with the primary extension
    $extensions_to_try = [$extension];
    
    // Add 'svg' to the list of extensions to try if it's not the primary extension
    if ($extension !== 'svg') {
        $extensions_to_try[] = 'svg';
    }
    
    foreach ($extensions_to_try as $ext) {
        // If size is specified, attempt to get that size
        if ($size !== null) {
            $size = intval($size); // Ensure size is an integer
            $image_file = "{$image_name_sanitized}-{$size}.{$ext}";
            $image_path = "{$base_dir}{$image_file}";
            
            if (!isset($file_cache[$image_path])) {
                $file_cache[$image_path] = file_exists($image_path);
            }
            
            if ($file_cache[$image_path]) {
                return esc_url("{$base_url}{$image_file}");
            }
        }
        
        // If size not specified or specified size not found, attempt to use the largest available size
        foreach ($sizes as $available_size) {
            $image_file = "{$image_name_sanitized}-{$available_size}.{$ext}";
            $image_path = "{$base_dir}{$image_file}";
            
            if (!isset($file_cache[$image_path])) {
                $file_cache[$image_path] = file_exists($image_path);
            }
            
            if ($file_cache[$image_path]) {
                return esc_url("{$base_url}{$image_file}");
            }
        }
        
        // If no sized image is found, check for image without size suffix
        $image_file = "{$image_name_sanitized}.{$ext}";
        $image_path = "{$base_dir}{$image_file}";
        
        if (!isset($file_cache[$image_path])) {
            $file_cache[$image_path] = file_exists($image_path);
        }
        
        if ($file_cache[$image_path]) {
            return esc_url("{$base_url}{$image_file}");
        }
    }
    
    // Image not found; return empty string or a placeholder URL if desired
    return ''; // Or return a default image URL
}