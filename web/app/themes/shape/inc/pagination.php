<?php
/**
 * Pagination
 *
 * @package Shape
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Pagination Categories
 */
function shape_pagination( $pages = '', $range = 2 ) {
	$showitems = ( $range * 2 ) + 1;
	global $paged;
	// default page to one if not provided
	if ( empty( $paged ) ) {
		$paged = 1;
	}
	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;

		if ( ! $pages ) {
			$pages = 1;
		}
	}

	if ( 1 != $pages ) {
		echo '<nav aria-label="Page navigation">';
		echo '<span class="visually-hidden">' . esc_html__( 'Page navigation', 'shape' ) . '</span>';
		echo '<ul class="pagination justify-content-center mb-4">';

		if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
			echo '<li class="page-item"><a class="page-link" href="' . get_pagenum_link( 1 ) . '" aria-label="' . esc_html__( 'First Page', 'shape' ) . '">&laquo;</a></li>';
		}

		if ( $paged > 1 && $showitems < $pages ) {
			echo '<li class="page-item"><a class="page-link" href="' . get_pagenum_link( $paged - 1 ) . '" aria-label="' . esc_html__( 'Previous Page', 'shape' ) . '">&lsaquo;</a></li>';
		}

		for ( $i = 1; $i <= $pages; $i++ ) {
			if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				echo ( $paged == $i ) ? '<li class="page-item active"><span class="page-link"><span class="visually-hidden">' . __( 'Current Page', 'shape' ) . ' </span>' . $i . '</span></li>' : '<li class="page-item"><a class="page-link" href="' . get_pagenum_link( $i ) . '"><span class="visually-hidden">' . __( 'Page', 'shape' ) . ' </span>' . $i . '</a></li>';
			}
		}

		if ( $paged < $pages && $showitems < $pages ) {
			echo '<li class="page-item"><a class="page-link" href="' . get_pagenum_link( ( $paged === 0 ? 1 : $paged ) + 1 ) . '" aria-label="' . esc_html__( 'Next Page', 'shape' ) . '">&rsaquo;</a></li>';
		}

		if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
			echo '<li class="page-item"><a class="page-link" href="' . get_pagenum_link( $pages ) . '" aria-label="' . esc_html__( 'Last Page', 'shape' ) . '">&raquo;</a></li>';
		}

		echo '</ul>';
		echo '</nav>';
		// Uncomment this if you want to show [Page 2 of 30]
		// echo '<div class="pagination-info mb-5 text-center">[ <span class="text-muted">' . __('Page', 'shape') . '</span> '.$paged.' <span class="text-muted">' . __('of', 'shape') . '</span> '.$pages.' ]</div>';
	}
}

/**
 * Pagination Single Posts
 */
function post_link_attributes( $output ) {
	$code = 'class="page-link"';

	return str_replace( '<a href=', '<a ' . $code . ' href=', $output );
}

add_filter( 'next_post_link', 'post_link_attributes' );
add_filter( 'previous_post_link', 'post_link_attributes' );
