<?php
/* ------------------------------------------------------------------------- *
 *  Custom functions
/* ------------------------------------------------------------------------- */

add_action( 'wp_enqueue_scripts', 'cdvz_enqueue_parent_style' );
function cdvz_enqueue_parent_style() {
	wp_enqueue_style( 'codevz-style', get_template_directory_uri() . '/style.css' );
}
	
	// Add your custom functions here, or overwrite existing ones. Read more how to use:
	// http://codex.wordpress.org/Child_Themes