<?php
/**
 * @package Boss
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 625;

function boss_show_adminbar(){
	$show = false;

	if( !is_admin() && current_user_can( 'manage_options' ) && (get_option('boss_adminbar') == 'on') ){
		$show = true;
	}
	
	return apply_filters( 'boss_show_adminbar', $show );
}

/**
 * Sets up theme defaults and registers the various WordPress features that Boss supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Boss 1.0.0
 */
function buddyboss_setup()
{
	// Completely Disable Adminbar from frontend.
	//show_admin_bar( false );
	
	// Makes Boss available for translation.
	load_theme_textdomain( 'boss', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Declare theme support for WooCommerce
	add_theme_support( 'woocommerce' );

	// Adds wp_nav_menu() in two locations with BuddyPress deactivated.
		register_nav_menus( array(
			'left-panel-menu'   => __( 'BuddyPanel', 'boss' ),
			'header-menu'   => __( 'Titlebar', 'boss' ),
			'header-my-account'   => __( 'My Profile', 'boss' ),
			'secondary-menu' => __( 'Footer', 'boss' ),
		) );

	// Adds wp_nav_menu() in two additional locations with BuddyPress activated.
	if ( function_exists('bp_is_active') ) {
		register_nav_menus( array(
			'profile-menu'   => __( 'Profile: Extra Links', 'boss' ),
			'group-menu'     => __( 'Group: Extra Links', 'boss' ),
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
 * @since Boss 1.0.0
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
 * @since Boss 1.0.0
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
 * @since Boss 1.0.6
 */
function bb_unique_array($a){
    return array_unique(array_filter($a));
}

function buddyboss_load_fonts()
{
	if ( !is_admin() ) {
        
        // FontAwesome icon fonts. If browsing on a secure connection, use HTTPS.
		wp_register_style('fontawesome', "//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css", false, null);
        wp_enqueue_style( 'fontawesome');

        // Growl Css 
        wp_register_style('growl', get_template_directory_uri() . '/css/jquery.growl.css', false, null);
		wp_enqueue_style( 'growl' );

        $using = array();
        $used = array();

        $loading = array(
            'arimo'     => 'Arimo:400,700,400italic',
            'cabin'   => 'Cabin:400,500,600',
            'lato'      => 'Lato:300,400,700,900,300italic',
            'montserrat'    => 'Montserrat:400,700',
            'opensans'  => 'Open+Sans:300italic,700italic,400,600',
            'pacifico'  => 'Pacifico',
            'pt_sans'  => 'PT+Sans:400,700',
            'raleway'  => 'Raleway:400,300,600',
            'source'  => 'Source+Sans+Pro:600',
            'ubuntu'     => 'Ubuntu:400,300,500'
        );
        
        $subset = '';
        
        if(get_theme_mod( 'boss_font_charset' )) {
            $subset = '&subset='.implode(",",get_theme_mod( 'boss_font_charset' ));
        }
        
        if(get_theme_mod( 'boss_site_title_font_family' )){
            $using[] = $loading[get_theme_mod( 'boss_site_title_font_family' )];
        } else {
            wp_enqueue_style('sitetitle-font', "//fonts.googleapis.com/css?family=Pacifico".$subset, false, null);
            $used[] = $loading['pacifico'];
        } 
        if(get_theme_mod( 'boss_heading_font_family' )){
            $using[] = $loading[get_theme_mod( 'boss_heading_font_family' )];
        } else {
            wp_enqueue_style('heading-font', "//fonts.googleapis.com/css?family=Source+Sans+Pro:600".$subset, false, null);
            $used[] = $loading['source'];
        }       
        if(get_theme_mod( 'boss_slideshow_font_family' )){
            $using[] = $loading[get_theme_mod( 'boss_slideshow_font_family' )];
        } elseif(get_theme_mod( 'boss_heading_font_family' )) {
            wp_enqueue_style('heading-font', "//fonts.googleapis.com/css?family=Source+Sans+Pro:600".$subset, false, null);
            $used[] = $loading['source'];
        }
        if(get_theme_mod( 'boss_body_font_family' )){
            $using[] = $loading[get_theme_mod( 'boss_body_font_family' )];
        } else {
            wp_enqueue_style('body-font', "//fonts.googleapis.com/css?family=Arimo:400,700,400italic".$subset, false, null);
            $used[] = $loading['arimo'];
        } 
        
        $using = bb_unique_array($using);
        $used = bb_unique_array($used);

        $fonts = array_diff($using, $used);
        
        // Google fonts. If browsing on a secure connection, use HTTPS.
        if(!empty($fonts)){
            wp_enqueue_style('googlefonts', "//fonts.googleapis.com/css?family=".implode("|",$fonts).$subset , false, null);
        }

    }
}
add_action('wp_enqueue_scripts', 'buddyboss_load_fonts');

/**
 * Detecting phones
 *
 * @since Boss 1.0.6
 * from detectmobilebrowsers.com
 */

function is_phone() {
	$useragent=$_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
	return true; 
}

/**
 * Enqueues scripts and styles for front-end.
 *
 * @since Boss 1.0.0
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
    * Adds UI scripts.
    */
    
    if ( !is_admin() ) {
        wp_enqueue_script( 'jquery-effects-core' );
        wp_enqueue_script( 'jquery-ui-tabs' );
        wp_enqueue_script( 'jquery-ui-accordion' );
        wp_enqueue_script('jquery-ui-progressbar');
        wp_enqueue_script('jquery-ui-tooltip');
        wp_enqueue_script( 'selectboxes', get_template_directory_uri() . '/js/ui-scripts/selectboxes.js', array(), '1.1.7', true );  
        wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/ui-scripts/fitvids.js', array(), '1.1', true );  
        wp_enqueue_script( 'cookie', get_template_directory_uri() . '/js/ui-scripts/jquery.cookie.js', array(), '1.4.1', true );  
        wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/ui-scripts/superfish.js', array(), '1.7.4', true );
        wp_enqueue_script( 'hoverIntent', get_template_directory_uri() . '/js/ui-scripts/hoverIntent.js', array(), '1.8.0', true );       
        wp_enqueue_script( 'imagesLoaded', get_template_directory_uri() . '/js/ui-scripts/imagesloaded.pkgd.js', array(), '3.1.8', true );
        wp_enqueue_script( 'resize', get_template_directory_uri() . '/js/ui-scripts/resize.js', array(), '1.1', true );
        wp_enqueue_script( 'growl', get_template_directory_uri() . '/js/jquery.growl.js', array(), '1.2.4', true );
   
        // JS > Plupload
        wp_deregister_script( 'moxie' );
        wp_deregister_script( 'plupload' );
        wp_enqueue_script( 'moxie', get_template_directory_uri() . '/js/plupload/moxie.min.js', array( 'jquery' ), '1.2.1' );
        wp_enqueue_script( 'plupload', get_template_directory_uri() . '/js/plupload/plupload.dev.js', array( 'jquery', 'moxie' ), '2.1.2' );
		
	   //Heartbeat
	   wp_enqueue_script('heartbeat');
	   
    }

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


	/****************************** STYLES ******************************/

    // Used in js file to detect if we are using only mobile layout
    $only_mobile = false;
    
	// Main stylesheet
	if ( !is_admin() ) {
        
        // Activate our main stylesheets. Load FontAwesome first.
		wp_enqueue_style( 'boss-main-global', get_template_directory_uri().'/css/main-global.css', array( 'fontawesome'), '1.1.9', 'all' );
        
        // Switch between mobile and desktop
        if(isset($_COOKIE['switch_mode']) && (get_option( 'boss_layout_switcher' ) != 'no')){
            if($_COOKIE['switch_mode'] == 'mobile') {
                wp_enqueue_style( 'boss-main-mobile', get_template_directory_uri().'/css/main-mobile.css', array( 'fontawesome'), '1.1.9', 'all' );
                $only_mobile = true;              
            } else {
                wp_enqueue_style( 'boss-main-desktop', get_template_directory_uri().'/css/main-desktop.css', array( 'fontawesome'), '1.1.9', 'screen and (min-width: 481px)' );
                wp_enqueue_style( 'boss-main-mobile', get_template_directory_uri().'/css/main-mobile.css', array( 'fontawesome'), '1.1.9', 'screen and (max-width: 480px)' );
            }
        // Defaults   
        } else {
            if(is_phone()) {
                wp_enqueue_style( 'boss-main-mobile', get_template_directory_uri().'/css/main-mobile.css', array( 'fontawesome'), '1.1.9', 'all' );
                $only_mobile = true; 
            } elseif ( wp_is_mobile() ) {
                if(get_option('boss_layout_tablet') == 'desktop') {
                     wp_enqueue_style( 'boss-main-desktop', get_template_directory_uri().'/css/main-desktop.css', array( 'fontawesome'), '1.1.9', 'all' );
                }  else {
                    wp_enqueue_style( 'boss-main-mobile', get_template_directory_uri().'/css/main-mobile.css', array( 'fontawesome'), '1.1.9', 'all' );
                    $only_mobile = true; 
                } 
            } else {
                if(get_option('boss_layout_desktop') == 'mobile') {
                    wp_enqueue_style( 'boss-main-mobile', get_template_directory_uri().'/css/main-mobile.css', array( 'fontawesome'), '1.1.9', 'all' );
                    $only_mobile = true; 
                }  else {
                     wp_enqueue_style( 'boss-main-desktop', get_template_directory_uri().'/css/main-desktop.css', array( 'fontawesome'), '1.1.9', 'screen and (min-width: 481px)' );
                }
            }
            
            // Media query fallback
            if(!wp_script_is( 'boss-main-mobile', 'enqueued' )) {
                 wp_enqueue_style( 'boss-main-mobile', get_template_directory_uri().'/css/main-mobile.css', array( 'fontawesome'), '1.1.9', 'screen and (max-width: 480px)' );
            }
        }

	}
    
    /*
	 * Adds custom BuddyBoss JavaScript functionality.
	 */
	if ( !is_admin() ) {
		wp_register_script( 'buddyboss-main', get_template_directory_uri().'/js/buddyboss.js', array( 'jquery' ), '1.1.9' );
        $translation_array = array( 
            'only_mobile' => $only_mobile,
            'comment_placeholder' => __( 'Your Comment...', 'boss' ),
            'view_desktop' => __( 'View as Desktop', 'boss' ),
            'view_mobile' => __( 'View as Mobile', 'boss' )
        );
        wp_localize_script( 'buddyboss-main', 'translation', $translation_array );
        wp_enqueue_script( 'buddyboss-main' );
	}

	// Add BuddyBoss words that we need to use in JS to the end of the page
	// so they can be translataed and still used.
	$buddyboss_js_vars = array(
		'select_label'        => __( 'Show:', 'boss' ),
		'post_in_label'       => __( 'Post in:', 'boss' ),
		'tpl_url'             => get_template_directory_uri(),
		'child_url'           => get_stylesheet_directory_uri(),
		'user_profile'        => $user_profile
	);

	$buddyboss_js_vars = apply_filters( 'buddyboss_js_vars', $buddyboss_js_vars );

	wp_localize_script( 'buddyboss-main', 'BuddyBossOptions', $buddyboss_js_vars );

	/*
	* Load our BuddyPress styles manually.
	* We need to deregister the BuddyPress styles first then load our own.
	* We need to do this for proper CSS load order.
	*/
	if ( $buddyboss->buddypress_active && !is_admin() )
	{
		// Deregister the built-in BuddyPress stylesheet
		wp_deregister_style( 'bp-child-css' );
		wp_deregister_style( 'bp-parent-css' );
		wp_deregister_style( 'bp-legacy-css' );
	}

	/*
	* Load our bbPress styles manually.
	* We need to deregister the bbPress style first then load our own.
	* We need to do this for proper CSS load order.
	*/
	if ( $buddyboss->bbpress_active && !is_admin() )
	{
		// Deregister the built-in bbPress stylesheet
		wp_deregister_style( 'bbp-child-bbpress' );
		wp_deregister_style( 'bbp-parent-bbpress' );
		wp_deregister_style( 'bbp-default' );
	}

    // Deregister the wp admin bar stylesheet
    if( !boss_show_adminbar() )
		wp_deregister_style('admin-bar');

}
add_action( 'wp_enqueue_scripts', 'buddyboss_scripts_styles' );


/**
 * We need to enqueue jQuery migrate before anything else for legacy
 * plugin support.
 * WordPress version 3.9 onwards already includes jquery 1.11.n version, which we required,
 * and jquery migrate is also properly enqueued.
 * So we dont need to do anything for WP versions greater than 3.9.
 *
 * @package  Boss
 * @since    Boss 1.0.0
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
 * Removes CSS in the header so we can keep buddyboss clean from admin bar stuff.
 * Note :- we can fully disable admin-bar too but we are using its nodes for BuddyPanel.
 *
 * @package  Boss
 * @since    Boss 1.0.0
 */
function buddyboss_remove_adminbar_inline_styles()
{
	if ( !is_admin() && !boss_show_adminbar() ) {

		remove_action( 'wp_head', 'wp_admin_bar_header' );
		remove_action( 'wp_head', '_admin_bar_bump_cb' );

	}
}
add_action( 'wp_head', 'buddyboss_remove_adminbar_inline_styles', 9 );


/**
 * JavaScript mobile init
 *
 * @package  Boss
 * @since    Boss 1.0.0
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
 * @package  Boss
 * @since    Boss 1.0.0
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
 * @since Boss 1.0.0
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
 * Load admin bar in header we need it to load on header for getting nodes to use on left panel but wont show it. 
 * 
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
 * @since Boss 1.0.0
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
		$title = "$title $sep " . sprintf( __( 'Page %s', 'boss' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'buddyboss_wp_title', 10, 2 );

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Boss 1.0.0
 */
function buddyboss_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'buddyboss_page_menu_args' );

/**
 * Registers all of our widget areas.
 *
 * @since Boss 1.0.0
 */
function buddyboss_widgets_init() {
	// Area 1, located in the pages and posts right column.
	register_sidebar( array(
			'name'          => 'Page Sidebar (default)',
			'id'          	=> 'sidebar',
			'description'   => 'The default Page/Post widget area. Right column is always present.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );

	// Area 2, located in the homepage right column.
	register_sidebar( array(
			'name'          => 'Homepage',
			'id' 			=> 'home-right',
			'description'   => 'The Homepage widget area. Right column only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );

	// Area 3, located in the Members Directory right column. Right column only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Members &rarr; Directory',
			'id'          	=> 'members',
			'description'   => 'The Members Directory widget area. Right column only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
	// Area 4, located in the Individual Member Profile right column. Right column only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Member &rarr; Single Profile',
			'id'          	=> 'profile',
			'description'   => 'The Individual Profile widget area. Right column only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
	// Area 5, located in the Groups Directory right column. Right column only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Groups &rarr; Directory',
			'id'          	=> 'groups',
			'description'   => 'The Groups Directory widget area. Right column only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
	// Area 6, located in the Individual Group right column. Right column only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Group &rarr; Single Group',
			'id'          	=> 'group',
			'description'   => 'The Individual Group widget area. Right column only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="inner">',
			'after_widget'  => '</div></aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
	// Area 7, located in the Activity Directory right column. Right column only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Activity &rarr; Directory',
			'id'          	=> 'activity',
			'description'   => 'The Activity Directory widget area. Right column only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
	// Area 8, located in the Forums Directory right column. Right column only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Forums &rarr; Directory & Single',
			'id'          	=> 'forums',
			'description'   => 'The Forums Directory widget area. Right column only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
	// Area 9, located in the Members Directory right column. Right column only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Blogs &rarr; Directory (multisite)',
			'id'          	=> 'blogs',
			'description'   => 'The Blogs Directory widget area (only for Multisite). Right column only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
	// Area 10, located in the Footer column 1. Only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Footer #1',
			'id'          	=> 'footer-1',
			'description'   => 'The first footer widget area. Only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
		    'before_title'  => '<h4 class="widgettitle">',
		    'after_title'   => '</h4>'
		) );
	// Area 11, located in the Footer column 2. Only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Footer #2',
			'id'          	=> 'footer-2',
			'description'   => 'The second footer widget area. Only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
		    'before_title'  => '<h4 class="widgettitle">',
		    'after_title'   => '</h4>'
		) );
	// Area 12, located in the Footer column 3. Only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Footer #3',
			'id'          	=> 'footer-3',
			'description'   => 'The third footer widget area. Only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
		    'before_title'  => '<h4 class="widgettitle">',
		    'after_title'   => '</h4>'
		) );
	// Area 13, located in the Footer column 4. Only appears if widgets are added.
	register_sidebar( array(
			'name'          => 'Footer #4',
			'id'          	=> 'footer-4',
			'description'   => 'The fourth footer widget area. Only appears if widgets are added.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
		    'before_title'  => '<h4 class="widgettitle">',
		    'after_title'   => '</h4>'
		) );
	// Area 14, dedicated sidebar for WooCommerce
	register_sidebar( array(
			'name' 			=> 'WooCommerce &rarr; Shop',
			'id'	 		=> 'woo_sidebar',
			'description' 	=> 'Only display on shop page',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h4 class="widgettitle">',
			'after_title' 	=> '</h4>',
	) );
}
add_action( 'widgets_init', 'buddyboss_widgets_init' );

if ( ! function_exists( 'buddyboss_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Boss 1.0.0
 */
function buddyboss_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo esc_attr( $nav_id ); ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'boss' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'boss' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'boss' ) ); ?></div>
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
 * @since Boss 1.0.0
 */
function buddyboss_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'boss' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'boss' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
            
            <div class="table-cell avatar-col">
                <?php echo get_avatar( $comment, 60 ); ?>
            </div><!-- .comment-left-col -->
            
            <div class="table-cell">
                <header class="comment-meta comment-author vcard">
                    <?php
                        printf( '<cite class="fn">%1$s %2$s</cite>',
                            get_comment_author_link(),
                            // If current post author is also comment author, make it known visually.
                            ( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'boss' ) . '</span>' : ''
                        );
                    ?>
                </header><!-- .comment-meta -->

                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'boss' ); ?></p>
                <?php endif; ?>

                <section class="comment-content comment">
                    <?php comment_text(); ?>
                </section><!-- .comment-content -->
                
                <footer class="comment-meta">
                    <?php 
                    printf( '<a href="%1$s"><time datetime="%2$s">%3$s ago</time></a>',
                        esc_url( get_comment_link( $comment->comment_ID ) ),
                        get_comment_time( 'c' ),
                        /* translators: 1: date, 2: time */
                       human_time_diff( get_comment_time('U'), current_time('timestamp') )
                    );
                    ?>
                    <span class="entry-actions">
                        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '<i class="fa fa-reply"></i>', 'boss' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    </span><!-- .entry-actions -->
                    <?php edit_comment_link( __( 'Edit', 'boss' ), '<span class="edit-link">', '</span>' ); ?>
                </footer>
            </div>
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
 * @since Boss 1.0.0
 */
function buddyboss_entry_meta($show_author = true, $show_date = true , $show_comment_info = true) {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'boss' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'boss' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark" class="post-date fa fa-clock-o"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'boss' ), get_the_author() ) ),
		get_the_author()
	);
    
    if (function_exists('get_avatar')) { 
        $avatar = sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>', 
                            esc_url( get_permalink() ),
                            get_avatar( get_the_author_meta('email'), 55 ) 
                        ); 
    }
    
    if($show_author) {
        echo '<span class="post-author">';
            echo $avatar;
            echo $author;
        echo '</span>';
    }
    
    if($show_date) {
        echo $date;
    }

    if($show_comment_info) {
       if ( comments_open() ) : ?>
            <!-- reply link -->
            <span class="comments-link fa fa-comment-o">
                <?php comments_popup_link( '<span class="leave-reply">' . __( '0 comments', 'boss' ) . '</span>', __( '1 comment', 'boss' ), __( '% comments', 'boss' ) ); ?>
            </span><!-- .comments-link -->
        <?php endif; // comments_open()
    }
    
}
endif;

/**
 * Extends the default WordPress body classes.
 *
 * @since Boss 1.0.0
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
 * @since Boss 1.0.0
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
 * Custom Login Logo and Helper scripts
 *
 * @since Boss 1.0.0
 */

function buddyboss_custom_login_scripts ()
{
    //placeholders
    echo '<script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            document.getElementById("user_login").setAttribute( "placeholder", "'.__("Username", "boss" ).'" );
            document.getElementById("user_pass").setAttribute( "placeholder", "'.__("Password", "boss" ).'" );
            
            var input = document.querySelectorAll(".forgetmenot input")[0];
            var label = document.querySelectorAll(".forgetmenot label")[0]; 
            var text = document.querySelectorAll(".forgetmenot label")[0].innerHTML.replace(/<[^>]*>/g, "");

            label.innerHTML = "";
        
            label.appendChild(input); ;
            
            label.innerHTML += "<strong>"+ text +"</strong>";
            
            labels = document.querySelectorAll("label");
            
            for (var i = labels.length - 1; i >= 0; i--)
            {
                var child = labels[i].firstChild, nextSibling;

                while (child) {
                    nextSibling = child.nextSibling;
                    if (child.nodeType == 3) {
                        child.parentNode.removeChild(child);
                    }
                    child = nextSibling;
                }
            }
   
        });
   
    </script>';
    
    //logo
    $logo = get_theme_mod( 'buddyboss_logo', FALSE );
	
	/*convert from relative url to absolute url*/
	$logo_absolute_url = $logo;

    if ( $logo ) {
        if ( !0 ) {
            list( $width, $height ) = getimagesize( $logo_absolute_url );
            $h = ceil(intval($height)*(280/intval($width)));
            echo '<style type="text/css">
                    #login h1 a {
                        background-image: url('.esc_url($logo).');
                        background-size: 280px '.$h.'px !important;
                        min-height: 87px;
                        max-height: 300px;
                        max-width: 280px;
                        height: '.$h.'px;
                        overflow: hidden;
                        text-indent: -9999px;
                        display: block;
                    }
                </style>';

        }
    }
}
add_action( 'login_head', 'buddyboss_custom_login_scripts', 1 );


/**
 * Custom Login Link
 *
 * @since Boss 1.0.0
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



/*
* Adds Login form style.
*/ 
function buddyboss_login_stylesheet() {
    wp_register_style('googlePacifico', "//fonts.googleapis.com/css?family=Pacifico", false, null);
    wp_enqueue_style( 'googlePacifico');
    wp_enqueue_style( 'custom-login', get_template_directory_uri().'/css/style-login.css', false, '1.0.0', 'all' );
}
add_action( 'login_enqueue_scripts', 'buddyboss_login_stylesheet' );


/****************************** ADMIN BAR FUNCTIONS ******************************/


/**
 * Strip all waste and unuseful nodes and keep components only and memory for notification
 * @since Boss 1.0.0
 **/
function buddyboss_strip_unnecessary_admin_bar_nodes( &$wp_admin_bar ) {
	global $admin_bar_myaccount,$bb_adminbar_notifications,$bp;
	
	if(is_admin()) { //nothing to do on admin
		return;
	}
	$nodes = $wp_admin_bar->get_nodes();
	
	$bb_adminbar_notifications[] = @$nodes["bp-notifications"];
	
	$current_href = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	
	foreach($nodes as $name => $node) {
		
		if($node->parent == "bp-notifications") {
			$bb_adminbar_notifications[] = $node;
		}
		
		if($node->parent == "" || $node->parent == "top-secondary"   AND $node->id != "top-secondary") {
			if($node->id == "my-account") { continue; }
			
			if( !boss_show_adminbar() )
				$wp_admin_bar->remove_node($node->id);
		}
		
		//adding active for parent link
		if($node->id == "my-account-xprofile-edit" ||
		   $node->id == "my-account-groups-create"  ) {
			
			if(strpos("http://".$current_href,$node->href) !== false ||
			   strpos("https://".$current_href,$node->href) !== false) {
				buddyboss_adminbar_item_add_active($wp_admin_bar,$name);
				
			}
		}
        
		if($node->id == "my-account-activity-personal") {
			if($bp->current_component == "activity" AND $bp->current_action == "just-me" AND bp_displayed_user_id() == get_current_user_id()) {
				buddyboss_adminbar_item_add_active($wp_admin_bar,$name);
			}
		}
		
		if( $node->id == "my-account-xprofile-public") {
			if($bp->current_component == "profile" AND $bp->current_action == "public" AND bp_displayed_user_id() == get_current_user_id()) {
				buddyboss_adminbar_item_add_active($wp_admin_bar,$name);
			}
		}
		
		if($node->id == "my-account-messages-inbox") {
			if($bp->current_component == "messages" AND $bp->current_action == "inbox") {
				buddyboss_adminbar_item_add_active($wp_admin_bar,$name);
			}
		}
		
		//adding active for child link
		if($node->id == "my-account-settings-general" ) {
			if($bp->current_component == "settings" ||
			   $bp->current_action == "general") {
				buddyboss_adminbar_item_add_active($wp_admin_bar,$name);
			}
		}
		
		/*
		//add active class if it has viewing page href
		if(!empty($node->href)) {
			if("http://".$current_href == $node->href AND "https://".$current_href == $node->href ) {
				buddyboss_adminbar_item_add_active($wp_admin_bar,$name);
			}
		}*/
		
		
		//add active class if it has viewing page href
		if(!empty($node->href)) {
			if( 
					( "http://".$current_href == $node->href || "https://".$current_href == $node->href ) 
					||
					( $node->id='my-account-xprofile-edit' && strpos( "http://".$current_href, $node->href )===0 )
				)
				{
				buddyboss_adminbar_item_add_active($wp_admin_bar,$name);
				//add active class to its parent
				if( $node->parent!='' && $node->parent!='my-account-buddypress' ){
					foreach($nodes as $name_inner => $node_inner) {
						if( $node_inner->id==$node->parent ){
							buddyboss_adminbar_item_add_active($wp_admin_bar,$name_inner);
							break;
						}
					}
				}
			}
		}
        
	}
	
} 
add_action( 'admin_bar_menu', 'buddyboss_strip_unnecessary_admin_bar_nodes', 999 );

function buddyboss_adminbar_item_add_active(&$wp_admin_bar,$name) {
	$gnode = $wp_admin_bar->get_node($name);
	if( $gnode ){
		$gnode->meta["class"] =  isset( $gnode->meta["class"] ) ? $gnode->meta["class"] . " active" : " active";
		$wp_admin_bar->add_node($gnode); //update
	}
}

/**
 * Store adminbar specific nodes to use later for buddyboss
 * @since Boss 1.0.0
 **/
function buddyboss_memory_admin_bar_nodes() { 
	static $bb_memory_admin_bar_step;
	global $bb_adminbar_myaccount;
    
	if(is_admin()) { //nothing to do on admin
		return;
	}
	
	if(!empty($bb_adminbar_myaccount)) { //avoid multiple run
		return false;
	}
	
	if(empty($bb_memory_admin_bar_step)) {
		$bb_memory_admin_bar_step = 1;
		ob_start();
	} else {
		$admin_bar_output = ob_get_contents();
		ob_end_clean();
		
		if(boss_show_adminbar())
			echo $admin_bar_output;
		
		//strip some waste
		$admin_bar_output = str_replace(array('id="wpadminbar"',
						      'role="navigation"',
						      'class ',
						      'class="nojq nojs"',
						      'class="quicklinks" id="wp-toolbar"',
						      'id="wp-admin-bar-top-secondary" class="ab-top-secondary ab-top-menu"',
						      ),'',$admin_bar_output);
		
		//remove screen shortcut link
		$admin_bar_output = @explode('<a class="screen-reader-shortcut"',$admin_bar_output,2);
		$admin_bar_output2 = "";
		if( count( $admin_bar_output ) > 1 ){
			$admin_bar_output2 = @explode("</a>",$admin_bar_output[1],2);
			if( count( $admin_bar_output2 )>1 ){
				$admin_bar_output2 = $admin_bar_output2[1];
			}
		}
		$admin_bar_output = $admin_bar_output[0].$admin_bar_output2;
		
		//remove script tag
		$admin_bar_output = @explode('<script',$admin_bar_output,2);
		$admin_bar_output2 = "";
		if( count( $admin_bar_output ) > 1 ){
			$admin_bar_output2 = @explode("</script>",$admin_bar_output[1],2);
			if( count( $admin_bar_output2 ) > 1 ){
				$admin_bar_output2 = $admin_bar_output2[1];
			}
		}
		$admin_bar_output = $admin_bar_output[0].$admin_bar_output2;
		
		//remove user details
		$admin_bar_output = @explode('<a class="ab-item"',$admin_bar_output,2);
		$admin_bar_output2 = "";
		if( count( $admin_bar_output ) > 1 ){
			$admin_bar_output2 = @explode("</a>",$admin_bar_output[1],2);
			if( count( $admin_bar_output2 ) > 1 ){
				$admin_bar_output2 = $admin_bar_output2[1];
			}
		}
		$admin_bar_output = $admin_bar_output[0].$admin_bar_output2;
		
		//add active class into vieving link item
		$current_link = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
		
		$bb_adminbar_myaccount = $admin_bar_output;
		
	}
	
}

add_action("wp_before_admin_bar_render","buddyboss_memory_admin_bar_nodes");
add_action("wp_after_admin_bar_render","buddyboss_memory_admin_bar_nodes");

/**
 * Get adminbar myaccount section output
 * Note :- this function can be overwrite with child-theme.
 * @since Boss 1.0.0
 * 
 **/

function buddyboss_adminbar_myaccount() {
	global $bb_adminbar_myaccount;
	echo $bb_adminbar_myaccount;
 }
 
 
 /**
  * Get Notification from admin bar
  * @since Boss 1.0.0
  **/
 function buddyboss_adminbar_notification() {
	global $bb_adminbar_notifications;
	return @$bb_adminbar_notifications;
 }
 

/**
 * Remove certain admin bar links useful as we using admin bar invisibly 
 * @since Boss 1.0.0
 * 
 */

function remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
	$wp_admin_bar->remove_menu('search');

	if (!current_user_can('administrator')):
		$wp_admin_bar->remove_menu('site-name');
	endif;
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );


/**
 * Replace admin bar "Howdy" text
 *
 * @since Boss 1.0.0
 * 
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
 * @since Boss 1.0.0
 * @todo: this will remove in final review
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
 * @since Boss 1.0.0
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
        $alt = 'group avatar';
        
        if($groups_template) {
            $alt = esc_attr( $groups_template->group->name );
        }

		if ( $bp->current_action == "" )
		{
			return '<img width="'.BP_AVATAR_THUMB_WIDTH.'" height="'.BP_AVATAR_THUMB_HEIGHT.'" src="'.$custom_avatar.'" class="avatar" alt="' . $alt . '" />';
		}
		else {
			return '<img width="'.BP_AVATAR_FULL_WIDTH.'" height="'.BP_AVATAR_FULL_HEIGHT.'" src="'.$custom_avatar.'" class="avatar" alt="' . $alt . '" />';
		}
	}
}
add_filter( 'bp_get_group_avatar', 'buddyboss_default_group_avatar');
add_filter( 'bp_get_new_group_avatar', 'buddyboss_default_group_avatar' );


/**
 * Change the avatar size
 * @since Boss 1.0.0
 **/
function buddyboss_avatar_full_height($val) {
    	global $bp;
		if($bp->current_component == "groups") {
			return 400;
		}
		return $val;		
	}
	
function buddyboss_avatar_full_width($val){
		global $bp;
		if($bp->current_component == "groups") {
			return 400;
		}
		return $val;
}
function buddyboss_avatar_thumb_height($val) {
    	global $bp;
		if($bp->current_component == "groups") {
			return 150;
		}
		return $val;		
	}
	
function buddyboss_avatar_thumb_width($val){
		global $bp;
		if($bp->current_component == "groups") {
			return 150;
		}
		return $val;
}

add_filter("bp_core_avatar_full_height","buddyboss_avatar_full_height");
add_filter("bp_core_avatar_full_width","buddyboss_avatar_full_width");
add_filter("bp_core_avatar_thumb_height","buddyboss_avatar_thumb_height");
add_filter("bp_core_avatar_thumb_width","buddyboss_avatar_thumb_width");



/****************************** WORDPRESS FUNCTIONS ******************************/

/**
 * Custom Pagination
 * Credits: http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
 *
 * @since Boss 1.0.0
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
 * @since Boss 1.0.0
 */
function buddyboss_is_plugin_active( $plugin ) {
    return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
}


/**
 * Return the ID of a page set as the home page.
 *
 * @return false|int ID of page set as the home page
 * @since Boss 1.0.0
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
 * @since Boss 1.0.0
 */

function user_row_actions_bp_view( $actions, $user_object )
{
	if ( function_exists('bp_is_active') ){

	$actions['view'] = '<a href="' . bp_core_get_user_domain($user_object->ID) . '">' . __( 'View Profile', 'boss' ) . '</a>';
	return $actions;

	}
}
add_filter('user_row_actions', 'user_row_actions_bp_view', 10, 2);


/**
 * Function that checks if BuddyPress plugin is active
 *
 * @since Boss 1.0.0
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
 * Function that modify wp_list_categories function's post count 
 *
 * @since Boss 1.0.0
 */

function cat_count_span_inline($output) {
    $output = str_replace('</a> (','</a><span><i>',$output);
    $output = str_replace(')','</i></span> ',$output);
    return $output;
}

add_filter('wp_list_categories', 'cat_count_span_inline');


/**
 * Function that modify bp_new_group_invite_friend_list function's input checkboxes 
 *
 * @since Boss 1.0.0
 */
function buddyboss_new_group_invite_friend_list() {
      echo buddyboss_get_new_group_invite_friend_list();
}

function buddyboss_get_new_group_invite_friend_list( $args = '' ) {
    global $bp;

    if ( !bp_is_active( 'friends' ) )
     return false;

    $defaults = array(
      'group_id'  => false,
      'separator' => 'li'
    );

    $r = wp_parse_args( $args, $defaults );
    extract( $r, EXTR_SKIP );

    if ( empty( $group_id ) )
      $group_id = !empty( $bp->groups->new_group_id ) ? $bp->groups->new_group_id : $bp->groups->current_group->id;

    if ( $friends = friends_get_friends_invite_list( bp_loggedin_user_id(), $group_id ) ) {
      $invites = groups_get_invites_for_group( bp_loggedin_user_id(), $group_id );

     for ( $i = 0, $count = count( $friends ); $i < $count; ++$i ) {
         $checked = '';

      if ( !empty( $invites ) ) {
             if ( in_array( $friends[$i]['id'], $invites ) )
                  $checked = ' checked="checked"';
          }

          $items[] = '<' . $separator . '><input' . $checked . ' type="checkbox" name="friends[]" id="f-' . $friends[$i]['id'] . '" value="' . esc_attr( $friends[$i]['id'] ) . '" /><label> ' . $friends[$i]['full_name'] . '</label></' . $separator . '>';
      }
    }

    if ( !empty( $items ) )
      return implode( "\n", (array) $items );

    return false;
}


/**
 * Output a fancy description of the current forum, including total topics,
 * total replies, and last activity.
 *
 * @since Boss 1.0.0
 *
 * @param array $args Arguments passed to alter output
 * @uses bbp_get_single_forum_description() Return the eventual output
 */
function buddyboss_bbp_single_forum_description( $args = '' ) {
	echo buddyboss_bbp_get_single_forum_description( $args );
}
/**
 * Return a fancy description of the current forum, including total
 * topics, total replies, and last activity.
 *
 * @since Boss 1.0.0
 *
 * @param mixed $args This function supports these arguments:
 *  - forum_id: Forum id
 *  - before: Before the text
 *  - after: After the text
 *  - size: Size of the avatar
 * @uses bbp_get_forum_id() To get the forum id
 * @uses bbp_get_forum_topic_count() To get the forum topic count
 * @uses bbp_get_forum_reply_count() To get the forum reply count
 * @uses bbp_get_forum_freshness_link() To get the forum freshness link
 * @uses bbp_get_forum_last_active_id() To get the forum last active id
 * @uses bbp_get_author_link() To get the author link
 * @uses add_filter() To add the 'view all' filter back
 * @uses apply_filters() Calls 'bbp_get_single_forum_description' with
 *                        the description and args
 * @return string Filtered forum description
 */
function buddyboss_bbp_get_single_forum_description( $args = '' ) {

    // Parse arguments against default values
    $r = bbp_parse_args( $args, array(
        'forum_id'  => 0,
        'before'    => '<div class="bbp-template-notice info"><p class="bbp-forum-description">',
        'after'     => '</p></div>',
        'size'      => 14,
        'feed'      => true
    ), 'get_single_forum_description' );

    // Validate forum_id
    $forum_id = bbp_get_forum_id( $r['forum_id'] );

    // Unhook the 'view all' query var adder
    remove_filter( 'bbp_get_forum_permalink', 'bbp_add_view_all' );

    // Get some forum data
    $tc_int      = bbp_get_forum_topic_count( $forum_id, false );
    $rc_int      = bbp_get_forum_reply_count( $forum_id, false );
    $topic_count = bbp_get_forum_topic_count( $forum_id );
    $reply_count = bbp_get_forum_reply_count( $forum_id );
    $last_active = bbp_get_forum_last_active_id( $forum_id );

    // Has replies
    if ( !empty( $reply_count ) ) {
        $reply_text = sprintf( _n( '%s reply', '%s replies', $rc_int, 'boss' ), $reply_count );
    }

    // Forum has active data
    if ( !empty( $last_active ) ) {
        $topic_text      = bbp_get_forum_topics_link( $forum_id );
        $time_since      = bbp_get_forum_freshness_link( $forum_id );
        $last_updated_by = bbp_get_author_link( array( 'post_id' => $last_active, 'size' => $r['size'] ) );

    // Forum has no last active data
    } else {
        $topic_text      = sprintf( _n( '%s topic', '%s topics', $tc_int, 'boss' ), $topic_count );
    }

    // Forum has active data
    if ( !empty( $last_active ) ) {

        if ( !empty( $reply_count ) ) {

            if ( bbp_is_forum_category( $forum_id ) ) {
                $retstr = sprintf( __( '<span class="post-num">%1$s and %2$s</span> <span class="last-activity">Last updated by %3$s %4$s</span>', 'boss' ), $topic_text, $reply_text, $last_updated_by, $time_since );
            } else {
                $retstr = sprintf( __( '<span class="post-num">%1$s and %2$s</span> <span class="last-activity">Last updated by %3$s %4$s<span>', 'boss' ), $topic_text, $reply_text, $last_updated_by, $time_since );
            }

        } else {

            if ( bbp_is_forum_category( $forum_id ) ) {
                $retstr = sprintf( __( '<span class="post-num">%1$s</span> <span class="last-activity">Last updated by %2$s %3$s</span>', 'boss' ), $topic_text, $last_updated_by, $time_since );
            } else {
                $retstr = sprintf( __( '<span class="post-num">%1$s</span> <span class="last-activity">Last updated by %2$s %3$s</span>', 'boss' ), $topic_text, $last_updated_by, $time_since );
            }
        }

    // Forum has no last active data
    } else {

        if ( !empty( $reply_count ) ) {

            if ( bbp_is_forum_category( $forum_id ) ) {
                $retstr = sprintf( __( '<span class="post-num">%1$s and %2$s</span>', 'boss' ), $topic_text, $reply_text );
            } else {
                $retstr = sprintf( __( '<span class="post-num">%1$s and %2$s</span>', 'boss' ), $topic_text, $reply_text );
            }

        } else {

            if ( !empty( $topic_count ) ) {

                if ( bbp_is_forum_category( $forum_id ) ) {
                    $retstr = sprintf( __( '<span class="post-num">%1$s</span>', 'boss' ), $topic_text );
                } else {
                    $retstr = sprintf( __( '<span class="post-num">%1$s</span>', 'boss' ), $topic_text );
                }

            } else {
                $retstr = __( '<span class="post-num">0 topics and 0 posts</span>', 'boss' );
            }
        }
    }

    // Add feeds
    //$feed_links = ( !empty( $r['feed'] ) ) ? bbp_get_forum_topics_feed_link ( $forum_id ) . bbp_get_forum_replies_feed_link( $forum_id ) : '';

    // Add the 'view all' filter back
    add_filter( 'bbp_get_forum_permalink', 'bbp_add_view_all' );

    // Combine the elements together
    $retstr = $r['before'] . $retstr . $r['after'];

    // Return filtered result
    return apply_filters( 'bbp_get_single_forum_description', $retstr, $r );
}


/**
 * Output a fancy description of the current topic, including total topics,
 * total replies, and last activity.
 *
 * @since Boss 1.0.0
 *
 * @param array $args See {@link bbp_get_single_topic_description()}
 * @uses bbp_get_single_topic_description() Return the eventual output
 */
function buddyboss_bbp_single_topic_description( $args = '' ) {
	echo buddyboss_bbp_get_single_topic_description( $args );
}
/**
 * Return a fancy description of the current topic, including total topics,
 * total replies, and last activity.
 *
 * @since Boss 1.0.0
 *
 * @param mixed $args This function supports these arguments:
 *  - topic_id: Topic id
 *  - before: Before the text
 *  - after: After the text
 *  - size: Size of the avatar
 * @uses bbp_get_topic_id() To get the topic id
 * @uses bbp_get_topic_voice_count() To get the topic voice count
 * @uses bbp_get_topic_reply_count() To get the topic reply count
 * @uses bbp_get_topic_freshness_link() To get the topic freshness link
 * @uses bbp_get_topic_last_active_id() To get the topic last active id
 * @uses bbp_get_reply_author_link() To get the reply author link
 * @uses apply_filters() Calls 'bbp_get_single_topic_description' with
 *                        the description and args
 * @return string Filtered topic description
 */
function buddyboss_bbp_get_single_topic_description( $args = '' ) {

    // Parse arguments against default values
    $r = bbp_parse_args( $args, array(
        'topic_id'  => 0,
        'before'    => '<div class="bbp-template-notice info"><p class="bbp-topic-description">',
        'after'     => '</p></div>',
        'size'      => 14
    ), 'get_single_topic_description' );

    // Validate topic_id
    $topic_id = bbp_get_topic_id( $r['topic_id'] );

    // Unhook the 'view all' query var adder
    remove_filter( 'bbp_get_topic_permalink', 'bbp_add_view_all' );

    // Build the topic description
    $vc_int      = bbp_get_topic_voice_count   ( $topic_id, true  );
    $voice_count = bbp_get_topic_voice_count   ( $topic_id, false );
    $reply_count = bbp_get_topic_replies_link  ( $topic_id        );
    $time_since  = bbp_get_topic_freshness_link( $topic_id        );

    // Singular/Plural
    $voice_count = sprintf( _n( '%s voice', '%s voices', $vc_int, 'boss' ), $voice_count );

    // Topic has replies
    $last_reply = bbp_get_topic_last_reply_id( $topic_id );
    if ( !empty( $last_reply ) ) {
        $last_updated_by = bbp_get_author_link( array( 'post_id' => $last_reply, 'size' => $r['size'] ) );
        $retstr          = sprintf( __( '<span class="post-num">%1$s, %2$s</span> <span class="last-activity">Last updated by %3$s %4$s</span>', 'boss' ), $reply_count, $voice_count, $last_updated_by, $time_since );

    // Topic has no replies
    } elseif ( ! empty( $voice_count ) && ! empty( $reply_count ) ) {
        $retstr = sprintf( __( '<span class="post-num">%1$s, %2$s</span>', 'boss' ), $voice_count, $reply_count );

    // Topic has no replies and no voices
    } elseif ( empty( $voice_count ) && empty( $reply_count ) ) {
        $retstr = sprintf( __( '<span class="post-num">0 replies</span>', 'boss' ), $voice_count, $reply_count );
    }

    // Add the 'view all' filter back
    add_filter( 'bbp_get_topic_permalink', 'bbp_add_view_all' );

    // Combine the elements together
    $retstr = $r['before'] . $retstr . $r['after'];

    // Return filtered result
    return apply_filters( 'bbp_get_single_topic_description', $retstr, $r );
}

/**
 * Places "Compose" to the first place on messages navigation links
 * 
 * @since Boss 1.0.0
 *
 */

function tricks_change_bp_tag_position()
{
    global $bp;
    $bp->bp_options_nav['messages']['compose']['position'] = 10;
    $bp->bp_options_nav['messages']['inbox']['position'] = 11;
    $bp->bp_options_nav['messages']['sentbox']['position'] = 30;
}
add_action( 'bp_init', 'tricks_change_bp_tag_position', 999 );


/**
 * Output the markup for the message type dropdown.
 * 
 * @since Boss 1.0.0
 *
 */
function buddyboss_bp_messages_options() {
?>

	<select name="message-type-select" id="message-type-select">
		<option value=""></option>
		<option value="read"><?php _ex('Read', 'Message dropdown filter', 'boss') ?></option>
		<option value="unread"><?php _ex('Unread', 'Message dropdown filter', 'boss') ?></option>
		<option value="all"><?php _ex('All', 'Message dropdown filter', 'boss') ?></option>
	</select> &nbsp;

	<?php if ( ! bp_is_current_action( 'sentbox' ) && bp_is_current_action( 'notices' ) ) : ?>

		<a href="#" id="mark_as_read"><?php _ex('Mark as Read', 'Message management markup', 'boss') ?></a> &nbsp;
		<a href="#" id="mark_as_unread"><?php _ex('Mark as Unread', 'Message management markup', 'boss') ?></a> &nbsp;

	<?php endif; ?>

	<a href="#" id="delete_<?php echo bp_current_action(); ?>_messages" class="fa fa-trash"></a> &nbsp;

<?php
}

/**
 * Custom Walker for left panel menu
 * 
 * @since Boss 1.0.0
 *
 */
class BuddybossWalker extends Walker {
	/**
	 * What the class handles.
	 *
	 * @see Walker::$tree_type
	 * @since Boss 1.0.0
	 * @var string
	 */
	public $tree_type = array( 'post_type', 'taxonomy', 'custom' );

	/**
	 * Database fields to use.
	 *
	 * @see Walker::$db_fields
	 * @since Boss 1.0.0
	 * @todo Decouple this.
	 * @var array
	 */
	public $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @since Boss 1.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<div class='sub-menu-wrap'><ul class=\"sub-menu\">\n";
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 *
	 * @since Boss 1.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul></div>\n";
	}

	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 *
	 * @since Boss 1.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        
        $icon_class = 'fa-file';
        
        foreach ($item->classes as $key => $value) {
            if(substr($value,0,3)==='fa-' ) {
                $icon_class = $value;            
            }
            if(substr($value,0,2)==='fa' ) {
                unset($item->classes[$key]);             
            }
        }

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		/**
		 * Filter the CSS class(es) applied to a menu item's <li>.
		 *
		 * @since Boss 1.0.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's <li>.
		 *
		 * @since Boss 1.0.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param string $menu_id The ID that is applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		/**
		 * Filter the HTML attributes applied to a menu item's <a>.
		 *
		 * @since Boss 1.0.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's <a>, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item The current menu item.
		 * @param array  $args An array of wp_nav_menu() arguments.
		 */

        $archor_classes = ($item->menu_item_parent === '0')?'class="' . esc_attr( $icon_class ) . '"':'';
        
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .' '. $archor_classes .'>';
		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filter a menu item's starting output.
		 *
		 * The menu item's starting output only includes $args->before, the opening <a>,
		 * the menu item's title, the closing </a>, and $args->after. Currently, there is
		 * no filter for modifying the opening and closing <li> for a menu item.
		 *
		 * @since Boss 1.0.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @see Walker::end_el()
	 *
	 * @since Boss 1.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Page data object. Not used.
	 * @param int    $depth  Depth of page. Not Used.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

} // Walker_Nav_Menu


/*
 * Removing the create a group button from under the title
 *
 * @since Boss 1.0.0
 */
function buddyboss_remove_group_create_button() {
	if ( bp_is_active( 'groups' ) ) {
		remove_filter( 'bp_groups_directory_header', 'bp_legacy_theme_group_create_button' );
	}
}
add_action("bp_init","buddyboss_remove_group_create_button");


/*
 * Places content bellow title on dir pages
 *
 * @since Boss 1.0.0
 */
function inject_content() {
    global $bp;
    if ( bp_is_directory() )
    {
      foreach ( (array) $bp->pages as $page_key => $bp_page )
      {
          
        if ( $bp_page->slug == bp_current_component() )
        {
            $page_id = $bp_page->id;

            $page_query = new WP_query( array(
                'post_type' => 'page',
                'page_id' => $page_id
            ) );

            while( $page_query->have_posts() )
            {
                $page_query->the_post();
                
                $custom_content = wpautop( get_the_content() );
            }

            wp_reset_postdata();
        }
      }
    }
    
    echo '<div class="entry-content">'.$custom_content.'</div>';
}

add_action( 'bp_before_directory_members_content', 'inject_content');
add_action( 'bp_before_directory_groups', 'inject_content');
add_action( 'bp_before_directory_blogs_content', 'inject_content');
add_action( 'bp_before_directory_activity_content', 'inject_content');

/*
 * Get title on dir pages
 *
 * @since Boss 1.0.0
 */
function buddyboss_page_title() {
    echo  buddyboss_get_page_title();
}

function buddyboss_get_page_title() {
    global $bp;
    
    $bp_title = get_the_title();
    
    if ( bp_is_directory() )
    {
      foreach ( (array) $bp->pages as $page_key => $bp_page )
      {
          
        if ( $bp_page->slug == bp_current_component() )
        {
            $page_id = $bp_page->id;

            $page_query = new WP_query( array(
                'post_type' => 'page',
                'page_id' => $page_id
            ) );

            while( $page_query->have_posts() )
            {
                $page_query->the_post();

                $custom_title = get_the_title();
            }

            wp_reset_postdata();
        }
      }
    }
    
    $pattern = '/([\s]*|&nbsp;)<a/im';

    // If we have a custom title and need to grab a BP title button
    if ( $custom_title != false && (int)preg_match( $pattern, $bp_title ) > 0 )
    {
        $token = md5('#b#u#d#d#y#b#o#s#s#');

        $bp_title_parsed = preg_replace( $pattern, $token, $bp_title );

        $bp_title_parts = explode( $token, $bp_title_parsed, 2 );

        $custom_title .= '&nbsp;<a' . $bp_title_parts[1];
    }
    
    $bp_title = get_the_title();
    
    if ( $custom_title === '' ) {
        $custom_title = $bp_title;
    }
    
    return $custom_title;
}

/**
 * Adds classes to body
 * 
 * @since Boss 1.0.0
 *
 */

add_filter( 'body_class','buddyboss_body_classes' );
function buddyboss_body_classes( $classes ) {
 
    // Default layout class    
    if(is_phone()) {
        $classes[] = 'is-mobile';  
    } elseif ( wp_is_mobile() ) {
        if(get_option('boss_layout_tablet') == 'desktop') {
            $classes[] = 'is-desktop';
        }  else {
            $classes[] = 'is-mobile';
        } 
        $classes[] = 'tablet';
    } else {
        if(get_option('boss_layout_desktop') == 'mobile') {
            $classes[] = 'is-mobile';
        }  else {
            $classes[] = 'is-desktop';
        }
    }
    
    // Switch layout class 
    if(isset($_COOKIE['switch_mode']) && (get_option( 'boss_layout_switcher' ) != 'no')){
        if($_COOKIE['switch_mode'] == 'mobile') {
            if (($key = array_search('is-desktop', $classes)) !== false) {
                unset($classes[$key]); 
            }
            $classes[] = 'is-mobile';
        } else {
            if (($key = array_search('is-mobile', $classes)) !== false) {
                unset($classes[$key]); 
            }
            $classes[] = 'is-desktop';
        }
    }
    
    
    // is bbpress active
    if (buddyboss_is_bp_active()) {
        $classes[] = 'bp-active';
    }
    
    // is panel active
    if(isset($_COOKIE['left-panel-status'])) {
        if($_COOKIE['left-panel-status'] == 'open') {
            $classes[] = 'left-menu-open';
        }
    } elseif(get_option( 'buddyboss_panel_state' ) != 'closed'){
        $classes[] = 'left-menu-open';
    }
	
	// is global media page
	if( function_exists( 'buddyboss_media' ) && buddyboss_media()->option('all-media-page') && is_page( buddyboss_media()->option('all-media-page') ) ){
		$classes[] = 'buddyboss-media-all-media';
	}
    
    //hide buddypanel
    if(get_option( 'buddyboss_panel_hide' ) == '0' && !is_user_logged_in()){
        $classes[] = 'page-template-page-no-buddypanel';
        $classes[] = 'left-menu-open';
    }
    if(is_page_template( 'page-no-buddypanel.php' )){
        $classes[] = 'left-menu-open';
    }
    
    return array_unique( $classes );
     
}


/**
 * Correct notification count in header notification
 * 
 * @since Boss 1.0.0
 *
 */
function buddyboss_js_correct_notification_count(){
	if( !is_user_logged_in() || !buddyboss_is_bp_active() || !function_exists("bp_notifications_get_all_notifications_for_user"))
		return;
	$notifications = bp_notifications_get_all_notifications_for_user( bp_loggedin_user_id() );
	if( !empty( $notifications ) ){
		$count = count( $notifications );
		?>
		<script type="text/javascript">
		jQuery('document').ready(function($){
			$('.header-notifications .notification-link span.alert').html('<?php echo $count;?>');
		});
		</script>
		<?php 
	}
}
add_action( 'wp_footer', 'buddyboss_js_correct_notification_count' );


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
                    $notification_content .= $notification;
               }
			if(empty($notification_content))
					$notification_content = '<a href="'.bp_loggedin_user_domain().''.BP_NOTIFICATIONS_SLUG.'/">'.__("No new notifications","buddypress").'</a>';
	   }
	   if(function_exists("messages_get_unread_count"))  
			$unread_message_count = messages_get_unread_count();
	   
	   $response['bb_notification_count'] = array(
            'friend_request' => @intval($friend_request_count),
            'notification' => @intval($notification_count),
            'notification_content' => @$notification_content,
            'unread_message' => @intval($unread_message_count)
        );
    
    return $response;
}
 
// Logged in users:
add_filter( 'heartbeat_received', 'buddyboss_notification_count_heartbeat', 10, 3 );


/**
 * Add @handle to forum replies
 * 
 * @since Boss 1.0.0
 *
 */
function buddyboss_add_handle (){
    echo '<span class="bbp-user-nicename"><span class="handle-sign">@</span>'. bp_core_get_username(bbp_get_reply_author_id(bbp_get_reply_id())) .'</span>' ;
}

add_action( 'bbp_theme_after_reply_author_details', 'buddyboss_add_handle' );


/*
* Resize images dynamically using wp built in functions
*
*
* Example:
*
* <?php
* $thumb = get_post_thumbnail_id();
* $image = buddyboss_resize( $thumb, '', 140, 110, true );
* ?>
* <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
*
* @param int $attach_id
* @param string $img_url
* @param int $width
* @param int $height
* @param bool $crop
* @return array
*/
if ( ! function_exists( 'buddyboss_resize' ) ) {
	function buddyboss_resize( $attach_id = null, $img_url = null, $ratio = null, $width = null, $height = null, $crop = false ) {
		// Cast $width and $height to integer
		$width = intval( $width );
		$height = intval( $height );
		// this is an attachment, so we have the ID
		if ( $attach_id ) {
			$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
			$file_path = get_attached_file( $attach_id );
		// this is not an attachment, let's use the image url
		} else if ( $img_url ) {
			if ( false === ( $upload_dir = wp_cache_get( 'upload_dir', 'cache' ) ) ) {
				$upload_dir = wp_upload_dir();
				wp_cache_set( 'upload_dir', $upload_dir, 'cache' );
			}
			$file_path = explode($upload_dir['baseurl'],$img_url);
			$file_path = $upload_dir['basedir'] . $file_path['1'];
			//$file_path = ltrim( $file_path['path'], '/' );
			//$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];
			$orig_size = getimagesize( $file_path );
			$image_src[0] = $img_url;
			$image_src[1] = $orig_size[0];
			$image_src[2] = $orig_size[1];
		}
		$file_info = pathinfo( $file_path );
		// check if file exists
		if ( empty( $file_info['dirname'] ) && empty( $file_info['filename'] ) && empty( $file_info['extension'] )  )
			return;
		
		$base_file = $file_info['dirname'].'/'.$file_info['filename'].'.'.$file_info['extension'];
		if ( !file_exists($base_file) )
			return;
		$extension = '.'. $file_info['extension'];
		// the image path without the extension
		$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];
		$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;
		// checking if the file size is larger than the target size
		// if it is smaller or the same size, stop right here and return

        if ( file_exists( $cropped_img_path ) ) {
            $cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
            $vt_image = array (
                'url' => $cropped_img_url,
                'width' => $width,
                'height' => $height
            );
            return $vt_image;
        }


        // Check if GD Library installed
        if ( ! function_exists ( 'imagecreatetruecolor' ) ) {
            echo 'GD Library Error: imagecreatetruecolor does not exist - please contact your web host and ask them to install the GD library';
            return;
        }
        // no cache files - let's finally resize it
        $image = wp_get_image_editor( $file_path );
        if ( ! is_wp_error( $image ) ) {
            
            if($ratio) {
                $size_array = $image->get_size();
                $width = $size_array['width'];
                $old_height = $size_array['height'];
                $height = intval($width/$ratio);
                
                if($height > $old_height) {
                    $width = $old_height*$ratio;
                    $height = $old_height;
                }
            }
            
            $image->resize( $width, $height, $crop );
            $save_data = $image->save();
            if ( isset( $save_data['path'] ) ) $new_img_path = $save_data['path'];
        }

        $new_img_size = getimagesize( $new_img_path );
        $new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );
        // resized output
        $vt_image = array (
            'url' => $new_img,
            'width' => $new_img_size[0],
            'height' => $new_img_size[1]
        );
        return $vt_image;

	}
}

/**
 * Sensei plugin wrappers
 * 
 * @since Boss 1.0.9
 *
 */    

global $woothemes_sensei;
if($woothemes_sensei) {
    remove_action( 'sensei_before_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper' ), 10 );
    remove_action( 'sensei_after_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper_end' ), 10 );

    if ( ! function_exists( 'boss_education_wrapper_start' ) ) :
        add_action('sensei_before_main_content', 'boss_education_wrapper_start', 10);
        function boss_education_wrapper_start() {
            if ( is_active_sidebar('sidebar') ) :
                echo '<div class="page-right-sidebar">';
            else : 
                echo '<div class="page-full-width">';
            endif;
            echo '<div id="primary" class="site-content"><div id="content" role="main" class="sensei-content">';
        }
    endif;

    if ( ! function_exists( 'boss_education_wrapper_end' ) ) :
        add_action('sensei_after_main_content', 'boss_education_wrapper_end', 10);
        function boss_education_wrapper_end() {
            echo '</div><!-- #content -->
            </div><!-- #primary -->';
            get_sidebar();
            echo '</div><!-- .page-right-sidebar -->';
        }
    endif;
}
/**
 * Declaring Sensei Support
 * 
 * @since Boss 1.1.0
 *
 */ 
add_action( 'after_setup_theme', 'declare_sensei_support' );
function declare_sensei_support() {
    add_theme_support( 'sensei' );
}

/**
 * Header cart live update
 * 
 * @since Boss 1.1.0
 *
 */
add_filter('add_to_cart_fragments', 'woo_add_to_cart_ajax');
function woo_add_to_cart_ajax( $fragments ) {
    global $woocommerce;
    ob_start();
    $cart_items = $woocommerce->cart->cart_contents_count;
    ?>
        <a class="cart-notification notification-link fa fa-shopping-cart" href="<?php echo $woocommerce->cart->get_cart_url(); ?>">        
            <?php if($cart_items) { ?>
                <span><?php echo $cart_items; ?></span>
            <?php } ?>
        </a>
    <?php
    $fragments['a.cart-notification'] = ob_get_clean();
    return $fragments;
}
 
/**
 * Removing woocomerce function that disables adminbar for subsribers
 * 
 * @since Boss 1.1.4
 *
 */
remove_filter( 'show_admin_bar', 'wc_disable_admin_bar' );


add_action('boss_get_group_template', 'boss_get_group_template'); 

function boss_get_group_template(){
    get_template_part( 'buddypress', 'group-single' );
}

/**
 * Add image size for cover photo.
 *
 * @since Boss 1.1.7
 */
if ( ! function_exists( 'boss_cover_thumbnail' ) ) :

add_action( 'after_setup_theme', 'boss_cover_thumbnail' );

function boss_cover_thumbnail() {
    add_image_size( 'boss-cover-image', 1500, 500, true );
}

/**
 * Buddyboss inbox layout support
 */
function boss_bb_inbox_selectbox() {
	if ( function_exists( 'bbm_inbox_pagination' ) ) {
		remove_action( 'bp_before_member_messages_threads', 'bbm_inbox_pagination',99 );
	}
}
add_action('wp','boss_bb_inbox_selectbox');

/**
 * Overriding BB Inbox templates
 * @global type $buddyboss
 * @param type $temp_dir
 */
function boss_bb_inbox_templates_override($temp_dir) {
	global $buddyboss;
	$bbm_temp_dir = $buddyboss->tpl_dir.'/buddyboss-inbox';
	
	return trailingslashit($bbm_temp_dir);
}
add_filter('bbm_templates_dir_filter','boss_bb_inbox_templates_override');

/**
 * Overriding BB Inbox Label button html
 * @param type $html
 * @return string
 */
function bbm_label_button_html_override($html) {
	$new_html = '<a class="bbm-label-button" href="javascript:void(0)">';
	$new_html .= '<span class="hida"><i class="fa fa-tag"></i></span>';
	$new_html .= '<p class="multiSel"></p></a>';
	
	return $new_html;
}
add_filter('bbm_label_button_html','bbm_label_button_html_override');

/**
 * Woocommerce pages markup
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', 'buddyboss_theme_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'buddyboss_theme_wrapper_end', 10 );

function buddyboss_theme_wrapper_start() {
	if ( is_active_sidebar('woo_sidebar') && function_exists('is_shop') && is_shop() ) {
		echo '<div class="page-right-sidebar">';
	} else {
		echo '<div class="page-full-width">';
	}
	
	echo '<div id="primary" class="site-content"><div id="woo-content" role="main">';
}

function buddyboss_theme_wrapper_end() {
	echo '</div><!-- #content --></div>';
}

endif;


/**
 * Stops saving slides if there is no featured image 
 * @param String $new_status
 * @param String $old_status 
 * @param String $post       
 */

if(!function_exists('buddyboss_guard')):

function buddyboss_guard( $new_status, $old_status, $post ) {
    if ( $new_status === 'publish' 
        && !buddyboss_should_let_post_publish( $post ) 
       ) {
        wp_die( __( 'You cannot publish without a featured image.', 'buddyboss' ) );
    }
}
add_action( 'transition_post_status', 'buddyboss_guard', 10, 3 );

endif;

function buddyboss_should_let_post_publish( $post ) {
    $has_featured_image = has_post_thumbnail( $post->ID );
    $is_watched_post_type = in_array( $post->post_type, array("buddyboss_slides") );
    $is_after_enforcement_time = strtotime( $post->post_date ) > (time() - ( 86400*14 ));
    
    if ( $is_after_enforcement_time && $is_watched_post_type ) {
        return $has_featured_image;
    }
    return true;
}

