<div class="featured-area">
	<div id="sideslides">
	<ul class="bxslider">
	
		<?php
				
				$featured_cat = get_theme_mod( 'sp_featured_cat' );
				$get_featured_posts = get_theme_mod('sp_featured_id');
				$number = get_theme_mod( 'sp_featured_slider_slides' );
				
				if($get_featured_posts) {
					$featured_posts = explode(',', $get_featured_posts);
					$args = array( 'showposts' => $number, 'post_type' => array('post', 'page'), 'post__in' => $featured_posts, 'orderby' => 'post__in' );
				} else {
					$args = array( 'cat' => $featured_cat, 'showposts' => $number );
				}
				
			?>
			
			<?php $feat_query = new WP_Query( $args ); ?>
		
			<?php if ($feat_query->have_posts()) : while ($feat_query->have_posts()) : $feat_query->the_post(); ?>
			
			<?php 

				if(has_post_thumbnail()) {
					$get_feat_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
					$feat_image = $get_feat_image[0];
				} else {
					$feat_image = get_template_directory_uri() . '/img/slider-default.png';
				}
			
			?>
	
		<li>
	
			<div class="feat-item" style="background-image:url(<?php echo $feat_image; ?>);">
				
				<?php if(get_theme_mod('sp_featured_cat_all_hide', false) && get_theme_mod('sp_featured_title_hide', false) && get_theme_mod('sp_featured_date_hide', false) && get_theme_mod('sp_featured_readmore_hide', false)) : else : ?>
				<div class="feat-overlay">
					<div class="feat-overlay-inner">
						
						<div class="post-header">
							
							<?php if(!get_theme_mod('sp_featured_cat_all_hide')) : ?>
							<span class="cat"><?php sp_category(' '); ?></span>
							<?php endif; ?>
							
							<?php if(!get_theme_mod('sp_featured_title_hide')) : ?>
							<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
							<?php endif; ?>
							
							<?php if(!get_theme_mod('sp_featured_date_hide')) : ?>
							<span class="date"><?php the_time( get_option('date_format') ); ?></span>
							<?php endif; ?>
							
							<?php if(!get_theme_mod('sp_featured_readmore_hide')) : ?>
							<a href="<?php echo get_permalink(); ?>" class="read-more"><?php _e( 'Read More', 'solopine' ); ?></a>
							<?php endif; ?>
							
						</div>
					
					</div>
				</div>
				<?php endif; ?>
				
			</div>
		
		</li>
		
		<?php endwhile; endif; ?>
	
	</ul>
	</div>
</div>