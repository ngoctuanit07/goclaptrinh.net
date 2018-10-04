<?php
/* Generate posts module form/field */
if ( !function_exists( 'vce_generate_module_field' ) ) :
	function vce_generate_module_field( $module, $i = false, $data ) {
		extract( $data );
		$mod_id = ( $i === false ) ?  'vce-hidden-module' : 'vce-hidden-module-'.$i;
		$name_prefix = ( $i === false ) ? '' :  'vce[modules]['.$i.']';
		$edit = ( $i === false ) ? '' :  'edit';
?>
		<div id="<?php echo $mod_id; ?>" class="vce-hidden-module">
		<div class="vce-module-form <?php echo $edit; ?>">
			<ul class="vce-tabs-nav">
				<li class="active"><a href="#"><?php _e( 'Appearance', THEME_SLUG ); ?></a></li>
				<li><a href="#"><?php _e( 'Combine layouts', THEME_SLUG ); ?></a></li>
				<li><a href="#"><?php _e( 'Post selection', THEME_SLUG ); ?></a></li>
				<li><a href="#"><?php _e( 'Action', THEME_SLUG ); ?></a></li>
				<li class="save"><a class="vce-save-module button-primary" href="javascript:void(0);"><?php _e( 'Save Module', THEME_SLUG ); ?></a></li>
			</ul>
			<div class="vce-tabs-wrap">
		    <div class="vce-tab">
			<p>
				<strong><?php _e( 'Title', THEME_SLUG ); ?>:</strong><br/>
				<input class="vce-count-me" type="text" name="<?php echo $name_prefix; ?>[title]" value="<?php echo $module['title'];?>"/>
				&nbsp;<label><input type="checkbox" class="vce-count-me" name="<?php echo $name_prefix; ?>[hide_title]" value="1" <?php checked($module['hide_title'],1); ?>/><?php _e( 'Do not display publicly', THEME_SLUG ); ?></label> <br/>
				<small class="howto"><?php _e( 'Enter your module title', THEME_SLUG ); ?></small>
			</p>

			<p>
				<strong><?php _e( 'Title link', THEME_SLUG ); ?>:</strong><br/>
				<input class="vce-count-me" type="text" name="<?php echo $name_prefix; ?>[title_link]" value="<?php echo esc_attr($module['title_link']);?>"/><br/>
				<small class="howto"><?php _e( 'Optionally, you can assign URL to title', THEME_SLUG ); ?></small>
			</p>
			<p><strong><?php _e( 'Choose layout', THEME_SLUG ); ?>:</strong></p>
		    <ul class="vce-img-select-wrap">
		  	<?php foreach ( $layouts as $id => $layout ): ?>
		  		<li>
		  			<?php $selected_class = vce_compare( $id, $module['layout'] ) ? ' selected': ''; ?>
		  			<img src="<?php echo $layout['img']; ?>" title="<?php echo $layout['title']; ?>" class="vce-img-select<?php echo $selected_class; ?>">
		  			<br/><span><?php echo $layout['title']; ?></span>
		  			<input type="radio" class="vce-hidden vce-count-me" name="<?php echo $name_prefix; ?>[layout]" value="<?php echo $id; ?>" <?php checked( $id, $module['layout'] );?>/> </label>

		  		</li>
		  	<?php endforeach; ?>
		    </ul>  	

		    <small class="howto"><?php _e( 'Choose your main posts layout', THEME_SLUG ); ?></small>
		    <p>
		    	<strong><?php _e( 'Max number of posts', THEME_SLUG ); ?>:</strong><br/>
		    	<input class="vce-count-me" type="text" name="<?php echo esc_attr($name_prefix); ?>[limit]" value="<?php echo esc_attr($module['limit']);?>"/><br/>
		    	<small class="howto"><?php _e( 'Specify maximum number of posts for this module', THEME_SLUG ); ?></small>
		    </p>

		    <p>
		    	<label><input type="checkbox" name="<?php echo $name_prefix; ?>[one_column]" value="1" class="vce-count-me" <?php checked( $module['one_column'], 1 );?>/><strong><?php _e( 'Make this module one-column (half width)', THEME_SLUG ); ?></strong></label><br/>
		    	<small class="howto"><?php _e( 'This option may apply to layouts C, D and F which are naturally listed in two columns', THEME_SLUG ); ?></small>
		  	</p>

		  	<p>
				<strong><?php _e( 'Custom CSS class', THEME_SLUG ); ?>:</strong><br/>
				<input class="vce-count-me" type="text" name="<?php echo $name_prefix; ?>[css_class]" value="<?php echo esc_attr($module['css_class']);?>"/><br/>
				<small class="howto"><?php _e( 'Specify class name for a possibility to apply custom styling to this module using CSS (i.e. my-custom-module)', THEME_SLUG ); ?></small>
			</p>

			</div>

			<div class="vce-tab">
		    <p><strong><?php _e( 'Choose starter posts layout', THEME_SLUG ); ?>:</strong></p>

		  	<ul class="vce-img-select-wrap next-hide">
	  		<?php foreach ( $starter_layouts as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = vce_compare( $module['top_layout'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo $layout['img']; ?>" title="<?php echo $layout['title']; ?>" class="vce-img-select<?php echo $selected_class; ?>">
	  			<br/><span><?php echo $layout['title']; ?></span>
	  			<input type="radio" class="vce-hidden vce-count-me" name="<?php echo $name_prefix; ?>[top_layout]" value="<?php echo $id; ?>" <?php checked( $id, $module['top_layout'] );?>/> </label>
	  		</li>
	  		<?php endforeach; ?>
	       </ul>

	  		<?php $style = !$module['top_layout'] ? 'style="display:none"' : ''; ?>

	  		<p class="form-field" <?php echo $style; ?>><strong><?php _e( 'Number of starter posts', THEME_SLUG ); ?>:</strong>
		  	<input type="text" name="<?php echo $name_prefix; ?>[top_limit]" value="<?php echo $module['top_limit']; ?>" class="vce-count-me" style="width: 30px;"/>
		  	</p>
		  	<p class="howto"><?php _e( 'Choose additional layout if you want to combine two layouts in same module so the first posts will be displayed in different layout', THEME_SLUG ); ?></p>
		  	</div>


		  	<div class="vce-tab">

		    <?php if ( !empty( $cats ) ): ?>
	   		<div class="vce-opt-item">
			   		<strong><?php _e( 'Filter by category', THEME_SLUG ); ?>:</strong><br/>
			   		<div class="vce-item-scroll">
			   		<?php foreach ( $cats as $cat ) : ?>
			   			<?php $checked = in_array( $cat->term_id, $module['cat'] ) ? 'checked="checked"' : ''; ?>
			   			<label><input class="vce-count-me" type="checkbox" name="<?php echo $name_prefix; ?>[cat][]" value="<?php echo $cat->term_id ?>" <?php echo $checked; ?> /><?php echo $cat->name;?></label><br/>
			   		<?php endforeach; ?>
			   		</div>
			   		<small class="howto"><?php _e( 'Check whether you want to display posts from specific categories only. Or leave empty for all categories.', THEME_SLUG ); ?></small><br/>
		    		<label><input type="checkbox" name="<?php echo $name_prefix; ?>[cat_child]" value="1" class="vce-count-me" <?php checked( $module['cat_child'], 1 );?>/><strong><?php _e( 'Apply child categories', THEME_SLUG ); ?></strong></label><br/>
		    		<small class="howto"><?php _e( 'If parent category is selected, posts from child categories will be included automatically', THEME_SLUG ); ?></small>
		   			<br/>
			    	<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[cat_inc_exc]" value="in" <?php checked( $module['cat_inc_exc'], 'in' ); ?> class="vce-count-me" /><?php esc_html_e('Include', THEME_SLUG) ?></label><br/>
			   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[cat_inc_exc]" value="not_in" <?php checked( $module['cat_inc_exc'], 'not_in' ); ?> class="vce-count-me" /><?php esc_html_e('Exclude', THEME_SLUG) ?></label><br/>
			   		<small class="howto"><?php esc_html_e( 'Whether to include or exclude posts from selected categories', THEME_SLUG ); ?></small>
		   			<br/>

		   			<strong><?php _e( 'Filter by tag', THEME_SLUG ); ?>:</strong><br/>
			   		<div class="tagsdiv" id="post_tag">
						<div class="jaxtag">
							<label class="screen-reader-text" for="newtag"><?php _e( 'Tags' ); ?></label>
							<input type="hidden" name="<?php echo $name_prefix; ?>[tag]" class="the-tags vce-count-me" id="tax-input[post_tag]" value="<?php echo $module['tag']; ?>" />
							<div class="ajaxtag">
								<input type="text" name="newtag[post_tag]" class="newtag form-input-tip" size="16" autocomplete="off" value="" />
								<input type="button" class="button tagadd" value="<?php esc_attr_e( 'Add' ); ?>" />
							</div>
						</div>
						<div class="tagchecklist">
							<?php $meta_tags = explode( ',', $module['tag'] ); if ( !empty( $meta_tags ) ): $tag_i = 0; foreach ( $meta_tags as $tag_name ) : ?>
								<span><a id="post_tag-check-num-<?php echo $i; ?>" class="ntdelbutton">X</a>&nbsp;<?php echo $tag_name; ?></span>
							<?php $tag_i++; endforeach; endif; ?>
						</div>
					</div>
					<br>
					<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[tag_inc_exc]" value="in" <?php checked( $module['tag_inc_exc'], 'in' ); ?> class="vce-count-me" /><?php esc_html_e('Include', THEME_SLUG) ?></label><br/>
			   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[tag_inc_exc]" value="not_in" <?php checked( $module['tag_inc_exc'], 'not_in' ); ?> class="vce-count-me" /><?php esc_html_e('Exclude', THEME_SLUG) ?></label><br/>
			   		<small class="howto"><?php esc_html_e( 'Whether to include or exclude posts from selected tags', THEME_SLUG ); ?></small>

			   		<!-- filter by author -->
			   		<br>
					<strong><?php esc_html_e( 'Filter by author (username)', THEME_SLUG ); ?>:</strong><br/>
					<input type="text" name="<?php echo esc_attr($name_prefix); ?>[author]" value="<?php echo esc_attr( vce_get_authors_username_by_id($module['author']) ); ?>" />
					<br><br>
			  		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[author_inc_exc]" value="in" <?php checked( $module['author_inc_exc'], 'in' ); ?> class="vce-count-me" /><?php esc_html_e('Include', THEME_SLUG) ?></label><br/>
			   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[author_inc_exc]" value="not_in" <?php checked( $module['author_inc_exc'], 'not_in' ); ?> class="vce-count-me" /><?php esc_html_e('Exclude', THEME_SLUG) ?></label><br/>
			   		<small class="howto"><?php esc_html_e( 'Whether to include or exclude author posts', THEME_SLUG ); ?></small>

			   		<br>
			   		<strong><?php esc_html_e( 'Exclude by id', THEME_SLUG ); ?>:</strong><br>
					<?php  $ids = $module['exclude_by_id'] ?  implode(', ', $module['exclude_by_id']) : ''; ?>
			   		<input type="text" name="<?php echo esc_attr($name_prefix); ?>[exclude_by_id]" value="<?php echo esc_attr( $ids ); ?>" class="vce-count-me" style="width: 100%" />
			   		<small class="howto"><?php _e( 'Specify post ids separated by comma i.e. 213,32,12,45', THEME_SLUG ); ?></small>
		   	</div>
		   	<?php endif; ?>

		   	<div class="vce-opt-item">
		   		<div style="width:50%; float:left;">
			   		<strong><?php _e( 'Not older than', THEME_SLUG ); ?>:</strong><br/>
			   		<?php foreach ( $time['from'] as $id => $title ) : ?>
			   		<label><input type="radio" name="<?php echo $name_prefix; ?>[time]" value="<?php echo $id; ?>" <?php checked( $module['time'], $id ); ?> class="vce-count-me" /><?php echo $title;?></label><br/>
			   		<?php endforeach; ?>
			   		<small class="howto"><?php _e( 'Display posts that are not older than some specific time', THEME_SLUG ); ?></small>
		   			<br/>
		   		</div>
		   		<div style="width:50%; float:left;">
		   			<strong><?php _e( 'Older than', THEME_SLUG ); ?>:</strong><br/>
			   		<?php foreach ( $time['to'] as $id => $title ) : ?>
			   		<label><input type="radio" name="<?php echo $name_prefix; ?>[timeto]" value="<?php echo $id; ?>" <?php checked( $module['timeto'], $id ); ?> class="vce-count-me" /><?php echo $title;?></label><br/>
			   		<?php endforeach; ?>
			   		<small class="howto"><?php _e( 'Display posts that are older than some specific time', THEME_SLUG ); ?></small>
		   			<br/>
		   		</div>
	   			<strong><?php _e( 'Order posts by', THEME_SLUG ); ?>:</strong><br/>
		   		<?php foreach ( $order as $id => $title ) : ?>
		   		<label><input type="radio" name="<?php echo $name_prefix; ?>[order]" value="<?php echo $id; ?>" <?php checked( $module['order'], $id ); ?> class="vce-count-me" /><?php echo $title;?></label><br/>
		   		<?php endforeach; ?>
		   		<small class="howto"><?php _e( 'Specify posts ordering', THEME_SLUG ); ?></small><br/>

				<strong><?php esc_html_e( 'Sort', THEME_SLUG ); ?>:</strong></br>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[sort]" value="DESC" <?php checked( $module['sort'], 'DESC' ); ?> class="vce-count-me" /><?php esc_html_e('Descending', THEME_SLUG) ?></label><br/>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[sort]" value="ASC" <?php checked( $module['sort'], 'ASC' ); ?> class="vce-count-me" /><?php esc_html_e('Ascending', THEME_SLUG) ?></label><br/>
		   		
		   		<br>
	   			<strong><?php _e( 'Choose posts (or pages) manually', THEME_SLUG ); ?>:</strong><br/>
		   		<?php $manual = !empty( $module['manual'] ) ? implode( ",", $module['manual'] ) : ''; ?>
		   		<input type="text" name="<?php echo $name_prefix; ?>[manual]" value="<?php echo $manual; ?>" class="vce-count-me" style="width: 100%;"/><br/>
		   		<small class="howto"><?php _e( 'Specify post ids separated by comma if you want to select only those posts. i.e. 213,32,12,45', THEME_SLUG ); ?></small>
	   		</div>

	   		<div class="clear"></div>
	   		<p><label><input type="checkbox" class="vce-count-me" name="<?php echo $name_prefix; ?>[exclude]" value="1" <?php checked( $module['exclude'], 1 )?>/><strong><?php _e( 'Do not duplicate (display only in this module)', THEME_SLUG ); ?></strong></label>
	   		<br/>
	   		<small class="howto"><?php _e( 'Check this option if you want posts in this module to be excluded from other modules so they don\'t appear twice', THEME_SLUG ); ?></small></p>


	   		</div>

	   		<div class="vce-tab">
	   			<p><strong><?php _e( 'Choose additional options', THEME_SLUG ); ?>:</strong><br/>
		   		<?php foreach ( $actions as $id => $title ) : ?>

		   		<label><input type="radio" name="<?php echo $name_prefix; ?>[action]" value="<?php echo $id; ?>" <?php checked( (string)$module['action'], $id ); ?> class="vce-count-me vce-action-pick" /><?php echo $title;?></label><br/>
		   		<?php endforeach; ?>
		   		</p>

		   		<?php $style = vce_compare( $module['action'], 'pagination' ) ?  '' : 'style="display:none"';  ?>
		   		<div class="vce-pagination-wrap hideable" <?php echo $style; ?>>
			   		<p><strong><?php _e( 'Choose pagination type', THEME_SLUG ); ?>:</strong></p>
			   		<ul class="vce-img-select-wrap">
			  		<?php foreach ( $paginations as $id => $pagination ): ?>
			  		<li>
			  			<?php $selected_class = vce_compare( $module['pagination'], $id ) ? ' selected': ''; ?>
			  			<img src="<?php echo $pagination['img']; ?>" title="<?php echo $pagination['title']; ?>" class="vce-img-select<?php echo $selected_class; ?>">
			  			<br/><span><?php echo $pagination['title']; ?></span>
			  			<input type="radio" class="vce-hidden vce-count-me" name="<?php echo $name_prefix; ?>[pagination]" value="<?php echo $id; ?>" <?php checked( $id, $module['pagination'] );?>/> </label>
			  		</li>
			  		<?php endforeach; ?>
			       </ul>
			       <small class="howto"><?php _e( 'Note: Pagination can be added only for the last module on the page', THEME_SLUG ); ?></small>
		   		</div>

		   		<?php $style = vce_compare( $module['action'], 'link' ) ?  '' : 'style="display:none"'; ?>
		   		<div class="vce-link-wrap hideable" <?php echo $style; ?>>
		   			<p><strong><?php _e( 'Link/Button Text', THEME_SLUG ); ?>:</strong><br/>
		   			<input type="text" name="<?php echo $name_prefix; ?>[action_link_text]" value="<?php echo esc_attr( $module['action_link_text'] ); ?>" class="vce-count-me"/></p>
		   			<p><strong><?php _e( 'Link/Button URL', THEME_SLUG ); ?>:</strong><br/>
		   			<input type="text" name="<?php echo $name_prefix; ?>[action_link_url]" value="<?php echo esc_url( $module['action_link_url'] ); ?>" class="vce-count-me"/></p>
		   		</div>

		   		<?php $style = vce_compare( $module['action'], 'slider' ) ?  '' : 'style="display:none"'; ?>
		   		<div class="vce-slider-wrap hideable" <?php echo $style; ?>>
		   			<p><strong><?php _e( 'Autoplay slider posts', THEME_SLUG ); ?>:</strong><br/>
		   			<input type="text" name="<?php echo $name_prefix; ?>[autoplay]" value="<?php echo esc_attr( $module['autoplay'] ); ?>" class="vce-count-me"/>
		   			<br/>
		   			<small class="howto"><?php _e( 'Specify number of seconds if you want to auto-slide posts, or leave empty for no autoplay', THEME_SLUG ); ?></small>
		   			</p>

		   		</div>


	   		</div>

	   		</div>
	   		<input type="hidden" class="vce-deactivate" name="<?php echo $name_prefix; ?>[active]" value="<?php echo esc_attr($module['active']); ?>">
	   		<input class="vce-count-me" type="hidden" name="<?php echo $name_prefix; ?>[type]" value="posts"/>
	
		</div>
	</div>
	<?php
	}
endif;



/* Generate cpt module form/field */
if ( !function_exists( 'vce_generate_cpt_module_field' ) ) :
	function vce_generate_cpt_module_field( $module, $i = false, $data ) {
	 	
		extract( $data );
		$mod_id = ( $i === false ) ?  'vce-hidden-module-'.$module['type'] : 'vce-hidden-module-'.$i;
		$name_prefix = ( $i === false ) ? '' :  'vce[modules]['.$i.']';
		$edit = ( $i === false ) ? '' :  'edit';
?>
		<div id="<?php echo $mod_id; ?>" class="vce-hidden-module">
		<div class="vce-module-form <?php echo $edit; ?>">
			<ul class="vce-tabs-nav">
				<li class="active"><a href="#"><?php _e( 'Appearance', THEME_SLUG ); ?></a></li>
				<li><a href="#"><?php _e( 'Combine layouts', THEME_SLUG ); ?></a></li>
				<li><a href="#"><?php _e( 'Post selection', THEME_SLUG ); ?></a></li>
				<li><a href="#"><?php _e( 'Action', THEME_SLUG ); ?></a></li>
				<li class="save"><a class="vce-save-module button-primary" href="javascript:void(0);"><?php _e( 'Save Module', THEME_SLUG ); ?></a></li>
			</ul>
			<div class="vce-tabs-wrap">
		    <div class="vce-tab">
			<p>
				<strong><?php _e( 'Title', THEME_SLUG ); ?>:</strong><br/>
				<input class="vce-count-me" type="text" name="<?php echo $name_prefix; ?>[title]" value="<?php echo $module['title'];?>"/>
				&nbsp;<label><input type="checkbox" class="vce-count-me" name="<?php echo $name_prefix; ?>[hide_title]" value="1" <?php checked($module['hide_title'],1); ?>/><?php _e( 'Do not display publicly', THEME_SLUG ); ?></label> <br/>
				<small class="howto"><?php _e( 'Enter your module title', THEME_SLUG ); ?></small>
			</p>

			<p>
				<strong><?php _e( 'Title link', THEME_SLUG ); ?>:</strong><br/>
				<input class="vce-count-me" type="text" name="<?php echo $name_prefix; ?>[title_link]" value="<?php echo esc_attr($module['title_link']);?>"/><br/>
				<small class="howto"><?php _e( 'Optionally, you can assign URL to title', THEME_SLUG ); ?></small>
			</p>
			<p><strong><?php _e( 'Choose layout', THEME_SLUG ); ?>:</strong></p>
		    <ul class="vce-img-select-wrap">
		  	<?php foreach ( $layouts as $id => $layout ): ?>
		  		<li>
		  			<?php $selected_class = vce_compare( $id, $module['layout'] ) ? ' selected': ''; ?>
		  			<img src="<?php echo $layout['img']; ?>" title="<?php echo $layout['title']; ?>" class="vce-img-select<?php echo $selected_class; ?>">
		  			<br/><span><?php echo $layout['title']; ?></span>
		  			<input type="radio" class="vce-hidden vce-count-me" name="<?php echo $name_prefix; ?>[layout]" value="<?php echo $id; ?>" <?php checked( $id, $module['layout'] );?>/> </label>

		  		</li>
		  	<?php endforeach; ?>
		    </ul>  	

		    <small class="howto"><?php _e( 'Choose your main posts layout', THEME_SLUG ); ?></small>
		    <p>
		    	<strong><?php _e( 'Max number of posts', THEME_SLUG ); ?>:</strong><br/>
		    	<input class="vce-count-me" type="text" name="<?php echo esc_attr($name_prefix); ?>[limit]" value="<?php echo esc_attr($module['limit']);?>"/><br/>
		    	<small class="howto"><?php _e( 'Specify maximum number of posts for this module', THEME_SLUG ); ?></small>
		    </p>

		    <p>
		    	<label><input type="checkbox" name="<?php echo $name_prefix; ?>[one_column]" value="1" class="vce-count-me" <?php checked( $module['one_column'], 1 );?>/><strong><?php _e( 'Make this module one-column (half width)', THEME_SLUG ); ?></strong></label><br/>
		    	<small class="howto"><?php _e( 'This option may apply to layouts C, D and F which are naturally listed in two columns', THEME_SLUG ); ?></small>
		  	</p>

		  	<p>
				<strong><?php _e( 'Custom CSS class', THEME_SLUG ); ?>:</strong><br/>
				<input class="vce-count-me" type="text" name="<?php echo $name_prefix; ?>[css_class]" value="<?php echo esc_attr($module['css_class']);?>"/><br/>
				<small class="howto"><?php _e( 'Specify class name for a possibility to apply custom styling to this module using CSS (i.e. my-custom-module)', THEME_SLUG ); ?></small>
			</p>

			</div>

			<div class="vce-tab">
		    <p><strong><?php _e( 'Choose starter posts layout', THEME_SLUG ); ?>:</strong></p>

		  	<ul class="vce-img-select-wrap next-hide">
	  		<?php foreach ( $starter_layouts as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = vce_compare( $module['top_layout'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo $layout['img']; ?>" title="<?php echo $layout['title']; ?>" class="vce-img-select<?php echo $selected_class; ?>">
	  			<br/><span><?php echo $layout['title']; ?></span>
	  			<input type="radio" class="vce-hidden vce-count-me" name="<?php echo $name_prefix; ?>[top_layout]" value="<?php echo $id; ?>" <?php checked( $id, $module['top_layout'] );?>/> </label>
	  		</li>
	  		<?php endforeach; ?>
	       </ul>

	  		<?php $style = !$module['top_layout'] ? 'style="display:none"' : ''; ?>

	  		<p class="form-field" <?php echo $style; ?>><strong><?php _e( 'Number of starter posts', THEME_SLUG ); ?>:</strong>
		  	<input type="text" name="<?php echo $name_prefix; ?>[top_limit]" value="<?php echo $module['top_limit']; ?>" class="vce-count-me" style="width: 30px;"/>
		  	</p>
		  	<p class="howto"><?php _e( 'Choose additional layout if you want to combine two layouts in same module so the first posts will be displayed in different layout', THEME_SLUG ); ?></p>
		  	</div>


		  	<div class="vce-tab">

			<!-- CPT taxonomies -->

		   	<?php if ( !empty( $taxonomies ) ): ?>
	   			<div class="vce-opt-item">
				<?php foreach ( $taxonomies as $taxonomy ) : ?>
							<div class="">
								<?php esc_html_e( 'In ', THEME_SLUG ); ?><?php echo $taxonomy['name']; ?>:
							</div>
							<div class="">

								<?php if($taxonomy['hierarchical']) : ?>

									<div class="vce-fit-height">
							   			<?php foreach ($taxonomy['terms'] as $term) : ?>
							   			<?php $tax = !empty( $module['tax'][$taxonomy['id']] ) ? $module['tax'][$taxonomy['id']] : array(); ?>
							   			<?php $checked = in_array( $term->term_id, $tax ) ? 'checked="checked"' : ''; ?>
							   			<label><input class="vce-count-me" type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[tax][<?php echo esc_attr($taxonomy['id']); ?>][]" value="<?php echo esc_attr($term->term_id); ?>" <?php echo $checked; ?> /><?php echo $term->name;?></label><br/>
								   		<?php endforeach; ?>
							   		</div>
						   			<small class="howto"><?php esc_html_e( 'Check whether you want to display posts from specific', THEME_SLUG ); ?> <?php echo $taxonomy['name']; ?></small>
									<br>
							   	<?php else: ?>
							   			
										<?php $tax = !empty( $module['tax'][$taxonomy['id']] ) ? vce_get_tax_term_name_by_id($module['tax'][$taxonomy['id']], $taxonomy['id'] ) : '' ?>
								   		<input type="text" name="<?php echo esc_attr($name_prefix); ?>[tax][<?php echo esc_attr($taxonomy['id']); ?>]" value="<?php echo esc_attr( $tax ); ?>" class="vce-count-me"/><br/>
								   		<small class="howto"><?php esc_html_e( 'Specify one or more terms separated by comma. i.e. life, cooking, funny moments', THEME_SLUG ); ?></small>
										<br>
								<?php endif; ?>
						   	</div>
					   	
					<?php endforeach; ?>

			   		<!-- filter by author -->
			   		<br>
					<strong><?php esc_html_e( 'Filter by author (username)', THEME_SLUG ); ?>:</strong><br/>
					<input type="text" name="<?php echo esc_attr($name_prefix); ?>[author]" value="<?php echo esc_attr( vce_get_authors_username_by_id($module['author']) ); ?>" />
					<br><br>
			  		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[author_inc_exc]" value="in" <?php checked( $module['author_inc_exc'], 'in' ); ?> class="vce-count-me" /><?php esc_html_e('Include', THEME_SLUG) ?></label><br/>
			   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[author_inc_exc]" value="not_in" <?php checked( $module['author_inc_exc'], 'not_in' ); ?> class="vce-count-me" /><?php esc_html_e('Exclude', THEME_SLUG) ?></label><br/>
			   		<small class="howto"><?php esc_html_e( 'Whether to include or exclude author posts', THEME_SLUG ); ?></small>

			   		<br>
			   		<strong><?php esc_html_e( 'Exclude by id', THEME_SLUG ); ?>:</strong><br>
					<?php  $ids = $module['exclude_by_id'] ?  implode(', ', $module['exclude_by_id']) : ''; ?>
			   		<input type="text" name="<?php echo esc_attr($name_prefix); ?>[exclude_by_id]" value="<?php echo esc_attr( $ids ); ?>" class="vce-count-me" style="width: 100%" />
			   		<small class="howto"><?php _e( 'Specify post ids separated by comma i.e. 213,32,12,45', THEME_SLUG ); ?></small>
		   	</div> <!-- vce-opt-item -->
		   	<?php endif; ?>
		   

		   	<div class="vce-opt-item">
		   		<div style="width:50%; float:left;">
			   		<strong><?php _e( 'Not older than', THEME_SLUG ); ?>:</strong><br/>
			   		<?php foreach ( $time['from'] as $id => $title ) : ?>
			   		<label><input type="radio" name="<?php echo $name_prefix; ?>[time]" value="<?php echo $id; ?>" <?php checked( $module['time'], $id ); ?> class="vce-count-me" /><?php echo $title;?></label><br/>
			   		<?php endforeach; ?>
			   		<small class="howto"><?php _e( 'Display posts that are not older than some specific time', THEME_SLUG ); ?></small>
		   			<br/>
		   		</div>
		   		<div style="width:50%; float:left;">
		   			<strong><?php _e( 'Older than', THEME_SLUG ); ?>:</strong><br/>
			   		<?php foreach ( $time['to'] as $id => $title ) : ?>
			   		<label><input type="radio" name="<?php echo $name_prefix; ?>[timeto]" value="<?php echo $id; ?>" <?php checked( $module['timeto'], $id ); ?> class="vce-count-me" /><?php echo $title;?></label><br/>
			   		<?php endforeach; ?>
			   		<small class="howto"><?php _e( 'Display posts that are older than some specific time', THEME_SLUG ); ?></small>
		   			<br/>
		   		</div>
	   			<strong><?php _e( 'Order posts by', THEME_SLUG ); ?>:</strong><br/>
		   		<?php foreach ( $order as $id => $title ) : ?>
		   		<label><input type="radio" name="<?php echo $name_prefix; ?>[order]" value="<?php echo $id; ?>" <?php checked( $module['order'], $id ); ?> class="vce-count-me" /><?php echo $title;?></label><br/>
		   		<?php endforeach; ?>
		   		<small class="howto"><?php _e( 'Specify posts ordering', THEME_SLUG ); ?></small><br/>

				<strong><?php esc_html_e( 'Sort', THEME_SLUG ); ?>:</strong></br>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[sort]" value="DESC" <?php checked( $module['sort'], 'DESC' ); ?> class="vce-count-me" /><?php esc_html_e('Descending', THEME_SLUG) ?></label><br/>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[sort]" value="ASC" <?php checked( $module['sort'], 'ASC' ); ?> class="vce-count-me" /><?php esc_html_e('Ascending', THEME_SLUG) ?></label><br/>
		   		
		   		<br>
	   			<strong><?php _e( 'Choose posts (or pages) manually', THEME_SLUG ); ?>:</strong><br/>
		   		<?php $manual = !empty( $module['manual'] ) ? implode( ",", $module['manual'] ) : ''; ?>
		   		<input type="text" name="<?php echo $name_prefix; ?>[manual]" value="<?php echo $manual; ?>" class="vce-count-me" style="width: 100%;"/><br/>
		   		<small class="howto"><?php _e( 'Specify post ids separated by comma if you want to select only those posts. i.e. 213,32,12,45', THEME_SLUG ); ?></small>
	   		</div> <!-- vce-opt-item -->

	   		<div class="clear"></div>
	   		<p><label><input type="checkbox" class="vce-count-me" name="<?php echo $name_prefix; ?>[exclude]" value="1" <?php checked( $module['exclude'], 1 )?>/><strong><?php _e( 'Do not duplicate (display only in this module)', THEME_SLUG ); ?></strong></label>
	   		<br/>
	   		<small class="howto"><?php _e( 'Check this option if you want posts in this module to be excluded from other modules so they don\'t appear twice', THEME_SLUG ); ?></small></p>


	   		</div> <!-- end vce-tab -->

	   		<div class="vce-tab">
	   			<p><strong><?php _e( 'Choose additional options', THEME_SLUG ); ?>:</strong><br/>
		   		<?php foreach ( $actions as $id => $title ) : ?>
		   		<label><input type="radio" name="<?php echo $name_prefix; ?>[action]" value="<?php echo $id; ?>" <?php checked( $module['action'], $id ); ?> class="vce-count-me vce-action-pick" /><?php echo $title;?></label><br/>
		   		<?php endforeach; ?>
		   		</p>

		   		<?php $style = vce_compare( $module['action'], 'pagination' ) ?  '' : 'style="display:none"';  ?>
		   		<div class="vce-pagination-wrap hideable" <?php echo $style; ?>>
			   		<p><strong><?php _e( 'Choose pagination type', THEME_SLUG ); ?>:</strong></p>
			   		<ul class="vce-img-select-wrap">
			  		<?php foreach ( $paginations as $id => $pagination ): ?>
			  		<li>
			  			<?php $selected_class = vce_compare( $module['pagination'], $id ) ? ' selected': ''; ?>
			  			<img src="<?php echo $pagination['img']; ?>" title="<?php echo $pagination['title']; ?>" class="vce-img-select<?php echo $selected_class; ?>">
			  			<br/><span><?php echo $pagination['title']; ?></span>
			  			<input type="radio" class="vce-hidden vce-count-me" name="<?php echo $name_prefix; ?>[pagination]" value="<?php echo $id; ?>" <?php checked( $id, $module['pagination'] );?>/> </label>
			  		</li>
			  		<?php endforeach; ?>
			       </ul>
			       <small class="howto"><?php _e( 'Note: Pagination can be added only for the last module on the page', THEME_SLUG ); ?></small>
		   		</div>

		   		<?php $style = vce_compare( $module['action'], 'link' ) ?  '' : 'style="display:none"'; ?>
		   		<div class="vce-link-wrap hideable" <?php echo $style; ?>>
		   			<p><strong><?php _e( 'Link/Button Text', THEME_SLUG ); ?>:</strong><br/>
		   			<input type="text" name="<?php echo $name_prefix; ?>[action_link_text]" value="<?php echo esc_attr( $module['action_link_text'] ); ?>" class="vce-count-me"/></p>
		   			<p><strong><?php _e( 'Link/Button URL', THEME_SLUG ); ?>:</strong><br/>
		   			<input type="text" name="<?php echo $name_prefix; ?>[action_link_url]" value="<?php echo esc_url( $module['action_link_url'] ); ?>" class="vce-count-me"/></p>
		   		</div>

		   		<?php $style = vce_compare( $module['action'], 'slider' ) ?  '' : 'style="display:none"'; ?>
		   		<div class="vce-slider-wrap hideable" <?php echo $style; ?>>
		   			<p><strong><?php _e( 'Autoplay slider posts', THEME_SLUG ); ?>:</strong><br/>
		   			<input type="text" name="<?php echo $name_prefix; ?>[autoplay]" value="<?php echo esc_attr( $module['autoplay'] ); ?>" class="vce-count-me"/>
		   			<br/>
		   			<small class="howto"><?php _e( 'Specify number of seconds if you want to auto-slide posts, or leave empty for no autoplay', THEME_SLUG ); ?></small>
		   			</p>

		   		</div>


	   		</div>

	   		</div>

	   		<input type="hidden" class="vce-deactivate" name="<?php echo $name_prefix; ?>[active]" value="<?php echo esc_attr($module['active']); ?>">
	   		<input class="vce-count-me" type="hidden" name="<?php echo $name_prefix; ?>[type]" value="<?php echo esc_attr($module['type']); ?>" />
	   		<input class="vce-count-me" type="hidden" name="<?php echo $name_prefix; ?>[cpt]" value="1" />

		</div>
	</div>
	<?php
	}
endif;


/* Generate blank module form/field */
if ( !function_exists( 'vce_generate_blank_module_field' ) ) :
	function vce_generate_blank_module_field( $module, $i = false, $data ) {
		extract( $data );
		$mod_id = ( $i === false ) ?  'vce-hidden-module-blank' : 'vce-hidden-module-'.$i;
		$name_prefix = ( $i === false ) ? '' :  'vce[modules]['.$i.']';
		$edit = ( $i === false ) ? '' :  'edit';
?>
		<div id="<?php echo $mod_id; ?>" class="vce-hidden-module">
			<div class="vce-module-form <?php echo $edit; ?>">
				<p>
				<strong><?php _e( 'Title', THEME_SLUG ); ?>:</strong><br/>
				<input class="vce-count-me" type="text" name="<?php echo $name_prefix; ?>[title]" value="<?php echo $module['title'];?>"/>
				&nbsp;<label><input type="checkbox" class="vce-count-me" name="<?php echo $name_prefix; ?>[hide_title]" value="1" <?php checked($module['hide_title'],1); ?>/><?php _e( 'Do not display publicly', THEME_SLUG ); ?></label> <br/>
				<small class="howto"><?php _e( 'Enter your module title', THEME_SLUG ); ?></small>
				</p>
				<p>
				<strong><?php _e( 'Title link', THEME_SLUG ); ?>:</strong><br/>
				<input class="vce-count-me" type="text" name="<?php echo $name_prefix; ?>[title_link]" value="<?php echo esc_attr($module['title_link']);?>"/><br/>
				<small class="howto"><?php _e( 'Optionally, you can assign URL to title', THEME_SLUG ); ?></small>
				</p>
				<p>
				<strong><?php _e( 'Content', THEME_SLUG ); ?>:</strong><br/>
				<textarea class="vce-count-me" name="<?php echo $name_prefix; ?>[content]" style="width: 100%; height: 200px;"><?php echo $module['content'];?></textarea>
				<small class="howto"><?php _e( 'You can put any text, HTML, JavaScript or shortcodes here', THEME_SLUG ); ?></small>
				</p>

				<p>
		    		<label><input type="checkbox" name="<?php echo $name_prefix; ?>[one_column]" value="1" class="vce-count-me" <?php checked( $module['one_column'], 1 );?>/><strong><?php _e( 'Make this module one-column (half width)', THEME_SLUG ); ?></strong></label><br/>
		  		</p>
		  		<p>
					<strong><?php _e( 'Custom CSS class', THEME_SLUG ); ?>:</strong><br/>
					<input class="vce-count-me" type="text" name="<?php echo $name_prefix; ?>[css_class]" value="<?php echo esc_attr($module['css_class']);?>"/><br/>
					<small class="howto"><?php _e( 'Specify class name for a possibility to apply custom styling to this module using CSS (i.e. my-custom-module)', THEME_SLUG ); ?></small>
				</p>

		  		<p>
		  			<a class="vce-save-module button-primary" href="javascript:void(0);"><?php _e( 'Save Module', THEME_SLUG ); ?></a>
		  		</p>
		  		<input type="hidden" class="vce-deactivate" name="<?php echo $name_prefix; ?>[active]" value="<?php echo esc_attr($module['active']); ?>">
		  		<input class="vce-count-me" type="hidden" name="<?php echo $name_prefix; ?>[type]" value="blank"/>
			</div>
		</div>
	<?php
	}
endif;


/* Generate category module */
if ( !function_exists( 'vce_generate_cats_module_field' ) ) :
function vce_generate_cats_module_field( $module, $i = false, $data ){
	
	extract( $data );
	
	$mod_id = ( $i === false ) ?  'vce-hidden-module-cat' : 'vce-hidden-module-'.$i;
	$name_prefix = ( $i === false ) ? '' :  'vce[modules]['.$i.']';
	$edit = ( $i === false ) ? '' :  'edit';

	?>

	<div id="<?php echo $mod_id; ?>" class="vce-hidden-module">
		<div class="vce-module-form <?php echo $edit; ?>">

			<ul class="vce-tabs-nav">
				<li class="active"><a href="#"><?php _e( 'Appearance', THEME_SLUG ); ?></a></li>
				<li><a href="#"><?php _e( 'Category selection', THEME_SLUG ); ?></a></li>
				<li><a href="#"><?php _e( 'Action', THEME_SLUG ); ?></a></li>
				<li class="save"><a class="vce-save-module button-primary" href="javascript:void(0);"><?php _e( 'Save Module', THEME_SLUG ); ?></a></li>
			</ul>

			<div class="vce-tabs-wrap">

			    <div class="vce-tab">
					<p>
						<strong><?php _e( 'Title', THEME_SLUG ); ?>:</strong><br/>
						<input class="vce-count-me" type="text" name="<?php echo $name_prefix; ?>[title]" value="<?php echo $module['title'];?>"/>
						&nbsp;<label><input type="checkbox" class="vce-count-me" name="<?php echo $name_prefix; ?>[hide_title]" value="1" <?php checked($module['hide_title'],1); ?>/><?php _e( 'Do not display publicly', THEME_SLUG ); ?></label> <br/>
						<small class="howto"><?php _e( 'Enter your module title', THEME_SLUG ); ?></small>
					</p>

					<p>
						<strong><?php _e( 'Title link', THEME_SLUG ); ?>:</strong><br/>
						<input class="vce-count-me" type="text" name="<?php echo $name_prefix; ?>[title_link]" value="<?php echo esc_attr($module['title_link']);?>"/><br/>
						<small class="howto"><?php _e( 'Optionally, you can assign URL to title', THEME_SLUG ); ?></small>
					</p>

					<p><strong><?php _e( 'Choose layout', THEME_SLUG ); ?>:</strong></p>
				    <ul class="vce-img-select-wrap">
				  	<?php foreach ( $layouts as $id => $layout ): ?>
				  		<li>
				  			<?php $selected_class = vce_compare( $id, $module['layout'] ) ? ' selected': ''; ?>
				  			<img src="<?php echo $layout['img']; ?>" title="<?php echo $layout['title']; ?>" class="vce-img-select<?php echo $selected_class; ?>">
				  			<br/><span><?php echo $layout['title']; ?></span>
				  			<input type="radio" class="vce-hidden vce-count-me" name="<?php echo $name_prefix; ?>[layout]" value="<?php echo $id; ?>" <?php checked( $id, $module['layout'] );?>/> </label>

				  		</li>
				  	<?php endforeach; ?>
				    </ul>  	
				    <small class="howto"><?php _e( 'Choose your category layout', THEME_SLUG ); ?></small>
				    
				    <p>
				    	<input type="hidden" name="<?php echo esc_attr($name_prefix); ?>[display_count]" value="0" class="vce-count-me" />
				    	<label><input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[display_count]" value="1" <?php checked( $module['display_count'], 1 ); ?> class="vce-count-me vce-next-hide" /><strong><?php _e( 'Display posts count', THEME_SLUG ); ?>?</strong></label>
		   				
				    </p>

				    <p>
				    	<strong><?php _e( 'Count label', THEME_SLUG ); ?>:</strong><br/>
				    	<input type="text" name="<?php echo esc_attr($name_prefix); ?>[count_label]" value="<?php echo esc_attr($module['count_label']);?>" class="vce-count-me" />
				    </p>

				  	<p>
						<strong><?php _e( 'Custom CSS class', THEME_SLUG ); ?>:</strong><br/>
						<input class="vce-count-me" type="text" name="<?php echo $name_prefix; ?>[css_class]" value="<?php echo esc_attr($module['css_class']);?>"/><br/>
						<small class="howto"><?php _e( 'Specify class name for a possibility to apply custom styling to this module using CSS (i.e. my-custom-module)', THEME_SLUG ); ?></small>
					</p>

				</div> <!-- end tab -->
			
				<div class="vce-tab">

					<p>
						<strong><?php _e( 'Categories', THEME_SLUG ); ?>:</strong><br/>
							<?php $cats = vce_sort_option_items( $cats,  $module['cat']); ?>
							<ul class="vce-sortable-items">
						   		<?php foreach ( $cats as $cat ) : ?>
						   			<?php $checked = in_array( $cat->term_id, $module['cat'] ) ? 'checked="checked"' : ''; ?>
						   			<li>
						   				<label>
						   					<input class="vce-count-me" type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[cat][]" value="<?php echo esc_attr($cat->term_id); ?>" <?php echo esc_attr($checked); ?> /><?php echo $cat->name;?>
						   				</label>
						   			</li>
						   		<?php endforeach; ?>
							</ul>
							<br/>
							<small class="howto"><?php _e( 'Note: You can reorder categories, just click hold and drag it up or down.', THEME_SLUG ); ?></small>
					</p>

				</div> <!-- end tab -->

				<div class="vce-tab">
	   				<p><strong><?php _e( 'Choose additional options', THEME_SLUG ); ?>:</strong><br/>
			   		<?php foreach ( $actions as $id => $title ) : ?>
			   		<label><input type="radio" name="<?php echo $name_prefix; ?>[action]" value="<?php echo $id; ?>" <?php checked( $module['action'], $id ); ?> class="vce-count-me vce-action-pick" /><?php echo $title;?></label><br/>
			   		<?php endforeach; ?>
			   		</p>

			   		<?php $style = vce_compare( $module['action'], 'slider' ) ?  '' : 'style="display:none"'; ?>
			   		<div class="vce-slider-wrap hideable" <?php echo $style; ?>>
			   			<p><strong><?php _e( 'Autoplay slider posts', THEME_SLUG ); ?>:</strong><br/>
			   			<input type="text" name="<?php echo $name_prefix; ?>[autoplay]" value="<?php echo esc_attr( $module['autoplay'] ); ?>" class="vce-count-me"/>
			   			<br/>
			   			<small class="howto"><?php _e( 'Specify number of seconds if you want to auto-slide posts, or leave empty for no autoplay', THEME_SLUG ); ?></small>
			   			</p>
			   		</div>

	   			</div> <!-- end tab -->

			</div> <!-- end wrap -->

			<input type="hidden" class="vce-deactivate" name="<?php echo $name_prefix; ?>[active]" value="<?php echo esc_attr($module['active']); ?>">
	   		<input class="vce-count-me" type="hidden" name="<?php echo $name_prefix; ?>[type]" value="category" />

		</div> <!-- end form -->
	</div> <!-- end module -->
<?php }
endif;




/* Get module actions */
if ( !function_exists( 'vce_get_module_actions' ) ):
	function vce_get_module_actions( $exclude = array() ) {
		$actions = array(
			'0' => __( 'None', THEME_SLUG ),
			'slider' => __( 'Apply slider', THEME_SLUG ),
			'pagination' => __( 'Add pagination', THEME_SLUG ),
			'link' => __( 'Add action link', THEME_SLUG )
		);

		if ( !empty($exclude) ) {
			foreach ($exclude as $action) {
				if(array_key_exists($action, $actions)){
					unset($actions[$action]);
				}
			}
		}
		return $actions;
	}
endif;

/* Parse arguments and returns posts for specific module */
if ( !function_exists( 'vce_get_module_query' ) ):
	function vce_get_module_query( $args = array(), $apply_paged = false ) {

		if ( $args['type'] == 'blank' )
			return false;

		global $vce_fa_home_posts, $vce_modules_exclude;

		$defaults = array(
			'order' => 'date',
			'sort'	=> 'DESC',
			'limit' => 4,
			'cat' => array(),
			'cat_child' => 0,
			'cat_inc_exc' => 'in',
			'manual' => array(),
			'tag' => '',
			'tag_inc_exc' => 'in',
			'author' => array(),
			'author_inc_exc' => 'in',
			'exclude_by_id' => array(),
			'exclude' => 0,
			'time' => 0,
			'timeto' => 0
		);

		$args = wp_parse_args( (array) $args, $defaults );

		if ( $args['curr_page'] > 1 && !$apply_paged && empty( $args['exclude'] ) ) {
			return false; //do not need to run query if "do not duplicate" option is not set
		}

		$q_args['post_type'] = 'post';
		$q_args['ignore_sticky_posts'] = 1;
		global $paged;
		if ( $apply_paged ) {
			$q_args['paged'] = $apply_paged;
			$paged = $apply_paged;
		} else {
			$q_args['paged'] = 1;
			$paged = 1;
		}


		if ( isset( $vce_fa_home_posts ) && !empty( $vce_fa_home_posts ) ) {
			$q_args['post__not_in'] = $vce_fa_home_posts;
		}

		if ( isset( $vce_modules_exclude ) && !empty( $vce_modules_exclude ) ) {
			if ( !isset( $q_args['post__not_in'] ) ) {
				$q_args['post__not_in'] = array();
			}
			foreach ( $vce_modules_exclude as $ex ) {
				if ( !in_array( $ex, $q_args['post__not_in'] ) ) {
					$q_args['post__not_in'][] = $ex;
				}
			}
		}

		if ( !empty( $args['manual'] ) ) {

			$q_args['posts_per_page'] = absint( count( $args['manual'] ) );
			$q_args['orderby'] =  'post__in';
			$q_args['post__in'] =  $args['manual'];
			$q_args['post_type'] = array_keys( get_post_types( array( 'public' => true ) ) ); //support all existing public post types

		} else {

			$q_args['posts_per_page'] = absint( $args['limit'] );

			if(!empty($args['exclude_by_id'])){

				if ( !empty( $q_args['post__not_in'] ) ) {
					$q_args['post__not_in'] = array_unique( array_merge( $q_args['post__not_in'], $args['exclude_by_id']) ) ;	
				} else {
					$q_args['post__not_in'] = $args['exclude_by_id'];
				}
			}

			if ( !empty( $args['cat'] ) ) {

				if ( $args['cat_child'] ) {
					$child_cat_temp = array();
					foreach ( $args['cat'] as $parent ) {
						$child_cats = get_categories( array( 'child_of' => $parent ) );
						if ( !empty( $child_cats ) ) {
							foreach ( $child_cats as $child ) {
								$child_cat_temp[] = $child->term_id;
							}
						}
					}
					$args['cat'] = array_merge( $args['cat'], $child_cat_temp );
				}

				$q_args['category__'.$args['cat_inc_exc']] = $args['cat'];
			}
			
			if ( !empty( $args['author'] ) ) {
				$q_args['author__'.$args['author_inc_exc']] = $args['author'];
			}

			$q_args['orderby'] = $args['order'];
			
			if ( $q_args['orderby'] == 'views' && function_exists( 'ev_get_meta_key' ) ) {

				$q_args['orderby'] = 'meta_value_num';
				$q_args['meta_key'] = ev_get_meta_key();

			} else if ( strpos( $q_args['orderby'], 'reviews' ) !== false && vce_is_wp_review_active() ) {
				
				if ( strpos( $q_args['orderby'], 'user' ) !== false ) {
					
					$review_type = substr( $q_args['orderby'], 13, strlen( $q_args['orderby'] ) );

					$q_args['orderby'] = 'meta_value_num';
					$q_args['meta_key'] = 'wp_review_user_reviews';

					$q_args['meta_query'] = array(
						array(
							'key'     => 'wp_review_user_review_type',
							'value'   => $review_type,
						)
					);

				} else {

					$review_type = substr( $q_args['orderby'], 8, strlen( $q_args['orderby'] ) );

					$q_args['orderby'] = 'meta_value_num';
					$q_args['meta_key'] = 'wp_review_total';

					$q_args['meta_query'] = array(
						array(
							'key'     => 'wp_review_type',
							'value'   => $review_type,
						)
					);
				}

			}
			
			if ( $q_args['orderby'] == 'comments_number' ) {
				$q_args['orderby'] = 'comment_count';
			}

			$q_args['order'] = $args['sort'];


			$date_query = array();

			if ( $time_diff = $args['time'] ) {

				$date_query[0]['after'] = date( 'Y-m-d', vce_calculate_time_diff( $time_diff ) );
			}

			if ( $time_diff = $args['timeto'] ) {

				$date_query[0]['before'] = date( 'Y-m-d', vce_calculate_time_diff( $time_diff ) );
			} 

			if(!empty($date_query)){
				$q_args['date_query'] = $date_query;
			}

			if ( !empty( $args['tag'] ) ) {
				$q_args['tag__'.$args['tag_inc_exc']] = vce_get_tax_term_id_by_slug( explode(",",$args['tag']));
			}

		}

		$query = new WP_Query( $q_args );

		if ( $args['exclude'] && !is_wp_error( $query ) && !empty( $query ) ) {

			foreach ( $query->posts as $p ) {
				$vce_modules_exclude[] = $p->ID;
			}

		}

		return $query;

	}
endif;


/* Parse arguments and returns CPT posts for module */
if ( !function_exists( 'vce_get_module_query_cpt' ) ):
	function vce_get_module_query_cpt( $args = array(), $apply_paged = false ) {

		if ( $args['type'] == 'blank' )
			return false;

		global $vce_fa_home_posts, $vce_modules_exclude;

		$defaults = array(
			'order' => 'date',
			'sort'	=> 'DESC',
			'limit' => 4,
			'manual' => array(),
			'author' => array(),
			'author_inc_exc' => 'in',
			'exclude_by_id' => array(),
			'exclude' => 0,
			'time' => 0,
			'timeto' => 0,
			'tax' => array(),
		);

		$args = wp_parse_args( (array) $args, $defaults );

		if ( $args['curr_page'] > 1 && !$apply_paged && empty( $args['exclude'] ) ) {
			return false; //do not need to run query if "do not duplicate" option is not set
		}

		$q_args['post_type'] = $args['type'];
		$q_args['ignore_sticky_posts'] = 1;
		global $paged;
		if ( $apply_paged ) {
			$q_args['paged'] = $apply_paged;
			$paged = $apply_paged;
		} else {
			$q_args['paged'] = 1;
			$paged = 1;
		}


		if ( isset( $vce_fa_home_posts ) && !empty( $vce_fa_home_posts ) ) {
			$q_args['post__not_in'] = $vce_fa_home_posts;
		}

		if ( isset( $vce_modules_exclude ) && !empty( $vce_modules_exclude ) ) {
			if ( !isset( $q_args['post__not_in'] ) ) {
				$q_args['post__not_in'] = array();
			}
			foreach ( $vce_modules_exclude as $ex ) {
				if ( !in_array( $ex, $q_args['post__not_in'] ) ) {
					$q_args['post__not_in'][] = $ex;
				}
			}
		}

		if ( !empty( $args['manual'] ) ) {

			$q_args['posts_per_page'] = absint( count( $args['manual'] ) );
			$q_args['orderby'] =  'post__in';
			$q_args['post__in'] =  $args['manual'];
			$q_args['post_type'] = array_keys( get_post_types( array( 'public' => true ) ) ); //support all existing public post types

		} else {

			$q_args['posts_per_page'] = absint( $args['limit'] );

			if(!empty($args['exclude_by_id'])){

				if ( !empty( $q_args['post__not_in'] ) ) {
					$q_args['post__not_in'] = array_unique( array_merge( $q_args['post__not_in'], $args['exclude_by_id']) ) ;	
				} else {
					$q_args['post__not_in'] = $args['exclude_by_id'];
				}
			}

			if ( !empty( $args['tax'] ) ) {
				$taxonomies = array();
				foreach ( $args['tax'] as $k => $v ) {

					$temp = array();
					if( !empty($v) ) {
						$temp['fields'] = 'id';
						$temp['taxonomy'] = $k;
						$temp['terms'] = $v;
						$taxonomies[] = $temp;
					}
				}

				$q_args['tax_query'] = $taxonomies;
			}
			
			if ( !empty( $args['author'] ) ) {
				$q_args['author__'.$args['author_inc_exc']] = $args['author'];
			}

			$q_args['orderby'] = $args['order'];
			
			if ( $q_args['orderby'] == 'views' && function_exists( 'ev_get_meta_key' ) ) {

				$q_args['orderby'] = 'meta_value_num';
				$q_args['meta_key'] = ev_get_meta_key();

			} else if ( strpos( $q_args['orderby'], 'reviews' ) !== false && vce_is_wp_review_active() ) {
				
				if ( strpos( $q_args['orderby'], 'user' ) !== false ) {
					
					$review_type = substr( $q_args['orderby'], 13, strlen( $q_args['orderby'] ) );

					$q_args['orderby'] = 'meta_value_num';
					$q_args['meta_key'] = 'wp_review_user_reviews';

					$q_args['meta_query'] = array(
						array(
							'key'     => 'wp_review_user_review_type',
							'value'   => $review_type,
						)
					);

				} else {

					$review_type = substr( $q_args['orderby'], 8, strlen( $q_args['orderby'] ) );

					$q_args['orderby'] = 'meta_value_num';
					$q_args['meta_key'] = 'wp_review_total';

					$q_args['meta_query'] = array(
						array(
							'key'     => 'wp_review_type',
							'value'   => $review_type,
						)
					);
				}

			}
			
			if ( $q_args['orderby'] == 'comments_number' ) {
				$q_args['orderby'] = 'comment_count';
			}

			$q_args['order'] = $args['sort'];

			$date_query = array();

			if ( $time_diff = $args['time'] ) {

				$date_query[0]['after'] = date( 'Y-m-d', vce_calculate_time_diff( $time_diff ) );
			}

			if ( $time_diff = $args['timeto'] ) {

				$date_query[0]['before'] = date( 'Y-m-d', vce_calculate_time_diff( $time_diff ) );
			} 

			if(!empty($date_query)){
				$q_args['date_query'] = $date_query;
			}

		}
		

		$query = new WP_Query( $q_args );

		if ( $args['exclude'] && !is_wp_error( $query ) && !empty( $query ) ) {

			foreach ( $query->posts as $p ) {
				$vce_modules_exclude[] = $p->ID;
			}

		}

		return $query;

	}
endif;




/* Define type of a module */
if ( !function_exists( 'vce_define_module_type' ) ):
	function vce_define_module_type( $mod ) {

		if ( !isset( $mod['type'] ) || empty( $mod['type'] ) ) {
			$mod['type'] = 'posts';
		}

		if ( !isset( $mod['active'] ) ) {
			$mod['active'] = 1;
		}

		return $mod;
	}
endif;

/* Creates category color bar on module top */
if ( !function_exists( 'vce_get_cat_class' ) ):
	function vce_get_cat_class( $mod ) {

		if ( $mod['type'] == 'posts' && isset( $mod['cat'] ) && !empty( $mod['cat'] ) && empty( $mod['manual'] ) ) {
			return 'cat-'.$mod['cat'][0];
		}

		return '';
	}
endif;



/* Wrap posts if layouts are combined or if slider is used */
if ( !function_exists( 'vce_loop_wrap_div' ) ):
	function vce_loop_wrap_div( $mod, $i, $real_count ) {

		$slider_allow = ( !$mod['top_layout'] && $real_count > 1 ) || ( $mod['top_layout'] && $real_count > $mod['top_limit'] + 1 ) ? true : false;

		if ( $real_count < ( $mod['top_limit'] + 1 ) ) {
			$mod['top_layout'] = 0;
		}

		if ( ( $mod['top_layout'] && $i == ( $mod['top_limit'] + 1 ) ) || ( !$mod['top_layout'] && $i == 1 ) ) {
			if ( isset( $mod['action'] ) && $mod['action'] == 'slider' && $slider_allow ) {
				$slider_class = ' vce-slider-pagination vce-slider-'.$mod['layout'];
				if ( isset( $mod['autoplay'] ) && !empty( $mod['autoplay'] ) ) {
					$autoplay = 'data-autoplay="'.( absint( $mod['autoplay'] )*1000 ).'"';
				} else {
					$autoplay = '';
				}

			} else {
				$slider_class = ''; $autoplay = '';
			}
			return '<div class="vce-loop-wrap'.$slider_class.'" '.$autoplay.'>';
		}

		return '';
	}
endif;

/* Check which layout to display when two layouts are combined */
if ( !function_exists( 'vce_module_layout' ) ):
	function vce_module_layout( $mod, $i ) {

		$layout = $mod['top_layout'] && $i <= $mod['top_limit'] ? $mod['top_layout'] : $mod['layout'];

		return $layout;
	}
endif;


/* Check whether to remove padding in module (for layout A and G) */
if ( !function_exists( 'vce_get_mainbox_class' ) ):
	function vce_get_mainbox_class( $mod ) {

		if ( $mod['type'] == 'blank' )
			return '';

		$class = array();

		if ( in_array( $mod['layout'], array( 'a', 'g' ) ) && $mod['limit'] == 1 ) {
			$class[] = 'main-box-nopad';
		}

		if ( !empty( $class ) ) {
			return implode( " ", $class );
		}

		return '';
	}
endif;

/* Check if module is one-column */
if ( !function_exists( 'vce_get_column_class' ) ):
	function vce_get_column_class( $mod ) {

		$class = array();

		if ( isset( $mod['one_column'] ) && !empty( $mod['one_column'] ) ) {
			$class[] = 'main-box-half';
		}

		if ( !empty( $class ) ) {
			return implode( " ", $class );
		}

		return '';
	}
endif;

/* Check whether to open div wrapper for one-columned modules*/
if ( !function_exists( 'vce_open_column_wrap' ) ):
	function vce_open_column_wrap( $mod ) {
		global $vce_module_column_flag;

		if ( empty( $vce_module_column_flag ) && isset( $mod['one_column'] ) && !empty( $mod['one_column'] ) && vce_allow_onecolumn_module( $mod ) ) {

			$vce_module_column_flag = 1;
			return '<div class="vce-module-columns">';

		}

		return '';

	}
endif;

/* Check whether to close div wrapper for one-columned modules */
if ( !function_exists( 'vce_close_column_wrap' ) ):
	function vce_close_column_wrap( $modules, $k ) {
		global $vce_module_column_flag;
		if ( !empty( $vce_module_column_flag ) ) {
			if ( !isset( $modules[$k+1] ) || !isset( $modules[$k+1]['one_column'] ) || ( isset( $modules[$k+1]['one_column'] ) && ( !vce_allow_onecolumn_module( $modules[$k+1] ) ) ) ) {
				$vce_module_column_flag = 0;
				return '</div>';
			}
		}

		return '';

	}
endif;

/* Check if module is allowed to be one-column */
if ( !function_exists( 'vce_allow_onecolumn_module' ) ):
	function vce_allow_onecolumn_module( $mod ) {
		global $vce_module_column_flag;

		
		if( !isset($mod['type']) ){ 
			$mod['type'] = 'posts'; 
		}
		
		if ( $mod['type'] == 'blank' || ( in_array( $mod['layout'], array( 'c', 'd', 'f', 'h' ) ) && in_array( $mod['top_layout'], array( '0', 'c', 'd', 'f', 'h' ) ) ) ) {
			return true;
		}
		return false;

	}
endif;

/* Check if module has additional actions */
if ( !function_exists( 'vce_check_module_action' ) ):
	function vce_check_module_action( $modules, $k ) {

		$output = '';

		if ( !empty( $modules[$k]['action'] ) ) {
			switch ( $modules[$k]['action'] ) {
			case 'slider':
				break;
			case 'pagination':
				if ( $k == ( count( $modules ) -1 ) ) {
					ob_start();
					get_template_part( 'sections/pagination/'.$modules[$k]['pagination'] );
					$output = ob_get_contents();
					ob_end_clean();
				}
				break;
			case 'link':
				$output.= '<div id="vce-pagination"><a class="vce-button vce-action-link" href="'.esc_url( $modules[$k]['action_link_url'] ).'">'.esc_html( $modules[$k]['action_link_text'] ).'</a></div>';
				break;
			default:
				break;
			}
		}

		if ( !empty( $output ) ) {
			return $output;
		}
		return '';

	}
endif;

/* Get module title */
if ( !function_exists( 'vce_get_module_title' ) ):
	function vce_get_module_title( $module) {
		
		$output = '';
		
		if(!empty($module['title'])){
			
			$output = esc_html( $module['title'] );

			if(isset($module['title_link']) && !empty($module['title_link'])){
				$output = '<a href="'.esc_url($module['title_link']).'">'.$output.'</a>';
			}
		
		}

		return $output;

	}
endif;

/* Check if module have a custom class */
if ( !function_exists( 'vce_get_module_css_class' ) ):
	function vce_get_module_css_class( $module) {
		
		if(isset($module['css_class']) && !empty($module['css_class'])){
			return esc_attr($module['css_class']);
		}

		return '';

	}
endif;

