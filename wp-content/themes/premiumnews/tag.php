<?php get_header(); ?>

		<div class="col1">

		<?php if (have_posts()) : ?>
		
		<div id="archivebox">
        	
            	<h2><em><?php _e('Tag Archive',woothemes); ?> |</em> "<?php single_tag_title("", true); ?>"</h2>        
		
		</div><!--/archivebox-->
	
			<?php while (have_posts()) : the_post(); ?>		

				<div class="post-alt blog" id="post-<?php the_ID(); ?>">
		
					<?php woo_image('height=57&width=100&class=th'); ?>
					
					<?php if (function_exists('the_tags')) { ?><h2><?php the_tags('Tags: ', ', ', ''); ?></h2><?php } ?>
					<h3><a title="<?php _e('Permanent Link to',woothemes); ?> <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
					<p class="posted"><?php _e('Posted on',woothemes); ?> <?php the_time('d F Y'); ?> <?php _e('by',woothemes); ?> <?php the_author(); ?></p>
		
					<div class="entry">
						<?php the_content('<span class="continue">'.__('Continue Reading',woothemes).'</span>'); ?> 
					</div>
		
					<p class="comments"><?php comments_popup_link(__('Comments (0)',woothemes), __('Comments (1)',woothemes), __('Comments (%)',woothemes)); ?></p>
				
				</div><!--/post-->

		<?php endwhile; ?>
		
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries',woothemes)); ?></div>
			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;',woothemes)); ?></div>
		</div>		
	
	<?php endif; ?>							

		</div><!--/col1-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>