<?php
/**
 * Template Name: Index
 */
get_header();

global $wp_query;

?>

<div id="content" class="home"> 
   <?php
    echo apply_filters('the_content', $post->post_content);
   ?>
</div>

<?php
get_footer();
?>