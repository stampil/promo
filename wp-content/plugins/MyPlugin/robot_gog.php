<?php
if (!headers_sent()) {
    header('Content-Type: text/html; charset=utf-8');
}
require_once 'inc/functions.php';
require_once 'class/MyPDO.php';
$bdd = new MyPDO();


$p = 1;
echo 'robot_gog'."\n\n";
do {
    $file = 'http://www.gog.com/games/ajax/filtered?mediaType=game&price=discounted&sort=bestselling&page=' . $p;
    //echo $file.'<br />';
    $homepage = @file_get_contents($file);
    $homepage = mb_convert_encoding($homepage, 'UTF-8', 'iso-8859-1');
    $homepage = utf8_decode($homepage);
    $homepage = json_decode($homepage);

    //var_dump($homepage);
   
    $nb_result = count(@$homepage->products);

    
    
        for($i=0;$i<$nb_result;$i++){
            
            $titre = trim($homepage->products[$i]->title);
            $simple_titre = simple_format($titre);
            $link = 'http://www.gog.com'.trim($homepage->products[$i]->url);
            $photo = trim($homepage->products[$i]->image).'_196.jpg';
            $prix_avant =  str_replace(',','.',$homepage->products[$i]->price->baseAmount);
            $prix_apres = str_replace(',','.',$homepage->products[$i]->price->finalAmount);
            $percent = $homepage->products[$i]->price->discountPercentage;
            if(!$percent){
                continue;
            }
            
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
            
                echo $simple_titre.':'.$percent."\n";
                $ret = $bdd->query($sql,$data);
            }

        }
$p++;
} while ($nb_result > 0);
