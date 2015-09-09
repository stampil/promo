<?php get_header(); ?>

		<div class="col1">

		<?php if (have_posts()) : ?>
		
		<div id="archivebox">
		
        		<?php if (is_category()) { ?>
        	
            	<h2><em><?php _e('Archive',woothemes); ?> |</em> <?php echo single_cat_title(); ?></h2>        
            	
            	<div class="archivefeed"><?php $cat_obj = $wp_query->get_queried_object(); $cat_id = $cat_obj->cat_ID; echo '<a href="'; get_category_rss_link(true, $cat, ''); echo '">'.__('RSS feed for this section',woothemes).'</a>'; ?></div>
            	
				<?php } elseif (is_day()) { ?>
				<h2><?php _e('Archive',woothemes); ?> | <?php the_time('F jS, Y'); ?></h2>

				<?php } elseif (is_month()) { ?>
				<h2><?php _e('Archive',woothemes); ?> | <?php the_time('F, Y'); ?></h2>

				<?php } elseif (is_year()) { ?>
				<h2><?php _e('Archive',woothemes); ?> | <?php the_time('Y'); ?></h2>
				
				<?php } ?>
		
		</div><!--/archivebox-->
	
			<?php while (have_posts()) : the_post(); ?>		

				<div class="post-alt blog" id="post-<?php the_ID(); ?>">
		
					<?php woo_image('height=57&width=100&class=th'); ?>
        					
					<?php if (function_exists('the_tags')) { ?><h2><?php the_tags('Tags: ', ', ', ''); ?></h2><?php } ?>
					<h3><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
					<p class="posted"><?php _e('Posted on',woothemes); ?> <?php the_time('d F Y'); ?> <?php _e('by',woothemes); ?> <?php the_author(); ?></p>
		
					<div class="entry">
						<?php the_content('<span class="continue">'.__('Continue Reading',woothemes).'</span>'); ?> 
					</div>
		
					<p class="comments"><?php comments_popup_link(__('Comments (0)',woothemes), __('Comments (1)',woothemes), __('Comments (%)',woothemes)); ?></p>
				
				</div><!--/post-->

		<?php endwhile; ?>
		
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries',woothemes)) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;',woothemes)) ?></div>
		</div>		
	
	<?php endif; ?>							

		</div><!--/col1-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>