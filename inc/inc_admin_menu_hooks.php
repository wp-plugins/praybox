<?php

//ADMIN MENU INTERFACES

add_action('admin_menu','gd_pb_menu');

function gd_pb_menu() {

	//create new top-level menu
	add_menu_page('PrayBox','PrayBox','administrator','pb_settings','pb_settings_page',plugins_url().'/praybox/images/gdicon.png');
	//create new submenus
if(get_option('pb_admin_moderation')==1){
	add_submenu_page('pb_settings','Pending Request List','Pending Request List','administrator','pb_request_list_pending','pb_request_list_pending_page');
}
	add_submenu_page('pb_settings','Active Request List','Active Request List','administrator','pb_request_list_active','pb_request_list_active_page');
	add_submenu_page('pb_settings','Flagged Requests','Flagged Requests','administrator','pb_request_list_flagged','pb_request_list_flagged_page');
	add_submenu_page('pb_settings','Closed Request List','Closed Request List','administrator','pb_request_list_closed','pb_request_list_closed_page');
	add_submenu_page('pb_settings','Archived Request List','Archived Request List','administrator','pb_request_list_archived','pb_request_list_archived_page');
	add_submenu_page('pb_settings','Banned IPs','Banned IPs','administrator','pb_bannedips','pb_bannedips_page');
	//add_submenu_page('','Edit Listings','Edit Listings','administrator','gd_pbl_settings_edit_listings','gd_pbl_edit_listing_page');
}
