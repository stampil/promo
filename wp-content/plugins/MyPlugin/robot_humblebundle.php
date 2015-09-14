<?php
if (!headers_sent()) {
    header('Content-Type: text/html; charset=utf-8');
}
require_once 'inc/functions.php';
require_once 'class/MyPDO.php';
$bdd = new MyPDO();


$p = 0;
do {
    $file = 'https://www.humblebundle.com/store/api?request=1&page_size=20&sort=discount&platform=windows&page=' . $p;
    echo $file.'<br />';
    $homepage = @file_get_contents($file);
    $homepage = mb_convert_encoding($homepage, 'UTF-8', 'iso-8859-1');
    $homepage = utf8_decode($homepage);
    $homepage = json_decode($homepage);


    $nb_result = count(@$homepage->results);

    
        for($i=0;$i<$nb_result;$i++){
            
            $titre = $homepage->results[$i]->human_name;
            $link = 'https://www.humblebundle.com/store/p/'.trim($homepage->results[$i]->machine_name);
            $photo = 'https://www.humblebundle.com'.trim($homepage->results[$i]->storefront_featured_image_small);
            $prix_avant =  $homepage->results[$i]->full_price[0];
            $prix_apres = $homepage->results[$i]->current_price[0];
            $percent = round((($prix_avant-$prix_apres)/$prix_avant)*100);


            $ret = $bdd->query('INSERT INTO game (titre,simple_titre,link,img,prix_avant,prix_apres,percent,creato) VALUES(?,?,?,?,?,?,?,now()) ON DUPLICATE KEY UPDATE creato=now(),'
                    . ' percent = IF(VALUES(percent) > percent, VALUES(percent),percent),'
                    . ' prix_avant = IF(VALUES(percent) > percent, VALUES(prix_avant),prix_avant),'
                    . ' prix_apres = IF(VALUES(percent) > percent, VALUES(prix_apres),prix_apres),'
                    . ' link = IF(VALUES(percent) > percent, VALUES(link),link)',array(
                trim($titre),
                simple_format($titre),
                $link,
                $photo,
                str_replace(',','.',$prix_avant),
                str_replace(',','.',$prix_apres),
                $percent
            ));
            /*array_push($tab_game, array('titre' => trim($titre[$i]), 'link' => trim($link[$i]), 'simple_titre'=>simple_format($titre[$i]), 'img' => $photos[$i],
                'prix_avant' => $prix_avant[$i], 'prix_apres' => $prix_apres[$i], 'percent' => $percent[$i]));*/
        }
$p++;
} while ($nb_result > 0);
