<?php
if (!headers_sent()) {
    header('Content-Type: text/html; charset=utf-8');
}
require_once 'inc/functions.php';
require_once 'class/MyPDO.php';
$bdd = new MyPDO();


$p = 1;
do {
    $file = 'https://fr.gamesplanet.com/games/offers?page=' . $p;
    $homepage = file_get_contents($file);
    $homepage = mb_convert_encoding($homepage, 'UTF-8', 'iso-8859-1');
    $homepage = utf8_decode($homepage);
    

    preg_match_all('|<div class="game".*src="(.*)".*<a href="(.*)">(.*)</a></h4>.*<strike>(.*)</strike>.*-(.*)%.*([0-9,\.]+)€.*</div>|sU', $homepage, $matches);
    
    list($all,$photos, $link,$titre,$prix_avant, $percent,$prix_apres) = $matches;
    
    $nb_titre = count($titre);



    if ($nb_titre) {
        for($i=0;$i<$nb_titre;$i++){

            $ret = $bdd->query('INSERT INTO game (titre,simple_titre,link,img,prix_avant,prix_apres,percent,creato) VALUES(?,?,?,?,?,?,?,now()) ON DUPLICATE KEY UPDATE creato=now(),'
                    . ' percent = IF(VALUES(percent) > percent, VALUES(percent),percent),'
                    . ' prix_avant = IF(VALUES(percent) > percent, VALUES(prix_avant),prix_avant),'
                    . ' prix_apres = IF(VALUES(percent) > percent, VALUES(prix_apres),prix_apres),'
                    . ' link = IF(VALUES(percent) > percent, VALUES(link),link)',array(
                trim($titre[$i]),
                simple_format($titre[$i]),
                trim('https://fr.gamesplanet.com'.$link[$i]),
                $photos[$i],
                str_replace(',','.',$prix_avant[$i]),
                str_replace(',','.',$prix_apres[$i]),
                $percent[$i]
            ));
            /*array_push($tab_game, array('titre' => trim($titre[$i]), 'link' => trim($link[$i]), 'simple_titre'=>simple_format($titre[$i]), 'img' => $photos[$i],
                'prix_avant' => $prix_avant[$i], 'prix_apres' => $prix_apres[$i], 'percent' => $percent[$i]));*/
        }
    }
    $p++;
} while ($nb_titre > 0);
