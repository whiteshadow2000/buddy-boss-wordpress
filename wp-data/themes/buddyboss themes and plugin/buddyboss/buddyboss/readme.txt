/*--------------------------------------------------------------
INSTALLATION
--------------------------------------------------------------*/

= From your WordPress dashboard =

-BuddyPress-

1. Visit 'Plugins > Add New'
2. Search for 'BuddyPress'
3. Activate BuddyPress from your Plugins page

-BuddyBoss Theme-

1. Go to 'Appearance > Themes'
2. Click 'Add New'
3. Upload this theme (as a ZIP file)
4. Upload the included child theme (as a ZIP file)
5. Activate the child theme
6. Customize your website at 'Appearance > Customize'
7. Have fun!

Instructions: http://www.buddyboss.com/tutorials/
Support: http://www.buddyboss.com/support-forums/
Release Notes: http://www.buddyboss.com/release-notes/


/*--------------------------------------------------------------
CHANGELOG
----------------------------------------------------------------
Version 4
----------------------------------------------------------------
4.2.1 - August 17, 2015
4.2.0 - May 6, 2015
4.1.9 - March 25, 2015
4.1.8 - March 14, 2015
4.1.7 - March 9, 2015
4.1.6 - March 1, 2015
4.1.5 - February 18, 2015
4.1.4 - February 17, 2015
4.1.3 - February 11, 2015
4.1.2 - February 2, 2015
4.1.1 - January 24, 2015
4.1.0 - December 31, 2014
4.0.9 - December 24, 2014
4.0.8 - November 15, 2014
4.0.7 - October 9, 2014
4.0.6 - September 23, 2014
4.0.5 - September 18, 2014
4.0.4 - September 5, 2014
4.0.3 - August 26, 2014
4.0.2 - August 20, 2014
4.0.1 - August 18, 2014
4.0.0 - August 14, 2014
----------------------------------------------------------------
Version 3
----------------------------------------------------------------
3.2.4 - August 28, 2014
3.2.3 - August 14, 2014
3.2.2 - August 6, 2014
3.2.1 - July 28, 2014
3.2.0 - June 2, 2014
3.1.9 - May 18, 2014
3.1.8 - May 17, 2014
3.1.7 - April 13, 2014
3.1.6 - March 27, 2014
3.1.5 - March 13, 2014
3.1.4 - February 20, 2014
3.1.3 - February 6, 2014
3.1.2 - February 1, 2014
3.1.1 - January 23, 2014
3.1.0 - January 17, 2014
3.0.7 - December 24,2013
3.0.6 - December 8, 2013
3.0.5 - September 25, 2013
3.0.4 - September 10, 2013
3.0.3 - September 6, 2013
3.0.2 - August 28, 2013
3.0.1 - August 16, 2013
3.0.0 - August 15, 2013
----------------------------------------------------------------
Version 2
----------------------------------------------------------------
2.1.9 - May 13, 2013
2.1.8 - May 1, 2013
2.1.7 - April 8, 2013
2.1.6 - January 15, 2013
2.1.5 - December 11, 2012
2.1.4 - October 22, 2012
2.1.3 - September 27, 2012
2.1.2 - September 11, 2012
2.1.1 - August 25, 2012
2.1.0 - August 14, 2012
2.0.3 - March 14, 2012
2.0.2 - December 30, 2011
2.0.1 - October 5, 2011
2.0.0 - September 27, 2011
----------------------------------------------------------------
Version 1
----------------------------------------------------------------
1.1.4 - July 26, 2011
1.1.3 - July 5, 2011
1.1.2 - June 10, 2011
1.1.1 - June 2, 2011
1.1.0 - May 24, 2011
1.0.9 - May 17, 2011
1.0.8.2 - May 12, 2011
1.0.8.1 - May 11, 2011
1.0.8 - May 9, 2011
1.0.7 - May 6, 2011
1.0.6 - April 29, 2011
1.0.5 - 2011
1.0.4 - 2011
1.0.3 - 2011
1.0.2 - 2011
1.0.1 - 2011
1.0.0 - 2011
--------------------------------------------------------------*/



/*--------------------------------------------------------------
Version 4
--------------------------------------------------------------*/
/*--------------------------------------------------------------
4.2.1 - August 17, 2015
--------------------------------------------------------------*/

FEATURES:

	Added live notifications via Heartbeat API
	Display featured image on single post template
	Added compatibility for our upcoming BuddyBoss Inbox plugin
	Updated French translation files, credits to Jean-Pierre Michaud

BUG FIXES:

	Fixed page refreshing when clicking on panel buttons on mobile
	Fixed notifications layout
	Fixed PHP error with profile widget loader
	Limited activity video widths

CHANGED FILES:

	/buddyboss-inbox/members/single/messages/compose.php (added)
	/buddyboss-inbox/members/single/messages/messages-loop.php (added)
	/buddyboss-inbox/members/single/messages/single.php (added)
	/buddyboss-inc/buddyboss-widgets/buddyboss-profile-widget-loader.php
	/buddyboss-inc/theme-functions.php
	/buddypress/members/single/messages/messages-loop.php
	content.php
	/css/adminbar-mobile.css
	/css/buddypress.css
	/css/plugins.css
	/css/wordpress.css
	/js/buddyboss.js
	/languages/en_US.mo
	/languages/en_US.po
	/languages/fr_FR.mo
	/languages/fr_FR.po
	readme.txt
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 4.0, 4.1, 4.2+
	BuddyPress 2.1, 2.2, 2.3+
	bbPress 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+ 
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.2.0 - May 6, 2015
--------------------------------------------------------------*/

BUG FIXES:

	Fixed Group Members filter and search results
	Fixed space after Search icon in adminbar
	Messages layout compatibility with latest versions of BuddyPress
	Select boxes fixes
	CSS fix for BuddyBoss Media plugin

CHANGED FILES:

	/buddyboss-inc/theme-functions.php
	/buddypress/groups/single/members.php
	/buddypress/members/single/messages/messages-loop.php
	/buddypress/members/single/messages/notices-loop.php (removed)
	/css/adminbar-desktop-fixed.css
	/css/adminbar-desktop-floating.css
	/css/bbpress.css
	/css/buddypress.css
	/css/wordpress.css	
	/js/buddyboss.js
	/languages/en_US.mo
	/languages/en_US.po
	readme.txt
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 4.0, 4.1+
	BuddyPress 2.1, 2.2+
	bbPress 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+ 
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.1.9 - March 25, 2015
--------------------------------------------------------------*/

BUG FIXES:

	Fixed issues with video embed sizing

CHANGED FILES:

	/buddyboss-inc/theme-functions.php
	/js/buddyboss.js
	/js/fitvids.js (added)
	readme.txt
	style.css	

TESTED WITH:

	-- WordPress --
	WordPress 4.0+
	BuddyPress 2.1, 2.2
	bbPress 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+ 
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.1.8 - March 14, 2015
--------------------------------------------------------------*/

FEATURES:

	Admin option to enable/disable Activity infinite scrolling

BUG FIXES:

	Fixed custom member avatar loading from child themes
	Fixed slides getting Undefined Index when used with ACF Field Groups plugin

CHANGED FILES:

	/buddyboss-inc/buddyboss-customizer/buddyboss-customizer-loader.php
	/buddyboss-inc/buddyboss-slides/buddyboss-slides-loader.php
	/buddyboss-inc/theme-functions.php
	/css/plugins.css
	header.php
	/js/buddyboss.js
	readme.txt
	style.css		

TESTED WITH:

	-- WordPress --
	WordPress 4.0+
	BuddyPress 2.1, 2.2
	bbPress 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+ 
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.1.7 - March 9, 2015
--------------------------------------------------------------*/

FEATURES:

	Added Infinite Scroll for activity

CHANGED FILES:

	/buddyboss-inc/theme-functions.php
	/js/buddyboss.js
	readme.txt
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 4.0+
	BuddyPress 2.1, 2.2
	bbPress 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+ 
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.1.6 - March 1, 2015
--------------------------------------------------------------*/

BUG FIXES:

	CSS fixes for Bulk Notifications
	CSS fixes for Message filters
	Mobile CSS fix for BuddyBoss Media plugin

CHANGED FILES:

	/buddyboss-inc/theme-functions.php
	/css/buddypress.css
	/css/plugins.css
	readme.txt
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 4.0+
	BuddyPress 2.1, 2.2
	bbPress 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+ 
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.1.5 - February 18, 2015
--------------------------------------------------------------*/

BUG FIXES:

	Fixed text cutting off in long activity replies

CHANGED FILES:

	/buddyboss-inc/theme-functions.php
	/css/buddypress.css
	readme.txt
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 4.0+
	BuddyPress 2.1, 2.2
	bbPress 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+ 
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.1.4 - February 17, 2015
--------------------------------------------------------------*/

FEATURES:

	Added search to adminbar, for integration with BuddyPress Global Search	

BUG FIXES:

	Improved form styling - email inputs, select elements

CHANGED FILES:

	/buddyboss-inc/buddyboss-customizer/buddyboss-customizer-loader.php
	/buddyboss-inc/theme-functions.php
	/css/adminbar-desktop-fixed.css
	/css/adminbar-desktop-floating.css
	/css/adminbar-mobile.css
	/css/buddypress.css
	/css/plugins.css
	/css/wordpress.css
	/js/buddyboss.js
	readme.txt
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 4.0+
	BuddyPress 2.1, 2.2
	bbPress 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+ 
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.1.3 - February 11, 2015
--------------------------------------------------------------*/

FEATURES:

	Compatibility with BuddyPress 2.2

BUG FIXES:

	Fixed double message label error

CHANGED FILES:

	/buddyboss-inc/theme-functions.php
	/css/buddypress.css
	readme.txt
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 4.0+
	BuddyPress 2.1, 2.2
	bbPress 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+ 
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.1.2 - February 2, 2015
--------------------------------------------------------------*/

FEATURES:

	Updated FontAwesome to 4.3

BUG FIXES:

	Displaying Homepage Slider buttons on mobile layout

CHANGED FILES:

	/buddyboss-inc/buddyboss-slides/buddyboss-slides-loader.php
	/buddyboss-inc/buddyboss-slides/css/buddyboss-slides.css
	/buddyboss-inc/theme-functions.php
	readme.txt
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 4.0+
	BuddyPress 2.1+
	bbPress 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+ 
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.1.1 - January 24, 2015
--------------------------------------------------------------*/

BUG FIXES:

	Fixed off-centered login logo on mobile
	Fixed whitespace when opening panel on mobile, then expanding to desktop layout

CHANGED FILES:

	/buddyboss-inc/theme-functions.php
	/css/adminbar-desktop-fixed.css
	/css/adminbar-desktop-floating.css
	readme.txt
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 4.0+
	BuddyPress 2.1+
	bbPress 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+ 
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.1.0 - December 31, 2014
--------------------------------------------------------------*/

BUG FIXES:

	CSS compatibility with Media plugin "Albums" functionality

CHANGED FILES:

	/buddyboss-inc/theme-functions.php
	/css/plugins.css
	readme.txt
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 4.0+
	BuddyPress 2.1+
	bbPress 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+ 
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.0.9 - December 24, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Fixed plugin conflict with BuddyPress Activity Privacy
	Better styling on Photos template "What's New Form"
	CSS compatibility with upcoming Media plugin updates

CHANGED FILES:

	/buddyboss-inc/theme-functions.php
	/css/buddypress.css
	/css/plugins.css
	/css/wordpress.css
	/languages/en_US.mo
	/languages/en_US.po
	readme.txt
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 4.0+
	BuddyPress 2.1+
	bbPress 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+ 
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.0.8 - November 15, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Fixed WordPress video uploads not playing (FitVids conflict)
	Fixed hidden items in Toolbar when using certain plugins

CHANGED FILES:

	/buddyboss-inc/theme-functions.php
	/css/adminbar-desktop-fixed.css
	/js/buddyboss.js
	readme.txt
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8, 3.9, 4.0
	BuddyPress 1.9, 2.0, 2.1
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+ 
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.0.7 - October 9, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Fixed front-page blog posts having no pagination

CHANGED FILES:

	front-page.php
	readme.txt
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8, 3.9, 4.0
	BuddyPress 1.9, 2.0, 2.1
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+ 
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.0.6 - September 23, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Fixed 'BuddyBoss Slides' JavaScript conflict with BuddyPress 2.1
	Updated to FWSlider v2.0

CHANGED FILES:

	/buddyboss-inc/buddyboss-slides/buddyboss-slides-loader.php
	/buddyboss-inc/buddyboss-slides/css/buddyboss-slides.css
	/buddyboss-inc/buddyboss-slides/js/fwslider.js
	/buddyboss-inc/buddyboss-slides/js/fwslider.min.js
	/buddyboss-inc/buddyboss-slides/js/imagesloaded.js (new, for reference)
	/buddyboss-inc/buddyboss-slides/js/jquery.easing.js (new, for reference)
	content-slides.php
	/languages/en_US.mo
	/languages/en_US.po
	/languages/xx_XX.pot
	readme.txt
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8, 3.9, 4.0
	BuddyPress 1.9, 2.0, 2.1
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+ 
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.0.5 - September 18, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Fixed white text on active "Create Group" step
	Now only loading JavaScript and CSS for Slides post type if there are slides
	Customizer font fixes
	Small CSS fixes

CHANGED FILES:

	/buddyboss-inc/buddyboss-customizer/buddyboss-customizer-loader.php
	/buddyboss-inc/buddyboss-customizer/js/buddyboss-customizer.js
	/buddyboss-inc/buddyboss-slides/buddyboss-slides-loader.php
	/buddyboss-inc/theme-functions.php
	/css/buddypress.css
	readme.txt
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8, 3.9, 4.0
	BuddyPress 1.9, 2.0, 2.1
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+ 
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.0.4 - September 5, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Updated FontAwesome to version 4.2
	Updated Photos and Sites icons in mobile layout
	Fixed "body" custom font loading in mobile layout
	Better CSS for "Create Group" progress links
	Removed unused templates
	Removed unused functions

CHANGED FILES:

	/buddyboss-inc/buddyboss-customizer/buddyboss-customizer-loader.php
	/buddyboss-inc/buddyboss-customizer/js/buddyboss-customizer.js
	/buddyboss-inc/theme-functions.php
	/css/adminbar-mobile.css
	/css/buddypress.css
	/css/wordpress.css
	/languages/en_US.mo
	/languages/en_US.po
	/languages/xx_XX.pot
	page-sidebar-right.php (removed)
	readme.txt
	sidebar-front.php (removed)
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8, 3.9, 4.0
	BuddyPress 1.9, 2.0, 2.1 beta
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+ 
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.0.3 - August 26, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Correct deregister of buddypress.css in BuddyPress 2.1 beta
	Hide non-functional "edit" link in BuddyPress 2.1 beta
	Updated jQuery enqueue to load from WordPress, if using WP 3.9+
	Fixed jQuery loading over HTTPS for ports other than 443
	Updated CSS for mobile pagination
	Updated CSS for profiles with widgets
	Fixed "Groups > Directory" widget displaying on User groups tab

CHANGED FILES:

	/buddyboss-inc/theme-functions.php
	buddypress.php
	/css/buddypress.css
	/css/wordpress.css
	/languages/en_US.mo
	/languages/en_US.po
	/languages/xx_XX.pot
	readme.txt
	sidebar-buddypress.php
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8, 3.9+
	BuddyPress 1.9, 2.0, 2.1 beta
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.0.2 - August 20, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Internet Explorer 9 compatibility fix
	Fixed responsive embedded video heights
	Fixed "Profile Login Widget" cookie issue
	Fixed Font loading over HTTPS for ports other than 443
	Updated Group membership request CSS

CHANGED FILES:

	/buddyboss-inc/buddyboss-widgets/buddyboss-profile-widget-loader.php
	/buddyboss-inc/theme-functions.php
	/css/buddypress.css
	header.php
	/js/buddyboss.js
	readme.txt
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8, 3.9+
	BuddyPress 1.9, 2.0+
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.0.1 - August 18, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Logo URL outputs as a relative path now
	Fixed JavaScript conflict with WooCommerce checkout dropdowns
	CSS updates in preparation for next BuddyBoss Wall update

CHANGED FILES:

	/buddyboss-inc/buddyboss-customizer/buddyboss-customizer-loader.php
	/buddyboss-inc/theme-functions.php
	/css/buddypress.css
	/js/buddyboss.js
	/languages/en_US.mo
	/languages/en_US.po
	/languages/xx_XX.pot
	readme.txt
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8, 3.9+
	BuddyPress 1.9, 2.0+
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
4.0.0 - August 14, 2014
--------------------------------------------------------------*/

NEW FEATURES:

	Removed Wall functionality, extracted to plugin
	Removed Photos functionality, extracted to plugin
	Compatibility with rtMedia plugin
	Huge code optimization

BUG FIXES:

	No longer overriding buddypress.js
	Updated "Load Newest" styles
	Fixed PHP errors
	Code cleanup

CHANGED FILES:

	_changelog.txt (removed)
	_license.txt (removed)
	_readme.txt (removed)
	/buddyboss-inc/admin.php
	/buddyboss-inc/buddyboss-bp-legacy/bp-legacy-loader.php
	/buddyboss-inc/buddyboss-customizer/buddyboss-customizer-loader.php
	/buddyboss-inc/buddyboss-pics/* (removed)
	/buddyboss-inc/buddyboss-wall/* (removed)
	/buddyboss-inc/buddyboss-widgets/buddyboss-profile-widget-loader.php
	/buddyboss-inc/debug.php
	/buddyboss-inc/image-rotation-fixer.php (removed)
	/buddyboss-inc/init.php
	/buddyboss-inc/theme-functions.php
	/buddyboss-inc/wp-updates-theme.php
	/buddypress/activity/entry-default.php (removed)
	/buddypress/activity/entry-wall.php (removed)
	/buddypress/activity/entry.php (removed)
	/buddypress/activity/index.php
	/buddypress/activity/post-form.php (removed)
	/buddypress/members/single/activity.php (removed)
	/buddypress/members/single/messages/messages-loop.php
	/buddypress/members/single/pictures.php (removed)
	comments.php
	content-buddypress.php
	/css/adminbar-desktop-fixed.css
	/css/adminbar-desktop-floating.css
	/css/adminbar-mobile.css
	/css/buddypress.css
	/css/plugins.css
	/css/wordpress.css
	header.php
	/js/buddyboss.js
	/js/buddypress.js (removed)
	/js/mobile-main.js (removed)
	/languages/de_DE.mo
	/languages/de_DE.po
	/languages/en_US.mo
	/languages/en_US.po
	/languages/fr_FR.mo
	/languages/fr_FR.po
	/languages/nl_NL.mo
	/languages/nl_NL.po
	/languages/ru_RU.mo
	/languages/ru_RU.po
	/languages/sv_SE.mo
	/languages/sv_SE.po
	/languages/xx_XX.pot
	license.txt (new)
	readme.txt (new)
	screenshot.png
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8, 3.9+
	BuddyPress 1.9, 2.0+
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
Version 3
--------------------------------------------------------------*/
/*--------------------------------------------------------------
3.2.4 - August 28, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Correct deregister of buddypress.css in BuddyPress 2.1 beta
	Hide non-functional "edit" link in BuddyPress 2.1 beta
	Updated jQuery enqueue to load from WordPress, if using WP 3.9+
	Fixed jQuery loading over HTTPS for ports other than 443
	Fixed FontAwesome loading over HTTPS for ports other than 443
	Fixed Google fonts loading over HTTPS for ports other than 443

CHANGED FILES:

	_changelog.txt
	/buddyboss-inc/theme-functions.php
	/css/buddypress.css
	style.css	

TESTED WITH:

	-- WordPress --
	WordPress 3.8, 3.9+
	BuddyPress 1.9, 2.0, 2.1 beta
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+
	
/*--------------------------------------------------------------
3.2.3 - August 14, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Added admin helper notices for updating to BuddyBoss 4.0.0
	CSS fix for Friend invites
	CSS fix for Group membership requests

CHANGED FILES:

	_changelog.txt
	/buddyboss-inc/theme-functions.php
	/css/buddypress.css
	/languages/en_US.mo
	/languages/en_US.po
	/languages/xx_XX.pot
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8, 3.9+
	BuddyPress 1.9, 2.0+
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
3.2.2 - August 6, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Fixed Add Photo button positioning
	Fixed photo uploading error when "PHP Exif" is disabled on server
	Resolved "bp_is_page" error on activity updates

CHANGED FILES:

	_changelog.txt
	/buddyboss-inc/buddyboss-pics/buddyboss-pics-loader.php
	/buddyboss-inc/buddyboss-pics/css/buddyboss-pics.css
	/buddyboss-inc/image-rotation-fixer.php
	/buddypress/activity/post-form.php
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8, 3.9+
	BuddyPress 1.9, 2.0+
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
3.2.1 - July 28, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Fixed inconsistent photo display sizes
	Fixed issue with select filters when making window small then big again
	Fixed PHP error in theme customizer
	Updated FontAwesome to newest version (4.1.0)
	Updated German translations

CHANGED FILES:

	_changelog.txt
	/buddyboss-inc/buddyboss-customizer/buddyboss-customizer-loader.php	
	/buddyboss-inc/buddyboss-pics/buddyboss-pics-loader.php
	/buddyboss-inc/theme-functions.php
	/js/mobile-main.js
	/languages/de_DE.mo
	/languages/de_DE.po
	/languages/en_US.mo
	/languages/en_US.po
	/languages/xx_XX.pot
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8, 3.9+
	BuddyPress 1.9, 2.0+
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+
	
/*--------------------------------------------------------------
3.2.0 - June 2, 2014
--------------------------------------------------------------*/

BUG FIXES:

	The first time you like an activity the My Likes tab now increments incorrectly
	Responsive drop down fix for WooCommerce
	Removed outdated hard-coded table prefix for bp_groups
	Fixed several PHP errors and notices

CHANGED FILES:

	_changelog.txt
	/buddyboss-inc/buddyboss-pics/buddyboss-pics-loader.php
	/buddyboss-inc/theme-functions.php
	/js/buddypress.js/
	/js/mobile-main.js/
	/languages/en_US.mo
	/languages/en_US.po
	/languages/fr_FR.mo
	/languages/fr_FR.po
	/languages/xx_XX.pot
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8, 3.9+
	BuddyPress 1.9, 2.0+
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
3.1.9 - May 18, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Fixed issues with photo uploading in iOS
	Fixed mobile upload progress layout

CHANGED FILES:

	_changelog.txt
	/buddyboss-inc/buddyboss-pics/buddyboss-pics-loader.php
	/buddyboss-inc/buddyboss-pics/css/buddyboss-pics.css
	/buddyboss-inc/theme-functions.php
	/js/buddypress.js
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8, 3.9+
	BuddyPress 1.9, 2.0+
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
3.1.8 - May 17, 2014
--------------------------------------------------------------*/

NEW FEATURES:

	Added support for Heartbeat AKA "Load Newest" functionality from BuddyPress 2.0

CHANGES:

	Added extra filters to BuddyBoss Wall for developers
	Improved layout for BP Profile Search plugin
	Merged JavaScript files for faster initial page load
	Updated Comments template

BUG FIXES:

	Fixed "Create a Group" button on Groups directory
	Fixed mobile issues in default Android browser
	Fixed hidden items in admin bar when using some plugins
	Fixed Wall translation for plural names, for translating certain languages
	Fixed issue with input labels showing on mobile
	Fixed private group photos displaying with all other user photos
	Fixed homepage slider being dependant on BuddyPress activation
	Fixed issues with BuddyPress Activity Privacy plugin
	Fixed layout of Group Members template
	Removed testcookie in BuddyBoss profile widget
	Improved layout of table data


CREDITS:

	Thanks to Ivan Dyakov for translating BuddyBoss to Russian
	Thanks to Julien Gardaix for translating BuddyBoss to French (www.jechomepas.com)

CHANGED FILES:

	_changelog.txt
	/buddyboss-inc/buddyboss-pics/assets/ (removed)
	/buddyboss-inc/buddyboss-pics/buddyboss-pics-loader.php
	/buddyboss-inc/buddyboss-pics/js/moxie.js
	/buddyboss-inc/buddyboss-pics/js/Moxie.swf
	/buddyboss-inc/buddyboss-pics/js/Moxie.xap
	/buddyboss-inc/buddyboss-pics/js/plupload.dev.js
	/buddyboss-inc/buddyboss-pics/js/plupload.full.min.js
	/buddyboss-inc/buddyboss-slides/buddyboss-slides-loader.php
	/buddyboss-inc/buddyboss-wall/buddyboss-wall-loader.php
	/buddyboss-inc/buddyboss-wall/js/buddyboss-wall.js
	/buddyboss-inc/buddyboss-widgets/buddyboss-profile-widget-loader.php
	/buddyboss-inc/theme-functions.php
	comments.php
	content-buddypress.php
	/css/adminbar-desktop-fixed.css
	/css/adminbar-desktop-floating.css
	/css/adminbar-mobile.css
	/css/buddypress.css
	/css/plugins.css
	/css/wordpress.css
	header.php
	/js/buddyboss.js
	/js/buddypress.js
	/js/html5.js (removed)
	/js/jquery.fitvids.js (removed)
	/js/jquery.touchSwipe.min.js (removed)
	/js/mobile-main.js
	/js/respond.min.js (removed)
	/languages/de_DE.mo
	/languages/de_DE.po
	/languages/en_US.mo
	/languages/en_US.po
	/languages/fr_FR.mo (new)
	/languages/fr_FR.po (new)
	/languages/ru_RU.mo (new)
	/languages/ru_RU.po (new)
	/languages/sv_SE.mo
	/languages/sv_SE.po
	/languages/xx_XX.pot
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8, 3.9+
	BuddyPress 1.9, 2.0+
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+
	Windows Phone

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
3.1.7 - April 13, 2014
--------------------------------------------------------------*/

NEW FEATURES:
	
	Buttery smooth mobile experience

CHANGES:

	Huge code cleanup
	Improved documentation
	Moved left panel "Log Out" link down to Settings, to prevent accidental logout
	Added German translation files

BUG FIXES:

	Fixed a ton of issues on mobile devices
	Better compatibility with iOS, Android, Windows Phone
	Fixed ajax loader so it's more visible on buttons
	Improved mobile compatibility with "wp-Monalisa" plugin
	
CREDITS:

	Thanks to Stefan Noll for translating BuddyBoss to German (http://kenndich.de)

CHANGED FILES:

	_changelog.txt
	/buddyboss-inc/buddyboss-customizer/buddyboss-customizer-loader.php
	/buddyboss-inc/buddyboss-customizer/js/buddyboss-customizer.js
	/buddyboss-inc/buddyboss-pics/buddyboss-pics-loader.php
	/buddyboss-inc/buddyboss-pics/css/buddyboss-pics.css
	/buddyboss-inc/buddyboss-slides/buddyboss-slides-loader.php
	/buddyboss-inc/buddyboss-slides/css/buddyboss-slides.css
	/buddyboss-inc/buddyboss-wall/buddyboss-wall-loader.php
	/buddyboss-inc/theme-functions.php
	/buddypress/activity/post-form.php
	/css/adminbar-desktop-fixed.css
	/css/adminbar-desktop-floating.css
	/css/adminbar-mobile.css
	/css/buddypress.css
	/css/plugins.css
	/css/wordpress.css
	header.php
	/js/buddyboss.js
	/js/buddypress.js
	/js/mobile-main.js
	/js/modernizr.min.js
	/languages/de_DE.mo (new)
	/languages/de_DE.po (new)
	/languages/en_US.mo
	/languages/en_US.po
	/languages/xx_XX.pot
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8.2
	BuddyPress 1.7, 1.8, 1.9, 2.0 beta
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
3.1.6 - March 27, 2014
--------------------------------------------------------------*/

BUG FIXES:

	When adminbar is disabled, top margin goes away now
	Fixed CSS font flicker on Activity page
	Fixed double avatar bug in activity posts
	Fixed Sitewide Notices displaying in footer

CHANGED FILES:

	_changelog.txt
	/buddyboss-inc/theme-functions.php
	/css/adminbar-desktop-fixed.css
	/js/jquery.fitvids.js
	/languages/en_US.mo
	/languages/en_US.po
	/languages/xx_XX.pot
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8.1
	BuddyPress 1.7, 1.8, 1.9+
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
3.1.5 - March 13, 2014
--------------------------------------------------------------*/

NEW FEATURES:

	Automatic theme updates via WordPress admin for future releases
	Slides now have a checkbox to "Open link in a new window/tab"
	Added .POT file for easier language translations

CHANGES:

	Updated English language translation files
	Updated Dutch language translation files
	Updated Swedish language translation files
	Updated jQuery version to 1.11.0
	Now loading jQuery from external Google CDN
	Better code commenting throughout

BUG FIXES:

	Fixed "CSS flicker" on Google Chrome browser
	Fixed FontAwesome on mobile devices when using fa-[icon]
	Fixed most PHP errors that displayed with WP_DEBUG enabled
	Fixed mobile slide drawer overlap
	Fixed layout of Blogs directory (Site Tracking) navigation
	Fixed "Add Photo" input not displaying on Photos template
	Fixed custom profile menu displaying twice on Photos template
	Fixed BP Activity Privacy bug on Photos template when selecting "My Friends"
	Fixed height of BuddyPress directory search buttons in Firefox
	Added condition for HTTPS loading for all external assets
	Better CSS support for Social Articles plugin
	Better CSS support for Invite Anyone plugin

CHANGED FILES:

	_changelog.txt
	/buddyboss-inc/admin.php
	/buddyboss-inc/buddyboss-customizer/buddyboss-customizer-loader.php
	/buddyboss-inc/buddyboss-pics/buddyboss-pics-loader.php
	/buddyboss-inc/buddyboss-slides/buddyboss-slides-loader.php
	/buddyboss-inc/buddyboss-wall/buddyboss-wall-loader.php
	/buddyboss-inc/buddyboss-widgets/buddyboss-profile-widget-loader.php
	/buddyboss-inc/debug.php
	/buddyboss-inc/init.php
	/buddyboss-inc/theme-functions.php
	/buddyboss-inc/wp-updates-theme.php (new)
	/buddypress/activity/index.php
	/buddypress/activity/post-form.php
	/buddypress/blogs/index.php
	/buddypress/members/single/pictures.php
	content-slides.php
	/css/buddypress.css
	/css/plugins.css
	/css/wordpress.css
	header.php
	/js/jquery.1.10.2.min.js (removed)
	/languages/en_US.mo
	/languages/en_US.po
	/languages/nl_NL.mo
	/languages/nl_NL.po
	/languages/sv_SE.mo
	/languages/sv_SE.po
	/languages/xx_XX.pot (new)
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8.1
	BuddyPress 1.7, 1.8, 1.9+
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
3.1.4 - February 20, 2014
--------------------------------------------------------------*/

NEW FEATURES:

	Activity "Likes" now show who liked the post with a link to the user's profile
	Enabled threaded replies in bbPress forums
	Added Swedish language translations

BUG FIXES:

	Fixed double content posting when clicking "Load More" with certain activity posts
	Fixed z-index conflict between dropdowns and "Add Photo" button in Firefox and Safari
	Removed files that are no longer in use

CREDITS:

	Thanks to Anton Andreasson for translating BuddyBoss to Swedish

CHANGED FILES:

	_changelog.txt
	/buddyboss-inc/buddyboss-pics/buddyboss-pics-loader.php
	/buddyboss-inc/buddyboss-pics/buddyboss-pics-notifications.php (removed)
	/buddyboss-inc/buddyboss-pics/css/buddyboss-pics.css
	/buddyboss-inc/buddyboss-wall/buddyboss-wall-loader.php
	/buddyboss-inc/buddyboss-wall/buddyboss-wall-notifications.php (removed)
	/buddyboss-inc/buddyboss-wall/css/buddyboss-wall.css (new)
	/buddyboss-inc/buddyboss-wall/js/buddyboss-wall.js (new)
	/buddyboss-inc/buddyboss-wall/js/jquery.tooltipster.js (new)
	/buddyboss-inc/buddyboss-wall/js/jquery.tooltipster.min.js (new)
	/buddyboss-inc/theme-functions.php
	/css/bbpress.css
	/js/buddypress.js
	/js/mobile-main.js
	/languages/en_US.mo
	/languages/en_US.po
	/languages/sv_SE.mo (new)
	/languages/sv_SE.po (new)
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8.1
	BuddyPress 1.7, 1.8, 1.9+
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
3.1.3 - February 6, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Fixed post form not displaying on Activity index with BuddyPress 1.9.2
	Fixed "Posted in:" displaying as "Show:" on Activity index
	Fixed "Write something to [username]" text when posting to another user's Wall
	Fixed Register/Login dropping to the next line when logged out with a Logo uploaded
	Updated Dutch translation files, credits to Mark Stellingwerff

CHANGED FILES:

	_changelog.txt
	/buddyboss-inc/theme-functions.php
	/buddypress/activity/post-form.php
	/css/wordpress.css
	/js/mobile-main.js
	/languages/en_US.mo
	/languages/en_US.po
	/languages/nl_NL.mo
	/languages/nl_NL.po
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8.1
	BuddyPress 1.7, 1.8, 1.9+
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+


/*--------------------------------------------------------------
3.1.2 - February 1, 2014
--------------------------------------------------------------*/

NEW FEATURES:

	Added Dutch language translations

ANDROID FIXES:

	Fixed issue with slider drawers overlapping content in Android
	Fixed issue with rounded profile avatars looking odd on in Android
	Fixed FontAwesome icon fonts not displaying in older versions of Android
	Fixed minor Android CSS issues

BUG FIXES:

	Fixed error with user title on "legacy" BuddyPress plugins displaying raw HTML
	Fixed error with viewing "Users" admin panel while BuddyPress is deactivated
	Fixed translation for PERSONAL_TAB_NAME on Wall posts
	Removed unused JavaScript
	Cleaned up some minor bugs and comment errors

CREDITS:

	Thanks to Mark Stellingwerff for translating BuddyBoss to Dutch

CHANGED FILES:

	_changelog.txt
	/buddyboss-inc/buddyboss-bp-legacy/bp-legacy-loader.php
	/buddyboss-inc/buddyboss-pics/buddyboss-pics-loader.php
	/buddyboss-inc/buddyboss-pics/css/buddyboss-pics.css
	/buddyboss-inc/buddyboss-slides/buddyboss-slides-loader.php
	/buddyboss-inc/buddyboss-slides/css/buddyboss-slides.css
	/buddyboss-inc/buddyboss-wall/buddyboss-wall-loader.php
	/buddyboss-inc/theme-functions.php
	/css/adminbar-mobile.css
	/css/bbpress.css
	/css/buddypress.css
	/css/wordpress.css
	editor-style.css
	/js/html5shiv.js (removed)
	/js/mobile-main.js
	/js/navigation.js (removed)
	/languages/en_US.mo
	/languages/en_US.po
	/languages/nl_NL.mo (new)
	/languages/nl_NL.po (new)
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8.1
	BuddyPress 1.7, 1.8, 1.9+
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
3.1.1 - January 23, 2014
--------------------------------------------------------------*/

NEW FEATURES:

	Brought back the "Floating" Toolbar option, now located at "Appearance > Customize"

BUG FIXES:

	Custom colors applied to Toolbar now cascade into the Toolbar drop downs
	Fixed PHP error with getimagesize on login screen
	Fixed PHP error with "Email Address" field in "Social Media Links" options
	Moved profile and group custom menus out of templates into functions
	Added translation for "My Favorites" on activity index
	Improved styling of blog post meta data (date, author, reply count)
	Fix for sub-navigation items on Android
	Minor CSS display fixes
	Added Theme Customizer support for the Fixed Navbar child theme

CHANGED FILES:

	_changelog.txt
	/buddyboss-inc/buddyboss-customizer/buddyboss-customizer-loader.php
	/buddyboss-inc/buddyboss-customizer/js/buddyboss-customizer.js
	/buddyboss-inc/buddyboss-pics/buddyboss-pics-loader.php
	/buddyboss-inc/buddyboss-pics/css/buddyboss-pics.css
	/buddyboss-inc/buddyboss-slides/buddyboss-slides-loader.php
	/buddyboss-inc/buddyboss-slides/css/buddyboss-slides.css
	/buddyboss-inc/theme-functions.php
	/buddypress/activity/activity-loop.php (removed)
	/buddypress/activity/entry.php
	/buddypress/activity/index.php
	/buddypress/groups/single/home.php (removed)
	/buddypress/members/single/home.php (removed)
	content.php
	/css/adminbar-desktop-fixed.css (new)
	/css/adminbar-desktop-floating.css (new)
	/css/adminbar-desktop.css (removed)
	/css/bbpress.css
	/css/buddypress.css
	/css/wordpress.css
	editor-style.css
	footer.php
	header.php
	/languages/en_US.po
	/languages/en_US.mo
	style.css

TESTED WITH:

	-- WordPress --
	WordPress 3.8
	BuddyPress 1.7, 1.8, 1.9+
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
3.1.0 - January 17, 2014
--------------------------------------------------------------*/

NEW FEATURES:

	Flatter, cleaner design
	Admin options to change colors and fonts
	Homepage slider
	All images switched to retina font icons
	Major code cleanup

BUG FIXES:

	All language strings are now translatable
	Touch-to-swipe photos now work correctly on all Activity tabs
	Fixed PHP errors and deprecated functions
	Fixed issue with double scroll bar on desktop
	Fixed ajax-loader issues
	Faster load time for BuddyPress content
	Improved legacy plugin handling, removed opacity hack
	Fixed the split second header "jump" on mobile devices
	Better performance on mobile Safari
	Better commenting throughout
	Admin data inputs are sanitized for better security
	Properly enqueued buddypress.js
	More intuitive folder structure in /buddyboss-inc/
	Many other random bug fixes

CHANGED FILES:

	404.php
	_changelog.txt
	/bbpress/form-search.php
	/bbpress/loop-single-reply.php
	/bbpress/loop-single-topic.php
	/buddyboss-inc/* (all files changed)
	/buddypress/* (all files changed)
	buddypress.php
	content-buddypress.php
	content-slides.php (new)
	content.php
	/css/adminbar-desktop.css (new)
	/css/adminbar-fixed.css (removed)
	/css/adminbar-floating.css (removed)
	/css/adminbar-mobile.css
	/css/bbpress.css
	/css/buddypress.css
	/css/ie.css (removed)
	/css/plugins.css
	/css/wordpress.css
	editor-style.css
	footer.php
	front-page.php
	header.php
	/images/* (all files changed)
	/js/buddyboss.js
	/js/buddypress.js
	/js/css3-mediaqueries.js (removed)
	/js/mobile-main.js
	/languages/en_US.mo
	/languages/en_US.po
	screenshot.png
	sidebar-buddypress.php
	sidebar.php
	style.css

MINIMUM REQUIREMENTS:

	Requires WordPress 3.8
	Dropped support for IE 8 (as did Google)

TESTED WITH:

	-- WordPress --
	WordPress 3.8
	BuddyPress 1.7, 1.8, 1.9+
	bbPress 2.4, 2.5+

	-- Mobile --
	iOS 6, 7
	Android 4.1+

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

CREDITS: 

	-- Gabriel Merovingi of myCRED.me --
	Fixed PHP errors and deprecated functions
	Created BuddyBoss compatible myCRED addon

/*--------------------------------------------------------------
3.0.7 - December 24, 2013
--------------------------------------------------------------*/

FIXES:

	Plugin "BuddyPress Activity Privacy" now works with Photos component
	Fixed Favorites slide up issue
	Fixed Bulk Select/Delete Messages issue
	Fixed bbpress.css loading twice issue
	Added version numbers to JS and CSS enqueue, to clear browser cache on theme updates
	BuddyBoss Admin updated to match WordPress 3.8
	Better organized Change Log

CHANGED FILES:

	_changelog.txt (new)
	_readme.txt
	/buddyboss-inc/admin.php
	/buddyboss-inc/buddyboss-pics/buddyboss-pics-loader.php
	/buddyboss-inc/theme.php
	/js/buddypress.js
	style.css (changed version number)

TESTED WITH:

	-- WordPress --
	WordPress 3.7, 3.8
	BuddyPress 1.7, 1.8, 1.9
	bbPress 2.4, 2.5

	-- Mobile --
	iOS 6, 7
	Android 4.1+

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 8+

/*--------------------------------------------------------------
3.0.6 - December 8, 2013
--------------------------------------------------------------*/

FIXES:

	Fixed page scrolling issues in iOS
	Fixed respond.js loading incorrectly in theme.php
	Fixed Notifications template loading for upcoming BuddyPress 1.9
	Added GNU Public license

CHANGED FILES:

	_licence.txt
	_readme.txt
	/buddyboss-inc/buddyboss-wall/buddyboss-wall-loader.php
	/buddyboss-inc/theme.php
	/buddypress/members/single/home.php
	/js/buddyboss.js
	/js/mobile-main.js
	style.css (changed version number)

TESTED WITH:

	-- WordPress --
	WordPress 3.7.1
	BuddyPress 1.7, 1.8, 1.9 beta
	bbPress 2.4+

	-- Mobile --
	iOS 6, 7
	Android 4.1+

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 8+

/*--------------------------------------------------------------
3.0.5 - September 25, 2013
--------------------------------------------------------------*/

FEATURES:

	Fixed a bug with Avatar photo uploading not working while BuddyBoss Photo Uploading was disabled
	Fixed a bug with jQuery Migrate loading before jQuery while Photo Uploading was disabled
	Fixed a bug where "un-liking" a post in the main Activity index would cause the page to go blank
	Fixed a bug where clicking navigation menus would cause temporary double scrollbars with BuddyPress disabled

PLUGIN FIXES:

	With both BuddyDrive and WP Project Manager FrontEnd both activated, the BuddyDrive tab in profiles now displays
	The profile Photos tab now displays all photos while BuddyPress Activity Privacy is activated
	
CHANGED FILES:

	_readme.txt
	/buddyboss-inc/buddyboss-pics/buddyboss-pics-loader.php
	/buddyboss-inc/init.php
	/buddyboss-inc/theme-customizer.php (added)
	/buddyboss-inc/theme.php
	/css/buddypress.css
	/js/buddyboss.js
	/js/mobile-main.js
	style.css (changed version number)

TESTED WITH:

	-- WordPress --
	WordPress 3.6.1
	BuddyPress 1.7 and 1.8+
	bbPress 2.4+

	-- Mobile --
	iOS 6, 7
	Android 4.1+

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 8+

/*--------------------------------------------------------------
3.0.4 - September 10, 2013
--------------------------------------------------------------*/

FEATURES:

	Fixed layout issues in Internet Explorer 8/9
	Fixed "call_user_func_array()" error in photo uploader on some servers
	Reverted Youtube videos to full width scaling even on desktop

CHANGED FILES:

	_readme.txt
	/buddyboss-inc/buddyboss-pics/buddyboss-pics-loader.php
	/buddyboss-inc/theme.php
	/css/ie.css
	/js/buddypress.js
	/js/mobile-main.js
	style.css (changed version number)

TESTED WITH:

	-- WordPress --
	WordPress 3.6
	BuddyPress 1.7 and 1.8+
	bbPress 2.4+

	-- Mobile --
	iOS 6+
	Android 4.1+

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 8+

/*--------------------------------------------------------------
3.0.3 - September 6, 2013
--------------------------------------------------------------*/

FEATURES:

	Fixed photo uploading in Internet Explorer (make sure to update header.php)
	Embedded videos now show at native dimensions in pages and posts
	Added a "Log Out" button to the (BuddyBoss) Profile Login Widget
	Adjusted Photos page layout to allow for many profile links
	In mobile layout, moved the bbPress avatar above the content in replies
	Made the activity filters right aligned, an issue introduced in 3.0.2
	Added a gray background to buttons during AJAX loading
	Added a translation for the word "Like" on Wall entry pages
	Fixed an issue with groups showing the Profile custom menu
	Fixed an issue with logo on login screen not loading with SSL certificates (https URLs)
	On the Activity Stream in mobile layout, the filter now shows correct text
	The Multi-Select List in Profile Fields now shows correctly
	Fixed issue with bbPress visual editor not loading via custom function

PLUGIN FIXES:

	Fixed top padding issue with MP6
	Fixed admin menus issues with MP6
	Fixed mobile scrolling for BP Activity Autoloader
	Fixed mobile layout breaking with BuddyStream Premium

CHANGED FILES:

	_readme.txt
	/buddyboss-inc/admin.php
	/buddyboss-inc/buddyboss-pics/assets/buddyboss-pics.css
	/buddyboss-inc/buddyboss-widgets/buddyboss-profile-widget-loader.php
	/buddyboss-inc/theme.php
	/buddypress/activity/entry-wall.php
	/buddypress/groups/single/home.php
	/css/bbpress.css
	/css/buddypress.css
	/css/wordpress.css
	header.php
	/js/buddypress.js
	/js/mobile-main.js
	/languages/en_US.mo
	/languages/en_US.po
	style.css (changed version number)

TESTED WITH:

	-- WordPress --
	WordPress 3.6
	BuddyPress 1.7 and 1.8+
	bbPress 2.4+

	-- Mobile --
	iOS 6+
	Android 4.1+

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
3.0.2 - August 28, 2013
--------------------------------------------------------------*/

FEATURES:

	Fixed photo upload bug in Internet Explorer 9/10
	Improved activity posting speed from 8-10 sec to 1-2 sec
	Fixed issue with mobile photo uploads getting rotated
	Fixed issue with "Add Friend" button causing problems
	bbpress.css no longer loads twice
	Add "Add Photo" to language file
	Improved styling for mobile photo upload text
	Better documentation in style.css for both parent and child theme
	Created a new stylesheet just for plugin support at /css/plugins.css
	Fixed group text indentation issue
	Widgets with member avatars now contain them correctly
	Increased the font size of mobile textareas
	Removed /css/custom.css from parent theme, as it is overriden by child theme's /css/custom.css and caused confusion
	Removed the deregister function for parent /css/custom.css from child theme
	Removed the /buddypress/registration/ folder as BuddyPress 1.8 no longer uses it

PLUGIN FIXES:

	Added backwards compatibility for most "legacy" BuddyPress plugins (pre BuddyPress 1.7)
	Added support for BP Activity Plus
	Added support for BP Checkins
	Added support for BP Multi Network
	Added support for BuddyDev BP Gallery (not perfect)
	Added support for BuddyDrive
	Added support for BuddyPress Album
	Added support for BuddyPress Follow
	Added support for BuddyPress Links
	Added support for BuddyPress Security Check
	Added support for Cincopa
	Added support for GD bbPress Tools
	Added support for GD bbPress Attachments
	Added support for Geo My WordPress
	Added support for Invite Anyone
	Added support for SI CAPTCHA Anti-Spam
	Added support for Simple Chat
	Added support for Social Articles

CHANGED FILES (PARENT THEME):

	_readme.txt
	/buddyboss-inc/bp-legacy.php (added)
	/buddyboss-inc/buddyboss-bp-legacy/ (added)
	/buddyboss-inc/buddyboss-bp-legacy/item-header.php (added)
	/buddyboss-inc/buddyboss-bp-legacy/page-title.php (added)
	/buddyboss-inc/buddyboss-pics/assets/buddyboss-pics.css
	/buddyboss-inc/buddyboss-pics/buddyboss-pics-loader.php
	/buddyboss-inc/debug.php
	/buddyboss-inc/image-rotation-fixer.php
	/buddyboss-inc/init.php
	/buddyboss-inc/theme.php
	/buddypress/activity/post-form.php
	/buddypress/members/single/messages/compose.php
	/buddypress/registration/ (removed)
	/buddypress/registration/register.php (removed)
	/css/buddypress.css
	/css/custom.css (removed)
	/css/plugins.css (added)
	/css/wordpress.css
	footer.php
	/js/buddypress.js
	/js/mobile-main.js
	/languages/en_US.mo
	/languages/en_US.po
	style.css

CHANGED FILES (CHILD THEME):

	/buddyboss-child-inc/child-theme.php
	/css/custom.css (updated documentation)
	style.css (updated documentation)

TESTED WITH:

	-- WordPress --
	WordPress 3.6
	BuddyPress 1.7 and 1.8+
	bbPress 2.3+

	-- Mobile --
	iOS 6+
	Android 4.1+

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 9+

/*--------------------------------------------------------------
3.0.1 - August 16, 2013
--------------------------------------------------------------*/

FEATURES:

	Fixed a bug with newly registered users not being able to activate their accounts
	Fixed a bug with running BuddyBoss while BuddyPress is deactivated
	Fixed a bug with the Toolbar for logged out users
	Fixed an overflow display issue on desktop layout

CHANGED FILES:

	_readme.txt
	/buddyboss-inc/theme.php
	/css/wordpress.css (Section 13.3, around line 2169)
	header.php
	style.css (changed version number)

TESTED WITH:

	-- WordPress --
	WordPress 3.6
	BuddyPress 1.7 and 1.8+
	bbPress 2.3+

	-- Mobile --
	iOS 6+
	Android 4.1+

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 8+ (works best in 9+)

/*--------------------------------------------------------------
3.0 - August 15, 2013   ** major release / responsive layout **
--------------------------------------------------------------*/

FEATURES:

	Responsive layout for phones, tablets, and desktops.
	BuddyPress and bbPress custom mobile styles.
	Mobile touch-to-swipe photo viewer.
	Full integration with BuddyPress 1.7 and 1.8.
	Can be used with or without BuddyPress.
	Improved theme structure and documentation.
	Completely rewritten to be cleaner and simpler.

CHANGED FILES:

	Complete code rewrite. All files changed.

TESTED WITH:

	-- WordPress --
	WordPress 3.6
	BuddyPress 1.7 and 1.8+
	bbPress 2.3+

	-- Mobile --
	iOS 6+
	Android 4.1+

	-- Browsers --
	Chrome
	Safari
	Firefox
	Internet Explorer 8+ (works best in 9+)

DEVELOPMENT HISTORY:

	Final Release:			August 15, 2013
	Release Candidate #3:	August 14, 2013
	Release Candidate #2:	August 8, 2013
	Release Candidate #1:	August 2, 2013
	Beta #7: 				August 1, 2013
	Beta #6:				July 30, 2013
	Beta #5:				July 28, 2013
	Beta #4:				July 25, 2013
	Beta #3:				July 14, 2013
	Beta #2:				July 7, 2013
	Beta #1:				June 19, 2013

/*--------------------------------------------------------------
Version 2
--------------------------------------------------------------*/
/*--------------------------------------------------------------
2.1.9 - May 13, 2013
--------------------------------------------------------------*/

FEATURES:

	Much improved layout for native bbPress forums

CHANGED FILES:

	/css/bbpress.css
	/bbpress/ (added)
	/bbpress/loop-single-forum.php (added)
	/bbpress/loop-single-reply.php (added)
	/bbpress/loop-single-topic.php (added)
	/_inc/images/forum-closed.gif (added)
	/_inc/images/forum-hidden.gif (added)
	/_inc/images/forum-private.gif (added)
	/_inc/images/forum-topic-sticky.gif (added)
	/_inc/images/forum-topic.gif (added)
	/_inc/images/forum.gif (added)
	style.css (changed version number)
	readme.txt

TESTED WITH:

	WordPress 3.5.1
	BuddyPress 1.7.1
	bbPress 2.3.2
	
/*--------------------------------------------------------------
2.1.8 - May 1, 2013
--------------------------------------------------------------*/

FEATURES:

	BuddyPress setting for "Show the Toolbar for logged out users" now works (hack removed)
	You can now add sidebar widgets to native bbPress forums

CHANGED FILES:

  	functions.php (removed line 28 – issue fixed in BuddyPress 1.7.1)
  	bbpress.php (new)
  	sidebar-forums.php (new)
	style.css (changed version number)
	readme.txt

TESTED WITH:

	WordPress 3.5.1
	BuddyPress 1.7.1
	bbPress 2.3.1

/*--------------------------------------------------------------
2.1.7 - April 8, 2013
--------------------------------------------------------------*/

FEATURES:

	Compatibility with BuddyPress 1.7 (if BuddyPress is activated)
	Custom stylesheet for bbPress 2+ standalone forums (now the default setup in BuddyPress)
	Better organized and detailed readme.txt file

CHANGED FILES:

  	/_inc/css/default.css (section 7.12 removed, replaced with //css/bbpress.css)
  	/css/bbpress.css
  	header.php
  	functions.php (line 28 – crucial update add Toolbar for logged out users)
	style.css (changed version number)
	readme.txt

TESTED WITH:

	WordPress 3.5.1
	BuddyPress 1.7
	bbPress 2.2.4

/*--------------------------------------------------------------
2.1.6 - January 15, 2013
--------------------------------------------------------------*/

FEATURES:

	Fixed an AJAX error related to BuddyPress 1.6.3.
	Stopped BuddyBoss database cleanup from still being executed when Activity is disabled, which caused false error log messages.

CHANGED FILES:

	/_inc/ajax.php
	/_inc/global.js
	buddy_boss_pics.php
	style.css (changed version number)
	readme.txt

TESTED WITH:

	WordPress 3.5
	BuddyPress 1.6.3

/*--------------------------------------------------------------
2.1.5 - December 11, 2012
--------------------------------------------------------------*/

FEATURES:

	Fixed Post Form from posting into wrong section in BuddyPress 1.6.2 (removed drop down options).
	Changed title tag on page template to H1, for SEO purposes.
	Changed title tag on links template to H1, for SEO purposes.

CHANGED FILES:

	/activity/post-form.php
	page.php
	links.php
	style.css (changed version number)
	readme.txt

TESTED WITH:

	WordPress 3.5
	BuddyPress 1.6.2

/*--------------------------------------------------------------
2.1.4 - October 22, 2012
--------------------------------------------------------------*/

FEATURES:

	Fixed text "ago ago" in forums.
	Added language file translations for:
		"Add Photo"
		"You need to"
		"log in"
		"or"
		"to post to this user’s wall"
		"to participate in the forum topic"
		"Back to"
	Added global.js language translations for:
		"people"
		"person"
		"like"
		"likes"
		"this"
	Fixed error preventing posting of photo directly after posting previous photo.
	Fixed "Likes" when more than 5 comments on activity stream.
	Fixed formatting of show all comments.
	Fixed phantom sidebar when no widget installed in Activity Sidebar.
	Added proper padding to AJAX loader.

CHANGED FILES:
	
	/activity/index.php
	/forums/forums-loop.php
	/groups/single/forum/topic.php
	/registration/header.php
	/languages/en_US.po
	/languages/en_US.mo
	functions.php
	post-form.php
	/_inc/global.js
	/_inc/css/default.css (Sections 6.1.2, 6.1.3, 6.5)
	style.css (changed version number)
	readme.txt

TESTED WITH:

	WordPress 3.4.2
	BuddyPress 1.6.1

/*--------------------------------------------------------------
2.1.3 - September 27, 2012
--------------------------------------------------------------*/

FEATURES:

	Fixed issues with counts in like system.
	Fixed issue with deleting comments on activity streams.
	Added header to Color Picker admin options.
	AJAX for "Likes" fixed on member profile template.
	Fixed issue with WP Admin Bar drop down, where News Feed linked to displayed profile instead of logged in user's activity.
	Archive template properly displays two columns.
	AJAX loader works correctly with BuddyPress Group Email Subscriptions plugin.

CHANGED FILES:

	buddy_boss_wall.php
	functions.php
	header.php (removed .menu-bg div)
	/_inc/css/default.css (Sections 2.2, 6.5)
	/_inc/global.js
	archive.php
	/members/single/activity.php
	/activity/entry.php (this now loads entry-default.php or entry-wall.php based on wall active state)
	/activity/activity-wall-loop.php (removed for redundancy)
	/activity/entry-default.php (new)
	style.css (changed version number)
	readme.txt

KNOWN ISSUES:

	Calendar in certain plugins doesn't display correctly in Firefox.

TESTED WITH:

	WordPress 3.4.2
	BuddyPress 1.6.1

/*--------------------------------------------------------------
2.1.2 - September 11, 2012
--------------------------------------------------------------*/

FEATURES:

	Restored Permalink layout.
	Cleaned up code in the Wall.
	When creating a group, default avatar in group creation process is now correct.
	Favicon link is working correctly.
	Page margin is correct with admin bar turned on or off (28px margin).
	Color picker for navigation added.
	Fixed formatting on Spam button.
	Admin bar displays News Feed and My Likes when Wall is activated.
	Images will display at full width when there is no sidebar (newly uploaded images).
	Filters no longer display on the Wall (they're not supposed to).
	Photos correctly overlap admin bar when opened with Lightbox.

CHANGED FILES:

	/_inc/images/activity_arrow.gif
	/_inc/css/default.css (Sections 2.0, 6.1.1, 6.1.2, 7.11)
	//members/single//activity/permalink.php
	buddy_boss_wall.php
	buddy_boss_pics.php
	/activity/entry.php
	/activity/index.php
	/activity/post-form.php
	functions.php
	header.php (line 10)
	/members/single/activity.php
	style.css (changed version number)
	readme.txt

KNOWN ISSUES:

	Need to add header background to color picker page.

TESTED WITH:

	WordPress 3.4.2
	BuddyPress 1.6.1

/*--------------------------------------------------------------
2.1.1 - August 25, 2012
--------------------------------------------------------------*/

FEATURES:

	Fixed issues with BuddyBoss wall.
	Fixed custom registration and activation templates.
	Fixed color picker.
	Fixed issue preventing users from posting an update if they click outside of the textarea box.
	Fixed random sidebar errors.
	Fixed excerpts for pages and blogs.
	Fixed display of BP Profile Search.
	Fixed incorrect activation warning.
	Fixed login logo stretching in Safari.
	Admin Bar custom styled for BuddyBoss.
	Updated activity layout on member profile.
	Updated styles of "This field can be seen by" text in profile settings.
	Removed latest update from members loop.
	Added sidebar capability back to Blogs index.
	Added sidebar capability back to member profiles.
	Added custom nav links back to member profiles.
	Wall photos display at a maximum size of 548px now.
	Better styled footer widgets.

CHANGED FILES:

	buddy_boss_wall.php
	buddy_boss_pics.php
	functions.php
	/_inc/css/default.css (Sections 2.0, 2.2, 2.3, 3.2, 6.1.2, 6.4, 6.8, 7.1)
	/_inc/css/buddybar.css (completely rewritten)
	/_inc/css/registration.css
	/_inc/css/auto.css (new)
	/_inc/cp//css/layout.css (removed)
	/_inc/global.js
	/registration/activate.php
	/registration/register.php
	sidebar-directory.php
	/members/single/member-header.php
	/members/members-loop.php
	/members/single/home.php
	/members/index.php
	/blogs/index.php
	/activity/index.php
	page.php
	onecolumn-page.php (removed, already exists in fullwidth.php)
	style.css (changed version number)
	readme.txt

KNOWN ISSUES:

	When Wall is activated, the Activity drop-down in adminbar displays many list items that should be replaced with "News Feed" and "My Likes"
	When logged in as an admin, the Spam link is using a button styling.
	Permalink template is not correct.

TESTED WITH:

	WordPress 3.4.1
	BuddyPress 1.6.1

/*--------------------------------------------------------------
2.1.0 - August 14, 2012   ** known bugs - upgrade to 2.1.1 **
--------------------------------------------------------------*/

FEATURES:

	Compatibility with BuddyPress 1.6
	Added Theme Options to change colors from the Dashboard

CHANGED FILES:

	Complete code rewrite. All files changed.	

TESTED WITH:

	WordPress 3.4.1
	BuddyPress 1.6.1

/*--------------------------------------------------------------
2.0.3 - March 14, 2012
--------------------------------------------------------------*/

FEATURES:

	Fixed Wall to display only your activity and mentions.
	Fixed activity stream from showing updates improperly.
	Comments are now visible for logged out users.
	Fixed likes on wall and activity stream.

CHANGED FILES:

	/_inc/global.js
	buddy_boss_wall.php
	/activity/entry.php
	/activity/entry-wall.php
	style.css (changed version number)
	readme.txt

TESTED WITH:

	WordPress 3.3.1
	BuddyPress 1.5.4

/*--------------------------------------------------------------
2.0.2 - December 30, 2011
--------------------------------------------------------------*/

FEATURES:

	"PO" language file included with theme under //languages/ folder.
	Fixed CSS formatting on comments (left padding and removed numbering).
	Fixed "Read More" on comments.

CHANGED FILES:

	/_inc/css/default.css
	/_inc/global.js
	buddy_boss_pics.php
	buddy_boss_wall.php
	sidebar-home-left.php
	/activity/comment.php
	/activity/entry.php
	/activity/entry-wall.php
	functions.php
	/languages/en_US.po
	/languages/en_US.mo
	style.css (changed version number)
	readme.txt

TESTED WITH:

	WordPress 3.3
	BuddyPress 1.5.2

/*--------------------------------------------------------------
2.0.1 - October 5, 2011
--------------------------------------------------------------*/

FEATURES:

	Fixed @mention notifications Page Not Found error.
	Fixed CSS formatting on pages - bulleted lists and tables.
	Fixed CSS error of highlighting selected menu item's drop-down pages.
	Fixed message overlapping "Add Photo" when using the Public Mention button.

CHANGED FILES:

	buddy_boss_wall.php
	/_inc/css/default.css (Sections 4.0, 5.0)
	/activity/post-form.php
	style.css (changed version number)
	readme.txt

TESTED WITH:

	WordPress 3.2.1
	BuddyPress 1.5

/*--------------------------------------------------------------
2.0.0 - September 27, 2011   ** major release **
--------------------------------------------------------------*/

FEATURES:

	Full compatibility with BuddyPress 1.5.
	Complete code rewrite – faster, cleaner, better documented, more stable.
	Much improved "Facebook" Wall.
		Photo uploading to the Wall, with user photo galleries.
		"Likes" on Wall posts.
		The return of @mentions. They now work in the wall.
	Widgets galore! Optional widgetized sidebars on all BuddyPress components, including profiles and groups.
	All BuddyPress components are registered as WordPress pages and can be reordered within the admin.
	Full support for bbPress 2.0 and standalone forums.
	Improved commenting.
	Improved support for IE7.
	Improved image uploader for site logo.
	Added editor styles.

CHANGED FILES:

	Complete code rewrite. All files changed.
	style.css (changed version number)
	readme.txt

TESTED WITH:

	WordPress 3.2.1
	BuddyPress 1.5

/*--------------------------------------------------------------
Version 1
--------------------------------------------------------------*/
/*--------------------------------------------------------------
1.1.4 - July 26, 2011
--------------------------------------------------------------*/

FEATURES:

	Fixed bug with post form displaying on users' Walls while logged out.
	Improved CSS with BuddyPress Activity Plus plugin.
	Added word-wrap to admin bar for long words.
	Made admin bar slightly wider to allow for longer words.
	Fixed minor CSS issue with right aligned text getting cut off.
	Updated "Theme Support" section in BuddyBoss admin settings.

CHANGED FILES:

	/_inc/css/default.css
	/_inc/css/buddybar.css
	/activity/post-form.php
	/activity/entry.php
	admin_options.php
	style.css (changed version number)
	readme.txt

TESTED WITH:

	WordPress 3.2.1
	BuddyPress 1.2.9

/*--------------------------------------------------------------
1.1.3 - July 5, 2011
--------------------------------------------------------------*/

FEATURES:

	Compatibility with WordPress 3.2 and BuddyPress 1.2.9
	Added optional sidebar widget area to all BuddyPress directory pages.
	Improved the look of the BuddyBoss admin settings.
	Added a "Read More" link to blog posts.
	Added Next/Previous links to homepage (when using blog posts).
	Fixed issue with post form displaying on other users' profiles when Wall is off.
	Improved CSS display with WPMU Dev Facebook.
	"Show/Hide Form" setting for BP Profile Search can now be checked or unchecked. It doesn't matter anymore.

CHANGED FILES:

	admin_options.php
	/_inc/ajax.php
	/_inc/global.js (for compatibility with WordPress 3.2)
	/_inc/css/default.css
	/_inc/css/registration.css
	functions.php (registered new widget sections)
	/members/index.ph
	/groups/index.php
	/forums/index.php
	/blogs/index.php
	/activity/index.php
	front-page.php
	/members/single/activity.php
	sidebar-directory.php (new)
	sidebar-members.php (removed)
	style.css (changed version number)
	readme.txt

TESTED WITH:

	WordPress 3.2
	BuddyPress 1.2.9

/*--------------------------------------------------------------
1.1.2 - June 10, 2011
--------------------------------------------------------------*/

FEATURES:

	Added site logo to Sign Up (Register) page.
	Removed an incorrect HTML comment in header.php.
	Fixed CSS display with long list items.
	Fixed CSS display with Group Email Subscriptions plugin.
	Fixed CSS display with U Forum Attachments plugin.
	Fixed CSS display with lists in forum posts.
	Fixed CSS bug with group Join/Leave buttons in IE7.
	When comments are closed, posts now display "Comments are closed" instead of "Leave a comment".
	Updated permalink page template to include user profile links.

CHANGED FILES:
	
	header.php
	/registration/header.php
	index.php (comments section)
	archive.php (comments section)
	search.php (comments section)
	front-page.php (comments section)
	/members/single//activity/permalink.php
	/_inc/css/default.css
	/_inc/css/registration.css (copy this file to your child theme also, if you're using one)
	style.css (changed version number)
	readme.txt

TESTED WITH:

	WordPress 3.1.3
	BuddyPress 1.2.8

/*--------------------------------------------------------------
1.1.1 - June 2, 2011
--------------------------------------------------------------*/

FEATURES:

	Added fixes for formatting of BuddyPress Links plugin and BP Gallery plugin.
	When posting new topics on Group Forums Directory, "Post In Group Forum" is now first and marked as required, to prevent posting errors.
	Added bullets to widget list items to make individual items more clear.
	Updated Homepage "My Profile" icons.
	Updated footer credit.
	Reformatted readme.txt to make it more legible.

CHANGED FILES:

	/forums/index.php
	footer.php
	/_inc/css/default.css
	/_inc/images/icon-avatar.png
	/_inc/images/icon-edit.png
	/_inc/images/icon-profile.png
	/_inc/images/icon-search.png
	style.css (changed version number)
	readme.txt
	
TESTED WITH:

	WordPress 3.1.3
	BuddyPress 1.2.8

/*--------------------------------------------------------------
1.1.0 - May 24, 2011
--------------------------------------------------------------*/

FEATURES:

	Added custom stylesheet to make theme updates easier.
	Added support for featured images in blog posts.

CHANGED FILES:

	style.css
	/_inc/css/custom.css (new)
	/_inc/css/default.css
	functions.php
	index.php
	archive.php
	front-page.php
	style.css (changed version number)
	readme.txt
	
TESTED WITH:

	WordPress 3.1.2
	BuddyPress 1.2.8

/*--------------------------------------------------------------
1.0.9 - May 17, 2011
--------------------------------------------------------------*/

FEATURES:

	Greatly overhauled BuddyBoss Settings admin panel.
	Login image can now be up to 500px wide (previously got cut off at 320px).
	Administrators can now post to all members and can reply to all wall posts, regardless of friendship status.
	Activity posting is now enabled on the Sitewide Activity page.
	Wall only displays posts from Public groups now; posts from Hidden or Private groups are filtered out.
	Rewrote front page template so that Activity Stream can be set as Front Page.
	Fixed bug with wall link in the adminbar redirecting to the wrong page.
	Footer can now contain any length of content without overflow.
	When user has not added Wall posts yet, message now says "This user has not added any Wall posts yet."
	Fixed issues with display of certain widgets, including Who's Online Avatars and Calendar.
	Updated layout of Blogs Directory (only visible in multi-site).
	Removed RSS feed link from Group home pages, for simplicity.
	Improved layout of members search form, for when BP Profile Search plugin is not enabled.
	Set blog page to display formatted excerpts, instead of entire posts.
	Improved blog comment formatting.
	Added "Edit this entry" link to blog posts.

CHANGED FILES:

	functions.php
	/_inc/css/default.css
	/activity/post-form.php
	/activity/entry-wall.php
	/activity/activity-wall-loop.php
	/activity/index.php
	/blogs/index.php
	/forums/index.php
	/groups/index.php
	/members/index.php
	sidebar-members.php
	/groups/single/activity.php
	front-page.php
	index.php
	archive.php
	single.php
	admin_options.php
	buddy_boss_wall.php
	/_inc/images/buddyboss-edit-icon-32.png (new)
	/_inc/images/buddyboss-admin-icon-16.png (new)
	style.css (changed version number)
	readme.txt
	
TESTED WITH:

	WordPress 3.1.2
	BuddyPress 1.2.8

/*--------------------------------------------------------------
1.0.8.2 - May 12, 2011
--------------------------------------------------------------*/

FEATURES:

	Fixed styling with radios and checkboxes on Register form.
	Fixed missing background color on Freshness forum header.

CHANGED FILES:

	/_inc/css/registration.css
	/_inc/css/default.css
	style.css (changed version number)
	readme.txt
	
TESTED WITH:

	WordPress 3.1.2
	BuddyPress 1.2.8

/*--------------------------------------------------------------
1.0.8.1 - May 11, 2011
--------------------------------------------------------------*/

FEATURES:

	Removed "My Profile" notice (added in 1.0.7). Replaced with "Edit My Profile" link under avatar when on your own profile.

CHANGED FILES:

	/_inc/css/default.css
	/_inc/images/change-avatar.png
	/members/single/member-header.php
	style.css (changed version number)
	readme.txt
	
TESTED WITH:

	WordPress 3.1.2
	BuddyPress 1.2.8

/*--------------------------------------------------------------
1.0.8 - May 9, 2011
--------------------------------------------------------------*/

FEATURES:

	Custom Login Logo now links to your website instead of WordPress.org.
	Dropdown menus can now contain any length of text.
	Fixed bug with widget title bars in IE7.
	Fixed minor display issues noticeable while editing forum posts.
	Blog posts now display the date along with the time.

CHANGED FILES:

	functions.php
	/_inc/css/default.css
	/_inc/css/buddybar.css
	/_inc/images/nav.png
	/groups/single/forum/topic.php
	/groups/single/forum/edit.php
	index.php
	single.php
	front-page.php
	style.css (changed version number)
	readme.txt

TESTED WITH:

	WordPress 3.1.2
	BuddyPress 1.2.8

/*--------------------------------------------------------------
1.0.7 - May 6, 2011
--------------------------------------------------------------*/

FEATURES:

	Updates to main stylesheet.
	Added "My Profile" notice when on your own profile.
	Added "Delete" button to Wall activity items.
	Added "Reply" button to user's own Wall activity items.

CHANGED FILES:

	/_inc/css/default.css
	buddy_boss_wall.php
	buddy_boss_wall_third_party.php
	activity (entire folder)
	/members/single/member-header.php
	/groups/single/admin.php
	/groups/single/members.php
	/groups/single/send-invites.php
	footer.php
	style.css (changed version number)
	readme.txt

TESTED WITH:

	WordPress 3.1.2
	BuddyPress 1.2.8

/*--------------------------------------------------------------
1.0.6 - April 29, 2011   ** first public release **
--------------------------------------------------------------*/

FEATURES:

	Added Facebook-style wall component.

TESTED WITH:

	WordPress 3.1.2
	BuddyPress 1.2.8

/*--------------------------------------------------------------
1.0.5
--------------------------------------------------------------*/

FEATURES:

	Added support for secondary footer custom menu.

/*--------------------------------------------------------------
1.0.4
--------------------------------------------------------------*/

FEATURES:

	Added support for WordPress 3.0 custom menus.

/*--------------------------------------------------------------
1.0.3
--------------------------------------------------------------*/

FEATURES:

	Improved signup process.

/*--------------------------------------------------------------
1.0.2
--------------------------------------------------------------*/

FEATURES:

	Added widget areas. Minor CSS updates.

/*--------------------------------------------------------------
1.0.1
--------------------------------------------------------------*/

FEATURES:

	Bug fixes related to activity stream.

/*--------------------------------------------------------------
1.0.0
--------------------------------------------------------------*/

FEATURES:

	Initial Version.
