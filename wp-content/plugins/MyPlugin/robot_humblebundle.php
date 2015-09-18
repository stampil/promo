<?php
if (!headers_sent()) {
    header('Content-Type: text/html; charset=utf-8');
}
require_once 'inc/functions.php';
require_once 'class/MyPDO.php';
require_once 'devise.php';
$bdd = new MyPDO();


$p = 0;
echo 'robot_humblebundle'."\n\n";
echo "\nDebut du script: ".date("H:i:s", microtime(true))."\n";
do {
    $file = 'https://www.humblebundle.com/store/api?request=1&page_size=20&sort=discount&platform=windows&page=' . $p;
    //echo $file.'<br />';
    $homepage = @file_get_contents($file);
    $homepage = mb_convert_encoding($homepage, 'UTF-8', 'iso-8859-1');
    $homepage = utf8_decode($homepage);
    $homepage = json_decode($homepage);


    $nb_result = count(@$homepage->results);
    echo $nb_result.' promos '."\n";
    
        for($i=0;$i<$nb_result;$i++){
            
            $titre = trim($homepage->results[$i]->human_name);
            $simple_titre = simple_format($titre);
            $link = 'https://www.humblebundle.com/store/p/'.trim($homepage->results[$i]->machine_name);
            $photo = 'https://www.humblebundle.com'.trim($homepage->results[$i]->storefront_featured_image_small);
            $prix_avant = str_replace(',','.',$homepage->results[$i]->full_price[0]);
            $taux_full_price = @$taux[$homepage->results[$i]->full_price[1]];
            if(!$taux_full_price){
                $taux_full_price = 1;
            }
            $prix_avant =  number_format($prix_avant/$taux_full_price,2,'.',''); //conversion GBP/EUR
            $prix_apres = str_replace(',','.',$homepage->results[$i]->current_price[0]);
            
            $taux_current_price = @$taux[$homepage->results[$i]->current_price[1]];
            if(!$taux_current_price){
                $taux_current_price = 1;
            }
            $prix_apres = number_format($prix_apres/$taux_current_price,2,'.',''); //conversion GBP/EUR
            $percent = round((($prix_avant-$prix_apres)/$prix_avant)*100);
            
            if($percent>0){

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
$p++;

} while ($nb_result > 0);
echo "\nFin du script: ".date("H:i:s", microtime(true));
