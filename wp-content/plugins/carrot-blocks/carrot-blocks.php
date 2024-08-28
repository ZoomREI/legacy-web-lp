<?php

/**
 * Plugin Name:       Carrot Blocks
 * Description:       Custom blocks package developed for the Carrot Website.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Omri Ashkenazi
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       chris-buys-blocks
 *
 * @package ChrisBuysBlocks
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function carrot_blocks_carrot_blocks_block_init()
{
	$blocks = [
		'carrot-header',
		'carrot-hero',
		'we-buy-houses',
		'never-lowball',
		'google-reviews',
		'we-can-help',
		'home-buyer',
		'we-help',
		'no-inspectors',
		'how-to',
		'local-company',
		'fast-cash-offer',
		'no-obligation',
		'commercial',
		'as-is',
		'reviews',
		'new-and-easy',
	];

	foreach ($blocks as $block) {
		register_block_type(__DIR__ . "/build/$block");
		add_shortcode("carrot_blocks_$block", function ($atts) use ($block) {
			$attributes = shortcode_atts([], $atts);
			return render_block([
				'blockName' => "carrot-buys/$block",
				'attrs' => $attributes,
			]);
		});
	}
}
add_action('init', 'carrot_blocks_carrot_blocks_block_init');
