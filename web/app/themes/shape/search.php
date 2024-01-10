<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
						<?php if ( have_posts() ) : ?>
							<header class="page-header mb-4">
								<h1>
									<?php
									/* translators: %s: search query. */
									printf( esc_html__( 'Search Results for: %s', 'shape' ), '<span class="text-secondary">' . get_search_query() . '</span>' );
									?>
								</h1>
							</header>

							<?php
							/* Start the Loop */
							while ( have_posts() ) {
								the_post();

								/**
								 * Run the loop for the search to output the results.
								 * If you want to overload this in a child theme then include a file
								 * called content-search.php and that will be used instead.
								 */
								get_template_part( 'template-parts/content', 'search' );
							}

							shape_pagination();
							?>
						<?php else : ?>
							<?php get_template_part( 'template-parts/content', 'none' ); ?>
						<?php endif; ?>
					</main><!-- #main -->
				</div><!-- col -->
				<?php get_sidebar(); ?>
			</div><!-- row -->
		</div><!-- #primary -->
	</div><!-- #content -->
<?php
get_footer();