<?php
/**
 * Template Name: Promo
 */
get_header();
$myPost = $post;

$nb_display = 50;
/*$p=1;
if(isset($_GET["pagin"]) && is_numeric($_GET["pagin"])){
    $p=$_GET["pagin"];
}*/
$p = (get_query_var('page')) ? get_query_var('page') : 1;

require 'wp-content/plugins/MyPlugin/class/MyPDO.php';
$bdd = new MyPDO();

$sql = 'SELECT SQL_CALC_FOUND_ROWS * from game where creato=? order by percent desc, prix_apres asc, titre LIMIT '.(($p-1)*$nb_display).','.$nb_display;
$param = date('Y-m-d');

$ret = $bdd->query($sql, array($param));
$ret_max = $bdd->query('SELECT FOUND_ROWS() as max_result');
$max = (int) $ret_max[0]->max_result;

if(count($ret)<$max){
    $pagination = true;
    $max_page = ceil($max/$nb_display);
}
?>


		<div class="col1">

		<?php if (have_posts()) : ?>
		
		<div id="archivebox">
        	
            	<h2><?php echo $max ?> jeux en promo aujourd'hui.</h2>      
                <br />
		<table width="100%">
                    <tr>
                        <th width="120">Vignette</th>
                        <th>Titre</th>
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
                <a href="http://jeuxenpromotion.fr/promo-du-moment/<?php echo ($p-1).'/'; ?>" class="inline_block" >◄</a>
                <?php 
                
                }
                ?>
                <ul class="pagination-links inline_block" class="inline_block">
                <?php
                if($pagination){
                    
                    for($pag =1; $pag<=$max_page; $pag++){
                    ?>
                    <li <?php if($pag==$p) echo 'class="active"' ?>><a href="http://jeuxenpromotion.fr/promo-du-moment/<?php echo $pag.'/'; ?>"><?php echo $pag; ?></a></li>
                <?php
                }
                }
                
                ?>
                </ul>
                <?php
                if($pagination && $p<$max_page){
                    ?>
                <a href="http://jeuxenpromotion.fr/promo-du-moment/<?php echo($p+1).'/'; ?>" class="inline_block" >►</a>
                <?php
                }
                ?>
		</div>
	
		<?php endif; ?>							

		</div><!--/col1-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>