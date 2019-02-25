<?php
/*
Template Name: Narrow Full Width Post
Template Post Type: post
*/
?>
<?php get_header(); ?>
	
	<div class="container">
		
		<div id="content">
		
			<div id="main" class="fullwidth narrow post-fullwidth">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
					<?php get_template_part('content'); ?>
						
				<?php endwhile; ?>
				
				<?php endif; ?>
				
			</div>

<?php get_footer(); ?>