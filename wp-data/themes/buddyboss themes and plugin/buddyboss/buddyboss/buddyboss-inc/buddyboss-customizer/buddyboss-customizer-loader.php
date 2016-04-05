<?php
/**
 * @package WordPress
 * @subpackage BuddyBoss
 * @since BuddyBoss 3.1
 */

/**
 * TABLE OF CONTENTS
 * ************************************************************
 * 1 - INIT FUNCTIONS
 * 2 - CUSTOMIZER OPTIONS
 * 3 - CUSTOMIZER UTILITY FUNCTIONS
 * 4 - CUSTOMIZER CSS OUPUT
 */


/*************************************************************
 * 1 - INIT FUNCTIONS
 */

/**
 * Load customizer javascript
 *
 * @since  BuddyBoss 3.1
 */

function buddyboss_customizer_live_preview() {
 	// load script in Preview only
    wp_enqueue_script( 'buddyboss-theme-customizer', get_template_directory_uri() . '/buddyboss-inc/buddyboss-customizer/js/buddyboss-customizer.js', array( 'jquery', 'customize-preview' ), '4.0.5', true );

}
add_action( 'customize_preview_init', 'buddyboss_customizer_live_preview' );

/*************************************************************
 * 2 - CUSTOMIZER OPTIONS
 */

/**
 * Sets up theme customizer
 *
 * @since  BuddyBoss 3.1
 */

function buddyboss_customize_register( $wp_customize ) {


	/****************************** LOGO ******************************/

	/**
	 * Add Logo Section
	 * Replaces old logo upload from Appearance > BuddyBoss
	 * @since BuddyBoss 3.1
	 */

	$wp_customize->add_section( 'buddyboss_logo_section' , array(
	    'title'       => __( 'Logo', 'buddyboss' ),
	    'priority'    => 30,
	    'description' => __( 'Upload logo in place of site title and tagline.', 'buddyboss' ),
	) );


		// Logo Upload
		$wp_customize->add_setting( 'buddyboss_logo', array( 
			'transport'			=> 'postMessage', 
			'sanitize_callback'	=> 'buddyboss_customizer_fix_logo_url' 
		) );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'buddyboss_logo', array(
		    'label'    => __( 'Logo', 'buddyboss' ),
		    'section'  => 'buddyboss_logo_section',
		    'settings' => 'buddyboss_logo',
		) ) );


	/****************************** ADMIN BAR ******************************/

	/**
	 * Add Toolbar Section
	 * @since BuddyBoss 3.1.1
	 */

	$wp_customize->add_section( 'buddyboss_adminbar_section' , array(
	    'title'       => __( 'WordPress Toolbar', 'buddyboss' ),
	    'priority'    => 40,
	    'description' => __( 'Dock a full-width Toolbar to the top of the page, or float it to the right.', 'buddyboss' ),
	) );

		// Toolbar layout
		$wp_customize->add_setting( 'boss_adminbar_layout', array(
	        'default'   		=> 'fixed',
	        'sanitize_callback' => 'buddyboss_sanitize_adminbar_dropdown'
		) );
		$wp_customize->add_control( 'boss_adminbar_layout', array(
			'label'    => __( 'Toolbar Layout', 'buddyboss' ),
			'section'  => 'buddyboss_adminbar_section',
			'priority' => 1,
			'type'     => 'select',
			'choices'  => array(
				'fixed'		=> 'Full Width',
				'floating'	=> 'Float Right'
			)
		) );


	/****************************** COLORS > LAYOUT ******************************/

	/**
	 * Add Colors > Layout Section
	 * @since BuddyBoss 3.1
	 */

	$wp_customize->add_section( 'boss_colors_layout_section' , array(
	    'title'       => __( 'Colors &rarr; Layout', 'buddyboss' ),
	    'priority'    => 50,
	    'description' => __( 'Select your color scheme. To preview in mobile, just collapse the width of this browser window.', 'buddyboss' ),
	) );

		// Toolbar Background Color
		$wp_customize->add_setting( 'boss_adminbar_bg_color', array(
		        'default'   		=> '#555',
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option'
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_adminbar_bg_color', array(
			    'label'      		=> __( 'WordPress Toolbar', 'buddyboss' ),
			    'section'    		=> 'boss_colors_layout_section',
			    'settings'   		=> 'boss_adminbar_bg_color',
			    'priority'    		=> 1
			) ) );

		// Header Background Color
		$wp_customize->add_setting( 'boss_header_bg_color', array(
		        'default'   		=> '#fff',
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option'
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_header_bg_color', array(
			    'label'      		=> __( 'Header', 'buddyboss' ),
			    'section'    		=> 'boss_colors_layout_section',
			    'settings'   		=> 'boss_header_bg_color',
			    'priority'    		=> 2
			) ) );

		// Navigation Color
		$wp_customize->add_setting( 'boss_navigation_color', array(
		        'default'   		=> '#1db4da',
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_navigation_color', array(
			    'label'  	    	=> __( 'Navigation', 'buddyboss' ),
			    'section'    		=> 'boss_colors_layout_section',
			    'settings'  	 	=> 'boss_navigation_color',
			    'priority'  	  	=> 3
			) ) );

		// Links & Buttons Color
		$wp_customize->add_setting( 'boss_links_color', array(
		        'default'   		=> '#1db4da',
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_links_color', array(
			    'label'  	    	=> __( 'Links &amp; Buttons', 'buddyboss' ),
			    'section'    		=> 'boss_colors_layout_section',
			    'settings'  	 	=> 'boss_links_color',
			    'priority'  	  	=> 4
			) ) );

		// Icons & Indicators Color
		$wp_customize->add_setting( 'boss_icon_color', array(
		        'default'   		=> '#1db4da',
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'          	=> 'option'
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_icon_color', array(
			    'label'  	    	=> __( 'Icons & Indicators', 'buddyboss' ),
			    'section'   		=> 'boss_colors_layout_section',
			    'settings'   		=> 'boss_icon_color',
			    'priority'   	 	=> 5
			) ) );

		// Body Background Color
		$wp_customize->add_setting( 'boss_body_bg_color', array(
		        'default'   		=> '#fff',
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_body_bg_color', array(
			    'label'      		=> __( 'Background (large screens)', 'buddyboss' ),
			    'section'    		=> 'boss_colors_layout_section',
			    'settings'   		=> 'boss_body_bg_color',
			    'priority'   	 	=> 6
			) ) );

		// 1st Footer Background Color
		$wp_customize->add_setting( 'boss_footer_top_bg_color', array(
		        'default'   		=> '#f5f6f7',
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option'
		    ) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control( $wp_customize, 'boss_footer_top_bg_color', array(
			    'label'    	 	 	=> __( 'Footer #1 (widget area)', 'buddyboss' ),
			    'section'    		=> 'boss_colors_layout_section',
			    'settings'  	 	=> 'boss_footer_top_bg_color',
			    'priority'  	  	=> 7
			) ) );

		// 2nd Footer Background Color
		$wp_customize->add_setting( 'boss_footer_bottom_bg_color', array(
		        'default'   		=> '#242424',
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option'
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_footer_bottom_bg_color', array(
			    'label'      		=> __( 'Footer #2', 'buddyboss' ),
			    'section'    		=> 'boss_colors_layout_section',
			    'settings'   		=> 'boss_footer_bottom_bg_color',
			    'priority'   	 	=> 8
			) ) );

	/****************************** COLORS > TEXT ******************************/

	/**
	 * Add Colors > Text Section
	 * @since BuddyBoss 3.1
	 */

	$wp_customize->add_section( 'boss_colors_text_section' , array(
	    'title'       => __( 'Colors &rarr; Text', 'buddyboss' ),
	    'priority'    => 60,
	    'description' => __( 'Text color options. To preview in mobile, just collapse the width of this browser window.', 'buddyboss' ),
	) );

		// Site Title & Tagline Color
		$wp_customize->add_setting( 'boss_site_title_color', array(
		        'default'   		=> '#666',
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option'
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_site_title_color', array(
			    'label'      		=> __( 'Site Title &amp; Tagline', 'buddyboss' ),
			    'section'    		=> 'boss_colors_text_section',
			    'settings'   		=> 'boss_site_title_color',
			    'priority'    		=> 1
			) ) );

		// Slideshow Text Color
		$wp_customize->add_setting( 'boss_slideshow_font_color', array(
		        'default'   		=> '#fff',
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option'
	    	) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_slideshow_font_color', array(
			    'label'     		=> __( 'Slide Titles', 'buddyboss' ),
			    'section'   		=> 'boss_colors_text_section',
			    'settings'  		=> 'boss_slideshow_font_color',
			    'priority'  	  	=> 2
			) ) );

		// Heading Text Color

		$wp_customize->add_setting( 'boss_heading_font_color', array(
		        'default'   		=> '#555',
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option'
	    	) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_heading_font_color', array(
			    'label'     		=> __( 'Headings', 'buddyboss' ),
			    'section'   		=> 'boss_colors_text_section',
			    'settings'  		=> 'boss_heading_font_color',
			    'priority'  	  	=> 3
			) ) );

		// Body Text Color
		$wp_customize->add_setting( 'boss_body_font_color', array(
		        'default'   		=> '#333',
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option'
	    	) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_body_font_color', array(
			    'label'     		=> __( 'Body Content', 'buddyboss' ),
			    'section'   		=> 'boss_colors_text_section',
			    'settings'  		=> 'boss_body_font_color',
			    'priority'  	  	=> 4
			) ) );

	/****************************** TYPOGRAPHY ******************************/

	/**
	 * Add Typography Section
	 * @since BuddyBoss 3.1
	 */

	$wp_customize->add_section( 'buddyboss_body_font_section' , array(
	    'title'       => __( 'Typography', 'buddyboss' ),
	    'priority'    => 70,
	    'description' => __( 'Select your desired fonts.', 'buddyboss' ),
	) );

		// Site Title Font
		$wp_customize->add_setting( 'boss_site_title_font_family', array(
	        'default'   		=> 'helvetica',
	        'transport' 		=> 'postMessage',
	        'sanitize_callback' => 'buddyboss_sanitize_font_dropdown'
		) );
		$wp_customize->add_control( 'boss_site_title_font_family', array(
			'label'    => __( 'Site Title', 'buddyboss' ),
			'section'  => 'buddyboss_body_font_section',
			'priority' => 1,
			'type'     => 'select',
			'choices'  => buddyboss_customizer_default_fonts()
		) );

		// Slideshow Title Font
		$wp_customize->add_setting( 'boss_slideshow_font_family', array(
	        'default'   		=> 'helvetica',
	        'transport' 		=> 'postMessage',
	        'sanitize_callback' => 'buddyboss_sanitize_font_dropdown'
		) );
		$wp_customize->add_control( 'boss_slideshow_font_family', array(
			'label'    => __( 'Slide Titles', 'buddyboss' ),
			'section'  => 'buddyboss_body_font_section',
			'priority' => 2,
			'type'     => 'select',
			'choices'  => buddyboss_customizer_default_fonts()
		) );

		// Heading Font
		$wp_customize->add_setting( 'boss_heading_font_family', array(
	        'default'   		=> 'opensans',
	        'transport' 		=> 'postMessage',
	        'sanitize_callback' => 'buddyboss_sanitize_font_dropdown'
		) );
		$wp_customize->add_control( 'boss_heading_font_family', array(
			'label'    => __( 'Headings', 'buddyboss' ),
			'section'  => 'buddyboss_body_font_section',
			'priority' => 3,
			'type'     => 'select',
			'choices'  => buddyboss_customizer_default_fonts()
		) );

		// Body Font
		$wp_customize->add_setting( 'boss_body_font_family', array(
	        'default'   		=> 'opensans',
	        'transport' 		=> 'postMessage',
	        'sanitize_callback' => 'buddyboss_sanitize_font_dropdown'
		) );
		$wp_customize->add_control( 'boss_body_font_family', array(
			'label'    => __( 'Body Content', 'buddyboss' ),
			'section'  => 'buddyboss_body_font_section',
			'priority' => 4,
			'type'     => 'select',
			'choices'  => buddyboss_customizer_default_fonts()
		) );


	/****************************** SOCIAL MEDIA LINKS ******************************/

	/**
	 * Add Social Media Links Section
	 * @since BuddyBoss 3.1
	 */

	$wp_customize->add_section( 'buddyboss_social_section' , array(
	    'title'       => __( 'Social Media Links', 'buddyboss' ),
	    'priority'    => 80,
	    'description' => __( 'Social media links will display in the footer after you click Save &amp; Publish.', 'buddyboss' ),
	) );

		// Facebook
		$wp_customize->add_setting( 'boss_link_facebook', array(
		       	'default' 			=> '',
		       	'sanitize_callback' => 'buddyboss_sanitize_text'
		    ) );
	    $wp_customize->add_control( 'boss_link_facebook', array(
		        'label'   			=> __( 'Facebook', 'buddyboss' ),
		        'section' 			=> 'buddyboss_social_section',
		        'type'    			=> 'text',
		        'priority'    		=> 1
		    ) );

		// Twitter
		$wp_customize->add_setting( 'boss_link_twitter', array(
		       	'default' 			=> '',
		       	'sanitize_callback' => 'buddyboss_sanitize_text'
		    ) );
	    $wp_customize->add_control( 'boss_link_twitter', array(
		        'label'   			=> __( 'Twitter', 'buddyboss' ),
		        'section' 			=> 'buddyboss_social_section',
		        'type'    			=> 'text',
		        'priority'    		=> 2
		    ) );

		// LinkedIn
		$wp_customize->add_setting( 'boss_link_linkedin', array(
		       	'default' 			=> '',
		       	'sanitize_callback' => 'buddyboss_sanitize_text'
		    ) );
	    $wp_customize->add_control( 'boss_link_linkedin', array(
		        'label'   			=> __( 'LinkedIn', 'buddyboss' ),
		        'section' 			=> 'buddyboss_social_section',
		        'type'    			=> 'text',
		        'priority'    		=> 3
		    ) );

		// Google+
		$wp_customize->add_setting( 'boss_link_googleplus', array(
		       	'default' 			=> '',
		       	'sanitize_callback' => 'buddyboss_sanitize_text'
		    ) );
	    $wp_customize->add_control( 'boss_link_googleplus', array(
		        'label'   			=> __( 'Google+', 'buddyboss' ),
		        'section' 			=> 'buddyboss_social_section',
		        'type'    			=> 'text',
		        'priority'    		=> 4
		    ) );

		// Youtube
		$wp_customize->add_setting( 'boss_link_youtube', array(
		       	'default' 			=> '',
		       	'sanitize_callback' => 'buddyboss_sanitize_text'
		    ) );
	    $wp_customize->add_control( 'boss_link_youtube', array(
		        'label'   			=> __( 'Youtube', 'buddyboss' ),
		        'section' 			=> 'buddyboss_social_section',
		        'type'    			=> 'text',
		        'priority'    		=> 5
		    ) );

		// Instagram
		$wp_customize->add_setting( 'boss_link_instagram', array(
		       	'default' 			=> '',
		       	'sanitize_callback' => 'buddyboss_sanitize_text'
		    ) );
	    $wp_customize->add_control( 'boss_link_instagram', array(
		        'label'   			=> __( 'Instagram', 'buddyboss' ),
		        'section' 			=> 'buddyboss_social_section',
		        'type'    			=> 'text',
		        'priority'    		=> 6
		    ) );

		// Pinterest
		$wp_customize->add_setting( 'boss_link_pinterest', array(
		       	'default' 			=> '',
		       	'sanitize_callback' => 'buddyboss_sanitize_text'
		    ) );
	    $wp_customize->add_control( 'boss_link_pinterest', array(
		        'label'   			=> __( 'Pinterest', 'buddyboss' ),
		        'section' 			=> 'buddyboss_social_section',
		        'type'    			=> 'text',
		        'priority'    		=> 7
		    ) );

		// Email Address
		$wp_customize->add_setting( 'boss_link_email', array(
		       	'default' 			=> '',
		       	'sanitize_callback' => 'buddyboss_sanitize_text'
		    ) );
	    $wp_customize->add_control( 'boss_link_email', array(
		        'label'   			=> __( 'Email Address', 'buddyboss' ),
		        'section' 			=> 'buddyboss_social_section',
		        'type'    			=> 'text',
		        'priority'    		=> 8
		    ) );
    
    
	/****************************** Activity ******************************/

	/**
	 * Add Activitys Section
	 * @since BuddyBoss 3.1
	 */

	$wp_customize->add_section( 'buddyboss_activity_section' , array(
	    'title'       => __( 'Activity', 'buddyboss' ),
	    'priority'    => 90
	) );
    
     
		// Disable Activity Infinite Scroll
		$wp_customize->add_setting( 'buddyboss_activity_infinite', array(
		        'default'   		=> 'on',
		        'transport' 		=> 'postMessage',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( 'buddyboss_activity_infinite', array(
            'label'  	    	=> __( 'Allow Infinite Scrolling', 'boss' ),
            'section'    		=> 'buddyboss_activity_section',
            'settings'  	 	=> 'buddyboss_activity_infinite',
            'type'              => 'radio',
            'choices'           => array('on'=>'Enabled', 'off'=>'Disabled'),
            'priority'  	  	=> 1
        ) ); 



} // End Of BuddyBoss Customizer Function

add_action( 'customize_register', 'buddyboss_customize_register' );


/*************************************************************
 * 3 - CUSTOMIZER UTILITY FUNCTIONS
 */

/**
 * Returns default fonts
 *
 * @since  BuddyBoss 3.1
 */

function buddyboss_customizer_default_fonts() {
	// Websafe font reference: http://www.w3schools.com/cssref/css_websafe_fonts.asp
	return array(
		'opensans'  => 'Open Sans',
		'arial'     => 'Arial',
		'helvetica' => 'Helvetica',
		'verdana'   => 'Verdana',
		'lucida'    => 'Lucida Sans Unicode',
		'trebuchet' => 'Trebuchet MS',
		'tahoma'    => 'Tahoma',
		'georgia'   => 'Georgia',
		'palatino'  => 'Palatino Linotype',
		'times'     => 'Times New Roman',
		'courier'   => 'Courier New'
	);
}

/**
 * Sanitize font dropdown data
 * @param  [type] $input [description]
 * @return [type]        [description]
 *
 * @since  BuddyBoss 3.1
 */

function buddyboss_sanitize_font_dropdown( $input ) {
    $valid = buddyboss_customizer_default_fonts();

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Get font stack for font key and escapes data
 * @param  [type] $fontkey [description]
 * @return [type]        [description]
 *
 * @since  BuddyBoss 3.1
 */

function buddyboss_get_fontstack( $fontkey ) {
    $fonts = buddyboss_customizer_default_fonts();
    $key = get_theme_mod( $fontkey );

    if ( ! empty( $key ) && ! empty( $fonts[ $key ] ) ) {
        return "'" . esc_attr( $fonts[ $key ] ) . "', sans-serif";
    } else {
        return "'Open Sans', sans-serif";
    }
}

/**
 * Sanitize text input data
 * @since  BuddyBoss 3.1
 */
function buddyboss_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}


/**
 * Sanitize adminbar dropdown data
 * @param  [type] $input [description]
 * @return [type]        [description]
 *
 * @since  BuddyBoss 3.1.1
 */

function buddyboss_sanitize_adminbar_dropdown( $input ) {
	$valid = array(
		'fixed'		=> 'Full Width',
		'floating'	=> 'Float Right'
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}


/*************************************************************
 * 4 - CUSTOMIZER CSS OUPUT
 */

// Custom CSS For Customizer
function buddyboss_customizer_css() { ?>

	 <style type="text/css">

		/* Header Background color */
		.site-header {
			background-color: <?php echo esc_attr( get_option( 'boss_header_bg_color' ) ); ?>;
		}

		/* Links & Buttons color */
		a {
			color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
		}
		button,
		input[type="submit"],
		input[type="button"],
		input[type="reset"],
		article.post-password-required input[type=submit],
		a.comment-reply-link,
		a.comment-edit-link,
		li.bypostauthor cite span,
		a.button, #buddypress ul.button-nav li a,
		#buddypress div.generic-button a,
		#buddypress .comment-reply-link,
		.entry-header .entry-title a.button,
		a.bp-title-button,
		#buddypress div.activity-comments form input[disabled] {
			background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
		}

		/* Heading Text color */
		h1, h2, h3, h4, h5, h6 {
			color: <?php echo esc_attr( get_option( 'boss_heading_font_color' ) ); ?>;
		}

		/* Site Title & Tagline color */
		.site-header h1.site-title,
		.site-header h1.site-title a,
		.site-header p.site-description {
			color: <?php echo esc_attr( get_option( 'boss_site_title_color' ) ); ?>;
		}

		/* Slideshow Text color */
		#fwslider .title,
		#fwslider .description {
			color: <?php echo esc_attr( get_option( 'boss_slideshow_font_color' ) ); ?>;
		}

		/* Icons & Indicators color */
		#fwslider .progress,
		#fwslider .readmore a,
		.pagination .current,
		.bbp-pagination-links span {
			background-color: <?php echo esc_attr( get_option( 'boss_icon_color' ) ); ?>;
		}
		.bbp-topics-front ul.super-sticky div.bbp-topic-title-content:before,
		.bbp-topics ul.super-sticky div.bbp-topic-title-content:before,
		.bbp-topics ul.sticky div.bbp-topic-title-content:before,
		.bbp-forum-content ul.sticky:before {
			color: <?php echo esc_attr( get_option( 'boss_icon_color' ) ); ?>;
		}

		/* 1st Footer Background Color */
		div.footer-inner-top {
			background-color: <?php echo esc_attr( get_option( 'boss_footer_top_bg_color' ) ); ?>;
		}

		/* 2nd Footer Background Color */
		div.footer-inner-bottom {
			background-color: <?php echo esc_attr( get_option( 'boss_footer_bottom_bg_color' ) ); ?>;
		}

		/* Body Text color */
		body {
			color: <?php echo esc_attr( get_option( 'boss_body_font_color' ) ); ?>;
		}

		/* Fonts */
		body {
			font-family: <?php echo buddyboss_get_fontstack( 'boss_body_font_family' ); ?>;
		}
		h1, h2, h3, h4, h5, h6 {
			font-family: <?php echo buddyboss_get_fontstack( 'boss_heading_font_family' ); ?>;
		}
		.site-header h1.site-title {
			font-family: <?php echo buddyboss_get_fontstack( 'boss_site_title_font_family' ); ?>;
		}
		#fwslider .slide .title {
			font-family: <?php echo buddyboss_get_fontstack( 'boss_slideshow_font_family' ); ?>;
		}

		@media screen and (max-width: 720px) {

			/* Navigation color */
			#mobile-header {
				background-color: <?php echo esc_attr( get_option( 'boss_navigation_color' ) ); ?>;
			}
			/* Icons & Indicators color */
			#buddypress div.item-list-tabs ul li.current,
			#buddypress div.item-list-tabs ul li.selected,
			#buddypress div#group-create-tabs ul li.current,
			#buddypress div#group-create-tabs ul li.selected,
			#buddypress #mobile-item-nav ul li:active,
			#buddypress #mobile-item-nav ul li.current,
			#buddypress #mobile-item-nav ul li.selected,
			#buddypress .activity-list li.load-more a {
				background-color: <?php echo esc_attr( get_option( 'boss_icon_color' ) ); ?>;
			}
		}
		@media screen and (min-width: 721px) {

			/* WordPress Toolbar color */
			#wpadminbar,
			#wpadminbar .ab-top-menu,
			#wpadminbar .ab-top-secondary,
			#wpadminbar .menupop .ab-sub-wrapper {
				background-color: <?php echo esc_attr( get_option( 'boss_adminbar_bg_color' ) ); ?>;
			}
			#wpadminbar #wp-admin-bar-bp-notifications > a > span {
				color: <?php echo esc_attr( get_option( 'boss_adminbar_bg_color' ) ); ?>;
			}

			/* Navigation color */
			.main-navigation,
			.main-navigation ul.nav-menu {
				background-color: <?php echo esc_attr( get_option( 'boss_navigation_color' ) ); ?>;
			}

			/* Icons & Indicators color */
			#buddypress div#subnav.item-list-tabs ul li a span,
			#buddypress > div[role="navigation"].item-list-tabs ul li a span,
			#buddypress .dir-form div.item-list-tabs ul li a span,
			.bp-legacy div#item-body div.item-list-tabs ul li a span,
			#buddypress div#item-nav .item-list-tabs ul li a span {
				background-color: <?php echo esc_attr( get_option( 'boss_icon_color' ) ); ?>;
			}
			#buddyboss-media-add-photo-button {
				color: <?php echo esc_attr( get_option( 'boss_icon_color' ) ); ?>;
			}

			/* Body Background color */
			body #main-wrap {
				background-color: <?php echo esc_attr( get_option( 'boss_body_bg_color' ) ); ?>;
			}
		}
	 </style>

<?php
} // End BuddyBoss Customizer CSS

add_action( 'wp_head', 'buddyboss_customizer_css' );

/**
 * Returns the relative path of logo, i.e, /wp-content/uploads....
 * 
 * @param	string $url the absolute url of uploaded logo
 * @return	string		the relative url of the uploaded logo
 * @since	
 */
function buddyboss_customizer_fix_logo_url( $url ){
	/*$relative_url = str_replace( site_url(), '', $url );
	return $relative_url;*/
	return wp_make_link_relative($url);
}
?>