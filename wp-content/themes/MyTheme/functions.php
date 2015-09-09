<?php

if (!session_id())
    session_start();

include __DIR__ . '/Mobile_Detect.php';

define('TEMPLATEURL', get_template_directory_uri());

global $mobileDetect;
$mobileDetect = new Mobile_Detect;

global $device;

if ($mobileDetect->isTablet()) {
    $device = 'tablet';
} else if ($mobileDetect->isMobile()) {
    $device = 'mobile';
} else {
    $device = 'desktop';
}

function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'extra-menu' => __( 'Extra Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

/**
 *
 * @todo mettre en cache les valeurs retrouvées *
 * @global type $wpdb
 * @param type $post_id
 * @return type
 */
function get_post_meta_all($post_id){
    global $wpdb;

    $data = array();

    $wpdb->query("
        SELECT `meta_key`, `meta_value`
        FROM $wpdb->postmeta
        WHERE `post_id` = $post_id
    ");

    foreach($wpdb->last_result as $k => $v){
        $data[$v->meta_key] =   $v->meta_value;
    };

    return $data;
}

/**
 *
 * @global type $wpdb
 * @param type $post_id
 * @return type
 */
if (!function_exists('get_post_meta_single')) {
    function get_post_meta_single($post_id = 0){

        $postMetas = get_post_custom($post_id);
        foreach ($postMetas as $key => $value) {
            if (is_array($value) && count($value) === 1) {
                $postMetas[$key] = maybe_unserialize($value[0]);
            }
        }

        return $postMetas;
    }
}

function esc_attr_url($string)
{
    return urlencode(html_entity_decode(trim(strip_tags($string))));
}


/**
* Filter the single_template with our custom function
*/
add_filter('single_template', 'f_single_template');
function f_single_template($single) {
	global $post;

    $template = get_post_meta($post->ID, 'template', true);

    if (!empty($template) && file_exists(TEMPLATEPATH . '/' . $template)) {
        return TEMPLATEPATH . '/' . $template;
    }

    return $single;
}

function f_get_attachment_image_src($attachment_id, $size = 'thumbnail', $icon = false)
{
    $image = wp_get_attachment_image_src($attachment_id, $size, $icon);
    if ($image) {
        $image['url']    = str_replace(site_url(), '', $image[0]);
        $image['width']  = $image[1];
        $image['height'] = $image[2];
    }

    return $image;
}




function find_javascript($rep, $path = null) {

    if (!$path) {
        $path = TEMPLATEURL . '/prod/js/';
    }
    $php_path = 'wp-content/themes/Chorum/prod/js/';

    if ($dossier = opendir($php_path)) {
        while (false !== ($fichier = readdir($dossier))) {
            if ($fichier != '.' && $fichier != '..' && preg_match('@^(.*)' . $rep . '$@U', $fichier)) {
                return $path . $fichier;
            }
        }
    }
}


function print_pre($value) {

    if(!$value){
        echo '<i>NULL</i><br />';
        return false;
    }
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}


//Adding the Open Graph in the Language Attributes
//function add_opengraph_doctype( $output ) {
//    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
//}
//add_filter('language_attributes', 'add_opengraph_doctype');
//Lets add Open Graph Meta Info
function insert_metas_in_head() {
    global $post, $language;

    $max_text_description = 200;
    $max_inc_loop = 15;
    $title = null;
    $text = null;
    $site_name = 'Chorum';
    $type = 'article';


    // 1. On récupère le magazine le plus récent publié


    $url_site = 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

    if ($post->post_type === 'produits') {
        global $postMetas;
        if (!isset($postMetas)) {
            $postMetas = get_post_meta_all($post->ID);
        }

        $uri = $_SERVER['REQUEST_URI'];
        $title = $postMetas['ref_produit'] . ' - ' . $postMetas['nom_produit'];


        if (!$url_img) {
            $url_img = affiche_visuel($postMetas['ref_produit'], 1);
        }
        $imgInfos = @getimagesize($url_img);

        $text = $postMetas['description'];
    } elseif (is_front_page()) {

        $title = "Chorum";
        $text = "Chorum";

        $url_img = "";
        
        $imgInfos = @getimagesize($url_img);
    } else {

        $title = "Chorum";
        $text = "Chorum";
    }

    if ($title && $text) {
        echo '<meta property="og:title" content="' . esc_attr($title) . '"/>' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($text) . '"/>' . "\n";
        echo '<meta property="og:type" content="' . $type . '"/>' . "\n";
        echo '<meta property="og:url" content="' . $url_site . '"/>' . "\n";
        echo '<meta property="og:site_name" content="' . $site_name . '"/>' . "\n";
        echo '<meta property="og:image" content="' . $url_img . '"/>' . "\n";
        echo '<meta property="og:image:type" content="' . $imgInfos["mime"] . '"/>' . "\n";
        if (!empty($imgInfos)) {
            echo '<meta property="og:image:width" content="' . $imgInfos[0] . '"/>' . "\n";
            echo '<meta property="og:image:height" content="' . $imgInfos[1] . '"/>' . "\n";
        }

        //$text_SEO = substr($text, 0, $coupe); desactivé pour l'instant
        echo '<meta name="description" content="' . esc_attr($text) . '"/>' . "\n";


        echo '<meta name="twitter:card" content="summary_large_image"/>' . "\n";
        echo '<meta name="twitter:site" content="@ChorumFrance"/>' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr($title) . '"/>' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr($text) . '"/>' . "\n";
        echo '<meta name="twitter:image" content="' . $url_img . '"/>' . "\n";
    }
}

add_action('wp_head', 'insert_metas_in_head', 5);

function get_int($get) {
    if (empty($get)) {
        return 0;   
    } 
    return (int) $get;
    
}

function get_string($get){
    if (empty($get)) {
        return '';   
    } 
    
    $get = preg_replace('/"([^"]+)"/','“$1”',$get);
    $get = str_replace('\'','’', $get);
    
    $get = stripslashes($get); 

    $get = str_ireplace(array('javascript:','<script>','<?php','<?'),array('','','',''),$get);

    return trim($get);
}


function tronque($string, $start, $length, $endStr = '&hellip;'){

	if( strlen( $string ) <= $length ) return $string;
	$str = mb_substr( $string, $start, $length - strlen( $endStr ) + 1, 'UTF-8');
	return substr( $str, 0, strrpos( $str,' ') ).$endStr;
}