<?php
/*
Plugin Name: PrayBox
Plugin URI: http://www.praybox.com/
Description: PrayBox is being used to manage prayer requests on WordPress websites all over the world.
Version: 1.4
Author: Bryan Haddock
Author URI: http://www.blazingtorch.com
*/

/*  Copyright 2014 Bryan Haddock  (email : support@blazingtorch.com)

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
include("inc/pb_constants.php");
include("inc/functions.php");
include("inc/enqueue_functions.php");
include("inc/public_pb_ajax.php");

include("inc/inc_install_func.php");
include("inc/inc_pb_crons.php");
include("inc/inc_update_func.php");

register_activation_hook(__FILE__,'gd_pb_db_install');
register_activation_hook(__FILE__,'setup_pb_crons');

include("inc/inc_admin_menu_hooks.php");

//ADMIN INCLUDES
include("inc/inc_pb_settings_page.php");
include("inc/inc_pb_bannedips_page.php");
include("inc/inc_pb_request_list_pending_page.php");
include("inc/inc_pb_request_list_active_page.php");
include("inc/inc_pb_request_list_flagged_page.php");
include("inc/inc_pb_request_list_closed_page.php");
include("inc/inc_pb_request_list_archived_page.php");

//SHORTCODE INCLUDES
include("inc/inc_display_pb_requests.php");
include("inc/inc_display_pb_forms.php");

add_shortcode('pb-requests','display_pb_requests');
add_shortcode('pb-forms','display_pb_forms');

//DEACTIVATION
register_deactivation_hook(__FILE__, 'deactivate_pb_crons');
