<?php
$timestart=microtime(true);
$total_global = 0;
include 'devise.php';
include 'robot_DCS.php';
include 'robot_gog.php';
include 'robot_humblebundle.php';
include 'robot_gamesplanet.php';
include 'robot_steam.php';
$timeend=microtime(true);
$time=$timeend-$timestart;
$page_load_time = number_format($time, 3);
echo "\nDebut du script: ".date("H:i:s", $timestart)." ";
echo "\nFin du script: ".date("H:i:s", $timeend)." ";
echo "\nScript execute en " . gmdate("H:i:s", $page_load_time)." ";
echo "\nTotal Global " . $total_global . " promos ! ";