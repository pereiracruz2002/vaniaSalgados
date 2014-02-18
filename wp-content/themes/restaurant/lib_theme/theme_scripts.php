<?php

/*

  FILE STRUCTURE:

- THEME SCRIPTS

*/

/* THEME SCRIPTS */
/*------------------------------------------------------------------*/

// Add Theme Javascript
if (!is_admin()) add_action( 'wp_print_scripts', 'bizz_add_javascript' );
function bizz_add_javascript( ) {

	// offline
	wp_enqueue_script( 'jquery'); #header
	wp_enqueue_script( 'theme-js', BIZZ_THEME_JS .'/theme.js', array( 'jquery' ) ); # header

}
