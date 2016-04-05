<?php

/**
 * BuddyPress - User Header
 *
 * @package BuddyPress
 * @subpackage BuddyBoss
 */

?>

<?php do_action( 'bp_before_member_header' ); ?>

<div id="item-header-avatar">
	<a href="<?php bp_displayed_user_link(); ?>">

		<?php bp_displayed_user_avatar( 'type=full' ); ?>

	</a>
</div><!-- #item-header-avatar -->

<div id="item-header-content">
	
	<h2 class="user-nicename">@<?php bp_displayed_user_username(); ?></h2>
	<span class="activity"><?php bp_last_activity( bp_displayed_user_id() ); ?></span>

	<?php do_action( 'bp_before_member_header_meta' ); ?>    

</div><!-- #item-header-content -->

<div id="item-buttons" class="profile">

	<?php do_action( 'bp_member_header_actions' ); ?>

</div><!-- #item-buttons -->

<?php
/***
 * If you'd like to show specific profile fields here use:
 * bp_member_profile_data( 'field=About Me' ); -- Pass the name of the field
 */
 do_action( 'bp_profile_header_meta' );

 ?>

<?php do_action( 'bp_after_member_header' ); ?>

<?php do_action( 'template_notices' ); ?>
