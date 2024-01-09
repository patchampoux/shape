<?php
/**
 * Shape functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Shape
 */

/**
 * Theme setup
 */
require get_template_directory() . '/inc/theme.php';

/**
 * Actions
 */
require get_template_directory() . '/inc/actions.php';

/**
 * Filters
 */
require get_template_directory() . '/inc/filters.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
