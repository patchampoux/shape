<?php
/**
 * Actions functions
 *
 * @package Shape
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Flush W3 Total Cache all cache on save
 */
function shape_flush_all_cache_on_save() {
	if ( function_exists( 'w3tc_flush_all' ) ) {
		w3tc_flush_all();
	}
}

add_action( 'save_post', 'shape_flush_all_cache_on_save', 20 );
