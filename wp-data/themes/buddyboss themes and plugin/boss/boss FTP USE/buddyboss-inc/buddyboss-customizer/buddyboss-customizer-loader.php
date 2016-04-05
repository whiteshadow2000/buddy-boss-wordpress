<?php
/**
 * @package WordPress
 * @subpackage Boss
 * @since Boss 1.0.0
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
 * @since Boss 1.0.0
 */

function buddyboss_customizer_live_preview() {
 	// load script in Preview only
    wp_enqueue_script( 'buddyboss-theme-customizer', get_template_directory_uri() . '/buddyboss-inc/buddyboss-customizer/buddyboss-customizer.js', array( 'jquery', 'customize-preview' ), '1.1.6', true );
}
add_action( 'customize_preview_init', 'buddyboss_customizer_live_preview' );

function buddyboss_customizer_admin_script() {
    // load fonts
    wp_enqueue_style( 'buddyboss-theme-customizer-fonts', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:600|Pacifico|Open+Sans:400|Lato:400|Arimo:400|Ubuntu:400|Montserrat:400|Raleway:400|Cabin:400|PT+Sans:400');
    
    wp_enqueue_script( 'buddyboss-theme-customizer-admin', get_template_directory_uri() . '/buddyboss-inc/buddyboss-customizer/admin/buddyboss-customizer-admin.js', array( 'jquery' ), '1.0.9' );
    $data = array( 'fonts' => buddyboss_customizer_default_fonts(), 'themes'=>buddyboss_customizer_themes_preset());
	wp_localize_script( 'buddyboss-theme-customizer-admin', 'BBOSS_THEME_CUSTOMIZER_ADMIN', $data );
    
    // admin style
    wp_enqueue_style( 'buddyboss-theme-customizer-admin-css', get_template_directory_uri().'/buddyboss-inc/buddyboss-customizer/admin/buddyboss-customizer-admin.css');

}
add_action( 'admin_enqueue_scripts', 'buddyboss_customizer_admin_script' );

/*************************************************************
 * 2 - CUSTOMIZER OPTIONS
 */

/**
 * Sets up theme customizer
 *
 * @since Boss 1.0.0
 */

function buddyboss_customize_register( $wp_customize ) {
    
    /**
    * Textarea customize control class.
    */
    class Textarea_Custom_Control extends WP_Customize_Control {
        /**
         * The type of customize control being rendered.
         */
        public $type = 'textarea';

         /**
         * Displays the textarea on the customize screen.
         */
        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
            <?php
        }
    }
    
    /**
    * Multiple select customize control class.
    */
    class Customize_Control_Multiple_Select extends WP_Customize_Control {

    /**
     * The type of customize control being rendered.
     */
    public $type = 'multiple-select';

    /**
     * Displays the multiple select on the customize screen.
     */
    public function render_content() {

    if ( empty( $this->choices ) )
        return;
    ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
                <?php
                    foreach ( $this->choices as $value => $label ) {
                        $selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
                        echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
                    }
                ?>
            </select>
            <p><em><?php _e('To display all font characters in your language correctly, the browser must know what character set (charset) to use. Latin is used for English and similar languages.', 'boss'); ?></em></p>
            <div id="select-info"></div>
        </label>
    <?php }
    }

    wp_enqueue_style( 'buddyboss-theme-preview-fonts', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:600|Pacifico|Open+Sans:400|Lato:400|Arimo:400|Ubuntu:400|Montserrat:400|Raleway:400|Cabin:400|PT+Sans:400');
    
    /****************************** Site title ******************************/
    
    // Title Color
    $wp_customize->add_setting( 'boss_title_color', array(
        'default'   		=> buddyboss_customizer_default_theme_option( 'boss_title_color' ),
        'transport'			=> 'postMessage', 
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           	=> 'option',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_title_color', array(
        'label'    => __( 'Color', 'boss' ),
        'section'  => 'title_tagline',
        'settings' => 'boss_title_color',
        'priority'  	  	=> 999
    ) ) );

	/****************************** Logo ******************************/

	/**
	 * Logo Section
	 * @since Boss 1.0.0
	 */

	$wp_customize->add_section( 'buddyboss_logo_section' , array(
	    'title'       => __( 'Logo', 'boss' ),
	    'priority'    => 20,
	    'description' => __( 'Upload large and small logos for open/collapsed BuddyPanel. Small logo will not work without large.', 'boss' )
	) );

		// Logo Upload
		$wp_customize->add_setting( 'buddyboss_logo', array( 
			'transport'			=> 'postMessage', 
		) );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'buddyboss_logo', array(
		    'label'    => __( 'Large Logo (ideal size 280x80)', 'boss' ),
		    'section'  => 'buddyboss_logo_section',
		    'settings' => 'buddyboss_logo',
            'priority'  	  	=> 1
		) ) );
    
		// Logo Upload
		$wp_customize->add_setting( 'buddyboss_small_logo', array( 
			'transport'			=> 'postMessage', 
		) );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'buddyboss_small_logo', array(
		    'label'    => __( 'Small Logo (ideal size 80x80)', 'boss' ),
		    'section'  => 'buddyboss_logo_section',
		    'settings' => 'buddyboss_small_logo',
            'priority'  	  	=> 2
		) ) ); 
    
        // Panel Logo Color
		$wp_customize->add_setting( 'boss_panel_logo_color', array(
		        'default'   		=> buddyboss_customizer_default_theme_option( 'boss_panel_logo_color' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_panel_logo_color', array(
			    'label'  	    	=> __( 'Logo Area', 'boss' ),
			    'section'    		=> 'buddyboss_logo_section',
			    'settings'  	 	=> 'boss_panel_logo_color',
			    'priority'  	  	=> 3
			) ) );

	/****************************** Layout ******************************/

	/**
	 * Layout Section
	 * @since Boss 1.0.0
	 */

	$wp_customize->add_section( 'boss_layout_section' , array(
	    'title'       => __( 'Layout Options', 'boss' ),
	    'priority'    => 25,
	    'description' => __( 'We use device detection to determine the correct layout, with media queries as a fallback.', 'boss' )
	) );
 
		// Desktop Layout
		$wp_customize->add_setting( 'boss_layout_desktop', array(
		        'default'   		=> 'desktop',
		        'transport' 		=> 'postMessage',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( 'boss_layout_desktop', array(
            'label'  	    	=> __( 'Desktop layout', 'boss' ),
            'section'    		=> 'boss_layout_section',
            'settings'  	 	=> 'boss_layout_desktop',
            'type'              => 'radio',
            'choices'           => array('desktop'=>'Desktop', 'mobile'=>'Mobile'),
            'priority'  	  	=> 1
        ) ); 

		// Tablet Layout
		$wp_customize->add_setting( 'boss_layout_tablet', array(
		        'default'   		=> 'mobile',
		        'transport' 		=> 'postMessage',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( 'boss_layout_tablet', array(
            'label'  	    	=> __( 'Tablet layout', 'boss' ),
            'section'    		=> 'boss_layout_section',
            'settings'  	 	=> 'boss_layout_tablet',
            'type'              => 'radio',
            'choices'           => array('desktop'=>'Desktop', 'mobile'=>'Mobile'),
            'priority'  	  	=> 2
        ) );

		// Phone Layout
		$wp_customize->add_setting( 'boss_layout_phone', array(
		        'default'   		=> 'mobile',
		        'transport' 		=> 'postMessage',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( 'boss_layout_phone', array(
            'label'  	    	=> __( 'Phone layout', 'boss' ),
            'section'    		=> 'boss_layout_section',
            'settings'  	 	=> 'boss_layout_phone',
            'type'              => 'radio',
            'choices'           => array('mobile'=>'Mobile (always)'),
            'priority'  	  	=> 3
        ) );

		// Manual Switcher Button
		$wp_customize->add_setting( 'boss_layout_switcher', array(
		        'default'   		=> 'yes',
		        'transport' 		=> 'postMessage',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( 'boss_layout_switcher', array(
            'label'  	    	=> __( 'Layout switch button', 'boss' ),
            'section'    		=> 'boss_layout_section',
            'settings'  	 	=> 'boss_layout_switcher',
            'type'              => 'radio',
            'choices'           => array('yes'=>'Display', 'no'=>'Hide'),
            'priority'  	  	=> 4
        ) ); 

        // Disable Activity Infinite Scroll
        $wp_customize->add_setting( 'boss_activity_infinite', array(
                'default'   		=> 'on',
                'transport' 		=> 'postMessage',
                'capability'        => 'edit_theme_options',
                'type'           	=> 'option',
            ) );
        $wp_customize->add_control( 'boss_activity_infinite', array(
            'label'  	    	=> __( 'Activity Infinite Scrolling', 'boss' ),
            'section'    		=> 'boss_layout_section',
            'settings'  	 	=> 'boss_activity_infinite',
            'type'              => 'radio',
            'choices'           => array('on'=>'Enabled', 'off'=>'Disabled'),
            'priority'  	  	=> 5
        ) ); 

        // Disable Adminbar
        $wp_customize->add_setting( 'boss_adminbar', array(
                'default'   		=> 'off',
                'capability'        => 'edit_theme_options',
                'type'           	=> 'option',
            ) );
        $wp_customize->add_control( 'boss_adminbar', array(
            'label'  	    	=> __( 'Display Adminbar', 'boss' ),
            'section'    		=> 'boss_layout_section',
            'settings'  	 	=> 'boss_adminbar',
            'type'              => 'radio',
            'choices'           => array('on'=>'Display', 'off'=>'Hide'),
            'priority'  	  	=> 5
        ) ); 

	/****************************** Mobile ******************************/

	/**
	 * Mobile Section
	 * @since Boss 1.0.0
	 */

	$wp_customize->add_section( 'boss_mobile_section' , array(
	    'title'       => __( 'Mobile Options', 'boss' ),
	    'priority'    => 30
	) );

	    // Search on mobile
	    $wp_customize->add_setting( 'boss_search_instead', array( 
	        'default'    => '0',
	        'transport'			=> 'postMessage',
	        'capability'        => 'edit_theme_options',
	        'type'           	=> 'option'
	    ) );

	    $wp_customize->add_control( 'boss_search_instead', array(
	        'label'    => __( 'Search Input', 'boss' ),
	        'section'  => 'boss_mobile_section',
	        'settings' => 'boss_search_instead',
	        'type'     => 'radio',
	        'choices'  => array('1'=>'Replaces title/logo when logged in', '0'=>'Hide'),
	        'priority'  => 1
	    ) );

	 	// Titlebar position on mobile
		$wp_customize->add_setting( 'buddyboss_titlebar_position', array( 
	            'default'    => '1',
	            'transport'			=> 'postMessage',
	            'capability'        => 'edit_theme_options',
	            'type'           	=> 'option'
		) );
    
        $wp_customize->add_control( 'buddyboss_titlebar_position', array(
			    'label'    => __( 'Titlebar Links (in left panel)', 'boss' ),
			    'section'  => 'boss_mobile_section',
			    'settings' => 'buddyboss_titlebar_position',
				'type'     => 'radio',
	            'choices'  => array('top'=>'Display above other links','bottom'=>'Display below other links','none'=>'Hide' ),
	            'priority'  => 2
		) );

	/****************************** Desktop ******************************/

	/**
	 * Desktop Section
	 * @since Boss 1.0.0
	 */

	$wp_customize->add_section( 'boss_desktop_section' , array(
	    'title'       => __( 'Desktop Options', 'boss' ),
	    'priority'    => 35
	) );

 		// Hide BuddyPanel for logged out users
		$wp_customize->add_setting( 'buddyboss_panel_hide', array( 
            'default'    => '1',
            'transport'			=> 'postMessage',
            'capability'        => 'edit_theme_options',
            'type'           	=> 'option'
		) );
    
        $wp_customize->add_control( 'buddyboss_panel_hide', array(
		    'label'    => __( 'Logged out users', 'boss' ),
		    'section'  => 'boss_desktop_section',
		    'settings' => 'buddyboss_panel_hide',
			'type'     => 'radio',
            'choices'  => array('1'=>'Show BuddyPanel', '0'=>'Hide BuddyPanel'),
            'priority'  => 1
		) );

 		// Panel Default state
		$wp_customize->add_setting( 'buddyboss_panel_state', array( 
            'default'    => '1',
            'transport'			=> 'postMessage',
            'capability'        => 'edit_theme_options',
            'type'           	=> 'option'
		) );
    
        $wp_customize->add_control( 'buddyboss_panel_state', array(
		    'label'    => __( 'BuddyPanel Default State', 'boss' ),
		    'section'  => 'boss_desktop_section',
		    'settings' => 'buddyboss_panel_state',
			'type'     => 'radio',
            'choices'  => array('opened'=>'Opened','closed'=>'Closed'),
            'priority'  => 2
		) );

 		// Show Dashboard links
		$wp_customize->add_setting( 'buddyboss_dashboard', array( 
            'default'    => '1',
            'transport'			=> 'postMessage',
            'capability'        => 'edit_theme_options',
            'type'           	=> 'option'
		) );
    
        $wp_customize->add_control( 'buddyboss_dashboard', array(
		    'label'    => __( 'Profile Dropdown (admins)', 'boss' ),
		    'section'  => 'boss_desktop_section',
		    'settings' => 'buddyboss_dashboard',
			'type'     => 'radio',
            'choices'  => array('1'=>'Show links to WP Dashboard','0'=>'Hide these links'),
            'priority'  => 3
		) );
    
 		// Show Adminbar
		$wp_customize->add_setting( 'buddyboss_adminbar', array( 
            'default'    => '1',
            'transport'			=> 'postMessage',
            'capability'        => 'edit_theme_options',
            'type'           	=> 'option'
		) );
    
        $wp_customize->add_control( 'buddyboss_adminbar', array(
		    'label'    => __( 'Profile Dropdown (all users)', 'boss' ),
		    'section'  => 'boss_desktop_section',
		    'settings' => 'buddyboss_adminbar',
			'type'     => 'radio',
            'choices'  => array('1'=>'Show "My Profile" WP menu', '0'=>'Hide this menu'),
            'priority'  => 4
		) );

	/****************************** Cover Photo ******************************/
    $wp_customize->add_section( 'boss_cover_section' , array(
	    'title'       => __( 'Cover Photos', 'boss' ),
	    'priority'    => 40,
	    'description' => __( 'Displayed in profiles and groups', 'boss' )
	) );
    
 		// Cover Photo Color
		$wp_customize->add_setting( 'boss_cover_color', array(
		        'default'   		=> buddyboss_customizer_default_theme_option( 'boss_cover_color' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_cover_color', array(
			    'label'  	    	=> __( 'Background', 'boss' ),
			    'section'    		=> 'boss_cover_section',
			    'settings'  	 	=> 'boss_cover_color',
			    'priority'  	  	=> 1
			) ) ); 
    
 		// Cover Group Size
		$wp_customize->add_setting( 'boss_cover_group_size', array(
		        'default'   		=> '322',
                'transport'			=> 'postMessage',
                'capability'        => 'edit_theme_options',
                'type'           	=> 'option'
            ) );
    
        $wp_customize->add_control( 'boss_cover_group_size', array(
		    'label'    => __( 'Group Cover Photo', 'boss' ),
		    'section'  => 'boss_cover_section',
		    'settings' => 'boss_cover_group_size',
			'type'     => 'radio',
            'choices'  => array('322'=>'Big', '200'=>'Small', 'none' => 'No photo'),
            'priority'  => 2
		) );

 		// Cover Profile Size
		$wp_customize->add_setting( 'boss_cover_profile_size', array(
		        'default'   		=> '322',
                'transport'			=> 'postMessage',
                'capability'        => 'edit_theme_options',
                'type'           	=> 'option'
            ) );
    
       
        $cover_sizes = apply_filters( 'boss_profile_cover_sizes', array('322'=>'Big', '200'=>'Small', 'none' => 'No photo') );
    
        $wp_customize->add_control( 'boss_cover_profile_size', array(
		    'label'    => __( 'Profile Cover Photo', 'boss' ),
		    'section'  => 'boss_cover_section',
		    'settings' => 'boss_cover_profile_size',
			'type'     => 'radio',
            'choices'  => $cover_sizes,
            'priority'  => 3
		) );
    
        
        // address field displayed in user profile cover photo area
        $wp_customize->add_setting( 'boss_misc_profile_field_address', array( 
            'default'			=> '',
            'transport'			=> 'postMessage',
            'capability'        => 'edit_theme_options',
            'type'           	=> 'option'
        ) );

        $wp_customize->add_control( 'boss_misc_profile_field_address', array(
            'label'    => __( "BuddyPress field in Profile Covers", 'boss' ),
            'section'  => 'boss_cover_section',
            'settings' => 'boss_misc_profile_field_address',
            'type'     => 'select',
            'choices'  => buddyboss_customizer_xprofile_field_choices(),
            'priority' => 4
        ) );   
        
    /****************************** Titlebar - Default ******************************/
    
    $wp_customize->add_section( 'boss_titlebar_section' , array(
	    'title'       => __( 'Titlebar', 'boss' ),
	    'priority'    => 45
	) );

		// Titlebar BG Color
		$wp_customize->add_setting( 'boss_layout_titlebar_bgcolor', array(
		        'default'   		=> buddyboss_customizer_default_theme_option( 'boss_layout_titlebar_bgcolor' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_layout_titlebar_bgcolor', array(
			    'label'  	    	=> __( 'Background (desktop)', 'boss' ),
			    'section'    		=> 'boss_titlebar_section',
			    'settings'  	 	=> 'boss_layout_titlebar_bgcolor',
			    'priority'  	  	=> 1
			) ) );
 
		// Mobile titlebar BG Color
		$wp_customize->add_setting( 'boss_layout_mobiletitlebar_bgcolor', array(
                'default'   		=> buddyboss_customizer_default_theme_option( 'boss_layout_mobiletitlebar_bgcolor' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_layout_mobiletitlebar_bgcolor', array(
			    'label'  	    	=> __( 'Background (mobile)', 'boss' ),
			    'section'    		=> 'boss_titlebar_section',
			    'settings'  	 	=> 'boss_layout_mobiletitlebar_bgcolor',
			    'priority'  	  	=> 2
			) ) );

		// Titlebar Color
		$wp_customize->add_setting( 'boss_layout_titlebar_color', array(
                'default'   		=> buddyboss_customizer_default_theme_option( 'boss_layout_titlebar_color' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_layout_titlebar_color', array(
			    'label'  	    	=> __( 'Links (desktop)', 'boss' ),
			    'section'    		=> 'boss_titlebar_section',
			    'settings'  	 	=> 'boss_layout_titlebar_color',
			    'priority'  	  	=> 3
			) ) );

		// Titlebar Color
		$wp_customize->add_setting( 'boss_layout_mobiletitlebar_color', array(
                'default'   		=> buddyboss_customizer_default_theme_option( 'boss_layout_mobiletitlebar_color' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_layout_mobiletitlebar_color', array(
			    'label'  	    	=> __( 'Links (mobile)', 'boss' ),
			    'section'    		=> 'boss_titlebar_section',
			    'settings'  	 	=> 'boss_layout_mobiletitlebar_color',
			    'priority'  	  	=> 3
			) ) );

    /****************************** Titlebar - No BuddyPanel ******************************/
    
    $wp_customize->add_section( 'boss_titlebar_nopanel_section' , array(
	    'title'       => __( 'Titlebar (No BuddyPanel)', 'boss' ),
	    'priority'    => 50,
	    'description' => __( 'When using the "No BuddyPanel" template, or when hiding the BuddyPanel from logged out users.', 'boss' )
	) );

		// No BuddyPanel BG Color
		$wp_customize->add_setting( 'boss_layout_nobp_titlebar_bgcolor', array(
                'default'   		=> buddyboss_customizer_default_theme_option( 'boss_layout_nobp_titlebar_bgcolor' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_layout_nobp_titlebar_bgcolor', array(
			    'label'  	    	=> __( 'Background (desktop)', 'boss' ),
			    'section'    		=> 'boss_titlebar_nopanel_section',
			    'settings'  	 	=> 'boss_layout_nobp_titlebar_bgcolor',
			    'priority'  	  	=> 1
			) ) );
    
		// No BuddyPanel Links Color
		$wp_customize->add_setting( 'boss_layout_nobp_titlebar_color', array(
                'default'   		=> buddyboss_customizer_default_theme_option( 'boss_layout_nobp_titlebar_color' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_layout_nobp_titlebar_color', array(
			    'label'  	    	=> __( 'Links', 'boss' ),
			    'section'    		=> 'boss_titlebar_nopanel_section',
			    'settings'  	 	=> 'boss_layout_nobp_titlebar_color',
			    'priority'  	  	=> 2
			) ) ); 
 
		// No BuddyPanel Links Hover Color
		$wp_customize->add_setting( 'boss_layout_nobp_titlebar_hover_color', array(
                'default'   		=> buddyboss_customizer_default_theme_option( 'boss_layout_nobp_titlebar_hover_color' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_layout_nobp_titlebar_hover_color', array(
			    'label'  	    	=> __( 'Links Hover', 'boss' ),
			    'section'    		=> 'boss_titlebar_nopanel_section',
			    'settings'  	 	=> 'boss_layout_nobp_titlebar_hover_color',
			    'priority'  	  	=> 3
			) ) );

	/****************************** BuddyPanel ******************************/

	/**
	 * BuddyPanel Section
	 * @since Boss 1.0.0
	 */

	$wp_customize->add_section( 'boss_panel_section' , array(
	    'title'       => __( 'BuddyPanel', 'boss' ),
	    'priority'    => 55,
	    'description' => __( 'The "BuddyPanel" is the left navigation panel on desktops.', 'boss' )

	) );

		// Panel BG Color
		$wp_customize->add_setting( 'boss_panel_color', array(
		        'default'   		=> buddyboss_customizer_default_theme_option( 'boss_panel_color' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_panel_color', array(
			    'label'  	    	=> __( 'Panel background', 'boss' ),
			    'section'    		=> 'boss_panel_section',
			    'settings'  	 	=> 'boss_panel_color',
			    'priority'  	  	=> 3
			) ) );

		// Panel Title Color
		$wp_customize->add_setting( 'boss_panel_title_color', array(
		        'default'   		=> buddyboss_customizer_default_theme_option( 'boss_panel_title_color' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_panel_title_color', array(
			    'label'  	    	=> __( 'Titles', 'boss' ),
			    'section'    		=> 'boss_panel_section',
			    'settings'  	 	=> 'boss_panel_title_color',
			    'priority'  	  	=> 4
			) ) );

		// Open Panel Icons Color
		$wp_customize->add_setting( 'boss_panel_open_icons_color', array(
		        'default'   		=> buddyboss_customizer_default_theme_option( 'boss_panel_open_icons_color' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_panel_open_icons_color', array(
			    'label'  	    	=> __( 'Icons (opened)', 'boss' ),
			    'section'    		=> 'boss_panel_section',
			    'settings'  	 	=> 'boss_panel_open_icons_color',
			    'priority'  	  	=> 5
			) ) );
    
		// Panel Icons Color
		$wp_customize->add_setting( 'boss_panel_icons_color', array(
		        'default'   		=> buddyboss_customizer_default_theme_option( 'boss_panel_icons_color' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_panel_icons_color', array(
			    'label'  	    	=> __( 'Icons (closed)', 'boss' ),
			    'section'    		=> 'boss_panel_section',
			    'settings'  	 	=> 'boss_panel_icons_color',
			    'priority'  	  	=> 6
			) ) );

	/****************************** Body Content ******************************/

	/**
	 * Body Content Section
	 * @since Boss 1.0.0
	 */

	$wp_customize->add_section( 'boss_body_content_section' , array(
	    'title'       => __( 'Body Content', 'boss' ),
	    'priority'    => 60
	) );  
    
		// Body Color
		$wp_customize->add_setting( 'boss_layout_body_color', array(
		        'default'   		=> buddyboss_customizer_default_theme_option( 'boss_layout_body_color' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_layout_body_color', array(
			    'label'  	    	=> __( 'Body BG', 'boss' ),
			    'section'    		=> 'boss_body_content_section',
			    'settings'  	 	=> 'boss_layout_body_color',
			    'priority'  	  	=> 1
			) ) );

		// Footer Top Color
		$wp_customize->add_setting( 'boss_layout_footer_top_color', array(
		        'default'   		=> buddyboss_customizer_default_theme_option( 'boss_layout_footer_top_color' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_layout_footer_top_color', array(
			    'label'  	    	=> __( 'Footer Widget Area BG', 'boss' ),
			    'section'    		=> 'boss_body_content_section',
			    'settings'  	 	=> 'boss_layout_footer_top_color',
			    'priority'  	  	=> 2
			) ) );
    
		// Footer Bottom Background Color
		$wp_customize->add_setting( 'boss_layout_footer_bottom_bgcolor', array(
		        'default'   		=> buddyboss_customizer_default_theme_option( 'boss_layout_footer_bottom_bgcolor' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_layout_footer_bottom_bgcolor', array(
			    'label'  	    	=> __( 'Footer Bottom Area BG', 'boss' ),
			    'section'    		=> 'boss_body_content_section',
			    'settings'  	 	=> 'boss_layout_footer_bottom_bgcolor',
			    'priority'  	  	=> 3
			) ) );   
    
		// Footer Bottom Color
		$wp_customize->add_setting( 'boss_layout_footer_bottom_color', array(
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_layout_footer_bottom_color', array(
			    'label'  	    	=> __( 'Footer Bottom Area text', 'boss' ),
			    'section'    		=> 'boss_body_content_section',
			    'settings'  	 	=> 'boss_layout_footer_bottom_color',
			    'priority'  	  	=> 4
			) ) );

        // Slideshow Text Color
		$wp_customize->add_setting( 'boss_slideshow_font_color', array(
		        'default'   		=> buddyboss_customizer_default_theme_option( 'boss_slideshow_font_color' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option'
	    	) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_slideshow_font_color', array(
			    'label'     		=> __( 'Slide Title text', 'boss' ),
			    'section'   		=> 'boss_body_content_section',
			    'settings'  		=> 'boss_slideshow_font_color',
			    'priority'  	  	=> 4
			) ) );
    
		// Heading Text Color
		$wp_customize->add_setting( 'boss_heading_font_color', array(
		        'default'   		=> buddyboss_customizer_default_theme_option( 'boss_heading_font_color' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option'
	    	) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_heading_font_color', array(
			    'label'     		=> __( 'Heading text', 'boss' ),
			    'section'   		=> 'boss_body_content_section',
			    'settings'  		=> 'boss_heading_font_color',
			    'priority'  	  	=> 5
			) ) );

		// Body Text Color
		$wp_customize->add_setting( 'boss_body_font_color', array(
		        'default'   		=>  buddyboss_customizer_default_theme_option( 'boss_body_font_color' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option'
	    	) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_body_font_color', array(
			    'label'     		=> __( 'Body text', 'boss' ),
			    'section'   		=> 'boss_body_content_section',
			    'settings'  		=> 'boss_body_font_color',
			    'priority'  	  	=> 6
			) ) );
    
		// Links Color
		$wp_customize->add_setting( 'boss_links_pr_color', array(
		        'default'   		=> buddyboss_customizer_default_theme_option( 'boss_links_pr_color' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_links_pr_color', array(
			    'label'  	    	=> __( 'Link text', 'boss' ),
			    'section'    		=> 'boss_body_content_section',
			    'settings'  	 	=> 'boss_links_pr_color',
			    'priority'  	  	=> 7
			) ) ); 
    
		// Buttons & Nav Items Color
		$wp_customize->add_setting( 'boss_links_color', array(
		        'default'   		=> buddyboss_customizer_default_theme_option( 'boss_links_color' ),
		        'transport' 		=> 'postMessage',
		        'sanitize_callback' => 'sanitize_hex_color',
		        'capability'        => 'edit_theme_options',
		        'type'           	=> 'option',
		    ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boss_links_color', array(
			    'label'  	    	=> __( 'Buttons &amp; Nav Items', 'boss' ),
			    'section'    		=> 'boss_body_content_section',
			    'settings'  	 	=> 'boss_links_color',
			    'priority'  	  	=> 8
			) ) );

	/****************************** Color Scheme ******************************/

	/**
	 * Color Scheme Section
	 * @since Boss 1.0.0
	 */

	$wp_customize->add_section( 'boss_color_scheme_section' , array(
	    'title'       => __( 'Color Scheme', 'boss' ),
	    'priority'    => 65,
	    'description' => __( 'Select a predefined color scheme.', 'boss' )
	) );
    
        // Choose scheme
		$wp_customize->add_setting( 'boss_scheme_select', array( 
            'default'    => 'default',
            'transport'			=> 'postMessage',
            'capability'        => 'edit_theme_options',
            'type'           	=> 'option'
		) );
    
        $wp_customize->add_control( 'boss_scheme_select', array(
		    'label'    => __( 'Choose scheme', 'boss' ),
            'section'    		=> 'boss_color_scheme_section',
            'settings'  	 	=> 'boss_scheme_select',
			'type'     => 'select',
            'choices'  => buddyboss_customizer_themes_choices(),
            'priority'  => 1
		) );

	/****************************** Fonts ******************************/

	/**
	 * Fonts Section
	 * @since Boss 1.0.0
	 */

	$wp_customize->add_section( 'boss_fonts_section' , array(
	    'title'       => __( 'Fonts', 'boss' ),
	    'priority'    => 70
	) );

		// Charset
        $wp_customize->add_setting( 'boss_font_charset', array(
            'default' => array('latin'), 
        ) );

        $wp_customize->add_control(
            new Customize_Control_Multiple_Select( $wp_customize, 'multiple_select_setting',
                array(
                    'settings' => 'boss_font_charset',
                    'label'    => 'Font Character Set',
                    'section'  => 'boss_fonts_section', 
                    'type'     => 'multiple-select', 
                    'priority' => 1,
                    'choices'  => array( 'latin' => 'Latin (default)', 'latin-ext' => 'Latin Extended', 'cyrillic-ext' => 'Cyrillic Extended', 'cyrillic' => 'Cyrillic', 'greek-ext' => 'Greek Extended', 'greek' => 'Greak',  'vietnamese' => 'Vietnamese' ) 
                )
            )
        );
 
	    // Site Title Font
	    $wp_customize->add_setting( 'boss_site_title_font_family', array(
	        'default'   		=> 'pacifico',
	        'transport' 		=> 'postMessage',
	        'sanitize_callback' => 'buddyboss_sanitize_font_dropdown'
	    ) );
	    $wp_customize->add_control( 'boss_site_title_font_family', array(
	        'label'    => __( 'Site Title', 'boss' ),
	        'section'  => 'boss_fonts_section',
	        'priority' => 1,
	        'type'     => 'select',
	        'choices'  => buddyboss_customizer_default_fonts()
	    ) );

		// Heading Font
		$wp_customize->add_setting( 'boss_heading_font_family', array(
	        'default'   		=> 'arimo',
	        'transport' 		=> 'postMessage',
	        'sanitize_callback' => 'buddyboss_sanitize_font_dropdown'
		) );
		$wp_customize->add_control( 'boss_heading_font_family', array(
			'label'    => __( 'Headings', 'boss' ),
			'section'  => 'boss_fonts_section',
			'priority' => 2,
			'type'     => 'select',
			'choices'  => buddyboss_customizer_default_fonts()
		) );

		// Slideshow Title Font
		$wp_customize->add_setting( 'boss_slideshow_font_family', array(
	        'default'   		=> 'source',
	        'transport' 		=> 'postMessage',
	        'sanitize_callback' => 'buddyboss_sanitize_font_dropdown'
		) );
		$wp_customize->add_control( 'boss_slideshow_font_family', array(
			'label'    => __( 'Slide &amp; Page Titles', 'boss' ),
			'section'  => 'boss_fonts_section',
			'priority' => 3,
			'type'     => 'select',
			'choices'  => buddyboss_customizer_default_fonts()
		) );
 
		// Body Font
		$wp_customize->add_setting( 'boss_body_font_family', array(
	        'default'   		=> 'arimo',
	        'transport' 		=> 'postMessage',
	        'sanitize_callback' => 'buddyboss_sanitize_font_dropdown'
		) );
		$wp_customize->add_control( 'boss_body_font_family', array(
			'label'    => __( 'Body Content', 'boss' ),
			'section'  => 'boss_fonts_section',
			'priority' => 4,
			'type'     => 'select',
			'choices'  => buddyboss_customizer_default_fonts()
		) );
    
    
    
	/****************************** SOCIAL MEDIA LINKS ******************************/

	/**
	 * Add Social Media Links Section
	 * @since Boss 1.1.4
	 */

	$wp_customize->add_section( 'buddyboss_social_section' , array(
	    'title'       => __( 'Footer Social Media Links', 'boss' ),
	    'priority'    => 75,
	    'description' => __( 'Social media links will display in the footer after you click Save &amp; Publish.', 'boss' ),
	) );

		// Facebook
		$wp_customize->add_setting( 'boss_link_facebook', array(
		       	'default' 			=> '',
		       	'sanitize_callback' => 'buddyboss_sanitize_text'
		    ) );
	    $wp_customize->add_control( 'boss_link_facebook', array(
		        'label'   			=> __( 'Facebook', 'boss' ),
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
		        'label'   			=> __( 'Twitter', 'boss' ),
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
		        'label'   			=> __( 'LinkedIn', 'boss' ),
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
		        'label'   			=> __( 'Google+', 'boss' ),
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
		        'label'   			=> __( 'Youtube', 'boss' ),
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
		        'label'   			=> __( 'Instagram', 'boss' ),
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
		        'label'   			=> __( 'Pinterest', 'boss' ),
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
		        'label'   			=> __( 'Email Address', 'boss' ),
		        'section' 			=> 'buddyboss_social_section',
		        'type'    			=> 'text',
		        'priority'    		=> 8
		    ) );
    
    
    	/**************************** PROFILE SOCIAL MEDIA LINKS ****************************/

	/**
	 * Add Profle Social Media Links Section
	 * @since Boss 1.1.4
	 */

	$wp_customize->add_section( 'buddyboss_profile_social_section' , array(
	    'title'       => __( 'Profile Social Media Links', 'boss' ),
	    'priority'    => 76,
	    'description' => __( 'Social media links will display in the profile.', 'boss' ),
	) );
	
	foreach(buddyboss_get_user_social_array() as $key => $value) {
	
	
	$wp_customize->add_setting( 'boss_show_profile_link_'.$key, array(
		       	'default' 			=> '1',
		       	'type' 				=> 'option',
		       	'sanitize_callback' 		=> 'buddyboss_sanitize_text',
		    ) );
	
	$wp_customize->add_control( 'boss_show_profile_link_'.$key , array(
		        'label'   			=> $value,
		        'section' 			=> 'buddyboss_profile_social_section',
		        'type'    			=> 'checkbox',
		        'priority'    			=> 1,
			'choices'			=> array('1','0')
		    ) );
	
	}	
    

    
        /****************************** Custom CSS Section ******************************/
    
        /**
         * Add Custom CSS Section
         * @since Boss 1.1.6
         */
    
        $wp_customize->add_section( 'boss_custom_css_section', array(
            'title'          => __('Custom CSS', 'boss'),
            'priority'       => 80,
        ) );

            $wp_customize->add_setting( 'boss_custom_css', array(
                'sanitize_callback' => 'bb_sanitize_textarea',
                'transport' 		=> 'postMessage',
            ) );

            $wp_customize->add_control( new Textarea_Custom_Control( $wp_customize, 'boss_custom_css', array(
                'label'   => __('Custom CSS', 'boss'),
                'section' => 'boss_custom_css_section',
                'settings'   => 'boss_custom_css',
                'priority' => 1,
            ) ) );
    

} // End Of BuddyBoss Customizer Function

add_action( 'customize_register', 'buddyboss_customize_register' );

/*************************************************************
 * 3 - CUSTOMIZER UTILITY FUNCTIONS
 */

/**
 * Sanitize Textarea
 *
 * @since  Boss 1.1.6
 */

function bb_sanitize_textarea( $text ) {
    return esc_textarea( $text );
}

/**
 * Returns default fonts
 *
 * @since  BuddyBoss 3.1
 */

function buddyboss_customizer_default_fonts() {
	// Websafe font reference: http://www.w3schools.com/cssref/css_websafe_fonts.asp
	return array(
		'arial'     => 'Arial',
		'arimo'     => 'Arimo',
        'cabin'   => 'Cabin',
        'courier'   => 'Courier New',
        'georgia'   => 'Georgia',
		'helvetica' => 'Helvetica',
		'lato'      => 'Lato',
		'lucida'    => 'Lucida Sans Unicode',
		'montserrat'    => 'Montserrat',
        'opensans'  => 'Open Sans',
		'pacifico'  => 'Pacifico',
		'palatino'  => 'Palatino Linotype',
		'pt_sans'  => 'PT Sans',
		'raleway'  => 'Raleway',
		'source'  => 'Source Sans Pro',
        'tahoma'    => 'Tahoma',
		'times'     => 'Times New Roman',
        'trebuchet' => 'Trebuchet MS',
		'ubuntu'     => 'Ubuntu',
        'verdana'   => 'Verdana'
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

function buddyboss_get_fontstack( $fontkey, $default ='' ) {
    $fonts = buddyboss_customizer_default_fonts();
    $key = get_theme_mod( $fontkey );

    if ( ! empty( $key ) && ! empty( $fonts[ $key ] ) ) {
        return "'" . esc_attr( $fonts[ $key ] ) . "'";
    } elseif($default) {
        return "'" . esc_attr( $fonts[ $default ] ) . "'";
    } else {
        return "'Arimo', sans-serif";
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
function buddyboss_logo_height($size) {

    if($size == 'big') {
        $logo = get_theme_mod( 'buddyboss_logo', FALSE );
        $fixed_width = 187;
    }else{
        $logo = get_theme_mod( 'buddyboss_small_logo', FALSE );
        $fixed_width = 52;
    }
    /*convert from relative url to absolute url*/
    $logo_absolute_url = $logo;
    
    $h = 74;
    if ( $logo ) {
        $optionname =  get_option("logo_height");
        if($optionname["hash-".$size] != md5($logo)) {
            list( $width, $height ) = getimagesize( $logo_absolute_url );
            $h = ceil(intval($height)*($fixed_width/intval($width))) + 25;
            $optionname["hash-".$size] = md5($logo);
            $optionname["height-".$size] = (int) $h;
            update_option("logo_height", $optionname);
        } else {
            $h = $optionname["height-".$size];
        } 
    }
    
    return ($h)?$h:74;
}

// Custom CSS For Customizer
function buddyboss_customizer_css() { 

    /** Define some vars **/
	$uploads = wp_upload_dir();
	$css_dir = get_template_directory() . '/css/'; 
    
    $big_logo_h = buddyboss_logo_height('big');
    $small_logo_h = buddyboss_logo_height('small');
    
	/** Capture CSS output **/
	ob_start();
    ?>
      /* Header height based on logo height */
        body:not(.left-menu-open)[data-logo="1"] .site-header .left-col .table {
           height: <?php echo $small_logo_h.'px'; ?>;
        }

        body.is-desktop:not(.left-menu-open)[data-logo="1"] #right-panel {
            margin-top: <?php echo $small_logo_h.'px'; ?>;
        }   

        body.is-desktop:not(.left-menu-open)[data-logo="1"] #left-panel-inner {
            padding-top: <?php echo $small_logo_h.'px'; ?>;
        } 
        
        body:not(.left-menu-open)[data-logo="1"] #search-open,
        body:not(.left-menu-open)[data-logo="1"] .header-account-login,
        body:not(.left-menu-open)[data-logo="1"] #wp-admin-bar-shortcode-secondary .menupop,
        body:not(.left-menu-open)[data-logo="1"] .header-notifications {
            line-height: <?php echo $small_logo_h.'px'; ?>;
            height: <?php echo $small_logo_h.'px'; ?>;
        } 
        
        body:not(.left-menu-open)[data-logo="1"] #wp-admin-bar-shortcode-secondary .ab-sub-wrapper, 
        body:not(.left-menu-open)[data-logo="1"] .header-notifications .pop, 
        body:not(.left-menu-open)[data-logo="1"] .header-account-login .pop {
            top: <?php echo $small_logo_h.'px'; ?>;
        }
        
        body.left-menu-open[data-logo="1"] .site-header .left-col .table {
           height: <?php echo $big_logo_h.'px'; ?>;
        }

        body.is-desktop.left-menu-open[data-logo="1"] #right-panel {
            margin-top: <?php echo $big_logo_h.'px'; ?>;
        }   

        body.is-desktop.left-menu-open[data-logo="1"] #left-panel-inner {
            padding-top: <?php echo $big_logo_h.'px'; ?>;
        } 
        
        body.left-menu-open[data-logo="1"] #search-open,
        body.left-menu-open[data-logo="1"] .header-account-login,
        body.left-menu-open[data-logo="1"] #wp-admin-bar-shortcode-secondary .menupop,
        body.left-menu-open[data-logo="1"] .header-notifications {
            line-height: <?php echo $big_logo_h.'px'; ?>;
            height: <?php echo $big_logo_h.'px'; ?>;
        } 
    
        body.left-menu-open[data-logo="1"] #wp-admin-bar-shortcode-secondary .ab-sub-wrapper, 
        body.left-menu-open[data-logo="1"] .header-notifications .pop, 
        body.left-menu-open[data-logo="1"] .header-account-login .pop {
            top: <?php echo $big_logo_h.'px'; ?>;
        }
       
        body, p, 
        input[type="text"],
        input[type="email"],
        input[type="url"],
        input[type="password"],
        input[type="search"],
        textarea    
        {
            color: <?php echo esc_attr( get_option( 'boss_body_font_color' ) ); ?>;
        }     

        body,
        .left-col .search-wrap,
        #item-buttons .pop .inner,
        #item-nav .item-list-tabs .hideshow ul {
            background-color: <?php echo esc_attr( get_option( 'boss_layout_body_color' ) ); ?>;
        }
        
        body .site, body #main-wrap {
            background-color: <?php echo esc_attr( get_option( 'boss_layout_body_color' ) ); ?>;    
        }
        
        .bp-avatar-nav ul.avatar-nav-items li.current {
            border-bottom-color: <?php echo esc_attr( get_option( 'boss_layout_body_color' ) ); ?>
        }
        
        a {
            color: <?php echo esc_attr( get_option( 'boss_links_pr_color' ) ); ?>;
        }
        
        #item-buttons .pop .inner:before {
            background-color: <?php echo esc_attr( get_option( 'boss_layout_body_color' ) ); ?>;
        }
        
        /* Heading Text color */
        .group-single #buddypress #item-header-cover #item-actions h3,
        .left-menu-open .group-single #buddypress #item-header-cover #item-actions h3,
        .comments-area article header cite a,
        #groups-stream li .item-desc p, #groups-list li .item-desc p,
        .directory.groups #item-statistics .numbers span p,
        .entry-title a, .entry-title,
        .widget_buddyboss_recent_post h3 a,
        h1, h2, h3, h4, h5, h6 {
            color: <?php echo esc_attr( get_option( 'boss_heading_font_color' ) ); ?>;
        }
        
        #group-description .group-name,
        .author.archive .archive-header .archive-title a:hover,
        .entry-buddypress-content #group-create-body h4,
        .widget_buddyboss_recent_post h3 a:hover,
        a:hover {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        #wp-admin-bar-shortcode-secondary a.button {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        } 
               
        #wp-admin-bar-shortcode-secondary a.button:hover {
            color: <?php echo esc_attr( get_option( 'boss_links_pr_color' ) ); ?>;
        }
        
        input[type="checkbox"]:checked + span:after,
		input[type="checkbox"]:checked + label:after,
		input[type="checkbox"]:checked + strong:after {
           color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
       }
       
       input[type="radio"]:checked + span:before ,
        input[type="radio"]:checked + label:before ,
        input[type="radio"]:checked + strong:before {
           background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>; 
       }
       
        input[type="radio"] + span:before,
        input[type="radio"] + label:before,
        input[type="radio"] + strong:before {
            border-color: <?php echo esc_attr( get_option( 'boss_layout_body_color' ) ); ?>;  
        }
        
        #buddypress input[type="text"]::-webkit-input-placeholder {
            color: <?php echo esc_attr( get_option( 'boss_body_font_color' ) ); ?>;
        }
        #buddypress input[type="text"]:-ms-input-placeholder  {
            color: <?php echo esc_attr( get_option( 'boss_body_font_color' ) ); ?>;
        }
        /* For Firefox 18 or under */
        #buddypress input[type="text"]:-moz-placeholder {
            color: <?php echo esc_attr( get_option( 'boss_body_font_color' ) ); ?>;
        }
        /* For Firefox 19 or above */
        #buddypress input[type="text"]::-moz-placeholder {
            color: <?php echo esc_attr( get_option( 'boss_body_font_color' ) ); ?>;
        }
        .directory.activity .item-list-tabs ul li,
        .logged-in .dir-form .item-list-tabs ul li, .dir-form .item-list-tabs ul li:last-child {
        	border-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?> !important;
        }
        .ui-tabs-nav li.ui-state-default a, .directory.activity .item-list-tabs ul li a, .dir-form .item-list-tabs ul li a {
        	color: <?php echo esc_attr( get_option( 'boss_body_font_color' ) ); ?> !important;
        }
        
         /* Buttons */
        .woocommerce #respond input#submit, 
        .woocommerce a.button, 
        .woocommerce button.button, .woocommerce input.button,
        .woocommerce #respond input#submit:hover, 
        .woocommerce a.button:hover,
        .woocommerce button.button, .woocommerce input.button:hover,
        #buddypress .activity-list li.load-more a,
        #buddypress .activity-list li.load-newest a,
        .btn, button:not(#searchsubmit):not(.update-cover-photo), input[type="submit"], input[type="button"]:not(.button-small), input[type="reset"], article.post-password-required input[type=submit], li.bypostauthor cite span, a.button, #create-group-form .remove, #buddypress ul.button-nav li a, #buddypress div.generic-button a, #buddypress .comment-reply-link, .entry-title a.button, span.create-a-group > a, #buddypress div.activity-comments form input[disabled],
		.woocommerce #respond input#submit.alt, .woocommerce a.button.alt,
		.woocommerce button.button.alt, .woocommerce input.button.alt,
		.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover,
		.woocommerce ul.products li.product .add_to_cart_button:hover,
		.widget_price_filter .price_slider_amount button:not(#searchsubmit):not(.update-cover-photo):hover,
		.woocommerce .widget_shopping_cart_content .buttons a:hover,
		.woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover {
			background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
		}
		
		.woocommerce a.remove,
		.woocommerce div.product p.price, 
        .woocommerce div.product span.price,
		.woocommerce ul.products li.product .price {
		    color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
		}
		
		.widget_price_filter .price_slider_amount button:not(#searchsubmit):not(.update-cover-photo):hover,
		.woocommerce ul.products li.product .add_to_cart_button:hover,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-handle:hover {
		    border-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
		}
		
		#switch_submit {
		    background-color: transparent;
		}
		
		#fwslider .progress,
		#fwslider .readmore a {
			background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
		}
       
       .selected-tab,
       .btn.inverse,
       .buddyboss-select-inner {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
            border-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
       }
       
       .btn-group.inverse > .btn {
           color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
           border-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
       }

       .btn-group.inverse > .btn:first-child:not(:last-child) {
           border-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
       }
                
        /* Widgets */
        .widget-area .widget:not(.widget_buddyboss_recent_post) ul li a {
            color: <?php echo esc_attr( get_option( 'boss_body_font_color' ) ); ?>;
        }
        
        .widget .avatar-block img.avatar,
        .widget-area .widget.widget_bp_core_login_widget .bp-login-widget-register-link a,
        .widget-area .widget.buddyboss-login-widget a.sidebar-wp-register,
        .widget-area .widget_tag_cloud .tagcloud a,
        .widget-area .widget #sidebarme ul.sidebarme-quicklinks li.sidebarme-profile a:first-child,
        .widget-area .widget_bp_core_login_widget img.avatar,
        .widget-area .widget #sidebarme img.avatar {
            border-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        .widget-area .widget.widget_buddyboss_recent_post  ul li a.category-link,
        .widget-area .widget.widget_bp_core_login_widget .bp-login-widget-register-link a,
        .widget-area .widget.buddyboss-login-widget a.sidebar-wp-register,
        .widget-area .widget_tag_cloud .tagcloud a,
        .widget-area .widget #sidebarme ul.sidebarme-quicklinks li.sidebarme-profile a:first-child,
        #wp-calendar td#today,
        .widget-area .widget:not(.widget_buddyboss_recent_post) ul li a:hover {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        .widget.widget_display_stats strong {
            background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }  
             
        .a-stats a {
            background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?> !important;
        }
        
        .widget-area .widget div.item-options a.selected,
        .widget-area .widget .textwidget,
        .widget-area .widget:not(.widget_buddyboss_recent_post) ul li a {
            color: <?php echo esc_attr( get_option( 'boss_body_font_color' ) ); ?>;
        }

        /* 404 */
        .error404 .entry-content p,
        .error404 h1 {
            color: <?php echo esc_attr( get_option( 'boss_panel_color' ) ); ?>;
        }
        
        /* BuddyBoss Panel */
        .menu-panel, 
        .menu-panel #nav-menu .sub-menu-wrap, 
        .bp_components ul li ul li.menupop .ab-sub-wrapper {
            background-color: <?php echo esc_attr( get_option( 'boss_panel_color' ) ); ?>;
        }
        
        .left-menu-open .menu-panel #nav-menu > ul > li.current-menu-item > a, .left-menu-open .menu-panel #nav-menu > ul > li.current-menu-parent > a, .left-menu-open .bp_components ul li ul li.menupop.active > a,
        .menu-panel #header-menu > ul li a,
        #nav-menu > ul > li > a, body:not(.left-menu-open) .menu-panel .sub-menu-wrap > a, body:not(.left-menu-open) .menu-panel .ab-sub-wrapper > .ab-item, .menu-panel #nav-menu > a, .menu-panel .menupop > a {
            color: <?php echo esc_attr( get_option( 'boss_panel_title_color' ) ); ?>;
        }
        
        .menu-panel #header-menu > ul li a:before,
        .menu-panel #nav-menu > ul > li > a:not(.open-submenu):before,
        .menu-panel .screen-reader-shortcut:before,
        .menu-panel .bp_components ul li ul li > .ab-item:before {
            color: <?php echo esc_attr( get_option( 'boss_panel_icons_color' ) ); ?>;
        }
        
        body.left-menu-open .menu-panel #nav-menu > ul > li > a:not(.open-submenu):before, body.left-menu-open .menu-panel .bp_components ul li ul li > .ab-item:before, body.left-menu-open .menu-panel .screen-reader-shortcut:before {
            color: <?php echo esc_attr( get_option( 'boss_panel_open_icons_color' ) ); ?>;
        }
        
        /* Counting Numbers and Icons */
        .widget_categories .cat-item i,
        .menu-panel ul li a span {
            background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        body .menu-panel #nav-menu > ul > li.dropdown > a:not(.open-submenu):before, body .menu-panel .bp_components ul li ul li.menupop.dropdown > a:not(.open-submenu):before, body.tablet .menu-panel #nav-menu > ul > li.current-menu-item > a:not(.open-submenu):before, body.tablet .menu-panel #nav-menu > ul > li.current-menu-parent > a:not(.open-submenu):before, body.tablet .menu-panel .bp_components ul li ul li.menupop.active > a:not(.open-submenu):before, body .menu-panel #nav-menu > ul > li.current-menu-item > a:not(.open-submenu):before, body .menu-panel #nav-menu > ul > li.current-menu-parent > a:not(.open-submenu):before, body .menu-panel .bp_components ul li ul li.menupop.active > a:not(.open-submenu):before {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        /* Pagination */
        .search_results .navigation .wp-paginate .current, .pagination .current, .bbp-pagination-links span:not(.dots) {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
            border-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        /* Cover */
        .page-cover {
            background-color: <?php echo esc_attr( get_option( 'boss_cover_color' ) ); ?>;
        }
        
        /* Small Buttons */
        .bbp-topic-details #subscription-toggle a,
        .bbp-forum-details #subscription-toggle a,
        .widget-area .widget .bp-login-widget-register-link a,
        .widget-area .widget a.sidebar-wp-register,
        .widget-area .widget_bp_core_login_widget a.logout,
        .widget-area .widget_tag_cloud a,
        .widget-area .widget #sidebarme ul.sidebarme-quicklinks li.sidebarme-profile a,
        .bbp-logged-in a.button,
        .right-col .register, 
        .right-col .login,
        .header-account-login .pop .logout a {
            background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
      
        /* Footer */
        #footer-links a:hover {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        /* 1st Footer Background Color */
        div.footer-inner-top {
            background-color: <?php echo esc_attr( get_option( 'boss_layout_footer_top_color' ) ); ?>;
        }

        /* 2nd Footer Background Color */
        div.footer-inner-bottom {
            background-color: <?php echo esc_attr( get_option( 'boss_layout_footer_bottom_bgcolor' ) ); ?>;
        }
         
        /* Comments */
        .comments-area article header a:hover,
        .comment-awaiting-moderation {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        } 
         
         /* Shortcodes */
        .menu-dropdown li a:hover,
        .tooltip, 
        .progressbar-wrap p,
        .ui-tabs-nav li.ui-state-active a,
        .ui-accordion.accordion h3.ui-accordion-header-active:after,
        .ui-accordion.accordion h3.ui-accordion-header {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
         
        .entry-content .underlined:after,
        .progressbar-wrap .ui-widget-header,
        .ui-tabs-nav li a span {
            background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }   
              
        .ui-tooltip, .ui-tooltip .arrow:after {
            background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?> !important;
        }

        /* Slideshow Text color */
        #fwslider .title,
        #fwslider .description {
            color: <?php echo esc_attr( get_option( 'boss_slideshow_font_color' ) ); ?>;
        }
        
        /* Fonts */
        body, p,
        #profile-nav span,
        #wp-admin-bar-shortcode-secondary .alert,
        .header-notifications a.notification-link span {
			font-family: <?php echo buddyboss_get_fontstack( 'boss_body_font_family' ); ?>;
		}
		
		.site-header #wp-admin-bar-shortcode-secondary .alert,
		.header-notifications a.notification-link span,
		.entry-meta .comments-link a,
        .entry-meta .post-date time {
            font-family: <?php echo buddyboss_get_fontstack( 'boss_body_font_family' ); ?>;
        }
		
		h1, h2, h3, h4, h5, h6 {
			font-family: <?php echo buddyboss_get_fontstack( 'boss_heading_font_family' ); ?>;
		}
		
		/* Page, Slide titles and statistics texts*/
		h1.main-title,
		#item-header-content h1,
		#fwslider .slide .title,
        .group-info li p:first-child,
        #item-statistics .numbers span p:first-child {
			font-family: <?php echo buddyboss_get_fontstack( 'boss_slideshow_font_family', 'source' ); ?>;
		}
        
        /************** BuddyPress **************************/
        
        /* Covers */
        
        /*** Profile Cover ****/
        <?php 
        $pc_height = esc_attr( get_option( 'boss_cover_profile_size' ) );
        if(!empty($pc_height)){
            if($pc_height == '200' ) {
        ?>
        
        /* ---------------- Desktop ---------------- */
        .is-desktop .network-profile #item-header {
            min-height: <?php echo $pc_height; ?>px;
        }

        .is-desktop.bp-user .bb-cover-photo,
        .is-desktop.bp-user #buddypress #item-header-cover > .table-cell {
            height: <?php echo $pc_height; ?>px;
        }

        .is-desktop.bp-user #buddypress div#item-header img.avatar {
            max-width: 90px;
        }

        .is-desktop.bp-user #item-header-content {
            margin-top: 0;
        }
        /* ---------------- End Desktop ---------------- */
        
        <?php } elseif($pc_height == 'none' ) {?>
          
        .bp-user .bb-cover-photo {
            display: none;  
        }
          
        .bp-user #buddypress #item-header-cover {
            position: relative;
        }
          
        .network-profile #buddypress #item-header-cover .cover-content > .table-cell:first-child {
            background: <?php echo esc_attr( get_option( 'boss_cover_color' ) ); ?>;
        }
           
        /* ---------------- Desktop ---------------- */    
        .is-desktop .network-profile #item-header {
            min-height: 200px;
        }

        .is-desktop.bp-user .bb-cover-photo,
        .is-desktop.bp-user #buddypress #item-header-cover > .table-cell {
            height: 200px;
        } 

        .is-desktop .network-profile #item-header {
            background: transparent;  
        }
        .is-desktop.bp-user .cover-content {
            padding: 30px 0;
        }

        .is-desktop.bp-user #buddypress #item-header-cover {
            background: <?php echo esc_attr( get_option( 'boss_cover_color' ) ); ?>;
        }
        /* ---------------- End Desktop ---------------- */
        <?php }
        }
        ?>  
        
        /*** Group Cover ****/       
        <?php 
        $gc_height = esc_attr( get_option( 'boss_cover_group_size' ) );
        if(!empty($gc_height)){
            if($gc_height != '322') {
        ?>  
           /* ---------------- Desktop ---------------- */ 
            .is-desktop .group-single #item-header {
                min-height: 200px;
            }

            .is-desktop.single-item.groups .bb-cover-photo,
            .is-desktop.single-item.groups #buddypress #item-header-cover > .table-cell {
                height: 200px;
            }

            .is-desktop .group-single #buddypress #item-header-content {
                margin-top: 15px;
                margin-bottom: 15px;
            }

            .is-desktop .group-single #buddypress .single-member-more-actions, 
            .is-desktop .group-single #buddypress div#item-header div.generic-button {
                margin-top: 0;
            }

            .is-desktop .group-info li p:first-child {
                font-size: 20px;
            }

            .is-desktop .group-single h1.main-title {
                font-size: 50px;
            }

            .is-desktop div#group-name {
                padding-bottom: 15px;
            } 
                        
            @media screen and (max-width: 900px) and (min-width: 721px) {
               .is-desktop .group-single #buddypress #item-header-cover #item-header-avatar > a {
                    padding-top: 10px;
                }
                
                .is-desktop .group-single #buddypress #item-header-content {
                    margin-top: 15px;
                    margin-bottom: 15px;
                }
                
                .is-desktop .group-single #buddypress #item-header-cover > .table-cell:first-child {
                    vertical-align: bottom;
                }
                
                .is-desktop div#group-name h1 {
                    font-size: 34px;
                }
                
                .is-desktop .group-info li p:first-child {
                    font-size: 16px;
                }
                
                .is-desktop .group-info li p:nth-child(2) {
                    font-size: 12px;
                }
            }
            
            @media screen and (max-width: 1000px) and (min-width: 721px) {
                .is-desktop.left-menu-open .group-single #buddypress #item-header-cover #item-header-avatar > a {
                    padding-top: 10px;
                }

                .is-desktop.left-menu-open .group-single #buddypress #item-header-content {
                    margin-top: 15px;
                    margin-bottom: 15px;
                }

                .is-desktop.left-menu-open .group-single #buddypress #item-header-cover > .table-cell:first-child {
                    vertical-align: bottom;
                }

                .is-desktop.left-menu-open div#group-name h1 {
                    font-size: 34px;
                }

                .is-desktop.left-menu-open .group-info li p:first-child {
                    font-size: 16px;
                }

                .is-desktop.left-menu-open .group-info li p:nth-child(2) {
                    font-size: 12px;
                }
            }
            /* ---------------- End Desktop ---------------- */

        <?php } 
            if($gc_height == 'none'){
        ?>
           
            .group-single .bb-cover-photo {
                display: none;  
            }

            .group-single #buddypress #item-header-cover {
                position: relative;
            }
            
            /* ---------------- Desktop ---------------- */
            .is-desktop .group-single #buddypress #item-header-cover {
                background: <?php echo esc_attr( get_option( 'boss_cover_color' ) ); ?>;
            }
            /* ---------------- End Desktop ---------------- */
            
            /* ---------------- Mobile ---------------- */
            .is-mobile .group-single #buddypress #item-header-cover > .table-cell {
                padding: 0;
            }
            .is-mobile .group-single #buddypress #item-header-cover > .table-cell {
                padding-left: 30px;
                padding-right: 30px;
                background: <?php echo esc_attr( get_option( 'boss_cover_color' ) ); ?>;
            }
            /* ---------------- End Mobile ---------------- */
           
        <?php }
        }
        ?>   

        #buddypress #activity-stream .activity-meta .unfav.bp-secondary-action:before {
            color: <?php echo esc_attr( get_option( 'boss_cover_profile_size' ) ); ?>;
        }       
        
        /* Activities */
        #buddypress #activity-stream .activity-meta .unfav.bp-secondary-action:before {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        /* Tabs */
        .directory.activity .item-list-tabs ul li.selected a ,
        .dir-form .item-list-tabs ul li.selected a,
        .directory.activity .item-list-tabs ul li ,
        .dir-form .item-list-tabs ul li {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        .item-list li .item-meta .count, 
        .directory.activity .item-list-tabs ul li a span ,
        .dir-form .item-list-tabs ul li a span {
            background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        /* Groups Create */
        .entry-content #group-create-body h4, 
        #buddypress .standard-form div.submit #group-creation-previous,
        #buddypress div#group-create-tabs ul.inverse > li,
        #buddypress div#group-create-tabs ul li.current a {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        #buddypress .standard-form div.submit #group-creation-previous,
        #buddypress div#group-create-tabs ul.inverse > li {
            border-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        /* Cover */
        .entry-post-thumbnail,
        .bb-cover-photo,
        .bb-cover-photo .progress {
             background-color: <?php echo esc_attr( get_option( 'boss_cover_color' ) ); ?>;
        }
         
        .bb-cover-photo .update-cover-photo div {
            background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        /* Item List */
        #friend-list li .action div.generic-button:nth-child(2n) a,
        #members-stream li .action div.generic-button:nth-child(2n) a ,
        #members-list li .action div.generic-button:nth-child(2n) a,
        #buddypress div#item-nav .item-list-tabs ul li.current > a,
        #buddypress div#item-nav .item-list-tabs ul li:hover > a {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        #buddypress div#item-nav .item-list-tabs > ul > li.current,
        #buddypress div#item-nav .item-list-tabs > ul > li:not(.hideshow):hover {
            border-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        .header-account-login .pop #dashboard-links .menupop a span, 
        .header-account-login .pop ul > li > .ab-sub-wrapper > ul li a span,
        #buddypress div#item-nav .item-list-tabs ul li a span {
            background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        #friend-list li .action div.generic-button:nth-child(2n) a,
        #members-stream li .action div.generic-button:nth-child(2n) a ,
        #members-list li .action div.generic-button:nth-child(2n) a{
            border-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        /* Fav icon */
        
        #buddypress #activity-stream .acomment-options .acomment-like.unfav-comment:before, #buddypress #activity-stream .activity-meta .unfav.bp-secondary-action:before {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        /* Group Settings */
        #buddypress form#group-settings-form ul.item-list > li > span a,
        #buddypress form#group-settings-form h4 {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        /* Private Messaging Threads */
        #message-threads.messages-table tbody tr a,
        #message-threads.notices-table a.button {
            color: <?php echo esc_attr( get_option( 'boss_links_pr_color' ) ); ?>;
        }        
        #message-threads.messages-table tbody tr a:hover,
        #message-threads.notices-table a.button:hover {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        /* Widgets */
        .secondary-inner #item-actions #group-admins img.avatar,
        .widget-area .widget ul.item-list img.avatar {
            border-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        } 
         
        /************* BBPress ************************/
         
        #bbpress-forums li.bbp-header,
        #bbpress-forums li.bbp-footer {
             background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
             border-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
         }
         
        .bbp-topic-details .bbp-forum-data .post-num ,
        .bbp-forum-details .bbp-forum-data .post-num {
             color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
         }
         
         .bbp-logged-in img.avatar {
             border-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }    
        
        /************ Other Plugins **********************/
        #buddypress div#item-nav .search_filters.item-list-tabs ul li.forums a span {
            background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>; 
        }
        .results-group-forums .results-group-title span {
            border-bottom-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        .item-list-tabs.bps_header input[type="submit"],  
        .bboss_ajax_search_item .item .item-title {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        
        .item-list-tabs.bps_header input[type="submit"]:hover {
            color: <?php echo esc_attr( get_option( 'boss_links_pr_color' ) ); ?>;
        }
        
        .service i {
            box-shadow: 0 0 0 3px <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }  
              
        .service i:after {
            background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
       
        /* ---------------- Mobile ---------------- */

        /* Navigation */
        .is-mobile .menu-panel {
            background-color: <?php echo esc_attr( get_option( 'boss_panel_color' ) ); ?>;
        }

        .is-mobile #mobile-header {
           background-color: <?php echo esc_attr( get_option( 'boss_layout_mobiletitlebar_bgcolor' ) ); ?>; 
        }

        .is-mobile .menu-panel #nav-menu > ul > li.current-menu-item > a {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }

        .is-mobile .menu-panel #nav-menu > ul > li.dropdown > a:before,
        .is-mobile .menu-panel .bp_components ul li ul li.menupop.dropdown > a:before {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }

        /* Header */
        .is-mobile #mobile-header h1 a {
            color: <?php echo esc_attr( get_option( 'boss_title_color' ) ); ?>;
        }

        /* Fonts */
        .is-mobile #mobile-header h1 a {
            font-family: <?php echo buddyboss_get_fontstack( 'boss_site_title_font_family', 'pacifico' ); ?>;
        }


        /************************ BuddyPress *****************/

        /* Tabs */
        .is-mobile #buddypress div#subnav.item-list-tabs ul li.current a,
        .is-mobile #buddypress #mobile-item-nav ul li:active,
        .is-mobile #buddypress #mobile-item-nav ul li.current,
        .is-mobile #buddypress #mobile-item-nav ul li.selected {
            background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        .is-mobile #buddypress #mobile-item-nav ul li,
        .is-mobile #buddypress div#subnav.item-list-tabs ul li a {
            background-color: <?php echo esc_attr( get_option( 'boss_panel_color' ) ); ?>;
        }
        .is-mobile #buddypress div.item-list-tabs ul li.current a,
        .is-mobile #buddypress div.item-list-tabs ul li.selected a {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }
        .is-mobile #buddypress div#subnav.item-list-tabs ul li a {
            color: #fff;
        }

        /* ---------------- End Mobile ---------------- */
        
        /* ---------------- Desktop ---------------- */
        body.is-desktop {
            background-color: <?php echo esc_attr( get_option( 'boss_panel_color' ) ); ?>;   
        } 

        /* Cover Buttons */
        .is-desktop #item-buttons .pop .inner a {
            color: <?php echo esc_attr( get_option( 'boss_panel_logo_color' ) ); ?>;
        }
        .is-desktop #item-buttons .pop .inner a:hover {
            color: #fff;
            background-color: <?php echo esc_attr( get_option( 'boss_panel_logo_color' ) ); ?>;
        }

        /* Logo Area */
        .is-desktop #mastlogo {
            background-color: <?php echo esc_attr( get_option( 'boss_panel_logo_color' ) ); ?>;
        }

        /* Logo Area */
        <?php if(get_option( 'boss_panel_color' )) {?>
        .is-desktop .menu-panel .sub-menu-wrap:before, 
        .is-desktop .menu-panel .ab-sub-wrapper:before {
            border-color: transparent <?php echo esc_attr( get_option( 'boss_panel_color' ) ); ?> transparent transparent;
        }
        <?php } ?>

        <?php
        if( get_option( 'buddyboss_adminbar' ) !== '0' ){
            echo '.is-desktop .header-account-login #adminbar-links { display: block; }';
        } else {
            echo '.is-desktop .header-account-login #adminbar-links { display: none; }';
        }
        ?>

        /* Header */
        .header-account-login a {
            color: <?php echo esc_attr( get_option( 'boss_body_font_color' ) ); ?>;
        }

        .header-account-login .pop .bp_components .menupop:not(#wp-admin-bar-my-account) > .ab-sub-wrapper li.active a, 
        .header-account-login .pop .links li > .sub-menu li.active a,
        .header-account-login a:hover {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        } 

        .header-navigation li.hideshow ul,
        .header-account-login .pop .bp_components .menupop:not(#wp-admin-bar-my-account) > .ab-sub-wrapper:before, .header-account-login .pop .links li > .sub-menu:before,
        .header-account-login .pop .bp_components .menupop:not(#wp-admin-bar-my-account) > .ab-sub-wrapper, 
        .header-account-login .pop .links li > .sub-menu,
        .bb-global-search-ac.ui-autocomplete,
        .site-header #wp-admin-bar-shortcode-secondary .ab-sub-wrapper,
        .header-notifications .pop, .header-account-login .pop,
        .header-inner .search-wrap, 
        .header-inner {
            background-color: <?php echo esc_attr( get_option( 'boss_layout_titlebar_bgcolor' ) ); ?>;
        } 

        .page-template-page-no-buddypanel .header-inner .search-wrap,
        .page-template-page-no-buddypanel .header-inner,
        .page-template-page-no-buddypanel #mastlogo {
            background-color: <?php echo esc_attr( get_option( 'boss_layout_nobp_titlebar_bgcolor' ) ); ?>;
        }

        body:not(.left-menu-open).is-desktop #mastlogo h1.site-title a:first-letter,
        .is-desktop #mastlogo h1.site-title a {
            color: <?php echo esc_attr( get_option( 'boss_title_color' ) ); ?>;
        }

        /* Footer */
        div.footer-inner ul.social-icons li a span,
        #switch_submit {
            border: 1px solid <?php echo esc_attr( get_option( 'boss_layout_footer_bottom_color' ) ); ?>;
        }
        
        div.footer-inner ul.social-icons li a span,
        #switch_submit,
        .footer-credits, .footer-credits a, #footer-links a,
        #footer-links a.to-top {
            color: <?php echo esc_attr( get_option( 'boss_layout_footer_bottom_color' ) ); ?>;
        }
        
        .footer-credits a:hover {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }

        /* Fonts */
        .is-desktop #mastlogo h1.site-title {
            font-family: <?php echo buddyboss_get_fontstack( 'boss_site_title_font_family', 'pacifico' ); ?>;
        }

        /******************** BuddyPress *****************/

        /* Activities */
       .is-desktop #buddypress .activity-list li.load-more a,
       .is-desktop #buddypress .activity-list li.load-newest a {
           background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
       }

       /* Private Messaging Threads */
       .is-desktop.bp-user.messages #buddypress div#subnav.item-list-tabs ul li.current a:after,
       .is-desktop.bp-user.messages #buddypress div#subnav.item-list-tabs ul li:first-child a {
           background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
       }        

       /************ Other Plugins **********************/
        .is-desktop button:not(#searchsubmit):not(.update-cover-photo)#buddyboss-media-add-photo-button {
            background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }

        /*** Header Links ****/
        .site-header #wp-admin-bar-shortcode-secondary .ab-icon:before,
        .header-account-login a,
        .header-notifications a.notification-link,
        .header-notifications .pop a, 
        #wp-admin-bar-shortcode-secondary .thread-from a,
        #masthead #searchsubmit,  
        .header-navigation ul li a,
        .header-inner .left-col a,
        #wp-admin-bar-shortcode-secondary .notices-list li p,
        .header-inner .left-col a:hover
        {
            color: <?php echo esc_attr( get_option( 'boss_layout_titlebar_color' ) ); ?>;
        }

        .header-navigation ul li.current-menu-item a,
        .header-navigation ul li.current-page-item a,
        .header-navigation ul li.current_page_item a,
        #wp-admin-bar-shortcode-secondary .thread-from a:hover,
        .header-notifications .pop a:hover,
        .header-navigation ul li a:hover {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
        }

        .page-template-page-no-buddypanel .header-account-login > a,
        .page-template-page-no-buddypanel .site-header #wp-admin-bar-shortcode-secondary .ab-icon:before,
        .page-template-page-no-buddypanel .header-notifications a.notification-link,
        .page-template-page-no-buddypanel #wp-admin-bar-shortcode-secondary .thread-from a,
        .page-template-page-no-buddypanel #masthead #searchsubmit,
        .page-template-page-no-buddypanel .header-navigation ul li a,
        .page-template-page-no-buddypanel .header-inner .left-col a,
        .page-template-page-no-buddypanel .header-inner .left-col a:hover {
            color: <?php echo esc_attr( get_option( 'boss_layout_nobp_titlebar_color' ) ); ?>;
        }
        
        .page-template-page-no-buddypanel .header-account-login > a, 
        .page-template-page-no-buddypanel .header-inner .search-wrap input[type="text"] {
            color: <?php echo esc_attr( get_option( 'boss_layout_nobp_titlebar_color' ) ); ?>;
        }

        .page-template-page-no-buddypanel .header-account-login a:hover,
        .page-template-page-no-buddypanel .header-notifications .pop a:hover,
        .page-template-page-no-buddypanel .header-navigation ul li a:hover {
            color: <?php echo esc_attr( get_option( 'boss_layout_nobp_titlebar_hover_color' ) ); ?>;
        }
        
        /* ---------------- End Desktop ---------------- */
          
        /******************* Color Schemes **********************/

        <?php 
        $theme = get_option('boss_scheme_select');
    
        if(!empty($theme) && $theme != 'default') { 

        ?>

            /*** Dropdown ***/
            .bb-global-search-ac li.bbls-category {
                color: <?php echo esc_attr( get_option( 'boss_heading_font_color' ) ); ?>;
            }

            /*** Header Buttons ****/
            .right-col .register, 
            .right-col .login,
            .header-account-login .pop .logout a {
                background-color: #fff;
                color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
            }
            
            #wp-admin-bar-shortcode-secondary a {
                color: #fff;
            }

            /*** Header Links Hover ****/
            .header-account-login .pop .bp_components .menupop:not(#wp-admin-bar-my-account) > .ab-sub-wrapper li.active a,
            .header-account-login .pop .links li > .sub-menu li.current-menu-item a,
            .header-account-login .pop .links li > .sub-menu li.current-menu-parent a,
            #wp-admin-bar-shortcode-secondary a:hover,
            #wp-admin-bar-shortcode-secondary .thread-from a:hover,
            .header-account-login a:hover,
            .header-notifications a.notification-link:hover,
            #wp-admin-bar-shortcode-secondary a:hover .ab-icon:before,
            .header-navigation ul li.current-menu-item a,
            .header-navigation ul li.current-page-item a,
            .header-navigation ul li.current_page_item a,
            .header-notifications .pop a:hover,
            #masthead #searchsubmit:hover,  
            .header-navigation ul li a:hover {
                 color: rgba(255,255,255,0.7);
             }

             /*** Search Border ****/
             .header-inner .search-wrap {
                 border: none;
             }
             
             .error404 #primary .search-wrap {
                 border: none;
            }
            
            .error404 #primary .search-wrap input[type="text"] {
                 height: 50px;
             }

            /******* Footer Bottom Text ******/
             .footer-credits, .footer-credits a, #footer-links a {
                 color: <?php echo esc_attr( get_option( 'boss_layout_footer_bottom_color' ) ); ?>;
             } 

             /******* Tabs ******/
             
             <?php if($theme != 'mint' && $theme != 'iceberg') { ?>
             .ui-tabs-nav.btn-group li.btn:first-child:not(:last-child), .ui-tabs-nav.btn-group li.btn,
             .ui-accordion.accordion h3.ui-accordion-header,
             .ui-accordion-content .inner,
             .directory.activity .item-list-tabs ul li:last-child, .dir-form .item-list-tabs ul li:last-child,
             .directory.activity .item-list-tabs ul li, .dir-form .item-list-tabs ul li {
                 border-color: #fff;
             }

            .ui-tabs-nav li.ui-state-default a,
            .directory.activity .item-list-tabs ul li a, .dir-form .item-list-tabs ul li a {
                 color: #fff;
             }  
            <?php } ?>
                           
            .ui-tabs-nav li.ui-state-active a,
            .ui-accordion.accordion h3.ui-accordion-header,
            .ui-accordion.accordion h3.ui-accordion-header-active:after {
                color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
            }            

            /***** Input ******/ 
            input[type="text"]:not([name="s"]),
            input[type="email"],
            input[type="url"],
            input[type="password"],
            input[type="search"],
            textarea {
                background-color: <?php echo esc_attr( get_option( 'boss_panel_color' ) ); ?>;
                -webkit-box-shadow: none;
                -moz-box-shadow:    none;
                box-shadow:         none;
            }

            input[type="text"]:not([name="s"]):focus,
            input[type="email"]:focus,
            input[type="url"]:focus,
            input[type="password"]:focus,
            input[type="search"]:focus, 
            textarea:focus {
                background-color: <?php echo esc_attr( get_option( 'boss_panel_color' ) ); ?>;
                -webkit-box-shadow:  inset 0px 1px 2px 1px rgba(0, 0, 0, 0.3);
                -moz-box-shadow:     inset 0px 1px 2px 1px rgba(0, 0, 0, 0.3);
                box-shadow:          inset 0px 1px 2px 1px rgba(0, 0, 0, 0.3);
            }

        <?php } ?>
        
        <?php if($theme == 'royalty' || $theme == 'nocturnal') { ?>
          
          /***** Sitewide notice *****/
          div#sitewide-notice div#message p {
              color: #fff;
          }
          /***** 404 *****/
           .error404 .entry-content p, .error404 h1 {
               color: <?php echo esc_attr( get_option( 'boss_body_font_color' ) ); ?>;
           }
            /******* ******* ******/
           .widget-area .widget ul.item-list .item .item-meta,
            .widget.widget_buddyboss_recent_post .post-time,
           .widget-area .widget div.item-options a:not(.selected),
            #primary #members-list li .item-meta span:not(.count),
            #primary .item-list li .item-meta span:not(.count).desktop,
            #primary .item-list li .item-meta span:not(.count).activity,
            #primary .item-list li .item-meta .meta-wrap span:not(.count) {
                color: <?php echo esc_attr( get_option( 'boss_body_font_color' ) ); ?>;
                opacity: 0.6;
            }
            
            /******* Small Searches ******/
            .groups-members-search input[type="text"], 
            #buddypress div.dir-search input[type="text"], 
            #bbpress-forums #bbp-search-index-form input#bbp_search, 
            #buddypress #search-message-form input[type="text"] {
                color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
            }

            input[type="text"]:not([name="s"]),
            input[type="email"],
            input[type="url"],
            input[type="password"],
            input[type="search"],
            textarea {
                color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
            }
            
            /***** Input ******/ 
            ::-webkit-input-placeholder {
                color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
                opacity: 0.6;
            }
            :-moz-placeholder { 
                color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
                opacity: 0.6;
            }
            ::-moz-placeholder {  
                color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
                opacity: 0.6;
            }
            :-ms-input-placeholder {  
                color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
                opacity: 0.6;
            }
            
            #respond form textarea::-webkit-input-placeholder {
               color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
               opacity: 0.6;
            }
            #respond form textarea:-moz-placeholder { 
               color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>; 
               opacity: 0.6;
            }
            #respond form textarea::-moz-placeholder {  
               color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
               opacity: 0.6;
            }
            #respond form textarea:-ms-input-placeholder {  
               color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>; 
               opacity: 0.6;
            }

            /***** Tabs ******/ 
            #buddypress #mobile-item-nav ul li a {
            	color: #fff;
        	}
        <?php } ?>
         
        
        <?php if($theme == 'royalty') { ?>
            /******* Light borders ******/
            #bbp-search-index-form, #search-message-form, .groups-members-search, #buddypress div.dir-search,
             .directory.activity .item-list-tabs ul li:last-child, .dir-form .item-list-tabs ul li:last-child,
             .directory.activity .item-list-tabs ul li, .dir-form .item-list-tabs ul li {
                 border-color: #dfe3e6;
             }

             .directory.activity .item-list-tabs ul li a, .dir-form .item-list-tabs ul li a {
                 color: #dfe3e6;
             }
             
            /******* Global borders ******/
            hr,
            .progressbar,
            form#group-settings-form hr
            {
                background-color: #6e5b71;
            }

            div#sitewide-notice div#message p,
            .archive-header, .comments-area ol.children, #bbp-search-index-form, #search-message-form, .groups-members-search, #buddypress div.dir-search,
            .author.archive .author-info, 
            .secondary-inner #item-actions,
            #group-description,
            #secondary.widget-area .widget,
            .widget-area .widget div.item-options,
            div.footer-inner-top,
            .footer-inner.widget-area,
            .footer-inner-bottom,
            .single .site-content article.post,
            .filters,
            .post-wrap,
            .commentlist > li.comment,
            .search-results .page-header,
            .entry-meta.mobile,
            .footer-inner.widget-area .footer-widget .widget,
            .header-account-login .pop .network-menu,
            .header-account-login .pop #dashboard-links,
            .header-account-login .pop .logout,
            .directory.activity .item-list-tabs ,
            .dir-form .item-list-tabs,
            #group-create-body .big-caps,
            #buddypress .profile-fields tr td,
            #buddypress table.notification-settings th,
            .secondary-inner > a img,
            #primary .item-list li, 
            #buddypress div#message-threads,
            #buddypress div#message-threads ul,
            div#register-page .register-section,
            div#register-page .security-question-section,
            #buddypress div.activity-comments ul li,
            #buddypress div.activity-comments form.ac-form,
            #buddypress ul.item-list li div.action .action-wrap,
            #buddypress .activity-list li.new_forum_post .activity-content .activity-inner,
            #buddypress .activity-list li.new_forum_topic .activity-content .activity-inner,
            .bp-user.messages #buddypress div#subnav.item-list-tabs ul li:first-child,
            #contentcolumn,
            #bbpress-forums li.bbp-body ul.forum,
            #bbpress-forums li.bbp-body ul.topic,
            .bp-user.messages #buddypress div.pagination {
                border-color: #6e5b71;
            }
            
            #primary, #secondary {
                border-color: #6e5b71!important;
            }

            @media screen and (max-width: 820px) and (min-width:721px){
                body.left-menu-open.is-desktop .footer-widget:not(:last-child) {
                    border-color: #6e5b71;
                }
            }

            .is-mobile #item-buttons .pop .inner {
                border-color: #6e5b71;
            }

            @media screen and (max-width: 1000px) and (min-width:721px) {
                body.left-menu-open.messages.bp-user.is-desktop #secondary {
                    border-color: #6e5b71;
                }
            }
            
        
        <?php } ?>
        
        <?php if( $theme == 'seashell') { ?>

            hr,
            .progressbar,
            form#group-settings-form hr
            {
                background-color: #c3e7e5;
            }

            div#sitewide-notice div#message p,
            .archive-header,  .comments-area ol.children, #bbp-search-index-form, #search-message-form, .groups-members-search, #buddypress div.dir-search,
            .author.archive .author-info,
            .secondary-inner #item-actions,
            #group-description,
            #secondary.widget-area .widget,
            .widget-area .widget div.item-options,
            div.footer-inner-top,
            .footer-inner.widget-area,
            .footer-inner-bottom,
            .single .site-content article.post,
            .filters,
            .post-wrap,
            .commentlist > li.comment,
            .search-results .page-header,
            .entry-meta.mobile,
            .footer-inner.widget-area .footer-widget .widget,
            .header-account-login .pop .network-menu,
            .header-account-login .pop #dashboard-links,
            .header-account-login .pop .logout,
            .directory.activity .item-list-tabs ,
            .dir-form .item-list-tabs,
            #group-create-body .big-caps,
            #buddypress .profile-fields tr td,
            #buddypress table.notification-settings th,
            .secondary-inner > a img,
            #primary .item-list li, 
            #buddypress div#message-threads,
            #buddypress div#message-threads ul,
            div#register-page .register-section,
            div#register-page .security-question-section,
            #buddypress div.activity-comments ul li,
            #buddypress div.activity-comments form.ac-form,
            #buddypress ul.item-list li div.action .action-wrap,
            #buddypress .activity-list li.new_forum_post .activity-content .activity-inner,
            #buddypress .activity-list li.new_forum_topic .activity-content .activity-inner,
            .bp-user.messages #buddypress div#subnav.item-list-tabs ul li:first-child,
            #contentcolumn,
            #bbpress-forums li.bbp-body ul.forum,
            #bbpress-forums li.bbp-body ul.topic,
            .bp-user.messages #buddypress div.pagination {
                border-color: #c3e7e5;
            }

            #primary, #secondary {
                border-color: #c3e7e5!important;
            }

            @media screen and (max-width: 820px) and (min-width:721px){
                body.left-menu-open.is-desktop .footer-widget:not(:last-child) {
                    border-color: #c3e7e5;
                }
            }            
               
            .is-mobile #item-buttons .pop .inner {
                border-color: #c3e7e5;
            }

            @media screen and (max-width: 1000px) and (min-width:721px) {
                body.left-menu-open.messages.bp-user.is-desktop #secondary {
                    border-color: #c3e7e5;
                }
            }

        <?php } ?>
        
        
        <?php if($theme == 'starfish') { ?>
        
            /*** Header Notifications ****/
            .directory.activity .item-list-tabs ul li a span, .dir-form .item-list-tabs ul li a span,
            #profile-nav span,
            .header-account-login .pop #dashboard-links .menupop a span, 
            .header-account-login .pop ul > li > .ab-sub-wrapper > ul li a span,
            .site-header #wp-admin-bar-shortcode-secondary .alert,
            .header-notifications a.notification-link span {
                background-color: <?php echo esc_attr( get_option( 'boss_links_pr_color') ); ?>;
            }

            /******* Input  ******/

            input[type="text"]:not([name="s"]),
            input[type="email"],
            input[type="url"],
            input[type="password"],
            input[type="search"],
            textarea {
                background-color: #efefef;
                -webkit-box-shadow: none;
                -moz-box-shadow:    none;
                box-shadow:         none;
            }

            input[type="text"]:not([name="s"]):focus,
            input[type="email"]:focus,
            input[type="url"]:focus,
            input[type="password"]:focus,
            input[type="search"]:focus, 
            textarea:focus {
               color: <?php echo esc_attr( get_option( 'boss_links_pr_color') ); ?>; 
                background-color: #fff;
                 -webkit-box-shadow: none;
                -moz-box-shadow:    none;
                box-shadow:         none;
            }

            /******* Icons  ******/
            .tablet .menu-panel #nav-menu > ul > li.dropdown > a:before, 
            .tablet .menu-panel .bp_components ul li ul li.menupop.dropdown > a:before, 
            body:not(.tablet) .menu-panel .screen-reader-shortcut:hover:before, 
            body:not(.tablet) .menu-panel #nav-menu > ul > li:hover > a:before, 
            body:not(.tablet) .menu-panel .bp_components ul li ul li.menupop:hover > a:before {
                color: <?php echo esc_attr( get_option( 'boss_cover_color') ); ?>;         
            } 

            /******* Tabs ******/
            .ui-tabs-nav.btn-group li.btn:first-child:not(:last-child), .ui-tabs-nav.btn-group li.btn,
            .ui-accordion.accordion h3.ui-accordion-header,
            .ui-accordion-content .inner,
            .directory.activity .item-list-tabs ul li:last-child, .dir-form .item-list-tabs ul li:last-child,
            .directory.activity .item-list-tabs ul li, .dir-form .item-list-tabs ul li {
                 border-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
            }
            
            .ui-tabs-nav li.ui-state-default a,
            .directory.activity .item-list-tabs ul li a, .dir-form .item-list-tabs ul li a {
                 color: <?php echo esc_attr( get_option( 'boss_links_pr_color' ) ); ?>;
             } 
             
             .ui-tabs-nav li.ui-state-active a, .ui-accordion.accordion h3.ui-accordion-header, .ui-accordion.accordion h3.ui-accordion-header-active:after {
                 color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
             }

        <?php } ?>
        

        <?php if( $theme == 'mint' ||  $theme == 'iceberg' ) { ?>
        
            /******* Input  ******/
            input[type="text"]:not([name="s"]),
            input[type="email"],
            input[type="url"],
            input[type="password"],
            input[type="search"],
            textarea {
                background-color: #efefef;
                -webkit-box-shadow: none;
                -moz-box-shadow:    none;
                box-shadow:         none;
            }

            input[type="text"]:not([name="s"]):focus,
            input[type="email"]:focus,
            input[type="url"]:focus,
            input[type="password"]:focus,
            input[type="search"]:focus, 
            textarea:focus {
               color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
                background-color: #efefef;
                 -webkit-box-shadow: none;
                -moz-box-shadow:    none;
                box-shadow:         none;
            }

        <?php } ?>
        
        
        <?php if( $theme == 'iceberg' || $theme == 'starfish' ||  $theme == 'battleship' ) { ?>

            .search-wrap input[type="text"] {
                color: <?php echo esc_attr( get_option( 'boss_layout_titlebar_color')); ?>; 
            }

        <?php } ?> 
        
        
        <?php if( $theme == 'iceberg' ) { ?>
        
            #masthead #searchsubmit {
                color: <?php echo esc_attr( get_option( 'boss_layout_titlebar_bgcolor')); ?>;
            }
        
        <?php } ?> 
         
        
        <?php if( $theme == 'nocturnal' ) { ?>
        
            #wp-admin-bar-shortcode-secondary a {
                color: <?php echo esc_attr( get_option( 'boss_layout_titlebar_color' ) ); ?>;
            }
        
            .bb-global-search-ac.ui-autocomplete:before {
                background-color: rgba(255,255,255,0.4);
            }
            
            /**** Panel *****/
            body:not(.tablet) .menu-panel #nav-menu > ul > li:hover, body:not(.tablet) .menu-panel ul li .menupop:hover,
            .left-menu-open .menu-panel #nav-menu > ul > li.current-menu-item:hover, .left-menu-open .menu-panel #nav-menu > ul > li.current-menu-parent:hover, .left-menu-open .menu-panel ul li .menupop.active:hover,
            
            .menu-panel #nav-menu > ul > li.dropdown, .menu-panel .bp_components ul li ul li.menupop.dropdown, .tablet .menu-panel #nav-menu > ul > li.current-menu-item, .tablet .menu-panel #nav-menu > ul > li.current-menu-parent, .tablet .bp_components ul li ul li.menupop.active, .menu-panel #nav-menu > ul > li.current-menu-item, .menu-panel #nav-menu > ul > li.current-menu-parent, .bp_components ul li ul li.menupop.active
            {
                background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
            }
                       
            .menu-panel #nav-menu > ul > li.dropdown > a, .menu-panel .bp_components ul li ul li.menupop.dropdown > a,
                        
            body:not(.tablet) .menu-panel #nav-menu > ul > li:hover > a, body:not(.tablet) .menu-panel #nav-menu  > ul > li:hover > a, body:not(.tablet) #left-panel .bp_components ul li ul li.menupop:hover > a,
            .menu-panel #nav-menu > ul > li.current-menu-item > a, .menu-panel #nav-menu  > ul > li.current-menu-parent > a, #left-panel .bp_components ul li ul li.menupop.active > a,
                        
            body:not(.tablet).left-menu-open .menu-panel #nav-menu > ul > li:hover > a, body:not(.tablet).left-menu-open .menu-panel #nav-menu  > ul > li:hover > a, body:not(.tablet).left-menu-open #left-panel .bp_components ul li ul li.menupop:hover > a,
            .left-menu-open .menu-panel #nav-menu > ul > li.current-menu-item > a, .left-menu-open .menu-panel #nav-menu  > ul > li.current-menu-parent > a, .left-menu-open #left-panel .bp_components ul li ul li.menupop.active > a
            {
                color: <?php echo esc_attr( get_option( 'boss_layout_titlebar_bgcolor')); ?>;
            }
            
            .menu-panel #nav-menu > ul > li.dropdown > a:before, .menu-panel .bp_components ul li ul li.menupop.dropdown > a:before,
            
             body:not(.tablet) .menu-panel #nav-menu > ul > li:hover > a:before,  body:not(.tablet) .menu-panel #nav-menu  > ul > li:hover > a:before, body:not(.tablet) #left-panel .bp_components ul li ul li.menupop:hover > a:before,
             .menu-panel #nav-menu > ul > li.current-menu-item > a:before,  .menu-panel #nav-menu  > ul > li.current-menu-parent > a:before,  #left-panel .bp_components ul li ul li.menupop.active > a:before,
            
            body:not(.tablet).left-menu-open .menu-panel #nav-menu > ul > li:hover > a:before, body:not(.tablet).left-menu-open .menu-panel #nav-menu  > ul > li:hover > a:before, body:not(.tablet).left-menu-open #left-panel .bp_components ul li ul li.menupop:hover > a:before,
            .left-menu-open .menu-panel #nav-menu > ul > li.current-menu-item > a:before, .left-menu-open .menu-panel #nav-menu  > ul > li.current-menu-parent > a:before, .left-menu-open #left-panel .bp_components ul li ul li.menupop.active > a:before
            {
                color: <?php echo esc_attr( get_option( 'boss_layout_titlebar_bgcolor')); ?> !important;
            }
            
             .menu-panel #nav-menu > ul > li.current-menu-item > a:after,  .menu-panel #nav-menu  > ul > li.current-menu-parent > a:after,  #left-panel .bp_components ul li ul li.menupop.active > a:after {
                 background-color: <?php echo esc_attr( get_option( 'boss_layout_titlebar_bgcolor')); ?> !important;
             }
             
             
             .menu-panel #nav-menu .sub-menu-wrap > a, .menu-panel ul li ul li .ab-sub-wrapper > .ab-item, .menu-panel #nav-menu .sub-menu-wrap > ul, .menu-panel ul li ul li .ab-sub-wrapper > ul {
                 background-color: #242223;
             }
             
             .menu-panel .sub-menu-wrap:before, .menu-panel .ab-sub-wrapper:before, .menu-panel .sub-menu-wrap:after, .menu-panel .ab-sub-wrapper:after {
                 border-color: transparent #242223 transparent transparent;
             }
             
             
            /*** Less visible texts ****/
            #buddypress #activity-stream div.acomment-options a.acomment-reply:before, #buddypress #activity-stream .acomment-options .bp-secondary-action:before, #buddypress #activity-stream .acomment-options .delete-activity-single:before, #buddypress #activity-stream .acomment-options .delete-activity:before, #buddypress div.activity-meta a.delete-activity, #buddypress div.activity-meta a.acomment-reply, #buddypress div.activity-meta a.unfav, #buddypress div.activity-meta a.fav, #buddypress div.activity-meta a.buddyboss_media_move, #buddypress #activity-stream .activity-meta .bp-secondary-action:before, #buddypress #activity-stream .activity-meta .delete-activity-single:before, #buddypress #activity-stream .activity-meta .delete-activity:before,
            .comments-area .edit-link a,
            .entry-actions a,
            .comments-area article footer > a {
                color: rgba(255,255,255,0.7);
            }
            
            #buddypress #activity-stream div.acomment-options a.acomment-reply:hover:before, #buddypress #activity-stream .acomment-options .delete-activity-single:hover:before, #buddypress #activity-stream .acomment-options .delete-activity:hover:before, #buddypress #activity-stream .acomment-options .bp-secondary-action:hover:before, #buddypress div.activity-meta a.unfav:hover:before, #buddypress div.activity-meta a.fav:hover:before, #buddypress div.activity-meta a.buddyboss_media_move:hover:before, #buddypress div.activity-meta a.acomment-reply:hover:before, #buddypress #activity-stream .activity-meta .delete-activity-single:hover:before, #buddypress #activity-stream .activity-meta .delete-activity:hover:before, #buddypress #activity-stream .activity-meta .bp-secondary-action:hover:before,
            .comments-area .edit-link a:hover,
            .comments-area article footer a:hover,
            .entry-actions a:hover,
            .comments-area article footer > a:hover {
                color: rgba(255,255,255, 1);
            }
            
            /******* Counters ******/
            .item-list li .item-meta .count, .directory.activity .item-list-tabs ul li a span, .dir-form .item-list-tabs ul li a span,
            .header-account-login .pop #dashboard-links .menupop a span, .header-account-login .pop ul > li > .ab-sub-wrapper > ul li a span, #buddypress div#item-nav .item-list-tabs ul li a span {
                color: <?php echo esc_attr( get_option( 'boss_layout_titlebar_bgcolor')); ?>;
            }
            
            /******* Notice ******/
            div#sitewide-notice div#message p {
                color: #fff;
                background-color: rgba(255,255,255,0.1);
            }

            /******* Site Title ******/
            body:not(.left-menu-open) #mastlogo h1.site-title a:first-letter, #mastlogo h1.site-title a {
                color: <?php echo esc_attr( get_option( 'boss_layout_titlebar_bgcolor')); ?>;
            }
            
            /******* Buttons ******/
            .right-col .register, .right-col .login, .header-account-login .pop .logout a {
               background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
               color: <?php echo esc_attr( get_option( 'boss_layout_titlebar_bgcolor')); ?>;
            }
            .btn:hover, button:hover, input[type="submit"]:hover, input[type="button"]:not(.button-small):hover, input[type="reset"]:hover, article.post-password-required input[type=submit]:hover, a.button:hover, #create-group-form .remove:hover, #buddypress ul.button-nav li a:hover, #buddypress ul.button-nav li.current a, #buddypress div.generic-button a:hover, #buddypress .comment-reply-link:hover, .entry-title a.button:hover, #buddypress div.activity-comments form input[disabled]:hover,
            .btn, button, input[type="submit"], input[type="button"]:not(.button-small), input[type="reset"], article.post-password-required input[type=submit], li.bypostauthor cite span, a.button, #create-group-form .remove, #buddypress ul.button-nav li a, #buddypress div.generic-button a, #buddypress .comment-reply-link, .entry-title a.button, span.create-a-group > a, #buddypress div.activity-comments form input[disabled]
            {
                color: <?php echo esc_attr( get_option( 'boss_layout_titlebar_bgcolor')); ?>;
            }
            
            /******* Global borders ******/
            hr,
            .progressbar,
            form#group-settings-form hr
            {
                background-color: rgba(255,255,255,0.1);
            }

            div#sitewide-notice div#message p,
            .archive-header,  .comments-area ol.children, #bbp-search-index-form, #search-message-form, .groups-members-search, #buddypress div.dir-search,
            .author.archive .author-info,
            .secondary-inner #item-actions,
            #group-description,
            #secondary.widget-area .widget,
            .widget-area .widget div.item-options,
            div.footer-inner-top,
            .footer-inner.widget-area,
            .footer-inner-bottom,
            .single .site-content article.post,
            .filters,
            .post-wrap,
            .commentlist > li.comment,
            .search-results .page-header,
            .entry-meta.mobile,
            .footer-inner.widget-area .footer-widget .widget,
            .header-account-login .pop .network-menu,
            .header-account-login .pop #dashboard-links,
            .header-account-login .pop .logout,
            .directory.activity .item-list-tabs ,
            .dir-form .item-list-tabs,
            #group-create-body .big-caps,
            #buddypress .profile-fields tr td,
            #buddypress table.notification-settings th,
            .secondary-inner > a img,
            #primary .item-list li, 
            #buddypress div#message-threads,
            #buddypress div#message-threads ul,
            div#register-page .register-section,
            div#register-page .security-question-section,
            #buddypress div.activity-comments ul li,
            #buddypress div.activity-comments form.ac-form,
            #buddypress ul.item-list li div.action .action-wrap,
            #buddypress .activity-list li.new_forum_post .activity-content .activity-inner,
            #buddypress .activity-list li.new_forum_topic .activity-content .activity-inner,
            .bp-user.messages #buddypress div#subnav.item-list-tabs ul li:first-child,
            #contentcolumn,
            #bbpress-forums li.bbp-body ul.forum,
            #bbpress-forums li.bbp-body ul.topic,
            .bp-user.messages #buddypress div.pagination {
                border-color: rgba(255,255,255,0.1);
            }
            
            #primary, #secondary {
                border-color: rgba(255,255,255,0.1) !important;
            }

            @media screen and (max-width: 820px) and (min-width:721px){
                body.left-menu-open.is-desktop .footer-widget:not(:last-child) {
                    border-color: rgba(255,255,255,0.1);
                }
            }
            
            .is-mobile #item-buttons .pop .inner {
                border-color: rgba(255,255,255,0.1);
            }

            @media screen and (max-width: 1000px) and (min-width:721px) {
                body.left-menu-open.messages.bp-user.is-desktop #secondary {
                    border-color: rgba(255,255,255,0.1);
                }
            }
        
        <?php } ?> 
        
        
        <?php if( $theme == 'mint' ) { ?>
           
            .page-template-page-no-buddypanel .header-notifications .pop a:hover, .page-template-page-no-buddypanel .header-navigation ul li a:hover {
                color: <?php echo esc_attr( get_option( 'boss_heading_font_color' ) ); ?>;
            }
            
            .page-template-page-no-buddypanel .header-inner .search-wrap input[type="text"] {
                background-color: rgba(255,255,255,0.15);
            }
            
            #wp-admin-bar-shortcode-secondary a {
                color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?>;
            }

            /*** Header Links Hover ****/
            .header-account-login .pop .bp_components .menupop:not(#wp-admin-bar-my-account) > .ab-sub-wrapper li.active a,
            .header-account-login .pop .links li > .sub-menu li.current-menu-item a,
            .header-account-login .pop .links li > .sub-menu li.current-menu-parent a,

            #wp-admin-bar-shortcode-secondary a:hover,
            #wp-admin-bar-shortcode-secondary .thread-from a:hover,
            .header-account-login a:hover,
            .header-notifications a.notification-link:hover,
            #wp-admin-bar-shortcode-secondary a:hover .ab-icon:before,
            .header-notifications .pop a:hover,
            #masthead #searchsubmit:hover,  
            .header-navigation ul li a:hover {
                 color: <?php echo esc_attr( get_option( 'boss_heading_font_color' ) ); ?>;
             }

             .header-account-login .pop .links > .current-menu-item > a, .header-account-login .pop .links > .current-menu-parent > a, .header-account-login .pop .bp_components ul li ul li.menupop.active > a {
                 background-color: <?php echo esc_attr( get_option( 'boss_panel_color' ) ); ?>;
             }

             .header-navigation li.hideshow ul {
                 border-color: rgba(0,0,0,0.11); 
             }

            /**** Search Input ******/
            .header-inner .search-wrap input[type="text"] {
                background-color: rgba(50,200,200,0.1);
            }

            /***** Search Icon ******/
             .groups-members-search input[type="submit"], #buddypress div.dir-search input[type="submit"], #bbpress-forums #bbp-search-index-form input#bbp_search_submit, #buddypress #search-message-form input#messages_search_submit {
                 background-image: url(../images/search-gray.svg);
             }

         <?php } ?>
        
        
         <?php if( $theme == 'battleship' || $theme == 'seashell') { ?>

             /***** Input ******/
            input[type="text"]:not(#s),
            input[type="email"],
            input[type="url"],
            input[type="password"],
            input[type="search"],
            textarea {
                color: #fff;
            }

            ::-webkit-input-placeholder {
                color: rgba(255,255,255,0.7);
            }
            :-moz-placeholder { 
                color: rgba(255,255,255,0.7);
            }
            ::-moz-placeholder {  
                color: rgba(255,255,255,0.7);
            }
            :-ms-input-placeholder {  
                color: rgba(255,255,255,0.7);
            }

            #respond form textarea::-webkit-input-placeholder {
               color: rgba(255,255,255,0.7);
            }
            #respond form textarea:-moz-placeholder { 
               color: rgba(255,255,255,0.7); 
            }
            #respond form textarea::-moz-placeholder {  
               color: rgba(255,255,255,0.7);
            }
            #respond form textarea:-ms-input-placeholder {  
               color: rgba(255,255,255,0.7); 
            }

             /***** Search Icon ******/
             .groups-members-search input[type="submit"], #buddypress div.dir-search input[type="submit"], #bbpress-forums #bbp-search-index-form input#bbp_search_submit, #buddypress #search-message-form input#messages_search_submit {
                 background-image: url(../images/search-gray.svg);
             }


        <?php } ?>
          
          
        <?php if( $theme == 'battleship' || $theme == 'seashell') { ?>   
            .error404 #searchsubmit {
                color: #fff; 
            }
        <?php } ?>
          
        <?php if( $theme == 'battleship' || $theme == 'seashell') { ?>
            /*** Header Notifications ****/
            #profile-nav span,
            .header-account-login .pop #dashboard-links .menupop a span, 
            .header-account-login .pop ul > li > .ab-sub-wrapper > ul li a span,
            .site-header #wp-admin-bar-shortcode-secondary .alert,
            .header-notifications a.notification-link span {
                background-color: <?php echo esc_attr( get_option( 'boss_links_pr_color') ); ?>;
            }
        <?php } ?>
           
            
    <?php
    $css = ob_get_clean();
    
    $css = apply_filters( 'boss_customizer_css', $css );
    
    $custom_css = get_theme_mod('boss_custom_css');

    echo '<style type="text/css">';
        echo $css;
        echo $custom_css;
    echo '</style>';
    
} // End BuddyBoss Customizer CSS

add_action( 'wp_head', 'buddyboss_customizer_css' );


function buddyboss_customizer_login_css() {?>

    <style type="text/css">
        body.login {
           background-color: <?php echo esc_attr( get_option( 'boss_panel_color' ) ); ?> !important;
        }
        .login form .forgetmenot input[type="checkbox"]:checked + strong:before,
        #login form p.submit input {
            background-color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?> !important;
        }
        .login #backtoblog a:hover, .login #nav a:hover, .login h1 a:hover {
            color: <?php echo esc_attr( get_option( 'boss_links_color' ) ); ?> !important;
        } 
    </style>

<?php
} 
add_action( 'login_head', 'buddyboss_customizer_login_css' );
// End BuddyBoss Customizer CSS


function buddyboss_customizer_themes_choices(){
	$options = array();
	$themes = buddyboss_customizer_themes_preset();
	if( !empty( $themes ) ){
		foreach( $themes as $theme=>$theme_props ){
			$options[$theme] = $theme_props['name'];
		}
	}
    
//    array_unshift($options, "Default");
	
	return $options;
}

function buddyboss_customizer_default_theme_option( $key, $addprefix=false ){
	/**
	 * Themes can use the filter below to provide a default scheme accordint to their look and feel.
	 */
	$defaults = apply_filters( 'buddyboss_customizer_default_theme', array(
            'boss_title_color' => '#fff',
            /** Cover **/
            'boss_cover_color'=> '#3c7a90',
             /** BuddyPanel **/
            'boss_panel_logo_color'=> '#30445C',
            'boss_panel_color'=> '#30445C',
            'boss_panel_title_color'=> '#fff',
            'boss_panel_icons_color'=> '#3c7a90',
            'boss_panel_open_icons_color'=> '#366076',
             /** Layout **/         
            'boss_layout_titlebar_bgcolor'=> '#fff',
            'boss_layout_titlebar_color'=> '#999999',
            'boss_layout_mobiletitlebar_bgcolor'=> '#39516e',
            'boss_layout_mobiletitlebar_color'=> '#fff',
            'boss_layout_nobp_titlebar_bgcolor'=> '#30455c', 
            'boss_layout_nobp_titlebar_color'=> '#fff',
            'boss_layout_nobp_titlebar_hover_color'=> '#4dcadd',
            'boss_layout_body_color'=> '#fff',
            'boss_layout_footer_top_color'=> '#fff',
            'boss_layout_footer_bottom_bgcolor'=> '#fff',
            'boss_layout_footer_bottom_color'=> '#999999',
             /** Text & Buttons **/       
            'boss_links_color'=> '#4dcadd',
            'boss_slideshow_font_color'=> '#fff',
            'boss_heading_font_color'=> '#000',
            'boss_body_font_color'=> '#737373',
             /** Social Media Links **/
            'boss_social_icons_color'=> '#fff'
        
	) );
	
	if( $addprefix )
		$key = 'boss_' .$key;

	return isset( $defaults[$key] ) ? $defaults[$key] : '';
}
/* ++++++++++++++++++++++++++++++++
add your themes here
++++++++++++++++++++++++++++++++ */
function buddyboss_customizer_themes_preset() {
	//THIS IS A THEME. WITH ALL PROPERTIES AVAILABLE.
	$default = array(
		/* below properties are for admin section */
		'name'		=> 'Default',//anything goes
		'palette'	=> array( '#737373', '#30445C', '#3c7a90', '#4dcadd' ),
		/* below properties are to control the appearance of front end of site */
		'rules'		=> array(
            'boss_title_color' => '#ffffff',
            /** Cover **/
            'boss_cover_color'=> '#3c7a90',
             /** BuddyPanel **/
            'boss_panel_logo_color'=> '#30445C',
            'boss_panel_color'=> '#30445C',
            'boss_panel_title_color'=> '#ffffff',
            'boss_panel_icons_color'=> '#3c7a90',
            'boss_panel_open_icons_color'=> '#366076',
             /** Layout **/         
            'boss_layout_titlebar_bgcolor'=> '#ffffff',
            'boss_layout_titlebar_color'=> '#999999',
            'boss_layout_mobiletitlebar_bgcolor'=> '#39516e',
            'boss_layout_mobiletitlebar_color'=> '#fff',
            'boss_layout_nobp_titlebar_bgcolor'=> '#30455c', 
            'boss_layout_nobp_titlebar_color'=> '#fff',
            'boss_layout_nobp_titlebar_hover_color'=> '#4dcadd',
            'boss_layout_body_color'=> '#ffffff',
            'boss_layout_footer_top_color'=> '#ffffff',
            'boss_layout_footer_bottom_bgcolor'=> '#ffffff',
            'boss_layout_footer_bottom_color'=> '#999999',
             /** Text & Buttons **/       
            'boss_links_pr_color'=> '#000',
            'boss_links_color'=> '#4dcadd',
            'boss_slideshow_font_color'=> '#ffffff',
            'boss_heading_font_color'=> '#000',
            'boss_body_font_color'=> '#737373'
		),
	);
	
	$battleship = array(
		/* below properties are for admin section */
		'name'		=> 'Battleship',
        'palette'	=> array( '#737373', '#252525', '#626167', '#d82520' ),
		/* below properties are to control the appearance of front end of site */
		'rules'		=> array(
            'boss_title_color' => '#ffffff',
            /** Cover **/
            'boss_cover_color'=> '#252525',
             /** BuddyPanel **/
            'boss_panel_logo_color'=> '#252525',
            'boss_panel_color'=> '#626167',
            'boss_panel_title_color'=> '#ffffff',
            'boss_panel_icons_color'=> '#ffffff',
            'boss_panel_open_icons_color'=> '#ffffff',
             /** Layout **/         
            'boss_layout_titlebar_bgcolor'=> '#d82520',
            'boss_layout_titlebar_color'=> '#ffffff',
            'boss_layout_mobiletitlebar_bgcolor'=> '#d82520',
            'boss_layout_mobiletitlebar_color'=> '#fff',
            'boss_layout_nobp_titlebar_bgcolor'=> '#252525', 
            'boss_layout_nobp_titlebar_color'=> '#fff',
            'boss_layout_nobp_titlebar_hover_color'=> '#fff',
            'boss_layout_body_color'=> '#dcdde2',
            'boss_layout_footer_top_color'=> '#dcdde2',
            'boss_layout_footer_bottom_bgcolor'=> '#1d181e',
            'boss_layout_footer_bottom_color'=> '#a3a3a5',
             /** Text & Buttons **/
            'boss_links_pr_color'=> '#000',
            'boss_links_color'=> '#d82520', 
            'boss_slideshow_font_color'=> '#ffffff', 
            'boss_heading_font_color'=> '#000',  
            'boss_body_font_color'=> '#737373'
		),
	);
	
	$royalty = array(
		/* below properties are for admin section */
		'name'		=> 'Royalty',
        'palette'	=> array( '#f6fbf5', '#4d3653', '#1d181e', '#f8b83a' ),
		/* below properties are to control the appearance of front end of site */
		'rules'		=> array(
            'boss_title_color' => '#ffffff',
            /** Cover **/
            'boss_cover_color'=> '#4d3653',
             /** BuddyPanel **/
            'boss_panel_logo_color'=> '#f8b83a',
            'boss_panel_color'=> '#4a364f',
            'boss_panel_title_color'=> '#ffffff',
            'boss_panel_icons_color'=> '#ffffff',
            'boss_panel_open_icons_color'=> '#ffffff',
             /** Layout **/         
            'boss_layout_titlebar_bgcolor'=> '#4d3653',
            'boss_layout_titlebar_color'=> '#ffffff',
            'boss_layout_mobiletitlebar_bgcolor'=> '#4a364f',
            'boss_layout_mobiletitlebar_color'=> '#fff',
            'boss_layout_nobp_titlebar_bgcolor'=> '#f8b83a', 
            'boss_layout_nobp_titlebar_color'=> '#fff',
            'boss_layout_nobp_titlebar_hover_color'=> '#fff',
            'boss_layout_body_color'=> '#5e4b61',
            'boss_layout_footer_top_color'=> '#5e4b61',
            'boss_layout_footer_bottom_bgcolor'=> '#1d181e',
            'boss_layout_footer_bottom_color'=> '#5e4b61',
             /** Text & Buttons **/
            'boss_links_pr_color'=> '#ffffff',
            'boss_links_color'=> '#f8b63b',
            'boss_slideshow_font_color'=> '#ffffff',
            'boss_heading_font_color'=> '#ffffff',
            'boss_body_font_color'=> '#DED5E1'
		),
	);
	
	$seashell = array(
		/* below properties are for admin section */
		'name'		=> 'Seashell',
        'palette'	=> array( '#3e89a0', '#007893', '#1d181e', '#ee7c35' ),
		/* below properties are to control the appearance of front end of site */
		'rules'		=> array(
            'boss_title_color' => '#ffffff',
            /** Cover **/
            'boss_cover_color'=> '#0184a2',
             /** BuddyPanel **/
            'boss_panel_logo_color'=> '#007893',
            'boss_panel_color'=> '#007893',
            'boss_panel_title_color'=> '#ffffff',
            'boss_panel_icons_color'=> '#ffffff',
            'boss_panel_open_icons_color'=> '#ffffff',
             /** Layout **/         
            'boss_layout_titlebar_bgcolor'=> '#ee7c35',
            'boss_layout_titlebar_color'=> '#ffffff',
            'boss_layout_mobiletitlebar_bgcolor'=> '#ee7c35',
            'boss_layout_mobiletitlebar_color'=> '#fff',
            'boss_layout_nobp_titlebar_bgcolor'=> '#007893', 
            'boss_layout_nobp_titlebar_color'=> '#fff',
            'boss_layout_nobp_titlebar_hover_color'=> '#fff',
            'boss_layout_body_color'=> '#d9edee',
            'boss_layout_footer_top_color'=> '#5e4b61',
            'boss_layout_footer_bottom_bgcolor'=> '#1d181e',
            'boss_layout_footer_bottom_color'=> '#a3a3a5',
             /** Text & Buttons **/
            'boss_links_pr_color'=> '#0184a2',
            'boss_links_color'=> '#ee7c35',
            'boss_slideshow_font_color'=> '#ffffff',
            'boss_heading_font_color'=> '#0184a2',
            'boss_body_font_color'=> '#02899f'
		),
	);
	
	$starfish = array(
		/* below properties are for admin section */
		'name'		=> 'Starfish',
        'palette'	=> array( '#6d6d6d', '#cdc9bd', '#52c2e7', '#fc7055' ),
		/* below properties are to control the appearance of front end of site */
		'rules'		=> array(
            'boss_title_color' => '#ffffff',
            /** Cover **/
            'boss_cover_color'=> '#2e2e2e',
             /** BuddyPanel **/
            'boss_panel_logo_color'=> '#fc7055',
            'boss_panel_color'=> '#cdc9bd',
            'boss_panel_title_color'=> '#ffffff',
            'boss_panel_icons_color'=> '#ffffff',
            'boss_panel_open_icons_color'=> '#ffffff',
             /** Layout **/         
            'boss_layout_titlebar_bgcolor'=> '#fc7055',
            'boss_layout_titlebar_color'=> '#ffffff',
            'boss_layout_mobiletitlebar_bgcolor'=> '#fc7055',
            'boss_layout_mobiletitlebar_color'=> '#fff',
            'boss_layout_nobp_titlebar_bgcolor'=> '#fc7055', 
            'boss_layout_nobp_titlebar_color'=> '#fff',
            'boss_layout_nobp_titlebar_hover_color'=> '#fff',
            'boss_layout_body_color'=> '#f5f5f5',
            'boss_layout_footer_top_color'=> '#f0f0f0',
            'boss_layout_footer_bottom_bgcolor'=> '#ffffff',
            'boss_layout_footer_bottom_color'=> '#c4c4c4',
             /** Text & Buttons **/
            'boss_links_pr_color'=> '#52c2e7',
            'boss_links_color'=> '#fc7055',
            'boss_slideshow_font_color'=> '#ffffff',
            'boss_heading_font_color'=> '#294354',
            'boss_body_font_color'=> '#6d6d6d'
		),
	);	
    
    
	$mint = array(
		/* below properties are for admin section */
		'name'		=> 'Mint',
        'palette'	=> array( '#727272', '#544643', '#2c455b', '#06b39f' ),
		/* below properties are to control the appearance of front end of site */
		'rules'		=> array(
            'boss_title_color' => '#ffffff',
            /** Cover **/
            'boss_cover_color'=> '#0cb2a4',
             /** BuddyPanel **/
            'boss_panel_logo_color'=> '#0cb2a4',
            'boss_panel_color'=> '#544643',
            'boss_panel_title_color'=> '#ffffff',
            'boss_panel_icons_color'=> '#10b4a9',
            'boss_panel_open_icons_color'=> '#10b4a9',
             /** Layout **/         
            'boss_layout_titlebar_bgcolor'=> '#d2fcf8',
            'boss_layout_titlebar_color'=> '#06b39f',
            'boss_layout_mobiletitlebar_bgcolor'=> '#655652',
            'boss_layout_mobiletitlebar_color'=> '#fff',
            'boss_layout_nobp_titlebar_bgcolor'=> '#0cb2a4', 
            'boss_layout_nobp_titlebar_color'=> '#fff',
            'boss_layout_nobp_titlebar_hover_color'=> '#fff',
            'boss_layout_body_color'=> '#ffffff',
            'boss_layout_footer_top_color'=> '#f0f0f0',
            'boss_layout_footer_bottom_bgcolor'=> '#ffffff',
            'boss_layout_footer_bottom_color'=> '#cdcdcd',
             /** Text & Buttons **/
            'boss_links_pr_color'=> '#2c455b',
            'boss_links_color'=> '#06b39f',
            'boss_slideshow_font_color'=> '#ffffff',
            'boss_heading_font_color'=> '#2c455b',
            'boss_body_font_color'=> '#727272'
		),
	);    
    
	$iceberg = array(
		/* below properties are for admin section */
		'name'		=> 'Iceberg',
        'palette'	=> array( '#727272', '#545454', '#2c455b', '#3b8cc3' ),
		/* below properties are to control the appearance of front end of site */
		'rules'		=> array(
            'boss_title_color' => '#ffffff',
            /** Cover **/
            'boss_cover_color'=> '#5ea1cc',
             /** BuddyPanel **/
            'boss_panel_logo_color'=> '#545454',
            'boss_panel_color'=> '#3a8bc2',
            'boss_panel_title_color'=> '#ffffff',
            'boss_panel_icons_color'=> '#4ec6e1',
            'boss_panel_open_icons_color'=> '#4ec6e1',
             /** Layout **/         
            'boss_layout_titlebar_bgcolor'=> '#545454',
            'boss_layout_titlebar_color'=> '#ffffff',
            'boss_layout_mobiletitlebar_bgcolor'=> '#545454',
            'boss_layout_mobiletitlebar_color'=> '#fff',
            'boss_layout_nobp_titlebar_bgcolor'=> '#545454', 
            'boss_layout_nobp_titlebar_color'=> '#fff',
            'boss_layout_nobp_titlebar_hover_color'=> '#fff',
            'boss_layout_body_color'=> '#ffffff',
            'boss_layout_footer_top_color'=> '#f0f0f0',
            'boss_layout_footer_bottom_bgcolor'=> '#ffffff',
            'boss_layout_footer_bottom_color'=> '#cdcdcd',
             /** Text & Buttons **/
            'boss_links_pr_color'=> '#2c455b',
            'boss_links_color'=> '#6db0dd',
            'boss_slideshow_font_color'=> '#ffffff',
            'boss_heading_font_color'=> '#2c455b',
            'boss_body_font_color'=> '#727272'
		),
	);
	   
    
	$nocturnal = array(
		/* below properties are for admin section */
		'name'		=> 'Nocturnal',
        'palette'	=> array( '#7effbe', '#181818', '#201e1f', '#7effbe' ),
		/* below properties are to control the appearance of front end of site */
		'rules'		=> array(
            'boss_title_color' => '#ffffff',
            /** Cover **/
            'boss_cover_color'=> '#5ea1cc',
             /** BuddyPanel **/
            'boss_panel_logo_color'=> '#7effbe',
            'boss_panel_color'=> '#181818',
            'boss_panel_title_color'=> '#ffffff',
            'boss_panel_icons_color'=> '#ffffff',
            'boss_panel_open_icons_color'=> '#ffffff',
             /** Layout **/         
            'boss_layout_titlebar_bgcolor'=> '#181818',
            'boss_layout_titlebar_color'=> '#ffffffff',
            'boss_layout_mobiletitlebar_bgcolor'=> '#7effbe',
            'boss_layout_nobp_titlebar_bgcolor'=> '#7effbe', 
            'boss_layout_nobp_titlebar_color'=> '#fff',
            'boss_layout_nobp_titlebar_hover_color'=> '#fff',
            'boss_layout_body_color'=> '#201e1f',
            'boss_layout_footer_top_color'=> '#201e1f',
            'boss_layout_footer_bottom_bgcolor'=> '#181818',
            'boss_layout_footer_bottom_color'=> '#cdcdcd',
             /** Text & Buttons **/
            'boss_links_pr_color'=> '#4ec3e6',
            'boss_links_color'=> '#7effbe',
            'boss_slideshow_font_color'=> '#ffffff',
            'boss_heading_font_color'=> '#ffffff',
            'boss_body_font_color'=> '#ffffff'
		),
	);
	
	$default_themes = array();
	//THIS IS HOW TO ADD YOUR THEME TO LIST
	//id/key must be alphanumeric character only. no blank spaces
	$default_themes['default'] = $default;
	$default_themes['battleship'] = $battleship;
	$default_themes['royalty'] = $royalty;
	$default_themes['seashell'] = $seashell;
	$default_themes['starfish'] = $starfish;
	$default_themes['mint'] = $mint;
	$default_themes['iceberg'] = $iceberg;
	$default_themes['nocturnal'] = $nocturnal;
	
	//Use the filter below to add your custom themes
	return apply_filters( 'buddyboss_customizer_themes_preset', $default_themes );
}

/**
 * Returns the relative path of logo, i.e, /wp-content/uploads....
 * 
 * @param	string $url the absolute url of uploaded logo
 * @return	string		the relative url of the uploaded logo
 * @since	
 */
function buddyboss_customizer_fix_logo_url( $url ){
	return wp_make_link_relative($url);
}


function buddyboss_customizer_xprofile_field_choices(){
    $options = array();
    if(function_exists('bp_is_active')){
        if( bp_is_active( 'xprofile' ) && bp_has_profile( array( 'user_id'=>  bp_loggedin_user_id() ) ) ){
            while ( bp_profile_groups() ){
                bp_the_profile_group();
                if ( bp_profile_group_has_fields() ){
                    while( bp_profile_fields() ){
                        bp_the_profile_field();
                        $options[bp_get_the_profile_field_id()] = bp_get_the_profile_field_name();
                    }
                }
            }
        }
    }
	
	return $options;
}
?>