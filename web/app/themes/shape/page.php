<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Shape
 */

get_header();
?>

	<div id="content" class="site-content container py-5 mt-5">
		<div id="primary" class="content-area">
			<div class="row">
				<div class="<?php echo esc_attr( shape_main_col_class() ); ?>">
					<main id="main" class="site-main l-main">
						<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content', 'page' );
						endwhile; // End of the loop.
						?>
					</main>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>

<?php
get_footer();