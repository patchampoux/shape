<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package Shape
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Register widgets
 */
function shape_widgets_init() {
	// Top Nav Search.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Top Nav Search', 'shape' ),
			'id'            => 'top-nav-search',
			'description'   => esc_html__( 'Add widgets here.', 'shape' ),
			'before_widget' => '<div class="top-nav-search">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget-title d-none">',
			'after_title'   => '</div>',
		)
	);

	// Sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'shape' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'shape' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s card card-body mb-4">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title card-header h5">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'shape_widgets_init' );

/**
 * Enable shortcodes in HTML-Widget
 */
add_filter( 'widget_text', 'do_shortcode' );
