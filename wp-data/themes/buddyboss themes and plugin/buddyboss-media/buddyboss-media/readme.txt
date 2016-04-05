/*--------------------------------------------------------------
INSTALLATION
--------------------------------------------------------------*/

= From your WordPress dashboard =

-BuddyPress-

1. Visit 'Plugins > Add New'
2. Search for 'BuddyPress'
3. Activate BuddyPress from your Plugins page

-BuddyBoss Media-

1. Go to 'Plugins > Add New'
2. Click 'Add New'
3. Upload this plugin (as a ZIP file)
4. Activate this plugin
5. Go to 'Settings > BuddyBoss Media'
6. Have fun!

Instructions: http://www.buddyboss.com/tutorials/
Support: http://www.buddyboss.com/support-forums/
Release Notes: http://www.buddyboss.com/release-notes/


/*--------------------------------------------------------------
CHANGELOG
----------------------------------------------------------------
Version 3
----------------------------------------------------------------
3.0.7 - August 24, 2015
3.0.6 - August 19, 2015
3.0.5 - August 2, 2015
3.0.4 - May 18, 2015
3.0.3 - April 21, 2015
3.0.2 - March 31, 2015
3.0.1 - March 28, 2015
3.0.0 - March 25, 2015
----------------------------------------------------------------
Version 2
----------------------------------------------------------------
2.0.8 - February 6, 2015
2.0.7 - January 26, 2015
2.0.6 - January 23, 2015
2.0.5 - January 15, 2015
2.0.4 - January 13, 2015
2.0.3 - January 8, 2015
2.0.2 - January 5, 2015
2.0.1 - January 4, 2015
2.0.0 - December 31, 2014
----------------------------------------------------------------
Version 1
----------------------------------------------------------------
1.1.1 - December 19, 2014
1.1.0 - December 17, 2014
1.0.9 - November 20, 2014
1.0.8 - November 13, 2014
1.0.7 - November 9, 2014
1.0.6 - October 14, 2014
1.0.5 - October 4, 2014
1.0.4 - September 24, 2014
1.0.3 - September 12, 2014
1.0.2 - September 5, 2014
1.0.1 - August 27, 2014
1.0.0 - August 14, 2014
--------------------------------------------------------------*/



/*--------------------------------------------------------------
Version 3
--------------------------------------------------------------*/
/*--------------------------------------------------------------
3.0.7 - August 24, 2015
--------------------------------------------------------------*/

BUG FIXES:

	Fixed error during multisite activation on specific setups

CHANGED FILES:

	buddyboss-media.php
	/includes/types/photo-class.php
	readme.txt

TESTED WITH:

	WordPress 4.0, 4.1, 4.2+
	BuddyPress 2.1, 2.2, 2.3+

/*--------------------------------------------------------------
3.0.6 - August 19, 2015
--------------------------------------------------------------*/

BUG FIXES:

	Disabled post update button while image is being uploaded
	Enabled post button when uploader popup is closed
	Fixed uploaded image cropping
	Fixed issues with multisite options saving
	Replaced plugin path with constant
	Added BuddyBoss Wall posted text support

CHANGED FILES:

	/assets/js/buddyboss-media.js
	/assets/js/buddyboss-media.min.js
	buddyboss-media.php
	/includes/admin.php
	/includes/main-class.php
	/includes/types/photo-class.php
	/includes/types/photo-hooks.php
	/languages/buddyboss-media-en_US.po
	/languages/buddyboss-media-en_US.mo
	readme.txt

TESTED WITH:

	WordPress 4.0, 4.1, 4.2+
	BuddyPress 2.1, 2.2, 2.3+

/*--------------------------------------------------------------
3.0.5 - August 2, 2015
--------------------------------------------------------------*/

FEATURES:

	Updated Swedish translations, credits to Anton Andreasson

BUG FIXES:

	Fixed incorrect album photo counts
	Fixed deleted photos displaying in Global Album activity post layout
	Fixed issue with image sometimes not displaying after upload
	Fixed database migration when using multisite
	Fixed PHP error notices

CHANGED FILES:

	buddyboss-media.php
	/includes/albums/album-template.php
	/includes/bbm-migrate.php
	/includes/main-class.php
	/includes/media-template.php
	/includes/types/photo-class.php
	/includes/types/photo-hooks.php
	/languages/buddyboss-media-en_US.po
	/languages/buddyboss-media-en_US.mo
	/languages/buddyboss-media-sv_SE.po
	/languages/buddyboss-media-sv_SE.mo
	readme.txt

TESTED WITH:

	WordPress 4.0, 4.1, 4.2+
	BuddyPress 2.1, 2.2, 2.3+

/*--------------------------------------------------------------
3.0.4 - May 18, 2015
--------------------------------------------------------------*/

FEATURES:

	Added "Like" (Favorite) icon to photo overlay
	Added French translations, credits to Jean-Pierre Michaud

BUG FIXES:

	Improved CSS for bulk uploading
	Better theme comptability when tagging friends
	Fixed compatibility issues with Jetpack plugin
	Fixed Wall Photo privacy overriding Album privacy
	Fixed issues when deleting single image from a bulk upload
	Fixed image counts in albums (requires migration script)
	Fixed album creation timestamp
	Removed incorrect admin update notice in multisite
	"Max. Files per Batch" option now only accepts positive values
	Security patch for XSS vulnerability

CHANGED FILES:

	/assets/css/buddyboss-media.css
	/assets/css/buddyboss-media.min.css
	/assets/js/buddyboss-media.js
	/assets/js/buddyboss-media.min.js
	/assets/vendor/photoswipe/photoswipe.css
	buddyboss-media.php
	/includes/admin.php
	/includes/albums/album-functions.php
	/includes/albums/album-template.php
	/includes/bbm-migrate.php (added)
	/includes/main-class.php
	/includes/media-functions.php
	/includes/media-template.php
	/includes/tagging/class.BuddyBoss_Media_Tagging_Hooks.php
	/includes/types/photo-class.php
	/includes/types/photo-hooks.php
	/languages/buddyboss-media-en_US.po
	/languages/buddyboss-media-en_US.mo
	/languages/buddyboss-media-fr_FR.po
	/languages/buddyboss-media-fr_FR.mo
	readme.txt
	/templates/members/single/buddyboss-media-album.php
	/templates/members/single/buddyboss-media-albums.php

TESTED WITH:

	WordPress 4.0, 4.1+
	BuddyPress 2.1, 2.2+

/*--------------------------------------------------------------
3.0.3 - April 21, 2015
--------------------------------------------------------------*/

FEATURES:

	Added comment count in photo overlay

BUG FIXES:

	Better support for Multisite activation

CHANGED FILES:

	/assets/css/buddyboss-media.css
	/assets/css/buddyboss-media.min.css
	/assets/js/buddyboss-media.js
	/assets/js/buddyboss-media.min.js
	buddyboss-media.php
	/includes/admin.php
	/includes/main-class.php
	/languages/buddyboss-media-en_US.po
	/languages/buddyboss-media-en_US.mo
	/types/photo-class.php
	/types/photo-hooks.php
	readme.txt

TESTED WITH:

	WordPress 4.0, 4.1+
	BuddyPress 2.1, 2.2+

/*--------------------------------------------------------------
3.0.2 - March 31, 2015
--------------------------------------------------------------*/

BUG FIXES:

	Improved layout of 3 image uploads (small images) in activity streams
	Fixed "medium" vs "large" image sizes in activity streams

CHANGED FILES:

	/assets/css/buddyboss-media.css
	/assets/css/buddyboss-media.min.css
	buddyboss-media.php
	/includes/admin.php
	/includes/types/photo-hooks.php
	/languages/buddyboss-media-en_US.po
	/languages/buddyboss-media-en_US.mo
	readme.txt

TESTED WITH:

	WordPress 4.1+
	BuddyPress 2.1, 2.2+

/*--------------------------------------------------------------
3.0.1 - March 28, 2015
--------------------------------------------------------------*/

BUG FIXES:

	Improved layout of 2 image uploads in activity streams

CHANGED FILES:

	/assets/css/buddyboss-media.css
	/assets/css/buddyboss-media.min.css
	buddyboss-media.php
	/includes/types/photo-class.php
	/includes/types/photo-hooks.php
	readme.txt

TESTED WITH:

	WordPress 4.1+
	BuddyPress 2.1, 2.2+

/*--------------------------------------------------------------
3.0.0 - March 25, 2015
--------------------------------------------------------------*/

FEATURES:

	Bulk uploading allows for multiple photo uploads at once
	Bulk uploading displays grouped photos in activity stream
	Removed post form on Photos and Albums pages, replaced with DropZone
	Added Italian translations, credits to Massimiliano Napoli

BUG FIXES:

	Fix for 'bp_is_active' error while upgrading BuddyPress
	Now using jQuery in noConflict mode
	Delete tagging notifications when corresponding photos activities are deleted

CHANGED FILES:

	/assets/css/buddyboss-media.css
	/assets/css/buddyboss-media.min.css
	/assets/img/remove-photo.png (added)
	/assets/js/buddyboss-media.js
	/assets/js/buddyboss-media.min.js
	/assets/vendor/fancybox/blank.gif (added)
	/assets/vendor/fancybox/fancybox_loading.gif (added)
	/assets/vendor/fancybox/fancybox_loading@2x.gif (added)
	/assets/vendor/fancybox/fancybox_overlay.png (added)
	/assets/vendor/fancybox/fancybox_sprite.png (added)
	/assets/vendor/fancybox/fancybox_sprite@2x.png (added)
	/assets/vendor/fancybox/helpers/fancybox_buttons.png (added)
	/assets/vendor/fancybox/helpers/jquery.fancybox-buttons.css (added)
	/assets/vendor/fancybox/helpers/jquery.fancybox-buttons.js (added)
	/assets/vendor/fancybox/helpers/jquery.fancybox-media.js (added)
	/assets/vendor/fancybox/helpers/jquery.fancybox-thumbs.css (added)
	/assets/vendor/fancybox/helpers/jquery.fancybox-thumbs.js (added)
	/assets/vendor/fancybox/jquery.fancybox.css (added)
	/assets/vendor/fancybox/jquery.fancybox.js (added)
	/assets/vendor/fancybox/jquery.fancybox.pack.js (added)
	buddyboss-media.php
	/includes/admin.php
	/includes/albums/album-functions.php
	/includes/albums/album-template.php
	/includes/main-class.php
	/includes/tagging/class.BuddyBoss_Media_Tagging.php
	/includes/tagging/class.BuddyBoss_Media_Tagging_Notifications.php
	/includes/types/photo-class.php
	/includes/types/photo-hooks.php
	/languages/buddyboss-media-it_IT.mo (added)
	/languages/buddyboss-media-it_IT.po (added)
	/languages/buddyboss-media-en_US.po
	/languages/buddyboss-media-en_US.mo
	readme.txt
	/templates/global-media-grid.php (removed)
	/templates/members/single/buddyboss-media-album-create.php
	/templates/members/single/buddyboss-media-album-edit.php

TESTED WITH:

	WordPress 4.1+
	BuddyPress 2.1, 2.2+

/*--------------------------------------------------------------
Version 2
--------------------------------------------------------------*/
/*--------------------------------------------------------------
2.0.8 - February 6, 2015
--------------------------------------------------------------*/

CHANGES:

	"Photos" navigation link now displays before "Settings"

BUG FIXES:

	Tagging no longer results in a blank notification
	Plugin loading is now disabled if Activity Component is disabled
	Added missing language translations

CHANGED FILES:

	buddyboss-media.php
	/includes/main-class.php
	/includes/media-bp-notifications.php
	/includes/tagging/class.BuddyBoss_Media_Tagging_Notifications.php
	/includes/types/photo-class.php
	/languages/buddyboss-media-en_US.po
	/languages/buddyboss-media-en_US.mo
	readme.txt
	/templates/activity/buddyboss-media-activity-loop.php

TESTED WITH:

	WordPress 4.1
	BuddyPress 2.1, 2.2

/*--------------------------------------------------------------
2.0.7 - January 26, 2015
--------------------------------------------------------------*/

BUG FIXES:

	Removed dependency on BuddyPress' jQuery.cookie library
	Updated FontAwesome to version 4.3

CHANGED FILES:

	/assets/js/buddyboss-media.js
	/assets/js/buddyboss-media.min.js
	buddyboss-media.php
	/includes/types/photo-class.php
	readme.txt

TESTED WITH:

	WordPress 4.1
	BuddyPress 2.1+

/*--------------------------------------------------------------
2.0.6 - January 23, 2015
--------------------------------------------------------------*/

BUG FIXES:

	Force loading our jQuery cookie, fixes several issues
	When moving photos, dropdown displays album that photo is already in

CHANGED FILES:

	/assets/js/buddyboss-media.js
	/assets/js/buddyboss-media.min.js
	buddyboss-media.php
	/includes/albums/album-template.php
	/includes/types/photo-class.php
	readme.txt


TESTED WITH:

	WordPress 4.1
	BuddyPress 2.1+

/*--------------------------------------------------------------
2.0.5 - January 15, 2015
--------------------------------------------------------------*/

BUG FIXES:

	Fixed Javascript conflict with Flyzoo Chat plugin
	When uploading media into a group, activity post now adds link to the group
	Photo count in albums is now updated when photos are deleted

CHANGED FILES:

	/assets/js/buddyboss-media.js
	/assets/js/buddyboss-media.min.js
	buddyboss-media.php
	/includes/admin.php
	/includes/albums/album-functions.php
	/includes/tagging/class.BuddyBoss_Media_Tagging_Notifications.php
	/includes/types/photo-class.php
	/includes/types/photo-hooks.php
	readme.txt

TESTED WITH:

	WordPress 4.1
	BuddyPress 2.1+

/*--------------------------------------------------------------
2.0.4 - January 13, 2015
--------------------------------------------------------------*/

BUG FIXES:

	Added Delete button to media overlay

CHANGED FILES:

	/assets/css/buddyboss-media.css
	/assets/css/buddyboss-media.min.css
	/assets/js/buddyboss-media.js
	/assets/js/buddyboss-media.min.js
	buddyboss-media.php
	/includes/types/photo-class.php
	/includes/types/photo-hooks.php
	/languages/buddyboss-media-en_US.po
	/languages/buddyboss-media-en_US.mo
	readme.txt

TESTED WITH:

	WordPress 4.1
	BuddyPress 2.1+

/*--------------------------------------------------------------
2.0.3 - January 8, 2015
--------------------------------------------------------------*/

BUG FIXES:

	Display all photos in indexes, including those in albums
	Fixed blank space after clicking "Load More"

CHANGED FILES:

	/assets/js/buddyboss-media.js
	/assets/js/buddyboss-media.min.js
	buddyboss-media.php
	/includes/albums/album-functions.php
	/includes/media-template.php
	/includes/types/photo-class.php
	/languages/buddyboss-media-en_US.po
	/languages/buddyboss-media-en_US.mo
	readme.txt

TESTED WITH:

	WordPress 4.1
	BuddyPress 2.1+

/*--------------------------------------------------------------
2.0.2 - January 5, 2015
--------------------------------------------------------------*/

BUG FIXES:

	Fixed layout at 2 column width in Grid view
	Fixed layout of global albums with certain themes

CHANGED FILES:

	/assets/css/buddyboss-media.css
	/assets/css/buddyboss-media.min.css
	buddyboss-media.php
	/includes/types/photo-class.php
	readme.txt
	/templates/global-media-albums.php

TESTED WITH:

	WordPress 4.1
	BuddyPress 2.1+

/*--------------------------------------------------------------
2.0.1 - January 4, 2015
--------------------------------------------------------------*/

BUG FIXES:

	Compatibility with photos uploaded in much older versions of BuddyBoss Media
	Fix related to displaying newly posted photos

CHANGED FILES:

	/assets/css/buddyboss-media.css
	/assets/css/buddyboss-media.min.css
	buddyboss-media.php
	/includes/albums/album-functions.php
	/includes/albums/album-template.php
	/includes/media-functions.php
	/includes/media-template.php
	/includes/tagging/class.BuddyBoss_Media_Tagging.php
	/includes/types/photo-class.php
	/includes/types/photo-templates.php
	/languages/buddyboss-media-en_US.po
	/languages/buddyboss-media-en_US.mo
	readme.txt
	/templates/activity/buddyboss-media-activity-loop.php
	/templates/members/single/buddyboss-media-album-create.php

TESTED WITH:

	WordPress 4.1
	BuddyPress 2.1+

/*--------------------------------------------------------------
2.0.0 - December 31, 2014
--------------------------------------------------------------*/

FEATURES:

	Photo Albums
	Friend Tagging
	Admin option to switch between Grid and Activity view

BUG FIXES:

	Using native "Load More" on photos template
	Code cleanup

CHANGED FILES:

	/assets/css/buddyboss-media.css
	/assets/css/buddyboss-media.min.css
	/assets/img/ajax-loader.gif (removed)
	/assets/img/icon-photo.gif (removed)
	/assets/img/icons.png (removed)
	/assets/img/icons@2x-original.png (removed)
	/assets/img/icons@2x.png (removed)
	/assets/img/loader.gif (removed)
	/assets/img/placeholder-150x150.png (added)
	/assets/js/buddyboss-media.js
	/assets/js/buddyboss-media.min.js
	/assets/js/jquery.tooltipster.js (added)
	/assets/js/jquery.tooltipster.min.js (added)
	buddyboss-media.php
	/includes/admin.php
	/includes/albums/album-functions.php (added)
	/includes/albums/album-screens.php (added)
	/includes/albums/album-template.php (added)
	/includes/main-class.php
	/includes/media-template.php
	/includes/tagging/class.BuddyBoss_Media_Tagging.php (added)
	/includes/tagging/class.BuddyBoss_Media_Tagging_Hooks.php (added)
	/includes/tagging/class.BuddyBoss_Media_Tagging_Notifications.php (added)
	/includes/types/photo-class.php
	/includes/types/photo-hooks.php
	/languages/buddyboss-media-en_US.po
	/languages/buddyboss-media-en_US.mo
	readme.txt
	/templates/activity/buddyboss-media-activity-loop.php (added)
	/templates/activity/buddyboss-media-entry.php (added)
	/templates/global-media-albums.php (added)
	/templates/global-media-grid.php (added)
	/templates/global-media.php
	/templates/looped-tagged-friends.php (added)
	/templates/members/single/buddyboss-media-album-create.php (added)
	/templates/members/single/buddyboss-media-album-edit.php (added)
	/templates/members/single/buddyboss-media-album.php (added)
	/templates/members/single/buddyboss-media-albums.php (added)
	/templates/members/single/buddyboss-media-photos.php
	/templates/members/tag-friends.php (added)

TESTED WITH:

	WordPress 4.0+
	BuddyPress 2.1+

/*--------------------------------------------------------------
Version 1
--------------------------------------------------------------*/
/*--------------------------------------------------------------
1.1.1 - December 19, 2014
--------------------------------------------------------------*/

FEATURES:

	Admin option to switch between "Medium" and "Full Size" photos in activity

CHANGED FILES:

	buddyboss-media.php
	/includes/admin.php
	/includes/types/photo-hooks.php
	/languages/buddyboss-media-en_US.po
	/languages/buddyboss-media-en_US.mo
	readme.txt

TESTED WITH:

	WordPress 4.0+
	BuddyPress 2.1+

/*--------------------------------------------------------------
1.1.0 - December 17, 2014
--------------------------------------------------------------*/

FEATURES:

	Better photo grid spacing
	Adding quick link to "Settings" in plugin list

BUG FIXES:

	Fixed "%USER% posted a photo" text in Members directory

CHANGED FILES:

	/assets/css/buddyboss-media.css
	/assets/css/buddyboss-media.min.css
	buddyboss-media.php
	/includes/types/photo-class.php
	/includes/types/photo-hooks.php
	/languages/buddyboss-media-en_US.po
	/languages/buddyboss-media-en_US.mo
	readme.txt

TESTED WITH:

	WordPress 3.8, 3.9, 4.0+
	BuddyPress 2.0, 2.1+

/*--------------------------------------------------------------
1.0.9 - November 20, 2014
--------------------------------------------------------------*/

FEATURES:

	More intuitive photo upload interface
	More intuitive Photoswipe icons
	Activity images now using "Medium" media size to reduce clutter

BUG FIXES:

	On your own activity, uploads now say "You posted..."
	Changed activity text from "new picture" to "new photo"

CHANGED FILES:

	/assets/css/buddyboss-media.css
	/assets/css/buddyboss-media.min.css
	/assets/js/buddyboss-media.js
	/assets/js/buddyboss-media.min.js
	buddyboss-media.php
	/includes/types/photo-class.php
	/includes/types/photo-hooks.php
	/languages/buddyboss-media-en_US.po
	/languages/buddyboss-media-en_US.mo
	readme.txt

TESTED WITH:

	WordPress 3.8, 3.9, 4.0
	BuddyPress 2.0, 2.1+

/*--------------------------------------------------------------
1.0.8 - November 13, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Photoswipe heading now displays status update on Photos template
	Photoswipe heading now displays status update on global Photos page

CHANGED FILES:

	/assets/css/buddyboss-media.css
	/assets/css/buddyboss-media.min.css
	/assets/js/buddyboss-media.js
	/assets/js/buddyboss-media.min.js
	buddyboss-media.php
	/includes/main-class.php
	/includes/types/photo-class.php
	/includes/types/photo-compat.php (new)
	/includes/types/photo-screens.php
	/includes/types/photo-template.php
	readme.txt
	/templates/global-media.php
	/templates/members/single/buddyboss-media-photos.php

TESTED WITH:

	WordPress 3.8, 3.9, 4.0
	BuddyPress 2.0, 2.1+

/*--------------------------------------------------------------
1.0.7 - November 9, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Fixed photo uploading in Chrome for iOS and Android
	Fixed photo upload refresh after completion on "Photos > View" template
	PhotoSwipe heading now displays status update, and falls back to upload time/date
	Members directory listing now say 'photo uploaded' when media was user's last update

CHANGED FILES:

	/assets/css/buddyboss-media.css
	/assets/css/buddyboss-media.min.css
	/assets/js/buddyboss-media.js
	/assets/js/buddyboss-media.min.js
	buddyboss-media.php
	/includes/types/photo-class.php
	/includes/types/photo-hooks.php
	/includes/vendor/image-rotation-fixer.php
	/languages/buddyboss-media-en_US.po
	/languages/buddyboss-media-en_US.mo
	readme.txt

TESTED WITH:

	WordPress 3.8, 3.9, 4.0
	BuddyPress 2.0, 2.1+

/*--------------------------------------------------------------
1.0.6 - October 14, 2014
--------------------------------------------------------------*/

FEATURES:

	Admin option to enable/disable image rotation fix

BUG FIXES:

	Fixed photo uploads breaking due to server memory limit
	Fixed Heartbeat and Photoswipe conflict
	Fixed activity timestamps not having hyperlinks

CHANGED FILES:

 	/assets/js/buddyboss-media.js
 	/assets/js/buddyboss-media.min.js
	buddyboss-media.php
	/includes/admin.php
	/includes/main-class.php
	/includes/types/photo-class.php
	/includes/types/photo-hooks.php
	/includes/vendor/image-rotation-fixer.php
	/languages/buddyboss-media-en_US.po
	/languages/buddyboss-media-en_US.mo
	readme.txt

TESTED WITH:

	WordPress 3.8, 3.9, 4.0
	BuddyPress 2.0, 2.1+

/*--------------------------------------------------------------
1.0.5 - October 4, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Fixed plugin update 'version details' conflict (for future updates)
	Added translations for BuddyBoss Media admin settings page
	Added empty index.php file to prevent bots from viewing contents

CHANGED FILES:
	
	buddyboss-media.php (new)
	/includes/admin.php
	index.php (new)
	/languages/buddyboss-media-en_US.po
	/languages/buddyboss-media-en_US.mo
	loader.php (removed)
	readme.txt

TESTED WITH:

	WordPress 3.8, 3.9, 4.0
	BuddyPress 2.0, 2.1

/*--------------------------------------------------------------
1.0.4 - September 24, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Improved theme compatibility (using plugins.php template)
	Theme widgets now display on user Photos page
	CSS fix, prevents 'Add Photo' button from highlighting during photo upload

CHANGED FILES:

	/assets/css/buddyboss-media.css
	/assets/css/buddyboss-media.min.css
	/includes/types/photo-class.php
	/includes/types/photo-screens.php
	loader.php
	readme.txt
	/templates/members/single/buddyboss-media-photos.php

TESTED WITH:

	WordPress 3.8, 3.9, 4.0
	BuddyPress 2.0, 2.1

/*--------------------------------------------------------------
1.0.3 - September 12, 2014
--------------------------------------------------------------*/

BUG FIXES:

	Fixed image upload disappearing after 10-15 seconds, when BP "heartbeat" initiates

CHANGED FILES:

 	/assets/js/buddyboss-media.js
 	/assets/js/buddyboss-media.min.js
 	/includes/main-class.php
 	/includes/types/photo-class.php
 	loader.php
 	readme.txt

TESTED WITH:

	WordPress 3.8, 3.9, 4.0
	BuddyPress 2.0, 2.1 beta

/*--------------------------------------------------------------
1.0.2 - September 5, 2014
--------------------------------------------------------------*/

FEATURES:

	Updated FontAwesome to version 4.2
	Updated Russian language files, credits to Ivan Dyakov

BUG FIXES:

	Fixed 'pic_satus' to 'pic_status'

CHANGED FILES:

	/assets/js/buddyboss-media.js
	/assets/js/buddyboss-media.min.js
	/includes/types/photo-class.php
	/languages/buddyboss-media-ru_RU.mo
	/languages/buddyboss-media-ru_RU.po
	loader.php
	readme.txt	

TESTED WITH:

	WordPress 3.8, 3.9, 4.0
	BuddyPress 2.0, 2.1 beta

/*--------------------------------------------------------------
1.0.1 - August 27, 2014
--------------------------------------------------------------*/

FEATURES:

	New admin option to configure custom user photos template slug.
	New admin option to create a page for displaying all photo uploads from all users.

BUG FIXES:

	Fixed Font Awesome loading over HTTPS for ports other than 443
	Updated Photo grid CSS, for better compatibility with other themes

CHANGED FILES:

	/assets/css/buddyboss-media.css
	/assets/css/buddyboss-media.min.css
	/includes/admin.php
	/includes/main-class.php
	/includes/media-functions.php
	/includes/media-pagination.php
	/includes/media-template.php (added)
	/includes/types/photo-class.php
	/includes/types/photo-hooks.php
	/includes/types/photo-screens.php
	/languages/buddyboss-media-en_US.po
	/languages/buddyboss-media-en_US.mo
	loader.php
	readme.txt
	/templates/members/single/buddyboss-media-photos.php
	/templates/global-media.php (added)
	/vendor/image-rotation-fixer.php (removed)

TESTED WITH:

	WordPress 3.8, 3.9+
	BuddyPress 2.0, 2.1 beta

/*--------------------------------------------------------------
1.0.0 - August 14, 2014
--------------------------------------------------------------*/

FEATURES:

	Initial Release
	Post photos to activity streams
	View photos in a mobile-friendly slider

TESTED WITH:

	WordPress 3.8, 3.9+
	BuddyPress 2.0+
