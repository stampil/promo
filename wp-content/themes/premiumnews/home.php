<?php
/**
 * Template Name: Home
 */
$post_home = $post;
get_header(); 
$p=1;
$nb_display = 50;
if(isset($_GET["pagin"]) && is_numeric($_GET["pagin"])){
    $p=$_GET["pagin"];
}
require 'wp-content/plugins/MyPlugin/class/MyPDO.php';
$bdd = new MyPDO();
$ret_max = $bdd->query('SELECT count(*) as max_result FROM `game` WHERE creato=?',date('Y-m-d'));
$max = (int) $ret_max[0]->max_result;

if(!$max){
    include 'wp-content/plugins/MyPlugin/robot.php';
}


$ret = $bdd->query('SELECT SQL_CALC_FOUND_ROWS * from game where creato=? order by percent desc, prix_apres asc LIMIT '.($p-1).','.$nb_display, array(date('Y-m-d')));
$ret_max = $bdd->query('SELECT FOUND_ROWS() as max_result');
$max = (int) $ret_max[0]->max_result;
?>

		<div class="col1">

		
		
		<div id="archivebox">
        	
            	<h2><?php echo $max ?> jeux en promo aujourd'hui.</h2>      
                <br />
		<?php
   echo apply_filters('the_content', $post_home->post_content);  
   ?>
		</div>
	
								

		</div><!--/col1-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>