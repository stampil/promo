<?php
/*
Template Name: Image Gallery
*/
?>

<?php get_header(); ?>

		<div class="col1">
		
			<div id="archivebox">
				
					<h2><?php the_title(); ?></h2>        
			
			</div><!--/archivebox-->
			
			<div class="imagegallery">
			
						<?php query_posts('showposts=16'); ?>
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>				
							
							<?php woo_image('height=170&width=270'); ?>
						
						<?php endwhile; endif; ?>	
			
			</div><!--/imagegallery-->															

		</div><!--/col1-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>