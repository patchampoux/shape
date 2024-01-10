<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shape
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<footer id="colophon" class="site-footer l-footer">
	<div class="bg-body-tertiary pt-5 pb-3">
		<div class="container">
			<!-- Bootstrap 5 Nav Walker Footer Menu -->
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer-menu',
					'container'      => false,
					'menu_id'        => 'footer-menu',
					'menu_class'     => '',
					'fallback_cb'    => '__return_false',
					'items_wrap'     => '<ul id="footer-menu" class="nav %2$s">%3$s</ul>',
					'depth'          => 1,
					'walker'         => new Bootstrap_5_Wp_Nav_Menu_Walker(),
				)
			);
			?>
		</div> <!-- .container -->
	</div> <!-- .bg-body-tertiary -->
	<div class="site-info bg-body-tertiary text-body-tertiary border-top py-2 text-center">
		<div class="container">
			<small class="shape-copyright"><span class="cr-symbol">&copy;</span>&nbsp;<?php echo esc_attr( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></small>
		</div>
	</div>
</footer><!-- #colophon -->

<!-- To top button -->
<a href="#" class="btn btn-primary shadow top-button position-fixed zi-1020"><i class="fa-solid fa-chevron-up"></i><span class="visually-hidden-focusable"><?php esc_html_e( 'To top', 'shape' ); ?></span></a>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
