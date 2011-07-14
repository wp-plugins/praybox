=== PrayBox ===
Contributors: guilddev
Donate link: http://www.guilddev.com/
Tags: church, pray, prayer, religion, ministry
Requires at least: 3.0
Tested up to: 3.2
Stable tag: 1.0.1

Prayer request application that allows users to submit requests, or pray for existing requests

== Description ==

Prayer request application that allows users to submit requests, or pray for existing requests.  All requests can be moderated from the admin section and can be flagged by members as inappropriate requests.  There is a IP ban system in place as well to reduce inappropriate behavior.

Every time a request is prayed for, and the user clicks the "I Prayed For You" button, the requester will receive a nightly email detailing how many prayers they received that day.

= Live Praybox =

Video on how to use the Praybox frontend: [Praybox for Wordpress Youtube Video](http://www.youtube.com/watch?v=vcRpZZ8lS98)

View our working version of Praybox, post a prayer request or pray for others here: [Praybox - Online Prayer Requests](http://www.praybox.com/)

= Want more features?  Upgrade to PrayBox+ =

Moderation, praise updates, spam protection, and more.  Read more here:

[Praybox+ - Premium Prayer Request Plugin](http://wordpress-plugins.guilddev.com/praybox-plus-premium-prayer-request-wordpress-plugin)

= Support and Requests =

We respond to all support requests at our forum: [Support Forum](http://wordpress-plugins.guilddev.com/forum/praybox-online-prayer-request-plugin/)

== Installation ==

1. Upload 'praybox' folder to the '/wp-content/plugins/' directory or use the 'Add New' option under the 'Plugins' menu in your WordPress backend and 'Upload' 'praybox.zip'.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Configure settings for PrayBox in the WordPress dashboard by clicking on the 'PrayBox' option in your WordPress backend.
4. Enter the appropriate information into the form fields on the 'PrayBox General Settings' page.
5. Make sure the appropriate shortcodes are placed on the appropriate pages.
5. Paste shortcodes accordingly:
    * Paste this shortcode into the page you would like to use to display your listings: [pb-requests]
    * Paste this shortcode into the page you would like to use to display your submission form: [pb-forms]
    * IMPORTANT: Make sure you tell the plugin where you placed the [pb-forms] shortcode by selecting that page from the list beside "Prayer Request Form Page"
6. Have fun using this plugin and if you have any questions, requests, or positive feedback, we would love to hear from you at Guild Development, LLC (http://www.guilddev.com/wordpress-plugins/)

== Screenshots ==

== Changelog ==

= April 7, 2011 - 0.1 =
* Plugin base.

= April 18, 2011 - 0.2 =
* fixed line breaks so that they work properly in the body of prayer requests.
* added language filter (just in case)
* when someone doesn't enter a title, the title is displayed as 'Untitled'

= April 18, 2011 - 0.3 =
* changed paths to plugin assets so that they play nice with BlueHost and other hosts that use '/wordpress' as the base for WP files in their installers

= June 14, 2011 - 0.4 =
* Change text "Report This" to "Report Abuse" to be more clear
* Fixed bug where people not using the extension "wp_" in their DB were not able to post, and were banned from posting

= July 13, 2011 - 1.0 =
* Fixed daily "Prayed For" email notifications
* Fixed issue with single requests occasionally being posted multiple times
* Fixed issue where line spacing was translated to "rn"
* Cleaned up a lot of code/functions to make PrayBox run more efficiently
* Added the option for users to edit anonymity and notification preferences for their own prayer requests
* Added the option for users to close their own prayer requests
* Added actual URLs for requests, so users can link directly to requests

= July 14, 2011 - 1.0.1 =
* Fixed "View Details" and related links on request list for sites not using permalinks
