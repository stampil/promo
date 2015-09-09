<?php
date_default_timezone_set('Europe/Paris');


if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
		'page_title' 	=> 'Parametre',
		'menu_title'	=> 'Parametre',
		'menu_slug' 	=> 'Parametre',
		'redirect'		=> false
	));

}
