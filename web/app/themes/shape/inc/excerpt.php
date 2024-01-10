<?php
/**
 * Excerpt
 *
 * @package Shape
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Excerpt to pages
 */
add_post_type_support( 'page', 'excerpt' );
