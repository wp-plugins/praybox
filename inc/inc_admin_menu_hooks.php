<?php

//ADMIN MENU INTERFACES

add_action('admin_menu','gd_pb_menu');

function gd_pb_menu() {

	//create new top-level menu
	add_menu_page('PrayBox','PrayBox','administrator','pb_settings','pb_settings_page','/wp-content/plugins/praybox/images/gdicon.png');
	//create new submenus
	add_submenu_page('pb_settings','Flagged Requests','Flagged Requests','administrator','pb_flagged_requests','pb_flagged_requests_page');
	add_submenu_page('pb_settings','Banned IPs','Banned IPs','administrator','pb_bannedips','pb_bannedips_page');
	add_submenu_page('pb_settings','Request List','Request List','administrator','pb_request_list','pb_request_list_page');
	//add_submenu_page('','Edit Listings','Edit Listings','administrator','gd_pbl_settings_edit_listings','gd_pbl_edit_listing_page');
}
