<?php get_header(); 
$p=1;
$nb_display = 50;
if(isset($_GET["pagin"]) && is_numeric($_GET["pagin"])){
    $p=$_GET["pagin"];
}
$ret = $bdd->query('SELECT SQL_CALC_FOUND_ROWS * from game where creato=? order by percent desc, prix_apres asc LIMIT '.$p.','.$nb_display, array(date('Y-m-d')));
$ret_max = $bdd->query('SELECT FOUND_ROWS() as max_result');
$max = (int) $ret_max[0]->max_result;
?>
<style>
    table {
    border-collapse: collapse;
}
    table, tr, td, th{

         border:1px solid black;

    }
    td.padding{
        padding: 0 10px;
    }
    th{
        background-color: black;
        color:white;
        font-weight:bold;
    }

</style>

		<div class="col1">

		<?php if (have_posts()) : ?>
		
		<div id="archivebox">
        	
            	<h2><?php echo $max ?> jeux en promo aujourd'hui.</h2>      
                <br />
		<table style="border:1px solid black;" width="100%">
                    <tr>
                        <th width="120">Vignette</th>
                        <th>Titre</th>
                        <th width="45">Remise</th>
                        <th width="45">Prix</th>
                    </tr>
<?php

foreach($ret as $game){
?>
    <tr onclick="window.open('<?php echo $game->link; ?>','_blank');">
        <td><img src="<?php echo $game->img; ?>" /></td>
        <td class="padding"><?php echo $game->titre; ?></td>
        <td class="padding" align="right">-<?php echo $game->percent; ?>%</td>
        <td class="padding" align="right">
            <div style="text-decoration: line-through;color:gray"><?php echo $game->prix_avant; ?>€</div>
            <?php echo $game->prix_apres; ?>€
        </td>
    </tr>

<?php } ?>
</table>
		</div>
	
		<?php endif; ?>							

		</div><!--/col1-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>