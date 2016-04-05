<?php
/**
 * The sidebar containing the widget area for WordPress blog posts and pages.
 *
 * @package WordPress
 * @subpackage BuddyBoss
 * @since BuddyBoss 3.0
 */
?>
	
<!-- default WordPress sidebar -->
<div id="secondary" class="widget-area" role="complementary">
	<?php if ( is_active_sidebar('sidebar') ) : ?>
		<?php dynamic_sidebar( 'sidebar' ); ?>
	<?php endif; ?>
</div><!-- #secondary -->