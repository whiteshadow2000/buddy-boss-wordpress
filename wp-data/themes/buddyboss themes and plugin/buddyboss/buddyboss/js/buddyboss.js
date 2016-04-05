/**
 * BuddyBoss JavaScript functionality
 *
 * @since    3.0
 * @package  buddyboss
 *
 * ====================================================================
 *
 * 1. jQuery Global
 * 2. Main BuddyBoss Class
 * 3. Inline Plugins
 */



/**
 * 1. jQuery Global
 * ====================================================================
 */
var jq = $ = jQuery;



/**
 * 2. Main BuddyBoss Class
 *
 * This class takes care of BuddyPress additional functionality and
 * provides a global name space for BuddyBoss plugins to communicate
 * through.
 *
 * Event name spacing:
 * $(document).on( "buddyboss:*module*:*event*", myCallBackFunction );
 * $(document).trigger( "buddyboss:*module*:*event*", [a,b,c]/{k:v} );
 * ====================================================================
 * @return {class}
 */
var BuddyBossMain = ( function( $, window, undefined ) {

	/**
	 * Globals/Options
	 */
	var _l = {
		$document: $(document),
		$window: $(window)
	};

	// Controller
	var App = {};

	// Custom Events
	var Vent = $({});

	// Responsive
	var Responsive = {};

	// BuddyPress Defaults
	var BuddyPress = {};

	// BuddyPress Legacy
	var BP_Legacy = {};


	/** --------------------------------------------------------------- */

	/**
	 * Application
	 */

	// Initialize, runs when script is processed/loaded
	App.init = function() {

		_l.$document.ready( App.domReady );

		BP_Legacy.init();
	}

	// When the DOM is ready (page laoded)
	App.domReady = function() {
		_l.body = $('body');
		_l.$buddypress = $('#buddypress');

		Responsive.domReady();
	}

	/** --------------------------------------------------------------- */

	/**
	 * BuddyPress Responsive Help
	 */
	Responsive.domReady = function() {

		// GLOBALS *
		// ---------
		window.BuddyBoss = window.BuddyBoss || {};

		window.BuddyBoss.is_mobile = null;

		var
			$document         = $(document),
			$window           = $(window),
			$body             = $('body'),
			$mobile_check     = $('#mobile-check').css({position:'absolute',top:0,left:0,width:'100%',height:1,zIndex:1}),
			mobile_width      = 720,
			is_mobile         = false,
			has_item_nav      = false,
			mobile_modified   = false,
			swiper            = false,
			$main             = $('#main-wrap'),
			$inner            = $('#inner-wrap'),
			$buddypress       = $('#buddypress'),
			$item_nav         = $buddypress.find('#item-nav'),
			Panels            = {},
			$selects,
			$mobile_nav_wrap,
			$mobile_item_wrap,
			$mobile_item_nav;

		// Detect android stock browser
		// http://stackoverflow.com/a/17961266
		var isAndroid = navigator.userAgent.indexOf('Android') >= 0;
		var webkitVer = parseInt((/WebKit\/([0-9]+)/.exec(navigator.appVersion) || 0)[1],10) || void 0; // also match AppleWebKit
		var isNativeAndroid = isAndroid && webkitVer <= 534 && navigator.vendor.indexOf('Google') == 0;

		/*------------------------------------------------------------------------------------------------------
		1.0 - Core Functions
		--------------------------------------------------------------------------------------------------------*/

			/**
			 * Checks for supported mobile resolutions via media query and
			 * maximum window width.
			 *
			 * @return {boolean} True when screen size is mobile focused
			 */
			function check_is_mobile() {
				// The $mobile_check element refers to an empty div#mobile-check we
				// hide or show with media queries. We use this to determine if we're
				// on mobile resolution
				$mobile_check.remove().appendTo( $body );

				is_mobile = BuddyBoss.is_mobile = $mobile_check.is(':visible') || ($window.width() < mobile_width);

				if ( is_mobile ) {
					$body.addClass('is-mobile');
					mobile_width = $window.width();
				}
				else {
					$body.removeClass('buddyboss-is-mobile');
				}

				return is_mobile;
			}

			/**
			 * Checks for a BuddyPress sub-page menu. On smaller screens we turn
			 * this into a left/right swiper
			 *
			 * @return {boolean} True when BuddyPress item navigation exists
			 */
			function check_has_item_nav() {
				if ( $item_nav && $item_nav.length ) {
					has_item_nav = true;
				}

				return has_item_nav;
			}

			function render_layout() {
				var
					window_height = $window.height(), // window height - 60px (Header height) - carousel_nav_height (Carousel Navigation space)
					carousel_width = ($item_nav.find('li').length * 94);

				// If on small screens make sure the main page elements are
				// full width vertically
				if ( is_mobile && ( $inner.height() < $window.height() ) ) {
					$('#page').css( 'min-height', $window.height() - ( $('#mobile-header').height() + $('#colophon').height() ) );
				}

				// Swipe/panel shut area
				if ( is_mobile && $('#buddyboss-swipe-area').length && Panels.state ) {
					$('#buddyboss-swipe-area').css({
						left:   Panels.state === 'left' ? 240 : 'auto',
						right:  Panels.state === 'right' ? 240 : 'auto',
						width:  $(window).width() - 240,
						height: $(window).outerHeight(true) + 200
					});
				}

				// Log out link in left panel
				var $left_logout_link = $('#wp-admin-bar-logout'),
						$left_account_panel = $('#wp-admin-bar-user-actions'),
						$left_settings_menu = $('#wp-admin-bar-my-account-settings .ab-submenu').first();

				if ( $left_logout_link.length && $left_account_panel.length && $left_settings_menu.length ) {
					// On mobile user's accidentally click the link when it's up
					// top so we move it into the setting menu
					if ( is_mobile ) {
						$left_logout_link.appendTo( $left_settings_menu );
					}
					// On desktop we move it back to it's original place
					else {
						$left_logout_link.appendTo( $left_account_panel );
					}
				}

				// Runs once, first time we experience a mobile resolution
				if ( is_mobile && has_item_nav && ! mobile_modified ) {
					mobile_modified = true;
					$mobile_nav_wrap  = $('<div id="mobile-item-nav-wrap" class="mobile-item-nav-container mobile-item-nav-scroll-container">');
					$mobile_item_wrap = $('<div class="mobile-item-nav-wrapper">').appendTo( $mobile_nav_wrap );
					$mobile_item_nav  = $('<div id="mobile-item-nav" class="mobile-item-nav">').appendTo( $mobile_item_wrap );
					$mobile_item_nav.append( $item_nav.html() );

					$mobile_item_nav.css( 'width', ($item_nav.find('li').length * 94) );
					$mobile_nav_wrap.insertBefore( $item_nav ).show();
					$('#mobile-item-nav-wrap, .mobile-item-nav-scroll-container, .mobile-item-nav-container').addClass('fixed');
					$item_nav.css({display:'none'});
				}
				// Resized to non-mobile resolution
				else if ( ! is_mobile && has_item_nav && mobile_modified ) {
					$mobile_nav_wrap.css({display:'none'});
					$item_nav.css({display:'block'});
					$document.trigger('menu-close.buddyboss');
				}
				// Resized back to mobile resolution
				else if ( is_mobile && has_item_nav && mobile_modified ) {
					$mobile_nav_wrap.css({
						display:'block',
						width: carousel_width
					});

					$mobile_item_nav.css({
						width: carousel_width
					});

					$item_nav.css({display:'none'});
				}

				// Update select drop-downs
				populate_select_label();
			}

			/**
			 * Renders the layout, called when the page is loaded and on resize
			 *
			 * @return {void}
			 */
			function do_render()
			{
				check_is_mobile();
				check_has_item_nav();
				render_layout();
				mobile_carousel();
			}

		/*------------------------------------------------------------------------------------------------------
		1.1 - Startup (Binds Events + Conditionals)
		--------------------------------------------------------------------------------------------------------*/

			// Render layout
			do_render();

			// Re-render layout after everything's loaded
			$window.bind( 'load', function() {
				do_render();
			});

			// Re-render layout on resize
			var throttle;
			$window.resize( function() {
				clearTimeout( throttle );
				throttle = setTimeout( do_render, 150 );
			});



		/*------------------------------------------------------------------------------------------------------
		2.0 - Responsive Menus
		--------------------------------------------------------------------------------------------------------*/

		Panels = {
			state: 'init',
			engine: 'CSS',

			click_throttle: null,
			click_status: true,

			$swipe_area: null,
			$left: null,
			$left_icon: null,
			$right: null,
			$right_icon: null,
			$content: null,

			init: function() {
				Panels.$content    = $('#mobile-header, #main-wrap');
				Panels.$items      = $('body, #mobile-header, #main-wrap');

				Panels.$left       = $('#wpadminbar');
				Panels.$right      = $('#masthead');

				Panels.$left_icon  = $('#user-nav');
				Panels.$right_icon = $('#main-nav');

				// Panels.$swipe_area = $('<div id="buddyboss-swipe-area" />').hide().appendTo($body);
				Panels.$swipe_area = $('#buddyboss-swipe-area').hide();

				Panels.state       = 'closed';

				var ieMobile = navigator.userAgent.indexOf('IEMobile') !== -1;
				var isLegacy = ieMobile || isNativeAndroid;

				// CSS3 animations by default, but fallback to jQuery
				// when not available
				if ( isLegacy || ! Modernizr || ! Modernizr.csstransitions || ! Modernizr.csstransforms || ! Modernizr.csstransforms3d ) {
					Panels.engine = 'JS';
					$('html').addClass('buddyboss-js-transitions');
				}

				// Global events
			  $document.on( 'open-left-menu.buddyboss', { side: 'left' }, Panels.open );
			  $document.on( 'open-right-menu.buddyboss', { side: 'right' }, Panels.open );
			  $document.on( 'menu-close.buddyboss', Panels.close );

			  // Swipes
			 //  var $swipe_targets = $().add($body)
			 //  	.add(Panels.$left).add(Panels.$left.find('a'))
			 //  	.add(Panels.$right).add(Panels.$right.find('a'));

				// $swipe_targets.swipe({
				//   swipe: function(event, direction, distance, duration, fingerCount) {
				// 		if ( Panels.state === 'left' && direction === 'right'
				// 		     || Panels.state === 'right' && direction === 'left' ) {
				// 			console.log( 'SWIPE' );
				// 			$document.trigger( 'menu-close.buddyboss' );
				// 		}
				//   }
				// });

			  // Menu events
			  Panels.$swipe_area.on( 'fastclick click', { target: 'content' }, Panels.on_click );
			  Panels.$left_icon.on( 'fastclick click', { target: 'icon', side: 'left' }, Panels.on_click );
			  Panels.$right_icon.on( 'click', { target: 'icon', side: 'right' }, Panels.on_click );
			},

			/**
			 * Handle touch events on open menus, sometimes devices
			 * will handle the first 'click/touch' as a hover event
			 * if it thinks there might be a flyout or sub-menu
			 *
			 * This only affects clicking links to other pages inside
			 * our left/right panels, so we do that manually when a
			 * 'tap' event is detected on a link element in either
			 * panel
			 *
			 * @param  {object} e jQuery event object
			 * @return {void}
			 */
			on_menu_click: function( e ) {
				// console.log( 'tap' );
				// console.log( e );

				var href = !! this.getAttribute('href')
						     ? this.getAttribute('href')
						     : false;

				if ( href ) {
					$document.trigger( 'menu-close.buddyboss' );
					window.location = href;
					return false;
				}
			},

			on_click: function( e ) {
				// console.log( 'on_click() e.type', e.type );
				// console.log( e );

				clearTimeout(Panels.click_throttle);
				click_throttle = setTimeout(function(){
					Panels.click_status = true;
				}, 150 );

				var status = true;

				// If this event wasn't initiated by us bail
				if ( e.isTrigger && e.type !== 'fastclick' ) {
					status = false;
				}

				if ( ! Panels.click_status ) {
					status = false;
				}

				if ( status ) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();

					// If it's closed, open a panel
					if ( Panels.state === 'closed' && e.data && e.data.target === 'icon' ) {
						$document.trigger( 'open-'+e.data.side+'-menu.buddyboss' );
					}
					// Otherwise close the panels
					else {
						$document.trigger( 'menu-close.buddyboss' );
						return false;
					}

					Panels.click_status = false;
				}
			},

			open: function( e ) {
				var side = Panels.state = e.data.side;

				var opt  = {
					css: {
						zIndex: 999,
						opacity: 1,
						display: 'block',
						height: '100%'
					},
					ani: {}
				};

				opt.css[side] = -240;
				opt.ani[side] = 0;

				var $menu     = Panels[ '$' + side ];

				// Use CSS Transitions where possible
				if ( Panels.engine === 'CSS' ) {
					$body.addClass( 'open-' + side ).removeClass( 'close-left close-right' );
				}
				// jQuery/JS fallback
				else {
					$body.addClass( 'open-' + side ).removeClass( 'close-left close-right' );
					$menu.css( opt.css ).animate( opt.ani );
				}

				setTimeout( function() {
					Panels.$content.on( 'fastclick click', { target: 'content' }, Panels.on_click );
				  $menu.on( 'fastclick click', 'a', { target: 'menu' }, Panels.on_menu_click );
				}, 200 );

				Panels.$swipe_area.css({
					left:   side === 'left' ? 240 : 'auto',
					right:  side === 'right' ? 240 : 'auto',
					width:  $(window).width() - 240,
					height: $(window).outerHeight(true) + 200
				}).show();
			},

			close: function() {
				var side  = Panels.state;
				var $menu = Panels[ '$' + side ];
				var opt   = {};
				opt[side] = -240;

				if ( ! side || ! $menu || ! $menu.length ) {
					return;
				}

				// Use CSS Transitions where possible
				if ( Panels.engine === 'CSS' ) {
					$body.addClass( 'close-' + side );
					setTimeout( function(){
						$body.removeClass( 'open-left open-right' );
					},400);
				}
				// jQuery/JS fallback
				else {
					$body.removeClass( 'open-left open-right' ).addClass( 'close-' + side );
					$menu.animate( opt );
				}

			  $menu.off( 'fastclick click' );
			  Panels.$content.off( 'fastclick click' );

				Panels.$swipe_area.hide();

				Panels.state = 'closed';
			}
		} // Panels

		Panels.init();

		/*------------------------------------------------------------------------------------------------------
		2.1 - Mobile/Tablet Carousels
		--------------------------------------------------------------------------------------------------------*/

			function mobile_carousel() {
				if ( is_mobile && has_item_nav && ! swiper ) {
					// console.log( 'Setting up mobile nav swiper' );
					swiper = $('.mobile-item-nav-scroll-container').swiper({
						scrollContainer : true,
						slideElement : 'div',
						slideClass : 'mobile-item-nav',
						wrapperClass : 'mobile-item-nav-wrapper'
					});
				}
			}

		/*------------------------------------------------------------------------------------------------------
		2.2 - Responsive Dropdowns
		--------------------------------------------------------------------------------------------------------*/

			// On page load we'll go through each select element and make sure
			// we have a label element to accompany it. If not, we'll generate
			// one and add it dynamically.

			// On page load we'll go through each select element and make sure
			// we have a label element to accompany it. If not, we'll generate
			// one and add it dynamically.
			function init_select() {
				var current = 0;

				$selects = $('#page select:not([multiple]):not(#activity-privacy):not(.bp-ap-selectbox)');

				$selects.each( function() {
					var $select = $(this),
				    $wrap, id, $span, $label, dynamic = false;

					if ( this.style.display === 'none' ) {
						return;
					}

                    $wrap = $('<div class="buddyboss-select"></div>');
                    
                    if($(this).hasClass('large')) {
                        $wrap = $('<div class="buddyboss-select large"></div>');
                    }
                    
					id      = this.getAttribute('id') || 'buddyboss-select-' + current;
					$span  = $select.prev('span');

					$select.wrap( $wrap );
                    
                    $inner_wrap = $('<div class="buddyboss-select-inner"></div>');
                    
                    $select.wrap( $inner_wrap );
                    
					if ( ! $span.length ) {
						$span  = $('<span></span>').hide();
						dynamic = true;
					}
                    
                    $span.insertBefore( $select );

					// Set data on select element to use later
					$select.data( 'buddyboss-select-info', {
						state:     'init',
						dynamic:   dynamic,
						$wrap:     $wrap,
						$label:    $span,
						orig_text: $span.text()
					} );

					// On select change, repopulate label
					$select.on( 'change', function( e ) {
						populate_select_label();
					});
				});

			}

			init_select();
			
			
		/*------------------------------------------------------------------------------------------------------
		Heartbeat functions
	   	--------------------------------------------------------------------------------------------------------*/
	   
		//Notifications related updates
		$(document).on('heartbeat-tick.bb_notification_count', function(event, data) {
			
			if (data.hasOwnProperty('bb_notification_count')) {
				data = data['bb_notification_count'];
				/********notification type**********/
				if (data.notification > 0) { //has count
					jQuery("#ab-pending-notifications").text(data.notification).removeClass("no-alert");
					jQuery(".mobile-header-inner #ab-pending-notifications").first().text(data.notification).removeClass("no-alert");
					
					jQuery(".ab-item[href*='/notifications/']").each(function() {
						console.log(jQuery(this).find(".count").length );
						if (jQuery(this).find(".count").length > 0) {							
							if (jQuery(this).find("span").first().attr("id") != "ab-pending-notifications") {
								jQuery(this).find(".count").first().remove(); //remove the old one.
							}							
						}
						if (jQuery(this).find("span").attr("id") != "ab-pending-notifications") {
							jQuery(this).append(" <span class='count'>" + data.notification + "</span>");
						}
					});
				} else {
					jQuery("#ab-pending-notifications").text(data.notification).addClass("no-alert");
					jQuery(".mobile-header-inner #ab-pending-notifications").text(data.notification).addClass("no-alert");
					jQuery(".ab-item[href*='/notifications/']").each(function() {
						if (jQuery(this).find("span").attr("id") != "ab-pending-notifications") {
						 jQuery(this).find(".count").remove();
						}
					});
				}
				
				jQuery("#user-notifications").find("span").text(data.notification_real);
				
				//remove from read ..
				jQuery("#wp-admin-bar-my-account-notifications-read").each(function() {
					$(this).find("a").find(".count").remove();
				});
				
				/**********messages type************/
				if (data.unread_message > 0) { //has count
					jQuery("#user-messages").find("span").text(data.unread_message);
					jQuery(".ab-item[href*='/messages/']").each(function() {
						jQuery(this).append("<span class='count'>" + data.unread_message + "</span>");
						if (jQuery(this).find(".count").length > 1) {
							jQuery(this).find(".count").first().remove(); //remove the old one.
						}
					});
				} else {
					jQuery("#user-messages").find("span").text(data.unread_message);
					jQuery(".ab-item[href*='/messages/']").each(function() {
						jQuery(this).find(".count").remove();
					});
				}
				//remove from unwanted place ..
				jQuery("#wp-admin-bar-my-account-messages-default, #wp-admin-bar-my-account-messages-default").find("li:not('#wp-admin-bar-my-account-messages-inbox')").each(function() {
					jQuery(this).find("span").remove();
				});
				/**********messages type************/
				if (data.friend_request > 0) { //has count
					jQuery(".ab-item[href*='/friends/']").each(function() {
						jQuery(this).append("<span class='count'>" + data.friend_request + "</span>");
						if (jQuery(this).find(".count").length > 1) {
							jQuery(this).find(".count").first().remove(); //remove the old one.
						}
					});
				} else {
					jQuery(".ab-item[href*='/friends/']").each(function() {
						jQuery(this).find(".count").remove();
					});
				}
				//remove from unwanted place ..
				jQuery("#wp-admin-bar-my-account-friends-default,#wp-admin-bar-my-account-friends-default").find("li:not('#wp-admin-bar-my-account-friends-requests')").each(function() {
					jQuery(this).find("span").remove();
				});
				
				//notification content
				jQuery("#wp-admin-bar-bp-notifications .ab-sub-wrapper").find("li").first().html(data.notification_content);
			}
		});

			// On mobile, we add a better select box. This function
			// populates data from the <select> element to it's
			// <label> element which is positioned over the select box.
			function populate_select_label() {

				// Abort when no select elements are found
				if ( ! $selects || ! $selects.length ) {
					return;
				}

				// Handle small screens
				if ( is_mobile ) {

					$selects.each( function( idx, val ) {
						var $select = $(this),
								data    = $select.data( 'buddyboss-select-info' ),
								$label;

						if ( ! data || ! data.$label ) {
							return;
						}

						$label = data.$label;

						if ( $label && $label.length ) {

							data.state = 'mobile';

							$label.text( $select.find('option:selected').text() ).show();
						}
					});

				}

				// Handle larger screens
				else {

					$selects.each( function( idx, val ) {
						var $select   = $(this),
								data      = $select.data( 'buddyboss-select-info' ),
								$label, orig_text;

						if ( ! data || ! data.$label || data.orig_text === false ) {
							return;
						}

						$label    = data.$label || false;
						orig_text = data.orig_text ||  BuddyBossOptions.select_label;

						if ( data.state !== 'desktop' && $label && $label.length ) {

							data.state = 'desktop';

							// If it's a dynamic select/label, we should hide the added
							// label that wasn't there before because we're only using
							// it on smaller screens
							if ( data.dynamic ) {
								$label.hide();
							}

							// Otherwise, let's set the original label's text
							else {
								$label.text( orig_text );
							}
						}
					});

				} // end is_mobile

			} // end populate_select_label();

		/*------------------------------------------------------------------------------------------------------
		2.3 - Notifications Area
		--------------------------------------------------------------------------------------------------------*/

		// Add Notifications Area, if there are notifications to show

		if ( is_mobile && $window.width() < 720 ) {

			if ($('#wp-admin-bar-bp-notifications').length != 0){

				// Clone and Move the Notifications Count to the Header
				$('li#wp-admin-bar-bp-notifications a.ab-item > span#ab-pending-notifications').clone().appendTo('#user-nav');

			}
		}

		/*------------------------------------------------------------------------------------------------------
		3.0 - Content
		--------------------------------------------------------------------------------------------------------*/
		/*------------------------------------------------------------------------------------------------------
		3.1 - Members (Group Admin)
		--------------------------------------------------------------------------------------------------------*/

		// Hide/Reveal action buttons
		$('a.show-options').click(function(event){
			event.preventDefault;

			parent_li = $(this).parent('li');
			if ($(parent_li).children('ul#members-list span.small').hasClass('inactive')){
				$(this).removeClass('inactive').addClass('active');
				$(parent_li).children('ul#members-list span.small').removeClass('inactive').addClass('active');
			}
			else{
				$(this).removeClass('active').addClass('inactive');
				$(parent_li).children('ul#members-list span.small').removeClass('active').addClass('inactive');
			}

		});


		/*------------------------------------------------------------------------------------------------------
		3.2 - Search Input Field
		--------------------------------------------------------------------------------------------------------*/
		$('#buddypress div.dir-search form, #buddypress div.message-search form, div.bbp-search-form form, form#bbp-search-form').append('<a href="#" id="clear-input"> </a>');
		$('a#clear-input').click(function(){
			jQuery("#buddypress div.dir-search form input[type=text], #buddypress div.message-search form input[type=text], div.bbp-search-form form input[type=text], form#bbp-search-form input[type=text]").val("");
		});


		/*------------------------------------------------------------------------------------------------------
		3.3 - Hide Profile and Group Buttons Area, when there are no buttons (ex: Add Friend, Join Group etc...)
		--------------------------------------------------------------------------------------------------------*/

		if ( ! $('#buddypress #item-header #item-buttons .generic-button').length ) {
		  $('#buddypress #item-header #item-buttons').hide();
		}

		/*------------------------------------------------------------------------------------------------------
		3.4 - Move the Messages Checkbox, below the Avatar
		--------------------------------------------------------------------------------------------------------*/

		$('#message-threads.messages-notices .thread-options .checkbox').each( function() {
			move_to_spot = $(this).parent().siblings('.thread-avatar');
			$(this).appendTo(move_to_spot);
		});

		/*------------------------------------------------------------------------------------------------------
		3.5 - Select unread and read messages in inbox
		--------------------------------------------------------------------------------------------------------*/

		// Overwrite/Re-do some of the functionality in buddypress.js,
		// to accommodate for UL instead of tables in buddyboss theme
		jq("#message-type-select").change(
			function() {
				var selection = jq("#message-type-select").val();
				var checkboxes = jq("ul input[type='checkbox']");
				checkboxes.each( function(i) {
					checkboxes[i].checked = "";
				});

				switch(selection) {
					case 'unread':
						var checkboxes = jq("ul.unread input[type='checkbox']");
						break;
					case 'read':
						var checkboxes = jq("ul.read input[type='checkbox']");
						break;
				}
				if ( selection != '' ) {
					checkboxes.each( function(i) {
						checkboxes[i].checked = "checked";
					});
				} else {
					checkboxes.each( function(i) {
						checkboxes[i].checked = "";
					});
				}
			}
		);

		/* Bulk delete messages */
		jq("#delete_inbox_messages, #delete_sentbox_messages").on( 'click', function() {
			checkboxes_tosend = '';
			checkboxes = jq("#message-threads ul input[type='checkbox']");

			jq('#message').remove();
			jq(this).addClass('loading');

			jq(checkboxes).each( function(i) {
				if( jq(this).is(':checked') )
					checkboxes_tosend += jq(this).attr('value') + ',';
			});

			if ( '' == checkboxes_tosend ) {
				jq(this).removeClass('loading');
				return false;
			}

			jq.post( ajaxurl, {
				action: 'messages_delete',
				'thread_ids': checkboxes_tosend
			}, function(response) {
				if ( response[0] + response[1] == "-1" ) {
					jq('#message-threads').prepend( response.substr( 2, response.length ) );
				} else {
					jq('#message-threads').before( '<div id="message" class="updated"><p>' + response + '</p></div>' );

					jq(checkboxes).each( function(i) {
						if( jq(this).is(':checked') )
							jq(this).parent().parent().fadeOut(150);
					});
				}

				jq('#message').hide().slideDown(150);
				jq("#delete_inbox_messages, #delete_sentbox_messages").removeClass('loading');
			});
			return false;
		});

		/*------------------------------------------------------------------------------------------------------
		3.6 - Make Video Embeds Responsive - Fitvids.js
		--------------------------------------------------------------------------------------------------------*/
        
        if(typeof $.fn.fitVids !== 'undefined' && $.isFunction($.fn.fitVids)){
            
            function videosWidth() {
                
                $('.wp-video').find('object').addClass('fitvidsignore');
                $('#content').fitVids();
                
                if($('.activity-inner').length > 0) {
                    $('.activity-inner').find('.fluid-width-video-wrapper').each(function(){
                        $(this).parent().css({
                            'max-width' : '530px'
                        });
                    });
                }
            }
            
            videosWidth();
        
            // This ensures that after and Ajax call we check again for
            // videos to resize.
            $(document).ajaxSuccess( videosWidth );
        }
                
        /*--------------------------------------------------------------------------------------------------------
        3.7 - Infinite Scroll
		--------------------------------------------------------------------------------------------------------*/

        if($('#masthead').data('infinite') == 'on') {
            var is_activity_loading=false;//We'll use this variable to make sure we don't send the request again and again.

            jq(document).on('scroll', function (){
               //Find the visible "load more" button.
               //since BP does not remove the "load more" button, we need to find the last one that is visible.
                var load_more_btn=jq(".load-more:visible");
                //If there is no visible "load more" button, we've reached the last page of the activity stream.
                if(!load_more_btn.get(0))
                    return;

                //Find the offset of the button.
                 var pos=load_more_btn.offset();

               //If the window height+scrollTop is greater than the top offset of the "load more" button, we have scrolled to the button's position. Let us load more activity.
    //            console.log(jq(window).scrollTop() + '  '+ jq(window).height() + ' '+ pos.top);

               if(jq(window).scrollTop() + jq(window).height() > pos.top ) {

                    load_more_activity();
               }

            });

            /**
             * This routine loads more activity.
             * We call it whenever we reach the bottom of the activity listing.
             * 
             */
            function load_more_activity(){

                //Check if activity is loading, which means another request is already doing this.
                //If yes, just return and let the other request handle it.
                if(is_activity_loading)
                        return false;				

               //So, it is a new request, let us set the var to true.        
                is_activity_loading=true;

                //Add loading class to "load more" button.
                //Theme authors may need to change the selector if their theme uses a different id for the content container.
                //This is designed to work with the structure of bp-default/derivative themes.
                //Change #content to whatever you have named the content container in your theme.
                jq("#content li.load-more").addClass('loading');


                if ( null == jq.cookie('bp-activity-oldestpage') )
                        jq.cookie('bp-activity-oldestpage', 1, {
                                path: '/'
                        } );

                var oldest_page = ( jq.cookie('bp-activity-oldestpage') * 1 ) + 1;

                //Send the ajax request.
                jq.post( ajaxurl, {
                        action: 'activity_get_older_updates',
                        'cookie': encodeURIComponent(document.cookie),
                        'page': oldest_page
                },
                function(response)
                {
                        jq(".load-more").hide();//Hide any "load more" button.
                        jq("#content li.load-more").removeClass('loading');//Theme authors, you may need to change #content to the id of your container here, too.

                        //Update cookie...
                        jq.cookie( 'bp-activity-oldestpage', oldest_page, {
                                path: '/'
                        } );

                        //and append the response.
                        jq("#content ul.activity-list").append(response.contents);

                        //Since the request is complete, let us reset is_activity_loading to false, so we'll be ready to run the routine again.

                        is_activity_loading=false;
                }, 'json' );

                return false;

            }



        }
	}


	/** --------------------------------------------------------------- */

	/**
	 * BuddyPress Legacy Support
	 */

	// Initialize
	BP_Legacy.init = function() {
		BP_Legacy.injected = false;
		_l.$document.ready( BP_Legacy.domReady );
	}

	// On dom ready we'll check if we need legacy BP support
	BP_Legacy.domReady = function() {
		BP_Legacy.check();
	}

	// Check for legacy support
	BP_Legacy.check = function() {
		if ( ! BP_Legacy.injected && _l.body.hasClass('buddypress') && _l.$buddypress.length == 0 ) {
			BP_Legacy.inject();
		}
	}

	// Inject the right code depending on what kind of legacy support
	// we deduce we need
	BP_Legacy.inject = function() {
		BP_Legacy.injected = true;

		var $secondary  = $('#secondary'),
				do_legacy = false;

		var $content  = $('#content'),
				$padder   = $content.find('.padder').first(),
				do_legacy = false;

		var $article = $content.children('article').first();

		var $legacy_page_title,
				$legacy_item_header;

		// Check if we're using the #secondary widget area and add .bp-legacy inside that
		if ( $secondary.length ) {
			$secondary.prop( 'id', 'secondary' ).addClass('bp-legacy');

			do_legacy = true;
		}

		// Check if the plugin is using the #content wrapper and add #buddypress inside that
		if ( $padder.length ) {
			$padder.prop( 'id', 'buddypress' ).addClass('bp-legacy entry-content');

			do_legacy = true;

			// console.log( 'Buddypress.js #buddypress fix: Adding #buddypress to .padder' );
		}
		else if ( $content.length ) {
			$content.wrapInner( '<div class="bp-legacy entry-content" id="buddypress"/>' );

			do_legacy = true;

			// console.log( 'Buddypress.js #buddypress fix: Dynamically wrapping with #buddypresss' );
		}

		// Apply legacy styles if needed
		if ( do_legacy ) {

			_l.$buddypress = $('#buddypress');

			$legacy_page_title = $('.buddyboss-bp-legacy.page-title');
			$legacy_item_header = $('.buddyboss-bp-legacy.item-header');

			// Article Element
			if ( $article.length === 0 ) {
				$content.wrapInner('<article/>');
				$article = $( $content.find('article').first() );
			}

			// Page Title
			if ( $content.find('.entry-header').length === 0 || $content.find('.entry-title').length === 0 ) {
				$legacy_page_title.prependTo( $article ).show();
				$legacy_page_title.children().unwrap();
			}

			// Item Header
			if ( $content.find('#item-header-avatar').length === 0 && _l.$buddypress.find('#item-header').length ) {
				$legacy_item_header.prependTo( _l.$buddypress.find('#item-header') ).show();
				$legacy_item_header.children().unwrap();
			}
		}
	}

	// Boot er' up
	jQuery(document).ready(function(){
	    App.init();
	});

}( jQuery, window ) );




/**
 * 3. Inline Plugins
 * ====================================================================
 * Inline Plugins
 */



/*------------------------------------------------------------------------------------------------------
Inline Plugins
--------------------------------------------------------------------------------------------------------*/

/*
 * jQuery Mobile Plugin: jQuery.Event.Special.Fastclick
 * http://nischenspringer.de/jquery/fastclick
 *
 * Copyright 2013 Tobias Plaputta
 * Released under the MIT license.
 * http://nischenspringer.de/license
 *
 */
;(function(e){var t=e([]),n=800,r=30,i=10,s=[],o={};var u=function(e){var t,n;for(t=0,n=s.length;t<n;t++){if(Math.abs(e.pageX-s[t].x)<r&&Math.abs(e.pageY-s[t].y)<r){e.stopImmediatePropagation();e.stopPropagation();e.preventDefault()}}};var a=true;if(Modernizr&&Modernizr.hasOwnProperty("touch")){a=Modernizr.touch}var f=function(){s.splice(0,1)};e.event.special.fastclick={touchstart:function(t){o.startX=t.originalEvent.touches[0].pageX;o.startY=t.originalEvent.touches[0].pageY;o.hasMoved=false;e(this).on("touchmove",e.event.special.fastclick.touchmove)},touchmove:function(t){if(Math.abs(t.originalEvent.touches[0].pageX-o.startX)>i||Math.abs(t.originalEvent.touches[0].pageX-o.startY)>i){o.hasMoved=true;e(this).off("touchmove",e.event.special.fastclick.touchmove)}},add:function(t){if(!a){return}var r=e(this);r.data("objHandlers")[t.guid]=t;var i=t.handler;t.handler=function(t){r.off("touchmove",e.event.special.fastclick.touchmove);if(!o.hasMoved){s.push({x:o.startX,y:o.startY});window.setTimeout(f,n);var u=this;var a=e([]);var l=arguments;e.each(r.data("objHandlers"),function(){if(!this.selector){if(r[0]==t.target||r.has(t.target).length>0)i.apply(r,l)}else{e(this.selector,r).each(function(){if(this==t.target||e(this).has(t.target).length>0)i.apply(this,l)})}})}}},setup:function(n,r,i){var s=e(this);if(!a){s.on("click",e.event.special.fastclick.handler);return}t=t.add(s);if(!s.data("objHandlers")){s.data("objHandlers",{});s.on("touchstart",e.event.special.fastclick.touchstart);s.on("touchend touchcancel",e.event.special.fastclick.handler)}if(!o.ghostbuster){e(document).on("click vclick",u);o.ghostbuster=true}},teardown:function(n){var r=e(this);if(!a){r.off("click",e.event.special.fastclick.handler);return}t=t.not(r);r.off("touchstart",e.event.special.fastclick.touchstart);r.off("touchmove",e.event.special.fastclick.touchmove);r.off("touchend touchcancel",e.event.special.fastclick.handler);if(t.length==0){e(document).off("click vclick",u);o.ghostbuster=false}},remove:function(t){if(!a){return}var n=e(this);delete n.data("objHandlers")[t.guid]},handler:function(t){var n=t.type;t.type="fastclick";e.event.trigger.call(this,t,{},this,true);t.type=n}}})(jQuery)