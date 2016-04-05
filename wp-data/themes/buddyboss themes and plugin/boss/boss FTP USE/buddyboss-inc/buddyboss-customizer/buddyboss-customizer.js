/**
 * BuddyBoss Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 * @since Boss 1.0.0
 */


/**
 * Logo Area
 * @since Boss 1.0.0
 */
    
    /* Large Logo */
     (function( $ ) {   
         $('#left-panel').css('position', 'fixed');
    }( jQuery ));

    /* Large Logo */
     (function( $ ) {
        wp.customize( 'buddyboss_logo', function( value ) {
            value.bind( function( to ) {
                if(to) {
                    if($('#mastlogo .large').length == 0) {
                        $('#mastlogo .site-name').remove();
                        $('#mastlogo').css({
                            'padding': '13px 0 12px 22px'
                        });
                        $('#mastlogo').append('<div id="logo">'
                                +'<a href="#" rel="home">'
                                    +'<img class="large" src="'+to+'" alt="Super Mobile">'
                                +'</a>'
                                +'<h1 class="site-title small">'
                                    +'<a href="#" title="Super Mobile">'
                                        + wp.customize.value('blogname')()                         
                                    +'</a>'
                                +'</h1>'
                        +'</div>');
                        setTimeout(function(){
                            $('.site-header').height($('#mastlogo').height()+25);
                            $('.site-header .left-col .table').height($('#mastlogo').height()+25);                     
                            $('#left-panel-inner').css({
                                'padding-top': $('#mastlogo').height()+25+'px'
                            })                    
                            $('#right-panel').css({
                                'margin-top': $('#mastlogo').height()+25+'px'
                            });                  
                        },100);
            
                    }
                } else {
                    if($('#mastlogo .site-name').length == 0) {
                        $('#mastlogo #logo').remove();
                        $('#mastlogo').append('<div class="site-name">'
                        +'<h1 class="site-title">'
                            +'<a href="#">'
                                + wp.customize.value('blogname')()
                            +'</a>'
                        +'</h1>'
                        +'</div>'); 
                        
//                        $('#mastlogo').removeAttr("style");
                        
                        $('.site-header').height(74);
                        $('.site-header .left-col .table').height(74);                     
                        $('#left-panel-inner').css({
                            'padding-top': '74px'
                        })                    
                        $('#right-panel').css({
                            'margin-top': '74px'
                        });
                    }
                }
            });
        });
    }( jQuery ));


    /* Small Logo */
     (function( $ ) {
        wp.customize( 'buddyboss_small_logo', function( value ) {
            value.bind( function( to ) {
                if(to) {
                    if($('#mastlogo img.small').length == 0) {
                        $('#mastlogo .site-title.small').remove();
                        $('#mastlogo').css({
                            'padding': '13px 0 12px 5px'
                        });
                        $('#mastlogo #logo').append(
                                '<a href="#" rel="home">'
                                    +'<img class="small" src="'+to+'">'
                                +'</a>'
                        +'</div>');
                        setTimeout(function(){
                            $('.site-header').height($('#mastlogo').height()+25);
                            $('.site-header .left-col .table').height($('#mastlogo').height()+25);                     
                            $('#left-panel-inner').css({
                                'padding-top': $('#mastlogo').height()+25+'px'
                            })                    
                            $('#right-panel').css({
                                'margin-top': $('#mastlogo').height()+25+'px'
                            });                  
                        },100);
                    }
                } else {
                    if($('#mastlogo .site-name').length == 0) {
                        if($('#mastlogo .large').length == 0) {
                            $('#mastlogo #logo img.small').remove();
                            $('#mastlogo #logo').append(
                               '<h1 class="site-title small">'
                                    +'<a href="#" title="Super Mobile">'
                                        + wp.customize.value('blogname')()                          
                                    +'</a>'
                                +'</h1>');
                        }else{
                            $('#mastlogo #logo').remove();
                            $('#mastlogo').removeAttr("style");
                            $('#mastlogo').append('<div class="site-name">'
                                +'<h1 class="site-title">'
                                    +'<a href="#">'
                                        + wp.customize.value('blogname')()  
                                    +'</a>'
                                +'</h1>'
                                +'</div>');  
                        }

                        
//                        $('#mastlogo').removeAttr("style");
                        
                        $('.site-header').height(74);
                        $('.site-header .left-col .table').height(74);                     
                        $('#left-panel-inner').css({
                            'padding-top': '74px'
                        })                    
                        $('#right-panel').css({
                            'margin-top': '74px'
                        });
                    }
                    
                }
            });
        });
    }( jQuery ));


    /* Site Title Color */
     (function( $ ) {
        wp.customize( 'boss_title_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( '#mobile-header h1 a, #mastlogo h1.site-title a' ).css( 'color', to );
            });
        });
    }( jQuery ));

    /* Logo Area */
     (function( $ ) {
        wp.customize( 'boss_panel_logo_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( '#mastlogo' ).css( 'background-color', to );
            });
        });
    }( jQuery ));


/**
 * BuddyPanel
 * @since Boss 1.0.0
 */

    /* Hide Dashboard Links */
    (function( $ ) {
        wp.customize( 'buddyboss_dashboard', function( value ) {
            
            value.bind( function( to ) {
                if( to != 0 ) {
                    $( '.bp_components' ).css( 'display', 'block' );
                } else {
                    $( '.bp_components' ).css( 'display', 'none' );
                }
            });
        });
    }( jQuery ));

    /* Panel Color */
    (function( $ ) {
        wp.customize( 'boss_panel_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( '.menu-panel, .menu-panel #nav-menu .sub-menu-wrap, .bp_components ul li ul li.menupop .ab-sub-wrapper' ).css( 'background-color', to );
                $( '#left-panel,#mobile-header' ).css( 'background-color', to );
            });
        });
    }( jQuery ));

    /* Panel Titles Color */
    (function( $ ) {
        wp.customize( 'boss_panel_title_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( '#nav-menu > ul > li > a, body:not(.left-menu-open) #left-panel .sub-menu-wrap > a, body:not(.left-menu-open) #left-panel .ab-sub-wrapper > .ab-item, #left-panel #nav-menu > a, #left-panel .menupop > a' ).css( 'color', to );
            });
        });
    }( jQuery ));


    /* Icons Closed */
    (function( $ ) {
        wp.customize( 'boss_panel_icons_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $("#icons_closed").remove();
                $('<style id="icons_closed">  #left-panel #nav-menu > ul > li > a:not(.open-submenu):before, #left-panel .screen-reader-shortcut:before, #left-panel .bp_components ul li ul li > .ab-item:before { color: '+ to +'; } </style>' ).appendTo('body');
            });
        });
    }( jQuery ));

    /* Icons Open */
    (function( $ ) {
        wp.customize( 'boss_panel_open_icons_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $("#icons_opened").remove();
                $('<style id="icons_opened"> body.left-menu-open #left-panel #nav-menu > ul > li > a:not(.open-submenu):before, body.left-menu-open #left-panel .bp_components ul li ul li > .ab-item:before, body.left-menu-open #left-panel .screen-reader-shortcut:before { color: '+ to +'; } </style>' ).appendTo('body');
            });
        });
    }( jQuery ));

/**
 * Layout
 * @since Boss 1.0.0
 */

    /* Links Color */
    (function( $ ) {
        wp.customize( 'boss_links_pr_color', function( value ) {
            value.bind( function( to ) {
                $('a').filter(function () {
                    var parent = $(this).parent(),
                        pass = true;
                    if(parent.hasClass('entry-title') || parent.hasClass('author') || parent.hasClass('desktop') || parent.hasClass('comments-link')) {
                        pass = false; 
                    }
                    return pass;
                }).not('.header-inner a').not('#mastlogo a').not('.menu-panel a').not('#fwslider .readmore a').not('.mobile-header-inner a').css( 'color', to );
            });
        });
    }( jQuery ));

   /* Titlebar BG*/
    (function( $ ) {
        wp.customize( 'boss_layout_titlebar_bgcolor', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( '.header-notifications .pop, .header-account-login .pop, .header-inner .search-wrap, .header-inner' ).css( 'background-color', to );
            });
        });
    }( jQuery ));

   /* Titlebar color*/
    (function( $ ) {
        wp.customize( 'boss_layout_titlebar_color', function( value ) {
            value.bind( function( to ) {
                    // All screen sizes
                $( '.header-account-login a, .header-notifications a.notification-link, .header-notifications .pop a, #masthead #searchsubmit,  .header-navigation ul li a, .header-inner .left-col a' ).css( 'color', to );
                
            });
        });
    }( jQuery ));

   /* Mobile titlebar BG*/
    (function( $ ) {
        wp.customize( 'boss_layout_mobiletitlebar_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( '#mobile-header' ).css( 'background-color', to );
            });
        });
    }( jQuery ));

   /* Body */
    (function( $ ) {
        wp.customize( 'boss_layout_body_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( 'body, body .site, body #main-wrap').css( 'background-color', to );
            });
        });
    }( jQuery ));

    /* Sidebar */
    (function( $ ) {
        wp.customize( 'boss_layout_widget_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( ' #secondary .search-wrap, #secondary').css( 'background-color', to );
            });
        });
    }( jQuery ));

    /* 1st Footer Background Color */
    (function( $ ) {
        wp.customize( 'boss_layout_footer_top_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( 'div.footer-inner-top').css( 'background-color', to );
            });
        });
    }( jQuery ));

    /* 2nd Footer Background Color */
    (function( $ ) {
        wp.customize( 'boss_layout_footer_bottom_bgcolor', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( 'div.footer-inner-bottom').css( 'background-color', to );
            });
        });
    }( jQuery ));

    /* 2nd Footer Text Color */
    (function( $ ) {
        wp.customize( 'boss_layout_footer_bottom_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( '.footer-credits, .footer-credits a, #footer-links a').css( 'color', to );
            });
        });
    }( jQuery ));

    /* Links & Buttons Color */
    (function( $ ) {
        wp.customize( 'boss_links_color', function( value ) {
            value.bind( function( to ) {
                
                 $("a").filter(function () {
                    var parent = $(this).parent(),
                        pass = true;
                    if( parent.hasClass('author') || parent.hasClass('desktop') || parent.hasClass('comments-link')) {
                        pass = false; 
                    }
                    return pass;
                }).not('.header-inner a').not('#mastlogo a').not('.menu-panel a').not('#fwslider .readmore a').not('.mobile-header-inner a').each(function(){
                    var old = $(this).css( 'color' );
                     
                    $(this).hover(
                         function () {
                           $(this).css( 'color', to );
                         }, 
                         function () {
                           $(this).css( 'color', old );
                         }
                     );
                    
                 });
                 

                $( '.header-account-login .pop .logout a, #fwslider .progress, #fwslider .readmore a, .btn, button, input[type="submit"], input[type="button"]:not(.button-small), input[type="reset"], article.post-password-required input[type=submit], li.bypostauthor cite span, a.button, #buddypress ul.button-nav li a, #buddypress div.generic-button a, #buddypress .comment-reply-link, .entry-title a.button, a.bp-title-button, #buddypress div.activity-comments form input[disabled]' ).not('#searchsubmit').css( 'background-color', to );
            });
        });
    }( jQuery ));

/**
 * Colors > Text
 * @since Boss 1.0.0
 */

    /* Heading Text Color */
    (function( $ ) {
        wp.customize( 'boss_heading_font_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( 'h1, h2, h3, h4, h5, h6' ).not('#fwslider .slide .title').css( 'color', to );
            });
        });
    }( jQuery ));


    /* Body Text Color */
    (function( $ ) {
        wp.customize( 'boss_body_font_color', function( value ) {
            value.bind( function( to ) {
                // All screen sizes
                $( 'body, p' ).not('#fwslider .description').css( 'color', to );
            });
        });
    }( jQuery ));

        
    /* Slideshow Title Color */
    (function( $ ) {
    wp.customize( 'boss_slideshow_font_color', function( value ) {
        value.bind( function( to ) {
            $('#fwslider .slide .title').css( 'color', to );
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

    /* Layout setup reset cookie */
    (function( $ ) {
        wp.customize( 'boss_layout_mobile', function( value ) {
            value.bind( function( to ) {
                $.removeCookie('switch_mode', { path: '/' });
            });
        });
    }( jQuery ));
    (function( $ ) {
        wp.customize( 'boss_layout_tablet', function( value ) {
            value.bind( function( to ) {
                $.removeCookie('switch_mode', { path: '/' });
            });
        });
    }( jQuery ));
    (function( $ ) {
        wp.customize( 'boss_layout_desktop', function( value ) {
            value.bind( function( to ) {
                $.removeCookie('switch_mode', { path: '/' });
            });
        });
    }( jQuery ));

/**
 * Custom Css
 * @since Boss 1.1.6
 */
    (function( $ ) {
        wp.customize( 'boss_custom_css', function( value ) {
            value.bind( function( to ) {
                $('#custom-css').remove();
                $('#colophon').append('<div id="custom-css"><style>'+to+'</style></div>');
            });
        });
    }( jQuery ));

/**
 * Typography
 * @since Boss 1.0.0
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
            var cssFontStack = 'Arimo';

            // Normalize font key value
            var fontKeyValue = fontKey.toString().toLowerCase();

            switch( fontKeyValue ) {
                case 'arial':
                    cssFontStack = 'Arial';
                    break;
                    
                case 'arimo':
                    cssFontStack = 'Arimo';
                    break;
                    
                case 'cabin':
                    cssFontStack = 'Cabin';
                    break;
                    
                case 'courier':
                    cssFontStack = 'Courier New';
                    break;

                case 'georgia':
                    cssFontStack = 'Georgia';
                    break;
                    
                case 'helvetica':
                    cssFontStack = 'Helvetica';
                    break;
                    
                case 'lato':
                    cssFontStack = 'Lato';
                    break;
                    
                case 'lucida':
                    cssFontStack = 'Lucida Sans Unicode';
                    break;                      
                    
                case 'montserrat':
                    cssFontStack = 'Montserrat';
                    break;
                    
                case 'opensans':
                    cssFontStack = 'Open Sans';
                    break;    
                                       
                case 'pacifico':
                    cssFontStack = 'Pacifico';
                    break;
                    
                case 'palatino':
                    cssFontStack = 'Palatino Linotype';
                    break;
                            
                case 'pt_sans':
                    cssFontStack = 'PT Sans';
                    break;
                                         
                case 'raleway':
                    cssFontStack = 'Raleway';
                    break;
                                    
                case 'source':
                    cssFontStack = 'Source Sans Pro';
                    break;
                    
                case 'tahoma':
                    cssFontStack = 'Tahoma';
                    break;
                    
                case 'times':
                    cssFontStack = 'Times New Roman'
                    break;
                    
                case 'trebuchet':
                    cssFontStack = 'Trebuchet MS';
                    break;

                case 'verdana':
                    cssFontStack = 'Verdana';
                    break;  
                    
                case 'ubuntu':
                    cssFontStack = 'Ubuntu';
                    break;
                
                default:
                    cssFontStack = 'Arimo';
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
                $( 'body, p' ).css({
                    fontFamily: getFontStack( to )
                });
            });
        });
    }( jQuery ));

    

