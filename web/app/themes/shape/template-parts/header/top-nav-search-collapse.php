<?php
/**
 * Template part for displaying the top-nav searchform collapse widget
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Shape
 */

if ( is_active_sidebar( 'top-nav-search' ) ) :
	?>
	<div class="collapse container d-lg-none mb-2" id="collapse-search">
		<?php dynamic_sidebar( 'top-nav-search' ); ?>
	</div>
<?php endif; ?>