<?php
/**
 * Actions functions
 *
 * @package Shape
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Flush W3 Total Cache all cache on save
 */
function shape_flush_all_cache_on_save() {
	if ( function_exists( 'w3tc_flush_all' ) ) {
		w3tc_flush_all();
	}
}

add_action( 'save_post', 'shape_flush_all_cache_on_save', 20 );

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
