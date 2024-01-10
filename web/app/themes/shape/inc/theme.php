<?php
/**
 * Theme setup functions
 *
 * @package Shape
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

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
function shape_setup(): void {
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
			'main-menu'   => esc_html__( 'Main menu', 'shape' ),
			'footer-menu' => esc_html__( 'Footer menu', 'shape' ),
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
remove_action( 'wp_head', 'rsd_link' ); // remove really simple discovery link.
remove_action( 'wp_head', 'wp_generator' ); // remove WordPress version.
remove_action( 'wp_head', 'feed_links', 2 ); // remove rss feed links (make sure you add them in yourself if you're using feedblitz or a rss service).
remove_action( 'wp_head', 'feed_links_extra', 3 ); // removes all extra rss feed links.
remove_action( 'wp_head', 'index_rel_link' ); // remove link to index page.
remove_action( 'wp_head', 'wlwmanifest_link' ); // remove wlwmanifest.xml (needed to support windows live writer).
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // remove random post link.
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // remove parent post link.
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // remove the next and previous post links.
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
function shape_content_width(): void {
	$GLOBALS['content_width'] = apply_filters( 'shape_content_width', 900 );
}

add_action( 'after_setup_theme', 'shape_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function shape_scripts(): void {
	wp_enqueue_style( 'shape-style', get_stylesheet_uri(), array(), SHAPE_VERSION );
	wp_enqueue_style( 'bootscore-style', get_template_directory_uri() . '/assets/dist/css/bootscore.css', array(), '5.3.2' );
	wp_enqueue_style( 'shape-main', get_template_directory_uri() . '/assets/dist/css/main.css', array( 'bootscore-style' ), SHAPE_VERSION );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/fontawesome/css/all.min.css', array(), '6.5.1' );

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/node_modules/bootstrap/dist/js/bootstrap.bundle.js', array(), '5.3.2', true );
	wp_enqueue_script( 'bootscore', get_template_directory_uri() . '/assets/dist/js/vendor/bootscore.js', array( 'jquery' ), '5.3.2', true );
	wp_enqueue_script( 'shape-script', get_template_directory_uri() . '/assets/dist/js/script.js', array( 'bootstrap' ), SHAPE_VERSION, array( 'in_footer' => true ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'shape_scripts' );

/**
 * Add module attr to script.js
 */
function shape_add_module_to_my_script( $tag, $handle, $src ) {
	if ( 'shape-script' === $handle ) {
		$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
	}

	return $tag;
}

add_filter( 'script_loader_tag', 'shape_add_module_to_my_script', 10, 3 );

/**
 * Print critical styles in head
 */
function shape_critical_styles(): void {
	$request  = wp_remote_get(
		get_template_directory_uri() . '/assets/dist/css/critical.css',
		array(
			'method'  => 'GET',
			'headers' => array(
				'Authorization' => 'Basic ' . base64_encode( getenv( 'HTPASSWD_USERNAME' ) . ':' . getenv( 'HTPASSWD_PASSWORD' ) ),
			),
		)
	);
	$response = wp_remote_retrieve_body( $request );
	?>
	<style id="critical-css"><?php echo esc_attr( $response ); ?></style>
	<?php
}

add_action( 'wp_head', 'shape_critical_styles', 100 );

/**
 * Preload Font Awesome
 */
function bootscore_fa_preload( $tag ) {
	$tag = preg_replace( "/id='fontawesome-css'/", "id='fontawesome-css' onload=\"if(media!='all')media='all'\"", $tag );

	return $tag;
}

add_filter( 'style_loader_tag', 'bootscore_fa_preload' );

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

/**
 * Disable widgets block editor
 */
add_filter( 'use_widgets_block_editor', '__return_false' );

/**
 * Disable hash theme support
 */
function shape_disable_hash_themes_support() {
	remove_theme_support( 'widgets-block-editor' );
}

add_action( 'after_setup_theme', 'shape_disable_hash_themes_support' );