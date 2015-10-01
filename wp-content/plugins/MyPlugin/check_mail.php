<meta charset="utf-8" />
<?php
echo "\n".'--check_mail'."\n\n";
echo "\nDebut du script: ".date("H:i:s", microtime(true))."\n";
require_once 'inc/functions.php';
require_once 'class/MyPDO.php';
$bdd = new MyPDO();
$ret = $bdd->query("select post_id, GROUP_CONCAT( concat(meta_key,':',meta_value) SEPARATOR ' ▬ ' ) as data from wpromo_postmeta where post_id in (SELECT post_id FROM `wpromo_postmeta` WHERE `meta_key`='_field_24' and `meta_value`='oui') AND meta_key in ('_field_18', '_field_20', '_field_19', '_field_21', '_field_17') GROUP BY post_id");
$nb_result = count($ret);

foreach($ret as $toMail){
    echo 'q:'.$toMail->data."\n";
    preg_match('/_field_17:([^▬]+)/', $toMail->data, $matches);
    $nom =  trim($matches[1]);
    preg_match('/_field_18:([^▬]+)/', $toMail->data, $matches);
    $email =  trim($matches[1]);
    preg_match('/_field_20:([^▬]+)/', $toMail->data, $matches);
    $tag =  trim($matches[1]);
    preg_match('/_field_19:([^▬]+)/', $toMail->data, $matches);
    $euro =  trim($matches[1]);
    preg_match('/_field_21:([^▬]+)/', $toMail->data, $matches);
    $percent = trim($matches[1]);
    $id = $toMail->post_id;
    echo $id.' '.$email.' '.$tag.' '.$euro.'€ '.$percent.'%'."\n" ;
    if(!$id){
        continue;
    }
    $mot_cles = explode(' ',$tag);
    
    $nb_result_total = 0;
    
    foreach($mot_cles as $mot_cle){
        $mot_cle = simple_format($mot_cle);
        echo ' - recherche de '.$mot_cle."\n";
        $ret_res =  $bdd->query("SELECT titre, link,img,prix_avant,prix_apres,percent  FROM `game` WHERE `simple_titre` LIKE '%".$mot_cle."%'
AND creato = '".date('Y-m-d')."' AND (prix_apres<=$euro OR percent>=$percent)");
        $nb_result = count($ret_res);
        $nb_result_total += $nb_result;
        if($nb_result){
            $html='<H1>Jeuxenpromotions.fr</H1>'
                . '<p>Bonjour '.ucfirst($nom).' !</p>'
                . '<p>Vous avez demandé a être informé pour des jeux ayant pour mot-clé : '.$tag.'</p>'
                . '<p>Etant soit à moins de '.$euro.'€ ou à plus de '.$percent.'% de remise.</p>'
                . '<p>Jeux en promotion à la joie de vous faire par des résultats suivant :</p>';
            foreach($ret_res as $jeu){
                $html.='<p><a href="'.$jeu->link.'"><img src="'.$jeu->img.'" /></a><br /><a href="'.$jeu->link.'">'.$jeu->titre.'</a> à '.$jeu->prix_apres.'€ ('.$jeu->percent.'%)</p>';
            }
            $html.='<br /><br /><hr />'
                . '<p>Attention, pour eviter tout spam, cette recherche par mot-clé va être désactivée ( vous ne recevrez plus de mail si une nouvelle correspondance ce fait), si le résultat ne vous convient pas, je vous invite à refaire une alert mail avec des mot-clés plus spécifiques, sur <a href="http://jeuxenpromotion.fr">jeuxenpromotion.fr</a></p>';
            
        
                 // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            // En-têtes additionnels
            $headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
            $headers .= 'From: Anniversaire <anniversaire@example.com>' . "\r\n";
            $headers .= 'Cc: anniversaire_archive@example.com' . "\r\n";
            $headers .= 'Bcc: anniversaire_verif@example.com' . "\r\n";

            // Envoi

                mail($email, 'Votre jeu en promotion !', $html, $headers);
                $bdd->query("DELETE FROM wpromo_postmeta WHERE post_id=$id");
            }
        
    }
    
    echo "\nNb resultat trouvé : ".$nb_result_total."\n";
}

echo "\nFin du script: ".date("H:i:s", microtime(true));