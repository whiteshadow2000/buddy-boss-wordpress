<?php
/**
 * The sidebar containing the widget area for the homepage left column.
 *
 * If no active widgets in sidebar, let's hide it completely.
 * 
 * @package WordPress
 * @subpackage BuddyBoss
 * @since BuddyBoss 3.0
 */
?>

<!-- Homepage Left Sidebar -->
<div id="secondary" class="widget-area left-widget-area" role="complementary">
	<?php if ( is_active_sidebar('home-left') ) : ?>
		<?php dynamic_sidebar( 'home-left' ); ?>
	<?php endif; ?>
</div><!-- #secondary -->