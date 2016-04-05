/**
 * BuddyBoss Media > Pics JavaScript functionality
 *
 * A BuddyPress plugin combining user activity feeds with media management.
 *
 * This file should load in the footer
 *
 * @author      BuddyBoss
 * @since       BuddyBoss Media 1.0, BuddyBoss Media 1.0, BuddyBoss Media Pics 1.0
 * @package     buddyboss-media
 *
 * ====================================================================
 *
 * 1. jQuery + Globals
 * 2. BuddyBoss Media Picture Grid + PhotoSwipe
 * 3. BuddyBoss Media Uploader
 */


/**
 * 1. jQuery + Globals
 * ====================================================================
 */
var jq = $ = jQuery.noConflict();

// Window.Code fallback
window.Code = window.Code || { Util: false, PhotoSwipe: false };

// Util
window.BuddyBoss_Media_Util = ( function ( window, $, opt, undefined ) {

	var $window = $( window );

	var Util = {
		state: opt,
		lang: function ( key ) {
			var key = key || 'undefined key!';
			return opt[key] || 'Language key missing for: ' + key;
		}
	}

	var resizeThrottle;

	// Check for mobile resolution
	function checkMobile() {
		// Set to true if not set and is mobile
		if ( ! Util.state.isMobile && $window.width() <= 800 ) {
			Util.state.isMobile = true;
		}
		// Set to false if not set
		else if ( ! Util.state.isMobile ) {
			Util.state.isMobile = false;
		}
	}
	checkMobile();

	// Check for mobile resolution on resize
	$window.on( 'resize orientationchange', function () {
		clearTimeout( resizeThrottle );
		resizeThrottle = setTimeout( checkMobile, 75 );
	} );

	return Util;

}
(
		window,
		window.jQuery,
		window.BuddyBoss_Media_Appstate || { }
) );

/**
 * 2. BuddyBoss Media Picture Grid + PhotoSwipe
 * ====================================================================
 * @returns {object} BuddyBossSwiper
 *
 * window.Code.BuddyBossSwiper.has_media()
 */

window.Code.BuddyBossSwiper = ( function ( window, PhotoSwipe_Util, PhotoSwipe, BuddyBoss_Media_Util ) {

	if ( ! PhotoSwipe_Util || ! PhotoSwipe ) {
		return false;
	}

	var
			$buddyboss_photo_grid = $( '#buddyboss-media-grid' ),
			$document = $( document ),
			buddyboss_mediawipe = false,
			current_photo_permalink,
			current_photo_activity_text,
			$caption,
			$comment_link,
			comment_count,
			favorite_count,
			favorite_class,
			photo_id;
	buddyboss_mediawipe_options = {
		preventSlideshow: true,
		imageScaleMethod: 'fitNoUpscale',
		loop: false,
		captionAndToolbarAutoHideDelay: 0,
		// Toolbar HTML
		getToolbar: function () {
			return '<div class="ps-toolbar-close"><div class="ps-toolbar-content"></div></div><div class="ps-toolbar-favorite"><div class="ps-toolbar-content"></div><div class="ps-favorite-count"></div></div><div class="ps-toolbar-comments"><div class="ps-toolbar-content"></div><div class="ps-comments-count"></div></div><div class="ps-toolbar-delete"><div class="ps-toolbar-content loading" style="display:none"><i class="fa fa-spinner fa-spin"></i></div><div class="ps-toolbar-content real"></div></div><div class="ps-toolbar-previous ps-toolbar-previous-disabled"><div class="ps-toolbar-content"></div></div><div class="ps-toolbar-next"><div class="ps-toolbar-content"></div></div>';
			// NB. Calling PhotoSwipe.Toolbar.getToolbar() wil return the default toolbar HTML
		},
		// Return the current activity text for the caption
		getImageCaption: function ( el ) {
			var $pic = $( el );
			var $comment, $caption;

			current_photo_permalink = '#';
			current_photo_activity_text = '';

			if ( $pic.find( 'img' ).length == 0 )
				return '';

			current_photo_permalink = $pic.find( 'img' )[0].getAttribute( 'data-permalink' );
			current_photo_owner = $pic.find( 'img' )[0].getAttribute( 'data-owner' );
			current_photo_media = $pic.find( 'img' )[0].getAttribute( 'data-media' );
			current_photo_link_elm = $pic;
			comment_count = $pic.find( 'img' )[0].getAttribute( 'data-comment-count' );
			favorite_count = $pic.find( 'img' )[0].getAttribute( 'data-favorite-count' );
			favorite_class = $pic.find( 'img' )[0].getAttribute( 'data-bbmfav' );
			photo_id = $pic.find( 'img' )[0].getAttribute( 'data-photo-id' );

			// We would like to show comment/status update text if possible, which
			// only shows on the activity pages. If the user uploaded a photo without
			// a status update we'll use the activity header/upload date.

			// If we're on the photo album page we'll grab the text from a custom snippet
			// we output with PHP
			if ( $( '#bbmedia-grid-wrapper' ).length > 0 ) {
				$caption = $pic.closest( '.bbmedia-grid-item' ).find( '.buddyboss_media_caption' );
				$comment = $caption.find( '.buddyboss_media_caption_body' );

				$comment.find( 'a' ).remove();

				current_photo_activity_text = $comment.text();

				// Replace all whitespace and check for contents, if empty fallback to upload date
				if ( current_photo_activity_text.replace( /\s/g, '' ) === '' ) {
					current_photo_activity_text = $caption.find( '.buddyboss_media_caption_action' ).text();
				}

			}

			// Otherwise look for a comment/status update and fallback to activity header/upload date
			else {
				// We need to remove elements from the status update because jQuery
				// picks up text within the title attribue on anchors
				$comment = $pic.parents( '.activity-inner' ).clone();
				$comment.find( 'a' ).remove();

				current_photo_activity_text = $comment.text();

				// Replace all whitespace and check for contents, if empty fallback to upload date
				if ( current_photo_activity_text.replace( /\s/g, '' ) === '' ) {
					current_photo_activity_text = $pic.parents( '.activity-content' ).find( '.activity-header' ).text();
				}
			}

			return $.trim( current_photo_activity_text );
		},
		// Store data we need
		getImageMetaData: function ( el ) {
			return {
				href: current_photo_permalink,
				caption: current_photo_activity_text,
				owner: current_photo_owner,
				media: current_photo_media,
				link_elm: current_photo_link_elm,
				comment_count: comment_count,
				favorite_count: favorite_count,
				favorite_class: favorite_class,
				photo_id: photo_id
			};
		}

	}; // End PhotoSwipe setup

	BuddyBossSwiperClass = {
		has_grid: function () {
			return $buddyboss_photo_grid.length > 0;
		},
		has_photoswipe: function () {
			return buddyboss_mediawipe !== false;
		},
		location_from_current: function () {

			var current, comments_href, callback_args;

			if ( ! BuddyBossSwiperClass.has_photoswipe() ) {
				return false;
			}

			current = buddyboss_mediawipe.getCurrentImage();
			comments_href = current.metaData.href;
			callback_args = { comments_href: comments_href, current: current };

			$( document ).trigger( 'buddyboss:media:comment_link', callback_args );

			setTimeout( function () {
				window.location = comments_href;
			}, 15 );
		},
		reset: function () {

			if ( buddyboss_mediawipe !== false ) {
				try {
					PhotoSwipe.detatch( buddyboss_mediawipe );
				}
				catch ( e ) {

				}
			}

			BuddyBossSwiperClass.start();

		},
		start: function () {

			var _pics_sel = BuddyBossSwiperClass.has_grid()
					? '.gallery-icon > a'
					: '.buddyboss-media-photo-wrap';

			var $buddyboss_media = $( _pics_sel );

			if ( $buddyboss_media.length > 0 ) {
				// Load PhotoSwipe
				buddyboss_mediawipe = $buddyboss_media.photoSwipe( buddyboss_mediawipe_options );

				// Before showing we need to update the comment icon with the
				// proper permalink
				buddyboss_mediawipe.addEventHandler( PhotoSwipe.EventTypes.onBeforeShow, function ( e ) {
					// Prevent scrolling while active
					$( 'html' ).css( { overflow: 'hidden' } );
				} );

				// After showing we need to revert any changes we made during the
				// onBeforeShow event
				buddyboss_mediawipe.addEventHandler( PhotoSwipe.EventTypes.onHide, function ( e ) {
					// Allow scrolling again
					$( 'html' ).css( { overflow: 'auto' } );

					current_photo_activity_text = null;
					current_photo_permalink = null;

					$caption.off( 'click' );
					$caption = null;

					$comment_link = null;

					// console.log( 'Hiding PhotoSwipe' );
					setTimeout( function () {
						$( window ).trigger( 'reset_carousel' );
					}, 555 );
				} );

				// onCaptionAndToolbarShow
				buddyboss_mediawipe.addEventHandler( PhotoSwipe.EventTypes.onCaptionAndToolbarShow, function ( e ) {
					$caption = $( '.ps-caption' ).on( 'click', function ( e ) {
						window.location = buddyboss_mediawipe.getCurrentImage().metaData.href;
					} );
					$comment_link = $( '.ps-toolbar-comments' );

				} );

				buddyboss_mediawipe.addEventHandler( PhotoSwipe.EventTypes.onToolbarTap, function ( e ) {
					if ( e.toolbarAction === PhotoSwipe.Toolbar.ToolbarAction.none ) {
						if ( e.tapTarget === $comment_link[0] || PhotoSwipe_Util.DOM.isChildOf( e.tapTarget, $comment_link[0] ) ) {

							var current = buddyboss_mediawipe.getCurrentImage(),
									comments_href = current.metaData.href,
									callback_args = { comments_href: comments_href, current: current };

							$( document ).trigger( 'buddyboss:media:comment_link', callback_args );

							window.location = comments_href;
						}

						if ( e.tapTarget === $( '.ps-toolbar-favorite' )[0] || PhotoSwipe_Util.DOM.isChildOf( e.tapTarget, $( '.ps-toolbar-favorite' )[0] ) ) {

							cache_ele = buddyboss_mediawipe.getCurrentImage().metaData.link_elm;
							var target = buddyboss_mediawipe.getCurrentImage().metaData;
							var act_id = target.media;
							var fav_class_obj = $( '#activity-' + act_id ).find( '.buddyboss-media-photo' ).first();
							var fav_class = fav_class_obj.attr( 'data-bbmfav' );
							var type = fav_class === 'bbm-fav' ? 'fav' : 'unfav';

							mark_it = jq.post( ajaxurl, {
								action: 'bbm_activity_mark_' + type,
								id: act_id,
								item_type: 'bbm_activity_mark'
							} );
							try {
								mark_it.done( function ( d ) {

									if ( d ) {
										d = jq.parseJSON( d );

										if ( d.action === 'fav' ) {

											jq( '.ps-toolbar-favorite' ).removeClass( 'bbm-fav' );
											jq( '.ps-toolbar-favorite' ).addClass( 'bbm-unfav' );
											jq( fav_class_obj ).attr( 'data-bbmfav', 'bbm-unfav' );

											//Updating activity markup
											var activity_meta_obj = jq( '#activity-' + act_id ).find( '.activity-meta .fav' );

											if ( activity_meta_obj.length > 0 ) {
												var fav_url = jq( activity_meta_obj ).attr( 'href' );

												jq( activity_meta_obj ).removeClass( 'fav' );
												jq( activity_meta_obj ).addClass( 'unfav' );
												jq( activity_meta_obj ).attr( 'title', BP_DTheme.remove_fav );

												var new_url = fav_url.replace( 'unfavorite', 'favorite' );
												jq( activity_meta_obj ).attr( 'href', new_url );
											}

										}
										else {

											jq( '.ps-toolbar-favorite' ).removeClass( 'bbm-unfav' );
											jq( '.ps-toolbar-favorite' ).addClass( 'bbm-fav' );
											jq( fav_class_obj ).attr( 'data-bbmfav', 'bbm-fav' );

											//Updating activity markup
											var activity_meta_obj = jq( '#activity-' + act_id ).find( '.activity-meta .unfav' );

											if ( activity_meta_obj.length > 0 ) {
												var fav_url = jq( activity_meta_obj ).attr( 'href' );

												jq( activity_meta_obj ).removeClass( 'unfav' );
												jq( activity_meta_obj ).addClass( 'fav' );
												jq( activity_meta_obj ).attr( 'title', BP_DTheme.mark_as_fav );

												var new_url = fav_url.replace( 'favorite', 'unfavorite' );
												jq( activity_meta_obj ).attr( 'href', new_url );
											}

										}

										jq( fav_class_obj ).attr( 'data-favorite-count', d.count );
										jq( '.ps-favorite-count' ).html( d.count );
									}

								} );
							} catch ( e ) {
							}

						}

						if ( e.tapTarget === $( '.ps-toolbar-delete' )[0] || PhotoSwipe_Util.DOM.isChildOf( e.tapTarget, $( '.ps-toolbar-delete' )[0] ) ) {
							if ( confirm( BuddyBoss_Media_Appstate.sure_delete_photo ) ) {

								$( '.ps-toolbar-delete' ).find( ".loading" ).show();
								$( '.ps-toolbar-delete' ).find( ".real" ).hide();
								cache_ele = buddyboss_mediawipe.getCurrentImage().metaData.link_elm; //due to photoswipe bug.
								delete_it = jq.post( ajaxurl, { 'action': 'buddyboss_delete_media', 'media': buddyboss_mediawipe.getCurrentImage().metaData.media, 'photo-id': buddyboss_mediawipe.getCurrentImage().metaData.photo_id } );
								try {
									delete_it.done( function ( d ) {
										if ( d == "done" ) {
											jq( "#activity-" + buddyboss_mediawipe.getCurrentImage().metaData.media ).remove();
											jq( ".ps-toolbar-content" ).click();
											location.reload();
										} else {
											alert( d );
										}
									} );
									delete_it.always( function () {
										$( '.ps-toolbar-delete' ).find( ".loading" ).hide();
										$( '.ps-toolbar-delete' ).find( ".real" ).show();

										jq( cache_ele ).first().click();

									} );
								} catch ( e ) {
								}
							}
						}
					}
				} );


				buddyboss_mediawipe.addEventHandler( PhotoSwipe.EventTypes.onDisplayImage, function ( e ) {

					$( '.ps-comments-count' ).html( buddyboss_mediawipe.getCurrentImage().metaData.comment_count );

					$delete_link = $( '.ps-toolbar-delete' );
					if ( buddyboss_mediawipe.getCurrentImage().metaData.owner == "1" ) {
						$delete_link.show();
					} else {
						$delete_link.hide();
					}

					var acti_id = buddyboss_mediawipe.getCurrentImage().metaData.media;
					var fav_class_obj = $( '#activity-' + acti_id ).find( '.buddyboss-media-photo' ).first();

					$( '.ps-favorite-count' ).html( fav_class_obj.attr( 'data-favorite-count' ) );
					$( '.ps-toolbar-favorite' ).removeClass( 'bbm-unfav' );
					$( '.ps-toolbar-favorite' ).removeClass( 'bbm-fav' );
					$( '.ps-toolbar-favorite' ).addClass( fav_class_obj.attr( 'data-bbmfav' ) );


				} );


			} // End if pics.length > 0
		}
	}

	BuddyBossSwiperClass.start();

	function ajaxSuccessHandler( e, xhr, options ) {

		var action = bbmedia_getQueryVariable( options.data, 'action' );
		var resetCallback = function ( action ) {
			return function () {
				if ( action !== 'heartbeat' && action !== 'bbm_activity_mark_fav' && action !== 'bbm_activity_mark_unfav' ) {
					BuddyBossSwiperClass.reset();
				}
			}
		}( action );

		// Most BuddyPress animations finish after 200ms
		window.setTimeout( resetCallback, 205 );

		// Perform again once after a longer delay just in case
		// @TODO: Get a dom observer
		window.setTimeout( resetCallback, 750 );
	}

	$( document ).ajaxSuccess( ajaxSuccessHandler );

	return BuddyBossSwiperClass;

}
(
		window,
		window.Code.Util || false,
		window.Code.PhotoSwipe || false,
		window.BuddyBoss_Media_Util
		) );



/**
 * 3. BuddyBoss Media Uploader
 * ====================================================================
 * @returns {object} BuddyBoss_Media_Uploader
 *
 * window.BuddyBoss_Media_Uploader = {
 *   /.../
 * }
 */

window.BuddyBoss_Media_Uploader = ( function ( window, $, util, undefined ) {

	var uploader = false;

	var _l = { },
			filesAdded = 0;

	var state = util.state || { },
			lang = util.lang;

	var pics_uploaded = [ ];

	var APP = {
		/**
		 * Startup
		 *
		 * @return {void}
		 */
		init: function () {

			var self = this;

			this.inject_markup();

			if ( ! this.get_elements() ) {
				return false;
			}

			this.setup_modal();
			this.setup_textbox();

			setTimeout( function () {
				self.start_uploader();
			}, 10 );

			$.ajaxPrefilter( APP.prefilter );
		},
		/**
		 * Would handle teardowns if AJAX was implemented for page
		 * navigations.
		 *
		 * @return {void}
		 */
		destroy: function () {
			// this.destroy_button();
		},
		/**
		 * Dynamically inject markup, this avoids relying on BuddyPress
		 * templating and helps handle plugin conflicts
		 *
		 * @return {void}
		 */
		inject_markup: function () {
			// Activity greeting on user photo "What's new, %firstname%"
			var $activity_greeting = $( '.my-gallery .activity-greeting' ),
					greeting = lang( 'user_add_photo' );

			if ( $activity_greeting.length && ! ! greeting ) {
				$activity_greeting.text( greeting ).show();
			}

			// For our add photo, progress and preview area we rely
			// on #what-new-content
			var $whats_new_content = $( '#whats-new-content' );

			// Add photo button + progress area
			var $add_photo = $( '#buddyboss-media-tpl-add-photo' );

			if ( $add_photo.length && $whats_new_content.length ) {
				$whats_new_content.before( $add_photo.html() );
			}

			// Add photo preview pane
			var $preview_pane = $( '#buddyboss-media-tpl-preview' );

			if ( $preview_pane.length && $whats_new_content.length ) {
				$whats_new_content.find( 'textarea' ).after( $preview_pane.html() );
			}
		},
		/**
		 * Get DOM elements we'll need
		 *
		 * @return {boolean} True if we have the required elements
		 */
		get_elements: function () {
			_l.$whats_new = $( '#whats-new' );

			if ( _l.$whats_new.length === 0 ) {
				return false;
			}

			_l.$add_photo = $( '#buddyboss-media-bulk-uploader' );
			_l.$open_uploder_button = $( '#buddyboss-media-add-photo-button' );
			_l.$add_photo_button = $( '#logo-file-browser-button' );
			_l.$post_button = $( '#whats-new-submit' ).find( '[type=submit],button' );
			_l.$uploader = $( '#buddyboss-media-bulk-uploader' );
			_l.$uploaded = $( '#buddyboss-media-bulk-uploader-uploaded .images' );
			_l.$preview_pane = $( '#buddyboss-media-preview-inner' );

			return true;
		},
		/**
		 * Magic. BuddyPress disables the post button when there aren't any
		 * characters in the post box. Since we want to allow users to upload
		 * photos as status updates, we get around disabling the post button
		 * with a timer.
		 *
		 * @return {void}
		 */
		setup_textbox: function () {
			_l.$whats_new.blur( function () {
				setTimeout( function () {
					if ( pics_uploaded && pics_uploaded.length > 0 ) {
						_l.$post_button.removeAttr( 'disabled' );
						_l.$post_button.prop( 'disabled', false );
					}
				}, 200 )
			} );
		},
		/**
		 * Setup fancybox
		 *
		 * @return {void}
		 */
		setup_modal: function () {
			_l.$open_uploder_button.fancybox( {
				href: '#buddyboss-media-bulk-uploader-wrapper',
				minWidth: 500,
				beforeLoad: function () {
					$( '#buddyboss-media-bulk-uploader-text' ).val( _l.$whats_new.val() );
				},
				beforeClose: function () {
					if ( $( '#buddyboss-media-bulk-uploader-text' ).length > 0 ) {
						_l.$whats_new.val( $( '#buddyboss-media-bulk-uploader-text' ).val() );
					}
				}
			} );

			$( '#aw-whats-new-submit-bbmedia' ).click( function () {
				$.fancybox.close();
				_l.$post_button.trigger( 'click' );
			} );
		},
		/**
		 * We use jQuery's Ajax.preFilter hook to add picture related
		 * uploads to new status update's when needed. Be wary of the
		 * dragons.
		 *
		 * @param  {object} options      jQuery ajax options that are sending
		 * @param  {object} origOptions  Original jQuery ajax options
		 * @param  {object} jqXHR        jQuery XHR object
		 * @return {void}
		 */
		prefilter: function ( options, origOptions, jqXHR ) {

			var action = bbmedia_getQueryVariable( options.data, 'action' );

			if ( typeof action == 'undefined' || action != 'post_update' )
				return;

			var new_data,
					pic_html = '';

			if ( pics_uploaded.length > 0 ) {
				for ( var i = 0; i < pics_uploaded.length; i ++ ) {
					var pic = $( '<a/>' )
							.attr( 'href', pics_uploaded[i].url )
							.attr( 'target', '_blank' )
							.attr( 'title', pics_uploaded[i].name )
							.addClass( 'buddyboss-media-photo-link' )
							.html( pics_uploaded[i].name )[0].outerHTML;

					pic_html += pic;
				}

				new_data = $.extend( { }, origOptions.data, {
					content: origOptions.data.content + ' ' + pic_html,
					pics_uploaded: pics_uploaded
				} );

				options.data = $.param( new_data );

				options.success = ( function ( old_success ) {

					return function ( response, txt, xhr ) {
						if ( $.isFunction( old_success ) ) {
							old_success( response, txt, xhr );
						}

						if ( response[0] + response[1] !== '-1' ) {
							APP.post_success( response, txt, xhr );
						}
					}
				} )( options.success );
			}
			else if ( origOptions.data && origOptions.data.action === 'get_single_activity_content' ) {
				options.success = ( function ( old_success ) {
					return function ( response, txt, xhr ) {
						if ( $.isFunction( old_success ) ) {
							old_success( response, txt, xhr );
						}

						if ( response[0] + response[1] !== '-1' ) {
							APP.readmore_success( response, txt, xhr );
						}
					}
				} )( options.success );
			}
		},
		/**
		 * This callback fires after a photo was posted as part of
		 * an activity update, we'll animate the preview closed
		 * and reset.
		 *
		 * @param  {object} response Ajax response
		 * @return {void}
		 */
		post_success: function ( response ) {

			/* BuddyBoss: If we're using pics, we need to attach PhotoSwipe */
			var $new = $( "li.new-update" ).find( '.buddyboss-media-photo-wrap' );
			if ( $new.length > 0 && typeof BuddyBossSwiper == 'object'
					&& BuddyBossSwiper.hasOwnProperty( 'reset' ) ) {
				BuddyBossSwiper.reset();
			}

			/* reset everything upload related */
			pics_uploaded = [ ];
			_l.$preview_pane.html( '' );
			_l.$uploaded.html( '' );
			uploader.splice( 0, uploader.files.length );
			filesAdded = 0;
		},
		/**
		 * Handles upload, upload progress and previewing pics
		 *
		 * @return {void}
		 */
		start_uploader: function () {
			var $progressBar, progressPercent = 0;

			//var uploader_state = 'closed';
			var ieMobile = navigator.userAgent.indexOf( 'IEMobile' ) !== - 1;

			// IE mobile
			if ( ieMobile ) {
				_l.$add_photo.addClass( 'legacy' );
			}

			uploader = new plupload.Uploader( {
				runtimes: state.uploader_runtimes || 'html5,flash,silverlight,html4',
				browse_button: _l.$add_photo_button[0],
				dragdrop: true,
				container: 'buddyboss-media-bulk-uploader-reception',
				drop_element: 'buddyboss-media-bulk-uploader-wrapper',
				max_file_size: state.uploader_filesize || '10mb',
				multi_selection: state.uploader_multiselect || false,
				url: ajaxurl,
				multipart: true,
				multipart_params: {
					action: 'buddyboss_media_post_photo',
					'cookie': encodeURIComponent( document.cookie ),
					'_wpnonce_post_update': $( "input#_wpnonce_post_update" ).val()
				},
				flash_swf_url: state.uploader_swf_url || '',
				silverlight_xap_url: state.uploader_xap_url || '',
				filters: [
					{ title: lang( 'file_browse_title' ), extensions: state.uploader_filetypes || 'jpg,jpeg,gif,png,bmp', prevent_duplicates: true }
				],
				init: {
					Init: function () {
						if ( _l.$add_photo.find( '.moxie-shim' ).find( "input" ).length == '0' ) {
							_l.$add_photo.find( '.moxie-shim' ).first().css( "z-index", 10 );
							_l.$add_photo.find( '.moxie-shim' ).css( "cursor", 'pointer' );
						} else {
							clone = $( _l.$add_photo_button[0] ).clone();
							$( _l.$add_photo_button[0] ).after( clone ).remove();
							_l.$add_photo_button[0] = clone;
							$( _l.$add_photo_button[0] ).on( "click", function () {
								_l.$add_photo.find( '.moxie-shim' ).find( "input" ).click();
							} );
						}
					},
					FilesAdded: function ( up, files ) {
						
						jQuery('#aw-whats-new-submit-bbmedia').prop('disabled', true);
						
						if ( up.files.length > state.uploader_max_files || files.length > state.uploader_max_files ) {
							uploader.splice( filesAdded, uploader.files.length );

							alert( lang( 'exceed_max_files_per_batch' ) );
							return false;
						}

						for ( var i = 0; i < files.length; i ++ ) {
							if ( $( 'div[data-fileid="' + files[i].id + '"]' ).length === 0 ) {
								var newimg = "<div data-fileid='" + files[i].id + "' class='file uploading'><img src='" + state.uploader_temp_img + "'><progress class='buddyboss-media-progress-bar' value='0' max='100'></progress></div>";
								_l.$uploaded.append( newimg );
								_l.$preview_pane.append( newimg );
								filesAdded ++;
							}
						}
						$.fancybox.update();
						up.start();
					},
					UploadProgress: function ( up, file ) {

						if ( file && file.hasOwnProperty( 'percent' ) ) {
							$progressBar = $( 'div[data-fileid="' + file.id + '"]' ).find( 'progress' );
							progressPercent = file.percent;
							$progressBar.val( progressPercent );
						}
					},
					FileUploaded: function ( up, file, info ) {
						
						jQuery('#aw-whats-new-submit-bbmedia').prop('disabled', false);
						
						var responseJSON = $.parseJSON( info.response );
						//console.log('// ----- upload response ----- //');
						//console.log(up,file,info,responseJSON);
						$file = $( 'div[data-fileid="' + file.id + '"]' );
						$file.removeClass( 'uploading' );
						$file.data( 'attachment_id', responseJSON.attachment_id );
						$file.find( '>img' ).attr( 'src', responseJSON.url );

						$file.find( 'progress' ).replaceWith(
								"<a href='#' onclick='return window.BuddyBoss_Media_Uploader.removeUploaded(\"" + file.id + "\");' class='delete'>+</a>"
								);

						pics_uploaded.push( responseJSON );
						$.fancybox.update();
					},
					Error: function ( up, args ) {
						jQuery('#aw-whats-new-submit-bbmedia').prop('disabled', false);
						alert( lang( 'error_uploading_photo' ) );

						$progressWrap.removeClass( 'uploading' );
						$postButton.prop( "disabled", false ).removeClass( 'loading' );

						//uploader_state = 'closed';
					}
				}
			} );

			uploader.init();

			jQuery('.fancybox-close').on('click',function() {
                   jQuery('#aw-whats-new-submit-bbmedia').prop('disabled', false);  
			});

			if ( $( '#buddyboss-media-bulk-uploader-reception-fake' ).length > 0 ) {
				var additional_dropzone = document.getElementById( 'buddyboss-media-bulk-uploader-reception-fake' );
				$additional_dropzone = $( additional_dropzone );

				var dropzone = new mOxie.FileDrop( {
					drop_zone: additional_dropzone
				} );

				dropzone.ondrop = function ( event ) {
					_l.$open_uploder_button.click();//to open modal window
					uploader.addFile( dropzone.files );
				};

				dropzone.init();

				// -- Configure FILEINPUT -- //

				var input = new mOxie.FileInput( {
					browse_button: $( "a.browse-file-button", $additional_dropzone )[ 0 ],
					container: additional_dropzone,
					multiple: true
				} );

				input.onchange = function ( event ) {
					_l.$open_uploder_button.click();//to open modal window
					uploader.addFile( input.files );
				};

				input.init();

			}

		}, // start_uploader();

		removeUploaded: function ( fileid ) {
			/* remove from upload files list */
			var $file = $( 'div[data-fileid="' + fileid + '"]' );
			if ( pics_uploaded.length > 0 ) {
				var pics_uploaded_temp = [ ];
				for ( var i = 0; i < pics_uploaded.length; i ++ ) {
					if ( pics_uploaded[i].attachment_id !== $file.data( 'attachment_id' ) ) {
						pics_uploaded_temp.push( pics_uploaded[i] );
					}
				}

				pics_uploaded = pics_uploaded_temp;
			}

			var file_to_remove = false;
			/* remove from plupload queue */
			$.each( uploader.files, function ( i, ufile ) {
				if ( ufile.hasOwnProperty( 'id' ) && ufile.id == fileid ) {
					file_to_remove = ufile;
				}
			} );

			if ( file_to_remove ) {
				uploader.removeFile( file_to_remove );
				filesAdded --;
			}

			/* delete html */
			$file.remove();
			return false;
		}
	} // APP


	var API = {
		setup: function () {
			APP.init();
		},
		teardown: function () {
			APP.destroy();
		},
		removeUploaded: function ( file ) {
			return APP.removeUploaded( file );
		}
	} // API

	$( document ).ready( function () {
		APP.init();
	} );

	return API;
}
(
		window,
		window.jQuery,
		window.BuddyBoss_Media_Util
		) );

/* get querystring value */
function bbmedia_getQueryVariable( query, variable ) {
	if ( typeof query == 'undefined' || query == '' || typeof variable == 'undefined' || variable == '' )
		return '';

	var vars = query.split( "&" );

	for ( var i = 0; i < vars.length; i ++ ) {
		var pair = vars[i].split( "=" );

		if ( pair[0] == variable ) {
			return pair[1];
		}
	}
	return( false );
}

bbmedia_move_media_opened = false;
bbmedia_tag_friends_opened = false;
$( document ).ready( function () {
	//escape key press
	//lets hide 'move media' form if its open
	$( document ).keyup( function ( e ) {
		if ( e.keyCode == 27 && ( bbmedia_move_media_opened === true || bbmedia_tag_friends_opened === true ) ) {
			if ( bbmedia_move_media_opened === true )
				buddyboss_media_move_media_close();
			if ( bbmedia_tag_friends_opened === true )
				buddyboss_media_tag_friends_close();
		}
	} );

	/**
	 * Conditional tags like is_page() dont work in ajax request.
	 * So there's no direct way to detect if we are on global media page.
	 * 
	 * Therefore, we set a cookie, which is passed along in ajax request.
	 * There might be a better way though.
	 */
	if ( BBOSS_MEDIA.is_media_page ) {
		docCookies.setItem( "bp-bboss-is-media-page", "yes", "", "/" );
	} else {
		docCookies.removeItem( "bp-bboss-is-media-page", "/" );
	}

	/**
	 * Fix for nth-child selector messup in grid layout, due to hidden 'load_more' child elements.
	 * 
	 * Intercept response for load more activities and remove the 'load_more' link element.
	 */
	$.ajaxPrefilter( function ( options, originalOptions, jqXHR ) {
		var originalSuccess = options.success;

		var action = bbmedia_getQueryVariable( options.data, 'action' );

		if ( typeof action == 'undefined' || action != 'activity_get_older_updates' )
			return;

		options.success = function ( data ) {
			$( '#bbmedia-grid-wrapper #activity-stream li.load-more' ).remove();
			if ( originalSuccess != null ) {
				originalSuccess( data );
			}
		};
	} );

	//Updating activity markup for photoswipe favorite icon
	$( '.activity-meta' ).on( 'click', 'a.fav', function () {

		var img_wrap = $( this ).parents( '.activity-content' ).find( '.buddyboss-media-photos-wrap-container' );

		if ( ! ( img_wrap.length > 0 ) ) {
			return;
		}

		$( img_wrap ).find( '.buddyboss-media-photo-wrap .buddyboss-media-photo' ).each( function () {
			var fav_count = $( this ).attr( 'data-comment-count' );
			$( this ).attr( 'data-bbmfav', 'bbm-unfav' );
			$( this ).attr( 'data-favorite-count', parseInt( fav_count ) + 1 );

		} );

	} );

	$( '.activity-meta' ).on( 'click', 'a.unfav', function () {

		var img_wrap = $( this ).parents( '.activity-content' ).find( '.buddyboss-media-photos-wrap-container' );

		if ( ! ( img_wrap.length > 0 ) ) {
			return;
		}

		$( img_wrap ).find( '.buddyboss-media-photo-wrap .buddyboss-media-photo' ).each( function () {
			var fav_count = $( this ).attr( 'data-comment-count' );
			$( this ).attr( 'data-bbmfav', 'bbm-fav' );
			if ( fav_count == 0 ) {
				$( this ).attr( 'data-favorite-count', parseInt( fav_count ) );
			} else {
				$( this ).attr( 'data-favorite-count', parseInt( fav_count ) - 1 );
			}

		} );

	} );

} );

/* ++++++++++++++++++++++++++++++++++++
 * Move photos betweeen albums
 ++++++++++++++++++++++++++++++++++++ */
function buddyboss_media_initiate_media_move( link ) {
	$link = $( link );
	$form = $( '#frm_buddyboss-media-move-media' );
	$form_wrapper = $form.parent();

	//slideup comment form
	$link.closest( '.activity' ).find( 'form.ac-form' ).slideUp();

	if ( $form_wrapper.is( ':visible' ) ) {
		buddyboss_media_move_media_close();
		return false;
	}

	$link.closest( '.activity-content' ).after( $form_wrapper );

	//Highlight previously selected album
	var selected_album = $link.data( 'album_id' );
	if ( ! selected_album )
		selected_album = '';//string
	$form.find( '#buddyboss_media_move_media_albums' ).val( selected_album );

	$form_wrapper.slideDown( 200 );
	bbmedia_move_media_opened = true;

	//setup form data
	$form.find( 'input[name="activity_id"]' ).val( $link.data( 'activity_id' ) );

	return false;
}

function buddyboss_media_submit_media_move() {
	$form = $( '#frm_buddyboss-media-move-media' );
	$submit_button = $form.find( 'input[type="submit"]' );

	if ( $submit_button.hasClass( 'loading' ) )
		return false;//previous request hasn't finished yet!

	/**
	 * 1. gather data
	 * 2. start ajax
	 * 3. receive response
	 * 4. process response
	 *      - remove loading class
	 *      - remove activity item entry if required
	 *    - move form to a different place first
	 *      - slideup form
	 */

	var data = {
		'action': $form.find( 'input[name="action"]' ).val(),
		'bboss_media_move_media_nonce': $form.find( 'input[name="bboss_media_move_media_nonce"]' ).val(),
		'activity_id': $form.find( 'input[name="activity_id"]' ).val(),
		'buddyboss_media_move_media_albums': $form.find( 'select[name="buddyboss_media_move_media_albums"]' ).val()
	};

	$submit_button.addClass( 'loading' );
	$form.find( "#message" ).removeAttr( 'class' ).html( '' );

	$.ajax( {
		type: "POST",
		url: ajaxurl,
		data: data,
		success: function ( response ) {
			response = $.parseJSON( response );
			if ( response.status ) {
				$form.find( "#message" ).addClass( 'updated' ).html( "<p>" + response.message + "</p>" );
				if ( $form.find( 'input[name="is_single_album"]' ).val() == 'yes' ) {
					setTimeout( function () {
						buddyboss_media_media_move_cleanup( $form, true );
					}, 2000 );
				} else {
					setTimeout( function () {
						buddyboss_media_media_move_cleanup( $form, false );
					}, 2000 );
				}
			} else {
				$form.find( "#message" ).addClass( 'error' ).html( "<p>" + response.message + "</p>" );
			}

			$submit_button.removeClass( 'loading' );
		}
	} );

	return false;
}

function buddyboss_media_media_move_cleanup( $form, remove_activity_item ) {
	$form.find( "#message" ).removeAttr( 'class' ).html( '' );
	$form_wrapper = $form.parent();

	buddyboss_media_move_media_close();
	if ( remove_activity_item ) {
		$activity = $form.closest( '.activity' );

		$( 'body' ).append( $form_wrapper );
		$form_wrapper.hide();
		$activity.slideUp( 200, function () {
			$activity.remove();
		} );
	}
}

function buddyboss_media_move_media_close() {
	$form = $( '#frm_buddyboss-media-move-media' );
	$form_wrapper = $form.parent();

	$form_wrapper.slideUp( 200 );
	bbmedia_move_media_opened = false;

	return false;
}
/* ________________________________ */


/* ++++++++++++++++++++++++++++++++++++
 * Tag Friends
 ++++++++++++++++++++++++++++++++++++ */
function buddyboss_media_initiate_tagging( link ) {
	$link = $( link );
	$form = $( '#frm_buddyboss-media-tag-friends' );
	$form_wrapper = $form.parent();

	//slideup comment form
	$link.closest( '.activity' ).find( 'form.ac-form' ).slideUp();

	if ( $form_wrapper.is( ':visible' ) ) {
		buddyboss_media_tag_friends_close();
		return false;
	}

	$link.closest( '.activity-content' ).after( $form_wrapper );
	$form_wrapper.slideDown( 200 );
	bbmedia_tag_friends_opened = true;

	//setup form data
	$form.find( 'input[name="activity_id"]' ).val( $link.data( 'activity_id' ) );
	var loader_image_url = $form.find( 'input[name="preloader"]' ).val();

	//populate friends list
	var data = {
		'action': $form.find( 'input[name="action"]' ).val(),
		'buddyboss_media_tag_friends_nonce': $form.find( 'input[name="buddyboss_media_tag_friends_nonce"]' ).val(),
		'activity_id': $form.find( 'input[name="activity_id"]' ).val()
	};

	$.ajax( {
		type: "POST",
		url: ajaxurl,
		data: data,
		success: function ( response ) {
			response = $.parseJSON( response );
			$form.find( '#invite-list' ).html( response.friends_list );
			$form.find( '.main-column-content' ).html( response.tagged_friends );

			//bind events
			$( '#invite-list input[name="friends[]"]' ).change( function () {
				buddyboss_media_tag_friends_toggle_tag( data.activity_id, $( this ).val() );
			} );
			$( '#friend-list .action .remove' ).click( function ( e ) {
				e.preventDefault();
				buddyboss_media_tag_friends_toggle_tag( data.activity_id, $( this ).data( 'userid' ) );
			} );
		}
	} );

	return false;
}

function buddyboss_media_tag_friends_close() {
	$form = $( '#frm_buddyboss-media-tag-friends' );
	$form_wrapper = $form.parent();

	$form_wrapper.slideUp( 200 );
	bbmedia_tag_friends_opened = false;

	return false;
}

function buddyboss_media_tag_friends_toggle_tag( activity_id, friend_id ) {
	$form = $( '#frm_buddyboss-media-tag-friends' );

	var data = {
		'action': $form.find( 'input[name="action_tag"]' ).val(),
		'buddyboss_media_tag_friends_nonce': $form.find( 'input[name="buddyboss_media_tag_friends_nonce"]' ).val(),
		'activity_id': activity_id,
		'friend_id': friend_id
	};

	$.ajax( {
		type: "POST",
		url: ajaxurl,
		data: data,
		success: function ( response ) {
			response = $.parseJSON( response );
			$form.find( '#invite-list' ).html( response.friends_list );
			$form.find( '.main-column-content' ).html( response.tagged_friends );

			//bind events
			$( '#invite-list input[name="friends[]"]' ).change( function () {
				buddyboss_media_tag_friends_toggle_tag( data.activity_id, $( this ).val() );
			} );

			$( '#friend-list .action .remove' ).click( function ( e ) {
				e.preventDefault();
				buddyboss_media_tag_friends_toggle_tag( data.activity_id, $( this ).data( 'userid' ) );
			} );
		}
	} );
}

function buddyboss_media_tag_friends_complete() {
	$form = $( '#frm_buddyboss-media-tag-friends' );

	var data = {
		'action': $form.find( 'input[name="action_tag_complete"]' ).val(),
		'buddyboss_media_tag_friends_nonce': $form.find( 'input[name="buddyboss_media_tag_friends_nonce"]' ).val(),
		'activity_id': $form.find( 'input[name="activity_id"]' ).val(),
		'update_action': false
	};

	//can we update activity action(to update tagged people details) ?
	if ( $form.closest( '.activity' ).find( BuddyBoss_Media_Appstate.activity_header_selector ).length > 0 ) {
		data.update_action = true;
	}

	$form.find( 'input[type="submit"]' ).addClass( 'loading' );

	$.ajax( {
		type: "POST",
		url: ajaxurl,
		data: data,
		success: function ( response ) {
			$form.find( 'input[type="submit"]' ).removeClass( 'loading' );
			if ( data.update_action === true ) {
				response = $.parseJSON( response );

				$activity = $form.closest( '.activity' );
				$activity.find( BuddyBoss_Media_Appstate.activity_header_selector ).html( response.activity_action );

				if ( response.activity_tooltip ) {
					$activity.find( '.buddyboss-media-tt-content' ).remove();
					$activity.append( response.activity_tooltip );

					window.BBMediaTooltips.initTooltips();
				}
			}
			buddyboss_media_tag_friends_close();
		}
	} );

	return false;
}
/* ________________________________ */

( function ( window, $ ) {

	var BBMediaTooltips = { };
	var $el = { };

	/**
	 * Init
	 
	 * @return {void}
	 */
	BBMediaTooltips.init = function () {
		BBMediaTooltips.initTooltips();
	}

	/**
	 * Prepare tooltips
	 *
	 * @return {void}
	 */
	BBMediaTooltips.initTooltips = function () {
		// Find tooltips on page
		$el.tooltips = $( '.buddyboss-media-tt-others' );

		// Init tooltips
		if ( $el.tooltips.length ) {
			$el.tooltips.tooltipster( {
				contentAsHTML: true,
				functionInit: BBMediaTooltips.getTooltipContent,
				interactive: true,
				position: 'top-left',
				theme: 'tooltipster-buddyboss'
			} );
		}
	}

	/**
	 * Get tooltip content
	 *
	 * @param  {object} origin  Original tooltip element
	 * @param  {string} content Current tooltip content
	 *
	 * @return {string}         Tooltip content
	 */
	BBMediaTooltips.getTooltipContent = function ( origin, content ) {

		var $content = origin.closest( 'li' ).find( '.buddyboss-media-tt-content' ).detach().html();

		return $content;
	}

	jQuery( document ).ready( function () {
		if ( BuddyBoss_Media_Appstate.enable_tagging == true ) {
			BBMediaTooltips.initTooltips();
			window.BBMediaTooltips = BBMediaTooltips;
		}
	} );

}( window, window.jQuery ) );


/*\
 |*|
 |*|  :: cookies.js ::
 |*|
 |*|  A complete cookies reader/writer framework with full unicode support.
 |*|
 |*|  Revision #1 - September 4, 2014
 |*|
 |*|  https://developer.mozilla.org/en-US/docs/Web/API/document.cookie
 |*|  https://developer.mozilla.org/User:fusionchess
 |*|
 |*|  This framework is released under the GNU Public License, version 3 or later.
 |*|  http://www.gnu.org/licenses/gpl-3.0-standalone.html
 |*|
 |*|  Syntaxes:
 |*|
 |*|  * docCookies.setItem(name, value[, end[, path[, domain[, secure]]]])
 |*|  * docCookies.getItem(name)
 |*|  * docCookies.removeItem(name[, path[, domain]])
 |*|  * docCookies.hasItem(name)
 |*|  * docCookies.keys()
 |*|
 \*/
var docCookies = docCookies || {
	getItem: function ( sKey ) {
		if ( ! sKey ) {
			return null;
		}
		return decodeURIComponent( document.cookie.replace( new RegExp( "(?:(?:^|.*;)\\s*" + encodeURIComponent( sKey ).replace( /[\-\.\+\*]/g, "\\$&" ) + "\\s*\\=\\s*([^;]*).*$)|^.*$" ), "$1" ) ) || null;
	},
	setItem: function ( sKey, sValue, vEnd, sPath, sDomain, bSecure ) {
		if ( ! sKey || /^(?:expires|max\-age|path|domain|secure)$/i.test( sKey ) ) {
			return false;
		}
		var sExpires = "";
		if ( vEnd ) {
			switch ( vEnd.constructor ) {
				case Number:
					sExpires = vEnd === Infinity ? "; expires=Fri, 31 Dec 9999 23:59:59 GMT" : "; max-age=" + vEnd;
					break;
				case String:
					sExpires = "; expires=" + vEnd;
					break;
				case Date:
					sExpires = "; expires=" + vEnd.toUTCString();
					break;
			}
		}
		document.cookie = encodeURIComponent( sKey ) + "=" + encodeURIComponent( sValue ) + sExpires + ( sDomain ? "; domain=" + sDomain : "" ) + ( sPath ? "; path=" + sPath : "" ) + ( bSecure ? "; secure" : "" );
		return true;
	},
	removeItem: function ( sKey, sPath, sDomain ) {
		if ( ! this.hasItem( sKey ) ) {
			return false;
		}
		document.cookie = encodeURIComponent( sKey ) + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT" + ( sDomain ? "; domain=" + sDomain : "" ) + ( sPath ? "; path=" + sPath : "" );
		return true;
	},
	hasItem: function ( sKey ) {
		if ( ! sKey ) {
			return false;
		}
		return ( new RegExp( "(?:^|;\\s*)" + encodeURIComponent( sKey ).replace( /[\-\.\+\*]/g, "\\$&" ) + "\\s*\\=" ) ).test( document.cookie );
	},
	keys: function () {
		var aKeys = document.cookie.replace( /((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g, "" ).split( /\s*(?:\=[^;]*)?;\s*/ );
		for ( var nLen = aKeys.length, nIdx = 0; nIdx < nLen; nIdx ++ ) {
			aKeys[nIdx] = decodeURIComponent( aKeys[nIdx] );
		}
		return aKeys;
	}
};