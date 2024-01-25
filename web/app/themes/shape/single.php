<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Shape
 */

get_header();
?>

	<div id="content" class="site-content container py-5 mt-4">
		<div id="primary" class="content-area">
			<?php the_breadcrumb(); ?>

			<div class="row">
				<div class="<?php echo esc_attr( shape_main_col_class() ); ?>">
					<main id="main" class="site-main l-main">
						<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content', get_post_type() );

							the_post_navigation(
								array(
									'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'shape' ) . '</span> <span class="nav-title">%title</span>',
									'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'shape' ) . '</span> <span class="nav-title">%title</span>',
								)
							);

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						?>
					</main><!-- #main -->
				</div>

				<?php get_sidebar(); ?>
			</div>
		</div> <!-- .content-area -->
	</div> <!-- .site-content -->

<?php
get_footer();
