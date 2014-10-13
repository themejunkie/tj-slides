<?php
/**
 * Meta box functions for the plugin.
 *
 * @package    Theme_Junkie_Slides
 * @since      0.1.0
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Registers new meta boxes for the 'slides' post editing screen in the admin.
 *
 * @since  0.1.0
 * @param  string  $post_type
 */
function tjs_add_meta_boxes( $post_type ) {

	if ( 'slides' === $post_type ) {

		add_meta_box( 
			'tjs-slide-link-metabox', 
			__( 'Slide Option', 'tj-slides' ), 
			'tjs_metabox_display', 
			$post_type, 
			'side', 
			'core'
		);
	}
}
add_action( 'add_meta_boxes', 'tjs_add_meta_boxes' );

/**
 * Displays the meta box.
 *
 * @since  0.1.0
 * @param  object  $post
 * @param  array   $metabox
 */
function tjs_metabox_display( $post, $metabox ) {

	wp_nonce_field( basename( __FILE__ ), 'tjs-metabox-slides-nonce' ); ?>

	<p>
		<label for="tjs-slide-link"><?php _e( 'Slide <abbr title="Uniform Resource Locator">URL</abbr>', 'tj-slides' ); ?></label>
		<br />
		<input type="text" name="tjs-slide-link" id="tjs-slide-link" value="<?php echo esc_url( get_post_meta( $post->ID, 'tjs_slides_url', true ) ); ?>" size="30" tabindex="30" style="width: 99%;" />
	</p>
	<?php

}

/**
 * Saves the metadata for the slide option info meta box.
 *
 * @since  0.1.0
 * @param  int     $post_id
 * @param  object  $post
 */
function tjs_slide_option_meta_box_save( $post_id, $post ) {

	if ( !isset( $_POST['tjs-metabox-slides-nonce'] ) || !wp_verify_nonce( $_POST['tjs-metabox-slides-nonce'], basename( __FILE__ ) ) )
		return;

	$meta = array(
		'tjs_slides_url' => esc_url( $_POST['tjs-slide-link'] )
	);

	foreach ( $meta as $meta_key => $new_meta_value ) {

		/* Get the meta value of the custom field key. */
		$meta_value = get_post_meta( $post_id, $meta_key, true );

		/* If there is no new meta value but an old value exists, delete it. */
		if ( current_user_can( 'delete_post_meta', $post_id, $meta_key ) && '' == $new_meta_value && $meta_value )
			delete_post_meta( $post_id, $meta_key, $meta_value );

		/* If a new meta value was added and there was no previous value, add it. */
		elseif ( current_user_can( 'add_post_meta', $post_id, $meta_key ) && $new_meta_value && '' == $meta_value )
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );

		/* If the new meta value does not match the old value, update it. */
		elseif ( current_user_can( 'edit_post_meta', $post_id, $meta_key ) && $new_meta_value && $new_meta_value != $meta_value )
			update_post_meta( $post_id, $meta_key, $new_meta_value );
	}
}
add_action( 'save_post', 'tjs_slide_option_meta_box_save', 10, 2 );