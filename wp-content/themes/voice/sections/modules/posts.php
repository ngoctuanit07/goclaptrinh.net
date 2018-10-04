<?php $mod =  wp_parse_args( (array) $mod, vce_get_module_defaults_posts() ); ?>

<?php $wp_query = vce_get_module_query( $mod, $apply_paged ); ?>
<?php echo vce_open_column_wrap($mod); ?>

	<div id="main-box-<?php echo ($k+1); ?>" class="main-box vce-border-top <?php echo vce_get_column_class($mod); ?> <?php echo esc_attr(vce_get_module_css_class($mod)); ?>">
	<?php if(!empty($mod['title']) && empty($mod['hide_title'])): ?>
		<h3 class="main-box-title <?php echo vce_get_cat_class( $mod ); ?>"><?php echo vce_get_module_title($mod); ?></h3>
	<?php endif; ?>
		<div class="main-box-inside <?php echo vce_get_mainbox_class( $mod ); ?>">

	<?php if ( have_posts() ) : ?>

		<?php $i = 0; while ( have_posts() ) : the_post(); $i++; ?>
			
			<?php echo vce_loop_wrap_div($mod, $i, count( $wp_query->posts ) ); ?>
			
			<?php get_template_part( 'sections/loops/layout-'.vce_module_layout($mod, $i) ); ?>
			
			<?php if ( $i == ( count( $wp_query->posts ) ) ) : ?>
				</div>
			<?php endif;?>

		<?php endwhile; ?>
		
		<?php  echo vce_check_module_action($modules, $k); ?>

	<?php else: ?>

		<?php if ( current_user_can( 'manage_options' ) ): ?>
			<p class="no-modules-msg"><?php printf( __( 'No posts match your criteria. Please choose different options in <a href="%s">Module Generator</a>.', THEME_SLUG ), admin_url( 'post.php?post='.get_the_ID().'&action=edit#vce_hp_modules' ) ); ?></p>
		<?php endif; ?>

	<?php endif; ?>

	<?php wp_reset_query(); ?>

		</div>
	</div>
<?php echo vce_close_column_wrap($modules, $k ); ?>