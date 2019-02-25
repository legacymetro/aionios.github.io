<?php
	/****
	* Get Post Layout
	****/
?>

	<?php 
	
		$rosemary_get_template = get_page_template_slug( $post->ID );

		if($rosemary_get_template == 'single-sidebar.php') {
			get_template_part('single', 'sidebar');
		} elseif($rosemary_get_template == 'single-fullwidth.php') {
			get_template_part('single', 'fullwidth');
		} elseif($rosemary_get_template == 'single-fullwidth-narrow.php') {
			get_template_part('single', 'fullwidth-narrow');
		} else {
			
			if(get_theme_mod('sp_sidebar_post', false) == false) {
				$rosemary_default_template = 'post_sidebar';
			} else {
				$rosemary_default_template = 'post_fullwidth';
			}
			
			if($rosemary_default_template == 'post_sidebar') {
				get_template_part('single', 'sidebar');
			} else {
				get_template_part('single', 'fullwidth');
			}

		}
		
	?>