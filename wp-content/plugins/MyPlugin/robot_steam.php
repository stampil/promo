<?php
if (!headers_sent()) {
    header('Content-Type: text/html; charset=utf-8');
}
require_once 'inc/functions.php';
require_once 'class/MyPDO.php';
$bdd = new MyPDO();


$p = 1;
do {
    $file = 'http://store.steampowered.com/search/results?sort_by=Released_DESC&os=win&specials=1&page=' . $p;
    $homepage = file_get_contents($file);
    $homepage = mb_convert_encoding($homepage, 'UTF-8', 'iso-8859-1');
    $homepage = utf8_decode($homepage);

    preg_match_all('|<a href="(.*)".*data-ds-appid=".+".*>.*><img src="(.*)".*<span class="title">(.*)</span>.*<div class="col search_discount">.*<span>-(.+)%.*<strike>([0-9.,]+)€</strike></span><br>([0-9.,]+)€.*</a>|sU', $homepage, $matches);
    
    list($all,$link,$photos,$titre,$percent,$prix_avant,$prix_apres) = $matches;
    
    $nb_titre = count($titre);



    if ($nb_titre) {
        for($i=0;$i<$nb_titre;$i++){
            //TODO MAJ doublon si -percent >
            $ret = $bdd->query('INSERT INTO game (titre,simple_titre,link,img,prix_avant,prix_apres,percent,creato) VALUES(?,?,?,?,?,?,?,now()) ON DUPLICATE KEY UPDATE creato=now(),'
                    . ' percent = IF(VALUES(percent) > percent, VALUES(percent),percent),'
                    . ' prix_avant = IF(VALUES(percent) > percent, VALUES(prix_avant),prix_avant),'
                    . ' prix_apres = IF(VALUES(percent) > percent, VALUES(prix_apres),prix_apres),'
                    . ' link = IF(VALUES(percent) > percent, VALUES(link),link)',array(
                trim($titre[$i]),
                simple_format($titre[$i]),
                trim($link[$i]),
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
