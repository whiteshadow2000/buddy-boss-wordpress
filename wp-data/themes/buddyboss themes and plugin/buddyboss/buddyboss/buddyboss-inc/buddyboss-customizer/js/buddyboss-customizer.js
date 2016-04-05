/**
 * BuddyBoss Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 * @since BuddyBoss 3.1
 */


/**
 * Colors > Layout
 * @since BuddyBoss 3.1
 */


    /* Add Dummy Toolbar */

    var sampleAdminBarHTML = '<div id="wpadminbar" role="navigation"><div class="quicklinks" id="wp-toolbar">'
                           + '  <ul id="wp-admin-bar-root-default" class="ab-top-menu">'
                           + '    <li id="wp-admin-bar-site-name" class="menupop">'
                           + '    <a class="ab-item" href="#" style="cursor:default">Toolbar</a>'
                           + '    </li>'
                           + '  </ul>'
                           + '  <ul id="wp-admin-bar-top-secondary" class="ab-top-secondary ab-top-menu">'
                           + '    <li id="wp-admin-bar-my-account" class="menupop">'
                           + '    <a class="ab-item" href="#" style="cursor:default">My Account</a>'
                           + '    </li>'
                           + '  </ul>'
                           + '</div></div>';

    /* Toolbar Background Color */
    (function( $ ) {
        var checked = false;
        if ( ! checked && $('body').hasClass('wp-customizer') ) {
            checked = true;
            $('body').prepend( sampleAdminBarHTML ).addClass( 'admin-bar' );
        }
        wp.customize( 'boss_adminbar_bg_color', function( value ) {
            value.bind( function( to ) {
                // Tablets and up
                if ( $(window).width() > 721) {
                    // Preview shows 32px margin at the top and no adminbar, so this is just a preview hack
                    $( '#wpadminbar, #wpadminbar .ab-top-menu, #wpadminbar .ab-top-secondary' ).css( 'background-color', to );
                }
            });
        });
    }( jQuery ));


    /* Header Background Color */
    (function( $ ) {
        wp.customize( 'boss_header_bg_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( '.site-header' ).css( 'background-color', to );
            });
        });
    }( jQuery ));


    /* Navigation Color */
    (function( $ ) {
        wp.customize( 'boss_navigation_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( '#mobile-header, .main-navigation, .main-navigation ul.nav-menu' ).css( 'background-color', to );
            });
        });
    }( jQuery ));


    /* Links & Buttons Color */
    (function( $ ) {
        wp.customize( 'boss_links_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( 'body:not(.buddypress) .entry-title a, body.bp-user .entry-title a, body.single-item .entry-title a, .item-title a, #secondary .widget a, #buddypress .activity-content a:not(button), #buddypress .activity-comments a, .bbp-breadcrumb a, #bbpress-forums li.bbp-body ul.forum a, #bbpress-forums li.bbp-body ul.topic a, #buddypress div#item-nav .item-list-tabs ul li a' ).css( 'color', to );
                $( 'button:not(#buddyboss-media-add-photo-button), input[type="submit"], input[type="button"], input[type="reset"], article.post-password-required input[type=submit], a.comment-reply-link, a.comment-edit-link, li.bypostauthor cite span, a.button, #buddypress ul.button-nav li a, #buddypress div.generic-button a, #buddypress .comment-reply-link, .entry-header .entry-title a.button, a.bp-title-button, #buddypress div.activity-comments form input[disabled]' ).css( 'background-color', to );
            });
        });
    }( jQuery ));


    /* Icons & Indicators Color */
    (function( $ ) {
        wp.customize( 'boss_icon_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( '#fwslider .progress, #fwslider .readmore a, .pagination .current, .bbp-pagination-links span' ).css( 'background-color', to );
                $( '.bbp-topics-front ul.super-sticky div.bbp-topic-title-content:before, .bbp-topics ul.super-sticky div.bbp-topic-title-content:before, .bbp-topics ul.sticky div.bbp-topic-title-content:before, .bbp-forum-content ul.sticky:before' ).css( 'color', to );
                // Mobile only
                if ( $(window).width() < 720) {
                    $( '#buddypress div.item-list-tabs ul li.current, #buddypress div.item-list-tabs ul li.selected, #buddypress div#group-create-tabs ul li.current, #buddypress div#group-create-tabs ul li.selected, #buddypress #mobile-item-nav ul li:active, #buddypress #mobile-item-nav ul li.current, #buddypress #mobile-item-nav ul li.selected, #buddypress .activity-list li.load-more a' ).css( 'background-color', to );
                }
                // Tablets and up
                if ( $(window).width() > 721) {
                    $( '#buddypress div#subnav.item-list-tabs ul li a span, #buddypress .dir-form div.item-list-tabs ul li a span, .bp-legacy div#item-body div.item-list-tabs ul li a span, #buddypress div#item-nav .item-list-tabs ul li a span' ).css( 'background-color', to );
                    $( '#buddyboss-media-add-photo-button' ).css( 'color', to );
                }
            });
        });
    }( jQuery ));


    /* Body Background Color */
    (function( $ ) {
        wp.customize( 'boss_body_bg_color', function( value ) {
            value.bind( function( to ) {
                // Tablets and up
                if ( $(window).width() > 721) {
                    $( 'body #main-wrap' ).css( 'background-color', to );
                }
            });
        });
    }( jQuery ));


    /* 1st Footer Background Color */
    (function( $ ) {
        wp.customize( 'boss_footer_top_bg_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( 'div.footer-inner-top' ).css( 'background-color', to );
            });
        });
    }( jQuery ));


    /* 2nd Footer Background Color */
    (function( $ ) {
        wp.customize( 'boss_footer_bottom_bg_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( 'div.footer-inner-bottom' ).css( 'background-color', to );
            });
        });
    }( jQuery ));

/**
 * Colors > Text
 * @since BuddyBoss 3.1
 */

    /* Site Title & Tagline Color */
    (function( $ ) {
        wp.customize( 'boss_site_title_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( '.site-header h1.site-title, .site-header h1.site-title a, .site-header p.site-description' ).css( 'color', to );
            });
        });
    }( jQuery ));


    /* Slideshow Text Color */
    (function( $ ) {
        wp.customize( 'boss_slideshow_font_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( '#fwslider .title, #fwslider .description' ).css( 'color', to );
            });
        });
    }( jQuery ));


    /* Heading Text Color */
    (function( $ ) {
        wp.customize( 'boss_heading_font_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( 'h1, h2, h3, h4, h5, h6' ).css( 'color', to );
            });
        });
    }( jQuery ));


    /* Body Text Color */
    (function( $ ) {
        wp.customize( 'boss_body_font_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( 'body' ).css( 'color', to );
            });
        });
    }( jQuery ));

/**
 * Typography
 * @since BuddyBoss 3.1
 */

    (function( $ ) {

        /**
         * Validates and returns the proper CSS font stack
         * from the customizer's dropdown
         *
         * @param  {string} fontKey Dropdown option value
         * @return {string}         CSS font stack
         */
        var getFontStack = function( fontKey ) {

            // Default font stack
            var cssFontStack = 'Open Sans';

            // Normalize font key value
            var fontKeyValue = fontKey.toString().toLowerCase();

            switch( fontKeyValue ) {
                case 'opensans':
                    cssFontStack = 'Open Sans';
                    break;

                case 'arial':
                    cssFontStack = 'Arial';
                    break;

                case 'helvetica':
                    cssFontStack = 'Helvetica';
                    break;

                case 'verdana':
                    cssFontStack = 'Verdana';
                    break;

                case 'lucida':
                    cssFontStack = 'Lucida Sans Unicode';
                    break;

                case 'trebuchet':
                    cssFontStack = 'Trebuchet MS';
                    break;

                case 'tahoma':
                    cssFontStack = 'Tahoma';
                    break;

                case 'georgia':
                    cssFontStack = 'Georgia';
                    break;

                case 'palatino':
                    cssFontStack = 'Palatino Linotype';
                    break;

                case 'times':
                    cssFontStack = 'Times New Roman'
                    break;

                case 'courier':
                    cssFontStack = 'Courier New, Courier';
                    break;

                default:
                    cssFontStack = 'Open Sans';
                    break;
            }

            return cssFontStack;

        } // getFontStack()

        var $siteHeader = $( '.site-header .site-title' );
        var $slideHeaders = $( '#fwslider .slide .title' );
        var $headings = $( 'h1,h2,h3,h4,h5,h6' ).not( $siteHeader ).not( $slideHeaders );

        /* Site Title */
        wp.customize( 'boss_site_title_font_family', function( value ) {
            value.bind( function( to ) {
                $siteHeader.css({
                    fontFamily: getFontStack( to )
                });
            });
        });

        /* Slideshow Title Font */
        wp.customize( 'boss_slideshow_font_family', function( value ) {
            value.bind( function( to ) {
                $slideHeaders.css({
                    fontFamily: getFontStack( to )
                });
            });
        });

        /* Heading Font */
        wp.customize( 'boss_heading_font_family', function( value ) {
            value.bind( function( to ) {
                $headings.css({
                    fontFamily: getFontStack( to )
                });
            });
        });

        /* Body Font Family */
        wp.customize( 'boss_body_font_family', function( value ) {
            value.bind( function( to ) {
                $( 'body' ).css({
                    fontFamily: getFontStack( to )
                });
            });
        });
    }( jQuery ));
