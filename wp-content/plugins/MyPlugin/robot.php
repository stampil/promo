<?php

/*
  Plugin Name: Perso
  Description:
  Version: 1.0
  Author: Perso
  Author URI: 
  Text Domain: perso
 */
//TODO https://fr.gamesplanet.com/games/offers?page=1

include 'functions.php';
require_once 'inc/functions.php';
require_once 'class/MyPDO.php';
$bdd = new MyPDO();

class perso {

    function __construct() {
        add_action('init', array(&$this, 'init'));
    }

    function init() {
        global $wp;
        $wp->add_query_var('q');


        add_action('posts_where', array(&$this, 'posts_where'), 10, 2);

        add_filter('template_redirect',  array(&$this, 'my_404_override'));

        if (is_admin()) {
            include __DIR__ . '/admin.php';
        }
        


        
    }

    public function my_404_override() {
        global $wp_query;
        
        if(!$wp_query->is_404) return;
        
    }

 

    public function posts_where($where, $query) {

        return $where;
    }


}

global $perso;
$perso = new perso();
