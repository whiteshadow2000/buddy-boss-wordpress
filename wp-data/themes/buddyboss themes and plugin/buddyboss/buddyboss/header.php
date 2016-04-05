<?php
/**
 * The Header for your theme.
 *
 * Displays all of the <head> section and everything up until <div id="main">
 *
 * @package WordPress
 * @subpackage BuddyBoss
 * @since BuddyBoss 3.0
 */
?><!DOCTYPE html>
<!--[if lt IE 9 ]>
<html class="ie ie-legacy" <?php language_attributes(); ?>> <![endif]-->
<!--[if gte IE 9 ]><!-->
<html class="ie" <?php language_attributes(); ?>>
<!--<![endif]-->
<!--[if ! IE  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="msapplication-tap-highlight" content="no"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico" type="image/x-icon">
<!-- BuddyPress and bbPress Stylesheets are called in wp_head, if plugins are activated -->
<?php wp_head(); ?>
</head>

<body <?php if ( current_user_can('manage_options') ) : ?>id="role-admin"<?php endif; ?> <?php body_class(); ?>>

<?php do_action( 'buddyboss_before_header' ); ?>

<header id="masthead" class="site-header" role="banner" data-infinite="<?php echo (esc_attr(get_option('buddyboss_activity_infinite')) !== 'off')?'on':'off'; ?>">

	<div class="header-inner">

        <!-- Look for uploaded logo -->
        <?php if ( get_theme_mod( 'buddyboss_logo' ) ) : ?>
            <div id="logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo esc_url( get_theme_mod( 'buddyboss_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
            </div>

        <!-- If no logo, display site title and description -->
        <?php else: ?>
            <div class="site-name">
                <h1 class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                </h1>
                <p class="site-description"><?php bloginfo( 'description' ); ?></p>
            </div>
        <?php endif; ?>

        <!-- Register/Login links for logged out users -->
        <?php if ( !is_user_logged_in() && buddyboss_is_bp_active() && !bp_hide_loggedout_adminbar( false ) ) : ?>

            <div class="header-account">
                <?php if ( buddyboss_is_bp_active() && bp_get_signup_allowed() ) : ?>
                    <a href="<?php echo bp_get_signup_page(); ?>"><?php _e( 'Register', 'buddyboss' ); ?></a>
                <?php endif; ?>

                <a href="<?php echo wp_login_url(); ?>" class="button"><?php _e( 'Login', 'buddyboss' ); ?></a>
            </div>

        <?php endif; ?>

	</div>

	<nav id="site-navigation" class="main-navigation" role="navigation">
		<div class="nav-inner">

			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'buddyboss' ); ?>"><?php _e( 'Skip to content', 'buddyboss' ); ?></a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'nav-menu clearfix' ) ); ?>
		</div>
	</nav><!-- #site-navigation -->
</header><!-- #masthead -->

<?php do_action( 'buddyboss_after_header' ); ?>

<div id="mobile-header"> <!-- Toolbar for Mobile -->
    <div class="mobile-header-inner">
        <!-- Left button -->
        <?php if ( is_user_logged_in() || ( !is_user_logged_in() && buddyboss_is_bp_active() && !bp_hide_loggedout_adminbar( false ) ) ) : ?>
            <div id="user-nav" class="left-btn"></div>
        <?php endif; ?>
        <!-- Right button -->
            <div id="main-nav" class="right-btn"></div>
    </div>
    <h1><a class="mobile-site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
</div><!-- #mobile-header -->

<div id="main-wrap"> <!-- Wrap for Mobile content -->
    <div id="inner-wrap"> <!-- Inner Wrap for Mobile content -->
    	<?php do_action( 'buddyboss_inside_wrapper' ); ?>
        <div id="page" class="hfeed site">
            <div id="main" class="wrapper">
