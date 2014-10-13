<?php
/**
 * Customizing the post type messages.
 * 
 * @package    Theme_Junkie_Slides
 * @since      0.1.0
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Portfolio update messages.
 *
 * @param  array  $messages Existing post update messages.
 * @since  0.1.0
 * @access public
 * @return array  Amended post update messages with new CPT update messages.
 */
function tjs_updated_messages( $messages ) {
	global $post, $post_ID;

	$messages['slides'] = array(
		0 => '',
		1 => __( 'Slide updated.', 'tj-slides' ),
		2 => __( 'Custom field updated.', 'tj-slides' ),
		3 => __( 'Custom field deleted.', 'tj-slides' ),
		4 => __( 'Slide updated.', 'tj-slides' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Slide restored to revision from %s', 'tj-slides' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => __( 'Slide published.', 'tj-slides' ),
		7 => __( 'Slide saved.', 'tj-slides' ),
		8 => __( 'Slide submitted.', 'tj-slides' ),
		9 => sprintf( __( 'Slide scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Slide</a>', 'tj-slides' ),
		  // translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i', 'tj-slides' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
		10 => __( 'Slide draft updated.', 'tj-slides' ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'tjs_updated_messages' );