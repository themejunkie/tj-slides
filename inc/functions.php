<?php
/**
 * Custom functions needed by the plugin.
 * 
 * @package    Theme_Junkie_Slides
 * @since      0.1.0
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Remove uneeded theme-support for the post type.
 * 
 * @since  0.1.0
 */
function tjs_remove_theme_support_metabox() {
	/* Remove theme-layouts Hybrid Core feature. */
	remove_post_type_support( 'slides', 'theme-layouts' );
}
add_action( 'init', 'tjs_remove_theme_support_metabox', 11 );