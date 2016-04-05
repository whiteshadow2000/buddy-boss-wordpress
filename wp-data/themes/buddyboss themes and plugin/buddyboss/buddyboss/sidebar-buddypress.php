<?php
/**
 * The sidebar containing the BuddyPress widget areas.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage BuddyBoss
 * @since BuddyBoss 3.0
 */
?>
	
	<!-- Check if BuddyPress is activated -->
	<?php if ( function_exists('bp_is_active') ) : ?>

		<!-- if there are widgets in the Members: Directory sidebar -->	
		<?php if ( is_active_sidebar('members') && bp_is_current_component( 'members' ) && !bp_is_user() ) : ?>
					
				<div id="secondary" class="widget-area" role="complementary">				
					<?php dynamic_sidebar( 'members' ); ?>
				</div><!-- #secondary -->

		<!-- if there are widgets in the Member: Single Profile sidebar -->
		<?php elseif ( is_active_sidebar('profile') && bp_is_user() ) : ?>
		
				<div id="secondary" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'profile' ); ?>
				</div><!-- #secondary -->
		
		<!-- if there are widgets in the Groups: Directory sidebar -->		
		<?php elseif ( is_active_sidebar('groups') && bp_is_current_component( 'groups' ) && !bp_is_group() && !bp_is_user() ) : ?>
		
				<div id="secondary" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'groups' ); ?>
				</div><!-- #secondary -->

		<!-- if there are widgets in the Group: Single sidebar -->		
		<?php elseif ( is_active_sidebar('group') && bp_is_group() ) : ?>
		
				<div id="secondary" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'group' ); ?>
				</div><!-- #secondary -->	
		
		<!-- if there are widgets in the Activity: Directory sidebar -->		
		<?php elseif ( is_active_sidebar('activity') && bp_is_current_component( 'activity' ) && !bp_is_user() ) : ?>
			
				<div id="secondary" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'activity' ); ?>
				</div><!-- #secondary -->	
		
		<!-- if Multisite is activated AND there are widgets in the Blogs: Directory sidebar -->	
		<?php elseif ( is_active_sidebar('blogs') && is_multisite() && bp_is_current_component( 'blogs' ) && !bp_is_user() ) : ?>
		
				<div id="secondary" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'blogs' ); ?>
				</div><!-- #secondary -->

		<!-- if Legacy Forums (not bbPress) are activated AND there are widgets in the Forums: Directory sidebar -->	
		<?php elseif ( is_active_sidebar('forums') && bp_is_current_component( 'forums' ) && !bp_is_user() ) : ?>
		
				<div id="secondary" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'forums' ); ?>
				</div><!-- #secondary -->
			
		<!-- otherwise, no sidebar! -->
		
		<?php endif; ?>

	<?php endif; ?>