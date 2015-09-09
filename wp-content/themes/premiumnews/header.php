<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">


<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>

<link rel="stylesheet" type="text/css"  href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/includes/js/jquery-1.3.2.min.js"></script>
<?php wp_head(); ?>

<!--[if lte IE 6]>
<script defer type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/images/pngfix.js"></script>
<![endif]-->

<?php include(TEMPLATEPATH . '/includes/stylesheet.php'); ?>   

<script type="text/javascript">
jQuery(document).ready(function() {
		
		if(jQuery().superfish) {
		
			jQuery( 'ul.nav, ul.nav2' ).superfish({
				delay: 200,
				animation: {opacity:'show', height:'show'},
				speed: 'fast',
				dropShadows: false
			});
			jQuery( '.cats-list' ).superfish({
				delay: 200,
				animation: {opacity:'show', height:'show'},
				speed: 'fast',
				dropShadows: false
			});
		
		}

jQuery("#lavaLamp, #2, #3").lavaLamp({
        fx: "backout", 
        speed: 700,
        click: function(event, menuItem) {
            return true;
        }
    });
    
});
</script>        
 
</head>

<body <?php body_class(); ?>>

<?php
	$featuredcat = get_option('woo_featured_category'); // ID of the Featured Category
	$GLOBALS[ex_feat] = $wpdb->get_var("SELECT term_id FROM $wpdb->terms WHERE name='$featuredcat'");

	$vidcat = get_option('woo_video_category'); // ID of the Video Category
	$GLOBALS[ex_vid] = $wpdb->get_var("SELECT term_id FROM $wpdb->terms WHERE name='$vidcat'");		
?>

<div id="page">
	
	<div id="nav"> <!-- START TOP NAVIGATION BAR -->
	
		<div id="nav-left">
			<?php
			if ( function_exists('has_nav_menu') && has_nav_menu('primary-menu') ) {
				wp_nav_menu( array( 'depth' => 1, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'lavaLamp', 'theme_location' => 'primary-menu' ) );
			} else {
			?>
			<ul id="lavaLamp">
			<?php
			if ( get_option('woo_custom_nav_menu') == 'true' ) {
        		if ( function_exists('woo_custom_navigation_output') )
					woo_custom_navigation_output('depth=1');

				} else { ?>		
				<li><a href="<?php echo get_option('home'); ?>/">Home</a></li>
				<?php wp_list_pages('depth=1&sort_column=menu_order&title_li=' ); ?>
				<?php } ?>	
			</ul>
			<?php } ?>
		</div><!--/nav-left -->

		<div id="nav-right">		
		
			<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
				
				<div id="search">
					<input type="text" value="<?php _e('Enter your search keywords here...',woothemes); ?>" onclick="this.value='';" name="s" id="s" />
					<input name="" type="image" src="<?php bloginfo('template_directory'); ?>/styles/<?php echo "$style_path"; ?>/ico-go.gif" value="<?php _e('Go',woothemes); ?>" class="btn"  />
				</div><!--/search -->
				
			</form>
		
		</div><!--/nav-right -->
		
	</div><!--/nav-->
	
	<div id="header"><!-- START LOGO LEVEL WITH RSS FEED -->
		
		<h1><a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>"><img src="<?php if ( get_option('woo_logo') <> "" ) {  echo get_option('woo_logo'); } else { ?><?php bloginfo('template_directory'); ?>/images/logo.gif<?php } ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /></a></h1>
		
		<div id="rss">
			
			<a href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>"><img src="<?php bloginfo('template_directory'); ?>/images/ico-rss.gif" alt="" /></a>
			
			<ul>
				<li class="hl"><a href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>"><?php _e('SUBSCRIBE TO THE RSS FEED',woothemes); ?></a></li>
				<li><a href="<?php echo get_option('woo_feedburner_id'); ?>" target="_blank"><?php _e('SUBSCRIBE TO THE FEED VIA E-MAIL',woothemes); ?></a></li>
			</ul>
			
		</div><!--/rss-->
		
	</div><!--/header -->
	
	<div id="suckerfish"><!-- START CATEGORY NAVIGATION (SUCKERFISH CSS) -->
			<?php
			if ( function_exists('has_nav_menu') && has_nav_menu('secondary-menu') ) {
				wp_nav_menu( array( 'depth' => 3, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_class' => 'nav2', 'theme_location' => 'secondary-menu' ) );
			} else {
			?>
			<ul class="nav2">
			<?php
			if ( get_option('woo_custom_nav_menu') == 'true' ) {
        		if ( function_exists('woo_custom_navigation_output') )
					woo_custom_navigation_output('name=Woo Menu 2&depth=3');

			} else { ?>
				<?php wp_list_categories('title_li=') ?>	
			<?php } ?>
			</ul>
			<?php } ?>
					
	</div><!--/nav2-->
	
	<div id="columns"><!-- START MAIN CONTENT COLUMNS -->