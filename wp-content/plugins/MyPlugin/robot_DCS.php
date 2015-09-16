<?php
if (!headers_sent()) {
    header('Content-Type: text/html; charset=utf-8');
}
require_once 'inc/functions.php';
require_once 'class/MyPDO.php';
require_once 'devise.php';
$bdd = new MyPDO();



echo 'robot_steam'."\n\n";
echo "\nDebut du script: ".date("H:i:s", microtime(true))."\n";

$file = 'http://www.digitalcombatsimulator.com/en/shop/modules/?SHOWALL_1=1';
$homepage = file_get_contents($file);
$homepage = mb_convert_encoding($homepage, 'UTF-8', 'iso-8859-1');
$homepage = utf8_decode($homepage);


preg_match_all('|.*<img src="(/upload/.*)".*alt=".+".*preview-item">.*<div class="row"><h2><a href="(.*)" title="(.*)".*price-old">.*\$(.*)<small>(.*)</small>.*price">.*\$(.*)<small>(.*)</small>|sU', $homepage, $matches);

list($all,$photos,$links,$titres,$prix_avants,$prix_cent_avants,$prix_apress,$prix_cent_apress) = $matches;

$nb_titre = count($titres);




if ($nb_titre) {
    for($i=0;$i<$nb_titre;$i++){



        $titre =  trim($titres[$i]);


        $simple_titre = simple_format($titre);


        $link = 'http://www.digitalcombatsimulator.com'.trim($links[$i]);
        $photo = 'http://www.digitalcombatsimulator.com'.$photos[$i];
        $prix_avant = str_replace(',','.',$prix_avants[$i]).str_replace(',','.',$prix_cent_avants[$i]);
        $prix_avant =  number_format($prix_avant/$taux['USD'],2,'.','');
        $prix_apres = str_replace(',','.',$prix_apress[$i]).str_replace(',','.',$prix_cent_apress[$i]);
        $prix_apres =  number_format($prix_apres/$taux['USD'],2,'.','');
        $percent = round((($prix_avant-$prix_apres)/$prix_avant)*100);

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


echo "\nFin du script: ".date("H:i:s", microtime(true));
