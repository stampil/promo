<?php

// Register widgetized areas

function the_widgets_init() {
    if ( !function_exists('register_sidebars') )
        return;

	if ( function_exists('register_sidebar') ) {
	
		register_sidebar(array( 'name' => 'Primary','id' => 'primary','description' => "Primary General Sidebar", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h2 class="hl">','after_title' => '</h2>'));
		
		register_sidebar(array( 'name' => 'Secondary','id' => 'secondary','description' => "Secondary General Sidebar", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h2 class="hl">','after_title' => '</h2>'));
	
	}
    
}

add_action( 'init', 'the_widgets_init' );   
?>