<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Shape
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<section class="no-results not-found">
	<header class="page-header mb-4">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found for', 'shape' ); ?> <span class="text-secondary"><?php echo esc_attr( $s ); ?></span></h1>
	</header> <!-- .page-header -->
	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :
			printf(
				'<p>' . wp_kses(
				/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'shape' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);
		elseif ( is_search() ) :
			?>
			<p class="alert alert-info mb-4"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'shape' ); ?></p>
			<?php
			get_search_form();
		else :
			?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'shape' ); ?></p>
			<?php
			get_search_form();
		endif;
		?>
	</div><!-- .page-content -->
</section>