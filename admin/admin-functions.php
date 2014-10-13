<?php
/**
 * Admin functions for the plugin.
 *
 * @package    Theme_Junkie_Slides
 * @since      0.1.0
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Filter the 'enter title here' placeholder.
 *
 * @since  0.1.0
 * @param  string  $title
 * @return string
 */
function tjs_title_placeholder( $title ) {
	if ( 'slides' == get_current_screen()->post_type ) {
		$title = esc_attr__( 'Enter slide title here', 'tj-slides' );
	}
	
	return $title;
}
add_filter( 'enter_title_here', 'tjs_title_placeholder', 10 );

/**
 * Move Featured Image Metabox on 'slides' post type.
 * 
 * @since  0.1.0
 */
function tjs_featured_image_metabox() {
	remove_meta_box( 'postimagediv', 'slides', 'side' );
	add_meta_box( 'postimagediv', __( 'Upload Slide Image', 'tj-slides' ), 'post_thumbnail_meta_box', 'slides', 'normal', 'high' );
}		
add_action( 'do_meta_boxes', 'tjs_featured_image_metabox' );

/**
 * Sets up custom columns on the slides edit screen.
 *
 * @since  0.1.0
 * @param  array  $columns
 * @return array
 */
function tjs_edit_slides_columns( $columns ) {
	global $post;

	unset( $columns['title'] );

	$new_columns = array(
		'cb'    => '<input type="checkbox" />',
		'title' => __( 'Name', 'tj-slides' ) );

	if ( current_theme_supports( 'post-thumbnails' ) ) {
		$new_columns['thumbnail'] = __( 'Thumbnail', 'tj-slides' );
	}

	$new_columns['date']      = __( 'Date', 'tj-slides' );

	return array_merge( $new_columns, $columns );
}
add_filter( 'manage_edit-slides_columns', 'tjs_edit_slides_columns' );

/**
 * Displays the content of custom slides columns on the edit screen.
 *
 * @since  0.1.0
 * @param  string  $column
 * @param  int     $post_id
 */
function tjs_manage_slides_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		case 'thumbnail' :

			if ( has_post_thumbnail() ) {
				the_post_thumbnail( array( 40, 40 ) );
			} elseif ( function_exists( 'get_the_image' ) ) {
				get_the_image( array( 'image_scan' => true, 'width' => 40, 'height' => 40 ) );
			}

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}
add_action( 'manage_slides_posts_custom_column', 'tjs_manage_slides_columns', 10, 2 );