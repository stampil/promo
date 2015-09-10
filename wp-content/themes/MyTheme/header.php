<?php
header('Content-Type: text/html; charset=utf-8');
global $wp_rewrite;


if(!$title){
    $title = $post->post_title;
}


?><!DOCTYPE html>
<html style="margin-top: 0px !important;">
<head>
<title><?php echo $title; ?></title>
<meta charset="utf-8" />
<meta name="viewport" content="width=640">

<link rel="shortcut icon" type="image/x-icon" href="<?php echo TEMPLATEURL; ?>/img/favicon.ico" />

<link rel="stylesheet" href="<?php echo TEMPLATEURL; ?>/prod/css/main.css">

<script src="<?php echo find_javascript('jquery-1.11.2.min.js'); ?>"></script>

<script src="<?php echo find_javascript('jquery.cycle2.min.js'); ?>"></script>
<script src="<?php echo find_javascript('css_browser_selector.js'); ?>"></script>  
<script src="<?php echo find_javascript('modernizr.js'); ?>"></script>  
<script src="<?php echo find_javascript('placeholders.min.js'); ?>"></script>

<script>
var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
    </script>

<!--[if lt IE 9]> 
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="<?php echo find_javascript('respond.min.js'); ?>"></script>
<![endif]-->

<?php  wp_head(); ?>

<script>
    $(document).ready(function(){    	    
    	// if mobile addclass
	    var wWindow = $(window).width();
	    if (wWindow <=940 ) {   
        	$('html').addClass('mobile');
	    }                              
	    else {
	       $('html').removeClass('mobile'); 
	    }        			
	});



</script>
<script type="text/javascript" src="<?php echo find_javascript('Tag_google_analytics.js'); ?>"></script>
</head>
<body>
    <!--[if lt IE 9]> 
    <div style="padding:5px;background:#656565;color:white;text-align:center;font-style:italic">
    Pour une meilleure expérience utilisateur, nous vous invitons à <a style="color:whitesmoke;text-decoration:underline" target="_blank" href="https://www.google.fr/#q=mise+a+jour+navigateur">mettre à jour votre navigateur</a>.
    </div>
    <![endif]-->

	<header>
<?php
wp_nav_menu( array( 'theme_location' => 'header-menu' ) );
?>
		
	</header>

	
