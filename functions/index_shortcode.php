<?php

function rosemary_index_func( $atts ){
	
	$a = shortcode_atts( array(
        'cat' => '',
		'title' => '',
        'amount' => '3',
		'cols' => '3',
		'display_title' => 'yes',
		'display_cat' => 'no',
		'display_image' => 'yes',
		'display_date' => 'yes',
		'cat_link' => 'yes',
		'cat_link_text' => 'View All',
		'offset' => ''
    ), $atts );
	
	$index_cat = $a['cat'];
	$index_title = $a['title'];
	$index_amount = $a['amount'];
	$index_cols = $a['cols'];
	$index_display_title = $a['display_title'];
	$index_display_cat = $a['display_cat'];
	$index_display_date = $a['display_date'];
	$index_display_image = $a['display_image'];
	$index_cat_link = $a['cat_link'];
	$index_cat_text = $a['cat_link_text'];
	$offset = $a['offset'];
	
	$query = new WP_Query( array( 'category_name' => $index_cat, 'posts_per_page' => $index_amount, 'ignore_sticky_posts' => true, 'offset' => $offset, 'post_type' => array('post','page') ) );
	
	ob_start(); ?>
		
		<?php
			if($index_cat) : 
				$idObj = get_category_by_slug($index_cat); 
				$id = $idObj->term_id;
				$cat_link = get_category_link( $id );
			endif;
		?>
		
		<div class="index-shortcode">
		
		<?php if($index_title) : ?>
		<h4 class="index-heading"><span><?php echo esc_html($index_title); ?></span>
		<?php if($index_cat_link == "yes" && $cat_link) : ?>
		<a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($index_cat_text); ?> <i class="fa fa-angle-double-right"></i></a>
		<?php endif; ?>
		</h4>
		<?php endif; ?>
		
		<?php if ( $query->have_posts() ) : ?>
		
		
		
		<?php
			if($index_cols == '3') :
				$cols = 3;
			elseif($index_cols == '4') :
				$cols = 4;
			elseif($index_cols == '2') :
				$cols = 2;
			else :
				$cols = 3;
			endif;
		?>
		
		<div class="index-wrap grid-<?php echo $cols; ?>">
		
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			
			<div class="index-item">
			<article id="post-<?php the_ID(); ?>" class="grid-item">
				
				<?php if($index_display_image != 'no') : ?>
				<div class="post-img">
					<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('misc-thumb'); ?></a>
				</div>
				<?php endif; ?>
				
				<div class="post-header">
					
					<?php if($index_display_cat == 'yes') : ?>
					<span class="cat"><?php sp_category(' '); ?></span>
					<?php endif; ?>
					
					<?php if($index_display_title != 'no') : ?>
					<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php endif; ?>
					
					<?php if($index_display_date == 'yes') : ?>
					<span class="date"><?php the_time( get_option('date_format') ); ?></span>
					<?php endif; ?>
					
				</div>
				
			</article>
			</div>
			
		
		<?php endwhile; ?>
		
		</div>
		
		<?php wp_reset_postdata(); ?>
		
		<?php endif; ?>
		
		</div>
	
	<?php
	return ob_get_clean();
	
}
add_shortcode( 'rosemary_index', 'rosemary_index_func' );