<?php
if (!headers_sent()) {
    header('Content-Type: text/html; charset=utf-8');
}
require_once 'inc/functions.php';
require_once 'class/MyPDO.php';
$bdd = new MyPDO();


$p = 1;
echo 'robot_gamesplanet'."\n\n";
echo "\nDebut du script: ".date("H:i:s", microtime(true))."\n";
do {
    $file = 'https://fr.gamesplanet.com/games/offers?page=' . $p;
    $homepage = file_get_contents($file);
    $homepage = mb_convert_encoding($homepage, 'UTF-8', 'iso-8859-1');
    $homepage = utf8_decode($homepage);
    

    preg_match_all('|<div class="game".*src="(.*)".*<a href="(.*)">(.*)</a></h4>.*<strike>(.*)€</strike>.*-(.*)%.*([0-9,\.]+)€.*</div>|sU', $homepage, $matches);
    
    list($all,$photos, $links,$titres,$prix_avants, $percents,$prix_apress) = $matches;
    
    $nb_titre = count($titres);



    if ($nb_titre) {
        for($i=0;$i<$nb_titre;$i++){
            
            $titre =  trim($titres[$i]);
            $simple_titre = simple_format($titre);
            $link = trim('https://fr.gamesplanet.com'.$links[$i]);
            $photo = $photos[$i];
            $prix_avant = str_replace(',','.',$prix_avants[$i]);
            $prix_apres= str_replace(',','.',$prix_apress[$i]);
            $percent = $percents[$i];
            
            if($percent){
            
                $data = array(
                   $titre,
                    $simple_titre,
                    $link,
                    $photo,
                    $prix_avant,
                    $prix_apres,
                    $percent
                );
                                
                $ret = $bdd->query($sql,$data);
            }
        }
    }
    $p++;
} while ($nb_titre > 0);
echo "\nFin du script: ".date("H:i:s", microtime(true));
