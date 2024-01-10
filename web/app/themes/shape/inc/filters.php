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
