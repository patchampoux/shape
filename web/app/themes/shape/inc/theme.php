<?php
/**
 * Theme setup functions
 *
 * @package Shape
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'SHAPE_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'SHAPE_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function shape_setup() {
	/*
	* Make theme available for translation.
	* Translations can be filed in the /languages/ directory.
	* If you're building a theme based on Shape, use a find and replace
	* to change 'shape' to the name of your theme in all the template files.
	*/
	load_theme_textdomain( 'shape', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support( 'title-tag' );

	/*
	* Enable support for Post Thumbnails on posts and pages.
	*
	* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'shape' ),
		)
	);

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}

add_action( 'after_setup_theme', 'shape_setup' );

/**
 * Clean up head
 */
remove_action( 'wp_head', 'rsd_link' ); // remove really simple discovery link
remove_action( 'wp_head', 'wp_generator' ); // remove WordPress version
remove_action( 'wp_head', 'feed_links', 2 ); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
remove_action( 'wp_head', 'feed_links_extra', 3 ); // removes all extra rss feed links
remove_action( 'wp_head', 'index_rel_link' ); // remove link to index page
remove_action( 'wp_head', 'wlwmanifest_link' ); // remove wlwmanifest.xml (needed to support windows live writer)
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // remove random post link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // remove parent post link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // remove the next and previous post links
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function shape_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'shape_content_width', 900 );
}

add_action( 'after_setup_theme', 'shape_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function shape_scripts() {
	wp_enqueue_style( 'shape-style', get_stylesheet_uri(), array(), SHAPE_VERSION );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'shape_scripts' );

/**
 * Remove all default block styles from the front
 */
function shape_remove_core_block_styles() {
	global $wp_styles;

	foreach ( $wp_styles->queue as $handle ) {
		if ( str_starts_with( $handle, 'wp-block-' ) ) {
			wp_dequeue_style( $handle );
		}
	}
}

add_action( 'wp_enqueue_scripts', 'shape_remove_core_block_styles' );

/**
 * Remove default block styles from the Block Editor and Site Editor
 */
function shape_remove_default_styles( $styles ) {
	// Create an array with the two handles wp-block-library and wp-block-library-theme.
	$handles = array( 'wp-block-library', 'wp-block-library-theme' );

	foreach ( $handles as $handle ) {
		// Search and compare with the list of registered style handles.
		$style = $styles->query( $handle, 'registered' );

		if ( ! $style ) {
			continue;
		}

		// Remove the style.
		$styles->remove( $handle );
		// Remove path and dependencies.
		$styles->add( $handle, false, array() );
	}
}

add_action( 'wp_default_styles', 'shape_remove_default_styles', PHP_INT_MAX );

/**
 * Remove the inline styles on the front
 */
remove_filter( 'render_block', 'wp_render_layout_support_flag' );
remove_filter( 'render_block', 'gutenberg_render_layout_support_flag' );
remove_filter( 'render_block', 'wp_render_elements_support' );
remove_filter( 'render_block', 'gutenberg_render_elements_support' );

/**
 * Remove global styles on the front
 *
 * @since 1.0.0
 */
function shape_remove_global_styles() {
	wp_dequeue_style( 'global-styles' );
}

add_action( 'wp_enqueue_scripts', 'shape_remove_global_styles', 100 );

/**
 * Add HTML no-js/js class script
 */
function shape_set_html_js_class() {
	?>
	<script>
		document.querySelector('html').classList.remove('no-js');
		document.querySelector('html').classList.add('js');
	</script>
	<?php
}

add_action( 'wp_head', 'shape_set_html_js_class' );

/**
 * Adds option page for Advanced custom field
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(
		array(
			'page_title'      => 'Contenu global',
			'menu_title'      => 'Contenu global',
			'update_button'   => __( 'Mettre à jour', 'acf' ),
			'updated_message' => __( 'Contenu mis à jour', 'acf' ),
		)
	);
}
