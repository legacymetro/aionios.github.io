<?php

	/* Template Name: Page with Slider, Promo Boxes & Sidebar */

?>
<?php get_header(); ?>
	
	<div class="container">
	
		<?php get_template_part('inc/featured/featured'); ?>
		
		<?php get_template_part('inc/promo/promo'); ?>
		
		<div id="content">
		
			<div id="main">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
					<?php get_template_part('content', 'page'); ?>
						
				<?php endwhile; ?>
				
				<?php endif; ?>
				
			</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>