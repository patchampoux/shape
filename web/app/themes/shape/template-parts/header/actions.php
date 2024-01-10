<?php
/**
 * Template part for displaying the header-actions
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Shape
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( is_active_sidebar( 'top-nav-search' ) ) :
	?>
	<div class="d-none d-lg-block ms-1 ms-md-2 top-nav-search-lg">
		<?php dynamic_sidebar( 'top-nav-search' ); ?>
	</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'top-nav-search' ) ) : ?>
	<button class="btn btn-outline-secondary d-lg-none ms-1 ms-md-2 top-nav-search-md" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-search" aria-expanded="false" aria-controls="collapse-search">
		<i class="fa-solid fa-magnifying-glass"></i><span class="visually-hidden-focusable"><?php esc_html_e( 'Search', 'shape' ); ?></span>
	</button>
<?php endif; ?>