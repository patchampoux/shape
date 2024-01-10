<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shape
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<div class="<?php echo esc_attr( shape_sidebar_col_class() ); ?>">
	<aside id="secondary" class="widget-area">
		<button class="<?php echo esc_attr( shape_sidebar_toggler_class() ); ?>" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
			<?php esc_html_e( 'Open side menu', 'shape' ); ?> <i class="fa-solid fa-ellipsis-vertical"></i>
		</button>
		<div class="<?php echo esc_attr( shape_sidebar_offcanvas_class() ); ?>" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
			<div class="offcanvas-header">
				<span class="h5 offcanvas-title" id="sidebarLabel"><?php esc_html_e( 'Sidebar', 'shape' ); ?></span>
				<button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebar" aria-label="<?php esc_html_e( 'Close', 'shape' ); ?>"></button>
			</div>
			<div class="offcanvas-body flex-column">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div>
		</div>
	</aside><!-- #secondary -->
</div>