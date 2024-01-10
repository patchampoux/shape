<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Shape
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php shape_category_badge(); ?>

		<?php
		if ( is_singular() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		?>

		<?php if ( 'post' === get_post_type() ) : ?>
			<p class="entry-meta">
				<small class="text-body-tertiary">
					<?php
					shape_date();
					shape_author();
					shape_comment_count();
					?>
				</small>
			</p> <!-- .entry-meta -->
		<?php endif; ?>

		<?php shape_post_thumbnail(); ?>
	</header> <!-- .entry-header -->
	<div class="entry-content editor">
		<?php the_content(); ?>

		<?php
		the_content(
			sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="visually-hidden"> "%s"</span>', 'shape' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		?>
	</div> <!-- .entry-content -->
	<footer class="entry-footer clear-both">
		<div class="mb-4">
			<?php shape_tags(); ?>
		</div>
		<nav aria-label="<?php esc_html_e( 'page navigation', 'shape' ); ?>">
			<ul class="pagination justify-content-center">
				<li class="page-item">
					<?php previous_post_link( '%link' ); ?>
				</li>
				<li class="page-item">
					<?php next_post_link( '%link' ); ?>
				</li>
			</ul>
		</nav>

		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>
	</footer> <!-- .entry-footer -->
</article> <!-- #post-<?php the_ID(); ?> -->
