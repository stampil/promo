<?php
header('Content-Type: text/html; charset=utf-8');
require_once 'inc/functions.php';
require_once 'class/MyPDO.php';
$bdd = new MyPDO();

$ret = $bdd->query('SELECT * from game order by percent desc, prix_apres asc');

?>
<style>
    a{
        text-decoration: none;
        color:darkslateblue;
    }
</style>
<table>
<?php
foreach($ret as $game){
?>
    <tr><td><a href="<?php echo $game->link; ?>"><img src="<?php echo $game->img; ?>" /></a></td><td><a href="<?php echo $game->link; ?>">
        <?php echo $game->titre; ?><br />
    <strike><?php echo $game->prix_avant; ?>€</strike> → <?php echo $game->prix_apres; ?>€ (-<?php echo $game->percent; ?>%)<br /><br />
        
            </a></td></tr>

<?php } ?>
</table>
