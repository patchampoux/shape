<?php
/**
 * Columns
 *
 * @package Shape
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Make main content col dynamic if sidebar widgets exists
 *
 * @return string
 */
function shape_main_col_class() {
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		// Sidebar is empty
		return 'col';
	} else {
		// Sidebar has widgets
		return 'col-md-8 col-lg-9';
	}
}

/**
 * Sidebar column width and breakpoints
 *
 * @return string
 */
function shape_sidebar_col_class() {
	return 'col-md-4 col-lg-3 order-first order-md-last';
}

/**
 * Sidebar responsive offcanvas toggler
 *
 * @return string
 */
function shape_sidebar_toggler_class() {
	return 'd-md-none btn btn-outline-primary w-100 mb-4 d-flex justify-content-between align-items-center';
}

/**
 * Sidebar responsive offcanvas breakpoint and placement
 *
 * @return string
 */
function shape_sidebar_offcanvas_class() {
	return 'offcanvas-md offcanvas-end';
}
