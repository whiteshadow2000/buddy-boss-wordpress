<?php
/**
 * @package BuddyBoss
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 625;

/**
 * Sets up theme defaults and registers the various WordPress features that BuddyBoss supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since BuddyBoss 1.0
 */
function buddyboss_setup()
{
	// Makes BuddyBoss available for translation.
	load_theme_textdomain( 'buddyboss', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Declare theme support for WooCommerce
	add_theme_support( 'woocommerce' );

	// Adds wp_nav_menu() in two locations with BuddyPress deactivated.
		register_nav_menus( array(
			'primary-menu'   => __( 'Primary Menu', 'buddyboss' ),
			'secondary-menu' => __( 'Footer Menu', 'buddyboss' ),
		) );

	// Adds wp_nav_menu() in two additional locations with BuddyPress activated.
	if ( function_exists('bp_is_active') ) {
		register_nav_menus( array(
			'profile-menu'   => __( 'Profile: Extra Links', 'buddyboss' ),
			'group-menu'     => __( 'Group: Extra Links', 'buddyboss' ),
		) );
	}


	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'buddyboss_setup' );


/**
 * Adds Profile menu to BuddyPress profiles
 *
 * @since BuddyBoss 3.1
 */
function buddyboss_add_profile_menu()
{
	if ( function_exists('bp_is_active') ) {
		if ( has_nav_menu( 'profile-menu' ) ) {
			wp_nav_menu( array( 'container' => false, 'theme_location' => 'profile-menu', 'items_wrap' => '%3$s' ) );
		}
	}
}
add_action( 'bp_member_options_nav', 'buddyboss_add_profile_menu');

/**
 * Adds Group menu to BuddyPress groups
 *
 * @since BuddyBoss 3.1
 */
function buddyboss_add_group_menu()
{
	if ( function_exists('bp_is_active') ) {
		if ( has_nav_menu( 'group-menu' ) ) {
			wp_nav_menu( array( 'container' => false, 'theme_location' => 'group-menu', 'items_wrap' => '%3$s' ) );
		}
	}
}
add_action( 'bp_group_options_nav', 'buddyboss_add_group_menu');


/**
 * Load custom fonts to be used in stylesheets
 *
 * Do not delete these font enqueues without also deleting their
 * dependencies found in the main stylesheet enqueues
 *
 * @since BuddyBoss 3.1
 */

function buddyboss_load_fonts()
{
	if ( !is_admin() ) {

        // FontAwesome icon fonts. If browsing on a secure connection, use HTTPS.
		wp_register_style('fontawesome', "//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css", false, null);
        wp_enqueue_style( 'fontawesome');

        // Dashicons icon fonts (packaged with WordPress 3.8+)
        wp_enqueue_style( 'dashicons' );

        // Google fonts. If browsing on a secure connection, use HTTPS.
        wp_register_style('googlefonts', "//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,700,600,300", false, null);
        wp_enqueue_style( 'googlefonts');

    }
}
add_action('wp_enqueue_scripts', 'buddyboss_load_fonts');


/**
 * Enqueues scripts and styles for front-end.
 *
 * @since BuddyBoss 1.0
 */
function buddyboss_scripts_styles()
{

	/****************************** SCRIPTS ******************************/

	global $bp, $buddyboss, $buddyboss_js_params;

	/*
	 * Modernizr
	 */
	wp_enqueue_script( 'buddyboss-modernizr', get_template_directory_uri() . '/js/modernizr.min.js', false, '2.7.1', false );

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/*
	 * Adds mobile JavaScript functionality.
	 */
	if ( ! is_admin() )
	{
		wp_enqueue_script( 'idangerous-swiper', get_template_directory_uri() . '/js/idangerous.swiper.js', array('jquery'), '1.9.2', true );
	}

	$user_profile = null;

	if ( is_object( $bp ) && is_object( $bp->displayed_user )
		   && ! empty( $bp->displayed_user->domain ) )
	{
		$user_profile = $bp->displayed_user->domain;
	}

	/*
	 * Adds fitVids script
	 */
	if ( !is_admin() ) {
		wp_enqueue_script( 'fitvids', get_template_directory_uri().'/js/fitvids.js', array( 'jquery' ), '1.1.0' );
	}
    
	/*
	 * Adds custom BuddyBoss JavaScript functionality.
	 */
	if ( !is_admin() ) {
		wp_enqueue_script( 'buddyboss-main', get_template_directory_uri().'/js/buddyboss.js', array( 'jquery' ), '4.2.1' );
	}

	// Add BuddyBoss words that we need to use in JS to the end of the page
	// so they can be translataed and still used.
	$buddyboss_js_vars = array(
		'select_label'        => __( 'Show:', 'buddyboss' ),
		'post_in_label'       => __( 'Post in:', 'buddyboss' ),
		'tpl_url'             => get_template_directory_uri(),
		'child_url'           => get_stylesheet_directory_uri(),
		'user_profile'        => $user_profile
	);

	$buddyboss_js_vars = apply_filters( 'buddyboss_js_vars', $buddyboss_js_vars );

	wp_localize_script( 'buddyboss-main', 'BuddyBossOptions', $buddyboss_js_vars );


	/**
	 * If we're on the BuddyPress messages component we need to load jQuery Migrate first
	 * before bgiframe, so let's take care of that
	 */
	if ( function_exists( 'bp_is_messages_component' ) && bp_is_messages_component() && bp_is_current_action( 'compose' ) )
	{
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_dequeue_script( 'bp-jquery-bgiframe' );
		wp_enqueue_script( 'bp-jquery-bgiframe', BP_PLUGIN_URL . "bp-messages/js/autocomplete/jquery.bgiframe{$min}.js", array(), bp_get_version() );
	}

	//Heartbeat
	wp_enqueue_script('heartbeat');

	/****************************** STYLES ******************************/


	// Main WordPress stylesheet
	if ( !is_admin() ) {
		// Activate our primary WordPress stylesheet. Load FontAwesome and GoogleFonts first.
		wp_enqueue_style( 'buddyboss-wp-frontend', get_template_directory_uri().'/css/wordpress.css', array( 'fontawesome', 'googlefonts' ), '4.2.1', 'all' );
	}

	/*
	* Load our BuddyPress styles manually if plugin is active.
	* We need to deregister the BuddyPress styles first then load our own.
	* We need to do this for proper CSS load order.
	*/
	if ( $buddyboss->buddypress_active && !is_admin() )
	{
		// Deregister the built-in BuddyPress stylesheet
		wp_deregister_style( 'bp-child-css' );
		wp_deregister_style( 'bp-parent-css' );
		wp_deregister_style( 'bp-legacy-css' );
		// Activate our own BuddyPress stylesheet. Load FontAwesome and GoogleFonts first.
		wp_enqueue_style( 'buddyboss-bp-frontend', get_template_directory_uri().'/css/buddypress.css', array( 'fontawesome', 'googlefonts' ), '4.2.1', 'all' );
	}

	/*
	* Load our bbPress styles manually if plugin is active.
	* We need to deregister the bbPress style first then load our own.
	* We need to do this for proper CSS load order.
	*/
	if ( $buddyboss->bbpress_active && !is_admin() )
	{
		// Deregister the built-in bbPress stylesheet
		wp_deregister_style( 'bbp-child-bbpress' );
		wp_deregister_style( 'bbp-parent-bbpress' );
		wp_deregister_style( 'bbp-default' );
		// Activate our own bbPress stylesheet. Load FontAwesome and GoogleFonts first.
		wp_enqueue_style( 'buddyboss-bbpress-frontend', get_template_directory_uri().'/css/bbpress.css', array( 'fontawesome', 'googlefonts' ), '4.2.0', 'all' );
	}

	// Load our CSS support for 3rd party plugins here.
	if ( !is_admin() ) {
		wp_enqueue_style( 'buddyboss-wp-plugins', get_template_directory_uri().'/css/plugins.css', array( 'fontawesome', 'googlefonts' ), '4.2.1', 'all' );
	}

	// Load our own adminbar (Toolbar) styles.
	if ( !is_admin() ) {
		// Deregister the built-in adminbar stylesheet
		wp_deregister_style( 'admin-bar' );
		// Activate our own mobile adminbar stylesheet. Load FontAwesome and GoogleFonts first.
		wp_enqueue_style( 'buddyboss-wp-adminbar-mobile', get_template_directory_uri().'/css/adminbar-mobile.css', array( 'fontawesome', 'googlefonts' ), '4.2.1', 'all' );
		// Activate our own Fixed or Floating (defaults to Fixed) adminbar stylesheet. Load DashIcons and GoogleFonts first.
		wp_enqueue_style( 'buddyboss-wp-adminbar-desktop-'.esc_attr( get_theme_mod( 'boss_adminbar_layout', 'fixed' ) ), get_template_directory_uri().'/css/adminbar-desktop-'.esc_attr( get_theme_mod( 'boss_adminbar_layout', 'fixed' ) ).'.css', array( 'dashicons', 'googlefonts' ), '4.2.0', 'all' );
	}

}
add_action( 'wp_enqueue_scripts', 'buddyboss_scripts_styles' );

/**
 * We need to enqueue jQuery migrate before anything else for legacy
 * plugin support.
 * WordPress version 3.9 onwards already includes jquery 1.11.n version, which we required,
 * and jquery migrate is also properly enqueued.
 * So we dont need to do anything for WP versions greater than 3.9.
 *
 * @package  BuddyPress
 * @since    BuddyPress 3.0
 */
function buddyboss_scripts_jquery_migrate()
{
	global $wp_version;
	if( $wp_version >= 3.9 ){
		return;
	}
	
	if ( !is_admin() ) {

		// Deregister the built-in version of jQuery
		wp_deregister_script( 'jquery' );
		// Register jQuery. If browsing on a secure connection, use HTTPS.
		wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js", false, null);

		// Activate the jQuery script
		wp_enqueue_script( 'jquery' );

		// Activate the jQuery Migrate script from WordPress
		wp_enqueue_script( 'jquery-migrate', false, array( 'jquery' ) );

	}
}
add_action( 'wp_enqueue_scripts', 'buddyboss_scripts_jquery_migrate', 0 );


/**
 * Removes CSS in the header so we can control the admin bar and be responsive
 *
 * @package  BuddyPress
 * @since    BuddyPress 3.1
 */
function buddyboss_remove_adminbar_inline_styles()
{
	if ( !is_admin() ) {

		remove_action( 'wp_head', 'wp_admin_bar_header' );
		remove_action( 'wp_head', '_admin_bar_bump_cb' );

	}
}
add_action( 'wp_head', 'buddyboss_remove_adminbar_inline_styles', 9 );


/**
 * JavaScript mobile init
 *
 * @package  BuddyPress
 * @since    BuddyPress 3.0
 */
function buddyboss_mobile_js_init()
{
?>
<!--
BuddyBoss Mobile Init
/////////////////////
-->
<div id="mobile-check"></div><!-- #mobile-check -->
<?php
}
add_action( 'buddyboss_before_header', 'buddyboss_mobile_js_init' );

/**
 * Dynamically removes the no-js class from the <body> element.
 *
 * By default, the no-js class is added to the body (see bp_dtheme_add_no_js_body_class()). The
 * JavaScript in this function is loaded into the <body> element immediately after the <body> tag
 * (note that it's hooked to bp_before_header), and uses JavaScript to switch the 'no-js' body class
 * to 'js'. If your theme has styles that should only apply for JavaScript-enabled users, apply them
 * to body.js.
 *
 * This technique is borrowed from WordPress, wp-admin/admin-header.php.
 *
 * @package BuddyPress
 * @since BuddyPress (1.5).1
 * @see bp_dtheme_add_nojs_body_class()
 */
function buddyboss_remove_nojs_body_class() {
?><script type="text/JavaScript">//<![CDATA[
(function(){var c=document.body.className;c=c.replace(/no-js/,'js');document.body.className=c;})();
$=jQuery.noConflict();
//]]></script>
<?php
}
add_action( 'buddyboss_before_header', 'buddyboss_remove_nojs_body_class' );

/**
 * Determines if the currently logged in user is an admin
 * TODO: This should check in a better way, by capability not role title and
 * this function probably belongs in a functions.php file or utility.php
 */
function buddyboss_is_admin()
{
	return is_user_logged_in() && current_user_can( 'administrator' );
}

function buddyboss_members_latest_update_filter( $latest )
{
	$latest = str_replace( array( '- &quot;', '&quot;' ), '', $latest );

	return $latest;
}
add_filter( 'bp_get_activity_latest_update_excerpt', 'buddyboss_members_latest_update_filter' );

/**
 * Moves sitewide notices to the header
 *
 * Since BuddyPress doesn't give us access to BP_Legacy, let
 * us begin the hacking
 *
 * @since BuddyBoss 3.0
 */
function buddyboss_fix_sitewide_notices()
{
	// Check if BP_Legacy is being used and messages are active
	if ( class_exists( 'BP_Legacy') && bp_is_active( 'messages' ) )
	{
		remove_action( 'wp_footer', array( 'BP_Legacy', 'sitewide_notices' ), 9999 );

		global $wp_filter;

		// Get the wp_footer callbacks
		$footer = ! empty( $wp_filter['wp_footer'] ) && is_array( $wp_filter['wp_footer'] )
						? $wp_filter['wp_footer']
						: false;

		// Make sure we have some
		if ( is_array( $footer ) && count( $footer ) > 0 )
		{
			$new_footer_cbs = array();

			// Cycle through each callback and remove any with sitewide_notices in it,
			// then replace and add to the header
			foreach ( $footer as $priority => $footer_cb )
			{
				if ( is_array( $footer_cb ) && !empty( $footer_cb ) )
				{
					$keys = array_keys( $footer_cb );
					$key = $keys[0];

					if ( stristr( $key, 'sitewide_notices' ) )
					{
						add_action( 'buddyboss_inside_wrapper', 'buddyboss_print_sitewide_notices', 9999 );
					}
					else {
						$new_footer_cbs[ $priority ] = $footer_cb;
					}
				}
				else {
					$new_footer_cbs[ $priority ] = $footer_cb;
				}
			}

			$wp_filter['wp_footer'] = $new_footer_cbs;
		}

	}
}
add_action( 'wp', 'buddyboss_fix_sitewide_notices' );

/**
 * Prints sitewide notices (used in the header, by default is in footer)
 */
function buddyboss_print_sitewide_notices()
{
	@BP_Legacy::sitewide_notices();
}

/**
 * Load admin bar in header (fixes JetPack chart issue)
 */
function buddyboss_admin_bar_in_header()
{
  if ( !is_admin() )
  {
    remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 );
    add_action( 'buddyboss_before_header', 'wp_admin_bar_render' );
  }
}
add_action( 'wp', 'buddyboss_admin_bar_in_header' );

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since BuddyBoss 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function buddyboss_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'buddyboss' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'buddyboss_wp_title', 10, 2 );

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since BuddyBoss 1.0
 */
function buddyboss_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'buddyboss_page_menu_args' );

/**
 * Registers all of our widget areas.
 *
 * @since BuddyBoss 3.0
 */
function buddyboss_widgets_init() {
	// Area 1, located in the pages and posts right column.
	register_sidebar( array(
			'name'          => 'Page &rarr; Right Sidebar (default)',
			'id'          	=> 'sidebar',
			'description'   => 'The default Page/Post widget area. Right column is always present.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );

	// Area 2, located in the pages and posts right column.
	register_sidebar( array(
			'name'          => 'Page &rarr; Left Sidebar',
			'id'          	=> 'sidebar-left',
			'description'   => 'The Left Sidebar template and Three Column template left widget area. Left column is always present.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );

	// Area 3, located in the homepage right column.
	register_sidebar( array(
			'name'          => 'Homepage &rarr; Right Sidebar',
			'id' 			=> 'home-right',
			'description'   => 'The Homepage Right widget area. Right column only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );

	// Area 4, located in the homepage left column.
	register_sidebar( array(
			'name'          => 'Homepage &rarr; Left Sidebar',
			'id' 			=> 'home-left',
			'description'   => 'The Homepage Left widget area. Left column only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );

	// Area 5, located in the Members Directory right column. Right column only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Members &rarr; Directory',
			'id'          	=> 'members',
			'description'   => 'The Members Directory widget area. Right column only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
	// Area 6, located in the Individual Member Profile right column. Right column only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Member &rarr; Single Profile',
			'id'          	=> 'profile',
			'description'   => 'The Individual Profile widget area. Right column only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
	// Area 7, located in the Groups Directory right column. Right column only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Groups &rarr; Directory',
			'id'          	=> 'groups',
			'description'   => 'The Groups Directory widget area. Right column only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
	// Area 8, located in the Individual Group right column. Right column only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Group &rarr; Single Group',
			'id'          	=> 'group',
			'description'   => 'The Individual Group widget area. Right column only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
	// Area 9, located in the Activity Directory right column. Right column only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Activity &rarr; Directory',
			'id'          	=> 'activity',
			'description'   => 'The Activity Directory widget area. Right column only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
	// Area 10, located in the Forums Directory right column. Right column only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Forums &rarr; Directory & Single',
			'id'          	=> 'forums',
			'description'   => 'The Forums Directory widget area. Right column only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
	// Area 11, located in the Members Directory right column. Right column only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Blogs &rarr; Directory (multisite)',
			'id'          	=> 'blogs',
			'description'   => 'The Blogs Directory widget area (only for Multisite). Right column only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
	// Area 12, located in the Footer column 1. Only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Footer #1',
			'id'          	=> 'footer-1',
			'description'   => 'The first footer widget area. Only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
		    'before_title'  => '<h4 class="widgettitle">',
		    'after_title'   => '</h4>'
		) );
	// Area 13, located in the Footer column 2. Only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Footer #2',
			'id'          	=> 'footer-2',
			'description'   => 'The second footer widget area. Only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
		    'before_title'  => '<h4 class="widgettitle">',
		    'after_title'   => '</h4>'
		) );
	// Area 14, located in the Footer column 3. Only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Footer #3',
			'id'          	=> 'footer-3',
			'description'   => 'The third footer widget area. Only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
		    'before_title'  => '<h4 class="widgettitle">',
		    'after_title'   => '</h4>'
		) );
	// Area 15, located in the Footer column 4. Only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Footer #4',
			'id'          	=> 'footer-4',
			'description'   => 'The fourth footer widget area. Only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
		    'before_title'  => '<h4 class="widgettitle">',
		    'after_title'   => '</h4>'
		) );
	// Area 16, located in the Footer column 5. Only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Footer #5',
			'id'          	=> 'footer-5',
			'description'   => 'The fifth footer widget area. Only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
		    'before_title'  => '<h4 class="widgettitle">',
		    'after_title'   => '</h4>'
		) );
}
add_action( 'widgets_init', 'buddyboss_widgets_init' );

if ( ! function_exists( 'buddyboss_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since BuddyBoss 1.0
 */
function buddyboss_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo esc_attr( $nav_id ); ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'buddyboss' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'buddyboss' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'buddyboss' ) ); ?></div>
		</nav><!-- #<?php echo esc_attr( $nav_id ); ?> .navigation -->
	<?php endif;
}
endif;

if ( ! function_exists( 'buddyboss_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own buddyboss_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Twelve 1.0
 */
function buddyboss_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'buddyboss' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'buddyboss' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'buddyboss' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'buddyboss' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'buddyboss' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php edit_comment_link( __( 'Edit', 'buddyboss' ), '<span class="edit-link">', '</span>' ); ?>
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'buddyboss' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'buddyboss_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own buddyboss_entry_meta() to override in a child theme.
 *
 * @since BuddyBoss 1.0
 */
function buddyboss_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'buddyboss' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'buddyboss' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'buddyboss' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( '%3$s <span class="by-author"> by %4$s</span>', 'buddyboss' );
	} elseif ( $categories_list ) {
		$utility_text = __( '%3$s <span class="by-author"> by %4$s</span>', 'buddyboss' );
	} else {
		$utility_text = __( '%3$s <span class="by-author"> by %4$s</span>', 'buddyboss' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
 * Extends the default WordPress body classes.
 *
 * @since BuddyBoss 1.0
 *
 * @param array Existing class values.
 * @return array Filtered class values.
 */
function buddyboss_body_class( $classes ) {
	global $wp_customize;

	if ( ! empty( $wp_customize ) ) {
	  $classes[] = 'wp-customizer';
	}
	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	if ( current_user_can('manage_options') )
	{
		$classes[] = 'role-admin';
	}

	if ( bp_is_user_activity() || ( bp_is_group_home() && bp_is_active( 'activity' ) )
			 || bp_is_group_activity() || bp_is_current_component( 'activity' ) )
	{
		$classes[] = 'has-activity';
	}

	return array_unique( $classes );
}
if(buddyboss_is_bp_active()){
	add_filter( 'body_class', 'buddyboss_body_class' );
}


/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since BuddyBoss 1.0
 */
function buddyboss_content_width() {
	if ( is_page_template( 'full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'buddyboss_content_width' );



/****************************** LOGIN FUNCTIONS ******************************/

function buddyboss_is_login_page()
{
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}
add_filter( 'login_redirect', 'buddyboss_redirect_previous_page', 10, 3 );


function buddyboss_redirect_previous_page( $redirect_to, $request, $user )
{
	if(buddyboss_is_bp_active()){
		$bp_pages = bp_get_option('bp-pages');

		$activate_page_id = ! empty( $bp_pages ) && isset( $bp_pages['activate'] )
											? $bp_pages['activate']
											: null;

		if ( (int)$activate_page_id <= 0 )
		{
			return $redirect_to;
		}

		$activate_page = get_post($activate_page_id);

		if ( empty( $activate_page ) || empty( $activate_page->post_name ) )
		{
			return $redirect_to;
		}

		$activate_page_slug = $activate_page->post_name;

		if (strpos($request,'/' . $activate_page_slug) !== false) {
			$redirect_to = home_url();
		}
	}

	$request = isset( $_SERVER["HTTP_REFERER"] ) && ! empty( $_SERVER["HTTP_REFERER"] )
					 ? $_SERVER["HTTP_REFERER"]
					 : false;

	if ( ! $request )
	{
		return $redirect_to;
	}

	$req_parts = explode( '/', $request );
	$req_part = array_pop( $req_parts );

	if ( substr( $req_part, 0, 3 ) == 'wp-' )
	{
		return $redirect_to;
	}

	$request = str_replace( array( '?loggedout=true', '&loggedout=true' ), '', $request );

  return $request;
}


/**
 * Custom Login Logo
 *
 * @since BuddyBoss 1.0
 */

function buddyboss_custom_login_logo()
{
    $logo = get_theme_mod( 'buddyboss_logo', FALSE );
	
	/*convert from relative url to absolute url*/
	$scheme = is_ssl() ? 'https://' : 'http://';
	$logo_absolute_url = $scheme . @$_SERVER['HTTP_HOST'] . $logo;

    if ( $logo ) {
        if ( !0 ) {
            list( $width, $height ) = getimagesize( $logo_absolute_url );
            echo '<style type="text/css">
                    #login h1 a {
                        background-image: url('.esc_url($logo).');
                        background-size: '.intval($width).'px '.intval($height).'px !important;
                        min-height: 87px;
                        width: '.intval($width).'px;
                        height: '.intval($height).'px;
                        overflow: hidden;
                    }
                    body.login {
                        background: #fff !important;
                    }
                    .login form {
                        -webkit-box-shadow: 0 1px 3px rgba(0,0,0,.3);
                        -moz-box-shadow: 0 1px 3px rgba(0,0,0,.3);
                        box-shadow: 0 1px 3px rgba(0,0,0,.3);
                    }
                </style>';
        }
    }
}
add_action( 'login_head', 'buddyboss_custom_login_logo' );


/**
 * Custom Login Link
 *
 * @since BuddyBoss 1.0.8
 */

function change_wp_login_url()
{
	return home_url();
}
function change_wp_login_title()
{
	get_option('blogname');
}
add_filter( 'login_headerurl', 'change_wp_login_url' );
add_filter( 'login_headertitle', 'change_wp_login_title' );




/****************************** ADMIN BAR FUNCTIONS ******************************/

/**
 * Remove certain admin bar links
 *
 * @since BuddyBoss 2.1
 */
function remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');

	if (!current_user_can('administrator')):
		$wp_admin_bar->remove_menu('site-name');
	endif;
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );


/**
 * Replace admin bar "Howdy" text
 *
 * @since BuddyBoss 2.1.1
 */
function replace_howdy( $wp_admin_bar ) {

	if ( is_user_logged_in() ) {

	    $my_account=$wp_admin_bar->get_node('my-account');
	    $newtitle = str_replace( 'Howdy,', '', $my_account->title );
	    $wp_admin_bar->add_node( array(
	        'id' => 'my-account',
	        'title' => $newtitle,
	    ) );

	}
}
add_filter( 'admin_bar_menu', 'replace_howdy',25 );


/****************************** AVATAR FUNCTIONS ******************************/


/**
 * Replace default member avatar
 *
 * @since BuddyBoss 2.0
 */
if ( !function_exists('buddyboss_addgravatar') ) {
	function buddyboss_addgravatar( $avatar_defaults ) {
		$myavatar = get_stylesheet_directory_uri() . '/images/avatar-member.jpg';
		$avatar_defaults[$myavatar] = 'BuddyBoss Man';
		return $avatar_defaults;
	}
	add_filter( 'avatar_defaults', 'buddyboss_addgravatar' );
}


/**
 * Replace default group avatar
 *
 * @since BuddyBoss 1.0
 */
function buddyboss_default_group_avatar($avatar)
{
	global $bp, $groups_template;
	if ( strpos($avatar,'group-avatars') )
	{
		return $avatar;
	}
	else {
		$custom_avatar = get_stylesheet_directory_uri() .'/images/avatar-group.jpg';

		if ( $bp->current_action == "" )
		{
			return '<img width="'.BP_AVATAR_THUMB_WIDTH.'" height="'.BP_AVATAR_THUMB_HEIGHT.'" src="'.$custom_avatar.'" class="avatar" alt="' . esc_attr( $groups_template->group->name ) . '" />';
		}
		else {
			return '<img width="'.BP_AVATAR_FULL_WIDTH.'" height="'.BP_AVATAR_FULL_HEIGHT.'" src="'.$custom_avatar.'" class="avatar" alt="' . esc_attr( $groups_template->group->name ) . '" />';
		}
	}
}
add_filter( 'bp_get_group_avatar', 'buddyboss_default_group_avatar');
add_filter( 'bp_get_new_group_avatar', 'buddyboss_default_group_avatar' );


/****************************** WORDPRESS FUNCTIONS ******************************/

/**
 * BuddyBoss Previous Logo Support
 *
 * @since BuddyBoss 3.1
 */

function buddyboss_set_previous_logo()
{

	// If there was a logo uploaded prior to upgrading to BuddyBoss 3.1,
	// set it as the new logo to be used in the Theme Customizer

	$previous_logo = '';
	$previous_logo = get_option("buddyboss_custom_logo");

	if ($previous_logo != ''){
		set_theme_mod( 'buddyboss_logo', $previous_logo );
	}

	// Remove the previous logo option afterwards

	delete_option("buddyboss_custom_logo");
}
add_action( 'after_setup_theme', 'buddyboss_set_previous_logo' );


/**
 * Custom Pagination
 * Credits: http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
 *
 * @since BuddyBoss 3.0
 */

function buddyboss_pagination($pages = '', $range = 2)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".esc_url(get_pagenum_link(1))."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".esc_url(get_pagenum_link($paged - 1))."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".intval($i)."</span>":"<a href='".esc_url(get_pagenum_link($i))."' class='inactive' >".intval($i)."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".esc_url(get_pagenum_link($paged + 1))."'>&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".esc_url(get_pagenum_link($pages))."'>&raquo;</a>";
         echo "</div>\n";
     }
}


/**
 * Checks if a plugin is active.
 *
 * @since BuddyBoss 2.0
 */
function buddyboss_is_plugin_active( $plugin ) {
    return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
}


/**
 * Return the ID of a page set as the home page.
 *
 * @return false|int ID of page set as the home page
 * @since BuddyBoss 3.0
 */

if ( !function_exists( 'bp_dtheme_page_on_front' ) ) :
function bp_dtheme_page_on_front() {
	if ( 'page' != get_option( 'show_on_front' ) )
		return false;

	return apply_filters( 'bp_dtheme_page_on_front', get_option( 'page_on_front' ) );
}
endif;


/**
 * Add a View Profile link in Dashboard > Users panel
 *
 * @since BuddyBoss 2.0
 */

function user_row_actions_bp_view( $actions, $user_object )
{
	if ( function_exists('bp_is_active') ){

	$actions['view'] = '<a href="' . bp_core_get_user_domain($user_object->ID) . '">' . __( 'View Profile', 'buddyboss' ) . '</a>';
	return $actions;

	}
}
add_filter('user_row_actions', 'user_row_actions_bp_view', 10, 2);


/**
 * Function that checks if BuddyPress plugin is active
 *
 * @since BuddyBoss 3.0
 */

function buddyboss_is_bp_active(){
	if(function_exists('bp_is_active')){
		return true;
	}
	else{
		return false;
	}
}

function buddyboss_override_page_template( $template )
{
	global $bp;
	$id = get_queried_object_id();
	$page_template = get_page_template_slug();
	$pagename = get_query_var('pagename');

	$bp_pages = buddypress()->pages;

	$bp_page_ids = array();

	foreach( $bp_pages as $bp_page )
	{
		$bp_page_ids[] = $bp_page->id;
	}

	if ( in_array( $id, $bp_page_ids ) )
	{
		// locate_template( array( $page_template ), true );
		// var_dump( $page_template, $id, $template, $pagename, buddypress()->pages );
	}
	// die;
}
// add_action( 'template_redirect', 'buddyboss_override_page_template' );


/**
 * Heartbeat settings
 * 
 * @since Boss 1.0.0
 *
 */
function buddyboss_heartbeat_settings( $settings ) {
    $settings['interval'] = 5; //pulse on each 20 sec.
    return $settings;
}
add_filter( 'heartbeat_settings', 'buddyboss_heartbeat_settings' );


/**
 * Sending a heartbeat for notification updates
 * 
 * @since Boss 1.0.0 
 *
 */
function buddyboss_notification_count_heartbeat( $response, $data, $screen_id ) {
 
	   if(function_exists("bp_friend_get_total_requests_count")) 
			$friend_request_count = bp_friend_get_total_requests_count();
	   if(function_exists("bp_notifications_get_all_notifications_for_user")) 
			$notifications =   bp_notifications_get_all_notifications_for_user( get_current_user_id() );
			$notification_count = count($notifications);
	   if(function_exists("bp_notifications_get_all_notifications_for_user")) {
			$notifications =   bp_notifications_get_notifications_for_user( get_current_user_id() );
			foreach((array) $notifications as $notification) {
				$notification = str_replace('href','class="ab-item" href',$notification); //add ab-item class
				$notification_content .= $notification;
			}
			if(empty($notification_content))
					$notification_content = '<a class="ab-item" href="'.bp_loggedin_user_domain().''.BP_NOTIFICATIONS_SLUG.'/">'.__("No new notifications","buddypress").'</a>';
	   }
	   if(function_exists("messages_get_unread_count"))  
			$unread_message_count = messages_get_unread_count();
	   
	   $response['bb_notification_count'] = array(
            'friend_request' => @intval($friend_request_count),
            'notification' => @intval($notifications),
            'notification_real' => @intval($notification_count),
            'notification_content' => @$notification_content,
            'unread_message' => @intval($unread_message_count)
        );
    
    return $response;
}
 
// Logged in users:
add_filter( 'heartbeat_received', 'buddyboss_notification_count_heartbeat', 10, 3 );

/**
 * Overriding BB Inbox templates
 * @global type $buddyboss
 * @param type $temp_dir
 */
function buddyboss_bb_inbox_templates_override($temp_dir) {
	global $buddyboss;
	$bbm_temp_dir = $buddyboss->tpl_dir.'/buddyboss-inbox';
	
	return trailingslashit($bbm_temp_dir);
}
add_filter('bbm_templates_dir_filter','buddyboss_bb_inbox_templates_override');