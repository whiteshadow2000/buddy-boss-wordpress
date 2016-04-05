/*--------------------------------------------------------------
INSTALLATION
--------------------------------------------------------------*/

= From your WordPress dashboard =

-BuddyPress-

1. Visit 'Plugins > Add New'
2. Search for 'BuddyPress'
3. Activate BuddyPress from your Plugins page

-BuddyBoss Wall-

1. Go to 'Plugins > Add New'
2. Click 'Add New'
3. Upload this plugin (as a ZIP file)
4. Activate this plugin
5. Go to 'Settings > BuddyBoss Wall'
6. Have fun!

Instructions: http://www.buddyboss.com/tutorials/
Support: http://www.buddyboss.com/support-forums/
Release Notes: http://www.buddyboss.com/release-notes/


/*--------------------------------------------------------------
CHANGELOG
--------------------------------------------------------------*/
/*--------------------------------------------------------------
1.2.1 - August 18, 2015
--------------------------------------------------------------*/

FEATURES:

	New admin option to disable URL previews

BUG FIXES:

	Prevent URL preview from interfering with popular oEmbed providers
	URL preview images now link to website rather than image path in uploads directory
	URL preview links now open in new tab
	Fixed issues with decoding unusual characters in URL preview title
	Improved URL preview styling
	Improved the "Cancel" button in URL preview
	Removed privacy options for activity posts under private/hidden groups
	Replace 'Favorite' with 'Like' everywhere except when the textdomain is bbPress
	Fixed activity post text option for multisite
	Fixed issues with wall posting when Friends Component is disabled

CHANGED FILES:

	/assets/css/buddyboss-wall.css
	/assets/css/buddyboss-wall.min.css
	/assets/js/buddyboss-wall.js
	/assets/js/buddyboss-wall.min.js
	buddyboss-wall.php
	/includes/admin.php
	/includes/main-class.php
	/includes/wall-class.php
	/includes/wall-filters.php
	/includes/wall-functions.php
	/includes/wall-privacy.php
	/languages/buddyboss-wall-en_US.po
	/languages/buddyboss-wall-en_US.mo
	readme.txt

TESTED WITH:

	WordPress 4.0, 4.1, 4.2+
	BuddyPress 2.1, 2.2, 2.3+

/*--------------------------------------------------------------
1.2.0 - July 9, 2015
--------------------------------------------------------------*/

FEATURES: 

	Admin option to choose between "You" or [username] for Wall posts
	Option to not use an image in URL preview (close button)
	Swedish translations updated, credits to Anton Andreasson

BUG FIXES:

	URL preview image size optimization
	Fixed like and comment on replies formatting

CHANGED FILES:

	/assets/css/buddyboss-wall.css
	/assets/css/buddyboss-wall.min.css
	/assets/js/buddyboss-wall.js
	/assets/js/buddyboss-wall.min.js
	buddyboss-wall.php
	/includes/admin.php
	/includes/main-class.php
	/includes/wall-class.php
	/includes/wall-functions.php
	/languages/buddyboss-wall-en_US.po
	/languages/buddyboss-wall-en_US.mo
	/languages/buddyboss-wall-sv_SE.po
	/languages/buddyboss-wall-sv_SE.mo
	readme.txt

TESTED WITH:

	WordPress 4.0, 4.1, 4.2+
	BuddyPress 2.1, 2.2, 2.3+

/*--------------------------------------------------------------
1.1.9 - June 24, 2015
--------------------------------------------------------------*/

FEATURES:

	Posted link auto-loads thumbnail and excerpt from website

BUG FIXES:

	Fixed Private Groups not displaying in News Feed
	Fixed Most Liked Activity widget omitting Activity with more than 9 Likes
	Removed error notices

CHANGED FILES:

	/assets/css/buddyboss-wall.css
	/assets/css/buddyboss-wall.min.css
	/assets/js/buddyboss-wall.js
	/assets/js/buddyboss-wall.min.js
	buddyboss-wall.php
	/includes/main-class.php
	/inludes/url-scraper-php/website_parser.php (added)
	/includes/wall-class.php
	/includes/wall-functions.php			
	/includes/wall-hooks.php
	/includes/wall-privacy.php
	/includes/widgets.php
	readme.txt

TESTED WITH:

	WordPress 4.0, 4.1, 4.2+
	BuddyPress 2.1, 2.2, 2.3+

/*--------------------------------------------------------------
1.1.8 - May 8, 2015
--------------------------------------------------------------*/

FEATURES:

	Added French language files, credits to Jean-Pierre Michaud

BUG FIXES:

	Fixed Most Liked Widget not displaying
	Fixed language translation issues
	Fixed "My likes" tab count
	Removed incorrect error message when Friends Component is disabled
	Removed incorrect update notice on Multisite
	Patched XSS security vulnerability

CHANGED FILES:

	/assets/js/buddyboss-wall.js
	/assets/js/buddyboss-wall.min.js
	buddyboss-wall.php
	/includes/admin.php
	/includes/main-class.php
	/includes/wall-class.php
	/includes/wall-hooks.php
	/includes/wall-privacy.php
	/includes/widgets.php
	/languages/buddyboss-wall-en_US.po
	/languages/buddyboss-wall-en_US.mo
	/languages/buddyboss-wall-fr_FR.po
	/languages/buddyboss-wall-fr_FR.mo
	readme.txt

TESTED WITH:

	WordPress 4.0, 4.1+
	BuddyPress 2.1, 2.2+

/*--------------------------------------------------------------
1.1.7 - April 24, 2015
--------------------------------------------------------------*/

BUG FIXES:

	Fixed post syntax when posting on other user's Wall
	Better directory path logic for multisite

CHANGED FILES:

	buddyboss-wall.php
	/includes/admin.php
	/includes/main-class.php
	/includes/wall-class.php
	/includes/wall-hooks.php
	/languages/buddyboss-wall-en_US.po
	/languages/buddyboss-wall-en_US.mo
	readme.txt

TESTED WITH:

	WordPress 4.0, 4.1+
	BuddyPress 2.1, 2.2+

/*--------------------------------------------------------------
1.1.6 - April 21, 2015
--------------------------------------------------------------*/

BUG FIXES:

	Better support for Multisite activation

CHANGED FILES:

	buddyboss-wall.php
	/includes/admin.php
	/includes/main-class.php
	/includes/wall-class.php
	/languages/buddyboss-wall-en_US.po
	/languages/buddyboss-wall-en_US.mo
	readme.txt

TESTED WITH:

	WordPress 4.0, 4.1+
	BuddyPress 2.1, 2.2+

/*--------------------------------------------------------------
1.1.5 - April 14, 2015
--------------------------------------------------------------*/

FEATURES:

	Updated Italian language files, credits to Massimiliano Napoli

BUG FIXES:

	Fixed slow query on Members directory with privacy enabled
	Added support for custom user-meta tables

CHANGED FILES:

	buddyboss-wall.php
	/includes/wall-functions.php
	/includes/wall-privacy.php
	/languages/buddyboss-wall-it_IT.po
	/languages/buddyboss-wall-it_IT.mo
	readme.txt

TESTED WITH:

	WordPress 4.0, 4.1+
	BuddyPress 2.1, 2.2+

/*--------------------------------------------------------------
1.1.4 - April 9, 2015
--------------------------------------------------------------*/

BUG FIXES:

	Added "Group Members" privacy filter for old posts in Groups

CHANGED FILES:

	/assets/js/buddyboss-wall-privacy.js
	/assets/js/buddyboss-wall-privacy.min.js
	buddyboss-wall.php
	/includes/wall-class.php
	/includes/wall-privacy.php
	readme.txt

TESTED WITH:

	WordPress 4.0+
	BuddyPress 2.1, 2.2+

/*--------------------------------------------------------------
1.1.3 - April 9, 2015
--------------------------------------------------------------*/

FEATURES:

	Added Privacy filters for activity posts
	Added Italian language files, credits to Massimiliano Napoli

BUG FIXES:

	Fixed "Load More" duplicate post display issue
	Fixed translation issue for "wrote on" and "mentioned"

CHANGED FILES:
	
	/assets/css/buddyboss-wall.css
	/assets/css/buddyboss-wall.min.css
	/assets/js/buddyboss-wall-privacy.js (added)
	/assets/js/buddyboss-wall-privacy.min.js (added)
	buddyboss-wall.php
	/includes/admin.php
	/includes/main-class.php
	/includes/wall-class.php
	/includes/wall-hooks.php
	/includes/wall-privacy.php (added)
	/languages/buddyboss-wall-en_US.po
	/languages/buddyboss-wall-en_US.mo
	/languages/buddyboss-wall-it_IT.po (added)
	/languages/buddyboss-wall-it_IT.mo (added)
	readme.txt

TESTED WITH:

	WordPress 4.0+
	BuddyPress 2.1, 2.2+

/*--------------------------------------------------------------
1.1.2 - December 24, 2014
--------------------------------------------------------------*/

FEATURES:

	Adding quick link to "Settings" in plugin list

BUG FIXES:

	Fixed double timestamp bug when posting into Groups

CHANGED FILES:

	buddyboss-wall.php
	/includes/wall-hooks.php
	/languages/buddyboss-wall-en_US.po
	/languages/buddyboss-wall-en_US.mo
	readme.txt

TESTED WITH:

	WordPress 4.0+
	BuddyPress 2.1+

/*--------------------------------------------------------------
1.1.1 - November 22, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Added body class "buddyboss-wall-active" for custom styling

CHANGED FILES:

	buddyboss-wall.php
	/includes/wall-class.php
	readme.txt

TESTED WITH:

	WordPress 3.8, 3.9, 4.0
	BuddyPress 2.0, 2.1+

/*--------------------------------------------------------------
1.1.0 - November 13, 2014
--------------------------------------------------------------*/

BUG FIXES:
	
	@mention Notifications now link to Mentions tab on Activity index

CHANGED FILES:

	buddyboss-wall.php
	/includes/main-class.php
	/includes/wall-class.php
	/includes/wall-functions.php
	/includes/wall-hooks.php
	/languages/buddyboss-wall-en_US.po
	/languages/buddyboss-wall-en_US.mo
	readme.txt

TESTED WITH:

	WordPress 3.8, 3.9, 4.0
	BuddyPress 2.0, 2.1+

/*--------------------------------------------------------------
1.0.9 - October 30, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Fixed Friend activity in the News Feed
	Fixed Group activity in the News Feed

CHANGED FILES:

	buddyboss-wall.php
	/includes/wall-class.php
	readme.txt

TESTED WITH:

	WordPress 3.8, 3.9, 4.0
	BuddyPress 2.0, 2.1+

/*--------------------------------------------------------------
1.0.8 - October 27, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Fixed Notifications in WordPress Toolbar not clearing when clicked
	Fixed News Feed errors when BuddyPress Friends Compontent is disabled
	Fixed Wall post replies overriding the original poster
	Fixed conflict with "Bump to Top" plugin
	Improved photo upload text on Members directory

CHANGED FILES:

	buddyboss-wall.php
	/includes/wall-class.php
	/includes/wall-functions.php
	/includes/wall-hooks.php
	/includes/widgets.php
	readme.txt

TESTED WITH:

	WordPress 3.8, 3.9, 4.0
	BuddyPress 2.0, 2.1+

/*--------------------------------------------------------------
1.0.7 - October 13, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Fixed replies showing 'Error getting likes'
	Fixed replies showing 'Like' link when logged out
	Fixed certain timestamps not displaying hyperlink
	Fixed Group activity text structure
	Fixed Like text getting removed when liking/unliking a parent activity
	Fixed 'Favorites' translation on Activity index 'My Likes' tab
	Fixed user mentioning another user displaying that they mentioned themself

CHANGED FILES:

	/assets/css/buddyboss-wall.css
	/assets/css/buddyboss-wall.min.css
	/assets/js/buddyboss-wall.js
	/assets/js/buddyboss-wall.min.js
	buddyboss-wall.php
	/includes/wall-class.php
	/includes/wall-filters.php
	/includes/wall-hooks.php
	/includes/wall-template.php
	/languages/buddyboss-wall-en_US.po
	/languages/buddyboss-wall-en_US.mo
	readme.txt

TESTED WITH:

	WordPress 3.8, 3.9, 4.0
	BuddyPress 2.0, 2.1+

/*--------------------------------------------------------------
1.0.6 - October 6, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Fixed 'My Likes' tab disappearing on main Activity index

CHANGED FILES:

	buddyboss-wall.php
	includes/main-class.php
	readme.txt

TESTED WITH:

	WordPress 3.8, 3.9, 4.0
	BuddyPress 2.0, 2.1	

/*--------------------------------------------------------------
1.0.5 - October 4, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Fixed plugin update 'version details' conflict (for future updates)
	Removed question mark from "Write something to Username?"
	Added translations for BuddyBoss Wall admin settings page
	Added empty index.php file to prevent bots from viewing contents

CHANGED FILES:

	buddyboss-wall.php (new)
	/includes/admin.php
	/includes/main-class.php
	/includes/wall-class.php
	index.php (new)
	/languages/buddyboss-wall-en_US.po
	/languages/buddyboss-wall-en_US.mo
	loader.php (removed)
	readme.txt

TESTED WITH:

	WordPress 3.8, 3.9, 4.0
	BuddyPress 2.0, 2.1

/*--------------------------------------------------------------
1.0.4 - September 24, 2014
--------------------------------------------------------------*/

BUG FIXES:

	The Wall, News Feed, and My Likes tabs are now translatable
	Now displaying 'Deleted User' text in activity post if user deletes account
	Fixed errors on Activity page in WordPress admin
	Rewrote wall input filter function, fixed issues with wall posts and user mentions

CHANGED FILES:

	/includes/wall-class.php
	/includes/wall-hooks.php
	/languages/buddyboss-wall-en_US.po
	/languages/buddyboss-wall-en_US.mo
	loader.php
	readme.txt

TESTED WITH:

	WordPress 3.8, 3.9, 4.0
	BuddyPress 2.0, 2.1

/*--------------------------------------------------------------
1.0.3 - Septembet 2, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Fixed %INITIATOR% wrote on %TARGET% wall bug
	Fixed post conflict with rtMedia plugin

UPDATES:

	Updated Russian language files, credits to Ivan Dyakov

CHANGED FILES:

	/includes/wall-hooks.php
	/languages/buddyboss-wall-ru_RU.po
	/languages/buddyboss-wall-ru_RU.mo
	loader.php
	readme.txt

TESTED WITH:

	WordPress 3.8, 3.9+
	BuddyPress 2.0, 2.1 beta

/*--------------------------------------------------------------
1.0.2 - August 27, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Fixed "What's New" text showing the wrong group name in post form
	Changed "Like" button default title attribute to "Like this"
	Added translation for title attribute of "Like" button
	Added translations for Wall, News Feed, My Likes tabs

CHANGED FILES:

	/includes/main-class.php
	/includes/wall-class.php
	/includes/wall-filters.php
	/languages/buddyboss-wall-en_US.po
	/languages/buddyboss-wall-en_US.mo
	loader.php
	readme.txt

TESTED WITH:

	WordPress 3.8, 3.9+
	BuddyPress 2.0, 2.1 beta

/*--------------------------------------------------------------
1.0.1 - August 22, 2014
--------------------------------------------------------------*/

FEATURES:

	You can now "Like" replies to activity posts
	Updated Swedish translations, credits to Anton Andreasson

BUG FIXES:

	Fixed blank subnav appearing on first Like
	Fixed Like button causing 'Mentions' tab to double in height and width

CHANGED FILES:

	/assets/js/buddyboss-wall.js
	/assets/js/buddyboss-wall.min.js
	/includes/wall-class.php
	/includes/wall-functions.php
	/includes/wall-hooks.php
	/includes/wall-template.php
	/languages/buddyboss-wall-en_US.po
	/languages/buddyboss-wall-en_US.mo
	/languages/buddyboss-wall-sv_SE.po
	/languages/buddyboss-wall-sv_SE.mo
	loader.php
	readme.txt

TESTED WITH:

	WordPress 3.8, 3.9+
	BuddyPress 2.0+

/*--------------------------------------------------------------
1.0.0 - August 18, 2014
--------------------------------------------------------------*/

FEATURES:

	Initial Release
	Post content to other user's profiles
	See a "News Feed" from your friends and groups
	"Like" your favorite content
	"Most Liked Activity" widget

TESTED WITH:

	WordPress 3.8, 3.9+
	BuddyPress 2.0+

