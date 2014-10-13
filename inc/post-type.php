<?php
/**
 * File for registering post type.
 *
 * @package    Theme_Junkie_Slides
 * @since      0.1.0
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @link       http://codex.wordpress.org/Function_Reference/register_post_type
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Registers post type needed by the plugin.
 *
 * @since  0.1.0
 */
function tjs_register_post_type() {

	$labels = array(
	    'name'               => __( 'Slides', 'tj-slides' ),
	    'singular_name'      => __( 'Slide', 'tj-slides' ),
    	'menu_name'          => __( 'Slides', 'tj-slides' ),
    	'name_admin_bar'     => __( 'Slide', 'tj-slides' ),
		'all_items'          => __( 'Slides', 'tj-slides' ),
	    'add_new'            => __( 'Add New', 'tj-slides' ),
		'add_new_item'       => __( 'Add New Slide', 'tj-slides' ),
		'edit_item'          => __( 'Edit Slide', 'tj-slides' ),
		'new_item'           => __( 'New Slide', 'tj-slides' ),
		'view_item'          => __( 'View Slide', 'tj-slides' ),
		'search_items'       => __( 'Search Slides', 'tj-slides' ),
		'not_found'          => __( 'No Slides found', 'tj-slides' ),
		'not_found_in_trash' => __( 'No Slides found in trash', 'tj-slides' ),
		'parent_item_colon'  => '',
	);

	$defaults = array(	
		'labels'              => apply_filters( 'tjs_labels', $labels ),
		'public'              => false,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_menu'        => true,
		'exclude_from_search' => true,
		'menu_position'       => 57,
		'menu_icon'           => 'dashicons-images-alt2',
		'supports'            => array( 'title', 'thumbnail', 'revisions' ),
		'rewrite'             => false,
		'has_archive'         => true
	);

	$args = apply_filters( 'tjs_args', $defaults );

	register_post_type( 'slides', $args );

}
add_action( 'init', 'tjs_register_post_type' );