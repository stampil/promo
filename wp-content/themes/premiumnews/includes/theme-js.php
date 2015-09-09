<?php
if ( ! is_admin() ) { add_action( 'wp_print_scripts', 'woothemes_add_javascript' ); }

function woothemes_add_javascript() {
	$template_directory = get_template_directory_uri();

	wp_enqueue_script( 'lavalamp', $template_directory . '/includes/js/jquery.lavalamp.js', array( 'jquery' ) );
	wp_enqueue_script( 'tabs', $template_directory . '/includes/js/tabs.js', array( 'jquery' ) );
	wp_enqueue_script( 'superfish', $template_directory . '/includes/js/superfish.js', array( 'jquery' ) );
	wp_enqueue_script( 'bgiframe', $template_directory . '/includes/js/jquery.bgiframe.min.js', array( 'jquery' ) );
}
?>