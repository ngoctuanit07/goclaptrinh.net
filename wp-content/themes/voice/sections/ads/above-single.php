<?php if( $ad = vce_get_option('ad_above_single') ): ?>
	<div class="vce-ad vce-ad-container"><?php echo do_shortcode( $ad ); ?></div>
<?php endif; ?>