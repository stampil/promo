<?php
 error_reporting(0);
 header("Content-Type:text/plain");
 $server = $_SERVER['SERVER_NAME'];  
 if($server != 'jeuxenpromotion.fr'){
 ?>
User-agent: *
Disallow: /
 <?php 
 }
 else{
 ?>
User-agent: *
Disallow: /wp-admin/
 <?php } ?>
 
 

