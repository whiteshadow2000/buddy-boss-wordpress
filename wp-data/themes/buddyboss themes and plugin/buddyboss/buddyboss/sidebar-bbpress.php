<?php
/**
 * The sidebar containing the bbPress widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage BuddyBoss
 * @since BuddyBoss 3.0
 */
?>
	
	<!-- if there are widgets in the Forums sidebar -->	
	<?php if ( is_active_sidebar('forums') ) : ?>
	
			<div id="secondary" class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'forums' ); ?>
			</div><!-- #secondary -->
			
	<?php endif; ?>