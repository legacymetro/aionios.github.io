<?php

/**
 * Add meta box
*/
function rosemary_custom_meta() {
	add_meta_box( 'rosemary_meta_blog', __( 'Blog Template Options', 'solopine' ), 'rosemary_meta_callback', 'page', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'rosemary_custom_meta' );

/**
 * Outputs the content of the meta box
 */
function rosemary_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'rosemary_nonce' );
    $rosemary_stored_meta = get_post_meta( $post->ID );
	global $typenow;
    ?>
	
<?php if($typenow == 'page') : ?>
	<div id="sp-blog-options">
		
		<p class="guten-message">Make sure to select the "<strong>Page Blog Template</strong>" under <strong>Page Attributes</strong> if using the below settings.</p>
		
		<p>
			<label for="meta-text-blog-heading" class="prfx-row-title"><?php _e( 'Blog Heading', 'solopine' )?></label>
			<input type="text" name="meta-text-blog-heading" id="meta-text-blog-heading" value="<?php if ( isset ( $rosemary_stored_meta['meta-text-blog-heading'] ) ) echo $rosemary_stored_meta['meta-text-blog-heading'][0]; ?>" />
		</p>
		
		<p>
			<label for="meta-select-blog-layout" class="prfx-row-title"><?php _e( 'Blog Layout', 'solopine' )?></label>
			<select name="meta-select-blog-layout" id="meta-select-blog-layout">
				<option value="full_post" <?php if ( isset ( $rosemary_stored_meta['meta-select-blog-layout'] ) ) selected( $rosemary_stored_meta['meta-select-blog-layout'][0], 'full_post' ); ?>><?php _e( 'Full Post Layout', 'solopine' )?></option>';
				<option value="grid" <?php if ( isset ( $rosemary_stored_meta['meta-select-blog-layout'] ) ) selected( $rosemary_stored_meta['meta-select-blog-layout'][0], 'grid' ); ?>><?php _e( 'Grid Layout', 'solopine' )?></option>';
				<option value="full_grid" <?php if ( isset ( $rosemary_stored_meta['meta-select-blog-layout'] ) ) selected( $rosemary_stored_meta['meta-select-blog-layout'][0], 'full_grid' ); ?>><?php _e( '1 Full then Grid', 'solopine' )?></option>';
				<option value="list" <?php if ( isset ( $rosemary_stored_meta['meta-select-blog-layout'] ) ) selected( $rosemary_stored_meta['meta-select-blog-layout'][0], 'list' ); ?>><?php _e( 'List Layout', 'solopine' )?></option>';
				<option value="full_list" <?php if ( isset ( $rosemary_stored_meta['meta-select-blog-layout'] ) ) selected( $rosemary_stored_meta['meta-select-blog-layout'][0], 'full_list' ); ?>><?php _e( '1 Full then List', 'solopine' )?></option>';
			</select>
		</p>
		
		<p>
			<label for="meta-number-posts" class="prfx-row-title"><?php _e( '# of Posts Per Page', 'solopine' )?></label>
			<input type="number" min="1" max="100" step="1" name="meta-number-posts" id="meta-number-posts" value="<?php if ( isset ( $rosemary_stored_meta['meta-number-posts'] ) ) : echo $rosemary_stored_meta['meta-number-posts'][0]; else : echo 9; endif; ?>" />
		</p>
		
		<p>
			<label for="meta-blog-category" class="prfx-row-title"><?php _e( 'Filter by Category (slug)', 'solopine' )?></label>
			<input type="text" name="meta-blog-category" id="meta-blog-category" value="<?php if ( isset ( $rosemary_stored_meta['meta-blog-category'] ) ) echo $rosemary_stored_meta['meta-blog-category'][0]; ?>" />
			<small style="display:block;">Separate category slugs with a comma. Leave this field blank to show all categories.</small>
		</p>
		
		<p>
			<span class="prfx-row-title"><?php _e( 'Fullwidth Layout (no sidebar)', 'solopine' )?>:</span>
			<div class="prfx-row-content">
				<label for="meta-checkbox-fullwidth">
					<input type="checkbox" name="meta-checkbox-fullwidth" id="meta-checkbox-fullwidth" value="yes" <?php if ( isset ( $rosemary_stored_meta['meta-checkbox-fullwidth'] ) ) checked( $rosemary_stored_meta['meta-checkbox-fullwidth'][0], 'yes' ); ?> />
				</label>
			</div>
		</p>
		
		<p>
			<span class="prfx-row-title"><?php _e( 'Include Page Content', 'solopine' )?>:</span>
			<div class="prfx-row-content">
				<label for="meta-checkbox-page-content">
					<input type="checkbox" name="meta-checkbox-page-content" id="meta-checkbox-page-content" value="yes" <?php if ( isset ( $rosemary_stored_meta['meta-checkbox-page-content'] ) ) checked( $rosemary_stored_meta['meta-checkbox-page-content'][0], 'yes' ); ?> />
				</label>
			</div>
		</p>	
		
		<p>
			<span class="prfx-row-title"><?php _e( 'Include Featured Slider', 'solopine' )?>:</span>
			<div class="prfx-row-content">
				<label for="meta-checkbox-blog-slider">
					<input type="checkbox" name="meta-checkbox-blog-slider" id="meta-checkbox-blog-slider" value="yes" <?php if ( isset ( $rosemary_stored_meta['meta-checkbox-blog-slider'] ) ) checked( $rosemary_stored_meta['meta-checkbox-blog-slider'][0], 'yes' ); ?> />
				</label>
			</div>
		</p>
		<p>
			<span class="prfx-row-title"><?php _e( 'Include Promo Boxes', 'solopine' )?>:</span>
			<div class="prfx-row-content">
				<label for="meta-checkbox-blog-promo">
					<input type="checkbox" name="meta-checkbox-blog-promo" id="meta-checkbox-blog-promo" value="yes" <?php if ( isset ( $rosemary_stored_meta['meta-checkbox-blog-promo'] ) ) checked( $rosemary_stored_meta['meta-checkbox-blog-promo'][0], 'yes' ); ?> />
				</label>
			</div>
		</p>	
		
	</div>
	
	<?php endif; 

}

/**
 * Saves the custom meta input
 */
function rosemary_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'rosemary_nonce' ] ) && wp_verify_nonce( $_POST[ 'rosemary_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
	
	// Checks for input and saves
	if( isset( $_POST[ 'meta-checkbox-fullwidth' ] ) ) {
		update_post_meta( $post_id, 'meta-checkbox-fullwidth', 'yes' );
	} else {
		update_post_meta( $post_id, 'meta-checkbox-fullwidth', '' );
	}
	if( isset( $_POST[ 'meta-checkbox-page-content' ] ) ) {
		update_post_meta( $post_id, 'meta-checkbox-page-content', 'yes' );
	} else {
		update_post_meta( $post_id, 'meta-checkbox-page-content', '' );
	}
	if( isset( $_POST[ 'meta-checkbox-blog-slider' ] ) ) {
		update_post_meta( $post_id, 'meta-checkbox-blog-slider', 'yes' );
	} else {
		update_post_meta( $post_id, 'meta-checkbox-blog-slider', '' );
	}
	if( isset( $_POST[ 'meta-checkbox-blog-promo' ] ) ) {
		update_post_meta( $post_id, 'meta-checkbox-blog-promo', 'yes' );
	} else {
		update_post_meta( $post_id, 'meta-checkbox-blog-promo', '' );
	}
	
    if( isset( $_POST[ 'meta-text-blog-heading' ] ) ) {
        update_post_meta( $post_id, 'meta-text-blog-heading', sanitize_text_field( $_POST[ 'meta-text-blog-heading' ] ) );
    }
	if( isset( $_POST[ 'meta-select-blog-layout' ] ) ) {
		update_post_meta( $post_id, 'meta-select-blog-layout', $_POST[ 'meta-select-blog-layout' ] );
	}
	if( isset( $_POST[ 'meta-number-posts' ] ) ) {
        update_post_meta( $post_id, 'meta-number-posts', sanitize_text_field( $_POST[ 'meta-number-posts' ] ) );
    }
	if( isset( $_POST[ 'meta-blog-category' ] ) ) {
        update_post_meta( $post_id, 'meta-blog-category', sanitize_text_field( $_POST[ 'meta-blog-category' ] ) );
    }
 
}
add_action( 'save_post', 'rosemary_meta_save' );

/**
 * Adds the meta box stylesheet
 */
function rosemary_admin_styles(){
    global $typenow;
    if( $typenow == 'page' ) {
		wp_enqueue_style('rosemary-meta-css', get_template_directory_uri() . '/functions/meta/meta-field-styles.css');
    }
}
add_action( 'admin_print_styles', 'rosemary_admin_styles' );

/**
 * Adds javascript to only display blog options on correct page template
 */
add_action( 'admin_head-post.php', 'metabox_switcher' );
add_action( 'admin_head-post-new.php', 'metabox_switcher' );
function metabox_switcher(  ){
	
	global $post;
	
    #Isolate to your specific post type
    if( $post->post_type === 'page' ){

        #Locate the ID of your metabox with Developer tools
        $metabox_selector_id = 'rosemary_meta_blog';

        echo '
            <style type="text/css">
                /* Hide your metabox so there is no latency flash of your metabox before being hidden */
                #'.$metabox_selector_id.'{display:none;}
				.block-editor-page #'.$metabox_selector_id.' {display:block;}
            </style>
            <script type="text/javascript">
                jQuery(document).ready(function($){

                    //You can find this in the value of the Page Template dropdown
                    var templateName = \'page-blog.php\';

                    //Page template in the publishing options
                    var currentTemplate = $(\'#page_template\');

                    //Identify your metabox
                    var metabox = $(\'#'.$metabox_selector_id.'\');

                    //On DOM ready, check if your page template is selected
                    if(currentTemplate.val() === templateName){
                        metabox.show();
                    }

                    //Bind a change event to make sure we show or hide the metabox based on user selection of a template
                    currentTemplate.change(function(e){
                        if(currentTemplate.val() === templateName){
                            metabox.show();
                        }
                        else{
                            //You should clear out all metabox values here;
                            metabox.hide();
                        }
                    });
                });
            </script>
        ';
    }
}