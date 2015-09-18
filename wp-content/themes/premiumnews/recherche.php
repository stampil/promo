<?php
/**
 * Template Name: Recherche
 */
get_header(); 
require 'wp-content/plugins/MyPlugin/class/MyPDO.php';
require_once 'wp-content/plugins/MyPlugin/inc/functions.php';
$p=1;
$nb_display = 50;
if(isset($_GET["pagin"]) && is_numeric($_GET["pagin"])){
    $p=$_GET["pagin"];
}
$q = simple_format($_GET["q"]);
if(!$q){
    $q='jeuxenpromotion';
}


$bdd = new MyPDO();

$sql ='SELECT SQL_CALC_FOUND_ROWS * from game where simple_titre like(\'%'.$q.'%\') order by creato desc, percent desc, prix_apres asc LIMIT '.(($p-1)*$nb_display).','.$nb_display;
$data = null;

$ret = $bdd->query($sql, $data );

$ret_max = $bdd->query('SELECT FOUND_ROWS() as max_result');
$max = (int) $ret_max[0]->max_result;

if(count($ret)<$max){
    $pagination = true;
    $max_page = ceil($max/$nb_display);
}
$s='';
if($max>1){
    $s='s';
}
?>

		<div class="col1">

		
		
		<div id="archivebox">
        	
            	<h2>
		<?php
   echo apply_filters('the_content', $post->post_content);  
   ?></h2>      
                <br />
                <?php echo $max ?> résultat<?php echo $s ?> trouvé<?php echo $s ?>.
		</div>
	
<br />
		<table width="100%">
                    <tr>
                        <th width="120">Vignette</th>
                        <th>Titre</th>
                        <th>Date Remise</th>
                        <th width="45">Remise</th>
                        <th width="45">Prix</th>
                    </tr>
<?php

foreach($ret as $game){
    if ($game->percent>=80) {
        $class='heavy'; 
    }
    elseif ($game->percent>=75) {
        $class='strong'; 
    }
    elseif($game->percent>=25){
        $class='medium';
    }
    else{
        $class='light';
    }
?>
    <tr onclick="window.open('<?php echo $game->link; ?>','_blank');">
        <td><img src="<?php echo $game->img; ?>" alt="<?php echo str_replace('"','',$game->titre); ?> en promo" title="<?php echo str_replace('"','',$game->titre); ?> en promotion" class="vignette_jeux_video" /></td>
        <td class="padding"><?php echo $game->titre; ?></td>
        <td class="padding"><?php echo date("d/m/Y",  strtotime($game->creato)); ?></td>
        <td class="padding" align="right"><div class="percent <?php echo $class; ?>">-<?php echo $game->percent; ?>%</div></td>
        <td class="padding" align="right">
            <div class="prix_avant"><?php echo $game->prix_avant; ?>€</div>
            <?php echo $game->prix_apres; ?>€
        </td>
    </tr>

<?php } ?>
</table>
                
                <?php
                if($pagination && $p>1){
                ?>
                <a href="<?php echo get_permalink().'?q='.$q.'&pagin='.($p+1); ?>" class="inline_block" >◄</a>
                <?php 
                
                }
                ?>
                <ul class="pagination-links inline_block" class="inline_block">
                <?php
                if($pagination){
                    
                    for($pag =1; $pag<=$max_page; $pag++){
                    ?>
                    <li <?php if($pag==$p) echo 'class="active"' ?>><a href="<?php echo get_permalink().'?q='.$q.'&pagin='.$pag; ?>"><?php echo $pag; ?></a></li>
                <?php
                }
                }
                
                ?>
                </ul>
                <?php
                if($pagination && $p<$max_page){
                    ?>
                <a href="<?php echo get_permalink().'?q='.$q.'&pagin='.($p+1); ?>" class="inline_block" >►</a>
                <?php
                }
                ?>
		</div>
	
							

		</div><!--/col1-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>