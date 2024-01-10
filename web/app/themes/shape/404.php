<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Shape
 */

get_header();
?>

	<div id="content" class="site-content container py-5 mt-5">
		<div id="primary" class="content-area">
			<main id="main" class="site-main l-main">
				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title mb-3"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'shape' ); ?></h1>
					</header><!-- .page-header -->
					<div class="page-content editor">
						<p class="alert alert-info mb-4"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'shape' ); ?></p>
						<div class="mb-4">
							<a class="btn btn-outline-primary" href="<?php echo esc_url( home_url() ); ?>" role="button"><?php esc_html_e( 'Back Home &raquo;', 'shape' ); ?></a>
						</div>
						<div class="mb-4">
							<?php get_search_form(); ?>
						</div>
						<div class="mb-4">
							<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
						</div>
						<div class="widget widget_categories mb-4">
							<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'shape' ); ?></h2>
							<ul>
								<?php
								wp_list_categories(
									array(
										'orderby'    => 'count',
										'order'      => 'DESC',
										'show_count' => 1,
										'title_li'   => '',
										'number'     => 10,
									)
								);
								?>
							</ul>
						</div><!-- .widget -->

						<?php
						/* translators: %1$s: smiley */
						$shape_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'shape' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$shape_archive_content" );

						the_widget( 'WP_Widget_Tag_Cloud' );
						?>
					</div> <!-- .page-content -->
				</section> <!-- .error-404 -->
			</main> <!-- #main -->
		</div> <!-- #primary -->
	</div> <!-- #content -->
<?php
get_footer();
