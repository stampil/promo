<?php
if (!headers_sent()) {
    header('Content-Type: text/html; charset=utf-8');
}
require_once 'inc/functions.php';
require_once 'class/MyPDO.php';
$bdd = new MyPDO();


$p = 1;
echo "\n".'--robot_steam'."\n\n";
echo "\nDebut du script: ".date("H:i:s", microtime(true))."\n";
$nb_result_total=0;
do {
    $file = 'http://store.steampowered.com/search/results?sort_by=Released_DESC&os=win&specials=1&page=' . $p;
    $homepage = file_get_contents($file);

    $homepage = mb_convert_encoding($homepage, 'UTF-8', 'iso-8859-1');
    $homepage = utf8_decode($homepage);

    preg_match_all('|<a href="(.*)".*data-ds-appid=".+".*>.*><img src="(.*)".*<span class="title">(.*)</span>.*<div class="col search_discount.*">.*<span>-(.+)%.*<strike>([0-9.,]+)€</strike></span><br>([0-9.,]+)€.*</a>|sU', $homepage, $matches);
    
    list($all,$links,$photos,$titres,$percents,$prix_avants,$prix_apress) = $matches;
    
    $nb_titre = count($titres);
    $nb_result_total+= $nb_titre;
    $total_global+=$nb_titre;
    




    if ($nb_titre) {
        for($i=0;$i<$nb_titre;$i++){
            
            

            $titre =  trim($titres[$i]);
           

            $simple_titre = simple_format($titre);
            
           
            $link = trim($links[$i]);
            $photo = $photos[$i];
            $prix_avant = str_replace(',','.',$prix_avants[$i]);
            $prix_apres = str_replace(',','.',$prix_apress[$i]);
            $percent = $percents[$i];

            $data = array(
                $titre,
                $simple_titre,
                $link,
                $photo,
                $prix_avant,
                $prix_apres,
                $percent
            );
                        
            if($percent>0){
                
                $ret = $bdd->query($sql,$data);
            }
        }
    }

    $p++;
} while ($nb_titre > 0);
echo $nb_result_total.' promos '."\n";
echo "\nFin du script: ".date("H:i:s", microtime(true));
