<?php
/**
 * Shape functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Shape
 */

/**
 * Load required files
 */
require get_template_directory() . '/inc/theme.php';
require get_template_directory() . '/inc/actions.php';
require get_template_directory() . '/inc/filters.php';
require get_template_directory() . '/inc/breadcrumb.php';
require get_template_directory() . '/inc/columns.php';
require get_template_directory() . '/inc/comments.php';
require get_template_directory() . '/inc/enable-html.php';
require get_template_directory() . '/inc/excerpt.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/inc/password-protected-form.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/widgets.php';

/**
 * Load Bootstrap 5 Nav Walker and registers menus
 * Remove this snippet in v6 and add nav-walker to the enqueue list
 * https://github.com/orgs/bootscore/discussions/347
 */
function register_navwalker() {
	require get_template_directory() . '/inc/class-bootstrap-5-navwalker.php';
	// Register Menus.
	register_nav_menu( 'main-menu', 'Main menu' );
	register_nav_menu( 'footer-menu', 'Footer menu' );
}

add_action( 'after_setup_theme', 'register_navwalker' );

/**
 * Load Jetpack compatibility file
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
