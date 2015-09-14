<?php 
function supprime_accents($str, $charset='utf-8')
{
    $str = htmlentities($str, ENT_NOQUOTES, $charset);
    
    $str = preg_replace('#&([A-za-z])(?:acute|cedil|quot|caron|circ|grave|orn|amp|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&(.+);#U', '', $str); // 
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
    
    return $str;
}

function simple_format($txt){
    $txt = trim($txt);
    $txt = supprime_accents($txt);
    $txt = strtolower($txt);

    $txt = preg_replace('/[^a-z 0-9_\-&]/', '', $txt);
    $txt = preg_replace('/[_ &]/', '-', $txt);
    $txt = preg_replace('/-+/', '-', $txt);
    return trim($txt);
}

$sql = 'INSERT INTO game (titre,simple_titre,link,img,prix_avant,prix_apres,percent,creato) VALUES(?,?,?,?,?,?,?,now()) ON DUPLICATE KEY UPDATE creato=now(),'
                    . ' percent = IF(VALUES(prix_apres) < prix_apres, VALUES(percent),percent),'
                    . ' prix_avant = IF(VALUES(prix_apres) < prix_apres, VALUES(prix_avant),prix_avant),'
                    . ' link = IF(VALUES(prix_apres) < prix_apres, VALUES(link),link),'
                    . ' prix_apres = IF(VALUES(prix_apres) < prix_apres, VALUES(prix_apres),prix_apres)'
                    ;
?>

