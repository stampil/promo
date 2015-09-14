<?php
$timestart=microtime(true);
include 'robot_gog.php';
include 'robot_humblebundle.php';
include 'robot_gamesplanet.php';
include 'robot_steam.php';
$timeend=microtime(true);
$time=$timeend-$timestart;
$page_load_time = number_format($time, 3);
echo "Debut du script: ".date("H:i:s", $timestart);
echo "<br>Fin du script: ".date("H:i:s", $timeend);
echo "<br>Script execute en " . $page_load_time . " sec";