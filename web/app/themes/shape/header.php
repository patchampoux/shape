<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shape
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<!doctype html>
<html prefix="og: http://ogp.me/ns#" class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'is-loading' ); ?>>
<?php wp_body_open(); ?>
<div class="preloader"></div>
<div id="page" class="site">
	<a class="skip-link visually-hidden-focusable" href="#main"><?php esc_html_e( 'Skip to content', 'shape' ); ?></a>

	<header id="masthead" class="site-header l-header">
		<div class="fixed-top bg-body-tertiary">
			<nav id="nav-main" class="navbar navbar-expand-lg">
				<div class="container">
					<!-- Navbar Brand -->
					<?php if ( is_front_page() ) : ?>
						<h1 class="site-title navbar-brand"><?php bloginfo( 'name' ); ?></h1>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url() ); ?>" class="site-title navbar-brand" rel="home"><?php bloginfo( 'name' ); ?></a>
					<?php endif; ?>

					<!-- Offcanvas Navbar -->
					<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas-navbar">
						<div class="offcanvas-header">
							<span class="h5 offcanvas-title"><?php esc_html_e( 'Menu', 'shape' ); ?></span>
							<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="<?php esc_html_e( 'Close', 'shape' ); ?>"></button>
						</div>
						<div class="offcanvas-body">
							<!-- Bootstrap 5 Nav Walker Main Menu -->
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'main-menu',
									'container'      => false,
									'menu_id'        => 'main-menu',
									'menu_class'     => '',
									'fallback_cb'    => '__return_false',
									'items_wrap'     => '<ul id="shape-navbar" class="navbar-nav ms-auto %2$s">%3$s</ul>',
									'depth'          => 2,
									'walker'         => new Bootstrap_5_Wp_Nav_Menu_Walker(),
								)
							);
							?>
						</div>
					</div>

					<div class="header-actions d-flex align-items-center">
						<?php get_template_part( 'template-parts/header/actions' ); ?>

						<!-- Navbar Toggler -->
						<button class="btn btn-outline-secondary d-lg-none ms-1 ms-md-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-navbar" aria-controls="offcanvas-navbar" aria-label="<?php esc_html_e( 'Menu', 'shape' ); ?>">
							<i class="fa-solid fa-bars"></i>
						</button>
					</div> <!-- .header-actions -->
				</div> <!-- .container -->
			</nav> <!-- .navbar -->

			<?php get_template_part( 'template-parts/header/top-nav-search-collapse' ); ?>
		</div> <!-- .fixed-top -->
	</header><!-- #masthead -->
