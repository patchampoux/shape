<!-- Search Button Outline Secondary Right -->
<form class="searchform input-group" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" name="s" class="form-control" placeholder="<?php _e( 'Search', 'shape' ); ?>">
	<button type="submit" class="input-group-text btn btn-outline-secondary"><i class="fa-solid fa-magnifying-glass"></i><span class="visually-hidden-focusable"><?php _e( 'Search', 'shape' ); ?></span></button>
</form>