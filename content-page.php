<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if(!get_theme_mod('sp_page_title')) : ?>
	<div class="post-header">					
		<h1><?php the_title(); ?></h1>					
	</div>
	<?php endif; ?>
	
	<?php if(has_post_thumbnail()) : ?>
	<div class="post-img">				
		<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('full-thumb'); ?></a>					
	</div>
	<?php endif; ?>
	
	<div class="post-entry">					
		<?php the_content(__('<span class="more-button">Continue Reading</span>', 'solopine')); ?>	
		<?php wp_link_pages(); ?>	
	</div>
	
	<?php if(get_theme_mod('sp_page_share') && !comments_open()) : else :?>
	<div class="post-meta">
						
		<div class="meta-comments">
			<?php comments_popup_link( '0 Comments', '1 Comments', '% Comments', '', ''); ?>
		</div>
		
		<?php if(!get_theme_mod('sp_page_share')) : ?>
		<div class="meta-share">
			<span class="share-text"><?php _e( 'Share', 'solopine' ); ?></span>
			<?php if(!get_theme_mod('sp_page_share_facebook')) : ?><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook"></i></a><?php endif; ?>
			<?php if(!get_theme_mod('sp_page_share_twitter')) : ?><a target="_blank" href="https://twitter.com/intent/tweet?text=Check%20out%20this%20article:%20<?php print solopine_social_title( get_the_title() ); ?>&url=<?php echo urlencode(the_permalink()); ?>"><i class="fa fa-twitter"></i></a><?php endif; ?>
			<?php if(!get_theme_mod('sp_page_share_pinterest')) : ?>
			<?php $pin_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>
			<a data-pin-do="none" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(the_permalink()); ?>&media=<?php echo esc_url($pin_image); ?>&description=<?php print solopine_social_title( get_the_title() ); ?>"><i class="fa fa-pinterest"></i></a>
			<?php endif; ?>		
			<?php if(!get_theme_mod('sp_page_share_google')) : ?><a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i></a><?php endif; ?>
			<?php if(!get_theme_mod('sp_page_share_linkedin')) : ?><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(the_permalink()); ?>&title=<?php print solopine_social_title( get_the_title() ); ?>&summary=&source="><i class="fa fa-linkedin"></i></a><?php endif; ?>
		</div>
		<?php endif; ?>
		
	</div>
	<?php endif; ?>
	
	<?php comments_template( '', true );  ?>
	
</article>