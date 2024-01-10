<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Shape
 */


// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="card horizontal mb-4">
		<div class="row g-0">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="col-lg-6 col-xl-5 col-xxl-4">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'medium', array( 'class' => 'card-img-lg-start' ) ); ?>
					</a>
				</div>
			<?php endif; ?>

			<div class="col">
				<div class="card-body">
					<?php shape_category_badge(); ?>

					<a class="text-body text-decoration-none" href="<?php the_permalink(); ?>">
						<?php the_title( '<h2 class="blog-post-title h5">', '</h2>' ); ?>
					</a>

					<?php if ( 'post' === get_post_type() ) : ?>
						<p class="meta small mb-2 text-body-tertiary">
							<?php
							shape_date();
							shape_author();
							shape_comments();
							shape_edit();
							?>
						</p>
					<?php endif; ?>

					<p class="card-text">
						<a class="text-body text-decoration-none" href="<?php the_permalink(); ?>">
							<?php echo strip_tags( get_the_excerpt() ); ?>
						</a>
					</p>
					<p class="card-text">
						<a class="read-more" href="<?php the_permalink(); ?>">
							<?php _e( 'Read more »', 'shape' ); ?>
						</a>
					</p>

					<?php shape_tags(); ?>
				</div> <!-- .card-body -->
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .card -->
</article> <!-- #post-<?php the_ID(); ?> -->