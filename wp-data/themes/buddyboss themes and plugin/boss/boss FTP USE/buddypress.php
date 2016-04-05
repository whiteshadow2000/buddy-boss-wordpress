<?php
/**
 * The template for displaying BuddyPress content.
 *
 * @package WordPress
 * @subpackage Boss
 * @since Boss 1.0.0
 */
get_header();

/**
 * Nodes Class as Per Requirements
 **/
$class = array();
if(bp_is_user()) { //profile network
	$class[] = "network-profile";
}
if(bp_displayed_user_id() == get_current_user_id()) { //profile personal
	$class[] = "my-profile";
}
if(bp_is_group()) { //single group
	$class[] = "group-single";
}

$class = implode(" ",$class);

?>

<?php
if(bp_is_group() && !bp_is_current_action( 'create' )) {
    do_action('boss_get_group_template');
	//get_template_part( 'buddypress', 'group-single' );
} else {
	get_template_part( 'buddypress', 'sidewide' );
}
?>

<?php get_footer(); ?>
