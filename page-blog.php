<?php

	/* Template Name: Page Blog Template */

?>
<?php get_header(); ?>

	<?php
        $check_fullwidth = get_post_meta( get_the_ID(), 'meta-checkbox-fullwidth', true );
        $check_page_content = get_post_meta( get_the_ID(), 'meta-checkbox-page-content', true );
        $check_blog_heading = get_post_meta( get_the_ID(), 'meta-text-blog-heading', true );
        $check_blog_layout = get_post_meta( get_the_ID(), 'meta-select-blog-layout', true );
        $check_number_posts = get_post_meta( get_the_ID(), 'meta-number-posts', true );
        $check_category = get_post_meta( get_the_ID(), 'meta-blog-category', true );
        $check_featured_slider = get_post_meta( get_the_ID(), 'meta-checkbox-blog-slider', true );
		$check_promo = get_post_meta( get_the_ID(), 'meta-checkbox-blog-promo', true );
    ?>
	
	<div class="container">
		
		<div id="content">
		
			<?php if($check_featured_slider) : ?>
				<?php get_template_part('inc/featured/featured'); ?>
			<?php endif; ?>
			
			<?php if($check_promo) : ?>
				<?php get_template_part('inc/promo/promo'); ?>
			<?php endif; ?>
		
			<div id="main" <?php if($check_fullwidth) : ?>class="fullwidth"<?php endif; ?>>
				
				<?php if($check_page_content) : ?>
                   
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			   
						<?php get_template_part('content', 'page'); ?>
						   
					<?php endwhile; endif; ?>
			   
				<?php endif; ?>
				
				<?php if($check_blog_heading) : ?>
				<div class="post-header page-blog">
					
					<h2><?php echo esc_html($check_blog_heading); ?></h2>
					
					<span class="title-divider"></span>
					
				</div>
				<?php endif; ?>
				
				<?php
				if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } else { $paged = 1; }
				$args = array(
					'posts_per_page' => $check_number_posts,
					'paged'          => $paged,
					'category_name' => $check_category
				);
				$the_query = new WP_Query( $args );
                ?>
				
				<?php if ($the_query->have_posts()) : ?>
				
				<?php if($check_blog_layout == 'grid' || $check_blog_layout == 'full_grid') : ?><ul class="sp-grid"><?php endif; ?>
				
				
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
				
					<?php if($check_blog_layout == 'grid') : ?>
					
						<?php get_template_part('content', 'grid'); ?>
					
					<?php elseif($check_blog_layout == 'list') : ?>
					
						<?php get_template_part('content', 'list'); ?>
						
					<?php elseif($check_blog_layout == 'full_list') : ?>
					
						<?php if( $the_query->current_post == 0 && !is_paged() ) : ?>
							<?php get_template_part('content'); ?>
						<?php else : ?>
							<?php get_template_part('content', 'list'); ?>
						<?php endif; ?>
					
					<?php elseif($check_blog_layout == 'full_grid') : ?>
					
						<?php if( $the_query->current_post == 0 && !is_paged() ) : ?>
							<?php get_template_part('content'); ?>
						<?php else : ?>
							<?php get_template_part('content', 'grid'); ?>
						<?php endif; ?>
					
					<?php else : ?>
						
						<?php get_template_part('content'); ?>
						
					<?php endif; ?>
				
				<?php endwhile; ?>
					
					<?php if($check_blog_layout == 'grid' || $check_blog_layout == 'full_grid') : ?></ul><?php endif; ?>
					
					<div class="pagination">
						
						<div class="older"><?php next_posts_link(wp_kses( __( 'Older Posts <i class="fa fa-angle-double-right"></i>', 'solopine' ), array( 'i' => array( 'class' => array() ) ) ), $the_query->max_num_pages); ?></div>
						<div class="newer"><?php previous_posts_link(wp_kses( __( '<i class="fa fa-angle-double-left"></i> Newer Posts', 'solopine' ), array( 'i' => array( 'class' => array() ) ) )); ?></div>
						
					</div>

				<?php endif; ?>
				
			</div>

<?php if($check_fullwidth) : else : ?><?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>