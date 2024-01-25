<?php
/**
 * Filters functions
 *
 * @package Shape
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Disable auto scale of large images
 */
add_filter( 'big_image_size_threshold', '__return_false' );

/**
 * Change HTML lang attribute value from fr-FR to fr-CA
 */
function shape_change_html_locale( $output ) {
	return str_replace( 'fr-FR', 'fr-CA', $output );
}

add_filter( 'language_attributes', 'shape_change_html_locale' );

/**
 * Changes YOAST locale output.
 */
function shape_wpseo_change_og_locale( $locale ) {
	return str_replace( 'fr_FR', 'fr_CA', $locale );
}

add_filter( 'wpseo_locale', 'shape_wpseo_change_og_locale' );

/**
 * Google Maps API key
 */
add_filter(
	'acf/settings/google_api_key',
	function () {
		return getenv( 'GMAP_KEY' );
	}
);

/**
 * Sanitize Medias File Name
 */
function shape_satitize_file_name( $filename ) {
	$info = pathinfo( $filename );
	$ext  = empty( $info['extension'] ) ? '' : '.' . $info['extension'];
	$name = basename( $filename, $ext );

	return strtolower( sanitize_title( $name ) ) . $ext;
}

add_filter( 'sanitize_file_name', 'shape_satitize_file_name', 10 );

/**
 * Remove H1 and PRE tag from WYSIWYG
 * Modifying TinyMCE editor to remove unused items.
 */
function shape_mce_block_formats( $arr ) {
	$arr['block_formats'] = 'Paragraphe=p;Titre 2=h2;Titre 3=h3;Titre 4=h4;Titre 5=h5;Titre 6=h6';

	return $arr;
}

add_filter( 'tiny_mce_before_init', 'shape_mce_block_formats' );

/**
 * Remove unnecessary buttons in WYSIWYG
 */
function shape_remove_tiny_mce_buttons_from_editor( $buttons ) {
	$remove_buttons = array(
		'blockquote', // blockquote.
		'wp_more', // read more link.
	);

	foreach ( $buttons as $button_key => $button_value ) {
		if ( in_array( $button_value, $remove_buttons ) ) {
			unset( $buttons[ $button_key ] );
		}
	}

	return $buttons;
}

add_filter( 'mce_buttons', 'shape_remove_tiny_mce_buttons_from_editor' );

function shape_remove_tiny_mce_buttons_from_kitchen_sink( $buttons ) {
	$remove_buttons = array(
		'forecolor', // text color.
	);

	foreach ( $buttons as $button_key => $button_value ) {
		if ( in_array( $button_value, $remove_buttons ) ) {
			unset( $buttons[ $button_key ] );
		}
	}

	return $buttons;
}

add_filter( 'mce_buttons_2', 'shape_remove_tiny_mce_buttons_from_kitchen_sink' );

/**
 * Add WYSIWYG custom styles
 */
function shape_add_style_select_buttons( $buttons ) {
	array_unshift( $buttons, 'styleselect' );

	return $buttons;
}

add_filter( 'mce_buttons_2', 'shape_add_style_select_buttons' );

function shape_custom_wysiwyg_styles( $init_array ) {
	$style_formats = array(
		array(
			'title'   => 'Renvoi à la ligne',
			'block'   => 'div',
			'classes' => 'clear',
			'exact'   => true,
			'wrapper' => true,
			'styles'  => array(
				'clear' => 'both',
			),
		),
	);

	$init_array['style_formats'] = wp_json_encode( $style_formats );

	return $init_array;
}

add_filter( 'tiny_mce_before_init', 'shape_custom_wysiwyg_styles' );

/**
 * Create an extra basic WYSIWYG
 * Add a new toolbar called "Extra Basic"
 * - this toolbar has only 1 row of buttons
 */
function shape_extra_basic_toolbar( $toolbars ) {
	$toolbars['Extra Basic']    = array();
	$toolbars['Extra Basic'][1] = array( 'bold', 'italic', 'alignleft', 'aligncenter', 'alignright', 'link', 'unlink' );

	return $toolbars;
}

add_filter( 'acf/fields/wysiwyg/toolbars', 'shape_extra_basic_toolbar' );
