<?php
/**
 * Password protected form
 *
 * @package Shape
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Input group to password protected form
 */
function shape_pw_form() {
	$output = '
        <form action="' . get_option( 'siteurl' ) . '/wp-login.php?action=postpass" method="post" class="input-group pw_form mb-4">' . "\n"
				. '<input name="post_password" type="password" size="" class="form-control" placeholder="' . __( 'Password', 'shape' ) . '"/>' . "\n"
				. '<input type="submit" class="btn btn-outline-primary input-group-text" name="Submit" value="' . __( 'Submit', 'shape' ) . '" />' . "\n"
				. '</form>' . "\n";

	return $output;
}

add_filter( 'the_password_form', 'shape_pw_form' );
