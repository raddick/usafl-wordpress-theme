<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
	wp_enqueue_style( 'usafl-wordpress-theme',
		get_stylesheet_uri(),
		array( 'miniva' ),
		wp_get_theme()->get( '2.0' ) // This only works if you have Version defined in the style header.
	);
}
