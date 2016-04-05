<?php
/**
 * buddyboss_slides is a custom post type for a responsive slideshow
 *
 * @package WordPress
 * @subpackage Boss
 * @since Boss 1.0.0
 * @credits  Full Width Slider 2.0 by Eighty Clouds
 */

// Registers the new "buddyboss_slides" custom post type

function buddyboss_slides_posttype() {
    register_post_type( 'buddyboss_slides',
        array(
            'labels' => array(
                'name' => __( 'Slides', 'boss' ),
                'singular_name' => __( 'Slide', 'boss' ),
                'add_new' => __( 'Add New', 'boss' ),
                'add_new_item' => __( 'Add New Slide', 'boss' ),
                'edit_item' => __( 'Edit Slide', 'boss' ),
                'new_item' => __( 'Add New Slide', 'boss' ),
                'view_item' => __( 'View Slide', 'boss' ),
                'search_items' => __( 'Search Slides', 'boss' ),
                'not_found' => __( 'No Slides found', 'boss' ),
                'not_found_in_trash' => __( 'No Slides found in trash', 'boss' )
            ),
            'public' => false,
            'publicly_queryable' => false,
            'show_ui' => true,
            'supports' => array( 'title', 'thumbnail', 'revisions' ),
            'capability_type' => 'page',
            'rewrite' => array("slug" => "bb-slides"), // Permalinks format
            'menu_position' => 7,
            'register_meta_box_cb' => 'add_slides_metaboxes',
            'has_archive' => false
        )
    );
}
add_action( 'init', 'buddyboss_slides_posttype' );


// Add the Slides Meta Boxes
function add_slides_metaboxes() {
    add_meta_box('buddyboss_slides_subtitle', 'Secondary Text', 'buddyboss_slides_subtitle', 'buddyboss_slides', 'normal', 'high');
    add_meta_box('buddyboss_slides_learnmore', '"Learn More" button', 'buddyboss_slides_learnmore', 'buddyboss_slides', 'normal', 'high');
    add_meta_box('buddyboss_slides_image', 'Slide Dimensions', 'buddyboss_slides_image', 'buddyboss_slides', 'side', 'default');
}


// The Secondary Text Metabox
function buddyboss_slides_subtitle() {
    global $post;
    // Noncename needed to verify where the data originated
    wp_nonce_field( 'buddyboss_meta_box_nonce', 'meta_box_nonce' );
    // Get the subtitle data if its already been entered
    $subtitle = get_post_meta($post->ID, '_subtitle', true);
    // Echo out the field
        echo '<p>What should the text below the title say?</p>';
        echo '<input type="text" name="_subtitle" value="' . esc_attr( $subtitle )  . '" class="widefat" />';
}


// The Learn More Metabox
function buddyboss_slides_learnmore() {
    global $post;
    // Noncename needed to verify where the data originated
    wp_nonce_field( 'buddyboss_meta_box_nonce', 'meta_box_nonce' );

    // Get the learn more data if its already been entered
    $text = get_post_meta($post->ID, '_text', true);
    $url = get_post_meta($post->ID, '_url', true);

    $check = isset( $_POST['_target'] ) ? esc_attr( $_POST['_target'] ) : '';

    // Echo out the fields
        echo '<p>What should the button say?</p>';
        echo '<input type="text" name="_text" value="' . esc_attr( $text )  . '" class="widefat" />';
        echo '<p>Enter the URL for the button.</p>';
        echo '<input type="text" name="_url" value="' . esc_url( $url )  . '" class="widefat" />';
        echo '<br /><br />';

        // Get the checkbox data if its already been entered
        $target = get_post_meta($post->ID, '_target', true);

        // Echo out the field
        ?><input type="checkbox" name="_target" <?php checked( $target, 'checked' ); ?> /><?php
        echo '<label for="_target">Open link in a new window/tab?</label> ';
}

// The Image Upload Instructions Metabox
function buddyboss_slides_image() {
    // Echo out the content
        echo '<p>Make sure to upload your image into the "<strong>Featured Image</strong>" box at the correct minimum dimensions.</p>
                <ul>
                    <li class="bb-slides-width">Width: <strong>1040 px</strong></li>
                    <li class="bb-slides-height">Height: <strong>400 px</strong></li>
                </ul>';
        echo '<style type="text/css">
                    .bb-slides-width,
                    .bb-slides-height {
                        padding: 5px 0;
                        display: block;
                    }
                    .bb-slides-width:before,
                    .bb-slides-height:before {
                        font: 400 20px/1 dashicons;
                        speak: none;
                        display: inline-block;
                        padding: 0 10px 0 3px;
                        color: #888;
                        vertical-align: top;
                        -webkit-font-smoothing: antialiased;
                        -moz-osx-font-smoothing: grayscale;
                        text-decoration: none!important;
                    }
                    .bb-slides-width:before {
                        content: "\f128";
                    }
                    .bb-slides-height:before {
                        content: "\f161";
                    }
            </style>';
        echo '<p>Larger images will crop down just fine, but smaller images will distort the slideshow.</p>';
}


// Save the Metabox Data
function buddyboss_save_slides_meta($post_id, $post) {
    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( isset($_POST['meta_box_nonce']) && !wp_verify_nonce( $_POST['meta_box_nonce'], 'buddyboss_meta_box_nonce') ) {
    return $post->ID;
    }
    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;
    // OK, we're authenticated: we need to find and save the data
    // We'll put it into an array to make it easier to loop though.
    $slides_meta['_subtitle'] = '';
    $slides_meta['_text'] = '';
    $slides_meta['_url'] = '';
    if ( isset( $_POST['_subtitle'] ) ) {
        $slides_meta['_subtitle'] = sanitize_text_field( $_POST['_subtitle'] );
    }
    if ( isset( $_POST['_text'] ) ) {
        $slides_meta['_text'] = sanitize_text_field( $_POST['_text'] );
    }
    if ( isset( $_POST['_url'] ) ) {
        $slides_meta['_url'] = esc_url( $_POST['_url'] );
    }
    // Save the checkbox data
    $check = isset( $_POST['_target'] ) ? 'checked' : 'unchecked';
    update_post_meta( $post_id, '_target', $check );



    // Add values of $slides_meta as custom fields
    foreach ($slides_meta as $key => $value) { // Cycle through the $slides_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    }
}
add_action('save_post', 'buddyboss_save_slides_meta', 1, 2); // save the custom fields


// Add thumbnail size just for this custom post type
add_image_size('buddyboss_slides', 1040, 400, true);


// Hides the 'view' button in the post update message
// CSS hack to fix this bug: http://core.trac.wordpress.org/ticket/17609
function buddyboss_hide_view_button() {

    $current_screen = get_current_screen();
    if( $current_screen->post_type === 'buddyboss_slides' ) {
        echo '<style type="text/css">div.updated a{display:none;}</style>';
    }
    return;
}
add_action( 'admin_head', 'buddyboss_hide_view_button' );


// Sets "photos" dashicon for this custom post type
function buddyboss_slides_dashicon() {
    echo '<style type="text/css">
                #adminmenu #menu-posts-buddyboss_slides div.wp-menu-image:before {
                    content: "\f161";
                }
            </style>';
}
add_action( 'admin_head', 'buddyboss_slides_dashicon' );


/**
 * Assets
 *
 */
function buddyboss_slides_assets()
{

    // Check if we have posts from buddyboss_slides post type
    $queryObject = new WP_Query( array( 'post_type' => 'buddyboss_slides' ) ); 
    if ($queryObject->have_posts()) {

        if ( !is_admin() ) { // no loading in the dashboard

            // Adds styles for the image slider.  Load FontAwesome first.
            wp_enqueue_style( 'buddyboss-slides-main', get_template_directory_uri() . '/buddyboss-inc/buddyboss-slides/css/buddyboss-slides.css', array( 'fontawesome' ), '1.1.2', 'all' );

            wp_enqueue_script( 'buddyboss-slides-fwslider', get_template_directory_uri() . '/buddyboss-inc/buddyboss-slides/js/fwslider.min.js', array('jquery'), '1.1.2', true );

        }

    }
}
add_action( 'wp_enqueue_scripts', 'buddyboss_slides_assets', 9 );
?>
