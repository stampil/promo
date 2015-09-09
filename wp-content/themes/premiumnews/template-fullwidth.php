<?php
/*
Template Name: Full Width
*/
?>

<?php get_header(); ?>


		<?php if (have_posts()) : ?>
		
		<div id="archivebox" style="width:auto">
        	
            	<h2><?php the_title(); ?></h2>        
		
		</div><!--/archivebox-->
	
			<?php while (have_posts()) : the_post(); ?>		

				<div class="post-alt blog" id="post-<?php the_ID(); ?>">
		
					<div class="entry">
						<?php the_content('<span class="continue">Continue Reading</span>'); ?> 
					</div>
				
				</div><!--/post-->

			<?php endwhile; ?>
	
		<?php endif; ?>							


<?php get_footer(); ?>