<?php
/*
Plugin Name: PrayBox
Plugin URI: http://www.guilddev.com/wordpress-plugins/
Description: This is a plugin that facilitates intercessory prayer by allowing visitors to post prayer requests and/or respond to prayer requests that have been posted by clicking on a button indicating that the prayer request has been prayed for. At the end of each day, visitors who have submitted prayer requests receive an email that tells them how many times they have been prayed for that day.
Version: 0.4
Author: Guild Development, LLC
Author URI: http://www.guilddev.com
*/

/*  Copyright 2011  Guild Development, LLC  (email : support@guilddev.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function pb_includeAdminCSS() {
	echo '<link type="text/css" rel="stylesheet" href="'.plugins_url().'/praybox/css/gd-praybox.css" />' . "\n";
}
function pb_includePublicCSS() {
	echo '<link type="text/css" rel="stylesheet" href="'.plugins_url().'/praybox/css/gd-praybox-sc.css" />' . "\n";
}
add_action('admin_head','pb_includeAdminCSS');
add_action('wp_head','pb_includePublicCSS');

include("inc/inc_install_func.php");
include("inc/inc_pb_crons.php");

register_activation_hook(__FILE__,'gd_pb_db_install');
register_activation_hook(__FILE__,'gd_pb_crons');
add_action('prayer_gap','do_gap_check');
add_action('daily_emails','send_daily_emails');

include("inc/inc_admin_menu_hooks.php");

//ADMIN INCLUDES
include("inc/inc_pb_settings_page.php");
include("inc/inc_pb_flagged_requests_page.php");
include("inc/inc_pb_bannedips_page.php");
include("inc/inc_pb_request_list_page.php");

//SHORTCODE INCLUDES
include("inc/inc_display_pb_requests.php");
include("inc/inc_display_pb_forms.php");

add_shortcode('pb-requests','display_pb_requests');
add_shortcode('pb-forms','display_pb_forms');

