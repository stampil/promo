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
?>

