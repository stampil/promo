<?php get_header(); 
$p=1;
$nb_display = 50;
if(isset($_GET["pagin"]) && is_numeric($_GET["pagin"])){
    $p=$_GET["pagin"];
}
$sql = 'SELECT SQL_CALC_FOUND_ROWS * from game where creato=? order by percent desc, prix_apres asc LIMIT '.(($p-1)*$nb_display).','.$nb_display;
$param = date('Y-m-d');

$ret = $bdd->query($sql, array($param));
$ret_max = $bdd->query('SELECT FOUND_ROWS() as max_result');
$max = (int) $ret_max[0]->max_result;

if(count($ret)<$max){
    $pagination = true;
    $max_page = ceil($max/$nb_display);
}
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
    ul.pagination-links li{
        display: inline-block;
        cursor:pointer;
    }
     ul.pagination-links li:hover{
         text-decoration: underline;
     }
     ul.pagination-links li.active a{
         color:gray;
         cursor:none;
     }
     
     .percent{
         border-radius:10px;
         font-weight:bold;
         padding:2px;
         opacity: 0.8;
     }
     .percent.heavy{
         background:darkred;
         color:whitesmoke;
     }
     .percent.strong{
         background:red;
         color:wheat;
     }
     .percent.medium{
         background:orange;
     }
     .percent.light{
         background:yellow;
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
        <td><img src="<?php echo $game->img; ?>" /></td>
        <td class="padding"><?php echo $game->titre; ?></td>
        <td class="padding" align="right"><div class="percent <?php echo $class; ?>">-<?php echo $game->percent; ?>%</div></td>
        <td class="padding" align="right">
            <div style="text-decoration: line-through;color:gray"><?php echo $game->prix_avant; ?>€</div>
            <?php echo $game->prix_apres; ?>€
        </td>
    </tr>

<?php } ?>
</table>
                <ul class="pagination-links">
                <?php
                if($pagination){
                    
                    for($pag =1; $pag<=$max_page; $pag++){
                    ?>
                    <li <?php if($pag==$p) echo 'class="active"' ?>><a href="?pagin=<?php echo $pag; ?>"><?php echo $pag; ?></a></li>
                <?php
                }
                }
                
                ?>
                </ul>
		</div>
	
		<?php endif; ?>							

		</div><!--/col1-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>