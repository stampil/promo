<?php
header('Content-Type: text/html; charset=utf-8');
$homepage = file_get_contents('http://store.steampowered.com/search/?specials=1&os=win#sort_by=Released_DESC&os=win&specials=1&page=1');

?>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

<?php
$homepage = mb_convert_encoding($homepage , 'UTF-8', 'iso-8859-1');

$homepage = utf8_decode($homepage); 
preg_match_all('|<a href=".*".*data-ds-appid=".+".*>.*><img src="(.*)".*<span class="title">(.*)</span>.*<div class="col search_discount">.*<span>-(.+)%.*</a>|sU', $homepage, $matches);
$photos = $matches[1];
$titre =  $matches[2];
$percent = $matches[3];

?>
<textarea rows="10" cols="200"><?php echo $homepage; ?></textarea>

<table>
<?php
for($i=0;$i<count($titre);$i++){
    
?>
    <tr><td><img src="<?php echo  $photos[$i]; ?>" /></td><td><div class="titre"><?php echo  $titre[$i]; ?></div>-<?php echo  $percent[$i]; ?>%</td></tr>

<?php } ?>
</table>
