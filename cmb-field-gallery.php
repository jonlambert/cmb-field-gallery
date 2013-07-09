<?php
/*
Plugin Name: CMB Field Type: Gallery
Plugin URI: https://github.com/mustardBees/cmb-field-gallery
Description: Gallery field type for Custom Metaboxes and Fields for WordPress. Thanks to <a href="http://www.purewebsolutions.nl/">Roel Obdam</a> for the hard work <a href="http://goo.gl/RYj2w">figuring out the media library</a>.
Version: 1.0
Author: Phil Wylie
Author URI: http://www.philwylie.co.uk/
License: GPLv2+
*/

// Useful global constants
define( 'PW_GALLERY_URL', plugin_dir_url( __FILE__ ) );

/**
 * Render field
 */
function pw_gallery_field( $field, $meta ) {
	wp_enqueue_script( 'pw_gallery_init', PW_GALLERY_URL . 'js/script.js', array( 'jquery' ), null );

    if ( ! empty( $meta ) ) {
		$meta = implode( ',', $meta );
	}

	echo '<div class="pw-gallery">';
	echo '	<input type="hidden" id="' . $field['id'] . '" name="' . $field['id'] . '" value="' . $meta . '" />';
	echo '	<input type="button" class="button" value="' . ( ! empty( $field['button'] ) ? $field['button'] : 'Manage gallery' ) . '" />';
	echo '</div>';

	if ( ! empty( $field['desc'] ) ) echo '<p class="cmb_metabox_description">' . $field['desc'] . '</p>';
}
add_filter( 'cmb_render_pw_gallery', 'pw_gallery_field', 10, 2 );


/**
 * Split CSV string into an array of values
 */
function pw_gallery_field_validation( $new ) {
	if ( empty( $new ) ) {
		$new = '';
	} else {
		$new = explode( ',', $new );
	}

	return $new;
}
add_filter( 'cmb_validate_pw_gallery', 'pw_gallery_field_validation', 10, 3 );