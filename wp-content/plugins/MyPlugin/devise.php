<?php

$fp = file_get_contents('http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml');

$taux = array('EUR'=>1);
preg_match('/USD\' rate=\'([0-9\.]+)\'/', $fp, $matche);
$taux['USD'] = $matche[1];

preg_match('/GBP\' rate=\'([0-9\.]+)\'/', $fp, $matche);
$taux['GBP'] = $matche[1];

preg_match('/CHF\' rate=\'([0-9\.]+)\'/', $fp, $matche);
$taux['CHF'] = $matche[1];

foreach($taux as $label =>$value){
    echo $label.':'.$value." \n";
}
?>

