<?php
/**
 * The sidebar containing the widget area for WordPress blog posts and pages.
 *
 * @package WordPress
 * @subpackage Boss
 * @since Boss 1.0.0
 */
?>
	
<!-- default WordPress sidebar -->
<div id="secondary" class="widget-area" role="complementary">
	<?php 
	if (function_exists('is_shop') && is_shop()) {
		if (is_active_sidebar('woo_sidebar')):
            dynamic_sidebar('woo_sidebar');
        endif;
	} else {
		if (function_exists('is_shop') && !is_shop()) {
			return;
		}
		if ( is_active_sidebar('sidebar') ) : 
			dynamic_sidebar( 'sidebar' );
		endif; 
	} ?>
</div><!-- #secondary -->
