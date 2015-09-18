<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">


<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css"  href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/includes/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/includes/js/Tag_google_analytics.js"></script>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
<link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('template_directory'); ?>/images/iconified/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/images/iconified/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('template_directory'); ?>/images/iconified/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/images/iconified/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('template_directory'); ?>/images/iconified/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_directory'); ?>/images/iconified/apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_directory'); ?>/images/iconified/apple-touch-icon-152x152.png" />
<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_directory'); ?>/images/iconified/apple-touch-icon-180x180.png" />

<link rel="schema.dcterms" href="http://purl.org/dc/terms/">
<meta name="DC.coverage" content="France" />
<meta name="DC.format" content="text/html" />
<meta name="DC.identifier" content="http://jeuxenpromotion.fr" />
<meta name="DC.publisher" content="jeuxenpromotion.fr" />
<meta name="DC.title" content="Jeuxenpromotion - réductions et promo jeux vidéo PC !" />
<meta name="DC.type" content="Text" />

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
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.4&appId=233618803324081";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
		<ul class="apico">
                    <li><span class="apico-white apico-twitter" url="<?php echo get_permalink(); ?>" title="<?php woo_title(); ?>"></span> .apico-twitter</li>
                    <li><span class="apico-white apico-facebook" url="<?php echo get_permalink(); ?>" title="<?php woo_title(); ?>"></span> .apico-facebook</li>
                    <li><span class="apico-white apico-google-plus" url="<?php echo get_permalink(); ?>" title="<?php woo_title(); ?>"></span> .apico-google-plus</li>
                    <li><span class="apico-white apico-linkedin" url="<?php echo get_permalink(); ?>" title="<?php woo_title(); ?>"></span> .apico-linkedin</li>
                    <li><span class="apico-white apico-stumbleupon" url="<?php echo get_permalink(); ?>" title="<?php woo_title(); ?>"></span> .apico-stumbleupon</li>
                    
                    
                </ul>
			
		
		</div><!--/nav-right -->
		
	</div><!--/nav-->
	
	<div id="header"><!-- START LOGO LEVEL WITH RSS FEED -->
		
		<a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>"><img src="<?php if ( get_option('woo_logo') <> "" ) {  echo get_option('woo_logo'); } else { ?><?php bloginfo('template_directory'); ?>/images/logo.png<?php } ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /></a>
		
		<!--div id="rss">
			
			<a href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>"><img src="<?php bloginfo('template_directory'); ?>/images/ico-rss.gif" alt="" /></a>
			
			<ul>
				<li class="hl"><a href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>"><?php _e('SUBSCRIBE TO THE RSS FEED',woothemes); ?></a></li>
				
			</ul>
			
		</div--><!--/rss--><form method="get" id="searchform" action="<?php 
                $post = get_page_by_title('Recherche');
                echo get_permalink($post->ID)
                 ?>/">
				
				<div id="search">
					<input type="text" value="<?php _e('Enter your search keywords here...',woothemes); ?>" onclick="this.value='';" name="q" id="s" />
					<input name="" type="image" src="<?php bloginfo('template_directory'); ?>/styles/<?php echo "$style_path"; ?>/ico-go.gif" value="<?php _e('Go',woothemes); ?>" class="btn"  />
				</div><!--/search -->
				
			</form>
		
	</div><!--/header -->
	
<!--/nav2-->
	
	<div id="columns"><!-- START MAIN CONTENT COLUMNS --><div class="fb-like"></div> 