<?php get_header(); ?>
	
	<div class="container">
		
		<div id="content">
		
			<div id="main" <?php if(!is_active_sidebar('sidebar-3')) : ?>class="fullwidth"<?php endif; ?>>
				<div class="post-entry">
					<?php woocommerce_content(); ?>
				</div>
			</div>

<?php if(is_active_sidebar('sidebar-3')) : ?>	
<?php get_sidebar('woocommerce'); ?>
<?php endif; ?>
<?php get_footer(); ?>