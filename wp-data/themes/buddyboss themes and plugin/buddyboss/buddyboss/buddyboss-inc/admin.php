<?php

/* ADMIN OPTIONS */

/**
 * Add BuddyBoss to the Appearance menu
 */
function buddyboss_admin_menu()
{
	global $wp_admin_bar;

	add_theme_page( 'BuddyBoss Settings', 'BuddyBoss', 'manage_options', 'buddyboss_settings_menu', 'buddyboss_general_settings' );
}
add_action('admin_menu', 'buddyboss_admin_menu');

/**
 * General Settings Page
 */
function buddyboss_general_settings()
{

	// Hide BuddyPress dependant settings (Profile Walls and Photo Uploading) if BuddyPress is disabled
	$bp_is_enabled = function_exists( 'bp_is_active' );
	$bpenabledmessage = isset($_POST['value']) ? $_POST['value'] : '';
	$bpdisabledmessage = isset($_POST['value']) ? $_POST['value'] : '';
	
	if (function_exists('bp_is_active'))  $bpenabledmessage = '<div id="message" class="updated"><p>User Wall Posting is no longer included with the BuddyBoss theme. Please use the BuddyBoss Wall plugin instead.</p></div><div id="message" class="updated"><p>User Photo Uploading is no longer included with the BuddyBoss theme. Please use the BuddyBoss Media plugin instead.</p></div>';
	if (!function_exists('bp_is_active'))  $bpdisabledmessage = '<div id="message" class="updated"><p>Install and activate the <a href="'.admin_url().'/plugin-install.php?tab=search&type=term&s=buddypress&plugin-search-input=Search+Plugins">BuddyPress plugin</a> to enable social networking features.</p></div>';

	// Get the URL for the Appearance > Customize screen
	$customize_url = admin_url( 'customize.php' );

	// Get the URL for the Slides screen
	$slides_url = admin_url( 'edit.php?post_type=buddyboss_slides' );

	// Get the URL for the Settings > BuddyPress > Components screen
	$buddypress_components_url = admin_url( 'options-general.php?page=bp-components' );


	// Echo the HTML for the admin panel
	$html = <<<EOF

	<div class="wrap">

		<style type="text/css">
			.buddyboss_divider {
				width: 100%;
				height: 1px;
				line-height: 0;
				overflow: hidden;
				background: #ddd;
				margin: 20px 0 25px;
			}
		</style>

		<h2>BuddyBoss Theme Settings</h2>

		<div class="welcome-panel">
			<div class="welcome-panel-content">
				
				<h3>Welcome to BuddyBoss</h3>
				<p class="about-description">Thanks for purchasing BuddyBoss! Here are some links to get you started:</p>

				<div class="welcome-panel-column-container">

					<div class="welcome-panel-column">
						<h4>Get Started</h4>
						<a class="button button-primary button-hero" href="http://www.buddyboss.com/tutorials/buddyboss-setup/" target="_blank">Setup Instructions</a>
						<p><a href="http://www.buddyboss.com/affiliates/affiliate-program/" target="_blank">Earn money with our affiliate program!</a></p>
					</div>


					<div class="welcome-panel-column welcome-panel-last">
						<h4>Need some help?</h4>
							<ul>
								<li><a href="http://www.buddyboss.com/faq/" target="_blank">Frequently Asked Questions</a></li>
								<li><a href="http://www.buddyboss.com/support-forums/" target="_blank">Support Forums</a></li>
								<li><a href="http://www.buddyboss.com/release-notes/" target="_blank">Current Version &amp; Release Notes</a></li>
								<li><a href="http://www.buddyboss.com/updating/" target="_blank">How to Update</a></li>
								<li><a href="http://www.buddyboss.com/child-themes/" target="_blank">Guide to Child Themes</a></li>
							</ul>
					</div>

				</div>

			</div>
		</div>

		<div class="buddyboss_divider"></div>

		<h3>Theme Customizations</h3>

		<p>
			To change the <strong>logo</strong>, <strong>colors</strong>, and <strong>fonts</strong> head over to <em><a href="$customize_url">Appearance &rarr; Customize</a></em>.
		</p>

		<div class="buddyboss_divider"></div>

		<h3>Homepage Slider</h3>

		<p>
			To add <strong>slides</strong> to your homepage, head over to the <em><a href="$slides_url">Slides</a> menu</em>.
		</p>

		<div class="buddyboss_divider"></div>

EOF;

	if ( $bp_is_enabled )
	{
		$html .= <<<EOF

		$bpenabledmessage

EOF;
	}

	$html .= <<<EOF

		$bpdisabledmessage

	</div><!-- end .wrap -->
	<div class="clear"></div>
EOF;
	echo $html;
}
?>